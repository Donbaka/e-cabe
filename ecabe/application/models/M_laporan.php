<?php

class m_laporan extends CI_Model {

    function get_hargaPetani() {
        $results = array();
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('harga_petani');
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }
//    function insert_data($data){
//       $q= $this->db->insert('harga_distribusi', $data);
//        return $q;
//    }

}
