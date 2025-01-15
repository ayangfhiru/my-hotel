<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Room_picture_model extends CI_Model
{
    public function get_picture($hotelId)
    {
        try {
            $query = "SELECT rp.*
                FROM room_pictures AS rp
                JOIN rooms AS ro
                ON rp.room_id = ro.room_id
                WHERE ro.hotel_id = ?
                LIMIT 4";
            return $this->db->query($query, [$hotelId])->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching room pictures for hotel_id ' . $hotelId . ': ' . $e->getMessage());
            return [];
        }
    }
}
