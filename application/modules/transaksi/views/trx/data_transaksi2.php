<?=$this->load->view('templates/common/preloader');?>
<?php
	$trigger_disable_hari_aktif = "";
	$trigger_css_hari_aktif     = "";
	$trigger_msg_hari_aktif     = 0;
	if ($hari_kerja == 0) {
		$trigger_disable_hari_aktif = "disabled='disabled'";
		$trigger_css_hari_aktif     = "pointer-events: none;";
		$trigger_msg_hari_aktif     = 1;
	}
?>

<section id="view_section">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-body">
					<div class="row">

						<!-- Baris Filter -->
						<div class="col-xs-6">
							<h4>Bulan</h4>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>
								<select class="form-control" name="select_bulan" id="select_bulan">
									<?php
										for ($i=1; $i <= count($this->Globalrules->data_bulan()); $i++) { 
											# code...
											if ($i == date('m')) {
												# code...
									?>
											<option value="<?=$i;?>" selected><?=$this->Globalrules->data_bulan()[$i]['nama'];?></option>
									<?php														
											}
											else
											{
									?>
											<option value="<?=$i;?>"><?=$this->Globalrules->data_bulan()[$i]['nama'];?></option>											
									<?php
											}
										}
									?>
								</select>
							</div>								
						
							<h4>Tahun</h4>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>
								<select class="form-control" name="select_tahun" id="select_tahun">
									<?php
										$now=date('Y');
										for ($a=$now;$a<=$now+5;$a++)
										{
											if ($a == $now) {
												# code...
												echo "<option value='$a' selected>$a</option>";														
											}
											else
											{
												echo "<option value='$a'>$a</option>";
											}
										}
									?>											
								</select>
							</div>
							
							<h4>Status</h4>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-briefcase"></i>
								</span>
								<select class="form-control" name="select_status" id="select_status">
									<option value="8">Semua</option>
									<option value="0">Belum Diperiksa</option>
									<option value="1">Disetujui</option>
									<option value="2">Ditolak</option>
									<option value="4">Keberatan</option>
									<option value="5">Keberatan Ditolak</option>
									<option value="6">Banding</option>
									<option value="7">Banding Ditolak</option>
								</select>
							</div>						

							<?php
							if ($member != array()) {
							?>
								<h4>Bawahan</h4>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-user"></i>
									</span>
									<!-- <span class='badge badge-success'>1</span> -->

									<!-- <div class="dropdown">
										<button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example
										<span class="caret"></span></button>
										<ul class="dropdown-menu">
											<li><a href="#">HTML</a></li>
											<li><a href="#">CSS</a></li>
											<li><a href="#">JavaScript</a></li>
										</ul>
									</div> -->

									<select class="form-control" name="select_member" id="select_member">
										<option value='0'>------------NONE------------</option>
										<?php
											$i = "";
											for ($i=0; $i < count($member); $i++)
											{
												$flag_counter = "";
												if ($member[$i]->counter_belum_diperiksa == 0) {
													// code...
													$flag_counter = "display:none;";
												}
												$id 	 = $member[$i]->id;
												$nip 	 = $member[$i]->nip;
												$nama	 = $member[$i]->nama_pegawai;
												$counter = $member[$i]->counter_belum_diperiksa+$member[$i]->counter_keberatan;
												echo "<option value='$id'>$nama ($nip) | $counter transaksi belum diperiksa</option>";
											?>
										<?php echo $member[$i]->counter_belum_diperiksa+$member[$i]->counter_keberatan;?>
										<?php
											}
										?>											
									</select>
								</div>
							<?php
							}
							?>
						</div>

						<!-- Baris Warna Status -->
						<div class="col-xs-6">
							<div class="box-body pull-right">
								<div class="form-group">
									<div class="row">
										<div class="col-sm-12 break-label">
											<label class="col-sm-6">Transaksi yang disetujui : </label>
											<label class="col-sm-6" style="background-color: #4caf50;">&nbsp;</label>
										</div>
										<div class="col-sm-12 break-label">
											<label class="col-sm-6">Transaksi yang ditolak : </label>
											<label class="col-sm-6" style="background-color: #C0392B;">&nbsp;</label>
										</div>
										<div class="col-sm-12 break-label">
											<label class="col-sm-6">Pengajuan keberatan : </label>
											<label class="col-sm-6" style="background-color: #F39C12;">&nbsp;</label>
										</div>
										<div class="col-sm-12 break-label">
											<label class="col-sm-6">Keberatan ditolak : </label>
											<label class="col-sm-6" style="background-color: #D35400;">&nbsp;</label>
										</div>
										<div class="col-sm-12 break-label">
											<label class="col-sm-6">Pengajuan banding : </label>
											<label class="col-sm-6" style="background-color: #008080;">&nbsp;</label>
										</div>
										<div class="col-sm-12 break-label">
											<label class="col-sm-6">Banding ditolak : </label>
											<label class="col-sm-6" style="background-color: #000080;">&nbsp;</label>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Baris Tombol -->
						<div class="row col-xs-12">
							<div class="box-title pull-right">
								<button class="btn btn-block btn-primary" id="btn_tambah"><i class="fa fa-plus-square"></i> INPUT SIKERJA</button>
								<button class="btn btn-block btn-primary" id="btn_filter"><i class="fa fa-search"></i> LIHAT DATA</button>
							</div>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- <div class="col-md-12">
		<div class="box box-solid" id="isi_kontak" style="">
			<div class="box-header with-border">
				<h3 class="box-title">Permintaan untuk Penilaian Prilaku</h3>
			</div>
			<div class="box-body">
			<?php
				if ($member != array()) {
					# code...
					for ($i=0; $i < count($member); $i++) { 
						# code...
						$data_link_a = "";
						$data_link_a = base_url() . 'public/images/pegawai/'.$member[$i]->photo; 

						$data_done      = "";
						$data_done_span = "";
						// if ($member[$i]->status_prilaku != NULL) {
						// 	# code...
						// 	if ($member[$i]->status_prilaku == 1) {
						// 		# code...
						// 		$data_done      = "background-color: #4caf50;";                            
						// 		$data_done_span = "color:#fff;";                            
						// 	}
						// }
						// else {
						// 	# code...
						// 	$data_done      = "";         
						// 	$data_done_span = "";                                       
						// }
			?>
						<a class="btn btn-app" style="<?=$data_done;?>">
							<img src="<?=$data_link_a;?>" style="height: 100%">
							<span style="<?=$data_done_span;?>"><?=$member[$i]->nama_pegawai;?></span>                            
						</a>                    
			<?php                    
					}
				}
			?>
			</div>
		</div>    
	</div> -->

	<div id="view_bawahan" class="col-xs-12" style="display:none;">
		<div class="box">
			<div class="box-header">
				<h2 class="box-title heading-hr text-center col-lg-12">INFORMASI PEGAWAI</h2>																				        
			</div>
			<div class="box-body">
				<div class="container-fluid">
					<div class="row">

						<div class="col-md-2">
							<div id="lbl_image"></div>
						</div>

						<div class="col-md-10 label-info-pegawai">
							<div class="col-md-6 label-info-pegawai">
								<label>Pimpinan Tinggi Madya (Eselon I) :</label>
								<span id="lbl_eselon1"></span>
							</div>

							<div class="col-md-6 label-info-pegawai">
								<label>Pimpinan Tinggi Pratama (Eselon II) :</label>
								<span id="lbl_eselon2"></span>
							</div>

							<div class="col-md-6 label-info-pegawai">
								<label>Administrator (Eselon III) :</label>
								<span id="lbl_eselon3"></span>
							</div>

							<div class="col-md-6 label-info-pegawai">
								<label>Pengawas (Eselon IV) :</label>
								<span id="lbl_eselon4"></span>
							</div>

							<div class="col-md-6 label-info-pegawai">
								<label>NIP:</label>
								<span id="lbl_nip"></span>
							</div>

							<div class="col-md-6 label-info-pegawai">
								<label>Nama:</label>
								<span id="lbl_nama"></span>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
			</div>
			<div class="box-body" id="isi">
				<div>
					<table class="table table-bordered table-striped table-view">
					<thead>
						<tr>
							<th style="width:115px; padding-right: 10px;">Mulai Pekerjaan</th>
							<th style="width:115px; padding-right: 10px;">Selesai Pekerjaan</th>
							<th style="width:280px; padding-right: 10px;">Uraian Tugas</th>
							<th style="width:280px; padding-right: 10px;">Keterangan Pekerjaan</th>							
							<th style="width:80px; padding-right: 10px;">Output Kuantitas</th>
							<th style="width:50px; padding-right: 10px;">File Pendukung</th>
							<th style="width:55px; padding-right: 10px;">Keterangan</th>
							<th style="width:75px; padding-right: 10px;">Aksi</th>
						</tr>
					</thead>
					<tbody id="table_content">
						<?php					
							if ($list != 0) {
								for ($i=0; $i < count($list); $i++) {
									$id				= $this->session->userdata('sesUser');
									$status         = "";
									$ket			= "";
									$style_td		= "";
									$style_status	= "";
									$style_tr       = "";
									$row_tr			= "";
									$col_td			= "";
									
									if ($list[$i]->kegiatan_skp == '' && $list[$i]->kegiatan_skp_jfu == '' && $list[$i]->kegiatan_skp_jft == '') {
										$kegiatan = $list[$i]->uraian_tugas;                                                    
									} 
									else {
										if ($infoPegawai[0]->kat_posisi == 1) {
											$kegiatan = $list[$i]->kegiatan_skp;
										}
										elseif ($infoPegawai[0]->kat_posisi == 2) {
											$kegiatan = $list[$i]->kegiatan_skp_jft;
										}                                                                                            
										elseif ($infoPegawai[0]->kat_posisi == 4) {
											$kegiatan = $list[$i]->kegiatan_skp_jfu;
										}
										elseif ($infoPegawai[0]->kat_posisi == 6) {
											$kegiatan = $list[$i]->kegiatan_skp;
										}                                                                                                                                                    
									}

									$row_tr			  = "row_".$list[$i]->id_pekerjaan;
									$col_td			  = "col_".$list[$i]->id_pekerjaan;

									if ($list[$i]->status_pekerjaan == 1) {
										$status       = "Close";
										$style_status = "display:none;";
										$ket		  = "Transaksi Disetujui";
										$style_tr     = "background-color: #4CAF50;color: #fff;";
										$style_td     = "border-bottom: 1px solid #fff;border-top: 1px solid #fff;";
									}
									elseif ($list[$i]->status_pekerjaan == 2) {
										$status       = "Open";
										$style_status = "";
										$ket		  = "Transaksi Ditolak<br>Alasan: ".$list[$i]->alasan_ditolak;
										$style_tr     = "background-color: #C0392B;color: #fff;";
										$style_td     = "border-bottom: 1px solid #fff;border-top: 1px solid #fff;";
									}
									elseif ($list[$i]->status_pekerjaan == 4) {
										$status       = "Open";
										$style_status = "";
										$ket		  = "Pengajuan Keberatan<br>Alasan: ".$list[$i]->komentar_keberatan;
										$style_tr     = "background-color: #F39C12;color: #fff;";
										$style_td     = "border-bottom: 1px solid #fff;border-top: 1px solid #fff;";
									}
									elseif ($list[$i]->status_pekerjaan == 5) {
										$status       = "Open";
										$style_status = "";
										$ket		  = "Keberatan Ditolak<br>Alasan: ".$list[$i]->komentar_tolak_keberatan;
										$style_tr     = "background-color: #D35400;color: #fff;";
										$style_td     = "border-bottom: 1px solid #fff;border-top: 1px solid #fff;";
									}
									elseif ($list[$i]->status_pekerjaan == 6) {
										$status       = "Open";
										$style_status = "";
										$ket		  = "Pengajuan Banding<br>Alasan: ".$list[$i]->komentar_banding;
										$style_tr     = "background-color: #008080;color: #fff;";
										$style_td     = "border-bottom: 1px solid #fff;border-top: 1px solid #fff;";
									}
									elseif ($list[$i]->status_pekerjaan == 7) {
										$status       = "Open";
										$style_status = "";
										$ket		  = "Banding Ditolak<br>Alasan: ".$list[$i]->komentar_tolak_banding;
										$style_tr     = "background-color: #000080;color: #fff;";
										$style_td     = "border-bottom: 1px solid #fff;border-top: 1px solid #fff;";
									}
									else
									{
										$status       = "Open"; 
										$style_status = "";
										$ket		  = "Transaksi Belum Diperiksa";
									}
						?>
									<tr id="<?=$row_tr;?>" style="<?=$style_tr;?>">
										<td style="<?=$style_td;?>">Tgl: <b><?=date('d F Y', strtotime($list[$i]->tanggal_mulai));?></b><br> Jam: <b><?=$list[$i]->jam_mulai;?></b></td>								
										<td style="<?=$style_td;?>">Tgl: <b><?=date('d F Y', strtotime($list[$i]->tanggal_selesai));?></b><br> Jam: <b><?=$list[$i]->jam_selesai;?></b></td>
										<td style="<?=$style_td;?>"><?=$kegiatan;?></td>
										<td style="<?=$style_td;?>"><?=$list[$i]->nama_pekerjaan;?></td>
										<td style="<?=$style_td;?>"><?=$list[$i]->frekuensi_realisasi;?> <?=$list[$i]->target_output_name;?></td>
										<td style="<?=$style_td;?>">
											<?php
												$link = "";
												if ($list[$i]->file_pendukung != '') {
													# code...
											?>
												<a class="btn btn-success btn-xs" href="<?php echo base_url() . 'public/file_pendukung/'.$infoPegawai[0]->nip.'/'.$list[$i]->file_pendukung; ?>"><i class="fa fa-download"></i>&nbsp;Unduh</a>
											<?php
												}
											?>
										</td>
										<td id="<?=$col_td;?>" style="<?=$style_td;?>"><b><?=$ket;?></b></td>
										<td style="<?=$style_td;?>">
										<?php
											if ($list[$i]->status_pekerjaan == 2) { 
												// Pengajuan Keberatan
												?>
													<button class="btn btn-warning btn-xs" style="margin-bottom: 10px; width: 75px;" onclick="keberatan('<?php echo $list[$i]->id_pekerjaan;?>')"><i class="fa fa-balance-scale"></i>&nbsp;Keberatan</button>
												<?php
											}
											elseif ($list[$i]->status_pekerjaan == 5) { 
												// Pengajuan Banding
											?>
												<button class="btn btn-warning btn-xs" style="margin-bottom: 10px; width: 75px;" onclick="banding('<?php echo $list[$i]->id_pekerjaan;?>')"><i class="fa fa-balance-scale"></i>&nbsp;Banding</button>
											<?php
											}
											elseif ($list[$i]->status_pekerjaan == 0)
												// Hapus Transaksi
											{
												?>
													<button class="btn btn-danger btn-xs" style="margin-bottom: 10px; width: 75px;" onclick="del('<?php echo $list[$i]->id_pekerjaan;?>')"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
												<?php
											}
										?>
										</td>
									</tr>
						<?php
								}
							}
						?>
						</tbody>
					</table>
				</div>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>	
</section>

<section id="form_section" style="display:none;">
	<div class="col-xs-12">
		
		<div class="table-responsive">
				
				
			<!-- <div class="box-header with-border">
				<h2 class="box-title">Tambah Pekerjaan Baru</h2>
				
				<div class="col-lg-12 text-center">
					
				</div>
			</div>
			<div class="box box-default"> -->
			
			<div class="box box-default" style="padding:10px;">
				<div class="box-tools pull-right"><a id="closeData" class="btn btn-block btn-danger"><i class="fa fa-close"></i></a></div>
				<br><br>

				<div class="box-body">
					<h2 class="text-center" style="background-color: #FF0000;color: #fff;">EQUAL WORK DESERVES EQUAL PAY</h2><br>
					<div class="row">
						<div class="form-group col-md-12">
							<label style="color: #000;font-weight: 400;font-size: 19px;">Uraian Tugas</label>
							<div class="input-group">
								<select class="form-control form-control-detail js-example-basic-single tour-step step1" style="width: 1280px" name="urtug" id="urtug">
									<option value="">Pilih Uraian Tugas</option>

									<?php
										if ($urtug) {
											# code...
											$x = "";
											for ($i=0; $i < count($urtug); $i++) {
												# code...
												$x++;
												$kegiatan_urtug = $urtug[$i]->kegiatan;                            
												if($infoPegawai[0]->kat_posisi == 1)
												{
													if ($urtug[$i]->id_skp_master != 0) {
														# code...
														$kegiatan_urtug            = $urtug[$i]->kegiatan_skp;
													}
												}
												elseif ($infoPegawai[0]->kat_posisi == 2) {
													# code...
													if ($urtug[$i]->id_skp_jft != 0) {
														# code...
														$kegiatan_urtug            = $urtug[$i]->kegiatan_skp_jft;
													}                                
												}                            
												elseif ($infoPegawai[0]->kat_posisi == 4) {
													# code...
													if ($urtug[$i]->id_skp_jfu != 0) {
														# code...
														$kegiatan_urtug            = $urtug[$i]->kegiatan_skp_jfu;
													}                                
												}
												elseif($infoPegawai[0]->kat_posisi == 6)
												{
													if ($urtug[$i]->id_skp_master != 0) {
														# code...
														$kegiatan_urtug            = $urtug[$i]->kegiatan_skp;
													}
												}

									?>
											<option value="<?php echo $urtug[$i]->skp_id;?>"><?php echo $x.". ".$kegiatan_urtug;?></option>
									<?
											}
										}
									?>
								</select>
								<input type="hidden" id="flag_urtug" name="flag_urtug">
							</div>
						</div>

						<div class="form-group col-md-6">
							<label style="color: #000;font-weight: 400;font-size: 19px;">Tanggal Mulai</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
								<input type="text" id="tgl_mulai" name="tgl_mulai" class="form-control form-control-detail timerange" >
							</div>
						</div>

						<div class="form-group col-md-6">
							<label style="color: #000;font-weight: 400;font-size: 19px;">Tanggal Selesai</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
								<input type="text" id="tgl_selesai" name="tgl_selesai" class="form-control form-control-detail timerange" >
							</div>
						</div>

						<div class="form-group col-md-6">
							<label style="color: #000;font-weight: 400;font-size: 19px;">Jam Mulai</label>
							<div class="input-group clockpicker">
								<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
								<input type="text" id="jam_mulai" name="jam_mulai" class="form-control form-control-detail timemasking" data-inputmask="'mask': ['99:99']" data-mask>
							</div>
						</div>

						<div class="form-group col-md-6">
							<label style="color: #000;font-weight: 400;font-size: 19px;">Jam Selesai</label>
							<div class="input-group clockpicker">
								<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
								<input type="text" id="jam_selesai" name="jam_selesai" class="form-control form-control-detail timemasking" data-inputmask="'mask': ['99:99']" data-mask>
							</div>
						</div>

						<div class="form-group col-md-12">
							<label style="color: #000;font-weight: 400;font-size: 19px;">Keterangan Pekerjaan <b class="pull-right">*</b></label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
								<textarea id="ket_pekerjaan" name="ket_pekerjaan" class="form-control form-control-detail"></textarea>
							</div>
						</div>

						<div class="form-group col-md-12" style="background-color:#fcff37">
							<div class="form-group col-md-12">
								<label style="color: #000;font-weight: 400;font-size: 19px;">*Diisi jika sudah ada output</label>
							</div>

							<div class="form-group col-md-6">
								<input type="hidden" id="hdn_param_out_skp">
								<input type="hidden" id="hdn_param_qty_skp">
								<input type="hidden" id="hdn_param_realisasi_qty_skp">
								<label style="color: #000;font-weight: 400;font-size: 19px;">Kuantitas</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
									<input type="number" id="kuantitas" name="kuantitas" min="0" class="form-control form-control-detail">
								</div>
								<div>
									<span class="input-group-addon"><label id="param_qty_skp">Target Kuantitas SKP : </label></span>                                                 
									<!-- <span class="input-group-addon"><label id="param_realisasi_qty_skp">Realisasi : </label></!-->
								</div>
								<div>
									<br><br>
									<span class="input-group-addon"><label id="param_realisasi_qty_skp">Realisasi : </label></span>
								</div>
							</div>

							<div class="form-group col-md-6">
								<div class="col-lg-12">
									<label class="pull-left" style="color: #000;font-weight: 400;font-size: 19px;">File Pendukung</label>
								</div>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
									<input type="file" id="file_pendukung" name="file_pendukung" class="form-control form-control-detail">
								</div>
								<div class="col-lg-12">
									<label class="pull-right" style="color: #000;font-weight: 400;font-size: 14px;">*Maksimal 3MB (pdf|csv|docx|doc|xlsx|xl|xls|jpg|jpeg|png)</label>
								</div>
							</div>
						</div>

						<div class="form-group col-md-12">
							<div class="row">
								<div class="col-md-6 pull-right">
									<span class="input-group-btn">
										<a class="btn btn-app pull-right" id="btn_save" <?php echo $trigger_disable_hari_aktif;?> style="<?php echo $trigger_css_hari_aktif;?>"><i class="fa fa-save"></i> Simpan</a>
									</span>
								</div>
							</div>
							<div class="row">
								<label class="pull-left"><b>*Pastikan Pengaturan Timezone dikomputer anda sudah benar.</b></label>
							</div>
						</div>
					</div>
					
					<!-- </div> -->
				</div>
			</div>
		</div>
	</div>
</section>

<section>
	<!-- Alasan Tolak Transaksi (Status Pekerjaan = 0) -->
	<div class="example-modal">
		<div class="modal modal-success fade" id="tolak_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="box-content">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Alasan Tolak Pekerjaan</h4>
						</div>
						<div class="modal-body" style="background-color: #fff!important;">
							<form id="editForm" name="addForm">

								<label style="color: #000;font-weight: 400;font-size: 19px;">Alasan</label>
								<div class="form-group"><div class="input-group">
									<span class="input-group-addon"><i class="fa fa-star"></i></span>
									<textarea class="form-control" id="textarea_alasan_tolak" name="textarea_alasan_tolak"></textarea>
									<input type="hidden" id="oid_tolak" name="oid_tolak" >
									</div>
								</div>

							</form>
						</div>
						<div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
							<a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
							<input type="submit" class="btn btn-primary" value="Simpan" id="btn_tolak"/>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>

	<!-- Alasan Keberatan (Status Pekerjaan 4) -->
	<div class="example-modal">
		<div class="modal modal-success fade" id="keberatan_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="box-content">

				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Komentar Keberatan</h4>
						</div>
						<div class="modal-body" style="background-color: #fff!important;">
							<form id="editForm" name="addForm">

								<label style="color: #000;font-weight: 400;font-size: 19px;">Komentar</label>
								<div class="form-group"><div class="input-group">
									<span class="input-group-addon"><i class="fa fa-star"></i></span>
									<textarea class="form-control" id="textarea_komentar_keberatan" name="textarea_komentar_keberatan"></textarea>
									<input type="hidden" id="oid_keberatan" name="oid_keberatan" >
									</div>
								</div>

							</form>
						</div>
						<div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
							<a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
							<input type="submit" class="btn btn-primary" value="Simpan" id="btn_keberatan"/>

						</div>
					</div>
				</div>
			</div>
		</div>
    </div>

	<!-- Alasan Tolak Keberatan (Status Pekerjaan 5) -->
	<div class="example-modal">
		<div class="modal modal-success fade" id="tolak_data_keberatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="box-content">

				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Alasan Tolak Keberatan</h4>
						</div>
						<div class="modal-body" style="background-color: #fff!important;">
							<form id="editForm" name="addForm">

								<label style="color: #000;font-weight: 400;font-size: 19px;">Alasan</label>
								<div class="form-group"><div class="input-group">
									<span class="input-group-addon"><i class="fa fa-star"></i></span>
									<textarea class="form-control" id="textarea_alasan_tolak_keberatan" name="textarea_alasan_tolak_keberatan"></textarea>
									<input type="hidden" id="oid_tolak_keberatan" name="oid_tolak_keberatan" >
									</div>
								</div>

							</form>
						</div>
						<div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
							<a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
							<input type="submit" class="btn btn-primary" value="Simpan" id="btn_tolak_keberatan"/>

						</div>
					</div>
				</div>
			</div>
		</div>
    </div>

    <!-- Alasan Banding Transaksi (Status Pekerjaan 6) -->
	<div class="example-modal">
		<div class="modal modal-success fade" id="banding_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="box-content">

				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Komentar Banding</h4>
						</div>
						<div class="modal-body" style="background-color: #fff!important;">
							<form id="editForm" name="addForm">

								<label style="color: #000;font-weight: 400;font-size: 19px;">Komentar</label>
								<div class="form-group"><div class="input-group">
									<span class="input-group-addon"><i class="fa fa-star"></i></span>
									<textarea class="form-control" id="textarea_komentar_banding" name="textarea_komentar_banding"></textarea>
									<input type="hidden" id="oid_banding" name="oid_banding" >
									</div>
								</div>

							</form>
						</div>
						<div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
							<a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
							<input type="submit" class="btn btn-primary" value="Simpan" id="btn_banding"/>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Alasan Tolak Banding (Status Pekerjaan 7) -->
	<div class="example-modal">
		<div class="modal modal-success fade" id="tolak_data_banding" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="box-content">

				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Alasan Tolak Banding</h4>
						</div>
						<div class="modal-body" style="background-color: #fff!important;">
							<form id="editForm" name="addForm">

								<label style="color: #000;font-weight: 400;font-size: 19px;">Alasan</label>
								<div class="form-group"><div class="input-group">
									<span class="input-group-addon"><i class="fa fa-star"></i></span>
									<textarea class="form-control" id="textarea_alasan_tolak_banding" name="textarea_alasan_tolak_banding"></textarea>
									<input type="hidden" id="oid_tolak_banding" name="oid_tolak_banding" >
									</div>
								</div>

							</form>
						</div>
						<div class="modal-footer" style="background-color: #fff!important;border-top-color: #d2d6de;">
							<a href="#" class="btn btn-danger" data-dismiss="modal">Keluar</a>
							<input type="submit" class="btn btn-primary" value="Simpan" id="btn_tolak_banding"/>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</section>

<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function()
{
	init_tr('<?=$arg;?>')
	$('#btn_filter').click(function()
	{
		var select_bulan         = $("#select_bulan").val();
		var select_tahun         = $("#select_tahun").val();
		var select_status        = $("#select_status").val();
		var select_member        = $("#select_member").val();

		if (select_member == undefined) {
			select_member = null;
		}
		
		var data_link = {
						'data_5': select_bulan,
						'data_6': select_tahun,
						'data_7': select_status,
						'data_8': select_member
		}
		console.log(data_link);

		if (select_bulan.length <= 0 || select_tahun.length <= 0) {
			Lobibox.notify('warning', {
				title: 'Perhatian',
				msg: 'Proses dihentikan, mohon pilih bulan dan tahun'
			});                        			
		}
		else if (select_status.length <= 0) {
			Lobibox.notify('warning', {
				title: 'Perhatian',
				msg: 'Proses dihentikan, mohon pilih status'
			});                        			
		}
		else
		{
			$.ajax({
				url :"<?php echo site_url()?>transaksi/filter_transaksi",
				type:"post",
				data: { data_sender : data_link},
				beforeSend:function(){
					$("#loadprosess").modal('show');
					$('.table-view').dataTable().fnDestroy();
					var newrec  = '<tr">' +
										'<td colspan="5" class="text-center">Memuat Data</td>'
								'</tr>';
					$('.table-view tbody').append(newrec);
				},			
				success:function(msg){
					$(".table-view tbody tr").remove();
					$("#table_content").html(msg);
					$(".table-view").DataTable({
						"oLanguage": {
							"sSearch": "Pencarian :",
							"sSearchPlaceholder" : "Ketik untuk mencari",
							"sLengthMenu": "Menampilkan data&nbsp; _MENU_ &nbsp;Data",
							"sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
							"sZeroRecords": "Data tidak ditemukan"
						},
						"dom": "<'row'<'col-sm-6'f><'col-sm-6'l>>" +
								"<'row'<'col-sm-5'i><'col-sm-7'p>>" +
								"<'row'<'col-sm-12'tr>>" +
								"<'row'<'col-sm-5'i><'col-sm-7'p>>",
						"bSort": false,
						"paging": false
						// "dom": '<"top"f>rt'
						// "dom": '<"top"fl>rt<"bottom"ip><"clear">'
					});
					
					if (select_member != 0) {
						var id = $("#select_member").val();
						$.ajax({
							url :"<?php echo site_url()?>transaksi/get_detail_bawahan",
							type:"post",
							data:"id="+id,
							beforeSend:function(){
								$("#loadprosess").modal('show');
							},
							success:function(msg){
								if (msg != 0)
								{
									var obj = jQuery.parseJSON (msg);
									console.log(obj[0]);
									link_image = '';
									if (obj[0].photo == '-') {
										link_image = "<?php echo base_url() . 'assets/images/businessman1.jpg';?>";
									}
									else {
										link_image = "<?php echo base_url();?>public/images/pegawai/"+obj[0].photo;
									}
									$("#lbl_eselon1").html(obj[0].nama_eselon1);
									$("#lbl_eselon2").html(obj[0].nama_eselon2);
									$("#lbl_eselon3").html(obj[0].nama_eselon3);
									$("#lbl_eselon4").html(obj[0].nama_eselon4);
									$("#lbl_nama").html(obj[0].nama_pegawai);
									$("#lbl_nip").html(obj[0].nip);
									$("#lbl_image").html("<img style='width: 160px;height: 160px;' src='"+link_image+"'>");
									$("#view_bawahan").css({"display": ""});
								}
								else
								{
									link_image = "<?php echo base_url() . 'assets/images/businessman1.jpg';?>";
									$("#lbl_eselon1").html(" ");
									$("#lbl_eselon2").html(" ");
									$("#lbl_eselon3").html(" ");
									$("#lbl_eselon4").html(" ");
									$("#lbl_nama").html(" ");
									$("#lbl_nip").html(" ");
									$("#lbl_image").html("<img style='width: 160px;height: 160px;' src='"+link_image+"'>");
									$("#view_bawahan").css({"display": ""});
								}
								$("#loadprosess").modal('hide');
							}
						})
					}
					else
					{
						$("#view_bawahan").css({"display": "none"})
					}

					setTimeout(function(){
						$("#loadprosess").modal('hide');
					}, 500);
				},
				error:function(jqXHR,exception)
				{
					ajax_catch(jqXHR,exception);					
				}
			})	
		}	
	});

	$('#btn_tambah').click(function()
	{
		$(".form-control-detail").val('');
		$("#form_section").css({"display": ""})
		$("#view_section").css({"display": "none"})
		// $("#form_section > div > div > div.box-header > h3").html("Tambah Data Pegawai");		
		// $("#crud").val('insert');
	});

	$("#closeData").click(function()
	{
		$("#form_section").css({"display": "none"})
        $("#view_section").css({"display": ""})		
	});

	// ComboBox Uraian Tugas
	$("#urtug").change(function()
	{
        var urtug = $("#urtug option:selected").text();
        var str = new String(urtug);
        var n = str.indexOf("perjalanan dinas");
        var n1 = str.indexOf("Perjalanan Dinas");

        var id = $("#urtug").val();
        $.ajax({
            url :"<?php echo site_url()?>transaksi/get_detail_skp",
            type:"post",
            data:"id="+id,
            beforeSend:function(){
                $("#loadprosess").modal('show');
            },
            success:function(msg){
                if (msg != 0)
                {
                    var obj = jQuery.parseJSON (msg);
                    realisasi_qty = obj.realisasi_kuantitas;
                    $("#hdn_param_out_skp").val(obj.target_output_name);
                    $("#hdn_param_qty_skp").val(obj.target_qty);
                    $("#hdn_param_realisasi_qty_skp").val(obj.realisasi_qty);
                    $("#param_qty_skp").html("Target Kuantitas SKP : "+obj.target_qty+" "+obj.target_output_name);
                    $("#param_realisasi_qty_skp").html("Realisasi :  "+realisasi_qty+" "+obj.target_output_name);
                }
                else
                {
                    $("#hdn_param_out_skp").val('');
                    $("#hdn_param_qty_skp").val('');
                    $("#hdn_param_realisasi_qty_skp").val('');
                    $("#param_qty_skp").html("Target Kuantitas SKP : ");
                    $("#param_realisasi_qty_skp").html("Realisasi :  ");
                }
                $("#loadprosess").modal('hide');
            }
        })
	});

	// Tambah Transaksi
	$("#btn_save").click(function()
    {
        flag_urtug         = $("#flag_urtug").val();

        urtug              = $("#urtug").val();
        tgl_mulai          = change_format_date($("#tgl_mulai").val(),'yyyy-mm-dd');
        tgl_selesai        = change_format_date($("#tgl_selesai").val(),'yyyy-mm-dd');

        tgl_mulai_raw      = $("#tgl_mulai").val();
        tgl_selesai_raw    = $("#tgl_selesai").val();

        jam_mulai          = $("#jam_mulai").val();
        jam_selesai        = $("#jam_selesai").val();
        tgl_server         = current_date();
        ket_pekerjaan      = $("#ket_pekerjaan").val();
        kuantitas          = $("#kuantitas").val();
        file_pendukung     = $('#file_pendukung').prop('files')[0];
        // file_pendukung     = $('#file_pendukung')[0].files[0];
        
        waktu_mulai        = tgl_mulai+" "+jam_mulai;
        waktu_selesai      = tgl_selesai+" "+jam_selesai;

        start_actual_time  = new Date(waktu_mulai);
        end_actual_time    = new Date(waktu_selesai);
        server_actual_time = new Date();
        diff               = end_actual_time - start_actual_time;
        // diff_date          = (new Date(tgl_selesai)) - (new Date(tgl_mulai));

        // hari_efektif       = ((diff_date/1000) / 86400);
        // menit_efektif      = diff / 60000;

        flag_param_out_skp = '';
        param_out_skp      = $("#hdn_param_out_skp").val();

        realisasi_qty      = $("#hdn_param_realisasi_qty_skp").val();
        total_qty          = +realisasi_qty + +kuantitas;
        target_qty         = $("#hdn_param_qty_skp").val();

        if (kuantitas == 0)
        {
            kuantitas = 0;
        }
        
        var data_sender = {
                                'urtug'             : urtug,
                                'flag_urtug'        : flag_urtug,
                                // 'tgl_mulai'         : tgl_mulai,
                                // 'tgl_selesai'       : tgl_selesai,
                                'tgl_mulai_raw'     : tgl_mulai_raw,
                                'tgl_selesai_raw'   : tgl_selesai_raw,
                                'jam_mulai'         : jam_mulai,
                                'jam_selesai'       : jam_selesai,
                                'ket_pekerjaan'     : ket_pekerjaan,
                                'kuantitas'         : kuantitas,
                                // 'file_pendukung'    : file_pendukung
                                // 'menit_efektif'     : menit_efektif,
                                // 'hari_efektif'      : hari_efektif
                            };

        if (urtug.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Uraian Tugas kosong, mohon lengkapi data tersebut"
            });
        }
        else if (tgl_mulai.length <= 0)
        {
            time_flag = 0;            
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Tanggal mulai kosong, mohon lengkapi data tersebut"
            });
        }
        else if (tgl_selesai.length <= 0 )
        {
            time_flag = 0;            
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Tanggal selesai kosong, mohon lengkapi data tersebut"
            });
        }
        else if (jam_mulai.length <= 0)
        {
            time_flag = 0;            
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Jam mulai kosong, mohon lengkapi data tersebut"
            });
        }
        else if (jam_selesai.length <= 0)
        {
            time_flag = 0;            
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Jam selesai kosong, mohon lengkapi data tersebut"
            });
        }
        else if ( ket_pekerjaan.length <= 0)
        {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Keterangan kosong, mohon lengkapi data tersebut"
            });
        }
        else
        {
            time_flag = 1;
            // console.log(start_actual_time.getFullYear());
            // if (start_actual_time.getFullYear() != server_actual_time.getFullYear() || end_actual_time.getFullYear() != server_actual_time.getFullYear())
            // {
            //     time_flag = 0;                
            //     Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            //     {
            //         msg: "Tahun harus sesuai dengan tahun berjalan."
            //     });
            // }
            // else 
            if (tgl_mulai > tgl_server || tgl_selesai > tgl_server)
            {
                time_flag = 0;                
                Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                {
                    msg: "Tanggal tidak boleh melebihi Tanggal server."
                });
            }
            else
            {
                time_flag = 1;                
                if (diff < 0)
                {
                    time_flag = 0;                    
                    Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                    {
                        msg: "Tanggal dan jam awal tidak boleh melebihi tanggal dan jam selesai."
                    });
                }
                else
                {
                    time_flag = 1;                    
                    if (end_actual_time > server_actual_time)
                    {
                        time_flag = 0;                        
                        Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                        {
                            msg: "Jam tidak boleh melebihi jam server."
                        });
                    }
                    else
                    {
                        if (total_qty > target_qty)
                        {
                            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                            {
                                msg: "Kuantitas melebihi target yang ditentukan."
                            });
                        }
                        else
                        {
                            if (time_flag == 1) 
                            {
                                if (waktu_mulai ==  waktu_selesai) {
                                    Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                                    {
                                        msg: "Tanggal dan jam awal tidak boleh sama dengan tanggal dan jam selesai."
                                    });
                                } 
                                else 
                                {
                                    if (kuantitas != 0) {
                                        if (file_pendukung != undefined)
                                        {
                                            send_data_tambah(data_sender);
                                        }
                                        else
                                        {
                                            data_sender['file_pendukung'] = null;
                                            send_data_tambah_without_file(data_sender);                                    
                                        }
                                    }
                                    else 
                                    {
                                        data_sender['file_pendukung'] = null;
                                        send_data_tambah_without_file(data_sender);
                                    }                                                                    
                                }
                            }
                            // console.log('kuantitas : '+kuantitas);
                            // console.log('file_pendukung : '+file_pendukung)
                        }

                    }
                }
            }
        }
    });

	// Change Status to 3
	$("#btn_tolak").click(function()
    {
        data_sender = [];
        if ($("#oid_tolak").val() == 'all-aout')
        {
            var inputs      = document.getElementsByName('counter_checkbox');
            for (var i = 0; i < inputs.length; i++) {
                checkbox_id      = $('#checkbox_'+i).is(':checked');
                if (checkbox_id != false)
                {
                    id_verify  = $('#hdn_id_'+i).val();
                    data_sender.push({
                                        'id_pekerjaan' : id_verify,
                                        'komentar'    : $("#textarea_alasan_tolak").val()
                                    });
                }
            }

            if (data_sender.length != 0)
            {
                send_data_tolak(data_sender,'all-aout');
            }
            else
            {
                Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
                {
                    msg: "Tidak bisa melanjutkan proses ini, tidak ada data yang dipilih"
                });
            }
        }
        else
        {
            var data_sender = {
                                    'id_pekerjaan': $("#oid_tolak").val(),
                                    'komentar'    : $("#textarea_alasan_tolak").val()
                                };
            send_data_tolak(data_sender,'single');
        }
    });

	// Change Status to 4
	$("#btn_keberatan").click(function()
    {
        var data_sender = {
                                'id_pekerjaan': $("#oid_keberatan").val(),
                                'komentar'    : $("#textarea_komentar_keberatan").val()
                            };
        if ($("#textarea_komentar_keberatan").val().length <= 0) {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "Tidak bisa melanjutkan proses ini."
            });
        }
        else {
            $.ajax({
                url :"<?php echo site_url();?>transaksi/keberatan",
                type:"post",
                data:{data_sender : data_sender},
                beforeSend:function(){
                    $("#loadprosess").modal('show');
                },
                success:function(msg){
                    var obj = jQuery.parseJSON (msg);
                    ajax_status(obj);
                },
                error:function(jqXHR,exception)
                {
                    ajax_catch(jqXHR,exception);					
                }
            })
        }
    });
	
	// Change Status to 5
	$("#btn_tolak_keberatan").click(function()
    {

        var data_sender = {
                                'id_pekerjaan': $("#oid_tolak_keberatan").val(),
                                'komentar'    : $("#textarea_alasan_tolak_keberatan").val()
                        };

        if ($("#textarea_alasan_tolak_keberatan").val().length <= 0) {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                    msg: "Alasan wajib diisi."
            });
        }
        else {
            $.ajax({
                url :"<?php echo site_url();?>transaksi/tolak_keberatan",
                type:"post",
                data:{data_sender : data_sender},
                beforeSend:function(){
                    $("#loadprosess").modal('show');
                },
                success:function(msg){
                    var obj = jQuery.parseJSON (msg);
                    ajax_status(obj);
                },
                error:function(jqXHR,exception)
                {
                    ajax_catch(jqXHR,exception);					
                }
            })
        }
    });

	// Change Status to 6
    $("#btn_banding").click(function()
    {
        var data_sender = {
                                'id_pekerjaan': $("#oid_banding").val(),
                                'komentar'    : $("#textarea_komentar_banding").val()
                            };
        $.ajax({
            url :"<?php echo site_url();?>transaksi/banding",
            type:"post",
            data:{data_sender : data_sender},
            beforeSend:function(){
                $("#loadprosess").modal('show');
            },
            success:function(msg){
                var obj = jQuery.parseJSON (msg);
                ajax_status(obj);
            },
            error:function(jqXHR,exception)
            {
                ajax_catch(jqXHR,exception);
            }
        })
	});
	
	$("#btn_tolak_banding").click(function()
    {

        var data_sender = {
                                'id_pekerjaan': $("#oid_tolak_banding").val(),
                                'komentar'    : $("#textarea_alasan_tolak_banding").val()
                        };

        if ($("#textarea_alasan_tolak_banding").val().length <= 0) {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                    msg: "Alasan wajib diisi."
            });
        }
        else {
            $.ajax({
                url :"<?php echo site_url();?>transaksi/tolak_banding",
                type:"post",
                data:{data_sender : data_sender},
                beforeSend:function(){
                    $("#loadprosess").modal('show');
                },
                success:function(msg){
                    var obj = jQuery.parseJSON (msg);
                    ajax_status(obj);
                },
                error:function(jqXHR,exception)
                {
                    ajax_catch(jqXHR,exception);					
                }
            })
        }
    });
});

function init_tr(arg) {
	if(arg == 'add')
	{
		$(".form-control-detail").val('');
		$("#form_section").css({"display": ""})
		$("#view_section").css({"display": "none"})			
	}
}

function send_data_tambah_without_file(data_sender) {
    $.ajax({
        url :"<?php echo site_url();?>transaksi/add_pekerjaan_without_file/",
        type:"post",
        data:{data_sender : data_sender},
        beforeSend:function(){
            $("#loadprosess").modal('show');
        },					
        success:function(msg){
            var obj = jQuery.parseJSON (msg);
            ajax_status(obj,'no-refresh');
            if (obj.status == 1)
            {
                // $("#tab_sikerja").removeClass("active");
                // $("#menu4").removeClass("fade in active");                
                // $("#tab_belum_diperiksa").addClass("active");
                // $("#home").addClass("fade in active");    
                $.ajax({
                    url :"<?php echo site_url();?>transaksi/refresh_data/0/counter_proses",
                    type:"post",
                    beforeSend:function(){
                        $(".form-control").val('');
                        $("#hdn_param_out_skp").val('');
                        $("#hdn_param_qty_skp").val('');
                        $("#hdn_param_realisasi_qty_skp").val('');
                        $("#param_qty_skp").html("Target Kuantitas SKP : ");
                        $("#param_realisasi_qty_skp").html("Realisasi :  ");                        
                        $("#loadprosess").modal('show');                        
                        // $("#table_belum_diperiksa tbody").html('');                        
                    },
                    success:function(msg){
                        // $("#table_belum_diperiksa tbody").html(msg);
                        $("#loadprosess").modal('hide');                        
                    },
                    error:function(jqXHR,exception)
                    {
                        ajax_catch(jqXHR,exception);					
                    }
                })                                                                            
            } 
        },
        error:function(jqXHR,exception)
        {
            ajax_catch(jqXHR,exception);					
        }
    })    
};

function send_data_tambah(data_sender) {
    file_pendukung = $('#file_pendukung').prop('files')[0];
    var form_data  = new FormData();
    form_data.append('file', file_pendukung);
    $.ajax({
        url: '<?php echo site_url();?>transaksi/upload_file_pendukung/', // point to server-side PHP script
        // dataType: 'json',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        beforeSend:function(){
            $("#loadprosess").modal('show');
            Lobibox.notify('info', {
                msg: 'Menyiapkan data untuk upload file'
            });
        },
        success: function(msg1){
            var obj1 = jQuery.parseJSON (msg1);
            console.log(obj1.status);
            if(obj1.status == 1)
            {
                data_sender['file_pendukung'] = obj1.filename;
                send_data_tambah_without_file(data_sender);
            }
        },
        error:function(jqXHR,exception)
        {
            ajax_catch(jqXHR,exception);					
        }
    });
};

function send_data_tolak(data_sender,param) {
    // body...
    var multi_approve = $("#multi_approve").is(":checked");    
    if (multi_approve == false) 
    {    
        $.ajax({
            url :"<?php echo site_url();?>transaksi/tolak/"+param,
            type:"post",
            data:{data_sender : data_sender},
            beforeSend:function(){
                $("#loadprosess").modal('show');
            },
            success:function(msg){
                var obj = jQuery.parseJSON (msg);
                ajax_status(obj);
            },
            error:function(jqXHR,exception)
            {
                ajax_catch(jqXHR,exception);					
            }
        })        
    }
    else
    {
        $.ajax({
            url :"<?php echo site_url();?>transaksi/tolak/"+param,
            type:"post",
            data:{data_sender : data_sender},
            beforeSend:function(){
                $("#tolak_data").modal('hide');                
                $("#row_"+data_sender['id_pekerjaan']).css({"background-color": "yellow"});
				$("#btn_approve_"+id).css({"display": "none"});
				$("#btn_reject_"+id).css({"display": "none"});                
            },
            success:function(msg){
                var obj = jQuery.parseJSON (msg);
                ajax_status(obj,'no-refresh');
                $("#row_"+data_sender['id_pekerjaan']).css({"background-color": "#C0392B","color": "#fff"});
                $("#col_"+data_sender['id_pekerjaan']).html('Sikerja ditolak');
            },
            error:function(jqXHR,exception)
            {
                ajax_catch(jqXHR,exception);					
            }
        })
    }
}

function del(id) {
    // body...
    Lobibox.confirm({
        title: "Konfirmasi",
        msg: "Anda yakin akan menghapus data ini ?",
        callback: function ($this, type) {
            if (type === 'yes'){
                $.ajax({
                    url :"<?php echo site_url()?>transaksi/get_delele_transaksi/"+id,
                    type:"post",
                    beforeSend:function(){
                        $("#loadprosess").modal('show');
                    },					
					success:function(msg){
						var obj = jQuery.parseJSON (msg);
						ajax_status(obj);
					},
					error:function(jqXHR,exception)
					{
						ajax_catch(jqXHR,exception);					
					}
                })
            }
        }
    })
};

function reject(id) {
	// body...
	$("#tolak_data").modal('show');
	$("#oid_tolak").val(id);
}

function keberatan(id) {
    // body...
    $("#keberatan_data").modal('show');
    $("#oid_keberatan").val(id);
};

function reject_keberatan(id) {
    // body...
    $("#tolak_data_keberatan").modal('show');
    $("#oid_tolak_keberatan ").val(id);
}

function banding(id) {
    // body...
    $("#banding_data").modal('show');
    $("#oid_banding").val(id);
}

function reject_banding(id) {
    // body...
    $("#tolak_data_banding").modal('show');
    $("#oid_tolak_banding ").val(id);
}

function approve(id) {
    // var multi_approve = $("#multi_approve").is(":checked");    
    // if (multi_approve == false) 
    // {
        // Lobibox.confirm({
        //     title: "Konfirmasi",
        //     msg: "Anda akan menyetujui pekerjaan ini ?",
        //     callback: function ($this, type) {
        //         if (type === 'yes'){
        //             $.ajax({
        //                 url :"<?php echo site_url()?>transaksi/approve/"+id,
        //                 type:"post",
        //                 beforeSend:function(){
        //                     $("#loadprosess").modal('show');
        //                 },
        //                 success:function(msg){
        //                     var obj = jQuery.parseJSON (msg);
        //                     ajax_status(obj);
        //                 },
        //                 error:function(jqXHR,exception)
        //                 {
        //                     ajax_catch(jqXHR,exception);					
        //                 }
        //             })
        //         }
        //     }
        // })
    // }
    // else
    // {
        $.ajax({
            url :"<?php echo site_url()?>transaksi/approve/"+id,
            type:"post",
            beforeSend:function(){
                $("#row_"+id).css({"background-color": "yellow"});
				$("#btn_approve_"+id).css({"display": "none"});
				$("#btn_reject_"+id).css({"display": "none"});
            },
            success:function(msg){
                var obj = jQuery.parseJSON (msg);
                ajax_status(obj,'no-refresh');
                $("#row_"+id).css({"background-color": "#4caf50","color": "#fff"});
                $("#col_"+id).html('Sikerja telah disetujui');
            },
            error:function(jqXHR,exception)
            {
                ajax_catch(jqXHR,exception);					
            }
        })
    // }    
}
</script>