<?php
	$nilai_sangat_baik = 0;
	$nilai_baik        = 0;
	$nilai_cukup       = 0;
	$nilai_kurang      = 0;
	$nilai_buruk       = 0;
	if ($list != 0) {
		# code...
		for ($i=0; $i < count($list); $i++) {
			# code...
			if ($this->Globalrules->nilai_capaian_skp($list[$i]->total_skp)['value'] == 'Sangat Baik') {
				# code...
				$nilai_sangat_baik += 1;
			}

			if ($this->Globalrules->nilai_capaian_skp($list[$i]->total_skp)['value'] == 'Baik') {
				# code...
				$nilai_baik += 1;
			}

			if ($this->Globalrules->nilai_capaian_skp($list[$i]->total_skp)['value'] == 'Cukup') {
				# code...
				$nilai_cukup += 1;
			}
			
			if ($this->Globalrules->nilai_capaian_skp($list[$i]->total_skp)['value'] == 'Kurang') {
				# code...
				$nilai_kurang += 1;
			}
			
			if ($this->Globalrules->nilai_capaian_skp($list[$i]->total_skp)['value'] == 'Buruk') {
				# code...
				$nilai_buruk += 1;
			}			
	?>
		<tr style="<?=$this->Globalrules->nilai_capaian_skp($list[$i]->total_skp)['css'];?>">
			<td><?=$list[$i]->nip;?></td>								
			<td><?=$list[$i]->nama_pegawai;?>(<?=$list[$i]->id_pegawai;?>)</td>
			<td><?=$list[$i]->nama_posisi;?>(<?=$list[$i]->id_posisi_ts;?>)</td>			
			<td><?=number_format($list[$i]->nilai_sasaran_kinerja_pegawai,2);?></td>
			<td><?=number_format($list[$i]->nilai_prilaku_kerja,2);?></td>
			<td><?=number_format($list[$i]->total_skp,2);?></td>			
			<td><?=$this->Globalrules->nilai_capaian_skp($list[$i]->total_skp)['value'];?></td>
			<td><?=$tahun;?></td>
			<td>
				<a class="btn btn-md bg-purple color-palette col-lg-12" style="margin-top:5px;" onclick="getValue('<?=$list[$i]->id_pegawai;?>')"><i class="fa fa-download"></i> Ambil Nilai</a>
				<a class="btn btn-md bg-red color-palette col-lg-12" style="margin-top:5px;" onclick="deleteValue('<?=$list[$i]->id_pegawai;?>')"><i class="fa fa-refresh"></i> Reset</a>
<?php
				if ($list[$i]->id_posisi_ts != null) {
					# code...
					if ($list[$i]->nilai_sasaran_kinerja_pegawai == 0) {
						# code...
						if ($list[$i]->nilai_prilaku_kerja == 0) {
							# code...
?>
							<a class="btn btn-md bg-red color-palette col-lg-12" style="margin-top:5px;" onclick="deleteHardValue('<?=$list[$i]->id_pegawai;?>','<?=$list[$i]->id_posisi_ts;?>','<?=$tahun;?>')"><i class="fa fa-trash"></i> Hapus</a>
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


<script>
$('#f_sangat_baik').val('<?=$nilai_sangat_baik;?>');
$('#f_baik').val('<?=$nilai_baik;?>');
$('#f_cukup').val('<?=$nilai_cukup;?>');
$('#f_kurang').val('<?=$nilai_kurang;?>');
$('#f_buruk').val('<?=$nilai_buruk;?>');
</script>

<!-- <script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script> -->