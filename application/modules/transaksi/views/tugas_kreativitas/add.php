<div class="col-lg-12">
    <div class="box box-default">
        <div class="box-body">
            <div class="row">

                <div class="form-group col-md-12">
                    <label style="color: #000;font-weight: 400;font-size: 19px;">Nomor Surat Keterangan</label>
                    <input type="text" id="surat_keterangan" name="surat_keterangan" class="form-control tour-step step1">
                </div>

                <div class="form-group col-md-12">
                    <label style="color: #000;font-weight: 400;font-size: 19px;">Pejabat Penanda Tangan</label>
                    <select class="form-control tour-step step1" name="pejabat_penanda_tangan" id="pejabat_penanda_tangan">
                            <option value=""> - - - - Pilih Pejabat Penanda Tangan - - - -</option>
                            <?
                                if ($jenis->result_array()) {
                                    # code...
                                    $counter = $jenis->result_array();
                                    for ($i=0; $i < count($counter); $i++) { 
                                        # code...
                            ?>
                                        <option value="<?=$counter[$i]['id'];?>"><?=$counter[$i]['pejabat_penanda_tangan'];?></option>
                            <?php
                                    }
                                }
                            ?>
                    </select>
                </div>                

                <div class="form-group col-md-12">
                    <label style="color: #000;font-weight: 400;font-size: 19px;">File Surat Keterangan</label><label class="pull-right">(pdf|csv|zip|docx|doc|xlsx|xl|xls|jpg|jpeg)</label>
                    <input type="file" id="file_surat_keterangan" name="file_surat_keterangan" class="form-control tour-step step1">
                </div>                

                <div class="form-group col-md-12">
                    <label style="color: #000;font-weight: 400;font-size: 19px;">Keterangan</label>
                    <textarea class="form-control tour-step step1" id="keterangan" name="keterangan"></textarea>
                </div>                
            </div>
            <div class="box-footer">
                <a class="btn btn-primary btn-md pull-right" id="btn_save_all"> <i class="fa fa-plus-square"></i>&nbsp;Simpan</a>
            </div>            
        </div>                            
    </div>
</div>

<script type="text/javascript">
$(document).ready(function()
{
    $("#btn_save_all").click(function()
    {

        // body...
        nomor_surat            = $("#surat_keterangan").val();
        file_pendukung         = $('#file_surat_keterangan').prop('files')[0];        
        keterangan_surat       = $("#keterangan").val();
        pejabat_penanda_tangan = $("#pejabat_penanda_tangan").val();

        data_sender = {
                            'nomor_surat'            : nomor_surat,
                            'keterangan_surat'       : keterangan_surat,
                            'flag'                   : 'kreativitas',
                            'pejabat_penanda_tangan' : pejabat_penanda_tangan
        }

        if (keterangan.length <= 0 || nomor_surat.length <= 0 || file_pendukung == undefined) 
        {
            Lobibox.notify('warning', {
                msg: 'Harap lengkapi data-data pendukung.'
            });      
        }
        else
        {
            if (keterangan_surat.length <= 0) 
            {
                Lobibox.notify('warning', {
                    msg: 'Keterangan Wajib Diisi.'
                });
            }
            else
            {
                if (nomor_surat.length <= 0) 
                {
                    Lobibox.notify('warning', {
                        msg: 'Nomor Surat Wajib Diisi.'
                    });
                }
                else
                {
                    if (file_pendukung == undefined) 
                    {
                        Lobibox.notify('warning', {
                            msg: 'File Surat Wajib Diisi.'
                        });                    
                    }
                    else
                    {
                        // alert("send data");
                        var form_data = new FormData();
                        form_data.append('file', file_pendukung);
                        $.ajax({
                            url: '<?php echo site_url();?>/transaksi/upload_tugas_tambahan/add', // point to server-side PHP script
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
                                    $.ajax({
                                        url :"<?php echo site_url();?>/transaksi/add_data_tugas_tambahan_detail/"+obj1.id,
                                        type:"post",
                                        data:{data_sender : data_sender},                                    
                                        success:function(msg){
                                            var obj = jQuery.parseJSON (msg);             
                                            if (obj1.status == 1) 
                                            {
                                                Lobibox.notify('success', {
                                                    msg: obj1.text
                                                    });
                                                setTimeout(function(){ 
                                                    $("#loadprosess").modal('hide');
                                                    setTimeout(function(){
                                                        window.location.href = "<?php echo site_url()?>/transaksi/tugas_tambahan_dan_kreativitas/";
                                                    }, 1500);                                                                   
                                                }, 5000);               

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
                                        msg: obj1.text
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
                        });                                  
                    }
                }
            }
        }
        // console.log(nomor_surat);
        // console.log(file_pendukung);        
    });    
});    
</script>