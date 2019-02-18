<div class="form-horizontal">
	<form id="form_password" name="form_password">
		<div class="col-md-12">
	      	<div class="box box-primary" style="padding:10px;">
				<div class="form-group">
					<label for="gender" class="col-md-2 control-label"></label>
					<div class="col-md-9">
						<div class="row">
						<a class="btn btn-app pull-right" id="btn_save"><i class="fa fa-save"></i> Simpan</a>
					</div>
				</div>

				<div class="form-group">
					<label for="es1" class="col-md-2 control-label">Password Lama</label>
					<div class="col-md-9">
						<input type="password" class="form-control" id="pass_lama" name="pass_lama">					
					</div>
				</div>
				<div class="form-group">
					<label for="es2" class="col-md-2 control-label">Password Baru</label>
					<div class="col-md-9">
						<input type="password" class="form-control" id="pass_baru" name="pass_baru">
					</div>
				</div>
				<div class="form-group">
					<label for="es2" class="col-md-2 control-label">Ulangi Password Baru</label>
					<div class="col-md-9">
						<input type="password" class="form-control" id="re_pass_baru" name="re_pass_baru">
					</div>
				</div>				
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
$(document).ready(function()
{
	$("#btn_save").click(function(){
		var pass_lama    = $('#pass_lama').val();
		var pass_baru    = $('#pass_baru').val();		
		var re_pass_baru = $('#re_pass_baru ').val();


		if (pass_lama.length <= 0 || pass_baru.length <= 0 || re_pass_baru.length <= 0) 
		{
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Harap lengkapi data-data dibawah ini."
            });
		}
		else
		{
			if (pass_baru == re_pass_baru ) 
			{
				$.ajax({
					url :"<?php echo site_url()?>/admin/do_change_password",
					type:"post",
					data:$("#form_password").serialize(),
					beforeSend:function(){
						$("#loadprosess").modal('show');								
					},			
					success:function(msg)
					{
		                var obj = jQuery.parseJSON (msg);             
		                if (obj.status == 1) 
		                {
		                    Lobibox.notify('success', {
		                        msg: obj.text
		                        });
		                    setTimeout(function(){ 
		                        $("#loadprosess").modal('hide');
		                        setTimeout(function(){
									window.location.href = "<?php echo site_url()?>/admin/loginadmin/signout";
		                        }, 1500);                                                                   
		                    }, 5000);                
		                }
		                else
		                {
		                    Lobibox.notify('warning', {
		                        msg: obj.text
		                        });
		                    setTimeout(function(){ 
		                        $("#loadprosess").modal('hide');                                
		                    }, 5000);                                                                           
		                }           					
					},
					error:function(){
						Lobibox.notify('error', {
							msg: 'Terjadi kesalahan, Gagal melakukan perintah.'
						});
					}			
				})
			}	
			else
			{
	            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
	            {
	                msg: "Password baru dan konfirmasi password tidak sama."
	            });				

			}			
		}
	});	
});	
</script>