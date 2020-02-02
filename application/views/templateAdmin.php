<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>SIKERJA</title>
<link rel="shortcut icon" href="<?php echo base_url();?>assets_home/logo.png">
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.5 -->
<style type="text/css">@import url("<?php echo base_url() . 'assets/bootstrap/css/bootstrap.min.css'; ?>");</style>
<!-- Gauge -->
<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/jqWidget/css/jqx.base.css'; ?>");</style>
<!-- Font Awesome -->
<style type="text/css">@import url("<?php echo base_url() . 'assets/font/css/font-awesome.min.css'; ?>");</style>
<!-- <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script> -->
<style type="text/css">@import url("<?php echo base_url() . 'assets/ionicons/css/ionicons.min.css'; ?>");</style>
<!-- Theme style -->
<style type="text/css">@import url("<?php echo base_url() . 'assets/dist/css/AdminLTE.min.css'; ?>");</style>
<!-- AdminLTE Skins. Choose a skin from the css/skins
 folder instead of downloading all of them to reduce the load. -->
<style type="text/css">@import url("<?php echo base_url() . 'assets/dist/css/skins/_all-skins.min.css'; ?>");</style>
<!-- iCheck -->
<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/iCheck/flat/blue.css'; ?>");</style>
<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/iCheck/all.css'; ?>");</style>
<!-- Morris chart -->
<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/morris/morris.css'; ?>");</style>
<!-- jvectormap -->
<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css'; ?>");</style>
<!-- Date Picker -->
<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/datepicker/css/bootstrap-datepicker3.css'; ?>");</style>
<!-- Daterange picker -->
<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/daterangepicker/daterangepicker-bs3.css'; ?>");</style>
<!-- Select2 -->
<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/select2/select2.min.css'; ?>");</style>
<!-- Lobi box -->
<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/lobibox/dist/css/Lobibox.min.css'; ?>");</style>
<!-- DataTables -->
<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.css'; ?>");</style>
<!-- Tour guide -->
<style type="text/css">@import url("<?php echo base_url() . 'assets/bootstrap/css/bootstrap-tour.min.css'; ?>");</style>

<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/clockpicker/dist/bootstrap-clockpicker.min.css'; ?>");</style>

<!-- bootstrap wysihtml5 - text editor -->
<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'; ?>");</style>
<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/loadme/style/loadme.css'; ?>");</style>
<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/fullcalendar/fullcalendar.min.css'; ?>");</style>
<!-- Jquery -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<style>
.footer-icon > i
{
  background: #fff;
  color: #00a7d0;
  padding: 10px;
  border-radius: 50%;
  font-size: 15px;
}
.footer-icon
{
  color: #fff;
}

.footer-icon > label
{
  padding-left: 10px;
}

.progress {
  background: red;
  display: block;
  height: 20px;
  text-align: center;
  transition: width .3s;
  width: 0;
}

.progress.hide {
  opacity: 0;
  transition: opacity 1.3s;
}

</style>
<script type="text/javascript">
/*********************************************************************************************/
/* function = getCookie(cname)
/* used for = get data to cookie
/*
/*********************************************************************************************/
function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i=0; i<ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1);
      if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
      }
  }
  return "";
}

/*********************************************************************************************/
/* function = current_date()
/* used for = get current date
/*
/*********************************************************************************************/
function change_format_date(arg,param) {
    var newdate = '';
    if (param == 'yyyy-mm-dd') {
        var date    = arg;
        var d       = new Date(date.split("-").reverse().join("-"));
        var dd      = d.getDate();
        var mm      = d.getMonth()+1;
        if (mm < 10) mm = '0'+mm;
        if (dd < 10) dd = '0'+dd;        
        var yy      = d.getFullYear();
        newdate = yy+"-"+mm+"-"+dd;
    }
    // console.log(newdate);
    return newdate;
}

function current_date() {
    // body...
    var d = new Date();

    var month = d.getMonth()+1;
    var day = d.getDate();

    if(month < 10)month = '0'+month;
    if(day < 10)day = '0'+day;    

    // var output = d.getFullYear() + '-' +
    //     ((''+month).length<2 ? '0' : '') + month + '-' +
    //     ((''+day).length<2 ? '0' : '') + day;
    var output = d.getFullYear() + '-' + month + '-' + day;

    return output;
}

/* jQuery Validate Emails with Regex */
function validateEmail(Email) {
    var pattern = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

    return $.trim(Email).match(pattern) ? true : false;
}    

$(document).ready(function()
{
    $('.timerange').datepicker({
        maxDate: new Date,
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        daysOfWeekHighlighted: "0,6"
    });

    $('.clockpicker').clockpicker({
        placement: 'top',
        align: 'left',
        donetext: 'Done'
    });    

    $('.timerange-normal').datepicker({
        maxDate: new Date,
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        daysOfWeekHighlighted: "0,6"
    });    

    $(".timerange").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});

    $('.js-example-basic-single').select2();                 

    $("#noti-tab").click(function(){
        // body...
        show_time = $(".noti-container").css('display');
        if (show_time == 'none')
        {
          $.ajax({
              url :"<?php echo site_url()?>dashboard/delete_common_notify/notify",
              type:"post",
              success:function(msg){
              }
          })
        }
    })
});


$(document).click(function(e) {
    show_time = $(".noti-container").css('display');
    if (show_time == 'block')
    {
        $(".noti-container").css({"display": "none"});
    }
});

</script>
</head>
<body class="hold-transition skin-red-kemendagri sidebar-mini" style="padding-right: 0px!important;">
    <div class="wrapper">

        <header class="main-header" style="position:fixed;width:100%;">
            <?php menu_header();?>
        </header>
        <aside class="main-sidebar hidden-md hidden-lg hidden-sm" style="padding-top: 0px;">
            <section class="sidebar " style="height: auto;">
                <ul class="nav sidebar-menu">
                <li class="header"></li>
                    <?php 
                        // menuSamping(); 
                    ?>
                </ul>
            </section>
        </aside>

        <div class="content-wrapper">
           <section class="content-header">
              <h1>
                <?php echo $title;?>
      			<i id="subtitle">
          			<small> <?php if(isset($subtitle)){ echo $subtitle;} ?></small>
      			</i>
              </h1>
            </section>
			<section class="content">
                <?php
                    if ($title == '') {
                        # code...
                ?>
                    <?php $this->load->view($content);?>                
                <?php
                    }
                    else
                    {
                ?>
                    <div class="row">
                        <?php $this->load->view($content);?>
                    </div>                
                <?php
                    }
                ?>
            </section>
        </div>

    </div>

    <footer class="main-footer" style="margin-left:0px;background-color: #00a7d0;padding:15px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 text-center" style="font-size:20px;color:#00a7d0;">
                    &nbsp;
                </div>
                <div class="col-lg-4 text-center" style="font-size:20px;color:#00a7d0;">
                    <a href="" class="footer-icon"><i class="fa fa-chrome"></i></a>
                    <a href="" class="footer-icon"><i class="fa fa-instagram"></i></a>
                    <a href="" class="footer-icon"><i class="fa fa-twitter"></i></a>
                    <a href="" class="footer-icon"><i class="fa fa-facebook"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" style="padding-top: 15px;">
                    <div class="text-center" style="color:#fff;">
                        <span>Copyright@2018 Biro Kepegawaian</span><span>Right Reserved</span>
                        <br>
                        <span>v.4.1.2.6.6</span>
                    </div>
                </div>
            </div>
        </div>


    </footer>

<!-- jQuery UI 1.11.4 -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jQueryUI/jquery-ui.min.js"></script>
<!-- Moment.js dari cdn -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/daterangepicker/moment.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button);

</script>
<!-- Bootstrap 3.3.5 -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts  -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/morris/morris.min.js"></script>
<!-- InputMask -->
<!-- <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.bundle.js" type="text/javascript"></script> -->
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>


<!-- Sparkline -->
<!-- <script type='text/javascript' src="<?php echo base_url(); ?>assets/sparkline/jquery.sparkline.min.js"></script> -->
<!-- jvectormap -->



<!-- <script type='text/javascript' src="<?php echo base_url(); ?>assets/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> -->
<!-- <script type='text/javascript' src="<?php echo base_url(); ?>assets/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->
<!-- daterangepicker -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
<!-- Lobi box -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/lobibox/js/Lobibox.js"></script>
<!-- AUTO numeric -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/autonumeric/autoNumeric.js"></script>
<!-- Select2 -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>

<!-- iCheck 1.0.1 -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<!-- FLOT CHARTS -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.min.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.resize.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.categories.min.js"></script>
<!-- tour guide -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap-tour.min.js"></script>
<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/clockpicker/dist/bootstrap-clockpicker.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript">

function simpeg_finger_kehadiran(arg) {
    $.ajax({
        url :"<?php echo site_url()?>api_get/simpeg_finger_kehadiran/<?=$this->session->userdata('sesNip');?>/<?=$this->session->userdata('sesUser');?>",
        type:"post",
        success:function(msg){
            $("#loadprosess").modal('hide');
            if (arg != 'bypass') {
                var obj = jQuery.parseJSON (msg);
                console.log(obj)
                // tr_insert = "";
                // for (i=0 ;i<obj.results.length;i++) {
                //     tr_insert += '<tr>'+
                //                 '<td>'+(i +1)+'</td>'+
                //                 '<td>'+obj.results[i].ntpu+'</td>'+
                //                 '<td>'+obj.results[i].njur+'</td>'+
                //                 '<td>'+obj.results[i].nsek+'</td>'+
                //                 '<td>'+obj.results[i].tempat+'</td>'+
                //                 '<td>'+obj.results[i].thnlulus+'</td>'+
                //                 // '<td>'+obj.results[i].scoring+'</td>'+
                //             '</tr>';                                          
                // }  
                // $("#li_pendidikan_umum > div > div > div > div > table > tbody").html(tr_insert);                
            }                        
        },
        error:function(jqXHR,exception) {
            // ajax_catch(jqXHR,exception);					
        }
    })    
}

function profile(arg) {
    $.ajax({
        url :"<?php echo site_url()?>api_get/simpeg_profile/<?=$this->session->userdata('sesNip');?>",		
        type:"post",
        success:function(msg){
            $("#loadprosess").modal('hide');
            var obj = jQuery.parseJSON (msg);
            console.log(obj.results)
            if (arg != 'bypass') {
                $("#lbl_nip").html(obj.results.nip);
                $("#lbl_nama").html(obj.results.nama);
                $("#lbl_ttl").html(obj.results.ttl);
                // $("#lbl_jenis_kelamin").html(obj.results.ttl);
                $("#lbl_agama").html(obj.results.agama);
                $("#lbl_alamat").html(obj.results.alamat1);                                
                $("#lbl_jabatan").html(obj.results.jabatan)                                       
                $("#lbl_tmt_jabatan").html(obj.results.tmtjabatan)
                $("#lbl_pangkat").html(obj.results.pangkat+' ('+obj.results.nama_gol+')')
                $("#lbl_tmt_pangkat").html(obj.results.tmtpang)
                $("#lbl_no_hp").html(obj.results.nomorhp)
                $("#lbl_email").html(obj.results.email)
            }
        },
        error:function(jqXHR,exception) {
            // ajax_catch(jqXHR,exception);					
        }
    })    
}

function riwayat_pendidikan(arg) {
    $.ajax({
        url :"<?php echo site_url()?>api_get/simpeg_riwayat_pendidikan/<?=$this->session->userdata('sesNip');?>/<?=$this->session->userdata('sesUser');?>",
        type:"post",
        success:function(msg){
            $("#loadprosess").modal('hide');
            if (arg != 'bypass') {
                var obj = jQuery.parseJSON (msg);
                tr_insert = "";
                for (i=0 ;i<obj.results.length;i++) {
                    tr_insert += '<tr>'+
                                '<td>'+(i +1)+'</td>'+
                                '<td>'+obj.results[i].ntpu+'</td>'+
                                '<td>'+obj.results[i].njur+'</td>'+
                                '<td>'+obj.results[i].nsek+'</td>'+
                                '<td>'+obj.results[i].tempat+'</td>'+
                                '<td>'+obj.results[i].thnlulus+'</td>'+
                                // '<td>'+obj.results[i].scoring+'</td>'+
                            '</tr>';                                          
                }  
                $("#li_pendidikan_umum > div > div > div > div > table > tbody").html(tr_insert);                
            }                        
        },
        error:function(jqXHR,exception) {
            // ajax_catch(jqXHR,exception);					
        }
    })    
}

function riwayat_pangkat(arg) {
    $.ajax({
        url :"<?php echo site_url()?>api_get/simpeg_riwayat_pangkat/<?=$this->session->userdata('sesNip');?>/<?=$this->session->userdata('sesUser');?>",		
        type:"post",
        success:function(msg){
            $("#loadprosess").modal('hide');
            if (arg != 'bypass') {
                var obj = jQuery.parseJSON (msg);
                tr_insert = "";
                for (i=0 ;i<obj.results.length;i++) {
                    tr_insert += '<tr>'+
                                '<td>'+(i +1)+'</td>'+
                                '<td>'+obj.results[i].pangkat+'</td>'+
                                '<td>'+obj.results[i].tmt_pangkat+'</td>'+
                            '</tr>';                                          
                }  
                $("#li_pangkat > div > div > div > div > table > tbody").html(tr_insert);                            
            }
        },
        error:function(jqXHR,exception) {
            // ajax_catch(jqXHR,exception);					
        }
    })    
}

function riwayat_jabatan(arg) {
    $.ajax({
        url :"<?php echo site_url()?>api_get/simpeg_riwayat_jabatan/<?=$this->session->userdata('sesNip');?>",		
        type:"post",
        success:function(msg){
            $("#loadprosess").modal('hide');
            if (arg != 'bypass') {
                var obj = jQuery.parseJSON (msg);
                tr_insert = "";
                for (i=0 ;i<obj.results.length;i++) {
                    tr_insert += '<tr>'+
                                '<td>'+(i +1)+'</td>'+
                                '<td>'+obj.results[i].jataban+'</td>'+
                                '<td>'+obj.results[i].jenisjab+'</td>'+
                                '<td>'+obj.results[i].tmt_jabatan+'</td>'+                            
                            '</tr>';                                          
                }  
                $("#li_jabatan > div > div > div > div > table > tbody").html(tr_insert);                
            }            
        },
        error:function(jqXHR,exception) {
            // ajax_catch(jqXHR,exception);					
        }
    })    
}

function riwayat_diklat_struktural(arg) {
    $.ajax({
        url :"<?php echo site_url()?>api_get/simpeg_riwayat_diklat_struktural/<?=$this->session->userdata('sesNip');?>",		
        type:"post",
        success:function(msg){
            $("#loadprosess").modal('hide');
            if (arg != 'bypass') {            
                var obj = jQuery.parseJSON (msg);
                tr_insert = "";
                for (i=0 ;i<obj.results.length;i++) {
                    tr_insert += '<tr>'+
                                '<td>'+(i +1)+'</td>'+
                                '<td>'+obj.results[i].ndik+'</td>'+
                                '<td>'+obj.results[i].tempat+'</td>'+
                                '<td>'+obj.results[i].panitia+'</td>'+
                                '<td>'+obj.results[i].tgl_mulai+'</td>'+
                                '<td></td>'+
                                '<td></td>'+
                            '</tr>';                                          
                }  
                $("#li_diklat_struktural > div > div > div > div > table > tbody").html(tr_insert);            
            }
        },
        error:function(jqXHR,exception) {
            // ajax_catch(jqXHR,exception);					
        }
    })    
}

function riwayat_diklat_fungsional(arg) {
    $.ajax({
        url :"<?php echo site_url()?>api_get/simpeg_riwayat_diklat_fungsional/<?=$this->session->userdata('sesNip');?>",		
        type:"post",
        success:function(msg){
            $("#loadprosess").modal('hide');
            if (arg != 'bypass') {            
                var obj = jQuery.parseJSON (msg);
                tr_insert = "";
                for (i=0 ;i<obj.results.length;i++) {
                    tr_insert += '<tr>'+
                                    '<td>'+(i +1)+'</td>'+
                                    '<td>'+(i +1)+'</td>'+
                                    '<td>'+(i +1)+'</td>'+
                                    '<td>'+(i +1)+'</td>'+
                                    '<td>'+(i +1)+'</td>'+
                                    '<td>'+(i +1)+'</td>'+
                                    '<td>'+(i +1)+'</td>'+                                                                                                                            
                            '</tr>';                                          
                }  
                $("#li_diklat_fungsional > div > div > div > div > table > tbody").html(tr_insert);            
            }
        },
        error:function(jqXHR,exception) {
            // ajax_catch(jqXHR,exception);					
        }
    })    
}

function riwayat_diklat_teknis(arg) {
    $.ajax({
        url :"<?php echo site_url()?>api_get/simpeg_riwayat_diklat_teknis/<?=$this->session->userdata('sesNip');?>",		
        type:"post",
        success:function(msg){
            $("#loadprosess").modal('hide');
            if (arg != 'bypass') {            
                var obj = jQuery.parseJSON (msg);
                tr_insert = "";
                for (i=0 ;i<obj.results.length;i++) {
                    tr_insert += '<tr>'+
                                '<td>'+(i +1)+'</td>'+
                                '<td>'+obj.results[i].ndiktek+'</td>'+
                                '<td>'+obj.results[i].tempat+'</td>'+
                                '<td>'+obj.results[i].panitia+'</td>'+
                                '<td>'+obj.results[i].tgl_mulai+'</td>'+
                                '<td>'+obj.results[i].tgl_akhir+'</td>'+
                                '<td></td>'+                                                                                                                
                            '</tr>';                                          
                }  
                $("#li_teknis > div > div > div > div > table > tbody").html(tr_insert);            
            }
        },
        error:function(jqXHR,exception) {
            // ajax_catch(jqXHR,exception);					
        }
    })    
}

function riwayat_konferensi(arg) {
    $.ajax({
        url :"<?php echo site_url()?>api_get/simpeg_riwayat_konferensi/<?=$this->session->userdata('sesNip');?>",		
        type:"post",
        success:function(msg){
            $("#loadprosess").modal('hide');
            if (arg != 'bypass') {            
                var obj = jQuery.parseJSON (msg);
                tr_insert = "";
                for (i=0 ;i<obj.results.length;i++) {
                    tr_insert += '<tr>'+
                                    '<td>'+(i +1)+'</td>'+
                                    '<td>'+obj.results[i].nseminar+'</td>'+
                                    '<td>'+obj.results[i].peran+'</td>'+
                                    '<td>'+obj.results[i].tempat+'</td>'+
                                    '<td>'+obj.results[i].panitia+'</td>'+
                                    '<td>'+obj.results[i].tgl_mulai+'</td>'+
                                    '<td>'+obj.results[i].tgl_akhir+'</td>'+                                                                                                                            
                                    '<td></td>'+
                            '</tr>';                                          
                }  
                $("#li_konferensi > div > div > div > div > table > tbody").html(tr_insert);            
            }
        },
        error:function(jqXHR,exception) {
            // ajax_catch(jqXHR,exception);					
        }
    })    
}

function karya_tulis(arg) {
    $.ajax({
        url :"<?php echo site_url()?>api_get/simpeg_karya_tulis/<?=$this->session->userdata('sesNip');?>",		
        type:"post",
        success:function(msg){
            $("#loadprosess").modal('hide');
            if (arg != 'bypass') {            
                var obj = jQuery.parseJSON (msg);
                tr_insert = "";
                for (i=0 ;i<obj.results.length;i++) {
                    tr_insert += '<tr>'+
                                    '<td>'+(i +1)+'</td>'+
                                    '<td>'+obj.results[i].judul_buku+'</td>'+
                                    '<td>'+obj.results[i].tahun+'</td>'+                                                                                                                            
                            '</tr>';                                          
                }  
                $("#li_KaryaTulis > div > div > div > div > table > tbody").html(tr_insert);            
            }                
        },
        error:function(jqXHR,exception) {
            // ajax_catch(jqXHR,exception);					
        }
    })    
}

function penghargaan(arg) {
    $.ajax({
        url :"<?php echo site_url()?>api_get/simpeg_penghargaan/<?=$this->session->userdata('sesNip');?>",		
        type:"post",
        success:function(msg){
            $("#loadprosess").modal('hide');
            if (arg != 'bypass') {            
                var obj = jQuery.parseJSON (msg);
                tr_insert = "";
                for (i=0 ;i<obj.results.length;i++) {
                    tr_insert += '<tr>'+
                                    '<td>'+(i +1)+'</td>'+
                                    '<td>'+obj.results[i].nbintang+'</td>'+
                                    '<td>'+obj.results[i].aoleh+'</td>'+
                                    '<td>'+obj.results[i].nsk+'</td>'+
                                    '<td>'+obj.results[i].tholeh+'</td>'+
                            '</tr>';                                          
                }  
                $("#li_penghargaan > div > div > div > div > table > tbody").html(tr_insert);            
            }
        },
        error:function(jqXHR,exception) {
            // ajax_catch(jqXHR,exception);					
        }
    })    
}

function organisasi(arg) {
    $.ajax({
        url :"<?php echo site_url()?>api_get/simpeg_organisasi/<?=$this->session->userdata('sesNip');?>",		
        type:"post",
        success:function(msg){
            $("#loadprosess").modal('hide');
            if (arg != 'bypass') {                            
                var obj = jQuery.parseJSON (msg);
                tr_insert = "";
                for (i=0 ;i<obj.results.length;i++) {
                    tr_insert += '<tr>'+
                                    '<td>'+(i +1)+'</td>'+
                                    '<td>'+obj.results[i].norg+'</td>'+                                
                                    '<td>'+obj.results[i].jorg+'</td>'+                                                                                                                            
                                    '<td>'+obj.results[i].jborg+'</td>'+
                                    '<td>'+obj.results[i].tempat+'</td>'+
                                    '<td>'+obj.results[i].tgl_mulai+'</td>'+
                                    '<td>'+obj.results[i].tgl_akhir+'</td>'+                                
                            '</tr>';                                          
                }  
                $("#li_organisasi > div > div > div > div > table > tbody").html(tr_insert);            
            }
        },
        error:function(jqXHR,exception) {
            // ajax_catch(jqXHR,exception);					
        }
    })    
}


function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function ajax_status(obj,arg)
{
    if (obj.status == 1)
    {
        Lobibox.notify('success', {
            msg: obj.text
            });
        setTimeout(function(){
            $("#loadprosess").modal('hide');
            setTimeout(function(){
                if (arg == null) {
                    location.reload();                    
                }
                else if(arg == 'no-refresh')
                {

                }
                else
                {
                    window.location.href = "<?=base_url();?>"+arg;                    
                }
            }, 500);
        }, 500);
    }
    else
    {
        Lobibox.notify('error', {
            msg: obj.text
            });
        setTimeout(function(){
            $("#loadprosess").modal('hide');
        }, 500);
    }
}

function ajax_catch(jqXHR,exception) {
    console.log(jqXHR);
    if (jqXHR.status === 0) 
    {
        Lobibox.notify('error', {
            title: 'ERROR '+jqXHR.status,
            msg: 'Not connect.\n Verify Network.'
        });        
        alert('');
    } 
    else if (jqXHR.status == 404) 
    {
        Lobibox.notify('error', {
            title: 'ERROR '+jqXHR.status,
            msg: 'Requested page not found. [404]'
        });
    } 
    else if (jqXHR.status == 500) 
    {
        Lobibox.notify('error', {
            title: 'ERROR '+jqXHR.status,
            msg: jqXHR.statusText
        });
    } 
    else if (exception === 'parsererror') 
    {
        Lobibox.notify('error', {
            title: exception,
            msg: 'Requested JSON parse failed.'
        });        
    } 
    else if (exception === 'timeout') 
    {
        Lobibox.notify('error', {
            title: exception,
            msg: 'Time out error.'
        });                
    } 
    else if (exception === 'abort') 
    {
        Lobibox.notify('error', {
            title: exception,
            msg: 'Ajax request aborted.'
        });                        
    } 
    else 
    {
        Lobibox.notify('error', {
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

    $(document).ready(function(){        
        $(".table-view").DataTable({
            "oLanguage": {
                "sSearch"    : "Pencarian :",
                "sInfoEmpty" : "",
                "sLengthMenu": "Show _MENU_ entries",
                "oPaginate"  : {
                    "sFirst"   : "Halaman Pertama",       // This is the link to the first page
                    "sPrevious": "Halaman Sebelumnya",    // This is the link to the previous page
                    "sNext"    : "Halaman Selanjutnya",   // This is the link to the next page
                    "sLast"    : "Halaman Terakhir"       // This is the link to the last page
                },
                "sSearchPlaceholder": "Ketik untuk mencari",
                "sLengthMenu"       : "Menampilkan &nbsp; _MENU_ &nbsp;Data",
                "sInfo"             : "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "sZeroRecords"      : "Data tidak ditemukan"
            },
            "dom": "<'row'<'col-sm-6'f><'col-sm-6'l>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "bSort": false

            // "dom": '<"top"f>rt'
            // "dom": '<"top"fl>rt<"bottom"ip><"clear">'
        });

        $(".table-view1").DataTable({
            "oLanguage": {
                "sSearch"    : "Pencarian :",
                "sInfoEmpty" : "",
                "sLengthMenu": "Show _MENU_ entries",
                "oPaginate"  : {
                    "sFirst"   : "Halaman Pertama",       // This is the link to the first page
                    "sPrevious": "Halaman Sebelumnya",    // This is the link to the previous page
                    "sNext"    : "Halaman Selanjutnya",   // This is the link to the next page
                    "sLast"    : "Halaman Terakhir"       // This is the link to the last page
                },
                "sSearchPlaceholder": "Ketik untuk mencari",
                "sLengthMenu"       : "Menampilkan &nbsp; _MENU_ &nbsp;Data",
                "sInfo"             : "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "sZeroRecords"      : "Data tidak ditemukan"
            },
            "dom": "<'row'<'col-sm-6'f><'col-sm-6'l>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "bSort": false

            // "dom": '<"top"f>rt'
            // "dom": '<"top"fl>rt<"bottom"ip><"clear">'
        });

        $(".table-view-no-paging").DataTable({
            "oLanguage": {
                "sSearch"    : "Pencarian :",
                "sInfoEmpty" : "",
                "sLengthMenu": "Show _MENU_ entries",
                "oPaginate"  : {
                    "sFirst"   : "Halaman Pertama",       // This is the link to the first page
                    "sPrevious": "Halaman Sebelumnya",    // This is the link to the previous page
                    "sNext"    : "Halaman Selanjutnya",   // This is the link to the next page
                    "sLast"    : "Halaman Terakhir"       // This is the link to the last page
                },
                "sSearchPlaceholder": "Ketik untuk mencari",
                "sLengthMenu"       : "Menampilkan &nbsp; _MENU_ &nbsp;Data",
                "sInfo"             : "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "sZeroRecords"      : "Data tidak ditemukan"
            },
            "dom": "<'row'<'col-sm-6'f><'col-sm-6'l>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "bSort"    : false,
            "bPaginate": false

            // "dom": '<"top"f>rt'
            // "dom": '<"top"fl>rt<"bottom"ip><"clear">'
        });        
    });
</script>

</body>
</html>

<div class="example-modal">
    <div class="modal modal-success fade" id="loadprosess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="box-content">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div style="margin-top: 320px;">
                            <div class="loadme-rotateplane"></div>
                            <div class="loadme-mask"></div>
                            <!-- <div class="progress"></div>                             -->
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
