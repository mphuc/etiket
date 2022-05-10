<?php

if(!function_exists('my_number')){
    function my_number($number){
        if( $number > 0 ) return number_format( $number );
        return '-';
    }
}

function my_tes($data=array())
{
    echo "<pre>";
    print_r($data);
    exit();
}

function getDays(){
    return array(
        'sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday'
    );
}

if(! function_exists('link_upload')){
    function link_upload($link) {
        return base_url('assets/uploads/'.$link);
    }
}

function list_modules()
{
    $path = FCPATH. 'application/modules/';
    $directories = glob( $path.'*' , GLOB_ONLYDIR);
    foreach ($directories as $k => $directory) {
        $directories[$k] = str_replace($path, '', $directory);
    }
    $news = array_values(array_diff($directories, ['img', 'front', 'buddies', 'cms_404', 'cms_auth', 'cms_role', 'cms_search', 'cms_temp', 'api', 'cron']));
    foreach ($news as $k => $new) {
        $news[$k] = str_replace('cms_','', $new);
    }
    return $news;
}
/**
 * Created by PhpStorm.
 * User: PC77-GITS
 * Date: 03/08/2016
 * Time: 16.37
 */
if(!function_exists('format_title')){
    /**
     * Convert to uppercase first string and remove some Underscores with space
     * @param $title
     * @return string
     */
    function format_title($title){
        return ucwords( (str_replace('_',' ', $title)));
    }
}

if(!function_exists('assets_front')){
    /**
     * Get asset frontend
     *
     * @return string
     */
    function assets_front(){
        return base_url('themes/umbrella-front/default').'/';
    }
}

if(!function_exists('assets_back')){
    /**
     * Get asset for backend
     *
     * @return string
     */
    function assets_back(){
        return base_url('themes/umbrella-back/2ndmaterial').'/';
    }
}

if (! function_exists('view_back')) {

    /**
     * Get blade view
     *
     * @param $view
     * @param array $data
     * @param boolean $return
     * @return mixed
     */
    function view_back($view, $data = [], $return=false)
    {
        $blade = new \Jenssegers\Blade\Blade( array(FCPATH.'application/modules/'), FCPATH.'application/cache');
        if( $return==false ){
            echo $blade->render($view, $data);
            exit();
        }else{
            return $blade->render($view, $data);
        }
    }
}

if (! function_exists('view_front')) {

    /**
     * Get blade view
     *
     * @param $view
     * @param array $data
     * @param boolean $return
     * @return mixed
     */
    function view_front($view, $data = [], $return=false)
    {
        $blade = new \Jenssegers\Blade\Blade( array(FCPATH.'themes/umbrella-front/default'), FCPATH.'application/cache');
        if( $return==false ){
            echo $blade->render($view, $data);
            exit();
        }else{
            return $blade->render($view, $data);
        }
    }
}

if(!function_exists('my_format')){
    function my_format($number){
        if( $number > 0 ) return number_format( $number,0,',','.' );
        return '-';
    }
}

if(!function_exists('my_json')){
    function my_json($data=[]){
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}

if (! function_exists('json_response')) {

    /**
     * Create json response
     *
     * @param $data
     * @param $code int
     * @return string
     */
    function json_response($data, $code = 200) {
        set_status_header($code);
        header("Content-Type: application/json");
        echo json_encode($data);
        exit();
    }
}

if (! function_exists('json_toarray')) {

    /**
     * Convert Json object (StdClass) to array
     *
     * @param $data
     * @return mixed
     */
    function object_to_array($data) {
        return json_decode(json_encode($data), true);
    }
}

if (! function_exists('encryption')) {

    /**
     * Get Encryption object
     *
     * @param array $driver
     * @return mixed
     */
    function encryption($driver = ['driver' => 'openssl'])
    {
        $instance = get_instance();

        $instance->load->library('encryption');

        $instance->encryption->initialize($driver);

        $encryption = $instance->encryption;

        unset($instance->encryption);

        return $encryption;
    }
}

if (! function_exists('encrypt')) {

    /**
     * Encrypting
     *
     * @param $plaintext
     * @return mixed
     */
    function encrypt($plaintext) {
        return encryption()->encrypt($plaintext);
    }
}

if (! function_exists('decrypt')) {

    /**
     * Decrypting
     *
     * @param $plaintext
     * @return mixed
     */
    function decrypt($plaintext) {
        return encryption()->decrypt($plaintext);
    }
}

if (! function_exists('session')) {

    /**
     * Get session object
     *
     * @return CI_Session
     */
    function session()
    {
        return get_instance()->session;
    }
}

if (! function_exists('flash')) {

    /**
     * Flashing data
     *
     * @param $key
     * @param null $value
     * @return \Illuminate\Support\Collection|mixed|static
     */
    function flash($key = null, $value = null)
    {
        if (is_null($value) && ! is_array($key)) {
            $session = session();

            $flash_key = $session->flashdata_key .':old:';

            if (! ($key == 'success' || $key == 'errors')) {
                $flash_key .= 'data';
            } else {
                $flash_key .= $key;

                $key = null;
            }

            $data = collect($session->userdata)->first(function ($key, $value) use ($flash_key) {
                return str_contains($key, $flash_key);
            });

            $data = collect($data);

            if ($key === null) {
                return $data;
            }

            return $data->get($key);
        }

        if (! ($key == 'success' || $key == 'errors')) {
            if (is_null($value)) {
                $value = (array) $key;
            } else {
                $value = [$key => $value];
            }

            $key = 'data';
        }

        session()->set_flashdata($key, $value);
    }
}

if (! function_exists('errors')) {

    /**
     * Flashing error data
     *
     * @param null $key
     * @param null $value
     * @return array|\Illuminate\Support\Collection|mixed
     */
    function errors($key = null, $value = null) {
        $errors = collect(flash('errors'));

        if (is_null($value) && ! is_array($key)) {
            if (is_null($key)) {
                return $errors;
            }

            return $errors->get($key);
        }

        $errors = array_merge($errors->all(), is_null($value) ? (array) $key : [$key => $value]);

        flash('errors', $errors);
    }
}

if (! function_exists('success')) {

    /**
     * Flashing success data
     *
     * @param null $key
     * @param null $value
     * @return array|\Illuminate\Support\Collection|mixed
     */
    function success($key = null, $value = null) {
        $success = collect(flash('success'));

        if (is_null($value) && ! is_array($key)) {
            if (is_null($key)) {
                return $success;
            }

            return $success->get($key);
        }

        $success = array_merge($success->all(), is_null($value) ? (array) $key : [$key => $value]);

        flash('success', $success);
    }
}

if (! function_exists('captcha_response')) {

    /**
     * Get captcha response
     *
     * @param $g_recaptcha_response
     * @return mixed
     */
    function captcha_response($g_recaptcha_response) {
        get_instance()->load->config('recaptcha');

        $secret = get_instance()->config->item('private_key');

        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$g_recaptcha_response}&remoteip={$_SERVER['REMOTE_ADDR']}");

        return json_decode($response);
    }
}
