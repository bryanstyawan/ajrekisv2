<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/tabs-checked/css/style_tabs.css'; ?>");</style>
<div class="col-xs-12">
    <div class="box">
        <div class="box-header">
            <div class ="box-tools">
            </div>
        </div>
        <div class="box-body" id="isi">
            

            <div class="container col-lg-12" style="padding-top: 20px;">
                <ul class="nav nav-tabs">
                    <li class="active" style="background-color: #2196F3;"><a data-toggle="tab" href="#menu4"><i class="fa fa-edit"></i>&nbsp;&nbsp;Ubah Data Kinerja</a></li>                                        
                </ul>

                <div class="tab-content">

                    <div id="menu4" class="tab-pane fade active in">
                        <div class="col-lg-12">
                            <h2 class="text-center" style="background-color: #FF0000;color: #fff;">EQUAL WORK DESERVES EQUAL PAY</h2>                        

                            <div class="box-header with-border">
                                <div class="col-lg-12 text-center">
                                    <h2 class="box-title pull-left">Ubah Pekerjaan</h2>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box box-default">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <input type="hidden" name="oid" id="oid" value="<?=$pekerjaan[0]->id_pekerjaan;?>">
                                            <label style="color: #000;font-weight: 400;font-size: 19px;">Uraian Tugas</label>
                                            <select class="form-control tour-step step1" name="urtug" id="urtug">
                                                <option value="">Pilih Uraian Tugas</option>
                                                <?php
                                                    if ($urtug) {
                                                        # code...
                                                        $x = "";
                                                        for ($i=0; $i < count($urtug); $i++) { 
                                                            # code...
                                                            $x++;

                                                            $kegiatan = "";
                                                            if ($infoPegawai[0]->kat_posisi == 1) {
                                                                # code...
                                                                $kegiatan = $urtug[$i]->kegiatan_skp;
                                                            }
                                                            elseif ($infoPegawai[0]->kat_posisi == 4) {
                                                                # code...
                                                                $kegiatan = $urtug[$i]->kegiatan_skp_jfu;
                                                            }                                            

                                                ?>
                                                        <option value="<?php echo $urtug[$i]->skp_id;?>" <?php echo $urtug[$i]->skp_id==$pekerjaan[0]->id_uraian_tugas?"selected":""; ?>><?php echo $x.". ".$kegiatan;?></option>                                                    
                                                <?
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <input type="hidden" id="flag_urtug" name="flag_urtug">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label style="color: #000;font-weight: 400;font-size: 19px;">Tanggal Mulai</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                <input type="text" id="tgl_mulai" name="tgl_mulai" class="form-control timerange" value="<?=date("d-m-Y", strtotime($pekerjaan[0]->tanggal_mulai));?>">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label style="color: #000;font-weight: 400;font-size: 19px;">Tanggal Selesai</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                <input type="text" id="tgl_selesai" name="tgl_selesai" class="form-control timerange" value="<?=date("d-m-Y", strtotime($pekerjaan[0]->tanggal_selesai));?>">
                                            </div>
                                        </div>                                        

                                        <div class="form-group col-md-6">
                                            <label style="color: #000;font-weight: 400;font-size: 19px;">Jam Mulai</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                <input type="text" id="jam_mulai" name="jam_mulai" class="form-control timemasking" data-inputmask="'mask': ['99:99']" data-mask value="<?=$pekerjaan[0]->jam_mulai;?>">
                                            </div>
                                        </div>    

                                        <div class="form-group col-md-6">
                                            <label style="color: #000;font-weight: 400;font-size: 19px;">Jam Selesai</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                <input type="text" id="jam_selesai" name="jam_selesai" class="form-control timemasking" data-inputmask="'mask': ['99:99']" data-mask value="<?=$pekerjaan[0]->jam_selesai;?>">
                                            </div>
                                        </div>                                            

                                        <div class="form-group col-md-12">
                                            <label style="color: #000;font-weight: 400;font-size: 19px;">Keterangan Pekerjaan</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                <textarea id="ket_pekerjaan" name="ket_pekerjaan" class="form-control"><?=$pekerjaan[0]->nama_pekerjaan;?></textarea>
                                            </div>
                                        </div>                                            

                                        <div class="form-group col-md-6">
                                            <input type="hidden" id="hdn_param_out_skp">
                                            <input type="hidden" id="hdn_param_qty_skp" value="<?=$pekerjaan[0]->target_qty;?>">
                                            <input type="hidden" id="hdn_param_realisasi_qty_skp" value="<?=$pekerjaan[0]->realisasi_skp;?>">                                        
                                            <label style="color: #000;font-weight: 400;font-size: 19px;">Kuantitas</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                <input type="text" id="kuantitas" name="kuantitas" class="form-control" value="<?=$pekerjaan[0]->frekuensi_realisasi;?>">
                                                <span class="input-group-addon"><label id="param_out_skp">Target Kuantitas SKP : <?=$pekerjaan[0]->target_qty;?> <?php echo $pekerjaan[0]->frekuensi_realisasi!=''?$pekerjaan[0]->target_output_name:". . ."; ?></label></span>
                                            </div>
                                            <div>
                                                <span class="input-group-addon"><label id="param_realisasi_qty_skp">Realisasi : <?=$pekerjaan[0]->realisasi_skp;?></label></span>
                                            </div>

                                        </div>                                        

                                        <div class="form-group col-md-6">
                                            <label style="color: #000;font-weight: 400;font-size: 19px;">File Pendukung</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                <input type="file" id="file_pendukung" name="file_pendukung" class="form-control">
                                            </div>
                                        </div>                                                                                    

                                        <div class="form-group col-md-12">
                                            <div class="row">
                                                <div class="col-md-6 pull-right">
                                                    <span class="input-group-btn">
                                                        <a class="btn btn-app pull-right" id="btn_save"><i class="fa fa-save"></i> Simpan</a>
                                                    </span>
                                                </div>
<!--                                                 <div class="col-md-6">
                                                   <a class="btn btn-block btn-social btn-google" onclick="reset()"><i class="fa fa-eraser"></i> Batal </a>
                                                </div> -->
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
</div>

<script type="text/javascript">
    
$(document).ready(function()
{    
    $("[data-mask]").inputmask();        
    $("#urtug").change(function(){
        var urtug = $("#urtug option:selected").text();
        var str = new String(urtug);
        var n = str.indexOf("perjalanan dinas");
        var n1 = str.indexOf("Perjalanan Dinas");        

        if (n > 0 || n1 > 0) {
            console.log("lock");
            $(".timemasking").prop('disabled', true);   
            $(".timemasking").val('08:00:00');
            $("#flag_urtug").val('perjalanan_dinas');                     
        }
        else {
            console.log("unlock");
            $(".timemasking").prop('disabled', false); 
            $(".timemasking").val('');
            $("#flag_urtug").val('-');                                                        
        }

        var id = $("#urtug").val();
        $.ajax({
            url :"<?php echo site_url()?>/transaksi/get_detail_skp",
            type:"post",
            data:"id="+id,
            beforeSend:function(){
                $("#loadprosess").modal('show');                
            },                      
            success:function(msg){
                var obj = jQuery.parseJSON (msg);                             
                $("#param_out_skp").html(obj.target_output_name);
                setTimeout(function(){ 
                    $("#loadprosess").modal('hide');                                
                }, 2000);                               
            }
        })        
    })   

    $("#btn_save").click(function()
    {
        flag_urtug     = $("#flag_urtug").val();
        urtug          = $("#urtug").val();
        tgl_mulai      = change_format_date($("#tgl_mulai").val(),'yyyy-mm-dd');
        tgl_selesai    = change_format_date($("#tgl_selesai").val(),'yyyy-mm-dd');
        jam_mulai      = $("#jam_mulai").val();
        jam_selesai    = $("#jam_selesai").val();
        tgl_server     = current_date();
        ket_pekerjaan  = $("#ket_pekerjaan").val();
        kuantitas      = $("#kuantitas").val();
        file_pendukung = $('#file_pendukung').prop('files')[0];
        oid            = $("#oid").val();

        waktu_mulai        = tgl_mulai+" "+jam_mulai;
        waktu_selesai      = tgl_selesai+" "+jam_selesai;

        start_actual_time  = new Date(waktu_mulai);
        end_actual_time    = new Date(waktu_selesai);
        server_actual_time = new Date();
        diff               = end_actual_time - start_actual_time;
        diff_date          = (new Date(tgl_selesai)) - (new Date(tgl_mulai));

        hari_efektif       = ((diff_date/1000) / 86400);
        menit_efektif      = diff / 60000;

        flag_param_out_skp = '';
        param_out_skp      = $("#hdn_param_out_skp").val();

        realisasi_qty      = $("#hdn_param_realisasi_qty_skp").val();
        total_qty          = +realisasi_qty + +kuantitas;
        target_qty         = $("#hdn_param_qty_skp").val();

        var data_sender = {
                                'oid'          : oid,
                                'urtug'        : urtug,
                                'flag_urtug'   : flag_urtug,
                                'tgl_mulai'    : tgl_mulai,
                                'tgl_selesai'  : tgl_selesai,
                                'jam_mulai'    : jam_mulai,
                                'jam_selesai'  : jam_selesai,
                                'ket_pekerjaan': ket_pekerjaan,
                                'kuantitas'    : kuantitas,
                                'menit_efektif': menit_efektif,
                                'hari_efektif' : hari_efektif
                            };

        if (urtug.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Uraian Tugas kosong, mohon lengkapi data tersebut"
            });
        }
        else if (tgl_mulai.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Tanggal mulai kosong, mohon lengkapi data tersebut"
            });
        }
        else if (tgl_selesai.length <= 0 )
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Tanggal selesai kosong, mohon lengkapi data tersebut"
            });
        }
        else if (jam_mulai.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Jam mulai kosong, mohon lengkapi data tersebut"
            });
        }
        else if (jam_selesai.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Jam selesai kosong, mohon lengkapi data tersebut"
            });
        }
        else if ( ket_pekerjaan.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Keterangan kosong, mohon lengkapi data tersebut"
            });
        }
        else
        {
            if (tgl_mulai > tgl_server || tgl_selesai > tgl_server)
            {
                Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                {
                    msg: "Tanggal tidak boleh melebihi Tanggal server."
                });
            }
            else
            {
                if (diff < 0)
                {
                    Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                    {
                        msg: "Tanggal dan jam awal tidak boleh melebihi tanggal dan jam selesai."
                    });
                }
                else
                {
                    if (end_actual_time > server_actual_time)
                    {
                        Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                        {
                            msg: "Jam tidak boleh melebihi jam server."
                        });
                    }
                    else
                    {
                        if (total_qty > target_qty)
                        {
                            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                            {
                                msg: "Kuantitas melebihi target yang ditentukan."
                            });
                        }
                        else
                        {
                            // console.log('kuantitas : '+kuantitas);
                            // console.log('file_pendukung : '+file_pendukung);
                            if (kuantitas != 0) {
                                if (file_pendukung != undefined)
                                {
                                    send_data_ubah(data_sender,oid);
                                }
                                else
                                {
                                    send_data_ubah_without_file(data_sender);                                    
                                    // if (param_out_skp != 'Frekuensi')
                                    // {
                                    //     Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                                    //     {
                                    //         msg: "Wajib menyertakan file pendukung sebagai bukti realisasi"
                                    //     });                                        
                                    // }
                                    // else {
                                    //     send_data_ubah(data_sender);
                                    // }                                    
                                }
                            }
                            else 
                            {
                                send_data_ubah_without_file(data_sender);
                            }
                        }

                    }
                }
            }
        }
    })
}); 

function send_data_ubah_without_file(data_sender) {
    $.ajax({
        url :"<?php echo site_url();?>transaksi/edit_pekerjaan/",
        type:"post",
        data:{data_sender : data_sender},
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

function send_data_ubah(data_sender,oid) {
    file_pendukung = $('#file_pendukung').prop('files')[0];
    var form_data  = new FormData();
    form_data.append('file', file_pendukung);
    $.ajax({
        url: '<?php echo site_url();?>transaksi/upload_file_pendukung/edit/'+oid, // point to server-side PHP script
        // dataType: 'json',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        beforeSend:function(){
            $("#loadprosess").modal('show');
            Lobibox.notify('info', {
                msg: 'Menyiapkan data untuk upload file'
            });
        },
        success: function(msg1){
            var obj1 = jQuery.parseJSON (msg1);
            console.log(msg1);
            if (obj1.status == 1)
            {
                $.ajax({
                    url :"<?php echo site_url();?>transaksi/add_pekerjaan/"+obj1.id,
                    type:"post",
                    data:{data_sender : data_sender},
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
            else
            {
                Lobibox.notify('warning', {
                    msg: obj1.text
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
    });
}
</script>