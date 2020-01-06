<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/PHPExcel.php";
class Target_skp extends CI_Controller {

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
		$this->syncronice_skp($this->session->userdata('sesUser'),$this->session->userdata('sesPosisi'),2019);
		$data['title']       = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Target SKP';
		$data['subtitle']    = '';
		$data['list']        = $this->mskp->get_data_skp_pegawai($this->session->userdata('sesUser'),$this->session->userdata('sesPosisi'),date('Y'),'10');
		$data['info_posisi'] = $this->Allcrud->getData('mr_posisi',array('id' => $this->session->userdata('sesPosisi')))->result_array();
		$data['content']     = 'skp/skp_pegawai';
		$data['who_is']      = $this->Globalrules->who_is($this->session->userdata('sesUser'));
		$data['satuan']      = $this->Allcrud->listData('mr_skp_satuan');
		$data['jenis']       = $this->Allcrud->listData('mr_skp_jenis');
		$this->load->view('templateAdmin',$data);
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


}
  