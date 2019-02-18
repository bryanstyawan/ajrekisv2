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
    <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>assets_home/js/html5shiv.js"></script>
    <script src="<?php echo base_url();?>assets_home/js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets_home/logo.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url();?>assets_home/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url();?>assets_home/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url();?>assets_home/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url();?>assets_home/images/ico/apple-touch-icon-57-precomposed.png">
		<style>
		@keyframes spinner {
			0% {
				transform: rotateZ(0deg);
			}
			100% {
				transform: rotateZ(359deg);
			}
		}
		* {
			box-sizing: border-box;
		}

		.wrapper {
			display: flex;
			align-items: center;
			flex-direction: column;
			justify-content: center;
			width: 100%;
			min-height: 100%;
			padding: 20px;
			/* margin-top: 160px; */
			/*background: rgba(61, 102, 189, 0.7);*/
		}

		.login {
			border-radius: 2px 2px 5px 5px;
			padding: 10px 20px 20px 20px;
			width: 90%;
			max-width: 320px;
			background: #ffffff;
			position: relative;
			padding-bottom: 1px;
			box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.3);
		}

		.header-login
		{
			border-radius: 12px 12px 0px 0px;
		    padding: 0px 20px 0px 20px;
		    width: 90%;
		    max-width: 320px;
		    position: relative;
		    box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.3);
		    background: #141d6c;
		}
		.header-login p
		{
			color : #fff;
		}

		.header-login h3
		{
		    color: #fff;
		    font-size: 23px;
		    margin: 17px;
		    margin-left: initial;
		}

		.login.loading button {
			max-height: 100%;
			padding-top: 50px;
		}
		.login.loading button .spinner {
			opacity: 1;
			top: 40%;
		}
		.login.ok button {
			background-color: #8bc34a;
		}
		.login.ok button .spinner {
			border-radius: 0;
			border-top-color: transparent;
			border-right-color: transparent;
			height: 20px;
			animation: none;
			transform: rotateZ(-45deg);
		}
		.login input {
			display: block;
			padding: 15px 10px;
			margin-bottom: 10px;
			width: 100%;
			border: 1px solid #ddd;
			transition: border-width 0.2s ease;
			border-radius: 2px;
			color: #ccc;
		}
		.login input + i.fa {
			color: #fff;
			font-size: 1em;
			position: absolute;
			margin-top: -47px;
			opacity: 0;
			left: 0;
			transition: all 0.1s ease-in;
		}
		.login input:focus {
			outline: none;
			color: #444;
			border-color: #FF7052;
			border-left-width: 35px;
		}
		.login input:focus + i.fa {
			opacity: 1;
			left: 30px;
			transition: all 0.25s ease-out;
		}
		.login a {
			font-size: 0.8em;
			color: #FF7052;
			text-decoration: none;
		}
		.login .title {
			color: #444;
			font-size: 1.2em;
			font-weight: bold;
			margin: 10px 0 30px 0;
			border-bottom: 1px solid #eee;
			padding-bottom: 20px;
		}

		.login button {
			/*
			width: 100%;
			height: 100%;
			margin-top: 20px;
			padding: 10px 10px;
			background: #fff;
			color: #FF7052;
			border: none;
			position: absolute;
			left: 0;
			bottom: 0;
			max-height: 60px;
			border: 0px solid rgba(0, 0, 0, 0.1);
			border-radius: 0 0 2px 2px;
			transform: rotateZ(0deg);
			transition: all 0.1s ease-out;
			border-bottom-width: 7px;
			*/
			width: 45px;
    		height: 45px;
			display: block;
			margin: 0 auto -15px auto;
			background: #fff;
		    border-radius: 100%;
		    border: 1px solid #FF7052;
		    color: #FF7052;
		    font-size: 24px;
		    cursor: pointer;
		    box-shadow: 0px 0px 0px 7px #fff;
		    transition: 0.2s ease-out;
		}

		.login button:hover {
			background: #FF7052;
			color: #fff;
		}

		.login button .spinner {
			display: block;
			width: 40px;
			height: 40px;
			position: absolute;
			border: 4px solid #ffffff;
			border-top-color: rgba(255, 255, 255, 0.3);
			border-radius: 100%;
			left: 50%;
			top: 0;
			opacity: 0;
			margin-left: -20px;
			margin-top: -20px;
			animation: spinner 0.6s infinite linear;
			transition: top 0.3s 0.3s ease, opacity 0.3s 0.3s ease, border-radius 0.3s ease;
			box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.2);
		}
		.login:not(.loading) button:hover {
			box-shadow: 0px 1px 3px #2196F3;
		}
		.login:not(.loading) button:focus {
			border-bottom-width: 4px;
		}

		footer {
			display: block;
			padding-top: 50px;
			text-align: center;
			color: #ddd;
			font-weight: normal;
			text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.2);
			font-size: 0.8em;
		}
		</style>
</head><!--/head-->

<body id="home" class="homepage" style="padding-top: 0px;">

    <section id="main-slider">
        <div>
            <div class="item" style="background-image: url(<?php echo base_url();?>assets_home/login/sikerja-asiangames.gif);background-size: 100% 100%;height: 639px;">
                <div class="slider-inner">
                    <div class="container">
                        <div class="row" style="height:520px;">
                            <div class="col-sm-12">
																<div class="item" style="background-image: url(<?php echo base_url();?>assets_home/login/kemendagri.png);background-size: 100% 100%;height: 542px;">
																	<div class="wrapper">
																		<div class="header-login">
																			<h3 align="center" class="title">SIKERJA</h3>
																		</div>
																		<form method="post" class="login" action="<?php site_url();?>Loginadmin/login" >
																			<input name="nip" id="username" type="text" placeholder="NIP" autofocus/>
																			<i class="fa fa-user"></i>
																			<input name="pass" id="password" type="password" placeholder="Password" />
																			<i class="fa fa-key"></i>
																			<button>
																				<i class="fa fa-long-arrow-right"></i>
																			</button>
																		</form>
																		<img src="<?php echo base_url();?>assets_home/login/logo%20sikerja.png" style="position:fixed;width:85%">
																	</div>
																</div>
                                <div class="carousel-content"></div>
                            </div>
                        </div>
												<div class="row">
													<div class="section-title text-center wow fadeInDown">
														<h2 style="color:#0A3F69;margin: 0px;">SUKSESKAN 18TH ASIAN GAMES 2018 JAKARTA-PALEMBANG</h2>
														<label class="text-center col-lg-12" style="margin:0px;">&copy; 2018 Kementerian Dalam Negeri, Biro Kepegawaian - Pengembangan Karier. All Right Reserved.</label>
														<label class="text-center col-lg-12">&copy; Version 4.0</label>
													</div>
												</div>
	                  </div>
                </div>
            </div>
        </div><!--/.owl-carousel-->
    </section><!--/#main-slider-->

    <!-- <section id="get-in-touch" style="padding-top: 0px!important;padding-bottom: 25px!important;background: #95CCD8;">
        <div class="container">
        </div>
    </section> -->
		<!--/#get-in-touch-->
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
</body>
</html>
