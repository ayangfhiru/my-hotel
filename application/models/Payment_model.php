<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_model extends CI_Model
{
    protected $table = 'payments';
    protected $primaryKey = 'payment_id';

    public function all($hotelId)
    {
        try {
            $query = "SELECT pa.*, re.full_name, cr.note
                FROM payments AS pa
                JOIN reservations AS re ON pa.reservation_id = re.reservation_id
                JOIN room_codes AS rc ON re.room_code_id = rc.room_code_id
                JOIN rooms AS ro ON rc.room_id = ro.room_id
                LEFT JOIN cancel_reservations AS cr ON re.reservation_id = cr.reservation_id
                WHERE ro.hotel_id = ?
                ORDER BY pa.booking_time DESC";

            return $this->db->query($query, [$hotelId])->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching all payments: ' . $e->getMessage());
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
            log_message('error', 'Error finding payment with payment_id ' . $id . ': ' . $e->getMessage());
            return null;
        }
    }

    public function create($data)
    {
        try {
            return $this->db->insert($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error creating payment: ' . $e->getMessage());
            return false;
        }
    }

    public function update($id, $data)
    {
        try {
            $this->db->where($this->primaryKey, $id);
            return $this->db->update($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error updating payment with payment_id ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            return $this->db->delete($this->table, [$this->primaryKey => $id]);
        } catch (Exception $e) {
            log_message('error', 'Error deleting payment with payment_id ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }

    public function generateInvoice($hotelId, $roomCode, $date)
    {
        try {
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
                WHERE ro.hotel_id = ?
                AND re.created_at BETWEEN ? AND ?
                ORDER BY pa.payment_id DESC
                LIMIT 1";

            $result = $this->db->query($query, [$hotelId, $first, $last])->row();
            if ($result) {
                $lastInvoice = $result->invoice;
                $lastNumber = explode("/", $lastInvoice)[3];
                $newLastNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $newLastNumber = "001";
            }
            $newInvoice = "$prefix/$newLastNumber";
            return $newInvoice;
        } catch (Exception $e) {
            log_message('error', 'Error generating invoice: ' . $e->getMessage());
            return null;
        }
    }

    public function multiple_confirm_status($reservationId, $paymentId)
    {
        try {
            $this->db->trans_start();
            // update payment
            $this->db->where($this->primaryKey, $paymentId);
            $this->db->update($this->table, ['payment_status' => 'completed']);

            // update reservation
            $this->db->where('reservation_id', $reservationId);
            $this->db->update('reservations', ['reservation_status' => 'confirmed']);

            if ($this->db->trans_complete()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            log_message('error', 'Error confirming payment and reservation: ' . $e->getMessage());
            $this->db->trans_rollback();
            return false;
        }
    }

    public function multiple_cancel($paymentId, $reservationId, $dataNote)
    {
        try {
            $this->db->trans_start();
            // update payments
            $this->db->where($this->primaryKey, $paymentId);
            $this->db->update($this->table, ['payment_status' => 'failed']);

            // update reservations
            $this->db->where('reservation_id', $reservationId);
            $this->db->update('reservations', ['reservation_status' => 'canceled']);

            // insert note
            $this->db->insert('cancel_reservations', $dataNote);
            if ($this->db->trans_complete()) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            log_message('error', 'Error confirming payment and reservation: ' . $e->getMessage());
            $this->db->trans_rollback();
            return false;
        }
    }
}
