<?php foreach($grade->result() as $row){?>
						<option value="<?php echo $row->id;?>"><?php echo $row->posisi_class." -> ".$row->tunjangan;?></option>
					<?php }?>