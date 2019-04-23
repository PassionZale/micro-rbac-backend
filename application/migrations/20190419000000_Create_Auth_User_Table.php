<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Auth_User_Table extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'comment' => '主键',
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'username' => array(
                'comment' => '用户名',
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'password' => array(
                'comment' => '密码',
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'is_superuser' => array(
                'comment' => '是否为超级用户 ? 0: 非超级用户; 1: 超级用户',
                'type' => 'TINYINT',
                'constraint' => '1',
                'default' => 0,
            ),
            'is_active' => array(
                'comment' => '是否禁用账号 ? 0: 禁用; 1: 启用',
                'type' => 'TINYINT',
                'constraint' => '1',
                'default' => 1,
            ),
            'created_at' => array(
                'comment' => '创建时间',
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'updated_at' => array(
                'comment' => '编辑时间',
                'type' => 'DATETIME',
                'null' => TRUE
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('auth_user');
    }

    public function down()
    {
        $this->dbforge->drop_table('auth_user');
    }

}
