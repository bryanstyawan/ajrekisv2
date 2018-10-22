
<?php
/*
write by Bryan Setyawan
last edited : 27/06/2016
*/
class Set_rules extends CI_Model {

 	function __construct () {
		parent::__construct();
	
	}
/*
write by Bryan Setyawan
last edited : 27/06/2016
*/
	function session_rule()
	{
		if($this->session->userdata('sesNama') == "")
		{
			//get user data
			redirect('admin/loginAdmin');
		}		
	}         	
}