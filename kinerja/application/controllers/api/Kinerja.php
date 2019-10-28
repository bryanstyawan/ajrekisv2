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

            $skp_prilaku = $this->spk_prilaku($users,$tahun);
            $data_skp    = $this->result_skp($users,$tahun);

            $data_wrap = array(
                'kinerja' => array(
                    'pekerjaan_belum_diperiksa'          => ($res_data != array()) ? $res_data[0]->tr_belum_diperiksa : 0,
                    'pekerjaan_disetujui'                => ($res_data != array()) ? $res_data[0]->tr_approve : 0,
                    'tunjangan'                          => ($res_data != array()) ? $res_data[0]->real_tunjangan : 0,
                    'menit_efektif'                      => ($res_data != array()) ? $res_data[0]->menit_efektif : 0,
                    'persentase_realisasi_menit_efektif' => ($res_data != array()) ? $res_data[0]->prosentase_menit_efektif : 0,                    
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
				$value_atasan = ($value_atasan*80)/100;
				$value_peer   = ($value_peer*20)/100;
			}
			else
			{
				$value_atasan  = $value_atasan*70/100;
				$value_peer    = $value_peer*20/100;
				$value_bawahan = $value_bawahan*10/100;
			}
			$data = $value_atasan + $value_peer + $value_bawahan;
		}

    	return $data;
    }    
    
    public function spk_prilaku($users,$tahun)
    {
        # code...
        $jabatan = $this->m_api->get_posisi($users[0]->posisi);            
        $atasan = ($jabatan != array()) ? $jabatan[0]->atasan : '' ;
        $data['evaluator']               = $this->m_api->get_data_evaluator($users[0]->id,$tahun);            
        $data['nilai_prilaku_atasan']    = $this->m_api->get_nilai_prilaku($users[0]->id,$users[0]->posisi,'atasan',$tahun,$users[0]->id);
        $data['nilai_prilaku_peer']      = $this->m_api->get_nilai_prilaku($users[0]->id,$atasan,'peer',$tahun,$users[0]->id);
        $data['nilai_prilaku_bawahan']   = $this->m_api->get_nilai_prilaku($users[0]->id,$users[0]->posisi,'bawahan',$tahun,$users[0]->id);            

        $data['summary_prilaku_skp']['integritas']          = $this->get_penilaian_prilaku($data['nilai_prilaku_atasan'][0]->integritas,$data['nilai_prilaku_peer'][0]->integritas,$data['nilai_prilaku_bawahan'][0]->integritas);
        $data['summary_prilaku_skp']['orientasi_pelayanan'] = $this->get_penilaian_prilaku($data['nilai_prilaku_atasan'][0]->orientasi_pelayanan,$data['nilai_prilaku_peer'][0]->orientasi_pelayanan,$data['nilai_prilaku_bawahan'][0]->orientasi_pelayanan);
        $data['summary_prilaku_skp']['komitmen']            = $this->get_penilaian_prilaku($data['nilai_prilaku_atasan'][0]->komitmen,$data['nilai_prilaku_peer'][0]->komitmen,$data['nilai_prilaku_bawahan'][0]->komitmen);
        $data['summary_prilaku_skp']['disiplin']            = $this->get_penilaian_prilaku($data['nilai_prilaku_atasan'][0]->disiplin,$data['nilai_prilaku_peer'][0]->disiplin,$data['nilai_prilaku_bawahan'][0]->disiplin);
        $data['summary_prilaku_skp']['kerjasama']           = $this->get_penilaian_prilaku($data['nilai_prilaku_atasan'][0]->kerjasama,$data['nilai_prilaku_peer'][0]->kerjasama,$data['nilai_prilaku_bawahan'][0]->kerjasama);
        $data['summary_prilaku_skp']['kepemimpinan']        = $this->get_penilaian_prilaku($data['nilai_prilaku_atasan'][0]->kepemimpinan,$data['nilai_prilaku_peer'][0]->kepemimpinan,$data['nilai_prilaku_bawahan'][0]->kepemimpinan);
        $data['result']['status']              = $this->get_penilaian_prilaku($data['nilai_prilaku_atasan'][0]->status,$data['nilai_prilaku_peer'][0]->status,$data['nilai_prilaku_bawahan'][0]->status,'status',($data['evaluator'] == 0) ? 1 : count($data['evaluator']));
        $data['result']['jumlah']              = $data['summary_prilaku_skp']['orientasi_pelayanan'] + $data['summary_prilaku_skp']['integritas'] + $data['summary_prilaku_skp']['komitmen'] + $data['summary_prilaku_skp']['disiplin'] + $data['summary_prilaku_skp']['kerjasama'] + $data['summary_prilaku_skp']['kepemimpinan'];
        $data['result']['rata_rata']           = $data['result']['jumlah'] / 6;
        $data['result']['nilai_prilaku_kerja'] = ($data['result']['rata_rata']*40)/100;        

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
                        'res_pegawai'   => $users,
                        'res_data'      => $skp_prilaku 
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

	public function perhitungan_skp($aspek_kuantitas=NULL,$aspek_kualitas=NULL,$aspek_waktu=NULL,$aspek_biaya=NULL)
	{
		# code...
		if($aspek_kuantitas == NULL)$aspek_kuantitas = 0;
		if($aspek_kualitas == NULL)$aspek_kualitas   = 0;
		if($aspek_waktu == NULL)$aspek_waktu         = 0;
		if($aspek_biaya == NULL)$aspek_biaya         = 0;
		return array
		(
			'aspek'             => ($aspek_kuantitas + $aspek_kualitas + $aspek_waktu),
			'nilai_capaian_skp' => (($aspek_kuantitas + $aspek_kualitas + $aspek_waktu)/3)
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
        
    public function summary_spk_prestasi_post()
    {
        # code...
        # code...
        $nip   = $this->input->post('nip');
        $month = $this->input->post('bulan');
        $year  = $this->input->post('tahun');                
        $nip   = htmlspecialchars($nip, ENT_QUOTES| ENT_COMPAT, 'UTF-8');
        $tahun  = htmlspecialchars($year, ENT_QUOTES| ENT_COMPAT, 'UTF-8');        
        $users = $this->m_api->get_pegawai($nip);
        if ($users != 0)
        {

            $data_skp = $this->result_skp($users,$tahun);

            $data_wrap = array(
                'nilai_perilaku_kerja' => $data_skp['summary_skp']['nilai_sasaran_kinerja_pegawai']
            );

            $data = array
                    (
                        'res_pegawai'   => $users,
                        'res_data'      => $data_wrap,
                    );

            $res_data = array(
                                'status' => TRUE,
                                'data'   => $data
                            );
            $this->response($res_data, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code            
        }                
    }
}
