<?php

class M_Home extends CI_Model {

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

    function getHitungPasar() {
        $pasar = $this->db->count_all_results('titik_distribusi');
        return $pasar;
    }

    /**
     * 
     * @param type $komoditas
     * @param type $tahun
     * @param type $idprov
     * @return type
     */
    public function getDataHargaByProvinsi($komoditas, $tahun, $idprov) {
        $results = array();
        $query = "SELECT AVG(h.harga) as HARGA, pro.ID_PROVINSI, MONTH(tanggal) as BULAN, DAY(tanggal) as TANGGAL "
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
                . "id_komoditas=" . $komoditas . " AND "
                . "YEAR(tanggal)=" . $tahun . " AND "
                . "pro.ID_PROVINSI=" . $idprov . " "
                . "GROUP BY pro.ID_PROVINSI, TANGGAL "
                . "ORDER BY "
                . "BULAN DESC, "
                . "TANGGAL DESC "
                . "LIMIT "
                . "7";
        $hasil = $this->db->query($query);
        if ($hasil->num_rows() > 0) {
            $results = $hasil;
        }

        return $results;
    }

    function getKenaikanTertinggi() {
        $results = null;
        $query = "SELECT
                h1.harga, ABS((h1.harga - h2.harga)/h2.harga)*100 as persentase
                FROM
                harga_distribusi h1,
                harga_distribusi h2
                WHERE
                h2.tanggal = '2015-08-21' AND
                h1.tanggal = '2015-08-22' AND
                h1.harga > h2.harga AND
                h1.id_titik = h2.id_titik
                ORDER BY
                ABS(h1.harga - h2.harga) DESC
                LIMIT
                1";
        $hasil = $this->db->query($query);
        if ($hasil->num_rows() > 0) {
            $results = $hasil->row();
        }

        return $results;
    }
    
    function getPenurunanTertinggi() {
        $results = null;
        $query = "SELECT
                h1.harga, ABS((h1.harga - h2.harga)/h2.harga)*100 as persentase
                FROM
                harga_distribusi h1,
                harga_distribusi h2
                WHERE
                h2.tanggal = '2015-08-21' AND
                h1.tanggal = '2015-08-22' AND
                h1.harga < h2.harga AND
                h1.id_titik = h2.id_titik
                ORDER BY
                ABS(h1.harga - h2.harga) DESC
                LIMIT
                1";
        $hasil = $this->db->query($query);
        if ($hasil->num_rows() > 0) {
            $results = $hasil->row();
        }

        return $results;
    }
    
    function getHargaTertinggi() {
        $query = "SELECT
                h1.harga,
                ABS((h1.harga - h2.harga)/h2.harga)*100 as persentase
                FROM
                harga_distribusi h1,
                harga_distribusi h2
                WHERE
                h2.tanggal = '2015-08-21' AND
                h1.tanggal = '2015-08-22' AND
                h1.id_titik = h2.id_titik
                ORDER BY
                h1.harga DESC
                LIMIT
                1";
        $hasil = $this->db->query($query);
        if ($hasil->num_rows() > 0) {
            $results = $hasil->row();
        }

        return $results;
    }
    
    function getHargaTerendah() {
        $query = "SELECT
                h1.harga,
                ABS((h1.harga - h2.harga)/h2.harga)*100 as persentase
                FROM
                harga_distribusi h1,
                harga_distribusi h2
                WHERE
                h2.tanggal = '2015-08-21' AND
                h1.tanggal = '2015-08-22' AND
                h1.id_titik = h2.id_titik
                ORDER BY
                h1.harga ASC
                LIMIT
                1";
        $hasil = $this->db->query($query);
        if ($hasil->num_rows() > 0) {
            $results = $hasil->row();
        }

        return $results;
    }

}
