<div class="col-md-4">
    <div class="box box-widget widget-user">
        <div class="widget-user-header bg-aqua-active" style="height: 90%;max-height: 160px;">
            <h3 class="widget-user-username text-center" style="margin-bottom:10px;"><?php echo $nama_pegawai;?></h3>
            <h5 class="widget-user-desc text-center" style="height:75px;"><?php echo $nama_jabatan;?></h5>
        </div>
        <div class="widget-user-image text-center" style="left:43%!important;padding-top:10px;">
            <?php
                if($infoPegawai != '')
                {
            ?>
            <?php
                    if ($infoPegawai[0]->photo == '-') {
                        # code...
            ?>
                        <div class="dropzone" id="dropzone_image" style="padding: 0px!important;border:none;background: transparent;">
                            <img style="width: 160px;height: 160px;border-radius:50%;" src="<?php echo base_url() . 'assets/images/businessman1.jpg';?>">
                            <div class="dz-message" style="margin: 2em 0;">
                                <span> Klik atau Drop File Foto disini</span>
                            </div>
                        </div>
            <?php
                    }
                    else
                    {
                        if ($infoPegawai[0]->local == 1) {
                            # code...
            ?>
                        <div class="dropzone" id="dropzone_image" style="padding: 0px!important;border:none;background: transparent;">
                            <img style="width: 160px;height: 160px;border-radius:50%;" src="<?php echo base_url() . 'public/images/pegawai/'.$infoPegawai[0]->photo;?>">
                            <div class="dz-message" style="margin: 2em 0;">
                                <span> Klik atau Drop File Foto disini</span>
                            </div>
                        </div>
            <?php
                        }
                        else
                        {
            ?>
                        <div class="dropzone" id="dropzone_image" style="padding: 0px!important;border:none;background: transparent;">
                            <img style="width: 160px;height: 160px;border-radius:50%;" src="http://sikerja.kemendagri.go.id/images/demo/users/<?php echo $infoPegawai[0]->photo;?>">
                            <div class="dz-message" style="margin: 2em 0;">
                                <span> Klik atau Drop File Foto disini</span>
                            </div>
                        </div>
            <?php
                        }
                    }
                }
                else
                {
            ?>
                        <img style="width: 160px;height: 160px;border-radius:50%;" src="http://mandarinpalace.fi/wp-content/uploads/2015/11/businessman.jpg">
            <?php
                }
            ?>
        </div>
        <div style="height: 255px;max-height: 255px;">
            <div class="caption text-center" style="border-top: 1px solid rgba(0, 0, 0, 0.18);padding-top:140px;">
                <!-- <small><span id="ContentPlaceHolder1_lbl_typeuser">(Super Admin)</span></small> -->
                <center style="padding:10px 0px;">
                <a  id="" class="btn btn-info" href="<?php echo site_url();?>/transaksi/home">
                    <i class="fa fa-plus"></i> Tambah Data Kinerja
                </a>
                </center>
            </div>
            <span class="col-lg-6" style="padding-top:20px;">
                <a class="btn btn-md btn-success pull-left" id="btn-detail"><i class="fa fa-info"></i> Informasi Pegawai</a>
            </span>
            <span class="col-lg-6" style="padding-top:20px;">
                <a class="btn btn-md btn-warning pull-right" onclick="change_profile('profile')"><i class="fa fa-gear"></i> Ubah Data Pribadi</a>
            </span>
        </div>
    </div>
</div>