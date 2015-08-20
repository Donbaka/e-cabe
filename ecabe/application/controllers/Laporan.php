<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function index() {
        $this->load->model('M_laporan');

        $data['laporan'] = $this->M_laporan->get_hargaPetani();

        $data['content'] = 'v_laporanHargaPetani';
//            $this->load->view('header');
        $this->load->view('template', $data);
//            $this->load->view('footer');
    }

}


