<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/PHPExcel.php";
class Master_skp extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('mskp', '', TRUE);
		$this->load->model ('transaksi/mtrx', '', TRUE);
		$this->load->model ('master/Mmaster', '', TRUE);
		$this->load->library('Excel');
		$this->load->library('image_lib');
		$this->load->library('upload');
		date_default_timezone_set('Asia/Jakarta');
	}

	private $year_system = 2023;

	public function index()
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->user_access_read();		
		$this->Globalrules->notif_message();
		$data['title']        = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Master SKP';
		$data['subtitle']     = '';
		$data['content']      = 'skp/master_skp';
		$data['es1']          = $this->Allcrud->listData('mr_eselon1');
		$data['jenis_posisi'] = $this->Allcrud->listData('mr_kat_posisi');
		$data['class_posisi'] = $this->Mmaster->get_posisi_class();
		$data['katpos']       = $this->Allcrud->listData('mr_kat_posisi');
		$this->load->view('templateAdmin',$data);
	}	

	public function filter_data_master_skp($value='')
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$data_sender = array
						(
							'eselon1' => $data_sender['data_1'],
							'eselon2' => $data_sender['data_2'],
							'eselon3' => $data_sender['data_3'],
							'eselon4' => $data_sender['data_4']
						);

		$data = $this->get_data_master_skp($data_sender);
		$this->load->view('skp/ajax_master_skp',$data);
	}

	public function get_data_master_skp($data_sender)
	{
		# code...
		$data['list']         = $this->Mmaster->get_struktur_organisasi($data_sender,1);
		if ($data['list'] != 0) {
			# code...
			$xx = 0;
			$data['data_counter']['ready'] = 0;			
			for ($i=0; $i < count($data['list']); $i++) {
				# code...
				$get_summary_urtug = $this->mskp->get_summary_master_skp($data['list'][$i]->id);
				if ($get_summary_urtug != 0) {
					# code...
					$xx++;
					$data['data_counter']['ready']      = $data['data_counter']['ready'] + 1;
					$data['list'][$i]->is_master_skp    = 'ready';
					$data['list'][$i]->count_master_skp = $get_summary_urtug;
				}
				else
				{
					$data['list'][$i]->is_master_skp = 'not-ready';
					$data['list'][$i]->count_master_skp = 0;
				}
			}

			$data['data_counter']['ready'] = $xx;			
		}

		return $data;
	}

	public function master_skp_posisi($id)
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$data['title']    = '<b>SKP</b> <i class="fa fa-angle-double-right"></i> Master SKP - Detail';
		$data['subtitle'] = '';
		$data['info']     = $this->Allcrud->getData('mr_posisi',array('id' => $id))->result_array();
		$data['list']     = $this->mskp->get_master_skp_id($id,'posisi');
		$data['content']  = 'skp/skp_master_posisi';
		$data['satuan']   = $this->Allcrud->listData('mr_skp_satuan');
		$data['jenis']    = $this->Allcrud->listData('mr_skp_jenis');
		$data['oid']      = $id;
		$this->load->view('templateAdmin',$data);
	}

	public function delete_master_skp_posisi($id)
	{
		# code...
		$res_data    = $this->Allcrud->delData('mr_skp_master',array('posisi'=>$id));
		$res_data    = $this->Allcrud->delData('mr_skp_pegawai',array('id_posisi'=>$id));		
		$text_status = $this->Globalrules->check_status_res($res_data,'Data Uraian Tugas berhasil dihapus.');
		$res         = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}	

	public function template_master_skp($id)
	{
		# code...
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 300);
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Template Unggah Master SKP');
		$this->excel->getActiveSheet()->getStyle('a4:c4')->getBorders()->getallborders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$this->excel->getActiveSheet()->setCellValue('a1', 'Note : Gunakan karakter + untuk melakukan penambahan data didalam kolom id. Apabila ada field yang kosong, Harap isi dengan karakter -. Diharapkan semua field terisi.');
		$this->excel->getActiveSheet()->setCellValue('a2', 'Posisi ID : ');
		$this->excel->getActiveSheet()->setCellValue('b2', $id);

		$this->excel->getActiveSheet()->setCellValue('a4', 'id');
		$this->excel->getActiveSheet()->setCellValue('b4', 'Kegiatan');
		$this->excel->getActiveSheet()->setCellValue('c4', 'Keterangan');

		ob_clean();

		$filename='Template Unggah Master SKP - '.date("d-m-Y").'.xlsx'; //save our workbook as this file name
		//header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type excel 2007
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		exit();
		redirect('master_skp_posisi/'.$id, false);
	}

	public function import_master_skp($id)
	{
		# code...
		$data_store = "";
		if($_FILES['userfile']['error'] == 4)
		{
			return false;
		}

		$config['upload_path']        = './public/excel/';
		$config['allowed_types']      = 'xls|xlsx';
		$config['max_size']           = 20000;

        $this->load->library('upload');
        $this->upload->initialize($config);

        // print_r($_FILES['userfile']);die();

        if( $this->upload->do_upload('userfile') )
        {
			//load the excel library
			$this->load->library('excel');

			$dataImage     = $this->upload->data();

			//read file from path
			$objPHPExcel = PHPExcel_IOFactory::load($dataImage['full_path']);

			//get only the Cell Collection
			$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
			//extract to a PHP readable array format
			foreach ($cell_collection as $cell) {
				$column     = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
				$row        = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
				$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

			    //header will/should be in row 1 only. of course this can be modified to suit your need.
			    if ($row == 1) {
			        $header[$row][$column] = $data_value;
			    } else
			    {
			    	if ($row == 2) {
			    		# code...
			    	}
			    	elseif ($row == 4) {
			    		# code...
				        $header[$row][$column] = $data_value;
			    	}
			    	else
			    	{
			        	$arr_data[$row][$column] = $data_value;
			    	}
			    }
			}

			//send the data in an array format
			$data['values'] = $arr_data;

			$data_count = (5+count($data['values']));
			for ($i=5; $i < $data_count; $i++) {
				# code...
				$data_store        = array
									(
										'posisi'     => $id,
										'kegiatan'   => $data['values'][$i]['B'],
										// 'keterangan' => $data['values'][$i]['C'],
										'status'     => 1
								);
				if ($data['values'][$i]['A'] == '+') {
					# code...
					$res_data = $this->Allcrud->addData('mr_skp_master',$data_store);
				}
			}
			$link = 'skp/master_skp_posisi/'.$id;
			redirect($link);
        }
        else
        {
            echo $this->upload->display_errors();
        }
	}	
	
	public function get_master_skp_id($id)
	{
		# code...
		$res_data = $this->mskp->get_master_skp_id($id,'id');
		echo json_encode($res_data);
	}

	public function active_skp_master($id,$stat)
	{
		# code...
		$res_data  = $this->Allcrud->editData('mr_skp_master',array('status' => $stat),array('id_skp' => $id));
		$text_status = $this->Globalrules->check_status_res($res_data,"Status telah diubah.");
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);				
	}	

	public function add_master_skp_posisi($OID)
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$data        = array
					(
						'posisi'     => $OID,
						'status'     => 1,
						'keterangan' => $data_sender['keterangan'],
						'kegiatan'   => $data_sender['kegiatan']
					);		
		$res_data    = $this->Allcrud->addData('mr_skp_master',$data);
		$text_status = $this->Globalrules->check_status_res($res_data,'Master SKP telah ditambahkan.');
		$res         = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function edit_master_skp()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$data        = array
					(
						'kegiatan'   => $data_sender['kegiatan'],
						'keterangan' => $data_sender['keterangan']
					);
		$flag        = array('id_skp'=>$data_sender['id']);
		$res_data    = $this->Allcrud->editData('mr_skp_master',$data,$flag);
		$text_status = $this->Globalrules->check_status_res($res_data,'SKP telah diubah.');
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}








}
  