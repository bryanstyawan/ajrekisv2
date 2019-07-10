<div class="col-md-12" id="profile-dashboard">

    <!-- Profile Picture -->
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
    </div>

    <section id="view_section">
        <div class="col-md-10" id="view_section">
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
                                <a data-toggle="tab" href="#Pangkat">
                                    Pangkat&nbsp;&nbsp;
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#Jabatan">
                                    Jabatan&nbsp;&nbsp;
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#Umum">
                                    Pendidikan Umum&nbsp;&nbsp;
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#Struktural">
                                    Diklat Struktural&nbsp;&nbsp;
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#Fungsional">
                                    Diklat Fungsional&nbsp;&nbsp;
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#Teknis">
                                    Diklat Teknis&nbsp;&nbsp;
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

                                                <div class="form-group col-md-12">
                                                    <label class="widget-user-desc" style="margin-top:5px;">NIP</label>
                                                        <span style="margin-left:121px;">: <?php echo $infoPegawai[0]->nip;?></span><br>
                                                    <label class="widget-user-desc" style="margin-top:5px;">Nama</label>
                                                        <span style="margin-left:107px;">: <?php echo $infoPegawai[0]->nama_pegawai;?></span><br>
                                                    <label class="widget-user-desc" style="margin-top:5px;">Tempat/Tanggal Lahir</label>
                                                        <span style="margin-left:9px;">: <?php echo $infoPegawai[0]->TempatLahir.', '.date('d F Y', strtotime($infoPegawai[0]->BirthDate));?></span><br>
                                                    <label class="widget-user-desc" style="margin-top:5px;">Jenis Kelamin</label>
                                                        <span style="margin-left:57px;">: <?php echo ($infoPegawai[0]->Gender == 'L' ? 'Laki-laki' : 'Perempuan') ;?></span><br>
                                                    <label class="widget-user-desc" style="margin-top:5px;">Agama</label>
                                                        <span style="margin-left:101px;">: <?php echo $infoPegawai[0]->nama_agama;?></span><br>
                                                    <label class="widget-user-desc" style="margin-top:5px;">No HP</label>
                                                        <span style="margin-left:106px;">: <?php echo $infoPegawai[0]->no_hp;?></span><br>
                                                    <label class="widget-user-desc" style="margin-top:5px;">E-mail</label>
                                                        <span style="margin-left:104px;">: <?php echo $infoPegawai[0]->email;?></span><br>
                                                    <label class="widget-user-desc" style="margin-top:5px;">Jabatan</label>
                                                        <span style="margin-left:93px;">: <?php echo $infoPegawai[0]->nama_jabatan;?></span><br>
                                                    <label class="widget-user-desc" style="margin-left:153px;">TMT Jabatan</label>
                                                        <span>: <?php echo date('d F Y', strtotime($infoPegawai[0]->tmt_jabatan));?></span><br>
                                                    <label class="widget-user-desc" style="margin-top:5px;">Pangkat</label>
                                                        <span style="margin-left:93px;">: <?php echo $infoPegawai[0]->nama_pangkat.'('.$infoPegawai[0]->nama_golongan.'/'.$infoPegawai[0]->nama_ruang.')';?></span><br>
                                                    <label class="widget-user-desc" style="margin-left:153px;">TMT Pangkat</label>
                                                        <span>: <?php echo date('d F Y', strtotime($infoPegawai[0]->tmt_golongan));?></span><br>
                                                    <label class="widget-user-desc" style="margin-top:5px;">Alamat</label>
                                                        <span style="margin-left:100px;">: <?php echo $infoPegawai[0]->alamat;?></span><br>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab Pangkat -->
                            <div id="Pangkat" class="tab-pane fade">
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
                                                        <?php
                                                            if ($history_golongan != 0) {
                                                                for ($i=0; $i < count($history_golongan); $i++) { 
                                                        ?>
                                                                    <tr>
                                                                        <td><?=$i+1;?></td>
                                                                        <td><?=$history_golongan[$i]->nama_pangkat;?></td>
                                                                        <td><?=$history_golongan[$i]->tmt;?></td>
                                                                    </tr>
                                                        <?php
                                                                }
                                                            } 
                                                            else {
                                                        ?>   
                                                                <tr>
                                                                    <td colspan="6" align="center">Data Masih Kosong</td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab Jabatan -->
                            <div id="Jabatan" class="tab-pane fade">
                                <div class="col-lg-12">
                                    <div class="box box-default">
                                        <div class="box-body">
                                            <div class="col-lg-12">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Nama Jabatan</th>
                                                            <th>Jenis</th>
                                                            <th>TMT Jabatan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_content">
                                                        <?php
                                                            if ($history_golongan != 0) {
                                                                for ($i=0; $i < count($history_jabatan); $i++) { 
                                                        ?>
                                                                    <tr>
                                                                        <td><?=$i+1;?></td>
                                                                        <td><?=$history_jabatan[$i]->nama_posisi;?></td>
                                                                        <td><?=$history_jabatan[$i]->nama_kat_posisi;?></td>
                                                                        <td><?=$history_jabatan[$i]->StartDate;?></td>
                                                                    </tr>
                                                        <?php
                                                                }
                                                            }
                                                            else {
                                                        ?>   
                                                                <tr>
                                                                    <td colspan="6" align="center">Data Masih Kosong</td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab Pendidikan Umum -->
                            <div id="Umum" class="tab-pane fade">
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
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_content">
                                                        <?php
                                                            if ($history_pendidikan != 0) {
                                                                for ($i=0; $i < count($history_pendidikan); $i++) { 
                                                        ?>
                                                                    <tr>
                                                                        <td><?=$i+1;?></td>
                                                                        <td><?=$history_pendidikan[$i]->nama_pendidikan;?> (<?=$history_pendidikan[$i]->kode;?>)</td>
                                                                        <td><?=$history_pendidikan[$i]->jurusan;?></td>
                                                                        <td><?=$history_pendidikan[$i]->nama_sekolah;?></td>
                                                                        <td><?=$history_pendidikan[$i]->lokasi_sekolah;?></td>
                                                                        <td><?=$history_pendidikan[$i]->tahun_lulus;?></td>
                                                                        <!-- <td><?php echo anchor('master/editPegawai/'.$history_pendidikan[$i]->id,'<button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button>');?></td> -->
                                                                        <td><button class="btn btn-primary btn-xs" onclick="main_form('UMUM','update','<?php echo $history_pendidikan[$i]->id;?>')"><i class="fa fa-edit"></i></button></td>
                                                                        <td><button class="btn btn-primary btn-xs" onclick="main_form('UMUM','delete','<?php echo $history_pendidikan[$i]->id;?>')"><i class="fa fa-trash"></i></button></td>
                                                                    </tr>
                                                        <?php
                                                                }
                                                            }
                                                            else {
                                                        ?>   
                                                                <tr>
                                                                    <td colspan="6" align="center">Data Masih Kosong</td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 pull-right">
                                    <button class="btn btn-block btn-primary" id="btn_tambah" onclick="main_form('UMUM','insert','NULL')"> Tambah Data</button>
                                    <!-- <button class="btn btn-block btn-primary" id="btn_tambah"> Tambah Data</button>	 -->
                                </div>	
                            </div>

                            <!-- Tab Diklat Struktural -->
                            <div id="Struktural" class="tab-pane fade">
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
                                                            <th>Tanggal</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_content">
                                                        <?php
                                                            if ($diklat_struktural != 0) {
                                                                for ($i=0; $i < count($diklat_struktural); $i++) { 
                                                        ?>
                                                                    <tr>
                                                                        <td><?=$i+1;?></td>
                                                                        <td><?=$diklat_struktural[$i]->nama_diklat;?></td>
                                                                        <td><?=$diklat_struktural[$i]->tempat;?></td>
                                                                        <td><?=$diklat_struktural[$i]->panitia;?></td>
                                                                        <td><?=$diklat_struktural[$i]->tgl_mulai;?>-<?=$diklat_struktural[$i]->tgl_selesai;?></td>
                                                                        <td><button class="btn btn-primary btn-xs" onclick="main_form('STRUKTURAL','update','<?php echo $diklat_struktural[$i]->id;?>')"><i class="fa fa-edit"></i></button></td>
                                                                        <td><button class="btn btn-primary btn-xs" onclick="main_form('STRUKTURAL','delete','<?php echo $diklat_struktural[$i]->id;?>')"><i class="fa fa-trash"></i></button></td>
                                                                    </tr>
                                                        <?php
                                                                }
                                                            }
                                                            else {
                                                        ?>   
                                                                <tr>
                                                                    <td colspan="6" align="center">Data Masih Kosong</td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 pull-right">
                                    <button class="btn btn-block btn-primary" id="btn_tambah" onclick="main_form('STRUKTURAL','insert','NULL')"> Tambah Data</button>
                                    <!-- <button class="btn btn-block btn-primary" id="btn_tambah"> Tambah Data</button>	 -->
                                </div>	
                            </div>

                            <!-- Tab Diklat Fungsional -->
                            <div id="Fungsional" class="tab-pane fade">
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
                                                            <th>Tanggal</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_content">
                                                        <?php
                                                            if ($diklat_fungsional != 0) {
                                                                for ($i=0; $i < count($diklat_fungsional); $i++) { 
                                                        ?>
                                                                    <tr>
                                                                        <td><?=$i+1;?></td>
                                                                        <td><?=$diklat_fungsional[$i]->nama_diklat;?></td>
                                                                        <td><?=$diklat_fungsional[$i]->tempat;?></td>
                                                                        <td><?=$diklat_fungsional[$i]->panitia;?></td>
                                                                        <td><?=$diklat_fungsional[$i]->tgl_mulai;?>-<?=$diklat_fungsional[$i]->tgl_selesai;?></td>
                                                                        <td><button class="btn btn-primary btn-xs" onclick="main_form('FUNGSIONAL','update','<?php echo $diklat_fungsional[$i]->id;?>')"><i class="fa fa-edit"></i></button></td>
                                                                        <td><button class="btn btn-primary btn-xs" onclick="main_form('FUNGSIONAL','delete','<?php echo $diklat_fungsional[$i]->id;?>')"><i class="fa fa-trash"></i></button></td>
                                                                    </tr>
                                                        <?php
                                                                }
                                                            }
                                                            else {
                                                        ?>   
                                                                <tr>
                                                                    <td colspan="6" align="center">Data Masih Kosong</td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 pull-right">
                                    <button class="btn btn-block btn-primary" id="btn_tambah" onclick="main_form('FUNGSIONAL','insert','NULL')"> Tambah Data</button>
                                    <!-- <button class="btn btn-block btn-primary" id="btn_tambah"> Tambah Data</button>	 -->
                                </div>	
                            </div>

                            <!-- Tab Diklat Teknis -->
                            <div id="Teknis" class="tab-pane fade">
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
                                                            <th>Tanggal</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_content">
                                                        <?php
                                                            if ($diklat_teknis != 0) {
                                                                for ($i=0; $i < count($diklat_teknis); $i++) { 
                                                        ?>
                                                                    <tr>
                                                                        <td><?=$i+1;?></td>
                                                                        <td><?=$diklat_teknis[$i]->nama_diklat;?></td>
                                                                        <td><?=$diklat_teknis[$i]->tempat;?></td>
                                                                        <td><?=$diklat_teknis[$i]->panitia;?></td>
                                                                        <td><?=$diklat_teknis[$i]->tgl_mulai;?>-<?=$diklat_teknis[$i]->tgl_selesai;?></td>
                                                                        <td><button class="btn btn-primary btn-xs" onclick="main_form('TEKNIS','update','<?php echo $diklat_teknis[$i]->id;?>')"><i class="fa fa-edit"></i></button></td>
                                                                        <td><button class="btn btn-primary btn-xs" onclick="main_form('TEKNIS','delete','<?php echo $diklat_teknis[$i]->id;?>')"><i class="fa fa-trash"></i></button></td>
                                                                    </tr>
                                                        <?php
                                                                }
                                                            }
                                                            else {
                                                        ?>   
                                                                <tr>
                                                                    <td colspan="6" align="center">Data Masih Kosong</td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 pull-right">
                                    <button class="btn btn-block btn-primary" id="btn_tambah" onclick="main_form('TEKNIS','insert','NULL')"> Tambah Data</button>
                                    <!-- <button class="btn btn-block btn-primary" id="btn_tambah"> Tambah Data</button>	 -->
                                </div>	
                            </div>
                        </div>                    
                    </div>
                </div>
            <!-- </div> -->
        </div>
    </section>

    <section id="form_section_pendidikan" style="display:none;">
        <input class="form-control-detail" type="hidden" name="crud" id="crud">
        <input class="form-control-detail" type="hidden" name="oid" id="oid">
        <div class='col-md-10'>
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

    <section id="form_section_diklat" style="display:none;">
        <input class="form-control-detail" type="hidden" name="crud_diklat" id="crud_diklat">
        <input class="form-control-detail" type="hidden" name="oid_diklat" id="oid_diklat">
        <div class='col-md-10'>
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
<!-- <div class="form-horizontal">
	<form id="form_password" name="form_password">
		<div class="col-md-12">
	      	<div class="box box-primary" style="padding:10px;">
				<div class="form-group">
					<label for="gender" class="col-md-2 control-label"></label>
					<div class="col-md-9">
						<div class="row">
						<a class="btn btn-app pull-right" id="btn_save"><i class="fa fa-save"></i> Simpan</a>
					</div>
				</div>

				<div class="form-group">
					<label for="es1" class="col-md-2 control-label">Password Lama</label>
					<div class="col-md-9">
						<input type="password" class="form-control" id="pass_lama" name="pass_lama">					
					</div>
				</div>
				<div class="form-group">
					<label for="es2" class="col-md-2 control-label">Password Baru</label>
					<div class="col-md-9">
						<input type="password" class="form-control" id="pass_baru" name="pass_baru">
					</div>
				</div>
				<div class="form-group">
					<label for="es2" class="col-md-2 control-label">Ulangi Password Baru</label>
					<div class="col-md-9">
						<input type="password" class="form-control" id="re_pass_baru" name="re_pass_baru">
					</div>
				</div>				
			</div>
		</div>
	</form>
</div> -->
<script type="text/javascript">
$(document).ready(function()
{
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
	if (modul == 'UMUM') {
        if (params == 'insert') {
            $(".form-control-detail").val('');
            $("#form_section_pendidikan").css({"display": ""})
            $("#view_section").css({"display": "none"})
            $("#form_section_pendidikan > div > div > div > div > div > div.box-header > h3").html("Tambah Data Pendidikan");
            $("#crud").val('insert');
        }
        else if (params == 'update') {
            $.ajax({
			    url :"<?php echo site_url()?>admin/get_data_pendidikan/"+id,		
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
                            url : "<?php echo site_url()?>admin/store_pendidikan/delete/"+id,
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
			    url :"<?php echo site_url()?>admin/get_data_diklat/"+id,		
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
                            url : "<?php echo site_url()?>admin/store_diklat/delete/"+id,
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
    if (modul == 'PENDIDIKAN') {
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
                url :"<?php echo site_url()?>admin/store_pendidikan",
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
                url :"<?php echo site_url()?>admin/store_diklat",
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