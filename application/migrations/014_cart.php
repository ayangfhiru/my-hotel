<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Cart extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'room_code_id' => [
                'type' => 'BIGINT',
                'constraint' => 21,
                'unsigned' => TRUE,
            ],
            'check_in' => [
                'type' => 'DATE',
            ],
            'check_out' => [
                'type' => 'DATE'
            ]
        ]);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(user_id)'); // Foreign Key
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (room_code_id) REFERENCES room_codes(room_code_id)'); // Foreign Key
        $this->dbforge->create_table('carts');
    }

    public function down()
    {
        $this->dbforge->drop_table('carts');
    }
}
