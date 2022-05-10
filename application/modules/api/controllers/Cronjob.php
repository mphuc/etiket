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

class Cronjob extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('apiModel');
        $this->load->model('orderModel');
    }

    protected function _setFailedTransaction()
    {
        //$data = $this->orderModel->getYesterday();
        //$ids = array_column($data, 'transaction_id');
        //if($ids) $this->orderModel->setStatusFailed($ids);
        //json_response( $ids );
        json_response('success');
    }

    public function index()
    {
        $this->_setFailedTransaction();
    }
}