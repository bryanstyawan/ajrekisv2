<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.css'; ?>");</style>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<table class="table table-bordered table-striped table-view">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Jabatan</th>
            <th>Kelas Jabatan</th>
            <th>Tunjangan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
        if ($list != 0) {
            # code...
            for ($i=0; $i < count($list); $i++) { 
                # code...
    ?>
                <tr>
                    <td>
                        <?=$i+1;?>
                        <input type="hidden" id="oid_<?=$list[$i]->id;?>" value="<?=$list[$i]->id;?>">
                    </td>
                    <td>
                        <?=$list[$i]->nama_jabatan;?>
                        <input type="hidden" id="nama_jabatan_<?=$list[$i]->id;?>" value="<?=$list[$i]->nama_jabatan;?>">                        
                    </td>
                    <td>
                        <?=$list[$i]->posisi_class;?>
                        <input type="hidden" id="posisi_kelas_<?=$list[$i]->id;?>" value="<?=$list[$i]->posisi_class;?>">                        
                    </td>
                    <td><?=number_format($list[$i]->tunjangan,0);?></td>								
                    <td>
                        <a class="btn btn-success" onclick="get_data('<?php echo $list[$i]->id;?>')"><i class="fa fa-check"></i> Pilih<input type="hidden" value="<?=$i+1;?>"></a>
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
    });

function get_data(arg) 
{
    $("#id_jft").val('');
    $("#id_jfu").val(arg);            
    $("#jabatan").val($("#nama_jabatan_"+arg).val());
    $("#grade").val($("#posisi_kelas_"+arg).val());            
    $("#modal-detail-jfu").modal('hide');    
}    
</script>