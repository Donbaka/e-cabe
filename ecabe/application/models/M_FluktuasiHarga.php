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
    
    public function getDataGrafikByProvinsi($komoditas, $tahun, $idprov){
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
}
