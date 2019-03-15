<?php
$infoPegawai   = $this->Globalrules->get_info_pegawai($id,'id');
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
    text-align: center;
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
    background-color: #8BC34A;
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
    background-color: #FF9800;
    color: #fff;
}
</style>

<div class="col-lg-12">
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
                </div>
            </div>


        </div>
    </div>
</div>

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
                        <li style="cursor: pointer;" class="teamwork" id="li_kandidat_<?=$i;?>" onclick="detail_skp('<?=$member[$i]->id;?>','<?=$i;?>')">
                          <a class="contact-name">
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


<div class="col-xs-9">
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
        <div class="box-body" style="overflow:auto;">
            <table id="table_skp" class="table table-bordered table-striped table-view">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Kegiatan tugas jabatan</th>
                        <!-- <th style="width: 10%;" rowspan="2">Perjanjian Kerja</th>
                        <th rowspan="2">Jenis SKP</th>                         -->
                        <th rowspan="2">AK</th>
                        <th colspan="6">Target</th>
                        <!-- <th rowspan="2" style="width: 5%;">Status</th> -->
                        <th rowspan="2">Keterangan</th>
                        <th rowspan="2" style="min-width: 100px;">Aksi</th>
                    </tr>
                    <tr>
                        <th style="max-width: 40px!important;width: 40px!important;">Kuan</th>
                        <th style="max-width: 40px!important;width: 40px!important;">Output</th>
                        <th style="max-width: 40px!important;width: 40px!important;">Kual / mutu</th>
                        <th style="max-width: 70px!important;width: 70px!important;" colspan="2">Waktu</th>
                        <th>Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $kegiatan = "";
                    if ($list!=0) {
                        # code...
                        for ($i=0; $i < count($list); $i++) {
                            # code...
                            $status              = "";
                            $pk_status           = "";
                            $keterangan          = "";

                            if($list[$i]->kegiatan == '')
                            {
                                if ($kat_posisi == 1) {
                                    # code...
                                    if ($list[$i]->id_skp_master != '') {
                                        # code...
                                        $kegiatan = $list[$i]->kegiatan_skp;
                                    }                                
                                }
                                elseif ($kat_posisi == 2) {
                                    # code...
                                    if ($list[$i]->id_skp_jft != '') {
                                        # code...
                                        $kegiatan = $list[$i]->kegiatan_skp_jft;
                                    }                                
                                }                            
                                elseif ($kat_posisi == 4) {
                                    # code...
                                    if ($list[$i]->id_skp_jfu != '') {
                                        # code...
                                        $kegiatan = $list[$i]->kegiatan_skp_jfu;
                                    }                                
                                }
                                elseif ($kat_posisi == 6) {
                                    # code...
                                    if ($list[$i]->id_skp_master != '') {
                                        # code...
                                        $kegiatan = $list[$i]->kegiatan_skp;
                                    }                                
                                }                                
                                else {
                                    # code...
                                    $kegiatan = $list[$i]->kegiatan_skp_jfu;
                                }
                            }
                            else {
                                # code...
                                $kegiatan = $list[$i]->kegiatan;
                            }


                            $AK_target           = $list[$i]->AK_target;
                            $target_qty          = $list[$i]->target_qty;
                            $target_output       = $list[$i]->target_output_name;
                            $target_kualitasmutu = $list[$i]->target_kualitasmutu;
                            $target_waktu_bln    = $list[$i]->target_waktu_bln;
                            $target_biaya        = $list[$i]->target_biaya;
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

                            if ($list[$i]->status == 1 || $list[$i]->edit_status == 3) {
                                # code...
                                $status = "Close";
                                if ($list[$i]->edit_status == 3) {
                                      # code...
                                    $keterangan = "Perubahan target SKP";
                                }
                            }
                            else
                            {
                                $status = "Open";
                            }
                    ?>
                    <tr>
                        <td><?=$i+1;?></td>
                        <td><?=$kegiatan;?></td>
                        <!-- <td><?=$pk_status;?></td>
                        <td><?=$jenis_skp;?></td>                         -->
                        <td><?=$AK_target;?></td>
                        <td><?=$target_qty;?></td>
                        <td><?=$target_output;?></td>
                        <td><?=$target_kualitasmutu;?></td>
                        <td><?=$target_waktu_bln;?></td>
                        <td>bln</td>
                        <td><?=number_format($target_biaya);?></td>
                        <!-- <td><?=$status;?></td> -->
                        <td><?=$keterangan;?></td>
                        <td>
                            <button class="btn btn-success btn-xs" onclick="approve_skp('<?=$list[$i]->skp_id;?>','<?=$list[$i]->status;?>','<?=$list[$i]->edit_status;?>')"><i class="fa fa-edit"></i>&nbsp;Setuju</button>
                            <button class="btn btn-danger btn-xs" onclick="reject_skp('<?=$list[$i]->skp_id;?>','<?=$list[$i]->status;?>','<?=$list[$i]->edit_status;?>')"><i class="fa fa-edit"></i>&nbsp;Tolak</button>
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


<div class="example-modal">
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
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Angka Kredit</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="text" id="ak_target" name="ak_target" class="form-control">
                                    </div>
                                </div>


                                <div class="form-group col-md-6">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Target Kuantitas</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="text" id="jumlah" name="jumlah" class="form-control" >
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
                                        <input type="text" id="kualitas_mutu" name="kualitas_mutu" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Target Waktu</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="text" id="waktu" name="waktu" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label style="color: #000;font-weight: 400;font-size: 19px;">Target Biaya</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="text" id="biaya" name="biaya" class="form-control" >
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
</div>

<div class="example-modal">
<div class="modal modal-success fade" id="tolak_skp_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="box-content">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Alasan Tolak Target SKP</h4>
                </div>
                <div class="modal-body" style="background-color: #fff!important;">
                    <form id="editForm" name="addForm">

                        <label style="color: #000;font-weight: 400;font-size: 19px;">Alasan</label>
                        <div class="form-group"><div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-star"></i></span>
                            <textarea class="form-control" id="textarea_alasan_tolak" name="textarea_alasan_tolak"></textarea>
                            <input type="hidden" id="oid_tolak" name="oid_tolak" >
                            <input type="hidden" id="status_tolak" name="status_tolak" >
                            <input type="hidden" id="status_edit_tolak" name="status_edit_tolak" >
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
                    <input type="submit" class="btn btn-primary" value="Simpan" id="btn_tolak_skp"/>

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
// alert(1+1);
function edit(param) {
    // body...
}

function del(param) {
    // body...
}

function approve_skp(id,status,status_edit) {
    // body...
     if (status_edit == '')status_edit = 0;
     Lobibox.confirm({
         title: "Konfirmasi",
         msg: "Anda akan menyetujui Target SKP ini ?",
         callback: function ($this, type) {
            if (type === 'yes'){
                $.ajax({
                    url :"<?php echo site_url()?>/skp/approve_and_reject_skp/"+id+"/1/"+status+'/'+status_edit,
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


function reject_skp(id,status,status_edit) {
    // body...
    if (status_edit == '')status_edit = 0;
    Lobibox.confirm({
        title: "Konfirmasi",
        msg: "Anda akan tolak Target SKP ini ?",
        callback: function ($this, type) {
            if (type === 'yes'){
                $("#tolak_skp_data").modal('show');
                $("#oid_tolak").val(id);
                $("#status_tolak").val(status);
                $("#status_edit_tolak").val(status_edit);
            }
        }
    })
}

function detail_skp(id) {
    // body...
    $("#loadprosess").modal('show');                                                    
    setTimeout(function(){
        window.location.href = "<?php echo base_url().'index.php/skp/skp_member_detail_plt/'?>"+id;
    }, 500);                               
}

$(document).ready(function()
{
    $("#addDataSKP").click(function(){
        // body...
        $('#tambah_dataskp').attr('class', 'modal fade bs-example-modal-lg')
                            .attr('aria-labelledby','myLargeModalLabel');
        $('.modal-dialog').attr('class','modal-dialog modal-lg');
        $("#tambah_dataskp").modal('show');
    })

    $("#btn_tolak_skp").click(function() {
        // body...
        alasan      = $("#textarea_alasan_tolak").val();
        id          = $("#oid_tolak").val();
        status      = $("#status_tolak").val();
        status_edit = $("#status_edit_tolak").val();

        if (alasan.length <= 0)
        {
            // $("#tolak_skp_data").modal('hide');
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Alasan Skp ditolak mohon diisi."
            });
        }
        else
        {
            var data_sender = {
                                    'alasan'    : alasan
                              };
            $.ajax({
                url :"<?php echo site_url()?>skp/approve_and_reject_skp/"+id+"/2/"+status+'/'+status_edit,
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
    })

    $("#btn_save_skp").click(function() {
        // body...
        var kegiatan      = $('#kegiatan').val();
        var pk            = $('#perjanjian_kerja').val();
        var ak_target     = $('#ak_target').val();
        var jumlah        = $('#jumlah').val();
        var kualitas_mutu = $('#kualitas_mutu').val();
        var satuan        = $('#satuan').val();
        var waktu         = $('#waktu').val();
        var biaya         = $('#biaya').val();

        var data_sender = {
                                'kegiatan'      : kegiatan,
                                'pk'            : pk,
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
                ajax_status(obj);
            },
            error:function(jqXHR,exception)
            {
                ajax_catch(jqXHR,exception);					
            }
        })
    })

});
</script>
