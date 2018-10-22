            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><button class="btn btn-block btn-primary" id="addData"><i class="fa fa-plus-square"></i> Tambah Data</button></h3>
                  <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding" id="isi">
                  <table class="table table-hover">
                    <tr>
                      <th>No</th>
                      <th>Role</th>
                      <th>Keterangan</th>
					  <th>action</th>
                    </tr>
					<?php $x=1;
						foreach($role->result() as $row){?>
							<tr>
								<td><?php echo $x;?></td>
								<td><?php echo $row->nama_role;?></td>
								<td><?php echo $row->keterangan;?></td>
								<td><button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id_role;?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
								<button class="btn btn-primary btn-xs" onclick="del('<?php echo $row->id_role;?>')"><i class="fa fa-trash"></i></button>&nbsp;&nbsp;
								<button class="btn btn-primary btn-xs" onclick="generate('<?php echo $row->id_role;?>')"><i class="fa fa-sitemap"></i> Generate</button></td>
							</tr>
						<?php $x++; }
					?>
				  </table>
					
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>

<script>
$(document).ready(function(){
	$("#addData").click(function(){
		$("#newData").modal('show');
	})
	$("#add").click(function(){
		var role= $("#role").val();
		var ket= $("#ket").val();
		$.ajax({
			url :"<?php echo site_url()?>/admin/addRole",
			type:"post",
			data:"role="+role+"&ket="+ket,
			beforeSend:function(){
				$("#newData").modal('hide');
			},
			success:function(){
				Lobibox.notify('success', {
					msg: 'Data Berhasil Ditambahkan'
					});
				$("#isi").load('admin/ajaxRole');
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
			url :"<?php echo site_url();?>/admin/peditRole",
			type:"post",
			data:$("#editForm").serialize(),
			beforeSend:function(){
				$("#editData").modal('hide');
			},
			success:function(){
				Lobibox.notify('success', {
					msg: 'Data Berhasil Dirubah'
					});
				$("#isi").load('admin/ajaxRole');
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
	$.getJSON('<?php echo site_url() ?>/admin/editRole/'+id,
		function( response ) {
			$("#editData").modal('show');
			$("#nrole").val(response['nama_role']);
			$("#nket").val(response['keterangan']);
			$("#oid").val(response['id_role']);
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
					url :"<?php echo site_url()?>/admin/delRole/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						$("#isi").load('admin/ajaxRole');
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
					url :"<?php echo site_url()?>/admin/generate/"+id,
					type:"post",
					success:function(){
					Lobibox.alert('success', {
					msg: 'Berhasil Generate Menu'
					});
					},
					error:function(){
					Lobibox.alert('error', {
					msg: 'Gagal Melakukan Generate Menu'
					});
					}
				})
}

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
                    <span class="input-group-addon"><i class="fa fa-suitcase"></i></span>
                    <input type="text" id="role" name="role" class="form-control" placeholder="Nama Role">
					</div></div>
					
					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                    <input type="text" id="ket" name="ket" class="form-control" placeholder="Keterangan">
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
                    <span class="input-group-addon"><i class="fa fa-suitcase"></i></span>
                    <input type="text" id="nrole" name="nrole" class="form-control">
					<input type="hidden" id="oid" name="oid" class="form-control">
					</div></div>
					
					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                    <input type="text" id="nket" name="nket" class="form-control">
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
