<?=$this->load->view('templates/common/preloader');?>
<section id="view_section">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">

				<div class="box-body">
					<div class="container-fluid">

						<?=$this->load->view('templates/filter/eselon',array('eselon1'=>$es1,'jenis_jabatan_stat'=>'off'));?>
							<div class="col-lg-6">

								<div class="col-lg-12">
									<h4>Tahun</h4>
									<div style="height: 34px;">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</span>
											<select class="form-control" name="select_tahun" id="select_tahun">
												<option value="">------------NONE------------</option>
												<?php
													$now=date('Y');
													$past=$now-5;
													for ($a=$past;$a<=$now+5;$a++)
													{
														if ($a == $now) {
															# code...
															echo "<option value='$a' selected>$a</option>";														
														}
														else
														{
															echo "<option value='$a'>$a</option>";
														}
													}
												?>											
											</select>
										</div>
									</div>								
								</div>															
							</div>
						</div>
						<div class="row col-xs-12" style="margin-top:10px;">
							<div class="box-title pull-left">	
								<a href="<?php echo site_url()?>monitoring/skp_tahunan/data/" class="btn btn-block btn-primary"><i class="fa fa-chart"></i> Rekapitulasi</a>
							</div>																							
							<div class="box-title pull-right">							
								<button class="btn btn-block btn-primary" id="btn_filter"><i class="fa fa-search"></i> FILTER DATA</button>											
							</div>											
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="content_chart">
	</div>	
</section>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css" integrity="sha256-IvM9nJf/b5l2RoebiFno92E5ONttVyaEEsdemDC6iQA=" crossorigin="anonymous" /> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" integrity="sha256-aa0xaJgmK/X74WM224KMQeNQC2xYKwlAt08oZqjeF0E=" crossorigin="anonymous" />
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js" integrity="sha256-8zyeSXm+yTvzUN1VgAOinFgaVFEFTyYzWShOy9w7WoQ=" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" integrity="sha256-TQq84xX6vkwR0Qs1qH5ADkP+MvH0W+9E7TdHJsoIQiM=" crossorigin="anonymous"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js" integrity="sha256-nZaxPHA2uAaquixjSDX19TmIlbRNCOrf5HO1oHl5p70=" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

<script>	
$(document).ready(function(){
	$('#btn_filter').click(function() {
		var select_eselon_1      = $("#select_eselon_1").val();
		var select_eselon_2      = $("#select_eselon_2").val();
		var select_eselon_3      = $("#select_eselon_3").val();
		var select_eselon_4      = $("#select_eselon_4").val();
		var select_tahun         = $("#select_tahun").val();				

		if (select_tahun.length <= 0) {
			Lobibox.notify('warning', {
				title: 'Perhatian',
				msg: 'Proses dihentikan, mohon pilih tahun'
			});                        			
		}
		else
		{
			var data_link = {
							'data_1': select_eselon_1,
							'data_2': select_eselon_2,
							'data_3': select_eselon_3,
							'data_4': select_eselon_4,
							'data_5': select_tahun,
							'data_6': 'all'
			}
			$.ajax({
				url :"<?php echo site_url()?>monitoring/skp_tahunan/filter_skp_tahunan_grafik",
				type:"post",
				data: { data_sender : data_link},
				beforeSend:function(){
					$("#loadprosess").modal('show');
					$("#content_chart").html('');
				},			
				success:function(msg){
					var obj = jQuery.parseJSON (msg);	
					console.log(obj)				
					for (let index = 0; index < obj.length; index++) {
						$("#content_chart").append("<div class='col-xs-4' style='height: 530px;'>"+
														"<div class='box'>"+
															"<div class='box-header'>"+
																"<h4 style='color: #000;font-weight: 400;font-size: 19px;'>"+obj[index].nama_eselon1+"</h4>"+
															"</div>"+
															"<canvas id='chartdiv_"+obj[index].id_es1+"' width='400' height='400'></canvas>"+															
														"</div>"+
													"</div>");						
						var ctx = document.getElementById('chartdiv_'+obj[index].id_es1+'').getContext('2d');
						var myChart = new Chart(ctx, {
												type: 'doughnut',
												data: {
													labels: ['Sangat Baik', 'Baik', 'Cukup', 'Kurang', 'Buruk'],													
													datasets: [{
														label: '# of Votes',
														data: [obj[index].sangat_baik, obj[index].baik, obj[index].cukup, obj[index].kurang, obj[index].buruk],
														backgroundColor: [
															'rgba(26, 82, 118)',
															'rgba(88, 214, 141)',
															'rgba(245, 176, 65)',
															'rgba(241, 148, 138)',
															'rgba(148, 49, 38)'
														],
														borderColor: [
															'rgba(255, 99, 132, 1)',
															'rgba(54, 162, 235, 1)',
															'rgba(255, 206, 86, 1)',
															'rgba(75, 192, 192, 1)',
															'rgba(153, 102, 255, 1)'
														],
														borderWidth: 1
													}]
												},
												options: {
													scales: {
														yAxes: [{
															ticks: {
																beginAtZero: true
															}
														}]
													},
													datalabels: {
																formatter: (value, ctx) => {
																	let sum = 0;
																	let dataArr = ctx.chart.data.datasets[0].data;
																	dataArr.map(data => {
																		sum += data;
																	});
																	let percentage = (value*100 / sum).toFixed(2)+"%";
																	return percentage;
																},
																color: '#fff',
													}													
												}
											});						


					}

					setTimeout(function(){
						$("#loadprosess").modal('hide');
					}, 500);
				},
				error:function(jqXHR,exception)
				{
					ajax_catch(jqXHR,exception);					
				}
			})
		}		
	})

	$("#closeData").click(function(){
		$("#form_section").css({"display": "none"})
		$("#view_section").css({"display": ""})		
	})		
})
</script>