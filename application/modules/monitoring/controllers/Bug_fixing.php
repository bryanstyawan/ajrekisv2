<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/PHPExcel.php";
class Bug_fixing extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmonitoring', '', TRUE);
		$this->load->library('Excel');
		$this->load->library('image_lib');
		$this->load->library('upload');
		date_default_timezone_set('Asia/Jakarta');
		$this->Globalrules->session_rule();		
	}

	public function data()
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$data['title']      = 'Request Perbaikan Bug & Fitur';
		$data['list']       = $this->Mmonitoring->get_data_report_bug_by_time();		
		$data['priority']   = $this->Allcrud->listData('lt_bug_fixing_priority')->result_array();
		$data['status']     = $this->Allcrud->listData('lt_bug_fixing_status')->result_array();
		if ($data['status'] != array()) {
			# code...
			for ($i=0; $i < count($data['status']); $i++) { 
				# code...
				$getData = $this->Allcrud->getData('tr_request_bug_fixing_fitur',array('status'=>$data['status'][$i]['id']))->result_array();
				$data['status'][$i]['counter'] = ($getData != array()) ? count($getData) : '';
			}
		}
		
		if ($data['priority'] != array()) {
			# code...
			for ($i=0; $i < count($data['priority']); $i++) { 
				# code...
				$getData = $this->Allcrud->getData('tr_request_bug_fixing_fitur',array('priority'=>$data['priority'][$i]['id']))->result_array();
				$data['priority'][$i]['counter'] = ($getData != array()) ? count($getData) : '';
			}			
		}

		$data['content']    = 'monitoring/bug_fixing/index';
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

		$data_store = $this->Globalrules->trigger_insert_update();
		if ($data_sender['crud'] == 'insert') {
			# code...
			$data_store['id_pegawai'] = $this->session->userdata('sesUser');
			$data_store['judul']      = $data_sender['f_judul'];
			$data_store['isi']        = $data_sender['f_isi'];
			$data_store['status']     = 0;
			$res_data                 = $this->Allcrud->addData('tr_request_bug_fixing_fitur',$data_store);
			$text_status              = $this->Globalrules->check_status_res($res_data,'Data telah berhasil ditambahkan.');
		}
		elseif ($data_sender['crud'] == 'insert_upload') {
			# code...
			$data_store['id_pegawai'] = $this->session->userdata('sesUser');
			$data_store['judul']      = $data_sender['f_judul'];
			$data_store['isi']        = $data_sender['f_isi'];
			$data_store['status']     = 0;
			$res_data                 = $this->Allcrud->editData('tr_request_bug_fixing_fitur',$data_store,array('id'=>$data_sender['oid']));			
			$text_status              = $this->Globalrules->check_status_res($res_data,'Data telah berhasil ditambahkan.');			
		}
		elseif ($data_sender['crud'] == 'change_status') {
			# code...
			if ($data_sender['status'] == '2') {
				# code...
				$data_store['id_pic'] = $this->session->userdata('sesUser');				
			}
			$data_store['status']     = $data_sender['status'];
			$res_data                 = $this->Allcrud->editData('tr_request_bug_fixing_fitur',$data_store,array('id'=>$data_sender['oid']));			
			$text_status              = $this->Globalrules->check_status_res($res_data,'Status telah diubah.');			
		}		

		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}

	public function upload_data($arg)
	{
		# code...
		$config['upload_path']   = FCPATH."public/bug_report/".date('Y-m');
		$config['allowed_types'] = 'pdf|docx|doc|jpg|jpeg|png|ppt|pptx|xls|xlsx';
		$config['max_size']      = '15000';
		$data                    = "";
		$this->load->library('upload', $config);
		$this->upload->initialize($config);		
		if(!is_dir("public/bug_report/"))
		{
			mkdir("public/bug_report/", 0755);
		}

		if(!is_dir("public/bug_report/".date('Y-m')."/"))
		{
			mkdir("public/bug_report/".date('Y-m')."/", 0755);
		}		

		$f_file       = "";
		$res_data     = 0;
		$res_data_id  = "";
		$text_status  = "";
		$msg          = "";

		$data_store  = $this->Globalrules->trigger_insert_update($arg);
		if ($arg == 'insert') {
			# code...
			if ( ! $this->upload->do_upload('file')){
				$res_data = 0;
				$msg      = $this->upload->display_errors();
				$f_file   = "";
			}
			else
			{
				$dataupload = $this->upload->data();
				$res_data   = 1;				
				$msg        = $dataupload['file_name']." berhasil diupload";
				$f_file     = $this->upload->data('file_name');
			}

			if ($res_data == 1) {
				$data_store['file'] = $f_file;
				$process     = $this->Allcrud->addData_with_return_id('tr_request_bug_fixing_fitur',$data_store);
				$res_data_id = $process;
				$text_status = $this->Globalrules->check_status_res($res_data,$msg);
			}
			else {
				# code...
				$text_status = $msg;								
			}
		}
		elseif ($arg == 'update') {
			# code...
			// $get_data = $this->get_data($oid,'result_array','mr_video');
			// $path_to_file = $config['upload_path'].$get_data[0]['file'];
			// if ($get_data[0]['file'] != '' || $get_data[0]['file'] != NULL) {
			// 	# code...
			// 	$param_file_exists = 0;
			// 	if (file_exists($path_to_file)) {
			// 		# code...
			// 		$param_file_exists = 1;
			// 		if(unlink($path_to_file)) {
			// 			// echo 'deleted successfully';
			// 		}
			// 		else {
			// 			echo 'errors occured';
			// 		}							
			// 	}
			// 	else {
			// 		# code...
			// 		$param_file_exists = 0;				
			// 	}				
			// }

			// if ( ! $this->upload->do_upload('file')){
			// 	$res_data = 0;
			// 	$msg      = $this->upload->display_errors();
			// 	$f_file   = "";
			// }
			// else
			// {
			// 	$dataupload = $this->upload->data();
			// 	$res_data   = 1;				
			// 	$msg        = $dataupload['file_name']." berhasil diupload";
			// 	$f_file     = $this->upload->data('file_name');
			// }
			// if ($res_data == 1) {
			// 	# code...
			// 	if ($f_file != '')$data_store['file'] = $f_file;
	
			// 	$data_store['file']      = $f_file;
			// 					$process     = $this->Allcrud->editData('mr_video',$data_store,array('id'=>$oid));
			// 					$res_data    = $process;
			// 					$res_data_id = $oid;
			// 					$text_status = $this->Globalrules->check_status_res($res_data,$msg);
			// }
			// elseif($res_data == 0) {
			// 	# code...
			// 	$text_status = $msg;				
			// }
		}

		$res = array
		(
			'status' => $res_data,
			'text'   => $text_status,
			'id'     => $res_data_id
		);
		echo json_encode($res);		
	}

}
