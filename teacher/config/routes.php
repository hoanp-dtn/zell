<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';
$route['login'] = 'authentication/login';
$route['logout'] = 'authentication/logout';
$route['(:any)-gv(:num).html'] = 'home/view/$2';
$route['(:any)-gv(:num).page(:num).html'] = 'home/view/$2/$3';

$route['(:any)-gv(:num)/bao-cao-khoa-hoc.html'] = 'home/khoahoc/$2';
$route['(:any)-gv(:num)/bao-cao-khoa-hoc.page(:num).html'] = 'home/khoahoc/$2/$3';
$route['(:any)-gv(:num)/bao-cao-khoa-hoc/(:any)-a(:num).html'] = 'post/detail/$4/$2/998';
$route['(:any)-gv(:num)/tai-lieu-sinh-vien.html'] = 'home/tailieu/$2';
$route['(:any)-gv(:num)/tai-lieu-sinh-vien.page(:num).html'] = 'home/tailieu/$2/$3';
$route['(:any)-gv(:num)/tai-lieu-sinh-vien/(:any)-a(:num).html'] = 'post/detail/$4/$2/999';
$route['(:any)-gv(:num)/hoi-dap.html'] = 'question/index/$2';
$route['(:any)-gv(:num)/profile.html'] = 'profile/giangvien/$2';
$route['profile.html'] = 'profile';
$route['thay-doi-thong-tin.html'] = 'profile/edit';
// $route['giangvien/([0-9]+)'] = 'home/view/$1';

require_once( BASEPATH .'database/DB'. EXT );
$db =& DB();
$query = $db->select('name')->get( 'utt_site' );
$result = $query->result();
foreach( $result as $row )
{
    $route['^' . $row->name] = $route['default_controller'];
    $route['^' . $row->name . '/(:any)'] = "$1";
}

/* End of file routes.php */
/* Location: ./application/config/routes.php */