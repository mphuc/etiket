<?php
/**
 * Created by PhpStorm.
 * User: zazin
 * Date: 03/11/2018
 * Time: 20.42
 * @property  CI_Config $config
 * @property  CI_Loader load
 * @property  CI_DB_query_builder $db
 */

class DiscountModel extends CI_Model
{
    protected $table = 'tb_discount_product';
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed|array
     */
    public function getAll()
    {
        $this->db->order_by('dp_name','asc');
        return $this->db->get($this->table)->result_array();
    }

    /**
     * @param array $ids
     * @return array
     */
    public function getByProductId($ids=array())
    {
        $this->db->select('dp_id,dp_name');
        $this->db->join('tb_discount_product dp','dp.dp_id=p.product_package_id');
        if( $ids ) $this->db->where_in('p.product_combination_id', $ids);
        $this->db->group_by('dp_id');
        $this->db->order_by('dp.dp_name','asc');
        return $this->db->get('tb_member_card_package p')->result_array();
    }

    /**
     * @param array $ids
     * @return array
     */
    public function getByDiscountId($discountIds=array(), $productIds=array())
    {
        $this->db->select('dp.dp_name, product_package_id as discount_id,product_combination_id as product_id,mp_discount as discount');
        $this->db->join('tb_discount_product dp','dp.dp_id=p.product_package_id');
        if( $discountIds ) $this->db->where_in('p.product_package_id', $discountIds);
        if( $productIds ) $this->db->where_in('p.product_combination_id', $productIds);
        $this->db->order_by('dp.dp_name','asc');
        return $this->db->get('tb_member_card_package p')->result_array();
    }

}