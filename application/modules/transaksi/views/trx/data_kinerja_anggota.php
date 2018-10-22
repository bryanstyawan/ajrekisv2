<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/tabs-checked/css/style_tabs.css'; ?>");</style>
<div class="col-xs-12">
	<div class="box">
        <div class="box-header">
			<h3 class="box-title">Anggota Tim</h3>
        </div>
        <div class="box-body" id="isi">

<?php
$nama_pegawai  = "";
$nama_jabatan  = "";
$nama_eselon1  = "";
$nama_eselon2  = "";
$nama_eselon3  = "";
$nama_eselon4  = "";
$nip           = "";
$kelas_jabatan = "";
if ($pegawai != 0 || $pegawai != '') {
    # code...
    $nama_pegawai  = $pegawai[0]->nama_pegawai;
    $nama_jabatan  = $pegawai[0]->nama_jabatan;
    $nama_eselon1  = $pegawai[0]->nama_eselon1;
    $nama_eselon2  = $pegawai[0]->nama_eselon2;
    $nama_eselon3  = $pegawai[0]->nama_eselon3;
    $nama_eselon4  = $pegawai[0]->nama_eselon4;
    $nip           = $pegawai[0]->nip;
    $kelas_jabatan = $pegawai[0]->kelas_jabatan;
?>
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
<?php
}
?>

            <div class="container col-lg-12" style="padding-top: 20px;">
                <ul class="nav nav-tabs">
<?php
                    if ($param == 0) {
                        # code...
?>
                    <li class="active">
                        <a data-toggle="tab" href="#home">
                            Belum Diperiksa&nbsp;&nbsp;
                            <sup>
                                <span id="counter_proses_head" class="notif-count">
                                    <span id="counter_proses"></span>
                                </span>
                            </sup>
                        </a>
                    </li>
<?php
                    }
                    elseif ($param == 4)
                    {
                        # code...
?>
                    <li class="active">
                        <a data-toggle="tab" href="#menu1" aria-expanded="true">
                            Tahap Keberatan
                            <sup>
                                <span id="counter_keberatan_head" class="notif-count">
                                    <span id="counter_keberatan"></span>
                                </span>
                            </sup>
                        </a>
                    </li>
<?php
                    }
                    elseif ($param == 6)
                    {
                        # code...
?>
                    <li>
                        <a data-toggle="tab" href="#menu2">
                            Tahap Banding
                            <sup>
                                <span id="counter_banding_head" class="notif-count">
                                    <span id="counter_banding"></span>
                                </span>
                            </sup>
                        </a>
                    </li>
                </ul>
<?php
                    }
?>

                <div class="tab-content">
<?php
                    if ($param == 0) {
                        # code...
?>
                    <div id="home" class="tab-pane fade in active" style="padding-top: 15px;">
                        <div class="col-lg-12">
                            <h2>Belum diperiksa</h2>
                            <table id="example1" class="table table-bordered table-striped table-view">
                              <thead>
                            <tr>
                              <th>
                                <a href="#" class="btn btn-success btn-xs" onclick="approve_all()"><i class="fa fa-check"></i></a>
                                <a href="#" class="btn btn-warning btn-xs" onclick="revisi_all()"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-xs" onclick="reject_all()"><i class="fa fa-close"></i></a>
                              </th>
                              <th>Nama</th>
                              <th>Tanggal,Jam Mulai</th>
                              <th>Tanggal,Jam Selesai</th>
                              <th>Uraian Tugas</th>
                              <th>Realisasi SKP</th>
                              <th>Target SKP</th>
                              <th>Pekerjaan</th>
                              <th>Output Kuantitas</th>
                              <th>File Pendukung</th>
                              <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if ($kinerja_anggota != 0) {
                                    # code...
                                    for ($i=0; $i < count($kinerja_anggota); $i++) {
                                        # code...
                            ?>
                                        <tr>
                                            <th>
                                                <input class="minimal" type="checkbox" id="checkbox_<?=$i;?>" name="counter_checkbox">
                                                <input type="hidden" id="hdn_id_<?=$i;?>" value="<?=$kinerja_anggota[$i]->id_pekerjaan;?>">
                                            </th>
                                            <td><?=$kinerja_anggota[$i]->nama_pegawai;?></td>
                                            <td><?=$kinerja_anggota[$i]->tanggal_mulai;?>&nbsp;<?=$kinerja_anggota[$i]->jam_mulai;?></td>
                                            <td><?=$kinerja_anggota[$i]->tanggal_selesai;?>&nbsp;<?=$kinerja_anggota[$i]->jam_selesai;?></td>
                                            <td><a href=""><?=$kinerja_anggota[$i]->kegiatan_skp;?></a></td>
                                            <td><?=$kinerja_anggota[$i]->realisasi_skp;?></td>
                                            <td><?=$kinerja_anggota[$i]->target_skp;?></td>
                                            <td><?=$kinerja_anggota[$i]->nama_pekerjaan;?></td>
                                            <td><?=$kinerja_anggota[$i]->frekuensi_realisasi.' '.$kinerja_anggota[$i]->target_output_name;?></td>
                                            <td>
                                                <?php
                                                    $link = "";
                                                    if ($kinerja_anggota[$i]->file_pendukung != '') {
                                                        # code...
                                                ?>
                                                    <a class="btn btn-success btn-xs" href="<?php echo base_url() . 'public/file_pendukung/'.$kinerja_anggota[$i]->file_pendukung; ?>"><i class="fa fa-download"></i>&nbsp;Unduh</a>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <div class="col-lg-12" style="padding-bottom: 10px;">
                                                    <a href="#" onclick="approve('<?=$kinerja_anggota[$i]->id_pekerjaan;?>')" class="btn btn-success btn-xs"><i class="fa fa-check"></i>&nbsp;Setuju</a>
                                                </div><br>
                                                <div class="col-lg-12" style="padding-bottom: 10px;">
                                                    <a href="#" onclick="revisi('<?=$kinerja_anggota[$i]->id_pekerjaan;?>')" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i>&nbsp;Revisi</a>
                                                </div><br>
                                                <div class="col-lg-12" style="padding-bottom: 10px;">
                                                    <a href="#" onclick="reject('<?=$kinerja_anggota[$i]->id_pekerjaan;?>')" class="btn btn-danger btn-xs"><i class="fa fa-close"></i>&nbsp;Tolak</a>
                                                </div>
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
<?php
                    }
                    elseif ($param == 4) {
                        # code...
?>
                    <div id="menu1" class="tab-pane fade active in" style="padding-top: 15px;">
                        <div class="col-lg-12">
                            <h2>Keberatan</h2>
                            <table id="example2" class="table table-bordered table-striped table-view">
                              <thead>
                            <tr>
                              <th>NIP</th>
                              <th>Nama</th>
                              <th>Tanggal Mulai</th>
                              <th>Tanggal Selesai</th>
                              <th>Jam Mulai</th>
                              <th>Jam Selesai</th>
                              <th>Pekerjaan</th>
                              <th>Output Kuantitas</th>
                              <th>File Pendukung</th>
                              <th>Alasan Keberatan</th>
                              <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if ($keberatan != 0) {
                                    # code...
                                    for ($i=0; $i < count($keberatan); $i++) {
                                        # code...
                            ?>
                                        <tr>
                                            <td><?=$keberatan[$i]->nip;?></td>
                                            <td><?=$keberatan[$i]->nama_pegawai;?></td>
                                            <td><?=$keberatan[$i]->tanggal_mulai;?></td>
                                            <td><?=$keberatan[$i]->tanggal_selesai;?></td>
                                            <td><?=$keberatan[$i]->jam_mulai;?></td>
                                            <td><?=$keberatan[$i]->jam_selesai;?></td>
                                            <td><?=$keberatan[$i]->nama_pekerjaan;?></td>
                                            <td><?=$keberatan[$i]->frekuensi_realisasi.' '.$keberatan[$i]->target_output_name;?></td>
                                            <td><a class="btn btn-success btn-xs" href="<?php echo base_url() . 'public/file_pendukung/'.$keberatan[$i]->file_pendukung; ?>"><i class="fa fa-download"></i>&nbsp;Unduh</a></td>
                                            <td><?=$keberatan[$i]->komentar_keberatan;?></td>
                                            <td>
                                                <div class="col-lg-6">
                                                    <a href="#" onclick="approve('<?=$keberatan[$i]->id_pekerjaan;?>')" class="btn btn-success btn-xs"><i class="fa fa-check"></i>&nbsp;Setuju</a>
                                                </div>
                                                <div class="col-lg-6">
                                                    <a href="#" onclick="reject_keberatan('<?=$keberatan[$i]->id_pekerjaan;?>')" class="btn btn-danger btn-xs"><i class="fa fa-close"></i>&nbsp;Tolak</a>
                                                </div>
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
<?php
                    }
                    if ($param == 6) {
                        # code...
?>
                    <div id="menu2" class="tab-pane fade active in" style="padding-top: 15px;">
                        <div class="col-lg-12">
                            <h2>Banding</h2>
                            <table id="example2" class="table table-bordered table-striped table-view">
                              <thead>
                            <tr>
                              <th>NIP</th>
                              <th>Nama</th>
                              <th>Tanggal Mulai</th>
                              <th>Tanggal Selesai</th>
                              <th>Jam Mulai</th>
                              <th>Jam Selesai</th>
                              <th>Pekerjaan</th>
                              <th>Output Kuantitas</th>
                              <th>File Pendukung</th>
                              <th>Alasan Banding</th>
                              <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if ($banding != 0) {
                                    # code...
                                    for ($i=0; $i < count($banding); $i++) {
                                        # code...
                            ?>
                                        <tr>
                                            <td><?=$banding[$i]->nip;?></td>
                                            <td><?=$banding[$i]->nama_pegawai;?></td>
                                            <td><?=$banding[$i]->tanggal_mulai;?></td>
                                            <td><?=$banding[$i]->tanggal_selesai;?></td>
                                            <td><?=$banding[$i]->jam_mulai;?></td>
                                            <td><?=$banding[$i]->jam_selesai;?></td>
                                            <td><?=$banding[$i]->nama_pekerjaan;?></td>
                                            <td></td>
                                            <td></td>
                                            <td><?=$banding[$i]->komentar_banding;?></td>
                                            <td>
                                                <div class="col-lg-6">
                                                    <a href="#" onclick="approve('<?=$banding[$i]->id_pekerjaan;?>')" class="btn btn-success btn-xs"><i class="fa fa-check"></i>&nbsp;Setuju</a>
                                                </div>
                                                <div class="col-lg-6">
                                                    <a href="#" onclick="reject_banding('<?=$banding[$i]->id_pekerjaan;?>')" class="btn btn-danger btn-xs"><i class="fa fa-close"></i>&nbsp;Tolak</a>
                                                </div>
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
<?php
                    }
?>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="example-modal">
<div class="modal modal-success fade" id="revisi_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="box-content">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Komentar Revisi</h4>
              	</div>
            	<div class="modal-body" style="background-color: #fff!important;">
					<form id="editForm" name="addForm">

						<label style="color: #000;font-weight: 400;font-size: 19px;">Komentar</label>
						<div class="form-group"><div class="input-group">
		                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
		                    <textarea class="form-control" id="textarea_komentar_revisi" name="textarea_komentar_revisi"></textarea>
							<input type="hidden" id="oid_revisi" name="oid_revisi" >
							</div>
						</div>

					</form>
                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
					<input type="submit" class="btn btn-primary" value="Simpan" id="btn_revisi"/>

                </div>
            </div>
        </div>
	</div>
</div>
</div>

<div class="example-modal">
<div class="modal modal-success fade" id="tolak_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="box-content">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Alasan Tolak Pekerjaan</h4>
              	</div>
            	<div class="modal-body" style="background-color: #fff!important;">
					<form id="editForm" name="addForm">

						<label style="color: #000;font-weight: 400;font-size: 19px;">Alasan</label>
						<div class="form-group"><div class="input-group">
		                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
		                    <textarea class="form-control" id="textarea_alasan_tolak" name="textarea_alasan_tolak"></textarea>
							<input type="hidden" id="oid_tolak" name="oid_tolak" >
							</div>
						</div>

					</form>
                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
					<input type="submit" class="btn btn-primary" value="Simpan" id="btn_tolak"/>

                </div>
            </div>
        </div>
	</div>
</div>
</div>

<div class="example-modal">
<div class="modal modal-success fade" id="tolak_data_keberatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="box-content">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Alasan Tolak Keberatan</h4>
                </div>
                <div class="modal-body" style="background-color: #fff!important;">
                    <form id="editForm" name="addForm">

                        <label style="color: #000;font-weight: 400;font-size: 19px;">Alasan</label>
                        <div class="form-group"><div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-star"></i></span>
                            <textarea class="form-control" id="textarea_alasan_tolak_keberatan" name="textarea_alasan_tolak_keberatan"></textarea>
                            <input type="hidden" id="oid_tolak_keberatan" name="oid_tolak_keberatan" >
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
                    <input type="submit" class="btn btn-primary" value="Simpan" id="btn_tolak_keberatan"/>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="example-modal">
<div class="modal modal-success fade" id="tolak_data_banding" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="box-content">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Alasan Tolak Banding</h4>
                </div>
                <div class="modal-body" style="background-color: #fff!important;">
                    <form id="editForm" name="addForm">

                        <label style="color: #000;font-weight: 400;font-size: 19px;">Alasan</label>
                        <div class="form-group"><div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-star"></i></span>
                            <textarea class="form-control" id="textarea_alasan_tolak_banding" name="textarea_alasan_tolak_banding"></textarea>
                            <input type="hidden" id="oid_tolak_banding" name="oid_tolak_banding" >
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
                    <input type="submit" class="btn btn-primary" value="Simpan" id="btn_tolak_banding"/>
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
$(document).ready(function()
{
    counter_proses = "<?php
                            if ($kinerja_anggota != 0)
                            {
                                echo count($kinerja_anggota);
                            }
                            else
                            {
                                echo "0";
                            }
                      ?>";
    counter_keberatan = "<?php
                            if ($keberatan != 0)
                            {
                                echo count($keberatan);
                            }
                            else
                            {
                                echo "0";
                            }
                      ?>";
    counter_banding = "<?php
                            if ($banding != 0)
                            {
                                echo count($banding);
                            }
                            else
                            {
                                echo "0";
                            }
                      ?>";


    $('#counter_proses').html(counter_proses);
    $('#counter_keberatan').html(counter_keberatan);
    $('#counter_banding').html(counter_banding);
    if (counter_proses    == 0)$("#counter_proses_head").css("display","none");
    if (counter_keberatan == 0)$("#counter_keberatan_head").css("display","none");
    if (counter_banding   == 0)$("#counter_banding").css("display","none");

    $("#btn_revisi").click(function()
    {
        data_sender = [];
        if ($("#oid_revisi").val() == 'all-aout')
        {
            var inputs      = document.getElementsByName('counter_checkbox');
            for (var i = 0; i < inputs.length; i++) {
                checkbox_id      = $('#checkbox_'+i).is(':checked');
                if (checkbox_id != false)
                {
                    id_verify  = $('#hdn_id_'+i).val();
                    data_sender.push({
                                        'id_pekerjaan' : id_verify,
                                        'komentar'    : $("#textarea_komentar_revisi").val()
                                    });
                }
            }

            if (data_sender.length != 0)
            {
                send_data_revisi(data_sender,'all-aout');
            }
            else
            {
                Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                {
                    msg: "Tidak bisa melanjutkan proses ini, tidak ada data yang dipilih"
                });
            }
        }
        else
        {
    	    var data_sender = {
    	                            'id_pekerjaan': $("#oid_revisi").val(),
    	                            'komentar'	  : $("#textarea_komentar_revisi").val()
    	                      };
						if ($("#textarea_komentar_revisi").val().length <= 0) {
							Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
							{
									msg: "Tidak bisa melanjutkan proses ini."
							});
						}
						else {
							send_data_revisi(data_sender,'single');
						}
        }
    });

    $("#btn_tolak").click(function()
    {

        data_sender = [];
        if ($("#oid_tolak").val() == 'all-aout')
        {
            var inputs      = document.getElementsByName('counter_checkbox');
            for (var i = 0; i < inputs.length; i++) {
                checkbox_id      = $('#checkbox_'+i).is(':checked');
                if (checkbox_id != false)
                {
                    id_verify  = $('#hdn_id_'+i).val();
                    data_sender.push({
                                        'id_pekerjaan' : id_verify,
                                        'komentar'    : $("#textarea_alasan_tolak").val()
                                    });
                }
            }

            if (data_sender.length != 0)
            {
                send_data_tolak(data_sender,'all-aout');
            }
            else
            {
                Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                {
                    msg: "Tidak bisa melanjutkan proses ini, tidak ada data yang dipilih"
                });
            }
        }
        else
        {
            var data_sender = {
                                    'id_pekerjaan': $("#oid_tolak").val(),
                                    'komentar'    : $("#textarea_alasan_tolak").val()
                              };
						if ($("#textarea_alasan_tolak").val().length <= 0) {
							Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
							{
									msg: "Tidak bisa melanjutkan proses ini."
							});
						}
						else {
							send_data_tolak(data_sender,'single');
						}
        }
    });

    $("#btn_tolak_keberatan").click(function()
    {

        var data_sender = {
                                'id_pekerjaan': $("#oid_tolak_keberatan").val(),
                                'komentar'    : $("#textarea_alasan_tolak_keberatan").val()
                          };

				if ($("#textarea_alasan_tolak_keberatan").val().length <= 0) {
					Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
					{
							msg: "Tidak bisa melanjutkan proses ini."
					});
				}
				else {
	        $.ajax({
            url :"<?php echo site_url();?>/transaksi/tolak_keberatan",
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

				}
    });


    $("#btn_tolak_banding").click(function()
    {

        var data_sender = {
                                'id_pekerjaan': $("#oid_tolak_banding").val(),
                                'komentar'    : $("#textarea_alasan_tolak_banding").val()
                          };
        $.ajax({
            url :"<?php echo site_url();?>/transaksi/tolak_banding",
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



function approve(id) {
	// body...
	 Lobibox.confirm({
		 title: "Konfirmasi",
		 msg: "Anda akan menyetujui pekerjaan ini ?",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>/transaksi/approve/"+id,
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

function approve_all() {
    // body...
    var data_hdn = [];
    var inputs      = document.getElementsByName('counter_checkbox');
    for (var i = 0; i < inputs.length; i++) {
        checkbox_id      = $('#checkbox_'+i).is(':checked');
        if (checkbox_id != false)
        {
            id_verify  = $('#hdn_id_'+i).val();
            data_hdn.push({
                                'id' : id_verify
                            });
        }
    }


    if (data_hdn.length != 0)
    {
        Lobibox.confirm({
             title: "Konfirmasi",
             msg: "Anda akan menyetujui pekerjaan ini ?",
             callback: function ($this, type) {
                if (type === 'yes'){
                    $.ajax({
                        url :"<?php echo site_url()?>transaksi/approve_all/",
                        type:"post",
                        data: { data_sender:data_hdn},
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
    else
    {
        Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
        {
            msg: "Tidak bisa melanjutkan proses ini, tidak ada data yang dipilih"
        });
    }
}

function send_data_revisi(data_sender,param) {
    // body...
    $.ajax({
        url :"<?php echo site_url();?>/transaksi/revisi/"+param,
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
}

function send_data_tolak(data_sender,param) {
    // body...
    $.ajax({
        url :"<?php echo site_url();?>/transaksi/tolak/"+param,
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
}

function revisi_all() {
    // body...
    $("#revisi_data").modal('show');
    $("#oid_revisi").val('all-aout');
}

function revisi(id) {
	// body...
	$("#revisi_data").modal('show');
	$("#oid_revisi").val(id);
}

function reject_all(id) {
    // body...
    $("#tolak_data").modal('show');
    $("#oid_tolak").val('all-aout');
}

function reject(id) {
	// body...
	$("#tolak_data").modal('show');
	$("#oid_tolak").val(id);
}

function reject_keberatan(id) {
    // body...
    $("#tolak_data_keberatan").modal('show');
    $("#oid_tolak_keberatan ").val(id);
}

function reject_banding(id) {
    // body...
    $("#tolak_data_banding").modal('show');
    $("#oid_tolak_banding ").val(id);
}
</script>
