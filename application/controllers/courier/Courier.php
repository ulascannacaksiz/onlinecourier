<?php
class Courier extends MY_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->onLoad();
	}

	public function index(){
		$this->data[MASTER_PAGES]["courier/ordercourier"] = array();
		$this->load->view("layout",$this->data);
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
			base_url() . "assets/dist/css/home.css",
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
			"courier/assets/js/ordercourierscripts" => array()

		);
	}

}
