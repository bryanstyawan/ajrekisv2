<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_eselon3 extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
	
	public function index()
	{
		$this->Globalrules->session_rule();						
		$this->Globalrules->user_access_read();		
		$data['title']      = '<b>Struktur Organisasi</b> <i class="fa fa-angle-double-right"></i> Data Eselon 3';
		$data['content']    = 'master/eselon/data_eselon3';
		$data['es1']        = $this->Allcrud->listData('mr_eselon1');
		$data['es2']        = $this->Allcrud->listData('mr_eselon2');
		$data['list']       = $this->Mmaster->eselon3();
		$data['list_final'] = $this->Globalrules->counter_datatable($data['list'],'mr_eselon4','id_es3','id_es3','counter_data');
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
			$data_store['id_es1'] = $data_sender['es1'];
			$data_store['id_es2'] = $data_sender['es2'];
			$data_store['nama_eselon3'] = $data_sender['es3'];
			            $res_data       = $this->Allcrud->addData('mr_eselon3',$data_store);
			            $text_status    = $this->Globalrules->check_status_res($res_data,'Data Eselon 3 telah berhasil ditambahkan.');
		} elseif ($data_sender['crud'] == 'update') {
			# code...			
			$data_store['id_es1'] = $data_sender['es1'];
			$data_store['id_es2'] = $data_sender['es2'];
			$data_store['nama_eselon3'] = $data_sender['es3'];
			            $res_data       = $this->Allcrud->editData('mr_eselon3',$data_store,array('id_es3'=>$data_sender['oid']));
			            $text_status    = $this->Globalrules->check_status_res($res_data,'Data Eselon 3 telah berhasil diubah.');
		} elseif ($data_sender['crud'] == 'delete') {
			# code...
			$res_data    = $this->Allcrud->delData('mr_eselon3',array('id_es3'=>$data_sender['oid']));
			$text_status = $this->Globalrules->check_status_res($res_data,'Data Eselon 3 telah berhasil dihapus.');
		}

		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}

	// By Bryan
	// Last Edited :2019-02-22
	public function get_data_eselon($id){
		$this->Globalrules->session_rule();						
		$flag = array('id_es3'=>$id);
		$data['list']    = $this->Allcrud->getData('mr_eselon3',$flag)->result_array();		
		if ($data['list'] != array()) {
			# code...
			$data['es2']    = $this->Allcrud->getData('mr_eselon2',array('id_es1'=>$data['list'][0]['id_es1']))->result_array();			
		}		
		else
		{
			$data['es2']    = 0;			
		}
		echo json_encode($data);
	}

	//By : Bryan
	//Last Edited : 2019-03-02	
	public function dropdown_es3($param=NULL,$param1=NULL)
	{
		# code...
		$this->Globalrules->session_rule();								
		$flag                    = array('id_es2'=>$this->input->post('select_eselon_2'));
		$data['select_eselon_3'] = $this->Allcrud->getData('mr_eselon3',$flag);
		$data['param']           = $param;
		$data['param1']          = $param1;					
		$this->load->view('templates/filter/eselon3',$data);				
	}	

	public function ajaxEselon3(){
		$this->Globalrules->session_rule();							
		$data['list']       = $this->Mmaster->eselon3();
		$data['list_final'] = $this->Globalrules->counter_datatable($data['list'],'mr_eselon4','id_es3','id_es3','counter_data');
		$this->load->view('master/eselon/ajaxEselon3',$data);
	}

	public function cariEs3(){
		$this->Globalrules->session_rule();								
		$flag        = array('id_es2'=>$this->input->post('es2'));
		$data['es3'] = $this->Allcrud->getData('mr_eselon3',$flag);
		$this->load->view('master/eselon/ajax/eselon3',$data);
	}			

	public function formEselon3(){
		$this->Globalrules->session_rule();								
		$flag = array('id_es2'=>$this->input->post('nes2'));
		$data['es3']= $this->Allcrud->getData('mr_eselon3',$flag);
		$this->load->view('master/pegawai/eselon3',$data);
	}	
}