<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Init_Role_Table extends CI_Migration {

    public function up() {
        $data = array(
            array('name' => '权限组', 'code' => 'permission group', 'created_at' => time()),
            array('name' => '角色组', 'code' => 'role group', 'created_at' => time()),
            array('name' => '用户组', 'code' => 'user group', 'created_at' => time()),
            array('name' => '品牌组', 'code' => 'brand group', 'created_at' => time()),
            array('name' => '属性组', 'code' => 'property group', 'created_at' => time()),
            array('name' => '分类组', 'code' => 'category group', 'created_at' => time()),
            array('name' => '商品组', 'code' => 'product group', 'created_at' => time()),
        );

        $this->db->insert_batch('auth_role', $data);
    }

    public function down() {
        $this->db->truncate('auth_role');
    }

}
