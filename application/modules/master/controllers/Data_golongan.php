<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_golongan extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
	
	public function index()
	{
		$this->Globalrules->session_rule();								
		$data['title']   = 'Golongan PNS';
		$data['content'] = 'master/golongan/data_golongan';
		$data['list']    = $this->Allcrud->listData('mr_golongan');
		$this->load->view('templateAdmin',$data);
	}

	//By Eric
	//Last Edited : 26-02-2019
	public function store($arg=NULL,$oid=NULL)
	{
		# code...
		$res_data    = 0;
		$text_status = '';
		$data_sender = array();
		if ($arg == NULL) {
			# code...
			$data_sender = $this->input->post('data_sender');
		}
		else {
			# code...
			$data_sender['crud'] = $arg;
			$data_sender['oid']  = $oid;
		}
		
		// $data_store        = $this->Globalrules->trigger_insert_update($data_sender['crud']);
		if ($data_sender['crud'] == 'insert') {
			# code...
			$data_store['golongan'] 	= $data_sender['golongan'];
			$data_store['ruang'] 		= $data_sender['ruang'];
			$data_store['nama_pangkat'] = $data_sender['nama_pangkat'];
			            $res_data       = $this->Allcrud->addData('mr_golongan',$data_store);
			            $text_status    = $this->Globalrules->check_status_res($res_data,'Data Golongan telah berhasil ditambahkan.');
		} elseif ($data_sender['crud'] == 'update') {
			# code...			
			$data_store['golongan'] 	= $data_sender['golongan'];
			$data_store['ruang'] 		= $data_sender['ruang'];
			$data_store['nama_pangkat'] = $data_sender['nama_pangkat'];
			            $res_data       = $this->Allcrud->editData('mr_golongan',$data_store,array('id'=>$data_sender['oid']));
			            $text_status    = $this->Globalrules->check_status_res($res_data,'Data Golongan telah berhasil diubah.');
		} elseif ($data_sender['crud'] == 'delete') {
			# code...
			$res_data    = $this->Allcrud->delData('mr_golongan',array('id'=>$data_sender['oid']));
			$text_status = $this->Globalrules->check_status_res($res_data,'Data Golongan telah berhasil dihapus.');
		}

		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}

	//By Eric
	//Last Edited : 26-02-2019
	public function get_data_golongan($id){
		$this->Globalrules->session_rule();						
		$flag = array('id'=>$id);
		$q    = $this->Allcrud->getData('mr_golongan',$flag)->row();
		echo json_encode($q);
	}

	public function addGolongan()
	{
		$this->Globalrules->session_rule();					
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
		$this->Globalrules->session_rule();								
		$data['list'] = $this->Allcrud->listData('mr_golongan');
		$this->load->view('master/golongan/ajaxGolongan',$data);
	}		

	public function edit_golongan($id){
		$this->Globalrules->session_rule();						
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
		$this->Globalrules->session_rule();						
		$flag = array('id' => $id);
		$this->Allcrud->delData('mr_golongan',$flag);
	}					
}