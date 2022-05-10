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
 * @property    FrontendModel frontendModel
 */
class Cms_available_date extends MX_Controller
{
    protected $table = 'tb_holiday';
    protected $subject = 'Data Hari Buka Dan Tutup';
    protected $module;
    protected $primary_key = 'holiday_id';

    public function __construct()
    {
        parent::__construct();
        // check_admin();
        $this->module = str_replace('cms_', '', strtolower( get_class($this) ) );

        $this->load->model('FrontendModel');
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
        $data['nastable']   = true;
        $data['subject']    = $this->subject;
        $data['module']     = $this->module;
        $data['pk']         = $this->primary_key;
        $data['sun']        = $this->FrontendModel->getAvailableDay('sunday');
        $data['mon']        = $this->FrontendModel->getAvailableDay('monday');
        $data['tue']        = $this->FrontendModel->getAvailableDay('tuesday');
        $data['wed']        = $this->FrontendModel->getAvailableDay('wednesday');
        $data['thu']        = $this->FrontendModel->getAvailableDay('thursday');
        $data['fri']        = $this->FrontendModel->getAvailableDay('friday');
        $data['sat']        = $this->FrontendModel->getAvailableDay('saturday');
        view_back( "cms_$this->module/views/v_list", $data);
    }

    public function add()
    {
        // $this->role('add');
        // $data = $this->setting->get_all();
        // $_POST = json_decode(file_get_contents('php://input'), true);
        // if( $_POST ){
        //     $this->db->insert( $this->table, $_POST );
        //     json_response( 'Sukses' );
        // }
        // $data['nastable'] = true;
        // $data['subject'] = $this->subject;
        // $data['module'] = $this->module;
        // $data['pk'] = $this->primary_key;
        // view_back( "cms_$this->module/views/v_add", $data);

        $data = array(
            'holiday_desc' => $this->input->post('desc', true),
            'holiday_date' => $this->input->post('date', true),
        );

        $this->db->insert('tb_holiday', $data);

        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('success', 'Success Add Data !!');
        }

        else{
            $this->session->set_flashdata('failed', 'Failed Add Data !!');
        }

        redirect('cms/available_date');

    }

    public function edit()
    {
        $this->role('edit');
        $id = $this->uri->segment(4);
        $data = $this->setting->get_all();
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ){
            $id = $_POST[$this->primary_key];
            $this->db->where($this->primary_key, $id );
            $this->db->update( $this->table, $_POST );
            json_response( 'Sukses' );
        }

        $this->db->where( $this->primary_key, $id );
        $results = $this->db->get( $this->table, 1 )->row_array();
        $data['nastable'] = true;
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
        $data['row'] = $results;
        $data['pk'] = $this->primary_key;
        view_back( "cms_$this->module/views/v_edit", $data);
    }

    public function get()
    {
        $this->role();
        $limit = $this->input->get('limit');
        $page = $this->input->get('page');
        $search = $this->input->get('q');
        $column = $this->input->get('col');
        if( !$limit ) $limit=20;

        if( !$page ){
            $page = 0;
        }else{
            $page = ($page-1)*$limit;
        }
        if( isset($search) && $column ){
            $this->db->like($column, $search);
        }
        $this->db->order_by('holiday_date', 'desc');
        $data = $this->db->get( "$this->table", $limit, $page)->result_array();
        json_response(  $data );
    }

    public function rows()
    {
        $this->role();
        $search = $this->input->get('q');
        $column = $this->input->get('col');
        if( isset($search) && $column ){
            $this->db->like($column, $search);
        }
        $rows = $this->db->count_all_results($this->table);
        json_response( $rows );
    }

    public function delete()
    {
        // $this->role('delete');
        $id = $this->uri->segment(4);
        if( $id ){
            $ids = explode('-', $id);
            $this->db->where_in( $this->primary_key, $ids);
            $this->db->delete($this->table);
            // json_response( 'Sukses menghapus data' );
            $this->session->set_flashdata('success', 'Success Delete Data !!');
        }else{
            // json_response( 'Gagal menghapus data, Silahkan ulangi lagi!', 400 );
            $this->session->set_flashdata('failed', 'Failed Delete Data !!');
        }

        redirect('cms/available_date');
    }

    public function change(){
        $days   = $this->input->post('days', true);

        $data = array(
            'available_status' => $this->input->post('status', true)
        );

        $this->db->where('available_days', $days)
                    ->update('tb_available_date', $data);
        
        
    }
}