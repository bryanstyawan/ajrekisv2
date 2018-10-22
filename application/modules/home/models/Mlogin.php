<?php

class Mlogin extends CI_Model {

	public function __construct () 
	{
		parent::__construct();
	}
	
	var $table='mr_pegawai';
	
	public function cekuser($nip,$pass)
	{
		$secured_pass = md5($pass);
		$sql = "SELECT a.*, 
						b.nama_posisi, 
						b.posisi_class,
						b.atasan,
						c.nama_role, 
						es1.nama_eselon1, 
						es2.nama_eselon2, 
						es3.nama_eselon3, 
						es4.nama_eselon4, 
						es1.id_es1, 
						es2.id_es2, 
						es3.id_es3, 
						es4.id_es4,
						d.tunjangan,
						d.posisi_class as `grade`
		FROM mr_pegawai a 
		JOIN mr_posisi b 
		ON b.id       = a.posisi 
		JOIN user_role c 
		ON a.id_role  = c.id_role
		LEFT JOIN mr_eselon4 es4
		ON es4.id_es4 = a.es4
		LEFT JOIN mr_eselon3 es3
		ON es3.id_es3 = es4.id_es3
		LEFT JOIN mr_eselon2 es2
		ON es2.id_es2 = es3.id_es2
		LEFT JOIN mr_eselon1 es1
		ON es1.id_es1 = es2.id_es1
		JOIN mr_posisi_class d
		ON b.posisi_class = d.id		
		WHERE a.nip = '$nip' 
		AND a.password = '$secured_pass'
		AND a.status='1' 
		ORDER BY a.id ASC
		LIMIT 1
		";
		$query = $this->db->query($sql);
		if($query->num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return 0;
		}
		return $query;
	}
	
	public function datauser($id){
		$this->db->where('a.id',$id);
		$this->db->select('a.*, b.nama_role, c.nama_posisi');
		$this->db->from('mr_pegawai a');
		$this->db->join('user_role b','a.id_role=b.id_role');
		$this->db->join('mr_posisi c','a.posisi=c.id');
		return $this->db->get();
	}
	
	public function captcha(){
		$this->db->order_by('id','RANDOM');
		$this->db->limit(1);
		return $this->db->get('captcha');
	}
	
}