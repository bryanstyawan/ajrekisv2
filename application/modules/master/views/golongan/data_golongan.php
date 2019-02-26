<div class="col-xs-12" id="viewdata">
	<div class="box">
        <div class="box-header">
			<h3 class="box-title pull-right">
				<button class="btn btn-block btn-primary" id="addData"><i class="fa fa-plus-square"></i> Tambah Golongan</button>
			</h3>
			<div class="box-tools">
			</div>
        </div><!-- /.box-header -->
        <div class="box-body" id="isi">
            <table id="example1" class="table table-bordered table-striped">
				<thead>
            <tr>
				<th>No</th>
				<th>Golongan</th>
				<th>Ruang</th>
				<th>Nama Pangkat</th>
				<th>action</th>
            </tr>
			</thead>
			<tbody>
			<?php $x=1;
				foreach($list->result() as $row){?>
					<tr>
						<td><?php echo $x;?></td>
						<td><?php echo $row->golongan;?></td>
						<td><?php echo $row->ruang;?></td>
						<td><?php echo $row->nama_pangkat;?></td>
						<td>
							<button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id;?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
							<button class="btn btn-primary btn-xs" onclick="del('<?php echo $row->id;?>')"><i class="fa fa-trash"></i></button></td>
					</tr>
				<?php $x++; }
			?>
			</tbody>
		</table>
			
        </div><!-- /.box-body -->
	</div><!-- /.box -->
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
						<label style="color: #000;font-weight: 400;font-size: 19px;">Golongan</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
							<input type="text" id="golongan" name="golongan" class="form-control" placeholder="Golongan">
						</div>
					</div>
					<div class="form-group">
						<label style="color: #000;font-weight: 400;font-size: 19px;">Ruang</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
							<input type="text" id="ruang" name="ruang" class="form-control" placeholder="Ruang">
						</div>
					</div>
					<div class="form-group">
						<label style="color: #000;font-weight: 400;font-size: 19px;">Nama Pangkat</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
							<input type="text" id="nama_pangkat" name="nama_pangkat" class="form-control" placeholder="Nama Pangkat">
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


<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	//By Eric
	//Last Edit : 26-02-2019
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
		var oid          = $("#oid").val();
		var crud         = $("#crud").val();
		var golongan     = $("#golongan").val();
		var ruang        = $('#ruang').val();
		var nama_pangkat = $('#nama_pangkat').val();
		var data_sender  = "";
		if (golongan.length <= 0) 
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Golongan tidak boleh kosong."
			});
		}
		else if (ruang.length <= 0) 
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Ruang tidak boleh kosong."
			});
		}
		else if (nama_pangkat.length <= 0) 
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Nama Pangkat tidak boleh kosong."
			});
		}
		else
		{
			data_sender = {
				'oid'          : oid,
				'crud'         : crud,
				'golongan'     : golongan,
				'ruang'	   	   : ruang,
				'nama_pangkat' : nama_pangkat
			}

			$.ajax({
				url : "<?php echo site_url()?>master/data_golongan/store",
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
function edit(id){
	// $.getJSON('<?php echo site_url() ?>/master/data_golongan/edit_golongan/'+id,
	// 	function( response ) {
	// 		$("#editData").modal('show');
	// 		$("#edit_golongan").val(response['golongan']);
	// 		$("#edit_ruang").val(response['ruang']);			
	// 		$("#edit_nama_pangkat").val(response['nama_pangkat']);						
	// 		$("#oid").val(response['id']);
	// 	}
	// );
	
	//By Eric
	//Last Edited : 26-02-2019
	$.ajax({
		url :"<?php echo site_url();?>master/data_golongan/get_data_golongan/"+id,
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
			$("#oid").val(obj.id);
			$("#golongan").val(obj.golongan);
			$("#ruang").val(obj.ruang);
			$("#nama_pangkat").val(obj.nama_pangkat);
			$("#loadprosess").modal('hide');				
		},
		error:function(jqXHR,exception)
		{
			ajax_catch(jqXHR,exception);					
		}
	})
}

//By Eric
//Last Edited : 26-02-2019
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
					url : "<?php echo site_url()?>master/data_golongan/store/delete/"+id,
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

$(function () {
	$("#example1").DataTable({
		"oLanguage": {
			"sSearch": "Pencarian :",
			"sSearchPlaceholder" : "Ketik untuk mencari",
			"sLengthMenu": "Menampilkan data&nbsp; _MENU_ &nbsp;Data",
			"sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
			"sZeroRecords": "Data tidak ditemukan"	
		},
		"dom": "<'row'<'col-sm-6'f><'col-sm-6'l>>" +
				"<'row'<'col-sm-5'i><'col-sm-7'p>>" +			
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-5'i><'col-sm-7'p>>" 

		// "dom": '<"top"f>rt'
		// "dom": '<"top"fl>rt<"bottom"ip><"clear">'			
	});
});
</script>