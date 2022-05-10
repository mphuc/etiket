<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*require_once( BASEPATH . 'database/DB' . EXT );
$db = & DB();
$themes = $db->where('setting_type','front-theme')->where('setting_value','active')->get("tb_setting",1)->row('setting_name');*/
//$themes = 'theme-corlate';
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|
		my-controller/my-method	-> my_controller/my_method

$default_controller = "front";
$controller_exceptions = array('cms','sitemap','themes');
$route['default_controller'] = $default_controller;
$route["^((?!\b".implode('\b|\b', $controller_exceptions)."\b).*)$"] = $default_controller.'/$1';
$route['404_override'] = '';
$route['sitemap\.xml'] = "sitemap";
$route['cms/(:any)'] = "$1";
$route['translate_uri_dashes'] = FALSE;
*/
$default_controller 										= "frontend/home";
$controller_exceptions 										= array( 'db','rest','api','json','cms','img','themes','assets');
$route['default_controller'] 								= $default_controller;
$route["^((?!\b".implode('\b|\b', $controller_exceptions)."\b).*)$"] = $default_controller.'/$1';
$route["^((?!\b".implode('\b|\b', $controller_exceptions)."\b).*)$/(:any)"] = $default_controller.'/$1/$2';

$route['sitemap\.xml'] 										= "sitemap";
$route['cms/(:any)'] 										= "$1";
$route['translate_uri_dashes'] 								= FALSE;
$panel														='cms_';
$route['cms/(:any)'] 										= $panel."$1";
$route['cms/(:any)/(:any)'] 								= $panel."$1/$2";
$route['cms/(:any)/(:any)/(:any)'] 							= $panel."$1/$2";
$route['cms/(:any)/(:any)/(:any)/(:any)'] 					= $panel."$1/$2";
$route['cms/(:any)/(:any)/(:any)/(:any)/(:any)'] 			= $panel."$1/$2";
$route['cms/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= $panel."$1/$2";

$route['translate_uri_dashes'] 								= FALSE;
$route['404_override'] 										= 'cms_404';