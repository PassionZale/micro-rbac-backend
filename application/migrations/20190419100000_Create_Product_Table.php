<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Product_Table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'comment' => '主键',
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'brand_id' => array(
                'comment' => '品牌 ID',
                'type' => 'INT',
                'constraint' => 11,
            ),
            'category_id' => array(
                'comment' => '分类 ID',
                'type' => 'INT',
                'constraint' => 11,
            ),
            'name' => array(
                'comment' => '商品名称',
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'sort' => array(
                'comment' => '排序',
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
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
        $this->dbforge->create_table('product');
    }

    public function down() {
        $this->dbforge->drop_table('product');
    }

}
