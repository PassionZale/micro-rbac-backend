<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Auth_Permission_Table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'comment' => '主键',
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'name' => array(
                'comment' => '权限名称',
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'code' => array(
                'comment' => '权限编码',
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'route' => array(
                'comment' => '路由',
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'created_at' => array(
                'comment' => '创建时间',
                'type' => 'TIMESTAMP',
                'null' => TRUE
            ),
            'updated_at' => array(
                'comment' => '更新时间',
                'type' => 'TIMESTAMP',
                'null' => TRUE
            )            
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('auth_permission');
    }

    public function down() {
        $this->dbforge->drop_table('auth_permission');
    }

}
