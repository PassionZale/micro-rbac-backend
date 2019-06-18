<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$sort = array(
    'field' => 'sort',
    'label' => '排序',
    'rules' => 'trim|required|is_natural',
    'errors' => array(
        'required' => '请填写%s',
        'is_natural' => '%s必须为大于等于0的整数',
    )
);

$config = [
    'permission' => array(
        array(
            'field' => 'name',
            'label' => '权限名称',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '请填写%s',
            )
        ),
        array(
            'field' => 'code',
            'label' => '权限编码',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '请填写%s',
            )
        ),
        array(
            'field' => 'route',
            'label' => '权限路由',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '请填写%s',
            )
        ),
    ),
];
