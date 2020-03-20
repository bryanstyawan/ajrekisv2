<style>
    .label-info-pegawai
    {
        padding: 10px 10px;
    }
</style>
<?php
$trigger_disable_hari_aktif = "";
$trigger_css_hari_aktif     = "";
$trigger_msg_hari_aktif     = 0;
if ($hari_kerja == 0) {
    # code...
    $trigger_disable_hari_aktif = "disabled='disabled'";
    $trigger_css_hari_aktif     = "pointer-events: none;";
    $trigger_msg_hari_aktif     = 1;
}

$trigger_cs_layout_transaksi = "";
if ($member != array()) {
    // code...
    $trigger_cs_layout_transaksi = "col-xs-9";
}
else {
    // code...
    $trigger_cs_layout_transaksi = "col-xs-12";
}

?>
    <input type="hidden" id="trigger_msg" value="<?php echo $trigger_msg_hari_aktif;?>">
    <style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/tabs-checked/css/style_tabs.css'; ?>");</style>

    <?php
    if ($member != array()) {
        # code...
    ?>

    <div class="col-md-3">
        <div class="box box-solid" id="isi_kontak" style="">

            <div class="box-header with-border">
                <h3 class="box-title">Anggota</h3>
            </div>
            <div class="box-body no-padding" style="display: block;">
                <ul class="nav nav-pills nav-stacked contact-id">
                    <?php
                        $i = "";
                        for ($i=0; $i < count($member); $i++) {
                            // code...
                            $flag_counter = "";
                            if ($member[$i]->counter_belum_diperiksa == 0) {
                                // code...
                                $flag_counter = "display:none;";
                            }
                            
                            $flag_struktural = '';
                            if ($member[$i]->b_kat_posisi == 1) {
                                # code...
                                $flag_struktural = 'background:#dddfff;';
                            }
                    ?>
                            <li style="cursor: pointer;<?php echo $flag_struktural;?>" class="teamwork" id="li_kandidat_<?php echo $i;?>" onclick="view_option('<?php echo $member[$i]->id;?>','<?php echo $i;?>','<?=$member[$i]->posisi;?>')">
                                <a class="contact-name">
                                    <i class="fa fa-circle-o text-red contact-name-list"></i><?php echo $member[$i]->nama_pegawai;?>
                                    <sup style="<?php echo $flag_counter;?>">
                                        <span class="notif-count pull-right">
                                            <span><?php echo $member[$i]->counter_belum_diperiksa+$member[$i]->counter_keberatan;?></span>
                                        </span>
                                    </sup>
                                </a>
                                <input type="hidden" id="hdn_pegawai_<?php echo $i;?>" name="list_kandidat" value="<?php echo $member[$i]->nama_pegawai;?>"></input>
                            </li>
                        <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <?php
    }
    ?>

<section id="view_main">
    <div class="<?php echo $trigger_cs_layout_transaksi;?>">
        <div class="box">
            <div class="box-header">
                <div class ="box-tools">
                </div>
            </div>
            <div class="box-body">


                <div class="container col-lg-12" style="padding-top: 20px;">
                    <ul class="nav nav-tabs">
                        <li id="tab_sikerja" class="active">
                            <a data-toggle="tab" href="#menu4"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Tambah Data Kinerja</a>
                        </li>
                        <li id="tab_belum_diperiksa">
                            <a data-toggle="tab" href="#home">
                                Tahap Belum diperiksa&nbsp;&nbsp;
                                <sup>
                                    <span id="counter_proses_head" class="notif-count">
                                        <span id="counter_proses"></span>
                                    </span>
                                </sup>
                            </a>
                        </li>
                        <!-- <li>
                            <a data-toggle="tab" href="#menu1">
                                Tahap Revisi
                                <sup>
                                    <span id="counter_revisi_head" class="notif-count">
                                        <span id="counter_revisi"></span>
                                    </span>
                                </sup>
                            </a>
                        </li> -->
                        <li>
                            <a data-toggle="tab" href="#menu2">
                                Tahap Disetujui
                                <sup>
                                    <span id="counter_disetujui_head" class="notif-count">
                                        <span id="counter_disetujui"></span>
                                    </span>
                                </sup>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#menu3">
                                Tahap Ditolak
                                <sup>
                                    <span id="counter_tolak_head" class="notif-count">
                                        <span id="counter_tolak"></span>
                                    </span>
                                </sup>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#menu5">
                                Tahap Keberatan
                                <sup>
                                    <span id="counter_keberatan_head" class="notif-count">
                                        <span id="counter_keberatan"></span>
                                    </span>
                                </sup>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#menu6">
                                Tahap Keberatan Ditolak
                                <sup>
                                    <span id="counter_keberatan_ditolak_head" class="notif-count">
                                        <span id="counter_keberatan_ditolak"></span>
                                    </span>
                                </sup>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#menu7">
                                Tahap Banding
                                <sup>
                                    <span id="counter_banding_head" class="notif-count">
                                        <span id="counter_banding"></span>
                                    </span>
                                </sup>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#menu8">
                                Tahap Banding Ditolak
                                <sup>
                                    <span id="counter_banding_ditolak_head" class="notif-count">
                                        <span id="counter_banding_ditolak"></span>
                                    </span>
                                </sup>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade" style="padding-top: 15px;">
                            <div class="table-responsive">
                                <h2>Tahap Belum diperiksa</h2>
                                <table id="table_belum_diperiksa" class="table table-bordered table-striped table-view">
                                    <thead>
                                        <tr>
                                            <th>Aktivitas</th>
                                            <th>Tanggal, Jam Mulai</th>
                                            <th>Tanggal, Jam Selesai</th>
                                            <th>Uraian Tugas</th>
                                            <!--                                             
                                            <th>Realisasi Target SKP</th>
                                            <th>Target SKP</th>
                                             -->
                                            <th>Keterangan Pekerjaan</th>
                                            <th>Output Kuantitas</th>
                                            <th>File Pendukung</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_content">
                                    <?php
                                        if ($tr_belum_diperiksa != 0)
                                        {
                                            # code...
                                            // print_r($infoPegawai);
                                            $active_keberatan = "";
                                            $active_banding = "";
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
                                            for ($i=0; $i < count($tr_belum_diperiksa); $i++) {
                                                # code...
                                                $kegiatan = "";
                                                if ($tr_belum_diperiksa[$i]->kegiatan_skp == '' && $tr_belum_diperiksa[$i]->kegiatan_skp_jfu == '' && $tr_belum_diperiksa[$i]->kegiatan_skp_jft == '') {
                                                    # code...
                                                    $kegiatan = $tr_belum_diperiksa[$i]->uraian_tugas;                                                    
                                                } else {
                                                    # code...
                                                    if ($infoPegawai[0]->kat_posisi == 1) {
                                                        # code...
                                                        $kegiatan = $tr_belum_diperiksa[$i]->kegiatan_skp;
                                                    }
                                                    elseif ($infoPegawai[0]->kat_posisi == 2) {
                                                        # code...
                                                        $kegiatan = $tr_belum_diperiksa[$i]->kegiatan_skp_jft;
                                                    }                                                                                            
                                                    elseif ($infoPegawai[0]->kat_posisi == 4) {
                                                        # code...
                                                        $kegiatan = $tr_belum_diperiksa[$i]->kegiatan_skp_jfu;
                                                    }
                                                    elseif ($infoPegawai[0]->kat_posisi == 6) {
                                                        # code...
                                                        $kegiatan = $tr_belum_diperiksa[$i]->kegiatan_skp;
                                                    }                                                                                                                                                    
                                                }                                  
                                    ?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                            if ($tr_belum_diperiksa[$i]->lasttime == 0) {
                                                                # code...
                                                                echo 'Hari ini.';
                                                            }
                                                            else
                                                            {
                                                                echo $tr_belum_diperiksa[$i]->lasttime.' Hari Yang Lalu';
                                                            }
                                                        ?> 
                                                    </td>                                                
                                                    <td><?php echo $tr_belum_diperiksa[$i]->tanggal_mulai;?>&nbsp;<?php echo $tr_belum_diperiksa[$i]->jam_mulai;?></td>
                                                    <td><?php echo $tr_belum_diperiksa[$i]->tanggal_selesai;?>&nbsp;<?php echo $tr_belum_diperiksa[$i]->jam_selesai;?></td>
                                                    <td><?php echo $kegiatan;?></td>
                                                    <!-- 
                                                    <td><?php echo $tr_belum_diperiksa[$i]->realisasi_skp;?></td>
                                                    <td><?php echo $tr_belum_diperiksa[$i]->target_skp;?></td> 
                                                    -->
                                                    <td><?php echo $tr_belum_diperiksa[$i]->nama_pekerjaan;?></td>
                                                    <td><?php echo $tr_belum_diperiksa[$i]->frekuensi_realisasi.' '.$tr_belum_diperiksa[$i]->target_output_name;?></td>
                                                    <td>
                                                    <?php
                                                        $link = "";
                                                        if ($tr_belum_diperiksa[$i]->file_pendukung != '') {
                                                            # code...
                                                    ?>
                                                        <a class="btn btn-success btn-xs" href="<?php echo base_url() . 'public/file_pendukung/'.$infoPegawai[0]->nip.'/'.$tr_belum_diperiksa[$i]->file_pendukung; ?>"><i class="fa fa-download"></i>&nbsp;Unduh</a>
                                                    <?php
                                                        }
                                                    ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            if ($active_keberatan == 'show_keberatan') {
                                                                # code...
                                                        ?>
                                                            <button class="btn btn-warning btn-xs" style="color: #fff;" onclick="keberatan('<?php echo $tr_belum_diperiksa[$i]->id_pekerjaan;?>')"><i class="fa fa-balance-scale"></i>&nbsp;Keberatan</button>&nbsp;&nbsp;
                                                        <?php
                                                            }
                                                        ?>
                                                        <?php
                                                            if ($active_banding == 'show_banding') {
                                                                # code...
                                                        ?>
                                                            <button class="btn btn-warning btn-xs" style="color: #fff;" onclick="banding('<?php echo $tr_belum_diperiksa[$i]->id_pekerjaan;?>')"><i class="fa fa-balance-scale"></i>&nbsp;Banding</button>&nbsp;&nbsp;
                                                        <?php
                                                            }
                                                        ?>
                                                        <!-- <?php echo anchor('transaksi/ubah_pekerjaan/'.$tr_belum_diperiksa[$i]->id_pekerjaan,'<button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>&nbsp;Ubah</button>');?>&nbsp;&nbsp; -->
                                                        <button class="btn btn-danger btn-xs" onclick="del('<?php echo $tr_belum_diperiksa[$i]->id_pekerjaan;?>')"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                                                    </td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div id="menu1" class="tab-pane fade" style="padding-top: 15px;">
                                <div class="table-responsive">
                                <h2>Tahap Revisi</h2>
                                <table id="table_revisi" class="table table-bordered table-striped table-view">
                                    <thead>
                                        <tr>
                                            <th>Tanggal, Jam Mulai</th>
                                            <th>Tanggal, Jam Selesai</th>
                                            <th>Uraian Tugas</th>
                                            <th>Keterangan Pekerjaan</th>
                                            <th>Output Kuantitas</th>
                                            <th>File Pendukung</th>
                                            <th>Komentar Atasan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_content">
                                    <?php
                                        if ($tr_revisi != 0)
                                        {
                                            # code...
                                            for ($i=0; $i < count($tr_revisi); $i++) {
                                                # code...
                                                $kegiatan = "";
                                                if ($tr_revisi[$i]->kegiatan_skp == '' && $tr_revisi[$i]->kegiatan_skp_jfu == '' && $tr_revisi[$i]->kegiatan_skp_jft == '') {
                                                    # code...
                                                    $kegiatan = $tr_revisi[$i]->uraian_tugas;                                                    
                                                } else {
                                                    # code...
                                                    if ($infoPegawai[0]->kat_posisi == 1) {
                                                        # code...
                                                        $kegiatan = $tr_revisi[$i]->kegiatan_skp;
                                                    }
                                                    elseif ($infoPegawai[0]->kat_posisi == 2) {
                                                        # code...
                                                        $kegiatan = $tr_revisi[$i]->kegiatan_skp_jft;
                                                    }                                                                                            
                                                    elseif ($infoPegawai[0]->kat_posisi == 4) {
                                                        # code...
                                                        $kegiatan = $tr_revisi[$i]->kegiatan_skp_jfu;
                                                    }
                                                    elseif ($infoPegawai[0]->kat_posisi == 6) {
                                                        # code...
                                                        $kegiatan = $tr_revisi[$i]->kegiatan_skp;
                                                    }                                                                                                                                                    
                                                }                                
                                    ?>
                                                <tr>
                                                    <td><?php echo $tr_revisi[$i]->tanggal_mulai;?>&nbsp;<?php echo $tr_revisi[$i]->jam_mulai;?></td>
                                                    <td><?php echo $tr_revisi[$i]->tanggal_selesai;?>&nbsp;<?php echo $tr_revisi[$i]->jam_selesai;?></td>
                                                    <td><?php echo $kegiatan;?></td>
                                                    <td><?php echo $tr_revisi[$i]->nama_pekerjaan;?></td>
                                                    <td><?php echo $tr_revisi[$i]->frekuensi_realisasi.' '.$tr_revisi[$i]->target_output_name;?></td>
                                                    <td>
                                                    <?php
                                                        $link = "";
                                                        if ($tr_revisi[$i]->file_pendukung != '') {
                                                            # code...
                                                    ?>
                                                        <a class="btn btn-success btn-xs" href="<?php echo base_url() . 'public/file_pendukung/'.$infoPegawai[0]->nip.'/'.$tr_revisi[$i]->file_pendukung; ?>"><i class="fa fa-download"></i>&nbsp;Unduh</a>
                                                    <?php
                                                        }
                                                    ?>
                                                    </td>
                                                    <td><?php echo $tr_revisi[$i]->komentar_pemeriksa;?></td>
                                                    <td>
                                                        <!-- <?php echo anchor('transaksi/ubah_pekerjaan/'.$tr_revisi[$i]->id_pekerjaan,'<button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>&nbsp;Revisi</button>');?> -->
                                                        <button class="btn btn-danger btn-xs" onclick="del('<?php echo $tr_revisi[$i]->id_pekerjaan;?>')"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                                                    </td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                                        

                        <div id="menu2" class="tab-pane fade">
                            <div class="table-responsive">
                                <h2>Tahap Disetujui</h2>
                                <table id="table_disetujui" class="table table-bordered table-striped table-view">
                                    <thead>
                                        <tr>
                                            <th>Tanggal, Jam Mulai</th>
                                            <th>Tanggal, Jam Selesai</th>
                                            <th>Uraian Tugas</th>
                                            <th>Keterangan Pekerjaan</th>
                                            <th>Output Kuantitas</th>
                                            <th>Target SKP</th>
                                            <th>File Pendukung</th>
                                            <th>Menit Efektif</th>
                                            <!-- <th>Tunjangan</th> -->
                                        </tr>
                                    </thead>
                                    <tbody id="table_content">
                                    <?php
                                        if ($tr_disetujui != 0)
                                        {
                                            # code...                                            
                                            for ($i=0; $i < count($tr_disetujui); $i++) {
                                                # code...
                                                $kegiatan = "";
                                                if ($tr_disetujui[$i]->kegiatan_skp == '' && $tr_disetujui[$i]->kegiatan_skp_jfu == '' && $tr_disetujui[$i]->kegiatan_skp_jft == '') {
                                                    # code...
                                                    $kegiatan = $tr_disetujui[$i]->uraian_tugas;                                                    
                                                } else {
                                                    # code...
                                                    if ($infoPegawai[0]->kat_posisi == 1) {
                                                        # code...
                                                        $kegiatan = $tr_disetujui[$i]->kegiatan_skp;
                                                    }
                                                    elseif ($infoPegawai[0]->kat_posisi == 2) {
                                                        # code...
                                                        $kegiatan = $tr_disetujui[$i]->kegiatan_skp_jft;
                                                    }                                                                                            
                                                    elseif ($infoPegawai[0]->kat_posisi == 4) {
                                                        # code...
                                                        $kegiatan = $tr_disetujui[$i]->kegiatan_skp_jfu;
                                                    }
                                                    elseif ($infoPegawai[0]->kat_posisi == 6) {
                                                        # code...
                                                        $kegiatan = $tr_disetujui[$i]->kegiatan_skp;
                                                    }                                                                                                                                                    
                                                }
                                    ?>
                                                <tr>
                                                    <td><?php echo $tr_disetujui[$i]->tanggal_mulai;?>&nbsp;<?php echo $tr_disetujui[$i]->jam_mulai;?></td>
                                                    <td><?php echo $tr_disetujui[$i]->tanggal_selesai;?>&nbsp;<?php echo $tr_disetujui[$i]->jam_selesai;?></td>
                                                    <td><?php echo $kegiatan;?></td>
                                                    <td><?php echo $tr_disetujui[$i]->nama_pekerjaan;?></td>
                                                    <td><?php echo $tr_disetujui[$i]->frekuensi_realisasi.' '.$tr_disetujui[$i]->target_output_name;?></td>
                                                    <td><?php echo $tr_disetujui[$i]->target_skp;?></td>
                                                    <td>
                                                    <?php
                                                        $link = "";
                                                        if ($tr_disetujui[$i]->file_pendukung != '') {
                                                            # code...
                                                    ?>
                                                        <a class="btn btn-success btn-xs" href="<?php echo base_url() . 'public/file_pendukung/'.$infoPegawai[0]->nip.'/'.$tr_disetujui[$i]->file_pendukung; ?>"><i class="fa fa-download"></i>&nbsp;Unduh</a>
                                                    <?php
                                                        }
                                                    ?>
                                                    </td>
                                                    <td><?php echo $tr_disetujui[$i]->menit_efektif;?></td>
                                                    <!-- <td>Rp. <?php echo number_format($tr_disetujui[$i]->tunjangan);?></td> -->
                                                </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="menu3" class="tab-pane fade">
                            <div class="table-responsive">
                                <h2>Tahap Ditolak</h2>
                                <table id="table_ditolak" class="table table-bordered table-striped table-view">
                                    <thead>
                                        <tr>
                                            <th>Tanggal, Jam Mulai</th>
                                            <th>Tanggal, Jam Selesai</th>
                                            <th>Uraian Tugas</th>
                                            <th>Keterangan Pekerjaan</th>
                                            <th>Output Kuantitas</th>
                                            <th>File Pendukung</th>
                                            <th>Alasan Ditolak</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_content">
                                    <?php
                                        if ($tr_tolak != 0)
                                        {
                                            # code...
                                            for ($i=0; $i < count($tr_tolak); $i++) {
                                                # code...
                                                $kegiatan = "";
                                                if ($tr_tolak[$i]->kegiatan_skp == '' && $tr_tolak[$i]->kegiatan_skp_jfu == '' && $tr_tolak[$i]->kegiatan_skp_jft == '') {
                                                    # code...
                                                    $kegiatan = $tr_tolak[$i]->uraian_tugas;                                                    
                                                } else {
                                                    # code...
                                                    if ($infoPegawai[0]->kat_posisi == 1) {
                                                        # code...
                                                        $kegiatan = $tr_tolak[$i]->kegiatan_skp;
                                                    }
                                                    elseif ($infoPegawai[0]->kat_posisi == 2) {
                                                        # code...
                                                        $kegiatan = $tr_tolak[$i]->kegiatan_skp_jft;
                                                    }                                                                                            
                                                    elseif ($infoPegawai[0]->kat_posisi == 4) {
                                                        # code...
                                                        $kegiatan = $tr_tolak[$i]->kegiatan_skp_jfu;
                                                    }
                                                    elseif ($infoPegawai[0]->kat_posisi == 6) {
                                                        # code...
                                                        $kegiatan = $tr_tolak[$i]->kegiatan_skp;
                                                    }                                                                                                                                                    
                                                }                                                               
                                    ?>
                                                <tr>
                                                    <td><?php echo $tr_tolak[$i]->tanggal_mulai;?>&nbsp;<?php echo $tr_tolak[$i]->jam_mulai;?></td>
                                                    <td><?php echo $tr_tolak[$i]->tanggal_selesai;?>&nbsp;<?php echo $tr_tolak[$i]->jam_selesai;?></td>
                                                    <td><?php echo $kegiatan;?></td>
                                                    <td><?php echo $tr_tolak[$i]->nama_pekerjaan;?></td>
                                                    <td><?php echo $tr_tolak[$i]->frekuensi_realisasi.' '.$tr_tolak[$i]->target_output_name;?></td>
                                                    <td>
                                                    <?php
                                                        $link = "";
                                                        if ($tr_tolak[$i]->file_pendukung != '') {
                                                            # code...
                                                    ?>
                                                        <a class="btn btn-success btn-xs" href="<?php echo base_url() . 'public/file_pendukung/'.$infoPegawai[0]->nip.'/'.$tr_tolak[$i]->file_pendukung; ?>"><i class="fa fa-download"></i>&nbsp;Unduh</a>
                                                    <?php
                                                        }
                                                    ?>
                                                    </td>
                                                    <td><?php echo $tr_tolak[$i]->alasan_ditolak;?></td>
                                                    <td>
                                                        <button class="btn btn-warning btn-xs" style="color: #fff;" onclick="keberatan('<?php echo $tr_tolak[$i]->id_pekerjaan;?>')"><i class="fa fa-balance-scale"></i>&nbsp;Keberatan</button>
                                                    </td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="menu4" class="tab-pane fade in active">
                            <div class="table-responsive">
                                <h2 class="text-center" style="background-color: #FF0000;color: #fff;">EQUAL WORK DESERVES EQUAL PAY</h2>

                                <div class="box-header with-border">
                                    <div class="col-lg-12 text-center">
                                        <h2 class="box-title pull-left">Tambah Pekerjaan Baru</h2>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box box-default">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label style="color: #000;font-weight: 400;font-size: 19px;">Uraian Tugas</label>
                                                <select class="form-control js-example-basic-single tour-step step1" name="urtug" id="urtug">
                                                        <option value="">Pilih Uraian Tugas</option>

                                                        <?php
                                                            if ($urtug) {
                                                                # code...
                                                                $x = "";
                                                                for ($i=0; $i < count($urtug); $i++) {
                                                                    # code...
                                                                    $x++;
                                                                    $kegiatan_urtug = $urtug[$i]->kegiatan;                            
                                                                    if($infoPegawai[0]->kat_posisi == 1)
                                                                    {
                                                                        if ($urtug[$i]->id_skp_master != 0) {
                                                                            # code...
                                                                            $kegiatan_urtug            = $urtug[$i]->kegiatan_skp;
                                                                        }
                                                                    }
                                                                    elseif ($infoPegawai[0]->kat_posisi == 2) {
                                                                        # code...
                                                                        if ($urtug[$i]->id_skp_jft != 0) {
                                                                            # code...
                                                                            $kegiatan_urtug            = $urtug[$i]->kegiatan_skp_jft;
                                                                        }                                
                                                                    }                            
                                                                    elseif ($infoPegawai[0]->kat_posisi == 4) {
                                                                        # code...
                                                                        if ($urtug[$i]->id_skp_jfu != 0) {
                                                                            # code...
                                                                            $kegiatan_urtug            = $urtug[$i]->kegiatan_skp_jfu;
                                                                        }                                
                                                                    }
                                                                    elseif($infoPegawai[0]->kat_posisi == 6)
                                                                    {
                                                                        if ($urtug[$i]->id_skp_master != 0) {
                                                                            # code...
                                                                            $kegiatan_urtug            = $urtug[$i]->kegiatan_skp;
                                                                        }
                                                                    }

                                                        ?>
                                                                <option value="<?php echo $urtug[$i]->skp_id;?>"><?php echo $x.". ".$kegiatan_urtug;?></option>
                                                        <?
                                                                }
                                                            }
                                                        ?>
                                                </select>
                                                <input type="hidden" id="flag_urtug" name="flag_urtug">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label style="color: #000;font-weight: 400;font-size: 19px;">Tanggal Mulai</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    <input type="text" id="tgl_mulai" name="tgl_mulai" class="form-control timerange" >
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label style="color: #000;font-weight: 400;font-size: 19px;">Tanggal Selesai</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    <input type="text" id="tgl_selesai" name="tgl_selesai" class="form-control timerange" >
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label style="color: #000;font-weight: 400;font-size: 19px;">Jam Mulai</label>
                                                <div class="input-group clockpicker">
                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    <input type="text" id="jam_mulai" name="jam_mulai" class="form-control timemasking" data-inputmask="'mask': ['99:99']" data-mask>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label style="color: #000;font-weight: 400;font-size: 19px;">Jam Selesai</label>
                                                <div class="input-group clockpicker">
                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    <input type="text" id="jam_selesai" name="jam_selesai" class="form-control timemasking" data-inputmask="'mask': ['99:99']" data-mask>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label style="color: #000;font-weight: 400;font-size: 19px;">Keterangan Pekerjaan <b class="pull-right">*</b></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    <textarea id="ket_pekerjaan" name="ket_pekerjaan" class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-12" style="background-color:#fcff37">
                                                <div class="form-group col-md-12">
                                                    <label style="color: #000;font-weight: 400;font-size: 19px;">*Diisi jika sudah ada output</label>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <input type="hidden" id="hdn_param_out_skp">
                                                    <input type="hidden" id="hdn_param_qty_skp">
                                                    <input type="hidden" id="hdn_param_realisasi_qty_skp">
                                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Kuantitas</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                        <input type="number" id="kuantitas" name="kuantitas" min="0" class="form-control">
                                                    </div>
                                                    <div>
                                                        <span class="input-group-addon"><label id="param_qty_skp">Target Kuantitas SKP : </label></span> |                                                   
                                                        <span class="input-group-addon"><label id="param_realisasi_qty_skp">Realisasi : </label></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <div class="col-lg-12">
                                                        <label class="pull-left" style="color: #000;font-weight: 400;font-size: 19px;">File Pendukung</label>
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                        <input type="file" id="file_pendukung" name="file_pendukung" class="form-control">
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label class="pull-right" style="color: #000;font-weight: 400;font-size: 14px;">*Maksimal 3MB (pdf|csv|docx|doc|xlsx|xl|xls|jpg|jpeg|png)</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6 pull-right">
                                                        <span class="input-group-btn">
                                                            <a class="btn btn-app pull-right" id="btn_save" <?php echo $trigger_disable_hari_aktif;?> style="<?php echo $trigger_css_hari_aktif;?>"><i class="fa fa-save"></i> Simpan</a>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="pull-left"><b>*Pastikan Pengaturan Timezone dikomputer anda sudah benar.</b></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div id="menu5" class="tab-pane fade">
                            <div class="table-responsive">
                                <h2>Tahap Keberatan</h2>
                                <table id="table_ditolak" class="table table-bordered table-striped table-view">
                                    <thead>
                                        <tr>
                                            <th>Tanggal, Jam Mulai</th>
                                            <th>Tanggal, Jam Selesai</th>
                                            <th>Uraian Tugas</th>
                                            <th>Keterangan Pekerjaan</th>
                                            <th>Output Kuantitas</th>
                                            <th>File Pendukung</th>
                                            <th>Alasan Keberatan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_content">
                                    <?php
                                        if ($tr_keberatan != 0)
                                        {
                                            # code...
                                            for ($i=0; $i < count($tr_keberatan); $i++) {
                                                # code...
                                                $kegiatan = "";
                                                if ($tr_keberatan[$i]->kegiatan_skp == '' && $tr_keberatan[$i]->kegiatan_skp_jfu == '' && $tr_keberatan[$i]->kegiatan_skp_jft == '') {
                                                    # code...
                                                    $kegiatan = $tr_keberatan[$i]->uraian_tugas;                                                    
                                                } else {
                                                    # code...
                                                    if ($infoPegawai[0]->kat_posisi == 1) {
                                                        # code...
                                                        $kegiatan = $tr_keberatan[$i]->kegiatan_skp;
                                                    }
                                                    elseif ($infoPegawai[0]->kat_posisi == 2) {
                                                        # code...
                                                        $kegiatan = $tr_keberatan[$i]->kegiatan_skp_jft;
                                                    }                                                                                            
                                                    elseif ($infoPegawai[0]->kat_posisi == 4) {
                                                        # code...
                                                        $kegiatan = $tr_keberatan[$i]->kegiatan_skp_jfu;
                                                    }
                                                    if ($infoPegawai[0]->kat_posisi == 6) {
                                                        # code...
                                                        $kegiatan = $tr_keberatan[$i]->kegiatan_skp;
                                                    }                                                                                                                                                    
                                                }                                                                   
                                    ?>
                                                <tr>
                                                    <td><?php echo $tr_keberatan[$i]->tanggal_mulai;?>&nbsp;<?php echo $tr_keberatan[$i]->jam_mulai;?></td>
                                                    <td><?php echo $tr_keberatan[$i]->tanggal_selesai;?>&nbsp;<?php echo $tr_keberatan[$i]->jam_selesai;?></td>
                                                    <td><?php echo $kegiatan;?></td>
                                                    <td><?php echo $tr_keberatan[$i]->nama_pekerjaan;?></td>
                                                    <td><?php echo $tr_keberatan[$i]->frekuensi_realisasi.' '.$tr_keberatan[$i]->target_output_name;?></td>                                                    
                                                    <!-- <td><?php echo $tr_keberatan[$i]->output_pekerjaan;?></td> -->
                                                    <td>
                                                    <?php
                                                        $link = "";
                                                        if ($tr_keberatan[$i]->file_pendukung != '') {
                                                            # code...
                                                    ?>
                                                        <a class="btn btn-success btn-xs" href="<?php echo base_url() . 'public/file_pendukung/'.$infoPegawai[0]->nip.'/'.$tr_keberatan[$i]->file_pendukung; ?>"><i class="fa fa-download"></i>&nbsp;Unduh</a>
                                                    <?php
                                                        }
                                                    ?>
                                                    </td>
                                                    <td><?php echo $tr_keberatan[$i]->komentar_keberatan;?></td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="menu6" class="tab-pane fade">
                            <div class="table-responsive">
                                <h2>Tahap Keberatan Ditolak</h2>
                                <table id="table_ditolak" class="table table-bordered table-striped table-view">
                                    <thead>
                                        <tr>
                                            <th>Tanggal, Jam Mulai</th>
                                            <th>Tanggal, Jam Selesai</th>
                                            <th>Uraian Tugas</th>
                                            <th>Keterangan Pekerjaan</th>
                                            <th>Output Kuantitas</th>
                                            <th>File Pendukung</th>
                                            <th>Alasan Keberatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_content">
                                    <?php
                                        if ($tr_keberatan_ditolak != 0)
                                        {
                                            # code...
                                            for ($i=0; $i < count($tr_keberatan_ditolak); $i++) {
                                                # code...
                                                $kegiatan = "";
                                                if ($tr_keberatan_ditolak[$i]->kegiatan_skp == '' && $tr_keberatan_ditolak[$i]->kegiatan_skp_jfu == '' && $tr_keberatan_ditolak[$i]->kegiatan_skp_jft == '') {
                                                    # code...
                                                    $kegiatan = $tr_keberatan_ditolak[$i]->uraian_tugas;                                                    
                                                } else {
                                                    # code...
                                                    if ($infoPegawai[0]->kat_posisi == 1) {
                                                        # code...
                                                        $kegiatan = $tr_keberatan_ditolak[$i]->kegiatan_skp;
                                                    }
                                                    elseif ($infoPegawai[0]->kat_posisi == 2) {
                                                        # code...
                                                        $kegiatan = $tr_keberatan_ditolak[$i]->kegiatan_skp_jft;
                                                    }                                                                                            
                                                    elseif ($infoPegawai[0]->kat_posisi == 4) {
                                                        # code...
                                                        $kegiatan = $tr_keberatan_ditolak[$i]->kegiatan_skp_jfu;
                                                    }
                                                    elseif ($infoPegawai[0]->kat_posisi == 6) {
                                                        # code...
                                                        $kegiatan = $tr_keberatan_ditolak[$i]->kegiatan_skp;
                                                    }                                                                                                
                                                }                                                                              
                                    ?>
                                                <tr>
                                                    <td><?php echo $tr_keberatan_ditolak[$i]->tanggal_mulai;?>&nbsp;<?php echo $tr_keberatan_ditolak[$i]->jam_mulai;?></td>
                                                    <td><?php echo $tr_keberatan_ditolak[$i]->tanggal_selesai;?>&nbsp;<?php echo $tr_keberatan_ditolak[$i]->jam_selesai;?></td>
                                                    <td><?php echo $kegiatan;?></td>
                                                    <td><?php echo $tr_keberatan_ditolak[$i]->nama_pekerjaan;?></td>
                                                    <td><?php echo $tr_keberatan_ditolak[$i]->frekuensi_realisasi.' '.$tr_keberatan_ditolak[$i]->target_output_name;?></td>
                                                    <td>
                                                    <?php
                                                        $link = "";
                                                        if ($tr_keberatan_ditolak[$i]->file_pendukung != '') {
                                                            # code...
                                                    ?>
                                                        <a class="btn btn-success btn-xs" href="<?php echo base_url() . 'public/file_pendukung/'.$infoPegawai[0]->nip.'/'.$tr_keberatan_ditolak[$i]->file_pendukung; ?>"><i class="fa fa-download"></i>&nbsp;Unduh</a>
                                                    <?php
                                                        }
                                                    ?>
                                                    </td>
                                                    <td><?php echo $tr_keberatan_ditolak[$i]->alasan_ditolak;?></td>
                                                    <td>
                                                        <button class="btn btn-xs" onclick="banding('<?php echo $tr_keberatan_ditolak[$i]->id_pekerjaan;?>')"><i class="fa fa-balance-scale"></i>&nbsp;Banding</button>
                                                    </td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="menu7" class="tab-pane fade">
                            <div class="table-responsive">
                                <h2>Tahap Banding</h2>
                                <table id="table_ditolak" class="table table-bordered table-striped table-view">
                                    <thead>
                                        <tr>
                                            <th>Tanggal, Jam Mulai</th>
                                            <th>Tanggal, Jam Selesai</th>
                                            <th>Uraian Tugas</th>
                                            <th>Keterangan Pekerjaan</th>
                                            <th>Output Kuantitas</th>
                                            <th>File Pendukung</th>
                                            <th>Alasan Banding</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_content">
                                    <?php
                                        if ($tr_banding != 0)
                                        {
                                            # code...
                                            for ($i=0; $i < count($tr_banding); $i++) {
                                                # code...
                                                $kegiatan = "";
                                                if ($tr_banding[$i]->kegiatan_skp == '' && $tr_banding[$i]->kegiatan_skp_jfu == '' && $tr_banding[$i]->kegiatan_skp_jft == '') {
                                                    # code...
                                                    $kegiatan = $tr_banding[$i]->uraian_tugas;                                                    
                                                } else {
                                                    # code...
                                                    if ($infoPegawai[0]->kat_posisi == 1) {
                                                        # code...
                                                        $kegiatan = $tr_banding[$i]->kegiatan_skp;
                                                    }
                                                    elseif ($infoPegawai[0]->kat_posisi == 2) {
                                                        # code...
                                                        $kegiatan = $tr_banding[$i]->kegiatan_skp_jft;
                                                    }                                                                                            
                                                    elseif ($infoPegawai[0]->kat_posisi == 4) {
                                                        # code...
                                                        $kegiatan = $tr_banding[$i]->kegiatan_skp_jfu;
                                                    }                                             
                                                    elseif ($infoPegawai[0]->kat_posisi == 6) {
                                                        # code...
                                                        $kegiatan = $tr_banding[$i]->kegiatan_skp;
                                                    }                                                                                                       
                                                }        
                                    ?>
                                                <tr>
                                                    <td><?php echo $tr_banding[$i]->tanggal_mulai;?>&nbsp;<?php echo $tr_banding[$i]->jam_mulai;?></td>
                                                    <td><?php echo $tr_banding[$i]->tanggal_selesai;?>&nbsp;<?php echo $tr_banding[$i]->jam_selesai;?></td>
                                                    <td><?php echo $kegiatan;?></td>
                                                    <td><?php echo $tr_banding[$i]->nama_pekerjaan;?></td>
                                                    <td><?php echo $tr_banding[$i]->frekuensi_realisasi.' '.$tr_banding[$i]->target_output_name;?></td>
                                                    <td>
                                                    <?php
                                                        $link = "";
                                                        if ($tr_banding[$i]->file_pendukung != '') {
                                                            # code...
                                                    ?>
                                                        <a class="btn btn-success btn-xs" href="<?php echo base_url() . 'public/file_pendukung/'.$infoPegawai[0]->nip.'/'.$tr_banding[$i]->file_pendukung; ?>"><i class="fa fa-download"></i>&nbsp;Unduh</a>
                                                    <?php
                                                        }
                                                    ?>
                                                    </td>
                                                    <td><?php echo $tr_banding[$i]->komentar_banding;?></td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="menu8" class="tab-pane fade">
                            <div class="table-responsive">
                                <h2>Tahap Banding Ditolak</h2>
                                <table id="table_ditolak" class="table table-bordered table-striped table-view">
                                    <thead>
                                        <tr>
                                            <th>Tanggal, Jam Mulai</th>
                                            <th>Tanggal, Jam Selesai</th>
                                            <th>Uraian Tugas</th>
                                            <th>Keterangan Pekerjaan</th>
                                            <th>Output Kuantitas</th>
                                            <th>File Pendukung</th>
                                            <th>Alasan Banding Ditolak</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_content">
                                    <?php
                                        if ($tr_banding_ditolak != 0)
                                        {
                                            # code...
                                            for ($i=0; $i < count($tr_banding_ditolak); $i++) {
                                                # code...
                                                $kegiatan = "";
                                                if ($tr_banding_ditolak[$i]->kegiatan_skp == '' && $tr_banding_ditolak[$i]->kegiatan_skp_jfu == '' && $tr_banding_ditolak[$i]->kegiatan_skp_jft == '') {
                                                    # code...
                                                    $kegiatan = $tr_banding_ditolak[$i]->uraian_tugas;                                                    
                                                } else {
                                                    # code...
                                                    if ($infoPegawai[0]->kat_posisi == 1) {
                                                        # code...
                                                        $kegiatan = $tr_banding_ditolak[$i]->kegiatan_skp;
                                                    }
                                                    elseif ($infoPegawai[0]->kat_posisi == 2) {
                                                        # code...
                                                        $kegiatan = $tr_banding_ditolak[$i]->kegiatan_skp_jft;
                                                    }                                                                                            
                                                    elseif ($infoPegawai[0]->kat_posisi == 4) {
                                                        # code...
                                                        $kegiatan = $tr_banding_ditolak[$i]->kegiatan_skp_jfu;
                                                    }
                                                    elseif ($infoPegawai[0]->kat_posisi == 6) {
                                                        # code...
                                                        $kegiatan = $tr_banding_ditolak[$i]->kegiatan_skp;
                                                    }                                                                                                                                                    
                                                }                                                
                                    ?>
                                                <tr>
                                                    <td><?php echo $tr_banding_ditolak[$i]->tanggal_mulai;?>&nbsp;<?php echo $tr_banding_ditolak[$i]->jam_mulai;?></td>
                                                    <td><?php echo $tr_banding_ditolak[$i]->tanggal_selesai;?>&nbsp;<?php echo $tr_banding_ditolak[$i]->jam_selesai;?></td>
                                                    <td><?php echo $kegiatan;?></td>
                                                    <td><?php echo $tr_banding_ditolak[$i]->nama_pekerjaan;?></td>
                                                    <td><?php echo $tr_banding_ditolak[$i]->output_pekerjaan;?></td>
                                                    <td>
                                                    <?php
                                                        $link = "";
                                                        if ($tr_banding_ditolak[$i]->file_pendukung != '') {
                                                            # code...
                                                    ?>
                                                        <a class="btn btn-success btn-xs" href="<?php echo base_url() . 'public/file_pendukung/'.$infoPegawai[0]->nip.'/'.$tr_banding_ditolak[$i]->file_pendukung; ?>"><i class="fa fa-download"></i>&nbsp;Unduh</a>
                                                    <?php
                                                        }
                                                    ?>
                                                    </td>
                                                    <td><?php echo $tr_banding_ditolak[$i]->komentar_tolak_banding;?></td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section id="view_bawahan" class="col-lg-9" style="display:none;">
    <div class="box">
        <div class="box-header">
			<h3 class="box-title heading-hr text-center col-lg-12">
                INFORMASI PEGAWAI
                <div class="box-tools pull-left">
                    <button class="btn btn-block btn-success" id="btn-backtomain"><i class="fa fa-arrow-circle-o-left"></i> Kembali</button>
                </div>
            </h3>																				        
        </div>
        <div class="box-body">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-2">
                        <div id="lbl_image"></div>
                    </div>

                    <div class="col-md-10 label-info-pegawai">
                        <div class="col-md-6 label-info-pegawai">
                            <label>Pimpinan Tinggi Madya (Eselon I) :</label>
                            <span id="lbl_eselon1"></span>
                        </div>

                        <div class="col-md-6 label-info-pegawai">
                            <label>Pimpinan Tinggi Pratama (Eselon II) :</label>
                            <span id="lbl_eselon2"></span>
                        </div>

                        <div class="col-md-6 label-info-pegawai">
                            <label>Administrator (Eselon III) :</label>
                            <span id="lbl_eselon3"></span>
                        </div>

                        <div class="col-md-6 label-info-pegawai">
                            <label>Pengawas (Eselon IV) :</label>
                            <span id="lbl_eselon4"></span>
                        </div>

                        <div class="col-md-6 label-info-pegawai">
                            <label>NIP:</label>
                            <span id="lbl_nip"></span>
                        </div>

                        <div class="col-md-6 label-info-pegawai">
                            <label>Nama:</label>
                            <span id="lbl_nama"></span>
                        </div>
                    </div>

                </div>
                <div class="row" style="padding-top:25px;">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#home_atasan">
                                Periksa&nbsp;&nbsp;
                                <sup>
                                    <span id="counter_atasan_proses_head" class="notif-count">
                                        <span class="counter_atasan_notify" id="counter_atasan_proses"></span>
                                    </span>
                                </sup>
                            </a>
                        </li>
                        <!-- 
                        <li>
                            <a data-toggle="tab" href="#menu1_atasan">
                                Tahap Revisi
                                <sup>
                                    <span id="counter_atasan_revisi_head" class="notif-count-transparent">
                                        <span class="counter_atasan_notify" id="counter_atasan_revisi"></span>
                                    </span>
                                </sup>
                            </a>
                        </li> 
                        -->
                        <li>
                            <a data-toggle="tab" href="#menu2_atasan">
                                Setujui
                                <sup>
                                    <span id="counter_atasan_disetujui_head" class="notif-count-transparent">
                                        <span class="counter_atasan_notify" id="counter_atasan_disetujui"></span>
                                    </span>
                                </sup>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#menu3_atasan">
                                Tolak
                                <sup>
                                    <span id="counter_atasan_tolak_head" class="notif-count-transparent">
                                        <span class="counter_atasan_notify" id="counter_atasan_tolak"></span>
                                    </span>
                                </sup>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#menu5_atasan">
                                Keberatan
                                <sup>
                                    <span id="counter_atasan_keberatan_head" class="notif-count">
                                        <span class="counter_atasan_notify" id="counter_atasan_keberatan"></span>
                                    </span>
                                </sup>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#menu6_atasan">
                                Keberatan Ditolak
                                <sup>
                                    <span id="counter_atasan_keberatan_ditolak_head" class="notif-count-transparent">
                                        <span class="counter_atasan_notify" id="counter_atasan_keberatan_ditolak"></span>
                                    </span>
                                </sup>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#menu7_atasan">
                                Banding
                                <sup>
                                    <span id="counter_atasan_banding_head" class="notif-count-transparent">
                                        <span class="counter_atasan_notify" id="counter_atasan_banding"></span>
                                    </span>
                                </sup>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#menu8_atasan">
                                Banding Ditolak
                                <sup>
                                    <span id="counter_atasan_banding_ditolak_head" class="notif-count-transparent">
                                        <span class="counter_atasan_notify" id="counter_atasan_banding_ditolak"></span>
                                    </span>
                                </sup>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="home_atasan" class="tab-pane fade in active" style="padding-top: 15px;">
                            <div class="table-responsive">
                                <h2>Tahap Anda Periksa</h2>
                                <div class="col-md-3 pull-right">
                                    <div class="checkbox pull-right">
                                        <label>
                                        <input type="checkbox" id="multi_approve" style="width: 19px;height: 21px;margin-top: 0px;margin-left: -25px;">
                                        Multi Approve
                                        </label>
                                    </div>            
                                </div>                                
                                <table id="table_belum_diperiksa_atasan" class="table table-bordered table-striped table-view1">
                                    <thead>
                                        <tr>
                                            <th>Aktivitas</th>
                                            <th>Tanggal, Jam Mulai</th>
                                            <th>Tanggal, Jam Selesai</th>
                                            <th>Uraian Tugas</th>
                                            <th>Realisasi Target SKP</th>
                                            <th>Target SKP</th>
                                            <th>Keterangan Pekerjaan</th>
                                            <th>Output Kuantitas</th>
                                            <th>File Pendukung</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_content_belum_diperiksa_atasan">
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="menu1_atasan" class="tab-pane fade" style="padding-top: 15px;">
                            <div class="table-responsive">
                                <h2>Tahap Revisi</h2>
                                <table id="table_revisi_atasan" class="table table-bordered table-striped table-view1">
                                    <thead>
                                        <tr>
                                            <th>Tanggal, Jam Mulai</th>
                                            <th>Tanggal, Jam Selesai</th>
                                            <th>Uraian Tugas</th>
                                            <th>Keterangan Pekerjaan</th>
                                            <th>Output Kuantitas</th>
                                            <th>File Pendukung</th>
                                            <th>Komentar Atasan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_content">
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="menu2_atasan" class="tab-pane fade">
                            <div class="table-responsive">
                                <h2>Tahap Anda Setuju</h2>
                                <table id="table_disetujui_atasan" class="table table-bordered table-striped table-view1">
                                    <thead>
                                        <tr>
                                            <!-- <th>Aktivitas</th> -->
                                            <th>Tanggal, Jam Mulai</th>
                                            <th>Tanggal, Jam Selesai</th>
                                            <th>Uraian Tugas</th>
                                            <th>Keterangan Pekerjaan</th>
                                            <th>Output Kuantitas</th>
                                            <th>Target SKP</th>
                                            <th>File Pendukung</th>
                                            <th>Menit Efektif</th>
                                            <!-- <th>Tunjangan</th> -->
                                        </tr>
                                    </thead>
                                    <tbody id="table_content">
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="menu3_atasan" class="tab-pane fade">
                            <div class="table-responsive">
                                <h2>Tahap Anda Tolak</h2>
                                <table id="table_ditolak_atasan" class="table table-bordered table-striped table-view1">
                                    <thead>
                                        <tr>
                                            <th>Tanggal, Jam Mulai</th>
                                            <th>Tanggal, Jam Selesai</th>
                                            <th>Uraian Tugas</th>
                                            <th>Keterangan Pekerjaan</th>
                                            <th>Output Kuantitas</th>
                                            <th>File Pendukung</th>
                                            <th>Alasan Direvisi</th>                                            
                                            <th>Alasan Ditolak</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_content"</tbody>
                                </table>
                            </div>
                        </div>

                        <div id="menu5_atasan" class="tab-pane fade">
                            <div class="table-responsive">
                                <h2>Tahap Keberatan</h2>
                                <table id="table_keberatan_atasan" class="table table-bordered table-striped table-view1">
                                    <thead>
                                        <tr>
                                            <th>Tanggal, Jam Mulai</th>
                                            <th>Tanggal, Jam Selesai</th>
                                            <th>Uraian Tugas</th>
                                            <th>Keterangan Pekerjaan</th>
                                            <th>Output Kuantitas</th>
                                            <th>File Pendukung</th>
                                            <th>Alasan Revisi</th>
                                            <th>Alasan Ditolak</th>
                                            <th>Alasan Keberatan</th>
                                            <th>Aksi</th>                                                                                        
                                        </tr>
                                    </thead>
                                    <tbody id="table_content"></tbody>
                                </table>
                            </div>
                        </div>

                        <div id="menu6_atasan" class="tab-pane fade">
                            <div class="table-responsive">
                                <h2>Tahap Keberatan Anda Tolak</h2>
                                <table id="table_keberatan_ditolak_atasan" class="table table-bordered table-striped table-view1">
                                    <thead>
                                        <tr>
                                            <th>Tanggal, Jam Mulai</th>
                                            <th>Tanggal, Jam Selesai</th>
                                            <th>Uraian Tugas</th>
                                            <th>Keterangan Pekerjaan</th>
                                            <th>Output Kuantitas</th>
                                            <th>File Pendukung</th>
                                            <th>Alasan Revisi</th>
                                            <th>Alasan Ditolak</th>
                                            <th>Alasan Keberatan</th>
                                            <th>Alasan Keberatan Ditolak</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_content"></tbody>
                                </table>
                            </div>
                        </div>

                        <div id="menu7_atasan" class="tab-pane fade">
                            <div class="table-responsive">
                                <h2>Tahap Banding</h2>
                                <table id="table_banding_atasan" class="table table-bordered table-striped table-view1">
                                    <thead>
                                        <tr>
                                            <th>Mulai - Selesai</th>
                                            <th>Uraian Tugas</th>
                                            <th>Keterangan Pekerjaan</th>
                                            <th>Output Kuantitas</th>
                                            <th>File Pendukung</th>
                                            <th>Alasan Ditolak</th>
                                            <th>Alasan Keberatan</th>
                                            <th>Alasan Keberatan Ditolak</th>
                                            <th>Alasan Banding</th>                                            
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_content"></tbody>
                                </table>
                            </div>
                        </div>


                        <div id="menu8_atasan" class="tab-pane fade">
                            <div class="table-responsive">
                                <h2>Tahap Banding Ditolak</h2>
                                <table id="table_banding_ditolak_atasan" class="table table-bordered table-striped table-view1">
                                    <thead>
                                        <tr>
                                            <th>Tanggal, Jam Mulai</th>
                                            <th>Tanggal, Jam Selesai</th>
                                            <th>Uraian Tugas</th>
                                            <th>Keterangan Pekerjaan</th>
                                            <th>Output Kuantitas</th>
                                            <th>File Pendukung</th>
                                            <th>Alasan Banding Ditolak</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_content"></tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<section>
<div class="example-modal">
    <div class="modal modal-success fade" id="keberatan_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="box-content">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Komentar Keberatan</h4>
                    </div>
                    <div class="modal-body" style="background-color: #fff!important;">
                        <form id="editForm" name="addForm">

                            <label style="color: #000;font-weight: 400;font-size: 19px;">Komentar</label>
                            <div class="form-group"><div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-star"></i></span>
                                <textarea class="form-control" id="textarea_komentar_keberatan" name="textarea_komentar_keberatan"></textarea>
                                <input type="hidden" id="oid_keberatan" name="oid_keberatan" >
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                        <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
                        <input type="submit" class="btn btn-primary" value="Simpan" id="btn_keberatan"/>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="example-modal">
    <div class="modal modal-success fade" id="tolak_data_keberatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="box-content">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Alasan Tolak Keberatan</h4>
                    </div>
                    <div class="modal-body" style="background-color: #fff!important;">
                        <form id="editForm" name="addForm">

                            <label style="color: #000;font-weight: 400;font-size: 19px;">Alasan</label>
                            <div class="form-group"><div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-star"></i></span>
                                <textarea class="form-control" id="textarea_alasan_tolak_keberatan" name="textarea_alasan_tolak_keberatan"></textarea>
                                <input type="hidden" id="oid_tolak_keberatan" name="oid_tolak_keberatan" >
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                        <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
                        <input type="submit" class="btn btn-primary" value="Simpan" id="btn_tolak_keberatan"/>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>    

    <div class="example-modal">
    <div class="modal modal-success fade" id="banding_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="box-content">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Komentar Banding</h4>
                    </div>
                    <div class="modal-body" style="background-color: #fff!important;">
                        <form id="editForm" name="addForm">

                            <label style="color: #000;font-weight: 400;font-size: 19px;">Komentar</label>
                            <div class="form-group"><div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-star"></i></span>
                                <textarea class="form-control" id="textarea_komentar_banding" name="textarea_komentar_banding"></textarea>
                                <input type="hidden" id="oid_banding" name="oid_banding" >
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                        <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
                        <input type="submit" class="btn btn-primary" value="Simpan" id="btn_banding"/>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="example-modal">
    <div class="modal modal-success fade" id="view_option_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="box-content">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" style="background-color: #fff!important;">
                        <div class="container-fluid">
                            <div class="row">
                                <input type="hidden" value="" id="oid_pegawai">
                                <div class="col-lg-6">
                                    <input type="submit" class="btn btn-primary btn-lg pull-right" value="Detail Transaksi" id="btn_detail_transaksi_pegawai_spesific"/>
                                </div>
                                <div class="col-lg-6">
                                    <input type="submit" class="btn btn-primary btn-lg pull-left" value="Approval" id="btn_approval_pegawai_spesific"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;text-align: -webkit-center;">
                        <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="example-modal">
    <div class="modal modal-success fade" id="revisi_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="box-content">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Komentar Revisi</h4>
                    </div>
                    <div class="modal-body" style="background-color: #fff!important;">
                        <form id="editForm" name="addForm">

                            <label style="color: #000;font-weight: 400;font-size: 19px;">Komentar</label>
                            <div class="form-group"><div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-star"></i></span>
                                <textarea class="form-control" id="textarea_komentar_revisi" name="textarea_komentar_revisi"></textarea>
                                <input type="hidden" id="oid_revisi" name="oid_revisi" >
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                        <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
                        <input type="submit" class="btn btn-primary" value="Simpan" id="btn_revisi"/>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="example-modal">
    <div class="modal modal-success fade" id="tolak_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="box-content">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Alasan Tolak Pekerjaan</h4>
                    </div>
                    <div class="modal-body" style="background-color: #fff!important;">
                        <form id="editForm" name="addForm">

                            <label style="color: #000;font-weight: 400;font-size: 19px;">Alasan</label>
                            <div class="form-group"><div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-star"></i></span>
                                <textarea class="form-control" id="textarea_alasan_tolak" name="textarea_alasan_tolak"></textarea>
                                <input type="hidden" id="oid_tolak" name="oid_tolak" >
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                        <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
                        <input type="submit" class="btn btn-primary" value="Simpan" id="btn_tolak"/>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
time_flag = 0;
$('#jam_mulai').on("change", function () {
    var reg = /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/;
    if (!reg.test($('#jam_mulai').val())) {
        alert("Mohon masukan format 24 jam");
        time_flag = 0;
        $('#jam_mulai').val('');
        $('#jam_mulai').focus();
    }
    else
    {
        time_flag = 1;
    }
});

$('#jam_selesai').on("change", function () {
    var reg = /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/;
    if (!reg.test($('#jam_selesai').val())) {
        alert("Mohon masukan format 24 jam");
        time_flag = 0;
        $('#jam_selesai').val('');
        $('#jam_selesai').focus();
    }
    else
    {
        time_flag = 1;
    }
});


$("#multi_approve").prop('checked', true);
function current_time() {
    // body...
    var d  = new Date(); // for now
    hour   = d.getHours(); // => 9
    minute = d.getMinutes(); // =>  30
    d.getSeconds(); // => 51

    output = hour+":"+minute;
    return output;
}

function approve(id) {
    var multi_approve = $("#multi_approve").is(":checked");    
    if (multi_approve == false) 
    {
        Lobibox.confirm({
            title: "Konfirmasi",
            msg: "Anda akan menyetujui pekerjaan ini ?",
            callback: function ($this, type) {
                if (type === 'yes'){
                    $.ajax({
                        url :"<?php echo site_url()?>transaksi/approve/"+id,
                        type:"post",
                        beforeSend:function(){
                            $("#td_last_belum_diperiksa_ket_"+id).html('');
                            $("#loadprosess").modal('show');
                        },
                        success:function(msg){
                            var obj = jQuery.parseJSON (msg);
                            ajax_status(obj);
                        },
                        error:function(jqXHR,exception)
                        {
                            ajax_catch(jqXHR,exception);					
                        }
                    })
                }
            }
        })
    }
    else
    {
        $.ajax({
            url :"<?php echo site_url()?>transaksi/approve/"+id,
            type:"post",
            beforeSend:function(){
                $("#tr_belum_diperiksa_"+id).css({"background-color": "yellow"});
                $("#td_last_belum_diperiksa_ket_"+id).html('');
            },
            success:function(msg){
                var obj = jQuery.parseJSON (msg);
                ajax_status(obj,'no-refresh');
                $("#tr_belum_diperiksa_"+id).css({"background-color": "green","color": "#fff"});
                // $(".skp_btn_"+id).css({"display": "none"});                                
                $("#td_last_belum_diperiksa_ket_"+id).html('Sikerja telah disetujui');
            },
            error:function(jqXHR,exception)
            {
                ajax_catch(jqXHR,exception);					
            }
        })
    }    
}

function revisi(id) {
	// body...
	$("#revisi_data").modal('show');
	$("#oid_revisi").val(id);
}

function reject(id) {
	// body...
	$("#tolak_data").modal('show');
	$("#oid_tolak").val(id);
}

function keberatan(id) {
    // body...
    $("#keberatan_data").modal('show');
    $("#oid_keberatan").val(id);
}

function banding(id) {
    // body...
    $("#banding_data").modal('show');
    $("#oid_banding").val(id);
}

function view_option(id,i,posisi) {
    // $('.teamwork').css({"backgroundColor": "", "color": "", "pointer-events" : ""});
    // $('#li_kandidat_'+i).css({"backgroundColor": "#00a65a", "color": "#000", "pointer-events" : ""});
    oid_pegawai = id;
    $.ajax({
        url :"<?php echo site_url();?>transaksi/detail_transaksi_pegawai/"+oid_pegawai+"/"+posisi,
        type:"post",
        beforeSend:function(){
            $("#loadprosess").modal('show');
            $('.table-view1').dataTable().fnDestroy();
            $(".table-view1 tbody tr").remove();
            var newrec  = '<tr">' +
                                '<td colspan="5" class="text-center">Memuat Data</td>'
                            '</tr>';
            $('.table-view1 tbody').append(newrec);       
            // $('.notif-count').html('');     
            $('.counter_atasan_notify').html('');
        },
        success:function(msg){
            var obj = jQuery.parseJSON (msg);
            if (obj.status == 1)
            {
                link_image = '';
                if (obj.data.infoPegawai[0].photo == '-') {
                    link_image = "<?php echo base_url() . 'assets/images/businessman1.jpg';?>";
                }
                else
                {
                    link_image = "<?php echo base_url();?>public/images/pegawai/"+obj.data.infoPegawai[0].photo;
                }
                $("#loadprosess").modal('hide');
                $("#lbl_eselon1").html(obj.data.infoPegawai[0].nama_eselon1);
                $("#lbl_eselon2").html(obj.data.infoPegawai[0].nama_eselon2);
                $("#lbl_eselon3").html(obj.data.infoPegawai[0].nama_eselon3);
                $("#lbl_eselon4").html(obj.data.infoPegawai[0].nama_eselon4);
                $("#lbl_nama").html(obj.data.infoPegawai[0].nama_pegawai);
                $("#lbl_nip").html(obj.data.infoPegawai[0].nip);
                $("#lbl_image").html('<img style="width: 160px;height: 160px;" src="'+link_image+'">');

				$(".table-view1 tbody tr").remove();               
                if (obj.data.tr_belum_diperiksa != 0)
                {
                    $("#counter_atasan_proses").html(obj.data.tr_belum_diperiksa.length);                    
                    for (var i = 0; i < obj.data.tr_belum_diperiksa.length; i++)
                    {
                        kegiatan = '';
                        if (obj.data.tr_belum_diperiksa[i].kegiatan_skp_jft == null && obj.data.tr_belum_diperiksa[i].kegiatan_skp_jfu == null && obj.data.tr_belum_diperiksa[i].kegiatan_skp == null) {
                            kegiatan = obj.data.tr_belum_diperiksa[i].uraian_tugas;                            
                        }
                        else
                        {
                            if (obj.data.infoPegawai[0].kat_posisi == 1) {
                                kegiatan = obj.data.tr_belum_diperiksa[i].kegiatan_skp;
                            }
                            else if (obj.data.infoPegawai[0].kat_posisi == 2) {
                                kegiatan = obj.data.tr_belum_diperiksa[i].kegiatan_skp_jft;
                            }                        
                            else if (obj.data.infoPegawai[0].kat_posisi == 4) {
                                kegiatan = obj.data.tr_belum_diperiksa[i].kegiatan_skp_jfu;
                            }
                        }

                        param_history_time = '';
                        if (obj.data.tr_belum_diperiksa[i].lasttime == 0) {
                            param_history_time = 'Hari ini.'
                        }
                        else
                        {
                            param_history_time = obj.data.tr_belum_diperiksa[i].lasttime+' Hari Yang Lalu';
                        }                        


                        row_data = "<tr id='tr_belum_diperiksa_"+obj.data.tr_belum_diperiksa[i].id_pekerjaan+"'>"+
                                    "<td>"+param_history_time+"</td>"+
                                    "<td>"+obj.data.tr_belum_diperiksa[i].tanggal_mulai+"&nbsp;"+obj.data.tr_belum_diperiksa[i].jam_mulai+"</td>"+
                                    "<td>"+obj.data.tr_belum_diperiksa[i].tanggal_selesai+"&nbsp;"+obj.data.tr_belum_diperiksa[i].jam_selesai+"</td>"+
                                    "<td>"+kegiatan+"</td>"+
                                    "<td>"+obj.data.tr_belum_diperiksa[i].realisasi_skp+"</td>"+
                                    "<td>"+obj.data.tr_belum_diperiksa[i].target_skp+"</td>"+
                                    "<td>"+obj.data.tr_belum_diperiksa[i].nama_pekerjaan+"</td>"+
                                    "<td>"+obj.data.tr_belum_diperiksa[i].frekuensi_realisasi+"&nbsp;"+obj.data.tr_belum_diperiksa[i].target_output_name+"</td>"+
                                    // "<td></td>"+
                                    "<td><a class='btn btn-success btn-xs' target='_blank' href='https://sikerja.kemendagri.go.id/public/file_pendukung/"+obj.data.infoPegawai[0].nip+"/"+obj.data.tr_belum_diperiksa[i].file_pendukung+"'><i class='fa fa-download'></i>&nbsp;Unduh</a></td>"+
                                    "<td id='td_last_belum_diperiksa_ket_"+obj.data.tr_belum_diperiksa[i].id_pekerjaan+"'>"+
                                        "<div class='col-lg-12' style='padding-bottom: 10px;'><a class='btn btn-success btn-xs' onclick='approve("+obj.data.tr_belum_diperiksa[i].id_pekerjaan+")'><i class='fa fa-check'></i>&nbsp;Setuju</a></div><br>"+
                                        // "<div class='col-lg-12' style='padding-bottom: 10px;'><a class='btn btn-warning btn-xs' onclick='revisi("+obj.data.tr_belum_diperiksa[i].id_pekerjaan+")'><i class='fa fa-edit'></i>&nbsp;Revisi</a></div><br>"+
                                        "<div class='col-lg-12' style='padding-bottom: 10px;'><a class='btn btn-danger btn-xs' onclick='reject("+obj.data.tr_belum_diperiksa[i].id_pekerjaan+")'><i class='fa fa-close'></i>&nbsp;Tolak</a></div><br>"+
                                    "</td>"+
                                    "</tr>";
                        $('#table_belum_diperiksa_atasan tbody').append(row_data);
                    }
                }

                if (obj.data.tr_revisi != 0)
                {
                    $("#counter_atasan_revisi").html(obj.data.tr_revisi.length);                    
                    for (var i = 0; i < obj.data.tr_revisi.length; i++)
                    {
                        kegiatan = '';
                        if (obj.data.tr_revisi[i].kegiatan_skp_jft == null && obj.data.tr_revisi[i].kegiatan_skp_jfu == null && obj.data.tr_revisi[i].kegiatan_skp == null) {
                            kegiatan = obj.data.tr_revisi[i].uraian_tugas;                            
                        }
                        else
                        {
                            if (obj.data.infoPegawai[0].kat_posisi == 1) {
                                kegiatan = obj.data.tr_revisi[i].kegiatan_skp;
                            }
                            else if (obj.data.infoPegawai[0].kat_posisi == 2) {
                                kegiatan = obj.data.tr_revisi[i].kegiatan_skp_jft;
                            }                        
                            else if (obj.data.infoPegawai[0].kat_posisi == 4) {
                                kegiatan = obj.data.tr_revisi[i].kegiatan_skp_jfu;
                            }
                        }
                        row_data = "<tr>"+
                        "<td>"+obj.data.tr_revisi[i].tanggal_mulai+"&nbsp;"+obj.data.tr_revisi[i].jam_mulai+"</td>"+
                        "<td>"+obj.data.tr_revisi[i].tanggal_selesai+"&nbsp;"+obj.data.tr_revisi[i].jam_selesai+"</td>"+
                        "<td>"+kegiatan+"</td>"+
                        "<td>"+obj.data.tr_revisi[i].frekuensi_realisasi+"&nbsp;"+obj.data.tr_revisi[i].target_output_name+"</td>"+
                        "<td>"+obj.data.tr_revisi[i].nama_pekerjaan+"</td>"+
                        "<td><a class='btn btn-success btn-xs' href='<?php echo base_url() . 'public/file_pendukung/';?>"+obj.data.tr_revisi[i].file_pendukung+"'><i class='fa fa-download'></i>&nbsp;Unduh</a></td>"+
                        "<td>"+obj.data.tr_revisi[i].komentar_pemeriksa+"</td>"+
                        "</tr>";
                        $('#table_revisi_atasan tbody').append(row_data);
                    }
                }

                if (obj.data.tr_disetujui != 0)
                {
                    $("#counter_atasan_disetujui").html(obj.data.tr_disetujui.length);                    
                    for (var i = 0; i < obj.data.tr_disetujui.length; i++)
                    {
                        kegiatan = '';
                        if (obj.data.tr_disetujui[i].kegiatan_skp_jft == null && obj.data.tr_disetujui[i].kegiatan_skp_jfu == null && obj.data.tr_disetujui[i].kegiatan_skp == null) 
                        {
                            kegiatan = obj.data.tr_disetujui[i].uraian_tugas;                            
                        }
                        else
                        {
                            if (obj.data.infoPegawai[0].kat_posisi == 1) {
                                kegiatan = obj.data.tr_disetujui[i].kegiatan_skp;
                            }
                            else if (obj.data.infoPegawai[0].kat_posisi == 2) {
                                kegiatan = obj.data.tr_disetujui[i].kegiatan_skp_jft;
                            }                        
                            else if (obj.data.infoPegawai[0].kat_posisi == 4) {
                                kegiatan = obj.data.tr_disetujui[i].kegiatan_skp_jfu;
                            }
                        }

                        // param_history_time = '';
                        // if (obj.data.tr_disetujui[i].lasttime == 0) {
                        //     param_history_time = 'Hari ini.'
                        // }
                        // else
                        // {
                        //     param_history_time = obj.data.tr_disetujui[i].lasttime+' Hari Yang Lalu';
                        // }
                        row_data = "<tr>"+
                        // "<td>"+param_history_time+"</td>"+                        
                        "<td>"+obj.data.tr_disetujui[i].tanggal_mulai+"&nbsp;"+obj.data.tr_disetujui[i].jam_mulai+"</td>"+
                        "<td>"+obj.data.tr_disetujui[i].tanggal_selesai+"&nbsp;"+obj.data.tr_disetujui[i].jam_selesai+"</td>"+
                        "<td>"+kegiatan+"</td>"+
                        "<td>"+obj.data.tr_disetujui[i].nama_pekerjaan+"</td>"+
                        "<td>"+obj.data.tr_disetujui[i].frekuensi_realisasi+"&nbsp;"+obj.data.tr_disetujui[i].target_output_name+"</td>"+
                        "<td>"+obj.data.tr_disetujui[i].target_skp+"</td>"+
                        "<td><a class='btn btn-success btn-xs' href='<?php echo base_url() . 'public/file_pendukung/';?>"+obj.data.tr_disetujui[i].file_pendukung+"'><i class='fa fa-download'></i>&nbsp;Unduh</a></td>"+
                        "<td>"+obj.data.tr_disetujui[i].menit_efektif+"</td>"+
                        "</tr>";
                        $('#table_disetujui_atasan tbody').append(row_data);
                    }
                }

                if (obj.data.tr_tolak != 0)
                {
                    $("#counter_atasan_tolak").html(obj.data.tr_tolak.length);                    
                      
                    for (var i = 0; i < obj.data.tr_tolak.length; i++)
                    {
                        kegiatan = '';
                        if (obj.data.tr_tolak[i].kegiatan_skp_jft == null && obj.data.tr_tolak[i].kegiatan_skp_jfu == null && obj.data.tr_tolak[i].kegiatan_skp == null) {
                            kegiatan = obj.data.tr_tolak[i].uraian_tugas;                            
                        }
                        else
                        {
                            if (obj.data.infoPegawai[0].kat_posisi == 1) {
                                kegiatan = obj.data.tr_tolak[i].kegiatan_skp;
                            }
                            else if (obj.data.infoPegawai[0].kat_posisi == 2) {
                                kegiatan = obj.data.tr_tolak[i].kegiatan_skp_jft;
                            }                        
                            else if (obj.data.infoPegawai[0].kat_posisi == 4) {
                                kegiatan = obj.data.tr_tolak[i].kegiatan_skp_jfu;
                            }
                        }
                        row_data = "<tr>"+
                        "<td>"+obj.data.tr_tolak[i].tanggal_selesai+"&nbsp;"+obj.data.tr_tolak[i].jam_selesai+"</td>"+
                        "<td>"+obj.data.tr_tolak[i].tanggal_mulai+"&nbsp;"+obj.data.tr_tolak[i].jam_mulai+"</td>"+
                        "<td>"+kegiatan+"</td>"+
                        "<td>"+obj.data.tr_tolak[i].nama_pekerjaan+"</td>"+
                        "<td>"+obj.data.tr_tolak[i].frekuensi_realisasi+"&nbsp;"+obj.data.tr_tolak[i].target_output_name+"</td>"+
                        // "<td><a class='btn btn-success btn-xs' href='<?php echo base_url() . 'public/file_pendukung/';?>"+obj.data.tr_tolak[i].tr_tolak+"'><i class='fa fa-download'></i>&nbsp;Unduh</a></td>"+
                        "<td></td>"+
                        "<td>"+obj.data.tr_tolak[i].komentar_pemeriksa+"</td>"+
                        "<td>"+obj.data.tr_tolak[i].alasan_ditolak+"</td>"+                        
                        "</tr>";
                        $('#table_ditolak_atasan tbody').append(row_data);
                    }
                }

                if (obj.data.tr_keberatan != 0)
                {
                    $("#counter_atasan_keberatan").html(obj.data.tr_keberatan.length);                      
                    for (var i = 0; i < obj.data.tr_keberatan.length; i++)
                    {
                        kegiatan = '';
                        if (obj.data.tr_keberatan[i].kegiatan_skp_jft == null && obj.data.tr_keberatan[i].kegiatan_skp_jfu == null && obj.data.tr_keberatan[i].kegiatan_skp == null) 
                        {
                            kegiatan = obj.data.tr_keberatan[i].uraian_tugas;                            
                        }
                        else
                        {
                            if (obj.data.infoPegawai[0].kat_posisi == 1) {
                                kegiatan = obj.data.tr_keberatan[i].kegiatan_skp;
                            }
                            else if (obj.data.infoPegawai[0].kat_posisi == 2) {
                                kegiatan = obj.data.tr_keberatan[i].kegiatan_skp_jft;
                            }                        
                            else if (obj.data.infoPegawai[0].kat_posisi == 4) {
                                kegiatan = obj.data.tr_keberatan[i].kegiatan_skp_jfu;
                            }
                        }
                        row_data = "<tr>"+
                        "<td>"+obj.data.tr_keberatan[i].tanggal_selesai+"&nbsp;"+obj.data.tr_keberatan[i].jam_selesai+"</td>"+
                        "<td>"+obj.data.tr_keberatan[i].tanggal_mulai+"&nbsp;"+obj.data.tr_keberatan[i].jam_mulai+"</td>"+
                        "<td>"+kegiatan+"</td>"+
                        "<td>"+obj.data.tr_keberatan[i].nama_pekerjaan+"</td>"+
                        "<td>"+obj.data.tr_keberatan[i].frekuensi_realisasi+"&nbsp;"+obj.data.tr_keberatan[i].target_output_name+"</td>"+
                        "<td><a class='btn btn-success btn-xs' href='<?php echo base_url() . 'public/file_pendukung/';?>"+obj.data.tr_keberatan[i].tr_tolak+"'><i class='fa fa-download'></i>&nbsp;Unduh</a></td>"+
                        "<td>"+obj.data.tr_keberatan[i].komentar_pemeriksa+"</td>"+
                        "<td>"+obj.data.tr_keberatan[i].alasan_ditolak+"</td>"+
                        "<td>"+obj.data.tr_keberatan[i].komentar_keberatan+"</td>"+
                        "<td>"+
                        "<div class='col-lg-12' style='padding-bottom: 10px;'><a class='btn btn-success btn-xs' onclick='approve("+obj.data.tr_keberatan[i].id_pekerjaan+")'><i class='fa fa-check'></i>&nbsp;Setuju</a></div><br>"+
                        "<div class='col-lg-12' style='padding-bottom: 10px;'><a class='btn btn-danger btn-xs' onclick='reject_keberatan("+obj.data.tr_keberatan[i].id_pekerjaan+")'><i class='fa fa-close'></i>&nbsp;Tolak</a></div><br>"+
                        "</td>"+
                        "</tr>";
                        $('#table_keberatan_atasan tbody').append(row_data);
                    }
                }

                if (obj.data.tr_keberatan_ditolak != 0)
                {
                    $("#counter_atasan_keberatan_ditolak").html(obj.data.tr_keberatan_ditolak.length);                      
                    for (var i = 0; i < obj.data.tr_keberatan_ditolak.length; i++)
                    {
                        kegiatan = '';
                        if (obj.data.tr_keberatan_ditolak[i].kegiatan_skp_jft == null && obj.data.tr_keberatan_ditolak[i].kegiatan_skp_jfu == null && obj.data.tr_keberatan_ditolak[i].kegiatan_skp == null) {
                            kegiatan = obj.data.tr_keberatan_ditolak[i].uraian_tugas;                            
                        }
                        else
                        {
                            if (obj.data.infoPegawai[0].kat_posisi == 1) {
                                kegiatan = obj.data.tr_keberatan_ditolak[i].kegiatan_skp;
                            }
                            else if (obj.data.infoPegawai[0].kat_posisi == 2) {
                                kegiatan = obj.data.tr_keberatan_ditolak[i].kegiatan_skp_jft;
                            }                        
                            else if (obj.data.infoPegawai[0].kat_posisi == 4) {
                                kegiatan = obj.data.tr_keberatan_ditolak[i].kegiatan_skp_jfu;
                            }
                        }
                        row_data = "<tr>"+
                        "<td>"+obj.data.tr_keberatan_ditolak[i].tanggal_selesai+"&nbsp;"+obj.data.tr_keberatan_ditolak[i].jam_selesai+"</td>"+
                        "<td>"+obj.data.tr_keberatan_ditolak[i].tanggal_mulai+"&nbsp;"+obj.data.tr_keberatan_ditolak[i].jam_mulai+"</td>"+
                        "<td>"+kegiatan+"</td>"+
                        "<td>"+obj.data.tr_keberatan_ditolak[i].nama_pekerjaan+"</td>"+
                        "<td>"+obj.data.tr_keberatan_ditolak[i].frekuensi_realisasi+"&nbsp;"+obj.data.tr_keberatan_ditolak[i].target_output_name+"</td>"+
                        "<td><a class='btn btn-success btn-xs' href='<?php echo base_url() . 'public/file_pendukung/';?>"+obj.data.tr_keberatan_ditolak[i].tr_tolak+"'><i class='fa fa-download'></i>&nbsp;Unduh</a></td>"+
                        "<td>"+obj.data.tr_keberatan_ditolak[i].komentar_pemeriksa+"</td>"+
                        "<td>"+obj.data.tr_keberatan_ditolak[i].alasan_ditolak+"</td>"+
                        "<td>"+obj.data.tr_keberatan_ditolak[i].komentar_keberatan+"</td>"+
                        "<td>"+obj.data.tr_keberatan_ditolak[i].komentar_tolak_keberatan+"</td>"+                        
                        "</tr>";
                        $('#table_keberatan_ditolak_atasan tbody').append(row_data);
                    }
                }

                if (obj.data.tr_banding != 0)
                {
                    $("#counter_atasan_banding").html(obj.data.tr_banding.length);                      
                    for (var i = 0; i < obj.data.tr_banding.length; i++)
                    {
                        kegiatan = '';
                        if (obj.data.tr_banding[i].kegiatan_skp_jft == null && obj.data.tr_banding[i].kegiatan_skp_jfu == null && obj.data.tr_banding[i].kegiatan_skp == null) {
                            kegiatan = obj.data.tr_banding[i].uraian_tugas;                            
                        }
                        else
                        {
                            if (obj.data.infoPegawai[0].kat_posisi == 1) {
                                kegiatan = obj.data.tr_banding[i].kegiatan_skp;
                            }
                            else if (obj.data.infoPegawai[0].kat_posisi == 2) {
                                kegiatan = obj.data.tr_banding[i].kegiatan_skp_jft;
                            }                        
                            else if (obj.data.infoPegawai[0].kat_posisi == 4) {
                                kegiatan = obj.data.tr_banding[i].kegiatan_skp_jfu;
                            }
                        }
                        row_data = "<tr>"+
                        "<td>"+obj.data.tr_banding[i].tanggal_mulai+"&nbsp;"+" Sampai "+obj.data.tr_banding[i].tanggal_selesai+"&nbsp;"+"</td>"+
                        "<td>"+kegiatan+"</td>"+
                        "<td>"+obj.data.tr_banding[i].nama_pekerjaan+"</td>"+
                        "<td>"+obj.data.tr_banding[i].frekuensi_realisasi+"&nbsp;"+obj.data.tr_banding[i].target_output_name+"</td>"+
                        "<td><a class='btn btn-success btn-xs' href='<?php echo base_url() . 'public/file_pendukung/';?>"+obj.data.tr_banding[i].tr_tolak+"'><i class='fa fa-download'></i>&nbsp;Unduh</a></td>"+
                        "<td>"+obj.data.tr_banding[i].alasan_ditolak+"</td>"+
                        "<td>"+obj.data.tr_banding[i].komentar_keberatan+"</td>"+
                        "<td>"+obj.data.tr_banding[i].komentar_tolak_keberatan+"</td>"+
                        "<td>"+obj.data.tr_banding[i].komentar_banding+"</td>"+
                        "<td></td>"+                                                                        
                        "</tr>";    
                        $('#table_banding_atasan tbody').append(row_data);
                    }
                }

                if (obj.data.tr_banding_ditolak != 0)
                {
                    $("#counter_atasan_banding_ditolak").html(obj.data.tr_banding_ditolak.length);                      
                    for (var i = 0; i < obj.data.tr_banding_ditolak.length; i++)
                    {
                        kegiatan = '';
                        if (obj.data.tr_banding_ditolak[i].kegiatan_skp_jft == null && obj.data.tr_banding_ditolak[i].kegiatan_skp_jfu == null && obj.data.tr_banding_ditolak[i].kegiatan_skp == null) {
                            kegiatan = obj.data.tr_banding_ditolak[i].uraian_tugas;                            
                        }
                        else
                        {
                            if (obj.data.infoPegawai[0].kat_posisi == 1) {
                                kegiatan = obj.data.tr_banding_ditolak[i].kegiatan_skp;
                            }
                            else if (obj.data.infoPegawai[0].kat_posisi == 2) {
                                kegiatan = obj.data.tr_banding_ditolak[i].kegiatan_skp_jft;
                            }                        
                            else if (obj.data.infoPegawai[0].kat_posisi == 4) {
                                kegiatan = obj.data.tr_banding_ditolak[i].kegiatan_skp_jfu;
                            }
                        }
                        row_data = "<tr>"+
                        "<td>"+obj.data.tr_banding_ditolak[i].tanggal_mulai+"&nbsp;"+" Sampai "+obj.data.tr_banding_ditolak[i].tanggal_selesai+"&nbsp;"+"</td>"+
                        "<td>"+kegiatan+"</td>"+
                        "<td>"+obj.data.tr_banding_ditolak[i].nama_pekerjaan+"</td>"+
                        "<td>"+obj.data.tr_banding_ditolak[i].frekuensi_realisasi+"&nbsp;"+obj.data.tr_banding_ditolak[i].target_output_name+"</td>"+
                        "<td><a class='btn btn-success btn-xs' href='<?php echo base_url() . 'public/file_pendukung/';?>"+obj.data.tr_banding_ditolak[i].tr_tolak+"'><i class='fa fa-download'></i>&nbsp;Unduh</a></td>"+
                        "<td>"+obj.data.tr_banding_ditolak[i].alasan_ditolak+"</td>"+
                        "<td>"+obj.data.tr_banding_ditolak[i].komentar_keberatan+"</td>"+
                        "<td>"+obj.data.tr_banding_ditolak[i].komentar_tolak_keberatan+"</td>"+
                        "<td>"+obj.data.tr_banding_ditolak[i].komentar_banding+"</td>"+
                        "<td></td>"+                                                                        
                        "</tr>";    
                        $('#table_banding_ditolak_atasan tbody').append(row_data);
                    }
                }                                                          


                $("#view_bawahan").css({"display": ""})
                $("#view_main").css({"display": "none"})
            }
            else
            {
                Lobibox.notify('warning', {
                    msg: obj.text
                    });
                setTimeout(function(){
                    $("#loadprosess").modal('hide');
                }, 500);
            }
        },
        error:function(jqXHR,exception)
        {
            ajax_catch(jqXHR,exception);					
        }
    })
}

function del(id) {
    // body...
    Lobibox.confirm({
        title: "Konfirmasi",
        msg: "Anda yakin akan menghapus data ini ?",
        callback: function ($this, type) {
            if (type === 'yes'){
                $.ajax({
                    url :"<?php echo site_url()?>transaksi/get_delele_transaksi/"+id,
                    type:"post",
                    beforeSend:function(){
                        $("#loadprosess").modal('show');
                    },					
					success:function(msg){
						var obj = jQuery.parseJSON (msg);
						ajax_status(obj);
					},
					error:function(jqXHR,exception)
					{
						ajax_catch(jqXHR,exception);					
					}
                })
            }
        }
    })
}

function send_data_revisi(data_sender,param) {
    // body...
    var multi_approve = $("#multi_approve").is(":checked");
    if (multi_approve == false) {
        $.ajax({
            url :"<?php echo site_url();?>transaksi/revisi/"+param,
            type:"post",
            data:{data_sender : data_sender},
            beforeSend:function(){
                $("#loadprosess").modal('show');
            },					
            success:function(msg){
                var obj = jQuery.parseJSON (msg);
                ajax_status(obj);
            },
            error:function(jqXHR,exception)
            {
                ajax_catch(jqXHR,exception);					
            }
        })        
    }
    else
    {
        $.ajax({
            url :"<?php echo site_url();?>transaksi/revisi/"+param,
            type:"post",
            data:{data_sender : data_sender},
            beforeSend:function(){
                $("#revisi_data").modal('hide');                
                $("#tr_belum_diperiksa_"+data_sender['id_pekerjaan']).css({"background-color": "yellow"});                        
            },
            success:function(msg){
                var obj = jQuery.parseJSON (msg);
                ajax_status(obj,'no-refresh');
                $("#tr_belum_diperiksa_"+data_sender['id_pekerjaan']).css({"background-color": "#FF9800","color": "#fff"});
                // $(".skp_btn_"+id).css({"display": "none"});                                
                $("#td_last_belum_diperiksa_ket_"+data_sender['id_pekerjaan']).html('Sikerja perlu revisi');
            },
            error:function(jqXHR,exception)
            {
                ajax_catch(jqXHR,exception);					
            }
        })
    }    
}

function send_data_tambah_without_file(data_sender) {
    $.ajax({
        url :"<?php echo site_url();?>transaksi/add_pekerjaan_without_file/",
        type:"post",
        data:{data_sender : data_sender},
        beforeSend:function(){
            $("#loadprosess").modal('show');
        },					
        success:function(msg){
            var obj = jQuery.parseJSON (msg);
            ajax_status(obj,'no-refresh');
            if (obj.status == 1)
            {
                $("#tab_sikerja").removeClass("active");
                $("#menu4").removeClass("fade in active");                
                $("#tab_belum_diperiksa").addClass("active");
                $("#home").addClass("fade in active");    
                $.ajax({
                    url :"<?php echo site_url();?>transaksi/refresh_data/0/counter_proses",
                    type:"post",
                    beforeSend:function(){
                        $(".form-control").val('');
                        $("#hdn_param_out_skp").val('');
                        $("#hdn_param_qty_skp").val('');
                        $("#hdn_param_realisasi_qty_skp").val('');
                        $("#param_qty_skp").html("Target Kuantitas SKP : ");
                        $("#param_realisasi_qty_skp").html("Realisasi :  ");                        
                        $("#loadprosess").modal('show');                        
                        $("#table_belum_diperiksa tbody").html('');                        
                    },
                    success:function(msg){
                        $("#table_belum_diperiksa tbody").html(msg);
                        $("#loadprosess").modal('hide');                        
                    },
                    error:function(jqXHR,exception)
                    {
                        ajax_catch(jqXHR,exception);					
                    }
                })                                                                            
            } 
        },
        error:function(jqXHR,exception)
        {
            ajax_catch(jqXHR,exception);					
        }
    })    
}

function send_data_tambah(data_sender) {
    file_pendukung = $('#file_pendukung').prop('files')[0];
    var form_data  = new FormData();
    form_data.append('file', file_pendukung);
    $.ajax({
        url: '<?php echo site_url();?>transaksi/upload_file_pendukung/', // point to server-side PHP script
        // dataType: 'json',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        beforeSend:function(){
            $("#loadprosess").modal('show');
            Lobibox.notify('info', {
                msg: 'Menyiapkan data untuk upload file'
            });
        },
        success: function(msg1){
            var obj1 = jQuery.parseJSON (msg1);
            console.log(obj1.status);
            if(obj1.status == 1)
            {
                data_sender['file_pendukung'] = obj1.filename;
                send_data_tambah_without_file(data_sender);
            }
        },
        error:function(jqXHR,exception)
        {
            ajax_catch(jqXHR,exception);					
        }
    });
}

function send_data_tolak(data_sender,param) {
    // body...
    var multi_approve = $("#multi_approve").is(":checked");    
    if (multi_approve == false) 
    {    
        $.ajax({
            url :"<?php echo site_url();?>transaksi/tolak/"+param,
            type:"post",
            data:{data_sender : data_sender},
            beforeSend:function(){
                $("#loadprosess").modal('show');
            },
            success:function(msg){
                var obj = jQuery.parseJSON (msg);
                ajax_status(obj);
            },
            error:function(jqXHR,exception)
            {
                ajax_catch(jqXHR,exception);					
            }
        })        
    }
    else
    {
        $.ajax({
            url :"<?php echo site_url();?>transaksi/tolak/"+param,
            type:"post",
            data:{data_sender : data_sender},
            beforeSend:function(){
                $("#tolak_data").modal('hide');                
                $("#tr_belum_diperiksa_"+data_sender['id_pekerjaan']).css({"background-color": "yellow"});                        
            },
            success:function(msg){
                var obj = jQuery.parseJSON (msg);
                ajax_status(obj,'no-refresh');
                $("#tr_belum_diperiksa_"+data_sender['id_pekerjaan']).css({"background-color": "red","color": "#fff"});
                // $(".skp_btn_"+id).css({"display": "none"});                                
                $("#td_last_belum_diperiksa_ket_"+data_sender['id_pekerjaan']).html('Sikerja ditolak');
            },
            error:function(jqXHR,exception)
            {
                ajax_catch(jqXHR,exception);					
            }
        })
    }
}

function reject_keberatan(id) {
    // body...
    $("#tolak_data_keberatan").modal('show');
    $("#oid_tolak_keberatan ").val(id);
}

$(document).ready(function()
{
    trigger_msg = $("#trigger_msg").val();
    if (trigger_msg == 1)
    {
        Lobibox.notify('warning', {
            msg: 'Untuk sementara, transaksi sikerja dihentikan oleh sistem. Mohon informasikan ke Badan Pengembangan karir untuk penanganan lebih lanjut.'
            });
    }

    counter_proses = "<?php
                            if ($tr_belum_diperiksa != 0)
                            {
                                echo count($tr_belum_diperiksa);
                            }
                            else
                            {
                                echo "0";
                            }
                        ?>";
    counter_revisi = "<?php
                            if ($tr_revisi != 0)
                            {
                                echo count($tr_revisi);
                            }
                            else
                            {
                                echo "0";
                            }
                        ?>";
    counter_disetujui = "<?php
                            if ($tr_disetujui != 0)
                            {
                                echo count($tr_disetujui);
                            }
                            else
                            {
                                echo "0";
                            }
                        ?>";
    counter_tolak = "<?php
                            if ($tr_tolak != 0)
                            {
                                echo count($tr_tolak);
                            }
                            else
                            {
                                echo "0";
                            }
                        ?>";
    counter_keberatan = "<?php
                            if ($tr_keberatan != 0)
                            {
                                echo count($tr_keberatan);
                            }
                            else
                            {
                                echo "0";
                            }
                        ?>";
    counter_keberatan_ditolak = "<?php
                            if ($tr_keberatan_ditolak != 0)
                            {
                                echo count($tr_keberatan_ditolak);
                            }
                            else
                            {
                                echo "0";
                            }
                        ?>";
    counter_banding = "<?php
                            if ($tr_banding != 0)
                            {
                                echo count($tr_banding);
                            }
                            else
                            {
                                echo "0";
                            }
                        ?>";
    counter_banding_ditolak = "<?php
                            if ($tr_banding_ditolak != 0)
                            {
                                echo count($tr_banding_ditolak);
                            }
                            else
                            {
                                echo "0";
                            }
                        ?>";


    $('#counter_proses').html(counter_proses);
    $('#counter_revisi').html(counter_revisi);
    $('#counter_disetujui').html(counter_disetujui);
    $('#counter_tolak').html(counter_tolak);
    $('#counter_keberatan').html(counter_keberatan);
    $('#counter_keberatan_ditolak').html(counter_keberatan_ditolak);
    $('#counter_banding').html(counter_banding);
    $('#counter_banding_ditolak').html(counter_banding_ditolak);
    if (counter_proses            == 0)$("#counter_proses_head").css("display","none");
    if (counter_revisi            == 0)$("#counter_revisi_head").css("display","none");
    if (counter_disetujui         == 0)$("#counter_disetujui_head").css("display","none");
    if (counter_tolak             == 0)$("#counter_tolak_head").css("display","none");
    if (counter_keberatan         == 0)$("#counter_keberatan_head").css("display","none");
    if (counter_keberatan_ditolak == 0)$("#counter_keberatan_ditolak_head").css("display","none");
    if (counter_banding           == 0)$("#counter_banding").css("display","none");
    if (counter_banding_ditolak   == 0)$("#counter_banding_ditolak").css("display","none");

    $("[data-mask]").inputmask();

    $("#btn-backtomain").click(function(){
        $("#loadprosess").modal('show');        
        $("#view_bawahan").css({"display": "none"})
        $("#view_main").css({"display": ""})        
        $("#loadprosess").modal('hide');        
    })

    $("#urtug").change(function(){
        var urtug = $("#urtug option:selected").text();
        var str = new String(urtug);
        var n = str.indexOf("perjalanan dinas");
        var n1 = str.indexOf("Perjalanan Dinas");

        // if (n > 0 || n1 > 0) {
        //     // console.log("lock");
        //     $(".timemasking").prop('disabled', true);
        //     $(".timemasking").val('08:00:00');
        //     $("#flag_urtug").val('perjalanan_dinas');
        // }
        // else {
        //     // console.log("unlock");
        //     $(".timemasking").prop('disabled', false);
        //     $(".timemasking").val('');
        //     $("#flag_urtug").val('-');
        // }

        var id = $("#urtug").val();
        $.ajax({
            url :"<?php echo site_url()?>transaksi/get_detail_skp",
            type:"post",
            data:"id="+id,
            beforeSend:function(){
                $("#loadprosess").modal('show');
            },
            success:function(msg){
                if (msg != 0)
                {
                    var obj = jQuery.parseJSON (msg);
                    realisasi_qty = obj.realisasi_kuantitas;
                    $("#hdn_param_out_skp").val(obj.target_output_name);
                    $("#hdn_param_qty_skp").val(obj.target_qty);
                    $("#hdn_param_realisasi_qty_skp").val(obj.realisasi_qty);
                    $("#param_qty_skp").html("Target Kuantitas SKP : "+obj.target_qty+" "+obj.target_output_name);
                    $("#param_realisasi_qty_skp").html("Realisasi :  "+realisasi_qty+" "+obj.target_output_name);
                }
                else
                {
                    $("#hdn_param_out_skp").val('');
                    $("#hdn_param_qty_skp").val('');
                    $("#hdn_param_realisasi_qty_skp").val('');
                    $("#param_qty_skp").html("Target Kuantitas SKP : ");
                    $("#param_realisasi_qty_skp").html("Realisasi :  ");
                }
                $("#loadprosess").modal('hide');
            }
        })
    })

    $("#btn_save").click(function()
    {
        flag_urtug         = $("#flag_urtug").val();

        urtug              = $("#urtug").val();
        tgl_mulai          = change_format_date($("#tgl_mulai").val(),'yyyy-mm-dd');
        tgl_selesai        = change_format_date($("#tgl_selesai").val(),'yyyy-mm-dd');

        tgl_mulai_raw      = $("#tgl_mulai").val();
        tgl_selesai_raw    = $("#tgl_selesai").val();

        jam_mulai          = $("#jam_mulai").val();
        jam_selesai        = $("#jam_selesai").val();
        tgl_server         = current_date();
        ket_pekerjaan      = $("#ket_pekerjaan").val();
        kuantitas          = $("#kuantitas").val();
        file_pendukung     = $('#file_pendukung').prop('files')[0];
        // file_pendukung     = $('#file_pendukung')[0].files[0];
        
        waktu_mulai        = tgl_mulai+" "+jam_mulai;
        waktu_selesai      = tgl_selesai+" "+jam_selesai;

        start_actual_time  = new Date(waktu_mulai);
        end_actual_time    = new Date(waktu_selesai);
        server_actual_time = new Date();
        diff               = end_actual_time - start_actual_time;
        // diff_date          = (new Date(tgl_selesai)) - (new Date(tgl_mulai));

        // hari_efektif       = ((diff_date/1000) / 86400);
        // menit_efektif      = diff / 60000;

        flag_param_out_skp = '';
        param_out_skp      = $("#hdn_param_out_skp").val();

        realisasi_qty      = $("#hdn_param_realisasi_qty_skp").val();
        total_qty          = +realisasi_qty + +kuantitas;
        target_qty         = $("#hdn_param_qty_skp").val();

        if (kuantitas == 0)
        {
            kuantitas = 0;
        }

        // if (file_pendukung == undefined)
        // {
        //     file_pendukung = null;
        // }
        
        var data_sender = {
                                'urtug'             : urtug,
                                'flag_urtug'        : flag_urtug,
                                // 'tgl_mulai'         : tgl_mulai,
                                // 'tgl_selesai'       : tgl_selesai,
                                'tgl_mulai_raw'     : tgl_mulai_raw,
                                'tgl_selesai_raw'   : tgl_selesai_raw,
                                'jam_mulai'         : jam_mulai,
                                'jam_selesai'       : jam_selesai,
                                'ket_pekerjaan'     : ket_pekerjaan,
                                'kuantitas'         : kuantitas,
                                // 'file_pendukung'    : file_pendukung
                                // 'menit_efektif'     : menit_efektif,
                                // 'hari_efektif'      : hari_efektif
                            };

        if (urtug.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Uraian Tugas kosong, mohon lengkapi data tersebut"
            });
        }
        else if (tgl_mulai.length <= 0)
        {
            time_flag = 0;            
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Tanggal mulai kosong, mohon lengkapi data tersebut"
            });
        }
        else if (tgl_selesai.length <= 0 )
        {
            time_flag = 0;            
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Tanggal selesai kosong, mohon lengkapi data tersebut"
            });
        }
        else if (jam_mulai.length <= 0)
        {
            time_flag = 0;            
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Jam mulai kosong, mohon lengkapi data tersebut"
            });
        }
        else if (jam_selesai.length <= 0)
        {
            time_flag = 0;            
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Jam selesai kosong, mohon lengkapi data tersebut"
            });
        }
        else if ( ket_pekerjaan.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Keterangan kosong, mohon lengkapi data tersebut"
            });
        }
        else
        {
            time_flag = 1;
            // console.log(start_actual_time.getFullYear());
            // if (start_actual_time.getFullYear() != server_actual_time.getFullYear() || end_actual_time.getFullYear() != server_actual_time.getFullYear())
            // {
            //     time_flag = 0;                
            //     Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            //     {
            //         msg: "Tahun harus sesuai dengan tahun berjalan."
            //     });
            // }
            // else 
            if (tgl_mulai > tgl_server || tgl_selesai > tgl_server)
            {
                time_flag = 0;                
                Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                {
                    msg: "Tanggal tidak boleh melebihi Tanggal server."
                });
            }
            else
            {
                time_flag = 1;                
                if (diff < 0)
                {
                    time_flag = 0;                    
                    Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                    {
                        msg: "Tanggal dan jam awal tidak boleh melebihi tanggal dan jam selesai."
                    });
                }
                else
                {
                    time_flag = 1;                    
                    if (end_actual_time > server_actual_time)
                    {
                        time_flag = 0;                        
                        Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                        {
                            msg: "Jam tidak boleh melebihi jam server."
                        });
                    }
                    else
                    {
                        if (total_qty > target_qty)
                        {
                            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                            {
                                msg: "Kuantitas melebihi target yang ditentukan."
                            });
                        }
                        else
                        {
                            if (time_flag == 1) 
                            {
                                if (waktu_mulai ==  waktu_selesai) {
                                    Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                                    {
                                        msg: "Tanggal dan jam awal tidak boleh sama dengan tanggal dan jam selesai."
                                    });
                                } 
                                else 
                                {
                                    if (kuantitas != 0) {
                                        if (file_pendukung != undefined)
                                        {
                                            send_data_tambah(data_sender);
                                        }
                                        else
                                        {
                                            data_sender['file_pendukung'] = null;
                                            send_data_tambah_without_file(data_sender);                                    
                                            // if (param_out_skp != 'Frekuensi')
                                            // {
                                            //     Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                                            //     {
                                            //         msg: "Wajib menyertakan file pendukung sebagai bukti realisasi"
                                            //     });                                        
                                            // }
                                            // else {
                                            //     send_data_tambah(data_sender);
                                            // }                                    
                                        }
                                    }
                                    else 
                                    {
                                        data_sender['file_pendukung'] = null;
                                        send_data_tambah_without_file(data_sender);
                                    }                                                                    
                                }
                            }
                            // console.log('kuantitas : '+kuantitas);
                            // console.log('file_pendukung : '+file_pendukung)
                        }

                    }
                }
            }
        }
    })

    $("#btn_keberatan").click(function()
    {
        var data_sender = {
                                'id_pekerjaan': $("#oid_keberatan").val(),
                                'komentar'    : $("#textarea_komentar_keberatan").val()
                            };
        if ($("#textarea_komentar_keberatan").val().length <= 0) {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Tidak bisa melanjutkan proses ini."
            });
        }
        else {
            $.ajax({
                url :"<?php echo site_url();?>transaksi/keberatan",
                type:"post",
                data:{data_sender : data_sender},
                beforeSend:function(){
                    $("#loadprosess").modal('show');
                },
                success:function(msg){
                    var obj = jQuery.parseJSON (msg);
                    ajax_status(obj);
                },
                error:function(jqXHR,exception)
                {
                    ajax_catch(jqXHR,exception);					
                }
            })
        }
    });

    $("#btn_tolak_keberatan").click(function()
    {

        var data_sender = {
                                'id_pekerjaan': $("#oid_tolak_keberatan").val(),
                                'komentar'    : $("#textarea_alasan_tolak_keberatan").val()
                        };

        if ($("#textarea_alasan_tolak_keberatan").val().length <= 0) {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                    msg: "Alasan wajib diisi."
            });
        }
        else {
            $.ajax({
                url :"<?php echo site_url();?>transaksi/tolak_keberatan",
                type:"post",
                data:{data_sender : data_sender},
                beforeSend:function(){
                    $("#loadprosess").modal('show');
                },
                success:function(msg){
                    var obj = jQuery.parseJSON (msg);
                    ajax_status(obj);
                },
                error:function(jqXHR,exception)
                {
                    ajax_catch(jqXHR,exception);					
                }
            })
        }
    });    

    $("#btn_banding").click(function()
    {
        var data_sender = {
                                'id_pekerjaan': $("#oid_banding").val(),
                                'komentar'    : $("#textarea_komentar_banding").val()
                            };
        $.ajax({
            url :"<?php echo site_url();?>transaksi/banding",
            type:"post",
            data:{data_sender : data_sender},
            beforeSend:function(){
                $("#loadprosess").modal('show');
            },
            success:function(msg){
                var obj = jQuery.parseJSON (msg);
                ajax_status(obj);
            },
            error:function(jqXHR,exception)
            {
                ajax_catch(jqXHR,exception);
            }
        })
    });

    $("#btn_revisi").click(function()
    {
        data_sender = [];
        if ($("#oid_revisi").val() == 'all-aout')
        {
            var inputs      = document.getElementsByName('counter_checkbox');
            for (var i = 0; i < inputs.length; i++) {
                checkbox_id      = $('#checkbox_'+i).is(':checked');
                if (checkbox_id != false)
                {
                    id_verify  = $('#hdn_id_'+i).val();
                    data_sender.push({
                                        'id_pekerjaan' : id_verify,
                                        'komentar'    : $("#textarea_komentar_revisi").val()
                                    });
                }
            }

            if (data_sender.length != 0)
            {
                send_data_revisi(data_sender,'all-aout');
            }
            else
            {
                Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                {
                    msg: "Tidak bisa melanjutkan proses ini, tidak ada data yang dipilih"
                });
            }
        }
        else
        {
    	    var data_sender = {
    	                            'id_pekerjaan': $("#oid_revisi").val(),
    	                            'komentar'	  : $("#textarea_komentar_revisi").val()
                            };
            send_data_revisi(data_sender,'single');
        }
    });

    $("#btn_tolak").click(function()
    {

        data_sender = [];
        if ($("#oid_tolak").val() == 'all-aout')
        {
            var inputs      = document.getElementsByName('counter_checkbox');
            for (var i = 0; i < inputs.length; i++) {
                checkbox_id      = $('#checkbox_'+i).is(':checked');
                if (checkbox_id != false)
                {
                    id_verify  = $('#hdn_id_'+i).val();
                    data_sender.push({
                                        'id_pekerjaan' : id_verify,
                                        'komentar'    : $("#textarea_alasan_tolak").val()
                                    });
                }
            }

            if (data_sender.length != 0)
            {
                send_data_tolak(data_sender,'all-aout');
            }
            else
            {
                Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                {
                    msg: "Tidak bisa melanjutkan proses ini, tidak ada data yang dipilih"
                });
            }
        }
        else
        {
            var data_sender = {
                                    'id_pekerjaan': $("#oid_tolak").val(),
                                    'komentar'    : $("#textarea_alasan_tolak").val()
                                };
            send_data_tolak(data_sender,'single');
        }
    });
});
</script>
