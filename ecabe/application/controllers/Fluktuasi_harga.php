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
class Fluktuasi_harga extends CI_Controller {
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->load->model('M_FluktuasiHarga');
        $this->load->model('M_Komoditas');
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
    
    public function index()
    {
        if ($this->input->post('input-komoditas')) {
            $data['p_komoditas'] = $this->input->post('input-komoditas');
        } else {
            $data['p_komoditas'] = 1; // Komoditas default
        }
        
        if ($this->input->post('input-tahun')) {
            $data['p_tahun'] = $this->input->post('input-tahun');
        } else {
            $data['p_tahun'] = 2015; //Current Month
        }
        
        $data['komoditas'] = $this->M_Komoditas->getAllKomoditas();
        $data['tahun'] = $this->get_tahun_aktif();
        
        $this->load->view('header');
        $this->load->view('v_fluktuasi_harga', $data);
    }
    
    public function grafik($komoditas=1, $tahun=2015){
        $result = array();
        $this->load->model('M_Lokasi');
        
        $provs = $this->M_Lokasi->get_provinsi();
        $jenisKomoditas = $this->M_Komoditas->getKomoditasById($komoditas);;
        
        $result['tahun'] = intval($tahun);
        $result['title'] = "Grafik Fluktuasi Harga ".$jenisKomoditas;
        $result['subtitle'] = "Perbandingan Rata-rata Harga ".$jenisKomoditas." per-Provinsi Tahun ".$tahun;
        $result['data'] = array();
//        var_dump($provs);
        foreach($provs as $prov){
            $series = array();
            $data = $this->M_FluktuasiHarga->getDataGrafikByProvinsi($komoditas, $tahun, $prov->ID_PROVINSI);
            if($data){
                $series['name'] = $prov->NAMA;
                $series['data'] = array();
                foreach($data->result() as $row){
                   $d['harga'] = floatval($row->HARGA);
                   $d['bulan'] = intval($row->BULAN);
                   array_push($series['data'], $d);
                }
                
                array_push($result['data'], $series);
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }
    
    public function provinsi()
    {
        
    }
    public function kota()
    {
        
    }
}