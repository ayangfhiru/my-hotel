<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Hotel extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'hotel_id' => [
                'type' => 'BIGINT',
                'constraint' => 21,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 225,
            ],
            'city' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'telepon' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ]
        ]);
        $this->dbforge->add_key('hotel_id', TRUE);
        $this->dbforge->create_table('hotels');
    }

    public function down()
    {
        $this->dbforge->drop_table('hotels');
    }
}
