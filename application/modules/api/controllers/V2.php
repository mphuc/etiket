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

class V2 extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('apiModel');
        $this->load->model('termModel');
        $this->load->model('userModel');
        $this->config->load('google');
    }

    public function auth($uri=null)
    {
        switch ($uri){
            case 'refresh_token':
                $this->auth_refresh_token();
                break;
            default:
                json_response('Not Allowed', 405);
        }
    }

    protected function auth_refresh_token()
    {
        $method = $this->apiModel->detectMethod();
        switch ($method){
            case 'get':
                $userId = $this->input->get('user_id');
                $token  = $this->input->get('refresh_token');
                $valid  = $this->apiModel->validToken( $userId, $token );
                if( !$valid ) json_response('Forbidden', 403);
                $jwt  = $this->apiModel->jwtEncode( $userId );
                json_response( $jwt );
                break;
            default:
                json_response('Not Allowed', 405);
        }
    }
}