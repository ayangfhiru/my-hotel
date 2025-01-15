<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Reservation extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'reservation_id' => [
                'type' => 'BIGINT',
                'constraint' => 21,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'room_code_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => TRUE,
            ],
            'full_name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'unique' => TRUE,
            ],
            'phone_number' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'unique' => TRUE
            ],
            'check_in' => [
                'type' => 'DATETIME',
            ],
            'check_out' => [
                'type' => 'DATETIME',
            ],
            'identity' => [
                'type' => 'ENUM("sim","ktp","paspor")',
            ],
            'identity_number' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'reservation_status' => [
                'type' => 'ENUM("pending", "confirmed", "checked_in", "in_house", "checked_out", "cancelled", "no_show", "waitlisted", "refunded")',
                'default' => 'pending'
            ],
            'created_at' => [
                'type' => 'DATE',
            ]
        ]);
        $this->dbforge->add_key('reservation_id', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(user_id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (room_code_id) REFERENCES room_codes(room_code_id)'); // Foreign Key
        $this->dbforge->create_table('reservations');
    }

    public function down()
    {
        $this->dbforge->drop_table('reservations');
    }
}
