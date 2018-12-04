<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_eselon1 extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
	
	public function index()
	{
		$this->Globalrules->session_rule();						
		$data['title']      = '<b>Struktur Organisasi</b> <i class="fa fa-angle-double-right"></i> Data Eselon 1';
		$data['content']    = 'master/eselon/data_eselon1';
		$data['list']       = $this->Allcrud->listData('mr_eselon1');
		$data['list_final'] = $this->Globalrules->counter_datatable($data['list'],'mr_eselon2','id_es1','id_es1','counter_data');
		$this->load->view('templateAdmin',$data);
	}

	public function addEselon1(){
		$this->Globalrules->session_rule();						
		$add         = array('nama_eselon1' =>$this->input->post('es1'));
		$res_data    = $this->Allcrud->addData('mr_eselon1',$add);
		$text_status = $this->Globalrules->check_status_res($res_data,'Data Eselon 1 telah berhasil ditambahkan.');
		$res         = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);				
	}

	public function ajaxEselon1(){
		$data['list']       = $this->Allcrud->listData('mr_eselon1');
		$data['list_final'] = $this->Globalrules->counter_datatable($data['list'],'mr_eselon2','id_es1','id_es1','counter_data');
		$this->load->view('master/eselon/ajaxEselon1',$data);
	}		

	public function editEselon1($id){
		$this->Globalrules->session_rule();						
		$flag = array('id_es1'=>$id);
		$q    = $this->Allcrud->getData('mr_eselon1',$flag)->row();
		echo json_encode($q);
	}	

	public function peditEselon1(){
		$this->Globalrules->session_rule();						
		$flag        = array('id_es1'=>$this->input->post('oid'));
		$edit        = array('nama_eselon1' =>$this->input->post('nes1'));
		$res_data    = $this->Allcrud->editData('mr_eselon1',$edit,$flag);
		$text_status = $this->Globalrules->check_status_res($res_data,'Data Eselon 1 telah berhasil diubah.');
		$res         = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);						
	}

	public function delEselon1($id){
		$this->Globalrules->session_rule();						
		$flag        = array('id_es1' => $id);
		$res_data    = $this->Allcrud->delData('mr_eselon1',$flag);
		$text_status = $this->Globalrules->check_status_res($res_data,'Data Eselon 1 telah berhasil dihapus.');
		$res         = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}	
}