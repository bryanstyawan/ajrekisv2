			<?php
				if ($list != 0) {
					# code...
					if ($state == 'temp') {
						# code...
			?>
						<h2>Data ini bersifat sementara, mohon klik simpan untuk memproses lebih lanjut. Apabila ada data invalid maka data tersebut akan dihapus, mohon periksa kembali data yang ada dengan komponen Eselon 2</h2>
			<?php						
					}
				}
			?>
			<progress class="progress progress-striped progress-animated" id="prg_progress_bar" style="width: 1085px;display: none;" value="0" max="100">
				25%
			</progress>
		  	<div >
			  	<table id="example1" class="table table-bordered table-striped">
	      		<thead>
					<tr>
						<th>No</th>
						<th>ID</th>
						<th>NIP</th>
						<th>Nama</th>
						<th>NPWP</th>
						<th>GOl</th>
						<th>Kelas Jabatan</th>
						<th>Tunjangan Kinerja</th>
						<th>Tunjangan PLT/PLH</th>
						<th>Total Pengurangan</th>
						<th>Total</th>												
						<th>Status</th>
					</tr>
				</thead>
				<tbody id="table_content">
				<?php
					$x=1;
					if ($list != 0) {
						# code...
						// echo "<pre>";
						// print_r($list);
						// echo "</pre>";
						// die();						
						for ($i=0; $i < count($list); $i++) { 
							# code...
							$param_style = "style='background-color: #4CAF50;'";
							$text_style  = "Valid";
							if ($list[$i]->verify_nip_nama == 'invalid') {
								# code...
								$text_style = 'Invalid';
								$param_style = "style='background-color: #F44336;text-decoration: line-through;'";
							}
				?>
							<tr <?=$param_style;?>>
								<td><?=$x++;?></td>
								<td><?=$list[$i]->id;?></td>
								<td><?=$list[$i]->nip;?></td>
								<td><?=$list[$i]->nama;?></td>
								<td><?=$list[$i]->npwp;?></td>
								<td><?=$list[$i]->gol;?></td>
								<td><?=$list[$i]->kelas_jabatan;?></td>
								<td><?=number_format($list[$i]->tunjangan_kinerja,2);?></td>
								<td><?=number_format($list[$i]->tunjangan_plt_plh,2);?></td>
								<td><?=number_format($list[$i]->total_pengurangan,2);?></td>
								<td><?=number_format($list[$i]->total,2);?></td>
								<td><?=$text_style;?></td>
							</tr>
				<?php
						}
					}
				?>
				</tbody>				  	
			  	</table>
	  		</div>					
<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>

  $(function () {
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
	$("#loadprosess").modal('hide');	
	<?php
		if ($list != 0) {
	?>
		$("#btn_save_all").css({"display": ""});
		// $("#btn_delete_all_data").css({"display": ""});	
		// $("#btn_delete_invalid_data").css({"display": ""});		
	<?php
		}
	?>
  });
  </script>
