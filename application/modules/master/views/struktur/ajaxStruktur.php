
                <table id="example1" class="table table-bordered table-striped">
                      <thead>
                    <tr>
                      <th>No</th>
                      <th>Eselon 1</th>
					  <th>Eselon 2</th>
					  <th>Eselon 3</th>
					  <th>Eselon 4</th>
					  <th>Jenis Jabatan</th>
					  <th>Jabatan</th>
					  <th>action</th>
                    </tr>
					</thead>
					<tbody>
					<?php $x=1;
						foreach($list->result() as $row){?>
							<tr>
								<td><?php echo $x;?></td>
								<td><?php if($row->eselon1 !=0){$e1 = $this->db->query(" SELECT * FROM mr_eselon1 where id_es1=$row->eselon1 ")->row();
									echo $e1->nama_eselon1;}?></td>
								<td><?php if($row->eselon2 !=0){$e2 = $this->db->query(" SELECT * FROM mr_eselon2 where id_es2=$row->eselon2 ")->row();
									echo $e2->nama_eselon2;}?></td>
								<td><?php if($row->eselon3 !=0){$e3 = $this->db->query(" SELECT * FROM mr_eselon3 where id_es3=$row->eselon3 ")->row();
									echo $e3->nama_eselon3;}?></td>
								<td><?php if($row->eselon4 !=0){$e4 = $this->db->query(" SELECT * FROM mr_eselon4 where id_es4=$row->eselon4 ")->row();
									echo $e4->nama_eselon4;}?></td>
								<td><?php echo $row->nama_kat_posisi;?></td>
								<td><?php echo $row->nama_posisi;?></td>
								<td><button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id;?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
								<button class="btn btn-primary btn-xs" onclick="del('<?php echo $row->id;?>')"><i class="fa fa-trash"></i></button></td>
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
