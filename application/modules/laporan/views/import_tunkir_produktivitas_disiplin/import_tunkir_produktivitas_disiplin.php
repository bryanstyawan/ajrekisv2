<div class="col-xs-12">
  	<div class="box">
    	<div class="box-header">

			<div class="box-body">
				<div class="container-fluid">
					<div class="row col-xs-6">

			            <h4>Bulan</h4>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
			                </span>		
			                <select class="form-control" name="bulan" id="bulan">
			                	<option value="">------------NONE------------</option>		                
			                	<?php
			                		for ($i=1; $i <= count($bulan); $i++) { 
			                			# code...
			                	?>
				                	<option value="<?=$i;?>"><?=$bulan[$i]['nama'];?></option>		                			                	
			                	<?php
			                		}
			                	?>
			                </select>                								
			            </div>
						<progress class="progress progress-striped progress-animated" id="prg_progress_bar_es1" style="width: 473px;margin-bottom: 0px;visibility: hidden;" value="0" max="100">
							25%
						</progress>		            		            

					</div>

					<div class="row col-xs-6 pull-right">

			            <h4>Tahun</h4>
						<div id="isi_select_eselon_2">			                
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
				                </span>		
				                <select class="form-control" name="tahun" id="tahun">
				                	<option value="">------------NONE------------</option>
			                	<?php
									$year_first = date('Y') - 5;
									$year_end   = date('Y') + 5;			                		
			                		for ($i=$year_first; $i <= $year_end; $i++) { 
			                			# code...
			                	?>
				                	<option value="<?=$i;?>"><?=$i;?></option>		                			                	
			                	<?php
			                		}
			                	?>				                			                
				                </select>                								
				            </div>
							<progress class="progress progress-striped progress-animated" id="prg_progress_bar_es2" style="width: 473px;margin-bottom: 0px;visibility: hidden;" value="0" max="100">
								25%
							</progress>
						</div>		            		                			            

					</div>

					<div class="col-lg-12" style="margin-bottom: 10px;border-bottom: 1px solid #d2d6de;">
						<h3 class="box-title pull-right">
							<button class="btn btn-block btn-primary" id="btn_look" style="margin: 10px 0;"><i class="fa fa-search"></i> Lihat</button>
						</h3>
					</div>				
					<div class="col-lg-12">
						<div class="col-lg-2"><span>Unggah dari Excel :</span></div>
						<div class="col-lg-5">
							<div class="uploader" >
				                <input type="file" name="userfile" id="userfile" class="form-control text_controll">
				                <input type="hidden" name="param_report" id="param_report" value="status_upload">
							</div>						
						</div>
						<div class="col-lg-5" style="padding-right: 0px;">
							<h3 class="box-title pull-right">
								<a href="#" class="btn btn-block btn-primary" style="margin: 10px 0;" onclick="unggah_excel()"><i class="fa fa-upload"></i> Unggah Excel</a>
								<a href="<?php echo base_url() . 'public/Sample Data Tunj Kehadiran.xls';?>" class="btn btn-block btn-success" style="margin: 10px 0;"><i class="fa fa-download"></i> Unduh Template</a>
							</h3>							
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
		     	<h3 class="box-title pull-right">
		     		<button class="btn btn-block btn-primary" id="btn_save_all"><i class="fa fa-save"></i> Simpan</button>
	     		</h3>	     		
		     	<h3 class="box-title pull-right" style="margin-right: 10px;">
		     		<button class="btn btn-block btn-danger" id="btn_delete_invalid_data"><i class="fa fa-trash"></i> Hapus Invalid Data </button>
	     		</h3>
		     	<h3 class="box-title pull-right" style="margin-right: 10px;">
		     		<button class="btn btn-block btn-danger" id="btn_delete_all_data"><i class="fa fa-trash"></i> Hapus Semua data</button>
	     		</h3>	     		
	    </div><!-- /.box-header -->
	    <div class="box-body" id="isi">
			<progress class="progress progress-striped progress-animated" id="prg_progress_bar" style="width: 1085px;display: none;" value="0" max="100">
				25%
			</progress>
		  	<div >
			  	<table id="example1" class="table table-bordered table-striped">
	      		<thead>
					<tr>
						<th>No</th>
						<th>ID</th>
						<th>NIP</th>
						<th>Nama</th>
						<th>NPWP</th>
						<th>GOl</th>
						<th>Kelas Jabatan</th>
						<th>Tunjangan Kinerja</th>
						<th>Tunjangan PLT/PLH</th>
						<th>Total Pengurangan</th>
						<th>Total</th>												
					</tr>
				</thead>
				<tbody id="table_content">

				</tbody>				  	
			  	</table>
	  		</div>					
    	</div><!-- /.box-body -->
  	</div><!-- /.box -->
</div>

<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#btn_save_all").css({"display": "none"});
	$("#btn_delete_all_data").css({"display": "none"});	
	$("#btn_delete_invalid_data").css({"display": "none"});		
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

	$("#btn_save_all").click(function() {
		// body...
		bulan    = $("#bulan").val();
		tahun    = $("#tahun").val();

	    if (bulan.length <= 0) 
	    {
			Lobibox.notify('warning', {
				msg: 'Bulan tidak boleh kosong'
			});        
	    }
	    else if (tahun.length <= 0) 
	    {
			Lobibox.notify('warning', {
				msg: 'tahun tidak boleh kosong'
			});            	
	    }
	    else
	    {
	    	data_sender = {
	    						'bulan' : bulan,
	    						'tahun'	: tahun,
	    	}
	    }		
	})	

	$("#btn_look").click(function() {
		// body...
		$("#btn_save_all").css({"display": "none"});
		$("#btn_delete_all_data").css({"display": "none"});	
		$("#btn_delete_invalid_data").css({"display": "none"});		
		bulan    = $("#bulan").val();
		tahun    = $("#tahun").val();

	    if (bulan.length <= 0) 
	    {
			Lobibox.notify('warning', {
				msg: 'Bulan tidak boleh kosong'
			});        
	    }
	    else if (tahun.length <= 0) 
	    {
			Lobibox.notify('warning', {
				msg: 'tahun tidak boleh kosong'
			});            	
	    }
	    else
	    {
		    Lobibox.confirm({
		         title: "Konfirmasi",
		         msg: "Apakah anda ingin melihat data temporary ? ",
		         callback: function ($this, type) {
		            if (type === 'yes'){
				        $("#loadprosess").modal('show');                                                
				        Lobibox.notify('info', {
				            msg: 'Menyiapkan data'
			            });			            	
			            setTimeout(function(){ 
							$("#isi").load('laporan/get_import_produktivitas_tunkir/'+'<?=$this->session->userdata('sesEs2');?>'+'/'+bulan+'/'+tahun);	
			            }, 1500);                                                                           	            	    			            	
		            }
		            else if(type === 'no')
		            {
				        $("#loadprosess").modal('show');                                                
				        Lobibox.notify('info', {
				            msg: 'Menyiapkan data'
			            });			            	
			            setTimeout(function(){ 
							$("#isi").load('laporan/get_import_produktivitas_tunkir_real/'+'<?=$this->session->userdata('sesEs2');?>'+'/'+bulan+'/'+tahun);	
			            }, 1500);		            	
		            }
		        }
		    })                              

		    // $.ajax({
		    //     url :"<?php echo site_url();?>laporan/check_data_import_produktivitas_tunkir/"+'<?=$this->session->userdata('sesEs2');?>'+'/'+bulan+'/'+tahun,
		    //     type:"post",
		    //     beforeSend:function(){
		    //         // $("#form_penilaian").modal('hide');
		    //         $("#loadprosess").modal('show');                                                
		    //     },
		    //     success:function(msg)
		    //     {

		    //     },
		    //     error:function(){
		    //         $("#product_section").css({'display': ""});                
		    //         Lobibox.notify('error', {
		    //             msg: 'Ada kesalahan sistem'
		    //         });
		    //     }
		    // })	        

			// Lobibox.notify('success', {
			// 	msg: 'excel Berhasil Diunggah. Mohon tunggu, sedang memuat data.'
			// });								    	
	    }		
	})

	$("#btn_save_all").click(function() {
        var data_sender = [];
		bulan    = $("#bulan").val();
		tahun    = $("#tahun").val();
	    if (bulan.length <= 0) 
	    {
			Lobibox.notify('warning', {
				msg: 'Bulan tidak boleh kosong'
			});        
	    }
	    else if (tahun.length <= 0) 
	    {
			Lobibox.notify('warning', {
				msg: 'tahun tidak boleh kosong'
			});            	
	    }
	    else
	    {
		    Lobibox.confirm({
		         title: "Konfirmasi",
		         msg: "Anda yakin akan menyimpan data ini ? data yang tidak valid tidak akan disimpan dan semua data ini akan dihapus.",
		         callback: function ($this, type) {
		            if (type === 'yes'){
		                $.ajax({
		                    url :"<?php echo site_url()?>laporan/save_import_produktivitas_tunkir/"+'<?=$this->session->userdata('sesEs2');?>'+'/'+bulan+'/'+tahun,
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
	        console.log(data_sender);
	    }  
	})		
});	

function unggah_excel() {
	// body...
	userfile = $('#userfile').prop('files')[0];
	bulan    = $("#bulan").val();
	tahun    = $("#tahun").val();

    if (bulan.length <= 0) 
    {
		Lobibox.notify('warning', {
			msg: 'Bulan tidak boleh kosong'
		});        
    }
    else if (tahun.length <= 0) 
    {
		Lobibox.notify('warning', {
			msg: 'tahun tidak boleh kosong'
		});            	
    }
    else
    {
	    if (userfile != undefined) 
	    {
	        var form_data = new FormData();
	        form_data.append('file', userfile);
	        $.ajax({
	            url: '<?php echo site_url();?>laporan/import_tunkir_produktivitas_disiplin_excel/'+bulan+'/'+tahun, // point to server-side PHP script
	            // dataType: 'json',  // what to expect back from the PHP script, if anything
	            cache: false,
	            contentType: false,
	            processData: false,
	            data: form_data,
	            type: 'post',
	            beforeSend:function(){
	                $("#editData").modal('hide');
	                $("#loadprosess").modal('show');                                                
	                Lobibox.notify('info', {
	                    msg: 'Menyiapkan data untuk upload file'
	                    });                            
	            },
	            success: function(msg1){
	                var obj1 = jQuery.parseJSON (msg1);             
	                console.log(msg1);
	                if (obj1.status == 1) 
	                { 
						Lobibox.notify('success', {
							msg: 'excel Berhasil Diunggah. Mohon tunggu, sedang memuat data.'
						});
						setTimeout(function(){ 
							$("#isi").load('laporan/show_data_displin/'+'<?=$this->session->userdata('sesEs2');?>'+'/'+bulan+'/'+tahun);
							$("#btn_save_all").css({"display": ""});
							// $("#btn_delete_all_data").css({"display": ""});	
							// $("#btn_delete_invalid_data").css({"display": ""});							
							$("#loadprosess").modal('hide');
						}, 1500);			
	                }
	                else
	                {
	                    Lobibox.notify('warning', {
	                        msg: 'Excel tidah Berhasil diunggah.'
	                        });
	                    setTimeout(function(){ 
	                        $("#loadprosess").modal('hide');                                
	                    }, 5000);                                                                           
	                }                             
	            },
	            error:function(){
	                Lobibox.notify('error', {
	                    msg: 'Gagal Menambah Pekerjaan'
	                });
	            }
	        });                                  
	    }
	    else
	    {
			Lobibox.notify('warning', {
				msg: 'Gagal Melakukan unggah excel, tidak ada file yang diunggah'
			});        	
	    }
    }

}
</script>