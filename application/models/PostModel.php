<?php
/**
 * @property M_base_config $M_base_config
 * @property base_config $base_config
 * @property Ion_auth|Ion_auth_model $ion_auth
 * @property CI_Lang $lang
 * @property CI_URI $uri
 * @property CI_DB_query_builder|CI_DB_mysqli_driver $db
 * @property CI_Config $config
 * @property CI_Input $input
 * @property CI_User_agent $agent
 * @property CI_Email $email
 * @property CI_Form_validation $form_validation
 * @property CI_Session session
 * @property CI_Parser parser
 * @property CI_Upload upload
 * @property Setting setting
 */
class PostModel extends CI_Model  {
	
	public function __construct()
    {
    	parent::__construct();
        $this->load->library('mahana_hierarchy');

    }
    public function get_post_parse($limit=null,$offset=null,$type=null,$orderby=null,$orderbyvalue=null, $category=null){
    	$return = array();
    	$tmp 	= array();

    	if( !$limit ) $limit = 10;
    	if( !$offset ) $offset = 0;
    	if( !$orderby ) {
            $orderby 		= 'post_date';
            $orderbyvalue	= 'desc' ;
        }

        if($category){
            $this->db->join('tb_terms', 'tb_terms.post_id = tb_post.post_id AND terms_type = "category"');
            $this->db->join('tb_category', 'tb_category.category_id = tb_terms.category_id AND tb_category.category_name = "Slider"');
        }

    	$this->db->where('post_status', 'Publish');
        $this->db->where('post_type', $type);
        $this->db->order_by($orderby,$orderbyvalue);
        $dataonlypost    	= $this->db->get('tb_post',$limit,$offset)->result();
        foreach($dataonlypost as $name){
        	$tmp['post_id'] 					= $name->post_id;
        	$tmp['post_name'] 					= $name->post_name;
        	$tmp['post_title'] 					= $name->post_title;
        	$tmp['post_content'] 				= $name->post_content;
        	$tmp['post_priority'] 				= $name->post_priority;
        	$tmp['post_date'] 					= $name->post_date;
        	$tmp['post_modified'] 				= $name->post_modified;
        	$tmp['post_seo_title'] 				= $name->post_seo_title;
        	$tmp['post_meta_desc'] 				= $name->post_meta_desc;
        	$tmp['post_meta_keyword'] 			= $name->post_meta_keyword;
        	$tmp['post_comment'] 				= $name->post_comment;
        	$tmp['post_type'] 					= $name->post_type;
        	$tmp['post_author'] 				= $name->post_author;
        	$tmp['post_view'] 					= $name->post_view;
        	$tmp['post_comment_count'] 			= $name->post_comment_count;

            if($name->post_from===null){
                $tmp['post_dinas'] 				    = "";
            }else{
                $tmp['post_dinas'] 			        = $name->post_from;
            }
        	if($name->post_location===null){
                $tmp['post_lokasi'] 			    = "";
            }else{
                $tmp['post_lokasi'] 			    = $name->post_location;
            }
            if($name->post_long===null){
                $tmp['post_lama_hari'] 			    = "";
            }else{
                $tmp['post_lama_hari'] 			    = $name->post_long;
            }
            $tmp['post_img']                    = null;
        	$image = $this->db->where('post_id',$name->post_parent)->get("tb_post",1)->result();
        	foreach($image as $img) {
        		$tmp['post_img'] 				= $img->post_name;
        	}
        	$users = $this->db->where('username',$name->post_author)->get("tb_user",1)->result();
        	foreach($users as $user) {
        		$tmp['post_user_display_name'] 	= $user->user_display_name;
        		$tmp['post_user_avatar'] 		= $user->user_avatar;
        	}
        	$return[] = $tmp;
        	unset($tmp);
        }
        
        return $return;
    }

    public function get_post_sigle($type=null,$slug=null){
    	$return = array();
    	$tmp 	= array();
    	$this->db->where('post_status', 'Publish');
    	if( $type ) $this->db->where('post_type',$type);
        $this->db->where('post_name',$slug);
        $dataonlypost    	= $this->db->get('tb_post')->result();
        foreach($dataonlypost as $name){
        	$tmp['post_id'] 					= $name->post_id;
        	$tmp['post_title'] 					= $name->post_title;
        	$tmp['post_name'] 					= $name->post_name;
        	$tmp['post_content'] 				= $name->post_content;
        	$tmp['post_priority'] 				= $name->post_priority;
        	$tmp['post_date'] 					= $name->post_date;
        	$tmp['post_modified'] 				= $name->post_modified;
        	$tmp['post_seo_title'] 				= $name->post_seo_title;
        	$tmp['post_meta_desc'] 				= $name->post_meta_desc;
        	$tmp['post_meta_keyword'] 			= $name->post_meta_keyword;
        	$tmp['post_comment'] 				= $name->post_comment;
        	$tmp['post_type'] 					= $name->post_type;
        	$tmp['post_author'] 				= $name->post_author;
        	$tmp['post_view'] 					= $name->post_view;
        	$tmp['post_comment_count'] 			= $name->post_comment_count;
            if($name->post_from===null){
                $tmp['post_dinas'] 				    = "";
            }else{
                $tmp['post_dinas'] 			        = $name->post_from;
            }
            if($name->post_location===null){
                $tmp['post_lokasi'] 			    = "";
            }else{
                $tmp['post_lokasi'] 			    = $name->post_location;
            }
            if($name->post_long===null){
                $tmp['post_lama_hari'] 			    = "";
            }else{
                $tmp['post_lama_hari'] 			    = $name->post_long;
            }
            $tmp['post_img']                    = '';
            $tmp['post_position']               = $name->post_position;
        	$image = $this->db->where('post_id',$name->post_parent)->get("tb_post",1)->result();
        	foreach($image as $img) {
        		$tmp['post_img'] 				= $img->post_name;
        	}
        	$users = $this->db->where('username',$name->post_author)->get("tb_user",1)->result();
        	foreach($users as $user) {
                $tmp['post_user_display_name'] 	= $user->user_display_name;
                $tmp['post_user_avatar'] 		= $user->user_avatar;
                $tmp['user_bio']                = $user->user_bio;
                $tmp['user_facebook']           = $user->user_facebook;
                $tmp['user_twitter']            = $user->user_twitter;
                $tmp['user_google_plus']        = $user->user_google_plus;
        	}

            $this->db->select('category_name');
            $this->db->where('terms_type', 'tags');
            $this->db->where('post_id', $name->post_id);
            $this->db->join('tb_category', 'tb_category.category_id = tb_terms.category_id AND category_type = "tags"');
            $tmp['tags'] = $this->db->get('tb_terms')->result();
            $tmp['comments'] = $this->get_comment_where_post($tmp['post_id']);

        	$return[] = $tmp;
        	unset($tmp);
        }
        
        return reset($return);
    }

    public function get_post_single_by_id($id=null){
        $return = array();
        $tmp 	= array();
        $this->db->where('post_status', 'Publish');
        $this->db->where('post_id',$id);
        $dataonlypost    	= $this->db->get('tb_post')->result();
        foreach($dataonlypost as $name){
            $tmp['post_id'] 					= $name->post_id;
            $tmp['post_title'] 					= $name->post_title;
            $tmp['post_name'] 					= $name->post_name;
            $tmp['post_content'] 				= $name->post_content;
            $tmp['post_priority'] 				= $name->post_priority;
            $tmp['post_date'] 					= $name->post_date;
            $tmp['post_modified'] 				= $name->post_modified;
            $tmp['post_seo_title'] 				= $name->post_seo_title;
            $tmp['post_meta_desc'] 				= $name->post_meta_desc;
            $tmp['post_meta_keyword'] 			= $name->post_meta_keyword;
            $tmp['post_comment'] 				= $name->post_comment;
            $tmp['post_type'] 					= $name->post_type;
            $tmp['post_author'] 				= $name->post_author;
            $tmp['post_view'] 					= $name->post_view;
            $tmp['post_comment_count'] 			= $name->post_comment_count;
            if($name->post_from===null){
                $tmp['post_dinas'] 				    = "";
            }else{
                $tmp['post_dinas'] 			        = $name->post_from;
            }
            if($name->post_location===null){
                $tmp['post_lokasi'] 			    = "";
            }else{
                $tmp['post_lokasi'] 			    = $name->post_location;
            }
            if($name->post_long===null){
                $tmp['post_lama_hari'] 			    = "";
            }else{
                $tmp['post_lama_hari'] 			    = $name->post_long;
            }
            $tmp['post_img']                    = '';
            $tmp['post_position']               = $name->post_position;
            $image = $this->db->where('post_id',$name->post_parent)->get("tb_post",1)->result();
            foreach($image as $img) {
                $tmp['post_img'] 				= $img->post_name;
            }
            $users = $this->db->where('username',$name->post_author)->get("tb_user",1)->result();
            foreach($users as $user) {
                $tmp['post_user_display_name'] 	= $user->user_display_name;
                $tmp['post_user_avatar'] 		= $user->user_avatar;
                $tmp['user_bio']                = $user->user_bio;
                $tmp['user_facebook']           = $user->user_facebook;
                $tmp['user_twitter']            = $user->user_twitter;
                $tmp['user_google_plus']        = $user->user_google_plus;
            }

            $this->db->select('category_name');
            $this->db->where('terms_type', 'tags');
            $this->db->where('post_id', $name->post_id);
            $this->db->join('tb_category', 'tb_category.category_id = tb_terms.category_id AND category_type = "tags"');
            $tmp['tags'] = $this->db->get('tb_terms')->result();
            $tmp['comments'] = $this->get_comment_where_post($tmp['post_id']);

            $return[] = $tmp;
            unset($tmp);
        }

        return reset($return);
    }

    function get_comment_where_post($post_id){
        $return = $this->db
            ->join('tb_user', 'tb_user.id = tb_users_feeds.feed_user_id', 'LEFT')
            ->where('feed_type', 'comments')
            ->where('feed_status', 'approved')
            ->where('feed_parent', $post_id)
            ->get('tb_users_feeds');
        return $return->result();
    }

    public function get_post_seo($type=null,$slug=null){
    	$return = array();
    	$tmp 	= array();
    	$seo 	= $data=$this->base_config->front_setting();
    	$this->db->where('post_status', 'Publish');
    	$this->db->where('post_type',$type);
        $this->db->where('post_name',$slug);
        $dataonlypost    	= $this->db->get('tb_post')->result();
        foreach($dataonlypost as $name){
        	if(!empty($name->post_seo_title))
        		$tmp['site_title'] 				= $name->post_seo_title;
        	if(!empty($name->post_meta_desc))
        		$tmp['site_desc'] 				= $name->post_meta_desc;
        	if(!empty($name->post_meta_keyword))
        		$tmp['site_keyword'] 			= $name->post_meta_keyword;
        	$return = $tmp;
        	unset($tmp);
        }
        return $return;
    }
    public function get_post_total($table=null,$type=null){
    	$this->db->where('post_status', 'Publish');
    	if($type != null)
        $this->db->where('post_type', $type);
        return $this->db->count_all_results($table);
    }

    public function get_navmenu($setting_name = 'Primary Menu'){
        $this->db->where('setting_type','front-customize');
        $this->db->where('setting_name', $setting_name);
        $idmenu = $this->db->get('tb_setting',1)->row('setting_value');
        return $this->getmenulist($idmenu);
    }

    public function get_post_wherecategory($param){
        if(isset($param['get_total'])){
            $category_id = $this->db->where('category_slug',$param['category_slug'])->get('tb_category',1)->row('category_id');
            if(array_key_exists('where', $param)){
                for($i=0;$i<count($param['where']);$i++){
                    $this->db->where($param['where'][$i]['wherefield'],$param['where'][$i]['where_value']);
                }
            }
            $post    = $this->db->where('category_id',$category_id)
                ->join('tb_post','tb_post.post_id = tb_terms.post_id')
                ->where('tb_post.post_status','Publish')
                ->order_by($param['order_by'].' '.$param['order_by_value'])
                ->count_all_results('tb_terms');
            return $post;
        }else {
            $category_id = $this->db->where('category_slug',$param['category_slug'])->get('tb_category',1)->row('category_id');
            if(array_key_exists('where', $param)){
                for($i=0;$i<count($param['where']);$i++){
                    $this->db->where($param['where'][$i]['wherefield'],$param['where'][$i]['where_value']);
                }
            }
            $post    = $this->db->where('category_id',$category_id)
                ->join('tb_post','tb_post.post_id = tb_terms.post_id')
                ->where('tb_post.post_status','Publish')
                ->order_by($param['order_by'].' '.$param['order_by_value'])
                ->limit($param['limit'],$param['offset'])
                ->get('tb_terms')->result();
            return $this->get_full_post_image($post);
            }
    }

    public function get_full_post_image($dataonlypost){
        $return = array();
        $tmp    = array();
        foreach($dataonlypost as $name){
            $tmp['post_id']                     = $name->post_id;
            $tmp['post_name']                   = $name->post_name;
            $tmp['post_title']                  = $name->post_title;
            $tmp['post_content']                = $name->post_content;
            $tmp['post_priority']               = $name->post_priority;
            $tmp['post_date_day']               = date('d', strtotime($name->post_date));
            $tmp['post_date_month']             = date('M', strtotime($name->post_date));
            $tmp['post_date_years']             = date('yyyy', strtotime($name->post_date));
            $tmp['post_date']                   = $name->post_date;
            $tmp['post_modified']               = $name->post_modified;
            $tmp['post_seo_title']              = $name->post_seo_title;
            $tmp['post_meta_desc']              = $name->post_meta_desc;
            $tmp['post_meta_keyword']           = $name->post_meta_keyword;
            $tmp['post_comment']                = $name->post_comment;
            $tmp['post_type']                   = $name->post_type;
            $tmp['post_author']                 = $name->post_author;
            $tmp['post_view']                   = $name->post_view;
            $tmp['post_comment_count']          = $name->post_comment_count;
            if($name->post_from===null){
                $tmp['post_dinas'] 				    = "";
            }else{
                $tmp['post_dinas'] 			        = $name->post_from;
            }
            if($name->post_location===null){
                $tmp['post_lokasi'] 			    = "";
            }else{
                $tmp['post_lokasi'] 			    = $name->post_location;
            }
            if($name->post_long===null){
                $tmp['post_lama_hari'] 			    = "";
            }else{
                $tmp['post_lama_hari'] 			    = $name->post_long;
            }
            $image = $this->db->where('post_id',$name->post_parent)->get("tb_post",1)->result();
            if($image){
                foreach($image as $img) {
                    $tmp['post_img']                = $img->post_name;
                }
            }else{
                $tmp['post_img'] = $name->post_parent;
            }

            $users = $this->db->where('username',$name->post_author)->get("tb_user",1)->result();
            foreach($users as $user) {
                $tmp['user_display_name']  = $user->user_display_name;
                $tmp['user_avatar']        = $user->user_avatar;
                $tmp['username']        = $user->username;
                $tmp['user_company']        = $user->user_company;
                $tmp['user_bio']        = $user->user_bio;
                $tmp['user_facebook']        = $user->user_facebook;
                $tmp['user_twitter']        = $user->user_twitter;
                $tmp['user_google_plus']        = $user->user_google_plus;
            }
            $return[] = $tmp;
            unset($tmp);
        }
        return $return;
    }

    public function get_comment_all($param){
        $return = array();
        $tmp    = array();
        if(array_key_exists('where', $param)){
            for($i=0;$i<count($param['where']);$i++){
                $this->db->where($param['where'][$i]['wherefield'],$param['where'][$i]['where_value']);
            }
        }
        if(array_key_exists('order_by', $param)){
            $this->db->order_by($param['order_by'].' '.$param['order_by_value']);
        }
        $feedonly = $this->db->get('tb_users_feeds',$param['limit'])->result();
        foreach($feedonly as $feed){
            $tmp['feed_id']                     = $feed->feed_id;
            $tmp['feed_author']                 = $feed->feed_author;
            $tmp['feed_author_email']           = $feed->feed_author_email;
            $tmp['feed_author_url']             = $feed->feed_author_url;
            $tmp['feed_content']                = $feed->feed_content;
            $tmp['feed_status']                 = $feed->feed_status;
            $tmp['feed_date_show']              = $this->base_config->timeAgo($feed->feed_date);
            $tmp['feed_date']                   = $feed->feed_date;
            $tmp['feed_ip']                     = $feed->feed_ip;
            $tmp['feed_user_id']                = $feed->feed_user_id;
            $this->db->where('id',$feed->feed_user_id);
            $users = $this->db->get('tb_user',1)->result();
            foreach($users as $user) {
                $tmp['username']                =  $user->username;
                $tmp['user_display_name']       =  $user->user_display_name;
                $tmp['user_avatar']             =  $user->user_avatar;
                $tmp['user_company']            =  $user->user_company;
            }
            $return[] = $tmp;
            unset($tmp);
        }
        return $return;
    }

    public function get_category_seo($category_slug=null){
        $return = array();
        $tmp    = array();
        $seo    = $data=$this->base_config->front_setting();
        $this->db->where('category_slug',$category_slug);
        $dataonlypost       = $this->db->get('tb_category')->result();

        foreach($dataonlypost as $name){
            if(!empty($name->category_name))
                $tmp['site_title']              = $name->category_name.' - '.$seo['site_title'];
            if(!empty($name->category_name))
                $tmp['site_desc']               = $name->category_name.' - '.$seo['site_desc'];
            $return = $tmp;
            unset($tmp);
        }
        return $return;
    }

    function get_archive_list($limit = null){
        if($limit){
            $this->db->limit($limit);
        }
        $return = $this->db
            ->select('DATE_FORMAT(post_date, "%M %Y") as bulan, COUNT(post_date) as jumlah')
            ->where('post_type', 'posts')
            ->group_by('YEAR(post_date)')
            ->group_by('MONTH(post_date)')
            ->get('tb_post');
        return $return->result();
    }

    function get_category_list($limit = null, $tipe = 'category'){
        if($limit){
            $this->db->limit($limit);
        }
        $return = $this->db
            ->select('tb_category.*')
            ->select('COUNT(terms_id) AS jumlah')
            ->join('tb_terms', "tb_terms.category_id = tb_category.category_id AND terms_type = '".$tipe."'",'left')
            ->where('category_type', $tipe)
            ->group_by('tb_category.category_id')
            ->get('tb_category');
        return $return->result();
    }

    public function getmenulist($menus_type =null){
        $data = $this->mahana_hierarchy->where(array('category_slug'=>$menus_type,'category_deep'=>0))->get();  
        $listmenu = "";
        $getchild = "";
        for($x=0; $x<count($data); $x++) {
            if($data[$x]['category_type'] == 1) {
                $this->db->where('category_id',$data[$x]['category_name']);
                $getcat = $this->db->get('tb_category')->result();
                $idplus ='category_id';
                $name_slug ='category_slug';
                $name_plus ='category_name';
                $parenttype = 1;
            }else if($data[$x]['category_type'] == 2) {
                $this->db->where('category_id',$data[$x]['category_name']);
                $getcat = $this->db->get('tb_category')->result();
                $idplus ='category_id';
                $name_slug ='category_slug';
                $name_plus ='category_name';
                $parenttype = 2;
            }else {
                $this->db->where('post_id',$data[$x]['category_name']);
                $getcat = $this->db->get('tb_post')->result();
                $idplus ='post_id';
                $name_slug ='post_name';
                $name_plus ='post_title';
                $parenttype = 3;
            }

            foreach($getcat as $cat) {
                $children = $this->gethierarchychild($data[$x]['category_id']);
                if(!empty($children)){
                    $classparent = "uk-parent";
                    $getchild = $children;
                }else {
                    $classparent = "";
                    $getchild = "";
                }

                if( $parenttype == 3 ){
                    if( $getchild ){
                        $listmenu.='<li class="nav-item dropdown"><a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle" href="'.base_url($cat->$name_slug).'">'.$cat->$name_plus.' <i class="fas fa-angle-down"></i></a></a>';
                    }else{
                        $listmenu.='<li class="nav-item"><a class="nav-link" href="'.base_url($cat->$name_slug).'"><span>'.$cat->$name_plus.'</span></a>';
                    }
                }elseif( $parenttype == 2 ){
                    if( $getchild ){
                        $listmenu.='<li class="nav-item dropdown"><a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle" href="'.base_url($cat->$name_slug).'">'.$cat->$name_plus.' <i class="fas fa-angle-down"></i></a>';
                    }else{
                        if( filter_var($cat->category_desc, FILTER_VALIDATE_URL) ){
                            $listmenu.='<li class="nav-item"><a class="nav-link" href="'.$cat->category_desc.'">'.$cat->$name_plus.'</a>';
                        }else{
                            $listmenu.='<li class="nav-item"><a class="nav-link" href="'.base_url($cat->$name_slug).'">'.$cat->$name_plus.'</a>';
                        }
                    }
                }else{
                    if( $getchild ){
                        $listmenu.='<li class="nav-item dropdown"><a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle" href="'.base_url('category/'.$cat->category_slug).'">'.$cat->category_name.' <i class="fas fa-angle-down"></i></a>';
                    }else{
                        $listmenu.='<li class="nav-item"><a class="nav-link" href="'.base_url("category/$cat->category_slug").'"><span>'.$cat->category_name.'</span></a>';
                    }
                }
              
            }
            $listmenu.=$getchild;
            $listmenu.='</li>';
           
        }
       return $listmenu;
    }

    public function gethierarchychild($parent_id){

        $data = $this->mahana_hierarchy->get_children($parent_id);
//        var_dump($data);
        $getchild = "";
        if (!empty($data)) {
            $listmenu = '<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
            for ($x = 0; $x < count($data); $x++) {
                if ($data[$x]['category_type'] == 1) {
                    $this->db->where('category_id', $data[$x]['category_name']);
                    $getcat = $this->db->get('tb_category')->result();
                    $idplus = 'category_id';
                    $name_slug = 'category_slug';
                    $name_plus = 'category_name';
                    $parenttype = 1;
                } else if ($data[$x]['category_type'] == 2) {
                    $this->db->where('category_id', $data[$x]['category_name']);
                    $getcat = $this->db->get('tb_category')->result();
                    $idplus = 'category_id';
                    $name_slug = 'category_slug';
                    $name_plus = 'category_name';
                    $parenttype = 2;
                } else {
                    $this->db->where('post_id', $data[$x]['category_name']);
                    $getcat = $this->db->get('tb_post')->result();
                    $idplus = 'post_id';
                    $name_slug = 'post_name';
                    $name_plus = 'post_title';
                    $parenttype = 3;
                }
                foreach ($getcat as $cat) {
                    $children = $this->gethierarchychild($data[$x]['category_id']);
                    if (!empty($children)) {
                        $classparent = "uk-parent";
                        $getchild = $children;
                    } else {
                        $classparent = "";
                        $getchild = "";
                    }
                    if ($parenttype == 3) {
                        $listmenu .= '<a href="' . base_url($cat->$name_slug). '" class="dropdown-item">' . $cat->$name_plus . '</a>';
                    }else{
                        if( $cat->category_type == 'category' ){
                            $listmenu .= '<a href="' .base_url('category/'.$cat->$name_slug). '" class="dropdown-item">' . $cat->$name_plus . '</a>';
                        }else{
                            if( filter_var($cat->category_desc, FILTER_VALIDATE_URL) ){
                                $listmenu .= '<a href="' .$cat->category_desc. '" class="dropdown-item">' . $cat->$name_plus . '</a>';
                            }else{
                                $listmenu .= '<a href="' .base_url($cat->category_desc). '" class="dropdown-item">' . $cat->$name_plus . '</a>';
                            }
                        }
                    }
                }
                $listmenu .= $getchild;
                $listmenu .= '';
            }
            $listmenu .= '</div>';
            return $listmenu;
        }
    }

    public function get_client()
    {   
        return $this->db
        ->where('setting_type', 'setting_mitra')
        ->get('tb_setting')->result();
    }

    public function get_template()
    {   
        return $this->db
        ->where('setting_type', 'setting_template')
        ->get('tb_setting')->result();
    }

    public function get_multi_setting_sigle($param){
        $return = array();
        $tmp    = array();
        if(array_key_exists('where', $param)){
            for($i=0;$i<count($param['where']);$i++){
                $this->db->where($param['where'][$i]['wherefield'],$param['where'][$i]['where_value']);
            }
        }
        $data_setting = $this->db->get('tb_setting')->result();
        foreach ($data_setting as $setting) {
            $tmp[$setting->setting_desc]   = $setting->setting_value;
        }
        return $tmp;
    }

    public function isWahana($postId)
    {
        $categoryIds = $this->getCategoryWahana();
        $postIds = array();
        $this->db->where('terms_type','category');
        $this->db->group_start();
        $this->db->where_in('category_id', $categoryIds);
        $this->db->group_end();
        $terms = $this->db->get('tb_terms')->result();
        foreach ($terms as $term) {
            $postIds[] = $term->post_id;
        }
        return boolval(in_array($postId, $postIds));
    }

    public function getCategoryWahana()
    {
        $categories = [];
        $this->db->where('category_name','Wahana');
        $wahanaCategoryId = $this->db->get('tb_category',1)->row('category_id');
        $categories[] = $wahanaCategoryId;
        $this->db->where('category_parent',$wahanaCategoryId);
        $wahanaCategories = $this->db->get('tb_category')->result();
        foreach ($wahanaCategories as $wahanaCategory) {
            $categories[] = $wahanaCategory->category_id;
        }
        return $categories;
    }

    public function getCategoryName($name)
    {
        $this->db->where('category_name',$name);
        $categoryId = $this->db->get('tb_category',1)->row('category_id');
        return $categoryId;
    }

    /**
     * @param string|array $slug
     * @return int|array
     */
    public function getCategorySlug($slug)
    {
        if( is_array($slug) ){
            $this->db->where_in('category_slug',$slug);
        }else{
            $this->db->where('category_slug',$slug);
        }
        $category = $this->db->get('tb_category');
        if( is_array($slug) ){
            return array_column( $category->result_array(), 'category_id');
        }else{
            return $category->row('category_id');
        }
    }

    public function getOneWeek($categoryIds = array(), $limit=10, $offset=0, $random=false, $date=null)
    {
        $return = array();
        $tmp 	= array();

        if( $categoryIds ){
            $postIds = array();
            $this->db->where('terms_type','category');
            $this->db->group_start();
            $this->db->where_in('category_id', $categoryIds);
            $this->db->group_end();
            $terms = $this->db->get('tb_terms')->result();
            foreach ($terms as $term) {
                $postIds[] = $term->post_id;
            }

            if( $postIds ){
                $this->db->group_start();
                $this->db->where_in('post_id', $postIds);
                $this->db->group_end();
            }else{
                return $return;
            }
        }else{
            return $return;
        }

        $this->db->where('post_status', 'Publish');
        $this->db->where('post_type', 'posts');
        if( $date ) {
            $this->db->where('post_date BETWEEN "'. date('Y-m-d', strtotime($date)). '" and "'.date('Y-m-d', strtotime('+7 day', strtotime($date))).'"');
        }

        if( $random ) {
            $this->db->order_by('rand()');
        }else{
            $this->db->order_by('post_date','asc');
        }
        $dataonlypost    	= $this->db->get('tb_post',$limit,$offset)->result();
        foreach($dataonlypost as $name){
            $tmp['post_id'] 					= $name->post_id;
            $tmp['post_name'] 					= $name->post_name;
            $tmp['post_title'] 					= $name->post_title;
            $tmp['post_content'] 				= $name->post_content;
            $tmp['post_priority'] 				= $name->post_priority;
            $tmp['post_date'] 					= $name->post_date;
            $tmp['post_modified'] 				= $name->post_modified;
            $tmp['post_seo_title'] 				= $name->post_seo_title;
            $tmp['post_meta_desc'] 				= $name->post_meta_desc;
            $tmp['post_meta_keyword'] 			= $name->post_meta_keyword;
            $tmp['post_comment'] 				= $name->post_comment;
            $tmp['post_type'] 					= $name->post_type;
            $tmp['post_author'] 				= $name->post_author;
            $tmp['post_view'] 					= $name->post_view;
            $tmp['post_comment_count'] 			= $name->post_comment_count;
            if($name->post_from===null){
                $tmp['post_dinas'] 				    = "";
            }else{
                $tmp['post_dinas'] 			        = $name->post_from;
            }
            if($name->post_location===null){
                $tmp['post_lokasi'] 			    = "";
            }else{
                $tmp['post_lokasi'] 			    = $name->post_location;
            }
            if($name->post_long===null){
                $tmp['post_lama_hari'] 			    = "";
            }else{
                $tmp['post_lama_hari'] 			    = $name->post_long;
            }
            $tanggal_first=date("Y/m/d");
            $tanggal_last=date("Y/m/d",strtotime('+7 day',strtotime($tanggal_first)));

            $tmp['post_img']                    = null;
            $tmp['post_position']               = $name->post_position;
            $tmp['post_range_hari']= [$tanggal_first,$tanggal_last];
            $image = $this->db->where('post_id',$name->post_parent)->get("tb_post",1)->result();
            foreach($image as $img) {
                $tmp['post_img'] 				= $img->post_name;
            }
            $users = $this->db->where('username',$name->post_author)->get("tb_user",1)->result();
            foreach($users as $user) {
                $tmp['post_user_display_name'] 	= $user->user_display_name;
                $tmp['post_user_avatar'] 		= $user->user_avatar;
            }
            $return[] = $tmp;
            unset($tmp);
        }
        return $return;
    }


    public function getCategoryParent($postId)
    {
        $categories = [];
        $this->db->where('post_id', $postId);
        $title = $this->db->get('tb_post',1)->row('post_title');

        $this->db->where('category_name', $title);
        $categoryId = $this->db->get('tb_category',1)->row('category_id');
        if( $categoryId ) $categories[] = $categoryId;

        //my_tes( $categories );

        /*$this->db->where('category_parent', $categoryId);
        $wahanaCategories = $this->db->get('tb_category')->result();
        foreach ($wahanaCategories as $wahanaCategory) {
            $categories[] = $wahanaCategory->category_id;
        }*/

        return $categories;
    }

    public function getByCategories($categoryIds = array(), $limit=10, $offset=0, $random=false, $date=null, $month=null, $year=null, $order=null, $sort=null)
    {
        $return = array();
        $tmp 	= array();

        if( $categoryIds ){
            $postIds = array();
            $this->db->where('terms_type','category');
            $this->db->group_start();
            $this->db->where_in('category_id', $categoryIds);
            $this->db->group_end();
            $terms = $this->db->get('tb_terms')->result();
            foreach ($terms as $term) {
                $postIds[] = $term->post_id;
            }

            if( $postIds ){
                $this->db->group_start();
                $this->db->where_in('post_id', $postIds);
                $this->db->group_end();
            }else{
                return $return;
            }
        }else{
            return $return;
        }

        $this->db->where('post_status', 'Publish');
        $this->db->where('post_type', 'posts');
        if( $date ) $this->db->where('DATE(post_date)', date('Y-m-d',strtotime($date)));
        if( $month ) $this->db->where('MONTH(post_date)', $month);
        if( $year ) $this->db->where('YEAR(post_date)', $year);

        if( $random ) {
            $this->db->order_by('rand()');
        }else if($order && $sort) {
            $this->db->order_by($order,$sort);
        }else{
            $this->db->order_by('post_date','asc');
        }
        $dataonlypost    	= $this->db->get('tb_post',$limit,$offset)->result();
        foreach($dataonlypost as $name){
            $tmp['post_id'] 					= $name->post_id;
            $tmp['post_name'] 					= $name->post_name;
            $tmp['post_title'] 					= $name->post_title;
            $tmp['post_content'] 				= $name->post_content;
            $tmp['post_priority'] 				= $name->post_priority;
            $tmp['post_date'] 					= $name->post_date;
            $tmp['post_modified'] 				= $name->post_modified;
            $tmp['post_seo_title'] 				= $name->post_seo_title;
            $tmp['post_meta_desc'] 				= $name->post_meta_desc;
            $tmp['post_meta_keyword'] 			= $name->post_meta_keyword;
            $tmp['post_comment'] 				= $name->post_comment;
            $tmp['post_type'] 					= $name->post_type;
            $tmp['post_author'] 				= $name->post_author;
            $tmp['post_view'] 					= $name->post_view;
            $tmp['post_comment_count'] 			= $name->post_comment_count;
            $tmp['post_img']                    = null;
            $image = $this->db->where('post_id',$name->post_parent)->get("tb_post",1)->result();
            foreach($image as $img) {
                $tmp['post_img'] 				= $img->post_name;
            }
            $users = $this->db->where('username',$name->post_author)->get("tb_user",1)->result();
            foreach($users as $user) {
                $tmp['post_user_display_name'] 	= $user->user_display_name;
                $tmp['post_user_avatar'] 		= $user->user_avatar;
            }
            $return[] = $tmp;
            unset($tmp);
        }
        return $return;
    }

    public function getIdsByCategories($categoryIds = array())
    {
        $postIds = array();
        if( $categoryIds ){
            $this->db->where('terms_type','category');
            $this->db->group_start();
            $this->db->where_in('category_id', $categoryIds);
            $this->db->group_end();
            $terms = $this->db->get('tb_terms')->result();
            foreach ($terms as $term) {
                $postIds[] = $term->post_id;
            }
            return $postIds;
        }else{
            return $postIds;
        }
    }

    public function getAllPost($limit=10, $offset=0, $random=false)
    {
        $return = array();
        $tmp 	= array();

        /*$categoryIds = $this->getCategoryWahana();

        if( $categoryIds ){
            $postIds = array();
            $this->db->where('terms_type','category');
            $this->db->group_start();
            $this->db->where_in('category_id', $categoryIds);
            $this->db->group_end();
            $terms = $this->db->get('tb_terms')->result();
            foreach ($terms as $term) {
                $postIds[] = $term->post_id;
            }

            if( $postIds ){
                $this->db->group_start();
                $this->db->where_not_in('post_id', $postIds);
                $this->db->group_end();
            }else{
                return $return;
            }
        }else{
            return $return;
        }*/

        $this->db->where('post_status', 'Publish');
        $this->db->where('post_type', 'posts');

        if( $random ) {
            $this->db->order_by('rand()');
        }else{
            $this->db->order_by('post_date','desc');
        }
        $dataonlypost    	= $this->db->get('tb_post',$limit,$offset)->result();
        foreach($dataonlypost as $name){
            $tmp['post_id'] 					= $name->post_id;
            $tmp['post_name'] 					= $name->post_name;
            $tmp['post_title'] 					= $name->post_title;
            $tmp['post_content'] 				= $name->post_content;
            $tmp['post_priority'] 				= $name->post_priority;
            $tmp['post_date'] 					= $name->post_date;
            $tmp['post_modified'] 				= $name->post_modified;
            $tmp['post_seo_title'] 				= $name->post_seo_title;
            $tmp['post_meta_desc'] 				= $name->post_meta_desc;
            $tmp['post_meta_keyword'] 			= $name->post_meta_keyword;
            $tmp['post_comment'] 				= $name->post_comment;
            $tmp['post_type'] 					= $name->post_type;
            $tmp['post_author'] 				= $name->post_author;
            $tmp['post_view'] 					= $name->post_view;
            $tmp['post_comment_count'] 			= $name->post_comment_count;
            $tmp['post_img']                    = null;
            $image = $this->db->where('post_id',$name->post_parent)->get("tb_post",1)->result();
            foreach($image as $img) {
                $tmp['post_img'] 				= $img->post_name;
            }
            $users = $this->db->where('username',$name->post_author)->get("tb_user",1)->result();
            foreach($users as $user) {
                $tmp['post_user_display_name'] 	= $user->user_display_name;
                $tmp['post_user_avatar'] 		= $user->user_avatar;
            }
            $return[] = $tmp;
            unset($tmp);
        }
        return $return;
    }

    public function getGallery($postId)
    {
        $photos = [];
        $this->db->select('p.post_name');
        $this->db->where('t.terms_type', 'media_gallery');
        $this->db->where('t.post_id', $postId);
        $this->db->join('tb_terms t','t.category_id=p.post_id');
        $results = $this->db->get('tb_post p')->result();
        foreach ($results as $v) {
            $photos[] = base_url('assets/uploads/'.$v->post_name);
        }
        return $photos;
    }

    public function getGalleryFull($postId)
    {
        $photos = [];
        $this->db->select('p.post_name,p.post_title,p.post_date');
        $this->db->where('t.terms_type', 'media_gallery');
        $this->db->where('t.post_id', $postId);
        $this->db->join('tb_terms t','t.category_id=p.post_id');
        $results = $this->db->get('tb_post p')->result();
        foreach ($results as $v) {
            $photos[] = [
                'image' => base_url('assets/uploads/'.$v->post_name),
                'title' => $v->post_title,
                'date'  => $v->post_date,
            ];
        }
        return $photos;
    }

    public function get_post_single($type=null,$slug=null, $stripTags=false){
        $return = array();
        $tmp 	= array();
        $this->db->where('post_status', 'Publish');
        if( $type ) $this->db->where('post_type',$type);
        $this->db->where('post_name',$slug);
        $dataonlypost    	= $this->db->get('tb_post')->result();
        foreach($dataonlypost as $name){
            $tmp['post_id'] 					= $name->post_id;
            $tmp['post_title'] 					= $name->post_title;
            $tmp['post_name'] 					= $name->post_name;
            $tmp['post_content'] 				= $name->post_content;
            if($stripTags) $tmp['post_content'] = strip_tags($name->post_content);
            $tmp['post_priority'] 				= $name->post_priority;
            $tmp['post_date'] 					= $name->post_date;
            $tmp['post_modified'] 				= $name->post_modified;
            $tmp['post_seo_title'] 				= $name->post_seo_title;
            $tmp['post_meta_desc'] 				= $name->post_meta_desc;
            $tmp['post_meta_keyword'] 			= $name->post_meta_keyword;
            $tmp['post_comment'] 				= $name->post_comment;
            $tmp['post_type'] 					= $name->post_type;
            $tmp['post_author'] 				= $name->post_author;
            $tmp['post_view'] 					= $name->post_view;
            $tmp['post_comment_count'] 			= $name->post_comment_count;
            $tmp['post_img']                    = '';
            $image = $this->db->where('post_id',$name->post_parent)->get("tb_post",1)->result();
            foreach($image as $img) {
                $tmp['post_img'] 				= $img->post_name;
            }
            $users = $this->db->where('username',$name->post_author)->get("tb_user",1)->result();
            foreach($users as $user) {
                $tmp['post_user_display_name'] 	= $user->user_display_name;
                $tmp['post_user_avatar'] 		= $user->user_avatar;
                $tmp['user_bio']                = $user->user_bio;
                $tmp['user_facebook']           = $user->user_facebook;
                $tmp['user_twitter']            = $user->user_twitter;
                $tmp['user_google_plus']        = $user->user_google_plus;
            }

            $this->db->select('category_name');
            $this->db->where('terms_type', 'tags');
            $this->db->where('post_id', $name->post_id);
            $this->db->join('tb_category', 'tb_category.category_id = tb_terms.category_id AND category_type = "tags"');
            $tmp['tags'] = $this->db->get('tb_terms')->result();
            $tmp['comments'] = $this->get_comment_where_post($tmp['post_id']);

            $return[] = $tmp;
            unset($tmp);
        }

        return reset($return);
    }

}
