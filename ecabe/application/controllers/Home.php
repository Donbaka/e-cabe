<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Home');
    }

    public function index() {
        $data['content'] = 'v_home';
        $data['pasar'] = $this->M_Home->getHitungPasar();
        $this->load->view('template', $data);
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
