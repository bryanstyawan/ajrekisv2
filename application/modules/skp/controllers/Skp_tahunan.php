<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/PHPExcel.php";
class Skp_tahunan extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('mskp', '', TRUE);
		$this->load->model ('transaksi/mtrx', '', TRUE);
		$this->load->model ('master/Mmaster', '', TRUE);
		date_default_timezone_set('Asia/Jakarta');
	}

	private $year_system = 2020;	

	public function data()
	{
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$data['title']      = 'Rekapitulasi SKP Tahunan';
		$data['content']    = 'skp/monitoring/index';
		$data['list']       = '';
		$data['es1']        = $this->Allcrud->listData('mr_eselon1');
		$data['es2']        = $this->Allcrud->getData('mr_eselon2',array('id_es1'=>$this->session->userdata('sesEs1')));
		$data['role']       = $this->Allcrud->listData('user_role');
		$this->load->view('templateAdmin',$data);
	}	

	public function filter_skp_tahunan()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$data_parameter = array
						(
							'eselon1'    => $data_sender['data_1'],
							'eselon2'    => $data_sender['data_2'],
							'eselon3'    => $data_sender['data_3'],
							'eselon4'    => $data_sender['data_4'],
							'tahun'		 => $data_sender['data_5'] 
						);
		$data['tahun'] = $data_sender['data_5'];						
		$data['list'] = $this->mskp->rekap_skp_tahunan($data_parameter,'a.es2 ASC,
																		a.es3 ASC,
																		a.es4 ASC,
																		b.kat_posisi asc,
																		b.atasan ASC');
		$this->load->view('skp/monitoring/ajax_skp_tahunan',$data);
	}	

	public function get_value($id_pegawai)
	{
		# code...
		$this->Globalrules->trigger_skp_tahunan($id_pegawai);		
	}


}
  