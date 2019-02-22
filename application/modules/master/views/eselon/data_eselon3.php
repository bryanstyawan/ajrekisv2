<div class="col-xs-12" id="viewdata">
  	<div class="box">
        <div class="box-header">
			<h3 class  ="box-title pull-right"><button class="btn btn-block btn-primary" id="addData"><i class="fa fa-plus-square"></i> Tambah Eselon 3</button></h3>
			<div class ="box-tools"></div>
        </div>
	    <div class="box-body" id="isi">
	        <table class="table table-bordered table-striped table-view">
				<thead>
	                <tr>
						<th>No</th>
						<th>Nama Eselon 1</th>
						<th>Nama Eselon 2</th>
						<th>Nama Eselon 3</th>
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
							<td>
								<button class="btn btn-primary btn-xs" onclick="edit('<?php echo $list_final[$i]['id_es3'];?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
						<?php
								if($list_final[$i]['counter_data'] == 0)
								{
						?>
								<button class="btn btn-danger btn-xs" onclick="del('<?php echo $list_final[$i]['id_es3'];?>')"><i class="fa fa-trash"></i></button>											
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
						<label>Eselon 1</label>
			            <select id="f_es1" class="form-control">
							<option selected>------Pilih Salah Satu------</option>						
							<?php foreach($es1->result() as $row){?>
							<option value="<?php echo $row->id_es1;?>"><?php echo $row->nama_eselon1;?></option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Eselon 2</label>
			            <select id="f_es2" class="form-control">
						</select>
					</div>
					<div class="form-group">
						<label>Eselon 3</label>
						<input type="text" class="form-control" id="f_es3" placeholder="Eselon 3">
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
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
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

	$("#f_es1").change(function(){
		$("#f_es2").html("<option value=''>------Pilih Salah Satu------</option>");
		$("#f_es3").html("<option value=''>------Pilih Salah Satu------</option>");
		$("#f_es4").html("<option value=''>------Pilih Salah Satu------</option>");
		var es1 = $(this).val();
		$.ajax({
			url :"<?php echo site_url();?>master/data_eselon2/formEselon2",
			type:"post",
			data:"nes1="+es1,
			beforeSend:function(){
				$("#loadprosess").modal('show');
			},
			success:function(hasil){
				$("#f_es2").html(hasil);
				setTimeout(function(){
					$("#loadprosess").modal('hide');
				}, 500);
			}
		})
	})	

	$("#btn-trigger-controll").click(function(){
		var oid         = $("#oid").val();
		var crud        = $("#crud").val();
		var f_es1       = $("#f_es1").val();
		var f_es2       = $("#f_es2").val();
		var f_es3       = $("#f_es3").val();
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
		else
		{
			data_sender = {
				'oid' : oid,
				'crud': crud,
				'es1' : f_es1,
				'es2' : f_es2,
				'es3' : f_es3
			}

			$.ajax({
				url : "<?php echo site_url()?>master/data_eselon3/store",
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
	$.ajax({
		url :"<?php echo site_url();?>master/data_eselon3/get_data_eselon/"+id,
		type:"post",
		beforeSend:function(){
			$("#loadprosess").modal('show');
		},
		success:function(msg){
			var obj = jQuery.parseJSON (msg);
			console.log(obj);
			$(".form-control-detail").val('');
			$("#formdata").css({"display": ""})
			$("#viewdata").css({"display": "none"})
			$("#formdata > div > div > div.box-header > h3").html("Ubah Data");		
			$("#crud").val('update');
			$("#oid").val(obj.list[0].id_es3);
			$("#f_es1").val(obj.list[0].id_es1);
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
				$('#f_es2').append(toAppend1);					
			}			
			// $("#f_es2").val(obj.list[0].id_es2);
			$("#f_es3").val(obj.list[0].nama_eselon3);				
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
					url : "<?php echo site_url()?>master/data_eselon3/store/delete/"+id,
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
