<?php

class Mdashboard extends CI_Model 
{
	
	private $_tbl_survey = "tr_survey_ip";
	
	public function __construct () 
	{
		parent::__construct();
	
	}
	
	public function save_survey($id_pegawai)
    {
	
			
        $post = $this->input->post();
		$this->id_pegawai = $id_pegawai;
        $this->jns_jabatan = $post["jabatan"];
		
		if ($post["jabatan"]=='CPNS') {
			$this->disclaimer = 0;
		}
		else {
			$this->disclaimer = $post["disclaimer"];
		}
		
		$this->input_date = date('y-m-d H:i:s');
        
		$this->diklat_pim = $post["tampil"];
		if ($post["tampil"]=='sdhpim') {
				$this->n_diklat_pim = 15;
		}
		else
		{ 	
			$this->n_diklat_pim = 0;
		}
		
		$this->diklat_jafung = $post["tampiljafung"];
		if (($post["tampiljafung"]=='sdhdiklatjafung') && ($post["jabatan"]=='fungsional')) {
				$this->n_diklat_jafung = 15;
		}
		else
		{ 	
			$this->n_diklat_jafung = 0;
		}
		
		$this->diklat_20jp = $post["tampil20jp"];
		
		if ($post["tampil20jp"]=='sdhdiklat20jp' && $post["jabatan"]=='struktural') {
				$this->n_diklat_20jp = 15;
		}
		else
		{ 	
			if ($post["tampil20jp"]=='sdhdiklat20jp' && $post["jabatan"]=='fungsional') {
				$this->n_diklat_20jp = 15;
			}
			else
			{
				if ($post["tampil20jp"]=='sdhdiklat20jp' && $post["jabatan"]=='pelaksana') {
					$this->n_diklat_20jp = 22.5;
				}
				else
					{
						$this->n_diklat_20jp = 0;
					}						
				}
		}
		
		
		$this->seminar = $post["tampilseminar"];
		if ($post["tampilseminar"]=='sdhseminar' && (($post["jabatan"]=='struktural') || ($post["jabatan"]=='fungsional')) ) {
				$this->n_seminar = 10;
		}
		else
		{ 	
			if ($post["tampilseminar"]=='sdhseminar' && $post["jabatan"]='pelaksana') {
				$this->n_seminar = 17.5;
			}
			else
			{
				$this->n_seminar = 0;
			}
		}
		
		if ($post["jabatan"]=='CPNS') {
			$this->n_kualifikasi = 0;
		}
		else {
			$this->kualifikasi = $post["pendidikan"];
			switch ($post["pendidikan"]) {
			  case "S3":
				$this->n_kualifikasi = 25;
				break;
			  case "S2":
				$this->n_kualifikasi = 20;
				break;
			  case "S1D4":
				$this->n_kualifikasi = 15;
				break;
			  case "D3":
				$this->n_kualifikasi = 10;
				break;
			  case "D2D1SMASMK":
				$this->n_kualifikasi = 5;
				break;
			  default:
				$this->n_kualifikasi = 1;
			}
		}
		
		if ($post["jabatan"]=='CPNS') {
			$this->n_penilaian_kinerja = 0;
		}
		else {
			$this->penilaian_kinerja = $post["predikat"];
			
			switch ($post["predikat"]) {
			  case "SANGAT BAIK":
				$this->n_penilaian_kinerja = 30;
				break;
			  case "BAIK":
				$this->n_penilaian_kinerja = 25;
				break;
			  case "CUKUP":
				$this->n_penilaian_kinerja = 15;
				break;
			  case "KURANG":
				$this->n_penilaian_kinerja = 5;
				break;
			  default:
				$this->n_penilaian_kinerja = 1;
			}
		}
		
		if ($post["jabatan"]=='CPNS') {
			$this->n_hukuman_disiplin = 0;
		}
		else {
			$this->hukuman_disiplin= $post["hukuman"];
			switch ($post["hukuman"]) {
			  case "Berat":
				$this->n_hukuman_disiplin = 1;
				break;
			  case "Sedang":
				$this->n_hukuman_disiplin = 2;
				break;
			  case "Ringan":
				$this->n_hukuman_disiplin = 3;
				break;
			  default:
				$this->n_hukuman_disiplin = 5;
			}
		}
	
		$this->tahun= 2022;
		$this->db->delete($this->_tbl_survey,array('id_pegawai'=>$id_pegawai, 'tahun' => 2022));
        $this->db->insert($this->_tbl_survey, $this);
		
		//return 1;
    }
	
	public function save_survey_hukuman($id_pegawai)
    {
		
			$hukuman = $this->input->post("hukuman");
			
			if ($hukuman != 'Tidak Pernah') {
				
				$penandatangansk = $this->input->post("ttdsk");
				$tglsk = (date('Y-m-d',strtotime($this->input->post("tglsurat"))));
				$alasan = $this->input->post("alasan");   
				$berkashukuman = $this->input->post("berkashukuman");
				$tahun= 2022;
				$idhukuman =  $this->input->post("idhukuman");
				$filedok = $this->input->post("filedokhukuman");
					
								if(!empty($_FILES['berkashukuman']['name'])){
										
									$config['upload_path']          = './uploads/';
									$config['allowed_types']        = 'gif|jpg|jpeg|png|pdf';
									$config['max_size']             = 1000;
									// $config['max_width']            = 2048;
									// $config['max_height']           = 1000;
									$this->load->library('upload',$config);
									
									$_FILES['file']['name'] = $_FILES['berkashukuman']['name']; 
									$_FILES['file']['type'] = $_FILES['berkashukuman']['type'];
									$_FILES['file']['tmp_name'] = $_FILES['berkashukuman']['tmp_name'];
									$_FILES['file']['error'] = $_FILES['berkashukuman']['error'];
									$_FILES['file']['size'] = $_FILES['berkashukuman']['size'];
									
									if($this->upload->do_upload('file')){
										
										$uploadData = $this->upload->data();
										$new_name = $id_pegawai.'_'.$uploadData['file_name'];
										rename($uploadData['full_path'],$uploadData['file_path'].$new_name);
									}
								
									if ($idhukuman!='') {
												$data = array(
												'id_pegawai'=>$id_pegawai,
												'penandatangansk'=>$penandatangansk,
												'tglsk'=>$tglsk,
												'alasan'=>$alasan,
												'file_sertifikat'=>$new_name,
												'updatedate'=>date('y-m-d H:i:s'),
												'tahun'=>$tahun
												);				
												
												$this->db->trans_start();
												$this->db->where('id', $idhukuman);
												$this->db->update('tr_survey_hukuman',$data);
												$this->db->trans_complete();
											
									}
									else {
												$datainsert = array(
												'id_pegawai'=>$id_pegawai,
												'penandatangansk'=>$penandatangansk,
												'tglsk'=>$tglsk,
												'alasan'=>$alasan,
												'file_sertifikat'=> $new_name,
												'updatedate'=>date('y-m-d H:i:s'),
												'tahun'=>$tahun
												);
													$this->db->insert('tr_survey_hukuman',$datainsert);
												
									
									}
								}else {
									if ($idhukuman!='') {
												$data = array(
												'id_pegawai'=>$id_pegawai,
												'penandatangansk'=>$penandatangansk,
												'tglsk'=>$tglsk,
												'alasan'=>$alasan,
												'file_sertifikat'=> $filedok,
												'updatedate'=>date('y-m-d H:i:s'),
												'tahun'=>$tahun
												);				
												
												$this->db->trans_start();
												$this->db->where('id', $idhukuman);
												$this->db->update('tr_survey_hukuman',$data);
												$this->db->trans_complete();
											
									}
									else {
												$datainsert = array(
												'id_pegawai'=>$id_pegawai,
												'penandatangansk'=>$penandatangansk,
												'tglsk'=>$tglsk,
												'alasan'=>$alasan,
												'file_sertifikat'=> '',
												'updatedate'=>date('y-m-d H:i:s'),
												'tahun'=>$tahun
												);
													$this->db->insert('tr_survey_hukuman',$datainsert);
												
									
									}
								}
				
			}
			else {
				$this->db->delete('tr_survey_hukuman',array('id_pegawai'=>$id_pegawai, 'tahun' => 2022));
			}
			
		 	// echo '<script language="javascript">';
			// echo 'alert("surveyip")';
			// echo '</script>';
		
    }
	
	public function save_survey_skp1($id_pegawai)
    {
				//periode 1
				$idskp1 =  $this->input->post("idskp1");
				$nilaiskp = $this->input->post("nilaiskp");
				$orientasi = $this->input->post("orientasi");
				$integritas = $this->input->post("integritas");
				$komitmen = $this->input->post("komitmen");
				$kerjasama = $this->input->post("kerjasama");
				$disiplin = $this->input->post("disiplin");
				$kepemimpinan = $this->input->post("kepemimpinan");
				$nilperilakukerja = $this->input->post("nilperilakukerja");
				$nilprestasikerja = $this->input->post("nilprestasikerja");
				$nilkonversi = $this->input->post("nilkonversi");
				$berkasskp = $this->input->post("berkasskp");
				$filedok = $this->input->post("fileskp");
				$tahun = 2022;
				
				if(!empty($_FILES['berkasskp']['name'])){
										
						$config['upload_path']          = './uploads/';
						$config['allowed_types']        = 'gif|jpg|jpeg|png|pdf';
						$config['max_size']             = 1000;
						// $config['max_width']            = 2048;
						// $config['max_height']           = 1000;
						$this->load->library('upload',$config);
						
						$_FILES['file']['name'] = $_FILES['berkasskp']['name']; 
						$_FILES['file']['type'] = $_FILES['berkasskp']['type'];
						$_FILES['file']['tmp_name'] = $_FILES['berkasskp']['tmp_name'];
						$_FILES['file']['error'] = $_FILES['berkasskp']['error'];
						$_FILES['file']['size'] = $_FILES['berkasskp']['size'];
						
						if($this->upload->do_upload('file')){
							
							$uploadData = $this->upload->data();
							$new_name = $id_pegawai.'_'.$uploadData['file_name'];
							rename($uploadData['full_path'],$uploadData['file_path'].$new_name);
						}
					
						if ($idskp1!='') {
									$data = array(
									'id_pegawai'=>$id_pegawai,
									'nilaiskp'=>$nilaiskp,
									'orientasipelayanan'=>$orientasi,
									'integritas'=>$integritas,
									'komitmen'=>$komitmen,
									'kerjasama'=>$kerjasama,
									'disiplin'=>$disiplin,
									'kepemimpinan'=>$kepemimpinan,
									'nilaiprilakukerja'=>$nilperilakukerja,
									'nilaiprestasikerja'=>$nilprestasikerja,
									'nilaikonversi'=>$nilkonversi,
									'file_skp1'=>$new_name,
									'updatedate'=>date('y-m-d H:i:s'),
									'tahun'=>$tahun
									);				
									
									$this->db->trans_start();
									$this->db->where('id', $idskp1);
									$this->db->update('tr_survey_kinerja_1',$data);
									$this->db->trans_complete();
								
						}
						else {
									$datainsert = array(
									'id_pegawai'=>$id_pegawai,
									'nilaiskp'=>$nilaiskp,
									'orientasipelayanan'=>$orientasi,
									'integritas'=>$integritas,
									'komitmen'=>$komitmen,
									'kerjasama'=>$kerjasama,
									'disiplin'=>$disiplin,
									'kepemimpinan'=>$kepemimpinan,
									'nilaiprilakukerja'=>$nilperilakukerja,
									'nilaiprestasikerja'=>$nilprestasikerja,
									'nilaikonversi'=>$nilkonversi,
									'file_skp1'=> $new_name,
									'updatedate'=>date('y-m-d H:i:s'),
									'tahun'=>$tahun
									);
										$this->db->insert('tr_survey_kinerja_1',$datainsert);
									
						
						}
					}else {
						if ($idskp1!='') {
									$data = array(
									'id_pegawai'=>$id_pegawai,
									'nilaiskp'=>$nilaiskp,
									'orientasipelayanan'=>$orientasi,
									'integritas'=>$integritas,
									'komitmen'=>$komitmen,
									'kerjasama'=>$kerjasama,
									'disiplin'=>$disiplin,
									'kepemimpinan'=>$kepemimpinan,
									'nilaiprilakukerja'=>$nilperilakukerja,
									'nilaiprestasikerja'=>$nilprestasikerja,
									'nilaikonversi'=>$nilkonversi,
									'file_skp1'=> $filedok,
									'updatedate'=>date('y-m-d H:i:s'),
									'tahun'=>$tahun
									);				
									
									$this->db->trans_start();
									$this->db->where('id', $idskp1);
									$this->db->update('tr_survey_kinerja_1',$data);
									$this->db->trans_complete();
								
						}
						else {
									$datainsert = array(
									'id_pegawai'=>$id_pegawai,
									'nilaiskp'=>$nilaiskp,
									'orientasipelayanan'=>$orientasi,
									'integritas'=>$integritas,
									'komitmen'=>$komitmen,
									'kerjasama'=>$kerjasama,
									'disiplin'=>$disiplin,
									'kepemimpinan'=>$kepemimpinan,
									'nilaiprilakukerja'=>$nilperilakukerja,
									'nilaiprestasikerja'=>$nilprestasikerja,
									'nilaikonversi'=>$nilkonversi,
									'file_skp1'=> '',
									'updatedate'=>date('y-m-d H:i:s'),
									'tahun'=>$tahun
									);
										$this->db->insert('tr_survey_kinerja_1',$datainsert);
									
						
						}
					}

				
				
    }
	
	
	
	public function save_survey_skp2($id_pegawai)
    {
				//periode 2
				$idskp2 =  $this->input->post("idskp2");
				$nilaiskp2 = $this->input->post("nilaiskp2");
				$orientasi2 = $this->input->post("orientasi2");
				$komitmen2 = $this->input->post("komitmen2");
				$kerjasama2 = $this->input->post("kerjasama2");
				$inisiatif2 = $this->input->post("inisiatif");
				$kepemimpinan2 = $this->input->post("kepemimpinan2");
				$nilperilakukerja2 = $this->input->post("nilperilakukerja2");
				$nilprestasikerja2 = $this->input->post("nilprestasikerja2");
				$niltotal2 = $this->input->post("niltotal");
				$nipatasan = $this->input->post("nipatasan");
				$namaatasan = $this->input->post("namaatasan");
				$golatasan = $this->input->post("golatasan");
				$jabatasan = $this->input->post("jabatasan");
				$nippejabat = $this->input->post("nippejabat");
				$namapejabat = $this->input->post("namapejabat");
				$golpejabat = $this->input->post("golpejabat");
				$jabpejabat= $this->input->post("jabpejabat");
				// $berkasskp2 = $this->input->post("berkasskp2");
				// $filedok2 = $this->input->post("fileskp2");
				$tahun=2022;
				
				if ($idskp2!='') {
									$data = array(
									'id_pegawai'=>$id_pegawai,
									'nilaiskp'=>$nilaiskp2,
									'orientasipelayanan'=>$orientasi2,
									'inisiatifkerja'=>$inisiatif2,									
									'komitmen'=>$komitmen2,
									'kerjasama'=>$kerjasama2,
									'kepemimpinan'=>$kepemimpinan2,
									'nilaiprilakukerja'=>$nilperilakukerja2,
									'nilaiprestasikerja'=>$nilprestasikerja2,
									'nilaitotal'=>$niltotal2,
									'nip_penilai'=>$nipatasan,
									'nama_penilai'=>$namaatasan,
									'gol_penilai'=>$golatasan,
									'jab_penilai'=>$jabatasan,
									'nip_atasanpenilai'=>$nippejabat,
									'nama_atasanpenilai'=>$namapejabat,
									'gol_atasanpenilai'=>$golpejabat,
									'jab_atasanpenilai'=>$jabpejabat,
									'updatedate'=>date('y-m-d H:i:s'),
									'tahun'=>$tahun
									);				
									
									$this->db->trans_start();
									$this->db->where('id', $idskp2);
									$this->db->update('tr_survey_kinerja_2',$data);
									$this->db->trans_complete();
								
				}
				else {
							$datainsert = array(
							'id_pegawai'=>$id_pegawai,
							'nilaiskp'=>$nilaiskp2,
							'orientasipelayanan'=>$orientasi2,
							'inisiatifkerja'=>$inisiatif2,									
							'komitmen'=>$komitmen2,
							'kerjasama'=>$kerjasama2,
							'kepemimpinan'=>$kepemimpinan2,
							'nilaiprilakukerja'=>$nilperilakukerja2,
							'nilaiprestasikerja'=>$nilprestasikerja2,
							'nilaitotal'=>$niltotal2,
							'nip_penilai'=>$nipatasan,
							'nama_penilai'=>$namaatasan,
							'gol_penilai'=>$golatasan,
							'jab_penilai'=>$jabatasan,
							'nip_atasanpenilai'=>$nippejabat,
							'nama_atasanpenilai'=>$namapejabat,
							'gol_atasanpenilai'=>$golpejabat,
							'jab_atasanpenilai'=>$jabpejabat,
							'updatedate'=>date('y-m-d H:i:s'),
							'tahun'=>$tahun
							);
								$this->db->insert('tr_survey_kinerja_2',$datainsert);
							
				
				}
				
				// if(!empty($_FILES['berkasskp2']['name'])){
										
						// $config['upload_path']          = './uploads/';
						// $config['allowed_types']        = 'gif|jpg|png|pdf';
						// $config['max_size']             = 1000;
						// $config['max_width']            = 2048;
						// $config['max_height']           = 1000;
						// $this->load->library('upload',$config);
						
						// $_FILES['file']['name'] = $_FILES['berkasskp2']['name']; 
						// $_FILES['file']['type'] = $_FILES['berkasskp2']['type'];
						// $_FILES['file']['tmp_name'] = $_FILES['berkasskp2']['tmp_name'];
						// $_FILES['file']['error'] = $_FILES['berkasskp2']['error'];
						// $_FILES['file']['size'] = $_FILES['berkasskp2']['size'];
						
						// if($this->upload->do_upload('file')){
							
							// $uploadData = $this->upload->data();
							// $new_name = $id_pegawai.'_'.$uploadData['file_name'];
							// rename($uploadData['full_path'],$uploadData['file_path'].$new_name);
						// }
					
						// if ($idskp2!='') {
									// $data = array(
									// 'id_pegawai'=>$id_pegawai,
									// 'nilaiskp'=>$nilaiskp2,
									// 'orientasipelayanan'=>$orientasi2,
									// 'inisiatifkerja'=>$inisiatif2,									
									// 'komitmen'=>$komitmen2,
									// 'kerjasama'=>$kerjasama2,
									// 'kepemimpinan'=>$kepemimpinan2,
									// 'nilaiprilakukerja'=>$nilperilakukerja2,
									// 'nilaiprestasikerja'=>$nilprestasikerja2,
									// 'nilaitotal'=>$niltotal2,
									// 'file_skp2'=>$new_name,
									// 'updatedate'=>date('y-m-d H:i:s'),
									// 'tahun'=>$tahun
									// );				
									
									// $this->db->trans_start();
									// $this->db->where('id', $idskp2);
									// $this->db->update('tr_survey_kinerja_2',$data);
									// $this->db->trans_complete();
								
						// }
						// else {
									// $datainsert = array(
									// 'id_pegawai'=>$id_pegawai,
									// 'nilaiskp'=>$nilaiskp2,
									// 'orientasipelayanan'=>$orientasi2,
									// 'inisiatifkerja'=>$inisiatif2,									
									// 'komitmen'=>$komitmen2,
									// 'kerjasama'=>$kerjasama2,
									// 'kepemimpinan'=>$kepemimpinan2,
									// 'nilaiprilakukerja'=>$nilperilakukerja2,
									// 'nilaiprestasikerja'=>$nilprestasikerja2,
									// 'nilaitotal'=>$niltotal2,
									// 'file_skp2'=> $new_name,
									// 'updatedate'=>date('y-m-d H:i:s'),
									// 'tahun'=>$tahun
									// );
										// $this->db->insert('tr_survey_kinerja_2',$datainsert);
									
						
						// }
					// }else {
						// if ($idskp2!='') {
									// $data = array(
									// 'id_pegawai'=>$id_pegawai,
									// 'nilaiskp'=>$nilaiskp2,
									// 'orientasipelayanan'=>$orientasi2,
									// 'inisiatifkerja'=>$inisiatif2,									
									// 'komitmen'=>$komitmen2,
									// 'kerjasama'=>$kerjasama2,
									// 'kepemimpinan'=>$kepemimpinan2,
									// 'nilaiprilakukerja'=>$nilperilakukerja2,
									// 'nilaiprestasikerja'=>$nilprestasikerja2,
									// 'nilaitotal'=>$niltotal2,
									// 'file_skp2'=> $filedok2,
									// 'updatedate'=>date('y-m-d H:i:s'),
									// 'tahun'=>$tahun
									// );				
									
									// $this->db->trans_start();
									// $this->db->where('id', $idskp2);
									// $this->db->update('tr_survey_kinerja_2',$data);
									// $this->db->trans_complete();
								
						// }
						// else {
									// $datainsert = array(
									// 'id_pegawai'=>$id_pegawai,
									// 'nilaiskp'=>$nilaiskp2,
									// 'orientasipelayanan'=>$orientasi2,
									// 'inisiatifkerja'=>$inisiatif2,									
									// 'komitmen'=>$komitmen2,
									// 'kerjasama'=>$kerjasama2,
									// 'kepemimpinan'=>$kepemimpinan2,
									// 'nilaiprilakukerja'=>$nilperilakukerja2,
									// 'nilaiprestasikerja'=>$nilprestasikerja2,
									// 'nilaitotal'=>$niltotal2,
									// 'file_skp2'=> '',
									// 'updatedate'=>date('y-m-d H:i:s'),
									// 'tahun'=>$tahun
									// );
										// $this->db->insert('tr_survey_kinerja_2',$datainsert);
									
						
						// }
					// }

				
				
    }
	
	public function save_survey_diklatpim($id_pegawai)
    {
			
			
			$diklatpim = $this->input->post("tampil");
			
			if ($diklatpim=='sdhpim') {
				
				$idpim =  $this->input->post("idpim");
				$filedok = $this->input->post("filedokpim");
				$jnsdiklatpim =  $this->input->post("jenisdiklatpim");
				$tgldiklatpim = $this->input->post("tgldiklatpim"); 
				$tmpdiklatpim = $this->input->post("tmpdiklatpim");
				$tglselesaipim = $this->input->post("tglselesaipim");
				$nosertifikatpim = $this->input->post("nosertifikatpim");
				$tglsertifikatpim = $this->input->post("tglsertifikatpim");
				$jmljampim = $this->input->post("jmljampim");
				$berkas = $this->input->post("berkas");
				$tahun= 2022;
				//$i=0;
				
				//for ($i =0; $i < count(jnsdiklatpim); $i++) 
				foreach($jnsdiklatpim as $i => $b)
				 {		
							
								if(!empty($_FILES['berkas']['name'][$i])){
										
									$config['upload_path']          = './uploads/';
									$config['allowed_types']        = 'gif|jpg|jpeg|png|pdf';
									$config['max_size']             = 1000;
									// $config['max_width']            = 2048;
									// $config['max_height']           = 1000;
									$this->load->library('upload',$config);
									
									$_FILES['file']['name'] = $_FILES['berkas']['name'][$i]; 
									$_FILES['file']['type'] = $_FILES['berkas']['type'][$i];
									$_FILES['file']['tmp_name'] = $_FILES['berkas']['tmp_name'][$i];
									$_FILES['file']['error'] = $_FILES['berkas']['error'][$i];
									$_FILES['file']['size'] = $_FILES['berkas']['size'][$i];
									
									if($this->upload->do_upload('file')){
										
										$uploadData = $this->upload->data();
										$new_name = $id_pegawai.'_'.$uploadData['file_name'];
										rename($uploadData['full_path'],$uploadData['file_path'].$new_name);
									}
								
									if ($idpim[$i]!='') {
												$data = array(
												'id_pegawai'=>$id_pegawai,
												'jnsdiklatpim'=>$jnsdiklatpim[$i],
												'tgldiklatpim'=>$tgldiklatpim[$i],
												'tmpdiklatpim'=>$tmpdiklatpim[$i] ,
												'tglselesai'=>$tglselesaipim[$i] ,
												'nosertifikat'=>$nosertifikatpim[$i] ,
												'tglsertifikat'=>$tglsertifikatpim[$i] ,
												'jmljam'=>$jmljampim[$i] ,
												'file_sertifikat'=>$new_name,
												'updatedate'=>date('y-m-d H:i:s'),
												'tahun'=>$tahun
												);				
												
												$this->db->trans_start();
												$this->db->where('id', $idpim[$i]);
												$this->db->update('tr_survey_diklatpim',$data);
												$this->db->trans_complete();
											
									}
									else {
												$datainsert = array(
												'id_pegawai'=>$id_pegawai,
												'jnsdiklatpim'=>$jnsdiklatpim[$i],
												'tgldiklatpim'=>$tgldiklatpim[$i],
												'tmpdiklatpim'=>$tmpdiklatpim[$i],
												'tglselesai'=>$tglselesaipim[$i] ,
												'nosertifikat'=>$nosertifikatpim[$i] ,
												'tglsertifikat'=>$tglsertifikatpim[$i] ,
												'jmljam'=>$jmljampim[$i],
												'file_sertifikat'=> $new_name,
												'updatedate'=>date('y-m-d H:i:s'),
												'tahun'=>$tahun
												);
													$this->db->insert('tr_survey_diklatpim',$datainsert);
												
									
									}
								}else {
									if ($idpim[$i]!='') {
												$data = array(
												'id_pegawai'=>$id_pegawai,
												'jnsdiklatpim'=>$jnsdiklatpim[$i],
												'tgldiklatpim'=>$tgldiklatpim[$i],
												'tmpdiklatpim'=>$tmpdiklatpim[$i],
												'tglselesai'=>$tglselesaipim[$i] ,
												'nosertifikat'=>$nosertifikatpim[$i] ,
												'tglsertifikat'=>$tglsertifikatpim[$i] ,
												'jmljam'=>$jmljampim[$i],
												'file_sertifikat'=> $filedok[$i],
												'updatedate'=>date('y-m-d H:i:s'),
												'tahun'=>$tahun
												);				
												
												$this->db->trans_start();
												$this->db->where('id', $idpim[$i]);
												$this->db->update('tr_survey_diklatpim',$data);
												$this->db->trans_complete();
											
									}
									else {
												$datainsert = array(
												'id_pegawai'=>$id_pegawai,
												'jnsdiklatpim'=>$jnsdiklatpim[$i],
												'tgldiklatpim'=>$tgldiklatpim[$i],
												'tmpdiklatpim'=>$tmpdiklatpim[$i],
												'tglselesai'=>$tglselesaipim[$i] ,
												'nosertifikat'=>$nosertifikatpim[$i] ,
												'tglsertifikat'=>$tglsertifikatpim[$i] ,
												'jmljam'=>$jmljampim[$i] ,
												'file_sertifikat'=> '',
												'updatedate'=>date('y-m-d H:i:s'),
												'tahun'=>$tahun
												);
													$this->db->insert('tr_survey_diklatpim',$datainsert);
												
									
									}
								}
				 }
				}
				else{
							$this->db->delete('tr_survey_diklatpim',array('id_pegawai'=>$id_pegawai, 'tahun' => 2022));
				}
		 		 	// echo '<script language="javascript">';
			// echo 'alert("pimok")';
			// echo '</script>';	
		
    }
	
	public function save_survey_diklatjafung($id_pegawai)
    {
			$diklatjafung = $this->input->post("tampiljafung");
			
			if ($diklatjafung=='sdhdiklatjafung') {
				
				$jenisdiklatjafung =  $this->input->post("jenisdiklatjafung");
				$tgldiklatjafung = $this->input->post("tgldiklatjafung"); 
				$tmpdiklatjafung = $this->input->post("tmpdiklatjafung");
				$berkasjafung = $this->input->post("berkasjafung");
				$tglselesaijafung = $this->input->post("tglselesaijafung");
				$nosertifikat = $this->input->post("nosertifikat");
				$tglsertifikat = $this->input->post("tglsertifikat");
				$jmljam = $this->input->post("jmljam");
				
				$tahun= 2022;
				$idjafung =  $this->input->post("idjafung");
				$filedok = $this->input->post("filedokjafung");
				//$i=0;
				
				//for ($i =0; $i < count(jnsdiklatpim); $i++) 
				foreach($jenisdiklatjafung as $i => $b)
				 {		
							
								if(!empty($_FILES['berkasjafung']['name'][$i])){
										
									$config['upload_path']          = './uploads/';
									$config['allowed_types']        = 'gif|jpg|jpeg|png|pdf';
									$config['max_size']             = 1000;
									// $config['max_width']            = 2048;
									// $config['max_height']           = 1000;
									$this->load->library('upload',$config);
									
									$_FILES['file']['name'] = $_FILES['berkasjafung']['name'][$i]; 
									$_FILES['file']['type'] = $_FILES['berkasjafung']['type'][$i];
									$_FILES['file']['tmp_name'] = $_FILES['berkasjafung']['tmp_name'][$i];
									$_FILES['file']['error'] = $_FILES['berkasjafung']['error'][$i];
									$_FILES['file']['size'] = $_FILES['berkasjafung']['size'][$i];
									
									if($this->upload->do_upload('file')){
										
										$uploadData = $this->upload->data();
										$new_name = $id_pegawai.'_'.$uploadData['file_name'];
										rename($uploadData['full_path'],$uploadData['file_path'].$new_name);
									}
								
									if ($idjafung[$i]!='') {
												$data = array(
												'id_pegawai'=>$id_pegawai,
												'jnsdiklatjafung'=>$jenisdiklatjafung[$i],
												'tgldiklatjafung'=>$tgldiklatjafung[$i],
												'tmpdiklatjafung'=>$tmpdiklatjafung[$i],
												'tglselesai'=>$tglselesaijafung[$i],
												'no_sertifikat'=>$nosertifikat[$i],
												'tgl_sertifikat'=>$tglsertifikat[$i],
												'jml_jam'=>$jmljam[$i],
												'file_sertifikat'=> $new_name,
												'updatedate'=>date('y-m-d H:i:s'),
												'tahun'=>$tahun
												);				
												
												$this->db->trans_start();
												$this->db->where('id', $idjafung[$i]);
												$this->db->update('tr_survey_diklatjafung',$data);
												$this->db->trans_complete();
											
									}
									else {
												$datainsert = array(
												'id_pegawai'=>$id_pegawai,
												'jnsdiklatjafung'=>$jenisdiklatjafung[$i],
												'tgldiklatjafung'=>$tgldiklatjafung[$i],
												'tmpdiklatjafung'=>$tmpdiklatjafung[$i],
												'tglselesai'=>$tglselesaijafung[$i],
												'no_sertifikat'=>$nosertifikat[$i],
												'tgl_sertifikat'=>$tglsertifikat[$i],
												'jml_jam'=>$jmljam[$i],
												'file_sertifikat'=> $new_name,
												'updatedate'=>date('y-m-d H:i:s'),
												'tahun'=>$tahun
												);
													$this->db->insert('tr_survey_diklatjafung',$datainsert);
												
									
									}
								}else {
									if ($idjafung[$i]!='') {
												$data = array(
												'id_pegawai'=>$id_pegawai,
												'jnsdiklatjafung'=>$jenisdiklatjafung[$i],
												'tgldiklatjafung'=>$tgldiklatjafung[$i],
												'tmpdiklatjafung'=>$tmpdiklatjafung[$i],
												'file_sertifikat'=> $filedok[$i],
												'tglselesai'=>$tglselesaijafung[$i],
												'no_sertifikat'=>$nosertifikat[$i],
												'tgl_sertifikat'=>$tglsertifikat[$i],
												'jml_jam'=>$jmljam[$i],
												'updatedate'=>date('y-m-d H:i:s'),
												'tahun'=>$tahun
												);				
												
												$this->db->trans_start();
												$this->db->where('id', $idjafung[$i]);
												$this->db->update('tr_survey_diklatjafung',$data);
												$this->db->trans_complete();
											
									}
									else {
												$datainsert = array(
												'id_pegawai'=>$id_pegawai,
												'jnsdiklatjafung'=>$jenisdiklatjafung[$i],
												'tgldiklatjafung'=>$tgldiklatjafung[$i],
												'tmpdiklatjafung'=>$tmpdiklatjafung[$i],
												'tglselesai'=>$tglselesaijafung[$i],
												'no_sertifikat'=>$nosertifikat[$i],
												'tgl_sertifikat'=>$tglsertifikat[$i],
												'jml_jam'=>$jmljam[$i],
												'file_sertifikat'=> '',
												'updatedate'=>date('y-m-d H:i:s'),
												'tahun'=>$tahun
												);
													$this->db->insert('tr_survey_diklatjafung',$datainsert);
												
									
									}
								}
				 }
				}
				else{
							$this->db->delete('tr_survey_diklatjafung',array('id_pegawai'=>$id_pegawai, 'tahun' => 2022));
				}
				 	
    }
	
	public function save_survey_seminar($id_pegawai)
    {
		
			$seminar = $this->input->post("tampilseminar");
			
			if ($seminar=='sdhseminar') {
				
				$jnsseminar =  $this->input->post("jnsseminar");
				$tglseminar = $this->input->post("tglseminar"); 
				$tglselesai = $this->input->post("tglselesaismnr"); 
				$tmpseminar = $this->input->post("tmpseminar");
				$nosertifikat = $this->input->post("nosertifikatsmnr");
				$tglsertifikat = $this->input->post("tglsertifikatsmnr");
				$jmljam = $this->input->post("jmljamsmnr");
				$berkasseminar = $this->input->post("berkasseminar");
				$tahun= 2022;
				$idseminar =  $this->input->post("idseminar");
				$filedok = $this->input->post("filedokseminar");
				//$i=0;
				
				//for ($i =0; $i < count(jnsdiklatpim); $i++) 
				foreach($jnsseminar as $i => $b)
				 {		
							
								if(!empty($_FILES['berkasseminar']['name'][$i])){
										
									$config['upload_path']          = './uploads/';
									$config['allowed_types']        = 'gif|jpg|jpeg|png|pdf';
									$config['max_size']             = 1000;
									// $config['max_width']            = 2048;
									// $config['max_height']           = 1000;
									$this->load->library('upload',$config);
									
									$_FILES['file']['name'] = $_FILES['berkasseminar']['name'][$i]; 
									$_FILES['file']['type'] = $_FILES['berkasseminar']['type'][$i];
									$_FILES['file']['tmp_name'] = $_FILES['berkasseminar']['tmp_name'][$i];
									$_FILES['file']['error'] = $_FILES['berkasseminar']['error'][$i];
									$_FILES['file']['size'] = $_FILES['berkasseminar']['size'][$i];
									
									if($this->upload->do_upload('file')){
										
										$uploadData = $this->upload->data();
										$new_name = $id_pegawai.'_'.$uploadData['file_name'];
										rename($uploadData['full_path'],$uploadData['file_path'].$new_name);
									}
								
									if ($idseminar[$i]!='') {
												$data = array(
												'id_pegawai'=>$id_pegawai,
												'jnsseminar'=>$jnsseminar[$i],
												'tglseminar'=>$tglseminar[$i],
												'tmpseminar'=>$tmpseminar[$i],
												'tglselesai'=>$tglselesai[$i],
												'nosertifikat'=>$nosertifikat[$i],
												'tglsertifikat'=>$tglsertifikat[$i],
												'jmljam'=>$jmljam[$i],
												'updatedate'=>date('y-m-d H:i:s'),
												'tahun'=>$tahun
												);				
												
												$this->db->trans_start();
												$this->db->where('id', $idseminar[$i]);
												$this->db->update('tr_survey_seminar',$data);
												$this->db->trans_complete();
											
									}
									else {
												$datainsert = array(
												'id_pegawai'=>$id_pegawai,
												'jnsseminar'=>$jnsseminar[$i],
												'tglseminar'=>$tglseminar[$i],
												'tmpseminar'=>$tmpseminar[$i],
												'tglselesai'=>$tglselesai[$i],
												'nosertifikat'=>$nosertifikat[$i],
												'tglsertifikat'=>$tglsertifikat[$i],
												'jmljam'=>$jmljam[$i],
												'file_sertifikat'=> $new_name,
												'updatedate'=>date('y-m-d H:i:s'),
												'tahun'=>$tahun
												);
													$this->db->insert('tr_survey_seminar',$datainsert);
												
									
									}
								}else {
									if ($idseminar[$i]!='') {
												$data = array(
												'id_pegawai'=>$id_pegawai,
												'jnsseminar'=>$jnsseminar[$i],
												'tglseminar'=>$tglseminar[$i],
												'tmpseminar'=>$tmpseminar[$i],
												'tglselesai'=>$tglselesai[$i],
												'nosertifikat'=>$nosertifikat[$i],
												'tglsertifikat'=>$tglsertifikat[$i],
												'jmljam'=>$jmljam[$i],
												'file_sertifikat'=> $filedok[$i],
												'updatedate'=>date('y-m-d H:i:s'),
												'tahun'=>$tahun
												);				
												
												$this->db->trans_start();
												$this->db->where('id', $idseminar[$i]);
												$this->db->update('tr_survey_seminar',$data);
												$this->db->trans_complete();
											
									}
									else {
												$datainsert = array(
												'id_pegawai'=>$id_pegawai,
												'jnsseminar'=>$jnsseminar[$i],
												'tglseminar'=>$tglseminar[$i],
												'tmpseminar'=>$tmpseminar[$i],
												'tglselesai'=>$tglselesai[$i],
												'nosertifikat'=>$nosertifikat[$i],
												'tglsertifikat'=>$tglsertifikat[$i],
												'jmljam'=>$jmljam[$i],
												'file_sertifikat'=> '',
												'updatedate'=>date('y-m-d H:i:s'),
												'tahun'=>$tahun
												);
													$this->db->insert('tr_survey_seminar',$datainsert);
												
									
									}
								}
				 }
				}
				else{
							$this->db->delete('tr_survey_seminar',array('id_pegawai'=>$id_pegawai, 'tahun' => 2022));
				}
			// echo '<script language="javascript">';
			// echo 'alert("seminarip")';
			// echo '</script>';
		
    }
	
	public function save_survey_diklat20jp($id_pegawai)
    {
				$diklat20jp = $this->input->post("tampil20jp");
			
			if ($diklat20jp=='sdhdiklat20jp') {
				
				$jnsdiklat20jp =  $this->input->post("jenisdiklatjp");
				$tgldiklat20jp = $this->input->post("tgldiklatjp"); 
				$tmpdiklat20jp = $this->input->post("tmpdiklatjp");	
				$berkasjp = $this->input->post("berkasjp");
				$tglselesaijp = $this->input->post("tglselesaijp");
				$nosertifikatjp = $this->input->post("nosertifikatjp");
				$tglsertifikatjp = $this->input->post("tglsertifikatjp");
				$jmljamjp = $this->input->post("jmljamjp");
				$tahun= 2022;	
				$idjp =  $this->input->post("idjp");
				$filedok = $this->input->post("filedokjp");
				//$i=0;
				
				//for ($i =0; $i < count(jnsdiklatpim); $i++) 
				foreach($jnsdiklat20jp as $i => $b)
				 {		
							
								if(!empty($_FILES['berkasjp']['name'][$i])){
										
									$config['upload_path']          = './uploads/';
									$config['allowed_types']        = 'gif|jpg|jpeg|png|pdf';
									$config['max_size']             = 1000;
									// $config['max_width']            = 2048;
									// $config['max_height']           = 1000;
									$this->load->library('upload',$config);
									
									$_FILES['file']['name'] = $_FILES['berkasjp']['name'][$i]; 
									$_FILES['file']['type'] = $_FILES['berkasjp']['type'][$i];
									$_FILES['file']['tmp_name'] = $_FILES['berkasjp']['tmp_name'][$i];
									$_FILES['file']['error'] = $_FILES['berkasjp']['error'][$i];
									$_FILES['file']['size'] = $_FILES['berkasjp']['size'][$i];
									
									if($this->upload->do_upload('file')){
										
										$uploadData = $this->upload->data();
										$new_name = $id_pegawai.'_'.$uploadData['file_name'];
										rename($uploadData['full_path'],$uploadData['file_path'].$new_name);
									}
								
									if ($idjp[$i]!='') {
												$data = array(
												'id_pegawai'=>$id_pegawai,
												'jns_diklat'=>$jnsdiklat20jp[$i],
												'tgl_diklat'=>$tgldiklat20jp[$i],
												'tmp_diklat'=>$tmpdiklat20jp[$i],
												'tglselesai'=>$tglselesaijp[$i],
												'nosertifikat'=>$nosertifikatjp[$i],
												'tglsertifikat'=>$tglsertifikatjp[$i],
												'jmljam'=>$jmljamjp[$i],
												'file_sertifikat'=>$new_name,
												'updatedate'=>date('y-m-d H:i:s'),
												'tahun'=>$tahun
												);				
												
												$this->db->trans_start();
												$this->db->where('id', $idjp[$i]);
												$this->db->update('tr_survey_diklat20jp',$data);
												$this->db->trans_complete();
											
									}
									else {
												$datainsert = array(
												'id_pegawai'=>$id_pegawai,
												'jns_diklat'=>$jnsdiklat20jp[$i],
												'tgl_diklat'=>$tgldiklat20jp[$i],
												'tmp_diklat'=>$tmpdiklat20jp[$i],
												'tglselesai'=>$tglselesaijp[$i],
												'nosertifikat'=>$nosertifikatjp[$i],
												'tglsertifikat'=>$tglsertifikatjp[$i],
												'jmljam'=>$jmljamjp[$i],
												'file_sertifikat'=> $new_name,
												'updatedate'=>date('y-m-d H:i:s'),
												'tahun'=>$tahun
												);
													$this->db->insert('tr_survey_diklat20jp',$datainsert);
												
									
									}
								}else {
									if ($idjp[$i]!='') {
												$data = array(
												'id_pegawai'=>$id_pegawai,
												'jns_diklat'=>$jnsdiklat20jp[$i],
												'tgl_diklat'=>$tgldiklat20jp[$i],
												'tmp_diklat'=>$tmpdiklat20jp[$i],
												'tglselesai'=>$tglselesaijp[$i],
												'nosertifikat'=>$nosertifikatjp[$i],
												'tglsertifikat'=>$tglsertifikatjp[$i],
												'jmljam'=>$jmljamjp[$i],
												'file_sertifikat'=> $filedok[$i],
												'updatedate'=>date('y-m-d H:i:s'),
												'tahun'=>$tahun
												);				
												
												$this->db->trans_start();
												$this->db->where('id', $idjp[$i]);
												$this->db->update('tr_survey_diklat20jp',$data);
												$this->db->trans_complete();
											
									}
									else {
												$datainsert = array(
												'id_pegawai'=>$id_pegawai,
												'jns_diklat'=>$jnsdiklat20jp[$i],
												'tgl_diklat'=>$tgldiklat20jp[$i],
												'tmp_diklat'=>$tmpdiklat20jp[$i],
												'tglselesai'=>$tglselesaijp[$i],
												'nosertifikat'=>$nosertifikatjp[$i],
												'tglsertifikat'=>$tglsertifikatjp[$i],
												'jmljam'=>$jmljamjp[$i],
												'updatedate'=>date('y-m-d H:i:s'),
												'file_sertifikat'=> '',
												'tahun'=>$tahun
												);
													$this->db->insert('tr_survey_diklat20jp',$datainsert);
												
									
									}
								}
				 }
				}
				else{
							$this->db->delete('tr_survey_diklat20jp',array('id_pegawai'=>$id_pegawai, 'tahun' => 2022));
				}
				 	// echo '<script language="javascript">';
			// echo 'alert("diklat20jpok")';
			// echo '</script>';
				
    }


	public function check_data_menit_efektif_rpt()
	{
		# code...
		$bulan = date('m');
		$tahun = date('Y'); 
		$sql = "SELECT
					a.id_pegawai,
					a.bulan,
					a.tahun,
					a.tr_approve,
					a.menit_efektif,
					b.jml_menit AS tr_Menit_efektif
				FROM
					rpt_capaian_kinerja a
				LEFT JOIN (
					SELECT
						id_pegawai,
						SUM(`menit_efektif`) jml_menit
					FROM
						`tr_capaian_pekerjaan`
					WHERE
						MONTH (`tanggal_mulai`) = 4
					AND `status_pekerjaan` = 1
					GROUP BY
						`id_pegawai`
				) b ON b.id_pegawai = a.id_pegawai
				WHERE a.bulan = 4
				AND a.menit_efektif <> b.jml_menit";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return 0;
		}								
	}	

	public function get_data_menit_efektif($param)
	{
		# code...
		$bulan = date('m');
		$tahun = date('Y'); 
		$sql = "SELECT SUM(".$param.") as jumlah
				FROM tr_capaian_pekerjaan a
				JOIN mr_skp_pegawai b ON a.id_uraian_tugas = b.skp_id
				JOIN mr_pegawai c ON a.id_pegawai = c.id
				WHERE a.tanggal_mulai LIKE '%".date('Y-m')."%'
				AND a.tanggal_selesai LIKE '%".date('Y-m')."%'
				AND a.id_pegawai = '".$this->session->userdata('sesUser')."'
				AND a.status_pekerjaan = '1'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result()[0]->jumlah;
		}
		else
		{
			return 0;
		}								
	}
	
	public function get_total_ip()
	{
		
		$sql = "SELECT 
						n_kualifikasi+n_diklat_pim+n_diklat_jafung+n_diklat_20jp+n_seminar+n_penilaian_kinerja+n_hukuman_disiplin AS nilai_totalip 
				FROM tr_survey_ip 
				WHERE tahun = 2022
				AND id_pegawai = '".$this->session->userdata('sesUser')."' ";
	 	$query = $this->db->query($sql);
	 	if($query->num_rows() > 0)
	 	{
	 		return $query->result()[0]->nilai_totalip;
	 	}
	 	else
	 	{
	 		return 0;
	 	}	
	}	
	
	public function get_data_notify_user($param,$id_pegawai)
	{
		# code...
		$sql = "SELECT a.*
				FROM log_notifikasi a
				WHERE a.receiver = '".$id_pegawai."'
				AND a.status_log = '".$param."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return 0;
		}								
	}
	
	public function get_history_golongan()
	{
		# code...
		$sql = "SELECT b.nama_pangkat, a.tmt
				FROM mr_history_golongan a
				JOIN mr_golongan b
				ON a.id_golongan = b.id
				WHERE a.id_pegawai = '".$this->session->userdata('sesUser')."'
				ORDER BY a.id";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return 0;
		}								
	}	

	public function get_data_dashboard($set_menit_efektif=NULL)
	{
	 	# code...
	 	$bulan = date('m');
	 	$tahun = date('Y'); 
	 	#JOIN mr_skp_pegawai b ON a.id_uraian_tugas = b.skp_id
	 	$sql = "SELECT a.*,
						a.real_tunjangan as tunjangankinerja
				FROM rpt_capaian_kinerja a
				WHERE a.tahun = '".$tahun."'
				AND a.bulan = '".$bulan."'
				AND a.id_pegawai = '".$this->session->userdata('sesUser')."'
				AND a.id_posisi = '".$this->session->userdata('sesPosisi')."'";
	 	$query = $this->db->query($sql);
	 	if($query->num_rows() > 0)
	 	{
	 		return $query->result();
	 	}
	 	else
	 	{
	 		return 0;
	 	}								
	}	
}