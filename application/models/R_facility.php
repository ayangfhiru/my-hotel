<?php
defined('BASEPATH') or exit('No direct script access allowed');

class R_facility extends CI_Model
{
    protected $table = 'room_facility';
    protected $primaryKey = 'room_facility_id';

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
            $this->db->where($this->primaryKey, $id);
            return $this->db->get()->row();
        } catch (Exception $e) {
            log_message('error', 'Error finding room facility with id ' . $id . ': ' . $e->getMessage());
            return null;
        }
    }

    public function where($data)
    {
        try {
            $this->db->from($this->table);
            $this->db->where($data);
            $this->db->join('facilities', "$this->table.facility_id = facilities.facility_id", 'right');
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

    public function get_facility($roomId)
    {
        try {
            $query = "SELECT fa.*, rf.room_id
                FROM facilities AS fa
                LEFT JOIN room_facility AS rf
                ON fa.facility_id = rf.facility_id
                AND rf.room_id = ?";
            return $this->db->query($query, [$roomId])->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching facilities for room_id ' . $roomId . ': ' . $e->getMessage());
            return [];
        }
    }
}
