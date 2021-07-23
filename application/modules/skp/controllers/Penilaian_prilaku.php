<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/PHPExcel.php";
class Penilaian_prilaku extends CI_Controller {

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

	private $year_system = 2021;	

	public function index($arg=NULL)
	{
		# code...
		redirect('skp/penilaian_prilaku/data');
		// $this->Globalrules->session_rule();
		// $this->Globalrules->notif_message();		
		// $helper_title         = "";
		// $helper_posisi        = "";
		// //$helper_posisi        = session->userdata('posisi');
		// $helper_atasan        = "";
		// $year_system          = $this->year_system;
		// $data                 = $this->Globalrules->data_summary_skp_pegawai($this->session->userdata('sesUser'),$this->session->userdata('sesPosisi'),$year_system);
		// $data['content']      = 'skp/skp_penilaian_prilaku';
		// $data['title']        = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Penilaian Prilaku '.$helper_title;
		// $data['subtitle']     = '';

		// if($arg != NULL)
		// {
		// 	if ($arg == "plt") {
		// 		# code...
		// 		$helper_title = "PLT";
		// 		$get_data_posisi = $this->Allcrud->getData('mr_posisi',array('id'=>$this->session->userdata('posisi_plt')))->result_array();				
		// 		if ($get_data_posisi != array()) {
		// 			# code...
		// 			$get_data_pegawai = $this->Allcrud->getData('mr_pegawai',array('posisi'=>$get_data_posisi[0]['atasan'],'status'=>1))->result_array();					
		// 			$helper_atasan = $get_data_posisi[0]['atasan'];					
		// 			$helper_posisi = $this->session->userdata('posisi_plt');					
		// 		}
		// 	}
		// }
		// else
		// {
		// 	$helper_posisi = $this->session->userdata('sesPosisi');
		// 	$helper_atasan = $this->session->userdata('atasan');
		// }

		// // echo "<pre>";
		// // print_r($data['infoPegawai']);die();		
		// // // print_r($this->session->userdata('posisi_plt'));die();		
		// // echo "</pre>";		

		// if ($helper_atasan != 0) {
		// 	# code...
		// 	$data['atasan']       = $this->Globalrules->list_atasan($helper_posisi);			
		// 	// $data['atasan']       = ($data['atasan'] == 0) ? $this->Globalrules->list_atasan_akademik(	) : $data['atasan'] ;			
		// 	$data['atasan_plt']       = $this->Globalrules->list_atasan_plt($this->session->userdata('posisi_plt'));			
		// 	// $data['atasan_plt']   = $this->Globalrules->list_atasan_plt($helper_posisi);					
		// }
		// else
		// {
		// 	$data['atasan']       = 0;			
		// 	$data['atasan_plt']   = 0;			
		// }

		// if ($data['atasan_plt'] != 0) {
		// 	# code...
		// 	$dataStorePLT = array
		// 			(
		// 				'id_pegawai'         => $this->session->userdata('sesUser'),
		// 				'id_posisi_pegawai' => $this->session->userdata('sesPosisi'),
		// 				'id_pegawai_penilai' => $data['atasan_plt'][0]->id,
		// 				'id_posisi_pegawai_penilai' => $data['atasan_plt'][0]->posisi,							
		// 				'tahun'              => $year_system
		// 			);
		// 	$get_data_atasan = $this->Allcrud->getData('mr_skp_penilaian_prilaku',$dataStorePLT)->result_array();				

		// 	if ($get_data_atasan == array()) {
		// 		# code...
		// 		$res_data = $this->Allcrud->addData('mr_skp_penilaian_prilaku',$dataStorePLT);			
		// 	}
		// }
		// else
		// {
		// 	if ($data['atasan'] != 0) {
		// 		# code...
		// 		$dataStorePLT = array
		// 				(
		// 					'id_pegawai'         => $this->session->userdata('sesUser'),
		// 					'id_posisi_pegawai' => $this->session->userdata('sesPosisi'),
		// 					'id_pegawai_penilai' => $data['atasan'][0]->id,
		// 					'id_posisi_pegawai_penilai' => $data['atasan'][0]->posisi,							
		// 					'tahun'              => $year_system
		// 				);
		// 		$get_data_atasan = $this->Allcrud->getData('mr_skp_penilaian_prilaku',$dataStorePLT)->result_array();				

		// 		if ($get_data_atasan == array()) {
		// 			# code...
		// 			$res_data = $this->Allcrud->addData('mr_skp_penilaian_prilaku',$dataStorePLT);			
		// 		}
		// 	}			
		// }


		// // $data['atasan']       = $this->Globalrules->list_atasan($this->session->userdata('atasan'));
		// // $data['atasan']       = ($data['atasan'] == 0) ? $this->Globalrules->list_atasan_plt($this->session->userdata('atasan')) : $data['atasan'] ;									
		// // echo "<pre>";
		// // print_r($data['atasan']);die();		
		// // echo "</pre>";		
		// $data['atasan']       = ($data['atasan'] == 0) ? $this->Globalrules->list_atasan_akademik($this->session->userdata('atasan')) : $data['atasan'] ;

		// $data['peer']         = $this->Globalrules->list_bawahan($helper_atasan);
		// $data['bawahan']      = $this->Globalrules->list_bawahan($helper_posisi);

		// $data['bawahan_plt']  = array();
		// if ($this->session->userdata('posisi_plt') != 0) {
		// 	# code...
		// 	$data['bawahan_plt']  = $this->Globalrules->list_bawahan($this->session->userdata('posisi_plt'));			
		// }

		// if ($data['bawahan_plt'] != array()) {
		// 	# code...
		// 	$data['atasan_plt']       = $this->Globalrules->list_atasan_plt($this->session->userdata('posisi_plt'));			
		// // echo "<pre>";
		// // // print_r();die();				
		// // print_r($data['atasan_plt']);die();		
		// // echo "</pre>";		
		// 	if ($data['atasan_plt'] != 0) {
		// 		# code...
		// 		$data['peer']         = $this->Globalrules->list_bawahan($data['atasan_plt'][0]->posisi_plt);				
		// 	}						
		// }

		// $data['satuan']       = $this->Allcrud->listData('mr_skp_satuan');
		// if ($arg == "plt") {
		// }
		// else
		// {
		// 	if ($this->session->userdata('kat_posisi') == 4 || $this->session->userdata('kat_posisi') == 2) {
		// 		# code...
		// 		if ($data['peer'] == 0 || count($data['peer']) < 5) {
		// 			# code...
		// 			$data['peer'] = ($this->session->userdata('sesEs4') != 0) ? $this->Globalrules->get_peer(array('b.eselon4',$this->session->userdata('sesEs4')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;						
		// 			if ($data['peer'] == 0 || count($data['peer']) < 5) {
		// 				# code...
		// 				$data['peer'] = ($this->session->userdata('sesEs3') != 0) ? $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;
		// 				if ($data['peer'] == 0 || count($data['peer']) < 5) {
		// 					# code...
		// 					$data['peer'] = ($this->session->userdata('sesEs2') != 0) ? $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon1',$this->session->userdata('sesEs1')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;
		// 				}				
		// 			}			
		// 		}			
		// 	}
		// 	else
		// 	{
	
		// 	}
		// }		

		// // echo "<pre>";
		// // print_r($data['atasan_plt']);die();		
		// // echo "</pre>";		
		// // if($data['bawahan'] != 0){
		// // 	for ($i=0; $i < count($data['bawahan']); $i++) { 
		// // 		# code...
		// // 		$get_data_bawahan = $this->Allcrud->getData('mr_skp_penilaian_prilaku',array('id_pegawai'=>$data['bawahan'][$i]->id,'id_pegawai_penilai'=>$this->session->userdata('sesUser'),'tahun'=>$this->year_system));
		// // 		if ($get_data_bawahan->result_array() == array() || $get_data_bawahan->result_array() == 0) {
		// // 			# code...
		// // 			$data_store = array
		// // 					(
		// // 						'id_pegawai'         => $data['bawahan'][$i]->id,
		// // 						'id_pegawai_penilai' => $this->session->userdata('sesUser'),
		// // 						'tahun'              => $year_system
		// // 					);
		// // 			$res_data = $this->Allcrud->addData_with_return_id('mr_skp_penilaian_prilaku',$data_store);					
		// // 		}
		// // 	}
		// // }
		// $data['request_eval'] = $this->mskp->get_request_eval($this->session->userdata('sesUser'),$year_system);
		// $data['evaluator']    = $this->mskp->get_data_evaluator($this->session->userdata('sesUser'),$year_system);				
		// // echo "<pre>";
		// // // print_r($data['atasan']);die();		
		// // print_r($data['atasan_plt']);die();		
		// // echo "</pre>";
		// $this->load->view('templateAdmin',$data);
	}

	public function data($id_pegawai=NULL,$id_posisi=NULL,$year_system=NULL)
	{
		# code...
		$year_system = ($year_system == NULL) ? $this->year_system : $year_system ;
		if($id_pegawai != NULL)
		{
			if($id_posisi != NULL)
			{
				$this->Globalrules->session_rule();
				$this->Globalrules->notif_message();		
				$helper_title         = "";
				$helper_posisi        = "";

				$helper_atasan        = "";
				$year_system          = $this->year_system;
				$data                 = $this->Globalrules->data_summary_skp_pegawai($id_pegawai,$id_posisi,$year_system);

				$data['content']      = 'skp/skp_penilaian_prilaku_form';
				$data['title']        = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Penilaian Prilaku '.$helper_title;
				$data['subtitle']     = '';
				$data['atasan_plt'] = array();
				$data['bawahan_koor']  = array();		
				$data['id_pegawai'] = $id_pegawai;
				$data['id_posisi'] = $id_posisi;
	
				$data['atasan']       = $this->Globalrules->list_atasan($id_posisi);
				$data['atasan_plt']   = $this->Globalrules->list_atasan_plt($id_posisi);											
		
				$data['peer']         = $this->Globalrules->list_bawahan($data['atasan'][0]->posisi);
				$data['bawahan']      = $this->Globalrules->list_bawahan($id_posisi);
		
				if ($data['atasan_plt'] != 0) {
					# code...
					$data['atasan'] = $data['atasan_plt'];
					$data['peer']         = $this->Globalrules->list_bawahan($data['atasan_plt'][0]->posisi_plt);
					$data['atasan_plt'] = array();										
				}
				
				// Koordinator/subkoordinator
				if ($data['infoPegawai'][0]->kat_posisi == 2) {
					# code...
					if ($data['infoPegawai'][0]->posisi_plt != 0) {
						# code...
						$data['bawahan_koor']      = $this->Globalrules->list_bawahan($data['infoPegawai'][0]->posisi_plt);						
					}					
				}

		// echo "<pre>";
		// print_r($data['infoPegawai'][0]->kat_posisi);die();				
		// // print_r($data['bawahan_plt']);die();		
		// echo "</pre>";										

				$dataStorePLT = array
						(
							'id_pegawai'         => $this->session->userdata('sesUser'),
							'id_posisi_pegawai' => $this->session->userdata('sesPosisi'),
							'id_pegawai_penilai' => $data['atasan'][0]->id,
							'id_posisi_pegawai_penilai' => $data['atasan'][0]->posisi,							
							'tahun'              => $year_system
						);
				$get_data_atasan = $this->Allcrud->getData('mr_skp_penilaian_prilaku',$dataStorePLT)->result_array();				

				if ($get_data_atasan == array()) {
					# code...
					$res_data = $this->Allcrud->addData('mr_skp_penilaian_prilaku',$dataStorePLT);			
				}				
		
				$data['satuan']       = $this->Allcrud->listData('mr_skp_satuan');
				// if ($arg == "plt") {
				// }
				// else
				// {
				// 	if ($this->session->userdata('kat_posisi') == 4 || $this->session->userdata('kat_posisi') == 2) {
				// 		# code...
				// 		if ($data['peer'] == 0 || count($data['peer']) < 5) {
				// 			# code...
				// 			$data['peer'] = ($this->session->userdata('sesEs4') != 0) ? $this->Globalrules->get_peer(array('b.eselon4',$this->session->userdata('sesEs4')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;						
				// 			if ($data['peer'] == 0 || count($data['peer']) < 5) {
				// 				# code...
				// 				$data['peer'] = ($this->session->userdata('sesEs3') != 0) ? $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;
				// 				if ($data['peer'] == 0 || count($data['peer']) < 5) {
				// 					# code...
				// 					$data['peer'] = ($this->session->userdata('sesEs2') != 0) ? $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon1',$this->session->userdata('sesEs1')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;
				// 				}				
				// 			}			
				// 		}			
				// 	}
				// 	else
				// 	{
			
				// 	}
				// }		
		
				$data['request_eval'] = $this->mskp->get_request_eval($id_pegawai,$year_system);
				// // echo "<pre>";
				// // // print_r();die();				
				// // print_r($data['atasan_plt']);die();		
				// // echo "</pre>";						
				$data['evaluator']    = $this->mskp->get_data_evaluator($id_pegawai,$year_system,$id_posisi);				
				$this->load->view('templateAdmin',$data);		
			}
			else
			{
				$this->history_skp();				
			}
		}
		else
		{
			$this->history_skp();
		}
	}	

    public function history_skp()
	{
		# code...
		$getMasaKerja = $this->Allcrud->getData('mr_masa_kerja', array('id_pegawai' => $this->session->userdata('sesUser'),'id_posisi' => $this->session->userdata('sesPosisi')))->result_array();		
		if($getMasaKerja == array())
		{
			$data_store        = array
						(
							'id_pegawai' => $this->session->userdata('sesUser'),
							'id_posisi'  => $this->session->userdata('sesPosisi'),
							'StartDate'  => date('Y-m-d H:i:s'),
							'EndDate'    => '9999-01-01',
							'audit_user' => $this->session->userdata('sesNip'),
							'audit_time' => date('Y-m-d H:i:s')
						);		
			$res_data    = $this->Allcrud->addData('mr_masa_kerja',$data_store);			
		}
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$data['penilai']  = '';
		$data['tahun'] = $this->year_system;
		$data['title']        = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Penilaian Prilaku ';
		$data['content']  = 'skp/skp_penilaian_prilaku_jabatan';
		$data['request_history'] = $this->mskp->get_request_history1($this->session->userdata('sesUser'));
		$this->load->view('templateAdmin',$data);
	}	

	public function form_penilaian_skp(Type $var = null)
	{
		# code...

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

				// $data['bawahan_plt']  = 0;
				// if ($this->session->userdata('posisi_plt') != 0) {
				// 	# code...
				// 	$data['bawahan_plt']  = $this->Globalrules->list_bawahan($this->session->userdata('posisi_plt'));			
				// }
				
		
				// if ($data['bawahan_plt'] != 0) {
				// 	# code...
				// 	$data['atasan_plt']       = $this->Globalrules->list_atasan_plt($this->session->userdata('posisi_plt'));			
				// // echo "<pre>";
				// // // print_r();die();				
				// // print_r($data['atasan_plt']);die();		
				// // echo "</pre>";		
				// 	if ($data['atasan_plt'] != 0) {
				// 		# code...
				// 		$data['peer']         = $this->Globalrules->list_bawahan($data['atasan_plt'][0]->posisi_plt);				
				// 	}						
				// }				

				$data['bawahan_plt']  = $this->Globalrules->list_bawahan($this->session->userdata('posisi_plt'));
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
		$check_data = $this->mskp->get_info_evaluator($this->session->userdata('sesUser'),$data_sender['evaluator'],$this->year_system);
		if ($check_data != 0) {
			# code...
			$flag = array('id' => $check_data[0]->id);
			$res_data = $this->Allcrud->delData('mr_skp_penilaian_prilaku',$flag);
		}
		else
		{
			$res_data = 0;
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

	public function pengajuan_penilaian_prilaku()
	{
		# code...
		$res_data     = "";
		$res_data_id  = "";
		$text_status  = "";
		$data_sender  = $this->input->post('data_sender');
		$year_system = $this->year_system;
		// print_r($data_sender);die();
		for ($i=0; $i < count($data_sender); $i++) {
			# code...
			$check_data = $this->mskp->get_info_evaluator($this->session->userdata('sesUser'),$data_sender[$i]['evaluator'],$year_system);
			if ($check_data == 0) {
				# code...
				if ($data_sender[$i]['evaluator'] != '' || $data_sender[$i]['evaluator'] != NULL) {
					# code...
					$data = array
							(
								'id_pegawai'         => $this->session->userdata('sesUser'),
								'id_posisi_pegawai' => $this->session->userdata('sesPosisi'),
								'id_pegawai_penilai' => $data_sender[$i]['evaluator'],
								'id_posisi_pegawai_penilai' => $data_sender[$i]['posisi'],							
								'tahun'              => $year_system
							);
					$res_data_id = $this->Allcrud->addData_with_return_id('mr_skp_penilaian_prilaku',$data);

					if ($res_data_id != 0) {
						# code...
						$res_data = 1;
					}					
				} else {
					# code...
				}
			}
			else
			{
				$res_data = 1;
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

	public function set_evaluator_prilaku()
	{
		$year_system          = $this->year_system;		
		$data_sender          = $this->input->post('data_sender');
		$text_status = "";
		$res_data = 0; $resMessage = 0;
		$data = array
				(
					'id_pegawai'         => $data_sender['pegawai'],
					'id_posisi_pegawai' => $data_sender['posisi'],
					'id_pegawai_penilai' => $data_sender['id_pegawai'],
					'id_posisi_pegawai_penilai' => $data_sender['id_posisi'],							
					'tahun'              => $year_system
				);
		$get_data = $this->Allcrud->getData('mr_skp_penilaian_prilaku',$data)->result_array();				

		if ($get_data == array()) {
			# code...
			$res_data = $this->Allcrud->addData('mr_skp_penilaian_prilaku',$data);			
			$text_status = $this->Globalrules->check_status_res($res_data,"Anda telah mengajukan penilaian prilaku kepada Atasan dan rekan-rekan anda.");
			$resMessage = 1;			
		}
		else
		{
			$res_data = 1;
			$resMessage = 0;
			$text_status = "Pegawai ini telah menjadi evaluator anda";
		}		

		$res = array
					(
						'status' => $res_data,
						'flag' => $resMessage,
						'text'   => $text_status
					);
		echo json_encode($res);
	}
}
  