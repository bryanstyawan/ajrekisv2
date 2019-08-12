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
		<td><?=$list[$i]->nama_eselon1;?></td>
		<td><?=$list[$i]->nama_eselon2;?></td>
		<td><?=$list[$i]->class_posisi_definitif;?></td>		
		<td><?=number_format($list[$i]->menit_efektif,0);?></td>
		<td><?=$list[$i]->prosentase_menit_efektif;?>%</td>		
		<td>Rp. <?=number_format($list[$i]->tunjangan_definitif,0);?></td>
		<td>Rp. <?=number_format($list[$i]->nilai_potongan_skp_bulanan,0);?></td>
		<td><?=number_format($list[$i]->tunjangan_profesi,0);?></td>
		<td><?=number_format($list[$i]->real_tunjangan,0);?></td>        
		<td><?=$this->Globalrules->set_bulan($sender['bulan']);?> <?=$sender['tahun'];?></td>
        <td></td>        
	</tr>
<?php
	}
?>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>