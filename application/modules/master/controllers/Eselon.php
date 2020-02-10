<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eselon extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
	
	public function data($arg=NULL)
	{
		$this->Globalrules->session_rule();						
		$this->Globalrules->user_access_read();
		$data['title']      = '<b>Struktur Organisasi</b> <i class="fa fa-angle-double-right"></i> Data Eselon';
		$data['content']    = 'master/eselon/home';
		$data['es1']       = $this->Allcrud->listData('mr_eselon1');
		$data['list_final'] = $this->Globalrules->counter_datatable($data['es1'],'mr_eselon2','id_es1','id_es1','counter_data');
		$this->load->view('templateAdmin',$data);
	}

	public function show($id)
	{
		# code...
		switch ($id) {
			case '1':
				# code...
				$data['list']       = $this->Allcrud->listData('mr_eselon1');				
				$data['list_final'] = $this->Globalrules->counter_datatable($data['list'],'mr_eselon2','id_es1','id_es1','counter_data');				
				$this->load->view('master/eselon/ajaxEselon1',$data);				
				break;
			case '2':
				# code...
				$data['list']       = $this->Mmaster->eselon2();
				$data['list_final'] = $this->Globalrules->counter_datatable($data['list'],'mr_eselon3','id_es2','id_es2','counter_data');				
				$this->load->view('master/eselon/ajaxEselon2',$data);				
				break;
			case '3':
				# code...
				$data['list']       = $this->Mmaster->eselon3();
				$data['list_final'] = $this->Globalrules->counter_datatable($data['list'],'mr_eselon4','id_es3','id_es3','counter_data');
				$this->load->view('master/eselon/ajaxEselon3',$data);				
				break;
			case '4':
				# code...
				$data['list']       = $this->Mmaster->eselon4();
				$data['list_final'] = $this->Globalrules->counter_datatable($data['list'],'mr_pegawai','id_es4','es4','counter_data');				
				$this->load->view('master/eselon/ajaxEselon4',$data);				
				break;
			default:
				# code...
				break;
		}
	}

	public function store($arg=NULL,$oid=NULL,$param=NULL)
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
			$data_sender['arg']  = $param;			
		}

		$data_store        = $this->Globalrules->trigger_insert_update();
		if ($data_sender['arg'] == 1) {
			# code...
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
		}
		elseif ($data_sender['arg'] == 2) {
			# code...
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
		}
		elseif ($data_sender['arg'] == 3) {
			# code...
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
		}
		elseif ($data_sender['arg'] == 4) {
			# code...
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
		}				


		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}

	public function edit($id,$arg)
	{
		# code...
		$res_data = array();
		switch ($arg) {
			case '1':
				# code...
				$flag         = array('id_es1'=>$id);
				$res_data['list']     = $this->Allcrud->getData('mr_eselon1',$flag)->row();				
				break;
			case '2':
				# code...
				$flag        = array('id_es2'=>$id);
				$res_data['list']    = $this->Allcrud->getData('mr_eselon2',$flag)->row();				
				break;
			case '3':
				# code...
				$flag = array('id_es3'=>$id);
				$res_data['list']    = $this->Allcrud->getData('mr_eselon3',$flag)->result_array();		
				if ($res_data['list'] != array()) {
					# code...
					$res_data['es2']    = $this->Allcrud->getData('mr_eselon2',array('id_es1'=>$res_data['list'][0]['id_es1']))->result_array();			
				}		
				else
				{
					$res_data['es2']    = 0;			
				}				
				break;
			case '4':
				# code...
				$res_data['list']    = $this->Allcrud->getData('mr_eselon4',array('id_es4'=>$id))->result_array();
				if ($res_data['list'] != array()) {
					# code...
					$res_data['es2']    = $this->Allcrud->getData('mr_eselon2',array('id_es1'=>$res_data['list'][0]['id_es1']))->result_array();
					$res_data['es3']    = $this->Allcrud->getData('mr_eselon3',array('id_es2'=>$res_data['list'][0]['id_es2']))->result_array();						
				}		
				else
				{
					$res_data['es2']    = 0;
					$res_data['es3']    = 0;						
				}				
				break;											
			default:
				# code...
				break;
		}

		echo json_encode($res_data);
	}
}