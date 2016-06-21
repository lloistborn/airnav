<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');
	}

	private function _output_view($output = null)
	{
		$this->load->view('login', $output);
	}

	public function index()
	{

		$this->_output_view(
			(object)array(
				'output' => '', 
				'js_files' => array(
					site_url().'assets/bootstrap/bower_components/jquery/dist/jquery.min.js',
					site_url().'assets/bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js',
					site_url().'assets/bootstrap/bower_components/metisMenu/dist/metisMenu.min.js',
					site_url().'assets/bootstrap/bower_components/raphael/raphael-min.js',
					site_url().'assets/bootstrap/bower_components/morrisjs/morris.min.js',
					site_url().'assets/bootstrap/js/morris-data.js',
					site_url().'assets/bootstrap/dist/js/sb-admin-2.js',
					), 
				'css_files' => array(
					site_url().'assets/bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css',
					site_url().'/assets/bootstrap/bower_components/metisMenu/dist/metisMenu.min.css',
					site_url().'assets/bootstrap/dist/css/timeline.css',
					site_url().'assets/bootstrap/dist/css/sb-admin-2.css',
					site_url().'assets/bootstrap/bower_components/morrisjs/morris.css',
					site_url().'assets/bootstrap/bower_components/font-awesome/css/font-awesome.min.css'
					)
			)
		);
	}
}