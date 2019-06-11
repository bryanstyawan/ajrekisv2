<?php
    if($member != array())
    {
?>
<!-- <div class="col-md-5" style="height:445px;max-height: 550px;margin-bottom:25px;"> -->
    <!-- LINE CHART -->
    <a href="#" id="main_mailbox" class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Penilaian SKP Bulanan</span>
                <span class="info-box-number">90</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </a>
<div class="col-md-5">    
    <div class="box box-info" style="height: 100%;">
        <div class="box-header with-border">
            <h5>Penilaian SKP Bulanan Bawahan</h5>
        </div>
        <div class="box-body">
            <?php
            if ($this->session->userdata('sesPosisi') == 0) {
                # code...
            }
            else {
                # code...
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
            }
        ?>        
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>
<?php
    }
?>