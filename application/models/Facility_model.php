<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Facility_model extends CI_Model
{
    protected $table = 'facilities';
    protected $primaryKey = 'facility_id';

    public function all()
    {
        try {
            return $this->db->get($this->table)->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching all facilities: ' . $e->getMessage());
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
            log_message('error', 'Error finding facility with ID ' . $id . ': ' . $e->getMessage());
            return null;
        }
    }

    public function create($data)
    {
        try {
            return $this->db->insert($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error creating facility: ' . $e->getMessage());
            return false;
        }
    }

    public function update($id, $data)
    {
        try {
            $this->db->where($this->primaryKey, $id);
            return $this->db->update($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error updating facility with ID ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            return $this->db->delete($this->table, [$this->primaryKey => $id]);
        } catch (Exception $e) {
            log_message('error', 'Error deleting facility with ID ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }

    public function search_facility($hotelId)
    {
        try {
            $query = "SELECT fa.*, rf.room_id
                FROM facilities AS fa
                LEFT JOIN room_facility AS rf
                ON fa.facility_id = rf.facility_id
                JOIN rooms AS ro
                ON rf.room_id = ro.room_id
                WHERE ro.hotel_id = ?";
            return $this->db->query($query, [$hotelId])->result();
        } catch (Exception $e) {
            log_message('error', 'Error searching facilities for hotel ID ' . $hotelId . ': ' . $e->getMessage());
            return [];
        }
    }
}
