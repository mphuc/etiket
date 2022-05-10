<?php
/**
 * @property  CI_DB_query_builder $db
 */

class VendorModel extends CI_Model
{
    protected $table = 'tb_vendor';
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array
     */
    public function get()
    {
        $this->db->order_by('vendor_order','asc');
        return $this->db->get($this->table)->result_array();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getById($id)
    {
        $this->db->where('vendor_id',$id);
        return $this->db->get($this->table)->row_array();
    }

    /**
     * @param array $ids
     * @return array
     */
    public function getByIds($ids)
    {
        $this->db->where_in('vendor_id',$ids);
        return $this->db->get($this->table)->result_array();
    }

    /**
     * @param string $slug
     * @return array
     */
    public function getBySlug($slug)
    {
        $this->db->where('vendor_slug', trim($slug));
        return $this->db->get($this->table)->row_array();
    }

    /**
     * @param array $slugs
     * @return array
     */
    public function getBySlugs($slugs)
    {
        $this->db->where_in('vendor_slug', $slugs);
        return $this->db->get($this->table)->result_array();
    }

    /**
     * @return array
     */
    public function getFirst()
    {
        $this->db->order_by('vendor_order','asc');
        $this->db->order_by('vendor_slug','asc');
        return $this->db->get($this->table,1)->row_array();
    }
}