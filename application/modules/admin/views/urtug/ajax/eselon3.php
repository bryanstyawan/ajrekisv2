<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
                    <select name="es3up" id="es3up" class="form-control"><option value="">Pilih Eselon 3</option>
					<?php foreach($es3->result() as $row){?>
						<option value="<?php echo $row->id_es3;?>"><?php echo $row->nama_eselon3;?></option>
					<?php }?>
					</select>
					</div></div>
<script>
$(document).ready(function(){
$("#es3up").change(function(){
		var es3 = $("#es3up").val();
		$.ajax({
			url :"<?php echo site_url()?>/admin/cariEs4",
			type:"post",
			data:"es3="+es3,
			success:function(msg){
				$("#isies4up").html(msg);
			}
		})
	})
	
})
	</script>