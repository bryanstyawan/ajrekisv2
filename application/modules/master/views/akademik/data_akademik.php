<div class="col-xs-12" id="viewdata">
  	<div class="box">
        <div class="box-header">
			<h3 class  ="box-title pull-right"><button class="btn btn-block btn-primary" id="addData"><i class="fa fa-plus-square"></i> Tambah Akademik</button></h3>
			<div class ="box-tools"></div>
        </div><!-- /.box-header -->
        <div class="box-body" id="isi">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Inisial</th>
                        <th>Nama</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $x=1;
                    foreach($list->result() as $row){?>
                        <tr>
                            <td><?php echo $x;?></td>
                            <td><?php echo $row->kode;?></td>
                            <td><?php echo $row->nama_pendidikan;?></td>
                            <td>
                                <button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id_pendidikan;?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
                                <button class="btn btn-danger btn-xs" onclick="del('<?php echo $row->id_pendidikan;?>')"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php $x++; }
                ?>
                </tbody>
            </table>
        </div><!-- /.box-body -->
  	</div><!-- /.box -->
</div>


<div class="example-modal">
<div class="modal modal-success fade" id="newData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="box-content">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Master Akademik</h4>
                </div>
                <div class="modal-body" style="background-color: #fff!important;">
					<form id="addForm" name="addForm">

						<label style="color: #000;font-weight: 400;font-size: 19px;">Inisial</label>
						<div class="form-group">
							<div class="input-group">
	                    		<span class="input-group-addon"><i class="fa fa-circle-o"></i></span>
	                    		<input type="text" id="data_inisial" name="data_inisial" class="form-control">
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Nama</label>
						<div class="form-group">
							<div class="input-group">
	                    		<span class="input-group-addon"><i class="fa fa-circle-o"></i></span>
	                    		<input type="text" id="data_nama" name="data_nama" class="form-control">
							</div>
						</div>

					</form>
                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
					<input type="submit" class="btn btn-primary" value="Simpan" id="btn_add_data"/>
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
                    <h4 class="modal-title">Form Master Akademik</h4>
                </div>
                <div class="modal-body" style="background-color: #fff!important;">
					<form id="editForm" name="editForm">

						<label style="color: #000;font-weight: 400;font-size: 19px;">Inisial</label>
						<div class="form-group">
							<div class="input-group">
	                    		<span class="input-group-addon"><i class="fa fa-circle-o"></i></span>
	                    		<input type="text" id="ndata_inisial" name="ndata_inisial" class="form-control">
	                    		<input type="hidden" id="noid" name="ndata_inisial" class="form-control">                                
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Nama</label>
						<div class="form-group">
							<div class="input-group">
	                    		<span class="input-group-addon"><i class="fa fa-circle-o"></i></span>
	                    		<input type="text" id="ndata_nama" name="ndata_nama" class="form-control">
							</div>
						</div>

					</form>
                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
					<input type="submit" class="btn btn-primary" value="Simpan" id="btn_edit_data"/>
                </div>
            </div>
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
				<div class="col-md-6">
					<div class="form-group">
						<label style="color: #000;font-weight: 400;font-size: 19px;">Inisial</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-circle-o"></i></span>
							<input type="text" id="inisial" name="inisial" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label style="color: #000;font-weight: 400;font-size: 19px;">Nama</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-circle-o"></i></span>
							<input type="text" id="nama" name="nama" class="form-control">
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
		var inisial      = $("#inisial").val();
		var nama         = $('#nama').val();
		var data_sender  = "";
		if (inisial.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data inisial tidak boleh kosong"
			});
		}
		else if (nama.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data nama tidak boleh kosong."
			});
		}
		else
		{
			data_sender = {
				'oid'         : oid,
				'crud'        : crud,
				'inisial'     : inisial,
				'nama' 		  : nama
			}

			$.ajax({
				url : "<?php echo site_url()?>master/data_akademik/store",
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
	// $("#loadprosess").modal('show');
	// $.getJSON('<?php echo site_url() ?>master/data_akademik/editAkademik/'+id,
	// 	function( response ) {
    //         console.log(response[0].kode);
	// 		$("#editData").modal('show');
	// 		$("#ndata_inisial").val(response[0].kode);
	// 		$("#ndata_nama").val(response[0].nama_pendidikan);
	// 		$("#noid").val(response[0].id_pendidikan);
	// 		setTimeout(function(){
	// 			$("#loadprosess").modal('hide');
	// 		}, 1000);
	// 	}
	// );
	$.ajax({
		url :"<?php echo site_url();?>master/data_akademik/get_data_akademik/"+id,
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
			$("#oid").val(obj.id_pendidikan);
			$("#inisial").val(obj.kode);
			$("#nama").val(obj.nama_pendidikan);
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
					url : "<?php echo site_url()?>master/data_akademik/store/delete/"+id,
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
