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
 * @property    VendorModel vendorModel
 * @property    TicketModel ticketModel
 */
class Cms_ticket extends MX_Controller
{
    protected $table = 'tb_ticket';
    protected $subject = 'Data ticket';
    protected $module;

    public function __construct()
    {
        parent::__construct();
        $this->module = str_replace('cms_', '', strtolower( get_class($this) ) );
        $this->load->model('vendorModel');
        $this->load->model('ticketModel');
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
        $data['nastable'] = false;
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
        $data['pk'] = $this->get_primary_key()->name;
        $data['vendors'] = $this->vendorModel->get();
        view_back( "cms_$this->module/views/v_list", $data);
    }

    public function get()
    {
        $this->role();
        $limit = $this->input->get('limit');
        $page = $this->input->get('page');
        $filter_ticket_active       = $this->input->get('ticket_active');
        $filter_transaction_created = $this->input->get('transaction_created');
        $filter_transaction_uniq    = trim($this->input->get('transaction_uniq'));
        $filter_transaction_vendor  = $this->input->get('transaction_vendor');
        $filter_ticket_code         = trim($this->input->get('ticket_code'));
        if( !$limit ) $limit=20;
        if( !$page ){
            $page = 0;
        }else{
            $page = ($page-1)*$limit;
        }
        if( $filter_transaction_vendor ){
            $this->db->where('t.transaction_vendor', $filter_transaction_vendor);
        }
        if( $filter_ticket_active ){
            $filter_ticket_active = ($filter_ticket_active == 'yes') ?  '1' : '0' ;
            $this->db->where('tc.ticket_active', $filter_ticket_active);
        }
        if( $filter_transaction_created ){
            $this->db->where('DATE(tc.ticket_date)', $filter_transaction_created);
        }
        if( $filter_transaction_uniq ){
            $this->db->group_start();
            $this->db->like('t.transaction_uniq', $filter_transaction_uniq);
            $this->db->group_end();
        }
        if( $filter_ticket_code ){
            $this->db->group_start();
            $this->db->like('tc.ticket_code', $filter_ticket_code);
            $this->db->group_end();
        }
        $this->db->join('tb_transaction_detail dt','dt.transaction_detail_id=tc.transaction_detail_id','left');
        $this->db->join('tb_product p','p.product_id=tc.product_id','left');
        $this->db->join('tb_transaction t','t.transaction_id=dt.transaction_id','left');
        $this->db->order_by('transaction_date_used','desc');
        $this->db->order_by('ticket_id','desc');
        $this->db->order_by('ticket_code','asc');
        $data = $this->db->get( $this->table. ' tc', $limit, $page)->result_array();
        json_response(  $data );
    }

    public function rows()
    {
        $this->role();
        $filter_ticket_active       = $this->input->get('ticket_active');
        $filter_transaction_created = $this->input->get('transaction_created');
        $filter_transaction_uniq    = trim($this->input->get('transaction_uniq'));
        $filter_transaction_vendor  = $this->input->get('transaction_vendor');
        $filter_ticket_code         = trim($this->input->get('ticket_code'));
        if( $filter_transaction_vendor ){
            $this->db->where('t.transaction_vendor', $filter_transaction_vendor);
        }
        if( $filter_ticket_active ){
            $filter_ticket_active = ($filter_ticket_active == 'yes') ?  '1' : '0' ;
            $this->db->where('tc.ticket_active', $filter_ticket_active);
        }
        if( $filter_transaction_created ){
            $this->db->where('DATE(tc.ticket_date)', $filter_transaction_created);
        }
        if( $filter_transaction_uniq ){
            $this->db->group_start();
            $this->db->like('t.transaction_uniq', $filter_transaction_uniq);
            $this->db->group_end();
        }
        if( $filter_ticket_code ){
            $this->db->group_start();
            $this->db->like('tc.ticket_code', $filter_ticket_code);
            $this->db->group_end();
        }
        $this->db->join('tb_transaction_detail dt','dt.transaction_detail_id=tc.transaction_detail_id','left');
        $this->db->join('tb_product p','dt.product_id=p.product_id','left');
        $this->db->join('tb_transaction t','t.transaction_id=dt.transaction_id','left');
        $rows = $this->db->count_all_results($this->table.' tc');
        json_response( $rows );
    }

    public function delete()
    {
        $this->role();
        $id = $this->uri->segment(4);
        if( $id ){
            $ids = explode('-', $id);
            $this->db->where_in( $this->get_primary_key()->name, $ids);
            $this->db->delete($this->table);
            json_response( 'Sukses menghapus data' );
        }else{
            json_response( 'Gagal menghapus data, Silahkan ulangi lagi!', 400 );
        }
    }

    public function used()
    {
        $this->role();
        $id = $this->uri->segment(4);
        if( $id ){
            $ids = explode('-', $id);
            $this->db->group_start();
            $this->db->where_in( $this->get_primary_key()->name, $ids);
            $this->db->group_end();
            $data = array(
                'ticket_active' => '1'
            );
            $this->db->update($this->table, $data);
            json_response( 'Sukses update data' );
        }else{
            json_response( 'Gagal update data, Silahkan ulangi lagi!' );
        }
    }
}