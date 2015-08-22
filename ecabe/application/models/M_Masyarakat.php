<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_Masyarakat
 *
 * @author brlnt-super
 */
class M_Masyarakat extends CI_Model {
    public function getMasyarakat(){
        $results = array();
        $query = $this->db->get('hp_masyarakat');
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }
    
    public function getRankMasyarakat(){
        $results = array();
        $q= "SELECT m.id, m.nomor_hp, m.status, COUNT(h.id) as jumlah_kontribusi, COUNT(k.id) as jumlah_keluhan "
                . " FROM hp_masyarakat m "
                . " LEFT JOIN harga_distribusi h ON h.id_masyarakat = m.id "
                . " LEFT JOIN keluhan k ON k.id_masyarakat = m.id "
                . " GROUP BY m.id "
                . " ORDER BY jumlah_kontribusi DESC, status DESC;";
        $query = $this->db->query($q);
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }  
    
    public function getDetail($idmasy){
        $results = array();
        $query = "";
        return $results;
    }
    
    public function getKeluhanByIdMasy($idmasy){
        $results = array();
        $this->db->where('id_masyarakat', $idmasy);
        $query = $this->db->get('keluhan');
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }
    
    public function getKontribusiByIdMasy($idmasy){
        $results = array();
        $this->db->where('id_masyarakat', $idmasy);
        $query = $this->db->get('harga_distribusi');
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }
}