<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/dropzone-work/dropzone.min.css'; ?>");</style>
<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/dropzone-work/basic.min.css'; ?>");</style>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/dropzone-work/jquery.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/dropzone-work/dropzone.min.js"></script>
<div class="col-md-12" id="profile-dashboard">

    <!-- Profile Picture
    <div class="col-md-2">
        <div class="box box-widget widget-user" style="height:230px;width:205px;padding-left:8px;padding-top:7px;">
            <?php
                if($infoPegawai != '')
                {
            ?>
            <?php
                    if ($infoPegawai[0]->photo == '-') {
                        # code...
            ?>
                    <div class="dropzone" id="dropzone_image" style="padding: 0px!important;border:none;background: transparent;">
                        <img style="width: 190px; height: 215px;" src="<?php echo base_url() . 'assets/images/businessman1.jpg';?>">
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
                        <img style="width: 190px; height: 215px;" src="<?php echo base_url() . 'public/images/pegawai/'.$infoPegawai[0]->photo;?>">
                        <div class="dz-message" style="margin: 2em 0;">
                            <span> Klik atau Drop File Foto disini</span>
                        </div>
                    </div>
                    
            <?php
                    }
                }
                else
                {
            ?>
                    <img style="width: 190px; height: 215px;" src="http://mandarinpalace.fi/wp-content/uploads/2015/11/businessman.jpg">
            <?php
                }
            ?>
        </div>
    </div> -->

    <section id="view_section">
        <div class="col-md-12" id="view_section">
            <!-- <div class="container"> -->
                <div class="box">
                    <div class="box-body">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#Biodata">
                                    Biodata
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#li_pangkat">
                                    Pangkat&nbsp;&nbsp;
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#li_pendidikan_umum">
                                    Pendidikan Umum&nbsp;&nbsp;
                                </a>
                            </li>   
                            <li>
                                <a data-toggle="tab" href="#li_jabatan">
                                    Jabatan&nbsp;&nbsp;
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#li_diklat_struktural">
                                    Diklat Struktural&nbsp;&nbsp;
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#li_diklat_fungsional">
                                    Diklat Fungsional&nbsp;&nbsp;
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#li_teknis">
                                    Diklat Teknis&nbsp;&nbsp;
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#li_konferensi">
                                    Konferensi&nbsp;&nbsp;
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#li_KaryaTulis">
                                    Karya Tulis&nbsp;&nbsp;
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#li_organisasi">
                                    Organisasi&nbsp;&nbsp;
                                </a>
                            </li>                                                                                                                                                                        
                            <li>
                                <a data-toggle="tab" href="#li_penghargaan">
                                    Penghargaan&nbsp;&nbsp;
                                </a>
                            </li>                            
                        </ul>

                        <div class="tab-content">

                            <!-- Tab Biodata -->
                            <div id="Biodata" class="tab-pane fade in active">
                                <div class="col-lg-12">
                                    <div class="box box-default">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="form-group col-md-10">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <label class="widget-user-desc" style="margin-top:5px;">NIP</label>                                                        
                                                            <span class="pull-right">:</span>                                                            
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <span id="lbl_nip"></span><br>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <label class="widget-user-desc" style="margin-top:5px;">Nama</label>                                                        
                                                            <span class="pull-right">:</span>                                                            
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <span id="lbl_nama"></span><br>
                                                        </div>
                                                    </div>                                                    

                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <label class="widget-user-desc" style="margin-top:5px;">Tempat, Tanggal Lahir</label>                                                        
                                                            <span class="pull-right">:</span>                                                            
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <span id="lbl_ttl"></span><br>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <label class="widget-user-desc" style="margin-top:5px;">Agama</label>                                                        
                                                            <span class="pull-right">:</span>                                                            
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <span id="lbl_agama"></span><br>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <label class="widget-user-desc" style="margin-top:5px;">Alamat</label>                                                        
                                                            <span class="pull-right">:</span>                                                            
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <span id="lbl_alamat"></span><br>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <label class="widget-user-desc" style="margin-top:5px;">Jabatan</label>                                                        
                                                            <span class="pull-right">:</span>                                                            
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <span id="lbl_jabatan"></span><br>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <label class="widget-user-desc" style="margin-top:5px;">TMT Jabatan</label>                                                        
                                                            <span class="pull-right">:</span>                                                            
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <span id="lbl_tmt_jabatan"></span><br>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <label class="widget-user-desc" style="margin-top:5px;">Pangkat</label>                                                        
                                                            <span class="pull-right">:</span>                                                            
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <span id="lbl_pangkat"></span><br>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <label class="widget-user-desc" style="margin-top:5px;">TMT Pangkat</label>                                                        
                                                            <span class="pull-right">:</span>                                                            
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <span id="lbl_tmt_pangkat"></span><br>
                                                        </div>
                                                    </div>
                                                          
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <label class="widget-user-desc" style="margin-top:5px;">No Hp</label>                                                        
                                                            <span class="pull-right">:</span>                                                            
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <span id="lbl_no_hp"></span><br>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <label class="widget-user-desc" style="margin-top:5px;">E-mail</label>                                                        
                                                            <span class="pull-right">:</span>                                                            
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <span id="lbl_email"></span><br>
                                                        </div>
                                                    </div>                                                  

                                                    <!-- 
                                                    <label class="widget-user-desc" style="margin-top:5px;">Jenis Kelamin</label>
                                                    <span id="lbl_jenis_kelamin" style="margin-left:57px;">: </span><br> 
                                                    -->
                                                </div>
                                                <!-- Profile Picture -->
                                                <div class="col-md-2">
                                                    <!-- <div class="box box-widget widget-user" style="height:230px;width:205px;padding-left:8px;padding-top:7px;"> -->
                                                    <div class="box box-widget widget-user">
                                                        <?php
                                                            if($infoPegawai != '')
                                                            {
                                                        ?>
                                                        <?php
                                                                if ($infoPegawai[0]->photo == '-') {
                                                                    # code...
                                                        ?>
                                                                <div class="dropzone" id="dropzone_image" style="padding: 0px!important;border:none;background: transparent;">
                                                                    <img style="width: 190px; height: 190px;" src="<?php echo base_url() . 'assets/images/businessman1.jpg';?>">
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
                                                                    <img style="width: 190px; height: 190px;" src="<?php echo base_url() . 'public/images/pegawai/'.$infoPegawai[0]->photo;?>">
                                                                    <div class="dz-message" style="margin: 2em 0;">
                                                                        <span> Klik atau Drop File Foto disini</span>
                                                                    </div>
                                                                </div>
                                                                
                                                        <?php
                                                                }
                                                            }
                                                            else
                                                            {
                                                        ?>
                                                                <img style="width: 190px; height: 190px;" src="http://mandarinpalace.fi/wp-content/uploads/2015/11/businessman.jpg">
                                                        <?php
                                                            }
                                                        ?>
                                                    </div>
                                                </div>   
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab Pangkat -->
                            <div id="li_pangkat" class="tab-pane fade">
                                <div class="col-lg-12">
                                    <div class="box box-default">
                                        <div class="box-body">
                                            <div class="col-lg-12">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Pangkat</th>
                                                            <th>TMT Pangkat</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_content">
                                                    </tbody>
                                                </table>
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab Jabatan -->
                            <div id="li_jabatan" class="tab-pane fade">
                                <div class="col-lg-12">
                                    <div class="box box-default">
                                        <div class="box-body">
                                            <div class="col-lg-12">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th class="col-lg-6">Nama Jabatan</th>
                                                            <th>Jenis</th>
                                                            <th>TMT Jabatan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_content">
                                                        
                                                    </tbody>
                                                </table>
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab Pendidikan Umum -->
                            <div id="li_pendidikan_umum" class="tab-pane fade">
                                <div class="col-lg-12">
                                    <div class="box box-default">
                                        <div class="box-body">
                                            <div class="col-lg-12">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Tingkat Pendidikan</th>
                                                            <th>Jurusan</th>
                                                            <th>Nama Sekolah</th>
                                                            <th>Lokasi Sekolah</th>
                                                            <th>Tahun Lulus</th>
                                                            <!-- <th>Skoring</th> -->
                                                            <!-- <th>Aksi</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_content">
                                                    </tbody>
                                                </table>
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 pull-right">
                                    <!-- <button class="btn btn-block btn-primary" id="btn_tambah" onclick="main_form('UMUM','insert','NULL')"> Tambah Data</button> -->
                                    <!-- <button class="btn btn-block btn-primary" id="btn_tambah"> Tambah Data</button>	 -->
                                </div>	
                            </div>

                            <!-- Tab Diklat Struktural -->
                            <div id="li_diklat_struktural" class="tab-pane fade">
                                <div class="col-lg-12">
                                    <div class="box box-default">
                                        <div class="box-body">
                                            <div class="col-lg-12">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Jenis Diklat</th>
                                                            <th>Tempat</th>
                                                            <th>Panitia</th>
                                                            <th>Tanggal Mulai</th>
                                                            <th>Tanggal Selesai</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_content">

                                                    </tbody>
                                                </table>
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 pull-right">
                                    <!-- <button class="btn btn-block btn-primary" id="btn_tambah" onclick="main_form('STRUKTURAL','insert','NULL')"> Tambah Data</button> -->
                                    <!-- <button class="btn btn-block btn-primary" id="btn_tambah"> Tambah Data</button>	 -->
                                </div>	
                            </div>

                            <!-- Tab Diklat Fungsional -->
                            <div id="li_diklat_fungsional" class="tab-pane fade">
                                <div class="col-lg-12">
                                    <div class="box box-default">
                                        <div class="box-body">
                                            <div class="col-lg-12">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Jenis Diklat</th>
                                                            <th>Tempat</th>
                                                            <th>Panitia</th>
                                                            <th>Tanggal Mulai</th>
                                                            <th>Tanggal Selesai</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_content">
                                                    </tbody>
                                                </table>
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 pull-right">
                                    <!-- <button class="btn btn-block btn-primary" id="btn_tambah" onclick="main_form('FUNGSIONAL','insert','NULL')"> Tambah Data</button> -->
                                    <!-- <button class="btn btn-block btn-primary" id="btn_tambah"> Tambah Data</button>	 -->
                                </div>	
                            </div>

                            <!-- Tab Diklat Teknis -->
                            <div id="li_teknis" class="tab-pane fade">
                                <div class="col-lg-12">
                                    <div class="box box-default">
                                        <div class="box-body">
                                            <div class="col-lg-12">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Jenis Diklat</th>
                                                            <th>Tempat</th>
                                                            <th>Panitia</th>
                                                            <th>Tanggal Mulai</th>
                                                            <th>Tanggal Selesai</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_content">

                                                    </tbody>
                                                </table>
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 pull-right">
                                    <!-- <button class="btn btn-block btn-primary" id="btn_tambah" onclick="main_form('TEKNIS','insert','NULL')"> Tambah Data</button> -->
                                    <!-- <button class="btn btn-block btn-primary" id="btn_tambah"> Tambah Data</button>	 -->
                                </div>	
                            </div>

                            <!-- Tab konferensi -->
                            <div id="li_konferensi" class="tab-pane fade">
                                <div class="col-lg-12">
                                    <div class="box box-default">
                                        <div class="box-body">
                                            <div class="col-lg-12">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Jenis Konferensi/Seminar</th>
                                                            <th>Peran</th>                                                            
                                                            <th>Tempat</th>
                                                            <th>Panitia</th>
                                                            <th>Tanggal Mulai</th>
                                                            <th>Tanggal Selesai</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_content">

                                                    </tbody>
                                                </table>
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 pull-right">
                                    <!-- <button class="btn btn-block btn-primary" id="btn_tambah" onclick="main_form('TEKNIS','insert','NULL')"> Tambah Data</button> -->
                                    <!-- <button class="btn btn-block btn-primary" id="btn_tambah"> Tambah Data</button>	 -->
                                </div>	
                            </div>
                            
                            <!-- Tab karyatulis -->
                            <div id="li_KaryaTulis" class="tab-pane fade">
                                <div class="col-lg-12">
                                    <div class="box box-default">
                                        <div class="box-body">
                                            <div class="col-lg-12">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Judul Buku</th>
                                                            <th>Tahun</th>                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_content">

                                                    </tbody>
                                                </table>
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 pull-right">
                                    <!-- <button class="btn btn-block btn-primary" id="btn_tambah" onclick="main_form('TEKNIS','insert','NULL')"> Tambah Data</button> -->
                                    <!-- <button class="btn btn-block btn-primary" id="btn_tambah"> Tambah Data</button>	 -->
                                </div>	
                            </div>

                            <!-- Tab karyatulis -->
                            <div id="li_organisasi" class="tab-pane fade">
                                <div class="col-lg-12">
                                    <div class="box box-default">
                                        <div class="box-body">
                                            <div class="col-lg-12">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Nama</th>
                                                            <th>Jenis</th>
                                                            <th>Jabatan</th>
                                                            <th>Tempat</th>
                                                            <th>Tanggal Mulai</th>                                                            
                                                            <th>Tanggal Selesai</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_content">

                                                    </tbody>
                                                </table>
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 pull-right">
                                    <!-- <button class="btn btn-block btn-primary" id="btn_tambah" onclick="main_form('TEKNIS','insert','NULL')"> Tambah Data</button> -->
                                    <!-- <button class="btn btn-block btn-primary" id="btn_tambah"> Tambah Data</button>	 -->
                                </div>	
                            </div>                            
                            
                            <!-- Tab Diklat Teknis -->
                            <div id="li_penghargaan" class="tab-pane fade">
                                <div class="col-lg-12">
                                    <div class="box box-default">
                                        <div class="box-body">
                                            <div class="col-lg-12">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Nama</th>                                                             
                                                            <th>Dari</th>
                                                            <th>SK</th>
                                                            <th>Tahun</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_content">

                                                    </tbody>
                                                </table>
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 pull-right">
                                    <!-- <button class="btn btn-block btn-primary" id="btn_tambah" onclick="main_form('TEKNIS','insert','NULL')"> Tambah Data</button> -->
                                    <!-- <button class="btn btn-block btn-primary" id="btn_tambah"> Tambah Data</button>	 -->
                                </div>	
                            </div>                            
                        </div>                    
                    </div>
                </div>
            <!-- </div> -->
        </div>
    </section>

    <!-- Section Input Biodata -->
    <section id="form_section_biodata" style="display:none;">
        <input class="form-control-detail" type="hidden" name="crud_biodata" id="crud_biodata">
        <input class="form-control-detail" type="hidden" name="oid_biodata" id="oid_biodata">
        <div class='col-md-12'>
            <div class="form-horizontal">
                <div id="form_pegawai" name="form_pegawai">
                    <div class="col-md-12">
                        <div class="box box-primary" style="padding:10px;">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                                <div class="box-tools pull-right"><a id="closeDataBiodata" class="btn btn-block btn-danger"><i class="fa fa-close"></i></a></div>
                            </div>
                            <div class="form-group">
                                <br><br>
                                <label class="col-md-2 control-label">NIP</label>
                                <div class="col-md-8">
                                    <input class="form-control form-control-detail" id="f_nip" type="text" max="30" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Nama</label>
                                <div class="col-md-8">
                                    <input class="form-control form-control-detail" id="f_nama" type="text" max="100" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Tempat Lahir</label>
                                <div class="col-md-3">
                                    <input class="form-control form-control-detail" id="f_tempat_lahir" type="text" max="50">
                                </div>
                                <label class="col-md-2 control-label">Tanggal Lahir</label>
                                <div class="col-md-3">
                                    <input type="text" id="f_tgl_lahir" class="form-control form-control-detail timerange-normal" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask> 
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Jenis Kelamin</label>
                                <div class="col-md-8">
                                    <select id="f_jenis_kelamin" class="form-control form-control-detail">
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>                        
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Agama</label>
                                <div class="col-md-8">
                                    <select id="f_agama" class="form-control form-control-detail">
                                        <?php foreach($agama->result() as $row){?>
                                            <option value="<?php echo $row->id_agama;?>"><?php echo $row->nama_agama;?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">No HP</label>
                                <div class="col-md-8">
                                    <input class="form-control form-control-detail" id="f_no_hp" type="text" max="12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">E-Mail</label>
                                <div class="col-md-8">
                                    <input class="form-control form-control-detail" id="f_email" type="text" max="100">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Alamat</label>
                                <div class="col-md-8">
                                    <textarea class="form-control form-control-detail" id="f_alamat"></textarea>
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="box-tools pull-right"><button class="btn btn-block btn-primary" id="btn_simpan" onclick="simpan('BIODATA')"> Simpan</button></div>
                            </div>

					    </div>
				    </div>
			    </div>
            </div>
	    </div>
    </section>

    <!-- Section Input Pendidikan -->
    <section id="form_section_pendidikan" style="display:none;">
        <input class="form-control-detail" type="hidden" name="crud" id="crud">
        <input class="form-control-detail" type="hidden" name="oid" id="oid">
        <div class='col-md-12'>
            <div class="form-horizontal">
                <div id="form_pegawai" name="form_pegawai">
                    <div class="col-md-12">
                        <div class="box box-primary" style="padding:10px;">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                                <div class="box-tools pull-right"><a id="closeDataPendidikan" class="btn btn-block btn-danger"><i class="fa fa-close"></i></a></div>
                            </div>
                            <div class="form-group">
                                <br><br>
                                <label class="col-md-2 control-label">Tingkat Pendidikan</label>
                                <div class="col-md-8">
                                    <select id="f_pendidikan" class="form-control form-control-detail">
                                        <?php foreach($pendidikan->result() as $row){?>
                                            <option value="<?php echo $row->id_pendidikan;?>"><?php echo $row->nama_pendidikan;?> (<?php echo $row->kode;?>)</option>
                                        <?php }?>
                                    </select>
                                    <!-- <input type="text" class="form-control form-control-detail" name="f_nama" id="f_nama"> -->
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Jurusan</label>
                                <div class="col-md-8">
                                    <input class="form-control form-control-detail" id="f_jurusan" type="text" max="50">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Nama Sekolah</label>
                                <div class="col-md-8">
                                    <input class="form-control form-control-detail" id="f_nama_sekolah" type="text" max="100">
                                </div>
                            </div>

                            <!-- <hr> -->
                            <div class="form-group">
                                <label class="col-md-2 control-label">Lokasi</label>
                                <div class="col-md-8">
                                    <input class="form-control form-control-detail" id="f_lokasi_sekolah" type="text" max="50">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Tahun Lulus</label>
                                <div class="col-md-8">
                                    <input class="form-control form-control-detail" id="f_tahun_lulus" type="number" max="4">
                                </div>
                            </div>	

                            <div class="box-footer">
                                <div class="box-tools pull-right"><button class="btn btn-block btn-primary" id="btn_simpan" onclick="simpan('PENDIDIKAN')"> Simpan</button></div>
                            </div>

					    </div>
				    </div>
			    </div>
            </div>
	    </div>
    </section>

    <!-- Section Input Diklat -->
    <section id="form_section_diklat" style="display:none;">
        <input class="form-control-detail" type="hidden" name="crud_diklat" id="crud_diklat">
        <input class="form-control-detail" type="hidden" name="oid_diklat" id="oid_diklat">
        <div class='col-md-12'>
            <div class="form-horizontal">
                <div id="form_pegawai" name="form_pegawai">
                    <div class="col-md-12">
                        <div class="box box-primary" style="padding:10px;">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                                <div class="box-tools pull-right"><a id="closeDataDiklat" class="btn btn-block btn-danger"><i class="fa fa-close"></i></a></div>
                            </div>
                            <div class="form-group">
                                <br><br>
                                <label class="col-md-2 control-label">Jenis Diklat</label>
                                <div class="col-md-8">
                                    <select id="f_diklat" class="form-control form-control-detail" disabled>
                                        <?php foreach($diklat->result() as $row){?>
                                            <option value="<?php echo $row->id_diklat;?>"><?php echo $row->jenis_diklat;?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Nama Diklat</label>
                                <div class="col-md-8">
                                    <input class="form-control form-control-detail" id="f_nama_diklat" type="text" max="150">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Tempat</label>
                                <div class="col-md-8">
                                    <input class="form-control form-control-detail" id="f_tempat" type="text" max="100">
                                </div>
                            </div>

                            <!-- <hr> -->
                            <div class="form-group">
                                <label class="col-md-2 control-label">Panitia</label>
                                <div class="col-md-8">
                                    <input class="form-control form-control-detail" id="f_panitia" type="text" max="150">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Tanggal Mulai</label>
                                <div class="col-md-3">
                                    <input type="text" id="f_tgl_mulai" class="form-control form-control-detail timerange-normal" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask> 
                                </div>
                                <label class="col-md-2 control-label">Tanggal Selesai</label>
                                <div class="col-md-3">
                                    <!-- <input class="form-control form-control-detail" id="f_tahun_lulus" type="text" max="4"> -->
                                    <input type="text" id="f_tgl_selesai" class="form-control form-control-detail timerange-normal" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask> 
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="box-tools pull-right"><button class="btn btn-block btn-primary" id="btn_simpan" onclick="simpan('DIKLAT')"> Simpan</button></div>
                            </div>

					    </div>
				    </div>
			    </div>
            </div>
	    </div>
    </section>
</div>

<script type="text/javascript">
    if (document.getElementById('dropzone_image')) {
        // other code here
        Dropzone.autoDiscover = false;
        var foto_upload= new Dropzone("div#dropzone_image",{
            url: "<?php echo site_url();?>/master/data_pegawai/unggah_foto_pegawai_self",
            maxFilesize: 2,
            method:"post",
            acceptedFiles:"image/*",
            paramName:"userfile",
            dictInvalidFileType:"Type file ini tidak dizinkan",
            addRemoveLinks:true,
            thumbnailWidth: null,
            thumbnailHeight: null,
            init: function() {
                this.on("thumbnail", function(file, dataUrl) {
                    $('.dz-image').last().find('img').attr({width: '100%', height: '100%'});
                }),
                this.on("success", function(file) {
                    $('.dz-image').css({"width":"100%", "height":"auto"});
                })
            }
        });

        foto_upload.on("processing",function(a){
            $("#loadprosess").modal('show');
        });

        foto_upload.on("sending",function(a,b,c){
            a.token =$('#oidPegawai').val();
            c.append("token_foto",a.token); //Menmpersiapkan token untuk masing masing foto
        });

        foto_upload.on("success",function(a){
            setTimeout(function(){
                $("#loadprosess").modal('hide');
                setTimeout(function(){
                    location.reload();
                }, 1500);
            }, 5000);
        });
    }
$(document).ready(function()
{
    profile();    
    riwayat_pendidikan();    
    riwayat_pangkat();    
    riwayat_jabatan();
    riwayat_diklat_struktural();       
    riwayat_diklat_fungsional();
	riwayat_diklat_teknis();
    riwayat_konferensi();
    karya_tulis();
    organisasi();
    penghargaan();
    $("#closeDataBiodata").click(function(){
		$("#form_section_biodata").css({"display": "none"})
        $("#view_section").css({"display": ""})		
	});
    
    $("#closeDataPendidikan").click(function(){
		$("#form_section_pendidikan").css({"display": "none"})
        $("#view_section").css({"display": ""})		
	});

    $("#closeDataDiklat").click(function(){
		$("#form_section_diklat").css({"display": "none"})
        $("#view_section").css({"display": ""})		
	});
})



function main_form(modul,params,id) {
    // console.log(id);
	if (modul == 'BIODATA') {
        $.ajax({
            url :"<?php echo site_url()?>user/get_data_pegawai/"+id,		
            type:"post",
            beforeSend:function(){
                $("#loadprosess").modal('show');
            },
            success:function(msg){
                var obj = jQuery.parseJSON (msg);
                $(".form-control-detail").val('');
                $("#form_section_biodata").css({"display": ""})
                $("#view_section").css({"display": "none"})
                $("#form_section_biodata > div > div > form > div > div > div.box-header > h3").html("Ubah Data");
                $("#crud_biodata").val('update');
                $("#oid_biodata").val(obj.biodata[0].id);
                
                if (obj.biodata != 0) {
                    if (obj.list_agama.length != 0) 
                    {
                        $('#f_nip').val(obj.biodata[0].nip);
                        $("#f_nama").val(obj.biodata[0].nama_pegawai);
                        $("#f_tempat_lahir").val(obj.biodata[0].TempatLahir);
                        $("#f_tgl_lahir").val(obj.biodata[0].BirthDate);
                        $("#f_jenis_kelamin").val(obj.biodata[0].Gender);
                        $("#f_agama").val(obj.biodata[0].id_agama);
                        $("#f_no_hp").val(obj.biodata[0].no_hp);
                        $("#f_email").val(obj.biodata[0].email);
                        $("#f_alamat").val(obj.biodata[0].alamat);
                    }
                }
                $("#loadprosess").modal('hide');
            },
            error:function(jqXHR,exception) {
                ajax_catch(jqXHR,exception);					
            }
        })
    }    
    else if (modul == 'UMUM') {
        if (params == 'insert') {
            $(".form-control-detail").val('');
            $("#form_section_pendidikan").css({"display": ""})
            $("#view_section").css({"display": "none"})
            $("#form_section_pendidikan > div > div > div > div > div > div.box-header > h3").html("Tambah Data Pendidikan");
            $("#crud").val('insert');
        }
        else if (params == 'update') {
            $.ajax({
			    url :"<?php echo site_url()?>user/get_data_pendidikan/"+id,		
			    type:"post",
			    beforeSend:function(){
				    $("#loadprosess").modal('show');
			    },
                success:function(msg){
                    var obj = jQuery.parseJSON (msg);
                    console.log();
                    $(".form-control-detail").val('');
                    $("#form_section_pendidikan").css({"display": ""})
                    $("#view_section").css({"display": "none"})
                    $("#form_section_pendidikan > div > div > form > div > div > div.box-header > h3").html("Ubah Data");
                    $("#crud").val('update');
                    $("#oid").val(obj.pendidikan[0].id);
                    
                    if (obj.pendidikan != 0) {
                        if (obj.list_pendidikan.length != 0) 
                        {
                            $('#f_pendidikan').val(obj.pendidikan[0].id_pendidikan);
                            $("#f_jurusan").val(obj.pendidikan[0].jurusan);
                            $("#f_nama_sekolah").val(obj.pendidikan[0].nama_sekolah);
                            $("#f_lokasi_sekolah").val(obj.pendidikan[0].lokasi_sekolah);
                            $("#f_tahun_lulus").val(obj.pendidikan[0].tahun_lulus);
                        }
                    }
                    $("#loadprosess").modal('hide');
                },
                error:function(jqXHR,exception) {
                    ajax_catch(jqXHR,exception);					
                }
            })
        }
        else if (params == 'delete') {
            LobiboxBase = {
                bodyClass       : 'lobibox-open',
                
                modalClasses : {
                    'error'     : 'lobibox-error',
                    'success'   : 'lobibox-success',
                    'info'      : 'lobibox-info',
                    'warning'   : 'lobibox-warning',
                    'confirm'   : 'lobibox-confirm',
                    'progress'  : 'lobibox-progress',
                    'prompt'    : 'lobibox-prompt',
                    'default'   : 'lobibox-default',
                    'window'    : 'lobibox-window'
                },
                
                buttons: {
                    ok: {
                        'class': 'lobibox-btn lobibox-btn-default',
                        text: 'OK',
                        closeOnClick: true
                    },
                    cancel: {
                        'class': 'lobibox-btn lobibox-btn-cancel',
                        text: 'Cancel',
                        closeOnClick: true
                    },
                    yes: {
                        'class': 'lobibox-btn lobibox-btn-yes',
                        text: 'Ya',
                        closeOnClick: true
                    },
                    no: {
                        'class': 'lobibox-btn lobibox-btn-no',
                        text: 'Tidak',
                        closeOnClick: true
                    }
                }
            }

            Lobibox.confirm({
                title: "Konfirmasi",
                msg: "Anda yakin akan menghapus data ini ?",
                callback: function ($this, type) {
                    console.log(type);
                    if (type === 'yes'){
                        $.ajax({
                            url : "<?php echo site_url()?>user/store_pendidikan/delete/"+id,
                            type:"post",
                            // data: { data_sender : data_sender},
                            beforeSend:function(){
                                $("#loadprosess").modal('show');
                            },
                            success:function(msg){
                                var obj = jQuery.parseJSON (msg);
                                ajax_status(obj);
                            },
                            error:function(jqXHR,exception)
                            {
                                ajax_catch(jqXHR,exception);					
                            }
                        })
                    }
                }
            })
        }
    }
    else {
        if (params == 'insert') {
            $(".form-control-detail").val('');
            $("#form_section_diklat").css({"display": ""})
            $("#view_section").css({"display": "none"})
            $("#form_section_diklat > div > div > div > div > div > div.box-header > h3").html("Tambah Data Diklat");
            $("#crud_diklat").val('insert');
            if (modul == 'STRUKTURAL') {
                $("#f_diklat").val('1');
            }
            else if (modul == 'FUNGSIONAL') {
                $("#f_diklat").val('2');
            }
            else if (modul == 'TEKNIS') {
                $("#f_diklat").val('3');
            }
        }
        else if (params == 'update') {
            $.ajax({
			    url :"<?php echo site_url()?>user/get_data_diklat/"+id,		
			    type:"post",
			    beforeSend:function(){
				    $("#loadprosess").modal('show');
			    },
                success:function(msg){
                    var obj = jQuery.parseJSON (msg);
                    console.log(obj);
                    $(".form-control-detail").val('');
                    $("#form_section_diklat").css({"display": ""})
                    $("#view_section").css({"display": "none"})
                    $("#form_section_diklat > div > div > form > div > div > div.box-header > h3").html("Ubah Data");
                    $("#crud_diklat").val('update');
                    $("#oid_diklat").val(obj.diklat[0].id);
                    
                    if (obj.diklat != 0) {
                        if (obj.list_diklat.length != 0) 
                        {
                            $('#f_diklat').val(obj.diklat[0].id_diklat);
                            $("#f_nama_diklat").val(obj.diklat[0].nama_diklat);
                            $("#f_tempat").val(obj.diklat[0].tempat);
                            $("#f_panitia").val(obj.diklat[0].panitia);
                            $("#f_tgl_mulai").val(obj.diklat[0].tgl_mulai);
                            $("#f_tgl_selesai").val(obj.diklat[0].tgl_selesai);
                        }
                    }
                    $("#loadprosess").modal('hide');
                },
                error:function(jqXHR,exception) {
                    ajax_catch(jqXHR,exception);					
                }
            })
        }
        else if (params == 'delete') {
            LobiboxBase = {
                bodyClass       : 'lobibox-open',
                
                modalClasses : {
                    'error'     : 'lobibox-error',
                    'success'   : 'lobibox-success',
                    'info'      : 'lobibox-info',
                    'warning'   : 'lobibox-warning',
                    'confirm'   : 'lobibox-confirm',
                    'progress'  : 'lobibox-progress',
                    'prompt'    : 'lobibox-prompt',
                    'default'   : 'lobibox-default',
                    'window'    : 'lobibox-window'
                },
                
                buttons: {
                    ok: {
                        'class': 'lobibox-btn lobibox-btn-default',
                        text: 'OK',
                        closeOnClick: true
                    },
                    cancel: {
                        'class': 'lobibox-btn lobibox-btn-cancel',
                        text: 'Cancel',
                        closeOnClick: true
                    },
                    yes: {
                        'class': 'lobibox-btn lobibox-btn-yes',
                        text: 'Ya',
                        closeOnClick: true
                    },
                    no: {
                        'class': 'lobibox-btn lobibox-btn-no',
                        text: 'Tidak',
                        closeOnClick: true
                    }
                }
            }

            Lobibox.confirm({
                title: "Konfirmasi",
                msg: "Anda yakin akan menghapus data ini ?",
                callback: function ($this, type) {
                    console.log(type);
                    if (type === 'yes'){
                        $.ajax({
                            url : "<?php echo site_url()?>user/store_diklat/delete/"+id,
                            type:"post",
                            // data: { data_sender : data_sender},
                            beforeSend:function(){
                                $("#loadprosess").modal('show');
                            },
                            success:function(msg){
                                var obj = jQuery.parseJSON (msg);
                                ajax_status(obj);
                            },
                            error:function(jqXHR,exception)
                            {
                                ajax_catch(jqXHR,exception);					
                            }
                        })
                    }
                }
            })
        }
    }
}

function simpan(modul) {
    if (modul == 'BIODATA') {
        var f_nip               = $("#f_nip").val();
        var f_nama              = $("#f_nama").val();
        var f_tempat_lahir      = $("#f_tempat_lahir").val();
        var f_tgl_lahir         = $("#f_tgl_lahir").val();
        var f_jenis_kelamin     = $("#f_jenis_kelamin").val();
        var f_agama             = $("#f_agama").val();
        var f_no_hp             = $("#f_no_hp").val();
        var f_email             = $("#f_email").val();
        var f_alamat            = $("#f_alamat").val();
        var oid                 = $("#oid_biodata").val();
        var crud                = $("#crud_biodata").val();
        var data_sender         = "";

        if (f_nip <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Data NIP tidak boleh kosong."
            });
        }
        else if(f_nama.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Data Nama Pegawai tidak boleh kosong."
            });
        }
        else if(f_tempat_lahir.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Data Tempat Lahir tidak boleh kosong."
            });
        }
        else if(f_tgl_lahir.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Data Tanggal Lahir tidak boleh kosong."
            });
        }
        else if(f_jenis_kelamin.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Data Jenis Kelamin tidak boleh kosong."
            });
        }
        else if(f_agama.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Data Agama tidak boleh kosong."
            });
        }
        else if(f_no_hp.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Data No HP tidak boleh kosong."
            });
        }
        else if(f_email.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Data E-Mail tidak boleh kosong."
            });
        }
        else if(f_alamat.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Data Alamat tidak boleh kosong."
            });
        }
        else
        {
            data_sender = {
                    'crud'   		: crud,
                    'oid'    		: oid,
                    'nip'    	    : f_nip,
                    'nama_pegawai'  : f_nama,
                    'TempatLahir'   : f_tempat_lahir,
                    'BirthDate'     : f_tgl_lahir,
                    'Gender'   	    : f_jenis_kelamin,
                    'id_agama'   	: f_agama,
                    'no_hp'   	    : f_no_hp,
                    'email'   	    : f_email,
                    'alamat'   	    : f_alamat
                }				
            
            $.ajax({
                url :"<?php echo site_url()?>user/store_profile",
                type:"post",
                data: { data_sender : data_sender},
                beforeSend:function(){
                    $("#loadprosess").modal('show');
                },
                success:function(msg){
                    var obj = jQuery.parseJSON (msg);
                    // console.log(obj);
                    ajax_status(obj);
                },
                error:function(jqXHR,exception)
                {
                    ajax_catch(jqXHR,exception);					
                }
            })				
        }
    }
    else if (modul == 'PENDIDIKAN') {
        var f_pendidikan          = $("#f_pendidikan").val();
        var f_jurusan             = $("#f_jurusan").val();
        var f_nama_sekolah        = $("#f_nama_sekolah").val();
        var f_lokasi_sekolah      = $("#f_lokasi_sekolah").val();
        var f_tahun_lulus         = $("#f_tahun_lulus").val();				
        var oid                   = $("#oid").val();
        var crud                  = $("#crud").val();
        var data_sender           = "";

        if (f_pendidikan <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Data Tingkat Pendidikan tidak boleh kosong."
            });
        }
        else if(f_jurusan.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Data Jurusan tidak boleh kosong."
            });
        }
        else if(f_nama_sekolah.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Data Nama Sekolah tidak boleh kosong."
            });
        }
        else if(f_lokasi_sekolah.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Data Lokasi Sekolah tidak boleh kosong."
            });
        }
        else if(f_tahun_lulus.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Data Tahun Lulus tidak boleh kosong."
            });
        }
        else
        {
            data_sender = {
                    'crud'   			: crud,
                    'oid'    			: oid,
                    'id_pendidikan'    	: f_pendidikan,
                    'jurusan'    	    : f_jurusan,
                    'nama_sekolah'    	: f_nama_sekolah,
                    'lokasi_sekolah'    : f_lokasi_sekolah,
                    'tahun_lulus'   	: f_tahun_lulus									
                }				
            
            $.ajax({
                url :"<?php echo site_url()?>user/store_pendidikan",
                type:"post",
                data: { data_sender : data_sender},
                beforeSend:function(){
                    $("#loadprosess").modal('show');
                },
                success:function(msg){
                    var obj = jQuery.parseJSON (msg);
                    // console.log(obj);
                    ajax_status(obj);
                },
                error:function(jqXHR,exception)
                {
                    ajax_catch(jqXHR,exception);					
                }
            })				
        }
    }
    else if (modul == 'DIKLAT') {
        var f_diklat              = $("#f_diklat").val();
        var f_nama_diklat         = $("#f_nama_diklat").val();
        var f_tempat              = $("#f_tempat").val();
        var f_panitia             = $("#f_panitia").val();
        var f_tgl_mulai           = $("#f_tgl_mulai").val();
        var f_tgl_selesai         = $("#f_tgl_selesai").val();				
        var oid                   = $("#oid_diklat").val();
        var crud                  = $("#crud_diklat").val();
        var data_sender           = "";

        if(f_nama_diklat.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Data Nama Diklat tidak boleh kosong."
            });
        }
        else if(f_tempat.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Data Tempat Diklat tidak boleh kosong."
            });
        }
        else if(f_panitia.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Data Panitia Diklat tidak boleh kosong."
            });
        }
        else if(f_tgl_mulai.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Data Tanggal Mulai tidak boleh kosong."
            });
        }
        else if(f_tgl_selesai.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Data Tanggal Selesai tidak boleh kosong."
            });
        }
        else
        {
            data_sender = {
                    'crud'   			: crud,
                    'oid'    			: oid,
                    'id_diklat'         : f_diklat,
                    'nama_diklat'  	    : f_nama_diklat,
                    'tempat'        	: f_tempat,
                    'panitia'           : f_panitia,
                    'tgl_mulai'   	    : f_tgl_mulai,
                    'tgl_selesai'       : f_tgl_selesai,
                }				
            
            $.ajax({
                url :"<?php echo site_url()?>user/store_diklat",
                type:"post",
                data: { data_sender : data_sender},
                beforeSend:function(){
                    $("#loadprosess").modal('show');
                },
                success:function(msg){
                    var obj = jQuery.parseJSON (msg);
                    // console.log(obj);
                    ajax_status(obj);
                },
                error:function(jqXHR,exception)
                {
                    ajax_catch(jqXHR,exception);					
                }
            })				
        }
    }
}
</script>