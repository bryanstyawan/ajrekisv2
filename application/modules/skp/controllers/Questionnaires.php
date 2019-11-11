<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/PHPExcel.php";
class Questionnaires extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('mskp', '', TRUE);
		$this->load->model ('transaksi/mtrx', '', TRUE);
		$this->load->model ('master/Mmaster', '', TRUE);
		$this->load->library('Excel');
		$this->load->library('image_lib');
		$this->load->library('upload');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$data['title']                   = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Kriteria penilaian kualitas SKP';
		$data['member']                  = $this->Globalrules->list_bawahan($this->session->userdata('sesPosisi'),NULL,'penilaian_skp');
		$data['content']                 = 'skp/questionnaires/index';
		$this->load->view('templateAdmin',$data);
	}

	public function questionnaires_pegawai($id_pegawai,$id_posisi)
	{
		# code...
		$data['infoPegawai']             = $this->Globalrules->get_info_pegawai($id_pegawai,'id',$id_posisi);				
		$data['questionnaires']               = $this->mskp->questionnaires($id_pegawai,$id_posisi); 
		$data['questionnaires_kategori'] = $this->Allcrud->listData('questionnaires_kategori')->result_array();
		$this->load->view('skp/questionnaires/questionnaires_pegawai',$data);		
	}

	public function store_questionnaires_process()
	{
		# code...
		$text_status = "";
		$res_data    = "";
		$data_sender = $this->input->post('data_sender');
		$id_pegawai  = 0;
		$id_posisi   = 0;
		for ($i=0; $i < count($data_sender); $i++) {
			# code...
			$id_pegawai  = $data_sender[$i]['id_pegawai'];
			$id_posisi   = $data_sender[$i]['id_posisi'];			
			$data_flag = array
							(
								'id_pegawai'    => $data_sender[$i]['id_pegawai'],
								'id_posisi'     => $data_sender[$i]['id_posisi'],
								'qusioner_code' => $data_sender[$i]['qusioner_code'],
								'tahun'         => date('Y'),																																
							);
			$data_store          = $data_flag;
			$data_store['value'] = $data_sender[$i]['value'];							
			$get_data = $this->Allcrud->getData('questionnaires_process',$data_flag)->result_array();							
			if ($get_data != array()) {
				# code...
				$data_store          = $data_flag;
				$data_store['value'] = $data_sender[$i]['value'];
				$res_data            = $this->Allcrud->editData('questionnaires_process',$data_store,$data_flag);				
			}
			else
			{
				$res_data    = $this->Allcrud->addData('questionnaires_process',$data_store);				
			}
			// $flag        = array('skp_id'=>$data_sender[$i]['hdn_skp_id']);
			// $res_data    = $this->Allcrud->editData('mr_skp_pegawai',$data_change,$flag);
			// $text_status = "Penilaian Kualitas SKP telah disimpan.";
		}

		$data_flag = array
		(
			'id_pegawai'    => $id_pegawai,
			'id_posisi'     => $id_posisi,
			'tahun'         => date('Y'),																																
		);
		
		$get_data = $this->Allcrud->getData('questionnaires_process',$data_flag)->result_array();
		if ($get_data != array()) {
			# code...
			$result  = 0;			
			$counter = count($get_data);
			$sum     = $this->mskp->get_sum_questionnaires($id_pegawai,$id_posisi);
			if ($sum != 0) {
				# code...
				if ($sum[0]->result != 0) {
					# code...
					$result = $sum[0]->result / $counter;
					$data_store = array
									(
										'realisasi_kualitasmutu' => $result,
									);
					// print_r($data_store);
					// die();
					$res_data    = $this->Allcrud->editData('mr_skp_pegawai',$data_store,$data_flag);
					$text_status = "Kriteria penilaian kualitas SKP telah disimpan.";
				}
			}
		}		

		// $text_status = $this->Globalrules->check_status_res($res_data,$text_status);
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}


}
  