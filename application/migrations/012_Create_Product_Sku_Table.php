<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Product_Sku_Table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'comment' => '主键',
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'product_id' => array(
                'comment' => '商品 ID',
                'type' => 'INT',
                'constraint' => 11,
            ),
            'stock' => array(
                'comment' => '库存',
                'type' => 'INT',
                'constraint' => 11,
            ),
            'price' => array(
                'comment' => '价格',
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'default' => 0.00
            )
        ));
//        $this->dbforge->add_field("price DECIMAL(12,2) NOT NULL DEFAULT '0.00' COMMENT '价格'");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('product_sku');
    }

    public function down() {
        $this->dbforge->drop_table('product_sku');
    }

}
