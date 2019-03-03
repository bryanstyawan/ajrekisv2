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
		$data['title']        = 'Struktur Organisasi';
		$data['content']      = 'master/struktur/data_struktur';
		$data['jenis_posisi'] = $this->Allcrud->listData('mr_kat_posisi');
		$data['es1']          = $this->Allcrud->listData('mr_eselon1');
		$data['class_posisi'] = $this->Mmaster->get_posisi_class();
		$data['katpos']       = $this->Allcrud->listData('mr_kat_posisi');
		$this->load->view('templateAdmin',$data);
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
							);
		if ($this->input->post('crud') == 'insert') {
			# code...
			$res_data    = $this->Allcrud->addData('mr_posisi',$add);
			$text_status = $this->Globalrules->check_status_res($res_data,'Data Struktur telah berhasil ditambahkan.');			
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
		if ($data_sender['arg'] == 1) {
			# code...
			$data['list'] = $this->Allcrud->listData('mr_eselon1')->result_array();			
			$this->load->view('master/struktur/eselon/es1',$data);			
		}
		elseif ($data_sender['arg'] == 2) {
			# code...
			$data['list'] = $this->Allcrud->getData('mr_eselon2',array('id_es1'=>$data_sender['es1']))->result_array();						
			$this->load->view('master/struktur/eselon/es2',$data);			
		}
		elseif ($data_sender['arg'] == 3) {
			# code...
			$data['list'] = $this->Allcrud->getData('mr_eselon3',array('id_es1'=>$data_sender['es1'],'id_es2'=>$data_sender['es2']))->result_array();			
			$this->load->view('master/struktur/eselon/es3',$data);			
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

			$this->load->view('master/struktur/eselon/es4',$data);			
		}				
	}

	public function get_atasan()
	{
		# code...
		$this->Globalrules->session_rule();
		$data_var    = "";
		$data_sql    = "";
		$data_sender = $this->input->post('data_sender');
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

		$data['list'] = $data_sql;
		$this->load->view('master/struktur/eselon/atasan',$data);		
	}
}