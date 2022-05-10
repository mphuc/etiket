<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property    M_base_config M_base_config
 * @property    base_config base_config
 * @property    Ion_auth|Ion_auth_model ion_auth
 * @property    CI_Lang lang
 * @property    CI_URI uri
 * @property    CI_DB_query_builder $db
 * @property    CI_Config config
 * @property    CI_Input input
 * @property    CI_User_agent $agent
 * @property    Slug slug
 * @property    CI_Security security
 * @property    Setting setting
 * @property    CI_Parser parser
 * @property    CI_Upload upload
 * @property    CI_Loader load
 * @property    VendorModel vendorModel
 * @property    TicketModel ticketModel
 */

class Cms_test_email extends MX_Controller
{
    
    protected $module;

    public function __construct()
    {
        parent::__construct();
        $this->module = str_replace('cms_', '', strtolower( get_class($this) ) );
        $this->load->model('vendorModel');
        $this->load->model('ticketModel');
    }

    protected function role($type=null)
    {
        $this->M_base_config->cekaAuth();
        if( $type ){
            if( $this->base_config->groups_access_sigle($this->module, $type) ) show_404();
        }else{
            if( $this->base_config->groups_access_sigle('menu', $this->module) ) show_404();
        }
    }

	public function index()
	{
		$this->role();
        
        view_back( "cms_$this->module/views/index");
	}

	public function process_kirim()
	{
		$emailnya = $this->input->post('emailnya');
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');
		$smtp = $this->smtp();

		$config = array(
			'protocol' => $smtp['protocol'],
			'smtp_host' => $smtp['smtp_host'],
			'smtp_port' => $smtp['smtp_port'],
			'smtp_user' => $smtp['smtp_user'],
			'smtp_pass' => $smtp['smtp_pass'],
			'mailtype'  => $smtp['mailtype'],
			'wordwrap'  => TRUE,
			'charset'   => $smtp['charset']
		);

		$this->email->initialize($config);
		$this->email->set_newline("\r\n");

		$this->email->from($smtp['smtp_user'], $smtp['smtp_name']);

		$this->email->to($emailnya);
		$this->email->subject($subject);
		$this->email->message($message);

		//Send mail 
		if ($this->email->send()) {
			echo 'sukses';
		} else {
			echo $this->email->print_debugger();
		}
	}

    public function smtp()
	{
		$config = array();

		$config['protocol']       = $this->setting->get_single('setting_email', 'protocol');
		$config['smtp_host']      = $this->setting->get_single('setting_email', 'smtp_host');
		$config['smtp_port']      = $this->setting->get_single('setting_email', 'smtp_port');
		$config['smtp_user']      = $this->setting->get_single('setting_email', 'smtp_user');
		$config['smtp_pass']      = $this->setting->get_single('setting_email', 'smtp_pass');
		$config['smtp_name']      = $this->setting->get_single('setting_email', 'smtp_name');
		$config['mailtype']       = $this->setting->get_single('setting_email', 'mailtype');
		$config['charset']        = $this->setting->get_single('setting_email', 'charset');

		return $config;
	}
}