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
 * @property PostModel postModel
 */

class Post extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('apiModel');
        $this->load->model('postModel');
    }

    public function index()
    {
        $categoryInput = $this->input->get('category');
        if( !$categoryInput ) json_response('category required', 403);
        $categories = explode(',', $categoryInput);
        $categoryIds = $this->postModel->getCategorySlug($categories);
        $posts = $this->postModel->getByCategories($categoryIds, 0,0,false,null,null,null,'post_order','asc');
        foreach ($posts as $k => $post) {
            if(@$post['post_img']) {
                $posts[$k]['post_img']                    = link_upload($post['post_img']);
            }else{
                $posts[$k]['post_img'] = '';
            }
            if(@$post['post_user_avatar']) {
                $posts[$k]['post_user_avatar']    = link_upload($post['post_user_avatar']);
            }else{
                $posts[$k]['post_user_avatar'] = '';
            }
        }
        json_response($posts);
    }
}