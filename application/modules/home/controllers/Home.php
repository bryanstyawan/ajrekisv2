<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct ()
	{
			parent::__construct();
			$this->load->model ('Mhome', '', TRUE);
			$this->load->model ('mlogin', '', TRUE);
			date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$this->main();
	}

	public function main()
	{
			// code...
		// print_r($this->session->userdata());die();									
			ini_set('date.timezone', 'Asia/Jakarta');
			date_default_timezone_set('Asia/Jakarta');
			$this->load->view('home',NULL);
	}
}
