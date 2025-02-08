<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_detail_model extends CI_Model
{
    protected $table = "payment_details";
    protected $foreignKey1 = "payment_id"; // references payment
    protected $foreignKey2 = "booking_detail_id"; // references booking_detail

    public function paymentDetail($payId)
    {
        $tblBoDet = "booking_details";
        $tblBoReq = "booking_requests";
        $this->db->from($this->table);
        $this->db->join($tblBoDet, "{$this->table}.{$this->foreignKey2} = $tblBoDet.{$this->foreignKey2}");
        $this->db->join($tblBoReq, "$tblBoDet.{$this->foreignKey2} = $tblBoReq.{$this->foreignKey2}", 'left');
        $this->db->where($this->foreignKey1, $payId);
        return $this->db->get()->result();
    }
}
