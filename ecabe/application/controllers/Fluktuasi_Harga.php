<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fluktuasi_harga
 *
 * @author brlnt-super
 */
class Fluktuasi_Harga extends CI_Controller {
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->load->model('M_FluktuasiHarga');
        $this->load->model('M_Komoditas');
        $this->load->model('M_Lokasi');
    }
    
    public function get_tahun_aktif(){
        $tahun = $this->M_FluktuasiHarga->getTahunAktif();
        $output = array();
        
        foreach ($tahun as $t) {
            //here we build a dropdown item line for each query result
            array_push($output, $t->TAHUN);
        }
        
        return $output;
    }
    
    private function _pushDataHarga($arr, $data){
        foreach($data->result() as $row){
            $d['harga'] = floatval($row->HARGA);
            $d['bulan'] = intval($row->BULAN);
            array_push($arr, $d);
        }
        
        return $arr;
    }
    
    public function index()
    {
        if ($this->input->get('k')) {
            $p_komoditas = $this->input->get('k', TRUE);
        } else {
            $p_komoditas = 1; // Komoditas default
        }
        
        if ($this->input->get('t')) {
            $p_tahun = $this->input->get('t', TRUE);
        } else {
            $p_tahun= 2015; //Current Month
        }
        
        $data['title'] = "Indonesia";
        $data['komoditas'] = $this->M_Komoditas->getAllKomoditas();
        $data['tahun'] = $this->get_tahun_aktif();
        $data['url'] = site_url().'/fluktuasi_harga/grafik/'.$p_komoditas.'/'.$p_tahun;
        $data['form_url'] = 'fluktuasi_harga/index';
        $data['form_filter'] = 'v_grafik/filter_all';
        
        $data['content'] = 'v_fluktuasi_harga';
        $this->load->view('template', $data);
    }
    
    /**
     * 
     * @param type $komoditas
     * @param type $tahun
     */
    public function grafik($komoditas=1, $tahun=2015, $bulan=0, $tanggal=0){
        $result = array();
        
        $provs = $this->M_Lokasi->get_provinsi();
        $jenisKomoditas = $this->M_Komoditas->getKomoditasById($komoditas);
        
        $result['tahun'] = intval($tahun);
        $result['title'] = "Grafik Fluktuasi Harga ".$jenisKomoditas;
        $result['subtitle'] = "Perbandingan Rata-rata Harga ".$jenisKomoditas." tiap Provinsi Tahun ".$tahun;
        $result['satuan'] = "Bulan";
        $result['data'] = array();
//        var_dump($provs);
        foreach($provs as $prov){
            $series = array();
            $data = $this->M_FluktuasiHarga->getDataHargaByProvinsi($komoditas, $tahun, $bulan, $tanggal, $prov->ID_PROVINSI);
            if($data){
                $series['name'] = $prov->NAMA;
                $series['data'] = $this->_pushDataHarga(array(), $data);
                
                array_push($result['data'], $series);
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }
    
    public function index_provinsi()
    {   
        if ($this->input->get('k')) {
            $p_komoditas = $this->input->get('k', TRUE);
        } else {
            $p_komoditas = 1; // Komoditas default
        }
        
        if ($this->input->get('p')){
            $p_provinsi = $this->input->get('p', TRUE);
        } else {
            $p_provinsi = 31; // default jakarta
        }
        
        if ($this->input->get('t')) {
            $p_tahun = $this->input->get('t', TRUE);
        } else {
            $p_tahun= 2015; //Current Year
        }
        
        $data['provinsi'] = $this->M_Lokasi->get_provinsi();        
        $data['title'] = "Provinsi ".$this->M_Lokasi->getProvinsiById($p_provinsi)->NAMA;
        $data['komoditas'] = $this->M_Komoditas->getAllKomoditas();
        $data['tahun'] = $this->get_tahun_aktif();
        $data['url'] = site_url().'/fluktuasi_harga/grafik_provinsi/'.$p_komoditas.'/'.$p_provinsi.'/'.$p_tahun;
        $data['form_url'] = 'fluktuasi_harga/index_provinsi';
        $data['form_filter'] = 'v_grafik/filter_provinsi';
        
        $data['content'] = 'v_fluktuasi_harga';
        $this->load->view('template', $data);
    }
    
    /**
     * Fungsi untuk mendapatkan data grafik berdasarkan provinsi tertentu
     * @param int $komoditas
     * @param int $provinsi
     * @param int $tahun
     * @param int $bulan
     */
    public function grafik_provinsi($komoditas=1, $provinsi=31, $tahun=2015, $bulan=0, $hari=0)
    {
        $result = array();
        
        $nama_provinsi = $this->M_Lokasi->getProvinsiById($provinsi)->NAMA;
        $jenisKomoditas = $this->M_Komoditas->getKomoditasById($komoditas);
        
        $result['tahun'] = intval($tahun);
        $result['title'] = "Grafik Fluktuasi Harga ".$jenisKomoditas;
        $result['subtitle'] = "Perbandingan Rata-rata Harga ".$jenisKomoditas." di Provinsi ".$nama_provinsi." Tahun ".$tahun;
        $result['satuan'] = "Bulan";
        $result['data'] = array();
        
        $cities = $this->M_Lokasi->getKotaByProvinsi($provinsi);
        
        foreach($cities as $city){
            $series = array();
            $data = $this->M_FluktuasiHarga->getDataHargaByKota($komoditas, $tahun, $city->ID_KABKOTA);
            if($data){
                $series['name'] = $city->NAMA;
                $series['data'] = $this->_pushDataHarga(array(), $data);
                
                array_push($result['data'], $series);
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }
    
    /**
     * 
     */
    public function index_kota()
    {
        if ($this->input->get('k')) {
            $p_komoditas = $this->input->get('k', TRUE);
        } else {
            $p_komoditas = 1; // Komoditas default
        }
        
        if ($this->input->get('kab')){
            $p_kab = $this->input->get('kab', TRUE);
        } else {
            $p_kab = 3174; // default jakarta
        }
        
        if ($this->input->get('t')) {
            $p_tahun = $this->input->get('t', TRUE);
        } else {
            $p_tahun= 2015; //Current Year
        }
        
        $data['provinsi'] = $this->M_Lokasi->get_provinsi();
        
        $data['title'] = $this->M_Lokasi->getKotaById($p_kab)->NAMA;
        $data['komoditas'] = $this->M_Komoditas->getAllKomoditas();
        $data['tahun'] = $this->get_tahun_aktif();
        $data['url'] = site_url().'/fluktuasi_harga/grafik_kota/'.$p_komoditas.'/'.$p_kab.'/'.$p_tahun;
        $data['form_url'] = 'fluktuasi_harga/index_kota';
        $data['form_filter'] = 'v_grafik/filter_kota';
        
        $data['content'] = 'v_fluktuasi_harga';
        $this->load->view('template', $data);
    }
    
    public function grafik_kota($komoditas=1, $kota=3174, $tahun=2015, $bulan=0){
        $result = array();
        
        $nama_kota = $this->M_Lokasi->getKotaById($kota)->NAMA;
        $jenisKomoditas = $this->M_Komoditas->getKomoditasById($komoditas);
        
        $result['tahun'] = intval($tahun);
        $result['title'] = "Grafik Fluktuasi Harga ".$jenisKomoditas;
        $result['subtitle'] = "Perbandingan Rata-rata Harga ".$jenisKomoditas." di ".$nama_kota." Tahun ".$tahun;
        $result['satuan'] = "Bulan";
        $result['data'] = array();
        
        $spots = $this->M_Lokasi->getTitikByKota($kota);
        
        foreach($spots as $spot){
            $series = array();
            $data = $this->M_FluktuasiHarga->getDataHargaByTitik($komoditas, $tahun, $spot->ID);
            if($data){
                $series['name'] = $spot->NAMA;
                $series['data'] = $this->_pushDataHarga(array(), $data);
                
                array_push($result['data'], $series);
            }
        }
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }
    
    public function index_titik(){
        if ($this->input->get('k')) {
            $p_komoditas = $this->input->get('k', TRUE);
        } else {
            $p_komoditas = 1; // Komoditas default
        }
        
        if ($this->input->get('titik')){
            $p_titik = $this->input->get('titik', TRUE);
        } else {
            $p_titik = 1; // default jakarta
        }
        
        if ($this->input->get('t')) {
            $p_tahun = $this->input->get('t', TRUE);
        } else {
            $p_tahun= 2015; //Current Year
        }
        
        $data['provinsi'] = $this->M_Lokasi->get_provinsi();
        
        $data['title'] = $this->M_Lokasi->getTitikById($p_titik)->nama;
        $data['komoditas'] = $this->M_Komoditas->getAllKomoditas();
        $data['tahun'] = $this->get_tahun_aktif();
        $data['url'] = site_url().'/fluktuasi_harga/grafik_titik/'.$p_komoditas.'/'.$p_titik.'/'.$p_tahun;
        $data['form_url'] = 'fluktuasi_harga/index_kota';
        $data['form_filter'] = 'v_grafik/filter_kota';
        
        $data['content'] = 'v_fluktuasi_harga_hari';
        $this->load->view('template', $data);
    }
    
    public function grafik_titik($komoditas=1, $titik=1, $tahun=2015, $bulan=5){
        $result = array();
        
        $nama_titik = $this->M_Lokasi->getTitikById($titik)->nama;
        $jenisKomoditas = $this->M_Komoditas->getKomoditasById($komoditas);
        
        $result['tahun'] = intval($tahun);
        $result['title'] = "Grafik Fluktuasi Harga ".$jenisKomoditas;
        $result['subtitle'] = "Perbandingan Rata-rata Harga ".$jenisKomoditas." di ".$nama_titik." pada bulan ".$bulan." tahun ".$tahun;
        $result['satuan'] = "Tanggal";
        $result['data'] = array();
        
        $this->load->model('M_Masyarakat');
        $masyarakat = $this->M_Masyarakat->getMasyarakat();
        
        $no = 1;
        foreach($masyarakat as $m){
            $series = array();
            $data = $this->M_FluktuasiHarga->getDataHargaByMasy($komoditas, $titik, $m->id, $tahun, $bulan);
            if($data){
                $series['name'] = "Pelapor #".$no++;
                $series['data'] = array();
                foreach($data->result() as $row){
                    $d['harga'] = floatval($row->HARGA);
                    $d['tanggal'] = $row->tanggal;
                    $d['bulan'] = $row->bulan;
                    array_push($series['data'], $d);
                }
                
                array_push($result['data'], $series);
            }
        }
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }
    
    public function gap(){
        if ($this->input->get('k')) {
            $p_komoditas = $this->input->get('k', TRUE);
        } else {
            $p_komoditas = 1; // Komoditas default
        }
        
        if ($this->input->get('kota')){
            $p_kota = $this->input->get('kota', TRUE);
        } else {
            $p_kota = 3578; // default surabaya
        }
        
        if ($this->input->get('t')) {
            $p_tahun = $this->input->get('t', TRUE);
        } else {
            $p_tahun= 2015; 
        }
        
        if ($this->input->get('b')) {
            $p_bulan = $this->input->get('b', TRUE);
        } else {
            $p_bulan = 5; 
        }
        
        $data['provinsi'] = $this->M_Lokasi->get_provinsi();
        
        $data['title'] = "Grafik Perbandingan Harga Komoditas antara sentra produksi dengan sentra pasar pada ".$this->M_Lokasi->getKotaById($p_kota)->NAMA;
        $data['komoditas'] = $this->M_Komoditas->getAllKomoditas();
        $data['tahun'] = $this->get_tahun_aktif();
        $data['url'] = site_url().'/fluktuasi_harga/grafik_gap/'.$p_komoditas.'/'.$p_kota.'/'.$p_tahun.'/'.$p_bulan;
        $data['form_url'] = 'fluktuasi_harga/index_gap';
        $data['form_filter'] = 'v_grafik/filter_gap';
        
        $data['content'] = 'v_fluktuasi_harga_gap';
        $this->load->view('template', $data);
    }
    
    public function grafik_gap($komoditas=1, $kota=3578, $tahun=2015, $bulan=5){
        $result = array();
        
        $jenisKomoditas = $this->M_Komoditas->getKomoditasById($komoditas);
        
        $result['tahun'] = intval($tahun);
        $result['title'] = "Grafik Perbandingan Harga ".$jenisKomoditas;
        $result['subtitle'] = "Grafik Perbandingan Harga Komoditas antara sentra produksi dengan sentra pasar pada ".$this->M_Lokasi->getKotaById($kota)->NAMA;
        $result['satuan'] = "Tanggal";
        $result['data'] = array();
        
        $data = $this->M_FluktuasiHarga->getGapPetaniPasar($komoditas, $kota, $tahun, $bulan);
        
        $series['name'] = "Sentra Produksi";
        $series['data'] = array();
        foreach($data['petani'] as $row){
            $d['harga'] = floatval($row->harga);
            $d['tanggal'] = $row->tanggal;
            $d['bulan'] = $row->bulan;
            array_push($series['data'] , $d);
        }
        array_push($result['data'], $series);
        
        $series['name'] = "Sentra Pasar";
        $series['data'] = array();
        foreach($data['pasar'] as $row){
            $d['harga'] = floatval($row->harga);
            $d['tanggal'] = $row->tanggal;
            $d['bulan'] = $row->bulan;
            array_push($series['data'] , $d);
        }
        array_push($result['data'], $series);
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }
}