<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
                    <select name="fes3" id="fes3" class="form-control"><option value="kosong">Pilih Eselon 3</option>
					<?php foreach($fes3->result() as $row){?>
						<option value="<?php echo $row->id_es3;?>"><?php echo $row->nama_eselon3;?></option>
					<?php }?>
					</select>
					</div></div>
<script>
$(document).ready(function(){
$("#fes3").change(function(){
		var fes3 = $("#fes3").val();
		$.ajax({
			url :"<?php echo site_url()?>/master/cariEs4cari",
			type:"post",
			data:"fes3="+fes3,
			beforeSend:function(){
				$("#loadprosess").modal('show');				
			},						
			success:function(msg){
				$("#fisies4").html(msg);
				setTimeout(function(){ 
					$("#loadprosess").modal('hide');								
				}, 2000);												
			}
		})
	})
	
})
	</script>