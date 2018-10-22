<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_hari extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}

	public function index()
	{
		$this->Allcrud->session_rule();
		$data['title']   = 'Data Hari Aktif';
		$data['content'] = 'master/aktif/data_aktif';
		$data['list']    = $this->Mmaster->activeDay();
		$data['bulan']   = $this->Mmaster->bulan();
		$this->load->view('templateAdmin',$data);
	}

	public function addHari_aktif(){
		$this->Allcrud->session_rule();
		$text_status 	= "";
		$res_data			= "";
		$flag 				= array('bulan'=>$this->input->post('bulan'),'tahun'=>$this->input->post('tahun'));
		$get_data    	= $this->Allcrud->getData('mr_hari_aktif',$flag)->row();
		if ($get_data != '' || $get_data  != 0) {
			// code...
			$text_status = "Data hari aktif untuk bulan ".$this->input->post('bulan')." Dan Tahun ".$this->input->post('Tahun')." Telah ada, Ditolak oleh sistem.";
			$res_data 	 = 2;
		}
		else {
			// code...
			$add = array(
				'bulan'               =>$this->input->post('bulan'),
				'tahun'               =>$this->input->post('tahun'),
				'jml_hari_aktif'      =>$this->input->post('hari'),
				'jml_menit_perhari'   =>$this->input->post('menit'),
				'tgl_awal_keberatan'  =>$this->input->post('tgl_awal_keberatan'),
				'tgl_akhir_keberatan' =>$this->input->post('tgl_akhir_keberatan'),
				'tgl_awal_banding'    =>$this->input->post('tgl_awal_banding'),
				'tgl_akhir_banding'   =>$this->input->post('tgl_akhir_banding')
			);
			$res_data			= $this->Allcrud->addData('mr_hari_aktif',$add);
			$text_status 	= "Data Berhasil Ditambahkan";
		}

		$text_status = $this->Globalrules->check_status_res($res_data,$text_status);
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function ajaxHari_aktif(){
		$this->Allcrud->session_rule();
		$data['list'] = $this->Mmaster->activeDay();
		$this->load->view('master/aktif/ajaxAktif',$data);
	}

	public function editHari_aktif($id){
		$this->Allcrud->session_rule();
		$flag = array('id_hari'=>$id);
		$q    = $this->Allcrud->getData('mr_hari_aktif',$flag)->row();
		echo json_encode($q);
	}

	public function peditHari_aktif(){
		$this->Allcrud->session_rule();
		$flag = array('id_hari'=>$this->input->post('oid'));
		$edit = array(
			'jml_hari_aktif'      =>$this->input->post('njmlhari'),
			'jml_menit_perhari'   =>$this->input->post('njmlmenit'),
			'tgl_awal_keberatan'  =>$this->input->post('ntgl_awal_keberatan'),
			'tgl_akhir_keberatan' =>$this->input->post('ntgl_akhir_keberatan'),
			'tgl_awal_banding'    =>$this->input->post('ntgl_awal_banding'),
			'tgl_akhir_banding'   =>$this->input->post('ntgl_akhir_banding')
		);
		$this->Allcrud->editData('mr_hari_aktif',$edit,$flag);
	}

	public function delHari_aktif($id){
		$this->Allcrud->session_rule();
		$flag = array('id_hari' => $id);
		$this->Allcrud->delData('mr_hari_aktif',$flag);
	}
}
