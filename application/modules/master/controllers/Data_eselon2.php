<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_eselon2 extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
	
	public function index()
	{
		$this->Allcrud->session_rule();						
		$data['title']   = '<b>Struktur Organisasi</b> <i class="fa fa-angle-double-right"></i> Data Eselon 2';
		$data['content'] = 'master/eselon/data_eselon2';
		$data['es1']     = $this->Allcrud->listData('mr_eselon1');
		$data['list']    = $this->Mmaster->eselon2();
		$this->load->view('templateAdmin',$data);
	}

	public function addEselon2(){
		$this->Allcrud->session_rule();						
		$add = array(
			'id_es1'       => $this->input->post('es1'),
			'nama_eselon2' => $this->input->post('es2')
		);
		$this->Allcrud->addData('mr_eselon2',$add);
	}

	public function ajaxEselon2(){
		$this->Allcrud->session_rule();						
		$data['list'] = $this->Mmaster->eselon2();
		$this->load->view('master/eselon/ajaxEselon2',$data);
	}

	public function editEselon2($id){
		$this->Allcrud->session_rule();						
		$flag = array('id_es2'=>$id);
		$q    = $this->Allcrud->getData('mr_eselon2',$flag)->row();
		echo json_encode($q);
	}

	public function peditEselon2(){
		$this->Allcrud->session_rule();						
		$flag = array('id_es2'=>$this->input->post('oid'));
		$edit = array(
			'id_es1'       => $this->input->post('nes1'),
			'nama_eselon2' =>$this->input->post('nes2')
		);
		$this->Allcrud->editData('mr_eselon2',$edit,$flag);
	}

	public function delEselon2($id){
		$this->Allcrud->session_rule();						
		$flag = array('id_es2' => $id);
		$this->Allcrud->delData('mr_eselon2',$flag);
	}

	public function cariEs2(){
		$this->Allcrud->session_rule();						
		$flag        = array('id_es1'=>$this->input->post('es1'));
		$data['es2'] = $this->Allcrud->getData('mr_eselon2',$flag);
		$this->load->view('master/eselon/ajax/eselon2',$data);
	}	

	public function cariEs2edit(){
		$this->Allcrud->session_rule();						
		$flag         = array('id_es1'=>$this->input->post('nes1'));
		$data['nes2'] = $this->Allcrud->getData('mr_eselon2',$flag);
		$this->load->view('master/eselon/ajax/eselon2edit',$data);
	}

	public function cariEs2_filter($param=NULL,$param1=NULL)
	{
		# code...
		$this->Allcrud->session_rule();								
		$flag                    = array('id_es1'=>$this->input->post('select_eselon_1'));
		$data['select_eselon_2'] = $this->Allcrud->getData('mr_eselon2',$flag);
		$data['param']           = $param;
		$data['param1']          = $param1;		
		$this->load->view('master/eselon/ajax/eselon2filter',$data);		
	}						

	public function formEselon2(){
		$this->Allcrud->session_rule();								
		$flag = array('id_es1'=>$this->input->post('nes1'));
		$data['es2']= $this->Allcrud->getData('mr_eselon2',$flag);
		$this->load->view('master/pegawai/eselon2',$data);
	}	
}