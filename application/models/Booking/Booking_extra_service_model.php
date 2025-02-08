<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking_extra_service_model extends CI_Model
{
    protected $table = "booking_extra_service";
    protected $foreignKey1 = "booking_detail_id"; // references booking_detail
    protected $foreignKey2 = "service_id"; // references extra_service

    public function findExtraService($data)
    {
        $tableBoDetail = "booking_details";
        try {
            $this->db->select("$this->table.*, $tableBoDetail.check_out");
            $this->db->from($this->table);
            $this->db->join($tableBoDetail, "$this->table.$this->foreignKey1 = $tableBoDetail.$this->foreignKey1");
            $this->db->where($data);
            $this->db->where("$tableBoDetail.check_out <", date('Y-m-d'));
            return $this->db->get()->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching room facilities with conditions: ' . $e->getMessage());
            return [];
        }
    }
}
