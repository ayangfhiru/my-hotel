<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking_model extends CI_Model
{
    protected $table = "bookings";
    protected $primaryKey = "booking_id";

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

    public function where($data)
    {
        try {
            $this->db->from($this->table);
            $this->db->where($data);
            return $this->db->get()->result();
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

    public function createBookingWithDetails0($dataBooking, $dataPayment, $bookingRequest, $services)
    {
        $randomCode = uniqid();
        $tableBoDet = "booking_details";
        $tablePay = "payments";
        $tableReq = "booking_requests";
        $tableExtReq = "booking_extra_services";
        try {
            $booking = [
                'booking_code' => strtoupper($randomCode),
            ];
            $this->db->trans_start();
            $this->db->insert($this->table, $booking);
            $bookingId = $this->db->insert_id();

            $dataBooking['booking_id'] = $bookingId;
            $this->db->insert($tableBoDet, $dataBooking);
            $bookingDetailId = $this->db->insert_id();

            $dataPayment['booking_id'] = $bookingId;
            $this->db->insert($tablePay, $dataPayment);

            if ($bookingRequest['request'] !== '') {
                $bookingRequest['booking_detail_id'] = $bookingDetailId;
                $this->db->insert($tableReq, $bookingRequest);
            }

            if (!empty($services)) {
                foreach ($services as &$service) {
                    $service['booking_detail_id'] = $bookingDetailId;
                }
                $this->db->insert_batch($tableExtReq, $services);
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

    public function createMultiBookingWithDetails($dataBooking, $dataPayment, $dataDetailBooking)
    {
        $tblBoDet = "booking_details";
        $tblPay = "payments";
        $tblPayDet = "payment_details";
        $tblReq = "booking_requests";
        $tblExtSer = "booking_extra_services";
        try {
            $this->db->trans_start();
            // memasukan data booking
            $this->db->insert($this->table, $dataBooking);
            $bookingId = $this->db->insert_id();

            // memasukan data payment
            $dataPayment['booking_id'] = $bookingId;
            $this->db->insert($tblPay, $dataPayment);
            $paymentId = $this->db->insert_id();

            foreach ($dataDetailBooking as $dataDetBo) {
                // memasukan data detail booking
                $dataDetBo['booking_detail']['booking_id'] = (int) $bookingId;
                $this->db->insert($tblBoDet, $dataDetBo['booking_detail']);
                $bookingDetailId = $this->db->insert_id();

                // memasukan data extra service
                if (!empty($dataDetBo['services'])) {
                    foreach ($dataDetBo['services'] as $dataExSer) {
                        $dataExSer['booking_detail_id'] = $bookingDetailId;
                        $this->db->insert($tblExtSer, $dataExSer);
                    }
                }

                // memasukan data request
                if ($dataDetBo['booking_request']['request'] !== null) {
                    $dataDetBo['booking_request']['booking_detail_id'] = $bookingDetailId;
                    $this->db->insert($tblReq, $dataDetBo['booking_request']);
                }

                // memasukan data payment detail
                $dataDetBo['payment_detail']['payment_id'] = $paymentId;
                $dataDetBo['payment_detail']['booking_detail_id'] = $bookingDetailId;
                $this->db->insert($tblPayDet, $dataDetBo['payment_detail']);
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

    public function getBookingByDateRange($hotelId, $checkIn, $checkOut)
    {
        try {
            $query = "SELECT rc.*, bd.*, pa.*,
            br.request, br.status AS status_request, br.cost,
            bc.cancel_note
            FROM room_codes AS rc
            LEFT JOIN booking_details AS bd ON rc.room_code_id = bd.room_code_id
            JOIN rooms AS ro ON rc.room_id = ro.room_id
            JOIN payments AS pa ON bd.booking_id = pa.booking_id
            LEFT JOIN booking_requests AS br ON bd.booking_detail_id = br.booking_detail_id
            LEFT JOIN booking_cancellations AS bc ON bc.booking_detail_id = bd.booking_detail_id
            WHERE ro.hotel_id = ?
            AND bd.check_out >= ?
            AND bd.check_in <= ?
            ORDER BY rc.room_code ASC, bd.check_in ASC";

            return $this->db->query($query, [$hotelId, $checkIn, $checkOut])->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching reservations for hotel_id ' . $hotelId . ' with check-in and check-out dates: ' . $e->getMessage());
            return [];
        }
    }

    public function cancelBooking($reservationId, $data)
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

    public function findAvailableRoomCodes($roomId, $checkIn, $checkOut)
    {
        try {
            $query = "SELECT rc.room_code_id
                    FROM room_codes rc
                    LEFT JOIN booking_details AS bd
                        ON rc.room_code_id = bd.room_code_id
                        AND NOT (
                            bd.check_out <= ? OR
                            bd.check_in >= ?
                        )
                    JOIN rooms AS ro ON rc.room_id = ro.room_id
                    JOIN beds AS be ON ro.bed_id = be.bed_id
                    WHERE ro.room_id = ? AND bd.booking_id IS NULL";

            return $this->db->query($query, [$checkIn, $checkOut, $roomId])->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching reservation rooms for room_id ' . $roomId . ': ' . $e->getMessage());
            return [];
        }
    }

    public function getGuestReservationDetails($userId)
    {
        try {
            $query = "SELECT re.*, pa.*, ho.*, ro.*, rc.room_code, cr.cancel_note
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

    public function foCreateBookingWithDetail($dataBo, $dataBoDetail, $dataBoReq)
    {
        $tblPay = "payments";
        $tblBoDetail = "booking_details";
        $tblBoExService = "booking_extra_services";
        $tblBoReq = "booking_requests";
        $tblPayDetail = "payment_details";
        try {
            $this->db->trans_start();
            // // Tambah data booking
            $this->db->insert($this->table, $dataBo);
            $bookingId = $this->db->insert_id();

            // Tambah data detail booking
            $dataBoDetail['booking_id'] = $bookingId;
            $this->db->insert($tblBoDetail, $dataBoDetail);
            $bookingDetailId = $this->db->insert_id();

            // Tambah data detail request
            $cleanValReq = trim($dataBoReq['request']);
            if (!empty($cleanValReq) && $cleanValReq !== '<p><br></p>') {
                $dataBoReq['booking_detail_id'] = $bookingDetailId;
                $this->db->insert($tblBoReq, $dataBoReq);
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
}
