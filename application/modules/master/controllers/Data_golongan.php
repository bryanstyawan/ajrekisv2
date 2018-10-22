<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_golongan extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
	
	public function index()
	{
		$this->Allcrud->session_rule();								
		$data['title']   = 'Golongan PNS';
		$data['content'] = 'master/golongan/data_golongan';
		$data['list']    = $this->Allcrud->listData('mr_golongan');
		$this->load->view('templateAdmin',$data);
	}

	public function addGolongan()
	{
		$this->Allcrud->session_rule();					
		$data_sender = $this->input->post('data_sender');
		$add = array
		(
			'golongan'     => $data_sender['golongan'],
			'ruang'        => $data_sender['ruang'],
			'nama_pangkat' => $data_sender['nama_pangkat']
		);
		$this->Allcrud->addData('mr_golongan',$add);		
	}	

	public function ajaxGolongan(){
		$this->Allcrud->session_rule();								
		$data['list'] = $this->Allcrud->listData('mr_golongan');
		$this->load->view('master/golongan/ajaxGolongan',$data);
	}		

	public function edit_golongan($id){
		$this->Allcrud->session_rule();						
		$flag = array('id'=>$id);
		$q    = $this->Allcrud->getData('mr_golongan',$flag)->row();
		echo json_encode($q);
	}	

	public function peditgolongan(){
		$flag = array('id'=>$this->input->post('oid'));
		$edit = array
		(
			'golongan'     => $this->input->post('edit_golongan'),
			'ruang'        => $this->input->post('edit_ruang'),
			'nama_pangkat' => $this->input->post('edit_nama_pangkat')
		);
		$this->Allcrud->editData('mr_golongan',$edit,$flag);
	}

	public function delgolongan($id){
		$this->Allcrud->session_rule();						
		$flag = array('id' => $id);
		$this->Allcrud->delData('mr_golongan',$flag);
	}					
}