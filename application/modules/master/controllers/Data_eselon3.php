<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_eselon3 extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
	
	public function index()
	{
		$this->Allcrud->session_rule();						
		$data['title']   = '<b>Struktur Organisasi</b> <i class="fa fa-angle-double-right"></i> Data Eselon 3';
		$data['content'] = 'master/eselon/data_eselon3';
		$data['es1']     = $this->Allcrud->listData('mr_eselon1');
		$data['es2']     = $this->Allcrud->listData('mr_eselon2');		
		$data['list']    = $this->Mmaster->eselon3();
		$this->load->view('templateAdmin',$data);
	}

	public function ajaxEselon3(){
		$this->Allcrud->session_rule();							
		$data['list'] = $this->Mmaster->eselon3();
		$this->load->view('master/eselon/ajaxEselon3',$data);
	}

	public function addEselon3(){
		$this->Allcrud->session_rule();								
		$add = array(
			'id_es2'       => $this->input->post('es2'),
			'nama_eselon3' =>$this->input->post('es3')
		);
		$this->Allcrud->addData('mr_eselon3',$add);
	}

	public function editEselon3($id){
		$this->Allcrud->session_rule();							
		$flag = array('id_es3'=>$id);
		$q    = $this->Mmaster->getEs3($flag)->row();
		echo json_encode($q);
	}

	public function peditEselon3(){
		$this->Allcrud->session_rule();								
		$flag = array('id_es3'=>$this->input->post('oid'));
		$edit = array(
			'id_es2'       => $this->input->post('nes2'),
			'nama_eselon3' =>$this->input->post('nes3')
		);
		$this->Allcrud->editData('mr_eselon3',$edit,$flag);
	}

	public function delEselon3($id){
		$this->Allcrud->session_rule();								
		$flag = array('id_es3' => $id);
		$this->Allcrud->delData('mr_eselon3',$flag);
	}

	public function cariEs3(){
		$this->Allcrud->session_rule();								
		$flag        = array('id_es2'=>$this->input->post('es2'));
		$data['es3'] = $this->Allcrud->getData('mr_eselon3',$flag);
		$this->load->view('master/eselon/ajax/eselon3',$data);
	}

	public function cariEs3_filter($param=NULL,$param1=NULL)
	{
		# code...
		$this->Allcrud->session_rule();								
		$flag                    = array('id_es2'=>$this->input->post('select_eselon_2'));
		$data['select_eselon_3'] = $this->Allcrud->getData('mr_eselon3',$flag);
		$data['param']           = $param;
		$data['param1']          = $param1;					
		$this->load->view('master/eselon/ajax/eselon3filter',$data);				
	}				

	public function formEselon3(){
		$this->Allcrud->session_rule();								
		$flag = array('id_es2'=>$this->input->post('nes2'));
		$data['es3']= $this->Allcrud->getData('mr_eselon3',$flag);
		$this->load->view('master/pegawai/eselon3',$data);
	}	
}