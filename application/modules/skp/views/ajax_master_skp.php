					<?php
					if ($list) {
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
								<?php
									if ($list[$i]->is_master_skp == 'ready') {
										# code...
								?>
										<label class="btn btn-success btn-xs" style="pointer-events: none;">Uraian Telah tersedia</label>
								<?php
									}
								?>								
							</td>
							<td>
								<button class="btn btn-primary btn-xs" onclick="show_skp('<?php echo $list[$i]->id;?>')"><i class="fa fa-edit"></i> SKP</button>&nbsp;&nbsp;								
							</td>
						</tr>
					<?php
						}
					}
					?>