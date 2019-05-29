<?php

class Mdashboard extends CI_Model 
{
	public function __construct () 
	{
		parent::__construct();
	
	}

	public function check_data_menit_efektif_rpt()
	{
		# code...
		$bulan = date('m');
		$tahun = date('Y'); 
		$sql = "SELECT
					a.id_pegawai,
					a.bulan,
					a.tahun,
					a.tr_approve,
					a.menit_efektif,
					b.jml_menit AS tr_Menit_efektif
				FROM
					rpt_capaian_kinerja a
				LEFT JOIN (
					SELECT
						id_pegawai,
						SUM(`menit_efektif`) jml_menit
					FROM
						`tr_capaian_pekerjaan`
					WHERE
						MONTH (`tanggal_mulai`) = 4
					AND `status_pekerjaan` = 1
					GROUP BY
						`id_pegawai`
				) b ON b.id_pegawai = a.id_pegawai
				WHERE a.bulan = 4
				AND a.menit_efektif <> b.jml_menit";
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

	public function get_data_menit_efektif($param)
	{
		# code...
		$bulan = date('m');
		$tahun = date('Y'); 
		$sql = "SELECT SUM(".$param.") as jumlah
				FROM tr_capaian_pekerjaan a
				JOIN mr_skp_pegawai b ON a.id_uraian_tugas = b.skp_id
				JOIN mr_pegawai c ON a.id_pegawai = c.id
				WHERE a.tanggal_mulai LIKE '%".date('Y-m')."%'
				AND a.tanggal_selesai LIKE '%".date('Y-m')."%'
				AND a.id_pegawai = '".$this->session->userdata('sesUser')."'
				AND a.status_pekerjaan = '1'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result()[0]->jumlah;
		}
		else
		{
			return 0;
		}								
	}

	public function get_data_notify_user($param,$id_pegawai)
	{
		# code...
		$sql = "SELECT a.*
				FROM log_notifikasi a
				WHERE a.receiver = '".$id_pegawai."'
				AND a.status_log = '".$param."'";
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
	
	public function get_history_golongan()
	{
		# code...
		$sql = "SELECT a.*,
						b.nama_pangkat
				FROM mr_history_golongan a
				JOIN mr_golongan b
				ON a.id_golongan = b.id
				WHERE a.id_pegawai = '".$this->session->userdata('sesUser')."'
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

	public function get_data_dashboard($set_menit_efektif=NULL)
	{
	 	# code...
	 	$bulan = date('m');
	 	$tahun = date('Y'); 
	 	#JOIN mr_skp_pegawai b ON a.id_uraian_tugas = b.skp_id
	 	$sql = "SELECT  CASE WHEN SUM(menit_efektif)>=".$set_menit_efektif." THEN 100
					ELSE
						ROUND(SUM(`menit_efektif`)/".$set_menit_efektif." * 100,2) 
					END AS prosentase_menit_efektif,
					SUM(`menit_efektif`) AS menit_efektif,
					CASE WHEN SUM(menit_efektif)>=".$set_menit_efektif." THEN cls.tunjangan * 0.5
					ELSE
						ROUND(SUM(`menit_efektif`)/".$set_menit_efektif." * cls.tunjangan * 0.5,0)
					END AS tunjangankinerja,
					cls.posisi_class,
					cls.tunjangan
				FROM tr_capaian_pekerjaan a
				JOIN mr_pegawai c ON a.id_pegawai = c.id
				JOIN mr_posisi pos ON pos.id = c.posisi
				JOIN `mr_posisi_class` cls ON cls.id=pos.posisi_class
	 			WHERE a.tanggal_mulai LIKE '%".date('Y-m')."%'
	 			AND a.tanggal_selesai LIKE '%".date('Y-m')."%'
	 			AND a.id_pegawai = '".$this->session->userdata('sesUser')."'
	 			AND a.status_pekerjaan = '1'";
	 	
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