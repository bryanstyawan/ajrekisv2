<?php
    $counter = 0;
    if ($list != 0)
    {
        # code...
        $counter          = count($list); 
        $active_keberatan = "";
        $active_banding   = "";
        if ($hari_kerja != 0) {
            # code...
            // if (strtotime(date('Y-m-d')) < strtotime($hari_kerja[0]->tgl_awal_keberatan))
            // {
            //     # code...
            //     $active_keberatan = "hide_keberatan";
            // }
            // else
            // {
            //     $active_keberatan = "show_keberatan";
            // }

            // if (strtotime(date('Y-m-d')) > strtotime($hari_kerja[0]->tgl_akhir_keberatan))
            // {
            //     # code...
            //     $active_keberatan = "hide_keberatan";
            // }
            // else
            // {
            //     $active_keberatan = "show_keberatan";
            // }


            // if (strtotime(date('Y-m-d')) < strtotime($hari_kerja[0]->tgl_awal_banding))
            // {
            //     # code...
            //     $active_banding = "hide_banding";
            //     if (strtotime(date('Y-m-d')) > strtotime($hari_kerja[0]->tgl_akhir_banding))
            //     {
            //         # code...
            //         $active_banding = "hide_banding";
            //     }
            // }
            // else
            // {
            //     $active_banding = "show_banding";
            // }
        }
        for ($i=0; $i < count($list); $i++) {
            # code...
            $kegiatan = "";
            if ($list[$i]->kegiatan_skp == '' && $list[$i]->kegiatan_skp_jfu == '' && $list[$i]->kegiatan_skp_jft == '') {
                # code...
                $kegiatan = $list[$i]->uraian_tugas;                                                    
            } else {
                # code...
                if ($infoPegawai[0]->kat_posisi == 1) {
                    # code...
                    $kegiatan = $list[$i]->kegiatan_skp;
                }
                elseif ($infoPegawai[0]->kat_posisi == 2) {
                    # code...
                    $kegiatan = $list[$i]->kegiatan_skp_jft;
                }                                                                                            
                elseif ($infoPegawai[0]->kat_posisi == 4) {
                    # code...
                    $kegiatan = $list[$i]->kegiatan_skp_jfu;
                }
                elseif ($infoPegawai[0]->kat_posisi == 6) {
                    # code...
                    $kegiatan = $list[$i]->kegiatan_skp;
                }                                                                                                                                                    
            }                                  
?>
            <tr>
                <td><?=$list[$i]->tanggal_mulai;?>&nbsp;<?=$list[$i]->jam_mulai;?></td>
                <td><?=$list[$i]->tanggal_selesai;?>&nbsp;<?=$list[$i]->jam_selesai;?></td>
                <td><?=$kegiatan;?></td>
                <td><?=$list[$i]->realisasi_skp;?></td>
                <td><?=$list[$i]->target_skp;?></td>
                <td><?=$list[$i]->nama_pekerjaan;?></td>
                <td><?=$list[$i]->frekuensi_realisasi.' '.$list[$i]->target_output_name;?></td>
                <td>
                <?php
                    $link = "";
                    if ($list[$i]->file_pendukung != '') {
                        # code...
                ?>
                    <a class="btn btn-success btn-xs" href="<?php echo base_url() . 'public/file_pendukung/'.$list[$i]->file_pendukung; ?>"><i class="fa fa-download"></i>&nbsp;Unduh</a>
                <?php
                    }
                ?>
                </td>
                <td>
                    <?php
                        if ($active_keberatan == 'show_keberatan') {
                            # code...
                    ?>
                        <button class="btn btn-warning btn-xs" style="color: #fff;" onclick="keberatan('<?=$list[$i]->id_pekerjaan;?>')"><i class="fa fa-balance-scale"></i>&nbsp;Keberatan</button>&nbsp;&nbsp;
                    <?php
                        }
                    ?>
                    <?php
                        if ($active_banding == 'show_banding') {
                            # code...
                    ?>
                        <button class="btn btn-warning btn-xs" style="color: #fff;" onclick="banding('<?=$list[$i]->id_pekerjaan;?>')"><i class="fa fa-balance-scale"></i>&nbsp;Banding</button>&nbsp;&nbsp;
                    <?php
                        }
                    ?>
                    <?php echo anchor('transaksi/ubah_pekerjaan/'.$list[$i]->id_pekerjaan,'<button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>&nbsp;Ubah</button>');?>&nbsp;&nbsp;
                    <button class="btn btn-danger btn-xs" onclick="del('<?=$list[$i]->id_pekerjaan;?>')"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                </td>
            </tr>
<?php
        }
    }
?>
<script>
$("#<?=$id_html;?>").html('<?=$counter;?>');
</script>