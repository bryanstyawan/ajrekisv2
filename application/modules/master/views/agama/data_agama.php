            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><button class="btn btn-block btn-primary" id="addData"><i class="fa fa-plus-square"></i> Tambah Data</button></h3>
                  <div class="box-tools">
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body" id="isi">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                    <tr>
                      <th>No</th>
                      <th>Agama</th>
					  <th>action</th>
                    </tr>
					</thead>
					<tbody>
					<?php $x=1;
						foreach($list->result() as $row){?>
							<tr>
								<td><?php echo $x;?></td>
								<td><?php echo $row->nama_agama;?></td>
								<td><button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id;?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
								<button class="btn btn-primary btn-xs" onclick="del('<?php echo $row->id;?>')"><i class="fa fa-trash"></i></button>
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
		$("#agama").focus();
	})
	$("#add").click(function(){
		var agama= $("#agama").val();
		$.ajax({
			url :"<?php echo site_url()?>/master/addAgama",
			type:"post",
			data:"agama="+agama,
			beforeSend:function(){
				$("#newData").modal('hide');
			},
			success:function(){
				Lobibox.notify('success', {
					msg: 'Data Berhasil Ditambahkan'
					});
				$("#isi").load('master/ajaxAgama');
			},
			error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penambahan data'
					});
					}
		})
	})
	$("#edit").click(function(){
		$.ajax({
			url :"<?php echo site_url();?>/master/peditAgama",
			type:"post",
			data:$("#editForm").serialize(),
			beforeSend:function(){
				$("#editData").modal('hide');
			},
			success:function(){
				Lobibox.notify('success', {
					msg: 'Data Berhasil Dirubah'
					});
				$("#isi").load('master/ajaxAgama');
			},
			error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Perubahan data'
					});
					}
		})
	})
})
function edit(id){
	$.getJSON('<?php echo site_url() ?>/master/editAgama/'+id,
		function( response ) {
			$("#editData").modal('show');
			$("#nagama").val(response['nama_agama']);
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
					url :"<?php echo site_url()?>/master/delAgama/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						$("#isi").load('master/ajaxAgama');
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
        $("#example1").DataTable();
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
                <div class="modal-body">
					<form id="addForm" name="addForm">
					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
                    <input type="text" id="agama" name="agama" class="form-control" placeholder="Agama">
					</div></div>
					</form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
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
                <div class="modal-body">
					<form id="editForm" name="addForm">
					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
                    <input type="text" id="nagama" name="nagama" class="form-control">
					<input type="hidden" id="oid" name="oid" class="form-control">
					</div></div>
					</form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
					<input type="submit" class="btn btn-primary" value="Simpan" id="edit"/>
                    
                </div>
            </div>
        </div>
	</div>
</div>
</div>
