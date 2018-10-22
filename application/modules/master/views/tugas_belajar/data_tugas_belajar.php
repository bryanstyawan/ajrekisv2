<div class="col-xs-12">
	<div class="box">
        <div class="box-header">
			<h3 class  ="box-title pull-right"><button class="btn btn-block btn-primary" id="addData"><i class="fa fa-plus-square"></i> Tambah Tugas Belajar</button></h3>
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
			  <th>Keterangan</th>
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
								<td><?=$list[$i]->keterangan;?></td>
								<td>
									<button class="btn btn-primary btn-xs" onclick="edit('<?=$list[$i]->id;?>')">
										<i class="fa fa-edit"></i>
									</button>&nbsp;&nbsp;
									<button class="btn btn-danger btn-xs" onclick="del('<?=$list[$i]->id;?>')">
										<i class="fa fa-trash"></i>
									</button>									
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
	                    <h4 class="modal-title">Form Tugas Belajar</h4>
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

							<label style="color: #000;font-weight: 400;font-size: 19px;">Sampai Tanggal</label>
							<div class="form-group">
								<div class="input-group">
			                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
			                    <input type="text" id="tgl_selesai" name="tgl_selesai" class="form-control timerange" placeholder="Sampai Tanggal">
								</div>
							</div>														


							<label style="color: #000;font-weight: 400;font-size: 19px;">Keterangan</label>
							<div class="form-group">
								<div class="input-group">
			                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
			                    	<textarea id="keterangan" name="keterangan" class="form-control"></textarea>
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
                    <h4 class="modal-title">Form Tugas Belajar</h4>
                  </div>
                <div class="modal-body" style="background-color: #fff!important;">
					<form id="editForm" name="addForm">
						<label style="color: #000;font-weight: 400;font-size: 19px;">NIP</label>
						<div class="form-group">
							<div class="input-group">
		                    <span class="input-group-addon"><i class="fa fa-star"></i></span>		                    
			                    <input type="text" id="nnip" name="nnip" class="form-control" placeholder="NIP">
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


						<label style="color: #000;font-weight: 400;font-size: 19px;">Keterangan</label>
						<div class="form-group">
							<div class="input-group">
		                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
		                    	<textarea id="nketerangan" name="nketerangan" class="form-control"></textarea>
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

    $('.timerange').datepicker({
    	format: 'yyyy-mm-dd'
    });	
});

$(document).ready(function(){
	$("#addData").click(function(){
		$("#newData").modal('show');
	})

	$("#add").click(function(){
		var nip         = $("#nip").val();
		var tgl_mulai   = $("#tgl_mulai").val();
		var tgl_selesai = $("#tgl_selesai").val();
		var keterangan  = $("#keterangan").val();				
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
		else if (tgl_selesai.length <= 0) 
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Tanggal Selesai tidak boleh kosong."
			});
		}		
		else if (keterangan.length <= 0) 
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Keterangan tidak boleh kosong."
			});
		}		
		else
		{

			var data_sender = {
        					'nip' 			: nip,
			                'tgl_mulai' 	: tgl_mulai,
			                'tgl_selesai' 	: tgl_selesai,
			                'keterangan' 	: keterangan							
			}

			$.ajax({
				url :"<?php echo site_url()?>/master/add_tugas_belajar",
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
						$("#isi").load('master/ajax_tugas_belajar');
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
		var keterangan  = $("#nketerangan").val();	
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
		else if (tgl_selesai.length <= 0) 
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Tanggal Selesai tidak boleh kosong."
			});
		}		
		else if (keterangan.length <= 0) 
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Keterangan tidak boleh kosong."
			});
		}		
		else
		{

			var data_sender = {
							'oid'			: oid,
        					'nip' 			: nip,
			                'tgl_mulai' 	: tgl_mulai,
			                'tgl_selesai' 	: tgl_selesai,
			                'keterangan' 	: keterangan							
			}

			$.ajax({
				url :"<?php echo site_url();?>/master/edit_tugas_belajar_end",
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
					$("#isi").load('master/ajax_tugas_belajar');
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
	$("#loadprosess").modal('show');									
	$.getJSON('<?php echo site_url() ?>/master/edit_tugas_belajar/'+id,
		function( response ) {
			$("#editData").modal('show');
			$("#oid").val(response['id']);
			$("#nnip").val(response['nip']);
			$("#ntgl_mulai").val(response['tgl_mulai']);
			$("#ntgl_selesai").val(response['tgl_selesai']);
			$("#nketerangan").val(response['keterangan']);									
			setTimeout(function(){ 
				$("#loadprosess").modal('hide');								
			}, 1000);			
		}
	);
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
					url :"<?php echo site_url()?>/master/del_tugas_belajar/"+id,
					type:"post",
					beforeSend:function(){
						$("#loadprosess").modal('show');				
					},					
					success:function(){
						Lobibox.notify('success', {
							msg: 'Data Berhasil Dihapus. Mohon tunggu, sedang memuat data.'
						});
						$("#isi").load('master/ajax_tugas_belajar');
						setTimeout(function(){ 
							$("#loadprosess").modal('hide');								
						}, 3000);			
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