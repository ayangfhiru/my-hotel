<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Room_model extends CI_Model
{
    protected $table = 'rooms';
    protected $primaryKey = 'room_id';

    public function all()
    {
        try {
            return $this->db->get($this->table)->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching all rooms: ' . $e->getMessage());
            return [];
        }
    }

    public function find($roomId)
    {
        try {
            $this->db->from($this->table);
            $this->db->where($this->primaryKey, $roomId);
            return $this->db->get()->row();
        } catch (Exception $e) {
            log_message('error', 'Error finding room with id ' . $roomId . ': ' . $e->getMessage());
            return null;
        }
    }

    public function create($dataRom)
    {
        try {
            return $this->db->insert($this->table, $dataRom);
        } catch (Exception $e) {
            log_message('error', 'Error creating room: ' . $e->getMessage());
            return false;
        }
    }

    public function update($hotelId, $data)
    {
        try {
            $this->db->where($this->primaryKey, $hotelId);
            return $this->db->update($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error updating room with hotel_id ' . $hotelId . ': ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            return $this->db->delete($this->table, [$this->primaryKey => $id]);
        } catch (Exception $e) {
            log_message('error', 'Error deleting room with id ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }

    public function where($data)
    {
        try {
            $this->db->from($this->table);
            $this->db->where($data);
            $this->db->join('beds', "$this->table.bed_id = beds.bed_id", 'left');
            return $this->db->get()->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching rooms with conditions: ' . $e->getMessage());
            return [];
        }
    }

    public function insert_multiple_tables($dataRoom, $dataFacility, $dataPicture)
    {
        try {
            $this->db->trans_start();
            $this->db->insert($this->table, $dataRoom);
            $roomId = $this->db->insert_id();

            foreach ($dataFacility as $facility) {
                $pivotFacility = [
                    'room_id' => $roomId,
                    'facility_id' => $facility
                ];
                $this->db->insert('room_facility', $pivotFacility);
            }

            foreach ($dataPicture as $picture) {
                $pivotPic = [
                    'room_id' => $roomId,
                    'picture' => $picture
                ];
                $this->db->insert('room_pictures', $pivotPic);
            }

            if ($this->db->trans_complete()) {
                return true;
            } else {
                $this->db->trans_rollback();
                return false;
            }
        } catch (Exception $e) {
            log_message('error', 'Error inserting multiple tables for room: ' . $e->getMessage());
            $this->db->trans_rollback();
            return false;
        }
    }

    public function update_multiple_tables($roomId, $dataRoom, $dataFacility, $dataPicture)
    {
        try {
            $this->db->trans_start();
            $this->db->query("DELETE FROM room_facility WHERE room_id = $roomId");
            $this->db->query("DELETE FROM room_pictures WHERE room_id = $roomId");

            $this->db->where('room_id', $roomId);
            $this->db->update($this->table, $dataRoom);

            foreach ($dataFacility as $facility) {
                $pivotFacility = [
                    'room_id' => $roomId,
                    'facility_id' => $facility
                ];
                $this->db->insert('room_facility', $pivotFacility);
            }

            foreach ($dataPicture as $picture) {
                $pivotPic = [
                    'room_id' => $roomId,
                    'picture' => $picture
                ];
                $this->db->insert('room_pictures', $pivotPic);
            }

            if ($this->db->trans_complete()) {
                return true;
            } else {
                $this->db->trans_rollback();
                return false;
            }
        } catch (Exception $e) {
            log_message('error', 'Error updating multiple tables for room with id ' . $roomId . ': ' . $e->getMessage());
            $this->db->trans_rollback();
            return false;
        }
    }

    public function search_room($hotelId, $checkIn, $checkOut)
    {
        try {
            $query = "SELECT ro.room_id, ro.room_type, ro.capacity, ro.price, be.bed_type, COUNT(rc.room_id) AS total
                FROM room_codes rc
                LEFT JOIN reservations res
                    ON rc.room_code_id = res.room_code_id
                    AND NOT (
                        res.check_out <= ? OR
                        res.check_in >= ?
                    )
                JOIN rooms AS ro
                ON rc.room_id = ro.room_id
                JOIN beds AS be
                ON ro.bed_id = be.bed_id
                WHERE ro.hotel_id = ? AND
                res.reservation_id IS NULL
                GROUP BY ro.room_id";

            return $this->db->query($query, [$checkIn, $checkOut, $hotelId])->result();
        } catch (Exception $e) {
            log_message('error', 'Error searching rooms for hotel_id ' . $hotelId . ': ' . $e->getMessage());
            return [];
        }
    }

    public function get_room_code($hotelId)
    {
        try {
            $query = "SELECT ro.room_id, ro.room_type, rc.room_code_id, rc.room_code, rc.room_status
                FROM room_codes AS rc
                JOIN rooms AS ro
                ON rc.room_id = ro.room_id
                WHERE ro.hotel_id = $hotelId
                ORDER BY rc.room_code ASC";

            return $this->db->query($query)->result();
        } catch (Exception $e) {
            log_message('error', 'Error getting room codes for hotel_id ' . $hotelId . ': ' . $e->getMessage());
            return [];
        }
    }
}
