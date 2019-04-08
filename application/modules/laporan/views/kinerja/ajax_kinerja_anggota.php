<?php
	for ($i=0; $i < count($list); $i++) {
		# code...
		// $id             = $list[$i]->id;
		$data_link_a    = "";
		$data_link_text = "";
?>
	<tr>
		<td><?=$list[$i]->nip;?></td>								
		<td><?=$list[$i]->nama_pegawai;?></td>
		<td><?=$list[$i]->nama_posisi;?></td>
		<td><?=$list[$i]->tr_belum_diperiksa;?></td>
		<td><?=$list[$i]->tr_revisi;?></td>
		<td><?=$list[$i]->tr_tolak;?></td>
		<td><?=$list[$i]->tr_approve;?></td>
		<td><?=$list[$i]->menit_efektif;?></td>
		<td><?=$list[$i]->prosentase_menit_efektif;?></td>	
	</tr>
<?php
	}
?>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>