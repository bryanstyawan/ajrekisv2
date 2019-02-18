
                <table id="example1" class="table table-bordered table-striped">
                      <thead>
                    <tr>
                      <th>No</th>
					  <th>Nama Eselon 1</th>
					  <th>Nama Eselon 2</th>
					  <th>Nama Eselon 3</th>
					  <th>Nama Eselon 4</th>
					  <th>Action</td>
                    </tr>
					</thead>
					<tbody>
					<?php
							for ($i=0; $i < count($list_final); $i++) { 
							# code...
					?>
							<tr>
								<td><?=$i+1;?></td>
								<td><?=$list_final[$i]['nama_eselon1'];?></td>
								<td><?=$list_final[$i]['nama_eselon2'];?></td>						
								<td><?=$list_final[$i]['nama_eselon3'];?></td>
								<td><?=$list_final[$i]['nama_eselon4'];?></td>																			
								<td>
									<button class="btn btn-primary btn-xs" onclick="edit('<?php echo $list_final[$i]['id_es4'];?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
							<?php
									if($list_final[$i]['counter_data'] == 0)
									{
							?>
									<button class="btn btn-danger btn-xs" onclick="del('<?php echo $list_final[$i]['id_es4'];?>')"><i class="fa fa-trash"></i></button>											
							<?php
									}
							?>
								</td>
							</tr>
					<?php
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
