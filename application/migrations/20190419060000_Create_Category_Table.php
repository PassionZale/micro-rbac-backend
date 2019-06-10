<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Category_Table extends CI_Migration {

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
                'comment' => '分类名称',
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'pid' => array(
                'comment' => '父分类 ID',
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ),
            'sort' => array(
                'comment' => '排序',
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ),
            'created_at' => array(
                'comment' => '创建时间',
                'type' => 'BIGINT',
                'constraint' => '20',
            ),
            'updated_at' => array(
                'comment' => '更新时间',
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('category');
    }

    public function down() {
        $this->dbforge->drop_table('category');
    }

}
