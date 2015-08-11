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
    }
    
    public function index()
    {
        if ($this->input->post('inputKomoditas')) {
            $data['p_komoditas'] = $this->input->post('inputKomoditas');
        } else {
            $data['p_komoditas'] = 1; //Kode Provinsi Jawa Timur
        }
        
        if ($this->input->post('inputTahun')) {
            $data['p_tahun'] = $this->input->post('inputTahun');
        } else {
            $data['p_tahun'] = 2015; //Current Month
        }
        
        $this->load->view('header');
        $this->load->view('v_fluktuasi_harga', $data);
    }
    
    public function grafik($komoditas=1, $tahun=2015){
        $result = array();
        $this->load->model('M_Lokasi');
        $provs = $this->M_Lokasi->get_provinsi();
        
        $result['tahun'] = intval($tahun);
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