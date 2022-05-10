<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property  M_base_config $M_base_config
 * @property  base_config $base_config
 * @property  Ion_auth|Ion_auth_model $ion_auth
 * @property  CI_Lang $lang
 * @property  CI_URI $uri
 * @property  CI_DB_query_builder $db
 * @property  CI_Config $config
 * @property  CI_Input $input
 * @property  CI_User_agent $agent
 * @property  Mahana_hierarchy $mahana_hierarchy
 * @property  Slug $slug
 * @property  CI_Session session
 */
class Cms_profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // load base config library
        //load not all reqruitment library
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        // load lang
        $this->lang->load('auth');
        //Instance class to make amazing fitur
    }
    // redirect if needed, otherwise display the user list
    // redirect if needed, otherwise display the user list
    public function index()
    {
        try {
            //cek auth
            $this->M_base_config->cekaAuth();
            if( $this->uri->segment(4) == 'edit' ){
                if( $this->ion_auth->get_user_id() != $this->uri->segment(5) ) show_404();
            }
            //Get Panel setting
            $data = $this->base_config->panel_setting();
            $tables = $this->config->item('tables', 'ion_auth');
            $umbrella = new grocery_CRUD();
            $umbrella->set_theme('twitter-bootstrap');
            $umbrella->set_table('tb_user');
            $umbrella->set_subject('User Data');
            $umbrella->unset_export();
            $umbrella->unset_print();
            $umbrella->unset_delete();
            $umbrella->unset_list();
            $umbrella->unset_texteditor('user_bio', 'fulltext');
            $umbrella->columns('user_avatar', 'user_display_name', 'last_login', 'user_created');
            $umbrella->fields('user_display_name','email', 'user_company', 'user_current_location', 'user_avatar', 'username', 'user_bio', 'user_created', 'active', 'user_gender', 'user_mobile', 'user_date_birth', 'user_company', 'user_facebook', 'user_twitter', 'user_google_plus', 'password', 'user_cover');
            $umbrella->edit_fields('user_display_name', 'email', 'user_company', 'user_current_location', 'user_bio', 'user_avatar', 'active', 'user_gender', 'user_mobile', 'user_date_birth', 'user_facebook', 'user_twitter', 'user_google_plus', 'password', 'user_cover');
            $umbrella->display_as('user_avatar', lang('user_avatar'));
            $umbrella->display_as('user_display_name', lang('user_display_name'));
            $umbrella->display_as('user_email', lang('user_email'));
            $umbrella->display_as('user_last_login', lang('user_last_login'));
            $umbrella->display_as('user_active', lang('user_active'));
            $umbrella->display_as('user_created', '<input type="checkbox" name="removeall" id="removeall" data-md-icheck />');
            $umbrella->callback_column('last_login', array($this, '_last_login'));
            $umbrella->set_field_upload('user_avatar', 'assets/uploads');
            $umbrella->set_field_upload('user_cover', 'assets/uploads');
            $umbrella->required_fields('username', 'password', 'email', 'konfirmpass');
            $umbrella->order_by('user_created', 'desc');
            $umbrella->set_rules('username', 'username', 'required|min_length[3]|max_length[25]|is_unique[' . $tables['users'] . '.username]|xss_clean');
            $umbrella->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[25]|matches[konfirmpass]|xss_clean');
            $umbrella->set_rules('konfirmpass', 'Confirmation password', 'trim|required');
            $umbrella->field_type('password', 'password');
            $umbrella->field_type('user_created', 'hidden', date("Y-m-d H:i:s"));
            $umbrella->callback_add_field('password', array($this, '_user_pass_add'));
            $umbrella->callback_edit_field('password', array($this, '_user_pass_edit'));
            $umbrella->callback_before_insert(array($this, 'encrypt_password_callback'));
            $umbrella->callback_before_update(array($this, 'encrypt_password_callback'));
            $umbrella->callback_column('user_avatar', array($this, '_callback_user_avatar'));
            $umbrella->callback_column('user_created', array($this, '_callback_user_created'));
            $umbrella->callback_after_insert(array($this, 'notification_user_after_insert'));
            $umbrella->callback_after_update(array($this, 'notification_user_after_update'));
            $umbrella->callback_after_delete(array($this, 'notification_user_after_delete'));
            $umbrella->set_composer(false);
            $state = $umbrella->getState();
            if ($state == 'edit' || $state == 'update_validation' || 'update') {
                $umbrella->set_rules('email', 'email', 'required|valid_email|xss_clean');
            } else {
                $umbrella->set_rules('email', 'email', 'required|valid_email|is_unique[' . $tables['users'] . '.email]|xss_clean');
            }
            $output = $umbrella->render();
            $data['asset'] = $this->base_config->asset_back();
            $data['viewspage'] = 'crud';
            $data['nav'] = 'yes';
            $this->base_config->_render_crud($data, $output);
        } catch (Exception $e) {
            if ($e->getCode() == 14) {
                //Cek Auth
                $this->M_base_config->cekaAuth();
                $this->load->library('pagination');

                $data = $this->base_config->panel_setting();
                $userdata = $this->ion_auth->user()->row();
                foreach ($userdata as $key => $value) {
                    $data[$key] = $value;
                }
                $this->db->where('post_author', $data['username']);
                $this->db->where('post_type', 'posts');
                $this->db->from('tb_post');
                $data['user_total_post'] = $this->db->count_all_results();

                $this->db->where('post_author', $data['username']);
                $this->db->where('post_type', 'media');
                $this->db->from('tb_post');
                $data['user_total_photo'] = $this->db->count_all_results();

                $hal = $this->uri->segment(5);

                $per_page = 6;

                $this->db->where('post_author', $data['username']);
                $this->db->where('post_type', 'media');
                $data['data_user_photo'] = $this->db->get('tb_post', $per_page, $hal)->result();
                $config['base_url'] = base_url() . 'cms/profile/index/profile/';
                $config['per_page'] = $per_page;
                $config['total_rows'] = $data['user_total_photo'];
                $config['full_tag_open'] = '<ul class="uk-pagination uk-margin-medium-top uk-margin-medium-bottom">';
                $config['full_tag_open'] = '<ul class="uk-pagination uk-margin-medium-top uk-margin-medium-bottom">';
                $config['full_tag_close'] = '</ul>';
                $config['first_link'] = 'First';
                $config['last_link'] = 'Last';
                $config['first_tag_open'] = '<li>';
                $config['first_tag_close'] = '</li>';
                $config['prev_link'] = '<i class="uk-icon-angle-double-left"></i>';
                $config['prev_tag_open'] = '<li class="prev">';
                $config['prev_tag_close'] = '</li>';
                $config['next_link'] = '<i class="uk-icon-angle-double-right"></i>';
                $config['next_tag_open'] = '<li>';
                $config['next_tag_close'] = '</li>';
                $config['last_tag_open'] = '<li>';
                $config['last_tag_close'] = '</li>';
                $config['cur_tag_open'] = '<li class="uk-active"><span>';
                $config['cur_tag_close'] = '</span></li>';
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';
                $this->pagination->initialize($config);
                $data['data_user_photo_pagging'] = $this->pagination->create_links();

                $this->db->where('post_author', $data['username']);
                $this->db->where('post_type', 'posts');
                $data['data_user_posts'] = $this->db->get('tb_post', 15, 0)->result();

                $data['data_user_groups'] = $this->ion_auth->get_users_groups($data['id'])->result();
                $data['accses'] = $this->base_config->groups_access_noncrud('users');

                $data['cekdisplay'] = $this->uri->segment(4);
                //Path Asset
                $data['asset'] = $this->base_config->asset_back();
                //Set navigation left
                $data['nav'] = 'yes';
                $data['profile'] = true;
                // Declare Views name
                $data['viewspage'] = 'v_profile';
                $this->base_config->_render_page($data);
            } else {
                show_error($e->getMessage());
            }
        }

    }

    /*
    *
    *====================================================
    * Dibawah ini merupakan Method/ call back yang dibutuhkan oleh grocery sebagai setingan tambahan
    * Return 
    *====================================================
    *
    */
    public function _last_login($value, $row)
    {
        $this->M_base_config->cekaAuth();
        if ($row->active == 1)
            $active = '<span class="uk-badge uk-badge-success">' . lang('user_is_active') . '</span> <br><small>' . timespan($value) . '</small>';
        else
            $active = '<span class="uk-badge uk-badge-danger">' . lang('user_deactive') . '</span><br> <small>' . timespan($value) . '</small>';

        return $active;
    }

    public function _callback_user_avatar($value, $row)
    {
        $uniq = preg_replace("/[^a-zA-Z0-9]+/", "", $value);
        $target = "'#modal_lightbox$uniq'";
        $type_con = $this->uri->segment(2);
        $editlink = site_url('cms/' . $type_con . '/index/edit/' . $row->id);
        $ret = '<ul class="md-list md-list-addon uk-margin-bottom"><li><div class="md-list-addon-element"><a class="img-small" data-uk-modal="{target:' . $target . '}"><img src="img/load/50/50/r/' . $value . '" data-uk-modal="{target:' . $target . '}" /></a></div><div class="md-list-content"><span class="md-list-heading"><a title="' . $row->username . '" href="' . $editlink . '"> <b></span><span class="uk-text-small uk-text-muted">' . $row->username . '</b></a><br>' . $row->email . '</span></div></li></ul><div class="uk-modal" id="modal_lightbox' . $uniq . '"><div class="uk-modal-dialog uk-modal-dialog-lightbox"><button type="button" class="uk-modal-close uk-close uk-close-alt"></button><img src="img/load/100/100/full/' . $value . '" alt=""/></div></div>';
        return $ret;
    }

    public function _callback_user_created($value, $row)
    {
        return '<input type="checkbox" class="removelist" value="' . $row->id . '" name="' . $row->id . '" id="' . $row->id . '" data-md-icheck />';
    }

    public function encrypt_password_callback($post_array, $primary_key = null)
    {
        $this->load->model('Ion_auth_model');
        $original_pass = $post_array['password'];
        $salt = $this->Ion_auth_model->store_salt ? $this->Ion_auth_model->salt() : FALSE;
        $password = $this->Ion_auth_model->hash_password($post_array['password'], $salt);
        $post_array['password'] = $password;
        return $post_array;
    }

    public function _user_pass_add()
    {
        return '<input id="pas1" type="password" class="md-input" name="konfirmpass"/><label>Confirmation password* :</label><input id="pas2" type="password" class="md-input" name="password"/>';
        return "<span data-uk-modal=\"{target:'#multipleupload'}\" class='md-btn md-btn-primary'> Multiple Upload</span>";
    }

    public function _user_pass_edit()
    {
        return '<input id="pas1" type="password" class="md-input" name="konfirmpass"/><label>Confirmation password* :</label><input id="pas2" type="password" class="md-input" name="password"/>';
    }


    function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce()
    {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
            $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')
        ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
    ============================================
    Record User Notification callback
    ============================================
    */
    public function notification_user_after_insert($post_array, $primary_key)
    {
        $user = $this->ion_auth->user()->row();
        if (!$this->ion_auth->is_admin()) {
            $val = array('type' => 'timeline', 'user' => $user->id, 'parent' => $primary_key, 'desc' => lang('add_notif'), 'icon' => 'add', 'link' => 'cms/profile/index/edit/' . $primary_key, 'title' => 'Profile');
            $this->M_base_config->insertnotif($val);
            $admin = $this->ion_auth->users(1)->result();
            foreach ($admin as $valadmin) {
                $val2 = array('type' => 'timeline', 'user' => $valadmin->id, 'parent' => $primary_key, 'desc' => '<i>' . $user->user_display_name . '</i> ' . lang('add_notif'), 'icon' => 'add', 'link' => 'cms/users/index/edit/' . $primary_key, 'title' => 'Profile');
                $this->M_base_config->insertnotif($val2);
            }
        } else {
            $val = array('type' => 'timeline', 'user' => $user->id, 'parent' => $primary_key, 'desc' => lang('add_notif'), 'icon' => 'add', 'link' => 'cms/users/index/edit/' . $primary_key, 'title' => 'Profile');
            $this->M_base_config->insertnotif($val);
        }

        return true;
    }

    public function notification_user_after_update($post_array, $primary_key)
    {
        $user = $this->ion_auth->user()->row();
        if (!$this->ion_auth->is_admin()) {
            $val = array('type' => 'timeline', 'user' => $user->id, 'parent' => $primary_key, 'desc' => lang('update_notif'), 'icon' => 'update', 'link' => 'cms/profile/index/edit/' . $primary_key, 'title' => 'Profile');
            $this->M_base_config->insertnotif($val);
            $admin = $this->ion_auth->users(1)->result();
            foreach ($admin as $valadmin) {
                $val2 = array('type' => 'timeline', 'user' => $valadmin->id, 'parent' => $primary_key, 'desc' => '<i>' . $user->user_display_name . '</i>  ' . lang('update_notif'), 'icon' => 'update', 'link' => 'cms/users/index/edit/' . $primary_key, 'title' => 'Profile');
                $this->M_base_config->insertnotif($val2);
            }
        } else {
            $val = array('type' => 'timeline', 'user' => $user->id, 'parent' => $primary_key, 'desc' => lang('update_notif'), 'icon' => 'update', 'link' => 'cms/profile/index/edit/' . $primary_key, 'title' => 'Profile');
            $this->M_base_config->insertnotif($val);
        }

        return true;
    }

    public function notification_user_after_delete($primary_key)
    {
        $user = $this->ion_auth->user()->row();
        if (!$this->ion_auth->is_admin()) {
            $val = array('type' => 'timeline', 'user' => $user->id, 'parent' => $primary_key, 'desc' => lang('delete_notif'), 'link' => 'javascript:void(0)', 'icon' => 'delete', 'title' => 'Profile');
            $this->M_base_config->insertnotif($val);
            $admin = $this->ion_auth->users(1)->result();
            foreach ($admin as $valadmin) {
                $val2 = array('type' => 'timeline', 'user' => $valadmin->id, 'parent' => $primary_key, 'desc' => '<i>' . $user->user_display_name . '</i> ' . lang('delete_notif'), 'link' => 'javascript:void(0)', 'icon' => 'delete', 'title' => 'Profile');
                $this->M_base_config->insertnotif($val2);
            }
        } else {
            $val = array('type' => 'timeline', 'user' => $user->id, 'parent' => $primary_key, 'desc' => lang('delete_notif'), 'link' => 'javascript:void(0)', 'icon' => 'delete', 'title' => 'Profile');
            $this->M_base_config->insertnotif($val);
        }

        return true;
    }
}