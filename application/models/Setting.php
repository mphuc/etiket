<?php

/**
 * @property  CI_Lang $lang
 * @property  CI_DB_query_builder $db
 * @property  CI_Config $config
 */
class Setting extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $data = [];
        $this->db->where_in('setting_type',['setting_general','setting_company','cpanel']);
        foreach ($this->db->get('tb_setting')->result_array() as $item) {
            $data[$item['setting_desc']]  = $item['setting_value'];
        }
        $data['title']=$this->get_single_name('cpanel','Title');
        $data['logo']=$this->get_single_name('cpanel','Logo');
        return $data;
    }

    public function get_single($type, $setting_desc)
    {
        $this->db->where('setting_type', $type);
        $this->db->where('setting_desc', $setting_desc);
        return $this->db->get('tb_setting',1)->row('setting_value');
    }

    public function get_single_name($type, $setting_name)
    {
        $this->db->where('setting_type', $type);
        $this->db->where('setting_name', $setting_name);
        return $this->db->get('tb_setting',1)->row('setting_value');
    }

    public function get_multi($type, $setting_name=null)
    {
        if (!empty($setting_name)) {
            $this->db->group_start();
            $this->db->where_in('setting_name', $setting_name);
            $this->db->group_end();
        }
        $this->db->where_in('setting_type', $type);
        return $this->db->get('tb_setting')->result_array();
    }

    public function roles()
    {
        $this->db->where('setting_type', 'role_type');
        $this->db->order_by('setting_desc','asc');
        $this->db->order_by('setting_name','asc');
        return $this->db->get('tb_setting')->result_array();
    }

}
