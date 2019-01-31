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
		$this->load->model ('m_api', '', TRUE);        
    }

    public function summary_get()
    {
        $nip   = $this->get('nip');
        $users = $this->m_api->get_transact($nip,1,date('m'),date('Y'));
        if ($users != 0)
        {
            // Set the response and exit
            $data = array
                        (
                            'tanggal'                => $users[0]->tanggal_mulai,
                            'tunjangan'              => $users[0]->real_tunjangan_kinerja,
                            'nip'                    => $users[0]->nip,
                            'nama'                   => $users[0]->nama_pegawai,
                            'menit_kerja'            => $users[0]->menit_efektif,
                            'persentase_menit_kerja' => round($users[0]->real_prosentase)
                        );
            $this->response($data, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No users were found'
            ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
}
