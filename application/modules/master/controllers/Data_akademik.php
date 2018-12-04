<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_akademik extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
	
	public function index()
	{
		$this->Globalrules->session_rule();						
		$data['title']   = ' Data Akademik';
		$data['content'] = 'master/akademik/data_akademik';
		$data['list']    = $this->Allcrud->listData('mr_pendidikan');
		$this->load->view('templateAdmin',$data);
	}

	public function add_akademik()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$data        = array
				(
					'kode'            => $data_sender['kode'],
					'nama_pendidikan' => $data_sender['nama_pendidikan']
				);
		$res_data = $this->Allcrud->addData('mr_pendidikan',$data);
		$text_status = $this->Globalrules->check_status_res($res_data,'Data Akademik telah ditambahan.');
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}

	public function editAkademik($id)
	{
		# code...
		$q = $this->Allcrud->getData('mr_pendidikan',array('id_pendidikan'=>$id))->result_array();
		echo json_encode($q);
	}

	public function peditAkademik()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$data        = array
					(
						'kode'            => $data_sender['kode'],
						'nama_pendidikan' => $data_sender['nama_pendidikan']
					);
		$res_data    = $this->Allcrud->editData('mr_pendidikan',$data,array('id_pendidikan'=>$data_sender['id_pendidikan']));
		$text_status = $this->Globalrules->check_status_res($res_data,'Data Akademik telah diubah.');
		$res         = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}

	public function del_akademik($id)
	{
		# code...
		$res_data    = $this->Allcrud->delData('mr_pendidikan',array('id_pendidikan'=>$id));
		$text_status = $this->Globalrules->check_status_res($res_data,'Data Akademik dihapus.');
		$res         = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}
}