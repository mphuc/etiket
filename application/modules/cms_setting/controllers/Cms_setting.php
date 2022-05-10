<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property  M_base_config $M_base_config
 * @property  base_config $base_config
 * @property  Ion_auth|Ion_auth_model $ion_auth
 * @property  CI_Lang $lang
 * @property  CI_URI $uri
 * @property  CI_DB_query_builder $db
 * @property  CI_Config $config
 * @property  CI_Input $input
 * @property  CI_User_agent $agent
 * @property  Mahana_hierarchy $mahana_hierarchy
 * @property  Slug $slug
 * @property  CI_Security $security
 */
class Cms_setting extends MX_Controller
{
    protected $table = 'tb_setting';
    protected $subject = 'Setting';
    protected $module = 'setting';

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->lang->load('auth');
    }

    protected function role()
    {
        $this->M_base_config->cekaAuth();
        if( $this->base_config->groups_access_sigle('menu','setting') ) show_404();
    }

    public function index()
    {
        $this->role();
        $data=$this->base_config->panel_setting();
        $data['nastable'] = true;
        $data['asset'] = $this->base_config->asset_back();
        $data['setting'] =$this->base_config->front_setting();
        $data['nav'] = 'yes';
        $fields = $this->get_fields();
        $data['fields'] = $fields;
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
        $this->db->select('setting_type');
        $this->db->group_by('setting_type');
        $types = null;
        foreach ($this->db->get('tb_setting')->result_array() as $key => $item) {
            if( $item['setting_type'] != 'role_type' &&
                $item['setting_type'] != 'cpanel' &&
                $item['setting_type'] != 'front-customize' &&
                $item['setting_type'] != 'front-menus' &&
                $item['setting_type'] != 'front-widgets' &&
                $item['setting_type'] != 'setting_seo' &&
                $item['setting_type'] != 'front-theme' &&
                $item['setting_type'] != 'setting_general'
            ){
                $types[] = $item['setting_type'];
                $this->db->where('setting_type' , $item['setting_type']);
                if( $item['setting_type'] == 'setting_email' ){
                    $this->db->group_start();
                    $this->db->where_not_in('setting_name', array('charset','mailtype','protocol'));
                    $this->db->group_end();
                }
                $data['settings'][$item['setting_type']] = $this->db->get('tb_setting')->result_array();
            }
        }
        $data['types'] = $types;
        $this->parser->parse('angular/v_head', $data);
        $this->parser->parse('back/2ndmaterial/nav.php', $data);
        $this->parser->parse('_v_list', $data);
        $this->parser->parse('_v_script', $data);
        $this->parser->parse('angular/v_footer', $data);
    }

    protected function get_fields()
    {
        $fields = $this->db->field_data($this->table);
        foreach ($fields as $k => $item) {
            if( $item->type == 'enum' ){
                $fields[$k]->data = $this->get_enum($this->table, $item->name);
            }
        }
        return $fields;
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

    public function columns()
    {
        $this->role();
        my_json( $this->db->field_data($this->table) );
    }

    public function update()
    {
        $this->role();
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ){
            $id = $_POST['id'];
            $data['setting_value'] = $_POST['value'];
            $this->db->where( $this->get_primary_key()->name, $id);
            $query = $this->db->update($this->table, $data);
            my_json( ['status'=>$query, 'message'=>'Sukses'] );
            exit();
        }else{
            my_json( [ 'status'=>0, 'message'=> 'Gagal menyimpan data, id diperlukan!' ] );
        }
    }

    public function update_theme()
    {
        $this->role();
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ){
            $this->db->where('setting_type','front-theme');
            $this->db->update($this->table, ['setting_value' => 'deactive']);
            $theme = $_POST['value'];
            $data['setting_value'] = 'active';
            $this->db->where('setting_type','front-theme');
            $this->db->where( 'setting_name', $theme);
            $query = $this->db->update($this->table, $data);
            my_json( ['status'=>$query, 'message'=>'Sukses'] );
            exit();
        }else{
            my_json( [ 'status'=>0, 'message'=> 'Gagal menyimpan data, id diperlukan!' ] );
        }
    }

}