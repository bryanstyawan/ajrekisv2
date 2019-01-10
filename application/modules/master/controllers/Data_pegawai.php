<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pegawai extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}

	public function index()
	{
		$this->Globalrules->session_rule();
		$data['title']        = 'Data Pegawai';
		$data['content']      = 'master/pegawai/data_pegawai';
		$flag                 = array();
		$data['list']         = $this->Mmaster->data_pegawai('default','a.es2 ASC,
																		a.es3 ASC,
																		a.es4 ASC,
																		b.kat_posisi asc,
																		b.atasan ASC');
		$data['jenis_posisi'] = $this->Allcrud->listData('mr_kat_posisi');
		$data['es1']          = $this->Allcrud->listData('mr_eselon1');
		$data['es2']          = $this->Allcrud->getData('mr_eselon2',array('id_es1'=>$this->session->userdata('sesEs1')));
		$data['role']         = $this->Allcrud->listData('user_role');
		$data['agama']        = $this->Allcrud->listData('mr_agama');
		$this->load->view('templateAdmin',$data);
	}

	public function tambah_pegawai()
	{
		# code...
		$data['title']      = '<b>Pegawai</b> <i class="fa fa-angle-double-right"></i> Tambah Pegawai';
		$data['content']    = 'master/pegawai/editPegawai';
		$data['flag_crud']  = 'add';
		$data['pegawai']    = '';
		$data['masa_kerja'] = 0;
		$data['eselon1']    = $this->Allcrud->listData('mr_eselon1');
		$this->load->view('templateAdmin',$data);
	}

	public function ubah_pegawai($id){
		$this->Globalrules->session_rule();
		$data['title']             = '<b>Pegawai</b> <i class="fa fa-angle-double-right"></i> Ubah Pegawai';
		$data['content']           = 'master/pegawai/editPegawai';
		$data['flag_crud']         = 'edit';
		$data['pegawai']           = $this->Mmaster->get_data_pegawai($id);
		$data['masa_kerja']        = $this->Mmaster->get_masa_kerja_id_pegawai($id,'ASC');
		$data['eselon1']           = $this->Allcrud->listData('mr_eselon1');
		$data['status_masa_kerja'] = $this->Allcrud->listData('mr_masa_kerja_status')->result_array();
		$this->load->view('templateAdmin',$data);
	}

	public function save_pegawai()
	{
		# code...
		$jabatan         = $this->input->post('inputjabatan');
		$oid             = $this->input->post('oidPegawai');
		$flag_crud       = $this->input->post('flag_crud');
		$id_pegawai      = "";
		$data_masa_kerja = "";
		$data            = array
							(
								'es1'          => $this->input->post('ees1'),
								'es2'          => $this->input->post('ees2'),
								'es3'          => $this->input->post('ees3'),
								'es4'          => $this->input->post('ees4'),
								'posisi'       => $jabatan,
								'nip'          => $this->input->post('inputnip'),
								'nama_pegawai' => $this->input->post('inputnama'),
								'tmt_jabatan'  => $this->input->post('tmt'),
								'local'		   => '0'
							);

		if ($this->input->post('inputpass') != '') {
			// code...
			$data['password'] = md5($this->input->post('inputpass'));
		}

		if ($flag_crud == 'add')
		{
			# code...
			$data['id_role'] = "2";
			$data['status']	 = '1';
			
			$id_pegawai = $this->Mmaster->save_pegawai($data,NULL,$flag_crud);
		}
		elseif ($flag_crud == 'edit')
		{
			# code...
			$id_pegawai      = $oid;
			$get_data_pegawai = $this->Mmaster->get_data_pegawai($oid);
			$this->Mmaster->save_pegawai($data,$oid,$flag_crud);
		}


		$get_masa_kerja_pegawai = $this->Mmaster->get_masa_kerja_id_pegawai($id_pegawai,'DESC');
		if ($get_masa_kerja_pegawai == 0) {
			# code...
			// echo "path 1";die();
			$data_masa_kerja = array
							(
								'id_pegawai'        => $id_pegawai,
								'StartDate'         => $this->input->post('tmt'),
								'EndDate'           => '9999-01-01',
								'id_posisi'         => $jabatan,
								'status_masa_kerja' => 'A'
							);
			$this->Allcrud->addData('mr_masa_kerja',$data_masa_kerja);
			$RES = 1;
		}
		else
		{
			$get_masa_kerja_detail = $this->Mmaster->get_masa_kerja($id_pegawai,$jabatan);

			if ($get_masa_kerja_detail == 0) {
				# code...
				$data_masa_kerja_lama = array
								(
									'EndDate'    => date('Y-m-d',strtotime($this->input->post('tmt') . "-1 days"))
								);

				$flag = array
						(
							'id' => $get_masa_kerja_pegawai[0]->id
						);
				$this->Allcrud->editData('mr_masa_kerja',$data_masa_kerja_lama,$flag);

				$data_masa_kerja_baru = array
								(
									'id_pegawai' => $id_pegawai,
									'StartDate'  => $this->input->post('tmt'),
									'EndDate'    => '9999-01-01',
									'id_posisi'  => $jabatan,
								);
				$this->Allcrud->addData('mr_masa_kerja',$data_masa_kerja_baru);
				$RES = 1;
			}
			else
			{
				$data_masa_kerja = array
								(
									'StartDate'    => $this->input->post('tmt')
								);
				$flag = array
						(
							'id' => $get_masa_kerja_detail[0]->id
						);
				$this->Allcrud->editData('mr_masa_kerja',$data_masa_kerja,$flag);

				if (count($get_masa_kerja_pegawai) > 1) {
					# code...
					$data_masa_kerja_lama = array
									(
										'EndDate'    => date('Y-m-d',strtotime($this->input->post('tmt') . "-1 days"))
									);
					$flag_lama = array
							(
								'id' => $get_masa_kerja_pegawai[1]->id
							);

					$this->Allcrud->editData('mr_masa_kerja',$data_masa_kerja_lama,$flag_lama);
				}
				$RES = 1;
			}
		}
		// $RES = 1;
		echo json_encode($RES);
	}

	public function ajaxPegawai(){
		$this->Globalrules->session_rule();
		$flag          = array('es1.id_es1'=>'1');
		$data['list']  = $this->Mmaster->dataUser($flag,NULL,NULL);
		$data['es1']   = $this->Allcrud->listData('mr_eselon1');
		$data['agama'] = $this->Allcrud->listData('mr_agama');
		$this->load->view('master/pegawai/ajaxPegawai',$data);
	}

	public function delPegawai($id){
		$this->Globalrules->session_rule();
		$res_data    = $this->Allcrud->delData('mr_pegawai',array('id' => $id));
		$text_status = $this->Globalrules->check_status_res($res_data,'Data Pegawai telah berhasil dihapus.');		
		$res         = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);									
	}

	public function delete_masa_kerja($id){
		$this->Globalrules->session_rule();
		$get_masa_kerja = $this->Mmaster->get_masa_kerja_id($id);
		$id_pegawai     = "";
		if ($get_masa_kerja != 0) {
			# code...
			$id_pegawai = $get_masa_kerja[0]->id_pegawai;
		}
		$flag = array('id' => $id);
		$this->Allcrud->delData('mr_masa_kerja',$flag);

		$get_masa_kerja_pegawai = $this->Mmaster->get_masa_kerja_id_pegawai($id_pegawai,'DESC');
		if (count($get_masa_kerja_pegawai) > 1) {
			# code...
				$data_masa_kerja_lama = array
								(
									'EndDate'    => '9999-01-01'
								);

				$flag = array
						(
							'id' => $get_masa_kerja_pegawai[0]->id
						);
				$this->Allcrud->editData('mr_masa_kerja',$data_masa_kerja_lama,$flag);
		}
		$data['masa_kerja']    = $get_masa_kerja_pegawai;
		$this->load->view('master/pegawai/ajax_masa_kerja',$data);
		// print_r($get_masa_kerja_pegawai);die();
	}

	public function unggah_foto_pegawai()
	{
		# code...
	    $config['upload_path']   = FCPATH.'/public/images/pegawai/';
	    $config['allowed_types'] = 'gif|jpg|png|ico';
	    $this->load->library('upload',$config);

	    if($this->upload->do_upload('userfile')){
			$token        = $this->input->post('token_foto');
			$image        = $this->upload->data('file_name');
			$pegawai      = $this->Mmaster->get_data_pegawai($token);
			$get_last_pic = $this->Mmaster->get_last_pic($token);
			if ($get_last_pic != 0) {
				# code...
				for ($i=0; $i < count($get_last_pic); $i++) {
					$data_last_pic = array
									(
										'main_pic' => '0',
										'expired'  => date('Y-m-d',strtotime($this->input->post('tmt') . "+7 days"))
									);

					$flag = array
							(
								'id' => $get_last_pic[0]->id
							);
					$this->Allcrud->editData('mr_pegawai_photo',$data_last_pic,$flag);
				}
			}

			$data_pegawai = array
							(
								'local'          => '1',
							);
			$this->Mmaster->save_pegawai($data_pegawai,$token,'edit');

			$data_insert = array
							(
								'id_pegawai' => $token,
								'nip'        => $pegawai[0]->nip,
								'photo'      => $image,
								'local'		 => '1',
								'main_pic'	 => '1'
					        );
			$this->Allcrud->addData('mr_pegawai_photo',$data_insert);
        }

		echo $this->upload->display_errors();
	}

	public function unggah_foto_pegawai_self()
	{
		# code...
        $config['upload_path']   = FCPATH.'/public/images/pegawai/';
        $config['allowed_types'] = 'gif|jpg|png|ico';
        $this->load->library('upload',$config);

        if($this->upload->do_upload('userfile')){
			$token        = $this->session->userdata('sesUser');
			$image        = $this->upload->data('file_name');
			$pegawai      = $this->Mmaster->get_data_pegawai($token);
			$get_last_pic = $this->Mmaster->get_last_pic($token);
			if ($get_last_pic != 0) {
				# code...
				for ($i=0; $i < count($get_last_pic); $i++) {
					# code...
					$data_last_pic = array
									(
										'main_pic' => '0',
										'expired'  => date('Y-m-d',strtotime($this->input->post('tmt') . "+7 days"))
									);

					$flag = array
							(
								'id' => $get_last_pic[$i]->id
							);
					$this->Allcrud->editData('mr_pegawai_photo',$data_last_pic,$flag);
				}
			}

			$data_pegawai = array
							(
								'local'          => '1',
							);
			$this->Mmaster->save_pegawai($data_pegawai,$token,'edit');

			$data_insert = array
							(
								'id_pegawai' => $token,
								'nip'        => $pegawai[0]->nip,
								'photo'      => $image,
								'local'		 => '1',
								'main_pic'	 => '1'
					        );
			$this->Allcrud->addData('mr_pegawai_photo',$data_insert);
        }

		echo $this->upload->display_errors();
	}

	public function cariJabatan(){
		$this->Globalrules->session_rule();
		if($this->input->post('es4') != NULL || $this->input->post('nes4') != NULL){
			if($this->input->post('es4') == NULL){
				$flag = array(
				'eselon4'=> $this->input->post('nes4')
				);
			}else{
				$flag = array(
				'eselon4'=> $this->input->post('es4')
				);
			}
		}elseif($this->input->post('es3') != NULL || $this->input->post('nes3') != NULL){
			if($this->input->post('es3') == NULL){
				$flag = array(
				'eselon3'=> $this->input->post('nes3'),
				'eselon4'=> 0
				);
			}else{
				$flag = array(
				'eselon3'=> $this->input->post('es3'),
				'eselon4'=> 0
				);
			}
		}elseif($this->input->post('es2') != NULL || $this->input->post('nes2') != NULL){
			if($this->input->post('es2') == NULL){
				$flag = array(
				'eselon2'=> $this->input->post('nes2'),
				'eselon3'=> 0
				);
			}else{
				$flag = array(
				'eselon2'=> $this->input->post('es2'),
				'eselon3'=> 0
				);
			}
		}else{
			if($this->input->post('es1') == NULL){
				$flag = array(
				'eselon1'=> $this->input->post('nes1'),
				'eselon2'=> 0
				);
			}else{
				$flag = array(
				'eselon1'=> $this->input->post('es1'),
				'eselon2'=> 0
				);
			}
		}
		$data['jabatan'] = $this->Allcrud->getData('mr_posisi',$flag);
		$this->load->view('master/pegawai/ajaxjabatan',$data);
	}

	public function masa_kerja_pegawai_id($id)
	{
		// code...
		$res = $this->Mmaster->get_masa_kerja_id($id);
		echo json_encode($res);
	}

	public function change_status_masa_kerja($id)
	{
		// code...
		$data_sender 		 = $this->input->post('data_sender');
		$data_masa_kerja = array
						(
							'status_masa_kerja'  	=> $data_sender['status'],
							'tanggal_status'	 		=> $data_sender['tanggal_status']
						);
		$flag = array
				(
					'id' => $id
				);

		$res_data 	 = $this->Allcrud->editData('mr_masa_kerja',$data_masa_kerja,$flag);		
		$text_status = $this->Globalrules->check_status_res($res_data,'Status telah ditambahkan');
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}
}
