<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Facility extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'facility_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'facility_name' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
            ],
        ]);
        $this->dbforge->add_key('facility_id', TRUE);
        $this->dbforge->create_table('facilities');
    }

    public function down()
    {
        $this->dbforge->drop_table('facilities');
    }
}
