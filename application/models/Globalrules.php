<?php
/*
write by Bryan Setyawan
Create : 27/06/2016
*/
class Globalrules extends CI_Model
{

	public function __construct () {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model ('transaksi/mtrx', '', TRUE);
		$this->load->model ('skp/mskp', '', TRUE);
		$this->load->model ('master/Mmaster', '', TRUE);
	}

	private $year_system = 2021;
	private $prev_year_system = 2021-1;

	public function session_rule()
	{
		if($this->session->userdata('login') == "")
		{
			//get user data
			redirect('auth');
		}
	}

	public function user_access_read()
	{
		# code...
		$uri_segment_1 = $this->uri->segments[1];
		$uri_segment_2 = $this->uri->segments[2];
		$menu          = $uri_segment_1."/".$uri_segment_2;
		$role_id       = $this->session->userdata('sesRole');
		$get_menu      = $this->Allcrud->getData('config_menu',array('uri' => $menu))->result_array();			
		if ($menu != 'dashboard/soon') {
			# code...
			if ($get_menu != array()) {
				# code...
				$get_menu_access = $this->Allcrud->getData('config_menu_akses',array('id_menu' => $get_menu[0]['id_menu'], 'id_role' => $role_id))->result_array();					
				if ($get_menu_access != array()) {
					# code...
					if ($get_menu_access[0]['baca'] == 0) {
						# code...
						redirect('dashboard/home');
					}											
				}
			}
		}
	}

	public function trigger_insert_update()
	{
		# code...
		return array('audit_time' => date('Y-m-d H:i:s'), 'audit_user' => $this->session->userdata('sesNip'));
	}	

	public function notif_message()
		{
		$count_inbox = "";
		$count_send  = "";
		$id_penerima = $this->session->userdata('sesUser');
		$sql_inbox = "SELECT DISTINCT count(a.id_pesan) as `row`
				    FROM pesan a
				    WHERE a.id_penerima = '$id_penerima'
				    AND a.flag_read <> 1
				    AND a.flag_delete_inbox <> 1";

		$sql_send = "SELECT DISTINCT count(a.id_pesan) as `row`
				    FROM pesan a
				    WHERE a.id_pengirim = '$id_penerima'
				    AND a.audit_pengguna = '$id_penerima'
				    AND a.flag_delete_sent <> 1";

		$query_inbox = $this->db->query($sql_inbox);
		$query_send  = $this->db->query($sql_send);

		if($query_inbox->num_rows() > 0)
		{
			$count_inbox = $query_inbox->result();
			$count_inbox = $count_inbox[0]->row;
		}
		else
		{
			$count_inbox = 0;
		}

		if($query_send->num_rows() > 0)
		{
			$count_send = $query_send->result();
			$count_send = $count_send[0]->row;
		}
		else
		{
			$count_send = 0;
		}

		$this->input->set_cookie("row_send", $count_send, 3600);
		$this->input->set_cookie("row_inbox", $count_inbox, 3600);
		return $count_inbox;
	}	

	public function push_notifikasi($data_sender,$flag)
	{
		# code...
		$res_data = '';
		if ($flag == 'read_data')
		{
			# code...
			$data_change = array('status_read' => '1');
			$flag        = array(
									'id_table'   => $data_sender['id_table'],
									'table_name' => $data_sender['table_name']
								);
			$res_data    = $this->Allcrud->editData('log_notifikasi',$data_change,$flag);
		}
		elseif ($flag == 'delete_data') {
			# code...
			$flag        = array(
									'id_table'   => $data_sender['id_table'],
									'table_name' => $data_sender['table_name']
								);
			$res_data = $this->Allcrud->delData('log_notifikasi',$flag);
		}
		elseif ($flag == 'approval') {
			# code...
			$who_is_super      = $this->mtrx->get_pegawai_id($this->session->userdata('atasan'),'atasan');
			if ($who_is_super) {
				# code...
				$who_is_super = $who_is_super[0]->id;
			}
			else
			{
				$who_is_super = 0;
			}

			$data_sender['receiver']    = $who_is_super;
			$data_sender['sender']      = $this->session->userdata('sesUser');
			$data_sender['status_read'] = 0;
			$data_sender['audit_time']  = date('Y-m-d H:i:s');
			$check_data                 = $this->check_data_notify($data_sender['url'],$data_sender['table_name'],$data_sender['id_table']);

			if ($check_data == false) {
				# code...
				$res_data = $this->Allcrud->addData('log_notifikasi',$data_sender);
			}
			else
			{
				$res_data = 1;
			}
		}
		elseif ($flag == 'notify') {
			# code...
			$data_sender['status_log']  = 'notify';
			$data_sender['status_read'] = 0;
			$data_sender['audit_time']  = date('Y-m-d H:i:s');
			$res_data                   = $this->Allcrud->addData('log_notifikasi',$data_sender);
		}
		return $res_data;
	}

	public function check_data_notify($url=NULL,$table_name=NULL,$id_table=NULL)
	{
		# code...
		$sql = "SELECT a.*
				FROM log_notifikasi a
				WHERE a.url = '".$url."'
				AND a.table_name = '".$table_name."'
				AND a.id_table = '".$id_table."'
				AND a.status_read = 0";
		$query = $this->db->query($sql);
		return ($query->num_rows() > 0) ? true : false;
	}

	public function check_pegawai($id=NULL)
	{
		# code...
		$sql = "";
		
		$sql = "SELECT  a.id,
						COALESCE(a.tmt_golongan,'-') as tmt_golongan,
						a.nama_pegawai,
						a.posisi,
						a.nip,
						a.TempatLahir,
						a.BirthDate,
						a.Gender,
						a.email,
						a.no_hp,
						a.alamat,
						a.golongan,						
						b.nama_posisi as `nama_jabatan`,
						a.tmt_jabatan,
						b.atasan,
						b.id as `id_posisi`,
						b.kat_posisi,
						c.posisi_class as `kelas_jabatan`,
						es1.nama_eselon1,
						es2.nama_eselon2,
						es3.nama_eselon3,
						es4.nama_eselon4,
						COALESCE(a.posisi_plt,0) as posisi_plt,
						COALESCE(a.posisi_akademik,0) as posisi_akademik,						
						COALESCE(a.photo,'-') as photo,
						COALESCE(agm.nama_agama,'-') as nama_agama,
						COALESCE(gol.ruang,'-') as nama_ruang,
						COALESCE(gol.nama_pangkat,'-') as nama_pangkat,
						COALESCE(gol.golongan,'-') as nama_golongan,
						COALESCE(b.nama_posisi,'-') as nama_posisi_raw,										
						COALESCE(c.posisi_class,'-') as grade_raw,
						COALESCE(c.tunjangan,'-') as tunjangan_raw,					
						COALESCE(jft.nama_jabatan,'-') as nama_posisi_jft,					
						COALESCE(cls_jft.posisi_class,'-') as grade_jft,
						COALESCE(cls_jft.tunjangan,'-') as tunjangan_jft,					
						COALESCE(jfu.nama_jabatan,'-') as nama_posisi_jfu,										
						COALESCE(cls_jfu.posisi_class,'-') as grade_jfu,
						COALESCE(cls_jfu.tunjangan,'-') as tunjangan_jfu						
				FROM mr_pegawai a
				LEFT JOIN mr_posisi b ON a.posisi = b.id
				LEFT JOIN mr_posisi_class c ON b.posisi_class = c.id
				LEFT JOIN mr_jabatan_fungsional_tertentu jft ON b.id_jft  = jft.id
				LEFT JOIN mr_posisi_class cls_jft ON jft.id_kelas_jabatan = cls_jft.id
				LEFT JOIN mr_jabatan_fungsional_umum jfu ON b.id_jfu      = jfu.id
				LEFT JOIN mr_posisi_class cls_jfu ON jfu.id_kelas_jabatan = cls_jfu.id				
				LEFT JOIN mr_eselon1 es1 ON es1.id_es1 = a.es1
				LEFT OUTER JOIN mr_eselon2 es2 ON es2.id_es2 = b.eselon2
				LEFT OUTER JOIN mr_eselon3 es3 ON es3.id_es3 = b.eselon3
				LEFT OUTER JOIN mr_eselon4 es4 ON es4.id_es4 = b.eselon4
				LEFT OUTER JOIN mr_agama agm on agm.id_agama = a.id_agama				
				LEFT OUTER JOIN mr_golongan gol ON gol.id = a.golongan				
				WHERE a.id = '".$id."' AND a.status = 1";
				// NOTE ==> Kolom Posisi_class pada mr_posisi dan ID pada mr_POSISI_CLASS
				// print_r($sql);die();
		$query = $this->db->query($sql);
		return ($query->num_rows() > 0) ? $query->result() : 0;
	}

	public function get_info_pegawai($id=NULL,$param=NULL,$id_posisi=NULL)
	{
		# code...
		$sql = "";
		if ($param == NULL) {
			# code...
			if ($id==NULL) {
				# code...
				$con = "a.nip = '".$this->session->userdata('sesNip')."' AND a.status <> 0 AND b.id = '".$this->session->userdata('sesPosisi')."'";
			}
		}
		elseif ($param == 'id') {
			# code...
			$con = "a.id = '".$id."' AND a.status <> 0 AND b.id = '".$id_posisi."'";
		}
		elseif ($param == 'nama_pegawai') {
			# code...
			$con = "a.nama_pegawai = '".$id."' AND a.status <> 0 AND b.id = a.posisi";
		}
		elseif ($param == 'posisi') {
			# code...
			$con = "b.id = '".$id."' AND a.status <> 0 AND b.id = a.posisi";
		}		

		$sql = "SELECT  a.id,
						COALESCE(a.tmt_golongan,'-') as tmt_golongan,
						a.nama_pegawai,
						a.posisi,
						a.nip,
						a.TempatLahir,
						a.BirthDate,
						a.Gender,
						a.email,
						a.no_hp,
						a.alamat,
						a.golongan,						
						b.nama_posisi as `nama_jabatan`,
						a.tmt_jabatan,
						b.atasan,
						b.id as `id_posisi`,
						b.kat_posisi,
						c.posisi_class as `kelas_jabatan`,
						es1.nama_eselon1,
						es2.nama_eselon2,
						es3.nama_eselon3,
						es4.nama_eselon4,
						COALESCE(a.posisi_plt,0) as posisi_plt,
						COALESCE(a.posisi_akademik,0) as posisi_akademik,						
						COALESCE(a.photo,'-') as photo,
						COALESCE(agm.nama_agama,'-') as nama_agama,
						COALESCE(gol.ruang,'-') as nama_ruang,
						COALESCE(gol.nama_pangkat,'-') as nama_pangkat,
						COALESCE(gol.golongan,'-') as nama_golongan,
						COALESCE(b.nama_posisi,'-') as nama_posisi_raw,										
						COALESCE(c.posisi_class,'-') as grade_raw,
						COALESCE(c.tunjangan,'-') as tunjangan_raw,					
						COALESCE(jft.nama_jabatan,'-') as nama_posisi_jft,					
						COALESCE(cls_jft.posisi_class,'-') as grade_jft,
						COALESCE(cls_jft.tunjangan,'-') as tunjangan_jft,					
						COALESCE(jfu.nama_jabatan,'-') as nama_posisi_jfu,										
						COALESCE(cls_jfu.posisi_class,'-') as grade_jfu,
						COALESCE(cls_jfu.tunjangan,'-') as tunjangan_jfu						
				FROM mr_pegawai a
				JOIN mr_posisi b
				LEFT JOIN mr_posisi_class c ON b.posisi_class = c.id
				LEFT JOIN mr_jabatan_fungsional_tertentu jft ON b.id_jft  = jft.id
				LEFT JOIN mr_posisi_class cls_jft ON jft.id_kelas_jabatan = cls_jft.id
				LEFT JOIN mr_jabatan_fungsional_umum jfu ON b.id_jfu      = jfu.id
				LEFT JOIN mr_posisi_class cls_jfu ON jfu.id_kelas_jabatan = cls_jfu.id				
				LEFT JOIN mr_eselon1 es1 ON es1.id_es1 = a.es1
				LEFT OUTER JOIN mr_eselon2 es2 ON es2.id_es2 = b.eselon2
				LEFT OUTER JOIN mr_eselon3 es3 ON es3.id_es3 = b.eselon3
				LEFT OUTER JOIN mr_eselon4 es4 ON es4.id_es4 = b.eselon4
				LEFT OUTER JOIN mr_agama agm on agm.id_agama = a.id_agama				
				LEFT OUTER JOIN mr_golongan gol ON gol.id = a.golongan				
				WHERE ".$con."";
				// NOTE ==> Kolom Posisi_class pada mr_posisi dan ID pada mr_POSISI_CLASS
				// print_r($sql);die();
		$query = $this->db->query($sql);
		return ($query->num_rows() > 0) ? $query->result() : 0;
	}

	public function get_log_notify_id($id)
	{
		# code...
		$sql = "SELECT a.*
				FROM log_notifikasi a
				WHERE a.id = '".$id."'";
		$query = $this->db->query($sql);
		return ($query->num_rows() > 0) ? $query->result() : 0;
	}

	public function check_status_res($res_data,$text_status=NULL)
	{
		# code...
		if ($res_data == 1) {
			# code...
			$text_status = $text_status;
		}
		elseif ($res_data == 2) {
			# code...
			$text_status = $text_status;
		}
		else
		{
			$text_status = "Telah terjadi kesalahan sistem";
		}

		return $text_status;
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
		$aspek_biaya = 0;
		$tingkat_efisiensi = 0;		
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

		return array
		(
			'aspek_biaya'       => $aspek_biaya,
			'tingkat_efisiensi' => $tingkat_efisiensi
		);		
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

	public function nilai_capaian_skp($parameter)
	{
		# code...
		$nilai_skp = "";
		$style     = "";
		if ($parameter >= 91) {
			# code...
			$nilai_skp = "Sangat Baik";
			$style     = "background:#00BCD4;";
		}
		elseif ($parameter >= 76) {
			# code...
			$nilai_skp = "Baik";
			$style     = "background:#8BC34A;";
		}
		elseif ($parameter >= 61) {
			# code...
			$nilai_skp = "Cukup";
			$style     = "background:#FFEB3B;";
		}
		elseif ($parameter >= 51) {
			# code...
			$nilai_skp = "Kurang";
			$style     = "background:#F44336;";
		}
		elseif ($parameter <= 50) {
			# code...
			$nilai_skp = "Buruk";
			$style     = "background:#F44336;";
		}

		return array
		(
			'value' => $nilai_skp,
			'css'   => $style
		);
	}

	public function data_summary_skp_pegawai($id,$_id_posisi,$year_system)
	{
		# code...
		$data['tugas_tambahan']          = $this->mskp->get_summary_tugas_tambahan($id,$year_system,NULL);
		$data['kreativitas']             = $this->mskp->get_summary_tugas_tambahan($id,$year_system,'kreativitas');
		$data['tr_tugas_tambahan']       = $this->mtrx->tugas_tambahan($id,1,'tugas-tambahan',$year_system);
		$data['tr_kreativitas']          = $this->mtrx->tugas_tambahan($id,1,'kreativitas',$year_system);
		$data['evaluator']               = $this->mskp->get_data_evaluator($id,$year_system,$_id_posisi);
		$data['nilai_prilaku_atasan']    = $this->mskp->_get_nilai_prilaku($id,$_id_posisi,'atasan',$year_system);
		$data['nilai_prilaku_atasan_plt']    = $this->mskp->_get_nilai_prilaku($id,$_id_posisi,'atasan_plt',$year_system);		
		$data['nilai_prilaku_peer']      = $this->mskp->_get_nilai_prilaku($id,$_id_posisi,'peer',$year_system);
		$data['nilai_prilaku_bawahan']   = $this->mskp->_get_nilai_prilaku($id,$_id_posisi,'bawahan',$year_system);
		

		if ($data['nilai_prilaku_atasan'][0]->orientasi_pelayanan == 0) {
			# code...
			if ($data['nilai_prilaku_atasan_plt'][0]->orientasi_pelayanan != 0) {
				# code...
				$data['nilai_prilaku_atasan'] = $data['nilai_prilaku_atasan_plt'];
			}			
		}

		$data['infoPegawai']             = $this->get_info_pegawai($id,'id',$_id_posisi);
		$data['is_bawahan']              = $this->Globalrules->list_bawahan($_id_posisi);
		if ($data['infoPegawai'] != 0) {
			# code...
			$nip                             = $data['infoPegawai'][0]->nip;
			$get_pangkat                     = $this->mskp->get_golongan($nip);
			if ($get_pangkat != array()) {
				# code...
				$data['infoPegawai'][0]->nama_golongan = $get_pangkat[0]->golongan;
				$data['infoPegawai'][0]->nama_pangkat  = $get_pangkat[0]->nama_pangkat;
				$data['infoPegawai'][0]->tmt_pangkat   = $get_pangkat[0]->tmt_pangkat;						
			}
			else
			{
				$data['infoPegawai'][0]->nama_golongan = '-';
				$data['infoPegawai'][0]->nama_pangkat  = '-';
				$data['infoPegawai'][0]->tmt_pangkat   = '-';			
			}			
		}


		$_atasan_data        = $this->list_atasan($_id_posisi);
		$_atasan_id          = ($_atasan_data == 0) ? 0 : $_atasan_data[0]->id;
		$_atasan_id_posisi   = ($_atasan_data == 0) ? 0 : $_atasan_data[0]->posisi;		
		$data['atasan']      = ($_atasan_data == 0) ? 0 : $this->get_info_pegawai($_atasan_id,'id',$_atasan_id_posisi); 		
		if ($_atasan_data == 0) {
			# code...
			$data['atasan_akademik'] = $this->list_atasan_akademik($_id_posisi);			
			$data['atasan_plt'] = $this->list_atasan_plt($_id_posisi);
			// print_r($data['atasan_plt']);die();
		}		
		if ($data['atasan'] != 0) 
		{
			$nip              = $data['atasan'][0]->nip;
			$get_pangkat      = $this->mskp->get_golongan($nip);
			if ($get_pangkat != array()) {
				# code...
				$data['atasan'][0]->nama_golongan = $get_pangkat[0]->golongan;
				$data['atasan'][0]->nama_pangkat  = $get_pangkat[0]->nama_pangkat;
				$data['atasan'][0]->tmt_pangkat   = $get_pangkat[0]->tmt_pangkat;						
			}
			else
			{
				$data['atasan'][0]->nama_golongan = '-';
				$data['atasan'][0]->nama_pangkat  = '-';
				$data['atasan'][0]->tmt_pangkat   = '-';				
			}													

			$check_atasan_again = $this->Allcrud->getData('mr_posisi',array('id' => $data['atasan'][0]->posisi))->result_array();
			if($check_atasan_again != array())
			{			
				if ($check_atasan_again[0]['id'] == 0) {
					# code...
					// $data['atasan'] = 0;
				}
				else
				{

					$_atasan_data                = $this->list_atasan($check_atasan_again[0]['id']);
					$_atasan_id                  = ($_atasan_data == 0) ? 0 : $_atasan_data[0]->id;
					$_atasan_id_posisi           = ($_atasan_data == 0) ? 0 : $_atasan_data[0]->posisi;		
					$data['atasan_penilai']      = ($_atasan_data == 0) ? 0 : $this->get_info_pegawai($_atasan_id,'id',$_atasan_id_posisi); 

					if ($data['atasan_penilai'] == 0) {
						# code...
						$_atasan_data           = $this->list_atasan($_id_posisi);
						$_atasan_id             = ($_atasan_data == 0) ? 0 : $_atasan_data[0]->id;
						$_atasan_id_posisi      = ($_atasan_data == 0) ? 0 : $_atasan_data[0]->posisi;		
						$data['atasan_penilai'] = ($_atasan_data == 0) ? 0 : $this->get_info_pegawai($_atasan_id,'id',$_atasan_id_posisi); 

					}

					if ($data['atasan_penilai'] != 0) {
						# code...
						$nip              = $data['atasan_penilai'][0]->nip;
						$get_pangkat      = $this->mskp->get_golongan($nip);
						if ($get_pangkat != array()) {
							# code...
							$data['atasan_penilai'][0]->nama_golongan = $get_pangkat[0]->golongan;
							$data['atasan_penilai'][0]->nama_pangkat  = $get_pangkat[0]->nama_pangkat;
							$data['atasan_penilai'][0]->tmt_pangkat   = $get_pangkat[0]->tmt_pangkat;						
						}
						else
						{
							$data['atasan_penilai'][0]->nama_golongan = '-';
							$data['atasan_penilai'][0]->nama_pangkat  = '-';
							$data['atasan_penilai'][0]->tmt_pangkat   = '-';									
						}						
					}
					else
					{
						$data['atasan_penilai'][0]->nama_golongan = '-';
						$data['atasan_penilai'][0]->nama_pangkat  = '-';
						$data['atasan_penilai'][0]->tmt_pangkat   = '-';						
					}
													

				}
			}
		}
		else
		{
			$data['atasan_penilai'] = 0;			
			// $data['atasan'][0]->nama_golongan = '-';
			// $data['atasan'][0]->nama_pangkat  = '-';
			// $data['atasan'][0]->tmt_pangkat   = '-';			
		}

		$data['list_skp']                                   = $this->mskp->get_data_skp_pegawai($id,$_id_posisi,$year_system,'1','realisasi');
		$data['summary_prilaku_skp']['integritas']          = $this->get_penilaian_prilaku(
																$data['nilai_prilaku_atasan'][0]->integritas,
																// $data['nilai_prilaku_atasan_plt'][0]->integritas,
																$data['nilai_prilaku_peer'][0]->integritas,
																$data['nilai_prilaku_bawahan'][0]->integritas
															);

		$data['summary_prilaku_skp']['orientasi_pelayanan'] = $this->get_penilaian_prilaku(
																$data['nilai_prilaku_atasan'][0]->orientasi_pelayanan,
																// $data['nilai_prilaku_atasan_plt'][0]->orientasi_pelayanan,			
																$data['nilai_prilaku_peer'][0]->orientasi_pelayanan,
																$data['nilai_prilaku_bawahan'][0]->orientasi_pelayanan
															);

		$data['summary_prilaku_skp']['komitmen']            = $this->get_penilaian_prilaku(
																$data['nilai_prilaku_atasan'][0]->komitmen,
																// $data['nilai_prilaku_atasan_plt'][0]->komitmen,			
																$data['nilai_prilaku_peer'][0]->komitmen,
																$data['nilai_prilaku_bawahan'][0]->komitmen
															);

		$data['summary_prilaku_skp']['disiplin']            = $this->get_penilaian_prilaku(
																$data['nilai_prilaku_atasan'][0]->disiplin,
																// $data['nilai_prilaku_atasan_plt'][0]->disiplin,			
																$data['nilai_prilaku_peer'][0]->disiplin,
																$data['nilai_prilaku_bawahan'][0]->disiplin
															);

		$data['summary_prilaku_skp']['kerjasama']           = $this->get_penilaian_prilaku(
																$data['nilai_prilaku_atasan'][0]->kerjasama,
																// $data['nilai_prilaku_atasan_plt'][0]->kerjasama,			
																$data['nilai_prilaku_peer'][0]->kerjasama,
																$data['nilai_prilaku_bawahan'][0]->kerjasama
															);

		$data['summary_prilaku_skp']['kepemimpinan']        = ($data['infoPegawai'] != 0) ? ($data['infoPegawai'][0]->kat_posisi == 1 || $data['infoPegawai'][0]->kat_posisi == 6) ? $this->get_penilaian_prilaku($data['nilai_prilaku_atasan'][0]->kepemimpinan,$data['nilai_prilaku_atasan_plt'][0]->kepemimpinan,$data['nilai_prilaku_peer'][0]->kepemimpinan,$data['nilai_prilaku_bawahan'][0]->kepemimpinan) : 0  : 0;
		$data['summary_prilaku_skp']['status']              = $this->get_penilaian_prilaku(
																$data['nilai_prilaku_atasan'][0]->status,
																// $data['nilai_prilaku_atasan_plt'][0]->status,			
																$data['nilai_prilaku_peer'][0]->status,
																$data['nilai_prilaku_bawahan'][0]->status,
																'status',
																($data['evaluator'] == 0) ? 1 : count($data['evaluator'])
															);

		$data['summary_prilaku_skp']['jumlah']              = $data['summary_prilaku_skp']['orientasi_pelayanan'] + $data['summary_prilaku_skp']['integritas'] + $data['summary_prilaku_skp']['komitmen'] + $data['summary_prilaku_skp']['disiplin'] + $data['summary_prilaku_skp']['kerjasama'] + $data['summary_prilaku_skp']['kepemimpinan'];
		$data['summary_prilaku_skp']['rata_rata']           = ($data['infoPegawai'] != 0) ? ($data['infoPegawai'][0]->kat_posisi == 1 || $data['infoPegawai'][0]->kat_posisi == 6) ? $data['summary_prilaku_skp']['jumlah'] / 6 : $data['summary_prilaku_skp']['jumlah'] / 5  : 0 ;

		$data['summary_prilaku_skp']['nilai_prilaku_kerja'] = ($data['summary_prilaku_skp']['rata_rata']*40)/100;
		$data['summary_skp']['nilai_capaian_skp']           = "";
		$data['summary_skp']['total_aspek']                 = 0;
		if ($data['list_skp'] != 0) {
				# code...
			for ($i=0; $i < count($data['list_skp']); $i++) {
				# code...
				$data['list_skp'][$i]->aspek_kualitas      = $this->aspek_kualitas($data['list_skp'][$i]->realisasi_kualitasmutu,$data['list_skp'][$i]->target_kualitasmutu);
				$data['list_skp'][$i]->aspek_kuantitas     = $this->aspek_kuantitas($data['list_skp'][$i]->realisasi_kuantitas,$data['list_skp'][$i]->target_qty,$data['list_skp'][$i]->realisasi_kualitasmutu);				
				$data['list_skp'][$i]->aspek_waktu         = $this->aspek_waktu($data['list_skp'][$i]->target_waktu_bln,$data['list_skp'][$i]->target_waktu_bln,$data['list_skp'][$i]->realisasi_kuantitas);
				$data['list_skp'][$i]->aspek_biaya         = $this->aspek_biaya($data['list_skp'][$i]->target_biaya,$data['list_skp'][$i]->realisasi_biaya,$data['list_skp'][$i]->realisasi_kuantitas);
				$data['list_skp'][$i]->perhitungan         = $this->perhitungan_skp($data['list_skp'][$i]->aspek_kuantitas,$data['list_skp'][$i]->aspek_kualitas,$data['list_skp'][$i]->aspek_waktu['aspek_waktu'],$data['list_skp'][$i]->aspek_biaya['aspek_biaya'],$data['list_skp'][$i]->target_biaya);
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

		$list_skp_count                                         = ($data['list_skp'] == 0) ? 1 : count($data['list_skp']);
		$data['persentase_target_realisasi']                    = $this->mskp->get_persentase_target_realisasi($year_system);
		$data['summary_skp']['tugas_tambahan']                  = $this->nilai_tugas_tambahan($data['tugas_tambahan']);
		$data['summary_skp']['total']                           = $data['summary_skp']['total_aspek']/$list_skp_count + $data['summary_skp']['tugas_tambahan'] + $data['kreativitas'];
		$data['summary_skp']['nilai_sasaran_kinerja_pegawai']   = ($data['summary_skp']['total']*60)/100;
		$data['summary_skp_dan_prilaku']                        = $data['summary_skp']['nilai_sasaran_kinerja_pegawai'] + $data['summary_prilaku_skp']['nilai_prilaku_kerja'];
		$data['summary_alpha']                                  = $this->nilai_capaian_skp($data['summary_skp_dan_prilaku']);
		return $data;
	}

	public function list_atasan($posisi=NULL)
	{
		# code...
		$sql = "SELECT DISTINCT b.*,
								b.id AS `id_pegawai`,
								a.nama_posisi
			    FROM mr_posisi a
			    JOIN mr_pegawai b
			    ON (a.atasan = b.posisi or a.atasan = b.posisi_plt)
			    WHERE a.id = '".$posisi."'
			    AND b.status = 1";
		$query = $this->db->query($sql);
		return ($query->num_rows() > 0) ? $query->result() : 0;
	}

	public function list_atasan_plt($posisi=NULL)
	{
		# code...
		$sql = "SELECT DISTINCT b.*,
								b.id AS `id_pegawai`,
								a.nama_posisi
			    FROM mr_posisi a
			    JOIN mr_pegawai b
			    ON a.atasan = b.posisi_plt
			    WHERE a.id = '".$posisi."'
			    AND b.status = 1";
		$query = $this->db->query($sql);
		return ($query->num_rows() > 0) ? $query->result() : 0;
	}

	public function list_atasan_akademik($posisi=NULL)
	{
		# code...
		$sql = "SELECT DISTINCT b.*,
								b.id AS `id_pegawai`,
								a.nama_posisi
			    FROM mr_posisi a
			    JOIN mr_pegawai b
			    ON a.id = b.posisi_akademik
			    WHERE a.id = '".$posisi."'
				AND b.status = 1";
		$query = $this->db->query($sql);
		return ($query->num_rows() > 0) ? $query->result() : 0;
	}	

	public function list_bawahan($posisi,$parameter=NULL,$arg=NULL)
	{
		# code...
		$sql_where = '';
		if ($parameter == '' || $parameter == NULL) {
			# code...
			$sql_where = '';
		}
		else {
			# code...
			$sql_where = "AND b.kat_posisi = '".$parameter."'";
		}

		$sql = "";
		if($arg == 'penilaian_skp')
		{
			$sql_where_1 = "";
			if ($parameter == 'id_pegawai') {
				# code...
				$sql_where     = "a.id_pegawai = '".$posisi."'";
				$sql_where_1   = "a.id = '".$posisi."'";
			}
			else
			{
				$sql_where     = "c.atasan = '".$posisi."'";
				$sql_where_1   = "c.atasan = '".$posisi."'";
			} 

			$sql = "SELECT 	a.id_pegawai,
							c.id as id_posisi,
							b.nip,
							b.nama_pegawai,
							a.bulan,
							a.tahun,
							a.persentase_pemotongan,
							IF(a.audit_check_skp = 1,1,0) as flag_sudah_diperiksa
					FROM rpt_capaian_kinerja a
					LEFT JOIN mr_pegawai b ON b.id = a.id_pegawai
					LEFT JOIN mr_posisi c ON b.posisi = c.id
					WHERE ".$sql_where."
					AND b.status in (1,2)
					AND a.tahun = '".$this->year_system."'
					AND a.bulan = '".date('m')."'
					UNION 
						SELECT 	a.id,
								c.id as id_posisi,						
								a.nip,
								a.nama_pegawai,
								IFNULL(bulan,".date('m')."),
								IFNULL(tahun,".$this->year_system."),
								IFNULL(persentase_pemotongan, 5),
								IF(b.audit_check_skp = 1,1,0) as flag_sudah_diperiksa
						FROM mr_pegawai a
						LEFT JOIN rpt_capaian_kinerja b ON b.id_pegawai = a.`id`
						AND b.tahun = '".$this->year_system."'
						AND b.bulan = '".date('m')."'
						LEFT JOIN mr_posisi c ON a.posisi = c.id
						WHERE ".$sql_where_1."
						AND a.status in (1,2)
						AND a.`id` NOT IN (
									SELECT IFNULL(id_pegawai, 0)
									FROM `rpt_capaian_kinerja`
									WHERE bulan = '".date('m')."'
									AND tahun = '".$this->year_system."'
								)
					ORDER BY flag_sudah_diperiksa ASC, nama_pegawai ASC";
		}
		else
		{
			$sql = "SELECT DISTINCT a.*,
									a.id as `id_pegawai`,
									b.nama_posisi,
									b.kat_posisi as b_kat_posisi
					FROM mr_pegawai a
					JOIN mr_posisi b
					ON a.posisi = b.id
					WHERE b.atasan = '$posisi'
					AND a.status in (1,2)
					".$sql_where."
					ORDER BY a.nama_pegawai asc";
		}

		$query = $this->db->query($sql);
		return ($query->num_rows() > 0) ? $query->result() : array();		
	}

	public function get_peer($arg=NULL,$arg1=NULL)
	{
		$sql = "SELECT DISTINCT a.*,
								a.id as `id_pegawai`,
								b.nama_posisi,
								b.kat_posisi as b_kat_posisi
				FROM mr_pegawai a
				JOIN mr_posisi b
				ON a.posisi = b.id
				WHERE ".$arg[0]." = '".$arg[1]."'
				AND ".$arg1[0]." = '".$arg1[1]."'
				AND a.status = 1
				ORDER BY a.nama_pegawai asc";		
		$query = $this->db->query($sql);
		return ($query->num_rows() > 0) ? $query->result() : array();				
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
				$value_atasan = ($value_atasan*60)/100;
				$value_peer    = $value_peer*20/100;
				$value_bawahan = $value_bawahan*20/100;
			}
			$data = $value_atasan + $value_peer + $value_bawahan;
		}

    	return $data;
	}

	public function data_alphabet($param)
	{
		$data = "";
		switch ($param) {
			case '0':
				# code...
				$data = 'A';
				break;
			case '1':
				# code...
				$data = 'B';
				break;
			case '2':
				# code...
				$data = 'C';
				break;
			case '3':
				# code...
				$data = 'D';
				break;
			case '4':
				# code...
				$data = 'E';
				break;
			case '5':
				# code...
				$data = 'F';
				break;
			case '6':
				# code...
				$data = 'G';
				break;
			case '7':
				# code...
				$data = 'H';
				break;
			case '8':
				# code...
				$data = 'I';
				break;
			case '9':
				# code...
				$data = 'J';
				break;
			case '10':
				# code...
				$data = 'K';
				break;
			case '11':
				# code...
				$data = 'L';
				break;
			case '12':
				# code...
				$data = 'M';
				break;
			case '13':
				# code...
				$data = 'N';
				break;
			case '14':
				# code...
				$data = 'O';
				break;
			case '15':
				# code...
				$data = 'P';
				break;
			case '16':
				# code...
				$data = 'Q';
				break;
			case '17':
				# code...
				$data = 'R';
				break;
			case '18':
				# code...
				$data = 'S';
				break;
			case '19':
				# code...
				$data = 'T';
				break;
			case '20':
				# code...
				$data = 'U';
				break;
			case '21':
				# code...
				$data = 'V';
				break;
			case '22':
				# code...
				$data = 'W';
				break;
			case '23':
				# code...
				$data = 'X';
				break;
			case '24':
				# code...
				$data = 'Y';
				break;
			case '25':
				# code...
				$data = 'Z';
				break;
		}
		return $data;
	}

	public function nilai_tugas_tambahan($param)
	{
		# code...
		$value = "";
		if ($param <= 3) {
			# code...
			if($param == 0)
			{
				$value = 0;				
			}
			else
			{
				$value = 1;
			}			

		}
		elseif ($param <= 6) {
			# code...
			if($param == 0)
			{
				$value = 0;				
			}
			else
			{
				$value = 2;
			}			
		}
		elseif ($param > 6) {
			# code...
			if($param == 0)
			{
				$value = 0;				
			}
			else
			{
				$value = 3;
			}						
		}

		return $value;
	}

	public function data_bulan()
	{
		$data_bulan = array
					(
						1  => array('nama' => "Januari"),
						2  => array('nama' => "Februari"),
						3  => array('nama' => "Maret"),
						4  => array('nama' => "April"),
						5  => array('nama' => "Mei"),
						6  => array('nama' => "Juni"),
						7  => array('nama' => "Juli"),
						8  => array('nama' => "Agustus"),
						9  => array('nama' => "September"),
						10 => array('nama' => "Oktober"),
						11 => array('nama' => "November"),
						12 => array('nama' => "Desember")
					);

		return $data_bulan;
	}

	public function set_bulan($bulan)
	{
		$data_bulan = $this->data_bulan();
		$nama_bulan = "";

		for ($i=1; $i <= count($data_bulan); $i++) {
			# code...

			if ($bulan == $i) {
				# code...
				$nama_bulan = $data_bulan[$i]['nama'];
			}

		}

		return $nama_bulan;
	}

	public function who_is($id)
	{
		# code...
		$this->Globalrules->session_rule();
		$who_is = $this->mtrx->get_pegawai_id($id,'default');
		$i_am   = "";
		if ($who_is != 0) {
			# code...
			if ($who_is[0]->kat_posisi == 1) {
				# code...
				if ($who_is[0]->es4 == 0)
				{
					$i_am = "eselon 3";
				}

				if ($who_is[0]->es3 == 0)
				{
					if ($who_is[0]->es4 == 0) {
						# code...
						$i_am = "eselon 2";
					}					
				}

				if ($who_is[0]->es2 == 0)
				{
					if ($who_is[0]->es3 == 0) {
						# code...
						if ($who_is[0]->es4 == 0) {
							# code...
							$i_am = "eselon 1";								
						}
					}
				}				
			}
		}

		return $i_am;
	}	

	public function randomCode($length)
	{
	    $retVal = "";
	    while(strlen($retVal) < $length)
	    {
	        $nextChar = mt_rand(0, 61); // 10 digits + 26 uppercase + 26 lowercase = 62 chars
	        if(($nextChar >=10) && ($nextChar < 36)){ // uppercase letters
	            $nextChar -= 10; // bases the number at 0 instead of 10
	            $nextChar = chr($nextChar + 65); // ord('A') == 65
	        } else if($nextChar >= 36){ // lowercase letters
	            $nextChar -= 36; // bases the number at 0 instead of 36
	            $nextChar = chr($nextChar + 97); // ord('a') == 97
	        } else { // 0-9
	            $nextChar = chr($nextChar + 48); // ord('0') == 48
	        }
	        $retVal .= $nextChar;
	    }
	    return $retVal;
	}

	public function counter_datatable($arg,$table_destiny,$key_from,$key_to,$param_return,$param=NULL)
	{
		# code...
		$store = array();
		if ($param == NULL) {
			# code...
			if($arg->result_array() != array())
			{
				$store = $arg->result_array();
				for ($i=0; $i < count($arg->result_array()); $i++) { 
					# code...
					$get_data_es = $this->Allcrud->getData($table_destiny,array($key_to => $arg->result_array()[$i][$key_from]));
					if($get_data_es->result_array() != array())
					{					
						$store[$i][$param_return] = count($get_data_es->result_array());
					}
					else {	
						# code...
						$store[$i][$param_return] = 0;
					}
				}
			}			
		}
		
		return $store;
	}	

	public function get_summary_sikerja($data_sender)
	{
		# code...
		$sql_sync = '';
		if ($data_sender['flag_sync'] == '') {
			# code...
			$sql_sync = "AND a.flag_sync = '".$data_sender['flag_sync']."'";
		}
		$sql = "SELECT a.id_pegawai,
						a.id_posisi,
						SUM(a.menit_efektif) as menit_efektif,
						SUM(a.frekuensi_realisasi) as frekuensi_realisasi,
						SUM(a.tunjangan) as tunjangan,
						SUM(a.prosentase) as prosentase
				FROM tr_capaian_pekerjaan a
				WHERE a.tanggal_mulai LIKE '%".date('Y-m')."%'
				AND a.tanggal_selesai LIKE '%".date('Y-m')."%'
				AND a.status_pekerjaan = 1
				".$sql_sync."
				AND a.id_pegawai = '".$data_sender['id_pegawai']."'
				GROUP BY a.id_posisi";
				// print_r($sql);die();
		$query = $this->db->query($sql);
		return ($query->num_rows() > 0) ? $query->result() : 0;		
	}	

	public function get_history_golongan()
	{
		# code...
		$sql = "SELECT a.*,
						b.nama_pangkat
				FROM mr_history_golongan a
				JOIN mr_golongan b
				ON a.id_golongan = b.id
				WHERE a.id_pegawai = '".$this->session->userdata('sesUser')."'
				ORDER BY a.tmt DESC";
		$query = $this->db->query($sql);
		return ($query->num_rows() > 0) ? $query->result() : 0;
	}

	public function get_history_jabatan()
	{
		# code...
		$sql = "SELECT a.*,
						b.nama_posisi,
						c.nama_kat_posisi
				FROM (mr_masa_kerja a
				JOIN mr_posisi b ON a.id_posisi = b.id)
				JOIN mr_kat_posisi c ON b.kat_posisi = c.id
				WHERE a.id_pegawai = '".$this->session->userdata('sesUser')."'
				ORDER BY a.StartDate DESC";
		$query = $this->db->query($sql);
		return ($query->num_rows() > 0) ? $query->result() : 0;
	}	

	public function get_history_pendidikan()
	{
		# code...
		$sql = "SELECT a.*,
						b.kode,
						b.nama_pendidikan
				FROM mr_history_pendidikan a
				JOIN mr_pendidikan b ON a.id_pendidikan = b.id_pendidikan
				WHERE a.id_pegawai = '".$this->session->userdata('sesUser')."'
				ORDER BY a.tahun_lulus DESC";
		$query = $this->db->query($sql);
		return ($query->num_rows() > 0) ? $query->result() : 0;
	}
	
	public function get_history_diklat($id_diklat)
	{
		# code...
		$sql = "SELECT a.*
				FROM mr_history_diklat a
				WHERE a.id_pegawai = '".$this->session->userdata('sesUser')."'
				AND a.id_diklat = '".$id_diklat."'
				ORDER BY a.tgl_mulai DESC";
		$query = $this->db->query($sql);
		return ($query->num_rows() > 0) ? $query->result() : 0;
	}	

	public function sync_jabatan_simpeg_sikerja($arg=NULL)
	{
		# code...
		$sql = "SELECT a.id,
						IF(a.kat_posisi = 2 || a.kat_posisi = 4,
							CONCAT(a.nama_posisi, ' PADA ' , es4.nama_eselon4,' ' , es3.nama_eselon3,' ' , es2.nama_eselon2, ' ' , es1.nama_eselon1),
							IF(a.eselon2 = 0,
									CONCAT(a.nama_posisi, ' PADA KEMENTERIAN DALAM NEGERI'),
								IF(a.eselon3 = 0,
									CONCAT(a.nama_posisi, ' PADA ' , es1.nama_eselon1),
									IF(a.eselon4 = 0,
											CONCAT(a.nama_posisi, ' PADA ' , es2.nama_eselon2, ' ' , es1.nama_eselon1),
											CONCAT(a.nama_posisi, ' PADA ' , es3.nama_eselon3,' ' , es2.nama_eselon2, ' ' , es1.nama_eselon1)
									)
								)
							)
						) as posisi
				FROM mr_posisi a
				LEFT JOIN mr_eselon1 es1 on a.eselon1 = es1.id_es1
				LEFT JOIN mr_eselon2 es2 on a.eselon2 = es2.id_es2
				LEFT JOIN mr_eselon3 es3 on a.eselon3 = es3.id_es3
				LEFT JOIN mr_eselon4 es4 on a.eselon4 = es4.id_es4
				WHERE IF(a.kat_posisi = 2 || a.kat_posisi = 4,
							CONCAT(a.nama_posisi, ' PADA ' , es4.nama_eselon4,' ' , es3.nama_eselon3,' ' , es2.nama_eselon2, ' ' , es1.nama_eselon1),
							IF(a.eselon2 = 0,
									CONCAT(a.nama_posisi, ' PADA KEMENTERIAN DALAM NEGERI'),
								IF(a.eselon3 = 0,
									CONCAT(a.nama_posisi, ' PADA ' , es1.nama_eselon1),
									IF(a.eselon4 = 0,
											CONCAT(a.nama_posisi, ' PADA ' , es2.nama_eselon2, ' ' , es1.nama_eselon1),
											CONCAT(a.nama_posisi, ' PADA ' , es3.nama_eselon3,' ' , es2.nama_eselon2, ' ' , es1.nama_eselon1)
									)
								)
							)
						) LIKE '%".$arg."%'";
		$query = $this->db->query($sql);
		return ($query->num_rows() > 0) ? $query->result() : 0;		
	}

	public function trigger_skp_tahunan($id_pegawai)
	{
		# code...

		$get_evaluator = $this->mskp->get_data_evaluator($id_pegawai,$this->year_system);
		if ($get_evaluator != 0) {
			# code...
			for ($i=0; $i < count($get_evaluator); $i++) { 
				# code...
				if ($get_evaluator[$i]->id_posisi_pegawai_penilai == NULL) {
					# code...
					$get_posisi = $this->mskp->get_request_history($get_evaluator[$i]->id_pegawai_penilai,$this->year_system,'on');					
					if ($get_posisi != 0) {
						# code...
						if ($get_evaluator[$i]->id_posisi_pegawai_penilai == NULL || $get_evaluator[$i]->id_posisi_pegawai_penilai == '') {
							# code...
							$data = array
							(
								'id_posisi_pegawai_penilai' => $get_posisi[0]->posisi
							);
							$res_data    = $this->Allcrud->editData('mr_skp_penilaian_prilaku',$data,array('id'=>$get_evaluator[$i]->id));								
						}									
					}						
				}
			}
		}

		$get_posisi = $this->mskp->get_request_history($id_pegawai,$this->year_system,'on');
		if ($get_posisi != 0) {
			# code...

			$check_data = $this->Allcrud->getData('mr_skp_penilaian_prilaku',array('id_pegawai'=>$id_pegawai,'tahun'=>$this->year_system))->result_array();					
			if ($check_data != array()) {
				# code...
				for ($i=0; $i < count($check_data); $i++) { 
					# code...
					if ($check_data[$i]['id_posisi_pegawai'] == null || $check_data[$i]['id_posisi_pegawai'] == '') {
						# code...
						$data = array
						(
							'id_posisi_pegawai' => $get_posisi[0]->posisi
						);
						$res_data    = $this->Allcrud->editData('mr_skp_penilaian_prilaku',$data,array('id_pegawai'=>$id_pegawai,'tahun'=>$this->year_system));								
					}
				}
			}					

			$data_s = array();
			for ($i=0; $i < count($get_posisi); $i++) { 
				# code...					
				$data_s[$i] = $this->Globalrules->data_summary_skp_pegawai($id_pegawai,$get_posisi[$i]->posisi,$this->year_system);						
				$data_parameter = array(
					'id_pegawai'					=> $id_pegawai,
					'id_posisi'						=> $get_posisi[$i]->posisi,
					'tahun'							=> $this->year_system
				);
				$check_data = $this->Allcrud->getData('rpt_skp_sasaran_kerja',$data_parameter)->result_array();						
				if ($check_data == array()) {
					# code...
					$summary_skp = array(
						'id_pegawai'					=> $id_pegawai,
						'id_posisi'						=> $get_posisi[$i]->posisi,
						'tahun'							=> $this->year_system,
						'nilai_capaian_skp'             => $data_s[$i]['summary_skp']['nilai_capaian_skp'],
						'total_aspek'                   => $data_s[$i]['summary_skp']['total_aspek'],
						'total'                         => $data_s[$i]['summary_skp']['total'],
						'nilai_sasaran_kinerja_pegawai' => $data_s[$i]['summary_skp']['nilai_sasaran_kinerja_pegawai']
					);							
					$this->Allcrud->addData('rpt_skp_sasaran_kerja',$summary_skp);							
				}
				else
				{
					$summary_skp = array(
						'nilai_capaian_skp'             => $data_s[$i]['summary_skp']['nilai_capaian_skp'],
						'total_aspek'                   => $data_s[$i]['summary_skp']['total_aspek'],
						'total'                         => $data_s[$i]['summary_skp']['total'],
						'nilai_sasaran_kinerja_pegawai' => $data_s[$i]['summary_skp']['nilai_sasaran_kinerja_pegawai']
					);														
					$this->Allcrud->editData('rpt_skp_sasaran_kerja',$summary_skp,$data_parameter);										
				}

				$check_data = $this->Allcrud->getData('rpt_skp_prilaku_skp',$data_parameter)->result_array();						
				if ($check_data == array()) {
					# code...
					$summary_prilaku_skp = array(
						'id_pegawai'					=> $id_pegawai,
						'id_posisi'						=> $get_posisi[$i]->posisi,
						'tahun'							=> $this->year_system,
						'integritas'             		=> $data_s[$i]['summary_prilaku_skp']['integritas'],
						'orientasi_pelayanan'    		=> $data_s[$i]['summary_prilaku_skp']['orientasi_pelayanan'],
						'komitmen'               		=> $data_s[$i]['summary_prilaku_skp']['komitmen'],
						'disiplin'               		=> $data_s[$i]['summary_prilaku_skp']['disiplin'],
						'kerjasama'              		=> $data_s[$i]['summary_prilaku_skp']['kerjasama'],
						'kepemimpinan'           		=> $data_s[$i]['summary_prilaku_skp']['kepemimpinan'],
						'status'                 		=> $data_s[$i]['summary_prilaku_skp']['status'],
						'jumlah'                 		=> $data_s[$i]['summary_prilaku_skp']['jumlah'],
						// 'rata_rata'              		=> $data_s[$i]['summary_prilaku_skp']['rata_rata'],
						'nilai_prilaku_kerja'    		=> $data_s[$i]['summary_prilaku_skp']['nilai_prilaku_kerja']
					);						
					// print_r($summary_prilaku_skp);die();	
					$this->Allcrud->addData('rpt_skp_prilaku_skp',$summary_prilaku_skp);							
				}
				else
				{
					$summary_prilaku_skp = array(
						'integritas'             		=> $data_s[$i]['summary_prilaku_skp']['integritas'],
						'orientasi_pelayanan'    		=> $data_s[$i]['summary_prilaku_skp']['orientasi_pelayanan'],
						'komitmen'               		=> $data_s[$i]['summary_prilaku_skp']['komitmen'],
						'disiplin'               		=> $data_s[$i]['summary_prilaku_skp']['disiplin'],
						'kerjasama'              		=> $data_s[$i]['summary_prilaku_skp']['kerjasama'],
						'kepemimpinan'           		=> $data_s[$i]['summary_prilaku_skp']['kepemimpinan'],
						'status'                 		=> $data_s[$i]['summary_prilaku_skp']['status'],
						'jumlah'                 		=> $data_s[$i]['summary_prilaku_skp']['jumlah'],
						'rata_rata'              		=> $data_s[$i]['summary_prilaku_skp']['rata_rata'],
						'nilai_prilaku_kerja'    		=> $data_s[$i]['summary_prilaku_skp']['nilai_prilaku_kerja']
					);														
					// $this->Allcrud->editData('rpt_skp_prilaku_skp',$summary_prilaku_skp,$data_parameter);										
				}												
			}			
		}		
	}
	
	public function trigger_skp_tahunan_prev($id_pegawai)
	{
		# code...

		$get_evaluator = $this->mskp->get_data_evaluator($id_pegawai,$this->prev_year_system);
		if ($get_evaluator != 0) {
			# code...
			for ($i=0; $i < count($get_evaluator); $i++) { 
				# code...
				if ($get_evaluator[$i]->id_posisi_pegawai_penilai == NULL) {
					# code...
					$get_posisi = $this->mskp->get_request_history($get_evaluator[$i]->id_pegawai_penilai,$this->prev_year_system,'on');					
					if ($get_posisi != 0) {
						# code...
						if ($get_evaluator[$i]->id_posisi_pegawai_penilai == NULL || $get_evaluator[$i]->id_posisi_pegawai_penilai == '') {
							# code...
							$data = array
							(
								'id_posisi_pegawai_penilai' => $get_posisi[0]->posisi
							);
							$res_data    = $this->Allcrud->editData('mr_skp_penilaian_prilaku',$data,array('id'=>$get_evaluator[$i]->id));								
						}									
					}						
				}
			}
		}

		$get_posisi = $this->mskp->get_request_history($id_pegawai,$this->prev_year_system,'on');
		if ($get_posisi != 0) {
			# code...

			$check_data = $this->Allcrud->getData('mr_skp_penilaian_prilaku',array('id_pegawai'=>$id_pegawai,'tahun'=>$this->prev_year_system))->result_array();					
			if ($check_data != array()) {
				# code...
				for ($i=0; $i < count($check_data); $i++) { 
					# code...
					if ($check_data[$i]['id_posisi_pegawai'] == null || $check_data[$i]['id_posisi_pegawai'] == '') {
						# code...
						$data = array
						(
							'id_posisi_pegawai' => $get_posisi[0]->posisi
						);
						$res_data    = $this->Allcrud->editData('mr_skp_penilaian_prilaku',$data,array('id_pegawai'=>$id_pegawai,'tahun'=>$this->prev_year_system));								
					}
				}
			}					

			$data_s = array();
			for ($i=0; $i < count($get_posisi); $i++) { 
				# code...					
				$data_s[$i] = $this->Globalrules->data_summary_skp_pegawai($id_pegawai,$get_posisi[$i]->posisi,$this->prev_year_system);						
				$data_parameter = array(
					'id_pegawai'					=> $id_pegawai,
					'id_posisi'						=> $get_posisi[$i]->posisi,
					'tahun'							=> $this->prev_year_system
				);
				$check_data = $this->Allcrud->getData('rpt_skp_sasaran_kerja',$data_parameter)->result_array();						
				if ($check_data == array()) {
					# code...
					$summary_skp = array(
						'id_pegawai'					=> $id_pegawai,
						'id_posisi'						=> $get_posisi[$i]->posisi,
						'tahun'							=> $this->prev_year_system,
						'nilai_capaian_skp'             => $data_s[$i]['summary_skp']['nilai_capaian_skp'],
						'total_aspek'                   => $data_s[$i]['summary_skp']['total_aspek'],
						'total'                         => $data_s[$i]['summary_skp']['total'],
						'nilai_sasaran_kinerja_pegawai' => $data_s[$i]['summary_skp']['nilai_sasaran_kinerja_pegawai']
					);							
					$this->Allcrud->addData('rpt_skp_sasaran_kerja',$summary_skp);							
				}
				else
				{
					$summary_skp = array(
						'nilai_capaian_skp'             => $data_s[$i]['summary_skp']['nilai_capaian_skp'],
						'total_aspek'                   => $data_s[$i]['summary_skp']['total_aspek'],
						'total'                         => $data_s[$i]['summary_skp']['total'],
						'nilai_sasaran_kinerja_pegawai' => $data_s[$i]['summary_skp']['nilai_sasaran_kinerja_pegawai']
					);														
					$this->Allcrud->editData('rpt_skp_sasaran_kerja',$summary_skp,$data_parameter);										
				}

				$check_data = $this->Allcrud->getData('rpt_skp_prilaku_skp',$data_parameter)->result_array();						
				if ($check_data == array()) {
					# code...
					$summary_prilaku_skp = array(
						'id_pegawai'					=> $id_pegawai,
						'id_posisi'						=> $get_posisi[$i]->posisi,
						'tahun'							=> $this->prev_year_system,
						'integritas'             		=> $data_s[$i]['summary_prilaku_skp']['integritas'],
						'orientasi_pelayanan'    		=> $data_s[$i]['summary_prilaku_skp']['orientasi_pelayanan'],
						'komitmen'               		=> $data_s[$i]['summary_prilaku_skp']['komitmen'],
						'disiplin'               		=> $data_s[$i]['summary_prilaku_skp']['disiplin'],
						'kerjasama'              		=> $data_s[$i]['summary_prilaku_skp']['kerjasama'],
						'kepemimpinan'           		=> $data_s[$i]['summary_prilaku_skp']['kepemimpinan'],
						'status'                 		=> $data_s[$i]['summary_prilaku_skp']['status'],
						'jumlah'                 		=> $data_s[$i]['summary_prilaku_skp']['jumlah'],
						// 'rata_rata'              		=> $data_s[$i]['summary_prilaku_skp']['rata_rata'],
						'nilai_prilaku_kerja'    		=> $data_s[$i]['summary_prilaku_skp']['nilai_prilaku_kerja']
					);							
					$this->Allcrud->addData('rpt_skp_prilaku_skp',$summary_prilaku_skp);							
				}
				else
				{
					$summary_prilaku_skp = array(
						'integritas'             		=> $data_s[$i]['summary_prilaku_skp']['integritas'],
						'orientasi_pelayanan'    		=> $data_s[$i]['summary_prilaku_skp']['orientasi_pelayanan'],
						'komitmen'               		=> $data_s[$i]['summary_prilaku_skp']['komitmen'],
						'disiplin'               		=> $data_s[$i]['summary_prilaku_skp']['disiplin'],
						'kerjasama'              		=> $data_s[$i]['summary_prilaku_skp']['kerjasama'],
						'kepemimpinan'           		=> $data_s[$i]['summary_prilaku_skp']['kepemimpinan'],
						'status'                 		=> $data_s[$i]['summary_prilaku_skp']['status'],
						'jumlah'                 		=> $data_s[$i]['summary_prilaku_skp']['jumlah'],
						// 'rata_rata'              		=> $data_s[$i]['summary_prilaku_skp']['rata_rata'],
						'nilai_prilaku_kerja'    		=> $data_s[$i]['summary_prilaku_skp']['nilai_prilaku_kerja']
					);														
					$this->Allcrud->editData('rpt_skp_prilaku_skp',$summary_prilaku_skp,$data_parameter);										
				}												
			}			
		}		
	}
}
