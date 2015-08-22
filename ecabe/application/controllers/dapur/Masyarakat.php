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
    }
    
    public function rank(){
        $data['masyarakat'] = $this->M_Masyarakat->getRankMasyarakat();
        $data['content'] = 'v_rank_masyarakat';
        $this->load->view('template', $data);
    }
    
    public function detail($idmasy){
        $data['detail'] = $this->M_Masyarakat->getDetail();
    }
}
