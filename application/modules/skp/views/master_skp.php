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
					<?=$this->load->view('templates/filter/eselon',array('eselon1'=>$es1,'jenis_jabatan_stat'=>'off'));?>
					
					<div class="row col-xs-6 pull-right">

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
<div class="col-xs-12">
  	<div class="box">
    	<div class="box-header">
    		<div class="box-body" id="isi">
				<div class="col-lg-12">
					<div class="col-lg-6">
						<span class="col-lg-12">Total Jabatan Strukral : <span id="span_struktural"></span></span>
						<span class="col-lg-12">Total SKP yang telah tersedia : <span id="span_counter_ready"></span></span>						
					</div>
					<div class="col-md-6">
						<!-- /.progress-group -->
						<div class="progress-group">
							<span class="progress-text">Progress SKP</span>
							<span class="progress-number"><b id="progress_bar_persentase">0</b>/100</span>

							<div class="progress sm">
							<div class="progress-bar progress-bar-red" id="progress_bar_style" style="width: %"></div>
							</div>
						</div>
					</div>					
				</div>
		    	<div id="halaman_header" class="pull-right" style="margin-top: 40px;margin-left: 76%;">
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
						  <th>Status</th>
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
				                    <select class="form-control"><option value="">Pilih Eselon 2</option></select>
								</div>
							</div>															
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Administrator (Eselon III)</label>						
						<div id="isies3">
							<div class="form-group">
								<div class="input-group">
				                    <span class="input-group-addon"></span>
				                    <select class="form-control"><option value="">Pilih Eselon 3</option></select>
								</div>
							</div>															
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Pengawas (Eselon IV)</label>												
						<div id="isies4">
							<div class="form-group">
								<div class="input-group">
				                    <span class="input-group-addon"></span>
				                    <select class="form-control"><option value="">Pilih Eselon 3</option></select>
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

						<label style="color: #000;font-weight: 400;font-size: 19px;">Jabatan</label>
						<div class="form-group">
							<div class="input-group">
			                    <span class="input-group-addon"></span>
			                    <input type="text" id="jabatan" name="jabatan" class="form-control" placeholder="jabatan">
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
<div class="modal modal-success fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="box-content">
		
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Jabatan</h4>
                  </div>
                <div class="modal-body" style="background-color: #fff!important;">
					<form id="editForm" name="editForm">
						<input type="hidden" id="oid" name="oid">
						<label style="color: #000;font-weight: 400;font-size: 19px;">Jenis Jabatan</label>
						<div class="form-group">
							<div class="input-group">
			                    <span class="input-group-addon"></span>
			                    <select name="nkat" id="nkat" class="form-control"><option value="">Jenis Jabatan</option>
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
			                    <select name="nes1" id="nes1" class="form-control"><option value="">Pilih Eselon 1</option>
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
				                    <select name="nes2" id="nes2" class="form-control"><option value="">Pilih Eselon 2</option></select>
								</div>
							</div>															
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Administrator (Eselon III)</label>						
						<div id="isies3">
							<div class="form-group">
								<div class="input-group">
				                    <span class="input-group-addon"></span>
				                    <select name="nes3" id="nes3" class="form-control"><option value="">Pilih Eselon 3</option></select>
								</div>
							</div>															
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Pengawas (Eselon IV)</label>												
						<div id="isies4">
							<div class="form-group">
								<div class="input-group">
				                    <span class="input-group-addon"></span>
				                    <select name="nes4" id="nes4" class="form-control"><option value="">Pilih Eselon 4</option></select>
								</div>
							</div>																						
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Atasan</label>												
						<div class="form-group">
							<div class="input-group">
			                    <span class="input-group-addon"></span>
			                    <select name="natasan" id="natasan" class="form-control"><option value=0>Pilih Atasan</option></select>
							</div>
						</div>


						<label style="color: #000;font-weight: 400;font-size: 19px;">Kelas Jabatan</label>												
						<div class="form-group">
							<div class="input-group">
			                    <span class="input-group-addon"></span>
			                    <select name="ngrade" id="ngrade" class="form-control">
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

						<label style="color: #000;font-weight: 400;font-size: 19px;">Jabatan</label>
						<div class="form-group">
							<div class="input-group">
			                    <span class="input-group-addon"></span>
			                    <input type="text" id="njabatan" name="njabatan" class="form-control" placeholder="jabatan">
							</div>
						</div>
					</form>
                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
					<input type="submit" class="btn btn-primary" value="Simpan" id="edit"/>
                    
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
<div class="modal modal-success fade" id="loadprosess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="box-content">
		
        <div class="modal-dialog">
            <div class="modal-content">
			    <div style="margin-top: 320px;">
			        <div class="loadme-rotateplane"></div>
			        <div class="loadme-mask"></div>
			    </div>            	
            </div>
        </div>
	</div>
</div>
</div>


<!---
***************************************************************************************************************
-->

<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>            
<script>

$(document).ready(function(){
	$('#btn_filter').click(function() {
		var select_eselon_1      = $("#select_eselon_1").val();
		var select_eselon_2      = $("#select_eselon_2").val();
		var select_eselon_3      = $("#select_eselon_3").val();
		var select_eselon_4      = $("#select_eselon_4").val();
		var data_link = {
						'data_1': select_eselon_1,
						'data_2': select_eselon_2,
						'data_3': select_eselon_3,
						'data_4': select_eselon_4
		}
		$.ajax({
			url :"<?php echo site_url()?>skp/master_skp/filter_data_master_skp",
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
	})

	$("#closeData").click(function(){
		$("#form_section").css({"display": "none"})
		$("#view_section").css({"display": ""})		
	})		
})

function show_skp(id) {
	// body...
	window.location.href = "<?php echo site_url();?>skp/master_skp/master_skp_posisi/"+id;	
}

function delete_all_urtug(id) {
	Lobibox.confirm({
		title   : "Konfirmasi",
		msg     : "Anda yakin akan menghapus semua uraian Tugas data ini ?",
		callback: function ($this, type) {
			if (type === 'yes'){			
				$.ajax({
					url :"<?php echo site_url();?>skp/master_skp/delete_master_skp_posisi/"+id,
					type:"post",
					beforeSend:function(){
						$("#editData").modal('hide');
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
</script>