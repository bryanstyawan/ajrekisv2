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
                                'persentase_menit_kerja' => $transact[0]->prosentase_menit_efektif
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
}
