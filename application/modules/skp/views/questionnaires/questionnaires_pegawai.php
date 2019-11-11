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
        <h3>Kriteria penilaian kualitas SKP</h3>
        <div class="row">
            <div class="col-sm-6">
                <label>
                    NIP:</label>
                <span id="ContentPlaceHolder1_lbl_nip"><?php echo $nip;?></span>
            </div>
            <div class="col-sm-6">
                <label>
                    Nama Pegawai:</label>
                <span id="ContentPlaceHolder1_lbl_klsjabatan"><?php echo $nama_pegawai;?></span>
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
                            <th style="width: 50%;">Pertanyaan</th>
                            <th style="width: 30%;">Kriteria</th>
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
                                            <td><?=$questionnaires_kategori[$i]['quisioner_kategori_id'].'.'.$questionnaires[$ii]->prefix;?></td>
                                            <td><?=$questionnaires[$ii]->pertanyaan;?></td>
                                            <td><?=$questionnaires[$ii]->kriteria;?></td>
                                            <td>
                                                <div class="form-group col-md-12">
                                                    <div class="input-group">
                                                        <input type="number" name="indikator_value" id="f_value_indikator_<?=$x;?>" class="form-control" min="0" max="99" onKeyUp="if(this.value>99){this.value='100';}else if(this.value<0){this.value='0';}" value="<?=$questionnaires[$ii]->value;?>">
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

