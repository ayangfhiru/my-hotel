<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Role extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'role_id' => [
                'type' => 'INT',
                'constarint' => 2,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'role_name' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ]
        ]);
        $this->dbforge->add_key('role_id', TRUE);
        $this->dbforge->create_table('roles');

        $query = "INSERT INTO roles(role_name) VALUES ('Admin'), ('Tamu')";
        $this->db->query($query);
    }

    public function down()
    {
        $this->dbforge->drop_table('roles');
    }
}
