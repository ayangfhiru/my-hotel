<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart_model extends CI_Model
{
    protected $table = 'carts';
    protected $key = 'user_id';

    public function all()
    {
        try {
            return $this->db->get($this->table)->result();
        } catch (Exception $e) {
            log_message('error', 'Error fetching all carts: ' . $e->getMessage());
            return [];
        }
    }

    public function find($id)
    {
        try {
            $query = "SELECT ca.*, ro.*, ho.name, ho.thumbnail
            FROM carts AS ca
            JOIN rooms AS ro ON ca.room_id = ro.room_id
            JOIN hotels AS ho ON ro.hotel_id = ho.hotel_id
            WHERE ca.user_id = ?
            ORDER BY ca.check_in DESC";
            return $this->db->query($query, [$id])->result();
        } catch (Exception $e) {
            log_message('error', 'Error finding cart with user_id ' . $id . ': ' . $e->getMessage());
            return [];
        }
    }

    public function create($data)
    {
        try {
            return $this->db->insert($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error creating cart: ' . $e->getMessage());
            return false;
        }
    }

    public function update($id, $data)
    {
        try {
            $this->db->where($this->key, $id);
            return $this->db->update($this->table, $data);
        } catch (Exception $e) {
            log_message('error', 'Error updating cart with user_id ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }

    public function delete($userId, $roomId)
    {
        try {
            $this->db->where('user_id', $userId);
            $this->db->where('room_id', $roomId);
            return $this->db->delete($this->table);
        } catch (Exception $e) {
            log_message('error', 'Error deleting cart with user_id ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }
}
