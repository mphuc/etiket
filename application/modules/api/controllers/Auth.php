<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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
 * @property CI_Loader load
 * @property ApiModel apiModel
 * @property TermModel termModel
 * @property UserModel userModel
 */
class Auth extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('apiModel');
        $this->load->model('termModel');
        $this->load->model('userModel');
        $this->config->load('google');
    }

    public function index()
    {
        json_response('auth');
    }

    public function google()
    {
        $id_token = $this->input->get('id_token');
        if( !$id_token ) json_response('ID token required', 400);
        try{
            $client = new GuzzleHttp\Client();
            $res = $client->request('GET', 'https://www.googleapis.com/oauth2/v3/tokeninfo?id_token='.$id_token);
            if( $res->getStatusCode() == 200 ){
                $payload = json_decode( $res->getBody() );
                $user = $this->userModel->getByEmail( $payload->email );
                if( !$user ){
                    $group_id = $this->db->where('name','loket')->get('tb_groups',1)->row('id');
                    if( !$group_id ) json_response("Group Not Found", 401);
                    $groups = array($group_id);
                    $password = $this->apiModel->encryptPassword( time() );
                    $user_avatar = 'avatar.png';
                    $full_name = $payload->name;
                    $config = array(
                        'field' => 'username',
                        'title' => 'title',
                        'table' => 'tb_user',
                        'id'    => 'id',
                    );
                    $this->load->library('slug', $config);
                    $username = $this->slug->create_uri( $full_name );
                    $data_insert = array(
                        'username'          => $username,
                        'email_verified'    => $payload->email_verified,
                        'password'          => $password,
                        'email'             => $payload->email,
                        'created_on'        => time(),
                        'last_login'        => time(),
                        'user_display_name' => $full_name,
                        'active'            => 1,
                        'user_mobile'       => '',
                        'user_avatar'       => $user_avatar,
                        'address'           => '',
                        'ip_address'        => $this->input->ip_address()
                    );
                    $this->db->insert('tb_user', $data_insert);
                    $insert_id = $this->db->insert_id();
                    $unique = $this->apiModel->randomString(36);
                    $this->userModel->update($insert_id, ['token' => $unique ]);
                    $this->ion_auth->remove_from_group(null, $insert_id);
                    $this->ion_auth->add_to_group($groups, $insert_id);
                    $user = $this->userModel->getByID( $insert_id );
                }
                $jwt  = $this->apiModel->jwtEncode( $user->id );
                json_response( $jwt );
            }else{
                json_response('Error', $res->getStatusCode());
            }
        }
        catch (\GuzzleHttp\Exception\GuzzleException $e) {
            json_response($e->getMessage(), 599);
        }
    }

    public function me()
    {
        $_POST = json_decode(file_get_contents('php://input'), true);
        $jwt    = $this->apiModel->jwtAuth();
        $user = $this->userModel->getByID( $jwt->data->id );
        json_response($user);
    }

    public function refresh_token()
    {
        $method = $this->apiModel->detectMethod();
        switch ($method){
            case 'get':
                $jwt    = $this->apiModel->jwtAuth();
                $userId = $jwt->data->id;
                $token  = $this->input->get('refresh_token');
                $valid  = $this->apiModel->validToken( $userId, $token );
                if( !$valid ) json_response('Forbidden', 403);
                $jwt    = $this->apiModel->jwtEncode( $userId );
                json_response( $jwt );
                break;
            default:
                json_response('Not Allowed', 405);
        }
    }
}
