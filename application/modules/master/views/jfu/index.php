<div class="col-xs-12">
	<div class="box">
        <div class="box-header">
			
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-10">
                        <p>Pastikan untuk melakukan unduh terlebih dahulu untuk mendapatkan format yang akan digunakan untuk unggah data. <br/>                        
                    </div>
                    <div class="col-lg-2" style="padding-right: 0px;">
                        <h3 class="box-title pull-right">
                            <a href="<?php echo site_url()?>master/jabatan_fungsional_umum/template_master_jfu/" class="btn btn-block btn-primary">Unduh Template</a>
                        </h3>                           
                    </div>                
                </div>                
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <form id="upload_file" onsubmit="return validateForm()" method="post" action="<?php echo site_url()?>master/jabatan_fungsional_umum/import_master_jfu/" enctype="multipart/form-data">
                        <div class="col-lg-12">
                            <div class="col-lg-2"><span>Unggah dari Excel :</span></div>
                            <div class="col-lg-5">
                                <div class="uploader" >
                                    <input type="file" name="userfile" id="userfile" size="20" class="form-control text_controll required">
                                    <input type="hidden" name="param_report" id="param_report" value="status_upload">
                                </div>                      
                            </div>
                            <div class="col-lg-5" style="padding-right: 0px;">
                                <h3 class="box-title pull-right">
                                    <input type="submit" class="btn btn-block btn-primary" name="submit" id="submit" value="Unggah" />
                                </h3>                           
                            </div>
                        </div>
                    </form>        
                </div>
            </div>
            <hr>  
			<div class="col-lg-12">
				<h3 class="box-title pull-right">
					<button class="btn btn-block btn-primary" id="addData"><i class="fa fa-plus-square"></i> Tambah Jabatan Fungsional</button>
				</h3>			
			</div>
			<div class="box-tools">
			</div>
        </div>
        <div class="box-body" id="isi">
            <table class="table table-bordered table-striped table-view">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Jabatan</th>
                        <th>Kelas Jabatan</th>
						<th>Tunjangan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
				<?php
					if ($list != 0) {
						# code...
						for ($i=0; $i < count($list); $i++) { 
							# code...
				?>
							<tr>
								<td><?=$i+1;?></td>
								<td><?=$list[$i]->nama_jabatan;?></td>
								<td><?=$list[$i]->posisi_class;?></td>
								<td><?=number_format($list[$i]->tunjangan,0);?></td>								
								<td>
									<a href="<?=base_url();?>master/jabatan_fungsional_umum/detail/<?=$list[$i]->id;?>" class="btn btn-warning"><i class="fa fa-edit"></i> Ubah</a>
				<?php
									if($list[$i]->counter_jfu != 0)
									{
										if ($list[$i]->status == 1) {
											# code...
				?>
											<a href="" class="btn btn-danger"><i class="fa fa-power-off"></i> Tidak Aktif</a>													
				<?php											
										}
										else {
											# code...
				?>
											<a href="" class="btn btn-success"><i class="fa fa-power-off"></i> Aktif</a>													
				<?php											
										}
									}
									else {
										# code...
				?>
										<a href="" class="btn btn-danger"><i class="fa fa-close"></i> Hapus</a>													
				<?php
									}
				?>

									<!-- <a href="" class="btn btn-danger"><i class="fa fa-close"></i> <?=$list[$i]->counter_jfu;?></a>																		 -->
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

<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/	dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	$("#addData").click(function()
	{
		window.location.href = "<?=base_url();?>master/jabatan_fungsional_umum/add_data";		
		// $("#newData").modal('show');
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
				success:function(){
					Lobibox.notify('success', {
						msg: 'Data Berhasil Ditambahkan. Mohon tunggu, sedang memuat data.'
					});
					$("#isi").load('data_eselon1/ajaxEselon1');
					setTimeout(function(){
						$("#loadprosess").modal('hide');
					}, 5000);
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
				success:function(){
					Lobibox.notify('success', {
						msg: 'Data Berhasil Dirubah. Mohon tunggu, sedang memuat data.'
						});
					$("#isi").load('data_eselon1/ajaxEselon1');
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

function validateForm() {
    // body...

    userfile   = $('#userfile').prop('files')[0];        

    // console.log(file_pendukung);
    if (userfile == undefined)
    {
        Lobibox.notify('warning', {
            msg: 'Harap lampirkan file excel terlebih dahulu'
            });        
        return false;
    }    
}

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
					success:function(){
						Lobibox.notify('success', {
							msg: 'Data Berhasil Dihapus. Mohon tunggu, sedang memuat data.'
						});
						$("#isi").load('data_eselon1/ajaxEselon1');
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
</script>
