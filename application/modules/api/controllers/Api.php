<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Api extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Api');
        //header('Access-Control-Allow-Origin: *');
        //header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    }
   
    public function index_get()
    {   
        $segment_2 = $this->uri->segment(2);
        $segment_3 = $this->uri->segment(3);
        $segment_4 = $this->uri->segment(4);
        switch($segment_2) {
        	case null:
			case false:
            case '':
            echo "fala";
                break;
            case 'get_setting_mobile':
                $this->_get_setting_mobile();
                break;
            case 'get_gate':
                $this->_get_gate();
                break;
            case 'location_rate':
                $this->_get_location_rate();
                break;
            case 'assessment_list':
                $this->_assessment_list();
                break;
            default:
            echo "falsh";
		    	//$this->_get_user($segment_2);
		        break;
        }
        exit;
    }
    public function index_post()
    {  
        $segment_2 = $this->uri->segment(2);
        $segment_3 = $this->uri->segment(3);
        $segment_4 = $this->uri->segment(4);
        switch($segment_2) {
        	case null:
			case false:
            case '':
                $this->index();
                break;
            case 'check_ticket':
                $this->_check_ticket();
                break;
            case 'insert_rating':
                $this->_insert_rating();
                break;
            case 'post_song_broadcast':
                $this->_post_broadcast();
                break;
            case 'post_dj_broadcast':
                $this->_post_DJ();
                break;
		    default:
		    	$this->_get_user($segment_2);
		        break;
        }
        exit;
    }
    public function _get_setting_mobile(){
        
        $setting_type       = $this->input->get('setting_type');
        $setting_name       = $this->input->get('setting_name');

        $post_list          = array(
            'setting_type' =>$setting_type,
            'setting_name'=>$setting_name,
        );
        $data                = $this->M_Api->get_setting($post_list);
      
        if(!empty($data)){
            $this->response($data, REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
       
        return $return;
    }
    public function _get_gate()
    {
        $this->db->order_by('gate_name','asc'); 
        $data = $this->db->get('tb_gate')->result();
        if(!empty($data)){
            $this->response($data, REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
        return $return;
    }
    public function _get_location_rate()
    {
        $this->db->order_by('location_rate_name','asc');    
        $data = $this->db->get('tb_location_rate')->result();
        if(!empty($data)){
            $this->response($data, REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
        return $return;
    }
    public function _assessment_list()
    {
        $this->db->order_by('assessment_list_nilai','asc');
        $data = $this->db->get('tb_assessment_list')->result();
        if(!empty($data)){
            $this->response($data, REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
        return $return;
    }

    //Post 
    public function _check_ticket()
    {
        $tcode  = $this->input->post('ticket_code');
        $gcode  = $this->input->post('gate_code');
        $data   = $this->M_Api->checkAndSetTicket($tcode,$gcode);
        
        if(!empty($data)){
            $this->response($data, REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
        return $return;
    }
    public function _insert_rating()
    {
        $lid    = $this->input->post('location_rate_id');
        $art    = $this->input->post('assessment_result_type');
        $alid   = $this->input->post('assessment_list_id');
        $aln    = $this->input->post('assessment_list_nilai');
        $arn    = $this->input->post('assessment_result_name');
        $are    = $this->input->post('assessment_result_email');
        $ard    = $this->input->post('assessment_result_desc');

        if($art == "emot") {
            $post_list              = array(
                'assessment_list_id'        => $alid,
                'location_rate_id'          => $lid,
                'assessment_result_type'    => $art,
                'assessment_result_value'   => $aln 
            );
            $data                = $this->M_Api->insert_rating($post_list);
        }elseif($art == "feedplus"){
            $post_list              = array(
                'assessment_list_id'        => $alid,
                'location_rate_id'          => $lid,
                'assessment_result_type'    => $art,
                'assessment_result_name'    => $arn,
                'assessment_result_email'    => $are,
                'assessment_result_desc'    => $ard,
                'assessment_result_value'   => $aln 
            );
            $data                = $this->M_Api->insert_rating($post_list);
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'Wrong assessment_result_type'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
        
        
        if(!empty($data)){
            $this->response($data, REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
        return $return;
    }
    public function _get_archive()
    {
        $get_category       = $this->input->get('category_slug');
        $per_page           = $this->input->get('limit');
        $hal                = $this->input->get('offset');
        $order_by           = 'tb_'.$this->input->get('order_by');
        $option             = $this->input->get('option');
        $show_all_galeri     = $this->input->get('show_all_galeri');
        $show_data_author    = $this->input->get('show_data_author');

        $post_list          = array(
            'category_slug' => $get_category,
            'show_all_galeri'=> $show_all_galeri,
            'show_data_author'=> $show_data_author,
            'order_by'      => $order_by,
            'order_by_value'=> $option,
            'limit'         => $per_page,
            'offset'        => $hal,
        );
        $data                = $this->m_api->get_post_wherecategory($post_list);
        
        if(!empty($data)){
            $this->response($data, REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
        return $return;
    }  
    public function _get_chart()
    {
        $get_category       = $this->input->get('category_slug');
        $per_page           = $this->input->get('limit');
        $hal                = $this->input->get('offset');
        $order_by           = 'tb_'.$this->input->get('order_by');
        $option             = $this->input->get('option');
        $show_all_galeri     = $this->input->get('show_all_galeri');
        $show_data_author    = $this->input->get('show_data_author');

        $post_list          = array(
            'category_slug' => $get_category,
            'type_return'   => 'chart',
            'get_by_cat_type'   => 'chart',
            'show_all_galeri'=> $show_all_galeri,
            'show_data_author'=> $show_data_author,
            'order_by'      => $order_by,
            'order_by_value'=> $option,
            'limit'         => $per_page,
            'offset'        => $hal,
        );
        $data                = $this->m_api->get_post_wherecategory($post_list);
        
        if(!empty($data)){
            $this->response($data, REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
        return $return;
    }  
    public function _get_single_archive() 
    {
        $post_name           = $this->input->get('post_name');
        $show_all_galeri     = $this->input->get('show_all_galeri');
        $show_data_author    = $this->input->get('show_data_author');
        $post_list          = array(
            'post_name'      => $post_name,
            'show_all_galeri'=> $show_all_galeri,
            'show_data_author'=> $show_data_author,
            'post_type'     => "posts",
            'order_by'          => 'post_modified',
            'order_by_value'    => 'desc',
            'limit'             => 1,
            'offset'            => 0            
        );
        $data               = $this->m_api->get_post_sigle($post_list);
        if(!empty($data)){
            $this->response($data, REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
        return $return;
    }
 
    public function _get_pages() 
    {
        $post_name           = $this->input->get('post_name');
        $show_all_galeri     = $this->input->get('show_all_galeri');
        $show_data_author    = $this->input->get('show_data_author');
        $post_list          = array(
            'post_name'      => $post_name,
            'show_all_galeri'=> $show_all_galeri,
            'show_data_author'=> $show_data_author,
            'post_type'     => "pages",
            'order_by'          => 'post_modified',
            'order_by_value'    => 'desc',
            'limit'             => 1,
            'offset'            => 0            
        );
        $data               = $this->m_api->get_post_sigle($post_list);
        if(!empty($data)){
            $this->response($data, REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
        return $return;
    }
    public function _get_detail_archive() 
    {
        $post_name           = $this->input->get('post_name');
        $show_all_galeri     = $this->input->get('show_all_galeri');
        $show_data_author    = $this->input->get('show_data_author');
        $post_list          = array(
            'post_name'      => $post_name,
            'show_all_galeri'=> $show_all_galeri,
            'show_data_author'=> $show_data_author,
            'post_type'     => "posts",
            'order_by'          => 'post_modified',
            'order_by_value'    => 'desc',
            'limit'             => 1,
            'offset'            => 0            
        );
        $data               = $this->m_api->get_post_sigle($post_list);
        if(!empty($data)){
            $this->response($data, REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
        return $return;
    }
    public function _get_detail_archive_chart() 
    {
        $post_name           = $this->input->get('post_name');
        $show_all_galeri     = $this->input->get('show_all_galeri');
        $show_data_author    = $this->input->get('show_data_author');
        $post_list          = array(
            'type_return'      =>'chart',
            'post_name'      => $post_name,
            'show_all_galeri'=> $show_all_galeri,
            'show_data_author'=> $show_data_author,
            'post_type'     => "posts",
            'order_by'          => 'post_modified',
            'order_by_value'    => 'desc',
            'limit'             => 1,
            'offset'            => 0            
        );
        $data               = $this->m_api->get_post_sigle($post_list);
        if(!empty($data)){
            $this->response($data, REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
        return $return;
    }
    public function _get_schedule()
    {
        $show_gallery       = $this->input->get('show_gallery');
        $show_data_dj       = $this->input->get('show_data_dj');
        $show_data_author   = $this->input->get('show_data_author');
        $per_page           = $this->input->get('limit');
        $hal                = $this->input->get('offset');
        $order_by           = 'tb_'.$this->input->get('order_by');
        $option             = $this->input->get('option');

        $post_list              = array(
            'show_data_dj'      => $show_data_dj,
            'show_data_author'  => $show_data_author,
            'order_by'          => $order_by,
            'order_by_value'    => $option,
            'limit'             => $per_page,
            'offset'            => $hal,
        );
        $data                = $this->m_api->get_schedule($post_list);
        
        if(!empty($data)){
            $this->response($data, REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
        return $return;
    }  
    public function _get_live_broadcast() 
    {
        $show_guest_star       = $this->input->get('show_guest_star');
        $post_list              = array(
            'show_guest_star'   => $show_guest_star,
            'order_by'          => "post_modified",
            'order_by_value'    => "desc",
            'limit'             => 1,
            'offset'            => 0,
        );
       
        $data                = $this->m_api->get_broadcast_live($post_list);
        
        if(!empty($data)){
            $this->response($data, REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
        return $return;
    }
    public function _get_user($group,$user_id)
    {
        if($user_id == 'True'){
            $user_id = $this->input->get('user_id');
        }
        if(empty($group) && empty($user_id) ){
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); 
        }
        if(empty($group)){
            $group = "all";
        }
        $data = $this->m_api->get_user($group,$user_id);
        
        if(!empty($data)){
            $this->response($data, REST_Controller::HTTP_OK); 
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }
    protected function get_where_category($category_slug, $limit = null, $offset = 0){
        $array                     = array(
            'category_slug' => $category_slug,
            'order_by'      => 'tb_post.post_date',
            'order_by_value'=> 'desc',
            'limit'         => $limit,
            'offset'        => $offset,
        );
        return $this->m_api->get_post_wherecategory($array);
    }

    //This is Post Function
    //Insert Song
    public function _post_broadcast()
    {
        try
        {
            $id_lagu          = $this->input->post('song_id');
            $title            = $this->input->post('song_title');
            $artist           = $this->input->post('song_artist');
            $album            = $this->input->post('song_album');
            $year             = $this->input->post('song_year');
            $track            = $this->input->post('song_track');
            $genre            = $this->input->post('song_genre'); 
            $cover            = $this->input->post('song_cover'); 
            if(empty($id_lagu) || empty($title) || empty($artist) || empty($album) || empty($year) || empty($track) || empty($genre)){
                $this->response([
                    'status' => FALSE,
                    'message' => 'All data cannot be empty!'
                ], REST_Controller::HTTP_NOT_FOUND);exit;
            }
            if(!empty($cover))
            {
                if(@imagecreatefromstring(base64_decode($cover))) { 
                    $image = base64_decode($cover);
                    $image_name = md5(uniqid(rand(), true));
                    $newName  = $id_lagu.$image_name.'.' .'png';
                    file_put_contents("./assets/uploads/" .$newName, $image); 
                }else{
                    $newName  = "nocoversong.png";
                }
                //Proses Check existing song,
                $query    = $this->db->get_where('tb_post',array('post_type'=>'daftar_lagu','post_mime_type'=>$id_lagu))->row(); 
                //CeK id lagu
                if(!empty($query)) {
                    //Cek cover ganti atau tidak
                    $query    = $this->db->get_where('tb_post',array('post_type'=>'daftar_lagu','post_name'=>$newName))->row(); 
                    if(!empty($query)) {
                        $data             = array('post_priority'=>'Priority','post_modified'=>date('Y-m-d H:i:s'));
                        if($this->m_api->api_update_song('tb_post',$id_lagu,$data)){
                            $this->response([
                                'status' => TRUE,
                                'message' => 'Success update data'
                            ], REST_Controller::HTTP_OK); 
                        }else {
                            $this->response([
                                'status' => FALSE,
                                'message' => 'Validation Error!'
                            ], REST_Controller::HTTP_NOT_FOUND); 
                        }
                    }else{
                        if(empty($newName)){
                            $this->response([
                                'status' => FALSE,
                                'message' =>"Gagal Upload!"
                            ], REST_Controller::HTTP_NOT_FOUND); 
                        } else {
                            $this->crop($newName);
                            $this->resize($newName);
                            $data             = array('post_priority'=>'Priority','post_modified'=>date('Y-m-d H:i:s'),'post_name'=>$newName);
                            if ($this->m_api->api_update_song('tb_post',$id_lagu, $data)) {
                                $this->response([
                                    'status' => TRUE,
                                    'message' => "Update Success!"
                                ], REST_Controller::HTTP_OK); 
                            }else {
                                $this->response([
                                    'status' => FALSE,
                                    'message' => "Update Error!"
                                ], REST_Controller::HTTP_NOT_FOUND);
                            }
                        }
                    }
                }else {
                    if(empty($newName)){
                        $this->response([
                            'status' => FALSE,
                            'message' => "Song Cover tidak boleh kosong!"
                        ], REST_Controller::HTTP_NOT_FOUND); 
                    } else {
                        $this->crop($newName);
                        $this->resize($newName);
                        $title            = $this->input->post('song_title');
                        $artist           = $this->input->post('song_artist');
                        $album            = $this->input->post('song_album');
                        $year             = $this->input->post('song_year');
                        $track            = $this->input->post('song_track');
                        $genre            = $this->input->post('song_genre');
                        $data = array(
                            'post_title'		=> $title,
                            'post_content'		=> $artist,
                            'post_seo_title'	=> $album,
                            'post_meta_desc'	=> $year,
                            'post_meta_keyword'	=> $track,
                            'post_author'		=> $genre,
                            'post_date' 		=> date('Y-m-d H:i:s'),
                            'post_modified' 	=> date('Y-m-d H:i:s'),
                            'post_type' 		=> 'daftar_lagu',
                            'post_status' 		=> 'publish',
                            'post_priority' 	=> 'Priority',
                            'post_comment' 		=> 'no',
                            'post_mime_type' 	=> $id_lagu,
                            'post_name'  		=> $newName
                        );
                        if ($this->m_api->api_insert_song('tb_post',$data)) {
                            $this->response([
                                'status' => TRUE,
                                'message' => "Update Success!"
                            ], REST_Controller::HTTP_OK); 
                        }else {
                            $this->response([
                                'status' => FALSE,
                                'message' => "Gagal"
                            ], REST_Controller::HTTP_NOT_FOUND); 
                        }
                    }
                }  
            }else {
                $newName  = "nocoversong.png";
                $data = array('post_priority'=>'Priority','post_modified'=>date('Y-m-d H:i:s'),'post_name'=>$newName);
                if ($this->m_api->api_update_song('tb_post',$id_lagu, $data)) {
                    $this->response([
                        'status' => TRUE,
                        'message' => "Update Success!"
                    ], REST_Controller::HTTP_OK); 
                }else {
                    $this->response([
                        'status' => FALSE,
                        'message' => "Update Error!"
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            }
        }
        catch(Exception $err){
            log_message("error",$err->getMessage());
            $this->response([
                'status' => FALSE,
                'message' => show_error($err->getMessage())
            ], REST_Controller::HTTP_NOT_FOUND); 
            exit;
        }
     
    }
    //Insert DJ and 
    public function _post_DJ()
    {
        $main_dj            = $this->input->post('main_dj_nik');
        $guest_star         = $this->input->post('guest_star_nik_array');
        $schedule_title     = $this->input->post('schedule_title');
        if(empty( $main_dj) || empty($guest_star) || empty($schedule_title)){
            $this->response([
                'status' => FALSE,
                'message' => 'All data cannot be empty!'
            ], REST_Controller::HTTP_NOT_FOUND);exit;
        }
        //Check Existing dj data
        $query    = $this->db->get_where('tb_post',array('post_type'=>'dj_broadcast','post_title'=>$main_dj,'post_name'=>$guest_star,'post_content'=>$schedule_title))->row(); 
        $cek_nik = $this->db->select('id',1)->where('user_google_plus',$main_dj)->get('tb_user')->result();
  
        if(!empty($cek_nik)) {
            if(!empty($query)) {
                $data   = array('post_priority'=>'Priority','post_modified'=>date('Y-m-d H:i:s'));
                if($this->m_api->api_update_dj_broadcast('tb_post',$main_dj,$guest_star,$schedule_title,$data)){
                    $this->response([
                        'status' => TRUE,
                        'message' => 'Success update data'
                    ], REST_Controller::HTTP_OK); 
                }else {
                    $this->response([
                        'status' => FALSE,
                        'message' => 'Validation Error!'
                    ], REST_Controller::HTTP_NOT_FOUND); 
                }
            }else{
                $data   = array('post_type'=>'dj_broadcast','post_priority'=>'Priority','post_modified'=>date('Y-m-d H:i:s'),'post_title'=>$main_dj,'post_name'=>$guest_star,'post_content'=>$schedule_title);
                if($this->m_api->api_insert_dj_broadcast('tb_post',$data)){
                    $this->response([
                        'status' => TRUE,
                        'message' => 'Success update data'
                    ], REST_Controller::HTTP_OK); 
                }else {
                    $this->response([
                        'status' => FALSE,
                        'message' => 'Validation Error!'
                    ], REST_Controller::HTTP_NOT_FOUND); 
                }
            }
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'Main DJ NIK tidak terdaftar atau belum dimasukan'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }  

        
        
            exit;    
    }
   //Upload Function
   protected function resize($filename, $size=1000)
   {
       //$filename = 'apel.jpg';
       $path = FCPATH.'assets/uploads/';
       $originalFileName = $path.$filename;
       if( file_exists($originalFileName) ) {
           try {
               $image = new \Gumlet\ImageResize($originalFileName);
               $image->resizeToWidth($size);
               $image->save($originalFileName);
           } catch (\Gumlet\ImageResizeException $err) {
               log_message("error",$err->getMessage());
           }
       }
   }

   protected function crop($originalFileName)
   {
       $path = FCPATH.'assets/uploads/';
       $originalFileName = $path.$originalFileName;
       $name   = pathinfo($originalFileName, PATHINFO_FILENAME);
       $ext    = pathinfo($originalFileName, PATHINFO_EXTENSION);
       foreach ($this->config->item('media_thumbnail') as $size) {
           $sizes = explode('x', $size);
           $width = $sizes[0];
           $height = $sizes[1];
           $imageName  = $name.'.'.$ext;
           $dirName = $width.'x'.$height;
           if (!file_exists($path.$dirName)) {
               mkdir($path.$dirName, 0777);
           }
           $thumb_image_url  = $path.$dirName.'/'.$imageName;
           if( !file_exists($thumb_image_url) ) {
               try {
                   $image = new \Gumlet\ImageResize($originalFileName);
                   $image->crop($width,$height);
                   $image->save($thumb_image_url);
               } catch (\Gumlet\ImageResizeException $err) {
                   log_message("error",$err->getMessage());
               }
           }
       }
   }
}
