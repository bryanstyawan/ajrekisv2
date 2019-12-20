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

	public function index()
	{
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		redirect('dashboard/home');
	}

	public function skp_pegawai()
	{
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$this->syncronice_skp($this->session->userdata('sesUser'),$this->session->userdata('sesPosisi'),date('Y'));
		$data['title']       = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Setup SKP';
		$data['subtitle']    = '';
		$data['list']        = $this->mskp->get_data_skp_pegawai($this->session->userdata('sesUser'),$this->session->userdata('sesPosisi'),date('Y'),'10');
		$data['info_posisi'] = $this->Allcrud->getData('mr_posisi',array('id' => $this->session->userdata('sesPosisi')))->result_array();
		$data['content']     = 'skp/skp_pegawai';
		$data['who_is']      = $this->Globalrules->who_is($this->session->userdata('sesUser'));
		$data['satuan']      = $this->Allcrud->listData('mr_skp_satuan');
		$data['jenis']       = $this->Allcrud->listData('mr_skp_jenis');
		$this->load->view('templateAdmin',$data);
	}

	public function add_skp_pegawai()
	{
		# code...
		$this->Allcrud->session_rule();
		$data_sender = $this->input->post('data_sender');
		$res_data    = "";
		$param_pk    = "";
		$text_status = "";

		$param_pk    = $this->parameter_pk($data_sender['pk']);

		$check_data_pekerjaan = $this->mskp->check_pekerjaan_pegawai($this->session->userdata('sesUser'),$data_sender['kegiatan'],date('Y'));
		if ($check_data_pekerjaan) {
			# code...
			$res = 0;
			$text_status = "Tidak bisa mengajukan kegiatan tugas jabatan yang telah diajukan.";
		}
		else
		{
			$data = array(
				'id_pegawai'          => $this->session->userdata('sesUser'),
				'id_posisi'           => $this->session->userdata('sesPosisi'),
				'tahun'               => date('Y'),
				'kegiatan'            => $data_sender['kegiatan'],
				'PK'                  => $data_sender['pk'],
				'jenis_skp'           => $data_sender['jenis_skp'],
				'AK_target'           => $data_sender['ak_target'],
				'target_qty'          => $data_sender['jumlah'],
				'target_output'       => $data_sender['satuan'],
				'target_kualitasmutu' => $data_sender['kualitas_mutu'],
				'target_waktu_bln'    => $data_sender['waktu'],
				'target_biaya'        => $data_sender['biaya'],
				'status'              => '0',
				'audit_priority'      => $param_pk
			);
			$res_data_id = $this->Allcrud->addData_with_return_id('mr_skp_pegawai',$data);
				
			$get_friend = $this->mskp->get_data_pegawai_by_posisi_ex($this->session->userdata('sesUser'),$this->session->userdata('sesPosisi'));
			if ($get_friend != 0) {
				# code...
				for ($i=0; $i < count($get_friend); $i++) {
					# code...
					$check_data_pekerjaan_friend = $this->mskp->check_pekerjaan_pegawai($get_friend[$i]->id,$data_sender['kegiatan'],date('Y'));

					if ($check_data_pekerjaan_friend) {
						# code...
					}
					else
					{
						$data = array(
							'id_pegawai'          => $get_friend[$i]->id,
							'id_posisi'           => $this->session->userdata('sesPosisi'),
							'tahun'               => date('Y'),
							'kegiatan'            => $data_sender['kegiatan'],
							'status'              => '6',
							'audit_priority'      => $param_pk
						);
						$res_data_id_friend = $this->Allcrud->addData_with_return_id('mr_skp_pegawai',$data);
						$res_data = 1;
					}

				}
			}

			if ($res_data_id != 0) {
				# code...
				$res_data = 1;
			}
			else
			{
				$res_data = 0;
			}

			$text_status = $this->Globalrules->check_status_res($res_data,'SKP Telah ditambahkan');
		}

		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function ad_skp_pegawai_pk()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$param_pk    = $this->parameter_pk(1);				
		$res_data    = "";
		$text_status = "";
		
		$data = array(
			'id_pegawai'          => $this->session->userdata('sesUser'),
			'id_posisi'           => $this->session->userdata('sesPosisi'),
			'tahun'               => date('Y'),
			'kegiatan'            => $data_sender['kegiatan'],
			'PK'                  => 1,
			'AK_target'           => $data_sender['ak_target'],
			'target_qty'          => $data_sender['jumlah'],
			'target_output'       => $data_sender['satuan'],
			'target_kualitasmutu' => 100,
			'target_waktu_bln'    => $data_sender['waktu'],
			'target_biaya'        => $data_sender['biaya'],
			'audit_priority'      => $param_pk
		);

		$who_is = $this->Globalrules->who_is($this->session->userdata('sesUser'));		
		if ($who_is == 'eselon 2' || $who_is == 'eselon 1') {
			# code...
			if ($this->session->userdata('kat_posisi') == 1) {
				# code...
				$data['status'] = 1;				
			}
			elseif ($this->session->userdata('kat_posisi') == 6) {
				# code...
				$data['status'] = 1;					
			}
			else
			{
				$data['status'] = 0;
			}
		}
		else {
			# code...
			$data['status'] = 0;
		}			

	
		$res_data_id    = $this->Allcrud->addData_with_return_id('mr_skp_pegawai',$data);

		if ($who_is == 'eselon 2' || $who_is == 'eselon 1') {
			# code...
			$res_data = 1;
		}
		else {
			# code...
			$res_data = 1;
		}
	
		$text_status = $this->Globalrules->check_status_res($res_data,'Target SKP Telah Ditambahkan.');
		$res         = array
						(
							'status' => $res_data,
							'text'   => $text_status
						);
		echo json_encode($res);
	}

	public function edit_skp_pegawai()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$res_data    = "";
		$text_status = "";

		$param_pk    = $this->parameter_pk($data_sender['pk']);

		$data = array(
			'edit_skp_id'              => $data_sender['id'],
			'edit_id_pegawai'          => $this->session->userdata('sesUser'),
			'edit_tahun'               => date('Y'),
			'edit_PK'                  => $data_sender['pk'],
			'edit_jenis_skp'           => $data_sender['jenis_skp'],
			'edit_AK_target'           => $data_sender['ak_target'],
			'edit_target_qty'          => $data_sender['jumlah'],
			'edit_target_output'       => $data_sender['satuan'],
			'edit_target_kualitasmutu' => $data_sender['kualitas_mutu'],
			'edit_target_waktu_bln'    => $data_sender['waktu'],
			'edit_target_biaya'        => $data_sender['biaya'],
			'edit_status'              => '3',
			'edit_audit_priority'      => $param_pk
		);

		if ($data_sender['before'] == 0 || $data_sender['before'] == 2 || $data_sender['before'] == 6)
		{
			# code...
			$data_change = array(
				'skp_id'              => $data_sender['id'],
				'id_pegawai'          => $this->session->userdata('sesUser'),
				'tahun'               => date('Y'),
				'PK'                  => $data_sender['pk'],
				'jenis_skp'			  => $data_sender['jenis_skp'],
				'AK_target'           => $data_sender['ak_target'],
				'target_qty'          => $data_sender['jumlah'],
				'target_output'       => $data_sender['satuan'],
				'target_kualitasmutu' => 100,
				'target_waktu_bln'    => $data_sender['waktu'],
				'target_biaya'        => $data_sender['biaya'],
				'status'			  => 0,
				'audit_update'        => date('Y-m-d H:i:s'),
				'audit_priority'      => $param_pk,
				'audit_user_update'   => $this->session->userdata('sesUser')
			);

			$who_is = $this->Globalrules->who_is($this->session->userdata('sesUser'));		
			if ($who_is == 'eselon 2' || $who_is == 'eselon 1') {
				# code...
				if ($this->session->userdata('kat_posisi') == 1) {
					# code...
					$data_change['status'] = 1;				
				}
				elseif ($this->session->userdata('kat_posisi') == 6) {
					# code...
					$data_change['status'] = 1;					
				}
				else
				{
					$data_change['status'] = 0;
				}
			}
			else {
				# code...
				$data_change['status'] = 0;
			}			

			$flag        = array('skp_id'=>$data_sender['id']);
			$res_data    = $this->Allcrud->editData('mr_skp_pegawai',$data_change,$flag);
			$text_status = "Target SKP telah diubah, menunggu persetujuan atasan.";
		}
		elseif ($data_sender['before'] == 1) {
			# code...
			$check_data = $this->mskp->get_data_skp_pegawai_edit($data_sender['id']);
			if ($check_data != false) {
				# code...
				//edit
				$flag       = array('edit_skp_id'=>$data_sender['id']);
				$res_data   = $this->Allcrud->editData('mr_skp_pegawai_temp',$data,$flag);
			}
			else
			{
				//add
				$res_data = $this->Allcrud->addData('mr_skp_pegawai_temp',$data);
			}

			$text_status = "Target SKP telah diubah, status menunggu persetujuan atasan.";
		}
		$text_status = $this->Globalrules->check_status_res($res_data,$text_status);
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function approval_target_skp()
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$data['title']    = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Approval Target SKP Anggota Tim';
		$data['subtitle'] = '';
		$data['bawahan']  = $this->Globalrules->list_bawahan($this->session->userdata('sesPosisi'));
		$data['satuan']   = $this->Allcrud->listData('mr_skp_satuan');
		$data['content']  = 'skp/skp_approval_target';
		$data['member']   = $this->mskp->get_member($this->session->userdata('sesPosisi'));
		if ($data['member'] != 0) {
			// code...
			for ($i=0; $i < count($data['member']); $i++) {
				// code...
				$get_data              = $this->Allcrud->getData('mr_skp_pegawai',array('status'=>0,'id_pegawai'=>$data['member'][$i]->id,'id_posisi'=>$data['member'][$i]->posisi))->num_rows();
				$get_data_temp         = $this->Allcrud->getData('mr_skp_pegawai_temp',array('edit_status'=>3,'edit_id_pegawai'=>$data['member'][$i]->id))->num_rows();								
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
		$this->load->view('templateAdmin',$data);
	}

	public function approval_target_skp_plt()
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
				$data['title']    = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Approval Target SKP Anggota Tim';
				$data['subtitle'] = '';
				$data['bawahan']  = $this->Globalrules->list_bawahan($get_data_pegawai[0]['posisi_plt']);
				// echo "<pre>";
				// print_r($data['bawahan']);die();				
				// echo "</pre>";
				$data['satuan']   = $this->Allcrud->listData('mr_skp_satuan');
				$data['content']  = 'skp/skp_approval_target_plt';
				$data['member']   = $this->mskp->get_member($get_data_pegawai[0]['posisi_plt']);
				if ($data['member'] != 0) {
					// code...
					for ($i=0; $i < count($data['member']); $i++) {
						// code...
						$get_data              = $this->Allcrud->getData('mr_skp_pegawai',array('status'=>0,'id_pegawai'=>$data['member'][$i]->id,'id_posisi'=>$data['member'][$i]->posisi))->num_rows();
						$get_data_temp         = $this->Allcrud->getData('mr_skp_pegawai_temp',array('edit_status'=>3,'edit_id_pegawai'=>$data['member'][$i]->id))->num_rows();								
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
				$this->load->view('templateAdmin',$data);
			}
		}
	}
	
	public function approval_target_skp_akademik()
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$get_data_pegawai = $this->Allcrud->getData('mr_pegawai',array('id'=>$this->session->userdata('sesUser')))->result_array();
		if ($get_data_pegawai != array()) 
		{
			# code...
			if ($get_data_pegawai[0]['posisi_akademik'] == 0) {
				# code...
				redirect('dashboard/home');
			}
			else
			{
				$data['title']    = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Approval Target SKP Anggota Tim';
				$data['subtitle'] = '';
				$data['bawahan']  = $this->Globalrules->list_bawahan($get_data_pegawai[0]['posisi_akademik']);
				$data['satuan']   = $this->Allcrud->listData('mr_skp_satuan');
				$data['content']  = 'skp/skp_approval_target_akademik';
				$data['member']   = $this->mskp->get_member($get_data_pegawai[0]['posisi_akademik']);
				if ($data['member'] != 0) {
					// code...
					for ($i=0; $i < count($data['member']); $i++) {
						// code...
						$get_data              = $this->Allcrud->getData('mr_skp_pegawai',array('status'=>0,'id_pegawai'=>$data['member'][$i]->id,'id_posisi'=>$data['member'][$i]->posisi))->num_rows();
						$get_data_temp         = $this->Allcrud->getData('mr_skp_pegawai_temp',array('edit_status'=>3,'edit_id_pegawai'=>$data['member'][$i]->id))->num_rows();								
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
				$this->load->view('templateAdmin',$data);
			}
		}
	}	

	public function get_target_skp_json($id,$id_posisi)
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$data['infoPegawai']   = $this->Globalrules->get_info_pegawai($id,'id',$id_posisi);
		// print_r($data['infoPegawai']);die();
		$data['list']          = $this->mskp->get_data_skp_pegawai($id,$id_posisi,date('Y'),11);
		$data['id']            = $id;
		$data['satuan']        = $this->Allcrud->listData('mr_skp_satuan');
		$data['member']   	 = $this->mskp->get_member($this->session->userdata('sesPosisi'));
		if ($data['member'] != 0) {
			// code...
			for ($i=0; $i < count($data['member']); $i++) {
				// code...
				$get_data              = $this->Allcrud->getData('mr_skp_pegawai',array('status'=>0,'id_pegawai'=>$data['member'][$i]->id,'id_posisi'=>$data['member'][$i]->posisi))->num_rows();
				$get_data_temp         = $this->Allcrud->getData('mr_skp_pegawai_temp',array('edit_status'=>3,'edit_id_pegawai'=>$data['member'][$i]->id))->num_rows();								
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

	public function skp_member_detail($id)
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$infoPegawai           = $this->Globalrules->get_info_pegawai($id,'id');
		$id_posisi             = $infoPegawai[0]->posisi;		
		$data['title']         = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Approval Target SKP Anggota Tim <i class="fa fa-angle-double-right"></i> Approval Target SKP';
		$data['subtitle']      = '';
		$data['list']          = $this->mskp->get_data_skp_pegawai($id,$id_posisi,date('Y'),11);
		$data['id']            = $id;
		$data['satuan']        = $this->Allcrud->listData('mr_skp_satuan');
		$data['content']       = 'skp/skp_approval_pegawai';		
		$data['member']   	 = $this->mskp->get_member($this->session->userdata('sesPosisi'));
		if ($data['member'] != 0) {
			// code...
			for ($i=0; $i < count($data['member']); $i++) {
				// code...
				$get_data              = $this->Allcrud->getData('mr_skp_pegawai',array('status'=>0,'id_pegawai'=>$data['member'][$i]->id,'id_posisi'=>$data['member'][$i]->posisi))->num_rows();
				$get_data_temp         = $this->Allcrud->getData('mr_skp_pegawai_temp',array('edit_status'=>3,'edit_id_pegawai'=>$data['member'][$i]->id))->num_rows();								
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
		$this->load->view('templateAdmin',$data);
	}

	public function skp_member_detail_plt($id,$POSISI=NULL)
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$get_data_pegawai = $this->Allcrud->getData('mr_pegawai',array('id'=>$this->session->userdata('sesUser')))->result_array();
		if ($get_data_pegawai != array()) 
		{
			# code...
			if ($get_data_pegawai[0]['posisi_plt'] == '' || $get_data_pegawai[0]['posisi_plt'] == NULL) {
				# code...
				redirect('dashboard/home');
			}
			else
			{

				$infoPegawai           = $this->Globalrules->get_info_pegawai($id,'id',$POSISI);
				// print_r($infoPegawai);die();
				$id_posisi             = ($infoPegawai != 0) ? $infoPegawai[0]->posisi : 0 ;		
				$data['title']         = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Approval Target SKP Anggota Tim <i class="fa fa-angle-double-right"></i> Approval Target SKP';
				$data['subtitle']      = '';
				$data['list']          = $this->mskp->get_data_skp_pegawai($id,$id_posisi,date('Y'),11);
				$data['id']            = $id;
				$data['id_posisi']     = $id_posisi;				
				$data['satuan']        = $this->Allcrud->listData('mr_skp_satuan');
				$data['content']       = 'skp/skp_approval_pegawai_plt';		
				$data['member']   	 = $this->mskp->get_member($get_data_pegawai[0]['posisi_plt']);
				if ($data['member'] != 0) {
					// code...
					for ($i=0; $i < count($data['member']); $i++) {
						// code...
						$get_data              = $this->Allcrud->getData('mr_skp_pegawai',array('status'=>0,'id_pegawai'=>$data['member'][$i]->id,'id_posisi'=>$data['member'][$i]->posisi))->num_rows();
						$get_data_temp         = $this->Allcrud->getData('mr_skp_pegawai_temp',array('edit_status'=>3,'edit_id_pegawai'=>$data['member'][$i]->id))->num_rows();								
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
				$this->load->view('templateAdmin',$data);
			}
		}
	}
	
	public function skp_member_detail_akademik($id)
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$get_data_pegawai = $this->Allcrud->getData('mr_pegawai',array('id'=>$this->session->userdata('sesUser')))->result_array();
		if ($get_data_pegawai != array()) 
		{
			# code...
			if ($get_data_pegawai[0]['posisi_akademik'] == '' || $get_data_pegawai[0]['posisi_akademik'] == NULL) {
				# code...
				redirect('dashboard/home');
			}
			else
			{
				$infoPegawai = $this->Allcrud->getData('mr_pegawai',array('id'=>$id))->result_array();
				$id_posisi             = $infoPegawai[0]['posisi'];		
				$data['title']         = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Approval Target SKP Anggota Tim <i class="fa fa-angle-double-right"></i> Approval Target SKP';
				$data['subtitle']      = '';
				$data['list']          = $this->mskp->get_data_skp_pegawai($id,$id_posisi,date('Y'),11);
				$data['id']            = $id;
				$data['id_posisi']	   = $id_posisi;
				$data['satuan']        = $this->Allcrud->listData('mr_skp_satuan');
				$data['content']       = 'skp/skp_approval_pegawai_akademik';		
				$data['member']   	 = $this->mskp->get_member($get_data_pegawai[0]['posisi_akademik']);
				if ($data['member'] != 0) {
					// code...
					for ($i=0; $i < count($data['member']); $i++) {
						// code...
						$get_data          = $this->mskp->get_data_skp_pegawai($data['member'][$i]->id,$data['member'][$i]->posisi,date('Y'),11);						
						$data['member'][$i]->counter_belum_diperiksa = ($get_data != 0) ? count($get_data) : 0 ;;
					}
				}
				$this->load->view('templateAdmin',$data);
			}
		}
	}	

	public function approve_and_reject_skp($id,$status_skp,$stat,$stat_edit)
	{
		# code...
		$text_status = "";
		$res_data    = "";
		$data_sender = $this->input->post('data_sender');
		if ($stat == 0) {
			# code...
			$data_approve = array
							(
								'status'            => $status_skp,
								'audit_update'      => date('Y-m-d H:i:s'),
								'audit_user_update' => $this->session->userdata('sesUser')
							);
			$flag        = array('skp_id'=>$id);
			if ($data_sender['alasan'] != '' || $data_sender['alasan'] != NULL) {
				# code...
				$data_approve['remarks'] = $data_sender['alasan'];
			}

			$res_data    = $this->Allcrud->editData('mr_skp_pegawai',$data_approve,$flag);
			if ($status_skp == 1) {
				# code...
				$text_status = "Target SKP telah disetujui";
			}
			else
			{
				$text_status = "Target SKP ditolak";
			}
		}
		else
		{
			$check_data = $this->mskp->get_data_skp_pegawai_edit($id);
			if ($check_data != false) {
				# code...
				if ($status_skp == 1) {
					# code...
					$data_approve = array
									(
										// 'kegiatan'            => $check_data->edit_kegiatan,
										'PK'                  => $check_data->edit_PK,
										'AK_target'           => $check_data->edit_AK_target,
										'jenis_skp'           => $check_data->edit_jenis_skp,
										'target_qty'          => $check_data->edit_target_qty,
										'target_output'       => $check_data->edit_target_output,
										'target_kualitasmutu' => $check_data->edit_target_kualitasmutu,
										'target_waktu_bln'    => $check_data->edit_target_waktu_bln,
										'target_biaya'        => $check_data->edit_target_biaya,
										'audit_priority'      => $check_data->edit_audit_priority,
										'audit_update'        => date('Y-m-d H:i:s'),
										'audit_user_update'   => $this->session->userdata('sesUser')
									);
					$flag        = array('skp_id'=>$id);
					$res_data    = $this->Allcrud->editData('mr_skp_pegawai',$data_approve,$flag);
					$flag        = array('edit_skp_id' => $id);
					$this->Allcrud->delData('mr_skp_pegawai_temp',$flag);
					$text_status = "Perubahan Target SKP telah disetujui";
				}
				elseif ($status_skp == 2) {
					# code...
					$flag = array('edit_skp_id' => $id);
					$res_data = $this->Allcrud->delData('mr_skp_pegawai_temp',$flag);
					$text_status = "Perubahan Target SKP ditolak";
				}
			}
		}

		if ($res_data == 1) {
			# code...
			$detail_skp = $this->mskp->get_data_skp_pegawai_id($id);
			if ($status_skp == 1) {
				# code...
				// $data_notify  = array
				// 				(
				// 					'remarks'     => 'Target SKP yang anda ajukan telah disetujui',
				// 					'url'         => "skp/skp_pegawai/",
				// 					'table_name'  => 'mr_skp_pegawai',
				// 					'receiver'	  => $detail_skp->id_pegawai,
				// 					'id_table'    => $id
				// 				);
				// $res_data = $this->Globalrules->push_notifikasi($data_notify,'notify');
			}
			else
			{
				// $data_notify  = array
				// 				(
				// 					'remarks'     => 'Target SKP baru yang diajukan telah ditolak dengan alasan '.$data_sender['alasan'].', mohon direvisi kembali.',
				// 					'url'         => "skp/skp_pegawai/",
				// 					'table_name'  => 'mr_skp_pegawai',
				// 					'receiver'	  => $detail_skp->id_pegawai,
				// 					'id_table'    => $id
				// 				);
				// $res_data = $this->Globalrules->push_notifikasi($data_notify,'notify');
			}
		}
		else
		{
			$text_status = "Telah terjadi kesalahan sistem";
		}

		$text_status = $this->Globalrules->check_status_res($res_data,$text_status);
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function get_detail_skp($id)
	{
		# code...
		$res_data = $this->mskp->get_data_skp_pegawai_id($id);
		echo json_encode($res_data);
	}

	public function active_skp_master($id,$stat)
	{
		# code...
		$res_data  = $this->Allcrud->editData('mr_skp_master',array('status' => $stat),array('id_skp' => $id));
		$text_status = $this->Globalrules->check_status_res($res_data,"Status telah diubah.");
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);				
	}

	public function delete_skp($id)
	{
		# code...
		$data_res_2 = array
						(
							'status' => '99'
						);

		$flag_2     = array('skp_id' => $id);
		$res_data    = $this->Allcrud->editData('mr_skp_pegawai',$data_res_2,$flag_2);

		$text_status = $this->Globalrules->check_status_res($res_data,"Target SKP telah dihapus.");
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function change_priority($id,$param)
	{
		# code...
		$res_data    = $this->mskp->get_data_skp_pegawai_id($id);
		$priority    = "";
		$priority_2  = "";
		$text_status = "";

		if ($res_data) {
			# code...
			if ($param == 'up') {
				# code...
				if ($res_data->audit_priority == '') {
					# code...
					$priority = 0;
				}
				else
				{
					$priority = $res_data->audit_priority - 1;
				}
			}
			elseif ($param == 'down') {
				# code...
				if ($res_data->audit_priority != 0) {
					# code...
					$priority = $res_data->audit_priority + 1;
				}
			}
		}

		$res_data_2 = $this->mskp->get_data_skp_pegawai($this->session->userdata('sesUser'),NULL,date('Y'),'none',$priority);
		if ($res_data_2) {
			# code...
			if ($param == 'up') {
				# code...
				$priority_2 = $res_data_2[0]->audit_priority + 1;
			}
			elseif ($param == 'down') {
				# code...
				$priority_2 = $res_data_2[0]->audit_priority - 1;
			}
			$data_res_2 = array
							(
								'audit_priority' => $priority_2
							);
			$flag_2        = array('skp_id'=>$res_data_2[0]->skp_id);
			$res_data    = $this->Allcrud->editData('mr_skp_pegawai',$data_res_2,$flag_2);
		}

		$data_res = array
						(
							'audit_priority' => $priority
						);
		$flag        = array('skp_id'=>$id);
		$res_data    = $this->Allcrud->editData('mr_skp_pegawai',$data_res,$flag);

		$text_status = $this->Globalrules->check_status_res($res_data,$text_status);
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function parameter_pk($pk)
	{
		# code...
		$param_pk = "";
		if ($pk == 1)  $param_pk = 'PK';
		else $param_pk = 'non_PK';

		$data_list   = $this->mskp->get_data_skp_pegawai($this->session->userdata('sesUser'),NULL,date('Y'),$param_pk);

		if ($data_list != 0) {
			# code...
			$param_pk = count($data_list) + 1;
		}
		else
		{
			$param_pk = 1;
		}

		return $param_pk;
	}

	public function penilaian_skp($param=NULL,$id_posisi=NULL)
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$id               = "";
		$id_posisi        = "";
		$data['penilai']  = '';
		$data['title']    = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Penilaian SKP';
		$data['subtitle'] = '';
		$data['member']   = $this->mskp->get_member($this->session->userdata('sesPosisi'));
		$data['satuan']   = $this->Allcrud->listData('mr_skp_satuan');
		$data['jenis']    = $this->Allcrud->listData('mr_skp_jenis');
		if ($param == NULL) {
			# code...
			$id                     = $this->session->userdata('sesUser');
			$id_posisi              = $this->session->userdata('sesPosisi');			
			$data['penilai']        = 0;
		}
		else
		{
			if ($data['member'] != 0) {
				# code...
				$data['penilai'] = 1;
			}
			else
			{
				$data['penilai'] = 0;
			}
			$id          = $param;			
			$get_pegawai = $this->Allcrud->getData('mr_pegawai',array('id'=>$id))->result_array();
			if ($get_pegawai != array()) {
				# code...
				$id_posisi = $get_pegawai[0]['posisi'];
			} else {
				# code...
				$id_posisi = '';
			}
		}

		$data['infoPegawai'] = $this->Globalrules->get_info_pegawai($id,'id',$id_posisi);
		$data['list']         = $this->mskp->get_data_skp_pegawai($id,$id_posisi,date('Y'),'1','realisasi');
		$data['content']      = 'skp/penilaian_skp';
		$this->load->view('templateAdmin',$data);
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

	public function penilaian_prilaku($arg=NULL)
	{
		# code...
		$helper_title  = "";
		$helper_posisi = "";
		$helper_atasan = "";
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

		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$data                 = $this->Globalrules->data_summary_skp_pegawai($this->session->userdata('sesUser'),$helper_posisi);
		$data['content']      = 'skp/skp_penilaian_prilaku';
		$data['title']        = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Penilaian Prilaku '.$helper_title;
		$data['subtitle']     = '';
		$data['atasan']       = $this->Globalrules->list_atasan($helper_posisi);
		$data['atasan']       = ($data['atasan'] == 0) ? $this->Globalrules->list_atasan_akademik($helper_posisi) : $data['atasan'] ;
		$data['atasan_plt']   = $this->Globalrules->list_atasan_plt($helper_posisi);		
		$data['peer']         = $this->Globalrules->list_bawahan($helper_atasan);
		$data['bawahan']      = $this->Globalrules->list_bawahan($helper_posisi);
		$data['satuan']       = $this->Allcrud->listData('mr_skp_satuan');
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
		
		if($data['bawahan'] != 0){
			for ($i=0; $i < count($data['bawahan']); $i++) { 
				# code...
				$get_data_bawahan = $this->Allcrud->getData('mr_skp_penilaian_prilaku',array('id_pegawai'=>$data['bawahan'][$i]->id,'id_pegawai_penilai'=>$this->session->userdata('sesUser'),'tahun'=>date('Y')));
				if ($get_data_bawahan->result_array() == array() || $get_data_bawahan->result_array() == 0) {
					# code...
					$data_store = array
							(
								'id_pegawai'         => $data['bawahan'][$i]->id,
								'id_pegawai_penilai' => $this->session->userdata('sesUser'),
								'tahun'              => date('Y')
							);
					$res_data = $this->Allcrud->addData_with_return_id('mr_skp_penilaian_prilaku',$data_store);					
				}
			}
		}
		$data['request_eval'] = $this->mskp->get_request_eval($this->session->userdata('sesUser'),date('Y'));
		$data['evaluator']    = $this->mskp->get_data_evaluator($this->session->userdata('sesUser'),date('Y'));				
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

				$data                 = $this->Globalrules->data_summary_skp_pegawai($this->session->userdata('sesUser'),$get_data_pegawai[0]['posisi_plt']);
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
						$get_data_bawahan = $this->Allcrud->getData('mr_skp_penilaian_prilaku',array('id_pegawai'=>$data['bawahan'][$i]->id,'id_pegawai_penilai'=>$this->session->userdata('sesUser'),'tahun'=>date('Y')));
						if ($get_data_bawahan->result_array() == array() || $get_data_bawahan->result_array() == 0) {
							# code...
							$data_store = array
									(
										'id_pegawai'         => $data['bawahan'][$i]->id,
										'id_pegawai_penilai' => $this->session->userdata('sesUser'),
										'tahun'              => date('Y')
									);
							$res_data = $this->Allcrud->addData_with_return_id('mr_skp_penilaian_prilaku',$data_store);					
						}
					}
				}
				$data['request_eval'] = $this->mskp->get_request_eval($this->session->userdata('sesUser'),date('Y'));
				$data['evaluator']    = $this->mskp->get_data_evaluator($this->session->userdata('sesUser'),date('Y'));				
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
		for ($i=0; $i < count($data_sender); $i++) {
			# code...
			$info_pegawai = $this->Globalrules->get_info_pegawai($data_sender[$i]['evaluator'],'nama_pegawai');

			if ($info_pegawai != 0) {
				# code...
				$check_data = $this->mskp->get_info_evaluator($this->session->userdata('sesUser'),$info_pegawai[0]->id,date('Y'));
				if ($check_data == 0) {
					# code...
					$data = array
							(
								'id_pegawai'         => $this->session->userdata('sesUser'),
								'id_pegawai_penilai' => $info_pegawai[0]->id,
								'tahun'              => date('Y')
							);
					$res_data_id = $this->Allcrud->addData_with_return_id('mr_skp_penilaian_prilaku',$data);

					if ($res_data_id != 0) {
						# code...
						$res_data = 1;
					}
				}
				else
				{
					$res_data = 0;
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
		$res_data = $this->mskp->get_detail_skp_penilaian($id);
		echo json_encode($res_data);
	}

	public function proses_penilaian_prilaku()
	{
		# code...
		$res_data             = "";
		$data_sender          = $this->input->post('data_sender');
		$detail_skp_penilaian = $this->mskp->get_detail_skp_penilaian($data_sender['id']);
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

	public function master_skp()
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->user_access_read();		
		$this->Globalrules->notif_message();
		$data['title']        = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Master SKP';
		$data['subtitle']     = '';
		$data['content']      = 'skp/master_skp';
		$data['es1']          = $this->Allcrud->listData('mr_eselon1');
		$data['jenis_posisi'] = $this->Allcrud->listData('mr_kat_posisi');
		$data['class_posisi'] = $this->Mmaster->get_posisi_class();
		$data['katpos']       = $this->Allcrud->listData('mr_kat_posisi');
		$this->load->view('templateAdmin',$data);
	}

	public function filter_data_master_skp($value='')
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$data_sender = array
						(
							'eselon1' => $data_sender['data_1'],
							'eselon2' => $data_sender['data_2'],
							'eselon3' => $data_sender['data_3'],
							'eselon4' => $data_sender['data_4']
						);

		$data = $this->get_data_master_skp($data_sender);
		$this->load->view('skp/ajax_master_skp',$data);
	}

	public function get_data_master_skp($data_sender)
	{
		# code...
		$data['list']         = $this->Mmaster->get_struktur_organisasi($data_sender,1);
		if ($data['list'] != 0) {
			# code...
			$xx = 0;
			$data['data_counter']['ready'] = 0;			
			for ($i=0; $i < count($data['list']); $i++) {
				# code...
				$get_summary_urtug = $this->mskp->get_summary_master_skp($data['list'][$i]->id);
				if ($get_summary_urtug != 0) {
					# code...
					$xx++;
					$data['data_counter']['ready']      = $data['data_counter']['ready'] + 1;
					$data['list'][$i]->is_master_skp    = 'ready';
					$data['list'][$i]->count_master_skp = $get_summary_urtug;
				}
				else
				{
					$data['list'][$i]->is_master_skp = 'not-ready';
					$data['list'][$i]->count_master_skp = 0;
				}
			}

			$data['data_counter']['ready'] = $xx;			
		}

		return $data;
	}

	public function master_skp_posisi($id)
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$data['title']    = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Master SKP - Detail';
		$data['subtitle'] = '';
		$data['info']     = $this->Allcrud->getData('mr_posisi',array('id' => $id))->result_array();
		$data['list']     = $this->mskp->get_master_skp_id($id,'posisi');
		$data['content']  = 'skp/skp_master_posisi';
		$data['satuan']   = $this->Allcrud->listData('mr_skp_satuan');
		$data['jenis']    = $this->Allcrud->listData('mr_skp_jenis');
		$data['oid']      = $id;
		$this->load->view('templateAdmin',$data);
	}

	public function delete_master_skp_posisi($id)
	{
		# code...
		$res_data    = $this->Allcrud->delData('mr_skp_master',array('posisi'=>$id));
		$res_data    = $this->Allcrud->delData('mr_skp_pegawai',array('id_posisi'=>$id));		
		$text_status = $this->Globalrules->check_status_res($res_data,'Data Uraian Tugas berhasil dihapus.');
		$res         = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}

	public function add_master_skp_posisi($OID)
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$data        = array
					(
						'posisi'     => $OID,
						'status'     => 1,
						'keterangan' => $data_sender['keterangan'],
						'kegiatan'   => $data_sender['kegiatan']
					);		
		$res_data    = $this->Allcrud->addData('mr_skp_master',$data);
		$text_status = $this->Globalrules->check_status_res($res_data,'Master SKP telah ditambahkan.');
		$res         = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function get_master_skp_id($id)
	{
		# code...
		$res_data = $this->mskp->get_master_skp_id($id,'id');
		echo json_encode($res_data);
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

	public function edit_master_skp()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$data        = array
					(
						'kegiatan'   => $data_sender['kegiatan'],
						'keterangan' => $data_sender['keterangan']
					);
		$flag        = array('id_skp'=>$data_sender['id']);
		$res_data    = $this->Allcrud->editData('mr_skp_master',$data,$flag);
		$text_status = $this->Globalrules->check_status_res($res_data,'SKP telah diubah.');
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function import_master_skp($id)
	{
		# code...
		$data_store = "";
		if($_FILES['userfile']['error'] == 4)
		{
			return false;
		}

		$config['upload_path']        = './public/excel/';
		$config['allowed_types']      = 'xls|xlsx';
		$config['max_size']           = 20000;

        $this->load->library('upload');
        $this->upload->initialize($config);

        // print_r($_FILES['userfile']);die();

        if( $this->upload->do_upload('userfile') )
        {
			//load the excel library
			$this->load->library('excel');

			$dataImage     = $this->upload->data();

			//read file from path
			$objPHPExcel = PHPExcel_IOFactory::load($dataImage['full_path']);

			//get only the Cell Collection
			$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
			//extract to a PHP readable array format
			foreach ($cell_collection as $cell) {
				$column     = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
				$row        = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
				$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

			    //header will/should be in row 1 only. of course this can be modified to suit your need.
			    if ($row == 1) {
			        $header[$row][$column] = $data_value;
			    } else
			    {
			    	if ($row == 2) {
			    		# code...
			    	}
			    	elseif ($row == 4) {
			    		# code...
				        $header[$row][$column] = $data_value;
			    	}
			    	else
			    	{
			        	$arr_data[$row][$column] = $data_value;
			    	}
			    }
			}

			//send the data in an array format
			$data['values'] = $arr_data;

			$data_count = (5+count($data['values']));
			for ($i=5; $i < $data_count; $i++) {
				# code...
				$data_store        = array
									(
										'posisi'     => $id,
										'kegiatan'   => $data['values'][$i]['B'],
										// 'keterangan' => $data['values'][$i]['C'],
										'status'     => 1
								);
				if ($data['values'][$i]['A'] == '+') {
					# code...
					$res_data = $this->Allcrud->addData('mr_skp_master',$data_store);
				}
			}
			$link = 'skp/master_skp_posisi/'.$id;
			redirect($link);
        }
        else
        {
            echo $this->upload->display_errors();
        }
	}

	public function template_master_skp($id)
	{
		# code...
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 300);
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Template Unggah Master SKP');
		$this->excel->getActiveSheet()->getStyle('a4:c4')->getBorders()->getallborders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$this->excel->getActiveSheet()->setCellValue('a1', 'Note : Gunakan karakter + untuk melakukan penambahan data didalam kolom id. Apabila ada field yang kosong, Harap isi dengan karakter -. Diharapkan semua field terisi.');
		$this->excel->getActiveSheet()->setCellValue('a2', 'Posisi ID : ');
		$this->excel->getActiveSheet()->setCellValue('b2', $id);

		$this->excel->getActiveSheet()->setCellValue('a4', 'id');
		$this->excel->getActiveSheet()->setCellValue('b4', 'Kegiatan');
		$this->excel->getActiveSheet()->setCellValue('c4', 'Keterangan');

		ob_clean();

		$filename='Template Unggah Master SKP - '.date("d-m-Y").'.xlsx'; //save our workbook as this file name
		//header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type excel 2007
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		exit();
		redirect('master_skp_posisi/'.$id, false);
	}

	public function syncronice_skp($id_pegawai,$posisi,$tahun)
	{
		# code...
		$check_posisi = $this->Allcrud->getData('mr_posisi',array('id' => $posisi))->result_array();
		if ($check_posisi != array()) {
			# code...
			$kat_posisi = $check_posisi[0]['kat_posisi']; 

			if ($kat_posisi == 1) {
				# code...
				$bind_data = $this->mskp->get_master_skp_id($posisi,'posisi');

				if ($bind_data != 0) {
					# code...
					for ($i=0; $i < count($bind_data); $i++) {
						# code...
						$check_data = $this->mskp->check_pekerjaan_pegawai($id_pegawai,$bind_data[$i]->id_skp,$tahun,$posisi);
						if ($check_data == false) {
							# code...
							$data = array(
								'id_pegawai'     => $id_pegawai,
								'id_posisi'      => $posisi,
								'tahun'          => date('Y'),
								'id_skp_master'  => $bind_data[$i]->id_skp,
								'status'         => '6',
								'audit_priority' => ''
							);
							$res_data_id_friend = $this->Allcrud->addData_with_return_id('mr_skp_pegawai',$data);
						}
					}
				}				
			}
			elseif ($kat_posisi == 2) {
				# code...
				if ($check_posisi[0]['id_jft'] != '') {
					# code...
					$check_jft = $this->Allcrud->getData('mr_jabatan_fungsional_tertentu_uraian_tugas',array('id_jft' => $check_posisi[0]['id_jft']))->result_array();
					if ($check_jft != array()) {
						# code...
						for ($i=0; $i < count($check_jft); $i++) { 
							# code...
							$check_data = $this->mskp->check_pekerjaan_pegawai_jft($id_pegawai,$check_jft[$i]['id'],$tahun,$posisi);
							if ($check_data == false) {
								# code...
								$data = array(
									'id_pegawai'     => $id_pegawai,
									'id_posisi'      => $posisi,
									'tahun'          => date('Y'),
									'id_skp_master'  => '',
									'id_skp_jfu'     => '',
									'id_skp_jft'     => $check_jft[$i]['id'],									
									'status'         => '6',
									'audit_priority' => ''
								);
								$res_data_id_friend = $this->Allcrud->addData_with_return_id('mr_skp_pegawai',$data);
							}							
						}
					}		
				}
				else {
					# code...
					// echo "cannot sync";
				}				
			}
			elseif ($kat_posisi == 4) {
				# code...
					
				if ($check_posisi[0]['id_jfu'] != '') {
					# code...
					$check_jfu = $this->Allcrud->getData('mr_jabatan_fungsional_umum_uraian_tugas',array('id_jfu' => $check_posisi[0]['id_jfu']))->result_array();
					// print_r($check_jfu);die();
					if ($check_jfu != array()) {
						# code...
						for ($i=0; $i < count($check_jfu); $i++) { 
							# code...
							$check_data = $this->mskp->check_pekerjaan_pegawai_jfu($id_pegawai,$check_jfu[$i]['id'],$tahun,$posisi);
							if ($check_data == false) {
								# code...
								$data = array(
									'id_pegawai'     => $id_pegawai,
									'id_posisi'      => $posisi,
									'tahun'          => date('Y'),
									'id_skp_master'  => '',
									'id_skp_jfu'     => $check_jfu[$i]['id'],
									'id_skp_jft'     => '',									
									'status'         => '6',
									'audit_priority' => ''
								);
								$res_data_id_friend = $this->Allcrud->addData_with_return_id('mr_skp_pegawai',$data);
							}							
						}
					}		
				}
				else {
					# code...
					// echo "cannot sync";
				}
			}
			elseif ($kat_posisi == 6) {
				# code...
				$bind_data = $this->mskp->get_master_skp_id($posisi,'posisi');
				// print_r($bind_data);die();
				if ($bind_data != 0) {
					# code...
					for ($i=0; $i < count($bind_data); $i++) {
						# code...
						$check_data = $this->mskp->check_pekerjaan_pegawai($id_pegawai,$bind_data[$i]->id_skp,$tahun,$posisi);
						if ($check_data == false) {
							# code...
							$data = array(
								'id_pegawai'     => $id_pegawai,
								'id_posisi'      => $posisi,
								'tahun'          => date('Y'),
								'id_skp_master'  => $bind_data[$i]->id_skp,
								'status'         => '6',
								'audit_priority' => ''
							);
							$res_data_id_friend = $this->Allcrud->addData_with_return_id('mr_skp_pegawai',$data);
						}
					}
				}								
			}
		}
	}

	public function cetak_skp($id=NULL,$posisi=NULL)
	{
		# code...
		if($id != NULL)
		{
			if($posisi != NULL)
			{
				$this->Globalrules->session_rule();
				$this->Globalrules->notif_message();
				$data             = $this->Globalrules->data_summary_skp_pegawai($id,$posisi);
				// echo "<pre>";
				// print_r($data);die();
				// echo "</pre>";
				$data['penilai']  = '';
				$data['id_pegawai'] = $id;
				$data['id_posisi'] = $posisi;
				$data['title']    = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Cetak SKP';
				$data['content']  = 'skp/cetak_history_skp';
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
		$data['title']    = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Cetak SKP';
		$data['content']  = 'skp/skp_history_skp';
		$data['request_history'] = $this->mskp->get_request_history($this->session->userdata('sesUser'),date('Y'));
		$this->load->view('templateAdmin',$data);
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
}
  