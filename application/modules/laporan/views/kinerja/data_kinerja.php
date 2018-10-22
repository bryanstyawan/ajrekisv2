<style>
   #preloader {
    position:fixed;
    top:0;
    left:0;
    right:0;
    bottom:0;
    background-color:#ffffff; /* change if the mask should have another color then white */
    z-index:99; /* makes sure it stays on top */
   }

   #status {
    width:200px;
    height:200px;
    position:absolute;
    left:50%; /* centers the loading animation horizontally one the screen */
    top:50%; /* centers the loading animation vertically one the screen */
    background-image:url(https://loading.io/spinners/liquid/lg.liquid-fill-preloader.gif); /* path to your loading animation */
    background-repeat:no-repeat;
    background-position:center;
    margin:-100px 0 0 -100px; /* is width and height divided by two */
   }

   #text_loader {
   	color: #FF727D;
    width:600px;
    height:200px;
    position:absolute;
    left:37%; /* centers the loading animation horizontally one the screen */
    top:85%; /* centers the loading animation vertically one the screen */
    background-repeat:no-repeat;
    background-position:center;
    margin:-100px 0 0 -100px; /* is width and height divided by two */
   }   
</style>

<div id ="preloader">
	<div id="status"></div>
	<h1 id="text_loader">Mohon Tunggu, sedang memuat data</h1>
</div>
<script type="text/javascript">
$(window).load(function() { // makes sure the whole site is loaded
	$("#status").fadeOut(); // will first fade out the loading animation
	$("#text_loader").fadeOut(); // will first fade out the loading animation	
	$("#preloader").delay(350).fadeOut("fast"); // will fade out the white DIV that covers the website.
})

</script>
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
						<th>NIP</th>
						<th>Nama</th>
<!-- 						<th>Eselon I</th>
						<th>Eselon II</th>
						<th>Eselon III</th>
						<th>Eselon IV</th> -->
						<th>Jabatan</th>
						<th>Atasan Langsung</th>
						<th>Belum Diperiksa</th>
						<th>Revisi</th>
						<th>Ditolak</th>
						<th>Disetujui</th>
						<th>Menit Efektif</th>
						<th>Persentase</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody id="table_content">
					<?php
						if ($list != 0) {
							# code...
							for ($i=0; $i < count($list); $i++) { 
								# code...
								$id             = $list[$i]->id;
								$data_link_a    = "";
								$data_link_text = "";
					?>
							<tr>
								<td><?=$i+1;?></td>
								<td><?=$list[$i]->nip;?></td>
								<td><?=$list[$i]->nama_pegawai;?></td>
<!-- 								<td><?=$list[$i]->nama_eselon1;?></td>
								<td><?=$list[$i]->nama_eselon2;?></td>
								<td><?=$list[$i]->nama_eselon3;?></td>
								<td><?=$list[$i]->nama_eselon4	;?></td> -->
								<td><?=$list[$i]->nama_posisi;?></td>
								<td><?=$list[$i]->nama_atasan;?></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
					<?php
							}
						}
					?>
				</tbody>				  	
			  	</table>
	  		</div>					
    	</div><!-- /.box-body -->
  	</div><!-- /.box -->
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


$(document).ready(function(){
    $("#tgl_lahir").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});	
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
			url :"<?php echo site_url()?>master/data_eselon2/cariEs2_filter/filter_data_pegawai_rekap_kinerja/laporan",
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
					url :"<?php echo site_url()?>laporan/filter_data_pegawai_rekap_kinerja",
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
			url :"<?php echo site_url()?>master/data_eselon3/cariEs3_filter/filter_data_pegawai_rekap_kinerja/laporan",
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
					url :"<?php echo site_url()?>laporan/filter_data_pegawai_rekap_kinerja",
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
</script>