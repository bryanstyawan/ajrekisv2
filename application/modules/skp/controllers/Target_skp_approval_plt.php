<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/PHPExcel.php";
class Target_skp_approval_plt extends CI_Controller {

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

	public function data($year_system=NULL)
	{
		$year_system = ($year_system == NULL) ? 2020 : $year_system;
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
				$data['title']    = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Approval Target SKP Anggota Tim [PLT]';
				$data['subtitle'] = '';
				$data['bawahan']  = $this->Globalrules->list_bawahan($get_data_pegawai[0]['posisi_plt']);
				$data['satuan']   = $this->Allcrud->listData('mr_skp_satuan');
				$data['content']  = 'skp/skp_approval_target';
				$data['id_posisi_atasan'] = $get_data_pegawai[0]['posisi_plt'];				
				$data['member']   = $this->mskp->get_member($get_data_pegawai[0]['posisi_plt']);
				if ($data['member'] != 0) {
					// code...
					for ($i=0; $i < count($data['member']); $i++) {
						// code...
						$get_data              = $this->Allcrud->getData('mr_skp_pegawai',array('status'=>0,'id_pegawai'=>$data['member'][$i]->id,'id_posisi'=>$data['member'][$i]->posisi,'tahun'=>$this->year_system))->num_rows();
						$get_data_temp         = $this->Allcrud->getData('mr_skp_pegawai_temp',array('edit_status'=>3,'edit_id_pegawai'=>$data['member'][$i]->id,'edit_tahun'=>$this->year_system))->num_rows();								
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




}
  