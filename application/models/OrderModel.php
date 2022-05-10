<?php
/**
 * @property  CI_Lang $lang
 * @property  CI_DB_query_builder $db
 * @property  CI_Config $config
 * @property  ApiModel apiModel
 * @property  ProductModel productModel
 * @property  TicketModel ticketModel
 * @property  UserModel userModel
 * @property  Setting setting
 */
class OrderModel extends CI_Model
{
    protected $table = 'tb_transaction';
    public function __construct()
    {
        parent::__construct();
        $this->load->model('userModel');
        $this->load->model('apiModel');
        $this->load->model('productModel');
        $this->load->model('ticketModel');
        $this->config->load('jwt');
    }

    /**
     * @param array|int $userId
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function get($limit=0, $offset=0, $userId=null)
    {
        if( $userId ) {
            if( is_array($userId) ){
                $this->db->group_start();
                $this->db->where_in('user_id', $userId);
                $this->db->group_end();
            }else{
                $this->db->where('user_id', $userId);
            }
        }
        if( $limit )$this->db->limit($limit);
        if( $offset ) $this->db->offset($offset);
        $this->db->order_by('transaction_id','desc');
        $this->db->order_by('transaction_created','desc');
        $data = $this->db->get($this->table)->result_array();
        return $data;
    }

    /**
     * @param int $userId
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getByUser($userId=null,$limit=0, $offset=0)
    {
        $data = $this->get($limit, $offset, $userId);
        return $data;
    }
    /**
     * @param $id int
     * @param $userId int
     * @return array
     */
    public function getById($id, $userId=null)
    {
        if( $userId ) $this->db->where('user_id',$userId);
        $this->db->where('transaction_id',$id);
        $this->db->order_by('transaction_created','desc');
        $data = $this->db->get($this->table,1)->row_array();
        return $data;
    }
    /**
     * @param $uniq string
     * @param $userId int
     * @return array
     */
    public function getByIdUniq($uniq, $userId=null)
    {
        if( $userId ) $this->db->where('user_id',$userId);
        $this->db->where('transaction_uniq',$uniq);
        $this->db->order_by('transaction_created','desc');
        // $data = $this->db->get($this->table,1)->row_array();
        $data = $this->db->get('tb_transaction')->row_array();
        return $data;
    }

    /**
     * @param $id array
     * @return array
     */
    public function getByIds($id)
    {
        $this->db->where_in('transaction_id',$id);
        $data = $this->db->get($this->table)->result_array();
        return $data;
    }

    /**
     * @param $data array
     * @param $dateUsed string
     * @param $type string
     * @param $userId int
     * @param $vendor string
     * @return boolean|mixed
     */
    public function add($userId=null, $dateUsed, $type='online', $details=array(), $guest=array(), $vendor='kidsfun-mobile')
    {
        $transaction_fee = $this->setting->get_single('setting_transaction','transaction_doku_fee');
        $transactionFee = 0;
        if( $transaction_fee ) $transactionFee = intval($transaction_fee);
        $user_name  = @$guest['name'];
        $user_phone = @$guest['phone'];
        $user_email = @$guest['email'];
        if( $userId ){
            $user = $this->userModel->getByID($userId);
            $user_name  = $user->user_display_name;
            $user_phone = $user->user_mobile;
            $user_email = $user->email;
        }else{
            $userRow = $this->userModel->getByEmail($user_email);
            if( $userRow ) $userId = $userRow->id;
        }
        if( !$details ) return false;
        $dateUsed   = date('Y-m-d',strtotime($dateUsed));
        $day        = date('l', strtotime($dateUsed));
        if( $dateUsed < date('Y-m-d') ) return false;
        $dataInsertDetail   = [];
        $total              = 0;
        $total_qty          = 0;
        $total_discount     = 0;
        $priceDateAvailable = $this->productModel->getProductPriceByDate($dateUsed, $vendor);
        $priceAvailable     = $this->productModel->getProductPriceByDay($day, $vendor);
        $pricePromoAvailable= $this->productModel->getProductByPromo($dateUsed);
        foreach ($details as $k => $data) {
            if( isset($data['product_id']) && isset($data['qty']) ){

                $product    = $this->productModel->getById( $data['product_id'] );
                $price      = intval($product['product_price']);
                $qty        = intval($data['qty']);

                $priceDateResult = array_filter($priceDateAvailable, function ($el)use($product){
                    return $el['product_id'] == $product['product_id'];
                });
                $priceResult = array_filter($priceAvailable, function ($el)use($product){
                    return $el['product_id'] == $product['product_id'];
                });
                $pricePromoResult = array_filter($pricePromoAvailable, function ($el)use($product){
                    return $el['product_id'] == $product['product_id'];
                });

                $discount   = 0;
                $priceDate  = reset($priceDateResult);
                $priceDay   = reset($priceResult);
                $pricePromo = reset($pricePromoResult);
                if( $pricePromo ) {
                    $priceNominalPromo  = $pricePromo['promo_discount'] * $price / 100;
                    $priceCurrentPromo  = $price - $priceNominalPromo;
                    $discount           = $priceCurrentPromo;
                } else if( $priceDate ) {
                    $price = $priceDate['price'];
                }else{
                    if( $priceDay ) $price = $priceDay['price'];
                }
                $sub_total  = $price * $qty;
                $dataInsertDetail[] = [
                    'product_id'                    => $product['product_id'],
                    'transaction_detail_price'      => $price,
                    'transaction_detail_qty'        => $qty,
                    'transaction_detail_subtotal'   => $sub_total,
                    'transaction_detail_discount'   => $discount*$qty,
                ];
                $total_qty += $qty;
                $total_discount += $discount*$qty;
                $total += $sub_total;
            }else{
                return false;
            }
        }
        $dataInsert = [
            'user_id'                 => $userId,
            'transaction_total'       => $total,
            'transaction_fee'         => $transactionFee,
            'transaction_type'        => $type,
            'transaction_date_used'   => $dateUsed,
            'transaction_created'     => date('Y-m-d H:i:s'),
            'transaction_code'        => $this->generateTransactionUniqueCode($dateUsed, 6),
            'transaction_pass'        => $this->apiModel->randomString(6, true),
            'transaction_paid'        => '0',
            'transaction_user_name'   => $user_name,
            'transaction_user_email'  => $user_email,
            'transaction_user_phone'  => $user_phone,
            'transaction_vendor'      => $vendor,
            'transaction_discount'    => $total_discount
        ];
        $this->db->insert($this->table, $dataInsert);
        $insert_id = $this->db->insert_id();
        $unique = md5($insert_id.$this->config->item('md5_secret'));
        $transactionUpdate = array(
            'transaction_uniq' => strtoupper($unique)
        );
        $this->db->where('transaction_id', $insert_id);
        $this->db->update( $this->table, $transactionUpdate);
        $newdataInsertDetail = array_map(function ($map)use($insert_id){
            return [
                'transaction_id'                => $insert_id,
                'product_id'                    => $map['product_id'],
                'transaction_detail_price'      => $map['transaction_detail_price'],
                'transaction_detail_qty'        => $map['transaction_detail_qty'],
                'transaction_detail_subtotal'   => $map['transaction_detail_subtotal'],
                'transaction_detail_discount'   => $map['transaction_detail_discount'],
            ];
        }, $dataInsertDetail);
        $this->db->insert_batch('tb_transaction_detail', $newdataInsertDetail);
        return $insert_id;
    }

    /**
     * @param $details array
     * @param $dateUsed string
     * @param $userId int
     * @param $transaction_paid int
     * @return boolean|mixed
     */
    public function addMarketing($userId, $dateUsed, $details=array(), $transaction_paid=0)
    {
        $vendor = 'reservasi';
        $type   = 'marketing'; //todo change this
        $transaction_fee = $this->setting->get_single('setting_transaction','transaction_doku_fee');
        $transactionFee = 0;
        if( $transaction_fee ) $transactionFee = intval($transaction_fee);
        $user = $this->userModel->getByID($userId);
        $user_name  = $user->user_display_name;
        $user_phone = $user->user_mobile;
        $user_email = $user->email;
        if( !$details ) return false;
        $dateUsed   = date('Y-m-d',strtotime($dateUsed));
        if( $dateUsed < date('Y-m-d') ) return false;
        $dataInsertDetail   = [];
        $total              = 0;
        $total_qty          = 0;
        $total_discount     = 0;
        foreach ($details as $k => $data) {
            if( isset($data['product_id']) && isset($data['qty']) && isset($data['product_price']) && isset($data['discount']) ){
                $price      = $data['product_price'];
                $qty        = $data['qty'];
                $discount   = $data['discount'];
                $sub_total  = $price * $qty;
                $dataInsertDetail[] = [
                    'product_id'                    => $data['product_id'],
                    'transaction_detail_price'      => $price,
                    'transaction_detail_qty'        => $qty,
                    'transaction_detail_subtotal'   => $sub_total,
                    'transaction_detail_discount'   => $discount,
                ];
                $total_qty += $qty;
                $total_discount += $discount;
                $total += $sub_total;
            }else{
                return false;
            }
        }
        $dataInsert = [
            'user_id'                 => $userId,
            'transaction_total'       => $total,
            'transaction_fee'         => $transactionFee,
            'transaction_type'        => $type,
            'transaction_date_used'   => $dateUsed,
            'transaction_created'     => date('Y-m-d H:i:s'),
            'transaction_code'        => $this->generateTransactionUniqueCode($dateUsed, 6),
            'transaction_pass'        => $this->apiModel->randomString(6, true),
            'transaction_paid'        => $transaction_paid,
            'transaction_user_name'   => $user_name,
            'transaction_user_email'  => $user_email,
            'transaction_user_phone'  => $user_phone,
            'transaction_vendor'      => $vendor,
            'transaction_discount'    => $total_discount
        ];
        if( $transaction_paid ) $dataInsert['transaction_status'] = 'Success';
        $this->db->insert($this->table, $dataInsert);
        $insert_id = $this->db->insert_id();
        $unique = md5($insert_id.$this->config->item('md5_secret'));
        $transactionUpdate = array(
            'transaction_uniq' => strtoupper($unique)
        );
        $this->db->where('transaction_id', $insert_id);
        $this->db->update( $this->table, $transactionUpdate);
        $newdataInsertDetail = array_map(function ($map)use($insert_id){
            return [
                'transaction_id'                => $insert_id,
                'product_id'                    => $map['product_id'],
                'transaction_detail_price'      => $map['transaction_detail_price'],
                'transaction_detail_qty'        => $map['transaction_detail_qty'],
                'transaction_detail_subtotal'   => $map['transaction_detail_subtotal'],
                'transaction_detail_discount'   => $map['transaction_detail_discount'],
            ];
        }, $dataInsertDetail);
        $this->db->insert_batch('tb_transaction_detail', $newdataInsertDetail);
        return $insert_id;
    }

    /**
     * @param int $userId
     * @param string $date
     * @return int
     */
    public function getTotalNominal($userId=null, $date=null)
    {
        $this->db->select_sum('transaction_total');
        $this->db->where('transaction_paid', '1');
        if( $userId ) $this->db->where('user_id', $userId);
        if( $date ) $this->db->where('DATE(transaction_created)', $date); //todo
        // if( $date ) $this->db->where('DATE(transaction_date_used)', $date);
        $total = $this->db->get($this->table)->row('transaction_total');

        $this->db->select_sum('transaction_discount');
        $this->db->where('transaction_paid', '1');
        if( $userId ) $this->db->where('user_id', $userId);
        if( $date ) $this->db->where('DATE(transaction_created)', $date); //todo
        // if( $date ) $this->db->where('DATE(transaction_date_used)', $date);
        $discount = $this->db->get($this->table)->row('transaction_discount');
        return $total-$discount;
    }

    /**
     * @param int $orderId
     * @param string $status
     * @return object|boolean
     */
    public function setPaid($orderId, $status='Success')
    {
        $this->db->where('transaction_id', $orderId);
        return $this->db->update('tb_transaction', array('transaction_paid' => '1', 'transaction_status' => $status));
    }

    /**
     * @param string $date
     * @return array
     */
    public function getTransactionCodes($date)
    {
        $this->db->select('transaction_code');
        $this->db->where('transaction_date_used', $date);
        $data = $this->db->get($this->table)->result_array();
        return array_column($data, 'ticket_code');
    }

    /**
     * @param string $date
     * @param int $length
     * @return string
     */
    public function generateTransactionUniqueCode($date, $length=6)
    {
        $transactions = $this->getTransactionCodes($date);
        $unique = $this->apiModel->randomString($length, true);
        while( in_array($unique, $transactions) ){
            $unique = $this->apiModel->randomString($length, true);
        }
        return $unique;
    }

    /**
     * @param string $code
     * @param string $pass
     * @return mixed|void
     */
    public function ticketCollects($code, $pass)
    {
        $this->db->join('tb_transaction_detail td','td.transaction_id=t.transaction_id');
        $this->db->where('t.transaction_code', $code);
        $this->db->where('t.transaction_pass', $pass);
        $this->db->where('t.transaction_paid', '1');
        $this->db->where('DATE(t.transaction_date_used)>=', date('Y-m-d'));
        $this->db->order_by('t.transaction_date_used','asc');
        $transactions = $this->db->get($this->table. ' t')->result_array();
        $transaction_detail_ids = array_column($transactions, 'transaction_detail_id');
        if( !$transaction_detail_ids ){
            $this->apiModel->attempsBlockAdd();
            json_response( 'TICKET NOT FOUND', 404 );
        }else{
            $this->db->join('tb_transaction_detail td','td.transaction_detail_id=tc.transaction_detail_id');
            $this->db->join('tb_product pd','pd.product_id=td.product_id');
            $this->db->group_start();
            $this->db->where_in('tc.transaction_detail_id', $transaction_detail_ids);
            $this->db->group_end();
            $this->db->where('DATE(tc.ticket_date)>=', date('Y-m-d'));
            $this->db->where('tc.ticket_active', '0');
            $result = $this->db->get('tb_ticket tc')->result_array();
            json_response($result);
        }
    }

    /**
     * @param int $day
     * @return mixed|array
     */
    public function getYesterday($status='pending') //get transaction 2 days ago
    {
        $this->db->where('DATE(transaction_created) <',date('Y-m-d', strtotime("-1 day")));
        $this->db->where('transaction_status', $status);
        return $this->db->get($this->table)->result_array();
    }

    /**
     * @param array $ids
     * @return object|boolean
     */
    public function setStatusFailed($ids=array())
    {
        if( !$ids ) return false;
        $this->db->group_start();
        $this->db->where_in('transaction_id', $ids);
        $this->db->group_end();
        $this->db->where('transaction_status', 'pending');
        $this->db->where('transaction_paid', '0');
        return $this->db->update($this->table, array('transaction_status' => 'Failed'));
    }

    /**
     * @param string $date
     * @return array
     */
    public function getUserLoketIdByDate($date=null)
    {
        if( !$date ) $date = date('Y-m-d');
        $userIds = $this->userModel->getByGroup('loket');
        $this->db->group_start();
        $this->db->where_in('user_id', $userIds);
        $this->db->group_end();
        //$this->db->where('DATE(transaction_created)', $date); todo
        $this->db->where('DATE(transaction_date_used)', $date);
        $this->db->group_by('user_id');
        $transactions = $this->db->get($this->table)->result_array();
        return array_column($transactions,'user_id');
    }

    /**
     * @param array $productIds
     * @param int $orderId
     * @return bool
     */
    public function productExist($productIds)
    {
        $this->db->join('tb_transaction t','t.transaction_id=td.transaction_id');
        $this->db->where_in('td.product_id',$productIds);
        return (bool)$this->db->count_all_results('tb_transaction_detail td');
    }
}