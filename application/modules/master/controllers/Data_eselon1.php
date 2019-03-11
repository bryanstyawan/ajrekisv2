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
		
		$data_store        = $this->Globalrules->trigger_insert_update();
		if ($data_sender['crud'] == 'insert') {
			# code...
			$data_store['nama_eselon1'] = $data_sender['es1'];
			            $res_data       = $this->Allcrud->addData('mr_eselon1',$data_store);
			            $text_status    = $this->Globalrules->check_status_res($res_data,'Data Eselon 1 telah berhasil ditambahkan.');
		} elseif ($data_sender['crud'] == 'update') {
			# code...			
			$data_store['nama_eselon1'] = $data_sender['es1'];
			            $res_data       = $this->Allcrud->editData('mr_eselon1',$data_store,array('id_es1'=>$data_sender['oid']));
			            $text_status    = $this->Globalrules->check_status_res($res_data,'Data Eselon 1 telah berhasil diubah.');
		} elseif ($data_sender['crud'] == 'delete') {
			# code...
			$res_data    = $this->Allcrud->delData('mr_eselon1',array('id_es1'=>$data_sender['oid']));
			$text_status = $this->Globalrules->check_status_res($res_data,'Data Eselon 1 telah berhasil dihapus.');
		}

		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}

	public function get_data_eselon($id){
		$this->Globalrules->session_rule();						
		$flag = array('id_es1'=>$id);
		$q    = $this->Allcrud->getData('mr_eselon1',$flag)->row();
		echo json_encode($q);
	}		

	// tentatif, kedepan ini akan dihapus
	public function ajaxEselon1(){
		$data['list']       = $this->Allcrud->listData('mr_eselon1');
		$data['list_final'] = $this->Globalrules->counter_datatable($data['list'],'mr_eselon2','id_es1','id_es1','counter_data');
		$this->load->view('master/eselon/ajaxEselon1',$data);
	}		
}