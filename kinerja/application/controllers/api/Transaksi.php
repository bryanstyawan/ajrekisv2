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
class Transaksi extends \Restserver\Libraries\REST_Controller {

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
        $this->load->model('mskp', '', TRUE);
        $this->load->model('mtrx', '', TRUE);
        $this->load->model('Globalrules', '', TRUE);
        $this->load->model('Allcrud', '', TRUE);                                      
        $this->load->database();          
    }

    public function home_post()
    {
        $nip   = $this->input->post('nip');
        $nip   = htmlspecialchars($nip, ENT_QUOTES| ENT_COMPAT, 'UTF-8');
        $users = $this->m_api->get_pegawai($nip);
        if ($users != 0)
        {          
            $res_pegawai = array
            (
                'nip'                    => $users[0]->nip,
                'nama'                   => $users[0]->nama_pegawai,
            );

            $data['uraian_tugas']         = array();
            $urtug         = $this->mskp->get_data_skp_pegawai($users[0]->id,$users[0]->posisi,date('Y'),'approve',1);
            if ($urtug != 0) {
                # code...
                for ($i=0; $i < count($urtug); $i++) 
                {
                    $data['uraian_tugas'][$i] = new stdClass;
                    $data['uraian_tugas'][$i]->id_uraian_tugas = $urtug[$i]->skp_id;                                        

                    if ($users[0]->kat_posisi == 1) {
                        # code...
                        $data['uraian_tugas'][$i]->kegiatan_skp = $urtug[$i]->kegiatan_skp;                        
                    }
                    elseif ($users[0]->kat_posisi == 2) {
                        # code...
                        $data['uraian_tugas'][$i]->kegiatan_skp = $urtug[$i]->kegiatan_skp_jft;                        
                    }                    
                    elseif ($users[0]->kat_posisi == 4) {
                        # code...
                        $data['uraian_tugas'][$i]->kegiatan_skp = $urtug[$i]->kegiatan_skp_jfu;                        
                    }                    
                    elseif ($users[0]->kat_posisi == 6) {
                        # code...
                        $data['uraian_tugas'][$i]->kegiatan_skp = $urtug[$i]->kegiatan_skp;                        
                    }                    

                    // if ($urtug[$i]->id_skp_master == '') {
                    //     # code...
                    //     $data['uraian_tugas'][$i]->id_skp_master = 0;                                                                        
                    // }
    
                    // if ($urtug[$i]->id_skp_jft == '') {
                    //     # code...
                    //     $data['uraian_tugas'][$i]->id_skp_jft = 0;                                                                        
                    // }                         
                    
                    // if ($urtug[$i]->id_skp_jfu == '') {
                    //     # code...
                    //     $data['uraian_tugas'][$i]->id_skp_jfu = 0;                                                                        
                    // }                                 				
                }			
            }     
         
            $data['belum_diperiksa']   = array();
            $belum_diperiksa   = $this->mtrx->status_pekerjaan('0',$users[0]->id);
            if ($belum_diperiksa != 0) {
                # code...
                for ($i=0; $i < count($belum_diperiksa); $i++) 
                {
                    $data['belum_diperiksa'][$i] = new stdClass;
                    $data['belum_diperiksa'][$i]->id_pekerjaan = $belum_diperiksa[$i]->id_pekerjaan;
                    $data['belum_diperiksa'][$i]->tanggal_mulai = $belum_diperiksa[$i]->tanggal_mulai;
                    $data['belum_diperiksa'][$i]->tanggal_selesai = $belum_diperiksa[$i]->tanggal_selesai;
                    $data['belum_diperiksa'][$i]->jam_mulai = $belum_diperiksa[$i]->jam_mulai;
                    $data['belum_diperiksa'][$i]->jam_selesai = $belum_diperiksa[$i]->jam_selesai;
                    $data['belum_diperiksa'][$i]->menit_efektif = $belum_diperiksa[$i]->menit_efektif;
                    $data['belum_diperiksa'][$i]->tunjangan = $belum_diperiksa[$i]->tunjangan;                    
                    $data['belum_diperiksa'][$i]->frekuensi_realisasi = $belum_diperiksa[$i]->frekuensi_realisasi;                    

                    if ($users[0]->kat_posisi == 1) {
                        # code...
                        $data['belum_diperiksa'][$i]->kegiatan_skp = $belum_diperiksa[$i]->kegiatan_skp;                        
                    }
                    elseif ($users[0]->kat_posisi == 2) {
                        # code...
                        $data['belum_diperiksa'][$i]->kegiatan_skp = $belum_diperiksa[$i]->kegiatan_skp_jft;                        
                    }                    
                    elseif ($users[0]->kat_posisi == 4) {
                        # code...
                        $data['belum_diperiksa'][$i]->kegiatan_skp = $belum_diperiksa[$i]->kegiatan_skp_jfu;                        
                    }                    
                    elseif ($users[0]->kat_posisi == 6) {
                        # code...
                        $data['belum_diperiksa'][$i]->kegiatan_skp = $belum_diperiksa[$i]->kegiatan_skp;                        
                    }                                                     				
                }			
            }

            $data['disetujui']   = array();            
            $disetujui         = $this->mtrx->status_pekerjaan('1',$users[0]->id);
            if ($disetujui != 0) {
                # code...
                for ($i=0; $i < count($disetujui); $i++) 
                {
                    $data['disetujui'][$i] = new stdClass;
                    $data['disetujui'][$i]->id_pekerjaan = $disetujui[$i]->id_pekerjaan;
                    $data['disetujui'][$i]->tanggal_mulai = $disetujui[$i]->tanggal_mulai;
                    $data['disetujui'][$i]->tanggal_selesai = $disetujui[$i]->tanggal_selesai;
                    $data['disetujui'][$i]->jam_mulai = $disetujui[$i]->jam_mulai;
                    $data['disetujui'][$i]->jam_selesai = $disetujui[$i]->jam_selesai;
                    $data['disetujui'][$i]->menit_efektif = $disetujui[$i]->menit_efektif;
                    $data['disetujui'][$i]->tunjangan = $disetujui[$i]->tunjangan;                    
                    $data['disetujui'][$i]->frekuensi_realisasi = $disetujui[$i]->frekuensi_realisasi;                    

                    if ($users[0]->kat_posisi == 1) {
                        # code...
                        $data['disetujui'][$i]->kegiatan_skp = $disetujui[$i]->kegiatan_skp;                        
                    }
                    elseif ($users[0]->kat_posisi == 2) {
                        # code...
                        $data['disetujui'][$i]->kegiatan_skp = $disetujui[$i]->kegiatan_skp_jft;                        
                    }                    
                    elseif ($users[0]->kat_posisi == 4) {
                        # code...
                        $data['disetujui'][$i]->kegiatan_skp = $disetujui[$i]->kegiatan_skp_jfu;                        
                    }                    
                    elseif ($users[0]->kat_posisi == 6) {
                        # code...
                        $data['disetujui'][$i]->kegiatan_skp = $disetujui[$i]->kegiatan_skp;                        
                    }                                                     				
                }			
            }


            $data['tolak'] = array();
            $tolak             = $this->mtrx->status_pekerjaan('2',$users[0]->id);
            if ($tolak != 0) {
                # code...
                for ($i=0; $i < count($tolak); $i++) 
                {
                    $data['tolak'][$i] = new stdClass;
                    $data['tolak'][$i]->id_pekerjaan = $tolak[$i]->id_pekerjaan;
                    $data['tolak'][$i]->tanggal_mulai = $tolak[$i]->tanggal_mulai;
                    $data['tolak'][$i]->tanggal_selesai = $tolak[$i]->tanggal_selesai;
                    $data['tolak'][$i]->jam_mulai = $tolak[$i]->jam_mulai;
                    $data['tolak'][$i]->jam_selesai = $tolak[$i]->jam_selesai;
                    $data['tolak'][$i]->menit_efektif = $tolak[$i]->menit_efektif;
                    $data['tolak'][$i]->tunjangan = $tolak[$i]->tunjangan;                    
                    $data['tolak'][$i]->frekuensi_realisasi = $tolak[$i]->frekuensi_realisasi;                    

                    if ($users[0]->kat_posisi == 1) {
                        # code...
                        $data['tolak'][$i]->kegiatan_skp = $tolak[$i]->kegiatan_skp;                        
                    }
                    elseif ($users[0]->kat_posisi == 2) {
                        # code...
                        $data['tolak'][$i]->kegiatan_skp = $tolak[$i]->kegiatan_skp_jft;                        
                    }                    
                    elseif ($users[0]->kat_posisi == 4) {
                        # code...
                        $data['tolak'][$i]->kegiatan_skp = $tolak[$i]->kegiatan_skp_jfu;                        
                    }                    
                    elseif ($users[0]->kat_posisi == 6) {
                        # code...
                        $data['tolak'][$i]->kegiatan_skp = $tolak[$i]->kegiatan_skp;                        
                    }                                                     				
                }			
            }

            $data['revisi'] = array();
            $revisi             = $this->mtrx->status_pekerjaan('3',$users[0]->id);
            if ($revisi != 0) {
                # code...
                for ($i=0; $i < count($revisi); $i++) 
                {
                    $data['revisi'][$i] = new stdClass;
                    $data['revisi'][$i]->id_pekerjaan = $revisi[$i]->id_pekerjaan;
                    $data['revisi'][$i]->tanggal_mulai = $revisi[$i]->tanggal_mulai;
                    $data['revisi'][$i]->tanggal_selesai = $revisi[$i]->tanggal_selesai;
                    $data['revisi'][$i]->jam_mulai = $revisi[$i]->jam_mulai;
                    $data['revisi'][$i]->jam_selesai = $revisi[$i]->jam_selesai;
                    $data['revisi'][$i]->menit_efektif = $revisi[$i]->menit_efektif;
                    $data['revisi'][$i]->tunjangan = $revisi[$i]->tunjangan;                    
                    $data['revisi'][$i]->frekuensi_realisasi = $revisi[$i]->frekuensi_realisasi;                    

                    if ($users[0]->kat_posisi == 1) {
                        # code...
                        $data['revisi'][$i]->kegiatan_skp = $revisi[$i]->kegiatan_skp;                        
                    }
                    elseif ($users[0]->kat_posisi == 2) {
                        # code...
                        $data['revisi'][$i]->kegiatan_skp = $revisi[$i]->kegiatan_skp_jft;                        
                    }                    
                    elseif ($users[0]->kat_posisi == 4) {
                        # code...
                        $data['revisi'][$i]->kegiatan_skp = $revisi[$i]->kegiatan_skp_jfu;                        
                    }                    
                    elseif ($users[0]->kat_posisi == 6) {
                        # code...
                        $data['revisi'][$i]->kegiatan_skp = $revisi[$i]->kegiatan_skp;                        
                    }                                                     				
                }			
            }

            $data['keberatan'] = array();
            $keberatan             = $this->mtrx->status_pekerjaan('4',$users[0]->id);
            if ($keberatan != 0) {
                # code...
                for ($i=0; $i < count($keberatan); $i++) 
                {
                    $data['keberatan'][$i] = new stdClass;
                    $data['keberatan'][$i]->id_pekerjaan = $keberatan[$i]->id_pekerjaan;
                    $data['keberatan'][$i]->tanggal_mulai = $keberatan[$i]->tanggal_mulai;
                    $data['keberatan'][$i]->tanggal_selesai = $keberatan[$i]->tanggal_selesai;
                    $data['keberatan'][$i]->jam_mulai = $keberatan[$i]->jam_mulai;
                    $data['keberatan'][$i]->jam_selesai = $keberatan[$i]->jam_selesai;
                    $data['keberatan'][$i]->menit_efektif = $keberatan[$i]->menit_efektif;
                    $data['keberatan'][$i]->tunjangan = $keberatan[$i]->tunjangan;                    
                    $data['keberatan'][$i]->frekuensi_realisasi = $keberatan[$i]->frekuensi_realisasi;                    

                    if ($users[0]->kat_posisi == 1) {
                        # code...
                        $data['keberatan'][$i]->kegiatan_skp = $keberatan[$i]->kegiatan_skp;                        
                    }
                    elseif ($users[0]->kat_posisi == 2) {
                        # code...
                        $data['keberatan'][$i]->kegiatan_skp = $keberatan[$i]->kegiatan_skp_jft;                        
                    }                    
                    elseif ($users[0]->kat_posisi == 4) {
                        # code...
                        $data['keberatan'][$i]->kegiatan_skp = $keberatan[$i]->kegiatan_skp_jfu;                        
                    }                    
                    elseif ($users[0]->kat_posisi == 6) {
                        # code...
                        $data['keberatan'][$i]->kegiatan_skp = $keberatan[$i]->kegiatan_skp;                        
                    }                                                     				
                }			
            }

            $data['keberatan_ditolak'] = array();
            $keberatan_ditolak             = $this->mtrx->status_pekerjaan('5',$users[0]->id);
            if ($keberatan_ditolak != 0) {
                # code...
                for ($i=0; $i < count($keberatan_ditolak); $i++) 
                {
                    $data['keberatan_ditolak'][$i] = new stdClass;
                    $data['keberatan_ditolak'][$i]->id_pekerjaan = $keberatan_ditolak[$i]->id_pekerjaan;
                    $data['keberatan_ditolak'][$i]->tanggal_mulai = $keberatan_ditolak[$i]->tanggal_mulai;
                    $data['keberatan_ditolak'][$i]->tanggal_selesai = $keberatan_ditolak[$i]->tanggal_selesai;
                    $data['keberatan_ditolak'][$i]->jam_mulai = $keberatan_ditolak[$i]->jam_mulai;
                    $data['keberatan_ditolak'][$i]->jam_selesai = $keberatan_ditolak[$i]->jam_selesai;
                    $data['keberatan_ditolak'][$i]->menit_efektif = $keberatan_ditolak[$i]->menit_efektif;
                    $data['keberatan_ditolak'][$i]->tunjangan = $keberatan_ditolak[$i]->tunjangan;                    
                    $data['keberatan_ditolak'][$i]->frekuensi_realisasi = $keberatan_ditolak[$i]->frekuensi_realisasi;                    

                    if ($users[0]->kat_posisi == 1) {
                        # code...
                        $data['keberatan_ditolak'][$i]->kegiatan_skp = $keberatan_ditolak[$i]->kegiatan_skp;                        
                    }
                    elseif ($users[0]->kat_posisi == 2) {
                        # code...
                        $data['keberatan_ditolak'][$i]->kegiatan_skp = $keberatan_ditolak[$i]->kegiatan_skp_jft;                        
                    }                    
                    elseif ($users[0]->kat_posisi == 4) {
                        # code...
                        $data['keberatan_ditolak'][$i]->kegiatan_skp = $keberatan_ditolak[$i]->kegiatan_skp_jfu;                        
                    }                    
                    elseif ($users[0]->kat_posisi == 6) {
                        # code...
                        $data['keberatan_ditolak'][$i]->kegiatan_skp = $keberatan_ditolak[$i]->kegiatan_skp;                        
                    }                                                     				
                }			
            }

            $data['banding'] = array();
            $banding             = $this->mtrx->status_pekerjaan('6',$users[0]->id);
            if ($banding != 0) {
                # code...
                for ($i=0; $i < count($banding); $i++) 
                {
                    $data['banding'][$i] = new stdClass;
                    $data['banding'][$i]->id_pekerjaan = $banding[$i]->id_pekerjaan;
                    $data['banding'][$i]->tanggal_mulai = $banding[$i]->tanggal_mulai;
                    $data['banding'][$i]->tanggal_selesai = $banding[$i]->tanggal_selesai;
                    $data['banding'][$i]->jam_mulai = $banding[$i]->jam_mulai;
                    $data['banding'][$i]->jam_selesai = $banding[$i]->jam_selesai;
                    $data['banding'][$i]->menit_efektif = $banding[$i]->menit_efektif;
                    $data['banding'][$i]->tunjangan = $banding[$i]->tunjangan;                    
                    $data['banding'][$i]->frekuensi_realisasi = $banding[$i]->frekuensi_realisasi;                    

                    if ($users[0]->kat_posisi == 1) {
                        # code...
                        $data['banding'][$i]->kegiatan_skp = $banding[$i]->kegiatan_skp;                        
                    }
                    elseif ($users[0]->kat_posisi == 2) {
                        # code...
                        $data['banding'][$i]->kegiatan_skp = $banding[$i]->kegiatan_skp_jft;                        
                    }                    
                    elseif ($users[0]->kat_posisi == 4) {
                        # code...
                        $data['banding'][$i]->kegiatan_skp = $banding[$i]->kegiatan_skp_jfu;                        
                    }                    
                    elseif ($users[0]->kat_posisi == 6) {
                        # code...
                        $data['banding'][$i]->kegiatan_skp = $banding[$i]->kegiatan_skp;                        
                    }                                                     				
                }			
            }

            $data['banding_ditolak'] = array();
            $banding_ditolak             = $this->mtrx->status_pekerjaan('7',$users[0]->id);
            if ($banding_ditolak != 0) {
                # code...
                for ($i=0; $i < count($banding_ditolak); $i++) 
                {
                    $data['banding_ditolak'][$i] = new stdClass;
                    $data['banding_ditolak'][$i]->id_pekerjaan = $banding_ditolak[$i]->id_pekerjaan;
                    $data['banding_ditolak'][$i]->tanggal_mulai = $banding_ditolak[$i]->tanggal_mulai;
                    $data['banding_ditolak'][$i]->tanggal_selesai = $banding_ditolak[$i]->tanggal_selesai;
                    $data['banding_ditolak'][$i]->jam_mulai = $banding_ditolak[$i]->jam_mulai;
                    $data['banding_ditolak'][$i]->jam_selesai = $banding_ditolak[$i]->jam_selesai;
                    $data['banding_ditolak'][$i]->menit_efektif = $banding_ditolak[$i]->menit_efektif;
                    $data['banding_ditolak'][$i]->tunjangan = $banding_ditolak[$i]->tunjangan;                    
                    $data['banding_ditolak'][$i]->frekuensi_realisasi = $banding_ditolak[$i]->frekuensi_realisasi;                    

                    if ($users[0]->kat_posisi == 1) {
                        # code...
                        $data['banding_ditolak'][$i]->kegiatan_skp = $banding_ditolak[$i]->kegiatan_skp;                        
                    }
                    elseif ($users[0]->kat_posisi == 2) {
                        # code...
                        $data['banding_ditolak'][$i]->kegiatan_skp = $banding_ditolak[$i]->kegiatan_skp_jft;                        
                    }                    
                    elseif ($users[0]->kat_posisi == 4) {
                        # code...
                        $data['banding_ditolak'][$i]->kegiatan_skp = $banding_ditolak[$i]->kegiatan_skp_jfu;                        
                    }                    
                    elseif ($users[0]->kat_posisi == 6) {
                        # code...
                        $data['banding_ditolak'][$i]->kegiatan_skp = $banding_ditolak[$i]->kegiatan_skp;                        
                    }                                                     				
                }			
            }
            
            // $data['hari_kerja']           = $this->mtrx->get_hari_kerja(date('m'),date('Y'));
            // $data['infoPegawai']          = $this->Globalrules->get_info_pegawai($users[0]->id,'id',$users[0]->posisi);
            // $data['member']               = $this->Globalrules->list_bawahan($users[0]->posisi);            
            // if ($data['member'] != 0) {
            //     // code...
            //     for ($i=0; $i < count($data['member']); $i++) {
            //         // code...
            //         $get_data           = $this->Allcrud->getData('tr_capaian_pekerjaan',array('status_pekerjaan'=>0,'id_pegawai'=>$data['member'][$i]->id,'tanggal_mulai LIKE'=>date('Y-m').'%'))->num_rows();
            //         $get_data_keberatan = $this->Allcrud->getData('tr_capaian_pekerjaan',array('status_pekerjaan'=>4,'id_pegawai'=>$data['member'][$i]->id,'tanggal_mulai LIKE'=>date('Y-m').'%'))->num_rows();
            //         if ($get_data) {
            //             // code...
            //             $data['member'][$i]->counter_belum_diperiksa = $get_data;
            //         }
            //         else {
            //             // code...
            //             $data['member'][$i]->counter_belum_diperiksa = 0;
            //         }
    
            //         if ($get_data_keberatan) {
            //             // code...
            //             $data['member'][$i]->counter_keberatan = $get_data_keberatan;
            //         }
            //         else {
            //             // code...
            //             $data['member'][$i]->counter_keberatan = 0;
            //         }				
            //     }
            // }            


            $res_data = array(
                                'status' => TRUE,
                                'data'   => $data
                            );
            $this->response($res_data, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
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

    public function add_post()
    {
        $nip             = $this->input->post('nip');
        $uraian_tugas    = $this->input->post('uraian_tugas');        
        $tanggal_mulai   = $this->input->post('tanggal_mulai');        
        $jam_mulai       = $this->input->post('jam_mulai');
        $tanggal_selesai = $this->input->post('tanggal_selesai');        
        $jam_selesai     = $this->input->post('jam_selesai');
        $keterangan      = $this->input->post('keterangan');
        $kuantitas       = $this->input->post('kuantitas');                        
        $nip             = htmlspecialchars($nip, ENT_QUOTES| ENT_COMPAT, 'UTF-8');
        $uraian_tugas    = htmlspecialchars($uraian_tugas, ENT_QUOTES| ENT_COMPAT, 'UTF-8'); 
        $tanggal_mulai   = htmlspecialchars($tanggal_mulai, ENT_QUOTES| ENT_COMPAT, 'UTF-8');               
        $tanggal_selesai = htmlspecialchars($tanggal_selesai, ENT_QUOTES| ENT_COMPAT, 'UTF-8');
        $jam_mulai       = htmlspecialchars($jam_mulai, ENT_QUOTES| ENT_COMPAT, 'UTF-8');
        $jam_selesai     = htmlspecialchars($jam_selesai, ENT_QUOTES| ENT_COMPAT, 'UTF-8');
        $keterangan      = htmlspecialchars($keterangan, ENT_QUOTES| ENT_COMPAT, 'UTF-8');
        $kuantitas       = htmlspecialchars($kuantitas, ENT_QUOTES| ENT_COMPAT, 'UTF-8');                

        $users = $this->m_api->get_pegawai($nip);
        if ($users != 0)
        {          
            
            $res_data        = "";
            $res_data_id     = $this->Allcrud->insert_transaksi
                            (
                                $users[0]->id,
                                $users[0]->posisi,
                                $uraian_tugas,
                                date('Y-m-d', strtotime($tanggal_mulai)),
                                date('Y-m-d', strtotime($tanggal_selesai)),
                                $jam_mulai,
                                $jam_selesai,
                                $keterangan,
                                $kuantitas,
                                '' //file_pendukung
                            );
    
            if ($res_data_id != 0) {
                # code...
                $res_data = 1;
            }
            else {
                # code...
                $res_data = 0;
            }
    
            // $this->notify_capaian_kerja(' telah mengajukan laporan pekerjaan','transaksi/home/',$res_data_id,'approval');
            $text_status = $this->Globalrules->check_status_res($res_data,'Pekerjaan Telah ditambah');            
            
            $res_data = array(
                                'status' => $res_data,
                                'text'   => $text_status
                            );
            $this->response($res_data, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
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

    // public function keberatan_post()
    // {
    //     $nip = $this->input->post('nip');
    //     $komentar = $this->input->post('komentar');        
    //     $id_pekerjaan = $this->input->post('id_pekerjaan');        
    //     $nip = htmlspecialchars($nip, ENT_QUOTES| ENT_COMPAT, 'UTF-8');
    //     $komentar = htmlspecialchars($komentar, ENT_QUOTES| ENT_COMPAT, 'UTF-8'); 
    //     $id_pekerjaan = htmlspecialchars($id_pekerjaan, ENT_QUOTES| ENT_COMPAT, 'UTF-8');               

    //     $users = $this->m_api->get_pegawai($nip);
    //     if ($users != 0)
    //     {
    //         $data        = array
    //                         (
    //                             'status_pekerjaan'     => '4',
    //                             'komentar_keberatan'   => $komentar,
    //                             'tanggal_keberatan'    => date('Y-m-d H:i:s'),
    //                             'audit_update'         => date('Y-m-d H:i:s'),
    //                             'audit_user_update'    => $this->session->userdata('sesUser')
    //                         );
    //         $flag        = array('id_pekerjaan'=>$id_pekerjaan);
    //         $res_data    = $this->Allcrud->editData('tr_capaian_pekerjaan',$data,$flag);

    //         $text_status = $this->Globalrules->check_status_res($res_data,'Status pekerjaan telah diubah');
            
    //         $res_data = array(
    //                             'status' => $res_data,
    //                             'text'   => $text_status
    //                         );
    //         $this->response($res_data, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    //     }
    //     else
    //     {
    //         // Set the response and exit
    //         $this->response([
    //             'status' => FALSE,
    //             'data'   => ''
    //         ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
    //     }
    // }
    
    // public function tolak_keberatan_post()
    // {
    //     $nip = $this->input->post('nip');
    //     $komentar = $this->input->post('komentar');        
    //     $id_pekerjaan = $this->input->post('id_pekerjaan');        
    //     $nip = htmlspecialchars($nip, ENT_QUOTES| ENT_COMPAT, 'UTF-8');
    //     $komentar = htmlspecialchars($komentar, ENT_QUOTES| ENT_COMPAT, 'UTF-8'); 
    //     $id_pekerjaan = htmlspecialchars($id_pekerjaan, ENT_QUOTES| ENT_COMPAT, 'UTF-8');               

    //     $users = $this->m_api->get_pegawai($nip);
    //     if ($users != 0)
    //     {
    //         $data        = array
    //                         (
    //                             'status_pekerjaan'     => '5',
    //                             'komentar_tolak_keberatan'   => $komentar,
    //                             'tanggal_tolak_keberatan'    => date('Y-m-d H:i:s'),
    //                             'tanggal_keberatan'    => date('Y-m-d H:i:s'),
    //                             'audit_update'         => date('Y-m-d H:i:s'),
    //                             'audit_user_update'    => $this->session->userdata('sesUser')
    //                         );
    //         $flag        = array('id_pekerjaan'=>$id_pekerjaan);
    //         $res_data    = $this->Allcrud->editData('tr_capaian_pekerjaan',$data,$flag);

    //         $text_status = $this->Globalrules->check_status_res($res_data,'Status pekerjaan telah diubah');
            
    //         $res_data = array(
    //                             'status' => $res_data,
    //                             'text'   => $text_status
    //                         );
    //         $this->response($res_data, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    //     }
    //     else
    //     {
    //         // Set the response and exit
    //         $this->response([
    //             'status' => FALSE,
    //             'data'   => ''
    //         ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
    //     }
    // }    

   
}
