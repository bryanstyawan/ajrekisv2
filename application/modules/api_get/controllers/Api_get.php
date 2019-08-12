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
		  CURLOPT_TIMEOUT => 30,
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

	public function simpeg_riwayat_pedidikan($nip)
	{
		# code...
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://ropeg.setjen.kemendagri.go.id/restsimpeg/api/pendidikan/af9ec164748d7690c4f58021b6907d8d/".$nip,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
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
						'njur'       => $data_decode[0]->njur,						
						'nsek'       => $data_decode[$i]->nsek,
						'ntpu'       => $data_decode[$i]->ntpu,
						'tempat'	 => $data_decode[$i]->tempat,
						'thnlulus'   => $data_decode[$i]->thnlulus,
						'tsttb2'     => $data_decode[$i]->tsttb2
					); 
				}				
			}			
			// print_r($data_decode);die();
		  	echo $response;
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
						'jenis_naik_pangkat'       => $data_decode[0]->jenis_naik_pangkat,						
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

}