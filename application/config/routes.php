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
$route['permissions/format/(:any)']['GET'] = 'permission/format_get/$1';
$route['permissions/(:num)']['GET'] = 'permission/index_get/$1';
$route['permissions/(:num)']['DELETE'] = 'permission/index_delete/$1';
$route['permissions/(:num)']['PUT'] = 'permission/index_put/$1';

// Role
$route['role']['POST'] = 'role/index_post';
$route['roles']['GET'] = 'role/index_get';
$route['roles/format/(:any)']['GET'] = 'role/format_get/$1';
$route['roles/(:num)']['GET'] = 'role/index_get/$1';
$route['roles/(:num)']['DELETE'] = 'role/index_delete/$1';
$route['roles/(:num)']['PUT'] = 'role/index_put/$1';

// User
$route['user']['POST'] = 'user/index_post';
$route['users']['GET'] = 'user/index_get';
$route['users/(:num)']['GET'] = 'user/index_get/$1';
$route['users/(:num)']['DELETE'] = 'user/index_delete/$1';
$route['users/(:num)/password']['PUT'] = 'user/password_put/$1';
$route['users/(:num)']['PUT'] = 'user/index_put/$1';

// Brand
$route['brand']['POST'] = 'brand/index_post';
$route['brands']['GET'] = 'brand/index_get';
$route['brands/format/(:any)']['GET'] = 'brand/format_get/$1';
$route['brands/(:num)']['GET'] = 'brand/index_get/$1';
$route['brands/(:num)']['DELETE'] = 'brand/index_delete/$1';
$route['brands/(:num)']['PUT'] = 'brand/index_put/$1';

// Property
$route['property']['POST'] = 'property/index_post';
$route['properties']['GET'] = 'property/index_get';
$route['properties/format/(:any)']['GET'] = 'property/format_get/$1';
$route['properties/(:num)']['GET'] = 'property/index_get/$1';
$route['properties/(:num)']['DELETE'] = 'property/index_delete/$1';
$route['properties/(:num)']['PUT'] = 'property/index_put/$1';

// Property Value
$route['property/value']['POST'] = 'propertyValue/index_post';
$route['property/values']['GET'] = 'propertyValue/index_get';
$route['property/values/(:num)']['GET'] = 'propertyValue/index_get/$1';
$route['property/values/(:num)']['DELETE'] = 'propertyValue/index_delete/$1';
$route['property/values/(:num)']['PUT'] = 'propertyValue/index_put/$1';

// Category
$route['category']['POST'] = 'category/index_post';
$route['categories']['GET'] = 'category/index_get';
$route['categories/format/(:any)']['GET'] = 'category/format_get/$1';
$route['categories/(:num)/properties']['GET'] = 'category/property_get/$1';
$route['categories/(:num)']['GET'] = 'category/index_get/$1';
$route['categories/(:num)']['DELETE'] = 'category/index_delete/$1';
$route['categories/(:num)']['PUT'] = 'category/index_put/$1';

// Product
$route['product']['POST'] = 'product/index_post';
$route['products']['GET'] = 'product/index_get';
$route['products/(:num)']['GET'] = 'product/index_get/$1';
$route['products/(:num)']['DELETE'] = 'product/index_delete/$1';
$route['products/(:num)']['PUT'] = 'product/index_put/$1';