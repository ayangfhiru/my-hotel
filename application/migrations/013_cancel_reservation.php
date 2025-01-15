<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Cancel_Reservation extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'reservation_id' => [
                'type' => 'BIGINT',
                'constraint' => 21,
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'note' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (reservation_id) REFERENCES reservations(reservation_id) ON DELETE CASCADE'); // Foreign Key
        $this->dbforge->create_table('cancel_reservations');
    }

    public function down()
    {
        $this->dbforge->drop_table('cancel_reservations');
    }
}
