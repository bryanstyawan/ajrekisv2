<?php
    if($member != array())
    {
?>
<!-- <div class="col-md-5" style="height:445px;max-height: 550px;margin-bottom:25px;"> -->
    <!-- LINE CHART -->
<div class="col-md-5">    
    <div class="box box-info" style="height: 100%;">
        <div class="box-header with-border">
            <h5>Penilaian SKP Bulanan Bawahan</h5>
        </div>
        <div class="box-body">
            <?php
            $end_counter    = count($member);
            $median_counter = 0;
            for ($i=0; $i < $end_counter; $i++) { 
                # code...
                $median_counter += $i;
            }
            $median_counter = round($median_counter/$end_counter);
            ?>
            <ul class="nav nav-pills nav-stacked col-lg-6">
                <?php
                    $i = "";
                    for ($i=0; $i < $median_counter; $i++) {
                        // code...
                        $flag_counter = "text-red";
                        $flag_display = "display:none;";
                        $flag_icon    = 'fa-circle-o text-red';
                        if ($member[$i]->counter_belum_diperiksa != 0) {
                            // code...
                            $flag_counter = "";
                            $flag_display = "display:'';";
                            $flag_icon    = 'fa-circle text-green';                            
                        }
                ?>
                        <li style="cursor: pointer;<?=$flag_counter;?>" class="teamwork" id="li_member_<?=$i;?>" onclick="view_option('<?=$member[$i]->id;?>')">
                            <a class="contact-name">
                                <i class="fa <?=$flag_icon;?> contact-name-list"></i><?=$member[$i]->nama_pegawai;?>
                                <!-- <span class="pull-right" style="<?=$flag_display;?>"><i class="fa fa-check-circle-o" style="color: #8BC34A;"></i></span> -->
                            </a>
                            <input type="hidden" id="hdn_pegawai_<?=$i;?>" name="list_kandidat" value="<?=$member[$i]->nama_pegawai;?>"></input>
                        </li>
                    <?php
                    }
                ?>
            </ul>        
            <ul class="nav nav-pills nav-stacked col-lg-6">
                <?php
                    $i = "";
                    for ($i=$median_counter; $i < $end_counter; $i++) {
                        // code...
                        $flag_counter = "text-red text-red";
                        $flag_display = "display:none;";
                        $flag_icon    = 'fa-circle-o text-red';
                        if ($member[$i]->counter_belum_diperiksa != 0) {
                            // code...
                            $flag_counter = "";
                            $flag_display = "display:'';";
                            $flag_icon    = 'fa-circle text-green';                            
                        }
                ?>
                        <li style="cursor: pointer;<?=$flag_counter;?>" class="teamwork" id="li_member_<?=$i;?>" onclick="view_option('<?=$member[$i]->id;?>')">
                            <a class="contact-name">
                                <i class="fa <?=$flag_icon;?> contact-name-list"></i><?=$member[$i]->nama_pegawai;?>
                                <!-- <span class="pull-right" style="<?=$flag_display;?>"><i class="fa fa-check-circle-o" style="color: #8BC34A;"></i></span> -->
                            </a>
                            <input type="hidden" id="hdn_pegawai_<?=$i;?>" name="list_kandidat" value="<?=$member[$i]->nama_pegawai;?>"></input>
                        </li>
                    <?php
                    }
                ?>
            </ul>             
        </div>
        <?php
            if ($end_counter > 16) {
                # code...
        ?>
        <div class="box-footer">
            <div class="text-center">
                <a class="btn btn-success">Tampilkan Semua Anggota</a>
            </div>
        </div>                
        <?php
            }
        ?>        
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>
<?php
    }
?>