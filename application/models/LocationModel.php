<?php
/**
 * @property  CI_Lang $lang
 * @property  CI_DB_query_builder $db
 * @property  CI_Config $config
 * @property  ApiModel apiModel
 */
class LocationModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array
     */
    public function province()
    {
        $this->db->order_by('name','asc');
        return $this->db->get('tb_provinces')->result_array();
    }

    /**
     * @param int $provinceId
     * @return array
     */
    public function city($provinceId=null)
    {
        if( $provinceId ) $this->db->where('province_id', $provinceId);
        $this->db->order_by('name','asc');
        return $this->db->get('tb_regencies')->result_array();
    }
}