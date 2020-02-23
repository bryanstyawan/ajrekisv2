<?=$this->load->view('templates/common/preloader');?>
<section id="view_section">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">

				<div class="box-body">
					<div class="container-fluid">
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
						<div class="col-xs-12" style="margin-top:10px;">
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" integrity="sha256-aa0xaJgmK/X74WM224KMQeNQC2xYKwlAt08oZqjeF0E=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" integrity="sha256-TQq84xX6vkwR0Qs1qH5ADkP+MvH0W+9E7TdHJsoIQiM=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

<script>	
function filter(data_link) {
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
			// console.log(obj)				
			for (let index = 0; index < obj.length; index++) 
			{
				$("#content_chart").append("<div class='col-xs-4' style='height: 740px;'>"+
												"<div class='box'>"+
													"<div class='box-header'>"+
														"<a href='#' onclick='getComponent("+obj[index].id_es1+","+obj[index].id_es2+","+obj[index].id_es3+","+obj[index].id_es4+","+obj[index].tahun+","+obj[index].arg+")'>"+
															"<h4 style='color: #000;font-weight: 400;font-size: 19px;'>"+obj[index].nama_eselon+"</h4>"+																
														"</a>"+
													"</div>"+
													"<canvas id='chartdiv_"+obj[index].id_chart+"' width='400' height='400'></canvas>"+
													"<div class='row container'>"+
														"<div class='col-lg-12'>"+
															"<label style='color: #000;font-weight: 400;font-size: 19px;'>Jumlah Nilai Sangat Baik : "+obj[index].sangat_baik+"</label>"+
														"</div>"+
														"<div class='col-lg-12'>"+
															"<label style='color: #000;font-weight: 400;font-size: 19px;'>Jumlah Nilai Baik : "+obj[index].baik+"</label>"+
														"</div>"+
														"<div class='col-lg-12'>"+
															"<label style='color: #000;font-weight: 400;font-size: 19px;'>Jumlah Nilai Cukup : "+obj[index].cukup+"</label>"+
														"</div>"+
														"<div class='col-lg-12'>"+
															"<label style='color: #000;font-weight: 400;font-size: 19px;'>Jumlah Nilai Kurang : "+obj[index].kurang+"</label>"+
														"</div>"+
														"<div class='col-lg-12'>"+
															"<label style='color: #000;font-weight: 400;font-size: 19px;'>Jumlah Nilai Buruk : "+obj[index].buruk+"</label>"+
														"</div>"+
														"<div class='col-lg-12'>"+
															"<label style='color: #000;font-weight: 400;font-size: 19px;'>Jumlah Nilai Tidak diketahui : "+obj[index].tidak_diketahui+"</label>"+
														"</div>"+																																																																																
													"</div>"+																																									
												"</div>"+
											"</div>");						
				var ctx = document.getElementById('chartdiv_'+obj[index].id_chart+'').getContext('2d');
				var myChart = new Chart(ctx, {
										type: 'doughnut',
										data: {
											labels: ['Sangat Baik', 'Baik', 'Cukup', 'Kurang', 'Buruk','Tidak diketahui'],													
											datasets: [{
												label: '# of Votes',
												data: [obj[index].sangat_baik, obj[index].baik, obj[index].cukup, obj[index].kurang, obj[index].buruk, obj[index].tidak_diketahui],
												backgroundColor: [
													'rgba(26, 82, 118)',
													'rgba(88, 214, 141)',
													'rgba(245, 176, 65)',
													'rgba(241, 148, 138)',
													'rgba(148, 49, 38)',
													'rgba(128, 128, 128)'															
												],
												borderColor: [
													'rgba(255, 99, 132, 1)',
													'rgba(54, 162, 235, 1)',
													'rgba(255, 206, 86, 1)',
													'rgba(75, 192, 192, 1)',
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
											tooltips: {
												callbacks: {
													label: function (tooltipItem, data) {
														try {
															let label = ' ' + data.labels[tooltipItem.index] || '';

															if (label) {
																label += ': ';
															}

															const sum = data.datasets[0].data.reduce((accumulator, curValue) => {
																return accumulator + curValue;
															});
															const value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];

															label += Number((value / sum) * 100).toFixed(2) + '%';
															return label;
														} catch (error) {
															console.log(error);
														}
													}
												}
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

function getComponent(es1,es2,es3,es4,tahun,arg) {
	var data_link = {
							'data_1': (es1 == 0) ? '' : es1 ,
							'data_2': (es2 == 0) ? '' : es2,
							'data_3': (es3 == 0) ? '' : es3,
							'data_4': (es4 == 0) ? '' : es4,
							'data_5': tahun,
							'data_6': arg
			}
	filter(data_link)

}

$(document).ready(function(){
	$('#btn_filter').click(function() {
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
							'data_1': '',
							'data_2': '',
							'data_3': '',
							'data_4': '',
							'data_5': select_tahun,
							'data_6': 'all'
			}
			filter(data_link)
		}		
	})	
})
</script>