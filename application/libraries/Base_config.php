<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Base_config {

	public function __construct()
	{
	  	$this->CI =& get_instance();
	 	$this->CI->load->model('M_base_config');
	 	$this->CI->lang->load('auth');
	}
	public function _render_page($data=null,$output=null)
	{

		$this->CI->parser->parse($this->theme_back().'head',$data);
        if($data['nav'] == 'yes'){
        	$this->CI->parser->parse($this->theme_back().'nav',$data);
        }
        $this->CI->parser->parse($data['viewspage'],$data);
        if($data['nav'] == 'yes'){
        	$this->CI->parser->parse($this->theme_back().'footer',$data);
        }
	}

	public function _render_crud($data,$output,$plus=null,$upload=null)
	{	
		try {

			$output->data=$data;
			$this->CI->parser->parse($this->theme_back().'head_crud',$data);
			if($data['nav'] == 'yes'){
        		$this->CI->parser->parse($this->theme_back().'nav',$data);
       		}
			$this->CI->load->view($this->theme_back().'body_crud',$output);
		} catch (Exception $e) {
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
		
	}
	
	/*
	/============================================
	This Function to set dynamicaly base theme 
	/============================================
	*/
	public  function theme_back()
	{
		$set_theme=$this->CI->M_base_config->getSingleSetting('cpanel','theme_back');
		$theme=PATH_BACK.$set_theme.'/';
		return  $theme;
	}
	/*
	/============================================
	This Function to set dynamicaly base theme Front 
	/============================================
	*/
	public  function theme_front()
	{
		$set_theme=$this->CI->db->where('setting_type','front-theme')->where('setting_value','active')->get("tb_setting",1)->row('setting_name');
		$theme=PATH_FRONT.$set_theme.'/';
		return  $theme;
	}
	/*
	/============================================
	This Function to set base folder location assets themes data
	/============================================
	*/
	public  function asset_back()
	{
		$set_theme=$this->CI->M_base_config->getSingleSetting('cpanel','theme_back');
		$theme=BACK_ASSET.$set_theme.'/';
		return  $theme;
	}
	/*
	/============================================
	This Function to set base folder location assets themes data Front
	/============================================
	*/
	public  function asset_front()
	{
		$set_theme=$this->CI->db->where('setting_type','front-theme')->where('setting_value','active')->get("tb_setting",1)->row('setting_name');
		$theme=ASSET_THEME.$set_theme.'/';
		return  $theme;
	}
	/*
	/============================================
	This function for function singgle setting
	Return object
	/============================================
	*/
	public function sigleSetting($param1,$param2)
	{
		$setting=$this->CI->M_base_config->getSingleSetting($param1,$param2);
		return $setting;
	}
	/*
	/============================================
	This function for generate all aditional fitur and menu from tb_setting
	Return Array
	/============================================
	*/
	public function multiSetting($param1,$param2)
	{
		$setting=$this->CI->M_base_config->getMultiSetting($param1,$param2);
		return $setting;
	}
	/*
	/============================================
	This function for generate all aditional fitur back setting
	/============================================
	*/
	public function panel_setting()
	{
		try {
			$data['title']=$this->sigleSetting('cpanel','Title');
			$data['logo']=$this->sigleSetting('cpanel','Logo');

			return $data;
		} catch (Exception $e) {
			redirect('cms/404', 'refresh');
		}
	}
	/*
	/============================================
	This function for generate all aditional default fitur Front setting
	/============================================
	*/
	public function front_setting()
	{
		$data =array();
		$this->CI->db->where('setting_type','front-customize');
		$this->CI->db->or_where('setting_type','setting_general');
		$this->CI->db->or_where('setting_type','setting_seo');
		$query = $this->CI->db->get('tb_setting')->result();
		foreach($query as $val) {
			if($val->setting_type == 'front-customize'){
				$data[$val->setting_name] = $val->setting_value; 
			}else{
				$data[$val->setting_desc] = $val->setting_value; 
			}
		}
		return $data;
	}
	/*
	/============================================
	This function for generate ago time auto
	/============================================
	*/
	public function timeAgo($time_ago)
		{
		    $time_ago = strtotime($time_ago);
		    $cur_time   = time();
		    $time_elapsed   = $cur_time - $time_ago;
		    $seconds    = $time_elapsed ;
		    $minutes    = round($time_elapsed / 60 );
		    $hours      = round($time_elapsed / 3600);
		    $days       = round($time_elapsed / 86400 );
		    $weeks      = round($time_elapsed / 604800);
		    $months     = round($time_elapsed / 2600640 );
		    $years      = round($time_elapsed / 31207680 );
		    // Seconds
		    if($seconds <= 60){
		        return lang('time_now');
		    }
		    //Minutes
		    else if($minutes <=60){
		        if($minutes==1){
		            return lang('time_aminute');
		        }
		        else{
		            return "$minutes ".lang('time_minute');
		        }
		    }
		    //Hours
		    else if($hours <=24){
		        if($hours==1){
		            return lang('time_ahrs');
		        }else{
		            return "$hours ".lang('time_hrs');
		        }
		    }
		    //Days
		    else if($days <= 7){
		        if($days==1){
		            return lang('time_yes');
		        }else{
		            return "$days ".lang('time_day');
		        }
		    }
		    //Weeks
		    else if($weeks <= 4.3){
		        if($weeks==1){
		            return lang('time_aweek');
		        }else{
		            return "$weeks ".lang('time_week');
		        }
		    }
		    //Months
		    else if($months <=12){
		        if($months==1){
		            return lang('time_amonth');
		        }else{
		            return "$months ".lang('time_month');
		        }
		    }
		    //Years
		    else{
		        if($years==1){
		            return lang('time_ayear');
		        }else{
		            return "$years ".lang('time_year');
		        }
		    }
		}
	/*
	/============================================
	This function for generate active link
	/============================================
	*/
	public function activelinkCRUD($type){
		$uril = $this->CI->uri->segment(4);
		if($type == $uril) {
			return 'activelinkCRUD';
		}
	}
	/*
	/============================================
	This function for generate active link
	/============================================
	*/
	public function activelinknav($type,$submenu=null){
		$uril 	   = $this->CI->uri->segment(2);
		$urilindex = $this->CI->uri->segment(4);
		if($type == $uril && $submenu !=null && $type != "add" ) {
			return 'act_item';
		}else if($type == $uril && $submenu ==null) {
			return 'current_section';
		}else if($type == "add" && $urilindex == "add" && $submenu ==$uril){
			return 'act_item';
		}else {

		}
	}
	/*
	/============================================
	This function for Grub Access Role !Important
	/============================================
	*/
	public function groups_access($role_desc) {
		$user  = $this->CI->ion_auth->user()->row();
		$umbrella   = new grocery_CRUD();
		if(!$this->CI->ion_auth->is_admin()){
			if(!empty($role_desc)){
			$this->CI->db->where('setting_type','role_type');
			$this->CI->db->where('setting_desc',$role_desc);
			$query = $this->CI->db->get('tb_setting')->result();
				foreach($query as $role){
					$gettermsrole = $this->cekarrayroleuser($role->setting_id);
					if($role->setting_value == 'add'){
						if (!$this->CI->ion_auth->in_group($gettermsrole)){
							$umbrella->set_bulkactionfalse(true);
							$umbrella->unset_add();
						}
					}
					if($role->setting_value == 'edit'){
						if (!$this->CI->ion_auth->in_group($gettermsrole)){
							$umbrella->set_bulkactionfalse(true);
							$umbrella->unset_edit();
						}
					} 
					if($role->setting_value == 'delete'){
						if (!$this->CI->ion_auth->in_group($gettermsrole)){
							$umbrella->unset_delete();
							$umbrella->set_bulkactionfalse(true);
						}
					}
					if($role->setting_value == 'print'){
						if (!$this->CI->ion_auth->in_group($gettermsrole)){
							$umbrella->unset_print();
						}
					} 
					if($role->setting_value == 'export'){
						if (!$this->CI->ion_auth->in_group($gettermsrole)){
							$umbrella->unset_export();
						}
					}
					if($role->setting_value == 'add_media'){
						if ($this->CI->ion_auth->in_group($gettermsrole)){
							$umbrella->set_composer(true);
							$umbrella->set_relation_n_n('media_gallery', 'tb_terms', 'tb_post', 'tb_terms.post_id', 'category_id', 'post_name',null,array('post_type' => 'media'));
						}
					}
					if($role->setting_value == 'list_media'){
						if ($this->CI->ion_auth->in_group($gettermsrole)){
							$umbrella->set_list_upload(true);
						}else{
							$umbrella->set_list_upload(false);
						}
					}
					if($role->setting_value == 'show_all' && $role_desc != 'comment'){
						if (!$this->CI->ion_auth->in_group($gettermsrole)){
							$umbrella->where('tb_post.post_author',$user->username);
						}
					}
					if($role->setting_value == 'show_all' && $role_desc == 'comment'){
						if (!$this->CI->ion_auth->in_group($gettermsrole)){
							$umbrella->set_relation('feed_parent','tb_post','post_title',array('post_author' => $user->username));
						}
					}
				}		
			}
		}else {
			if($role_desc == 'post' || $role_desc == 'page'){
				$umbrella->set_composer(true);
				$umbrella->set_relation_n_n('media_gallery', 'tb_terms', 'tb_post', 'tb_terms.post_id', 'category_id', 'post_name',null,array('post_type' => 'media'));
			}
			if($role_desc == 'media'){
				$umbrella->set_list_upload(true);
			}
		}
		/*echo "<pre>";
		print_r($gettermsrole);
		echo "</pre>";
		exit;*/
		return $umbrella;
	}
	public function groups_access_noncrud($role_desc) {
		$data=array();
		if(!$this->CI->ion_auth->is_admin()){
			if(!empty($role_desc)){
			$this->CI->db->where('setting_type','role_type');
			$this->CI->db->where('setting_desc',$role_desc);
			
			$query = $this->CI->db->get('tb_setting')->result();
				foreach($query as $role){
					$gettermsrole = $this->cekarrayroleuser($role->setting_id);
					if($role->setting_value == 'add'){
						if ($this->CI->ion_auth->in_group($gettermsrole)){
							$data['add_access'] = true;
						}
					}
					if($role->setting_value == 'edit'){
						if ($this->CI->ion_auth->in_group($gettermsrole)){
							$data['edit_access'] = true; 
						}
					} 
					if($role->setting_value == 'delete'){
						if ($this->CI->ion_auth->in_group($gettermsrole)){
							$data['delete_access'] = true; 
						}
					}
					if($role->setting_value == 'print'){
						if ($this->CI->ion_auth->in_group($gettermsrole)){
							$data['print_access'] = true; 
						}
					} 
					if($role->setting_value == 'export'){
						if ($this->CI->ion_auth->in_group($gettermsrole)){
							$data['export_access'] = true;
						}
					}

				}		
			}
		}else {
			$data['edit_access'] = false;
			$data['add_access'] = false;
		}
		
		return $data;
	}
	public function groups_access_sigle($role_desc,$settingvalue) {
		$hidden = false;
		if(!$this->CI->ion_auth->is_admin()){
			if(!empty($role_desc)){
			$this->CI->db->where('setting_type','role_type');
			$this->CI->db->where('setting_desc',$role_desc);
			$query = $this->CI->db->get('tb_setting')->result();
				foreach($query as $role){
					$gettermsrole = $this->cekarrayroleuser($role->setting_id);
					if($role->setting_value == $settingvalue){
						if (!$this->CI->ion_auth->in_group($gettermsrole)){
							$hidden = true;
						}
					}
				}		
			}
		}else {
			$hidden = false;
		}
		return $hidden;
	}
	public function cekarrayroleuser($idroletype){
		$this->CI->db->select('post_id');
		$this->CI->db->where('terms_type','role');
		$this->CI->db->where('category_id',$idroletype);
		$getrole= $this->CI->db->get('tb_terms')->result();
		$data = array();
		foreach($getrole as $role){
			if(!empty($role->post_id)){
				$data[] = (int)$role->post_id;
			}
		}
		if(!empty($data)){
			return $data;
		}
	}
	/*
	/============================================
	This function for Notification User
	/============================================
	*/
	public function notificationlist(){
		$user  = $this->CI->ion_auth->user()->row();
		$this->CI->db->where('notification_user',$user->id);
		$this->CI->db->order_by('notification_date','desc');
		return $this->CI->db->get('tb_notification',5)->result();
	}
	public function userpanellist(){
		$user  = $this->CI->ion_auth->user()->row();
		$this->CI->db->select('user_display_name, user_avatar, active, user_company');
		$this->CI->db->order_by('id','desc');
		return $this->CI->db->get('tb_user',10)->result();
	}
    public function bulan_string($angka){
        switch ($angka) {
            case '1':
                return 'Januari';
                break;
            case '2':
                return 'Februari';
                break;
            case '3':
                return 'Maret';
                break;
            case '4':
                return 'April';
                break;
            case '5':
                return 'Mei';
                break;
            case '6':
                return 'Juni';
                break;
            case '7':
                return 'Juli';
                break;
            case '8':
                return 'Agustus';
                break;
            case '9':
                return 'September';
                break;
            case '10':
                return 'Oktober';
                break;
            case '11':
                return 'November';
                break;
            case '12':
                return 'Desember';
                break;
            default:
                return 'Na';
                break;
        }
    }
}