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
		<td><?=$list[$i]->nilaiprestasikerja;?></td>
		<td><?=$list[$i]->nilaikonversi;?></td>
		<td><?=$list[$i]->nilaiprestasikerja2;?></td>
		<td><?=$list[$i]->nilaitotal;?></td>						
	</tr>
<?php
	}
?>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>