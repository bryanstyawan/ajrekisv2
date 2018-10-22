
                <table id="example1" class="table table-bordered table-striped">
                      <thead>
                    <tr>
                      <th>No</th>
					  <th>Nama Eselon 1</th>
					  <th>Nama Eselon 2</th>
					  <th>Action</td>
                    </tr>
					</thead>
					<tbody>
					<?php $x=1;
						foreach($list->result() as $row){?>
							<tr>
								<td><?php echo $x;?></td>
								<td><?php echo $row->nama_eselon1;?></td>
								<td><?php echo $row->nama_eselon2;?></td>
								<td><button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id_es2;?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
								<!-- <button class="btn btn-danger btn-xs" onclick="del('<?php echo $row->id_es2;?>')"><i class="fa fa-trash"></i></button></td> -->
							</tr>
						<?php $x++; }
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
