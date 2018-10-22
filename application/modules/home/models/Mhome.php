<?php

class Mhome extends CI_Model {

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

}
