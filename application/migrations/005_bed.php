<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Bed extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'bed_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'bed' => [
                'type' => 'VARCHAR',
                'constraint' => 21
            ],
        ]);
        $this->dbforge->add_key('bed_id', TRUE); // Primay Key
        $this->dbforge->create_table('beds');
    }

    public function down()
    {
        $this->dbforge->drop_table('beds');
    }
}
