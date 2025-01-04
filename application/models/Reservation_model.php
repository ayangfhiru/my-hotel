<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reservation_model extends CI_Model
{
    protected $table = 'reservations';
    protected $primaryKey = 'reservation_id';

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

    public function get_reservation_hotel($hotelId)
    {
        $query = "SELECT *
            FROM reservations AS re
            JOIN payments AS pa
            ON re.reservation_id = pa.reservation_id
            JOIN room_codes AS rc
            ON re.room_code_id = rc.room_code_id
            JOIN rooms AS ro
            ON rc.room_id = ro.room_id
            WHERE ro.hotel_id = ?
            ORDER BY re.check_in ASC";

        return $this->db->query($query, [$hotelId])->result();
    }

    public function insert_multiple_tables($dataReservation, $dataPayment)
    {
        $this->db->trans_start();
        // add reservation
        $this->db->insert($this->table, $dataReservation);
        $reservationId = $this->db->insert_id();

        // add payment
        $dataPayment['reservation_id'] = $reservationId;
        $this->db->insert('payments', $dataPayment);

        if ($this->db->trans_complete()) {
            return true;
        } else {
            $this->db->trans_rollback();
            return false;
        }
    }

    public function to_invoice($reservationId)
    {
        $query = "SELECT re.*, pa.*,
            rc.room_code,
            be.bed_name,
            ro.room_type, ro.capacity, ro.price,
            ho.name AS hotel_name, ho.address, ho.city, ho.telepon
            FROM reservations AS re
            JOIN payments AS pa ON re.reservation_id = pa.reservation_id
            JOIN room_codes AS rc ON re.room_code_id = rc.room_code_id
            JOIN rooms AS ro ON rc.room_id = ro.room_id
            JOIN hotels AS ho ON ro.hotel_id = ho.hotel_id
            JOIN beds AS be ON ro.bed_id = be.bed_id
            WHERE re.reservation_id = ?";

        return $this->db->query($query, [$reservationId])->row();
    }

    public function get_reservation($hotelId, $checkIn, $checkOut)
    {
        $query = "SELECT re.*, rc.*, pa.*
            FROM room_codes AS rc
            LEFT JOIN reservations AS re ON rc.room_code_id = re.room_code_id
            JOIN rooms AS ro ON rc.room_id = ro.room_id
            JOIN payments AS pa ON re.reservation_id = pa.reservation_id
            WHERE ro.hotel_id = ?
                AND re.check_out >= ?
                AND re.check_in <= ?
            ORDER BY rc.room_code ASC, re.check_in ASC";

        return $this->db->query($query, [$hotelId, $checkIn, $checkOut])->result();
    }
}
