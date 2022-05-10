<?php
/**
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Parser $parser
 * @property Ion_auth|Ion_auth_model $ion_auth
 * @property M_base_config $M_base_config
 * @property base_config $base_config
 * @property CI_Lang $lang
 * @property CI_URI $uri
 * @property CI_DB_query_builder|CI_DB_mysqli_driver $db
 * @property CI_Config $config
 * @property CI_User_agent $agent
 * @property CI_Email $email
 * @property Base_config Base_config
 * @property Slug slug
 * @property UserModel userModel
 * @property CI_Loader load
 */

class ApiModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('userModel');
    }

    /**
     * @param $userID int
     * @return mixed
     */
    public function userExist($userID)
    {
        $this->db->where('id', $userID);
        return $this->db->get('tb_user',1)->row();
    }

    /**
     * @param $userID int
     * @param $token string
     * @return bool
     */
    public function validToken($userID, $token=null)
    {
        if( !$token ) return false;
        $this->db->where('id', $userID);
        $this->db->where('token', $token);
        return $this->db->get('tb_user',1)->num_rows();
    }

    /**
     * @param $password string
     * @return mixed
     */
    public function encryptPassword($password)
    {
        $this->load->model('Ion_auth_model');
        $salt = $this->Ion_auth_model->store_salt ? $this->Ion_auth_model->salt() : FALSE;
        return $this->Ion_auth_model->hash_password($password, $salt);
    }

    /**
     * @return string
     */
    public function detectMethod() {
        $method = strtolower($this->input->server('REQUEST_METHOD'));

        if ($this->config->item('enable_emulate_request')) {
            if ($this->input->post('_method')) {
                $method = strtolower($this->input->post('_method'));
            } else if ($this->input->server('HTTP_X_HTTP_METHOD_OVERRIDE')) {
                $method = strtolower($this->input->server('HTTP_X_HTTP_METHOD_OVERRIDE'));
            }
        }

        if (in_array($method, array('get', 'delete', 'post', 'put'))) {
            return $method;
        }

        return 'get';
    }

    /**
     * @param boolean $onlyNumber
     * @param int $length
     * @return string
     */
    public function randomString($length=255, $onlyNumber=false)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if( $onlyNumber ) $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @param $userIDs array
     * @param $title string
     * @param $body string
     * @param $type string
     * @param $group string
     * @param $data array
     * @return bool|mixed
     */
    public function sendBulkNotificationToMobile($userIDs, $title, $body, $data=array())
    {
        $this->config->load('custom', TRUE);
        $custom_config = $this->config->item('custom');
        $registrationIDs = $this->apiModel->getFCM($userIDs);
        if( !$registrationIDs ) return false;
        $json_data = array(
            "registration_ids" => $registrationIDs,
            "notification" => array(
                "body"  => $body,
                "title" => $title,
                "sound" => "default"
            )
        );
        if( $data ) $json_data["data"] = $data;
        $data = json_encode($json_data);
        $url = $custom_config['custom_url_fcm'];
        $server_key = $custom_config['custom_server_key_firebase'];
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key='.$server_key
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Oops! FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }

    /**
     * @param $userId int|array
     * @return mixed|boolean
     */
    public function removeFCM($userId)
    {
        if( is_array($userId) ){
            $this->db->where_in('user_id', $userId);
        }else{
            $this->db->where('user_id', $userId);
        }
        return $this->db->delete('tb_fcm');
    }

    /**
     * @param $userId int
     * @param $token string
     * @return object|boolean
     */
    public function addFCM($userId, $token)
    {
        $exist = $this->getFCM($userId);
        if( !$exist ){
            $data = array(
                'user_id'   => $userId,
                'token'     => $token,
                'created'   => date("Y-m-d H:i:s")
            );
            return $this->db->insert('tb_fcm', $data);
        }else{
            $data = array(
                'user_id'   => $userId,
                'token'     => $token,
                'created'   => date("Y-m-d H:i:s")
            );
            return $this->db->update('tb_fcm', $data);
        }
    }

    /**
     * @param $userId int|array
     * @return array
     */
    public function getFCM($userId)
    {
        if( is_array($userId) ){
            $this->db->where_in('user_id', $userId);
        }else{
            $this->db->where('user_id', $userId);
        }
        $results = $this->db->get('tb_fcm')->result_array();
        return array_values(array_unique(array_column($results, 'token')));
    }

    /**
     * @param $token string
     * @return object|array
     */
    public function jwtDecode($token=null)
    {
        $this->config->load('jwt');
        try{
            $jwt = \Firebase\JWT\JWT::decode(
                $token,                                                 //Data to be encoded in the JWT
                $this->config->item('jwt_secret_key'),            // The signing key / secret key
                array($this->config->item('jwt_algorithm'))       // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
            );
        }
        catch(Exception $e) {
            $jwt = null;
        }
        return $jwt;
    }

    /**
     * @param int $userId
     * @return array|boolean
     */
    public function jwtEncode($userId)
    {
        $this->config->load('jwt');
        $issuedAt   = time();
        $notBefore  = time();                     //Adding 10 seconds
        $expire     = strtotime('+1 hour'); // Adding 60 seconds
        $serverName = $this->config->item('jwt_server_name');
        $payload = array(
            'iat'  => $issuedAt,                    // Issued at: time when the token was generated
            'iss'  => $serverName,                  // Issuer
            'nbf'  => $notBefore,                   // Not before
            'exp'  => $expire,                      // Expire
            'data' => [
                'id'    => $userId
            ]
        );
        try{
            $uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
            $this->userModel->update($userId, ['token' => $uuid]);
        } catch (Exception $e) {
            return false;
        }
        try{
            $jwt = \Firebase\JWT\JWT::encode(
                $payload,                                       //Data to be encoded in the JWT
                $this->config->item('jwt_secret_key'),    // The signing key / secret key
                $this->config->item('jwt_algorithm')      // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
            );
        } catch(Exception $e) {
            return false;
        }
        $user = (array)$this->userModel->getByID($userId);
        $user['group'] = $this->userModel->getGroupsByUserid($userId);
        return [
            'token'         => $jwt,
            'refresh_token' => $uuid,
            'user'          => $user
        ];
    }

    /**
     * @return array|object
     */
    public function jwtAuth()
    {
        $token = $this->input->get_request_header('x-token');
        //list($token) = sscanf(  $this->input->get_request_header('Authorization'), 'Bearer %s');
        $jwt = $this->jwtDecode($token);
        if( !$jwt ) json_response("Unauthorized",401);
        return $jwt;
    }

    public function attempsBlockAdd()
    {
        $data = array(
            'ip_address'    => $this->input->ip_address(),
            'login'         => 'kios-k',
            'time'          => time()
        );
        $this->db->insert('tb_login_attempts', $data);
    }

    /**
     * @param string $ipAddress
     * @return boolean
     */
    public function attempsBlockCheck($ipAddress)
    {
        $fiveTeenMinutes = strtotime("+5 minutes");
        $this->db->where('time <', $fiveTeenMinutes);
        $this->db->where('ip_address', $ipAddress);
        $this->db->where('login', 'kios-k');
        $count = $this->db->count_all_results('tb_login_attempts');
        if( $count > 10 ){
            return true; //hacked
        }else{
            return false; //normal
        }
    }

    /**
     * @param string $type
     * @param array|object|string $message
     * @return object
     */
    public function log($type='logs', $message)
    {
        if( is_array($message) || is_object($message) ){
            $message = json_encode($message);
        }
        return $this->db->insert('tb_logs', ['type'=> $type,'log' => $message, 'created' => date('Y-m-d')]);
    }

    /**
     * @param int $userId
     * @return array|boolean
     */
    public function jwtEncodeCustom()
    {
        $private_key = "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQC4sEkv5KJiLbE2\nyrTNtnc/GP+YjfZ7ptRiPJdthDRxOKrCWjeYCw3nmR9eemUoV/alRdxzpzSgZtDD\nEYga0CaPCBCt8C+3gVwY04YvKBde7ebWLdr/47S+TYqk81Tu5rUT4U+kqXRVc+5S\n4nYGW+mGnN8HJcNkAKTMa9ZwKmSS9meEnimJYD/oFo3XmWOvi/DoFPO30sPTlJC1\nm43a1+WHCnV41nI2jSgySXcl1iyKsVsoeFwcuVWrzV2cTw3KxGNfoo70UOtESMV3\ni4hw36/lSklGxw2UM96X0lnn8zm8RhQD8nwqQbv2bbapvgvwbUcnQBNhYiKr4Gz5\niW6zrM3tAgMBAAECggEAAILCTQ7bkRxxvUZNvjTnOwYxbMVVvW1OcJAc1hlzwK1o\nsX1o4nODYBTZFJyPi49EuBvLmolHmLr4EFYL05EoTiR2UVjU9PO3Yr0xBY/dkq5j\nQUviq2sAjLcvrzmaDkgWj53Dp9+tGfBmZBXKwEVATdZAuqcU1YG38vXIY8qGOS7S\nkbamgMOx9Xqz+2zT64xvjGSHfSenPbVV08VUhCdVNbXudHbUeqCmIPTl7WhjvfQk\n853Sp95fnQBEIx9hdqSZFIejkB6s1aJ2nZDkic7T0Qwh/VxTMASlWpDeGYKnun6O\nmUPLgslsVDinPN+tYMTy8D0Y7U7UkVkJ9u/TXQN/cQKBgQDkKWcGCdW2oZ9zmf3+\n1ejhRbx9t3oMVq4ivehWcVvNTZEwMZgsKLGIw8y5NKsag4y80fvK3pH2b92jMOVC\njjO0r3wA6s0WVMhaDVMyf8ha+X2UE4+YTzBQB6CvqadEG2/vHR4aHg6vgxBCH0kn\nuilBr5shdFG9MW+wHXx4lhUl0QKBgQDPOQHeDp8Ny7WoAdkNdH/3gymqWopMVwKg\nqiXsOVKfDG4XK0x6X5jgm0seQqP5Lcq1+v+Jjp6/GjVyiyrR6X/FdZQ9KgRtCeq0\nHOD4ysrisUGIXX9sT300k2mTHGRW36OE2CZERX7NZOmx8VRnSe5G4SvzHnz5h7Um\n0yqNHiRBXQKBgG4jXkwX60Zh9qrDJ00gzW4RT9AQBaZ3IVA8BC/WQM52JyPwjNik\nPC8c9XJh7ka6QfHUG4vurN8dWQwxyjm6k1MhcuaucZnaC20NCaBS9tCTpv8YAjUv\n5M59ICAr8UZ7SClREPrij4xB5FNG7vVyc//1WRlpIRwHBTcqxK8hI8xBAoGBAK0k\nvdmzr9RQHKWXfauPZwkBcAPmCN5GaWyjHnKlZtJ8CVSUmh851zv8paRQHEAssc6i\nPXfLUfrtRDFD9PBVwKvVVZpRjEcrXQ9HffaDQ0hswQvWy4xNUplmfnUr6O7ph/CM\nxlSPGKc3pUhIE7UGAfD5XcaS9+trJ8Kb+FbXE4YFAoGAGX7Jd+Nd6QoPAoycNZk0\n93csekfNOQWlLUOEc/TpLXbJdt36supT6Blp3oLveI2ym3Mi3Wshczx1rs4i4EaL\nJGT5QcHh6Av0jGF2+943lqA67jzaUJUa0QrpuM18xojg7q3DxMGhsNB6WVcktw5D\nRWG2qJMuWsOaPhd4OMAFTeI=\n-----END PRIVATE KEY-----\n";

        $this->config->load('jwt');
        $issuedAt   = time();
        $notBefore  = time();                     //Adding 10 seconds
        $expire     = strtotime('+1 hour'); // Adding 60 seconds
        $payload = array(
            'iss'  => 'testing@kawanapps-482bc.iam.gserviceaccount.com',                  // Issuer
            'sub'  => 'testing@kawanapps-482bc.iam.gserviceaccount.com',
            'scope' => 'https://www.googleapis.com/auth/prediction',
            'aud'  => 'https://www.googleapis.com/oauth2/v4/token',
            'iat'  => $issuedAt,                    // Issued at: time when the token was generated
            'exp'  => $expire,                      // Expire
        );
        try{
            $jwt = \Firebase\JWT\JWT::encode(
                $payload,
                $private_key,
                'RS256'
            );
        } catch(Exception $e) {
            return false;
        }
        return $jwt;
    }
    
}