<?php

class Mmaster_api extends CI_Model {

    public function __construct () {
		parent::__construct();
	}
	
	public function get_eselon1()
	{
		# code...
		$sql = "SELECT a.nama_eselon1
				FROM mr_eselon1 a";
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

	public function get_eselon2()
	{
		# code...
		$this->db->select(" e1.nama_eselon1, e2.nama_eselon2");
		$this->db->from("mr_eselon1 e1");
		$this->db->join("mr_eselon2 e2","e1.id_es1=e2.id_es1");
		return $this->db->get()->result_array();
	}
	
	public function get_eselon3()
	{
		# code...
		$this->db->select(" e1.nama_eselon1, e2.nama_eselon2, e3.nama_eselon3 ");
		$this->db->from("mr_eselon1 e1");
		$this->db->join("mr_eselon2 e2","e1.id_es1=e2.id_es1");
		$this->db->join("mr_eselon3 e3","e2.id_es2=e3.id_es2");
		return $this->db->get()->result_array();
	}
	
	public function get_eselon4()
	{
		# code...
		$this->db->select(" e1.nama_eselon1, e2.nama_eselon2, e3.nama_eselon3, e4.nama_eselon4");
		$this->db->from("mr_eselon1 e1");
		$this->db->join("mr_eselon2 e2","e1.id_es1=e2.id_es1");
		$this->db->join("mr_eselon3 e3","e2.id_es2=e3.id_es2");
		$this->db->join("mr_eselon4 e4","e3.id_es3=e4.id_es3");
		return $this->db->get()->result_array();
	}
	
	public function get_pegawai($flag=NULL,$order_by=NULL,$filter=NULL)
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

		if ($flag['kat_posisi'] == '') {
			# code...
			$sql_5 = "";
		}
		else $sql_5 = "AND b.kat_posisi = '".$flag['kat_posisi']."'";		
		$sql = "SELECT
					a.nip,
					a.nama_pegawai,
					COALESCE(es1.nama_eselon1,'-') as nama_eselon1,
					COALESCE(es2.nama_eselon2,'-') as nama_eselon2,
					COALESCE(es3.nama_eselon3,'-') as nama_eselon3,
					COALESCE(es4.nama_eselon4,'-') as nama_eselon4,
					COALESCE(b.nama_posisi,'-') as nama_posisi,
					a.photo AS photo										
				FROM mr_pegawai a
				LEFT JOIN mr_posisi b ON b.id = a.posisi
				LEFT JOIN mr_posisi_class c ON b.posisi_class = c.id
				LEFT JOIN mr_jabatan_fungsional_tertentu jft ON b.id_jft = jft.id
				LEFT JOIN mr_posisi_class cls_jft ON jft.id_kelas_jabatan = cls_jft.id				
				LEFT JOIN mr_jabatan_fungsional_umum jfu ON b.id_jfu = jfu.id
				LEFT JOIN mr_posisi_class cls_jfu ON jfu.id_kelas_jabatan = cls_jfu.id				
				LEFT JOIN mr_eselon1 es1 ON es1.id_es1 = b.eselon1
				LEFT JOIN mr_eselon2 es2 on es2.id_es2 = b.eselon2
				LEFT JOIN mr_eselon3 es3 on es3.id_es3 = b.eselon3
				LEFT JOIN mr_eselon4 es4 on es4.id_es4 = b.eselon4
				WHERE a. STATUS = '1'
				AND a.id_role <> 7
				AND a.id_role <> 6
				".$sql_1."
				".$sql_2."
				".$sql_3."
				".$sql_4."
				".$sql_5."				
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
}
