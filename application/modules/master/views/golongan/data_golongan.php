<div class="col-xs-12">
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

<div class="example-modal">
<div class="modal modal-success fade" id="newData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="box-content">
		
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data</h4>
                  </div>
                <div class="modal-body" style="background-color: #fff!important;">
					<form id="addForm" name="addForm">
						<div class="form-group">
							<div class="input-group">
                    			<span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
                    			<input type="text" id="golongan" name="golongan" class="form-control" placeholder="Golongan">
							</div>
							<div class="input-group">
                    			<span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
                    			<input type="text" id="ruang" name="ruang" class="form-control" placeholder="Ruang">
							</div>
							<div class="input-group">
                    			<span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
                    			<input type="text" id="add_nama_pangkat" name="add_nama_pangkat" class="form-control" placeholder="Nama Pangkat">
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
                    <h4 class="modal-title">Edit Data</h4>
                  </div>
                <div class="modal-body" style="background-color: #fff!important;">
					<form id="editForm" name="addForm">
						<div class="input-group">
                			<span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
                			<input type="text" id="edit_golongan" name="edit_golongan" class="form-control" placeholder="Golongan">
						</div>
						<div class="input-group">
                			<span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
                			<input type="text" id="edit_ruang" name="edit_ruang" class="form-control" placeholder="Ruang">
						</div>
						<div class="input-group">
                			<span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
                			<input type="text" id="edit_nama_pangkat" name="edit_nama_pangkat" class="form-control" placeholder="Nama Pangkat">
							<input type="hidden" id="oid" name="oid" class="form-control">                			
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
	<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	$("#addData").click(function(){
		$("#newData").modal('show');
		$("#agama").focus();
	})
	$("#add").click(function(){
		var golongan     = $("#golongan").val();
		var ruang        = $('#ruang').val();
		var nama_pangkat = $('#add_nama_pangkat').val();
		
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
							'golongan' 		: golongan,
							'ruang'	   		: ruang,
							'nama_pangkat'	: nama_pangkat
						  };
	//		alert(data_sender);
			$.ajax({
				url :"<?php echo site_url()?>/master/data_golongan/addGolongan",
				type:"post",
		        data: { data_sender:data_sender},
				beforeSend:function(){
					$("#newData").modal('hide');
				},
				success:function(){
					Lobibox.notify('success', {
						msg: 'Data Berhasil Ditambahkan'
					});
	              	setTimeout(function(){
	                	location.reload();
	              	}, 1500);
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
	    var golongan     = $("#edit_golongan").val();
		var ruang        = $('#edit_ruang').val();
		var nama_pangkat = $('#edit_nama_pangkat').val();
		
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
    		$.ajax({
    			url :"<?php echo site_url();?>/master/data_golongan/peditgolongan",
    			type:"post",
    			data:$("#editForm").serialize(),
    			beforeSend:function(){
    				$("#editData").modal('hide');
    			},
    			success:function(){
    				Lobibox.notify('success', {
						msg: 'Data Berhasil Dirubah'
					});
	              	setTimeout(function(){
	                	location.reload();
	              	}, 1500);
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
function edit(id){
	$.getJSON('<?php echo site_url() ?>/master/data_golongan/edit_golongan/'+id,
		function( response ) {
			$("#editData").modal('show');
			$("#edit_golongan").val(response['golongan']);
			$("#edit_ruang").val(response['ruang']);			
			$("#edit_nama_pangkat").val(response['nama_pangkat']);						
			$("#oid").val(response['id']);
		}
	);
}
function del(id){
	 Lobibox.confirm({
		 title: "Konfirmasi",
		 msg: "Anda yakin akan menghapus data ini ?",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>/master/data_golongan/delgolongan/"+id,
					type:"post",
					success:function(){
						Lobibox.notify('success', {
							msg: 'Data Berhasil Dihapus'
						});
    	              	setTimeout(function(){
    	                	location.reload();
    	              	}, 1500);
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