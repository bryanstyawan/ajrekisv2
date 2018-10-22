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
					  <th>judul</th>
					  <th>action</th>
                    </tr>
					</thead>
					<tbody>
					<?php $x=1;
						foreach($list->result() as $row){?>
							<tr>
								<td><?php echo $x;?></td>
								<td><?php echo $row->judul;?></td>
								<td><button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id_berita;?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
								<button class="btn btn-primary btn-xs" onclick="del('<?php echo $row->id_berita;?>')"><i class="fa fa-trash"></i></button>
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
	<!-- CK Editor -->
    <script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/ckeditor/ckeditor.js"></script>
	<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script>
$(document).ready(function(){
	$("#addData").click(function(){
		$("#newData").modal('show');
	})

	$("#edit").click(function(){
		var judul       = $("#njudul").val();
		var berita      = CKEDITOR.instances.neditor2.getData();
		var oid 		 = $("#oid");
		var data_header = {
							'id_berita' : oid,
        					'judul'		:judul,
        					'isi_berita':berita
			              };  					
			$.ajax({
				url :"<?php echo site_url()?>/berita/addBerita",
				type:"post",
				data:{data_sender:data_header},
				dataType: "json",
				beforeSend:function(){
					$("#newData").modal('hide');
				},
				success:function(){
					Lobibox.notify('success', {
						msg: 'Data Berhasil Ditambahkan'
						});
	                  setTimeout(function(){
	                    location.reload();
	                  }, 5600);
					//$("#isi").load('master/ajaxEselon1');
				},
				error:function(){
					Lobibox.notify('success', {
						msg: 'Data Berhasil Ditambahkan'
						});
	                  setTimeout(function(){
	                    location.reload();
	                  }, 5600);
					/*
						Lobibox.notify('error', {
							msg: 'Gagal Melakukan Penambahan data'
							});
					*/					
				}

			})
	})	


	$("#add").click(function(){
		var judul  = $("#judul").val();
		var berita= CKEDITOR.instances.editor1.getData();
		if (judul.length <= 0 || berita.length <= 0) 
		{

		}
		else
		{
	        var data_header = {
	        					'judul'		:judul,
	        					'isi_berita':berita
				              };  			

			$.ajax({
				url :"<?php echo site_url()?>/berita/addBerita",
				type:"post",
				data:{data_sender:data_header},
				dataType: "json",
				beforeSend:function(){
					$("#newData").modal('hide');
				},
				success:function(){
					Lobibox.notify('success', {
						msg: 'Data Berhasil Ditambahkan'
						});
	                  setTimeout(function(){
	                    location.reload();
	                  }, 5600);
					//$("#isi").load('master/ajaxEselon1');
				},
				error:function(){
					Lobibox.notify('success', {
						msg: 'Data Berhasil Ditambahkan'
						});
	                  setTimeout(function(){
	                    location.reload();
	                  }, 5600);
					/*
						Lobibox.notify('error', {
							msg: 'Gagal Melakukan Penambahan data'
							});
					*/					
				}

			})
		}
	})
})

	function edit(id){
		$.getJSON('<?php echo site_url() ?>/berita/editBerita/'+id,
			function( response ) {
				$("#editData").modal('show');
				$("#njudul").val(response['judul']);
				$("#neditor2").val(response['isi_berita']);
				$("#oid").val(response['id_berita']);				
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
						url :"<?php echo site_url()?>/berita/delberita/"+id,
						type:"post",
						success:function(){
							Lobibox.notify('success', {
								msg: 'Data Berhasil Dihapus'
							});
		                  setTimeout(function(){
		                    location.reload();
		                  }, 5600);							
//							$("#isi").load('admin/ajaxUser');
						},
						error:function(){
							Lobibox.notify('error', {
								msg: 'Gagal Melakukan Hapus data'
							});
			                  setTimeout(function(){
			                    location.reload();
			                  }, 5600);							
						}
					})
				}
    		}	
    	})				
	}	
	

	$(function () {
		CKEDITOR.replace('editor1');
		CKEDITOR.replace('neditor2');		
		$(".textarea").wysihtml5();
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
						<div class="form-group">
							<div class="input-group">
		                    	<span class="input-group-addon"><i class="fa fa-pencil"></i></span>
		                    	<input type="text" id="judul" name="judul" class="form-control" placeholder="Judul berita">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
                    			<textarea id="editor1" name="editor1" rows="10" cols="80">Isi berita</textarea>
							</div>
						</div>						
				
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
					<form id="editForm" name="editForm">
						<div class="form-group">
							<div class="input-group">
		                    	<span class="input-group-addon"><i class="fa fa-pencil"></i></span>
		                    	<input type="text" id="njudul" name="njudul" class="form-control" placeholder="Judul berita">
								<input type="hidden" id="oid" name="oid" class="form-control">		                  	
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
                    			<textarea id="neditor2" name="neditor2" rows="10" cols="80">Isi berita</textarea>
							</div>
						</div>						
				
					</form>
                </div>
<!--
			                    <textarea id="editor2" style="color: black" name="editor2" placeholder="Isi Berita" rows="10" cols="91"></textarea>                    
-->
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
					<input type="submit" class="btn btn-primary" value="Simpan" id="edit"/>
                    
                </div>
            </div>
        </div>
	</div>
</div>
</div>