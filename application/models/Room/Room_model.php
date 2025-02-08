<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Room_model extends CI_Model
{
    protected $table = 'rooms';
    protected $primaryKey = 'room_id';
    protected $foreignKey1 = "hotel_id"; // references hotel
    protected $foreignKey2 = "bed_id"; // references bed

    public function all()
    {
        try {
            return $this->db->get($this->table)->result();
        } catch (Exception $e) {
            log_message("error", "Error fetching rooms: {$e->getMessage()}");
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
            log_message("error", "Error finding rooms with id $roomId: {$e->getMessage()}");
            return null;
        }
    }

    public function create($dataRoom)
    {
        try {
            return $this->db->insert($this->table, $dataRoom);
        } catch (Exception $e) {
            log_message("error", "Error createing room: {$e->getMessage()}");
            return false;
        }
    }

    public function update($hotelId, $data)
    {
        try {
            $this->db->where($this->primaryKey, $hotelId);
            return $this->db->update($this->table, $data);
        } catch (Exception $e) {
            log_message("error", "Error updating room with hotel_id $hotelId: {$e->getMessage()}");
            return false;
        }
    }

    public function delete($roomId)
    {
        try {
            $this->db->where($this->primaryKey, $roomId);
            return $this->db->delete($this->table);
        } catch (Exception $e) {
            log_message("error", "Error deleting rooms with id $roomId: {$e->getMessage()}");
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
            log_message('error', 'Error fetching rooms with conditions: ' . $e->getMessage());
            return [];
        }
    }

    public function findRoomWithHotel($id)
    {
        try {
            $this->db->from($this->table);
            $this->db->where('hotel_id', $id);
            return $this->db->get()->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching rooms with conditions: ' . $e->getMessage());
            return [];
        }
    }

    public function findRoomWithBed($data)
    {
        $tableBed = "beds";
        try {
            $this->db->from($this->table);
            $this->db->where($data);
            $this->db->join($tableBed, "$this->table.$this->foreignKey2 = $tableBed.$this->foreignKey2", 'left');
            return $this->db->get()->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching rooms with conditions: ' . $e->getMessage());
            return [];
        }
    }

    public function addRoomWithDetails($dataRoom, $dataFacility, $dataPicture)
    {
        $tableFac = "room_facilities";
        $tablePic = "room_pictures";
        try {
            $this->db->trans_start();
            $this->db->insert($this->table, $dataRoom);
            $roomId = $this->db->insert_id();

            foreach ($dataFacility as $fac) {
                $facility = [
                    'room_id' => $roomId,
                    'facility_id' => $fac
                ];
                $this->db->insert($tableFac, $facility);
            }

            foreach ($dataPicture as $pic) {
                $picture = [
                    'room_id' => $roomId,
                    'picture' => $pic
                ];
                $this->db->insert($tablePic, $picture);
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

    public function updateRoomWithDetails($roomId, $dataRoom, $dataFacility, $dataPicture)
    {
        $tableFac = "room_facilities";
        $tablePic = "room_pictures";
        try {
            $this->db->trans_start();
            $this->db->query("DELETE FROM $tableFac WHERE $this->primaryKey = $roomId");
            $this->db->query("DELETE FROM $tablePic WHERE $this->primaryKey = $roomId");

            $this->db->where($this->primaryKey, $roomId);
            $this->db->update($this->table, $dataRoom);

            foreach ($dataFacility as $fac) {
                $facility = [
                    'room_id' => $roomId,
                    'facility_id' => $fac
                ];
                $this->db->insert($tableFac, $facility);
            }

            foreach ($dataPicture as $pic) {
                $picture = [
                    'room_id' => $roomId,
                    'picture' => $pic
                ];
                $this->db->insert($tablePic, $picture);
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

    public function findAvailableRooms($hotelId, $checkIn, $checkOut)
    {
        try {
            $query = "SELECT ro.room_id, ro.room_type, ro.capacity, ro.price, be.bed_type, COUNT(rc.room_id) AS total
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
                WHERE ro.hotel_id = ? AND
                bd.booking_id IS NULL
                GROUP BY ro.room_id";

            return $this->db->query($query, [$checkIn, $checkOut, $hotelId])->result();
        } catch (Exception $e) {
            log_message('error', 'Error searching rooms for hotel_id ' . $hotelId . ': ' . $e->getMessage());
            return [];
        }
    }

    public function findAvailableRoomCodesByHotel($hotelId, $checkIn, $checkOut)
    {
        try {
            $query = "SELECT rc.*, ro.*
                    FROM room_codes rc
                    LEFT JOIN booking_details AS bd
                        ON rc.room_code_id = bd.room_code_id
                        AND NOT (
                            bd.check_out <= ? OR
                            bd.check_in >= ?
                        )
                    JOIN rooms AS ro ON rc.room_id = ro.room_id
                    WHERE ro.hotel_id = ? AND bd.booking_id IS NULL";

            return $this->db->query($query, [$checkIn, $checkOut, $hotelId])->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching reservation rooms for hotel_id ' . $hotelId . ': ' . $e->getMessage());
            return [];
        }
    }

    public function getRoomCodesByHotel($hotelId)
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
