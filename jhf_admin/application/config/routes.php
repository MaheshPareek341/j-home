<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']                = 'dashboard';
$route['404_override']                      = 'page_404';
$route['jhf_admin']                          = 'admin/dashboard/index';
$route['register']                          = 'home/register';
$route['become-an-ambassador']              = 'home/ambassador';
$route['movies']                            = 'home/movies';
$route['movie/(:any)']                      = 'home/details/$1';


$route['admin/dashboard']                   = 'dashboard';
$route['admin/login']                       = 'admin/login';


$route['category']                              = 'category/index';
$route['category/add']                         = 'category/add_category';
$route['category/save']                        = 'category/save_category';
$route['category/edit/(:num)']                 = 'category/edit_category/$1';
$route['category/update/(:num)']               = 'category/update_category/$1';
$route['category/delete/(:num)']               = 'category/delete_category/$1';





$route['sub_category']                              = 'sub_category/index';
$route['sub_category/add']                         = 'sub_category/add_sub_category';
$route['sub_category/save']                        = 'sub_category/save_sub_category';
$route['sub_category/edit/(:num)']                 = 'sub_category/edit_sub_category/$1';
$route['sub_category/update/(:num)']               = 'sub_category/update_sub_category/$1';
$route['sub_category/delete/(:num)']               = 'sub_category/delete_sub_category/$1';



$route['catalogs']                              = 'catalogs/index';
$route['catalogs/add']                         = 'catalogs/add_catalogs';
$route['catalogs/save']                        = 'catalogs/save_catalogs';
$route['catalogs/edit/(:num)']                 = 'catalogs/edit_catalogs/$1';
$route['catalogs/update/(:num)']               = 'catalogs/update_catalogs/$1';
$route['catalogs/delete/(:num)']               = 'catalogs/delete_catalogs/$1';



$route['products']                              = 'products/index';
$route['products/add']                         = 'products/add_products';
$route['products/save']                        = 'products/save_products';
$route['products/edit/(:num)']                 = 'products/edit_products/$1';
$route['products/update/(:num)']               = 'products/update_products/$1';
$route['products/delete/(:num)']               = 'products/delete_products/$1';






$route['admin/users']                             = 'admin/getAllUsers';
$route['admin/users/edit/(:num)']                 = 'admin/edit_user/$1';
$route['admin/users/update/(:num)']               = 'admin/update_user/$1';
$route['admin/users/delete/(:num)']               = 'admin/delete_user/$1';

$route['translate_uri_dashes'] = FALSE;