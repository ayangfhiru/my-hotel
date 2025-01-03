<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Room_Picture extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'room_id' => [
                'type' => 'BIGINT',
                'constraint' => 21,
                'unsigned' => TRUE,
            ],
            'picture' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
        ]);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (room_id) REFERENCES rooms(room_id) ON DELETE CASCADE'); // Foreign Key
        $this->dbforge->create_table('room_pictures');
    }

    public function down()
    {
        $this->dbforge->drop_table('room_pictures');
    }
}
