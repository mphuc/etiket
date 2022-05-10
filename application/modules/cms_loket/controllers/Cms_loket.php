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
 * @property    TicketModel ticketModel
 * @property    OrderDetailModel orderDetailModel
 * @property    DetailDiscountModel detailDiscountModel
 * @property    VendorModel vendorModel
 */
class Cms_loket extends MX_Controller
{
    protected $table = 'tb_ticket';
    protected $subject = 'tiket';
    protected $module;

    public function __construct()
    {
        parent::__construct();
        $this->module = str_replace('cms_', '', strtolower( get_class($this) ) );
        $this->load->model('orderDetailModel');
        $this->load->model('detailDiscountModel');
        $this->load->model('vendorModel');
        $this->load->model('ticketModel');
        $this->load->model('frontendModel');
        $this->load->library('user_agent');
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

    protected function required()
    {
        return [];
    }

    protected function where()
    {
        $where = null;
        //$where[] = ['product_name','saya'];
        //$where[] = ['product_desc','saya'];
        return $where;
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
        $fields = $this->get_fields();
        $data['fields'] = $fields;
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
        $data['pk'] = $this->get_primary_key()->name;
        $data['vendors'] = $this->vendorModel->get();
        $data['user_loket'] = $this->M_base_config->get_users_by_group('loket');
       
       
		if ($this->agent->is_mobile('iphone')) {
                echo view_back( "cms_$this->module/views/scan_mobile", $data);
			} elseif ($this->agent->is_mobile()) {
                echo view_back( "cms_$this->module/views/scan_mobile", $data);
			} else {
                echo view_back( "cms_$this->module/views/scan_desktop", $data);
			}

    }

    public function get()
    {
        $this->role();
        $limit                  = $this->input->get('limit');
        $page                   = $this->input->get('page');
        $transaction_uniq       = trim($this->input->get('transaction_uniq'));
        $date                   = $this->input->get('date');
        $user                   = $this->input->get('user');
        $transaction_vendor     = $this->input->get('transaction_vendor');
        $status                 = $this->input->get('status');
        $type                   = $this->input->get('type');
        if( !$limit ) $limit=20;
        if( !$page ){
            $page = 0;
        }else{
            $page = ($page-1)*$limit;
        }

        if( $transaction_uniq ){
            $this->db->group_start();
            $this->db->like('t.transaction_uniq', $transaction_uniq);
            $this->db->group_end();
        }
        // if( $date ) $this->db->where('DATE(t.transaction_date_used)', $date);
        if( $date ) $this->db->where('DATE(t.transaction_created)', $date);
        if( $user ) $this->db->where('t.user_id', $user);
        if( $transaction_vendor ) $this->db->where('t.transaction_vendor', $transaction_vendor);
        if( $status ){
            if( $status == 'paid' ){
                $this->db->where('t.transaction_paid', '1');
            }else{
                $this->db->where('t.transaction_paid', '0');
            }
        }
        if( $type ) $this->db->where('t.transaction_type', $type);
        $this->db->join('tb_card_type ct',"ct.card_type_id=t.transaction_card_type", 'left');
        $this->db->join('tb_payee py',"py.payee_id=t.transaction_payee", 'left');
        $this->db->join('tb_bank b',"b.bank_id=t.transaction_bank", 'left');
        $this->db->join('tb_user u','u.id=t.user_id','left');
        $this->db->order_by('t.transaction_id','desc');
        $this->db->order_by('transaction_created','desc');
        $this->db->order_by('transaction_date_used','desc');
        $data = $this->db->get( $this->table.' t', $limit, $page)->result_array();
        $allDetails = [];
        $trxIds = [];
        foreach ($data as $t){
            $trxIds[] = $t['transaction_id'];
        }
        /*if( $trxIds ) {
            $allDetails = $this->db
                ->select('p.product_title,tb_transaction_detail.*')
                ->where_in('transaction_id', $trxIds)
                ->join('tb_product p','p.product_id=tb_transaction_detail.product_id','left')
                ->join('tb_detail_discount dd','dd.transaction_detail_id=tb_transaction_detail.transaction_detail_id','left')
                ->get('tb_transaction_detail')
                ->result_array();
            $detailIds = array_column($allDetails,'transaction_detail_id');
            $this->db->where_in('transaction_detail_id', $detailIds);
            $detailDiscount = $this->detailDiscountModel->getByOrderDetailId($detailIds);
            foreach ($allDetails as $k => $v){
                $details = array_values(array_filter($detailDiscount, function($element)use($v){
                    return $element['transaction_detail_id'] == $v['transaction_detail_id'];
                }));
                $allDetails[$k]['discount'] = $details;
            }
        }*/
        /*foreach ($data as $k => $v){
            $details = array_values(array_filter($allDetails, function($element)use($v){
                return $element['transaction_id'] == $v['transaction_id'];
            }));
            $data[$k]['detail'] = $details;
        }*/
        json_response( ['status' => 1, 'message' => $data] );
    }

    public function rows()
    {
        $this->role();
        $transaction_uniq       = trim($this->input->get('transaction_uniq'));
        $date                   = $this->input->get('date');
        $user                   = $this->input->get('user');
        $transaction_vendor     = $this->input->get('transaction_vendor');
        $status                 = $this->input->get('status');
        $type                   = $this->input->get('type');
        if( $transaction_uniq ){
            $this->db->group_start();
            $this->db->like('t.transaction_uniq', $transaction_uniq);
            $this->db->group_end();
        }
        if( $date ) $this->db->where('DATE(t.transaction_date_used)', $date);
        if( $user ) $this->db->where('t.user_id', $user);
        if( $transaction_vendor ) $this->db->where('t.transaction_vendor', $transaction_vendor);
        if( $status ){
            if( $status == 'paid' ){
                $this->db->where('t.transaction_paid', '1');
            }else{
                $this->db->where('t.transaction_paid', '0');
            }
        }
        if( $type ) $this->db->where('t.transaction_type', $type);
        $this->db->join('tb_user u','u.id=t.user_id','left');
        $rows = $this->db->count_all_results($this->table. ' t');
        json_response( ['status' => 1, 'message' => $rows] );
    }

    public function messageAlert($type, $title)
	{
		$messageAlert = "const Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		});
		Toast.fire({
			type: '" . $type . "',
			title: '" . $title . "'
		});";
		return $messageAlert;
	}

	function cek_id()
	{
        $this->role();
		$result_code = $this->input->post('ticket_code');
		$tgl = date('Y-m-d');
				
		$cek_id = $this->ticketModel->cek_id($result_code);
		
		$cek_kehadiran = $this->ticketModel->cek_jadwal($result_code, $tgl);

        $cek_tiket_guna = $this->ticketModel->cek_tiket_guna($result_code, $tgl);
		$tanggal = $this->frontendModel->convert_date_to_local($cek_id->ticket_date);
		if (!$cek_id) {
			$errmsg = "Data QR tidak ditemukan, Tiket tidak sah !!.";
			$this->session->set_flashdata('errmsg', $errmsg);
			$this->session->set_flashdata('successmsg', 0);
			redirect($_SERVER['HTTP_REFERER']);
		} elseif (!$cek_kehadiran) {
			$errmsg = "Tiket tidak sah !!. <br />Jadwal Anda ".$tanggal." atau Tiket sudah digunakan !!!";
			$this->session->set_flashdata('errmsg', $errmsg);
			$this->session->set_flashdata('successmsg', 0);
			redirect($_SERVER['HTTP_REFERER']);
		} 
        //print_r($cek_id);
        $ticket = $this->ticketModel->getByCode($result_code, "Gate");
        if( $ticket ){
            $this->ticketModel->setNonActive( $ticket['ticket_id'] );
        
        $errmsg = "Tiket anda sah, untuk ".$cek_id->ticket_qty." orang.";
        $this->session->set_flashdata('errmsg', $errmsg);
		$this->session->set_flashdata('successmsg', 0);
        }
        redirect($_SERVER['HTTP_REFERER']);
	}
}