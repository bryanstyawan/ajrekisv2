<div class="box">
				<table class="table table-striped">
					<tbody>
					<tr>
						<th>Range Class</th>
						<th>Tunjangan</th>
						<th>Aktif</th>
					</tr>
					<?php 
						foreach($grade->result() as $row){?>
							<tr>
								<td><?php echo $row->posisi_class;?></td>
								<td><?php echo number_format($row->tunjangan);?></td>
								<td><?php if ($row->flag == 0){echo "<input id=".$row->id." class='minimal' type='checkbox' value=".$row->flag." onclick='aktivasi(".$row->id.")'>";}else{echo "<input id=".$row->id." class='minimal' type='checkbox' value=".$row->flag." onclick='aktivasi(".$row->id.")' checked >";} ?></td>
							</tr>
						<?php  }
					?>
					</tbody>
				</table>
              </div><!-- /.box -->