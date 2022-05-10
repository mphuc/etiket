<?php
/**
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Parser $parser
 * @property Ion_auth|Ion_auth_model $ion_auth
 * @property M_base_config $M_base_config
 * @property base_config $base_config
 * @property CI_Lang $lang
 * @property CI_URI $uri
 * @property CI_DB_query_builder|CI_DB_mysqli_driver $db
 * @property CI_Config $config
 * @property CI_User_agent $agent
 * @property CI_Email $email
 * @property Base_config Base_config
 * @property Slug slug
 * @property ApiModel apiModel
 * @property UserModel userModel
 * @property CI_Loader load
 * @property ProductModel productModel
 * @property CategoryModel categoryModel
 * @property VendorModel vendorModel
 */

class Product extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('apiModel');
        $this->load->model('productModel');
        $this->load->model('categoryModel');
        $this->load->model('categoryModel');
        $this->load->model('vendorModel');
    }

    public function _product_get()
    {
        $vendor = $this->input->get_request_header('x-api-key');
        $this->db->where('vendor',$vendor);
        $displayProducts = $this->db->get('tb_display_product')->result_array();
        $productIds = array_column($displayProducts, 'product_id');
        if( !$productIds ){
            $vendor = $this->vendorModel->getFirst()['vendor_slug'];
            $this->db->where('vendor', $vendor);
            $displayProducts = $this->db->get('tb_display_product')->result_array();
            $productIds = array_column($displayProducts, 'product_id');
        }
        $category = $this->input->get('category');
        $date = $this->input->get('date');
        if( !$date ) $date = date('Y-m-d');
        $day = date('l', strtotime($date));
        $products = $this->productModel->getById($productIds, $category);

        $priceDateAvailable = $this->productModel->getProductPriceByDate($date, $vendor);
        $priceAvailable     = $this->productModel->getProductPriceByDay($day, $vendor);
        $pricePromoAvailable= $this->productModel->getProductByPromo($date);

        foreach ($products as $k => $product) {
            $priceDateResult = array_filter($priceDateAvailable, function ($el)use($product){
                return $el['product_id'] == $product['product_id'];
            });
            $priceResult = array_filter($priceAvailable, function ($el)use($product){
                return $el['product_id'] == $product['product_id'];
            });
            $pricePromoResult = array_filter($pricePromoAvailable, function ($el)use($product){
                return $el['product_id'] == $product['product_id'];
            });
            $priceDate  = reset($priceDateResult);
            $price      = reset($priceResult);
            $pricePromo = reset($pricePromoResult);
            $products[$k]['product_promo_price'] = '0';
            if( $pricePromo ){
                $priceNominalPromo = $pricePromo['promo_discount']*$products[$k]['product_price']/100;
                $priceCurrentPromo = $products[$k]['product_price']-$priceNominalPromo;
                $products[$k]['product_promo_price'] = $priceCurrentPromo;
            }
            if( $priceDate ) {
                $products[$k]['product_price'] = $priceDate['price'];
            }else{
                if( $price ) $products[$k]['product_price'] = $price['price'];
            }
        }
        json_response($products);
    }

    public function index()
    {
        $method = $this->apiModel->detectMethod();
        switch ($method){
            case 'get':
                $this->_product_get();
                break;
            default:
                json_response('Not Allowed', 405);
        }
    }

    public function category()
    {
        $vendor = $this->input->get_request_header('x-api-key');
        if( $vendor ){
            $categories = $this->categoryModel->getByVendor('product',$vendor,'category_order');
        }else{
            $categories = $this->categoryModel->get('product','category_order');
        }
        json_response( $categories );
    }
}