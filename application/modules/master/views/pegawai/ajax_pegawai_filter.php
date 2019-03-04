<?php
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
									$data_link_text = "TIDAK ADA FOTO";
								}
								else
								{
									$data_link_text = "LIHAT FOTO";
									$data_link_a = base_url() . 'public/images/pegawai/'.$list[$i]->photo;
								}
						?>
							<tr>
								<td>
									(<b><?=$list[$i]->id;?></b>)
									<?=$list[$i]->nip;?>
								</td>
								<td>
									<?=$list[$i]->nama_pegawai;?>
								</td>
								<td>																																			
									<?=$list[$i]->nama_posisi;?>
									<b>(
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
										elseif ($list[$i]->kat_posisi == 6) {
											# code...
											echo $list[$i]->posisi_class_raw;										
										}																		
									?>										
									)</b>
								</td>
								<td><?=$list[$i]->posisi_akademik_name;?></td>								
								<td>
									<?php
										if ($list[$i]->avail_atasan == 1) {
											# code...
									?>
											<?=$list[$i]->nama_atasan;?>&nbsp;(<b><?=$list[$i]->jabatan_atasan;?></b>)
									<?php
										}
										else
										{
											echo "N/A";
										}
									?>								
								</td>								
								<td></td>
								<td></td>								
								<td class="text-center">
									<button class="btn btn-warning btn-xs col-lg-12" style="margin-bottom: 5px;" onclick="main_form('update','<?php echo $list[$i]->id;?>')"><i class="fa fa-edit"></i> UBAH DATA</button>
									<button class="btn btn-danger btn-xs col-lg-12" style="margin-bottom: 5px;" onclick="del('<?php echo $list[$i]->id;?>')"><i class="fa fa-trash"></i> HAPUS DATA</button>
									<button class="btn btn-primary btn-xs col-lg-12" style="margin-bottom: 5px;" onclick="change_password('<?php echo $list[$i]->id;?>')"><i class="fa fa-edit"></i> DEFAULT PASSWORD</button>									
									<a href="#" class="btn btn-success btn-xs col-lg-12" onclick="preview_image('<?=$id;?>','<?=$data_link_a;?>')"><i class="fa fa-search-plus"></i>&nbsp;<?=$data_link_text;?></a>									
								</td>
							</tr>
						<?php
							}
						?>