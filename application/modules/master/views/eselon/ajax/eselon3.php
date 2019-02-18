<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
                    <select name="es3" id="es3" class="form-control"><option value="">Pilih Eselon 3</option>
					<?php foreach($es3->result() as $row){?>
						<option value="<?php echo $row->id_es3;?>"><?php echo $row->nama_eselon3;?></option>
					<?php }?>
					</select>
					</div></div>
<script>
$(document).ready(function(){
$("#es3").change(function(){
		var es3 = $("#es3").val();
		$.ajax({
			url :"<?php echo site_url()?>/master/Data_eselon4/cariEs4",
			type:"post",
			data:"es3="+es3,
			beforeSend:function(){
				$("#loadprosess").modal('show');				
			},						
			success:function(msg){
				$("#isies4").html(msg);
				setTimeout(function(){ 
					$("#loadprosess").modal('hide');								
				}, 2000);												
			}
		})
	})
	
})
	</script>