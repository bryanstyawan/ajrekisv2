<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_kat_posisi extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
	
	public function index()
	{
		$this->Globalrules->session_rule();							
		$this->Globalrules->user_access_read();		
		$data['title']   = 'Kategori Posisi';
		$data['content'] = 'master/kat_posisi/data_kat_posisi';
		$data['list']    = $this->Allcrud->listData('mr_kat_posisi');
		$this->load->view('templateAdmin',$data);
	}

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
			$data_store['nama_kat_posisi'] = $data_sender['kat'];
			            $res_data       = $this->Allcrud->addData('mr_kat_posisi',$data_store);
			            $text_status    = $this->Globalrules->check_status_res($res_data,'Data Kategori Posisi telah berhasil ditambahkan.');
		} elseif ($data_sender['crud'] == 'update') {
			# code...			
			$data_store['nama_kat_posisi'] = $data_sender['kat'];
			            $res_data       = $this->Allcrud->editData('mr_kat_posisi',$data_store,array('id'=>$data_sender['oid']));
			            $text_status    = $this->Globalrules->check_status_res($res_data,'Data Kategori Posisi telah berhasil diubah.');
		} elseif ($data_sender['crud'] == 'delete') {
			# code...
			$res_data    = $this->Allcrud->delData('mr_kat_posisi',array('id'=>$data_sender['oid']));
			$text_status = $this->Globalrules->check_status_res($res_data,'Data Kategori Posisi telah berhasil dihapus.');
		}

		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}

	public function get_data_kat_posisi($id){
		$this->Globalrules->session_rule();						
		$flag = array('id'=>$id);
		$q    = $this->Allcrud->getData('mr_kat_posisi',$flag)->row();
		echo json_encode($q);
	}		

	public function generate($id){
		$this->Globalrules->session_rule();							
		$grade = $this->Allcrud->listData('mr_posisi_class');
		foreach ($grade->result() as $row){
			$cari = $this->Allcrud->getData('mr_grade_range',array('kat_posisi'=>$id,'posisi_grade'=>$row->posisi_class))->num_rows();
			if ($cari == 0){
				$add = array ('kat_posisi' => $id,'posisi_grade' =>$row->posisi_class);
				$this->Allcrud->addData('mr_grade_range',$add);
			}
		}
	}

	// tentatif, kedepan ini akan dihapus
	public function addKat_posisi(){
		$this->Globalrules->session_rule();						
		$add = array(
			'nama_kat_posisi' => strtoupper($this->input->post('kat'))
		);
		$this->Allcrud->addData('mr_kat_posisi',$add);
	}

	public function ajaxKat_posisi(){
		$this->Globalrules->session_rule();							
		$data['list'] = $this->Allcrud->listData('mr_kat_posisi');
		$this->load->view('master/kat_posisi/ajaxKat_posisi',$data);
	}

	public function editKat_posisi($id){
		$this->Globalrules->session_rule();								
		$flag = array('id'=>$id);
		$q    = $this->Allcrud->getData('mr_kat_posisi',$flag)->row();
		echo json_encode($q);
	}
	
	public function peditKat_posisi(){
		$this->Globalrules->session_rule();							
		$flag = array('id'=>$this->input->post('oid'));
		$edit = array(
			'nama_kat_posisi' => strtoupper($this->input->post('nkat_posisi'))
		);
		$this->Allcrud->editData('mr_kat_posisi',$edit,$flag);
	}	

	public function delKat_posisi($id){
		$this->Globalrules->session_rule();							
		$flag = array('id' => $id);
		$this->Allcrud->delData('mr_kat_posisi',$flag);
	}

			
}