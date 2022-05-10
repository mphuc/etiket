<?php
/**
 * @property  CI_Lang $lang
 * @property  CI_DB_query_builder $db
 * @property  CI_Config $config
 */
class TermModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * @param $type string
     * @param $column string
     * @return array
     */
    public function getAllByColumn($type, $column=null)
    {
        $this->db->where('terms_type',$type);
        $data = $this->db->get('tb_terms')->result_array();
        if( $column ) return array_column($data, $column);
        return $data;
    }
    /**
     * @param $type string
     * @param $categoryId int
     * @return array
     */
    public function getAllById($type, $id)
    {
        $this->db->where('terms_type',$type);
        $this->db->where('post_id',$id);
        $data = $this->db->get('tb_terms')->result_array();
        return $data;
    }
    /**
     * @param $type string
     * @param $categoryId int
     * @param $column string
     * @return array
     */
    public function getColumnById($type, $id, $column)
    {
        $this->db->where('terms_type',$type);
        $this->db->where('post_id',$id);
        $data = $this->db->get('tb_terms')->result_array();
        return array_column($data, $column);
    }

    /**
     * @param $type string
     * @param $catId int
     * @param $postIds array
     * @return boolean
     */
    public function add($type, $catId, $postIds)
    {
        $data = array();
        foreach ($postIds as $postId) {
            $data[] = array(
                'terms_type'    => $type,
                'category_id'   => $catId,
                'post_id'       => $postId,
            );
        }
        if( !$data ) return 0;
        return $this->db->insert_batch('tb_terms', $data);
    }

    /**
     * @param $type string
     * @param $catId int
     * @param $postIds array
     * @return boolean
     */
    public function remove($type, $catId=null, $postIds=array())
    {
        $this->db->where('terms_type', $type);
        if( $catId ) $this->db->where('category_id', $catId);
        if( $postIds ){
            $this->db->group_start();
            $this->db->where_in('post_id', $postIds);
            $this->db->group_end();
        }
        return $this->db->delete('tb_terms');
    }
}