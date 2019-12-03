<style>
.a-info-modal
{
    font-size: 18px;
    background: #2196F3;
    color: #fff;
    width: 5%;
}

.input-group > p
{
    color:#000;
    text-align:justify;
}
</style>
<?php
    $atasan1    = $atasan; 
    $atasan2    = $atasan_plt;
    $evaluator1 = $evaluator;
?>
<div class="col-md-12">
    <div class="box box-solid" id="isi_kontak" style="">
        <div class="box-header with-border">
            <h3 class="box-title">Permintaan untuk Penilaian Prilaku</h3>
        </div>
        <div class="box-body">
        <?php
            if ($request_eval != 0) {
                # code...
                for ($i=0; $i < count($request_eval); $i++) { 
                    # code...
                    $data_link_a = "";
                    $data_link_a = base_url() . 'public/images/pegawai/'.$request_eval[$i]->photo; 

                    $data_done      = "";
                    $data_done_span = "";
                    if ($request_eval[$i]->status_prilaku != NULL) {
                        # code...
                        if ($request_eval[$i]->status_prilaku == 1) {
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
                    <a class="btn btn-app" onclick="send_penilaian_prilaku(<?=$request_eval[$i]->evaluator_id;?>,<?=$request_eval[$i]->id_pegawai;?>)" style="<?=$data_done;?>">
                        <img src="<?=$data_link_a;?>" style="height: 100%">
                        <span style="<?=$data_done_span;?>"><?=$request_eval[$i]->nama_pegawai;?></span>                            
                    </a>                    
        <?php                    
                }
            }
        ?>
        </div>
    </div>    
</div>


<div class="col-md-3">
    <div class="box box-solid" id="isi_kontak" style="">

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
                        ?>
                                <li style="cursor: pointer;background-color: rgb(76, 175, 80);color: rgb(255, 255, 255);" id="li_kandidat_<?=$i;?>"><a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i><?=$atasan->nama_pegawai;?></a><input type="hidden" id="hdn_pegawai_<?=$i;?>" name="list_kandidat" value="<?=$atasan->nama_pegawai;?>"></input></li>                                    
                        <?php
                            }
                        }                    

                        if ($atasan_plt != 0) {
                            # code...
                            foreach($atasan_plt as $atasan_plt)
                            {
                                $i++;
                    ?>
                                <li style="cursor: pointer;background-color: rgb(76, 175, 80);color: rgb(255, 255, 255);" id="li_kandidat_<?=$i;?>"><a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i>[PLT] <?=$atasan_plt->nama_pegawai;?></a><input type="hidden" id="hdn_pegawai_<?=$i;?>" name="list_kandidat" value="<?=$atasan_plt->nama_pegawai;?>"></input></li>                                    
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
                ?>
                                    <li style="cursor: pointer;" id="li_kandidat_<?=$i;?>"><a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i><?=$peer->nama_pegawai;?></a><input type="hidden" id="hdn_pegawai_<?=$i;?>" name="list_kandidat" value="<?=$peer->nama_pegawai;?>"></input></li>                                    
                <?php
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
                            <li style="cursor: pointer;" id="li_kandidat_<?=$i;?>"><a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i><?=$bawahan->nama_pegawai;?></a><input type="hidden" id="hdn_pegawai_<?=$i;?>" name="list_kandidat" value="<?=$bawahan->nama_pegawai;?>"></input></li>                                    
                <?php
                        }
                    }
                ?>            
            </ul>
        </div>
    </div>
</div>


<div class="col-md-3">
    <div class="box box-solid" id="isi_kontak" style="">

        <div class="box-header with-border">
            <h3 class="box-title">Evaluator (Max 5)</h3>
        </div>
        <div id="evaluator" class="box-body no-padding" style="display: block;">
            <ul class="nav nav-pills nav-stacked contact-evaluator">
                    <?php

                        $atasan_temp = "";
                        if ($evaluator != 0) {
                            # code...
                            if ($atasan1 != 0) {
                                # code...
                                foreach($atasan1 as $atasan1){
                                    $i++;
                                    $atasan_temp = $atasan1->nama_pegawai;
                        ?>
                                    <li style="cursor: pointer;" id="1"><a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i><?=$atasan1->nama_pegawai;?></a><input type="hidden" name="list_evaluator" id="list_evaluator_1" value="<?=$atasan1->nama_pegawai;?>"></input><input type="hidden" id="sources_1" value="local"></li>
                        <?php
                                }                                
                            }

                            if ($atasan2 != 0) {
                                # code...
                                foreach($atasan2 as $atasan2){
                                    $i++;
                                    $atasan_temp = $atasan2->nama_pegawai;
                        ?>
                                    <li style="cursor: pointer;" id="1"><a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i>[PLT] <?=$atasan2->nama_pegawai;?></a><input type="hidden" name="list_evaluator" id="list_evaluator_1" value="<?=$atasan2->nama_pegawai;?>"></input><input type="hidden" id="sources_2" value="local"></li>
                        <?php
                                }                                
                            }                            
                        }
                        else
                        {

                        }

                        if ($evaluator != 0) {
                            # code...
                            for ($i=0; $i < count($evaluator); $i++) { 
                                # code...
                                $x = 1 + $i;
                                if ($atasan_temp != $evaluator[$i]->nama_pegawai) {
                                    # code...
                                    $remove_icon = "";
                                    $remove_cmd  = "";
                                    $lock_icon   = "";
                                    if ($evaluator[$i]->status == 0) {
                                        # code...
                                        $remove_icon = '<span class="pull-right" style="padding-bottom: 0px;padding-top: 0px;"><i class="fa fa-close"></i></span>';
                                        $remove_cmd = 'onclick="remove_list_evaluator_sync('.$x.')"';
                                        $lock_icon = 'fa-circle-o';
                                    }
                                    else
                                    {
                                        $lock_icon = 'fa-lock';                                        
                                    }
                    ?>
                                    <li style="cursor: pointer;" id="li_evaluator_<?=$x;?>" <?=$remove_cmd;?>><a class="contact-name"><i class="fa <?=$lock_icon;?> text-red contact-name-list"></i><?=$evaluator[$i]->nama_pegawai.$remove_icon;?></a><input type="hidden" name="list_evaluator" id="list_evaluator_<?=$x;?>" value="<?=$evaluator[$i]->nama_pegawai;?>"></input><input type="hidden" id="sources_<?=$x;?>" value="server"></li></li>                    
                    <?php                                    
                                }
                            }
                        }
                    ?>
            </ul>
        </div>
        <div class="box-body">
            <div class="col-md-12">
                <button class="btn btn-default pull-right" id="btn-save-eval">Ajukan Penilai</button>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="box box-solid"> 
        <div class="box-header with-border">
            <h3 class="box-title">Penilaian Prilaku</h3>
        </div>
        <div class="box-body" style="display: block;">
            <table id="table_skp" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Aspek</th>
                        <th>Nilai</th>
                        <th>Status Nilai</th>
                    </tr>                    
                </thead>
                <tbody>     
                <?php
                    $orientasi_pelayanan = $this->Globalrules->get_penilaian_prilaku($nilai_prilaku_atasan[0]->orientasi_pelayanan,$nilai_prilaku_peer[0]->orientasi_pelayanan,$nilai_prilaku_bawahan[0]->orientasi_pelayanan);
                    $integritas          = $this->Globalrules->get_penilaian_prilaku($nilai_prilaku_atasan[0]->integritas,$nilai_prilaku_peer[0]->integritas,$nilai_prilaku_bawahan[0]->integritas);
                    $komitmen            = $this->Globalrules->get_penilaian_prilaku($nilai_prilaku_atasan[0]->komitmen,$nilai_prilaku_peer[0]->komitmen,$nilai_prilaku_bawahan[0]->komitmen);
                    $disiplin            = $this->Globalrules->get_penilaian_prilaku($nilai_prilaku_atasan[0]->disiplin,$nilai_prilaku_peer[0]->disiplin,$nilai_prilaku_bawahan[0]->disiplin);
                    $kerjasama           = $this->Globalrules->get_penilaian_prilaku($nilai_prilaku_atasan[0]->kerjasama,$nilai_prilaku_peer[0]->kerjasama,$nilai_prilaku_bawahan[0]->kerjasama);
                    $kepemimpinan        = $this->Globalrules->get_penilaian_prilaku($nilai_prilaku_atasan[0]->kepemimpinan,$nilai_prilaku_peer[0]->kepemimpinan,$nilai_prilaku_bawahan[0]->kepemimpinan);
                    $status              = $this->Globalrules->get_penilaian_prilaku($nilai_prilaku_atasan[0]->status,$nilai_prilaku_peer[0]->status,$nilai_prilaku_bawahan[0]->status,'status',($evaluator1 == 0) ? 1 : count($evaluator1));                    
                ?>
                    <tr>
                        <td>Orientasi Pelayanan</td>
                        <td><?=number_format($orientasi_pelayanan,2);?></td>
                        <td rowspan="6"><?=number_format($status);?>%</td>
                    </tr>
                    <tr>
                        <td>Integritas</td>
                        <td><?=number_format($integritas,2);?></td>
                    </tr>
                    <tr>
                        <td>Komitmen</td>
                        <td><?=number_format($komitmen,2);?></td>
                    </tr>
                    <tr>
                        <td>Disiplin</td>
                        <td><?=number_format($disiplin,2);?></td>
                    </tr>
                    <tr>
                        <td>Kerjasama</td>
                        <td><?=number_format($kerjasama,2);?></td>
                    </tr>
                    <tr>
                        <td>Kepemimpinan</td>
                        <td><?=number_format($kepemimpinan,2);?></td>
                    </tr>
                </tbody>
            </table>   
        </div>        
    </div>
</div>


<div class="example-modal">
    <div class="modal modal-success fade" id="form_penilaian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="box-content">
            
            <div class="modal-dialog modal-lg" style="overflow-y: initial !important">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Form Penilaian Prilaku</h4>
                    </div>

                    <div class="modal-body" style="background-color: #fff!important;height: 550px;overflow-y: auto;">
                        <form id="editForm" name="addForm">
                            <div class="container-fluid">

                                <div class="row" style="background-color: #fff!important">
                                    <div class="col-lg-6">
                                        <a href="#" class="btn btn-danger pull-left" data-dismiss="modal">Keluar</a>
                                    </div>
                                    <div class="col-lg-6">
                                        <a href="#" class="btn btn-primary pull-right" id="btn_simpan_prilaku">Simpan</a>
                                    </div>                                    
                                </div>
                                <hr>

                                <div class="row">                    
                                    <div class="col-md-6">
                                        <label style="color: #000;font-weight: 400;font-size: 19px;">Nama</label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class ="input-group-addon"><i class="fa fa-star"></i></span>
                                                <input type="text" id="nama_pegawai" name="nama_pegawai" class="form-control" disabled="disabled">
                                            </div>
                                        </div>                                        
                                    </div>

                                    <div class="col-md-6">
                                        <label style="color: #000;font-weight: 400;font-size: 19px;">NIP</label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class ="input-group-addon"><i class="fa fa-star"></i></span>
                                                <input type="text" id="nip" name="nip" class="form-control" disabled="disabled">
                                                <input type ="hidden" id="oid_skp" name="oid_skp">
                                            </div>
                                        </div>                          
                                    </div>    
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <label style="color: #000;font-weight: 400;font-size: 19px;">Orientasi Pelayanan</label>
                                        <a class="pull-right text-center a-info-modal"  onclick="open_view_modal('orientasi_pelayanan',1)"><i class="fa fa-info"></i></a>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class ="input-group-addon"><i class="fa fa-star"></i></span>
                                                <input type="number" onKeyUp="if(this.value>100){this.value='100';}else if(this.value<0){this.value='0';}" id="orientasi_pelayanan" name="orientasi_pelayanan" class="form-control">
                                            </div>
                                        </div>

                                        <label style="color: #000;font-weight: 400;font-size: 19px;">Integritas</label>
                                        <a class="pull-right text-center a-info-modal"  onclick="open_view_modal('integritas',2)"><i class="fa fa-info"></i></a>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class ="input-group-addon"><i class="fa fa-star"></i></span>
                                                <input type="number" onKeyUp="if(this.value>100){this.value='100';}else if(this.value<0){this.value='0';}" id="integritas" name="integritas" class="form-control">
                                            </div>
                                        </div>

                                        <label style="color: #000;font-weight: 400;font-size: 19px;">Komitmen</label>
                                        <a class="pull-right text-center a-info-modal"  onclick="open_view_modal('komitmen',3)"><i class="fa fa-info"></i></a>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class ="input-group-addon"><i class="fa fa-star"></i></span>
                                                <input type="number" onKeyUp="if(this.value>100){this.value='100';}else if(this.value<0){this.value='0';}" id="komitmen" name="komitmen" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">

                                        <label style="color: #000;font-weight: 400;font-size: 19px;">Disiplin</label>
                                        <a class="pull-right text-center a-info-modal"  onclick="open_view_modal('disiplin',4)"><i class="fa fa-info"></i></a>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class ="input-group-addon"><i class="fa fa-star"></i></span>
                                                <input type="number" onKeyUp="if(this.value>100){this.value='100';}else if(this.value<0){this.value='0';}" id="disiplin" name="disiplin" class="form-control">
                                            </div>
                                        </div>

                                        <label style="color: #000;font-weight: 400;font-size: 19px;">Kerjasama</label>
                                        <a class="pull-right text-center a-info-modal"  onclick="open_view_modal('kerjasama',5)"><i class="fa fa-info"></i></a>                                    
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class ="input-group-addon"><i class="fa fa-star"></i></span>
                                                <input type="number" onKeyUp="if(this.value>100){this.value='100';}else if(this.value<0){this.value='0';}" id="kerjasama" name="kerjasama" class="form-control">
                                            </div>
                                        </div>                                                    

                                        <label style="color: #000;font-weight: 400;font-size: 19px;">Kepemimpinan (Diisi untuk Jabatan Struktural)</label>
                                        <a class="pull-right text-center a-info-modal"  onclick="open_view_modal('kepemimpinan',6)"><i class="fa fa-info"></i></a>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class ="input-group-addon"><i class="fa fa-star"></i></span>
                                                <input type="number" onKeyUp="if(this.value>100){this.value='100';}else if(this.value<0){this.value='0';}" id="kepemimpinan" name="kepemimpinan" class="form-control">
                                            </div>
                                        </div>                                                                                                                        

                                    </div>

                                    <?php
                                        if ($bawahan != array()) {
                                            # code...
                                        ?>
                                        <div class="col-lg-12">
                                            <label style="color: #000;font-weight: 400;font-size: 19px;">Rekomendasi</label>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class ="input-group-addon"><i class="fa fa-star"></i></span>
                                                    <textarea id="rekomendasi" name="rekomendasi" class="form-control"></textarea>
                                                </div>
                                            </div>                                    
                                        </div>                                    
                                        <?php                                                
                                        }
                                        else {
                                            # code...
                                        ?>
                                        <input type="hidden" id="rekomendasi">
                                        <?php
                                        }
                                    ?>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="example-modal">
    <div class="modal modal-success fade" id="indikator_penilaian_prilaku" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="box-content">
            
            <div class="modal-dialog modal-lg" style="overflow-y: initial !important">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="indikator_title"></h4>
                    </div>
                    <div class="modal-body" style="background-color: #fff!important;height: 550px;overflow-y: auto;">
                        <form id="editForm" name="addForm">
                            <div class="container-fluid">
                                <div class="row">                    
                                    <div class="col-lg-12 text-center">
                                        <h3 style="color: #000" id="indikator_subtitle">Indikator</h3>                                    
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-lg-6">

                                        <label style="color: #000;font-weight: 400;font-size: 19px;">91-100 (Amat Baik)</label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <p id="indikator_91_100"></p>
                                            </div>
                                        </div>                                                                                                                        

                                        <label style="color: #000;font-weight: 400;font-size: 19px;">61-75 (Cukup)</label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <p id="indikator_61_75"></p>
                                            </div>
                                        </div>

                                        <label style="color: #000;font-weight: 400;font-size: 19px;">50 ke bawah (Buruk)</label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <p id="indikator_50_kebawah"></p>
                                            </div>
                                        </div>                                                                                                                        

                                    </div>
                                    <div class="col-lg-6">

                                        <label style="color: #000;font-weight: 400;font-size: 19px;">76-90 (Baik)</label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <p id="indikator_76_90"></p>
                                            </div>
                                        </div>                                        

                                        <label style="color: #000;font-weight: 400;font-size: 19px;">51-60 (Kurang)</label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <p id="indikator_51_60"></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row" style="background-color: #fff!important;border-top-color: #d2d6de;">
                                    <div class="col-lg-5">&nbsp;</div>
                                    <div class="col-lg-2">
                                        <a href="#" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-close fa-2x"></i></a>
                                    </div>
                                </div>

                            </div>

                        </form>
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
var counter_evaluator     = 1;
var counter_evaluator_php = "<?php
                                if ($evaluator != 0) 
                                {
                                    echo count($evaluator);
                                }
                                else
                                {
                                    echo "0";
                                }
                            ?>";

if (counter_evaluator_php != 0) 
{
    counter_evaluator = counter_evaluator_php;
}
else
{
    counter_evaluator = counter_evaluator;
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

    $('.contact-id li').click(function(){
        var index = $(this).index();
        var text = $(this).text();
        var inputs              = document.getElementsByName('list_evaluator');
        if (inputs.length < 5) 
        {
            if (inputs.length == 0) 
            {
                $(this).css({"backgroundColor": "#4CAF50", "color": "white", "pointer-events" : "none"});            
                counter_evaluator++;
                $("#evaluator ul").append('<li style="cursor: pointer;" id="li_evaluator_'+counter_evaluator+'"><a class="evaluator_a"><i class="fa fa-circle-o text-red contact-name-list"></i>'+text+'<span class="pull-right" style="padding-bottom: 0px;padding-top: 0px;"><i class="fa fa-close"></i></span></a><input type="hidden" name="list_evaluator" id="list_evaluator_'+counter_evaluator+'" value="'+text+'"><input type="hidden" id="sources_'+counter_evaluator+'" value="local"></li>');
            }
            else if(inputs.length >= 1)
            {
                avail = 0;
                for (var i = 1; i <= inputs.length; i++) {
                    x = $("#list_evaluator_"+i).val();
                    if (x != text) 
                    {
                        avail = 1;
                    }
                    else
                    {
                        avail = 0;
                    }
                }

                if (avail == 1) 
                {
                    $(this).css({"backgroundColor": "#4CAF50", "color": "white", "pointer-events" : "none"});            
                    counter_evaluator++;
                    $("#evaluator ul").append('<li style="cursor: pointer;" id="li_evaluator_'+counter_evaluator+'" onclick="remove_list_evaluator('+counter_evaluator+')"><a class="evaluator_a"><i class="fa fa-circle-o text-red contact-name-list"></i>'+text+'<span class="pull-right" style="padding-bottom: 0px;padding-top: 0px;"><i class="fa fa-close"></i></span></a><input type="hidden" name="list_evaluator" id="list_evaluator_'+counter_evaluator+'" value="'+text+'"><input type="hidden" id="sources_'+counter_evaluator+'" value="local"></li>');
                }
                
            }
        }        
    });

    $("#btn_simpan_prilaku").click(function() {
        // body...
        Lobibox.confirm({
            title: "Konfirmasi",
            msg: "Anda akan melakukan penilaian prilaku untuk pegawai ini ?",
            callback: function ($this, type) {
                if (type === 'yes'){
                    data_sender = {
                                    id                 : $("#oid_skp").val(),
                                    orientasi_pelayanan: $("#orientasi_pelayanan").val(),
                                    integritas         : $("#integritas").val(),
                                    komitmen           : $("#komitmen").val(),
                                    disiplin           : $("#disiplin").val(),
                                    kerjasama          : $("#kerjasama").val(),
                                    kepemimpinan       : $("#kepemimpinan").val(),
                                    rekomendasi        : $("#rekomendasi").val() 

                    }
                    $.ajax({
                        url :"<?php echo site_url();?>/skp/proses_penilaian_prilaku",
                        data:{data_sender : data_sender},                                                
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

    })


    $("#btn-save-eval").click(function(){

        var inputs             = document.getElementsByName('list_evaluator');
        var data_sender_detail = [];
        send_data              = 0;
        for (var i = 1; i <= inputs.length; i++) {
            var evaluator = $('#list_evaluator_'+i).val();                    
            var sources   = $('#sources_'+i).val();
            if (sources == 'local' || sources == 'atasan') 
            {
                data_sender_detail.push({
                    'evaluator' : evaluator
                });  
                send_data = 1;
            }                                
        }

        if (send_data == 1) 
        {
            $.ajax({
                url :"<?php echo site_url();?>/skp/pengajuan_penilaian_prilaku",
                type:"post",
                data:{data_sender : data_sender_detail},
                beforeSend:function(){
                    $("#form_penilaian").modal('hide');
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
        else
        {
            alert("Silahkan pilih kandidat lainnya");
        }       
    })        

});    

function remove_list_evaluator(PARAM)
{
    var x      = $('#list_evaluator_'+PARAM).val();
    var inputs = document.getElementsByName('list_kandidat');
    for (var i = 1; i <= inputs.length; i++) {
        if (x == $('#hdn_pegawai_'+i).val()) {
            $('#li_kandidat_'+i).css({"backgroundColor": "", "color": "", "pointer-events" : ""});                        
        }
    }
    $('#li_evaluator_'+PARAM).remove();
    counter_evaluator--;    
}

function send_penilaian_prilaku(id,id_pegawai) {
    // body...
    $.ajax({
        url :"<?php echo site_url();?>/skp/get_detail_skp_penilaian/"+id,
        type:"post",
        beforeSend:function(){
            $("#form_penilaian").modal('hide');
            $("#loadprosess").modal('show');                                                
        },
        success:function(msg){
            var obj = jQuery.parseJSON (msg);

            $("#form_penilaian").modal('show');
            $("#nama_pegawai").val(obj[0].nama_pegawai);
            $("#nip").val(obj[0].nip);
            $("#oid_skp").val(obj[0].evaluator_id);                   
            $("#orientasi_pelayanan").val(obj[0].orientasi_pelayanan);
            $("#integritas").val(obj[0].integritas);
            $("#komitmen").val(obj[0].komitmen);
            $("#disiplin").val(obj[0].disiplin);
            $("#kerjasama").val(obj[0].kerjasama);
            $("#kepemimpinan").val(obj[0].kepemimpinan);                                                                                    
            $("#rekomendasi").val(obj[0].rekomendasi);                                                                                                
            console.log(obj[0]);      
            setTimeout(function(){ 
                $("#loadprosess").modal('hide');                                
            }, 500);           
        },
        error:function(jqXHR,exception)
        {
            ajax_catch(jqXHR,exception);
        }
    })
}

function remove_list_evaluator_sync(PARAM) {
    // body...
    var x              = $('#list_evaluator_'+PARAM).val();
    data_sender_detail = {
                            'evaluator' : x       
                        }
    $.ajax({
        url :"<?php echo site_url();?>/skp/remove_pengajuan_penilaian_prilaku",
        type:"post",
        data:{data_sender : data_sender_detail},
        beforeSend:function(){
            $("#form_penilaian").modal('hide');
            $("#loadprosess").modal('show');                                                
        },
        success:function(msg){
            var obj = jQuery.parseJSON (msg);             
            if (obj.status == 1) 
            {
                // alert(x);
                var inputs = document.getElementsByName('list_kandidat');
                for (var i = 1; i <= inputs.length; i++) {
                    if (x == $('#hdn_pegawai_'+i).val()) {
                        $('#li_kandidat_'+i).css({"backgroundColor": "", "color": "", "pointer-events" : ""});                        
                    }
                }
                $('#li_evaluator_'+PARAM).remove();
                counter_evaluator--;    
                $("#loadprosess").modal('hide');                                                
            }
            else
            {
                Lobibox.notify('warning', {
                    msg: obj.text
                    });
                setTimeout(function(){ 
                    $("#loadprosess").modal('hide');                                
                }, 500);                                                                           
            }           
        },
        error:function(jqXHR,exception)
        {
            ajax_catch(jqXHR,exception);
        }
    })     
}

function open_view_modal(params,arg) {
    $("#loadprosess").modal('show');

    $.ajax({
        url :"<?php echo site_url();?>/skp/get_indikator_prilaku/"+arg,
        type:"post",
        beforeSend:function(){
            // $("#form_penilaian").modal('hide');
            $("#loadprosess").modal('show');                                                
        },
        success:function(msg){
            var obj = jQuery.parseJSON (msg);             
            if (obj.status == 1) 
            {
                $("#indikator_title").html(obj.text[0].nama);
                $("#indikator_subtitle").html('Indikator '+obj.text[0].nama);                
                $("#indikator_91_100").html(obj.text[0].keterangan);
                $("#indikator_76_90").html(obj.text[1].keterangan);
                $("#indikator_61_75").html(obj.text[2].keterangan);
                $("#indikator_51_60").html(obj.text[3].keterangan);
                $("#indikator_50_kebawah").html(obj.text[4].keterangan);
                $("#indikator_penilaian_prilaku").modal('show');
                $("#loadprosess").modal('hide');                                                
            }
            else
            {
                Lobibox.notify('warning', {
                    msg: obj.text
                    });
                setTimeout(function(){ 
                    $("#loadprosess").modal('hide');                                
                }, 500);                                                                           
            }           
        },
        error:function(jqXHR,exception)
        {
            ajax_catch(jqXHR,exception);
        }
    })    
}
</script>   