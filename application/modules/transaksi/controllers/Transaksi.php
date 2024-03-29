<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaksi extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('mtrx', '', TRUE);
		$this->load->model ('skp/mskp', '', TRUE);
		date_default_timezone_set('Asia/Jakarta');
	}

	private $year_system = 2020;		

	public function index()
	{
		redirect('dashboard/home');
	}

	public function refresh_data($param=NULL,$flag=NULL)
	{
		# code...
		$data['list']         = $this->mtrx->status_pekerjaan($param,$this->session->userdata('sesUser'));		
		$data['hari_kerja']   = $this->mtrx->get_hari_kerja(date('m'),date('Y'));
		$data['infoPegawai']  = $this->Globalrules->get_info_pegawai($this->session->userdata('sesUser'),'id',$this->session->userdata('sesPosisi'));		
		$data['id_html']      = $flag;
		$this->load->view('transaksi/trx/refresh/index',$data);		
	}	

	public function refresh_data2()
	{
		# code...
		$data['list']			= $this->mtrx->list_transaksi($this->session->userdata('sesUser'),$this->session->userdata('sesPosisi'));
		$data['hari_kerja']     = $this->mtrx->get_hari_kerja(date('m'),date('Y'));
		$data['infoPegawai']    = $this->Globalrules->check_pegawai($this->session->userdata('sesUser'));
		$this->load->view('transaksi/trx/ajax_transaksi',$data);
	}

	public function home($arg=NULL)
	{
		$checkSurvey = $this->Globalrules->getSurvey()->result_array();
		if (count($checkSurvey) == 0) {
			# code...
			if ($this->session->userdata('sesEs1') != 0) {
				# code...
				if ($this->session->userdata('sesEs2') != 0) {
					# code...
					redirect('/survey-kepegawaian');											
				}
			}
		}
		// if ($this->session->userdata('sesSurveyKepeg') == 0) {
		// 	# code...
		// 	redirect('/survey-kepegawaian');											
		// }		
		// if ($this->session->userdata('surveyIsDone') == 0) {
		// 	redirect('surveytalenta/talenta');				
		// }		
		$data['title']      	= 'Transaksi';
		$data['content']    	= 'transaksi/trx/data_transaksi2';
		$data['list']			= $this->mtrx->list_transaksi($this->session->userdata('sesUser'),$this->session->userdata('sesPosisi'));
		// $data['urtug']          = $this->mskp->get_data_skp_pegawai($this->session->userdata('sesUser'),$this->session->userdata('sesPosisi'),$this->year_system,'approve',1);
		$data['urtug']          = $this->mskp->get_data_skp_pegawai($this->session->userdata('sesUser'),$this->session->userdata('sesPosisi'),2023,'approve',1);
		$data['hari_kerja']     = $this->mtrx->get_hari_kerja(date('m'),date('Y'));
		$data['infoPegawai']    = $this->Globalrules->check_pegawai($this->session->userdata('sesUser'));
		$data['member']         = $this->Globalrules->list_bawahan($this->session->userdata('sesPosisi'));
		$data['arg']            = $arg;

		if ($data['urtug'] != 0) {
			# code...
			for ($i=0; $i < count($data['urtug']); $i++) 
			{
				if ($data['urtug'][$i]->id_skp_master == '') {
					# code...
					$data['urtug'][$i]->id_skp_master = 0;                                                                        
				}

				if ($data['urtug'][$i]->id_skp_jft == '') {
					# code...
					$data['urtug'][$i]->id_skp_jft = 0;                                                                        
				}                         
				
				if ($data['urtug'][$i]->id_skp_jfu == '') {
					# code...
					$data['urtug'][$i]->id_skp_jfu = 0;                                                                        
				}                                 				
			}			
		}
		if ($data['member'] != 0) {
			// code...
			for ($i=0; $i < count($data['member']); $i++) {
				// code...
				$get_data           = $this->Allcrud->getData('tr_capaian_pekerjaan',array('status_pekerjaan'=>0,'id_pegawai'=>$data['member'][$i]->id,'tanggal_mulai LIKE'=>date('Y-m').'%'))->num_rows();
				$get_data_keberatan = $this->Allcrud->getData('tr_capaian_pekerjaan',array('status_pekerjaan'=>4,'id_pegawai'=>$data['member'][$i]->id,'tanggal_mulai LIKE'=>date('Y-m').'%'))->num_rows();
				if ($get_data) {
					// code...
					$data['member'][$i]->counter_belum_diperiksa = $get_data;
				}
				else {
					// code...
					$data['member'][$i]->counter_belum_diperiksa = 0;
				}

				if ($get_data_keberatan) {
					// code...
					$data['member'][$i]->counter_keberatan = $get_data_keberatan;
				}
				else {
					// code...
					$data['member'][$i]->counter_keberatan = 0;
				}				
			}
		}
		// print_r($data['list']);die();
		$this->load->view('templateAdmin',$data);
	}

	public function home2($arg=NULL)
	{
		// if ($this->session->userdata('sesSurveyKepeg') == 0) {
			// # code...
			// redirect('/survey-kepegawaian');											
		// }		
		$checkSurvey = $this->Globalrules->getSurvey()->result_array();
		if (count($checkSurvey) == 0) {
			# code...
			if ($this->session->userdata('sesEs1') != 0) {
				# code...
				if ($this->session->userdata('sesEs2') != 0) {
					# code...
					redirect('/survey-kepegawaian');											
				}
			}
		}		
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		// if ($this->session->userdata('surveyIsDone') == 0) {
		// 	redirect('surveytalenta/talenta');				
		// }		
		$data['arg']                  = $arg;		
		$data['title']                = 'Transaksi';
		$data['content']              = 'transaksi/trx/data_transaksi';
		$flag                         = array('tahun'=>date('Y'),'id_pegawai' =>$this->session->userdata('sesUser'));		
		$data['urtug']                = $this->mskp->get_data_skp_pegawai($this->session->userdata('sesUser'),$this->session->userdata('sesPosisi'),2023,'approve',1);
		$data['tr_belum_diperiksa']   = $this->mtrx->status_pekerjaan('0',$this->session->userdata('sesUser'));
		$data['tr_disetujui']         = $this->mtrx->status_pekerjaan('1',$this->session->userdata('sesUser'));
		$data['tr_tolak']             = $this->mtrx->status_pekerjaan('2',$this->session->userdata('sesUser'));
		$data['tr_revisi']            = $this->mtrx->status_pekerjaan('3',$this->session->userdata('sesUser'));
		$data['tr_keberatan']         = $this->mtrx->status_pekerjaan('4',$this->session->userdata('sesUser'));
		$data['tr_keberatan_ditolak'] = $this->mtrx->status_pekerjaan('5',$this->session->userdata('sesUser'));
		$data['tr_banding']           = $this->mtrx->status_pekerjaan('6',$this->session->userdata('sesUser'));
		$data['tr_banding_ditolak']   = $this->mtrx->status_pekerjaan('7',$this->session->userdata('sesUser'));
		$data['hari_kerja']           = $this->mtrx->get_hari_kerja(date('m'),date('Y'));
		$data['infoPegawai']          = $this->Globalrules->get_info_pegawai($this->session->userdata('sesUser'),'id',$this->session->userdata('sesPosisi'));
		$data['member']               = $this->Globalrules->list_bawahan($this->session->userdata('sesPosisi'));
		// echo "<pre>";
		// print_r($data['member']);die();		
		// echo "</pre>";
		if ($data['urtug'] != 0) {
			# code...
			for ($i=0; $i < count($data['urtug']); $i++) 
			{
				if ($data['urtug'][$i]->id_skp_master == '') {
					# code...
					$data['urtug'][$i]->id_skp_master = 0;                                                                        
				}

				if ($data['urtug'][$i]->id_skp_jft == '') {
					# code...
					$data['urtug'][$i]->id_skp_jft = 0;                                                                        
				}                         
				
				if ($data['urtug'][$i]->id_skp_jfu == '') {
					# code...
					$data['urtug'][$i]->id_skp_jfu = 0;                                                                        
				}                                 				
			}			
		}
		if ($data['member'] != 0) {
			// code...
			for ($i=0; $i < count($data['member']); $i++) {
				// code...
				$get_data           = $this->Allcrud->getData('tr_capaian_pekerjaan',array('status_pekerjaan'=>0,'id_pegawai'=>$data['member'][$i]->id,'tanggal_mulai LIKE'=>date('Y-m').'%'))->num_rows();
				$get_data_keberatan = $this->Allcrud->getData('tr_capaian_pekerjaan',array('status_pekerjaan'=>4,'id_pegawai'=>$data['member'][$i]->id,'tanggal_mulai LIKE'=>date('Y-m').'%'))->num_rows();
				if ($get_data) {
					// code...
					$data['member'][$i]->counter_belum_diperiksa = $get_data;
				}
				else {
					// code...
					$data['member'][$i]->counter_belum_diperiksa = 0;
				}

				if ($get_data_keberatan) {
					// code...
					$data['member'][$i]->counter_keberatan = $get_data_keberatan;
				}
				else {
					// code...
					$data['member'][$i]->counter_keberatan = 0;
				}				
			}
		}
		// echo "<pre>";
		// print_r($data['urtug']);die();
		// echo "</pre>";

		$this->load->view('templateAdmin',$data);
	}	

	Public function filter_transaksi()
	{
		$id			 = $this->session->userdata('sesUser');
		$posisi		 = $this->session->userdata('sesPosisi');
		$data_sender = $this->input->post('data_sender');	
		$data_sender = array
						(
							'bulan'    => $data_sender['data_5'],
							'tahun'    => $data_sender['data_6'],
							'status'   => $data_sender['data_7'],
							'member'   => $data_sender['data_8']
						);
		// print_r($data_sender);die();
		if ($data_sender['member'] != 0) 
		{
			$data['infoPegawai']    = $this->Globalrules->check_pegawai($data_sender['member']);
			// print_r($data['infoPegawai'][0]);die();
			$member 				= $data['infoPegawai'][0]->id;
			$posisi_member			= $data['infoPegawai'][0]->posisi;
			$data['list'] 			= $this->mtrx->list_transaksi($member,$posisi_member,$data_sender);
		}
		else
		{
			$data['infoPegawai']    = $this->Globalrules->check_pegawai($id);
			$data['list'] 			= $this->mtrx->list_transaksi($id,$posisi,$data_sender);
		}
		
		if ($data['list'] != 0) 
		{
			$this->load->view('transaksi/trx/ajax_transaksi',$data);
		}
	}

	public function get_detail_bawahan()
	{
		# code...
		$this->Globalrules->session_rule();
		$id  = $this->input->post('id');
		$res = $this->Globalrules->check_pegawai($id);
		echo json_encode($res);
	}

	public function kinerja_anggota($param=NULL,$id_pegawai=NULL)
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$pegawai                 = "";
		if ($id_pegawai != NULL)$pegawai = $this->Globalrules->get_info_pegawai($id_pegawai,'id');
		$data['title']           = 'Transaksi';
		$data['content']         = 'transaksi/trx/data_kinerja_anggota';
		$data['kinerja_anggota'] = $this->mtrx->get_kinerja_anggota('0',$this->session->userdata('sesPosisi'),$id_pegawai);
		$data['keberatan']       = $this->mtrx->get_kinerja_anggota('4',$this->session->userdata('sesPosisi'),$id_pegawai);
		$data['banding']         = $this->mtrx->get_kinerja_banding($this->session->userdata('sesUser'),$id_pegawai);
		$data['param']           = $param;
		$data['pegawai']         = $pegawai;
		$this->load->view('templateAdmin',$data);
	}

	public function add_pekerjaan_without_file()
	{
		# code...
		$this->Globalrules->session_rule();
		$res_data        = "";
		$data_sender     = $this->input->post('data_sender');
		$res_data_id     = $this->Allcrud->insert_transaksi
						(
							$this->session->userdata('sesUser'),
							$this->session->userdata('sesPosisi'),
							$data_sender['urtug'],
							date('Y-m-d', strtotime($data_sender['tgl_mulai_raw'])),
							date('Y-m-d', strtotime($data_sender['tgl_selesai_raw'])),
							$data_sender['jam_mulai'],
							$data_sender['jam_selesai'],
							$data_sender['ket_pekerjaan'],
							$data_sender['kuantitas'],
							$data_sender['file_pendukung'],
							'' //source_Data
						);

		if ($res_data_id != 0) {
			# code...
			$res_data = 1;
		}
		else {
			# code...
			$res_data = 0;
		}

		// $this->notify_capaian_kerja(' telah mengajukan laporan pekerjaan','transaksi/home/',$res_data_id,'approval');
		$text_status = $this->Globalrules->check_status_res($res_data,'Pekerjaan Telah ditambah');		

		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}

	public function upload_file_pendukung($param=NULL,$id=NULL)
	{
		# code...
		$this->Globalrules->session_rule();
		$id_pekerjaan            = "";
		$file_pendukung          = "";
		$res_data                = "";
		$text_status             = "";
		$nip                     = $this->session->userdata('sesNip');
		$config['upload_path']   = FCPATH."/public/file_pendukung/".$nip."/";
		$config['allowed_types'] = 'pdf|csv|docx|doc|xlsx|xl|xls|jpg|jpeg|png|ppt|pptx';
		$config['max_size']      = '3000';
		$data                    = "";
		$this->load->library('upload', $config);
		
		if(!is_dir("public/file_pendukung/".$nip."/"))
		{
			mkdir("public/file_pendukung/".$nip."/", 0755);
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
						'filename' => $dataupload['file_name']
					);
		echo json_encode($res);
	}
	
	public function approve($id)
	{
		# code...
		$this->Globalrules->session_rule();
		$id_atasan 	 = $this->session->userdata('sesUser');
		$info         = $this->mtrx->get_transaksi_id_x($id);
		$res_data = 0;
		if ($info != 0) {
			# code...
			if ($info[0]->status_pegawai == 1) {
				# code...
				$res_data    = $this->Allcrud->approve_transaksi(1,$id,$id_atasan);
				if ($res_data > 0) {
					$res_data = 1;
				}
			}
			else
			{
				$res_data    = $this->Allcrud->approve_transaksi_cpns(1,$id,$id_atasan);
				if ($res_data > 0) {
					$res_data = 1;
				}
			}
		}		
		// $res_data    = $this->Allcrud->approve_transaksi(1,$id,$id_atasan);
		// if ($res_data > 0) {
		// 	$res_data = 1;
		// }

		$text_status = $this->Globalrules->check_status_res($res_data,"Data pekerjaan telah disetujui");
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function approve_plt($id)
	{
		# code...
		$this->Globalrules->session_rule();
		$id_atasan 	 = $this->session->userdata('sesUser');
		$data = array('trx' => $id,'atasan' => $id_atasan);

		$info         = $this->mtrx->get_transaksi_id_x($id);
		$res_data = 0;
		if ($info != 0) {
			# code...
			if ($info[0]->status_pegawai == 1) {
				# code...
				$res_data    = $this->Allcrud->approve_transaksi(2,$id,$id_atasan);
				if ($res_data > 0) {
					$res_data = 1;
				}
			}
			else
			{
				$res_data    = $this->Allcrud->approve_transaksi_cpns(2,$id,$id_atasan);
				if ($res_data > 0) {
					$res_data = 1;
				}
			}
		}
		// print_r();die();

		$text_status = "Data pekerjaan telah disetujui";
		$text_status = $this->Globalrules->check_status_res($res_data,$text_status);
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function approve_akademik($id)
	{
		# code...
		$this->Globalrules->session_rule();
		$id_atasan 	 = $this->session->userdata('sesUser');
		$res_data    = $this->Allcrud->approve_transaksi(3,$id,$id_atasan);
		if ($res_data > 0) {
			$res_data = 1;
		}
		$data = array('trx' => $id,'atasan' => $id_atasan);

		$info         = $this->mtrx->get_transaksi_id_x($id);
		$res_data = 0;
		if ($info != 0) {
			# code...
			if ($info[0]->status_pegawai == 1) {
				# code...
				$res_data    = $this->Allcrud->approve_transaksi(3,$id,$id_atasan);
				if ($res_data > 0) {
					$res_data = 1;
				}
			}
			else
			{
				$res_data    = $this->Allcrud->approve_transaksi_cpns(3,$id,$id_atasan);
				if ($res_data > 0) {
					$res_data = 1;
				}
			}
		}

		$text_status = "Data pekerjaan telah disetujui";
		$text_status = $this->Globalrules->check_status_res($res_data,$text_status);
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function get_value_approval($id_posisi,$menit_efektif)
	{
		# code...
		$this->Globalrules->session_rule();

		$hari_kerja         = $this->mtrx->get_hari_kerja(date('m'),date('Y'));
		$get_pegawai_id     = $this->mtrx->get_pegawai_id($id_posisi,'posisi');
		$get_member         = $this->Globalrules->list_bawahan($id_posisi);
		$id_urtug           = "";
		$menit_efektif_calc = "";

		if ($hari_kerja != 0)
		{
			# code...
			$tunjangan_session  = $get_pegawai_id[0]->tunjangan;
			$menit_efektif      = $menit_efektif / count($get_member);
			$menit_efektif_calc = ($menit_efektif)/($hari_kerja[0]->jml_menit_perhari*$hari_kerja[0]->jml_hari_aktif);
			$tunjangan          = $menit_efektif_calc * (50/100) * $tunjangan_session;
		}		
		else {
			$menit_efektif = 0;
			$tunjangan     = 0;
		}

		return array
					(
						'menit_efektif' => $menit_efektif,
						'tunjangan'     => $tunjangan,
						'id_urtug'		=> $id_urtug
					);
	}

	public function revisi($param)
	{
		# code...
		$this->Globalrules->session_rule();
		$res_data    = "";
		$text_status = "";
		$data_sender = $this->input->post('data_sender');
		if ($param == 'single') {
			# code...
			$data        = array
							(
								'status_pekerjaan'     => '3',
								'komentar_pemeriksa'   => $data_sender['komentar'],
								'tanggal_pemeriksa'    => date('Y-m-d H:i:s'),
								'id_pegawai_pemeriksa' => $this->session->userdata('sesUser'),
								'audit_update'         => date('Y-m-d H:i:s'),
								'audit_user_update'    => $this->session->userdata('sesUser')
							);
			$flag        = array('id_pekerjaan'=>$data_sender['id_pekerjaan']);
			$res_data    = $this->Allcrud->editData('tr_capaian_pekerjaan',$data,$flag);

			$data_notify  = array
							(
								'id_table'   => $data_sender['id_pekerjaan'],
								'table_name' => 'tr_capaian_pekerjaan'
							);
		}
		elseif ($param == 'all-aout') {
			# code...
			for ($i=0; $i < count($data_sender); $i++) {
				# code...
				$data        = array
								(
									'status_pekerjaan'     => '3',
									'komentar_pemeriksa'   => $data_sender[$i]['komentar'],
									'tanggal_pemeriksa'    => date('Y-m-d H:i:s'),
									'id_pegawai_pemeriksa' => $this->session->userdata('sesUser'),
									'audit_update'         => date('Y-m-d H:i:s'),
									'audit_user_update'    => $this->session->userdata('sesUser')
								);
				$flag        = array('id_pekerjaan'=>$data_sender[$i]['id_pekerjaan']);
				$res_data    = $this->Allcrud->editData('tr_capaian_pekerjaan',$data,$flag);

				$data_notify  = array
								(
									'id_table'   => $data_sender[$i]['id_pekerjaan'],
									'table_name' => 'tr_capaian_pekerjaan'
								);
			}
		}

		$text_status = $this->Globalrules->check_status_res($res_data,'Status pekerjaan telah diubah');
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function ubah_pekerjaan($id)
	{
		# code...
		$this->Globalrules->session_rule();
		$get_data_transact = $this->mtrx->get_transaksi_id($id);

		if ($get_data_transact != 0) {
			# code...
			if ($get_data_transact[0]->status_pekerjaan != 1) {
				# code...
				$this->Globalrules->notif_message();
				$data['title']       = 'Transaksi';
				$data['content']     = 'transaksi/trx/data_edit_pekerjaan';
				$data['infoPegawai'] = $this->Globalrules->get_info_pegawai($this->session->userdata('sesUser'),'id',$this->session->userdata('sesPosisi'));
				$data['urtug']       = $this->mskp->get_data_skp_pegawai($this->session->userdata('sesUser'),$this->session->userdata('sesPosisi'),date('Y'),'approve',1);
				$data['pekerjaan']   = $get_data_transact;
				$this->load->view('templateAdmin',$data);
			}
			else
			{
				redirect("transaksi/home");
			}
		}
		else
		{
			redirect("transaksi/home");
		}
	}

	public function timeline_transact($data_sender)
	{
		# code...
		$this->Globalrules->session_rule();
		$tunjangan_session  = $this->session->userdata('tunjangan');
		$tunjangan          = "";
		$menit_efektif_calc = "";
		$hari_kerja         = $this->mtrx->get_hari_kerja(date('m'),date('Y'));
		if ($hari_kerja != 0)
		{
			# code...
			$parameter_menit_hari = 1440 * $data_sender['hari_efektif'];
			if ($data_sender['menit_efektif'] >= $parameter_menit_hari) {
				# code...
				$menit_efektif_sisa        		= "";
				$data_sender['sisa_menit']   	= $data_sender['menit_efektif'] - $parameter_menit_hari;
				$data_sender['menit_efektif']	= ($hari_kerja[0]->jml_menit_perhari * $data_sender['hari_efektif']) + $data_sender['sisa_menit'];
			}
			$menit_efektif_calc = ($data_sender['menit_efektif'])/($hari_kerja[0]->jml_menit_perhari*$hari_kerja[0]->jml_hari_aktif);
		}

		$data_sender['tunjangan'] = $menit_efektif_calc * (50/100) * $tunjangan_session;
		$_res_data = array(
						'hari_efektif'  => $data_sender['hari_efektif'],
						'menit_efektif' => $data_sender['menit_efektif'],
						'tunjangan'     => $data_sender['tunjangan']
					);
		return $_res_data;
	}
	
	Public function filter_kinerja_sendiri()
	{
		//print_r("tes");
		$id = $this->session->userdata('sesUser');
		$data_sender = $this->input->post('data_sender');	
		$data_sender = array
		(
			'bulan'    => $data_sender['data_5'],
			'tahun'    => $data_sender['data_6']
		);
		$data['sender'] 	= $data_sender;
		$data['list'] 		= $this->Mmaster->list_kinerja_sendiri($id,$data_sender);
		//print_r($data['list']);die();
		if ($data['list'] != 0) 
		
		{
			for ($i=0; $i < count($data['list']); $i++)
			{
				
				$data_rekap = $this->Mmaster->list_kinerja_sendiri($id,$data_sender);
				// print_r($data_rekap);die();
				if ($data_rekap != 0) 
				{
					# code..
					$data['list'][$i]->nomor   						= $i+1;
					$data['list'][$i]->tanggal_mulai       			= $data_rekap[$i]->tanggal_mulai;
					$data['list'][$i]->jam_mulai     				= $data_rekap[$i]->jam_mulai;
					$data['list'][$i]->tanggal_selesai    	    	= $data_rekap[$i]->tanggal_selesai;
					$data['list'][$i]->jam_selesai  				= $data_rekap[$i]->jam_selesai;
					$data['list'][$i]->nama_pekerjaan  				= $data_rekap[$i]->nama_pekerjaan;
					$data['list'][$i]->status_pekerjaan  			= $data_rekap[$i]->status_pekerjaan;
					$data['list'][$i]->menit_efektif  				= $data_rekap[$i]->menit_efektif;
				}
				else
				{
					$data['list'][$i]->tr_belum_diperiksa   		= 0;
					$data['list'][$i]->tr_revisi       				= 0;
					$data['list'][$i]->tr_tolak     				= 0;
					$data['list'][$i]->tr_approve    	    		= 0;
					$data['list'][$i]->menit_efektif  				= 0;
					$data['list'][$i]->prosentase_menit_efektif  	= 0;
				}
			}
			$this->load->view('transaksi/history/ajax_kinerja_anggota',$data);
		}
		
	}
	
	public function history()
	{
		# code...
		$data['title']      = 'History Transaksi';
		$data['content']    = 'transaksi/history/data_history';
		$this->load->view('templateAdmin',$data);
		// print_r($data['list']);die();
	}
	
	public function edit_pekerjaan()
	{
		# code...
		$this->Globalrules->session_rule();
		$data_sender    = $this->input->post('data_sender');
		// $count_transact = $this->timeline_transact($data_sender);
		$data           = array
						(
							'id_pegawai'          => $this->session->userdata('sesUser'),
							'id_uraian_tugas'     => $data_sender['urtug'],
							'tanggal_mulai'       => date('Y-m-d', strtotime($data_sender['tgl_mulai_raw'])),
							'tanggal_selesai'     => date('Y-m-d', strtotime($data_sender['tgl_selesai_raw'])),
							'jam_mulai'           => $data_sender['jam_mulai'],
							'jam_selesai'         => $data_sender['jam_selesai'],
							'nama_pekerjaan'      => $data_sender['ket_pekerjaan'],
							'frekuensi_realisasi' => $data_sender['kuantitas'],
							// 'menit_efektif'       => $count_transact['menit_efektif'],
							// 'hari_efektif'        => $count_transact['hari_efektif'],
							// 'tunjangan'           => $count_transact['tunjangan'],
							'flag_sync'			  => '0',
							'status_pekerjaan'    => '0',
							'audit_insert'        => date('Y-m-d H:i:s'),
							'audit_user_insert'   => $this->session->userdata('sesUser')
						);
		$flag        = array('id_pekerjaan'=>$data_sender['oid']);
		$res_data    = $this->Allcrud->editData('tr_capaian_pekerjaan',$data,$flag);

		// $this->notify_capaian_kerja(' telah mengajukan laporan pekerjaan','transaksi/home/',$data_sender['oid'],'approval');
		$text_status = $this->Globalrules->check_status_res($res_data,'Pekerjaan telah diubah');
		$res         = array
					(
						'status' => $res_data,
						'text'    => $text_status
					);
		echo json_encode($res);
	}

	public function tolak($param)
	{
		# code...
		$this->Globalrules->session_rule();
		$res_data    = "";
		$text_status = "";
		$data_sender = $this->input->post('data_sender');
		if ($param == 'single')
		{
			$data        = array
							(
								'status_pekerjaan'     => '2',
								'alasan_ditolak'       => $data_sender['komentar'],
								'tanggal_pemeriksa'    => date('Y-m-d H:i:s'),
								'id_pegawai_pemeriksa' => $this->session->userdata('sesUser'),
								'audit_update'         => date('Y-m-d H:i:s'),
								'audit_user_update'    => $this->session->userdata('sesUser')
							);
			$flag        = array('id_pekerjaan'=>$data_sender['id_pekerjaan']);
			$res_data    = $this->Allcrud->editData('tr_capaian_pekerjaan',$data,$flag);

			$data_notify  = array
							(
								'id_table'   => $data_sender['id_pekerjaan'],
								'table_name' => 'tr_capaian_pekerjaan'
							);
		}
		elseif ($param == 'all-aout') {
			# code...
			for ($i=0; $i < count($data_sender); $i++) {
				# code...
				$data        = array
								(
									'status_pekerjaan'     => '2',
									'alasan_ditolak'       => $data_sender[$i]['komentar'],
									'tanggal_pemeriksa'    => date('Y-m-d H:i:s'),
									'id_pegawai_pemeriksa' => $this->session->userdata('sesUser'),
									'audit_update'         => date('Y-m-d H:i:s'),
									'audit_user_update'    => $this->session->userdata('sesUser')
								);
				$flag        = array('id_pekerjaan'=>$data_sender[$i]['id_pekerjaan']);
				$res_data    = $this->Allcrud->editData('tr_capaian_pekerjaan',$data,$flag);

				$data_notify  = array
								(
									'id_table'   => $data_sender[$i]['id_pekerjaan'],
									'table_name' => 'tr_capaian_pekerjaan'
								);
			}
		}

		$text_status = $this->Globalrules->check_status_res($res_data,'Status pekerjaan telah diubah');
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function keberatan()
	{
		# code...
		$this->Globalrules->session_rule();
		$data_sender = $this->input->post('data_sender');
		$data        = array
						(
							'status_pekerjaan'     => '4',
							'komentar_keberatan'   => $data_sender['komentar'],
							'tanggal_keberatan'    => date('Y-m-d H:i:s'),
							'audit_update'         => date('Y-m-d H:i:s'),
							'audit_user_update'    => $this->session->userdata('sesUser')
						);
		$flag        = array('id_pekerjaan'=>$data_sender['id_pekerjaan']);
		$res_data    = $this->Allcrud->editData('tr_capaian_pekerjaan',$data,$flag);

		$text_status = $this->Globalrules->check_status_res($res_data,'Status pekerjaan telah diubah');
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function tolak_keberatan()
	{
		# code...
		$this->Globalrules->session_rule();
		$data_sender = $this->input->post('data_sender');
		$data        = array
						(
							'status_pekerjaan'           => '5',
							'komentar_tolak_keberatan'   => $data_sender['komentar'],
							'tanggal_tolak_keberatan'    => date('Y-m-d H:i:s'),
							'id_pegawai_tolak_keberatan' => $this->session->userdata('sesUser'),
							'audit_update'               => date('Y-m-d H:i:s'),
							'audit_user_update'          => $this->session->userdata('sesUser')
						);
		$flag        = array('id_pekerjaan'=>$data_sender['id_pekerjaan']);
		$res_data    = $this->Allcrud->editData('tr_capaian_pekerjaan',$data,$flag);
		$text_status = $this->Globalrules->check_status_res($res_data,'Status pekerjaan telah diubah');
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function banding()
	{
		# code...
		$this->Globalrules->session_rule();
		$data_sender = $this->input->post('data_sender');
		$get_pegawai = $this->mtrx->get_pegawai_id($this->session->userdata('sesUser'),'default');
		$text_status = "";
		$res_data    = "";
		if ($get_pegawai != 0) {
			# code...
			$get_pegawai_es2 = $this->mtrx->get_pegawai_es2($get_pegawai[0]->es1,$get_pegawai[0]->es2);
			if ($get_pegawai_es2 != 0) 
			{
				# code...
				$data        = array
								(
									'status_pekerjaan'           => '6',
									'komentar_banding'           => $data_sender['komentar'],
									'tanggal_banding'            => date('Y-m-d H:i:s'),
									'id_pegawai_es2_banding'     => $get_pegawai_es2[0]->id,
									'id_pegawai_tolak_keberatan' => $this->session->userdata('sesUser'),
									'audit_update'               => date('Y-m-d H:i:s'),
									'audit_user_update'          => $this->session->userdata('sesUser')
								);
				$flag        = array('id_pekerjaan'=>$data_sender['id_pekerjaan']);
				$res_data    = $this->Allcrud->editData('tr_capaian_pekerjaan',$data,$flag);
				$text_status = "Status pekerjaan telah diubah";
			}
			else
			{
				$res_data    = 0;
				$text_status = "Pegawai eselon 2 tidak ditemukan, mohon informasikan ke Pengembangan karier";
			}
		}

		$text_status = $this->Globalrules->check_status_res($res_data,'Status pekerjaan telah diubah');
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function tolak_banding()
	{
		# code...
		$this->Globalrules->session_rule();
		$data_sender = $this->input->post('data_sender');
		$data        = array
						(
							'status_pekerjaan'         => '7',
							'komentar_tolak_banding'   => $data_sender['komentar'],
							'tanggal_tolak_banding'    => date('Y-m-d H:i:s'),
							'id_pegawai_tolak_banding' => $this->session->userdata('sesUser'),
							'audit_update'             => date('Y-m-d H:i:s'),
							'audit_user_update'        => $this->session->userdata('sesUser')
						);
		$flag        = array('id_pekerjaan'=>$data_sender['id_pekerjaan']);
		$res_data    = $this->Allcrud->editData('tr_capaian_pekerjaan',$data,$flag);

		$data_notify  = array
						(
							'id_table'   => $data_sender['id_pekerjaan'],
							'table_name' => 'tr_capaian_pekerjaan'
						);

		$text_status = $this->Globalrules->check_status_res($res_data,'Status pekerjaan telah diubah');
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function get_detail_skp()
	{
		# code...
		$this->Globalrules->session_rule();
		$id  = $this->input->post('id');
		$res = $this->mskp->get_data_skp_pegawai_id($id);
		echo json_encode($res);
	}

	public function get_delele_transaksi($id)
	{
		# code...
		$this->Globalrules->session_rule();
		$flag     = array('id_pekerjaan' => $id);
		$res_data 	 	= $this->Allcrud->delData('tr_capaian_pekerjaan',$flag);

		$data_rpt	    = $this->Allcrud->getData('rpt_capaian_kinerja',array('id_pegawai'=>$this->session->userdata('sesUser'),'id_posisi'=>$this->session->userdata('sesPosisi'),'bulan'=>date('m'),'tahun'=>date('Y')))->result_array();
		$id				= array
						(
							'id' => $data_rpt[0]['id']
						);
		$data           = array
						(
							'tr_belum_diperiksa'    => $data_rpt[0]['tr_belum_diperiksa']-1,
							'audit_time'	     	=> date('Y-m-d H:i:s')
						);

		$res_data    = $this->Allcrud->editData('rpt_capaian_kinerja',$data,$id);
		$text_status = $this->Globalrules->check_status_res($res_data,'Pekerjaan telah dihapus');
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function tugas_tambahan_dan_kreativitas($param=NULL,$id=NULL)
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		if ($param == 'add-tugas-tambahan') {
			# code...
			$data['title']    = 'Tambah Tugas Tambahan';
			$data['content']  = 'transaksi/tugas_tambahan/add';
			$data['jenis']    = $this->Allcrud->listData('mr_tugas_tambahan_jenis');
		}
		elseif ($param == 'add-kreativitas') {
			# code...
			$data['title']    = 'Tambah Tugas Kreativitas';
			$data['jenis']    = $this->Allcrud->listData('mr_keterangan_kreativitas');
			$data['content']  = 'transaksi/tugas_kreativitas/add';
		}
		elseif ($param == 'edit-tugas-tambahan') {
			# code...
			$data['title']    = 'Ubah Tugas Tambahan';
			$data['subtitle'] = '';
			$data['content']  = 'transaksi/tugas_tambahan/edit';
			$data['jenis']    = $this->Allcrud->listData('mr_tugas_tambahan_jenis');
			$data['detail']   = $this->mtrx->tugas_tambahan_detail_id($id);
			$data['oid']			= $id;
		}
		elseif ($param == 'edit-kreativitas') {
			# code...
			$data['title']    = 'Ubah Tugas Kreativitas';
			$data['subtitle'] = '';
			$data['content']  = 'transaksi/tugas_kreativitas/edit';
			$data['jenis']    = $this->Allcrud->listData('mr_keterangan_kreativitas');
			$data['detail']   = $this->mtrx->tugas_tambahan_detail_id($id);
			$data['oid']			= $id;
		}
		else
		{
			$data['title']             = 'Tugas Tambahan dan Kreativitas';
			$data['content']           = 'transaksi/tugas_tambahan/home';
			$data['tr_tugas_tambahan'] = $this->mtrx->tugas_tambahan($this->session->userdata('sesUser'),NULL,'tugas-tambahan');
			$data['tr_kreativitas']    = $this->mtrx->tugas_tambahan($this->session->userdata('sesUser'),NULL,'kreativitas');
			$data['member']            = $this->Globalrules->list_bawahan($this->session->userdata('sesPosisi'));
		}
		$this->load->view('templateAdmin',$data);
	}

	public function add_data_tugas_tambahan()
	{
		# code...
		$this->Globalrules->session_rule();
		$res_data    = "";
		$text_status = "";
		$data_sender = $this->input->post('data_sender');
		$atasan      = $this->Globalrules->list_atasan($this->session->userdata('sesPosisi'));
		if ($atasan != 0) {
			# code...
			$atasan = $atasan[0]->id;
		}
		$check_tugas_tambahan = $this->mtrx->check_tugas_tambahan($this->session->userdata('sesPosisi'),date('Y'));

		if ($check_tugas_tambahan == 0) {
			# code...
			$data_head   = array
							(
								'id_pegawai'           => $this->session->userdata('sesUser'),
								'id_pegawai_atasan'    => $atasan,
								'jenis_tugas_tambahan' => $data_sender['jenis'],
								'tahun'                => date('Y')
							);

			$res_data_id = $this->Allcrud->addData_with_return_id('tr_tugas_tambahan',$data_head);

			for ($i=0; $i < $data_sender['rows']; $i++) {
				# code...
				$data_detail = array
							(
								'id_tugas_tambahan' => $res_data_id,
								'status'			=> 'D'
							);
				$res_data    = $this->Allcrud->addData('tr_tugas_tambahan_detail',$data_detail);
			}
			$text_status = 'Tugas tambahan untuk tahun ini telah ditambahkan';
		}
		else
		{
			$res_data    = 0;
			$text_status = 'Tugas tambahan untuk tahun ini sudah ada, silakah ubah jenis kategori jika diperlukan.';
		}

		$text_status = $this->Globalrules->check_status_res($res_data,$text_status);
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function upload_tugas_tambahan($param=NULL,$id=NULL)
	{
		# code...
		$this->Globalrules->session_rule();
		$id_pekerjaan            = "";
		$file_pendukung          = "";
		$res_data                = "";
		$res_data_id			 = "";
		$text_status             = "";
		$data_sender             = $this->input->post('data_sender');
        $nip                     = $this->session->userdata('sesNip');
        $config['upload_path']   = FCPATH."/public/file_tugas_tambahan/".$nip."/";		
		$config['allowed_types'] = 'pdf|csv|zip|docx|doc|xlsx|xl|xls|jpg|jpeg';
		$config['max_size']      = '3000';

		$this->load->library('upload', $config);

		if(!is_dir("public/file_tugas_tambahan/".$nip."/"))
		{
			mkdir("public/file_tugas_tambahan/".$nip."/", 0755);
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
		}

		if ($file_pendukung == '') {
			# code...
			$data = array('status' => 'A');
		}
		else
		{
			$data = array
							(
								'file_surat_keterangan' => $file_pendukung,
								'status'                => 'A',
								'approve'               => 0
							);
		}

		if ($param == 'add') {
			# code...
			$res_data_id = $this->Allcrud->addData_with_return_id('tr_tugas_tambahan_detail',$data);
		}
		elseif ($param == 'edit') {
			# code...
			$flag        = array('id'=>$id);
			$res_data    = $this->Allcrud->editData('tr_tugas_tambahan_detail',$data,$flag);
			$res_data_id = $id;
		}

		if ($text_status == '<p>You did not select a file to upload.</p>') {
			# code...
			$res_data = 1;
			$text_status = "";
		}

		$res = array
					(
						'id'     => $res_data_id,
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function add_data_tugas_tambahan_detail($id)
	{
		# code...
		$this->Globalrules->session_rule();
		$data_sender = $this->input->post('data_sender');
		$atasan      = $this->Globalrules->list_atasan($this->session->userdata('sesPosisi'));
		if ($atasan != 0) {
			# code...
			$atasan = $atasan[0]->id;
		}
		$data = array
					(
						'id_pegawai'          => $this->session->userdata('sesUser'),
						'id_pegawai_atasan'   => $atasan,
						'no_surat_keterangan' => $data_sender['nomor_surat'],
						'keterangan'          => $data_sender['keterangan_surat'],
						'tahun'               => date('Y'),
						'approve'             => 0
					);

		if ($data_sender['flag'] == 'kreativitas') {
			# code...
			$data['flag']                      = 'kreativitas';
			$data['id_keterangan_kreativitas'] = $data_sender['pejabat_penanda_tangan'];
		}

		$flag        = array('id'=>$id);
		$res_data    = $this->Allcrud->editData('tr_tugas_tambahan_detail',$data,$flag);
		$text_status = $this->Globalrules->check_status_res($res_data,'Tugas tambahan dan Kreativitas Telah diajukan');
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function approval_tugas_tambahan_dan_kreativitas($iduser=NULL,$id=NULL)
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		if ($iduser != NULL) {
			# code...
			$data['infoPegawai']       = $this->Globalrules->get_info_pegawai($iduser,'id');
			$data['tr_tugas_tambahan'] = $this->mtrx->tugas_tambahan($iduser,3,'tugas-tambahan');
			$data['tr_kreativitas']    = $this->mtrx->tugas_tambahan($iduser,3,'kreativitas');
			$data['iduser_open']       = 'open';
		}
		else
		{
			$data['tr_tugas_tambahan'] = 0;
			$data['tr_kreativitas']    = 0;
			$data['iduser_open']       = 'close';
		}

		$data['title']   = '<b>Tugas Tambahan dan Kreativitas </b> <i class="fa fa-angle-double-right"></i> Approval Tugas Tambahan dan Kreativitas  Anggota Tim <i class="fa fa-angle-double-right"></i> Approval Target SKP';
		$data['member']  = $this->Globalrules->list_bawahan($this->session->userdata('sesPosisi'));
		if ($data['member'] != 0) {
			// code...
			for ($i=0; $i < count($data['member']); $i++) {
				// code...
				$get_data = $this->Allcrud->getData('tr_tugas_tambahan_detail',array('approve'=>0,'id_pegawai'=>$data['member'][$i]->id))->num_rows();
				if ($get_data) {
					// code...
					$data['member'][$i]->counter_belum_diperiksa = $get_data;
				}
				else {
					// code...
					$data['member'][$i]->counter_belum_diperiksa = 0;
				}
			}
		}
		$data['content'] = 'transaksi/tugas_tambahan/approve';
		$this->load->view('templateAdmin',$data);
	}

	public function approval_tugas_tambahan($iduser=NULL,$id=NULL,$PARAM=NULL)
	{
		# code...
		$this->Globalrules->session_rule();
		$data_sender = $this->input->post('data_sender');
		if ($iduser!=NULL) {
			# code...
			if ($id!=NULL) {
				# code...
				if ($PARAM == 1 || $PARAM == 2)
				{
					# code...
					$data = array
								(
									'approve'  => $PARAM,
									'komentar' => $data_sender['komentar']
								);

					$flag     = array('id'=>$id);
					$res_data = $this->Allcrud->editData('tr_tugas_tambahan_detail',$data,$flag);


					if ($PARAM == 1) {
						// code...
					}
					else {
						// code...
					}

					$text_status = $this->Globalrules->check_status_res($res_data,'Tugas Tambahan telah diperiksa');
					$res = array
								(
									'status' => $res_data,
									'text'   => $text_status
								);
					echo json_encode($res);
				}
				else
				{
					redirect('transaksi/approval_tugas_tambahan_dan_kreativitas');
				}
			}
			else
			{
				redirect('transaksi/approval_tugas_tambahan_dan_kreativitas');
			}
		}
		else
		{
			redirect('transaksi/approval_tugas_tambahan_dan_kreativitas');
		}
	}

	public function detail_transaksi_pegawai($id_pegawai,$id_posisi) 
	{
		// code...
		$res_data               	  = 1;
		$text_status            	  = "";
		$data['infoPegawai']          = $this->Globalrules->get_info_pegawai($id_pegawai,'id',$id_posisi);
		$data['tr_belum_diperiksa']   = $this->mtrx->status_pekerjaan('0',$id_pegawai);
		$data['tr_disetujui']         = $this->mtrx->status_pekerjaan('1',$id_pegawai);
		$data['tr_tolak']             = $this->mtrx->status_pekerjaan('2',$id_pegawai);
		$data['tr_revisi']            = $this->mtrx->status_pekerjaan('3',$id_pegawai);
		$data['tr_keberatan']         = $this->mtrx->status_pekerjaan('4',$id_pegawai);
		$data['tr_keberatan_ditolak'] = $this->mtrx->status_pekerjaan('5',$id_pegawai);
		$data['tr_banding']           = $this->mtrx->status_pekerjaan('6',$id_pegawai);
		$data['banding']              = $this->mtrx->get_kinerja_banding($this->session->userdata('sesUser'),$id_pegawai);
		$data['tr_banding_ditolak']   = $this->mtrx->status_pekerjaan('7',$id_pegawai);
		$res = array
					(
						'status' => $res_data,
						'data'	 => $data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function get_delete_tugas_tambahan($id)
	{
		// code...
		$this->Globalrules->session_rule();
		$flag        = array('id' => $id);
		$res_data    = $this->Allcrud->delData('tr_tugas_tambahan_detail',$flag);
		$text_status = $this->Globalrules->check_status_res($res_data,'Tugas Tambahan dan Kreativitas dihapus');
		$res         = array
							(
								'status' => $res_data,
								'text'   => $text_status
							);
		echo json_encode($res);
	}

	public function form_persetujuan_sikerja_plt_akademik($arg)
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();		
		$get_data_pegawai = $this->Allcrud->getData('mr_pegawai',array('id'=>$this->session->userdata('sesUser')))->result_array();
		if ($get_data_pegawai != array()) 
		{
			# code...
			$id_posisi    = 0;
			$text_title   = '';
			$text_content = '';
			if ($arg == 'akademik') {
				# code...
				$text_title   = '[Akademik]';
				$text_content = 'akademik';
				$id_posisi    = $get_data_pegawai[0]['posisi_akademik'];
			} elseif($arg == 'plt') {
				# code...
				$text_title   = '[PLT]';				
				$text_content = 'plt';
				$id_posisi    = $get_data_pegawai[0]['posisi_plt'];				
			}
			

			if ($id_posisi == 0) {
				# code...
				redirect('dashboard/home');
			}
			else
			{
				$data['title']                = $text_title.' Persetujuan Sikerja Bawahan';
				$data['content']              = 'transaksi/'.$text_content.'/index';				
				$data['hari_kerja']           = $this->mtrx->get_hari_kerja(date('m'),date('Y'));				
				$data['member'] = $this->Globalrules->list_bawahan($id_posisi);								
				if ($data['member'] != 0) {
					// code...
					for ($i=0; $i < count($data['member']); $i++) {
						// code...
						$get_data           = $this->Allcrud->getData('tr_capaian_pekerjaan',array('status_pekerjaan'=>0,'id_pegawai'=>$data['member'][$i]->id,'tanggal_mulai LIKE'=>date('Y-m').'%'))->num_rows();
						$get_data_keberatan = $this->Allcrud->getData('tr_capaian_pekerjaan',array('status_pekerjaan'=>4,'id_pegawai'=>$data['member'][$i]->id,'tanggal_mulai LIKE'=>date('Y-m').'%'))->num_rows();
						if ($get_data) {
							// code...
							$data['member'][$i]->counter_belum_diperiksa = $get_data;
						}
						else {
							// code...
							$data['member'][$i]->counter_belum_diperiksa = 0;
						}
		
						if ($get_data_keberatan) {
							// code...
							$data['member'][$i]->counter_keberatan = $get_data_keberatan;
						}
						else {
							// code...
							$data['member'][$i]->counter_keberatan = 0;
						}				
					}
				}		
				$this->load->view('templateAdmin',$data);				
			}
		}			
	}

	public function plt()
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();		
		$this->form_persetujuan_sikerja_plt_akademik('plt');
	}

	public function akademik()
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();		
		$this->form_persetujuan_sikerja_plt_akademik('akademik');		
	}	
}