<?php
class Mskp extends CI_Model
{
	public function __construct () {
		parent::__construct();
	}

	public function get_data_skp_pegawai($id_pegawai,$tahun,$param_status,$priority=NULL)
	{
		# code...
		$query_1 = "";
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
										jfu.uraian_tugas
									FROM
									mr_jabatan_fungsional_umum_uraian_tugas jfu
									WHERE
										jfu.id = a.id_skp_jfu
								),'-'
							) AS `kegiatan_skp_jfu`,							
							COALESCE(d.nama,'-') as `target_output_name`
							".$SELECT."
					FROM mr_skp_pegawai a
					LEFT OUTER JOIN mr_skp_pegawai_temp b
					ON a.skp_id = b.edit_skp_id
					LEFT OUTER JOIN mr_skp_jenis c
					ON a.jenis_skp = c.id
					LEFT OUTER JOIN mr_skp_satuan d
					ON a.target_output = d.id
					WHERE a.tahun = '".$tahun."'
					AND a.id_pegawai = '".$id_pegawai."'
					AND a.status <> '99'
					".$query_1."
					ORDER BY a.PK DESC, a.audit_priority ASC";
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

	public function get_persentase_target_realisasi($value='')
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
				WHERE a.tahun = '".date('Y')."'
				AND a.id_pegawai = '".$this->session->userdata('sesUser')."'
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
				AND a.status = '1'";
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

	public function check_pekerjaan_pegawai($id_pegawai,$kegiatan,$tahun)
	{
		# code...
		$sql = "SELECT a.*
				FROM mr_skp_pegawai a
				WHERE a.id_pegawai  = '".$id_pegawai."'
				AND a.tahun         = '".$tahun."'
				AND a.id_skp_master = '".$kegiatan."'";
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

	public function check_pekerjaan_pegawai_jfu($id_pegawai,$kegiatan,$tahun)
	{
		# code...
		$sql = "SELECT a.*
				FROM mr_skp_pegawai a
				WHERE a.id_pegawai  = '".$id_pegawai."'
				AND a.tahun         = '".$tahun."'
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
	
	public function check_pekerjaan_pegawai_jft($id_pegawai,$kegiatan,$tahun)
	{
		# code...
		$sql = "SELECT a.*
				FROM mr_skp_pegawai a
				WHERE a.id_pegawai  = '".$id_pegawai."'
				AND a.tahun         = '".$tahun."'
				AND a.id_skp_jft = '".$kegiatan."'";
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

	public function get_data_evaluator($id,$tahun)
	{
		# code...
		$sql = "SELECT a.*,
						b.nama_pegawai
				FROM mr_skp_penilaian_prilaku a
				JOIN mr_pegawai b
				ON a.id_pegawai_penilai = b.id
				WHERE a.id_pegawai = '".$id."'
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
		$sql = "SELECT a.*,
						a.status as `status_prilaku`,
					   b.*,
						COALESCE(
									(
										SELECT aa.photo
										FROM mr_pegawai_photo aa
										WHERE aa.id_pegawai = b.id
										AND aa.main_pic = 1
										AND aa.local = b.local
									),'-'
								) as photo,
						a.id as evaluator_id
				FROM mr_skp_penilaian_prilaku a
				JOIN mr_pegawai b
				ON a.id_pegawai = b.id
				WHERE a.id_pegawai_penilai = '".$id."'
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

	public function get_detail_skp_penilaian($id)
	{
		# code...
		$sql = "SELECT a.*,
					   b.*,
						COALESCE(
									(
										SELECT aa.photo
										FROM mr_pegawai_photo aa
										WHERE aa.id_pegawai = b.id
										AND aa.main_pic = 1
										AND aa.local = b.local
									),'-'
								) as photo,
						a.id as evaluator_id
				FROM mr_skp_penilaian_prilaku a
				JOIN mr_pegawai b
				ON a.id_pegawai = b.id
				WHERE a.id = '".$id."'";
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

	public function get_nilai_prilaku($id,$id_param,$param,$tahun,$id_pegawai)
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
			    ON b.atasan = a.posisi
				LEFT JOIN mr_skp_penilaian_prilaku c
				ON a.id = c.id_pegawai_penilai
			    WHERE a.status = 1
			    AND b.id = '".$id_param."'
			    AND c.id_pegawai = ".$id_pegawai."";
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
			    AND b.atasan = '".$id_param."'
				AND c.status = 1
				AND c.id_pegawai = ".$id_pegawai."
				GROUP BY b.atasan";
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
					WHERE b.atasan = '".$id_param."'
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
				AND a.status = '1'";
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
		$sql = "SELECT b.nama,
						a.* 
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
}
