<div class="col-xs-12">
	<div class="box">
        <div class="box-header">
			<h3 class  ="box-title pull-right"><button class="btn btn-block btn-primary" id="addData"><i class="fa fa-plus-square"></i> Tambah Menu</button></h3>
			<div class ="box-tools">
			</div>
        </div>
        <div class="box-body" id="isi">
            <table id="example1" class="table table-bordered table-striped table-view">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama Menu</th>
                    <th>Url Page</th>
                    <th>Icon</th>
                    <th>Action</th>
                    <th>Remark</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($list != 0) {
                            # code...
                            $flag_active = '';
                            for ($i=0; $i < count($list); $i++) { 
                                # code...
                                if ($list[$i]->flag == 0) {
                                    # code...
                                    $flag_active = 'style="background-color: #FF9800;"';
                                }
                    ?>
                                <tr <?=$flag_active;?>>
                                    <td><?=$i+1;?></td>
                                    <td><?=$list[$i]->nama_menu;?></td>
                                    <td><?=base_url();?><?=$list[$i]->url_pages;?></td>
                                    <td class="text-center"><i class="<?=$list[$i]->icon;?>" style="color:#605ca8;"></i></td>
                                    <td>
                                        <a class='btn btn-warning' onclick='edit(<?=$list[$i]->id_menu;?>)'><i class='fa fa-edit'></i> Ubah</a>
                    <?php 
                                            if ($list[$i]->flag == 0) {
                                                # code...
                    ?>
                                                <a class='btn btn-success' onclick='active(<?=$list[$i]->id_menu;?>,1)'><i class='fa fa-circle-o-notch'> Aktif</i></a>                                        
                    <?php                                                
                                            }
                                            else {
                                                # code...
                    ?>
                                                <a class='btn btn-danger' onclick='active(<?=$list[$i]->id_menu;?>,0)'><i class='fa fa-circle-o-notch'> Tidak Aktif</i></a>                                        
                    <?php
                                            }

                                            if ($list[$i]->child == 0) {
                                                # code...
                                                if ($list[$i]->id_parent == 0) {
                                                    # code...
                    ?>
                                                    <a class='btn btn-success' onclick='branch(<?=$list[$i]->id_menu;?>)'><i class='fa  fa-code-fork'></i>&nbsp;&nbsp; Tambah Cabang</a>                    
                                                    <a class='btn btn-danger' onclick='del(<?=$list[$i]->id_menu;?>)'><i class='fa fa-trash'></i> Hapus</a>                                        
                    <?php                                                                       
                                                }
                                            }
                                            else {
                                                # code...
                    ?>
                                                <a class='btn btn-success' onclick='branch(<?=$list[$i]->id_menu;?>)'><i class='fa  fa-code-fork'></i>&nbsp;&nbsp; Cabang</a>                                        
                    <?php                                                               
                                            }
                                        ?>
                                    </td>
                                    <td>
                                    <?php
                                        if ($list[$i]->flag == 0) {
                                            # code...
                                            echo "Tidak Aktif";
                                        } elseif($list[$i]->flag == 1) {
                                            # code...
                                            echo "Menu Utama";
                                        }
                                        elseif ($list[$i]->flag == 'C') {
                                            # code...
                                            echo "Konfigurasi";
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
	<div class="modal modal-success fade" id="newData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="box-content">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h4 class="modal-title">Menu</h4>
                    </div>
	                <div class="modal-body" style="background-color: #fff!important;">
						<form id="addForm" name="addForm">
							<label style="color: #000;font-weight: 400;font-size: 19px;">Menu</label>
							<div class="form-group">
								<div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-circle-o"></i></span>
                                    <input type="text" id="data_menu" name="data_menu" class="form-control" placeholder="Nama Menu" maxlength="100">
								</div>
							</div>

							<label style="color: #000;font-weight: 400;font-size: 19px;">URL</label>
							<div class="form-group">
								<div class="input-group">
                                    <span class="input-group-addon"><?=base_url();?></span>
                                    <input type="text" id="data_url" name="data_url" class="form-control" placeholder="URL" maxlength="100">
								</div>
							</div>                            

							<label style="color: #000;font-weight: 400;font-size: 19px;">Icon (Font-awesome)</label>
							<div class="form-group">
								<div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fonticons"></i></span>
                                    <input type="text" id="data_icon" name="data_icon" class="form-control" placeholder="Icon" maxlength="100">
								</div>
							</div>

							<label style="color: #000;font-weight: 400;font-size: 19px;">Parameter Menu</label>
							<div class="form-group">
								<div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-cogs"></i></span>
                                    <select class="form-control" id="data_parameter" name="data_parameter">
                                        <option>-- Pilih Salah Satu --</option>
                                        <?php
                                            if($flag != array())
                                            {
                                                for ($i=0; $i < count($flag); $i++) { 
                                                    # code...
                                        ?>
                                                    <option value="<?=$flag[$i]['flag'];?>"><?=$flag[$i]['remark'];?></option>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </select>
								</div>
							</div> 

							<label style="color: #000;font-weight: 400;font-size: 19px;">Prioritas</label>
							<div class="form-group">
								<div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fonticons"></i></span>
                                    <input type="text" id="data_Prioritas" name="data_Prioritas" class="form-control" maxlength="100">
								</div>
							</div>                                                                                                               
                            

						</form>
	                </div>
	                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
	                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
						<input type="submit" class="btn btn-primary" value="Simpan" id="add_data_form"/>

	                </div>
	            </div>
	        </div>
		</div>
	</div>
</div>

<div class="example-modal">
	<div class="modal modal-success fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="box-content">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h4 class="modal-title">Menu</h4>
                    </div>
	                <div class="modal-body" style="background-color: #fff!important;">
						<form id="editForm" name="editForm">
							<label style="color: #000;font-weight: 400;font-size: 19px;">Menu</label>
							<div class="form-group">
								<div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-circle-o"></i></span>
                                    <input type="text" id="ndata_menu" name="ndata_menu" class="form-control" placeholder="Nama Menu" maxlength="100">
                                    <input type="hidden" id="noid" name="noid" class="form-control">
								</div>
							</div>

							<label style="color: #000;font-weight: 400;font-size: 19px;">URL</label>
							<div class="form-group">
								<div class="input-group">
                                    <span class="input-group-addon"><?=base_url();?></span>
                                    <input type="text" id="ndata_url" name="ndata_url" class="form-control" placeholder="URL" maxlength="100">
								</div>
							</div>                            

							<label style="color: #000;font-weight: 400;font-size: 19px;">Icon (Font-awesome)</label>
							<div class="form-group">
								<div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fonticons"></i></span>
                                    <input type="text" id="ndata_icon" name="ndata_icon" class="form-control" placeholder="Icon" maxlength="100">
								</div>
							</div>

							<label style="color: #000;font-weight: 400;font-size: 19px;">Parameter Menu</label>
							<div class="form-group">
								<div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-cogs"></i></span>
                                    <select class="form-control" id="ndata_parameter" name="ndata_parameter">
                                        <option>-- Pilih Salah Satu --</option>
                                        <?php
                                            if($flag != array())
                                            {
                                                for ($i=0; $i < count($flag); $i++) { 
                                                    # code...
                                        ?>
                                                    <option value="<?=$flag[$i]['flag'];?>"><?=$flag[$i]['remark'];?></option>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </select>
								</div>
							</div>                                                                                    

							<label style="color: #000;font-weight: 400;font-size: 19px;">Prioritas</label>
							<div class="form-group">
								<div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fonticons"></i></span>
                                    <input type="text" id="ndata_Prioritas" name="ndata_Prioritas" class="form-control" maxlength="100" value="">
								</div>
							</div>                            

						</form>
	                </div>
	                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
	                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
						<input type="submit" class="btn btn-primary" value="Simpan" id="edit_data_form"/>

	                </div>
	            </div>
	        </div>
		</div>
	</div>
</div>

<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/	dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	$("#addData").click(function(){
		$("#newData").modal('show');
	})

    $("#add_data_form").click(function(){
        var data_menu      = $("#data_menu").val();
        var data_url       = $("#data_url").val();
        var data_icon      = $("#data_icon").val();
        var data_parameter = $("#data_parameter").val();
        var data_Prioritas = $("#data_Prioritas").val();        

        data_sender = {
                        'nama_menu': data_menu,
                        'url_pages': data_url,
                        'icon'     : data_icon,
                        'flag'     : data_parameter,
                        'prioritas': data_Prioritas
        }

        if (data_menu.length <= 0) {
            if (data_menu.length <= 0) {
                Lobibox.notify('warning', {
                    msg: 'Nama menu wajib diisi'
                });                
            } 
        }
        else
        {
            $.ajax({
                url :"<?php echo site_url();?>config/add_menu/"+"<?=$this->uri->segment(3);?>",
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
    })

    $("#edit_data_form").click(function(){
        var data_menu      = $("#ndata_menu").val();
        var data_url       = $("#ndata_url").val();
        var data_icon      = $("#ndata_icon").val();
        var data_parameter = $("#ndata_parameter").val();
        var oid            = $("#noid").val();
        var data_Prioritas = $("#ndata_Prioritas").val()

        data_sender = {
                        'nama_menu': data_menu,
                        'url_pages': data_url,
                        'icon'     : data_icon,
                        'flag'     : data_parameter,
                        'prioritas': data_Prioritas
        }

        if (data_menu.length <= 0) {
            if (data_menu.length <= 0) {
                Lobibox.notify('warning', {
                    msg: 'Nama menu wajib diisi'
                });                
            } 
        }
        else
        {
            $.ajax({
                url :"<?php echo site_url();?>config/edit_menu/"+oid,
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
    })    
})

function active(arg,param) {
    $.ajax({
        url :"<?php echo site_url();?>config/get_active/"+arg+"/"+param,
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

function edit(id)
{
	$("#loadprosess").modal('show');
	$.getJSON('<?php echo site_url() ?>config/get_menu/'+id,
		function( response ) {
            console.log(response[0]);
			$("#editData").modal('show');
			$("#ndata_menu").val(response[0].nama_menu);
			$("#ndata_url").val(response[0].url_pages);            
			$("#ndata_icon").val(response[0].icon);            
			$("#ndata_parameter").val(response[0].flag);            
			$("#ndata_Prioritas").val(response[0].prioritas);                        
			$("#noid").val(response[0].id_menu);                        
			setTimeout(function(){
				$("#loadprosess").modal('hide');
			}, 1000);
		}
	);
}

function branch(params) {
    window.location.href = "<?=base_url();?>"+"config/submenu/"+params;    
}

function del(id){
    LobiboxBase = {
        //DO NOT change this value. Lobibox depended on it
        bodyClass       : 'lobibox-open',
        //DO NOT change this object. Lobibox is depended on it
        modalClasses : {
            'error'     : 'lobibox-error',
            'success'   : 'lobibox-success',
            'info'      : 'lobibox-info',
            'warning'   : 'lobibox-warning',
            'confirm'   : 'lobibox-confirm',
            'progress'  : 'lobibox-progress',
            'prompt'    : 'lobibox-prompt',
            'default'   : 'lobibox-default',
            'window'    : 'lobibox-window'
        },
        buttons: {
            ok: {
                'class': 'lobibox-btn lobibox-btn-default',
                text: 'OK',
                closeOnClick: true
            },
            cancel: {
                'class': 'lobibox-btn lobibox-btn-cancel',
                text: 'Cancel',
                closeOnClick: true
            },
            yes: {
                'class': 'lobibox-btn lobibox-btn-yes',
                text: 'Ya',
                closeOnClick: true
            },
            no: {
                'class': 'lobibox-btn lobibox-btn-no',
                text: 'Tidak',
                closeOnClick: true
            }
        }
    }

    Lobibox.confirm({
        title: "Konfirmasi",
        msg: "Anda yakin akan menghapus data ini ?",
        callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>config/delete_menu/"+id,
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
