<?php
class Mmonitoring extends CI_Model
{
	public function __construct () {
		parent::__construct();
	}

	public function get_data_report_bug_by_time()
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
				ORDER BY a.audit_time ASC";
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
