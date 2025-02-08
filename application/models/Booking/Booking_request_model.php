<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking_request_model extends CI_Model
{
    protected $table = "booking_requests";
    protected $foreignKey1 = "booking_detail_id"; // references booking_detail

    public function getRequest($hotelId)
    {
        try {
            $this->db->select('booking_requests.*, booking_details.full_name');
            $this->db->from('booking_requests');
            $this->db->join('booking_details', 'booking_requests.booking_detail_id = booking_details.booking_detail_id');
            $this->db->join('room_codes', 'booking_details.room_code_id = room_codes.room_code_id');
            $this->db->join('rooms', 'room_codes.room_id = rooms.room_id');
            $this->db->where('rooms.hotel_id', $hotelId);
            $this->db->order_by('check_in', 'desc');
            return $this->db->get()->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching all reservations: ' . $e->getMessage());
            return [];
        }
    }

    public function update($id, $data)
    {
        try {
            $this->db->where($this->foreignKey1, $id);
            return $this->db->update($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error updating reservation with id ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }
}
