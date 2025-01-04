<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cancel_reservation_model extends CI_Model
{
    protected $table = 'cancel_reservations';
    protected $primaryKey = 'cancel_reservation_id';

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

    // insert cancel_reservation dan update reservation -> reservation_status
    public function create_multiple_tables($dataCancelled, $reservationId)
    {
        $this->db->trans_start();
        // insert cancel_reservation
        $this->db->insert($this->table, $dataCancelled);
        // update reservation -> reservation_status to cancelled
        $this->db->where('reservation_id', $reservationId);
        $this->db->update('reservations', ['reservation_status' => 'cancelled']);
        if ($this->db->trans_complete()) {
            return true;
        } else {
            $this->db->trans_rollback();
            return false;
        }
    }
}
