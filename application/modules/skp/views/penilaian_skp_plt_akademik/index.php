<div id="main-dashboard">
    <?php
        $this->load->view('dashboard/dashboard_component/member_component');
    ?>
</div>

<div class="col-lg-7" id="view_member">
    <?php
    $this->load->view('dashboard/dashboard_component/bawahan_component');
    ?>
</div>


<script>
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

                    // console.table(obj.data.skp.list_skp);

                    MONTHS = [];
                    VALUES = [];
                    for(i=0;i<obj.data.menit_efektif_year.length;i++)
                    {
                        VALUES[i] = obj.data.menit_efektif_year[i].menit_efektif;
                        MONTHS[i] = obj.data.menit_efektif_year[i].nama_bulan;                        
                    }

                    if (obj.status == 1)
                    {
                        // $("#main-dashboard").hide();
                        $('#member_section_area').css({"display":""});
                        $("#loadprosess").modal('hide');    
                        $("#member_section_oid").val(arg);
                        $("#f_name").val(obj.data.infoPegawai[0].nama_pegawai);
                        $("#f_name_es1").val(obj.data.infoPegawai[0].nama_jabatan);
                        // $("#f_name_es2").val(obj.data.infoPegawai[0].nama_eselon2);
                        // $("#f_name_es3").val(obj.data.infoPegawai[0].nama_eselon3);
                        // $("#f_name_es4").val(obj.data.infoPegawai[0].nama_eselon4);
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
                                console.log(obj.data.skp.list_skp[i].kegiatan_skp_jfu);
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
    
    function approve_good_kinerja(arg,oid) 
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
                        url :"<?php echo site_url()?>dashboard/post_penilaian_skp_bulan/"+arg+'/'+oid,
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