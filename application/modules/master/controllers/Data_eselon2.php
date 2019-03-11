<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_eselon2 extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
	
	public function index()
	{
		$this->Globalrules->session_rule();						
		$data['title']      = '<b>Struktur Organisasi</b> <i class="fa fa-angle-double-right"></i> Data Eselon 2';
		$data['content']    = 'master/eselon/data_eselon2';
		$data['es1']        = $this->Allcrud->listData('mr_eselon1');
		$data['list']       = $this->Mmaster->eselon2();
		$data['list_final'] = $this->Globalrules->counter_datatable($data['list'],'mr_eselon3','id_es2','id_es2','counter_data');
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
			$data_store['nama_eselon2'] = $data_sender['es2'];
			            $res_data       = $this->Allcrud->addData('mr_eselon2',$data_store);
			            $text_status    = $this->Globalrules->check_status_res($res_data,'Data Eselon 2 telah berhasil ditambahkan.');
		} elseif ($data_sender['crud'] == 'update') {
			# code...			
			$data_store['id_es1'] = $data_sender['es1'];
			$data_store['nama_eselon2'] = $data_sender['es2'];
			            $res_data       = $this->Allcrud->editData('mr_eselon2',$data_store,array('id_es2'=>$data_sender['oid']));
			            $text_status    = $this->Globalrules->check_status_res($res_data,'Data Eselon 2 telah berhasil diubah.');
		} elseif ($data_sender['crud'] == 'delete') {
			# code...
			$res_data    = $this->Allcrud->delData('mr_eselon2',array('id_es2'=>$data_sender['oid']));
			$text_status = $this->Globalrules->check_status_res($res_data,'Data Eselon 2 telah berhasil dihapus.');
		}

		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}

	//By Eric
	//Last Edited :  2019-02-01
	public function get_data_eselon($id){
		$this->Globalrules->session_rule();						
		$flag = array('id_es2'=>$id);
		$q    = $this->Allcrud->getData('mr_eselon2',$flag)->row();
		echo json_encode($q);
	}

	//By : Bryan
	//Last Edited : 2019-02-20
	public function formEselon2(){
		$this->Globalrules->session_rule();								
		$data['es2'] = $this->Allcrud->getData('mr_eselon2',array('id_es1'=>$this->input->post('nes1')));
		$this->load->view('master/pegawai/eselon2',$data);
	}	

	//By : Bryan
	//Last Edited : 2019-03-02	
	public function dropdown_es2($param=NULL,$param1=NULL)
	{
		# code...
		$this->Globalrules->session_rule();								
		$flag                    = array('id_es1'=>$this->input->post('select_eselon_1'));
		$data['select_eselon_2'] = $this->Allcrud->getData('mr_eselon2',$flag);
		$data['param']           = $param;
		$data['param1']          = $param1;		
		$this->load->view('templates/filter/eselon2',$data);		
	}						









	//soon, ini akan dihapus
	public function ajaxEselon2(){
		$this->Globalrules->session_rule();						
		$data['list']       = $this->Mmaster->eselon2();
		$data['list_final'] = $this->Globalrules->counter_datatable($data['list'],'mr_eselon3','id_es2','id_es2','counter_data');
		$this->load->view('master/eselon/ajaxEselon2',$data);
	}

	//soon, ini akan dhapus
	public function cariEs2(){
		$this->Globalrules->session_rule();						
		$flag        = array('id_es1'=>$this->input->post('es1'));
		$data['es2'] = $this->Allcrud->getData('mr_eselon2',$flag);
		$this->load->view('master/eselon/ajax/eselon2',$data);
	}	

	//soon, ini akan dhapus	
	public function cariEs2edit(){
		$this->Globalrules->session_rule();						
		$flag         = array('id_es1'=>$this->input->post('nes1'));
		$data['nes2'] = $this->Allcrud->getData('mr_eselon2',$flag);
		$this->load->view('master/eselon/ajax/eselon2edit',$data);
	}
}