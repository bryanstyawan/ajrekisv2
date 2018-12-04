<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/PHPExcel.php";
class Config extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('mconfig', '', TRUE);
		$this->load->model ('transaksi/mtrx', '', TRUE);
		$this->load->model ('master/Mmaster', '', TRUE);
		$this->load->library('Excel');
		$this->load->library('image_lib');
		$this->load->library('upload');
		date_default_timezone_set('Asia/Jakarta');
		$this->Globalrules->session_rule();		
	}

	public function management_menu_submenu()
	{
		$this->root_menu(0);
	}

	public function submenu($id=NULL)
	{
		$this->root_menu($id);
	}	

	public function root_menu($id=NULL)
	{
		# code...
		$this->Globalrules->session_rule();		
		$this->Globalrules->notif_message();
		$data['title']    = 'Management Menu '.$this->get_header($id);
		$data['subtitle'] = '';
		$data['list']     = $this->mconfig->get_menu($id);
		$data['flag']     = $this->Allcrud->listData('config_menu_flag')->result_array();
		$data['content']  = 'config/management_menu/home';
		$this->load->view('templateAdmin',$data);		
	}

	public function get_header($id)
	{
		# code...
		$name = "";
		if ($id == 0) {
			# code...
			$name = "";
		}
		else {
			# code...
			$header = $this->Allcrud->getData('config_menu',array('id_menu'=>$id))->result_array();
			if ($header != array()) {
				# code...
				$name = "<i class='fa fa-angle-double-right'></i> ".$header[0]['nama_menu'];
			}
		}

		return $name;
	}

	public function add_menu($id=NULL)
	{
		# code...
		if ($id == NULL) {
			# code...
			$id = 0;
		}
		$data_sender = $this->input->post('data_sender');
		$data        = array
						(
							'nama_menu' => $data_sender['nama_menu'],
							'url_pages' => $data_sender['url_pages'],
							'icon'      => $data_sender['icon'],
							'flag'      => $data_sender['flag'],
							'prioritas' => $data_sender['prioritas'],
							'id_parent' => $id
						);
		$res_data    = $this->Allcrud->addData('config_menu',$data);
		$text_status = $this->Globalrules->check_status_res($res_data,'Menu telah ditambahkan');
		$res         = array
						(
							'status' => $res_data,
							'text'   => $text_status
						);
		echo json_encode($res);
	}

	public function get_active($arg,$param)
	{
		# code...
		$data        = array
						(
							'flag'      => $param
						);
		$res_data    = $this->Allcrud->editData('config_menu',$data,array('id_menu' => $arg));
		$text_status = $this->Globalrules->check_status_res($res_data,'Status menu telah dirubah');
		$res         = array
						(
							'status' => $res_data,
							'text'   => $text_status
						);
		echo json_encode($res);		
	}

	public function delete_menu($id)
	{
		# code...
		$res_data    = $this->Allcrud->delData('config_menu',array('id_menu' => $id));
		$text_status = $this->Globalrules->check_status_res($res_data,'Menu telah dihapus');
		$res         = array
						(
							'status' => $res_data,
							'text'   => $text_status
						);
		echo json_encode($res);				
	}

	public function get_menu($id)
	{
		# code...
		$flag = array('id_menu'=>$id);
		$q    = $this->Allcrud->getData('config_menu',$flag)->result_array();
		echo json_encode($q);		
	}

	public function edit_menu($oid)
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$data        = array
						(
							'nama_menu' => $data_sender['nama_menu'],
							'url_pages' => $data_sender['url_pages'],
							'icon'      => $data_sender['icon'],
							'prioritas' => $data_sender['prioritas'],							
							'flag'      => $data_sender['flag']
						);
		$res_data    = $this->Allcrud->editData('config_menu',$data,array('id_menu' => $oid));						
		$text_status = $this->Globalrules->check_status_res($res_data,'Menu telah diubah');
		$res         = array
						(
							'status' => $res_data,
							'text'   => $text_status
						);
		echo json_encode($res);		
	}
}
