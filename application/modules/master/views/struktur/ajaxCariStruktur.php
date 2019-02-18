<table class="table table-bordered table-striped" style="font-size:12px;">
                      <thead>
                    <tr>
                      <th>No</th>
                      <th>Eselon 1</th>
					  <th>Eselon 2</th>
					  <th>Eselon 3</th>
					  <th>Eselon 4</th>
					  <th>Jenis Jabatan</th>
					  <th>Jabatan</th>
					  <th width="7%">action</th>
                    </tr>
					</thead>
					<tbody>
						<?php
							if ($list != 0) 
							{
								# code...
								for ($i=0; $i < count($list); $i++) { 
									# code...
						?>
									<tr>
										<td><?=$i+1;?></td>
										<td><?=$list[$i]->nama_eselon1;?></td>
										<td><?=$list[$i]->nama_eselon2;?></td>
										<td><?=$list[$i]->nama_eselon3;?></td>
										<td><?=$list[$i]->nama_eselon4;?></td>
										<td><?=$list[$i]->nama_kat_posisi;?></td>
										<td><?=$list[$i]->nama_posisi;?></td>
										<td>
											<button class="btn btn-primary btn-xs" onclick="edit('<?php echo $list[$i]->id;?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
											<button class="btn btn-primary btn-xs" onclick="del('<?php echo $list[$i]->id;?>')"><i class="fa fa-trash"></i></button>
										</td>
									</tr>			
						<?php
								}
							}
						?>
					</tbody>
				  </table>