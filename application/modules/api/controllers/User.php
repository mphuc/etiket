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
class User extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('apiModel');
        $this->load->model('termModel');
        $this->load->model('userModel');
    }

    protected function _user_post()
    {
        $_POST = json_decode(file_get_contents('php://input'), true);
        $this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required');
        //$this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tb_user.email]');
        //$this->form_validation->set_rules('phone', 'Phone', 'is_unique[tb_user.user_mobile]' ); //todo uncheck this when live
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            json_response(  strip_tags(validation_errors()), 400 );
        }else{
            $group_id = $this->db->where('name','loket')->get('tb_groups',1)->row('id');
            if( !$group_id ) json_response("Group Not Found", 401);
            $groups = array($group_id);
            $password = $this->apiModel->encryptPassword( $this->input->post('password') );
            $user_avatar = 'avatar.png';
            $full_name = $this->input->post('full_name');
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
                'password'          => $password,
                'email'             => trim($this->input->post('email')),
                'created_on'        => time(),
                'last_login'        => time(),
                'user_display_name' => $full_name,
                'active'            => 1,
                'user_mobile'       => $this->input->post('phone'),
                'user_avatar'       => $user_avatar,
                'address'           => $this->input->post('address'),
                'ip_address'        => $this->input->ip_address()
            );
            $this->db->insert('tb_user', $data_insert);
            $insert_id = $this->db->insert_id();
            $unique = $this->apiModel->randomString(36);
            $this->userModel->update($insert_id, ['token' => $unique ]);
            $this->ion_auth->remove_from_group(null, $insert_id);
            $this->ion_auth->add_to_group($groups, $insert_id);
            json_response( 'Success' );
        }
    }

    protected function _user_put()
    {
        $_POST  = json_decode(file_get_contents('php://input'), true);
        $jwt    = $this->apiModel->jwtAuth();
        $user   = $this->userModel->getByID( $jwt->data->id );
        $data_update    = array();
        $full_name      = $this->input->post('user_display_name');
        $email          = $this->input->post('email');
        $address        = $this->input->post('address');
        $new_username   = $this->input->post('username');
        $province_id    = $this->input->post('province_id');
        $postal_code    = $this->input->post('postal_code');
        $city_id        = $this->input->post('city_id');
        $password       = $this->input->post('password');
        $user_gender    = $this->input->post('user_gender');
        $user_date_birth= $this->input->post('user_date_birth');
        $user_subscribe = $this->input->post('user_subscribe');
        if( $full_name ) $data_update['user_display_name']      = $full_name;
        if( $email ) $data_update['email']                      = $email;
        if( $address ) $data_update['address']                  = $address;
        if( $province_id ) $data_update['province_id']          = $province_id;
        if( $city_id ) $data_update['city_id']                  = $city_id;
        if( $postal_code ) $data_update['postal_code']          = $postal_code;
        if( $user_gender ) $data_update['user_gender']          = $user_gender;
        if( $user_date_birth ) $data_update['user_date_birth']  = $user_date_birth;
        if( $user_subscribe ) {
            $data_update['user_subscribe']    = $user_subscribe;
        }else{
            $data_update['user_subscribe']    = '0';
        }
        if( $password ) $data_update['password']                = $this->apiModel->encryptPassword($password);
        if( $new_username && $user->username != $new_username ) {
            $this->db->where('username', $new_username);
            $exist = $this->db->get('tb_user',1)->num_rows();
            if( $exist ) json_response("Username Exist", 400);
            $data_update['username'] = $new_username;
        }
        if( $data_update ){
            $this->db->where('id', $user->id);
            $this->db->update('tb_user', $data_update);
        }
        json_response('Success');

    }

    protected function _fcm_post()
    {
        $_POST = json_decode(file_get_contents('php://input'), true);
        $this->form_validation->set_rules('token', 'token', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            json_response(  strip_tags(validation_errors()), 400 );
        }else{
            $jwt    = $this->apiModel->jwtAuth();
            $token  = $this->input->post('token');
            $this->apiModel->addFCM($jwt->data->id, $token);
            json_response('Success');
        }
    }

    protected function _user_photo_post()
    {
        $jwt    = $this->apiModel->jwtAuth();
        if( !empty($_FILES) ){
            $config['upload_path']          = 'assets/uploads/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 1024 * 10;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('file'))
            {
                json_response( strip_tags($this->upload->display_errors()), 400 );
            } else {
                $upload = $this->upload->data();
                $file_name = $upload['file_name'];
                $data_update = array(
                    'user_avatar' => $file_name
                );
                $this->userModel->update($jwt->data->id, $data_update);
                json_response(base_url("assets/uploads/$file_name"));
            }
        }else{
            json_response( "Photo is required", 404 );
        }
    }

    protected function _user_get()
    {
        $_POST = json_decode(file_get_contents('php://input'), true);
        $jwt    = $this->apiModel->jwtAuth();
        $user = $this->userModel->getByID( $jwt->data->id );
        json_response($user);
    }

    public function index()
    {
        $method = $this->apiModel->detectMethod();
        switch ($method){
            case 'post':
                $this->_user_post();
                break;
            case 'put':
                $this->_user_put();
                break;
            case 'get':
                $this->_user_get();
                break;
            default:
                json_response('Not Allowed', 405);
        }
    }

    public function login()
    {
        $_POST = json_decode(file_get_contents('php://input'), true);
        $identity = trim($this->input->post('identity'));
        $password = trim($this->input->post('password'));
        $exist = $this->ion_auth->login($identity, $password);
        if( $exist ){
            if( filter_var($identity, FILTER_VALIDATE_EMAIL) ){
                $user = $this->userModel->getByEmail($identity);
            }else{
                $user = $this->userModel->getByUsername($identity);
            }
            $user->user_avatar = base_url('img/load/png2/300/300/'.$user->user_avatar);
            $jwt = $this->apiModel->jwtEncode( $user->id );
            json_response( $jwt );
        }else{
            json_response(strip_tags($this->ion_auth->errors()), 401);
        }
    }

    public function fcm()
    {
        $method = $this->apiModel->detectMethod();
        switch ($method){
            case 'post':
                $this->_fcm_post();
                break;
            default:
                json_response('Not Allowed', 405);
        }
    }

    public function forgot()
    {
        $method = $this->apiModel->detectMethod();
        switch ($method){
            case 'post':
                $_POST = json_decode(file_get_contents('php://input'), true);
                $email = $this->input->post('email');
                $user = $this->userModel->getByEmail($email);
                if( !$user ) json_response('User Not Found', 403);
                json_response('Silahkan cek email anda untuk atur password baru');
                break;
            default:
                json_response('Not Allowed', 405);
        }
    }

    public function photo()
    {
        $method = $this->apiModel->detectMethod();
        switch ($method){
            case 'post':
                $this->_user_photo_post();
                break;
            default:
                json_response('Not Allowed', 405);
        }
    }

    public function logout()
    {
        $method = $this->apiModel->detectMethod();
        switch ($method){
            case 'get':
                $jwt    = $this->apiModel->jwtAuth();
                $user   = $this->userModel->getByID( $jwt->data->id );
                $this->apiModel->removeFCM($user->id);
                json_response("Sucessfulyl Logout");
                break;
            default:
                json_response('Not Allowed', 405);
        }
    }

    public function refresh_token()
    {
        $method = $this->apiModel->detectMethod();
        switch ($method){
            case 'post':
                $_POST = json_decode(file_get_contents('php://input'), true);
                $this->form_validation->set_rules('user_id', 'user ID', 'required');
                $this->form_validation->set_rules('refresh_token', 'refresh token', 'required');
                if ($this->form_validation->run() == FALSE)
                {
                    json_response(  strip_tags(validation_errors()), 400 );
                }else{
                    $userId = $this->input->post('user_id');
                    $token  = $this->input->post('refresh_token');
                    $valid  = $this->apiModel->validToken( $userId, $token );
                    if( !$valid ) json_response('Forbidden', 403);
                    $jwt    = $this->apiModel->jwtEncode( $userId );
                    json_response( $jwt );
                }
                break;
            default:
                json_response('Not Allowed', 405);
        }
    }

}
