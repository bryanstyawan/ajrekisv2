<?php
	for ($i=0; $i < count($list); $i++) {
		# code...
		// $id             = $list[$i]->id;
		$data_link_a    = "";
		$data_link_text = "";
?>
	<tr>
		
		<td><?=$list[$i]->nomor;?></td>								
		<td><?=$list[$i]->tanggal_mulai;?></td>
		<td><?=$list[$i]->jam_mulai;?></td>
		<td><?=$list[$i]->tanggal_selesai;?></td>
		<td><?=$list[$i]->jam_selesai;?></td>
		<td><?=$list[$i]->nama_pekerjaan;?></td>
		<td><?=$list[$i]->status_pekerjaan;?></td>
		<td><?=$list[$i]->menit_efektif;?></td>
		<!-- <td>
			<?php
				if ((($list[$i]->menit_efektif/6600)*100) > 100) {
					# code...
					echo 100;
				}
				else
				{
					// echo round(($list[$i]->menit_efektif/6600)*100,2);
					echo number_format((float)(($list[$i]->menit_efektif/6600)*100),2,'.','');
				}
			?>
		</td>	 -->
	</tr>
<?php
	}
?>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>