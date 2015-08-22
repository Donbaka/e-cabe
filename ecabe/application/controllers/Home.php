<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Home');
        $this->load->model('M_Komoditas');
        $this->load->model('M_Lokasi');
    }

    public function index() {
        $data['content'] = 'v_home';
        $data['pasar'] = $this->M_Home->getHitungPasar();
        $data['kenaikanTertinggi'] = $this->M_Home->getKenaikanTertinggi()->harga;
        $data['persentasekenaikan'] = $this->M_Home->getKenaikanTertinggi()->persentase;
        $data['penurunanTertinggi'] = $this->M_Home->getPenurunanTertinggi()->harga;
        $data['persentasepenurunan'] = $this->M_Home->getPenurunanTertinggi()->persentase;
        
        $data['hargatertinggi'] = $this->M_Home->getHargaTertinggi()->harga;
        $data['persentasetertinggi'] = $this->M_Home->getHargaTertinggi()->persentase;
        $data['hargaterendah'] = $this->M_Home->getHargaTerendah()->harga;
        $data['persentaseterendah'] = $this->M_Home->getHargaTerendah()->persentase;
        
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
        $data['url'] = site_url().'/home/grafik/'.$p_komoditas.'/'.$p_tahun;
        
        $this->load->view('template', $data);
    }
    
    public function grafik($komoditas=1, $tahun=2015){
        $result = array();
        
        $provs = $this->M_Lokasi->get_top5provinsi(date('Y-m-d'), date('Y-m-d', strtotime(' -1 day')));
        $jenisKomoditas = $this->M_Komoditas->getKomoditasById($komoditas);
        
        $result['tahun'] = intval($tahun);
        $result['title'] = "Grafik Fluktuasi Harga ".$jenisKomoditas;
        $result['subtitle'] = "Perbandingan Rata-rata Harga ".$jenisKomoditas." tiap Provinsi Tahun ".$tahun;
        $result['satuan'] = "Tanggal";
        $result['data'] = array();
//        var_dump($provs);
        foreach($provs as $prov){
            $series = array();
            $data = $this->M_Home->getDataHargaByProvinsi($komoditas, $tahun, $prov->ID_PROVINSI);
            if($data){
                $series['name'] = $prov->NAMA;
                $series['data'] = $this->_pushDataHargaTanggal(array(), $data);
                
                array_push($result['data'], $series);
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }
    
    private function _pushDataHargaTanggal($arr, $data){
        foreach($data->result() as $row){
            $d['harga'] = floatval($row->HARGA);
            $d['bulan'] = intval($row->BULAN);
            $d['tanggal'] = intval($row->TANGGAL);
            array_push($arr, $d);
        }
        
        return $arr;
    }

    function grafikDistribusi() {
        $data_detail = $this->M_Home->getDataHargaDistribusi();
        $result = array();
        foreach ($data_detail->result() as $row) {
            $data["hc-key"] = $row->KODE_PETA;
            $data["value"] = $row->harga;
            array_push($result, $data);
        }
        echo json_encode($result, JSON_NUMERIC_CHECK);
    }

}
