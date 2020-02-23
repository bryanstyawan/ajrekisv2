<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/PHPExcel.php";
class Cetak_skp extends CI_Controller {

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

	public function data($id=NULL,$posisi=NULL,$year_system=NULL)
	{
		# code...
		$year_system = ($year_system == NULL) ? date('Y') : $year_system ;
		if($id != NULL)
		{
			if($posisi != NULL)
			{
				$this->Globalrules->session_rule();
				$this->Globalrules->notif_message();
				$data             = $this->Globalrules->data_summary_skp_pegawai($id,$posisi,$year_system);
				$data['who_is'] = $this->Globalrules->who_is($id);
				$data['year_pass']  = $year_system;
				$data['penilai']    = '';
				$data['id_pegawai'] = $id;
				$data['id_posisi']  = $posisi;
				$data['title']      = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Cetak SKP';
				$data['content']    = 'skp/cetak_history_skp';
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

	public function var_dump($id=NULL,$posisi=NULL,$year_system=NULL)
	{
		# code...
		$year_system = ($year_system == NULL) ? date('Y') : $year_system ;
		if($id != NULL)
		{
			if($posisi != NULL)
			{
				$this->Globalrules->session_rule();
				$this->Globalrules->notif_message();
				$data             = $this->Globalrules->data_summary_skp_pegawai($id,$posisi,$year_system);
				echo "<pre>";
				print_r($data);				
				echo "</pre>";
				die();
				$data['who_is'] = $this->Globalrules->who_is($id);
				$data['year_pass']  = $year_system;
				$data['penilai']    = '';
				$data['id_pegawai'] = $id;
				$data['id_posisi']  = $posisi;
				$data['title']      = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Cetak SKP';
				$data['content']    = 'skp/cetak_history_skp';
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
}
  