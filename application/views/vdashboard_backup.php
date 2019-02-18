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
                                <label>Pimpinan Tinggi Pratama (Eselon II) :</label>
                                <span id="ContentPlaceHolder1_lbl_eselon2"><?php echo $nama_eselon2;?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Administrator (Eselon III) :</label>
                                <span id="ContentPlaceHolder1_lbl_eselon3"><?php echo $nama_eselon3;?></span>
                            </div>
                            <div class="col-sm-6">
                                <label>Pengawas (Eselon IV) :</label>
                                <span id="ContentPlaceHolder1_lbl_eselon4"><?php echo $nama_eselon4;?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>NIP:</label>
                                <span id="ContentPlaceHolder1_lbl_nip"><?php echo $nip;?></span>
                            </div>
                            <div class="col-sm-6">
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
<?php
$nama_pegawai  = "";
$nama_jabatan  = "";
$nama_eselon1  = "";
$nama_eselon2  = "";
$nama_eselon3  = "";
$nama_eselon4  = "";
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
}
?>
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
    width:100%;
  height: auto;
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


<div class="col-md-12 tour-step tour1">

    <div class="col-lg-2">
        <!-- Profile links -->
        <div class="block">
            <div class="block">
                <div class="thumbnail">
                    <div class="thumb">
                        <!-- <img class="img_user" style="width: 100%;" src="http://sikerja.kemendagri.go.id/images/demo/users/<?php echo $this->session->userdata('sesNip');?>.jpg"> -->

            <?php
                if($infoPegawai != '')
                {
            ?>
            <?php
                    if ($infoPegawai[0]->photo == '-') {
                        # code...
            ?>
                        <div class="dropzone" id="dropzone_image" style="padding: 10px!important;border:none;">
                            <img style="width: 100%;height: 220px;padding-bottom: 15px;" src="http://mandarinpalace.fi/wp-content/uploads/2015/11/businessman.jpg">
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
                        <div class="dropzone" id="dropzone_image" style="padding: 10px!important;border:none;">
                            <img style="width: 100%;height: 220px;padding-bottom: 15px;" src="<?php echo base_url() . 'public/images/pegawai/'.$infoPegawai[0]->photo;?>">
                            <div class="dz-message" style="margin: 2em 0;">
                                <span> Klik atau Drop File Foto disini</span>
                            </div>
                        </div>
            <?php
                        }
                        else
                        {
            ?>
                        <div class="dropzone" id="dropzone_image" style="padding: 10px!important;border:none;">
                            <img style="width: 100%;height: 220px;padding-bottom: 15px;" src="http://sikerja.kemendagri.go.id/images/demo/users/<?php echo $infoPegawai[0]->photo;?>">
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
                        <img style="width: 100%;height: 220px;padding-bottom: 15px;" src="http://mandarinpalace.fi/wp-content/uploads/2015/11/businessman.jpg">
            <?php
                }
            ?>


                        <div class="thumb-options">

                        </div>
                    </div>
                    <div class="caption text-center" style="border-top: 1px solid rgba(0, 0, 0, 0.18);">
                        <h6>
                            <span id="ContentPlaceHolder1_lbl_nama" class="col-lg-12"><?php echo $nama_pegawai;?></span>
                            <small>
                                <span id="ContentPlaceHolder1_lbl_jabatan"><?php echo $nama_jabatan;?></span></small></h6>
                            <small>
                            <span id="ContentPlaceHolder1_lbl_typeuser">(Super Admin)</span></small>
                        <br><br>
                        <center>
                                <a  id="" class="btn btn-info" href="<?php echo site_url();?>/transaksi/home">
                                    <i class="fa fa-plus"></i> Tambah Data Kinerja
                                </a>
                        </center>
                    </div>
                </div>
            </div>

        </div>
        <!-- /profile links -->
    </div>

    <div>

    </div>

    <div class="col-lg-2 col-xs-8 tour-step tour2 btn-show-stat shrink" id="btn_masih_diproses">

        <div class="small-box bg-yellow" style="background-color: #febe29 !important;">
            <div class="inner">
                <h3><?php echo $belum_diperiksa;?></h3>
                <p>PEKERJAAN BELUM DIPERIKSA</p>
            </div>
            <div class="icon">
              <i class="fa fa-hourglass-end"></i>
            </div>

        </div>
    </div>

    <div class="col-lg-2 col-xs-8 tour-step tour3 btn-show-stat shrink" id="btn_diterima">

        <div class="small-box bg-navy" style="background-color: #3e5e9a !important;">
            <div class="inner">
              <h3><?php echo $disetujui;?></h3>
              <p>PEKERJAAN DISETUJUI</p>
            </div>
            <div class="icon">
              <i class="fa fa-thumbs-up"></i>
            </div>

        </div>
    </div>

    <div class="col-lg-2 col-xs-8 tour-step tour4 btn-show-stat shrink" id="btn_ditolak">

        <div class="small-box bg-green" style="background-color: #f1685e !important;">
            <div class="inner">
              <h3><?php echo $tolak;?></h3>
              <p>PEKERJAAN DITOLAK</p>
            </div>
            <div class="icon">
              <i class="fa fa-remove"></i>
            </div>

        </div>
    </div>

    <div class="col-lg-2 col-xs-8 tour-step tour4 btn-show-stat shrink" id="btn_perlu_direvisi">

        <div class="small-box bg-aqua" style="background-color: #4caf50 !important;">
            <div class="inner">
              <h3><?php echo $revisi;?></h3>
              <p>PEKERJAAN DIREVISI</p>
            </div>
            <div class="icon">
              <i class="fa fa-edit"></i>
            </div>

        </div>
    </div>

    <div class="col-lg-2 col-xs-8 tour-step tour4 btn-show-stat shrink" id="btn_perlu_direvisi">

        <div class="small-box bg-aqua" style="background-color: #9C27B0 !important;">
            <div class="inner">
              <?php
                $prosentase = "";
                if ($menit_efektif > 0) {
                    # code...
                    $prosentase = ($menit_efektif/6600)*100;
                }
                else
                {
                    $prosentase = 0;
                }
              ?>
              <h3 style="font-size: 30px;"><?php echo round($prosentase);?>%</h3>
              <p style="font-size: 12px;">PERSENTASE REALISASI MENIT KERJA EFEKTIF</p>
            </div>
            <div class="icon">
              <i class="fa fa-edit"></i>
            </div>

        </div>
    </div>


    <div class="col-lg-5 col-xs-8 tour-step tour4 btn-show-stat shrink" id="">

        <div class="small-box bg-aqua" style="background-color: #00BCD4 !important;">
            <div class="inner">
              <h3><?php echo number_format($menit_efektif);?></h3>
              <p>REALISASI MENIT KERJA EFEKTIF</p>
            </div>
            <div class="icon">
              <i class="fa fa-clock-o"></i>
            </div>

        </div>
    </div>


    <div class="col-lg-5 col-xs-8 tour-step tour4 btn-show-stat shrink" id="">

        <div class="small-box bg-aqua" style="background-color: #03f47f !important">
            <div class="inner">
              <h3><?php echo number_format($tunjangan);?></h3>
              <p>Tunjangan</p>
              <!-- <p>PERSENTASE REALISASI MENIT KERJA EFEKTIF</p> -->
            </div>
            <div class="icon">
            <i>Rp</i>
              <!-- <i class="fas fa money-bill-alt"></i> -->
            </div>

        </div>
    </div>

    <div class="col-lg-5 col-xs-8 tour-step tour4 btn-show-stat shrink" id="">

        <div class="small-box bg-aqua" style="background-color: #03f47f !important">
            <div class="inner">
              <h3>Capaian SKP</h3>
              <!-- <p>Tunjangan</p> -->
              <!-- <p>PERSENTASE REALISASI MENIT KERJA EFEKTIF</p> -->
            </div>
            <div class="icon">
            <i>%</i>
              <!-- <i class="fas fa money-bill-alt"></i> -->
            </div>

        </div>
    </div>

    <div class="col-lg-5 col-xs-8 tour-step tour4 btn-show-stat shrink" id="">

        <div class="small-box bg-aqua" style="background-color: #00BCD4 !important;">
            <div class="inner">
              <h3>FingerPrint</h3>
              <p></p>
            </div>
            <div class="icon">
              <i class="fa fa-clock-o"></i>
            </div>

        </div>
    </div>

</div>


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


<div class="col-lg-12 text-center">
    <div class="col-md-3 col-sm-6 tour-step tour7 centering">
        <div class="panel panel-kemendagri" id="persen" style="cursor:pointer;border-color: #009688;">
            <div class="panel-heading" style="background-color: #009688;border-color: #009688;"><i class="fa fa-money"></i> Persentase Menit kerja</div>
            <div class="panel-body" style="padding:5px;">
                <div id="demoWidget text-center" style="position: relative;">
                    <div id="gaugeContainer" class="shrink" style="margin:auto;"></div>
                    <div class="centering" id="gaugeValue" style="font-family: Sans-Serif; text-align: center; font-size: 20px; width: 70px;">
                    </div>
                </div>
           </div>
        </div>
    </div>
</div>

<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/knob/jquery.knob.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jqWidget/js/jqxchart.core.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jqWidget/js/jqxdata.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jqWidget/js/jqxcore.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jqWidget/js/jqxdraw.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jqWidget/js/jqxgauge.js"></script>
<script>

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
$(document).ready(function(){
    var is_user = $("#role").val();
    if (is_user == 4){
        $("#helpguide").modal('show');
    }

    var tour = new Tour({
        storage : false
    });

/**********************************************************************************/
    tour.addSteps([
      {
        element: ".tour-step.tour1",
        placement: "top",
        title: "Halaman Dashboard",
        content: "halaman ini menunjukan Informasi umum pekerjaan anda setiap bulan."
      },
      {
        element: ".tour-step.tour2",
        placement: "bottom",
        title: "Transaksi Proses",
        content: "Berisi jumlah transaksi yang masih diproses."
      },
      {
        element: ".tour-step.tour3",
        placement: "bottom",
        title: "Transaksi diterima",
        content: "Berisi jumlah transaksi yang sudah disetujui oleh atasan."
      },
      {
        element: ".tour-step.tour4",
        placement: "bottom",
        title: "Transaksi ditolak",
        content: "Berisi jumlah transaksi yang ditolak oleh atasan."
      },
      {
        element: ".tour-step.tour5",
        placement: "top",
        title: "Transaksi revisi",
        content: "Berisi jumlah transaksi yang perlu anda revisi."
      },
      {
        element: ".tour-step.tour6",
        placement: "top",
        title: "Transaksi keberatan",
        content: "Berisi jumlah transaksi yang anda ajukan keberatan."
      },
      {
        element: ".tour-step.tour7",
        placement: "left",
        title: "menit kerja efektif",
        content: "Berisi informasi total menit kerja, klik gambar untuk detail."
      },

    ]);


    // Initialize the tour
    tour.init();


/************************************************************************************************/

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
    $('#gaugeContainer').jqxGauge('value', <?php echo $prosentase;?>);
});
</script>
