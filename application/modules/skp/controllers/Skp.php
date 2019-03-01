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
						$data_notify  = array
										(
											'remarks'     => 'Target SKP baru yang diajukan oleh '.$this->session->userdata('sesNama'),
											'url'         => "skp/skp_pegawai/",
											'table_name'  => 'mr_skp_pegawai',
											'receiver'	  => $get_friend[$i]->id,
											'id_table'    => $res_data_id_friend
										);

						$res_data = $this->Globalrules->push_notifikasi($data_notify,'notify');
					}

				}
			}

			if ($res_data_id != 0) {
				# code...
				$data_notify  = array
								(
									'remarks'     => $this->session->userdata('sesNama').' telah mengajukan Target SKP baru',
									'url'         => "skp/skp_member_detail/".$this->session->userdata('sesUser'),
									'table_name'  => 'mr_skp_pegawai',
									'id_table'    => $res_data_id
								);

				$res_data = $this->Globalrules->push_notifikasi($data_notify,'approval');
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
			$data['status'] = 1;
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
			$data_notify  = array
							(
								'remarks'     => $this->session->userdata('sesNama').' telah mengajukan perubahan Target SKP',
								'url'         => "skp/skp_member_detail/".$this->session->userdata('sesUser'),
								'table_name'  => 'mr_skp_pegawai',
								'id_table'    => $res_data_id
							);
			$res_data = $this->Globalrules->push_notifikasi($data_notify,'approval');
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
				$data['status'] = 1;
			}
			else {
				# code...
				$data['status'] = 0;
			}			

			$flag        = array('skp_id'=>$data_sender['id']);
			$res_data    = $this->Allcrud->editData('mr_skp_pegawai',$data_change,$flag);
			$data_notify  = array
							(
								'remarks'     => $this->session->userdata('sesNama').' telah mengajukan perubahan Target SKP',
								'url'         => "skp/skp_member_detail/".$this->session->userdata('sesUser'),
								'table_name'  => 'mr_skp_pegawai',
								'id_table'    => $data_sender['id']
							);
			$res_data    = $this->Globalrules->push_notifikasi($data_notify,'approval');
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

			$data_notify  = array
							(
								'remarks'     => $this->session->userdata('sesNama').' telah mengajukan perubahan Target SKP',
								'url'         => "skp/skp_member_detail/".$this->session->userdata('sesUser'),
								'table_name'  => 'mr_skp_pegawai',
								'id_table'    => $data_sender['id']
							);

			$res_data = $this->Globalrules->push_notifikasi($data_notify,'approval');
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
				$get_data = $this->Allcrud->getData('mr_skp_pegawai',array('status'=>0,'id_pegawai'=>$data['member'][$i]->id))->num_rows();
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
		$this->load->view('templateAdmin',$data);
	}

	public function skp_member_detail($id)
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$data['title']       = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Approval Target SKP Anggota Tim <i class="fa fa-angle-double-right"></i> Approval Target SKP';
		$data['subtitle']    = '';
		$data['list']        = $this->mskp->get_data_skp_pegawai($id,NULL,date('Y'),11);
		$data['id']          = $id;
		$data['satuan']      = $this->Allcrud->listData('mr_skp_satuan');
		$data['content']     = 'skp/skp_approval_pegawai';		
		$data['member']   	 = $this->mskp->get_member($this->session->userdata('sesPosisi'));
		if ($data['member'] != 0) {
			// code...
			for ($i=0; $i < count($data['member']); $i++) {
				// code...
				$get_data = $this->Allcrud->getData('mr_skp_pegawai',array('status'=>0,'id_pegawai'=>$data['member'][$i]->id))->num_rows();
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
		$this->load->view('templateAdmin',$data);
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
			$data_notify  = array
							(
								'id_table'   => $id,
								'table_name' => 'mr_skp_pegawai'
							);
			$this->Globalrules->push_notifikasi($data_notify,'read_data');
			$detail_skp = $this->mskp->get_data_skp_pegawai_id($id);
			if ($status_skp == 1) {
				# code...
				$data_notify  = array
								(
									'remarks'     => 'Target SKP yang anda ajukan telah disetujui',
									'url'         => "skp/skp_pegawai/",
									'table_name'  => 'mr_skp_pegawai',
									'receiver'	  => $detail_skp->id_pegawai,
									'id_table'    => $id
								);
				$res_data = $this->Globalrules->push_notifikasi($data_notify,'notify');
			}
			else
			{
				$data_notify  = array
								(
									'remarks'     => 'Target SKP baru yang diajukan telah ditolak dengan alasan '.$data_sender['alasan'].', mohon direvisi kembali.',
									'url'         => "skp/skp_pegawai/",
									'table_name'  => 'mr_skp_pegawai',
									'receiver'	  => $detail_skp->id_pegawai,
									'id_table'    => $id
								);
				$res_data = $this->Globalrules->push_notifikasi($data_notify,'notify');
			}
		}
		else
		{
			$text_status = "Telah terjadi kesalahan sistem";
		}


		$data_notify  = array
						(
							'id_table'   => $id,
							'table_name' => 'tr_capaian_pekerjaan'
						);
		$this->Globalrules->push_notifikasi($data_notify,'read_data');

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

	public function delete_skp($id)
	{
		# code...
		$data_res_2 = array
						(
							'status' => '99'
						);

		$flag_2     = array('skp_id' => $id);
		$res_data    = $this->Allcrud->editData('mr_skp_pegawai',$data_res_2,$flag_2);

		$data_notify  = array
						(
							'id_table'   => $id,
							'table_name' => 'mr_skp_pegawai'
						);
		$res_data = $this->Globalrules->push_notifikasi($data_notify,'delete_data');

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
		// print_r($res_data);die();
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

	public function penilaian_skp($param=NULL)
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$id               = "";
		$data['penilai']  = '';
		$data['title']    = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Penilaian SKP';
		$data['subtitle'] = '';
		$data['member']   = $this->mskp->get_member($this->session->userdata('sesPosisi'));
		$data['satuan']   = $this->Allcrud->listData('mr_skp_satuan');
		$data['jenis']    = $this->Allcrud->listData('mr_skp_jenis');
		if ($param == NULL) {
			# code...
			$id              = $this->session->userdata('sesUser');
			$data['penilai'] = 0;
		}
		else
		{
			if ($data['member'] != 0) {
				# code...
				$id = $param;
				$data['penilai'] = 1;
			}
			else
			{
				$id              = $this->session->userdata('sesUser');
				$data['penilai'] = 0;
			}
			$id = $param;			
		}

		$data['infoPegawai1'] = $this->Globalrules->get_info_pegawai($id,'id');
		$data['list']        = $this->mskp->get_data_skp_pegawai($id,NULL,date('Y'),'1','realisasi');
		// echo "<pre>";
		// print_r($data['infoPegawai1']);die();				
		// echo"</pre>";
		$data['content']     = 'skp/penilaian_skp';
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

	public function penilaian_prilaku()
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$data                 = $this->Globalrules->data_summary_skp_pegawai($this->session->userdata('sesUser'));
		$data['content']      = 'skp/skp_penilaian_prilaku';
		$data['title']        = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Penilaian Prilaku';
		$data['subtitle']     = '';
		$data['atasan']       = $this->Globalrules->list_atasan($this->session->userdata('sesPosisi'));
		$data['peer']         = $this->Globalrules->list_bawahan($this->session->userdata('atasan'));
		$data['bawahan']      = $this->Globalrules->list_bawahan($this->session->userdata('sesPosisi'));
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
						$data_notify  = array
										(
											'remarks'     => $this->session->userdata('sesNama').' telah mengajukan penilaian prilaku.',
											'url'         => "skp/penilaian_prilaku/",
											'table_name'  => 'mr_skp_penilaian_prilaku',
											'id_table'    => $res_data_id,
											'sender'	  => $this->session->userdata('sesUser'),
											'receiver'	  => $info_pegawai[0]->id,
										);

						$res_data = $this->Globalrules->push_notifikasi($data_notify,'notify');
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
		$this->Globalrules->notif_message();
		$data_sender = array
						(
							'eselon1' => $this->session->userdata('sesEs1'),
							'eselon2' => '',
							'eselon3' => '',
							'eselon4' => ''
						);
		$data                 = $this->get_data_master_skp($data_sender);
		$data['title']        = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Master SKP';
		$data['subtitle']     = '';
		$data['content']      = 'skp/master_skp';
		$data['es1']          = $this->Allcrud->listData('mr_eselon1');
		$data['es2']          = $this->Allcrud->getData('mr_eselon2',array('id_es1'=>$this->session->userdata('sesEs1')));
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
			}
		}
	}

	public function cetak_skp($param=NULL)
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$data             = $this->Globalrules->data_summary_skp_pegawai($this->session->userdata('sesUser'));
		$data['penilai']  = '';
		$data['title']    = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Cetak SKP';
		$data['content']  = 'skp/cetak_skp';
		$this->load->view('templateAdmin',$data);
	}

	public function cetak_skp_excel($id)
	{
		# code...
		$data                = $this->Globalrules->data_summary_skp_pegawai($id);

		$evaluator                   = $data['evaluator'];
		$total_realisasi_skp         = "";
		$nilai_capaian_skp           = "";
		$pangkat                     = '';
		$pangkat_atasan              = '';
		$pangkat_atasan_penilai      = '';
		$ruang                       = '';
		$ruang_atasan                = '';
		$ruang_atasan_penilai        = '';
		$tmt_golongan                = '';
		$tmt_golongan_atasan         = '';
		$tmt_golongan_atasan_penilai = '';


		if($data['infoPegawai'][0]->nama_pangkat != '-')$pangkat      = $data['infoPegawai'][0]->nama_pangkat;else $pangkat                                        = '-';
		if($data['infoPegawai'][0]->nama_golongan != '-')$ruang       = '('.$data['infoPegawai'][0]->nama_golongan.'/'.$data['infoPegawai'][0]->nama_ruang.')';else $ruang = '';
		if($data['infoPegawai'][0]->tmt_golongan != '-')$tmt_golongan = ', '.date("d-m-Y",strtotime($data['infoPegawai'][0]->tmt_golongan));else $tmt_golongan = '';		

		if($data['atasan'][0]->nama_pangkat != '-')$pangkat_atasan      = $data['atasan'][0]->nama_pangkat;else $pangkat_atasan                                        = '-';
		if($data['atasan'][0]->nama_golongan != '-')$ruang_atasan       = '('.$data['atasan'][0]->nama_golongan.'/'.$data['atasan'][0]->nama_ruang.')';else $ruang_atasan      = '';
		if($data['atasan'][0]->tmt_golongan != '-')$tmt_golongan_atasan = ', '.date("d-m-Y",strtotime($data['atasan'][0]->tmt_golongan));else $tmt_golongan_atasan = '';

		if($data['atasan_penilai'][0]->nama_pangkat != '-')$pangkat_atasan_penilai      = $data['atasan_penilai'][0]->nama_pangkat;else $pangkat_atasan_penilai                                           = '-';
		if($data['atasan_penilai'][0]->nama_golongan != '-')$ruang_atasan_penilai       = '('.$data['atasan_penilai'][0]->nama_golongan.'/'.$data['atasan_penilai'][0]->nama_ruang.')';else $ruang_atasan_penilai = '';
		if($data['atasan_penilai'][0]->tmt_golongan != '-')$tmt_golongan_atasan_penilai = ', '.date("d-m-Y",strtotime($data['atasan_penilai'][0]->tmt_golongan));else $tmt_golongan_atasan_penilai        = '';
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 300);
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('PENILAIAN PRESTASI KERJA');

		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$signature = FCPATH.'public/lambang-pancasila.jpg';
		$objDrawing->setPath($signature);
		$objDrawing->setOffsetX(45);                     //setOffsetX works properly
		$objDrawing->setCoordinates('D2');             //set image to cell E38
		$objDrawing->setHeight(75);                     //signature height
		$objDrawing->setWorksheet($this->excel->getActiveSheet());  //save
		// $this->excel->getActiveSheet()->getStyle('d2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
/*******************************************************************************************************************************************************/
		$this->excel->getActiveSheet()->getColumnDimension('b')->setWidth('4');
		$this->excel->getActiveSheet()->getColumnDimension('c')->setWidth('32');
		$this->excel->getActiveSheet()->getColumnDimension('d')->setWidth('21');
		$this->excel->getActiveSheet()->getColumnDimension('e')->setWidth('10');
		$this->excel->getActiveSheet()->getColumnDimension('f')->setWidth('10');
		$this->excel->getActiveSheet()->getColumnDimension('g')->setWidth('10');
		$this->excel->getActiveSheet()->getColumnDimension('h')->setWidth('10');

		$this->excel->getActiveSheet()->setCellValue('b6', 'PENILAIAN PRESTASI KERJA');
		$this->excel->getActiveSheet()->setCellValue('b7', 'PEGAWAI NEGERI SIPIL');
		$this->excel->getActiveSheet()->mergeCells('b6:h6');
		$this->excel->getActiveSheet()->mergeCells('b7:h7');
		$this->excel->getActiveSheet()->getStyle('b6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('b7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue('b10', 'KEMENTERIAN DALAM NEGERI');
		$this->excel->getActiveSheet()->setCellValue('b11', 'SEKRETARIAT JENDERAL');
		$this->excel->getActiveSheet()->setCellValue('f10', 'JANGKA WAKTU PENILAIAN');
		$this->excel->getActiveSheet()->setCellValue('f11', 'BULAN : Januari s.d 31 Desember');
		$this->excel->getActiveSheet()->mergeCells('b10:c10');
		$this->excel->getActiveSheet()->mergeCells('b11:c11');

		$this->excel->getActiveSheet()->setCellValue('b13', '1');
		$this->excel->getActiveSheet()->setCellValue('c13', 'YANG DINILAI');
		$this->excel->getActiveSheet()->setCellValue('c14', 'a. Nama');
		$this->excel->getActiveSheet()->setCellValue('c15', 'b. NIP');
		$this->excel->getActiveSheet()->setCellValue('c16', 'c. Pangkat, Golongan ruang, TMT');
		$this->excel->getActiveSheet()->setCellValue('c17', 'd. Jabatan/Pekerjaan');
		$this->excel->getActiveSheet()->setCellValue('c18', 'e. Unit Organisasi');
		$this->excel->getActiveSheet()->setCellValue('d14', $data['infoPegawai'][0]->nama_pegawai);
		$this->excel->getActiveSheet()->setCellValue('d15', "'".$data['infoPegawai'][0]->nip);
		$this->excel->getActiveSheet()->setCellValue('d16', $pangkat.$ruang.$tmt_golongan);
		$this->excel->getActiveSheet()->setCellValue('d17', $data['infoPegawai'][0]->nama_jabatan);
		$this->excel->getActiveSheet()->setCellValue('d18', $data['infoPegawai'][0]->nama_eselon2." ".$data['infoPegawai'][0]->nama_eselon1);
		$this->excel->getActiveSheet()->mergeCells('b13:b18');
		$this->excel->getActiveSheet()->mergeCells('c13:h13');
		$this->excel->getActiveSheet()->mergeCells('d14:h14');
		$this->excel->getActiveSheet()->mergeCells('d15:h15');
		$this->excel->getActiveSheet()->mergeCells('d16:h16');
		$this->excel->getActiveSheet()->mergeCells('d17:h17');
		$this->excel->getActiveSheet()->mergeCells('d18:h18');
		$this->excel->getActiveSheet()->getStyle('c13:h13')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c14:h14')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c15:h15')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c16:h16')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c17:h17')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c18:h18')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$this->excel->getActiveSheet()->setCellValue('b19', '2');
		$this->excel->getActiveSheet()->setCellValue('c19', 'PEJABAT PENILAI');
		$this->excel->getActiveSheet()->setCellValue('c20', 'a. Nama');
		$this->excel->getActiveSheet()->setCellValue('c21', 'b. NIP');
		$this->excel->getActiveSheet()->setCellValue('c22', 'c. Pangkat, Golongan ruang, TMT');
		$this->excel->getActiveSheet()->setCellValue('c23', 'd. Jabatan/Pekerjaan');
		$this->excel->getActiveSheet()->setCellValue('c24', 'e. Unit Organisasi');
		$this->excel->getActiveSheet()->setCellValue('d20', $data['atasan'][0]->nama_pegawai);
		$this->excel->getActiveSheet()->setCellValue('d21', "'".$data['atasan'][0]->nip);
		$this->excel->getActiveSheet()->setCellValue('d22', $pangkat_atasan.$ruang_atasan.$tmt_golongan_atasan);
		$this->excel->getActiveSheet()->setCellValue('d23', $data['atasan'][0]->nama_jabatan);
		$this->excel->getActiveSheet()->setCellValue('d24', $data['atasan'][0]->nama_eselon2." ".$data['atasan'][0]->nama_eselon1);
		$this->excel->getActiveSheet()->mergeCells('b19:b24');
		$this->excel->getActiveSheet()->mergeCells('c19:h19');
		$this->excel->getActiveSheet()->mergeCells('d20:h20');
		$this->excel->getActiveSheet()->mergeCells('d21:h21');
		$this->excel->getActiveSheet()->mergeCells('d22:h22');
		$this->excel->getActiveSheet()->mergeCells('d23:h23');
		$this->excel->getActiveSheet()->mergeCells('d24:h24');
		$this->excel->getActiveSheet()->getStyle('c19:h19')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c20:h20')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c21:h21')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c22:h22')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c23:h23')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c24:h24')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$this->excel->getActiveSheet()->setCellValue('b25', '3');
		$this->excel->getActiveSheet()->setCellValue('c25', 'ATASAN PEJABAT PENILAI');
		$this->excel->getActiveSheet()->setCellValue('c26', 'a. Nama');
		$this->excel->getActiveSheet()->setCellValue('c27', 'b. NIP');
		$this->excel->getActiveSheet()->setCellValue('c28', 'c. Pangkat, Golongan ruang, TMT');
		$this->excel->getActiveSheet()->setCellValue('c29', 'd. Jabatan/Pekerjaan');
		$this->excel->getActiveSheet()->setCellValue('c30', 'e. Unit Organisasi');
		$this->excel->getActiveSheet()->setCellValue('d26', $data['atasan_penilai'][0]->nama_pegawai);
		$this->excel->getActiveSheet()->setCellValue('d27', "'".$data['atasan_penilai'][0]->nip);
		$this->excel->getActiveSheet()->setCellValue('d28', $pangkat_atasan_penilai.$ruang_atasan_penilai.$tmt_golongan_atasan_penilai);
		$this->excel->getActiveSheet()->setCellValue('d29', $data['atasan_penilai'][0]->nama_jabatan);
		$this->excel->getActiveSheet()->setCellValue('d30', $data['atasan_penilai'][0]->nama_eselon2." ".$data['atasan_penilai'][0]->nama_eselon1);
		$this->excel->getActiveSheet()->mergeCells('b25:b30');
		$this->excel->getActiveSheet()->mergeCells('c25:h25');
		$this->excel->getActiveSheet()->mergeCells('d26:h26');
		$this->excel->getActiveSheet()->mergeCells('d27:h27');
		$this->excel->getActiveSheet()->mergeCells('d28:h28');
		$this->excel->getActiveSheet()->mergeCells('d29:h29');
		$this->excel->getActiveSheet()->mergeCells('d30:h30');
		$this->excel->getActiveSheet()->getStyle('c25:h25')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c26:h26')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c27:h27')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c28:h28')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c29:h29')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c30:h30')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$this->excel->getActiveSheet()->setCellValue('b31', '4');
		$this->excel->getActiveSheet()->setCellValue('c31', 'UNSUR YANG DINILAI');
		$this->excel->getActiveSheet()->setCellValue('h31', 'Jumlah');
		$this->excel->getActiveSheet()->setCellValue('c32', 'a. Sasaran Kerja Pegawai (SKP)');
		$this->excel->getActiveSheet()->setCellValue('c33', 'b. Prilaku Kerja');
		$this->excel->getActiveSheet()->setCellValue('d33', '1. Orientasi Pelayanan');
		$this->excel->getActiveSheet()->setCellValue('d34', '2. Integritas');
		$this->excel->getActiveSheet()->setCellValue('d35', '3. Komitmen');
		$this->excel->getActiveSheet()->setCellValue('d36', '4. Disiplin');
		$this->excel->getActiveSheet()->setCellValue('d37', '5. Kerja Sama');
		$this->excel->getActiveSheet()->setCellValue('d38', '6. Kepemimpinan');
		$this->excel->getActiveSheet()->setCellValue('d39', '7. Jumlah');
		$this->excel->getActiveSheet()->setCellValue('d40', '8. Nilai Rata - rata');
		$this->excel->getActiveSheet()->setCellValue('d41', '9. Nilai Prilaku Kerja');
		$this->excel->getActiveSheet()->setCellValue('b42', 'NILAI PRESTASI KERJA');
		$this->excel->getActiveSheet()->setCellValue('d32', number_format($data['summary_skp']['total'],2)."  x 60%");
		$this->excel->getActiveSheet()->setCellValue('h32', number_format($data['summary_skp']['nilai_sasaran_kinerja_pegawai'],2));
		$this->excel->getActiveSheet()->setCellValue('f33', number_format($data['summary_prilaku_skp']['orientasi_pelayanan'],2));
		$this->excel->getActiveSheet()->setCellValue('f34', number_format($data['summary_prilaku_skp']['integritas'],2));
		$this->excel->getActiveSheet()->setCellValue('f35', number_format($data['summary_prilaku_skp']['komitmen'],2));
		$this->excel->getActiveSheet()->setCellValue('f36', number_format($data['summary_prilaku_skp']['disiplin'],2));
		$this->excel->getActiveSheet()->setCellValue('f37', number_format($data['summary_prilaku_skp']['kerjasama'],2));
		$this->excel->getActiveSheet()->setCellValue('f38', number_format($data['summary_prilaku_skp']['kepemimpinan'],2));
		$this->excel->getActiveSheet()->setCellValue('f39', number_format($data['summary_prilaku_skp']['jumlah'],2));
		$this->excel->getActiveSheet()->setCellValue('f40', number_format($data['summary_prilaku_skp']['rata_rata'],2));
		$this->excel->getActiveSheet()->setCellValue('h41', number_format($data['summary_prilaku_skp']['nilai_prilaku_kerja'],2));
		$this->excel->getActiveSheet()->setCellValue('g33', $this->Globalrules->nilai_capaian_skp($data['summary_prilaku_skp']['orientasi_pelayanan']));
		$this->excel->getActiveSheet()->setCellValue('g34', $this->Globalrules->nilai_capaian_skp($data['summary_prilaku_skp']['integritas']));
		$this->excel->getActiveSheet()->setCellValue('g35', $this->Globalrules->nilai_capaian_skp($data['summary_prilaku_skp']['komitmen']));
		$this->excel->getActiveSheet()->setCellValue('g36', $this->Globalrules->nilai_capaian_skp($data['summary_prilaku_skp']['disiplin']));
		$this->excel->getActiveSheet()->setCellValue('g37', $this->Globalrules->nilai_capaian_skp($data['summary_prilaku_skp']['kerjasama']));
		$this->excel->getActiveSheet()->setCellValue('g38', $this->Globalrules->nilai_capaian_skp($data['summary_prilaku_skp']['kepemimpinan']));
		$this->excel->getActiveSheet()->setCellValue('g40', $this->Globalrules->nilai_capaian_skp($data['summary_prilaku_skp']['rata_rata']));
		$this->excel->getActiveSheet()->setCellValue('e41', number_format($data['summary_prilaku_skp']['rata_rata'],2)." x 40%");
		$this->excel->getActiveSheet()->setCellValue('h42', number_format($data['summary_skp']['nilai_sasaran_kinerja_pegawai']+$data['summary_prilaku_skp']['nilai_prilaku_kerja'],2));
		$this->excel->getActiveSheet()->setCellValue('h43', $this->Globalrules->nilai_capaian_skp($data['summary_skp']['nilai_sasaran_kinerja_pegawai']+$data['summary_prilaku_skp']['nilai_prilaku_kerja']));
		$this->excel->getActiveSheet()->mergeCells('b31:b41');
		$this->excel->getActiveSheet()->mergeCells('c31:g31');
		$this->excel->getActiveSheet()->mergeCells('d32:g32');
		$this->excel->getActiveSheet()->mergeCells('d33:e33');
		$this->excel->getActiveSheet()->mergeCells('d34:e34');
		$this->excel->getActiveSheet()->mergeCells('d35:e35');
		$this->excel->getActiveSheet()->mergeCells('d36:e36');
		$this->excel->getActiveSheet()->mergeCells('d37:e37');
		$this->excel->getActiveSheet()->mergeCells('d38:e38');
		$this->excel->getActiveSheet()->mergeCells('d39:e39');
		$this->excel->getActiveSheet()->mergeCells('d40:e40');
		$this->excel->getActiveSheet()->mergeCells('e41:g41');
		$this->excel->getActiveSheet()->mergeCells('h33:h40');
		$this->excel->getActiveSheet()->mergeCells('c33:c41');
		$this->excel->getActiveSheet()->mergeCells('b42:g43');
		$this->excel->getActiveSheet()->getStyle('c31:h31')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c32:h32')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c33:h33')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c34:h34')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c35:h35')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c36:h36')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c37:h37')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c38:h38')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c39:h39')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c40:h40')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('d41:g41')->getBorders()->getbottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('c41')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('h41')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('b42:h43')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$this->excel->getActiveSheet()->getStyle('c33')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('f33:g41')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('d32')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('h31')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('h32')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('h41:h43')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('e41')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->getStyle('b13:b18')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('b19:b24')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('b25:b30')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('b31:b41')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('b13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$this->excel->getActiveSheet()->getStyle('b19')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$this->excel->getActiveSheet()->getStyle('b25')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$this->excel->getActiveSheet()->getStyle('b19')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$this->excel->getActiveSheet()->getStyle('b25')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$this->excel->getActiveSheet()->getStyle('b31')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$this->excel->getActiveSheet()->getStyle('b13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('b19')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('b25')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('b31')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('b42')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue('b44', '5.');
		$this->excel->getActiveSheet()->setCellValue('c44', 'KEBERATAN DARI PEGAWAI NEGERI');
		$this->excel->getActiveSheet()->setCellValue('c45', 'SIPIL YANG DINILAI (APABILA ADA)');
		$this->excel->getActiveSheet()->setCellValue('c55', 'Tanggal, ......................');
		$this->excel->getActiveSheet()->mergeCells('C44:d44');
		$this->excel->getActiveSheet()->mergeCells('C45:d45');
		$this->excel->getActiveSheet()->mergeCells('C55:h55');
		$this->excel->getActiveSheet()->getStyle('b44')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('c55')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('b44:b56')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('h44:h56')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('b56:h56')->getBorders()->getbottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$this->excel->getActiveSheet()->setCellValue('b57', '6.');
		$this->excel->getActiveSheet()->setCellValue('c57', 'TANGGAPAN PEJABAT PENILAI');
		$this->excel->getActiveSheet()->setCellValue('c58', 'ATAS KEBERATAN');
		$this->excel->getActiveSheet()->setCellValue('c67', 'Tanggal, ......................');
		$this->excel->getActiveSheet()->mergeCells('C57:d57');
		$this->excel->getActiveSheet()->mergeCells('C58:d58');
		$this->excel->getActiveSheet()->mergeCells('C67:h67');
		$this->excel->getActiveSheet()->getStyle('b57')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('c67')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('b56:b68')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('h56:h68')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('b68:h68')->getBorders()->getbottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$this->excel->getActiveSheet()->setCellValue('b69', '7.');
		$this->excel->getActiveSheet()->setCellValue('c69', 'KEPUTUSAN ATASAN PEJABAT');
		$this->excel->getActiveSheet()->setCellValue('c70', 'PENILAI ATAS KEBERATAN');
		$this->excel->getActiveSheet()->setCellValue('c79', 'Tanggal, ......................');
		$this->excel->getActiveSheet()->mergeCells('C69:d69');
		$this->excel->getActiveSheet()->mergeCells('C70:d70');
		$this->excel->getActiveSheet()->mergeCells('C79:h79');
		$this->excel->getActiveSheet()->getStyle('b69')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('c79')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('b69:b80')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('h69:h80')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('b80:h80')->getBorders()->getbottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$this->excel->getActiveSheet()->setCellValue('b81', '8.');
		$this->excel->getActiveSheet()->setCellValue('c81', 'REKOMENDASI');
		$this->excel->getActiveSheet()->mergeCells('C81:d81');
		$this->excel->getActiveSheet()->getStyle('b81')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('b81:b90')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('h81:h90')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('b90:h90')->getBorders()->getbottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$this->excel->getActiveSheet()->setCellValue('e92', '9. DIBUAT TANGGAL, ......................');
		$this->excel->getActiveSheet()->setCellValue('f93', 'PEJABAT PENILAI');
		$this->excel->getActiveSheet()->setCellValue('e99', strtoupper($data['atasan'][0]->nama_pegawai));
		$this->excel->getActiveSheet()->setCellValue('e100', "'".$data['atasan'][0]->nip);
		$this->excel->getActiveSheet()->mergeCells('e92:h92');
		$this->excel->getActiveSheet()->mergeCells('f93:h93');
		$this->excel->getActiveSheet()->mergeCells('e99:h99');
		$this->excel->getActiveSheet()->mergeCells('e100:h100');

		$this->excel->getActiveSheet()->setCellValue('b103', '10.');
		$this->excel->getActiveSheet()->setCellValue('c103', 'DITERIMA TANGGAL, ......................');
		$this->excel->getActiveSheet()->setCellValue('c104', 'PEGAWAI NEGERI SIPIL YANG DINILAI');
		$this->excel->getActiveSheet()->setCellValue('c110', strtoupper($data['infoPegawai'][0]->nama_pegawai));
		$this->excel->getActiveSheet()->setCellValue('c111', "'".$data['infoPegawai'][0]->nip);

		$this->excel->getActiveSheet()->setCellValue('e113', '11. DITERIMA TANGGAL, ......................');
		$this->excel->getActiveSheet()->setCellValue('f114', 'ATASAN PEJABAT PENILAI');
		$this->excel->getActiveSheet()->setCellValue('e120', strtoupper($data['atasan_penilai'][0]->nama_pegawai));
		$this->excel->getActiveSheet()->setCellValue('e121', "'".$data['atasan_penilai'][0]->nip);
		$this->excel->getActiveSheet()->mergeCells('e113:h113');
		$this->excel->getActiveSheet()->mergeCells('f114:h114');
		$this->excel->getActiveSheet()->mergeCells('e120:h120');
		$this->excel->getActiveSheet()->mergeCells('e121:h121');

		$this->excel->getActiveSheet()->getStyle('e99')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('e100')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('c110')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('c111')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('e120')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('e121')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('e99')->getFont()->setUnderline(true);
		$this->excel->getActiveSheet()->getStyle('c110')->getFont()->setUnderline(true);
		$this->excel->getActiveSheet()->getStyle('e99')->getFont()->setUnderline(true);
		$this->excel->getActiveSheet()->getStyle('e120')->getFont()->setUnderline(true);

		$this->excel->getActiveSheet()->getStyle('b91:b123')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('h91:h123')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('b123:h123')->getBorders()->getbottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

/*******************************************************************************************************************************************************/
		$this->excel->createSheet(1);
		$this->excel->setActiveSheetIndex(1)->setTitle('PENILAIAN CAPAIAN SKP');

		$this->excel->getActiveSheet(1)->getColumnDimension('b')->setWidth('5');
		$this->excel->getActiveSheet(1)->getColumnDimension('c')->setWidth('55');
		$this->excel->getActiveSheet(1)->getColumnDimension('d')->setWidth('6');
		$this->excel->getActiveSheet(1)->getColumnDimension('e')->setWidth('15');
		$this->excel->getActiveSheet(1)->getColumnDimension('f')->setWidth('10');
		$this->excel->getActiveSheet(1)->getColumnDimension('g')->setWidth('12');
		$this->excel->getActiveSheet(1)->getColumnDimension('h')->setWidth('15');

		$this->excel->getActiveSheet(1)->getColumnDimension('i')->setWidth('6');
		$this->excel->getActiveSheet(1)->getColumnDimension('j')->setWidth('15');
		$this->excel->getActiveSheet(1)->getColumnDimension('k')->setWidth('10');
		$this->excel->getActiveSheet(1)->getColumnDimension('l')->setWidth('12');
		$this->excel->getActiveSheet(1)->getColumnDimension('m')->setWidth('15');
		$this->excel->getActiveSheet(1)->getColumnDimension('n')->setWidth('17');
		$this->excel->getActiveSheet(1)->getColumnDimension('m')->setWidth('15');
		$this->excel->getActiveSheet(1)->getColumnDimension('o')->setWidth('15');

		$this->excel->getActiveSheet()->getStyle('b1:b9999')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

		$this->excel->getActiveSheet(1)->setCellValue('b6', 'PENILAIAN CAPAIAN SASARAN KERJA');
		$this->excel->getActiveSheet(1)->setCellValue('b7', 'PEGAWAI NEGERI SIPIL');
		$this->excel->getActiveSheet(1)->mergeCells('b6:o6');
		$this->excel->getActiveSheet(1)->mergeCells('b7:o7');
		$this->excel->getActiveSheet(1)->getStyle('b6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(1)->getStyle('b7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet(1)->setCellValue('b11', 'Jangka Waktu Penilaian 2 Januari s.d 31 Desember '.date('Y'));
		$this->excel->getActiveSheet(1)->setCellValue('b12', 'NO');
		$this->excel->getActiveSheet(1)->setCellValue('c12', 'KEGIATAN TUGAS JABATAN');
		$this->excel->getActiveSheet(1)->setCellValue('d12', 'AK');
		$this->excel->getActiveSheet(1)->setCellValue('e12', 'TARGET');
		$this->excel->getActiveSheet(1)->setCellValue('e13', 'Kuant/Output');
		$this->excel->getActiveSheet(1)->setCellValue('f13', 'Kual/Mutu');
		$this->excel->getActiveSheet(1)->setCellValue('g13', 'Waktu');
		$this->excel->getActiveSheet(1)->setCellValue('h13', 'Biaya');
		$this->excel->getActiveSheet(1)->setCellValue('i12', 'AK');
		$this->excel->getActiveSheet(1)->setCellValue('j12', 'REALISASI');
		$this->excel->getActiveSheet(1)->setCellValue('j13', 'Kuant/Output');
		$this->excel->getActiveSheet(1)->setCellValue('k13', 'Kual/Mutu');
		$this->excel->getActiveSheet(1)->setCellValue('l13', 'Waktu');
		$this->excel->getActiveSheet(1)->setCellValue('m13', 'Biaya');
		$this->excel->getActiveSheet(1)->setCellValue('n12', 'PENGHITUNGAN');
		$this->excel->getActiveSheet(1)->setCellValue('o12', 'NILAI CAPAIAN');

		$this->excel->getActiveSheet()->mergeCells('b11:c11');
		$this->excel->getActiveSheet()->mergeCells('b12:b13');
		$this->excel->getActiveSheet()->mergeCells('c12:c13');
		$this->excel->getActiveSheet()->mergeCells('d12:d13');
		$this->excel->getActiveSheet()->mergeCells('i12:i13');
		$this->excel->getActiveSheet()->mergeCells('n12:n13');
		$this->excel->getActiveSheet()->mergeCells('o12:o13');
		$this->excel->getActiveSheet()->mergeCells('e12:h12');
		$this->excel->getActiveSheet()->mergeCells('j12:m12');

		for ($i=1; $i <= 14; $i++) {
				# code...
				$this->excel->getActiveSheet(1)->setCellValue($this->Globalrules->data_alphabet($i).'14', $i);
				$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($i).'12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($i).'13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($i).'14')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($i).'12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($i).'13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($i).'14')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->getStyle($this->Globalrules->data_alphabet($i).'12')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$this->excel->getActiveSheet()->getStyle($this->Globalrules->data_alphabet($i).'13')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$this->excel->getActiveSheet()->getStyle($this->Globalrules->data_alphabet($i).'14')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		}

		if ($data['list_skp'] != 0) {
			# code...
			$counter = "";
			for ($i=0; $i < count($data['list_skp']); $i++) {
				# code...
						$counter                = 15 + $i;
						$kegiatan               = $data['list_skp'][$i]->kegiatan;

						if ($data['infoPegawai'][0]->kat_posisi == 1) {
							# code...
							if ($data['list_skp'][$i]->id_skp_master) $kegiatan=$data['list_skp'][$i]->kegiatan_skp;							
						}
						elseif ($data['infoPegawai'][0]->kat_posisi == 2) {
							# code...
							if ($data['list_skp'][$i]->id_skp_jft) $kegiatan=$data['list_skp'][$i]->kegiatan_skp_jft;							
						}						
						elseif ($data['infoPegawai'][0]->kat_posisi == 4) {
							# code...
							if ($data['list_skp'][$i]->id_skp_jfu) $kegiatan=$data['list_skp'][$i]->kegiatan_skp_jfu;							
						}

						$ak_target              = $data['list_skp'][$i]->AK_target;if ($data['list_skp'][$i]->AK_target == 0) $ak_target='-';
						$target_qty             = $data['list_skp'][$i]->target_qty;
						$target_kualitasmutu    = $data['list_skp'][$i]->target_kualitasmutu;
						$target_waktu_bln       = $data['list_skp'][$i]->target_waktu_bln;
						$target_biaya           = $data['list_skp'][$i]->target_biaya;if ($data['list_skp'][$i]->target_biaya == 0) $target_biaya='-';
						$realisasi_kuantitas    = $data['list_skp'][$i]->realisasi_kuantitas;
						$realisasi_kualitasmutu = $data['list_skp'][$i]->realisasi_kualitasmutu;
						$realisasi_biaya        = $data['list_skp'][$i]->realisasi_biaya;
						$realisasi_waktu        = $data['list_skp'][$i]->realisasi_waktu;

						$this->excel->getActiveSheet(1)->setCellValue('b'.$counter, $i+1);
						$this->excel->getActiveSheet(1)->setCellValue('c'.$counter, $kegiatan);
						$this->excel->getActiveSheet(1)->setCellValue('d'.$counter, $ak_target);
						$this->excel->getActiveSheet(1)->setCellValue('e'.$counter, $target_qty);
						$this->excel->getActiveSheet(1)->setCellValue('f'.$counter, $target_kualitasmutu);
						$this->excel->getActiveSheet(1)->setCellValue('g'.$counter, $target_waktu_bln." bulan");
						$this->excel->getActiveSheet(1)->setCellValue('h'.$counter, $target_biaya);
						$this->excel->getActiveSheet(1)->setCellValue('i'.$counter, $data['list_skp'][$i]->AK_realisasi);
						$this->excel->getActiveSheet(1)->setCellValue('j'.$counter, $realisasi_kuantitas);
						$this->excel->getActiveSheet(1)->setCellValue('k'.$counter, $realisasi_kualitasmutu);
						$this->excel->getActiveSheet(1)->setCellValue('l'.$counter, $realisasi_waktu." bulan");
						$this->excel->getActiveSheet(1)->setCellValue('m'.$counter, number_format($realisasi_biaya));
						$this->excel->getActiveSheet(1)->setCellValue('n'.$counter, $data['list_skp'][$i]->perhitungan['aspek']);
						$this->excel->getActiveSheet(1)->setCellValue('o'.$counter, number_format($data['list_skp'][$i]->perhitungan['nilai_capaian_skp'],2));

						for ($ii=1; $ii <= 14; $ii++) {
								# code...
								$iii = 2;$iv = 3;
								$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
								$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

								$this->excel->getActiveSheet(1)->getStyle('b'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$this->excel->getActiveSheet(1)->getStyle('c'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
								$this->excel->getActiveSheet(1)->getStyle('c'.$counter)->getAlignment()->setWrapText(true);
								$iii++;$iv++;
						}
			}

			if ($data['tr_tugas_tambahan'] != 0) {
					# code...
					$counter = $counter + 1;
					$break_1 = $counter;
					$this->excel->getActiveSheet(1)->setCellValue('c'.$counter, 'II. TUGAS TAMBAHAN DAN KREATIVITAS/UNSUR PENDUKUNG');
					$this->excel->getActiveSheet()->mergeCells('e'.$counter.':'.'o'.$counter);
					$counter = $counter + 1;
					$break_2 = $counter;
					$this->excel->getActiveSheet(1)->setCellValue('b'.$counter, '1');
					$this->excel->getActiveSheet(1)->setCellValue('c'.$counter, 'TUGAS TAMBAHAN');
					$this->excel->getActiveSheet()->mergeCells('e'.$counter.':'.'n'.$counter);
					$this->excel->getActiveSheet(1)->setCellValue('o'.$counter, $data['tugas_tambahan']);

					for ($i=0; $i < count($data['tr_tugas_tambahan']); $i++) {
							# code...
							$counter++;
							$this->excel->getActiveSheet(1)->setCellValue('b'.$counter, "1 . ".($i+1));
							$this->excel->getActiveSheet(1)->setCellValue('c'.$counter, $data['tr_tugas_tambahan'][$i]->keterangan);
							$this->excel->getActiveSheet(1)->setCellValue('j'.$counter, '1');
							$this->excel->getActiveSheet()->mergeCells('e'.$counter.':'.'h'.$counter);
							$this->excel->getActiveSheet()->mergeCells('j'.$counter.':'.'m'.$counter);
							for ($ii=1; $ii <= 14; $ii++) {
									# code...
									$iii = 2;$iv = 3;
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$break_1)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$break_2)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$break_1)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$break_2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$break_1)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$break_2)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

									$this->excel->getActiveSheet(1)->getStyle('b'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
									$this->excel->getActiveSheet(1)->getStyle('c'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
									$this->excel->getActiveSheet(1)->getStyle('c'.$counter)->getAlignment()->setWrapText(true);
									$iii++;$iv++;
							}
					}
			}

			if ($data['tr_kreativitas'] != 0) {
					# code...
					$counter = $counter + 1;
					$break_3 = $counter;
					$this->excel->getActiveSheet(1)->setCellValue('b'.$counter, '2');
					$this->excel->getActiveSheet(1)->setCellValue('c'.$counter, 'KREATIVITAS');
					$this->excel->getActiveSheet(1)->setCellValue('o'.$counter, $data['kreativitas']);
					$this->excel->getActiveSheet()->mergeCells('e'.$counter.':'.'n'.$counter);
					for ($i=0; $i < count($data['tr_kreativitas']); $i++) {
							# code...
							$counter++;
							$this->excel->getActiveSheet(1)->setCellValue('b'.$counter, "2 . ".($i+1));
							$this->excel->getActiveSheet(1)->setCellValue('c'.$counter, $data['tr_kreativitas'][$i]->keterangan);
							$this->excel->getActiveSheet(1)->setCellValue('j'.$counter, $data['tr_kreativitas'][$i]->nilai);
							$this->excel->getActiveSheet()->mergeCells('e'.$counter.':'.'h'.$counter);
							$this->excel->getActiveSheet()->mergeCells('j'.$counter.':'.'m'.$counter);
							for ($ii=1; $ii <= 14; $ii++) {
									# code...
									$iii = 2;$iv = 3;
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$break_3)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$break_3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$break_3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

									$this->excel->getActiveSheet(1)->getStyle('b'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
									$this->excel->getActiveSheet(1)->getStyle('c'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
									$this->excel->getActiveSheet(1)->getStyle('c'.$counter)->getAlignment()->setWrapText(true);
									$iii++;$iv++;
							}
					}
			}

			$counter   = $counter + 1;
			$counter_1 = $counter + 1;
			$this->excel->getActiveSheet()->mergeCells('b'.$counter.':'.'n'.$counter_1);
			$this->excel->getActiveSheet(1)->setCellValue('b'.$counter, 'NILAI CAPAIAN SKP');
			$this->excel->getActiveSheet(1)->setCellValue('o'.$counter, number_format($data['summary_skp_dan_prilaku'],2));
			$this->excel->getActiveSheet(1)->setCellValue('o'.$counter_1, $this->Globalrules->nilai_capaian_skp($total_realisasi_skp));
			$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet(1).$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet(1).$counter)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet(1)->getStyle('b'.$counter.':'.'n'.$counter_1)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet(14).$counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet(14).$counter_1)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet(14).$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet(14).$counter_1)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}

/*******************************************************************************************************************************************************/
		$this->excel->createSheet(2);
		$this->excel->setActiveSheetIndex(2)->setTitle('FORMULIR SKP');

		$this->excel->getActiveSheet(2)->getColumnDimension('b')->setWidth('5');
		$this->excel->getActiveSheet(2)->getColumnDimension('c')->setWidth('55');
		$this->excel->getActiveSheet(2)->getColumnDimension('d')->setWidth('6');
		$this->excel->getActiveSheet(2)->getColumnDimension('e')->setWidth('15');
		$this->excel->getActiveSheet(2)->getColumnDimension('f')->setWidth('10');
		$this->excel->getActiveSheet(2)->getColumnDimension('g')->setWidth('12');
		$this->excel->getActiveSheet(2)->getColumnDimension('h')->setWidth('15');

		$this->excel->getActiveSheet()->getStyle('b1:b9999')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
		$this->excel->getActiveSheet(2)->setCellValue('b6', 'FORMULIR SASARAN KERJA');
		$this->excel->getActiveSheet(2)->setCellValue('b7', 'PEGAWAI NEGERI SIPIL');
		$this->excel->getActiveSheet(2)->mergeCells('b6:h6');
		$this->excel->getActiveSheet(2)->mergeCells('b7:h7');
		$this->excel->getActiveSheet(2)->getStyle('b6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('b7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet(2)->setCellValue('b11', 'Jangka Waktu Penilaian 2 Januari s.d 31 Desember '.date('Y'));
		$this->excel->getActiveSheet(2)->setCellValue('b12', 'NO');
		$this->excel->getActiveSheet(2)->setCellValue('c12', 'KEGIATAN TUGAS JABATAN');
		$this->excel->getActiveSheet(2)->setCellValue('d12', 'AK');
		$this->excel->getActiveSheet(2)->setCellValue('e12', 'TARGET');
		$this->excel->getActiveSheet(2)->setCellValue('e13', 'Kuant/Output');
		$this->excel->getActiveSheet(2)->setCellValue('f13', 'Kual/Mutu');
		$this->excel->getActiveSheet(2)->setCellValue('g13', 'Waktu');
		$this->excel->getActiveSheet(2)->setCellValue('h13', 'Biaya');

		$this->excel->getActiveSheet()->mergeCells('b11:c11');
		$this->excel->getActiveSheet()->mergeCells('b12:b13');
		$this->excel->getActiveSheet()->mergeCells('c12:c13');
		$this->excel->getActiveSheet()->mergeCells('d12:d13');

		for ($i=1; $i <= 7; $i++) {
				# code...
				$this->excel->getActiveSheet(2)->setCellValue($this->Globalrules->data_alphabet($i).'14', $i);
				$this->excel->getActiveSheet(2)->getStyle($this->Globalrules->data_alphabet($i).'12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet(2)->getStyle($this->Globalrules->data_alphabet($i).'13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet(2)->getStyle($this->Globalrules->data_alphabet($i).'14')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet(2)->getStyle($this->Globalrules->data_alphabet($i).'12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet(2)->getStyle($this->Globalrules->data_alphabet($i).'13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet(2)->getStyle($this->Globalrules->data_alphabet($i).'14')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->getStyle($this->Globalrules->data_alphabet($i).'12')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$this->excel->getActiveSheet()->getStyle($this->Globalrules->data_alphabet($i).'13')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$this->excel->getActiveSheet()->getStyle($this->Globalrules->data_alphabet($i).'14')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		}

		if ($data['list_skp'] != 0) {
		    # code...
		    $counter = "";
		    for ($i=0; $i < count($data['list_skp']); $i++) {
		        # code...
						$counter                = 15 + $i;
						$kegiatan               = $data['list_skp'][$i]->kegiatan;
						if ($data['infoPegawai'][0]->kat_posisi == 1) {
							# code...
							if ($data['list_skp'][$i]->id_skp_master) $kegiatan=$data['list_skp'][$i]->kegiatan_skp;							
						}
						elseif ($data['infoPegawai'][0]->kat_posisi == 2) {
							# code...
							if ($data['list_skp'][$i]->id_skp_jft) $kegiatan=$data['list_skp'][$i]->kegiatan_skp_jft;							
						}						
						elseif ($data['infoPegawai'][0]->kat_posisi == 4) {
							# code...
							if ($data['list_skp'][$i]->id_skp_jfu) $kegiatan=$data['list_skp'][$i]->kegiatan_skp_jfu;							
						}
						
						$ak_target              = $data['list_skp'][$i]->AK_target;if ($data['list_skp'][$i]->AK_target == 0) $ak_target='-';
						$target_qty             = $data['list_skp'][$i]->target_qty;
						$target_kualitasmutu    = $data['list_skp'][$i]->target_kualitasmutu;
						$target_waktu_bln       = $data['list_skp'][$i]->target_waktu_bln;
						$target_biaya           = $data['list_skp'][$i]->target_biaya;if ($data['list_skp'][$i]->target_biaya == 0) $target_biaya='-';
						$realisasi_kuantitas    = $data['list_skp'][$i]->realisasi_kuantitas;
						$realisasi_kualitasmutu = $data['list_skp'][$i]->realisasi_kualitasmutu;
						$realisasi_biaya        = $data['list_skp'][$i]->realisasi_biaya;
						$realisasi_waktu        = $data['list_skp'][$i]->realisasi_waktu;

						$this->excel->getActiveSheet(2)->setCellValue('b'.$counter, $i+1);
						$this->excel->getActiveSheet(2)->setCellValue('c'.$counter, $kegiatan);
						$this->excel->getActiveSheet(2)->setCellValue('d'.$counter, $ak_target);
						$this->excel->getActiveSheet(2)->setCellValue('e'.$counter, $target_qty);
						$this->excel->getActiveSheet(2)->setCellValue('f'.$counter, $target_kualitasmutu);
						$this->excel->getActiveSheet(2)->setCellValue('g'.$counter, $target_waktu_bln." bulan");
						$this->excel->getActiveSheet(2)->setCellValue('h'.$counter, $target_biaya);

						for ($ii=1; $ii <= 7; $ii++) {
								# code...
								$iii = 2;$iv = 3;
								$this->excel->getActiveSheet(2)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
								$this->excel->getActiveSheet(2)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$this->excel->getActiveSheet(2)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

								$this->excel->getActiveSheet(2)->getStyle('b'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								$this->excel->getActiveSheet(2)->getStyle('c'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
								$this->excel->getActiveSheet(2)->getStyle('c'.$counter)->getAlignment()->setWrapText(true);
								$iii++;$iv++;
						}

		    }

		}

		ob_clean();
		$filename='PENILAIAN CAPAIAN SKP  - '.date("Y").'.xlsx'; //save our workbook as this file name
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
}
