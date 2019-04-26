<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Brand_Table extends CI_Migration {

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
                'comment' => '品牌名称',
                'type' => 'VARCHAR',
                'constraint' => 255,
            )
        ));
        $this->dbforge->add_field("created_at TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间'");
        $this->dbforge->add_field("updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('brand');
    }

    public function down() {
        $this->dbforge->drop_table('brand');
    }

}
