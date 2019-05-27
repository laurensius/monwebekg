<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_patient extends CI_Model {

    public function patient_insert($data){
        $this->db->insert("patient",$data);
        return $this->db->affected_rows();
    }

    public function patient_current(){
        $this->db->select("*");
        $this->db->from("patient");
        $this->db->where("status = 'OPEN' or status = 'PROCESS'");
        $this->db->order_by("id","desc");
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }


    public function patient_riwayat(){
        $this->db->select("*");
        $this->db->from("patient");
        $this->db->where("status = 'CLOSE'");
        $this->db->order_by("id","desc");
        $this->db->limit(25);
        $query = $this->db->get();
        return $query->result();
    }


    public function patient_detail($where){
        $this->db->select("*");
        $this->db->from("patient");
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    public function patient_update_status($id,$data){
        $this->db->where("id",$id);
        $this->db->update("patient",$data);
        return $this->db->affected_rows();
    }

}