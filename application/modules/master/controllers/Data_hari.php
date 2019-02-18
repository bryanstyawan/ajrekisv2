<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_hari extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}

	public function index()
	{
		$this->Globalrules->session_rule();
		$data['title']   = 'Data Hari Aktif';
		$data['content'] = 'master/aktif/data_aktif';
		$data['list']    = $this->Mmaster->activeDay();
		$data['bulan']   = $this->Mmaster->bulan();
		$this->load->view('templateAdmin',$data);
	}

	public function store($arg=NULL,$oid=NULL)
	{
		# code...
		$res_data    = 0;
		$text_status = '';
		$data_sender = array();
		if ($arg == NULL) {
			# code...
			$data_sender = $this->input->post('data_sender');
			$data_sender['tgl_awal_keberatan']  = date('Y-m-d', strtotime(str_replace('-','-',$data_sender['tgl_awal_keberatan'])));
			$data_sender['tgl_akhir_keberatan'] = date('Y-m-d', strtotime(str_replace('-','-',$data_sender['tgl_akhir_keberatan'])));
			$data_sender['tgl_awal_banding']    = date('Y-m-d', strtotime(str_replace('-','-',$data_sender['tgl_awal_banding'])));
			$data_sender['tgl_akhir_banding']   = date('Y-m-d', strtotime(str_replace('-','-',$data_sender['tgl_akhir_banding'])));
		}
		else {
			# code...
			$data_sender['crud'] = $arg;
			$data_sender['oid']  = $oid;
		}

		// $data_store        = $this->Globalrules->trigger_insert_update($data_sender['crud']);
		if ($data_sender['crud'] == 'insert') {
			# code...
			$get_data    = $this->Allcrud->getData('mr_hari_aktif',array('bulan'=>$data_sender['bulan'],'tahun'=>$data_sender['tahun']))->row();
			if ($get_data != '' || $get_data  != 0) {
				// code...
				$text_status = "Data hari aktif untuk bulan ".$data_sender['bulan']." Dan Tahun ".$data_sender['tahun']." Telah ada, Ditolak oleh sistem.";
				$res_data 	 = 0;
			}
			else 
			{
				$data_store = array(
					'bulan'               => $data_sender['bulan'],
					'tahun'               => $data_sender['tahun'],
					'jml_hari_aktif'      => $data_sender['hari'],
					'jml_menit_perhari'   => $data_sender['menit'],
					'tgl_awal_keberatan'  => $data_sender['tgl_awal_keberatan'],
					'tgl_akhir_keberatan' => $data_sender['tgl_akhir_keberatan'],
					'tgl_awal_banding'    => $data_sender['tgl_awal_banding'],
					'tgl_akhir_banding'   => $data_sender['tgl_akhir_banding']
				);
				$res_data    = $this->Allcrud->addData('mr_hari_aktif',$data_store);
				$text_status = $this->Globalrules->check_status_res($res_data,'Data hari aktif telah berhasil ditambahkan.');
			}			

		} elseif ($data_sender['crud'] == 'update') {
			# code...			
			$data_store['nama_eselon1'] = $data_sender['es1'];
			            $res_data       = $this->Allcrud->editData('mr_eselon1',$data_store,array('id_es1'=>$data_sender['oid']));
			            $text_status    = $this->Globalrules->check_status_res($res_data,'Data Eselon 1 telah berhasil diubah.');
		} elseif ($data_sender['crud'] == 'delete') {
			# code...
			$res_data    = $this->Allcrud->delData('mr_eselon1',array('id_es1'=>$data_sender['oid']));
			$text_status = $this->Globalrules->check_status_res($res_data,'Data Eselon 1 telah berhasil dihapus.');
		}

		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}

	public function addHari_aktif(){
		$this->Globalrules->session_rule();
		$text_status = "";
		$res_data    = "";
		$flag        = array('bulan'=>$this->input->post('bulan'),'tahun'=>$this->input->post('tahun'));
		$get_data    = $this->Allcrud->getData('mr_hari_aktif',$flag)->row();
		if ($get_data != '' || $get_data  != 0) {
			// code...
			$text_status = "Data hari aktif untuk bulan ".$this->input->post('bulan')." Dan Tahun ".$this->input->post('Tahun')." Telah ada, Ditolak oleh sistem.";
			$res_data 	 = 2;
		}
		else 
		{
			// code...

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
		$this->Globalrules->session_rule();
		$data['list'] = $this->Mmaster->activeDay();
		$this->load->view('master/aktif/ajaxAktif',$data);
	}

	public function editHari_aktif($id){
		$this->Globalrules->session_rule();
		$flag = array('id_hari'=>$id);
		$q    = $this->Allcrud->getData('mr_hari_aktif',$flag)->row();
		echo json_encode($q);
	}

	public function peditHari_aktif(){
		$this->Globalrules->session_rule();
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
		$this->Globalrules->session_rule();
		$flag = array('id_hari' => $id);
		$this->Allcrud->delData('mr_hari_aktif',$flag);
	}
}
