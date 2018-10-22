<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_struktur extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
	
	public function index()
	{
		$this->Allcrud->session_rule();								
		$data['title']        = 'Struktur Organisasi';
		$data['content']      = 'master/struktur/data_struktur';
		$data['es1']          = $this->Allcrud->listData('mr_eselon1');
		$data['es2']		  = $this->Allcrud->getData('mr_eselon2',array('id_es1'=>$this->session->userdata('sesEs1')));
		$data['class_posisi'] = $this->Mmaster->get_posisi_class();
		$data['katpos']       = $this->Allcrud->listData('mr_kat_posisi');
		$data_sender = array
						(
							'eselon1' => $this->session->userdata('sesEs1'), 
							'eselon2' => '', 
							'eselon3' => '', 
							'eselon4' => ''																					
						);			
		$data['list']         = $this->Mmaster->get_struktur_organisasi($data_sender);		
		$this->load->view('templateAdmin',$data);
	}

	public function addStruktur(){
		$this->Allcrud->session_rule();							
		$add = array(
			'eselon1' =>$this->input->post('es1'),
			'eselon2' =>$this->input->post('es2'),
			'eselon3' =>$this->input->post('es3'),
			'eselon4' =>$this->input->post('es4'),
			'atasan' =>$this->input->post('atasan'),
			'kat_posisi' =>$this->input->post('kat'),
			'posisi_class' =>$this->input->post('grade'),
			'nama_posisi' =>strtoupper($this->input->post('jabatan'))
		);
		$this->Allcrud->addData('mr_posisi',$add);
	}

	public function editStruktur($id){
		$this->Allcrud->session_rule();								
		$flag = array('id'=>$id);
		$data = $this->Mmaster->get_posisi_struktur($id);
		echo json_encode($data[0]);
	}

	public function peditStruktur(){
		$this->Allcrud->session_rule();							
		$flag = array('id'=>$this->input->post('oid'));
		$edit = array(
			'eselon1' =>$this->input->post('nes1'),
			'eselon2' =>$this->input->post('nes2'),
			'eselon3' =>$this->input->post('nes3'),
			'eselon4' =>$this->input->post('nes4'),
			'atasan' =>$this->input->post('natasan'),
			'posisi_class' =>$this->input->post('ngrade'),
			'kat_posisi' =>$this->input->post('nkat'),
			'nama_posisi' =>strtoupper($this->input->post('njabatan'))
		);
		$this->Allcrud->editData('mr_posisi',$edit,$flag);
	}

	public function delStruktur($id){
		$this->Allcrud->session_rule();							
		$flag = array('id' => $id);
		$this->Allcrud->delData('mr_posisi',$flag);
	}	

	public function ajaxStruktur($id=NULL){
		$this->Allcrud->session_rule();								
		$data['es1']= $this->Allcrud->listData('mr_eselon1');
		$data['katpos']= $this->Allcrud->listData('mr_kat_posisi');
		$data_sender = array
						(
							'eselon1' => $this->session->userdata('sesEs1'), 
							'eselon2' => '', 
							'eselon3' => '', 
							'eselon4' => ''																					
						);			
		$data['list']         = $this->Mmaster->get_struktur_organisasi($data_sender);
		$this->load->view('master/struktur/ajaxCariStruktur',$data);
	}	

}