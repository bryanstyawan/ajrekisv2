
                <table id="example1" class="table table-bordered table-striped">
                      <thead>
                    <tr>
                      <th>NIP</th>
                      <th>Nama</th>
					  <th>Jabatan</th>
					  <th>Role</th>
					  <th>Action</th>
                    </tr>
					</thead>
					<tbody>
					<?php 
						foreach($list->result() as $row){?>
							<tr>
								<td><?php echo $row->nip;?></td>
								<td><?php echo $row->nama_pegawai;?></td>
								<td><?php echo $row->nama_posisi;?></td>
								<td><?php echo $row->nama_role;?> <i class="fa fa-exchange" style="cursor:pointer;" onclick="reRole('<?php echo $row->id;?>')"></i></td>
								<td><button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id;?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
								<button class="btn btn-primary btn-xs" onclick="del('<?php echo $row->id;?>')"><i class="fa fa-trash"></i></button>
							</tr>
						<?php }
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
