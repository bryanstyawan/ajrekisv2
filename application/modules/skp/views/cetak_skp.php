<?php
		// echo '<pre>';
		// print_r(date("d-m-y",strtotime($infoPegawai[0]->tmt_golongan)));
		// echo '</pre>';
		// die();		
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
$tmt_golongan  = "";

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
$tmt_golongan_atasan  = "";

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
$tmt_golongan_atasan_penilai  = "";

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
    if($infoPegawai[0]->nama_pangkat != '-')$pangkat      = $infoPegawai[0]->nama_pangkat;else $pangkat                                        = '-';
    if($infoPegawai[0]->nama_golongan != '-')$ruang       = '('.$infoPegawai[0]->nama_golongan.'/'.$infoPegawai[0]->nama_ruang.')';else $ruang = '';
    if($infoPegawai[0]->tmt_golongan != '-')$tmt_golongan = ', '.date("d-m-Y",strtotime($infoPegawai[0]->tmt_golongan));else $tmt_golongan = '';
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
    if($atasan[0]->nama_pangkat != '-')$pangkat_atasan      = $atasan[0]->nama_pangkat;else $pangkat_atasan                                        = '-';
    if($atasan[0]->nama_golongan != '-')$ruang_atasan       = '('.$atasan[0]->nama_golongan.'/'.$atasan[0]->nama_ruang.')';else $ruang_atasan      = '';
    if($atasan[0]->tmt_golongan != '-')$tmt_golongan_atasan = ', '.date("d-m-Y",strtotime($atasan[0]->tmt_golongan));else $tmt_golongan_atasan = '';
}

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
    if($atasan_penilai[0]->nama_pangkat != '-')$pangkat_atasan_penilai      = $atasan_penilai[0]->nama_pangkat;else $pangkat_atasan_penilai                                           = '-';
    if($atasan_penilai[0]->nama_golongan != '-')$ruang_atasan_penilai       = '('.$atasan_penilai[0]->nama_golongan.'/'.$atasan_penilai[0]->nama_ruang.')';else $ruang_atasan_penilai = '';
    if($atasan_penilai[0]->tmt_golongan != '-')$tmt_golongan_atasan_penilai = ', '.date("d-m-Y",strtotime($atasan_penilai[0]->tmt_golongan));else $tmt_golongan_atasan_penilai        = '';
}
?>
<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/tabs-checked/css/style_tabs.css'; ?>");</style>
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
    padding-left: 25px;
}

#table_skp > thead > tr:nth-child(1) > th:nth-child(1)
{
    max-width: 0px;
    padding-left: 15px;
    padding-right: 20px;
}

#table_skp > thead > tr:nth-child(1) > th:nth-child(2)
{
    padding-left: 12px;
    padding-right: 9px;
}

#table_skp > thead > tr:nth-child(1) > th:nth-child(3),
#table_skp > thead > tr:nth-child(1) > th:nth-child(4),
#table_skp > thead > tr:nth-child(1) > th:nth-child(5)
{
    word-wrap: break-word;
    padding-left: 5px;
    padding-right: 5px;
    max-width: 22px!important;
    width: 22px!important;
}

#table_skp > thead > tr:nth-child(1) > th:nth-child(6)
{

}

#table_skp > thead > tr:nth-child(1) > th:nth-child(7)
{

}

#table_skp > thead > tr:nth-child(1) > th:nth-child(8),
#table_skp > thead > tr:nth-child(1) > th:nth-child(9)
{
    padding-left: 9px;
    padding-right: 9px;
    max-width: 46px;
    word-wrap: break-word;
}

#table_skp > thead > tr:nth-child(2) > th:nth-child(1),
#table_skp > thead > tr:nth-child(2) > th:nth-child(2),
#table_skp > thead > tr:nth-child(2) > th:nth-child(3),
#table_skp > thead > tr:nth-child(2) > th:nth-child(4),
#table_skp > thead > tr:nth-child(2) > th:nth-child(5),
#table_skp > thead > tr:nth-child(2) > th:nth-child(6),
#table_skp > thead > tr:nth-child(2) > th:nth-child(7),
#table_skp > thead > tr:nth-child(2) > th:nth-child(8)
{
    max-width: 22px!important;
    width: 22px!important;
}

#table_skp>tbody>tr>td
{
    text-align: ;
    border: 1px solid rgba(158, 158, 158, 0.2);
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
    text-align: ;
    border: 1px solid rgba(158, 158, 158, 0.2);
}

#data1 > thead > tr:nth-child(1) > th:nth-child(1)
{
    max-width: 0px;
    padding-left: 15px;
    padding-bottom: 198px;
}
</style>

<div class="col-xs-12">
    <div class="box">
        <div class="box-body">
            <div class="col-lg-6">
                <label style="color: #000;font-weight: 400;font-size: 19px;">Tahun</label>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-star"></i></span>
                        <select name="es1" id="es1" class="form-control"><option value="">Tahun</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <label class="col-lg-12">&nbsp;</label>
                <a target="_blank" href="<?php echo site_url()?>skp/cetak_skp_excel/<?=$this->session->userdata('sesUser');?>" class="btn btn-success btn-md"><i class="fa fa-excel"></i> Excel</a>
                <!-- <a href="" class="btn btn-success btn-md"><i class="fa fa-excel"></i> PDF</a>                 -->
            </div>
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
            <table id="data1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th rowspan="6">1. </th>
                        <th colspan="5">YANG DINILAI</th>
                    </tr>
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
                        <td colspan="4"><?=$pangkat;?> <?=$ruang;?> <?=$tmt_golongan;?></td>
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
                <thead>
                    <tr>
                        <th rowspan="6">2. </th>
                        <th colspan="5">PEJABAT PENILAI</th>
                    </tr>
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
                        <td colspan="4"><?=$pangkat_atasan;?> <?=$ruang_atasan;?> <?=$tmt_golongan_atasan;?></td>
                    </tr>
                    <tr>
                        <td>d. Jabatan/Pekerjaan</td>
                        <td colspan="4"><?=$nama_jabatan_atasan;?></td>
                    </tr>
                    <tr>
                        <td>e. Unit Organisasi</td>
                        <td colspan="4"><?=$nama_eselon2." ".$nama_eselon1;?></td>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th rowspan="6">3. </th>
                        <th colspan="5">ATASAN PEJABAT PENILAI</th>
                    </tr>
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
                        <td colspan="4"><?=$pangkat_atasan_penilai;?> <?=$ruang_atasan_penilai;?> <?=$tmt_golongan_atasan_penilai;?></td>
                    </tr>
                    <tr>
                        <td>d. Jabatan/Pekerjaan</td>
                        <td colspan="4"><?=$nama_jabatan_atasan_penilai;?></td>
                    </tr>
                    <tr>
                        <td>e. Unit Organisasi</td>
                        <td colspan="4"><?=$nama_eselon2." ".$nama_eselon1;?></td>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th rowspan="11">4. </th>
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
                        <td><?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['orientasi_pelayanan']);?></td>
                        <td rowspan="8"></td>
                    </tr>
                    <tr>
                        <td>2. Integritas</td>
                        <td><?=number_format($summary_prilaku_skp['integritas'],2);?></td>
                        <td><?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['integritas']);?></td>
                    </tr>
                    <tr>
                        <td>3. Komitmen</td>
                        <td><?=number_format($summary_prilaku_skp['komitmen'],2);?></td>
                        <td><?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['komitmen']);?></td>
                    </tr>
                    <tr>
                        <td>4. Disiplin</td>
                        <td><?=number_format($summary_prilaku_skp['disiplin'],2);?></td>
                        <td><?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['disiplin']);?></td>
                    </tr>
                    <tr>
                        <td>5. Kerjasama</td>
                        <td><?=number_format($summary_prilaku_skp['kerjasama'],2);?></td>
                        <td><?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['kerjasama']);?></td>
                    </tr>
                    <tr>
                        <td>6. Kepemimpinan</td>
                        <td><?=number_format($summary_prilaku_skp['kepemimpinan'],2);?></td>
                        <td><?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['kepemimpinan']);?></td>
                    </tr>
                    <tr>
                        <td>7. Jumlah</td>
                        <td colspan="2"><?=number_format($summary_prilaku_skp['jumlah'],2);?></td>
                    </tr>
                    <tr>
                        <td>8. Nilai Rata - Rata</td>
                        <td><?=number_format($summary_prilaku_skp['rata_rata'],2);?></td>
                        <td><?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['rata_rata']);?></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <label class="col-lg-6" style="text-align: -webkit-right;">9. Nilai Prilaku Kerja</label><label class="col-lg-6"><?=number_format($summary_prilaku_skp['rata_rata'],2);?> X 40%</label></td>
                        <td><?=number_format($summary_prilaku_skp['nilai_prilaku_kerja'],2);?></$td>
                    </tr>
                    <tr>
                        <th rowspan="2" colspan="5" class="text-center">NILAI PRESTASI KERJA</th>
                        <td><?=number_format($summary_prilaku_skp['nilai_prilaku_kerja']+$summary_skp['nilai_sasaran_kinerja_pegawai'],2);?></td>
                    </tr>
                    <tr>
                        <td><?=$this->Globalrules->nilai_capaian_skp($summary_prilaku_skp['nilai_prilaku_kerja']+$summary_skp['nilai_sasaran_kinerja_pegawai']);?></td>
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
            <table id="table_skp" class="table table-bordered table-striped table-view">
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
                        <th rowspan="2">Penghitungan</th>
                        <th rowspan="2" colspan="2">Nilai Capaian SKP</th>
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
                            $kegiatan               = $list_skp[$i]->kegiatan;if($list_skp[$i]->id_skp_master) $kegiatan=$list_skp[$i]->kegiatan_skp;

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
                        <td><span class="col-md-12 text-center"><?=$i+1;?></span></td>
                        <td style="text-align: -webkit-left;"><?=$kegiatan;?></td>
                        <!-- <td><?=$pk_status;?></td>
                        <td><?=$list_skp[$i]->nama_jenis_skp;?></td> -->
                        <!-- <td><?=$list_skp[$i]->AK_target;?></td> -->
                        <td></td>
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
                        <td><?=$list_skp[$i]->realisasi_waktu." bln";?></td>
                        <!-- <td><?="2 bln";?></td>                         -->
                        <td><?=number_format($list_skp[$i]->realisasi_biaya);?></td>
                        <!-- <td><?=$list_skp[$i]->aspek_kuantitas;?></td>
                        <td><?=$list_skp[$i]->aspek_kualitas;?></td>
                        <td><?=$list_skp[$i]->aspek_waktu['aspek_waktu'];?></td> -->
                        <td><?=number_format($list_skp[$i]->perhitungan['aspek'],2);?></td>
                        <td><?=$this->Globalrules->nilai_capaian_skp($list_skp[$i]->perhitungan['nilai_capaian_skp']);?></td>
                        <td><?=number_format($list_skp[$i]->perhitungan['nilai_capaian_skp'],2);?></td>
                    </tr>
                    <?php
                        }
                    }
                    else {
                        # code...
                        $total = 0;
                    }

                    $total = ($total/count($list_skp)) + $summary_skp['tugas_tambahan'] + $kreativitas;
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
                        <td><?=$this->Globalrules->nilai_capaian_skp($total);?></td>
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
$(document).ready(function()
{
    $("#data1").DataTable({
        "oLanguage": {
            "sSearch": "Pencarian :",
            "sSearchPlaceholder" : "Ketik untuk mencari",
            "sLengthMenu": "Menampilkan data&nbsp; _MENU_ &nbsp;Data",
            "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "sZeroRecords": "Data tidak ditemukan"
        },
        "dom": "<'row'<'col-sm-6'f><'col-sm-6'l>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "bSort": false,
        "bAutoWidth": false
    });
});
</script>
