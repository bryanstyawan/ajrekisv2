<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.css'; ?>");</style>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<table class="table table-bordered table-striped" id="table-view">
    <thead>
        <tr>
            <th>Nama Jabatan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach($jabatan->result() as $row){?>
		<tr>
			<td><?php echo $row->nama_posisi;?></td>
			<td>
				<a class="btn btn-success" onclick="get_data('<?php echo $row->nama_posisi;?>',<?php echo $row->id;?>)"><i class="fa fa-check"></i> Pilih</a>			
			</td>						
		</tr>
	<?php }?>
    </tbody>
</table>
<script>
    $(document).ready(function(){        
        $("#table-view").DataTable({
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
    });

function get_data(arg,id) 
{
    $("#f_jabatan").val(arg);
    $("#f_jabatan_id").val(id);
    $("#modal-detail-jabatan").modal('hide');    
}

</script>