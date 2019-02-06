<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tunjangan_profesi extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
    
    public function tunjangan_profesi()
	{
		# code...
		$this->Globalrules->session_rule();
		$data['title']   = 'Data Tunjangan Profesi';
		$data['content'] = 'master/tunjangan_profesi/data_tunjangan_profesi';
		$data['list']    = $this->Mmaster->get_data_tunjangan_profesi();
		$this->load->view('templateAdmin',$data);
	}

	public function edit_tunjangan_profesi($id)
	{
		# code...
		$this->Globalrules->session_rule();
		$res = $this->Mmaster->get_data_tunjangan_profesi_id($id);
		if ($res != 0) {
			# code...
			echo json_encode($res[0]);
		}
	}

	public function add_tunjangan_profesi()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$check_nip = $this->Mmaster->get_data_pegawai_nip($data_sender['nip']);
		$RES = '';
		if ($check_nip != 0) {
			# code...

			$get_tunjangan_profesi_pegawai = $this->Mmaster->get_tunjangan_profesi_pegawai($check_nip[0]->id,'DESC');
			if ($get_tunjangan_profesi_pegawai != 0)
			{
				# code...
				if ($get_tunjangan_profesi_pegawai[0]->tunjangan == $data_sender['tunjangan'] || $get_tunjangan_profesi_pegawai[0]->tgl_mulai >= date('Y-m-d',strtotime($data_sender['tgl_mulai'])))
				{
					$status = array
					(
						'text'   => 'Tunjangan sama dengan tunjangan sebelumnya',
						'status' => '0'
					);
					$RES = $status;
				}
				else
				{
					$data_last = array
						(
							'tgl_selesai' => date('Y-m-d',strtotime($data_sender['tgl_mulai'] . "-1 days"))
						);
					$flag = array
						(
							'id' => $get_tunjangan_profesi_pegawai[0]->id
						);
					$this->Allcrud->editData('mr_tunjangan_profesi',$data_last,$flag);

					$data = array
					(
						'id_pegawai'  => $check_nip[0]->id,
						'tgl_mulai'   => date('Y-m-d',strtotime($data_sender['tgl_mulai'])),
						'tgl_selesai' => '9999-01-01',
						'tunjangan'   => $data_sender['tunjangan']
					);
					$RES = $this->Allcrud->addData('mr_tunjangan_profesi',$data);
					if ($RES == TRUE) {
						# code...
						$RES = 1;
					}
				}	
			}	
		}
		else
		{
			$status = array
					(
						'text'   => 'NIP tidak ditemukan',
						'status' => '0'
					);
			$RES = $status;
		}

		echo json_encode($RES);
	}

	public function edit_tunjangan_profesi_end()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$check_nip = $this->Mmaster->get_data_pegawai_nip($data_sender['nip']);
		$RES = '';
		if ($check_nip != 0) {
			# code...
			$get_tunjangan_profesi_pegawai = $this->Mmaster->get_tunjangan_profesi_pegawai($check_nip[0]->id,'DESC');
			if ($get_tunjangan_profesi_pegawai != 0)
			{
				# code...
				if (count($get_tunjangan_profesi_pegawai) > 1) {
					# code...
					$data_last = array
								(
									'tgl_selesai' => date('Y-m-d',strtotime($data_sender['tgl_mulai'] . "-1 days"))
								);
					$flag = array(
									'id' => $get_tunjangan_profesi_pegawai[1]->id
								 );
					$this->Allcrud->editData('mr_tunjangan_profesi',$data_last,$flag);
				}
			}

			$data = array
					(
						'id_pegawai'  => $check_nip[0]->id,
						'tgl_mulai'   => date('Y-m-d',strtotime($data_sender['tgl_mulai'])),
						'tgl_selesai' => date('Y-m-d',strtotime($data_sender['tgl_selesai'])),
						'tunjangan'   => $data_sender['tunjangan']
					);

			$flag = array(
							'id' => $data_sender['oid']
						 );
			$this->Allcrud->editData('mr_tunjangan_profesi',$data,$flag);
			$RES = 1;
		}
		else
		{
			$status = array
					(
						'text'   => 'NIP tidak ditemukan',
						'status' => '0'
					);
			$RES = $status;
		}

		echo json_encode($RES);
	}

	public function ajax_tunjangan_profesi()
	{
		# code...
		$data['list']    = $this->Mmaster->get_data_tunjangan_profesi();
		$this->load->view('master/tunjangan_profesi/ajax_tunjangan_profesi',$data);
	}

	public function del_tunjangan_profesi($id)
	{
		# code...
		$this->Globalrules->session_rule();
		$check_nip = $this->Mmaster->get_data_pegawai_nip($data_sender['nip']);
		if ($check_nip != 0) {
			# code...
			$get_tunjangan_profesi_pegawai = $this->Mmaster->get_tunjangan_profesi_pegawai($check_nip[0]->id,'DESC');
			if ($get_tunjangan_profesi_pegawai != 0)
			{
				# code...
				if (count($get_tunjangan_profesi_pegawai) > 1) {
					# code...
					$data_last = array
								(
									'tgl_selesai' => date('Y-m-d',strtotime($data_sender['tgl_mulai'] . "-1 days"))
								);
					$flag = array(
									'id' => $get_tunjangan_profesi_pegawai[1]->id
								);
					$this->Allcrud->editData('mr_tunjangan_profesi',$data_last,$flag);
				}
			}

			$flag = array('id' => $id);
			$this->Allcrud->delData('mr_tunjangan_profesi',$flag);
		}
		else
		{
			$status = array
					(
						'text'   => 'NIP tidak ditemukan',
						'status' => '0'
					);
			$RES = $status;
		}
	}
}