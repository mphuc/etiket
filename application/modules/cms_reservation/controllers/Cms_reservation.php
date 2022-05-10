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
 * @property   OrderModel orderModel
 * @property   OrderDetailModel orderDetailModel
 * @property   DetailDiscountModel detailDiscountModel
 * @property   UserModel userModel
 * @property   ProductModel productModel
 * @property   DiscountModel discountModel
 * @property   TicketModel ticketModel
 */
class Cms_reservation extends MX_Controller
{
    protected $table = 'tb_reservation';
    protected $subject = 'Data reservation';
    protected $module;
    protected $primary_key = 'res_id';

    public function __construct()
    {
        parent::__construct();
        $this->module = str_replace('cms_', '', strtolower( get_class($this) ) );
        $this->load->model('orderDetailModel');
        $this->load->model('detailDiscountModel');
        $this->load->model('userModel');
        $this->load->model('productModel');
        $this->load->model('discountModel');
        $this->load->model('orderModel');
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

    public function index()
    {
        $this->role();
        $data = $this->setting->get_all();
        $data['nastable'] = true;
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
        $data['pk'] = $this->primary_key;
        $reservationUserIds = $this->userModel->getByGroup('reservasi');
        $data['users'] = $this->userModel->getByIDs($reservationUserIds);
        $data['banks'] = $this->db->order_by('bank_name','asc')->get('tb_bank')->result_array();
        view_back( "cms_$this->module/views/v_list", $data);
    }

    public function add()
    {
        $this->role();
        $data = $this->setting->get_all();
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ){
            $userId             = $this->ion_auth->get_user_id();
            $products           = $this->input->post('product');
            $discounts          = $this->input->post('discount');
            $dateUsed           = $this->input->post('transaction_date_used');
            $transaction_paid   = ($this->input->post('transaction_paid')=='1') ? 1 : 0 ;

            $discountIds    = array_column($discounts, 'dp_id');
            $productIds     = array_column($products, 'product_id');
            $dataDiscount   = $this->discountModel->getByDiscountId($discountIds, $productIds);
            $discountValues = [];
            foreach ($discountIds as $discountId) {
                $values = array_filter($dataDiscount,function ($el)use($discountId){
                    return $discountId == $el['discount_id'];
                });
                foreach ($values as $v){
                    $discountValues[] = $v;
                }
            }

            $list_product   = [];
            $productAll     = $this->productModel->getProductsByVendorAndDate('reservasi', $dateUsed);
            foreach ($productAll as $p) {
                foreach ($products as $product) {
                    if( $p['product_id'] == $product['product_id'] ){
                        $p['qty']       = $product['qty'];
                        $p['total']     = $product['qty']*$product['product_price'];
                        $p['discount']  = 0;
                        $list_product[] = $p;
                    }
                }
            }

            $total_all        = 0;
            $total            = 0;
            $total_discount   = 0;
            foreach($list_product as $key => $value ) {
                $totalBeforeDiscount = $value['qty']*$value['product_price'];
                if( count($discountValues) == 0 ){
                    $list_product[$key]['discount'] = 0;
                }else{
                    $lastDiscTmp   = 0;
                    $lastTotalTmp  = 0;
                    $i = 0;
                    foreach($discountValues as $k => $v) {
                        if( $v['product_id'] == $value['product_id'] ){
                            if( $i === 0 ){
                                $discountNominal = $totalBeforeDiscount*intval($v['discount'])/100;
                                $lastTotalTmp    = $totalBeforeDiscount-$discountNominal;
                                $lastDiscTmp     += $discountNominal;
                            }else{
                                $discountNominal = $lastTotalTmp*intval($v['discount'])/100;
                                $lastTotalTmp    = $lastTotalTmp-$discountNominal;
                                $lastDiscTmp     += $discountNominal;
                            }
                            $list_product[$key]['discount']     = $lastDiscTmp;
                            $v['discount_nominal']              = $discountNominal;
                            $list_product[$key]['discounts'][]  = $v;
                            $i++;
                        }
                    };
                }
                $total            += $value['total'];
                $total_all        += $value['total']-$value['discount'];
                $total_discount   += $value['discount'];
            }

            $transactionId      = $this->orderModel->addMarketing($userId, $dateUsed, $list_product, $transaction_paid);
            $this->ticketModel->create(array($transactionId));
            $orderDetails       = $this->orderDetailModel->getByOrderId($transactionId);
            $insertDiscounts    = array();
            foreach ($list_product as $lp) {
                if( isset($lp['discounts']) && $lp['discounts'] ){
                    $results = array_filter($orderDetails, function ($el)use($lp){
                        return $lp['product_id'] == $el['product_id'];
                    });
                    $result = reset($results);
                    foreach ($lp['discounts'] as $disc) {
                        $insertDiscounts[] = array(
                            'dd_discount'           => $disc['discount_nominal'],
                            'dd_percent_discount'   => $disc['discount'],
                            'transaction_detail_id' => $result['transaction_detail_id'],
                            'dd_type'               => $disc['dp_name'],
                        );
                    }
                }
            }
            if( $insertDiscounts ) $this->db->insert_batch('tb_detail_discount', $insertDiscounts);

            $customerId = $this->input->post('res_customer');
            $customer = $this->db->where('id', $customerId)->get('tb_master')->row_array();
            if( !$customer ) json_response( 'Customer tidak ditemukan', 403 );

            $insertReservation = array(
                'transaction_id'        => $transactionId,
                'res_customer'          => $customer['nama'],
                'res_kabupaten'         => $customer['city'],
                'bus_1'                 => $this->input->post('bus_1'),
                'bus_2'                 => $this->input->post('bus_2'),
                'res_jam_kunjungan'     => $this->input->post('res_jam_kunjungan'),
                'res_jam_acara'         => $this->input->post('res_jam_acara'),
                'res_souvenir_tour'     => $this->input->post('res_souvenir_tour'),
                'res_souvenir_panggung' => $this->input->post('res_souvenir_panggung'),
                'res_jam_makan'         => $this->input->post('res_jam_makan'),
                'res_bus_price'         => filter_var($this->input->post('res_bus_price'), FILTER_SANITIZE_NUMBER_INT),
                'res_driver_price'      => filter_var($this->input->post('res_driver_price'), FILTER_SANITIZE_NUMBER_INT),
                'res_total_person'      => $this->input->post('res_total_person'),
                'res_total_box'         => $this->input->post('res_total_box'),
                'res_biro'              => $this->input->post('res_biro'),
                'res_note_operasional'  => $this->input->post('res_note_operasional'),
                'res_note_teknik'       => $this->input->post('res_note_teknik'),
                'res_note_tambahan'     => $this->input->post('res_note_tambahan'),
                'res_note_bus'          => $this->input->post('res_note_bus'),
                'res_tempat'            => $this->input->post('res_tempat'),
                'res_pelunasan'         => 0,
            );
            $dpNominal = (int) filter_var($this->input->post('res_dp'), FILTER_SANITIZE_NUMBER_INT);
            if( $transaction_paid ) {
                $insertReservation['res_pelunasan']         = $total_all-$dpNominal;
                $insertReservation['res_pelunasan_type']    = $this->input->post('res_pelunasan_type');
                $insertReservation['res_pelunasan_date']    = $this->input->post('res_pelunasan_date');
                $insertReservation['res_pelunasan_bank']    = $this->input->post('res_pelunasan_bank');
            }else{
                $insertReservation['res_pelunasan']         = 0;
                $insertReservation['res_pelunasan_type']    = '';
                $insertReservation['res_pelunasan_date']    = $this->input->post('res_pelunasan_date');
                $insertReservation['res_pelunasan_bank']    = '';
            }
            if( $dpNominal > 0 ) {
                $insertReservation['res_dp']                = $dpNominal;
                $insertReservation['res_dp_type']           = $this->input->post('res_dp_type');
                $insertReservation['res_dp_date']           = $this->input->post('res_dp_date');
                $insertReservation['res_dp_bank']           = $this->input->post('res_dp_bank');
            }else{
                $insertReservation['res_dp']                = 0;
                $insertReservation['res_dp_type']           = '';
                $insertReservation['res_dp_date']           = $this->input->post('res_dp_date');
                $insertReservation['res_dp_bank']           = '';
            }
            $this->db->insert($this->table, $insertReservation);
            json_response( 'Sukses' );
        }
        $data['nastable'] = true;
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
        $data['pk'] = $this->primary_key;
        $data['banks'] = $this->db->order_by('bank_name','asc')->get('tb_bank')->result_array();
        view_back( "cms_$this->module/views/v_add", $data);
    }

    public function import()
    {
        $this->role();
        $data = $this->setting->get_all();
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ){
            //$this->db->insert( $this->table, $_POST );
            $_POST['time'] = time();
            sleep(1);
            $this->db->insert('tb_tes', array('value' => json_encode($_POST)));
            json_response( 'Sukses' );
        }
        $data['nastable'] = true;
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
        $data['pk'] = $this->primary_key;
        view_back( "cms_$this->module/views/v_import", $data);
    }

    public function upload()
    {
        $this->role();
        if( !empty($_FILES) ){
            $config['upload_path']          = 'assets/uploads/';
            $config['allowed_types']        = 'xlsx';
            $config['max_size']             = 1024 * 10;
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('file'))
            {
                json_response( ['status' => 0, 'message' => strip_tags($this->upload->display_errors()) ] );
            } else {
                $productIds = $this->productModel->getIdsDisplayByVendor('reservasi');
                $products = $this->productModel->getById($productIds);

                $uploads = $this->upload->data();
                $inputFileName  = $uploads['full_path'];
                $reader         = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $spreadsheet    = $reader->load($inputFileName);
                $cells          = $spreadsheet->getActiveSheet()->toArray();

                $lastColumn     = 32;
                $dataHeader     = $cells[1];
                $countProduct   = count($dataHeader)-$lastColumn;

                $insert = array();
                foreach ($cells as $key => $dataExcel) {
                    if( $key >= 2 ){
                        if( $dataExcel[0] ){
                            $dataInsert = array(
                                'res_customer'          => $this->_nullValue($dataExcel[1]),
                                'res_jam_kunjungan'     => $this->_nullValue($dataExcel[2]),
                                'res_jam_acara'         => $this->_nullValue($dataExcel[3]),
                                'res_jam_makan'         => $this->_nullValue($dataExcel[4]),
                                'res_tempat'            => $this->_nullValue($dataExcel[5]),
                                'res_dp'                => intval($dataExcel[6]),
                                'res_dp_date'           => $this->_dateValue($this->_dateValue($dataExcel[7])),
                                'res_dp_type'           => $this->_nullValue($dataExcel[8]),
                                'res_dp_bank'           => $this->_nullValue($dataExcel[9]),
                                'res_pelunasan'         => intval($dataExcel[10]),
                                'res_pelunasan_date'    => $this->_dateValue($dataExcel[11]),
                                'res_pelunasan_type'    => $this->_nullValue($dataExcel[12]),
                                'res_pelunasan_bank'    => $this->_nullValue($dataExcel[13]),
                                'res_souvenir_tour'     => $this->_nullValue($dataExcel[14]),
                                'res_souvenir_panggung' => $this->_nullValue($dataExcel[15]),
                                'bus_1'                 => $this->_nullValue($dataExcel[16]),
                                'bus_2'                 => $this->_nullValue($dataExcel[17]),
                                'res_driver_price'      => intval($dataExcel[18]),
                                'res_bus_price'         => intval($dataExcel[19]),
                                'res_total_person'      => intval($dataExcel[20]),
                                'res_biro'              => $this->_nullValue($dataExcel[21]),
                                'res_total_box'         => intval($dataExcel[22]),
                                'res_note_operasional'  => $this->_nullValue($dataExcel[23]),
                                'res_note_teknik'       => $this->_nullValue($dataExcel[24]),
                                'res_note_bus'          => $this->_nullValue($dataExcel[25]),

                                'username'              => $this->_nullValue($dataExcel[26]),
                                'transaction_paid'      => $this->_boolValue($dataExcel[27]),
                                'transaction_date_used' => $this->_dateValue($dataExcel[28]),
                                'discount_1'            => intval($dataExcel[29]),
                                'discount_2'            => intval($dataExcel[30]),
                                'discount_3'            => intval($dataExcel[31])
                            );
                            for($i=0;$i<$countProduct;$i++) {
                                $index = $i+$lastColumn;
                                $pid = $this->_findIdByTitle($products, $dataHeader[$index]);
                                if( $pid ){
                                    $dataInsert["pid_$pid"] = intval($dataExcel[$index]);
                                }
                            }
                            $insert[] = $dataInsert;
                        }
                    }
                }
                json_response( ['status' => 1, 'message' => $uploads, 'data'=> $insert,] );
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

    /**
     * @param $value string
     * @return string
     */
    protected function _nullValue($value){
        if( $value==null ) return '';
        return $value;
    }

    /**
     * @param $value string
     * @return string
     */
    protected function _dateValue($value)
    {
        return date('Y-m-d', strtotime($value));
    }

    /**
     * @param $value
     * @return int
     */
    protected function _boolValue($value)
    {
        if( $value ) return 1;
        return 0;
    }

    /**
     * @param $products array
     * @param $title string
     * @return string
     */
    protected function _findIdByTitle($products, $title)
    {
        $results = array_filter($products,function ($el)use($title){
            return strtolower(trim($el['product_title'])) == strtolower(trim($title));
        });
        $product = reset($results);
        return @$product['product_id'];
    }

    public function edit()
    {
        $this->role();
        $id = $this->uri->segment(4);
        $data = $this->setting->get_all();
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ){
            //$id = $_POST[$this->primary_key];
            //$this->db->where($this->primary_key, $id );
            //$this->db->update( $this->table, $_POST );
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

    public function discount()
    {
        $this->role();
        $id = $this->input->get('product_id');
        $ids = explode(',', $id);
        $data = $this->discountModel->getByProductId($ids);
        json_response( $data );
    }

    public function discount_value()
    {
        $this->role();
        $d_id = $this->input->get('dp_id');
        $p_id = $this->input->get('product_id');
        $d_ids = explode(',', $d_id);
        $p_ids = explode(',', $p_id);
        $data = $this->discountModel->getByDiscountId($d_ids,$p_ids);
        $tmp = [];
        foreach ($d_ids as $discountId) {
            $values = array_filter($data,function ($el)use($discountId){
                return $discountId == $el['discount_id'];
            });
            foreach ($values as $v){
                $tmp[] = $v;
            }
        }
        json_response( $tmp );
    }

    public function product()
    {
        $this->role();
        $data = $this->productModel->getProductsByVendorAndDate('reservasi', $this->input->get('date'));
        json_response($data);
    }

    protected function _get()
    {
        $limit              = $this->input->get('limit');
        $page               = $this->input->get('page');
        $user_id            = $this->input->get('user_id');
        $transaction_uniq   = $this->input->get('transaction_uniq');
        $from               = $this->input->get('from');
        $to                 = $this->input->get('to');

        $filter = array(
            'limit'             => $limit,
            'page'              => $page,
            'user_id'           => $user_id,
            'transaction_uniq'  => $transaction_uniq,
            'from'              => $from,
            'to'                => $to,
        );

        if( !$limit ) $limit=20;
        if( !$page ){
            $page = 0;
        }else{
            $page = ($page-1)*$limit;
        }

        if( $user_id ) $this->db->where('t.user_id', $user_id);
        if( $transaction_uniq ){
            $this->db->group_start();
            $this->db->like('t.transaction_uniq', $transaction_uniq);
            $this->db->group_end();
        }
        if( $from && $to ){
            $this->db->where('DATE(t.transaction_date_used) >=', $from);
            $this->db->where('DATE(t.transaction_date_used) <=', $to);
        }
        $this->db->select('u.username,t.*,r.*');
        $this->db->join('tb_transaction t','t.transaction_id=r.transaction_id');
        $this->db->join('tb_user u','u.id=t.user_id','left');
        $this->db->order_by('transaction_date_used','desc');
        $data = $this->db->get( "$this->table r", $limit, $page)->result_array();
        return array(
            'data'      => $data,
            'filter'    => $filter
        );
    }

    public function get()
    {
        $this->role();
        $data = $this->_get();
        json_response(  $data['data'] );
    }

    public function rows()
    {
        $this->role();
        $user_id            = $this->input->get('user_id');
        $transaction_uniq   = $this->input->get('transaction_uniq');
        $from               = $this->input->get('from');
        $to                 = $this->input->get('to');
        if( $user_id ) $this->db->where('t.user_id', $user_id);
        if( $transaction_uniq ){
            $this->db->group_start();
            $this->db->like('t.transaction_uniq', $transaction_uniq);
            $this->db->group_end();
        }
        if( $from && $to ){
            $this->db->where('DATE(t.transaction_date_used) >=', $from);
            $this->db->where('DATE(t.transaction_date_used) <=', $to);
        }
        $this->db->join('tb_transaction t','t.transaction_id=r.transaction_id');
        $rows = $this->db->count_all_results("$this->table r");
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

    public function detail()
    {
        $this->role();
        $id = $this->input->get('id');
        $allDetails = $this->orderDetailModel->getByOrderId($id);
        /*$this->db->where('transaction_id', $id);
        $reservation = $this->db->get('tb_reservation')->row_array();*/
        $detailIds = array_column($allDetails,'transaction_detail_id');
        $detailDiscount = $this->detailDiscountModel->getByOrderDetailId($detailIds);
        foreach ($allDetails as $k => $v){
            $details = array_values(array_filter($detailDiscount, function($element)use($v){
                return $element['transaction_detail_id'] == $v['transaction_detail_id'];
            }));
            $allDetails[$k]['discount']     = $details;
            /*$allDetails[$k]['reservation']  = $reservation;*/
        }

        json_response($allDetails);
    }

    public function export()
    {
        ini_set('memory_limit', '1048M');
        $this->role();
        $result = $this->_get();
        $data = $result['data'];
        $filter = $result['filter'];
        $type = $this->input->get('export');
        if($type == 'pdf'){
            echo "WRONG TYPE";
            exit();
        }else{
            try{
                $objPHPExcel = new PhpOffice\PhpSpreadsheet\Spreadsheet();
                $activeSheet = $objPHPExcel->getActiveSheet();
                $activeSheet->setCellValueByColumnAndRow( 1,1, "Laporan Reservasi" );
                $activeSheet->setCellValueByColumnAndRow( 1,3, "Tanggal" );
                $activeSheet->setCellValueByColumnAndRow( 2,3, date('d-m-Y H:i:s'));
                $activeSheet->setCellValueByColumnAndRow( 1,4, "Dari" );
                $activeSheet->setCellValueByColumnAndRow( 2,4, $filter['from'] );
                $activeSheet->setCellValueByColumnAndRow( 1,5, "Sampai" );
                $activeSheet->setCellValueByColumnAndRow( 2,5, $filter['to']);
                $activeSheet->setCellValueByColumnAndRow( 1,9, "No" );
                $activeSheet->setCellValueByColumnAndRow( 2,9, "ID" );
                $activeSheet->setCellValueByColumnAndRow( 3,9, "Customer" );
                $activeSheet->setCellValueByColumnAndRow( 4,9, "Jam Kunjungan" );
                $activeSheet->setCellValueByColumnAndRow( 5,9, "Jam Acara" );
                $activeSheet->setCellValueByColumnAndRow( 6,9, "Jam Makan" );
                $activeSheet->setCellValueByColumnAndRow( 7,9, "Tempat" );
                $activeSheet->setCellValueByColumnAndRow( 8,9, "Dp" );
                $activeSheet->setCellValueByColumnAndRow( 9,9, "Tanggal Dp" );
                $activeSheet->setCellValueByColumnAndRow( 10,9, "Jenis Dp" );
                $activeSheet->setCellValueByColumnAndRow( 11,9, "Bank Dp" );
                $activeSheet->setCellValueByColumnAndRow( 12,9, "Pelunasan" );
                $activeSheet->setCellValueByColumnAndRow( 13,9, "Tanggal Pelunasan" );
                $activeSheet->setCellValueByColumnAndRow( 14,9, "Jenis Pelunasan" );
                $activeSheet->setCellValueByColumnAndRow( 15,9, "Bank Pelunasan" );
                $activeSheet->setCellValueByColumnAndRow( 16,9, "Souvenir Tour" );
                $activeSheet->setCellValueByColumnAndRow( 17,9, "Souvenir Panggung" );
                $activeSheet->setCellValueByColumnAndRow( 18,9, "Bus 1" );
                $activeSheet->setCellValueByColumnAndRow( 19,9, "Bus 2" );
                $activeSheet->setCellValueByColumnAndRow( 20,9, "Driver Price" );
                $activeSheet->setCellValueByColumnAndRow( 21,9, "Bus Price" );
                $activeSheet->setCellValueByColumnAndRow( 22,9, "Total Person" );
                $activeSheet->setCellValueByColumnAndRow( 23,9, "Kabupaten" );
                $activeSheet->setCellValueByColumnAndRow( 24,9, "Biro" );
                $activeSheet->setCellValueByColumnAndRow( 25,9, "Total Box" );
                $activeSheet->setCellValueByColumnAndRow( 26,9, "Note Operasional	" );
                $activeSheet->setCellValueByColumnAndRow( 27,9, "Note Teknik" );
                $activeSheet->setCellValueByColumnAndRow( 28,9, "Note Bus" );
                $activeSheet->setCellValueByColumnAndRow( 29,9, "Note Tambahan" );
                $activeSheet->setCellValueByColumnAndRow( 30,9, "username" );
                $activeSheet->setCellValueByColumnAndRow( 31,9, "lunas" );
                $activeSheet->setCellValueByColumnAndRow( 32,9, "Tanggal Digunakan" );
                $activeSheet->mergeCellsByColumnAndRow(1,1,7,1);
                foreach ($data as $row => $prop) {
                    $activeSheet->setCellValueByColumnAndRow(1, $row+10, $row+1);
                    $activeSheet->setCellValueByColumnAndRow(2, $row+10, $prop['transaction_uniq'] );
                    $activeSheet->setCellValueByColumnAndRow(3, $row+10, $prop['res_customer'] );
                    $activeSheet->setCellValueByColumnAndRow(4, $row+10, $prop['res_jam_kunjungan'] );
                    $activeSheet->setCellValueByColumnAndRow(5, $row+10, $prop['res_jam_acara'] );
                    $activeSheet->setCellValueByColumnAndRow(6, $row+10, $prop['res_jam_makan'] );
                    $activeSheet->setCellValueByColumnAndRow(7, $row+10, $prop['res_tempat'] );
                    $activeSheet->setCellValueByColumnAndRow(8, $row+10, $prop['res_dp'] );
                    $activeSheet->setCellValueByColumnAndRow(9, $row+10, $prop['res_dp_date'] );
                    $activeSheet->setCellValueByColumnAndRow(10, $row+10, $prop['res_dp_type'] );
                    $activeSheet->setCellValueByColumnAndRow(11, $row+10, $prop['res_dp_bank'] );
                    $activeSheet->setCellValueByColumnAndRow(12, $row+10, $prop['res_pelunasan'] );
                    $activeSheet->setCellValueByColumnAndRow(13, $row+10, $prop['res_pelunasan_date'] );
                    $activeSheet->setCellValueByColumnAndRow(14, $row+10, $prop['res_pelunasan_type'] );
                    $activeSheet->setCellValueByColumnAndRow(15, $row+10, $prop['res_pelunasan_bank'] );
                    $activeSheet->setCellValueByColumnAndRow(16, $row+10, $prop['res_souvenir_tour'] );
                    $activeSheet->setCellValueByColumnAndRow(17, $row+10, $prop['res_souvenir_panggung'] );
                    $activeSheet->setCellValueByColumnAndRow(18, $row+10, $prop['bus_1'] );
                    $activeSheet->setCellValueByColumnAndRow(19, $row+10, $prop['bus_2'] );
                    $activeSheet->setCellValueByColumnAndRow(20, $row+10, $prop['res_driver_price'] );
                    $activeSheet->setCellValueByColumnAndRow(21, $row+10, $prop['res_bus_price'] );
                    $activeSheet->setCellValueByColumnAndRow(22, $row+10, $prop['res_total_person'] );
                    $activeSheet->setCellValueByColumnAndRow(23, $row+10, $prop['res_kabupaten'] );
                    $activeSheet->setCellValueByColumnAndRow(24, $row+10, $prop['res_biro'] );
                    $activeSheet->setCellValueByColumnAndRow(25, $row+10, $prop['res_total_box'] );
                    $activeSheet->setCellValueByColumnAndRow(26, $row+10, $prop['res_note_operasional'] );
                    $activeSheet->setCellValueByColumnAndRow(27, $row+10, $prop['res_note_teknik'] );
                    $activeSheet->setCellValueByColumnAndRow(28, $row+10, $prop['res_note_bus'] );
                    $activeSheet->setCellValueByColumnAndRow(29, $row+10, $prop['res_note_tambahan'] );
                    $activeSheet->setCellValueByColumnAndRow(30, $row+10, $prop['username'] );
                    if($prop['transaction_paid']==1){
                        $activeSheet->setCellValueByColumnAndRow(31, $row+10, 'YA' );
                    }else{
                        $activeSheet->setCellValueByColumnAndRow(31, $row+10, 'TIDAK' );
                    }
                    $activeSheet->setCellValueByColumnAndRow(32, $row+10, $prop['transaction_date_used'] );
                }
                $toDay = date('Y-m-d');
                $filename = "$this->module-export-$toDay.xlsx";
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment; filename="' . basename($filename).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Pragma: public');
                $objWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
                $objWriter->save('php://output');
                exit();
            }catch (Exception $e){
                echo 'Message: ' .$e->getMessage();
                exit();
            }
        }
    }

    public function template()
    {
        $this->role();
        try{
            $objPHPExcel = new PhpOffice\PhpSpreadsheet\Spreadsheet();
            $activeSheet = $objPHPExcel->getActiveSheet();
            $activeSheet->setCellValueByColumnAndRow( 1,1, "RESERVASI");
            $activeSheet->setCellValueByColumnAndRow( 1,2, "NO");
            $activeSheet->setCellValueByColumnAndRow( 2,2, "CUSTOMER");
            $activeSheet->setCellValueByColumnAndRow( 3,2, "Jam Kunjungan");
            $activeSheet->setCellValueByColumnAndRow( 4,2, "Jam Acara");
            $activeSheet->setCellValueByColumnAndRow( 5,2, "Jam Makan");
            $activeSheet->setCellValueByColumnAndRow( 6,2, "Tempat");
            $activeSheet->setCellValueByColumnAndRow( 7,2, "Dp");
            $activeSheet->setCellValueByColumnAndRow( 8,2, "Tanggal Dp");
            $activeSheet->setCellValueByColumnAndRow( 9,2, "Jenis Dp");
            $activeSheet->setCellValueByColumnAndRow( 10,2, "Bank Dp");
            $activeSheet->setCellValueByColumnAndRow( 11,2, "Pelunasan");
            $activeSheet->setCellValueByColumnAndRow( 12,2, "Tanggal Pelunasan");
            $activeSheet->setCellValueByColumnAndRow( 13,2, "Jenis Pelunasan");
            $activeSheet->setCellValueByColumnAndRow( 14,2, "Bank Pelunasan");
            $activeSheet->setCellValueByColumnAndRow( 15,2, "Souvenir Tour");
            $activeSheet->setCellValueByColumnAndRow( 16,2, "Souvenir Panggung");
            $activeSheet->setCellValueByColumnAndRow( 17,2, "Bus 1");
            $activeSheet->setCellValueByColumnAndRow( 18,2, "Bus 2");
            $activeSheet->setCellValueByColumnAndRow( 19,2, "Driver Price");
            $activeSheet->setCellValueByColumnAndRow( 20,2, "Bus Price");
            $activeSheet->setCellValueByColumnAndRow( 21,2, "Total Person");
            $activeSheet->setCellValueByColumnAndRow( 22,2, "Biro");
            $activeSheet->setCellValueByColumnAndRow( 23,2, "Total Box");
            $activeSheet->setCellValueByColumnAndRow( 24,2, "Note Operasional");
            $activeSheet->setCellValueByColumnAndRow( 25,2, "Note Teknik");
            $activeSheet->setCellValueByColumnAndRow( 26,2, "Note Bus");
            $activeSheet->setCellValueByColumnAndRow( 27,2, "reservation");
            $activeSheet->setCellValueByColumnAndRow( 28,2, "lunas");
            $activeSheet->setCellValueByColumnAndRow( 29,2, "Tanggal Digunakan");
            $activeSheet->setCellValueByColumnAndRow( 30,2, "Discount 1");
            $activeSheet->setCellValueByColumnAndRow( 31,2, "Discount 2");
            $activeSheet->setCellValueByColumnAndRow( 32,2, "Discount 3");

            $productIds = $this->productModel->getIdsDisplayByVendor('reservasi');
            $products   = $this->productModel->getById($productIds);
            $row = 33;
            foreach ($products as $k => $v){
                $activeSheet->setCellValueByColumnAndRow( $k+$row,2, $v['product_title']);
            }

            $activeSheet->mergeCellsByColumnAndRow(1,1,35,1);
            $toDay = date('Y-m-d');
            $filename = "template-$this->module-$toDay.xlsx";
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="' . basename($filename).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            $objWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
            $objWriter->save('php://output');
            exit();
        }catch (Exception $e){
            echo 'Message: ' .$e->getMessage();
            exit();
        }
    }

    public function master()
    {
        $this->role();
        $search = $this->input->get('q');
        $column = 'nama';
        $limit  = 50;
        if( isset($search) && $column ){
            $this->db->group_start();
            $this->db->like($column, $search);
            $this->db->group_end();
        }
        $this->db->select('id, nama as text');
        $this->db->order_by('type','asc');
        $this->db->order_by('nama','asc');
        $data = $this->db->get( 'tb_master', $limit)->result_array();
        json_response(  $data );
    }

    public function tempat()
    {
        $this->db->select('panggung as id, panggung as text');
        $this->db->order_by('panggung','asc');
        $data = $this->db->get('tb_tempat')->result_array();
        json_response($data);
    }

    public function bus()
    {
        $this->db->select('busnama as id, busnama as text');
        $this->db->order_by('busnama','asc');
        $data = $this->db->get('tb_bus')->result_array();
        json_response($data);
    }

    public function city()
    {
        $search = $this->input->get('q');
        $column = 'name';
        $limit  = 50;
        if( $search ){
            $this->db->group_start();
            $this->db->like($column, $search);
            $this->db->group_end();
        }
        $this->db->select('id,name as text');
        $this->db->order_by('name','asc');
        $city = $this->db->get('tb_regencies',$limit)->result_array();
        json_response($city);
    }

    public function paid()
    {
        $this->role();
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ){
            $transaction_id = $this->input->post('transaction_id');
            $this->db->where('t.transaction_id', $transaction_id);
            $this->db->join('tb_transaction t','t.transaction_id=r.transaction_id');
            $reservation    = $this->db->get('tb_reservation r',1)->row_array();
            if( !$reservation ) json_response('Reservation Not Found', 404);
            $totalAfterDiscount = intval($reservation['transaction_total']) - intval($reservation['transaction_discount']);
            $updateReservation = array(
                'res_pelunasan_type' => $this->input->post('res_pelunasan_type'),
                'res_pelunasan_bank' => $this->input->post('res_pelunasan_bank'),
                'res_pelunasan_date' => date('Y-m-d'),
                'res_pelunasan'      => $totalAfterDiscount - intval($reservation['res_dp']),
            );
            $this->db->where('transaction_id', $transaction_id);
            $this->db->update('tb_reservation', $updateReservation);
            $updateTransaction = array(
                'transaction_paid'      => '1',
                'transaction_status'    => 'Success',
            );
            $this->db->where('transaction_id', $transaction_id);
            $this->db->update('tb_transaction', $updateTransaction);
            json_response( 'Sukses' );
        }else{
            show_404();
        }
    }
}