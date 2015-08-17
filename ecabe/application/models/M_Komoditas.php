<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_Komoditas
 *
 * @author brlnt-super
 */
class M_Komoditas extends CI_Model {
    public function getAllKomoditas(){
        $results = array();
        $query = "SELECT id, komoditas FROM cabe.komoditas;";
        $hasil = $this->db->query($query);
        if ($hasil->num_rows() > 0) {
            $results = $hasil->result();
        }
        return $results;
    }
    
    public function getKomoditasById($id){
        $result = null;
        $query = "SELECT id, komoditas FROM cabe.komoditas WHERE id=".$id.";";
        $hasil = $this->db->query($query);
        if ($hasil->num_rows() > 0) {
            $result = $hasil->row()->komoditas;
        }
        
        return $result;
    }
}
