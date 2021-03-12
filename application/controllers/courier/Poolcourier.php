<?php

class Poolcourier extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->onLoad();
	}

	public function index()
	{
		$this->data[MASTER_PAGES]["courier/poolcourier"] = array();
		$this->load->view("layout", $this->data);
	}

	public function getDataTableResultfromApi()
	{
		$columns = array(
			0 => 'cargo_id',
			1 => 'cargo_user_id',
			2 => 'cargo_description',
			3 => 'cargo_weight',
			4 => 'cargo_volume',
			5 => 'cargo_price',
			6 => 'cargo_vehicle_id',
			7 => 'cargo_adress_from_district_key',
			8 => 'cargo_adress_to_district_key',
			9 => 'cargo_delivery_time',
			10=> 'islem'
		);
    	$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
		//echo $order . " ". $dir;
		$nestedData = array();
		$data = array();
		$url = "http://localhost/onlinecourier_api/GetDb/GetCargofromDb";
		$rulesforquery = array(
			"col" => $order,
			"dir" => $dir,
			"where" => array(
				"cargo_row_status" => 1
			),
			"join" => array(
				"user" => "user.user_id = cargo.cargo_user_id",
				"vehicle" => "vehicle.vehicle_id = cargo.cargo_vehicle_id",
				"district as d1" => "d1.ilce_id = cargo.cargo_adress_to_district_key",
				"district as d2" => "d2.ilce_id = cargo.cargo_adress_from_district_key"
			),
			"join_type" => "inner",
			"is_numeric" => true
		);
		$this->curly->post($url,json_encode($rulesforquery));
		$response = $this->curly->getResponse();
		$totalData = 0;
		$totalFiltered = 0;
		if ($response["response_code"] >= 200 && $response["response_code"] < 300) {
			$decoded_result_data = json_decode($response["response_data"], true);
			$totalData = $decoded_result_data;
			$totalFiltered = $totalData;
		}

		$is_array_empty = true;

		$search_table = "cargo";
		$search_array = array(
			$search_table."_weight" => "where",
			$search_table."_description" => "like",
			$search_table."_volume" => "where",
			$search_table."_delivery_time" => "where",
			$search_table."_vehicle_id" => "where",
			$search_table."_price" => "where",
			$search_table."_weight_unit" => "where",
		);

		$rulesforquery = array();
		$search_post_data = $this->input->post();
		//print_r($search_post_data);
		if (!empty($search_post_data)) {
			foreach ($search_post_data as $key => $value) {
				if (isset($value) && !empty($value)) {
					foreach ($search_array as $svalue => $skey) {
						if ($svalue == $key) {
							$rulesforquery[$skey][$svalue] = $value;
							$is_array_empty = false;
						}
					}
				}
			}
		}


		if (!$is_array_empty) {
			$rulesforquery = array_merge($rulesforquery, array(
				"limit" => $limit,
				"start" => $start,
				"col" => $order,
				"dir" => $dir,
				"join" => array(
					"user" => "user.user_id = cargo.cargo_user_id",
					"vehicle" => "vehicle.vehicle_id = cargo.cargo_vehicle_id",
					"district as d1" => "d1.ilce_id = cargo.cargo_adress_to_district_key",
					"district as d2" => "d2.ilce_id = cargo.cargo_adress_from_district_key"
				),
				"join_type" => "inner",
				"is_numeric" => null
			));
			$url = "http://localhost/onlinecourier_api/GetDb/GetCargofromDb";
			$this->curly->post($url,json_encode($rulesforquery));
			$response = $this->curly->getResponse();
			if ($response["response_code"] >= 200 && $response["response_code"] < 300) {
				$decoded_result_data = json_decode($response["response_data"], true);
				$posts = $decoded_result_data["resultcargo"]["result"];
			}
			unset($rulesforquery["limit"]);
			unset($rulesforquery["start"]);
			$rulesforquery["is_numeric"] = true;
			$url = "http://localhost/onlinecourier_api/GetDb/GetCargofromDb";
			$this->curly->post($url,json_encode($rulesforquery));
			$response = $this->curly->getResponse();
			if ($response["response_code"] >= 200 && $response["response_code"] < 300) {
				$decoded_result_data = json_decode($response["response_data"], true);
				$totalFiltered  = $decoded_result_data;
			}
		} else {
			$rulesforquery = array(
				"limit" => $limit,
				"start" => $start,
				"col" => $order,
				"dir" => $dir,
				"join" => array(
					"user" => "user.user_id = cargo.cargo_user_id",
					"vehicle" => "vehicle.vehicle_id = cargo.cargo_vehicle_id",
					"district as d1" => "d1.ilce_id = cargo.cargo_adress_to_district_key",
					"district as d2" => "d2.ilce_id = cargo.cargo_adress_from_district_key"
				),
				"join_type" => "inner",
				"where" => array(
					"user_row_status" => 1
				),
				"is_numeric" => null
			);
			$url = "http://localhost/onlinecourier_api/GetDb/GetCargofromDb";
			$this->curly->post($url,json_encode($rulesforquery));
			$response = $this->curly->getResponse();

			if ($response["response_code"] >= 200 && $response["response_code"] < 300) {
				$decoded_result_data = json_decode($response["response_data"], true);
				$posts = $decoded_result_data["resultcargo"]["result"];

			}
		}

		foreach ($posts as $result_key => $result) {
			$nestedData["cargo_id"] = $result["cargo_id"] ;
			$nestedData["cargo_user_id"] = $result["user_name"]." ".$result["user_surname"];
			$nestedData["cargo_description"] = $result["cargo_description"];
			$nestedData["cargo_weight"] = $result["cargo_weight"]. " ".$result["cargo_weight_unit"] ;
			$nestedData["cargo_volume"] = $result["cargo_volume"];
			$nestedData["cargo_price"] = $result["cargo_price"];
			$nestedData["cargo_vehicle_id"] = $result["vehicle_type"];
			$nestedData["cargo_adress_from_district_key"] = $result["ilce_title"];
			$nestedData["cargo_adress_to_district_key"] = $result["ilce_title"];
			$nestedData["cargo_delivery_time"] = $result["cargo_delivery_time"];
			$nestedData["islem"] = "<a href='#' class='btn btn-outline-success '>Teslim Et</a>";


			$data[] = $nestedData;
		}

		$json_data = array(
			"draw" => intval($this->input->post('draw')),
			"recordsTotal" => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data" => $data
		);
		echo json_encode($json_data);
	}

	private function onLoad()
	{
		$this->data[HEADER_STYLES] = array(
			base_url() . "assets/plugins/fontawesome-free/css/all.min.css",
			base_url() . "assets/plugins/sweetalert2/sweetalert2.min.css",
			base_url() . "assets/plugins/toastr/toastr.min.css",
			base_url() . "assets/dist/css/adminlte.min.css",
			base_url() . "assets/plugins/select2/css/select2.min.css",
			base_url() . "assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css",
			"https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback",
			base_url() . "assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css",
			base_url() . "assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css",
			base_url() . "assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css",
		);

		$this->data[CUSTOM_STYLES] = array(
			base_url() . "assets/dist/css/footer.css"
		);

		$this->data[MASTER_PAGES] = array(
			"masterpages/navbar" => array(),
		);

		$this->data[FOOTER_SCRIPTS] = array(
			base_url() . "assets/plugins/jquery/jquery.min.js",
			base_url() . "assets/plugins/bootstrap/js/bootstrap.bundle.min.js",
			base_url() . "assets/plugins/sweetalert2/sweetalert2.min.js",
			base_url() . "assets/plugins/toastr/toastr.min.js",
			base_url() . "assets/dist/js/adminlte.min.js",
			base_url() . "assets/dist/js/jquery-3.5.1.min.js",
			base_url() . "assets/dist/js/jquery.inputmask.bundle.js",
			base_url() . "assets/plugins/select2/js/select2.full.min.js",
			base_url() . "assets/plugins/datatables/jquery.dataTables.min.js",
			base_url() . "assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js",
			base_url() . "assets/plugins/datatables-responsive/js/dataTables.responsive.min.js",
			base_url() . "assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js",
			base_url() . "assets/plugins/datatables-buttons/js/dataTables.buttons.min.js",
			base_url() . "assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js",
			base_url() . "assets/plugins/datatables-buttons/js/buttons.html5.min.js",
			base_url() . "assets/plugins/datatables-buttons/js/buttons.print.min.js",
			base_url() . "assets/plugins/datatables-buttons/js/buttons.colVis.min.js",
		);

		$this->data[FOOTER] = array(
			"masterpages/footer" => array()
		);
		//http://localhost/onlinecourier/Poolcourier/getDataTableResultfromApi
		$this->data[CUSTOM_SCRIPTS] = array(
			"courier/assets/js/poolcourierscripts" => array(
				"ajax_url" =>  base_url() . "courier/Poolcourier/getDataTableResultfromApi"
			)
		);
	}
}
