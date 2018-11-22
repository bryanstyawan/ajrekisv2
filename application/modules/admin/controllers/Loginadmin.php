<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Loginadmin extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('mlogin', '', TRUE);
		date_default_timezone_set('Asia/Jakarta');				
	}
	
	public function index()
	{
		// echo CI_VERSION;die();
		error_reporting(E_ALL ^ E_WARNING);				
		$this->load->view('loginAdmin');
	}

	public function test()
	{
		# code...
		echo 'hello world';
	}

	public function login(){
		error_reporting(E_ALL ^ E_WARNING);		
		$nip 		= htmlspecialchars($this->input->post('nip'), ENT_QUOTES| ENT_COMPAT, 'UTF-8');
		$pass 		= htmlspecialchars($this->input->post('password'), ENT_QUOTES| ENT_COMPAT, 'UTF-8');
		$cekUser	= $this->mlogin->cekUser($nip,$pass);
		if ($cekUser != 0) 
		{
			# code...
			$data = array
						(
							'sesUser'     => $cekUser[0]->id,
							'sesSince'    => $cekUser[0]->tgl_gabung,
							'sesFoto'     => $cekUser[0]->photo,
							'sesNama'     => $cekUser[0]->nama_pegawai,
							'sesPassword' => $cekUser[0]->password,
							'sesNip'      => $cekUser[0]->nip,
							'sesIdPos'    => $cekUser[0]->posisi,
							'sesRole'     => $cekUser[0]->id_role,
							'sesEs1'	  => $cekUser[0]->es1,
							'sesEs2'	  => $cekUser[0]->es2,							
							'sesEs3'	  => $cekUser[0]->es3,
							'sesEs4'	  => $cekUser[0]->es4,
							'sesPosisi'	  => $cekUser[0]->posisi,
							'atasan'	  => $cekUser[0]->atasan,
							'tunjangan'	  => $cekUser[0]->tunjangan,
							'grade'		  => $cekUser[0]->grade,
							'login'       => TRUE
						);
			$this->session->set_userdata($data);
			$res = array
			(
				'status' => 1,
				'text'   => 'Verifikasi berhasil'
			);
			echo json_encode($res);
		}
		else
		{
			$res = array
			(
				'status' => 0,
				'text'   => 'Verifikasi user gagal, nip atau password tidak sesuai'
			);
			echo json_encode($res);
		}
	}
	
	public function signout()
	{
		$this->session->sess_destroy();
		redirect('admin/loginadmin');
	}
	
}

