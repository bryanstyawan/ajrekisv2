<?php
class Mmonitoring extends CI_Model
{
	public function __construct () {
		parent::__construct();
	}

	public function get_data_report_bug()
	{
		// code...
		//0 = masuk
		//1 = proses / revisi
		//2 = Butuh verifikasi
		//3 = selesai
		//4 = pending
		$sql = "SELECT DISTINCT a.*, pel.nama_pegawai, pel.nip, bfstat.nama as status_report
				FROM tr_request_bug_fixing_fitur a
				LEFT JOIN mr_pegawai pel ON a.id_pegawai = pel.id
				LEFT JOIN lt_bug_fixing_status bfstat ON a.status = bfstat.id				
				WHERE a.status <> 4
				ORDER BY a.status ASC, a.audit_time ASC";
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

	public function get_data_report_bug_by_status($data)
	{
		// code...
		//0 = masuk
		//1 = proses / revisi
		//2 = Butuh verifikasi
		//3 = selesai
		//4 = pending
		$order = "";
		if ($data['value'] == 'status') {
			# code...
			$order = "a.status ASC, a.audit_time DESC";
		}
		else
		{
			$order = "a.status ASC, a.audit_time ASC";			
		}

		$sql = "SELECT DISTINCT a.*, pel.nama_pegawai, pel.nip, bfstat.nama as status_report
				FROM tr_request_bug_fixing_fitur a
				LEFT JOIN mr_pegawai pel ON a.id_pegawai = pel.id
				LEFT JOIN lt_bug_fixing_status bfstat ON a.status = bfstat.id				
				WHERE ".$data['name']." = ".$data['value']."
				ORDER BY ".$order."";
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
						b.eselon1,
						b.eselon2,
						b.eselon3,
						b.eselon4,
						rptp.nilai_prilaku_kerja,
						rpts.nilai_capaian_skp,
						rpts.nilai_sasaran_kinerja_pegawai,
						(
							rpts.nilai_sasaran_kinerja_pegawai + rptp.nilai_prilaku_kerja
						) AS total_skp,
						rpts.id_posisi AS id_posisi_ts,
						rptp.tahun as tahun_1,
						rpts.tahun as tahun_2
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
					AND rpts.tahun = '".$flag['tahun']."'					
					LEFT JOIN mr_posisi pos1 ON rpts.id_posisi = pos1.id					
					WHERE a. STATUS = '1'
					AND	a.id_role <> 7
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
