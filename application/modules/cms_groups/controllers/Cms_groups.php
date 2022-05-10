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
 * @property    UserModel userModel
 */
class Cms_groups extends MX_Controller
{
    protected $table = 'tb_groups';
    protected $subject = 'Data group';
    protected $module;
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->module = str_replace('cms_', '', strtolower( get_class($this) ) );
        $this->load->model('userModel');
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
        view_back( "cms_$this->module/views/v_list", $data);
    }

    public function add()
    {
        $this->role();
        $data = $this->setting->get_all();
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ){
            $roles = $_POST['roles'];
            unset($_POST['roles']);
            $this->db->insert( $this->table, $_POST );
            $id = $this->db->insert_id();
            $this->userModel->roleUpdate($id, $roles);
            json_response( 'Sukses' );
        }
        $data['nastable'] = true;
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
        $data['pk']     = $this->primary_key;
        $data['roles']  = $this->setting->roles();
        view_back( "cms_$this->module/views/v_add", $data);
    }

    public function edit()
    {
        $this->role();
        $id = $this->uri->segment(4);
        $data = $this->setting->get_all();
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ){
            $roles = $_POST['roles'];
            unset($_POST['roles']);
            $id = $_POST[$this->primary_key];
            $this->db->where($this->primary_key, $id );
            $this->db->update( $this->table, $_POST );
            $this->userModel->roleUpdate($id, $roles);
            json_response( 'Sukses' );
        }

        $this->db->where( $this->primary_key, $id );
        $results = $this->db->get( $this->table, 1 )->row_array();
        $data['nastable'] = true;
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
        $data['row'] = $results;
        $data['pk'] = $this->primary_key;
        $data['roles']  = $this->setting->roles();
        $data['selected_roles'] = $this->userModel->roleByGroupId($id);
        view_back( "cms_$this->module/views/v_edit", $data);
    }

    public function get()
    {
        $this->role();
        $search = $this->input->get('q');
        $column = $this->input->get('col');
        if( isset($search) && $column ){
            $this->db->like($column, $search);
        }
        $data = $this->db->get( $this->table)->result_array();
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
        $this->role();
        $id = $this->uri->segment(4);
        if( $id ){
            $ids = explode('-', $id);
            $this->db->where_in( $this->primary_key, $ids);
            $this->db->delete($this->table);
            json_response( 'Sukses menghapus data' );
        }else{
            json_response( 'Gagal menghapus data, Silahkan ulangi lagi!', 400 );
        }
    }

    public function assign()
    {
        $this->role();
        $id    = $this->uri->segment(4);
        $data  = $this->setting->get_all();
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ){
            $groupId = $this->input->post('id');
            $userId  = $this->input->post('user');
            $this->userModel->assignGroupToUser($userId, $groupId);
            json_response( 'Sukses' );
        }
        $data['nastable'] = true;
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
        $data['pk']     = $this->primary_key;
        $this->db->where( $this->primary_key, $id );
        $results = $this->db->get( $this->table, 1 )->row_array();
        if( !$results ) show_404();
        $data['row'] = $results;
        view_back( "cms_$this->module/views/v_assign", $data);
    }

    public function users()
    {
        $this->role();
        $search = $this->input->get('q');
        $column = 'username';
        $limit  = 50;
        if( isset($search) && $column ){
            $this->db->group_start();
            $this->db->like($column, $search);
            $this->db->group_end();
        }
        $this->db->select('id, username as text');
        $this->db->where('active','1');
        $this->db->order_by('username','asc');
        $this->db->order_by('id','desc');
        $data = $this->db->get( 'tb_user', $limit)->result_array();
        json_response(  $data );
    }


}