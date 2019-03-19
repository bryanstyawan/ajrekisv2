<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pegawai extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
		$this->load->model ('skp/mskp', '', TRUE);		
		$this->load->library('Excel');		
	}

	public function index()
	{
		$this->Globalrules->session_rule();
		$this->Globalrules->user_access_read();	
		$data['title']        = 'Data Pegawai';
		$data['content']      = 'master/pegawai/data_pegawai';
		$flag                 = array();																		
		$data['jenis_posisi'] = $this->Allcrud->listData('mr_kat_posisi');
		$data['es1']          = $this->Allcrud->listData('mr_eselon1');
		$data['role']         = $this->Allcrud->listData('user_role');
		$data['agama']        = $this->Allcrud->listData('mr_agama');
		$this->load->view('templateAdmin',$data);
	}

	public function get_data_pegawai($id){
		$this->Globalrules->session_rule();						

		$data['pegawai'] = $this->Allcrud->getData('mr_pegawai',array('id'=>$id))->result_array();
		$data['tmt_pegawai'] = $this->Mmaster->get_masa_kerja_id_pegawai($id,'DESC');
		if ($data['pegawai'] != array()) {
			# code...
			$data['list_eselon2']      = $this->Allcrud->getData('mr_eselon2',array('id_es1'=>$data['pegawai'][0]['es1']))->result_array();
			$data['list_eselon3']      = $this->Allcrud->getData('mr_eselon3',array('id_es2'=>$data['pegawai'][0]['es2']))->result_array();
			$data['list_eselon4']      = $this->Allcrud->getData('mr_eselon4',array('id_es3'=>$data['pegawai'][0]['es3']))->result_array();
			$data['jabatan_raw']       = $this->Allcrud->getData('mr_posisi',array('id'=>$data['pegawai'][0]['posisi']))->result_array();
			$data['jabatan_akademik']  = $this->Allcrud->getData('mr_posisi',array('id'=>$data['pegawai'][0]['posisi_akademik']))->result_array();
			$data['jabatan_plt']       = $this->Allcrud->getData('mr_posisi',array('id'=>$data['pegawai'][0]['posisi_plt']))->result_array();						
			if ($data['jabatan_raw'] != array()) {
				# code...
				$data['jabatan_jfu']  = $this->Allcrud->getData('mr_jabatan_fungsional_umum',array('id'=>$data['jabatan_raw'][0]['id_jfu']))->result_array();
				$data['jabatan_jft']  = $this->Allcrud->getData('mr_jabatan_fungsional_tertentu',array('id'=>$data['jabatan_raw'][0]['id_jft']))->result_array();								
			}
			else {
				# code...
				$data['jabatan_jfu'] = array();
				$data['jabatan_jft'] = array();
			}
		}
		echo json_encode($data);
	}		

	public function store($param=NULL,$oid=NULL,$status=NULL)
	{
		# code...
		$res_data    = 0;
		$text_status = "";
		$id_pegawai  = "";
		$data_sender = $this->input->post('data_sender');
		$jabatan     = $this->input->post('jabatan');
		if ($param == 'password') {
			# code...
			$data_store                = $this->Globalrules->trigger_insert_update();			
			$data_store['password']    = md5('usersikerja');
			$data_store['user_update'] = date('y-m-d');
			$res_data                  = $this->Allcrud->editData('mr_pegawai',$data_store,array('id'=>$oid));
			$text_status               = $this->Globalrules->check_status_res($res_data,'Password Pegawai telah berhasil diubah.');			
		}
		elseif ($param == 'data_status') {
			# code...
			$data_store                = $this->Globalrules->trigger_insert_update();			
			$data_store['status']      = $status;
			$res_data                  = $this->Allcrud->editData('mr_pegawai',$data_store,array('id'=>$oid));
			$text_status               = $this->Globalrules->check_status_res($res_data,'Status Pegawai telah berhasil diubah.');						
		}
		else {
			# code...
			if ($param == NULL) {
				# code...
				$data_sender = $this->input->post('data_sender');
			}
			else {
				# code...
				$data_sender['crud'] = $param;
				$data_sender['oid']  = $oid;
			}

			if ($data_sender['crud'] != 'delete') {
				# code...
				$data_store = array
				(
					'es1'                   => $data_sender['es1'],
					'es2'                   => $data_sender['es2'],
					'es3'                   => $data_sender['es3'],
					'es4'                   => $data_sender['es4'],
					'nip'                   => $data_sender['nip'],				
					'nama_pegawai'          => $data_sender['nama'],				
					'posisi'                => $data_sender['jabatan'],
					'posisi_akademik'       => $data_sender['jabatan_akademik'],
					'posisi_plt'			=> $data_sender['jabatan_plt'], 					
					'tmt_jabatan'           => $data_sender['tmt'],
					'local'		          	=> '0',
					'audit_time'            => date('Y-m-d H:i:s'), 
					'audit_user'            => $this->session->userdata('sesNip')					
				);

				// $data_store = $this->Globalrules->trigger_insert_update($data_sender['crud']);				
				if ($data_sender['crud'] == 'insert') {
					# code...
					$data_store['status']     = 1;
					$data_store['id_role']    = 2;
					$data_store['user_input'] = date('y-m-d');
					$data_store['audit_user'] = $this->session->userdata('sesNip');					
					$id_pegawai  = $this->Allcrud->addData_with_return_id('mr_pegawai',$data_store);
					if ($id_pegawai != 0)$res_data = 1;
					$text_status = $this->Globalrules->check_status_res($res_data,'Data Pegawai telah berhasil ditambah.');
				}
				elseif ($data_sender['crud'] == 'update') {
					# code...
					$data_store['user_update'] = date('y-m-d');
					$data_store['audit_user'] = $this->session->userdata('sesNip');					
					$res_data    = $this->Allcrud->editData('mr_pegawai',$data_store,array('id'=>$data_sender['oid']));
					$id_pegawai  = $data_sender['oid'];
					$text_status = $this->Globalrules->check_status_res($res_data,'Data Pegawai telah berhasil diubah.');
				}			
				
				$get_masa_kerja_pegawai = $this->Mmaster->get_masa_kerja_id_pegawai($id_pegawai,'DESC');
				if ($get_masa_kerja_pegawai == 0) {
					# code...
					$data_masa_kerja = array
									(
										'id_pegawai'            => $id_pegawai,
										'StartDate'             => $data_sender['tmt'],
										'EndDate'               => '9999-01-01',
										'id_posisi'             => $data_sender['jabatan'],
										'status_masa_kerja'     => 'A',
										'audit_time'            => date('Y-m-d H:i:s'), 
										'audit_user'            => $this->session->userdata('sesNip')
									);
					$this->Allcrud->addData('mr_masa_kerja',$data_masa_kerja);
				}
				else
				{
					$get_masa_kerja_detail = $this->Mmaster->get_masa_kerja($id_pegawai,$data_sender['jabatan']);
		
					if ($get_masa_kerja_detail == 0) {
						# code...
						$data_masa_kerja_lama = array
										(
											'EndDate'    => date('Y-m-d',strtotime($data_sender['tmt'] . "-1 days")),
											'audit_time' => date('Y-m-d H:i:s'), 
											'audit_user' => $this->session->userdata('sesNip')
										);
						$this->Allcrud->editData('mr_masa_kerja',$data_masa_kerja_lama,array('id' => $get_masa_kerja_pegawai[0]->id));
		
						$data_masa_kerja_baru = array
										(
											'id_pegawai'            => $id_pegawai,
											'StartDate'             => $data_sender['tmt'],
											'EndDate'               => '9999-01-01',
											'id_posisi'             => $data_sender['jabatan'],
											'audit_time'            => date('Y-m-d H:i:s'), 
											'audit_user'            => $this->session->userdata('sesNip')
										);
						$this->Allcrud->addData('mr_masa_kerja',$data_masa_kerja_baru);
					}
					else
					{
						$data_masa_kerja = array
										(
											'StartDate'             => $data_sender['tmt'],
											'audit_time'            => date('Y-m-d H:i:s'), 
											'audit_user'            => $this->session->userdata('sesNip')
										);
						$this->Allcrud->editData('mr_masa_kerja',$data_masa_kerja,array('id' => $get_masa_kerja_detail[0]->id));
		
						if (count($get_masa_kerja_pegawai) > 1) {
							# code...
							$data_masa_kerja_lama = array
											(
												'EndDate'               => date('Y-m-d',strtotime($data_sender['tmt'] . "-1 days")),
												'audit_time'            => date('Y-m-d H:i:s'), 
												'audit_user'            => $this->session->userdata('sesNip')
											);
							$this->Allcrud->editData('mr_masa_kerja',$data_masa_kerja_lama,array('id' => $get_masa_kerja_pegawai[1]->id));
						}
					}
				}
				
				$get_masa_kerja_pegawai_akademik = $this->Mmaster->get_masa_kerja_id_pegawai_akademik($id_pegawai,'DESC');
				if ($get_masa_kerja_pegawai_akademik == 0) {
					# code...
					$data_masa_kerja_akademik = array
									(
										'id_pegawai'            => $id_pegawai,
										'StartDate'             => $data_sender['tmt_akademik'],
										'EndDate'               => '9999-01-01',
										'id_posisi'             => $data_sender['jabatan_akademik'],
										'status_masa_kerja'     => 'A',
										'audit_time'            => date('Y-m-d H:i:s'), 
										'audit_user'            => $this->session->userdata('sesNip')
									);
					$this->Allcrud->addData('mr_masa_kerja_akademik',$data_masa_kerja_akademik);
				}
				else
				{
					$get_masa_kerja_detail_akademik = $this->Mmaster->get_masa_kerja_akademik($id_pegawai,$data_sender['jabatan_akademik']);
		
					if ($get_masa_kerja_detail_akademik == 0) {
						# code...
						$data_masa_kerja_lama_akademik = array
										(
											'EndDate'               => date('Y-m-d',strtotime($data_sender['tmt_akademik'] . "-1 days")),
											'audit_time'            => date('Y-m-d H:i:s'), 
											'audit_user'            => $this->session->userdata('sesNip')
										);
						$this->Allcrud->editData('mr_masa_kerja_akademik',$data_masa_kerja_lama_akademik,array('id' => $get_masa_kerja_pegawai[0]->id));
		
						$data_masa_kerja_baru_akademik = array
										(
											'id_pegawai'            => $id_pegawai,
											'StartDate'             => $data_sender['tmt_akademik'],
											'EndDate'               => '9999-01-01',
											'id_posisi'             => $data_sender['jabatan_akademik'],
											'audit_time'            => date('Y-m-d H:i:s'), 
											'audit_user'            => $this->session->userdata('sesNip')
										);
						$this->Allcrud->addData('mr_masa_kerja_akademik',$data_masa_kerja_baru_akademik);
					}
					else
					{
						$data_masa_kerja_akademik = array
										(
											'StartDate'             => $data_sender['tmt_akademik'],
											'audit_time'            => date('Y-m-d H:i:s'), 
											'audit_user'            => $this->session->userdata('sesNip')
										);
						$this->Allcrud->editData('mr_masa_kerja_akademik',$data_masa_kerja_akademik,array('id' => $get_masa_kerja_detail[0]->id));
		
						if (count($get_masa_kerja_pegawai_akademik) > 1) {
							# code...
							$data_masa_kerja_lama_akademik = array
											(
												'EndDate'               => date('Y-m-d',strtotime($data_sender['tmt_akademik'] . "-1 days")),
												'audit_time'            => date('Y-m-d H:i:s'), 
												'audit_user'            => $this->session->userdata('sesNip')
											);		
							$this->Allcrud->editData('mr_masa_kerja_akademik',$data_masa_kerja_lama_akademik,array('id' => $get_masa_kerja_pegawai[1]->id));
						}
					}
				}	
				
				$get_masa_kerja_pegawai_plt = $this->Mmaster->get_masa_kerja_id_pegawai_plt($id_pegawai,'DESC');
				if ($get_masa_kerja_pegawai_akademik == 0) {
					# code...
					$data_masa_kerja_plt = array
									(
										'id_pegawai'            => $id_pegawai,
										'StartDate'             => $data_sender['tmt_plt'],
										'EndDate'               => '9999-01-01',
										'id_posisi'             => $data_sender['jabatan_plt'],
										'status_masa_kerja'     => 'A',
										'audit_time'            => date('Y-m-d H:i:s'), 
										'audit_user'            => $this->session->userdata('sesNip')
									);
					$this->Allcrud->addData('mr_masa_kerja_plt',$data_masa_kerja_plt);
				}
				else
				{
					$get_masa_kerja_detail_plt = $this->Mmaster->get_masa_kerja_plt($id_pegawai,$data_sender['jabatan_plt']);
		
					if ($get_masa_kerja_detail_plt == 0) {
						# code...
						$data_masa_kerja_lama_plt = array
													(
														'EndDate'               => date('Y-m-d',strtotime($data_sender['tmt_plt'] . "-1 days")),
														'audit_time'            => date('Y-m-d H:i:s'), 
														'audit_user'            => $this->session->userdata('sesNip')
													);
						$this->Allcrud->editData('mr_masa_kerja_plt',$data_masa_kerja_lama_plt,array('id' => $get_masa_kerja_pegawai[0]->id));
		
						$data_masa_kerja_baru_plt = array
													(
														'id_pegawai'            => $id_pegawai,
														'StartDate'             => $data_sender['tmt_plt'],
														'EndDate'               => '9999-01-01',
														'id_posisi'             => $data_sender['jabatan_plt'],
														'audit_time'            => date('Y-m-d H:i:s'), 
														'audit_user'            => $this->session->userdata('sesNip')
													);
						$this->Allcrud->addData('mr_masa_kerja_plt',$data_masa_kerja_baru_plt);
					}
					else
					{
						$data_masa_kerja_plt = array
												(
													'StartDate'             => $data_sender['tmt_plt'],
													'audit_time'            => date('Y-m-d H:i:s'), 
													'audit_user'            => $this->session->userdata('sesNip')
												);
						$this->Allcrud->editData('mr_masa_kerja_plt',$data_masa_kerja_plt,array('id' => $get_masa_kerja_detail[0]->id));
		
						if (count($get_masa_kerja_pegawai_plt) > 1) {
							# code...
							$data_masa_kerja_lama_plt = array
														(
															'EndDate'               => date('Y-m-d',strtotime($data_sender['tmt_plt'] . "-1 days")),
															'audit_time'            => date('Y-m-d H:i:s'), 
															'audit_user'            => $this->session->userdata('sesNip')
														);		
							$this->Allcrud->editData('mr_masa_kerja_plt',$data_masa_kerja_lama_plt,array('id' => $get_masa_kerja_pegawai[1]->id));
						}
					}
				}					
			}
			else {
				# code...
				if ($data_sender['crud'] == 'delete') {
					# code...
					$res_data    = $this->Allcrud->delData('mr_pegawai',array('id' => $data_sender['oid']));				
					$text_status = $this->Globalrules->check_status_res($res_data,'Data Pegawai telah berhasil dihapus.');											
				}				
			}

		}

		$res = array
				(
					'status' => $res_data,
					'text'   => $text_status
				);
		echo json_encode($res);											
	}

	public function ajaxPegawai(){
		$this->Globalrules->session_rule();
		$flag          = array('es1.id_es1'=>'1');
		$data['list']  = $this->Mmaster->dataUser($flag,NULL,NULL);
		$data['es1']   = $this->Allcrud->listData('mr_eselon1');
		$data['agama'] = $this->Allcrud->listData('mr_agama');
		$this->load->view('master/pegawai/ajaxPegawai',$data);
	}

	public function delete_masa_kerja($id){
		$this->Globalrules->session_rule();
		$get_masa_kerja = $this->Mmaster->get_masa_kerja_id($id);
		$id_pegawai     = "";
		if ($get_masa_kerja != 0) {
			# code...
			$id_pegawai = $get_masa_kerja[0]->id_pegawai;
		}
		$flag = array('id' => $id);
		$this->Allcrud->delData('mr_masa_kerja',$flag);

		$get_masa_kerja_pegawai = $this->Mmaster->get_masa_kerja_id_pegawai($id_pegawai,'DESC');
		if (count($get_masa_kerja_pegawai) > 1) {
			# code...
				$data_masa_kerja_lama = array
								(
									'EndDate'    => '9999-01-01'
								);

				$flag = array
						(
							'id' => $get_masa_kerja_pegawai[0]->id
						);
				$this->Allcrud->editData('mr_masa_kerja',$data_masa_kerja_lama,$flag);
		}
		$data['masa_kerja']    = $get_masa_kerja_pegawai;
		$this->load->view('master/pegawai/ajax_masa_kerja',$data);
		// print_r($get_masa_kerja_pegawai);die();
	}

	public function unggah_foto_pegawai()
	{
		# code...
	    $config['upload_path']   = FCPATH.'/public/images/pegawai/';
	    $config['allowed_types'] = 'gif|jpg|png|ico';
	    $this->load->library('upload',$config);

	    if($this->upload->do_upload('userfile')){
			$token        = $this->input->post('token_foto');
			$image        = $this->upload->data('file_name');
			$this->Allcrud->editData('mr_pegawai',array('photo'=>$image),array('id'=>$token));
        }

		echo $this->upload->display_errors();
	}

	public function unggah_foto_pegawai_self()
	{
		# code...
        $config['upload_path']   = FCPATH.'/public/images/pegawai/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
		$this->load->library('upload',$config);
		$token        = $this->session->userdata('sesUser');
		$get_data     = $this->Allcrud->getData('mr_pegawai',array('id'=>$token))->result_array();
		$path_to_file = $config['upload_path'].$get_data[0]['photo'];
		if ($get_data[0]['photo'] != '' || $get_data[0]['photo'] != NULL) {
			# code...
			$param_file_exists = 0;
			if (file_exists($path_to_file)) {
				# code...
				$param_file_exists = 1;
				if(unlink($path_to_file)) {
					// echo 'deleted successfully';
				}
				else {
					echo 'errors occured';
				}							
			}
			else {
				# code...
				$param_file_exists = 0;				
			}				
		}		

        if($this->upload->do_upload('userfile')){
			$image        = $this->upload->data('file_name');			
			$this->Allcrud->editData('mr_pegawai',array('photo'=>$image),array('id'=>$token));
        }
		echo $this->upload->display_errors();
	}

	public function cariJabatan(){
		$this->Globalrules->session_rule();
		if($this->input->post('es4') != NULL || $this->input->post('nes4') != NULL){
			if($this->input->post('es4') == NULL){
				$flag = array(
				'eselon4'=> $this->input->post('nes4')
				);
			}else{
				$flag = array(
				'eselon4'=> $this->input->post('es4')
				);
			}
		}elseif($this->input->post('es3') != NULL || $this->input->post('nes3') != NULL){
			if($this->input->post('es3') == NULL){
				$flag = array(
				'eselon3'=> $this->input->post('nes3'),
				'eselon4'=> 0
				);
			}else{
				$flag = array(
				'eselon3'=> $this->input->post('es3'),
				'eselon4'=> 0
				);
			}
		}elseif($this->input->post('es2') != NULL || $this->input->post('nes2') != NULL){
			if($this->input->post('es2') == NULL){
				$flag = array(
				'eselon2'=> $this->input->post('nes2'),
				'eselon3'=> 0
				);
			}else{
				$flag = array(
				'eselon2'=> $this->input->post('es2'),
				'eselon3'=> 0
				);
			}
		}else{
			if($this->input->post('es1') == NULL){
				$flag = array(
				'eselon1'=> $this->input->post('nes1'),
				'eselon2'=> 0
				);
			}else{
				$flag = array(
				'eselon1'=> $this->input->post('es1'),
				'eselon2'=> 0
				);
			}
		}
		$data['jabatan'] = $this->Allcrud->getData('mr_posisi',$flag)->result_array();
		if ($data['jabatan'] != array()) {
			# code...
			for ($i=0; $i < count($data['jabatan']); $i++) { 
				# code...
				$data_pegawai                          = $this->Globalrules->get_info_pegawai($data['jabatan'][$i]['atasan'],'posisi');				
				$data_eselon_1                         = $this->Allcrud->getData('mr_eselon1',array('id_es1'=>$data['jabatan'][$i]['eselon1']))->result_array();
				$data_eselon_2                         = $this->Allcrud->getData('mr_eselon2',array('id_es2'=>$data['jabatan'][$i]['eselon2']))->result_array();
				$data_eselon_3                         = $this->Allcrud->getData('mr_eselon3',array('id_es3'=>$data['jabatan'][$i]['eselon3']))->result_array();
				$data_eselon_4                         = $this->Allcrud->getData('mr_eselon4',array('id_es4'=>$data['jabatan'][$i]['eselon4']))->result_array();												
				$data['jabatan'][$i]['id_eselon1']     = ($data_eselon_1 != array()) ? $data_eselon_1[0]['id_es1'] : '' ;
				$data['jabatan'][$i]['id_eselon2']     = ($data_eselon_2 != array()) ? $data_eselon_2[0]['id_es2'] : '' ;
				$data['jabatan'][$i]['id_eselon3']     = ($data_eselon_3 != array()) ? $data_eselon_3[0]['id_es3'] : '' ;
				$data['jabatan'][$i]['id_eselon4']     = ($data_eselon_4 != array()) ? $data_eselon_4[0]['id_es4'] : '' ;												
				$data['jabatan'][$i]['nama_eselon1']   = ($data_eselon_1 != array()) ? $data_eselon_1[0]['nama_eselon1'] : '' ;				
				$data['jabatan'][$i]['nama_eselon2']   = ($data_eselon_2 != array()) ? $data_eselon_2[0]['nama_eselon2'] : '' ;
				$data['jabatan'][$i]['nama_eselon3']   = ($data_eselon_3 != array()) ? $data_eselon_3[0]['nama_eselon3'] : '' ;
				$data['jabatan'][$i]['nama_eselon4']   = ($data_eselon_4 != array()) ? $data_eselon_4[0]['nama_eselon4'] : '' ;																
				$data['jabatan'][$i]['nama_atasan']    = ($data_pegawai != 0) ? $data_pegawai[0]->nama_pegawai : '';
				$data['jabatan'][$i]['jabatan_atasan'] = ($data_pegawai != 0) ? $data_pegawai[0]->nama_jabatan : '';												
			}
		}
		$this->load->view('master/pegawai/ajaxjabatan',$data);
	}

	public function cari_jabatan_struktur_akademik()
	{
		# code...
		$this->Globalrules->session_rule();
		$data['jabatan'] = $this->Allcrud->getData('mr_posisi',array('kat_posisi' =>6));
		$this->load->view('master/pegawai/ajax_jabatan_struktur_akademik',$data);		
	}

	public function cari_jabatan_plt()
	{
		# code...
		$data['jabatan'] = $this->Allcrud->getData('mr_posisi',array('kat_posisi' =>1));
		$this->load->view('master/pegawai/ajax_jabatan_plt',$data);		
	}

	public function masa_kerja_pegawai_id($id)
	{
		// code...
		$res = $this->Mmaster->get_masa_kerja_id($id);
		echo json_encode($res);
	}

	public function change_status_masa_kerja($id)
	{
		// code...
		$data_sender 		 = $this->input->post('data_sender');
		$data_masa_kerja = array
						(
							'status_masa_kerja'  	=> $data_sender['status'],
							'tanggal_status'	 		=> $data_sender['tanggal_status']
						);
		$flag = array
				(
					'id' => $id
				);

		$res_data 	 = $this->Allcrud->editData('mr_masa_kerja',$data_masa_kerja,$flag);		
		$text_status = $this->Globalrules->check_status_res($res_data,'Status telah ditambahkan');
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function print_pegawai($kat_posisi=NULL,$es1=NULL,$es2=NULL,$es3=NULL,$es4=NULL)
	{
		# code...
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 300);		
		if ($kat_posisi == '-') {
			# code...
			$kat_posisi = '';
		}

		$data_sender = $this->input->post('data_sender');
		$data_sender = array
						(
							'eselon1'    => $es1,
							'eselon2'    => $es2,
							'eselon3'    => $es3,
							'eselon4'    => $es4,
							'kat_posisi' => $kat_posisi
						);

		$data_eselon_1 = $this->Allcrud->getData('mr_eselon1',array('id_es1'=>$es1))->result_array();
		$data_eselon_2 = $this->Allcrud->getData('mr_eselon2',array('id_es2'=>$es2))->result_array();		
		$data_eselon_3 = $this->Allcrud->getData('mr_eselon3',array('id_es3'=>$es3))->result_array();
		$data_eselon_4 = $this->Allcrud->getData('mr_eselon4',array('id_es4'=>$es4))->result_array();		


		$data_eselon_1 = ($data_eselon_1 != array()) ? $data_eselon_1[0]['nama_eselon1'] : '-' ;
		$data_eselon_2 = ($data_eselon_2 != array()) ? $data_eselon_2[0]['nama_eselon2'] : '-' ;
		$data_eselon_3 = ($data_eselon_3 != array()) ? $data_eselon_3[0]['nama_eselon3'] : '-' ;
		$data_eselon_4 = ($data_eselon_4 != array()) ? $data_eselon_4[0]['nama_eselon4'] : '-' ;						

		$data['list'] = $this->Mmaster->data_pegawai($data_sender,'a.es2 ASC,
																		a.es3 ASC,
																		a.es4 ASC,
																		b.kat_posisi asc,
																		b.atasan ASC');
		if ($data['list'] != 0) {
			# code...
			for ($i=0; $i < count($data['list']); $i++) { 
				# code...
				$get_empty_skp    = $this->mskp->get_counter_empty_target_skp($data['list'][$i]->id,$data['list'][$i]->id_posisi);
				$get_nonempty_skp = $this->mskp->get_counter_nonempty_target_skp($data['list'][$i]->id,$data['list'][$i]->id_posisi);
				$get_approval_skp = $this->mskp->get_counter_approval_skp($data['list'][$i]->id,$data['list'][$i]->id_posisi);								
				if ($get_empty_skp != array()) {
					# code...
					$data['list'][$i]->empty_skp = $get_empty_skp[0]->counter;
				}
				else
				{
					$data['list'][$i]->empty_skp = 0;					
				}

				if ($get_nonempty_skp != array()) {
					# code...
					$data['list'][$i]->nonempty_skp = $get_nonempty_skp[0]->counter;
				}
				else
				{
					$data['list'][$i]->nonempty_skp = 0;					
				}				

				if ($get_approval_skp != array()) {
					# code...
					$data['list'][$i]->approval_skp = $get_approval_skp[0]->counter;
				}
				else
				{
					$data['list'][$i]->approval_skp = 0;					
				}								
			}
		}

		$this->excel->setActiveSheetIndex(0);
		//name the worksheet

		$this->excel->getActiveSheet(1)->getColumnDimension('b')->setWidth('5');
		$this->excel->getActiveSheet(1)->getColumnDimension('c')->setWidth('22');
		$this->excel->getActiveSheet(1)->getColumnDimension('d')->setWidth('44');
		$this->excel->getActiveSheet(1)->getColumnDimension('e')->setWidth('72');
		$this->excel->getActiveSheet(1)->getColumnDimension('f')->setWidth('72');
		$this->excel->getActiveSheet(1)->getColumnDimension('g')->setWidth('20');
		$this->excel->getActiveSheet(1)->getColumnDimension('h')->setWidth('20');

		$this->excel->getActiveSheet(1)->getColumnDimension('j')->setWidth('31');		


		$this->excel->getActiveSheet(2)->setCellValue('b2', 'ESELON I :');
		$this->excel->getActiveSheet(2)->setCellValue('b3', 'ESELON II :');
		$this->excel->getActiveSheet(2)->setCellValue('b4', 'ESELON III :');
		$this->excel->getActiveSheet(2)->setCellValue('b5', 'ESELON IV :');
		
		$this->excel->getActiveSheet(2)->setCellValue('d2', $data_eselon_1);
		$this->excel->getActiveSheet(2)->setCellValue('d3', $data_eselon_2);
		$this->excel->getActiveSheet(2)->setCellValue('d4', $data_eselon_3);
		$this->excel->getActiveSheet(2)->setCellValue('d5', $data_eselon_4);		

		$this->excel->getActiveSheet()->setTitle('Rekapitulasi Pegawai');
		$this->excel->getActiveSheet()->getStyle('b7:h7')->getBorders()->getallborders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->setCellValue('b7', 'NO');
		$this->excel->getActiveSheet(2)->setCellValue('c7', 'NIP');
		$this->excel->getActiveSheet(2)->setCellValue('d7', 'NAMA PEGAWAI');
		$this->excel->getActiveSheet(2)->setCellValue('e7', 'JABATAN');
		$this->excel->getActiveSheet(2)->setCellValue('f7', 'Jabatan Struktural Akdemik');
		$this->excel->getActiveSheet(2)->setCellValue('g7', 'Belum Set Target SKP');
		$this->excel->getActiveSheet(2)->setCellValue('h7', 'Sudah Set Target SKP');
		$this->excel->getActiveSheet(2)->setCellValue('i7', 'Total SKP');
		$this->excel->getActiveSheet(2)->setCellValue('j7', 'Yang Telah diApprove');		
		$this->excel->getActiveSheet(2)->setCellValue('k7', 'Status SKP');																		
		if ($data['list'] != 0) {
		    # code...
		    $counter = "";
		    for ($i=0; $i < count($data['list']); $i++) {
		        # code...
				$counter                = 8 + $i;
				$set_status             = "";

				$total_skp = $data['list'][$i]->empty_skp + $data['list'][$i]->nonempty_skp;
				if($total_skp != 0)
				{
					if ($data['list'][$i]->nonempty_skp == 0) {
						# code...
						$set_status = "Belum set target SKP";
					}
					else
					{
						if ($data['list'][$i]->approval_skp != 0) {
							# code...
							$set_status = "Sudah di approve";															
						}							
						else
						{
							$set_status = "Belum di approve";							
						}													
						// if ($data['list'][$i]->nonempty_skp == $total_skp) {
						// 	# code...
						// 	// if ($data['list'][$i]->approval_skp == $total_skp) {
						// 	// 	# code...
						// 	// 	$set_status = "Seluruh target SKP sudah diisi dan diapprove ";								
						// 	// }							
						// 	// else
						// 	// {
						// 	// 	$set_status = "Telah Mengisi seluruh target SKP";								
						// 	// }
						// }
						// else
						// {
						// 	// $set_status = "Proses Mengisi target SKP";														
						// 	// if ($data['list'][$i]->approval_skp != 0) {
						// 	// 	# code...
						// 	// 	$set_status = "Proses Mengisi target SKP";															
						// 	// }							
						// 	// else
						// 	// {
						// 	// 	$set_status = "Proses Mengisi target SKP";							
						// 	// }							

						// }

					}
				}
				else
				{
					$set_status = "Pegawai Belum Pernah membuka target skp atau SKP tidak tersedia";					
				}


				$this->excel->getActiveSheet(2)->setCellValue('b'.$counter, $i+1);
				$this->excel->getActiveSheet(2)->setCellValue('c'.$counter, '`'.$data['list'][$i]->nip);
				$this->excel->getActiveSheet(2)->setCellValue('d'.$counter, $data['list'][$i]->nama_pegawai);
				$this->excel->getActiveSheet(2)->setCellValue('e'.$counter, $data['list'][$i]->nama_posisi);
				$this->excel->getActiveSheet(2)->setCellValue('f'.$counter, '');
				$this->excel->getActiveSheet(2)->setCellValue('g'.$counter, $data['list'][$i]->empty_skp);
				$this->excel->getActiveSheet(2)->setCellValue('h'.$counter, $data['list'][$i]->nonempty_skp);
				$this->excel->getActiveSheet(2)->setCellValue('i'.$counter, ($data['list'][$i]->empty_skp + $data['list'][$i]->nonempty_skp));				
				$this->excel->getActiveSheet(2)->setCellValue('j'.$counter, $data['list'][$i]->approval_skp);				
				$this->excel->getActiveSheet(2)->setCellValue('k'.$counter, $set_status);
		    }
		}

		ob_clean();

		$filename='Rekapitulasi Pegawai - '.date("d-m-Y").'.xlsx'; //save our workbook as this file name
		//header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type excel 2007
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		exit();
		redirect('master/data_pegawai/', false);		
		// echo "<pre>";
		// print_r($data['list']);die();		
		// echo "</pre>";
	}
}
