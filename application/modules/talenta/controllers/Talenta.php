<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Talenta extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('mtalenta', '', TRUE);
		date_default_timezone_set('Asia/Jakarta');
	}

	private $year_system = 2020;		

	public function index()
	{
		$data['title'] = 'KUESIONER MANAJEMEN TALENTA';
		$data['content'] = 'talenta/data/index';
		$data['track'] = $this->mtalenta->track_progress($this->session->userdata('sesUser'));
		$id_posisi = $this->session->userdata('sesPosisi');
		$data['id_pegawai'] = $this->session->userdata('sesUser');
		$data['id_posisi'] = $id_posisi;		
		$data['infoPegawai'] = $this->Globalrules->get_info_pegawai($this->session->userdata('sesUser'),'id',$id_posisi);

		$parameter_jabatan = '';
		if($data['infoPegawai'][0]->kat_posisi == 1 && $data['infoPegawai'][0]->kat_posisi == 6)
		{
			if ($this->session->userdata('sesEs4') != 0) {
				# code...
				$parameter_jabatan = 'Pejabat Pengawas (Eselon IV)';
			}
			else
			{
				if ($this->session->userdata('sesEs3') != 0) {
					# code...
					$parameter_jabatan = 'Pejabat Administrator (Eselon III)';					
				}
				else
				{
					if ($this->session->userdata('sesEs2') != 0) {
						# code...
						$parameter_jabatan = 'Pejabat Pimpinan Tinggi Pratama (Eselon II)';						
					}
				}
			}

		}
		else
		{
			if ($data['infoPegawai'][0]->kat_posisi == 4) {
				# code...
				$parameter_jabatan = 'Pelaksana';				
			}
			else
			{
				$parameter_jabatan = 'Pejabat Fungsional Ahli Pertama';
			}
		}


		// echo "<pre>";										
		// print_r($data['track']);die();		
		// echo "</pre>";		
		

		$data['indikator'] = $this->mtalenta->getIndikator();		
		if ($data['indikator'] != 0) {
			# code...
			foreach ($data['indikator'] as $key => $value) {
				# code...
				if ($value->id_indikator != 2) {
					# code...
					$question = $this->mtalenta->getQuestion($value->id_indikator);
					if ($question != 0) {
						# code...
						for ($i=0; $i < count($question); $i++) { 
							# code...
							if ($question[$i]->id_pertanyaan != 0) {
								# code...
								$singleAnswer = $this->mtalenta->singleAnswer($question[$i]->id_pertanyaan,$data['id_pegawai']);
								$question[$i]->jawaban = ($singleAnswer != 0) ? $singleAnswer[0]->jawaban : null;
								$question[$i]->jumlah = ($singleAnswer != 0) ? $singleAnswer[0]->jumlah : null;								
							}							
						}
					}
					$data['indikator'][$key]->question = $question;					
				}
				else
				{
					$question = $this->mtalenta->getQuestionJabatan($value->id_indikator,$parameter_jabatan);
					if ($question != 0) {
						# code...
						for ($i=0; $i < count($question); $i++) { 
							# code...
							if ($question[$i]->id_pertanyaan != 0) {
								# code...
								$singleAnswer = $this->mtalenta->singleAnswer($question[$i]->id_pertanyaan,$data['id_pegawai']);
								$question[$i]->jawaban = ($singleAnswer != 0) ? $singleAnswer[0]->jawaban : null;
								$question[$i]->jumlah = ($singleAnswer != 0) ? $singleAnswer[0]->jumlah : null;								
							}							
						}
					}					
					$data['indikator'][$key]->question = $question;
				}
			}
		}

		// echo "<pre>";										
		// print_r($data['indikator']);die();		
		// echo "</pre>";
		$this->load->view('templateAdmin',$data);
	}

	public function index2()
	{
		$data['title'] = 'KUESIONER MANAJEMEN TALENTA';
		$data['content'] = 'talenta/data/index';
		$data['track'] = $this->mtalenta->track_progress($this->session->userdata('sesUser'));
		$id_posisi = $this->session->userdata('sesPosisi');
		$data['id_pegawai'] = $this->session->userdata('sesUser');
		$data['id_posisi'] = $id_posisi;		
		$data['infoPegawai'] = $this->Globalrules->get_info_pegawai($this->session->userdata('sesUser'),'id',$id_posisi);

		$parameter_jabatan = '';
		if($data['infoPegawai'][0]->kat_posisi == 1 && $data['infoPegawai'][0]->kat_posisi == 6)
		{
			if ($this->session->userdata('sesEs4') != 0) {
				# code...
				$parameter_jabatan = 'Pejabat Pengawas (Eselon IV)';
			}
			else
			{
				if ($this->session->userdata('sesEs3') != 0) {
					# code...
					$parameter_jabatan = 'Pejabat Administrator (Eselon III)';					
				}
				else
				{
					if ($this->session->userdata('sesEs2') != 0) {
						# code...
						$parameter_jabatan = 'Pejabat Pimpinan Tinggi Pratama (Eselon II)';						
					}
				}
			}

		}
		else
		{
			if ($data['infoPegawai'][0]->kat_posisi == 4) {
				# code...
				$parameter_jabatan = 'Pelaksana';				
			}
			else
			{
				$parameter_jabatan = 'Pejabat Fungsional Ahli Pertama';
			}
		}


		// echo "<pre>";										
		// print_r($data['track']);die();		
		// echo "</pre>";		
		

		$data['indikator'] = $this->mtalenta->getIndikator();		
		if ($data['indikator'] != 0) {
			# code...
			foreach ($data['indikator'] as $key => $value) {
				# code...
				if ($value->id_indikator != 2) {
					# code...
					$question = $this->mtalenta->getQuestion($value->id_indikator);
					// echo "<pre>";
					// print_r($question);die();					
					// echo "</pre>";
					// if ($question != 0) {
					// 	# code...
					// 	for ($i=0; $i < $question; $i++) { 
					// 		# code...
					// 		$singleAnswer = $this->mtalenta->singleAnswer($question[$i]->id_pertanyaan,$data['id_pegawai']);
					// 		$question[$i]->jawaban = ($singleAnswer != 0) ? $singleAnswer[0]->jawaban : null;
					// 		$question[$i]->jumlah = ($singleAnswer != 0) ? $singleAnswer[0]->jumlah : null;							
					// 	}
					// }
					$data['indikator'][$key]->question = $question;					
				}
				else
				{
					$question = $this->mtalenta->getQuestionJabatan($value->id_indikator,$parameter_jabatan);
					$data['indikator'][$key]->question = $question;
				}
			}
		}

		// echo "<pre>";										
		// print_r($data['indikator']);die();		
		// echo "</pre>";

								
		$data['atasan']       = $this->Globalrules->list_atasan($id_posisi);
		$data['atasan_plt']   = $this->Globalrules->list_atasan_plt($id_posisi);

		if ($data['atasan'] != 0) {
			# code...
			// $data['peer']         = $this->Globalrules->list_bawahan($data['atasan'][0]->posisi);
			$data['peer']         = array();			
			if ($data['atasan_plt'] != 0) {
				# code...
				$data['atasan'] = $data['atasan_plt'];
				// $data['peer']         = $this->Globalrules->list_bawahan($data['atasan_plt'][0]->posisi_plt);
				$data['atasan_plt'] = array();	
				// $data['peer']         = array();									
			}					

			// if ($data['peer'] == array()) {
			// 	# code...
			// 	if ($this->session->userdata('kat_posisi') == 4 || $this->session->userdata('kat_posisi') == 2) {
			// 		# code...
			// 		$data['peer'] = ($this->session->userdata('sesEs4') != 0) ? $this->Globalrules->get_peer(array('b.eselon4',$this->session->userdata('sesEs4')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;					
			// 		// if ($data['peer'] == 0 || count($data['peer']) < 5) {
			// 		// 	# code...
			// 		// 	$data['peer'] = ($this->session->userdata('sesEs4') != 0) ? $this->Globalrules->get_peer(array('b.eselon4',$this->session->userdata('sesEs4')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;						
			// 		// 	if ($data['peer'] == 0 || count($data['peer']) < 5) {
			// 		// 		# code...
			// 		// 		$data['peer'] = ($this->session->userdata('sesEs3') != 0) ? $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;
			// 		// 		if ($data['peer'] == 0 || count($data['peer']) < 5) {
			// 		// 			# code...
			// 		// 			$data['peer'] = ($this->session->userdata('sesEs2') != 0) ? $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon1',$this->session->userdata('sesEs1')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;
			// 		// 		}				
			// 		// 	}			
			// 		// }			
			// 	}
			// 	else{
			// 		if ($this->session->userdata('sesEs4') != 0) {
			// 			# code...
			// 			$data['peer'] = ($this->session->userdata('sesEs3') != 0) ? $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;
			// 			// echo "<pre>";
			// 			// print_r('test');die();				
			// 			// // print_r($data['peer']);die();		
			// 			// echo "</pre>";						
			// 		}					
			// 	}
			// }

			$dataStorePLT = array
					(
						'id_pegawai'         => $this->session->userdata('sesUser'),
						'id_posisi_pegawai' => $id_posisi,
						'id_pegawai_penilai' => $data['atasan'][0]->id,
						'id_posisi_pegawai_penilai' => $data['atasan'][0]->posisi,							
						// 'tahun'              => $year_system
					);
			$get_data_atasan = $this->Allcrud->getData('q_penilaian_kinerja',$dataStorePLT)->result_array();				

			if ($get_data_atasan == array()) {
				# code...
				$res_data = $this->Allcrud->addData('q_penilaian_kinerja',$dataStorePLT);			
			}					
		}
		else
		{
			if ($data['atasan_plt'] != 0) {
				# code...
				
				$data['atasan'] = $data['atasan_plt'];
				$dataStorePLT = array
						(
							'id_pegawai'         => $this->session->userdata('sesUser'),
							'id_posisi_pegawai' => $id_posisi,
							'id_pegawai_penilai' => $data['atasan'][0]->id,
							'id_posisi_pegawai_penilai' => $data['atasan'][0]->posisi,							
							// 'tahun'              => $year_system
						);
				$get_data_atasan = $this->Allcrud->getData('q_penilaian_kinerja',$dataStorePLT)->result_array();				

				if ($get_data_atasan == array()) {
					# code...
					$res_data = $this->Allcrud->addData('q_penilaian_kinerja',$dataStorePLT);			
				}													
				// $data['peer']         = $this->Globalrules->list_bawahan($data['atasan_plt'][0]->posisi_plt);
				if ($data['peer'] == array()) {
					# code...
					if ($this->session->userdata('kat_posisi') == 4 || $this->session->userdata('kat_posisi') == 2) {
						# code...
						$data['peer'] = ($this->session->userdata('sesEs4') != 0) ? $this->Globalrules->get_peer(array('b.eselon4',$this->session->userdata('sesEs4')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;					
						// if ($data['peer'] == 0 || count($data['peer']) < 5) {
						// 	# code...
						// 	$data['peer'] = ($this->session->userdata('sesEs4') != 0) ? $this->Globalrules->get_peer(array('b.eselon4',$this->session->userdata('sesEs4')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;						
						// 	if ($data['peer'] == 0 || count($data['peer']) < 5) {
						// 		# code...
						// 		$data['peer'] = ($this->session->userdata('sesEs3') != 0) ? $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;
						// 		if ($data['peer'] == 0 || count($data['peer']) < 5) {
						// 			# code...
						// 			$data['peer'] = ($this->session->userdata('sesEs2') != 0) ? $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon1',$this->session->userdata('sesEs1')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;
						// 		}				
						// 	}			
						// }			
					}
					else{
						if ($this->session->userdata('sesEs4') != 0) {
							# code...
							$data['peer'] = ($this->session->userdata('sesEs3') != 0) ? $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;							
						}					
					}
				}				
				$data['atasan_plt'] = array();										
			}
			else
			{
				$data['atasan'] = $data['atasan_akademik'];
				if ($data['atasan'] != 0 ) {
					# code...
					$dataStorePLT = array
							(
								'id_pegawai'         => $this->session->userdata('sesUser'),
								'id_posisi_pegawai' => $id_posisi,
								'id_pegawai_penilai' => $data['atasan'][0]->id,
								'id_posisi_pegawai_penilai' => $data['atasan'][0]->posisi,							
								// 'tahun'              => $year_system
							);
					$get_data_atasan = $this->Allcrud->getData('q_penilaian_kinerja',$dataStorePLT)->result_array();				

					if ($get_data_atasan == array()) {
						# code...
						$res_data = $this->Allcrud->addData('q_penilaian_kinerja',$dataStorePLT);			
					}							
					$data['peer']         = $this->Globalrules->list_bawahan($data['atasan'][0]->posisi_akademik);
					// echo "<pre>";
					// print_r('test');die();				
					// // print_r($data['peer']);die();		
					// echo "</pre>";					
				}
				else
				{
					$data['peer'] = 0;
				}
			}		

		}	
		
		$data['bawahan']      = $this->Globalrules->list_bawahan($id_posisi);		

		$data['bawahan_plt']  = array();
		if ($this->session->userdata('posisi_plt') != 0) {
			# code...
			$data['bawahan_plt']  = $this->Globalrules->list_bawahan($this->session->userdata('posisi_plt'));			
		}

		if ($data['bawahan_plt'] != array()) {
			# code...
			$data['atasan_plt']       = $this->Globalrules->list_atasan_plt($this->session->userdata('posisi_plt'));			
		
			if ($data['atasan_plt'] != 0) {
				# code...
				// $data['peer']         = $this->Globalrules->list_bawahan($data['atasan_plt'][0]->posisi_plt);				
			}						
		}
		
		
		$data['bawahan_koor']  = array();


		$get_data_posisi_plt = $this->Allcrud->getData('mr_posisi',array('id'=>$this->session->userdata('posisi_plt')))->result_array();
		if ($get_data_posisi_plt) {
			# code...
			if ($get_data_posisi_plt[0]['eselon4'] != 0) {
				# code...
				$data['peer'] = $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$get_data_posisi_plt[0]['kat_posisi'])) ;
			}
			else
			{
				if ($get_data_posisi_plt[0]['eselon3'] != 0) {
					# code...
					$data['peer'] = $this->Globalrules->get_peer(array('b.eselon1',$this->session->userdata('sesEs1')),array('b.kat_posisi',$get_data_posisi_plt[0]['kat_posisi'])) ;
					// echo "<pre>";
					// // print_r($get_data_posisi_plt[0]);die();				
					// print_r($data['peer']);die();		
					// echo "</pre>";						
				}
				else
				{
					if ($get_data_posisi_plt[0]['eselon2'] != 0) {
						# code...
						$data['peer'] = $this->Globalrules->get_peer(array('b.eselon1',$this->session->userdata('sesEs1')),array('b.kat_posisi',$get_data_posisi_plt[0]['kat_posisi'])) ;
						// echo "<pre>";
						// // print_r($get_data_posisi_plt[0]);die();				
						// print_r($data['peer']);die();		
						// echo "</pre>";						
					}
					else
					{
						$data['peer'] = $this->Globalrules->get_peer(array('b.eselon1',$this->session->userdata('sesEs1')),array('b.kat_posisi',$get_data_posisi_plt[0]['kat_posisi'])) ;						
					}					
				}					
			}
			
		}
		else
		{
			$data['peer'] = $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;			
			// $data['peer'] = ($this->session->userdata('sesEs4') != 0) ? $this->Globalrules->get_peer(array('b.eselon4',$this->session->userdata('sesEs4')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;
			// echo "<pre>";
			// // print_r($get_data_posisi_plt[0]);die();				
			// print_r($data['peer']);die();		
			// echo "</pre>";				
		}
		// echo "<pre>";
		// print_r($get_data_posisi_plt[0]['kat_posisi']);die();				
		// // print_r($data['peer']);die();		
		// echo "</pre>";			
		// if ($data['peer'] == 0 || count($data['peer']) < 5) {
		// 	# code...
		// 	$data['peer'] = ($this->session->userdata('sesEs4') != 0) ? $this->Globalrules->get_peer(array('b.eselon4',$this->session->userdata('sesEs4')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;						
		// 	if ($data['peer'] == 0 || count($data['peer']) < 5) {
		// 		# code...
		// 		$data['peer'] = ($this->session->userdata('sesEs3') != 0) ? $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;
		// 		if ($data['peer'] == 0 || count($data['peer']) < 5) {
		// 			# code...
		// 			$data['peer'] = ($this->session->userdata('sesEs2') != 0) ? $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon1',$this->session->userdata('sesEs1')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;
		// 		}				
		// 	}			
		// }			

		$data['request_eval'] = $this->mtalenta->get_request_eval($this->session->userdata('sesUser'));
		$data['evaluator']    = $this->mtalenta->get_data_evaluator($this->session->userdata('sesUser'));		
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// die();
		$data['pegawai_terbaik'] = $data['peer'];
		$data['pegawai_terbaik1'] = $data['peer'];
		$data['pegawai_terbaik2'] = $data['peer'];
		$data['pegawai_terbaik3'] = $data['peer'];
		$data['pegawai_terbaik4'] = $data['peer'];
		$data['pegawai_terbaik5'] = $data['peer'];												
		$this->load->view('templateAdmin',$data);
	}	

	public function checkProgress($id_pegawai,$progress)
	{
		# code...
		$getIndicator = $this->mtalenta->getIndicatorProgess($progress);
		$id_indicator = $getIndicator[0]->id;

		$getQuestion = $this->mtalenta->getQuestion($id_indicator);
		$getQuestionPegawai = $this->mtalenta->getQuestionPegawai($id_indicator,$id_pegawai);

		echo json_encode([
			'question' => count($getQuestion),
			'questionPegawai' => $getQuestionPegawai
		]);		
		// print_r(count($getQuestion));die();		
		// print_r($getQuestionPegawai);die();
	}

	public function nextProgress($id_pegawai,$next)
	{
		# code...
		$track = $this->mtalenta->track_progress($this->session->userdata('sesUser'));
		if ($track == 1) {
			# code...
			$data_detail = array
						(
							'id_q_talenta_indikator' => $track,
							'id_pegawai'			=> $id_pegawai
						);
			$res_data    = $this->Allcrud->addData('q_talenta_progress',$data_detail);			
		}
		else
		{
			$data = array
						(
							'id_q_talenta_indikator' => $track,
							'id_pegawai'			=> $id_pegawai
						);

			$flag     = array
			(
				'id_q_talenta_indikator' => $track-1,
				'id_pegawai'			=> $id_pegawai
			);
			$res_data = $this->Allcrud->editData('q_talenta_progress',$data,$flag);			
		}

		echo json_encode('ok');
		// $this->Allcrud->editData('tr_capaian_pekerjaan',$data,$flag)		
	}

	public function progress($progress)
	{
		# code...
		$question = $this->mtalenta->getAnswer($progress);		

		$counter = ($question == 0) ? 0 : count($question);
		echo json_encode($counter);
	}

	public function yesOrno($id_pertanyaan,$id_pegawai,$params)
	{
		# code...
		$payload = [
			'id_q_talenta_pertanyaan' => $id_pertanyaan,
			'id_pegawai' => $id_pegawai,
			'jawaban' => $params
		];

		$checkData = $this->mtalenta->checkDataJawaban($payload);

		if($checkData == 0)
		{
			$res_data = $this->Allcrud->addData('q_single_jawaban',$payload);			
		}
		else
		{
			$flag     = array
			(
				'id_q_talenta_pertanyaan' => $id_pertanyaan,
				'id_pegawai' => $id_pegawai,
			);
			$res_data = $this->Allcrud->editData('q_single_jawaban',$payload,$flag);			
		}
	}

	public function upload_file($id_pertanyaan,$id_pegawai,$params)
	{
		# code...
		$this->Globalrules->session_rule();
		$id_pekerjaan            = "";
		$file_pendukung          = "";
		$res_data                = "";
		$text_status             = "";
		$nip                     = $this->session->userdata('sesNip');
		$config['upload_path']   = FCPATH."/public/survey_talenta/".$nip."/";
		$config['allowed_types'] = 'pdf|rar|zip';
		$config['max_size']      = '2000';
		$data                    = "";
		$this->load->library('upload', $config);
		
		if(!is_dir("public/survey_talenta/".$nip."/"))
		{
			mkdir("public/survey_talenta/".$nip."/", 0755);
		}

        if ( ! $this->upload->do_upload('file')){
			$res_data       = 0;
			$text_status    = $this->upload->display_errors();
			$file_pendukung = "";
        }
        else
        {
			$res_data       = 1;
			$dataupload     = $this->upload->data();
			$status         = "success";
			$text_status    = $dataupload['file_name']." berhasil diupload";
			$file_pendukung = $this->upload->data('file_name');

			$payload = [
				'id_q_talenta_pertanyaan' => $id_pertanyaan,
				'id_pegawai' => $id_pegawai,
				'jawaban' => $dataupload['file_name']
			];
	
			$checkData = $this->mtalenta->checkDataJawaban($payload);

			if ($params != 'checkbox') {
				# code...
				$payload['jumlah'] = $params;
				if($checkData == 0)
				{
					$res_data = $this->Allcrud->addData('q_single_jawaban',$payload);			
				}				
			}	
			else {
				
				$dataText = $this->input->post('text');
				$payload['jumlah'] = $dataText;
				if($checkData == 0)
				{
					$res_data = $this->Allcrud->addData('q_single_jawaban',$payload);			
				}
			}		
        }

		if ($text_status == '<p>You did not select a file to upload.</p>') {
			# code...
			$res_data = 1;
			$text_status = "";
		}

		$res = array
					(
						// 'id'     => $res_data_id,
						'status' => $res_data,
						'text'   => $text_status,
						// 'filename' => $dataupload['file_name']
					);
		echo json_encode($res);
	}

	public function penilaian_kinerja()
	{
		# code...
		$id_posisi = $this->session->userdata('sesPosisi');
		$data['id_pegawai'] = $this->session->userdata('sesUser');
		$data['id_posisi'] = $id_posisi;		
		$data['infoPegawai']             = $this->Globalrules->get_info_pegawai($this->session->userdata('sesUser'),'id',$id_posisi);		
		$data['title'] = 'KUESIONER MANAJEMEN TALENTA - Penilaian Kinerja 360';
		$data['content'] = 'talenta/data/penilaian_kinerja';		
		$data['atasan']       = $this->Globalrules->list_atasan($id_posisi);
		$data['atasan_plt']   = $this->Globalrules->list_atasan_plt($id_posisi);

		if ($data['atasan'] != 0) {
			# code...
			// $data['peer']         = $this->Globalrules->list_bawahan($data['atasan'][0]->posisi);
			$data['peer']         = array();			
			if ($data['atasan_plt'] != 0) {
				# code...
				$data['atasan'] = $data['atasan_plt'];
				// $data['peer']         = $this->Globalrules->list_bawahan($data['atasan_plt'][0]->posisi_plt);
				$data['atasan_plt'] = array();	
				// $data['peer']         = array();									
			}					

			// if ($data['peer'] == array()) {
			// 	# code...
			// 	if ($this->session->userdata('kat_posisi') == 4 || $this->session->userdata('kat_posisi') == 2) {
			// 		# code...
			// 		$data['peer'] = ($this->session->userdata('sesEs4') != 0) ? $this->Globalrules->get_peer(array('b.eselon4',$this->session->userdata('sesEs4')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;					
			// 		// if ($data['peer'] == 0 || count($data['peer']) < 5) {
			// 		// 	# code...
			// 		// 	$data['peer'] = ($this->session->userdata('sesEs4') != 0) ? $this->Globalrules->get_peer(array('b.eselon4',$this->session->userdata('sesEs4')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;						
			// 		// 	if ($data['peer'] == 0 || count($data['peer']) < 5) {
			// 		// 		# code...
			// 		// 		$data['peer'] = ($this->session->userdata('sesEs3') != 0) ? $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;
			// 		// 		if ($data['peer'] == 0 || count($data['peer']) < 5) {
			// 		// 			# code...
			// 		// 			$data['peer'] = ($this->session->userdata('sesEs2') != 0) ? $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon1',$this->session->userdata('sesEs1')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;
			// 		// 		}				
			// 		// 	}			
			// 		// }			
			// 	}
			// 	else{
			// 		if ($this->session->userdata('sesEs4') != 0) {
			// 			# code...
			// 			$data['peer'] = ($this->session->userdata('sesEs3') != 0) ? $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;
			// 			// echo "<pre>";
			// 			// print_r('test');die();				
			// 			// // print_r($data['peer']);die();		
			// 			// echo "</pre>";						
			// 		}					
			// 	}
			// }

			$dataStorePLT = array
					(
						'id_pegawai'         => $this->session->userdata('sesUser'),
						'id_posisi_pegawai' => $id_posisi,
						'id_pegawai_penilai' => $data['atasan'][0]->id,
						'id_posisi_pegawai_penilai' => $data['atasan'][0]->posisi,							
						// 'tahun'              => $year_system
					);
			$get_data_atasan = $this->Allcrud->getData('q_penilaian_kinerja',$dataStorePLT)->result_array();				

			if ($get_data_atasan == array()) {
				# code...
				$res_data = $this->Allcrud->addData('q_penilaian_kinerja',$dataStorePLT);			
			}					
		}
		else
		{
			if ($data['atasan_plt'] != 0) {
				# code...
				
				$data['atasan'] = $data['atasan_plt'];
				$dataStorePLT = array
						(
							'id_pegawai'         => $this->session->userdata('sesUser'),
							'id_posisi_pegawai' => $id_posisi,
							'id_pegawai_penilai' => $data['atasan'][0]->id,
							'id_posisi_pegawai_penilai' => $data['atasan'][0]->posisi,							
							// 'tahun'              => $year_system
						);
				$get_data_atasan = $this->Allcrud->getData('q_penilaian_kinerja',$dataStorePLT)->result_array();				

				if ($get_data_atasan == array()) {
					# code...
					$res_data = $this->Allcrud->addData('q_penilaian_kinerja',$dataStorePLT);			
				}													
				// $data['peer']         = $this->Globalrules->list_bawahan($data['atasan_plt'][0]->posisi_plt);
				if ($data['peer'] == array()) {
					# code...
					if ($this->session->userdata('kat_posisi') == 4 || $this->session->userdata('kat_posisi') == 2) {
						# code...
						$data['peer'] = ($this->session->userdata('sesEs4') != 0) ? $this->Globalrules->get_peer(array('b.eselon4',$this->session->userdata('sesEs4')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;					
						// if ($data['peer'] == 0 || count($data['peer']) < 5) {
						// 	# code...
						// 	$data['peer'] = ($this->session->userdata('sesEs4') != 0) ? $this->Globalrules->get_peer(array('b.eselon4',$this->session->userdata('sesEs4')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;						
						// 	if ($data['peer'] == 0 || count($data['peer']) < 5) {
						// 		# code...
						// 		$data['peer'] = ($this->session->userdata('sesEs3') != 0) ? $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;
						// 		if ($data['peer'] == 0 || count($data['peer']) < 5) {
						// 			# code...
						// 			$data['peer'] = ($this->session->userdata('sesEs2') != 0) ? $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon1',$this->session->userdata('sesEs1')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;
						// 		}				
						// 	}			
						// }			
					}
					else{
						if ($this->session->userdata('sesEs4') != 0) {
							# code...
							$data['peer'] = ($this->session->userdata('sesEs3') != 0) ? $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;							
						}					
					}
				}				
				$data['atasan_plt'] = array();										
			}
			else
			{
				$data['atasan'] = $data['atasan_akademik'];
				if ($data['atasan'] != 0 ) {
					# code...
					$dataStorePLT = array
							(
								'id_pegawai'         => $this->session->userdata('sesUser'),
								'id_posisi_pegawai' => $id_posisi,
								'id_pegawai_penilai' => $data['atasan'][0]->id,
								'id_posisi_pegawai_penilai' => $data['atasan'][0]->posisi,							
								// 'tahun'              => $year_system
							);
					$get_data_atasan = $this->Allcrud->getData('q_penilaian_kinerja',$dataStorePLT)->result_array();				

					if ($get_data_atasan == array()) {
						# code...
						$res_data = $this->Allcrud->addData('q_penilaian_kinerja',$dataStorePLT);			
					}							
					$data['peer']         = $this->Globalrules->list_bawahan($data['atasan'][0]->posisi_akademik);
					// echo "<pre>";
					// print_r('test');die();				
					// // print_r($data['peer']);die();		
					// echo "</pre>";					
				}
				else
				{
					$data['peer'] = 0;
				}
			}		

		}	
		
		$data['bawahan']      = $this->Globalrules->list_bawahan($id_posisi);		

		$data['bawahan_plt']  = array();
		if ($this->session->userdata('posisi_plt') != 0) {
			# code...
			$data['bawahan_plt']  = $this->Globalrules->list_bawahan($this->session->userdata('posisi_plt'));			
		}

		if ($data['bawahan_plt'] != array()) {
			# code...
			$data['atasan_plt']       = $this->Globalrules->list_atasan_plt($this->session->userdata('posisi_plt'));			
		
			if ($data['atasan_plt'] != 0) {
				# code...
				// $data['peer']         = $this->Globalrules->list_bawahan($data['atasan_plt'][0]->posisi_plt);				
			}						
		}
		
		
		$data['bawahan_koor']  = array();


		$get_data_posisi_plt = $this->Allcrud->getData('mr_posisi',array('id'=>$this->session->userdata('posisi_plt')))->result_array();
		if ($get_data_posisi_plt) {
			# code...
			if ($get_data_posisi_plt[0]['eselon4'] != 0) {
				# code...
				$data['peer'] = $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$get_data_posisi_plt[0]['kat_posisi'])) ;
			}
			else
			{
				if ($get_data_posisi_plt[0]['eselon3'] != 0) {
					# code...
					$data['peer'] = $this->Globalrules->get_peer(array('b.eselon1',$this->session->userdata('sesEs1')),array('b.kat_posisi',$get_data_posisi_plt[0]['kat_posisi'])) ;
					// echo "<pre>";
					// // print_r($get_data_posisi_plt[0]);die();				
					// print_r($data['peer']);die();		
					// echo "</pre>";						
				}
				else
				{
					if ($get_data_posisi_plt[0]['eselon2'] != 0) {
						# code...
						$data['peer'] = $this->Globalrules->get_peer(array('b.eselon1',$this->session->userdata('sesEs1')),array('b.kat_posisi',$get_data_posisi_plt[0]['kat_posisi'])) ;
						// echo "<pre>";
						// // print_r($get_data_posisi_plt[0]);die();				
						// print_r($data['peer']);die();		
						// echo "</pre>";						
					}
					else
					{
						$data['peer'] = $this->Globalrules->get_peer(array('b.eselon1',$this->session->userdata('sesEs1')),array('b.kat_posisi',$get_data_posisi_plt[0]['kat_posisi'])) ;						
					}					
				}					
			}
			
		}
		else
		{
			$data['peer'] = $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;			
			// $data['peer'] = ($this->session->userdata('sesEs4') != 0) ? $this->Globalrules->get_peer(array('b.eselon4',$this->session->userdata('sesEs4')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;
			// echo "<pre>";
			// // print_r($get_data_posisi_plt[0]);die();				
			// print_r($data['peer']);die();		
			// echo "</pre>";				
		}
		// echo "<pre>";
		// print_r($get_data_posisi_plt[0]['kat_posisi']);die();				
		// // print_r($data['peer']);die();		
		// echo "</pre>";			
		// if ($data['peer'] == 0 || count($data['peer']) < 5) {
		// 	# code...
		// 	$data['peer'] = ($this->session->userdata('sesEs4') != 0) ? $this->Globalrules->get_peer(array('b.eselon4',$this->session->userdata('sesEs4')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;						
		// 	if ($data['peer'] == 0 || count($data['peer']) < 5) {
		// 		# code...
		// 		$data['peer'] = ($this->session->userdata('sesEs3') != 0) ? $this->Globalrules->get_peer(array('b.eselon3',$this->session->userdata('sesEs3')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;
		// 		if ($data['peer'] == 0 || count($data['peer']) < 5) {
		// 			# code...
		// 			$data['peer'] = ($this->session->userdata('sesEs2') != 0) ? $this->Globalrules->get_peer(array('b.eselon2',$this->session->userdata('sesEs2')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) : $this->Globalrules->get_peer(array('b.eselon1',$this->session->userdata('sesEs1')),array('b.kat_posisi',$this->session->userdata('kat_posisi'))) ;
		// 		}				
		// 	}			
		// }			

		$data['request_eval'] = $this->mtalenta->get_request_eval($this->session->userdata('sesUser'));
		$data['evaluator']    = $this->mtalenta->get_data_evaluator($this->session->userdata('sesUser'));		
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// die();
		$data['pegawai_terbaik'] = $data['peer'];
		$data['pegawai_terbaik1'] = $data['peer'];
		$data['pegawai_terbaik2'] = $data['peer'];
		$data['pegawai_terbaik3'] = $data['peer'];
		$data['pegawai_terbaik4'] = $data['peer'];
		$data['pegawai_terbaik5'] = $data['peer'];										
		$this->load->view('templateAdmin',$data);		
	}

	public function set_evaluator_prilaku()
	{
		// $year_system          = $this->year_system;		
		$data_sender          = $this->input->post('data_sender');
		$text_status = "";
		$res_data = 0; $resMessage = 0;
		$data = array
				(
					'id_pegawai'         => $data_sender['pegawai'],
					'id_posisi_pegawai' => $data_sender['posisi'],
					'id_pegawai_penilai' => $data_sender['id_pegawai'],
					'id_posisi_pegawai_penilai' => $data_sender['id_posisi'],							
					// 'tahun'              => $year_system
				);
		$get_data = $this->Allcrud->getData('q_penilaian_kinerja',$data)->result_array();				

		if ($get_data == array()) {
			# code...
			$res_data = $this->Allcrud->addData('q_penilaian_kinerja',$data);			
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

	public function get_penilaian_kinerja($id_evaluator,$id_pegawai)
	{
		# code...
		$data['question'] = $this->mtalenta->getQuestion(5);
		echo json_encode($data);		
	}

	public function likertAntarPegawai($id_pegawai,$id_pegawai_penilai,$id_pertanyaan,$value)
	{
		# code...
		$payload = [
			'id_q_talenta_pertanyaan' => $id_pertanyaan,
			'id_pegawai' => $id_pegawai,
			'id_pegawai_penilai' => $id_pegawai_penilai,
			'jawaban' => $value
		];

		$checkData = $this->mtalenta->checkDataJawabanKinerja($payload);

		if($checkData == 0)
		{
			$res_data = $this->Allcrud->addData('q_kinerja_jawaban',$payload);			
		}


		$question = $this->mtalenta->getQuestion(5);
		$data['question'] = count($question);
		$data['answer']    = $this->Allcrud->getData('q_kinerja_jawaban',array(
			'id_pegawai' => $id_pegawai,
			'id_pegawai_penilai' => $id_pegawai_penilai			
		))->num_rows();
		if ($data['question'] == $data['answer']) {
			# code...
			$data['reload'] = 1;
			$dataStore = array
			(
				'status' => 1
			);

			$flag     = array
			(
				'id_pegawai' => $id_pegawai,
				'id_pegawai_penilai' => $id_pegawai_penilai
			);
			$res_data = $this->Allcrud->editData('q_penilaian_kinerja',$dataStore,$flag);			
		}
		else{
			$data['reload'] = 0;			
		}

		echo json_encode($data);
	}
}
