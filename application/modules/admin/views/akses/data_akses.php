<style>
li {list-style:none}
</style>
<div class="col-md-4">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Role User</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <?php foreach($role->result() as $row){
						echo "<li>".anchor('admin/akses/'.$row->id_role,$row->nama_role)."</li>";
					}?>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
            <div class="col-xs-8" id="data_akses">
              <div class="box">
				<table class="table table-striped">
					<tbody>
					<tr>
						<th>Nama Menu</th>
						<th>
							Create
							<!-- <span class="pull-right col-lg-6">
								<div class="col-lg-9">
									Check ALL 
								</div>
								<div class="col-lg-1">
									<input type="checkbox" id="checkbox_all_role_cr" style="display: block;margin: 0px;margin-left: 15px;padding: 0px;background: rgb(255, 255, 255);border: 0px;height: 25px;width: 22px;">									
								</div>
							</span>							 -->
						</th>
						<th>
							Read
							<!-- <span class="pull-right col-lg-6">
								<div class="col-lg-9">
									Check ALL 
								</div>
								<div class="col-lg-1">
									<input type="checkbox" id="checkbox_all_role_re" style="display: block;margin: 0px;margin-left: 15px;padding: 0px;background: rgb(255, 255, 255);border: 0px;height: 25px;width: 22px;">									
								</div>
							</span>								 -->
						</th>
						<th>
							Update
							<!-- <span class="pull-right col-lg-6">
								<div class="col-lg-9">
									Check ALL 
								</div>
								<div class="col-lg-1">
									<input type="checkbox" id="checkbox_all_role_up" style="display: block;margin: 0px;margin-left: 15px;padding: 0px;background: rgb(255, 255, 255);border: 0px;height: 25px;width: 22px;">									
								</div>
							</span>								 -->
						</th>
						<th>
							Delete
							<!-- <span class="pull-right col-lg-6">
								<div class="col-lg-9">
									Check ALL 
								</div>
								<div class="col-lg-1">
									<input type="checkbox" id="checkbox_all_role_de" style="display: block;margin: 0px;margin-left: 15px;padding: 0px;background: rgb(255, 255, 255);border: 0px;height: 25px;width: 22px;">									
								</div>
							</span>								 -->
						</th>
					</tr>
					<?php treeview($id_role) ?>
					</tbody>
				</table>
              </div><!-- /.box -->
            </div>
			<input type="hidden" id="role" value="<?php echo $this->uri->segment(3);?>">
<script>
function create(id){
	var nilai = $("#cr"+id).val();
	var role = $("#role").val();
	$.ajax({
		url :"<?php echo site_url();?>/admin/create",
		type:"post",
		data:"id_akses="+id+"&nilai="+nilai+"&role="+role,
		success:function(pesan){
			$("#data_akses").html(pesan);
			Lobibox.notify('success',{
				msg : 'Data Berhasil di Update',
				size: 'mini',
				delay:1000
			});
		}		
	})
}
function read(id){
	var nilai = $("#re"+id).val();
	var role = $("#role").val();
	$.ajax({
		url :"<?php echo site_url();?>/admin/read",
		type:"post",
		data:"id_akses="+id+"&nilai="+nilai+"&role="+role,
		success:function(pesan){
			$("#data_akses").html(pesan);
			Lobibox.notify('success',{
				msg : 'Aktivasi Read Berhasil',
				size: 'mini',
				delay:500
			});
		}		
	})
}
function update(id){
	var nilai = $("#up"+id).val();
	var role = $("#role").val();
	$.ajax({
		url :"<?php echo site_url();?>/admin/update",
		type:"post",
		data:"id_akses="+id+"&nilai="+nilai+"&role="+role,
		success:function(pesan){
			$("#data_akses").html(pesan);
			Lobibox.notify('success',{
				msg : 'Aktivasi Update Berhasil',
				size: 'mini',
				delay:500
			});
		}		
	})
}
function delet(id){
	var nilai = $("#de"+id).val();
	var role = $("#role").val();
	$.ajax({
		url :"<?php echo site_url();?>/admin/delet",
		type:"post",
		data:"id_akses="+id+"&nilai="+nilai+"&role="+role,
		success:function(pesan){
			$("#data_akses").html(pesan);
			Lobibox.notify('success',{
				msg : 'Aktivasi Delete Berhasil',
				size: 'mini',
				delay:500
			});
		}		
	})
}

	$(function() {
		$("#checkbox_all_role_cr").click(function()
		{
			checkbox_all_role = $(this).is(':checked');
			$('.name_cr').prop('checked', checkbox_all_role);
		});		

		$("#checkbox_all_role_re").click(function()
		{
			checkbox_all_role = $(this).is(':checked');
			$('.name_re').prop('checked', checkbox_all_role);
		});				

		$("#checkbox_all_role_up").click(function()
		{
			checkbox_all_role = $(this).is(':checked');
			$('.name_up').prop('checked', checkbox_all_role);
		});				

		$("#checkbox_all_role_de").click(function()
		{
			checkbox_all_role = $(this).is(':checked');
			$('.name_de').prop('checked', checkbox_all_role);
		});								
	});

</script>