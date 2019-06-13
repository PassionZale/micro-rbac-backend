<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'make';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Auth
$route['auth/login']['POST'] = 'auth/login_post';
$route['auth/user']['GET'] = 'auth/user_get';

// Permission
$route['permission']['POST'] = 'permission/index_post';
$route['permissions']['GET'] = 'permission/index_get';
$route['permissions/(:num)']['GET'] = 'permission/index_get/$1';
$route['permissions/(:num)']['DELETE'] = 'permission/index_delete/$1';
$route['permissions/(:num)']['PUT'] = 'permission/index_put/$1';

// Role
$route['role']['POST'] = 'role/index_post';
$route['roles']['GET'] = 'role/index_get';
$route['roles/(:num)']['GET'] = 'role/index_get/$1';
$route['roles/(:num)']['DELETE'] = 'role/index_delete/$1';
$route['roles/(:num)']['PUT'] = 'role/index_put/$1';

// User
$route['user']['POST'] = 'user/index_post';
$route['users']['GET'] = 'user/index_get';
$route['users/(:num)']['GET'] = 'user/index_get/$1';
$route['users/(:num)']['DELETE'] = 'user/index_delete/$1';
$route['users/(:num)']['PUT'] = 'user/index_put/$1';

// Brand
$route['brand']['POST'] = 'brand/index_post';
$route['brands']['GET'] = 'brand/index_get';
$route['brands/(:num)']['GET'] = 'brand/index_get/$1';
$route['brands/(:num)']['DELETE'] = 'brand/index_delete/$1';
$route['brands/(:num)']['PUT'] = 'brand/index_put/$1';

// Category
$route['category']['POST'] = 'category/index_post';
$route['categories']['GET'] = 'category/index_get';
$route['categories/(:num)']['GET'] = 'category/index_get/$1';
$route['categories/(:num)']['DELETE'] = 'category/index_delete/$1';
$route['categories/(:num)']['PUT'] = 'category/index_put/$1';