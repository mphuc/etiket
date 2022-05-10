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
 * @property    GateModel gateModel
 */
class Cms_report_barcode extends MX_Controller
{
    protected $table = 'tb_user_ticket';
    protected $subject = 'Data report_barcode';
    protected $module;
    protected $primary_key = 'ut_id';

    public function __construct()
    {
        parent::__construct();
        $this->module = str_replace('cms_', '', strtolower( get_class($this) ) );
        $this->load->model('gateModel');
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
        $data = $this->setting->get_all();
        $data['nastable'] = true;
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
        $data['pk'] = $this->primary_key;
        $data['gates'] = $this->gateModel->get();
        view_back( "cms_$this->module/views/v_list", $data);
    }

    public function get()
    {
        $this->role();
        $date = $this->input->get('date');
        $gate = $this->input->get('gate');
        if( $date ) $this->db->where('DATE(ut_created)', $date);
        if( $gate ) $this->db->where('ut_gate', $gate);
        $this->db->select('us.username,ut.ut_barcode,ut.ut_gate,ut.ut_created, COUNT(ut_barcode) as count');
        $this->db->join('tb_user_barcode ub','ub.ub_barcode=ut.ut_barcode','left');
        $this->db->join('tb_user us','us.id=ub.user_id','left');
        $this->db->group_by('ut_barcode');
        $this->db->group_by('ut_gate');
        $data = $this->db->get( $this->table.' ut' )->result_array();
        json_response(  $data );
    }
}