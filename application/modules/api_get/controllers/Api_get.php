<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api_get extends CI_Controller 
{

	public function __construct () 
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');		
		// $this->load->model ('admin/mlogin', '', TRUE);		
	}
	

	public function simpeg_profile($nip)
	{
		# code...
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://ropeg.setjen.kemendagri.go.id/restsimpeg/api/profile/af9ec164748d7690c4f58021b6907d8d/".$nip,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 360,
		  CURLOPT_SSL_VERIFYHOST => false,
		  CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "",
		  CURLOPT_COOKIE => "ci_session=lgohrhril6oht6hlrong634gkiui3trd",
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} 
		else 
		{
			$data_decode     = json_decode($response)->results;
			echo $response;
		}		
	}

	public function simpeg_riwayat_pendidikan($nip)
	{
		# code...
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://ropeg.setjen.kemendagri.go.id/restsimpeg/api/pendidikan/af9ec164748d7690c4f58021b6907d8d/".$nip,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_SSL_VERIFYHOST => false,
		  CURLOPT_SSL_VERIFYPEER => false,		  
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "",
		  CURLOPT_COOKIE => "ci_session=lgohrhril6oht6hlrong634gkiui3trd",
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} 
		else 
		{
			$data_store_detail = array();
			$data_decode       = json_decode($response)->results;			
			if (count($data_decode) != 0) {
				# code...
				for ($i=0; $i < count($data_decode); $i++) { 
					# code...
					$get_scoring = $this->Allcrud->getData('mr_pendidikan',array('id_pendidikan'=>$data_decode[$i]->ktp))->result_array();
					$scoring = ($get_scoring != array()) ? $get_scoring[0]['skor'] : 0 ;

					$data_store_detail[$i] = array(
						'njur'         => $data_decode[$i]->njur,						
						'nsek'         => $data_decode[$i]->nsek,
						'ntpu'         => $data_decode[$i]->ntpu,
						'tempat'       => $data_decode[$i]->tempat,
						'thnlulus'     => $data_decode[$i]->thnlulus,
						'tsttb2'       => $data_decode[$i]->tsttb2,
						'sources'      => 'simpeg',
						'scoring'      => $scoring
					); 
				}				
			}			

			$data_res = array(
				'message' => json_decode($response)->message,
				'results' => $data_store_detail,
				'status' => json_decode($response)->status
			);
		  	echo json_encode($data_res);
		}
	}

	public function simpeg_riwayat_pangkat($nip)
	{
		# code...
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://ropeg.setjen.kemendagri.go.id/restsimpeg/api/pangkat/af9ec164748d7690c4f58021b6907d8d/".$nip,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_SSL_VERIFYHOST => false,
		  CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "",
		  CURLOPT_COOKIE => "ci_session=lgohrhril6oht6hlrong634gkiui3trd",
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} 
		else 
		{
			$data_decode     = json_decode($response)->results;			
			if (count($data_decode) != 0) {
				# code...
				for ($i=0; $i < count($data_decode); $i++) { 
					# code...
					$data_store_detail = array(
						'jenis_naik_pangkat'       => $data_decode[$i]->jenis_naik_pangkat,						
						'nama_gol'                 => $data_decode[$i]->nama_gol,
						'nomor_sk'                 => $data_decode[$i]->nomor_sk,
						'pangkat'	               => $data_decode[$i]->pangkat,
						'tmt_pangkat'              => $data_decode[$i]->tmt_pangkat,
						'tmt_sk'                   => $data_decode[$i]->tmt_sk
					); 
				}				
			}			
		  	echo $response;
		}		
	}

	public function simpeg_riwayat_jabatan($nip)
	{
		# code...
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://ropeg.setjen.kemendagri.go.id/restsimpeg/api/jabatan/af9ec164748d7690c4f58021b6907d8d/".$nip,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_SSL_VERIFYHOST => false,
		  CURLOPT_SSL_VERIFYPEER => false,		  
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "",
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} 
		else 
		{
			$data_decode     = json_decode($response)->results;			
			if (count($data_decode) != 0) {
				# code...
				for ($i=0; $i < count($data_decode); $i++) { 
					# code...
					$data_store_detail = array(
						'jabatan'     => $data_decode[$i]->jataban,						
						'neselon'     => $data_decode[$i]->neselon,
						'jenisjab'    => $data_decode[$i]->jenisjab,
						'tmt_jabatan' => $data_decode[$i]->tmt_jabatan
					); 
				}				
			}			
		 	echo $response;
		}		
	}

	public function simpeg_riwayat_diklat_struktural($nip)
	{
		# code...
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://ropeg.setjen.kemendagri.go.id/restsimpeg/api/dstruktural/af9ec164748d7690c4f58021b6907d8d/".$nip,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_SSL_VERIFYHOST => false,
		  CURLOPT_SSL_VERIFYPEER => false,		  
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "",
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} 
		else 
		{
			$data_decode     = json_decode($response)->results;			
			if (count($data_decode) != 0) {
				# code...
				for ($i=0; $i < count($data_decode); $i++) { 
					# code...
					$data_store_detail = array(
						'tempat'      => $data_decode[$i]->tempat,						
						'panitia'     => $data_decode[$i]->panitia,
						'ndik'        => $data_decode[$i]->ndik,
						'angkatan'    => $data_decode[$i]->angkatan,
						'thndiklat'   => $data_decode[$i]->thndiklat,
						'blndiklat'   => $data_decode[$i]->blndiklat,
						'tgl_mulai'   => $data_decode[$i]->tgl_mulai																		
					); 
				}				
			}			
		 	echo $response;
		}		
	}
	
	public function simpeg_riwayat_diklat_fungsional($nip)
	{
		# code...
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://ropeg.setjen.kemendagri.go.id/restsimpeg/api/dfungsional/af9ec164748d7690c4f58021b6907d8d/".$nip,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_SSL_VERIFYHOST => false,
		  CURLOPT_SSL_VERIFYPEER => false,		  
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "",
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} 
		else 
		{
			$data_decode     = json_decode($response)->results;			
			if (count($data_decode) != 0) {
				# code...
				for ($i=0; $i < count($data_decode); $i++) { 
					# code...
					$data_store_detail = array(
						'tempat'      => $data_decode[$i]->tempat,						
						'panitia'     => $data_decode[$i]->panitia,
						'ndik'        => $data_decode[$i]->ndik,
						'angkatan'    => $data_decode[$i]->angkatan,
						'thndiklat'   => $data_decode[$i]->thndiklat,
						'blndiklat'   => $data_decode[$i]->blndiklat,
						'tgl_mulai'   => $data_decode[$i]->tgl_mulai																		
					); 
				}				
			}			
		 	echo $response;
		}		
	}
	
	public function simpeg_riwayat_diklat_teknis($nip)
	{
		# code...
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://ropeg.setjen.kemendagri.go.id/restsimpeg/api/dteknis/af9ec164748d7690c4f58021b6907d8d/".$nip,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_SSL_VERIFYHOST => false,
		  CURLOPT_SSL_VERIFYPEER => false,		  
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "",
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} 
		else 
		{
			$data_decode     = json_decode($response)->results;			
			if (count($data_decode) != 0) {
				# code...
				for ($i=0; $i < count($data_decode); $i++) { 
					# code...
					$data_store_detail = array(
						'ndiktek'        => $data_decode[$i]->ndiktek,						
						'tempat'         => $data_decode[$i]->tempat,
						'panitia'        => $data_decode[$i]->panitia,
						'tgl_mulai'      => $data_decode[$i]->tgl_mulai,
						'tgl_akhir'      => $data_decode[$i]->tgl_akhir																		
					); 
				}				
			}			
		 	echo $response;
		}		
	}
	
	public function simpeg_riwayat_konferensi($nip)
	{
		# code...
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://ropeg.setjen.kemendagri.go.id/restsimpeg/api/seminar/af9ec164748d7690c4f58021b6907d8d/".$nip,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_SSL_VERIFYHOST => false,
		  CURLOPT_SSL_VERIFYPEER => false,		  
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "",
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} 
		else 
		{
			$data_decode     = json_decode($response)->results;			
			if (count($data_decode) != 0) {
				# code...
				for ($i=0; $i < count($data_decode); $i++) { 
					# code...
					$data_store_detail = array(
						'nseminar'        => $data_decode[$i]->nseminar,
						'peran'           => $data_decode[$i]->peran,												
						'tempat'          => $data_decode[$i]->tempat,
						'panitia'         => $data_decode[$i]->panitia,
						'tgl_mulai'       => $data_decode[$i]->tgl_mulai,
						'tgl_akhir'       => $data_decode[$i]->tgl_akhir																		
					); 
				}				
			}			
		 	echo $response;
		}		
	}	

	public function simpeg_karya_tulis($nip)
	{
		# code...
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://ropeg.setjen.kemendagri.go.id/restsimpeg/api/karyatulis/af9ec164748d7690c4f58021b6907d8d/".$nip,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_SSL_VERIFYHOST => false,
		  CURLOPT_SSL_VERIFYPEER => false,		  
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "",
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} 
		else 
		{
			$data_decode     = json_decode($response)->results;			
			if (count($data_decode) != 0) {
				# code...
				for ($i=0; $i < count($data_decode); $i++) { 
					# code...
					$data_store_detail = array(
						'judul_buku' => $data_decode[$i]->judul_buku,
						'tahun'      => $data_decode[$i]->tahun
					); 
				}				
			}			
		 	echo $response;
		}		
	}
	
	public function simpeg_organisasi($nip)
	{
		# code...
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://ropeg.setjen.kemendagri.go.id/restsimpeg/api/organisasi/af9ec164748d7690c4f58021b6907d8d/".$nip,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_SSL_VERIFYHOST => false,
		  CURLOPT_SSL_VERIFYPEER => false,		  
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "",
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} 
		else 
		{
			$data_decode     = json_decode($response)->results;			
			if (count($data_decode) != 0) {
				# code...
				for ($i=0; $i < count($data_decode); $i++) { 
					# code...
					$data_store_detail = array(
						'jorg' 			 => $data_decode[$i]->jorg,
						'norg'           => $data_decode[$i]->norg,
						'jborg'          => $data_decode[$i]->jborg,
						'tempat'         => $data_decode[$i]->tempat,
						'tgl_mulai'      => $data_decode[$i]->tgl_mulai,
						'tgl_akhir'      => $data_decode[$i]->tgl_akhir																			
					); 
				}				
			}			
		 	echo $response;
		}		
	}
	
	public function simpeg_penghargaan($nip)
	{
		# code...
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://ropeg.setjen.kemendagri.go.id/restsimpeg/api/penghargaan/af9ec164748d7690c4f58021b6907d8d/".$nip,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_SSL_VERIFYHOST => false,
		  CURLOPT_SSL_VERIFYPEER => false,		  
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "",
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} 
		else 
		{
			$data_decode     = json_decode($response)->results;			
			if (count($data_decode) != 0) {
				# code...
				for ($i=0; $i < count($data_decode); $i++) { 
					# code...
					$data_store_detail = array(
						'nbintang' => $data_decode[$i]->nbintang,
						'aoleh'    => $data_decode[$i]->aoleh,
						'nsk'      => $data_decode[$i]->nsk,
						'tholeh'   => $data_decode[$i]->tholeh																			
					); 
				}				
			}			
		 	echo $response;
		}		
	}	

}