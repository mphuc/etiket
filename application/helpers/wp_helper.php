<?php

function wp_head()
{
    return do_action('wp_head');
}

function wp_footer()
{
    return do_action('wp_footer');
}

function get_template_directory($realpath=false)
{
    $CI =& get_instance();
    $theme = $CI->db->where('setting_type','front-theme')->where('setting_value','active')->get("tb_setting",1)->row('setting_name');
    if( $realpath ){
        return FCPATH.'themes/umbrella-front/'.$theme;
    }
    return base_url( 'themes/umbrella-front/'.$theme );
}

function wp_function()
{
    $file = get_template_directory(true).'/function.php';
    if( file_exists($file) ) include_once $file;
}

function get_list_templates()
{
    $path = FCPATH. 'themes/umbrella-front/';
    $directories = glob( $path.'*' , GLOB_ONLYDIR);
    foreach ($directories as $k => $directory) {
        $directories[$k] = str_replace($path, '', $directory);
    }
    return $directories;
}

function get_list_plugins()
{
    $path = FCPATH. 'plugins/';
    $directories = glob( $path.'*' , GLOB_ONLYDIR);
    foreach ($directories as $k => $directory) {
        $directories[$k] = str_replace($path, '', $directory);
    }
    return $directories;
}