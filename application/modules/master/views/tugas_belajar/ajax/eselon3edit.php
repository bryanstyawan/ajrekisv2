<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
                    <select name="nes3" id="nes3" class="form-control"><option value="">Pilih Eselon 3</option>
					<?php foreach($nes3->result() as $row){?>
						<option value="<?php echo $row->id_es3;?>"><?php echo $row->nama_eselon3;?></option>
					<?php }?>
					</select>
					</div></div>
<script>
$(document).ready(function(){
$("#nes3").change(function(){
		var nes3 = $("#nes3").val();
		$.ajax({
			url :"<?php echo site_url()?>/master/cariEs4edit",
			type:"post",
			data:"nes3="+nes3,
			beforeSend:function(){
				$("#loadprosess").modal('show');				
			},						
			success:function(msg){
				$("#nisies4").html(msg);
				setTimeout(function(){ 
					$("#loadprosess").modal('hide');								
				}, 2000);												
			}
		})
	})
	
})
	</script>