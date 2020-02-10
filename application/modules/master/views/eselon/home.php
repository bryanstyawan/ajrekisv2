<div class="col-xs-12" id="viewdata">
	<div class="col-xs-3">
		<div class="box box-solid" style="">
			<div class="box-body no-padding" style="display: block;">
				<ul class="nav nav-pills nav-stacked contact-id">
					<?php
					for ($i=1; $i <= 4; $i++) { 
						# code...
					?>
						<li style="cursor: pointer;" class="teamwork" id="li_kandidat_0" onclick="show_data('<?=$i;?>')">
							<a class="contact-name">
								<i class="fa fa-circle-o text-red contact-name-list"></i>                            
								Eselon <?=$i;?>
							</a>
						</li>
					<?php
					}
					?>
				</ul>
			</div>
		</div>
	</div>	
	<div class="col-xs-9" id="viewdata_9" style="display:none;">
		<div class="box">
			<div class="box-header">
				<h2 id="subtitle-module" class="box-title pull-left"></h3>
				<h3 class="box-title pull-right"><button class="btn btn-block btn-primary" id="addData"><i class="fa fa-plus-square"></i> Tambah Data</button></h3>
				<div class="box-tools">
				</div>
			</div>
			<div class="box-body" id="table-show">
			</div>
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
				<input type="hidden" id="arg">				

				<div id="formdata1" class="formeselon" style="display:none;">
					<div class="col-md-6">
						<div class="form-group">
							<label>Eselon 1</label>
							<input type="text" class="form-control" id="f_formdata1_es1" placeholder="Eselon 1">
						</div>
					</div>				
				</div>

				<div id="formdata2" class="formeselon" style="display:none;">
					<div class="col-md-6">
						<div class="form-group">
							<label>Eselon 1</label>
							<select id="f_formdata2_es1" class="form-control">
								<?php foreach($es1->result() as $row){?>
								<option value="<?php echo $row->id_es1;?>"><?php echo $row->nama_eselon1;?></option>
							<?php }?>
							</select>
						</div>
						<div class="form-group">
							<label>Eselon 2</label>
							<input type="text" class="form-control" id="f_formdata2_es2" placeholder="Eselon 2">
						</div>
					</div>				
				</div>

				<div id="formdata3" class="formeselon" style="display:none;">
					<div class="col-md-6">
						<div class="form-group">
							<label>Eselon 1</label>
							<select id="f_formdata3_es1" class="form-control f_es1">
								<option selected>------Pilih Salah Satu------</option>						
								<?php foreach($es1->result() as $row){?>
								<option value="<?php echo $row->id_es1;?>"><?php echo $row->nama_eselon1;?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<label>Eselon 2</label>
							<select id="f_formdata3_es2" class="form-control f_es2"></select>
						</div>
						<div class="form-group">
							<label>Eselon 3</label>
							<input type="text" class="form-control" id="f_formdata3_es3" placeholder="Eselon 3">
						</div>
					</div>				
				</div>

				<div id="formdata4" class="formeselon" style="display:none;">
					<div class="col-md-6">
						<div class="form-group">
							<label>Eselon 1</label>
							<select id="f_formdata4_es1" class="form-control f_es1">
								<option selected>------Pilih Salah Satu------</option>
								<?php 
									foreach($es1->result() as $row)
									{
								?>
										<option value="<?php echo $row->id_es1;?>"><?php echo $row->nama_eselon1;?></option>
								<?php 
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Eselon 2</label>
							<select id="f_formdata4_es2" class="form-control f_es2">
								<option selected>------Pilih Salah Satu------</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">					
						<div class="form-group">
							<label>Eselon 3</label>
							<select id="f_formdata4_es3" class="form-control f_es3">
								<option selected>------Pilih Salah Satu------</option>
							</select>
						</div>
						<div class="form-group">
							<label>Eselon 4</label>
							<input type="text" class="form-control" id="f_formdata4_es4" placeholder="Eselon 4">
						</div>
					</div>				
				</div>

			</div>

		</div><!-- /.box-body -->
		<div class="box-footer">
			<a class="btn btn-success pull-right" id="btn-trigger-controll"><i class="fa fa-save"></i>&nbsp; Simpan</a>
		</div>
	</div><!-- /.box -->
</div>
<script>
$(document).ready(function(){
	$("#addData").click(function()
	{
		$(".form-control").val('');
		$("#formdata").css({"display": ""})
		$("#viewdata").css({"display": "none"})
		$("#formdata-title").html("Tambah Data");		
		$("#crud").val('insert');
		$(".formeselon").css({"display": "none"})		
		arg = $("#arg").val();
		switch (arg) {
			case '1':
				$("#formdata1").css({"display": ""})			
				break;
			case '2':
				$("#formdata2").css({"display": ""})			
				break;
			case '3':
				$("#formdata3").css({"display": ""})			
				break;
			case '4':
				$("#formdata4").css({"display": ""})			
				break;								
			default:
				break;
		}
	})

	$("#closeData").click(function(){
		$("#formdata").css({"display": "none"})
		$("#viewdata").css({"display": ""})		
	})	

	$(".f_es1").change(function(){
		$(".f_es2").html("<option value=''>------Pilih Salah Satu------</option>");
		$(".f_es3").html("<option value=''>------Pilih Salah Satu------</option>");
		$(".f_es4").html("<option value=''>------Pilih Salah Satu------</option>");
		var es1 = $(this).val();
		$.ajax({
			url :"<?php echo site_url();?>master/data_eselon2/formEselon2",
			type:"post",
			data:"nes1="+es1,
			beforeSend:function(){
				$("#loadprosess").modal('show');
			},
			success:function(hasil){
				$(".f_es2").html(hasil);
				setTimeout(function(){
					$("#loadprosess").modal('hide');
				}, 500);
			}
		})
	})

	$(".f_es2").change(function(){
		$(".f_es3").html("<option value=''>------Pilih Salah Satu------</option>");
		$(".f_es4").html("<option value=''>------Pilih Salah Satu------</option>");
		var es2 = $(this).val();
		$.ajax({
			url :"<?php echo site_url();?>master/data_eselon3/formEselon3",
			type:"post",
			data:"nes2="+es2,
			beforeSend:function(){
				$("#loadprosess").modal('show');
			},
			success:function(hasil){
				$(".f_es3").html(hasil);
				setTimeout(function(){
					$("#loadprosess").modal('hide');
				}, 500);
			}
		})
	})		

	$("#btn-trigger-controll").click(function(){
		var arg         = $("#arg").val();
		var oid         = $("#oid").val();
		var crud        = $("#crud").val();
		var flag 		= 0;
		var data_sender = "";

		if (arg == '1') {
			var f_es1       = $("#f_formdata1_es1").val();
			data_sender = {
				'oid' : oid,
				'crud': crud,
				'arg' : arg,
				'es1' : f_es1
			}			
			if (f_es1.length <= 0)
			{
				Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
				{
					msg: "Data Eselon 1 tidak boleh kosong."
				});
			}
			else
			{
				flag = 1;
			}			
		}
		else if(arg == '2')
		{
			var f_es1       = $("#f_formdata2_es1").val();
			var f_es2       = $("#f_formdata2_es2").val();
			data_sender = {
				'oid' : oid,
				'crud': crud,
				'arg' : arg,				
				'es1' : f_es1,
				'es2' : f_es2
			}			
			if (f_es1 == null)
			{
				Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
				{
					msg: "Data Eselon 1 tidak boleh kosong."
				});
			}
			else
			{
				if (f_es2.length <= 0)
				{
					Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
					{
						msg: "Data Eselon 2 tidak boleh kosong."
					});
				}
				else
				{
					flag = 1;
				}						
			}
		}
		else if(arg == '3')
		{
			var f_es1       = $("#f_formdata3_es1").val();
			var f_es2       = $("#f_formdata3_es2").val();
			var f_es3       = $("#f_formdata3_es3").val();						
			data_sender = {
				'oid' : oid,
				'crud': crud,
				'arg' : arg,				
				'es1' : f_es1,
				'es2' : f_es2,
				'es3' : f_es3
			}
			if (f_es1 == null)
			{
				Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
				{
					msg: "Data Eselon 1 tidak boleh kosong."
				});
			}
			else
			{

				if (f_es2.length <= 0)
				{
					Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
					{
						msg: "Data Eselon 2 tidak boleh kosong."
					});
				}		
				else
				{
					if (f_es3.length <= 0)
					{
						Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
						{
							msg: "Data Eselon 3 tidak boleh kosong."
						});
					}
					else
					{
						flag = 1;
					}					
				}			
			}						
		}
		else if(arg == '4')
		{
			var f_es1       = $("#f_formdata4_es1").val();
			var f_es2       = $("#f_formdata4_es2").val();
			var f_es3       = $("#f_formdata4_es3").val();
			var f_es4       = $("#f_formdata4_es4").val();									
			data_sender = {
				'oid' : oid,
				'crud': crud,
				'arg' : arg,				
				'es1' : f_es1,
				'es2' : f_es2,
				'es3' : f_es3,
				'es4' : f_es4
			}
			if (f_es1 == null)
			{
				Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
				{
					msg: "Data Eselon 1 tidak boleh kosong."
				});
			}
			else
			{

				if (f_es2.length <= 0)
				{
					Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
					{
						msg: "Data Eselon 2 tidak boleh kosong."
					});
				}		
				else
				{
					if (f_es3.length <= 0)
					{
						Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
						{
							msg: "Data Eselon 3 tidak boleh kosong."
						});
					}
					else
					{
						if (f_es4.length <= 0)
						{
							Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
							{
								msg: "Data Eselon 4 tidak boleh kosong."
							});
						}
						else
						{
							flag = 1;
						}
					}					
				}			
			}			
		}				

		if (flag == 1) {
			$.ajax({
				url : "<?php echo site_url()?>master/eselon/store",
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
})

function edit(id)
{
	var arg = $("#arg").val();	
	$.ajax({
		url :"<?php echo site_url();?>master/eselon/edit/"+id+"/"+arg,
		type:"post",
		beforeSend:function(){
			$("#loadprosess").modal('show');
		},
		success:function(msg){
			var obj = jQuery.parseJSON (msg);
			// console.log(obj.list.nama_eselon1);
			$(".form-control-detail").val('');
			$("#formdata").css({"display": ""})
			$("#viewdata").css({"display": "none"})
			$("#formdata > div > div > div.box-header > h3").html("Ubah Data");		
			$("#crud").val('update');
			$(".formeselon").css({"display": "none"})		
			switch (arg) {
				case '1':
					$("#oid").val(obj.list.id_es1);
					$("#f_formdata1_es1").val(obj.list.nama_eselon1);				
					$("#formdata1").css({"display": ""})			
					break;
				case '2':
					$("#oid").val(obj.list.id_es2);
					$("#f_formdata2_es1").val(obj.list.id_es1);				
					$("#f_formdata2_es2").val(obj.list.nama_eselon2);				
					$("#formdata2").css({"display": ""})			
					break;
				case '3':
					$("#oid").val(obj.list[0].id_es3);
					$("#f_formdata3_es1").val(obj.list[0].id_es1);
					if (obj.es2.length != 0) 
					{
						var toAppend1 = '<option value=""> - - - </option>';					
						for (index = 0; index < obj.es2.length; index++) 
						{
							_text = "";
							if (obj.es2[index].id_es2 == obj.list[0].id_es2) {
								_text = "selected";
							}

							toAppend1 += '<option value="'+obj.es2[index].id_es2+'" '+_text+'>'+obj.es2[index].nama_eselon2+'</option>';					
						}
						$('#f_formdata3_es2').append(toAppend1);					
					}			
					$("#f_formdata3_es3").val(obj.list[0].nama_eselon3);				
					$("#formdata3").css({"display": ""})			
					break;
				case '4':
					$("#oid").val(obj.list[0].id_es4);
					$("#f_formdata4_es1").val(obj.list[0].id_es1);
					if (obj.es2.length != 0) 
					{
						var toAppend1 = '<option value=""> - - - </option>';					
						for (index = 0; index < obj.es2.length; index++) 
						{
							_text = "";
							if (obj.es2[index].id_es2 == obj.list[0].id_es2) {
								_text = "selected";
							}

							toAppend1 += '<option value="'+obj.es2[index].id_es2+'" '+_text+'>'+obj.es2[index].nama_eselon2+'</option>';					
						}
						$('#f_formdata4_es2').append(toAppend1);					
					}			

					if (obj.es3.length != 0) 
					{
						var toAppend1 = '<option value=""> - - - </option>';					
						for (index = 0; index < obj.es3.length; index++) 
						{
							_text = "";
							if (obj.es3[index].id_es3 == obj.list[0].id_es3) {
								_text = "selected";
							}

							toAppend1 += '<option value="'+obj.es3[index].id_es3+'" '+_text+'>'+obj.es3[index].nama_eselon3+'</option>';					
						}
						$('#f_formdata4_es3').append(toAppend1);					
					}			
					$("#f_formdata4_es4").val(obj.list[0].nama_eselon4);				
					$("#formdata4").css({"display": ""})			
					break;								
				default:
					break;
			}				
			$("#loadprosess").modal('hide');				
		},
		error:function(jqXHR,exception)
		{
			ajax_catch(jqXHR,exception);					
		}
	})
}

function del(id,arg){
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
					url : "<?php echo site_url()?>master/eselon/store/delete/"+id+"/"+arg,
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

function show_data(id) {
	$.ajax({
		url : "<?php echo site_url()?>master/eselon/show/"+id,
		type: "post",
		beforeSend:function(){
			$("#loadprosess").modal('show');
			$('.table-view').dataTable().fnDestroy();
			$(".table-view tbody tr").remove();
			var newrec  = '<tr">' +
								'<td colspan="5" class="text-center">Memuat Data</td>'
						'</tr>';
			$('.table-view tbody').append(newrec);			
			$("#table-show").html('');
		},
		success:function(msg){
			$("#table-show").html(msg);			
			$("#arg").val(id);
			$("#subtitle-module").html('Data Eselon '+id)
			$("#viewdata_9").css({"display": ""})
			setTimeout(function(){
				$("#loadprosess").modal('hide');
			}, 500);
		},
		error:function(jqXHR,exception)
		{
			ajax_catch(jqXHR,exception);					
		}
	})	
}
</script>
