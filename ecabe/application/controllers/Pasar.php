<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pasar extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_pasar');
        $this->load->library('googlemaps');
    }

    public function index() {
        $data['map'] = $this->petaPasar();
        $this->load->view('header');
        $this->load->view('v_pasar', $data);
        $this->load->view('footer');
    }

    function petaPasar() {
        $config['zoom'] = "auto";
        $this->googlemaps->initialize($config);

        $coords = $this->m_pasar->getLatLong();

        foreach ($coords as $coordinate) {
            $marker = array();
            $marker['infowindow_content'] = "<table style=color:black>"
                    . "<tr>"
                    . "    <td align='center' colspan='2'><h3><strong>" . $coordinate->nama . "</strong></h3></td>"
                    . "</tr>"
                . "</table>";
            
            $marker['position'] = $coordinate->lat . ',' . $coordinate->long;
            $this->googlemaps->add_marker($marker);
        }

        return $this->googlemaps->create_map();
    }

    function formatRp($angka) {
        $rupiah = "Rp " . number_format($angka, 2, ',', '.');
        return $rupiah;
    }
}
