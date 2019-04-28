<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Category_Property_Table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'comment' => '主键',
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'category_id' => array(
                'comment' => '分类 ID',
                'type' => 'INT',
                'constraint' => 11,
            ),
            'property_id' => array(
                'comment' => '属性 ID',
                'type' => 'INT',
                'constraint' => 11,
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('category_property');
    }

    public function down() {
        $this->dbforge->drop_table('category_property');
    }

}
