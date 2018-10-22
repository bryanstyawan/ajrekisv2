<?php
class Mpesan extends CI_Model {

 	public function __construct () {
		parent::__construct();
	}

	public function inbox($flag){
		$id_penerima = $this->session->userdata('sesUser');		
		$sql = "SELECT DISTINCT a.*, 
								b.nama_pegawai as `nama_pengirim`
			    FROM pesan a
			    JOIN mr_pegawai b
			    ON a.id_pengirim = b.id
			    WHERE a.id_penerima = '$id_penerima'
			    AND a.flag_delete_inbox <> 1
			    ORDER BY a.tgl_system asc";
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
	
	public function sent($flag){
		$id_pengirim = $this->session->userdata('sesUser');				
		$sql = "SELECT DISTINCT a.*, 
								b.nama_pegawai as `nama_pengirim`
			    FROM pesan a
			    JOIN mr_pegawai b
			    ON a.id_penerima = b.id
			    WHERE a.id_pengirim = '$id_pengirim'
			    AND a.audit_pengguna = '$id_pengirim'
			    AND a.flag_delete_sent <> 1			    
			    ORDER BY a.tgl_system asc";
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

	public function contact($flag=NULL)
	{
		# code...
		$atasan = $flag['posisi'];
		$sql = "SELECT DISTINCT a.*,
								a.id as `id_pegawai`,
								b.nama_posisi
			    FROM mr_pegawai a
			    JOIN mr_posisi b 
			    ON a.posisi = b.id
			    WHERE b.atasan = '$atasan'
			    ORDER BY a.nama_pegawai asc";
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

	public function contact_atasan($flag=NULL)
	{
		# code...
		$posisi = $flag['posisi'];
		$sql = "SELECT DISTINCT b.*,
								b.id AS `id_pegawai`,
								a.nama_posisi
			    FROM mr_posisi a
			    JOIN mr_pegawai b 
			    ON a.atasan = b.posisi
			    WHERE a.id = '$posisi'";
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

	public function get_sender($data_sender)
	{
		# code...
		$nama_pegawai = $data_sender;
		$sql = "SELECT DISTINCT a.*
			    FROM mr_pegawai a
			    WHERE a.nama_pegawai = '$nama_pegawai'";
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

	public function send_chat($param)
	{
		$this->db->insert('pesan', $param);
		return $this->db->affected_rows();
	}		
		
	public function update_read_message($data_table)
	{
		$data_change = $data_table['flag_read'];
		$data_container = array
								(
									'flag_read' => $data_change 
								);
		try {			
			$this->db->where('id_pesan', $data_table['id_pesan']);
			$result = $this->db->update('pesan',$data_container);
			return $result;

		} catch (Exception $e) {
			return NULL;
		}		
	}

	public function update_delete_message_inbox($data_table)
	{
		$data_change = $data_table['flag_delete_inbox'];
		$data_container = array
								(
									'flag_delete_inbox' => $data_change 
								);
		try {			
			$this->db->where('id_pesan', $data_table['id_pesan']);
			$result = $this->db->update('pesan',$data_container);
			return $result;

		} catch (Exception $e) {
			return NULL;
		}		
	}	

	public function update_delete_message_sent($data_table)
	{
		$data_change = $data_table['flag_delete_sent'];
		$data_container = array
								(
									'flag_delete_sent' => $data_change 
								);
		try {			
			$this->db->where('id_pesan', $data_table['id_pesan']);
			$result = $this->db->update('pesan',$data_container);
			return $result;

		} catch (Exception $e) {
			return NULL;
		}		
	}		

	public function get_message_sent($id=NULL)
	{
		# code...
		$sql = "SELECT DISTINCT a.*,
								b.nama_pegawai as `nama_pengirim` 
			    FROM pesan a
			    JOIN mr_pegawai b
			    ON a.id_penerima = b.id			    
			    WHERE a.id_pesan = '$id'";
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

	public function get_message_inbox($id=NULL)
	{
		# code...
		$sql = "SELECT DISTINCT a.*,
								b.nama_pegawai as `nama_pengirim` 
			    FROM pesan a
			    JOIN mr_pegawai b
			    ON a.id_pengirim = b.id			    
			    WHERE a.id_pesan = '$id'";
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

	public function trash($flag){
		$id_pengirim = $this->session->userdata('sesUser');				
		$sql = "SELECT DISTINCT a.*, 
								b.nama_pegawai as `nama_pengirim`
			    FROM pesan a
			    JOIN mr_pegawai b
			    ON a.id_penerima = b.id
				WHERE a.id_pengirim    = '$id_pengirim'
				OR a.audit_pengguna   = '$id_pengirim'
				OR a.flag_delete_sent = 1
			    OR a.id_penerima = '$id_pengirim'
			    OR a.flag_delete_inbox <> 1							    
			    ORDER BY a.tgl_system asc";
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