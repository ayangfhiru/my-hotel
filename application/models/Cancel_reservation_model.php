<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cancel_reservation_model extends CI_Model
{
    protected $table = 'cancel_reservations';
    protected $primaryKey = 'cancel_reservation_id';

    public function all()
    {
        try {
            return $this->db->get($this->table)->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching all cancel reservations: ' . $e->getMessage());
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
            log_message('error', 'Error finding cancel reservation with ID ' . $id . ': ' . $e->getMessage());
            return null;
        }
    }

    public function create($data)
    {
        try {
            return $this->db->insert($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error creating cancel reservation: ' . $e->getMessage());
            return false;
        }
    }

    public function update($id, $data)
    {
        try {
            $this->db->where($this->primaryKey, $id);
            return $this->db->update($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error updating cancel reservation with ID ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            return $this->db->delete($this->table, [$this->primaryKey => $id]);
        } catch (Exception $e) {
            log_message('error', 'Error deleting cancel reservation with ID ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }

    public function create_multiple_tables($dataCancelled, $reservationId)
    {
        try {
            $this->db->trans_start();
            $this->db->insert($this->table, $dataCancelled);
            $this->db->where('reservation_id', $reservationId);
            $this->db->update('reservations', ['reservation_status' => 'cancelled']);
            if ($this->db->trans_complete()) {
                return true;
            } else {
                $this->db->trans_rollback();
                return false;
            }
        } catch (Exception $e) {
            log_message('error', 'Error in create_multiple_tables: ' . $e->getMessage());
            $this->db->trans_rollback();
            return false;
        }
    }
}
