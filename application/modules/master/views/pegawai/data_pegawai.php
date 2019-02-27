<?=$this->load->view('templates/common/preloader');?>
<div class="example-modal">
	<div class="modal modal-success fade" id="preview_image_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="box-content">

			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body" id="preview_image_content" style="background-color: #fff!important;">
					</div>
					<div class="modal-footer" style="background-color: #fff!important;border-top-color: #fff;">
						<a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="example-modal">
    <div class="modal modal-success fade" id="modal-datatable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="box-content">

            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header"><h3 class="heading-hr text-center"><i class="icon-user"></i>Jabatan</h3></div>
                    <div class="modal-body" style="background-color: #fff!important;color:#000!important;">
                        <div class="container-fluid" id="get-datatable">
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section id="view_section">
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
									<option value="">------Pilih Salah Satu------</option>
									<?php foreach($jenis_posisi->result() as $row){?>
										<option value="<?php echo $row->id;?>"><?php echo $row->nama_kat_posisi;?></option>
									<?php }?>									
								</select>
							</div>
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
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title pull-left">
					<button class="btn btn-block btn-primary" onclick="print_excel()"><i class="fa fa-print"></i> CETAK REKAP SKP</button>
				</h3>											
				<h3 class="box-title pull-right">
					<button class="btn btn-block btn-primary" onclick="main_form('insert','NULL')"><i class="fa fa-plus-square"></i> TAMBAH PEGAWAI</button>				
				</h3>				
			</div>
			<div class="box-body" id="isi">
				<div>
					<table class="table table-bordered table-striped table-view">
					<thead>
						<tr>
							<th>NIP</th>
							<th>Nama</th>
							<th>Jabatan (Kelas Jabatan)</th>
							<th>Jabatan Strutur Akademik (Kelas Jabatan)</th>
							<th>Belum Set Target SKP</th>
							<th>Sudah Set Target SKP</th>							
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="table_content">
						<?php
							for ($i=0; $i < count($list); $i++) {
								# code...
								$id             = $list[$i]->id;
								$data_link_a    = "";
								$data_link_text = "";
						?>
						<?php
								if ($list[$i]->photo == '-') {
								# code...
									$data_link_a = "none";
									$data_link_text = "TIDAK ADA FOTO";
								}
								else
								{
									$data_link_text = "LIHAT FOTO";
									$data_link_a = base_url() . 'public/images/pegawai/'.$list[$i]->photo;
								}
						?>
							<tr>
								<td><?=$list[$i]->nip;?></td>
								<td><span class="label label-danger"><?=$list[$i]->id;?></span>&nbsp;<?=$list[$i]->nama_pegawai;?></td>
								<td>
									<?=$list[$i]->nama_posisi;?>
									<b>(
										<?php
										if ($list[$i]->kat_posisi == 1) {
											# code...
											echo $list[$i]->posisi_class_raw;
										}
										elseif ($list[$i]->kat_posisi == 2) {
											# code...
											echo $list[$i]->posisi_class_jft;										
										}
										elseif ($list[$i]->kat_posisi == 4) {
											# code...
											echo $list[$i]->posisi_class_jfu;										
										}									
										elseif ($list[$i]->kat_posisi == 6) {
											# code...
											echo $list[$i]->posisi_class_raw;										
										}																		
									?>										
									)</b>
								</td>
								<td><?=$list[$i]->posisi_akademik_name;?></td>
								<td><?=$list[$i]->empty_skp;?></td>
								<td><?=$list[$i]->nonempty_skp;?></td>																
								<td class="text-center">
									<button class="btn btn-warning btn-xs col-lg-12" style="margin-bottom: 5px;" onclick="main_form('update','<?php echo $list[$i]->id;?>')"><i class="fa fa-edit"></i> UBAH DATA</button>
									<button class="btn btn-danger btn-xs col-lg-12" style="margin-bottom: 5px;" onclick="del('<?php echo $list[$i]->id;?>')"><i class="fa fa-trash"></i> HAPUS DATA</button>
									<button class="btn btn-primary btn-xs col-lg-12" style="margin-bottom: 5px;" onclick="change_password('<?php echo $list[$i]->id;?>')"><i class="fa fa-edit"></i> DEFAULT PASSWORD</button>									
									<a href="#" class="btn btn-success btn-xs col-lg-12" onclick="preview_image('<?=$id;?>','<?=$data_link_a;?>')"><i class="fa fa-search-plus"></i>&nbsp;<?=$data_link_text;?></a>									
								</td>
							</tr>
						<?php
							}
						?>
					</tbody>
					</table>
				</div>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>
</section>

<section id="form_section" style="display:none;">
	<input class="form-control-detail" type="hidden" name="crud" id="crud">
	<input class="form-control-detail" type="hidden" name="oid" id="oid">
	<div class="col-md-12">
		<div class="box" style="background-color: transparent;border: transparent;box-shadow: none;">
			<div class="box-header">
				<h3 class="box-title"></h3>
				<div class="box-tools pull-right"><button class="btn btn-block btn-danger" id="closeData"><i class="fa fa-close"></i></button></div>				
			</div>		
		</div>
	</div>

	<div class='col-md-6'>
		<div class="form-horizontal">
			<form id="form_pegawai" name="form_pegawai">
				<div class="col-md-12">
					<div class="box box-primary" style="padding:10px;">
						<div class="form-group">
							<label for="gender" class="col-md-2 control-label"></label>
							<div class="col-md-11">
								<div class="row">
									<a class="btn btn-success pull-right" id="btn-trigger-controll"><i class="fa fa-save"></i> Simpan</a>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Eselon I</label>
							<div class="col-md-9">
								<select name="f_es1" id="f_es1" class="form-control form-control-detail" disabled="disabled">
									<?php foreach($es1->result() as $row){?>
										<option value="<?php echo $row->id_es1;?>"><?php echo $row->nama_eselon1;?></option>
									<?php }?>
								</select>
							</div>
							<a class="btn btn-default" onclick="get_eselon(1)"><i class="fa fa-search"></i></a>														
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Eselon II</label>
							<div class="col-md-9">
								<select name="f_es2" id="f_es2" class="form-control form-control-detail" disabled="disabled">
								</select>
							</div>
							<a class="btn btn-default" onclick="get_eselon(2)"><i class="fa fa-search"></i></a>							
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Eselon III</label>
							<div class="col-md-9">
								<select name="f_es3" id="f_es3" class="form-control form-control-detail" disabled="disabled">
								</select>
							</div>
							<a class="btn btn-default" onclick="get_eselon(3)"><i class="fa fa-search"></i></a>							
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Eselon 4</label>
							<div class="col-md-9">
								<select name="f_es4" id="f_es4" class="form-control form-control-detail" disabled="disabled">
								</select>
								<input class="form-control form-control-detail" id="f_es4_id" type="hidden">							
							</div>
							<a class="btn btn-default" onclick="get_eselon(4)"><i class="fa fa-search"></i></a>							
						</div>

						<hr>
						<div class="form-group">
							<label class="col-md-2 control-label">NIP</label>
							<div class="col-md-9">
								<input type="text" class="form-control form-control-detail" id="f_nip" name="f_nip" value="">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Nama</label>
							<div class="col-md-9">
								<input type="text" class="form-control form-control-detail" name="f_nama" id="f_nama">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Jabatan</label>
							<div class="col-md-9">
								<input class="form-control form-control-detail" id="f_jabatan" type="text" disabled="">
								<input class="form-control form-control-detail" id="f_jabatan_id" type="hidden">							
							</div>
							<a class="btn btn-default" id="f_jabatan_btn"><i class="fa fa-search"></i></a>
						</div>


						<div class="form-group">
							<label class="col-md-2 control-label">TMT</label>
							<div class="col-md-9">
								<input type="text" id="f_tmt" name="f_tmt" class="form-control form-control-detail timerange-normal" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask> 
							</div>
						</div>

						<hr>
						<div class="form-group">
							<label class="col-md-2 control-label">Jabatan Akademik</label>
							<div class="col-md-9">
								<input class="form-control form-control-detail" id="f_jabatan_akademik" type="text" disabled="">
								<input class="form-control form-control-detail" id="f_jabatan_akademik_id" type="hidden">							
							</div>
							<a class="btn btn-default" id="f_jabatan_akademik_btn"><i class="fa fa-search"></i></a>
						</div>						

					</div>
				</div>
			</form>
		</div>	
	</div>

	<div class="col-md-6">
		<div class="col-lg-7">
			<div class="row container-fluid">
				<div class="box box-primary">
					<div class="box-body box-profile">
						<span class="col-lg-12" style="padding-bottom: 10px;">
							<div class="dropzone" id="dropzone_image">
								<div class="dz-message">
									<img class="col-lg-12" style="padding-bottom: 15px;" src="http://mandarinpalace.fi/wp-content/uploads/2015/11/businessman.jpg">
									<h3> Klik atau Drop File Foto disini</h3>
								</div>
							</div>
						</span>			
						<h3 class="profile-username text-center"></h3>
						<p class="text-muted text-center"></p>
					</div>
				</div>
			</div>		
		</div>

		<div class='col-md-12'>
			<div class="row container-fluid">
				<div class="box box-primary">
					<div class="box-header">
						<h3>History Jabatan</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Jabatan</th>								
									<th>Tanggal Mulai</th>
									<th>Tanggal Selesai</th>
									<th>Status</th>
									<th>action</th>
								</tr>
							</thead>
							<tbody id="table_tmt">

							</tbody>
						</table>					
					</div>
				</div>
			</div>	
		</div>

	</div>

</section>

<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
function preview_image(id,url) {
    // body...
    content = '<form id="editForm" name="addForm"><div class="col-lg-12">'+
				'<img class="col-lg-12" style="padding-bottom: 15px;width: 410px !important;height: 450px !important;" src="'+url+'">'+
			'</div></form>';
	$("#preview_image_content").html(content);
    $("#preview_image_popup").modal('show');
}

$(document).ready(function(){
	$("#select_jenis_jabatan").val(1);	
	$("#select_eselon_1").val('<?=$this->session->userdata('sesEs1');?>');
	$('#select_jenis_jabatan').change(function() {
		var select_eselon_1      = $("#select_eselon_1").val();
		var select_eselon_2      = $("#select_eselon_2").val();
		var select_eselon_3      = $("#select_eselon_3").val();
		var select_eselon_4      = $("#select_eselon_4").val();
		var select_jenis_jabatan = $("#select_jenis_jabatan").val();		
		var data_link = {
						'data_1': select_eselon_1,
						'data_2': select_eselon_2,
						'data_3': select_eselon_3,
						'data_4': select_eselon_4,
						'data_5': select_jenis_jabatan
		}
		$.ajax({
			// xhr: function () {
			// 	var xhr = new window.XMLHttpRequest();
			// 	xhr.upload.addEventListener("progress", function (evt) {
			// 		if (evt.lengthComputable) {
			// 			var percentComplete = evt.loaded / evt.total;
			// 			console.log(percentComplete);
			// 			$('.progress').css({
			// 				width: percentComplete * 100 + '%'
			// 			});
			// 			if (percentComplete === 1) {
			// 				$('.progress').addClass('hide');
			// 			}
			// 		}
			// 	}, false);
			// 	xhr.addEventListener("progress", function (evt) {
			// 		if (evt.lengthComputable) {
			// 			var percentComplete = evt.loaded / evt.total;
			// 			console.log(percentComplete);
			// 			$('.progress').css({	
			// 				width: percentComplete * 100 + '%'
			// 			});
			// 		}
			// 	}, false);
			// 	return xhr;
			// },			
			url :"<?php echo site_url()?>master/filter_data_pegawai",
			type:"post",
			data: { data_sender : data_link},
			beforeSend:function(){
				$("#loadprosess").modal('show');
				$("#halaman_header").html("");
				$("#halaman_footer").html("");
				$('.table-view').dataTable().fnDestroy();
				$(".table-view tbody tr").remove();
				var newrec  = '<tr">' +
		        					'<td colspan="5" class="text-center">Memuat Data</td>'
		    				   '</tr>';
		        $('.table-view tbody').append(newrec);
			},			
			success:function(msg){
				$(".table-view tbody tr").remove();
				$("#table_content").html(msg);
				$(".table-view").DataTable({
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
			url :"<?php echo site_url()?>/master/data_eselon2/cariEs2_filter/filter_data_pegawai",
			type:"post",
			data:"select_eselon_1="+select_eselon_1,
			beforeSend:function(){
				$("#loadprosess").modal('show');
				$("#halaman_header").html("");
				$("#halaman_footer").html("");
				$('.table-view').dataTable().fnDestroy();
				$(".table-view tbody tr").remove();
				var newrec  = '<tr">' +
		        					'<td colspan="5" class="text-center">Memuat Data</td>'
		    				   '</tr>';
		        $('.table-view tbody').append(newrec);
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
					url :"<?php echo site_url()?>/master/filter_data_pegawai",
					type:"post",
					data: { data_sender : data_link},
					success:function(msg){
						$(".table-view tbody tr").remove();
						$("#table_content").html(msg);
				        $(".table-view").DataTable({
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
			url :"<?php echo site_url()?>/master/data_eselon3/cariEs3_filter/filter_data_pegawai",
			type:"post",
			data:"select_eselon_2="+select_eselon_2,
			beforeSend:function(){
				$("#loadprosess").modal('show');
				$("#halaman_header").html("");
				$("#halaman_footer").html("");
				$('.table-view').dataTable().fnDestroy();
				$(".table-view tbody tr").remove();
				var newrec  = '<tr">' +
		        					'<td colspan="8" class="text-center">Memuat Data</td>'
								'</tr>';
		        $('.table-view tbody').append(newrec);
			},
			success:function(msg){
				$("#isi_select_eselon_3").html(msg);
				var data_link = {
	        					'data_1' : select_eselon_1,
				                'data_2' : select_eselon_2,
				                'data_3' : select_eselon_3,
				                'data_4' : select_eselon_4,
								'data_5' : select_jenis_jabatan
				}
				$.ajax({
					url :"<?php echo site_url()?>/master/filter_data_pegawai",
					type:"post",
					data: { data_sender : data_link},
					success:function(msg){
						$(".table-view tbody tr").remove();
						$("#table_content").html(msg);
				        $(".table-view").DataTable({
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
			}
		})
	})

	$("#select_eselon_3").change(function(){
		var select_eselon_1      = $("#select_eselon_1").val();
		var select_eselon_2      = $("#select_eselon_2").val();
		var select_eselon_3      = $("#select_eselon_3").val();;
		var select_eselon_4      = '';
		var select_jenis_jabatan = $("#select_jenis_jabatan").val();
        $('#select_eselon_3').find('option').remove();
        $('#select_eselon_3').append($("<option></option>").attr("value", '').text('------------NONE------------'));
        $('#select_eselon_4').find('option').remove();
        $('#select_eselon_4').append($("<option></option>").attr("value", '').text('------------NONE------------'));
		$.ajax({
			url :"<?php echo site_url()?>/master/data_eselon3/cariEs3_filter/filter_data_pegawai",
			type:"post",
			data:"select_eselon_3="+select_eselon_3,
			beforeSend:function(){
				$("#loadprosess").modal('show');
				$("#halaman_header").html("");
				$("#halaman_footer").html("");
				$('.table-view').dataTable().fnDestroy();
				$(".table-view tbody tr").remove();
				var newrec  = '<tr">' +
		        					'<td colspan="8" class="text-center">Memuat Data</td>'
		    				   '</tr>';
		        $('.table-view tbody').append(newrec);
			},
			success:function(msg){
				$("#isi_select_eselon_3").html(msg);
				var data_link = {
	        					'data_1' : select_eselon_1,
				                'data_2' : select_eselon_2,
				                'data_3' : select_eselon_3,
				                'data_4' : select_eselon_4,
								'data_5' : select_jenis_jabatan
				}
				$.ajax({
					url :"<?php echo site_url()?>/master/filter_data_pegawai",
					type:"post",
					data: { data_sender : data_link},
					success:function(msg){
						$(".table-view tbody tr").remove();
						$("#table_content").html(msg);
				        $(".table-view").DataTable({
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
			}
		})
	})

	$("#select_eselon_4").change(function(){
		var select_eselon_1      = $("#select_eselon_1").val();
		var select_eselon_2      = $("#select_eselon_2").val();
		var select_eselon_3      = $("#select_eselon_3").val();
		var select_eselon_4      = $("#select_eselon_4").val();;
		var select_jenis_jabatan = $("#select_jenis_jabatan").val();
        $('#select_eselon_3').find('option').remove();
        $('#select_eselon_3').append($("<option></option>").attr("value", '').text('------------NONE------------'));
        $('#select_eselon_4').find('option').remove();
        $('#select_eselon_4').append($("<option></option>").attr("value", '').text('------------NONE------------'));
		var data_link = {
						'data_1' : select_eselon_1,
						'data_2' : select_eselon_2,
						'data_3' : select_eselon_3,
						'data_4' : select_eselon_4,
						'data_5' : select_jenis_jabatan
		}
		$.ajax({
			url :"<?php echo site_url()?>/master/filter_data_pegawai",
			type:"post",
			data: { data_sender : data_link},
			success:function(msg){
				$(".table-view tbody tr").remove();
				$("#table_content").html(msg);
				$(".table-view").DataTable({
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
	})		

	$("#closeData").click(function(){
		$("#form_section").css({"display": "none"})
		$("#view_section").css({"display": ""})		
	})		
})

function get_eselon(arg) {
	var data_sender = "";
	if (arg == 1) 
	{
		data_sender = {
			'arg' : arg,
			'es1' : 'none'
		}
	} 
	else if(arg == 2) 
	{
		data_sender = {
			'arg' : arg,			
			'es1' : $("#f_es1").val()			
		}		
	}
	else if(arg == 3) 
	{
		data_sender = {
			'arg' : arg,			
			'es1' : $("#f_es1").val(),
			'es2' : $("#f_es2").val()						
		}		
	}
	else if(arg == 4) 
	{
		data_sender = {
			'arg' : arg,			
			'es1' : $("#f_es1").val(),
			'es2' : $("#f_es2").val(),
			'es3' : $("#f_es3").val()	
		}				
	}		

	$.ajax({
		url :"<?php echo site_url()?>master/data_struktur/get_struktur_eselon/",
		type:"post",
		data: { data_sender : data_sender},		
		beforeSend:function(){
			$("#loadprosess").modal('show');
			$("#get-datatable").html('');			
		},
		success:function(msg){
			$('#modal-datatable > div > div > div > div.modal-header > h3').html("Eselon "+arg);													
			$("#get-datatable").html(msg);					
			$("#modal-datatable").modal('show');				
			$("#loadprosess").modal('hide');							
		},
		error:function(jqXHR,exception)
		{
			ajax_catch(jqXHR,exception);					
		}
	})	

	console.table(data_sender);
}

function del(id){
    LobiboxBase = {
        //DO NOT change this value. Lobibox depended on it
        bodyClass       : 'lobibox-open',
        //DO NOT change this object. Lobibox is depended on it
        modalClasses : {
            'error'     : 'lobibox-error',
            'success'   : 'lobibox-success',
            'info'      : 'lobibox-info',
            'warning'   : 'lobibox-warning',
            'confirm'   : 'lobibox-confirm',
            'progress'  : 'lobibox-progress',
            'prompt'    : 'lobibox-prompt',
            'default'   : 'lobibox-default',
            'window'    : 'lobibox-window'
        },
        buttons: {
            ok: {
                'class': 'lobibox-btn lobibox-btn-default',
                text: 'OK',
                closeOnClick: true
            },
            cancel: {
                'class': 'lobibox-btn lobibox-btn-cancel',
                text: 'Cancel',
                closeOnClick: true
            },
            yes: {
                'class': 'lobibox-btn lobibox-btn-yes',
                text: 'Ya',
                closeOnClick: true
            },
            no: {
                'class': 'lobibox-btn lobibox-btn-no',
                text: 'Tidak',
                closeOnClick: true
            }
        }
    }

	Lobibox.confirm({
		title: "Konfirmasi",
		msg: "Anda yakin akan menghapus data ini ?",
		callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>/master/data_pegawai/store/delete/"+id,					
					type:"post",
					beforeSend:function(){
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
		}
    })
}

function change_password(id){
    LobiboxBase = {
        //DO NOT change this value. Lobibox depended on it
        bodyClass       : 'lobibox-open',
        //DO NOT change this object. Lobibox is depended on it
        modalClasses : {
            'error'     : 'lobibox-error',
            'success'   : 'lobibox-success',
            'info'      : 'lobibox-info',
            'warning'   : 'lobibox-warning',
            'confirm'   : 'lobibox-confirm',
            'progress'  : 'lobibox-progress',
            'prompt'    : 'lobibox-prompt',
            'default'   : 'lobibox-default',
            'window'    : 'lobibox-window'
        },
        buttons: {
            ok: {
                'class': 'lobibox-btn lobibox-btn-default',
                text: 'OK',
                closeOnClick: true
            },
            cancel: {
                'class': 'lobibox-btn lobibox-btn-cancel',
                text: 'Cancel',
                closeOnClick: true
            },
            yes: {
                'class': 'lobibox-btn lobibox-btn-yes',
                text: 'Ya',
                closeOnClick: true
            },
            no: {
                'class': 'lobibox-btn lobibox-btn-no',
                text: 'Tidak',
                closeOnClick: true
            }
        }
    }

	Lobibox.confirm({
		title: "Konfirmasi",
		msg: "Password Standar adalah 'usersikerja', Lanjutkan ?",
		callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>/master/data_pegawai/store/password/"+id,					
					type:"post",
					beforeSend:function(){
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
		}
    })
}


function main_form(params,id) {
	if (params == 'insert') {
		$(".form-control-detail").val('');
		$("#form_section").css({"display": ""})
		$("#view_section").css({"display": "none"})
		$("#form_section > div > div > div.box-header > h3").html("Tambah Data Pegawai");		
		$("#crud").val('insert');		
	} else if(params == 'update') {
		$.ajax({
			url :"<?php echo site_url()?>/master/data_pegawai/get_data_pegawai/"+id,		
			type:"post",
			beforeSend:function(){
				$("#loadprosess").modal('show');
			},
			success:function(msg){
				var obj = jQuery.parseJSON (msg);
				// console.log(obj.jabatan_akademik[0].nama_posisi);
				$(".form-control-detail").val('');
				$("#form_section").css({"display": ""})
				$("#view_section").css({"display": "none"})
				$("#form_section > div > div > div.box-header > h3").html("Ubah Data Pegawai");
				$("#crud").val('update');
				$("#oid").val(obj.pegawai[0].id);
				$("#f_es1").val(obj.pegawai[0].es1);

				if (obj.pegawai != 0) {

					if (obj.list_eselon2.length != 0) 
					{
						var toAppend = '<option value=""> - - - </option>';				
						for (index = 0; index < obj.list_eselon2.length; index++) 
						{
							_text = "";
							if (obj.list_eselon2[index].id_es2 == obj.pegawai[0].es2) {
								_text = "selected";
							}

							toAppend += '<option value="'+obj.list_eselon2[index].id_es2+'" '+_text+'>'+obj.list_eselon2[index].nama_eselon2+'</option>';					
						}
						$('#f_es2').append(toAppend);					
					}
									
					if (obj.list_eselon3.length != 0) 
					{
						var toAppend1 = '<option value=""> - - - </option>';					
						for (index = 0; index < obj.list_eselon3.length; index++) 
						{
							_text = "";
							if (obj.list_eselon3[index].id_es3 == obj.pegawai[0].es3) {
								_text = "selected";
							}

							toAppend1 += '<option value="'+obj.list_eselon3[index].id_es3+'" '+_text+'>'+obj.list_eselon3[index].nama_eselon3+'</option>';					
						}
						$('#f_es3').append(toAppend1);					
					}

					if (obj.list_eselon4.length != 0) 
					{
						var toAppend2 = '<option value=""> - - - </option>';					
						for (index = 0; index < obj.list_eselon4.length; index++) 
						{
							_text = "";
							if (obj.list_eselon4[index].id_es4 == obj.pegawai[0].es4) {
								_text = "selected";
							}

							toAppend2 += '<option value="'+obj.list_eselon4[index].id_es4+'" '+_text+'>'+obj.list_eselon4[index].nama_eselon4+'</option>';					
						}
						$('#f_es4').append(toAppend2);					
					}



					$("#f_nip").val(obj.pegawai[0].nip);
					$("#f_nama").val(obj.pegawai[0].nama_pegawai);

					if (obj.jabatan_raw != '') {
						$("#f_jabatan_id").val(obj.jabatan_raw[0].id);
						if (obj.jabatan_raw[0].kat_posisi == 1) {
							$("#f_jabatan").val(obj.jabatan_raw[0].nama_posisi);										
						}
						else if (obj.jabatan_raw[0].kat_posisi == 2) {
							$("#f_jabatan").val(obj.jabatan_jft[0].nama_jabatan);					
						}
						else if (obj.jabatan_raw[0].kat_posisi == 4) {
							$("#f_jabatan").val(obj.jabatan_jfu[0].nama_jabatan);					
						}														
					}

					$("#f_tmt").val(obj.pegawai[0].tmt_jabatan);				

					toAppend_tmt = "";
					$('#table_tmt').html('');															
					for (let index = 0; index < obj.tmt_pegawai.length; index++) {
						console.log(obj.tmt_pegawai[index].nama_posisi);
						if (obj.tmt_pegawai[index].nama_posisi != null) {
							toAppend_tmt += '<tr>'+
												'<td>'+obj.tmt_pegawai[index].nama_posisi+'</td>'+
												'<td>'+obj.tmt_pegawai[index].StartDate+'</td>'+
												'<td>'+obj.tmt_pegawai[index].EndDate+'</td>'+
												'<td>'+obj.tmt_pegawai[index].status_masakerja+'</td>'+
												'<td></td>'+																																												
											'</tr>';																		
						}

					}
					$('#table_tmt').append(toAppend_tmt);										
					// console.table(obj.tmt_pegawai);

					// obj.jabatan_akademik[0].nama_posisi
					$("#f_jabatan_akademik").val(obj.jabatan_akademik[0].nama_posisi);
					$("#f_jabatan_akademik_id").val(obj.pegawai[0].posisi_akademik);									
				}

				$("#loadprosess").modal('hide');				
			},
			error:function(jqXHR,exception)
			{
				ajax_catch(jqXHR,exception);					
			}
		})		
	}
}

function print_excel() {
	var es1        = $("#select_eselon_1").val();
	var es2        = $("#select_eselon_2").val();	
	var es3        = $("#select_eselon_3").val();
	var es4        = $("#select_eselon_4").val();
	var kat_posisi = $("#select_jenis_jabatan").val();
	if (kat_posisi == '') {
		kat_posisi = '-';
	}

	window.open('<?=base_url();?>master/data_pegawai/print_pegawai/'+kat_posisi+'/'+es1+'/'+es2+'/'+es3+'/'+es4, "_blank");	
	// window.location.href = "<?=base_url();?>master/data_pegawai/print_pegawai/"+kat_posisi+"/"+es1+"/"+es2+"/"+es3+"/"+es4";	

}

$(document).ready(function(){
	$("#f_es1").change(function(){
		$("#f_es2").html("<option value=''>------Pilih Salah Satu------</option>");
		$("#f_es3").html("<option value=''>------Pilih Salah Satu------</option>");
		$("#f_es4").html("<option value=''>------Pilih Salah Satu------</option>");
		$("#f_jabatan").val('');
		$("#f_jabatan_id").val('');		
		var es1 = $(this).val();
		$.ajax({
			url :"<?php echo site_url();?>/master/data_eselon2/formEselon2",
			type:"post",
			data:"nes1="+es1,
			beforeSend:function(){
				$("#loadprosess").modal('show');
			},
			success:function(hasil){
				$("#f_es2").html(hasil);
				setTimeout(function(){
					$("#loadprosess").modal('hide');
				}, 500);
			}
		})
	})	

	$("#f_es2").change(function(){
		$("#f_es3").html("<option value=''>------Pilih Salah Satu------</option>");
		$("#f_es4").html("<option value=''>------Pilih Salah Satu------</option>");
		$("#f_jabatan").val('');
		$("#f_jabatan_id").val('');				
		var es2 = $(this).val();
		$.ajax({
			url :"<?php echo site_url();?>/master/data_eselon3/formEselon3",
			type:"post",
			data:"nes2="+es2,
			beforeSend:function(){
				$("#loadprosess").modal('show');
			},
			success:function(hasil){
				$("#f_es3").html(hasil);
				setTimeout(function(){
					$("#loadprosess").modal('hide');
				}, 500);
			}
		})
	})

	$("#f_es3").change(function(){
		$("#f_es4").html("<option value=''>------Pilih Salah Satu------</option>");
		$("#f_jabatan").val('');
		$("#f_jabatan_id").val('');				
		var es3 = $(this).val();
		$.ajax({
			url :"<?php echo site_url();?>/master/data_eselon4/formEselon4",
			type:"post",
			data:"nes3="+es3,
			beforeSend:function(){
				$("#loadprosess").modal('show');
			},
			success:function(hasil){
				$("#f_es4").html(hasil);
				setTimeout(function(){
					$("#loadprosess").modal('hide');
				}, 500);
			}
		})
	})	

	$("#f_es4").change(function(){
		$("#f_jabatan").val('');
		$("#f_jabatan_id").val('');
	})		

	$("#f_jabatan_btn").click(function(){
		var es1 = $("#f_es1").val();
		var es2 = $("#f_es2").val();
		var es3 = $("#f_es3").val();
		var es4 = $("#f_es4").val();
		$.ajax({
			url :"<?php echo site_url();?>/master/data_pegawai/cariJabatan",
			type:"post",
			data:"es1="+es1+"&es2="+es2+"&es3="+es3+"&es4="+es4,
			beforeSend:function(){
				$("#loadprosess").modal('show');
				$("#get-datatable").html('');				
			},			
			success:function(msg){
				$('#modal-datatable > div > div > div > div.modal-header > h3').html("Jabatan");				
				$("#get-datatable").html(msg);
				$("#loadprosess").modal('hide');								
				$("#modal-datatable").modal('show');				
			}
		})
	})

	$("#f_jabatan_akademik_btn").click(function(){
		var es1 = $("#f_es1").val();
		var es2 = $("#f_es2").val();
		var es3 = $("#f_es3").val();
		var es4 = $("#f_es4").val();
		$.ajax({
			url :"<?php echo site_url();?>/master/data_pegawai/cari_jabatan_struktur_akademik",
			type:"post",
			data:"es1="+es1+"&es2="+es2+"&es3="+es3+"&es4="+es4,
			beforeSend:function(){
				$("#loadprosess").modal('show');
				$("#get-datatable").html('');				
			},			
			success:function(msg){
				$('#modal-datatable > div > div > div > div.modal-header > h3').html("Jabatan");				
				$("#get-datatable").html(msg);
				$("#loadprosess").modal('hide');								
				$("#modal-datatable").modal('show');				
			}
		})
	})		

	$("#btn-trigger-controll").click(function(){
		var f_es1                 = $("#f_es1").val();
		var f_es2                 = $("#f_es2").val();
		var f_es3                 = $("#f_es3").val();
		var f_es4                 = $("#f_es4").val();
		var f_nip                 = $("#f_nip").val();
		var f_nama                = $("#f_nama").val();
		var f_jabatan             = $("#f_jabatan_id").val();
		var f_jabatan_akademik    = $("#f_jabatan_akademik_id").val();		
		var f_tmt                 = $("#f_tmt").val();
		var oid                   = $("#oid").val();
		var crud                  = $("#crud").val();
		if (f_es1.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Eselon 1 tidak boleh kosong."
			});
		}
		else if(f_nip <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data NIP tidak boleh kosong."
			});
		}
		else if(f_nama <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Nama tidak boleh kosong."
			});
		}
		else if(f_jabatan <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Jabatan tidak boleh kosong."
			});
		}
		else if(f_tmt <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data TMT tidak boleh kosong."
			});
		}
		else
		{
			data_sender = "";
			flag_status = 0;
			data_sender = {
					'crud'   			: crud,
					'oid'    			: oid,
					'es1'    			: f_es1,
					'es2'    			: f_es2,
					'es3'    			: f_es3,
					'es4'    			: f_es4,
					'nip'    			: f_nip,
					'nama'   			: f_nama,
					'jabatan' 			: f_jabatan,
					'jabatan_akademik'  : f_jabatan_akademik,
					'tmt'    			: f_tmt
				}				
			
			$.ajax({
				url :"<?php echo site_url()?>/master/data_pegawai/store",
				type:"post",
				data: { data_sender : data_sender},
				beforeSend:function(){
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
	})
});
</script>