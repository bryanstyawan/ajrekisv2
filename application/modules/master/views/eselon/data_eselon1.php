<div class="col-xs-12">
	<div class="box">
        <div class="box-header">
			<h3 class  ="box-title pull-right"><button class="btn btn-block btn-primary" id="addData"><i class="fa fa-plus-square"></i> Tambah Eselon 1</button></h3>
			<div class ="box-tools">
			</div>
        </div>
        <div class="box-body" id="isi">
            <table class="table table-bordered table-striped table-view">
              <thead>
            <tr>
              <th>No</th>
			  <th>Nama Eselon 1</th>
			  <th>Action</th>
            </tr>
			</thead>
			<tbody>
			<?php
				for ($i=0; $i < count($list_final); $i++) { 
					# code...
			?>
					<tr>
						<td><?=$i+1;?></td>
						<td><?=$list_final[$i]['nama_eselon1'];?></td>
						<td>
							<button class="btn btn-primary btn-xs" onclick="edit('<?php echo $list_final[$i]['id_es1'];?>')"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
					<?php
							if($list_final[$i]['counter_data'] == 0)
							{
					?>
							<button class="btn btn-danger btn-xs" onclick="del('<?php echo $list_final[$i]['id_es1'];?>')"><i class="fa fa-trash"></i></button>											
					<?php
							}
					?>
						</td>
					</tr>
			<?php
				}
			?>
			</tbody>
		  </table>

        </div>
    </div>
</div>

<div class="example-modal">
	<div class="modal modal-success fade" id="newData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="box-content">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h4 class="modal-title">Form Eselon 1</h4>
	                  </div>
	                <div class="modal-body" style="background-color: #fff!important;">
						<form id="addForm" name="addForm">
							<label style="color: #000;font-weight: 400;font-size: 19px;">Eselon I</label>
							<div class="form-group">
								<div class="input-group">
			                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
			                    <input type="text" id="es1" name="es1" class="form-control" placeholder="Nama Eselon" maxlength="100">
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
                    <h4 class="modal-title">Form Eselon</h4>
                  </div>
                <div class="modal-body" style="background-color: #fff!important;">
					<form id="editForm" name="addForm">
						<label style="color: #000;font-weight: 400;font-size: 19px;">Eselon I</label>
						<div class="form-group">
							<div class="input-group">
								<span class ="input-group-addon"><i class="fa fa-star"></i></span>
								<input type ="text" id="nes1" name="nes1" class="form-control" maxlength="100">
								<input type ="hidden" id="oid" name="oid">
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
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/	dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	$("#addData").click(function(){
		$("#newData").modal('show');
	})

	$("#add").click(function(){
		var es1= $("#es1").val();
		if (es1.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Eselon 1 tidak boleh kosong."
			});
		}
		else
		{
			$.ajax({
				url :"<?php echo site_url()?>/master/data_eselon1/addEselon1",
				type:"post",
				data:"es1="+es1,
				beforeSend:function(){
					$("#newData").modal('hide');
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

	$("#edit").click(function(){
		var es1= $("#nes1").val();
		if (es1.length <= 0)
		{
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
			{
				msg: "Data Eselon 1 tidak boleh kosong."
			});
		}
		else
		{
			$.ajax({
				url :"<?php echo site_url();?>/master/data_eselon1/peditEselon1",
				type:"post",
				data:$("#editForm").serialize(),
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
		}
	})
})

function edit(id)
{
	$("#loadprosess").modal('show');
	$.getJSON('<?php echo site_url() ?>/master/data_eselon1/editEselon1/'+id,
		function( response ) {
			$("#editData").modal('show');
			$("#nes1").val(response['nama_eselon1']);
			$("#oid").val(response['id_es1']);
			setTimeout(function(){
				$("#loadprosess").modal('hide');
			}, 1000);
		}
	);
}

function del(id){
    LobiboxBase = {
        //DO NOT change this value. Lobibox depended on it
        bodyClass       : 'lobibox-open',
        //DO NOT change this object. Lobibox is depended on it
        modalClasses : {
            'error'     : 'lobibox-error',
            'success'   : 'lobibox-success',
            'info'      : 'lobibox-info',
            'warning'   : 'lobibox-warning',
            'confirm'   : 'lobibox-confirm',
            'progress'  : 'lobibox-progress',
            'prompt'    : 'lobibox-prompt',
            'default'   : 'lobibox-default',
            'window'    : 'lobibox-window'
        },
        buttons: {
            ok: {
                'class': 'lobibox-btn lobibox-btn-default',
                text: 'OK',
                closeOnClick: true
            },
            cancel: {
                'class': 'lobibox-btn lobibox-btn-cancel',
                text: 'Cancel',
                closeOnClick: true
            },
            yes: {
                'class': 'lobibox-btn lobibox-btn-yes',
                text: 'Ya',
                closeOnClick: true
            },
            no: {
                'class': 'lobibox-btn lobibox-btn-no',
                text: 'Tidak',
                closeOnClick: true
            }
        }
    }

	 Lobibox.confirm({
		 title: "Konfirmasi",
		 msg: "Anda yakin akan menghapus data ini ?",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>/master/data_eselon1/delEselon1/"+id,
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
</script>
