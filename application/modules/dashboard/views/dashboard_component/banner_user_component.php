<div class="col-md-4 main-dashboard">
    <?php
        if ($who_is != 'eselon 1') {
            # code...
            $this->load->view('dashboard_component/potongan_component');        
        }
    ?>        
    <div class="col-md-12 box box-widget widget-user" style="padding:0px;">
        <div class="widget-user-header bg-aqua-active text-center" style="left:43%!important;">
            <?php
                $photo = $this->session->userdata('photo');
                if ($photo == '-') {
                    # code...
        ?>
                    <div style="padding: 0px!important;border:none;background: transparent;">
                        <img style="width: 120px;height: 120px;border-radius:50%;" src="<?php echo base_url() . 'assets/images/businessman1.jpg';?>">
                        <div class="dz-message" style="margin: 2em 0;">
                            <span> Klik atau Drop File Foto disini</span>
                        </div>
                    </div>
        <?php
                }
                else
                {
        ?>
                    <div style="padding: 0px!important;border:none;background: transparent;">
                        <img style="width: 120px;height: 120px;border-radius:50%;" src="<?php echo base_url() . 'public/images/pegawai/'.$photo;?>">
                        <div class="dz-message" style="margin: 2em 0;">
                            <span> Klik atau Drop File Foto disini</span>
                        </div>
                    </div>
        <?php                        
                }
            ?>
        </div>
        <div class="widget-user-header" style="height: 100%;max-height: 100%;">
            <h3 class="widget-user-username text-center" style="margin-top:10px;margin-bottom:15px;"><?php echo $nama_pegawai;?></h3>
            <h5 class="widget-user-desc text-center" style="margin-bottom: 15px;"><?php echo $nama_jabatan;?></h5>
            <a class="btn btn-info" href="<?php echo site_url();?>/transaksi/home"><i class="fa fa-plus"></i> Tambah Data Kinerja</a>            
            <a class="btn btn-md bg-purple color-palette pull-right" href="<?=site_url();?>user/info"><i class="fa fa-gear"></i> Data Pribadi</a>
        </div>        
    </div>
</div>