<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
                    <select name="fes2" id="fes2" class="form-control"><option value="kosong">Pilih Eselon 2</option>
					<?php foreach($fes2->result() as $row){?>
						<option value="<?php echo $row->id_es2;?>"><?php echo $row->nama_eselon2;?></option>
					<?php }?>
					</select>
					</div></div>
<script>
$(document).ready(function(){
$("#fes2").change(function(){
		var fes2 = $("#fes2").val();
		$.ajax({
			url :"<?php echo site_url()?>/master/cariEs3cari",
			type:"post",
			data:"fes2="+fes2,
			beforeSend:function(){
				$("#loadprosess").modal('show');				
			},									
			success:function(msg){
				$("#fisies3").html(msg);
				setTimeout(function(){ 
					$("#loadprosess").modal('hide');								
				}, 2000);												
			}
		})
	})
	
})
	</script>