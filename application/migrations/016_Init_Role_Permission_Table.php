<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Init_Role_Permission_Table extends CI_Migration {

    public function up() {
        $data = array(
            // 权限组
            ['role_id' => 1, 'permission_id' => 1],
            ['role_id' => 1, 'permission_id' => 2],
            ['role_id' => 1, 'permission_id' => 3],
            ['role_id' => 1, 'permission_id' => 4],
            // 角色组
            ['role_id' => 2, 'permission_id' => 5],
            ['role_id' => 2, 'permission_id' => 6],
            ['role_id' => 2, 'permission_id' => 7],
            ['role_id' => 2, 'permission_id' => 8],
            // 用户组
            ['role_id' => 3, 'permission_id' => 9],
            ['role_id' => 3, 'permission_id' => 10],
            ['role_id' => 3, 'permission_id' => 11],
            ['role_id' => 3, 'permission_id' => 12],
            // 品牌组
            ['role_id' => 4, 'permission_id' => 13],
            ['role_id' => 4, 'permission_id' => 14],
            ['role_id' => 4, 'permission_id' => 15],
            ['role_id' => 4, 'permission_id' => 16],
            // 属性组
            ['role_id' => 5, 'permission_id' => 17],
            ['role_id' => 5, 'permission_id' => 18],
            ['role_id' => 5, 'permission_id' => 19],
            ['role_id' => 5, 'permission_id' => 20],
            // 分类组
            ['role_id' => 6, 'permission_id' => 21],
            ['role_id' => 6, 'permission_id' => 22],
            ['role_id' => 6, 'permission_id' => 23],
            ['role_id' => 6, 'permission_id' => 24],
            // 商品组
            ['role_id' => 7, 'permission_id' => 25],
            ['role_id' => 7, 'permission_id' => 26],
            ['role_id' => 7, 'permission_id' => 27],
            ['role_id' => 7, 'permission_id' => 28],
        );

        $this->db->insert_batch('auth_role_permission', $data);
    }

    public function down() {
        $this->db->truncate('auth_role_permission');
    }

}
