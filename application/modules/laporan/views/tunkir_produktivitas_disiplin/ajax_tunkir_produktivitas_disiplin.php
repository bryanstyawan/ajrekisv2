					<?php
					if ($list) {
						# code...
						for ($i=0; $i < count($list); $i++) {
							# code...
							$id                    = $list[$i]->id;
							$prosentase            = $list[$i]->prosentase;
							$menit_efektif         = $list[$i]->menit_efektif;
							$menit_efektif_efektif = $list[$i]->menit_efektif_efektif;

							$potongan_kinerja_skp = $list[$i]->potongan_kinerja;

							$tunjangan_kinerja_100 = $list[$i]->tunjangan_kinerja*2;
							$tunjangan_kinerja     = $list[$i]->tunjangan_kinerja - $potongan_kinerja_skp;

							$tunjangan_disiplin = $list[$i]->tunjangan_disiplin;
							$tunjangan_profesi  = $list[$i]->tunjangan_profesi;
							

							if ($prosentase > 100) {
								# code...
								$prosentase = 100;
								$tunjangan_kinerja_100 = $list[$i]->tunjangan_kinerja_sistem*2;
								$tunjangan_kinerja     = $list[$i]->tunjangan_kinerja_sistem;
							}

							if ($list[$i]->tugas_belajar == 'Tugas Belajar') {
								# code...
								$menit_efektif   = 0;
								$prosentase      = 0;
								$tunjangan_kinerja_100 = $list[$i]->tunjangan_kinerja_sistem*2;
								$tunjangan_kinerja     = $list[$i]->tunjangan_kinerja_sistem/2;
							}

							$total = $tunjangan_kinerja + $tunjangan_disiplin + $tunjangan_profesi;
				?>
						<tr>
							<td><?=$i+1;?></td>
							<td><?=$list[$i]->nip;?></td>
							<td><?=$list[$i]->nama_pegawai;?></td>
							<td><?=$list[$i]->nama_posisi;?></td>
							<td><?=$list[$i]->nama_atasan;?></td>
							<!-- <td></td> -->
							<td>Rp. <?=number_format($tunjangan_kinerja_100);?></td>
							<td>Rp. <?=number_format($tunjangan_profesi);?></td>
							<td><b><?=number_format($menit_efektif);?></b> (Prosentase <?=number_format($prosentase);?> %)</td>
							<td>Rp. <?=number_format($potongan_kinerja_skp);?></td>
							<td>Rp. <?=number_format($tunjangan_kinerja);?></td>
							<td>Rp. <?=number_format($tunjangan_disiplin);?></td>
							<td>Rp. <?=number_format($total);?></td>
							<td><?=$list[$i]->tugas_belajar;?></td>
						</tr>
					<?php
						}
					}
					?>
