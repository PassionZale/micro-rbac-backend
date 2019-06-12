<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Auth_User_Role_Table extends CI_Migration {

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
            'user_id' => array(
                'comment' => '用户 ID',
                'type' => 'INT',
                'constraint' => 11,
            ),
            'role_id' => array(
                'comment' => '角色 ID',
                'type' => 'INT',
                'constraint' => 11,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('auth_user_role');
    }

    public function down()
    {
        $this->dbforge->drop_table('auth_user_role');
    }

}
