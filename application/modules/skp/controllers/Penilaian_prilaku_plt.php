<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/PHPExcel.php";
class penilaian_prilaku_plt extends CI_Controller {

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

	private $year_system = 2022;

	public function index($arg=NULL)
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();		
		$arg                  = 'plt';		
		$helper_title         = "";
		$helper_posisi        = "";
		$helper_atasan        = "";
		$year_system          = $this->year_system;
		$data                 = $this->Globalrules->data_summary_skp_pegawai($this->session->userdata('sesUser'),$helper_posisi,$year_system);
		$data['content']      = 'skp/skp_penilaian_prilaku';
		$data['title']        = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Penilaian Prilaku '.$helper_title;
		$data['subtitle']     = '';
		if($arg != NULL)
		{
			if ($arg == "plt") {
				# code...
				$helper_title = "PLT";
				$get_data_posisi = $this->Allcrud->getData('mr_posisi',array('id'=>$this->session->userdata('posisi_plt')))->result_array();				
				if ($get_data_posisi != array()) {
					# code...
					$get_data_pegawai = $this->Allcrud->getData('mr_pegawai',array('posisi'=>$get_data_posisi[0]['atasan'],'status'=>1))->result_array();					
					$helper_atasan = $get_data_posisi[0]['atasan'];					
					$helper_posisi = $this->session->userdata('posisi_plt');					
				}
			}
		}
		else
		{
			$helper_posisi = $this->session->userdata('sesPosisi');
			$helper_atasan = $this->session->userdata('atasan');
		}
		// print_r($this->Globalrules->list_atasan($helper_posisi));die();
		$data['atasan']       = $this->Globalrules->list_atasan_plt($helper_posisi);
		// if ($helper_atasan != 0) {
		// 	# code...
		// 	$data['atasan']       = $this->Globalrules->list_atasan($helper_posisi);
		// 	$data['atasan']       = ($data['atasan'] == 0) ? $this->Globalrules->list_atasan_akademik(	) : $data['atasan'] ;			
					
		// }
		// else
		// {
		// 	$data['atasan']       = 0;			
		// 	$data['atasan_plt']   = 0;			
		// }

		// if ($data['atasan'] == 0) {
		// 	# code...
		// 	$data['atasan']       = $this->Globalrules->list_atasan_plt($this->session->userdata('atasan')) ;
									
		// }

		$data['peer']         = $this->Globalrules->list_bawahan($helper_atasan);
		$data['bawahan']      = $this->Globalrules->list_bawahan($helper_posisi);
		$data['satuan']       = $this->Allcrud->listData('mr_skp_satuan');

		$data['bawahan_plt']  = array();
		if ($this->session->userdata('posisi_plt') != 0) {
			# code...
			$data['bawahan_plt']  = $this->Globalrules->list_bawahan($this->session->userdata('posisi_plt'));			
		}

		if ($data['bawahan_plt'] != array()) {
			# code...
			$data['atasan_plt']       = $this->Globalrules->list_atasan_plt($this->session->userdata('posisi_plt'));			
		// echo "<pre>";
		// // print_r();die();				
		// print_r($data['atasan_plt']);die();		
		// echo "</pre>";		
			if ($data['atasan_plt'] != 0) {
				# code...
				$data['peer']         = $this->Globalrules->list_bawahan($data['atasan_plt'][0]->posisi_plt);				
			}						
		}

		if ($arg == "plt") {
		}
		else
		{
			if ($this->session->userdata('kat_posisi') == 4 || $this->session->userdata('kat_posisi') == 2) {
				# code...
				if ($data['peer'] == 0 || count($data['peer']) < 5) {
					# code...
					$data['peer'] = ($this->session->userdata('sesEs4') != 0) ? $this->Globalrules->get_peer(array('b.eselon4',$this->session->userdata('sesEs4')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;						
					if ($data['peer'] == 0 || count($data['peer']) < 5) {
						# code...
						$data['peer'] = ($this->session->userdata('sesEs3') != 0) ? $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;
						if ($data['peer'] == 0 || count($data['peer']) < 5) {
							# code...
							$data['peer'] = ($this->session->userdata('sesEs2') != 0) ? $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon1',$this->session->userdata('sesEs1')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;
						}				
					}			
				}			
			}
			else
			{
	
			}
		}		
		
		// if($data['bawahan'] != 0){
		// 	for ($i=0; $i < count($data['bawahan']); $i++) { 
		// 		# code...
		// 		$get_data_bawahan = $this->Allcrud->getData('mr_skp_penilaian_prilaku',array('id_pegawai'=>$data['bawahan'][$i]->id,'id_pegawai_penilai'=>$this->session->userdata('sesUser'),'tahun'=>$this->year_system));
		// 		if ($get_data_bawahan->result_array() == array() || $get_data_bawahan->result_array() == 0) {
		// 			# code...
		// 			$data_store = array
		// 					(
		// 						'id_pegawai'         => $data['bawahan'][$i]->id,
		// 						'id_pegawai_penilai' => $this->session->userdata('sesUser'),
		// 						'tahun'              => $year_system
		// 					);
		// 			$res_data = $this->Allcrud->addData_with_return_id('mr_skp_penilaian_prilaku',$data_store);					
		// 		}
		// 	}
		// }
		$data['request_eval'] = $this->mskp->get_request_eval($this->session->userdata('sesUser'),$year_system);
		$data['evaluator']    = $this->mskp->get_data_evaluator($this->session->userdata('sesUser'),$year_system);				
		$this->load->view('templateAdmin',$data);
	}

	public function penilaian_prilaku_plt()
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$get_data_pegawai = $this->Allcrud->getData('mr_pegawai',array('id'=>$this->session->userdata('sesUser')))->result_array();
		if ($get_data_pegawai != array()) 
		{
			# code...
			if ($get_data_pegawai[0]['posisi_plt'] == 0) {
				# code...
				redirect('dashboard/home');
			}
			else
			{
				$get_posisi = $this->Globalrules->get_info_pegawai($get_data_pegawai[0]['posisi_plt'],'posisi');

				$data                 = $this->Globalrules->data_summary_skp_pegawai($this->session->userdata('sesUser'),$get_data_pegawai[0]['posisi_plt'],$this->year_system);
				$data['content']      = 'skp/skp_penilaian_prilaku';
				$data['title']        = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Penilaian Prilaku PLT';
				$data['subtitle']     = '';
				$data['atasan']       = $this->Globalrules->list_atasan($get_data_pegawai[0]['posisi_plt']);
				$data['peer']         = $this->Globalrules->list_bawahan($get_posisi[0]->atasan);
				$data['bawahan']      = $this->Globalrules->list_bawahan($get_data_pegawai[0]['posisi_plt']);
				$data['satuan']       = $this->Allcrud->listData('mr_skp_satuan');
				if($data['bawahan'] != 0){
					for ($i=0; $i < count($data['bawahan']); $i++) { 
						# code...
						$get_data_bawahan = $this->Allcrud->getData('mr_skp_penilaian_prilaku',array('id_pegawai'=>$data['bawahan'][$i]->id,'id_pegawai_penilai'=>$this->session->userdata('sesUser'),'tahun'=>$this->year_system));
						if ($get_data_bawahan->result_array() == array() || $get_data_bawahan->result_array() == 0) {
							# code...
							$data_store = array
									(
										'id_pegawai'         => $data['bawahan'][$i]->id,
										'id_pegawai_penilai' => $this->session->userdata('sesUser'),
										'tahun'              => $this->year_system
									);
							$res_data = $this->Allcrud->addData_with_return_id('mr_skp_penilaian_prilaku',$data_store);					
						}
					}
				}
				$data['request_eval'] = $this->mskp->get_request_eval($this->session->userdata('sesUser'),$this->year_system);
				$data['evaluator']    = $this->mskp->get_data_evaluator($this->session->userdata('sesUser'),$this->year_system);				
				$this->load->view('templateAdmin',$data);				
			}
		}
	}	

	public function pengajuan_penilaian_prilaku()
	{
		# code...
		$res_data     = "";
		$res_data_id  = "";
		$text_status  = "";
		$data_sender  = $this->input->post('data_sender');
		$year_system = '2019';
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
}
  