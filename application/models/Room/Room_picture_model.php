<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Room_picture_model extends CI_Model
{
    protected $table = "room_pictures";
    protected $foreignKey1 = "room_id"; // references room

    public function all()
    {
        try {
            return $this->db->get($this->table)->result();
        } catch (Exception $e) {
            log_message("error", "Error fecting all room picture {$e->getMessage()}");
            return [];
        }
    }

    public function find($roomId)
    {
        try {
            $this->db->from($this->table);
            $this->db->where($this->foreignKey1, $roomId);
            return $this->db->get()->result();
        } catch (Exception $e) {
            log_message("error", "Error find room picture with id $roomId: {$e->getMessage()}");
            return false;
        }
    }

    public function update($roomId, $data)
    {
        try {
            $this->db->where($this->foreignKey1, $roomId);
            return $this->db->update($this->table, $data);
        } catch (Exception $e) {
            log_message("error", "Error updating room picture with id $roomId: {$e->getMessage()}");
            return false;
        }
    }

    public function delete($roomId)
    {
        try {
            $this->db->where($this->foreignKey1, $roomId);
            return $this->db->delete($this->table);
        } catch (Exception $e) {
            log_message("error", "Error deleting room picture with id $roomId: {$e->getMessage()}");
            return false;
        }
    }

    public function insertBatch($data)
    {
        try {
            return $this->db->insert_batch($this->table, $data);
        } catch (Exception $e) {
            log_message("error", "Error inserting batch room picture: {$e->getMessage()}");
            return false;
        }
    }

    public function getPicturesByHotel($hotelId, $limit = 4, $offset = 0)
    {
        $tableRoom = "rooms";
        try {
            $this->db->select("$this->table.*");
            $this->db->from($this->table);
            $this->db->join($tableRoom, "$this->table.$this->foreignKey1 = $tableRoom.$this->foreignKey1");
            $this->db->where("$tableRoom.$this->foreignKey1", $hotelId);
            $this->db->limit($limit, $offset);
            return $this->db->get()->result();
        } catch (Exception $e) {
            log_message("error", "Error fecting room picture with hotel id $hotelId: {$e->getMessage()}");
            return [];
        }
    }
}
