                <table id="example1" class="table table-bordered table-striped">
                      <thead>
                    <tr>
					  <th>Nomor</th>
                      <th>Posisi</th>
					  <th>Uraian Tugas</th>
					  <th>action</th>
                    </tr>
					</thead>
					<tbody>
					<?php 
					$x=1;
						foreach($list->result() as $row){?>
							<tr>
								<td><?php echo $x;?></td>
								<td><?php echo $row->nama_posisi;?></td>
								<td><?php echo $row->uraian_tugas;?></td>
								<td><button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id_urtug;?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
								<button class="btn btn-primary btn-xs" onclick="del('<?php echo $row->id_urtug;?>')"><i class="fa fa-trash"></i></button></td>
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
        $("#example1").DataTable();
      });
	  </script>
