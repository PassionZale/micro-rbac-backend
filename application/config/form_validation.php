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
        )
    ),
    'role' => array(
        array(
            'field' => 'name',
            'label' => '角色名称',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '请填写%s',
            )
        ),
        array(
            'field' => 'code',
            'label' => '角色编码',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '请填写%s',
            )
        )
    ),
    'user_create' => array(
        array(
            'field' => 'username',
            'label' => '用户名',
            'rules' => 'trim|required|is_unique[auth_user.username]|regex_match[/^[a-zA-Z][a-zA-Z0-9_]{4,15}$/]',
            'errors' => array(
                'required' => '请填写%s',
                'is_unique' => '%s已被占用',
                'regex_match' => '%s必须以字母开头，长度在5~16之间，只能包含字母、数字和下划线',
            )
        ),
        array(
            'field' => 'password',
            'label' => '密码',
            'rules' => 'trim|required|regex_match[/^[a-zA-Z]\w{5,17}$/]',
            'errors' => array(
                'required' => '请填写%s',
                'regex_match' => '%s必须以字母开头，长度在6~18之间，只能包含字母、数字和下划线',
            )
        ),
        array(
            'field' => 'passwordConfirm',
            'label' => '确认密码',
            'rules' => 'trim|required|matches[password]',
            'errors' => array(
                'required' => '请再次填写密码',
                'matches' => '两次填写的密码不相同'
            )
        )
    ),
    'user_update' => array(
        array(
            'field' => 'username',
            'label' => '用户名',
            'rules' => 'trim|required|regex_match[/^[a-zA-Z][a-zA-Z0-9_]{4,15}$/]',
            'errors' => array(
                'required' => '请填写%s',
                'regex_match' => '%s必须以字母开头，长度在5~16之间，只能包含字母、数字和下划线',
            )
        )
    ),
    'user_password_update' => array(
        array(
            'field' => 'password',
            'label' => '密码',
            'rules' => 'trim|required|regex_match[/^[a-zA-Z]\w{5,17}$/]',
            'errors' => array(
                'required' => '请填写%s',
                'regex_match' => '%s必须以字母开头，长度在6~18之间，只能包含字母、数字和下划线',
            )
        ),
        array(
            'field' => 'passwordConfirm',
            'label' => '确认密码',
            'rules' => 'trim|required|matches[password]',
            'errors' => array(
                'required' => '请再次填写密码',
                'matches' => '两次填写的密码不相同'
            )
        )
    ),
    'brand' => array(
        array(
            'field' => 'name',
            'label' => '品牌名称',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '请填写%s',
            )
        ),
        $sort
    ),
    'property' => array(
        array(
            'field' => 'name',
            'label' => '属性组名称',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '请填写%s',
            )
        ),
    ),
    'property_value' => array(
        array(
            'field' => 'name',
            'label' => '属性名称',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '请填写%s',
            )
        ),
        array(
            'field' => 'property_id',
            'label' => '属性组',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '从属%s不能为空',
            )
        ),
    ),
    'category' => array(
        array(
            'field' => 'name',
            'label' => '分类名称',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '请填写%s',
            )
        ),
        array(
            'field' => 'pid',
            'label' => '父分类',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '请指定%s',
            ),
        ),
    ),
    'product' => array(
        array(
            'field' => 'name',
            'label' => '商品名称',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '请填写%s',
            )
        ),
        array(
            'field' => 'brand_id',
            'label' => '商品品牌',
            'rules' => 'trim|required|is_natural',
            'errors' => array(
                'required' => '请选择%s'
            )
        ),
        array(
            'field' => 'category_id',
            'label' => '商品分类',
            'rules' => 'trim|required|is_natural',
            'errors' => array(
                'required' => '请选择%s'
            )
        ),
    )
];
