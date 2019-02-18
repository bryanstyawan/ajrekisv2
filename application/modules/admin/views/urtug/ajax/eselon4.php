<div class="form-group"><div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
                    <select name="es4up" id="es4up" class="form-control"><option value="">Pilih Eselon 4</option>
					<?php foreach($es4->result() as $row){?>
						<option value="<?php echo $row->id_es4;?>"><?php echo $row->nama_eselon4;?></option>
					<?php }?>
					</select>
					</div></div>
