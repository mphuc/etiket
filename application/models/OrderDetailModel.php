<?php
/**
 * @property  CI_Lang $lang
 * @property  CI_DB_query_builder $db
 * @property  CI_Config $config
 */
class OrderDetailModel extends CI_Model
{
    protected $table = 'tb_transaction_detail';
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param int $userId
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function get($limit=0, $offset=0)
    {
        if( $limit ) $this->db->limit($limit);
        if( $offset ) $this->db->offset($offset);
        $this->db->order_by('transaction_detail_id','desc');
        $data = $this->db->get($this->table)->result_array();
        return $data;
    }

    /**
     * @param int|array $orderId
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getByOrderId($orderId)
    {
        if( is_array($orderId) ){
            $this->db->where_in('t.transaction_id', $orderId);
        }else{
            $this->db->where('t.transaction_id', $orderId);
        }
        $this->db->join('tb_product p','p.product_id=t.product_id','left');
        $this->db->join('tb_transaction tr', 't.transaction_id = tr.transaction_id');
        $this->db->order_by('t.transaction_detail_id', 'desc');
        $data = $this->db->get($this->table.' t')->result_array();
        return $data;
    }

    /**
     * @param int $userId
     * @return array
     */
    public function getByUser($userId)
    {
        if( is_array($userId) ){
            $this->db->where_in('tr.user_id', $userId);
        }else{
            $this->db->where('tr.user_id', $userId);
        }
        $this->db->join('tb_product p','p.product_id=t.product_id');
        $this->db->join('tb_transaction tr','tr.transaction_id=t.transaction_id');
        $this->db->order_by('t.transaction_detail_id', 'desc');
        $data = $this->db->get($this->table.' t');
        return $data->result_array();
    }

    /**
     * @param int $userId
     * @return array
     */
    public function getGroupProductByUser($userId)
    {
        if( is_array($userId) ){
            $this->db->where_in('tr.user_id', $userId);
        }else{
            $this->db->where('tr.user_id', $userId);
        }
        $this->db->select('tr.transaction_date_used,p.*, c.*,COUNT(p.product_id) as count');
        $this->db->join('tb_product p','p.product_id=t.product_id');
        $this->db->join('tb_category c','c.category_id=p.category_id');
        $this->db->join('tb_transaction tr','tr.transaction_id=t.transaction_id');
        $this->db->group_by('t.product_id,tr.transaction_date_used');
        $this->db->order_by('tr.transaction_date_used', 'desc');
        $data = $this->db->get($this->table.' t')->result_array();
        return $data;
    }
}