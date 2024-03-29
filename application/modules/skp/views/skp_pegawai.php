<?php
$year_system = '2022';
?>
<input type="hidden" id="oid_kat_posisi" value="<?=$this->session->userdata('kat_posisi');?>">
<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/tabs-checked/css/style_tabs.css'; ?>");</style>
<style type="text/css">
#table_skp>thead>tr>th
{
    vertical-align: middle;
    text-align: center;
    border: 1px solid rgba(158, 158, 158, 0.2);
    padding-left: 25px;
}

#table_skp>tbody>tr>td
{
    /* text-align: ; */
    border: 1px solid rgba(158, 158, 158, 0.2);
}

.data-before
{
    width: 100%;
    display: inline-block;
    padding: 3px 8px;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    touch-action: manipulation;
    pointer-events: none;
    user-select: none;
    background-image: none;
    border: 1px solid #9E9E9E;
    border-radius: 4px;
    background-color: #FF5722;
    color: #fff;
}

.data-after
{
    width: 100%;
    display: inline-block;
    padding: 3px 8px;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    touch-action: manipulation;
    pointer-events: none;
    user-select: none;
    background-image: none;
    border: 1px solid #9E9E9E;
    border-radius: 4px;
    background-color: #8BC34A;
    color: #fff;
}

.break-label
{
    padding-bottom: 13px;
}

.input-controll
{
    height: 55px;
    font-size: 22px;    
}
</style>

<div class="col-xs-12">
    <div class="box">
        <div class="box-header">
            <div class="col-md-12">
                <label style="color: #000;font-weight: 400;font-size: 15px;display: -webkit-inline-box;">
                    Keterangan Status&nbsp;:&nbsp;&nbsp;
                </label>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12 break-label">
                        <label class="col-sm-3">SKP Yang telah disetujui :</label>
                        <label class="col-sm-3" style="background-color: #4caf50;">&nbsp;</label>
                    </div>
                    <div class="col-sm-12 break-label">
                        <label class="col-sm-3">SKP Telah diubah, menunggu persetujuan atasan :</label>
                        <label class="col-sm-3" style="background-color: #FFC107;">&nbsp;</label>
                    </div>
                    <div class="col-sm-12 break-label">
                        <label class="col-sm-3">SKP yang ditolak, perlu revisi :</label>
                        <label class="col-sm-3" style="background-color: #E91E63;">&nbsp;</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xs-12">
    <div class="box">
        <div class="box-header">

            <div class="col-lg-6">
                <div class="input-group col-lg-4">
                    <select name="f_tahun" id="f_tahun" class="form-control">
                    <?php
                        $now=$year_system;
                        $past=$now-2;
                        for ($a=$past;$a<=$now+5;$a++)
                        {
                            $select ="";
                            if ($a == $year_pass) {
                                # code...
                                $select = "selected";
                            }
                            echo "<option value='$a' $select>$a</option>";
                        }
                    ?>
                    </select>
                    <a class="btn btn-md pull-right" onclick="lookData('<?=$id_pegawai;?>','<?=$id_posisi;?>')" style="background:#00BCD4;color: #fff; margin:10px"><i class="fa fa-excel"></i> Lihat</a>                    
                </div>       
            </div>
            <div class="col-lg-6">
                <h3 class="box-title pull-right"><button class="btn btn-block btn-primary" id="addDataSKP"><i class="fa fa-plus-square"></i> Tambah SKP Pegawai</button></h3>                
            </div>      

            <div class="col-lg-12">
                <h3 class="text-center col-lg-12">PENILAIAN CAPAIAN SASARAN KERJA PEGAWAI NEGERI SIPIL</h3>            
            </div>      
        </div>
        <div class="box-body">
            <table id="table_skp" class="table table-bordered table-striped table-view" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th rowspan="2"></th>
                        <th rowspan="2">Kegiatan tugas jabatan</th>
                        <th style="max-width: 40px!important;width: 40px!important;" rowspan="2">AK</th>
                        <th colspan="6">Target</th>
                        <th style="width: 5%;" rowspan="2">Keterangan</th>
                        <th rowspan="2" style="min-width: 100px;">Aksi</th>
                    </tr>
                    <tr>
                        <th style="max-width: 40px!important;width: 40px!important;">Kuan</th>
                        <th style="max-width: 40px!important;width: 40px!important;">Output</th>
                        <th style="max-width: 40px!important;width: 40px!important;">Kual / mutu</th>
                        <th style="max-width: 70px!important;width: 70px!important;" colspan="2">Waktu (Bulan)</th>
                        <th>Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($list != 0) {
                        # code...
                        for ($i=0; $i < count($list); $i++) {
                            # code...
                            $status              = "";
                            $pk_status           = "";
                            $style_status        = "";
                            $style_tr            = "";
                            $style_td            = "";
                            $arrow_up            = "";
                            $arrow_down          = "";

                            $kegiatan            = $list[$i]->kegiatan;                            
                            if($info_posisi[0]['kat_posisi'] == 1)
                            {
                                if ($list[$i]->id_skp_master != 0) {
                                    # code...
                                    $kegiatan            = $list[$i]->kegiatan_skp;
                                }
                                else
                                {
                                    $list[$i]->id_skp_master = NULL;
                                }
                            }
                            elseif ($info_posisi[0]['kat_posisi'] == 2) {
                                # code...
                                if ($list[$i]->id_skp_jft != 0) {
                                    # code...
                                    $kegiatan            = $list[$i]->kegiatan_skp_jft;
                                }
                                else
                                {
                                    $list[$i]->id_skp_jft = NULL;
                                }                                                                
                            }                            
                            elseif ($info_posisi[0]['kat_posisi'] == 4) {
                                # code...
                                if ($list[$i]->id_skp_jfu != 0) {
                                    # code...
                                    $kegiatan            = $list[$i]->kegiatan_skp_jfu;
                                }       
                                else
                                {
                                    $list[$i]->id_skp_jfu = NULL;
                                }                                                                                                                 
                            }
                            elseif($info_posisi[0]['kat_posisi'] == 6)
                            {
                                if ($list[$i]->id_skp_master != 0) {
                                    # code...
                                    $kegiatan            = $list[$i]->kegiatan_skp;
                                }
                                else
                                {
                                    $list[$i]->id_skp_master = NULL;
                                }                                                        
                            }

                            $AK_target           = $list[$i]->AK_target;
                            $target_qty          = $list[$i]->target_qty;
                            $target_output       = $list[$i]->target_output_name;
                            $target_kualitasmutu = $list[$i]->target_kualitasmutu;
                            $target_waktu_bln    = $list[$i]->target_waktu_bln;
                            $target_biaya        = number_format($list[$i]->target_biaya,0);
                            $jenis_skp           = $list[$i]->nama_jenis_skp;


                            if ($list[$i]->edit_status == 3) {
                                # code...
                                if ($list[$i]->kegiatan != $list[$i]->edit_kegiatan) {
                                    # code...
                                    // $kegiatan = "<span class='data-before'>".$list[$i]->kegiatan."</span> <i class='fa fa-angle-double-right'></i> <span class='data-after'>".$list[$i]->edit_kegiatan."</span>";
                                }

                                if ($list[$i]->nama_jenis_skp != $list[$i]->edit_nama_jenis_skp) {
                                    # code...
                                    $jenis_skp = "<span class='data-before'>".$list[$i]->nama_jenis_skp."</span> <i class='fa fa-angle-double-right'></i> <span class='data-after'>".$list[$i]->edit_nama_jenis_skp."</span>";
                                }

                                if ($list[$i]->AK_target != $list[$i]->edit_AK_target) {
                                    # code...
                                    $AK_target = "<span class='data-before'>".$list[$i]->AK_target."</span> <i class='fa fa-angle-double-right'></i> <span class='data-after'>".$list[$i]->edit_AK_target."</span>";
                                }

                                if ($list[$i]->target_qty != $list[$i]->edit_target_qty) {
                                    # code...
                                    $target_qty = "<span class='data-before'>".$list[$i]->target_qty."</span> <i class='fa fa-angle-double-right'></i> <span class='data-after'>".$list[$i]->edit_target_qty."</span>";
                                }

                                if ($list[$i]->target_output != $list[$i]->edit_target_output) {
                                    # code...
                                    $target_output = "<span class='data-before'>".$list[$i]->target_output_name."</span> <i class='fa fa-angle-double-right'></i> <span class='data-after'>".$list[$i]->edit_target_output_name."</span>";
                                }

                                if ($list[$i]->target_kualitasmutu != $list[$i]->edit_target_kualitasmutu) {
                                    # code...
                                    $target_kualitasmutu = "<span class='data-before'>".$list[$i]->target_kualitasmutu."</span> <i class='fa fa-angle-double-right'></i> <span class='data-after'>".$list[$i]->edit_target_kualitasmutu."</span>";
                                }

                                if ($list[$i]->target_waktu_bln != $list[$i]->edit_target_waktu_bln) {
                                    # code...
                                    $target_waktu_bln = "<span class='data-before'>".$list[$i]->target_waktu_bln."</span> <i class='fa fa-angle-double-right'></i> <span class='data-after'>".$list[$i]->edit_target_waktu_bln."</span>";
                                }

                                if ($list[$i]->target_biaya != $list[$i]->edit_target_biaya) {
                                    # code...
                                    $target_biaya = "<span class='data-before'>".number_format($list[$i]->target_biaya,0)."</span> <i class='fa fa-angle-double-right'></i> <span class='data-after'>".number_format($list[$i]->edit_target_biaya,0)."</span>";
                                }
                            }


                            $pk_status = ($list[$i]->PK == 1) ? "Ya" : "Tidak" ;                            

                            if ($list[$i]->status == 1) {
                                # code...
                                $status       = "Close";
                                $style_status = "display:none;";
                                $style_tr     = "background-color: #4CAF50;color: #fff;";
                                $style_td     = "border-bottom: 1px solid #fff;border-top: 1px solid #fff;";
                                if ($list[$i]->edit_status == 3) {
                                    # code...
                                    $status       = "Close";
                                    $style_status = "display:none;";
                                    $style_tr     = "background-color: #FFC107;color: #fff;";
                                    $style_td     = "border-bottom: 1px solid #fff;border-top: 1px solid #fff;";
                                }
                            }
                            elseif ($list[$i]->status == 2) {
                                # code...
                                $status       = "Open";
                                $style_status = "";
                                $style_tr     = "background-color: #E91E63;color: #fff;";
                                $style_td     = "border-bottom: 1px solid #fff;border-top: 1px solid #fff;";
                                if ($list[$i]->edit_status == 3) {
                                    # code...
                                    $status       = "Open";
                                    $style_status = "display:none;";
                                    $style_tr     = "background-color: #FFC107;color: #fff;";
                                    $style_td     = "border-bottom: 1px solid #fff;border-top: 1px solid #fff;";
                                }
                            }
                            elseif ($list[$i]->status == 0) {
                                # code...
                                $style_tr     = "background-color: #FFC107;color: #fff;";                                
                            }
                            else
                            {
                                $status       = "Open"; 
                                $style_status = "";
                                if ($list[$i]->edit_status == 3) {
                                    # code...
                                    $status       = "Open";
                                    $style_status = "display:none;";
                                    $style_tr     = "background-color: #FFC107;color: #fff;";
                                }
                            }
                            
                            $flag_show = 1;
                            if($info_posisi[0]['kat_posisi'] == 1)
                            {
                                if ($list[$i]->kegiatan_skp_status != 1) {
                                    # code...
                                    if ($list[$i]->id_skp_master == 0) {
                                        # code...
                                        $flag_show = 1;                                        
                                    }                                 
                                    else
                                    {
                                        $flag_show = 0;
                                    }   
                                    // $style_tr     = "display:none;";       
                                }
                            }
                            elseif ($info_posisi[0]['kat_posisi'] == 2) {
                                # code...
                                if ($list[$i]->kegiatan_skp_jfu_status != 1) {
                                    # code...
                                    // $style_tr     = "display:none;";
                                    // $flag_show = 0;                                                                        
                                }                                
                            }                            
                            elseif ($info_posisi[0]['kat_posisi'] == 4) {
                                # code...
                                if ($list[$i]->kegiatan_skp_jfu_status != 1) {
                                    # code...
                                    // $style_tr     = "display:none;";                                    
                                    // $flag_show = 0;                                    
                                }                                
                            }    
                            elseif($info_posisi[0]['kat_posisi'] == 6)
                            {
                                if ($list[$i]->kegiatan_skp_status != 1) {
                                    # code...
                                    if ($list[$i]->id_skp_master == '') {
                                        # code...
                                        $flag_show = 1;                                        
                                    }                                 
                                    else
                                    {
                                        $flag_show = 0;
                                    }                                       
                                    // $style_tr     = "display:none;";       
                                }
                            }                                              
                            
                            if ($flag_show == 1) {
                                # code...
                                ?>
                                <tr style="<?=$style_tr;?>">
                                    <td style="<?=$style_td;?>">
                                        <span class="col-md-12 text-center"><i class="fa fa-dot-circle-o"></i></span>
                                    </td>
                                    <td style="<?=$style_td;?>text-align: -webkit-left;"><?=$kegiatan;?></td>
                                    <td style="<?=$style_td;?>"><?=$AK_target;?></td>
                                    <td style="<?=$style_td;?>"><?=$target_qty;?></td>
                                    <td style="<?=$style_td;?>"><?=$target_output;?></td>
                                    <td style="<?=$style_td;?>"><?=$target_kualitasmutu;?></td>
                                    <td style="<?=$style_td;?>"><?=$target_waktu_bln;?></td>
                                    <td style="<?=$style_td;?>">bln</td>
                                    <td style="<?=$style_td;?>"><?=$target_biaya;?></td>
                                    <td style="<?=$style_td;?>">
                                        <?php
                                            if ($list[$i]->status != 1) {
                                                # code...
                                        ?>
                                                <b><?=$list[$i]->remarks;?></b>                            
                                        <?php
                                            }
                                        ?>
                                    </td>
                                    <td style="<?=$style_td;?>">
                                        <?php 
                                           // if ($year_pass == $year_system) {
                                                # code...
                                        ?>
                                            <button class="btn btn-warning btn-xs" onclick="edit('<?=$list[$i]->skp_id;?>','<?=$list[$i]->status;?>','<?=$list[$i]->edit_status;?>')"><i class="fa fa-edit"></i>&nbsp;Ubah Target</button>
                                            &nbsp;
                                        <?php
                                                if ($list[$i]->kegiatan != NULL) 
                                                {
                                                    # code...
                                                    if ($list[$i]->status != 1) {
                                                        # code...
                                        ?>
                                                        <button class="btn btn-danger btn-xs" style="margin-top:10px;" onclick="del('<?=$list[$i]->skp_id;?>')"><i class="fa fa-edit"></i>&nbsp;Hapus Target</button>                            
                                        <?                                        
                                                    }
                                                }
                                           // }
                                        ?>

                                        <?php 
                                        // if ($list[$i]->PK == 1) {
                                        //     # code...
                                        //     if ($who_is == 'eselon 2') {
                                        //         # code...
                                        ?>
                                                <!-- <button class="btn btn-warning btn-xs" style="margin-top:5px;" onclick="kegiatan_es2('<?=$list[$i]->skp_id;?>')"><i class="fa fa-edit"></i>&nbsp;Kegiatan Eselon 3</button> -->
                                        <?php
                                        //     }
                                        //     elseif ($who_is == 'eselon 3') {
                                        //         # code...
                                        ?>
                                                 <!-- <button class="btn btn-warning btn-xs" style="margin-top:5px;" onclick="kegiatan_es3('<?=$list[$i]->skp_id;?>')"><i class="fa fa-edit"></i>&nbsp;Kegiatan Eselon 4</button> -->
                                        <?php                                    
                                        //     }                                
                                        // }
                                        ?>                            
                                    </td>
                                </tr>
                                <?php                                
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<div class="example-modal">
    <div class="modal modal-success fade" id="modal_calc_target" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="box-content">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title">Perhitungan Target</h1>
                    </div>
                    <div class="modal-body" style="background-color: #fff!important;">

                        <div class="box box-default">
                            <div class="box-body">
                                <div class="row">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>                                                                                                                


<!-- <div class="box">
		<div class="box-header">
			<h3 class="box-title" id="formdata-title"></h3>
			<div class="box-tools pull-right"><button class="btn btn-block btn-danger" id="closeData"><i class="fa fa-close"></i></button></div>				
		</div>
		<div class="box-body">
			<div class="row">
				<input class="form-control" type="hidden" id="oid">
				<input class="form-control" type="hidden" id="crud">					
				<div class="col-md-6">
					<div class="form-group">
						<label>Eselon 1</label>
						<input type="text" class="form-control" id="f_es1" placeholder="Eselon 1">
					</div>
				</div>
			</div>

		</div>/.box-body
		<div class="box-footer">
			<a class="btn btn-success pull-right" id="btn-trigger-controll"><i class="fa fa-save"></i>&nbsp; Simpan</a>
		</div>
	</div>/.box
</div> -->

<div class="example-modal">
    <div class="modal modal-success fade" id="formdata" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="box-content">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title">Formulir Sasaran Kerja Pegawai</h1>
                    </div>
                    <div class="modal-body" style="background-color: #fff!important;">

                        <div class="box box-default">
                            <div class="box-body">
                                <div class="row">
                                    
                                    <input type="hidden" id="oid" name="oid" class="form-control" >
                                    <input type="hidden" id="crud" name="crud" class="form-control" >

                                    <div class="form-group col-md-12" >
                                        <label style="color: #000;font-weight: 400;font-size: 19px;">Kegiatan Tugas Jabatan</label>
                                        <!-- <h3 id="header_kegiatan" style="border: 1px solid #d2d6de;padding: 10px;"></h3>                                         -->
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <input type="hidden" id="before" name="before" class="form-control" >
                                            <input type="hidden" id="after" name="after" class="form-control" >
                                            <!-- <input type="hidden" style="font-size: 25px;" id="nkegiatan" name="nkegiatan" class="form-control" disabled="disabled"> -->
                                            <textarea id="nkegiatan" name="nkegiatan" class="form-control" maxlength="1000"></textarea>
                                        </div>
                                    </div>

                                    <?php
                                        $only_jft = ($this->session->userdata('kat_posisi') != 2) ? "style='display:none;'" : '' ;
                                    ?>

                                    <div class="form-group col-md-12" <?=$only_jft;?>>
                                        <label style="color: #000;font-weight: 400;font-size: 19px;">Angka Kredit</label>
                                        <label class="pull-right" style="color: #000;font-weight: 400;font-size: 19px;">Untuk Koma, gunakan karakter titik.</label>                                        
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <input type="number" id="nak_target" name="nak_target" class="form-control" min="0" max="500">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6" style="display: none;">
                                        <label style="color: #000;font-weight: 400;font-size: 19px;">Perjanjian Kerja</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <select class="form-control tour-step step1" name="nperjanjian_kerja" id="nperjanjian_kerja">
                                                    <option value="">Pilih Satuan</option>
                                                    <option value="1">Ya</option>
                                                    <option value="0">Tidak</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label style="color: #000;font-weight: 400;font-size: 19px;">Jenis Output</label>
                                        <label class="pull-right" style="color: #000;font-weight: 400;font-size: 19px;"></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                <select class="form-control tour-step step1 input-controll" name="nsatuan" id="nsatuan">
                                                    <option value="">Pilih Satuan</option>
                                                    <?php $x=1;
                                                        foreach($satuan->result() as $row){?>
                                                        <option value="<?php echo $row->id;?>"><?php echo $row->nama;?></option>
                                                    <?php $x++;}    ?>
                                                </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label style="color: #000;font-weight: 400;font-size: 19px;">Target Kuantitas Per Tahun</label>
                                        <label class="pull-right" style="color: #000;font-weight: 400;font-size: 19px;"></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <input type="number" class="form-control input-controll" id="njumlah" name="njumlah" min="0">
                                            <!-- <span class="input-group-addon"><a class="btn btn-primary" id="btn-calc">Hitung Target</a></span>                                             -->
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6" style="display: none;">
                                        <label style="color: #000;font-weight: 400;font-size: 19px;">Jenis SKP</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                <select class="form-control tour-step step1" name="njenis" id="njenis">
                                                    <option value="">Pilih Satuan</option>
                                                    <?php $x=1;
                                                        foreach($jenis->result() as $row){?>
                                                        <option value="<?php echo $row->id;?>"><?php echo $x.". ".$row->nama;?></option>
                                                    <?php $x++;}    ?>
                                                </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12" style="display:none;">
                                        <label style="color: #000;font-weight: 400;font-size: 19px;">Target Kualitas Mutu</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <input type="text" id="nkualitas_mutu" name="nkualitas_mutu" class="form-control input-controll"  value="100" maxlength="100" disabled="disabled">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label style="color: #000;font-weight: 400;font-size: 19px;">Target Waktu</label>
                                        <label class="pull-right" style="color: #000;font-weight: 400;font-size: 19px;"></label>
                                        <div class="input-group col-lg-12">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <input type="number" id="nwaktu" name="nwaktu" class="form-control input-controll" min="0" max="12">                                            
                                            <span class="input-group-addon"><label id="param_qty_skp" style="font-size: 15px;">Bulan</label></span>                                            
                                        </div>
                                    </div>


                                    <?php
                                        $param_eselon_2 = "";
                                        $style_eselon_2 = "";
                                        if ($this->session->userdata('sesEs3') != 0) {
                                            # code...
                                            $param_eselon_2 = "disabled='disabled'";
                                            $style_eselon_2 = "style='display:none;'";
                                        }
                                    ?>
                                    <div class="form-group col-md-12" <?=$style_eselon_2;?>>
                                        <label style="color: #000;font-weight: 400;font-size: 19px;">Target Biaya</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <input type="number" id="nbiaya" name="nbiaya" class="form-control" <?=$param_eselon_2;?>>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                        <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
                        <input type="submit" class="btn btn-primary" value="Simpan" id="btn_save_skp_edit"/>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function edit(id,before,after) {
    // body...
    $.getJSON('<?php echo site_url() ?>/skp/target_skp/get_detail_skp/'+id,
        function( response ) {
            $('#formdata').attr('class', 'modal fade bs-example-modal-lg')
                                .attr('aria-labelledby','myLargeModalLabel');
            $('.modal-dialog').attr('class','modal-dialog modal-lg');
            $("#formdata").modal('show');
            $("#crud").val('update');
            
            if ($("#oid_kat_posisi").val() == 1) {
                // $("#nkegiatan").val(response['kegiatan']);
                if (response['id_skp_master'] != null && response['id_skp_master'] != 0)
                {
                    // $("#header_kegiatan").html(response['kegiatan_skp']);                    
                    $("#nkegiatan").val(response['kegiatan_skp']);
                }                
                else
                {
                    $("#nkegiatan").val(response['kegiatan']);                    
                }                                                
            } 
            else if($("#oid_kat_posisi").val() == 2) {
                // $("#nkegiatan").val(response['kegiatan']);
                if (response['id_skp_jft'] != null && response['id_skp_jft'] != 0)
                {
                    // $("#header_kegiatan").html(response['kegiatan_skp_jft']);                    
                    $("#nkegiatan").val(response['kegiatan_skp_jft']);
                }
                else
                {
                    $("#nkegiatan").val(response['kegiatan']);                    
                }                                
            }
            else if($("#oid_kat_posisi").val() == 4) {
                // $("#nkegiatan").val(response['kegiatan']);
                // console.log(response['kegiatan']);
                // console.log(response['id_skp_jfu']);                                
                if (response['id_skp_jfu'] != null && response['id_skp_jfu'] != 0)
                {
                    // $("#header_kegiatan").html(response['kegiatan_skp_jfu']);                    
                    $("#nkegiatan").val(response['kegiatan_skp_jfu']);
                }
                else
                {

                    $("#nkegiatan").val(response['kegiatan']);                    
                }                                                                                
            }
            else if ($("#oid_kat_posisi").val() == 6) {
                // $("#nkegiatan").val(response['kegiatan']);
                if (response['id_skp_master'] != null && response['id_skp_master'] != 0)
                {
                    // $("#header_kegiatan").html(response['kegiatan_skp']);                    
                    $("#nkegiatan").val(response['kegiatan_skp']);
                }                
                else
                {
                    $("#nkegiatan").val(response['kegiatan']);                    
                }                                                
            }             
            
            $("#njenis").val(response['jenis_skp']);
            $("#nperjanjian_kerja").val(response['PK']);
            $("#nak_target").val(response['ak_target']);
            $("#njumlah").val(response['target_qty']);
            $("#nsatuan").val(response['target_output']);

            // $("#nkualitas_mutu").val(response['target_kualitasmutu']);
            $("#nwaktu").val(response['target_waktu_bln']);
            $("#nbiaya").val(response['target_biaya']);

            $("#before").val(before);
            $("#after").val(after);
            $("#oid").val(response['skp_id']);
            setTimeout(function(){
                $("#loadprosess").modal('hide');
            }, 500);
        }
    );
}

function del(id) {
    // body...
    Lobibox.confirm({
        title: "Konfirmasi",
        msg: "Anda akan hapus Target SKP ini ?",
        callback: function ($this, type) {
            if (type === 'yes'){
                $.ajax({
                    url :"<?php echo site_url()?>/skp/target_skp/delete_skp/"+id,
                    type:"post",
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

function lookData(id,posisi) {
    var f_tahun = $("#f_tahun").val();
    window.location.href = "<?php echo site_url()?>skp/target_skp/data/"+f_tahun+"/"+id+"/"+posisi+"/";
}

// function kegiatan_es2(params) {
//     window.location.href = "<?=base_url();?>skp/kegiatan_es3/"+params;
// }

// function kegiatan_es3(params) {
//     window.location.href = "<?=base_url();?>skp/kegiatan_es4/"+params;
// }

$(document).ready(function()
{
    $("#btn-calc").click(function() {
        $('#modal_calc_target').attr('class', 'modal fade bs-example-modal-lg')
                            .attr('aria-labelledby','myLargeModalLabel');
        $('.modal_calc_target').attr('class','modal-dialog modal-lg');        
        $("#modal_calc_target").modal('show');
    })

    $("#addDataSKP").click(function(){
        // body...
        $('.form-control').val('');        
        $('#formdata').attr('class', 'modal fade bs-example-modal-lg')
                            .attr('aria-labelledby','myLargeModalLabel');
        $('.modal-dialog').attr('class','modal-dialog modal-lg');
        $("#formdata").modal('show');
        $("#crud").val('insert');
    })

    $("#btn_save_skp_edit").click(function() {
        // body...
        var oid           = $("#oid").val();
		var crud          = $("#crud").val();
        var kegiatan      = $('#nkegiatan').val();
        var pk            = $('#nperjanjian_kerja').val();
        var ak_target     = $('#nak_target').val();
        var jenis         = $('#njenis').val();
        var jumlah        = $('#njumlah').val();
        var kualitas_mutu = $('#nkualitas_mutu').val();
        var satuan        = $('#nsatuan').val();
        var waktu         = $('#nwaktu').val();
        var biaya         = $('#nbiaya').val();
        var oid           = $('#oid').val();
        var before        = $('#before').val();
        var after         = $('#after').val();

        $(this).css({"pointer-events":"none"});
        if (kegiatan.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Kegiatan tugas jabatan wajib diisi."
            });
            $(this).css({"pointer-events":""});
        }
        else if (jumlah.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Target Kuantitas wajib diisi."
            });
            $(this).css({"pointer-events":""});
        }
        else if (satuan.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Jenis output wajib diisi."
            });
            $(this).css({"pointer-events":""});
        }
        else if (waktu.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Target Waktu (Bulan) wajib diisi."
            });
            $(this).css({"pointer-events":""});
        }
        else
        {

            if (waktu > 12)
            {
                Lobibox.alert('warning', {
                    msg: 'Batas waktu (Bulan) Maksimal 12'
                });
                $(this).css({"pointer-events":""});
            }
            else if (waktu < 1)
            {
                Lobibox.alert('warning', {
                    msg: 'Batas waktu (Bulan) Minimal 1'
                });
                $(this).css({"pointer-events":""});
            }
            else if(jumlah < 1)
            {
                Lobibox.alert('warning', {
                    msg: 'Batas Target Kuantitas Minimal 1'
                });
                $(this).css({"pointer-events":""});
            }
            else if (ak_target > 100)
            {
                Lobibox.alert('warning', {
                    msg: 'Batas AK Kredit Maksimal 100'
                });
                $(this).css({"pointer-events":""});
            }
            else if (ak_target < 0)
            {
                Lobibox.alert('warning', {
                    msg: 'Batas AK Kredit Minimal 0'
                });
                $(this).css({"pointer-events":""});
            }
            else
            {
                var data_sender = {
                                        'kegiatan'      : kegiatan,
                                        'pk'            : pk,
                                        'jenis_skp'     : jenis,
                                        'ak_target'     : ak_target,
                                        'jumlah'        : jumlah,
                                        'satuan'        : satuan,
                                        'kualitas_mutu' : kualitas_mutu,
                                        'waktu'         : waktu,
                                        'biaya'         : biaya,
                                        'id'            : oid,
                                        'before'        : before,
                                        'after'         : after
                                };

                if (crud == 'update') 
                {
                    $.ajax({
                        url :"<?php echo site_url();?>/skp/target_skp/edit_skp_pegawai",
                        type:"post",
                        data:{data_sender : data_sender},
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
                else if (crud == 'insert') 
                {
                    $.ajax({
                        url :"<?php echo site_url();?>/skp/target_skp/ad_skp_pegawai_pk",
                        type:"post",
                        data:{data_sender : data_sender},
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
        }
    })

    $("#btn_save_skp_tambah").click(function() {
        // body...
        var kegiatan      = $('#nkegiatan').val();
        var pk            = $('#nperjanjian_kerja').val();
        var ak_target     = $('#nak_target').val();
        var jenis         = $('#njenis').val();
        var jumlah        = $('#njumlah').val();
        var kualitas_mutu = $('#nkualitas_mutu').val();
        var satuan        = $('#nsatuan').val();
        var waktu         = $('#nwaktu').val();
        var biaya         = $('#nbiaya').val();

        $(this).css({"pointer-events":"none"});
        if (kegiatan.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Kegiatan wajib diisi."
            });
            $(this).css({"pointer-events":""});
        }
        else if (jumlah.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Target Kuantitas wajib diisi."
            });
            $(this).css({"pointer-events":""});
        }
        else if (satuan.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Jenis output wajib diisi."
            });
            $(this).css({"pointer-events":""});
        }
        else if (waktu.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Target Waktu (Bulan) wajib diisi."
            });
            $(this).css({"pointer-events":""});
        }
        // else if (biaya.length <= 0)
        // {
        //     Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
        //     {
        //         msg: "Target/Alokasi Biaya wajib diisi."
        //     });
        //     $(this).css({"pointer-events":""});
        // }        
        else
        {

            if (waktu > 12)
            {
                Lobibox.alert('warning', {
                    msg: 'Batas waktu (Bulan) Maksimal 12'
                });
                $(this).css({"pointer-events":""});
            }
            else if (waktu < 1)
            {
                Lobibox.alert('warning', {
                    msg: 'Batas waktu (Bulan) Minimal 1'
                });
                $(this).css({"pointer-events":""});
            }
            else if(jumlah > 100)
            {
                Lobibox.alert('warning', {
                    msg: 'Batas Target Kuantitas Maksimal 100'
                });
                $(this).css({"pointer-events":""});
            }
            else if(jumlah < 1)
            {
                Lobibox.alert('warning', {
                    msg: 'Batas Target Kuantitas Minimal 1'
                });
                $(this).css({"pointer-events":""});
            }
            else if (ak_target > 100)
            {
                Lobibox.alert('warning', {
                    msg: 'Batas AK Kredit Maksimal 100'
                });
                $(this).css({"pointer-events":""});
            }
            else if (ak_target < 0)
            {
                Lobibox.alert('warning', {
                    msg: 'Batas AK Kredit Minimal 0'
                });
                $(this).css({"pointer-events":""});
            }
            else
            {
                var data_sender = {
                                        'pk'           : pk,
                                        'kegiatan'     : kegiatan, 
                                        'jenis_skp'    : jenis,
                                        'ak_target'    : ak_target,
                                        'jumlah'       : jumlah,
                                        'satuan'       : satuan,
                                        'kualitas_mutu': kualitas_mutu,
                                        'waktu'        : waktu,
                                        'biaya'        : biaya
                                };
                $.ajax({
                    url :"<?php echo site_url();?>/skp/target_skp/ad_skp_pegawai_pk",
                    type:"post",
                    data:{data_sender : data_sender},
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

});
</script>
