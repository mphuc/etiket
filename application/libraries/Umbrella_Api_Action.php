<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';

/**
 * Created by PhpStorm.
 * User: Bayu Setiawan
 * Date: 29/04/2018
 * Time: 22:35
 * TODO: BETTER ERROR HANDLING
 */

class Umbrella_Api_Action
{
    protected $CI;
    private $actions=array();
    private $pre_action=array();
    private $post_action=array();
    private $default_errors=array();
    public function __construct()
    {
        $this->CI=&get_instance();
        $this->set_error(404,self::make_response(NULL,404,FALSE,'Not Found'));
        $this->set_error(REST_Controller::HTTP_INTERNAL_SERVER_ERROR,self::make_response(NULL,REST_Controller::HTTP_INTERNAL_SERVER_ERROR,FALSE,'Not Found'));
        $this->set_error(REST_Controller::HTTP_FORBIDDEN,self::make_response(NULL,REST_Controller::HTTP_FORBIDDEN,FALSE,'Forbidden'));
    }
    public function run(array $args=array()){
        return $this->run_manual($_SERVER['REQUEST_METHOD'],$args);
    }

    public function run_manual($action,array $args=array()){
        try{
            if(isset($this->actions[$action])){
                if(($res=call_user_func_array($this->pre_action[$action],$args))->complate===FALSE){
                    throw new Exception($res->code);
                }
                if(($data=call_user_func_array($this->actions[$action],$args))->complate===FALSE){
                    throw new Exception($data->code);
                }
                if(($res=call_user_func_array($this->post_action[$action],$args))->complate===FALSE){
                    throw new Exception($res->code);
                }
            }else
                $data=$this->get_errors(404);
        }catch (Exception $e){
            $data=$this->get_errors($e->getCode());
        }
        return $data;
    }

    public function set_action($method,$action){
        $this->actions[$method]=$action;
        if(!isset($this->pre_action[$method]))
            $this->pre_action[$method]=self::dummy_function();
        if(!isset($this->post_action[$method]))
            $this->post_action[$method]=self::dummy_function();
        return $this;
    }

    public function unset_action($method){
        unset($this->actions[$method]);
        unset($this->pre_action[$method]);
        unset($this->post_action[$method]);
    }

    public function callback_before_action($method,$callback){
        $this->pre_action[$method]=$callback;
        return $this;
    }

    public function callback_after_action($method,$callback){
        $this->post_action[$method]=$callback;
        return $this;
    }

    public function set_error($code,$response){
        $this->default_errors[$code]=$response;
        return $this;
    }

    public function set_error2($code,$data,$message){
        $this->set_error($code,self::make_response($data,$code,FALSE,$message));
        return $this;
    }

    public function get_errors($code){
        return isset($this->default_errors[$code])?$this->default_errors[$code]:$this->make_response(NULL,$code,FALSE,'Error');
    }

    static public function make_response($data=NULL,$code=200,$status=TRUE,$message='OK'){
        return (object)array(
            'complate'  => $status,
            'code'=>$code,
            'payload'=>array(
                'status'=>$status,
                'message'=>$message,
                'data'=>$data
            )
        );
    }

    static protected function dummy_function(){
        return function (){return self::make_response();};
    }
}