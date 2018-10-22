                    
					<?php foreach($jabatan->result() as $row){?>
						<option value="<?php echo $row->id;?>"><?php echo $row->nama_posisi;?></option>
					<?php }?>
					