<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_bpm extends CI_Model {

    public function bpm_insert($data){
        $this->db->insert('bpm',$data);
        return $this->db->affected_rows();
    }

    public function bpm_monitoring($data){
        $this->db->select("*");
        $this->db->from("bpm");
        $this->db->where($data);
        $this->db->limit(25);
        $query = $this->db->get();
        return $query->result();
    }

    public function bpm_detail($where){
        $this->db->select("*");
        $this->db->from("bpm");
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
}