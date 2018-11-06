<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_eselon4 extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
	
	public function index()
	{
		$this->Allcrud->session_rule();								
		$data['title']      = '<b>Struktur Organisasi</b> <i class="fa fa-angle-double-right"></i> Data Eselon 4';
		$data['content']    = 'master/eselon/data_eselon4';
		$data['es1']        = $this->Allcrud->listData('mr_eselon1');
		$data['es2']        = $this->Allcrud->listData('mr_eselon2');
		$data['es3']        = $this->Allcrud->listData('mr_eselon3');
		$data['list']       = $this->Mmaster->eselon4();
		$data['list_final'] = $this->Globalrules->counter_datatable($data['list'],'mr_pegawai','id_es4','es4','counter_data');		
		$this->load->view('templateAdmin',$data);
	}

	public function cariEs4(){
		$this->Allcrud->session_rule();							
		$flag        = array('id_es3'=>$this->input->post('es3'));
		$data['es4'] = $this->Allcrud->getData('mr_eselon4',$flag);
		$this->load->view('master/eselon/ajax/eselon4',$data);
	}

	public function addEselon4(){
		$this->Allcrud->session_rule();								
		$add = array(
			'id_es3'       => $this->input->post('es3'),
			'nama_eselon4' =>$this->input->post('es4')
		);
		$this->Allcrud->addData('mr_eselon4',$add);
	}
	
	public function editEselon4($id){
		$this->Allcrud->session_rule();							
		$flag = array('id_es4'=>$id);
		$q    = $this->Mmaster->getEs4($flag)->row();
		echo json_encode($q);
	}

	public function peditEselon4(){
		$this->Allcrud->session_rule();							
		$flag = array('id_es4'=>$this->input->post('oid'));
		$edit = array(
			'id_es3'       => $this->input->post('nes3'),
			'nama_eselon4' =>$this->input->post('nes4')
		);
		$this->Allcrud->editData('mr_eselon4',$edit,$flag);
	}

	public function delEselon4($id){
		$this->Allcrud->session_rule();							
		$flag = array('id_es4' => $id);
		$this->Allcrud->delData('mr_eselon4',$flag);
	}	

	public function ajaxEselon4(){
		$this->Allcrud->session_rule();								
		$data['list']       = $this->Mmaster->eselon4();
		$data['list_final'] = $this->Globalrules->counter_datatable($data['list'],'mr_pegawai','id_es4','es4','counter_data');
		$this->load->view('master/eselon/ajaxEselon4',$data);
	}	

	public function cariEs4_filter($param=NULL,$param1=NULL)
	{
		# code...
		$this->Allcrud->session_rule();								
		$flag                    = array('id_es3'=>$this->input->post('select_eselon_3'));
		$data['select_eselon_4'] = $this->Allcrud->getData('mr_eselon4',$flag);
		$data['param']           = $param;		
		$data['param1']           = $param1;				
		$this->load->view('master/eselon/ajax/eselon4filter',$data);				
	}

	public function formEselon4(){
		$this->Allcrud->session_rule();							
		$flag = array('id_es3'=>$this->input->post('nes3'));
		$data['es4']= $this->Allcrud->getData('mr_eselon4',$flag);
		$this->load->view('master/pegawai/eselon4',$data);
	}			
}