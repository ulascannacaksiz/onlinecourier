<?php
class Poolcourier extends MY_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->onLoad();
	}

	public function index(){
		$this->data[MASTER_PAGES]["courier/poolcourier"] = array();
		$this->load->view("layout",$this->data);
	}

	public  function getCargoDatafromApi(){
		$url = "http://localhost/onlinecourier_api/GetDb/GetCargofromDb";
		$this->curly->get($url);
		$response = $this->curly->getResponse();
		if($response["response_code"] >= 200 && $response["response_code"] < 300){
			$this->createDataTable($response["response_data"]);
		}
	}

	private function createDataTable($result_data){
		$columns = array(
			0 => 'no',
			1 => 'gönderen',
			2 => 'açıklama',
			3 => 'ağırlık/ağırlık birimi',
			4 => 'hacim',
			5 => 'ücret',
			6 => 'varış noktası',
			7 => 'teslim tarihi',
			8 => 'işlem'
		);
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
		$nestedData = array();
		$data = array();
		$rulesforquery = array(
			"col" => $order,
			"dir" => $dir,
			"where" => array(
				"user_row_status" => 1
			),
			"join" => array(
				"_group" => "_user.group_id = _group.group_id"
			)
		);
		$tablename = "_user";
		$totalData = $this->UserModel->getResultfromDB($rulesforquery, $tablename, true);
		$totalFiltered = $totalData;
		$is_array_empty = true;
		$search_key = null;
		$search_value = null;
		$search_table = "_user";
		$search_array = array(
			"$search_table.user_id" => "where",
			"$search_table.name" => "like",
			"$search_table.surname" => "like",
			"$search_table.email" => "like",
			"$search_table.group_id" => "where",
			"$search_table.user_is_active" => "where",
		);

		$rulesforquery = array();
		$search_post_data = $this->input->post();

		if (!empty($search_post_data)) {
			foreach ($search_post_data as $key => $value) {
				if (isset($value) && !empty($value)) {
					foreach ($search_array as $svalue => $skey) {
						if($svalue == "$search_table.".$key) {
							$rulesforquery[$skey][$svalue] = $value;
							$is_array_empty = false;
						}
					}
				}
			}
		}

		if (!$is_array_empty) {
			$rulesforquery["where"]["user_row_status"] = 1;
			$rulesforquery = array_merge($rulesforquery, array(
				"limit" => $limit,
				"start" => $start,
				"col" => $order,
				"dir" => $dir,
				"join" => array(
					"_group" => "_user.group_id = _group.group_id"
				)
			));
			$tablename = "_user";
			$posts = $this->UserModel->getResultfromDB($rulesforquery, $tablename);
			unset($rulesforquery["limit"]);
			unset($rulesforquery["start"]);
			$totalFiltered = $this->UserModel->getResultfromDB($rulesforquery, $tablename, true);

		} else {
			$rulesforquery = array(
				"limit" => $limit,
				"start" => $start,
				"col" => $order,
				"dir" => $dir,
				"join" => array(
					"_group" => "_user.group_id = _group.group_id"
				),
				"where" => array(
					"user_row_status" => 1
				)
			);
			$tablename = "_user";
			$posts = $this->UserModel->getResultfromDB($rulesforquery, $tablename);
		}

		if ($posts["result_user"]["response_code"] == 200) {
			foreach ($posts["result_user"]["result"] as $result) {
				$nestedData["user_id"] = '<a href="#" rel="' . $result->user_id . '" data-toggle="modal" data-target="#userEditModal" class="editLink">' . $result->user_id . '</a>';
				$nestedData["name"] = $result->name;
				$nestedData["surname"] = $result->surname;
				$nestedData["email"] = $result->email;
				$nestedData["group_name"] = $result->group_name;
				$nestedData["user_is_active"] = $result->user_is_active == 1 ? $this->lang->line("Active") : $this->lang->line("Deactive");
				$nestedData["created_time"] = $result->created_time;
				$nestedData["login_time"] = $result->login_time;

				$data[] = $nestedData;
			}
		}
		$json_data = array(
			"draw" => intval($this->input->post('draw')),
			"recordsTotal" => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data" => $data
		);
		echo json_encode($json_data);
	}

	private function onLoad(){
		$this->data[HEADER_STYLES] = array(
			base_url() . "assets/plugins/fontawesome-free/css/all.min.css",
			base_url() . "assets/plugins/sweetalert2/sweetalert2.min.css",
			base_url() . "assets/plugins/toastr/toastr.min.css",
			base_url() . "assets/dist/css/adminlte.min.css",
			base_url() . "assets/plugins/select2/css/select2.min.css",
			base_url() . "assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css",
			"https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
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
			base_url() . "assets/plugins/select2/js/select2.full.min.js"
		);

		$this->data[FOOTER] = array(
			"masterpages/footer" => array()
		);

		$this->data[CUSTOM_SCRIPTS] = array(
			"courier/assets/js/poolcourierscripts" => array(
				"ajax_url" => base_url() ."/Poolcourier/"
			)
		);
	}
}
