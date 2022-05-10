<?php
/**
 * @property CI_Form_validation form_validation
 * @property CI_Input input
 * @property CI_Parser parser
 * @property Ion_auth|Ion_auth_model ion_auth
 * @property Ion_auth|Ion_auth_model Ion_auth_model
 * @property M_base_config M_base_config
 * @property base_config base_config
 * @property CI_Lang lang
 * @property CI_URI uri
 * @property CI_DB_query_builder|CI_DB_mysqli_driver db
 * @property CI_Config config
 * @property CI_User_agent agent
 * @property CI_Email email
 * @property Base_config Base_config
 * @property Slug slug
 * @property CI_Loader load
 * @property CI_Session session
 * @property Setting setting
 * @property UserModel userModel
 * @property OrderModel orderModel
 * @property TicketModel ticketModel
 * @property ProductModel productModel
 * @property LocationModel locationModel
 * @property VendorModel vendorModel
 */
class Cms extends CI_Controller {
    protected $table = '';
    protected $subject = 'Dashboard';
    protected $module;
    protected $primary_key = '';
    public function __construct()
    {
        parent::__construct();
        $this->module = str_replace('cms_', '', strtolower( get_class($this) ) );
    }

    protected function role($module, $type=null)
    {
        if( $this->ion_auth->is_admin() ){
            return true;
        }else{
            if( $type ){
                if( $this->base_config->groups_access_sigle($module, $type) ) {
                    return false;
                }else{
                    return true;
                }
            }else{
                if( $this->base_config->groups_access_sigle('menu', $module) ) {
                    return false;
                }else{
                    return true;
                }
            }
        }
    }

    public function index()
    {
        $this->load->model('orderModel');
        $this->load->model('ticketModel');
        $this->load->model('productModel');
        $this->load->model('userModel');
        $this->load->model('locationModel');
        $this->load->model('vendorModel');

        $filterFrom         = $this->input->get('from');
        $filterTo           = $this->input->get('to');
        $filterWahana       = $this->input->get('filter_wahana');
        $filterProvince     = $this->input->get('filter_province');
        $filterYear     = $this->input->get('filter_year');

        //Cek Auth
        $this->M_base_config->cekaAuth();
        //Get Panel Setting
        $data = $this->setting->get_all();
        $data['filter_wahana']  = $filterWahana ? $filterWahana : array();
        $data['filter_province']= $filterProvince ? $filterProvince : array('34');
        $data['filter_from']    = $filterFrom;
        $data['filter_to']      = $filterTo;
        $data['filter_year']    = $filterYear;
        $data['all_wahana']     = $this->productModel->get();
        $data['all_province']   = $this->locationModel->province();
        $data['all_vendor']     = $this->vendorModel->get();
        $data['module']  = $this->module;
        $data['subject'] = $this->subject;
        $data['asset']   = $this->base_config->asset_back();
        $user  = $this->ion_auth->user()->row();
        //Set navigation left
        $data['nav'] = 'yes';
        if (!$this->ion_auth->is_admin()){
            $datapostval = array('table'=>'tb_post','where'=>array(array('wherefield'=>'post_type','where_value'=>'posts'),array('wherefield'=>'post_author','where_value'=>$user->username)));
        }else {
            $datapostval = array('table'=>'tb_post','where'=>array(array('wherefield'=>'post_type','where_value'=>'posts')));
        }
        $data['totalpost'] = $this->M_base_config->countDatamultiple($datapostval);

        if (!$this->ion_auth->is_admin()){
            $datapagetval = array('table'=>'tb_post','where'=>array(array('wherefield'=>'post_type','where_value'=>'pages'),array('wherefield'=>'post_author','where_value'=>$user->username)));
        }else {
            $datapagetval = array('table'=>'tb_post','where'=>array(array('wherefield'=>'post_type','where_value'=>'pages')));
        }
        $data['totalpage'] = $this->M_base_config->countDatamultiple($datapagetval);

        if (!$this->ion_auth->is_admin()){
            $datamediatval = array('table'=>'tb_post','where'=>array(array('wherefield'=>'post_type','where_value'=>'media'),array('wherefield'=>'post_author','where_value'=>$user->username)));
        }else {
            $datamediatval = array('table'=>'tb_post','where'=>array(array('wherefield'=>'post_type','where_value'=>'media')));
        }
        $data['totalmedia'] = $this->M_base_config->countDatamultiple($datamediatval);
        $data['totaluser'] = $this->userModel->getCountByGroup('members');
        // Declare Views name
        $data['dashboard']  = true;
        $data['viewspage'] = 'cpanel';
        $isAdmin = $this->ion_auth->is_admin();
        $userId = null;
        if( !$isAdmin ){
            $userId = $this->ion_auth->get_user_id();
        }
        $data['label']  = $isAdmin ? 'All' : 'My';
        $data['is_admin']  = $isAdmin;
        $data['total_transaction'] = my_number($this->orderModel->getTotalNominal($userId, date('Y-m-d')));
        $data['total_ticket'] = my_number($this->ticketModel->getTotal($userId, date('Y-m-d')));
        $data['total_product'] = my_number($this->productModel->getTotal());
        //Render Page
        //$this->base_config->_render_page($data);
        $data['chart_daily_sales'] = $this->role('chart_daily_sales');
        $data['chart_monthly_sales'] = $this->role('chart_monthly_sales');
        $data['chart_best_seller'] = $this->role('chart_best_seller');
        $data['chart_visitor'] = $this->role('chart_visitor');
        view_back( "$this->module/views/v_list", $data);
    }
    
}