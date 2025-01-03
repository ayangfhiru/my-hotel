<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Room_code_model extends CI_Model
{
    protected $table = 'room_codes';
    protected $primaryKey = 'room_code_id';

    public function all()
    {
        return $this->db->get($this->table)->result();
    }

    public function find($id)
    {
        $this->db->from($this->table);
        $this->db->where($this->primaryKey, $id);
        return $this->db->get()->row();
    }

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where($this->primaryKey, $id);
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
        return $this->db->get()->result();
    }

    public function search_room_code($hotelId, $roomId, $checkIn, $checkOut)
    {
        $query = "SELECT rc.room_code_id, rc.room_code,
            ro.room_id, ro.room_type, ro.capacity, ro.price,
            be.bed_name
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
            WHERE ro.hotel_id = $hotelId
            AND rc.room_id = $roomId
            AND res.reservation_id IS NULL";
        $data = $this->db->query($query);
        return $data->result();
    }

    public function get_room_status()
    {
        $query = "SHOW COLUMNS
            FROM room_codes
            WHERE FIELD = 'room_status'";

        return $this->db->query($query)->row()->Type;
    }
}
