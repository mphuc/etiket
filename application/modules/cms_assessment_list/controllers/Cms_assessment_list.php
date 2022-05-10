<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
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
 */
class Cms_assessment_list extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        // load base config library
        date_default_timezone_set('Asia/Jakarta');
       
        //load not all reqruitment library
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        // load lang
        $this->lang->load('auth');
        //Instance class to make amazing fitur
    	}
    public function index()
    {
       try {
            //cek auth
            $this->M_base_config->cekaAuth();
            $data       = $this->base_config->panel_setting();
            $umbrella   = $this->base_config->groups_access('assessment_list');

            $umbrella->set_theme('twitter-bootstrap')
                     ->set_table('tb_assessment_list')
                     ->set_subject('Nilai Peringkat')
                     ->columns('assessment_list_name','assessment_list_nilai','check_location')
                     ->order_by('assessment_list_id','desc')
                     ->unset_texteditor('location','full_text')
                     ->field_type('assessment_list_nilai', 'integer',3)
                     ->set_field_upload('assessment_list_pic', 'assets/uploads/')
                     ->unset_export()
                     ->unset_print()
                     ->add_fields('assessment_list_name','assessment_list_nilai','assessment_list_pic')
                     ->edit_fields('assessment_list_name','assessment_list_nilai','assessment_list_pic')
                     ->display_as('check_location', '<input type="checkbox" name="removeall" id="removeall" data-md-icheck />')
                     ->callback_column('check_location', array($this, '_penerima_pembayaran_id'));
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
    public function _callback_setting_value($value, $row)
    {
       $this->M_base_config->cekaAuth(); 
       $return = '<div class="text-left"><a href="'.base_url().'img/load/100/100/full/'.$value.'" class="image-thumbnail"><img src="'.base_url().'img/load/100/10/full/'.$value.'"  alt=""></a></div>';
     
      return $return;
    }
    
    public function _penerima_pembayaran_id($value, $row)
    {
        return '<input type="checkbox" class="removelist" value="' . $row->assessment_list_id . '" name="' . $row->assessment_list_id . '" id="' . $row->assessment_list_id . '" data-md-icheck />';
    }
}