<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_kat_posisi extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
	
	public function index()
	{
		$this->Allcrud->session_rule();							
		$data['title']   = 'Kategori Posisi';
		$data['content'] = 'master/kat_posisi/data_kat_posisi';
		$data['list']    = $this->Allcrud->listData('mr_kat_posisi');
		$this->load->view('templateAdmin',$data);
	}

	public function addKat_posisi(){
		$this->Allcrud->session_rule();						
		$add = array(
			'nama_kat_posisi' => strtoupper($this->input->post('kat'))
		);
		$this->Allcrud->addData('mr_kat_posisi',$add);
	}

	public function ajaxKat_posisi(){
		$this->Allcrud->session_rule();							
		$data['list'] = $this->Allcrud->listData('mr_kat_posisi');
		$this->load->view('master/kat_posisi/ajaxKat_posisi',$data);
	}

	public function editKat_posisi($id){
		$this->Allcrud->session_rule();								
		$flag = array('id'=>$id);
		$q    = $this->Allcrud->getData('mr_kat_posisi',$flag)->row();
		echo json_encode($q);
	}
	
	public function peditKat_posisi(){
		$this->Allcrud->session_rule();							
		$flag = array('id'=>$this->input->post('oid'));
		$edit = array(
			'nama_kat_posisi' => strtoupper($this->input->post('nkat_posisi'))
		);
		$this->Allcrud->editData('mr_kat_posisi',$edit,$flag);
	}	

	public function delKat_posisi($id){
		$this->Allcrud->session_rule();							
		$flag = array('id' => $id);
		$this->Allcrud->delData('mr_kat_posisi',$flag);
	}

	public function generate($id){
		$this->Allcrud->session_rule();							
		$grade = $this->Allcrud->listData('mr_posisi_class');
		foreach ($grade->result() as $row){
			$cari = $this->Allcrud->getData('mr_grade_range',array('kat_posisi'=>$id,'posisi_grade'=>$row->posisi_class))->num_rows();
			if ($cari == 0){
				$add = array ('kat_posisi' => $id,'posisi_grade' =>$row->posisi_class);
				$this->Allcrud->addData('mr_grade_range',$add);
			}
		}
	}		
}