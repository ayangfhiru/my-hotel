<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Room_Code extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'room_code_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'room_id' => [
                'type' => 'BIGINT',
                'constraint' => 21,
                'unsigned' => TRUE,
            ],
            'room_code' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'is_clean' => [
                'type' => 'BOOLEAN',
                'default' => 1
            ],
            'is_available' => [
                'type' => 'BOOLEAN',
                'default' => 1
            ],
        ]);
        $this->dbforge->add_key('room_code_id', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (room_id) REFERENCES rooms(room_id) ON DELETE CASCADE');
        $this->dbforge->create_table('room_codes');
    }

    public function down()
    {
        $this->dbforge->drop_table('room_codes');
    }
}
