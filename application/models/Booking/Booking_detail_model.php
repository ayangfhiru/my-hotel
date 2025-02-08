<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking_detail_model extends CI_Model
{
    protected $table = "booking_details";
    protected $primaryKey = "booking_detail_id";
    protected $foreignKey1 = "booking_id"; // references table booking
    protected $foreignKey2 = "room_code_id"; // references table room_code

    public function all()
    {
        try {
            return $this->db->get($this->table)->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching all reservations: ' . $e->getMessage());
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
            log_message('error', 'Error finding reservation with id ' . $id . ': ' . $e->getMessage());
            return null;
        }
    }

    public function create($data)
    {
        try {
            return $this->db->insert($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error creating reservation: ' . $e->getMessage());
            return false;
        }
    }

    public function update($id, $data)
    {
        try {
            $this->db->where($this->primaryKey, $id);
            return $this->db->update($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error updating reservation with id ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            return $this->db->delete($this->table, [$this->primaryKey => $id]);
        } catch (Exception $e) {
            log_message('error', 'Error deleting reservation with id ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }

    public function findDetailBookingByUserId($userId)
    {
        try {
            $query = "SELECT DISTINCT ho.hotel_id, ho.name, pa.*
                FROM bookings AS bo
                JOIN booking_details AS bd ON bo.booking_id = bd.booking_id
                JOIN payments AS pa ON bo.booking_id = pa.booking_id
                JOIN room_codes AS rc ON bd.room_code_id = rc.room_code_id
                JOIN rooms AS ro ON rc.room_id = ro.room_id
                JOIN hotels AS ho ON ro.hotel_id = ho.hotel_id
                WHERE bo.user_id = ?";

            $result = $this->db->query($query, [$userId]);
            return $result->result();
        } catch (Exception $e) {
            log_message('error', 'Error deleting reservation with id ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }
}
