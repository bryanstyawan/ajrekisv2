<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/tabs-checked/css/style_tabs.css'; ?>");</style>
<div class="col-xs-12">
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
                            <div class="box-header">
                                <h3 class  ="box-title pull-right">
                                    <a href="<?php echo site_url()?>transaksi/tugas_tambahan_dan_kreativitas/add-tugas-tambahan" class="btn btn-block btn-primary"> <i class="fa fa-plus-square"></i>Tambah Tugas Tambahan</a>
                                <div class ="box-tools">
                                </div>
                            </div>
                            <h2>Tugas Tambahan</h2>
                            <table id="table_tugas_tambahan" class="table table-bordered table-striped table-view">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Surat Keterangan</th>
                                        <th>File Surat Keterangan</th>
                                        <th>Keterangan</th>
                                        <th>Tahun</th>
                                        <th>Status</th>
                                        <th>Komentar</th>
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
                                                <td><a href="<?php echo site_url()?>public/file_tugas_tambahan/<?=$tr_tugas_tambahan[$i]->file_surat_keterangan;?>" class="btn btn-block btn-primary">Unduh</a></td>
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
                                                        elseif ($tr_tugas_tambahan[$i]->approve == 2) {
                                                            // code...
                                                            echo "Telah ditolak";
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if ($tr_tugas_tambahan[$i]->approve == 2) {
                                                            # code...
                                                            echo $tr_tugas_tambahan[$i]->komentar;
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($tr_tugas_tambahan[$i]->approve == 0 || $tr_tugas_tambahan[$i]->approve == 2) {
                                                        # code...
                                                    ?>
                                                        <a href="<?php echo site_url()?>transaksi/tugas_tambahan_dan_kreativitas/edit-tugas-tambahan/<?=$tr_tugas_tambahan[$i]->id;?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                        <a class="btn btn-danger" onclick="delete_tugas_tambahan('<?=$tr_tugas_tambahan[$i]->id;?>')"><i class="fa fa-close"></i></a>
                                                    <?php
                                                    }
                                                    ?>
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
                            <div class="box-header">
                                <h3 class  ="box-title pull-right">
                                    <a href="<?php echo site_url()?>transaksi/tugas_tambahan_dan_kreativitas/add-kreativitas" class="btn btn-block btn-primary"> <i class="fa fa-plus-square"></i> Kreativitas</a>
                                <div class ="box-tools">
                                </div>
                            </div>
                            <h2>Kreativitas</h2>
                            <table id="table_kreativitas" class="table table-bordered table-striped table-view">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Surat Keterangan</th>
                                        <th>Pejabat Penanda Tangan</th>
                                        <th>File Surat Keterangan</th>
                                        <th>Keterangan</th>
                                        <th>Tahun</th>
                                        <th>Status</th>
                                        <th>Komentar</th>
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
                                                <td><?=$tr_kreativitas[$i]->pejabat_penanda_tangan;?></td>
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
                                                        elseif ($tr_kreativitas[$i]->approve == 2)
                                                        {
                                                            echo "Telah ditolak";
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if ($tr_kreativitas[$i]->approve == 2) {
                                                            # code...
                                                            echo $tr_kreativitas[$i]->komentar;
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if ($tr_kreativitas[$i]->approve == 0 || $tr_kreativitas[$i]->approve == 2) {
                                                            # code...
                                                    ?>
                                                            <a class="btn btn-warning" href="<?php echo site_url()?>transaksi/tugas_tambahan_dan_kreativitas/edit-kreativitas/<?=$tr_kreativitas[$i]->id;?>"><i class="fa fa-edit"></i></a>
                                                            <a class="btn btn-danger" onclick="delete_tugas_tambahan('<?=$tr_kreativitas[$i]->id;?>')"><i class="fa fa-close"></i></a>
                                                    <?php
                                                        }
                                                    ?>
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

function delete_tugas_tambahan(id) {
    Lobibox.confirm({
        title: "Konfirmasi",
        msg: "Anda yakin akan menghapus data ini ?",
        callback: function ($this, type) {
            if (type === 'yes'){
                $.ajax({
                    url :"<?php echo site_url()?>/transaksi/get_delete_tugas_tambahan/"+id,
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
                            msg: 'Gagal Melakukan Hapus data'
                        });
                    }
                })
            }
        }
    })
}

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
    counter_kreativitas = "<?php
                            if ($tr_kreativitas != 0)
                            {
                                echo count($tr_kreativitas); }
                            else
                            {
                                echo "0";
                            }
                        ?>";

    counter_kreativitas = 0;
    counter_proses = 0;

    $('#counter_proses').html(counter_proses);
    $('#counter_kreativitas').html(counter_kreativitas);
    if (counter_proses            == 0)$("#counter_proses_head").css("display","none");
    if (counter_kreativitas            == 0)$("#counter_kreativitas_head").css("display","none");


    $('.timerange').datepicker({
        format: 'yyyy-mm-dd'
    });
    $(".timerange").datepicker({ maxDate: new Date});

    $(".timerange").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});

    $("[data-mask]").inputmask();
});
</script>
