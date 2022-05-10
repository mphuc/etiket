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
 * @property    UserModel userModel
 */
class Cms_report_ticket extends MX_Controller
{
    protected $table = 'tb_ticket';
    protected $subject = 'Data ticket';
    protected $module;

    public function __construct()
    {
        parent::__construct();
        $this->module = str_replace('cms_', '', strtolower( get_class($this) ) );
        $this->load->model('vendorModel');
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
        $lokets = $this->userModel->getByGroup('loket');
        $data['user_loket'] = $this->userModel->getByIDs($lokets);
        view_back( "cms_$this->module/views/v_list", $data);
    }

    public function get()
    {
        $this->role();
        $data = $this->_get();
        json_response(  $data['data'] );
    }

    protected function _get()
    {
        $filter                        = array();
        $filter['ticket_active']       = $this->input->get('ticket_active');
        $filter['ticket_date']         = $this->input->get('ticket_date');
        $filter['transaction_vendor']  = $this->input->get('transaction_vendor');
        $filter['user']                = $this->input->get('user');
        // $this->db->select('dt.*,p.*,t.*,tc.*,COUNT(ticket_id) as ticket_count');
        $this->db->select('p.product_title,tc.ticket_active,tc.ticket_date ,COUNT(ticket_id) as ticket_count');
        if( $filter['user'] ){
            $this->db->where('t.user_id', $filter['user']);
        }
        if( $filter['transaction_vendor'] ){
            $this->db->where('t.transaction_vendor', $filter['transaction_vendor']);
        }
        if( $filter['ticket_active'] ){
            $filter['ticket_active'] = ($filter['ticket_active'] == 'yes') ?  '1' : '0' ;
            $this->db->where('tc.ticket_active', $filter['ticket_active']);
        }
        if( $filter['ticket_date'] ){
            $this->db->where('DATE(tc.ticket_date)', $filter['ticket_date']);
        }
        // $this->db->join('tb_transaction_detail dt','dt.transaction_detail_id=tc.transaction_detail_id','left');
        // $this->db->join('tb_product p','p.product_id=tc.product_id','left');
        // $this->db->join('tb_transaction t','t.transaction_id=dt.transaction_id','left');
        // $this->db->group_by('tc.product_id');
        // $this->db->group_by('tc.ticket_active');
        // $this->db->order_by('p.product_order','asc');
        
        $this->db->join('tb_transaction_detail dt','dt.transaction_detail_id=tc.transaction_detail_id','left');
        $this->db->join('tb_product p','p.product_id=tc.product_id','left');
        $this->db->join('tb_transaction t','t.transaction_id=dt.transaction_id','left');
        // $this->db->group_by('tc.product_id');

        $this->db->group_by('p.product_title');
        $this->db->group_by('tc.ticket_active');
        $this->db->group_by('tc.ticket_date');
        // $this->db->order_by('p.product_order','asc');
        $data = $this->db->get( $this->table. ' tc')->result_array();
        return array(
            'filter'    => $filter,
            'data'      => $data
        );
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
            $toDay  = date('Y-m-d');
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
                $activeSheet->setCellValueByColumnAndRow( 1,1, "Laporan Tiket" );
                $activeSheet->setCellValueByColumnAndRow( 1,3, "Tanggal Laporan" );
                $activeSheet->setCellValueByColumnAndRow( 2,3, date('d-m-Y H:i:s'));
                $activeSheet->setCellValueByColumnAndRow( 1,4, "Tanggal" );
                $activeSheet->setCellValueByColumnAndRow( 2,4, $filter['ticket_date'] );
                $activeSheet->setCellValueByColumnAndRow( 1,5, "Used" );
                $activeSheet->setCellValueByColumnAndRow( 2,5, 'Yes');
                if( $filter['ticket_active'] == '0' ){
                    $activeSheet->setCellValueByColumnAndRow( 2,5, 'All' );
                }else{
                    $activeSheet->setCellValueByColumnAndRow( 2,5, $filter['ticket_active'] );
                }
                $activeSheet->setCellValueByColumnAndRow( 1,6, "Vendor" );
                $activeSheet->setCellValueByColumnAndRow( 2,6, $filter['transaction_vendor'] ? $filter['transaction_vendor'] : 'All' );
                $activeSheet->setCellValueByColumnAndRow( 1,7, "User" );
                $activeSheet->setCellValueByColumnAndRow( 2,7, $filter['user'] ? $filter['user'] : 'All' );
                $activeSheet->setCellValueByColumnAndRow( 1,9, "No" );
                $activeSheet->setCellValueByColumnAndRow( 2,9, "Product" );
                $activeSheet->setCellValueByColumnAndRow( 3,9, "Qty" );
                $activeSheet->setCellValueByColumnAndRow( 4,9, "Used" );
                $activeSheet->setCellValueByColumnAndRow( 5,9, "Date" );
                $activeSheet->mergeCellsByColumnAndRow(1,1,7,1);
                foreach ($data as $row => $prop) {
                    $activeSheet->setCellValueByColumnAndRow(1, $row+10, $row+1);
                    $activeSheet->setCellValueByColumnAndRow(2, $row+10, $prop['product_title'] );
                    $activeSheet->setCellValueByColumnAndRow(3, $row+10, $prop['ticket_count'] );
                    if( $prop['ticket_active'] == '1' ){
                        $activeSheet->setCellValueByColumnAndRow( 4,$row+10, 'Yes' );
                    }else{
                        $activeSheet->setCellValueByColumnAndRow( 4,$row+10, 'No' );
                    }
                    $activeSheet->setCellValueByColumnAndRow(5, $row+10, $prop['ticket_date'] );
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