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

	public function getData($table,$flag){
		$this->db->where($flag);
		return $this->db->get($table);
	}

	public function editData($table,$data,$flag){
		$this->db->where($flag);
		return $this->db->update($table,$data);
	}

/*
write by Bryan Setyawan
last edited : 27/06/2016
*/
	public function session_rule()
	{
		if($this->session->userdata('sesNama') == "")
		{
			//get user data
			redirect('admin/loginadmin');
		}		
	}         	

/*
write by Bryan Setyawan
last edited : 25/06/2016
*/
	public function data_bulan()
	{
		$data_bulan = array
					(
						1  => array('nama' => "Januari"),
						2  => array('nama' => "Februari"),
						3  => array('nama' => "Maret"),
						4  => array('nama' => "April"),
						5  => array('nama' => "Mei"),
						6  => array('nama' => "Juni"),
						7  => array('nama' => "Juli"),
						8  => array('nama' => "Agustus"),
						9  => array('nama' => "Sebtember"),
						10 => array('nama' => "Oktober"),
						11 => array('nama' => "November"),
						12 => array('nama' => "Desember")
					);

		return $data_bulan;	
	}         		

/*
write by Bryan Setyawan
last edited : 25/06/2016
*/
	public function set_bulan($bulan)
	{
		$data_bulan = $this->data_bulan();
		$nama_bulan = "";

		for ($i=1; $i <= count($data_bulan); $i++) { 
			# code...

			if ($bulan == $i) {
				# code...
				$nama_bulan = $data_bulan[$i]['nama']; 
			}

		}

		return $nama_bulan;	
	}         			

/*
Last Edited : 28/07/2016
By: Bryan Setyawan
*/
	public function set_captcha($value=NULL,$flag=NULL)
	{
		$cookies = get_cookie('oid');
		if ($cookies == "" || $flag == 0)
		{
			$res             = $value;     			
			$this->input->set_cookie("oid", $res, 10800);			
			
		}		
	}	

/*
Last Edited : 28/07/2016
By: Bryan Setyawan
*/
	public function notif_message()
		{
		$count_inbox = "";
		$count_send  = "";
		$id_penerima = $this->session->userdata('sesUser');
		$sql_inbox = "SELECT DISTINCT count(a.id_pesan) as `row`
				    FROM pesan a
				    WHERE a.id_penerima = '$id_penerima'
				    AND a.flag_read <> 1
				    AND a.flag_delete_inbox <> 1";

		$sql_send = "SELECT DISTINCT count(a.id_pesan) as `row`
				    FROM pesan a
				    WHERE a.id_pengirim = '$id_penerima'
				    AND a.audit_pengguna = '$id_penerima'
				    AND a.flag_delete_sent <> 1";			    

		$query_inbox = $this->db->query($sql_inbox);
		$query_send  = $this->db->query($sql_send);		

		if($query_inbox->num_rows() > 0)
		{
			$count_inbox = $query_inbox->result();
			$count_inbox = $count_inbox[0]->row;
		}
		else
		{
			$count_inbox = 0;
		}					

		if($query_send->num_rows() > 0)
		{
			$count_send = $query_send->result();
			$count_send = $count_send[0]->row;
		}
		else
		{
			$count_send = 0;
		}							

		$this->input->set_cookie("row_send", $count_send, 3600);							
		$this->input->set_cookie("row_inbox", $count_inbox, 3600);							
		return $count_inbox;			
	}		

/*
Last Edited : 12/07/2016
By: Bryan Setyawan
*/
	public function randomCode($length)
	{ 
	    $retVal = ""; 
	    while(strlen($retVal) < $length)
	    { 
	        $nextChar = mt_rand(0, 61); // 10 digits + 26 uppercase + 26 lowercase = 62 chars 
	        if(($nextChar >=10) && ($nextChar < 36)){ // uppercase letters 
	            $nextChar -= 10; // bases the number at 0 instead of 10 
	            $nextChar = chr($nextChar + 65); // ord('A') == 65 
	        } else if($nextChar >= 36){ // lowercase letters 
	            $nextChar -= 36; // bases the number at 0 instead of 36 
	            $nextChar = chr($nextChar + 97); // ord('a') == 97 
	        } else { // 0-9 
	            $nextChar = chr($nextChar + 48); // ord('0') == 48 
	        } 
	        $retVal .= $nextChar; 
	    } 
	    return $retVal; 
	} 		

/*
Last Edited : 12/07/2016
By: Bryan Setyawan
*/
	public function set_captcha_number($flag=NULL)
	{
		$cookies = get_cookie('oid');
		$res = "";
		if ($cookies == "" || $flag == 0)
		{
			$res             = $this->Allcrud->randomCode(6);    
			$this->input->set_cookie("oid", $res, 10800);					
		}
		return $res;		
	}	

}