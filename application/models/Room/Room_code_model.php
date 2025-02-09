<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Room_code_model extends CI_Model
{
    protected $table = 'room_codes';
    protected $primaryKey = 'room_code_id';
    protected $foreignKey1 = "room_id"; // references room

    public function all()
    {
        try {
            return $this->db->get($this->table)->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching all room codes: ' . $e->getMessage());
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
            log_message('error', 'Error finding room code with id ' . $id . ': ' . $e->getMessage());
            return null;
        }
    }

    public function create($data)
    {
        try {
            return $this->db->insert($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error creating room code: ' . $e->getMessage());
            return false;
        }
    }

    public function update($roomCodeId, $data)
    {
        try {
            $this->db->where($this->primaryKey, $roomCodeId);
            return $this->db->update($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error updating room code with Id ' . $roomCodeId . ': ' . $e->getMessage());
            return false;
        }
    }

    public function delete($roomCodeId)
    {
        try {
            $this->db->where($this->primaryKey, $roomCodeId);
            return $this->db->delete($this->table);
        } catch (Exception $e) {
            log_message('error', 'Error deleting room code with Id ' . $roomCodeId . ': ' . $e->getMessage());
            return false;
        }
    }

    public function where($data)
    {
        try {
            $this->db->from($this->table);
            $this->db->where($data);
            return $this->db->get()->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching room codes with conditions: ' . $e->getMessage());
            return [];
        }
    }

    public function findAvailableRoomCodes($hotelId, $roomId, $checkIn, $checkOut)
    {
        try {
            $query = "SELECT rc.room_code_id, rc.room_code,
                    ro.room_id, ro.room_type, ro.capacity, ro.price,
                    be.bed_type
                  FROM room_codes rc
                  LEFT JOIN booking_details AS bd
                    ON rc.room_code_id = bd.room_code_id
                    AND NOT (
                        bd.check_out <= ? OR
                        bd.check_in >= ?
                    )
                  JOIN rooms AS ro
                    ON rc.room_id = ro.room_id
                  JOIN beds AS be
                    ON ro.bed_id = be.bed_id
                  WHERE ro.hotel_id = ?
                    AND rc.room_id = ?
                    AND bd.booking_id IS NULL";
            $data = $this->db->query($query, [$checkIn, $checkOut, $hotelId, $roomId]);
            return $data->result();
        } catch (Exception $e) {
            log_message('error', 'Error searching room code for hotel_id ' . $hotelId . ', room_id ' . $roomId . ': ' . $e->getMessage());
            return [];
        }
    }

    public function getRoomStatusColumnType()
    {
        try {
            $query = "SHOW COLUMNS
                FROM room_codes
                WHERE FIELD = 'room_status'";

            return $this->db->query($query)->row()->Type;
        } catch (Exception $e) {
            log_message('error', 'Error fetching room status column: ' . $e->getMessage());
            return null;
        }
    }
}
