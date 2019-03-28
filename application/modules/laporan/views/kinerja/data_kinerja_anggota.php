<?=$this->load->view('templates/common/preloader');?>
<section id="view_section">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
			</div>
			<div class="box-body" id="isi">
				<div>
					<table class="table table-bordered table-striped table-view">
					<thead>
						<tr>
							<th>No</th>
							<th>NIP</th>
							<th>Nama Pegawai</th>																												
							<th>Belum Dperiksa</th>							
							<th>Revisi</th>
							<th>Ditolak</th>
							<th>Disetujui</th>
							<th>Menit Efektif</th>
							<th>Prosentase</th>																												
						</tr>
					</thead>
					<tbody>
					<?php
					for ($i=0; $i < count($list); $i++) { 
						# code...
					?>
						<tr>
							<td><?=$i+1;?></td>
							<td><?=$list[$i]->nip;?></td>
							<td><?=$list[$i]->nama_pegawai;?></td>
							<td>0</td>
							<td><?=$list[$i]->tr_revisi;?></td>
							<td><?=$list[$i]->tr_tolak;?></td>
							<td><?=$list[$i]->tr_approve;?></td>
							<td><?=$list[$i]->menit_efektif;?></td>
							<td><?=$list[$i]->prosentase_menit_efektif;?></td>
							<td></td>
						</tr>
					<?php
						}
					?>
					</tbody>
					</table>
				</div>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>	
</section>

<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>