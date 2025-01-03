<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_model extends CI_Model
{
    protected $table = 'payments';
    protected $primaryKey = 'payment_id';

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

    public function generateInvoice($hotelId, $roomCode, $date)
    {
        $first = $date['first'];
        $last = $date['last'];
        $now = date('Ymd');
        $prefix = "INV/$roomCode/$now";
        $query = "SELECT pa.payment_id, pa.invoice
            FROM payments AS pa
            JOIN reservations AS re
            ON re.reservation_id = pa.reservation_id
            JOIN room_codes AS rc
            ON rc.room_code_id = re.room_code_id
            JOIN rooms AS ro
            ON ro.room_id = rc.room_id
            WHERE ro.hotel_id = $hotelId
            AND re.check_in BETWEEN '$first' AND '$last'
            ORDER BY pa.payment_id DESC
            LIMIT 1";

        $result = $this->db->query($query)->row();
        if ($result) {
            $lastInvoice = $result->invoice;
            $lastNumber = explode("/", $lastInvoice)[3];
            $newLastNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newLastNumber = "001";
        }
        $newInvoice = "$prefix/$newLastNumber";
        return $newInvoice;
    }

    public function update_status($paymentId, $data)
    {
        $this->db->where($this->primaryKey, $paymentId);
        return $this->db->update($this->table, ['payment_status' => $data]);
    }

    public function update_status_where_reservation($reservationId, $data)
    {
        $this->db->where('reservation_id', $reservationId);
        return $this->db->update($this->table, $data);
    }
}
