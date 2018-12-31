					<?php
					if ($list) {
						# code...
						for ($i=0; $i < count($list); $i++) {
							# code...
							$id             = $list[$i]->id;
							$data_link_a    = "";
							$data_link_text = "";
					?>
				<?php
							if ($list[$i]->photo == '-') {
							# code...
								$data_link_a = "none";
								$data_link_text = "Tidak ada Foto";
							}
							else
							{
								if ($list[$i]->local == '1') {
									# code...
									$data_link_text = "Lihat Foto";
									$data_link_a = base_url() . 'public/images/pegawai/'.$list[$i]->photo;
								}
								else
								{
									$data_link_text = "Lihat Foto";
									$data_link_a = 'http://sikerja.kemendagri.go.id/images/demo/users/'.$list[$i]->photo;
								}
							}
				?>
						<tr>
							<td>
								<a href="#" class="btn btn-success btn-xs" onclick="preview_image('<?=$id;?>','<?=$data_link_a;?>')"><i class="fa fa-search-plus"></i>&nbsp;<?=$data_link_text;?></a>
							</td>
							<td><?=$list[$i]->nip;?></td>
							<td><?=$list[$i]->nama_pegawai;?></td>
							<td><?=$list[$i]->nama_posisi;?></td>
							<td>
								<?php
									if ($list[$i]->kat_posisi == 1) {
										# code...
										echo $list[$i]->posisi_class_raw;
									}
									elseif ($list[$i]->kat_posisi == 2) {
										# code...
										echo $list[$i]->posisi_class_jft;										
									}
									elseif ($list[$i]->kat_posisi == 4) {
										# code...
										echo $list[$i]->posisi_class_jfu;										
									}									
								?>
							</td>
							<td><?=$list[$i]->tmt;?></td>
							<td></td>
							<td>
								<?php echo anchor('master/data_pegawai/ubah_pegawai/'.$list[$i]->id,'<button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button>');?>&nbsp;&nbsp;
								<button class="btn btn-primary btn-xs" onclick="del('<?php echo $list[$i]->id;?>')"><i class="fa fa-trash"></i></button>
							</td>
						</tr>
					<?php
						}
					}
					?>
