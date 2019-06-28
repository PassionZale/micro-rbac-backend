<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Product_Sku_Property_Table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'comment' => '主键',
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'product_sku_id' => array(
                'comment' => '商品 SKU ID',
                'type' => 'INT',
                'constraint' => 11,
            ),
            'property_id' => array(
                'comment' => '属性 ID',
                'type' => 'INT',
                'constraint' => 11,
            ),
            'property_value_id' => array(
                'comment' => '规格 ID',
                'type' => 'INT',
                'constraint' => 11,
            ),
            // 冗余 propert & property_value "name" 字段
            // 以下两个字段将被用于 "编辑商品" 时, 前端视图 SKU TABLE 的回显
            // 在编辑属性或规格名称时, 需要同步更新这两个字段, 以便保证的数据的唯一性
            'property_name' => array(
                'comment' => '属性名称',
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'property_value_name' => array(
                'comment' => '规格名称',
                'type' => 'VARCHAR',
                'constraint' => 255,
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('product_sku_property');
    }

    public function down() {
        $this->dbforge->drop_table('product_sku_property');
    }

}
