<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Auth_Role_Permission_Table extends CI_Migration {

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
            'role_id' => array(
                'comment' => '角色 ID',
                'type' => 'INT',
                'constraint' => 11,
            ),
            'permission_id' => array(
                'comment' => '权限 ID',
                'type' => 'INT',
                'constraint' => 11,
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('auth_role_permission');
    }

    public function down()
    {
        $this->dbforge->drop_table('auth_role_permission');
    }

}
