<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_User extends CI_Migration
{
    function up()
    {
        $this->dbforge->add_field([
            'user_id' => [
                'type' => 'INT',
                'constraint' => 12,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'role' => [
                'type' => 'ENUM("admin", "tamu")',
                'default' => "tamu"
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => TRUE,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'unique' => TRUE,
            ],
            'phone_number' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'unique' => TRUE
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 225,
            ]
        ]);
        $this->dbforge->add_key('user_id', TRUE);
        // $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (role_id) REFERENCES roles(role_id)');
        $this->dbforge->create_table('users');
    }

    function down()
    {
        $this->dbforge->drop_table('users');
    }
}
