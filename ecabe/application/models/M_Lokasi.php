<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_Lokasi
 *
 * @author brlnt-super
 */
class M_Lokasi extends CI_Model{
    //put your code here
    function get_provinsi() {
        $results = array();
        $this->db->order_by('NAMA', 'ASC');
        $query = $this->db->get('provinsi');
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }
    
    function get_kabkota($prov) {
        $results = array();
        $this->db->where("ID_PROVINSI", $prov);
        $this->db->order_by('NAMA', 'ASC');
        $query = $this->db->get('kabkota');
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }
    
    function get_kecamatan($kabkota) {
        $results = array();
        $this->db->where("ID_KABKOTA", $kabkota);
        $this->db->order_by('NAMA', 'ASC');
        $query = $this->db->get('kecamatan');
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }
    
    function get_titik($kec) {
        $results = array();
        $this->db->where("id_kecamatan", $kec);
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get('titik_distribusi');
        if ($query->num_rows() > 0) {
            $results = $query->result();
            echo $query;
        }
        return $results;
    }
}