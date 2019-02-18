
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                    <tr>
                      <th>No</th>
                      <th>Bulan</th>
					  <th>Tahun</th>
					  <th>Jumlah Hari Aktif</th>
					  <th>Jumlah Menit Perhari</th>
					  <th>Tanggal Pengajuan Keberatan</th>
					  <th>Tanggal Pengajuan Banding</th>			  					  
					  <th>action</th>
                    </tr>
					</thead>
					<tbody>
					<?php $x=1;
						foreach($list->result() as $row){?>
							<tr>
								<td><?php echo $x;?></td>
								<td><?php echo $row->nama_bulan;?></td>
								<td><?php echo $row->tahun;?></td>
								<td><?php echo $row->jml_hari_aktif;?></td>
								<td><?php echo $row->jml_menit_perhari;?></td>
								<td>
									<?php 
										if ($row->tgl_awal_keberatan == '') 
										{
											# code...
											echo "";
										}
										else
										{
											echo $row->tgl_awal_keberatan." s/d ".$row->tgl_akhir_keberatan;
										}
									?>		
								</td>
								<td>
									<?php 
										if ($row->tgl_awal_banding == '') 
										{
											# code...
											echo "";
										}
										else
										{
											echo $row->tgl_awal_banding." s/d ".$row->tgl_akhir_banding;
										}
									?>		
								</td>								
								<td><button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id_hari;?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
								<button class="btn btn-danger btn-xs" onclick="del('<?php echo $row->id_hari;?>')"><i class="fa fa-trash"></i></button>
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
