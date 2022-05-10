<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/Umbrella_Api_Action.php';
/**
 * Created by PhpStorm.
 * User: Bayu Setiawan
 * Date: 29/04/2018
 * Time: 23:13
 * @property CI_DB_query_builder $db
 * @property CI_Input $input
 * @property CI_Form_validation $form_validation
 * TODO: RELATION
 */

class Umbrella_Api_CRUD_Action extends Umbrella_Api_Action
{
    private $table;
    private $db;
    private $input;
    private $form_validation;
    private $readable;
    private $searchable;
    private $field;
    private $field_data;
    private $edit_field;
    private $edit_field_data;
    private $validation;
    private $where;

    public function __construct($table)
    {
        parent::__construct();
        //CI Stuff that i need
        $this->db=&$this->CI->db;
        $this->input=&$this->CI->input;
        $this->form_validation=&$this->CI->form_validation;
        //initialize CRUD
        $this->table=$table;
        $this->edit_field=$this->field=$this->searchable=$this->readable=$this->db->list_fields($this->table);
        $this->validation=$this->where=$this->edit_field_data=$this->field_data=array();
        //setting CRUD action
        $this->set_action('GET',array($this,'read'));
        $this->set_action('POST',array($this,'create'));
        $this->set_action('PUT',array($this,'update'));
        $this->set_action('DELETE',array($this,'delete'));
        $this->set_action('SINGLE',array($this,'single'));
    }

    public function run(array $args = array())
    {
        if($_SERVER['REQUEST_METHOD']==='GET' && count($args)>0){
            return $this->run_manual('SINGLE',$args);
        }else{
            return parent::run($args);
        }
    }

    public function create(){
        $raw_post=json_decode(file_get_contents('php://input'),true);
        if(count($this->validation)>0){
            $this->form_validation->set_data($raw_post);
            foreach ($this->validation as $field=>$validation){
                $this->form_validation->set_rules($field,$validation['label'],$validation['rule']);
            }
            if($this->form_validation->run()===FALSE){
                return self::make_response(NULL,REST_Controller::HTTP_BAD_REQUEST,FALSE,'Validation Error');
            }
        }
        $insert_data=array();
        foreach ($this->field as $field){
            if(isset($raw_post[$field]))
                $insert_data[$field]=$raw_post[$field];
            if(isset($this->field_data[$field])){
                //config procedure
                if(isset($this->field_data[$field]['default']))
                    $insert_data[$field]=$this->field_data[$field]['default'];
            }
        }
        if(!$this->db->insert($this->table,$insert_data)){
            return self::make_response(NULL,REST_Controller::HTTP_INTERNAL_SERVER_ERROR,FALSE,'Error inserting data');
        }
        return self::make_response();
    }
    public function set_validation($field,$label,$rule){
        $this->validation[$field]=array('label'=>$label,'rule'=>$rule);
        return $this;
    }
    public function read(){
        foreach ($this->where as $key=>$where){
            $this->db->where($key,$where->value,$where->escape);
        }
        $q=$this->input->get('q');
        $limit=$this->input->get('limit');
        $offset=$this->input->get('offset');
        if($q&&count($this->searchable)>0){
            $this->db->group_start();
            foreach ($this->searchable as $field){
                $this->db->or_like($field,$q);
            }
            $this->db->group_end();
        }
        if($limit){
            $this->db->limit($limit);
        }
        if($offset){
            $this->db->offset($offset);
        }
        $data=$this->db->select(implode(',',$this->readable))->get($this->table)->result();
        return parent::make_response($data);
    }
    public function update($id){
        $pk=$this->db->primary($this->table);
        $raw_data=json_decode(file_get_contents('php://input'),true);
        if(count($this->validation)>0){
            $this->form_validation->set_data($raw_data);
            foreach ($this->validation as $field=>$validation){
                $this->form_validation->set_rules($field,$validation['label'],$validation['rule']);
            }
            if($this->form_validation->run()===FALSE){
                return self::make_response(NULL,REST_Controller::HTTP_BAD_REQUEST,FALSE,'Validation Error');
            }
        }
        $update_data=array();
        foreach ($this->field as $field){
            if(isset($raw_data[$field]))
                $update_data[$field]=$raw_data[$field];
            if(isset($this->edit_field_data[$field])){
                //config procedure
                if(isset($this->edit_field_data[$field]['default']))
                    $insert_data[$field]=$this->edit_field_data[$field]['default'];
            }
        }
        foreach ($this->where as $key=>$where){
            $this->db->where($key,$where->value,$where->escape);
        }
        if(!$this->db->update($this->table,$update_data,array($pk=>$id))){
            return self::make_response(NULL,REST_Controller::HTTP_INTERNAL_SERVER_ERROR,FALSE,'Error updating data');
        }
        return self::make_response();
    }
    public function delete($id){
        $pk=$this->db->primary($this->table);
        foreach ($this->where as $key=>$where){
            $this->db->where($key,$where->value,$where->escape);
        }
        if(!$this->db->delete($this->table,array($pk=>$id))){
            return self::make_response(NULL,REST_Controller::HTTP_INTERNAL_SERVER_ERROR,FALSE,'Error removing data');
        }
        return self::make_response();
    }
    public function single($id){
        $pk=$this->db->primary($this->table);
        foreach ($this->where as $key=>$where){
            $this->db->where($key,$where->value,$where->escape);
        }
        $data=$this->db->where($pk,$id)->get($this->table)->row();
        if(!$data)
            return $this->get_errors(404);
        return self::make_response($data);
    }

    /**
     * Field yang akan muncul ketika di list
     * @param mixed $readable
     * @return Umbrella_Api_CRUD_Action
     */
    public function setReadable(...$readable)
    {
        $this->readable = $readable;
        return $this;
    }

    /**
     * Filed yang akan dicari ketika diberi search query
     * @param mixed $searchable
     * @return Umbrella_Api_CRUD_Action
     */
    public function setSearchable(...$searchable)
    {
        $this->searchable = $searchable;
        return $this;
    }

    /**
     * Field yang bisa diinput ketika add
     * @param mixed $field
     * @return Umbrella_Api_CRUD_Action
     */
    public function setField(...$field)
    {
        $this->field = $field;
        $this->edit_field=$field;
        return $this;
    }

    /**
     * Field yang bisa diinput ketika di edit
     * @param array $edit_field
     * @return Umbrella_Api_CRUD_Action
     */
    public function setEditField(...$edit_field)
    {
        $this->edit_field = $edit_field;
        return $this;
    }

    /**
     * Filter data default
     * @param mixed $where
     * @return Umbrella_Api_CRUD_Action
     */
    public function setWhere($field,$where,$escape=TRUE)
    {
        $this->where = array($field=>$where);
        $this->where[$field]=(object)array(
            'value'=>$where,
            'escape'=>$escape
        );
        return $this;
    }

    /**
     * Biasanya ga usah pakai ini
     * @param mixed $edit_field_data
     * @return Umbrella_Api_CRUD_Action
     */
    public function setEditFieldData($field,$key,$data)
    {
        if(!is_array($this->edit_field_data[$field]))
            $this->edit_field_data[$field]=array();
        $this->edit_field_data[$field][$key]=$data;
        return $this;
    }

    /**
     * Biasanya ga usah pakai ini
     * @param mixed $field_data
     * @return Umbrella_Api_CRUD_Action
     */
    public function setAddFieldData($field,$key,$data)
    {
        if(!is_array($this->field_data[$field]))
            $this->field_data[$field]=array();
        $this->field_data[$field][$key]=$data;
        return $this;
    }

    /**
     * Biasanya ga usah pakai ini
     * @param mixed $field_data
     * @return Umbrella_Api_CRUD_Action
     */
    public function setFieldData($field,$key,$data)
    {
        return $this->setAddFieldData($field,$key,$data)->setEditFieldData($field,$key,$data);
    }

    /**
     * Field yang diberi default value akan memiliki value dibawah ini diisi atau tidak
     * TODO: Buat add sama edit terpisah
     * @param $field
     * @param $value
     * @return Umbrella_Api_CRUD_Action
     */
    public function field_default($field, $value){
        return $this->setFieldData($field,'default',$value);
    }
}