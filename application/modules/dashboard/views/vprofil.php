<div class="col-md-3">
    <!-- Profile Image -->
    <div class="box box-primary">
        <div class="box-body box-profile">
			<?php 
                $pp = array (
                				'src' => 'img/admin/'.$pegawai->photo,
                				'class' => 'profile-user-img img-responsive img-circle'
                			);
			    echo img($pp);
            ?>
            <h3 class="profile-username text-center"><?php echo $pegawai->nama_pegawai; if($pegawai->gender == "L"){echo " <i class='fa fa-mars'></i>";}else{echo " <i class='fa fa-venus'></i>";}?></h3>
            <p class="text-muted text-center"><?php echo "<u>".$pegawai->nip."</u><br>".$pegawai->nama_posisi;?></p>
            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Pekerjaan Pending</b> <a class="pull-right"><?php echo $pending;?></a>
                </li>
                <li class="list-group-item">
                  <b>Pekerjaan Diterima</b> <a class="pull-right"><?php echo $terima;?></a>
                </li>
				<li class="list-group-item">
                  <b>Pekerjaan Ditolak</b> <a class="pull-right"><?php echo $tolak;?></a>
                </li>
                <li class="list-group-item">
                  <b>Pekerjaan Direvisi</b> <a class="pull-right"><?php echo $revisi;?></a>
                </li>
				<li class="list-group-item">
                  <b>Pekerjaan Keberatan</b> <a class="pull-right"><?php echo $banding;?></a>
                </li>
            </ul>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

                  

            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                 <li class="active"><a href="#activity" data-toggle="tab">Informasi</a></li>
                  <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
                </ul>
                <div class="tab-content">
					<div class="active tab-pane" id="activity">
                    <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                      <tbody>
                        <tr>
                          <td class="mailbox-star" width="3%"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                          <td class="mailbox-name" width="20%"><a href="#">Eselon 1</a></td>
                          <td class="mailbox-subject"><?php echo $pegawai->nama_eselon1;?></td>
                        </tr>
						<tr>
                          <td class="mailbox-star" width="3%"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                          <td class="mailbox-name" width="20%"><a href="#">Eselon 2</a></td>
                          <td class="mailbox-subject"><?php echo $pegawai->nama_eselon2;?></td>
                        </tr>
						<tr>
                          <td class="mailbox-star" width="3%"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                          <td class="mailbox-name" width="20%"><a href="#">Eselon 3</a></td>
                          <td class="mailbox-subject"><?php echo $pegawai->nama_eselon3;?></td>
                        </tr>
						<tr>
                          <td class="mailbox-star" width="3%"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                          <td class="mailbox-name" width="20%"><a href="#">Eselon 4</a></td>
                          <td class="mailbox-subject"><?php echo $pegawai->nama_eselon4;?></td>
                        </tr>
						<tr>
                          <td class="mailbox-star" width="3%"><a href="#"><i class="fa fa-group text-yellow"></i></a></td>
                          <td class="mailbox-name" width="20%"><a href="#">Golongan</a></td>
                          <td class="mailbox-subject"><?php echo "II A (Pengatur Muda)" ;?></td>
                        </tr>
						<tr>
                          <td class="mailbox-star" width="3%"><a href="#"><i class="fa fa-calendar text-yellow"></i></a></td>
                          <td class="mailbox-name" width="20%"><a href="#">TMT masa kerja</a></td>
                          <td class="mailbox-subject"><?php echo date('d-F-Y',strtotime($pegawai->tgl_gabung));?></td>
                        </tr>
                      </tbody>
                    </table><!-- /.table -->
                  </div><!-- /.mail-box-messages -->
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <ul class="timeline timeline-inverse">
                     
                      <li class="time-label">
                        <span class="bg-green">
                          15-Februaru-2016
                        </span>
                      </li>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-thumbs-up bg-purple"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 13:27</span>
                          <h3 class="timeline-header"><a href="#"><?php echo "Ibu Gilang";?></a> Menyetujui pekerjaan <?php echo $pegawai->nama_pegawai;?></h3>
                          <div class="timeline-body">
                           Membuat Laporan pertanggung jawaban bagian kepegawaian.
                          </div>
                        </div>
                      </li>
					  <li>
                        <i class="fa fa-plus-circle bg-yellow"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 10:15</span>
                          <h3 class="timeline-header"><a href="#"><?php echo $pegawai->nama_pegawai;?></a> Menambah Pekerjaan Baru</h3>
                          <div class="timeline-body">
                           Membuat Laporan pertanggung jawaban bagian kepegawaian.
                          </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                      </li>
                    </ul>
                  </div>
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
			<input type="hidden" id="id_pegawai" value="<?php echo $pegawai->id;?>">
<script>
	function setting(id){
		$.getJSON('<?php echo site_url() ?>/dashboard/setting/'+id,
		function( response ) {
			$("#oid").val(response['id']);
			$("#fnama").val(response['nama_pegawai']);
			$("#ftgl_lahir").val(response['tgl_lahir']);
			$("#falamat").val(response['alamat']);
			$("#fagama").val(response['agama']);
			$("#fstatus_nikah").val(response['status_nikah']);
		}
	);
	}
  $(document).ready(function(){
	  $("#simpan").click(function(){
		  var oid = $("#oid").val();
		  var nama = $("#fnama").val();
		  var lahir = $("#ftgl_lahir").val();
		  var alamat = $("#falamat").val();
		  var gender= $('input[name=fgender]:checked').val();
		  var agama = $("#fagama").val();
		  var status_nikah = $("#fstatus_nikah").val();
		  var pass1 = $("#password").val();
		  var pass2 = $("#password2").val();
		  if(pass1 != pass2){
					Lobibox.notify('error', {
					msg: 'Password Tidak Sama'
					});
					return false
				}else{
					$.ajax({
					url :"<?php echo site_url();?>/dashboard/editProfil",
					type:"post",
					data:"oid="+oid+"&nama="+nama+"&lahir="+lahir+"&alamat="+alamat+"&gender="+gender+"&agama="+agama+"&status_nikah="+status_nikah
					+"&pass="+pass2,
					success:function(){
					Lobibox.notify('success', {
						msg: 'Data Berhasil Dirubah'
					});
				
					}
					})
				}
	  })
  })
</script>