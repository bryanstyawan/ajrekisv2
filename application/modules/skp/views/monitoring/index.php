<?=$this->load->view('templates/common/preloader');?>
<section id="view_section">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">

				<div class="box-body">
					<div class="container-fluid">

						<?=$this->load->view('templates/filter/eselon',array('eselon1'=>$es1,'jenis_jabatan_stat'=>'off'));?>
							<div class="col-lg-6">

								<div class="col-lg-12">
									<h4>Tahun</h4>
									<div style="height: 34px;">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</span>
											<select class="form-control" name="select_tahun" id="select_tahun">
												<option value="">------------NONE------------</option>
												<?php
													$now=date('Y');
													$past=$now-5;
													for ($a=$past;$a<=$now+5;$a++)
													{
														if ($a == $now) {
															# code...
															echo "<option value='$a' selected>$a</option>";														
														}
														else
														{
															echo "<option value='$a'>$a</option>";
														}
													}
												?>											
											</select>
										</div>
									</div>								
								</div>															
							</div>
						</div>
						<div class="row col-xs-12" style="margin-top:10px;">
							<div class="box-title pull-left">	
								<!-- <button class="btn btn-block btn-primary" id="btn_sync"><i class="fa fa-refresh"></i> OLAH DATA TRANSAKSI SIKERJA</button>																	 -->
							</div>																							
							<div class="box-title pull-right">							
								<!-- <button class="btn btn-block btn-success" id="btn_export_excel"><i class="fa fa-print"></i> Export Excel</button>							 -->
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
				<div class="col-lg-6">
					<div class="col-lg-3">
						<label style="color: #000;font-weight: 400;font-size: 19px;">Nilai Baik</label>
						<div id="isies2">
							<div class="form-group">
								<div class="input-group">
									<input type="text" class="form-control" disabled="disabled" id="f_baik">									
								</div>
							</div>															
						</div>				
					</div>
					<div class="col-lg-3">
						<label style="color: #000;font-weight: 400;font-size: 19px;">Nilai Cukup</label>
						<div id="isies2">
							<div class="form-group">
								<div class="input-group">
									<input type="text" class="form-control" disabled="disabled" id="f_cukup">									
								</div>
							</div>															
						</div>				
					</div>
					<div class="col-lg-3">
						<label style="color: #000;font-weight: 400;font-size: 19px;">Nilai Kurang</label>
						<div id="isies2">
							<div class="form-group">
								<div class="input-group">
									<input type="text" class="form-control" disabled="disabled" id="f_kurang">									
								</div>
							</div>															
						</div>				
					</div>

					<div class="col-lg-3">
						<label style="color: #000;font-weight: 400;font-size: 19px;">Nilai Buruk</label>
						<div id="isies2">
							<div class="form-group">
								<div class="input-group">
									<input type="text" class="form-control" disabled="disabled" id="f_buruk">									
								</div>
							</div>															
						</div>				
					</div>																			
				</div>
			</div>
			<div class="box-body" id="isi">
				<div>
					<table class="table table-bordered table-striped table-view">
					<thead>
						<tr>
							<th>NIP</th>
							<th>Nama Pegawai</th>
							<th>Jabatan</th>	
                            <th>Sasaran Kerja Pegawai</th>
                            <th>Perilaku Kerja</th>
                            <th>Total</th>							
							<th>Status</th>
							<th>Tahun</th>                            
						</tr>
					</thead>
					<tbody id="table_content">

					</tbody>
					</table>
				</div>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>	
</section>

<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	$('#btn_export_excel').click(function() {
		var es1                  = $("#select_eselon_1").val();
		var es2                  = $("#select_eselon_2").val();	
		var es3                  = $("#select_eselon_3").val();
		var es4                  = $("#select_eselon_4").val();
		var select_bulan         = $("#select_bulan").val();
		var select_tahun         = $("#select_tahun").val();				


		es1 = (es1 == '') ? 0 : es1 ;
		es2 = (es2 == '') ? 0 : es2 ;
		es3 = (es3 == '') ? 0 : es3 ;
		es4 = (es4 == '') ? 0 : es4 ;	

		window.open('<?=base_url();?>laporan/export_kinerja_excel/'+es1+'/'+es2+'/'+es3+'/'+es4+'/'+select_bulan+'/'+select_tahun, "_blank");			
	})

	$('#btn_filter').click(function() {
		var select_eselon_1      = $("#select_eselon_1").val();
		var select_eselon_2      = $("#select_eselon_2").val();
		var select_eselon_3      = $("#select_eselon_3").val();
		var select_eselon_4      = $("#select_eselon_4").val();
		var select_tahun         = $("#select_tahun").val();				

		if (select_tahun.length <= 0) {
			Lobibox.notify('warning', {
				title: 'Perhatian',
				msg: 'Proses dihentikan, mohon pilih tahun'
			});                        			
		}
		else
		{
			var data_link = {
							'data_1': select_eselon_1,
							'data_2': select_eselon_2,
							'data_3': select_eselon_3,
							'data_4': select_eselon_4,
							'data_5': select_tahun
			}
			$.ajax({
				url :"<?php echo site_url()?>skp/skp_tahunan/filter_skp_tahunan",
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
		}		
	})

	$("#closeData").click(function(){
		$("#form_section").css({"display": "none"})
		$("#view_section").css({"display": ""})		
	})		
})
</script>