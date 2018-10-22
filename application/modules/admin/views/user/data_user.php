            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><button class="btn btn-block btn-primary" id="addData"><i class="fa fa-user-plus"></i> Tambah Data</button></h3>
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
				<!-- Switch -->
	<style type="text/css">@import url("<?php echo base_url() . 'addon/switch/bootstrap-switch.css'; ?>");</style>
                  <table class="table table-hover">
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>email</th>
                      <th>Nomor Hp</th>
                      <th>Role</th>
					  <th>Status</th>
					  <th>Action</th>
                    </tr>
					<?php $x=1;
						foreach($user->result() as $row){?>
							<tr>
								<td><?php echo $x;?></td>
								<td><?php echo $row->nama;?></td>
								<td><?php echo $row->email;?></td>
								<td><?php echo $row->no_hp;?></td>
								<td><?php echo $row->nama_role;?></td>
								<td><?php if ($row->status ==0){echo "<div class='make-switch' data-on='primary' data-off='info'>
                                <input type='checkbox' checked='checked' onClick='off(".$row->id_user.")' /></div>";}
									else {echo "<div class='make-switch' data-on='primary' data-off='info'>
                                <input type='checkbox' onClick='on(".$row->id_user.")' /></div>";}?></td>
								<td><button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id_user;?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;<button class="btn btn-primary btn-xs" onclick="del('<?php echo $row->id_user;?>')"><i class="fa fa-trash"></i></button></td>
							</tr>
						<?php $x++; }
					?>
				  </table>
				<!-- Switch -->
	<script type='text/javascript' src="<?php echo base_url(); ?>addon/switch/bootstrap-switch.min.js"></script>	
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>

<script>
$(document).ready(function(){
	$("#addData").click(function(){
		$("#newData").modal('show');
	})
	$("#add").click(function(){
		var nama = $("#nama").val();
		var email = $("#email").val();
		var hp = $("#hp").val();
		var role = $("#role").val();
		$.ajax({
			url :"<?php echo site_url()?>/admin/addUser",
			type:"post",
			data:"nama="+nama+"&email="+email+"&hp="+hp+"&role="+role,
			beforeSend:function(){
				$("#newData").modal('hide');
			},
			success:function(){
				Lobibox.notify('success', {
					msg: 'Data Berhasil Ditambahkan'
					});
				$("#isi").load('admin/ajaxUser');
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
			url :"<?php echo site_url();?>/admin/peditUser",
			type:"post",
			data:$("#editForm").serialize(),
			beforeSend:function(){
				$("#editData").modal('hide');
			},
			success:function(){
				Lobibox.notify('success', {
					msg: 'Data Berhasil Dirubah'
					});
				$("#isi").load('admin/ajaxUser');
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
	$.getJSON('<?php echo site_url() ?>/admin/editUser/'+id,
		function( response ) {
			$("#editData").modal('show');
			$("#nnama").val(response['nama']);
			$("#nemail").val(response['email']);
			$("#nhp").val(response['no_hp']);
			$("#nrole").val(response['id_role']);
			$("#oid").val(response['id_user']);
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
					url :"<?php echo site_url()?>/admin/delUser/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						$("#isi").load('admin/ajaxUser');
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
function on(id){
	alert("on "+id);
}
function off(id){
	alert("off "+id);
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
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama User">
					</div></div>
					
					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-at"></i></span>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email (digunakan untuk login)">
					</div></div>
					
					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input type="text" id="hp" name="hp" class="form-control" placeholder="Kontak">
					</div></div>
					
					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-gavel"></i></span>
                    <select name="role" id="role" class="form-control"><option value="">Pilih Role</option>
					<?php foreach($role->result() as $row){?>
						<option value="<?php echo $row->id_role;?>"><?php echo $row->nama_role;?></option>
					<?php }?>
					</select>
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
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" id="nnama" name="nnama" class="form-control">
					<input type="hidden" id="oid" name="oid" class="form-control">
					</div></div>
					
					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-at"></i></span>
                    <input type="email" id="nemail" name="nemail" class="form-control" >
					</div></div>
					
					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input type="text" id="nhp" name="nhp" class="form-control" >
					</div></div>
					
					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-gavel"></i></span>
                    <select name="nrole" id="nrole" class="form-control">
					<?php foreach($role->result() as $row){?>
						<option value="<?php echo $row->id_role;?>"><?php echo $row->nama_role;?></option>
					<?php }?>
					</select>
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