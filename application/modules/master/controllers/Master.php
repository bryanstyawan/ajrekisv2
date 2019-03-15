<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
		$this->load->model ('skp/mskp', '', TRUE);
	}

	public function index()
	{
		if(!$this->session->userdata('login')){
			redirect('admin/loginAdmin');
		}
		$this->load->view('templateAdmin');
	}

	// Edited : Bryan
	// Last Edited : 2019-02-21
	public function filter_data_eselon($param=NULL)
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$data_sender = array
						(
							'eselon1'    => $data_sender['data_1'],
							'eselon2'    => $data_sender['data_2'],
							'eselon3'    => $data_sender['data_3'],
							'eselon4'    => $data_sender['data_4'],
							'kat_posisi' => $data_sender['data_5']
						);
		$data['param'] = "";
		if ($param != NULL) {
			# code...
			$data['param'] = $param;
		}
		$data['list'] = $this->Mmaster->get_struktur_organisasi($data_sender,$data_sender['kat_posisi']);
		if ($data['list'] != 0) {
			# code...
			for ($i=0; $i < count($data['list']); $i++) {
				# code...
				if($data['list'][$i]->kat_posisi == 1)
				{
					$get_summary_urtug = $this->mskp->get_summary_master_skp($data['list'][$i]->id);
					if ($get_summary_urtug != 0) {
						# code...
						$data['list'][$i]->counter_skp = $get_summary_urtug;
					}
					else
					{
						$data['list'][$i]->counter_skp = 0;
					}
				}
				elseif ($data['list'][$i]->kat_posisi == 2) {
					# code...
					$get_data = $this->Allcrud->getData('mr_jabatan_fungsional_tertentu_uraian_tugas',array('id_jft' => $data['list'][$i]->id_jft));
					if($get_data->result_array() != array())
					{					
						$data['list'][$i]->counter_skp = count($get_data->result_array());
					}
					else {	
						# code...
						$data['list'][$i]->counter_skp = 0;
					}					
				}
				elseif ($data['list'][$i]->kat_posisi == 4) {
					# code...
					$get_data = $this->Allcrud->getData('mr_jabatan_fungsional_umum_uraian_tugas',array('id_jfu' => $data['list'][$i]->id_jfu));
					if($get_data->result_array() != array())
					{					
						$data['list'][$i]->counter_skp = count($get_data->result_array());
					}
					else {	
						# code...
						$data['list'][$i]->counter_skp = 0;
					}					
				}				
				elseif($data['list'][$i]->kat_posisi == 6)
				{
					$get_summary_urtug = $this->mskp->get_summary_master_skp($data['list'][$i]->id);
					if ($get_summary_urtug != 0) {
						# code...
						$data['list'][$i]->counter_skp = $get_summary_urtug;
					}
					else
					{
						$data['list'][$i]->counter_skp = 0;
					}
				}				
				else {
					# code...
					$data['list'][$i]->counter_skp = 0;					
				}
			}
		}			
		$this->load->view('master/struktur/ajax_Struktur',$data);
	}

	public function cariAtasan()
	{
		$this->Globalrules->session_rule();
		$data_var = "";
		$data_sql = "";
		if($this->input->post('kat') == 1 || $this->input->post('nkat') == 1)
		{
			$data_var = array(
							'eselon4'    => $this->input->post('es4'),
							'eselon3'    => $this->input->post('es3'),
							'eselon2'    => $this->input->post('es2'),
							'eselon1'    => $this->input->post('es1'),
							'kat_posisi' => $this->input->post('kat')
						);
			$data_sql = $this->Mmaster->cari_atasan_STRUKTURAL($data_var);

		}
		elseif($this->input->post('kat') == 4 || $this->input->post('nkat') == 4)
		{
			$data_var = array(
							'eselon4'    => $this->input->post('es4'),
							'kat_posisi' => $this->input->post('kat')
						);
			$data_sql = $this->Mmaster->cari_atasan_FUNGSIONAL($data_var);
		}
		elseif($this->input->post('kat') == 2 || $this->input->post('nkat') == 2)
		{
			$data_var = array(
							'eselon2'    => $this->input->post('es2'),
							'kat_posisi' => $this->input->post('kat')
						);
			$data_sql = $this->Mmaster->cari_atasan_FUNGSIONAL_TERTENTU($data_var);
		}
		$data['atasan'] = $data_sql;
		$this->load->view('master/struktur/ajaxAtasan',$data);
	}

	public function agama(){
		$this->Globalrules->session_rule();
		$data['title']   = 'Data Agama';
		$data['content'] = 'master/agama/data_agama';
		$data['list']    = $this->Allcrud->listData('mr_agama');
		$this->load->view('templateAdmin',$data);
	}

	public function ajaxAgama(){
		$this->Globalrules->session_rule();
		$data['list'] = $this->Allcrud->listData('mr_agama');
		$this->load->view('master/agama/ajaxAgama',$data);
	}

	public function addAgama(){
		$this->Globalrules->session_rule();
		$add = array(
			'nama_agama' => strtoupper($this->input->post('agama'))
		);
		$this->Allcrud->addData('mr_agama',$add);
	}

	public function editAgama($id){
		$this->Globalrules->session_rule();
		$flag = array('id'=>$id);
		$q    = $this->Allcrud->getData('mr_agama',$flag)->row();
		echo json_encode($q);
	}

	public function peditAgama(){
		$flag = array('id'=>$this->input->post('oid'));
		$edit = array(
			'nama_agama' => strtoupper($this->input->post('nagama'))
		);
		$this->Allcrud->editData('mr_agama',$edit,$flag);
	}

	public function delAgama($id){
		$this->Globalrules->session_rule();
		$flag = array('id' => $id);
		$this->Allcrud->delData('mr_agama',$flag);
	}

	public function pendidikan(){
		$this->Globalrules->session_rule();
		$data['title']   = 'Data Pendidikan';
		$data['content'] = 'master/pendidikan/data_pendidikan';
		$data['list']    = $this->Allcrud->listData('mr_pendidikan');
		$this->load->view('templateAdmin',$data);
	}

	public function ajaxPendidikan(){
		$data['list'] = $this->Allcrud->listData('mr_pendidikan');
		$this->load->view('master/pendidikan/ajaxPendidikan',$data);
	}

	public function addPendidikan(){
		$this->Globalrules->session_rule();
		$add = array(
			'kode'            => strtoupper($this->input->post('kode')),
			'nama_pendidikan' => modif_kata($this->input->post('pendidikan'))
		);
		$this->Allcrud->addData('mr_pendidikan',$add);
	}

	public function editPendidikan($id){
		$this->Globalrules->session_rule();
		$flag = array('id'=>$id);
		$q    = $this->Allcrud->getData('mr_pendidikan',$flag)->row();
		echo json_encode($q);
	}

	public function peditPendidikan(){
		$this->Globalrules->session_rule();
		$flag = array('id'=>$this->input->post('oid'));
		$edit = array(
			'kode'            => strtoupper($this->input->post('nkode')),
			'nama_pendidikan' => modif_kata($this->input->post('npendidikan'))
		);
		$this->Allcrud->editData('mr_pendidikan',$edit,$flag);
	}

	public function delPendidikan($id){
		$this->Globalrules->session_rule();
		$flag = array('id' => $id);
		$this->Allcrud->delData('mr_pendidikan',$flag);
	}

	public function eselon1(){
		redirect('master/data_eselon1');
	}

	public function eselon2(){
		redirect('master/data_eselon2');
	}

	public function cariEs2cari(){
		$this->Globalrules->session_rule();
		$flag         = array('id_es1'=>$this->input->post('fes1'));
		$data['fes2'] = $this->Allcrud->getData('mr_eselon2',$flag);
		$this->load->view('master/eselon/ajax/eselon2cari',$data);
	}

	public function eselon3(){
		redirect('master/data_eselon3');
	}

	public function cariEs3edit(){
		$this->Globalrules->session_rule();
		$flag         = array('id_es2'=>$this->input->post('nes2'));
		$data['nes3'] = $this->Allcrud->getData('mr_eselon3',$flag);
		$this->load->view('master/eselon/ajax/eselon3edit',$data);
	}

	public function cariEs3cari(){
		$this->Globalrules->session_rule();
		$flag         = array('id_es2'=>$this->input->post('fes2'));
		$data['fes3'] = $this->Allcrud->getData('mr_eselon3',$flag);
		$this->load->view('master/eselon/ajax/eselon3cari',$data);
	}

	public function eselon4(){
		redirect('master/data_eselon4');
	}

	public function cariEs4edit(){
		$this->Globalrules->session_rule();
		$flag         = array('id_es3'=>$this->input->post('nes3'));
		$data['nes4'] = $this->Allcrud->getData('mr_eselon4',$flag);
		$this->load->view('master/eselon/ajax/eselon4edit',$data);
	}

	public function cariEs4cari(){
		$this->Globalrules->session_rule();
		$flag         = array('id_es3'=>$this->input->post('fes3'));
		$data['fes4'] = $this->Allcrud->getData('mr_eselon4',$flag);
		$this->load->view('master/eselon/ajax/eselon4cari',$data);
	}

	public function kat_posisi(){
		redirect('master/data_kat_posisi');
	}

	public function jurusan_pendidikan(){
		$this->Globalrules->session_rule();
		$this->Globalrules->user_access_read();		
		$data['title']   = 'Jurusan Pendidikan';
		$data['content'] = 'master/jur_pendidikan/data_jur_pendidikan';
		$data['list']    = $this->Allcrud->listData('mr_jur_pendidikan');
		$this->load->view('templateAdmin',$data);
	}

	public function ajaxJurusan_pendidikan(){
		$this->Globalrules->session_rule();
		$data['list'] = $this->Allcrud->listData('mr_jur_pendidikan');
		$this->load->view('master/jur_pendidikan/ajaxJurusan_pendidikan',$data);
	}

	public function addJurusan_pendidikan(){
		$this->Globalrules->session_rule();
		$add = array(
			'kode'                => strtoupper($this->input->post('kode')),
			'nama_jur_pendidikan' => modif_kata($this->input->post('jur_pendidikan'))
		);
		$this->Allcrud->addData('mr_jur_pendidikan',$add);
	}

	public function editJurusan_pendidikan($id){
		$this->Globalrules->session_rule();
		$flag = array('id'=>$id);
		$q    = $this->Allcrud->getData('mr_jur_pendidikan',$flag)->row();
		echo json_encode($q);
	}

	public function peditJurusan_pendidikan(){
		$this->Globalrules->session_rule();
		$flag = array('id'=>$this->input->post('oid'));
		$edit = array(
			'kode'                => strtoupper($this->input->post('nkode')),
			'nama_jur_pendidikan' => modif_kata($this->input->post('njur_pendidikan'))
		);
		$this->Allcrud->editData('mr_jur_pendidikan',$edit,$flag);
	}

	public function delJurusan_pendidikan($id){
		$this->Globalrules->session_rule();
		$flag = array('id' => $id);
		$this->Allcrud->delData('mr_jur_pendidikan',$flag);
	}

	public function status_nikah(){
		$this->Globalrules->session_rule();
		$data['title']   = 'Status Pernikahan';
		$data['content'] = 'master/pernikahan/data_nikah';
		$data['list']    = $this->Allcrud->listData('mr_status_nikah');
		$this->load->view('templateAdmin',$data);
	}

	public function ajaxStatus_nikah(){
		$this->Globalrules->session_rule();
		$data['list'] = $this->Allcrud->listData('mr_status_nikah');
		$this->load->view('master/pernikahan/ajaxNikah',$data);
	}

	public function addStatus_nikah(){
		$this->Globalrules->session_rule();
		$add = array(
			'nama_status_nikah' => strtoupper($this->input->post('nikah'))
		);
		$this->Allcrud->addData('mr_status_nikah',$add);
	}

	public function editStatus_nikah($id){
		$this->Globalrules->session_rule();
		$flag = array('id'=>$id);
		$q    = $this->Allcrud->getData('mr_status_nikah',$flag)->row();
		echo json_encode($q);
	}

	public function peditStatus_nikah(){
		$this->Globalrules->session_rule();
		$flag = array('id'=>$this->input->post('oid'));
		$edit = array(
			'nama_status_nikah' => strtoupper($this->input->post('nnikah'))
		);
		$this->Allcrud->editData('mr_status_nikah',$edit,$flag);
	}

	public function delStatus_nikah($id){
		$this->Globalrules->session_rule();
		$flag = array('id' => $id);
		$this->Allcrud->delData('mr_status_nikah',$flag);
	}

	public function hari(){
		redirect('master/data_hari');
	}

	public function golongan(){
		redirect('master/data_golongan');
	}

	public function struktur($id=NULL){
		redirect('master/data_struktur');
	}

	public function cariStruktur($id=NULL){
		$this->Globalrules->session_rule();
		$key                  = $this->input->post("key");
		$jml                  = $this->Mmaster->struktur(
															NULL,
															NULL,
															array('nama_posisi LIKE'=>'%'.$key.'%')
														);
		$config['base_url']   = site_url().'/master/struktur';
		$config['total_rows'] = $jml->num_rows();
		$config['per_page']   = '10';
		$this->pagination->initialize($config);
		$data['halaman']      = $this->pagination->create_links();
		$data['list']         = $this->Mmaster->struktur(
															$config['per_page'],
															$id,array('nama_posisi LIKE'=>'%'.$key.'%')
														);
		$this->load->view('master/struktur/ajaxCariStruktur',$data);
	}

	public function cariGrade(){
		$this->Globalrules->session_rule();
		if($kat = $this->input->post('kat') != NULL){
			$flag = array ('kat_posisi'=>$this->input->post('kat'),'flag'=>1);
		}else{
			$flag = array ('kat_posisi'=>$this->input->post('nkat'),'flag'=>1);
		}
		$data['grade'] = $this->Mmaster->cariGrade($flag);
		$this->load->view('master/struktur/ajaxCariGrade',$data);
	}

// Last Edit : Bryan
// 2019-02-19
	public function filter_data_pegawai()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$data_sender = array
						(
							'eselon1'    => $data_sender['data_1'],
							'eselon2'    => $data_sender['data_2'],
							'eselon3'    => $data_sender['data_3'],
							'eselon4'    => $data_sender['data_4'],
							'kat_posisi' => $data_sender['data_5']
						);

		$data['list'] = $this->Mmaster->data_pegawai($data_sender,'a.es2 ASC,
																		a.es3 ASC,
																		a.es4 ASC,
																		b.kat_posisi asc,
																		b.atasan ASC');
		if ($data['list'] != 0) {
			# code...
			for ($i=0; $i < count($data['list']); $i++) { 
				# code...
				$get_data_struktur_organisasi = $this->Mmaster->get_data_struktur_organisasi($data['list'][$i]->posisi_akademik);				
				if ($get_data_struktur_organisasi != array()) {
					# code...
					$data['list'][$i]->posisi_akademik_name = $get_data_struktur_organisasi[0]->nama_posisi;
					$atasan_pegawai_akademik                = $this->Globalrules->get_info_pegawai($get_data_struktur_organisasi[0]->atasan,'posisi');				
					if ($atasan_pegawai_akademik != 0) {
						# code...
						$data['list'][$i]->avail_atasan_akademik    = 1;					
						$data['list'][$i]->id_atasan_akademik       = $atasan_pegawai_akademik[0]->id;
						$data['list'][$i]->nip_atasan_akademik      = $atasan_pegawai_akademik[0]->nip;										
						$data['list'][$i]->nama_atasan_akademik     = $atasan_pegawai_akademik[0]->nama_pegawai;
						$data['list'][$i]->jabatan_atasan_akademik  = $atasan_pegawai_akademik[0]->nama_jabatan;										
					}
					else
					{
						$data['list'][$i]->avail_atasan_akademik    = 0;					
						$data['list'][$i]->id_atasan_akademik       = '-';					
						$data['list'][$i]->nip_atasan_akademik      = '-';					
						$data['list'][$i]->nama_atasan_akademik     = '-';
						$data['list'][$i]->jabatan_atasan_akademik  = '-';															
					}
				}
				else
				{
					$data['list'][$i]->posisi_akademik_name = '-';					
					$data['list'][$i]->avail_atasan_akademik    = 0;					
					$data['list'][$i]->id_atasan_akademik       = '-';					
					$data['list'][$i]->nip_atasan_akademik      = '-';					
					$data['list'][$i]->nama_atasan_akademik     = '-';
					$data['list'][$i]->jabatan_atasan_akademik  = '-';																				
				}			
				
				$get_data_struktur_organisasi1 = $this->Mmaster->get_data_struktur_organisasi($data['list'][$i]->posisi_plt);				
				if ($get_data_struktur_organisasi1 != array()) {
					# code...
					$data['list'][$i]->posisi_plt_name = $get_data_struktur_organisasi1[0]->nama_posisi;
					$atasan_pegawai_plt                = $this->Globalrules->get_info_pegawai($get_data_struktur_organisasi1[0]->atasan,'posisi');				
					if ($atasan_pegawai_plt != 0) {
						# code...
						$data['list'][$i]->avail_atasan_plt    = 1;					
						$data['list'][$i]->id_atasan_plt       = $atasan_pegawai_plt[0]->id;
						$data['list'][$i]->nip_atasan_plt      = $atasan_pegawai_plt[0]->nip;										
						$data['list'][$i]->nama_atasan_plt     = $atasan_pegawai_plt[0]->nama_pegawai;
						$data['list'][$i]->jabatan_atasan_plt  = $atasan_pegawai_plt[0]->nama_jabatan;										
					}
					else
					{
						$data['list'][$i]->avail_atasan_plt    = 0;					
						$data['list'][$i]->id_atasan_plt       = '-';					
						$data['list'][$i]->nip_atasan_plt      = '-';					
						$data['list'][$i]->nama_atasan_plt     = '-';
						$data['list'][$i]->jabatan_atasan_plt  = '-';															
					}					
				}
				else
				{
					$data['list'][$i]->posisi_plt_name = '-';		
					$data['list'][$i]->avail_atasan_plt    = 0;					
					$data['list'][$i]->id_atasan_plt       = '-';					
					$data['list'][$i]->nip_atasan_plt      = '-';					
					$data['list'][$i]->nama_atasan_plt     = '-';
					$data['list'][$i]->jabatan_atasan_plt  = '-';								
				}							

				$data_pegawai = $this->Globalrules->get_info_pegawai($data['list'][$i]->atasan,'posisi');				
				if ($data_pegawai != 0) {
					# code...
					$data['list'][$i]->avail_atasan    = 1;					
					$data['list'][$i]->id_atasan       = $data_pegawai[0]->id;
					$data['list'][$i]->nip_atasan      = $data_pegawai[0]->nip;										
					$data['list'][$i]->nama_atasan     = $data_pegawai[0]->nama_pegawai;
					$data['list'][$i]->jabatan_atasan  = $data_pegawai[0]->nama_jabatan;										
				}
				else
				{
					$data['list'][$i]->avail_atasan    = 0;					
					$data['list'][$i]->id_atasan       = '-';					
					$data['list'][$i]->nip_atasan      = '-';					
					$data['list'][$i]->nama_atasan     = '-';
					$data['list'][$i]->jabatan_atasan  = '-';															
				}

				// $data_eselon_1 = $this->Allcrud->getData('mr_eselon1',array('id_es1'=>$data['list'][$i]['eselon1']))->result_array();
				// $data_eselon_2 = $this->Allcrud->getData('mr_eselon2',array('id_es2'=>$data['list'][$i]['eselon2']))->result_array();
				// $data_eselon_3 = $this->Allcrud->getData('mr_eselon3',array('id_es3'=>$data['list'][$i]['eselon3']))->result_array();
				// $data_eselon_4 = $this->Allcrud->getData('mr_eselon4',array('id_es4'=>$data['list'][$i]['eselon4']))->result_array();												
				// $data['list'][$i]->nama_eselon1 = ($data_eselon_1 != array()) ? $data_eselon_1[0]['nama_eselon1'] : '' ;
				// $data['list'][$i]->nama_eselon2 = ($data_eselon_2 != array()) ? $data_eselon_2[0]['nama_eselon2'] : '' ;
				// $data['list'][$i]->nama_eselon3 = ($data_eselon_3 != array()) ? $data_eselon_3[0]['nama_eselon3'] : '' ;
				// $data['list'][$i]->nama_eselon4 = ($data_eselon_4 != array()) ? $data_eselon_4[0]['nama_eselon4'] : '' ;				

			}
			// die();
		}
		// echo "<pre>";
		// print_r($data['list']);die();
		// echo "</pre>";		
		$this->load->view('master/pegawai/ajax_pegawai_filter',$data);
	}



	public function grade($id_kat_posisi){
		$this->Globalrules->session_rule();
		$this->Globalrules->user_access_read();
		$data['title']	= 'Data Grade Posisi';
		$data['content']= 'master/grade/data_grade';
		$data['list']= $this->Allcrud->listData('mr_posisi_class');
		$data['kat_pos']= $this->Allcrud->listData('mr_kat_posisi');
		$data['grade']= $this->Mmaster->grade($id_kat_posisi);
		$sub = $this->Allcrud->getData('mr_kat_posisi',array('id'=>$id_kat_posisi))->row();
		$data['subtitle'] = $sub->nama_kat_posisi;
		$this->load->view('templateAdmin',$data);
	}

	public function addGrade()
	{
		$this->Globalrules->session_rule();
		$flag = array('posisi_class'=>$this->input->post('grade'));
		$get_data = $this->Allcrud->getData('mr_posisi_class',$flag)->row();
		if ($get_data != '') {
			// code...
			$text_status = "Data Grade untuk ".$this->input->post('grade')." Telah ada, Ditolak oleh sistem.";
			$res_data 	 = 2;
		}
		else {
			// code...
			$add = array(
				'posisi_class' =>$this->input->post('grade'),
				'tunjangan' =>str_replace(",","",$this->input->post('tunjangan'))
			);
			$res_data 		= $this->Allcrud->addData('mr_posisi_class',$add);
			$text_status 	= "Data Berhasil Ditambahkan";
		}

		$text_status = $this->Globalrules->check_status_res($res_data,$text_status);
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);

	}

	public function editGrade($id){
		$this->Globalrules->session_rule();
		$flag = array('id'=>$id);
		$q = $this->Allcrud->getData('mr_posisi_class',$flag)->row();
		echo json_encode($q);
	}

	public function peditGrade(){
		$this->Globalrules->session_rule();
		$flag = array('id'=>$this->input->post('oid'));
		$edit = array(
			'posisi_class' =>$this->input->post('ngrade'),
			'tunjangan' =>str_replace(",","",$this->input->post('ntunjangan'))
		);
		$this->Allcrud->editData('mr_posisi_class',$edit,$flag);
	}

	public function delGrade($id){
		$this->Globalrules->session_rule();
		$flag = array('id' => $id);
		$this->Allcrud->delData('mr_posisi_class',$flag);
	}

	public function aktivasi(){
		$this->Globalrules->session_rule();
		$flag = array ('id' => $this->input->post('id_grade'));
		if($this->input->post('nilai') == 0){
			$this->Allcrud->editData('mr_grade_range',array('flag'=>1),$flag);
		}else{
			$this->Allcrud->editData('mr_grade_range',array('flag'=>0),$flag);
		}
		$data['grade'] = $this->Mmaster->grade($this->input->post('kat_pos'));;
		$this->load->view('grade/ajaxGrade',$data);
	}

/******************************************************************************************************/
	public function pegawai($id=NULL){
		redirect('master/data_pegawai');
	}

	public function reRole(){
		$this->Globalrules->session_rule();
		$flag = array('id'=>$this->input->post('oid'));
		$ubah = array ('id_role'=>$this->input->post('nRole'));
		$this->Allcrud->editData('mr_pegawai',$ubah,$flag);
	}

	public function add_tugas_belajar()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$check_nip = $this->Mmaster->get_data_pegawai_nip($data_sender['nip']);
		$RES = '';
		if ($check_nip != 0) {
			# code...
			$data = array
					(
						'id_pegawai'  => $check_nip[0]->id,
						'tgl_mulai'   => $data_sender['tgl_mulai'],
						'tgl_selesai' => $data_sender['tgl_selesai'],
						'keterangan'  => $data_sender['keterangan']
					);
			$RES = $this->Allcrud->addData('mr_tugas_belajar',$data);
			if ($RES == TRUE) {
				# code...
				$RES = 1;
			}
		}
		else
		{
			$status = array
					(
						'text'   => 'NIP tidak ditemukan',
						'status' => 'error'
					);
			$RES = $status;
		}

		echo json_encode($RES);
	}

	public function edit_tugas_belajar_end()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$check_nip = $this->Mmaster->get_data_pegawai_nip($data_sender['nip']);
		$RES = '';
		if ($check_nip != 0) {
			# code...
			$data = array
					(
						'id_pegawai'  => $check_nip[0]->id,
						'tgl_mulai'   => $data_sender['tgl_mulai'],
						'tgl_selesai' => $data_sender['tgl_selesai'],
						'keterangan'  => $data_sender['keterangan']
					);

			$flag = array(
							'id' => $data_sender['oid']
						);
			$this->Allcrud->editData('mr_tugas_belajar',$data,$flag);
			$RES = 1;
		}
		else
		{
			$status = array
					(
						'text'   => 'NIP tidak ditemukan',
						'status' => 'error'
					);
			$RES = $status;
		}

		echo json_encode($RES);
	}

	public function edit_tugas_belajar($id){
		$this->Globalrules->session_rule();
		$res = $this->Mmaster->get_tugas_belajar_id($id);
		if ($res != 0) {
			# code...
			echo json_encode($res[0]);
		}
	}

	public function ajax_tugas_belajar(){
		$data['list']    = $this->Mmaster->get_data_tugas_belajar();
		$this->load->view('master/tugas_belajar/ajax_tugas_belajar',$data);
	}

	public function del_tugas_belajar($id){
		$this->Globalrules->session_rule();
		$flag = array('id' => $id);
		$this->Allcrud->delData('mr_tugas_belajar',$flag);
	}

	// public function tunjangan_profesi()
	// {
	// 	# code...
	// 	$this->Globalrules->session_rule();
	// 	$data['title']   = 'Data Tunjangan Profesi';
	// 	$data['content'] = 'master/tunjangan_profesi/data_tunjangan_profesi';
	// 	$data['list']    = $this->Mmaster->get_data_tunjangan_profesi();
	// 	$this->load->view('templateAdmin',$data);
	// }

	// public function edit_tunjangan_profesi($id)
	// {
	// 	# code...
	// 	$this->Globalrules->session_rule();
	// 	$res = $this->Mmaster->get_data_tunjangan_profesi_id($id);
	// 	if ($res != 0) {
	// 		# code...
	// 		echo json_encode($res[0]);
	// 	}
	// }

	// public function add_tunjangan_profesi()
	// {
	// 	# code...
	// 	$data_sender = $this->input->post('data_sender');
	// 	$check_nip = $this->Mmaster->get_data_pegawai_nip($data_sender['nip']);
	// 	$RES = '';
	// 	if ($check_nip != 0) {
	// 		# code...

	// 		$get_tunjangan_profesi_pegawai = $this->Mmaster->get_tunjangan_profesi_pegawai($check_nip[0]->id,'DESC');
	// 		if ($get_tunjangan_profesi_pegawai != 0)
	// 		{
	// 			# code...
	// 			$data_last = array
	// 						(
	// 							'tgl_selesai' => date('Y-m-d',strtotime($data_sender['tgl_mulai'] . "-1 days"))
	// 						);
	// 			$flag = array(
	// 							'id' => $get_tunjangan_profesi_pegawai[0]->id
	// 						 );
	// 			$this->Allcrud->editData('mr_tunjangan_profesi',$data_last,$flag);
	// 		}

	// 		$data = array
	// 				(
	// 					'id_pegawai'  => $check_nip[0]->id,
	// 					'tgl_mulai'   => $data_sender['tgl_mulai'],
	// 					'tgl_selesai' => '9999-01-01',
	// 					'tunjangan'   => $data_sender['tunjangan']
	// 				);
	// 		$RES = $this->Allcrud->addData('mr_tunjangan_profesi',$data);
	// 		if ($RES == TRUE) {
	// 			# code...
	// 			$RES = 1;
	// 		}
	// 	}
	// 	else
	// 	{
	// 		$status = array
	// 				(
	// 					'text'   => 'NIP tidak ditemukan',
	// 					'status' => 'error'
	// 				);
	// 		$RES = $status;
	// 	}

	// 	echo json_encode($RES);
	// }

	// public function edit_tunjangan_profesi_end()
	// {
	// 	# code...
	// 	$data_sender = $this->input->post('data_sender');
	// 	$check_nip = $this->Mmaster->get_data_pegawai_nip($data_sender['nip']);
	// 	$RES = '';
	// 	if ($check_nip != 0) {
	// 		# code...
	// 		$get_tunjangan_profesi_pegawai = $this->Mmaster->get_tunjangan_profesi_pegawai($check_nip[0]->id,'DESC');
	// 		if ($get_tunjangan_profesi_pegawai != 0)
	// 		{
	// 			# code...
	// 			if (count($get_tunjangan_profesi_pegawai) > 1) {
	// 				# code...
	// 				$data_last = array
	// 							(
	// 								'tgl_selesai' => date('Y-m-d',strtotime($data_sender['tgl_mulai'] . "-1 days"))
	// 							);
	// 				$flag = array(
	// 								'id' => $get_tunjangan_profesi_pegawai[1]->id
	// 							 );
	// 				$this->Allcrud->editData('mr_tunjangan_profesi',$data_last,$flag);
	// 			}
	// 		}

	// 		$data = array
	// 				(
	// 					'id_pegawai'  => $check_nip[0]->id,
	// 					'tgl_mulai'   => $data_sender['tgl_mulai'],
	// 					'tgl_selesai' => $data_sender['tgl_selesai'],
	// 					'tunjangan'   => $data_sender['tunjangan']
	// 				);

	// 		$flag = array(
	// 						'id' => $data_sender['oid']
	// 					 );
	// 		$this->Allcrud->editData('mr_tunjangan_profesi',$data,$flag);
	// 		$RES = 1;
	// 	}
	// 	else
	// 	{
	// 		$status = array
	// 				(
	// 					'text'   => 'NIP tidak ditemukan',
	// 					'status' => 'error'
	// 				);
	// 		$RES = $status;
	// 	}

	// 	echo json_encode($RES);
	// }

	// public function ajax_tunjangan_profesi()
	// {
	// 	# code...
	// 	$data['list']    = $this->Mmaster->get_data_tunjangan_profesi();
	// 	$this->load->view('master/tunjangan_profesi/ajax_tunjangan_profesi',$data);
	// }

	// public function del_tunjangan_profesi($id)
	// {
	// 	# code...
	// 	$this->Globalrules->session_rule();
	// 	$check_nip = $this->Mmaster->get_data_pegawai_nip($data_sender['nip']);
	// 	if ($check_nip != 0) {
	// 		# code...
	// 		$get_tunjangan_profesi_pegawai = $this->Mmaster->get_tunjangan_profesi_pegawai($check_nip[0]->id,'DESC');
	// 		if ($get_tunjangan_profesi_pegawai != 0)
	// 		{
	// 			# code...
	// 			if (count($get_tunjangan_profesi_pegawai) > 1) {
	// 				# code...
	// 				$data_last = array
	// 							(
	// 								'tgl_selesai' => date('Y-m-d',strtotime($data_sender['tgl_mulai'] . "-1 days"))
	// 							);
	// 				$flag = array(
	// 								'id' => $get_tunjangan_profesi_pegawai[1]->id
	// 							);
	// 				$this->Allcrud->editData('mr_tunjangan_profesi',$data_last,$flag);
	// 			}
	// 		}

	// 		$flag = array('id' => $id);
	// 		$this->Allcrud->delData('mr_tunjangan_profesi',$flag);
	// 	}
	// 	else
	// 	{
	// 		$status = array
	// 				(
	// 					'text'   => 'NIP tidak ditemukan',
	// 					'status' => 'error'
	// 				);
	// 		$RES = $status;
	// 	}

	// }

	public function uraian_tugas()
	{
		# code...
		$this->Globalrules->session_rule();
		$data['title']        = 'Data Uraian Tugas';
		$data['content']      = 'master/uraian_tugas/data_pegawai';
		$flag                 = array();
		$data['list']         = $this->Mmaster->data_pegawai('default','a.es1 asc,
																		b.kat_posisi asc,
																		b.posisi_class asc,
																		a.es2 desc');
		$data['es1']          = $this->Allcrud->listData('mr_eselon1');
		$data['role']         = $this->Allcrud->listData('user_role');
		$data['agama']        = $this->Allcrud->listData('mr_agama');
		$this->load->view('templateAdmin',$data);
	}

	public function akademik()
	{
		# code...
		redirect('master/data_akademik');		
	}

	public function output_skp()
	{
		# code...
		redirect('master/data_output_skp');		
		
	}
}
