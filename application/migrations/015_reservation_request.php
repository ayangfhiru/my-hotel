<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Reservation_Request extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'reservation_id' => [
                'type' => 'BIGINT',
                'constraint' => 21,
                'unsigned' => TRUE,
            ],
            'request' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'note' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'status' => [
                'type' => 'TINYINT',
                'constraint' => 1
            ],
            'cost' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ]
        ]);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (reservation_id) REFERENCES reservations(reservation_id) ON DELETE CASCADE');
        $this->dbforge->create_table('reservation_request');
    }

    public function down()
    {
        $this->dbforge->drop_table('reservation_request');
    }
}
