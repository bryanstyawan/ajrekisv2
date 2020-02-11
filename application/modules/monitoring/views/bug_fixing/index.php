<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/tabs-checked/css/style_tabs.css'; ?>");</style>
<div id="viewdata">
	<div class="col-xs-3">
		<div class="box box-solid" style="">
			<div class="box-header with-border">
				<h3 class="box-title">Prioritas</h3>
			</div>
			<div class="box-body no-padding" style="display: block;">
				<ul class="nav nav-pills nav-stacked contact-id">
					<?php
						if ($priority != array()) {
							# code...
							for ($i=0; $i < count($priority); $i++) { 
								# code...
					?>
					<li style="cursor: pointer;" class="teamwork" id="li_kandidat_0" onclick="show_data('priority','<?=$priority[$i]['id'];?>','<?=$priority[$i]['nama'];?>')">
						<a class="contact-name">
							<i class="fa fa-circle-o text-red contact-name-list"></i>                            
							<?=$priority[$i]['nama'];?>
							<sup>
								<span class="notif-count pull-right">
								<span><?=$priority[$i]['counter'];?></span>
								</span>
							</sup>
						</a>
					</li>
					<?php
							}
						}
					?>
				</ul>
			</div>
		</div>

		<div class="box box-solid" style="">
			<div class="box-header with-border">
				<h3 class="box-title">Status</h3>
			</div>
			<div class="box-body no-padding" style="display: block;">
				<ul class="nav nav-pills nav-stacked contact-id">
					<?php
						if ($status != array()) {
							# code...
							for ($i=0; $i < count($status); $i++) { 
								# code...
					?>
					<li style="cursor: pointer;" class="teamwork" id="li_kandidat_0" onclick="show_data('status','<?=$status[$i]['id'];?>','<?=$status[$i]['nama'];?>')">
						<a class="contact-name">
							<i class="fa fa-circle-o text-red contact-name-list"></i>                            
							<?=$status[$i]['nama'];?>
							<sup>
								<span class="notif-count pull-right">
								<span><?=$status[$i]['counter'];?></span>
								</span>
							</sup>
						</a>
					</li>
					<?php
							}
						}
					?>
				</ul>
			</div>
		</div>		
	</div>
	<div class="col-xs-9" >
		<div class="box">
			<div class="box-header">
				<h3 class="pull-left" id="subtitle-module"></h3>
				<h3 class="box-title pull-right"><button class="btn btn-block btn-primary" id="addData"><i class="fa fa-plus-square"></i> Request</button></h3>
				<div class="box-tools">
				</div>
			</div>
			<div class="box-body" id="isi">
				<table class="table table-bordered table-striped table-view">
					<thead>
						<tr>
						<th>No</th>
						<th>Nama Pegawai</th>
						<th>NIP</th>
						<th>Judul</th>
						<th>Isi</th>
						<th>Status</th>
						<th>Tanggal</th>
						<th>Aksi</th>
						</tr>
					</thead>
					<tbody id="table_content">
					<?php
						if ($list != 0) {
							# code...
							for ($i=0; $i < count($list); $i++) { 
								# code...
					?>
								<tr>
									<td><?=$i+1;?></td>
									<td><?=$list[$i]->nama_pegawai;?></td>
									<td><?=$list[$i]->nip;?></td>																
									<td><?=$list[$i]->judul;?></td>
									<td><?=$list[$i]->isi;?></td>
									<td><?=$list[$i]->status_report;?></td>
									<td><?=$list[$i]->audit_time;?></td>									
									<td>
							<?php
										if ($list[$i]->file != NULL) {
											# code...
							?>
												<a class="btn btn-success col-lg-12" style="margin:10px;" target="_blank" href="<?php echo site_url();?>public/bug_report/<?=date('Y-m',strtotime($list[$i]->audit_time));?>/<?=$list[$i]->file;?>">
													<i class="fa fa-download"></i>
													Download File
												</a>									
							<?php
										}					
										switch ($list[$i]->status) {
											case '0':
												# code...
												if ($this->session->userdata('sesNip') != '999') {
													# code...
												}
												else
												{
					?>
													<a class="btn btn-primary col-lg-12" style="margin:10px;" onclick="change_status('<?=$list[$i]->id;?>','2','none')">
														<i class="fa fa-edit"></i>
														Selesai dikerjakan
													</a>					
					<?php
												}												
												break;
											case '1':
												# code...
												if ($this->session->userdata('sesNip') != '999') {
													# code...
												}
												else
												{
					?>
													<a class="btn btn-primary col-lg-12" style="margin:10px;" onclick="change_status('<?=$list[$i]->id;?>','2','none')">
														<i class="fa fa-edit"></i>
														Selesai dikerjakan
													</a>					
					<?php
												}																								
												break;
											case '2':
												# code...
												if ($this->session->userdata('sesNip') != '999') {
													# code...
					?>
													<a class="btn btn-warning col-lg-12" style="margin:10px;" onclick="change_status('<?=$list[$i]->id;?>','1','note')">
														<i class="fa fa-edit"></i>
														Perlu revisi
													</a>					

													<a class="btn btn-success col-lg-12" style="margin:10px;" onclick="change_status('<?=$list[$i]->id;?>','3','none')">
														<i class="fa fa-edit"></i>
														Telah selesai
													</a>												
					<?php
												}																								
												break;
											default:
												# code...
												break;
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
	</div>
</div>

<div class="col-lg-12" id="formdata" style="display:none;">

	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title" id="formdata-title"></h3>
			<div class="box-tools pull-right"><button class="btn btn-block btn-danger" id="closeData"><i class="fa fa-close"></i></button></div>				
		</div>
		<div class="box-body">
			<div class="row">
				<input type="hidden" id="oid">
				<input type="hidden" id="crud">					
			</div>		
			<div class="form-group">
				<input class="form-control" placeholder="Judul:" id="f_judul"/>
			</div>
			<div class="form-group">
				<textarea id="f_isi" class="form-control" style="height: 300px"></textarea>
			</div>

			<hr>
			<div class="form-group">
				<div class="input-group">
					<input type="file" id="f_attachment" name="f_attachment" class="form-control">
				</div>
				<p class="help-block">*Optional</p>								
				<p class="help-block">pdf|docx|doc|jpg|jpeg|png|ppt|pptx|xls|xlsx</p>
			</div>			
			
		</div><!-- /.box-body -->
		<div class="box-footer">
			<div class="pull-right">
				<button class="btn btn-primary" id="btn-trigger-controll"><i class="fa fa-envelope-o"></i> Kirim</button>
			</div>
		</div><!-- /.box-footer -->
	</div><!-- /. box -->
</div>


<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/	dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	$("#addData").click(function()
	{
		$(".form-control").val('');
		$("#formdata").css({"display": ""})
		$("#viewdata").css({"display": "none"})
		$("#formdata-title").html("Request Perbaikan Bug & Fitur");		
		$("#crud").val('insert');
	})

	$("#closeData").click(function(){
		$("#formdata").css({"display": "none"})
		$("#viewdata").css({"display": ""})		
	})	

	$("#btn-trigger-controll").click(function(){
		var oid               = $("#oid").val();
		var crud              = $("#crud").val();
		var f_judul           = $("#f_judul").val();
		var f_isi             = $("#f_isi").val();		
        var f_attachment      = $('#f_attachment').prop('files')[0];		
		var data_sender       = "";
		if (crud == 'insert') {
			if (f_attachment == undefined) {
				data_sender = {
					'oid' 		: oid,
					'crud' 		: 'insert',
					'f_judul' 	: f_judul,
					'f_isi'		: f_isi, 
				}		
				$.ajax({
					url : "<?php echo site_url()?>monitoring/bug_fixing/store",
					type: "post",
					data: {data_sender:data_sender},
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
			} else {
				res_oid = upload_data('insert')								
			}			
		} else {
			
		}

	})
})

function edit(id)
{
	$.ajax({
		url :"<?php echo site_url();?>master/data_eselon1/get_data_eselon/"+id,
		type:"post",
		beforeSend:function(){
			$("#loadprosess").modal('show');
		},
		success:function(msg){
			var obj = jQuery.parseJSON (msg);
			$(".form-control-detail").val('');
			$("#formdata").css({"display": ""})
			$("#viewdata").css({"display": "none"})
			$("#formdata > div > div > div.box-header > h3").html("Ubah Data");		
			$("#crud").val('update');
			$("#oid").val(obj.id_es1);
			$("#f_es1").val(obj.nama_eselon1);				
			$("#loadprosess").modal('hide');				
		},
		error:function(jqXHR,exception)
		{
			ajax_catch(jqXHR,exception);					
		}
	})
}

function change_status(id,status,arg) {
	if (arg == 'none') {
		data_sender = {
			'oid' 		: id,
			'crud' 		: 'change_status',				
			'status'	: status,
		}			

		$.ajax({
			url : "<?php echo site_url()?>monitoring/bug_fixing/store",
			type: "post",
			data: {data_sender:data_sender},
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

function upload_data(crud) {
	var form_data = new FormData();
	res_id_x = 0;
	var f_file    = $("#f_attachment").prop('files')[0];			
	if (f_file != undefined) {
		form_data.append('file', f_file);			
		$.ajax({
			url :"<?php echo site_url();?>monitoring/bug_fixing/upload_data/"+crud, // point to server-side PHP script
			// dataType: 'json',  // what to expect back from the PHP script, if anything
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'post',
			// xhr : function() {
			// 	var xhr = new window.XMLHttpRequest();
			// 	xhr.upload.addEventListener('progressBar', function(e){
			// 		if(e.lengthComputable){								
			// 			var percent = Math.round((e.loaded / e.total) * 100);
			// 			$('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
			// 		}
			// 	});
			// 	return xhr;
			// },					
			beforeSend:function(){
				$("#loadprosess").modal('show');
			},
			success: function(msg){
				var obj = jQuery.parseJSON (msg);
				ajax_status(obj,'no-refresh');				
				data_sender = {
					'oid' 		: obj.id,
					'crud' 		: 'insert_upload',
					'f_judul' 	: $("#f_judul").val(),
					'f_isi'		: $("#f_isi").val()
				}			

				$.ajax({
					url : "<?php echo site_url()?>monitoring/bug_fixing/store",
					type: "post",
					data: {data_sender:data_sender},
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
			},
			error:function(jqXHR,exception)
			{
				ajax_catch(jqXHR,exception);					
			}
		});				
	}

	return res_id_x;
}

function show_data(arg,id,remark) {
	$.ajax({
		url : "<?php echo site_url()?>monitoring/bug_fixing/show/"+arg+"/"+id,
		type: "post",
		beforeSend:function(){
			$("#loadprosess").modal('show');
			$('.table-view').dataTable().fnDestroy();
			$(".table-view tbody tr").remove();
			var newrec  = '<tr">' +
								'<td colspan="5" class="text-center">Memuat Data</td>'
						'</tr>';
			$('.table-view tbody').append(newrec);			
		},
		success:function(msg){
			textHeader = '';
			if (arg == 'priority') {
				textHeader = 'Prioritas ' + remark; 
			}
			else if(arg == 'status')
			{
				textHeader = 'Status ' + remark; 
			}
			$("#subtitle-module").html(textHeader);
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
</script>
