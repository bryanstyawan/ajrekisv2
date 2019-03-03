<div class="row col-xs-6">

    <h4>Pimpinan Tinggi Madya (Eselon I) :</h4>
    <div class="input-group">
        <span class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </span>
        <select class="form-control" name="select_eselon_1" id="select_eselon_1">
            <option value="">------Pilih Salah Satu------</option>
            <?php foreach($eselon1->result() as $row){?>
                <option value="<?php echo $row->id_es1;?>"><?php echo $row->nama_eselon1;?></option>
            <?php }?>
        </select>
    </div>

    <h4>Pimpinan Tinggi Pratama (Eselon II) :</h4>
    <div id="isi_select_eselon_2" style="height: 34px;">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
            <select class="form-control select_eselon_child_global" name="select_eselon_2" id="select_eselon_2">
                <option value="">------------NONE------------</option>
            </select>
        </div>
    </div>							

    <h4>Administrator (Eselon III) :</h4>
    <div id="isi_select_eselon_3" style="height: 34px;">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
            <select class="form-control select_eselon_child_global select_eselon_child_global_2" name="select_eselon_3" id="select_eselon_3">
                <option value="">------------NONE------------</option>
            </select>
        </div>
    </div>

    <h4>Pengawas (Eselon IV) :</h4>
    <div id="isi_select_eselon_4" style="height: 34px;">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
            <select class="form-control select_eselon_child_global select_eselon_child_global_2 select_eselon_child_global_3" name="select_eselon_4" id="select_eselon_4">
                <option value="">------------NONE------------</option>
            </select>
        </div>
    </div>							

<?php
if ($jenis_jabatan_stat == 'on') {
    # code...
?>
    <h4>Jenis Jabatan :</h4>
    <div class="input-group">
        <span class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </span>
        <select class="form-control" name="select_jenis_jabatan" id="select_jenis_jabatan">
            <option value="">------Pilih Salah Satu------</option>
            <?php foreach($jenis_posisi->result() as $row){?>
                <option value="<?php echo $row->id;?>"><?php echo $row->nama_kat_posisi;?></option>
            <?php }?>									
        </select>
    </div>
<?php
}
?>							
</div>


<script>
$(document).ready(function(){
	$("#select_eselon_1").change(function(){
		var select_eselon_1      = $(this).val();
		var select_eselon_2      = '';
		var select_eselon_3      = '';
		var select_eselon_4      = '';
        $('#select_eselon_2').find('option').remove();
        $('#select_eselon_2').append($("<option></option>").attr("value", '').text('------------NONE------------'));
        $('#select_eselon_3').find('option').remove();
        $('#select_eselon_3').append($("<option></option>").attr("value", '').text('------------NONE------------'));
        $('#select_eselon_4').find('option').remove();
        $('#select_eselon_4').append($("<option></option>").attr("value", '').text('------------NONE------------'));
		$.ajax({
			url :"<?php echo site_url()?>master/data_eselon2/dropdown_es2",
			type:"post",
			data:"select_eselon_1="+select_eselon_1,
			beforeSend:function(){
				$("#loadprosess").modal('show');
			},
			success:function(msg){
				$("#isi_select_eselon_2").html(msg);
				setTimeout(function(){
					$("#loadprosess").modal('hide');
				}, 500);				
			}
		})
	})
});
</script>