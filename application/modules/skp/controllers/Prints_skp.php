<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/PHPExcel.php";
class Prints_skp extends CI_Controller {

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

	public function formulir_skp($data)
	{
		# code...
		$this->excel->setActiveSheetIndex()->setTitle('FORMULIR SKP');
		// $styleArray = array(
		// 	'font'  => array(
		// 		'name'  => 'Arial'
		// 	)
		// );			
		// $this->excel->getActiveSheet()->getStyle('A1:Z9999')->applyFromArray($styleArray);		
		$this->excel->getActiveSheet()->getColumnDimension('a')->setWidth('1');
		$this->excel->getActiveSheet()->getColumnDimension('b')->setWidth('5');
		$this->excel->getActiveSheet()->getColumnDimension('c')->setWidth('22');
		$this->excel->getActiveSheet()->getColumnDimension('d')->setWidth('65');
		$this->excel->getActiveSheet()->getColumnDimension('e')->setWidth('7');
		$this->excel->getActiveSheet()->getColumnDimension('f')->setWidth('7');
		$this->excel->getActiveSheet()->getColumnDimension('g')->setWidth('10');
		$this->excel->getActiveSheet()->getColumnDimension('h')->setWidth('7');
		$this->excel->getActiveSheet()->getColumnDimension('j')->setWidth('7');
		$this->excel->getActiveSheet()->getColumnDimension('k')->setWidth('7');				
		$this->excel->getActiveSheet()->getColumnDimension('l')->setWidth('14');		

		$this->excel->getActiveSheet()->mergeCells('b2:l2');
		$this->excel->getActiveSheet()->mergeCells('b3:l3');
		$this->excel->getActiveSheet()->mergeCells('c5:d5');		
		$this->excel->getActiveSheet()->mergeCells('f5:l5');
		$this->excel->getActiveSheet()->mergeCells('f6:h6');
		
		$this->excel->getActiveSheet()->mergeCells('i6:l6');
		$this->excel->getActiveSheet()->mergeCells('i7:l7');
		$this->excel->getActiveSheet()->mergeCells('i8:l8');
		$this->excel->getActiveSheet()->mergeCells('i9:l9');
		$this->excel->getActiveSheet()->mergeCells('i10:l10');								

		$this->excel->getActiveSheet()->mergeCells('f7:h7');
		$this->excel->getActiveSheet()->mergeCells('f8:h8');
		$this->excel->getActiveSheet()->mergeCells('f9:h9');
		$this->excel->getActiveSheet()->mergeCells('f10:h10');		
		$this->excel->getActiveSheet()->mergeCells('f11:l11');
		$this->excel->getActiveSheet()->mergeCells('e11:e12');
		$this->excel->getActiveSheet()->mergeCells('f12:g12');
		$this->excel->getActiveSheet()->mergeCells('h12:i12');				
		$this->excel->getActiveSheet()->mergeCells('j12:k12');		

		$this->excel->getActiveSheet()->getStyle('b1:b9999')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
		$this->excel->getActiveSheet()->setCellValue('b2', 'FORMULIR SASARAN KERJA');
		$this->excel->getActiveSheet()->setCellValue('b3', 'PEGAWAI NEGERI SIPIL');
		$this->excel->getActiveSheet()->getStyle('b2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('b3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);				


		$this->excel->getActiveSheet()->setCellValue('b5', 'NO');
		$this->excel->getActiveSheet()->setCellValue('c5', 'I. PEJABAT PENILAI');
		$this->excel->getActiveSheet()->setCellValue('e5', 'NO');
		$this->excel->getActiveSheet()->setCellValue('f5', 'II. PEGAWAI NEGERI SIPIL YANG DINILAI');
		$this->excel->getActiveSheet()->getStyle('b5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('e5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);						

		$counter_x = 6;
		for ($i=1; $i <=5 ; $i++) { 
			# code...
			$this->excel->getActiveSheet()->setCellValue('b'.$counter_x, $i);
			$this->excel->getActiveSheet()->setCellValue('e'.$counter_x, $i);		
			$this->excel->getActiveSheet()->getStyle('b'.$counter_x.':e'.$counter_x)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
			$this->excel->getActiveSheet()->getStyle('b'.$counter_x)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);				
			$counter_x++;				
		}		
		
		$this->excel->getActiveSheet()->setCellValue('c6', 'Nama');
		$this->excel->getActiveSheet()->setCellValue('c7', 'NIP.');
		$this->excel->getActiveSheet()->setCellValue('c8', 'Pangkat/Gol.Ruang');
		$this->excel->getActiveSheet()->setCellValue('c9', 'Jabatan');
		$this->excel->getActiveSheet()->setCellValue('c10', 'Unit Kerja');

		$pangkat_atasan         = ($data['atasan'][0]->nama_pangkat != '-') ? $data['atasan'][0]->nama_pangkat : '' ;
		$ruang_atasan           = ($data['atasan'][0]->nama_golongan != '-') ? ', ('.$data['atasan'][0]->nama_golongan.') ' : '' ;
		$tmt_pangkat_atasan     = ($data['atasan'][0]->tmt_pangkat != '-') ? $data['atasan'][0]->tmt_pangkat : '' ;
		$remarks_pangkat_atasan = $pangkat_atasan.$ruang_atasan.$tmt_pangkat_atasan;		
		$this->excel->getActiveSheet()->setCellValue('d6', $data['atasan'][0]->nama_pegawai);
		$this->excel->getActiveSheet()->setCellValue('d7', "'".$data['atasan'][0]->nip);
		$this->excel->getActiveSheet()->setCellValue('d8', $remarks_pangkat_atasan);
		$this->excel->getActiveSheet()->setCellValue('d9', $data['atasan'][0]->nama_jabatan);
		$this->excel->getActiveSheet()->setCellValue('d10', $data['atasan'][0]->nama_eselon2.' '.$data['atasan'][0]->nama_eselon1);				
		
		$this->excel->getActiveSheet()->setCellValue('f6', 'Nama');
		$this->excel->getActiveSheet()->setCellValue('f7', 'NIP.');
		$this->excel->getActiveSheet()->setCellValue('f8', 'Pangkat/Gol.Ruang');
		$this->excel->getActiveSheet()->setCellValue('f9', 'Jabatan');
		$this->excel->getActiveSheet()->setCellValue('f10', 'Unit Kerja');							

		$pangkat         = ($data['infoPegawai'][0]->nama_pangkat != '-') ? $data['infoPegawai'][0]->nama_pangkat : '' ;
		$ruang           = ($data['infoPegawai'][0]->nama_golongan != '-') ? ', ('.$data['infoPegawai'][0]->nama_golongan.') ' : '' ;
		$tmt_pangkat     = ($data['infoPegawai'][0]->tmt_pangkat != '-') ? $data['infoPegawai'][0]->tmt_pangkat : '' ;
		$remarks_pangkat = $pangkat.$ruang.$tmt_pangkat;		
		$this->excel->getActiveSheet()->setCellValue('i6', $data['infoPegawai'][0]->nama_pegawai);
		$this->excel->getActiveSheet()->setCellValue('i7', "'".$data['infoPegawai'][0]->nip);
		$this->excel->getActiveSheet()->setCellValue('i8', $remarks_pangkat);
		$this->excel->getActiveSheet()->setCellValue('i9', $data['infoPegawai'][0]->nama_jabatan);
		$this->excel->getActiveSheet()->setCellValue('i10', $data['infoPegawai'][0]->nama_eselon2.' '.$data['infoPegawai'][0]->nama_eselon1);		
				
		$this->excel->getActiveSheet()->setCellValue('b11', 'NO');
		$this->excel->getActiveSheet()->setCellValue('c11', 'KEGIATAN TUGAS JABATAN');
		$this->excel->getActiveSheet()->setCellValue('e11', 'AK');
		$this->excel->getActiveSheet()->setCellValue('f11', 'TARGET');
						

		$this->excel->getActiveSheet()->setCellValue('f12', 'Kuant/Output');
		$this->excel->getActiveSheet()->setCellValue('h12', 'Kual/Mutu');
		$this->excel->getActiveSheet()->setCellValue('j12', 'Waktu');
		$this->excel->getActiveSheet()->setCellValue('l12', 'Biaya');	
		for ($i=1; $i <= 11; $i++) {
			# code...
			$this->excel->getActiveSheet()->getStyle($this->Globalrules->data_alphabet($i).'5:'.$this->Globalrules->data_alphabet($i).'5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);				
			$this->excel->getActiveSheet()->getStyle($this->Globalrules->data_alphabet($i).'5:'.$this->Globalrules->data_alphabet($i).'12')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);				
			$this->excel->getActiveSheet()->getStyle($this->Globalrules->data_alphabet($i).'11:'.$this->Globalrules->data_alphabet($i).'12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle($this->Globalrules->data_alphabet($i).'11:'.$this->Globalrules->data_alphabet($i).'12')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);				
			$this->excel->getActiveSheet()->getStyle($this->Globalrules->data_alphabet($i).'5:'.$this->Globalrules->data_alphabet($i).'12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		}
		$this->excel->getActiveSheet()->mergeCells('b11:b12');
		$this->excel->getActiveSheet()->mergeCells('c11:d12');			

		$counter = 0;
		$first_counter = 13;		
		if ($data['list_skp'] != 0) {
		    # code...
		    for ($i=0; $i < count($data['list_skp']); $i++) {
		        # code...
				$counter                = $first_counter + $i;
				$kegiatan               = $data['list_skp'][$i]->kegiatan;
				if ($data['infoPegawai'][0]->kat_posisi == 1) {
					# code...
					if ($data['list_skp'][$i]->id_skp_master) $kegiatan=$data['list_skp'][$i]->kegiatan_skp;							
				}
				elseif ($data['infoPegawai'][0]->kat_posisi == 2) {
					# code...
					if ($data['list_skp'][$i]->id_skp_jft) $kegiatan=$data['list_skp'][$i]->kegiatan_skp_jft;							
				}						
				elseif ($data['infoPegawai'][0]->kat_posisi == 4) {
					# code...
					if ($data['list_skp'][$i]->id_skp_jfu) $kegiatan=$data['list_skp'][$i]->kegiatan_skp_jfu;							
				}
						
				$ak_target              = $data['list_skp'][$i]->AK_target;if ($data['list_skp'][$i]->AK_target == 0) $ak_target='-';
				$target_qty             = $data['list_skp'][$i]->target_qty;
				$target_kualitasmutu    = $data['list_skp'][$i]->target_kualitasmutu;
				$target_waktu_bln       = $data['list_skp'][$i]->target_waktu_bln;
				$target_biaya           = $data['list_skp'][$i]->target_biaya;if ($data['list_skp'][$i]->target_biaya == 0) $target_biaya='-';
				$target_output_name     = ($data['list_skp'][$i]->target_output_name != '') ? $data['list_skp'][$i]->target_output_name : '-' ;

				$this->excel->getActiveSheet()->mergeCells('c'.$counter.':d'.$counter);
				$this->excel->getActiveSheet()->mergeCells('h'.$counter.':i'.$counter);								

				$this->excel->getActiveSheet()->setCellValue('b'.$counter, $i+1);
				$this->excel->getActiveSheet()->setCellValue('c'.$counter, $kegiatan);
				$this->excel->getActiveSheet()->setCellValue('e'.$counter, $ak_target);
				$this->excel->getActiveSheet()->setCellValue('f'.$counter, $target_qty);
				$this->excel->getActiveSheet()->setCellValue('g'.$counter, $target_output_name);				
				$this->excel->getActiveSheet()->setCellValue('h'.$counter, $target_kualitasmutu);
				$this->excel->getActiveSheet()->setCellValue('j'.$counter, $target_waktu_bln);
				$this->excel->getActiveSheet()->setCellValue('k'.$counter, " bulan");				
				$this->excel->getActiveSheet()->setCellValue('l'.$counter, $target_biaya);

				for ($ii=1; $ii <= 11; $ii++) {
						# code...
					$iii = 2;$iv = 3;
					if ($ii != 5 && $ii != 6 && $ii != 9 && $ii != 10) {
						# code...
						$this->excel->getActiveSheet()->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);						
					}
					else
					{
						$this->excel->getActiveSheet(2)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);					
					}
					$this->excel->getActiveSheet()->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->excel->getActiveSheet()->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

					$this->excel->getActiveSheet()->getStyle('b'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->excel->getActiveSheet()->getStyle('c'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					$this->excel->getActiveSheet()->getStyle('c'.$counter)->getAlignment()->setWrapText(true);
					$this->excel->getActiveSheet()->getStyle('g'.$counter)->getAlignment()->setWrapText(true);					
					$iii++;$iv++;					
				}

		    }

		}	

		$counter = $counter + 3;					
		$this->excel->getActiveSheet()->mergeCells('c'.$counter.':d'.$counter);		
		$this->excel->getActiveSheet()->setCellValue('i'.$counter, 'Pegawai Negeri Sipil Yang Dinilai');		
		$this->excel->getActiveSheet()->setCellValue('c'.$counter, 'Pejabat Penilai,');
		$this->excel->getActiveSheet()->getStyle('c'.$counter.':i'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);								

		$counter = $counter + 5;					
		$this->excel->getActiveSheet()->mergeCells('c'.$counter.':d'.$counter);		
		$this->excel->getActiveSheet()->setCellValue('i'.$counter, $data['infoPegawai'][0]->nama_pegawai);		
		$this->excel->getActiveSheet()->setCellValue('c'.$counter, $data['atasan'][0]->nama_pegawai);
		$this->excel->getActiveSheet()->getStyle('c'.$counter.':i'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
	}	

	public function penilaian_capaian_skp($data)
	{
		# code...		
		$total_realisasi_skp  = "";		
		$nama_pegawai_atasan  = "";
		$nip_atasan           = "";
		if ($data['atasan'] != 0 || $data['atasan'] != '') {
			$nama_pegawai_atasan  = $data['atasan'][0]->nama_pegawai;
			$nip_atasan           = $data['atasan'][0]->nip;
		}		
		$this->excel->createSheet(1);
		$this->excel->setActiveSheetIndex(1)->setTitle('PENILAIAN CAPAIAN SKP');
		// $styleArray = array(
		// 	'font'  => array(
		// 		'name'  => 'Arial'
		// 	)
		// );			
		// $this->excel->getActiveSheet(1)->getStyle('A1:Z9999')->applyFromArray($styleArray);		
		$this->excel->getActiveSheet(1)->getColumnDimension('a')->setWidth('0.8');
		$this->excel->getActiveSheet(1)->getColumnDimension('b')->setWidth('5');
		$this->excel->getActiveSheet(1)->getColumnDimension('c')->setWidth('70');
		$this->excel->getActiveSheet(1)->getColumnDimension('d')->setWidth('7');
		$this->excel->getActiveSheet(1)->getColumnDimension('e')->setWidth('4');
		$this->excel->getActiveSheet(1)->getColumnDimension('f')->setWidth('9');
		$this->excel->getActiveSheet(1)->getColumnDimension('g')->setWidth('4');
		$this->excel->getActiveSheet(1)->getColumnDimension('h')->setWidth('1');
		$this->excel->getActiveSheet(1)->getColumnDimension('i')->setWidth('3');
		$this->excel->getActiveSheet(1)->getColumnDimension('j')->setWidth('6');
		$this->excel->getActiveSheet(1)->getColumnDimension('k')->setWidth('9');
		$this->excel->getActiveSheet(1)->getColumnDimension('l')->setWidth('5');
		$this->excel->getActiveSheet(1)->getColumnDimension('m')->setWidth('4');
		$this->excel->getActiveSheet(1)->getColumnDimension('n')->setWidth('9');
		$this->excel->getActiveSheet(1)->getColumnDimension('m')->setWidth('7');
		$this->excel->getActiveSheet(1)->getColumnDimension('o')->setWidth('4');
		$this->excel->getActiveSheet(1)->getColumnDimension('p')->setWidth('1');
		$this->excel->getActiveSheet(1)->getColumnDimension('q')->setWidth('3');
		$this->excel->getActiveSheet(1)->getColumnDimension('r')->setWidth('6');
		$this->excel->getActiveSheet(1)->getColumnDimension('s')->setWidth('9');
		$this->excel->getActiveSheet(1)->getColumnDimension('t')->setWidth('8');								
		$this->excel->getActiveSheet(1)->getColumnDimension('u')->setWidth('8');
		
		$this->excel->getActiveSheet(1)->getRowDimension('7')->setRowHeight('30');		
		$this->excel->getActiveSheet(1)->getRowDimension('8')->setRowHeight('30');		

		// $this->excel->getActiveSheet()->getStyle('b1:b9999')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
		$this->excel->getActiveSheet(1)->mergeCells('b2:o2');
		$this->excel->getActiveSheet(1)->mergeCells('b3:o3');
		$this->excel->getActiveSheet(1)->mergeCells('e7:k7');
		$this->excel->getActiveSheet(1)->mergeCells('m7:s7');
		$this->excel->getActiveSheet(1)->mergeCells('b7:b8');
		$this->excel->getActiveSheet(1)->mergeCells('c7:c8');
		$this->excel->getActiveSheet(1)->mergeCells('d7:d8');
		$this->excel->getActiveSheet(1)->mergeCells('l7:l8');
		$this->excel->getActiveSheet(1)->mergeCells('t7:t8');
		$this->excel->getActiveSheet(1)->mergeCells('u7:u8');																
		$this->excel->getActiveSheet(1)->mergeCells('e8:f8');
		$this->excel->getActiveSheet(1)->mergeCells('g8:h8');		
		$this->excel->getActiveSheet(1)->mergeCells('i8:j8');
		$this->excel->getActiveSheet(1)->mergeCells('m8:n8');
		$this->excel->getActiveSheet(1)->mergeCells('o8:p8');
		$this->excel->getActiveSheet(1)->mergeCells('q8:r8');

		$this->excel->getActiveSheet(1)->mergeCells('e9:f9');
		$this->excel->getActiveSheet(1)->mergeCells('g9:h9');		
		$this->excel->getActiveSheet(1)->mergeCells('i9:j9');
		$this->excel->getActiveSheet(1)->mergeCells('m9:n9');
		$this->excel->getActiveSheet(1)->mergeCells('o9:p9');
		$this->excel->getActiveSheet(1)->mergeCells('q9:r9');		
		

		$this->excel->getActiveSheet(1)->setCellValue('b2', 'PENILAIAN CAPAIAN SASARAN KERJA');
		$this->excel->getActiveSheet(1)->setCellValue('b3', 'PEGAWAI NEGERI SIPIL');
		$this->excel->getActiveSheet(1)->getStyle('b2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(1)->getStyle('b3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet(1)->setCellValue('b6', 'Jangka Waktu Penilaian . . . s.d . . . ');

		$this->excel->getActiveSheet(1)->setCellValue('b7', 'NO');
		$this->excel->getActiveSheet(1)->setCellValue('c7', 'KEGIATAN TUGAS JABATAN');
		$this->excel->getActiveSheet(1)->setCellValue('d7', 'AK');
		$this->excel->getActiveSheet(1)->setCellValue('e7', 'TARGET');
		$this->excel->getActiveSheet(1)->setCellValue('l7', 'AK');
		$this->excel->getActiveSheet(1)->setCellValue('m7', 'REALISASI');
		$this->excel->getActiveSheet(1)->setCellValue('t7', 'PENGHITUNGAN');
		$this->excel->getActiveSheet(1)->setCellValue('u7', 'NILAI CAPAIAN SKP');		
		
		$this->excel->getActiveSheet(1)->setCellValue('e8', 'Kuant/Output');
		$this->excel->getActiveSheet(1)->setCellValue('g8', 'Kual/Mutu');
		$this->excel->getActiveSheet(1)->setCellValue('i8', 'Waktu');
		$this->excel->getActiveSheet(1)->setCellValue('k8', 'Biaya');
		$this->excel->getActiveSheet(1)->setCellValue('m8', 'Kuant/Output');
		$this->excel->getActiveSheet(1)->setCellValue('o8', 'Kual/Mutu');
		$this->excel->getActiveSheet(1)->setCellValue('q8', 'Waktu');
		$this->excel->getActiveSheet(1)->setCellValue('s8', 'Biaya');

		$this->excel->getActiveSheet(1)->getStyle('b7:o7')->getAlignment()->setWrapText(true);		
		$this->excel->getActiveSheet(1)->setCellValue('b9', 1);
		$this->excel->getActiveSheet(1)->setCellValue('c9', 2);
		$this->excel->getActiveSheet(1)->setCellValue('d9', 3);
		$this->excel->getActiveSheet(1)->setCellValue('e9', 4);
		$this->excel->getActiveSheet(1)->setCellValue('g9', 5);
		$this->excel->getActiveSheet(1)->setCellValue('i9', 6);
		$this->excel->getActiveSheet(1)->setCellValue('k9', 7);
		$this->excel->getActiveSheet(1)->setCellValue('l9', 8);
		$this->excel->getActiveSheet(1)->setCellValue('m9', 9);
		$this->excel->getActiveSheet(1)->setCellValue('o9', 10);
		$this->excel->getActiveSheet(1)->setCellValue('q9', 11);
		$this->excel->getActiveSheet(1)->setCellValue('s9', 12);
		$this->excel->getActiveSheet(1)->setCellValue('t9', 13);
		$this->excel->getActiveSheet(1)->setCellValue('u9', 14);		
		for ($i=1; $i <= 20; $i++) {
			# code...
			$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($i).'7'.':'.$this->Globalrules->data_alphabet($i).'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);			
			$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($i).'7'.':'.$this->Globalrules->data_alphabet($i).'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle($this->Globalrules->data_alphabet($i).'7'.':'.$this->Globalrules->data_alphabet($i).'9')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($i).'7'.':'.$this->Globalrules->data_alphabet($i).'9')->getAlignment()->setWrapText(true);			
		}									

		$counter       = 0;
		$first_counter = 10;
		if ($data['list_skp'] != 0) {
			# code...
			for ($i=0; $i < count($data['list_skp']); $i++) {
				# code...
				$counter                = $first_counter + $i;
				$kegiatan               = $data['list_skp'][$i]->kegiatan;

				if ($data['infoPegawai'][0]->kat_posisi == 1) {
					# code...
					if ($data['list_skp'][$i]->id_skp_master) $kegiatan=$data['list_skp'][$i]->kegiatan_skp;							
				}
				elseif ($data['infoPegawai'][0]->kat_posisi == 2) {
					# code...
					if ($data['list_skp'][$i]->id_skp_jft) $kegiatan=$data['list_skp'][$i]->kegiatan_skp_jft;							
				}						
				elseif ($data['infoPegawai'][0]->kat_posisi == 4) {
					# code...
					if ($data['list_skp'][$i]->id_skp_jfu) $kegiatan=$data['list_skp'][$i]->kegiatan_skp_jfu;							
				}

				$ak_target              = ($data['infoPegawai'][0]->kat_posisi == 2) ? $data['list_skp'][$i]->AK_target : '' ;
				$target_qty             = $data['list_skp'][$i]->target_qty;
				$target_kualitasmutu    = $data['list_skp'][$i]->target_kualitasmutu;
				$target_waktu_bln       = $data['list_skp'][$i]->target_waktu_bln;
				$target_biaya           = $data['list_skp'][$i]->target_biaya;if ($data['list_skp'][$i]->target_biaya == 0) $target_biaya='-';
				$target_output_name     = ($data['list_skp'][$i]->target_output_name != '') ? $data['list_skp'][$i]->target_output_name : '-' ;
				$realisasi_kuantitas    = $data['list_skp'][$i]->realisasi_kuantitas;
				$realisasi_kualitasmutu = $data['list_skp'][$i]->realisasi_kualitasmutu;
				$realisasi_biaya        = $data['list_skp'][$i]->realisasi_biaya;
				$realisasi_waktu        = $data['list_skp'][$i]->realisasi_waktu;								

				$this->excel->getActiveSheet(1)->mergeCells('g'.$counter.':h'.$counter);
				$this->excel->getActiveSheet(1)->mergeCells('o'.$counter.':p'.$counter);								

				$this->excel->getActiveSheet(1)->setCellValue('b'.$counter, $i+1);
				$this->excel->getActiveSheet(1)->setCellValue('c'.$counter, $kegiatan);
				$this->excel->getActiveSheet(1)->setCellValue('d'.$counter, $ak_target);

				$this->excel->getActiveSheet(1)->setCellValue('e'.$counter, $target_qty);
				$this->excel->getActiveSheet(1)->setCellValue('f'.$counter, $target_output_name);						
				$this->excel->getActiveSheet(1)->setCellValue('g'.$counter, $target_kualitasmutu);
				$this->excel->getActiveSheet(1)->setCellValue('i'.$counter, $target_waktu_bln);
				$this->excel->getActiveSheet(1)->setCellValue('j'.$counter, "bulan");						
				$this->excel->getActiveSheet(1)->setCellValue('k'.$counter, $target_biaya);

				$this->excel->getActiveSheet(1)->setCellValue('l'.$counter, $data['list_skp'][$i]->AK_realisasi);
				$this->excel->getActiveSheet(1)->setCellValue('m'.$counter, $realisasi_kuantitas);
				$this->excel->getActiveSheet(1)->setCellValue('n'.$counter, $target_output_name);						
				$this->excel->getActiveSheet(1)->setCellValue('o'.$counter, $realisasi_kualitasmutu);
				$this->excel->getActiveSheet(1)->setCellValue('q'.$counter, $target_waktu_bln);
				$this->excel->getActiveSheet(1)->setCellValue('r'.$counter, "bulan");						
				$this->excel->getActiveSheet(1)->setCellValue('s'.$counter, number_format($realisasi_biaya));
				$this->excel->getActiveSheet(1)->setCellValue('t'.$counter, $data['list_skp'][$i]->perhitungan['aspek']);
				$this->excel->getActiveSheet(1)->setCellValue('u'.$counter, number_format($data['list_skp'][$i]->perhitungan['nilai_capaian_skp'],2));

				for ($ii=1; $ii <= 20; $ii++) {
					# code...
					$iii = 2;
					$iv = 19;
					$v = 20;					
					if ($ii != 4 && $ii != 5 && $ii != 8 && $ii != 9 && $ii != 12 && $ii != 13 && $ii != 16 && $ii != 17) {
						# code...
						$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);						
					} else {
						# code...
						$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);			
					}
					$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getAlignment()->setWrapText(true);									
					$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($iii).$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($iv).$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
					$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($v).$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);															
					// $this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				}
			}

			if ($data['tr_tugas_tambahan'] != 0) {
					# code...
					$counter = $counter + 1;
					$break_1 = $counter;
					$this->excel->getActiveSheet(1)->setCellValue('c'.$counter, 'II. TUGAS TAMBAHAN DAN KREATIVITAS/UNSUR PENDUKUNG');
					$this->excel->getActiveSheet()->mergeCells('e'.$counter.':'.'o'.$counter);
					$counter = $counter + 1;
					$break_2 = $counter;
					$this->excel->getActiveSheet(1)->setCellValue('b'.$counter, '1');
					$this->excel->getActiveSheet(1)->setCellValue('c'.$counter, 'TUGAS TAMBAHAN');
					$this->excel->getActiveSheet()->mergeCells('e'.$counter.':'.'n'.$counter);
					$this->excel->getActiveSheet(1)->setCellValue('o'.$counter, $data['tugas_tambahan']);

					for ($i=0; $i < count($data['tr_tugas_tambahan']); $i++) {
							# code...
							$counter++;
							$this->excel->getActiveSheet(1)->setCellValue('b'.$counter, "1 . ".($i+1));
							$this->excel->getActiveSheet(1)->setCellValue('c'.$counter, $data['tr_tugas_tambahan'][$i]->keterangan);
							$this->excel->getActiveSheet(1)->setCellValue('j'.$counter, '1');
							$this->excel->getActiveSheet()->mergeCells('e'.$counter.':'.'h'.$counter);
							$this->excel->getActiveSheet()->mergeCells('j'.$counter.':'.'m'.$counter);
							for ($ii=1; $ii <= 14; $ii++) {
									# code...
									$iii = 2;$iv = 3;
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$break_1)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$break_2)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$break_1)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$break_2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$break_1)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$break_2)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

									$this->excel->getActiveSheet(1)->getStyle('b'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
									$this->excel->getActiveSheet(1)->getStyle('c'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
									$this->excel->getActiveSheet(1)->getStyle('c'.$counter)->getAlignment()->setWrapText(true);
									$iii++;$iv++;
							}
					}
			}

			if ($data['tr_kreativitas'] != 0) {
					# code...
					$counter = $counter + 1;
					$break_3 = $counter;
					$this->excel->getActiveSheet(1)->setCellValue('b'.$counter, '2');
					$this->excel->getActiveSheet(1)->setCellValue('c'.$counter, 'KREATIVITAS');
					$this->excel->getActiveSheet(1)->setCellValue('o'.$counter, $data['kreativitas']);
					$this->excel->getActiveSheet()->mergeCells('e'.$counter.':'.'n'.$counter);
					for ($i=0; $i < count($data['tr_kreativitas']); $i++) {
							# code...
							$counter++;
							$this->excel->getActiveSheet(1)->setCellValue('b'.$counter, "2 . ".($i+1));
							$this->excel->getActiveSheet(1)->setCellValue('c'.$counter, $data['tr_kreativitas'][$i]->keterangan);
							$this->excel->getActiveSheet(1)->setCellValue('j'.$counter, $data['tr_kreativitas'][$i]->nilai);
							$this->excel->getActiveSheet()->mergeCells('e'.$counter.':'.'h'.$counter);
							$this->excel->getActiveSheet()->mergeCells('j'.$counter.':'.'m'.$counter);
							for ($ii=1; $ii <= 14; $ii++) {
									# code...
									$iii = 2;$iv = 3;
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$break_3)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$break_3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$break_3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
									$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet($ii).$counter)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

									$this->excel->getActiveSheet(1)->getStyle('b'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
									$this->excel->getActiveSheet(1)->getStyle('c'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
									$this->excel->getActiveSheet(1)->getStyle('c'.$counter)->getAlignment()->setWrapText(true);
									$iii++;$iv++;
							}
					}
			}

			$counter   = $counter + 1;
			$counter_1 = $counter + 1;
			$this->excel->getActiveSheet()->mergeCells('b'.$counter.':'.'t'.$counter_1);
			$this->excel->getActiveSheet(1)->setCellValue('b'.$counter, 'NILAI CAPAIAN SKP');
			$this->excel->getActiveSheet(1)->setCellValue('u'.$counter, number_format($data['summary_skp_dan_prilaku'],2));
			// $this->excel->getActiveSheet(1)->setCellValue('u'.$counter_1, $this->Globalrules->nilai_capaian_skp($total_realisasi_skp)['value']);
			$this->excel->getActiveSheet(1)->setCellValue('u'.$counter_1, $this->Globalrules->nilai_capaian_skp($data['summary_skp_dan_prilaku'])['value']);

			$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet(1).$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet(1).$counter)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet(1)->getStyle('b'.$counter.':'.'u'.$counter_1)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet(14).$counter)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet(14).$counter_1)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet(14).$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet(1)->getStyle($this->Globalrules->data_alphabet(14).$counter_1)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$counter_2 = $counter + 5;
			$this->excel->getActiveSheet(1)->setCellValue('n'.$counter_2, 'Pejabat Penilai,');						
			$this->excel->getActiveSheet(1)->setCellValue('n'.($counter_2+5), strtoupper($nama_pegawai_atasan));
			$this->excel->getActiveSheet(1)->setCellValue('n'.($counter_2+6), "NIP. ".$nip_atasan);			
		}		
	}

	public function penilaian_prestasi_kerja($data)
	{
		# code...
		$pangkat       = "";
		$ruang         = "";
		$tmt_pangkat  = "";
		
		$nama_pegawai_atasan  = "";
		$nama_jabatan_atasan  = "";
		$nama_eselon1_atasan  = "";
		$nama_eselon2_atasan  = "";
		$nip_atasan           = "";
		$pangkat_atasan       = "";
		$ruang_atasan         = "";
		$tmt_pangkat_atasan  = "";
		
		$nama_pegawai_atasan_penilai  = "";
		$nama_jabatan_atasan_penilai  = "";
		$nama_eselon1_atasan_penilai  = "";
		$nama_eselon2_atasan_penilai  = "";
		$nip_atasan_penilai           = "";
		$pangkat_atasan_penilai       = "";
		$ruang_atasan_penilai         = "";
		$tmt_pangkat_atasan_penilai  = "";

		if ($data['infoPegawai'] != 0 || $data['infoPegawai'] != '') {
			$pangkat     = ($data['infoPegawai'][0]->nama_pangkat != '-') ? $data['infoPegawai'][0]->nama_pangkat : '' ;
			$ruang       = ($data['infoPegawai'][0]->nama_golongan != '-') ? ', ('.$data['infoPegawai'][0]->nama_golongan.') ' : '' ;
			$tmt_pangkat = ($data['infoPegawai'][0]->tmt_pangkat != '-') ? $data['infoPegawai'][0]->tmt_pangkat : '' ;			
		}

		if ($data['atasan'] != 0 || $data['atasan'] != '') {
			$nama_pegawai_atasan  = $data['atasan'][0]->nama_pegawai;
			$nama_jabatan_atasan  = $data['atasan'][0]->nama_jabatan;
			$nama_eselon1_atasan  = $data['atasan'][0]->nama_eselon1;
			$nama_eselon2_atasan  = $data['atasan'][0]->nama_eselon2;
			$nip_atasan           = $data['atasan'][0]->nip;
			$pangkat_atasan     = ($data['atasan'][0]->nama_pangkat != '-') ? $data['atasan'][0]->nama_pangkat : '' ;
			$ruang_atasan       = ($data['atasan'][0]->nama_golongan != '-') ? ', ('.$data['atasan'][0]->nama_golongan.') ' : '' ;
			$tmt_pangkat_atasan = ($data['atasan'][0]->tmt_pangkat != '-') ? $data['atasan'][0]->tmt_pangkat : '' ;
		}

		if ($data['atasan_penilai'] != 0 || $data['atasan_penilai'] != '') {		
			$nama_pegawai_atasan_penilai  = $data['atasan_penilai'][0]->nama_pegawai;
			$nama_jabatan_atasan_penilai  = $data['atasan_penilai'][0]->nama_jabatan;
			$nama_eselon1_atasan_penilai  = $data['atasan_penilai'][0]->nama_eselon1;
			$nama_eselon2_atasan_penilai  = $data['atasan_penilai'][0]->nama_eselon2;
			$nip_atasan_penilai           = $data['atasan_penilai'][0]->nip;
			$pangkat_atasan_penilai     = ($data['atasan_penilai'][0]->nama_pangkat != '-') ? $data['atasan_penilai'][0]->nama_pangkat : '' ;
			$ruang_atasan_penilai       = ($data['atasan_penilai'][0]->nama_golongan != '-') ? ', ('.$data['atasan_penilai'][0]->nama_golongan.') ' : '' ;
			$tmt_pangkat_atasan_penilai = ($data['atasan_penilai'][0]->tmt_pangkat != '-') ? $data['atasan_penilai'][0]->tmt_pangkat : '' ;
		}		
		$this->excel->createSheet(2);		
		$this->excel->setActiveSheetIndex(2);		
		//name the worksheet
		$this->excel->getActiveSheet(2)->setTitle('PENILAIAN PRESTASI KERJA');
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$signature = FCPATH.'public/lambang-pancasila.jpg';
		$objDrawing->setPath($signature);
		$objDrawing->setOffsetX(45);                     //setOffsetX works properly
		$objDrawing->setCoordinates('D2');             //set image to cell E38
		$objDrawing->setHeight(75);                     //signature height
		$objDrawing->setWorksheet($this->excel->getActiveSheet(2));  //save
		$this->excel->getActiveSheet(2)->getColumnDimension('a')->setWidth('1');		
		$this->excel->getActiveSheet(2)->getColumnDimension('b')->setWidth('4');
		$this->excel->getActiveSheet(2)->getColumnDimension('c')->setWidth('32');
		$this->excel->getActiveSheet(2)->getColumnDimension('d')->setWidth('21');
		$this->excel->getActiveSheet(2)->getColumnDimension('e')->setWidth('10');
		$this->excel->getActiveSheet(2)->getColumnDimension('f')->setWidth('10');
		$this->excel->getActiveSheet(2)->getColumnDimension('g')->setWidth('10');
		$this->excel->getActiveSheet(2)->getColumnDimension('h')->setWidth('10');

		$this->excel->getActiveSheet(2)->setCellValue('b6', 'PENILAIAN PRESTASI KERJA');
		$this->excel->getActiveSheet(2)->setCellValue('b7', 'PEGAWAI NEGERI SIPIL');
		$this->excel->getActiveSheet(2)->mergeCells('b6:h6');
		$this->excel->getActiveSheet(2)->mergeCells('b7:h7');
		$this->excel->getActiveSheet(2)->getStyle('b6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('b7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet(2)->setCellValue('b10', 'KEMENTERIAN DALAM NEGERI');
		$this->excel->getActiveSheet(2)->setCellValue('b11', 'SEKRETARIAT JENDERAL');
		$this->excel->getActiveSheet(2)->setCellValue('f10', 'JANGKA WAKTU PENILAIAN');
		$this->excel->getActiveSheet(2)->setCellValue('f11', 'BULAN : . . . s.d 31 . . . ');
		$this->excel->getActiveSheet(2)->mergeCells('b10:c10');
		$this->excel->getActiveSheet(2)->mergeCells('b11:c11');

		$this->excel->getActiveSheet(2)->setCellValue('b13', '1');
		$this->excel->getActiveSheet(2)->setCellValue('c13', 'YANG DINILAI');
		$this->excel->getActiveSheet(2)->setCellValue('c14', 'a. Nama');
		$this->excel->getActiveSheet(2)->setCellValue('c15', 'b. NIP');
		$this->excel->getActiveSheet(2)->setCellValue('c16', 'c. Pangkat, Golongan ruang, TMT');
		$this->excel->getActiveSheet(2)->setCellValue('c17', 'd. Jabatan/Pekerjaan');
		$this->excel->getActiveSheet(2)->setCellValue('c18', 'e. Unit Organisasi');
		$this->excel->getActiveSheet(2)->setCellValue('d14', $data['infoPegawai'][0]->nama_pegawai);
		$this->excel->getActiveSheet(2)->setCellValue('d15', "'".$data['infoPegawai'][0]->nip);
		$this->excel->getActiveSheet(2)->setCellValue('d16', $pangkat.$ruang.$tmt_pangkat);
		$this->excel->getActiveSheet(2)->setCellValue('d17', $data['infoPegawai'][0]->nama_jabatan);
		$this->excel->getActiveSheet(2)->setCellValue('d18', $data['infoPegawai'][0]->nama_eselon2." ".$data['infoPegawai'][0]->nama_eselon1);
		$this->excel->getActiveSheet(2)->mergeCells('b13:b18');
		$this->excel->getActiveSheet(2)->mergeCells('c13:h13');
		$this->excel->getActiveSheet(2)->mergeCells('d14:h14');
		$this->excel->getActiveSheet(2)->mergeCells('d15:h15');
		$this->excel->getActiveSheet(2)->mergeCells('d16:h16');
		$this->excel->getActiveSheet(2)->mergeCells('d17:h17');
		$this->excel->getActiveSheet(2)->mergeCells('d18:h18');
		$this->excel->getActiveSheet(2)->getStyle('c13:h13')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c14:h14')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c15:h15')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c16:h16')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c17:h17')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c18:h18')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$this->excel->getActiveSheet(2)->setCellValue('b19', '2');
		$this->excel->getActiveSheet(2)->setCellValue('c19', 'PEJABAT PENILAI');
		$this->excel->getActiveSheet(2)->setCellValue('c20', 'a. Nama');
		$this->excel->getActiveSheet(2)->setCellValue('c21', 'b. NIP');
		$this->excel->getActiveSheet(2)->setCellValue('c22', 'c. Pangkat, Golongan ruang, TMT');
		$this->excel->getActiveSheet(2)->setCellValue('c23', 'd. Jabatan/Pekerjaan');
		$this->excel->getActiveSheet(2)->setCellValue('c24', 'e. Unit Organisasi');
		$this->excel->getActiveSheet(2)->setCellValue('d20', $nama_pegawai_atasan);
		$this->excel->getActiveSheet(2)->setCellValue('d21', "'".$nip_atasan);
		$this->excel->getActiveSheet(2)->setCellValue('d22', $pangkat_atasan.$ruang_atasan.$tmt_pangkat_atasan);
		$this->excel->getActiveSheet(2)->setCellValue('d23', $nama_jabatan_atasan);
		$this->excel->getActiveSheet(2)->setCellValue('d24', $nama_eselon2_atasan." ".$nama_eselon1_atasan);
		$this->excel->getActiveSheet(2)->mergeCells('b19:b24');
		$this->excel->getActiveSheet(2)->mergeCells('c19:h19');
		$this->excel->getActiveSheet(2)->mergeCells('d20:h20');
		$this->excel->getActiveSheet(2)->mergeCells('d21:h21');
		$this->excel->getActiveSheet(2)->mergeCells('d22:h22');
		$this->excel->getActiveSheet(2)->mergeCells('d23:h23');
		$this->excel->getActiveSheet(2)->mergeCells('d24:h24');
		$this->excel->getActiveSheet(2)->getStyle('c19:h19')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c20:h20')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c21:h21')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c22:h22')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c23:h23')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c24:h24')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$this->excel->getActiveSheet(2)->setCellValue('b25', '3');
		$this->excel->getActiveSheet(2)->setCellValue('c25', 'ATASAN PEJABAT PENILAI');
		$this->excel->getActiveSheet(2)->setCellValue('c26', 'a. Nama');
		$this->excel->getActiveSheet(2)->setCellValue('c27', 'b. NIP');
		$this->excel->getActiveSheet(2)->setCellValue('c28', 'c. Pangkat, Golongan ruang, TMT');
		$this->excel->getActiveSheet(2)->setCellValue('c29', 'd. Jabatan/Pekerjaan');
		$this->excel->getActiveSheet(2)->setCellValue('c30', 'e. Unit Organisasi');
		$this->excel->getActiveSheet(2)->setCellValue('d26', $nama_pegawai_atasan_penilai);
		$this->excel->getActiveSheet(2)->setCellValue('d27', "'".$nip_atasan_penilai);
		$this->excel->getActiveSheet(2)->setCellValue('d28', $pangkat_atasan_penilai.$ruang_atasan_penilai.$tmt_pangkat_atasan_penilai);
		$this->excel->getActiveSheet(2)->setCellValue('d29', $nama_jabatan_atasan_penilai);
		$this->excel->getActiveSheet(2)->setCellValue('d30', $nama_eselon2_atasan_penilai." ".$nama_eselon1_atasan_penilai);
		$this->excel->getActiveSheet(2)->mergeCells('b25:b30');
		$this->excel->getActiveSheet(2)->mergeCells('c25:h25');
		$this->excel->getActiveSheet(2)->mergeCells('d26:h26');
		$this->excel->getActiveSheet(2)->mergeCells('d27:h27');
		$this->excel->getActiveSheet(2)->mergeCells('d28:h28');
		$this->excel->getActiveSheet(2)->mergeCells('d29:h29');
		$this->excel->getActiveSheet(2)->mergeCells('d30:h30');
		$this->excel->getActiveSheet(2)->getStyle('c25:h25')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c26:h26')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c27:h27')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c28:h28')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c29:h29')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c30:h30')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$this->excel->getActiveSheet(2)->setCellValue('b31', '4');
		$this->excel->getActiveSheet(2)->setCellValue('c31', 'UNSUR YANG DINILAI');
		$this->excel->getActiveSheet(2)->setCellValue('h31', 'Jumlah');
		$this->excel->getActiveSheet(2)->setCellValue('c32', 'a. Sasaran Kerja Pegawai (SKP)');
		$this->excel->getActiveSheet(2)->setCellValue('c33', 'b. Prilaku Kerja');
		$this->excel->getActiveSheet(2)->setCellValue('d33', '1. Orientasi Pelayanan');
		$this->excel->getActiveSheet(2)->setCellValue('d34', '2. Integritas');
		$this->excel->getActiveSheet(2)->setCellValue('d35', '3. Komitmen');
		$this->excel->getActiveSheet(2)->setCellValue('d36', '4. Disiplin');
		$this->excel->getActiveSheet(2)->setCellValue('d37', '5. Kerja Sama');
		$this->excel->getActiveSheet(2)->setCellValue('d38', '6. Kepemimpinan');
		$this->excel->getActiveSheet(2)->setCellValue('d39', '7. Jumlah');
		$this->excel->getActiveSheet(2)->setCellValue('d40', '8. Nilai Rata - rata');
		$this->excel->getActiveSheet(2)->setCellValue('d41', '9. Nilai Prilaku Kerja');
		$this->excel->getActiveSheet(2)->setCellValue('b42', 'NILAI PRESTASI KERJA');
		$this->excel->getActiveSheet(2)->setCellValue('d32', number_format($data['summary_skp']['total'],2)."  x 60%");
		$this->excel->getActiveSheet(2)->setCellValue('h32', number_format($data['summary_skp']['nilai_sasaran_kinerja_pegawai'],2));
		$this->excel->getActiveSheet(2)->setCellValue('f33', number_format($data['summary_prilaku_skp']['orientasi_pelayanan'],2));
		$this->excel->getActiveSheet(2)->setCellValue('f34', number_format($data['summary_prilaku_skp']['integritas'],2));
		$this->excel->getActiveSheet(2)->setCellValue('f35', number_format($data['summary_prilaku_skp']['komitmen'],2));
		$this->excel->getActiveSheet(2)->setCellValue('f36', number_format($data['summary_prilaku_skp']['disiplin'],2));
		$this->excel->getActiveSheet(2)->setCellValue('f37', number_format($data['summary_prilaku_skp']['kerjasama'],2));
		$this->excel->getActiveSheet(2)->setCellValue('f38', number_format($data['summary_prilaku_skp']['kepemimpinan'],2));
		$this->excel->getActiveSheet(2)->setCellValue('f39', number_format($data['summary_prilaku_skp']['jumlah'],2));
		$this->excel->getActiveSheet(2)->setCellValue('f40', number_format($data['summary_prilaku_skp']['rata_rata'],2));
		$this->excel->getActiveSheet(2)->setCellValue('h41', number_format($data['summary_prilaku_skp']['nilai_prilaku_kerja'],2));
		$this->excel->getActiveSheet(2)->setCellValue('g33', $this->Globalrules->nilai_capaian_skp($data['summary_prilaku_skp']['orientasi_pelayanan'])['value']);
		$this->excel->getActiveSheet(2)->setCellValue('g34', $this->Globalrules->nilai_capaian_skp($data['summary_prilaku_skp']['integritas'])['value']);
		$this->excel->getActiveSheet(2)->setCellValue('g35', $this->Globalrules->nilai_capaian_skp($data['summary_prilaku_skp']['komitmen'])['value']);
		$this->excel->getActiveSheet(2)->setCellValue('g36', $this->Globalrules->nilai_capaian_skp($data['summary_prilaku_skp']['disiplin'])['value']);
		$this->excel->getActiveSheet(2)->setCellValue('g37', $this->Globalrules->nilai_capaian_skp($data['summary_prilaku_skp']['kerjasama'])['value']);

		if ($data['infoPegawai'][0]->kat_posisi == 1 || $data['infoPegawai'][0]->kat_posisi == 6) {
			# code...
			$this->excel->getActiveSheet(2)->setCellValue('g38', $this->Globalrules->nilai_capaian_skp($data['summary_prilaku_skp']['kepemimpinan'])['value']);			
		}

		$this->excel->getActiveSheet(2)->setCellValue('g40', $this->Globalrules->nilai_capaian_skp($data['summary_prilaku_skp']['rata_rata'])['value']);
		$this->excel->getActiveSheet(2)->setCellValue('e41', number_format($data['summary_prilaku_skp']['rata_rata'],2)." x 40%");
		$this->excel->getActiveSheet(2)->setCellValue('h42', number_format($data['summary_skp']['nilai_sasaran_kinerja_pegawai']+$data['summary_prilaku_skp']['nilai_prilaku_kerja'],2));
		$this->excel->getActiveSheet(2)->setCellValue('h43', $this->Globalrules->nilai_capaian_skp($data['summary_skp']['nilai_sasaran_kinerja_pegawai']+$data['summary_prilaku_skp']['nilai_prilaku_kerja'])['value']);
		$this->excel->getActiveSheet(2)->mergeCells('b31:b41');
		$this->excel->getActiveSheet(2)->mergeCells('c31:g31');
		$this->excel->getActiveSheet(2)->mergeCells('d32:g32');
		$this->excel->getActiveSheet(2)->mergeCells('d33:e33');
		$this->excel->getActiveSheet(2)->mergeCells('d34:e34');
		$this->excel->getActiveSheet(2)->mergeCells('d35:e35');
		$this->excel->getActiveSheet(2)->mergeCells('d36:e36');
		$this->excel->getActiveSheet(2)->mergeCells('d37:e37');
		$this->excel->getActiveSheet(2)->mergeCells('d38:e38');
		$this->excel->getActiveSheet(2)->mergeCells('d39:e39');
		$this->excel->getActiveSheet(2)->mergeCells('d40:e40');
		$this->excel->getActiveSheet(2)->mergeCells('e41:g41');
		$this->excel->getActiveSheet(2)->mergeCells('h33:h40');
		$this->excel->getActiveSheet(2)->mergeCells('c33:c41');
		$this->excel->getActiveSheet(2)->mergeCells('b42:g43');
		$this->excel->getActiveSheet(2)->getStyle('c31:h31')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c32:h32')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c33:h33')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c34:h34')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c35:h35')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c36:h36')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c37:h37')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c38:h38')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c39:h39')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c40:h40')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('d41:g41')->getBorders()->getbottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('c41')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('h41')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('b42:h43')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$this->excel->getActiveSheet(2)->getStyle('c33')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('f33:g41')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('d32')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('h31')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('h32')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('h41:h43')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('e41')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet(2)->getStyle('b13:b18')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('b19:b24')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('b25:b30')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('b31:b41')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('b13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$this->excel->getActiveSheet(2)->getStyle('b19')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$this->excel->getActiveSheet(2)->getStyle('b25')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$this->excel->getActiveSheet(2)->getStyle('b19')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$this->excel->getActiveSheet(2)->getStyle('b25')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$this->excel->getActiveSheet(2)->getStyle('b31')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$this->excel->getActiveSheet(2)->getStyle('b13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('b19')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('b25')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('b31')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('b42')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet(2)->setCellValue('b44', '5.');
		$this->excel->getActiveSheet(2)->setCellValue('c44', 'KEBERATAN DARI PEGAWAI NEGERI');
		$this->excel->getActiveSheet(2)->setCellValue('c45', 'SIPIL YANG DINILAI (APABILA ADA)');
		$this->excel->getActiveSheet(2)->setCellValue('c55', 'Tanggal, ......................');
		$this->excel->getActiveSheet(2)->mergeCells('C44:d44');
		$this->excel->getActiveSheet(2)->mergeCells('C45:d45');
		$this->excel->getActiveSheet(2)->mergeCells('C55:h55');
		$this->excel->getActiveSheet(2)->getStyle('b44')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('c55')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('b44:b56')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('h44:h56')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('b56:h56')->getBorders()->getbottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$this->excel->getActiveSheet(2)->setCellValue('b57', '6.');
		$this->excel->getActiveSheet(2)->setCellValue('c57', 'TANGGAPAN PEJABAT PENILAI');
		$this->excel->getActiveSheet(2)->setCellValue('c58', 'ATAS KEBERATAN');
		$this->excel->getActiveSheet(2)->setCellValue('c67', 'Tanggal, ......................');
		$this->excel->getActiveSheet(2)->mergeCells('C57:d57');
		$this->excel->getActiveSheet(2)->mergeCells('C58:d58');
		$this->excel->getActiveSheet(2)->mergeCells('C67:h67');
		$this->excel->getActiveSheet(2)->getStyle('b57')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('c67')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('b56:b68')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('h56:h68')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('b68:h68')->getBorders()->getbottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$this->excel->getActiveSheet(2)->setCellValue('b69', '7.');
		$this->excel->getActiveSheet(2)->setCellValue('c69', 'KEPUTUSAN ATASAN PEJABAT');
		$this->excel->getActiveSheet(2)->setCellValue('c70', 'PENILAI ATAS KEBERATAN');
		$this->excel->getActiveSheet(2)->setCellValue('c79', 'Tanggal, ......................');
		$this->excel->getActiveSheet(2)->mergeCells('C69:d69');
		$this->excel->getActiveSheet(2)->mergeCells('C70:d70');
		$this->excel->getActiveSheet(2)->mergeCells('C79:h79');
		$this->excel->getActiveSheet(2)->getStyle('b69')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('c79')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('b69:b80')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('h69:h80')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('b80:h80')->getBorders()->getbottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$this->excel->getActiveSheet(2)->setCellValue('b81', '8.');
		$this->excel->getActiveSheet(2)->setCellValue('c81', 'REKOMENDASI');
		$this->excel->getActiveSheet(2)->mergeCells('C81:d81');
		$this->excel->getActiveSheet(2)->getStyle('b81')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('b81:b90')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('h81:h90')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('b90:h90')->getBorders()->getbottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$this->excel->getActiveSheet(2)->setCellValue('e92', '9. DIBUAT TANGGAL, ......................');
		$this->excel->getActiveSheet(2)->setCellValue('f93', 'PEJABAT PENILAI');
		$this->excel->getActiveSheet(2)->setCellValue('e99', strtoupper($nama_pegawai_atasan));
		$this->excel->getActiveSheet(2)->setCellValue('e100', "NIP. ".$nip_atasan);
		$this->excel->getActiveSheet(2)->mergeCells('e92:h92');
		$this->excel->getActiveSheet(2)->mergeCells('f93:h93');
		$this->excel->getActiveSheet(2)->mergeCells('e99:h99');
		$this->excel->getActiveSheet(2)->mergeCells('e100:h100');

		$this->excel->getActiveSheet(2)->setCellValue('b103', '10.');
		$this->excel->getActiveSheet(2)->setCellValue('c103', 'DITERIMA TANGGAL, ......................');
		$this->excel->getActiveSheet(2)->setCellValue('c104', 'PEGAWAI NEGERI SIPIL YANG DINILAI');
		$this->excel->getActiveSheet(2)->setCellValue('c110', strtoupper($data['infoPegawai'][0]->nama_pegawai));
		$this->excel->getActiveSheet(2)->setCellValue('c111', "NIP. ".$data['infoPegawai'][0]->nip);

		$this->excel->getActiveSheet(2)->setCellValue('e113', '11. DITERIMA TANGGAL, ......................');
		$this->excel->getActiveSheet(2)->setCellValue('f114', 'ATASAN PEJABAT PENILAI');
		$this->excel->getActiveSheet(2)->setCellValue('e120', strtoupper($nama_pegawai_atasan_penilai));
		$this->excel->getActiveSheet(2)->setCellValue('e121', "NIP. ".$nip_atasan_penilai);
		$this->excel->getActiveSheet(2)->mergeCells('e113:h113');
		$this->excel->getActiveSheet(2)->mergeCells('f114:h114');
		$this->excel->getActiveSheet(2)->mergeCells('e120:h120');
		$this->excel->getActiveSheet(2)->mergeCells('e121:h121');

		$this->excel->getActiveSheet(2)->getStyle('e99')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('e100')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('c110')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('c111')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('e120')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('e121')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet(2)->getStyle('e99')->getFont()->setUnderline(true);
		$this->excel->getActiveSheet(2)->getStyle('c110')->getFont()->setUnderline(true);
		$this->excel->getActiveSheet(2)->getStyle('e99')->getFont()->setUnderline(true);
		$this->excel->getActiveSheet(2)->getStyle('e120')->getFont()->setUnderline(true);

		$this->excel->getActiveSheet(2)->getStyle('b91:b123')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('h91:h123')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet(2)->getStyle('b123:h123')->getBorders()->getbottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);		
	}	

	public function skp_excel($id,$id_posisi)
	{
		# code...		
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 300);
		$data = $this->Globalrules->data_summary_skp_pegawai($id,$id_posisi);				
		$this->formulir_skp($data);
		$this->penilaian_capaian_skp($data);		
		$this->penilaian_prestasi_kerja($data);				
		$styleArray = array(
			'font'  => array(
				'name'  => 'Arial'
			)
		);			
		$this->excel->getActiveSheet()->getStyle('A1:Z9999')->applyFromArray($styleArray);
		$this->excel->getActiveSheet(1)->getStyle('A1:Z9999')->applyFromArray($styleArray);
		$this->excel->getActiveSheet(2)->getStyle('A1:Z9999')->applyFromArray($styleArray);								
		ob_clean();
		$filename = 'PENILAIAN CAPAIAN SKP  - '.date("Y").'.xlsx'; //save our workbook as this file name
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

	public function penilaian_skp_bulanan_plt()
	{
		# code...
		$posisi = $this->session->userdata('posisi_plt');
		$this->form_penilaian_skp($posisi);
	}

	public function penilaian_skp_bulanan_akademik()
	{
		# code...
		$posisi = $this->session->userdata('posisi_akademik');
		$this->form_penilaian_skp($posisi);		
	}	

	public function form_penilaian_skp($posisi)
	{
		$data['title']     = '';				
		$data['content'] = 'skp/penilaian_skp_plt_akademik/index';
		$data['id_posisi'] = $posisi;								
		$data['member']  = $this->Globalrules->list_bawahan($posisi,NULL,'penilaian_skp');		
		$this->load->view('templateAdmin',$data);		
	}	
}
  