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
		$data['es2']          = $this->Allcrud->getData('mr_eselon2',array('id_es1'=>$this->session->userdata('sesEs1')));
		$data['class_posisi'] = $this->Mmaster->get_posisi_class();
		$data['katpos']       = $this->Allcrud->listData('mr_kat_posisi');
		$data_sender = array
						(
							'eselon1' => $this->session->userdata('sesEs1'), 
							'eselon2' => '', 
							'eselon3' => '', 
							'eselon4' => ''																					
						);			
		$data['list']         = $this->Mmaster->get_struktur_organisasi($data_sender,1);		
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
				else {
					# code...
					$data['list'][$i]->counter_skp = 0;					
				}
			}
		}	
		$this->load->view('templateAdmin',$data);
	}

	public function addStruktur(){
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

	public function editStruktur($id){
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
}