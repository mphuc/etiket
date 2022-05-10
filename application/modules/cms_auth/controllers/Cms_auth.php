<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @property CI_Form_validation form_validation
 * @property CI_Input input
 * @property CI_Parser parser
 * @property Ion_auth|Ion_auth_model ion_auth
 * @property Ion_auth|Ion_auth_model Ion_auth_model
 * @property M_base_config M_base_config
 * @property base_config base_config
 * @property CI_Lang lang
 * @property CI_URI uri
 * @property CI_DB_query_builder|CI_DB_mysqli_driver db
 * @property CI_Config config
 * @property CI_User_agent agent
 * @property CI_Email email
 * @property Base_config Base_config
 * @property Slug slug
 * @property CI_Loader load
 * @property CI_Session session
 * @property Setting setting
 * @property UserModel userModel
 */
class Cms_auth extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('auth');
        $this->load->model('userModel');
     }

    public function index()
    {
        $this->M_base_config->ifLogin();
        $data = $this->base_config->panel_setting();

        if(  @$_SERVER['HTTP_HOST'] == 'localhost' || filter_var( @$_SERVER['HTTP_HOST'], FILTER_VALIDATE_IP) ){
            $data['button_google'] = null;
        }
        else{
            $data['button_google'] = $this->_loginGoogle();
        }

        $this->form_validation->set_rules('identity', 'Identity', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == true)
        {
            $remember = (bool) $this->input->post('remember');
            $identity = $this->input->post('identity');
            $password = $this->input->post('password');
            if ($this->ion_auth->login($identity, $password, $remember))
            {
                if( filter_var($identity, FILTER_VALIDATE_EMAIL) ){
                    $userDB = $this->userModel->getByEmail($identity);
                }else{
                    $userDB = $this->userModel->getByUsername($identity);
                }
                $groups = $this->userModel->getGroupsByUserid($userDB->id);
                if( in_array('members', $groups) && count($groups) == 1 ){ //members cannot access dashboard
                    $this->session->sess_destroy();
                    $this->session->set_flashdata('message', "You are not allowed to access this page!");
                }else{
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                }
                redirect('cms', 'refresh');
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('cms/auth', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        } else {
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
                if(!empty($data['message'])) {
                    $info = "md-input-danger";           
                }else {
                    $info = "";    
                }
            $data['identity'] = array('name' => 'identity',
                'id'    => 'username',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('identity'),
                'class' => 'md-input '.$info
            );
            $data['password'] = array('name' => 'password',
                'id'   => 'password',
                'type' => 'password',
                'class' => 'md-input '.$info
            );

            $data['asset'] = $this->base_config->asset_back();
            $data['nav'] = 'no';
            $data['viewspage'] = 'auth';
            $this->parser->parse('auth', $data);
        }
    }

    public function reset_password()
    {
        if( $_POST ){
            $this->form_validation->set_rules('code', 'code', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if ($this->form_validation->run() == true)
            {
                $code = $this->input->post('code');
                $password = $this->input->post('password');
                $user = $this->ion_auth->forgotten_password_check($code);
                $this->ion_auth->clear_forgotten_password_code($code);
                $this->userModel->update($user->id, array('password' => $this->_encrypt_password($password)));
                $this->session->set_flashdata('message', 'Success reset password');
                redirect('cms/auth', 'refresh');
            }else{
                $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
                if(!empty($data['message'])) {
                    $info = "md-input-danger";
                }else {
                    $info = "";
                }
                redirect("cms/auth", 'refresh');
            }
        }
        $code = $this->input->get('code');
        if( !$code ) redirect('cms/auth', 'refresh');
        $user = $this->ion_auth->forgotten_password_check($code);
        if ($user) {  //if the reset worked then send them to the login page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            $data = $this->base_config->panel_setting();
            $data['password'] = array('name' => 'password',
                'id'    => 'password',
                'type'  => 'password',
                'class' => 'md-input'
            );
            $data['code'] = $code;
            $data['asset'] = $this->base_config->asset_back();
            $data['nav'] = 'no';
            $data['viewspage'] = 'reset';
            $this->parser->parse('reset', $data);
        }
        else { //if the reset didnt work then send them back to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("cms/auth", 'refresh');
        }
    }

    public function forgot()
    {
        if( $_POST ) {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('message', validation_errors('<div class="alert alert-danger" role="alert">', '</div>'));
            } else {
                $email = $this->input->post('email');
                if ($this->ion_auth->email_check($email)) {
                    $forgotten = $this->ion_auth->forgotten_password($email);
                    if ($forgotten) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kode Reset berhasil dikirim, silahkan cek email</div>');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->ion_auth->errors() . '</div>');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kode Reset gagal dikirim, email belum terdaftar</div>');
                }
            }
        }
        redirect('cms/auth', 'refresh');
    }

    public function logout()
    {
        $data['title'] = "Logout";
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('cms/auth', 'refresh');
    }

    protected function _loginGoogle()
    {
        $this->config->load('google');
        $clientId       = $this->config->item('google_client_id');;
        $clientSecret   = $this->config->item('google_client_secret');;
        $redirectURL    = base_url('cms/auth');

        $gClient = new Google_Client();
        $gClient->setApplicationName('tv9');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectURL);
        $gClient->addScope(array('email','profile'));
        $google_oauthV2 = new Google_Service_Oauth2($gClient);
        if(isset($_GET['code'])){
            $gClient->authenticate($_GET['code']);
            $_SESSION['token'] = $gClient->getAccessToken();
            header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
        }
        if (isset($_SESSION['token'])) {
            $gClient->setAccessToken($_SESSION['token']);
        }
        if ($gClient->getAccessToken()) {
            try{
                $gpUserProfile = $google_oauthV2->userinfo->get();
            }
            catch (Exception $e){
                $this->session->sess_destroy();
                echo $e->getMessage();
                exit();
            }
            $gpUserData = array(
                'oauth_provider'        => 'google',
                'oauth_uid'             => $gpUserProfile['id'],
                'first_name'            => $gpUserProfile['given_name'],
                'last_name'             => $gpUserProfile['family_name'],
                'email'                 => $gpUserProfile['email'],
                'gender'                => $gpUserProfile['gender'],
                'locale'                => $gpUserProfile['locale'],
                'picture'               => $gpUserProfile['picture'],
                'link'                  => $gpUserProfile['link']
            );
            $userData = $gpUserData;
            $userDB = $this->userModel->getByEmail($userData['email']);
            if( !$userDB ){
                $groupID = $this->userModel->getSingleGroupIDbyName('loket');
                $fullName = $userData['first_name'].' '.$userData['last_name'];
                $config = array(
                    'field' => 'username',
                    'title' => 'user_display_name',
                    'table' => 'tb_user',
                    'id'    => 'id',
                );
                $this->load->library('slug', $config);
                $uniqueUsername = $this->slug->create_uri( $fullName );
                $userPhoto = 'avatar.png';
                try{
                    $file = file_get_contents($userData['picture']);
                    $userPhoto = md5($uniqueUsername).'.jpg';
                    $saveDirPath = 'assets/uploads/'.$userPhoto;
                    file_put_contents($saveDirPath, $file);
                }catch (Exception $e){
                    $userPhoto = 'avatar.png';
                }
                $ip = $this->input->ip_address();
                $dataToInsert = [
                    'password'              => $this->_encrypt_password(time()),
                    'email'                 => $userData['email'],
                    'user_display_name'     => $fullName,
                    'user_avatar'           => $userPhoto,
                    'last_login'            => time(),
                    'created_on'            => time(),
                    'user_google_plus'      => $userData['link'],
                    'username'              => $uniqueUsername,
                    'ip_address'            => $ip,
                    'user_current_location' => $this->userModel->getLocation($ip),
                    'active'                => 0, //todo force user inactive status
                ];
                $this->db->insert('tb_user',$dataToInsert);
                $insert_id = $this->db->insert_id();
                $this->ion_auth->remove_from_group(null, $insert_id);
                $this->ion_auth->add_to_group(array($groupID), $insert_id);
                //$userDB = $this->userModel->getByID($insert_id);
                $this->session->set_flashdata('message', "Please contact administrator to activated your account!");
            }else{
                if( $userDB->active ){
                    $groups = $this->userModel->getGroupsByUserid($userDB->id);
                    if( in_array('members', $groups) && count($groups) == 1 ){  //members cannot access dashboard
                        $this->session->set_flashdata('message', "You are not allowed to access this page!");
                    }else{
                        $this->session->set_userdata('identity', $userDB->email);
                        $this->session->set_userdata('username', $userDB->username);
                        $this->session->set_userdata('email', $userDB->email);
                        $this->session->set_userdata('user_id', $userDB->id);
                        $this->session->set_userdata('old_last_login', time());
                    }
                }else{
                    $this->session->set_flashdata('message', "Please contact administrator to activated your account!");
                }
            }
            return $gClient->createAuthUrl();
        } else {
            return $gClient->createAuthUrl();
        }
    }

    protected function _encrypt_password($password)
    {
        $this->load->model('Ion_auth_model');
        $salt = $this->Ion_auth_model->store_salt ? $this->Ion_auth_model->salt() : FALSE;
        return $this->Ion_auth_model->hash_password($password, $salt);
    }
}