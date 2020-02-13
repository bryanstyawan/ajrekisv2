<?php

class M_api extends CI_Model {

    public function __construct () {
		parent::__construct();
	}
	
	public function get_pegawai($nip)
	{
		# code...
		$sql = "SELECT a.*,b.kat_posisi
						FROM mr_pegawai a
						LEFT JOIN mr_posisi b on a.posisi = b.id
						WHERE a.nip = '".$nip."'";
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

	public function get_posisi($posisi)
	{
		# code...
		$sql = "SELECT a.*
						FROM mr_posisi a
						WHERE a.id = '".$posisi."'";
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

	public function get_nilai_prilaku($id,$id_param,$param,$tahun,$id_pegawai)
	{
		# code...
		$sql_join  = "";
		$sql_where = "";
		$sql       = "";
		if ($param == 'atasan') {
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
					AND a.id_posisi_pegawai = '".$id_param."'
					AND pos1.atasan = a.id_posisi_pegawai_penilai";
		}
		elseif ($param == 'peer') {
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
					AND a.id_posisi_pegawai = '".$id_param."'
					AND pos1.atasan <> a.id_posisi_pegawai_penilai
					AND pos2.atasan <> a.id_posisi_pegawai
					GROUP BY a.id_pegawai";
		}
		elseif ($param == 'bawahan') {
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
					AND a.id_posisi_pegawai = '".$id_param."'
					AND pos2.atasan <> a.id_posisi_pegawai
					GROUP BY a.id_pegawai";
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
    
	public function get_transact($nip=NULL,$status=NULL,$bulan=NULL,$tahun=NULL)
	{
		// print_r($nip);die();
		if ($nip == NULL) {
			# code...
			$nip = "0";
		}
		$sql = "SELECT
					b.id AS id_pegawai,
					c.id as id_posisi,
					b.posisi_akademik,
					b.posisi_plt,
					b.nip,
					b.nama_pegawai,
					c.nama_posisi,
					c.atasan,
					d.nama_eselon1,
					e.nama_eselon2,
					f.nama_eselon3,
					g.nama_eselon4,
					a.bulan,
					a.tahun,
					a.tr_approve,
					a.tr_tolak,
					a.tr_revisi,
					a.menit_efektif,
					a.prosentase_menit_efektif,
					a.real_tunjangan,
					a.frekuensi_realisasi,
					a.tr_belum_diperiksa,
					c.kat_posisi,
				-- 	IF(c.kat_posisi = 1,h.posisi_class,NULL) as class_posisi_struktural_definif,
				-- 	IF(c.kat_posisi = 2,l.posisi_class,NULL) as class_posisi_jft_definif,
				-- 	IF(c.kat_posisi = 4,j.posisi_class,NULL) as class_posisi_jfu_definif,
				-- 	IF(c.kat_posisi = 6,h.posisi_class,NULL) as class_posisi_struktur_akademik_definif,
					CASE
							WHEN c.kat_posisi = 1 THEN h.posisi_class
							WHEN c.kat_posisi = 2 THEN l.posisi_class
							WHEN c.kat_posisi = 4 THEN j.posisi_class
							WHEN c.kat_posisi = 6 THEN h.posisi_class
					END as class_posisi_definitif,
					CASE
							WHEN c.kat_posisi = 1 THEN h.tunjangan
							WHEN c.kat_posisi = 2 THEN l.tunjangan
							WHEN c.kat_posisi = 4 THEN j.tunjangan
							WHEN c.kat_posisi = 6 THEN h.tunjangan
					END as tunjangan_definitif
				FROM
					(
						(
							(
								(
									(
										rpt_capaian_kinerja a
										LEFT JOIN mr_pegawai b ON a.id_pegawai = b.id
									)
									LEFT JOIN mr_posisi c ON a.id_posisi = c.id
								)
								LEFT JOIN mr_eselon1 d ON b.es1 = d.id_es1
							)
							LEFT JOIN mr_eselon2 e ON b.es2 = e.id_es2
						)
						LEFT JOIN mr_eselon3 f ON b.es3 = f.id_es3
					)
				LEFT JOIN mr_eselon4 g ON b.es4 = g.id_es4
				LEFT JOIN mr_posisi_class h ON c.posisi_class = h.id
				LEFT JOIN mr_jabatan_fungsional_umum i ON c.id_jfu = i.id
				LEFT JOIN mr_posisi_class j ON i.id_kelas_jabatan = j.id
				LEFT JOIN mr_jabatan_fungsional_umum k ON c.id_jft = k.id
				LEFT JOIN mr_posisi_class l ON k.id_kelas_jabatan = l.id
				WHERE a.bulan = '".$bulan."' 
				AND a.tahun = '".$tahun."'
				AND b.nip = '".$nip."'";
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

	public function api_kinerja($flag=NULL,$order_by=NULL,$filter=NULL)
	{
		# code...
		$sql_es1 = "";
		$sql_es1a = "";			
		if ($filter['eselon1'] != '') {
			# code...
			$sql_es1  = "AND b.eselon1 = '".$filter['eselon1']."'";
			$sql_es1a = "AND c.eselon1 = '".$filter['eselon1']."'";				
		}

		$sql_es2 = "";
		$sql_es2a = "";
		if ($filter['eselon2'] != '') {
			# code...
			$sql_es2  = "AND b.eselon2 = '".$filter['eselon2']."'";
			$sql_es2a = "AND c.eselon2 = '".$filter['eselon2']."'";
		}

		$sql_es3 = "";
		$sql_es3a = "";
		if ($filter['eselon3'] != '') {
			# code...
			$sql_es3  = "AND b.eselon3 = '".$filter['eselon3']."'";
			$sql_es3a = "AND c.eselon3 = '".$filter['eselon3']."'";				
		}

		$sql_es4 = "";
		$sql_es4a = "";
		if ($filter['eselon4'] != '') {
			# code...
			$sql_es4 = "AND b.eselon4 = '".$filter['eselon4']."'";
			$sql_es4a = "AND c.eselon4 = '".$filter['eselon4']."'";				
		}
		
		$sql_pegawai   = "";
		$sql_pegawaia  = "";			
		if ($filter['pegawai'] != '') {
			# code...
			$sql_pegawai  = "AND c.id = '".$filter['pegawai']."'";
			$sql_pegawaia  = "AND a.id = '".$filter['pegawai']."'";
		}

		$sql_posisi   = "";
		$sql_posisia   = "";			
		if ($filter['posisi'] != '') {
			# code...
			$sql_posisi  = "AND b.id = '".$filter['posisi']."'";
			$sql_posisia  = "AND c.id = '".$filter['posisi']."'";
		}			

		$sql = "SELECT    
				a.id_pegawai,
				b.eselon1,
				b.eselon2,
				b.eselon3,
				b.eselon4,
				IFNULL(c.posisi_akademik,0) as posisi_akademik, 
				IFNULL(c.posisi_plt,0) as posisi_plt, 
				c.nip,
				c.`nama_pegawai`,
				b.`nama_posisi`,
				b.atasan as atasan,
				d.nama_eselon1,
				e.nama_eselon2,
				f.nama_eselon3,
				g.nama_eselon4,
				a.bulan,
				a.tahun,
				a.tr_approve,
				a.tr_tolak,
				a.tr_revisi,
				a.menit_efektif,
				a.prosentase_menit_efektif,
				a.tr_belum_diperiksa,
				b.kat_posisi,
				CASE
						WHEN b.kat_posisi = 1 THEN h.posisi_class
						WHEN b.kat_posisi = 2 THEN l.posisi_class
						WHEN b.kat_posisi = 4 THEN j.posisi_class
						WHEN b.kat_posisi = 6 THEN h.posisi_class
				END as class_posisi_definitif,
				CASE
					WHEN b.kat_posisi = 1 THEN h.tunjangan
					WHEN b.kat_posisi = 2 THEN l.tunjangan
					WHEN b.kat_posisi = 4 THEN j.tunjangan
					WHEN b.kat_posisi = 6 THEN h.tunjangan
				END as tunjangan_definitif,
				IF(b.atasan = 0 && b.kat_posisi = 1,0,
					(
						IF(a.bulan = 7 && a.tahun = 2019,0,
							IFNULL(
											CASE
												WHEN a.persentase_pemotongan = 0 THEN a.persentase_pemotongan
												WHEN a.persentase_pemotongan = 5 THEN a.persentase_pemotongan
												WHEN a.persentase_pemotongan = NULL THEN 5
											END,5
										)
						)
					)
				) AS persentase_pemotongan_potongan_skp_bulanan,
				IF(b.atasan = 0 && b.kat_posisi = 1,0,
					(
						IF(a.bulan = 7 && a.tahun = 2019,0,
							IFNULL(
											CASE
												WHEN a.persentase_pemotongan = 0 THEN a.persentase_pemotongan
												WHEN a.persentase_pemotongan = 5 THEN a.persentase_pemotongan
												WHEN a.persentase_pemotongan = NULL THEN 5
											END,5
										)*a.real_tunjangan
						)/100
					)
				) as nilai_potongan_skp_bulanan,
				IFNULL(tp.tunjangan,0) as tunjangan_profesi,
				IF(IFNULL(tp.tunjangan,0) = 0, 
					(a.real_tunjangan -  IF(b.atasan = 0 && b.kat_posisi = 1,0,
						(
							IF(a.bulan = 7 && a.tahun = 2019,0,
								IFNULL(
									CASE
										WHEN a.persentase_pemotongan = 0 THEN a.persentase_pemotongan
										WHEN a.persentase_pemotongan = 5 THEN a.persentase_pemotongan
										WHEN a.persentase_pemotongan = NULL THEN 5
									END,5
								)*a.real_tunjangan
							)/100
						)
					))
					,
					(
						IF(a.menit_efektif < (ha.jml_hari_aktif * ha.jml_menit_perhari),
							(
								(
									CASE
										WHEN b.kat_posisi = 1 THEN h.tunjangan
										WHEN b.kat_posisi = 2 THEN l.tunjangan
										WHEN b.kat_posisi = 4 THEN j.tunjangan
										WHEN b.kat_posisi = 6 THEN h.tunjangan
									END							
								) - IFNULL(tp.tunjangan,0)
							) * 0.5 * (a.menit_efektif/(ha.jml_hari_aktif * ha.jml_menit_perhari))
							,
							(
								(
									CASE
										WHEN b.kat_posisi = 1 THEN h.tunjangan
										WHEN b.kat_posisi = 2 THEN l.tunjangan
										WHEN b.kat_posisi = 4 THEN j.tunjangan
										WHEN b.kat_posisi = 6 THEN h.tunjangan
									END							
								) - IFNULL(tp.tunjangan,0)
							) * 0.5															
						)
					)						
				)  as real_tunjangan,
				a.real_tunjangan as real_tunjangan_sb_potongan,
				a.persentase_pemotongan,
				a.audit_check_skp		
			FROM `rpt_capaian_kinerja` a
			LEFT JOIN mr_posisi b ON b.id = a.id_posisi
			LEFT JOIN mr_pegawai c ON c.id = a.`id_pegawai`
			LEFT JOIN mr_eselon1 d on b.eselon1 = d.id_es1
			LEFT JOIN mr_eselon2 e on b.eselon2 = e.id_es2
			LEFT JOIN mr_eselon3 f on b.eselon3 = f.id_es3
			LEFT JOIN mr_eselon4 g on b.eselon4 = g.id_es4
			LEFT JOIN mr_posisi_class h ON b.posisi_class = h.id
			LEFT JOIN mr_jabatan_fungsional_umum i ON b.id_jfu = i.id
			LEFT JOIN mr_posisi_class j ON i.id_kelas_jabatan = j.id
			LEFT JOIN mr_jabatan_fungsional_tertentu k ON b.id_jft = k.id
			LEFT JOIN mr_posisi_class l ON k.id_kelas_jabatan = l.id
			LEFT JOIN mr_tunjangan_profesi tp ON tp.id_pegawai = a.id_pegawai				
			AND tp.tgl_selesai = '9999-01-01'				
			LEFT JOIN mr_hari_aktif ha ON ha.bulan = a.bulan
			AND ha.tahun = ".$filter['tahun']." 				
			WHERE c.id_role <> 7
			AND c.id_role <> 6
			AND a.`id_pegawai` IS NOT NULL		
			AND a.id_posisi <> 0				
			AND a.bulan = ".$filter['bulan']."
			AND a.tahun = ".$filter['tahun']."		
			".$sql_es1."
			".$sql_es2."
			".$sql_es3."
			".$sql_es4."
			".$sql_pegawai."
			".$sql_posisi."				
			UNION
				SELECT
					a.id,
					c.eselon1,
					c.eselon2,
					c.eselon3,
					c.eselon4,
					IFNULL(a.posisi_akademik,0) as posisi_akademik, 
					IFNULL(a.posisi_plt,0) as posisi_plt, 
					a.nip,	
					a.nama_pegawai,
					c.`nama_posisi`,
					c.atasan as atasan,
					d.nama_eselon1,
					e.nama_eselon2,
					f.nama_eselon3,
					g.nama_eselon4,
					IFNULL(b.bulan, 0),
					IFNULL(b.tahun, 0),
					IFNULL(b.tr_approve, 0),
					IFNULL(b.tr_tolak, 0),
					IFNULL(b.tr_revisi,0),
					IFNULL(b.menit_efektif,0),
					IFNULL(b.prosentase_menit_efektif,0),
					IFNULL(b.tr_belum_diperiksa,0),
					c.kat_posisi,
					CASE
							WHEN c.kat_posisi = 1 THEN h.posisi_class
							WHEN c.kat_posisi = 2 THEN l.posisi_class
							WHEN c.kat_posisi = 4 THEN j.posisi_class
							WHEN c.kat_posisi = 6 THEN h.posisi_class
					END as class_posisi_definitif,
					CASE
						WHEN c.kat_posisi = 1 THEN h.tunjangan
						WHEN c.kat_posisi = 2 THEN l.tunjangan
						WHEN c.kat_posisi = 4 THEN j.tunjangan
						WHEN c.kat_posisi = 6 THEN h.tunjangan
					END as tunjangan_definitif,
					IFNULL(b.persentase_pemotongan, 0) as persentase_potongan_skp_bulanan,
					IFNULL(b.persentase_pemotongan, 0) as nilai_potongan_skp_bulanan,						
					IFNULL(tp.tunjangan, 0) as tunjangan_profesi,						
					IFNULL(b.real_tunjangan,0),
					IFNULL(b.real_tunjangan,0) as real_tunjangan_sb_potongan,
					IFNULL(b.persentase_pemotongan,5) as persentase_pemotongan,
					IFNULL(b.audit_check_skp,0) as audit_check_skp   						
				FROM mr_pegawai a
				LEFT JOIN rpt_capaian_kinerja b ON b.id_pegawai = a.`id`
				AND b.bulan = ".$filter['bulan']."
				AND b.tahun = ".$filter['tahun']."
				LEFT JOIN mr_posisi c ON c.id = a.posisi
				LEFT JOIN mr_eselon1 d on c.eselon1 = d.id_es1
				LEFT JOIN mr_eselon2 e on c.eselon2 = e.id_es2
				LEFT JOIN mr_eselon3 f on c.eselon3 = f.id_es3
				LEFT JOIN mr_eselon4 g on c.eselon4 = g.id_es4
				LEFT JOIN mr_posisi_class h ON c.posisi_class = h.id
				LEFT JOIN mr_jabatan_fungsional_umum i ON c.id_jfu = i.id
				LEFT JOIN mr_posisi_class j ON i.id_kelas_jabatan = j.id
				LEFT JOIN mr_jabatan_fungsional_tertentu k ON c.id_jft = k.id
				LEFT JOIN mr_posisi_class l ON k.id_kelas_jabatan = l.id
				LEFT JOIN mr_tunjangan_profesi tp ON tp.id_pegawai = a.id					
				AND tp.tgl_selesai = '9999-01-01'					
				WHERE a.STATUS = 1
				AND a.id_role <> 7
				AND a.id_role <> 6					
				".$sql_es1a."
				".$sql_es2a."
				".$sql_es3a."
				".$sql_es4a."
				".$sql_pegawaia."
				".$sql_posisi."										
				AND a.`id` NOT IN (
					SELECT IFNULL(id_pegawai, 0)
					FROM `rpt_capaian_kinerja`
					WHERE bulan = ".$filter['bulan']."
					AND tahun = ".$filter['tahun']."
				)
				ORDER BY ".$order_by."";
				
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
					WHERE a.tahun = '".$tahun."'
					AND a.id_pegawai = '".$id_pegawai."'
					".$query_2."					
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
	
	public function get_persentase_target_realisasi($id_pegawai,$id_posisi,$tahun)
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
				WHERE a.tahun = '".$tahun."'
				AND a.id_pegawai = '".$id_pegawai."'
				AND a.id_posisi = '".$id_posisi."'				
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

	public function get_menit_efektif_year($id,$tahun)
	{
		$sql = "SELECT a.nama_bulan,
            			 MONTH (b.tanggal_mulai) AS `month`,
            			 COALESCE(b.id_pegawai,b.id_pegawai) as id_pegawai,
            			 COALESCE(SUM(b.menit_efektif),0) AS menit_efektif,
            			 COALESCE(COUNT(b.status_pekerjaan),0) AS counter_pekerjaan
            FROM mr_bulan a
            LEFT JOIN tr_capaian_pekerjaan b ON a.id = MONTH (b.tanggal_mulai)
            AND b.id_pegawai = '".$id."'
            AND b.status_pekerjaan = 1
            AND YEAR(b.tanggal_mulai) = '".$tahun."'
            GROUP BY a.nama_bulan
            ORDER BY a.id";
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
