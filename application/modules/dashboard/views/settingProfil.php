<form name="editProfil" id="editProfil">
<div class="form-group">	
	<label for="inputName" class="col-sm-3 control-label">Nama</label>
	<div class="col-sm-9">
	<input type="text" class="form-control" id="fnama">
	</div>
</div>
<div class="form-group">	
	<label for="inputLahir" class="col-sm-3 control-label">Tanggal Lahir</label>
	<div class="col-sm-9">
	<input type="text" class="form-control" id="ftgl_lahir">
	</div>
</div>
<div class="form-group">	
	<label for="inputLahir" class="col-sm-3 control-label">alamat</label>
	<div class="col-sm-9">
	<textarea class="form-control" id="falamat"></textarea>
	</div>
</div>
<div class="form-group">
	<label for="gender" class="col-sm-3 control-label">Jenis Kelamin</label>
                    <div class="col-sm-9">
                      <input type="radio" name="fgender" id="fgender" value="L" class="flat-red" <?php if ($pegawai->gender == "L"){echo "checked";};?>>Laki-laki &nbsp;&nbsp;&nbsp;
                      <input type="radio" name="fgender" id="fgender" value="P" class="flat-red" <?php if ($pegawai->gender == "P"){echo "checked";};?>>
                      Perempuan
                    </div>
					</div>
<div class="form-group">	
	<label for="inputLahir" class="col-sm-3 control-label">Agama</label>
	<div class="col-sm-9">
	<select name="fagama" id="fagama" class="form-control">
		<?php foreach($agama->result() as $row){?>
			<option value="<?php echo $row->id;?>"><?php echo $row->nama_agama;?></option>
		<?php }?>
	</select>
	</div>
</div>
<div class="form-group">	
	<label for="inputLahir" class="col-sm-3 control-label">Status Pernikahan</label>
	<div class="col-sm-9">
	<select name="fstatus_nikah" id="fstatus_nikah" class="form-control">
		<?php foreach($status_nikah->result() as $row){?>
			<option value="<?php echo $row->id;?>"><?php echo $row->nama_status_nikah;?></option>
		<?php }?>
	</select>
	</div>
</div>
<fieldset>
<legend>Ganti Password</legend>
<div class="form-group">	
	<label for="password" class="col-sm-3 control-label">Password Baru</label>
	<div class="col-sm-9">
	<input type="password" class="form-control" id="password" placeholder="password">
	</div>
</div>
<div class="form-group">	
	<label for="password2" class="col-sm-3 control-label">Password Baru</label>
	<div class="col-sm-9">
	<input type="password" class="form-control" id="password2" placeholder="ulangi password">
	</div>
</div>
<input type="hidden" id="oid">
</fieldset>
<a class="btn btn-app" id="simpan">
                    <i class="fa fa-save"></i> Simpan
                  </a>
</form>
<script>
  $(function() {
    $( "#ftgl_lahir" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
	$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });
  });
</script>