<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faktur extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_total_harga($data_per_faktur) {
		$res = $rc = $msc = $ntr = 0;

		$rc = $this->route_charge($data_per_faktur);
		$msc = $this->meteo_service_charge($data_per_faktur);
		$ntr = $this->non_tax_revenue($data_per_faktur); 

		$res = $rc + $msc + $ntr;

		return $res * 10000;
	}

	private function route_charge($data_per_faktur) {
		$gross = 0;

		$route_unit = 111.2;
		$rate = $data_per_faktur["unit_rate_flight_dom"] > $data_per_faktur["unit_rate_flight_int"] ? 1 : 0.65;
		$allocation = $data_per_faktur["alokasi"] < 0.3 ? 1 : 0.86;
		$ppn = $data_per_faktur["unit_rate_flight_dom"] < $data_per_faktur["unit_rate_flight_int"] ? 0.1 : 1;

		$gross = $route_unit * $rate * $allocation * $ppn;

		return $gross;
	}

	private function meteo_service_charge($data_per_faktur) {
		$gross = 0;

		$route_unit = 111.2;
		$rate = $data_per_faktur["unit_rate_flight_dom"] > $data_per_faktur["unit_rate_flight_int"] ? 1 : 0.65;
		$allocation = $data_per_faktur["alokasi"] < 0.3 ? 1 : 0.04;
		$ppn = $data_per_faktur["unit_rate_flight_dom"] < $data_per_faktur["unit_rate_flight_int"] ? 0.1 : 1;

		$gross = $route_unit * $rate * $allocation * $ppn;

		return $gross;
	}

	private function non_tax_revenue($data_per_faktur) {
		$gross = 0;

		$route_unit = 111.2;
		$rate = $data_per_faktur["unit_rate_flight_dom"] > $data_per_faktur["unit_rate_flight_int"] ? 1 : 0.65;
		$allocation = $data_per_faktur["alokasi"] < 0.3 ? 1 : 0.1;
		$ppn = $data_per_faktur["unit_rate_flight_dom"] < $data_per_faktur["unit_rate_flight_int"] ? 0.1 : 1;

		$gross = $route_unit * $rate * $allocation * $ppn;

		return $gross;
	}

}