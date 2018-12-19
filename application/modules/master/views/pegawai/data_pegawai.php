<?=$this->load->view('templates/common/preloader');?>
<div class="col-xs-12">
  	<div class="box">
    	<div class="box-header">

			<div class="box-body">
				<div class="container-fluid">
					<div class="row col-xs-6">

						<h4>Pimpinan Tinggi Madya (Eselon I) :</h4>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
			                </span>
			                <select class="form-control filter_data_eselon" name="select_eselon_1" id="select_eselon_1">
			                	<option value="">------Pilih Salah Satu------</option>
								<?php foreach($es1->result() as $row){?>
									<option value="<?php echo $row->id_es1;?>"><?php echo $row->nama_eselon1;?></option>
								<?php }?>
			                </select>
			            </div>
						<progress class="progress progress-striped progress-animated" id="prg_progress_bar_es1" style="width: 473px;margin-bottom: 0px;visibility: hidden;" value="0" max="100">
							25%
						</progress>

            <h4>Administrator (Eselon III) :</h4>
						<div id="isi_select_eselon_3">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
				                </span>
				                <select class="form-control select_eselon_child_global select_eselon_child_global_2" name="select_eselon_3" id="select_eselon_3">
				                	<option value="">------------NONE------------</option>
				                </select>
				            </div>
							<progress class="progress progress-striped progress-animated" id="prg_progress_bar_es3" style="width: 473px;margin-bottom: 0px;visibility: hidden;" value="0" max="100">
								25%
							</progress>
						</div>
					</div>

					<div class="row col-xs-6 pull-right">

            <h4>Pimpinan Tinggi Pratama (Eselon II) :</h4>
						<div id="isi_select_eselon_2">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
				                </span>
				                <select class="form-control select_eselon_child_global" name="select_eselon_2" id="select_eselon_2">
				                	<option value="">------------NONE------------</option>
				                	<?php
				                		if (count($es2->result()) != 0) {
				                			# code...
				                			$data_list = $es2->result();
				                			for ($i=0; $i < count($data_list); $i++) {
				                			# code...
				                	?>
											<option value="<?=$data_list[$i]->id_es2;?>"><?=$data_list[$i]->nama_eselon2;?></option>
				                	<?php
				                			}
				                		}
				                	?>
				                </select>
				            </div>
							<progress class="progress progress-striped progress-animated" id="prg_progress_bar_es2" style="width: 473px;margin-bottom: 0px;visibility: hidden;" value="0" max="100">
								25%
							</progress>
						</div>

            <h4>Pengawas (Eselon IV) :</h4>
						<div id="isi_select_eselon_4">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
				                </span>
				                <select class="form-control select_eselon_child_global select_eselon_child_global_2 select_eselon_child_global_3" name="select_eselon_4" id="select_eselon_4">
				                	<option value="">------------NONE------------</option>
				                </select>
				            </div>
							<progress class="progress progress-striped progress-animated" id="prg_progress_bar_es4" style="width: 473px;margin-bottom: 0px;visibility: hidden;" value="0" max="100">
								25%
							</progress>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-xs-12">
	<div class="box">
	    <div class="box-header">
	     	<a href="<?php echo site_url()?>/master/data_pegawai/tambah_pegawai">
		     	<h3 class="box-title pull-right">
		     		<button class="btn btn-block btn-primary"><i class="fa fa-plus-square"></i> Tambah Pegawai</button>
	     		</h3>
	     	</a>
	    </div><!-- /.box-header -->
	    <div class="box-body" id="isi">
			<progress class="progress progress-striped progress-animated" id="prg_progress_bar" style="width: 1085px;display: none;" value="0" max="100">
				25%
			</progress>
		  	<div >
			  	<table id="example1" class="table table-bordered table-striped">
	      		<thead>
					<tr>
						<th style="max-width: 80px; width: 80px!important;">Foto</th>
						<th>NIP</th>
						<th>Nama</th>
						<th>Jabatan</th>
						<th>Kelas Jabatan</th>
            <th>TMT</th>
            <th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="table_content">
					<?php
						for ($i=0; $i < count($list); $i++) {
							# code...
							$id             = $list[$i]->id;
							$data_link_a    = "";
							$data_link_text = "";
					?>
				<?php
							if ($list[$i]->photo == '-') {
							# code...
								$data_link_a = "none";
								$data_link_text = "Tidak ada Foto";
							}
							else
							{
								if ($list[$i]->local == '1') {
									# code...
									$data_link_text = "Lihat Foto";
									$data_link_a = base_url() . 'public/images/pegawai/'.$list[$i]->photo;
								}
								else
								{
									$data_link_text = "Lihat Foto";
									$data_link_a = 'http://sikerja.kemendagri.go.id/images/demo/users/'.$list[$i]->photo;
								}
							}
				?>
						<tr>
							<td>
								<a href="#" class="btn btn-success btn-xs" onclick="preview_image('<?=$id;?>','<?=$data_link_a;?>')"><i class="fa fa-search-plus"></i>&nbsp;<?=$data_link_text;?></a>
							</td>
							<td><?=$list[$i]->nip;?></td>
							<td><?=$list[$i]->nama_pegawai;?></td>
							<td><?=$list[$i]->nama_posisi;?></td>
							<td><?=$list[$i]->posisi_class;?></td>
              <td><?=$list[$i]->tmt;?></td>
              <td></td>
							<td>
								<?php echo anchor('master/data_pegawai/ubah_pegawai/'.$list[$i]->id,'<button class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></button>');?>&nbsp;&nbsp;
								<button class="btn btn-danger btn-xs" onclick="del('<?php echo $list[$i]->id;?>')"><i class="fa fa-trash"></i></button>
							</td>
						</tr>
					<?php
						}
					?>
				</tbody>
			  	</table>
	  		</div>
    	</div><!-- /.box-body -->
  	</div><!-- /.box -->
</div>

<div class="example-modal">
<div class="modal modal-success fade" id="newData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="box-content">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data</h4>
                  </div>
                <div class="modal-body">
					<form id="addForm" name="addForm">
					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama">
					</div></div>
					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                    <input type="text" id="nip" name="nip" class="form-control" placeholder="NIP">
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="tgl_lahir" name="tgl_lahir" class="form-control" placeholder="Tanggal Lahir" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
					</div></div>
					<div class="form-group">
                    <label>
                      <input type="radio" name="gender" id="gender" value="L" class="flat-red">Laki-laki &nbsp;&nbsp;&nbsp;
                    </label>
                    <label>
                      <input type="radio" name="gender" id="gender" value="P" class="flat-red">
                      Perempuan
                    </label>
					</div>


					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
                    <select name="es1" id="es1" class="form-control"><option value="">Pilih Eselon 1</option>
					<?php foreach($es1->result() as $row){?>
						<option value="<?php echo $row->id_es1;?>"><?php echo $row->nama_eselon1;?></option>
					<?php }?>
					</select>
					</div></div>
					<div id="isies2"></div>
					<div id="isies3"></div>
					<div id="isies4"></div>
					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-gavel"></i></span>
                    <select name="jabatan" id="jabatan" class="form-control"><option value=0>Pilih Jabatan</option></select>
					</div></div>
					</form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
					<input type="submit" class="btn btn-primary" value="Simpan" id="add"/>

                </div>
            </div>
        </div>
	</div>
</div>
</div>


<div class="example-modal">
<div class="modal modal-success fade" id="reRole" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="box-content">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ganti Role</h4>
                  </div>
                <div class="modal-body">
					<form id="cariForm" name="cariForm">
					<input type="hidden" name="oidRole" id="oidRole">
					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-gavel"></i></span>
                    <select name="nRole" id="nRole" class="form-control"><option value="">Pilih Role</option>
					<?php foreach($role->result() as $row){?>
						<option value="<?php echo $row->id_role;?>"><?php echo $row->nama_role;?></option>
					<?php }?>
					</select>
					</div></div>
					</form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
					<input type="submit" class="btn btn-primary" value="Ubah" id="ubahRole"/>

                </div>
            </div>
        </div>
	</div>
</div>
</div>

<div class="example-modal">
<div class="modal modal-success fade" id="preview_image_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="box-content">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" id="preview_image_content" style="background-color: #fff!important;">
                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #fff;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
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
function progress_bar(al) {
	var bar   = document.getElementById('prg_progress_bar');
	$("#prg_progress_bar").css("display",'');
	bar.value = al;
	al        = al + 2;
	var sim   = setTimeout("progress_bar("+al+")",20);
	if(al == 100){
		status.innerHTML       = "100%";
		bar.value              = 100;
		clearTimeout(sim);
		$("#prg_progress_bar").css("display",'none');
	}
}

function preview_image(id,url) {
    // body...
    content = '<form id="editForm" name="addForm"><div class="col-lg-12">'+
    		  	'<img class="col-lg-12" style="padding-bottom: 15px;width: 410px !important;height: 450px !important;" src="'+url+'">'+
    		  '</div></form>';
	$("#preview_image_content").html(content);
    $("#preview_image_popup").modal('show');
    // $("#oid_keberatan").val(id);
}


$(document).ready(function(){
	$("#select_eselon_1").val('<?=$this->session->userdata('sesEs1');?>');
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
	});

	$("#addData").click(function(){
		$("#newData").modal('show');
	})

	$("#cari").click(function(){
		$("#filter").modal('show');
	})

	$("#es1").change(function(){
		var es1 = $("#es1").val();
		$.ajax({
			url :"<?php echo site_url()?>/master/data_eselon2/cariEs2",
			type:"post",
			data:"es1="+es1,
			success:function(msg){
				$("#isies2").html(msg);
			}
		})
	})

	$("#nes1").change(function(){
		var es1 = $("#nes1").val();
		$.ajax({
			url :"<?php echo site_url()?>/master/data_eselon2/cariEs2edit",
			type:"post",
			data:"nes1="+es1,
			success:function(msg){
				$("#nisies2").html(msg);
			}
		})
	})

	$("#fes1").change(function(){
		var fes1 = $("#fes1").val();
		$.ajax({
			url :"<?php echo site_url()?>/master/data_eselon2/cariEs2cari",
			type:"post",
			data:"fes1="+fes1,
			success:function(msg){
				$("#fisies2").html(msg);
			}
		})
	})

	$("#jabatan").focus(function(){
		$.ajax({
			url :"<?php echo site_url()?>/master/data_pegawai/cariJabatan",
			type:"post",
			data:$("#addForm").serialize(),
			success:function(msg){
				$("#jabatan").html(msg);
			}
		})
	})

	$("#natasan").focus(function(){
		$.ajax({
			url :"<?php echo site_url()?>/master/data_pegawai/cariAtasan",
			type:"post",
			data:$("#editForm").serialize(),
			success:function(msg){
				$("#natasan").html(msg);
			}
		})
	})

	$("#add").click(function(){
		var nip       = $("#nip").val();
		var nama      = $("#nama").val();
		var tgl_lahir = $("#tgl_lahir").val();
		var tgl_lahir = tgl_lahir.split("/").reverse().join("-")
		var gender    = $('input[name=gender]:checked').val();
		var es1       = $("#es1").val();
		var es2       = $("#es2").val();
		var es3       = $("#es3").val();
		var es4       = $("#es4").val();
		var jabatan   = $("#jabatan").val();
		$.ajax({
			url :"<?php echo site_url()?>/master/data_pegawai/addPegawai",
			type:"post",
			data:"es1="+es1+"&es2="+es2+"&es3="+es3+"&es4="+es4+"&jabatan="+jabatan+"&nip="+nip+"&nama="+nama+"&tgl_lahir="+tgl_lahir+"&gender="+gender,
			beforeSend:function(){
				$("#newData").modal('hide');
			},
			success:function(){
				Lobibox.notify('success', {
					msg: 'Data Berhasil Ditambahkan'
					});

	                  setTimeout(function(){
	                    location.reload();
	                  }, 5600);
			},
			error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penambahan data'
					});
					}
		})
	})

	$("#ubahRole").click(function(){
		var oid= $("#oidRole").val();
		var nRole= $("#nRole").val();
		$.ajax({
			url :"<?php echo site_url();?>/master/data_pegawai/reRole",
			type:"post",
			data:"oid="+oid+"&nRole="+nRole,
			beforeSend:function (){
				$("#reRole").modal('hide');
			},
			success:function(){
				Lobibox.notify('success', {
					msg: 'Data Berhasil Dirubah'
					});
                  setTimeout(function(){
                    location.reload();
                  }, 5600);
			},
			error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penambahan data'
					});
					}
		})
	})

	$("#select_eselon_1").change(function(){
		var select_eselon_1 = $(this).val();
		var select_eselon_2 = '';
		var select_eselon_3 = '';
		var select_eselon_4 = '';
        $('#select_eselon_2').find('option').remove();
        $('#select_eselon_2').append($("<option></option>").attr("value", '').text('------------NONE------------'));
        $('#select_eselon_3').find('option').remove();
        $('#select_eselon_3').append($("<option></option>").attr("value", '').text('------------NONE------------'));
        $('#select_eselon_4').find('option').remove();
        $('#select_eselon_4').append($("<option></option>").attr("value", '').text('------------NONE------------'));
		$.ajax({
			url :"<?php echo site_url()?>/master/data_eselon2/cariEs2_filter/filter_data_pegawai",
			type:"post",
			data:"select_eselon_1="+select_eselon_1,
			beforeSend:function(){
				$("#loadprosess").modal('show');
				$("#halaman_header").html("");
				$("#halaman_footer").html("");
				$('#example1').dataTable().fnDestroy();
				$("#example1 tbody tr").remove();
				var newrec  = '<tr">' +
		        					'<td colspan="5" class="text-center">Memuat Data</td>'
		    				   '</tr>';
		        $('#example1 tbody').append(newrec);
			},
			success:function(msg){
				$("#isi_select_eselon_2").html(msg);
				var data_link = {
	        					'data_1' : select_eselon_1,
				                'data_2' : select_eselon_2,
				                'data_3' : select_eselon_3,
				                'data_4' : select_eselon_4
				}
				$.ajax({
					url :"<?php echo site_url()?>/master/filter_data_pegawai",
					type:"post",
					data: { data_sender : data_link},
					success:function(msg){
						$("#example1 tbody tr").remove();
						$("#table_content").html(msg);
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
						setTimeout(function(){
							$("#loadprosess").modal('hide');
						}, 1000);
					}
				})

			}
		})
	})

	$("#select_eselon_2").change(function(){
		var select_eselon_1 = $("#select_eselon_1").val();
		var select_eselon_2 = $("#select_eselon_2").val();
		var select_eselon_3 = '';
		var select_eselon_4 = '';
        $('#select_eselon_3').find('option').remove();
        $('#select_eselon_3').append($("<option></option>").attr("value", '').text('------------NONE------------'));
        $('#select_eselon_4').find('option').remove();
        $('#select_eselon_4').append($("<option></option>").attr("value", '').text('------------NONE------------'));
		$.ajax({
			url :"<?php echo site_url()?>/master/data_eselon3/cariEs3_filter/filter_data_pegawai",
			type:"post",
			data:"select_eselon_2="+select_eselon_2,
			beforeSend:function(){
				$("#loadprosess").modal('show');
				$("#halaman_header").html("");
				$("#halaman_footer").html("");
				$('#example1').dataTable().fnDestroy();
				$("#example1 tbody tr").remove();
				var newrec  = '<tr">' +
		        					'<td colspan="8" class="text-center">Memuat Data</td>'
		    				   '</tr>';
		        $('#example1 tbody').append(newrec);
			},
			success:function(msg){
				$("#isi_select_eselon_3").html(msg);
				var data_link = {
	        					'data_1' : select_eselon_1,
				                'data_2' : select_eselon_2,
				                'data_3' : select_eselon_3,
				                'data_4' : select_eselon_4
				}
				$.ajax({
					url :"<?php echo site_url()?>/master/filter_data_pegawai",
					type:"post",
					data: { data_sender : data_link},
					success:function(msg){
						$("#example1 tbody tr").remove();
						$("#table_content").html(msg);
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
						setTimeout(function(){
							$("#loadprosess").modal('hide');
						}, 1000);
					}
				})
			}
		})
	})
})

function del(id){
	 Lobibox.confirm({
		 title: "Konfirmasi",
		 msg: "Anda yakin akan menghapus data ini ?",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>/master/data_pegawai/delPegawai/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
	                  setTimeout(function(){
	                    location.reload();
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

  $(function() {
    $("#tgl_lahir").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
/*
    $("#tgl_lahir").datepicker({
	        numberOfMonths: 2,
	        dateFormat: 'dd/mm/yy'
    });
    $('#tgl_lahir').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'DD/MM/YYYY'});
    $( "#tgl_lahir" ).datepicker({
      changeMonth: true,
      changeYear	: true
    });
*/

	$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });
  });
  function reRole(id){
	  $("#reRole").modal('show');
	  $("#oidRole").val(id);
  }
</script>
