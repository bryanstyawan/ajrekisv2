<table id="example1" class="table table-bordered table-striped">
	<thead>
	<tr>
		<th>No</th>
		<th>NIP</th>
		<th>Nama</th>
		<th>Dari Tanggal</th>
		<th>Sampai Tanggal</th>
		<th>Keterangan</th>
		<th>Action</th>
	</tr>
	</thead>
	<tbody>
		<?php
			if ($list != 0) {
				# code...
				for ($i=0; $i < count($list); $i++) { 
					# code...
		?>
					<tr>
						<td><?=$i+1;?></td>
						<td><?=$list[$i]->nip;?></td>
						<td><?=$list[$i]->nama_pegawai;?></td>
						<td><?=$list[$i]->tgl_mulai;?></td>
						<td><?=$list[$i]->tgl_selesai;?></td>
						<td><?=$list[$i]->keterangan;?></td>
						<td>
							<button class="btn btn-primary btn-xs" onclick="edit('<?=$list[$i]->id;?>')">
								<i class="fa fa-edit"></i>
							</button>&nbsp;&nbsp;
							<button class="btn btn-danger btn-xs" onclick="del('<?=$list[$i]->id;?>')">
								<i class="fa fa-trash"></i>
							</button>									
						</td>

					</tr>
		<?php
				}
			}
		?>		
	</tbody>
</table>
					
                </div><!-- /.box-body -->
<!-- DataTables -->
	<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
	<script>
	
      $(function () {
        $("#example1").DataTable({
			"oLanguage": {
				"sSearch": "Pencarian :",
				"sSearchPlaceholder" : "Ketik untuk mencari",
				"sLengthMenu": "Menampilkan data&nbsp; _MENU_ &nbsp;Data",
				"sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
				"sZeroRecords": "Data tidak ditemukan"	
			},
			"dom": "<'row'<'col-sm-6'f><'col-sm-6'l>>" +
					"<'row'<'col-sm-5'i><'col-sm-7'p>>" +			
					"<'row'<'col-sm-12'tr>>" +
					"<'row'<'col-sm-5'i><'col-sm-7'p>>" 

			// "dom": '<"top"f>rt'
			// "dom": '<"top"fl>rt<"bottom"ip><"clear">'			
		});
      });
	  </script>
