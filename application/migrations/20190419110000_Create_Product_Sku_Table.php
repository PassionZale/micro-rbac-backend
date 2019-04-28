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
            // 冗余 propert_id
            // 也可以通过 property_value_id 查到 property_id
            'property_id' => array(
                'comment' => '规格 ID',
                'type' => 'INT',
                'constraint' => 11,
            ),
            'property_value_id' => array(
                'comment' => '属性 ID',
                'type' => 'INT',
                'constraint' => 11,
            ),
            'stock' => array(
                'comment' => '库存',
                'type' => 'INT',
                'constraint' => 11,
            )
        ));
        $this->dbforge->add_field("price DECIMAL(12,2) NOT NULL DEFAULT '0.00' COMMENT '价格'");
        $this->dbforge->add_field("created_at TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间'");
        $this->dbforge->add_field("updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('product_sku');
    }

    public function down() {
        $this->dbforge->drop_table('product_sku');
    }

}
