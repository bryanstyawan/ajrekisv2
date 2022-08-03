<!-- Jquery -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<style type="text/css">@import url("<?php echo base_url() . 'assets/bootstrap/css/bootstrap.min.css'; ?>");</style>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/loadme/style/loadme.css'; ?>");</style>
<!-- Lobi box -->
<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/lobibox/dist/css/Lobibox.min.css'; ?>");</style>
<script type='text/javascript' src="https://gribot.radyalabs.id/assets/css/main.css"></script>
<style>


@import url('https://fonts.googleapis.com/css?family=Poppins');

/* BASIC */

a {
	color: #92badd;
	display:inline-block;
	text-decoration: none;
	font-weight: 400;
}

/* STRUCTURE */

.wrapper {
	display: flex;
	align-items: center;
	flex-direction: column; 
	justify-content: center;
	width: 100%;
	min-height: 100%;
	padding: 20px;
	padding-top:0px;
}

#formContent {
	/* 
	background: #fff;
	-webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
	box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);		
	*/
	-webkit-border-radius: 10px 10px 10px 10px;
	border-radius: 10px 10px 10px 10px;
	padding: 30px;
	width: 90%;
	max-width: 450px;
	position: relative;
	padding: 0px;
	text-align: center;
}

#formFooter {
	/* background-color: #f6f6f6; */
	border-top: 1px solid #dce8f1;
	padding: 25px;
	text-align: center;
	-webkit-border-radius: 0 0 10px 10px;
	border-radius: 0 0 10px 10px;
}



/* TABS */

h2 {
	text-align: center;
	font-size: 16px;
	font-weight: 600;
	text-transform: uppercase;
	display:inline-block;
	margin: 40px 8px 10px 8px; 
	color: #cccccc;
}

h2.inactive {
	color: #cccccc;
}

h2.active {
	color: #0d0d0d;
	border-bottom: 2px solid #5fbae9;
}



/* FORM TYPOGRAPHY*/

input[type=button], input[type=submit], input[type=reset], button  {
	background-color: #56baed;
	border: none;
	color: white;
	padding: 15px 80px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	text-transform: uppercase;
	font-size: 13px;
	-webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
	box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
	-webkit-border-radius: 5px 5px 5px 5px;
	border-radius: 5px 5px 5px 5px;
	margin: 5px 20px 40px 20px;
	-webkit-transition: all 0.3s ease-in-out;
	-moz-transition: all 0.3s ease-in-out;
	-ms-transition: all 0.3s ease-in-out;
	-o-transition: all 0.3s ease-in-out;
	transition: all 0.3s ease-in-out;
}

input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover,button:hover  {
	background-color: #39ace7;
}

input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
	-moz-transform: scale(0.95);
	-webkit-transform: scale(0.95);
	-o-transform: scale(0.95);
	-ms-transform: scale(0.95);
	transform: scale(0.95);
}

input[type=text],input[type=password] {
	background-color: #f6f6f6;
	border: none;
	color: #0d0d0d;
	padding: 15px 5px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 14px;
	margin: 5px;
	width: 100%;
	border: 2px solid #f6f6f6;
	-webkit-transition: all 0.5s ease-in-out;
	-moz-transition: all 0.5s ease-in-out;
	-ms-transition: all 0.5s ease-in-out;
	-o-transition: all 0.5s ease-in-out;
	transition: all 0.5s ease-in-out;
	-webkit-border-radius: 5px 5px 5px 5px;
	border-radius: 5px 5px 5px 5px;
}

input[type=text]:focus,input[type=password]:focus {
	background-color: #fff;
	border-bottom: 2px solid #5fbae9;
}

input[type=text]:placeholder,input[type=password]:placeholder {
	color: #cccccc;
}



/* ANIMATIONS */

/* Simple CSS3 Fade-in-down Animation */
.fadeInDown {
	-webkit-animation-name: fadeInDown;
	animation-name: fadeInDown;
	-webkit-animation-duration: 1s;
	animation-duration: 1s;
	-webkit-animation-fill-mode: both;
	animation-fill-mode: both;
}

@-webkit-keyframes fadeInDown {
	0% {
		opacity: 0;
		-webkit-transform: translate3d(0, -100%, 0);
		transform: translate3d(0, -100%, 0);
	}
	100% {
		opacity: 1;
		-webkit-transform: none;
		transform: none;
	}
}

@keyframes fadeInDown {
	0% {
		opacity: 0;
		-webkit-transform: translate3d(0, -100%, 0);
		transform: translate3d(0, -100%, 0);
	}
	100% {
		opacity: 1;
		-webkit-transform: none;
		transform: none;
	}
}

/* Simple CSS3 Fade-in Animation */
@-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

.fadeIn {
	opacity:0;
	-webkit-animation:fadeIn ease-in 1;
	-moz-animation:fadeIn ease-in 1;
	animation:fadeIn ease-in 1;

	-webkit-animation-fill-mode:forwards;
	-moz-animation-fill-mode:forwards;
	animation-fill-mode:forwards;

	-webkit-animation-duration:1s;
	-moz-animation-duration:1s;
	animation-duration:1s;
}

.fadeIn.first {
	padding-bottom:10px;
	-webkit-animation-delay: 0.4s;
	-moz-animation-delay: 0.4s;
	animation-delay: 0.4s;
}

.fadeIn.second {
	-webkit-animation-delay: 0.6s;
	-moz-animation-delay: 0.6s;
	animation-delay: 0.6s;
}

.fadeIn.third {
	-webkit-animation-delay: 0.8s;
	-moz-animation-delay: 0.8s;
	animation-delay: 0.8s;
}

.fadeIn.fourth {
	-webkit-animation-delay: 1s;
	-moz-animation-delay: 1s;
	animation-delay: 1s;
}

/* Simple CSS3 Fade-in Animation */
.underlineHover:after {
	display: block;
	left: 0;
	bottom: -10px;
	width: 0;
	height: 2px;
	background-color: #56baed;
	content: "";
	transition: width 0.2s;
}

.underlineHover:hover {
	color: #0d0d0d;
}

.underlineHover:hover:after{
	width: 100%;
}



/* OTHERS */

*:focus {
    outline: none;
} 

#icon {
	width:60%;
}

* {
	box-sizing: border-box;
}


body {
	margin:0px;
	height: 100%;
	overflow: hidden;
	width: 100% !important;
	box-sizing: border-box;
	font-family: 'Roboto', sans-serif;
}

.backRight {
	/* position: absolute;
	right: 0;
	width: 50%;
	height: 100%;
	background: #3498db url(https://download.unsplash.com/photo-1429041966141-44d228a42775);
	background-size: cover;
	background-position: 50% 50%; */
}

.backLeft {
	position: absolute;
	left: 0;
	width: 75%;
	height: 100%;
	/* background: url('<?php echo base_url();?>assets_home/login/bahan_tayang_baru.jpg'); */
	background: url('<?php echo base_url();?>assets_home/login/sikerjabaru.jpg');
	background-size: cover;
	/* background-position: 50% 50%; */
}

#back {
	width: 100%;
	height: 100%;
	position: absolute;
	z-index: -999;
}

#slideBox {
	width: 25%;
	max-height: 100%;
	height: 100%;
	overflow: hidden;
	margin-left: 75%;
	position: absolute;
	/* box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22); */
}
.topLayer {
	width: 200%;
	height: 100%;
	position: relative;
	left: 0;
	left: -100%;
}

.left {
	width: 50%;
	height: 100%;
	background: #2C3034;
	left: 0;
	position: absolute;
}

.right {
	width: 50%;
	height: 100%;
	background: #e2e4f3;
	right: 0;
	position: absolute;
}

.content {
	/* width: 250px;
	margin: 0 auto;
	top: 30%;
	position: absolute;
	left: 50%;
	margin-left: -125px; */
}

.content h2 {
	color: #03A9F4;
	font-weight: 300;
	font-size: 35px;
}

button {
	margin: 15px 15px 15px 0;
}

button:hover {
	background: #0288D1;
	box-shadow: 0 4px 7px rgba(0,0,0,0.1), 0 3px 6px rgba(0,0,0,0.1);
}
.off {
	background: none;
	color: #03A9F4;
	box-shadow: none;
}

.right .off:hover {
	background: #eee;
	color: #03A9F4;
	box-shadow: none;
}
.left .off:hover {
	box-shadow: none;
	color: #03A9F4;
	background: #363A3D;
}
input {
	background: transparent;
	border: 0;
	outline: 0;
	border-bottom: 1px solid #45494C;
	font-size: 14px;
	color: #959595;
	padding: 8px 0;
	margin-top: 20px;
}

</style>

<div class="example-modal">
    <div class="modal modal-success fade" id="loadprosess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="box-content">

                <div class="modal-dialog">
                    <div class="modal-content" style="background-color: transparent;border:none;">
                        <div style="margin-top: 320px;">
                            <div class="loadme-rotateplane"></div>
                            <div class="loadme-mask"></div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>


<div id="back">
	<div class="backRight"></div>
	<div class="backLeft" style="height:565px;"></div>
</div>

<div id="slideBox">
	<div class="topLayer">
		<div class="left">
			<div class="content">

			</div>
		</div>
		<div class="right">
			<div class="content">

				<div class="wrapper">
					<!-- Icon -->
					<div class="fadeIn first text-center">
						<img src="<?=base_url();?>/assets_home/logo.png" id="icon" alt="User Icon" />
					</div>
					<div id="formContent">

						<!-- Login Form -->
						<div>
							<input type="text" id="nip" class="fadeIn second" name="nip" placeholder="NIP">
							<input type="password" id="password" class="fadeIn third" name="password" placeholder="PASSWORD">
							<button class="fadeIn fourth" id="btnlogin">Masuk</button>						
						</div>

						<!-- Remind Passowrd -->
						<div id="formFooter">
							<a class="underlineHover" href="#" id="btn_forgot_password">Lupa Password?</a>
							<hr>
							<span style="color:#92badd;">v.4.1.2.7.3</span>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<!--Inspiration from: http://ertekinn.com/loginsignup/-->
<script>
$(document).ready(function(){
	$('#goRight').on('click', function(){
		$('#slideBox').animate({
		'marginLeft' : '0'
		});
		$('.topLayer').animate({
		'marginLeft' : '100%'
		});
	});

	$('#btn_forgot_password').on('click', function(){
        Lobibox.alert('info', {
            title: 'Info',
            msg: 'Harap menghubungi Administrasi SIKERJA di sikerja@kemendagri.go.id'
        });       
	})

	$('#goLeft').on('click', function(){
		$('#slideBox').animate({
		'marginLeft' : '50%'
		});
		$('.topLayer').animate({
		'marginLeft': '0'
		});
	});

	$("#nip").on( "keydown", function(event) {
		if(event.which == 13)
		{
			$("#password").focus();
		} 
	});	

	$("#password" ).on( "keydown", function(event) {
		if(event.which == 13)
		{
			login();
		} 
	});		

	$("#btnlogin").on('click', function() {
		login();
	})
});

function ajax_catch(jqXHR,exception) {
    console.log(jqXHR);
    if (jqXHR.status === 0) 
    {
        Lobibox.alert('error', {
            title: 'ERROR '+jqXHR.status,
            msg: 'Not connect.\n Verify Network.'
        });        
    } 
    else if (jqXHR.status == 404) 
    {
        Lobibox.alert('error', {
            title: 'ERROR '+jqXHR.status,
            msg: 'Requested page not found. [404]'
        });
    } 
    else if (jqXHR.status == 500) 
    {
        Lobibox.alert('error', {
            title: 'ERROR '+jqXHR.status,
            msg: jqXHR.statusText
        });
    } 
    else if (exception === 'parsererror') 
    {
        Lobibox.alert('error', {
            title: exception,
            msg: 'Requested JSON parse failed.'
        });        
    } 
    else if (exception === 'timeout') 
    {
        Lobibox.alert('error', {
            title: exception,
            msg: 'Time out error.'
        });                
    } 
    else if (exception === 'abort') 
    {
        Lobibox.alert('error', {
            title: exception,
            msg: 'Ajax request aborted.'
        });                        
    } 
    else 
    {
        Lobibox.alert('error', {
            title: 'ERROR '+jqXHR.status,
            msg: 'Uncaught Error.\n' + jqXHR.responseText
        });                        
    }

    setTimeout(function(){
        setTimeout(function(){
            $("#loadprosess").modal('hide');
        }, 500);
    }, 500);    
}

function login() {
	var nip      = $("#nip").val();
	var password = $("#password").val();
	if(nip.length <= 0 || password.length <= 0)
	{
		Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
		{
			msg: "Tidak bisa melakukan verifikasi, harap lengkapi NIP dan Password"
		});
	}
	else
	{
		$.ajax({
			url :"<?php echo base_url();?>auth/login",
			type:"post",
			data:{
					nip     : nip,
					password: password 
				},
			beforeSend:function(){
				$("#editData").modal('hide');
				$("#loadprosess").modal('show');
			},
			success:function(msg){
				var obj = jQuery.parseJSON (msg);
				if (obj.status == 1)
				{
					setTimeout(function(){
						$("#loadprosess").modal('hide');
						setTimeout(function(){
							sessionStorage.setItem("showw", 1);
							window.location.href = "<?=base_url();?>admin";							
						}, 500);
					}, 500);
				}
				else
				{
					Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
										{
											msg: obj.text
										});
					$("#loadprosess").modal('hide');
				}
			},
			error:function(jqXHR,exception)
			{
				ajax_catch(jqXHR,exception);					
			}
		})
	}	
}
</script>

<!DOCTYPE>
<html>
<head>
<script type="text/javascript" src="jquery-1.11.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('a.close').click(function(eve){
			
			eve.preventDefault();
			$(this).parents('div.popup').fadeOut('slow');
		});
	});
</script>
<style type="text/css">
	body{
		width:70%;
		height:80%;
		margin:0;
		padding:0;
	}
	div.popup{
		position:fixed;
		top:0;
		bottom:0;
		left:0;
		right:0;
		width:100%;
		height:100%;
		background: rgba(0,0,0,.8);
	}
	
	div#box{
		margin:5% auto;
		background:#00008b;
		width:60%;
		height:50%;
		-webkit-box-shadow:0 0 15px #000;
		-moz-box-shadow:0 0 15px #000;
		box-shadow:0 0 15px #000;
	}
	
	a.close{
		text-decoration:none;
		color:#ffcc00;
		margin:10px 15px 0 0;
		float:right;
		font-family:tahoma;
		font-size:20px;
	}
</style>
</head>
<body>
	<!-- bagian popup -->
	<div class="popup">
		<div id="box">
			<a class="close" href="#">X</a>
		<!--	
		<h1 style="color:red;text-align:center">--INFORMASI--</h1><br/>
		<h3 style="color:white;text-align:center"><b>Silahkan untuk melakukan penilaian perilaku SKP Tahun 2021 Periode II melalui tautan link di bawah ini</h3>
		<h1 style="color:white;text-align:center"><a href="http://sikerja.kemendagri.go.id/skpprilaku"><u>http://sikerja.kemendagri.go.id/skpprilaku</u></a></h1>
		<h3 style="color:red;text-align:center"><b>(Login menggunakan username dan password akun Sikerja Anda)</h3> -->
		
		<h1 style="color:red;text-align:center">--INFORMASI--</h1><br/>
		<!--<table border="1">
			<tr bgcolor="lightblue">
				<td><h1 style="color:black;text-align:left"><b>Setelah Login silahkan melakukan input untuk pengukuran Indeks Profesionalitas ASN Kemendagri Tahun 2021.</h1>
					<b>Siapkan dokumen-dokumen yang akan Anda upload (jenis file pdf/jpg/png, ukuran maksimal setiap file 1 MB) antara lain: <br/>
					1. SKP Tahun 2021 (Periode I dan II)<br/>
					2. Sertifikat (Diklat Struktural, Diklat Fungsional, Diklat 20 JP)<br/>
					3. Sertifikat Seminar/Workshop), dan<br/>
					4. Surat Hukuman Disiplin (bagi yang terkena hukuman disiplin)<br/>
					   
				  <h3 style="color:red;text-align:left"><b>(Batas pengisian sampai dengan 30 Juni 2022)</h3> 	
				</td>
			</tr>
		</table> <br/> -->
		<table border="1">
			<tr bgcolor="lightblue">
				<td>
					<h1 style="color:black;text-align:left"><b>Untuk melakukan penilaian perilaku SKP Tahun 2021 Periode II silahkan klik tautan link di bawah ini</h3>
				  <h1 style="color:white;text-align:left"><a href="http://sikerja.kemendagri.go.id/skpprilaku"><u>http://sikerja.kemendagri.go.id/skpprilaku</u></a></h1>
				  <h3 style="color:red;text-align:left"><b>(Login menggunakan username dan password akun Sikerja Anda)</h3>
				</td>
			</tr>
		
		</table>
		
		
		</div>		
		
	</div>
	
	<!-- akhir dari popup -->
	
	
</body>
</html>


