<?php defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH."third_party\PHPExcel.php";
/*
Create by : Bryan Setyawan Putra
Date 	  : 01/07/2016
*/

class Laporan extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('mlaporan', '', TRUE);
		// $this->load->model ('Mmaster', '', TRUE);		
		$this->load->model ('master/Mmaster', '', TRUE);
		$this->load->library('excel');
		$this->load->helper(array('url','form'));
		$this->load->library('image_lib');
		$this->load->library('upload');
	}

	public function index()
	{
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		redirect('dashboard/home');
	}

	public function import_tunkir_produktivitas_disiplin()
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$data['title']                = 'Import Tunjangan Kinerja Aspek Produktivitas dan Aspek Disiplin';
		$data['subtitle']             = '';
		$data['bulan']				  = $this->Globalrules->data_bulan();
		$data['content']              = 'laporan/import_tunkir_produktivitas_disiplin/import_tunkir_produktivitas_disiplin';
		$this->load->view('templateAdmin',$data);
	}

	public function import_tunkir_produktivitas_disiplin_excel($bulan,$tahun)
	{
		# code...
		$data_store = "";
		if($_FILES['file']['error'] == 4)
		{
			return false;
		}

		$config['upload_path']        = './public/excel/';
		$config['allowed_types']      = 'xls|xlsx';
		$config['max_size']           = 20000;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if( $this->upload->do_upload('file') )
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

			//clean data
			$data_count = (6+count($data['values']));
			for ($i=15; $i <= $data_count; $i++) {
				# code...
				if ($data['values'][$i]['A'] != 'Total') {
					# code...
					$data_store[$i-15]        = array
										(
											'nama'              => $data['values'][$i]['B'],
											'nip'               => $data['values'][$i]['C'],
											'npwp'              => $data['values'][$i]['D'],
											'gol'               => $data['values'][$i]['E'],
											'kelas_jabatan'     => $data['values'][$i]['F'],
											'tunjangan_kinerja' => $data['values'][$i]['G'],
											'tunjangan_plt_plh' => $data['values'][$i]['H'],
											'total_pengurangan' => $data['values'][$i]['I'],
											'total'             => $data['values'][$i]['J']
									);
				}
			}


			$es2 = $this->session->userdata('sesEs2');

			for ($i=0; $i < count($data_store); $i++) {
				# code...
				$data_save        = array
									(
										'es2'				=> $es2,
										'nama'              => $data_store[$i]['nama'],
										'nip'               => $data_store[$i]['nip'],
										'npwp'              => $data_store[$i]['npwp'],
										'gol'               => $data_store[$i]['gol'],
										'kelas_jabatan'     => $data_store[$i]['kelas_jabatan'],
										'tunjangan_kinerja' => $data_store[$i]['tunjangan_kinerja'],
										'tunjangan_plt_plh' => $data_store[$i]['tunjangan_plt_plh'],
										'total_pengurangan' => $data_store[$i]['total_pengurangan'],
										'total'             => $data_store[$i]['total'],
										'bulan'				=> $bulan,
										'tahun'				=> $tahun
								);
				$this->Allcrud->addData('tr_import_tunkir_produktivitas_disiplin_temp',$data_save);
			}
			$res = array
						(
							'status' => 1,
							'text'   => 'Unggah data berhasil'
						);
			echo json_encode($res);
			// $this->show_data_displin($es2,$bulan,$tahun);
        }
        else
        {
            echo $this->upload->display_errors();
        }
	}

	public function show_data_displin($es2,$bulan,$tahun)
	{
		# code...
		$res_data      = 1;
		$data['list']  = $this->mlaporan->import_temporary($es2,$bulan,$tahun);
		$data['state'] = 'temp';
		$this->load->view('laporan/import_tunkir_produktivitas_disiplin/getdat_temp',$data);
	}

	public function check_data_import_produktivitas_tunkir($es2,$bulan,$tahun)
	{
		# code...
		$data['list'] = $this->mlaporan->import_temporary($es2,$bulan,$tahun);
	}

	public function get_import_produktivitas_tunkir($es2,$bulan,$tahun)
	{
		# code...
		$data_sender   = $this->input->post('data_sender');
		$data['state'] = 'temp';
		$data['list']  = $this->mlaporan->import_temporary($es2,$bulan,$tahun);
		$this->load->view('laporan/import_tunkir_produktivitas_disiplin/getdat_temp',$data);
	}

	public function save_import_produktivitas_tunkir($es2,$bulan,$tahun)
	{
		# code...
		$res_data    = "";
		$data_sender = $this->mlaporan->import_temporary($es2,$bulan,$tahun);
		// print_r($data_sender[0]->nama);die();
		for ($i=0; $i < count($data_sender); $i++) {
			# code...
			if ($data_sender[$i]->verify_nip_nama != 'invalid') {
				# code...
				$data_save        = array
									(
										'es2'				=> $es2,
										'nama'              => $data_sender[$i]->nama,
										'nip'               => $data_sender[$i]->nip,
										'npwp'              => $data_sender[$i]->npwp,
										'gol'               => $data_sender[$i]->gol,
										'kelas_jabatan'     => $data_sender[$i]->kelas_jabatan,
										'tunjangan_kinerja' => $data_sender[$i]->tunjangan_kinerja,
										'tunjangan_plt_plh' => $data_sender[$i]->tunjangan_plt_plh,
										'total_pengurangan' => $data_sender[$i]->total_pengurangan,
										'total'             => $data_sender[$i]->total,
										'bulan'				=> $bulan,
										'tahun'				=> $tahun
								);
				$this->Allcrud->addData('tr_import_tunkir_produktivitas_disiplin',$data_save);
				$flag     = array('id' => $data_sender[$i]->id);
				$res_data = $this->Allcrud->delData('tr_import_tunkir_produktivitas_disiplin_temp',$flag);
			}
			else
			{
				$flag     = array('id' => $data_sender[$i]->id);
				$res_data = $this->Allcrud->delData('tr_import_tunkir_produktivitas_disiplin_temp',$flag);
			}
		}

		$text_status = $this->Globalrules->check_status_res($res_data,'Data import telah disimpan.');
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);
	}

	public function get_import_produktivitas_tunkir_real($es2,$bulan,$tahun)
	{
		# code...
		$data['list']  = $this->mlaporan->import_real($es2,$bulan,$tahun);
		$data['state'] = 'real';
		$this->load->view('laporan/import_tunkir_produktivitas_disiplin/getdat_temp',$data);
	}

	public function rekap_kinerja()
	{
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$data['title']      = 'Rekapitulasi Data Kinerja';
		$data['content']    = 'laporan/kinerja/data_kinerja';
		$data['bulan_list'] = $this->Globalrules->data_bulan();
		$data['list']       = '';
		$data['es1']        = $this->Allcrud->listData('mr_eselon1');
		$data['es2']        = $this->Allcrud->getData('mr_eselon2',array('id_es1'=>$this->session->userdata('sesEs1')));
		$data['role']       = $this->Allcrud->listData('user_role');
		// echo "<pre>";print_r($data['list']);die();
		$this->load->view('templateAdmin',$data);
	}

	public function sync_kinerja()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$bulan       = '0'.$data_sender['data_5'];
		if ($data_sender['data_5'] == 3) {
			# code...
			$bulan = '1';
		}
		$tahun       = $data_sender['data_6'];
		$data_date   = $tahun.'-0'.$bulan;		
		$data_sender = array
						(
							'eselon1'    => $data_sender['data_1'],
							'eselon2'    => $data_sender['data_2'],
							'eselon3'    => $data_sender['data_3'],
							'eselon4'    => $data_sender['data_4'],
							'kat_posisi' => ''
						);

		$data['list'] = $this->Mmaster->data_pegawai($data_sender,'a.es2 ASC,
																	a.es3 ASC,
																	a.es4 ASC,
																	b.kat_posisi asc,
																	b.atasan ASC');		
		// print_r(count($data['list']));die;

		if ($data['list'] != 0) {
			# code...
			for ($i=0; $i < count($data['list']); $i++) { 
				$this->Globalrules->sync_data_transaction(array('status_pekerjaan'=>1,'id_pegawai'=>$data['list'][$i]->id_pegawai,'tanggal_mulai LIKE'=>$data_date.'%'),$bulan,$tahun);				
			}
		}		
	}

	public function kinerja_anggota()
	{
		# code...
		$data['title']      = 'Rekapitulasi Data Kinerja Anggota';
		$data['content']    = 'laporan/kinerja/data_kinerja_anggota';
		$this->load->view('templateAdmin',$data);
		// print_r($data['list']);die();
	}

	Public function filter_kinerja_anggota()
	{
		$id = $this->session->userdata('sesPosisi');
		$data_sender = $this->input->post('data_sender');	
		$data_sender = array
						(
							'atasan'   => $id,
							'bulan'    => $data_sender['data_5'],
							'tahun'    => $data_sender['data_6']
						);
		$data['sender'] 	= $data_sender;
		$data['list'] 		= $this->Mmaster->list_kinerja_bawahan($data_sender);
		if ($data['list'] != 0) {
			$this->load->view('laporan/kinerja/ajax_kinerja_anggota',$data);	
		}
	}

	public function filter_kinerja()
	{
		# code...
		$data_sender = $this->input->post('data_sender');
		$data_sender = array
						(
							'eselon1'    => $data_sender['data_1'],
							'eselon2'    => $data_sender['data_2'],
							'eselon3'    => $data_sender['data_3'],
							'eselon4'    => $data_sender['data_4'],
							'bulan'      => $data_sender['data_5'],
							'tahun'		 => $data_sender['data_6']
						);
		$data['sender'] = $data_sender;
		$data['list']   = $this->Mmaster->data_pegawai('kinerja','b.es2 ASC,
																b.es3 ASC,
																b.es4 ASC,
																c.kat_posisi asc,
																c.atasan ASC',$data_sender);		

		if ($data['list'] != 0) {
			# code...
			for ($i=0; $i < count($data['list']); $i++) { 
				# code...
				$get_data_struktur_organisasi = $this->Mmaster->get_data_struktur_organisasi($data['list'][$i]->posisi_akademik);				
				if ($get_data_struktur_organisasi != array()) {
					# code...
					$data['list'][$i]->posisi_akademik_name = $get_data_struktur_organisasi[0]->nama_posisi;
					$atasan_pegawai_akademik                = $this->Globalrules->get_info_pegawai($get_data_struktur_organisasi[0]->atasan,'posisi');				
					if ($atasan_pegawai_akademik != 0) {
						# code...
						$data['list'][$i]->avail_atasan_akademik    = 1;					
						$data['list'][$i]->id_atasan_akademik       = $atasan_pegawai_akademik[0]->id;
						$data['list'][$i]->nip_atasan_akademik      = $atasan_pegawai_akademik[0]->nip;										
						$data['list'][$i]->nama_atasan_akademik     = $atasan_pegawai_akademik[0]->nama_pegawai;
						$data['list'][$i]->jabatan_atasan_akademik  = $atasan_pegawai_akademik[0]->nama_jabatan;										
					}
					else
					{
						$data['list'][$i]->avail_atasan_akademik    = 0;					
						$data['list'][$i]->id_atasan_akademik       = '-';					
						$data['list'][$i]->nip_atasan_akademik      = '-';					
						$data['list'][$i]->nama_atasan_akademik     = '-';
						$data['list'][$i]->jabatan_atasan_akademik  = '-';															
					}
				}
				else
				{
					$data['list'][$i]->posisi_akademik_name = '-';					
					$data['list'][$i]->avail_atasan_akademik    = 0;					
					$data['list'][$i]->id_atasan_akademik       = '-';					
					$data['list'][$i]->nip_atasan_akademik      = '-';					
					$data['list'][$i]->nama_atasan_akademik     = '-';
					$data['list'][$i]->jabatan_atasan_akademik  = '-';																				
				}			
				
				$get_data_struktur_organisasi1 = $this->Mmaster->get_data_struktur_organisasi($data['list'][$i]->posisi_plt);				
				if ($get_data_struktur_organisasi1 != array()) {
					# code...
					$data['list'][$i]->posisi_plt_name = $get_data_struktur_organisasi1[0]->nama_posisi;
					$atasan_pegawai_plt                = $this->Globalrules->get_info_pegawai($get_data_struktur_organisasi1[0]->atasan,'posisi');				
					if ($atasan_pegawai_plt != 0) {
						# code...
						$data['list'][$i]->avail_atasan_plt    = 1;					
						$data['list'][$i]->id_atasan_plt       = $atasan_pegawai_plt[0]->id;
						$data['list'][$i]->nip_atasan_plt      = $atasan_pegawai_plt[0]->nip;										
						$data['list'][$i]->nama_atasan_plt     = $atasan_pegawai_plt[0]->nama_pegawai;
						$data['list'][$i]->jabatan_atasan_plt  = $atasan_pegawai_plt[0]->nama_jabatan;										
					}
					else
					{
						$data['list'][$i]->avail_atasan_plt    = 0;					
						$data['list'][$i]->id_atasan_plt       = '-';					
						$data['list'][$i]->nip_atasan_plt      = '-';					
						$data['list'][$i]->nama_atasan_plt     = '-';
						$data['list'][$i]->jabatan_atasan_plt  = '-';															
					}					
				}
				else
				{
					$data['list'][$i]->posisi_plt_name = '-';		
					$data['list'][$i]->avail_atasan_plt    = 0;					
					$data['list'][$i]->id_atasan_plt       = '-';					
					$data['list'][$i]->nip_atasan_plt      = '-';					
					$data['list'][$i]->nama_atasan_plt     = '-';
					$data['list'][$i]->jabatan_atasan_plt  = '-';								
				}							

				$data_pegawai = $this->Globalrules->get_info_pegawai($data['list'][$i]->atasan,'posisi');				
				if ($data_pegawai != 0) {
					# code...
					$data['list'][$i]->avail_atasan    = 1;					
					$data['list'][$i]->id_atasan       = $data_pegawai[0]->id;
					$data['list'][$i]->nip_atasan      = $data_pegawai[0]->nip;										
					$data['list'][$i]->nama_atasan     = $data_pegawai[0]->nama_pegawai;
					$data['list'][$i]->jabatan_atasan  = $data_pegawai[0]->nama_jabatan;										
				}
				else
				{
					$data['list'][$i]->avail_atasan    = 0;					
					$data['list'][$i]->id_atasan       = '-';					
					$data['list'][$i]->nip_atasan      = '-';					
					$data['list'][$i]->nama_atasan     = '-';
					$data['list'][$i]->jabatan_atasan  = '-';															
				}
			}
			// die();
		}																
		// echo "<pre>";
		// print_r($data['list']);die();
		// echo "</pre>";		
		$this->load->view('laporan/kinerja/ajax_kinerja',$data);
	}

	public function export_kinerja_excel($es1=NULL,$es2=NULL,$es3=NULL,$es4=NULL,$bulan=NULL,$tahun=NULL)
	{
		# code...
		$es1 = ($es1 == 0) ? '' : $es1 ;		
		$es2 = ($es2 == 0) ? '' : $es2 ;
		$es3 = ($es3 == 0) ? '' : $es3 ;
		$es4 = ($es4 == 0) ? '' : $es4 ;
		$data_sender = array
						(
							'eselon1'    => $es1,
							'eselon2'    => $es2,
							'eselon3'    => $es3,
							'eselon4'    => $es4,
							'bulan' 	 => $bulan,
							'tahun'		 => $tahun
						);		
		// die();
		$data['list']   = $this->Mmaster->data_pegawai('kinerja','b.es2 ASC,
																b.es3 ASC,
																b.es4 ASC,
																c.kat_posisi asc,
																c.atasan ASC',$data_sender);		
	
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet

		$this->excel->getActiveSheet(1)->getColumnDimension('a')->setWidth('5');
		$this->excel->getActiveSheet(1)->getColumnDimension('b')->setWidth('22');
		$this->excel->getActiveSheet(1)->getColumnDimension('c')->setWidth('44');
		$this->excel->getActiveSheet(1)->getColumnDimension('d')->setWidth('35');
		$this->excel->getActiveSheet(1)->getColumnDimension('e')->setWidth('35');
		$this->excel->getActiveSheet(1)->getColumnDimension('f')->setWidth('35');
		$this->excel->getActiveSheet(1)->getColumnDimension('g')->setWidth('35');
		$this->excel->getActiveSheet(1)->getColumnDimension('h')->setWidth('15');		
		$this->excel->getActiveSheet(1)->getColumnDimension('i')->setWidth('15');		
		$this->excel->getActiveSheet(1)->getColumnDimension('j')->setWidth('15');		
		$this->excel->getActiveSheet(1)->getColumnDimension('k')->setWidth('15');		
		$this->excel->getActiveSheet(1)->getColumnDimension('l')->setWidth('15');		
		$this->excel->getActiveSheet(1)->getColumnDimension('m')->setWidth('15');		
		$this->excel->getActiveSheet(1)->getColumnDimension('n')->setWidth('15');														
		$this->excel->getActiveSheet(1)->setTitle('Rekap Kinerja Pegawai '.$tahun.'-'.$bulan);
		$this->excel->getActiveSheet(1)->getStyle('b7:h7')->getBorders()->getallborders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(1)->setCellValue('A1', 'Rekap Kinerja Pegawai '.$this->Globalrules->set_bulan($bulan).'-'.$tahun);
		$this->excel->getActiveSheet(1)->setCellValue('A2', 'No.');
		$this->excel->getActiveSheet(1)->setCellValue('B2', 'NIP');		
		$this->excel->getActiveSheet(1)->setCellValue('C2', 'Nama');		
		$this->excel->getActiveSheet(1)->setCellValue('D2', 'Eselon I');
		$this->excel->getActiveSheet(1)->setCellValue('E2', 'Eselon II');
		$this->excel->getActiveSheet(1)->setCellValue('F2', 'Jabatan');
		$this->excel->getActiveSheet(1)->setCellValue('G2', 'Atasan Langsung');		
		$this->excel->getActiveSheet(1)->setCellValue('H2', 'Belum Diperiksa');
		$this->excel->getActiveSheet(1)->setCellValue('I2', 'Revisi');	
		$this->excel->getActiveSheet(1)->setCellValue('J2', 'Ditolak');			
		$this->excel->getActiveSheet(1)->setCellValue('K2', 'Disetujui');
		$this->excel->getActiveSheet(1)->setCellValue('L2', 'Menit Efektif');
		$this->excel->getActiveSheet(1)->setCellValue('M2', 'Prosentase');
		$this->excel->getActiveSheet(1)->setCellValue('N2', 'Keterangan');																		
		if ($data['list'] != 0) {
		    # code...
		    $counter = "";
		    for ($i=0; $i < count($data['list']); $i++) {
				# code...
				$data_pegawai = $this->Globalrules->get_info_pegawai($data['list'][$i]->atasan,'posisi');				
				if ($data_pegawai != 0) {
					# code...
					$data['list'][$i]->avail_atasan    = 1;					
					$data['list'][$i]->id_atasan       = $data_pegawai[0]->id;
					$data['list'][$i]->nip_atasan      = $data_pegawai[0]->nip;										
					$data['list'][$i]->nama_atasan     = $data_pegawai[0]->nama_pegawai;
					$data['list'][$i]->jabatan_atasan  = $data_pegawai[0]->nama_jabatan;										
				}
				else
				{
					$data['list'][$i]->avail_atasan    = 0;					
					$data['list'][$i]->id_atasan       = '-';					
					$data['list'][$i]->nip_atasan      = '-';					
					$data['list'][$i]->nama_atasan     = '-';
					$data['list'][$i]->jabatan_atasan  = '-';															
				}				

				$counter                = 3 + $i;
				$set_status             = "";
				$this->excel->getActiveSheet()->getStyle('a'.$counter.':n'.$counter)->getAlignment()->setWraptext(true);				
				$this->excel->getActiveSheet(2)->setCellValue('a'.$counter, $i+1);
				$this->excel->getActiveSheet(2)->setCellValue('b'.$counter, '`'.$data['list'][$i]->nip);
				$this->excel->getActiveSheet(2)->setCellValue('c'.$counter, $data['list'][$i]->nama_pegawai);
				$this->excel->getActiveSheet(2)->setCellValue('d'.$counter, $data['list'][$i]->nama_eselon1);
				$this->excel->getActiveSheet(2)->setCellValue('e'.$counter, $data['list'][$i]->nama_eselon2);								
				$this->excel->getActiveSheet(2)->setCellValue('f'.$counter, $data['list'][$i]->nama_posisi);
				$this->excel->getActiveSheet(2)->setCellValue('g'.$counter, $data['list'][$i]->nama_atasan);
				$this->excel->getActiveSheet(2)->setCellValue('h'.$counter, $data['list'][$i]->tr_belum_diperiksa);
				$this->excel->getActiveSheet(2)->setCellValue('i'.$counter, $data['list'][$i]->tr_revisi);												
				$this->excel->getActiveSheet(2)->setCellValue('j'.$counter, $data['list'][$i]->tr_tolak);
				$this->excel->getActiveSheet(2)->setCellValue('k'.$counter, $data['list'][$i]->tr_approve);
				$this->excel->getActiveSheet(2)->setCellValue('l'.$counter, $data['list'][$i]->menit_efektif);
				$this->excel->getActiveSheet(2)->setCellValue('m'.$counter, $data['list'][$i]->prosentase_menit_efektif);
				$this->excel->getActiveSheet(2)->setCellValue('n'.$counter, '');														
		    }
		}

		ob_clean();

		$filename='Rekapitulasi Kinerja Pegawai - '.date("d-m-Y").'.xlsx'; //save our workbook as this file name
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
		redirect('master/data_pegawai/', false);		
		// echo "<pre>";
		// print_r($data['list']);die();		
		// echo "</pre>";		
	}





















	public function filter_data_pegawai_rekap_kinerja_prod_disiplin()
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

		$data = $this->get_data_summary($data_sender);
		$this->load->view('laporan/tunkir_produktivitas_disiplin/ajax_tunkir_produktivitas_disiplin',$data);
	}
	
	public function get_data_summary($data_sender)
	{
		# code...
		$data['list'] = $this->Mmaster->data_pegawai($data_sender,'a.es2 ASC,
																		a.es3 ASC,
																		a.es4 ASC,
																		b.kat_posisi asc,
																		b.atasan ASC');

		// print_r($this->Globalrules->list_atasan($data['list'][0]->id_posisi));die();
		if ($data['list'] != 0) {
			# code...
			for ($i=0; $i < count($data['list']); $i++) {
				# code...
				$data_atasan                                = $this->Globalrules->list_atasan($data['list'][$i]->id_posisi);
				$data_transaksi                             = $this->mlaporan->get_transact($data['list'][$i]->id_pegawai,1,date('m'),date('Y'));
				$data_belum_diperiksa                       = $this->mlaporan->get_transact($data['list'][$i]->id_pegawai,0,date('m'),date('Y'));
				$data_tolak                                 = $this->mlaporan->get_transact($data['list'][$i]->id_pegawai,2,date('m'),date('Y'));
				$data_revisi                                = $this->mlaporan->get_transact($data['list'][$i]->id_pegawai,3,date('m'),date('Y'));
				if ($data_atasan != 0) {
					// code...
					$data['list'][$i]->nama_atasan	= $data_atasan[0]->nama_pegawai;
				}
				else {
					// code...
					$data['list'][$i]->nama_atasan  = '';
				}
				$data['list'][$i]->disetujui                = $data_transaksi[0]->count_status_pekerjaan;
				$data['list'][$i]->ditolak                  = $data_tolak[0]->count_status_pekerjaan;
				$data['list'][$i]->revisi                   = $data_revisi[0]->count_status_pekerjaan;
				$data['list'][$i]->belum_diperiksa          = $data_belum_diperiksa[0]->count_status_pekerjaan;
				$data['list'][$i]->menit_efektif            = $data_transaksi[0]->menit_efektif;
				$data['list'][$i]->menit_efektif_efektif    = $data_transaksi[0]->menit_efektif_sistem;
				$data['list'][$i]->prosentase               = $data_transaksi[0]->prosentase;
				$data['list'][$i]->tugas_belajar            = $data_transaksi[0]->tugas_belajar;


				if ($data_transaksi) {
					# code...
					$get_data = $this->Allcrud->getData('tr_pengurangan_tunjangan',array('id_pegawai'=>$data['list'][$i]->id_pegawai,'tahun'=> date('Y'),'bulan'=>date('m')))->result_array();			
					if ($get_data != array()) {
						# code...
						$data_transaksi[0]->persentase_potongan = $get_data[0]['persentase'];
						$data_transaksi[0]->potongan_kinerja    = ($data_transaksi[0]->real_tunjangan_kinerja*($data_transaksi[0]->persentase_potongan/100));
					}
					else
					{
						$data_transaksi[0]->persentase_potongan = 0;
						$data_transaksi[0]->potongan_kinerja    = 0;
					}
				}

				$data['list'][$i]->persentase_potongan      = $data_transaksi[0]->persentase_potongan;
				$data['list'][$i]->potongan_kinerja         = $data_transaksi[0]->potongan_kinerja;
				$data['list'][$i]->tunjangan_kinerja        = $data_transaksi[0]->tunjangan_kinerja;
				$data['list'][$i]->tunjangan_kinerja_sistem = $data_transaksi[0]->tunjangan_kinerja_sistem;
				$data['list'][$i]->tunjangan_disiplin       = $data_transaksi[0]->tunjangan_disiplin;
				$data['list'][$i]->tunjangan_profesi        = $data_transaksi[0]->tunjangan_profesi;
/*************************************************************************************************************************/
			}
		}

		return $data;
	}

	public function rekap_tunkir_produktivitas_disiplin()
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$data['title']      = 'Rekapitulasi Tunjangan Kinerja Aspek Produktivitas & Aspek Disiplin';
		$data['content']    = 'laporan/tunkir_produktivitas_disiplin/data_tunkir';
		$data['bulan_list'] = $this->Globalrules->data_bulan();
		$data['list']       =  '';
		$data['es1']        = $this->Allcrud->listData('mr_eselon1');
		$data['es2']        = $this->Allcrud->getData('mr_eselon2',array('id_es1'=>$this->session->userdata('sesEs1')));
		$data['role']       = $this->Allcrud->listData('user_role');
		$this->load->view('templateAdmin',$data);
	}

/*
Create by : Bryan Setyawan Putra
Last edit : 27/07/2016
*/
	public function get_data_eselon($flag=NULL,$type=NULL,$value=NULL)
	{
		# code...
		$data = "";
		$this->Globalrules->notif_message();
		if ($flag != "ajax") {
			# code...
			$data['data_eselon1']         = $this->mlaporan->get_eselon('1');
			$data['data_eselon2']         = $this->mlaporan->get_eselon('2');
			$data['data_eselon3']         = $this->mlaporan->get_eselon('3');
			$data['data_eselon4']         = $this->mlaporan->get_eselon('4');
		}
		else
		{
			$data = $this->mlaporan->get_eselon($type,'ajax',$value);
		}

		return $data;
	}

/*
Create by : Bryan Setyawan Putra
Last edit : 22/07/2016
*/
	public function rekap_banding()
	{
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$flag               = array();
		$data['eselon']     = $this->get_data_eselon();
		$data['title']      = 'Rekapitulasi Data Banding';
		$data['content']    = 'laporan/banding/data_banding';
		$data['bulan_list'] = $this->Globalrules->data_bulan();
		$data['list']       = $this->get_data_report();
		$this->load->view('templateAdmin',$data);
	}

/*
Create by : Bryan Setyawan Putra
Last edit : 13/07/2016
*/
	public function rekap_tunjangan()
	{
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$flag               = array();
		$data['eselon']     = $this->get_data_eselon();
		$data['title']      = 'Rekapitulasi Tunjangan Kinerja';
		$data['content']    = 'laporan/tunjangan/data_tunjangan';
		$data['bulan_list'] = $this->Globalrules->data_bulan();
		$data['list']    = $this->get_data_report();
		$this->load->view('templateAdmin',$data);
	}

/*
Create by : Bryan Setyawan Putra
Last edit : 13/07/2016
*/
	public function rekap_keberatan()
	{
		$this->Globalrules->session_rule();
		$this->Globalrules->notif_message();
		$flag               = array();
		$data['eselon']     = $this->get_data_eselon();
		$data['title']      = 'Rekapitulasi Keberatan';
		$data['content']    = 'laporan/keberatan/data_keberatan';
		$data['bulan_list'] = $this->Globalrules->data_bulan();
		$data['list']       = $this->get_data_report();
		$this->load->view('templateAdmin',$data);
	}

/*
Create by : Bryan Setyawan Putra
Last edit : 13/07/2016
*/
	public function preview_data_report()
	{
		$this->Globalrules->notif_message();
		$data_sender     = $this->input->post('data_sender');
		$format_date_sql = $data_sender['tahun']."-".$data_sender['bulan']."-01";

		$eksport = "preview";
		$res     = $this->get_data_report(
											$eksport,
											$data_sender['bulan'],
											$data_sender['tahun'],
											$data_sender['eselon1'],
											$data_sender['eselon2'],
											$data_sender['eselon3'],
											$data_sender['eselon4'],
											$format_date_sql
										);
		echo json_encode($res);
	}

/*
Create by : Bryan Setyawan Putra
Last edit : 28/07/2016
*/
	public function get_data_eselon_by()
	{
		# code...
		$this->Globalrules->notif_message();
		$data_sender = $this->input->post('data_sender');
		$type        = $this->input->post('type');

		$res = $this->get_data_eselon('ajax',$type,$data_sender);

		echo json_encode($res);
	}



























































	/*
Create by : Bryan Setyawan Putra
Last edit : 27/07/2016
*/
	public function export_data_kinerja(
											$bulan   =NULL,
											$tahun   =NULL,
											$eselon1 =NULL,
											$eselon2 =NULL,
											$eselon3 =NULL,
											$eselon4 =NULL
										)
	{
		$this->Globalrules->notif_message();

		if ($bulan == "-")$bulan = "";
		if ($tahun == "-")$tahun = "";
		if ($eselon1 == "-")$eselon1 = "";
		if ($eselon2 == "-")$eselon2 = "";
		if ($eselon3 == "-")$eselon3 = "";
		if ($eselon4 == "-")$eselon4 = "";

		$text_header = "";
		$nama_bulan = $this->Allcrud->set_bulan($bulan);
		if ($bulan == NULL || $tahun == NULL) {
			# code...
			$tahun       = "0000";
			$bulan       = "00";
			$tanggal     = "00";
			$text_header = "Laporan Rekapitulasi Data Kinerja";
		}
		else
		{
			$tanggal = "01";
			$text_header = "Laporan Rekapitulasi Data Kinerja Bulan ".$nama_bulan." Tahun ".$tahun;
		}

		$format_date_sql = $tahun."-".$bulan."-".$tanggal;

		$eksport = "this_is_export";

		$data['list']    = $this->get_data_report(
													$eksport,
													$bulan,
													$tahun,
													$eselon1,
													$eselon2,
													$eselon3,
													$eselon4,
													$format_date_sql
												);
		# code...
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Rekapitulasi Data Kinerja');

		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(27);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(22);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(27);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(11);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(13);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(17);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);

		$this->excel->getActiveSheet()->getStyle('B8:L8')->getFont()->setSize(13);
		$this->excel->getActiveSheet()->getStyle('B8:L8')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B8:L8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B8:L8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B8:L8')->getAlignment()->setWraptext(true);
		$this->excel->getActiveSheet()->getStyle('B8:L8')->getBorders()->getallborders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$this->excel->getActiveSheet()->mergeCells('B3:L3');
		$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(22);
		$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('B3', $text_header);

		$this->excel->getActiveSheet()->setCellValue('B8', 'No');
		$this->excel->getActiveSheet()->setCellValue('C8', 'Nama');
		$this->excel->getActiveSheet()->setCellValue('D8', 'NIP');
		$this->excel->getActiveSheet()->setCellValue('E8', 'Jabatan');
		$this->excel->getActiveSheet()->setCellValue('F8', 'Disetujui');
		$this->excel->getActiveSheet()->setCellValue('G8', 'Ditolak');
		$this->excel->getActiveSheet()->setCellValue('H8', 'Revisi');
		$this->excel->getActiveSheet()->setCellValue('I8', 'Belum Diperiksa');
		$this->excel->getActiveSheet()->setCellValue('J8', 'Menit Kerja Efektif');
		$this->excel->getActiveSheet()->setCellValue('K8', '% Realisasi Kerja Efektif');
		$this->excel->getActiveSheet()->setCellValue('L8', 'Tunjangan');

		$data_count = 9 + count($data['list']);
		for ($i=9; $i < $data_count; $i++) {
			# code...
			$x = 0;
			$counter_i = $i - 9;
			$row_b = "B".$i;
			$row_c = "C".$i;
			$row_d = "D".$i;
			$row_e = "E".$i;
			$row_f = "F".$i;
			$row_g = "G".$i;
			$row_h = "H".$i;
			$row_i = "I".$i;
			$row_j = "J".$i;
			$row_k = "K".$i;
			$row_l = "L".$i;

			$aa = 9;
			$this->excel->getActiveSheet()->getStyle($row_b.':'.$row_)->getBorders()->getallborders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$this->excel->getActiveSheet()->getStyle($row_b.':'.$row_l)->getAlignment()->setWraptext(true);
			$this->excel->getActiveSheet()->getStyle($row_b.':'.$row_l)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle($row_b.':'.$row_l)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle($row_d)->getNumberFormat()->setFormatCode('0000');

			$this->excel->getActiveSheet()->setCellValue($row_b, $counter_i+1);
			$this->excel->getActiveSheet()->setCellValue($row_c, $data['list'][$counter_i]->nama_pegawai);
			$this->excel->getActiveSheet()->setCellValue($row_d, $data['list'][$counter_i]->nip);
			$this->excel->getActiveSheet()->setCellValue($row_e, $data['list'][$counter_i]->nama_posisi);
			$this->excel->getActiveSheet()->setCellValue($row_f, number_format($data['list'][$counter_i]->kerja_disetujui));
			$this->excel->getActiveSheet()->setCellValue($row_g, number_format($data['list'][$counter_i]->kerja_ditolak));
			$this->excel->getActiveSheet()->setCellValue($row_h, number_format($data['list'][$counter_i]->kerja_revisi));
			$this->excel->getActiveSheet()->setCellValue($row_i, number_format($data['list'][$counter_i]->kerja_belum_diperiksa));
			$this->excel->getActiveSheet()->setCellValue($row_j, number_format($data['list'][$counter_i]->jam_kerja));
			$this->excel->getActiveSheet()->setCellValue($row_k, number_format($data['list'][$counter_i]->menit_efektif));
			$this->excel->getActiveSheet()->setCellValue($row_l, "Rp. ".number_format($data['list'][$counter_i]->tunjangan));
			$x++;
		}

		$filename=' Laporan rekapitulasi data kinerja - '.date("d-m-Y").'.xlsx'; //save our workbook as this file name
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
		redirect('laporan/rekap_kinerja', false);
	}

/*
Create by : Bryan Setyawan Putra
Last edit : 25/07/2016
*/
	public function export_data_tunjangan(
											$bulan   =NULL,
											$tahun   =NULL,
											$eselon1 =NULL,
											$eselon2 =NULL,
											$eselon3 =NULL,
											$eselon4 =NULL
										)
	{
		# code...
		$this->Globalrules->notif_message();
		if ($bulan == "-")$bulan = "";
		if ($tahun == "-")$tahun = "";
		if ($eselon1 == "-")$eselon1 = "";
		if ($eselon2 == "-")$eselon2 = "";
		if ($eselon3 == "-")$eselon3 = "";
		if ($eselon4 == "-")$eselon4 = "";

		$text_header = "";
		$nama_bulan = $this->Allcrud->set_bulan($bulan);

		if ($bulan == NULL || $tahun == NULL) {
			# code...
			$tahun       = "0000";
			$bulan       = "00";
			$tanggal     = "00";
			$text_header = "Laporan Rekapitulasi Tunjangan Kinerja";
		}
		else
		{
			$tanggal = "01";
			$text_header = "Laporan Rekapitulasi Tunjangan Kinerja Bulan ".$nama_bulan." Tahun ".$tahun;
		}

		$format_date_sql = $tahun."-".$bulan."-".$tanggal;
		$eksport         = "this_is_export";

		$data['list']    = $this->get_data_report(
													$eksport,
													$bulan,
													$tahun,
													$eselon1,
													$eselon2,
													$eselon3,
													$eselon4,
													$format_date_sql
												);

		# code...
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Rekapitulasi Tunjangan Kinerja');

		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(27);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(22);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(27);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(13);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(16);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(14);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);

		$this->excel->getActiveSheet()->getStyle('B8:J8')->getFont()->setSize(13);
		$this->excel->getActiveSheet()->getStyle('B8:J8')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B8:J8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B8:J8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B8:J8')->getAlignment()->setWraptext(true);
		$this->excel->getActiveSheet()->getStyle('B8:J8')->getBorders()->getallborders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$this->excel->getActiveSheet()->mergeCells('B3:J3');
		$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(22);
		$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('B3', $text_header);

		$this->excel->getActiveSheet()->setCellValue('B8', 'No');
		$this->excel->getActiveSheet()->setCellValue('C8', 'Nama');
		$this->excel->getActiveSheet()->setCellValue('D8', 'NIP');
		$this->excel->getActiveSheet()->setCellValue('E8', 'Jabatan');
		$this->excel->getActiveSheet()->setCellValue('F8', 'Kelas Jabatan');
		$this->excel->getActiveSheet()->setCellValue('G8', '50% Nilai per Grade');
		$this->excel->getActiveSheet()->setCellValue('H8', 'Menit Kerja Efektif (Bulan)');
		$this->excel->getActiveSheet()->setCellValue('I8', 'Realisasi Kerja Efektif');
		$this->excel->getActiveSheet()->setCellValue('J8', 'Jumlah Yang Diterima');

		$data_count = 9 + count($data['list']);
		for ($i=9; $i < $data_count; $i++) {
			# code...
			$x = 0;
			$counter_i = $i - 9;
			$row_b = "B".$i;
			$row_c = "C".$i;
			$row_d = "D".$i;
			$row_e = "E".$i;
			$row_f = "F".$i;
			$row_g = "G".$i;
			$row_h = "H".$i;
			$row_i = "I".$i;
			$row_j = "J".$i;
			$row_k = "K".$i;
			$row_l = "L".$i;

			$aa = 9;
			$realisasi = $data['list'][$counter_i]->menit_efektif / 6600;

			$this->excel->getActiveSheet()->getStyle($row_b.':'.$row_j)->getBorders()->getallborders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$this->excel->getActiveSheet()->getStyle($row_b.':'.$row_j)->getAlignment()->setWraptext(true);
			$this->excel->getActiveSheet()->getStyle($row_b.':'.$row_j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle($row_b.':'.$row_j)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle($row_d)->getNumberFormat()->setFormatCode('0000');
			$this->excel->getActiveSheet()->getStyle($row_k)->getNumberFormat()->setFormatCode('0.00');

			$this->excel->getActiveSheet()->setCellValue($row_b, $counter_i+1);
			$this->excel->getActiveSheet()->setCellValue($row_c, $data['list'][$counter_i]->nama_pegawai);
			$this->excel->getActiveSheet()->setCellValue($row_d, $data['list'][$counter_i]->nip);
			$this->excel->getActiveSheet()->setCellValue($row_e, $data['list'][$counter_i]->nama_posisi);
			$this->excel->getActiveSheet()->setCellValue($row_f, $data['list'][$counter_i]->posisi_class);
			$this->excel->getActiveSheet()->setCellValue($row_g, "Rp. ".number_format($data['list'][$counter_i]->tunjangan_posisi));
			$this->excel->getActiveSheet()->setCellValue($row_h, number_format(6600));
			$this->excel->getActiveSheet()->setCellValue($row_i, number_format($realisasi));
			$this->excel->getActiveSheet()->setCellValue($row_j, "Rp. ".number_format($data['list'][$counter_i]->tunjangan));
			$x++;
		}

		$filename=' Laporan rekapitulasi tunjangan kinerja - '.date("d-m-Y").'.xlsx'; //save our workbook as this file name
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
		redirect('laporan/rekap_tunjangan', false);
	}

/*
Create by : Bryan Setyawan Putra
Last edit : 26/07/2016
*/
	public function export_keberatan(
											$bulan   =NULL,
											$tahun   =NULL,
											$eselon1 =NULL,
											$eselon2 =NULL,
											$eselon3 =NULL,
											$eselon4 =NULL
									)
	{
		# code...
		$this->Globalrules->notif_message();
		if ($bulan == "-")$bulan = "";
		if ($tahun == "-")$tahun = "";
		if ($eselon1 == "-")$eselon1 = "";
		if ($eselon2 == "-")$eselon2 = "";
		if ($eselon3 == "-")$eselon3 = "";
		if ($eselon4 == "-")$eselon4 = "";

		$text_header = "";
		$nama_bulan = $this->Allcrud->set_bulan($bulan);
		if ($bulan == NULL || $tahun == NULL) {
			# code...
			$tahun       = "0000";
			$bulan       = "00";
			$tanggal     = "00";
			$text_header = "Laporan Rekapitulasi Data Keberatan";
		}
		else
		{
			$tanggal = "01";
			$text_header = "Laporan Rekapitulasi Data Keberatan Bulan ".$nama_bulan." Tahun ".$tahun;
		}

		$format_date_sql = $tahun."-".$bulan."-".$tanggal;
		$eksport         = "this_is_export";

		$data['list']    = $this->get_data_report(
													$eksport,
													$bulan,
													$tahun,
													$eselon1,
													$eselon2,
													$eselon3,
													$eselon4,
													$format_date_sql
												);
		# code...
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Rekapitulasi Data Keberatan');

		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(27);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(22);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(27);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(11);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(11);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(13);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(17);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(10);

		$this->excel->getActiveSheet()->getStyle('B8:M8')->getFont()->setSize(13);
		$this->excel->getActiveSheet()->getStyle('B8:M8')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B8:M8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B8:M8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B8:M8')->getAlignment()->setWraptext(true);
		$this->excel->getActiveSheet()->getStyle('B8:M8')->getBorders()->getallborders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$this->excel->getActiveSheet()->mergeCells('B3:M3');
		$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(22);
		$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('B3', $text_header);

		$this->excel->getActiveSheet()->setCellValue('B8', 'No');
		$this->excel->getActiveSheet()->setCellValue('C8', 'Nama');
		$this->excel->getActiveSheet()->setCellValue('D8', 'NIP');
		$this->excel->getActiveSheet()->setCellValue('E8', 'Jabatan');
		$this->excel->getActiveSheet()->setCellValue('F8', 'Tanggal');
		$this->excel->getActiveSheet()->setCellValue('G8', 'Jam Mulai');
		$this->excel->getActiveSheet()->setCellValue('H8', 'Jam Selesai');
		$this->excel->getActiveSheet()->setCellValue('I8', 'Pekerjaan');
		$this->excel->getActiveSheet()->setCellValue('J8', 'Detail Pekerjaan');
		$this->excel->getActiveSheet()->setCellValue('K8', 'Output');
		$this->excel->getActiveSheet()->setCellValue('L8', 'File Pendukung');
		$this->excel->getActiveSheet()->setCellValue('M8', 'Status');

		$data_count = 9 + count($data['list']);
		for ($i=9; $i < $data_count; $i++) {
			# code...
			$x = 0;
			$counter_i = $i - 9;
			$row_b = "B".$i;
			$row_c = "C".$i;
			$row_d = "D".$i;
			$row_e = "E".$i;
			$row_f = "F".$i;
			$row_g = "G".$i;
			$row_h = "H".$i;
			$row_i = "I".$i;
			$row_j = "J".$i;
			$row_k = "K".$i;
			$row_l = "L".$i;
			$row_m = "M".$i;

			$aa = 9;
			$this->excel->getActiveSheet()->getStyle($row_b.':'.$row_m)->getBorders()->getallborders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$this->excel->getActiveSheet()->getStyle($row_b.':'.$row_m)->getAlignment()->setWraptext(true);
			$this->excel->getActiveSheet()->getStyle($row_b.':'.$row_m)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle($row_b.':'.$row_m)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle($row_d)->getNumberFormat()->setFormatCode('0000');

			$this->excel->getActiveSheet()->setCellValue($row_b, $counter_i+1);
			$this->excel->getActiveSheet()->setCellValue($row_c, $data['list'][$counter_i]->nama_pegawai);
			$this->excel->getActiveSheet()->setCellValue($row_d, $data['list'][$counter_i]->nip);
			$this->excel->getActiveSheet()->setCellValue($row_e, $data['list'][$counter_i]->nama_posisi);
			$this->excel->getActiveSheet()->setCellValue($row_f, $data['list'][$counter_i]->tgl_mulai);
			$this->excel->getActiveSheet()->setCellValue($row_g, $data['list'][$counter_i]->jam_mulai);
			$this->excel->getActiveSheet()->setCellValue($row_h, $data['list'][$counter_i]->jam_selesai);
			$this->excel->getActiveSheet()->setCellValue($row_i, $data['list'][$counter_i]->nama_pekerjaan);
			$this->excel->getActiveSheet()->setCellValue($row_j, "-");
			$this->excel->getActiveSheet()->setCellValue($row_k, $data['list'][$counter_i]->output_pekerjaan);
			$this->excel->getActiveSheet()->setCellValue($row_l, "-");
			$this->excel->getActiveSheet()->setCellValue($row_m, "-");
			$x++;
		}
		$filename=' Laporan rekapitulasi data keberatan - '.date("d-m-Y").'.xlsx'; //save our workbook as this file name
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
		redirect('laporan/rekap_keberatan', false);
	}
}
