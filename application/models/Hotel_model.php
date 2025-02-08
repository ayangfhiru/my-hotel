<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hotel_model extends CI_Model
{
    protected $table = "hotels";
    protected $primaryKey = "hotel_id";

    public function all()
    {
        try {
            return $this->db->get($this->table)->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching all hotels: ' . $e->getMessage());
            return [];
        }
    }

    public function find($hotelId)
    {
        try {
            $this->db->from($this->table);
            $this->db->where($this->primaryKey, $hotelId);
            return $this->db->get()->row();
        } catch (Exception $e) {
            log_message('error', 'Error finding hotel with hotel_id ' . $hotelId . ': ' . $e->getMessage());
            return null;
        }
    }

    public function create($dataHotel)
    {
        try {
            return $this->db->insert($this->table, $dataHotel);
        } catch (Exception $e) {
            log_message('error', 'Error creating hotel: ' . $e->getMessage());
            return false;
        }
    }

    public function update($hotelId, $data)
    {
        try {
            $this->db->where($this->primaryKey, $hotelId);
            return $this->db->update($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error updating hotel with hotel_id ' . $hotelId . ': ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            return $this->db->delete($this->table, [$this->primaryKey => $id]);
        } catch (Exception $e) {
            log_message('error', 'Error deleting hotel with hotel_id ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }

    public function detail($hotelId)
    {
        try {
            $query = "SELECT *
                FROM hotels AS ho
                JOIN rooms AS ro
                ON ho.hotel_id = ro.hotel_id
                WHERE ho.hotel_id = ?";
            return $this->db->query($query, [$hotelId])->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching details for hotel with hotel_id ' . $hotelId . ': ' . $e->getMessage());
            return [];
        }
    }

    public function findAvailableHotels($checkIn, $checkOut)
    {
        try {
            $query = "SELECT DISTINCT ho.*
            FROM room_codes AS rc
            LEFT JOIN booking_details AS bd ON rc.room_code_id = bd.room_code_id
                AND NOT (
                bd.check_out <= ? OR
                bd.check_in >= ?
                )
            JOIN rooms AS ro ON rc.room_id = ro.room_id
            JOIN hotels AS ho ON ro.hotel_id = ho.hotel_id
            WHERE bd.booking_id IS NULL";
            return $this->db->query($query, [$checkIn, $checkOut])->result();
        } catch (Exception $e) {
            log_message('error', 'Error checking hotel availability: ' . $e->getMessage());
            return [];
        }
    }
}
