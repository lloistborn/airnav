<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library("Grocery_CRUD");

		$this->load->model("crud_model");
	}

	public function login() {
		$username = $this->input->post("username");
		$password = $this->input->post("password");

		$param = array("username" => $username, "password" => $password);

		try{
			$result = $this->crud_model->get_where("user", $param, $limit = TRUE);
			if($result) {
				$sessdata = array(
				        'username'  => $result['username'],
				        'role'     => $result["id_role"],
				        'logged_in' => TRUE
				);
				$this->session->set_userdata($sessdata);

				switch ($result["id_role"]) {
					case 1:
						redirect("admin");		
						break;
					case 2:		
						redirect("maskapai");		
						break;
					case 3:		
						redirect("manager");
						break;
				}
			}
		}catch(Exception $e){
			echo $e;
		}
	}

	public function logout() {	
		$this->session->sess_destroy();
	}
}