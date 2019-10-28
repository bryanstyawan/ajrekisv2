<?php
	if ($list != 0) {
		for ($i=0; $i < count($list); $i++) {
			$id				= $this->session->userdata('sesUser');
			$status         = "";
			$ket			= "";
			$style_td		= "";
			$style_status	= "";
			$style_tr       = "";
			$row_tr			= "";
			$col_td			= "";			
			
			if ($list[$i]->kegiatan_skp == '' && $list[$i]->kegiatan_skp_jfu == '' && $list[$i]->kegiatan_skp_jft == '') {
				$kegiatan = $list[$i]->uraian_tugas;                                                    
			} 
			else {
				if ($infoPegawai[0]->kat_posisi == 1) {
					$kegiatan = $list[$i]->kegiatan_skp;
				}
				elseif ($infoPegawai[0]->kat_posisi == 2) {
					$kegiatan = $list[$i]->kegiatan_skp_jft;
				}                                                                                            
				elseif ($infoPegawai[0]->kat_posisi == 4) {
					$kegiatan = $list[$i]->kegiatan_skp_jfu;
				}
				elseif ($infoPegawai[0]->kat_posisi == 6) {
					$kegiatan = $list[$i]->kegiatan_skp;
				}                                                                                                                                                    
			}

			$row_tr			  = "row_".$list[$i]->id_pekerjaan;
			$col_td			  = "col_".$list[$i]->id_pekerjaan;

			if ($list[$i]->status_pekerjaan == 1) {
				$status       = "Close";
				$style_status = "display:none;";
				$ket		  = "Transaksi Disetujui";
				$style_tr     = "background-color: #4CAF50;color: #fff;";
				$style_td     = "border-bottom: 1px solid #fff;border-top: 1px solid #fff;";
			}
			elseif ($list[$i]->status_pekerjaan == 2) {
				$status       = "Open";
				$style_status = "";
				$ket		  = "Transaksi Ditolak<br>Alasan: ".$list[$i]->alasan_ditolak;
				$style_tr     = "background-color: #C0392B;color: #fff;";
				$style_td     = "border-bottom: 1px solid #fff;border-top: 1px solid #fff;";
			}
			elseif ($list[$i]->status_pekerjaan == 4) {
				$status       = "Open";
				$style_status = "";
				$ket		  = "Pengajuan Keberatan<br>Alasan: ".$list[$i]->komentar_keberatan;
				$style_tr     = "background-color: #F39C12;color: #fff;";
				$style_td     = "border-bottom: 1px solid #fff;border-top: 1px solid #fff;";
			}
			elseif ($list[$i]->status_pekerjaan == 5) {
				$status       = "Open";
				$style_status = "";
				$ket		  = "Keberatan Ditolak<br>Alasan: ".$list[$i]->komentar_tolak_keberatan;
				$style_tr     = "background-color: #D35400;color: #fff;";
				$style_td     = "border-bottom: 1px solid #fff;border-top: 1px solid #fff;";
			}
			elseif ($list[$i]->status_pekerjaan == 6) {
				$status       = "Open";
				$style_status = "";
				$ket		  = "Pengajuan Banding<br>Alasan: ".$list[$i]->komentar_banding;
				$style_tr     = "background-color: #008080;color: #fff;";
				$style_td     = "border-bottom: 1px solid #fff;border-top: 1px solid #fff;";
			}
			elseif ($list[$i]->status_pekerjaan == 7) {
				$status       = "Open";
				$style_status = "";
				$ket		  = "Banding Ditolak<br>Alasan: ".$list[$i]->komentar_tolak_banding;
				$style_tr     = "background-color: #000080;color: #fff;";
				$style_td     = "border-bottom: 1px solid #fff;border-top: 1px solid #fff;";
			}
			else
			{
				$status       = "Open"; 
				$style_status = "";
				$ket		  = "Transaksi Belum Diperiksa";
			}
?>
			<tr id="<?=$row_tr;?>" style="<?=$style_tr;?>">
				<td style="<?=$style_td;?>">Tgl: <b><?=date('d F Y', strtotime($list[$i]->tanggal_mulai));?></b><br> Jam: <b><?=$list[$i]->jam_mulai;?></b></td>								
				<td style="<?=$style_td;?>">Tgl: <b><?=date('d F Y', strtotime($list[$i]->tanggal_selesai));?></b><br> Jam: <b><?=$list[$i]->jam_selesai;?></b></td>
				<td style="<?=$style_td;?>"><?=$kegiatan;?></td>
				<td style="<?=$style_td;?>"><?=$list[$i]->nama_pekerjaan;?></td>
				<td style="<?=$style_td;?>"><?=$list[$i]->frekuensi_realisasi;?> <?=$list[$i]->target_output_name;?></td>
				<td style="<?=$style_td;?>">
					<?php
						$link = "";
						if ($list[$i]->file_pendukung != '') {
							# code...
					?>
						<a class="btn btn-success btn-xs" href="<?php echo base_url() . 'public/file_pendukung/'.$infoPegawai[0]->nip.'/'.$list[$i]->file_pendukung; ?>"><i class="fa fa-download"></i>&nbsp;Unduh</a>
					<?php
						}
					?>
				</td>
				<td id="<?=$col_td;?>" style="<?=$style_td;?>"><b><?=$ket;?></b></td>
				<td style="<?=$style_td;?>">
				<?php
					$bln = date('m');
					$thn = date('Y');
					$bln_tr = date("m",strtotime($list[$i]->tanggal_mulai));
					$thn_tr = date("Y",strtotime($list[$i]->tanggal_mulai));
					if ($bln == $bln_tr && $thn == $thn_tr) {
						if ($list[$i]->id_pegawai != $id) {
							if ($list[$i]->status_pekerjaan == 0) // Transaksi Belum Diperiksa
							{
								?>
									<button id="btn_approve_<?php echo $list[$i]->id_pekerjaan;?>" class='btn btn-success btn-xs' style="margin-bottom: 10px; width: 75px;" onclick="approve('<?php echo $list[$i]->id_pekerjaan;?>')"><i class='fa fa-check'></i>&nbsp;Setuju</button>
									<button id="btn_reject_<?php echo $list[$i]->id_pekerjaan;?>" class='btn btn-danger btn-xs' style="margin-bottom: 10px; width: 75px;" onclick="reject('<?php echo $list[$i]->id_pekerjaan;?>')"><i class='fa fa-close'></i>&nbsp;Tolak </button>
								<?php
							}
							elseif ($list[$i]->status_pekerjaan == 4) // Keberatan
							{
								?>
									<button class='btn btn-danger btn-xs' style="margin-bottom: 10px; width: 75px;" onclick="reject_keberatan('<?php echo $list[$i]->id_pekerjaan;?>')"><i class='fa fa-close'></i>&nbsp;Tolak </button>
								<?php
							}
							elseif ($list[$i]->status_pekerjaan == 6) // Banding
							{
								?>
									<button class='btn btn-danger btn-xs' style="margin-bottom: 10px; width: 75px;" onclick="reject_banding('<?php echo $list[$i]->id_pekerjaan;?>')"><i class='fa fa-close'></i>&nbsp;Tolak </button>
								<?php
							}
						}
						else
						{
							if ($list[$i]->status_pekerjaan == 2) { // Transaksi Ditolak
								?>
									<button class="btn btn-warning btn-xs" style="margin-bottom: 10px; width: 75px;" onclick="keberatan('<?php echo $list[$i]->id_pekerjaan;?>')"><i class="fa fa-balance-scale"></i>&nbsp;Keberatan</button>
								<?php
							}
							elseif ($list[$i]->status_pekerjaan == 5) { // Keberatan Ditolak
							?>
								<button class="btn btn-warning btn-xs" style="margin-bottom: 10px; width: 75px;" onclick="banding('<?php echo $list[$i]->id_pekerjaan;?>')"><i class="fa fa-balance-scale"></i>&nbsp;Banding</button>
							<?php
							}
							elseif ($list[$i]->status_pekerjaan == 0) // Transaksi Belum Diperiksa
							{
								?>
									<button class="btn btn-danger btn-xs" style="margin-bottom: 10px; width: 75px;" onclick="del('<?php echo $list[$i]->id_pekerjaan;?>')"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
								<?php
							}
						}
					}
				?>
				</td>
			</tr>
<?php
		}
	}
?>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>