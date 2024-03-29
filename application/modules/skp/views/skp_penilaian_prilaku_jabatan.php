<style>
/* body {
  padding: 50px;
  display: flex;
  flex-flow: wrap;
  font-family: "Ubuntu", sans-serif;
}
body * {
  box-sizing: border-box;
} */

.card-container {
  flex: 300px;
  margin: 30px;
}
.card-container .card {
  font-weight: bold;
  position: relative;
  width: 100%;
}
.card-container .card a {
  padding: 30px;
  width: 100%;
  height: 400px;
  border: 2px solid black;
  background: white;
  text-decoration: none;
  color: black;
  display: block;
  transition: 0.25s ease;
}
.card-container .card a:hover {
  transform: translate(-30px, -30px);
  border-color: #5bc0eb;
}
.card-container .card a:hover .card--display {
  display: none;
}
.card-container .card a:hover .card--hover {
  display: block;
}
.card-container .card a .card--display i {
  font-size: 45px;
  margin-top: 180px;
}
.card-container .card a .card--display h2 {
  margin: 20px 0 0;
}
.card-container .card a .card--hover {
  display: none;
}
.card-container .card a .card--hover h2 {
  margin: 20px 0;
}
.card-container .card a .card--hover p {
  font-weight: normal;
  line-height: 1.5;
}
.card-container .card a .card--hover p.link {
  margin: 20px 0 0;
  font-weight: bold;
  color: #5bc0eb;
}
.card-container .card .card--border {
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  border: 2px dashed black;
  z-index: -1;
}
.card-container .card.card--dark a {
  color: white;
  background-color: black;
  border-color: black;
}
.card-container .card.card--dark a .card--hover .link {
  color: #fde74c;
}
</style>
<?php
  $counter = 0;
	if ($request_history != 0) {
		# code...
		for ($i=0; $i < count($request_history); $i++) { 
      if ($request_history[$i]->tahun == date('Y')) {
        # code...
        $counter++;
        ?>
        <div class="card-container col-lg-3"> 
          <div class="card">
            <a href="<?php echo site_url()?>skp/penilaian_prilaku/data/<?php echo $request_history[$i]->pegawai?>/<?php echo $request_history[$i]->posisi?>/<?=$request_history[$i]->tahun;?>">
              <?=$request_history[$i]->tahun;?>          
              <div class="card--display">
                <i class="fa fa-street-view"></i>
                <?=$request_history[$i]->nama_pegawai;?>              
                <h2><?php echo $request_history[$i]->nama_posisi ?></h2>
              </div>
              <div class="card--hover">
                <h2><?php echo $request_history[$i]->nama_posisi ?></h2>
                <p><?=$request_history[$i]->nama_eselon4.' '.$request_history[$i]->nama_eselon3.' '.$request_history[$i]->nama_eselon2.$request_history[$i]->nama_eselon1;?></p>
                <p class="link">Klik untuk melihat</p>
              </div>
            </a>
            <div class="card--border"></div>
          </div>
        </div>
        <?php        
      }
      else
      {

      }
		}		
	}

  if ($counter == 0) {
    # code...
    ?>
    <h2 align="center">Anda belum membuat target skp untuk tahun ini</h2>
    <?php    
  }
?>
