<?php defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH."third_party\PHPExcel.php";
/*
Create by : Bryan Setyawan Putra
Date 	  : 01/07/2016
*/

class Statistik extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('mlaporan', '', TRUE);
		$this->load->model ('master/Mmaster', '', TRUE);
		$this->load->library('excel');
		$this->load->helper(array('url','form'));
		$this->load->library('image_lib');
		$this->load->library('upload');
	}


	public function get_statistik($oid)
	{
		# code...
		$data['belum_diperiksa']    = $this->Allcrud->getData('tr_capaian_pekerjaan',array('status_pekerjaan'=>0,'id_pegawai'=>$oid,'tanggal_selesai LIKE'=>date('Y-m').'%'))->num_rows();
		$data['disetujui']          = $this->Allcrud->getData('tr_capaian_pekerjaan',array('status_pekerjaan'=>1,'id_pegawai'=>$oid,'tanggal_selesai LIKE'=>date('Y-m').'%'))->num_rows();
		$data['tolak']              = $this->Allcrud->getData('tr_capaian_pekerjaan',array('status_pekerjaan'=>2,'id_pegawai'=>$oid,'tanggal_selesai LIKE'=>date('Y-m').'%'))->num_rows();
		$data['revisi']             = $this->Allcrud->getData('tr_capaian_pekerjaan',array('status_pekerjaan'=>3,'id_pegawai'=>$oid,'tanggal_selesai LIKE'=>date('Y-m').'%'))->num_rows();
		$data['infoPegawai']        = $this->Globalrules->get_info_pegawai($oid,'id');
		$data['info_kompetensi']    = $this->Allcrud->getData('mr_kompetensi',array('id_pegawai'=>$oid))->result_array();
		$data['skp']                = $this->Globalrules->data_summary_skp_pegawai($oid);
		$data['data_transaksi']     = $this->mlaporan->get_transact($oid,1,date('m'),date('Y'));
		$data['menit_efektif_year'] = $this->mlaporan->get_menit_efektif_year();
		$res = array
					(
						'status' => 1,
						'text'   => '',
						'data'   => $data
					);
		echo json_encode($res);		
	}
}
