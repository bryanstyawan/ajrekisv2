<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> -->
<!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
<!-- <link href="http://chatbot.kemendagri.go.id/assets/css/main.css" rel="stylesheet"> -->
 <?php
	// $link = mysqli_connect("192.168.193.15", "sikerja_asn", "asnsikerja_2019", "sikerja_new_build");
	// $nip = $this->session->userdata('sesNip') ;
	//jalankan query
	// $result = mysqli_query($link, "SELECT * FROM mr_pegawai_surveydca WHERE nip='".$nip."'");
	// $row_cnt = $result->num_rows;
																			 
	// if ($row_cnt != 0) {	
		 // $this->load->view('dashboard_component/notifsurveydca');
		 // echo "<script>
				// $(document).ready(function()
			// {
					
					// $('#modal-surveydca').modal('show');
			// }) </script>";
	// }
 ?>


<?php
$data_bulan[] = "";
$data_value[] = "";

if ($menit_efektif_year != 0) {
    // code...
    // for ($i=0; $i < count($menit_efektif_year); $i++) {
    //     // code...
    //     $data_bulan[$i] = $menit_efektif_year[$i]->nama_bulan;
    //     $data_value[$i] = $menit_efektif_year[$i]->menit_efektif;
    // }

    // $data_bulan = json_encode($data_bulan);
    // $data_value = json_encode($data_value);
}

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
    if ($infoPegawai[0]->kat_posisi == 1) {
        # code...
        $kelas_jabatan = $infoPegawai[0]->grade_raw;        
    }
    elseif ($infoPegawai[0]->kat_posisi == 2) {
        # code...
        $kelas_jabatan = $infoPegawai[0]->grade_jft;                
    }
    elseif ($infoPegawai[0]->kat_posisi == 4) {
        # code...
        $kelas_jabatan = $infoPegawai[0]->grade_jfu;        
    }
    $nama_agama    = $infoPegawai[0]->nama_agama;
}

$fingerprint = "";
?>

<?php
$this->load->view('dashboard_component/style_component');
$this->load->view('dashboard_component/php_logic_component');
?>

<?php
if ($this->session->userdata('sesPosisi') != 0) 
{
    # code...
?>
<div class="col-md-12 tour-step tour1" id="main-dashboard">
    <div class="row">
    <?php
    $who_is   = $this->Globalrules->who_is($this->session->userdata('sesUser'));
    $this->load->view('dashboard_component/banner_user_component',array(
        'nama_pegawai' => $nama_pegawai,
        'nama_jabatan' => $nama_jabatan,
        'who_is'       => $who_is));
    $this->load->view('dashboard_component/persentase_speedometer_component');                
    $this->load->view('dashboard_component/member_component');                                
    ?>
    <div class="col-md-5" style="height:50px;max-height: 50px;margin-bottom:1px;">
       
        <div class="widget-user-header bg-white-active text-center">
            <div class="box-header with-border">
                <h1 class="box-title"> <font color="blue" size="3">TATA CARA REVIEW & PENYESUAIAN TARGET SKP<a href="<?php echo base_url(); ?>assets_home/slider/TATACARAREVIEW_PENYESUAIANTARGETSKP.pdf">&nbsp&nbsp&nbsp<u>download</a></font></h1>
            </div>
        
            
        </div>
        
    </div>    
    <?php
    // $this->load->view('dashboard_component/chart_pencapaian_menit_efektif_component',array('data_value'=>$data_value,'data_bulan'=>$data_bulan));                    
    ?>
    </div>
        
    <?php
    $this->load->view('dashboard_component/common_component',array(
        'class'     => 'col-lg-2 col-xs-8',
        'id'        => 'btn_masih_diproses',
        'color_box' => 'background-color: #d2d6de !important;',
        'icon'      => '',
        'value_php' => (($belum_diperiksa == '') ? 0 : $belum_diperiksa),
        'title'     => 'PEKERJAAN BELUM DIPERIKSA',
        'html'      => ''));
    $this->load->view('dashboard_component/common_component',array(
        'class'     => 'col-lg-2 col-xs-8',
        'id'        => 'btn_realisasi_menit_efektif',
        'color_box' => 'background-color: #d2d6de !important;',
        'icon'      => '',
        'value_php' => (($summary_tr == '') ? 0 : $summary_tr[0]->menit_efektif),
        'title'     => 'REALISASI MENIT KERJA EFEKTIF',
        'html'      => ''));                  
	// $this->load->view('dashboard_component/common_component',array(
        // 'class'     => 'col-lg-3 col-xs-8',
        // 'id'        => 'btn_ip',
        // 'color_box' => 'background-color: #ffffcc !important;',
        // 'icon'      => '',
        // 'value_php' => (($totalip == '') ? 0 : $totalip),
        // 'title'     => 'INDEKS PROFESIONALITAS TAHUN 2022 <br/> (Klik disini untuk mengupdate survey)',
        // 'html'      => ''));     				
    // $this->load->view('dashboard_component/common_component',array(
    //     'class'     => 'col-lg-2 col-xs-8',
    //     'id'        => '',
    //     'color_box' => 'background-color: #d2d6de !important;',
    //     'icon'      => '',
    //     'value_php' => $skp->persentase,
    //     'title'     => 'CAPAIAN SKP',
    //     'html'      => "<label>".$skp->total_realisasi_kuantitas.' / '.$skp->total_target_kuantitas."</label>"));                                        
    $this->load->view('dashboard_component/common_component',array(
        'class'     => 'col-lg-2 col-xs-8',
        'id'        => 'btn_tunjangan',
        'color_box' => 'background-color: #d2d6de !important;',
        'icon'      => '',
        'value_php' => (($summary_tr == '') ? 0 : 'Rp.'.number_format($summary_tr[0]->real_tunjangan,0)),
        'title'     => 'TUNJANGAN',
        'html'      => ''));    
    $this->load->view('dashboard_component/common_finger',array(
        'class'     => 'col-lg-2 col-xs-8',
        'id'        => 'btn_fingerprint',
        'color_box' => 'background-color: #d2d6de !important;',
        'icon'      => '',
        'value_php' => $fingerprint,
        'title'     => 'FINGERPRINT', 
        'html'      => "<label id='total_tunjangan_' />"));
?>
</div>
<?php

$this->load->view('dashboard_component/bawahan_component');

// $this->load->view('dashboard_component/survey');

// $this->load->view('dashboard_component/notifsurvey');

// echo "<script>
			// $(document).ready(function()
    // {
			// $('#modal-infosurvey').modal('show');
	// }) </script>";

 // if ($_SESSION['popup'] == '1') {
	
	
	  // $this->load->view('dashboard_component/survey');
	  // echo "<script>
				// $(document).ready(function()
		// {
				
				// $('#modal-kuisioner').modal('show');
		// }) </script>";
	
	 
  // }
  
  // $this->load->view('dashboard_component/survey');
  // echo "<script>
		// $(document).ready(function()
		// {
			// if (sessionStorage.getItem('showw')==1) {
			// $('#modal-kuisioner').modal('show'); }
	// }) </script>";
	
	// if echo "<script>(sessionStorage.getItem('showw')==1) {
		// $this->load->view('dashboard_component/survey');
	// }
	
	// $link = mysqli_connect("192.168.193.15", "sikerja_asn", "asnsikerja_2019", "sikerja_new_build");
	// $idpeg = $this->session->userdata('sesUser') ;
	// $result = mysqli_query($link, "SELECT disclaimer, jns_jabatan FROM tr_survey_ip WHERE id_pegawai='".$idpeg."' and tahun=2022");
	// $row_cnt = $result->num_rows;
	// $disclaimer = 0;																		 
	// if ($row_cnt != 0) {	
		// while ($row=mysqli_fetch_object($result))
		// {
			// $disclaimer = $row->disclaimer;
			// $jabatan = $row->jns_jabatan;
			// if ($jabatan!='CPNS') {
				// if ($disclaimer==1) {
							// $this->load->view('dashboard_component/survey');
							// echo "<script>
									// alert('Terima Kasih telah mengisi Indeks Profesionalitas, Anda dapat mengupdate data dengan mengklik Icon angka Indeks Profesionalitas di kotak berwarna kuning');
								// </script>";
								
					
					// }else{
							// $this->load->view('dashboard_component/survey');
							// echo "<script>
									// $(document).ready(function()
									// {
										// $('#modal-kuisioner').modal('show'); 
								// }) </script>";
					// }
			// }
		// }
	// }else{
		// $this->load->view('dashboard_component/survey');
		// echo "<script>
				// $(document).ready(function()
				// {
					// $('#modal-kuisioner').modal('show'); 
			// }) </script>";
	// }
		
	


	

// $this->load->view('dashboard_component/change_profile_component',array('nama_agama'=>$nama_agama));
	$this->load->view('dashboard_component/information_emp_component',array(
    'nama_eselon1'  => $nama_eselon1,
    'nama_eselon2'  => $nama_eselon2,
    'nama_eselon3'  => $nama_eselon3,
    'nama_eselon4'  => $nama_eselon4,
    'nip'           => $nip,
    'kelas_jabatan' => $kelas_jabatan));

/****************************************************************/
/**
*Modal Section
*/
$this->load->view('dashboard_component/common_modal_datatable_component',array(
    'id'           => 'modal-transaksi-proses',
    'header'       => 'Pekerjaan Belum Selesai',
    'id_datatable' => 'get-datatable'));

$this->load->view('dashboard_component/common_modal_datatable_component',array(
    'id'           => 'modal-transaksi-realisasi',
    'header'       => 'Realisasi Menit Kerja Efektif',
    'id_datatable' => 'get-datatable1'));

$this->load->view('dashboard_component/common_modal_datatable_component',array(
    'id'           => 'modal-transaksi-tunjangan',
    'header'       => 'TUNJANGAN',
    'id_datatable' => 'get-datatable2'));

$this->load->view('dashboard_component/common_modal_datatable_component',array(
    'id'           => 'modal-transaksi-fingerprint',
    'header'       => 'FINGERPRINT',
    'id_datatable' => 'get-datatable3'));
?>

<?php
}
else {
    # code...
?>
    <h1 class="text-center" style="margin-bottom: 416px;">Harap hubungi CALL CENTER <b>SIKERJA</b> atau Bagian Pengembangan karir</h1>
<?php
}
?>

	

<!-- <div class="chat_wrapper">
    <section class="chatboxRL-popup" style="margin-top: 79px;height: 540px;">
        <header class="chatboxRL-popup_header">
            <aside> 
                <img src="https://gribot.radyalabs.id/assets/media/rita.png" class="chatboxRL-popup_avatar" alt="rita"> 
            </aside>
            <aside>
                <h1>Rita</h1> Chatbot (Online)
            </aside>
            <button id="buttonCloseRL" class="chatboxRL-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </button>
        </header>
        <main class="chatboxRL-popup_main">
            <ul id="chatListRL" class="chatRL-ul"><li class="chatRLhim">Halo,, saya Rita Kemendagri, dari Biro Kepegawaian, your virtual personal assisstant. Siap melayani anda</li></ul>
        </main>
        <footer class="chatboxRL-popup_footer">
            <aside style="flex:1;color:#888;text-align:center;">
                <i class="fa fa-paper-plane" aria-hidden="true"></i>
            </aside>
            <aside style="flex:10">
                <textarea type="text" class="textareaChatRL" id="textareaChatRL" placeholder="Type your message here..." autofocus=""></textarea>
            </aside>
        </footer>
    </section>
</div>
<div id="greeting" class="hide">
    <p>Halo,, saya Rita Kemendagri, dari Biro Kepegawaian, your virtual personal assisstant. Siap melayani anda</p>
</div>
<button id="buttonOpenRL" class="chatboxRL-open">
    <img src="https://gribot.radyalabs.id/assets/media/rita.png" alt="rita"> 
</button> -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/knob/jquery.knob.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jqWidget/js/jqxcore.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jqWidget/js/jqxdraw.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jqWidget/js/jqxgauge.js"></script>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script> -->

<!-- <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script> -->
<!-- <script type='text/javascript' src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script> -->
<!-- <script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/clockpicker/dist/bootstrap-clockpicker.min.js"></script> -->
<!-- <script src="http://chatbot.kemendagri.go.id/assets/js/signalr.js"></script>
<script src="http://chatbot.kemendagri.go.id/assets/js/widget.js"></script> -->

<!-- <script src="https://gribot.radyalabs.id/assets/js/signalr.js"></script>
<script src="https://gribot.radyalabs.id/assets/js/widget.js"></script> -->
<script>
    $("#profile-dashboard").hide();
    /** ----------------------------------------------------------------------- */    
    $(document).ready(function()
    {
        // profile('bypass');    
        get_api_fingerprint();        
        riwayat_pendidikan('bypass');    
        riwayat_pangkat();    
        riwayat_jabatan('bypass');
        simpeg_finger_kehadiran();
        // riwayat_diklat_struktural('bypass');       
        // riwayat_diklat_fungsional('bypass');
        // riwayat_diklat_teknis('bypass');
        // riwayat_konferensi('bypass');
        // karya_tulis('bypass');
        // organisasi('bypass');
        // penghargaan('bypass');        
        // Lobibox.window({
        //     title  : 'Informasi',
        //     content: '<div class="row" style="margin: 1px;"><h2>Yth, Pegawai di Lingkungan Kemendagri</h2></div>'+
        //               '<div class="row" style="margin: 1px;"><h4 style="text-align: JUSTIFY;">Penyesuian menit efektif Sikerja selama bulan Ramadhan 1441 H."</h4></div>'+
        //               '<div class="row" style="margin: 1px;"><h4 style="text-align: JUSTIFY;">Menit Efektif Sikerja Bulan April 2020 sebanyak 6450 Menit, Bulan Mei 2020 sebanyak 5220 menit."</h4></div>'                                  
        //             //   '<div class="row" style="margin: 1px;"><h4 style="text-align: JUSTIFY;">Berdasarkan Pasal 24 ayat (1) Permendagri 132 tahun 2018 tentang Tunjangan Kinerja Pegawai di Kementerian Dalam Negeri, "Pegawai mendapat pengurangan Tunjangan Kinerja sebesar 5% (lima persen) dari aspek Produktivitas Kerja apabila pegawai tidak mencapai sasaran target yang ditentukan."</h4></div>'+
        //             //   '<div class="row" style="margin: 1px;"><h4 style="text-align: JUSTIFY;">Untuk itu, pegawai dimohon terus meningkatkan kinerja dan berkoordinasi dengan atasan langsung perihal capaian target kinerja bulanan. Kepada atasan dimohon terus memonitoring kinerja bawahan dan memberikan penilaian capaian kinerja bulanan pada fitur menu dalam sistem SIkerja.</h4></div>'+
        //             //   '<div class="row" style="margin: 1px;"><h4 style="text-align: JUSTIFY;">Pemotongan akan berlaku terhitung mulai bulan Agustus 2019.</h4></div>'                                              
        // });        
        $('#mydata').dataTable();
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
        $('#gaugeContainer').jqxGauge('value', <?=(($summary_tr == '') ? 0 : $summary_tr[0]->prosentase_menit_efektif);?>);

        $("#btn-detail").click(function()
        {
            $("#modal-info-pegawai").modal('show');
        });
		
		//$("#modal-kuisioner").modal('show');
		
		$("#btn_ip").click(function() 
		{
				//alert("survey sementara dalam proses backup data !");
				//<?php $_SESSION['popup']=1;?>
				//window.location.href = "<?php echo site_url()?>dashboard/home";
				sessionStorage.setItem("showw", 1);
				$('#modal-kuisioner').modal('show');
				
			
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
                },
				error:function(jqXHR,exception)
				{
					ajax_catch(jqXHR,exception);					
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
                },
				error:function(jqXHR,exception)
				{
					ajax_catch(jqXHR,exception);					
				}                
            })		            				
        })


         $("#btn_tunjangan").click(function() 
        {
            $.ajax({
                url :"<?php echo site_url()?>dashboard/get_datamodal_tunjangan/1",
                type:"post",
                beforeSend:function(){
                    $("#loadprosess").modal('show');
                    $('.table-view').dataTable().remove();                    
                },
                success:function(msg){
                    $("#get-datatable2").html(msg);                 
                    $("#modal-transaksi-tunjangan").modal('show');
                    $("#loadprosess").modal('hide');                            
                },
                error:function(jqXHR,exception)
                {
                    ajax_catch(jqXHR,exception);                    
                }                
            })                                  
        })

        $("#btn_fingerprint").click(function() 
        {
            $.ajax({
                url :"<?php echo site_url()?>dashboard/get_datamodal_fingerprint/1",
                type:"post",
                beforeSend:function(){
                    $("#loadprosess").modal('show');
                    $('.table-view').dataTable().remove();                    
                },
                success:function(msg){
                    $("#get-datatable3").html(msg);                 
                    $("#modal-transaksi-fingerprint").modal('show');
                    $("#loadprosess").modal('hide');                            
                },
                error:function(jqXHR,exception)
                {
                    ajax_catch(jqXHR,exception);                    
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
                            ajax_status(obj);
                        },
                        error:function(jqXHR,exception)
                        {
                            ajax_catch(jqXHR,exception);					
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
                        ajax_status(obj);
                    },
                    error:function(jqXHR,exception)
                    {
                        ajax_catch(jqXHR,exception);					
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

    function view_option(arg) 
    {
        if(arg == 'main')
        {
            $("#loadprosess").modal('show');  
            $("#member_section_area").hide();                
            $("#main-dashboard").show();  
            $("#loadprosess").modal('hide');                        
        }
        else
        {
            $.ajax({
                url :"<?php echo site_url()?>laporan/statistik/get_statistik/"+arg,
                type:"post",
                beforeSend:function(){
                    $("#loadprosess").modal('show');
                },
                success:function(msg){
                    var obj = jQuery.parseJSON (msg);
                    if (obj.status == 1)
                    {
                        $("#main-dashboard").hide();
                        $('#member_section_area').css({"display":""});
                        $("#loadprosess").modal('hide');    
                        $("#member_section_oid").val(arg);
                        $("#f_name").val(obj.data.infoPegawai[0].nama_pegawai);
                        $("#f_name_es1").val(obj.data.infoPegawai[0].nama_jabatan);
                        $("#f_nip").val(obj.data.infoPegawai[0].nip);                                                                                                    

                        if(obj.data.skp.list_skp.length == 0)
                        {

                        }
                        else
                        {
                            $('#table_progress_skp').dataTable().fnDestroy();                            
                            $('#table_progress_skp tbody').remove();                                         
                            for(i=0;i<obj.data.skp.list_skp.length;i++)
                            {
                                // console.log(obj.data.skp.list_skp[i].kegiatan_skp_jfu);
                                realisasi_qty  = 0;
                                persentase_qty = 0;
                                if(obj.data.skp.list_skp[i].realisasi_kuantitas == null)
                                {
                                    persentase_qty = 0;
                                }
                                else
                                {
                                    persentase_qty = (obj.data.skp.list_skp[i].realisasi_kuantitas/obj.data.skp.list_skp[i].target_qty)*100;
                                }

                                kegiatan = "";
                                if (obj.data.skp.list_skp[i].id_skp_jfu == null && obj.data.skp.list_skp[i].id_skp_jft == null && obj.data.skp.list_skp[i].id_skp_master == null) 
                                {
                                    kegiatan = obj.data.skp.list_skp[i].kegiatan;                                    
                                }
                                else
                                {
                                    if (obj.data.infoPegawai[0].kat_posisi == 1) {
                                        kegiatan = obj.data.skp.list_skp[i].kegiatan_skp;
                                    }
                                    if (obj.data.infoPegawai[0].kat_posisi == 2) {
                                        kegiatan = obj.data.skp.list_skp[i].kegiatan_skp_jft;
                                    }                                
                                    else if (obj.data.infoPegawai[0].kat_posisi == 4) {
                                        kegiatan = obj.data.skp.list_skp[i].kegiatan_skp_jfu;
                                    }
                                }



                                $('#table_progress_skp').append('<tr class="child-urtug">'+
                                    '<td>'+
                                        '<span><i class="fa fa-dot-circle-o"></i></span>'+
                                    '</td>'+
                                    '<td style="max-width:30%;">'+kegiatan+'</td>'+
                                    '<td>'+
                                        '<div class="col-md-12">'+
                                            '<div class="progress-group">'+
                                                '<span class="progress-text">Progress SKP</span>'+
                                                '<span class="progress-number"><b id="progress_bar_persentase">'+Math.round(persentase_qty)+'</b>/100 %</span>'+
                                                '<div class="progress sm">'+
                                                    '<div class="progress-bar progress-bar-green" id="progress_bar_style" style="width: '+Math.round(persentase_qty)+'%"></div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+                                    
                                    '</td>'+                                                        
                                '</tr>');                           
                            }
                            $("#table_progress_skp").DataTable({
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
                                "bSort": false						 
                                // "dom": '<"top"f>rt'
                                // "dom": '<"top"fl>rt<"bottom"ip><"clear">'			
                            });                            
                        }                        

                        var config_bawahan = {
                            type: 'line',
                            data: {
                                labels: MONTHS,
                                datasets: [{
                                    label: 'Menit Efektif',
                                    data: VALUES,
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

                        var ctx_bawahan   = document.getElementById('canvas_member_menif_efektif').getContext('2d');
                            window.myLine = new Chart(ctx_bawahan, config_bawahan);
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
                error:function(jqXHR,exception)
                {
                    ajax_catch(jqXHR,exception);					
                }
            })
        }
    }   

    function get_api_fingerprint(){
        $.ajax({
            type  : 'ajax',
            url   : '<?php echo base_url()?>ro_peg/index',
            async : false,
            dataType : 'json',
            success : function(object){
                var html = '';
                var i = "";
                var j = "";
                var k = "";
                var sum_jumlah = 0;
                var total_tunjangan_="";
                
                console.log(object)
                //for(i in object)
                // console.log('lengthnya adalah ' + object.results.data.length);

                for(j=0;j < object.results.data.length;j++) 
                {
                    k = object.results.data[j].jumlah;
                    sum_jumlah = sum_jumlah + k;
                }

                //console.log('sum_jumlah nya adlaah ' + sum_jumlah);
                total_tunjangan_= object.results.info_pegawai[0].tunjangan - sum_jumlah;
                document.getElementById("total_tunjangan_").innerHTML = formatRupiah(total_tunjangan_);
                //$('total_tunjangan_').val(formatRupiah(total_tunjangan_));
            },
            error:function(jqXHR,exception)
            {
                document.getElementById("total_tunjangan_").innerHTML = 'N/A';
            }                

        });
    }    

    function formatRupiah(num) 
    {
        var p = num.toFixed(2).split(".");
        return "Rp. " + p[0].split("").reverse().reduce(function(acc, num, i, orig) {
            return  num=="-" ? acc : num + (i && !(i % 3) ? "," : "") + acc;
        }, "");
    }

    function approve_good_kinerja(arg,oid,oid_posisi) 
    {
        if (oid == 0) {
            var oid = $("#member_section_oid").val();            
        }
        
        tagline = '';
        if (arg == 'yes') {
            tagline = 'berkinerja baik dan mencapai skp bulan ini.';
        }
        else
        {
            tagline = 'berkinerja kurang baik dan belum mencapai skp bulan ini.'
        }

        tagline = "Apakah benar bahwa pegawai ini "+tagline;

        Lobibox.confirm({
            title: "Konfirmasi",
            msg  : tagline,
            callback: function ($this, type) {
                if (type === 'yes'){
                    $.ajax({
                        url :"<?php echo site_url()?>dashboard/post_penilaian_skp_bulan/"+arg+'/'+oid+'/'+oid_posisi,
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
</script>