<?php
/**
 * @property  CI_Lang $lang
 * @property  CI_DB_query_builder $db
 * @property  CI_Config $config
 * @property  ApiModel apiModel
 * @property  OrderModel orderModel
 * @property  OrderDetailModel orderDetailModel
 * @property  CI_Loader load
 * @property  CategoryModel categoryModel
 * @property  ProductModel productModel
 */
class TicketModel extends CI_Model
{
    protected $table = 'tb_ticket';
    public function __construct()
    {
        parent::__construct();
        $this->load->model('apiModel');
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
        $this->db->order_by('ticket_date','desc');
        $this->db->order_by('ticket_id','desc');
        $data = $this->db->get($this->table)->result_array();
        return $data;
    }

    /**
     * @param string $code
     * @param string $date
     * @return int|boolean
     */
    public function exist($date, $code)
    {
        $this->db->where('ticket_date', $date);
        $this->db->where('ticket_code', $code);
        $data = $this->db->count_all_results($this->table);
        return $data;
    }

    /**
     * @param string $date
     * @return array
     */
    public function getCodes($date)
    {
        $this->db->select('ticket_code');
        $this->db->where('ticket_date', $date);
        $data = $this->db->get($this->table)->result_array();
        return array_column($data, 'ticket_code');
    }

    /**
     * @param int|array $orderId
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getByOrderDetailId($orderId)
    {
        if( is_array($orderId) ){
            $this->db->where_in('transaction_detail_id', $orderId);
        }else{
            $this->db->where('transaction_detail_id', $orderId);
        }
        $this->db->order_by('ticket_date','desc');
        $this->db->order_by('ticket_id','desc');
        $data = $this->db->get($this->table);
        return $data->result_array();
    }

    /**
     * @param int|array $userId
     * @param int|array $productId
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getByUserProductId($userId,$productId)
    {
        if( is_array($productId) ){
            $this->db->group_start();
            $this->db->where_in('td.product_id', $productId);
            $this->db->group_end();
        }else{
            $this->db->where('td.product_id', $productId);
        }
        if( is_array($userId) ){
            $this->db->group_start();
            $this->db->where_in('tr.user_id', $userId);
            $this->db->group_end();
        }else{
            $this->db->where('tr.user_id', $userId);
        }
        $this->db->join('tb_transaction_detail td','td.transaction_detail_id=tc.transaction_detail_id');
        $this->db->join('tb_transaction tr','tr.transaction_id=td.transaction_id');
        $this->db->order_by('ticket_date','desc');
        $this->db->order_by('ticket_id','desc');
        $data = $this->db->get($this->table. ' tc');
        return $data->result_array();
    }

    /**
     * @param int|array $userId
     * @param int|array $productId
     * @param string|array $dateUsed
     * @return array
     */
    public function getByUserProductIdDateUsed($userId,$productId,$dateUsed)
    {
        if( is_array($productId) ){
            $this->db->group_start();
            $this->db->where_in('tc.product_id', $productId);
            $this->db->group_end();
        }else{
            $this->db->where('tc.product_id', $productId);
        }
        if( is_array($userId) ){
            $this->db->group_start();
            $this->db->where_in('tr.user_id', $userId);
            $this->db->group_end();
        }else{
            $this->db->where('tr.user_id', $userId);
        }
        if( is_array($dateUsed) ){
            $this->db->group_start();
            $this->db->where_in('tr.transaction_date_used', $dateUsed);
            $this->db->group_end();
        }else{
            $this->db->where('tr.transaction_date_used', $dateUsed);
        }
        $this->db->join('tb_transaction_detail td','td.transaction_detail_id=tc.transaction_detail_id');
        $this->db->join('tb_transaction tr','tr.transaction_id=td.transaction_id');
        $this->db->order_by('ticket_date','desc');
        $this->db->order_by('ticket_id','desc');
        $data = $this->db->get($this->table. ' tc');
        return $data->result_array();
    }

    /**
     * @param $date string
     * @param $qty int
     * @param $length int
     * @return array
     */
    public function generate($date, $qty=1, $length=10)
    {
        $data = [];
        $tickets = $this->getCodes($date);
        for( $i=1;$i<=$qty;$i++ ){
            $unique = $this->apiModel->randomString($length, true);
            while( in_array($unique,$tickets) || in_array($unique,$data) ){
                $unique = $this->apiModel->randomString($length, true);
            }
            $data[] = $unique;
        }
        return $data;
    }

    /**
     * @param array $orderId
     * @return bool|int
     */
    // public function create($orderIds)
    // {
    //     $this->load->config('kidsfun');
    //     $this->load->model('categoryModel');
    //     $this->load->model('orderDetailModel');
    //     $this->load->model('orderModel');
    //     $this->load->model('productModel');
    //     $ticketPackageCategorySlug = $this->config->item('kids_ticket_package');
    //     $categoryPackage = $this->categoryModel->getBySlug($ticketPackageCategorySlug);
    //     $orders = $this->orderModel->getByIds($orderIds);
    //     if( !$orders ) return false;
    //     foreach ($orders as $order){
    //         $orderDetails   = $this->orderDetailModel->getByOrderId( $order['transaction_id'] );
    //         $orderDetailIds = array_column($orderDetails, 'transaction_detail_id');
    //         if( $orderDetailIds ) $this->delete($orderDetailIds);
    //         $date = $order['transaction_date_used'];
    //         $dataInsertTicket = [];
    //         $total = 0;
    //         $total_qty = 0;
    //         $count_to_generate = 0;
    //         foreach ($orderDetails as $k => $data) {
    //             $productId  = $data['product_id'];
    //             $qty        = $data['transaction_detail_qty'];
    //             $sub_total  = $data['transaction_detail_subtotal'];
    //             for($i=0;$i<$qty;$i++){
    //                 if( $data['category_id'] == $categoryPackage['category_id'] ){
    //                     $productIdPackages = $this->productModel->packages($productId);
    //                     foreach ($productIdPackages as $j => $pip) {
    //                         if( $j > 0 ) $count_to_generate++;
    //                         $dataInsertTicket[] = [
    //                             'transaction_detail_id' => $data['transaction_detail_id'],
    //                             'ticket_code'           => $total_qty+$i+$j,
    //                             'ticket_active'         => 0,
    //                             'ticket_date'           => $date,
    //                             'product_id'            => $pip,
    //                         ];
    //                     }
    //                 }else{
    //                     $dataInsertTicket[] = [
    //                         'transaction_detail_id' => $data['transaction_detail_id'],
    //                         'ticket_code'           => $total_qty+$i,
    //                         'ticket_active'         => 0,
    //                         'ticket_date'           => $date,
    //                         'product_id'            => $productId,
    //                     ];
    //                 }
    //             }
    //             $total_qty += $qty;
    //             $count_to_generate += $qty;
    //             $total += $sub_total;
    //         }
    //         $codes = $this->generate( $date, $count_to_generate );
    //         $newdataInsertTicket = array_map(function ($map)use($codes){
    //             return [
    //                 'transaction_detail_id' => $map['transaction_detail_id'],
    //                 'ticket_code'           => $codes[$map['ticket_code']],
    //                 'ticket_active'         => $map['ticket_active'],
    //                 'ticket_date'           => $map['ticket_date'],
    //                 'product_id'            => $map['product_id']
    //             ];
    //         }, $dataInsertTicket);
    //         $this->db->insert_batch('tb_ticket', $newdataInsertTicket);
    //     }
    //     return true;
    // }

    public function create($orderIds)
    {

        $this->load->model('orderDetailModel');
        $this->load->model('orderModel');


        $orders = $this->orderModel->getByIds($orderIds);
        if( !$orders ) return false;
        foreach ($orders as $order){
            $orderDetails   = $this->orderDetailModel->getByOrderId( $order['transaction_id'] );
            $orderDetailIds = array_column($orderDetails, 'transaction_detail_id');
            $this->delete($orderDetailIds);
            $date = $order['transaction_date_used'];
            $dataInsertTicket = [];
            $total = 0;
            $total_qty = 0;
            $count_to_generate = 0;
            $i = 0;
            foreach ($orderDetails as $k => $data) {
                $productId  = $data['product_id'];
                $qty        = $data['transaction_detail_qty'];
                $sub_total  = $data['transaction_detail_subtotal'];
                // for($i=0;$i<$qty;$i++){
                        $dataInsertTicket[] = [
                            'transaction_detail_id' => $data['transaction_detail_id'],
                            'ticket_code'           => $total_qty,
                            'ticket_qty'            => $qty,
                            'ticket_active'         => 0,
                            'ticket_date'           => $date,
                            'product_id'            => $productId,
                        ];

                // }
                $total_qty += $qty;
                $count_to_generate += $qty;
                $total += $sub_total;
            }
            $codes = $this->generate( $date, $count_to_generate );
            $newdataInsertTicket = array_map(function ($map)use($codes){
                return [
                    'transaction_detail_id' => $map['transaction_detail_id'],
                    'ticket_code'           => $codes[$map['ticket_code']],
                    'ticket_qty'            => $map['ticket_qty'],
                    'ticket_active'         => $map['ticket_active'],
                    'ticket_date'           => $map['ticket_date'],
                    'product_id'            => $map['product_id']
                ];
            }, $dataInsertTicket);
            $this->db->insert_batch('tb_ticket', $newdataInsertTicket);
        }
        return true;
    }

    /**
     * @param int $orderId
     * @return bool|object
     */
    public function setActive($orderId)
    {
        $this->load->model('orderDetailModel');
        $orderDetails = $this->orderDetailModel->getByOrderId($orderId);
        $orderDetailIds = array_column($orderDetails, 'transaction_detail_id');
        if( $orderDetailIds ){
            $this->db->where_in('transaction_detail_id', $orderDetailIds);
            $ticketUpdate = array('ticket_active' => '0');
            return $this->db->update('tb_ticket', $ticketUpdate);
        }
        return false;
    }

    /**
     * @param int $orderId
     * @return bool|object
     */
    public function setNonActive($id)
    {
        $this->db->where('ticket_id',$id);
        return $this->db->update('tb_ticket', array('ticket_active' => '1'));
    }

    /**
     * @param int|array $orderDetailId
     * @return mixed
     */
    public function delete($orderDetailId)
    {
        if( is_array($orderDetailId) ){
            $this->db->where_in('transaction_detail_id',$orderDetailId);
        }else{
            $this->db->where('transaction_detail_id',$orderDetailId);
        }
        return $this->db->delete($this->table);
    }

    /**
     * @param int $userId
     * @param string $date
     * @return int
     */
    public function getTotal($userId=null, $date=null)
    {
        $this->db->select_sum('ticket_qty');
        $this->db->join('tb_transaction_detail td','td.transaction_detail_id=tc.transaction_detail_id');
        $this->db->join('tb_transaction tr','tr.transaction_id=td.transaction_id');
        if( $userId ) $this->db->where('tr.user_id', $userId);
        if( $date ) $this->db->where('DATE(tc.ticket_date)', $date);
        return $this->db->get($this->table.' tc')->row('ticket_qty');
    }

    /**
     * @param int $id
     * @return array
     */
    public function getById($id, $userId=null)
    {
        if( $userId ){
            $this->db->where('ticket_id',$id); //todo sampai sini
            $data = $this->db->get($this->table)->row_array();
            return $data;
        }else{
            $this->db->where('ticket_id',$id);
            $data = $this->db->get($this->table)->row_array();
            return $data;
        }
    }

    public function getByCode($code, $gate,$date=null)
    {
        if( !$date ) $date = date('Y-m-d');
        $this->db->where('pd.gate_name', trim($gate));
        $this->db->where('DATE(tc.ticket_date)', $date);
        $this->db->where('tc.ticket_code', trim($code));
        $this->db->join('tb_product pd','pd.product_id=tc.product_id');
        return $this->db->get("$this->table tc",1)->row_array();
    }

    /**
     * @param int $ticketId
     * @param int $userId
     * @return array
     */
    public function getActivebyUserId($userId, $ticketId)
    {
        $this->db->where('tc.ticket_id', $ticketId);
        $this->db->where('tr.user_id', $userId);
        $this->db->join('tb_transaction_detail td','td.transaction_detail_id=tc.transaction_detail_id');
        $this->db->join('tb_transaction tr','tr.transaction_id=td.transaction_id');
        $this->db->order_by('tc.ticket_date','desc');
        $this->db->order_by('tc.ticket_id','desc');
        $data = $this->db->get($this->table. ' tc', 1)->row();
        return $data;
    }

    /**
     * @param int $userId
     * @return array
     */
    public function getGroupProductByUser($userId)
    {
        $transactions = $this->orderModel->getByUser($userId);
        $transactionIds = array_column($transactions,'transaction_id');
        if( !$transactionIds ) json_response(array());
        $this->db->select('t.ticket_date,p.*, c.*,COUNT(p.product_id) as count');
        $this->db->join('tb_product p','p.product_id=t.product_id');
        $this->db->join('tb_category c','c.category_id=p.category_id');
        $this->db->join('tb_transaction_detail td','td.transaction_detail_id=t.transaction_detail_id');
        $this->db->where_in('td.transaction_id', $transactionIds);
        $this->db->group_by('t.product_id,t.ticket_date');
        $this->db->order_by('t.ticket_date', 'desc');
        $data = $this->db->get($this->table.' t')->result_array();
        return $data;
    }

    public function getTicketCode($detail_transaction){
        $this->db->where('transaction_detail_id', $detail_transaction);
        return $this->db->get('tb_ticket',1)->row('ticket_code');
    }

    public function cek_tiket_guna($id, $tgl)
    {
        $sql = "SELECT * FROM tb_ticket WHERE ticket_code = '".$id."' AND ticket_date = '".$tgl."' AND 
        ticket_active = 1";
                //echo $sql;
		$que = $this->db->query($sql);
		
        if ($que->num_rows() > 0) {
            return $que->row();
        } else {
            return false;
        }
    }
    public function cek_jadwal($id, $tgl)
    {
        $sql = "SELECT * FROM tb_ticket WHERE ticket_code = '".$id."' AND ticket_date = '".$tgl."' AND 
        ticket_active = 0";
                //echo $sql;
		$que = $this->db->query($sql);
		
        if ($que->num_rows() > 0) {
            return $que->row();
        } else {
            return false;
        }
    }

    public function cek_id($id)
    {
        $query_str =
            $this->db->where('ticket_code', $id)
            ->get('tb_ticket');
        if ($query_str->num_rows() > 0) {
            return $query_str->row();
        } else {
            return false;
        }
    }


}