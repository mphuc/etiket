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

class DetailDiscountModel extends CI_Model
{
    protected $table = 'tb_detail_discount';
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param array $id
     * @return array
     */
    public function getByOrderDetailId($id=array())
    {
        $this->db->where_in('transaction_detail_id',$id);
        return $this->db->get($this->table)->result_array();
    }

    /**
     * @param string $type
     * @param array $id
     * @return array
     */
    public function getByType($type, $id)
    {
        $this->db->group_start();
        $this->db->where_in('transaction_detail_id',$id);
        $this->db->group_end();
        $this->db->group_start();
        $this->db->where_in('dd_type', $type);
        $this->db->group_end();
        return $this->db->get($this->table)->result_array();
    }

}