<?php 
	
class Allcrud extends CI_Model {

	public function __construct () {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');				
	}

	public function listData($table)
	{
		$query = $this->db->get($table);
		return $query;
	}

	public function addData($table,$data){
		$query = $this->db->insert($table,$data);
		return $query;
	}

	public function addData_with_return_id($table,$data){
		$query     = $this->db->insert($table,$data);
		$insert_id = $this->db->insert_id();
		
		return  $insert_id;		
	}	

	public function delData($table,$flag){
		$this->db->where($flag);
		$query = $this->db->delete($table);
		return $query;
	}

	public function getData($table,$flag,$like=NULL){
		$this->db->where($flag);
		if ($like != NULL) {
			# code...
			$this->db->like($like);			
		}
		return $this->db->get($table);
	}

	public function editData($table,$data,$flag){
		$this->db->where($flag);
		return $this->db->update($table,$data);
	}

	public function approve_transaksi($id_tran,$id_atasan){
		$SQL = "call approve_tran($id_tran,$id_atasan)";
		$query = $this->db->query($SQL);
		// print_r($query);die();
        return $this->db->affected_rows();
	}
}