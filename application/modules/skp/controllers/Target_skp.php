<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/PHPExcel.php";
class Target_skp extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('mskp', '', TRUE);
		$this->load->model ('transaksi/mtrx', '', TRUE);
		$this->load->model ('master/Mmaster', '', TRUE);
		date_default_timezone_set('Asia/Jakarta');
	}

	private $year_system = 2020;	

	public function data($year=NULL)
	{
		$year = ($year == NULL) ? $this->year_system : $year;
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		if (date('Y') == $this->year_system) {
			# code...
			$this->syncronice_skp($this->session->userdata('sesUser'),$this->session->userdata('sesPosisi'),$year);			
		}
		$data['title']       = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Target SKP '.$year;
		$data['content']     = 'skp/skp_pegawai';		
		$data['subtitle']    = '';
		$data['list']        = $this->mskp->get_data_skp_pegawai($this->session->userdata('sesUser'),$this->session->userdata('sesPosisi'),$year,'10');
		$data['info_posisi'] = $this->Allcrud->getData('mr_posisi',array('id' => $this->session->userdata('sesPosisi')))->result_array();
		$data['who_is']      = $this->Globalrules->who_is($this->session->userdata('sesUser'));
		$data['satuan']      = $this->Allcrud->listData('mr_skp_satuan');
		$data['jenis']       = $this->Allcrud->listData('mr_skp_jenis');
		$this->load->view('templateAdmin',$data);
	}	

	public function syncronice_skp($id_pegawai,$posisi,$tahun)
	{
		# code...
		$who_is      = $this->Globalrules->who_is($this->session->userdata('sesUser'));
		if ($who_is != 'eselon 2' && $who_is != 'eselon 1') {
			# code...
			$check_posisi = $this->Allcrud->getData('mr_posisi',array('id' => $posisi))->result_array();
			if ($check_posisi != array()) {
				# code...
				$kat_posisi = $check_posisi[0]['kat_posisi']; 
				$data_skp_period = $this->mskp->get_data_skp_pegawai($id_pegawai,$posisi,$tahun-1,'1','realisasi');				
				if ($data_skp_period != 0) {
					# code...
					if ($data_skp_period != 0) {
						# code...
						for ($i=0; $i < count($data_skp_period); $i++) {
							# code...
							$data = array(
								'id_pegawai'          => $id_pegawai,
								'id_posisi'           => $posisi,
								'tahun'               => $tahun,
								'id_skp_master'       => $data_skp_period[$i]->id_skp_master,
								'id_skp_jfu'	      => $data_skp_period[$i]->id_skp_jfu,
								'id_skp_jft'	      => $data_skp_period[$i]->id_skp_jft,
								'kegiatan'		      => $data_skp_period[$i]->kegiatan
							);
	
							$check_data = $this->Allcrud->getData('mr_skp_pegawai', $data)->result_array();		
							if ($check_data == array()) {
								# code...
								$data['PK']					  = $data_skp_period[$i]->PK;
								$data['status']               = 6;
								$data['jenis_skp']            = $data_skp_period[$i]->jenis_skp;
								$data['AK_target']            = $data_skp_period[$i]->AK_target;
								$data['target_qty']		      = $data_skp_period[$i]->realisasi_kuantitas; 
								$data['target_output']        = $data_skp_period[$i]->target_output; 
								$data['target_kualitasmutu']  = $data_skp_period[$i]->target_kualitasmutu;
								$data['target_waktu_bln']     = $data_skp_period[$i]->target_waktu_bln;
								$data['target_biaya']		    = $data_skp_period[$i]->target_biaya;							
								$res_data_id_friend = $this->Allcrud->addData_with_return_id('mr_skp_pegawai',$data);								
							}
						}
					}					
				}
				else
				{
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
										'tahun'          => $tahun,
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
											'tahun'          => $tahun,
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
											'tahun'          => $tahun,
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
										'tahun'          => $tahun,
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
		}

	}	

	public function edit_skp_pegawai()
	{
		# code...
		$year_system = $this->year_system;
		$data_sender = $this->input->post('data_sender');
		$res_data    = "";
		$text_status = "";

		$param_pk    = $this->parameter_pk($data_sender['pk']);

		$data = array(
			'edit_skp_id'              => $data_sender['id'],
			'edit_id_pegawai'          => $this->session->userdata('sesUser'),
			'edit_tahun'               => $year_system,
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
				'tahun'               => $year_system,
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

	public function ad_skp_pegawai_pk()
	{
		# code...
		$year_system = $this->year_system;
		$data_sender = $this->input->post('data_sender');
		$param_pk    = $this->parameter_pk(1);				
		$res_data    = "";
		$text_status = "";
		
		$data = array(
			'id_pegawai'          => $this->session->userdata('sesUser'),
			'id_posisi'           => $this->session->userdata('sesPosisi'),
			'tahun'               => $year_system,
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

	public function add_skp_pegawai()
	{
		# code...
		$this->Allcrud->session_rule();
		$data_sender = $this->input->post('data_sender');
		$res_data    = "";
		$param_pk    = "";
		$text_status = "";
		$year_system = $this->year_system;

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
				'tahun'               => $year_system,
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
							'tahun'               => $year_system,
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

	public function get_detail_skp($id)
	{
		# code...
		$res_data = $this->mskp->get_data_skp_pegawai_id($id);
		echo json_encode($res_data);
	}	

	public function deactive_skp($id)
	{
		# code...
		$flag        = array('skp_id'=>$id);		
		$res_data    = $this->Allcrud->editData('mr_skp_pegawai',array('status'=>0),array('skp_id'=>$id));		
		$text_status = $this->Globalrules->check_status_res($res_data,'SKP ini dihentikan.');
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}	
}
  