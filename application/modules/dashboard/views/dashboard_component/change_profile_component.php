<div class="col-md-12" id="profile-dashboard">

    <div class="col-md-4">
        <div class="box box-widget widget-user">
            <div class="widget-user-header bg-aqua-active" style="height: 100%;max-height: 160px;">
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
                    <a id="" class="btn btn-info" href="<?php echo site_url();?>/transaksi/home">
                        <i class="fa fa-plus"></i> Tambah Data Kinerja
                    </a>
                    </center>
                </div>
                <span class="col-lg-6" style="padding-top:20px;">
                    <a class="btn btn-md btn-success pull-left" id="btn-detail"><i class="fa fa-info"></i> Informasi Pegawai</a>
                </span>
                <span class="col-lg-6" style="padding-top:20px;">
                    <a class="btn btn-md btn-warning pull-right" onclick="change_profile('main')"><i class="fa fa-toggle-left"></i> Kembali Ke Dashboard</a>
                </span>
            </div>
        </div>
    <!-- /.widget-user -->
    </div>

    <div class="col-md-8">
        <div class="container">
            <div class="box">
                <div class="box-body">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#profile">Profil</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#Kompetensi">
                                Kompetensi&nbsp;&nbsp;
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#history_golongan">
                                History Golongan/Pangkat&nbsp;&nbsp;
                            </a>
                        </li>                        
                    </ul>

                    <div class="tab-content">

                        <div id="profile" class="tab-pane fade in active">
                            <div class="col-lg-12">

                                <div class="box box-default">
                                    <div class="box-body">
                                        <div class="row">

                                            <div class="form-group col-md-6">
                                                <label style="color: #000;font-weight: 400;font-size: 19px;">Email</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    <input type="email" id="profile-email" name="profile-email" class="form-control" value="<?=$infoPegawai[0]->email;?>">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label style="color: #000;font-weight: 400;font-size: 19px;">Nomor Telepon</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    <input type="number" id="profile-telepon" name="profile-telepon" class="form-control" value="<?=$infoPegawai[0]->no_hp;?>">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group col-md-12">
                                                <label style="color: #000;font-weight: 400;font-size: 19px;">Alamat</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    <textarea class="form-control" id="profile-alamat" name="profile-alamat"><?=$infoPegawai[0]->alamat;?></textarea>
                                                </div>
                                            </div>                                            

                                            <div class="form-group col-md-12">
                                                <label style="color: #000;font-weight: 400;font-size: 19px;">Agama</label>
                                                <select class="form-control tour-step step1" name="profile-agama" id="profile-agama">
                                                    <option value="">Pilih Agama</option>
                                                    <?php
                                                        $selected = "";                                                    
                                                        if ($agama != '') {
                                                            # code...
                                                            for ($i=0; $i < count($agama); $i++) { 
                                                                # code...
                                                                if ($agama[$i]['nama_agama'] == $nama_agama) {
                                                                    # code...
                                                                    $selected = 'selected';
                                                                }
                                                                else {
                                                                    # code...
                                                                    $selected = '';
                                                                }
                                                    ?>
                                                                <option value="<?=$agama[$i]['id_agama'];?>" <?=$selected;?>><?=$agama[$i]['nama_agama'];?></option>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label style="color: #000;font-weight: 400;font-size: 19px;">Golongan/Pangkat</label>
                                                <select class="form-control tour-step step1" name="profile-golongan" id="profile-golongan">
                                                    <option value="">Pilih Golongan/Pangkat</option>
                                                    <?php
                                                        $selected = "";
                                                        if ($golongan) {
                                                            # code...
                                                            for ($i=0; $i < count($golongan); $i++) { 
                                                                # code...
                                                                if ($golongan[$i]['id'] == $infoPegawai[0]->golongan) {
                                                                    # code...
                                                                    $selected = 'selected';
                                                                }
                                                                else
                                                                {
                                                                    $selected = '';
                                                                }
                                                    ?>
                                                                <option value="<?=$golongan[$i]['id'];?>" <?=$selected;?>><?=$golongan[$i]['nama_pangkat'];?></option>                                                                
                                                    <?php
                                                            }
                                                        }
                                                    ?>

                                                </select>
                                            </div>                                            

                                            <div class="form-group col-md-6">
                                                <label style="color: #000;font-weight: 400;font-size: 19px;">TMT Golongan/Pangkat</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    <input type="text" id="profile-tmt-golongan" name="profile-tmt-golongan" class="form-control timerange" value="<?php if($infoPegawai[0]->tmt_golongan == 0 || $infoPegawai[0]->tmt_golongan == ''){echo '';}else echo date("d-m-y",strtotime($infoPegawai[0]->tmt_golongan));?>">
                                                </div>
                                            </div>                                            

                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <a class="btn btn-info pull-right" id="btn-save-profile">
                                            <i class="fa fa-save"></i> Simpan
                                        </a>                                        
                                    </div>
                                </div>


                            </div>
                        </div>                        
                        <div id="Kompetensi" class="tab-pane fade" style="padding-top: 15px;">
                            <div class="col-lg-12">
                                <div class="box box-default">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label style="color: #000;font-weight: 400;font-size: 19px;">Kompetensi</label>
                                                <input type="text" class="form-control" id="kompetensi_nama">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label style="color: #000;font-weight: 400;font-size: 19px;">Keterangan</label>
                                                <textarea class="form-control" id="kompetensi_keterangan"></textarea>
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <div class="row">
                                            <a class="btn btn-info pull-right" id="btn-save-kompetensi">
                                                <i class="fa fa-save"></i> Simpan
                                            </a>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="col-lg-12">
                                            <table class="table table-bordered table-striped table-view">
                                                <thead>
                                                    <tr>
                                                        <th>Kompetensi</th>
                                                        <th>Keterangan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table_content">
                                                    <?php
                                                        if ($info_kompetensi != 0) {
                                                            # code...
                                                            for ($i=0; $i < count($info_kompetensi); $i++) { 
                                                                # code...
                                                    ?>
                                                                <tr>
                                                                    <td><?=$info_kompetensi[$i]['kompetensi'];?></td>
                                                                    <td><?=$info_kompetensi[$i]['keterangan'];?></td>
                                                                    <td>
                                                                        <a class="btn btn-danger" onclick="delete_kompetensi('<?=$info_kompetensi[$i]['id'];?>')"><i class="fa fa-trash"></i></a>
                                                                    </td>                                                                                                                                        
                                                                </tr>

                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="history_golongan" class="tab-pane fade" style="padding-top: 15px;">
                            <div class="col-lg-12">
                                <div class="box box-default">
                                    <div class="box-body">
                                        <div class="col-lg-12">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Golongan</th>
                                                        <th>TMT Golongan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table_content">
                                                    <?php
                                                        if ($history_golongan != 0) {
                                                            # code...
                                                            for ($i=0; $i < count($history_golongan); $i++) { 
                                                                # code...
                                                    ?>
                                                                <tr>
                                                                    <td><?=$history_golongan[$i]->nama_pangkat;?></td>
                                                                    <td><?=$history_golongan[$i]->tmt;?></td>
                                                                    <td></td>                                                                                                                                        
                                                                </tr>

                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>

</div>