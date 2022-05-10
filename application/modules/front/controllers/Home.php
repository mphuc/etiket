<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @property M_base_config $M_base_config
 * @property base_config $base_config
 * @property Ion_auth|Ion_auth_model $ion_auth
 * @property CI_Lang $lang
 * @property CI_URI $uri
 * @property CI_DB_query_builder|CI_DB_mysqli_driver $db
 * @property CI_Config $config
 * @property CI_Input $input
 * @property CI_User_agent $agent
 * @property CI_Email $email
 * @property Mahana_hierarchy $mahana_hierarchy
 * @property CI_Form_validation $form_validation
 * @property CI_Session session
 * @property CI_Parser parser
 * @property CI_Upload upload
 * @property PostModel postModel
 */

class Home extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->lang->load('auth');
        $this->load->model('postModel');
    }

	public function _remap()
	{
		$segment_1 = $this->uri->segment(1);
		$segment_2 = $this->uri->segment(2);
        switch($segment_1){
        	case null:
			case false:
            case '':
                $this->index();
                break;
		    default:
                $this->index();
		        break;
		}
	}

    public function index()
    {
        redirect('cms');
    }

}
  