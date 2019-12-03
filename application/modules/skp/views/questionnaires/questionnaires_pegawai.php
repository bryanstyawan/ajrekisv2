<?php
$nama_pegawai  = "";
$nama_jabatan  = "";
$nama_eselon1  = "";
$nama_eselon2  = "";
$nama_eselon3  = "";
$nama_eselon4  = "";
$nip           = "";
$kelas_jabatan = "";
$kat_posisi    = "";
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
    $kat_posisi    = $infoPegawai[0]->kat_posisi;
}
?>
<div class="box box-info" style="height: 100%;">
    <div class="box-header with-border">        
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">                
                    <h4>NIP : <?php echo $nip;?></h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">                
                    <h4>Nama Pegawai : <?php echo $nama_pegawai;?></h4>
                </div>
            </div>
        </div>        
    </div>
</div>

<div class="box box-info" style="height: 100%;">
    <div class="box-header with-border">
        <h1>Kriteria penilaian kualitas SKP</h1>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">                
                    <h4>91-100 : Amat Baik</h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">                
                    <h4>76-90 : Baik</h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>61-75 : Cukup</h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h4>51-60 : Kurang</h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">                
                    <h4>50 ke bawah : Buruk</h4>
                </div>                
            </div>
        </div>        
    </div>
</div>

<?php
    if ($questionnaires_kategori != array()) {
        # code...
        $x = 1;        
        for ($i=0; $i < count($questionnaires_kategori); $i++) { 
            # code...
?>
        <div class="box box-info" style="height: 100%;">
            <div class="box-header with-border">
                <h5><?=$questionnaires_kategori[$i]['nama'];?></h5>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-view">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th style="width: 80%;">Pertanyaan</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($questionnaires != 0) {
                                # code...
                                for ($ii=0; $ii < count($questionnaires); $ii++) { 
                                    # code...
                                    if ($questionnaires_kategori[$i]['quisioner_kategori_id'] == $questionnaires[$ii]->quisioner_kategori_id) {
                                        # code...
                        ?>
                                        <tr>
                                            <input type="hidden" id="qusioner_code_<?=$x;?>" value="<?=$questionnaires[$ii]->qusioner_code;?>">                                            
                                            <input type="hidden" id="id_pegawai_<?=$x;?>" value="<?=$infoPegawai[0]->id;?>">                                            
                                            <input type="hidden" id="id_posisi_<?=$x;?>" value="<?=$infoPegawai[0]->id_posisi;?>">                                            
                                            <td><h4><?=$questionnaires_kategori[$i]['quisioner_kategori_id'].'.'.$questionnaires[$ii]->prefix;?></h4></td>
                                            <td><?=$questionnaires[$ii]->pertanyaan;?></td>
                                            <td>
                                                <div class="form-group col-md-12">
                                                    <div class="input-group">
                                                        <input type="number" onKeyUp="if(this.value>100){this.value='100';}else if(this.value<0){this.value='0';}" name="indikator_value" id="f_value_indikator_<?=$x;?>" class="form-control" min="0" max="99" onKeyUp="if(this.value>99){this.value='100';}else if(this.value<0){this.value='0';}" value="<?=$questionnaires[$ii]->value;?>">
                                                    </div>
                                                </div>                                                            
                                            </td>
                                        </tr>
                        <?php
                                        $x++;
                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>            
<?php
        }
    }
?>
<a class="btn btn-success pull-right" id="btn_trigger">Simpan</a>

<script>
    $(document).ready(function()
    {
        $("#btn_trigger").click(function()
        {
            var inputs = document.getElementsByName('indikator_value');
            var data_sender_detail = [];            
            if (inputs.length != 0)
            {
                for (var i = 1; i <= inputs.length; i++) {
                    data_sender_detail.push({
                        'id_pegawai'           : $("#id_pegawai_"+i).val(),
                        'id_posisi'            : $("#id_posisi_"+i).val(),
                        'qusioner_code'        : $("#qusioner_code_"+i).val(),
                        'value'                : $("#f_value_indikator_"+i).val() 
                    });                    
                }                
            }     

            $.ajax({
                url :"<?php echo site_url();?>skp/questionnaires/store_questionnaires_process",
                type:"post",
                data:{data_sender : data_sender_detail},
                beforeSend:function(){
                    $("#loadprosess").modal('show');
                },
                success:function(msg){
                    var obj = jQuery.parseJSON (msg);
                    ajax_status(obj);
                },
                error:function(){
                    Lobibox.notify('error', {
                        msg: 'Gagal Menambah Pekerjaan'
                    });
                }
            })                   
            console.log(data_sender_detail)            
        });        
    });    
</script>

