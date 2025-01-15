<?php
defined('BASEPATH') or exit('No direct script access allowed');

class R_picture extends CI_Model
{
    protected $table = 'room_pictures';
    protected $primaryKey = 'room_picture_id';

    public function all()
    {
        try {
            return $this->db->get($this->table)->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching all room pictures: ' . $e->getMessage());
            return [];
        }
    }

    public function many_create($data)
    {
        try {
            return $this->db->insert_batch($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error inserting multiple room pictures: ' . $e->getMessage());
            return false;
        }
    }

    public function update($id, $data)
    {
        try {
            $this->db->where($this->primaryKey, $id);
            return $this->db->update($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error updating room picture with id ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            return $this->db->delete($this->table, [$this->primaryKey => $id]);
        } catch (Exception $e) {
            log_message('error', 'Error deleting room picture with id ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }
}
