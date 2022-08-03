<?php
    $atasan1     = $atasan; 
    $atasan2     = $atasan_plt;
    $evaluator1  = $evaluator;
    $atasan_nama = "";

    $nama_pegawai  = "";
    $nama_jabatan  = "";
    $nama_eselon1  = "";
    $nama_eselon2  = "";
    $nama_eselon3  = "";
    $nama_eselon4  = "";
    $nip           = "";
    $kelas_jabatan = "";
    $pangkat       = "";
    $ruang         = "";
    $tmt_pangkat  = "";
    $kat_posisi    = "";
    $nama_posisi_cetak  = "";
    
    if ($infoPegawai != 0 || $infoPegawai != '') {

        # code...
    
        $nama_pegawai  = $infoPegawai[0]->nama_pegawai;
        $nama_jabatan  = $infoPegawai[0]->nama_jabatan;
        $nama_eselon1  = $infoPegawai[0]->nama_eselon1;
        $nama_eselon2  = $infoPegawai[0]->nama_eselon2;
        $nama_eselon3  = $infoPegawai[0]->nama_eselon3;
        $nama_eselon4  = $infoPegawai[0]->nama_eselon4;
        $nip           = $infoPegawai[0]->nip;
        $kelas_jabatan = $infoPegawai[0]->kelas_jabatan;
        $pangkat       = $infoPegawai[0]->nama_pangkat;
        $kat_posisi    = $infoPegawai[0]->kat_posisi;
    
        if ($kat_posisi == 1) {
            # code...
            // $nama_jabatan = 
        } 
        elseif($kat_posisi == 2) {
            # code...
        }
        elseif($kat_posisi == 4) {
            # code...
        }
        elseif($kat_posisi == 6) {
            # code...
        }
        
        // $pangkat     = ($infoPegawai[0]->nama_pangkat != '-') ? $infoPegawai[0]->nama_pangkat : '' ;
        // $ruang       = ($infoPegawai[0]->nama_golongan != '-') ? ', ('.$infoPegawai[0]->nama_golongan.') ' : '' ;
        // $tmt_pangkat = ($infoPegawai[0]->tmt_pangkat != '-') ? $infoPegawai[0]->tmt_pangkat : '' ;    
    }    
?>

<div class="col-xs-12">
    <!-- <div class="box"> -->
        <div class="row container" >
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#penilaian_kinerja" aria-controls="penilaian_kinerja" role="tab" data-toggle="tab">Penilaian Kinerja</a></li>
                <li role="presentation" ><a href="#pegawai_terbaik" aria-controls="pegawai_terbaik" role="tab" data-toggle="tab">Pegawai Terbaik</a></li>                
            </ul>

            <div class="tab-content" style="margin-top: 30px;">
                <div role="tabpanel" class="tab-pane active" id="penilaian_kinerja">
                    <div id="view_index">
                        <div class="col-md-4">
                            <div class="box box-solid" id="isi_kontak">

                                <div class="box-header with-border">
                                    <h3 class="box-title">Kandidat Evaluator</h3>
                                </div>
                                <div class="box-body no-padding" style="display: block;">
                                    <ul class="nav nav-pills nav-stacked contact-id">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Atasan</h3>
                                            </div>                                    
                                            <?php
                                                $i = 0;
                                                if($atasan != 0)
                                                {
                                                    foreach($atasan as $atasan)
                                                    {
                                                        $i++;
                                                        $atasan_nama = $atasan->nama_pegawai;
                                                ?>
                                                        <li style="cursor: pointer;background-color: rgb(76, 175, 80);color: rgb(255, 255, 255);" id="li_kandidat_<?=$i;?>"><a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i><?=$atasan->nama_pegawai;?></a><input type="hidden" id="hdn_pegawai_<?=$i;?>" name="list_kandidat" value="<?=$atasan->id;?>"></input>
                                                            <input type="hidden" id="hdn_pegawai_posisi_<?=$i;?>" value="<?=$atasan->posisi;?>"></input>                                
                                                        </li>                                    
                                                <?php
                                                    }
                                                }                    

                                                if ($atasan_plt != 0) {
                                                    # code...
                                                    foreach($atasan_plt as $atasan_plt)
                                                    {
                                                        $i++;
                                            ?>
                                                        <li style="cursor: pointer;background-color: rgb(76, 175, 80);color: rgb(255, 255, 255);" id="li_kandidat_<?=$i;?>">
                                                            <a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i>[PLT] <?=$atasan_plt->nama_pegawai;?></a>
                                                            <input type="hidden" id="hdn_pegawai_<?=$i;?>" name="list_kandidat" value="<?=$atasan_plt->id;?>"></input>
                                                            <input type="hidden" id="hdn_pegawai_posisi_<?=$i;?>" value="<?=$atasan_plt->posisi;?>"></input>                                    
                                                        </li>                                    
                                            <?php
                                                    }                            
                                                }
                                            ?>            
                                    </ul>
                                </div>
                                <div class="box-body no-padding" style="display: block;">
                                    <ul class="nav nav-pills nav-stacked contact-id">
                                        <?php
                                            if($peer != 0){
                                                // $i = 0;
                                        ?>
                                            <div class="box-header with-border">
                                                <h3 class="box-title"><i>PEER</i></h3>
                                            </div>                    
                                        <?php
                                                foreach($peer as $peer){
                                                    $i++;
                                                    if ($this->session->userdata('sesNama') != $peer->nama_pegawai) 
                                                    {
                                                        # code...
                                                        if ($atasan_nama != $peer->nama_pegawai) {
                                                            # code...
                                        ?>
                                                            <li style="cursor: pointer;" onclick="set_evaluator('<?=$peer->id;?>','<?=$peer->nama_pegawai;?>','<?=$peer->posisi;?>')" id="li_kandidat_<?=$i;?>">
                                                                <a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i><?=$peer->nama_pegawai;?></a>
                                                                <input type="hidden" id="hdn_pegawai_<?=$i;?>" name="list_kandidat" value="<?=$peer->id;?>"></input>
                                                                <input type="hidden" id="hdn_pegawai_posisi_<?=$i;?>" value="<?=$peer->posisi;?>"></input>                                        
                                                            </li>                                    
                                        <?php                                    
                                                        }
                                                    }
                                                }
                                            }
                                        ?>            
                                    </ul>
                                </div>        
                                <div class="box-body no-padding" style="display: block;">
                                    <ul class="nav nav-pills nav-stacked contact-id">
                                        <?php
                                            if($bawahan != 0){
                                                // $i = "";
                                        ?>
                                            <div class="box-header with-border">
                                                <h3 class="box-title"><i>Bawahan</i></h3>
                                            </div>                    
                                        <?php
                                                foreach($bawahan as $bawahan){
                                                    $i++;
                                        ?>
                                                    <li style="cursor: pointer;" onclick="set_evaluator('<?=$bawahan->id;?>','<?=$bawahan->nama_pegawai;?>','<?=$bawahan->posisi;?>')" id="li_kandidat_<?=$i;?>">
                                                        <a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i><?=$bawahan->nama_pegawai;?></a>
                                                        <input type="hidden" id="hdn_pegawai_<?=$i;?>" name="list_kandidat" value="<?=$bawahan->id;?>"></input>
                                                        <input type="hidden" id="hdn_pegawai_posisi_<?=$i;?>" value="<?=$bawahan->posisi;?>"></input>                                
                                                    </li>                            
                                        <?php
                                                }
                                            }
                                        ?>

                                        <?php
                                            if($bawahan_plt != 0){
                                                // $i = "";
                                                foreach($bawahan_plt as $bawahan){
                                                    $i++;
                                        ?>
                                                    <li style="cursor: pointer;" onclick="set_evaluator('<?=$bawahan->id;?>','<?=$bawahan->nama_pegawai;?>','<?=$bawahan->posisi;?>')" id="li_kandidat_<?=$i;?>">
                                                        <a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i><?=$bawahan->nama_pegawai;?></a>
                                                        <input type="hidden" id="hdn_pegawai_<?=$i;?>" name="list_kandidat" value="<?=$bawahan->id;?>"></input>
                                                        <input type="hidden" id="hdn_pegawai_posisi_<?=$i;?>" value="<?=$bawahan->posisi;?>"></input>                                
                                                    </li>                            
                                        <?php
                                                }
                                            }
                                        ?>                            
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="box box-solid" id="isi_kontak">

                                <div class="box-header with-border">
                                    <h3 class="box-title">Evaluator</h3>
                                </div>
                                <div id="evaluator" class="box-body no-padding" style="display: block;">
                                    <ul class="nav nav-pills nav-stacked contact-evaluator">
                                            <?php

                                                $atasan_temp = "";
                                                $atasan_nama = "";
                                                if ($evaluator != 0) {
                                                    # code...
                                                    if ($atasan1 != 0) {
                                                        # code...
                                                        foreach($atasan1 as $atasan1){
                                                            $i++;
                                                            $atasan_temp = $atasan1->nama_pegawai;
                                                ?>
                                                            <li style="cursor: pointer;" id="1">
                                                                <a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i><?=$atasan1->nama_pegawai;?></a>
                                                                <input type="hidden" name="list_evaluator" id="list_evaluator_0" value="<?=$atasan1->id;?>"></input>
                                                                <input type="hidden" id="list_evaluator_posisi_0" value="<?=$atasan1->posisi;?>"></input>                                            
                                                                <input type="hidden" id="sources_1" value="local">
                                                            </li>
                                                <?php
                                                        }                                
                                                    }

                                                    if ($atasan2 != 0) {
                                                        # code...
                                                        foreach($atasan2 as $atasan2){
                                                            $i++;
                                                            $atasan_temp = $atasan2->nama_pegawai;
                                                ?>
                                                            <li style="cursor: pointer;" id="1"><a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i>[PLT] <?=$atasan2->nama_pegawai;?></a><input type="hidden" name="list_evaluator" id="list_evaluator_0" value="<?=$atasan2->id;?>"></input><input type="hidden" id="sources_2" value="local">
                                                                <input type="hidden" id="list_evaluator_posisi_0" value="<?=$atasan2->posisi;?>"></input>                                    
                                                            </li>
                                                <?php
                                                        }                                
                                                    }                            
                                                }
                                                else
                                                {
                                                    if ($atasan1 != 0) {
                                                        # code...
                                                        foreach($atasan1 as $atasan1){
                                                            $i++;
                                                            $atasan_temp = $atasan1->nama_pegawai;
                                                ?>
                                                            <li style="cursor: pointer;" id="1"><a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i><?=$atasan1->nama_pegawai;?></a><input type="hidden" name="list_evaluator" id="list_evaluator_0" value="<?=$atasan1->nama_pegawai;?>"></input><input type="hidden" id="sources_1" value="local">
                                                                <input type="hidden" id="list_evaluator_posisi_0" value="<?=$atasan1->posisi;?>"></input>                                    
                                                            </li>
                                                <?php
                                                        }                                
                                                    }

                                                    if ($atasan2 != 0) {
                                                        # code...
                                                        foreach($atasan2 as $atasan2){
                                                            $i++;
                                                            $atasan_temp = $atasan2->nama_pegawai;
                                                ?>
                                                            <li style="cursor: pointer;" id="1"><a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i>[PLT] <?=$atasan2->nama_pegawai;?></a><input type="hidden" name="list_evaluator" id="list_evaluator_0" value="<?=$atasan2->id;?>"></input><input type="hidden" id="sources_2" value="local">
                                                                <input type="hidden" id="list_evaluator_posisi_0" value="<?=$atasan2->posisi;?>"></input>                                    
                                                            </li>
                                                <?php
                                                        }                                
                                                    }                            

                                                }

                                                if ($evaluator != 0) {
                                                    # code...
                                                    $x = 1;
                                                    for ($i=0; $i < count($evaluator); $i++) { 
                                                        # code...
                                                        if ($atasan_temp != $evaluator[$i]->nama_pegawai) {
                                                            # code...
                                                            $remove_icon = "";
                                                            $remove_cmd  = "";
                                                            $lock_icon   = "";
                                                            if ($evaluator[$i]->status == 0) {
                                                                # code...
                                                                $remove_icon = '<span class="pull-right" style="padding-bottom: 0px;padding-top: 0px;"><i class="fa fa-close"></i></span>';
                                                                $remove_cmd = 'onclick="remove_list_evaluator_sync('.$x.','.$evaluator[$i]->id_pegawai_penilai.')"';
                                                                $lock_icon = 'fa-circle-o';
                                                            }
                                                            else
                                                            {
                                                                $lock_icon = 'fa-lock';                                        
                                                            }
                                            ?>
                                                            <li style="cursor: pointer;" id="li_evaluator_<?=$x;?>" <?=$remove_cmd;?>>
                                                                <a class="contact-name"><i class="fa <?=$lock_icon;?> text-red contact-name-list"></i><?=$evaluator[$i]->nama_pegawai.$remove_icon;?></a>
                                                                <input type="hidden" name="list_evaluator" id="list_evaluator_<?=$x;?>" value="<?=$evaluator[$i]->id_pegawai_penilai;?>"></input>
                                                                <input type="hidden" id="list_evaluator_posisi_<?=$x;?>" value="<?=$evaluator[$i]->id_posisi_pegawai_penilai;?>"></input>                                        
                                                                <input type="hidden" id="sources_<?=$x;?>" value="server"></li>
                                                            </li>                    
                                            <?php                                    
                                            $x++;
                                                        }
                                                    }
                                                }
                                            ?>
                                    </ul>
                                </div>
                                <div class="box-body">
                                    <!-- <div class="col-md-12">
                                        <button class="btn btn-default pull-right" id="btn-save-eval">Ajukan Penilai</button>
                                    </div> -->
                                </div>
                            </div>
                        </div> 
                        
                        <div class="col-md-4">
                            <div class="box box-solid"> 
                                <div class="box-header with-border">
                                    <h3 class="box-title">Permintaan untuk Penilaian Kinerja</h3>
                                </div>
                                <div class="box-body" style="display: block;">
                                <?php
                                    if ($request_eval != 0) {
                                        # code...
                                        for ($i=0; $i < count($request_eval); $i++) { 
                                            # code...
                                            $data_link_a = "";
                                            $data_link_a = base_url() . 'public/images/pegawai/'.$request_eval[$i]->photo; 

                                            $data_done      = "";
                                            $data_done_span = "";
                                            if ($request_eval[$i]->status != NULL) {
                                                # code...
                                                if ($request_eval[$i]->status == 1) {
                                                    # code...
                                                    $data_done      = "background-color: #4caf50;";                            
                                                    $data_done_span = "color:#fff;";                            
                                                }
                                            }
                                            else {
                                                # code...
                                                $data_done      = "";         
                                                $data_done_span = "";                                       
                                            }
                                ?>
                                            <a class="btn btn-app col-lg-11" onclick="get_penilaian_kinerja('<?=$request_eval[$i]->evaluator_id;?>','<?=$request_eval[$i]->id_pegawai;?>')" style="<?=$data_done;?>">
                                                <!-- <img src="<?=$data_link_a;?>" style="height: 100%"> -->
                                                <span style="<?=$data_done_span;?>"><?=$request_eval[$i]->nama_pegawai;?></span>                            
                                            </a>                    
                                <?php                    
                                        }
                                    }
                                ?>        
                                </div>        
                            </div>
                        </div>    
                    </div>

                    <div id="view_q_pegawai" style="display:none">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body" >
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            <th>No</th>
                                            <th>Pertanyaan</th>
                                            <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>            
                                </div>
                            </div>
                        </div>
                    </div>                                    
                </div>

                <div role="tabpanel" class="tab-pane" id="pegawai_terbaik">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Pelaksana</label>
                        <div class="col-md-9">
                            <select name="f_es4" id="f_es4" class="form-control form-control-detail" style="margin-bottom: 11px;">
                            <option>-----------</option>
                            <?php
                                foreach($pegawai_terbaik as $pegawai_terbaik){
                            ?>
                                <option><?=$pegawai_terbaik->nama_pegawai;?></option>
                            <?
                                }                            
                            ?>                            
                            </select>
                            <input class="form-control form-control-detail" id="f_es4_id" type="hidden">							
                        </div>
                        <!-- <a class="btn btn-default" ><i class="fa fa-search"></i></a>							 -->
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Eselon 4/Sub Koor</label>
                        <div class="col-md-9">
                            <select name="f_es4" id="f_es4" class="form-control form-control-detail" style="margin-bottom: 11px;">
                            <option>-----------</option>
                            <?php
                                foreach($pegawai_terbaik1 as $pegawai_terbaik){
                            ?>
                                <option><?=$pegawai_terbaik->nama_pegawai;?></option>
                            <?
                                }                            
                            ?>                            
                            </select>
                            <input class="form-control form-control-detail" id="f_es4_id" type="hidden">							
                        </div>
                        <!-- <a class="btn btn-default" ><i class="fa fa-search"></i></a>							 -->
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Eselon 3/Koor</label>
                        <div class="col-md-9">
                            <select name="f_es4" id="f_es4" class="form-control form-control-detail" style="margin-bottom: 11px;">
                            <option>-----------</option>
                            <?php
                                foreach($pegawai_terbaik2 as $pegawai_terbaik){
                            ?>
                                <option><?=$pegawai_terbaik->nama_pegawai;?></option>
                            <?
                                }                            
                            ?>
                            </select>
                            <input class="form-control form-control-detail" id="f_es4_id" type="hidden">							
                        </div>
                        <!-- <a class="btn btn-default" ><i class="fa fa-search"></i></a>							 -->
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">JFT Pertama</label>
                        <div class="col-md-9">
                            <select name="f_es4" id="f_es4" class="form-control form-control-detail" style="margin-bottom: 11px;">
                            <option>-----------</option>
                            <?php
                                foreach($pegawai_terbaik3 as $pegawai_terbaik){
                            ?>
                                <option><?=$pegawai_terbaik->nama_pegawai;?></option>
                            <?
                                }                            
                            ?>                            
                            </select>
                            <input class="form-control form-control-detail" id="f_es4_id" type="hidden">							
                        </div>
                        <!-- <a class="btn btn-default" ><i class="fa fa-search"></i></a>							 -->
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">JFT Muda</label>
                        <div class="col-md-9">
                            <select name="f_es4" id="f_es4" class="form-control form-control-detail" style="margin-bottom: 11px;">
                            <option>-----------</option>
                            <?php
                                foreach($pegawai_terbaik4 as $pegawai_terbaik){
                            ?>
                                <option><?=$pegawai_terbaik->nama_pegawai;?></option>
                            <?
                                }                            
                            ?>                            
                            </select>
                            <input class="form-control form-control-detail" id="f_es4_id" type="hidden">							
                        </div>
                        <!-- <a class="btn btn-default" ><i class="fa fa-search"></i></a>							 -->
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">JFT Madya</label>
                        <div class="col-md-9">
                            <select name="f_es4" id="f_es4" class="form-control form-control-detail" style="margin-bottom: 11px;">
                            <option>-----------</option>
                            <?php
                                foreach($pegawai_terbaik5 as $pegawai_terbaik){
                            ?>
                                <option><?=$pegawai_terbaik->nama_pegawai;?></option>
                            <?
                                }                            
                            ?>                            
                            </select>
                            <input class="form-control form-control-detail" id="f_es4_id" type="hidden">							
                        </div>
                        <!-- <a class="btn btn-default" ><i class="fa fa-search"></i></a>							 -->
                    </div>
                    
                    
                    <div class="col-md-11">
                        <button class="btn btn-success pull-right" id="btn-save-eval">Simpan</button>
                    </div>                    
                </div>                
                <!-- <div role="tabpanel" class="tab-pane active" id="penilaian_kinerja">
                </div> -->
            </div>                            
        </div>
    <!-- </div> -->
</div>

<script>
function set_evaluator(id, name, posisi) {
    var inputs              = document.getElementsByName('list_evaluator');
    var allowData = 1;
    Lobibox.confirm({
        title: "Konfirmasi",
        msg: "Ajukan pegawai ini sebagai evaluator anda ?",
        callback: function ($this, type) {
            var data_sender = {
                id_pegawai : id,
                id_posisi : posisi,
                pegawai : '<?=$id_pegawai;?>',
                posisi : '<?=$id_posisi;?>'
            }

            for (var i = 0; i < inputs.length; i++) {
                if (id === $("#list_evaluator_"+i).val()) {
                    allowData = 0
                    break;
                }
                else
                {
                    allowData = 1
                    // break;
                }
                // console.log()
            }    

            if (allowData == 1) {
                $.ajax({
                    url :"<?php echo site_url();?>/talenta/set_evaluator_prilaku",
                    type:"post",
                    data:{data_sender : data_sender},
                    beforeSend:function(){
                        $("#form_penilaian").modal('hide');
                        $("#loadprosess").modal('show');                                                
                    },
                    success:function(msg){
                        var obj = jQuery.parseJSON (msg);
                        console.log(obj)
                        $("#loadprosess").modal('hide');
                        if (obj.flag == 1) {
                            Lobibox.notify('success', {msg: obj.text});                                                        
                            $("#evaluator ul").append('<li style="cursor: pointer;" id="li_evaluator_'+i+'"><a class="evaluator_a"><i class="fa fa-circle-o text-red contact-name-list"></i>'+name+'<span class="pull-right" style="padding-bottom: 0px;padding-top: 0px;"><i class="fa fa-close"></i></span></a><input type="hidden" name="list_evaluator" id="list_evaluator_'+i+'" value="'+id+'"><input type="hidden" id="list_evaluator_posisi_'+i+'" value="'+posisi+'"></input><input type="hidden" id="sources_'+i+'" value="local"></li>');                    
                            setTimeout(function(){
                                location.reload();
                            }, 5600);                                                                
                        }
                        else
                        {
                            Lobibox.notify('warning', {msg: obj.text});                        
                        }                    
                    },
                    error:function(jqXHR,exception)
                    {
                        ajax_catch(jqXHR,exception);
                    }
                })
            }
            else
            {
                Lobibox.notify('warning', {msg: 'Pegawai ini telah menjadi evaluator anda'});                    
            }            
        }
    })
    
    // console.log(inputs.length)
    // console.log(id, name)
}


function get_penilaian_kinerja(id,id_pegawai) {
    // body...
    $.ajax({
        url :"<?php echo site_url();?>talenta/get_penilaian_kinerja/"+id+"/"+id_pegawai,
        type:"post",
        beforeSend:function(){
            $("#view_index").hide();
            $("#view_q_pegawai").show()
            $("#loadprosess").modal('show');                                                
        },
        success:function(res){
            var obj = jQuery.parseJSON (res);

            // console.log(obj.question);
            var index = 0
            $("#example1 tbody tr").remove()
            for (let index = 0; index < obj.question.length; index++) {
                // const element = array[index];
                var componentParameter = ''
                if (obj.question[index].id_parameter == 2) {
                    componentParameter = `<select class="form-control" name="urtug" id="urtug" onchange="getLikertKinerja(this,${obj.question[index].id_pertanyaan},${id},${id_pegawai});">
                                                <option value=""> - - - - Pilih  - - - - </option>
                                                <option value="1"> Tidak setuju </option>
                                                <option value="2"> Kurang setuju </option>
                                                <option value="3"> Setuju </option>
                                                <option value="4"> Sangat Setuju </option>                                                                                                                                                                                
                                            </select>` 
                } else {
                    componentParameter = `<select class="form-control" name="urtug" id="urtug" onchange="getLikertKinerja(this,${obj.question[index].id_pertanyaan},${id},${id_pegawai});">
                                                <option value=""> - - - - Pilih  - - - - </option>
                                                <option value="1"> 1 </option>
                                                <option value="2"> 2 </option>
                                                <option value="3"> 3 </option>
                                                <option value="4"> 4 </option>
                                                <option value="5"> 5 </option>
                                                <option value="6"> 6 </option>
                                                <option value="7"> 7 </option>
                                                <option value="8"> 8 </option>
                                                <option value="9"> 9 </option>
                                                <option value="10"> 10 </option>                                                                                                                                                                                
                                            </select>`                    
                }

                let rowData = `<tr>
                <td>${index+1}</td>
                <td>${obj.question[index].pertanyaan}</td>
                <td>${componentParameter}</td>                                
                </tr>`

                $('#example1 tbody').append(rowData)                
                // console.log(obj.question[index].pertanyaan)                
            }
            // obj.question.forEach(element => {
            //     // console.log(element)
            //     // $('#example1 tbody').append(rowData);                
            // });

            // $("#form_penilaian").modal('show');
            // $("#nama_pegawai").val(obj[0].nama_pegawai);
            // $("#nip").val(obj[0].nip);
            // $("#oid_skp").val(obj[0].evaluator_id);                   
            // $("#orientasi_pelayanan").val(obj[0].orientasi_pelayanan);
            // $("#integritas").val(obj[0].integritas);
            // $("#komitmen").val(obj[0].komitmen);
            // $("#disiplin").val(obj[0].disiplin);
            // $("#kerjasama").val(obj[0].kerjasama);
            // $("#kepemimpinan").val(obj[0].kepemimpinan);                                                                                    
            // $("#rekomendasi").val(obj[0].rekomendasi);                                                                                                
            setTimeout(function(){ 
                $("#loadprosess").modal('hide');                                
            }, 500);           
        },
        error:function(jqXHR,exception)
        {
            $("#view_index").show();
            $("#view_q_pegawai").hide()            
            ajax_catch(jqXHR,exception);
        }
    })
}

function getLikertKinerja(item,id_pertanyaan,id,id_pegawai) {
    $.ajax({
        url :"<?php echo site_url()?>talenta/likertAntarPegawai/"+id+"/"+id_pegawai+"/"+id_pertanyaan+"/"+item.value,
        type:"post",
        success:function(res){
            var obj = jQuery.parseJSON (res);
            if (obj.reload == 1) {
                location.reload();
            }
            console.log(obj.reload);
            // $("#btn-section_"+id).css({"display": "none"})
            // checkProgress()
            // $("#loadprosess").modal('hide');
        },
        error:function(jqXHR,exception)
        {
            ajax_catch(jqXHR,exception);					
        }
    })
}
</script>