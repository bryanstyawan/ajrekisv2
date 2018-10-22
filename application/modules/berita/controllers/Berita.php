<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('mberita', '', TRUE);
	}
	
	public function index()
	{
		if(!$this->session->userdata('login')){
			redirect('admin/loginadmin');
		}
		$this->Allcrud->notif_message();		
		redirect('dashboard/home');
	}

	public function home()
	{
		if(!$this->session->userdata('login')){
			redirect('admin/loginadmin');
		}
		$this->Allcrud->notif_message();		
		$data['title']	= 'berita';
		$data['content']= 'berita/data_berita';
		$data['list']	= $this->Allcrud->listdata('berita');
		$this->load->view('templateAdmin',$data);
	}

/*
write by Bryan Setyawan
last edited : 21/06/2-16
*/
	public function addberita()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
//		print_r($data_sender);die();		
		$this->Allcrud->addData('berita',$data_sender);
	}

	public function delberita($id)
	{
		$flag = array('id_berita' => $id);
		$this->Allcrud->delData('berita',$flag);		
	}

/*
write by Bryan Setyawan
last edited : 22/06/2-16
*/
	public function editberita($id){
		$flag = array('id_berita'=>$id);
		$q = $this->Allcrud->getData('berita',$flag)->row();
		echo json_encode($q);
	}	

/*
write by Bryan Setyawan
last edited : 22/06/2-16
*/
	public function peditberita(){
		$data_sender = $this->input->post('data_sender');
//		print_r($data_sender);die();
		$flag = array('id_user'=>$this->input->post('oid'));
		$edit = array(
			'nama'    => $this->input->post('nnama'),
			'email'   => $this->input->post('nemail'),
			'no_hp'   => $this->input->post('nhp'),
			'id_role' => $this->input->post('nrole')
		);
		$this->Allcrud->editData('user',$edit,$flag);
	}			
}
