<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Room extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'room_id' => [
                'type' => 'BIGINT',
                'constraint' => 21,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'hotel_id' => [
                'type' => 'BIGINT',
                'constranit' => 21,
                'unsigned' =>  TRUE
            ],
            'room_type' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'bed_id' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'capacity' => [
                'type' => 'INT',
                'constraint' => 2,
                'unsigned' => TRUE,
            ],
            'price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ]
        ]);
        $this->dbforge->add_key('room_id', TRUE); // Primay Key
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (hotel_id) REFERENCES hotels(hotel_id) ON DELETE CASCADE');
        $this->dbforge->create_table('rooms');
    }

    public function down()
    {
        $this->dbforge->drop_table('rooms');
    }
}
