<?php

/**
 * Description of Lokasi
 *
 * @author brlnt-super
 */
class Lokasi extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('M_Lokasi');
    }
    
    public function getKabKota() {
        echo $id_prov = $this->input->post('id_prov', TRUE);
        $data['kk'] = $this->M_Lokasi->get_kabkota($id_prov);
        $output = null;
        foreach ($data['kk'] as $row) {
            //here we build a dropdown item line for each query result
            $output .= "<option value='" . $row->ID_KABKOTA . "'>" . $row->NAMA . "</option>";
        }
        echo $output;
    }

    public function getKec() {
        echo $id_kabkota = $this->input->post('id_kabkota', TRUE);
        $data['k'] = $this->M_Lokasi->get_kecamatan($id_kabkota);
        $output = null;
        foreach ($data['k'] as $row) {
            //here we build a dropdown item line for each query result
            $output .= "<option value='" . $row->ID_KECAMATAN . "'>" . $row->NAMA . "</option>";
        }
        echo $output;
    }

    public function getTitik() {
        echo $id_kecamatan = $this->input->post('id_kecamatan', TRUE);
        $data['kkk'] = $this->M_Lokasi->get_titik($id_kecamatan);
        $output = null;
        foreach ($data['kkk'] as $row) {
            //here we build a dropdown item line for each query result
            $output .= "<option value='" . $row->id . "'>" . $row->nama . "</option>";
        }
        echo $output;
    }
}
