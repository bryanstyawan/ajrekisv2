<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan_fungsional_umum extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
	
	public function index()
	{
		$this->Allcrud->session_rule();						
		$data['title']   = 'Master Jabatan Fungsional Umum';
		$data['content'] = 'master/jfu/index';
		$data['list']    = $this->res_data();
		$this->load->view('templateAdmin',$data);
	}

	public function res_data($callback=NULL)
	{
		# code...
		if ($callback == NULL) {
			# code...
			return $this->Mmaster->get_data_jfu();			
		}
		elseif ($callback == 'json') {
			# code...
			echo json_encode($this->Mmaster->get_data_jfu());
		}
		elseif ($callback == 'datatable')
		{
			$data['title']   = '';			
			$data['list']    = $this->res_data();
			$this->load->view('master/jfu/list_ajax',$data);
		}
	}

	public function process_data($arg)
	{
		# code...
		$res_data    = "";
		$data_header = $this->input->post('data_header');
		$data_detail = $this->input->post('data_detail');
		
		$oid_header  = $data_header['oid'];
		$data_header = array(
								'id_kelas_jabatan' => $data_header['class_jabatan'],
								'nama_jabatan'     => $data_header['nama_jabatan']
						);

		if ($arg == 'create') {
			# code...
			$res_data_id = $this->Allcrud->addData_with_return_id('mr_jabatan_fungsional_umum',$data_header);
		}
		elseif($arg == 'update') {
			# code...	
			$res_data_id = '';
			$flag        = array('id'=>$oid_header);
			$res_data    = $this->Allcrud->editData('mr_jabatan_fungsional_umum',$data_header,$flag);
		}


		for ($i=0; $i < count($data_detail); $i++) { 
			# code...
			$detail['uraian_tugas'] = $data_detail[$i]['uraian_tugas'];			


			if ($arg == 'create') {
				# code...
				$detail['id_jfu'] = $res_data_id;							
				$res_data = $this->Allcrud->addData('mr_jabatan_fungsional_umum_uraian_tugas',$detail);				
			}
			elseif($arg == 'update') {
				# code...	
				if ($data_detail[$i]['flag'] == 'create') {
					# code...
					$detail['id_jfu'] = $oid_header;							
					$res_data = $this->Allcrud->addData('mr_jabatan_fungsional_umum_uraian_tugas',$detail);				
				} elseif($data_detail[$i]['flag'] == 'update') {
					# code...
					$detail['id_jfu'] = $oid_header;											
					$flag        = array('id'=>$data_detail[$i]['OID']);
					$res_data    = $this->Allcrud->editData('mr_jabatan_fungsional_umum_uraian_tugas',$detail,$flag);				
				}
			}			
		}		

		if ($arg == 'create')$text_status = $this->Globalrules->check_status_res($res_data,'Data Master Jabatan Fungsional Umum telah ditambah');
		elseif($arg == 'update')$text_status = $this->Globalrules->check_status_res($res_data,'Data Master Jabatan Fungsional Umum telah diubah');
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function template_master_jfu()
	{
		# code...
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 300);
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Template Unggah Master JFU');

		$this->excel->getActiveSheet()->setCellValue('a1', 'Note : Gunakan karakter + untuk melakukan penambahan data didalam kolom id. Apabila ada field yang kosong, Harap isi dengan karakter -. Diharapkan semua field terisi.');
		$this->excel->getActiveSheet()->setCellValue('a2', 'Nama Jabatan: ');
		$this->excel->getActiveSheet()->setCellValue('b2', 'Analisis Jabatan Fungsional');
		$this->excel->getActiveSheet()->setCellValue('a3', 'Kelas Jabatan: ');
		$this->excel->getActiveSheet()->setCellValue('b3', '11');

		$this->excel->getActiveSheet()->setCellValue('a6', 'id');
		$this->excel->getActiveSheet()->setCellValue('b6', 'Uraian Tugas');
		$this->excel->getActiveSheet()->setCellValue('c6', 'Keterangan');

		$this->excel->getActiveSheet()->setCellValue('a7', '+');
		$this->excel->getActiveSheet()->setCellValue('b7', 'Test');
		$this->excel->getActiveSheet()->setCellValue('c7', 'Test Keterangan');		

		$this->excel->getActiveSheet()->setCellValue('a8', '+');
		$this->excel->getActiveSheet()->setCellValue('b8', 'Test test untuk keterangan yang kosong');
		$this->excel->getActiveSheet()->setCellValue('c8', '-');				

		$filename='Template Unggah Master JFU - '.date("d-m-Y").'.xlsx'; //save our workbook as this file name
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

	public function import_master_jfu()
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
					$arr_data[$row][$column] = $data_value;
			    }
			}

			//send the data in an array format
			$data['values'] = $arr_data;
			// echo '<pre>';
			// print_r($data['values']);die();			
			// echo '</pre>';			

			$data_header = array(
									'id_kelas_jabatan' => $this->Allcrud->getData('mr_posisi_class',array('posisi_class'=>$data['values'][3]['B']))->result_array()[0]['id'],
									'nama_jabatan'     => $data['values'][2]['B'],
									'status'           => 1
								);
			$res_data_id = $this->Allcrud->addData_with_return_id('mr_jabatan_fungsional_umum',$data_header);
			$data_count = (7+(count($data['values'])-3));
			// print_r($data_count);die();
			for ($i=7; $i < $data_count; $i++) {
				# code...
				$data_store        = array
									(
										'id_jfu'       => $res_data_id,
										'uraian_tugas' => $data['values'][$i]['B'],
										'keterangan'   => $data['values'][$i]['C'],
										'status'       => 1
								);
				if ($data['values'][$i]['A'] == '+') {
					# code...
					$res_data = $this->Allcrud->addData('mr_jabatan_fungsional_umum_uraian_tugas',$data_store);
				}
			}
			$link = 'master/jabatan_fungsional_umum/detail/'.$res_data_id;
			redirect($link);
        }
        else
        {
            echo $this->upload->display_errors();
        }		
	}

	public function add_data()
	{
		# code...
		$this->Allcrud->session_rule();						
		$data['title']        = 'Master Jabatan Fungsional Umum >> Tambah Data';
		$data['content']      = 'master/jfu/add';
		$data['flag_crud']    = 'create';
		$data['class_posisi'] = $this->Mmaster->get_posisi_class();
		$data['list']         = '';
		$data['list_detail']  = '';
		$this->load->view('templateAdmin',$data);		
	}

	public function detail($id)
	{
		# code...
		$this->Allcrud->session_rule();						
		$data['title']        = 'Master Jabatan Fungsional Umum >> Tambah Data';
		$data['content']      = 'master/jfu/add';
		$data['flag_crud']    = 'update';
		$data['class_posisi'] = $this->Mmaster->get_posisi_class();
		$data['list']         = $this->Mmaster->get_data_jfu($id);
		$data['list_detail']  = $this->Mmaster->get_data_jfu_detail($id);
		$this->load->view('templateAdmin',$data);	
	}

	public function delete_uraian_tugas_jfu($id)
	{
		// code...
		$this->Globalrules->session_rule();
		$flag        = array('id' => $id);
		$res_data    = $this->Allcrud->delData('mr_jabatan_fungsional_umum_uraian_tugas',$flag);
		$text_status = $this->Globalrules->check_status_res($res_data,'Uraian Tugas telah dihapus');
		$res         = array
							(
								'status' => $res_data,
								'text'   => $text_status
							);
		echo json_encode($res);
	}
}