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
class Cms_barcode extends MX_Controller
{
    protected $table = 'tb_user_barcode';
    protected $subject = 'Data barcode';
    protected $module;
    protected $primary_key = 'ub_id';

    public function __construct()
    {
        parent::__construct();
        $this->module = str_replace('cms_', '', strtolower( get_class($this) ) );
        $this->load->model('userModel');
    }


    protected function generateRandomString($length = 10, $abc = "ABCDEFGHIJKLMNOPQRSTUVWXYZ")
    {
        return substr(str_shuffle($abc), 0, $length);
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
            $this->db->insert( $this->table, $_POST );
            json_response( 'Sukses' );
        }
        $data['nastable'] = true;
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
        $data['pk'] = $this->primary_key;
        $userIds = $this->userModel->get_group_excerp_members();
        $data['users'] = $this->userModel->getByIDs($userIds);
        $results = $this->db->select('user_id')->get($this->table)->result_array();
        $data['user_id_exist'] = array_column($results, 'user_id');
        $data['barcode'] = $this->generateRandomString();
        view_back( "cms_$this->module/views/v_add", $data);
    }

    public function edit()
    {
        $this->role();
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
        $this->db->join('tb_user us','us.id=bc.user_id','left');
        $data = $this->db->get( $this->table.' bc', $limit, $page)->result_array();
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

    public function upload()
    {
        $this->role();
        if( !empty($_FILES) ){
            $config['upload_path']          = 'assets/uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('file'))
            {
                json_response( ['status' => 0, 'message' => strip_tags($this->upload->display_errors()) ] );
            } else {
                json_response( $this->upload->data() );
            }
        }else{
            $file_name = $this->uri->segment(4);
            if( $file_name ){
                $souce = FCPATH.'assets/uploads/'.$file_name;
                if( file_exists($souce) ) unlink($souce);
            }
            json_response( 'Sukses' );
        }
    }
}