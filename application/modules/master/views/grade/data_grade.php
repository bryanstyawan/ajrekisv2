<div class="col-xs-12">
              <div class="box box-default collapsed-box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><button class="btn btn-block btn-primary" id="addData" style= "color: #fff;"><i class="fa fa-plus-square"></i> Tambah Data</button></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
				<h4 class="box-title">Posisi Class</h4>
                <div class="box-body" id="isi">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                    <tr>
                      <th>No</th>
                      <th>Grade</th>
					  <th>Tunjangan</th>
					  <th>action</th>
                    </tr>
					</thead>
					<tbody>
					<?php $x=1;
						foreach($list->result() as $row){?>
							<tr>
								<td><?php echo $x;?></td>
								<td><?php echo $row->posisi_class;?></td>
								<td><?php echo number_format($row->tunjangan);?></td>
								<td><button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id;?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
								<button class="btn btn-primary btn-xs" onclick="del('<?php echo $row->id;?>')"><i class="fa fa-trash"></i></button>
							</tr>
						<?php $x++; }
					?>
					</tbody>
				  </table>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
<div class="col-md-4">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Kategori Jabatan</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <?php foreach($kat_pos->result() as $row){
						echo "<li>".anchor('master/grade/'.$row->id,$row->nama_kat_posisi)."</li>";
					}?>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
            <div class="col-xs-8" id="data_akses">
              <div class="box">
				<table class="table table-striped">
					<tbody>
					<tr>
						<th>Range Class</th>
						<th>Tunjangan</th>
						<th>Aktif</th>
					</tr>
					<?php
						foreach($grade->result() as $row){?>
							<tr>
								<td><?php echo $row->posisi_class;?></td>
								<td><?php echo number_format($row->tunjangan);?></td>
								<td><?php if ($row->flag == 0){echo "<input id=".$row->id." class='minimal' type='checkbox' value=".$row->flag." onclick='aktivasi(".$row->id.")'>";}else{echo "<input id=".$row->id." class='minimal' type='checkbox' value=".$row->flag." onclick='aktivasi(".$row->id.")' checked >";} ?></td>
							</tr>
						<?php  }
					?>
					</tbody>

				</table>
              </div><!-- /.box -->
            </div>
<input type="hidden" id="kat_pos" value="<?php echo $this->uri->segment(3);?>">
<!-- DataTables -->
	<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	$("#addData").click(function(){
		$("#newData").modal('show');
	})
	$("#add").click(function(){
		var grade= $("#grade").val();
		var tunjangan= $("#tunjangan").val();
		if (grade.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Nilai Grade tidak boleh kosong."
			});
		}
		else if (tunjangan.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Jumlah Tunjangan tidak boleh kosong."
			});
		}
		else
		{

		$.ajax({
			url :"<?php echo site_url()?>/master/addGrade",
			type:"post",
			data:"grade="+grade+"&tunjangan="+tunjangan,
			beforeSend:function(){
				$("#newData").modal('hide');
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
	    var grade= $("#ngrade").val();
		var tunjangan= $("#ntunjangan").val();
		if (grade.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Nilai Grade tidak boleh kosong."
			});
		}
		else if (tunjangan.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Jumlah Tunjangan tidak boleh kosong."
			});
		}
		else
		{
		$.ajax({
			url :"<?php echo site_url();?>/master/peditGrade",
			type:"post",
			data:$("#editForm").serialize(),
			beforeSend:function(){
				$("#editData").modal('hide');
			},
			success:function(){
				Lobibox.notify('success', {
					msg: 'Data Berhasil Dirubah'
					});
				location.reload();
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
	$.getJSON('<?php echo site_url() ?>/master/editGrade/'+id,
		function( response ) {
			$("#editData").modal('show');
			$("#ngrade").val(response['posisi_class']);
			$("#ntunjangan").val(response['tunjangan']);
			$("#oid").val(response['id']);
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
					url :"<?php echo site_url()?>/master/delGrade/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						location.reload();
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

function aktivasi(id){
	var nilai = $("#"+id).val();
	var kat_pos = $("#kat_pos").val();
	$.ajax({
		url :"<?php echo site_url();?>/master/aktivasi",
		type:"post",
		data:"id_grade="+id+"&nilai="+nilai+"&kat_pos="+kat_pos,
		success:function(pesan){
			$("#data_akses").html(pesan);
			Lobibox.notify('success',{
				msg : 'Aktivasi Grade Berhasil',
				size: 'mini',
				delay:500
			});
		}
	})
}

jQuery(function($) {
    $('.auto').autoNumeric('init');
});

      $(function () {
        $("#example1").DataTable();
      });
</script>
<div class="example-modal">
<div class="modal modal-success fade" id="newData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="box-content">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data</h4>
                  </div>
                <div class="modal-body" style="background-color: #fff!important;">
      					<form id="addForm" name="addForm">
      					<div class="form-group"><div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-certificate"></i></span>
                          <input type="text" id="grade" name="grade" class="form-control auto" placeholder="Nilai Grade" data-a-pad="false">
      					</div></div>
      					<div class="form-group"><div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-money"></i></span>
                          <input type="text" id="tunjangan" name="tunjangan" class="form-control auto" placeholder="Jumlah Tunjangan" data-a-pad="false">
      					</div></div>
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
                    <h4 class="modal-title">Edit Data</h4>
                  </div>
                <div class="modal-body" style="background-color: #fff!important;">
					<form id="editForm" name="addForm">
					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-certificate"></i></span>
                    <input type="text" id="ngrade" name="ngrade" class="form-control auto" placeholder="Nilai Grade" data-a-pad="false">
					</div></div>
					<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                    <input type="text" id="ntunjangan" name="ntunjangan" class="form-control auto" placeholder="Jumlah Tunjangan" data-a-pad="false">
					<input type="hidden" name="oid" id="oid"/>
					</div></div>
					</form>
                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Keluar</a>
					<input type="submit" class="btn btn-primary" value="Simpan" id="edit"/>

                </div>
            </div>
        </div>
	</div>
</div>
</div>
