<?php

class m_inputHarga extends CI_Model {

    function get_komoditi() {
        $results = array();
        $this->db->order_by('komoditas', 'ASC');
        $query = $this->db->get('komoditas');
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }
    function insert_data($data){
       $q= $this->db->insert('harga_distribusi', $data);
        return $q;
    }

}
