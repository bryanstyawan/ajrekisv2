<div class="box-header with-border">
    <div class="col-lg-12 text-center">
        <h2 class="box-title" style="font-size: 38px;font-weight: 500;padding-bottom: 45px;">Pekerjaan Direvisi</h2>
    </div>
</div><!-- /.box-header -->
<div id="isiRev">
<div class="box">
    <div class="box-body">
		<table id="revisi2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nomor</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Selesai</th>
                        <th>Detail Pekerjaan</th>
						<th>Output Pekerjaan</th>
						<th>File</th>
						<th>Komentar</th>
						<th>Action</th>
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
								<td>lihat</td>
								<td><?php echo $row->komentar;?></td>
								<td><?php if($row->stat == 0){?>
									<button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id_trx_detail;?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
									<button class="btn btn-primary btn-xs" onclick="del('<?php echo $row->id_trx_detail;?>')"><i class="fa fa-trash"></i></button>
								<?php }elseif($row->stat == 2){?>
									<button class="btn btn-primary btn-xs" onclick="banding('<?php echo $row->id_trx_detail;?>')"><i class="fa fa-balance-scale"></i></button>
								<?php }elseif($row->stat == 3){?>
									<button class="btn btn-primary btn-xs" onclick="revisi('<?php echo $row->id_trx_detail;?>')"><i class="fa fa-pencil"></i></button>
								<?php } ?></td>
						<?php $x++;}
					?>
					</tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
</div>
	<!-- DataTables -->
	<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
	$(function () {
        $("#revisi2").DataTable();
    });
function revisi(id){
	$.ajax({
		url :"<?php echo site_url() ?>/transaksi/revisiTrx/",
		type:"post",
		data:"id="+id,
		success:function( response ) {
			$("#isiRev").html(response);
		}
	})
}
</script>