<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_model extends CI_Model
{
    protected $table = "payments";
    protected $primaryKey = "payment_id";
    protected $foreignKey1 = "booking_id"; // references booking

    public function all()
    {
        try {
            $this->db->from($this->table);
            $this->db->order_by('booking_time', 'desc');
            return $this->db->get()->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching all payments: ' . $e->getMessage());
            return [];
        }
    }

    public function getWithHotel($id)
    {
        $tblPayments = 'payments';
        $tblBoDet = 'booking_details';
        $tblRoomCodes = 'room_codes';
        $tblRooms = 'rooms';
        try {
            $this->db->select("$tblPayments.*");
            $this->db->from($tblPayments);
            $this->db->join($tblBoDet, "$tblPayments.booking_id = $tblBoDet.booking_id");
            $this->db->join($tblRoomCodes, "$tblBoDet.room_code_id = $tblRoomCodes.room_code_id");
            $this->db->join($tblRooms, "$tblRoomCodes.room_id = $tblRooms.room_id");
            $this->db->where("$tblRooms.hotel_id", $id);
            $this->db->order_by('booking_time', 'desc');
            return $this->db->get()->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching all payments: ' . $e->getMessage());
            return [];
        }
    }

    public function getAllFromHotel($hotelId)
    {
        try {
            $query = "SELECT pa.*, bd.full_name, bc.cancel_note
                FROM payments AS pa
                JOIN booking AS bo ON pa.booking_id = bo.booking_id
                JOIN booking_details AS bd ON bo.booking_id = bd.booking_id
                JOIN room_codes AS rc ON bd.room_code_id = rc.room_code_id
                JOIN rooms AS ro ON rc.room_id = ro.room_id
                LEFT JOIN booking_cancel AS bc ON bd.booking_detail_id = bc.booking_detail_id
                WHERE ro.hotel_id = ?
                ORDER BY pa.booking_time DESC";

            return $this->db->query($query, [$hotelId])->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching all payments: ' . $e->getMessage());
            return [];
        }
    }

    public function find($paymentId)
    {
        try {
            $this->db->from($this->table);
            $this->db->where($this->primaryKey, $paymentId);
            return $this->db->get()->row();
        } catch (Exception $e) {
            log_message('error', 'Error finding payment with Id ' . $paymentId . ': ' . $e->getMessage());
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

    public function updateByOrderId($orderId, $data)
    {
        try {
            $this->db->where('order_id', $orderId);
            return $this->db->update($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error updating payment with Id ' . $paymentId . ': ' . $e->getMessage());
            return false;
        }
    }

    public function delete($paymentId)
    {
        try {
            $this->db->where($this->primaryKey, $paymentId);
            return $this->db->delete($this->table);
        } catch (Exception $e) {
            log_message('error', 'Error deleting payment with payment_id ' . $paymentId . ': ' . $e->getMessage());
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
                JOIN booking_details AS bd ON bd.booking_id = pa.booking_id
                JOIN room_codes AS rc ON rc.room_code_id = bd.room_code_id
                JOIN rooms AS ro ON ro.room_id = rc.room_id
                WHERE ro.hotel_id = ?
                AND bd.created_at BETWEEN ? AND ?
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

    public function confirmPaymentAndReservation($reservationId, $paymentId)
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

    public function cancelPaymentAndReservation($paymentId, $reservationId, $dataNote)
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
