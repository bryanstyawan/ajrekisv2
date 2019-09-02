<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SIKERJA | Sistem Penilaian Kinerja Aparatur</title>
	<!-- core CSS -->
    <link href="<?php echo base_url();?>assets_home/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets_home/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets_home/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets_home/css/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets_home/css/owl.transitions.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets_home/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets_home/css/main.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets_home/css/responsive.css" rel="stylesheet">
    <style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/lobibox/dist/css/Lobibox.min.css'; ?>");</style>    
    <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>assets_home/js/html5shiv.js"></script>
    <script src="<?php echo base_url();?>assets_home/js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets_home/logo.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url();?>assets_home/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url();?>assets_home/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url();?>assets_home/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url();?>assets_home/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body id="home" class="homepage">

    <header id="header">
        <nav id="main-menu" class="navbar navbar-default navbar-fixed-top" role="banner">
            <div class="container" style="width:95%;">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?=base_url();?>"><img src="<?php echo base_url();?>assets_home/logo.png" alt="logo" style="height: 58px;width: 140px;"></a>
                    <a class="navbar-brand" href="tel:0213524543">
                        <label class="col-lg-6" style="cursor: pointer;">Kontak</label>
                        <label class="col-lg-9" style="cursor: pointer;color: #000000;">
                            <i class="fa fa-phone"></i>&nbsp; (021) 3524543<br>
                            <i class="fa fa-phone"></i>&nbsp; 087884576154
                        </label>
                        
                    </a>
                    <a class="navbar-brand" href="tel:0213524543">
                        <label class="col-lg-6" style="cursor: pointer;">Layanan</label>
                        <label class="col-lg-10" style="cursor: pointer;color: #000000;"><i class="glyphicon glyphicon-envelope"></i>&nbsp;  kemendagri.sikerja@gmail.com</label>
                    </a>
                </div>

                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="scroll active"><a href="#home">Home</a></li>
                        <li class="scroll"><a href="#about">Tentang Sikerja</a></li>
                        <li class="scroll">
                            <a href="<?=base_url().'admin';?>">
                                <?php
                                    if ($this->session->userdata('login')) {
                                        // code...
                                        echo "<b>Masuk Aplikasi Sikerja</b>";
                                    }
                                    else {
                                        // code...
                                        echo "Masuk";
                                    }
                                ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
    </header><!--/header-->


    <section id="main-slider">
        <div class="owl-carousel">

            <!-- <div class="item" style="background-image: url(<?php echo base_url();?>assets_home/slider/bahan_paparan_terbaru.jpg);background-size: 100% 100%;height: 555px;">
                <div class="slider-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="carousel-content"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
			<div class="item" style="background-image: url(<?php echo base_url();?>assets_home/slider/muharam2019.gif);background-size: 100% 100%;height: 555px;">
                <div class="slider-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="carousel-content"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			
            <div class="item" style="background-image: url(<?php echo base_url();?>assets_home/slider/kememerdekaan2019.jpg);background-size: 100% 100%;height: 555px;">
                <div class="slider-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="carousel-content"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="item" style="background-image: url(<?php echo base_url();?>assets_home/slider/equal.jpg);background-size: 100% 100%;height: 555px;">
                <div class="slider-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="carousel-content"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
            
            <!-- <div class="item" style="background-image: url(<?php echo base_url();?>assets_home/slider/Rb2.jpg);background-size: 100% 100%;height: 555px;">
                <div class="slider-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="carousel-content"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item" style="background-image: url(<?php echo base_url();?>assets_home/slider/Rb3.jpg);background-size: 100% 100%;height: 555px;">
                <div class="slider-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="carousel-content"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item" style="background-image: url(<?php echo base_url();?>assets_home/slider/Rb4.jpg);background-size: 100% 100%;height: 555px;">
                <div class="slider-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="carousel-content"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

        </div><!--/.owl-carousel-->
    </section><!--/#main-slider-->

    <section id="about">
        <div class="container">

            <!-- <div class="row">
                <h2 class="column-title text-center">SUKSESKAN PEMILU SERENTAK 2019</h2>            
                <div class="col-sm-3">
                    
                    <video id="f_video" class="col-lg-12" style="height: 255px;" height="315" controls controlsList="nodownload">
                        <source id="f_source" src="<?php echo base_url();?>assets_home/video/pemilu/FILLER_PERMILU_SERENTAK_2019_-_3_MENIT.mp4" type="video/mp4">
                    </video>                    
                </div>

                <div class="col-sm-3">
                    
                    <video id="f_video" class="col-lg-12" style="height: 255px;" height="315" controls controlsList="nodownload">
                        <source id="f_source" src="<?php echo base_url();?>assets_home/video/pemilu/FILLER_PERMILU_SERENTAK_2019_-_60_DETIK.mp4" type="video/mp4">
                    </video>
                </div>

                <div class="col-sm-3">
                    
                    <video id="f_video" class="col-lg-12" style="height: 255px;" height="315" controls controlsList="nodownload">
                        <source id="f_source" src="<?php echo base_url();?>assets_home/video/pemilu/KEMENDAGRI_30_PREVIEW_4_HD.mp4" type="video/mp4">
                    </video>                    
                </div>

                <div class="col-sm-3">
                    
                    <video id="f_video" class="col-lg-12" style="height: 255px;" height="315" controls controlsList="nodownload">
                        <source id="f_source" src="<?php echo base_url();?>assets_home/video/pemilu/KEMENDAGRI_60_PREVIEW_6_PUSPEN-1.mp4" type="video/mp4">
                    </video>                    
                </div>                                                                
            </div>
            <br>                     -->

            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Tentang Sikerja</h2>
                <p class="text-center wow fadeInDown">Aplikasi berbasis web milik kementerian dalam negeri yang digunakan untuk melakukan penilaian dan pengukuran kinerja PNS berdasarkan instrumen analisis jabatan dan analisis beban kerja dan menjadi dasar perhitungan produktifitas kerja dalam pemberian tunjangan kinerja.</p>
            </div>

            <br>
            <div class="row">
                <div class="col-sm-6 wow fadeInLeft">
                    <h3 class="column-title">Video Intro</h3>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe width="420" height="315" src="https://www.youtube.com/embed/mef2bK7uYs0" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>

                <div class="col-sm-6 wow fadeInRight">
                    <h3 class="column-title">Deskripsi Umum Aplikasi</h3>
                    <p style="text-align: justify;">Biro kepegawaian melakukan monitoring dan evaluasi penilaian kinerja aparatur kementerian dalam negeri. Monitoring dan evaluasi dilakukan oleh tim monitoring dan evaluasi aplikasi Sikerja, yang ditetapkan dengan keputusan menteri dalam negeri, hasil monitoring dan evaluasi disampaikan kepada menteri dalam negeri melalui sekretaris jenderal sebagai bahan pengembangan aplikasi Sikerja, dalam pelaksanaan tugasnya, tim monitoring dan evaluasi aplikasi Sikerja didukung oleh tenaga ahli yang berkompeten di bidangnya.</p>

                    <!-- <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="nostyle">
                                <li><i class="fa fa-check-square"></i> Ipsum is simply dummy</li>
                                <li><i class="fa fa-check-square"></i> When an unknown</li>
                            </ul>
                        </div>

                        <div class="col-sm-6">
                            <ul class="nostyle">
                                <li><i class="fa fa-check-square"></i> The printing and typesetting</li>
                                <li><i class="fa fa-check-square"></i> Lorem Ipsum has been</li>
                            </ul>
                        </div>
                    </div> -->

                    <a href="<?=base_url().'admin';?>" class="btn btn-primary" href="#">Masuk</a>

                </div>
            </div>
        </div>
    </section><!--/#about-->

    <section id="features">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">SIKERJA SAAT INI</h2>
                <!-- <p class="text-center wow fadeInDown">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p> -->
            </div>
            <div class="row">
                <div class="col-sm-6 wow fadeInLeft">
                    <img class="img-responsive" src="<?php echo base_url();?>assets_home/images/main-feature.png" alt="">
                </div>
                <div class="col-sm-6">
                    <!-- <div class="media service-box wow fadeInRight">
                        <div class="pull-left">
                            <i class="fa fa-line-chart"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">User Friendly</h4>
                            <p>Backed by some of the biggest names in the industry, Firefox OS is an open platform that fosters greater</p>
                        </div>
                    </div> -->

                    <div class="media service-box wow fadeInRight">
                        <div class="pull-left">
                            <i class="fa fa-cubes"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">SKP</h4>
                            <p style="text-align: justify;">Sasaran Kinerja Pegawai (SKP) adalah rencana dan target kinerja yang harus dicapai oleh pegawai dalam kurun waktu penilaian yang bersifat nyata dan dapat diukur serta disepakati pegawai dan atasannya.</p>
                        </div>
                    </div>

                    <div class="media service-box wow fadeInRight">
                        <div class="pull-left">
                            <i class="fa fa-pie-chart"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">Tugas Tambahan dan Kreativitas</h4>
                            <p style="text-align: justify;">Selain melakukan kegiatan tugas pokok yang ada dalam SKP, seorang PNS dapat melaksanakan tugas lain atau tugas tambahan yang diberikan oleh atasannya
                              langsung dan dibuktikan dengan surat keterangan dibuat.</p>
                            <p style="text-align: justify;"> Tugas tambahan merupakan uraian tugas yang kita kerjakan tetapi tidak termasuk dalam perjanjian
                              uraian tugas SKP dengan.</p>
                        </div>
                    </div>

                    <div class="media service-box wow fadeInRight">
                        <div class="pull-left">
                            <i class="fa fa-pie-chart"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">Integrasi Transaksi sikerja lama dengan SKP</h4>
                            <p style="text-align: justify;">Setelah dilakukan pelaporan hasil pekerjaan pada transaksi, setelah disetujui oleh atasan langsung PNS tidak hanya mendapatkan Realisasi Menit Kerja Efektif, Persentase Realisasi
                              Menit Kerja Efektif dan Tunjangan Kinerja. Akan tetapi mendapatkan realisasi SKP berdasarkan rencana dan target SKP yang telah disepakati oleh atasan langsung.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta2">
        <div class="container">
            <div class="text-center">
                <img class="img-responsive wow fadeIn" src="<?php echo base_url();?>assets_home/images/cta2/cta2-img.png" alt="" data-wow-duration="300ms" data-wow-delay="300ms">
            </div>
        </div>
    </section>

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">EQUAL WORK DESERVES EQUAL PAY</h2>
                <!-- <p class="text-center wow fadeInDown">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p> -->
            </div>
        </div>
    </section><!--/#get-in-touch-->

    <section class="cta3" style="padding-top: 10px;padding-bottom: 10px;">
        <div class="container">
        <div class="container-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contact-form">
                            <h1 style="color: #fff;">HELP DESK</h1>
                            <address>
                              <strong>Kementerian Dalam Negeri, Biro Kepegawaian, Lt 3 Gedung D</strong><br>
                              Jl. Medan Merdeka Utara No. 7, RT. 5/RW. 2, Gambir, Kota Jakarta Pusat<br>
                              Daerah Khusus Ibukota Jakarta<br>
                              <abbr title="Phone">Telp:</abbr> (021) 3450038 <abbr title="Phone">Ext:</abbr> 2349 & 2355<br>
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (021) 3524543<br>
                              <abbr title="Whatsapp">Whatsapp:</abbr> 087884576154<br>
                              Email : kemendagri.sikerja@gmail.com
                            </address>
                        </div>
                    </div>
                    <!-- <div class="col-sm-6">
                        <div class="contact-form">
                            <h1 style="color: #fff;">HELP DESK</h1>
                            <address>
                              <strong>Kementerian Dalam Negeri, Biro Kepegawaian, Lt 3 Gedung D</strong><br>
                              Jl. Medan Merdeka Utara No. 7, RT. 5/RW. 2, Gambir, Kota Jakarta Pusat<br>
                              Daerah Khusus Ibukota Jakarta<br>
                              <abbr title="Phone">Telp:</abbr> (021) 3450038 <abbr title="Phone">Ext:</abbr> 2349 & 2355
                              Email : sikerja@kemendagri.go.id
                            </address>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        </div>
    </section>

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    &copy; 2018 Kementerian Dalam Negeri, Biro Kepegawaian - Pengembangan Karier. V.2.0.0-Alpha
                </div>
                <div class="col-sm-7 text-center">
                    <ul class="social-icons">
                        <li><a href="http://www.facebook.com/sikerja.kemendagri"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="http://twitter.com/sikerja"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="http://www.instagram.com/sikerjakemendagri/"><i class="fa fa-instagram"></i></a></li>
                        <!-- <li><a href="#"><i class="fa fa-youtube"></i></a></li> -->
                        <!-- <li><a href="#"><i class="fa fa-google-plus"></i></a></li> -->
                        <!-- <li><a href="#"><i class="fa fa-behance"></i></a></li> -->
                        <!-- <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li><a href="#"><i class="fa fa-flickr"></i></a></li> -->
                        <!-- <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-github"></i></a></li> -->
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

    <script src="<?php echo base_url();?>assets_home/js/jquery.js"></script>
    <script src="<?php echo base_url();?>assets_home/js/bootstrap.min.js"></script>
    <!-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script> -->
    <script src="<?php echo base_url();?>assets_home/js/owl.carousel.min.js"></script>
    <!-- <script src="<?php echo base_url();?>assets_home/js/mousescroll.js"></script> -->
    <!-- <script src="<?php echo base_url();?>assets_home/js/smoothscroll.js"></script> -->
    <script src="<?php echo base_url();?>assets_home/js/jquery.prettyPhoto.js"></script>
    <script src="<?php echo base_url();?>assets_home/js/jquery.isotope.min.js"></script>
    <script src="<?php echo base_url();?>assets_home/js/jquery.inview.min.js"></script>
    <script src="<?php echo base_url();?>assets_home/js/wow.min.js"></script>
    <script src="<?php echo base_url();?>assets_home/js/main.js"></script>
    <script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/lobibox/js/Lobibox.js"></script>
    <script>

        $(document).ready(function()
        {
            // Lobibox.window({
            //     title  : 'Pesan',
            //     content: '<div class="row" style="margin: 1px;"><h2>Terima Kasih Telah Menggunakan SIKERJA 3.0</h2></div>'+
            //     '<div class="row" style="margin: 1px;"><h3 style="text-align: JUSTIFY;">Selamat Datang di era SIKERJA 4.0 (Terintegrasi SKP)</h3></div>'                
            // });
        });
        
    </script>
</body>
</html>
