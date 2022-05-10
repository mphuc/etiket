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
 * @property LocationModel locationModel
 */

class Area extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('locationModel');
    }

    public function province()
    {
        json_response( $this->locationModel->province() );
    }

    public function city($provinceId=null)
    {
        json_response( $this->locationModel->city($provinceId) );
    }

    public function cities()
    {
        $search = $this->input->get('q');
        $column = 'name';
        $limit  = 50;
        if( $search ){
            $this->db->group_start();
            $this->db->like($column, $search);
            $this->db->group_end();
        }
        $this->db->select('name as id,name as text');
        $this->db->order_by('name','asc');
        $city = $this->db->get('tb_regencies',$limit)->result_array();
        json_response($city);
    }
}