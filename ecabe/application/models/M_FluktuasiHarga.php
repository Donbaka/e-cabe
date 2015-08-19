<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Class model untuk mendapatkan data fluktuaasi harga
 * berdasarkan parameter tertentu
 *
 * @author brlnt-super
 */
class M_FluktuasiHarga extends CI_Model{
    //put your code here
    public function getTahunAktif(){
        $results = array();
        $query = "SELECT DISTINCT YEAR(tanggal) as TAHUN FROM harga_distribusi;";
        $hasil = $this->db->query($query);
        if ($hasil->num_rows() > 0) {
            $results = $hasil->result();
        }
        return $results;
    }
    
    public function getDataHargaByProvinsi($komoditas, $tahun, $idprov){
        $results = array();
        $query = "SELECT AVG(h.harga) as HARGA, pro.ID_PROVINSI, MONTH(tanggal) as BULAN "
                . "FROM harga_distribusi h "
                . "JOIN titik_distribusi t "
                . " ON h.id_titik = t.id "
                . "JOIN kecamatan kec "
                . " ON t.id_kecamatan = kec.ID_KECAMATAN "
                . "JOIN kabkota kab "
                . " ON kec.ID_KABKOTA = kab.ID_KABKOTA "
                . "JOIN provinsi pro "
                . " ON kab.ID_PROVINSI = pro.ID_PROVINSI "
                . "WHERE "
                . "id_komoditas=".$komoditas." AND "
                . "YEAR(tanggal)=".$tahun." AND "
                . "pro.ID_PROVINSI=".$idprov." "
                . "GROUP BY pro.ID_PROVINSI, BULAN";
//        echo $query;
        $hasil = $this->db->query($query);
        if ($hasil->num_rows() > 0) {
            $results = $hasil;
        }
        
        return $results;
    }
    
    public function getDataHargaByKota($komoditas, $tahun, $idcity){
        $results = array();
        $query = "SELECT AVG(h.harga) as HARGA, kab.ID_KABKOTA, MONTH(tanggal) as BULAN "
                . "FROM harga_distribusi h "
                . "JOIN titik_distribusi t "
                . " ON h.id_titik = t.id "
                . "JOIN kecamatan kec "
                . " ON t.id_kecamatan = kec.ID_KECAMATAN "
                . "JOIN kabkota kab "
                . " ON kec.ID_KABKOTA = kab.ID_KABKOTA "
                . "WHERE "
                . "id_komoditas=".$komoditas." AND "
                . "YEAR(tanggal)=".$tahun." AND "
                . "kab.ID_KABKOTA=".$idcity." "
                . "GROUP BY kab.ID_KABKOTA, BULAN";
        
        $hasil = $this->db->query($query);
        if ($hasil->num_rows() > 0) {
            $results = $hasil;
        }
        
        return $results;
    }
    
    /**
     * Fungsi untuk mendapatkan data rata -rata harga jangka waktu tertentu
     * berdasarkan titik - titik distribusi
     * 
     * @param int $komoditas
     * @param int $tahun
     * @param int $idtitik
     * @return hasil query
     */
    public function getDataHargaByTitik($komoditas, $tahun, $idtitik) {
        $results = array();
        $query = "SELECT AVG(h.harga) as HARGA, h.id_titik, MONTH(tanggal) as BULAN "
                . " FROM harga_distribusi h "
                . " JOIN titik_distribusi t "
                . " ON h.id_titik = t.id "
                . " WHERE h.id_komoditas=".$komoditas." AND "
                . " YEAR(h.tanggal)=".$tahun." AND "
                . " h.id_titik=".$idtitik." "
                . " GROUP BY h.id_titik, BULAN";
        
        $hasil = $this->db->query($query);
        if ($hasil->num_rows() > 0) {
            $results = $hasil;
        }
        
        return $results;
    }
}
