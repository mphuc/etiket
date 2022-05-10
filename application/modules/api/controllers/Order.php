<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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
 * @property CI_Loader load
 * @property ApiModel apiModel
 * @property TermModel termModel
 * @property UserModel userModel
 * @property OrderModel orderModel
 * @property OrderDetailModel orderDetailModel
 * @property Setting setting
 */
class Order extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('apiModel');
        $this->load->model('termModel');
        $this->load->model('userModel');
        $this->load->model('orderModel');
        $this->load->model('orderDetailModel');
    }

    protected function _order_guest_post()
    {
        $_POST = json_decode(file_get_contents('php://input'), true);
        $this->form_validation->set_rules('date', 'Tanggal Digunakan', 'required');
        $this->form_validation->set_rules('item', 'Data Item', 'required');
        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            json_response(  strip_tags(validation_errors()), 400 );
        }else{
            $x_api_key = $this->input->get_request_header('x-api-key');
            if( $x_api_key != 'kidsfun-kios-k' ) json_response('INVALID API KEY',400);
            $guest = array(
                'name'  => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
            );

            $dateUsed = date('Y-m-d',strtotime($this->input->post('date')));
            if( $dateUsed < date('Y-m-d') ) json_response('Invalid Date', 400);
            $insertId = $this->orderModel->add(0, $dateUsed, 'online', $this->input->post('item'), $guest, 'kidsfun-kios-k');
            if( !$insertId ) json_response("Failed to process", 400 );
            $transaction = $this->orderModel->getById($insertId);
            $transaction['payment'] = [];
            json_response($transaction);
        }
    }

    protected function _order_post()
    {
        $_POST = json_decode(file_get_contents('php://input'), true);
        $this->form_validation->set_rules('date', 'Tanggal Digunakan', 'required');
        $this->form_validation->set_rules('item', 'Data Item', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            json_response(  strip_tags(validation_errors()), 400 );
        }else{
            $jwt    = $this->apiModel->jwtAuth();
            $user   = $this->userModel->getByID( $jwt->data->id );
            $dateUsed = date('Y-m-d',strtotime($this->input->post('date')));
            if( $dateUsed < date('Y-m-d') ) json_response('Invalid Date', 400);
            $insertId = $this->orderModel->add($user->id, $dateUsed, 'online', $this->input->post('item'));
            if( !$insertId ) json_response("Failed to process", 400 );
            $transaction = $this->orderModel->getById($insertId);
            $transaction['payment'] = [];
            json_response($transaction);
        }
    }

    protected function _order_get()
    {
        $id = $this->input->get('id');
        $jwt    = $this->apiModel->jwtAuth();
        if( $id ){
            $order = $this->orderModel->getById($id, $jwt->data->id);
            if( $order ){
                $details = $this->orderDetailModel->getByOrderId($id);
                $order['detail'] = $details;
                $order['payment'] = [];
            }
            json_response( $order );
        }else{
            $orders = $this->orderModel->get(null, null, $jwt->data->id);
            $ids = array_column($orders, 'transaction_id');
            if( !$ids ) json_response(array());
            $details = $this->orderDetailModel->getByOrderId($ids);
            $orderAndDetails = [];
            foreach ($orders as $v) {
                $result = array_filter($details, function ($el)use($v){
                    return $el['transaction_id'] == $v['transaction_id'];
                });
                $v['detail'] = array_values($result);
                $orderAndDetails[] = $v;
            }
            json_response($orderAndDetails);
        }
    }

    public function index()
    {
        $method = $this->apiModel->detectMethod();
        switch ($method){
            case 'get':
                $this->_order_get();
                break;
            case 'post':
                $this->_order_post();
                break;
            default:
                json_response('Not Allowed', 405);
        }
    }

    public function guest()
    {
        $method = $this->apiModel->detectMethod();
        switch ($method){
            case 'post':
                $this->_order_guest_post();
                break;
            default:
                json_response('Not Allowed', 405);
        }
    }
}
