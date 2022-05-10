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
 */
class Cms_report_price extends MX_Controller
{
    protected $table = 'tb_price';
    protected $subject = 'Data report_price';
    protected $module;
    protected $primary_key = 'price_id';

    public function __construct()
    {
        parent::__construct();
        $this->module = str_replace('cms_', '', strtolower( get_class($this) ) );
        $this->load->model('vendorModel');
        $this->load->model('gateModel');
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
        $data['vendors'] = $this->vendorModel->get();
        $data['gate'] = $this->gateModel->get();
        view_back( "cms_$this->module/views/v_list", $data);
    }

    protected function _get()
    {
        $this->role();
        $from   = $this->input->get('from');
        $to     = $this->input->get('to');
        $gate   = $this->input->get('gate');
        $vendor = $this->input->get('vendor');
        if( $from && $to ) {
            $this->db->where('DATE(price_date) >=', $from);
            $this->db->where('DATE(price_date) <=', $to);
        }
        if( $gate ) $this->db->where('pd.gate_name', $gate);
        if( $vendor ) $this->db->where('pc.vendor', $vendor);
        $this->db->where('pc.price_type', 'date');
        $this->db->join('tb_product pd','pd.product_id=pc.product_id');
        $this->db->join('tb_vendor v','v.vendor_slug=pc.vendor');
        $this->db->order_by('v.vendor_order','asc');
        $this->db->order_by('pc.price_date','asc');
        $this->db->order_by('pd.product_order','asc');
        $data = $this->db->get( "$this->table pc")->result_array();
        return $data;
    }

    protected function _get_day()
    {
        $this->role();
        $gate   = $this->input->get('gate');
        $vendor = $this->input->get('vendor');
        if( $gate ) $this->db->where('pd.gate_name', $gate);
        if( $vendor ) $this->db->where('pc.vendor', $vendor);
        $this->db->where('pc.price_type', 'day');
        $this->db->join('tb_product pd','pd.product_id=pc.product_id');
        $this->db->join('tb_vendor v','v.vendor_slug=pc.vendor');
        $this->db->order_by('v.vendor_order','asc');
        $this->db->order_by('pd.product_order','asc');
        $data = $this->db->get( "$this->table pc")->result_array();
        return $data;
    }

    public function get()
    {
        json_response( $this->_get() );
    }

    public function get_day()
    {
        json_response( $this->_get_day() );
    }

    public function export()
    {
        ini_set('memory_limit', '1048M');
        $this->role();

        $priceDates = $this->_get();
        $priceDays  = $this->_get_day();

        $from   = $this->input->get('from');
        $to     = $this->input->get('to');
        $gate   = $this->input->get('gate');
        $vendor = $this->input->get('vendor');

        $filter = array(
            'from'  => $from,
            'to'    => $to,
            'gate'  => $gate,
            'vendor' => $vendor,
        );

        try{
            $objPHPExcel = new PhpOffice\PhpSpreadsheet\Spreadsheet();
            $activeSheet = $objPHPExcel->getActiveSheet();
            $activeSheet->setCellValueByColumnAndRow( 1,1, "Laporan Harga Tiket" );
            $activeSheet->setCellValueByColumnAndRow( 1,3, "Tanggal Laporan" );
            $activeSheet->setCellValueByColumnAndRow( 2,3, date('d-m-Y H:i:s'));
            $activeSheet->setCellValueByColumnAndRow( 1,4, "From" );
            $activeSheet->setCellValueByColumnAndRow( 2,4, $filter['from'] );
            $activeSheet->setCellValueByColumnAndRow( 1,5, "To" );
            $activeSheet->setCellValueByColumnAndRow( 2,5, $filter['to'] );
            $activeSheet->setCellValueByColumnAndRow( 1,6, "Vendor" );
            $activeSheet->setCellValueByColumnAndRow( 2,6, $filter['vendor'] ? $filter['vendor'] : 'All' );
            $activeSheet->setCellValueByColumnAndRow( 1,7, "Gate" );
            $activeSheet->setCellValueByColumnAndRow( 2,7, $filter['gate'] ? $filter['gate'] : 'All' );
            $activeSheet->setCellValueByColumnAndRow( 1,9, "No" );
            $activeSheet->setCellValueByColumnAndRow( 2,9, "Product" );
            $activeSheet->setCellValueByColumnAndRow( 3,9, "Price" );
            $activeSheet->setCellValueByColumnAndRow( 4,9, "Day/date" );
            $activeSheet->setCellValueByColumnAndRow( 5,9, "Vendor" );
            $activeSheet->mergeCellsByColumnAndRow(1,1,7,1);
            foreach ($priceDays as $row => $prop) {
                $activeSheet->setCellValueByColumnAndRow(1, $row+10, $row+1);
                $activeSheet->setCellValueByColumnAndRow(2, $row+10, $prop['product_title'] );
                $activeSheet->setCellValueByColumnAndRow(3, $row+10, $prop['price'] );
                $activeSheet->setCellValueByColumnAndRow(4, $row+10, $prop['price_day'] );
                $activeSheet->setCellValueByColumnAndRow(5, $row+10, $prop['vendor'] );
            }
            $countDays = count($priceDays);
            foreach ($priceDates as $row => $prop) {
                $activeSheet->setCellValueByColumnAndRow(1, $row+11+$countDays, $row+1);
                $activeSheet->setCellValueByColumnAndRow(2, $row+11+$countDays, $prop['product_title'] );
                $activeSheet->setCellValueByColumnAndRow(3, $row+11+$countDays, $prop['price'] );
                $activeSheet->setCellValueByColumnAndRow(4, $row+11+$countDays, $prop['price_date'] );
                $activeSheet->setCellValueByColumnAndRow(5, $row+11+$countDays, $prop['vendor'] );
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