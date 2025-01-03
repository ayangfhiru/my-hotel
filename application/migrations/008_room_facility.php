<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Table Pivot
 * Table room with facility
 */

class Migration_Room_Facility extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'room_id' => [
                'type' => 'BIGINT',
                'constraint' => 21,
                'unsigned' => TRUE,
            ],
            'facility_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
        ]);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (room_id) REFERENCES rooms(room_id) ON DELETE CASCADE'); // Foreign Key
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (facility_id) REFERENCES facilities(facility_id) ON DELETE CASCADE'); // Foreign Key
        $this->dbforge->create_table('room_facility_pivot');
    }

    public function down()
    {
        $this->dbforge->drop_table('room_facility_pivot');
    }
}
