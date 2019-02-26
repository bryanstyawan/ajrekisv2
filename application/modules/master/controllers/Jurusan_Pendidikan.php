<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan_pendidikan extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
    
    //By Eric
	//Last Edited : 26-02-2019
    public function index()
    {
		$this->Globalrules->session_rule();
		$data['title']   = 'Jurusan Pendidikan';
		$data['content'] = 'master/jur_pendidikan/data_jur_pendidikan';
		$data['list']    = $this->Allcrud->listData('mr_jur_pendidikan');
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
			$data_store['kode'] 	            = $data_sender['kode'];
			$data_store['nama_jur_pendidikan'] 	= $data_sender['jurusan'];
			            $res_data               = $this->Allcrud->addData('mr_jur_pendidikan',$data_store);
			            $text_status            = $this->Globalrules->check_status_res($res_data,'Data Jurusan Pendidikan telah berhasil ditambahkan.');
		} elseif ($data_sender['crud'] == 'update') {
			# code...			
			$data_store['kode'] 	            = $data_sender['kode'];
			$data_store['nama_jur_pendidikan'] 	= $data_sender['jurusan'];
			            $res_data               = $this->Allcrud->editData('mr_jur_pendidikan',$data_store,array('id_jurusan'=>$data_sender['oid']));
			            $text_status            = $this->Globalrules->check_status_res($res_data,'Data Jurusan Pendidikan telah berhasil diubah.');
		} elseif ($data_sender['crud'] == 'delete') {
			# code...
			$res_data    = $this->Allcrud->delData('mr_jur_pendidikan',array('id_jurusan'=>$data_sender['oid']));
			$text_status = $this->Globalrules->check_status_res($res_data,'Data Jurusan Pendidikan telah berhasil dihapus.');
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
	public function get_data_jurusan($id){
		$this->Globalrules->session_rule();						
		$flag = array('id_jurusan'=>$id);
		$q    = $this->Allcrud->getData('mr_jur_pendidikan',$flag)->row();
		echo json_encode($q);
	}

	public function ajaxJurusan_pendidikan(){
		$this->Globalrules->session_rule();
		$data['list'] = $this->Allcrud->listData('mr_jur_pendidikan');
		$this->load->view('master/jur_pendidikan/ajaxJurusan_pendidikan',$data);
	}

	public function addJurusan_pendidikan(){
		$this->Globalrules->session_rule();
		$add = array(
			'kode'                => strtoupper($this->input->post('kode')),
			'nama_jur_pendidikan' => modif_kata($this->input->post('jur_pendidikan'))
		);
		$this->Allcrud->addData('mr_jur_pendidikan',$add);
	}

	public function editJurusan_pendidikan($id){
		$this->Globalrules->session_rule();
		$flag = array('id'=>$id);
		$q    = $this->Allcrud->getData('mr_jur_pendidikan',$flag)->row();
		echo json_encode($q);
	}

	public function peditJurusan_pendidikan(){
		$this->Globalrules->session_rule();
		$flag = array('id'=>$this->input->post('oid'));
		$edit = array(
			'kode'                => strtoupper($this->input->post('nkode')),
			'nama_jur_pendidikan' => modif_kata($this->input->post('njur_pendidikan'))
		);
		$this->Allcrud->editData('mr_jur_pendidikan',$edit,$flag);
	}

	public function delJurusan_pendidikan($id){
		$this->Globalrules->session_rule();
		$flag = array('id' => $id);
		$this->Allcrud->delData('mr_jur_pendidikan',$flag);
    }
}