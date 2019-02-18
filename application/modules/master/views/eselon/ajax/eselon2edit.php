<div class="form-group">
	<div class="input-group">
		<span class="input-group-addon"><i class="fa fa-star"></i></span>
		<select name="nes2" id="nes2" class="form-control"><option value="">Pilih Eselon 2</option>
		<?php foreach($nes2->result() as $row){?>
		<option value="<?php echo $row->id_es2;?>"><?php echo $row->nama_eselon2;?></option>
		<?php }?>
		</select>
	</div>
</div>
<script>
$(document).ready(function(){
$("#nes2").change(function(){
		var es2 = $("#nes2").val();
		$.ajax({
			url :"<?php echo site_url()?>/master/cariEs3edit",
			type:"post",
			data:"nes2="+es2,
			beforeSend:function(){
				$("#loadprosess").modal('show');				
			},									
			success:function(msg){
				$("#nisies3").html(msg);
				setTimeout(function(){ 
					$("#loadprosess").modal('hide');								
				}, 2000);												
			}
		})
	})
	
})
	</script>