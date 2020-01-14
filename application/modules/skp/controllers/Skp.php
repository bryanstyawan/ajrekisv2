<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/PHPExcel.php";
class Skp extends CI_Controller {

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

	private $year_system = 2020;

	public function index($year=NULL)
	{
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		redirect('dashboard/home');
	}

	public function skp_pegawai()
	{
		redirect('skp/target_skp/data');
	}


	public function approval_target_skp()
	{
		# code...
		redirect('skp/target_skp_approval/data');
	}

	public function approval_target_skp_plt()
	{
		# code...
		redirect('skp/target_skp_approval_plt/data');
	}
	
	public function approval_target_skp_akademik()
	{
		# code...
		redirect('skp/target_skp_approval_akademik/data');
	}	

	public function cetak_skp($id=NULL,$posisi=NULL,$year_system=NULL)
	{
		# code...
		redirect('skp/cetak_skp/data/');
	}

	public function penilaian_prilaku($arg=NULL)
	{
		# code...
		redirect('skp/penilaian_prilaku/data');
	}	

	public function get_target_skp_json($id,$id_posisi,$id_posisi_atasan)
	{
		# code...
		$year_system = $this->year_system;
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$data['infoPegawai']   = $this->Globalrules->get_info_pegawai($id,'id',$id_posisi);
		// print_r($data['infoPegawai']);die();
		$data['list']          = $this->mskp->get_data_skp_pegawai($id,$id_posisi,$year_system,11);
		$data['id']            = $id;
		$data['satuan']        = $this->Allcrud->listData('mr_skp_satuan');
		$data['member']   	 = $this->mskp->get_member($id_posisi_atasan);
		if ($data['member'] != 0) {
			// code...
			for ($i=0; $i < count($data['member']); $i++) {
				// code...
				$get_data              = $this->Allcrud->getData('mr_skp_pegawai',array('status'=>0,'id_pegawai'=>$data['member'][$i]->id,'id_posisi'=>$data['member'][$i]->posisi,'tahun'=>$this->year_system))->num_rows();
				$get_data_temp         = $this->Allcrud->getData('mr_skp_pegawai_temp',array('edit_status'=>3,'edit_id_pegawai'=>$data['member'][$i]->id,'edit_tahun'=>$this->year_system))->num_rows();								
				$urtug_belum_diperiksa = 0;
				$urtug_pergantian      = 0;
				if ($get_data) {
					// code...
					$urtug_belum_diperiksa = $get_data;
				}
				else {
					// code...
					$urtug_belum_diperiksa = 0;
				}

				if ($get_data_temp) {
					// code...
					$urtug_pergantian = $get_data_temp;
				}
				else {
					// code...
					$urtug_pergantian = 0;
				}				

				$data['member'][$i]->counter_belum_diperiksa = $urtug_belum_diperiksa + $urtug_pergantian;
			}
		}
		$this->load->view('skp/approval/index',$data);
	}	




	public function penilaian_skp_kualmutu()
	{
		# code...
		$text_status = "";
		$res_data    = "";
		$data_sender = $this->input->post('data_sender');
		for ($i=0; $i < count($data_sender); $i++) {
			# code...
			$data_change = array
							(
								'realisasi_kualitasmutu' => $data_sender[$i]['realisasi_kualitasmutu'],
							);

			$flag        = array('skp_id'=>$data_sender[$i]['hdn_skp_id']);
			$res_data    = $this->Allcrud->editData('mr_skp_pegawai',$data_change,$flag);
			$text_status = "Penilaian Kualitas SKP telah disimpan.";
		}

		$text_status = $this->Globalrules->check_status_res($res_data,$text_status);
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}



	public function penilaian_prilaku_plt()
	{
		# code...

	}	

	public function pengajuan_penilaian_prilaku()
	{
		# code...
		$res_data     = "";
		$res_data_id  = "";
		$text_status  = "";
		$data_sender  = $this->input->post('data_sender');
		$year_system = $this->year_system;
		for ($i=0; $i < count($data_sender); $i++) {
			# code...
			$info_pegawai = $this->Globalrules->get_info_pegawai($data_sender[$i]['evaluator'],'nama_pegawai');

			if ($info_pegawai != 0) {
				# code...
				$check_data = $this->mskp->get_info_evaluator($this->session->userdata('sesUser'),$info_pegawai[0]->id,$year_system);
				if ($check_data == 0) {
					# code...
					$data = array
							(
								'id_pegawai'         => $this->session->userdata('sesUser'),
								'id_pegawai_penilai' => $info_pegawai[0]->id,
								'tahun'              => $year_system
							);
					$res_data_id = $this->Allcrud->addData_with_return_id('mr_skp_penilaian_prilaku',$data);

					if ($res_data_id != 0) {
						# code...
						$res_data = 1;
					}
				}
				else
				{
					$res_data = 1;
				}
			}
		}

		$text_status = $this->Globalrules->check_status_res($res_data,"Anda telah mengajukan penilaian prilaku kepada Atasan dan rekan-rekan anda.");
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function get_detail_skp_penilaian($id)
	{
		# code...
		$year_system          = $this->year_system;		
		$res_data = $this->mskp->get_detail_skp_penilaian($id,$year_system);
		echo json_encode($res_data);
	}

	public function proses_penilaian_prilaku()
	{
		# code...
		$res_data             = "";
		$data_sender          = $this->input->post('data_sender');
		$year_system          = $this->year_system;
		$detail_skp_penilaian = $this->mskp->get_detail_skp_penilaian($data_sender['id'],$year_system);
		if ($detail_skp_penilaian != 0) {
			# code...
			$data = array
					(
						'orientasi_pelayanan' => $data_sender['orientasi_pelayanan'],
						'integritas'          => $data_sender['integritas'],
						'komitmen'            => $data_sender['komitmen'],
						'disiplin'            => $data_sender['disiplin'],
						'kerjasama'           => $data_sender['kerjasama'],
						'kepemimpinan'        => $data_sender['kepemimpinan'],
						'status'              => '1',
						'rekomendasi'         => $data_sender['rekomendasi']	
					);
			$flag        = array('id'=>$data_sender['id']);
			$res_data    = $this->Allcrud->editData('mr_skp_penilaian_prilaku',$data,$flag);
		}
		$text_status = $this->Globalrules->check_status_res($res_data,'Terima kasih telah memberikan penilai prilaku');
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function remove_pengajuan_penilaian_prilaku($value='')
	{
		# code...
		$res_data     = "";
		$res_data_id  = "";
		$text_status  = "";
		$data_sender  = $this->input->post('data_sender');
		$info_pegawai = $this->Globalrules->get_info_pegawai($data_sender['evaluator'],'nama_pegawai');
		if ($info_pegawai != 0) {
			# code...
			$check_data = $this->mskp->get_info_evaluator($this->session->userdata('sesUser'),$info_pegawai[0]->id,date('Y'));
			if ($check_data != 0) {
				# code...
				$flag = array('id' => $check_data[0]->id);
				$res_data = $this->Allcrud->delData('mr_skp_penilaian_prilaku',$flag);
			}
			else
			{
				$res_data = 0;
			}
		}

		$text_status = $this->Globalrules->check_status_res($res_data,"Anda telah membatalkan pengajuan penilaian prilaku.");
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}





	public function get_indikator_prilaku($id)
	{
		# code...
		$res_data    = '';
		$text_status = ''; 
		$get_data    = $this->mskp->get_indikator_prilaku($id);
		if ($get_data != 0) {
			# code...
			$res_data    = 1;
			$text_status = $get_data;
		}
		else {
			# code...
			$res_data    = 0;
			$text_status = 'Data tidak ditemukan';
		}
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}	






	public function penilaian_skp_bulanan_plt()
	{
		# code...
		$posisi = $this->session->userdata('posisi_plt');
		$this->form_penilaian_skp($posisi);
	}

	public function penilaian_skp_bulanan_akademik()
	{
		# code...
		$posisi = $this->session->userdata('posisi_akademik');
		$this->form_penilaian_skp($posisi);		
	}	

	public function form_penilaian_skp($posisi)
	{
		$data['title']     = '';				
		$data['content'] = 'skp/penilaian_skp_plt_akademik/index';
		$data['id_posisi'] = $posisi;								
		$data['member']  = $this->Globalrules->list_bawahan($posisi,NULL,'penilaian_skp');		
		$this->load->view('templateAdmin',$data);		
	}	

	// public function penilaian_skp($param=NULL,$id_posisi=NULL)
	// {
	// 	# code...
	// 	$this->Globalrules->session_rule();
	// 	$this->Globalrules->notif_message();
	// 	$id               = "";
	// 	$id_posisi        = "";
	// 	$data['penilai']  = '';
	// 	$data['title']    = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Penilaian SKP';
	// 	$data['subtitle'] = '';
	// 	$data['member']   = $this->mskp->get_member($this->session->userdata('sesPosisi'));
	// 	$data['satuan']   = $this->Allcrud->listData('mr_skp_satuan');
	// 	$data['jenis']    = $this->Allcrud->listData('mr_skp_jenis');
	// 	if ($param == NULL) {
	// 		# code...
	// 		$id                     = $this->session->userdata('sesUser');
	// 		$id_posisi              = $this->session->userdata('sesPosisi');			
	// 		$data['penilai']        = 0;
	// 	}
	// 	else
	// 	{
	// 		if ($data['member'] != 0) {
	// 			# code...
	// 			$data['penilai'] = 1;
	// 		}
	// 		else
	// 		{
	// 			$data['penilai'] = 0;
	// 		}
	// 		$id          = $param;			
	// 		$get_pegawai = $this->Allcrud->getData('mr_pegawai',array('id'=>$id))->result_array();
	// 		if ($get_pegawai != array()) {
	// 			# code...
	// 			$id_posisi = $get_pegawai[0]['posisi'];
	// 		} else {
	// 			# code...
	// 			$id_posisi = '';
	// 		}
	// 	}

	// 	$data['infoPegawai'] = $this->Globalrules->get_info_pegawai($id,'id',$id_posisi);
	// 	$data['list']         = $this->mskp->get_data_skp_pegawai($id,$id_posisi,date('Y'),'1','realisasi');
	// 	$data['content']      = 'skp/penilaian_skp';
	// 	$this->load->view('templateAdmin',$data);
	// }	
}
  