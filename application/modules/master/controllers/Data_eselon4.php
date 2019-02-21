<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_eselon4 extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
	
	public function index()
	{
		$this->Globalrules->session_rule();								
		$data['title']      = '<b>Struktur Organisasi</b> <i class="fa fa-angle-double-right"></i> Data Eselon 4';
		$data['content']    = 'master/eselon/data_eselon4';
		$data['es1']        = $this->Allcrud->listData('mr_eselon1');
		$data['list']       = $this->Mmaster->eselon4();
		$data['list_final'] = $this->Globalrules->counter_datatable($data['list'],'mr_pegawai','id_es4','es4','counter_data');		
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
			$data_store['id_es1'] = $data_sender['es1'];
			$data_store['id_es2'] = $data_sender['es2'];
			$data_store['id_es3'] = $data_sender['es3'];
			$data_store['nama_eselon4'] = $data_sender['es4'];
			            $res_data       = $this->Allcrud->addData('mr_eselon4',$data_store);
			            $text_status    = $this->Globalrules->check_status_res($res_data,'Data Eselon 4 telah berhasil ditambahkan.');
		} elseif ($data_sender['crud'] == 'update') {
			# code...			
			$data_store['id_es1'] = $data_sender['es1'];
			$data_store['id_es2'] = $data_sender['es2'];
			$data_store['id_es3'] = $data_sender['es3'];
			$data_store['nama_eselon4'] = $data_sender['es4'];
			            $res_data       = $this->Allcrud->editData('mr_eselon4',$data_store,array('id_es4'=>$data_sender['oid']));
			            $text_status    = $this->Globalrules->check_status_res($res_data,'Data Eselon 4 telah berhasil diubah.');
		} elseif ($data_sender['crud'] == 'delete') {
			# code...
			$res_data    = $this->Allcrud->delData('mr_eselon4',array('id_es4'=>$data_sender['oid']));
			$text_status = $this->Globalrules->check_status_res($res_data,'Data Eselon 4 telah berhasil dihapus.');
		}

		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}

	//By Eric
	//2019-02-01
	public function get_data_eselon($id){
		$this->Globalrules->session_rule();						
		$flag = array('id_es4'=>$id);
		$q    = $this->Allcrud->getData('mr_eselon4',$flag)->row();
		echo json_encode($q);
	}

	public function cariEs4(){
		$this->Globalrules->session_rule();							
		$flag        = array('id_es3'=>$this->input->post('es3'));
		$data['es4'] = $this->Allcrud->getData('mr_eselon4',$flag);
		$this->load->view('master/eselon/ajax/eselon4',$data);
	}
	
	//By Bryan
	//2019-02-20
	public function ajaxEselon4(){
		$this->Globalrules->session_rule();								
		$data['list']       = $this->Mmaster->eselon4();
		$data['list_final'] = $this->Globalrules->counter_datatable($data['list'],'mr_pegawai','id_es4','es4','counter_data');
		$this->load->view('master/eselon/ajaxEselon4',$data);
	}	

	public function cariEs4_filter($param=NULL,$param1=NULL)
	{
		# code...
		$this->Globalrules->session_rule();								
		$flag                    = array('id_es3'=>$this->input->post('select_eselon_3'));
		$data['select_eselon_4'] = $this->Allcrud->getData('mr_eselon4',$flag);
		$data['param']           = $param;		
		$data['param1']           = $param1;				
		$this->load->view('master/eselon/ajax/eselon4filter',$data);				
	}

	public function formEselon4(){
		$this->Globalrules->session_rule();							
		$flag = array('id_es3'=>$this->input->post('nes3'));
		$data['es4']= $this->Allcrud->getData('mr_eselon4',$flag);
		$this->load->view('master/pegawai/eselon4',$data);
	}			
}