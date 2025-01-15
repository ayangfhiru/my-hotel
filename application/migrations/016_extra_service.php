<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Extra_Service extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'service_id' => [
                'type' => 'INT',
                'constarint' => 3,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'service_name' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'service_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'description' => [
                'type' => 'VARCHAR',
                'CONSTRAINT' => 255
            ]
        ]);
        $this->dbforge->add_key('service_id', TRUE);
        $this->dbforge->create_table('extra_services');
    }

    public function down()
    {
        $this->dbforge->drop_table('extra_services');
    }
}
