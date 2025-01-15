<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{
    public function detail($reservationId)
    {
        try {
            $query = "SELECT re.*, pa.*, rr.*,
                    GROUP_CONCAT(DISTINCT es.service_name ORDER BY es.service_id) AS service_name,
                    GROUP_CONCAT(DISTINCT es.service_price ORDER BY es.service_id) AS service_price,
                    GROUP_CONCAT(DISTINCT res.quantity ORDER BY res.service_id) AS service_quantity,
                    GROUP_CONCAT(DISTINCT res.total_price ORDER BY res.service_id) AS total_price,
                    ro.*, be.bed_name, ho.name AS hotel_name, ho.city AS hotel_city, ho.telepon AS hotel_telp
                    FROM reservations AS re
                    JOIN payments AS pa ON re.reservation_id = pa.reservation_id
                    JOIN reservation_request AS rr ON re.reservation_id = rr.reservation_id
                    JOIN reservation_extra_service AS res ON re.reservation_id = res.reservation_id
                    JOIN extra_services AS es ON res.service_id = es.service_id
                    JOIN room_codes AS rc ON re.room_code_id = rc.room_code_id
                    JOIN rooms AS ro ON rc.room_id = ro.room_id
                    JOIN beds AS be ON ro.bed_id = be.bed_id
                    JOIN hotels AS ho ON ro.hotel_id = ho.hotel_id
                    WHERE re.reservation_id = ?
                    GROUP BY pa.payment_id, rr.reservation_id, rr.request, rr.note, rr.`status`, rr.cost";

            return $this->db->query($query, [$reservationId])->row();
        } catch (Exception $e) {
            log_message('error', 'Error retrieving all beds: ' . $e->getMessage());
            return [];
        }
    }
}
