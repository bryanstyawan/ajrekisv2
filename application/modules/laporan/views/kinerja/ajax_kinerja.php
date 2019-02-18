					<?php
					if ($list) {
						# code...
						for ($i=0; $i < count($list); $i++) { 
							# code...
							$id                    = $list[$i]->id;
							$prosentase            = $list[$i]->prosentase;
							$menit_efektif         = $list[$i]->menit_efektif;
							$menit_efektif_efektif = $list[$i]->menit_efektif_efektif;
							$belum_diperiksa       = $list[$i]->belum_diperiksa;
							$revisi                = $list[$i]->revisi;
							$ditolak               = $list[$i]->ditolak;
							$disetujui             = $list[$i]->disetujui;

							if ($prosentase > 100) {
								# code...
								$prosentase = 100;
							}

							if ($list[$i]->tugas_belajar == 'Tugas Belajar') {
								# code...
								$belum_diperiksa = 0;
								$revisi          = 0;
								$ditolak         = 0;
								$disetujui       = 0;
								$menit_efektif   = 0;
								$prosentase      = 0;								
							}
				?>
						<tr>
							<td><?=$i+1;?></td>						
							<td><?=$list[$i]->nip;?></td>
							<td><?=$list[$i]->nama_pegawai;?></td>
<!-- 							<td><?=$list[$i]->nama_eselon1;?></td>					
							<td><?=$list[$i]->nama_eselon2;?></td>					
							<td><?=$list[$i]->nama_eselon3;?></td>					
							<td><?=$list[$i]->nama_eselon4;?></td>					 -->
							<td><?=$list[$i]->nama_posisi;?></td>					
							<td><?=$list[$i]->nama_atasan;?></td>					
							<td><?=$belum_diperiksa;?></td>					
							<td><?=$revisi;?></td>					
							<td><?=$ditolak;?></td>					
							<td><?=$disetujui;?></td>					
							<td><?=number_format($menit_efektif);?></td>
							<td><?=number_format($prosentase);?> %</td>
							<td><?=$list[$i]->tugas_belajar;?></td>
						</tr>
					<?php
						}
					}
					?>