<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Cpanel_general extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        // load base config library
       
        //load not all reqruitment library
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        // load lang
        $this->lang->load('auth');
        //Instance class to make amazing fitur
    	}
    // redirect if needed, otherwise display the user list
    public function index()
    {
       try {
            //cek auth
            $this->M_base_config->cekaAuth();
            $data       = $this->base_config->panel_setting();
            $umbrella   = $this->base_config->groups_access('widgets');

            $umbrella->set_theme('twitter-bootstrap')
                     ->set_table('tb_setting')
                     ->set_subject('General Setting')
                     ->columns('setting_name','setting_value')
                     ->where('setting_type','setting_general')
                     ->order_by('setting_id','asc')
                     ->unset_texteditor('setting_value')
                     ->unset_export()->unset_print()->unset_add()
                     ->edit_fields('setting_value')
                     ->display_as('setting_value',lang('value'))->display_as('setting_name',lang('setting_name'))
                     ->callback_before_insert(array($this,'_set_callback_before_insert'))
                     ->callback_before_update(array($this,'_set_callback_before_update'))
                     ->callback_column('setting_desc',array($this,'_setting_status')) 
                     ->set_bulkactionfalse(true);
            $output = $umbrella->render();
            $data['asset'] = $this->base_config->asset_back();
            $data['viewspage'] = 'crud';
             $data['nav'] = 'yes';
            $this->base_config->_render_crud($data,$output);
       } catch (Exception $e) {
            show_error($e->getMessage());
       }
       
    }
    /*
    *
    *====================================================
    * Dibawah ini merupakan Method/ call back yang dibutuhkan oleh grocery sebagai setingan tambahan
    * Return 
    *====================================================
    *
    */
    
}