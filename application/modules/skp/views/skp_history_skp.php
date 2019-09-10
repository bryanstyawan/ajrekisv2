<style>
@import url('https://fonts.googleapis.com/css?family=Questrial');
html {
  min-height: 100%;
}

.box {
  width: 800px;
  margin: 10% auto;
  position: relative;
}
#card-container {
  position: relative;
  margin: 30px;
  width: 200px;
  height: 200px;
  z-index: 1;
  float: left;
  perspective: 1000px;
}
img {
  width: 200px;
  height: 200px;
}
#card, #card2, #card3 {
  width: 100%;
  height: 100%;
  margin: 10%;
  transform-style: preserve-3d;
  transition: all 0.8s linear;
  box-shadow: 5px 5px 15px rgba(0, 0, 0, .3);
}
#card:hover {
  transform: rotateY(180deg);
  box-shadow: -5px 5px 15px rgba(0, 0, 0, .3);
}
#card2:hover {
  transform: rotateY(-180deg);
  box-shadow: -5px 5px 15px rgba(0, 0, 0, .3);
}
#card3:hover {
  transform: rotateX(180deg);
  box-shadow: 5px -5px 15px rgba(0, 0, 0, .3);
}
#card3 .back {
  transform: rotateX(-180deg);
}
.face {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
}
.back {
  display: block;
  transform: rotateY(180deg);
  box-sizing: border-box;
  padding: 10px;
  text-align: center;
  opacity: 0.7;
  background: #f9f3e4;
}

.back.face > a > h1, 
.back.face > a > p 
{
    font-family: 'Questrial', sans-serif;
    text-transform: uppercase;
    letter-spacing: 2px;    
    font-size: 1.2em;
    padding-top: 15px;
    color: #dd899e;    
}

.front.face > div > h5,
.front.face > div > p
{
    padding-left: 10px;    
}

.date {
  color: #d0b2af;
}
</style>
 
<?php
	if ($request_history != 0) {
		# code...
		for ($i=0; $i < count($request_history); $i++) { 
			?>
			<div id="card-container">
				<div id="card">
					<div class="front face" style="background: #f9f3e4">
						<div style="margin-top: 80px;">
							<h5 class="card-title"><?php echo $request_history[$i]->nama_pegawai ?></h5>
						</div>
						<div>
							<p class="card-text" style="color:red;"><?php echo $request_history[$i]->nama_posisi ?></p>
						</div>
					</div>
					<div class="back face">
						<a href="<?php echo site_url()?>skp/cetak_history_skp/<?php echo $request_history[$i]->pegawai?>/<?php echo $request_history[$i]->posisi?>/<?php echo $request_history[$i]->nama_posisi?>">
							<h1><?php echo $request_history[$i]->nama_posisi ?></h1>
						</a>        
						<p class="artist"><?php echo $request_history[$i]->tanggal_laku?></p>
						<!-- <p class="date">2015</p> -->
					</div>
				</div>
			</div>
			<?php
		}		
	}
?>