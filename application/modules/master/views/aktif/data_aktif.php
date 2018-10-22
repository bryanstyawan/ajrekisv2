<style type="text/css">
.modal{
    /*display: block !important; */
    /* I added this to see the modal, you don't need this */
}

/* Important part */
.modal-dialog{
    overflow-y: initial !important
}
.modal-body{
    height: 250px;
    overflow-y: auto;
}
</style>
<div class="col-xs-12">
  	<div class="box">
        <div class="box-header">
			<h3 class  ="box-title pull-right"><button class="btn btn-block btn-primary" id="addData"><i class="fa fa-plus-square"></i> Tambah Hari Aktif</button></h3>
			<div class ="box-tools"></div>
        </div><!-- /.box-header -->
        <div class="box-body" id="isi">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
            <tr>
              <th>No</th>
              <th>Bulan</th>
      			  <th>Tahun</th>
      			  <th>Jumlah Hari Aktif</th>
      			  <th>Jumlah Menit Perhari</th>
              <th>Total Menit Efektif/Bulan</th>
      			  <th>Tanggal Pengajuan Keberatan</th>
      			  <th>Tanggal Pengajuan Banding</th>
      			  <th>action</th>
            </tr>
			</thead>
			<tbody>
			<?php $x=1;
				foreach($list->result() as $row){?>
					<tr>
						<td><?php echo $x;?></td>
						<td><?php echo $row->nama_bulan;?></td>
						<td><?php echo $row->tahun;?></td>
						<td><?php echo $row->jml_hari_aktif;?></td>
						<td><?php echo $row->jml_menit_perhari;?></td>
            <td><?php echo number_format($row->jml_hari_aktif*$row->jml_menit_perhari);?></td>
						<td>
							<?php
								if ($row->tgl_awal_keberatan == '')
								{
									# code...
									echo "";
								}
								else
								{
									echo $row->tgl_awal_keberatan." s/d ".$row->tgl_akhir_keberatan;
								}
							?>
						</td>
						<td>
							<?php
								if ($row->tgl_awal_banding == '')
								{
									# code...
									echo "";
								}
								else
								{
									echo $row->tgl_awal_banding." s/d ".$row->tgl_akhir_banding;
								}
							?>
						</td>
						<td><button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id_hari;?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
						<button class="btn btn-danger btn-xs" onclick="del('<?php echo $row->id_hari;?>')"><i class="fa fa-trash"></i></button>
					</tr>
				<?php $x++; }
			?>
			</tbody>
	  		</table>
        </div><!-- /.box-body -->
  	</div><!-- /.box -->
</div>


<div class="example-modal">
<div class="modal modal-success fade" id="newData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="box-content">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Master Hari</h4>
                </div>
                <div class="modal-body" style="background-color: #fff!important;">
					<form id="addForm" name="addForm">
						<label style="color: #000;font-weight: 400;font-size: 19px;">Bulan</label>
						<div class="form-group">
							<div class="input-group">
                    			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			                    <select name="bulan" id="bulan" class="form-control"><option value="">Pilih Bulan</option>
								<?php foreach($bulan->result() as $row){?>
									<option value="<?php echo $row->id;?>"><?php echo $row->nama_bulan;?></option>
								<?php }?>
								</select>
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Tahun</label>
						<div class="form-group"><div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                <select name="tahun" id="tahun" class="form-control">
      							<option value="">Pilih Tahun</option>
          						<option value="2014">2014</option>                    
      								<option value="2015">2015</option>
      								<option value="2016">2016</option>
      								<option value="2017">2017</option>
      								<option value="2018">2018</option>
      								<option value="2019">2019</option>
      								<option value="2020">2020</option>
      								<option value="2021">2021</option>
      								<option value="2022">2022</option>
      								<option value="2023">2023</option>
      								<option value="2024">2024</option>
      								<option value="2025">2025</option>
    							</select>
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Jumlah Hari Aktif</label>
						<div class="form-group">
							<div class="input-group">
	                    		<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
	                    		<input type="text" id="jmlhari" name="jmlhari" class="form-control auto" placeholder="Jumlah Hari Aktif" data-v-min=0 data-v-max=31 data-a-pad="false">
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Total Menit Efektif/Bulan</label>
						<div class="form-group"><div class="input-group">
	                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
	                    <input type="text" id="total_menit_bulan" name="total_menit_bulan" class="form-control auto" placeholder="Total Menit Efektif/Bulan"  data-v-min=0 data-v-max=7000 data-a-pad="false">
						</div></div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Jumlah Menit Per Hari</label>
						<div class="form-group">
							<div class="input-group">
	                    		<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
			                    <input type="text" id="hdnjmlmenit" name="hdnjmlmenit" class="form-control auto" placeholder="Jumlah Menit Perhari"  data-v-min=0 data-v-max=330 data-a-pad="false" disabled="">
								<input type="hidden" name="jmlmenit" id="jmlmenit">
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Tanggal Awal Keberatan</label>
						<div class="form-group">
							<div class="input-group">
	                    		<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
	                    		<input type="text" id="tgl_awal_keberatan" name="tgl_awal_keberatan" class="form-control timerange">
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Tanggal Akhir Keberatan</label>
						<div class="form-group">
							<div class="input-group">
	                    		<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
	                    		<input type="text" id="tgl_akhir_keberatan" name="tgl_akhir_keberatan" class="form-control timerange">
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Tanggal Awal Banding</label>
						<div class="form-group">
							<div class="input-group">
	                    		<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
	                    		<input type="text" id="tgl_awal_banding" name="tgl_awal_banding" class="form-control timerange">
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Tanggal Akhir Banding</label>
						<div class="form-group">
							<div class="input-group">
	                    		<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
	                    		<input type="text" id="tgl_akhir_banding" name="tgl_akhir_banding" class="form-control timerange">
							</div>
						</div>
					</form>
                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
					<input type="submit" class="btn btn-primary" value="Simpan" id="add"/>
                </div>
            </div>
        </div>
	</div>
</div>
</div>

<div class="example-modal">
<div class="modal modal-success fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="box-content">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Master Hari</h4>
                  </div>
                <div class="modal-body" style="background-color: #fff!important;">
					<form id="editForm" name="addForm">

						<label style="color: #000;font-weight: 400;font-size: 19px;">Bulan</label>
						<div class="form-group"><div class="input-group">
	                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                    <select name="nbulan" id="nbulan" class="form-control" disabled="disabled"><option value="">Pilih Bulan</option>
						<?php foreach($bulan->result() as $row){?>
							<option value="<?php echo $row->id;?>"><?php echo $row->nama_bulan;?></option>
						<?php }?>
						</select>
						</div></div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Tahun</label>
						<div class="form-group"><div class="input-group">
	                    <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
	                    <select name="ntahun" id="ntahun" class="form-control" disabled="disabled">
						<option value="">Pilih Tahun</option>
						<option value="2014">2014</option>
						<option value="2015">2015</option>
						<option value="2016">2016</option>
						<option value="2017">2017</option>
						<option value="2018">2018</option>
						<option value="2019">2019</option>
						<option value="2020">2020</option>
						<option value="2021">2021</option>
						<option value="2022">2022</option>
						<option value="2023">2023</option>
						<option value="2024">2024</option>
						<option value="2025">2025</option>
						</select>
						</div></div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Jumlah Hari Aktif</label>
						<div class="form-group"><div class="input-group">
	                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
	                    <input type="text" id="njmlhari" name="njmlhari" class="form-control auto" placeholder="Jumlah Hari Aktif" data-v-min=0 data-v-max=31 data-a-pad="false">
						</div></div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Total Menit Efekti/Bulan</label>
						<div class="form-group"><div class="input-group">
	                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
	                    <input type="text" id="ntotal_menit_bulan" name="ntotal_menit_bulan" class="form-control auto" placeholder="Total Menit Efekti/Bulan"  data-v-min=0 data-v-max=7000 data-a-pad="false">
						<input type="hidden" id="oid" name="oid">
						</div></div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Jumlah Menit Per Hari</label>
						<div class="form-group"><div class="input-group">
	                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
	                    <input type="text" id="nhdnjmlmenit" name="nhdnjmlmenit" class="form-control auto" placeholder="Jumlah Menit Perhari"  data-v-min=0 data-v-max=330 data-a-pad="false" disabled="">
						<input type="hidden" name="njmlmenit" id="njmlmenit">
						</div></div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Tanggal Awal Keberatan</label>
						<div class="form-group">
							<div class="input-group">
	                    		<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
	                    		<input type="text" id="ntgl_awal_keberatan" name="ntgl_awal_keberatan" class="form-control timerange">
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Tanggal Akhir Keberatan</label>
						<div class="form-group">
							<div class="input-group">
	                    		<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
	                    		<input type="text" id="ntgl_akhir_keberatan" name="ntgl_akhir_keberatan" class="form-control timerange">
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Tanggal Awal Banding</label>
						<div class="form-group">
							<div class="input-group">
	                    		<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
	                    		<input type="text" id="ntgl_awal_banding" name="ntgl_awal_banding" class="form-control timerange">
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Tanggal Akhir Banding</label>
						<div class="form-group">
							<div class="input-group">
	                    		<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
	                    		<input type="text" id="ntgl_akhir_banding" name="ntgl_akhir_banding" class="form-control timerange">
							</div>
						</div>
					</form>
                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
					<input type="submit" class="btn btn-primary" value="Simpan" id="edit"/>

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
$(document).ready(function(){

    $('.timerange').datepicker({
    	format: 'yyyy-mm-dd'
    });

	$("#addData").click(function(){
		$("#newData").modal('show');
		$("#agama").focus();
	})

	$("#jmlhari").change(function()
	{
		jmlhari           = $("#jmlhari").val();
		total_menit_bulan = $("#total_menit_bulan").val().replace(/,/g, '');
		$("#hdnjmlmenit").val(total_menit_bulan/jmlhari);
		$("#jmlmenit").val(total_menit_bulan/jmlhari);
	})

	$("#total_menit_bulan").change(function()
	{
		jmlhari           = $("#jmlhari").val();
		total_menit_bulan = $("#total_menit_bulan").val().replace(/,/g, '');
		$("#hdnjmlmenit").val(total_menit_bulan/jmlhari);
		$("#jmlmenit").val(total_menit_bulan/jmlhari);
	})

	$("#njmlhari").change(function()
	{
		jmlhari           = $("#njmlhari").val();
		total_menit_bulan = $("#ntotal_menit_bulan").val().replace(/,/g, '');
		$("#nhdnjmlmenit").val(total_menit_bulan/jmlhari);
		$("#njmlmenit").val(total_menit_bulan/jmlhari);
	})

	$("#ntotal_menit_bulan").change(function()
	{
		jmlhari           = $("#njmlhari").val();
		total_menit_bulan = $("#ntotal_menit_bulan").val().replace(/,/g, '');
		$("#nhdnjmlmenit").val(total_menit_bulan/jmlhari);
		$("#njmlmenit").val(total_menit_bulan/jmlhari);
	})

	$("#add").click(function(){
		var bulan               = $("#bulan").val();
		var tahun               = $("#tahun").val();
		var hari                = $("#jmlhari").val();
		var menit               = $("#jmlmenit").val();
		var tgl_awal_keberatan  = $("#tgl_awal_keberatan").val();
		var tgl_akhir_keberatan = $("#tgl_akhir_keberatan").val();
		var tgl_awal_banding    = $("#tgl_awal_banding").val();
		var tgl_akhir_banding   = $("#tgl_akhir_banding").val();

		if (bulan.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data bulan tidak boleh kosong"
			});
		}
		else if (tahun.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data tahun tidak boleh kosong."
			});
		}
		else if (hari.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Jumlah Hari Aktif tidak boleh kosong."
			});
		}
		else if (menit.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Jumlah Menit Per Hari tidak boleh kosong."
			});
		}
		else if (tgl_awal_keberatan.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Tanggal Awal Keberatan tidak boleh kosong."
			});
		}
		else if (tgl_akhir_keberatan.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Tanggal Akhir Keberatan tidak boleh kosong."
			});
		}
		else if (tgl_awal_banding.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Tanggal Awal Banding tidak boleh kosong."
			});
		}
		else if (tgl_akhir_banding.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Tanggal Akhir Banding tidak boleh kosong."
			});
		}
		else
		{
			$.ajax({
				url :"<?php echo site_url()?>/master/data_hari/addHari_aktif",
				type:"post",
				data:"bulan="+bulan+"&tahun="+tahun+"&hari="+hari+"&menit="+menit+"&tgl_awal_keberatan="+tgl_awal_keberatan+"&tgl_akhir_keberatan="+tgl_akhir_keberatan+"&tgl_awal_banding="+tgl_awal_banding+"&tgl_akhir_banding="+tgl_akhir_banding,
				beforeSend:function(){
					$("#newData").modal('hide');
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
						msg: 'Gagal Melakukan Penambahan data'
					});
				}
			})
		}


	})

	$("#edit").click(function(){
		var bulan               = $("#nbulan").val();
		var tahun               = $("#ntahun").val();
		var hari                = $("#njmlhari").val();
		var menit               = $("#njmlmenit").val();
		var tgl_awal_keberatan  = $("#ntgl_awal_keberatan").val();
		var tgl_akhir_keberatan = $("#ntgl_akhir_keberatan").val();
		var tgl_awal_banding    = $("#ntgl_awal_banding").val();
		var tgl_akhir_banding   = $("#ntgl_akhir_banding").val();

		if (bulan.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data bulan tidak boleh kosong"
			});
		}
		else if (tahun.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data tahun tidak boleh kosong."
			});
		}
		else if (hari.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Jumlah Hari Aktif tidak boleh kosong."
			});
		}
		else if (menit.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Jumlah Menit Per Hari tidak boleh kosong."
			});
		}
		else if (tgl_awal_keberatan.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Tanggal Awal Keberatan tidak boleh kosong."
			});
		}
		else if (tgl_akhir_keberatan.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Tanggal Akhir Keberatan tidak boleh kosong."
			});
		}
		else if (tgl_awal_banding.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Tanggal Awal Banding tidak boleh kosong."
			});
		}
		else if (tgl_akhir_banding.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Tanggal Akhir Banding tidak boleh kosong."
			});
		}
		else
		{
			$.ajax({
				url :"<?php echo site_url();?>/master/data_hari/peditHari_aktif",
				type:"post",
				data:$("#editForm").serialize(),
				beforeSend:function(){
					$("#editData").modal('hide');
					$("#loadprosess").modal('show');
				},
				success:function(){
					Lobibox.notify('success', {
						msg: 'Data Berhasil Dirubah'
						});
					$("#isi").load('data_hari/ajaxHari_aktif');
					setTimeout(function(){
						$("#loadprosess").modal('hide');
					}, 5000);
				},
				error:function(){
					Lobibox.notify('error', {
						msg: 'Gagal Melakukan Perubahan data'
					});
				}
			})
		}
	})
})

function edit(id){
	$("#loadprosess").modal('show');
	$.getJSON('<?php echo site_url() ?>/master/data_hari/editHari_aktif/'+id,
		function( response ) {
			$("#editData").modal('show');
			$("#nbulan").val(response['bulan']);
			$("#ntahun").val(response['tahun']);
			$("#njmlhari").val(response['jml_hari_aktif']);
			$("#njmlmenit").val(response['jml_menit_perhari']);
			$("#ntgl_awal_keberatan").val(response['tgl_awal_keberatan']);
			$("#ntgl_akhir_keberatan").val(response['tgl_akhir_keberatan']);
			$("#ntgl_awal_banding").val(response['tgl_awal_banding']);
			$("#ntgl_akhir_banding").val(response['tgl_akhir_banding']);
			$("#ntotal_menit_bulan").val(response['jml_hari_aktif']*response['jml_menit_perhari'])
			$("#oid").val(response['id_hari']);
			setTimeout(function(){
				$("#loadprosess").modal('hide');
			}, 1000);
		}
	);
}

function del(id){
	 Lobibox.confirm({
		 title: "Konfirmasi",
		 msg: "Anda yakin akan menghapus data ini ?",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>/master/data_hari/delhari_aktif/"+id,
					type:"post",
					beforeSend:function(){
						$("#loadprosess").modal('show');
					},
					success:function(){
						Lobibox.notify('success', {
							msg: 'Data Berhasil Dihapus'
						});
						$("#isi").load('data_hari/ajaxHari_aktif');
						setTimeout(function(){
							$("#loadprosess").modal('hide');
						}, 3000);
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

jQuery(function($) {
    $('.auto').autoNumeric('init');
});

$(function () {
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
				"<'row'<'col-sm-5'i><'col-sm-7'p>>"

		// "dom": '<"top"f>rt'
		// "dom": '<"top"fl>rt<"bottom"ip><"clear">'
	});
});
</script>
