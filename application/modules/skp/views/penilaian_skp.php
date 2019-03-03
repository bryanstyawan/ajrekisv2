<style>
.realisasi_kualitasmutu
{
    display: block;
    width: 100%;
    height: 35px;
    padding: 5px 9px;
    font-size: 13px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
}
</style>
<?php
$nama_pegawai  = "";
$nama_jabatan  = "";
$nama_eselon1  = "";
$nama_eselon2  = "";
$nama_eselon3  = "";
$nama_eselon4  = "";
$nip           = "";
$kelas_jabatan = "";
$kat_posisi    = "";
// echo "<pre>";
// print_r($infoPegawai);die();				
// echo"</pre>";
if ($infoPegawai != 0 || $infoPegawai != '') {
    # code...
    $nama_pegawai  = $infoPegawai1[0]->nama_pegawai;
    $nama_jabatan  = $infoPegawai1[0]->nama_jabatan;
    $nama_eselon1  = $infoPegawai1[0]->nama_eselon1;
    $nama_eselon2  = $infoPegawai1[0]->nama_eselon2;
    $nama_eselon3  = $infoPegawai1[0]->nama_eselon3;
    $nama_eselon4  = $infoPegawai1[0]->nama_eselon4;
    $nip           = $infoPegawai1[0]->nip;
    $kelas_jabatan = $infoPegawai1[0]->kelas_jabatan;
    $kat_posisi    = $infoPegawai1[0]->kat_posisi;
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
</style>

<div class="col-lg-12">
    <div class="box box-solid">
        <div class="box-body">

            <div class="block" role="form">
                <h6 class="heading-hr">
                    <i class="icon-user"></i>Informasi Pegawai:</h6>
                <div class="block-inner">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>
                                    Pimpinan Tinggi Madya (Eselon I) :</label>
                                <span id="ContentPlaceHolder1_lbl_eselon1"><?php echo $nama_eselon1;?></span>
                            </div>
                            <div class="col-sm-6">
                                <label>
                                    Pimpinan Tinggi Pratama (Eselon II) :</label>
                                <span id="ContentPlaceHolder1_lbl_eselon2"><?php echo $nama_eselon2;?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>
                                    Administrator (Eselon III) :</label>
                                <span id="ContentPlaceHolder1_lbl_eselon3"><?php echo $nama_eselon3;?></span>
                            </div>
                            <div class="col-sm-6">
                                <label>
                                    Pengawas (Eselon IV) :</label>
                                <span id="ContentPlaceHolder1_lbl_eselon4"><?php echo $nama_eselon4;?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>
                                    NIP:</label>
                                <span id="ContentPlaceHolder1_lbl_nip"><?php echo $nip;?></span>
                            </div>
                            <div class="col-sm-6">
                                <label>
                                    Nama Pegawai:</label>
                                <span id="ContentPlaceHolder1_lbl_klsjabatan"><?php echo $nama_pegawai;?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>
                                    Kelas Jabatan:</label>
                                <span id="ContentPlaceHolder1_lbl_klsjabatan"><?php echo $kelas_jabatan;?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<?php
if ($member != 0) {
    # code...
?>

<div class="col-md-2">
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
                        // if ($member[$i]->counter_belum_diperiksa == 0) {
                        //   // code...
                        //   $flag_counter = "display:none;";
                        // }
                    ?>
                        <li style="cursor: pointer;" class="teamwork" id="li_kandidat_<?=$i;?>" onclick="detail_skp('<?=$member[$i]->id;?>')">
                            <a class="contact-name">
                                <i class="fa fa-circle-o text-red contact-name-list"></i><?=$member[$i]->nama_pegawai;?>
                                <sup style="<?=$flag_counter;?>">
                                    <span class="notif-count pull-right ">
                                    </span>
                                </sup>
                            </a>
                            <input type="hidden" id="hdn_pegawai_<?=$i;?>" name="list_kandidat" value="<?=$member[$i]->nama_pegawai;?>"></input>
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


<div class="col-xs-10" style="overflow:auto;">
    <div class="box">
        <div class="box-header">
            <div class="col-md-3">
                <!-- <label style="color: #000;font-weight: 400;font-size: 19px;display: -webkit-inline-box;">
                    Tahun&nbsp;:&nbsp;&nbsp;
                    <select class="form-control input-sm" name="tahun" id="tahun"></select>
                </label> -->
            </div>
        </div>
        <div class="box-body">
            <table id="table_skp" class="table table-bordered table-striped table-view">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Kegiatan tugas jabatan</th>
                        <!-- <th rowspan="2">Perjanjian Kerja</th> -->
                        <!-- <th rowspan="2">Jenis SKP</th> -->
                        <th rowspan="2">AK</th>
                        <th colspan="4">Target</th>
                        <th colspan="4">Realisasi</th>
                        <th rowspan="2">Penghitungan</th>
                        <!-- <th rowspan="2">Aspek</th> -->
                        <th rowspan="2">Nilai Capaian SKP</th>
                        <!-- <th rowspan="2"></th> -->
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
                    if ($list != 0) {
                        # code...
                        for ($i=0; $i < count($list); $i++) {
                            # code...
                            $status                 = "";
                            $pk_status              = "";
                            $style_status           = "";
                            $style_tr               = "";
                            $style_td               = "";
                            $arrow_up               = "";
                            $arrow_down             = "";
                            $tingkat_efisiensi      = "";
                            $aspek_waktu            = "";
                            $aspek_biaya            = "";
                            $aspek_kuantitas        = "";
                            $aspek_kualitas         = "";

                            $kegiatan               = "";

                            $kegiatan            = $list[$i]->kegiatan;
                            if($infoPegawai1[0]->kat_posisi == 1)
                            {
                                if ($list[$i]->id_skp_master != '') {
                                    # code...
                                    $kegiatan = $list[$i]->kegiatan_skp;
                                }
                            }
                            elseif ($infoPegawai1[0]->kat_posisi == 2) {
                                # code...
                                if ($list[$i]->id_skp_jft != '') {
                                    # code...
                                    $kegiatan = $list[$i]->kegiatan_skp_jft;
                                }                                
                            }                            
                            elseif ($infoPegawai1[0]->kat_posisi == 4) {
                                # code...
                                if ($list[$i]->id_skp_jfu != '') {
                                    # code...
                                    $kegiatan = $list[$i]->kegiatan_skp_jfu;
                                }                                
                            }

                            // if ($list[$i]->id_skp_master != '') {
                            //     # code...
                            //     $kegiatan            = $list[$i]->kegiatan_skp;
                            // }
                            $AK_target              = $list[$i]->AK_target;
                            $target_qty             = $list[$i]->target_qty;
                            $target_output          = $list[$i]->target_output_name;
                            $target_kualitasmutu    = $list[$i]->target_kualitasmutu;
                            $target_waktu_bln       = $list[$i]->target_waktu_bln;
                            $target_biaya           = $list[$i]->target_biaya;
                            $jenis_skp              = $list[$i]->nama_jenis_skp;
                            $realisasi_kuantitas    = $list[$i]->realisasi_kuantitas;
                            $realisasi_kualitasmutu = $list[$i]->realisasi_kualitasmutu;
                            $realisasi_biaya        = $list[$i]->realisasi_biaya;
                            $realisasi_waktu        = $list[$i]->realisasi_waktu;

                            if ($list[$i]->PK == 1) {
                                # code...
                                $pk_status = "Ya";
                            }
                            else
                            {
                                $pk_status = "Tidak";
                            }

                            $aspek_kuantitas = $this->Globalrules->aspek_kuantitas($realisasi_kuantitas,$target_qty);
                            $aspek_kualitas  = $this->Globalrules->aspek_kualitas($realisasi_kualitasmutu,$target_kualitasmutu);
                            $aspek_waktu     = $this->Globalrules->aspek_waktu($realisasi_waktu,$target_waktu_bln,$realisasi_kuantitas);
                            $aspek_biaya     = $this->Globalrules->aspek_biaya($target_biaya,$realisasi_biaya,$realisasi_kuantitas);
                            $perhitungan     = $this->Globalrules->perhitungan_skp($aspek_kuantitas,$aspek_kualitas,$aspek_waktu['aspek_waktu'],$aspek_biaya);

                    ?>
                    <tr>
                        <td><span class="col-md-12 text-center"><?=$i+1;?></span></td>
                        <td style="text-align: -webkit-left;"><?=$kegiatan;?></td>
                        <!-- <td><?=$pk_status;?></td> -->
                        <!-- <td><?=$jenis_skp;?></td> -->
                        <td><?=$AK_target;?></td>
                        <!-- <td>
                            <?php
                            if ($kat_posisi != 2) {
                                # code...
                                echo '-';
                            } 
                            ?>
                        </td> -->
                        <td><?=$target_qty." ".$target_output;?></td>
                        <td><?=$target_kualitasmutu;?></td>
                        <td><?=$target_waktu_bln." bln";?></td>
                        <td><?=number_format($target_biaya);?></td>
                        <td><?=$realisasi_kuantitas." ".$target_output;?></td>
                        <td>
                            <?php
                                if ($penilai == 0) {
                                    # code...
                                    echo number_format($realisasi_kualitasmutu);
                                }
                                elseif ($penilai == 1) {
                                    # code...
                                    // if ($realisasi_kualitasmutu == 0) {
                                        # code...
                            ?>
                                    <input type="hidden" id="hdn_skp_id_<?=$i+1;?>" value="<?=$list[$i]->skp_id;?>">
                                    <input type="number" class="realisasi_kualitasmutu col-lg-12" id="realisasi_kualitasmutu_<?=$i+1;?>" name="realisasi_kualitasmutu"  value="<?=$realisasi_kualitasmutu;?>" maxlength="100">
                            <?php
                                    // }
                                    // else
                                    // {
                                    //     echo number_format($realisasi_kualitasmutu);
                                    // }
                                }
                            ?>
                        </td>
                        <td><?=$target_waktu_bln." bln";?></td>
                        <!-- <td><?="2 bln";?></td>                         -->
                        <td><?=number_format($realisasi_biaya,2);?></td>
                        <!-- <td><?=number_format($perhitungan['aspek'],2);?></td> -->
                        <td><?=number_format($perhitungan['nilai_capaian_skp'],2);?></td>
                        <td><?=$this->Globalrules->nilai_capaian_skp(number_format($perhitungan['nilai_capaian_skp'],2));?></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

            <?php
                if ($penilai == 1) {
                    # code...
            ?>
            <div class="col-lg-12 text-center">
                <button class="btn btn-lg" id="btn_save_nilai_skp">Simpan Penilaian SKP</button>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>

<div class="example-modal">
<div class="modal modal-success fade" id="tambah_dataskp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="box-content">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Formulir Sasaran Kerja Pegawai</h4>
                </div>
                <div class="modal-body" style="background-color: #fff!important;">

                    <div class="box box-default">
                        <div class="box-body">
                            <div class="row">

                                <div class="form-group col-md-12">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Kegiatan Tugas Jabatan</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <textarea id="kegiatan" name="kegiatan" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Angka Kredit</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="text" id="ak_target" name="ak_target" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Perjanjian Kerja</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <select class="form-control tour-step step1" name="perjanjian_kerja" id="perjanjian_kerja">
                                                    <option value="">Pilih Satuan</option>
                                                    <option value="1">Ya</option>
                                                    <option value="0">Tidak</option>
                                            </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Jenis SKP</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <select class="form-control tour-step step1" name="jenis" id="jenis">
                                                    <option value="">Pilih Satuan</option>
                                                <?php $x=1;
                                                    foreach($jenis->result() as $row){?>
                                                    <option value="<?php echo $row->id;?>"><?php echo $x.". ".$row->nama;?></option>
                                                <?php $x++;}    ?>
                                            </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Target Kuantitas</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="text" id="jumlah" name="jumlah" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Jenis Output</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <select class="form-control tour-step step1" name="satuan" id="satuan">
                                                    <option value="">Pilih Satuan</option>
                                                <?php $x=1;
                                                    foreach($satuan->result() as $row){?>
                                                    <option value="<?php echo $row->id;?>"><?php echo $x.". ".$row->nama;?></option>
                                                <?php $x++;}    ?>
                                            </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Target Kualitas Mutu</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="text" id="kualitas_mutu" name="kualitas_mutu" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Target Waktu</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="text" id="waktu" name="waktu" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Target Biaya</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="text" id="biaya" name="biaya" class="form-control" >
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
                    <input type="submit" class="btn btn-primary" value="Simpan" id="btn_save_skp"/>

                </div>
            </div>
        </div>
    </div>
</div>
</div>


<div class="example-modal">
<div class="modal modal-success fade" id="ubah_dataskp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="box-content">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Formulir Sasaran Kerja Pegawai</h4>
                </div>
                <div class="modal-body" style="background-color: #fff!important;">

                    <div class="box box-default">
                        <div class="box-body">
                            <div class="row">

                                <div class="form-group col-md-12">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Kegiatan Tugas Jabatan</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="hidden" id="oid" name="oid" class="form-control" >
                                        <input type="hidden" id="before" name="before" class="form-control" >
                                        <input type="hidden" id="after" name="after" class="form-control" >
                                        <textarea id="nkegiatan" name="nkegiatan" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Angka Kredit</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="text" id="nak_target" name="nak_target" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Perjanjian Kerja</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <select class="form-control tour-step step1" name="nperjanjian_kerja" id="nperjanjian_kerja">
                                                    <option value="">Pilih Satuan</option>
                                                    <option value="1">Ya</option>
                                                    <option value="0">Tidak</option>
                                            </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Jenis SKP</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <select class="form-control tour-step step1" name="njenis" id="njenis">
                                                    <option value="">Pilih Satuan</option>
                                                <?php $x=1;
                                                    foreach($jenis->result() as $row){?>
                                                    <option value="<?php echo $row->id;?>"><?php echo $x.". ".$row->nama;?></option>
                                                <?php $x++;}    ?>
                                            </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Target Kuantitas</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="text" id="njumlah" name="njumlah" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Jenis Output</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <select class="form-control tour-step step1" name="nsatuan" id="nsatuan">
                                                    <option value="">Pilih Satuan</option>
                                                <?php $x=1;
                                                    foreach($satuan->result() as $row){?>
                                                    <option value="<?php echo $row->id;?>"><?php echo $x.". ".$row->nama;?></option>
                                                <?php $x++;}    ?>
                                            </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Target Kualitas Mutu</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="text" id="nkualitas_mutu" name="nkualitas_mutu" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Target Waktu</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="text" id="nwaktu" name="nwaktu" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Target Biaya</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="text" id="nbiaya" name="nbiaya" class="form-control" >
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
                    <input type="submit" class="btn btn-primary" value="Simpan" id="btn_save_skp_edit"/>

                </div>
            </div>
        </div>
    </div>
</div>
</div>


<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-1.12.4.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">

function detail_skp(id) {
    // body...
    $("#loadprosess").modal('show');
    setTimeout(function(){
        window.location.href = "<?php echo base_url().'skp/penilaian_skp/'?>"+id;
    }, 1500);
}
function edit(id,before,after) {
    // body...
    $.getJSON('<?php echo site_url() ?>/skp/get_detail_skp/'+id,
        function( response ) {
            $('#ubah_dataskp').attr('class', 'modal fade bs-example-modal-lg')
                         .attr('aria-labelledby','myLargeModalLabel');
            $('.modal-dialog').attr('class','modal-dialog modal-lg');
            $("#ubah_dataskp").modal('show');

            $("#nkegiatan").val(response['kegiatan']);
            $("#njenis").val(response['jenis_skp']);
            $("#nperjanjian_kerja").val(response['PK']);
            $("#nak_target").val(response['ak_target']);
            $("#njumlah").val(response['target_qty']);
            $("#nsatuan").val(response['target_output']);

            $("#nkualitas_mutu").val(response['target_kualitasmutu']);
            $("#nwaktu").val(response['target_waktu_bln']);
            $("#nbiaya").val(response['target_biaya']);

            $("#before").val(before);
            $("#after").val(after);
            $("#oid").val(response['skp_id']);
            setTimeout(function(){
                $("#loadprosess").modal('hide');
            }, 1000);
        }
    );


}

function del(id) {
    // body...
     Lobibox.confirm({
         title: "Konfirmasi",
         msg: "Anda akan hapus Target SKP ini ?",
         callback: function ($this, type) {
            if (type === 'yes'){
                $.ajax({
                    url :"<?php echo site_url()?>/skp/delete_skp/"+id,
                    type:"post",
                    beforeSend:function(){
                        $("#loadprosess").modal('show');
                    },
                    success:function(msg){
                        var obj = jQuery.parseJSON (msg);
                        if (obj.status == 1)
                        {
                            Lobibox.notify('success', {
                                msg: obj.text
                                });
                            setTimeout(function(){
                                $("#loadprosess").modal('hide');
                                setTimeout(function(){
                                    location.reload();
                                }, 1500);
                            }, 5000);
                        }
                        else
                        {
                            Lobibox.notify('success', {
                                msg: obj.text
                                });
                            setTimeout(function(){
                                $("#loadprosess").modal('hide');
                            }, 5000);
                        }
                    },
                    error:function(){
                        Lobibox.notify('error', {
                            msg: 'Gagal melakukan transaksi '
                        });
                    }
                })
            }
        }
    })
}

function arrow_up(id) {
    // body...
    $.ajax({
        url :"<?php echo site_url();?>/skp/change_priority/"+id+"/up",
        type:"post",
        beforeSend:function(){
            $("#editData").modal('hide');
            $("#loadprosess").modal('show');
        },
        success:function(msg){
            var obj = jQuery.parseJSON (msg);
            if (obj.status == 1)
            {
                Lobibox.notify('success', {
                    msg: obj.text
                    });
                setTimeout(function(){
                    $("#loadprosess").modal('hide');
                    setTimeout(function(){
                        location.reload();
                    }, 1500);
                }, 5000);
            }
            else
            {
                Lobibox.notify('success', {
                    msg: obj.text
                    });
                setTimeout(function(){
                    $("#loadprosess").modal('hide');
                }, 5000);
            }
        },
        error:function(){
            Lobibox.notify('error', {
                msg: 'Gagal Menambah Pekerjaan'
            });
        }
    })
}

function arrow_down(id) {
    // body...
    $.ajax({
        url :"<?php echo site_url();?>/skp/change_priority/"+id+"/down",
        type:"post",
        beforeSend:function(){
            $("#editData").modal('hide');
            $("#loadprosess").modal('show');
        },
        success:function(msg){
            var obj = jQuery.parseJSON (msg);
            if (obj.status == 1)
            {
                Lobibox.notify('success', {
                    msg: obj.text
                    });
                setTimeout(function(){
                    $("#loadprosess").modal('hide');
                    setTimeout(function(){
                        location.reload();
                    }, 500);
                }, 1000);
            }
            else
            {
                Lobibox.notify('success', {
                    msg: obj.text
                    });
                setTimeout(function(){
                    $("#loadprosess").modal('hide');
                }, 5000);
            }
        },
        error:function(){
            Lobibox.notify('error', {
                msg: 'Gagal Menambah Pekerjaan'
            });
        }
    })
}

$(document).ready(function()
{
    $('.autonumber').autoNumeric('init');

    $("#addDataSKP").click(function(){
        // body...
        $('#tambah_dataskp').attr('class', 'modal fade bs-example-modal-lg')
                            .attr('aria-labelledby','myLargeModalLabel');
        $('.modal-dialog').attr('class','modal-dialog modal-lg');
        $("#tambah_dataskp").modal('show');
    })

    $("#btn_save_nilai_skp").click(function()
    {
        var inputs             = document.getElementsByName('realisasi_kualitasmutu');
        var data_sender_detail = [];

        if (inputs.length != 0)
        {
            flag_filter_max = "";
            for (var i = 1; i <= inputs.length; i++) {
                var hdn_skp_id             = $('#hdn_skp_id_'+i).val();
                var realisasi_kualitasmutu = $('#realisasi_kualitasmutu_'+i).val();
                if (realisasi_kualitasmutu > 100)
                {
                    flag_filter_max = 'denied';
                }
                data_sender_detail.push({
                    'realisasi_kualitasmutu' : realisasi_kualitasmutu,
                    'hdn_skp_id' : hdn_skp_id
                });
            }

            if (flag_filter_max !== 'denied')
            {
                $.ajax({
                    url :"<?php echo site_url();?>/skp/penilaian_skp_kualmutu",
                    type:"post",
                    data:{data_sender : data_sender_detail},
                    beforeSend:function(){
                        $("#editData").modal('hide');
                        $("#loadprosess").modal('show');
                    },
                    success:function(msg){
                        var obj = jQuery.parseJSON (msg);
                        if (obj.status == 1)
                        {
                            Lobibox.notify('success', {
                                msg: obj.text
                                });
                            setTimeout(function(){
                                $("#loadprosess").modal('hide');
                                setTimeout(function(){
                                    location.reload();
                                }, 1500);
                            }, 5000);
                        }
                        else
                        {
                            Lobibox.notify('warning', {
                                msg: obj.text
                                });
                            setTimeout(function(){
                                $("#loadprosess").modal('hide');
                            }, 5000);
                        }
                    },
                    error:function(){
                        Lobibox.notify('error', {
                            msg: 'Gagal Menambah Pekerjaan'
                        });
                    }
                })
            }
            else
            {
                Lobibox.notify('warning', {
                    msg: 'Batas Penilaian Kualitas Realisasi Maksimal 100'
                });
            }

        }
        else
        {
            Lobibox.notify('warning', {
                msg: 'Semua kualitas mutu telah dinilai'
            });
        }

        console.log(data_sender_detail);
    })

    $("#btn_save_skp").click(function() {
        // body...
        var kegiatan      = $('#kegiatan').val();
        var pk            = $('#perjanjian_kerja').val();
        var jenis         = $('#jenis').val();
        var ak_target     = $('#ak_target').val();
        var jumlah        = $('#jumlah').val();
        var kualitas_mutu = $('#kualitas_mutu').val();
        var satuan        = $('#satuan').val();
        var waktu         = $('#waktu').val();
        var biaya         = $('#biaya').val();

        if (kegiatan.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Kegiatan tugas jabatan wajib diisi."
            });
        }
        else
        {
            var data_sender = {
                                    'kegiatan'      : kegiatan,
                                    'pk'            : pk,
                                    'jenis_skp'     : jenis,
                                    'ak_target'     : ak_target,
                                    'jumlah'        : jumlah,
                                    'satuan'        : satuan,
                                    'kualitas_mutu' : kualitas_mutu,
                                    'waktu'         : waktu,
                                    'biaya'         : biaya
                              };
            $.ajax({
                url :"<?php echo site_url();?>/skp/add_skp_pegawai",
                type:"post",
                data:{data_sender : data_sender},
                beforeSend:function(){
                    $("#editData").modal('hide');
                    $("#loadprosess").modal('show');
                },
                success:function(msg){
                    var obj = jQuery.parseJSON (msg);
                    if (obj.status == 1)
                    {
                        Lobibox.notify('success', {
                            msg: obj.text
                            });
                        setTimeout(function(){
                            $("#loadprosess").modal('hide');
                            setTimeout(function(){
                                location.reload();
                            }, 1500);
                        }, 5000);
                    }
                    else
                    {
                        Lobibox.notify('warning', {
                            msg: obj.text
                            });
                        setTimeout(function(){
                            $("#loadprosess").modal('hide');
                        }, 5000);
                    }
                },
                error:function(){
                    Lobibox.notify('error', {
                        msg: 'Gagal Menambah Pekerjaan'
                    });
                }
            })
        }
    })



    $("#btn_save_skp_edit").click(function() {
        // body...
        var kegiatan      = $('#nkegiatan').val();
        var pk            = $('#nperjanjian_kerja').val();
        var ak_target     = $('#nak_target').val();
        var jenis         = $('#njenis').val();
        var jumlah        = $('#njumlah').val();
        var kualitas_mutu = $('#nkualitas_mutu').val();
        var satuan        = $('#nsatuan').val();
        var waktu         = $('#nwaktu').val();
        var biaya         = $('#nbiaya').val();
        var oid           = $('#oid').val();
        var before        = $('#before').val();
        var after         = $('#after').val();


        if (kegiatan.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Kegiatan tugas jabatan wajib diisi."
            });
        }
        else
        {
            var data_sender = {
                                    'kegiatan'      : kegiatan,
                                    'pk'            : pk,
                                    'jenis_skp'     : jenis,
                                    'ak_target'     : ak_target,
                                    'jumlah'        : jumlah,
                                    'satuan'        : satuan,
                                    'kualitas_mutu' : kualitas_mutu,
                                    'waktu'         : waktu,
                                    'biaya'         : biaya,
                                    'id'            : oid,
                                    'before'        : before,
                                    'after'         : after
                              };
            $.ajax({
                url :"<?php echo site_url();?>/skp/edit_skp_pegawai",
                type:"post",
                data:{data_sender : data_sender},
                beforeSend:function(){
                    $("#editData").modal('hide');
                    $("#loadprosess").modal('show');
                },
                success:function(msg){
                    var obj = jQuery.parseJSON (msg);
                    if (obj.status == 1)
                    {
                        Lobibox.notify('success', {
                            msg: obj.text
                            });
                        setTimeout(function(){
                            $("#loadprosess").modal('hide');
                            setTimeout(function(){
                                location.reload();
                            }, 1500);
                        }, 5000);
                    }
                    else
                    {
                        Lobibox.notify('success', {
                            msg: obj.text
                            });
                        setTimeout(function(){
                            $("#loadprosess").modal('hide');
                        }, 5000);
                    }
                },
                error:function(){
                    Lobibox.notify('error', {
                        msg: 'Gagal Menambah Pekerjaan'
                    });
                }
            })
        }
    })

});
</script>
