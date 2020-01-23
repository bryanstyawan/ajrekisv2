<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/PHPExcel.php";
class Target_skp_approval extends CI_Controller {

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

	public function data($year_system=NULL)
	{
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$year_system              = ($year_system == NULL) ? 2019 : $year_system;
		$data['title']            = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Approval Target SKP Anggota Tim';
		$data['subtitle']         = '';
		$data['bawahan']          = $this->Globalrules->list_bawahan($this->session->userdata('sesPosisi'));
		$data['satuan']           = $this->Allcrud->listData('mr_skp_satuan');
		$data['content']          = 'skp/skp_approval_target';
		$data['member']           = $this->mskp->get_member($this->session->userdata('sesPosisi'));
		$data['id_posisi_atasan'] = $this->session->userdata('sesPosisi');
		if ($data['member'] != 0) {
			// code...
			for ($i=0; $i < count($data['member']); $i++) {
				// code...
				$get_data              = $this->Allcrud->getData('mr_skp_pegawai',array('status'=>0,'id_pegawai'=>$data['member'][$i]->id,'id_posisi'=>$data['member'][$i]->posisi,'tahun'=>date('Y')))->num_rows();
				$get_data_temp         = $this->Allcrud->getData('mr_skp_pegawai_temp',array('edit_status'=>3,'edit_id_pegawai'=>$data['member'][$i]->id,'edit_tahun'=>date('Y')))->num_rows();								
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

}
  