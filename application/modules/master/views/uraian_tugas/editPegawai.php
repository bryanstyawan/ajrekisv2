<!-- Profile Image -->
<div class="col-md-3">
  	<div class="box box-primary">
        <div class="box-body box-profile">
			<?php 
				if($pegawai != '')
				{
					if ($pegawai[0]->photo == '') {
						# code...
			?>
                		<img class="col-lg-12" style="padding-bottom: 15px;" src="http://mandarinpalace.fi/wp-content/uploads/2015/11/businessman.jpg">					
			<?php														
					}
					else
					{
			?>
            			<img class="col-lg-12" style="padding-bottom: 15px;" src="http://sikerja.kemendagri.go.id/images/demo/users/<?=$pegawai[0]->photo;?>">											
			<?php
					}					
				}
				else
				{
			?>
                		<img class="col-lg-12" style="padding-bottom: 15px;" src="http://mandarinpalace.fi/wp-content/uploads/2015/11/businessman.jpg">					
			<?php								
				}							
			?>
          	<h3 class="profile-username text-center"><?php if($pegawai != ''){echo $pegawai[0]->nama_pegawai;}?></h3>
          	<p class="text-muted text-center"><?php if($pegawai != ''){echo $pegawai[0]->nama_posisi;}?></p>
			<div class="input-group">
				<span class="input-group-btn">
					<span class="btn btn-primary btn-file">
						Unggah
						<input type="file" name="userfile" id="userfile">
					</span>
				</span>
				<input type="text" name="userfile[]" class="form-control" placeholder="Tidak ada berkas dipilih" style="margin-right:-10px;" readonly>
			</div>
		</div>
  	</div>
</div>

<div class="form-horizontal">
	<form id="form_pegawai" name="form_pegawai">
		<div class="col-md-9">
	      	<div class="box box-primary" style="padding:10px;">
				<div class="form-group">
					<label for="gender" class="col-md-2 control-label"></label>
					<div class="col-md-9">
						<div class="row">
						<a class="btn btn-app pull-right" id="btn_save"><i class="fa fa-save"></i> Simpan</a>						
						<a class="btn btn-app pull-right" id="reset"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="es1" class="col-md-2 control-label">Eselon 1</label>
					<div class="col-md-9">
					  <select name="ees1" id="ees1" class="form-control">
						<option value="<?php if($pegawai != ''){echo $pegawai[0]->es1;}?>"><?php if($pegawai != ''){echo $pegawai[0]->nama_eselon1;}?></option>
						<?php foreach($eselon1->result() as $baris){?>
							<option value="<?php echo $baris->id_es1;?>"><?php echo $baris->nama_eselon1;?></option>
						<?php }?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="es2" class="col-md-2 control-label">Eselon 2</label>
					<div class="col-md-9">
					  <select name="ees2" id="ees2" class="form-control">
						<option value="<?php if($pegawai != ''){echo $pegawai[0]->es2;}?>"><?php if($pegawai != ''){echo $pegawai[0]->nama_eselon2;}?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="es3" class="col-md-2 control-label">Eselon 3</label>
					<div class="col-md-9">
					  <select name="ees3" id="ees3" class="form-control">
						<option value="<?php if($pegawai != ''){echo $pegawai[0]->es3;}?>"><?php if($pegawai != ''){echo $pegawai[0]->nama_eselon3;}?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="es4" class="col-md-2 control-label">Eselon 4</label>
					<div class="col-md-9">
					  <select name="ees4" id="ees4" class="form-control">
						<option value="<?php if($pegawai != ''){echo $pegawai[0]->es4;}?>"><?php if($pegawai != ''){echo $pegawai[0]->nama_eselon4;}?></option>
						</select>
					</div>
				</div>

	<!--  
	****************************************************************************************************************
	-->
				<hr>

				<div class="form-group">
	                <label for="inputnip" class="col-md-2 control-label">NIP</label>
	                <div class="col-md-9">
						<input type="text" class="form-control" id="inputnip" name="inputnip" value="<?php if($pegawai != ''){ echo $pegawai[0]->nip;}?>">
	                </div>
	            </div>

				<div class="form-group">
	                <label for="inputnama" class="col-md-2 control-label">Nama</label>
	                <div class="col-md-9">
	                	<input type="hidden" name="flag_crud" id="flag_crud" value="<?php if($pegawai != ''){echo 'edit';}else{echo "add";}?>">
						<input type="hidden" name="oidPegawai" id="oidPegawai" value="<?php if($pegawai != ''){echo $pegawai[0]->id;}?>">
						<input type="text" class="form-control" name="inputnama" id="inputnama" value="<?php if($pegawai != ''){echo $pegawai[0]->nama_pegawai;}?>">
	                </div>
	            </div>

				<div class="form-group">
					<label for="jab" class="col-md-2 control-label">Jabatan</label>
					<div class="col-md-9">
					  <select name="inputjabatan" id="inputjabatan" class="form-control">
						<option value="<?php if($pegawai != ''){echo $pegawai[0]->posisi;}?>"><?php if($pegawai != ''){echo $pegawai[0]->nama_posisi;}?></option>
						</select>
					</div>
				</div>


				<div class="form-group">
	                <label for="inputnama" class="col-md-2 control-label">TMT</label>
	                <div class="col-md-9">
	                	<input type="text" id="tmt" name="tmt" class="form-control timerange" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="<?php if($pegawai != ''){ echo $pegawai[0]->tmt_jabatan;}?>">
	                </div>
	            </div>

				<hr>

				<div class="form-group">
					<label for="jab" class="col-md-2 control-label">Kepala Bagian</label>
					<div class="col-md-9">
					  	<select name="kepala_bagian" id="kepala_bagian" class="form-control">
					  	<option value="">None</option>
					  	<option value="1">Ya</option>
					  	<option value="0">Tidak</option>
						</select>
					</div>
				</div>				

				<div class="form-group">
					<label for="jab" class="col-md-2 control-label">Pelaksana Tugas</label>
					<div class="col-md-9">
						<select name ="pelaksana_tugas" id="pelaksana_tugas" class="form-control">
					  	<option value="">None</option>
					  	<option value="Y">Ya</option>
					  	<option value="T">Tidak</option>						
						</select>
					</div>
				</div>				


				<div class="form-group">
					<div class="container" style="padding-top: 20px;">
					  	<ul class="nav nav-tabs">
						    <li class="active"><a data-toggle="tab" href="#home">Akses</a></li>
						    <li><a data-toggle="tab" href="#menu1">Masa Kerja</a></li>
						    <li><a data-toggle="tab" href="#menu2">Pensiun</a></li>
					  	</ul>

					  	<div class="tab-content">
						    <div id="home" class="tab-pane fade in active">
								<div class="form-group">
					                <label for="inputpass" class="col-md-2 control-label">Kata Sandi</label>
					                <div class="col-md-9">
					      	          <input type="password" class="form-control" id="inputpass" name="inputpass" value="<?php if($pegawai != ''){echo $pegawai[0]->password;}?>">
					                </div>
					            </div>

								<div class="form-group">
					                <label for="inputpass" class="col-md-2 control-label">Konfirmasi Kata Sandi</label>
					                <div class="col-md-9">
					      	          <input type="password" class="form-control" id="inputpass_repeat" name="inputpass_repeat" value="<?php if($pegawai != ''){echo $pegawai[0]->password;}?>">
					                </div>
					            </div>			            
						    </div>
							<div id="menu1" class="tab-pane fade">
								<div class="col-lg-10">
						            <table id="example1" class="table table-bordered table-striped">
										<thead>
								            <tr>
												<th>Tanggal Mulai</th>
												<th>Tanggal Selesai</th>
												<th>Jabatan</th>
												<th>action</th>
								            </tr>
										</thead>
										<tbody id="table_content">
											<?php
											if ($masa_kerja != 0) {
												# code...
												for ($i=0; $i < count($masa_kerja); $i++) { 
													# code...
											?>
												<tr>
													<td><?=$masa_kerja[$i]->StartDate;?></td>
													<td><?=$masa_kerja[$i]->EndDate;?></td>
													<td><?=$masa_kerja[$i]->nama_posisi;?></td>
													<td>
											<?php
															if ($masa_kerja[$i]->EndDate == '9999-01-01') {
																# code...
											?>
																<a class="btn btn-danger btn-xs" href="#" onclick="del_masa_aktif('<?php echo $masa_kerja[$i]->id;?>')">
																	<i class="fa fa-trash"></i>
																</a>
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
							<div id="menu2" class="tab-pane fade">
								<h3>Menu 2</h3>
								<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
							</div>
					  	</div>
					</div>
				</div>

				
			</div>
		</div>
	</form>
</div>		

<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function()
{
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
				"<'row'<'col-sm-5'i><'col-sm-7'p>>",
		"bSort": false						 

		// "dom": '<"top"f>rt'
		// "dom": '<"top"fl>rt<"bottom"ip><"clear">'			
	});	

    $("#tmt").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
    $('.timerange').datepicker({
    	format: 'yyyy-mm-dd'
    });    

	$("#ees1").change(function(){
		$("#ees2").html("<option value=0>None</option>");
		$("#ees3").html("<option value=0>None</option>");
		$("#ees4").html("<option value=0>None</option>");
	})

	$("#ees2").focus(function(){
		$("#ees3").html("<option value=0>None</option>");
		$("#ees4").html("<option value=0>None</option>");
		var es1 = $("#ees1").val();
		$.ajax({
			url :"<?php echo site_url();?>/master/formEselon2",
			type:"post",
			data:"nes1="+es1,
			success:function(hasil){
				$("#ees2").html(hasil);
			}
		})
	})
	
	$("#ees3").focus(function(){
		$("#ees4").html("<option value=0>None</option>");
		var es2 = $("#ees2").val();
		$.ajax({
			url :"<?php echo site_url();?>/master/formEselon3",
			type:"post",
			data:"nes2="+es2,
			success:function(hasil){
				$("#ees3").html(hasil);
			}
		})
	})
	
	$("#ees4").focus(function(){
		var es3 = $("#ees3").val();
		$.ajax({
			url :"<?php echo site_url();?>/master/formEselon4",
			type:"post",
			data:"nes3="+es3,
			success:function(hasil){
				$("#ees4").html(hasil);
			}
		})
	})
	
	$("#inputjabatan").focus(function(){
		var es1 = $("#ees1").val();
		var es2 = $("#ees2").val();
		var es3 = $("#ees3").val();
		var es4 = $("#ees4").val();
		$.ajax({
			url :"<?php echo site_url();?>/master/cariJabatan",
			type:"post",
			data:"es1="+es1+"&es2="+es2+"&es3="+es3+"&es4="+es4,
			success:function(hasil){
				$("#inputjabatan").html(hasil);
			}
		})
	})

	$("#reset").click(function(){
		$("#isi").load('master/ajaxPegawai');
	})

	$("#btn_save").click(function(){
		$.ajax({
			url :"<?php echo site_url()?>/master/save_pegawai",
			type:"post",
			data:$("#form_pegawai").serialize(),
			beforeSend:function(){
				$("#loadprosess").modal('show');								
			},			
			success:function(msg){
				if (msg == 1) 
				{
					var flag_crud = $("#flag_crud").val();
					if (flag_crud == 'add') 
					{
						Lobibox.notify('success', {
							msg: 'Data Berhasil Ditambahkan'
						});
					}	
					else
					{
						Lobibox.notify('success', {
							msg: 'Data Berhasil Dirubah'
						});					
					}				


					setTimeout(function(){ 
						$("#loadprosess").modal('hide');
		              	setTimeout(function(){
							// window.location.href = "<?php echo site_url()?>/master/pegawai";
		                	location.reload();							
		              	}, 1500);																	
					}, 5000);				


				}
			},
			error:function(){
				Lobibox.notify('error', {
					msg: 'Terjadi kesalahan, Gagal melakukan perintah.'
				});
			}			
		})
	})	
})

function del_masa_aktif(id) {
	// body...
	 Lobibox.confirm({
		 title: "Konfirmasi",
		 msg: "Anda yakin akan menghapus data ini ?",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>/master/delete_masa_kerja/"+id,
					type:"post",
					beforeSend:function(){
						$("#newData").modal('hide');
						$("#loadprosess").modal('show');
						$('#example1').dataTable().fnDestroy();	        
						$("#example1 tbody tr").remove();    		
						var newrec  = '<tr">' +
				        					'<td colspan="4" class="text-center">Memuat Data</td>'
				    				   '</tr>';		
				        $('#example1 tbody').append(newrec);    				   														
					},					
					success:function(msg)
					{
						Lobibox.notify('success', {
							msg: 'Data Berhasil Dihapus'
						});
						// $("#example1 tbody tr").remove();    												
						// $("#table_content").html(msg);
						setTimeout(function()
						{
		                    location.reload();							
							// $("#loadprosess").modal('hide');															
						}, 5600);
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