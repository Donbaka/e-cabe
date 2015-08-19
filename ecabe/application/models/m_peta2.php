<?php

class m_peta2 extends CI_Model {

    function getDataHargaDistribusi() {        
        $this->db->select('provinsi.KODE_PETA');
        $this->db->select_avg('harga_distribusi.harga');
        $this->db->from('harga_distribusi');
        $this->db->join("titik_distribusi", "titik_distribusi.id = harga_distribusi.id_titik");
        $this->db->join("kecamatan", "titik_distribusi.id_kecamatan = kecamatan.ID_KECAMATAN");
        $this->db->join("kabkota", "kecamatan.ID_KABKOTA = kabkota.ID_KABKOTA");
        $this->db->join("provinsi", "provinsi.ID_PROVINSI = kabkota.ID_PROVINSI");
        $this->db->group_by("provinsi.ID_PROVINSI");
        $data = $this->db->get();
        return $data;
    }

}
