<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.css'; ?>");</style>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<table class="table table-bordered table-striped" id="table-view">
    <thead>
        <tr>
            <th>Nama Jabatan</th>
            <th>Komponen</th>
            <th>Atasan</th>            
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if ($jabatan != array()) 
            {
                # code...
                for ($i=0; $i < count($jabatan); $i++) { 
                    # code...
        ?>
            <tr>
                <td><?=$jabatan[$i]['nama_posisi'];?></td>
                <td>
                    <!-- <span class="label label-danger"><?=$jabatan[$i]['id_eselon4'];?></span> -->
                    <?=$jabatan[$i]['nama_eselon4'];?>&nbsp;
                    <!-- <span class="label label-danger"><?=$jabatan[$i]['id_eselon3'];?></span> -->
                    <?=$jabatan[$i]['nama_eselon3'];?>&nbsp;
                    <!-- <span class="label label-danger"><?=$jabatan[$i]['id_eselon2'];?></span> -->
                    <?=$jabatan[$i]['nama_eselon2'];?>&nbsp;
                    <!-- <span class="label label-danger"><?=$jabatan[$i]['id_eselon1'];?></span> -->
                    <?=$jabatan[$i]['nama_eselon1'];?>
                </td> 
                <td><?=$jabatan[$i]['jabatan_atasan'];?>&nbsp;(<b><?=$jabatan[$i]['nama_atasan'];?></b>)</td>               
                <td>
                    <a class="btn btn-success" onclick="get_data('<?=$jabatan[$i]['nama_posisi'];?>',<?=$jabatan[$i]['id'];?>)"><i class="fa fa-check"></i> Pilih</a>			
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
    $("#modal-datatable").modal('hide');    
}

</script>