<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Reservation_Extra_Service extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'reservation_id' => [
                'type' => 'BIGINT',
                'constarint' => 21,
                'unsigned' => TRUE,
            ],
            'service_id' => [
                'type' => 'INT',
                'constarint' => 3,
                'unsigned' => TRUE,
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 2
            ],
            'total_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ]
        ]);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (reservation_id) REFERENCES reservations(reservation_id) ON DELETE CASCADE');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (service_id) REFERENCES extra_services(service_id) ON DELETE CASCADE');
        $this->dbforge->create_table('reservation_extra_service');
    }

    public function down()
    {
        $this->dbforge->drop_table('reservation_extra_service');
    }
}
