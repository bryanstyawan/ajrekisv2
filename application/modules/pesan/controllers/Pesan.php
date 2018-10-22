<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('mpesan', '', TRUE);
	}

	public function index()
	{
		if(!$this->session->userdata('login')){
			redirect('admin/loginadmin');
		}
		$this->Allcrud->notif_message();
		redirect('dashboard/home');
	}

	public function home()
	{
		if(!$this->session->userdata('login')){
			redirect('admin/loginadmin');
		}
		$this->Allcrud->notif_message();
		$flag                = array('posisi'=>$this->session->userdata('sesIdPos'));
		$data['title']       = 'Pesan';
		$data['list']        = $this->mpesan->contact($flag);
		$data['list_atasan'] = $this->mpesan->contact_atasan($flag);
		$data['content'] = 'pesan/pesan/data_inbox';
		$this->load->view('templateAdmin',$data);
	}

	public function compose()
	{
		if(!$this->session->userdata('login')){
			redirect('admin/loginadmin');
		}
		$this->Allcrud->notif_message();
		$data['title']   = 'Pesan';
		$data['content'] = 'pesan/pesan/tulis';
		$this->load->view('templateAdmin',$data);
	}

	public function inbox(){
		if(!$this->session->userdata('login')){
			redirect('admin/loginadmin');
		}
		$this->Allcrud->notif_message();
		$flag         = $this->session->userdata('sesUser');
		$data['list'] = $this->mpesan->inbox($flag);

		if ($data['list'] != 0) {
			# code...
			$row_list = count($data['list']);
			for ($i=0; $i < $row_list; $i++)
			{
				# code...
				$data_container[$i] = array
										(
											'id_pesan'  => $data['list'][$i]->id_pesan,
											'flag_read' => '1'
										);
				$this->mpesan->update_read_message($data_container[$i]);
			}
		}

		$this->load->view('pesan/ajax/inbox',$data);
	}

	public function sent(){
		if(!$this->session->userdata('login')){
			redirect('admin/loginadmin');
		}
		$this->Allcrud->notif_message();
		$flag         = $this->session->userdata('sesUser');
		$data['list'] = $this->mpesan->sent($flag);
		$this->load->view('pesan/ajax/sent',$data);
	}

	public function trash(){
		if(!$this->session->userdata('login')){
			redirect('admin/loginadmin');
		}
		$this->Allcrud->notif_message();
		$flag         = array('id_pengirim'=>$this->session->userdata('sesUser'));
		$data['list'] = $this->mpesan->trash($flag);
		$this->load->view('pesan/ajax/trash',$data);
	}

	public function new_message()
	{
		# code...
		if(!$this->session->userdata('login')){
			redirect('admin/loginadmin');
		}
		$this->Allcrud->notif_message();
		$this->load->view('pesan/ajax/new_message',NULL);
	}

	public function send_chat()
	{
		# code...
		$this->Allcrud->notif_message();
		$data_sender = $this->input->post('data_sender');
		$res_data_id = $this->mpesan->get_sender($data_sender['receiver']);

		$id_receipt  = $res_data_id[0]->id;
		$data_judul  = $data_sender['title'];
		$data_isi    = $data_sender['content'];

		$data_container = array
						(
							'id_pengirim'       => $this->session->userdata('sesUser'),
							'id_penerima'       => $id_receipt,
							'judul_pesan'       => $data_judul,
							'isi_pesan'         => $data_isi,
							'flag_read'         => '0',
							'flag_delete_sent'  => '0',
							'flag_delete_inbox' => '0',
							'audit_pengguna'    => $this->session->userdata('sesUser')
						);
		$res_data = $this->mpesan->send_chat($data_container);

		$text_status = $this->Globalrules->check_status_res($res_data,'Pesan Telah Telah dikirim');
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function view_message()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$this->Allcrud->notif_message();
		$res         = "";
		if ($data_sender['type'] == "sent") {
			# code...
			$res            = $this->mpesan->get_message_sent($data_sender['id']);
			$res_header     = "<b>Pesan Terkirim</b>";
			$res_text_actor = "<b>Ke :</b>";
			$res_data       = true;
			$res_param      = $data_sender['type'];
		}
		elseif ($data_sender['type'] == "inbox") {
			# code...
			$res            = $this->mpesan->get_message_inbox($data_sender['id']);
			$res_header     = "<b>Pesan Masuk</b>";
			$res_text_actor = "<b>Dari :</b>";
			$res_data       = true;
			$res_param      = $data_sender['type'];
		}
		else
		{
			$res_data = false;
		}

		$data['list']       = $res;
		$data['header']     = $res_header;
		$data['text_actor'] = $res_text_actor;
		$data['param']      = $res_param;
		$this->load->view('pesan/ajax/read_message',$data);
	}

	public function delete_message($id=NULL,$param=NULL)
	{
		# code...
		$this->Allcrud->notif_message();
		if ($param == 'sent') {
			# code...
			$data_container = array
									(
										'id_pesan'    => $id,
										'flag_delete_sent' => '1'
									);
			$this->mpesan->update_delete_message_sent($data_container);
		}
		elseif ($param == 'inbox') {
			# code...
			$data_container = array
									(
										'id_pesan'    => $id,
										'flag_delete_inbox' => '1'
									);
			$this->mpesan->update_delete_message_inbox($data_container);
		}
	}
}
