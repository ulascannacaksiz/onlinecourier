<?php

class SignUp extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function load($data)
	{
		$this->load->view("SignInView",$data);
	}

	public function requestfromAjax()
	{
		$this->form_validation->set_rules("email", "email", "trim|required|xss_clean|valid_email");
		$this->form_validation->set_rules("password", "password", "trim|required|xss_clean|regex_match[/^[][a-zA-Z0-9@#+*{}!,().]+$/]");
		if ($this->form_validation->run()) {
			$email = $this->input->post("email", TRUE);
			$password = $this->input->post("password", TRUE);
			$this->request($email, $password);
		} else {
			echo $this->lang->line("Error: Email or password is incorrect");
		}
	}

	public function request($email, $password)
	{
		if (!is_null($email) && !is_null($password)) {
			$rulesforrequest = array(
				"where" => array(
					"user_email" => htmlspecialchars($email),
					"user_password" => hash("sha256", htmlspecialchars($password))
				),
				"is_numeric" => false
			);
			$url = "http://localhost/onlinecourier_api/GetDb/getUserfromDB";
			$this->curly->post($url,json_encode($rulesforrequest));
			$response = $this->curly->getResponse();
			if ($response["response_code"] >= 200 && $response["response_code"] < 300) {
				if ($response["response_data"]["resultuser"]["result"][0]->user_row_status == 1 &&
					$response["response_data"]["resultuser"]["result"][0]->user_is_active == 1) {
					$this->call_to_create_session($response["response_data"]["resultuser"]["result"]);
				} else {
					echo "Error: You are banned";
				}
			} else {
				echo "Error: Email or password is incorrect";
			}
		}
	}
}
