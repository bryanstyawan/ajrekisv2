<div class="box-header with-border">
    <div class="col-lg-12 text-center">
        <h2 class="box-title" style="font-size: 38px;font-weight: 500;padding-bottom: 45px;">Keberatan Ditolak</h2>
    </div>
</div><!-- /.box-header -->
<div class="box">
    <div class="box-body">
		<table id="banding2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nomor</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Selesai</th>
                        <th>Uraian Tugas</th>
                        <th>Detail Pekerjaan</th>
						<th>Output Pekerjaan</th>
						<th>File</th>
						<th>Komentar</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php $x=1;
						foreach($list->result() as $row){?>
							<tr>
								<td width=5%><?php echo $x;?></td>
								<td><?php echo date('d F Y H:i',strtotime($row->tgl_mulai));?></td>
								<td><?php echo date('d F Y H:i',strtotime($row->tgl_selesai));?></td>
								<td><?php echo $row->nama_pekerjaan;?></td>
								<td><?php echo $row->output_pekerjaan;?></td>
								<td><?php echo $row->komentar;?></td>
								<td>lihat</td>
								<td><?php if($row->stat == 5){?>
									<button class="btn btn-primary btn-xs" onclick="banding('<?php echo $row->id_trx_detail;?>')"><i class="fa fa-balance-scale"></i></button>
								<?php }
								?>
						<?php $x++;}
					?>
					</tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
	<!-- DataTables -->
	<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
	<script>
	      $(function () {
        $("#banding2").DataTable();
      });
</script>