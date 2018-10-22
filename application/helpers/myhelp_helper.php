<?php

	function lama_hari ($t1,$t2)
	{
		$ex1 =explode("-",$t1);
		$year1 = $ex1 [0];
		$month1 = $ex1 [1];
		$date1 = $ex1 [2];
		$ex2 =explode ("-",$t2);
		$year2 = $ex2 [0];
		$month2 = $ex2 [1];
		$date2 = $ex2 [2];

		$jdn1 = GregorianToJD ($month1,$date1,$year1);
		$jdn2 = GregorianToJD ($month2,$date2,$year2);
		$beda = $jdn2 - $jdn1 ;
		return $beda;
	}

	function modif_kata($text)
	{
		$pisah = explode(" ",$text);
		foreach ($pisah as $katabaru){
			$lower = ucfirst(strtolower($katabaru));
			$newtext[]      = $lower;
		}
		$cantik	= implode (" ",$newtext);
		return $cantik;
	}

	function to_excel($array, $filename)
	{
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$filename.'.xls');

		$h = array();
		foreach($array->result_array() as $row){
			foreach($row as $key=>$val){
				if(!in_array($key, $h)){
				$h[] = $key;
				}
			}
		}

		echo '<table><tr>';
		echo '<th>No</th>';
		foreach($h as $key) {
			$key = ucwords($key);
			echo '<th>'.$key.'</th>';
		}
		echo '</tr>';
		$x=1;
		foreach($array->result_array() as $row){
			echo '<tr>';
			echo '<td>'.$x.'</td>';
			foreach($row as $val)
				writeRow($val);
		$x++;
		}
		echo '</tr>';
		echo '</table>';
	}

	function subMenu()
	{
		$CI =& get_instance();
		$q = "SELECT * FROM config_menu";
		$query = $CI->db->query($q);
		$isi = mysql_num_rows($query);
		return $isi;
	}

	function adddate($vardate,$added)
	{
		$data = explode("-", $vardate);
		$date = new DateTime();
		$date->setDate($data[0], $data[1], $data[2]);
		$date->modify("".$added."");
		$day= $date->format("Y-m-d");
		return $day;
	}

	function menuSamping(){
		$CI =& get_instance();
		$role = $CI->session->userdata('sesRole');
		$induk = $CI->db->query(" SELECT config_menu.*, config_menu_akses.id_akses FROM config_menu INNER JOIN config_menu_akses ON config_menu.id_menu=config_menu_akses.id_menu WHERE id_parent=0 AND flag=1 AND id_role=$role AND baca=1");
		foreach($induk->result() as $row){

			$y = $CI->db->query(" SELECT COUNT(config_menu_akses.id_menu) as jml FROM config_menu INNER JOIN config_menu_akses WHERE id_parent=$row->id_menu AND flag=1 AND id_role=$role AND baca=1")->row();
			$x = $y->jml;
			if ($x !=0){?>
				<li class="treeview"><?php echo anchor("#","<i class='".$row->icon."'></i><span>". $row->nama_menu."</span><i class='fa fa-angle-left pull-right'></i>");?>
				<ul class="treeview-menu">
			<?php $anak = $CI->db->query(" SELECT config_menu.*, config_menu_akses.id_akses FROM config_menu INNER JOIN config_menu_akses ON config_menu.id_menu=config_menu_akses.id_menu WHERE id_parent=$row->id_menu AND flag=1 AND id_role=$role AND baca=1");
				foreach($anak->result() as $baris){?>
					<li><?php echo anchor($baris->url_pages,"<i class='".$baris->icon."'></i><span>".$baris->nama_menu."</span>");?></li>
				<?php
				}
				echo "</ul></li>";
			}else{?>
				<li><?php echo anchor($row->url_pages,"<i class='".$row->icon."'></i><span>".$row->nama_menu."</span>");?></li>
			<?php
			}
		}

	}

/***********************************************************************************************************/
		function menu_header()
		{
?>
			<style type="text/css">
				.navbar-custom-menu>.navbar-nav>li>a
				{
				    margin-top: 11px;
					margin-bottom: 11px;
				}

				.navbar-nav>.notifications-menu>.dropdown-menu>li .menu>li>a:hover, .navbar-nav>.messages-menu>.dropdown-menu>li .menu>li>a:hover, .navbar-nav>.tasks-menu>.dropdown-menu>li .menu>li>a:hover,
				.navbar-custom-menu>.navbar-nav>li:hover,
				.dropdown-menu > .menu_header:hover
				{
					background-color: #0163D0!important;
				}

				.dropdown-menu > .menu_header > li > a > i,
				.dropdown-menu > .menu_header > li > a > span
				{
					color: #fff;
				}

				.dropdown-menu > .menu_header
				{
					background-color: #00BCD4!important;
					list-style: none;
				}

				.dropdown-menu > li
				{
					background-color: #00BCD4!important
				}

				.dropdown-menu > .header
				{
					background-color: #fff!important;
				}

	            .noti-container
	            {
	                background-color: #fff;
	                border-radius: 5px;
	                box-shadow: 0 3px 8px #222;
	                overflow: visible;
	                position: absolute;
				    margin-left: -345px;
				    width: 550px;
	                color: #444;
	                z-index: 2;
	                display: none;
					height:auto;
	                &:before
	                {
	                    content: "";
	                    display: block;
	                    position: absolute;
	                    width: 0;
	                    height: 0;
	                    color: transparent;
	                    border: 10px solid #000;
	                    border-color: transparent transparent #fff;
	                    margin-top: -20px;
	                    margin-left: 115px;
	                }
	            }

                .noti-title
                {
                    /*display: none;*/
                    width: 100%;
                    padding: 5%;
                    margin-left: auto;
                    margin-right: auto;
                    border-bottom: 2px solid #ddd;
                    position: relative;
                    z-index: 100;
                }

                .new-noti-title
                {
                    font: 13px bold "Helvetica Neue", Helvetica, Arial, sans-serif;
                    text-align: center;
                    line-height: 30px;
                }

                .noti-count
                {
                    &:extend(.noti-count-extend);
                    width: 20px;
                    height: 20px;
                    border-radius: 10px;
                    font-size: 10px;
                    line-height: 20px;
                    margin-left: 5px;
                    margin-top: 5px;
                }

                .noti-body
                {
                    list-style-type: none;
                    margin: 0;
                    padding: 0;
                    max-height: 220px;
                    overflow: auto;
                }

                .noti-text
                {
					padding-top: 9px!important;
					padding-bottom: 41px!important;
                    display: block;
                    cursor: pointer;
                    width: 98%;
                    padding: 5%;
                    /*line-height: 53px;*/
                    background-color: #e9eff2;
                    border-bottom: 1px solid #ddd;
                    &.has-read {
						background-color: #fff;
                    }
                }

                .noti-text > a
                {
					position: initial;
					padding-top: 30px;
					padding-bottom: 5px;
                }

                .noti-footer {
                    cursor: pointer;
                    text-align: center;
                    font: 13px bold "Helvetica Neue", Helvetica, Arial, sans-serif;
                    padding: 8px;
                    border-top: 2px solid #ddd;
                }

			</style>
			<script>
			    window.onload = function() {
			        var oid    = getCookie("row_inbox");
			        if (oid != 0)
			        {
						document.getElementById("messages-notify").innerHTML = oid;
			        }
				}
				
				$(document).ready(function() {
					var self          = this;
					var notiTabOpened = false;
					var notiCount     = window.localStorage.getItem('notiCount');
					if(parseInt(notiCount, 10) > 0) {
						var nodeItems =  window.localStorage.getItem('nodeItems');
						$('.noti-count').html(notiCount);
						$('#nav-noti-count').css('display', 'inline-block');
					}

					$('#noti-tab').click(function() {
					    notiTabOpened = true;
					    if(notiCount) {
							$('#nav-noti-count').fadeOut('slow');
							$('.noti-title').css('display', 'inline-block');
					    }
					    $('.noti-container').toggle(300);
					    return false;
					});

					$('#box-container').click(function() {
					    $('.noti-container').hide();
					    notiTabOpened = false;
					});

					$('.noti-container').click(function(evt) {
					    evt.stopPropagation();
					    return false;
					});

					$('.noti-body .noti-text').on('click', function(evt) {
					    addClickListener(evt);
					});

					var addClickListener = function(evt) {
					    evt.stopPropagation();
					}

					$('.noti-footer').click(function() {
					    notiCount = 0;
					    window.localStorage.setItem('notiCount', notiCount);
					    $('.noti-title').hide();
					    $('.noti-text').addClass('has-read');
					});
				});

				function goto_link(params) {
					window.location.href = "<?=base_url();?>"+params;
				}
			</script>
<?php
			$CI          =& get_instance();
			$id          = $CI->session->userdata('sesUser');
			$role        = $CI->session->userdata('sesRole');
			$posisi      = $CI->session->userdata('sesIdPos');

			$infoPegawai = $CI->Globalrules->get_info_pegawai();
			$induk       = $CI->db->query(" SELECT config_menu.*,
													config_menu_akses.id_akses
											FROM config_menu
											INNER JOIN config_menu_akses
											ON config_menu.id_menu=config_menu_akses.id_menu
											WHERE id_parent=0
											AND flag=1
											AND id_role=$role
											AND baca=1
											ORDER BY prioritas asc"
										);
			$notify       = $CI->db->query("SELECT a.*,
													COALESCE(
																(
																	SELECT bb.photo
																	FROM mr_pegawai aa
																	JOIN mr_pegawai_photo bb
																	ON aa.id = bb.id_pegawai
																	WHERE aa.id = a.sender
																	AND bb.main_pic = 1
																	AND aa.local = bb.local
																),'-'
															) as photo_sender
											FROM log_notifikasi a
											WHERE a.receiver = '".$id."'
											AND a.status_read = 0
											ORDER BY a.id DESC"
										);
			$count_notify = count($notify->result());
?>
            <nav class="navbar navbar-static-top" role="navigation" style="background-color: #00a7d0;height: 73px;">
                <div class="navbar-custom-menu pull-left">
				    <a href="#" class="sidebar-toggle hidden-lg hidden-md" data-toggle="offcanvas" role="button">
				        <span class="sr-only">Toggle navigation</span>
				    </a>
				    <a href="<?php echo site_url();?>" class="logo" style="background-color: #00a7d0;height:100%;width:175px;">
						<img src="<?php echo base_url();?>assets_home/logo.png" alt="logo" style="height: 58px;width: 140px;">
				    </a>
					<ul class="nav navbar-nav hidden-xs">
<?php
						foreach($induk->result() as $row)
						{
							$y = $CI->db->query("SELECT COUNT(config_menu_akses.id_menu) as jml
												FROM config_menu
												INNER JOIN config_menu_akses
												WHERE id_parent = '".$row->id_menu."'
												AND flag=1
												AND id_role = '".$role."'
												AND baca=1"
											)->row();
							$x = $y->jml;
							if ($x !=0){
?>
					            <li class="dropdown user user-menu">
					                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
					                    <i class="<?=$row->icon;?>"></i>
					                    <span style='padding-left: 10px;'><?=$row->nama_menu;?></span>
					                    <b class="caret"></b>
					                </a>
			                		<ul class="dropdown-menu" style="width: 560%;height: 300%;background-color: transparent;border-color: transparent;">
<?php
										$anak = $CI->db->query(" SELECT config_menu.*,
																		config_menu_akses.id_akses
																FROM config_menu
																INNER JOIN config_menu_akses
																ON config_menu.id_menu=config_menu_akses.id_menu
																WHERE id_parent=$row->id_menu
																AND flag=1
																AND id_role=$role
																AND baca=1
																ORDER BY prioritas ASC, nama_menu ASC"
															);
										foreach($anak->result() as $baris)
										{
											$style_ul = "";
											$change_name = $baris->nama_menu;
											if (
													$baris->url_pages == 'transaksi/kinerja_anggota/0' ||
													$baris->url_pages == 'transaksi/kinerja_anggota/4' ||
													$baris->url_pages == 'transaksi/kinerja_anggota/6' ||
													$baris->url_pages == 'skp/approval_target_skp' ||
													$baris->url_pages == 'skp/penilaian_skp' ||
													$baris->url_pages == 'skp/approval_target_skp'

												)
											{
												# code...
												$get_menu_activy = $CI->db->query("SELECT a.*
																					FROM mr_pegawai a
																					JOIN mr_posisi b
																					ON a.posisi = b.id
																					WHERE b.atasan = '".$posisi."'");

												if (count($get_menu_activy->result()) != 0)
												{

?>
								                    <ul class="user-footer col-lg-10 menu_header menu_1">
								                        <li>
															<?php echo anchor($baris->url_pages,"<i class='".$baris->icon."'></i><span style='padding-left: 10px;'>".$change_name."</span>",array('class' => 'col-lg-12'));?>
								                        </li>
								                    </ul>
<?php
												}
											}
											else
											{
												if (count($anak->result()) > 7) {
													# code...
?>
							                    <ul class="user-footer col-lg-6 menu_header menu_1">
							                        <li>
														<?php echo anchor($baris->url_pages,"<i class='".$baris->icon."'></i><span style='padding-left: 10px;'>".$change_name."</span>",array('class' => 'col-lg-12'));?>
							                        </li>
							                    </ul>
<?php													
												}
												else
												{
?>
							                    <ul class="user-footer col-lg-10 menu_header menu_1">
							                        <li>
														<?php echo anchor($baris->url_pages,"<i class='".$baris->icon."'></i><span style='padding-left: 10px;'>".$change_name."</span>",array('class' => 'col-lg-12'));?>
							                        </li>
							                    </ul>
<?php
												}
											}
?>
<?php
										}
?>
									</ul>
								</li>
<?
							}
							else
							{
?>
								<li><?php echo anchor($row->url_pages,"<i class='".$row->icon."'></i><span style='padding-left: 10px;'>".$row->nama_menu."</span>");?></li>
<?php
							}
						}
?>
					</ul>
				</div>

				<div class="navbar-custom-menu hidden-xs">
		            <ul class="nav navbar-nav pull-right">
						<li class="dropdown tasks-menu">
						    <a class="click-notify" href="<?php echo site_url()?>/pesan/home">
										<i class="fa fa-envelope" style="padding-right:10px;"></i>
						        <span>Pesan</span>
						        <span class="label label-danger inbox-notif" id="messages-notify"></span>
						    </a>
						</li>
						<li class="dropdown notifications-menu" id="noti-tab">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-bell-o" style="font-size: 26px;"></i>
								<span>Pemberitahuan<span>
								<span class="label label-warning" style="font-size: 14px;"><?php echo $count_notify;?></span>
							</a>

							<div class="noti-container">
						        <div class="noti-title">
									<span class="new-noti-title">Anda mempunyai <?php echo $count_notify;?> Pemberitahuan </span>
									<span class="noti-count" id="noti-container-count"></span>
						        </div>
						        <ul class="noti-body">
<?php
									foreach($notify->result() as $row_notify)
									{
										$photo_sender = "";
										if ($row_notify->photo_sender == '-') {
											# code...
											$photo_sender = '<img class="icn_user" src="'.base_url().'assets/images/businessman1.jpg">';
										}
										else
										{
											$photo_sender = '<img class="icn_user" src="http://sikerja.kemendagri.go.id/images/demo/users/'.$row_notify->photo_sender.'">';
										}

										if ($row_notify->status_log == 'notify') {
											# code...
?>
								        	<li class="noti-text">
												<a href="<?php echo site_url();?>/Admin/redirect_notifikasi/<?php echo $row_notify->id?>">
									        		<div class="col-lg-3" style="padding-left: 0px;padding-right: 0px;">
										        		<?php echo $photo_sender;?>
									        		</div>
													<?php echo $row_notify->remarks;?>
													<div class="col-lg-9 pull-right">
														<label class="pull-right"><?php echo $row_notify->audit_time;?></label>
													</div>
												</a>
								        	</li>

<?php
										}
										else
										{
?>
								        	<li class="noti-text">
												<a href="<?php echo site_url().'/'.$row_notify->url;?>">
									        		<div class="col-lg-3" style="padding-left: 0px;padding-right: 0px;">
										        		<?php echo $photo_sender;?>
									        		</div>
													<?php echo $row_notify->remarks;?>
													<div class="col-lg-9 pull-right">
														<label class="pull-right">[Approval] <?php echo $row_notify->audit_time;?></label>
													</div>
												</a>
								        	</li>
<?php
										}
									}
?>
						        </ul>
						        <div class="noti-footer">
									<div class="col-lg-6">
										<button class="btn btn-default btn-flat pull-left">
											<i class="fa fa-check-circle-o"></i>
											Telah Melihat semua pemberitahuan										
										</button> 
									</div>									
									<div class="col-lg-6">
										<a class="btn btn-default btn-flat pull-right" onclick="goto_link('dashboard/view_notification')">
											<i class="fa fa-eye"></i>
											Lihat semua pemberitahuan
										</a>
									</div>
								</div>
							</div>
						</li>
		                <li class="dropdown user user-menu">
		                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="margin-top: 0px;
																						    margin-bottom: 0px;
																						    padding-bottom: 1px;
																						    padding-top: 1px;
																						    padding-right: 5px;
																						    padding-left: 5px;">
				            <?php
				                if($infoPegawai != '')
				                {
				            ?>
				            <?php
				                    if ($infoPegawai[0]->photo == '-') {
				                        # code...
				            ?>
				                        <img class="icn_user" src="http://mandarinpalace.fi/wp-content/uploads/2015/11/businessman.jpg">
				            <?php
				                    }
				                    else
				                    {
				                        if ($infoPegawai[0]->local == 1) {
				                            # code...
				            ?>
				                            <img class="icn_user" src="<?php echo base_url() . 'public/images/pegawai/'.$infoPegawai[0]->photo;?>">
				            <?php
				                        }
				                        else
				                        {
				            ?>
				                            <img class="icn_user" src="http://sikerja.kemendagri.go.id/images/demo/users/<?=$infoPegawai[0]->photo;?>">
				            <?php
				                        }
				                    }
				                }
				                else
				                {
				            ?>
				                        <img class="icn_user" src="http://mandarinpalace.fi/wp-content/uploads/2015/11/businessman.jpg">
				            <?php
				                }
				            ?>
		                    </a>
		                    <ul class="dropdown-menu" style="left: auto;">
								<li class="user-footer">
									<div class="pull-left">
									<?php echo anchor('admin/change_password','Ubah Password',array('class'=>'btn btn-default btn-flat'));?>
									</div>
									<div class="pull-right">
									<?php echo anchor('admin/loginadmin/signout','Keluar',array('class'=>'btn btn-default btn-flat'));?>
									</div>
								</li>
		                    </ul>
		                </li>
		            </ul>
				</div>
			</nav>

			<aside class="main-sidebar hidden-md hidden-lg hidden-sm" style="padding-top: 0px;">
			    <section class="sidebar" style="height: auto;">
				<ul class="sidebar-menu" style="background-color: #00a7d0;">
				<li class="header"></li>
				<?php	menuSamping();	?>
				</ul>
			    </section>
			</aside>
<?
		}
/***********************************************************************************************************/
		function status_pekerjaan($posisi,$status)
		{
			# code...
			$CI     =& get_instance();
			$get_count_transact = $CI->db->query("SELECT count(a.id_pekerjaan) as jumlah
												FROM tr_capaian_pekerjaan a
												JOIN mr_pegawai b
												ON a.id_pegawai = b.id
												JOIN mr_posisi c
												ON b.posisi = c.id
												JOIN mr_uraian_tugas d
												ON a.id_uraian_tugas = d.id_urtug
												WHERE a.tanggal_mulai LIKE '%".date('Y-m')."%'
												AND a.tanggal_selesai LIKE '%".date('Y-m')."%'
												AND c.atasan = '".$posisi."'
												AND a.status_pekerjaan = '".$status."'");
			return $get_count_transact->result()[0]->jumlah;
		}

		function status_pekerjaan_banding($id,$status)
		{
			# code...
			$CI     =& get_instance();
			$get_count_transact = $CI->db->query("SELECT count(a.id_pekerjaan) as jumlah
				FROM tr_capaian_pekerjaan a
				JOIN mr_uraian_tugas b ON a.id_uraian_tugas = b.id_urtug
				JOIN mr_pegawai c ON a.id_pegawai = c.id
				WHERE a.tanggal_mulai LIKE '%".date('Y-m')."%'
				AND a.tanggal_selesai LIKE '%".date('Y-m')."%'
				AND a.id_pegawai_es2_banding = '".$id."'
				AND a.status_pekerjaan = '".$status."'");
			return $get_count_transact->result()[0]->jumlah;
		}

		function menuSampingBACKUP(){
			$CI =& get_instance();
			$role = $CI->session->userdata('sesRole');
			$induk = $CI->db->query(" SELECT * FROM config_menu WHERE id_parent=0 ");
			foreach($induk->result() as $row){

				$y = $CI->db->query(" SELECT COUNT(id_menu) as jml FROM config_menu WHERE id_parent=$row->id_menu ")->row();
				$x = $y->jml;
				if ($x !=0){?>
					<li class="treeview"><?php echo anchor("#","<i class='".$row->icon."'></i><span>". $row->nama_menu."</span><i class='fa fa-angle-left pull-right'></i>");?>
					<ul class="treeview-menu">
				<?php $anak = $CI->db->query(" SELECT * FROM config_menu WHERE id_parent=$row->id_menu ");
					foreach($anak->result() as $baris){?>
						<li><?php echo anchor($baris->url_pages,"<i class='".$baris->icon."'></i><span>".$baris->nama_menu."</span>");?></li>
					<?php
					}
					echo "</ul></li>";
				}else{?>
					<li><?php echo anchor($row->url_pages,"<i class='".$row->icon."'></i><span>".$row->nama_menu."</span>");?></li>
				<?php
				}
			}

		}

		function treeview($role){
			$CI =& get_instance();
			$induk = $CI->db->query("SELECT config_menu.*,
											config_menu_akses.id_akses,
											config_menu_akses.buat,
											config_menu_akses.baca,
											config_menu_akses.ubah,
											config_menu_akses.hapus
									FROM config_menu
									INNER JOIN config_menu_akses
									ON config_menu.id_menu=config_menu_akses.id_menu
									WHERE id_role=$role
									AND config_menu.flag <> 0
									AND id_parent=0
									AND flag=1");
			foreach($induk->result() as $row){?>
				<tr>
					<td><?php echo "<i class='".$row->icon."'></i> ".$row->nama_menu; ?></td>
					<td><?php if ($row->buat == 0){echo "<input id=cr".$row->id_akses." name='name_cr' class='minimal name_cr' type='checkbox' value=".$row->buat." onclick='create(".$row->id_akses.")'>";}else{echo "<input id=cr".$row->id_akses." class='minimal' type='checkbox' value=".$row->buat." onclick='create(".$row->id_akses.")' checked >";} ?></td>
					<td><?php if ($row->baca == 0){echo "<input id=re".$row->id_akses." name='name_re' class='minimal name_re' type='checkbox' value=".$row->baca." onclick='read(".$row->id_akses.")'>";}else{echo "<input id=re".$row->id_akses." class='minimal' type='checkbox' value=".$row->baca." onclick='read(".$row->id_akses.")' checked >";} ?></td>
					<td><?php if ($row->ubah == 0){echo "<input id=up".$row->id_akses." name='name_up' class='minimal name_up' type='checkbox' value=".$row->ubah." onclick='update(".$row->id_akses.")'>";}else{echo "<input id=up".$row->id_akses." class='minimal' type='checkbox' value=".$row->ubah." onclick='update(".$row->id_akses.")' checked >";} ?></td>
					<td><?php if ($row->hapus == 0){echo "<input id=de".$row->id_akses." name='name_de' class='minimal name_de' type='checkbox' value=".$row->hapus." onclick='delet(".$row->id_akses.")'>";}else{echo "<input id=de".$row->id_akses." class='minimal' type='checkbox' value=".$row->hapus." onclick='delet(".$row->id_akses.")' checked >";} ?></td>
				</tr>

			<?php $anak = $CI->db->query(" SELECT config_menu.*,
												  config_menu_akses.id_akses,
												  config_menu_akses.buat,
												  config_menu_akses.baca,
												  config_menu_akses.ubah,
												  config_menu_akses.hapus
											FROM config_menu
											INNER JOIN config_menu_akses
											ON config_menu.id_menu=config_menu_akses.id_menu
											WHERE id_role=$role
											AND config_menu.flag <> 0											
											AND id_parent=$row->id_menu");
				foreach ($anak->result() as $baris){?>
					<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<i class='".$baris->icon."'></i> ". $baris->nama_menu;?></td>
					<td><?php if ($baris->buat == 0){echo "<input id=cr".$baris->id_akses." class='minimal name_cr' type='checkbox' value=".$baris->buat." onclick='create(".$baris->id_akses.")'>";}else{echo "<input id=cr".$baris->id_akses." class='minimal' type='checkbox' value=".$baris->buat." onclick='create(".$baris->id_akses.")' checked >";} ?></td>
					<td><?php if ($baris->baca == 0){echo "<input id=re".$baris->id_akses." class='minimal name_re' type='checkbox' value=".$baris->baca." onclick='read(".$baris->id_akses.")'>";}else{echo "<input id=re".$baris->id_akses." class='minimal' type='checkbox' value=".$baris->baca." onclick='read(".$baris->id_akses.")' checked >";} ?></td>
					<td><?php if ($baris->ubah == 0){echo "<input id=up".$baris->id_akses." class='minimal name_up' type='checkbox' value=".$baris->ubah." onclick='update(".$baris->id_akses.")'>";}else{echo "<input id=up".$baris->id_akses." class='minimal' type='checkbox' value=".$baris->ubah." onclick='update(".$baris->id_akses.")' checked >";} ?></td>
					<td><?php if ($baris->hapus == 0){echo "<input id=de".$baris->id_akses." class='minimal name_de' type='checkbox' value=".$baris->hapus." onclick='delet(".$baris->id_akses.")'>";}else{echo "<input id=de".$baris->id_akses." class='minimal' type='checkbox' value=".$baris->hapus." onclick='delet(".$baris->id_akses.")' checked >";} ?></td>
				</tr>
				<?php }
			}


	}

	function selisihMenit($awal,$akhir){
		$t_awal 	= explode(":",$awal);
		$t_akhir 	= explode(":",$akhir);
		$difJam 	= $t_akhir[0] - $t_awal[0];
		$difMenit	= $t_akhir[1] - $t_awal[1];
		$total		= ($difJam * 60) + $difMenit;
		return $total;
	}

	function random($panjang)
	{
	   $pengacak = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	   $string = '';
	   for($i = 0; $i < $panjang; $i++) {
	   $pos = rand(0, strlen($pengacak)-1);
	   $string .= $pengacak{$pos};
	   }
	    return $string;
	}
?>
