<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$hook['post_controller_constructor'][] = array(
    'class' => 'JWTHook',
    'function' => 'index',
    'filename' => 'JWTHook.php',
    'filepath' => 'hooks',
    'params' => []
);

//$hook['post_controller_constructor'][] = array(
//    'class' => 'PermissionHook',
//    'function' => 'index',
//    'filename' => 'PermissionHook.php',
//    'filepath' => 'hooks',
//    'params' => []
//);
