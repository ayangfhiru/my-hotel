<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Room_Bed extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'room_id' => [
                'type' => 'BIGINT',
                'constraint' => 21,
                'unsigned' => TRUE,
            ],
            'bed_id' => [
                'type' => 'INT',
                'constranit' => 5,
                'unsigned' =>  TRUE
            ],
        ]);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (room_id) REFERENCES rooms(room_id) ON DELETE CASCADE');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (bed_id) REFERENCES beds(bed_id) ON DELETE CASCADE');
        $this->dbforge->create_table('room_bed_pivot');
    }

    public function down()
    {
        $this->dbforge->drop_table('room_bed_pivot');
    }
}
