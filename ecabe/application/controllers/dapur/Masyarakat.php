<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Harus login terlebih dahulu untuk akses halaman ini
 * 
 *
 * @author brlnt-super
 */
class Masyarakat extends CI_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('M_Masyarakat');
        $this->load->library('googlemaps');
    }
    
    public function rank(){
        $data['masyarakat'] = $this->M_Masyarakat->getRankMasyarakat();
        $data['content'] = 'v_rank_masyarakat';
        $this->load->view('template', $data);
    }
    
    public function detail($idmasy){
        $data['detail'] = $this->M_Masyarakat->getDetailMasy($idmasy);
        $data['map'] = $this->_mapMasyarakat($idmasy);
        $data['keluhan'] = $this->M_Masyarakat->getKeluhanByIdMasy($idmasy);
        $data['kontribusi'] = $this->M_Masyarakat->getKontribusiByIdMasy($idmasy);
        
        $data['content'] = 'v_detail_masyarakat';
        $this->load->view('template', $data);
    }
    
    private function _mapMasyarakat($idmasy) {
        $config['zoom'] = "auto";
        $this->googlemaps->initialize($config);

        $coords = $this->M_Masyarakat->getMapByIdMasy($idmasy);

        foreach ($coords as $coordinate) {
            $marker = array();
            $marker['infowindow_content'] = "<table style=color:black>"
                    . "<tr>"
                    . " <td align='center' colspan='2'><strong>" . $coordinate->nama . "</strong></td>"
                    . "</tr>"
                    . "<tr>"
                    . " <td align='center' colspan='2'>" . $coordinate->kontribusi . " kontribusi</td>"
                    . "</tr>"
                . "</table>";
            
            $marker['position'] = $coordinate->lat . ',' . $coordinate->long;
            $this->googlemaps->add_marker($marker);
        }

        return $this->googlemaps->create_map();
    }
}
