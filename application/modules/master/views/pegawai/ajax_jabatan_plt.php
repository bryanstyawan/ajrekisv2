<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.css'; ?>");</style>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<table class="table table-bordered table-striped" id="table-view">
    <thead>
        <tr>
            <th>Nama Jabatan</th>
            <th>Eselon I</th>
            <th>Eselon II</th>
            <th>Eselon III</th>
            <th>Eselon IV</th>                                    
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        foreach($jabatan->result() as $row)
        {
            $es1 = $this->Allcrud->getData('mr_eselon1',array('id_es1' =>$row->eselon1))->result_array();
            $es2 = $this->Allcrud->getData('mr_eselon2',array('id_es2' =>$row->eselon2))->result_array();
            $es3 = $this->Allcrud->getData('mr_eselon3',array('id_es3' =>$row->eselon3))->result_array();
            $es4 = $this->Allcrud->getData('mr_eselon4',array('id_es4' =>$row->eselon4))->result_array();                                    
    ?>
		<tr>
			<td><b><?php echo $row->nama_posisi;?></b></td>
            <td><?=($es1 != array()) ? $es1[0]['nama_eselon1'] : '' ;?></td>
            <td><?=($es2 != array()) ? $es2[0]['nama_eselon2'] : '' ;?></td>
            <td><?=($es3 != array()) ? $es3[0]['nama_eselon3'] : '' ;?></td>
            <td><?=($es4 != array()) ? $es4[0]['nama_eselon4'] : '' ;?></td>
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
    $("#f_jabatan_plt").val(arg);
    $("#f_jabatan_plt_id").val(id);
    $("#modal-datatable").modal('hide');    
}

</script>