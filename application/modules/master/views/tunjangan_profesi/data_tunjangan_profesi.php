<div class="col-xs-12" id="viewdata">
	<div class="box">
        <div class="box-header">
			<h3 class  ="box-title pull-right"><button class="btn btn-block btn-primary" id="addData"><i class="fa fa-plus-square"></i> Tambah Tunjangan Profesi</button></h3>
			<div class ="box-tools">
			</div>
        </div>
        <div class="box-body" id="isi">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
            <tr>
              <th>No</th>
			  <th>NIP</th>
			  <th>Nama</th>
			  <th>Dari Tanggal</th>
			  <th>Sampai Tanggal</th>
			  <th>Tunjangan Profesi</th>
			  <th>Action</th>
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
								<td><?=$list[$i]->nip;?></td>
								<td><?=$list[$i]->nama_pegawai;?></td>
								<td><?=$list[$i]->tgl_mulai;?></td>
								<td><?=$list[$i]->tgl_selesai;?></td>
								<td><?=number_format($list[$i]->tunjangan);?></td>
								<td>
									<?php
										if ($list[$i]->tgl_selesai == '9999-01-01') {
											# code...
									?>
											<button class="btn btn-primary btn-xs" onclick="edit('<?=$list[$i]->id;?>')">
												<i class="fa fa-edit"></i>
											</button>&nbsp;&nbsp;
											<button class="btn btn-danger btn-xs" onclick="del('<?=$list[$i]->id;?>')">
												<i class="fa fa-trash"></i>
											</button>									
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

<!-- <div class="example-modal">
	<div class="modal modal-success fade" id="newData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="box-content">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h4 class="modal-title">Form Tunjangan Profesi</h4>
	                  </div>
	                <div class="modal-body" style="background-color: #fff!important;">
						<form id="addForm" name="addForm">
							<label style="color: #000;font-weight: 400;font-size: 19px;">NIP</label>
							<div class="form-group">
								<div class="input-group">
			                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
				                    <input type="text" id="nip" name="nip" class="form-control" placeholder="NIP">
								</div>
							</div>

							<label style="color: #000;font-weight: 400;font-size: 19px;">Dari Tanggal</label>
							<div class="form-group">
								<div class="input-group">
			                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
			                    <input type="text" id="tgl_mulai" name="tgl_mulai" class="form-control timerange" placeholder="Dari Tanggal">
								</div>
							</div>							

							<label style="color: #000;font-weight: 400;font-size: 19px;">Tunjangan</label>
							<div class="form-group">
								<div class="input-group">
			                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
			                    	<input type="number" id="tunjangan" name="tunjangan" class="form-control">
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
</div> -->

<!-- <div class="example-modal">
<div class="modal modal-success fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="box-content">
		
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Tunjangan Profesi</h4>
                  </div>
                <div class="modal-body" style="background-color: #fff!important;">
					<form id="editForm" name="addForm">
						<label style="color: #000;font-weight: 400;font-size: 19px;">NIP</label>
						<div class="form-group">
							<div class="input-group">
		                    <span class="input-group-addon"><i class="fa fa-star"></i></span>		                    
			                    <input type="text" id="nnip" name="nnip" class="form-control" placeholder="NIP" disabled>
			                    <input type="hidden" id="oid" name="oid" class="form-control">
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Dari Tanggal</label>
						<div class="form-group">
							<div class="input-group">
		                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
		                    <input type="text" id="ntgl_mulai" name="ntgl_mulai" class="form-control timerange" placeholder="Dari Tanggal">
							</div>
						</div>							

						<label style="color: #000;font-weight: 400;font-size: 19px;">Sampai Tanggal</label>
						<div class="form-group">
							<div class="input-group">
		                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
		                    <input type="text" id="ntgl_selesai" name="ntgl_selesai" class="form-control timerange" placeholder="Sampai Tanggal">
							</div>
						</div>														


						<label style="color: #000;font-weight: 400;font-size: 19px;">Tunjangan</label>
						<div class="form-group">
							<div class="input-group">
		                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
		                    	<input type="number" id="ntunjangan" name="ntunjangan" class="form-control">
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
						<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-star"></i></span>
							<input type="text" id="nip" name="nip" class="form-control" placeholder="NIP">
						</div>
					</div>

					<label style="color: #000;font-weight: 400;font-size: 19px;">Dari Tanggal</label>
					<div class="form-group">
						<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-star"></i></span>
						<input type="text" id="tgl_mulai" name="tgl_mulai" class="form-control timerange" placeholder="Dari Tanggal">
						</div>
					</div>							

					<label style="color: #000;font-weight: 400;font-size: 19px;">Tunjangan</label>
					<div class="form-group">
						<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-star"></i></span>
							<input type="number" id="tunjangan" name="tunjangan" class="form-control">
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
</div>

<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/	dataTables.bootstrap.min.js"></script>
<script>
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

    $('.autonumber').autoNumeric('init');    	

    $('.timerange').datepicker({
    	format: 'yyyy-mm-dd'
    });	
});

$(document).ready(function(){
	// $("#addData").click(function(){
	// 	$("#newData").modal('show');
	// })

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
		var nip        	= $("#nip").val();
		var tgl_mulai	= $("#tgl_mulai").val();
		var tgl_selesai = $("#tgl_selesai").val();
		var tunjangan	= $("#tunjangan").val();				
		if (nip.length <= 0) 
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data NIP tidak boleh kosong."
			});
		}
		else if (tgl_mulai.length <= 0) 
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Tanggal Mulai tidak boleh kosong."
			});
		}
		else if (tunjangan.length <= 0) 
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data tunjangan tidak boleh kosong."
			});
		}
		else
		{
			var data_sender = {
							'oid' 			: oid,
							'crud'			: crud,
        					'nip' 			: nip,
			                'tgl_mulai' 	: tgl_mulai,
			                'tgl_selesai' 	: tgl_selesai,
			                'tunjangan' 	: tunjangan								
			}

			$.ajax({
				url : "<?php echo site_url()?>master/tunjangan_profesi/store",
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

	$("#add").click(function(){
		var nip         = $("#nip").val();
		var tgl_mulai   = $("#tgl_mulai").val();
		var tgl_selesai = $("#tgl_selesai").val();
		var tunjangan  = $("#tunjangan").val();				
		if (nip.length <= 0) 
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data NIP tidak boleh kosong."
			});
		}
		else if (tgl_mulai.length <= 0) 
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Tanggal Mulai tidak boleh kosong."
			});
		}
		else if (tunjangan.length <= 0) 
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data tunjangan tidak boleh kosong."
			});
		}		
		else
		{

			var data_sender = {
        					'nip' 			: nip,
			                'tgl_mulai' 	: tgl_mulai,
			                'tgl_selesai' 	: tgl_selesai,
			                'tunjangan' 	: tunjangan							
			}

			$.ajax({
				url :"<?php echo site_url()?>/master/tunjangan_profesi/add_tunjangan_profesi",
				type:"post",
				data:{ data_sender : data_sender},
				beforeSend:function(){
					$("#newData").modal('hide');
					$("#loadprosess").modal('show');				
				},
				success:function(msg)
				{
					if (msg == 1) 
					{
						Lobibox.notify('success', {
							msg: 'Data Berhasil Ditambahkan. Mohon tunggu, sedang memuat data.'
						});
						$("#isi").load('master/tunjangan_profesi/ajax_tunjangan_profesi');
						setTimeout(function(){ 
							$("#loadprosess").modal('hide');								
						}, 5000);
					}
					else
					{
						var json = jQuery.parseJSON(msg);
						Lobibox.alert("error", //AVAILABLE TYPES: "error", "info", "success", "warning"
						{
							msg: json.text
						});
						Lobibox.notify('error', {
							msg: 'Gagal Melakukan Penambahan data'
						});						
						setTimeout(function(){ 
							$("#loadprosess").modal('hide');								
						}, 5000);						
					}
				},
				error:function(){
					Lobibox.notify('error', {
						msg: 'Gagal Melakukan Penambahan data'
					});
				}
			})
		}
	})

	$("#edit").click(function(){
		var nip         = $("#nnip").val();
		var tgl_mulai   = $("#ntgl_mulai").val();
		var tgl_selesai = $("#ntgl_selesai").val();
		var tunjangan   = $("#ntunjangan").val();	
		var oid 		= $("#oid").val();

		if (nip.length <= 0) 
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data NIP tidak boleh kosong."
			});
		}
		else if (tgl_mulai.length <= 0) 
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Tanggal Mulai tidak boleh kosong."
			});
		}
		else if (tunjangan.length <= 0) 
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data tunjangan tidak boleh kosong."
			});
		}		
		else
		{

			var data_sender = {
							'oid'			: oid,
        					'nip' 			: nip,
			                'tgl_mulai' 	: tgl_mulai,
			                'tgl_selesai' 	: tgl_selesai,
			                'tunjangan' 	: tunjangan							
			}

			$.ajax({
				url :"<?php echo site_url();?>/master/tunjangan_profesi/edit_tunjangan_profesi_end",
				type:"post",
				data:{ data_sender : data_sender},
				beforeSend:function(){
					$("#editData").modal('hide');
					$("#loadprosess").modal('show');								
				},
				success:function(){
					Lobibox.notify('success', {
						msg: 'Data Berhasil Dirubah. Mohon tunggu, sedang memuat data.'
						});
					$("#isi").load('master/tunjangan_profesi/ajax_tunjangan_profesi');
					setTimeout(function(){ 
						$("#loadprosess").modal('hide');								
					}, 5000);
				},
				error:function(){
						Lobibox.notify('error', {
							msg: 'Gagal Melakukan Perubahan data'
						});
				}
			})
		}
	})
})      



function edit(id)
{
	// $("#loadprosess").modal('show');									
	// $.getJSON('<?php echo site_url() ?>/master/tunjangan_profesi/edit_tunjangan_profesi/'+id,
	// 	function( response ) {
	// 		$("#editData").modal('show');
	// 		$("#oid").val(response['id']);
	// 		$("#nnip").val(response['nip']);
	// 		var start = response['tgl_mulai'];
	// 		var end = response['tgl_selesai'];
	// 		var c_start = start.split('-').reverse().join('-');
	// 		var c_end = end.split('-').reverse().join('-');
	// 		$("#ntgl_mulai").val(c_start);
	// 		$("#ntgl_selesai").val(c_end);
	// 		$("#ntunjangan").val(response['tunjangan']);									
	// 		setTimeout(function(){ 
	// 			$("#loadprosess").modal('hide');								
	// 		}, 1000);			
	// 	}
	// );

	$.ajax({
		url :"<?php echo site_url();?>master/tunjangan_profesi/get_data_tunjangan_profesi/"+id,
		type:"post",
		beforeSend:function(){
			$("#loadprosess").modal('show');
		},
		success:function(msg){
			var obj = jQuery.parseJSON (msg);
			console.log();
			$(".form-control-detail").val('');
			$("#formdata").css({"display": ""});
			$("#viewdata").css({"display": "none"});
			$("#formdata-title").html("Ubah Data");
			$("#crud").val('update');
			$("#oid").val(obj[0].id);
			$("#nip").val(obj[0].nip);
			var start = obj[0].tgl_mulai;
			var c_start = start.split('-').reverse().join('-');
			$("#tgl_mulai").val(c_start);
			$("#tunjangan").val(obj[0].tunjangan);
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
					url : "<?php echo site_url()?>master/tunjangan_profesi/store/delete/"+id,
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