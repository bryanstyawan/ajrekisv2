<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas_Belajar extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
    }
    
    public function tugas_belajar()
	{
		# code...
		$this->Globalrules->session_rule();
		$data['title']   = 'Data Tugas Belajar';
		$data['content'] = 'master/tugas_belajar/data_tugas_belajar';
		$data['list']    = $this->Mmaster->get_data_tugas_belajar();
		$this->load->view('templateAdmin',$data);
	}

	public function add_tugas_belajar()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$check_nip = $this->Mmaster->get_data_pegawai_nip($data_sender['nip']);
		$RES = '';
		if ($check_nip != 0) {
			# code...
			$get_tugas_belajar_pegawai = $this->Mmaster->get_tugas_belajar_pegawai($check_nip[0]->id,'DESC');
			// print_r($get_tugas_belajar_pegawai);die();
			if ($get_tugas_belajar_pegawai != 0)
			{
				$tgl_selesai_tugas = $get_tugas_belajar_pegawai[0]->tgl_selesai;
				if (date('Y-m-d',strtotime($data_sender['tgl_mulai'])) < $tgl_selesai_tugas) 
				{
					$status = array
					(
						'text'   => 'Karyawan masih belum menyelesaikan tugas belajar',
						'status' => '0'
					);
					$RES = $status;	
				}
				else
				{
					$data = array
					(
						'id_pegawai'  => $check_nip[0]->id,
						'tgl_mulai'   => date('Y-m-d',strtotime($data_sender['tgl_mulai'])),
						'tgl_selesai' => date('Y-m-d',strtotime($data_sender['tgl_selesai'])),
						'keterangan'  => $data_sender['keterangan']
					);
					$RES = $this->Allcrud->addData('mr_tugas_belajar',$data);
					if ($RES == TRUE) {
						# code...
						$RES = 1;
					}
				}
			}
			else
			{
				$data = array
					(
						'id_pegawai'  => $check_nip[0]->id,
						'tgl_mulai'   => date('Y-m-d',strtotime($data_sender['tgl_mulai'])),
						'tgl_selesai' => date('Y-m-d',strtotime($data_sender['tgl_selesai'])),
						'keterangan'  => $data_sender['keterangan']
					);
				$RES = $this->Allcrud->addData('mr_tugas_belajar',$data);
				if ($RES == TRUE) {
					# code...
					$RES = 1;
				}
			}
		}
		else
		{
			$status = array
					(
						'text'   => 'NIP tidak ditemukan',
						'status' => 'error'
					);
			$RES = $status;
		}

		echo json_encode($RES);
	}

	public function edit_tugas_belajar_end()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$check_nip = $this->Mmaster->get_data_pegawai_nip($data_sender['nip']);
		$RES = '';
		if ($check_nip != 0) {
			# code...
			$data = array
					(
						'id_pegawai'  => $check_nip[0]->id,
						'tgl_mulai'   => date('Y-m-d',strtotime($data_sender['tgl_mulai'])),
						'tgl_selesai' => date('Y-m-d',strtotime($data_sender['tgl_selesai'])),
						'keterangan'  => $data_sender['keterangan']
					);

			$flag = array(
							'id' => $data_sender['oid']
						);
			$this->Allcrud->editData('mr_tugas_belajar',$data,$flag);
			$RES = 1;
		}
		else
		{
			$status = array
					(
						'text'   => 'NIP tidak ditemukan',
						'status' => 'error'
					);
			$RES = $status;
		}

		echo json_encode($RES);
	}

	public function edit_tugas_belajar($id){
		$this->Globalrules->session_rule();
		$res = $this->Mmaster->get_data_tugas_belajar_id($id);
		if ($res != 0) {
			# code...
			echo json_encode($res[0]);
		}
	}

	public function ajax_tugas_belajar(){
		$data['list']    = $this->Mmaster->get_data_tugas_belajar();
		$this->load->view('master/tugas_belajar/ajax_tugas_belajar',$data);
	}

	public function del_tugas_belajar($id){
		$this->Globalrules->session_rule();
		$flag = array('id' => $id);
		$this->Allcrud->delData('mr_tugas_belajar',$flag);
    }
}