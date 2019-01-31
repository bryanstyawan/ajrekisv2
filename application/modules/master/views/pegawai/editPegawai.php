<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/dropzone-work/dropzone.min.css'; ?>");</style>
<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/dropzone-work/basic.min.css'; ?>");</style>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/dropzone-work/jquery.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/dropzone-work/dropzone.min.js"></script>
<!-- Profile Image -->
<div class="example-modal">
    <div class="modal modal-success fade" id="modal-detail-jabatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="box-content">

            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header"><h3 class="heading-hr text-center"><i class="icon-user"></i>Jabatan</h3></div>
                    <div class="modal-body" style="background-color: #fff!important;color:#000!important;">
                        <div class="container-fluid" id="get-datatable">
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-3">
  	<div class="box box-primary">
        <div class="box-body box-profile">
			<?php
				if($pegawai != '')
				{
			?>
			<?php
					if ($pegawai[0]->photo == '-') {
						# code...
			?>
						<span class="col-lg-12" style="padding-bottom: 10px;">
							<div class="dropzone" id="dropzone_image">
								<div class="dz-message">
		                			<img class="col-lg-12" style="padding-bottom: 15px;" src="http://mandarinpalace.fi/wp-content/uploads/2015/11/businessman.jpg">
									<h3> Klik atau Drop File Foto disini</h3>
								</div>
							</div>
						</span>
			<?php
					}
					else
					{
						if ($pegawai[0]->local == 1) {
							# code...
			?>
						<span class="col-lg-12" style="padding-bottom: 10px;">
							<div class="dropzone" id="dropzone_image">
								<div class="dz-message">
					    			<img class="col-lg-12" style="padding-bottom: 15px;" src="<?php echo base_url() . 'public/images/pegawai/'.$pegawai[0]->photo;?>">
									<h3> Klik atau Drop File Foto disini</h3>
								</div>
							</div>
						</span>
			<?php
						}
						else
						{
			?>
						<span class="col-lg-12" style="padding-bottom: 10px;">
							<div class="dropzone" id="dropzone_image">
								<div class="dz-message">
					    			<img class="col-lg-12" style="padding-bottom: 15px;" src="http://sikerja.kemendagri.go.id/images/demo/users/<?=$pegawai[0]->photo;?>">
									<h3> Klik atau Drop File Foto disini</h3>
								</div>
							</div>
						</span>
			<?php
						}
					}
				}
				else
				{
			?>
                		<img class="col-lg-12" style="padding-bottom: 15px;" src="http://mandarinpalace.fi/wp-content/uploads/2015/11/businessman.jpg">
			<?php
				}
			?>
          	<h3 class="profile-username text-center"><?php if($pegawai != ''){echo $pegawai[0]->nama_pegawai;}?></h3>
          	<p class="text-muted text-center"><?php if($pegawai != ''){echo $pegawai[0]->nama_posisi;}?></p>
		</div>
  	</div>
</div>

<div class="form-horizontal">
	<form id="form_pegawai" name="form_pegawai">
		<div class="col-md-9">
	      	<div class="box box-primary" style="padding:10px;">
				<div class="form-group">
					<label for="gender" class="col-md-2 control-label"></label>
					<div class="col-md-9">
						<div class="row">
						<a class="btn btn-app pull-right" id="btn_save"><i class="fa fa-save"></i> Simpan</a>
						<a class="btn btn-app pull-right" href="<?php echo site_url();?>/master/data_pegawai" id="reset"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="es1" class="col-md-2 control-label">Eselon 1</label>
					<div class="col-md-9">
					  <select name="ees1" id="ees1" class="form-control">
						<option value="<?php if($pegawai != ''){echo $pegawai[0]->es1;}?>"><?php if($pegawai != ''){echo $pegawai[0]->nama_eselon1;}?></option>
						<?php foreach($eselon1->result() as $baris){?>
							<option value="<?php echo $baris->id_es1;?>"><?php echo $baris->nama_eselon1;?></option>
						<?php }?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="es2" class="col-md-2 control-label">Eselon 2</label>
					<div class="col-md-9">
					  <select name="ees2" id="ees2" class="form-control">
						<option value="<?php if($pegawai != ''){echo $pegawai[0]->es2;}?>"><?php if($pegawai != ''){echo $pegawai[0]->nama_eselon2;}?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="es3" class="col-md-2 control-label">Eselon 3</label>
					<div class="col-md-9">
					  <select name="ees3" id="ees3" class="form-control">
						<option value="<?php if($pegawai != ''){echo $pegawai[0]->es3;}?>"><?php if($pegawai != ''){echo $pegawai[0]->nama_eselon3;}?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="es4" class="col-md-2 control-label">Eselon 4</label>
					<div class="col-md-9">
					  <select name="ees4" id="ees4" class="form-control">
						<option value="<?php if($pegawai != ''){echo $pegawai[0]->es4;}?>"><?php if($pegawai != ''){echo $pegawai[0]->nama_eselon4;}?></option>
						</select>
					</div>
				</div>

	<!--
	****************************************************************************************************************
	-->
				<hr>

				<div class="form-group">
	                <label for="inputnip" class="col-md-2 control-label">NIP</label>
	                <div class="col-md-9">
						<input type="text" class="form-control" id="inputnip" name="inputnip" value="<?php if($pegawai != ''){ echo $pegawai[0]->nip;}?>">
	                </div>
	            </div>

				<div class="form-group">
	                <label for="inputnama" class="col-md-2 control-label">Nama</label>
	                <div class="col-md-9">
	                	<input type="hidden" name="flag_crud" id="flag_crud" value="<?php if($pegawai != ''){echo 'edit';}else{echo "add";}?>">
						<input type="hidden" name="oidPegawai" id="oidPegawai" value="<?php if($pegawai != ''){echo $pegawai[0]->id;}?>">
						<input type="text" class="form-control" name="inputnama" id="inputnama" value="<?php if($pegawai != ''){echo $pegawai[0]->nama_pegawai;}?>">
	                </div>
	            </div>

				<div class="form-group">
					<label class="col-md-2 control-label">Jabatan</label>
					<div class="col-md-9">
						<input class="form-control form-control-detail" id="f_jabatan" type="text" disabled="" value="<?=($jabatan != array()) ? $jabatan[0]['nama_posisi'] : "";?>">
						<input class="form-control form-control-detail" id="f_jabatan_id" type="hidden" value="<?=($jabatan) ? $jabatan[0]['id'] : "";?>">							
					</div>
					<a class="btn btn-default" id="f_jabatan_btn"><i class="fa fa-search"></i></a>
				</div>


				<div class="form-group">
	                <label for="inputnama" class="col-md-2 control-label">TMT</label>
	                <div class="col-md-9">
	                	<input type="text" id="tmt" name="tmt" class="form-control timerange-normal" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="<?php if($pegawai != ''){ echo $pegawai[0]->tmt_jabatan;}?>">
	                </div>
	            </div>

				<hr>

<!-- 				<div class="form-group">
					<label for="jab" class="col-md-2 control-label">Kepala Bagian</label>
					<div class="col-md-9">
					  	<select name="kepala_bagian" id="kepala_bagian" class="form-control">
					  	<option value="">None</option>
					  	<option value="1">Ya</option>
					  	<option value="0">Tidak</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="jab" class="col-md-2 control-label">Pelaksana Tugas</label>
					<div class="col-md-9">
						<select name ="pelaksana_tugas" id="pelaksana_tugas" class="form-control">
					  	<option value="">None</option>
					  	<option value="Y">Ya</option>
					  	<option value="T">Tidak</option>
						</select>
					</div>
				</div>	 -->


				<div class="form-group">
					<div class="container col-lg-12" style="padding-top: 20px;">
					  	<ul class="nav nav-tabs">
						    <li class="active"><a data-toggle="tab" href="#home">Akses</a></li>
						    <li><a data-toggle="tab" href="#menu1">Masa Kerja</a></li>
					  	</ul>

					  	<div class="tab-content">
						    <div id="home" class="tab-pane fade in active" style="padding-top: 15px;">
								<div class="form-group">
					                <label for="inputpass" class="col-md-2 control-label">Kata Sandi</label>
					                <div class="col-md-9">
					      	          <input type="password" class="form-control" id="inputpass" name="inputpass" placeholder="*******************">
					                </div>
					            </div>

								<div class="form-group">
					                <label for="inputpass" class="col-md-2 control-label">Konfirmasi Kata Sandi</label>
					                <div class="col-md-9">
					      	          <input type="password" class="form-control" id="inputpass_repeat" name="inputpass_repeat" placeholder="*******************">
					                </div>
					            </div>
						    </div>
							<div id="menu1" class="tab-pane fade" style="padding-top: 15px;">
								<div class="col-lg-12">
						            <table id="example1" class="table table-bordered table-striped">
										<thead>
								            <tr>
												<th>Tanggal Mulai</th>
												<th>Tanggal Selesai</th>
												<th>Jabatan</th>
                        <th>Status</th>
												<th>action</th>
								            </tr>
										</thead>
										<tbody id="table_content">
											<?php
											if ($masa_kerja != 0) {
												# code...
												for ($i=0; $i < count($masa_kerja); $i++) {
													# code...
											?>
												<tr>
													<td><?=$masa_kerja[$i]->StartDate;?></td>
													<td><?=$masa_kerja[$i]->EndDate;?></td>
													<td><?=$masa_kerja[$i]->nama_posisi;?></td>
                          <td><?=$masa_kerja[$i]->status_masakerja;?> (<?=$masa_kerja[$i]->tanggal_status;?>)</td>
													<td>
											<?php
															if ($masa_kerja[$i]->EndDate == '9999-01-01') {
																# code...
											?>
                                <a class="btn btn-warning btn-xs" href="#" onclick="edit_masa_kerja('<?php echo $masa_kerja[$i]->id;?>')">
                                  <i class="fa fa-edit"></i>
                                </a>

																<a class="btn btn-danger btn-xs" href="#" onclick="del_masa_aktif('<?php echo $masa_kerja[$i]->id;?>')">
																	<i class="fa fa-trash"></i>
																</a>
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
	</form>
</div>

<div class="example-modal">
<div class="modal modal-success fade" id="modal_masa_kerja_status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="box-content">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Masa Kerja</h4>
                </div>
                <div class="modal-body" style="background-color: #fff!important;">
                    <form id="editForm" name="addForm">

                        <label style="color: #000;font-weight: 400;font-size: 19px;">Jabatan</label>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-star"></i></span>
                                <input class="form-control" id="masakerja_jabatan" type="text" disabled="disabled">
                            </div>
                        </div>
                        <input type="hidden" id="oid_masa_kerja" name="oid_masa_kerja" >

                        <label style="color: #000;font-weight: 400;font-size: 19px;">TMT</label>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-star"></i></span>
                                <input class="form-control" id="masakerja_tmt" type="text" disabled="disabled">
                            </div>
                        </div>

                        <label style="color: #000;font-weight: 400;font-size: 19px;">Status</label>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-star"></i></span>
                                <select class="form-control" id="masakerja_status">
                      					  	<option value="">None</option>
                                    <?php
                                      if ($status_masa_kerja) {
                                        // code...
                                          for ($i=0; $i < count($status_masa_kerja); $i++) {
                                            // code...
                                    ?>
                              					  	<option value="<?=$status_masa_kerja[$i]['id'];?>"><?=$status_masa_kerja[$i]['nama'];?></option>
                                    <?php
                                          }
                                      }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <label style="color: #000;font-weight: 400;font-size: 19px;">Tanggal Status</label>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-star"></i></span>
                                <input class="form-control timerange" id="masakerja_tanggal" type="text">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
                    <input type="submit" class="btn btn-primary" value="Simpan" id="btn_masa_kerja"/>

                </div>
            </div>
        </div>
    </div>
</div>
</div>


<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>

if (document.getElementById('dropzone_image')) {
  // other code here
	Dropzone.autoDiscover = false;
	var foto_upload= new Dropzone("div#dropzone_image",{
		url: "<?php echo site_url();?>/master/data_pegawai/unggah_foto_pegawai_self",
		maxFilesize: 2,
		method:"post",
		acceptedFiles:"image/*",
		paramName:"userfile",
		dictInvalidFileType:"Type file ini tidak dizinkan",
		addRemoveLinks:true,
		thumbnailWidth: null,
		thumbnailHeight: null,
	    init: function() {
	        this.on("thumbnail", function(file, dataUrl) {
	            $('.dz-image').last().find('img').attr({width: '100%', height: '100%'});
	        }),
	        this.on("success", function(file) {
	            $('.dz-image').css({"width":"100%", "height":"auto"});
	        })
	    }
	});


	foto_upload.on("processing",function(a){
		$("#loadprosess").modal('show');
	});

	foto_upload.on("sending",function(a,b,c){
		a.token =$('#oidPegawai').val();
		c.append("token_foto",a.token); //Menmpersiapkan token untuk masing masing foto
	});

	foto_upload.on("success",function(a){
		setTimeout(function(){
			$("#loadprosess").modal('hide');
		  	setTimeout(function(){
		    	location.reload();
		  	}, 1500);
		}, 5000);
	});
}


$(document).ready(function()
{
	$("#example1").DataTable({
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
		"bSort": false

		// "dom": '<"top"f>rt'
		// "dom": '<"top"fl>rt<"bottom"ip><"clear">'
	});

    $("#tmt").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
    $('.timerange').datepicker({
    	format: 'yyyy-mm-dd'
    });

  $("#btn_masa_kerja").click(function () {
		var status          = $("#masakerja_status").val();
		var tanggal_status  = $("#masakerja_tanggal").val();
		var oid             = $("#oid_masa_kerja").val();
    data_sender = {
                      'status' : status,
                      'tanggal_status' : tanggal_status
    }
		$.ajax({
			url :"<?php echo site_url();?>master/data_pegawai/change_status_masa_kerja/"+oid,
			type:"post",
			data:{data_sender:data_sender},
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
			}
		})
  })

  $("#f_jabatan_btn").click(function(){
		var es1 = $("#ees1").val();
		var es2 = $("#ees2").val();
		var es3 = $("#ees3").val();
		var es4 = $("#ees4").val();
		$.ajax({
			url :"<?php echo site_url();?>/master/data_pegawai/cariJabatan",
			type:"post",
			data:"es1="+es1+"&es2="+es2+"&es3="+es3+"&es4="+es4,
			beforeSend:function(){
				$("#loadprosess").modal('show');
				$("#get-datatable").html('');				
			},			
			success:function(msg){
				$("#get-datatable").html(msg);
				$("#loadprosess").modal('hide');								
				$("#modal-detail-jabatan").modal('show');				
			}
		})
	})	  

	$("#ees1").change(function(){
		$("#ees2").html("<option value=0>None</option>");
		$("#ees3").html("<option value=0>None</option>");
		$("#ees4").html("<option value=0>None</option>");
		var es1 = $("#ees1").val();
		$.ajax({
			url :"<?php echo site_url();?>/master/data_eselon2/formEselon2",
			type:"post",
			data:"nes1="+es1,
			beforeSend:function(){
				$("#loadprosess").modal('show');
			},
			success:function(hasil){
				$("#ees2").html(hasil);
				setTimeout(function(){
					$("#loadprosess").modal('hide');
				}, 5000);
			}
		})
	})

	$("#ees2").change(function(){
		$("#ees3").html("<option value=0>None</option>");
		$("#ees4").html("<option value=0>None</option>");
		var es2 = $("#ees2").val();
		$.ajax({
			url :"<?php echo site_url();?>/master/data_eselon3/formEselon3",
			type:"post",
			data:"nes2="+es2,
			beforeSend:function(){
				$("#loadprosess").modal('show');
			},
			success:function(hasil){
				$("#ees3").html(hasil);
				setTimeout(function(){
					$("#loadprosess").modal('hide');
				}, 5000);
			}
		})
	})

	$("#ees3").change(function(){
		$("#ees4").html("<option value=0>None</option>");
		var es3 = $("#ees3").val();
		$.ajax({
			url :"<?php echo site_url();?>/master/data_eselon4/formEselon4",
			type:"post",
			data:"nes3="+es3,
			beforeSend:function(){
				$("#loadprosess").modal('show');
			},
			success:function(hasil){
				$("#ees4").html(hasil);
				setTimeout(function(){
					$("#loadprosess").modal('hide');
				}, 5000);
			}
		})
	})

	$("#inputjabatan").focus(function(){
		var es1 = $("#ees1").val();
		var es2 = $("#ees2").val();
		var es3 = $("#ees3").val();
		var es4 = $("#ees4").val();
		$.ajax({
			url :"<?php echo site_url();?>/master/data_pegawai/cariJabatan",
			type:"post",
			data:"es1="+es1+"&es2="+es2+"&es3="+es3+"&es4="+es4,
			success:function(hasil){
				$("#inputjabatan").html(hasil);
			}
		})
	})

	$("#reset").click(function(){
		$("#isi").load('master/data_pegawai/ajaxPegawai');
	})

	$("#btn_save").click(function(){
		var ees1         = $("#ees1").val();
		var inputnip     = $("#inputnip").val();
		var inputnama    = $("#inputnama").val();
		var inputjabatan = $("#f_jabatan_id").val();
		var tmt          = $("#tmt").val();

		if (ees1.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Eselon 1 tidak boleh kosong."
			});
		}
		else if(inputnip <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data NIP tidak boleh kosong."
			});
		}
		else if(inputnama <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Nama tidak boleh kosong."
			});
		}
		else if(inputjabatan <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Jabatan tidak boleh kosong."
			});
		}
		else if(tmt <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data TMT tidak boleh kosong."
			});
		}
		else
		{
			var f_es1                 = $("#ees1").val();
			var f_es2                 = $("#ees2").val();
			var f_es3                 = $("#ees3").val();
			var f_es4                 = $("#ees4").val();
			
			var f_nip                 = $("#inputnip").val();
			var f_nama                = $("#inputnama").val();
			var f_jabatan             = $("#f_jabatan_id").val();
			var f_tmt                 = $("#tmt").val();		

			data_sender = {
					'crud'    : 'update', 					
					'es1'     : f_es1,
					'es2'     : f_es2,
					'es3'     : f_es3,
					'es4'     : f_es4,
					'nip'     : f_nip,
					'nama'    : f_nama,
					'jabatan' : f_jabatan,
					'tmt'     : f_tmt,
					'oid' : '<?=$oid;?>'
				}

			$.ajax({
				url :"<?php echo site_url()?>/master/data_pegawai/store",
				type:"post",
				data: { data_sender : data_sender},
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
})

function edit_masa_kerja(id) {
  $.ajax({
    url :"<?php echo site_url()?>master/data_pegawai/masa_kerja_pegawai_id/"+id,
    type:"post",
    beforeSend:function(){
      $("#loadprosess").modal('show');
    },
    success:function(msg){
      var obj = jQuery.parseJSON (msg);
      $("#masakerja_jabatan").val(obj[0].nama_posisi);
      $("#masakerja_tmt").val(obj[0].StartDate);
      $("#modal_masa_kerja_status").modal('show');
      $("#oid_masa_kerja").val(id);
      $("#loadprosess").modal('hide');
    },
    error:function(){
      Lobibox.notify('error', {
        msg: 'Terjadi kesalahan, Gagal melakukan perintah.'
      });
    }
  })
}

function del_masa_aktif(id) {
	// body...
	 Lobibox.confirm({
		 title: "Konfirmasi",
		 msg: "Anda yakin akan menghapus data ini ?",
		 callback: function ($this, type) {
    			if (type === 'yes')
          {
    				$.ajax({
    					url :"<?php echo site_url()?>/master/data_pegawai/delete_masa_kerja/"+id,
    					type:"post",
    					beforeSend:function(){
    						$("#newData").modal('hide');
    						$("#loadprosess").modal('show');
    						$('#example1').dataTable().fnDestroy();
    						$("#example1 tbody tr").remove();
    						var newrec  = '<tr">' +
    				        					'<td colspan="4" class="text-center">Memuat Data</td>'
    				    				   '</tr>';
    				        $('#example1 tbody').append(newrec);
    					},
    					success:function(msg)
    					{
    						Lobibox.notify('success', {
    							msg: 'Data Berhasil Dihapus'
    						});
    						// $("#example1 tbody tr").remove();
    						// $("#table_content").html(msg);
    						setTimeout(function()
    						{
    		                    location.reload();
    							// $("#loadprosess").modal('hide');
    						}, 5600);
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
</script>
