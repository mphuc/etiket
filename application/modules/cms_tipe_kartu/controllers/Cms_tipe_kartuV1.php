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
class Cms_tipe_kartu extends CI_Controller {
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
            $umbrella   = $this->base_config->groups_access('tipe_kartu');

            $umbrella->set_theme('twitter-bootstrap')
                     ->set_table('tb_card_type')
                     ->set_subject('Tipe Kartu')
                     ->columns('card_type_name','card_type_order','penerima_pembayaran_check')
                     ->order_by('card_type_order','asc')
                     ->unset_export()
                     ->unset_print()
                     ->add_fields('card_type_name','card_type_order', 'id_payee')
                     ->edit_fields('card_type_name','card_type_order')
                     ->display_as('card_type_name','Nama kartu')
                     ->display_as('card_type_order','Urutan Kartu')
                     ->display_as('id_payee','Payee')
                     ->set_relation('id_payee', 'tb_payee', 'payee_name')
                     ->display_as('penerima_pembayaran_check', '<input type="checkbox" name="removeall" id="removeall" data-md-icheck />')
                     ->callback_column('penerima_pembayaran_check', array($this, '_penerima_pembayaran_id'));
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
        return '<input type="checkbox" class="removelist" value="' . $row->card_type_id . '" name="' . $row->card_type_id . '" id="' . $row->card_type_id . '" data-md-icheck />';
    }
}