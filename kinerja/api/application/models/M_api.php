<?php

class M_api extends CI_Model {

    public function __construct () {
		parent::__construct();
	}
	
	public function get_pegawai($nip=NULL)
	{
		# code...
		$sql = "SELECT a.*
				FROM mr_pegawai a
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
    
	public function get_transact($nip=NULL,$status=NULL,$bulan=NULL,$tahun=NULL)
	{
		// print_r($nip);die();
		if ($nip == NULL) {
			# code...
			$nip = "0";
		}
		$sql = "SELECT a.id_pegawai,
						a.tanggal_mulai,
						c.nama_pegawai,
						c.nip,
						(
							CASE d.kat_posisi
								WHEN 1 THEN (e.tunjangan/2)
								WHEN 2 THEN (cls_jft.tunjangan/2)
								WHEN 4 THEN (cls_jfu.tunjangan/2)
							END								
						) as tunjangan_kinerja_sistem,
--						(e.tunjangan/2) AS tunjangan_kinerja_sistem,
						a.status_pekerjaan,
						MONTH(a.tanggal_mulai) AS `month`,
						(b.jml_hari_aktif*b.jml_menit_perhari) AS menit_efektif_sistem,
						SUM(a.menit_efektif) AS menit_efektif,
						Count(a.status_pekerjaan) AS count_status_pekerjaan,
						SUM(a.tunjangan) AS tunjangan_kinerja,
						((SUM(a.menit_efektif)/(b.jml_hari_aktif*b.jml_menit_perhari))*100) AS prosentase,
						IF(((SUM(a.menit_efektif) / (b.jml_hari_aktif * b.jml_menit_perhari)) * 100) > 100,((CASE d.kat_posisi WHEN 1 THEN (e.tunjangan)WHEN 2 THEN (cls_jft.tunjangan)WHEN 4 THEN (cls_jfu.tunjangan)END) / 2),SUM(a.tunjangan)) AS real_tunjangan_kinerja,
						IF(((SUM(a.menit_efektif) / (b.jml_hari_aktif * b.jml_menit_perhari)) * 100) > 100,100,((SUM(a.menit_efektif) / (b.jml_hari_aktif * b.jml_menit_perhari)) * 100)) AS real_prosentase,
							COALESCE((
									SELECT IF(COALESCE(aa.keterangan,'-')='-','-','Tugas Belajar')
									FROM mr_tugas_belajar aa
									WHERE aa.id_pegawai = a.id_pegawai
									AND (a.tanggal_mulai BETWEEN aa.tgl_mulai AND aa.tgl_selesai)
							 ),'-') AS tugas_belajar,
							COALESCE((
									SELECT bb.tunjangan
									FROM mr_tunjangan_profesi bb
									WHERE bb.id_pegawai = a.id_pegawai
									AND bb.tgl_selesai LIKE '%9999-01-01%'
							 ),'0') AS tunjangan_profesi,
							COALESCE((
									SELECT cc.total/2
									FROM tr_import_tunkir_produktivitas_disiplin cc
									WHERE cc.nip = c.nip
									AND cc.bulan = ".$bulan."
							 ),'0') AS tunjangan_disiplin
				FROM tr_capaian_pekerjaan a
				LEFT JOIN mr_hari_aktif b ON b.bulan = MONTH(a.tanggal_mulai)
				LEFT JOIN mr_pegawai c ON a.id_pegawai = c.id
				LEFT JOIN mr_posisi d ON c.posisi = d.id
				LEFT JOIN mr_posisi_class e ON e.id = d.posisi_class
				LEFT JOIN mr_jabatan_fungsional_tertentu jft ON d.id_jft  = jft.id
				LEFT JOIN mr_posisi_class cls_jft ON jft.id_kelas_jabatan = cls_jft.id
				LEFT JOIN mr_jabatan_fungsional_umum jfu ON d.id_jfu      = jfu.id
				LEFT JOIN mr_posisi_class cls_jfu ON jfu.id_kelas_jabatan = cls_jfu.id				
				WHERE a.status_pekerjaan = ".$status."
				AND MONTH(a.tanggal_mulai) = ".$bulan."
				AND YEAR(a.tanggal_mulai) = ".$tahun."
				AND c.nip = ".$nip."
                AND b.tahun = '".$tahun."'";
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


  public function get_menit_efektif_year($id)
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
            AND YEAR(b.tanggal_mulai) = '".date('Y')."'
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



































/*
Create by : Bryan Setyawan Putra
Last edit : 27/07/2016
*/
	public function rekap_kinerja(
								$flag    =NULL,
								$bulan   =NULL,
								$tahun   =NULL,
								$eselon1 =NULL,
								$eselon2 =NULL,
								$eselon3 =NULL,
								$eselon4 =NULL
							)
	{
		$sql_limit = "";

		if ($flag == 'this_is_export') {
			# code...
			$sql_limit = "";
		}
		elseif ($flag == 'preview') {
			# code...
			$sql_limit = "LIMIT 100";
		}
		else
		{
			$sql_limit = "LIMIT 50";
		}

		$sql = "SELECT DISTINCT a.nama_pegawai,
								a.nip,
								b.nama_posisi,
								a.id as `id_pegawai`,
								c.tunjangan,
								c.posisi_class,
								c.tunjangan as `tunjangan_posisi`,
								b.eselon1,
								b.eselon2,
								b.eselon3,
								b.eselon4
			    FROM mr_pegawai a
			    JOIN mr_posisi b
			    ON a.posisi = b.id
			    JOIN mr_posisi_class c
			    ON b.posisi_class = c.id
			    WHERE b.eselon1 = '$eselon1'
				OR b.eselon2   = '$eselon2'
				OR b.eselon3   = '$eselon3'
				OR b.eselon4   = '$eselon4'
			    ORDER BY a.nama_pegawai asc
			    $sql_limit";


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

/*
Create by : Bryan Setyawan Putra
Last edit : 19/07/2016
*/
	public function rekap_kinerja_wrap($id_pegawai)
	{
		$sql = "SELECT DISTINCT SUM(a.jam_kerja) as `jam_kerja`,
								a.nama_pekerjaan,
								a.output_pekerjaan,
								DATE_FORMAT(a.tgl_mulai, '%d-%m-%Y') as tgl_mulai,
								DATE_FORMAT(a.tgl_mulai, '%H:%s') as jam_mulai,
								DATE_FORMAT(a.tgl_selesai, '%d-%m-%Y') as tgl_selesai,
								DATE_FORMAT(a.tgl_selesai, '%H:%s') as jam_selesai
			    FROM trx_detail a
			    WHERE a.id_pegawai = '$id_pegawai'
			    ";
			    //			    AND DATE_FORMAT(a.date, '$date_format_sql') BETWEEN '".$newDate."' AND '".$newDate1."'
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

/*
Create by : Bryan Setyawan Putra
Last edit : 19/07/2016
*/
	public function rekap_kinerja_stat($id_pegawai,$stat)
	{
		$sql = "SELECT DISTINCT count(a.id_trx_detail) as data_stat
			    FROM trx_detail a
			    WHERE a.id_pegawai = '$id_pegawai'
			    AND a.stat = '$stat'";
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

/*
Create by : Bryan Setyawan Putra
Last edit : 27/07/2016
*/
	public function get_eselon($type,$flag=NULL,$value=NULL)
	{
		$sql_table       = "";
		$sql             = "";
		$sql_where       = "";
		$sql_nama_eselon = "";

		switch ($type) {
			case '1':
				# code...
				$sql_table       = "mr_eselon1";
				$sql_where       = "";
				$sql_nama_eselon = "nama_eselon1";
				break;
			case '2':
				$sql_table = "mr_eselon2";
				$sql_where = "id_es1 = '$value'";
				$sql_nama_eselon = "nama_eselon2";
				break;
			case '3':
				$sql_table = "mr_eselon3";
				$sql_where = "id_es2 = '$value'";
				$sql_nama_eselon = "nama_eselon3";
				break;
			case '4':
				$sql_table = "mr_eselon4";
				$sql_where = "id_es3 = '$value'";
				$sql_nama_eselon = "nama_eselon4";
				break;
		}

		if ($flag != "ajax") {
			# code...
			$sql = "SELECT *
				    FROM $sql_table
				    ORDER BY $sql_nama_eselon asc";
		}
		else
		{
			$sql = "SELECT *
				    FROM $sql_table
				    WHERE $sql_where
				    ORDER BY $sql_nama_eselon asc";
		}


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
