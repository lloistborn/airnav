<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('pesawat.php');

class Alternatif extends CI_Controller {

	private $data;

	private $matrix_x;
	private $matrix_r;
	private $nilai_max;
	private $bobot = 0.00;

	public $header_data = array();

	public function __construct()
	{
		parent::__construct();

		$this->load->model("crud_model");
	}

	public function get_alternative() {
		$data = array();
		$pesawat = new Pesawat();

		$data_maskapai = $pesawat->get_data_maskapai();

		/* get bobot */
		foreach ($data_maskapai as $key_per_maskapai => $per_maskapai) {
			
			foreach ($per_maskapai as $key_maskapai => $value_maskapai) {
				$bobot = 0.00;

				switch ($key_maskapai) {
					case 'faktor_berat':
						$bobot = $this->_get_bobot_faktor_berat($value_maskapai);
						$this->matrix_x[$key_per_maskapai][0] = $bobot;

						break;
					
					case 'faktor_jarak':
						$bobot = $this->_get_bobot_faktor_jarak($value_maskapai);
						$this->matrix_x[$key_per_maskapai][1] = $bobot;

						break;

					case 'unit_rate_flight_dom':
						$bobot = $this->_get_bobot_rate_flight($value_maskapai);
						$this->matrix_x[$key_per_maskapai][2] = $bobot;

						break;

					case 'unit_rate_flight_int':
						$bobot = $this->_get_bobot_rate_flight($value_maskapai);
						$this->matrix_x[$key_per_maskapai][3] = $bobot;

						break;

					case 'alokasi':
						$bobot = $this->_get_bobot_alokasi($value_maskapai);
						$this->matrix_x[$key_per_maskapai][4] = $bobot;

						break;
				}	
			}
		}

		/* get nilai max */
		$max = 0;
		$total_field = count($this->matrix_x[0]);
		$total_matrix = count($this->matrix_x);

		for($i = 0; $i < $total_field; $i++) {
			for($j = 0; $j < $total_matrix; $j++) {
				$nilai_index = $this->matrix_x[$j][$i];

				if($nilai_index > $max) {
					$max = $nilai_index;
				}
			}
			$this->nilai_max[$i] = $max;
			$max = 0;
		}

		// echo "decision matrix_r <br>";
		for($i = 0; $i < $total_matrix; $i++) {
			for($j = 0; $j < $total_field; $j++) {
				$this->matrix_r[$i][$j] = $this->matrix_x[$i][$j] / $this->nilai_max[$j];
			}
		}

		// get nilai w
		for($j=0; $j < $total_field; $j++) {
			$this->w[$j] = $this->matrix_r[0][$j];		
		}

		// echo "alternatif terbaik dari setiap elemen di matrix R";
		$nilai_alt = 0;
		for($i = 0; $i < $total_matrix; $i++) {
			for($j = 0; $j < $total_field; $j++) {
				$nilai_alt += ($this->matrix_r[$i][$j] * $this->w[$j]); 
			}
			$temp[$i] = $nilai_alt;
			$nilai_alt = 0;
		}

		$data["data_maskapai"] = $data_maskapai;
		$data["hasil_saw"] = $temp;

		return $data;
	}

	private function _get_bobot_faktor_berat($faktor_berat) {
		$bobot = null;

		if ($faktor_berat < 93000) {
			$bobot = 1;
		}
		else if($faktor_berat == 93000) {
			$bobot = 3;
		}
		else if($faktor_berat > 93000) {
			$bobot = 5;
		}

		return $bobot;
	}

	private function _get_bobot_faktor_jarak($faktor_jarak) {
		$bobot = null;

		if($faktor_jarak < 2000) {
			$bobot = 1;
		}
		else if($faktor_jarak == 2000) {
			$bobot = 3;
		}
		else if($faktor_jarak > 2000) {
			$bobot = 5;
		}

		return $bobot;
	}

	private function _get_bobot_rate_flight($rate_flight) {
		$bobot = null;

		if ($rate_flight < 0.65) {
			$bobot = 1;
		}
		else if($rate_flight == 0.65) {
			$bobot = 3;
		}
		else if($rate_flight > 0.65) {
			$bobot = 5;
		}

		return $bobot;
	}

	private function _get_bobot_alokasi($alokasi) {
		$bobot = 0;

		if($alokasi < 0.3) {
			$bobot = 1;
		}
		else if($alokasi == 0.3) {
			$bobot = 3;
		}
		else if($alokasi > 0.3) {
			$bobot = 5;
		}
		return $bobot;
	}
}