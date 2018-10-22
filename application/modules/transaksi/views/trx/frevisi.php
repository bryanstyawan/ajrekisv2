<div class="box box-default">
<style>
					  .btn-file {
  position: relative;
  overflow: hidden;
}
.btn-file input[type=file] {
  position: absolute;
  top: 0;
  right: 0;
  min-width: 100%;
  min-height: 100%;
  font-size: 100px;
  text-align: right;
  filter: alpha(opacity=0);
  opacity: 0;
  background: red;
  cursor: inherit;
  display: block;
}
input[readonly] {
  background-color: white !important;
  cursor: text !important;
}
</style>
            <div class="box-header with-border">
              <h3 class="box-title">Revisi Pekerjaan</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
				<?php echo form_open_multipart('transaksi/pRevisi',array('name'=>'revisiTrx', 'id'=>'revisiTrx'));?>
                  <input type="hidden" name="oid" id="oid" value="<?php echo $revisi->id_trx_detail;?>">
				  <div class="form-group col-md-6">
                    <label>Uraian Tugas</label>
                    <select class="form-control" name="nurtug" id="nurtug">
							<option value="<?php echo $revisi->id_urtug;?>"><?php echo $revisi->uraian_tugas;?></option>
						<?php $x=1; 
							foreach($urtug->result() as $row){?>
							<option value="<?php echo $row->id_urtug;?>"><?php echo $row->uraian_tugas;?></option>	
						<?php }	?>
                    </select>
                  </div><!-- /.form-group -->
				  <div class="form-group col-md-6">
					<label>Waktu pekerjaan</label>
					<input type="text" name="nwaktu" id="nwaktu" class="form-control" value="<?php echo $revisi->tgl_mulai.' - '.$revisi->tgl_selesai;?>" readonly />
				  </div>
				  <div class="form-group col-md-6">
					<label>Keterangan</label>
					<textarea name="nket" id="nket" class="form-control"><?php echo $revisi->nama_pekerjaan;?></textarea>
				  </div>
				  <div class="form-group col-md-6">
					<label>Output Pekerjaan</label>
					<textarea name="noutput" id="noutput" class="form-control"><?php echo $revisi->output_pekerjaan;?></textarea>
				  </div>
				  <div class="form-group col-md-6">
					<label>File Penunjang</label>
					<div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-primary btn-file">
                        Upload&hellip; <input type="file" name="userfile[]" id="userfile" multiple="multiple">
                    </span>
                </span>
                <input type="text" class="form-control" value="<?php foreach($file->result() as $files){echo $files->file.', ';}?>" readonly>
            </div>
				  </div>
				  <div class="form-group col-md-12">
				  <div class="row">
					<div class="col-md-6">
						<span class="input-group-btn">
						<button type="submit" name="revisi" class="btn btn-block btn-social btn-google"><i class="fa fa-save"></i>Simpan</button>
						</span>
					</div>
					  <div class="col-md-6">
					  <a class="btn btn-block btn-social btn-google" onclick="reset()"><i class="fa fa-eraser"></i> Reset </a>
					  </div>
				  </div>
				  </div>
				  </form>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
          </div><!-- /.box -->
<script>
$(function(){
$('a[title]').tooltip();
$('#nwaktu').daterangepicker({
	timePicker24Hour: true,
	timePicker: true,
	timePickerIncrement: 5,
	format: 'YYYY-MM-DD HH:mm',
	opens:"left",
	drops:"up",
	maxDate:new Date()
	});
});
</script>