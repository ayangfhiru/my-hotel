<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bed_model extends CI_Model
{
    protected $table = "beds";
    protected $primaryKey = "bed_id";

    public function all()
    {
        try {
            return $this->db->get($this->table)->result();
        } catch (Exception $e) {
            log_message('error', 'Error retrieving all beds: ' . $e->getMessage());
            return [];
        }
    }

    public function find($bedId)
    {
        try {
            $this->db->from($this->table);
            $this->db->where($this->primaryKey, $bedId);
            return $this->db->get()->row();
        } catch (Exception $e) {
            log_message('error', 'Error finding bed with ID ' . $bedId . ': ' . $e->getMessage());
            return null;
        }
    }

    public function create($data)
    {
        try {
            return $this->db->insert($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error creating bed: ' . $e->getMessage());
            return false;
        }
    }

    public function update($bedId, $data)
    {
        try {
            $this->db->where($this->primaryKey, $bedId);
            return $this->db->update($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error updating bed with Id ' . $bedId . ': ' . $e->getMessage());
            return false;
        }
    }

    public function delete($bedId)
    {
        try {
            $this->db->where($this->primaryKey, $bedId);
            return $this->db->delete($this->table);
        } catch (Exception $e) {
            log_message('error', 'Error deleting bed with Id ' . $bedId . ': ' . $e->getMessage());
            return false;
        }
    }
}
