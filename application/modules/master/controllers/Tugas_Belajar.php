<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas_Belajar extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
  }
  
// By Eric
// Last Edited : 20-02-2019
public function index()
	{
			# code...
			$this->Globalrules->session_rule();
			$data['title']   = 'Data Tugas Belajar';
			$data['content'] = 'master/tugas_belajar/data_tugas_belajar';
			$data['list']    = $this->Mmaster->get_data_tugas_belajar();
			$this->load->view('templateAdmin',$data);
	}

// By Eric
// Last Edited : 20-02-2019
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
						$get_tugas_belajar_pegawai = $this->Mmaster->get_tugas_belajar_pegawai($check_nip[0]->id,'DESC');
						$tgl_selesai_tugas = $get_tugas_belajar_pegawai[0]->tgl_selesai;
						if (date('Y-m-d',strtotime($data_sender['tgl_mulai'])) > $tgl_selesai_tugas) 
						{
							$data_store['id_pegawai'] = $check_nip[0]->id;
							$data_store['tgl_mulai'] = date('Y-m-d',strtotime($data_sender['tgl_mulai']));
							$data_store['tgl_selesai'] = date('Y-m-d',strtotime($data_sender['tgl_selesai']));
							$data_store['keterangan'] = $data_sender['keterangan'];
							$res_data       = $this->Allcrud->addData('mr_tugas_belajar',$data_store);
							$text_status    = $this->Globalrules->check_status_res($res_data,'Data Tugas Belajar telah berhasil ditambahkan.');
						}
						else
						{
							$res_data       = '2';
							$text_status    = $this->Globalrules->check_status_res($res_data,'Karyawan masih belum menyelesaikan tugas belajar.');
						}
					}
				} elseif ($data_sender['crud'] == 'update') {
					# code...			
					$data_store['id_pegawai'] = $check_nip[0]->id;
					$data_store['tgl_mulai'] = date('Y-m-d',strtotime($data_sender['tgl_mulai']));
					$data_store['tgl_selesai'] = date('Y-m-d',strtotime($data_sender['tgl_selesai']));
					$data_store['keterangan'] = $data_sender['keterangan'];
					$res_data       = $this->Allcrud->editData('mr_tugas_belajar',$data_store,array('id'=>$data_sender['oid']));
					$text_status    = $this->Globalrules->check_status_res($res_data,'Data Tugas Belajar telah berhasil diubah.');
				} elseif ($data_sender['crud'] == 'delete') {
					# code...
					$res_data    = $this->Allcrud->delData('mr_tugas_belajar',array('id'=>$data_sender['oid']));
					$text_status = $this->Globalrules->check_status_res($res_data,'Data Tugas Belajar telah berhasil dihapus.');
				}

					$res = array
								(
									'status' => $res_data,
									'text'   => $text_status
								);
					echo json_encode($res);		
	}

// By Eric
// Last Edited : 20-02-2019
public function get_data_tugas_belajar($id)
	{
		$this->Globalrules->session_rule();						
		$flag = array('id'=>$id);
		$q    = $this->Allcrud->getData('mr_tugas_belajar',$flag)->result_array();
		$pegawai = $this->Mmaster->get_data_pegawai($q[0]['id_pegawai']);
		$q[0]['nip'] = $pegawai[0]->nip;
		// print_r($q[0]['nip']);die();
		echo json_encode($q);
	}
}