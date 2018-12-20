<?=$this->load->view('templates/common/preloader');?>
<?php
isset($es1);
isset($class_posisi);
?>
<div class="col-xs-12">
	<div class="box">
    	<div class="box-header">

			<div class="box-body">
				<div class="container-fluid">
					
					<div class="row col-xs-12">
			            <h4>Jenis Jabatan :</h4>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</span>
							<select class="form-control" name="select_jenis_jabatan" id="select_jenis_jabatan">
								<option value="">------------NONE------------</option>
								<?php foreach($jenis_posisi->result() as $row){?>
									<option value="<?php echo $row->id;?>"><?php echo $row->nama_kat_posisi;?></option>
								<?php }?>									
							</select>
						</div>
						<progress class="progress progress-striped progress-animated" id="prg_progress_bar_es3" style="width: 473px;margin-bottom: 0px;visibility: hidden;" value="0" max="100">
							25%
						</progress>
					</div>

					<div class="row col-xs-6">

			            <h4>Pimpinan Tinggi Madya (Eselon I) :</h4>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
			                </span>
			                <select class="form-control filter_data_eselon" name="select_eselon_1" id="select_eselon_1">
			                	<option value="">------Pilih Salah Satu------</option>
								<?php foreach($es1->result() as $row){?>
									<option value="<?php echo $row->id_es1;?>"><?php echo $row->nama_eselon1;?></option>
								<?php }?>
			                </select>
			            </div>
						<progress class="progress progress-striped progress-animated" id="prg_progress_bar_es1" style="width: 473px;margin-bottom: 0px;visibility: hidden;" value="0" max="100">
							25%
						</progress>

			            <h4>Administrator (Eselon III) :</h4>
						<div id="isi_select_eselon_3">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
				                </span>
				                <select class="form-control select_eselon_child_global select_eselon_child_global_2" name="select_eselon_3" id="select_eselon_3">
				                	<option value="">------------NONE------------</option>
				                </select>
				            </div>
							<progress class="progress progress-striped progress-animated" id="prg_progress_bar_es3" style="width: 473px;margin-bottom: 0px;visibility: hidden;" value="0" max="100">
								25%
							</progress>
						</div>						
					</div>

					<div class="row col-xs-6 pull-right">

			            <h4>Pimpinan Tinggi Pratama (Eselon II) :</h4>
						<div id="isi_select_eselon_2">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
				                </span>
				                <select class="form-control select_eselon_child_global" name="select_eselon_2" id="select_eselon_2">
				                	<option value="">------------NONE------------</option>
				                	<?php
				                		if (count($es2->result()) != 0) {
				                			# code...
				                			$data_list = $es2->result();
				                			for ($i=0; $i < count($data_list); $i++) {
				                			# code...
				                	?>
											<option value="<?=$data_list[$i]->id_es2;?>"><?=$data_list[$i]->nama_eselon2;?></option>
				                	<?php
				                			}
				                		}
				                	?>
				                </select>
				            </div>
							<progress class="progress progress-striped progress-animated" id="prg_progress_bar_es2" style="width: 473px;margin-bottom: 0px;visibility: hidden;" value="0" max="100">
								25%
							</progress>
						</div>

			            <h4>Pengawas (Eselon IV) :</h4>
						<div id="isi_select_eselon_4">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
				                </span>
				                <select class="form-control select_eselon_child_global select_eselon_child_global_2 select_eselon_child_global_3" name="select_eselon_4" id="select_eselon_4">
				                	<option value="">------------NONE------------</option>
				                </select>
				            </div>
							<progress class="progress progress-striped progress-animated" id="prg_progress_bar_es4" style="width: 473px;margin-bottom: 0px;visibility: hidden;" value="0" max="100">
								25%
							</progress>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-xs-12" id="section_detail_pegawai">
	<div class="box">
    	<div class="box-header">
			<h3>Detail Pegawai</h3>
			<div class="box-tools pull-right">
				<button class="btn btn-block btn-danger" onclick="detail_pegawai(0,'main')"><i class="fa fa-close"></i></button>
			</div>
		</div>
		<div class="box-body">
			<div class="container">
				<div class="row">					
					<div class="col-md-6">
						<div class="form-group">
							<label>Jabatan</label>
							<input type="text" class="form-control" id="f_jabatan" disabled="disabled">
						</div>
					</div>
				</div>					
			</div>
			<table id="example2" class="table table-bordered table-striped table-view" style="font-size:12px;">
				<thead>
					<tr>
						<td></td>
						<td>Nama Pegawai</td>
						<td>NIP</td>
						<td>Status</td>
						<td>Status</td>																				
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="col-xs-12" id="section_view">
	<div class="box">
    	<div class="box-header">
			<h3 class="box-title pull-right"><button class="btn btn-block btn-primary" id="addData"><i class="fa fa-plus-square"></i> Tambah Jabatan</button></h3>
    		<div class="box-body" id="isi">
		    	<div id="halaman_header" class="pull-right" style="margin-top: 40px;margin-left: 76%;">
		    	</div>
		        <table id="example1" class="table table-bordered table-striped" style="font-size:12px;">
					<thead>
				        <tr>
							<th>No</th>
							<th>Eselon 1</th>
							<th>Eselon 2</th>
							<th>Eselon 3</th>
							<th>Eselon 4</th>
							<th>Jenis Jabatan</th>
							<th>Jabatan</th>
							<th>Jumlah Pegawai</th>
							<th>Status SKP</th>
							<th width="7%">action</th>
				        </tr>
					</thead>
					<tbody id="table_content">
						<?php
							if ($list != 0)
							{
								# code...
								for ($i=0; $i < count($list); $i++) {
									# code...
						?>
									<tr>
										<td><?=$i+1;?></td>
										<td><?=$list[$i]->nama_eselon1;?></td>
										<td><?=$list[$i]->nama_eselon2;?></td>
										<td><?=$list[$i]->nama_eselon3;?></td>
										<td><?=$list[$i]->nama_eselon4;?></td>
										<td><?=$list[$i]->nama_kat_posisi;?></td>
										<td><?=$list[$i]->nama_posisi;?></td>
										<td><a class="btn bg-yellow" onclick="detail_pegawai('<?php echo $list[$i]->id;?>','detail')"><?=$list[$i]->counter_pegawai;?></a></td>
										<td>
											<?php
												if($list[$i]->counter_skp == 0)
												{
											?>
													<label class="btn btn-danger">SKP tidak tersedia</label>
											<?php
												}
												else {
													# code...
											?>
													<label class="btn btn-success">SKP tersedia</label>
											<?php													
												}
											?>
										</td>
										<td>
											<button class="btn btn-primary btn-xs" onclick="edit('<?php echo $list[$i]->id;?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;

											<?php
												if($list[$i]->counter_skp == 0)
												{
											?>
													<?php
														if ($list[$i]->counter_pegawai < 1) {
															# code...
													?>
															<button class="btn btn-danger btn-xs" onclick="del('<?php echo $list[$i]->id;?>')"><i class="fa fa-trash"></i></button>											
													<?php
														}
														else {
															# code...
													?>
															<button class="btn btn-danger btn-xs" onclick="del('<?php echo $list[$i]->id;?>')"><i class="fa fa-trash"></i></button>											
													<?php														
														}
													?>
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
		    	<div id="halaman_footer" class="pull-right">
			  	</div>
		    </div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>
</div>


<!---
***************************************************************************************************************
-->
<div class="example-modal">
<div class="modal modal-success fade" id="newData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="box-content">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Jabatan</h4>
                  </div>
                <div class="modal-body" style="background-color: #fff!important;">
					<form id="addForm" name="addForm">
						<input type="hidden" id="crud">
						<input type="hidden" id="oid">						
						<label style="color: #000;font-weight: 400;font-size: 19px;">Jenis Jabatan</label>
						<div class="form-group">
							<div class="input-group">
			                    <span class="input-group-addon"></span>
			                    <select name="kat" id="kat" class="form-control"><option value="">Jenis Jabatan</option>
									<?php foreach($katpos->result() as $row){?>
										<option value="<?php echo $row->id;?>"><?php echo $row->nama_kat_posisi;?></option>
									<?php }?>
								</select>
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Pimpinan Tinggi Madya (Eselon I)</label>
						<div class="form-group">
							<div class="input-group">
			                    <span class="input-group-addon"></span>
			                    <select name="es1" id="es1" class="form-control"><option value="">Pilih Eselon 1</option>
								<?php foreach($es1->result() as $row){?>
									<option value="<?php echo $row->id_es1;?>"><?php echo $row->nama_eselon1;?></option>
								<?php }?>
								</select>
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Pimpinan Tinggi Pratama (Eselon II)</label>
						<div id="isies2">
							<div class="form-group">
								<div class="input-group">
				                    <span class="input-group-addon"></span>
				                    <select class="form-control" id="es2"><option value="">Pilih Eselon 2</option></select>
								</div>
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Administrator (Eselon III)</label>
						<div id="isies3">
							<div class="form-group">
								<div class="input-group">
				                    <span class="input-group-addon"></span>
				                    <select class="form-control" id="es3"><option value="">Pilih Eselon 3</option></select>
								</div>
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Pengawas (Eselon IV)</label>
						<div id="isies4">
							<div class="form-group">
								<div class="input-group">
				                    <span class="input-group-addon"></span>
				                    <select class="form-control" id="es4"><option value="">Pilih Eselon 3</option></select>
								</div>
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Atasan</label>
						<div class="form-group">
							<div class="input-group">
			                    <span class="input-group-addon"></span>
			                    <select name="atasan" id="atasan" class="form-control"><option value=0>Pilih Atasan</option></select>
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Jabatan</label>
						<div class="form-group">
							<div class="input-group" id="input-jabatan">
			                    <span class="input-group-addon"></span>
			                    <input type="text" id="jabatan" name="jabatan" class="form-control" placeholder="jabatan">
								<a class="form-control btn btn-success" style="display:none;"><i class="fa fa-plus-square"></i> Lihat Jabatan</a>							
								<input type="hidden" id="id_jfu">
								<input type="hidden" id="id_jft">								
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Kelas Jabatan</label>
						<div class="form-group">
							<div class="input-group">
			                    <span class="input-group-addon"></span>
			                    <select name="grade" id="grade" class="form-control">
			                    	<option value=0>Pilih Kelas Jabatan</option>
			                    	<?php
			                    		for ($i=0; $i < count($class_posisi) ; $i++) {
			                    			# code...
			                    	?>
											 <option value="<?=$class_posisi[$i]->posisi_class;?>"><?=$class_posisi[$i]->posisi_class;?></option>
									<?php
			                    		}
			                    	?>
			                    </select>
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


<!---
***************************************************************************************************************
-->

<div class="example-modal">
    <div class="modal modal-success fade" id="modal-detail-jfu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="box-content">

            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header"><h3 class="heading-hr text-center"><i class="icon-user"></i>Jabatan Fungsional Umum</h3></div>
                    <div class="modal-body" style="background-color: #fff!important;color:#000!important;">
                        <div class="container-fluid" id="get-datatable">
						</div>
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

$(function () {
	$("#section_detail_pegawai").hide();			
	$("#select_jenis_jabatan").val('1');	
	$("#select_eselon_1").val('<?=$this->session->userdata('sesEs1');?>');
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

$(document).ready(function(){

	$("#addData").click(function(){
		$("#newData").modal('show');
		$("#crud").val('insert');
	})

	$("#kat").change(function(){
		$('#es1 option[value=""]').attr('selected', 'selected');
		$('#es2 option[value=""]').attr('selected', 'selected');
		$('#es3 option[value=""]').attr('selected', 'selected');
		$('#es4 option[value=""]').attr('selected', 'selected');
		if (this.value == 4 || this.value == 2) {
			$('#grade').prop('disabled', true);
			$('#input-jabatan > input').prop('disabled', true);			
			$('#input-jabatan > a').css('display','');			
		}
		else
		{
			$('#grade').prop('disabled', false);
			$('#input-jabatan > input').prop('disabled', false);						
			$('#input-jabatan > a').css('display','none');						
		}
	})

	$('#input-jabatan > a').click(function() {
		if($("#kat").val() == 2)
		{
			$.ajax({
				url :"<?php echo site_url()?>master/jabatan_fungsional_tertentu/res_data/datatable",
				type:"post",
				beforeSend:function(){
					$("#loadprosess").modal('show');
				},
				success:function(msg){
					$('#modal-detail-jfu > div > div > div > div.modal-header > h3').html("Jabatan Fungsional Tertentu");													
					$("#get-datatable").html(msg);					
					$("#modal-detail-jfu").modal('show');				
					$("#loadprosess").modal('hide');							
				},
				error:function(jqXHR,exception)
				{
					ajax_catch(jqXHR,exception);					
				}
			})		
		}
		else if($("#kat").val() == 4)
		{
			$.ajax({
			url :"<?php echo site_url()?>master/jabatan_fungsional_umum/res_data/datatable",
			type:"post",
			beforeSend:function(){
				$("#loadprosess").modal('show');
			},
			success:function(msg){
				$('#modal-detail-jfu > div > div > div > div.modal-header > h3').html("Jabatan Fungsional Umum");								
				$("#get-datatable").html(msg);					
				$("#modal-detail-jfu").modal('show');				
				$("#loadprosess").modal('hide');							
			},
			error:function(jqXHR,exception)
			{
				ajax_catch(jqXHR,exception);					
			}
		})		
		}
	})			

	$("#es1").change(function(){
		var es1 = $("#es1").val();
		$.ajax({
			url :"<?php echo site_url()?>/master/data_eselon2/cariEs2",
			type:"post",
			data:"es1="+es1,
			beforeSend:function(){
				$("#loadprosess").modal('show');
			},
			success:function(msg){
				$("#isies2").html(msg);
				setTimeout(function(){
					$("#loadprosess").modal('hide');
				}, 500);
			},
			error:function(jqXHR,exception)
			{
				ajax_catch(jqXHR,exception);					
			}
		})
	})

	$("#nes1").change(function(){
		var es1 = $("#nes1").val();
		$.ajax({
			url :"<?php echo site_url()?>/master/data_eselon2/cariEs2edit",
			type:"post",
			data:"nes1="+es1,
			success:function(msg){
				$("#nisies2").html(msg);
			},
			error:function(jqXHR,exception)
			{
				ajax_catch(jqXHR,exception);					
			}
		})
	})

	$("#select_jenis_jabatan").change(function(){  
		var data_link = {
						'data_1': $("#select_eselon_1").val(),
						'data_2': $("#select_eselon_2").val(),
						'data_3': $("#select_eselon_3").val(),
						'data_4': $("#select_eselon_4").val(),
						'data_5': $("#select_jenis_jabatan").val()
		}
		$.ajax({
			url :"<?php echo site_url()?>/master/filter_data_eselon",
			type:"post",
			data: { data_sender : data_link},
			beforeSend:function(){
				$("#loadprosess").modal('show');
				$("#halaman_header").html("");
				$("#halaman_footer").html("");
				$('#example1').dataTable().fnDestroy();
				$("#example1 tbody tr").remove();
				var newrec  = '<tr">' +
		        					'<td colspan="8" class="text-center">Memuat Data</td>'
		    				   '</tr>';
		        $('#example1 tbody').append(newrec);
			},			
			success:function(msg){
				$("#example1 tbody tr").remove();
				$("#table_content").html(msg);
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
				setTimeout(function(){
					$("#loadprosess").modal('hide');
				}, 1000);
			},
			error:function(jqXHR,exception)
			{
				ajax_catch(jqXHR,exception);					
			}
		})		
	})

	$("#select_eselon_1").change(function(){
		var select_eselon_1      = $(this).val();
		var select_eselon_2      = '';
		var select_eselon_3      = '';
		var select_eselon_4      = '';
		var select_jenis_jabatan = $("#select_jenis_jabatan").val();
        $('#select_eselon_2').find('option').remove();
        $('#select_eselon_2').append($("<option></option>").attr("value", '').text('------------NONE------------'));
        $('#select_eselon_3').find('option').remove();
        $('#select_eselon_3').append($("<option></option>").attr("value", '').text('------------NONE------------'));
        $('#select_eselon_4').find('option').remove();
        $('#select_eselon_4').append($("<option></option>").attr("value", '').text('------------NONE------------'));
		$.ajax({
			url :"<?php echo site_url()?>/master/data_eselon2/cariEs2_filter/filter_data_eselon",
			type:"post",
			data:"select_eselon_1="+select_eselon_1,
			beforeSend:function(){
				$("#loadprosess").modal('show');
				$("#halaman_header").html("");
				$("#halaman_footer").html("");
				$('#example1').dataTable().fnDestroy();
				$("#example1 tbody tr").remove();
				var newrec  = '<tr">' +
		        					'<td colspan="8" class="text-center">Memuat Data</td>'
		    				   '</tr>';
		        $('#example1 tbody').append(newrec);
			},
			success:function(msg){
				$("#isi_select_eselon_2").html(msg);
				var data_link = {
	        					'data_1': select_eselon_1,
	        					'data_2': select_eselon_2,
	        					'data_3': select_eselon_3,
	        					'data_4': select_eselon_4,
	        					'data_5': select_jenis_jabatan
				}
				$.ajax({
					url :"<?php echo site_url()?>master/filter_data_eselon",
					type:"post",
					data: { data_sender : data_link},
					success:function(msg){
						$("#example1 tbody tr").remove();
						$("#table_content").html(msg);
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
						setTimeout(function(){
							$("#loadprosess").modal('hide');
						}, 500);
					},
					error:function(jqXHR,exception)
					{
						ajax_catch(jqXHR,exception);					
					}
				})

			},
			error:function(jqXHR,exception)
			{
				ajax_catch(jqXHR,exception);					
			}
		})
	})

	$("#select_eselon_2").change(function(){
		var select_eselon_1      = $("#select_eselon_1").val();
		var select_eselon_2      = $("#select_eselon_2").val();
		var select_eselon_3      = '';
		var select_eselon_4      = '';
		var select_jenis_jabatan = $("#select_jenis_jabatan").val();
        $('#select_eselon_3').find('option').remove();
        $('#select_eselon_3').append($("<option></option>").attr("value", '').text('------------NONE------------'));
        $('#select_eselon_4').find('option').remove();
        $('#select_eselon_4').append($("<option></option>").attr("value", '').text('------------NONE------------'));
		$.ajax({
			url :"<?php echo site_url()?>/master/data_eselon3/cariEs3_filter/filter_data_eselon",
			type:"post",
			data:"select_eselon_2="+select_eselon_2,
			beforeSend:function(){
				$("#loadprosess").modal('show');
				$("#halaman_header").html("");
				$("#halaman_footer").html("");
				$('#example1').dataTable().fnDestroy();
				$("#example1 tbody tr").remove();
				var newrec  = '<tr">' +
		        					'<td colspan="8" class="text-center">Memuat Data</td>'
		    				   '</tr>';
		        $('#example1 tbody').append(newrec);
			},
			success:function(msg){
				$("#isi_select_eselon_3").html(msg);
				var data_link = {
	        					'data_1': select_eselon_1,
	        					'data_2': select_eselon_2,
	        					'data_3': select_eselon_3,
	        					'data_4': select_eselon_4,
	        					'data_5': select_jenis_jabatan
				}
				$.ajax({
					url :"<?php echo site_url()?>/master/filter_data_eselon",
					type:"post",
					data: { data_sender : data_link},
					success:function(msg){
						$("#example1 tbody tr").remove();
						$("#table_content").html(msg);
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
						setTimeout(function(){
							$("#loadprosess").modal('hide');
						}, 500);
					},
					error:function(jqXHR,exception)
					{
						ajax_catch(jqXHR,exception);					
					}
				})
			},
			error:function(jqXHR,exception)
			{
				ajax_catch(jqXHR,exception);					
			}
		})
	})

	$("#atasan").focus(function(){
		var kat = $('#kat').val();
		var es1 = $('#es1').val();

		if (kat.length <= 0 || es1.length <= 0)
		{

		}
		else
		{
			$.ajax({
				url :"<?php echo site_url()?>/master/cariAtasan",
				type:"post",
				data:$("#addForm").serialize(),
				success:function(msg){
					$("#atasan").html(msg);
				}
			})
		}
	})

	$("#natasan").focus(function(){
		var kat = $('#nkat').val();
		var es1 = $('#nes1').val();

		if (kat.length <= 0 || es1.length <= 0)
		{

		}
		else
		{
			$.ajax({
				url :"<?php echo site_url()?>/master/data_struktur/cariAtasan",
				type:"post",
				data:$("#editForm").serialize(),
				success:function(msg){
					$("#natasan").html(msg);
				}
			})
		}
	})

	$("#add").click(function(){
		var es1     = $("#es1").val();
		var es2     = $("#es2").val();
		var es3     = $("#es3").val();
		var es4     = $("#es4").val();
		var grade   = $("#grade").val();
		var atasan  = $("#atasan").val();
		var kat     = $("#kat").val();
		var jabatan = $("#jabatan").val();
		var crud    = $("#crud").val();

	    if (kat.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Jenis Jabatan tidak boleh kosong."
			});
		}
		else if (es1.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Pimpinan Tinggi Madya Eselon 1 tidak boleh kosong."
			});
		}
		else if (atasan == 0)
		{
			if(kat == 1)
			{
				add_struktur();
			}
			else
			{
				Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
				{
					msg: "Data Atasan tidak boleh kosong."
				});
			}
		}
		else
		{
			if (kat == 4) {
				if (jabatan.length <= 0)
				{
					Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
					{
						msg: "Data Jabatan tidak boleh kosong."
					});
				}
				else
				{
					add_struktur();
				}
			} else 
			{
				if (grade <= 0)
				{
					Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
					{
						msg: "Data Kelas Jabatan tidak boleh kosong."
					});
				}
				else if (jabatan.length <= 0)
				{
					Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
					{
						msg: "Data Jabatan tidak boleh kosong."
					});
				}
				else
				{
					add_struktur();
				}
			}
		}
	})
})

function edit(id){
	$.getJSON('<?php echo site_url() ?>/master/data_struktur/editStruktur/'+id,
		function( response )
		{
			// console.log(response[0]['atasan']);
			$("#newData").modal('show');
			$("#crud").val('update');
			$("#oid").val(response['id']);			
			$("#es1").val(response['eselon1']);
			$("#es2").append('<option value="'+response['eselon2']+'" selected>'+response['nama_eselon2']+'</option>');
			$("#es3").append('<option value="'+response['eselon3']+'" selected>'+response['nama_eselon3']+'</option>');
			$("#es4").append('<option value="'+response['eselon4']+'" selected>'+response['nama_eselon4']+'</option>');
			$("#kat").val(response['kat_posisi']);
			$("#atasan").append('<option value="'+response['atasan']+'" selected>'+response['posisi_atasan']+'</option>');
			$("#grade").append('<option value="'+response['id_posisi_class']+'" selected>'+response['id_posisi_class']+'</option>');
			$("#jabatan").val(response['nama_posisi']);
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
					url :"<?php echo site_url()?>/master/data_struktur/delStruktur/"+id,
					type:"post",
					success:function(msg){
						var obj = jQuery.parseJSON (msg);
						ajax_status(obj);
					},
					error:function(jqXHR,exception)
					{
						ajax_catch(jqXHR,exception);					
					}
				})
			}
		}
	})
}

function add_struktur() {
	var es1     = $("#es1").val();
	var es2     = $("#es2").val();
	var es3     = $("#es3").val();
	var es4     = $("#es4").val();
	var grade   = $("#grade").val();
	var atasan  = $("#atasan").val();
	var kat     = $("#kat").val();
	var jabatan = $("#jabatan").val();
	var id_jfu  = $("#id_jfu").val();
	var id_jft  = $("#id_jft").val();
	var crud    = $("#crud").val();
	var oid     = $("#oid").val();

	$.ajax({
		url :"<?php echo site_url()?>/master/data_struktur/addStruktur",
		type:"post",
		data:"es1="+es1+"&es2="+es2+"&es3="+es3+"&es4="+es4+"&atasan="+atasan+"&kat="+kat+"&jabatan="+jabatan+"&grade="+grade+"&id_jfu="+id_jfu+"&id_jft="+id_jft+"&crud="+crud+"&oid="+oid,
		beforeSend:function(){
			$("#newData").modal('hide');
			$("#loadprosess").modal('show');
		},
		success:function(msg){
			var obj = jQuery.parseJSON (msg);
			ajax_status(obj);
		},
		error:function(jqXHR,exception)
		{
			ajax_catch(jqXHR,exception);					
		}
	})	
}

function detail_pegawai(id,arg) {
	if(arg == 'detail')
	{
		$.ajax({
			url :"<?php echo site_url()?>/master/data_struktur/get_emp_from_org/"+id,
			type:"post",
			beforeSend:function(){
				$("#newData").modal('hide');
				$("#loadprosess").modal('show');
			},
			success:function(msg){
				// var obj = jQuery.parseJSON (msg);
				$("#loadprosess").modal('hide');				
				$('#example2 tbody').html(msg);
			},
			error:function(jqXHR,exception)
			{
				ajax_catch(jqXHR,exception);					
			}
		})		
		$("#section_view").hide();
		$("#section_detail_pegawai").show();
	}
	else if(arg == 'main')
	{
		$("#section_view").show();		
		$("#section_detail_pegawai").hide();	
		$('#example2 tbody').html('');			
	}
}
</script>
