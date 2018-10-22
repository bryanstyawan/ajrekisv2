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
			<h3 class  ="box-title pull-right"><button class="btn btn-block btn-primary" id="addData"><i class="fa fa-plus-square"></i> Tambah Akademik</button></h3>
			<div class ="box-tools"></div>
        </div><!-- /.box-header -->
        <div class="box-body" id="isi">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Inisial</th>
                        <th>Nama</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $x=1;
                    foreach($list->result() as $row){?>
                        <tr>
                            <td><?php echo $x;?></td>
                            <td><?php echo $row->kode;?></td>
                            <td><?php echo $row->nama_pendidikan;?></td>
                            <td>
                                <button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id_pendidikan;?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
                                <button class="btn btn-danger btn-xs" onclick="del('<?php echo $row->id_pendidikan;?>')"><i class="fa fa-trash"></i></button>
                            </td>
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
                    <h4 class="modal-title">Form Master Akademik</h4>
                </div>
                <div class="modal-body" style="background-color: #fff!important;">
					<form id="addForm" name="addForm">

						<label style="color: #000;font-weight: 400;font-size: 19px;">Inisial</label>
						<div class="form-group">
							<div class="input-group">
	                    		<span class="input-group-addon"><i class="fa fa-circle-o"></i></span>
	                    		<input type="text" id="data_inisial" name="data_inisial" class="form-control">
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Nama</label>
						<div class="form-group">
							<div class="input-group">
	                    		<span class="input-group-addon"><i class="fa fa-circle-o"></i></span>
	                    		<input type="text" id="data_nama" name="data_nama" class="form-control">
							</div>
						</div>

					</form>
                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
					<input type="submit" class="btn btn-primary" value="Simpan" id="btn_add_data"/>
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
                    <h4 class="modal-title">Form Master Akademik</h4>
                </div>
                <div class="modal-body" style="background-color: #fff!important;">
					<form id="editForm" name="editForm">

						<label style="color: #000;font-weight: 400;font-size: 19px;">Inisial</label>
						<div class="form-group">
							<div class="input-group">
	                    		<span class="input-group-addon"><i class="fa fa-circle-o"></i></span>
	                    		<input type="text" id="ndata_inisial" name="ndata_inisial" class="form-control">
	                    		<input type="hidden" id="noid" name="ndata_inisial" class="form-control">                                
							</div>
						</div>

						<label style="color: #000;font-weight: 400;font-size: 19px;">Nama</label>
						<div class="form-group">
							<div class="input-group">
	                    		<span class="input-group-addon"><i class="fa fa-circle-o"></i></span>
	                    		<input type="text" id="ndata_nama" name="ndata_nama" class="form-control">
							</div>
						</div>

					</form>
                </div>
                <div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
					<input type="submit" class="btn btn-primary" value="Simpan" id="btn_edit_data"/>
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
	})

	$("#btn_add_data").click(function(){
		var inisial               = $("#data_inisial").val();
		var nama               = $("#data_nama").val();

		if (inisial.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data inisial tidak boleh kosong"
			});
		}
		else if (nama.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data nama tidak boleh kosong."
			});
		}
		else
		{
            data_sender = {
                                'kode'           : inisial,
                                'nama_pendidikan': nama
            }
			$.ajax({
				url :"<?php echo site_url()?>master/data_akademik/add_akademik",
				type:"post",
                data:{data_sender : data_sender},
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

	$("#btn_edit_data").click(function(){
		var inisial = $("#ndata_inisial").val();
		var nama    = $("#ndata_nama").val();
		var oid     = $("#noid").val();

        data_sender = {
                            'kode'           : inisial,
                            'nama_pendidikan': nama,
                            'id_pendidikan'  : oid
        }

		if (inisial.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data inisial tidak boleh kosong"
			});
		}
		else if (nama.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data nama tidak boleh kosong."
			});
		}
		else
		{
			$.ajax({
				url :"<?php echo site_url();?>master/data_akademik/peditAkademik",
				type:"post",
				data:{data_sender:data_sender},
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
						msg: 'Gagal Melakukan Perubahan data'
					});
				}
			})
		}
	})
})

function edit(id){
	$("#loadprosess").modal('show');
	$.getJSON('<?php echo site_url() ?>master/data_akademik/editAkademik/'+id,
		function( response ) {
            console.log(response[0].kode);
			$("#editData").modal('show');
			$("#ndata_inisial").val(response[0].kode);
			$("#ndata_nama").val(response[0].nama_pendidikan);
			$("#noid").val(response[0].id_pendidikan);
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
					url :"<?php echo site_url()?>master/data_akademik/del_akademik/"+id,
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
