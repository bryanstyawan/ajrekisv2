<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/tabs-checked/css/style_tabs.css'; ?>");</style>



<?php
if ($member != 0) {
    # code...
?>

<div class="col-md-3">
    <div class="box box-solid" id="isi_kontak" style="">

        <div class="box-header with-border">
            <h3 class="box-title">Anggota</h3>
        </div>
        <div class="box-body no-padding" style="display: block;">
            <ul class="nav nav-pills nav-stacked contact-id">
                <?php
                  $i = "";
                  for ($i=0; $i < count($member); $i++) {
                    // code...
                      $flag_counter = "";
                      if ($member[$i]->counter_belum_diperiksa == 0) {
                        // code...
                        $flag_counter = "display:none;";
                      }
                    ?>
                        <li style="cursor: pointer;" class="teamwork" id="li_kandidat_<?=$i;?>">
                          <a href="<?=base_url().'transaksi/approval_tugas_tambahan_dan_kreativitas/'.$member[$i]->id;?>" class="contact-name">
                            <i class="fa fa-circle-o text-red contact-name-list"></i><?=$member[$i]->nama_pegawai;?>
                            <sup style="<?=$flag_counter;?>">
                                <span class="notif-count pull-right">
                                    <span><?=$member[$i]->counter_belum_diperiksa;?></span>
                                </span>
                            </sup>
                          </a>
                          <input type="hidden" id="hdn_pegawai_<?=$i;?>" name="list_kandidat" value="<?=$member[$i]->nama_pegawai;?>"></input>
                        </li>
                    <?php
                  }
              ?>
            </ul>
        </div>
    </div>
</div>
<?php
}
?>

<?php
// print_r($tr_tugas_tambahan);die();
if ($iduser_open == 'open') {
    # code...
$id_pegawai    = "";
$nama_pegawai  = "";
$nama_jabatan  = "";
$nama_eselon1  = "";
$nama_eselon2  = "";
$nama_eselon3  = "";
$nama_eselon4  = "";
$nip           = "";
$kelas_jabatan = "";
if ($infoPegawai != 0 || $infoPegawai != '') {
    # code...
    $id_pegawai    = $infoPegawai[0]->id;
    $nama_pegawai  = $infoPegawai[0]->nama_pegawai;
    $nama_jabatan  = $infoPegawai[0]->nama_jabatan;
    $nama_eselon1  = $infoPegawai[0]->nama_eselon1;
    $nama_eselon2  = $infoPegawai[0]->nama_eselon2;
    $nama_eselon3  = $infoPegawai[0]->nama_eselon3;
    $nama_eselon4  = $infoPegawai[0]->nama_eselon4;
    $nip           = $infoPegawai[0]->nip;
    $kelas_jabatan = $infoPegawai[0]->kelas_jabatan;
}
?>
<div class="col-lg-9">
    <div class="box box-solid">
        <div class="box-body">

            <div class="block" role="form">
                <h6 class="heading-hr">
                    <i class="icon-user"></i>Informasi Pegawai:</h6>
                <div class="block-inner">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>
                                    Pimpinan Tinggi Madya (Eselon I) :</label>
                                <span id="ContentPlaceHolder1_lbl_eselon1"><?php echo $nama_eselon1;?></span>
                            </div>
                            <div class="col-sm-6">
                                <label>
                                    Pimpinan Tinggi Pratama (Eselon II) :</label>
                                <span id="ContentPlaceHolder1_lbl_eselon2"><?php echo $nama_eselon2;?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>
                                    Administrator (Eselon III) :</label>
                                <span id="ContentPlaceHolder1_lbl_eselon3"><?php echo $nama_eselon3;?></span>
                            </div>
                            <div class="col-sm-6">
                                <label>
                                    Pengawas (Eselon IV) :</label>
                                <span id="ContentPlaceHolder1_lbl_eselon4"><?php echo $nama_eselon4;?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
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
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>
                                    Kelas Jabatan:</label>
                                <span id="ContentPlaceHolder1_lbl_klsjabatan"><?php echo $kelas_jabatan;?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<div class="col-xs-9">
    <div class="box">
        <div class="box-header">
            <div class ="box-tools">
            </div>
        </div>
        <div class="box-body">


            <div class="container col-lg-12" style="padding-top: 20px;">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#home">
                            Tugas Tambahan&nbsp;&nbsp;
                            <sup>
                                <span id="counter_tugas_tambahan_head" class="notif-count">
                                    <span id="counter_tugas_tambahan"></span>
                                </span>
                            </sup>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#menu1">
                            Kreativitas
                            <sup>
                                <span id="counter_kreativitas_head" class="notif-count">
                                    <span id="counter_kreativitas"></span>
                                </span>
                            </sup>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active" style="padding-top: 15px;">
                        <div class="col-lg-12">
                            <div class="box-header"></div>
                            <h2>Tugas Tambahan</h2>
                            <table id="table_belum_diperiksa" class="table table-bordered table-striped table-view">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Surat Keterangan</th>
                                        <th>File Surat Keterangan</th>
                                        <th>Keterangan</th>
                                        <th>Tahun</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="table_content">
                                <?php
                                    if ($tr_tugas_tambahan != 0)
                                    {
                                        # code...
                                        $active_keberatan = "";
                                        $active_banding = "";
                                        for ($i=0; $i < count($tr_tugas_tambahan); $i++) {
                                            # code...
                                ?>
                                            <tr>
                                                <td><?=$i+1;?></td>
                                                <td><?=$tr_tugas_tambahan[$i]->no_surat_keterangan;?></td>
                                                <td><a href="<?php echo site_url()?>public/file_tugas_tambahan/<?=$tr_tugas_tambahan[$i]->file_surat_keterangan;?>" class="btn btn-block btn-primary" target="_blank">Unduh</a></td>
                                                <td><?=$tr_tugas_tambahan[$i]->keterangan;?></td>
                                                <td><?=$tr_tugas_tambahan[$i]->tahun;?></td>
                                                <td>
                                                    <?php
                                                        if ($tr_tugas_tambahan[$i]->approve == 0) {
                                                            # code...
                                                            echo "Menunggu persetujuan atasan";
                                                        }
                                                        elseif ($tr_tugas_tambahan[$i]->approve == 1)
                                                        {
                                                            echo "Telah disetujui";
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-xs" onclick="approval_tugas_tambahan_act('<?=$id_pegawai;?>','<?=$tr_tugas_tambahan[$i]->id;?>','1')">Setuju</button>
                                                    <button class="btn btn-danger btn-xs" onclick="approval_tugas_tambahan_act('<?=$id_pegawai;?>','<?=$tr_tugas_tambahan[$i]->id;?>','2')">Tolak</button>
<!--                                                     <?php echo anchor('transaksi/approval_tugas_tambahan/'.$id_pegawai.'/'.$tr_tugas_tambahan[$i]->id.'/1','<button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>&nbsp;Setuju</button>');?>
                                                    <?php echo anchor('transaksi/approval_tugas_tambahan/'.$id_pegawai.'/'.$tr_tugas_tambahan[$i]->id.'/2','<button class="btn btn-danger btn-xs"><i class="fa fa-close"></i>&nbsp;Tolak</button>');?>                                                                                                         -->
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
                    <div id="menu1" class="tab-pane fade" style="padding-top: 15px;">
                        <div class="col-lg-12">
                            <div class="box-header"></div>
                            <h2>Kreativitas</h2>
                            <table id="table_belum_diperiksa" class="table table-bordered table-striped table-view">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Surat Keterangan</th>
                                        <th>File Surat Keterangan</th>
                                        <th>Keterangan</th>
                                        <th>Tahun</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="table_content">
                                <?php
                                    if ($tr_kreativitas != 0)
                                    {
                                        # code...
                                        $active_keberatan = "";
                                        $active_banding = "";
                                        for ($i=0; $i < count($tr_kreativitas); $i++) {
                                            # code...
                                ?>
                                            <tr>
                                                <td><?=$i+1;?></td>
                                                <td><?=$tr_kreativitas[$i]->no_surat_keterangan;?></td>
                                                <td><a href="<?php echo site_url()?>public/file_tugas_tambahan/<?=$tr_kreativitas[$i]->file_surat_keterangan;?>" class="btn btn-block btn-primary" target="_blank">Unduh</a></td>
                                                <td><?=$tr_kreativitas[$i]->keterangan;?></td>
                                                <td><?=$tr_kreativitas[$i]->tahun;?></td>
                                                <td>
                                                    <?php
                                                        if ($tr_kreativitas[$i]->approve == 0) {
                                                            # code...
                                                            echo "Menunggu persetujuan atasan";
                                                        }
                                                        elseif ($tr_kreativitas[$i]->approve == 1)
                                                        {
                                                            echo "Telah disetujui";
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-xs" onclick="approval_tugas_tambahan_act('<?=$id_pegawai;?>','<?=$tr_kreativitas[$i]->id;?>','1')">Setuju</button>
                                                    <button class="btn btn-danger btn-xs" onclick="approval_tugas_tambahan_act('<?=$id_pegawai;?>','<?=$tr_kreativitas[$i]->id;?>','2')">Tolak</button>
<!--                                                     <?php echo anchor('transaksi/approval_tugas_tambahan/'.$id_pegawai.'/'.$tr_kreativitas[$i]->id.'/1','<button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>&nbsp;Setuju</button>');?>
                                                    <?php echo anchor('transaksi/approval_tugas_tambahan/'.$id_pegawai.'/'.$tr_kreativitas[$i]->id.'/2','<button class="btn btn-danger btn-xs"><i class="fa fa-close"></i>&nbsp;Tolak</button>');?>                                                                                                         -->
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
    </div>
</div>
<?php
}
?>



<div class="example-modal">
<div class="modal modal-success fade" id="komentar_tolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="box-content">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Komentar Tolak</h4>
                </div>
                <div class="modal-body" style="background-color: #fff!important;">
                    <form id="editForm" name="addForm">

                        <label style="color: #000;font-weight: 400;font-size: 19px;">Komentar</label>
                        <div class="form-group"><div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-star"></i></span>
                            <textarea class="form-control" id="textarea_komentar_tolak_tugas" name="textarea_komentar_tolak_tugas"></textarea>
                            <input type="hidden" id="oid" name="oid" >
                            <input type="hidden" id="oid_pegawai" name="oid_pegawai" >
                            <input type="hidden" id="oid_param" name="oid_param" >
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
                    <input type="submit" class="btn btn-primary" value="Simpan" id="btn_tolak_tugas"/>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="example-modal">
<div class="modal modal-success fade" id="banding_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="box-content">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Komentar Banding</h4>
                </div>
                <div class="modal-body" style="background-color: #fff!important;">
                    <form id="editForm" name="addForm">

                        <label style="color: #000;font-weight: 400;font-size: 19px;">Komentar</label>
                        <div class="form-group"><div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-star"></i></span>
                            <textarea class="form-control" id="textarea_komentar_banding" name="textarea_komentar_banding"></textarea>
                            <input type="hidden" id="oid_banding" name="oid_banding" >
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
                    <input type="submit" class="btn btn-primary" value="Simpan" id="btn_banding"/>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
function current_time() {
    // body...
    var d  = new Date(); // for now
    hour   = d.getHours(); // => 9
    minute = d.getMinutes(); // =>  30
    d.getSeconds(); // => 51

    output = hour+":"+minute;
    return output;
}

function detail_tugas(id) {
    // body...
    $("#loadprosess").modal('show');
    setTimeout(function(){
        window.location.href = "<?php echo base_url().'index.php/transaksi/tugas_tambahan/'?>"+id;
    }, 1500);
}

function approval_tugas_tambahan_act(id_pegawai,id,param) {
    // body...
    text = "";
    if (param == 1)
    {
        text = "menyetujui";
    }
    else if (param == 2)
    {
        text = "tolak";
    }

    Lobibox.confirm({
         title: "Konfirmasi",
         msg: "Anda yakin akan "+text+" tugas tambahan ini ?",
         callback: function ($this, type) {
            if (type === 'yes'){
              if (param == 1)
              {
                  send_data(id_pegawai,id,param,'');
              }
              else if (param == 2)
              {
                  text = "tolak";
                  $("#komentar_tolak").modal('show');
                  $("#oid").val(id);
                  $("#oid_pegawai").val(id_pegawai);
                  $("#oid_param").val(param);
              }
            }
        }
    })
}

function send_data(id_pegawai,id,param,data_sender){
  data_sender = {
                    'komentar' : data_sender
  }
  $.ajax({
      url :"<?php echo site_url()?>transaksi/approval_tugas_tambahan/"+id_pegawai+"/"+id+"/"+param,
      type:"post",
      data:{data_sender : data_sender},
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
              msg: 'Gagal Melakukan Hapus data'
          });
      }
  })
}

// function detail_foto(link) {
//     // body...
// }

$(document).ready(function()
{
    counter_proses = "<?php
                            if ($tr_tugas_tambahan != 0)
                            {
                                echo count($tr_tugas_tambahan);
                            }
                            else
                            {
                                echo "0";
                            }
                      ?>";
    counter_revisi = "<?php
                            if ($tr_kreativitas != 0)
                            {
                                echo count($tr_kreativitas);
                            }
                            else
                            {
                                echo "0";
                            }
                      ?>";



    $('#counter_proses').html(counter_proses);
    $('#counter_revisi').html(counter_revisi);
    if (counter_proses            == 0)$("#counter_proses_head").css("display","none");
    if (counter_revisi            == 0)$("#counter_revisi_head").css("display","none");


    $('.timerange').datepicker({
        format: 'yyyy-mm-dd'
    });
    $(".timerange").datepicker({ maxDate: new Date});

    $(".timerange").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});

    $("[data-mask]").inputmask();
    $("#urtug").change(function(){
        var urtug = $("#urtug option:selected").text();
        var str = new String(urtug);
        var n = str.indexOf("perjalanan dinas");
        var n1 = str.indexOf("Perjalanan Dinas");

        if (n > 0 || n1 > 0) {
            console.log("lock");
            $(".timemasking").prop('disabled', true);
            $(".timemasking").val('08:00:00');
            $("#flag_urtug").val('perjalanan_dinas');
        }
        else {
            console.log("unlock");
            $(".timemasking").prop('disabled', false);
            $(".timemasking").val('');
            $("#flag_urtug").val('-');
        }

        var id = $("#urtug").val();
        $.ajax({
            url :"<?php echo site_url()?>/transaksi/get_detail_skp",
            type:"post",
            data:"id="+id,
            beforeSend:function(){
                $("#loadprosess").modal('show');
            },
            success:function(msg){
                var obj = jQuery.parseJSON (msg);
                $("#param_out_skp").html(obj.target_output_name);
                setTimeout(function(){
                    $("#loadprosess").modal('hide');
                }, 2000);
            }
        })


    })

    $("#btn_tolak_tugas").click(function()
    {
        id_pegawai = $("#oid_pegawai").val();
        id         = $("#oid").val();
        param      = $("#oid_param").val();
        komentar   = $("#textarea_komentar_tolak_tugas").val();
        send_data(id_pegawai,id,param,komentar);
    });

    $("#btn_save").click(function()
    {
        flag_urtug        = $("#flag_urtug").val();

        urtug             = $("#urtug").val();
        tgl_mulai         = $("#tgl_mulai").val();
        tgl_selesai       = $("#tgl_selesai").val();
        jam_mulai         = $("#jam_mulai").val();
        jam_selesai       = $("#jam_selesai").val();
        tgl_server        = current_date();
        ket_pekerjaan     = $("#ket_pekerjaan").val();
        kuantitas         = $("#kuantitas").val();
        file_pendukung    = $('#file_pendukung').prop('files')[0];
        // console.log(file_pendukung);

        waktu_mulai       = tgl_mulai+" "+jam_mulai;
        waktu_selesai     = tgl_selesai+" "+jam_selesai;

        start_actual_time    = new Date(waktu_mulai);
        end_actual_time      = new Date(waktu_selesai);
        server_actual_time   = new Date();
        diff                 = end_actual_time - start_actual_time;
        diff_date            = (new Date(tgl_selesai)) - (new Date(tgl_mulai));


        hari_efektif      = ((diff_date/1000) / 86400);
        menit_efektif     = diff / 60000;

        if (urtug.length <= 0 || tgl_mulai.length <= 0 || tgl_selesai.length <= 0 || jam_mulai.length <= 0 || jam_selesai.length <= 0 || ket_pekerjaan.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Harap lengkapi data-data dibawah ini."
            });
        }
        else
        {
            if (tgl_mulai > tgl_server || tgl_selesai > tgl_server)
            {
                Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                {
                    msg: "Tanggal tidak boleh melebihi Tanggal server."
                });
            }
            else
            {
                if (diff < 0)
                {
                    Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                    {
                        msg: "Tanggal dan jam awal tidak boleh melebihi tanggal dan jam selesai."
                    });
                }
                else
                {
                    console.log('unlock');

                    if (end_actual_time > server_actual_time)
                    {
                        Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                        {
                            msg: "Jam tidak boleh melebihi jam server."
                        });
                        // console.log('lock 1');
                        // console.log('lock');
                    }
                    else
                    {
                        // console.log('unlock 1');
                        var form_data = new FormData();
                        form_data.append('file', file_pendukung);
                        $.ajax({
                            url: '<?php echo site_url();?>/transaksi/upload_file_pendukung/', // point to server-side PHP script
                            // dataType: 'json',  // what to expect back from the PHP script, if anything
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,
                            type: 'post',
                            beforeSend:function(){
                                $("#editData").modal('hide');
                                $("#loadprosess").modal('show');
                                Lobibox.notify('info', {
                                    msg: 'Menyiapkan data untuk upload file'
                                    });
                            },
                            success: function(msg1){
                                var obj1 = jQuery.parseJSON (msg1);
                                console.log(msg1);
                                if (obj1.status == 1)
                                {
                                    var data_sender = {
                                                            'urtug'             : urtug,
                                                            'flag_urtug'        : flag_urtug,
                                                            'tgl_mulai'         : tgl_mulai,
                                                            'tgl_selesai'       : tgl_selesai,
                                                            'jam_mulai'         : jam_mulai,
                                                            'jam_selesai'       : jam_selesai,
                                                            'ket_pekerjaan'     : ket_pekerjaan,
                                                            'kuantitas'         : kuantitas,
                                                            'menit_efektif'     : menit_efektif,
                                                            'hari_efektif'      : hari_efektif
                                                      };
                                    $.ajax({
                                        url :"<?php echo site_url();?>/transaksi/add_pekerjaan/"+obj1.id,
                                        type:"post",
                                        data:{data_sender : data_sender},
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
                        });
                        console.log('unlock');
                    }
                }



            }
        }
    })


    $("#btn_keberatan").click(function()
    {
        var data_sender = {
                                'id_pekerjaan': $("#oid_keberatan").val(),
                                'komentar'    : $("#textarea_komentar_keberatan").val()
                          };
        $.ajax({
            url :"<?php echo site_url();?>/transaksi/keberatan",
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
                    msg: 'Gagal melakukan transaksi'
                });
            }
        })
    });


    $("#btn_banding").click(function()
    {
        var data_sender = {
                                'id_pekerjaan': $("#oid_banding").val(),
                                'komentar'    : $("#textarea_komentar_banding").val()
                          };
        $.ajax({
            url :"<?php echo site_url();?>/transaksi/banding",
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
                    msg: 'Gagal melakukan transaksi'
                });
            }
        })
    });

});
</script>
