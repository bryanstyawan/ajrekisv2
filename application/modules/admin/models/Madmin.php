<?php

class Madmin extends CI_Model {

 	public function __construct () {
		parent::__construct();
	
	}
	
	public function datauser()
	{
		$this->db->from('user a');
		$this->db->join('user_role b','a.id_role=b.id_role');
		$query = $this->db->get();
		return $query;
	}
	public function dataurtug($flag,$num,$offset){
		$this->db->where($flag);
		$this->db->select(" a.*, b.* ");
		$this->db->from('mr_posisi a');
		$this->db->join('urtug b','a.id=b.posisi');
		$this->db->order_by('posisi ASC');
		$this->db->limit($num,$offset);
		$query = $this->db->get();
		return $query;
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
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return 0;
		}								
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
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return 0;
		}								
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
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return 0;
		}								
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