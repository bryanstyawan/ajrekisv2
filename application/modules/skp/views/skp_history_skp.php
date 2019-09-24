	<style>
	.widget-user-2 .widget-user-username, .widget-user-2 .widget-user-desc
	{
		margin-left: 0px;
	}
</style>
<?php
	if ($request_history != 0) {
		# code...
		for ($i=0; $i < count($request_history); $i++) 
		{
?>
			<a href="<?php echo site_url()?>skp/cetak_skp/<?php echo $request_history[$i]->pegawai?>/<?php echo $request_history[$i]->posisi?>">
				<div class="col-md-4">
					<!-- Widget: user widget style 1 -->
					<div class="box box-widget widget-user-2">
						<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header bg-yellow">
							<!-- <h3 class="widget-user-username">Nadia Carmichael</h3> -->
							<h5 class="widget-user-desc"><?=$request_history[$i]->nama_posisi;?></h5>
						</div>
						<div class="box-footer no-padding">
						<ul class="nav nav-stacked">
							<li><a href="<?php echo site_url()?>skp/cetak_skp/<?php echo $request_history[$i]->pegawai?>/<?php echo $request_history[$i]->posisi?>"><?=$request_history[$i]->nama_eselon4.$request_history[$i]->nama_eselon3.$request_history[$i]->nama_eselon2.$request_history[$i]->nama_eselon1;?></a></li>							
							<li><a href="<?php echo site_url()?>skp/cetak_skp/<?php echo $request_history[$i]->pegawai?>/<?php echo $request_history[$i]->posisi?>"><?=$request_history[$i]->tahun_berlaku;?></a></li>
						</ul>
						</div>
					</div>
					<!-- /.widget-user -->
				</div>
			</a>
<?php
		}
	}
?>