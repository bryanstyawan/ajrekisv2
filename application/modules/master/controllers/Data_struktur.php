<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_struktur extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
	
	public function index()
	{
		$this->Globalrules->session_rule();								
		$this->Globalrules->user_access_read();		
		$data['title']        = 'Struktur Organisasi';
		$data['content']      = 'master/struktur/data_struktur';
		$data['jenis_posisi'] = $this->Allcrud->listData('mr_kat_posisi');
		$data['es1']          = $this->Allcrud->listData('mr_eselon1');
		$data['class_posisi'] = $this->Mmaster->get_posisi_class();
		$data['katpos']       = $this->Allcrud->listData('mr_kat_posisi');
		$this->load->view('templateAdmin',$data);
	}

	public function filter_struktur_org($param=NULL)
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$data_sender = array
						(
							'eselon1'    => $data_sender['data_1'],
							'eselon2'    => $data_sender['data_2'],
							'eselon3'    => $data_sender['data_3'],
							'eselon4'    => $data_sender['data_4'],
							'kat_posisi' => $data_sender['data_5']
						);
		$data['param'] = "";
		if ($param != NULL) {
			# code...
			$data['param'] = $param;
		}
		$data['list'] = $this->Mmaster->get_struktur_organisasi($data_sender,$data_sender['kat_posisi']);
		if ($data['list'] != 0) {
			# code...
			for ($i=0; $i < count($data['list']); $i++) {
				# code...
				if($data['list'][$i]->kat_posisi == 1)
				{
					$get_summary_urtug = $this->mskp->get_summary_master_skp($data['list'][$i]->id);
					if ($get_summary_urtug != 0) {
						# code...
						$data['list'][$i]->counter_skp = $get_summary_urtug;
					}
					else
					{
						$data['list'][$i]->counter_skp = 0;
					}
				}
				elseif ($data['list'][$i]->kat_posisi == 2) {
					# code...
					$get_data = $this->Allcrud->getData('mr_jabatan_fungsional_tertentu_uraian_tugas',array('id_jft' => $data['list'][$i]->id_jft));
					if($get_data->result_array() != array())
					{					
						$data['list'][$i]->counter_skp = count($get_data->result_array());
					}
					else {	
						# code...
						$data['list'][$i]->counter_skp = 0;
					}					
				}
				elseif ($data['list'][$i]->kat_posisi == 4) {
					# code...
					$get_data = $this->Allcrud->getData('mr_jabatan_fungsional_umum_uraian_tugas',array('id_jfu' => $data['list'][$i]->id_jfu));
					if($get_data->result_array() != array())
					{					
						$data['list'][$i]->counter_skp = count($get_data->result_array());
					}
					else {	
						# code...
						$data['list'][$i]->counter_skp = 0;
					}					
				}				
				elseif($data['list'][$i]->kat_posisi == 6)
				{
					$get_summary_urtug = $this->mskp->get_summary_master_skp($data['list'][$i]->id);
					if ($get_summary_urtug != 0) {
						# code...
						$data['list'][$i]->counter_skp = $get_summary_urtug;
					}
					else
					{
						$data['list'][$i]->counter_skp = 0;
					}
				}				
				else {
					# code...
					$data['list'][$i]->counter_skp = 0;					
				}
			}
		}			
		$this->load->view('master/struktur/ajax_Struktur',$data);
	}	
	
	public function store(){
		$this->Globalrules->session_rule();							
		$res_data    = "";
		$text_status = "";
		$add         = array(
								'eselon1'      => $this->input->post('es1'),
								'eselon2'      => $this->input->post('es2'),
								'eselon3'      => $this->input->post('es3'),
								'eselon4'      => $this->input->post('es4'),
								'atasan'       => $this->input->post('atasan'),
								'kat_posisi'   => $this->input->post('kat'),
								'posisi_class' => $this->input->post('grade'),
								'nama_posisi'  => strtoupper($this->input->post('jabatan')),
								'id_jfu'       => $this->input->post('id_jfu'),
								'id_jft'       => $this->input->post('id_jft'),	
								'audit_time' => date('Y-m-d H:i:s'), 
								'audit_user' => $this->session->userdata('sesNip')		
							);
		if ($this->input->post('crud') == 'insert') {
			# code...
			$verify_jabatan = "";
			$is_valid       = "";
			if ($this->input->post('kat') != 1 && $this->input->post('kat') != 6) {
				# code...
				$valid         = array(
					'eselon1'      => $this->input->post('es1'),
					'eselon2'      => $this->input->post('es2'),
					'eselon3'      => $this->input->post('es3'),
					'eselon4'      => $this->input->post('es4'),
					'atasan'       => $this->input->post('atasan'),					
					'kat_posisi'   => $this->input->post('kat'),
					'id_jfu'       => $this->input->post('id_jfu'),
					'id_jft'       => $this->input->post('id_jft')			
				);			
				$verify_jabatan = $this->Allcrud->getData('mr_posisi',$valid)->result_array();
			}			
			else {
				# code...
				$valid         = array(
					'eselon1'      => $this->input->post('es1'),
					'eselon2'      => $this->input->post('es2'),
					'eselon3'      => $this->input->post('es3'),
					'eselon4'      => $this->input->post('es4'),
					'nama_posisi'  => strtoupper($this->input->post('jabatan')),					
					'kat_posisi'   => $this->input->post('kat')			
				);			
				$verify_jabatan = $this->Allcrud->getData('mr_posisi',$valid)->result_array();				
			}

			if ($verify_jabatan != array()) {
				# code...
				$res_data    = 0;
				$text_status = "Jabatan Telah ada";				
			}
			else
			{
				$res_data    = $this->Allcrud->addData('mr_posisi',$add);
				$text_status = $this->Globalrules->check_status_res($res_data,'Data Struktur telah berhasil ditambahkan.');
			}
			// $valid_like = array('nama_posisi'=>strtoupper($this->input->post('jabatan')));			
		}
		else {
			# code...
			$flag = array('id'=>$this->input->post('oid'));			
			$res_data    = $this->Allcrud->editData('mr_posisi',$add,$flag);
			$text_status = $this->Globalrules->check_status_res($res_data,'Data Struktur telah berhasil diubah.');			
		}

		$res         = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);								
	}

	public function cari_atasan_baru()
	{
		$this->Globalrules->session_rule();
		$data_var = "";
		$data_sql = "";
		if($this->input->post('kat') == 1 || $this->input->post('nkat') == 1)
		{
			$data_var = array(
							'eselon4'    => $this->input->post('es4'),
							'eselon3'    => $this->input->post('es3'),
							'eselon2'    => $this->input->post('es2'),
							'eselon1'    => $this->input->post('es1'),
							'kat_posisi' => $this->input->post('kat')
						);
			$data_sql = $this->Mmaster->cari_atasan_STRUKTURAL($data_var);

		}
		elseif($this->input->post('kat') == 4 || $this->input->post('nkat') == 4)
		{
			$data_var = array(
							'eselon4'    => $this->input->post('es4'),
							'kat_posisi' => $this->input->post('kat')
						);
			$data_sql = $this->Mmaster->cari_atasan_FUNGSIONAL($data_var);
		}
		elseif($this->input->post('kat') == 2 || $this->input->post('nkat') == 2)
		{
			$data_var = array(
							'eselon2'    => $this->input->post('es2'),
							'kat_posisi' => $this->input->post('kat')
						);
			$data_sql = $this->Mmaster->cari_atasan_FUNGSIONAL_TERTENTU($data_var);
		}
		$data['atasan'] = $data_sql;
		$this->load->view('master/struktur/ajaxAtasan',$data);
	}	

	// By Bryan
	// Last Edited : 2019-02-21
	public function get_data_organisasi($id){
		$this->Globalrules->session_rule();								
		$flag = array('id'=>$id);
		$data = $this->Mmaster->get_posisi_struktur($id);
		echo json_encode($data[0]);
	}

	public function delStruktur($id){
		$this->Globalrules->session_rule();							
		$flag        = array('id' => $id);
		$res_data    = $this->Allcrud->delData('mr_posisi',$flag);
		$text_status = $this->Globalrules->check_status_res($res_data,'Data Struktur telah berhasil dihapus.');
		$res         = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);								
	}	

	public function ajaxStruktur($id=NULL){
		$this->Globalrules->session_rule();								
		$data['es1']= $this->Allcrud->listData('mr_eselon1');
		$data['katpos']= $this->Allcrud->listData('mr_kat_posisi');
		$data_sender = array
						(
							'eselon1' => $this->session->userdata('sesEs1'), 
							'eselon2' => '', 
							'eselon3' => '', 
							'eselon4' => ''																					
						);			
		$data['list']         = $this->Mmaster->get_struktur_organisasi($data_sender);
		$this->load->view('master/struktur/ajaxCariStruktur',$data);
	}	

	public function get_emp_from_org($id)
	{
		$data['header'] = $this->Allcrud->getData('mr_posisi',array('id'=>$id))->result_array();
		$data['list']   = $this->Allcrud->getData('mr_pegawai',array('posisi'=>$id))->result_array();
		$this->load->view('master/struktur/ajax_emp_in_org',$data);		
	}

	public function lepas_jabatan($id)
	{
		$add         = array(
			'posisi'      => ''
		);		
		$flag = array('id'=>$id);			
		$res_data    = $this->Allcrud->editData('mr_pegawai',$add,$flag);
		$text_status = $this->Globalrules->check_status_res($res_data,'Jabatan telah dilepas.');		
		$res         = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);										
	}

	public function get_struktur_eselon()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$data = array();
		if ($data_sender['arg'] == 1) {
			# code...
			$data['list'] = $this->Allcrud->listData('mr_eselon1')->result_array();			
			// $this->load->view('master/struktur/eselon/es1',$data);			
		}
		elseif ($data_sender['arg'] == 2) {
			# code...
			$data['list'] = $this->Allcrud->getData('mr_eselon2',array('id_es1'=>$data_sender['es1']))->result_array();						
			// $this->load->view('master/struktur/eselon/es2',$data);			
		}
		elseif ($data_sender['arg'] == 3) {
			# code...
			$data['list'] = $this->Allcrud->getData('mr_eselon3',array('id_es1'=>$data_sender['es1'],'id_es2'=>$data_sender['es2']))->result_array();			
			// $this->load->view('master/struktur/eselon/es3',$data);			
		}
		elseif ($data_sender['arg'] == 4) {
			# code...
			if ($data_sender['es3'] == '') {
				# code...
				$data['list'] = $this->Allcrud->getData('mr_eselon4',array('id_es2'=>$data_sender['es2']))->result_array();				
			}
			else
			{
				$data['list'] = $this->Allcrud->getData('mr_eselon4',array('id_es3'=>$data_sender['es3']))->result_array();				
			}

			// $this->load->view('master/struktur/eselon/es4',$data);			
		}				

		echo json_encode($data);
	}

	public function get_atasan($arg)
	{
		# code...
		$this->Globalrules->session_rule();
		$data_var    = "";
		$data_sql    = "";
		$data_sender = $this->input->post('data_sender');
		// print_r($arg);die();
		if ($arg == 'null') {
			# code...
			if($data_sender['kat'] == 1)
			{
				$data_var = array(
								'eselon4'    => $data_sender['es4'],
								'eselon3'    => $data_sender['es3'],
								'eselon2'    => $data_sender['es2'],
								'eselon1'    => $data_sender['es1'],
								'kat_posisi' => $data_sender['kat']
							);
				$data_sql = $this->Mmaster->cari_atasan_STRUKTURAL($data_var);

			}
			elseif($data_sender['kat'] == 4)
			{
				if ($data_sender['es3'] == '') {
					# code...
					$data_var = array(
						'eselon2'    => $data_sender['es2'],
						'eselon3'    => $data_sender['es3'],					
						'kat_posisi' => $data_sender['kat']
					);				
				}
				else
				{
					$data_var = array(
						'eselon4'    => $data_sender['es4'],
						'eselon3'    => $data_sender['es3'],					
						'kat_posisi' => $data_sender['kat']
					);
				}

				$data_sql = $this->Mmaster->cari_atasan_FUNGSIONAL($data_var);
			}
			elseif($data_sender['kat'] == 2)
			{
				$data_var = array(
								'eselon2'    => $data_sender['es2'],
								'kat_posisi' => $data_sender['kat']
							);
				$data_sql = $this->Mmaster->cari_atasan_FUNGSIONAL_TERTENTU($data_var);
			}
			elseif($data_sender['kat'] == 6)
			{
				$data_var = array(
								'eselon4'    => $data_sender['es4'],
								'eselon3'    => $data_sender['es3'],
								'eselon2'    => $data_sender['es2'],
								'eselon1'    => $data_sender['es1'],
								'kat_posisi' => 1
							);
				$data_sql = $this->Mmaster->cari_atasan_STRUKTURAL($data_var);
			}			
		}
		else
		{
			$data_var = array(
							'eselon4'    => $data_sender['es4'],
							'eselon3'    => $data_sender['es3'],
							'eselon2'    => $data_sender['es2'],
							'eselon1'    => $data_sender['es1'],
							'kat_posisi' => $data_sender['kat']
						);
			$data_sql = $this->Mmaster->cari_atasan_all($data_var);
		}


		$data['list'] = $data_sql;
		if ($data['list'] != 0) {
			# code...
			for ($i=0; $i < count($data['list']); $i++) { 
				# code...
				$data_pegawai = $this->Globalrules->get_info_pegawai($data['list'][$i]->id,'posisi');				
				if ($data_pegawai != 0) {
					# code...
					$data['list'][$i]->nama_pegawai = $data_pegawai[0]->nama_pegawai;					
				}
				else
				{
					$data['list'][$i]->nama_pegawai = "-";					
				}
			}
		}
		
		echo json_encode($data);
	}
}