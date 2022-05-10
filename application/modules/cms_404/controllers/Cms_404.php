<?php 
class Cms_404 extends CI_Controller {

    public function index()
    {
        //Cek Auth
        //Get Panel Setting
        $data=$this->base_config->panel_setting();
        //Path Asset
        $data['asset'] = $this->base_config->asset_back();
        //Set navigation left
        $data['nav'] = 'no';
        // Declare Views name
        $data['viewspage'] = 'v_404';
        //Render Page 
        $this->output->set_status_header('404'); 
        $this->base_config->_render_page($data);

    }
    
}