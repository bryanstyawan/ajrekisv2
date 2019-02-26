<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tunjangan_profesi extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
    
    public function index()
	{
		# code...
		$this->Globalrules->session_rule();
		$data['title']   = 'Data Tunjangan Profesi';
		$data['content'] = 'master/tunjangan_profesi/data_tunjangan_profesi';
		$data['list']    = $this->Mmaster->get_data_tunjangan_profesi();
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

		
		// $data_store        = $this->Globalrules->trigger_insert_update($data_sender['crud']);
		if ($data_sender['crud'] == 'insert') {
			# code...
			$check_nip = $this->Mmaster->get_data_pegawai_nip($data_sender['nip']);
			if ($check_nip != 0) {
				$get_tunjangan_profesi_pegawai = $this->Mmaster->get_tunjangan_profesi_pegawai($check_nip[0]->id,'DESC');
				if ($get_tunjangan_profesi_pegawai != 0) {
					//Declare variable
					$tunjangan_last = $get_tunjangan_profesi_pegawai[0]->tunjangan;
					$tunjangan_input = $data_sender['tunjangan'];

					$tgl_mulai_last = $get_tunjangan_profesi_pegawai[0]->tgl_mulai;
					$tgl_mulai_input = date('Y-m-d',strtotime($data_sender['tgl_mulai']));
					if ($tunjangan_last == $tunjangan_input || $tgl_mulai_last >= $tgl_mulai_input) {
						$res_data       = '2';
						$text_status    = $this->Globalrules->check_status_res($res_data,'Tunjangan sama dengan tunjangan sebelumnya.');
					}
					else {
						$data_last = array
						(
							'tgl_selesai' => date('Y-m-d',strtotime($data_sender['tgl_mulai'] . "-1 days"))
						);
						$flag = array
						(
							'id' => $get_tunjangan_profesi_pegawai[0]->id
						);
						$this->Allcrud->editData('mr_tunjangan_profesi',$data_last,$flag);

						$data_store['id_pegawai'] = $check_nip[0]->id;
						$data_store['tgl_mulai'] = date('Y-m-d',strtotime($data_sender['tgl_mulai']));
						$data_store['tgl_selesai'] = '9999-01-01';
						$data_store['tunjangan'] = $data_sender['tunjangan'];
						$res_data       = $this->Allcrud->addData('mr_tunjangan_profesi',$data_store);
						$text_status    = $this->Globalrules->check_status_res($res_data,'Data Tunjangan Profesi telah berhasil ditambahkan.');
					}
				}
				else {
					$data_store['id_pegawai'] = $check_nip[0]->id;
					$data_store['tgl_mulai'] = date('Y-m-d',strtotime($data_sender['tgl_mulai']));
					$data_store['tgl_selesai'] = '9999-01-01';
					$data_store['tunjangan'] = $data_sender['tunjangan'];
					$res_data       = $this->Allcrud->addData('mr_tunjangan_profesi',$data_store);
					$text_status    = $this->Globalrules->check_status_res($res_data,'Data Tunjangan Profesi telah berhasil ditambahkan.');
				}
			}
		} elseif ($data_sender['crud'] == 'update') {
			# code...	
			$check_nip = $this->Mmaster->get_data_pegawai_nip($data_sender['nip']);		
			$data_store['id_pegawai'] = $check_nip[0]->id;
			$data_store['tgl_mulai'] = date('Y-m-d',strtotime($data_sender['tgl_mulai']));
			$data_store['tgl_selesai'] = '9999-01-01';
			$data_store['tunjangan'] = $data_sender['tunjangan'];
			$res_data       = $this->Allcrud->editData('mr_tunjangan_profesi',$data_store,array('id'=>$data_sender['oid']));
			$text_status    = $this->Globalrules->check_status_res($res_data,'Data Tunjangan Profesi telah berhasil diubah.');
		} elseif ($data_sender['crud'] == 'delete') {
			# code...
			$res_data    = $this->Allcrud->delData('mr_tunjangan_profesi',array('id'=>$data_sender['oid']));
			$text_status = $this->Globalrules->check_status_res($res_data,'Data Tunjangan Profesi telah berhasil dihapus.');
		}

		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}

	public function get_data_tunjangan_profesi($id)
	{
		$this->Globalrules->session_rule();						
		$flag = array('id'=>$id);
		$q    = $this->Allcrud->getData('mr_tunjangan_profesi',$flag)->result_array();
		$pegawai = $this->Mmaster->get_data_pegawai($q[0]['id_pegawai']);
		$q[0]['nip'] = $pegawai[0]->nip;
		// print_r($q[0]['nip']);die();
		echo json_encode($q);
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
			// print_r($get_tunjangan_profesi_pegawai);die();
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
			else
			{
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
				// print_r($get_tunjangan_profesi_pegawai);die();
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
						'tgl_selesai' => '9999-01-01',
						'tunjangan'   => $data_sender['tunjangan']
					);
			
			$flag = array
					(
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