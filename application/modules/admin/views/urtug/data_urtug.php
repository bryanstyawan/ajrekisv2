<style>
					  .btn-file {
  position: relative;
  overflow: hidden;
}
.btn-file input[type=file] {
  position: absolute;
  top: 0;
  right: 0;
  min-width: 100%;
  min-height: 100%;
  font-size: 100px;
  text-align: right;
  filter: alpha(opacity=0);
  opacity: 0;
  background: red;
  cursor: inherit;
  display: block;
}
input[readonly] {
  background-color: white !important;
  cursor: text !important;
}
</style>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><button class="btn btn-block btn-primary" id="upload"><i class="fa fa-upload"></i> Upload</button></h3>
				  <h3 class="box-title"><button class="btn btn-block btn-primary" id="filter"><i class="fa fa-search"></i> Filter</button></h3>
                  <div class="box-tools">
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body" id="isi">
                    <table class="table table-bordered table-striped">
                      <thead>
                    <tr>
					  <th>Nomor</th>
                      <th>Posisi</th>
					  <th>Uraian Tugas</th>
					  <th>action</th>
                    </tr>
					</thead>
					<tbody>
					<?php 
					$x=$this->uri->segment(3)+1;
						foreach($list->result() as $row){?>
							<tr>
								<td><?php echo $x;?></td>
								<td><?php echo $row->nama_posisi;?></td>
								<td><?php echo $row->uraian_tugas;?></td>
								<td><button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id_urtug;?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
								<button class="btn btn-primary btn-xs" onclick="del('<?php echo $row->id_urtug;?>')"><i class="fa fa-trash"></i></button></td>
							</tr>
						<?php $x++; }
					 ?>
					</tbody>
				  </table>
				 
				  <?php echo $halaman;?>
				 
					
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>

<script>
$(document).ready(function(){
	$("#filter").click(function(){
		$("#Cari").modal('show');
		})
	$("#upload").click(function(){
		$("#mUpload").modal('show');
		})
	$("#es1").change(function(){
		var es1 = $("#es1").val();
		$.ajax({
			url :"<?php echo site_url()?>/master/cariEs2",
			type:"post",
			data:"es1="+es1,
			success:function(msg){
				$("#isies2").html(msg);
			}
		})
	})
	$("#es1up").change(function(){
		var es1 = $("#es1up").val();
		$.ajax({
			url :"<?php echo site_url()?>/admin/cariEs2",
			type:"post",
			data:"es1="+es1,
			success:function(msg){
				$("#isies2up").html(msg);
			}
		})
	})
	$("#jabatan").focus(function(){
		$.ajax({
			url :"<?php echo site_url()?>/master/cariJabatan",
			type:"post",
			data:$("#filterForm").serialize(),
			success:function(msg){
				$("#jabatan").html(msg);
			}
		})
	})
	$("#jabatanup").focus(function(){
		$.ajax({
			url :"<?php echo site_url()?>/admin/cariJabatan",
			type:"post",
			data:$("#upForm").serialize(),
			success:function(msg){
				$("#jabatanup").html(msg);
			}
		})
	})
	$("#pencarian").click(function(){
		var posisi = $("#jabatan").val();
		$.ajax({
			url :"<?php echo site_url()?>/admin/filterUrtug",
			type:"post",
			data:"posisi="+posisi,
			success:function(msg){
				$("#isi").html(msg);
			},
			beforeSend:function(){
				$("#Cari").modal('hide');
			}
		})
	})
	$("#edit").click(function(){
		$.ajax({
			url :"<?php echo site_url();?>/admin/peditUrtug",
			type:"post",
			data:$("#editForm").serialize(),
			beforeSend:function(){
				$("#editData").modal('hide');
			},
			success:function(pesan){
				location.reload();
				Lobibox.notify('success', {
					msg: 'Data Berhasil Dirubah'
					});
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
	$.getJSON('<?php echo site_url() ?>/admin/editUrtug/'+id,
		function( response ) {
			$("#editData").modal('show');
			$("#nurtug").val(response['uraian_tugas']);
			$("#oid").val(response['id_urtug']);
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
					url :"<?php echo site_url()?>/admin/delUrtug/"+id,
					type:"post",
					success:function(){
						location.reload();
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
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
$(document).on('change', '.btn-file :file', function() {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});

$(document).ready( function() {
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
        
    });
});
</script>
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
                    <span class="input-group-addon"><i class="fa fa-tasks"></i></span>
                    <input type="text" id="nurtug" name="nurtug" class="form-control">
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

<div class="example-modal">
<div class="modal modal-success fade" id="Cari" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="box-content">
		
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pencarian Data</h4>
                  </div>
                <div class="modal-body">
					<form id="filterForm" name="filterForm">
					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
                    <select name="es1" id="es1" class="form-control"><option value="">Pilih Eselon 1</option>
					<?php foreach($es1->result() as $row){?>
						<option value="<?php echo $row->id_es1;?>"><?php echo $row->nama_eselon1;?></option>
					<?php }?>
					</select>
					</div></div>
					<div id="isies2"></div>
					<div id="isies3"></div>
					<div id="isies4"></div>
					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-gavel"></i></span>
                    <select name="jabatan" id="jabatan" class="form-control"><option value=0>Pilih Jabatan</option></select>
					</div></div>
					</form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
					<input type="submit" class="btn btn-primary" value="Cari" id="pencarian"/>
                    
                </div>
            </div>
        </div>
	</div>
</div>
</div>

<div class="example-modal">
<div class="modal modal-success fade" id="mUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="box-content">
		
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload Data</h4>
                  </div>
                <div class="modal-body">
					<?php echo form_open_multipart('admin/upUrtug',array('id'=>'upForm','name'=>'upForm'));?>
					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
                    <select name="es1up" id="es1up" class="form-control"><option value="">Pilih Eselon 1</option>
					<?php foreach($es1->result() as $row){?>
						<option value="<?php echo $row->id_es1;?>"><?php echo $row->nama_eselon1;?></option>
					<?php }?>
					</select>
					</div></div>
					<div id="isies2up"></div>
					<div id="isies3up"></div>
					<div id="isies4up"></div>
					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-gavel"></i></span>
                    <select name="jabatanup" id="jabatanup" class="form-control"><option value=0>Pilih Jabatan</option></select>
					</div></div>
					<div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-primary btn-file">
                        <i class="fa fa-search"></i> <input type="file" name="urtug" id="urtug" multiple="multiple">
                    </span>
                </span>
                <input type="text" class="form-control" placeholder="Tidak ada berkas dipilih" readonly>
            </div>
					
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
					<input type="submit" class="btn btn-primary" value="Upload" id="prosesUpload"/>
                    </form>
                </div>
            </div>
        </div>
	</div>
</div>
</div>