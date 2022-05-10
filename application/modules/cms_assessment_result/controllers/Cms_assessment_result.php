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
class Cms_assessment_result extends CI_Controller {
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
            $umbrella   = $this->base_config->groups_access('assessment_result');

            $umbrella->set_theme('twitter-bootstrap')
                     ->set_table('tb_assessment_result')
                     ->set_subject('Laporan Penilaian')
                     ->where('assessment_result_type','emot')
                     ->columns('location_rate_id','assessment_list_id','assessment_result_value','assessment_date','check_location')
                     ->set_relation('location_rate_id', 'tb_location_rate', 'location_rate_name')  
                     ->set_relation('assessment_list_id', 'tb_assessment_list', 'assessment_list_name')  
                     ->display_as('location_rate_id','Nama Wahana') 
                     ->display_as('assessment_list_id','Penilaian')   
                     ->display_as('assessment_result_value','Nilai')  
                     ->display_as('assessment_date','Tanggal')   
                     ->set_relation('location_rate_id','tb_location_rate','location_rate_name')
                     ->order_by('assessment_date','desc')
                     ->unset_export()
                     ->unset_print()
                     ->unset_add()
                     ->unset_edit()
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
    public function _penerima_pembayaran_id($value, $row)
    {
        return '<input type="checkbox" class="removelist" value="' . $row->assessment_list_id . '" name="' . $row->assessment_list_id . '" id="' . $row->assessment_list_id . '" data-md-icheck />';
    }
}