<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reservation_model extends CI_Model
{
    protected $table = 'reservations';
    protected $primaryKey = 'reservation_id';

    public function all()
    {
        try {
            return $this->db->get($this->table)->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching all reservations: ' . $e->getMessage());
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
            log_message('error', 'Error finding reservation with id ' . $id . ': ' . $e->getMessage());
            return null;
        }
    }

    public function create($data)
    {
        try {
            return $this->db->insert($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error creating reservation: ' . $e->getMessage());
            return false;
        }
    }

    public function update($id, $data)
    {
        try {
            $this->db->where($this->primaryKey, $id);
            return $this->db->update($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error updating reservation with id ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            return $this->db->delete($this->table, [$this->primaryKey => $id]);
        } catch (Exception $e) {
            log_message('error', 'Error deleting reservation with id ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }

    public function insert_multiple_tables($dataReservation, $dataPayment, $reservationRequest, $services)
    {
        try {
            $this->db->trans_start();
            $this->db->insert($this->table, $dataReservation);
            $reservationId = $this->db->insert_id();

            $dataPayment['reservation_id'] = $reservationId;
            $this->db->insert('payments', $dataPayment);

            if ($reservationRequest['request'] !== '' || $reservationRequest['note'] !== '') {
                $reservationRequest['reservation_id'] = $reservationId;
                $this->db->insert('reservation_request', $reservationRequest);
            }

            if (!empty($services)) {
                foreach ($services as &$service) {
                    $service['reservation_id'] = $reservationId;
                }
                $this->db->insert_batch('reservation_extra_service', $services);
            }

            if ($this->db->trans_complete()) {
                return true;
            } else {
                $this->db->trans_rollback();
                return false;
            }
        } catch (Exception $e) {
            $this->db->trans_rollback();
            log_message('error', 'Error inserting multiple tables: ' . $e->getMessage());
            return false;
        }
    }

    public function to_invoice($reservationId)
    {
        try {
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
        } catch (Exception $e) {
            log_message('error', 'Error fetching invoice for reservation_id ' . $reservationId . ': ' . $e->getMessage());
            return null;
        }
    }

    public function get_reservation($hotelId, $checkIn, $checkOut)
    {
        try {
            $query = "SELECT rc.*, re.*, pa.*, cr.note
                    FROM room_codes AS rc
                    LEFT JOIN reservations AS re ON rc.room_code_id = re.room_code_id
                    JOIN rooms AS ro ON rc.room_id = ro.room_id
                    JOIN payments AS pa ON re.reservation_id = pa.reservation_id
                    LEFT JOIN cancel_reservations AS cr ON cr.reservation_id = re.reservation_id
                    WHERE ro.hotel_id = ?
                    AND re.check_out >= ?
                    AND re.check_in <= ?
                    ORDER BY rc.room_code ASC, re.check_in ASC";

            return $this->db->query($query, [$hotelId, $checkIn, $checkOut])->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching reservations for hotel_id ' . $hotelId . ' with check-in and check-out dates: ' . $e->getMessage());
            return [];
        }
    }

    public function cancel_reservation($reservationId, $data)
    {
        try {
            $this->db->trans_start();
            $this->db->insert('cancel_reservations', $data);
            $this->db->where('reservation_id', $reservationId);
            $this->db->update($this->table, ['reservation_status' => 'cancelled']);

            if ($this->db->trans_complete()) {
                return true;
            } else {
                $this->db->trans_rollback();
                return false;
            }
        } catch (Exception $e) {
            $this->db->trans_rollback();
            log_message('error', 'Error cancelling reservation with reservation_id ' . $reservationId . ': ' . $e->getMessage());
            return false;
        }
    }

    public function get_reservation_room($roomId)
    {
        try {
            $query = "SELECT rc.room_code_id
                    FROM room_codes rc
                    LEFT JOIN reservations res
                        ON rc.room_code_id = res.room_code_id
                        AND NOT (
                            res.check_out <= @c_in OR
                            res.check_in >= @c_out
                        )
                    JOIN rooms AS ro ON rc.room_id = ro.room_id
                    JOIN beds AS be ON ro.bed_id = be.bed_id
                    WHERE ro.room_id = ? AND res.reservation_id IS NULL";

            return $this->db->query($query, [$roomId])->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching reservation rooms for room_id ' . $roomId . ': ' . $e->getMessage());
            return [];
        }
    }

    public function guest_detail_reservation($userId)
    {
        try {
            $query = "SELECT re.*, pa.*, ho.*, ro.*, rc.room_code, cr.note
                    FROM reservations AS re
                    JOIN payments AS pa ON re.reservation_id = pa.reservation_id
                    LEFT JOIN cancel_reservations AS cr ON re.reservation_id = cr.reservation_id
                    JOIN room_codes AS rc ON re.room_code_id = rc.room_code_id
                    JOIN rooms AS ro ON ro.room_id = rc.room_id
                    JOIN hotels AS ho ON ho.hotel_id = ro.hotel_id
                    WHERE re.user_id = ?
                    ORDER BY re.created_at DESC";

            return $this->db->query($query, [$userId])->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching guest reservation details for user_id ' . $userId . ': ' . $e->getMessage());
            return [];
        }
    }
}
