<?php

class m_inputHarga extends CI_Model {

    function get_provinsi() {
        $results = array();
        $this->db->order_by('NAMA', 'ASC');
        $query = $this->db->get('provinsi');
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }

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
