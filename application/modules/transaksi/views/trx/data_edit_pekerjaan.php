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
                                                            $kegiatan            = $urtug[$i]->kegiatan;
                                                            if ($urtug[$i]->id_skp_master != '') {
                                                                # code...
                                                                $kegiatan            = $urtug[$i]->kegiatan_skp;                                
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
                                                <input type="text" id="tgl_mulai" name="tgl_mulai" class="form-control timerange" value="<?=$pekerjaan[0]->tanggal_mulai;?>">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label style="color: #000;font-weight: 400;font-size: 19px;">Tanggal Selesai</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                <input type="text" id="tgl_selesai" name="tgl_selesai" class="form-control timerange" value="<?=$pekerjaan[0]->tanggal_selesai;?>">
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
                                            <label style="color: #000;font-weight: 400;font-size: 19px;">Kuantitas</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                <input type="text" id="kuantitas" name="kuantitas" class="form-control" value="<?=$pekerjaan[0]->frekuensi_realisasi;?>">
                                                <span class="input-group-addon"><label id="param_out_skp"><?php echo $pekerjaan[0]->frekuensi_realisasi!=''?$pekerjaan[0]->target_output_name:". . ."; ?></label></span>
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
    $('.timerange').datepicker({
        format: 'yyyy-mm-dd'
    });    
    $(".timerange").datepicker({ maxDate: new Date});    

    $(".timerange").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
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

        var urtug = $("#urtug option:selected").text();
        var str = new String(urtug);
        var n = str.indexOf("perjalanan dinas");
        var n1 = str.indexOf("Perjalanan Dinas");        
        flag_urtug        = $("#flag_urtug").val();


        urtug             = $("#urtug").val();
        tgl_mulai         = $("#tgl_mulai").val();
        tgl_selesai       = $("#tgl_selesai").val();
        jam_mulai         = $("#jam_mulai").val();
        jam_selesai       = $("#jam_selesai").val();
        tgl_server        = current_date();
        ket_pekerjaan     = $("#ket_pekerjaan").val();
        kuantitas         = $("#kuantitas").val();
        file_pendukung    = $('#file_pendukung').prop('files')[0];        
        oid               = $("#oid").val();

        waktu_mulai       = tgl_mulai+" "+jam_mulai;
        waktu_selesai     = tgl_selesai+" "+jam_selesai;
        start_actual_time = new Date(waktu_mulai);        
        end_actual_time   = new Date(waktu_selesai);
        diff              = end_actual_time - start_actual_time;
        diff_date         = (new Date(tgl_selesai)) - (new Date(tgl_mulai));
        
        hari_efektif      = ((diff_date/1000) / 86400); 
        menit_efektif     = diff / 60000;                  


        if (urtug.length <= 0 || tgl_mulai.length <= 0 || tgl_selesai.length <= 0 || jam_mulai.length <= 0 || jam_selesai.length <= 0 || ket_pekerjaan.length <= 0 ) 
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Harap lengkapi data Pekerjaan."
            });
        }
        else
        {
            if (n > 0 || n1 > 0) {
                flag_urtug = 'perjalanan_dinas';
            }
            else {
                flag_urtug = '';
            }        

            if (tgl_mulai > tgl_server || tgl_selesai > tgl_server) 
            {
                Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                {
                    msg: "Tanggal tidak boleh melebihi jam server."
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
                    var form_data = new FormData();
                    form_data.append('file', file_pendukung);
                    $.ajax({
                        url: '<?php echo site_url();?>/transaksi/upload_file_pendukung/edit/'+oid, // point to server-side PHP script
                        // dataType: 'json',  // what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        beforeSend:function(){
                            $("#editData").modal('hide');
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
                                var data_sender = {
                                                        'oid'               : oid,
                                                        'urtug'             : urtug,
                                                        'flag_urtug'        : flag_urtug,
                                                        'tgl_mulai'         : tgl_mulai,
                                                        'tgl_selesai'       : tgl_selesai,
                                                        'jam_mulai'         : jam_mulai,
                                                        'jam_selesai'       : jam_selesai,
                                                        'ket_pekerjaan'     : ket_pekerjaan,
                                                        'kuantitas'         : kuantitas,
                                                        'menit_efektif'     : menit_efektif,
                                                        'hari_efektif'      : hari_efektif
                                                  };            
                                $.ajax({
                                    url :"<?php echo site_url();?>/transaksi/edit_pekerjaan",
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
                                                    window.location.href = "<?php echo site_url();?>/transaksi/home";
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
                                            msg: 'Gagal Menambah Pekerjaan'
                                        });
                                    }
                                })

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
                        error:function(){
                            Lobibox.notify('error', {
                                msg: 'Gagal Menambah Pekerjaan'
                            });
                        }                        
                    })
                }
                
            }
        }
    });   
}); 
</script>