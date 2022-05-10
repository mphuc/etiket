<?php
/**
 * @property  CI_Lang $lang
 * @property  CI_DB_query_builder $db
 * @property  CI_Config $config
 */
class ProductModel extends CI_Model
{
    protected $table = 'tb_product';
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param int $category
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function get($limit=0, $offset=0, $category=null)
    {
        if( $limit ) $this->db->limit($limit);
        if( $offset ) $this->db->offset($offset);
        if( $category ) $this->db->where('category_id',$category);
        $this->db->where('product_active','1');
        $this->db->order_by('product_order','asc');
        $this->db->order_by('product_title','asc');
        $data = $this->db->get($this->table)->result_array();
        return $data;
    }

    /**
     * @param int $category
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getOnlyTicket($limit=0, $offset=0, $category=null)
    {
        if( $limit ) $this->db->limit($limit);
        if( $offset ) $this->db->offset($offset);
        if( $category ) $this->db->where('category_id',$category);
        $this->db->where('is_ticket','1');
        $this->db->where('product_active','1');
        $this->db->order_by('product_order','asc');
        $this->db->order_by('product_title','asc');
        $data = $this->db->get($this->table)->result_array();
        return $data;
    }

    /**
     * @param int|array $id
     * @param int $category
     * @return array
     */
    public function getById($id, $category=null)
    {
        if( is_array($id) ){
            $this->db->group_start();
            $this->db->where_in('product_id', $id);
            $this->db->group_end();
        }else{
            $this->db->where('product_id', $id);
        }
        if( $category ) $this->db->where('category_id',$category);
        $this->db->where('product_active','1');
        $this->db->order_by('product_order','asc');
        $this->db->order_by('product_title','asc');
        if( is_array($id) ){
            $data = $this->db->get($this->table)->result_array();
        }else{
            $data = $this->db->get($this->table)->row_array();
        }
        return $data;
    }

    /**
     * @param int|array $orderId
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getByCategoryId($id)
    {
        if( is_array($id) ){
            $this->db->group_start();
            $this->db->where_in('category_id', $id);
            $this->db->group_end();
        }else{
            $this->db->where('category_id', $id);
        }
        $this->db->where('product_active','1');
        $this->db->order_by('product_order','asc');
        $this->db->order_by('product_title','asc');
        $data = $this->db->get($this->table)->result_array();
        return $data;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        $this->db->where('product_active', '1');
        return $this->db->count_all_results($this->table);
    }

    /**
     * @param $productId int
     * @return mixed
     */
    public function packages($productId)
    {
        $this->db->where('product_package_id', $productId);
        $results = $this->db->get('tb_ticket_package')->result_array();
        return array_column($results,'product_combination_id');
    }

    /**
     * @param int $category
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function lastOrder()
    {
        $this->db->order_by('product_order','desc');
        $data = $this->db->get($this->table,1)->row('product_order');
        return $data;
    }

    /**
     * @param $date string
     * @param $vendor string
     * @return mixed|array
     */
    public function getProductPriceByDate($date, $vendor)
    {
        $this->db->where('price_date', $date);
        $this->db->where('price_type', 'date');
        $this->db->where('vendor', $vendor);
        $priceDateAvailable = $this->db->get('tb_price')->result_array();
        return $priceDateAvailable;
    }

    /**
     * @param $day string
     * @param $vendor string
     * @return mixed|array
     */
    public function getProductPriceByDay($day, $vendor)
    {
        $this->db->where('price_day', $day);
        $this->db->where('price_type', 'day');
        $this->db->where('vendor', $vendor);
        $priceAvailable = $this->db->get('tb_price')->result_array();
        return $priceAvailable;
    }

    /**
     * @param $date string
     * @return mixed|array
     */
    public function getProductByPromo($date)
    {
        $this->db->where("DATE(promo_date_start) <=" ,$date);
        $this->db->where("DATE(promo_date_end) >=" ,$date);
        $this->db->where('promo_active', '1');
        $price = $this->db->get('tb_promo')->result_array();
        return $price;
    }

    /**
     * @param $vendor string
     * @return array
     */
    public function getIdsDisplayByVendor($vendor)
    {
        $this->db->where('vendor', $vendor);
        $display = $this->db->get('tb_display_product')->result_array();
        $productIds = array_column($display,'product_id');
        return $productIds;
    }

    /**
     * @param string $vendor
     * @param string $date
     * @return array
     */
    public function getProductsByVendorAndDate($vendor='kidsfun', $date=null)
    {
        $this->db->where('vendor',$vendor);
        $displayProducts = $this->db->get('tb_display_product')->result_array();
        $productIds = array_column($displayProducts, 'product_id');
        $category = $this->input->get('category');
        if( !$date ) $date = date('Y-m-d');
        $day = date('l', strtotime($date));
        $products = $this->getById($productIds, $category);

        $priceDateAvailable = $this->getProductPriceByDate($date, $vendor);
        $priceAvailable     = $this->getProductPriceByDay($day, $vendor);
        $pricePromoAvailable= $this->getProductByPromo($date);

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
        return $products;
    }

    /**
     * @param array $id
     * @return mixed|boolean
     */
    public function remove($ids)
    {
        $this->db->where_in('product_id', $ids);
        $q = $this->db->delete($this->table);
        if( $q ){
            $this->db->where_in('product_id', $ids);
            $this->db->delete('tb_display_product');
        }
        return $q;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return string
     */
    public function createBarcode($limit=1000, $offset=0)
    {
        $path_barcode = FCPATH.'assets/uploads/barcode/';
        $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
        $products = $this->get($limit,$offset);
        $tmp = [];
        $tanggal = date('Y-m-d');
        foreach ($products as $kk => $product) {
            if( $product['product_code'] ){
                $title = date('Y-m-d', strtotime($tanggal)).'-'.$product['product_id'];
                try {
                    $barcode = $generator->getBarcode($product['product_code'], $generator::TYPE_CODE_128, 3, 30);
                } catch (\Picqer\Barcode\Exceptions\BarcodeException $e) {
                    echo 'Message: ' .$e->getMessage();
                }
                $file_location = $path_barcode.$title.".jpg";
                file_put_contents($file_location, $barcode);
                $imurl = $file_location;
                $file = imagecreatefromjpeg($imurl);
                //$rotim = imagerotate($file, 90, 0);
                //imagejpeg($rotim, $imurl);
                $data['barcode']            = "assets/uploads/barcode/$title.jpg";
                $data['title']              = $product['product_title'];
                $data['logo']               = 'themes/umbrella-back/2ndmaterial/img/logo-tv9.jpg';
                $data['id']                 = $product['product_id'];
                $data['code']               = $product['product_code'];
                $tmp[] = $data;

            }
        }
        $pdf = new FPDF('L','mm','A5');
        foreach ($tmp as $data)
        {
            $id = $data['id'];
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->SetFont('Times','',12);
            $pdf->Cell(195,110, '',1,0);
            $pdf->Ln(10);
            $pdf->Image($data['logo'],20,15,50);
            $pdf->Image($data['barcode'],15,80,170,30);
            $pdf->SetFont('Arial','B',20);
            $pdf->Cell(110);
            $pdf->SetFont('Arial','B',20);
            $pdf->Text(70, 30, $data['title']);
            $pdf->SetFont('Arial','',10);
            $pdf->Text(15, 115, $data['code']);
            $pdf->Ln(80);
            $pdf->Cell(110);
            $pdf->SetFont('Arial','B',20);
            $pdf->Ln(20);
        }
        $file_name = md5($id).'.pdf';
        $dir_name = $path_barcode;
        if(!is_dir( $dir_name )) {
            mkdir($dir_name, 0777, true);
        }
        foreach ($tmp as $p) {
            unlink($p['barcode']);
        }
        echo $pdf->Output( $dir_name.'/'.$file_name, 'I' );
        exit();
        //return $file_name;
    }
}