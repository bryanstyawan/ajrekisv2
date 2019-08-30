<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Laporan extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('mlaporan', '', TRUE);
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
		$this->load->view('templateAdmin',$data);
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
							'tahun'		 => $data_sender['data_6'],
							'pegawai'	 => '',
							'posisi'	 => ''
						);
		$data['sender'] = $data_sender;
		$data['list']   = $this->Mmaster->data_pegawai('kinerja','eselon2 ASC,
																eselon3 ASC,
																eselon4 ASC,
																kat_posisi ASC,
																atasan ASC',$data_sender);		

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
							'tahun'		 => $tahun,
							'pegawai'	 => '',
							'posisi'	 => ''							
						);		
		// die();
		$data['list']   = $this->Mmaster->data_pegawai('kinerja','eselon2 ASC,
																eselon3 ASC,
																eselon4 ASC,
																kat_posisi ASC,
																atasan ASC',$data_sender);		
	
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
				$prosentase_menit_kerja = '';
				if ((($data['list'][$i]->menit_efektif/6600)*100) > 100) {
					# code...
					$prosentase_menit_kerja = 100;
				}
				else
				{
					$prosentase_menit_kerja = round(($data['list'][$i]->menit_efektif/6600)*100,2);
				}
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

	public function filter_tunkir()
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
							'tahun'		 => $data_sender['data_6'],
							'pegawai'	 => '',
							'posisi'	 => ''
						);
		$data['sender'] = $data_sender;
		$data['list']   = $this->Mmaster->data_pegawai('kinerja','eselon2 ASC,
																eselon3 ASC,
																eselon4 ASC,
																kat_posisi ASC,
																atasan ASC',$data_sender);		
		$this->load->view('laporan/tunjangan/ajax_tunkir',$data);
	}

	public function export_tunjangan_excel($es1=NULL,$es2=NULL,$es3=NULL,$es4=NULL,$bulan=NULL,$tahun=NULL)
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
							'tahun'		 => $tahun,
							'pegawai'	 => '',
							'posisi'	 => ''							
						);		
		// die();
		$data['list']   = $this->Mmaster->data_pegawai('kinerja','eselon2 ASC,
																eselon3 ASC,
																eselon4 ASC,
																kat_posisi ASC,
																atasan ASC',$data_sender);		

		$this->excel->setActiveSheetIndex(0);
		//name the worksheet

		$this->excel->getActiveSheet(1)->getColumnDimension('a')->setWidth('5');
		$this->excel->getActiveSheet(1)->getColumnDimension('b')->setWidth('22');
		$this->excel->getActiveSheet(1)->getColumnDimension('c')->setWidth('44');
		$this->excel->getActiveSheet(1)->getColumnDimension('d')->setWidth('35');
		$this->excel->getActiveSheet(1)->getColumnDimension('e')->setWidth('35');
		$this->excel->getActiveSheet(1)->getColumnDimension('f')->setWidth('80');
		$this->excel->getActiveSheet(1)->getColumnDimension('g')->setWidth('11');
		$this->excel->getActiveSheet(1)->getColumnDimension('h')->setWidth('19');
		$this->excel->getActiveSheet(1)->getColumnDimension('i')->setWidth('15');		
		$this->excel->getActiveSheet(1)->getColumnDimension('j')->setWidth('23');		
		$this->excel->getActiveSheet(1)->getColumnDimension('k')->setWidth('15');		
		$this->excel->getActiveSheet(1)->getColumnDimension('l')->setWidth('15');		
		$this->excel->getActiveSheet(1)->getColumnDimension('m')->setWidth('15');		
		$this->excel->getActiveSheet(1)->getColumnDimension('n')->setWidth('15');		
		$this->excel->getActiveSheet(1)->getColumnDimension('o')->setWidth('15');														
		$this->excel->getActiveSheet(1)->setTitle('Rekap Tunjangan Pegawai '.$tahun.'-'.$bulan);
		$this->excel->getActiveSheet(1)->getStyle('b7:h7')->getBorders()->getallborders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(1)->setCellValue('A1', 'Rekap Tunjangan Pegawai '.$this->Globalrules->set_bulan($bulan).'-'.$tahun);
		$this->excel->getActiveSheet(1)->setCellValue('A2', 'No.');
		$this->excel->getActiveSheet(1)->setCellValue('B2', 'NIP');		
		$this->excel->getActiveSheet(1)->setCellValue('C2', 'Nama');		
		$this->excel->getActiveSheet(1)->setCellValue('D2', 'Eselon I');
		$this->excel->getActiveSheet(1)->setCellValue('E2', 'Eselon II');		
		$this->excel->getActiveSheet(1)->setCellValue('F2', 'Posisi');
		$this->excel->getActiveSheet(1)->setCellValue('G2', 'Posisi Kelas');		
		$this->excel->getActiveSheet(1)->setCellValue('H2', 'Menit Efektif');
		$this->excel->getActiveSheet(1)->setCellValue('I2', 'Prosentase');		
		$this->excel->getActiveSheet(1)->setCellValue('J2', 'Tunjangan');		
		$this->excel->getActiveSheet(1)->setCellValue('K2', 'Tunjangan Profesi');		
		$this->excel->getActiveSheet(1)->setCellValue('L2', 'Pemotongan dari Penilaian SKP Bulanan');				
		$this->excel->getActiveSheet(1)->setCellValue('M2', 'Tunjangan Yang Diberikan');				
		$this->excel->getActiveSheet(1)->setCellValue('N2', 'Periode');																		
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
				$prosentase_menit_kerja = '';
				if ((($data['list'][$i]->menit_efektif/6000)*100) > 100) {
					# code...
					$prosentase_menit_kerja = 100;
				}
				else
				{
					$prosentase_menit_kerja = round(($data['list'][$i]->menit_efektif/6000)*100,2);
				}
				$this->excel->getActiveSheet()->getStyle('a'.$counter.':n'.$counter)->getAlignment()->setWraptext(true);				
				$this->excel->getActiveSheet(2)->setCellValue('a'.$counter, $i+1);
				$this->excel->getActiveSheet(2)->setCellValue('b'.$counter, '`'.$data['list'][$i]->nip);
				$this->excel->getActiveSheet(2)->setCellValue('c'.$counter, $data['list'][$i]->nama_pegawai);
				$this->excel->getActiveSheet(2)->setCellValue('d'.$counter, $data['list'][$i]->nama_eselon1);
				$this->excel->getActiveSheet(2)->setCellValue('e'.$counter, $data['list'][$i]->nama_eselon2);						
				$this->excel->getActiveSheet(2)->setCellValue('f'.$counter, $data['list'][$i]->nama_posisi);						
				$this->excel->getActiveSheet(2)->setCellValue('g'.$counter, $data['list'][$i]->class_posisi_definitif);												
				$this->excel->getActiveSheet(2)->setCellValue('h'.$counter, $data['list'][$i]->menit_efektif);
				$this->excel->getActiveSheet(2)->setCellValue('i'.$counter, $data['list'][$i]->prosentase_menit_efektif);				
				$this->excel->getActiveSheet(2)->setCellValue('J'.$counter, number_format($data['list'][$i]->tunjangan_definitif,0));				
				$this->excel->getActiveSheet(2)->setCellValue('K'.$counter, number_format($data['list'][$i]->tunjangan_profesi,0));				
				$this->excel->getActiveSheet(2)->setCellValue('l'.$counter, number_format($data['list'][$i]->nilai_potongan_skp_bulanan,0));
				$this->excel->getActiveSheet(2)->setCellValue('m'.$counter, number_format($data['list'][$i]->real_tunjangan,0));
				// $this->excel->getActiveSheet(2)->setCellValue('k'.$counter, $data['list'][$i]->tr_approve);
				// $this->excel->getActiveSheet(2)->setCellValue('l'.$counter, $data['list'][$i]->menit_efektif);
				// $this->excel->getActiveSheet(2)->setCellValue('m'.$counter, $data['list'][$i]->prosentase_menit_efektif);
				$this->excel->getActiveSheet(2)->setCellValue('o'.$counter, '');														
			}
		}

		ob_clean();

		$filename='Rekapitulasi Tunjangan Pegawai - '.date("d-m-Y").'.xlsx'; //save our workbook as this file name
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
		$data['list'] 		= $this->Mmaster->list_bawahan($data_sender);
		if ($data['list'] != 0) 
		{
			for ($i=0; $i < count($data['list']); $i++)
			{
				
				$data_rekap = $this->Mmaster->list_kinerja($data['list'][$i]->id,$data['list'][$i]->posisi,$data_sender);
				// print_r($data_rekap);die();
				if ($data_rekap != 0) 
				{
					# code..
					$data['list'][$i]->tr_belum_diperiksa   		= $data_rekap[0]->tr_belum_diperiksa;
					$data['list'][$i]->tr_revisi       				= $data_rekap[0]->tr_revisi;
					$data['list'][$i]->tr_tolak     				= $data_rekap[0]->tr_tolak;
					$data['list'][$i]->tr_approve    	    		= $data_rekap[0]->tr_approve;
					$data['list'][$i]->menit_efektif  				= $data_rekap[0]->menit_efektif;
					$data['list'][$i]->prosentase_menit_efektif  	= $data_rekap[0]->prosentase_menit_efektif;
				}
				else
				{
					$data['list'][$i]->tr_belum_diperiksa   		= 0;
					$data['list'][$i]->tr_revisi       				= 0;
					$data['list'][$i]->tr_tolak     				= 0;
					$data['list'][$i]->tr_approve    	    		= 0;
					$data['list'][$i]->menit_efektif  				= 0;
					$data['list'][$i]->prosentase_menit_efektif  	= 0;
				}
			}
			$this->load->view('laporan/kinerja/ajax_kinerja_anggota',$data);			
		}
	}

	public function kinerja_anggota_plt()
	{
		# code...
		$data['title']      = 'Rekapitulasi Data Kinerja Anggota PLT';
		$data['content']    = 'laporan/kinerja/data_kinerja_anggota_plt';
		$this->load->view('templateAdmin',$data);
		// print_r($data['list']);die();
	}

	Public function filter_kinerja_anggota_plt()
	{
		$get_data_pegawai = $this->Allcrud->getData('mr_pegawai',array('id'=>$this->session->userdata('sesUser')))->result_array();
		// $id = $this->session->userdata('sesPosisi');\
		$id = $get_data_pegawai[0]['posisi_plt'];
		$data_sender = $this->input->post('data_sender');	
		$data_sender = array
						(
							'atasan'   => $id,
							'bulan'    => $data_sender['data_5'],
							'tahun'    => $data_sender['data_6']
						);
		$data['sender'] 	= $data_sender;
		$data['list'] 		= $this->Mmaster->list_bawahan($data_sender);
		if ($data['list'] != 0) 
		{
			for ($i=0; $i < count($data['list']); $i++)
			{
				
				$data_rekap = $this->Mmaster->list_kinerja($data['list'][$i]->id,$data['list'][$i]->posisi,$data_sender);
				// print_r($data_rekap);die();
				if ($data_rekap != 0) 
				{
					# code..
					$data['list'][$i]->tr_belum_diperiksa   		= $data_rekap[0]->tr_belum_diperiksa;
					$data['list'][$i]->tr_revisi       				= $data_rekap[0]->tr_revisi;
					$data['list'][$i]->tr_tolak     				= $data_rekap[0]->tr_tolak;
					$data['list'][$i]->tr_approve    	    		= $data_rekap[0]->tr_approve;
					$data['list'][$i]->menit_efektif  				= $data_rekap[0]->menit_efektif;
					$data['list'][$i]->prosentase_menit_efektif  	= $data_rekap[0]->prosentase_menit_efektif;
				}
				else
				{
					$data['list'][$i]->tr_belum_diperiksa   		= 0;
					$data['list'][$i]->tr_revisi       				= 0;
					$data['list'][$i]->tr_tolak     				= 0;
					$data['list'][$i]->tr_approve    	    		= 0;
					$data['list'][$i]->menit_efektif  				= 0;
					$data['list'][$i]->prosentase_menit_efektif  	= 0;
				}
			}
			$this->load->view('laporan/kinerja/ajax_kinerja_anggota_plt',$data);
		}
	}

	public function kinerja_anggota_akademik()
	{
		# code...
		$data['title']      = 'Rekapitulasi Data Kinerja Anggota Struktur Akademik';
		$data['content']    = 'laporan/kinerja/data_kinerja_anggota_akademik';
		$this->load->view('templateAdmin',$data);
		// print_r($data['list']);die();
	}

	Public function filter_kinerja_anggota_akademik()
	{
		$get_data_pegawai = $this->Allcrud->getData('mr_pegawai',array('id'=>$this->session->userdata('sesUser')))->result_array();
		// $id = $this->session->userdata('sesPosisi');\
		$id = $get_data_pegawai[0]['posisi_akademik'];
		$data_sender = $this->input->post('data_sender');	
		$data_sender = array
						(
							'atasan'   => $id,
							'bulan'    => $data_sender['data_5'],
							'tahun'    => $data_sender['data_6']
						);
		$data['sender'] 	= $data_sender;
		$data['list'] 		= $this->Mmaster->list_bawahan($data_sender);
		if ($data['list'] != 0) 
		{
			for ($i=0; $i < count($data['list']); $i++)
			{
				
				$data_rekap = $this->Mmaster->list_kinerja($data['list'][$i]->id,$data['list'][$i]->posisi,$data_sender);
				// print_r($data_rekap);die();
				if ($data_rekap != 0) 
				{
					# code..
					$data['list'][$i]->tr_belum_diperiksa   		= $data_rekap[0]->tr_belum_diperiksa;
					$data['list'][$i]->tr_revisi       				= $data_rekap[0]->tr_revisi;
					$data['list'][$i]->tr_tolak     				= $data_rekap[0]->tr_tolak;
					$data['list'][$i]->tr_approve    	    		= $data_rekap[0]->tr_approve;
					$data['list'][$i]->menit_efektif  				= $data_rekap[0]->menit_efektif;
					$data['list'][$i]->prosentase_menit_efektif  	= $data_rekap[0]->prosentase_menit_efektif;
				}
				else
				{
					$data['list'][$i]->tr_belum_diperiksa   		= 0;
					$data['list'][$i]->tr_revisi       				= 0;
					$data['list'][$i]->tr_tolak     				= 0;
					$data['list'][$i]->tr_approve    	    		= 0;
					$data['list'][$i]->menit_efektif  				= 0;
					$data['list'][$i]->prosentase_menit_efektif  	= 0;
				}
			}
			$this->load->view('laporan/kinerja/ajax_kinerja_anggota_akademik',$data);
		}
	}
}
