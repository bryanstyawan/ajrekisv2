<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ro_peg extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index(){

		$curl = curl_init();

		$this->Globalrules->session_rule();	
		$nip = $this->session->userdata('sesNip');
		$hari = date('Y-m-d');

		$month = date('m');
		$year = date('Y');
		curl_setopt_array($curl, array(
			CURLOPT_PORT => "8090",
			CURLOPT_URL => "http://192.168.193.172:8090/esidik/api/presensi/getpotongan",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "nip=$nip&month=$month&year=$year&token=80f0d4e2dcda977afbfbed11de34b6b4",
			CURLOPT_COOKIE => "abs3nDagr1New=bulcmm7ggul3v1pnh73o68c612mj795v",
			CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded",
				"token: 80f0d4e2dcda977afbfbed11de34b6b4"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			echo $response;
		}
	}
}






