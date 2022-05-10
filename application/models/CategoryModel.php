<?php
/**
 * @property  CI_Lang $lang
 * @property  CI_DB_query_builder $db
 * @property  CI_Config $config
 * @property  CI_Loader load
 * @property  ProductModel productModel
 */
class CategoryModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $categoryType
     * @param string $orderColumn
     * @param string $orderSort
     * @return mixed|array
     */
    public function get($categoryType, $orderColumn='category_name', $orderSort='asc')
    {
        $this->db->where('category_type', $categoryType);
        $this->db->order_by($orderColumn, $orderSort);
        return $this->db->get('tb_category')->result_array();
    }

    /**
     * @param string $categoryType
     * @param string $orderColumn
     * @param string $orderSort
     * @param string $vendor
     * @return mixed|array
     */
    public function getByVendor($categoryType, $vendor, $orderColumn='category_name', $orderSort='asc')
    {
        $this->load->model('productModel');
        $productIds = $this->productModel->getIdsDisplayByVendor($vendor);
        $products = $this->productModel->getById($productIds);
        $categoryIds = array_column($products,'category_id');
        $categoryIds = array_values(array_unique($categoryIds));
        $this->db->group_start();
        $this->db->where_in('category_id', $categoryIds);
        $this->db->group_end();
        $this->db->where('category_type', $categoryType);
        $this->db->order_by($orderColumn, $orderSort);
        $categories = $this->db->get('tb_category')->result_array();
        return $categories;
    }

    /**
     * @param array $ids
     * @return array
     */
    public function getByIds($ids=array())
    {
        if( !$ids ) return [];
        $this->db->where_in('category_id', $ids);
        $this->db->order_by('category_name','asc');
        return $this->db->get('tb_category')->result_array();
    }

    /**
     * @param string $slug
     * @return array
     */
    public function getBySlug($slug)
    {
        $this->db->where('category_slug', $slug);
        return $this->db->get('tb_category',1)->row_array();
    }
}