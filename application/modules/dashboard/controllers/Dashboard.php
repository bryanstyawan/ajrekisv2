<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('mdashboard', '', TRUE);
		$this->load->model ('transaksi/mtrx', '', TRUE);		
		$this->load->model ('laporan/mlaporan', '', TRUE);
		$this->load->model ('skp/mskp', '', TRUE);
		date_default_timezone_set('Asia/Jakarta');
	}

	public function home()
	{
		error_reporting(E_ALL ^ E_WARNING);
		$this->Globalrules->session_rule();

		if ($this->session->userdata('sesPosisi') != '') {
			# code...
			$get_evaluator = $this->mskp->get_data_evaluator($this->session->userdata('sesUser'),date('Y')-1);
			if ($get_evaluator != 0) {
				# code...
				for ($i=0; $i < count($get_evaluator); $i++) { 
					# code...
					if ($get_evaluator[$i]->id_posisi_pegawai_penilai == NULL) {
						# code...
						$get_posisi = $this->mskp->get_request_history($get_evaluator[$i]->id_pegawai_penilai,date('Y')-1,'on');					
						if ($get_posisi != 0) {
							# code...
							if ($get_evaluator[$i]->id_posisi_pegawai_penilai == NULL || $get_evaluator[$i]->id_posisi_pegawai_penilai == '') {
								# code...
								$data = array
								(
									'id_posisi_pegawai_penilai' => $get_posisi[0]->posisi
								);
								$res_data    = $this->Allcrud->editData('mr_skp_penilaian_prilaku',$data,array('id'=>$get_evaluator[$i]->id));								
							}									
						}						
					}
				}

				$get_posisi = $this->mskp->get_request_history($this->session->userdata('sesUser'),date('Y')-1,'on');
				if ($get_posisi != 0) {
					# code...

					$check_data = $this->Allcrud->getData('mr_skp_penilaian_prilaku',array('id_pegawai'=>$this->session->userdata('sesUser'),'tahun'=>date('Y')-1))->result_array();					
					if ($check_data != array()) {
						# code...
						for ($i=0; $i < count($check_data); $i++) { 
							# code...
							if ($check_data[$i]['id_posisi_pegawai'] == null || $check_data[$i]['id_posisi_pegawai'] == '') {
								# code...
								$data = array
								(
									'id_posisi_pegawai' => $get_posisi[0]->posisi
								);
								$res_data    = $this->Allcrud->editData('mr_skp_penilaian_prilaku',$data,array('id_pegawai'=>$this->session->userdata('sesUser'),'tahun'=>date('Y')-1));								
							}
						}
					}					

					$data_s = array();
					for ($i=0; $i < count($get_posisi); $i++) { 
						# code...					
						$data_s[$i] = $this->Globalrules->data_summary_skp_pegawai($this->session->userdata('sesUser'),$get_posisi[$i]->posisi,date('Y')-1);						
						$data_parameter = array(
							'id_pegawai'					=> $this->session->userdata('sesUser'),
							'id_posisi'						=> $get_posisi[$i]->posisi,
							'tahun'							=> date('Y')-1
						);
						$check_data = $this->Allcrud->getData('rpt_skp_sasaran_kerja',$data_parameter)->result_array();						
						if ($check_data == array()) {
							# code...
							$summary_skp = array(
								'id_pegawai'					=> $this->session->userdata('sesUser'),
								'id_posisi'						=> $get_posisi[$i]->posisi,
								'tahun'							=> date('Y')-1,
								'nilai_capaian_skp'             => $data_s[$i]['summary_skp']['nilai_capaian_skp'],
								'total_aspek'                   => $data_s[$i]['summary_skp']['total_aspek'],
								'total'                         => $data_s[$i]['summary_skp']['total'],
								'nilai_sasaran_kinerja_pegawai' => $data_s[$i]['summary_skp']['nilai_sasaran_kinerja_pegawai']
							);							
							$this->Allcrud->addData('rpt_skp_sasaran_kerja',$summary_skp);							
						}
						else
						{
							$summary_skp = array(
								'nilai_capaian_skp'             => $data_s[$i]['summary_skp']['nilai_capaian_skp'],
								'total_aspek'                   => $data_s[$i]['summary_skp']['total_aspek'],
								'total'                         => $data_s[$i]['summary_skp']['total'],
								'nilai_sasaran_kinerja_pegawai' => $data_s[$i]['summary_skp']['nilai_sasaran_kinerja_pegawai']
							);														
							$this->Allcrud->editData('rpt_skp_sasaran_kerja',$summary_skp,$data_parameter);										
						}

						$check_data = $this->Allcrud->getData('rpt_skp_prilaku_skp',$data_parameter)->result_array();						
						if ($check_data == array()) {
							# code...
							$summary_prilaku_skp = array(
								'id_pegawai'					=> $this->session->userdata('sesUser'),
								'id_posisi'						=> $get_posisi[$i]->posisi,
								'tahun'							=> date('Y')-1,
								'integritas'             		=> $data_s[$i]['summary_prilaku_skp']['integritas'],
								'orientasi_pelayanan'    		=> $data_s[$i]['summary_prilaku_skp']['orientasi_pelayanan'],
								'komitmen'               		=> $data_s[$i]['summary_prilaku_skp']['komitmen'],
								'disiplin'               		=> $data_s[$i]['summary_prilaku_skp']['disiplin'],
								'kerjasama'              		=> $data_s[$i]['summary_prilaku_skp']['kerjasama'],
								'kepemimpinan'           		=> $data_s[$i]['summary_prilaku_skp']['kepemimpinan'],
								'status'                 		=> $data_s[$i]['summary_prilaku_skp']['status'],
								'jumlah'                 		=> $data_s[$i]['summary_prilaku_skp']['jumlah'],
								'rata_rata'              		=> $data_s[$i]['summary_prilaku_skp']['rata_rata'],
								'nilai_prilaku_kerja'    		=> $data_s[$i]['summary_prilaku_skp']['nilai_prilaku_kerja']
							);							
							$this->Allcrud->addData('rpt_skp_prilaku_skp',$summary_prilaku_skp);							
						}
						else
						{
							$summary_prilaku_skp = array(
								'integritas'             		=> $data_s[$i]['summary_prilaku_skp']['integritas'],
								'orientasi_pelayanan'    		=> $data_s[$i]['summary_prilaku_skp']['orientasi_pelayanan'],
								'komitmen'               		=> $data_s[$i]['summary_prilaku_skp']['komitmen'],
								'disiplin'               		=> $data_s[$i]['summary_prilaku_skp']['disiplin'],
								'kerjasama'              		=> $data_s[$i]['summary_prilaku_skp']['kerjasama'],
								'kepemimpinan'           		=> $data_s[$i]['summary_prilaku_skp']['kepemimpinan'],
								'status'                 		=> $data_s[$i]['summary_prilaku_skp']['status'],
								'jumlah'                 		=> $data_s[$i]['summary_prilaku_skp']['jumlah'],
								'rata_rata'              		=> $data_s[$i]['summary_prilaku_skp']['rata_rata'],
								'nilai_prilaku_kerja'    		=> $data_s[$i]['summary_prilaku_skp']['nilai_prilaku_kerja']
							);														
							$this->Allcrud->editData('rpt_skp_prilaku_skp',$summary_prilaku_skp,$data_parameter);										
						}												
					}			
				}

			}
			$data['title']                   = '';
			$data['content']                 = 'vdashboard';
			$data['id_posisi']               = $this->session->userdata('sesPosisi');
			$data['belum_diperiksa']         = $this->stat_pekerjaan(0);	
			$data['infoPegawai']              = $this->Globalrules->get_info_pegawai();
			// $skp                      		= $this->Globalrules->data_summary_skp_pegawai($this->session->userdata('sesUser'),$this->session->userdata('sesPosisi'),date('Y')-1);	
			$data['skp']					  = $this->mskp->get_persentase_target_realisasi(date('Y'));
			$data['menit_efektif_year']       = $this->mlaporan->get_menit_efektif_year($this->session->userdata('sesUser'));
			$data['member']                   = $this->Globalrules->list_bawahan($this->session->userdata('sesPosisi'),NULL,'penilaian_skp');
			$data['summary_tr']               = $this->Mmaster->data_pegawai('kinerja','eselon2 ASC,
																	eselon3 ASC,
																	eselon4 ASC,
																	kat_posisi ASC,
																	atasan ASC',array
																	(
																		'eselon1'    => '',
																		'eselon2'    => '',
																		'eselon3'    => '',
																		'eselon4'    => '',
																		'bulan'      => date('m'),
																		'tahun'		 => date('Y'),
																		'pegawai'	 => $this->session->userdata('sesUser'),
																		'posisi'	 => $this->session->userdata('sesPosisi')																		
																	));					
		}
		else
		{
			$data['title']      = '';
			$data['baru']       = $this->Allcrud->getData('tr_request_bug_fixing_fitur',array('status'=>0))->num_rows();
			$data['proses']     = $this->Allcrud->getData('tr_request_bug_fixing_fitur',array('status'=>1))->num_rows();
			$data['verifikasi'] = $this->Allcrud->getData('tr_request_bug_fixing_fitur',array('status'=>2))->num_rows();									
			$data['selesai']    = $this->Allcrud->getData('tr_request_bug_fixing_fitur',array('status'=>3))->num_rows();			
			$data['content']    = 'vdashboard_monitoring';	
		}		

		$this->load->view('templateAdmin',$data);
	}

	public function stat_pekerjaan($arg)
	{
		# code...
		return $this->Allcrud->getData('tr_capaian_pekerjaan',array('status_pekerjaan'=>$arg,'id_pegawai'=>$this->session->userdata('sesUser'),'tanggal_mulai LIKE'=>date('Y-m').'%'))->num_rows();		
	}

	public function delete_common_notify($param=NULL)
	{
		# code...
		$data_notify = $this->mdashboard->get_data_notify_user($param,$this->session->userdata('sesUser'));
		if (count($data_notify) != 0) {
			# code...
			for ($i=0; $i < count($data_notify); $i++) {
				# code...
				$data_change = array(
					'status_read' => 1
				);
				$flag        = array('id'=>$data_notify[$i]->id);
				$res_data    = $this->Allcrud->editData('log_notifikasi',$data_change,$flag);
			}
		}
	}

	public function load_data_dashboard($stat=NULL)
	{
		# code...
		$id_pegawai   = $this->session->userdata('sesUser');
		$data['list'] = $this->Allcrud->getData('tr_capaian_pekerjaan',array('stat'=>$stat,'id_pegawai'=>$this->session->userdata('sesUser'),'tgl_selesai LIKE'=>date('Y-m').'%'))->result_array();
		$this->load->view('dashboard/ajax_stat_kinerja',$data);
	}

	public function update_profile()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$data        = array
						(
							'email'        => $data_sender['email'],
							'no_hp'        => $data_sender['no_hp'],
							'alamat'       => $data_sender['alamat'],
							'id_agama'     => $data_sender['agama'],
							'golongan'     => $data_sender['golongan'],
							'tmt_golongan' => $data_sender['tmt_golongan']
						);
		$flag 		 = array
						(
							'id' => $this->session->userdata('sesUser')
						);
		$res_data       = $this->Allcrud->editData('mr_pegawai',$data,$flag);
		$check_golongan = $this->Allcrud->getData('mr_history_golongan',array('id_golongan'=>$data_sender['golongan'],'id_pegawai'=>$this->session->userdata('sesUser')))->result_array();
		if ($check_golongan == array()) {
			# code...
			$data        = array
							(
								'id_pegawai'  => $this->session->userdata('sesUser'),
								'id_golongan' => $data_sender['golongan'],
								'tmt'         => $data_sender['tmt_golongan']
							);
			$this->Allcrud->addData('mr_history_golongan',$data);			
		}
		$text_status    = $this->Globalrules->check_status_res($res_data,'Profil pegawai telah diubah');
		$res            = array
						(
							'status' => $res_data,
							'text'   => $text_status
						);
		echo json_encode($res);		
	}

	public function update_kompetensi()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$data        = array
						(
							'id_pegawai' => $this->session->userdata('sesUser'),
							'kompetensi' => $data_sender['kompetensi'],
							'keterangan' => $data_sender['keterangan']
						);
		$res_data       = $this->Allcrud->addData('mr_kompetensi',$data);
		$text_status    = $this->Globalrules->check_status_res($res_data,'Kompetensi telah ditambahkan.');
		$res            = array
						(
							'status' => $res_data,
							'text'   => $text_status
						);
		echo json_encode($res);				
	}

	public function get_delete_kompetensi($id)
	{
		# code...
		$flag     = array('id' => $id);
		$res_data = $this->Allcrud->delData('mr_kompetensi',$flag);
		$text_status    = $this->Globalrules->check_status_res($res_data,'Kompetensi telah dihapus.');
		$res            = array
						(
							'status' => $res_data,
							'text'   => $text_status
						);
		echo json_encode($res);						
	}	

	public function view_notification()
	{
		# code...
		$this->Globalrules->session_rule();
		//$this->Globalrules->notif_message();
		$data['title']   = 'Lihat Semua Pemberitahuan';
		$data['list']    = $this->Allcrud->getData('log_notifikasi',array('receiver'=>$this->session->userdata('sesUser')));
		$data['content'] = 'dashboard/notification/view_all';
		$this->load->view('templateAdmin',$data);
	}

	public function get_datamodal_transaksi($oid)
	{
		# code...
		$data['list']  = $this->mtrx->status_pekerjaan($oid,$this->session->userdata('sesUser'));
		$data['title'] = '';
		$data['oid']   = $oid;
		$this->load->view('dashboard/datatable_modal',$data);		
	}

	public function get_datamodal_fingerprint($oid)
	{
		# code...
		$data['list']  = $this->mtrx->status_pekerjaan($oid,$this->session->userdata('sesUser'));
		$data['title'] = '';
		$data['oid']   = $oid;
		$this->load->view('dashboard/datatable_modal_finger',$data);		
	}

	public function get_datamodal_tunjangan($oid)
	{
		# code...
		$data['list']  = $this->mtrx->status_pekerjaan($oid,$this->session->userdata('sesUser'));
		$data['title'] = '';
		$data['oid']   = $oid;
		$this->load->view('dashboard/datatable_modal_tunjangan',$data);		
	}


	public function post_penilaian_skp_bulan($arg,$oid,$oid_posisi)
	{
		# code...
		$text_status = "";		
		$res_data = 0;
		$getdata  = $this->Allcrud->getData('rpt_capaian_kinerja',array('id_pegawai'=>$oid,'id_posisi'=>$oid_posisi,'tahun'=>date('Y'),'bulan'=>date('m')))->result_array();
		$persentase = '0';
		if ($arg == 'no') {
			# code...
			$persentase = '5';
		}
		else {
			# code...
			$persentase = '0';			
		}
		$data = array
					(
						'id_pegawai'            => $oid,
						'id_posisi'             => $oid_posisi,
						'tahun'                 => date('Y'),
						'bulan'                 => date('m'),
						'audit_check_skp'       => 1,
						'persentase_pemotongan' => $persentase
					);
		if ($getdata == array()) {
			# code...
			// $res_data = $this->Allcrud->addData('rpt_capaian_kinerja',$data);
			$text_status    = "Pegawai yang bersangkutan belum memiliki kinerja sehingga tidak bisa dilakukan penilaian, silahkan periksa kinerja pegawai yang bersangkutan.";
			$res_data 		= 0;			
		}							
		else {
			# code...
			$data = array
			(
				'audit_check_skp'       => 1,
				'persentase_pemotongan' => $persentase
			);

			$flag = array
			(
				'id_pegawai' => $oid,
				'id_posisi'  => $oid_posisi,
				'tahun'      => date('Y'),
				'bulan'      => date('m')
			);
			$res_data    = $this->Allcrud->editData('rpt_capaian_kinerja',$data,$flag);			
			$text_status    = $this->Globalrules->check_status_res($res_data,'Penilaian SKP Bulanan untuk pegawai ini telah dilakukan');			
		}

		// $text_status    = $this->Globalrules->check_status_res($res_data,'Penilaian SKP Bulanan untuk pegawai ini telah dilakukan');
		$res            = array
						(
							'status' => $res_data,
							'text'   => $text_status
						);
		echo json_encode($res);		
	}

	public function soon()
	{
		# code...
		$this->Globalrules->session_rule();
		$data['title']   = '';
		$data['content'] = 'dashboard/soon/index';
		$this->load->view('templateAdmin',$data);		
	}	
}