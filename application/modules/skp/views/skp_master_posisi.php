<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/tabs-checked/css/style_tabs.css'; ?>");</style>
<style type="text/css">
#table_skp>thead>tr>th
{
    vertical-align: middle;    
    text-align: center;
    border: 1px solid rgba(158, 158, 158, 0.2);    
    padding-left: 25px;    
}

#table_skp>tbody>tr>td
{
    text-align: ;
    border: 1px solid rgba(158, 158, 158, 0.2);        
}

.data-before
{
    width: 100%;
    display: inline-block;
    padding: 3px 8px;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    touch-action: manipulation;
    pointer-events: none;
    user-select: none;
    background-image: none;
    border: 1px solid #9E9E9E;
    border-radius: 4px;
    background-color: #FF5722;
    color: #fff;    
}

.data-after
{
    width: 100%;
    display: inline-block;
    padding: 3px 8px;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    touch-action: manipulation;
    pointer-events: none;
    user-select: none;
    background-image: none;
    border: 1px solid #9E9E9E;
    border-radius: 4px;
    background-color: #8BC34A;
    color: #fff;       
}

.break-label
{
    padding-bottom: 13px;    
}
</style>

<div class="col-xs-12">
<!--     <div class="col-md-3">
        <label style="color: #000;font-weight: 400;font-size: 19px;display: -webkit-inline-box;">
            Tahun&nbsp;:&nbsp;&nbsp;
            <select class="form-control input-sm" name="tahun" id="tahun"></select>                    
        </label>
    </div>                              -->
    <div class="box">
        <div class="box-header">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Posisi</label>
                            <input class="form-control" disabled="disabled" value="<?=$info[0]['nama_posisi'];?>">
                        </div>
                    </div>
                </div>                
            </div>
            <hr>

            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-10">
                        <p>Pastikan untuk melakukan unduh terlebih dahulu untuk mendapatkan format yang akan digunakan untuk unggah data. <br/>                        
                    </div>
                    <div class="col-lg-2" style="padding-right: 0px;">
                        <h3 class="box-title pull-right">
                            <a href="<?php echo site_url()?>skp/template_master_skp/<?=$oid;?>" class="btn btn-block btn-primary">Unduh Template</a>
                        </h3>                           
                    </div>                
                </div>                
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <form id="upload_file" onsubmit="return validateForm()" method="post" action="<?php echo site_url()?>skp/import_master_skp/<?=$oid;?>" enctype="multipart/form-data">
                        <div class="col-lg-12">
                            <div class="col-lg-2"><span>Unggah dari Excel :</span></div>
                            <div class="col-lg-5">
                                <div class="uploader" >
                                    <input type="file" name="userfile" id="userfile" size="20" class="form-control text_controll required">
                                    <input type="hidden" name="param_report" id="param_report" value="status_upload">
                                </div>                      
                            </div>
                            <div class="col-lg-5" style="padding-right: 0px;">
                                <h3 class="box-title pull-right">
                                    <input type="submit" class="btn btn-block btn-primary" name="submit" id="submit" value="Unggah" />
                                </h3>                           
                            </div>
                        </div>
                    </form>        
                </div>
            </div>
            <hr>            
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-lg-2 pull-right">
                    <a href="#" id="addDataSKP" class="btn btn-block btn-primary">Tambah Master SKP</a>
                </div>
            </div>
            <table id="table_skp" class="table table-bordered table-striped table-view">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Kegiatan</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    if ($list != 0) {
                        # code...
                        for ($i=0; $i < count($list); $i++) { 
                            # code...
                ?>
                            <tr>
                                <td><?=$i+1;?></td>
                                <td><?=$list[$i]->kegiatan;?></td>
                                <td><?=$list[$i]->keterangan;?></td>                                    
                                <td>
                                    <?php
                                    if ($list[$i]->status == 1) {
                                        # code...
                                        echo "Aktif";
                                    }
                                    else
                                    {
                                        echo "Non Aktif";
                                    }
                                    ?>    
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-xs" style="margin-bottom:10px;" onclick="ubah_master_skp('<?=$list[$i]->id_skp;?>')"><i class="fa fa-edit"></i>&nbsp;Ubah</button>                                    
                                    <?php
                                    if ($list[$i]->status == 1) {
                                        # code...
                                    ?>
                                        <button class="btn btn-danger btn-xs" onclick="active_skp('<?=$list[$i]->id_skp;?>','0')"><i class="fa fa-close"></i>&nbsp;Non Aktif</button>                                                                        
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <button class="btn btn-success btn-xs" onclick="active_skp('<?=$list[$i]->id_skp;?>','1')"><i class="fa fa-check"></i>&nbsp;Aktifasi</button>                                                                        
                                    <?php
                                    }
                                    ?>                                        
                                </td>
                            </tr>
                <?php
                        }
                    }
                ?>
                </tbody>
            </table>            

        </div>
    </div>
</div>

<div class="example-modal">
<div class="modal modal-success fade" id="ubah_dataskp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="box-content">
        
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Formulir Sasaran Kerja Pegawai</h4>
                </div>
                <div class="modal-body" style="background-color: #fff!important;">

                    <div class="box box-default">
                        <div class="box-body">
                            <div class="row">

                                <div class="form-group col-md-12">
                                    <input type="hidden" id="oid" name="oid" class="form-control" >
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Kegiatan</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <textarea id="nkegiatan" name="nkegiatan" class="form-control"></textarea>
                                    </div>

                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Keterangan</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <textarea id="nketerangan" name="nketerangan" class="form-control"></textarea>
                                    </div>                                    
                                </div>
                                                                                                      
                            </div>
                        </div>                            
                    </div>


                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
                    <input type="submit" class="btn btn-primary" value="Simpan" id="btn_save_skp_edit"/>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="example-modal">
<div class="modal modal-success fade" id="tambah_dataskp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="box-content">
        
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Formulir Sasaran Kerja Pegawai</h4>
                </div>
                <div class="modal-body" style="background-color: #fff!important;">

                    <div class="box box-default">
                        <div class="box-body">
                            <div class="row">

                                <div class="form-group col-md-12">
                                    <input type="hidden" id="oid" name="oid" class="form-control" >
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Kegiatan</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <textarea id="tkegiatan" name="nkegiatan" class="form-control"></textarea>
                                    </div>

                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Keterangan</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <textarea id="tketerangan" name="nketerangan" class="form-control"></textarea>
                                    </div>                                    
                                </div>                                                                    
                            </div>
                        </div>                            
                    </div>


                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
                    <a class="btn btn-primary" id="btn_save_master_skp">Simpan</a>                    
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-1.12.4.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
function ubah_master_skp(id) {
    // body...
    $.getJSON('<?php echo site_url() ?>skp/get_master_skp_id/'+id,
        function( response ) {
            $('#ubah_dataskp').attr('class', 'modal fade bs-example-modal-lg').attr('aria-labelledby','myLargeModalLabel');
            $('.modal-dialog').attr('class','modal-dialog modal-lg');        
            $("#ubah_dataskp").modal('show');    
            // console.log();
            $("#oid").val(response[0]['id_skp']);
            $("#nkegiatan").val(response[0]['kegiatan']);
            $("#nketerangan").val(response[0]['keterangan']);            

            setTimeout(function(){ 
                $("#loadprosess").modal('hide');                                
            }, 1000);                                           
        }
    );
}

function active_skp(id,stat) {
    // body...
    txt_stat = "";
    if (stat == 1) 
    {
        txt_stat = "Ingin aktifkan skp ini ?";
    }
    else
    {
        txt_stat = "Ingin nonaktifkan skp ini ?";        
    }
    Lobibox.confirm({
        title   : "Konfirmasi",
        msg     : txt_stat,
        callback: function ($this, type) {
            if (type === 'yes'){
                $.ajax({
                    url :"<?php echo site_url()?>skp/active_skp_master/"+id+"/"+stat,
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


function del(id) {
    // body...
    Lobibox.confirm({
        title   : "Konfirmasi",
        msg     : "Anda akan hapus Target SKP ini ?",
        callback: function ($this, type) {
            if (type === 'yes'){
                $.ajax({
                    url :"<?php echo site_url()?>skp/delete_skp/"+id,
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

function arrow_up(id) {
    // body...
    $.ajax({
        url :"<?php echo site_url();?>skp/change_priority/"+id+"/up",
        type:"post",
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

function arrow_down(id) {
    // body...
    $.ajax({
        url :"<?php echo site_url();?>skp/change_priority/"+id+"/down",
        type:"post",
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

function validateForm() {
    // body...

    userfile   = $('#userfile').prop('files')[0];        

    // console.log(file_pendukung);
    if (userfile == undefined)
    {
        Lobibox.notify('warning', {
            msg: 'Harap lampirkan file excel terlebih dahulu'
            });        
        return false;
    }    
}

$(document).ready(function()
{
    $("#addDataSKP").click(function(){
        // body...
        $('#tambah_dataskp').attr('class', 'modal fade bs-example-modal-lg').attr('aria-labelledby','myLargeModalLabel');
        $('.modal-dialog').attr('class','modal-dialog modal-lg');        
        $("#tambah_dataskp").modal('show');
    })

    $("#btn_save_master_skp").click(function() {
        // body...
        var kegiatan   = $('#tkegiatan').val();
        var keterangan = $('#tkegiatan').val();

        if (kegiatan.length <= 0) 
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Kegiatan tugas jabatan wajib diisi."
            });            
        }
        else
        {
            var data_sender = {
                                    'kegiatan'  : kegiatan,
                                    'keterangan': keterangan
                                };                    
            $.ajax({
                url :"<?php echo site_url();?>skp/add_master_skp_posisi/"+'<?=$oid;?>',
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
    })



    $("#btn_save_skp_edit").click(function() {
        // body...
        var oid        = $('#oid').val();    
        var kegiatan   = $('#nkegiatan').val();
        var keterangan = $('#nketerangan').val();        


        if (kegiatan.length <= 0) 
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Kegiatan tugas jabatan wajib diisi."
            });            
        }
        else
        {
            var data_sender = {
                                    'id'            : oid,
                                    'kegiatan'      : kegiatan,
                                    'keterangan'    : keterangan
                                };                    
            $.ajax({
                url :"<?php echo site_url();?>/skp/edit_master_skp",
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
    })    

});
</script>