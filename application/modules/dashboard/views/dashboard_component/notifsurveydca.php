


 
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"><script src="kuisioner/jquery.min.js"></script>  
<link rel="stylesheet" href="kuisioner/bootstrap.min.css" /> 
<script src="kuisioner/bootstrap.min.js"></script> 

<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #00008b;
}

#form1 {
  background-color: #00008b;
  margin: 50px auto;
  font-family: Raleway;
  font-size: 17px;
  padding: 10px;
  width: 100%;
  min-width: 500px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

input.button-add {
   /*  background-image: url(/images/buttons/add.png); /* 16px x 16px */ */
    background-color: transparent; /* make the button transparent */
    background-repeat: no-repeat;  /* make the background image appear only once */
    background-position: 0px 0px;  /* equivalent to 'top left' */
    border: none;           /* assuming we don't want any borders */
    cursor: pointer;        /* make the cursor like hovering over an <a> element */
    height: 16px;           /* make this the size of your image */
    padding-left: 16px;     /* make text start to the right of the image */
    vertical-align: middle; /* align the text vertically centered */
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 2;
}

.step.active {
  opacity: 3;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}

.modal-body
{
    background-color: #00008b;
}

.modal-footer
{
    background-color: #00008b;
}

</style>

<?php
	$link = mysqli_connect("192.168.193.15", "sikerja_asn", "asnsikerja_2019", "sikerja_test");
	$nama = $this->session->userdata('sesNama') ;
	// jalankan query
	$result = mysqli_query($link, "SELECT HOUR(NOW()) as jam");
	$jamm = $result->num_rows;	
																			 
	if ($jamm != 0) {	
		 while ($row=mysqli_fetch_object($result))
		{
			$jam = $row->jam;
			if ($jam>1 && $jam<=10) {
			$waktu ="PAGI ... ";
			}else{
				if ($jam>10 && $jam<=14) {
					$waktu ="SIANG ... ";
				}else{
					if ($jam>14 && $jam<=18) {
						$waktu ="SORE ... ";
					}else{
						if ($jam>18 && $jam<=23) {
							$waktu ="MALAM ... ";
						}
					}
				}
				
			}
		}
			
		
	}
?>
 
<body>


<div id="modal-surveydca" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body">
		<h1 style="color:white;text-align:center;font-family:Comic Sans MS;"><b>SELAMAT <?php echo $waktu; echo $nama; ?> </h1>
		<h1 style="color:white;text-align:center"><b>Silahkan Mengisi Survey Digital Capability Assessment (DCA) dengan mengklik tautan di bawah ini</h1>
		<h1 style="color:white;text-align:center"><b><a href="https://www.surveymonkey.com/r/SurveiDCAKemendagri"><u>https://www.surveymonkey.com/r/SurveyDCAKemendagri</u></a></h1>
		<h2 style="color:red;text-align:center"><b>Batas Waktu Pengisian Survey DCA Sampai dengan 12 Januari 2022</h2>
		<h3 style="color:yellow;text-align:center"><b><i>(Close pesan ini jika Anda sudah pernah mengisi)</i></h3>
		
		<?
			$this->session->set_userdata('notifsurvey', 1);
		?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script>



</script>

