<?php


/**
 * @property Image_moo image_moo
 * @property CI_URI uri
 * @property CI_Upload upload
 */

class Img extends CI_Controller {
    protected $thumbnails = array('100x100','350x215');
    public function __construct()
    {
        parent::__construct();
    }
    /*
    ============================================
    Load img
    ============================================
    */
    public function clear()
    {
        $this->image_moo->clear_temp();
        $this->image_moo->clear();
        echo "clear cahce ok....";
        exit();
    }

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
        foreach ($this->thumbnails as $size) {
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

    public function load($width,$height,$effect=null,$image_path=null)
    {
        $this->load->library('uri');
        $width			=$this->uri->segment(3);
        $height			=$this->uri->segment(4);
        $effect			=$this->uri->segment(5);
        $image_path		=$this->uri->segment(6);
        if(empty($width) || empty($height) || empty($effect))
            redirect('cms/404', 'refresh');

        if(empty($image_path))
            $dir=ASSET_IMG."nophoto.jpg";
        else if(!file_exists("./".ASSET_IMG.$image_path))
            $dir=ASSET_IMG."nophoto.jpg";
        else
            $dir=ASSET_IMG.$image_path;
        $font=ASSET_FONT.'adventure.ttf';
        try {
            switch($effect){
                case "b":
                    $this->image_moo->load($dir)->set_background_colour("#fff")->resize($width,$height,TRUE)->border(3, "#fff")->border(2, "#969fa1")->save_dynamic();
                    break;
                case "circle":
                    $this->image_moo->load($dir)->set_background_colour("#fff")->resize($width,$height,TRUE)->round(30)->border(2, "#969fa1")->save_dynamic();
                    break;
                case "d":
                    $this->image_moo->load($dir)->set_background_colour("#fff")->resize($width,$height,TRUE)->save_dynamic();
                    break;
                case "wi":
                    $this->image_moo->load($dir)->load_watermark("matmoo.gif")->set_background_colour("#fff")->resize($width,$height,TRUE)->watermark(5)->save_dynamic();
                    break;
                case "w":
                    $this->image_moo->load($dir)->make_watermark_text("gitsolution.co.id", $font, 25, "#70ce31")->resize($width,$height,TRUE)->watermark(8,3)->border(3, "#fff")->border(2, "#969fa1")->save_dynamic();
                    break;
                case "a":
                    $dir='./assets/uploads/avatar/'.$image_path;
                    $this->image_moo->load($dir)->set_background_colour("#fff")->resize($width,$height,TRUE)->save_dynamic();
                    break;
                case "png":
                    $this->image_moo->load($dir)->set_background_colour("#fff")->resize($width,$height,TRUE)->save_dynamic();
                    break;
                case "full":
                    $this->image_moo->load($dir)->save_dynamic();
                    break;

                case "cover":
                    $this->image_moo->load($dir)->resize_crop($width,$height)->nyoba()->save_dynamic();
                    break;

                case "png2":
                    $this->image_moo->load($dir)->resize_crop($width,$height)->save_dynamic();
                    break;

                case "png3":
                    $this->image_moo->load($dir)->resize($width,$height)->save_dynamic();
                    break;

                case "theme":
                    if( !empty($image_path) ) {
                        $dir = FCPATH.'themes/umbrella-front/'.preg_replace('/\.[^.]+$/', '', $image_path)."/$image_path";
                        $dir2 = FCPATH.'themes/umbrella-front/'.preg_replace('/\.[^.]+$/', '', $image_path)."/$image_path.png";
                        $dir3 = FCPATH.'themes/umbrella-front/'.preg_replace('/\.[^.]+$/', '', $image_path)."/$image_path.jpg";
                        if( !file_exists( $dir ) ){
                            if( file_exists($dir2) ){
                                $dir = $dir2;
                            }elseif( file_exists($dir3) ){
                                $dir = $dir3;
                            }else{
                                $dir = ASSET_IMG."no-image.jpg";
                            }
                        }
                    }
                    $this->image_moo->load($dir)->resize_crop($width,$height)->save_dynamic();
                    break;

                case "crop":
                    $this->image_moo->load($dir)->resize_crop($width,$height)->save_dynamic();
                    break;

                default:
                    $this->image_moo->load($dir)->save_dynamic();
                    break;
            }
        }catch(Exception $e)
        {
            show_error($e->getMessage());
        }
        exit();
    }
    /*
 ============================================
 Upload Construct
 ============================================
 */
    public function upload()
    {
        $this->M_base_config->cekaAuth();
        try
        {
            if(!empty($_FILES))
            {

                $id       = $this->ion_auth->user()->row()->username;
                $tempFile = $_FILES['file']['tmp_name'];
                $fileName = $_FILES['file']['name'];
                $fileType = $_FILES['file']["type"];

                $string   = preg_replace('/[^a-zA-Z0-9_.]/', '',$fileName);
                $nm       = str_replace(" ","_",$string);
                $newName  = $id.'-'.date('Y_m_d').'-'.$nm;

                $config['upload_path'] = './assets/uploads/';
                $config['allowed_types'] = 'jpeg|gif|jpg|png';
                $config['file_name'] = $newName;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('file')){
                    echo json_encode($this->upload->display_errors());
                    exit;
                } else {
                    $this->crop($newName);
                    $this->resize($newName);
                    $data = array(
                        'post_title'		=> $newName,
                        'post_mime_type' 	=> $fileType,
                        'post_date' 		=> date('Y-m-d H:i:s'),
                        'post_modified' 	=> date('Y-m-d H:i:s'),
                        'post_type' 		=> 'media',
                        'post_status' 		=> 'publish',
                        'post_priority' 	=> 'no',
                        'post_comment' 		=> 'no',
                        'post_name'  		=> $newName,
                        'post_author'		=>$this->ion_auth->user()->row()->username
                    );
                    if ($this->db->insert('tb_post',$data)) {
                        $msg = array('upload_true');
                    }else {
                        $msg = array('upload_false');
                    }
                    echo json_encode($msg);
                    exit;
                }
            }else {
                $error = array("Tidak Ada File Upload");
                echo json_encode($error);
                exit;
            }
        }
        catch(Exception $err){
            log_message("error",$err->getMessage());
            echo json_encode(show_error($err->getMessage()));
            exit;
        }

    }
    /*
    ============================================
    Get Media
    ============================================
    */
    public function getMedia() {
        $this->M_base_config->cekaAuth();
        $this->load->library('pagination');
        $hal = $this->uri->segment(3);
        $per_page = 6;
        $search = $this->uri->segment(4);
        $keyword = $this->input->post('keyword',True);
        $user  = $this->ion_auth->user()->row();

        $config = array();
        if(!empty($search) && $search == 'search'){

            $media=array(
                'table'			=>'tb_post',
                'nm_sort'		=>'post_date',
                'sort'			=>'desc',
                'limit'			=>$per_page,
                'offset'		=>$hal,
                'where'			=>array(array(
                    'wherefield'	=>'post_type',
                    'where_value'	=>'media'
                )
                ),
                'match'			=>array(array(
                    'matchfield'	=>'post_title',
                    'match_value'	=>$keyword
                )
                )

            );
            $posts_add = $this->base_config->groups_access_sigle('media','show_all'); if($posts_add == true) {
                array_push($media['where'],array('wherefield'=> 'post_author','where_value'	=> $user->username));
            }
            $config['attributes'] = array('onclick' => 'return false;', 'class' => 'searchPagingclick','rel'=>false);
            $datamedia				= $this->M_base_config->search($media);
            $total_rows 			= $this->M_base_config->countSearch($media);

        }else {
            $media=array(
                'table'			=>'tb_post',
                'nm_sort'		=>'post_date',
                'sort'			=>'desc',
                'limit'			=>$per_page,
                'offset'		=>$hal,
                'where'			=>array(array(
                    'wherefield'	=>'post_type',
                    'where_value'	=>'media'
                ),
                    array(
                        'wherefield'	=>'post_status',
                        'where_value'	=>'Publish'
                    )
                )
            );
            $posts_add = $this->base_config->groups_access_sigle('media','show_all'); if($posts_add == true) {
                array_push($media['where'],array('wherefield'=> 'post_author','where_value'	=> $user->username));
            }
            $config['attributes'] 	= array('onclick' => 'return false;', 'class' => 'pagingclick','rel'=>false);
            $datamedia				= $this->M_base_config->getData($media);
            $total_rows 			= $this->M_base_config->countData('tb_post','post_type','media');
        }

        $config['base_url']			= '';
        $config['per_page']			= $per_page;
        $config['total_rows']		= $total_rows;
        $config['full_tag_open']	= '<ul class="uk-pagination uk-margin-medium-top uk-margin-medium-bottom">';

        $config['full_tag_open']	= '<ul class="uk-pagination uk-margin-medium-top uk-margin-medium-bottom">';
        $config['full_tag_close']	= '</ul>';
        $config['first_link']		= 'First';
        $config['last_link']		= 'Last';
        $config['first_tag_open']	= '<li>';
        $config['first_tag_close']	= '</li>';
        $config['prev_link']		= '<i class="uk-icon-angle-double-left"></i>';
        $config['prev_tag_open']	= '<li class="prev">';
        $config['prev_tag_close']	= '</li>';
        $config['next_link']		= '<i class="uk-icon-angle-double-right"></i>';
        $config['next_tag_open']	= '<li>';
        $config['next_tag_close']	= '</li>';
        $config['last_tag_open']	= '<li>';
        $config['last_tag_close']	= '</li>';
        $config['cur_tag_open']		= '<li class="uk-active"><span>';
        $config['cur_tag_close']	= '</span></li>';
        $config['num_tag_open']		= '<li>';
        $config['num_tag_close']	= '</li>';
        $this->pagination->initialize($config);

        $res = array(
            'data' => $datamedia,
            'jmldata' =>$config['total_rows'],
            'paging' =>$this->pagination->create_links()
        );
        /*echo "<pre>";
        print_r($res);
        echo "</pre>";*/
        echo json_encode($res);
        exit;
    }
    /*
    ============================================
    Media update
    ============================================
    */
    public function mediaupdate() {
        $this->M_base_config->cekaAuth();
        $postid 	= $this->input->post('id');
        $title 		= $this->input->post('title');
        $caption	= $this->input->post('caption');
        if(!empty($title)) {
            $data 	= array('post_title'=>$title);
        }else {
            $data 	= array('post_content'=>$caption);
        }
        $this->db->where('post_id', $postid);
        $this->db->update('tb_post', $data);
    }
    /*
    ============================================
    Notification Update
    ============================================
    */
    public function updatenotif(){
        $this->M_base_config->cekaAuth();
        $user 	= $this->input->post('user');
        $data 	= array('notification_status'=>'deactive');
        $this->db->where('notification_user', $user);
        $this->db->update('tb_notification', $data);
    }
}
?>
