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

require_once( BASEPATH .'database/DB'. EXT );
$route['default_controller'] = "home";
$route['404_override'] = '';
global $CFG;
$lang_ignore  = $CFG->item('lang_ignore');
$db =& DB();
$query = $db->select('url_name')->get( 'utt_site' );
$result = $query->result();
foreach( $result as $row )
{
    $route['(\w{2}/)?' . $row->url_name] = $route['default_controller'];
    $route['(\w{2}/)?' . $row->url_name . '([/a-zA-Z0-9-_]+)-n([0-9]+).html'] = "post_detail/view_listpost/$3";
    $route['(\w{2}/)?' . $row->url_name . '/sitemap.html'] = "site_map";
    $route['(\w{2}/)?' . $row->url_name . '/gallery.html'] = "gallery_home";
    $route['(\w{2}/)?' . $row->url_name . '/list_teacher.html'] = "list_teacher";
    $route['(\w{2}/)?' . $row->url_name . '([/a-zA-Z0-9-_]+)-a([0-9]+).html'] = "post_detail/view/$3";
    $route['(\w{2}/)?' . $row->url_name] = $route['default_controller'];
    $route['(\w{2}/)?' . $row->url_name . '([/a-zA-Z0-9-_]+)-n([0-9]+).html'] = "post_detail/view_listpost/$3";
    $route['(\w{2}/)?' . $row->url_name . '([/a-zA-Z0-9-_]+)-a([0-9]+).html'] = "post_detail/view/$3";

    $route['^(\w{2}/)?' . $row->url_name . '/(:any)-n([0-9]+).html$'] = "post_detail/view_listpost/$3";
    $route['^(\w{2}/)?' . $row->url_name . '/(:any)-a([0-9]+).html$'] = "post_detail/view/$3";
    $route['(\w{2}/)?' . $row->url_name . '/(:any)'] = "$2";
}

$route['(\w{2})?'] = $route['default_controller'];
$route['^(\w{2}/)?(:any)-n([0-9]+).html$'] = "post_detail/view_listpost/$3";
$route['^(\w{2}/)?(:any)-a([0-9]+).html$'] = "post_detail/view/$3";
$route['^(\w{2}/)?sitemap.html$'] = "site_map";
$route['^(\w{2}/)?gallery.html$'] = "gallery_home";
$route['^(\w{2}/)?list_teacher.html$'] = "list_teacher";
$route['(\w{2})?/(:any)'] = "$2";
    $route['admin/get-setting-content/([0-9]+)/?([0-9]+)?'] = 'admin/sitemanager/ajaxGetTemplateSetting/$1/$2';
$route['admin/checklog/?(:any)?'] = 'admin/home/checklog/$s1';
/* Location: ./application/config/routes.php */