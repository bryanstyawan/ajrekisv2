<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
                    <select name="es2" id="es2" class="form-control"><option value="">Pilih Eselon 2</option>
					<?php foreach($es2->result() as $row){?>
						<option value="<?php echo $row->id_es2;?>"><?php echo $row->nama_eselon2;?></option>
					<?php }?>
					</select>
					</div></div>
<script>
$(document).ready(function(){
$("#es2").change(function(){
		var es2 = $("#es2").val();
		$.ajax({
			url :"<?php echo site_url()?>/master/Data_eselon3/cariEs3",
			type:"post",
			data:"es2="+es2,
			beforeSend:function(){
				$("#loadprosess").modal('show');				
			},						
			success:function(msg){
				$("#isies3").html(msg);
				setTimeout(function(){ 
					$("#loadprosess").modal('hide');								
				}, 2000);								
			}
		})
	})
	
})
	</script>