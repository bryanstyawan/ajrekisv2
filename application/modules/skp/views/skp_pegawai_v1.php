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
    text-align: ;
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
                        <label class="col-sm-3">Perubahan data yang Telah Disetujui :</label>
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
            <div class ="box-tools">
                <!-- <h3 class  ="box-title pull-right"><button class="btn btn-block btn-primary" id="addDataSKP"><i class="fa fa-plus-square"></i> Tambah SKP Pegawai</button></h3>             -->
            </div>
            <div class="col-md-3">
                <label style="color: #000;font-weight: 400;font-size: 19px;display: -webkit-inline-box;">
                    Tahun&nbsp;:&nbsp;&nbsp;
                    <select class="form-control input-sm" name="tahun" id="tahun"></select>                    
                </label>
            </div>                             
        </div>
        <div class="box-body">
            <table id="table_skp" class="table table-bordered table-striped table-view" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Kegiatan tugas jabatan</th>
                        <th style="width: 10%;" rowspan="2">Perjanjian Kerja</th>
                        <th rowspan="2">Jenis SKP</th>
                        <th style="max-width: 40px!important;width: 40px!important;" rowspan="2">AK</th>
                        <th colspan="6">Target</th>
                        <th style="width: 5%;" rowspan="2">Keterangan</th>
                        <th style="width: 5%;" rowspan="2">Status</th>
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
                            if ($list[$i]->id_skp_master != '') {
                                # code...
                                $kegiatan            = $list[$i]->kegiatan_skp;                                
                            }
                            $AK_target           = $list[$i]->AK_target;
                            $target_qty          = $list[$i]->target_qty;
                            $target_output       = $list[$i]->target_output_name;
                            $target_kualitasmutu = $list[$i]->target_kualitasmutu;
                            $target_waktu_bln    = $list[$i]->target_waktu_bln;
                            $target_biaya        = $list[$i]->target_biaya;
                            $jenis_skp           = $list[$i]->nama_jenis_skp;

                            if (count($list) == 1) {
                                # code...
                                $arrow_up   = "display:none;";
                                $arrow_down = "display:none;";                                            
                            }
                            else
                            {
                                if ($i == 0) {
                                    # code...
                                    $arrow_up   = "display:none;";
                                    $arrow_down = "";                                
                                }
                                elseif ($i == (count($list)-1)) {
                                    # code...
                                    $arrow_up   = "";
                                    $arrow_down = "display:none;";                                
                                }
                                else
                                {
                                    $arrow_up   = "";
                                    $arrow_down = "";                                
                                }
                            }



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
                                    $target_output = "<span class='data-before'>".$list[$i]->target_output."</span> <i class='fa fa-angle-double-right'></i> <span class='data-after'>".$list[$i]->edit_target_output_name."</span>";
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
                                    $target_biaya = "<span class='data-before'>".$list[$i]->target_biaya."</span> <i class='fa fa-angle-double-right'></i> <span class='data-after'>".$list[$i]->edit_target_biaya."</span>";
                                }                                                                
                            }

                            if ($list[$i]->PK == 1) {
                                # code...
                                $pk_status = "Ya";
                            }
                            else
                            {
                                $pk_status = "Tidak";
                            }                           

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
                    ?>
                    <tr style="<?=$style_tr;?>">
                        <td style="<?=$style_td;?>">
                            <span class="col-md-12 pull-left">
                                <a href="#" class="col-md-12" style="<?=$arrow_up;?><?=$style_tr;?>" onclick="arrow_up('<?=$list[$i]->skp_id;?>')"><i class="fa fa-arrow-up"></i></a>
                            </span>
                            <span class="col-md-12 text-center"><?=$i+1;?></span>
                            <span class="col-md-12 pull-left">                            
                                <a href="#" class="col-md-12" style="<?=$arrow_down;?><?=$style_tr;?>" onclick="arrow_down('<?=$list[$i]->skp_id;?>')"><i class="fa fa-arrow-down"></i></a>                            
                            </span>                                
                        </td>
                        <td style="<?=$style_td;?>text-align: -webkit-left;"><?=$kegiatan;?></td>
                        <td style="<?=$style_td;?>"><?=$pk_status;?></td>
                        <td style="<?=$style_td;?>"><?=$jenis_skp;?></td>
                        <td style="<?=$style_td;?>"><?=$AK_target;?></td>
                        <td style="<?=$style_td;?>"><?=$target_qty;?></td>
                        <td style="<?=$style_td;?>"><?=$target_output;?></td>
                        <td style="<?=$style_td;?>"><?=$target_kualitasmutu;?></td>
                        <td style="<?=$style_td;?>"><?=$target_waktu_bln;?></td>
                        <td style="<?=$style_td;?>">bln</td>
                        <td style="<?=$style_td;?>"><?=number_format($target_biaya);?></td> 
                        <td style="<?=$style_td;?>"><b><?=$list[$i]->remarks;?></b></td>
                        <td style="<?=$style_td;?>"><?=$status;?></td>
                        <td style="<?=$style_td;?>">
                            <button class="btn btn-warning btn-xs" onclick="edit('<?=$list[$i]->skp_id;?>','<?=$list[$i]->status;?>','<?=$list[$i]->edit_status;?>')"><i class="fa fa-edit"></i>&nbsp;Ubah</button>                                                                                
                            <!-- <button class="btn btn-danger btn-xs" style="<?=$style_status;?>" onclick="del('<?=$list[$i]->skp_id;?>')"><i class="fa fa-trash"></i>&nbsp;Hapus</button>                                                                                                             -->
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


<!-- <div class="example-modal">
<div class="modal modal-success fade" id="tambah_dataskp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="box-content">
        
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Formulir Sasaran Kerja Pegawai</h4>
                </div>
                <div class="modal-body" style="background-color: #fff!important;">

                    <div class="box box-default">
                        <div class="box-body">
                            <div class="row">

                                <div class="form-group col-md-12">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Kegiatan Tugas Jabatan</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <textarea id="kegiatan" name="kegiatan" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Angka Kredit</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="number" id="ak_target" name="ak_target" class="form-control">
                                    </div>
                                </div>                                                                                                                   

                                <div class="form-group col-md-6">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Perjanjian Kerja</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <select class="form-control tour-step step1" name="perjanjian_kerja" id="perjanjian_kerja">
                                                    <option value="">Pilih Satuan</option>
                                                    <option value="1">Ya</option>
                                                    <option value="0">Tidak</option>
                                            </select>
                                    </div>
                                </div>                                    

                                <div class="form-group col-md-6">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Jenis SKP</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <select class="form-control tour-step step1" name="jenis" id="jenis">
                                                    <option value="">Pilih Satuan</option>
                                                <?php $x=1; 
                                                    foreach($jenis->result() as $row){?>
                                                    <option value="<?php echo $row->id;?>"><?php echo $x.". ".$row->nama;?></option>
                                                <?php $x++;}    ?>
                                            </select>
                                    </div>
                                </div>                                    

                                <div class="form-group col-md-6">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Target Kuantitas</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="number" id="jumlah" name="jumlah" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Jenis Output</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <select class="form-control tour-step step1" name="satuan" id="satuan">
                                                    <option value="">Pilih Satuan</option>
                                                <?php $x=1; 
                                                    foreach($satuan->result() as $row){?>
                                                    <option value="<?php echo $row->id;?>"><?php echo $x.". ".$row->nama;?></option>
                                                <?php $x++;}    ?>
                                            </select>
                                    </div>
                                </div>                                                    

                                <div class="form-group col-md-12">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Target Kualitas Mutu</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="number" id="kualitas_mutu" name="kualitas_mutu" class="form-control" value="100" disabled="disabled" value="100">
                                    </div>
                                </div>                                                                        

                                <div class="form-group col-md-12">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Target Waktu (Bulan)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="number" id="waktu" name="waktu" class="form-control" >
                                    </div>
                                </div>                                                                        

                                <div class="form-group col-md-12">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Target Biaya</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="number" id="biaya" name="biaya" class="form-control" >
                                    </div>
                                </div>                                                                                                        
                                       
                                                                                
                            </div>
                        </div>                            
                    </div>


                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
                    <input type="submit" class="btn btn-primary" value="Simpan" id="btn_save_skp"/>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</div> -->


<div class="example-modal">
<div class="modal modal-success fade" id="ubah_dataskp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="box-content">
        
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Formulir Sasaran Kerja Pegawai</h4>
                </div>
                <div class="modal-body" style="background-color: #fff!important;">

                    <div class="box box-default">
                        <div class="box-body">
                            <div class="row">

                                <div class="form-group col-md-12">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Kegiatan Tugas Jabatan</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="hidden" id="oid" name="oid" class="form-control" >
                                        <input type="hidden" id="before" name="before" class="form-control" >                                                                                
                                        <input type="hidden" id="after" name="after" class="form-control" >                                                                                                                        
                                        <textarea id="nkegiatan" name="nkegiatan" class="form-control" disabled="disabled"></textarea>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Angka Kredit</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="number" id="nak_target" name="nak_target" class="form-control">
                                    </div>
                                </div>                                   

                                <div class="form-group col-md-6">
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

                                <div class="form-group col-md-6">
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

                                <div class="form-group col-md-6">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Target Kuantitas</label>
                                    <label class="pull-right" style="color: #000;font-weight: 400;font-size: 19px;">*Wajib diisi</label>                                    
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="number" id="njumlah" name="njumlah" class="form-control" maxlength="100">
                                    </div>
                                </div>                               

                                <div class="form-group col-md-6">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Jenis Output</label>
                                    <label class="pull-right" style="color: #000;font-weight: 400;font-size: 19px;">*Wajib diisi</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <select class="form-control tour-step step1" name="nsatuan" id="nsatuan">
                                                    <option value="">Pilih Satuan</option>
                                                <?php $x=1; 
                                                    foreach($satuan->result() as $row){?>
                                                    <option value="<?php echo $row->id;?>"><?php echo $x.". ".$row->nama;?></option>
                                                <?php $x++;}    ?>
                                            </select>
                                    </div>
                                </div>          

                                <div class="form-group col-md-12">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Target Kualitas Mutu</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="text" id="nkualitas_mutu" name="nkualitas_mutu" class="form-control"  value="100" maxlength="100" disabled="disabled">
                                    </div>
                                </div>                                                                        

                                <div class="form-group col-md-12">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Target Waktu (Bulan)</label>
                                    <label class="pull-right" style="color: #000;font-weight: 400;font-size: 19px;">*Wajib diisi</label>                                    
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="number" id="nwaktu" name="nwaktu" class="form-control" >
                                    </div>
                                </div>                                                                        
                                

                                <?php
                                    $param_eselon_2 = "";
                                    if ($this->session->userdata('sesEs3') != 0) {
                                        # code...
                                        $param_eselon_2 = "disabled='disabled'";
                                    }                                
                                ?>
                                <div class="form-group col-md-12">
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


<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-1.12.4.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
function edit(id,before,after) {
    // body...
    $.getJSON('<?php echo site_url() ?>/skp/get_detail_skp/'+id,
        function( response ) {
            $('#ubah_dataskp').attr('class', 'modal fade bs-example-modal-lg')
                         .attr('aria-labelledby','myLargeModalLabel');
            $('.modal-dialog').attr('class','modal-dialog modal-lg');        
            $("#ubah_dataskp").modal('show');    
            
            $("#nkegiatan").val(response['kegiatan']);
            if (response['id_skp_master'] != '') 
            {
                $("#nkegiatan").val(response['kegiatan_skp']);
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
            }, 1000);                                           
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
                    url :"<?php echo site_url()?>/skp/delete_skp/"+id,
                    type:"post",
                    beforeSend:function(){
                        $("#loadprosess").modal('show');                
                    },                                      
                    success:function(msg){
                        var obj = jQuery.parseJSON (msg);             
                        if (obj.status == 1) 
                        {
                            Lobibox.notify('success', {
                                msg: obj.text
                                });
                            setTimeout(function(){ 
                                $("#loadprosess").modal('hide');
                                setTimeout(function(){
                                    location.reload();
                                }, 1500);                                                                   
                            }, 5000);                
                        }
                        else
                        {
                            Lobibox.notify('success', {
                                msg: obj.text
                                });
                            setTimeout(function(){ 
                                $("#loadprosess").modal('hide');                                
                            }, 5000);                                                                           
                        }                                               
                    },
                    error:function(){
                        Lobibox.notify('error', {
                            msg: 'Gagal melakukan transaksi '
                        });
                    }
                })
            }
        }
    })       
}

function arrow_up(id) {
    // body...
    $.ajax({
        url :"<?php echo site_url();?>/skp/change_priority/"+id+"/up",
        type:"post",
        beforeSend:function(){
            $("#editData").modal('hide');
            $("#loadprosess").modal('show');                                                
        },
        success:function(msg){
            var obj = jQuery.parseJSON (msg);             
            if (obj.status == 1) 
            {
                Lobibox.notify('success', {
                    msg: obj.text
                    });
                setTimeout(function(){ 
                    $("#loadprosess").modal('hide');
                    setTimeout(function(){
                        location.reload();
                    }, 1500);                                                                   
                }, 5000);                
            }
            else
            {
                Lobibox.notify('success', {
                    msg: obj.text
                    });
                setTimeout(function(){ 
                    $("#loadprosess").modal('hide');                                
                }, 5000);                                                                           
            }           
        },
        error:function(){
            Lobibox.notify('error', {
                msg: 'Gagal Menambah Pekerjaan'
            });
        }
    })        
}

function arrow_down(id) {
    // body...
    $.ajax({
        url :"<?php echo site_url();?>/skp/change_priority/"+id+"/down",
        type:"post",
        beforeSend:function(){
            $("#editData").modal('hide');
            $("#loadprosess").modal('show');                                                
        },
        success:function(msg){
            var obj = jQuery.parseJSON (msg);             
            if (obj.status == 1) 
            {
                Lobibox.notify('success', {
                    msg: obj.text
                    });
                setTimeout(function(){ 
                    $("#loadprosess").modal('hide');
                    setTimeout(function(){
                        location.reload();
                    }, 500);                                                                   
                }, 1000);                
            }
            else
            {
                Lobibox.notify('success', {
                    msg: obj.text
                    });
                setTimeout(function(){ 
                    $("#loadprosess").modal('hide');                                
                }, 5000);                                                                           
            }           
        },
        error:function(){
            Lobibox.notify('error', {
                msg: 'Gagal Menambah Pekerjaan'
            });
        }
    })            
}

$(document).ready(function()
{
    $(".table-view").DataTable({
        "oLanguage": {
            "sSearch": "Pencarian :",
            "sSearchPlaceholder" : "Ketik untuk mencari",
            "sLengthMenu": "Menampilkan data&nbsp; _MENU_ &nbsp;Data",
            "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "sZeroRecords": "Data tidak ditemukan"  
        },
        "dom": "<'row'<'col-sm-6'f><'col-sm-6'l>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>" +           
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "bSort": false,                        
        "bAutoWidth": false
        // "dom": '<"top"f>rt'
        // "dom": '<"top"fl>rt<"bottom"ip><"clear">'            
    });

    $("#addDataSKP").click(function(){
        // body...
        $('#tambah_dataskp').attr('class', 'modal fade bs-example-modal-lg')
                     .attr('aria-labelledby','myLargeModalLabel');
        $('.modal-dialog').attr('class','modal-dialog modal-lg');        
        $("#tambah_dataskp").modal('show');
    })

    $("#btn_save_skp").click(function() {
        // body...
        var kegiatan      = $('#kegiatan').val();
        var pk            = $('#perjanjian_kerja').val();        
        var jenis         = $('#jenis').val();                
        var ak_target     = $('#ak_target').val();
        var jumlah        = $('#jumlah').val();
        var kualitas_mutu = $('#kualitas_mutu').val();
        var satuan        = $('#satuan').val();
        var waktu         = $('#waktu').val();        
        var biaya         = $('#biaya').val();        

        if (kegiatan.length <= 0) 
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Kegiatan tugas jabatan wajib diisi."
            });            
        }
        else
        {
            if (waktu > 12) 
            {
                Lobibox.notify('warning', {
                    msg: 'Batas waktu (Bulan) Maksimal 12'
                });                            
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
                                        'biaya'         : biaya
                                  };                    
                $.ajax({
                    url :"<?php echo site_url();?>/skp/add_skp_pegawai",
                    type:"post",
                    data:{data_sender : data_sender},
                    beforeSend:function(){
                        $("#editData").modal('hide');
                        $("#loadprosess").modal('show');                                                
                    },
                    success:function(msg){
                        var obj = jQuery.parseJSON (msg);             
                        if (obj.status == 1) 
                        {
                            Lobibox.notify('success', {
                                msg: obj.text
                                });
                            setTimeout(function(){ 
                                $("#loadprosess").modal('hide');
                                setTimeout(function(){
                                    location.reload();
                                }, 1500);                                                                   
                            }, 5000);                
                        }
                        else
                        {
                            Lobibox.notify('warning', {
                                msg: obj.text
                                });
                            setTimeout(function(){ 
                                $("#loadprosess").modal('hide');                                
                            }, 5000);                                                                           
                        }           
                    },
                    error:function(){
                        Lobibox.notify('error', {
                            msg: 'Gagal Menambah Pekerjaan'
                        });
                    }
                })                
            }
        }
    })



    $("#btn_save_skp_edit").click(function() {
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
                $.ajax({
                    url :"<?php echo site_url();?>/skp/edit_skp_pegawai",
                    type:"post",
                    data:{data_sender : data_sender},
                    beforeSend:function(){
                        $("#editData").modal('hide');
                        $("#loadprosess").modal('show');                                                
                    },
                    success:function(msg){
                        var obj = jQuery.parseJSON (msg);             
                        if (obj.status == 1) 
                        {
                            Lobibox.notify('success', {
                                msg: obj.text
                                });
                            setTimeout(function(){ 
                                $("#loadprosess").modal('hide');
                                setTimeout(function(){
                                    location.reload();
                                }, 1500);                                                                   
                            }, 5000);                
                        }
                        else
                        {
                            Lobibox.notify('success', {
                                msg: obj.text
                                });
                            setTimeout(function(){ 
                                $("#loadprosess").modal('hide');                                
                            }, 5000);                                                                           
                        }           
                    },
                    error:function(){
                        Lobibox.notify('error', {
                            msg: 'Gagal Menambah Pekerjaan'
                        });
                    }
                }) 
            }                
        }
    })    

});
</script>