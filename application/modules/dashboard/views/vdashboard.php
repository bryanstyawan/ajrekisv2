<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/tabs-checked/css/style_tabs.css'; ?>");</style>
<?php
$data_menit = "";
$data_bulan[] = "";
$data_value []= "";
if ($menit_efektif_year != 0) {
    // code...
    for ($i=0; $i < count($menit_efektif_year); $i++) {
        // code...
        $data_bulan[$i] = $menit_efektif_year[$i]->nama_bulan;
        $data_value[$i] = $menit_efektif_year[$i]->menit_efektif;
    }

    $data_bulan = json_encode($data_bulan);
    $data_value = json_encode($data_value);
}
// echo '<pre>';
// print_r($data_bulan);
// echo '</pre>';
// die();
?>
<style>
.icon > i
{
    margin: 0px 0px 0px 25px;
    font-size: 52px;
    color: #fff;
    padding: 19px;
    border-radius: 50%;
}
</style>
<?php
$nama_pegawai  = "";
$nama_jabatan  = "";
$nama_eselon1  = "";
$nama_eselon2  = "";
$nama_eselon3  = "";
$nama_eselon4  = "";
$nama_agama    = '';
$nip           = "";
$kelas_jabatan = "";
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
    $nama_agama    = $infoPegawai[0]->nama_agama;
}
?>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.bundle.js"></script>

<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/dropzone-work/dropzone.min.css'; ?>");</style>
<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/dropzone-work/basic.min.css'; ?>");</style>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/dropzone-work/jquery.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/dropzone-work/dropzone.min.js"></script>
<style>
/* Makes images fully responsive */
#demoWidget{
    margin:auto;
}
.img-responsive,
.thumbnail > img,
.thumbnail a > img,
.carousel-inner > .item > img,
.carousel-inner > .item > a > img {
    display: block;
    width  : 100%;
    height : auto;
}


.label-info-pegawai
{
    margin: 10px 0px;
}
/* ------------------- Carousel Styling ------------------- */

.carousel-inner {
    border-radius: 0px;
    height:300px;
}

.carousel-caption {
    background-color: rgba(0,0,0,.5);
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 10;
    padding: 0 0 10px 25px;
    color: yellow;
    text-align: left;
}

.carousel-indicators {
    position: absolute;
    bottom: 0;
    right: 0;
    left: 0;
    width: 100%;
    z-index: 15;
    margin: 0;
    padding: 0 25px 25px 0;
    text-align: right;
}

.carousel-control.left,
.carousel-control.right {
    background-image: none;
}

.rotate:hover
{
    -webkit-transform: rotateZ(-30deg);
    -ms-transform: rotateZ(-30deg);
    transform: rotateZ(-30deg);
}

.shrink:hover
{
    -webkit-transform: scale(1.1);
    -ms-transform: scale(1.1);
    transform: scale(1.1);
}

/* ------------------- Section Styling - Not needed for carousel styling ------------------- */

.section-white {
    padding: 10px 0;
}

.section-white {
    background-color: #fff;
    color: #555;
}

@media screen and (min-width: 768px) {
    .section-white {
        padding: 1.5em 0;
    }
}

@media screen and (min-width: 992px) {
    .container {
        max-width: 930px;
    }
}
</style>
<input type="hidden" id="role" value="<?php echo $this->session->userdata('sesRole');?>">

<div class="col-md-12 tour-step tour1" id="main-dashboard">

    <div class="col-md-4">
        <div class="box box-widget widget-user">
            <div class="widget-user-header bg-aqua-active" style="height: 90%;max-height: 160px;">
                <h3 class="widget-user-username text-center" style="margin-bottom:10px;"><?php echo $nama_pegawai;?></h3>
                <h5 class="widget-user-desc text-center" style="height:75px;"><?php echo $nama_jabatan;?></h5>
            </div>
            <div class="widget-user-image text-center" style="left:43%!important;padding-top:10px;">
                <?php
                    if($infoPegawai != '')
                    {
                ?>
                <?php
                        if ($infoPegawai[0]->photo == '-') {
                            # code...
                ?>
                            <div class="dropzone" id="dropzone_image" style="padding: 0px!important;border:none;background: transparent;">
                                <img style="width: 160px;height: 160px;border-radius:50%;" src="<?php echo base_url() . 'assets/images/businessman1.jpg';?>">
                                <div class="dz-message" style="margin: 2em 0;">
                                    <span> Klik atau Drop File Foto disini</span>
                                </div>
                            </div>
                <?php
                        }
                        else
                        {
                            if ($infoPegawai[0]->local == 1) {
                                # code...
                ?>
                            <div class="dropzone" id="dropzone_image" style="padding: 0px!important;border:none;background: transparent;">
                                <img style="width: 160px;height: 160px;border-radius:50%;" src="<?php echo base_url() . 'public/images/pegawai/'.$infoPegawai[0]->photo;?>">
                                <div class="dz-message" style="margin: 2em 0;">
                                    <span> Klik atau Drop File Foto disini</span>
                                </div>
                            </div>
                <?php
                            }
                            else
                            {
                ?>
                            <div class="dropzone" id="dropzone_image" style="padding: 0px!important;border:none;background: transparent;">
                                <img style="width: 160px;height: 160px;border-radius:50%;" src="http://sikerja.kemendagri.go.id/images/demo/users/<?php echo $infoPegawai[0]->photo;?>">
                                <div class="dz-message" style="margin: 2em 0;">
                                    <span> Klik atau Drop File Foto disini</span>
                                </div>
                            </div>
                <?php
                            }
                        }
                    }
                    else
                    {
                ?>
                            <img style="width: 160px;height: 160px;border-radius:50%;" src="http://mandarinpalace.fi/wp-content/uploads/2015/11/businessman.jpg">
                <?php
                    }
                ?>
            </div>
            <div style="height: 255px;max-height: 255px;">
                <div class="caption text-center" style="border-top: 1px solid rgba(0, 0, 0, 0.18);padding-top:140px;">
                    <!-- <small><span id="ContentPlaceHolder1_lbl_typeuser">(Super Admin)</span></small> -->
                    <center style="padding:10px 0px;">
                    <a  id="" class="btn btn-info" href="<?php echo site_url();?>/transaksi/home">
                        <i class="fa fa-plus"></i> Tambah Data Kinerja
                    </a>
                    </center>
                </div>
                <span class="col-lg-6" style="padding-top:20px;">
                    <a class="btn btn-md btn-success pull-left" id="btn-detail"><i class="fa fa-info"></i> Informasi Pegawai</a>
                </span>
                <span class="col-lg-6" style="padding-top:20px;">
                    <a class="btn btn-md btn-warning pull-right" onclick="change_profile('profile')"><i class="fa fa-gear"></i> Ubah Data Pribadi</a>
                </span>
            </div>
        </div>
    <!-- /.widget-user -->
    </div>

    <div class="col-md-3 text-center">
        <div class="col-md-12 col-sm-6 tour-step tour7 centering">
            <div class="panel panel-kemendagri" id="persen" style="cursor:pointer;border-color: #00a7d0;height:415px;">
                <div class="panel-heading" style="background-color: #00a7d0;border-color: #00a7d0;">Persentase Menit kerja</div>
                <div class="panel-body" style="padding:0px;">
                    <div class="col-lg-12 col-xs-8 tour-step tour4 btn-show-stat shrink" id="btn_perlu_direvisi" style="height:100%!important;padding:0px;">
                        <div class="small-box bg-aqua" style="background-color: #9C27B0 !important;margin-bottom:12px;">
                            <div class="inner" style="padding: 30px;">
                                <h3 style="font-size: 30px;"><?=round($data_transaksi[0]->real_prosentase);?>%</h3>
                                <p style="font-size: 12px;">PERSENTASE REALISASI MENIT KERJA EFEKTIF</p>
                            </div>
                        </div>
                    </div>
                    <div id="demoWidget text-center" style="position: relative;padding:60px 0px;">
                        <div id="gaugeContainer" class="shrink" style="margin:auto;"></div>
                        <div class="centering" id="gaugeValue" style="font-family: Sans-Serif; text-align: center; font-size: 20px; width: 70px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5" style="height:415px;max-height: 415px;margin-bottom:25px;">
        <!-- LINE CHART -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Pencapaian Menit Efektif <?=date('Y');?></h3>
            </div>
            <div class="box-body chart-responsive" style="height: 371px;">
                <canvas id="canvas"></canvas>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

    <div class="col-lg-3 col-xs-8 tour-step tour2 btn-show-stat shrink" id="btn_masih_diproses">

        <div class="small-box" style="background-color: #d2d6de !important">
            <div class="icon">
                <i class="fa fa-hourglass-end" style="background-color: #00a7d0;"></i>
            </div>
            <div class="inner">
                <h3><?php echo $belum_diperiksa;?></h3>
            </div>
            <div class="inner col-lg-7">
                <p>PEKERJAAN BELUM DIPERIKSA</p>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-xs-8 tour-step tour4 btn-show-stat shrink" id="btn_realisasi_menit_efektif">
        <div class="small-box" style="background-color: #d2d6de !important">
            <div class="icon">
                <i class="fa fa-clock-o" style="background-color: #673AB7;"></i>
            </div>
            <div class="inner">
                <h3><?php echo number_format($data_transaksi[0]->menit_efektif);?></h3>
            </div>
            <div class="inner col-lg-7">
                <p>REALISASI MENIT KERJA EFEKTIF</p>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-xs-8 tour-step tour4 btn-show-stat shrink" id="">
        <div class="small-box" style="background-color: #d2d6de !important">
            <div class="icon">
                <i style="background-color: #00a7d0;font-size: 43px;">Rp</i>
            </div>
            <div class="inner">
                <h3><?php echo number_format($data_transaksi[0]->real_tunjangan_kinerja);?></h3>
            </div>
            <div class="inner col-lg-7 text-uppercase">
                <p>Tunjangan</p>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-xs-8 tour-step tour4 btn-show-stat shrink" id="">
        <div class="small-box" style="background-color: #d2d6de !important;">
            <div class="icon">
            <i class="fa fa-clock-o" style="background-color: #673AB7;"></i>
            </div>
            <div class="inner">
                <h3>0</h3>
            </div>
            <div class="inner col-lg-7 text-uppercase">
                <p>FingerPrint</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-xs-8 tour-step tour4 btn-show-stat shrink" id="">
        <div class="small-box" style="background-color: #d2d6de !important">
            <div class="icon">
                <i style="background-color: #00a7d0;font-size: 43px;">%</i>
            </div>
            <div class="inner">
                <h3><?=$skp['persentase_target_realisasi']->persentase;?></h3>
                <label><?=$skp['persentase_target_realisasi']->total_target_kuantitas.' / '.$skp['persentase_target_realisasi']->total_realisasi_kuantitas;?></label>
            </div>
            <div class="inner text-uppercase">
                <p>Capaian SKP</p>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12" id="profile-dashboard">

    <div class="col-md-4">
        <div class="box box-widget widget-user">
            <div class="widget-user-header bg-aqua-active" style="height: 100%;max-height: 160px;">
                <h3 class="widget-user-username text-center" style="margin-bottom:10px;"><?php echo $nama_pegawai;?></h3>
                <h5 class="widget-user-desc text-center" style="height:75px;"><?php echo $nama_jabatan;?></h5>
            </div>
            <div class="widget-user-image text-center" style="left:43%!important;padding-top:10px;">
                <?php
                    if($infoPegawai != '')
                    {
                ?>
                <?php
                        if ($infoPegawai[0]->photo == '-') {
                            # code...
                ?>
                            <div class="dropzone" id="dropzone_image" style="padding: 0px!important;border:none;background: transparent;">
                                <img style="width: 160px;height: 160px;border-radius:50%;" src="<?php echo base_url() . 'assets/images/businessman1.jpg';?>">
                                <div class="dz-message" style="margin: 2em 0;">
                                    <span> Klik atau Drop File Foto disini</span>
                                </div>
                            </div>
                <?php
                        }
                        else
                        {
                            if ($infoPegawai[0]->local == 1) {
                                # code...
                ?>
                            <div class="dropzone" id="dropzone_image" style="padding: 0px!important;border:none;background: transparent;">
                                <img style="width: 160px;height: 160px;border-radius:50%;" src="<?php echo base_url() . 'public/images/pegawai/'.$infoPegawai[0]->photo;?>">
                                <div class="dz-message" style="margin: 2em 0;">
                                    <span> Klik atau Drop File Foto disini</span>
                                </div>
                            </div>
                <?php
                            }
                            else
                            {
                ?>
                            <div class="dropzone" id="dropzone_image" style="padding: 0px!important;border:none;background: transparent;">
                                <img style="width: 160px;height: 160px;border-radius:50%;" src="http://sikerja.kemendagri.go.id/images/demo/users/<?php echo $infoPegawai[0]->photo;?>">
                                <div class="dz-message" style="margin: 2em 0;">
                                    <span> Klik atau Drop File Foto disini</span>
                                </div>
                            </div>
                <?php
                            }
                        }
                    }
                    else
                    {
                ?>
                            <img style="width: 160px;height: 160px;border-radius:50%;" src="http://mandarinpalace.fi/wp-content/uploads/2015/11/businessman.jpg">
                <?php
                    }
                ?>
            </div>
            <div style="height: 255px;max-height: 255px;">
                <div class="caption text-center" style="border-top: 1px solid rgba(0, 0, 0, 0.18);padding-top:140px;">
                    <!-- <small><span id="ContentPlaceHolder1_lbl_typeuser">(Super Admin)</span></small> -->
                    <center style="padding:10px 0px;">
                    <a id="" class="btn btn-info" href="<?php echo site_url();?>/transaksi/home">
                        <i class="fa fa-plus"></i> Tambah Data Kinerja
                    </a>
                    </center>
                </div>
                <span class="col-lg-6" style="padding-top:20px;">
                    <a class="btn btn-md btn-success pull-left" id="btn-detail"><i class="fa fa-info"></i> Informasi Pegawai</a>
                </span>
                <span class="col-lg-6" style="padding-top:20px;">
                    <a class="btn btn-md btn-warning pull-right" onclick="change_profile('main')"><i class="fa fa-gear"></i> Ubah Data Pribadi</a>
                </span>
            </div>
        </div>
    <!-- /.widget-user -->
    </div>

    <div class="col-md-8">
        <div class="container">
            <div class="box">
                <div class="box-body">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#profile">Profil</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#Kompetensi">
                                Kompetensi&nbsp;&nbsp;
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#history_golongan">
                                History Golongan/Pangkat&nbsp;&nbsp;
                            </a>
                        </li>                        
                    </ul>

                    <div class="tab-content">

                        <div id="profile" class="tab-pane fade in active">
                            <div class="col-lg-12">

                                <div class="box box-default">
                                    <div class="box-body">
                                        <div class="row">

                                            <div class="form-group col-md-6">
                                                <label style="color: #000;font-weight: 400;font-size: 19px;">Email</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    <input type="email" id="profile-email" name="profile-email" class="form-control" value="<?=$infoPegawai[0]->email;?>">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label style="color: #000;font-weight: 400;font-size: 19px;">Nomor Telepon</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    <input type="number" id="profile-telepon" name="profile-telepon" class="form-control" value="<?=$infoPegawai[0]->no_hp;?>">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group col-md-12">
                                                <label style="color: #000;font-weight: 400;font-size: 19px;">Alamat</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    <textarea class="form-control" id="profile-alamat" name="profile-alamat"><?=$infoPegawai[0]->alamat;?></textarea>
                                                </div>
                                            </div>                                            

                                            <div class="form-group col-md-12">
                                                <label style="color: #000;font-weight: 400;font-size: 19px;">Agama</label>
                                                <select class="form-control tour-step step1" name="profile-agama" id="profile-agama">
                                                    <option value="">Pilih Agama</option>
                                                    <?php
                                                        $selected = "";                                                    
                                                        if ($agama != '') {
                                                            # code...
                                                            for ($i=0; $i < count($agama); $i++) { 
                                                                # code...
                                                                if ($agama[$i]['nama_agama'] == $nama_agama) {
                                                                    # code...
                                                                    $selected = 'selected';
                                                                }
                                                                else {
                                                                    # code...
                                                                    $selected = '';
                                                                }
                                                    ?>
                                                                <option value="<?=$agama[$i]['id_agama'];?>" <?=$selected;?>><?=$agama[$i]['nama_agama'];?></option>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label style="color: #000;font-weight: 400;font-size: 19px;">Golongan/Pangkat</label>
                                                <select class="form-control tour-step step1" name="profile-golongan" id="profile-golongan">
                                                    <option value="">Pilih Golongan/Pangkat</option>
                                                    <?php
                                                        $selected = "";
                                                        if ($golongan) {
                                                            # code...
                                                            for ($i=0; $i < count($golongan); $i++) { 
                                                                # code...
                                                                if ($golongan[$i]['id'] == $infoPegawai[0]->golongan) {
                                                                    # code...
                                                                    $selected = 'selected';
                                                                }
                                                                else
                                                                {
                                                                    $selected = '';
                                                                }
                                                    ?>
                                                                <option value="<?=$golongan[$i]['id'];?>" <?=$selected;?>><?=$golongan[$i]['nama_pangkat'];?></option>                                                                
                                                    <?php
                                                            }
                                                        }
                                                    ?>

                                                </select>
                                            </div>                                            

                                            <div class="form-group col-md-6">
                                                <label style="color: #000;font-weight: 400;font-size: 19px;">TMT Golongan/Pangkat</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    <input type="text" id="profile-tmt-golongan" name="profile-tmt-golongan" class="form-control timerange" value="<?php if($infoPegawai[0]->tmt_golongan == 0 || $infoPegawai[0]->tmt_golongan == ''){echo '';}else echo date("d-m-y",strtotime($infoPegawai[0]->tmt_golongan));?>">
                                                </div>
                                            </div>                                            

                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <a class="btn btn-info pull-right" id="btn-save-profile">
                                            <i class="fa fa-save"></i> Simpan
                                        </a>                                        
                                    </div>
                                </div>


                            </div>
                        </div>                        
                        <div id="Kompetensi" class="tab-pane fade" style="padding-top: 15px;">
                            <div class="col-lg-12">
                                <div class="box box-default">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label style="color: #000;font-weight: 400;font-size: 19px;">Kompetensi</label>
                                                <input type="text" class="form-control" id="kompetensi_nama">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label style="color: #000;font-weight: 400;font-size: 19px;">Keterangan</label>
                                                <textarea class="form-control" id="kompetensi_keterangan"></textarea>
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <div class="row">
                                            <a class="btn btn-info pull-right" id="btn-save-kompetensi">
                                                <i class="fa fa-save"></i> Simpan
                                            </a>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="col-lg-12">
                                            <table class="table table-bordered table-striped table-view">
                                                <thead>
                                                    <tr>
                                                        <th>Kompetensi</th>
                                                        <th>Keterangan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table_content">
                                                    <?php
                                                        if ($info_kompetensi != 0) {
                                                            # code...
                                                            for ($i=0; $i < count($info_kompetensi); $i++) { 
                                                                # code...
                                                    ?>
                                                                <tr>
                                                                    <td><?=$info_kompetensi[$i]['kompetensi'];?></td>
                                                                    <td><?=$info_kompetensi[$i]['keterangan'];?></td>
                                                                    <td>
                                                                        <a class="btn btn-danger" onclick="delete_kompetensi('<?=$info_kompetensi[$i]['id'];?>')"><i class="fa fa-trash"></i></a>
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
                                </div>
                            </div>
                        </div>
                        <div id="history_golongan" class="tab-pane fade" style="padding-top: 15px;">
                            <div class="col-lg-12">
                                <div class="box box-default">
                                    <div class="box-body">
                                        <div class="col-lg-12">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Golongan</th>
                                                        <th>TMT Golongan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table_content">
                                                    <?php
                                                        if ($history_golongan != 0) {
                                                            # code...
                                                            for ($i=0; $i < count($history_golongan); $i++) { 
                                                                # code...
                                                    ?>
                                                                <tr>
                                                                    <td><?=$history_golongan[$i]->nama_pangkat;?></td>
                                                                    <td><?=$history_golongan[$i]->tmt;?></td>
                                                                    <td></td>                                                                                                                                        
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
            </div>
        </div>
    </div>

</div>

<div class="example-modal">
    <div class="modal modal-success fade" id="modal-info-pegawai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="box-content">

            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header"><h3 class="heading-hr text-center"><i class="icon-user"></i>INFORMASI PEGAWAI</h3></div>
                    <div class="modal-body" style="background-color: #fff!important;color:#000!important;">
                        <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 ml-auto label-info-pegawai">
                                <label>Pimpinan Tinggi Madya (Eselon I) :</label>
                                <span id="ContentPlaceHolder1_lbl_eselon1"><?php echo $nama_eselon1;?></span>
                            </div>

                            <div class="col-md-6 ml-auto label-info-pegawai">
                                <label>Pimpinan Tinggi Pratama (Eselon II) :</label>
                                <span id="ContentPlaceHolder1_lbl_eselon2"><?php echo $nama_eselon2;?></span>
                            </div>

                            <div class="col-md-6 ml-auto label-info-pegawai">
                                <label>Administrator (Eselon III) :</label>
                                <span id="ContentPlaceHolder1_lbl_eselon3"><?php echo $nama_eselon3;?></span>
                            </div>

                            <div class="col-md-6 ml-auto label-info-pegawai">
                                <label>Pengawas (Eselon IV) :</label>
                                <span id="ContentPlaceHolder1_lbl_eselon4"><?php echo $nama_eselon4;?></span>
                            </div>

                            <div class="col-md-6 ml-auto label-info-pegawai">
                                <label>NIP:</label>
                                <span id="ContentPlaceHolder1_lbl_nip"><?php echo $nip;?></span>
                            </div>

                            <div class="col-md-6 ml-auto label-info-pegawai">
                                <label>Kelas Jabatan:</label>
                                <span id="ContentPlaceHolder1_lbl_klsjabatan"><?php echo $kelas_jabatan;?></span>
                            </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ---------------------------------------------------------------------------- -->
<div class="example-modal">
    <div class="modal modal-success fade" id="modal-transaksi-proses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="box-content">

            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header"><h3 class="heading-hr text-center text-uppercase"><i class="icon-user"></i>Pekerjaan Belum Selesai</h3></div>
                    <div class="modal-body" style="background-color: #fff!important;color:#000!important;">
                        <div class="container-fluid" id="get-datatable">
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ---------------------------------------------------------------------------- -->
<div class="example-modal">
    <div class="modal modal-success fade" id="modal-transaksi-realisasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="box-content">

            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header"><h3 class="heading-hr text-center text-uppercase"><i class="icon-user"></i>Realisasi Menit Kerja Efektif</h3></div>
                    <div class="modal-body" style="background-color: #fff!important;color:#000!important;">
                        <div class="container-fluid" id="get-datatable1">
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ---------------------------------------------------------------------------- -->



<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/knob/jquery.knob.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jqWidget/js/jqxchart.core.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jqWidget/js/jqxdata.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jqWidget/js/jqxcore.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jqWidget/js/jqxdraw.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jqWidget/js/jqxgauge.js"></script>
<script>
    /** ----------------------------------------------------------------------- */
    $("#profile-dashboard").hide();  
    var VALUES = '<?=$data_value;?>';
    var MONTHS = '<?=$data_bulan;?>';
    console.log(jQuery.parseJSON (VALUES));
    var config = {
        type: 'line',
        data: {
            labels: jQuery.parseJSON (MONTHS),
            datasets: [{
                label: 'Menit Efektif',
                data: jQuery.parseJSON (VALUES),
                fill: false,
            }]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Bulan'
                }
                }],
                yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Menit Efektif'
                }
                }]
            }
        }
    };

    window.onload = function() {
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myLine = new Chart(ctx, config);
    };

    /** ----------------------------------------------------------------------- */    
    if (document.getElementById('dropzone_image')) {
        // other code here
        Dropzone.autoDiscover = false;
        var foto_upload= new Dropzone("div#dropzone_image",{
            url: "<?php echo site_url();?>/master/data_pegawai/unggah_foto_pegawai_self",
            maxFilesize: 2,
            method:"post",
            acceptedFiles:"image/*",
            paramName:"userfile",
            dictInvalidFileType:"Type file ini tidak dizinkan",
            addRemoveLinks:true,
            thumbnailWidth: null,
            thumbnailHeight: null,
            init: function() {
                this.on("thumbnail", function(file, dataUrl) {
                    $('.dz-image').last().find('img').attr({width: '100%', height: '100%'});
                }),
                this.on("success", function(file) {
                    $('.dz-image').css({"width":"100%", "height":"auto"});
                })
            }
        });

        foto_upload.on("processing",function(a){
            $("#loadprosess").modal('show');
        });

        foto_upload.on("sending",function(a,b,c){
            a.token =$('#oidPegawai').val();
            c.append("token_foto",a.token); //Menmpersiapkan token untuk masing masing foto
        });

        foto_upload.on("success",function(a){
            setTimeout(function(){
                $("#loadprosess").modal('hide');
                setTimeout(function(){
                    location.reload();
                }, 1500);
            }, 5000);
        });
    }

    /** ----------------------------------------------------------------------- */    
    $(document).ready(function(){        
        $('#gaugeContainer').jqxGauge({
                    ranges: [{ startValue: 0, endValue: 25, style: { fill: '#4bb648', stroke: '#4bb648' }, endWidth: 5, startWidth: 1 },
                            { startValue: 25, endValue: 50, style: { fill: '#fbd109', stroke: '#fbd109' }, endWidth: 10, startWidth: 5 },
                            { startValue: 50, endValue: 75, style: { fill: '#ff8000', stroke: '#ff8000' }, endWidth: 13, startWidth: 10 },
                            { startValue: 75, endValue: 100, style: { fill: '#e02629', stroke: '#e02629' }, endWidth: 16, startWidth: 13 }],
                    ticksMinor: { interval: 1, size: '5%' },
                    ticksMajor: { interval: 5, size: '10%' },
                    value: 0,
                    colorScheme: 'scheme05',
                    animationDuration: 1200,
                    width:200,
                    height:200,
                    max:100,
                });
        $('#gaugeContainer').jqxGauge('value', <?php echo $data_transaksi[0]->real_prosentase;?>);

        $("#btn-detail").click(function()
        {
            $("#modal-info-pegawai").modal('show');
        });

        $("#btn_masih_diproses").click(function() 
        {
            $.ajax({
                url :"<?php echo site_url()?>dashboard/get_datamodal_transaksi/0",
                type:"post",
                beforeSend:function(){
                    $("#loadprosess").modal('show');
                    $('.table-view').dataTable().remove();                    
                },
                success:function(msg){
                    $("#get-datatable").html(msg);					
                    $("#modal-transaksi-proses").modal('show');
                    $("#loadprosess").modal('hide');							
                }
            })		            				
        })

        $("#btn_realisasi_menit_efektif").click(function() 
        {
            $.ajax({
                url :"<?php echo site_url()?>dashboard/get_datamodal_transaksi/1",
                type:"post",
                beforeSend:function(){
                    $("#loadprosess").modal('show');
                    $('.table-view').dataTable().remove();                    
                },
                success:function(msg){
                    $("#get-datatable1").html(msg);					
                    $("#modal-transaksi-realisasi").modal('show');
                    $("#loadprosess").modal('hide');							
                }
            })		            				
        })

        $("#btn-save-profile").click(function()
        {
            var email        = $('#profile-email').val();
            var telepon      = $('#profile-telepon').val();
            var alamat       = $('#profile-alamat').val();
            var agama        = $('#profile-agama').val();
            var golongan     = $('#profile-golongan').val();
            var tmt_golongan = change_format_date($('#profile-tmt-golongan').val(),'yyyy-mm-dd');
            var flag_send    = 1;

            if(
                email.length        <= 0 &&
                telepon.length      <= 0 &&
                alamat.length       <= 0 &&
                agama.length        <= 0 &&
                golongan.length     <= 0 &&
                tmt_golongan.length <= 0
            )
            {
                Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                {
                    msg: "Tidak ada data yang disimpan."
                });                    
            }
            else
            {

                if (golongan.length <= 0) {
                    if (tmt_golongan.length <= 0) {
                        flag_send = 1;        
                    }
                    else
                    {
                        flag_send = 0;
                        Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                        {
                            msg: "TMT Golongan/Pangkat wajib diisi jika mengisi Golongan/Pangkat."
                        });                    
                    }
                }

                if (tmt_golongan.length <= 0) {
                    if (golongan.length <= 0) {
                        flag_send = 1;        
                    }
                    else
                    {
                        flag_send = 0;
                        Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                        {
                            msg: "Golongan/Pangkat wajib diisi jika mengisi TMT Golongan/Pangkat."
                        });                    
                    }
                }      

                if (email.length <= 0) {
                    flag_send = 1;
                }
                else
                {
                    if (validateEmail(email) == true) {
                        flag_send = 1;
                    } else {
                        flag_send = 0;
                            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                            {
                                msg: "Format email tidak valid."
                            });                  
                    }  
                }    

                data_sender = {
                                'golongan'    : golongan,
                                'tmt_golongan': tmt_golongan,
                                'agama'       : agama,
                                'alamat'      : alamat,
                                'no_hp'       : telepon,
                                'email'       : email
                }

                if (flag_send == 1) {
                    $.ajax({
                        url :"<?php echo site_url();?>dashboard/update_profile/",
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
                                msg: 'Gagal melakukan transaksi'
                            });
                        }
                    })                
                }
            }
        });     
        
        $("#btn-save-kompetensi").click(function()
        {
            var kompetensi = $('#kompetensi_nama').val();
            var keterangan = $('#kompetensi_keterangan').val();
            var flag_send  = 1;

            if(
                kompetensi.length <= 0 &&
                keterangan.length <= 0
            )
            {
                Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                {
                    msg: "Tidak ada data yang disimpan."
                });                    
            }
            else
            {
                data_sender = {
                                'kompetensi': kompetensi,
                                'keterangan': keterangan
                }

                $.ajax({
                    url :"<?php echo site_url();?>dashboard/update_kompetensi/",
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
                            msg: 'Gagal melakukan transaksi'
                        });
                    }
                })                
            }
        });             
    });

    /** ----------------------------------------------------------------------- */
    function change_profile(param) {
        if (param == 'profile') {
            $("#loadprosess").modal('show');  
            $("#main-dashboard").hide();
            $("#profile-dashboard").show();                
            $("#loadprosess").modal('hide');   
        } else if(param == 'main')
        {
            $("#loadprosess").modal('show');  
            $("#profile-dashboard").hide();                
            $("#main-dashboard").show();  
            $("#loadprosess").modal('hide');            
        }
    }
    
    /* jQuery Validate Emails with Regex */
    function validateEmail(Email) {
        var pattern = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

        return $.trim(Email).match(pattern) ? true : false;
    }    

    function delete_kompetensi(id) {
        // body...
        Lobibox.confirm({
            title: "Konfirmasi",
            msg: "Anda yakin akan menghapus data kompetensi ini ?",
            callback: function ($this, type) {
                if (type === 'yes'){
                    $.ajax({
                        url :"<?php echo site_url()?>dashboard/get_delete_kompetensi/"+id,
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
                                msg: 'Gagal Melakukan Hapus data'
                            });
                        }
                    })
                }
            }
        })
    }    
</script>
