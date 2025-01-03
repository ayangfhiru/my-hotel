<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Room_model extends CI_Model
{
    protected $table = 'rooms';
    protected $primaryKey = 'room_id';

    public function all()
    {
        return $this->db->get($this->table)->result();
    }

    public function find($roomId)
    {
        $this->db->from($this->table);
        $this->db->where($this->primaryKey, $roomId);
        return $this->db->get()->row();
    }

    public function create($dataRom)
    {
        return $this->db->insert($this->table, $dataRom);
    }

    public function update($hotelId, $data)
    {
        $this->db->where($this->primaryKey, $hotelId);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, [$this->primaryKey => $id]);
    }

    public function where($data)
    {
        $this->db->from($this->table);
        $this->db->where($data);
        $this->db->join('beds', "$this->table.bed_id = beds.bed_id", 'left');
        return $this->db->get()->result();
    }

    public function insert_multiple_tables($dataRoom, $dataFacility, $dataPicture)
    {
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
    }

    public function update_multiple_tables($roomId, $dataRoom, $dataFacility, $dataPicture)
    {
        $this->db->trans_start();
        $this->db->query("DELETE FROM room_facility WHERE room_id = $roomId");
        $this->db->query("DELETE FROM room_pictures WHERE room_id = $roomId");

        $this->db->where('room_id', $roomId);
        $this->db->update($this->table, $dataRoom);

        // $this->db->delete('room_facilities', ['room_id', $roomId]);
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
    }

    public function search_room($hotelId, $checkIn, $checkOut)
    {
        $query = "SELECT ro.room_id, ro.room_type, be.bed_name, COUNT(rc.room_id) AS total
            FROM room_codes rc
            LEFT JOIN reservations res
                ON rc.room_code_id = res.room_code_id
                AND NOT (
                    res.check_out <= '$checkIn' OR
                    res.check_in >= '$checkOut'
                )
            JOIN rooms AS ro
            ON rc.room_id = ro.room_id
            JOIN beds AS be
            ON ro.bed_id = be.bed_id
            WHERE ro.hotel_id = $hotelId AND
            res.reservation_id IS NULL
            GROUP BY ro.room_id";

        $data = $this->db->query($query);
        return $data->result();
    }

    public function get_room_code($hotelId)
    {
        $query = "SELECT ro.room_id, ro.room_type, rc.room_code_id, rc.room_code, rc.room_status
            FROM room_codes AS rc
            JOIN rooms AS ro
            ON rc.room_id = ro.room_id
            WHERE ro.hotel_id = $hotelId
            ORDER BY rc.room_code ASC;";

        return $this->db->query($query)->result();
    }
}
