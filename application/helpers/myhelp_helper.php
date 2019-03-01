<?php

	function menu_header()
	{
		$CI            = & get_instance();
		$id            = $CI->session->userdata('sesUser');
		$role          = $CI->session->userdata('sesRole');
		$posisi        = $CI->session->userdata('sesIdPos');
		$id_posisi     = $CI->session->userdata('sesPosisi');
		$id_kat_posisi = $CI->session->userdata('kat_posisi');
		$infoPegawai   = $CI->Globalrules->get_info_pegawai();
		$induk         = $CI->db->query(" SELECT config_menu.*,
												config_menu_akses.id_akses
										FROM config_menu
										INNER JOIN config_menu_akses
										ON    config_menu.id_menu = config_menu_akses.id_menu
										WHERE id_parent           = 0
										AND   flag                = 1
										AND   id_role             = $role
										AND   baca                = 1
										ORDER BY prioritas asc"
									);
		$notify       = $CI->db->query("SELECT a.*,
												COALESCE(sender.photo,'-') as photo_sender
										FROM log_notifikasi a
										LEFT JOIN mr_pegawai sender
										ON sender.id = a.sender										
										WHERE a.receiver    = '".$id."'
										AND   a.status_read = 0
										ORDER BY a.id DESC"
									);
		$count_notify = count($notify->result());
		$CI->load->view('templates/header/head');
		$CI->load->view('templates/header/navigation');				

		if ($id_posisi != 0) {
			# code...

			foreach($induk->result() as $row)
			{
				$y = $CI->db->query("SELECT 
											COUNT(config_menu_akses.id_menu) as jml
									FROM config_menu
									INNER JOIN config_menu_akses
									WHERE id_parent = '".$row->id_menu."'
									AND flag=1
									AND id_role = '".$role."'
									AND baca=1"
									)->row();
				$x = $y->jml;
				if ($x !=0)
				{
					$CI->load->view('templates/header/parent',array('icon'=>$row->icon,'name'=>$row->nama_menu));								

					$anak = $CI->db->query(" SELECT config_menu.*,
													config_menu_akses.id_akses
											FROM config_menu
											INNER JOIN config_menu_akses
											ON config_menu.id_menu=config_menu_akses.id_menu
											WHERE id_parent=$row->id_menu
											AND flag=1
											AND id_role=$role
											AND baca=1
											ORDER BY prioritas ASC, nama_menu ASC"
										);
					foreach($anak->result() as $baris)
					{
						$style_ul = "";
						$change_name = $baris->nama_menu;
						if (
								$baris->url_pages == 'transaksi/kinerja_anggota/0' ||
								$baris->url_pages == 'transaksi/kinerja_anggota/4' ||
								$baris->url_pages == 'transaksi/kinerja_anggota/6' ||
								$baris->url_pages == 'skp/approval_target_skp' ||
								$baris->url_pages == 'skp/penilaian_skp' ||
								$baris->url_pages == 'skp/approval_target_skp' || 
								$baris->url_pages == 'transaksi/approval_tugas_tambahan_dan_kreativitas'

							)
						{
							# code...
							$get_menu_activy = $CI->db->query("SELECT a.*
																FROM mr_pegawai a
																JOIN mr_posisi b
																ON a.posisi = b.id
																WHERE b.atasan = '".$posisi."'");

							if (count($get_menu_activy->result()) != 0)
							{
								if ($id_kat_posisi == 1) {
									# code...
									if (
											$baris->url_pages == 'transaksi/kinerja_anggota/0' ||
											$baris->url_pages == 'transaksi/kinerja_anggota/4' ||
											$baris->url_pages == 'transaksi/kinerja_anggota/6' ||
											$baris->url_pages == 'skp/approval_target_skp' ||
											$baris->url_pages == 'skp/penilaian_skp' ||
											$baris->url_pages == 'skp/approval_target_skp' || 
											$baris->url_pages == 'transaksi/approval_tugas_tambahan_dan_kreativitas'

										)
									{
										$CI->load->view('templates/header/child',array('icon'=>$row->icon,'name'=>$change_name,'url_pages'=>$baris->url_pages,'layout'=>'col-lg-10'));
									}									
								}								
							}
						}
						else
						{
							if (count($anak->result()) > 7) {
								# code...
								$CI->load->view('templates/header/child',array('icon'=>$row->icon,'name'=>$change_name,'url_pages'=>$baris->url_pages,'layout'=>'col-lg-6'));
							}
							else
							{
								$CI->load->view('templates/header/child',array('icon'=>$row->icon,'name'=>$change_name,'url_pages'=>$baris->url_pages,'layout'=>'col-lg-10'));
							}
						}

					}
					$CI->load->view('templates/header/close_tag',array('tag'=>'ul'));
					$CI->load->view('templates/header/close_tag',array('tag'=>'li'));								
				}
				else
				{
					$CI->load->view('templates/header/parent1',array('icon'=>$row->icon,'name'=>$row->nama_menu,'url_pages'=>$row->url_pages));												
				}
			}

		}
		$CI->load->view('templates/header/close_tag',array('tag'=>'ul'));
		$CI->load->view('templates/header/close_tag',array('tag'=>'div'));
		$CI->load->view('templates/header/open_tag',array('tag'=>'div','class'=>'navbar-custom-menu hidden-xs'));
		$CI->load->view('templates/header/open_tag',array('tag'=>'ul','class'=>'nav navbar-nav pull-right'));
		if ($id_posisi != 0) {
			# code...
			$CI->load->view('templates/header/message');
			$CI->load->view('templates/header/notification',array('counter'=>$count_notify,'notify_result'=>$notify->result()));																		
		}	
		$CI->load->view('templates/header/user',array('infoPegawai'=>$infoPegawai));		
		$CI->load->view('templates/header/close_tag',array('tag'=>'ul'));		
		$CI->load->view('templates/header/close_tag',array('tag'=>'div'));				
		$CI->load->view('templates/header/close_tag',array('tag'=>'nav'));				
	}


		function menuSamping(){
			$CI =& get_instance();
			$role = $CI->session->userdata('sesRole');
			$induk = $CI->db->query(" SELECT config_menu.*, config_menu_akses.id_akses FROM config_menu INNER JOIN config_menu_akses ON config_menu.id_menu=config_menu_akses.id_menu WHERE id_parent=0 AND flag=1 AND id_role=$role AND baca=1");
			foreach($induk->result() as $row){
	
				$y = $CI->db->query(" SELECT COUNT(config_menu_akses.id_menu) as jml FROM config_menu INNER JOIN config_menu_akses WHERE id_parent=$row->id_menu AND flag=1 AND id_role=$role AND baca=1")->row();
				$x = $y->jml;
				if ($x !=0){?>
					<li class="treeview"><?php echo anchor("#","<i class='".$row->icon."'></i><span>". $row->nama_menu."</span><i class='fa fa-angle-left pull-right'></i>");?>
					<ul class="treeview-menu">
				<?php $anak = $CI->db->query(" SELECT config_menu.*, config_menu_akses.id_akses FROM config_menu INNER JOIN config_menu_akses ON config_menu.id_menu=config_menu_akses.id_menu WHERE id_parent=$row->id_menu AND flag=1 AND id_role=$role AND baca=1");
					foreach($anak->result() as $baris){?>
						<li><?php echo anchor($baris->url_pages,"<i class='".$baris->icon."'></i><span>".$baris->nama_menu."</span>");?></li>
					<?php
					}
					echo "</ul></li>";
				}else{?>
					<li><?php echo anchor($row->url_pages,"<i class='".$row->icon."'></i><span>".$row->nama_menu."</span>");?></li>
				<?php
				}
			}
	
		}		
		
/***********************************************************************************************************/
		function status_pekerjaan($posisi,$status)
		{
			# code...
			$CI     =& get_instance();
			$get_count_transact = $CI->db->query("SELECT count(a.id_pekerjaan) as jumlah
												FROM tr_capaian_pekerjaan a
												JOIN mr_pegawai b
												ON a.id_pegawai = b.id
												JOIN mr_posisi c
												ON b.posisi = c.id
												JOIN mr_uraian_tugas d
												ON a.id_uraian_tugas = d.id_urtug
												WHERE a.tanggal_mulai LIKE '%".date('Y-m')."%'
												AND a.tanggal_selesai LIKE '%".date('Y-m')."%'
												AND c.atasan = '".$posisi."'
												AND a.status_pekerjaan = '".$status."'");
			return $get_count_transact->result()[0]->jumlah;
		}

		function status_pekerjaan_banding($id,$status)
		{
			# code...
			$CI     =& get_instance();
			$get_count_transact = $CI->db->query("SELECT count(a.id_pekerjaan) as jumlah
				FROM tr_capaian_pekerjaan a
				JOIN mr_uraian_tugas b ON a.id_uraian_tugas = b.id_urtug
				JOIN mr_pegawai c ON a.id_pegawai = c.id
				WHERE a.tanggal_mulai LIKE '%".date('Y-m')."%'
				AND a.tanggal_selesai LIKE '%".date('Y-m')."%'
				AND a.id_pegawai_es2_banding = '".$id."'
				AND a.status_pekerjaan = '".$status."'");
			return $get_count_transact->result()[0]->jumlah;
		}

		function menuSampingBACKUP(){
			$CI =& get_instance();
			$role = $CI->session->userdata('sesRole');
			$induk = $CI->db->query(" SELECT * FROM config_menu WHERE id_parent=0 ");
			foreach($induk->result() as $row){

				$y = $CI->db->query(" SELECT COUNT(id_menu) as jml FROM config_menu WHERE id_parent=$row->id_menu ")->row();
				$x = $y->jml;
				if ($x !=0){?>
					<li class="treeview"><?php echo anchor("#","<i class='".$row->icon."'></i><span>". $row->nama_menu."</span><i class='fa fa-angle-left pull-right'></i>");?>
					<ul class="treeview-menu">
				<?php $anak = $CI->db->query(" SELECT * FROM config_menu WHERE id_parent=$row->id_menu ");
					foreach($anak->result() as $baris){?>
						<li><?php echo anchor($baris->url_pages,"<i class='".$baris->icon."'></i><span>".$baris->nama_menu."</span>");?></li>
					<?php
					}
					echo "</ul></li>";
				}else{?>
					<li><?php echo anchor($row->url_pages,"<i class='".$row->icon."'></i><span>".$row->nama_menu."</span>");?></li>
				<?php
				}
			}

		}

		function treeview($role){
			$CI =& get_instance();
			$induk = $CI->db->query("SELECT config_menu.*,
											config_menu_akses.id_akses,
											config_menu_akses.buat,
											config_menu_akses.baca,
											config_menu_akses.ubah,
											config_menu_akses.hapus
									FROM config_menu
									INNER JOIN config_menu_akses
									ON config_menu.id_menu=config_menu_akses.id_menu
									WHERE id_role=$role
									AND config_menu.flag <> 0
									AND id_parent=0
									AND flag=1");
			foreach($induk->result() as $row){?>
				<tr>
					<td><?php echo "<i class='".$row->icon."'></i> ".$row->nama_menu; ?></td>
					<td><?php if ($row->buat == 0){echo "<input id=cr".$row->id_akses." name='name_cr' class='minimal name_cr' type='checkbox' value=".$row->buat." onclick='create(".$row->id_akses.")'>";}else{echo "<input id=cr".$row->id_akses." class='minimal' type='checkbox' value=".$row->buat." onclick='create(".$row->id_akses.")' checked >";} ?></td>
					<td><?php if ($row->baca == 0){echo "<input id=re".$row->id_akses." name='name_re' class='minimal name_re' type='checkbox' value=".$row->baca." onclick='read(".$row->id_akses.")'>";}else{echo "<input id=re".$row->id_akses." class='minimal' type='checkbox' value=".$row->baca." onclick='read(".$row->id_akses.")' checked >";} ?></td>
					<td><?php if ($row->ubah == 0){echo "<input id=up".$row->id_akses." name='name_up' class='minimal name_up' type='checkbox' value=".$row->ubah." onclick='update(".$row->id_akses.")'>";}else{echo "<input id=up".$row->id_akses." class='minimal' type='checkbox' value=".$row->ubah." onclick='update(".$row->id_akses.")' checked >";} ?></td>
					<td><?php if ($row->hapus == 0){echo "<input id=de".$row->id_akses." name='name_de' class='minimal name_de' type='checkbox' value=".$row->hapus." onclick='delet(".$row->id_akses.")'>";}else{echo "<input id=de".$row->id_akses." class='minimal' type='checkbox' value=".$row->hapus." onclick='delet(".$row->id_akses.")' checked >";} ?></td>
				</tr>

			<?php $anak = $CI->db->query(" SELECT config_menu.*,
													config_menu_akses.id_akses,
													config_menu_akses.buat,
													config_menu_akses.baca,
													config_menu_akses.ubah,
													config_menu_akses.hapus
											FROM config_menu
											INNER JOIN config_menu_akses
											ON config_menu.id_menu=config_menu_akses.id_menu
											WHERE id_role=$role
											AND config_menu.flag <> 0											
											AND id_parent=$row->id_menu");
				foreach ($anak->result() as $baris){?>
					<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<i class='".$baris->icon."'></i> ". $baris->nama_menu;?></td>
					<td><?php if ($baris->buat == 0){echo "<input id=cr".$baris->id_akses." class='minimal name_cr' type='checkbox' value=".$baris->buat." onclick='create(".$baris->id_akses.")'>";}else{echo "<input id=cr".$baris->id_akses." class='minimal' type='checkbox' value=".$baris->buat." onclick='create(".$baris->id_akses.")' checked >";} ?></td>
					<td><?php if ($baris->baca == 0){echo "<input id=re".$baris->id_akses." class='minimal name_re' type='checkbox' value=".$baris->baca." onclick='read(".$baris->id_akses.")'>";}else{echo "<input id=re".$baris->id_akses." class='minimal' type='checkbox' value=".$baris->baca." onclick='read(".$baris->id_akses.")' checked >";} ?></td>
					<td><?php if ($baris->ubah == 0){echo "<input id=up".$baris->id_akses." class='minimal name_up' type='checkbox' value=".$baris->ubah." onclick='update(".$baris->id_akses.")'>";}else{echo "<input id=up".$baris->id_akses." class='minimal' type='checkbox' value=".$baris->ubah." onclick='update(".$baris->id_akses.")' checked >";} ?></td>
					<td><?php if ($baris->hapus == 0){echo "<input id=de".$baris->id_akses." class='minimal name_de' type='checkbox' value=".$baris->hapus." onclick='delet(".$baris->id_akses.")'>";}else{echo "<input id=de".$baris->id_akses." class='minimal' type='checkbox' value=".$baris->hapus." onclick='delet(".$baris->id_akses.")' checked >";} ?></td>
				</tr>
				<?php }
			}


	}

	function selisihMenit($awal,$akhir){
		$t_awal 	= explode(":",$awal);
		$t_akhir 	= explode(":",$akhir);
		$difJam 	= $t_akhir[0] - $t_awal[0];
		$difMenit	= $t_akhir[1] - $t_awal[1];
		$total		= ($difJam * 60) + $difMenit;
		return $total;
	}

	function random($panjang)
	{
		$pengacak = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$string = '';
		for($i = 0; $i < $panjang; $i++) {
			$pos = rand(0, strlen($pengacak)-1);
			$string .= $pengacak{$pos};
		}
		return $string;
	}

	function lama_hari ($t1,$t2)
	{
		$ex1 =explode("-",$t1);
		$year1 = $ex1 [0];
		$month1 = $ex1 [1];
		$date1 = $ex1 [2];
		$ex2 =explode ("-",$t2);
		$year2 = $ex2 [0];
		$month2 = $ex2 [1];
		$date2 = $ex2 [2];

		$jdn1 = GregorianToJD ($month1,$date1,$year1);
		$jdn2 = GregorianToJD ($month2,$date2,$year2);
		$beda = $jdn2 - $jdn1 ;
		return $beda;
	}

	function modif_kata($text)
	{
		$pisah = explode(" ",$text);
		foreach ($pisah as $katabaru){
			$lower = ucfirst(strtolower($katabaru));
			$newtext[]      = $lower;
		}
		$cantik	= implode (" ",$newtext);
		return $cantik;
	}

	function to_excel($array, $filename)
	{
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$filename.'.xls');

		$h = array();
		foreach($array->result_array() as $row){
			foreach($row as $key=>$val){
				if(!in_array($key, $h)){
				$h[] = $key;
				}
			}
		}

		echo '<table><tr>';
		echo '<th>No</th>';
		foreach($h as $key) {
			$key = ucwords($key);
			echo '<th>'.$key.'</th>';
		}
		echo '</tr>';
		$x=1;
		foreach($array->result_array() as $row){
			echo '<tr>';
			echo '<td>'.$x.'</td>';
			foreach($row as $val)
				writeRow($val);
		$x++;
		}
		echo '</tr>';
		echo '</table>';
	}

	function subMenu()
	{
		$CI =& get_instance();
		$q = "SELECT * FROM config_menu";
		$query = $CI->db->query($q);
		$isi = mysql_num_rows($query);
		return $isi;
	}

	function adddate($vardate,$added)
	{
		$data = explode("-", $vardate);
		$date = new DateTime();
		$date->setDate($data[0], $data[1], $data[2]);
		$date->modify("".$added."");
		$day= $date->format("Y-m-d");
		return $day;
	}	
?>
