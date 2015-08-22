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
    
    public function getDetailMasy($idmasy){
        $results = array();
        $q= "SELECT m.id, m.nomor_hp, m.status, COUNT(h.id) as jumlah_kontribusi, COUNT(k.id) as jumlah_keluhan "
                . " FROM hp_masyarakat m "
                . " LEFT JOIN harga_distribusi h ON h.id_masyarakat = m.id "
                . " LEFT JOIN keluhan k ON k.id_masyarakat = m.id "
                . " WHERE m.id=".$idmasy." "
                . " GROUP BY m.id "
                . " ORDER BY jumlah_kontribusi DESC, status DESC;";
        $query = $this->db->query($q);
        if ($query->num_rows() > 0) {
            $results = $query->row();
        }
        return $results;
    }
    
    public function getMapByIdMasy($idmasy){
        $results = array();
        $q = "SELECT COUNT(m.id) as kontribusi, t.lat, t.`long`, t.nama "
            . " FROM hp_masyarakat m "
            . " LEFT JOIN harga_distribusi h ON h.id_masyarakat = m.id "
            . " LEFT JOIN titik_distribusi t ON t.id = h.id_titik "
            . " WHERE m.id=".$idmasy." "
            . " GROUP BY t.id;";
        $query = $this->db->query($q);
        
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }
    
    public function getKeluhanByIdMasy($idmasy){
        $results = array();
        $q = "SELECT k.id, k.subject, k.keluhan, kk.NAMA as kabkota, k.tanggal"
            . " FROM keluhan k "
            . " JOIN kabkota kk ON kk.ID_KABKOTA = k.id_kabupaten "
            . " WHERE k.id_masyarakat=".$idmasy;
        $query = $this->db->query($q);
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }
    
    public function getKontribusiByIdMasy($idmasy){
        $results = array();
        $q = "SELECT h.id, k.komoditas, t.nama, h.harga, h.tanggal "
            . " FROM hp_masyarakat m "
            . " LEFT JOIN harga_distribusi h ON h.id_masyarakat = m.id "
            . " LEFT JOIN komoditas k ON h.id_komoditas = k.id "
            . " LEFT JOIN titik_distribusi t ON t.id = h.id_titik "
            . " WHERE m.id=".$idmasy." "
            . " LIMIT 0,10;";
        $query = $this->db->query($q);
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }
}