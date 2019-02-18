<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
                    <select name="es2up" id="es2up" class="form-control"><option value="">Pilih Eselon 2</option>
					<?php foreach($es2->result() as $row){?>
						<option value="<?php echo $row->id_es2;?>"><?php echo $row->nama_eselon2;?></option>
					<?php }?>
					</select>
					</div></div>
<script>
$(document).ready(function(){
$("#es2up").change(function(){
		var es2 = $("#es2up").val();
		$.ajax({
			url :"<?php echo site_url()?>/admin/cariEs3",
			type:"post",
			data:"es2="+es2,
			success:function(msg){
				$("#isies3up").html(msg);
			}
		})
	})
	
})
	</script>