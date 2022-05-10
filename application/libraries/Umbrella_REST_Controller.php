<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/Umbrella_Api_Action.php';
/**
 * Created by PhpStorm.
 * User: Bayu Setiawan
 * Date: 30/04/2018
 * Time: 9:21
 * Example: https://gist.github.com/aquaswim/3965c3311914eb4c366620a3756ae691
 * TODO: Make auth procedure with req: modular, extandable, easy to integrate
 */
class Umbrella_REST_Controller extends REST_Controller
{
    public function __construct($config = 'rest')
    {
        parent::__construct($config);
    }
    public function _remap($object_called, $arguments = [])
    {
        if(!method_exists($this,$object_called)){
            $this->my_set_response(Umbrella_Api_Action::make_response(NULL,REST_Controller::HTTP_NOT_FOUND,FALSE,'Unknown Method'));
        }else{
            $action=call_user_func_array(array($this,$object_called),$arguments);
            $response=$action->run($arguments);
            $this->my_set_response($response);
        }
    }
    public function my_set_response($generated_response){
        $this->set_response($generated_response->payload,$generated_response->code);
    }
}