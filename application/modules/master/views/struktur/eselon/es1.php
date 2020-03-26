<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.css'; ?>");</style>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<table id="htable-view-id" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Eselon I</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
        if ($list != array()) {
            # code...
            for ($i=0; $i < count($list); $i++) { 
                # code...
    ?>
                <tr>
                    <td>
                        <?=$i+1;?>
                        <input type="hidden" id="oid_<?=$list[$i]['id_es1'];?>" value="<?=$list[$i]['id_es1'];?>">
                    </td>
                    <td>
                        <?=$list[$i]['nama_eselon1'];?>
                    </td>
                    <td>
                        <a class="btn btn-success" onclick="get_data('<?php echo $list[$i]['id_es1'];?>','<?=$list[$i]['nama_eselon1'];?>')"><i class="fa fa-check"></i> Pilih</a>
                    </td>
                </tr>
    <?php
            }
        }
    ?>
    </tbody>
</table>
<script>
    $(document).ready(function(){
        $('#htable-view-id').dataTable().fnDestroy();                
        $("#htable-view-id").DataTable({
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

function get_data(arg,param) 
{
    $("#f_es1").html('');    
    $("#f_es1").html('<option selected value='+arg+'>'+param+'</option>');    
    $("#f_es2").html('');
    $("#f_es3").html('');
    $("#f_es4").html('');
    $("#f_atasan").html('');

    $("#id_jft").val('');
    $("#id_jfu").val('');            
    $("#jabatan").val('');
    $("#grade").val('');                    
    $("#modal-datatable").modal('hide');    
}

</script>