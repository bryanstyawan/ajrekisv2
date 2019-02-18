<style type="text/css">
.scrolls {
    overflow-x: scroll;
    overflow-y: hidden;
    height: 80px;
    white-space:nowrap
}
.imageDiv img {
    box-shadow: 1px 1px 10px #999;
    margin: 2px;
    max-height: 50px;
    cursor: pointer;
    display:inline-block;
    *display:inline;/* For IE7*/
    *zoom:1;/* For IE7*/
    vertical-align:top;
 }	

.wrapper1, .wrapper2 {
  width: 1025px;
  overflow-x: scroll;
  overflow-y:hidden;
}

.wrapper1 {height: initial; }
.wrapper2 {height: initial; }

.div2 {
  width:1000px;
  height: 200px;
  background-color: #88FF88;
  overflow: auto;
}

</style>
<div class="col-xs-12">
	<div class="box" style="width: 1056px;left: 15px;">
		<div class="box-header">
			<h3 class="box-title">Filter Data</h3>
			<div class="box-tools">
			</div>
		</div><!-- /.box-header -->
		<div class="box-body" id="isi">
			<div class="container-fluid">
				<div class="row col-xs-6">
		            <h4>Pimpinan Tinggi Madya (Eselon I)</h4>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-calendar"></i>
		                </span>		
		                <select class="form-control" name="select_eselon_1" id="select_eselon_1">
		                	<option value="">------Pilih Salah Satu------</option>		                
							<?php
								if($eselon != 0){
//									print_r($eselon['data_eselon1'][0]->nama_eselon1);die();
									for ($i=0; $i < count($eselon['data_eselon1']); $i++) { 
										# code...
							?>
										<option value="<?=$eselon['data_eselon1'][$i]->id_es1;?>"><?=$eselon['data_eselon1'][$i]->nama_eselon1;?></option>					
							<?php
									}
								}
							?>                
		                </select>                								
		            </div>
					<progress class="progress progress-striped progress-animated" id="prg_progress_bar_es1" style="width: 473px;margin-bottom: 0px;visibility: hidden;" value="0" max="100">
						25%
					</progress>		            		            

		            <h4>Administrator (Eselon III)</h4>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-calendar"></i>
		                </span>		
		                <select class="form-control select_eselon_child_global select_eselon_child_global_2" name="select_eselon_3" id="select_eselon_3">
		                	<option value="">------Pilih Salah Satu------</option>		                
<!--
							<?php
								if($eselon != 0){
//									print_r($eselon['data_eselon3'][0]);die();
									for ($i=0; $i < count($eselon['data_eselon1']); $i++) { 
										# code...
							?>
										<option value="<?=$eselon['data_eselon3'][$i]->id_es3;?>"><?=$eselon['data_eselon3'][$i]->nama_eselon3;?></option>					
							<?php
									}
								}
							?>                		                
-->

		                </select>                								
		            </div>		            
					<progress class="progress progress-striped progress-animated" id="prg_progress_bar_es3" style="width: 473px;margin-bottom: 0px;visibility: hidden;" value="0" max="100">
						25%
					</progress>		            		            		            

		            <h4>Bulan</h4>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-calendar"></i>
		                </span>		
		                <select class="form-control" name="select_bulan" id="select_bulan">
		                	<option value="">------Pilih Salah Satu------</option>		                
							<?php
								if (isset($bulan_list)) {
									# code...
//									print_r($bulan_list[1]['nama']);die();
									for ($i=1; $i <= count($bulan_list); $i++) { 
										# code...
										$counter = "";
										if ($i < 10) {
											# code...
											$counter = "0".$i;
										}
										else
										{
											$counter = $i;
										}										
							?>
										<option value="<?=$counter;?>"><?=$bulan_list[$i]['nama'];?></option>												
							<?php
									}
								}
						  	?>                
		                </select>                								
		            </div>
				</div>

				<div class="row col-xs-6 pull-right">

		            <h4>Pimpinan Tinggi Pratama (Eselon II)</h4>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-calendar"></i>
		                </span>		
		                <select class="form-control select_eselon_child_global" name="select_eselon_2" id="select_eselon_2">
		                	<option value="">------Pilih Salah Satu------</option>		                
<!--
							<?php
								if($eselon != 0){
//									print_r($eselon['data_eselon3'][0]);die();
									for ($i=0; $i < count($eselon['data_eselon2']); $i++) { 
										# code...
							?>
										<option value="<?=$eselon['data_eselon2'][$i]->id_es2;?>"><?=$eselon['data_eselon2'][$i]->nama_eselon2;?></option>					
							<?php
									}
								}
							?>                		                
-->	
		                </select>                								
		            </div>
					<progress class="progress progress-striped progress-animated" id="prg_progress_bar_es2" style="width: 473px;margin-bottom: 0px;visibility: hidden;" value="0" max="100">
						25%
					</progress>		            

		            <h4>Pengawas (Eselon IV)</h4>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-calendar"></i>
		                </span>		
		                <select class="form-control select_eselon_child_global select_eselon_child_global_2 select_eselon_child_global_3" name="select_eselon_4" id="select_eselon_4">
		                	<option value="">------Pilih Salah Satu------</option>		                
<!--
							<?php
								if($eselon != 0){
//									print_r($eselon['data_eselon3'][0]);die();
									for ($i=0; $i < count($eselon['data_eselon4']); $i++) { 
										# code...
							?>
										<option value="<?=$eselon['data_eselon4'][$i]->id_es4;?>"><?=$eselon['data_eselon4'][$i]->nama_eselon4;?></option>					
							<?php
									}
								}
							?>                		                
-->	

		                </select>                								
		            </div>		            
					<progress class="progress progress-striped progress-animated" id="prg_progress_bar_es4" style="width: 473px;margin-bottom: 0px;visibility: hidden;" value="0" max="100">
						25%
					</progress>		            		            		            

		            <h4>Tahun</h4>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-calendar"></i>
		                </span>		
		                <select class="form-control" name="select_tahun" id="select_tahun">
		                	<option value="">------Pilih Salah Satu------</option>		                
							<?php
									$j = 2005;
									for ($i=0; $i <= 120; $i++) { 
										# code...
							?>
										<option value="<?=$j;?>"><?=$j;?></option>												
							<?php
										$j++;
									}
						  	?>                                
		                </select>                								
		            </div>
				</div>				

		</div><!-- /.box-body -->
	</div><!-- /.box -->
    <div class="box-footer">
		<div class="container-fluid">
			<div class="row col-lg-12 col-md-12 ">
	        	<button type="submit" id="btn_export_excel" class="btn btn-primary pull-left col-lg-3" style="background-color: #1D9E74;">
	        		<i class="fa fa-file-excel-o pull-left fa-3x" style=""></i>
	        		<label style="padding-top: 10px;font-size: 18px;">Export Data Excel</label>
        		</button>				
	        	<button type="submit" id="btn_preview" class="btn btn-primary pull-right">Preview</button>
			</div>
		</div>
   </div>		
</div>
	<progress class="progress progress-striped progress-animated" id="prg_progress_bar" style="width: 1085px;display: none;" value="0" max="100">
		25%
	</progress>
<div class="col-xs-12">
	<div class="box">
		<div class="box-body wrapper1" id="isi">
			<table id="example1" class="table table-bordered table-striped scrolls display div1" style="overflow: auto;">
				<thead>
					<tr>
						<th>No.</th>
						<th>Nama</th>
						<th>NIP</th>
						<th>Jabatan</th>
						<th>Kelas Jabatan</th>					  
						<th>50 % Nilai per Grade</th>
						<th>Menit Kerja Efektif (Bulan)</th>
						<th>Realisasi Menit Kerja Efektif</th>
						<th>Jumlah Yang Diterima</th>
					</tr>
				</thead>
				<tbody>
					<?php
						if($list != 0){
							$i = "";
							foreach($list as $list){
								$i++;
					?>
							  <tr>
								<td><?=$i;?></td>						  	
								<td><?=$list->nama_pegawai;?></td>						  									
								<td><?=$list->nip;?></td>						  																	
								<td><?=$list->nama_posisi;?></td>						  																									
								<td><?=$list->posisi_class;?></td>						  																																	
								<td>-</td>						  																																	
								<td><?=number_format($list->jam_kerja);?></td>
								<td><?=number_format(6600);?></td>
								<td>Rp. <?=number_format($list->tunjangan);?></td>																
							  </tr>
				  <?php
							}
						}
				  ?>
				</tbody>
			</table>

		</div><!-- /.box-body -->
	</div><!-- /.box -->
</div>

<!-- DataTables -->

	<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>

	function progress_bar_select(al, flag) {
		var bar   = document.getElementById('prg_progress_bar_es'+flag);
		$("#prg_progress_bar_es"+flag).css("visibility",'');

		bar.value = al;
		al        = al + 2;						
		var sim   = setTimeout("progress_bar_select("+al+","+flag+")",20);
		if(al == 101){
			status.innerHTML       = "100%";
			bar.value              = 100;
			clearTimeout(sim);
			$("#prg_progress_bar_es"+flag).css("visibility",'hidden');							
		}		
	}	


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

	    $('#select_eselon_1').on('change', function() {
	    	if (this.value != "") 
	    	{
		        $('#select_eselon_2')
		            .find('option')
		            .remove();    

		        $('#select_eselon_2')
					.append($("<option></option>")
					.attr("value", '')
					.text('------Pilih Salah Satu------')); 	  

				progress_bar_select(1,2);
				var type_eselon = 2;
			    var request = $.ajax({
					url :"<?php echo site_url()?>/laporan/get_data_eselon_by",		    	
			        method: "POST",
			        data: { data_sender:this.value, type:type_eselon},
			        dataType: "json"
			    });            

			    request.done(function( msg ) {				
	                $.each(msg, function(key, value) {   
	                     $('#select_eselon_2')
	                         .append($("<option></option>")
	                         .attr("value", msg[key].id_es2)
	                         .text(msg[key].nama_eselon2)); 
	                });                            		    	
			    });	    		
	    	}
	    	else
	    	{
				progress_bar_select(1,2);	    		
				progress_bar_select(1,3);
				progress_bar_select(1,4);								

		        $('.select_eselon_child_global')
		            .find('option')
		            .remove();    

		        $('.select_eselon_child_global')
					.append($("<option></option>")
					.attr("value", '')
					.text('------Pilih Salah Satu------')); 	  				
	    	}
	    });

	    $('#select_eselon_2').on('change', function() {
	    	if (this.value != "") 
	    	{
		        $('#select_eselon_3')
		            .find('option')
		            .remove();    

		        $('#select_eselon_3')
					.append($("<option></option>")
					.attr("value", '')
					.text('------Pilih Salah Satu------')); 	  

				progress_bar_select(1,3);
				var type_eselon = 3;
				var request     = $.ajax({
					url :"<?php echo site_url()?>/laporan/get_data_eselon_by",		    	
			        method: "POST",
			        data: { data_sender:this.value, type:type_eselon},
			        dataType: "json"
			    });            
			    
			    request.done(function( msg ) {				
	                $.each(msg, function(key, value) {   
	                     $('#select_eselon_3')
	                         .append($("<option></option>")
	                         .attr("value", msg[key].id_es3)
	                         .text(msg[key].nama_eselon3)); 
	                });                            		    	
			    });

	    	}
	    	else
	    	{
				progress_bar_select(1,3);
				progress_bar_select(1,4);								

		        $('.select_eselon_child_global_2')
		            .find('option')
		            .remove();    

		        $('.select_eselon_child_global_2')
					.append($("<option></option>")
					.attr("value", '')
					.text('------Pilih Salah Satu------')); 	  					    		
	    	}

	    });	  

	    $('#select_eselon_3').on('change', function() {
	    	if (this.value != 0) 
	    	{
		        $('#select_eselon_4')
		            .find('option')
		            .remove();    

		        $('#select_eselon_4')
					.append($("<option></option>")
					.attr("value", '')
					.text('------Pilih Salah Satu------')); 	  

				progress_bar_select(1,4);
				var type_eselon = 4;
				var request     = $.ajax({
					url :"<?php echo site_url()?>/laporan/get_data_eselon_by",		    	
			        method: "POST",
			        data: { data_sender:this.value, type:type_eselon},
			        dataType: "json"
			    });            
			    
			    request.done(function( msg ) {				
	                $.each(msg, function(key, value) {   
	                     $('#select_eselon_4')
	                         .append($("<option></option>")
	                         .attr("value", msg[key].id_es4)
	                         .text(msg[key].nama_eselon4)); 
	                });                            		    	
			    });

	    	}
	    	else
	    	{
				progress_bar_select(1,4);								

		        $('.select_eselon_child_global_3')
		            .find('option')
		            .remove();    

		        $('.select_eselon_child_global_3')
					.append($("<option></option>")
					.attr("value", '')
					.text('------Pilih Salah Satu------')); 	  					    			    		
			}
	    });	  	      

	    $('#btn_export_excel').on('click', function(){
			var txt_bulan       = $('#select_bulan').val();
			var txt_tahun       = $('#select_tahun').val();
			var select_eselon_1 = $('#select_eselon_1').val();			
			var select_eselon_2 = $('#select_eselon_2').val();						
			var select_eselon_3 = $('#select_eselon_3').val();									
			var select_eselon_4 = $('#select_eselon_4').val();												

			if (txt_bulan == "") txt_bulan = "-";
			if (txt_tahun == "") txt_tahun = "-";			
			if (select_eselon_1 == "") select_eselon_1 = "-";						
			if (select_eselon_2 == "") select_eselon_2 = "-";									
			if (select_eselon_3 == "") select_eselon_3 = "-";						
			if (select_eselon_4 == "") select_eselon_4 = "-";												


			if (
					txt_bulan       == "-" &&
					txt_tahun       == "-" &&
					select_eselon_1 == "-" &&
					select_eselon_2 == "-" &&
					select_eselon_3 == "-" &&
					select_eselon_4 == "-"
				) 
			{

				var result   = confirm("Tidak ada filter yang dipilih, apakah ingin melanjutkan export data ? kemungkinan data yang akan diexport melebihi 1000 data sehingga membutuhkan waktu.");			

				if (result) 
				{
					link = "<?php echo site_url()?>/laporan/export_data_tunjangan/" + txt_bulan + "/" + txt_tahun + "/" + select_eselon_1 + "/" + select_eselon_2 + "/" + select_eselon_3 + "/" + select_eselon_4;
		            window.open(link);

				}				
			}
			else
			{
				link = "<?php echo site_url()?>/laporan/export_data_tunjangan/" + txt_bulan + "/" + txt_tahun + "/" + select_eselon_1 + "/" + select_eselon_2 + "/" + select_eselon_3 + "/" + select_eselon_4;
	            window.open(link);
				
			}


	    });		    	   	 			

        $('#btn_preview').on('click', function(){    
			var txt_bulan       = $('#select_bulan').val();
			var txt_tahun       = $('#select_tahun').val();
			var select_eselon_1 = $('#select_eselon_1').val();			
			var select_eselon_2 = $('#select_eselon_2').val();						
			var select_eselon_3 = $('#select_eselon_3').val();									
			var select_eselon_4 = $('#select_eselon_4').val();												

			if (txt_bulan == "") txt_bulan = "-";
			if (txt_tahun == "") txt_tahun = "-";			
			if (select_eselon_1 == "") select_eselon_1 = "-";						
			if (select_eselon_2 == "") select_eselon_2 = "-";									
			if (select_eselon_3 == "") select_eselon_3 = "-";						
			if (select_eselon_4 == "") select_eselon_4 = "-";												

        	var data_sender = {
        							'bulan'   : txt_bulan,
        							'tahun'   : txt_tahun,
        							'eselon1' : select_eselon_1,
        							'eselon2' : select_eselon_2,
        							'eselon3' : select_eselon_3,
        							'eselon4' : select_eselon_4

        	};



        	if (txt_bulan != "" && txt_tahun != "") 
    		{
			    var request = $.ajax({
					url :"<?php echo site_url()?>/laporan/preview_data_report",		    	
			        method: "POST",
			        data: { data_sender:data_sender},
			        dataType: "json"
			    });            

				$("#example1 tbody tr").remove();
				progress_bar(0);
			    request.done(function( msg ) {
			    	if (msg != 0) 
		    		{
						$("#example1 tbody tr").remove();
						var newrec  = '<tr id="row_'+i+'">' +
				        					'<td colspan="11" class="text-center">Data Sample</td>'
			        				   '</tr>';
//				        $('#example1 tbody').append(newrec);							        				   					 			    			
		    			for (var i = 0; i < msg.length; i++) {
			    			counter = i + 1;

							var newrec  = '<tr id="row_'+i+'">' +
					        					'<td>'+counter+'</td>' +
					        					'<td>'+msg[i].nama_pegawai+'</td>' +
					        					'<td>'+msg[i].nip+'</td>' +
					        					'<td>'+msg[i].nama_posisi+'</td>' +
					        					'<td>'+msg[i].posisi_class+'</td>' +
					        					'<td>-</td>' +
					        					'<td>'+msg[i].jam_kerja+'</td>' +			        									        									        									        									        									        					
					        					'<td>6600</td>' +
					        					'<td>'+msg[i].tunjangan+'</td>' +		 		        									        									        									        									        									        									        					
				        				   '</tr>';
					        $('#example1 tbody').append(newrec);							        				   
		    			}
		    		}
		    		else
		    		{
		    			alert("Data tidak ditemukan.");
						var newrec  = '<tr id="row_'+i+'">' +
				        					'<td colspan="11" class="text-center">Tidak ada data didalam table ini</td>'

			        				   '</tr>';
				        $('#example1 tbody').append(newrec);		    			
		    		}
			    });	
    		}
    		else
    		{
    			alert("Data bulan dan tahun harap diisi.");
    		}
        });
	})				
</script>