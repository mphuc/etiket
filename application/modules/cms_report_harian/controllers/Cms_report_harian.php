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
 */
class Cms_report_harian extends CI_Controller
{
    protected $module  = 'report_harian';
    protected $subject = 'Report Harian';
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->lang->load('auth');
        $this->load->model('vendorModel');
        $this->load->model('userModel');
        $this->load->model('gateModel');
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
        $data = $this->setting->get_all();

        $filter_month               = $this->input->get('month');
        $filter_wahana 							= $this->input->get('wahana');
        $filter_year   							= $this->input->get('year');
        $filter_vendor 							= $this->input->get('vendor');
        $filter_user   							= $this->input->get('user');
        $filter_type   							= $this->input->get('type');
        $filter_gate    						= $this->input->get('gate');

        $filter_bankget       			= $this->input->get('bankget');
        $bankget                    = $this->userModel->getBank();
        $data['filter_bankget']     = $filter_bankget ? $filter_bankget : array() ;
				$data['bankget']            = $bankget;
					

        $vendors = $this->vendorModel->get();
        $paymentType = array(
            array( 'id' => 'offline', 'title' => 'Cash' ),
            array( 'id' => 'debit', 'title' => 'Debit Card' ),
            array( 'id' => 'kredit', 'title' => 'Credit Card' ),
            array( 'id' => 'edc', 'title' => 'EDC' )
        );

        $this->db->select('product_id,product_title');
        $this->db->from('tb_product');
        //$this->db->where('product_price >', '0');
        $this->db->where('product_active', '1');
        $this->db->order_by('product_order','asc');
        $result_all_wahana = $this->db->get()->result_array();

        $this->db->select('*');
        $this->db->from('tb_product');
        if( $filter_wahana ) {
            $this->db->group_start();
            $this->db->where_in('product_id', $filter_wahana);
            $this->db->group_end();
        }
        //$this->db->where('product_price >', '0');
        $this->db->where('product_active', '1');
        $this->db->order_by('product_order','asc');
        $result_wahana = $this->db->get()->result_array();

        $months = array();
        for( $i=1; $i <= 12;$i++ ){
            $months[] = $this->base_config->bulan_string( $i );
        }

        //if( !$filter_wahana ) $filter_wahana = $first_wahana;
        if( $filter_wahana == 'all' ) $filter_wahana = 'all';
        if( !$filter_month ) $filter_month = date('m');
        if( !$filter_year ) $filter_year   = date('Y');

        /*$this->db->select('product_id,product_title,product_price');
        $this->db->from('tb_product');
        $this->db->where('product_id', $filter_wahana);
        $this->db->limit(1);
        $row_selected_wahana = $this->db->get();*/
        //$price = $row_selected_wahana->row('product_price');

        $total_day = cal_days_in_month(CAL_GREGORIAN, $filter_month, $filter_year);
        $begin = new DateTime( "$filter_year-$filter_month-01" );
        $end   = new DateTime( "$filter_year-$filter_month-$total_day" );

        $total_all_nominal  = 0;
        $total_all_subtotal  = 0;
        $total_all_lembar   = 0;
        $total_all_discount = 0;

        $result = array();
        for($i = $begin; $begin <= $end; $i->modify('+1 day')){
            $date = $i->format("Y-m-d");
            $tmp_result = $this->get_result( $filter_wahana, $date, $filter_user, $filter_vendor, $filter_bankget );
            $total_discount = $tmp_result['discount'];
            $sub_total = $tmp_result['nominal'];
            $total_lembar = $tmp_result['lembar'];
            $total = $sub_total-$total_discount;
            $result[] = array(
                'date'          => $i->format("d-m-Y"),
                'day'           => $this->get_day( $date ),
                'lembar'        => $total_lembar,
                'sub_total'     => $sub_total,
                'discount'      => $total_discount,
                'total_lembar'  => $total_lembar,
                'total'         => $total,
                'filter_wahana' => $filter_wahana,
                'month'         => $filter_month,
                'year'          => $filter_year
            );

            $total_all_lembar  += $total_lembar;
            $total_all_nominal += $total;
            $total_all_subtotal += $sub_total;
            $total_all_discount += $total_discount;
        }

        $result_vendor = array();
        $result_user = array();
        if( $filter_vendor ){
            $result_vendor = $this->vendorModel->getBySlugs($filter_vendor);
        }

        if( $filter_user ){
            $result_user = $this->userModel->getByID($filter_user);
            $data['filter_user']        =  $result_user->username;
            $data['filter_user_title']  =  $result_user->username;
        }else{
            $data['filter_user']        =  'All';
            $data['filter_user_title']  =  'All';
				}
				
				// if( $filter_bankget ) {
				// 	$this->db->group_start();
				// 	$this->db->where_in('t.transaction_bank', $filter_bankget);
				// 	$this->db->group_end();
				// }

        $data['subject']                = $this->subject;
        $data['module']                 = $this->module;
        $data['filter_month_name']      = $this->base_config->bulan_string( $filter_month );
        $data['wahana']                 = 'Daily Sales ...';
        $data['title']                  = 'Report Harian ...';
        $data['filter_wahana']          = ($filter_wahana) ? $filter_wahana : array();
        $data['filter_wahana_title']    = array_column($result_wahana,'product_title');
        $data['filter_month']           = $filter_month;
        $data['filter_year']            = $filter_year;
        $data['filter_vendor']          = ($filter_vendor) ? $filter_vendor : array();
        $data['filter_vendor_title']    = array_column($result_vendor,'vendor_name');
        $data['all_wahana']             = $result_all_wahana;
        $data['wahana']                 = $result_wahana;
        $data['wahana_title']           = ($filter_wahana) ? $filter_wahana : 'All';
        $data['result']                 = $result;
        $data['months']                 = $months;
        //$data['price']                  = $price;
        $data['total_nominal']          = $total_all_nominal;
        $data['total_subtotal']         = $total_all_subtotal;
        $data['total_lembar']           = $total_all_lembar;
        $data['total_discount']         = $total_all_discount;
        $data['this_month']             = $this->base_config->bulan_string( date('m') );
        $data['user_loket']             = $this->M_base_config->get_users_by_group('loket');
        $data['cabang']                 = @$data['company_name'];
        $data['vendors']                = $vendors;
        $data['payment_type']           = $paymentType;
        $data['gates']                  = $this->gateModel->get();
        $data['filter_gate']            = $filter_gate ? $filter_gate : array() ;
        $data['filter_type']            = $filter_type;

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
                'month'    => $data['filter_month'],
                'year'     => $data['filter_year'],
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
        }else{
            try{
                $objPHPExcel = new PhpOffice\PhpSpreadsheet\Spreadsheet();
                $activeSheet = $objPHPExcel->getActiveSheet();
                $activeSheet->setCellValueByColumnAndRow( 1,1, $data['subject'] );
                $activeSheet->setCellValueByColumnAndRow( 1,3, "Tanggal Laporan" );
                $activeSheet->setCellValueByColumnAndRow( 2,3, date('d-m-Y H:i:s'));
                $activeSheet->setCellValueByColumnAndRow( 1,4, "Bulan/Tahun" );
                $activeSheet->setCellValueByColumnAndRow( 2,4, $data['filter_year'] ? $data['filter_month_name'].' '.$data['filter_year'] : 'All' );
                $activeSheet->setCellValueByColumnAndRow( 1,5, "Wahana" );
                $activeSheet->setCellValueByColumnAndRow( 2,5, $data['filter_wahana'] ? implode(', ', $data['filter_wahana_title']) : 'All' );
                $activeSheet->setCellValueByColumnAndRow( 1,6, "Vendor" );
                $activeSheet->setCellValueByColumnAndRow( 2,6, $data['filter_vendor'] ? implode(', ', $data['filter_vendor_title']) : 'All' );
                $activeSheet->setCellValueByColumnAndRow( 1,7, "Loket" );
                $activeSheet->setCellValueByColumnAndRow( 2,7, $data['filter_user'] ? $data['filter_user_title'] : 'All' );
                $activeSheet->setCellValueByColumnAndRow( 1,13, "No" );
                $activeSheet->setCellValueByColumnAndRow( 2,13, "Hari" );
                $activeSheet->setCellValueByColumnAndRow( 3,13, "Tangal" );
                $activeSheet->setCellValueByColumnAndRow( 4,13, "Jumlah" );
                $activeSheet->setCellValueByColumnAndRow( 5,13, "Sub Total" );
                $activeSheet->setCellValueByColumnAndRow( 6,13, "Diskon" );
                $activeSheet->setCellValueByColumnAndRow( 7,13, "Total" );
                $activeSheet->mergeCellsByColumnAndRow(1,1,7,1);
                foreach ($data['result'] as $row => $prop) {
                    $activeSheet->setCellValueByColumnAndRow(1, $row+14, $row+1);
                    $activeSheet->setCellValueByColumnAndRow(2, $row+14, $prop['day'] );
                    $activeSheet->setCellValueByColumnAndRow(3, $row+14, $prop['date'] );
                    $activeSheet->setCellValueByColumnAndRow(4, $row+14, $prop['lembar'] );
                    $activeSheet->setCellValueByColumnAndRow(5, $row+14, $prop['sub_total'] );
                    $activeSheet->setCellValueByColumnAndRow(6, $row+14, $prop['discount'] );
                    $activeSheet->setCellValueByColumnAndRow(7, $row+14, $prop['total'] );
                }
                $activeSheet->setCellValueByColumnAndRow(4, count($data['result'])+14, @$data['total_lembar'] );
                $activeSheet->setCellValueByColumnAndRow(5, count($data['result'])+14, @$data['total_subtotal'] );
                $activeSheet->setCellValueByColumnAndRow(6, count($data['result'])+14, @$data['total_discount'] );
                $activeSheet->setCellValueByColumnAndRow(7, count($data['result'])+14, @$data['total_nominal'] );
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

    /**
     * @param array $id_wahana
     * @param string $date
     * @param int $user_id
     * @param array $vendor
     * @return array
     */
    protected function get_result($id_wahana=array(), $date=null, $user_id=null, $vendor=array() , $filter_bankget=null )
    {
        $this_price = 0;
        $this_total = 0;
        $this_discount = 0;

        $this->db->join('tb_transaction t', 't.transaction_id=d.transaction_id');
        if( $vendor ) {
            $this->db->group_start();
            $this->db->where_in('t.transaction_vendor', $vendor);
            $this->db->group_end();
        }
        if( $id_wahana ) {
            $this->db->group_start();
            $this->db->where_in('d.product_id', $id_wahana);
            $this->db->group_end();
        }
        if( $filter_bankget) {
            $this->db->group_start();
            $this->db->where_in('t.transaction_bank', $filter_bankget);
            $this->db->group_end();
        }
        if( $user_id ) $this->db->where('user_id', $user_id);
        if( $date ) $this->db->where('DATE(t.transaction_created)', $date); #todo
        // if( $date ) $this->db->where('DATE(t.transaction_date_used)', $date);
        $this->db->where("t.transaction_paid", '1');
        $this_result = $this->db->get('tb_transaction_detail d')->result();

        foreach ($this_result as $v){
            $jumlah_tiket = (int)$v->transaction_detail_qty;
            $this_price += (int)$v->transaction_detail_price*$jumlah_tiket;
            $this_discount += (int)$v->transaction_detail_discount;
            $this_total += $jumlah_tiket;
        }
        return array(
            'lembar'        => $this_total,
            'nominal'       => $this_price,
            'discount'      => $this_discount,
        );
    }

    protected function get_day( $date ){
        $name = date('D', strtotime($date));
        switch ($name){
            case 'Fri':
                return 'Jumat';
                break;
            case 'Sat':
                return 'Sabtu';
                break;
            case 'Sun':
                return 'Minggu';
                break;
            case 'Mon':
                return 'Senin';
                break;
            case 'Tue':
                return 'Selasa';
                break;
            case 'Wed':
                return 'Rabu';
                break;
            case 'Thu':
                return 'Kamis';
                break;
            default :
                return $date;
        }
    }

}