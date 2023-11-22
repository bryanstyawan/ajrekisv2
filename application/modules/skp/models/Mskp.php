<?php
class Mskp extends CI_Model
{
	public function __construct () {
		parent::__construct();
	}

	public function get_data_skp_pegawai($id_pegawai,$id_posisi=NULL,$tahun,$param_status,$priority=NULL)
	{
		# code...
		$query_1 = "";
		$query_2 = "";

		if ($id_posisi == NULL) {
			# code...
			$query_2 = '';
		}
		else
		{
			$query_2 = "AND a.id_posisi = '".$id_posisi."'";
		}
		$SELECT = "";
		if ($param_status == 10) {
			# code...
			$query_1 = "";
		}
		elseif ($param_status == 11) {
			# code...
			$query_1 = "AND (a.status = '0' OR b.edit_status = '3')";
		}
		elseif ($param_status == 'PK') {
			# code...
			$query_1 = "AND a.PK = '1'";
		}
		elseif ($param_status == 'non_PK') {
			# code...
			$query_1 = "AND a.PK = '0'";
		}
		elseif ($param_status == 'none') {
			# code...
			if ($priority != NULL) {
				# code...
				if ($priority != 'realisasi') {
					# code...
					$query_1 = "AND a.audit_priority = '".$priority."'";
				}
			}
		}
		elseif ($param_status == 'approve') {
			# code...
					$query_1 = "AND a.status = '".$priority."'";
		}
		else
		{
			if ($priority == 'realisasi') {
				# code...
				$SELECT = "	,COALESCE (
								(
									SELECT sum(cc.frekuensi_realisasi)
									FROM tr_capaian_pekerjaan cc
									WHERE cc.id_uraian_tugas = a.skp_id
									AND cc.status_pekerjaan = '1'
								),'0'
							) AS `realisasi_kuantitas`,
							COALESCE (
								(
									SELECT dd.tanggal_mulai
									FROM tr_capaian_pekerjaan dd
									WHERE dd.id_pegawai = a.id_pegawai
									AND dd.id_uraian_tugas = a.skp_id
									ORDER BY dd.tanggal_mulai ASC
									LIMIT 1
								),'0'
							) AS `realisasi_awal_tanggal`,
							COALESCE (
								(
									SELECT dd.tanggal_selesai
									FROM tr_capaian_pekerjaan dd
									WHERE dd.id_pegawai = a.id_pegawai
									AND dd.id_uraian_tugas = a.skp_id
									ORDER BY dd.tanggal_selesai DESC
									LIMIT 1
								),'0'
							) AS `realisasi_akhir_tanggal`,
							COALESCE(
								round(
									(
										TIMESTAMPDIFF(
											MONTH,
											COALESCE (
												(
													SELECT dd.tanggal_mulai
													FROM tr_capaian_pekerjaan dd
													WHERE dd.id_pegawai = a.id_pegawai
													AND dd.id_uraian_tugas = a.skp_id
													ORDER BY dd.tanggal_mulai ASC
													LIMIT 1
												),'0'
											),
											COALESCE (
												(
													SELECT dd.tanggal_selesai
													FROM tr_capaian_pekerjaan dd
													WHERE dd.id_pegawai = a.id_pegawai
													AND dd.id_uraian_tugas = a.skp_id
													ORDER BY dd.tanggal_selesai DESC
													LIMIT 1
												),'0'
											)
										) +
										DATEDIFF(
											COALESCE (
												(
													SELECT dd.tanggal_selesai
													FROM tr_capaian_pekerjaan dd
													WHERE dd.id_pegawai = a.id_pegawai
													AND dd.id_uraian_tugas = a.skp_id
													ORDER BY dd.tanggal_selesai DESC
													LIMIT 1
												),'0'
											),
											COALESCE (
												(
													SELECT dd.tanggal_mulai
													FROM tr_capaian_pekerjaan dd
													WHERE dd.id_pegawai = a.id_pegawai
													AND dd.id_uraian_tugas = a.skp_id
													ORDER BY dd.tanggal_mulai ASC
													LIMIT 1
												),'0'
											) + INTERVAL
											TIMESTAMPDIFF(
												MONTH,
												COALESCE (
													(
														SELECT dd.tanggal_mulai
														FROM tr_capaian_pekerjaan dd
														WHERE dd.id_pegawai = a.id_pegawai
														AND dd.id_uraian_tugas = a.skp_id
														ORDER BY dd.tanggal_mulai ASC
														LIMIT 1
													),'0'
												),
												COALESCE (
													(
														SELECT dd.tanggal_selesai
														FROM tr_capaian_pekerjaan dd
														WHERE dd.id_pegawai = a.id_pegawai
														AND dd.id_uraian_tugas = a.skp_id
														ORDER BY dd.tanggal_selesai DESC
														LIMIT 1
													),'0'
												)
											) MONTH
										)
										/
										DATEDIFF(
											COALESCE (
												(
													SELECT dd.tanggal_mulai
													FROM tr_capaian_pekerjaan dd
													WHERE dd.id_pegawai = a.id_pegawai
													AND dd.id_uraian_tugas = a.skp_id
													ORDER BY dd.tanggal_mulai ASC
													LIMIT 1
												),'0'
											) + INTERVAL
											TIMESTAMPDIFF(
												MONTH,
												COALESCE (
													(
														SELECT dd.tanggal_mulai
														FROM tr_capaian_pekerjaan dd
														WHERE dd.id_pegawai = a.id_pegawai
														AND dd.id_uraian_tugas = a.skp_id
														ORDER BY dd.tanggal_mulai ASC
														LIMIT 1
													),'0'
												),
												COALESCE (
													(
														SELECT dd.tanggal_selesai
														FROM tr_capaian_pekerjaan dd
														WHERE dd.id_pegawai = a.id_pegawai
														AND dd.id_uraian_tugas = a.skp_id
														ORDER BY dd.tanggal_selesai DESC
														LIMIT 1
													),'0'
												)
											) + 1 MONTH,
											COALESCE (
												(
												SELECT dd.tanggal_mulai
												FROM tr_capaian_pekerjaan dd
												WHERE dd.id_pegawai = a.id_pegawai
												AND dd.id_uraian_tugas = a.skp_id
												ORDER BY dd.tanggal_mulai ASC
												LIMIT 1
												),'0'
											) + INTERVAL
											TIMESTAMPDIFF(
												MONTH,
												COALESCE (
													(
														SELECT dd.tanggal_mulai
														FROM tr_capaian_pekerjaan dd
														WHERE dd.id_pegawai = a.id_pegawai
														AND dd.id_uraian_tugas = a.skp_id
														ORDER BY dd.tanggal_mulai ASC
														LIMIT 1
													),'0'
												),
												COALESCE (
													(
														SELECT dd.tanggal_selesai
														FROM tr_capaian_pekerjaan dd
														WHERE dd.id_pegawai = a.id_pegawai
														AND dd.id_uraian_tugas = a.skp_id
														ORDER BY dd.tanggal_selesai DESC
														LIMIT 1
													),'0'
												)
											) MONTH
										)
									),2
								),0
							) AS realisasi_waktu";
			}
			$query_1 = "AND a.status = '".$param_status."'";
		}


		$sql     = "SELECT a.*,
							b.*,
							COALESCE(c.nama,'-') as `nama_jenis_skp`,
							COALESCE(
								(
									SELECT aa.nama
									FROM mr_skp_jenis aa
									WHERE aa.id = b.edit_jenis_skp
								),'-'
							) as `edit_nama_jenis_skp`,
							COALESCE(
								(
									SELECT
										bb.nama
									FROM
										mr_skp_satuan bb
									WHERE
										bb.id = b.edit_target_output
								),'-'
							) AS `edit_target_output_name`,
							COALESCE(
								(
									SELECT
										cc.kegiatan
									FROM
										mr_skp_master cc
									WHERE
										cc.id_skp = a.id_skp_master
								),'-'
							) AS `kegiatan_skp`,
							COALESCE(
								(
									SELECT
										cc.status
									FROM
										mr_skp_master cc
									WHERE
										cc.id_skp = a.id_skp_master
								),'-'
							) AS `kegiatan_skp_status`,							
							COALESCE(
								(
									SELECT
										jfu.uraian_tugas
									FROM
									mr_jabatan_fungsional_umum_uraian_tugas jfu
									WHERE
										jfu.id = a.id_skp_jfu
								),'-'
							) AS `kegiatan_skp_jfu`,
							COALESCE(
								(
									SELECT
										jfu.status
									FROM
									mr_jabatan_fungsional_umum_uraian_tugas jfu
									WHERE
										jfu.id = a.id_skp_jfu
								),'-'
							) AS `kegiatan_skp_jfu_status`,							
							COALESCE(
								(
									SELECT
										jft.uraian_tugas
									FROM
									mr_jabatan_fungsional_tertentu_uraian_tugas jft
									WHERE
										jft.id = a.id_skp_jft
								),'-'
							) AS `kegiatan_skp_jft`,	
							COALESCE(
								(
									SELECT
										jft.status
									FROM
									mr_jabatan_fungsional_tertentu_uraian_tugas jft
									WHERE
										jft.id = a.id_skp_jft
								),'-'
							) AS `kegiatan_skp_jft_status`,																					
							COALESCE(d.nama,'-') as `target_output_name`
							".$SELECT."
					FROM mr_skp_pegawai a
					LEFT OUTER JOIN mr_skp_pegawai_temp b
					ON a.skp_id = b.edit_skp_id
					LEFT OUTER JOIN mr_skp_jenis c
					ON a.jenis_skp = c.id
					LEFT OUTER JOIN mr_skp_satuan d
					ON a.target_output = d.id
					WHERE (a.tahun = ".$tahun.")
					AND a.id_pegawai = '".$id_pegawai."'
					".$query_2."					
					AND a.status <> '99'
					".$query_1."
					ORDER BY a.PK DESC, a.audit_time DESC, a.audit_priority ASC";
		// print_r($sql);die();
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			$sql     = "SELECT a.*,
							b.*,
							COALESCE(c.nama,'-') as `nama_jenis_skp`,
							COALESCE(
								(
									SELECT aa.nama
									FROM mr_skp_jenis aa
									WHERE aa.id = b.edit_jenis_skp
								),'-'
							) as `edit_nama_jenis_skp`,
							COALESCE(
								(
									SELECT
										bb.nama
									FROM
										mr_skp_satuan bb
									WHERE
										bb.id = b.edit_target_output
								),'-'
							) AS `edit_target_output_name`,
							COALESCE(
								(
									SELECT
										cc.kegiatan
									FROM
										mr_skp_master cc
									WHERE
										cc.id_skp = a.id_skp_master
								),'-'
							) AS `kegiatan_skp`,
							COALESCE(
								(
									SELECT
										cc.status
									FROM
										mr_skp_master cc
									WHERE
										cc.id_skp = a.id_skp_master
								),'-'
							) AS `kegiatan_skp_status`,							
							COALESCE(
								(
									SELECT
										jfu.uraian_tugas
									FROM
									mr_jabatan_fungsional_umum_uraian_tugas jfu
									WHERE
										jfu.id = a.id_skp_jfu
								),'-'
							) AS `kegiatan_skp_jfu`,
							COALESCE(
								(
									SELECT
										jfu.status
									FROM
									mr_jabatan_fungsional_umum_uraian_tugas jfu
									WHERE
										jfu.id = a.id_skp_jfu
								),'-'
							) AS `kegiatan_skp_jfu_status`,							
							COALESCE(
								(
									SELECT
										jft.uraian_tugas
									FROM
									mr_jabatan_fungsional_tertentu_uraian_tugas jft
									WHERE
										jft.id = a.id_skp_jft
								),'-'
							) AS `kegiatan_skp_jft`,	
							COALESCE(
								(
									SELECT
										jft.status
									FROM
									mr_jabatan_fungsional_tertentu_uraian_tugas jft
									WHERE
										jft.id = a.id_skp_jft
								),'-'
							) AS `kegiatan_skp_jft_status`,																					
							COALESCE(d.nama,'-') as `target_output_name`
							".$SELECT."
					FROM mr_skp_pegawai a
					LEFT OUTER JOIN mr_skp_pegawai_temp b
					ON a.skp_id = b.edit_skp_id
					LEFT OUTER JOIN mr_skp_jenis c
					ON a.jenis_skp = c.id
					LEFT OUTER JOIN mr_skp_satuan d
					ON a.target_output = d.id
					WHERE a.tahun = 2022
					AND a.id_pegawai = '".$id_pegawai."'
					".$query_2."					
					AND a.status <> '99'
					".$query_1."
					ORDER BY a.PK DESC, a.audit_time DESC, a.audit_priority ASC";
		// print_r($sql);die();
		$query2 = $this->db->query($sql);
			//return 0;
			if($query2->num_rows() > 0)
			{
				return $query2->result();
			}else
			{
				//return 0;
						$sql     = "SELECT a.*,
									b.*,
									COALESCE(c.nama,'-') as `nama_jenis_skp`,
									COALESCE(
										(
											SELECT aa.nama
											FROM mr_skp_jenis aa
											WHERE aa.id = b.edit_jenis_skp
										),'-'
									) as `edit_nama_jenis_skp`,
									COALESCE(
										(
											SELECT
												bb.nama
											FROM
												mr_skp_satuan bb
											WHERE
												bb.id = b.edit_target_output
										),'-'
									) AS `edit_target_output_name`,
									COALESCE(
										(
											SELECT
												cc.kegiatan
											FROM
												mr_skp_master cc
											WHERE
												cc.id_skp = a.id_skp_master
										),'-'
									) AS `kegiatan_skp`,
									COALESCE(
										(
											SELECT
												cc.status
											FROM
												mr_skp_master cc
											WHERE
												cc.id_skp = a.id_skp_master
										),'-'
									) AS `kegiatan_skp_status`,							
									COALESCE(
										(
											SELECT
												jfu.uraian_tugas
											FROM
											mr_jabatan_fungsional_umum_uraian_tugas jfu
											WHERE
												jfu.id = a.id_skp_jfu
										),'-'
									) AS `kegiatan_skp_jfu`,
									COALESCE(
										(
											SELECT
												jfu.status
											FROM
											mr_jabatan_fungsional_umum_uraian_tugas jfu
											WHERE
												jfu.id = a.id_skp_jfu
										),'-'
									) AS `kegiatan_skp_jfu_status`,							
									COALESCE(
										(
											SELECT
												jft.uraian_tugas
											FROM
											mr_jabatan_fungsional_tertentu_uraian_tugas jft
											WHERE
												jft.id = a.id_skp_jft
										),'-'
									) AS `kegiatan_skp_jft`,	
									COALESCE(
										(
											SELECT
												jft.status
											FROM
											mr_jabatan_fungsional_tertentu_uraian_tugas jft
											WHERE
												jft.id = a.id_skp_jft
										),'-'
									) AS `kegiatan_skp_jft_status`,																					
									COALESCE(d.nama,'-') as `target_output_name`
									".$SELECT."
							FROM mr_skp_pegawai a
							LEFT OUTER JOIN mr_skp_pegawai_temp b
							ON a.skp_id = b.edit_skp_id
							LEFT OUTER JOIN mr_skp_jenis c
							ON a.jenis_skp = c.id
							LEFT OUTER JOIN mr_skp_satuan d
							ON a.target_output = d.id
							WHERE a.tahun = 2021
							AND a.id_pegawai = '".$id_pegawai."'
							".$query_2."					
							AND a.status <> '99'
							".$query_1."
							ORDER BY a.PK DESC, a.audit_time DESC, a.audit_priority ASC";
				// print_r($sql);die();
				$query3 = $this->db->query($sql);
					//return 0;
					if($query3->num_rows() > 0)
					{
						return $query3->result();
					}else
					{
						return 0;
					}
			}
		}
	}

	public function get_persentase_target_realisasi($year)
	{
		// code...
		$sql = "SELECT  SUM(a.target_qty) as `total_target_kuantitas`,
						SUM(COALESCE((SELECT
										SUM(cc.frekuensi_realisasi)
									FROM
										tr_capaian_pekerjaan cc
									WHERE
										cc.id_uraian_tugas = a.skp_id
											AND cc.status_pekerjaan = '1'),
								'0')) AS `total_realisasi_kuantitas`,
						ROUND((SUM(COALESCE((SELECT
										SUM(cc.frekuensi_realisasi)
									FROM
										tr_capaian_pekerjaan cc
									WHERE
										cc.id_uraian_tugas = a.skp_id
											AND cc.status_pekerjaan = '1'),
								'0'))/SUM(a.target_qty) * 100),2) AS `persentase`
				FROM mr_skp_pegawai a
				LEFT OUTER JOIN mr_skp_pegawai_temp b ON a.skp_id = b.edit_skp_id
				LEFT OUTER JOIN mr_skp_jenis c ON a.jenis_skp = c.id
				LEFT OUTER JOIN mr_skp_satuan d ON a.target_output = d.id
				WHERE a.tahun = '".$year."'
				AND a.id_pegawai = '".$this->session->userdata('sesUser')."'
				AND a.id_posisi = '".$this->session->userdata('sesPosisi')."'				
				AND a.status <> '99'
				AND a.status = '1'
				GROUP BY a.id_pegawai";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0)
			{
				return $query->result()[0];
			}
			else
			{
				return (object)array(
						'total_target_kuantitas'    => 0,
						'total_realisasi_kuantitas' => 0,
						'persentase'                => 0
					);
			}
	}

	public function get_data_skp_pegawai_id($id)
	{
		# code...
		$sql = "SELECT a.*,
						   b.*,
							COALESCE(c.nama,'-') as `nama_jenis_skp`,
							COALESCE(
								(
									SELECT aa.nama
									FROM mr_skp_jenis aa
									WHERE aa.id = b.edit_jenis_skp
								),'-'
							) as `edit_nama_jenis_skp`,
							COALESCE(
								(
									SELECT
										bb.nama
									FROM
										mr_skp_satuan bb
									WHERE
										bb.id = b.edit_target_output
								),'-'
							) AS `edit_target_output_name`,
							COALESCE(
								(
									SELECT
										cc.kegiatan
									FROM
										mr_skp_master cc
									WHERE
										cc.id_skp = a.id_skp_master
								),'-'
							) AS `kegiatan_skp`,
							COALESCE(
								(
									SELECT
										jfu.uraian_tugas
									FROM
									mr_jabatan_fungsional_umum_uraian_tugas jfu
									WHERE
										jfu.id = a.id_skp_jfu
								),'-'
							) AS `kegiatan_skp_jfu`,
							COALESCE(
								(
									SELECT
										jft.uraian_tugas
									FROM
									mr_jabatan_fungsional_tertentu_uraian_tugas jft
									WHERE
										jft.id = a.id_skp_jft
								),'-'
							) AS `kegiatan_skp_jft`,														
							COALESCE(d.nama,'-') as `target_output_name`,
							COALESCE(
								(
									SELECT SUM(dd.frekuensi_realisasi)
									FROM tr_capaian_pekerjaan dd
									WHERE a.skp_id = dd.id_uraian_tugas
									AND dd.status_pekerjaan = 1
									and dd.id_pegawai = a.id_pegawai
								),0
							) as `realisasi_kuantitas`
				FROM mr_skp_pegawai a
				LEFT OUTER JOIN mr_skp_pegawai_temp b
				ON a.skp_id = b.edit_skp_id
				LEFT OUTER JOIN mr_skp_jenis c
				ON a.jenis_skp = c.id
				LEFT OUTER JOIN mr_skp_satuan d
				ON a.target_output = d.id
				WHERE a.skp_id = '".$id."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result()[0];
		}
		else
		{
			return 0;
		}
	}

	public function get_data_skp_pegawai_edit($id)
	{
		# code...
		$sql = "SELECT a.*
				FROM mr_skp_pegawai_temp a
				WHERE a.edit_skp_id = '".$id."'
				ORDER BY a.id DESC
				LIMIT 1";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result()[0];
		}
		else
		{
			return false;
		}
	}

	public function get_data_pegawai_by_posisi_ex($id_user,$id_posisi)
	{
		# code...
		$sql = "SELECT a.*
				FROM mr_pegawai a
				WHERE a.id <> '".$id_user."'
				AND a.posisi = '".$id_posisi."'";
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

	public function get_member($posisi)
	{
		# code...
		$sql = "SELECT a.*,
						b.nama_posisi
				FROM mr_pegawai a
				JOIN mr_posisi b
				ON a.posisi = b.id
				WHERE b.atasan = '".$posisi."'
				AND a.status in (1,2) ";
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

	public function check_pekerjaan_pegawai($id_pegawai,$kegiatan,$tahun,$posisi)
	{
		# code...
		$sql = "SELECT a.*
				FROM mr_skp_pegawai a
				WHERE a.id_pegawai  = '".$id_pegawai."'
				AND a.id_posisi = '".$posisi."'
				AND a.id_skp_master = '".$kegiatan."'
				AND a.tahun = '".$tahun."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result()[0];
		}
		else
		{
			return false;
		}
	}

	public function check_pekerjaan_pegawai_jfu($id_pegawai,$kegiatan,$tahun,$posisi)
	{
		# code...
		$sql = "SELECT a.*
				FROM mr_skp_pegawai a
				WHERE a.id_pegawai  = '".$id_pegawai."'
				AND a.tahun         = '".$tahun."'
				AND a.id_posisi         = '".$posisi."'				
				AND a.id_skp_jfu = '".$kegiatan."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result()[0];
		}
		else
		{
			return false;
		}
	}
	
	public function check_pekerjaan_pegawai_jft($id_pegawai,$kegiatan,$tahun,$posisi)
	{
		# code...
		$sql = "SELECT a.*
				FROM mr_skp_pegawai a
				WHERE a.id_pegawai      = '".$id_pegawai."'
				AND a.tahun             = '".$tahun."'
				AND a.id_posisi         = '".$posisi."'				
				AND a.id_skp_jft        = '".$kegiatan."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result()[0];
		}
		else
		{
			return false;
		}
	}	

	public function get_data_evaluator($id,$tahun,$id_posisi=NULL)
	{
		# code...
		$sql_where = "";
		if ($id_posisi != NULL) {
			# code...
			$sql_where = "AND a.id_posisi_pegawai = '".$id_posisi."'";			
		}
		$sql = "SELECT a.*,
						b.nama_pegawai,
						pnpos.nama_posisi
				FROM mr_skp_penilaian_prilaku a
				JOIN mr_pegawai b
				ON a.id_pegawai_penilai = b.id
				LEFT JOIN mr_posisi pnpos ON a.id_posisi_pegawai_penilai = pnpos.id
				WHERE a.id_pegawai = '".$id."'
				".$sql_where."
				AND a.tahun = '".$tahun."'";
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

	public function get_info_evaluator($id,$id_evaluator,$tahun)
	{
		# code...
		$sql = "SELECT a.*,
						b.nama_pegawai
				FROM mr_skp_penilaian_prilaku a
				JOIN mr_pegawai b
				ON a.id_pegawai_penilai = b.id
				WHERE a.id_pegawai = '".$id."'
				AND a.id_pegawai_penilai = '".$id_evaluator."'
				AND a.tahun = '".$tahun."'";
		// print_r($sql);die();				
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

	public function get_request_eval($id,$tahun)
	{
		# code...
		$sql = "SELECT 	a.*,
						a.status as `status_prilaku`,
						b.*,
						a.id as evaluator_id
				FROM mr_skp_penilaian_prilaku a
				JOIN mr_pegawai b
				ON a.id_pegawai = b.id
				WHERE a.id_pegawai_penilai = '".$id."'
				AND a.tahun = '".$tahun."'";
		// print_r($sql);die();						
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

	public function get_detail_skp_penilaian($id,$year)
	{
		# code...
		$sql = "SELECT 	a.*,
					   	b.*,
						a.id as evaluator_id
				FROM mr_skp_penilaian_prilaku a
				JOIN mr_pegawai b
				ON a.id_pegawai = b.id
				WHERE a.id = '".$id."'
				AND a.tahun = '".$year."'";
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

	public function _get_nilai_prilaku($id_pegawai,$id_posisi,$parameter,$tahun)
	{
		# code...
		$sql = "";
		if ($parameter == 'atasan') {
			# code...
				$sql = "SELECT DISTINCT 	
								COALESCE (a.orientasi_pelayanan, 0) AS orientasi_pelayanan,
								COALESCE (a.integritas, 0) AS integritas,
								COALESCE (a.komitmen, 0) AS komitmen,
								COALESCE (a.disiplin, 0) AS disiplin,
								COALESCE (a.kerjasama, 0) AS kerjasama,
								COALESCE (a.kepemimpinan, 0) AS kepemimpinan,
								COALESCE (a. STATUS, 0) AS status
						FROM mr_skp_penilaian_prilaku a 
						LEFT JOIN mr_pegawai peg1 ON peg1.id = a.id_pegawai
						LEFT JOIN mr_posisi pos1 ON pos1.id = a.id_posisi_pegawai
						LEFT JOIN mr_pegawai peg2 ON peg2.id = a.id_pegawai_penilai
						LEFT JOIN mr_posisi pos2 ON pos2.id = a.id_posisi_pegawai_penilai
						WHERE a.id_pegawai = '".$id_pegawai."'
						AND a.tahun = '".$tahun."'
						AND a.id_posisi_pegawai = '".$id_posisi."'
						AND pos1.atasan = a.id_posisi_pegawai_penilai";
		}
		elseif ($parameter == 'atasan_plt') {
			$sql = "SELECT DISTINCT 	
			COALESCE (a.orientasi_pelayanan, 0) AS orientasi_pelayanan,
			COALESCE (a.integritas, 0) AS integritas,
			COALESCE (a.komitmen, 0) AS komitmen,
			COALESCE (a.disiplin, 0) AS disiplin,
			COALESCE (a.kerjasama, 0) AS kerjasama,
			COALESCE (a.kepemimpinan, 0) AS kepemimpinan,
			COALESCE (a. STATUS, 0) AS status
			FROM mr_skp_penilaian_prilaku a 
			LEFT JOIN mr_pegawai peg1 ON peg1.id = a.id_pegawai
			LEFT JOIN mr_posisi pos1 ON pos1.id = a.id_posisi_pegawai
			LEFT JOIN mr_pegawai peg2 ON peg2.id = a.id_pegawai_penilai
			LEFT JOIN mr_posisi pos2 ON pos2.id = a.id_posisi_pegawai_penilai
			WHERE a.id_pegawai = '".$id_pegawai."'
			AND a.tahun = '".$tahun."'
			AND a.id_posisi_pegawai = '".$id_posisi."'
			-- AND pos1.atasan = a.id_posisi_pegawai_penilai
			AND peg2.`posisi_plt` = pos1.`atasan`			
			";						
		}
		elseif ($parameter == 'atasan_akademik') {
			$sql = "SELECT DISTINCT 	
			COALESCE (a.orientasi_pelayanan, 0) AS orientasi_pelayanan,
			COALESCE (a.integritas, 0) AS integritas,
			COALESCE (a.komitmen, 0) AS komitmen,
			COALESCE (a.disiplin, 0) AS disiplin,
			COALESCE (a.kerjasama, 0) AS kerjasama,
			COALESCE (a.kepemimpinan, 0) AS kepemimpinan,
			COALESCE (a. STATUS, 0) AS status
			FROM mr_skp_penilaian_prilaku a 
			LEFT JOIN mr_pegawai peg1 ON peg1.id = a.id_pegawai
			LEFT JOIN mr_posisi pos1 ON pos1.id = a.id_posisi_pegawai
			LEFT JOIN mr_pegawai peg2 ON peg2.id = a.id_pegawai_penilai
			LEFT JOIN mr_posisi pos2 ON pos2.id = a.id_posisi_pegawai_penilai
			WHERE a.id_pegawai = '".$id_pegawai."'
			AND a.tahun = '".$tahun."'
			AND a.id_posisi_pegawai = '".$id_posisi."'		
			AND pos1.`atasan` = peg2.`posisi_akademik`			
			";						
		}		
		elseif ($parameter == 'peer') {
			# code...
			$sql = "SELECT DISTINCT 
								COALESCE (a.orientasi_pelayanan, 0) AS orientasi_pelayanan,
								COALESCE (a.integritas, 0) AS integritas,
								COALESCE (a.komitmen, 0) AS komitmen,
								COALESCE (a.disiplin, 0) AS disiplin,
								COALESCE (a.kerjasama, 0) AS kerjasama,
								COALESCE (a.kepemimpinan, 0) AS kepemimpinan,
								COALESCE (a. STATUS, 0) AS status
					FROM mr_skp_penilaian_prilaku a 
					LEFT JOIN mr_pegawai peg1 ON peg1.id = a.id_pegawai
					LEFT JOIN mr_posisi pos1 ON pos1.id = a.id_posisi_pegawai
					LEFT JOIN mr_pegawai peg2 ON peg2.id = a.id_pegawai_penilai
					LEFT JOIN mr_posisi pos2 ON pos2.id = a.id_posisi_pegawai_penilai
					WHERE a.id_pegawai = '".$id_pegawai."'
					AND a.tahun = '".$tahun."'
					AND a.id_posisi_pegawai = '".$id_posisi."'
					AND pos2.`atasan` = pos1.`atasan`					
					-- AND pos1.atasan <> a.id_posisi_pegawai_penilai
					-- AND pos2.atasan <> a.id_posisi_pegawai
					GROUP BY a.id_pegawai";
		}
		elseif ($parameter == 'bawahan') {
			$sql = "SELECT DISTINCT 
						COALESCE (a.orientasi_pelayanan, 0) AS orientasi_pelayanan,
						COALESCE (a.integritas, 0) AS integritas,
						COALESCE (a.komitmen, 0) AS komitmen,
						COALESCE (a.disiplin, 0) AS disiplin,
						COALESCE (a.kerjasama, 0) AS kerjasama,
						COALESCE (a.kepemimpinan, 0) AS kepemimpinan,
						COALESCE (a. STATUS, 0) AS status
					FROM mr_skp_penilaian_prilaku a 
					LEFT JOIN mr_pegawai peg1 ON peg1.id = a.id_pegawai
					LEFT JOIN mr_posisi pos1 ON pos1.id = a.id_posisi_pegawai
					LEFT JOIN mr_pegawai peg2 ON peg2.id = a.id_pegawai_penilai
					LEFT JOIN mr_posisi pos2 ON pos2.id = a.id_posisi_pegawai_penilai
					WHERE a.id_pegawai = '".$id_pegawai."'
					AND a.tahun = '".$tahun."'
					AND a.id_posisi_pegawai = '".$id_posisi."'
					AND pos2.atasan <> a.id_posisi_pegawai
					GROUP BY a.id_pegawai";			
					// print_r($sql);die();					
		}

		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			$data[0] = (object)array(
							'orientasi_pelayanan' => 0,
							'integritas'          => 0,
							'komitmen'            => 0,
							'disiplin'            => 0,
							'kerjasama'           => 0,
							'kepemimpinan'        => 0,
							'status'              => 0
						);
			return $data;
		}		
	}

	public function get_nilai_prilaku($id,$id_posisi,$param,$tahun,$id_pegawai)
	{
		# code...
		$sql_join  = "";
		$sql_where = "";
		$sql       = "";
		if ($param == 'atasan') {
			# code...
			$sql = "SELECT DISTINCT COALESCE(c.orientasi_pelayanan,0) as orientasi_pelayanan,
								COALESCE(c.integritas,0) as integritas,
								COALESCE(c.komitmen,0) as komitmen,
								COALESCE(c.disiplin,0) as disiplin,
								COALESCE(c.kerjasama,0) as kerjasama,
								COALESCE(c.kepemimpinan,0) as kepemimpinan,
								COALESCE(c.status,0) as status
			    FROM mr_pegawai a
			    JOIN mr_posisi b
			    ON b.atasan = a.posisi OR b.atasan=a.posisi_PLT or b.atasan = a.posisi_akademik
				LEFT JOIN mr_skp_penilaian_prilaku c
				ON a.id = c.id_pegawai_penilai
			    WHERE a.status = 1
			    AND b.id = '".$id_posisi."'
				AND c.id_pegawai = '".$id_pegawai."'
				AND c.tahun = '".$tahun."'";	
				// print_r($sql);die();					
		}
		elseif ($param == 'peer') {
			# code...
			$sql = "SELECT DISTINCT COALESCE(AVG(c.orientasi_pelayanan),0) as orientasi_pelayanan,
								COALESCE(AVG(c.integritas),0) as integritas,
								COALESCE(AVG(c.komitmen),0) as komitmen,
								COALESCE(AVG(c.disiplin),0) as disiplin,
								COALESCE(AVG(c.kerjasama),0) as kerjasama,
								COALESCE(AVG(c.kepemimpinan),0) as kepemimpinan,
								COALESCE(SUM(c.status),0) as status
			    FROM mr_pegawai a
			    JOIN mr_posisi b
			    ON a.posisi = b.id
				LEFT JOIN mr_skp_penilaian_prilaku c
				ON a.id = c.id_pegawai_penilai
			    WHERE a.status = 1
				-- AND b.atasan = '".$id_posisi."'
				-- AND a.posisi <> '965'				
				AND c.status = 1
				AND c.tahun = '".$tahun."'
				AND c.id_pegawai = ".$id_pegawai."
				GROUP BY b.atasan";
				// print_r($sql);die();
		}
		elseif ($param == 'bawahan') {
			# code...
			$sql = "SELECT DISTINCT COALESCE(AVG(c.orientasi_pelayanan),0) as orientasi_pelayanan,
								COALESCE(AVG(c.integritas),0) as integritas,
								COALESCE(AVG(c.komitmen),0) as komitmen,
								COALESCE(AVG(c.disiplin),0) as disiplin,
								COALESCE(AVG(c.kerjasama),0) as kerjasama,
								COALESCE(AVG(c.kepemimpinan),0) as kepemimpinan,
								COALESCE(SUM(c.status),0) as status
					FROM mr_pegawai a
					JOIN mr_posisi b
					ON a.posisi = b.id
					LEFT JOIN mr_skp_penilaian_prilaku c
					ON a.id = c.id_pegawai_penilai
					WHERE b.atasan = '".$id_posisi."'
					AND c.tahun = '".$tahun."'
					AND c.id_pegawai = ".$id_pegawai."
					AND a. STATUS = 1";
		}
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			$data[0] = (object)array(
							'orientasi_pelayanan' => 0,
							'integritas'          => 0,
							'komitmen'            => 0,
							'disiplin'            => 0,
							'kerjasama'           => 0,
							'kepemimpinan'        => 0,
							'status'              => 0
						);
			return $data;
		}
	}

	public function get_master_skp_id($id,$param_status=NULL)
	{
		# code...
		$sql_1 = "";
		if ($param_status == 'posisi') {
			# code...
			$sql_1 = "a.posisi = '".$id."'";
		}
		elseif ($param_status == 'id') {
			# code...
			$sql_1 = "a.id_skp = '".$id."'";
		}
		$sql = "SELECT a.*
				FROM mr_skp_master a
				WHERE ".$sql_1."
				ORDER BY a.status DESC";
				// AND a.status = '1'				
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

	public function get_summary_tugas_tambahan($id_user,$tahun,$PARAM=NULL)
	{
		# code...
		$sql_1  = "AND a.flag = ''";
		$SELECT = "count(a.id) as `count`";
		if ($PARAM == 'kreativitas') {
			# code...
			$SELECT = 'SUM(b.nilai) as `count`';
			$sql_1 = "AND a.flag = '".$PARAM."'";
		}


		$sql = "SELECT ".$SELECT."
				FROM tr_tugas_tambahan_detail a
				LEFT JOIN mr_keterangan_kreativitas b
				ON a.id_keterangan_kreativitas = b.id
				WHERE a.id_pegawai = '".$id_user."'
				AND a.tahun = '".$tahun."'
				AND a.approve = '1'
				".$sql_1."";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result()[0]->count;
		}
		else
		{
			return 0;
		}
	}

	public function get_summary_master_skp($id_posisi)
	{
		# code...
		$sql = "SELECT count(a.id_skp) as `count`
				FROM mr_skp_master a
				WHERE a.posisi = '".$id_posisi."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result()[0]->count;
		}
		else
		{
			return 0;
		}
	}

	public function get_indikator_prilaku($id)
	{
		# code...
		$sql = "SELECT a.*,b.nama 
				FROM mr_penilaian_prilaku_indikator a
				JOIN mr_penilaian_prilaku_unsur b
				ON a.id_penilaian_prilaku_unsur = b.id
				WHERE a.id_penilaian_prilaku_unsur = '".$id."'";
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
	

	public function get_counter_empty_target_skp($id,$id_posisi)
	{
		# code...
		$year = date("Y");
		$sql = "SELECT count(a.id_pegawai) as counter
				FROM mr_skp_pegawai a
				WHERE a.id_pegawai = '".$id."'
				AND a.id_posisi = '".$id_posisi."'
				AND a.tahun = '".$year."'
				AND (a.target_qty IS NULL OR a.target_qty = '')";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	
	public function get_counter_nonempty_target_skp($id,$id_posisi)
	{
		# code...
		$year = date("Y");
		$sql = "SELECT count(a.id_pegawai) as counter
				FROM mr_skp_pegawai a
				WHERE a.id_pegawai = '".$id."'
				AND a.id_posisi = '".$id_posisi."'				
				AND a.tahun = '".$year."'
				AND (a.target_qty IS NOT NULL OR a.target_qty <> '')";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	
	public function get_counter_approval_skp($id,$id_posisi)
	{
		# code...
		$year = date("Y");
		$sql = "SELECT count(a.id_pegawai) as counter
				FROM mr_skp_pegawai a
				WHERE a.id_pegawai = '".$id."'
				AND a.id_posisi = '".$id_posisi."'				
				AND a.status = '1'				
				AND a.tahun = '".$year."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}	

    public function get_request_history($id,$tahun,$stat=NULL)
	{
		# code...
		$and = "";
		if ($stat != NULL) {
			# code...
			if ($stat == 'on') {
				# code...
				$and = "AND a.tahun = '".$tahun."'";				
			}
			else
			{
				$and = "";				
			}
		}
		
		$sql = "SELECT a.id_pegawai as pegawai,
						a.id_posisi as posisi,
						a.tahun,
						b.nama_pegawai as nama_pegawai,
						c.nama_posisi as nama_posisi,
						b.nip,
						es1.nama_eselon1,
						es2.nama_eselon2,
						es3.nama_eselon3,
						es4.nama_eselon4
				FROM mr_skp_pegawai a
				LEFT JOIN mr_pegawai b ON a.id_pegawai = b.id
				LEFT JOIN mr_posisi c ON a.id_posisi = c.id
				LEFT JOIN mr_eselon1 es1 ON es1.id_es1 = c.eselon1
				LEFT JOIN mr_eselon2 es2 ON es2.id_es2 = c.eselon2
				LEFT JOIN mr_eselon3 es3 ON es3.id_es3 = c.eselon3
				LEFT JOIN mr_eselon4 es4 ON es4.id_es4 = c.eselon4
				JOIN mr_masa_kerja mk ON mk.id_pegawai = a.id_pegawai
				AND mk.id_posisi = a.id_posisi				
				WHERE a.id_pegawai = '".$id."'
				AND c.nama_posisi IS NOT NULL
				".$and."				
				GROUP BY a.id_pegawai, a.id_posisi, a.tahun
				";
				// print_r($sql);die();
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
	
    public function get_request_history1($id,$stat=NULL)
	{
		# code...		
		$sql = "SELECT a.id_pegawai as pegawai,
						a.id_posisi as posisi,
						a.tahun,
						b.nama_pegawai as nama_pegawai,
						c.nama_posisi as nama_posisi,
						b.nip,
						es1.nama_eselon1,
						es2.nama_eselon2,
						es3.nama_eselon3,
						es4.nama_eselon4
				FROM mr_skp_pegawai a
				LEFT JOIN mr_pegawai b ON a.id_pegawai = b.id
				LEFT JOIN mr_posisi c ON a.id_posisi = c.id
				LEFT JOIN mr_eselon1 es1 ON es1.id_es1 = c.eselon1
				LEFT JOIN mr_eselon2 es2 ON es2.id_es2 = c.eselon2
				LEFT JOIN mr_eselon3 es3 ON es3.id_es3 = c.eselon3
				LEFT JOIN mr_eselon4 es4 ON es4.id_es4 = c.eselon4
				JOIN mr_masa_kerja mk ON mk.id_pegawai = a.id_pegawai
				AND mk.id_posisi = a.id_posisi				
				WHERE a.id_pegawai = '".$id."'
				AND c.nama_posisi IS NOT NULL
				GROUP BY a.id_pegawai, a.id_posisi
				";
				// print_r($sql);die();
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

	public function get_golongan($nip)
	{
		# code...
		$sql = "SELECT b.nama_pangkat, 
						b.golongan,
						a.tmt_pangkat
				FROM mr_simpeg_riwayat_pangkat a
				LEFT JOIN mr_simpeg_golongan b ON a.id_golongan = b.id
				WHERE a.nip = '".$nip."'
				ORDER BY a.tmt_pangkat DESC
				LIMIT 1";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}	

	public function questionnaires($id_pegawai,$id_posisi,$year)
	{
		# code...
		$sql = "SELECT a.qusioner_code, 
						a.pertanyaan, 
						b.nama, 
						b.quisioner_kategori_id, 
						a.prefix,
						COALESCE(c.value,0) as value,
						d.nama as kriteria
				FROM questionnaires a
				LEFT JOIN questionnaires_kategori b ON a.quisioner_kategori_id = b.quisioner_kategori_id
				LEFT JOIN questionnaires_process c ON a.qusioner_code = c.qusioner_code
				AND c.id_pegawai = '".$id_pegawai."'
				AND c.id_posisi = '".$id_posisi."'
				AND c.tahun = '".$year."' 
				LEFT JOIN questionnaires_kriteria d ON a.kriteria_id = d.quisioner_kategori_id";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}		
	}

	public function get_sum_questionnaires($id_pegawai,$id_posisi,$year)
	{
		# code...
		$sql = "SELECT SUM(c.value) as result
				FROM questionnaires a
				LEFT JOIN questionnaires_kategori b ON a.quisioner_kategori_id = b.quisioner_kategori_id
				LEFT JOIN questionnaires_process c ON a.qusioner_code = c.qusioner_code
				AND c.id_pegawai = '".$id_pegawai."'
				AND c.id_posisi = '".$id_posisi."'
				AND c.tahun = '".$year."' ";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}		
	}	

	public function rekap_skp_tahunan($flag=NULL,$order_by=NULL,$filter=NULL)
	{
		# code...
		$sql        = "";
		$sql_1      = "";
		$sql_2      = "";
		$sql_3      = "";
		$sql_4      = "";
		$sql_5      = "";

		if ($flag['eselon1'] == '') {
			# code...
			$sql_1 = "";
		}
		else $sql_1 = "AND a.es1 = '".$flag['eselon1']."'";

		if ($flag['eselon2'] == '') {
			# code...
			$sql_2 = "";
		}
		else $sql_2 = "AND a.es2 = '".$flag['eselon2']."'";

		if ($flag['eselon3'] == '') {
			# code...
			$sql_3 = "";
		}
		else $sql_3 = "AND a.es3 = '".$flag['eselon3']."'";

		if ($flag['eselon4'] == '') {
			# code...
			$sql_4 = "";
		}
		else $sql_4 = "AND a.es4 = '".$flag['eselon4']."'";

		$sql = "SELECT  a.id AS id_pegawai,
						a.nip,
						a.nama_pegawai,
						COALESCE (pos1.nama_posisi, COALESCE (b.nama_posisi, '-')) AS nama_posisi,
						COALESCE (es1.nama_eselon1, '-') AS nama_eselon1,
						COALESCE (es2.nama_eselon2, '-') AS nama_eselon2,
						COALESCE (es3.nama_eselon3, '-') AS nama_eselon3,
						COALESCE (es4.nama_eselon4, '-') AS nama_eselon4,
						b.atasan,
						'2019-02-01' AS tmt,
						rptp.nilai_prilaku_kerja,
						rpts.nilai_capaian_skp,
						rpts.nilai_sasaran_kinerja_pegawai,
						(
							rpts.nilai_sasaran_kinerja_pegawai + rptp.nilai_prilaku_kerja
						) AS total_skp,
						rpts.id_posisi AS id_posisi_ts						
					FROM mr_pegawai a
					LEFT JOIN mr_posisi b ON b.id = a.posisi
					LEFT JOIN mr_eselon1 es1 ON es1.id_es1 = b.eselon1
					LEFT JOIN mr_eselon2 es2 ON es2.id_es2 = b.eselon2
					LEFT JOIN mr_eselon3 es3 ON es3.id_es3 = b.eselon3
					LEFT JOIN mr_eselon4 es4 ON es4.id_es4 = b.eselon4
					LEFT JOIN rpt_skp_prilaku_skp rptp ON a.id = rptp.id_pegawai
					AND rptp.tahun = '".$flag['tahun']."'
					LEFT JOIN rpt_skp_sasaran_kerja rpts on rptp.id_pegawai = rpts.id_pegawai
					AND rptp.id_posisi = rpts.id_posisi 
					AND rptp.tahun = '".$flag['tahun']."'					
					LEFT JOIN mr_posisi pos1 ON rpts.id_posisi = pos1.id					
					WHERE a. STATUS = '1'
					".$sql_1."
					".$sql_2."
					".$sql_3."
					".$sql_4."
					".$sql_5."				
					ORDER BY ".$order_by."";
					// print_r($sql);die();
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}		
	}		
	
}
