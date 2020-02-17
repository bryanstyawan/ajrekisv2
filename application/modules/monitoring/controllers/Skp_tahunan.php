<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/PHPExcel.php";
class Skp_tahunan extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmonitoring', '', TRUE);
		date_default_timezone_set('Asia/Jakarta');
	}

	private $year_system = 2020;	

	public function data()
	{
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$data['title']      = 'Rekapitulasi SKP Tahunan';
		$data['content']    = 'monitoring/skp_tahunan/index';
		$data['list']       = '';
		$data['es1']        = $this->Allcrud->listData('mr_eselon1');
		$data['es2']        = $this->Allcrud->getData('mr_eselon2',array('id_es1'=>$this->session->userdata('sesEs1')));
		$data['role']       = $this->Allcrud->listData('user_role');
		$this->load->view('templateAdmin',$data);
	}	

	public function filter_skp_tahunan()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$data_parameter = array
						(
							'eselon1'    => $data_sender['data_1'],
							'eselon2'    => $data_sender['data_2'],
							'eselon3'    => $data_sender['data_3'],
							'eselon4'    => $data_sender['data_4'],
							'tahun'		 => $data_sender['data_5'] 
						);
		$data['tahun'] = $data_sender['data_5'];						
		$data['list'] = $this->Mmonitoring->rekap_skp_tahunan($data_parameter,'a.es2 ASC,
																		a.es3 ASC,
																		a.es4 ASC,
																		b.kat_posisi asc,
																		b.atasan ASC');
		$this->load->view('monitoring/skp_tahunan/ajax_skp_tahunan',$data);
	}	

	public function get_value($id_pegawai)
	{
		# code...
		$this->Globalrules->trigger_skp_tahunan($id_pegawai);		
	}

	public function get_delete($id_pegawai)
	{
		# code...
		$this->Allcrud->delData('rpt_skp_prilaku_skp',array('id_pegawai'=>$id_pegawai));
		$this->Allcrud->delData('rpt_skp_sasaran_kerja',array('id_pegawai'=>$id_pegawai));		
	}

	public function data_grafik()
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$data['title']      = 'Grafik SKP Tahunan';
		$data['content']    = 'monitoring/skp_tahunan/grafik';
		$data['list']       = '';
		$data['es1']        = $this->Allcrud->listData('mr_eselon1');
		$data['es2']        = $this->Allcrud->getData('mr_eselon2',array('id_es1'=>$this->session->userdata('sesEs1')));
		$data['role']       = $this->Allcrud->listData('user_role');
		$this->load->view('templateAdmin',$data);		
	}

	public function filter_skp_tahunan_grafik()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$data_parameter = array
						(
							'eselon1'    => $data_sender['data_1'],
							'eselon2'    => $data_sender['data_2'],
							'eselon3'    => $data_sender['data_3'],
							'eselon4'    => $data_sender['data_4'],
							'tahun'		 => $data_sender['data_5'] 
						);
		$data['tahun'] = $data_sender['data_5'];						
		$data['list'] = '';
		$data_temp = $this->Mmonitoring->rekap_skp_tahunan($data_parameter,'b.eselon2 ASC,
																		b.eselon3 ASC,
																		b.eselon4 ASC,
																		b.kat_posisi asc,
																		b.atasan ASC');

		if ($data_sender['data_6']  == 'all') {
			# code...
			$data['list']        = $this->Allcrud->listData('mr_eselon1')->result_array();
			if ($data['list'] != array()) {
				# code...
				for ($i=0; $i < count($data['list']); $i++) { 
					# code...
					$nilai_sangat_baik = 0;
					$nilai_baik        = 0;
					$nilai_cukup       = 0;
					$nilai_kurang      = 0;
					$nilai_buruk       = 0;					
					$total_pegawai     = 0;
					for ($j=0; $j < count($data_temp); $j++) { 
						# code...
						if ($data['list'][$i]['id_es1'] == $data_temp[$j]->eselon1) {
							# code...
							$total_pegawai += 1;							
							if ($this->Globalrules->nilai_capaian_skp($data_temp[$j]->total_skp)['value'] == 'Sangat Baik') {
								# code...
								$nilai_sangat_baik += 1;
							}

							if ($this->Globalrules->nilai_capaian_skp($data_temp[$j]->total_skp)['value'] == 'Baik') {
								# code...
								$nilai_baik += 1;
							}
				
							if ($this->Globalrules->nilai_capaian_skp($data_temp[$j]->total_skp)['value'] == 'Cukup') {
								# code...
								$nilai_cukup += 1;
							}
							
							if ($this->Globalrules->nilai_capaian_skp($data_temp[$j]->total_skp)['value'] == 'Kurang') {
								# code...
								$nilai_kurang += 1;
							}
							
							if ($this->Globalrules->nilai_capaian_skp($data_temp[$j]->total_skp)['value'] == 'Buruk') {
								# code...
								$nilai_buruk += 1;
							}							
						}
					}
					$data['list'][$i]['sangat_baik']           = $nilai_sangat_baik;
					$data['list'][$i]['baik']                  = $nilai_baik;
					$data['list'][$i]['cukup']                 = $nilai_cukup;
					$data['list'][$i]['kurang']                = $nilai_kurang;
					$data['list'][$i]['buruk']                 = $nilai_buruk;
					$data['list'][$i]['total']                 = $total_pegawai;
					$data['list'][$i]['Tidak Diketahui']       = $total_pegawai - ($nilai_sangat_baik + $nilai_baik + $nilai_cukup + $nilai_kurang + $nilai_buruk);																														
				}
			}			
		}
		echo json_encode($data['list']);
		// $this->load->view('monitoring/skp_tahunan/ajax_skp_tahunan',$data);		
	}
}
  