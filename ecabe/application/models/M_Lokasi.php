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
class M_Lokasi extends CI_Model {

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

    function get_top5provinsi($today, $yesterday) {
        $results = array();
        $query = "SELECT
            pro.ID_PROVINSI,
            pro.NAMA
            FROM
            harga_distribusi h1,
            harga_distribusi h2
            JOIN titik_distribusi t
            ON h2.id_titik = t.id
            JOIN kecamatan kec
            ON t.id_kecamatan = kec.ID_KECAMATAN
            JOIN kabkota kab
            ON kec.ID_KABKOTA = kab.ID_KABKOTA
            JOIN provinsi pro
            ON kab.ID_PROVINSI = pro.ID_PROVINSI
            WHERE
            h2.tanggal = '".$yesterday."' AND
            h1.tanggal = '".$today."' AND
            h1.id_titik = h2.id_titik
            ORDER BY
            ABS(h1.harga - h2.harga) DESC
            LIMIT
            5";
        $hasil = $this->db->query($query);
        if ($hasil->num_rows() > 0) {
            $results = $hasil->result();
        }

        return $results;
    }

    function getProvinsiById($idprovinsi) {
        $result = null;
        $this->db->where("ID_PROVINSI", $idprovinsi);
        $query = $this->db->get('provinsi');
        if ($query->num_rows() > 0) {
            $result = $query->row();
        }
        return $result;
    }

    function getKotaById($idkota) {
        $result = null;
        $this->db->where("ID_KABKOTA", $idkota);
        $query = $this->db->get('kabkota');
        if ($query->num_rows() > 0) {
            $result = $query->row();
        }
        return $result;
    }

    function getTitikById($idtitik) {
        $result = null;
        $this->db->where("id", $idtitik);
        $query = $this->db->get('titik_distribusi');
        if ($query->num_rows() > 0) {
            $result = $query->row();
        }
        return $result;
    }

    function getKotaByProvinsi($idprovinsi) {
        $result = array();
        $this->db->where("ID_PROVINSI", $idprovinsi);
        $query = $this->db->get('kabkota');
        if ($query->num_rows() > 0) {
            $result = $query->result();
        }
        return $result;
    }

    function getTitikByKota($idkota) {
        $result = array();
        $query = "SELECT t.id as ID, t.nama as NAMA"
                . " FROM titik_distribusi t "
                . " JOIN kecamatan k ON t.id_kecamatan = k.ID_KECAMATAN "
                . " JOIN kabkota kab ON k.ID_KABKOTA = kab.ID_KABKOTA "
                . " WHERE kab.ID_KABKOTA=" . $idkota . " "
                . " GROUP BY t.id ";

        $hasil = $this->db->query($query);
        if ($hasil->num_rows() > 0) {
            $result = $hasil->result();
        }

        return $result;
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
