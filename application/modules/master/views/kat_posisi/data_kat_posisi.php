            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title pull-right"><button class="btn btn-block btn-primary" id="addData"><i class="fa fa-plus-square"></i> Tambah Kategori Posisi</button></h3>
                  <div class="box-tools">
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body" id="isi">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                    <tr>
                      <th>No</th>
                      <th>Kategori Posisi</th>
					  <th>action</th>
                    </tr>
					</thead>
					<tbody>
					<?php $x=1;
						foreach($list->result() as $row){?>
							<tr>
								<td><?php echo $x;?></td>
								<td><?php echo $row->nama_kat_posisi;?></td>
								<td><button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id;?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
								<button class="btn btn-primary btn-xs" onclick="del('<?php echo $row->id;?>')"><i class="fa fa-trash"></i></button>&nbsp;&nbsp;
								<button class="btn btn-primary btn-xs" onclick="generate('<?php echo $row->id;?>')"><i class="fa fa-ellipsis-h"></i></button></td>
							</tr>
						<?php $x++; }
					?>
					</tbody>
				  </table>
					
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
<!-- DataTables -->
	<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	$("#addData").click(function(){
		$("#newData").modal('show');
	})
	$("#add").click(function(){
		var kat= $("#kat_posisi").val();
		if (kat.length <= 0) 
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Katerogi Posisi tidak boleh kosong."
			});
		}
		else
	    {
			$.ajax({
				url :"<?php echo site_url()?>/master/data_kat_posisi/addKat_posisi",
				type:"post",
				data:"kat="+kat,
				beforeSend:function(){
					$("#newData").modal('hide');
				},
				success:function(){
					Lobibox.notify('success', {
						msg: 'Data Berhasil Ditambahkan'
						});
					$("#isi").load('data_kat_posisi/ajaxKat_posisi');
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
	    var kat= $("#nkat_posisi").val();
		if (kat.length <= 0) 
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Katerogi Posisi tidak boleh kosong."
			});
		}
		else
	    {
			$.ajax({
				url :"<?php echo site_url();?>/master/data_kat_posisi/peditKat_posisi",
				type:"post",
				data:$("#editForm").serialize(),
				beforeSend:function(){
					$("#editData").modal('hide');
				},
				success:function(){
					Lobibox.notify('success', {
						msg: 'Data Berhasil Dirubah'
						});
					$("#isi").load('data_kat_posisi/ajaxKat_posisi');
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
	$.getJSON('<?php echo site_url() ?>/master/data_kat_posisi/editKat_posisi/'+id,
		function( response ) {
			$("#editData").modal('show');
			$("#nkat_posisi").val(response['nama_kat_posisi']);
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
					url :"<?php echo site_url()?>/master/data_kat_posisi/delKat_posisi/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						$("#isi").load('data_kat_posisi/ajaxKat_posisi');
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
function generate(id){
	$.ajax({
					url :"<?php echo site_url()?>/master/data_kat_posisi/generate/"+id,
					type:"post",
					success:function(){
					Lobibox.alert('success', {
					msg: 'Berhasil Generate Grade'
					});
					},
					error:function(){
					Lobibox.alert('error', {
					msg: 'Gagal Melakukan Generate Menu'
					});
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
					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-star-o"></i></span>
                    <input type="text" id="kat_posisi" name="kat_posisi" class="form-control" placeholder="Kategori Posisi">
					</div></div>
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
					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-star-o"></i></span>
                    <input type="text" id="nkat_posisi" name="nkat_posisi" class="form-control">
					<input type="hidden" id="oid" name="oid" class="form-control">
					</div></div>
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
