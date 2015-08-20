<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class inputHarga extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_inputHarga');
        $this->load->model('M_Lokasi');
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

      //  $data['alert']= '<script> $(function(){ setTimeout(function(){$.Notify({type: \'success\', caption: \'Success\', content: "Metro UI CSS is Sufficient!!!"}); }, 2000);     });  </script>';


        $data['provinsi'] = $this->M_Lokasi->get_provinsi();
        $data['komoditas'] = $this->m_inputHarga->get_komoditi();
        $data['content'] = 'v_inputHarga';

       // $this->load->view('header');
		$this->load->view('template',$data);
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
    public  function insertHarga()
    {
        $data = array(

            'id_komoditas' => $this->input->post('inputKomoditas'),
            'id_titik' => $this->input->post('inputTitik'),
            'harga' => $this->input->post('harga')
        );
       $result= $this->m_inputHarga->insert_data($data);
       // echo $result;
        if($result){


            $data['alert']= '<script> $(function(){ setTimeout(function(){$.Notify({type: \'success\', caption: \'Success\', content: "Data berhasil dimasukkan"}); }, 0);     });  </script>';

            $data['provinsi'] = $this->M_Lokasi->get_provinsi();
            $data['komoditas'] = $this->m_inputHarga->get_komoditi();

            $this->load->view('header');
            $this->load->view('v_inputHarga',$data);
            //$this->load->view('v_inputHarga',$alert);
        }
        else{

            $data['alert']= '<script> $(function(){ setTimeout(function(){$.Notify({type: \'warning\', caption: \'Warning\', content: "Data gagal dimasukkan"}); }, 0);     });  </script>';

            $data['provinsi'] = $this->M_Lokasi->get_provinsi();
            $data['komoditas'] = $this->m_inputHarga->get_komoditi();

            $this->load->view('header');
            $this->load->view('v_inputHarga',$data);
        }

    }
}
