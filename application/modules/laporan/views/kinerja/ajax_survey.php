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
		<td><?=$list[$i]->jns_jabatan;?></td>
		<td><?=$list[$i]->diklat_pim;?></td>
		<td><?=$list[$i]->n_diklat_pim;?></td>	
		<td><?=$list[$i]->diklat_jafung;?></td>
		<td><?=$list[$i]->n_diklat_jafung;?></td>
		<td><?=$list[$i]->diklat_20jp;?></td>
		<td><?=$list[$i]->n_diklat_20jp;?></td>
		<td><?=$list[$i]->seminar;?></td>
		<td><?=$list[$i]->n_seminar;?></td>
		<td><?=$list[$i]->kualifikasi;?></td>
		<td><?=$list[$i]->n_kualifikasi;?></td>
		<td><?=$list[$i]->penilaian_kinerja;?></td>
		<td><?=$list[$i]->n_penilaian_kinerja;?></td>
		<td><?=$list[$i]->hukuman_disiplin;?></td>
		<td><?=$list[$i]->n_hukuman_disiplin;?></td>
		<td><?=$list[$i]->total;?></td>
	</tr>
<?php
	}
?>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>