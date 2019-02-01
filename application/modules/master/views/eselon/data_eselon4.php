<div class="col-xs-12" id="viewdata">
  	<div class="box">
        <div class="box-header">
			<h3 class  ="box-title pull-right"><button class="btn btn-block btn-primary" id="addData"><i class="fa fa-plus-square"></i> Tambah Eselon 4</button></h3>
			<div class ="box-tools"></div>
        </div><!-- /.box-header -->
        <div class="box-body" id="isi">
            <table class="table table-bordered table-striped table-view">
              	<thead>
                    <tr>
						<th>No</th>
						<th>Nama Eselon 1</th>
						<th>Nama Eselon 2</th>
						<th>Nama Eselon 3</th>
						<th>Nama Eselon 4</th>
						<th>Action</th>
                    </tr>
				</thead>
				<tbody>
				<?php
						for ($i=0; $i < count($list_final); $i++) { 
						# code...
				?>
						<tr>
							<td><?=$i+1;?></td>
							<td><?=$list_final[$i]['nama_eselon1'];?></td>
							<td><?=$list_final[$i]['nama_eselon2'];?></td>						
							<td><?=$list_final[$i]['nama_eselon3'];?></td>
							<td><?=$list_final[$i]['nama_eselon4'];?></td>																			
							<td>
								<button class="btn btn-primary btn-xs" onclick="edit('<?php echo $list_final[$i]['id_es4'];?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
						<?php
								if($list_final[$i]['counter_data'] == 0)
								{
						?>
								<button class="btn btn-danger btn-xs" onclick="del('<?php echo $list_final[$i]['id_es4'];?>')"><i class="fa fa-trash"></i></button>											
						<?php
								}
						?>
							</td>
						</tr>
				<?php
					}
				?>
				</tbody>
		  	</table>
        </div><!-- /.box-body -->
  	</div><!-- /.box -->
</div>


<!-- Modal Dialog Sebelumnya -->
<!-- <div class="example-modal">
<div class="modal modal-success fade" id="newData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="box-content">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Eselon 4</h4>
                  </div>
                <div class="modal-body" style="background-color: #fff!important;">
					<form id="addForm" name="addForm">

						<label style="color: #000;font-weight: 400;font-size: 19px;">Eselon I</label>
						<div class="form-group">
							<div class="input-group">
			                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
			                    <select name="es1" id="es1" class="form-control"><option value="">Pilih Eselon 1</option>
								<?php foreach($es1->result() as $row){?>
									<option value="<?php echo $row->id_es1;?>"><?php echo $row->nama_eselon1;?></option>
								<?php }?>
								</select>
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Eselon II</label>
						<div id="isies2">
							<div class="form-group">
								<div class="input-group">
				                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
				                    <select class="form-control"><option value="">Pilih Eselon 2</option></select>
								</div>
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Eselon III</label>
						<div id="isies3">
							<div class="form-group">
								<div class="input-group">
				                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
				                    <select class="form-control"><option value="">Pilih Eselon 3</option></select>
								</div>
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Eselon IV</label>
						<div class="form-group">
							<div class="input-group">
	                    		<span class="input-group-addon"><i class="fa fa-star"></i></span>
	                    		<input type="text" id="es4" name="es4" class="form-control" placeholder="Nama Eselon 4" maxlength="100">
							</div>
						</div>
					</form>
                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
					<input type="submit" class="btn btn-primary" value="Simpan" id="add"/>

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
                    <h4 class="modal-title">Form Eselon 4</h4>
              	</div>
            	<div class="modal-body" style="background-color: #fff!important;">
					<form id="editForm" name="addForm">

						<label style="color: #000;font-weight: 400;font-size: 19px;">Eselon I</label>
						<div class="form-group">
							<div class="input-group">
			                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
			                    <select name="nes1" id="nes1" class="form-control">
								<?php foreach($es1->result() as $row){?>
									<option value="<?php echo $row->id_es1;?>"><?php echo $row->nama_eselon1;?></option>
								<?php }?>
								</select>
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Eselon II</label>
						<div id="nisies2">
							<div class="form-group">
								<div class="input-group">
				                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
				                    <select name="nes2" id="nes2" class="form-control">
									<?php foreach($es2->result() as $row){?>
										<option value="<?php echo $row->id_es2;?>"><?php echo $row->nama_eselon2;?></option>
									<?php }?>
									</select>
								</div>
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Eselon III</label>
						<div id="nisies3">
							<div class="form-group">
								<div class="input-group">
				                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
				                    <select name="nes3" id="nes3" class="form-control">
									<?php foreach($es3->result() as $row){?>
										<option value="<?php echo $row->id_es3;?>"><?php echo $row->nama_eselon3;?></option>
									<?php }?>
									</select>
								</div>
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Eselon IV</label>
						<div class="form-group"><div class="input-group">
		                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
		                    <input type="text" id="nes4" name="nes4" class="form-control" placeholder="Nama Eselon 4" maxlength="100">
							<input type="hidden" id="oid" name="oid" >
							</div>
						</div>

					</form>
                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
					<input type="submit" class="btn btn-primary" value="Simpan" id="edit"/>

                </div>
            </div>
        </div>
	</div>
</div>
</div> -->

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
						<label>Eselon 1</label>
			            <select id="f_es1" class="form-control">
							<?php foreach($es1->result() as $row){?>
							<option value="<?php echo $row->id_es1;?>"><?php echo $row->nama_eselon1;?></option>
						<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Eselon 2</label>
			            <select id="f_es2" class="form-control">
							<?php foreach($es2->result() as $row){?>
							<option value="<?php echo $row->id_es2;?>"><?php echo $row->nama_eselon2;?></option>
						<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Eselon 3</label>
			            <select id="f_es3" class="form-control">
							<?php foreach($es3->result() as $row){?>
							<option value="<?php echo $row->id_es3;?>"><?php echo $row->nama_eselon3;?></option>
						<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Eselon 4</label>
						<input type="text" class="form-control" id="f_es4" placeholder="Eselon 4">
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
<script type ='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type ='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
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
		var f_es1       = $("#f_es1").val();
		var f_es2       = $("#f_es2").val();
		var f_es3       = $("#f_es3").val();
		var f_es4       = $("#f_es4").val();
		var data_sender = "";
		if (f_es1.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Eselon 1 tidak boleh kosong."
			});
		}
		else if (f_es2.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Eselon 2 tidak boleh kosong."
			});
		}
		else if (f_es3.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Eselon 3 tidak boleh kosong."
			});
		}
		else if (f_es4.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Eselon 4 tidak boleh kosong."
			});
		}
		else
		{
			data_sender = {
				'oid' : oid,
				'crud': crud,
				'es1' : f_es1,
				'es2' : f_es2,
				'es3' : f_es3,
				'es4' : f_es4
			}

			$.ajax({
				url : "<?php echo site_url()?>master/data_eselon4/store",
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
		}
	})


	// Script Lama
	// $("#es1").change(function(){
	// 	var es1 = $("#es1").val();
	// 	$.ajax({
	// 		url :"<?php echo site_url()?>/master/data_eselon2/cariEs2",
	// 		type:"post",
	// 		data:"es1="+es1,
	// 		beforeSend:function(){
	// 			$("#loadprosess").modal('show');
	// 		},
	// 		success:function(msg){
	// 			$("#isies2").html(msg);
	// 			setTimeout(function(){
	// 				$("#loadprosess").modal('hide');
	// 			}, 5000);
	// 		}
	// 	})
	// })

	// $("#nes1").change(function(){
	// 	var nes1 = $("#nes1").val();
	// 	$.ajax({
	// 		url :"<?php echo site_url()?>/master/data_eselon2/cariEs2edit",
	// 		type:"post",
	// 		data:"nes1="+nes1,
	// 		beforeSend:function(){
	// 			$("#loadprosess").modal('show');
	// 		},
	// 		success:function(msg){
	// 			$("#nisies2").html(msg);
	// 			setTimeout(function(){
	// 				$("#loadprosess").modal('hide');
	// 			}, 5000);
	// 		}
	// 	})
	// })


	// $("#add").click(function(){
	// 	var es1= $("#es1").val();
	// 	var es2= $("#es2").val();
	// 	var es3= $("#es3").val();
	// 	var es4= $("#es4").val();

	// 	if (es1.length <= 0)
	// 	{
	// 		Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
	// 		{
	// 			msg: "Data Eselon 1 tidak boleh kosong."
	// 		});
	// 	}
	// 	else if (es2.length <= 0)
	// 	{
	// 		Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
	// 		{
	// 			msg: "Data Eselon 2 tidak boleh kosong."
	// 		});
	// 	}
	// 	else if (es3.length <= 0)
	// 	{
	// 		Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
	// 		{
	// 			msg: "Data Eselon 3 tidak boleh kosong."
	// 		});
	// 	}
	// 	else if (es4.length <= 0)
	// 	{
	// 		Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
	// 		{
	// 			msg: "Data Eselon 4 tidak boleh kosong."
	// 		});
	// 	}
	// 	else
	// 	{
	// 		$.ajax({
	// 			url :"<?php echo site_url()?>/master/data_eselon4/addEselon4",
	// 			type:"post",
	// 			data:"es1="+es1+"&es2="+es2+"&es3="+es3+"&es4="+es4,
	// 			beforeSend:function(){
	// 				$("#newData").modal('hide');
	// 				$("#loadprosess").modal('show');
	// 			},
	// 			success:function(msg){
	// 				var obj = jQuery.parseJSON (msg);
	// 				ajax_status(obj);
	// 			},
	// 			error:function(jqXHR,exception)
	// 			{
	// 				ajax_catch(jqXHR,exception);					
	// 			}
	// 		})
	// 	}
	// })

	// $("#edit").click(function(){
	// 	var es1= $("#nes1").val();
	// 	var es2= $("#nes2").val();
	// 	var es3= $("#nes3").val();
	// 	var es4= $("#nes4").val();

	// 	if (es1.length <= 0)
	// 	{
	// 		Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
	// 		{
	// 			msg: "Data Eselon 1 tidak boleh kosong."
	// 		});
	// 	}
	// 	else if (es2.length <= 0)
	// 	{
	// 		Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
	// 		{
	// 			msg: "Data Eselon 2 tidak boleh kosong."
	// 		});
	// 	}
	// 	else if (es3.length <= 0)
	// 	{
	// 		Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
	// 		{
	// 			msg: "Data Eselon 3 tidak boleh kosong."
	// 		});
	// 	}
	// 	else if (es4.length <= 0)
	// 	{
	// 		Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
	// 		{
	// 			msg: "Data Eselon 4 tidak boleh kosong."
	// 		});
	// 	}
	// 	else
	// 	{
	// 		$.ajax({
	// 			url :"<?php echo site_url();?>/master/data_eselon4/peditEselon4",
	// 			type:"post",
	// 			data:$("#editForm").serialize(),
	// 			beforeSend:function(){
	// 				$("#editData").modal('hide');
	// 				$("#loadprosess").modal('show');
	// 			},
	// 			success:function(msg){
	// 				var obj = jQuery.parseJSON (msg);
	// 				ajax_status(obj);
	// 			},
	// 			error:function(jqXHR,exception)
	// 			{
	// 				ajax_catch(jqXHR,exception);					
	// 			}
	// 		})
	// 	}
	// })
})

function edit(id){
	// Script Edit Data Lama
	// $.getJSON('<?php echo site_url() ?>/master/data_eselon4/editEselon4/'+id,
	// 	function( response ) {
	// 		$("#editData").modal('show');
	// 		$("#nes1").val(response['id_es1']);
	// 		$("#nes2").val(response['id_es2']);
	// 		$("#nes3").val(response['id_es3']);
	// 		$("#nes4").val(response['nama_eselon4']);
	// 		$("#oid").val(response['id_es4']);
	// 		setTimeout(function(){
	// 			$("#loadprosess").modal('hide');
	// 		}, 1000);
	// 	}
	// );

	$.ajax({
		url :"<?php echo site_url();?>master/data_eselon4/get_data_eselon/"+id,
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
			$("#oid").val(obj.id_es4);
			$("#f_es1").val(obj.id_es1);
			$("#f_es2").val(obj.id_es2);
			$("#f_es3").val(obj.id_es3);
			$("#f_es4").val(obj.nama_eselon4);				
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
					url : "<?php echo site_url()?>master/data_eselon4/store/delete/"+id,
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
