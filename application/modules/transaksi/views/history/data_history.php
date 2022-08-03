<?=$this->load->view('templates/common/preloader');?>
<section id="view_section">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="col-lg-3">
					<div class="input-group">
						<label class="col-md-1 control-label">Bulan</label>
						<span class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</span>
						<select class="form-control" name="select_bulan" id="select_bulan">
							<?php
								for ($i=1; $i <= count($this->Globalrules->data_bulan()); $i++) { 
									# code...
									if ($i == date('m')) {
										# code...
							?>
									<option value="<?=$i;?>" selected><?=$this->Globalrules->data_bulan()[$i]['nama'];?></option>											
							<?php														
									}
									else
									{
							?>
									<option value="<?=$i;?>"><?=$this->Globalrules->data_bulan()[$i]['nama'];?></option>											
							<?php
									}
								}
							?>
						</select>
					</div>								
				</div>
				<div class="col-lg-3">
					<div class="input-group">
						<label class="col-md-1 control-label">Tahun</label>
						<span class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</span>
						<select class="form-control" name="select_tahun" id="select_tahun">
							<?php
								$now=date('Y')-2;
								for ($a=$now;$a<=$now+5;$a++)
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
				<div class="col-lg-2 pull-right">
					<button class="btn btn-block btn-primary" id="btn_filter"><i class="fa fa-search"></i> LIHAT DATA</button>	
				</div>		
			</div>
			<div class="box-body" id="isi">
				<div>
					<table class="table table-bordered table-striped table-view">
					<thead>
						<tr>	
							<th>Nomor</th>							
							<th>Tanggal Mulai</th>
							<th>Jam Mulai</th>
							<th>Tanggal Selesai</th>
							<th>Jam Selesai</th>
							<th>Nama Pekerjaan</th>
							<th>Status Pekerjaan</th>	
							<th>Menit Efektif</th>																						
						</tr>
					</thead>
					<tbody id="table_content">
					
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
	$('#btn_filter').click(function() {
		var select_bulan         = $("#select_bulan").val();
		var select_tahun         = $("#select_tahun").val();		
		var data_link = {
						'data_5': select_bulan,
						'data_6': select_tahun
		}

		if (select_bulan.length <= 0 || select_tahun.length <= 0) {
			Lobibox.notify('warning', {
				title: 'Perhatian',
				msg: 'Proses dihentikan, mohon pilih bulan dan tahun'
			});                        			
		}
		else
		{
			$.ajax({
			url :"<?php echo site_url()?>transaksi/filter_kinerja_sendiri",
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


			// $.ajax({
			// 	url :"<?php echo site_url()?>transaksi/filter_kinerja_sendiri",
			// 	type:"post",
			// 	data: { data_sender : data_link},
			// 	beforeSend:function(){
			// 		$("#loadprosess").modal('show');
			// 		$("#halaman_header").html("");
			// 		$("#halaman_footer").html("");
			// 		$('.table-view').dataTable().fnDestroy();
			// 		$(".table-view tbody tr").remove();
			// 		var newrec  = '<tr">' +
			// 							'<td colspan="5" class="text-center">Memuat Data</td>'
			// 					'</tr>';
			// 		$('.table-view tbody').append(newrec);
			// 	},			
			// 	success:function(msg){
					
			// 		$(".table-view tbody tr").remove();
			// 		$("#table_content").html(msg);
			// 		$(".table-view").DataTable({
			// 			"oLanguage": {
			// 				"sSearch": "Pencarian :",
			// 				"sSearchPlaceholder" : "Ketik untuk mencari",
			// 				"sLengthMenu": "Menampilkan data&nbsp; _MENU_ &nbsp;Data",
			// 				"sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
			// 				"sZeroRecords": "Data tidak ditemukan"
			// 			},
			// 			"dom": "<'row'<'col-sm-6'f><'col-sm-6'l>>" +
			// 					"<'row'<'col-sm-5'i><'col-sm-7'p>>" +
			// 					"<'row'<'col-sm-12'tr>>" +
			// 					"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			// 			"bSort": false
			// 			// "dom": '<"top"f>rt'
			// 			// "dom": '<"top"fl>rt<"bottom"ip><"clear">'
			// 		});

			// 		setTimeout(function(){
			// 			$("#loadprosess").modal('hide');
			// 		}, 500);
			// 	},
			// 	error:function(jqXHR,exception)
			// 	{
			// 		ajax_catch(jqXHR,exception);					
			// 	}
			// })	
		}	
	})
})
</script>