<?=$this->load->view('templates/common/preloader');?>
<?php
isset($es1);
isset($class_posisi);
?>
<div class="col-xs-12" id="section_filter">
	<div class="box">
    	<div class="box-header">

			<div class="box-body">
				<div class="container-fluid">
					
					<?=$this->load->view('templates/filter/eselon',array('eselon1'=>$es1,'jenis_jabatan_stat'=>'on'));?>

					<div class="row col-xs-6 pull-right">
						<div class="box-title pull-right">
							<button class="btn btn-block btn-primary" onclick="view_form(0,'adddata')"><i class="fa fa-plus-square"></i> TAMBAH JABATAN</button>
						</div>
					</div>

					<div class="row col-xs-12">
						<div class="box-title pull-right">
							<button class="btn btn-block btn-primary" id="btn_filter"><i class="fa fa-search"></i> FILTER DATA</button>											
						</div>											
					</div>					
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-xs-12" id="section_view">
	<div class="box">
    	<div class="box-header">
    		<div class="box-body" id="isi">
		    	</div>
		        <table class="table table-bordered table-striped table-view" style="font-size:12px;">
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
					</tbody>
			  	</table>
		    	<div id="halaman_footer" class="pull-right">
			  	</div>
		    </div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>
</div>

<div class="col-xs-12" id="section_detail_pegawai">
	<div class="box">
    	<div class="box-header">
			<h3>Detail Pegawai</h3>
			<div class="box-tools pull-right">
				<button class="btn btn-block btn-danger" onclick="view_form(0,'main')"><i class="fa fa-close"></i></button>
			</div>
		</div>
		<div class="box-body">
			<div class="container">
				<div class="row">					
					<div class="col-md-6">
						<div class="form-group">
							<label>Jabatan</label>
							<input type="text" class="form-control form-control-detail" id="f_jabatan" disabled="disabled">
						</div>
					</div>
				</div>					
			</div>
			<table id="table-pegawai" class="table table-bordered table-striped" style="font-size:12px;">
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

<div class="col-xs-12" id="section_formdata">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title" id="formdata-title"></h3>
			<div class="box-tools pull-right"><button class="btn btn-block btn-danger" onclick="view_form(0,'main')"><i class="fa fa-close"></i></button></div>				
		</div>
		<div class="box-body">
			<div class="row">
				<input type="hidden" id="crud">
				<input type="hidden" id="oid">			
				<div class="col-lg-12">
					<label style="color: #000;font-weight: 400;font-size: 19px;">Jenis Jabatan</label>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"></span>
							<select name="kat" id="kat" class="form-control form-control-detail"><option value="">Jenis Jabatan</option>
								<?php foreach($katpos->result() as $row){?>
									<option value="<?php echo $row->id;?>"><?php echo $row->nama_kat_posisi;?></option>
								<?php }?>
							</select>
						</div>
					</div>				
				</div>
				<div class="col-lg-6">
					<label style="color: #000;font-weight: 400;font-size: 19px;">Pimpinan Tinggi Madya (Eselon I)</label>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"></span>
							<select name="f_es1" id="f_es1" style="height: 45px;" class="form-control form-control-detail" disabled="disabled"><option value="">Pilih Eselon I</option>
								<?php foreach($es1->result() as $row){?>
									<option value="<?php echo $row->id_es1;?>"><?php echo $row->nama_eselon1;?></option>
								<?php }?>														
							</select>
							<a class="input-group-addon btn btn-primary btn-md" onclick="get_eselon(1)" id="btn-get-es1"><i class="fa fa-search"></i>&nbsp;</a>							
						</div>
					</div>

					<div id="view-id-es1" class="table-component">
						<table id="htable-view-id-es1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Eselon I</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>		
				</div>

				<div class="col-lg-6">
					<label style="color: #000;font-weight: 400;font-size: 19px;">Pimpinan Tinggi Pratama (Eselon II)</label>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"></span>
							<select class="form-control form-control-detail" style="height: 45px;" id="f_es2" disabled="disabled"><option value="">Pilih Eselon II</option></select>
							<a class="input-group-addon btn btn-primary btn-md" onclick="get_eselon(2)" id="btn-get-es2"><i class="fa fa-search"></i>&nbsp;</a>								
						</div>
					</div>	

					<div id="view-id-es2" class="table-component">
						<table id="htable-view-id-es2" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Eselon I</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>	
					</div>
							
				</div>

				<div class="col-lg-6">
					<label style="color: #000;font-weight: 400;font-size: 19px;">Administrator (Eselon III)</label>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"></span>
							<select class="form-control form-control-detail" style="height: 45px;" id="f_es3" disabled="disabled"><option value="">Pilih Eselon III</option></select>
							<a class="input-group-addon btn btn-primary btn-md" onclick="get_eselon(3)" id="btn-get-es3"><i class="fa fa-search"></i>&nbsp;</a>								
						</div>
					</div>

					<div id="view-id-es3" class="table-component">
						<table id="htable-view-id-es3" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Eselon I</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					
				</div>

				<div class="col-lg-6">
					<label style="color: #000;font-weight: 400;font-size: 19px;">Pengawas (Eselon IV)</label>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"></span>
							<select class="form-control form-control-detail" id="f_es4" style="height: 45px;" disabled="disabled"><option value="">Pilih Eselon IV</option></select>
							<a class="input-group-addon btn btn-primary btn-md" onclick="get_eselon(4)" id="btn-get-es4"><i class="fa fa-search"></i>&nbsp;</a>
						</div>
					</div>	

					<div id="view-id-es4" class="table-component">
						<table id="htable-view-id-es4" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Eselon I</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>	
					</div>
							
				</div>

				<div class="col-lg-12">
					<label style="color: #000;font-weight: 400;font-size: 19px;">Atasan</label>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"></span>
							<select name="f_atasan" id="f_atasan" class="form-control form-control-detail" style="height: 45px;" disabled="disabled"><option value=0>Pilih Atasan</option></select>
							<a class="input-group-addon btn btn-primary btn-md" onclick="get_atasan(null)"><i class="fa fa-search"></i>&nbsp;</a>
							<a class="input-group-addon btn btn-primary btn-md" onclick="get_atasan('all')"><i class="fa fa-search"></i>&nbsp; Cari Semuanya</a>														
						</div>
					</div>
					
					<div id="view-id-atasan" class="table-component">
						<table id="htable-view-id-atasan" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Pegawai</th>
									<th>Atasan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>		
					</div>
				</div>			
							
				<div class="col-lg-12">
					<label style="color: #000;font-weight: 400;font-size: 19px;">Jabatan</label>
					<div class="form-group">
						<div class="input-group" id="input-jabatan">
							<span class="input-group-addon"></span>
							<input type="text" id="jabatan" name="jabatan" class="form-control form-control-detail" placeholder="jabatan">
							<a class="input-group-addon btn btn-success" style="display:none;"><i class="fa fa-search-plus"></i></a>							
							<input type="hidden" id="id_jfu">
							<input type="hidden" id="id_jft">								
						</div>
					</div>
				</div>

				<div class="col-lg-12">
					<div id="container_kelas_posisi">
						<label style="color: #000;font-weight: 400;font-size: 19px;">Kelas Jabatan</label>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"></span>
								<select name="grade" id="grade" class="form-control form-control-detail">
									<option value=0>Pilih Kelas Jabatan</option>
									<?php
										for ($i=0; $i < count($class_posisi) ; $i++) {
											# code...
									?>
												<option value="<?=$class_posisi[$i]->id;?>"><?=$class_posisi[$i]->posisi_class;?></option>
									<?php
										}
									?>
								</select>
							</div>
						</div>					
					</div>				
				</div>												
			</div>

		</div><!-- /.box-body -->
		<div class="box-footer">
			<a class="btn btn-success pull-right" id="btn-trigger-controll"><i class="fa fa-save"></i>&nbsp; Simpan</a>
			<!-- <input type="submit" class="btn btn-primary" value="Simpan" id="add"/>			 -->
		</div>
	</div><!-- /.box -->	
</div>

<!---
***************************************************************************************************************
-->
<div class="example-modal">
    <div class="modal modal-success fade" id="modal-datatable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

<script>

function generateTableID(params) {
	$("#"+params).DataTable({
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
}

function sendDataToOpt(val,name,arg) {
	if (arg == 'es1') {
		$("#f_es1").html('');    
		$("#f_es1").html('<option selected value='+val+'>'+name+'</option>');		
	} 
	else if(arg == 'es2') {
		$("#f_es2").html('');    
		$("#f_es2").html('<option selected value='+val+'>'+name+'</option>');    		
	}
	else if(arg == 'es3') {
		$("#f_es3").html('');    
		$("#f_es3").html('<option selected value='+val+'>'+name+'</option>');    		
	}	
	else if(arg == 'es4') {
		$("#f_es4").html('');    
		$("#f_es4").html('<option selected value='+val+'>'+name+'</option>');    		
	}
	else if(arg == 'atasan') {
		$("#f_atasan").html('');    
		$("#f_atasan").html('<option selected value='+val+'>'+name+'</option>');    		
	}		

	$(".table-component").hide();	
}

function getData() 
{
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
		url :"<?php echo site_url()?>master/data_struktur/filter_struktur_org",
		type:"post",
		data: { data_sender : data_link},
		beforeSend:function(){
			$("#loadprosess").modal('show');
			$("#halaman_footer").html("");
			$('.table-view').dataTable().fnDestroy();
			$(".table-view tbody tr").remove();
			var newrec  = '<tr">' +
								'<td colspan="8" class="text-center">Memuat Data</td>'
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
}

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
		url :"<?php echo site_url()?>master/data_struktur/get_struktur_eselon1/",
		type:"post",
		data: { data_sender : data_sender},		
		beforeSend:function(){
			$("#loadprosess").modal('show');
		},
		success:function(msg){
			if (arg == 1) 
			{
				$('#htable-view-id-es1').dataTable().fnDestroy();
				$("#htable-view-id-es1 tbody tr").remove();
				var obj = jQuery.parseJSON (msg);				
				tr_insert = "";
				for (i=0 ;i<obj.list.length;i++) 
				{
					tr_insert += '<tr>'+
								'<td>'+
									(i+1)+
								'</td>'+
								'<td>'+
									obj.list[i].nama_eselon1+									
								'</td>'+
								'<td>'+
									'<a class="btn btn-success" onclick="sendDataToOpt('+obj.list[i].id_es1+','+"'"+obj.list[i].nama_eselon1+"'"+','+"'"+"es1"+"'"+')"><i class="fa fa-check"></i> Pilih</a>'+
								'</td>';
				}	
				$("#htable-view-id-es1 tbody").html(tr_insert);											
				generateTableID('htable-view-id-es1')				
				$('#view-id-es1').show();								
			} 
			else if(arg == 2) 
			{
				$('#htable-view-id-es2').dataTable().fnDestroy();
				$("#htable-view-id-es2 tbody tr").remove();
				var obj = jQuery.parseJSON (msg);				
				tr_insert = "";
				for (i=0 ;i<obj.list.length;i++) 
				{
					tr_insert += '<tr>'+
								'<td>'+
									(i+1)+
								'</td>'+
								'<td>'+
									obj.list[i].nama_eselon2+									
								'</td>'+
								'<td>'+
									'<a class="btn btn-success" onclick="sendDataToOpt('+obj.list[i].id_es2+','+"'"+obj.list[i].nama_eselon2+"'"+','+"'"+"es2"+"'"+')"><i class="fa fa-check"></i> Pilih</a>'+
								'</td>';
				}	
				$("#htable-view-id-es2 tbody").html(tr_insert);											
				generateTableID('htable-view-id-es2')				
				$('#view-id-es2').show();
			}
			else if(arg == 3) 
			{
				$('#htable-view-id-es3').dataTable().fnDestroy();
				$("#htable-view-id-es3 tbody tr").remove();
				var obj = jQuery.parseJSON (msg);				
				tr_insert = "";
				for (i=0 ;i<obj.list.length;i++) 
				{
					tr_insert += '<tr>'+
								'<td>'+
									(i+1)+
								'</td>'+
								'<td>'+
									obj.list[i].nama_eselon3+									
								'</td>'+
								'<td>'+
									'<a class="btn btn-success" onclick="sendDataToOpt('+obj.list[i].id_es3+','+"'"+obj.list[i].nama_eselon3+"'"+','+"'"+"es3"+"'"+')"><i class="fa fa-check"></i> Pilih</a>'+
								'</td>';
				}	
				$("#htable-view-id-es3 tbody").html(tr_insert);											
				generateTableID('htable-view-id-es3')				
				$('#view-id-es3').show();
			}
			else if(arg == 4) 
			{
				$('#htable-view-id-es4').dataTable().fnDestroy();
				$("#htable-view-id-es4 tbody tr").remove();
				var obj = jQuery.parseJSON (msg);				
				tr_insert = "";
				for (i=0 ;i<obj.list.length;i++) 
				{
					tr_insert += '<tr>'+
								'<td>'+
									(i+1)+
								'</td>'+
								'<td>'+
									obj.list[i].nama_eselon4+									
								'</td>'+
								'<td>'+
									'<a class="btn btn-success" onclick="sendDataToOpt('+obj.list[i].id_es4+','+"'"+obj.list[i].nama_eselon4+"'"+','+"'"+"es4"+"'"+')"><i class="fa fa-check"></i> Pilih</a>'+
								'</td>';
				}	
				$("#htable-view-id-es4 tbody").html(tr_insert);											
				generateTableID('htable-view-id-es4')				
				$('#view-id-es3').show();				
				$('#view-id-es4').show();
			}					
			// $('#modal-datatable > div > div > div > div.modal-header > h3').html("Eselon "+arg);													
			// $("#get-datatable").html(msg);					
			// $("#modal-datatable").modal('show');
			$("#loadprosess").modal('hide');							
		},
		error:function(jqXHR,exception)
		{
			ajax_catch(jqXHR,exception);					
		}
	})	

	console.table(data_sender);
}

function get_atasan(arg)
{
	var kat = $('#kat').val();
	var es1 = $('#f_es1').val();
	var es2 = $('#f_es2').val();
	var es3 = $('#f_es3').val();
	var es4 = $('#f_es4').val();			

	data_sender = {
			'es1' : $("#f_es1").val(),
			'es2' : $("#f_es2").val(),
			'es3' : $("#f_es3").val(),
			'es4' : $("#f_es4").val(),
			'kat' : $("#kat").val(),							
		}					

	if (kat.length <= 0 || es1.length <= 0)
	{

	}
	else
	{
		$.ajax({
			url :"<?php echo site_url()?>master/data_struktur/get_atasan/"+arg,
			type:"post",
			data: { data_sender : data_sender},		
			beforeSend:function(){
				$("#loadprosess").modal('show');
			},
			success:function(msg){
				$('#htable-view-id-atasan').dataTable().fnDestroy();
				$("#htable-view-id-atasan tbody tr").remove();
				var obj = jQuery.parseJSON (msg);				
				tr_insert = "";
				for (i=0 ;i<obj.list.length;i++) 
				{
					tr_insert += '<tr>'+
								'<td>'+
									(i+1)+
								'</td>'+
								'<td>'+
									obj.list[i].nama_pegawai+									
								'</td>'+
								'<td>'+
									obj.list[i].nama_posisi+									
								'</td>'+								
								'<td>'+
									'<a class="btn btn-success" onclick="sendDataToOpt('+obj.list[i].id+','+"'"+obj.list[i].nama_posisi+"'"+','+"'"+"atasan"+"'"+')"><i class="fa fa-check"></i> Pilih</a>'+
								'</td>';
				}	
				$("#htable-view-id-atasan tbody").html(tr_insert);											
				generateTableID('htable-view-id-atasan')				
				$('#view-id-atasan').show();				
				$("#loadprosess").modal('hide');							
			},
			error:function(jqXHR,exception)
			{
				ajax_catch(jqXHR,exception);					
			}
		})
	}	
}

$(document).ready(function()
{
	$("#section_detail_pegawai").hide();
	$("#section_formdata").hide();
	$(".table-component").hide();

	$("#kat").change(function(){
		$('#f_es1 option[value=""]').attr('selected', 'selected');
		$('#f_es2 option[value=""]').attr('selected', 'selected');
		$('#f_es3 option[value=""]').attr('selected', 'selected');
		$('#f_es4 option[value=""]').attr('selected', 'selected');
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
					$('#modal-datatable > div > div > div > div.modal-header > h3').html("Jabatan Fungsional Tertentu");													
					$("#get-datatable").html(msg);					
					$("#modal-datatable").modal('show');				
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
					$('#modal-datatable > div > div > div > div.modal-header > h3').html("Jabatan Fungsional Umum");								
					$("#get-datatable").html(msg);					
					$("#modal-datatable").modal('show');				
					$("#loadprosess").modal('hide');							
				},
				error:function(jqXHR,exception)
				{
					ajax_catch(jqXHR,exception);					
				}
			})		
		}
	})			

	$('#btn_filter').click(function() {
		getData();
	})

	$("#f_atasan").focus(function(){
		var kat = $('#kat').val();
		var es1 = $('#f_es1').val();

		if (kat.length <= 0 || es1.length <= 0)
		{

		}
		else
		{
			$.ajax({
				url :"<?php echo site_url()?>master/data_struktur/cari_atasan_baru",
				type:"post",
				data:$("#addForm").serialize(),
				success:function(msg){
					$("#atasan").html(msg);
				}
			})
		}
	})

	$("#btn-trigger-controll").click(function(){
		var es1     = $("#f_es1").val();
		var es2     = $("#f_es2").val();
		var es3     = $("#f_es3").val();
		var es4     = $("#f_es4").val();
		var grade   = $("#grade").val();
		var atasan  = $("#f_atasan").val();
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

function add_struktur() {
	var es1     = $("#f_es1").val();
	var es2     = $("#f_es2").val();
	var es3     = $("#f_es3").val();
	var es4     = $("#f_es4").val();
	var grade   = $("#grade").val();
	var atasan  = $("#f_atasan").val();
	var kat     = $("#kat").val();
	var jabatan = $("#jabatan").val();
	var id_jfu  = $("#id_jfu").val();
	var id_jft  = $("#id_jft").val();
	var crud    = $("#crud").val();
	var oid     = $("#oid").val();

	$.ajax({
		url :"<?php echo site_url()?>master/data_struktur/store",
		type:"post",
		data:"es1="+es1+"&es2="+es2+"&es3="+es3+"&es4="+es4+"&atasan="+atasan+"&kat="+kat+"&jabatan="+jabatan+"&grade="+grade+"&id_jfu="+id_jfu+"&id_jft="+id_jft+"&crud="+crud+"&oid="+oid,
		beforeSend:function(){
			$("#newData").modal('hide');
			$("#loadprosess").modal('show');
		},
		success:function(msg){
			var obj = jQuery.parseJSON (msg);
			ajax_status(obj,'no-refresh');
			view_form(0,'main')			
			getData();
		},
		error:function(jqXHR,exception)
		{
			ajax_catch(jqXHR,exception);					
		}
	})	
}

function view_form(id,arg) {
	if(arg == 'detail')
	{
		$.ajax({
			url :"<?php echo site_url()?>master/data_struktur/get_emp_from_org/"+id,
			type:"post",
			beforeSend:function(){
				$("#newData").modal('hide');
				$("#loadprosess").modal('show');
			},
			success:function(msg){
				// var obj = jQuery.parseJSON (msg);
				$("#loadprosess").modal('hide');				
				$('#table-pegawai tbody').html(msg);
			},
			error:function(jqXHR,exception)
			{
				ajax_catch(jqXHR,exception);					
			}
		})		
		$("#section_view").hide();
		$("#section_filter").hide();		
		$("#section_detail_pegawai").show();
	}
	else if(arg == 'adddata')
	{
		// $("#newData").modal('show');
		$(".form-control-detail").val('');		
		$("#formdata-title").html("Tambah Data");				
		$("#crud").val('insert');
		$("#section_formdata").show();
		$("#section_view").hide();
		$("#section_filter").hide();				
	}
	else if(arg == 'editdata')
	{
		$.getJSON('<?php echo site_url() ?>master/data_struktur/get_data_organisasi/'+id,
			function( response )
			{
				// console.log(response[0]['atasan']);
				// $("#newData").modal('show');
				$(".form-control-detail").val('');		
				$("#formdata-title").html("Ubah Data");				
				$("#crud").val('insert');
				$("#section_formdata").show();
				$("#section_view").hide();
				$("#section_filter").hide();								
				$("#crud").val('update');
				$("#oid").val(response['id']);			
				$("#f_es1").val(response['eselon1']);
				$("#f_es2").append('<option value="'+response['eselon2']+'" selected>'+response['nama_eselon2']+'</option>');
				$("#f_es3").append('<option value="'+response['eselon3']+'" selected>'+response['nama_eselon3']+'</option>');
				$("#f_es4").append('<option value="'+response['eselon4']+'" selected>'+response['nama_eselon4']+'</option>');
				$("#kat").val(response['kat_posisi']);
				$("#id_jfu").val(response['id_jfu']);
				$("#id_jft").val(response['id_jft']);								
				$("#f_atasan").append('<option value="'+response['atasan']+'" selected>'+response['posisi_atasan']+'</option>');

				$("#grade").append('<option value="'+response['posisi_class']+'" selected>'+response['id_posisi_class']+'</option>');
				if (response['kat_posisi'] == 1 || response['kat_posisi'] == 6) {
					$("#container_kelas_posisi").css('display','');
				}
				else
				{
					$("#container_kelas_posisi").css('display','none');					
				}
				$("#jabatan").val(response['nama_posisi']);
			}
		);		
	}
	else if(arg == 'deletedata')
	{
		Lobibox.confirm({
			title: "Konfirmasi",
			msg: "Anda yakin akan menghapus data ini ?",
			callback: function ($this, type) {
				if (type === 'yes'){
					$.ajax({
						url :"<?php echo site_url()?>/master/data_struktur/delStruktur/"+id,
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
	else if(arg == 'main')
	{
		$("#section_view").show();
		$("#section_filter").show();				
		$("#section_detail_pegawai").hide();	
		$("#section_formdata").hide();		
		$('#table-pegawai tbody').html('');
	}
}
</script>
