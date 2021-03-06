<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<?php
    if($member != array())
    {
?>
<div class="col-md-5" style="height:50px;max-height: 50px;margin-bottom:1px;">
    <!-- LINE CHART -->
    <div class="widget-user-header bg-white-active text-center">
        <div class="box-header with-border">
            <h1 class="box-title"> <font color="blue" size="3">TATA CARA REVIEW & PENYESUAIAN TARGET SKP<a href="<?php echo base_url(); ?>assets_home/slider/TATACARAREVIEW_PENYESUAIANTARGETSKP.pdf">&nbsp&nbsp&nbsp<u>download</a></font></h1>
        </div>
       
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>

<div id="list_nilai_anggota_skp" class="col-md-5">    
    <div class="box box-info" style="height: 100%;">
        <div class="box-header with-border">
            <h5>Penilaian SKP Bulanan Bawahan</h5>
        </div>
        <div class="box-body">
            <?php
                if ($id_posisi == 0) {
                    # code...
                }
                else {
                    # code...
            ?>
                    <table class="table table-bordered table-striped" id="table-member-component">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama Pegawai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
            <?php       
                    for ($i=0; $i < count($member); $i++) { 
                        # code...
                        $flag_counter = "text-yellow";
                        $flag_display = "display:none;";
                        $flag_icon    = 'fa-circle-o text-yellow';
                        if ($member[$i]->flag_sudah_diperiksa != 0) {
                            // code...
                            if ($member[$i]->persentase_pemotongan != array()) {
                                # code...
                                if ($member[$i]->persentase_pemotongan == 5) {
                                    # code...
                                    $flag_counter = "text-red";
                                    $flag_display = "display:'';";
                                    $flag_icon    = 'fa-circle text-red';                                                                    
                                }
                                else
                                {
                                    $flag_counter = "";
                                    $flag_display = "display:'';";
                                    $flag_icon    = 'fa-circle text-green';
                                }
                            }
                        }                        
            ?>
                        <tr>
                            <td><i class="fa <?=$flag_icon;?> contact-name-list"></i></td>
                            <td>
                                <?=$member[$i]->nama_pegawai;?>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-md" onclick="view_option('<?=$member[$i]->id_pegawai;?>')">Detail</a>
                                <a class="btn btn-success" onclick="approve_good_kinerja('yes','<?=$member[$i]->id_pegawai;?>','<?=$member[$i]->id_posisi;?>')">Ya</a>
                                <a class="btn btn-danger" onclick="approve_good_kinerja('no','<?=$member[$i]->id_pegawai;?>','<?=$member[$i]->id_posisi;?>')">Tidak</a>                                
                            </td>
                        </tr>
            <?php
                    }
            ?>
                        </tbody>
                    </table>            
            <?php
                }
            ?>        
        </div>
    </div>
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
            "pageLength": 4   
            // "dom": '<"top"f>rt'
            // "dom": '<"top"fl>rt<"bottom"ip><"clear">'
        });
    });
</script>
