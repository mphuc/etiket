<?php
/**
 * @property  CI_DB_query_builder $db
 */

class PriceModel extends CI_Model
{
    protected $table = 'tb_price';
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param array $productIds
     * @param array $date
     * @return array
     */
    public function get($productIds, $dates=null)
    {
        $this->db->group_start();
        $this->db->where_in('product_id', $productIds);
        $this->db->group_end();
        if( $dates ) {
            $this->db->group_start();
            $this->db->where_in('DATE(price_date)', $dates);
            $this->db->group_end();
        }
        $this->db->where('price >', '0');
        return $this->db->get($this->table)->result_array();
    }

    /**
     * @param array $productIds
     * @param string $dateFrom
     * @param string $dateTo
     * @return array
     */
    public function availabilityGroup($productIds, $dateFrom, $dateTo)
    {
        $this->db->group_start();
        $this->db->where_in('product_id', $productIds);
        $this->db->group_end();
        $this->db->where('DATE(price_date) >=',$dateFrom);
        $this->db->where('DATE(price_date) <=',$dateTo);
        $prices = $this->db->get($this->table)->result();

        $this->db->group_start();
        $this->db->where_in('product_id', $productIds);
        $this->db->group_end();
        $this->db->where('product_active','1');
        $products = $this->db->get('tb_product')->result_array();

        $defaults = array();
        foreach ($products as $item) {
            $res = array();
            $begin = new DateTime( $dateFrom );
            $end   = new DateTime( $dateTo );
            for($i = $begin; $i <= $end; $i->modify('+1 day')){
                $date = $i->format("Y-m-d");
                $filters = array_values(array_filter($prices, function ($price)use($item,$date){
                    return ($price->product_id == $item->product_id && $price->price_date == $date );
                }));
                $res[] = array(
                    'price'     => ($filters) ? reset($filters)->price : $item->product_price,
                    'date'      => $date,
                );
            }
            $defaults[$item->product_id] = (array)$item;
            $defaults[$item->product_id]['data'] = $res;
        }
        return $defaults;
    }

}