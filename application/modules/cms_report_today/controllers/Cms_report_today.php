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
 * @property  CI_Output $output
 * @property  Setting setting
 * @property  CI_Loader load
 * @property  VendorModel vendorModel
 * @property  UserModel userModel
 * @property  GateModel gateModel
 * @property  OrderModel orderModel
 */
class Cms_report_today extends CI_Controller
{
    protected $module  = 'report_today';
    protected $subject = 'Report Today';
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->lang->load('auth');
        $this->load->model('vendorModel');
        $this->load->model('userModel');
        $this->load->model('gateModel');
        $this->load->model('orderModel');
        $this->module = str_replace('cms_', '', strtolower( get_class($this) ) );
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
        $data                 = $this->setting->get_all();
        $filter_date          = trim($this->input->get('date'));
        $filter_user          = $this->input->get('user');
        $filter_wahana        = $this->input->get('wahana');
        $filter_vendor        = $this->input->get('vendor');
        $filter_type          = $this->input->get('type');
        $filter_payee         = $this->input->get('payee');
        $filter_cardtypeget   = $this->input->get('cardtypeget');
        $filter_bankget       = $this->input->get('bankget');
        $filter_gate    = $this->input->get('gate');

        if( !$filter_date ) $filter_date = date('Y-m-d');

        $vendors = $this->vendorModel->get();
        $paymentType = array(
            array( 'id' => 'offline', 'title' => 'Cash' ),
            array( 'id' => 'debit', 'title' => 'Debit Card' ),
            array( 'id' => 'kredit', 'title' => 'Credit Card' ),
            array( 'id' => 'edc', 'title' => 'EDC' ),
            array( 'id' => 'online', 'title' => 'Payment Gateway' ),
        );

        $this->db->select('product_id,product_title');
        $this->db->where('product_active', '1');
        $this->db->order_by('product_order','asc');
        $this->db->order_by('product_title','asc');
        $result_all_wahana = $this->db->get('tb_product')->result_array();

        if( $filter_wahana ) {
            $this->db->group_start();
            $this->db->where_in('product_id', $filter_wahana);
            $this->db->group_end();
        }
        if( $filter_gate ){
            $this->db->group_start();
            $this->db->where_in('gate_name', $filter_gate);
            $this->db->group_end();
        }
        $this->db->where('product_active', '1');
        $this->db->order_by('product_order','asc');
        $this->db->order_by('product_title','asc');
        $result_wahana = $this->db->get('tb_product')->result_array();


        $result_total_bottom    = array();

        $total_all_subtotal = 0;
        $total_all_discount = 0;
        $total_all_lembar   = 0;
        $total_all_cash     = 0;
        $total_all_edc      = 0;
        $total_all          = 0;
        $payeecount         = array();
        foreach ( $result_wahana as $k => $v ){
            $tmp_result     = $this->get_result( $v['product_id'], $filter_date, $filter_user, $filter_vendor,$filter_payee,$filter_cardtypeget,$filter_bankget, $filter_type, $filter_gate);
            $lembar         = $tmp_result['lembar'];
            $subtotal       = $tmp_result['nominal'];
            $discount       = $tmp_result['discount'];
            $cash           = $tmp_result['cash'];
            $edc            = $tmp_result['edc'];
            $total          = $subtotal - $discount;

            $result_total_bottom[$k] = array(
                'all_lembar'    => $lembar,
                'all_subtotal'  => $subtotal,
                'all_discount'  => $discount,
                'all_total'     => $total,
                'harga'         => $tmp_result['price']
            );
            
            // foreach($tmp_result['payee'] as $val){
            //     if(array_key_exists($val, $tmp_result)){
            //         (int) $tmp_result['payeename'][$val] += $tmp_result[$val];
            //     }
            // }

            $datapaytype        = $tmp_result['payeename']; 

            $total_all_discount += $discount;
            $total_all_subtotal += $subtotal;
            $total_all_lembar   += $lembar;
            $total_all_cash     += $cash;
            $total_all_edc      += $edc;
            $total_all          += $total;
        }

        $result_vendor  = array();
        $result_user    = array();
        if( $filter_vendor ){
            $result_vendor = $this->vendorModel->getBySlugs($filter_vendor);
        }

        if( $filter_user ){
            $result_user = $this->userModel->getByID($filter_user);
            $data['filter_user']        =  $result_user->username.' / '.$result_user->user_display_name;
            $data['filter_user_title']  =  $result_user->username.' / '.$result_user->user_display_name;

        }else{
            $data['filter_user']        =  'All';
            $data['filter_user_title']  =  'All';
        }

        $loketIds                       = $this->userModel->getByGroup('loket');
        $payee                          = $this->userModel->getPayeeId();
        $cardtypeget                    = $this->userModel->getCardType();
        $bankget                        = $this->userModel->getBank();


        $lokets = $this->userModel->getByIDs($loketIds);

        $data['subject']                = $this->subject;
        $data['module']                 = $this->module;
        $data['gates']                  = $this->gateModel->get();
        $data['title']                  = 'LAPORAN TANGGAL '. date( 'd/m/Y',strtotime($filter_date));
        $data['title2']                 = 'LAPORAN HARI INI ('. date( 'd/m/Y',strtotime($filter_date)).')';
        $data['filter_year']            = $filter_date;
        $data['filter_date']            = $filter_date;
        $data['filter_wahana']          = $filter_wahana ? $filter_wahana : array() ;
        $data['filter_gate']            = $filter_gate ? $filter_gate : array() ;

        $data['filter_payee']            = $filter_payee ? $filter_payee : array() ;
        $data['filter_cardtype']         = $filter_cardtypeget ? $filter_cardtypeget : array() ;
        $data['filter_bankget']          = $filter_bankget ? $filter_bankget : array() ;


        
        $data['filter_type']            = $filter_type;
        $data['filter_wahana_title']    = array_column($result_wahana,'product_title');
        //$data['filter_user']            = $filter_user;
        //$data['filter_user_title']      = @$result_user->username;
        $data['filter_vendor']          = ($filter_vendor) ? $filter_vendor : array();
        $data['filter_vendor_title']    = array_column($result_vendor,'vendor_name');
        $data['all_wahana']             = $result_all_wahana;
        $data['wahana']                 = $result_wahana;
        $data['result_total_bottom']    = $result_total_bottom;
        $data['total_all']              = $total_all;
        $data['total_all_discount']     = $total_all_discount;
        $data['total_all_subtotal']     = $total_all_subtotal;
        $data['total_all_cash']         = $total_all_cash;
        $data['total_all_edc']          = $total_all_edc;
        $data['total_payee']            = $datapaytype;
        $data['total_lembar_all']       = $total_all_lembar;
        $data['this_month']             = $this->base_config->bulan_string( date('m') );
        $data['user_loket']             = $lokets;
        $data['payee']                  = $payee;
        $data['bankget']                = $bankget;
        $data['cardtypeget']            = $cardtypeget;

        $data['cabang']                 = @$data['company_name'];
        $data['vendors']                = $vendors;
        $data['payment_type']           = $paymentType;

        if( $this->input->get('export') ){
            $this->export($data);
        }else{
            view_back( "cms_$this->module/views/v_list", $data);
        }
    }

    protected function export($data=array())
    {
        ini_set('memory_limit', '1048M');
        $type = $this->input->get('export');
        if($type == 'pdf'){
            $toDay  = date('Y-m-d');
            $filter = array(
                'date'     => $data['filter_date'],
                'wahana'   => $data['filter_wahana'],
                'vendor'   => $data['filter_vendor'],
                'user'     => $data['filter_user'],
            );
            $data['filter'] = $filter;
            $pdf_html = view_back( "cms_$this->module/views/v_export-pdf", $data, true);
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($pdf_html);
            //$dompdf->setPaper('A4','landscape');
            $dompdf->render();
            $dompdf->stream("order-export-$toDay.pdf");
            exit();
        }if($type == 'print') {
            $this->print($data);
        }else{
            try{
                $objPHPExcel = new PhpOffice\PhpSpreadsheet\Spreadsheet();
                $activeSheet = $objPHPExcel->getActiveSheet();
                $activeSheet->setCellValueByColumnAndRow( 1,1, "Laporan Hari ini" );
                $activeSheet->setCellValueByColumnAndRow( 1,3, "Tanggal Laporan" );
                $activeSheet->setCellValueByColumnAndRow( 2,3, date('d-m-Y H:i:s'));
                $activeSheet->setCellValueByColumnAndRow( 1,4, "Tanggal" );
                $activeSheet->setCellValueByColumnAndRow( 2,4, $data['filter_date'] ? date('d-m-Y', strtotime($data['filter_date'])) : 'All' );
                $activeSheet->setCellValueByColumnAndRow( 1,5, "Wahana" );
                $activeSheet->setCellValueByColumnAndRow( 2,5, $data['filter_wahana'] ? implode(', ', $data['filter_wahana_title']) : 'All' );
                $activeSheet->setCellValueByColumnAndRow( 1,6, "Vendor" );
                $activeSheet->setCellValueByColumnAndRow( 2,6, $data['filter_vendor'] ? implode(', ', $data['filter_vendor_title']) : 'All' );
                $activeSheet->setCellValueByColumnAndRow( 1,7, "Loket" );
                $activeSheet->setCellValueByColumnAndRow( 2,7, $data['filter_user'] ? $data['filter_user_title'] : 'All' );
                $activeSheet->setCellValueByColumnAndRow( 1,8, "Access Gate" );
                $activeSheet->setCellValueByColumnAndRow( 2,8, $data['filter_gate'] ? implode(', ', $data['filter_gate']) : 'All' );
                $activeSheet->setCellValueByColumnAndRow( 1,13, "No" );
                $activeSheet->setCellValueByColumnAndRow( 2,13, "Tiket" );
                $activeSheet->setCellValueByColumnAndRow( 3,13, "Jumlah" );
                $activeSheet->setCellValueByColumnAndRow( 4,13, "Harga" );
                $activeSheet->setCellValueByColumnAndRow( 5,13, "SubTotal" );
                $activeSheet->setCellValueByColumnAndRow( 6,13, "Diskon" );
                $activeSheet->setCellValueByColumnAndRow( 7,13, "Total" );
                $activeSheet->mergeCellsByColumnAndRow(1,1,7,1);
                foreach ($data['wahana'] as $row => $prop) {
                    $activeSheet->setCellValueByColumnAndRow(1, $row+14, $row+1);
                    $activeSheet->setCellValueByColumnAndRow(2, $row+14, $prop['product_title'] );
                    $activeSheet->setCellValueByColumnAndRow(3, $row+14, @$data['result_total_bottom'][$row]['all_lembar'] );
                    $activeSheet->setCellValueByColumnAndRow(4, $row+14, @$data['result_total_bottom'][$row]['harga'] );
                    $activeSheet->setCellValueByColumnAndRow(5, $row+14, @$data['result_total_bottom'][$row]['all_subtotal'] );
                    $activeSheet->setCellValueByColumnAndRow(6, $row+14, @$data['result_total_bottom'][$row]['all_discount'] );
                    $activeSheet->setCellValueByColumnAndRow(7, $row+14, @$data['result_total_bottom'][$row]['all_total'] );
                }
                $activeSheet->setCellValueByColumnAndRow(1, count($data['wahana'])+14, 'Total Cash' );
                $activeSheet->mergeCellsByColumnAndRow(1,count($data['wahana'])+14,2,count($data['wahana'])+14);
                $activeSheet->setCellValueByColumnAndRow(7, count($data['wahana'])+14, @$data['total_all_cash'] );
                $activeSheet->setCellValueByColumnAndRow(1, count($data['wahana'])+15, 'Total EDC' );
                $activeSheet->mergeCellsByColumnAndRow(1,count($data['wahana'])+15,2,count($data['wahana'])+15);
                $activeSheet->setCellValueByColumnAndRow(7, count($data['wahana'])+15,  @$data['total_all_edc']);

                $activeSheet->setCellValueByColumnAndRow(1, count($data['wahana'])+16, 'Total' );
                $activeSheet->mergeCellsByColumnAndRow(1,count($data['wahana'])+16,2,count($data['wahana'])+16);
                $activeSheet->setCellValueByColumnAndRow(3, count($data['wahana'])+16, @$data['total_lembar_all'] );
                $activeSheet->setCellValueByColumnAndRow(5, count($data['wahana'])+16, @$data['total_all_subtotal'] );
                $activeSheet->setCellValueByColumnAndRow(6, count($data['wahana'])+16, @$data['total_all_discount'] );
                $activeSheet->setCellValueByColumnAndRow(7, count($data['wahana'])+16, @$data['total_all'] );

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

    protected function get_result($id_wahana=null,$date=null, $user_id=null, $vendor=null,$filter_payee=null,$filter_cardtypeget=null,$filter_bankget=null, $type=null, $gate=null){
        $this_price = 0;
        $this_total = 0;
        $this_discount = 0;
        $price = 0;

        if( !$date ) $date = date('Y-m-d');
        $this->db->join('tb_transaction t', 't.transaction_id = d.transaction_id');
        $this->db->join('tb_product p', 'p.product_id = d.product_id','left');
        if( $vendor ) {
            $this->db->group_start();
            $this->db->where_in('t.transaction_vendor', $vendor);
            $this->db->group_end();
        }
        if( $gate ) {
            $this->db->group_start();
            $this->db->where_in('p.gate_name', $gate);
            $this->db->group_end();
        }
        if( $filter_payee ) {
            $this->db->group_start();
            $this->db->where_in('t.transaction_payee', $filter_payee);
            $this->db->group_end();
        }
        if( $filter_bankget) {
            $this->db->group_start();
            $this->db->where_in('t.transaction_bank', $filter_bankget);
            $this->db->group_end();
        }
        if( $filter_cardtypeget) {
            $this->db->group_start();
            $this->db->where_in('t.transaction_card_type', $filter_cardtypeget);
            $this->db->group_end();
        }
        if( $type ) {
            switch ($type){
                case 'kredit':
                case 'debit':
                    $this->db->where('t.transaction_type', 'edc');
                    $this->db->where('t.transaction_card_type', $type);
                    break;
                default:
                    $this->db->where('t.transaction_type', $type);
            }
        }
        if( $user_id ) $this->db->where('t.user_id', $user_id);
        if( $id_wahana ) $this->db->where('d.product_id', $id_wahana);
        $this->db->where("t.transaction_paid", '1');
        $this->db->where("DATE(t.transaction_created)", $date);
        // $this->db->where("DATE(t.transaction_date_used)", $date);
        $this_result = $this->db->get('tb_transaction_detail d')->result();

        //Get Payee
        $payee          = $this->db->get('tb_payee')->result();
        $payeetmp =array();
        $payeetmp2 =array();
        $payeename =0;

        foreach($payee as $p) {
            // $payeename[$p->payee_name] = 0;        
            $payeetmp['id'][$p->payee_id] = $p->payee_id;
            $payeetmp['name'][$p->payee_id] = $p->payee_name;
            $payeetmp2[] = $p->payee_name;
        }
      
        $total_cash = 0;
        $total_edc  = 0;
        $data =array();
        $data['payee2'] = array();
        $payeefull = 2;
        foreach ($this_result as $v){
            $jumlah_tiket   = (int)$v->transaction_detail_qty;
            //$this_price     += (int)$v->transaction_detail_price*$jumlah_tiket;
            $this_price     += (int)$v->transaction_detail_subtotal;
            $this_total     += $jumlah_tiket;
            $price          = (int)$v->transaction_detail_price;
            $this_discount  += (int)$v->transaction_detail_discount;
            $total          = (int)$v->transaction_detail_subtotal-(int)$v->transaction_detail_discount;
            if(!empty($payeetmp['id'][$v->transaction_payee] )){
                if($payeetmp['id'][$v->transaction_payee] == $v->transaction_payee){
                    $name = $payeetmp['name'][$v->transaction_payee];
                    $payeefull += $total;
                    $data['payee2'][$name] = $payeefull;
                }
            }
            $v->transaction_detail_discount;
            if( $v->transaction_type == 'edc' ) $total_edc += $total;
            if( $v->transaction_type == 'offline' ) $total_cash += $total;
        }
       $return =  array_merge(array(
        'cash'          => $total_cash,
        'edc'           => $total_edc,
        'lembar'        => $this_total,
        'nominal'       => $this_price,
        'price'         => $price,
        'payee'         => $payeetmp2,
        'payeename'     => $payeename,
        'discount'      => $this_discount,
       ),$data['payee2']);
     
        return  $return;
    }

    protected function get_month( $m ){
        switch ($m){
            case '1':
                return 'Januari';
                break;
            case '2':
                return 'Februari';
                break;
            case '3':
                return 'Maret';
                break;
            case '4':
                return 'April';
                break;
            case '5':
                return 'Mei';
                break;
            case '6':
                return 'Juni';
                break;
            case '7':
                return 'Juli';
                break;
            case '8':
                return 'Agustus';
                break;
            case '9':
                return 'September';
                break;
            case '10':
                return 'Oktober';
                break;
            case '11':
                return 'November';
                break;
            case '12':
                return 'Desember';
                break;
            default :
                return $m;
        }
    }

    protected function print($data=array())
    {
        view_back( "cms_$this->module/views/v_print", $data);
    }

}