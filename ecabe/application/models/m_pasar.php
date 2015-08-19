<?php

class m_pasar extends CI_Model {

    function getLatLong() {
        $LatLong = array();
        $this->db->from("titik_distribusi");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $LatLong = $query->result();
        }
        return $LatLong;
    }

}
