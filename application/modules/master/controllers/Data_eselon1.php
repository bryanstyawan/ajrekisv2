<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_eselon1 extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
	
	public function index()
	{
		$this->Allcrud->session_rule();						
		$data['title']   = '<b>Struktur Organisasi</b> <i class="fa fa-angle-double-right"></i> Data Eselon 1';
		$data['content'] = 'master/eselon/data_eselon1';
		$data['list']    = $this->Allcrud->listData('mr_eselon1');
		$this->load->view('templateAdmin',$data);
	}

	public function addEselon1(){
		$this->Allcrud->session_rule();						
		$add = array(
			'nama_eselon1' =>$this->input->post('es1')
		);
		$this->Allcrud->addData('mr_eselon1',$add);
	}

	public function ajaxEselon1(){
		$data['list'] = $this->Allcrud->listData('mr_eselon1');
		$this->load->view('master/eselon/ajaxEselon1',$data);
	}		

	public function editEselon1($id){
		$this->Allcrud->session_rule();						
		$flag = array('id_es1'=>$id);
		$q    = $this->Allcrud->getData('mr_eselon1',$flag)->row();
		echo json_encode($q);
	}	

	public function peditEselon1(){
		$this->Allcrud->session_rule();						
		$flag = array('id_es1'=>$this->input->post('oid'));
		$edit = array(
			'nama_eselon1' =>$this->input->post('nes1')
		);
		$this->Allcrud->editData('mr_eselon1',$edit,$flag);
	}

	public function delEselon1($id){
		$this->Allcrud->session_rule();						
		$flag = array('id_es1' => $id);
		$this->Allcrud->delData('mr_eselon1',$flag);
	}	
}