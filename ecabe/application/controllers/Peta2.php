<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Peta2 extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_peta2');
	}

	public function index() {
		$this->load->view('v_peta2');
	}

	function grafikDistribusi() {
		$data_detail = $this->m_peta2->getDataHargaDistribusi();
		$result = array();
		foreach ($data_detail->result() as $row) {
			$data["hc-key"] = $row->KODE_PETA;
			$data["value"] = $row->harga;
			array_push($result, $data);
		}
			// $category['data'][] = $row->harga;

		// $result = array();
		// array_push($result, $category);
		// array_push($result, $series1);
		// array_push($result, $series2);
		// array_push($result, $series3);
		echo json_encode($result, JSON_NUMERIC_CHECK);
	}

}
