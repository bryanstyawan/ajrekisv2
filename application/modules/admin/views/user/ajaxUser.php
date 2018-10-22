		<!-- Switch -->
	<style type="text/css">@import url("<?php echo base_url() . 'addon/switch/bootstrap-switch.css'; ?>");</style>
 <table class="table table-hover">
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>email</th>
                      <th>Nomor Hp</th>
                      <th>Role</th>
					  <th>Status</th>
					  <th>Action</th>
                    </tr>
					<?php $x=1;
						foreach($user->result() as $row){?>
							<tr>
								<td><?php echo $x;?></td>
								<td><?php echo $row->nama;?></td>
								<td><?php echo $row->email;?></td>
								<td><?php echo $row->no_hp;?></td>
								<td><?php echo $row->nama_role;?></td>
								<td><?php if ($row->status ==0){echo "<div class='make-switch' data-on='primary' data-off='info'>
                                <input type='checkbox' checked='checked' /></div>";}
									else {echo "<div class='make-switch' data-on='primary' data-off='info'>
                                <input type='checkbox' /></div>";}?></td>
								<td><button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id_user;?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;<button class="btn btn-primary btn-xs" onclick="del('<?php echo $row->id_user;?>')"><i class="fa fa-trash"></i></button></td>
							</tr>
						<?php $x++; }
					?>
				  </table>
				  <!-- Switch -->
	<script type='text/javascript' src="<?php echo base_url(); ?>addon/switch/bootstrap-switch.min.js"></script>	