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
 * @property    DetailDiscountModel detailDiscountModel
 * @property    UserModel userModel
 * @property    DiscountModel discountModel
 * @property    GateModel gateModel
 */
class Cms_report_transaction extends MX_Controller
{
    protected $table = 'tb_transaction_detail';
    protected $subject = 'Data report_transaction';
    protected $module;
    protected $primary_key = 'transaction_detail_id';

    public function __construct()
    {
        parent::__construct();
        $this->module = str_replace('cms_', '', strtolower( get_class($this) ) );
        $this->load->model('detailDiscountModel');
        $this->load->model('discountModel');
        $this->load->model('gateModel');
        $this->load->model('userModel');
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
        $data['user_loket'] = $this->M_base_config->get_users_by_group('loket');
        $data['discount'] = $this->discountModel->getAll();
        $data['gate'] = $this->gateModel->get();
        $filter_bankget       = $this->input->get('bankget');
        $bankget                        = $this->userModel->getBank();
        $data['filter_bankget']          = $filter_bankget ? $filter_bankget : array() ;
        $data['bankget']                = $bankget;
        view_back( "cms_$this->module/views/v_list", $data);
    }

    public function get()
    {
        $this->role();
        $filter_user_id             = $this->input->get('user_id');
        $filter_transaction_from    = $this->input->get('from');
        $filter_transaction_to      = $this->input->get('to');
        $filter_transaction_uniq    = trim($this->input->get('transaction_uniq'));
        $filter_dd_type             = $this->input->get('dd_type');
        $filter_gate                = $this->input->get('gate');
        $filter_bankget             = $this->input->get('bankget');

        if( $filter_bankget ) {
            $this->db->group_start();
            $this->db->where_in('t.transaction_bank', $filter_bankget);
            $this->db->group_end();
        }
        if( !$filter_transaction_from ) $filter_transaction_from    = date('Y-m-d');
        if( !$filter_transaction_to )   $filter_transaction_to      = date('Y-m-d');
        if( $filter_user_id ){
            $this->db->where('t.user_id', $filter_user_id);
        }
        if( $filter_transaction_from && $filter_transaction_to ){
            $this->db->where('DATE(t.transaction_created) >=', $filter_transaction_from);
            $this->db->where('DATE(t.transaction_created) <=', $filter_transaction_to);
        }
        if( $filter_transaction_uniq ){
            $this->db->group_start();
            $this->db->like('t.transaction_uniq', $filter_transaction_uniq);
            $this->db->group_end();
        }
        if( $filter_gate ){
            $this->db->where('p.gate_name', $filter_gate);
        }        
        $this->db->join('tb_product p',"p.product_id=td.product_id");
        $this->db->join('tb_transaction t',"t.transaction_id=td.transaction_id");
        $this->db->join('tb_card_type ct',"ct.card_type_id=t.transaction_card_type", 'left');
        $this->db->join('tb_payee py',"py.payee_id=t.transaction_payee", 'left');
        $this->db->join('tb_bank b',"b.bank_id=t.transaction_bank", 'left');
        $this->db->join('tb_user u','u.id=t.user_id','left');

        $this->db->order_by('transaction_created','desc');
        $this->db->order_by('t.transaction_id','desc');
        $this->db->order_by('td.transaction_detail_id','desc');
        $data = $this->db->get( "$this->table td")->result_array();
        $detailIds = array_column($data,'transaction_detail_id');
        $detailDiscount = array();
        // if( $detailIds ) {
        //     $detailDiscount = $this->detailDiscountModel->getByOrderDetailId($detailIds);
        // }
        // if( $filter_dd_type ){
        //     $discounts = $this->detailDiscountModel->getByType($filter_dd_type, $detailIds);
        //     $discountTrxDetailIds = array_column($discounts, 'transaction_detail_id');
        //     $tmp = [];
        //     foreach ($data as $k => $v){
        //         if( in_array($v['transaction_detail_id'],$discountTrxDetailIds) ){
        //             $details = array_values(array_filter($detailDiscount, function($element)use($v){
        //                 return $element['transaction_detail_id'] == $v['transaction_detail_id'];
        //             }));
        //             $data[$k]['discount'] = $details;
        //             $v['discount'] = $details;
        //             $tmp[$k] = $v;
        //         }
        //     }
        //     json_response(  array_values($tmp) );
        // }else{
            foreach ($data as $k => $v){
                $details = array_values(array_filter($detailDiscount, function($element)use($v){
                    return $element['transaction_detail_id'] == $v['transaction_detail_id'];
                }));
                $data[$k]['discount'] = $details;
            }
            json_response(  $data );
        // }
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

    public function export()
    {
        ini_set('memory_limit', '1048M');
        $this->role();
        $filter                     = array();
        $filter_user_id             = $this->input->get('user_id');
        $filter_transaction_from    = $this->input->get('from');
        $filter_transaction_to      = $this->input->get('to');
        $filter_gate                = $this->input->get('gate');
        if( !$filter_transaction_from ) $filter_transaction_from    = date('Y-m-d');
        if( !$filter_transaction_to )   $filter_transaction_to      = date('Y-m-d');
        $filter_dd_type             = $this->input->get('dd_type');
        $filter['user_id']          = $filter_user_id;
        $filter['from']             = $filter_transaction_from;
        $filter['to']               = $filter_transaction_to;
        $filter['dd_type']          = $filter_dd_type;
        if( $filter_user_id ){
            $this->db->where('t.user_id', $filter_user_id);
        }
        if( $filter_transaction_from && $filter_transaction_to ){
            $this->db->where('DATE(t.transaction_created) >=', $filter_transaction_from);
            $this->db->where('DATE(t.transaction_created) <=', $filter_transaction_to);
        }
        if( $filter_gate ){
            $this->db->where('p.gate_name', $filter_gate);
        }
        $this->db->join('tb_product p',"p.product_id=td.product_id");
        $this->db->join('tb_transaction t',"t.transaction_id=td.transaction_id");
        $this->db->order_by('transaction_created','desc');
        $this->db->order_by('t.transaction_id','desc');
        $this->db->order_by('td.transaction_detail_id','desc');
        $data = $this->db->get( "$this->table td")->result_array();
        $detailIds = array_column($data,'transaction_detail_id');
        $detailDiscount = array();
        if( $detailIds ) $detailDiscount = $this->detailDiscountModel->getByOrderDetailId($detailIds);

        if( $filter_dd_type ){
            $discounts = $this->detailDiscountModel->getByType($filter_dd_type, $detailIds);
            $discountTrxDetailIds = array_column($discounts, 'transaction_detail_id');
            $tmp = [];
            foreach ($data as $k => $v){
                if( in_array($v['transaction_detail_id'],$discountTrxDetailIds) ){
                    $details = array_values(array_filter($detailDiscount, function($element)use($v){
                        return $element['transaction_detail_id'] == $v['transaction_detail_id'];
                    }));
                    $data[$k]['discount'] = $details;
                    $v['discount'] = $details;
                    $tmp[$k] = $v;
                }
            }
            $data = array_values($tmp);
        }else{
            foreach ($data as $k => $v){
                $details = array_values(array_filter($detailDiscount, function($element)use($v){
                    return $element['transaction_detail_id'] == $v['transaction_detail_id'];
                }));
                $data[$k]['discount'] = $details;
            }
        }

        $type = $this->input->get('export');
        if($type == 'pdf'){
            $toDay  = date('Y-m-d');
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
                $activeSheet->setCellValueByColumnAndRow( 1,1, "Laporan Hari ini" );
                $activeSheet->setCellValueByColumnAndRow( 1,3, "Tanggal Laporan" );
                $activeSheet->setCellValueByColumnAndRow( 2,3, date('d-m-Y H:i:s'));
                $activeSheet->setCellValueByColumnAndRow( 1,4, "Tanggal" );
                $activeSheet->setCellValueByColumnAndRow( 2,4, "$filter_transaction_from - $filter_transaction_to" );
                $activeSheet->setCellValueByColumnAndRow( 1,5, "Wahana" );
                //$activeSheet->setCellValueByColumnAndRow( 2,5, $data['filter_wahana'] ? implode(', ', $data['filter_wahana_title']) : 'All' );
                $activeSheet->setCellValueByColumnAndRow( 1,6, "Vendor" );
                //$activeSheet->setCellValueByColumnAndRow( 2,6, $data['filter_vendor'] ? implode(', ', $data['filter_vendor_title']) : 'All' );
                $activeSheet->setCellValueByColumnAndRow( 1,7, "Loket" );
                $activeSheet->setCellValueByColumnAndRow( 2,7, $filter_user_id ? $filter_user_id : 'All' );
                $activeSheet->setCellValueByColumnAndRow( 1,13, "No" );
                $activeSheet->setCellValueByColumnAndRow( 2,13, "Transaction Id" );
                $activeSheet->setCellValueByColumnAndRow( 3,13, "Product" );
                $activeSheet->setCellValueByColumnAndRow( 4,13, "Price" );
                $activeSheet->setCellValueByColumnAndRow( 5,13, "Qty" );
                $activeSheet->setCellValueByColumnAndRow( 6,13, "SubTotal" );
                $activeSheet->setCellValueByColumnAndRow( 7,13, "Discount" );
                $activeSheet->setCellValueByColumnAndRow( 8,13, "Total" );
                $activeSheet->setCellValueByColumnAndRow( 9,13, "Date" );
                $activeSheet->setCellValueByColumnAndRow( 10,13, "Vendor" );
                $activeSheet->setCellValueByColumnAndRow( 11,13, "User" );
                $activeSheet->setCellValueByColumnAndRow( 12,13, "Discount Type" );
                $activeSheet->setCellValueByColumnAndRow( 13,13, "transaction type" );
                $activeSheet->setCellValueByColumnAndRow( 14,13, "Access Gate" );
                $activeSheet->mergeCellsByColumnAndRow(1,1,7,1);
                foreach ($data as $row => $prop) {
                    $activeSheet->setCellValueByColumnAndRow(1, $row+14, $row+1);
                    $activeSheet->setCellValueByColumnAndRow(2, $row+14, $prop['transaction_uniq'] );
                    $activeSheet->setCellValueByColumnAndRow(3, $row+14, $prop['product_title'] );
                    $activeSheet->setCellValueByColumnAndRow(4, $row+14, $prop['transaction_detail_price'] );
                    $activeSheet->setCellValueByColumnAndRow(5, $row+14, $prop['transaction_detail_qty'] );
                    $activeSheet->setCellValueByColumnAndRow(6, $row+14, $prop['transaction_detail_subtotal'] );
                    $activeSheet->setCellValueByColumnAndRow(7, $row+14, $prop['transaction_detail_discount'] );
                    $activeSheet->setCellValueByColumnAndRow(8, $row+14, $prop['transaction_detail_subtotal'] - $prop['transaction_detail_discount'] );
                    $activeSheet->setCellValueByColumnAndRow(9, $row+14, $prop['transaction_created'] );
                    $activeSheet->setCellValueByColumnAndRow(10, $row+14, $prop['transaction_vendor'] );
                    $activeSheet->setCellValueByColumnAndRow(11, $row+14, $prop['user_id'] );
                    if( $prop['transaction_detail_discount'] > 0 ){
                        $tmp_discount = '';
                        foreach ($prop['discount'] as $d) {
                            $tmp_discount.= $d['dd_type'].' - '.$d['dd_percent_discount'].'%'.' - '.$d['dd_discount'];
                            $tmp_discount.= ' ; ';
                        }
                        $activeSheet->setCellValueByColumnAndRow(12, $row+14, $tmp_discount );
                    }else{
                        $activeSheet->setCellValueByColumnAndRow(12, $row+14, '' );
                    }
                    if( $prop['transaction_type'] == 'edc' ){
                        $activeSheet->setCellValueByColumnAndRow(13, $row+14, $prop['transaction_type'].','.$prop['transaction_bank'].','.$prop['transaction_card_type'].','.$prop['transaction_card_number']  );
                    }else if($prop['transaction_type'] == 'offline'){
                        $activeSheet->setCellValueByColumnAndRow(13, $row+14, 'cash' );
                    }else{
                        $activeSheet->setCellValueByColumnAndRow(13, $row+14, $prop['transaction_type'] );
                    }
                    $activeSheet->setCellValueByColumnAndRow(14, $row+14, $prop['gate_name'] );
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
}