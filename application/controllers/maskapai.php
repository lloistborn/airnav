<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maskapai extends CI_Controller {

	public $header_data = array();

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->library('grocery_CRUD');
	}

	public function default_param($js = array(), $css = array()){
		$this->header_data['js_files'] = $js;
		$this->header_data['css_files'] = $css;
	}

	public function index() {
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('data_maskapai');
			$crud->set_subject('Data');
			$crud->required_fields('id');
			$crud->columns('kategori_tarif', 'faktor_berat', 'faktor_jarak', 'unit_rate_flight_dom', 'unit_rate_flight_int', 'alokasi', 'harga');

			$crud->unset_add();
			$crud->unset_edit();
			$crud->unset_delete();

			$output = $crud->render();

			$js = array(
					site_url().'assets/bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js',
					site_url().'assets/bootstrap/bower_components/metisMenu/dist/metisMenu.min.js',
					site_url().'assets/bootstrap/bower_components/raphael/raphael-min.js',
					site_url().'assets/bootstrap/bower_components/morrisjs/morris.min.js',
					site_url().'assets/bootstrap/js/morris-data.js',
					site_url().'assets/bootstrap/dist/js/sb-admin-2.js',
					);
			$css = array(
						site_url().'assets/bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css',
						site_url().'/assets/bootstrap/bower_components/metisMenu/dist/metisMenu.min.css',
						site_url().'assets/bootstrap/dist/css/timeline.css',
						site_url().'assets/bootstrap/dist/css/sb-admin-2.css',
						site_url().'assets/bootstrap/bower_components/morrisjs/morris.css',
						site_url().'assets/bootstrap/bower_components/font-awesome/css/font-awesome.min.css'
						);

			$js = array_merge($output->js_files, $js);
			$css = array_merge($output->css_files, $css);

			$this->default_param($js, $css);
			
			$this->load->view('_header_view', $this->header_data);
			$this->load->view('admin/alternatif', $output);
			$this->load->view('_footer_view', $this->header_data);
		}
		catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
}