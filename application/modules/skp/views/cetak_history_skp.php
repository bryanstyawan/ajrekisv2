<?php
$nama_pegawai  = "";
$nama_jabatan  = "";
$nama_eselon1  = "";
$nama_eselon2  = "";
$nama_eselon3  = "";
$nama_eselon4  = "";
$nip           = "";
$kelas_jabatan = "";
$pangkat       = "";
$ruang         = "";
$tmt_pangkat  = "";
$kat_posisi    = "";
$nama_posisi_cetak  = "";

$nama_pegawai_atasan  = "";
$nama_jabatan_atasan  = "";
$nama_eselon1_atasan  = "";
$nama_eselon2_atasan  = "";
$nama_eselon3_atasan  = "";
$nama_eselon4_atasan  = "";
$nip_atasan           = "";
$kelas_jabatan_atasan = "";
$pangkat_atasan       = "";
$ruang_atasan         = "";
$tmt_pangkat_atasan  = "";

$nama_pegawai_atasan_penilai  = "";
$nama_jabatan_atasan_penilai  = "";
$nama_eselon1_atasan_penilai  = "";
$nama_eselon2_atasan_penilai  = "";
$nama_eselon3_atasan_penilai  = "";
$nama_eselon4_atasan_penilai  = "";
$nip_atasan_penilai           = "";
$kelas_jabatan_atasan_penilai = "";
$pangkat_atasan_penilai       = "";
$ruang_atasan_penilai         = "";
$tmt_pangkat_atasan_penilai  = "";

if ($infoPegawai != 0 || $infoPegawai != '') {

    # code...

    $nama_pegawai  = $infoPegawai[0]->nama_pegawai;
    $nama_jabatan  = $infoPegawai[0]->nama_jabatan;
    $nama_eselon1  = $infoPegawai[0]->nama_eselon1;
    $nama_eselon2  = $infoPegawai[0]->nama_eselon2;
    $nama_eselon3  = $infoPegawai[0]->nama_eselon3;
    $nama_eselon4  = $infoPegawai[0]->nama_eselon4;
    $nip           = $infoPegawai[0]->nip;
    $kelas_jabatan = $infoPegawai[0]->kelas_jabatan;
    $pangkat       = $infoPegawai[0]->nama_pangkat;
    $kat_posisi    = $infoPegawai[0]->kat_posisi;

    if ($kat_posisi == 1) {
        # code...
        // $nama_jabatan = 
    } 
    elseif($kat_posisi == 2) {
        # code...
    }
    elseif($kat_posisi == 4) {
        # code...
    }
    elseif($kat_posisi == 6) {
        # code...
    }
    
    $pangkat     = ($infoPegawai[0]->nama_pangkat != '-') ? $infoPegawai[0]->nama_pangkat : '' ;
    $ruang       = ($infoPegawai[0]->nama_golongan != '-') ? ', ('.$infoPegawai[0]->nama_golongan.') ' : '' ;
    $tmt_pangkat = ($infoPegawai[0]->tmt_pangkat != '-') ? $infoPegawai[0]->tmt_pangkat : '' ;    
}

if ($atasan != 0 || $atasan != '') {
    # code...
    $nama_pegawai_atasan  = $atasan[0]->nama_pegawai;
    $nama_jabatan_atasan  = $atasan[0]->nama_jabatan;
    $nama_eselon1_atasan  = $atasan[0]->nama_eselon1;
    $nama_eselon2_atasan  = $atasan[0]->nama_eselon2;
    $nama_eselon3_atasan  = $atasan[0]->nama_eselon3;
    $nama_eselon4_atasan  = $atasan[0]->nama_eselon4;
    $nip_atasan           = $atasan[0]->nip;
    $kelas_jabatan_atasan = $atasan[0]->kelas_jabatan;

    $pangkat_atasan     = ($atasan[0]->nama_pangkat != '-') ? $atasan[0]->nama_pangkat : '' ;
    $ruang_atasan       = ($atasan[0]->nama_golongan != '-') ? ', ('.$atasan[0]->nama_golongan.') ' : '' ;
    $tmt_pangkat_atasan = ($atasan[0]->tmt_pangkat != '-') ? $atasan[0]->tmt_pangkat : '' ;
}
// else
// {
//     if ($atasan_akademik != 0 || $atasan_akademik != '') {
//         # code...
//     }
//     else
//     {
//         if ($atasan_plt != 0 || $atasan_plt != '') {
//             # code...
//             $nama_pegawai_atasan  = $atasan_plt[0]->nama_pegawai;
//             $nama_jabatan_atasan  = $atasan_plt[0]->nama_jabatan;            
//         }        
//     }
// }


if ($atasan_penilai != 0 || $atasan_penilai != '') {
    # code...
    $nama_pegawai_atasan_penilai  = $atasan_penilai[0]->nama_pegawai;
    $nama_jabatan_atasan_penilai  = $atasan_penilai[0]->nama_jabatan;
    $nama_eselon1_atasan_penilai  = $atasan_penilai[0]->nama_eselon1;
    $nama_eselon2_atasan_penilai  = $atasan_penilai[0]->nama_eselon2;
    $nama_eselon3_atasan_penilai  = $atasan_penilai[0]->nama_eselon3;
    $nama_eselon4_atasan_penilai  = $atasan_penilai[0]->nama_eselon4;
    $nip_atasan_penilai           = $atasan_penilai[0]->nip;
    $kelas_jabatan_atasan_penilai = $atasan_penilai[0]->kelas_jabatan;

    $pangkat_atasan_penilai     = ($atasan_penilai[0]->nama_pangkat != '-') ? $atasan_penilai[0]->nama_pangkat : '' ;
    $ruang_atasan_penilai       = ($atasan_penilai[0]->nama_golongan != '-') ? ', ('.$atasan_penilai[0]->nama_golongan.') ' : '' ;
    $tmt_pangkat_atasan_penilai = ($atasan_penilai[0]->tmt_pangkat != '-') ? $atasan_penilai[0]->tmt_pangkat : '' ;
}
?>
<style type="text/css">

#table_skp
{
    font-size: 11px!important;
}

#table_skp>thead>tr>th
{
    vertical-align: middle;
    text-align: center;
    border: 1px solid rgba(158, 158, 158, 0.2);
}

/* #table_skp > thead > tr:nth-child(1) > th:nth-child(4),
#table_skp > thead > tr:nth-child(2) > th:nth-child(1),
#table_skp > thead > tr:nth-child(2) > th:nth-child(2),
#table_skp > thead > tr:nth-child(2) > th:nth-child(3),
#table_skp > thead > tr:nth-child(2) > th:nth-child(4), */
#table_skp > tbody > tr > td:nth-child(4),
#table_skp > tbody > tr > td:nth-child(5),
#table_skp > tbody > tr > td:nth-child(6),
#table_skp > tbody > tr > td:nth-child(7)
{
    background: #9E9E9E;
    border: 1px solid #009688;    
}

#table_skp>tbody>tr>td
{
    /* text-align: ; */
    border: 1px solid rgba(158, 158, 158, 0.2);
}

#table_skp > thead > tr:nth-child(1) > th:nth-child(1),
#table_skp > tbody > tr > td:nth-child(1)
{
    width: 0px;
    padding-left: 10px
}

#table_skp > tbody > tr > td:nth-child(2)
{
    text-align: justify!important;
    word-wrap: break-word;
}

.table-striped>tfoot>tr:nth-of-type(odd) {
    background-color: #f9f9f9;
}

.table-striped>tfoot>tr:nth-of-type(even) {
    background-color: #fff;
}

#table_skp>tfoot>tr>td {
    /* text-align: ; */
    border: 1px solid rgba(158, 158, 158, 0.2);
}
</style>
<div class="col-xs-12">
    <div class="box">
        <div class="box-header">
            <div class="col-lg-12">
                <div class="input-group col-lg-4">
                    <select name="f_tahun" id="f_tahun" class="form-control">
                    <?php
                        $now=date('Y');
                        $past=$now-5;
                        for ($a=$past;$a<=$now+5;$a++)
                        {
                            $select ="";
                            if ($a == $year_pass) {
                                # code...
                                $select = "selected";
                            }
                            echo "<option value='$a' $select>$a</option>";
                        }
                    ?>
                    </select>
                    <a class="btn btn-md pull-right" onclick="lookData('<?=$id_pegawai;?>','<?=$id_posisi;?>')" style="background:#00BCD4;color: #fff; margin:10px"><i class="fa fa-excel"></i> Lihat</a>
                    <a onclick="excelData('<?=$id_pegawai;?>','<?=$id_posisi;?>')" class="btn btn-md pull-right" style="background:#00BCD4;color: #fff; margin:10px"><i class="fa fa-excel"></i> Excel</a>                    
                </div>       
                                                                    
                <h3 class="text-center col-lg-12">PENILAIAN CAPAIAN SASARAN KERJA PEGAWAI NEGERI SIPIL</h3>
            </div>
        </div>
        <div class="box-body">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-group" id="accordion">
                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                        <div class="panel box box-primary">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">
                                    YANG DINILAI
                                </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="box-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <td>a. Nama</td>
                                                <td colspan="4"><?php echo $nama_pegawai;?></td>
                                            </tr>
                                            <tr>
                                                <td>b. NIP</td>
                                                <td colspan="4"><?php echo $nip;?></td>
                                            </tr>
                                            <tr>
                                                <td>c. Pangkat, Golongan Ruang, TMT</td>
                                                <td colspan="4"><?=$pangkat;?> <?=$ruang;?> <?=$tmt_pangkat;?></td>
                                            </tr>
                                            <tr>
                                                <td>d. Jabatan/Pekerjaan</td>
                                                <td colspan="4"><?=$nama_jabatan;?></td>
                                            </tr>
                                            <tr>
                                                <td>e. Unit Organisasi</td>
                                                <td colspan="4"><?=$nama_eselon2." ".$nama_eselon1;?></td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel box box-danger">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
                                    PEJABAT PENILAI
                                </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="box-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <td>a. Nama</td>
                                                <td colspan="4"><?php echo $nama_pegawai_atasan;?></td>
                                            </tr>
                                            <tr>
                                                <td>b. NIP</td>
                                                <td colspan="4"><?php echo $nip_atasan;?></td>
                                            </tr>
                                            <tr>
                                                <td>c. Pangkat, Golongan Ruang, TMT</td>
                                                <td colspan="4"><?=$pangkat_atasan;?> <?=$ruang_atasan;?> <?=$tmt_pangkat_atasan;?></td>
                                            </tr>
                                            <tr>
                                                <td>d. Jabatan/Pekerjaan</td>
                                                <td colspan="4"><?=$nama_jabatan_atasan;?></td>
                                            </tr>
                                            <tr>
                                                <td>e. Unit Organisasi</td>
                                                <td colspan="4"><?=$nama_eselon2_atasan." ".$nama_eselon1_atasan;?></td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel box box-success">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">
                                    ATASAN PEJABAT PENILAI
                                </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false">
                                <div class="box-body">
                                    <table id="data1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <td>a. Nama</td>
                                                <td colspan="4"><?php echo $nama_pegawai_atasan_penilai;?></td>
                                            </tr>
                                            <tr>
                                                <td>b. NIP</td>
                                                <td colspan="4"><?php echo $nip_atasan_penilai;?></td>
                                            </tr>
                                            <tr>
                                                <td>c. Pangkat, Golongan Ruang, TMT</td>
                                                <td colspan="4"><?=$pangkat_atasan_penilai;?> <?=$ruang_atasan_penilai;?> <?=$tmt_pangkat_atasan_penilai;?></td>
                                            </tr>
                                            <tr>
                                                <td>d. Jabatan/Pekerjaan</td>
                                                <td colspan="4"><?=$nama_jabatan_atasan_penilai;?></td>
                                            </tr>
                                            <tr>
                                                <td>e. Unit Organisasi</td>
                                                <td colspan="4"><?=$nama_eselon2_atasan_penilai." ".$nama_eselon1_atasan_penilai;?></td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            <!-- /.box -->
            </div>            
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th colspan="4">UNSUR YANG DINILAI</th>
                        <th>Jumlah</th>
                    </tr>
                    <tr>
                        <td>a. Sasaran Kerja Pegawai (SKP)</td>
                        <td colspan="3" class="text-center"><b><?=number_format($summary_skp['total'],2);?> X 60%</b></td>
                        <td><?=number_format($summary_skp['nilai_sasaran_kinerja_pegawai'],2);?></td>
                    </tr>
                    <tr>
                        <td rowspan="9">b. Perilaku Kerja</td>
                        <td>1. Orientasi Pelayanan</td>
                        <td><?=number_format($summary_prilaku_skp['orientasi_pelayanan'],2);?></td>
                        <td style="<?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['orientasi_pelayanan'])['css'];?>"><?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['orientasi_pelayanan'])['value'];?></td>
                        <td rowspan="8"></td>
                    </tr>
                    <tr>
                        <td>2. Integritas</td>
                        <td><?=number_format($summary_prilaku_skp['integritas'],2);?></td>
                        <td style="<?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['integritas'])['css'];?>"><?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['integritas'])['value'];?></td>
                    </tr>
                    <tr>
                        <td>3. Komitmen</td>
                        <td><?=number_format($summary_prilaku_skp['komitmen'],2);?></td>
                        <td style="<?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['komitmen'])['css'];?>"><?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['komitmen'])['value'];?></td>
                    </tr>
                    <tr>
                        <td>4. Disiplin</td>
                        <td><?=number_format($summary_prilaku_skp['disiplin'],2);?></td>
                        <td style="<?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['disiplin'])['css'];?>"><?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['disiplin'])['value'];?></td>
                    </tr>
                    <tr>
                        <td>5. Kerjasama</td>
                        <td><?=number_format($summary_prilaku_skp['kerjasama'],2);?></td>
                        <td style="<?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['kerjasama'])['css'];?>"><?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['kerjasama'])['value'];?></td>
                    </tr>
                    <tr>
                        <td>6. Kepemimpinan</td>
                        <?php
                            if ($infoPegawai[0]->kat_posisi == 1 ||$infoPegawai[0]->kat_posisi == 6 ) {
                                # code...
                        ?>
                                <td><?=number_format($summary_prilaku_skp['kepemimpinan'],2);?></td>
                                <td style="<?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['kepemimpinan'])['css'];?>"><?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['kepemimpinan'])['value'];?></td>                        
                        <?php
                            }
                            else
                            {
                        ?>
                                <td></td>
                                <td></td>                                
                        <?php
                            }
                        ?>                        
                    </tr>
                    <tr>
                        <td>7. Jumlah</td>
                        <td colspan="2"><?=number_format($summary_prilaku_skp['jumlah'],2);?></td>
                    </tr>
                    <tr>
                        <td>8. Nilai Rata - Rata</td>
                        <td><?=number_format($summary_prilaku_skp['rata_rata'],2);?></td>
                        <td style="<?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['rata_rata'])['css'];?>"><?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['rata_rata'])['value'];?></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <label class="col-lg-6" style="text-align: -webkit-right;">9. Nilai Prilaku Kerja</label><label class="col-lg-6"><?=number_format($summary_prilaku_skp['rata_rata'],2);?> X 40%</label></td>
                        <td><?=number_format($summary_prilaku_skp['nilai_prilaku_kerja'],2);?></$td>
                    </tr>
                    <tr>
                        <th rowspan="2" colspan="4" class="text-center">NILAI PRESTASI KERJA</th>
                        <td><?=number_format($summary_prilaku_skp['nilai_prilaku_kerja']+$summary_skp['nilai_sasaran_kinerja_pegawai'],2);?></td>
                    </tr>
                    <tr>
                        <td style="<?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['nilai_prilaku_kerja']+$summary_skp['nilai_sasaran_kinerja_pegawai'])['css'];?>"><?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['nilai_prilaku_kerja']+$summary_skp['nilai_sasaran_kinerja_pegawai'])['value'];?></td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="col-xs-12">
    <div class="box">
        <div class="box-header">
            <div class="col-lg-12">
                <h3 class="text-center">PENILAIAN CAPAIAN SASARAN KERJA PEGAWAI NEGERI SIPIL</h3>
            </div>
        </div>
        <div class="box-body">
            <table id="table_skp" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Kegiatan tugas jabatan</th>
                        <!-- <th rowspan="2">Perjanjian Kerja</th>
                        <th rowspan="2">Jenis SKP</th> -->
                        <th rowspan="2">AK</th>
                        <th colspan="4">Target</th>
                        <th colspan="4">Realisasi</th>
                        <!-- <th rowspan="2">Aspek Kuantitas</th>
                        <th rowspan="2">Aspek Kualitas</th>
                        <th rowspan="2">Aspek Waktu</th> -->
                        <th rowspan="2">Penghitungan</th>
                        <th rowspan="2">Nilai Capaian SKP</th>
                        <th rowspan="2" colspan="2">Predikat</th>                        
                    </tr>
                    <tr>
                        <th>Kuan - Output</th>
                        <th>Kual / mutu</th>
                        <th>Waktu</th>
                        <th>Biaya</th>
                        <th>Kuan - Output</th>
                        <th>Kual / mutu</th>
                        <th>Waktu</th>
                        <th>Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total             = 0;
                    if ($list_skp != 0) {
                        # code...
                        for ($i=0; $i < count($list_skp); $i++) {
                            # code...
                            $status                 = "";
                            $pk_status              = "";
                            $style_status           = "";
                            $style_tr               = "";
                            $style_td               = "";
                            $arrow_up               = "";
                            $arrow_down             = "";
                            $tingkat_efisiensi      = "";
                            $kegiatan               = $list_skp[$i]->kegiatan;

                            if ($kat_posisi == 1) {
                                # code...
                                if($list_skp[$i]->id_skp_master) $kegiatan=$list_skp[$i]->kegiatan_skp;                                
                            }
                            elseif ($kat_posisi == 2) {
                                # code...
                                if($list_skp[$i]->id_skp_jft) $kegiatan=$list_skp[$i]->kegiatan_skp_jft;
                            }                                                        
                            elseif ($kat_posisi == 4) {
                                # code...
                                if($list_skp[$i]->id_skp_jfu) $kegiatan=$list_skp[$i]->kegiatan_skp_jfu;                                                                
                            }
                            elseif ($kat_posisi == 6) {
                                # code...
                                if($list_skp[$i]->id_skp_master) $kegiatan=$list_skp[$i]->kegiatan_skp;                                
                            }

                            if ($list_skp[$i]->PK == 1)$pk_status = "Ya";
                            else $pk_status = "Tidak";
                            
                            if ($list_skp[$i]->perhitungan['nilai_capaian_skp'] != 0) {
                                # code...
                                $total            += ($list_skp[$i]->perhitungan['nilai_capaian_skp']/count($list_skp));                                
                            }
                            else {
                                # code...
                                $total            = 0;                                
                            }

                    ?>
                    <tr>
                        <td>
                            <?php
                                if ($list_skp[$i]->realisasi_kuantitas != 0) {
                                    # code...
                                    echo $i+1;
                                }
                                else
                                {
                                    if (date('m') == 1) {
                                        # code...
                            ?>
                                        <a class="btn btn-danger" onclick="deactive('<?=$list_skp[$i]->skp_id;?>')">
                                            <i class="fa fa-delete"></i> Tidak Aktif
                                        </a>
                            <?php                                        
                                    }
                                    else
                                    {
                            ?>
                                        <a class="btn btn-danger" onclick="deactive('<?=$list_skp[$i]->skp_id;?>')">
                                            <i class="fa fa-delete"></i> Tidak Aktif
                                        </a>
                            <?php                                                                                
                                        // echo $i+1;                                        
                                    }
                                }
                            ?>
                        </td>
                        <td style="text-align: -webkit-left;"><?=$kegiatan;?></td>
                        <?php
                            if ($kat_posisi == 2) {
                                # code...
                        ?>
                                <td><?=$list_skp[$i]->AK_target + 0;?></td>                                                                        
                        <?php
                            }
                            else
                            {
                        ?>
                                <td></td>                        
                        <?php
                            }
                        ?>

                        <td><?=$list_skp[$i]->target_qty." ".$list_skp[$i]->target_output_name;?></td>
                        <td><?=$list_skp[$i]->target_kualitasmutu;?></td>
                        <td><?=$list_skp[$i]->target_waktu_bln." bln";?></td>
                        <td><?=number_format($list_skp[$i]->target_biaya);?></td>
                        <td><?=$list_skp[$i]->realisasi_kuantitas." ".$list_skp[$i]->target_output_name;?></td>
                        <td>
                            <?php
                                if ($penilai == 0) {
                                    # code...
                                    echo number_format($list_skp[$i]->realisasi_kualitasmutu);
                                }
                                elseif ($penilai == 1) {
                                    # code...
                            ?>
                                    <input type="hidden" id="hdn_skp_id_<?=$i+1;?>" value="<?=$list_skp[$i]->skp_id;?>">
                                    <input type="text" id="realisasi_kualitasmutu_<?=$i+1;?>" name="realisasi_kualitasmutu"  value="<?=$list_skp[$i]->realisasi_kualitasmutu;?>">
                            <?php
                                }
                            ?>
                        </td>
                        <td><?=$list_skp[$i]->target_waktu_bln." bln";?></td>
                        <td><?=number_format($list_skp[$i]->realisasi_biaya);?></td>
                        <!-- <td><?=$list_skp[$i]->aspek_kuantitas;?></td>
                        <td><?=$list_skp[$i]->aspek_kualitas;?></td>
                        <td><?=$list_skp[$i]->aspek_waktu['aspek_waktu'];?></td> -->
                        <td><?=number_format($list_skp[$i]->perhitungan['aspek'],2);?></td>
                        <td><?=number_format($list_skp[$i]->perhitungan['nilai_capaian_skp'],2);?></td>
                        <td style="<?=$this->Globalrules->nilai_capaian_skp($list_skp[$i]->perhitungan['nilai_capaian_skp'])['css'];?>"><?=$this->Globalrules->nilai_capaian_skp($list_skp[$i]->perhitungan['nilai_capaian_skp'])['value'];?></td>                        
                    </tr>
                    <?php
                        }
                    }
                    else {
                        # code...
                        $total = 0;
                    }

                    $list_skp_count = ($list_skp == 0) ? 1 : count($list_skp);                    
                    $total = ($total/$list_skp_count) + $summary_skp['tugas_tambahan'] + $kreativitas;
                    ?>
                </tbody>
                <?php
                if ($tr_tugas_tambahan != 0 || $tr_kreativitas != 0){
                    # code...
                ?>
                <tfoot>
                    <tr class="even">
                        <td></td>
                        <td>II. TUGAS TAMBAHAN DAN KREATIVITAS/UNSUR PENDUKUNG</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="4"></td>
                        <td colspan="2" class="text-center"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                    if ($tugas_tambahan != 0 && $tr_tugas_tambahan != 0) {
                        # code...
                    ?>
                    <tr class="odd">
                        <td>1.</td>
                        <td><b>TUGAS TAMBAHAN</b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="4"></td>
                        <td colspan="2" class="text-center"><?=$tugas_tambahan;?></td>
                        <td></td>
                        <td></td>
                        <td rowspan="<?=count($tr_tugas_tambahan)+1;?>"><?=$summary_skp['tugas_tambahan'];?></td>
                    </tr>
                    <?php
                        for ($i=0; $i < count($tr_tugas_tambahan); $i++) {
                            # code...
                    ?>
                        <tr>
                            <td>1.<?=$i+1;?></td>
                            <td><?=$tr_tugas_tambahan[$i]->keterangan?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="4"></td>
                            <td colspan="2" class="text-center">1</td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php
                        }
                    }

                    if ($tr_kreativitas != 0) {
                        # code...
                    ?>
                    <tr class="even">
                        <td>2.</td>
                        <td><b>KREATIVITAS</b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="4"></td>
                        <td colspan="2" class="text-center"><?=$kreativitas;?></td>
                        <td></td>
                        <td></td>
                        <td rowspan="<?=count($tr_kreativitas)+1;?>"><?=$kreativitas;?></td>
                    </tr>
                    <?php
                        for ($i=0; $i < count($tr_kreativitas); $i++) {
                            # code...
                    ?>
                    <tr>
                        <td>2.<?=$i+1;?></td>
                        <td><?=$tr_kreativitas[$i]->keterangan?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="4"></td>
                        <td colspan="2" class="text-center"><?=$tr_kreativitas[$i]->nilai?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                    <tr class="even">
                        <td colspan="12" class="text-center">NILAI CAPAIAN SKP</td>
                         <td><?=$this->Globalrules->nilai_capaian_skp($total)['value'];?></td>
                        <td><?=number_format($total,2);?></td>
                    </tr>
                </tfoot>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>

<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-1.12.4.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
function deactive(id) {
    $.ajax({
        url :"<?php echo site_url();?>skp/target_skp/deactive_skp/"+id,
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

function lookData(id,posisi) {
    var f_tahun = $("#f_tahun").val();
    window.location.href = "<?php echo site_url()?>skp/cetak_skp/data/"+id+"/"+posisi+"/"+f_tahun;
}

function excelData(id,posisi) {
    var f_tahun = $("#f_tahun").val();
    window.location.href = "<?php echo site_url()?>skp/prints_skp/skp_excel/"+id+"/"+posisi+"/"+f_tahun;
}

$(document).ready(function()
{
    // $("#data1").DataTable({
    //     "oLanguage": {
    //         "sSearch": "Pencarian :",
    //         "sSearchPlaceholder" : "Ketik untuk mencari",
    //         "sLengthMenu": "Menampilkan data&nbsp; _MENU_ &nbsp;Data",
    //         "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
    //         "sZeroRecords": "Data tidak ditemukan"
    //     },
    //     "dom": "<'row'<'col-sm-6'f><'col-sm-6'l>>" +
    //             "<'row'<'col-sm-5'i><'col-sm-7'p>>" +
    //             "<'row'<'col-sm-12'tr>>" +
    //             "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    //     "bSort": false,
    //     "bAutoWidth": false
    // });
});
</script>
