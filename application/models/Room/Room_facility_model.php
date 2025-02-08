<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Room_facility_model extends CI_Model
{
    protected $table = "room_facilities";
    protected $foreignKey1 = "room_id"; // references room
    protected $foreignKey2 = "facility_id"; // references facility

    public function all()
    {
        try {
            return $this->db->get($this->table)->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching all room facilities: ' . $e->getMessage());
            return [];
        }
    }

    public function find($id)
    {
        try {
            $this->db->from($this->table);
            $this->db->where($this->foreignKey1, $id);
            return $this->db->get()->row();
        } catch (Exception $e) {
            log_message('error', 'Error finding room facility with id ' . $id . ': ' . $e->getMessage());
            return null;
        }
    }

    public function where($data)
    {
        $tableFacility = "facilities";
        try {
            $this->db->from($this->table);
            $this->db->where($data);
            $this->db->join($tableFacility, "$this->table.facility_id = facilities.facility_id", 'right');
            return $this->db->get()->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching room facilities with conditions: ' . $e->getMessage());
            return [];
        }
    }

    public function findFacility($data)
    {
        $tableFacility = "facilities";
        try {
            $this->db->from($this->table);
            $this->db->where($data);
            // $this->db->where("$this->table.$this->foreignKey2", $data[$this->foreignKey2]);
            // $this->db->join($tableFacility, "$this->table.$this->foreignKey2 = $tableFacility.$this->foreignKey2", 'right');
            return $this->db->get()->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching room facilities with conditions: ' . $e->getMessage());
            return [];
        }
    }

    public function update($id, $data)
    {
        try {
            $this->db->where($this->primaryKey, $id);
            return $this->db->update($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error updating room facility with id ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            return $this->db->delete($this->table, [$this->primaryKey => $id]);
        } catch (Exception $e) {
            log_message('error', 'Error deleting room facility with id ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }

    public function getFacilitiesByRoom($roomId)
    {
        $tableFac = "facilities";
        try {
            $query = "SELECT fa.*, rf.room_id
                FROM $tableFac AS fa
                LEFT JOIN $this->table AS rf
                ON fa.facility_id = rf.facility_id
                AND rf.room_id = ?";
            return $this->db->query($query, [$roomId])->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching facilities for room_id ' . $roomId . ': ' . $e->getMessage());
            return [];
        }
    }
}
