<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Payment extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'payment_id' => [
                'type' => 'BIGINT',
                'constraint' => 21,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'reservation_id' => [
                'type' => 'BIGINT',
                'constraint' => 21,
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'invoice' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'payment_method' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'payment_deadline' => [
                'type' => 'DATETIME',
            ],
            'amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'payment_status' => [
                'type' => 'ENUM("Pending","Completed","Failed")',
                'default' => 'Pending'
            ],
            'paid_date' => [
                'type' => 'DATETIME'
            ]
        ]);
        $this->dbforge->add_key('payment_id', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (reservation_id) REFERENCES reservations(reservation_id)'); // Foreign Key
        $this->dbforge->create_table('payments');
    }

    public function down()
    {
        $this->dbforge->drop_table('payments');
    }
}
