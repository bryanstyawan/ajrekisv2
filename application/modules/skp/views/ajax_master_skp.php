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
								<button class="btn btn-primary btn-xs" style="margin-bottom:10px;" onclick="show_skp('<?php echo $list[$i]->id;?>')"><i class="fa fa-edit"></i> SKP</button>&nbsp;&nbsp;								
								<?php
									if ($list[$i]->is_master_skp == 'ready') {
										# code...
								?>
									<button class="btn btn-danger btn-xs" onclick="delete_all_urtug('<?php echo $list[$i]->id;?>')"><i class="fa fa-edit"></i> Hapus Semua Uraian Tugas</button>&nbsp;&nbsp;
								<?php
									}
								?>								
							</td>
						</tr>
					<?php
						}
					}
					?>

<script>
<?php 
if($list != 0)
{
?>
$("#span_struktural").html('<?=count($list);?>');
$("#span_counter_ready").html('<?=$data_counter['ready'];?>');
$("#progress_bar_persentase").html('<?=round(($data_counter['ready']/count($list)*100));?>');
$('#progress_bar_style').css({"width":"<?=round(($data_counter['ready']/count($list)*100));?>%"});
<?
}
?>
</script>