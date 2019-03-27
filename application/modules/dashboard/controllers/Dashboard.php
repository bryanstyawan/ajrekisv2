<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('mdashboard', '', TRUE);
		$this->load->model ('transaksi/mtrx', '', TRUE);		
		$this->load->model ('laporan/mlaporan', '', TRUE);
		date_default_timezone_set('Asia/Jakarta');
	}

	public function home()
	{
		error_reporting(E_ALL ^ E_WARNING);
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		// print_r($this->session->userdata('sesPosisi'));die();
		if ($this->session->userdata('sesPosisi') != '') {
			# code...
<<<<<<< HEAD
			$this->Globalrules->sync_data_transaction(array('status_pekerjaan'=>1,'id_pegawai'=>$this->session->userdata('sesUser'),'tanggal_mulai LIKE'=>date('Y-m').'%'));
=======
			$this->Globalrules->sync_data_transaction(array('status_pekerjaan'=>1,'id_pegawai'=>$this->session->userdata('sesUser'),'tanggal_selesai LIKE'=>date('Y-m').'%'));			
>>>>>>> f1fcf736822361b76cf1ddd0421da98b07593822
			$data['title']              = '';
			$data['content']            = 'vdashboard';
			$data['belum_diperiksa']    = $this->Allcrud->getData('tr_capaian_pekerjaan',array('status_pekerjaan'=>0,'id_pegawai'=>$this->session->userdata('sesUser'),'tanggal_mulai LIKE'=>date('Y-m').'%'))->num_rows();
			$data['disetujui']          = $this->Allcrud->getData('tr_capaian_pekerjaan',array('status_pekerjaan'=>1,'id_pegawai'=>$this->session->userdata('sesUser'),'tanggal_mulai LIKE'=>date('Y-m').'%'))->num_rows();
			$data['tolak']              = $this->Allcrud->getData('tr_capaian_pekerjaan',array('status_pekerjaan'=>2,'id_pegawai'=>$this->session->userdata('sesUser'),'tanggal_mulai LIKE'=>date('Y-m').'%'))->num_rows();
			$data['revisi']             = $this->Allcrud->getData('tr_capaian_pekerjaan',array('status_pekerjaan'=>3,'id_pegawai'=>$this->session->userdata('sesUser'),'tanggal_mulai LIKE'=>date('Y-m').'%'))->num_rows();
			$data['agama']              = $this->Allcrud->listData('mr_agama')->result_array();
			$data['golongan']           = $this->Allcrud->listData('mr_golongan')->result_array();
			$data['infoPegawai']        = $this->Globalrules->get_info_pegawai();
			$data['info_kompetensi']    = $this->Allcrud->getData('mr_kompetensi',array('id_pegawai'=>$this->session->userdata('sesUser')))->result_array();
			$data['history_golongan']   = $this->mdashboard->get_history_golongan();
			$data['skp']                = $this->Globalrules->data_summary_skp_pegawai($this->session->userdata('sesUser'),$this->session->userdata('sesPosisi'));
			$data['data_transaksi']     = $this->mlaporan->get_transact($this->session->userdata('sesUser'),1,date('m'),date('Y'));
			if ($data['data_transaksi']) {
				# code...
				$get_data = $this->Allcrud->getData('tr_pengurangan_tunjangan',array('id_pegawai'=>$this->session->userdata('sesUser'),'tahun'=> date('Y'),'bulan'=>date('m')))->result_array();			
				if ($get_data != array()) {
					# code...
					$data['data_transaksi'][0]->persentase_potongan    = $get_data[0]['persentase'];
						  $real_tunjangan_kinerja                      = $data['data_transaksi'][0]->real_tunjangan_kinerja - ($data['data_transaksi'][0]->real_tunjangan_kinerja*($data['data_transaksi'][0]->persentase_potongan/100));
					$data['data_transaksi'][0]->real_tunjangan_kinerja = $real_tunjangan_kinerja;
				}
				else
				{
	
				}
			}
	
			$data['menit_efektif_year'] = $this->mlaporan->get_menit_efektif_year($this->session->userdata('sesUser'));
			$data['member']               = $this->Globalrules->list_bawahan($this->session->userdata('sesPosisi'));		
			if ($data['member'] != 0) {
				// code...
				for ($i=0; $i < count($data['member']); $i++) {
					// code...
					$get_data = $this->Allcrud->getData('tr_pengurangan_tunjangan',array('id_pegawai'=>$data['member'][$i]->id,'tahun'=> date('Y'),'bulan'=>date('m')))->num_rows();
					if ($get_data) {
						// code...
						$data['member'][$i]->counter_belum_diperiksa = $get_data;
					}
					else {
						// code...
						$data['member'][$i]->counter_belum_diperiksa = 0;
					}
				}
			}					
		}
		else
		{
			$data['title']              = '';
			$data['content']            = 'vdashboard_empty';			
		}		

		$this->load->view('templateAdmin',$data);
	}

	public function delete_common_notify($param=NULL)
	{
		# code...
		$data_notify = $this->mdashboard->get_data_notify_user($param,$this->session->userdata('sesUser'));
		if (count($data_notify) != 0) {
			# code...
			for ($i=0; $i < count($data_notify); $i++) {
				# code...
				$data_change = array(
					'status_read' => 1
				);
				$flag        = array('id'=>$data_notify[$i]->id);
				$res_data    = $this->Allcrud->editData('log_notifikasi',$data_change,$flag);
			}
		}
	}

	public function load_data_dashboard($stat=NULL)
	{
		# code...
		$id_pegawai   = $this->session->userdata('sesUser');
		$data['list'] = $this->Allcrud->getData('tr_capaian_pekerjaan',array('stat'=>$stat,'id_pegawai'=>$this->session->userdata('sesUser'),'tgl_selesai LIKE'=>date('Y-m').'%'))->result_array();
		$this->load->view('dashboard/ajax_stat_kinerja',$data);
	}

	public function update_profile()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$data        = array
						(
							'email'        => $data_sender['email'],
							'no_hp'        => $data_sender['no_hp'],
							'alamat'       => $data_sender['alamat'],
							'id_agama'     => $data_sender['agama'],
							'golongan'     => $data_sender['golongan'],
							'tmt_golongan' => $data_sender['tmt_golongan']
						);
		$flag 		 = array
						(
							'id' => $this->session->userdata('sesUser')
						);
		$res_data       = $this->Allcrud->editData('mr_pegawai',$data,$flag);
		$check_golongan = $this->Allcrud->getData('mr_history_golongan',array('id_golongan'=>$data_sender['golongan'],'id_pegawai'=>$this->session->userdata('sesUser')))->result_array();
		if ($check_golongan == array()) {
			# code...
			$data        = array
							(
								'id_pegawai'  => $this->session->userdata('sesUser'),
								'id_golongan' => $data_sender['golongan'],
								'tmt'         => $data_sender['tmt_golongan']
							);
			$this->Allcrud->addData('mr_history_golongan',$data);			
		}
		$text_status    = $this->Globalrules->check_status_res($res_data,'Profil pegawai telah diubah');
		$res            = array
						(
							'status' => $res_data,
							'text'   => $text_status
						);
		echo json_encode($res);		
	}

	public function update_kompetensi()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$data        = array
						(
							'id_pegawai' => $this->session->userdata('sesUser'),
							'kompetensi' => $data_sender['kompetensi'],
							'keterangan' => $data_sender['keterangan']
						);
		$res_data       = $this->Allcrud->addData('mr_kompetensi',$data);
		$text_status    = $this->Globalrules->check_status_res($res_data,'Kompetensi telah ditambahkan.');
		$res            = array
						(
							'status' => $res_data,
							'text'   => $text_status
						);
		echo json_encode($res);				
	}

	public function get_delete_kompetensi($id)
	{
		# code...
		$flag     = array('id' => $id);
		$res_data = $this->Allcrud->delData('mr_kompetensi',$flag);
		$text_status    = $this->Globalrules->check_status_res($res_data,'Kompetensi telah dihapus.');
		$res            = array
						(
							'status' => $res_data,
							'text'   => $text_status
						);
		echo json_encode($res);						
	}	

	public function view_notification(Type $var = null)
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$data['title']   = 'Lihat Semua Pemberitahuan';
		$data['list']    = $this->Allcrud->getData('log_notifikasi',array('receiver'=>$this->session->userdata('sesUser')));
		$data['content'] = 'dashboard/notification/view_all';
		$this->load->view('templateAdmin',$data);
	}

	public function get_datamodal_transaksi($oid)
	{
		# code...
		$data['list']  = $this->mtrx->status_pekerjaan($oid,$this->session->userdata('sesUser'));
		$data['title'] = '';
		$data['oid']   = $oid;
		$this->load->view('dashboard/datatable_modal',$data);		
	}

	public function post_penilaian_skp_bulan($arg,$oid)
	{
		# code...
		$res_data = 0;
		$getdata  = $this->Allcrud->getData('tr_pengurangan_tunjangan',array('id_pegawai'=>$oid,'tahun'=>date('Y'),'bulan'=>date('m')))->result_array();
		$persentase = '0';
		if ($arg == 'no') {
			# code...
			$persentase = '5';
		}
		else {
			# code...
			$persentase = '0';			
		}
		$data = array
					(
						'id_pegawai' => $oid,
						'tahun'      => date('Y'),
						'bulan'      => date('m'),
						'persentase' => $persentase
					);
		if ($getdata == array()) {
			# code...
			$res_data = $this->Allcrud->addData('tr_pengurangan_tunjangan',$data);
		}							
		else {
			# code...
			$flag = array
			(
				'id_pegawai' => $oid,
				'tahun'      => date('Y'),
				'bulan'      => date('m')
			);
			$res_data    = $this->Allcrud->editData('tr_pengurangan_tunjangan',$data,$flag);			
		}

		$text_status    = $this->Globalrules->check_status_res($res_data,'Penilaian SKP Bulanan untuk pegawai ini telah dilakukan');
		$res            = array
						(
							'status' => $res_data,
							'text'   => $text_status
						);
		echo json_encode($res);		
	}

	public function soon()
	{
		# code...
		$this->Globalrules->session_rule();
		$data['title']   = '';
		$data['content'] = 'dashboard/soon/index';
		$this->load->view('templateAdmin',$data);		
	}	
}
