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
 * @property TicketModel ticketModel
 * @property OrderDetailModel orderDetailModel
 * @property OrderModel orderModel
 */

class Ticket extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('apiModel');
        $this->load->model('ticketModel');
        $this->load->model('orderDetailModel');
        $this->load->model('orderModel');
    }

    protected function _get()
    {
        $jwt    = $this->apiModel->jwtAuth();
        $groupOrderDetail = $this->ticketModel->getGroupProductByUser( $jwt->data->id );
        json_response($groupOrderDetail);
    }

    public function index()
    {
        $method = $this->apiModel->detectMethod();
        switch ($method){
            case 'get':
                $this->_get();
                break;
            default:
                json_response('Not Allowed', 405);
        }
    }

    /**
     * @param int $productId
     */
    protected function _detail_get()
    {
        $productId = $this->input->get('id');
        $dateUsed = $this->input->get('date');
        $jwt    = $this->apiModel->jwtAuth();
        $tickets = $this->ticketModel->getByUserProductIdDateUsed($jwt->data->id,$productId,$dateUsed);
        json_response($tickets);
    }

    /**
     * @param int $ticketId
     */
    protected function _active_get($ticketId)
    {
        $jwt    = $this->apiModel->jwtAuth();
        $tickets = $this->ticketModel->getActivebyUserId($jwt->data->id, $ticketId);
        json_response($tickets);
    }

    public function detail()
    {
        $method = $this->apiModel->detectMethod();
        switch ($method){
            case 'get':
                $this->_detail_get();
                break;
            default:
                json_response('Not Allowed', 405);
        }
    }

    public function collect()
    {
        $code = $this->input->get('code');
        $pass = $this->input->get('pass');
        if( !$code || !$pass ) json_response('code and pass required', 400);
        $ipAddress = $this->input->ip_address();
        $hacked = $this->apiModel->attempsBlockCheck($ipAddress);
        if( $hacked ){
            json_response('Temporary disabled, please wait for a few minutes', 403);
        }else{
            $this->orderModel->ticketCollects($code, $pass);
        }
    }

    public function active()
    {
        $param_1 = $this->uri->segment(4);
        $method = $this->apiModel->detectMethod();
        switch ($method){
            case 'get':
                $this->_active_get($param_1);
                break;
            default:
                json_response('Not Allowed', 405);
        }
    }
}