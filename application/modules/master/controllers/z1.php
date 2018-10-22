<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_eselon2 extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
	
	public function index()
	{
		$this->Allcrud->session_rule();						
		$data['title']   = '<b>Struktur Organisasi</b> <i class="fa fa-angle-double-right"></i> Data Eselon 1';
		$data['content'] = 'master/eselon/data_eselon1';
		$data['list']    = $this->Allcrud->listData('mr_eselon1');
		$this->load->view('templateAdmin',$data);
	}

}