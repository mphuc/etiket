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
 * @property   OrderDetailModel orderDetailModel
 * @property   DetailDiscountModel detailDiscountModel
 * @property   UserModel userModel
 */
class Cms_report_reservation extends MX_Controller
{
    protected $table = 'tb_reservation';
    protected $subject = 'report reservation';
    protected $module;
    protected $primary_key = 'res_id';

    public function __construct()
    {
        parent::__construct();
        $this->module = str_replace('cms_', '', strtolower( get_class($this) ) );
        $this->load->model('orderDetailModel');
        $this->load->model('detailDiscountModel');
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
        $reservasiUserIds = $this->userModel->getByGroup('reservasi');
        $data['users'] = $this->userModel->getByIDs($reservasiUserIds);
        view_back( "cms_$this->module/views/v_list", $data);
    }

    public function get()
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
        $this->db->select('u.username,t.*,r.*');
        $this->db->join('tb_transaction t','t.transaction_id=r.transaction_id');
        $this->db->join('tb_user u','u.id=t.user_id','left');
        $this->db->order_by('transaction_date_used','desc');
        $data = $this->db->get( "$this->table r")->result_array();
        json_response(  $data );
    }

    public function detail()
    {
        $this->role();
        $id = $this->input->get('id');
        $allDetails = $this->orderDetailModel->getByOrderId($id);
        $detailIds = array_column($allDetails,'transaction_detail_id');
        $detailDiscount = $this->detailDiscountModel->getByOrderDetailId($detailIds);
        foreach ($allDetails as $k => $v){
            $details = array_values(array_filter($detailDiscount, function($element)use($v){
                return $element['transaction_detail_id'] == $v['transaction_detail_id'];
            }));
            $allDetails[$k]['discount'] = $details;
        }

        json_response($allDetails);
    }

    public function export()
    {
        ini_set('memory_limit', '1048M');
        $this->role();
        $filter             = array();
        $user_id            = $this->input->get('user_id');
        $transaction_uniq   = $this->input->get('transaction_uniq');
        $from               = $this->input->get('from');
        $to                 = $this->input->get('to');

        if( !$from ) $from  = date('Y-m-d');
        if( !$to )   $to    = date('Y-m-d');

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
        $data = $this->db->get( "$this->table r")->result_array();

        $filter['user_id']          = $user_id;
        $filter['from']             = $from;
        $filter['to']               = $to;
        $filter['transaction_uniq'] = $transaction_uniq;

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
                $activeSheet->setCellValueByColumnAndRow( 1,1, "Laporan Reservasi" );
                $activeSheet->setCellValueByColumnAndRow( 1,3, "Tanggal Laporan" );
                $activeSheet->setCellValueByColumnAndRow( 2,3, date('d-m-Y H:i:s'));
                $activeSheet->setCellValueByColumnAndRow( 1,4, "Tanggal" );
                $activeSheet->setCellValueByColumnAndRow( 2,4, "$from - $to" );
                $activeSheet->setCellValueByColumnAndRow( 1,13, "No" );
                $activeSheet->setCellValueByColumnAndRow( 2,13, "Customer" );
                $activeSheet->setCellValueByColumnAndRow( 3,13, "Tanggal" );
                $activeSheet->setCellValueByColumnAndRow( 4,13, "Jam Kunjungan" );
                $activeSheet->setCellValueByColumnAndRow( 5,13, "Jam Acara" );
                $activeSheet->setCellValueByColumnAndRow( 6,13, "Jam Makan" );
                $activeSheet->setCellValueByColumnAndRow( 7,13, "Tempat" );
                $activeSheet->setCellValueByColumnAndRow( 8,13, "Total Person" );
                $activeSheet->setCellValueByColumnAndRow( 9,13, "Total Box" );
                $activeSheet->setCellValueByColumnAndRow( 10,13, "Keterangan Operasional" );
                $activeSheet->setCellValueByColumnAndRow( 11,13, "Keterangan Teknik" );
                $activeSheet->setCellValueByColumnAndRow( 12,13, "Keterangan Bus" );
                $activeSheet->setCellValueByColumnAndRow( 13,13, "Keterangan Tambahan" );
                $activeSheet->mergeCellsByColumnAndRow(1,1,7,1);
                foreach ($data as $row => $prop) {
                    $activeSheet->setCellValueByColumnAndRow(1, $row+14, $row+1);
                    $activeSheet->setCellValueByColumnAndRow(2, $row+14, $prop['res_customer'] );
                    $activeSheet->setCellValueByColumnAndRow(3, $row+14, $prop['transaction_date_used'] );
                    $activeSheet->setCellValueByColumnAndRow(4, $row+14, $prop['res_jam_kunjungan'] );
                    $activeSheet->setCellValueByColumnAndRow(5, $row+14, $prop['res_jam_acara'] );
                    $activeSheet->setCellValueByColumnAndRow(6, $row+14, $prop['res_jam_makan'] );
                    $activeSheet->setCellValueByColumnAndRow(7, $row+14, $prop['res_tempat'] );
                    $activeSheet->setCellValueByColumnAndRow(8, $row+14, $prop['res_total_person'] );
                    $activeSheet->setCellValueByColumnAndRow(9, $row+14, $prop['res_total_box'] );
                    $activeSheet->setCellValueByColumnAndRow(10, $row+14, $prop['res_note_operasional'] );
                    $activeSheet->setCellValueByColumnAndRow(11, $row+14, $prop['res_note_teknik'] );
                    $activeSheet->setCellValueByColumnAndRow(12, $row+14, $prop['res_note_bus'] );
                    $activeSheet->setCellValueByColumnAndRow(13, $row+14, $prop['res_note_tambahan'] );
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