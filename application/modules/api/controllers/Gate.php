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
 * @property OrderModel orderModel
 * @property Setting setting
 */

class Gate extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('apiModel');
        $this->load->model('TicketModel');
        $this->load->model('orderModel');
        $this->load->library('user_agent');
    }

    public function index()
    {
        
        $ip = $this->input->ip_address();
        $code = $this->input->get('code');
        $gate = $this->input->get('gate');
        $ticket = $this->ticketModel->getByCode($code, $gate);
        if( $ticket ){
            $this->ticketModel->setNonActive( $ticket['ticket_id'] );
        }
        if( !$ticket ) json_response("Ticket Not Found", 404);
        if( $ticket['ticket_active'] == '1' ) json_response("Ticket Used", 403);
        json_response( $ticket );
    }
}