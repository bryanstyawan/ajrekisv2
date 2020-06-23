<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Kinerja extends \Restserver\Libraries\REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('m_api', '', TRUE);      
        $this->load->database();          
    }

    public function summary_post()
    {
        $nip   = $this->input->post('nip');
        $month = $this->input->post('bulan');
        $year  = $this->input->post('tahun');                
        $nip   = htmlspecialchars($nip, ENT_QUOTES| ENT_COMPAT, 'UTF-8');
        $bulan = htmlspecialchars($month, ENT_QUOTES| ENT_COMPAT, 'UTF-8');
        $tahun  = htmlspecialchars($year, ENT_QUOTES| ENT_COMPAT, 'UTF-8');
        $users = $this->m_api->get_pegawai($nip);
        if ($users != 0)
        {
            $transact = $this->m_api->get_transact($nip,1,$bulan,$tahun);            

            $res_pegawai = array
            (
                'nip'                    => $users[0]->nip,
                'nama'                   => $users[0]->nama_pegawai,
            );
            
            if ($transact != 0) {
                # code...

                $res_data_tr = array
                            (
                                'tunjangan'              => $transact[0]->real_tunjangan,
                                'menit_kerja'            => $transact[0]->menit_efektif,
                                'persentase_menit_kerja' => $transact[0]->prosentase_menit_efektif,
                                'tr_belum_diperiksa'     => $transact[0]->tr_belum_diperiksa,
                                'tr_disetujui'           => $transact[0]->tr_approve,
                                'tr_ditolak'             => $transact[0]->tr_tolak,
                                'tr_revisi'              => $transact[0]->tr_revisi
                            );

                $data = array
                        (
                            'res_pegawai'   => $res_pegawai,
                            'res_transaksi' => $res_data_tr 
                        );

                $res_data = array(
                                    'status' => TRUE,
                                    'data'   => $data
                                );
                $this->response($res_data, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code                
            }
            else {
                # code...
                $data = array
                        (
                            'res_pegawai' => $res_pegawai,
                            'res_data'    => '' 
                        );

                $res_data = array(
                                    'status' => FALSE,
                                    'data'   => $data
                                );
                $this->response($res_data, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code                                
            }

        }
        else
        {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'data'   => ''
            ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function summary_sikerja_post()
    {
        # code...
        $nip   = $this->input->post('nip');
        $month = $this->input->post('bulan');
        $year  = $this->input->post('tahun');                
        $nip   = htmlspecialchars($nip, ENT_QUOTES| ENT_COMPAT, 'UTF-8');
        $bulan = htmlspecialchars($month, ENT_QUOTES| ENT_COMPAT, 'UTF-8');
        $tahun  = htmlspecialchars($year, ENT_QUOTES| ENT_COMPAT, 'UTF-8');        
        $users = $this->m_api->get_pegawai($nip);
        if ($users != 0)
        {
            $res_data = $this->m_api->api_kinerja('kinerja','eselon2 ASC,
            eselon3 ASC,
            eselon4 ASC,
            kat_posisi ASC,
            atasan ASC',array
            (
                'eselon1'    => '',
                'eselon2'    => '',
                'eselon3'    => '',
                'eselon4'    => '',
                'bulan'      => $bulan,
                'tahun'		 => $tahun,
                'pegawai'	 => $users[0]->id,
                'posisi'	 => $users[0]->posisi																		
            ));

            $menit_efektif_year = $this->m_api->get_menit_efektif_year($users[0]->id,$tahun);
            $data_value[] = "";
            
            if ($menit_efektif_year != 0) {
                // code...
                for ($i=0; $i < count($menit_efektif_year); $i++) {
                    // code...
                    $data_value[$i] = array(
                        'value' => $menit_efektif_year[$i]->menit_efektif,
                        'month' => $menit_efektif_year[$i]->nama_bulan
                    );
                }
            }                        

            $data_wrap = array(
                'kinerja' => array(
                    'pekerjaan_belum_diperiksa'          => ($res_data != 0) ? $res_data[0]->tr_belum_diperiksa : 0,
                    'pekerjaan_disetujui'                => ($res_data != 0) ? $res_data[0]->tr_approve : 0,
                    'tunjangan'                          => ($res_data != 0) ? $res_data[0]->real_tunjangan : 0,
                    'menit_efektif'                      => ($res_data != 0) ? $res_data[0]->menit_efektif : 0,
                    'persentase_realisasi_menit_efektif' => ($res_data != 0) ? $res_data[0]->prosentase_menit_efektif : 0,                    
                ),
                'statistik' => $data_value                
                
            );

            $data = array
                    (
                        // 'res_pegawai'   => $users,
                        'res_data' => $data_wrap,
                        // 'res_trans'     => $res_data 
                    );

            $res_data = array(
                                'status' => TRUE,
                                'data'   => $data
                            );
            $this->response($res_data, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code            
        }        
    }

    public function summary_skp_post()
    {
        # code...
        $nip   = $this->input->post('nip');
        $month = $this->input->post('bulan');
        $year  = $this->input->post('tahun');                
        $nip   = htmlspecialchars($nip, ENT_QUOTES| ENT_COMPAT, 'UTF-8');
        $bulan = htmlspecialchars($month, ENT_QUOTES| ENT_COMPAT, 'UTF-8');
        $tahun  = htmlspecialchars($year, ENT_QUOTES| ENT_COMPAT, 'UTF-8');        
        $users = $this->m_api->get_pegawai($nip);


        $data_atasan = array();
        $data_atasan_penilai = array();
        $data_atasan_akademik = array();
        $data_atasan_plt = array();
        if ($users != 0)
        {

            $skp_prilaku = $this->spk_prilaku($users,$tahun);
            $data_skp    = $this->result_skp($users,$tahun);

            $_id_posisi = $users[0]->posisi;
            $_atasan_data        = $this->m_api->list_atasan($_id_posisi);
            $_atasan_id          = ($_atasan_data == 0) ? 0 : $_atasan_data[0]->id;
            $_atasan_id_posisi   = ($_atasan_data == 0) ? 0 : $_atasan_data[0]->posisi;		
            $data_atasan      = ($_atasan_data == 0) ? 0 : $this->m_api->get_info_pegawai($_atasan_id,'id',$_atasan_id_posisi); 		
            if ($_atasan_data == 0) {
                # code...
                $data_atasan_akademik = $this->m_api->list_atasan_akademik($_id_posisi);			
                $data_atasan_plt = $this->m_api->list_atasan_plt($_id_posisi);
                // print_r($data['atasan_plt']);die();
            }		
            
            if ($data_atasan != 0) 
            {
                $nip              = $data_atasan[0]->nip;
                $get_pangkat      = $this->m_api->get_golongan($nip);
                if ($get_pangkat != array()) {
                    # code...
                    $data_atasan[0]->nama_golongan = $get_pangkat[0]->golongan;
                    $data_atasan[0]->nama_pangkat  = $get_pangkat[0]->nama_pangkat;
                    $data_atasan[0]->tmt_pangkat   = $get_pangkat[0]->tmt_pangkat;						
                }
                else
                {
                    $data_atasan[0]->nama_golongan = '-';
                    $data_atasan[0]->nama_pangkat  = '-';
                    $data_atasan[0]->tmt_pangkat   = '-';				
                }													
    
                $check_atasan_again = $this->m_api->getData('mr_posisi',array('id' => $data_atasan[0]->posisi))->result_array();
                if($check_atasan_again != array())
                {			
                    if ($check_atasan_again[0]['id'] == 0) {
                        # code...
                        // $data_atasan = 0;
                    }
                    else
                    {
    
                        $_atasan_data                = $this->m_api->list_atasan($check_atasan_again[0]['id']);
                        $_atasan_id                  = ($_atasan_data == 0) ? 0 : $_atasan_data[0]->id;
                        $_atasan_id_posisi           = ($_atasan_data == 0) ? 0 : $_atasan_data[0]->posisi;		
                        $data_atasan_penilai      = ($_atasan_data == 0) ? 0 : $this->m_api->get_info_pegawai($_atasan_id,'id',$_atasan_id_posisi); 
    
                        if ($data_atasan_penilai == 0) {
                            # code...
                            $_atasan_data           = $this->m_api->list_atasan($_id_posisi);
                            $_atasan_id             = ($_atasan_data == 0) ? 0 : $_atasan_data[0]->id;
                            $_atasan_id_posisi      = ($_atasan_data == 0) ? 0 : $_atasan_data[0]->posisi;		
                            $data_atasan_penilai = ($_atasan_data == 0) ? 0 : $this->m_api->get_info_pegawai($_atasan_id,'id',$_atasan_id_posisi); 
    
                        }
    
                        if ($data_atasan_penilai != 0) {
                            # code...
                            $nip              = $data_atasan_penilai[0]->nip;
                            $get_pangkat      = $this->m_api->m_api->get_golongan($nip);
                            if ($get_pangkat != array()) {
                                # code...
                                $data_atasan_penilai[0]->nama_golongan = $get_pangkat[0]->golongan;
                                $data_atasan_penilai[0]->nama_pangkat  = $get_pangkat[0]->nama_pangkat;
                                $data_atasan_penilai[0]->tmt_pangkat   = $get_pangkat[0]->tmt_pangkat;						
                            }
                            else
                            {
                                $data_atasan_penilai[0]->nama_golongan = '-';
                                $data_atasan_penilai[0]->nama_pangkat  = '-';
                                $data_atasan_penilai[0]->tmt_pangkat   = '-';									
                            }						
                        }
                        else
                        {
                            $data_atasan_penilai[0]->nama_golongan = '-';
                            $data_atasan_penilai[0]->nama_pangkat  = '-';
                            $data_atasan_penilai[0]->tmt_pangkat   = '-';						
                        }
                                                        
    
                    }
                }
            }
            else
            {
                $data_atasan_penilai = 0;			
                // $data['atasan'][0]->nama_golongan = '-';
                // $data['atasan'][0]->nama_pangkat  = '-';
                // $data['atasan'][0]->tmt_pangkat   = '-';			
            }            


            $data_wrap = array(
                'atasan' => array(
                    'atasan'          => $data_atasan,
                    'atasan_akademik' => $data_atasan_akademik,
                    'atasan_plt'      => $data_atasan_plt,
                    'atasan_penilai'  => $data_atasan_penilai
                ),
                'skp' => array(
                    'tugas_tambahan'         => $this->tugas_tambahan_kreatifitas($users[0]->id,$tahun,NULL),
                    'kreativitas'            => $this->tugas_tambahan_kreatifitas($users[0]->id,$tahun,'kreativitas'),
                    'penilaian_prilaku'      => $skp_prilaku['summary_prilaku_skp'],
                    'nilai_prilaku_kerja'    => $skp_prilaku['result']['nilai_prilaku_kerja'],
                    'nilai_capaian_skp'      => $data_skp['summary_skp']['nilai_sasaran_kinerja_pegawai'],
                    'nilai_prestasi_skp'     => $data_skp['summary_skp_dan_prilaku'],
                    'persentase_capaian_skp' => $data_skp['persentase_target_realisasi']->persentase
                )
            );

            $data = array
                    (
                        // 'res_pegawai'   => $users,
                        'res_data' => $data_wrap,
                        // 'res_trans'     => $res_data 
                    );

            $res_data = array(
                                'status' => TRUE,
                                'data'   => $data
                            );
            $this->response($res_data, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code            
        }        
    }    

    public function tugas_tambahan_kreatifitas($id,$tahun,$arg)
    {
        # code...
		return $this->m_api->get_summary_tugas_tambahan($id,$tahun,$arg);        
    }

	public function get_penilaian_prilaku($value_atasan,$value_peer,$value_bawahan,$PARAM=NULL,$counter=NULL)
	{
		# code...
		$data = "";
		if ($PARAM == 'status') {
			# code...
			$data = (($value_atasan + $value_peer + $value_bawahan)/$counter)*100;
		}
		else
		{
			if ($value_bawahan == 0) {
				# code...
				$value_atasan = ($value_atasan*60)/100;
				$value_peer   = ($value_peer*40)/100;
			}
			else
			{
				$value_atasan  = $value_atasan*60/100;
				$value_peer    = $value_peer*20/100;
				$value_bawahan = $value_bawahan*20/100;
			}
			$data = $value_atasan + $value_peer + $value_bawahan;
		}

    	return $data;
    }    
    
    public function spk_prilaku($users,$tahun)
    {
        # code...
        // print_r($users);die();
        $jabatan = $this->m_api->get_posisi($users[0]->posisi);            
        $atasan = ($jabatan != array()) ? $jabatan[0]->atasan : '' ;
        $data['evaluator']               = $this->m_api->get_data_evaluator($users[0]->id,$tahun);            
        $data['nilai_prilaku_atasan']    = $this->m_api->get_nilai_prilaku($users[0]->id,$users[0]->posisi,'atasan',$tahun,$users[0]->id);
        $data['nilai_prilaku_peer']      = $this->m_api->get_nilai_prilaku($users[0]->id,$users[0]->posisi,'peer',$tahun,$users[0]->id);
        $data['nilai_prilaku_bawahan']   = $this->m_api->get_nilai_prilaku($users[0]->id,$users[0]->posisi,'bawahan',$tahun,$users[0]->id);            

        $data['summary_prilaku_skp']['integritas']          = $this->get_penilaian_prilaku($data['nilai_prilaku_atasan'][0]->integritas,$data['nilai_prilaku_peer'][0]->integritas,$data['nilai_prilaku_bawahan'][0]->integritas);
        $data['summary_prilaku_skp']['orientasi_pelayanan'] = $this->get_penilaian_prilaku($data['nilai_prilaku_atasan'][0]->orientasi_pelayanan,$data['nilai_prilaku_peer'][0]->orientasi_pelayanan,$data['nilai_prilaku_bawahan'][0]->orientasi_pelayanan);
        $data['summary_prilaku_skp']['komitmen']            = $this->get_penilaian_prilaku($data['nilai_prilaku_atasan'][0]->komitmen,$data['nilai_prilaku_peer'][0]->komitmen,$data['nilai_prilaku_bawahan'][0]->komitmen);
        $data['summary_prilaku_skp']['disiplin']            = $this->get_penilaian_prilaku($data['nilai_prilaku_atasan'][0]->disiplin,$data['nilai_prilaku_peer'][0]->disiplin,$data['nilai_prilaku_bawahan'][0]->disiplin);
        $data['summary_prilaku_skp']['kerjasama']           = $this->get_penilaian_prilaku($data['nilai_prilaku_atasan'][0]->kerjasama,$data['nilai_prilaku_peer'][0]->kerjasama,$data['nilai_prilaku_bawahan'][0]->kerjasama);
        $data['summary_prilaku_skp']['kepemimpinan']        = $this->get_penilaian_prilaku($data['nilai_prilaku_atasan'][0]->kepemimpinan,$data['nilai_prilaku_peer'][0]->kepemimpinan,$data['nilai_prilaku_bawahan'][0]->kepemimpinan);
        $data['result']['status']                           = $this->get_penilaian_prilaku($data['nilai_prilaku_atasan'][0]->status,$data['nilai_prilaku_peer'][0]->status,$data['nilai_prilaku_bawahan'][0]->status,'status',($data['evaluator'] == 0) ? 1 : count($data['evaluator']));
        $data['result']['jumlah']                           = $data['summary_prilaku_skp']['orientasi_pelayanan'] + $data['summary_prilaku_skp']['integritas'] + $data['summary_prilaku_skp']['komitmen'] + $data['summary_prilaku_skp']['disiplin'] + $data['summary_prilaku_skp']['kerjasama'] + $data['summary_prilaku_skp']['kepemimpinan'];
		$data['result']['rata_rata']                         = ($users != 0) ? ($users[0]->kat_posisi == 1 || $users[0]->kat_posisi == 6) ? $data['result']['jumlah'] / 6 : $data['result']['jumlah'] / 5  : 0 ;
        $data['result']['nilai_prilaku_kerja']              = ($data['result']['rata_rata']*40)/100;        

        return $data;
    }

    public function summary_skp_prilaku_post()
    {
        # code...
        $nip   = $this->input->post('nip');
        $month = $this->input->post('bulan');
        $year  = $this->input->post('tahun');                
        $nip   = htmlspecialchars($nip, ENT_QUOTES| ENT_COMPAT, 'UTF-8');
        $tahun  = htmlspecialchars($year, ENT_QUOTES| ENT_COMPAT, 'UTF-8');        
        $users = $this->m_api->get_pegawai($nip);
        if ($users != 0)
        {
            $skp_prilaku = $this->spk_prilaku($users,$tahun);
            $data = array
                    (
                        // 'res_pegawai'   => $users,
                        'res_data'      => $skp_prilaku['result'] 
                    );

            $res_data = array(
                                'status' => TRUE,
                                'data'   => $data
                            );
            $this->response($res_data, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code            
        }        
    }
    
    public function summary_skp_prestasi_post()
    {
        # code...
        $nip   = $this->input->post('nip');
        $month = $this->input->post('bulan');
        $year  = $this->input->post('tahun');                
        $nip   = htmlspecialchars($nip, ENT_QUOTES| ENT_COMPAT, 'UTF-8');
        $tahun  = htmlspecialchars($year, ENT_QUOTES| ENT_COMPAT, 'UTF-8');        
        $users = $this->m_api->get_pegawai($nip);
        if ($users != 0)
        {
            $data_skp    = $this->result_skp($users,$tahun);            
            $data_wrap = array(
                'skp' => array(
                    'nilai_capaian_skp'      => $data_skp['summary_skp']['nilai_sasaran_kinerja_pegawai']
                )                
            );

            
            $data = array
                    (
                        // 'res_pegawai'   => $users,
                        'res_data' => $data_wrap 
                    );

            $res_data = array(
                                'status' => TRUE,
                                'data'   => $data
                            );
            $this->response($res_data, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code            
        }        
    }    
    
	public function aspek_kuantitas($realisasi_kuantitas=NULL,$target_qty=NULL,$realisasi_kualitasmutu=NULL)
	{
		# code...
		$aspek_kuantitas = 0;
		if ($realisasi_kualitasmutu == 0) {
			# code...
			$aspek_kuantitas = 0;
		}
		else
		{
			if ($realisasi_kuantitas != 0 && $target_qty != 0) {
				# code...
				if ($realisasi_kualitasmutu == 0) {
					# code...
					$realisasi_kuantitas = 0;
				}
				$aspek_kuantitas = ($realisasi_kuantitas/$target_qty)*100;
			}
		}		

	    return $aspek_kuantitas;
	}

	public function aspek_kualitas($realisasi_kualitasmutu,$target_kualitasmutu)
	{
		# code...
		$aspek_kualitas = "";
        if ($realisasi_kualitasmutu != 0 && $target_kualitasmutu != 0) {
            # code...
            $aspek_kualitas  = ($realisasi_kualitasmutu/$target_kualitasmutu)*100;
        }

        return $aspek_kualitas;
	}

	public function aspek_waktu($realisasi_waktu,$target_waktu_bln,$kegiatan)
	{
		# code...
		$aspek_waktu       = 0;
		$tingkat_efisiensi = 0;

		// $aspek_waktu = ((1.76 * $target_waktu_bln - $realisasi_waktu)/$target_waktu_bln)*100;
		if ($kegiatan == 0) {
			// # code...
			$aspek_waktu = ((1.76 * $target_waktu_bln - $realisasi_waktu)/$target_waktu_bln)*0*100;
		}
		else
		{
			$tingkat_efisiensi = $this->tingkat_efisiensi($target_waktu_bln,$realisasi_waktu);
			if ($tingkat_efisiensi <= 24) {
				# code...
				//nilai baik
				$aspek_waktu = ((1.76 * $target_waktu_bln - $realisasi_waktu)/$target_waktu_bln)*100;
			}
			elseif ($tingkat_efisiensi > 24) {
					# code...
				//nilai cukup-buruk
			$aspek_waktu = 76 - ((((1.76 * $target_waktu_bln - $realisasi_waktu)/$target_waktu_bln)*100) - 100);
			}
		}

		return array
		(
			'aspek_waktu'       => $aspek_waktu,
			'tingkat_efisiensi' => $tingkat_efisiensi
		);
	}

	public function aspek_biaya($realisasi_biaya,$target_biaya,$kegiatan)
	{
		# code...
		$aspek_biaya = "";
		if ($kegiatan == 0) {
			# code...
        if ($target_biaya != 0 && $realisasi_biaya != 0) {
            # code...
            $aspek_biaya = ((1.76 * $target_biaya - $realisasi_biaya)/$target_biaya)*0*100;
        }
		}
		else
		{
			if ($target_biaya != 0 && $realisasi_biaya != 0) {
				# code...
				$tingkat_efisiensi = $this->tingkat_efisiensi($target_biaya,$realisasi_biaya);
				if ($tingkat_efisiensi <= 24) {
					# code...
					//nilai baik
					$aspek_biaya = ((1.76 * $target_biaya - $realisasi_biaya)/$target_biaya)*100;
				}
				else {
					// code...
					$aspek_biaya = 76 - ((((1.76 * $target_biaya - $realisasi_biaya)/$target_biaya)*100) - 100);
				}
			}
		}
	}

	public function tingkat_efisiensi($target,$realisasi)
	{
		# code..
		$tingkat_efisiensi = "";
	    if ($target != 0 && $realisasi != 0) {
	        # code...
	        $tingkat_efisiensi = 100 - (($realisasi/$target)*100);
	    }
	    return $tingkat_efisiensi;
    }

	public function perhitungan_skp($aspek_kuantitas=NULL,$aspek_kualitas=NULL,$aspek_waktu=NULL,$aspek_biaya=NULL,$target_biaya=NULL)
	{
		# code...
		if($aspek_kuantitas == NULL)$aspek_kuantitas = 0;
		if($aspek_kualitas == NULL)$aspek_kualitas   = 0;
		if($aspek_waktu == NULL)$aspek_waktu         = 0;
		if($aspek_biaya == NULL)$aspek_biaya         = 0;

		$aspek = ($target_biaya == 0) ? ($aspek_kuantitas + $aspek_kualitas + $aspek_waktu) : ($aspek_kuantitas + $aspek_kualitas + $aspek_waktu + $aspek_biaya) ;
		$nilai_capaian_skp = ($target_biaya == 0) ? (($aspek_kuantitas + $aspek_kualitas + $aspek_waktu)/3) : (($aspek_kuantitas + $aspek_kualitas + $aspek_waktu + $aspek_biaya)/4) ;
		return array
		(
			'aspek'             => $aspek,
			'nilai_capaian_skp' => $nilai_capaian_skp
		);
	}

	public function nilai_tugas_tambahan($param)
	{
		# code...
		$value = "";
		if ($param <= 3) {
			# code...
			$value = 1;
		}
		elseif ($param <= 6) {
			# code...
			$value = 2;
		}
		elseif ($param > 6) {
			# code...
			$value = 3;
		}

		return $value;
    }    
    
    public function result_skp($users,$tahun)
    {
        # code...
        $skp_prilaku = $this->spk_prilaku($users,$tahun);        
        $data['summary_skp']['nilai_capaian_skp']           = "";
        $data['summary_skp']['total_aspek']                 = 0;            
        $data['list_skp'] = $this->m_api->get_data_skp_pegawai($users[0]->id,$users[0]->posisi,$tahun,'1','realisasi');            
        if ($data['list_skp'] != 0) {
                # code...
            for ($i=0; $i < count($data['list_skp']); $i++) {
                # code...
                $data['list_skp'][$i]->aspek_kualitas      = $this->aspek_kualitas($data['list_skp'][$i]->realisasi_kualitasmutu,$data['list_skp'][$i]->target_kualitasmutu);
                $data['list_skp'][$i]->aspek_kuantitas     = $this->aspek_kuantitas($data['list_skp'][$i]->realisasi_kuantitas,$data['list_skp'][$i]->target_qty,$data['list_skp'][$i]->realisasi_kualitasmutu);				
                $data['list_skp'][$i]->aspek_waktu         = $this->aspek_waktu($data['list_skp'][$i]->target_waktu_bln,$data['list_skp'][$i]->target_waktu_bln,$data['list_skp'][$i]->realisasi_kuantitas);
                $data['list_skp'][$i]->aspek_biaya         = $this->aspek_biaya($data['list_skp'][$i]->target_biaya,$data['list_skp'][$i]->realisasi_biaya,$data['list_skp'][$i]->realisasi_kuantitas);
                $data['list_skp'][$i]->perhitungan         = $this->perhitungan_skp($data['list_skp'][$i]->aspek_kuantitas,$data['list_skp'][$i]->aspek_kualitas,$data['list_skp'][$i]->aspek_waktu['aspek_waktu'],$data['list_skp'][$i]->aspek_biaya);
                $data['summary_skp']['nilai_capaian_skp']  = $data['list_skp'][$i]->perhitungan['nilai_capaian_skp'];
                if($data['summary_skp']['nilai_capaian_skp'] != 0)
                {
                    $data['summary_skp']['total_aspek']       += ($data['summary_skp']['nilai_capaian_skp']);
                }
                else
                {
                    $data['summary_skp']['total_aspek']       = 0;					
                }
            }
        }
        else {
            # code...
            $data['summary_skp']['total_aspek'] = 0;		
        }

        $data['tugas_tambahan'] = $this->tugas_tambahan_kreatifitas($users[0]->id,$tahun,NULL);
        $nilai_prilaku = $skp_prilaku['result']['nilai_prilaku_kerja'];
        $data['summary_prilaku_skp']['nilai_prilaku_kerja'] = $nilai_prilaku;
        $data['kreativitas'] = $this->tugas_tambahan_kreatifitas($users[0]->id,$tahun,'kreativitas');            
        $list_skp_count                                         = ($data['list_skp'] == 0) ? 1 : count($data['list_skp']);
        $data['persentase_target_realisasi']                    = $this->m_api->get_persentase_target_realisasi($users[0]->id,$users[0]->posisi,$tahun);
        $data['summary_skp']['tugas_tambahan']                  = $this->nilai_tugas_tambahan($data['tugas_tambahan']);
        $data['summary_skp']['total']                           = $data['summary_skp']['total_aspek']/$list_skp_count + $data['tugas_tambahan'] + $data['kreativitas'];
        $data['summary_skp']['nilai_sasaran_kinerja_pegawai']   = ($data['summary_skp']['total']*60)/100;
        $data['summary_skp_dan_prilaku']                        = $data['summary_skp']['nilai_sasaran_kinerja_pegawai'] + $data['summary_prilaku_skp']['nilai_prilaku_kerja'];        

        return $data;
    }
    
    public function auth_post()
    {
        # code...
		$nip 		= htmlspecialchars($this->input->post('nip'), ENT_QUOTES| ENT_COMPAT, 'UTF-8');
		$pass 		= htmlspecialchars($this->input->post('password'), ENT_QUOTES| ENT_COMPAT, 'UTF-8');
		$cekUser	= $this->m_api->cekUser($nip,$pass);
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
            
            $res_data = array(
                                'status' => TRUE,
                                'data'   => $data
                            );
            $this->response($res_data, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code            
		}
		else
		{
			$res = array
			(
				'status' => false,
				'text'   => 'Verifikasi user gagal, nip atau password tidak sesuai'
			);
			echo json_encode($res);
		}        
    }    
}
