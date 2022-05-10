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
 * @property TicketModel ticket
 * @property OrderModel orderModel
 * @property Setting setting
 */

class Chart extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('apiModel');
        $this->load->model('TicketModel');
        $this->load->model('orderModel');
    }

    protected function role($type=null)
    {
        //return true;
        if( !$this->ion_auth->logged_in() ) show_404();
        if( $type ){
            if( $this->base_config->groups_access_sigle('chart', $type) ) show_404();
        }else{
            if( $this->base_config->groups_access_sigle('menu', 'chart') ) show_404();
        }
    }

    public function index()
    {
        json_response( 'chart' );
    }

    public function transaction_daily()
    {
        $this->role();
        $from = $this->input->get('from');
        $to   = $this->input->get('to');
        $this->db->select('transaction_created, UNIX_TIMESTAMP(transaction_created) as created,(SUM(transaction_total)-SUM(transaction_fee)) as total'); #todo
        // $this->db->select('transaction_date_used, UNIX_TIMESTAMP(transaction_date_used) as created,(SUM(transaction_total)-SUM(transaction_discount)) as total');
        $this->db->where('transaction_paid','1');
        if( $from && $to ){
            $this->db->where('DATE(transaction_created) >=', $from); #todo
            $this->db->where('DATE(transaction_created) <=', $to); #todo
            // $this->db->where('DATE(transaction_date_used) >=', $from);
            // $this->db->where('DATE(transaction_date_used) <=', $to);
        }else{
            $this->db->where('MONTH(transaction_created)',date('m')); #todo
            // $this->db->where('MONTH(transaction_date_used)',date('m'));
        }
        // $this->db->order_by('transaction_date_used','asc');
        $this->db->order_by('transaction_created','asc'); #todo
        $this->db->group_by('DATE(transaction_created)'); #todo
        // $this->db->group_by('DATE(transaction_date_used)');
        $transactions = $this->db->get('tb_transaction')->result_array();
        $data = array();
        $categories = array();
        foreach ($transactions as $k => $v) {
            $dateString = date('Y-m-d', strtotime($v['transaction_created'])); #todo
            // $dateString = date('Y-m-d', strtotime($v['transaction_date_used']));
            $data[]         = intval($v['total']);
            $categories[]   = $dateString;
        }
        json_response( array(
            'data'          => $data,
            'categories'    => $categories
        ) );
    }

    public function transaction_monthly()
    {
        $this->role();
        $year = $this->input->get('year');
        // $this->db->select('transaction_date_used, MONTH(transaction_date_used) as month,(SUM(transaction_total)-SUM(transaction_discount)) as total');
        // $this->db->select('transaction_created, MONTH(transaction_created) as month,(SUM(transaction_total)-SUM(transaction_fee)) as total'); #todo
        // $this->db->where('transaction_paid','1');
        // if( $year ){
        //     $this->db->where('YEAR(transaction_created)', $year); #todo
        //     // $this->db->where('YEAR(transaction_date_used)', $year);
        // }else{
        //     $this->db->where('YEAR(transaction_created)',date('Y')); #todo
        //     // $this->db->where('YEAR(transaction_date_used)',date('Y'));
        // }
        // // $this->db->order_by('transaction_date_used','asc');
        // $this->db->order_by('transaction_created','asc'); #todo
        // $this->db->group_by('MONTH(transaction_created), transaction_created'); #todo
        // // $this->db->group_by('MONTH(transaction_date_used)');
        // $transactions = $this->db->get('tb_transaction')->result_array();
        $yr = date('Y');
        if($year){
            $transactions = $this->db->query("SELECT MONTH(transaction_created) as bulan, SUM(transaction_total-transaction_fee-transaction_discount) as total FROM tb_transaction WHERE transaction_paid = 1 AND YEAR(transaction_created) = $year GROUP BY MONTH(transaction_created)")->result();
        }
        else{
            $transactions = $this->db->query("SELECT MONTH(transaction_created) as bulan, SUM(transaction_total-transaction_fee-transaction_discount) as total FROM tb_transaction WHERE transaction_paid = 1 AND YEAR(transaction_created) = $yr GROUP BY MONTH(transaction_created)")->result();
            
        }

        $tmp = array();
        for($i=1;$i<=12;$i++){
            // $results = array_filter($transactions,function ($el)use($i){
            //     return $el['bulan'] == $i;
            // });
            // $result = reset($results);
            // $tmp[] = intval($result['total']);
            foreach ($transactions as $k => $v) {
                if($v->bulan == $i){
                    $tmp[$i] = intval($v->total);
                    break;
                }
                    
                else{
                    $tmp[$i] = 0;
                }
            }
        }

        $data = array();
        for($x=1 ; $x<=12 ; $x++){
            $data[] = $tmp[$x];
        }

        json_response( $data );

        // var_dump($transactions);
    }

    public function best_seller()
    {
        $this->role();
        $wahanaId = $this->input->get('wahana');
        $this->db->select('product_title,SUM(td.transaction_detail_subtotal-td.transaction_detail_discount) as total');
        $this->db->join('tb_product pd','pd.product_id=td.product_id');
        $this->db->join('tb_transaction tr','tr.transaction_id=td.transaction_id');
        if( $wahanaId ){
            $wahanaIds = explode('-', $wahanaId);
            $this->db->group_start();
            $this->db->where_in('td.product_id', $wahanaIds);
            $this->db->group_end();
        }
        $this->db->where('tr.transaction_paid','1');
        $this->db->order_by('pd.product_order','asc');
        $this->db->group_by('td.product_id');
        $transactions = $this->db->get('tb_transaction_detail td')->result_array();
        $tmp = array();
        foreach ($transactions as $k => $v) {
            $total = intval($v['total']);
            if( $total > 0 ) $tmp[] = array($v['product_title'], $total);
        }
        json_response($tmp);
    }

    public function user_gender()
    {
        $this->role();
        $this->db->select('user_gender, COUNT(id) as count');
        $this->db->group_by('user_gender');
        $users = $this->db->get('tb_user')->result_array();
        $tmp = array();
        foreach ($users as $k => $v) {
            if( $v['user_gender'] ){
                $tmp[] = array(ucfirst($v['user_gender']), intval($v['count']));
            }
        }
        json_response( $tmp );
        json_response('gender');
    }

    public function user_age()
    {
        $this->role();
        $this->db->select('COUNT(id) as count,(YEAR(CURDATE())-YEAR(user_date_birth)) as age');
        $this->db->where('user_date_birth >', '0');
        $this->db->group_by('YEAR(user_date_birth)');
        $users = $this->db->get('tb_user')->result_array();
        $tmp = array();
        foreach ($users as $k => $v) {
            $tmp[] = array($v['age'], intval($v['count']));
        }
        json_response( $tmp );
    }

    public function user_city()
    {
        $this->role();
        $province = $this->input->get('province');
        $this->db->select('u.id,u.username,u.email,u.city_id,r.name as city, COUNT(u.id) as count');
        $this->db->join('tb_regencies r','r.id=u.city_id');
        if($province){
            $provinceIds = explode('-', $province);
            $this->db->where_in('u.province_id', $provinceIds);
        }
        $this->db->group_by('u.city_id');
        $this->db->order_by('city','asc');
        $data = $this->db->get('tb_user u')->result_array();
        $tmp = array();
        foreach ($data as $k => $v) {
            $tmp[] = array($v['city'], intval($v['count']));
        }
        json_response( $tmp );
    }

}