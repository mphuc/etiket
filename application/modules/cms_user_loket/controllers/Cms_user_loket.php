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
 * @property    UserModel userModel
 */
class Cms_user_loket extends MX_Controller
{
    protected $table = 'tb_user';
    protected $subject = 'user loket';
    protected $module;
    protected $group = 'loket';

    public function __construct()
    {
        parent::__construct();
        $this->module = str_replace('cms_', '', strtolower( get_class($this) ) );
        $this->load->model('userModel');
    }

    protected function role()
    {
        $this->M_base_config->cekaAuth();
        if( $this->base_config->groups_access_sigle('menu', $this->module) ) show_404();
    }

    protected function get_primary_key()
    {
        $fields = $this->get_fields();
        $filter = array_filter($fields,function ($element){
            if(isset( $element->primary_key ) && $element->primary_key == 1) return true;
            return false;
        });
        return reset($filter);
    }

    protected function get_enum ($table_name, $field_name)
    {
        $sql = "desc {$table_name} {$field_name}";
        $st = $this->db->query($sql);

        if ($st->result())
        {
            $row = $st->row();
            if ($row === FALSE)
                return FALSE;

            $type_dec = $row->Type;
            if (substr($type_dec, 0, 5) !== 'enum(')
                return FALSE;

            $values = array();
            foreach(explode(',', substr($type_dec, 5, (strlen($type_dec) - 6))) AS $v)
            {
                array_push($values, trim($v, "'"));
            }

            return $values;
        }
        return FALSE;
    }

    protected function get_fields()
    {
        $show = array(); //show field
        $fields = null;
        foreach ($this->db->field_data($this->table) as $k => $item) {
            if( count($show) > 0 ){
                if( in_array($item->name,$show) || $item->primary_key==1 ){
                    $fields[$k] = $item;
                    if( $item->type == 'enum' ){
                        $fields[$k]->data = $this->get_enum($this->table, $item->name);
                    }
                }
            }else{
                $fields[$k] = $item;
                if( $item->type == 'enum' ){
                    $fields[$k]->data = $this->get_enum($this->table, $item->name);
                }
            }
        }
        return $fields;
    }

    public function index()
    {
        $this->role();
        $data = $this->setting->get_all();
        $data['nastable'] = true;
        $fields = $this->get_fields();
        $data['fields'] = $fields;
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
        $data['pk'] = $this->get_primary_key()->name;
        $data['cabang'] = "STUDIO ALAM TV9";
        echo view_back( "cms_$this->module/views/v_list", $data);
    }

    public function add()
    {
        $this->role();
        $data = $this->setting->get_all();
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ){
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tb_user.email]');
            $this->form_validation->set_rules('user_mobile', 'Mobile', 'is_unique[tb_user.user_mobile]');
            $this->form_validation->set_rules('password', 'Kata Sandi', 'required');
            if ($this->form_validation->run() == FALSE)
            {
                json_response( ['status' => 0, 'message' => validation_errors() ] );
            }
            else
            {
                $groupID = $this->db->where('name', $this->group)->get('tb_groups',1)->row('id');
                if( !@$_POST['user_avatar'] ) $_POST['user_avatar'] = 'avatar.png';
                $password = $this->input->post('password');
                $_POST['created_on'] = time();
                $_POST['last_login'] = time();
                $_POST['password'] = $this->_encrypt_password($password);
                $this->db->insert( $this->table, $_POST );
                $insert_id = $this->db->insert_id();
                $this->ion_auth->remove_from_group(null, $insert_id);
                $this->ion_auth->add_to_group(array($groupID), $insert_id);
                json_response( ['status' => 1, 'message' => 'Sukses' ] );
            }

        }
        $fields = $this->get_fields();

        foreach ($fields as $k => $field) {
            if( $field->name == 'image' ){
                $fields[$k]->type = 'upload';
            }
        }

        $data['nastable'] = true;
        $data['fields'] = $fields;
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
        $data['pk'] = $this->get_primary_key()->name;
        $data['cabang'] = "STUDIO ALAM TV9";
        echo view_back( "cms_$this->module/views/v_add", $data);
    }

    public function edit()
    {
        $this->role();
        $id = $this->uri->segment(4);
        $data = $this->setting->get_all();
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ){
            $id = $_POST[$this->get_primary_key()->name];
            $password = $this->input->post('password');
            if( $password ){
                $_POST['password'] = $this->_encrypt_password($password);
            }
            $this->db->where($this->get_primary_key()->name, $id );
            $query = $this->db->update( $this->table, $_POST );
            json_response( ['status' => $query, 'message' => 'Sukses' ] );
        }

        $this->db->where( $this->get_primary_key()->name, $id );
        $results = $this->db->get( $this->table,1 )->row_array();
        $fields = $this->get_fields();

        foreach ($fields as $k => $field) {
            if( $field->name == 'image' ){
                $fields[$k]->type = 'upload';
            }
        }
        $data['nastable'] = true;
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
        $data['fields'] = $fields;
        $data['row'] = $results;
        $data['pk'] = $this->get_primary_key()->name;
        $data['cabang'] = "STUDIO ALAM TV9";
        echo view_back( "cms_$this->module/views/v_edit", $data);
    }

    public function get()
    {
        $this->role();
        $this->db->select('g.name as group_name,ug.user_id,ug.group_id');
        $this->db->join('tb_groups g','g.id=ug.group_id');
        $allGroup = $this->db->get('tb_users_groups ug')->result();

        $userIDs = $this->userModel->getByGroup($this->group);

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
            $this->db->group_start();
            $this->db->like($column, $search);
            $this->db->group_end();
        }
        $this->db->where_in('id', $userIDs);
        $this->db->order_by('username','asc');
        $data = $this->db->get( $this->table, $limit, $page)->result_array();
        foreach ($data as $k => $v) {
            $currentGroups = array_values(array_filter($allGroup, function ($el)use($v){
                return $el->user_id == $v['id'];
            }));
            $data[$k]['groups'] = $currentGroups;
            $data[$k]['created_on'] = date('Y-m-d H:i:s', $v['created_on']);
            $data[$k]['last_login'] = date('Y-m-d H:i:s', $v['last_login']);
        }
        json_response( ['status' => 1, 'message' => $data] );
    }

    public function rows()
    {
        $this->role();
        $userIDs = $this->userModel->getByGroup($this->group);
        $search = $this->input->get('q');
        $column = $this->input->get('col');
        if( isset($search) && $column ){
            $this->db->group_start();
            $this->db->like($column, $search);
            $this->db->group_end();
        }
        $this->db->where_in('id', $userIDs);
        $rows = $this->db->count_all_results($this->table);
        json_response( ['status' => 1, 'message' => $rows] );
    }

    public function delete()
    {
        $this->role();
        $id = $this->uri->segment(4);
        if( $id ){
            $ids = explode('-', $id);
            $this->db->where_in( $this->get_primary_key()->name, $ids);
            $q = $this->db->delete($this->table);
            json_response( ['status' => $q, 'message' => 'Sukses menghapus data'] );
        }else{
            json_response( ['status' => 0, 'message' => 'Gagal menghapus data, Silahkan ulangi lagi!'] );
        }
    }

    public function columns()
    {
        $this->role();
        json_response( $this->get_fields() );
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
                $query = 1;
                json_response( ['status' => $query, 'message' => $this->upload->data() ] );
            }

        }else{
            $file_name = $this->uri->segment(4);
            if( $file_name ){
                $souce = FCPATH.'assets/uploads/'.$file_name;
                if( file_exists($souce) ) unlink($souce);
            }
            json_response( ['status' => 1, 'message' => 'Sukses'] );
        }
    }

    protected function _encrypt_password($password)
    {
        $this->load->model('Ion_auth_model');
        $salt = $this->Ion_auth_model->store_salt ? $this->Ion_auth_model->salt() : FALSE;
        return $this->Ion_auth_model->hash_password($password, $salt);
    }


}