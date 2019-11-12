<?php
    if($member != array())
    {
?>
        <div class="col-md-4">    
            <div class="box box-info" style="height: 100%;">
                <div class="box-header with-border">
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped" id="table-member-component">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama Pegawai</th>
                            </tr>
                        </thead>
                        <tbody>
            <?php       
                    for ($i=0; $i < count($member); $i++) { 
                        # code...
                        $flag_counter = "text-yellow";
                        $flag_display = "display:none;";
                        $flag_icon    = 'fa-circle-o text-yellow';
                        // if ($member[$i]->flag_sudah_diperiksa != 0) {
                        //     // code...
                        //     if ($member[$i]->persentase_pemotongan != array()) {
                        //         # code...
                        //         if ($member[$i]->persentase_pemotongan == 5) {
                        //             # code...
                        //             $flag_counter = "text-red";
                        //             $flag_display = "display:'';";
                        //             $flag_icon    = 'fa-circle text-red';                                                                    
                        //         }
                        //         else
                        //         {
                        //             $flag_counter = "";
                        //             $flag_display = "display:'';";
                        //             $flag_icon    = 'fa-circle text-green';
                        //         }
                        //     }
                        // }                        
            ?>
                        <tr onclick="view_option('<?=$member[$i]->id_pegawai;?>','<?=$member[$i]->id_posisi;?>')" style="cursor: pointer;">
                            <td><i class="fa <?=$flag_icon;?> contact-name-list"></i></td>
                            <td>
                                <?=$member[$i]->nama_pegawai;?>
                            </td>
                        </tr>
            <?php
                    }
            ?>
                        </tbody>
                    </table>            
                </div>
            </div>
        </div>


        <div id="fom_questionnaires_pegawai" class="col-md-8">    

        </div>        


<?php
    }
?>

<script>
    $(document).ready(function(){             
        $("#table-member-component").DataTable({
            "oLanguage": {
                "sSearch": "<span><i class='fa fa-search'></i></span>",
                "sSearchPlaceholder" : "Ketik untuk mencari",
                "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "sZeroRecords": "Data tidak ditemukan"
            },
            "dom": "<'row'<'col-sm-6 pull-right'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-7'p>>",
            "bSort": false,
            "pageLength": 15   
            // "dom": '<"top"f>rt'
            // "dom": '<"top"fl>rt<"bottom"ip><"clear">'
        });
    });
</script>


<script type="text/javascript">
$(document).ready(function()
{
    $('.autonumber').autoNumeric('init');
});

function view_option(id_pegawai,posisi) {
    $.ajax({
        url :"<?php echo site_url()?>skp/questionnaires/questionnaires_pegawai/"+id_pegawai+"/"+posisi,
        type:"post",
        beforeSend:function(){
            $("#loadprosess").modal('show');
        },
        success:function(msg){
            $("#loadprosess").modal('hide');            
            $("#fom_questionnaires_pegawai").html(msg)
        },
        error:function(jqXHR,exception)
        {
            ajax_catch(jqXHR,exception);					
        }
    })    
}
</script>
