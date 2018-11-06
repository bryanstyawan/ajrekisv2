
<?php 
$data_value = json_encode($class_posisi);
?>
<div class="col-xs-12">
	<div class="box">
        <div class="box-header">
			<div class="box-tools">
			</div>
        </div>
        <div class="box-body" id="isi">
            <div class="row">
                <div class="col-lg-6">
                    <input type="hidden" id="flag_crud" name="flag_crud" value="<?=$flag_crud;?>">
                    <input type="hidden" id="oid" name="oid" value="<?=($list != '' ) ? $list[0]->id :'';?>">                    

                    <div class="form-group">
                        <label style="color: #000;font-weight: 400;font-size: 19px;">Nama Jabatan</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                            <input type="text" id="nama_jabatan" name="nama_jabatan" class="form-control" value="<?=($list != '' ) ? $list[0]->nama_jabatan :'';?>" >
                        </div>
                    </div>            

                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label style="color: #000;font-weight: 400;font-size: 19px;">Kelas Jabatan</label>
                        <select class="form-control tour-step step1" name="class_jabatan" id="class_jabatan">
                        <option value=0>Pilih Kelas Jabatan</option>
			                    	<?php
			                    		for ($i=0; $i < count($class_posisi) ; $i++) {
			                    			# code...
			                    	?>
                                            <option <?=($list != '' ) ? (($list[0]->id_kelas_jabatan == $class_posisi[$i]->id ) ? 'selected' :'') :'';?> value="<?=$class_posisi[$i]->id;?>"><?=$class_posisi[$i]->posisi_class;?></option>
									<?php
			                    		}
			                    	?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label style="color: #000;font-weight: 400;font-size: 19px;">Tunjangan</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                            <input type="text" id="tunjangan_class" name="tunjangan_class" class="form-control" disabled="disabled">
                        </div>
                    </div>                                           
                </div>
            </div>
        </div>
        <div class=box-footer>
            <div class="row pull-right">
                <div class="col-lg-12">
                    <a class="btn btn-success" id="btn-add-data"><i class="fa fa-save"></i> Simpan</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xs-12">
	<div class="box">
        <div class="box-header">
			<div class="box-tools">
			</div>
        </div>
        <div class="box-body" id="isi">
            <input id="index-table" type="hidden">
            <table class="table table-bordered table-striped table-view">
                <thead>
                    <tr>
                        <th></th>
                        <th>Uraian Tugas</th>
                        <th>Tahun</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <th><input type="hidden" id="uraian_tugas_oid"></th>
                        <th>
                            <input type="text" id="uraian_tugas" class="col-lg-12" >
                        </th>
                        <th>
                            <input type="number" id="uraian_tugas_tahun" class="col-lg-12" >                        
                        </th>                                                
                        <th>
                            <a class="btn btn-default" id="btn-add-row"><i class="fa fa-plus"></i> Tambah</a>
                            <a class="btn btn-default" id="btn-change-this-row" style="display:none"><i class="fa fa-edit"></i> Ubah data yang telah ditandai ini</a>                            
                        </th>
                    </tr>                    
                </thead>
                <tbody>
                    <?php
                        if ($list_detail != 0 || $list_detail != '') {
                            # code...
                            for ($i=0; $i < count($list_detail); $i++) { 
                                # code...
                    ?>
                                <tr class="child-urtug">
                                    <td><span><?=$list_detail[$i]->id;?></span></td>
                                    <td><?=$list_detail[$i]->uraian_tugas;?></td>
                                    <td><?=$list_detail[$i]->tahun;?></td>                                    
                                    <td><a class="btn btn-danger btn-delete" onclick="del('<?php echo $list_detail[$i]->id;?>')"><i class="fa fa-delete"></i> Hapus Data (Server)</a> | <a class="btn btn-warning btn-update-data"><i class="fa fa-delete"></i> Ubah<input type="hidden" value="<?=$i+1;?>"></a><a class="btn btn-danger btn-cancel" style="display:none"><i class="fa fa-delete"></i> Batal<input type="hidden" value="<?=$i+1;?>"></a></td>                                                                        
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

<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/	dataTables.bootstrap.min.js"></script>
<script>

function fill(arg) {
    var VALUES = jQuery.parseJSON('<?=$data_value;?>');
    if (arg == 0) {
        $("#tunjangan_class").val('');            
    }
    else
    {
        for (index = 0; index < VALUES.length; index++) {
            if (VALUES[index].id == arg) {
                $("#tunjangan_class").val('Rp. '+VALUES[index].tunjangan);
            }
        }            
    }
}

$(document).ready(function(){
    fill($("#class_jabatan").val());
    $("#class_jabatan").change(function(){
        var VALUES = jQuery.parseJSON('<?=$data_value;?>');
        if (this.value == 0) {
            $("#tunjangan_class").val('');            
        }
        else
        {
            for (index = 0; index < VALUES.length; index++) {
                if (VALUES[index].id == this.value) {
                    $("#tunjangan_class").val('Rp. '+VALUES[index].tunjangan);
                }
            }            
        }
    })

    $("#btn-add-data").click(function() {
        var nama_jabatan  = $("#nama_jabatan").val();
        var class_jabatan = $("#class_jabatan").val();
        var data_detail   = [];
        var data_rows     = $('.table-view tbody tr');
        var rows          = $('.table-view tbody .child-urtug').length;

        
        if(nama_jabatan.length <= 0 || class_jabatan <= 0 || rows <= 0)
        {
            if(nama_jabatan <= 0)
            {
                Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                {
                    msg: "Nama Jabatan kosong, mohon lengkapi data tersebut"
                });                
            }
            else if(class_jabatan <= 0)
            {
                Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                {
                    msg: "Kelas Jabatan kosong, mohon lengkapi data tersebut"
                });                
            }
            else if (rows <= 0) {
                Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                {
                    msg: "Uraian Tugas kosong, mohon lengkapi data tersebut"
                });                                
            }
        }
        else
        {
            $("#loadprosess").modal('show');            
            for (index = 1; index <= data_rows.length; index++) {            
                raise_data      = $('.table-view tbody > tr:nth-child('+index+') > td:nth-child(2)').html();
                raise_data_year = $('.table-view tbody > tr:nth-child('+index+') > td:nth-child(3)').html();
                flag            = $('.table-view tbody > tr:nth-child('+index+') > td:nth-child(4) > a.btn.btn-danger.btn-delete').html();
                oid             = $('.table-view tbody > tr:nth-child('+index+') > td:nth-child(1) > span').html();
                if (flag == '<i class="fa fa-delete"></i> Hapus Data (Server)') {
                    flag = 'update';
                }
                else if(flag == '<i class="fa fa-delete"></i> Hapus Data (Local)')
                {
                    flag = 'create';
                }

                if (oid == '<i class="fa fa-dot-circle-o"></i>') {
                    oid = 0;
                }
                data_detail[index-1] = {'uraian_tugas' : raise_data, 'uraian_tugas_tahun' :  raise_data_year, 'flag' : flag , 'OID' : oid}
            }

            data_header = {
                'nama_jabatan' : nama_jabatan,
                'class_jabatan': class_jabatan,
                'flag'         : $("#flag_crud").val(),
                'oid'          : $("#oid").val()
            }

            console.log(data_header);
            console.log(data_detail);                                

            $.ajax({
                url :"<?php echo site_url();?>master/jabatan_fungsional_tertentu/process_data/"+$("#flag_crud").val(),
                type:"post",
                data:{data_header : data_header, data_detail : data_detail},
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
                                location.reload();
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
                        msg: 'Gagal melakukan transaksi'
                    });
                }
            })

        }
    })

    $("#btn-change-this-row").click(function(){
        var uraian_tugas       = $("#uraian_tugas").val();
        var uraian_tugas_tahun = $("#uraian_tugas_tahun").val();
        var uraian_tugas_oid   = $("#uraian_tugas_oid").val();

        data_header = {
            'id'          : uraian_tugas_oid,
            'uraian_tugas': uraian_tugas,
            'tahun'       : uraian_tugas_tahun,
            'oid'         : $("#oid").val()
        }

        if(uraian_tugas.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                {
                    msg: "Uraian Tugas kosong, mohon lengkapi data tersebut"
                });                                
        }
        else if(uraian_tugas_tahun.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                {
                    msg: "Tahun Uraian Tugas kosong, mohon lengkapi data tersebut"
                });                                
        }
        else
        {
            $.ajax({
                url :"<?php echo site_url();?>master/jabatan_fungsional_tertentu/process_data_single/",
                type:"post",
                data:{data_sender : data_header},
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
                                location.reload();
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
                        msg: 'Gagal melakukan transaksi'
                    });
                }
            })            
        }
    })

    $(".btn-update-data").click(function() {
        index = $(this).find("input[type='hidden']").val();
        $('#index-table').val(index);
        text = $('.table-view tbody > tr:nth-child('+index+') > td:nth-child(2)').html();
        year = $('.table-view tbody > tr:nth-child('+index+') > td:nth-child(3)').html();
        oid  = $('.table-view tbody > tr:nth-child('+index+') > td:nth-child(1) > span').html();

        $('.table-view tbody > tr:nth-child('+index+')').css({"background-color":"yellow"});
        $("#btn-add-row").css({"display":"none"});        
        $("#btn-change-this-row").css({"display":""});                
        $('#uraian_tugas').val(text);
        $('#uraian_tugas_tahun').val(year);        
        $('#uraian_tugas_oid').val(oid);                

        $(".btn-update-data").css({"display":"none"});
        $(this).css({"display":"none"});
        $('.table-view tbody > tr:nth-child('+index+') > td:nth-child(3) > a.btn.btn-danger.btn-cancel').css({"display":""});
    });

    $(".btn-cancel").click(function() {
        index = $(this).find("input[type='hidden']").val();
        $('#index-table').val(index);        
        text  = "";

        $('.table-view tbody > tr:nth-child('+index+')').css({"background-color":""});
        $("#btn-add-row").css({"display":""});        
        $("#btn-change-this-row").css({"display":"none"});                
        $('#uraian_tugas').val(text);

        $(".btn-update-data").css({"display":""});
        $(this).css({"display":"none"});
        $('.table-view tbody > tr:nth-child('+index+') > td:nth-child(3) > a.btn.btn-warning.btn-update-data').css({"display":""});
    });    

    $("#btn-add-row").click(function() {
        var uraian_tugas       = $("#uraian_tugas").val();
        var uraian_tugas_tahun = $("#uraian_tugas_tahun").val();
        
        if (uraian_tugas.length <= 0) {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Uraian Tugas kosong, mohon lengkapi data tersebut"
            });                            
        }
        else if(uraian_tugas_tahun.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Tahun Uraian Tugas kosong, mohon lengkapi data tersebut"
            });                            
        }
        else
        {
            var rows = $('.table-view tbody .child-urtug').length;
            if (rows == 0) {
                $('.table-view tbody').remove();            
                $('.table-view').append('<tr class="child-urtug">'+
                                    '<td>'+
                                        '<span><i class="fa fa-dot-circle-o"></i></span>'+
                                    '</td>'+
                                    '<td>'+uraian_tugas+'</td>'+
                                    '<td>'+uraian_tugas_tahun+'</td>'+                                    
                                    '<td><a class="btn btn-danger btn-delete"><i class="fa fa-delete"></i> Hapus Data (Local)</a></td>'+                                
                                '</tr>');                            
            }
            else
            {
                $('.table-view').append('<tr class="child-urtug">'+
                                    '<td>'+
                                        '<span><i class="fa fa-dot-circle-o"></i></span>'+
                                    '</td>'+
                                    '<td>'+uraian_tugas+'</td>'+
                                    '<td><a class="btn btn-danger btn-delete"><i class="fa fa-delete"></i> Hapus Data (Local)</a></td>'+                                
                                '</tr>');                
            }            

            $('#uraian_tugas').val('');
            $('#uraian_tugas_tahun').val('');        
            $('#uraian_tugas').focus();        
        }
    })    
});

function del(id){
    Lobibox.confirm({
        title: "Konfirmasi",
        msg: "Anda yakin akan menghapus data ini ?",
        callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>master/jabatan_fungsional_tertentu/delete_uraian_tugas_jfu/"+id,
					type:"post",
					beforeSend:function(){
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
                                    location.reload();
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
					msg: 'Gagal Melakukan Hapus data'
					});
					}
				})
			}
	    }
    })
}
</script>
