<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pesawat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model("crud_model");
	}

	public function get_data_maskapai()
	{	
		$data_maskapai = $this->crud_model->get_all("data_maskapai")->result_array();
		
		return $data_maskapai;
	}
}
