<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart_model extends CI_Model
{
    protected $table = "carts";
    protected $foreignKey1 = "user_id";
    protected $foreignKey2 = "room_id";

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
            $this->db->from($this->table);
            $this->db->where($data);
            $cek = $this->db->get()->row();
            if ($cek) {
                $this->db->set('quantity', 'quantity + 1', FALSE);
                $this->db->where($data);
                $this->db->update($this->table);
            } else {
                $this->db->insert($this->table, $data);
            }
            return true;
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
            $this->db->where($this->foreignKey1, $userId);
            $this->db->where($this->foreignKey2, $roomId);
            return $this->db->delete($this->table);
        } catch (Exception $e) {
            log_message('error', 'Error deleting cart with user_id ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }

    public function findRoomsByCart($userId, $data)
    {
        $tblRoom = "rooms";
        try {
            $this->db->from($this->table);
            $this->db->join($tblRoom, "{$this->table}.{$this->foreignKey2} = $tblRoom.{$this->foreignKey2}");
            $this->db->where("{$this->table}.{$this->foreignKey1}", $userId);
            $this->db->where_in("{$this->table}.{$this->foreignKey2}", $data);
            return $this->db->get()->result();
        } catch (Exception $e) {
            log_message('error', 'Error deleting cart with user_id ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }
}
