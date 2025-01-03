<?php
defined('BASEPATH') or exit('No direct script access allowed');

class R_facility extends CI_Model
{
    protected $table = 'room_facility';

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

    public function where($data)
    {
        $this->db->from($this->table);
        $this->db->where($data);
        $this->db->join('facilities', "$this->table.facility_id = facilities.facility_id", 'right');
        return $this->db->get()->result();
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

    public function get_facility($roomId)
    {
        $query = "SELECT fa.*, rf.room_id
            FROM facilities AS fa
            left JOIN room_facility AS rf
            ON fa.facility_id = rf.facility_id
            AND rf.room_id = $roomId";
        return $this->db->query($query)->result();
    }
}
