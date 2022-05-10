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
 * @property    ProductModel productModel
 * @property    CategoryModel categoryModel
 */
class Cms_discount_package extends MX_Controller
{
    protected $table = 'tb_member_card_package';
    protected $subject = 'Data discount_package';
    protected $module;
    protected $primary_key = 'mp_id';

    public function __construct()
    {
        parent::__construct();
        $this->module = str_replace('cms_', '', strtolower( get_class($this) ) );
        $this->load->model('productModel');
        $this->load->model('categoryModel');
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
            $id = $this->input->post('product_package_id');
            $mp_discount = $this->input->post('mp_discount');
            $combinations = $this->input->post('combinations');
            $dataInsert = [];
            foreach ($combinations as $v) {
                $this->db->where('product_package_id', $id);
                $this->db->where('product_combination_id', $v);
                $this->db->delete($this->table);
                $dataInsert[] = [
                    'product_package_id'        => $id,
                    'product_combination_id'    => $v,
                    'mp_discount'               => $mp_discount
                ];
            }
            $this->db->insert_batch($this->table, $dataInsert);
            json_response( 'Sukses' );
        }
        $data['nastable'] = true;
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
        $data['pk'] = $this->primary_key;
        $data['products'] = $this->productModel->get();
        $data['disc'] = $this->db->order_by('dp_name','asc')->get('tb_discount_product')->result_array();
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
        $data['products'] = $this->productModel->get();
        $data['disc'] = $this->db->order_by('dp_name','asc')->get('tb_discount_product')->result_array();
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
        $this->db->select("p.dp_name as product_package,pd.product_title as product_combination, $this->table.*");
        $this->db->join('tb_discount_product p',"p.dp_id=$this->table.product_package_id","left");
        $this->db->join('tb_product pd',"pd.product_id=$this->table.product_combination_id","left");
        $this->db->order_by('p.dp_name','asc');
        $this->db->order_by('pd.product_title','asc');
        $data = $this->db->get( $this->table, $limit, $page)->result_array();
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
        $this->db->join('tb_discount_product p',"p.dp_id=$this->table.product_package_id","left");
        $this->db->join('tb_product pd',"pd.product_id=$this->table.product_combination_id","left");
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
}