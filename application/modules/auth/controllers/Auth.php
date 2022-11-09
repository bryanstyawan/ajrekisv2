<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('mlogin', '', TRUE);
		//$this->load->model ('talenta/mtalenta', '', TRUE);
		date_default_timezone_set('Asia/Jakarta');				
	}
	
	public function index()
	{				
		$this->load->view('auth');
	}

	public function login(){
		error_reporting(E_ALL ^ E_WARNING);		
		$nip 		= htmlspecialchars($this->input->post('nip'), ENT_QUOTES| ENT_COMPAT, 'UTF-8');
		$pass 		= htmlspecialchars($this->input->post('password'), ENT_QUOTES| ENT_COMPAT, 'UTF-8');
		$cekUser	= $this->mlogin->cekUser($nip,$pass);
		//$survey = 0;
		if ($cekUser != 0) 
		{
			# code...
			$tunjangan   = "";
			$grade       = "";
			$nama_posisi = "";

			if ($cekUser[0]->kat_posisi == 1) {
				# code...
				$tunjangan   = $cekUser[0]->tunjangan_raw;
				$grade       = $cekUser[0]->grade_raw;
				$nama_posisi = $cekUser[0]->nama_posisi_raw;
			}
			elseif ($cekUser[0]->kat_posisi == 2) {
				# code...
				$tunjangan   = $cekUser[0]->tunjangan_jft;
				$grade       = $cekUser[0]->grade_jft;
				$nama_posisi = $cekUser[0]->nama_posisi_jft;
			}
			elseif ($cekUser[0]->kat_posisi == 4) {
				# code...
				$tunjangan   = $cekUser[0]->tunjangan_jfu;
				$grade       = $cekUser[0]->grade_jfu;
				$nama_posisi = $cekUser[0]->nama_posisi_jfu;
			}
			elseif ($cekUser[0]->kat_posisi == 6) {
				# code...
				$tunjangan   = $cekUser[0]->tunjangan_raw;
				$grade       = $cekUser[0]->grade_raw;
				$nama_posisi = $cekUser[0]->nama_posisi_raw;
			}

			//$trackSurvey = $this->mtalenta->track_progress($cekUser[0]->id);

			$data = array
						(
							'sesUser'         => $cekUser[0]->id,
							'sesFoto'         => $cekUser[0]->photo,
							'sesNama'         => $cekUser[0]->nama_pegawai,
							'sesPassword'     => $cekUser[0]->password,
							'sesNip'          => $cekUser[0]->nip,
							'sesPosisi'       => $cekUser[0]->posisi,
							'sesRole'         => $cekUser[0]->id_role,
							'sesEs1'          => $cekUser[0]->es1,
							'nama_es1'        => $cekUser[0]->nama_eselon1,
							'sesEs2'          => $cekUser[0]->es2,
							'nama_es2'        => $cekUser[0]->nama_eselon2,
							'sesEs3'          => $cekUser[0]->es3,
							'nama_es3'        => $cekUser[0]->nama_eselon3,
							'sesEs4'          => $cekUser[0]->es4,
							'nama_es4'        => $cekUser[0]->nama_eselon4,
							'atasan'          => $cekUser[0]->atasan,
							'nama_posisi'     => $nama_posisi, 
							'tunjangan'       => $tunjangan,
							'grade'           => $grade,
							'kat_posisi'      => $cekUser[0]->kat_posisi,
							'posisi_plt'      => $cekUser[0]->posisi_plt,
							'posisi_akademik' => $cekUser[0]->posisi_akademik,
							'photo'           => $cekUser[0]->photo,							
							'login'           => TRUE
						);

			// if ($trackSurvey < 5) {
			// 	# code...
			// 	$survey = 1;
			// 	$data['surveyIsDone'] = 0;
			// }
			// else
			// {
			// 	$survey = 0;				
			// 	$data['surveyIsDone'] = 1;
			// }
			
			$this->session->set_userdata($data);
			$res = array
			(
			//	'survey' => $survey,				
				'status' => 1,
				'text'   => 'Verifikasi berhasil'
			);
			echo json_encode($res);
		}
		else
		{
			$res = array
			(
			//	'survey' => $survey,
				'status' => 0,
				'text'   => 'Verifikasi user gagal, nip atau password tidak sesuai'
			);
			echo json_encode($res);
		}
	}
	
	public function signout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}

	public function v()
	{
		# code...
		echo CI_VERSION;die();
		error_reporting(E_ALL ^ E_WARNING);		
	}
	
}

