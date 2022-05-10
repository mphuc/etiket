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
 * @property  CI_Loader load
 * @property  VendorModel vendorModel
 * @property  UserModel userModel
 * @property  Setting setting
 * @property  GateModel gateModel
 */
class Cms_report_bulanan extends CI_Controller
{
    protected $module  = 'report_bulanan';
    protected $subject = 'Report Bulanan';
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
        $data['asset'] = $this->base_config->asset_back();
        $data['nav'] = 'yes';

        $filter_year    = $this->input->get('year');
        $filter_user    = $this->input->get('user');
        $filter_wahana  = $this->input->get('wahana');
        $filter_vendor  = $this->input->get('vendor');
        $filter_type    = $this->input->get('type');
        $filter_gate    = $this->input->get('gate');

        $filter_bankget       = $this->input->get('bankget');
        $bankget                        = $this->userModel->getBank();
        $data['filter_bankget']          = $filter_bankget ? $filter_bankget : array() ;
        $data['bankget']                = $bankget;

        $vendors = $this->vendorModel->get();
        $paymentType = array(
            array( 'id' => 'offline', 'title' => 'Cash' ),
            array( 'id' => 'debit', 'title' => 'Debit Card' ),
            array( 'id' => 'kredit', 'title' => 'Credit Card' ),
            array( 'id' => 'edc', 'title' => 'EDC' )
        );

        $this->db->select('product_id, product_title');
        $this->db->from('tb_product');
        //$this->db->where('product_price >', '0');
        $this->db->order_by('product_order','asc');
        $result_all_wahana = $this->db->get()->result_array();

        $this->db->select('product_id, product_title');
        if( $filter_wahana ) {
            $this->db->group_start();
            $this->db->where_in('product_id', $filter_wahana);
            $this->db->group_end();
        }
        //$this->db->where('product_price >', '0');
        $this->db->order_by('product_order','asc');
        $result_wahana = $this->db->get('tb_product')->result_array();

        if( !$filter_year ) $filter_year = date('Y');

        $result = array();
        $result_total_right = array();
        $result_total_bottom = array();

        for( $i=1; $i <= 12;$i++ ){

            $total_lembar      = 0;
            $total_nominal     = 0;
            $total_discount    = 0;
            $total_all_nominal = 0;
            $total_all_lembar  = 0;
            $total_all_discount= 0;

            foreach ( $result_wahana as $k => $v ){
                $tmp_result = $this->get_result( $v['product_id'], $i, $filter_year, $filter_user, $filter_vendor, $filter_bankget);
                $total_nominal  = $tmp_result['nominal'];
                $total_lembar   = $tmp_result['lembar'];
                $total_discount = $tmp_result['discount'];
                $result[$i][] = array(
                    'month'         => $this->base_config->bulan_string( $i ),
                    'lembar'        => $tmp_result['lembar'],
                    'nominal'       => $tmp_result['nominal'],
                    'discount'      => $tmp_result['discount'],
                    'total_lembar'  => $total_lembar,
                    'total_nominal' => $total_nominal,
                    'total_discount'=> $total_discount,
                    'filter_wahana' => $v['product_id'],
                    'year'          => $filter_year
                );

                $total_all_lembar   += $total_lembar;
                $total_all_nominal  += $total_nominal;
                $total_all_discount += $total_discount;

                $result_total_bottom[$k][] = array(
                    'all_lembar'    => $total_lembar,
                    'all_nominal'   => $total_nominal,
                    'all_discount'  => $total_discount,
                );
            }

            $result_total_right[$i] = array(
                'lembar'        => $total_lembar,
                'nominal'       => $total_nominal,
                'discount'      => $total_discount,
                'all_lembar'    => $total_all_lembar,
                'all_nominal'   => $total_all_nominal,
                'all_discount'  => $total_all_discount,
            );
        }

        $total_arr = array();
        foreach ($result_total_bottom as $v){
            $this_total = 0;
            foreach ($v as $v2){
                $this_total += $v2['all_nominal'];
            }
            $total_arr[] = $this_total;
        }

        $total_arr_discount = array();
        foreach ($result_total_bottom as $v){
            $this_total = 0;
            foreach ($v as $v2){
                $this_total += $v2['all_discount'];
            }
            $total_arr_discount[] = $this_total;
        }

        $total_arr_all = 0;
        foreach ($result_total_right as $v){
            $total_arr_all += $v['all_nominal'];
        }

        $total_discount_all = 0;
        foreach ($result_total_right as $v){
            $total_discount_all += $v['all_discount'];
        }

        $result_vendor = array();
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

        $data['subject']                = $this->subject;
        $data['module']                 = $this->module;
        $data['title']                  = 'LAPORAN BULANAN TAHUN '. $filter_year;
        $data['filter_year']            = $filter_year;
        $data['all_wahana']             = $result_all_wahana;
        $data['wahana']                 = $result_wahana;
        $data['filter_wahana']          = ($filter_wahana) ? $filter_wahana : array();
        $data['filter_wahana_title']    = array_column($result_wahana,'product_title');
        $data['filter_vendor']          = ($filter_vendor) ? $filter_vendor : array();
        $data['filter_vendor_title']    = array_column($result_vendor,'vendor_name');
        $data['result']                 = $result;
        $data['result_total_right']     = $result_total_right;
        $data['result_total_bottom']    = $total_arr;
        $data['result_total_all']       = $total_arr_all;
        $data['total_discount_all']     = $total_discount_all;
        $data['total_arr_discount']     = $total_arr_discount;
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
                'year'     => $data['filter_year'],
                'wahana'   => $data['filter_wahana'],
                'vendor'   => $data['filter_vendor'],
                'user'     => $data['filter_user'],
            );
            $data['filter'] = $filter;
            $pdf_html = view_back( "cms_$this->module/views/v_export-pdf", $data, true);
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($pdf_html);
            $dompdf->setPaper('A4','landscape');
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
                $activeSheet->setCellValueByColumnAndRow( 1,4, "Tahun" );
                $activeSheet->setCellValueByColumnAndRow( 2,4, $data['filter_year'] ? $data['filter_year'] : 'All' );
                $activeSheet->setCellValueByColumnAndRow( 1,5, "Wahana" );
                $activeSheet->setCellValueByColumnAndRow( 2,5, $data['filter_wahana'] ? implode(', ', $data['filter_wahana_title']) : 'All' );
                $activeSheet->setCellValueByColumnAndRow( 1,6, "Vendor" );
                $activeSheet->setCellValueByColumnAndRow( 2,6, $data['filter_vendor'] ? implode(', ', $data['filter_vendor_title']) : 'All' );
                $activeSheet->setCellValueByColumnAndRow( 1,7, "Loket" );
                $activeSheet->setCellValueByColumnAndRow( 2,7, $data['filter_user'] ? $data['filter_user_title'] : 'All' );
                $activeSheet->setCellValueByColumnAndRow( 1,13, "Bulan" );
                foreach($data['wahana'] as $key => $value){
                    $activeSheet->setCellValueByColumnAndRow( $key+2,13, $value['product_title'] );
                }
                $countWahana = count($data['wahana']);
                $activeSheet->setCellValueByColumnAndRow( $countWahana+2,13, "Total" );
                //$activeSheet->mergeCellsByColumnAndRow(1,1,13,1);
                foreach ($data['result'] as $row => $prop) {
                    $activeSheet->setCellValueByColumnAndRow(1, $row+14, $data['result'][$row][0]['month']);
                    foreach ($data['result'][$row] as $k2 => $v2) {
                        $activeSheet->setCellValueByColumnAndRow(2+$k2, $row+14, $v2['total_nominal']-$v2['total_discount'] );
                    }
                    $activeSheet->setCellValueByColumnAndRow($countWahana+2, $row+14, $data['result_total_right'][$row]['all_nominal']-$data['result_total_right'][$row]['all_discount'] );
                }
                $countResult = count($data['result']);
                $activeSheet->setCellValueByColumnAndRow(1, $countResult+14+2, 'Total' );
                foreach ($data['result_total_bottom'] as $key => $value) {
                    $activeSheet->setCellValueByColumnAndRow($key+2, $countResult+14+2, $value-$data['total_arr_discount'][$key]);
                }
                $countTotalBottom = count($data['result_total_bottom']);
                $activeSheet->setCellValueByColumnAndRow($countTotalBottom+2, $countResult+14+2, $data['result_total_all']-$data['total_discount_all']);
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
     * @param int $id_wahana
     * @param int $year
     * @param int $month
     * @param int $user_id
     * @param array $vendor
     * @return array
     */
    protected function get_result($id_wahana=null, $month=null, $year=null, $user_id=null, $vendor=array(), $filter_bankget=null )
    {
        $this_price    = 0;
        $this_total    = 0;
        $this_discount = 0;

        $this->db->join('tb_transaction t', 't.transaction_id=d.transaction_id');
        if( $vendor ) {
            $this->db->group_start();
            $this->db->where_in('t.transaction_vendor', $vendor);
            $this->db->group_end();
        }
        if( $filter_bankget) {
            $this->db->group_start();
            $this->db->where_in('t.transaction_bank', $filter_bankget);
            $this->db->group_end();
        }
        if( $id_wahana ) $this->db->where('d.product_id', $id_wahana);
        if( $user_id ) $this->db->where('user_id', $user_id);
        // if( $year ) $this->db->where("YEAR(t.transaction_date_used)", $year);
        if( $year ) $this->db->where("YEAR(t.transaction_created)", $year); #todo
        if( $month ) $this->db->where("MONTH(t.transaction_created)", $month); #todo
        // if( $month ) $this->db->where("MONTH(t.transaction_date_used)", $month);
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
            'subtotal'      => $this_price,
            'total'         => $this_price-$this_discount,
            'nominal'       => $this_price,
            'discount'      => $this_discount,
        );
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

}