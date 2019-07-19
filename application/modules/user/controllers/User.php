<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{

	public function __construct () 
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');				
	}
	
	public function index()
	{
		$this->Globalrules->session_rule();
		redirect('dashboard/home');
	}

	public function info()
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();		
		$data['title']      		= 'Info Pegawai';		
		$data['subtitle']   		= '';
		$data['content']    		= 'user/profile/data_profile';
		$data['infoPegawai']        = $this->Globalrules->get_info_pegawai();
		// print_r($data['infoPegawai']);die();
		$data['agama']              = $this->Allcrud->listData('mr_agama');
		$data['golongan']           = $this->Allcrud->listData('mr_golongan')->result_array();
		// $data['info_kompetensi']    = $this->Allcrud->getData('mr_kompetensi',array('id_pegawai'=>$this->session->userdata('sesUser')))->result_array();
		$data['history_golongan']   = $this->Globalrules->get_history_golongan();
		$data['history_jabatan']  	= $this->Globalrules->get_history_jabatan();
		$data['history_pendidikan'] = $this->Globalrules->get_history_pendidikan();
		$data['diklat_struktural'] 	= $this->Globalrules->get_history_diklat('1');
		$data['diklat_fungsional'] 	= $this->Globalrules->get_history_diklat('2');
		$data['diklat_teknis'] 		= $this->Globalrules->get_history_diklat('3');
		$data['pendidikan'] 		= $this->Allcrud->listData('mr_pendidikan');
		$data['diklat'] 			= $this->Allcrud->listData('mr_diklat');		
		$this->load->view('templateAdmin',$data);		
	}

	public function get_data_pegawai($id_pegawai){
		$this->Globalrules->session_rule();
		$data['biodata'] = $this->Allcrud->getData('mr_pegawai',array('id'=>$id_pegawai))->result_array();
		if ($data['biodata'] != array()) {
			$data['list_agama']      = $this->Allcrud->getData('mr_agama',array('id_agama'=>$data['biodata'][0]['id_agama']))->result_array();
		}
		echo json_encode($data);
	}

	public function get_data_pendidikan($id_pegawai){
		$this->Globalrules->session_rule();
		$data['pendidikan'] = $this->Allcrud->getData('mr_history_pendidikan',array('id'=>$id_pegawai))->result_array();
		if ($data['pendidikan'] != array()) {
			$data['list_pendidikan']      = $this->Allcrud->getData('mr_pendidikan',array('id_pendidikan'=>$data['pendidikan'][0]['id_pendidikan']))->result_array();
		}
		echo json_encode($data);
	}

	public function get_data_diklat($id_pegawai){
		$this->Globalrules->session_rule();
		$data['diklat'] = $this->Allcrud->getData('mr_history_diklat',array('id'=>$id_pegawai))->result_array();
		if ($data['diklat'] != array()) {
			$data['list_diklat']      = $this->Allcrud->getData('mr_diklat',array('id_diklat'=>$data['diklat'][0]['id_diklat']))->result_array();
		}
		echo json_encode($data);
	}

	public function store_profile($arg=NULL,$oid=NULL)
	{
		$res_data    = 0;
		$text_status = "";
		$data_sender = array();
		if ($arg == NULL) {
			$data_sender = $this->input->post('data_sender');
		}
		else {
			$data_sender['crud'] = $arg;
			$data_sender['oid']  = $oid;
		}
		
		// print_r($data_sender);die();
		if ($data_sender['crud'] != 'delete') {
			// $data_store['id'] 		= $this->session->userdata('sesUser');
			$data_store['nama_pegawai'] 	= $data_sender['nama_pegawai'];
			$data_store['TempatLahir'] 		= $data_sender['TempatLahir'];
			$data_store['BirthDate'] 		= $data_sender['BirthDate'];
			$data_store['Gender'] 			= $data_sender['Gender'];
			$data_store['id_agama'] 		= $data_sender['id_agama'];
			$data_store['no_hp'] 			= $data_sender['no_hp'];
			$data_store['email'] 			= $data_sender['email'];
			$data_store['alamat'] 			= $data_sender['alamat'];
			$data_store['audit_time'] 		= date('Y-m-d H:i:s');
			$data_store['audit_user'] 		= $this->session->userdata('sesUser');

			if ($data_sender['crud'] == 'insert') {
				$res_data       = $this->Allcrud->addData('mr_pegawai',$data_store);
				$text_status 	= $this->Globalrules->check_status_res($res_data,'Data Pegawai telah berhasil ditambah.');
			}
			elseif ($data_sender['crud'] == 'update') {
				$res_data    = $this->Allcrud->editData('mr_pegawai',$data_store,array('id'=>$data_sender['oid']));
				$text_status = $this->Globalrules->check_status_res($res_data,'Data Pegawai telah berhasil diubah.');
			}								
		}
		else {
			if ($data_sender['crud'] == 'delete') {
				
				$res_data    = $this->Allcrud->delData('mr_pegawai',array('id' => $data_sender['oid']));				
				$text_status = $this->Globalrules->check_status_res($res_data,'Data Pegawai telah berhasil dihapus.');											
			}				
		}
		$res = array
				(
					'status' => $res_data,
					'text'   => $text_status
				);
		// print_r($res);die();
		echo json_encode($res);											
	}
	
	public function store_pendidikan($arg=NULL,$oid=NULL)
	{
		$res_data    = 0;
		$text_status = "";
		$data_sender = array();
		if ($arg == NULL) {
			$data_sender = $this->input->post('data_sender');
		}
		else {
			$data_sender['crud'] = $arg;
			$data_sender['oid']  = $oid;
		}
		
		// print_r($data_sender['crud']);die();
		if ($data_sender['crud'] != 'delete') {
			$data_store['id_pegawai'] 		= $this->session->userdata('sesUser');
			$data_store['id_pendidikan'] 	= $data_sender['id_pendidikan'];
			$data_store['jurusan'] 			= $data_sender['jurusan'];
			$data_store['nama_sekolah'] 	= $data_sender['nama_sekolah'];
			$data_store['lokasi_sekolah'] 	= $data_sender['lokasi_sekolah'];
			$data_store['tahun_lulus'] 		= $data_sender['tahun_lulus'];
			$data_store['audit_time'] 		= date('Y-m-d H:i:s');
			$data_store['audit_user'] 		= $this->session->userdata('sesUser');

			if ($data_sender['crud'] == 'insert') {
				$res_data       = $this->Allcrud->addData('mr_history_pendidikan',$data_store);
				$text_status 	= $this->Globalrules->check_status_res($res_data,'Data Pendidikan telah berhasil ditambah.');
			}
			elseif ($data_sender['crud'] == 'update') {
				$res_data    = $this->Allcrud->editData('mr_history_pendidikan',$data_store,array('id'=>$data_sender['oid']));
				$text_status = $this->Globalrules->check_status_res($res_data,'Data Pendidikan telah berhasil diubah.');
			}								
		}
		else {
			if ($data_sender['crud'] == 'delete') {
				
				$res_data    = $this->Allcrud->delData('mr_history_pendidikan',array('id' => $data_sender['oid']));				
				$text_status = $this->Globalrules->check_status_res($res_data,'Data Pendidikan telah berhasil dihapus.');											
			}				
		}
		$res = array
				(
					'status' => $res_data,
					'text'   => $text_status
				);
		// print_r($res);die();
		echo json_encode($res);											
	}

	public function store_diklat($arg=NULL,$oid=NULL)
	{
		$res_data    = 0;
		$text_status = "";
		$data_sender = array();
		if ($arg == NULL) {
			$data_sender = $this->input->post('data_sender');
		}
		else {
			$data_sender['crud'] = $arg;
			$data_sender['oid']  = $oid;
		}
		
		// print_r($data_sender['crud']);die();
		if ($data_sender['crud'] != 'delete') {
			$data_store['id_pegawai'] 		= $this->session->userdata('sesUser');
			$data_store['id_diklat'] 		= $data_sender['id_diklat'];
			$data_store['nama_diklat'] 		= $data_sender['nama_diklat'];
			$data_store['tempat'] 			= $data_sender['tempat'];
			$data_store['panitia'] 			= $data_sender['panitia'];
			$data_store['tgl_mulai'] 		= $data_sender['tgl_mulai'];
			$data_store['tgl_selesai'] 		= $data_sender['tgl_selesai'];
			$data_store['audit_time'] 		= date('Y-m-d H:i:s');
			$data_store['audit_user'] 		= $this->session->userdata('sesUser');

			if ($data_sender['crud'] == 'insert') {
				$res_data       = $this->Allcrud->addData('mr_history_diklat',$data_store);
				$text_status 	= $this->Globalrules->check_status_res($res_data,'Data Diklat telah berhasil ditambah.');
			}
			elseif ($data_sender['crud'] == 'update') {
				$res_data    = $this->Allcrud->editData('mr_history_diklat',$data_store,array('id'=>$data_sender['oid']));
				$text_status = $this->Globalrules->check_status_res($res_data,'Data Diklat telah berhasil diubah.');
			}								
		}
		else {
			if ($data_sender['crud'] == 'delete') {
				
				$res_data    = $this->Allcrud->delData('mr_history_diklat',array('id' => $data_sender['oid']));				
				$text_status = $this->Globalrules->check_status_res($res_data,'Data Diklat telah berhasil dihapus.');											
			}				
		}
		$res = array
				(
					'status' => $res_data,
					'text'   => $text_status
				);
		// print_r($res);die();
		echo json_encode($res);											
	}
	
	public function change_password()
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();		
		$data['title']      = 'Ubah Password';		
		$data['subtitle']   = '';
		$data['content']    = 'user/change_password/index';
		$this->load->view('templateAdmin',$data);		
	}	

	public function do_change_password()
	{
		# code...
		$this->Globalrules->session_rule();		
		$res_data     = "";
		$text_status  = "";
		$pass_lama    = $this->input->post('pass_lama');
		$pass_baru    = $this->input->post('pass_baru');
		$re_pass_baru =	$this->input->post('re_pass_baru');
		$nip          = $this->session->userdata('sesNip');
		$id           = $this->session->userdata('sesUser');
		
		$cekUser      = $this->mlogin->cekUser($nip,$pass_lama);
		if ($cekUser != 0) 
		{		
			$data_change = array
							(
								'password'            => md5($re_pass_baru) 
							);		
			$flag        = array('id'=>$id);
			$res_data    = $this->Allcrud->editData('mr_pegawai',$data_change,$flag);					
			$text_status = "Password telah diubah";
			if ($res_data != 1) {
				# code...
				$text_status = "Telah terjadi kesalahan sistem";
			}
		}
		else
		{
			$res_data    = 0;
			$text_status = "Password Lama tidak sesuai";

		}

		$res = array
					(
						'status' => $res_data, 
						'text'   => $text_status
					);

		echo json_encode($res);										

	}	
}