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
		//$this->Globalrules->notif_message();
		if ($this->session->userdata('sesPosisi') != '') {
			# code...
			$data['title']                   = '';
			$data['content']                 = 'vdashboard';
			$data['id_posisi']               = $this->session->userdata('sesPosisi');

			$data['belum_diperiksa']         = $this->stat_pekerjaan(0);
			$data['disetujui']               = $this->stat_pekerjaan(1);
			$data['tolak']                   = $this->stat_pekerjaan(2);
			$data['revisi']                  = $this->stat_pekerjaan(3);

			$data['hari_kerja']              = $this->mtrx->get_hari_kerja(date('m'),date('Y'));
			$data['agama']                   = $this->Allcrud->listData('mr_agama')->result_array();
			$data['golongan']                = $this->Allcrud->listData('mr_golongan')->result_array();
			$data['infoPegawai']             = $this->Globalrules->get_info_pegawai();
			$data['info_kompetensi']         = $this->Allcrud->getData('mr_kompetensi',array('id_pegawai'=>$this->session->userdata('sesUser')))->result_array();
			$data['history_golongan']        = $this->mdashboard->get_history_golongan();
			$data['skp']                     = $this->Globalrules->data_summary_skp_pegawai($this->session->userdata('sesUser'),$this->session->userdata('sesPosisi'));
			$data['data_transaksi_rpt']      = $this->mlaporan->get_transact_rpt($this->session->userdata('sesUser'),1,date('m'),date('Y'));
			$data['menit_efektif_dashboard'] = $this->mdashboard->get_data_dashboard(($data['hari_kerja'] != array()) ? ($data['hari_kerja'][0]->jml_hari_aktif*$data['hari_kerja'][0]->jml_menit_perhari) : 0);
			$data['member']                  = $this->Globalrules->list_bawahan($this->session->userdata('sesPosisi'),NULL,'penilaian_skp');
			$data['notify_penilaian_skp']	 = $this->Globalrules->list_bawahan($this->session->userdata('sesUser'),'id_pegawai','penilaian_skp');											
		}
		else
		{
			$data['title']              = '';
			$data['content']            = 'vdashboard_empty';	
		}		

		$this->load->view('templateAdmin',$data);
	}

	public function stat_pekerjaan($arg)
	{
		# code...
		$this->Allcrud->getData('tr_capaian_pekerjaan',array('status_pekerjaan'=>$arg,'id_pegawai'=>$this->session->userdata('sesUser'),'tanggal_mulai LIKE'=>date('Y-m').'%'))->num_rows();		
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
		//$this->Globalrules->notif_message();
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

	public function get_datamodal_fingerprint($oid)
	{
		# code...
		$data['list']  = $this->mtrx->status_pekerjaan($oid,$this->session->userdata('sesUser'));
		$data['title'] = '';
		$data['oid']   = $oid;
		$this->load->view('dashboard/datatable_modal_finger',$data);		
	}

	public function get_datamodal_tunjangan($oid)
	{
		# code...
		$data['list']  = $this->mtrx->status_pekerjaan($oid,$this->session->userdata('sesUser'));
		$data['title'] = '';
		$data['oid']   = $oid;
		$this->load->view('dashboard/datatable_modal_tunjangan',$data);		
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



			// $res_api = "";

			// $curl = curl_init();
			// $data_send = "nip=".$this->session->userdata('sesNip')."&bulan=".date('m')."&tahun=".date('Y')."";
			// curl_setopt_array($curl, array(
			//   CURLOPT_URL => "https://sikerja.kemendagri.go.id/kinerja/index.php/api/kinerja/summary/",
			//   CURLOPT_RETURNTRANSFER => true,
			//   CURLOPT_CUSTOMREQUEST => "POST",
			//   CURLOPT_POSTFIELDS => $data_send,
			//   CURLOPT_HTTPHEADER => array(
			//     "API-AUTH-KEY: f99aecef3d12e02dcbb6260bbdd35189c89e6e73",
			//     "content-type: application/x-www-form-urlencoded",
			//   )
			// ));
			// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);		
	
			

			// $response = curl_exec($curl);
			// $err = curl_error($curl);
			// curl_close($curl);
			// if ($err) 
			// {
			//   echo "cURL Error #:" . $err;
			// } 
			// else
			// {
			// 	$res_api = $response;
			// } 

			// echo $response;
			// die();							
			// $this->Globalrules->sync_data_transaction(array('status_pekerjaan'=>1,'id_pegawai'=>$this->session->userdata('sesUser'),'tanggal_mulai LIKE'=>date('Y-m').'%'),date('m'),date('Y'));