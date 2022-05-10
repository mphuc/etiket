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
 * @property    CategoryModel categoryModel
 * @property    ProductModel productModel
 * @property    GateModel gateModel
 * @property    VendorModel vendorModel
 * @property    OrderModel orderModel
 */
class Cms_product extends MX_Controller
{
    protected $table = 'tb_product';
    protected $subject = 'Data product';
    protected $module;
    protected $primary_key = 'product_id';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('categoryModel');
        $this->load->model('productModel');
        $this->load->model('gateModel');
        $this->load->model('vendorModel');
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
        $data = $this->setting->get_all();
        //$data['nastable'] = true;
        $data['subject']    = $this->subject;
        $data['module']     = $this->module;
        $data['pk']         = $this->primary_key;
        $data['categories'] = $this->categoryModel->get('product','category_order');
        $data['gates']      = $this->gateModel->get();
        view_back( "cms_$this->module/views/v_list", $data);
    }

    public function add()
    {
        $this->role();
        $data = $this->setting->get_all();
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ){
            $_POST['product_price'] = filter_var($_POST['product_price'], FILTER_SANITIZE_NUMBER_INT);
            $this->db->insert( $this->table, $_POST );
            $id = $this->db->insert_id();
            $vendors = $this->vendorModel->get();
            $displays = [];
            foreach ($vendors as $v){
                $displays[] = [
                    'product_id' => $id,
                    'vendor'     => $v['vendor_slug'],
                ];
            }
            if( $displays ) $this->db->insert_batch('tb_display_product', $displays);
            json_response( 'Sukses' );
        }
        $data['nastable'] = true;
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
        $data['pk'] = $this->primary_key;
        $data['categories'] = $this->categoryModel->get('product','category_order');
        $data['count'] = $this->productModel->lastOrder();
        $data['gate'] = $this->gateModel->get();
        view_back( "cms_$this->module/views/v_add", $data);
    }

    public function edit()
    {
        $this->role();
        $id = $this->uri->segment(4);
        $data = $this->setting->get_all();
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ){
            $id = $_POST[$this->primary_key];
            $_POST['product_price'] = filter_var($_POST['product_price'], FILTER_SANITIZE_NUMBER_INT);
            $this->db->where($this->primary_key, $id );
            $this->db->update( $this->table, $_POST );
            json_response( 'Sukses' );
        }

        $this->db->where( $this->primary_key, $id );
        $results = $this->db->get( $this->table, 1 )->row_array();
        $data['nastable'] = true;
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
        $data['row'] = $results;
        $data['pk'] = $this->primary_key;
        $data['categories'] = $this->categoryModel->get('product','category_order');
        $data['count'] = $this->productModel->lastOrder();
        $data['gate'] = $this->gateModel->get();
        view_back( "cms_$this->module/views/v_edit", $data);
    }

    public function get()
    {
        $this->role();
        $limit = $this->input->get('limit');
        $page = $this->input->get('page');
        $product_title = $this->input->get('product_title');
        $category_id = $this->input->get('category_id');
        $gate_name = $this->input->get('gate_name');
        if( !$limit ) $limit=20;

        if( !$page ){
            $page = 0;
        }else{
            $page = ($page-1)*$limit;
        }
        if( $product_title ){
            $this->db->group_start();
            $this->db->like('p.product_title', $product_title);
            $this->db->group_end();
        }
        if( $category_id ) $this->db->where('p.category_id', $category_id);
        if( $gate_name ) $this->db->where('p.gate_name', $gate_name);
        $this->db->join("tb_category c","c.category_id=p.category_id");
        $this->db->order_by('p.product_order','asc');
        $this->db->order_by('p.product_title','asc');
        $data = $this->db->get( "$this->table p", $limit, $page)->result_array();
        /*$ids = array_column($data,'category_id');
        $categories = $this->categoryModel->getByIds($ids);
        $newData = array_map(function ($product)use($categories){
            $category = array_filter($categories, function ($element)use($product){
                return $element['category_id'] == $product['category_id'];
            });
            $product['category'] = reset($category);
            return $product;
        }, $data);*/
        json_response(  $data );
    }

    public function rows()
    {
        $this->role();
        $product_title = $this->input->get('product_title');
        $category_id = $this->input->get('category_id');
        $gate_name = $this->input->get('gate_name');
        if( $product_title ){
            $this->db->group_start();
            $this->db->like('p.product_title', $product_title);
            $this->db->group_end();
        }
        if( $category_id ) $this->db->where('p.category_id', $category_id);
        if( $gate_name ) $this->db->where('p.gate_name', $gate_name);
        $this->db->join("tb_category c","c.category_id=p.category_id");
        $rows = $this->db->count_all_results($this->table. ' p');
        json_response( $rows );
    }

    public function delete()
    {
        $this->role();
        $id = $this->uri->segment(4);
        if( $id ){
            $ids = explode('-', $id);
            $exist = $this->orderModel->productExist($ids);
            if( $exist ){
                json_response('Gagal menghapus data, data sedang digunakan di transaksi', 400);
            }else{
                $this->productModel->remove($ids);
                json_response( 'Sukses menghapus data' );
            }
        }else{
            json_response( 'Gagal menghapus data, Silahkan ulangi lagi!', 400 );
        }
    }

    public function delete_price()
    {
        $this->role();
        $id = $this->uri->segment(4);
        if( $id ){
            $ids = explode('-', $id);
            $this->db->where_in( 'price_id', $ids);
            $this->db->delete('tb_price');
            json_response( 'Sukses menghapus data' );
        }else{
            json_response( 'Gagal menghapus data, Silahkan ulangi lagi!', 400 );
        }
    }

    public function upload()
    {
        $this->role();
        if( !empty($_FILES) ){
            $config['upload_path']          = 'assets/uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('file'))
            {
                json_response( ['status' => 0, 'message' => strip_tags($this->upload->display_errors()) ] );
            } else {
                json_response( $this->upload->data() );
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

    public function price()
    {
        $this->role();
        $id = $this->uri->segment(4);
        if( !$id ) $id = $this->input->get('product_id');
        $vendors = $this->vendorModel->get();
        $vendorSlug = $this->input->get('vendor');
        if( !$vendorSlug ) {
            $vendor = reset($vendors);
        }else{
            $vendor = $this->db->where('vendor_slug', $vendorSlug)->get('tb_vendor')->row_array();
        }
        $this->db->where( $this->primary_key, $id );
        $results = $this->db->get( $this->table, 1 )->row_array();
        if( !$results ) show_404();
        $data = $this->setting->get_all();
        $data['nastable']   = true;
        $data['subject']    = $this->subject;
        $data['module']     = $this->module;
        $data['pk']         = $this->primary_key;
        $data['row']        = $results;
        $data['product_id'] = $id;
        $data['vendors']    = $vendors;
        $data['vendor']     = $vendor;
        $this->db->where('price_type', 'day');
        $this->db->where('product_id', $id);
        $dataPriceDays = $this->db->get('tb_price')->result_array();
        $priceDay = array();
        foreach (getDays() as $day) {
            $resultPrice = array_filter($dataPriceDays, function ($el)use($day, $vendor){
                return $el['price_day'] == $day && $el['vendor'] == $vendor['vendor_slug'];
            });
            $price = array_column($resultPrice, 'price');
            $priceDay[$day] = reset($price);
        }
        $data['price_day'] = $priceDay;
        view_back( "cms_$this->module/views/v_price", $data);
    }

    public function get_price()
    {
        $this->role();
        $filterType = 'date';
        $limit = $this->input->get('limit');
        $page = $this->input->get('page');
        $vendor = $this->input->get('vendor');
        $filterProductId =  $this->input->get('product_id');
        /*if( !$limit ) $limit=20;
        if( !$page ){
            $page = 0;
        }else{
            $page = ($page-1)*$limit;
        }*/
        $this->db->join('tb_product','tb_product.product_id=tb_price.product_id');
        if( $filterProductId ) $this->db->where('tb_price.product_id', $filterProductId);
        if( $filterType ) $this->db->where('price_type', $filterType);
        $this->db->where('DATE(price_date)>=', date('Y-m-d'));
        if( $vendor ) $this->db->where('vendor', $vendor);
        $this->db->order_by('price_date','asc');
        //$data = $this->db->get( 'tb_price', $limit, $page)->result_array();
        $data = $this->db->get( 'tb_price')->result_array();
        json_response(  $data );
    }

    public function update_day()
    {
        $this->role();
        $_POST = json_decode(file_get_contents('php://input'), true);
        foreach ( getDays() as $day ){
            $this->form_validation->set_rules($day, $day, 'required');
        }
        $this->form_validation->set_rules('product_id', 'product_id', 'required');
        $this->form_validation->set_rules('vendor', 'vendor', 'required');
        //$this->form_validation->set_rules('price_discount', 'price_discount', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            json_response(validation_errors(), 400);
        }
        else
        {
            $product_id = $this->input->post('product_id');
            $vendor = $this->input->post('vendor');
            $days = [];
            $insertData = [];
            foreach ( getDays() as $day ){
                $currentPrice = filter_var($this->input->post($day), FILTER_SANITIZE_NUMBER_INT);
                if( $currentPrice > 0 ) {
                    $insertData[] = [
                        'product_id'    => $product_id,
                        'price'         => $currentPrice,
                        'price_day'     => $day,
                        'vendor'        => $vendor,
                        'price_type'    => 'day',
                    ];
                    $days[] = $day;
                }
            }
            if( $days ){
                $this->db->group_start();
                $this->db->where_in('price_day', $days);
                $this->db->group_end();
                $this->db->where('product_id', $product_id);
                $this->db->where('vendor', $vendor);
                $this->db->delete('tb_price');
            }
            $this->db->insert_batch('tb_price', $insertData);
            json_response('Success');
        }
    }

    public function update_date()
    {
        $this->role();
        $_POST = json_decode(file_get_contents('php://input'), true);
        $this->form_validation->set_rules('product_id', 'product_id', 'required');
        $this->form_validation->set_rules('date', 'date', 'required');
        $this->form_validation->set_rules('price', 'price', 'required');
        //$this->form_validation->set_rules('price_discount', 'price_discount', 'required');
        $this->form_validation->set_rules('vendor', 'vendor', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            json_response(validation_errors(), 400);
        }
        else
        {
            $date           = date('Y-m-d', strtotime($this->input->post('date')));
            $price_discount = 0; //$this->input->post('price_discount');
            $product_id     = $this->input->post('product_id');
            $vendor         = $this->input->post('vendor');
            $currentPrice   = filter_var($this->input->post('price'), FILTER_SANITIZE_NUMBER_INT);
            if( $currentPrice > 0 ){
                $insertData = [
                    'product_id'    => $product_id,
                    'price'         => $currentPrice,
                    'price_date'    => trim($date),
                    'price_discount'=> $price_discount,
                    'vendor'        => $vendor,
                    'price_type'    => 'date',
                ];
                $this->db->where('price_date', trim($date));
                $this->db->where('product_id', $product_id);
                $this->db->where('vendor', $vendor);
                $this->db->where('price_type', 'date');
                $this->db->delete('tb_price');
                $this->db->insert('tb_price', $insertData);
            }
            json_response('Success');
        }
    }

    public function update_display()
    {
        $this->role();
        $_POST = json_decode(file_get_contents('php://input'), true);
        $this->form_validation->set_rules('product_id', 'product_id', 'required');
        $this->form_validation->set_rules('date', 'date', 'required');
        $this->form_validation->set_rules('price', 'price', 'required');
        //$this->form_validation->set_rules('price_discount', 'price_discount', 'required');
        $this->form_validation->set_rules('vendor', 'vendor', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            json_response(validation_errors(), 400);
        }
        else
        {
            $date           = date('Y-m-d', strtotime($this->input->post('date')));
            $price_discount = 0; //$this->input->post('price_discount');
            $product_id     = $this->input->post('product_id');
            $vendor         = $this->input->post('vendor');
            $currentPrice   = filter_var($this->input->post('price'), FILTER_SANITIZE_NUMBER_INT);
            if( $currentPrice > 0 ){
                $insertData = [
                    'product_id'    => $product_id,
                    'price'         => $currentPrice,
                    'price_date'    => $date,
                    'price_discount'=> $price_discount,
                    'vendor'        => $vendor,
                    'price_type'    => 'date',
                ];
                $this->db->where('price_date', $date);
                if( $vendor ) $this->db->where('vendor', $vendor);
                $this->db->delete('tb_price');
                $this->db->insert('tb_price', $insertData);
            }
            json_response('Success');
        }
    }

    public function display()
    {
        $this->role();
        if( $_POST ){
            $this->form_validation->set_rules('vendor', 'vendor', 'required');
            if ($this->form_validation->run() == FALSE)
            {
                json_response(validation_errors());
            }
            else
            {
                $vendor = $this->input->post('vendor');
                $this->db->where('vendor', $vendor);
                $this->db->delete('tb_display_product');
                $products = $this->productModel->get();
                $insert = array();
                foreach ($products as $product) {
                    $value = $this->input->post($product['product_id']);
                    if( $value == 1){
                        $insert[] = array(
                            'product_id'    => $product['product_id'],
                            'vendor'        => $vendor
                        );
                    }
                }
                if( $insert ) $this->db->insert_batch('tb_display_product', $insert);
                redirect("cms/$this->module/display");
            }
        }
        $vendors = $this->vendorModel->get();
        $data = $this->setting->get_all();
        $selectedVendor = $this->vendorModel->getFirst();
        $filter_vendor = $this->input->get('vendor');
        if( $filter_vendor ) $selectedVendor = $this->vendorModel->getBySlug($filter_vendor);
        $data['selected_vendor'] = $selectedVendor;
        $data['nastable']   = true;
        $data['subject']    = $this->subject;
        $data['module']     = $this->module;
        $data['pk']         = $this->primary_key;
        $data['vendors']    = $vendors;
        $data['products']   = $products = $this->productModel->get();
        $this->db->where('vendor',$selectedVendor['vendor_slug']);
        $dataProductDisplay = $this->db->get('tb_display_product')->result_array();
        $display = array();

        $tmp = array();
        foreach ($products as $product) {
            $resultDisplay = array_filter($dataProductDisplay,function ($el)use($product){
                return $el['product_id'] == $product['product_id'];
            });
            $resultOne = reset($resultDisplay);
            $tmp[$product['product_id']] = (boolean)$resultOne;
        }
        $display[$selectedVendor['vendor_slug']] = $tmp;

        $data['display']    = $display;
        view_back( "cms_$this->module/views/v_display", $data);
    }

    public function barcode()
    {
        $this->role();
        $this->productModel->createBarcode();
    }
}