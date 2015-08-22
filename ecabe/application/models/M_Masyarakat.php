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
}
