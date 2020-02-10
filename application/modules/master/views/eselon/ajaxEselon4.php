<table class="table table-bordered table-striped table-view">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Eselon 1</th>
			<th>Nama Eselon 2</th>
			<th>Nama Eselon 3</th>
			<th>Nama Eselon 4</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
			for ($i=0; $i < count($list_final); $i++) { 
			# code...
	?>
			<tr>
				<td><?=$i+1;?></td>
				<td><?=$list_final[$i]['nama_eselon1'];?></td>
				<td><?=$list_final[$i]['nama_eselon2'];?></td>						
				<td><?=$list_final[$i]['nama_eselon3'];?></td>
				<td><?=$list_final[$i]['nama_eselon4'];?></td>																			
				<td>
					<button class="btn btn-primary btn-xs" onclick="edit('<?php echo $list_final[$i]['id_es4'];?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
			<?php
					if($list_final[$i]['counter_data'] == 0)
					{
			?>
					<button class="btn btn-danger btn-xs" onclick="del('<?php echo $list_final[$i]['id_es4'];?>',4)"><i class="fa fa-trash"></i></button>											
			<?php
					}
			?>
				</td>
			</tr>
	<?php
		}
	?>
	</tbody>
</table>
<script>
$(function () {
	$(".table-view").DataTable({
		"oLanguage": {
			"sSearch"    : "Pencarian :",
			"sInfoEmpty" : "",
			"sLengthMenu": "Show _MENU_ entries",
			"oPaginate"  : {
				"sFirst"   : "Halaman Pertama",       // This is the link to the first page
				"sPrevious": "Halaman Sebelumnya",    // This is the link to the previous page
				"sNext"    : "Halaman Selanjutnya",   // This is the link to the next page
				"sLast"    : "Halaman Terakhir"       // This is the link to the last page
			},
			"sSearchPlaceholder": "Ketik untuk mencari",
			"sLengthMenu"       : "Menampilkan &nbsp; _MENU_ &nbsp;Data",
			"sInfo"             : "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
			"sZeroRecords"      : "Data tidak ditemukan"
		},
		"dom": "<'row'<'col-sm-6'f><'col-sm-6'l>>" +
				"<'row'<'col-sm-5'i><'col-sm-7'p>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-5'i><'col-sm-7'p>>",
		"bSort": false

		// "dom": '<"top"f>rt'
		// "dom": '<"top"fl>rt<"bottom"ip><"clear">'
	});
});
</script>