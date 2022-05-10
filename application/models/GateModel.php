<?php
/**
 * Created by PhpStorm.
 * User: nurzazin
 * Date: 01/11/2018
 * Time: 19.41
 *
 * @property  CI_Lang $lang
 * @property  CI_DB_query_builder $db
 * @property  CI_Config $config
 */

class GateModel extends CI_Model
{
    protected $table = 'tb_gate';
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $this->db->order_by('gate_name','asc');
        $data = $this->db->get($this->table)->result_array();
        return $data;
    }
}