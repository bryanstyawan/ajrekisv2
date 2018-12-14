<?php
$data_bulan[] = "";
$data_value[] = "";
$data_menit = "";
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

<?php
$this->load->view('dashboard_component/style_component');
$this->load->view('dashboard_component/php_logic_component');
?>

<div class="col-md-12 tour-step tour1" id="main-dashboard">
    <div class="row">
    <?php
    $this->load->view('dashboard_component/banner_user_component',array(
        'nama_pegawai' => $nama_pegawai,
        'nama_jabatan' => $nama_jabatan));
    $this->load->view('dashboard_component/persentase_speedometer_component');                
    $this->load->view('dashboard_component/member_component');                            
    $this->load->view('dashboard_component/chart_pencapaian_menit_efektif_component',array('data_value'=>$data_value,'data_bulan'=>$data_bulan));                    
    ?>
    </div>
        
    <?php
    $this->load->view('dashboard_component/common_component',array(
        'class'     => 'col-lg-3 col-xs-8',
        'id'        => 'btn_masih_diproses',
        'color_box' => 'background-color: #d2d6de !important;',
        'icon'      => array('name'=>'fa fa-hourglass-end','style'=>'background-color: #00a7d0;','value'=>''),
        'value_php' => $belum_diperiksa,
        'title'     => 'PEKERJAAN BELUM DIPERIKSA',
        'html'      => ''));
    $this->load->view('dashboard_component/common_component',array(
        'class'     => 'col-lg-2 col-xs-8',
        'id'        => 'btn_realisasi_menit_efektif',
        'color_box' => 'background-color: #d2d6de !important;',
        'icon'      => array('name'=>'fa fa-clock-o','style'=>'background-color: #673AB7;','value'=>''),
        'value_php' => number_format($data_transaksi[0]->menit_efektif),
        'title'     => 'REALISASI MENIT KERJA EFEKTIF',
        'html'      => ''));                
    $this->load->view('dashboard_component/common_component',array(
        'class'     => 'col-lg-2 col-xs-8',
        'id'        => '',
        'color_box' => 'background-color: #d2d6de !important;',
        'icon'      => array('name'=>'','style'=>'background-color: #00a7d0;font-size: 43px;','value'=>'Rp'),
        'value_php' => number_format($data_transaksi[0]->real_tunjangan_kinerja),
        'title'     => 'TUNJANGAN',
        'html'      => ''));
    $this->load->view('dashboard_component/common_component',array(
        'class'     => 'col-lg-2 col-xs-8',
        'id'        => '',
        'color_box' => 'background-color: #d2d6de !important;',
        'icon'      => array('name'=>'fa fa-clock-o','style'=>'background-color: #673AB7;','value'=>''),
        'value_php' => 0,
        'title'     => 'FINGERPRINT',
        'html'      => ''));
    $this->load->view('dashboard_component/common_component',array(
        'class'     => 'col-lg-3 col-xs-8',
        'id'        => '',
        'color_box' => 'background-color: #d2d6de !important;',
        'icon'      => array('name'=>'','style'=>'background-color: #00a7d0;font-size: 43px;','value'=>'%'),
        'value_php' => $skp['persentase_target_realisasi']->persentase,
        'title'     => 'CAPAIAN SKP',
        'html'      => "<label>".$skp['persentase_target_realisasi']->total_target_kuantitas.' / '.$skp['persentase_target_realisasi']->total_realisasi_kuantitas."</label>"));                                        
    ?>
</div>

<?php
$this->load->view('dashboard_component/bawahan_component');
$this->load->view('dashboard_component/change_profile_component',array('nama_agama'=>$nama_agama));
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
?>

<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/knob/jquery.knob.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jqWidget/js/jqxcore.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jqWidget/js/jqxdraw.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jqWidget/js/jqxgauge.js"></script>
<script>
    $("#profile-dashboard").hide();
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

                    console.table(obj.data.skp.list_skp);
                    MONTHS = [];
                    VALUES = [];
                    for(i=0;i<obj.data.menit_efektif_year.length;i++)
                    {
                        VALUES[i] = obj.data.menit_efektif_year[i].menit_efektif;
                        MONTHS[i] = obj.data.menit_efektif_year[i].nama_bulan;                        
                    }

                    if (obj.status == 1)
                    {
                        $("#main-dashboard").hide();
                        $('#member_section_area').css({"display":""});
                        $("#loadprosess").modal('hide');    
                        $("#member_section_oid").val(arg);
                        $("#f_name").val(obj.data.infoPegawai[0].nama_pegawai);
                        $("#f_name_es1").val(obj.data.infoPegawai[0].nama_eselon1);
                        $("#f_name_es2").val(obj.data.infoPegawai[0].nama_eselon2);
                        $("#f_name_es3").val(obj.data.infoPegawai[0].nama_eselon3);
                        $("#f_name_es4").val(obj.data.infoPegawai[0].nama_eselon4);
                        $("#f_nip").val(obj.data.infoPegawai[0].nip);                                                                                                    

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
</script>