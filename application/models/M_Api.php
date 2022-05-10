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
 * @property CI_Loader load
 * @property ApiModel apiModel
 * @property TermModel termModel
 * @property UserModel userModel
 * @property REST_Controller
 * @property Format
 */
class M_Api extends CI_Model  {
	
	public function __construct()
    {
    	parent::__construct();
    	date_default_timezone_set('Asia/Jakarta');
        $this->load->library('mahana_hierarchy');

    }
    public function checkAndSetTicket($tcode,$gate){
        $this->db->join('tb_product','tb_product.product_id = tb_ticket.product_id');
        $this->db->where('ticket_code',$tcode);
        $this->db->where('ticket_date',date('Y/m/d'));
        $this->db->where('ticket_active',0);
        $this->db->where('gate_name',$gate);
        $query  = $this->db->get("tb_ticket");
        if($query->num_rows() > 0){
            $idt    = $query->row()->ticket_id;
            $data   = array('ticket_active' =>1);
            $where  = array('ticket_id' =>$idt);
            $this->db->where($where);
            $this->db->update("tb_ticket",$data);
            return array('status_id'=>1,'status_name'=>"Ticket Valid");
        }else {
            return array('status_id'=>0,'status_name'=>"Ticket Not Valid");
        }

    }

    public function get_post_parse($limit=null,$offset=null,$type=null,$orderby=null,$orderbyvalue=null, $category=null){
    	$return = array();
    	$tmp 	= array();

    	if($limit != null && $offset !=null){
    		$limit			= $limit;
    		$offset			=$offset;
    	}else {
    		$limit			= 0;
    		$offset			= 10;
    	}
    	if($orderby != null){
    		$orderby 		= $orderby;
    		$orderbyvalue   = $orderbyvalue;
    	}else{
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
        $dataonlypost    	= $this->db->get('tb_post',$offset,$limit)->result();
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
        	$image = $this->db->where('post_id',$name->post_parent)->get("tb_post",1)->result();
        	foreach($image as $img) {
        		$tmp['post_img'] 				= $img->post_name;
        	}
        	$user = $this->db->where('username',$name->post_author)->get("tb_user",1)->result();
        	foreach($user as $user) {
        		$tmp['post_user_display_name'] 	= $user->user_display_name;
        		$tmp['post_user_avatar'] 		= $user->user_avatar;
        	}
        	$return[] = $tmp;
        	unset($tmp);
        }
        
        return $return;
    }
    public function get_post_sigle($param){
    	$return = array();
    	$tmp 	= array();
    	$seo 	= $data=$this->base_config->front_setting();
    	$this->db->where('post_status', 'Publish');
    	$this->db->where('post_type',$param['post_type']);
        $this->db->where('post_name',$param['post_name']);
        $dataonlypost    	= $this->db->get('tb_post')->result();
       
        if(array_key_exists('type_return', $param)){
            if($param['type_return'] == 'chart'){
                return $this->get_archive_full_post_image_chart($dataonlypost,$param);
            }else {
                return $this->get_full_post_image($dataonlypost,$param);
            }
        }else{
            return $this->get_full_post_image($dataonlypost,$param);
        }
        
    }

    public function get_comment_where_post($post_id){
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

    public function get_kontak_kami()
    {
        $post = $this->db->where('post_id', 323)->get('tb_post')->result();

        return $this->get_full_post_image($post);
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
            if(!empty($param['category_slug']))
            $post = $this->db->where_in('tb_category.category_slug',preg_split ("/\,/", $param['category_slug']));

            $this->db->join('tb_category','tb_category.category_id = tb_terms.category_id');

            $post = $this->db->join('tb_post','tb_post.post_id = tb_terms.post_id')
                ->where('tb_post.post_status','Publish')
                ->order_by($param['order_by'].' '.$param['order_by_value'])
                ->limit($param['limit'],$param['offset'])
                ->get('tb_terms')->result();
            if(array_key_exists('type_return', $param)){
                if($param['type_return'] == 'chart'){
                    $post2 = $this->db->where_in('tb_category.category_slug',preg_split ("/\,/", $param['category_slug']));
                    $this->db->join('tb_category','tb_category.category_id = tb_terms.category_id');
                    $post2 = $this->db->join('tb_post','tb_post.post_id = tb_terms.post_id')
                    ->where('tb_post.post_status','Publish')
                    ->order_by('CAST('.$param['order_by'].' AS UNSIGNED), '.$param['order_by'].' '.$param['order_by_value'])
                    ->limit($param['limit'],$param['offset'])
                    ->get('tb_terms')->result();
                    return $this->get_archive_full_post_image_chart($post2,$param);
                }else {
                    
                    return $this->get_archive_full_post_image($post,$param);
                }
            }else{
               
                return $this->get_archive_full_post_image($post,$param);
            }
        }
    }
    //Fix Jadi
    public function get_full_post_image($dataonlypost,$param){
        
        $return      = array();
        $tmp         = array();
        $post_parent = array();
        $post_id     = array();
        $user_id     = array();
        $gallery     = "";
        $user        ="";
        foreach($dataonlypost as $name){
            $tmp['post_id']                     = $name->post_id;
            $tmp['post_name']                   = $name->post_name;
            $tmp['post_title']                  = $name->post_title;
            $tmp['post_content']                = $name->post_content;
            $tmp['post_priority']               = $name->post_priority;
            $tmp['post_date_day']               = date('d', strtotime($name->post_date));
            $tmp['post_date_month']             = date('M', strtotime($name->post_date));
            $tmp['post_date_years']             = date('yy', strtotime($name->post_date));
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
            $tmp['post_parent']                 = $name->post_parent;
            $tmp['post_link_youtube']           = $name->post_dj;
            $return[]      = $tmp;
            $post_parent[] = $name->post_parent;
            $post_id[]     = $name->post_id;
            $user_id[]     = $name->post_author;
            unset($tmp);
        }
        //ok
        $image = array();
        if(!empty($post_parent))
        $image = $this->db->or_where_in('post_id',$post_parent)
                          ->order_by($param['order_by'].' '.$param['order_by_value'])  
                          ->get("tb_post")->result();

        if($param['show_all_galeri'] == 'True')       
        $gallery   = array();
        if(!empty($post_id))           
        $gallery = $this->db->or_where_in('tb_terms.post_id',$post_id)
                ->select('*, tb_terms.post_id as `main_post_id` ')
                ->join('tb_post','tb_post.post_id = tb_terms.category_id')
                ->where('tb_post.post_status','Publish')
                ->where('tb_terms.terms_type','media_gallery')
                ->get('tb_terms')->result();
        $gallery      =  json_decode(json_encode($gallery), True); 

        if($param['show_data_author'] == 'True')
        $user   = array();
        if(!empty($user_id))
        $user = $this->db->or_where_in('username',$user_id)->get("tb_user")->result();
        $user         =  json_decode(json_encode($user), True);

        $tmp_complete = array();
        $image        =  json_decode(json_encode($image), True);
        $count        = 0;
        $tmp_gallery  = array();
        $tmp_user     = array();
        foreach($return as $key => $value){
           $tmp_complete[$key]=$value;
           if(!empty($image) && $image[$count]['post_id'] == $return[$count]['post_parent']) {
                $tmp_complete[$count]['post_img_url']   = base_url().'assets/uploads/'.$image[$count]['post_name'];
                $tmp_complete[$count]['post_img_title'] = $image[$count]['post_title'];
                $tmp_complete[$count]['post_img_desc']  = $image[$count]['post_content'];
            } 
            if(!empty($gallery)){
                foreach($gallery as $key2) {
                    if($key2['main_post_id'] == $return[$count]['post_id']){
                        $tmp_gallery['post_galery_url']   =  base_url().'assets/uploads/'.$key2['post_name'];
                        $tmp_gallery['post_galery_title'] =  $key2['post_title'];
                        $tmp_gallery['post_galery_desc']  =  $key2['post_content'];
                        $tmp_complete[$count]['post_gallery'][]= $tmp_gallery;
                    }
                    
                }
            }
            if(!empty($user)){
                foreach($user as $key3) {
                    if($key3['username'] ==  $return[$count]['post_author']){
                        $tmp_user['user_display_name']  = $key3['user_display_name'];
                        $tmp_user['user_avatar']        = base_url().'assets/uploads/'.$key3['user_avatar'];
                        $tmp_user['username']           = $key3['username'];
                        $tmp_user['user_company']       = $key3['user_company'];
                        $tmp_user['user_bio']           = $key3['user_bio'];
                        $tmp_user['user_facebook']      = $key3['user_facebook'];
                        $tmp_user['user_twitter']       = $key3['user_twitter'];
                        $tmp_user['user_google_plus']   = $key3['user_google_plus'];
                        $tmp_complete[$count]['post_full_author'][]= $tmp_user;  
                    }
                    
                }
            }
           
            $count++;
        } 
        return $tmp_complete;
        exit;
    }
    //Fix Jadi
    public function get_archive_full_post_image($dataonlypost,$param){
       
        $return      = array();
        $tmp         = array();
        $post_parent = array();
        $post_id     = array();
        $user_id     = array();
        $gallery     = "";
        $user        ="";
        foreach($dataonlypost as $name){
            $tmp['post_id']                     = $name->post_id;
            $tmp['post_name']                   = $name->post_name;
            $tmp['post_title']                  = $name->post_title;
            $tmp['post_content']                = $name->post_content;
            $tmp['post_priority']               = $name->post_priority;
            $tmp['post_date_day']               = date('d', strtotime($name->post_date));
            $tmp['post_date_month']             = date('M', strtotime($name->post_date));
            $tmp['post_date_years']             = date('Y', strtotime($name->post_date));
            $tmp['post_date']                   = $name->post_date;
            $tmp['post_modified']               = $name->post_modified;
            $tmp['post_author']                 = $name->post_author;
            $tmp['post_view']                   = $name->post_view;
            $tmp['post_comment_count']          = $name->post_comment_count;
            $tmp['post_parent']                 = $name->post_parent;
            $tmp['post_link_youtube']           = $name->post_dj;
            $tmp['category_name']               = $name->category_name;
            $tmp['category_slug']               = $name->category_slug;

            $return[]      = $tmp;
            $post_parent[] = $name->post_parent;
            $post_id[]     = $name->post_id;
            $user_id[]     = $name->post_author;
            unset($tmp);
        }

        if(!empty($post_parent))
        $image = $this->db->or_where_in('post_id',$post_parent)
                          ->order_by($param['order_by'].' '.$param['order_by_value'])  
                          ->get("tb_post")->result();
                         
        if($param['show_all_galeri'] == 'True')                  
        $gallery = $this->db->or_where_in('tb_terms.post_id',$post_id)
                ->select('*, tb_terms.post_id as `main_post_id` ')
                ->join('tb_post','tb_post.post_id = tb_terms.category_id')
                ->where('tb_post.post_status','Publish')
                ->where('tb_terms.terms_type','media_gallery')
                ->get('tb_terms')->result();
        $gallery      =  json_decode(json_encode($gallery), True); 

        if($param['show_data_author'] == 'True')
        $user = $this->db->or_where_in('username',$user_id)->get("tb_user")->result();
        $user         =  json_decode(json_encode($user), True);

        $tmp_complete = array();
        $image        =  json_decode(json_encode($image), True);
        $count        = 0;
        $tmp_gallery  = array();
        $tmp_user     = array();

        foreach($return as $key => $value){
           $tmp_complete[$key]=$value;
           $tmp_complete[$count]['post_img_url']   = base_url()."assets/uploads/no-image.jpg";
           $tmp_complete[$count]['post_img_title'] = "";
           $tmp_complete[$count]['post_img_desc']  = "";
            for($x=0;$x<count($image);$x++){
                if ($image[$x]['post_id'] ==  $return[$count]['post_parent']) {
                    $tmp_complete[$count]['post_img_url']   = base_url().'assets/uploads/'.$image[$x]['post_name'];
                    $tmp_complete[$count]['post_img_title'] = $image[$x]['post_title'];
                    $tmp_complete[$count]['post_img_desc']  = $image[$x]['post_content'];
                }
            }
            if(!empty($gallery)){
                foreach($gallery as $key2) {
                    if($key2['main_post_id'] == $return[$count]['post_id']){
                        $tmp_gallery['post_galery_url']   =  base_url().'assets/uploads/'.$key2['post_name'];
                        $tmp_gallery['post_galery_title'] =  $key2['post_title'];
                        $tmp_gallery['post_galery_desc']  =  $key2['post_content'];
                        $tmp_complete[$count]['post_gallery'][]= $tmp_gallery;
                    }
                    
                }
            }
            if(!empty($user)){
                foreach($user as $key3) {
                    if($key3['username'] ==  $return[$count]['post_author']){
                        $tmp_user['user_display_name']  = $key3['user_display_name'];
                        $tmp_user['user_avatar']        = base_url().'assets/uploads/'.$key3['user_avatar'];
                        $tmp_user['username']           = $key3['username'];
                        $tmp_user['user_company']       = $key3['user_company'];
                        $tmp_user['user_bio']           = $key3['user_bio'];
                        $tmp_user['user_facebook']      = $key3['user_facebook'];
                        $tmp_user['user_twitter']       = $key3['user_twitter'];
                        $tmp_user['user_google_plus']   = $key3['user_google_plus'];
                        $tmp_complete[$count]['post_full_author'][]= $tmp_user;  
                    }
                    
                }
            }
           
            $count++;
        } 
        
        return $tmp_complete;
        exit;
    }
    //Fix chart
    public function get_archive_full_post_image_chart($dataonlypost,$param){
        $return      = array();
        $tmp         = array();
        $post_parent = array();
        $post_id     = array();
        $user_id     = array();
        $gallery     = "";
        $user        ="";
       
        foreach($dataonlypost as $name){
            $tmp['post_id']                     = $name->post_id;
            $tmp['post_name']                   = $name->post_name;
            $tmp['song_title']                  = $name->post_title;
            $tmp['song_artist']                 = $name->post_content;
            $tmp['song_genre']                  = $name->post_meta_desc;
            $tmp['song_chart_number']           = $name->post_meta_keyword;
            $tmp['category_name']               = $name->category_name;
            $tmp['category_slug']               = $name->category_slug;
            if($name->post_seo_title == 1){
                $tmp['song_chart_status']           = "Up";    
            }else if($name->post_seo_title == 2){
                $tmp['song_chart_status']           = "Stay";
            }else{
                $tmp['song_chart_status']           = "Down";
            }
            $tmp['post_priority']               = $name->post_priority;
            $tmp['post_date_day']               = date('d', strtotime($name->post_date));
            $tmp['post_date_month']             = date('M', strtotime($name->post_date));
            $tmp['post_date_years']             = date('Y', strtotime($name->post_date));
            $tmp['post_date']                   = $name->post_date;
            $tmp['post_modified']               = $name->post_modified;
            $tmp['post_parent']                 = $name->post_parent;
            $tmp['post_author']                 = $name->post_author;
            $tmp['post_link_youtube']           = $name->post_dj;
            $return[]      = $tmp;
            $post_parent[] = $name->post_parent;
            $post_id[]     = $name->post_id;
            $user_id[]     = $name->post_author;
            unset($tmp);
        }

        if(!empty($post_parent))
        $image = $this->db->or_where_in('post_id',$post_parent)
                          ->order_by($param['order_by'].' '.$param['order_by_value'])  
                          ->get("tb_post")->result();
                         
        if($param['show_all_galeri'] == 'True')
        if(!empty($post_id))                  
        $gallery = $this->db->or_where_in('tb_terms.post_id',$post_id)
                ->select('*, tb_terms.post_id as `main_post_id` ')
                ->join('tb_post','tb_post.post_id = tb_terms.category_id')
                ->where('tb_post.post_status','Publish')
                ->where('tb_terms.terms_type','media_gallery')
                ->get('tb_terms')->result();
        $gallery      =  json_decode(json_encode($gallery), True); 

        if($param['show_data_author'] == 'True')
        if(!empty($user_id))
        $user = $this->db->or_where_in('username',$user_id)->get("tb_user")->result();
        $user         =  json_decode(json_encode($user), True);

        $tmp_complete = array();
        $image        =  json_decode(json_encode($image), True);
        $count        = 0;
        $tmp_gallery  = array();
        $tmp_user     = array();

        foreach($return as $key => $value){
           $tmp_complete[$key]=$value;
           $tmp_complete[$count]['post_img_url']   = base_url().'assets/uploads/no-image.jpg';
           $tmp_complete[$count]['post_img_title'] = "";
           $tmp_complete[$count]['post_img_desc']  = "";
            for($x=0;$x<count($image);$x++){
                if ($image[$x]['post_id'] ==  $return[$count]['post_parent']) {
                    $tmp_complete[$count]['post_img_url']   = base_url().'assets/uploads/'.$image[$x]['post_name'];
                    $tmp_complete[$count]['post_img_title'] = $image[$x]['post_title'];
                    $tmp_complete[$count]['post_img_desc']  = $image[$x]['post_content'];
                }
            }
            if(!empty($gallery)){
                foreach($gallery as $key2) {
                    if($key2['main_post_id'] == $return[$count]['post_id']){
                        $tmp_gallery['post_galery_url']   =  base_url().'assets/uploads/'.$key2['post_name'];
                        $tmp_gallery['post_galery_title'] =  $key2['post_title'];
                        $tmp_gallery['post_galery_desc']  =  $key2['post_content'];
                        $tmp_complete[$count]['post_gallery'][]= $tmp_gallery;
                    }
                    
                }
            }
            if(!empty($user)){
                foreach($user as $key3) {
                    if($key3['username'] ==  $return[$count]['post_author']){
                        $tmp_user['user_display_name']  = $key3['user_display_name'];
                        $tmp_user['user_avatar']        = base_url().'assets/uploads/'.$key3['user_avatar'];
                        $tmp_user['username']           = $key3['username'];
                        $tmp_user['user_company']       = $key3['user_company'];
                        $tmp_user['user_bio']           = $key3['user_bio'];
                        $tmp_user['user_facebook']      = $key3['user_facebook'];
                        $tmp_user['user_twitter']       = $key3['user_twitter'];
                        $tmp_user['user_google_plus']   = $key3['user_google_plus'];
                        $tmp_complete[$count]['post_full_author'][]= $tmp_user;  
                    }
                    
                }
            }
           
            $count++;
        } 
      
        return $tmp_complete;
        exit;
    }
    public function get_setting($param) {
      
        $this->db->where('setting_type',$param['setting_type']);
        if(!empty($param['setting_name']))
        $this->db->where('setting_name',$param['setting_name']); 
        return  $this->db->get('tb_setting')->result();
    }

    //Get Schdule
    public function get_schedule($param){
        
        $post   =$this->db->select("tb_post.*, post_seo_title AS mydate")
                ->where('tb_post.post_type','schedule')
                ->where('tb_post.post_status','Publish')
                ->order_by("mydate",'ASC')
                ->get('tb_post')->result();
        return $this->get_full_post_schedule($post,$param);

    }
    public function get_broadcast_live($param){
        
        $post   =$this->db->where('tb_post.post_type','daftar_lagu')
                ->where('post_priority','Priority')
                ->order_by($param['order_by'].' '.$param['order_by_value'])
                ->limit($param['limit'],$param['offset'])
                ->get('tb_post')->result();
               
        return $this->get_full_broadcast_live($post,$param);

    }
    //Get Schedule Full
    public function get_full_post_schedule($dataonlypost,$param){
        $return      = array();
        $tmp         = array();
        $post_parent = array();
        $post_id     = array();
        $user_id     = array();
        foreach($dataonlypost as $name){
            $tmp['schedule_id']                 = $name->post_id;
            $tmp['schedule_url']                = $name->post_name;
            $tmp['schedule_image_post']         = base_url().'assets/uploads/'.$name->post_meta_desc;
            $tmp['schedule_name']               = $name->post_title;
            $tmp['schedule_content']            = $name->post_content;
            $tmp['schedule_day']                = $this->get_day($name->post_meta_keyword);
            $tmp['schedule_start_time']         = date('H:i',strtotime($name->post_seo_title));
            $tmp['schedule_end_time']           = date('H:i',strtotime($name->post_parent));
            $tmp['schedule_input_date_modified']= $name->post_modified;
            $user_id[]                          = $name->post_author;
            $return[]                           = $tmp;
            $post_id[]                          = $name->post_id;
            unset($tmp);
        }
        
        $gallery = $this->db->or_where_in('tb_terms.post_id',$post_id)
                ->select('*, tb_terms.post_id as `main_post_id` ')
                ->join('tb_user','tb_user.id = tb_terms.category_id')

                ->where('tb_terms.terms_type','Penyiar')
                ->get('tb_terms')->result();
        $user = $this->db->or_where_in('username',$user_id)->get("tb_user")->result();
      
        $tmp_complete = array();
   
        $gallery      =  json_decode(json_encode($gallery), True);
        $user         =  json_decode(json_encode($user), True);
        $count        = 0;
        $tmp_gallery  = array();
        $tmp_user     = array();
        foreach($return as $key => $value){
           $tmp_complete[$key]=$value;
            if($param['show_data_dj'] == 'True'){
                if(!empty($gallery)){
                    foreach($gallery as $key2) {
                        if($key2['main_post_id'] == $return[$count]['schedule_id']){
                            $tmp_gallery['user_display_name']  = $key2['user_display_name'];
                            $tmp_gallery['user_avatar']        = base_url().'assets/uploads/'.$key2['user_avatar'];
                            $tmp_gallery['username']           = $key2['username'];
                            $tmp_gallery['user_company']       = $key2['user_company'];
                            $tmp_gallery['user_bio']           = $key2['user_bio'];
                            $tmp_gallery['user_facebook']      = $key2['user_facebook'];
                            $tmp_gallery['user_twitter']       = $key2['user_twitter'];
                            $tmp_gallery['user_google_plus']   = $key2['user_google_plus'];
                            $tmp_complete[$count]['schedule_list_dj'][] = $tmp_gallery; 
                        }
                        
                    }
                }
            }
            if($param['show_data_author'] == 'True'){    
                if(!empty($user)){
                    foreach($user as $key3) {
                        if($key3['username'] ==  $return[$count]['post_author']){
                            $tmp_user['user_display_name']  = $key3['user_display_name'];
                            $tmp_user['user_avatar']        = base_url().'assets/uploads/'.$key3['user_avatar'];
                            $tmp_user['username']           = $key3['username'];
                            $tmp_user['user_company']       = $key3['user_company'];
                            $tmp_user['user_bio']           = $key3['user_bio'];
                            $tmp_user['user_facebook']      = $key3['user_facebook'];
                            $tmp_user['user_twitter']       = $key3['user_twitter'];
                            $tmp_user['user_google_plus']   = $key3['user_google_plus'];
                            $tmp_complete[$count]['post_full_author'][]= $tmp_user;  
                        }
                        
                    }
                }
            }
            $count++;
        } 
       
        return $tmp_complete;
        exit;
    }
    public function get_full_broadcast_live($dataonlypost,$param){
        $return      = array();
        $tmp         = array();
        $post_parent = array();
        $post_id     = array();
        $user_id     = array();
        $tmp_dj      = array();
        $guest_star  = array();
        $tmp_guest_star = array();   
        $tmp_guest_star_return = array();    
        $list_guest_star = array();
        foreach($dataonlypost as $name){
            $tmp['song_id']                 = $name->post_id;
            $tmp['schedule_url']                = $name->post_name;
            $tmp['song_name']               = $name->post_title;
            $tmp['song_artist']            = $name->post_content;
            $tmp['song_album_name']                = $name->post_seo_title;
            $tmp['song_year']         = $name->post_meta_desc;
            $tmp['song_track']           = $name->post_meta_keyword;
            $tmp['song_genre']= $name->post_author;
            $tmp['song_cover']= base_url().'assets/uploads/'. $name->post_name;
            $tmp['song_date_modified']= $name->post_modified;
            $return = $tmp;
            unset($tmp);
        }

        $dj   = $this->db->select('post_title,post_content,post_name,post_modified,tb_user.*')
        ->where('post_priority','Priority')
        ->where('post_type','dj_broadcast')
        ->join('tb_user','tb_user.user_google_plus = tb_post.post_title')
        ->limit($param['limit'],$param['offset'])
        ->order_by($param['order_by'].' '.$param['order_by_value'])
        ->get('tb_post')->result();

        if(date('H') >= '22'){
            $schedule_na   = $this->db->select("post_title,  max(post_seo_title) AS mydate")
            ->where('post_type','schedule')
            ->where('post_meta_keyword',idate('w', time()))
             ->order_by("tb_post.post_view",'ASC')
             ->get('tb_post')->row()->post_title;
        }else {
            $schedule_na   = $this->db->select("post_title,post_seo_title AS mydate")
            ->where('post_type','schedule')
            ->where('post_meta_keyword',idate('w', time()))
            ->where("post_seo_title <=  current_time() and post_parent >  current_time()")
             ->order_by("tb_post.post_view",'ASC')
             ->get('tb_post')->row()->post_title;
        }

        if(!empty($dj))
        foreach($dj as $key2){
            $tmp_dj['schedule_name']   = $schedule_na;
            $tmp_dj['main_dj_display_name']  = $key2->user_display_name;
            $tmp_dj['main_dj_avatar']        = base_url().'assets/uploads/'.$key2->user_avatar;
            $tmp_dj['main_dj_username']           = $key2->username;
            $tmp_dj['main_dj_user_instagram']       = $key2->user_company;
            $tmp_dj['main_dj_user_bio']           = $key2->user_bio;
            $tmp_dj['main_dj_user_facebook']      = $key2->user_facebook;
            $tmp_dj['main_dj_user_twitter']       = $key2->user_twitter;
            $tmp_dj['main_dj_nik']   = $key2->user_google_plus;
            $list_guest_star                      = $key2->post_name;                         
        }
        
        if($param['show_guest_star'] == 'True') {
            if(!empty($list_guest_star)){
                $wherein_guest_star  = explode(',', $list_guest_star);
                
                $guest_star   = $this->db->select('id,username,user_display_name,user_bio,user_avatar,user_company,user_facebook,user_twitter,user_current_location')
                ->or_where_in('user_google_plus',$wherein_guest_star)
                ->where('active',1)
                ->order_by('user_display_name','asc')
                ->get('tb_user')->result();
            }
            if(!empty($guest_star))
            foreach($guest_star as $key2){
                $tmp_guest_star['guest_star_display_name']  = $key2->user_display_name;
                $tmp_guest_star['guest_star_avatar']        = base_url().'assets/uploads/'.$key2->user_avatar;
                $tmp_guest_star['guest_star_username']           = $key2->username;
                $tmp_guest_star['guest_star_company']            = $key2->user_company;
                $tmp_guest_star['guest_star_user_bio']           = $key2->user_bio;
                $tmp_guest_star['guest_star_user_facebook']      = $key2->user_facebook;
                $tmp_guest_star['guest_star_user_twitter']       = $key2->user_twitter; 
                $tmp_guest_star_return['list_guest_star'][]        = $tmp_guest_star;
                unset($tmp_guest_star);                      
            }
        }
        return array_merge($return,$tmp_dj, $tmp_guest_star_return);exit;
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

    public function get_archive_list($limit = null){
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

    public function get_category_list($limit = null, $tipe = 'category'){
        if($limit){
            $this->db->limit($limit);
        }
        $return = $this->db
            ->select('tb_category.*')
            ->select('COUNT(terms_id) AS jumlah')
            ->join('tb_terms', "tb_terms.category_id = tb_category.category_id AND terms_type = '".$tipe."'")
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
                     $listmenu.='<li><a href="'.$cat->$name_slug.'"><span>'.$cat->$name_plus.'</span></a>';
                }elseif( $parenttype == 2 )
                {
                    $listmenu.='<li><a href="'.$cat->category_desc.'"><span>'.$cat->$name_plus.'</span></a>';
                }else{
                    $listmenu.='<li><a href="category/'.$cat->$name_slug.'"><span>'.$cat->$name_plus.'</span></a>';
                }
              
            }
            $listmenu.=$getchild;
            $listmenu.='</li>';
           
        }
       return $listmenu;
    }

    public function gethierarchychild($parent_id){
       $data= $this->mahana_hierarchy->get_children($parent_id);
       $getchild ="";
       if(!empty($data)) {
       $listmenu = '<div class="sub-main-menu"><ul class="sub-menu nav nav-tabs">';
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
               if($parenttype == 3){
                     $listmenu.='<li><a href="'.$cat->$name_slug.'"><span>'.$cat->$name_plus.'</span></a>';
                }else {
                    $listmenu.='<li><a href="category/'.$cat->$name_slug.'"><span>'.$cat->$name_plus.'</span></a>';
                }
            }
            $listmenu.=$getchild;
            $listmenu.='</li>';
        }
       $listmenu.=' </ul></div>';
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

    public function get_user($group,$user_id) {
        if($user_id<=0){
            $data =  $this->ion_auth->users($group)->result();
        }else {
            $data =  $this->db->where('id',$user_id)->where('groups','dj')->get("tb_view_user_and_group")->result();
        }
        $result = array(); 
        $tmp=array(); 
        foreach($data as $val){
            $tmp['id']                  = $val->id;
            $tmp['username']            = $val->username;
            $tmp['email']               = $val->email;
            $tmp['user_mobile']         = $val->user_mobile;
            $tmp['user_date_created']   = $val->created_on;
            $tmp['user_date_birth']     = $val->user_date_birth;  
            $tmp['user_display_name']   = $val->user_display_name;
            $tmp['last_login']          = $val->last_login;
            $tmp['user_bio']            = $val->user_bio.'<br><a href="'.$val->user_facebook.'">Facebook</a><br><a href="'.$val->user_facebook.'">Twitter</a>';
            $tmp['user_gender']         = $val->user_gender;
            $tmp['user_avatar']         = stripslashes(base_url().'assets/uploads/'.$val->user_avatar);
            $tmp['user_company']        = $val->user_company;
            $tmp['user_twitter']        = $val->user_twitter;
            $tmp['user_facebook']       = $val->user_facebook;
            $tmp['user_location']       = $val->user_current_location;
            $result[] = $tmp;
        }
        if(!empty($result)) {
            return $result;
        }else {
            return $this->status_rest('400','user');
        }
        
    }
    public function status_rest($code, $object) {
        $return     = array();
        $temp       = array();
        switch($code) {
        	case null:
			case false:
            case '':
                return false;
                break;
            case '400':
                $temp['401']        = "Mohon maaf ".$object." tidak ditemukan" ;
                return $return[]    = $temp;
                break;
            case 'contact-us':
                $this->contact_us();
                break;
            case 'sitemap.xml':
                $this->site_maps();
                break;
            case 'category':
                $this->category();
                break;
		    default:
		    	$this->_get_user($segment_2);
		        break;
        }
        exit;
    }
    public function get_day($param){
        switch($param) {
        	case null:
			case false:
            case '1':
                return "Monday";
                break;
            case '2':
                return "Tuesday";
                break;
            case '3':
                return "Wednesday";
                break;
            case '4':
                return "Thursday";
                break;
            case '5':
                return "Friday";
                break;
            case '6':
                return "Saturday";
                break;
		    default:
                return "Sunday";
		        break;
        }
        exit;
    }
    //Post Data 
    public function api_update_song($table, $primary, $data){
        $this->db->where('post_type', 'daftar_lagu');
        $priority = array('post_priority' => 'Normal');
        $this->db->update($table, $priority);


        $this->db->where('post_mime_type', $primary);
        if($this->db->update($table, $data)){
            return true;
        }else {
            return false;
        }
    }
    public function api_insert_song($table, $data){
        $this->db->where('post_type', 'daftar_lagu');
        $priority = array('post_priority' => 'Normal');
        $this->db->update($table, $priority);

        if($this->db->insert($table, $data)){
            return true;
        }else {
            return false;
        }
    }
    public function api_update_dj_broadcast($table,$main_dj,$guest_star,$schedule_title, $data){
        $this->db->where('post_type', 'dj_broadcast');
        $priority = array('post_priority' => 'Normal');
        $this->db->update($table, $priority);
        
        $this->db->where('post_title', $main_dj);
        $this->db->where('post_name', $guest_star);
        $this->db->where('post_content', $schedule_title);
        if($this->db->update($table, $data)){
            return true;
        }else {
            return false;
        }
    }
    public function api_insert_dj_broadcast($table, $data){
        $this->db->where('post_type', 'dj_broadcast');
        $priority = array('post_priority' => 'Normal');
        $this->db->update($table, $priority);

        if($this->db->insert($table, $data)){
            return true;
        }else {
            return false;
        }
    }
//fix
    public function insert_rating($data){
        if($this->db->insert(" tb_assessment_result", $data)){
            return array('status_id'=>1,'status_name'=>"Insert Successful");
        }else {
            return false;
        }
    }
}
