<div class="col-xs-12" id="viewdata">
	<div class="box">
        <div class="box-header">
			<h3 class  ="box-title pull-right"><button class="btn btn-block btn-primary" id="addData"><i class="fa fa-plus-square"></i> Tambah Slider</button></h3>
			<div class ="box-tools">
			</div>
        </div>
        <div class="box-body" id="isi">
            <table class="table table-bordered table-striped table-view">
				<thead>
					<tr>
					<th>No</th>
					<th>Judul</th>
					<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
                    if ($list != array()) {
                        # code...
                        for ($i=0; $i < count($list); $i++) { 
                            # code...
                ?>
                            <tr>
                                <td></td>
                                <td><?=$list[$i]['title'];?></td>
                                <td></td>
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

<div class="col-lg-12" id="formdata" style="display:none;">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title" id="formdata-title"></h3>
			<div class="box-tools pull-right"><button class="btn btn-block btn-danger" id="closeData"><i class="fa fa-close"></i></button></div>				
		</div>
		<div class="box-body">
			<div class="row">
				<input class="form-control" type="hidden" id="oid">
				<input class="form-control" type="hidden" id="crud">					
				<div class="col-md-6">
					<div class="form-group">
						<label>Judul</label>
						<input type="text" class="form-control" id="f_judul" placeholder="judul">
					</div>
				</div>

                <div class="form-group col-md-6">
                    <div class="col-lg-12">
                        <label class="pull-left" style="color: #000;font-weight: 400;font-size: 19px;">File Pendukung</label>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                        <input type="file" id="file_pendukung" name="file_pendukung" class="form-control">
                    </div>
                </div>                
			</div>

		</div><!-- /.box-body -->
		<div class="box-footer">
			<a class="btn btn-success pull-right" id="btn-trigger-controll"><i class="fa fa-save"></i>&nbsp; Simpan</a>
		</div>
	</div><!-- /.box -->
</div>


<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/	dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	$("#addData").click(function()
	{
		$(".form-control").val('');
		$("#formdata").css({"display": ""})
		$("#viewdata").css({"display": "none"})
		$("#formdata-title").html("Tambah Data");		
		$("#crud").val('insert');
	})

	$("#closeData").click(function(){
		$("#formdata").css({"display": "none"})
		$("#viewdata").css({"display": ""})		
	})	

	$("#btn-trigger-controll").click(function(){
		var oid         = $("#oid").val();
		var crud        = $("#crud").val();
		var f_judul       = $("#f_judul").val();
        file_pendukung     = $('#file_pendukung').prop('files')[0];		
		var data_sender = "";
		data_sender = {
			'oid' : oid,
			'crud': crud,
			'title' : f_judul
		}

		$.ajax({
			url : "<?php echo site_url()?>config/store_slider",
			type: "post",
			data: {data_sender:data_sender},
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
	})
})

function edit(id)
{
	$.ajax({
		url :"<?php echo site_url();?>master/data_eselon1/get_data_eselon/"+id,
		type:"post",
		beforeSend:function(){
			$("#loadprosess").modal('show');
		},
		success:function(msg){
			var obj = jQuery.parseJSON (msg);
			console.log();
			$(".form-control-detail").val('');
			$("#formdata").css({"display": ""})
			$("#viewdata").css({"display": "none"})
			$("#formdata > div > div > div.box-header > h3").html("Ubah Data");		
			$("#crud").val('update');
			$("#oid").val(obj.id_es1);
			$("#f_es1").val(obj.nama_eselon1);				
			$("#loadprosess").modal('hide');				
		},
		error:function(jqXHR,exception)
		{
			ajax_catch(jqXHR,exception);					
		}
	})
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
					url : "<?php echo site_url()?>master/data_eselon1/store/delete/"+id,
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
