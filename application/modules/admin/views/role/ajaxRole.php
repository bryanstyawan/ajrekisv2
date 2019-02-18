
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>No</th>
                      <th>Role</th>
                      <th>Keterangan</th>
					  <th>Action</td>
                    </tr>
					<?php $x=1;
						foreach($role->result() as $row){?>
							<tr>
								<td><?php echo $x;?></td>
								<td><?php echo $row->nama_role;?></td>
								<td><?php echo $row->keterangan;?></td>
								<td><button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id_role;?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;<button class="btn btn-primary btn-xs" onclick="del('<?php echo $row->id_role;?>')"><i class="fa fa-trash"></i></button>
								<button class="btn btn-primary btn-xs" onclick="generate('<?php echo $row->id_role;?>')"><i class="fa fa-sitemap"></i> Generate</button></td>
							</tr>
						<?php $x++; }
					?>
				  </table>
					
                </div><!-- /.box-body -->
