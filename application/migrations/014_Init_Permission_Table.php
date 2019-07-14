<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Init_Permission_Table extends CI_Migration {

    public function up() {
        $data = array(
            // Permission
            array('name' => '创建权限', 'code' => 'can create permission', 'route' => 'post.permission', 'created_at' => time()),
            array('name' => '编辑权限', 'code' => 'can update permission', 'route' => 'put.permission', 'created_at' => time()),
            array('name' => '删除权限', 'code' => 'can delete permission', 'route' => 'delete.permission', 'created_at' => time()),
            array('name' => '查询权限', 'code' => 'can select permission', 'route' => 'get.permission', 'created_at' => time()),
            // Role
            array('name' => '创建角色', 'code' => 'can create role', 'route' => 'post.role', 'created_at' => time()),
            array('name' => '编辑角色', 'code' => 'can update role', 'route' => 'put.role', 'created_at' => time()),
            array('name' => '删除角色', 'code' => 'can delete role', 'route' => 'delete.role', 'created_at' => time()),
            array('name' => '查询角色', 'code' => 'can select role', 'route' => 'get.role', 'created_at' => time()),
            // User
            array('name' => '创建用户', 'code' => 'can create user', 'route' => 'post.user', 'created_at' => time()),
            array('name' => '编辑用户', 'code' => 'can update user', 'route' => 'put.user', 'created_at' => time()),
            array('name' => '删除用户', 'code' => 'can delete user', 'route' => 'delete.user', 'created_at' => time()),
            array('name' => '查询用户', 'code' => 'can select user', 'route' => 'get.user', 'created_at' => time()),
            // Brand
            array('name' => '创建品牌', 'code' => 'can create brand', 'route' => 'post.brand', 'created_at' => time()),
            array('name' => '编辑品牌', 'code' => 'can update brand', 'route' => 'put.brand', 'created_at' => time()),
            array('name' => '删除品牌', 'code' => 'can delete brand', 'route' => 'delete.brand', 'created_at' => time()),
            array('name' => '查询品牌', 'code' => 'can select brand', 'route' => 'get.brand', 'created_at' => time()),
            // Property
            array('name' => '创建属性', 'code' => 'can create property', 'route' => 'post.property', 'created_at' => time()),
            array('name' => '编辑属性', 'code' => 'can update property', 'route' => 'put.property', 'created_at' => time()),
            array('name' => '删除属性', 'code' => 'can delete property', 'route' => 'delete.property', 'created_at' => time()),
            array('name' => '查询属性', 'code' => 'can select property', 'route' => 'get.property', 'created_at' => time()),
            // Category
            array('name' => '创建分类', 'code' => 'can create category', 'route' => 'post.category', 'created_at' => time()),
            array('name' => '编辑分类', 'code' => 'can update category', 'route' => 'put.category', 'created_at' => time()),
            array('name' => '删除分类', 'code' => 'can delete category', 'route' => 'delete.category', 'created_at' => time()),
            array('name' => '查询分类', 'code' => 'can select category', 'route' => 'get.category', 'created_at' => time()),
            // Product
            array('name' => '创建商品', 'code' => 'can create product', 'route' => 'post.product', 'created_at' => time()),
            array('name' => '编辑商品', 'code' => 'can update product', 'route' => 'put.product', 'created_at' => time()),
            array('name' => '删除商品', 'code' => 'can delete product', 'route' => 'delete.product', 'created_at' => time()),
            array('name' => '查询商品', 'code' => 'can select product', 'route' => 'get.product', 'created_at' => time()),
        );

        $this->db->insert_batch('auth_permission', $data);
    }

    public function down() {
        $this->db->truncate('auth_permission');
    }

}
