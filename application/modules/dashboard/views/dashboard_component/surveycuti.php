


 
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"><script src="kuisioner/jquery.min.js"></script>  
<link rel="stylesheet" href="kuisioner/bootstrap.min.css" /> 
<script src="kuisioner/bootstrap.min.js"></script> 

<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#form1 {
  background-color: #ffffff;
  margin: 50px auto;
  font-family: Raleway;
  font-size: 17px;
  padding: 10px;
  width: 50%;
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
</style>


 
<body>


<div id="modal-infosurvey" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" style="color:red; text-align:center">INFORMASI</h1>
      </div>
      <div class="modal-body">
        <h2 style="color:blue; text-align:left">	Kepada Yth. </br>
		Bapak/Ibu Pegawai Negeri Sipil </br>
		Di Lingkungan Kementerian Dalam Negeri</br></h2></br>
		<h2 style="color:blue; text-align:left"> Untuk meningkatkan pelayanan Cuti pada Biro Kepegawaian di Lingkungan Kementerian Dalam Negeri, kami minta kepada Bapak/Ibu untuk dapat memberikan Feed Back melalui kuisioner yang kami lampirkan pada link dibawah ini. Demikian kami sampaikan, atas kerjasamanya kami ucapkan terimakasih.</br>
		<h2 style="color:blue; text-align:center">Untuk Mengisi Survey silahkan klik disini <a href="https://forms.gle/fRKn8AX3T2S8gz1F9"> https://forms.gle/fRKn8AX3T2S8gz1F9</a> </h2>
		<h2 style="color:blue; text-align:center">Jika Anda sudah pernah isi, anda dapat tutup popup ini dengan mengklik tombol Close di bawah</h2>
		<h2 style="color:blue; text-align:center">	</br>
			
		
		<h1 style="color:blue; text-align:center">Terima Kasih</br></br>
		
		<button type="button" align="center" data-dismiss="modal">Close</button>
		<?
			$this->session->set_userdata('notifsurvey', 1);
		?>
      </div>
     <!--<div class="modal-footer">
        <button type="button" align="center" data-dismiss="modal">Close</button>
      </div>-->
    </div>

  </div>
</div>


<script>



</script>

