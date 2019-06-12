<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Init_Permission_Table extends CI_Migration {

    public function up() {
        $data = array(
            // Permission
            array('name' => '创建权限', 'code' => 'can create permission', 'route' => 'post.permission', 'created_at' => time()),
            array('name' => '编辑权限', 'code' => 'can update permission', 'route' => 'update.permission', 'created_at' => time()),
            array('name' => '删除权限', 'code' => 'can delete permission', 'route' => 'delete.permission', 'created_at' => time()),
            array('name' => '查询权限', 'code' => 'can select permission', 'route' => 'get.permission', 'created_at' => time()),
            // Role
            array('name' => '创建角色', 'code' => 'can create role', 'route' => 'post.role', 'created_at' => time()),
            array('name' => '编辑角色', 'code' => 'can update role', 'route' => 'update.role', 'created_at' => time()),
            array('name' => '删除角色', 'code' => 'can delete role', 'route' => 'delete.role', 'created_at' => time()),
            array('name' => '查询角色', 'code' => 'can select role', 'route' => 'get.role', 'created_at' => time()),
            // User
            array('name' => '创建用户', 'code' => 'can create user', 'route' => 'post.user', 'created_at' => time()),
            array('name' => '编辑用户', 'code' => 'can update user', 'route' => 'update.user', 'created_at' => time()),
            array('name' => '删除用户', 'code' => 'can delete user', 'route' => 'delete.user', 'created_at' => time()),
            array('name' => '查询用户', 'code' => 'can select user', 'route' => 'get.user', 'created_at' => time()),
        );
        $this->db->insert_batch('auth_permission', $data);
    }

    public function down() {
        $this->db->truncate('auth_permission');
    }

}
