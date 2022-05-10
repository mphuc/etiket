<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/Umbrella_Api_Action.php';
/**
 * Created by PhpStorm.
 * User: Bayu Setiawan
 * Date: 07/05/2018
 * Time: 9:20
 * @property CI_DB_query_builder $db
 * @property CI_Upload $upload
 * @property CI_Form_validation $form_validation
 */

class Umbrella_Api_Upload_Action extends Umbrella_Api_Action
{
    //config for ci_uploader
    private $upload_config;
    private static $default_config=array(
        'upload_path'   => 'assets/uploads/',
        'allowed_types' => 'gif|jpg|png',
        'max_size'      => '1024'
    );
    //table to save the file meta (set to false or null to not save)
    private $table;
    //upload field name
    private $field;
    //static data to be inserted to table
    private $insert_data_config;
    const INSERT_CONF_DATA=0x01;
    const INSERT_CONF_MAPING=0x02;

    public function __construct($field='file',$_upload_conf=array(),$_table=FALSE)
    {
        parent::__construct();
        $this->setUploadConfig($_upload_conf)->setTable($_table)->setField($field);
        $this->set_action('POST',array($this,'upload'));
        $this->insert_data_config=array();
        //todo should make default insert data configuration
    }
    public function upload(){
        try{
            if(!isset($_FILES)){
                throw new Exception('No upload file',REST_Controller::HTTP_BAD_REQUEST);
            }
            //filename config
            if(!isset($this->upload_config['file_name'])){
                $filename   = $_FILES[$this->field]['name'];
                $string     = preg_replace('/[^a-zA-Z0-9_.]/', '',$filename);
                $nm         = str_replace(" ","_",$string);
                $nm         = preg_replace('/\\.[^.\\s]{3,4}$/', '', $nm);
                $new_name   = $nm.'-'.date('Y_m_d');
                $this->upload_config['file_name']=$new_name;
            }
            //end of filename
            $this->CI->load->library('upload', $this->upload_config);
            if(!$this->CI->upload->do_upload($this->field)){
                throw new Exception($this->CI->upload->display_errors('',''),REST_Controller::HTTP_EXPECTATION_FAILED);
            }
            $upload_data=$this->CI->upload->data();
            $response=array('upload_data'=>$upload_data);
            //insert to db procedure
            if($this->table){
                $insert_data=array();
                foreach ($this->insert_data_config as $field=>$config){
                    if($config['type']===self::INSERT_CONF_DATA){
                        $insert_data[$field]=$config['value'];
                    }else if($config['type']===self::INSERT_CONF_MAPING){
                        $insert_data[$field]=$upload_data[$config['value']];
                    }
                }
                if(!$this->CI->db->insert($this->table,$insert_data)){
                    //TODO:should delete file here, need test
                    unlink($upload_data['full_path']);
                    //end
                    throw new Exception('Error inserting data to Database',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
                $response['insert_data']=$insert_data;
            }
            return self::make_response($response);
        }catch (Exception $e){
            return self::make_response(NULL,$e->getCode(),FALSE,$e->getMessage());

        }
    }

    /**
     * @param mixed $upload_config
     * @return Umbrella_Api_Upload_Action
     */
    public function setUploadConfig($upload_config=array())
    {
        $this->upload_config = $upload_config;
        foreach (self::$default_config as $key=>$value){
            if(!isset($this->upload_config[$key]))
                $this->upload_config[$key]=$value;
        }
        return $this;
    }

    /**
     * @param mixed $table
     * @return Umbrella_Api_Upload_Action
     */
    public function setTable($table)
    {
        $this->table= $this->CI->db->table_exists($table) ? $table : FALSE;
        return $this;
    }

    /**
     * @param mixed $field
     * @return Umbrella_Api_Upload_Action
     */
    public function setField($field)
    {
        $this->field = $field;
        return $this;
    }

    /**
     * @param $field
     * @param $type
     * @param $value
     * @return Umbrella_Api_Upload_Action
     * @throws Exception
     */
    public function setInsertDataConfig($field,$type,$value)
    {
        if(!in_array($type,array(self::INSERT_CONF_DATA,self::INSERT_CONF_MAPING)))
            throw new Exception('Invalid config',-1);
        $this->insert_data_config[$field] = array(
            'type'  => $type,
            'value' => $value
        );
        return $this;
    }

    /**
     * @param $field
     * @return Umbrella_Api_Upload_Action
     */
    public function unsetInsertDataConfig($field)
    {
        if(isset($this->insert_data_config[$field]))
            unset($this->insert_data_config[$field]);
        return $this;
    }
}