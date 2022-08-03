


 
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
</style>

<script type="text/javascript">
	 
 function tampilkan(){
	 
  var nama_jab=document.getElementById("form1").jabatan.value;
	
	document.getElementById("jenisdiklatpim").disabled = true; 
	document.getElementById("tgldiklatpim").disabled = true; 
	document.getElementById("tmpdiklatpim").disabled = true;
	document.getElementById("berkas").disabled = true;
	document.getElementById("tglselesaipim").disabled = true;
	document.getElementById("nosertifikatpim").disabled = true;
	document.getElementById("tglsertifikatpim").disabled = true;
	document.getElementById("jmljampim").disabled = true;
	document.getElementById("jenisdiklatjafung").disabled = true; 
	document.getElementById("tgldiklatjafung").disabled = true; 
	document.getElementById("tmpdiklatjafung").disabled = true;
	document.getElementById("berkasjafung").disabled = true;
	document.getElementById("tglselesaijafung").disabled = true;
	document.getElementById("nosertifikat").disabled = true;
	document.getElementById("tglsertifikat").disabled = true;
	document.getElementById("jmljam").disabled = true;
	document.getElementById("jenisdiklatjp").disabled = true; 
	document.getElementById("tgldiklatjp").disabled = true; 
	document.getElementById("tmpdiklatjp").disabled = true;
	document.getElementById("berkasjp").disabled = true;
	document.getElementById("tglselesaijp").disabled = true;
	document.getElementById("nosertifikatjp").disabled = true;
	document.getElementById("tglsertifikatjp").disabled = true;
	document.getElementById("jmljamjp").disabled = true;
	document.getElementById("jnsseminar").disabled = true; 
	document.getElementById("tglseminar").disabled = true; 
	document.getElementById("tmpseminar").disabled = true;
	document.getElementById("tglselesaismnr").disabled = true; 
	document.getElementById("nosertifikatsmnr").disabled = true;
	document.getElementById("tglsertifikatsmnr").disabled = true;
	document.getElementById("jmljamsmnr").disabled = true;
	document.getElementById("berkasseminar").disabled = true;
	document.getElementById("berkashukuman").disabled = true;
		
	if (nama_jab=="struktural") 
		{	
			document.getElementById("tampil").innerHTML="<option value='pilih'>--Pilih--</option><option value='sdhpim'>Sudah Diklat PIM</option><option value='blmpim'>Belum Diklat PIM</option>";
			// document.getElementById("tampiljafung").innerHTML="<option value='pilih'>--Pilih--</option><option value='sdhdiklatjafung'>Sudah Diklat Jab. Fungsional</option><option value='blmdiklatjafung'>Belum Diklat Jab. Fungsional</option>";
			document.getElementById("tampiljafung").innerHTML="<option value='blmdiklatjafung'>--lewati--</option>";
			document.getElementById("tgldiklatjafung").value = "01-01-1900"
			document.getElementById("tmpdiklatjafung").value = "-"
			document.getElementById("jenisdiklatjafung").value = "-"
			document.getElementById("tampil20jp").innerHTML="<option value='pilih'>--Pilih--</option><option value='sdhdiklat20jp'>Sudah Diklat 20 JP</option><option value='blm20jp'>Belum Diklat 20 JP</option>";
			document.getElementById("tampilseminar").innerHTML="<option value='pilih'>--Pilih--</option><option value='sdhseminar'>Sudah Ikut Seminar</option><option value='blmseminar'>Belum Ikut Seminar</option>";
			document.getElementById("nextBtn").innerHTML = "Berikutnya";
		}
	if (nama_jab=="fungsional")
    {
		
		document.getElementById("tampil").innerHTML="<option value='blmpim'>--lewati--</option>";
		document.getElementById("tgldiklatpim").value = "01-01-1900"
		document.getElementById("tmpdiklatpim").value = "-"
		document.getElementById("jenisdiklatpim").value = "-"
		document.getElementById("tampiljafung").innerHTML="<option value='pilih'>--Pilih--</option><option value='sdhdiklatjafung'>Sudah Diklat Jab. Fungsional</option><option value='blmdiklatjafung'>Belum Diklat Jab. Fungsional</option>";
		document.getElementById("tampil20jp").innerHTML="<option value='pilih'>--Pilih--</option><option value='sdhdiklat20jp'>Sudah Diklat 20 JP</option><option value='blm20jp'>Belum Diklat 20 JP</option>";
		document.getElementById("tampilseminar").innerHTML="<option value='pilih'>--Pilih--</option><option value='sdhseminar'>Sudah Ikut Seminar/Workshop/Magang/Kursus/sejenisnya</option><option value='blmseminar'>Belum Ikut Seminar/Workshop/Magang/Kursus/sejenisnya</option>";
		document.getElementById("nextBtn").innerHTML = "Berikutnya";
    }
	
	 if (nama_jab=="pelaksana")
    {
		
		document.getElementById("tampil").innerHTML="<option value='blmpim'>--lewati--</option>";
		document.getElementById("tgldiklatpim").value = "01-01-1900"
		document.getElementById("tmpdiklatpim").value = "-"
		document.getElementById("jenisdiklatpim").value = "-"
		document.getElementById("tampiljafung").innerHTML="<option value='blmdiklatjafung'>--lewati--</option>";
		document.getElementById("tgldiklatjafung").value = "01-01-1900"
		document.getElementById("tmpdiklatjafung").value = "-"
		document.getElementById("jenisdiklatjafung").value = "-"
		document.getElementById("tampil20jp").innerHTML="<option value='pilih'>--Pilih--</option><option value='sdhdiklat20jp'>Sudah Diklat 20 JP</option><option value='blm20jp'>Belum Diklat 20 JP</option>";
		document.getElementById("tampilseminar").innerHTML="<option value='pilih'>--Pilih--</option><option value='sdhseminar'>Sudah Ikut Seminar/Workshop/Magang/Kursus/sejenisnya</option><option value='blmseminar'>Belum Ikut Seminar/Workshop/Magang/Kursus/sejenisnya</option>";
		document.getElementById("nextBtn").innerHTML = "Berikutnya";
    }
	
	if (nama_jab=="CPNS")
    {
		document.getElementById("nextBtn").innerHTML = "Selesai";
	} 
}

function hitungperilakukerja1(){
	var nilskp1=0;
	var nilorientasi1=0;
	var nilintegritas = 0;
	var nilkomitmen = 0;
	var nilkerjasama1 = 0;
	var nildisiplin = 0;
	var nilkepemimpinan = 0;
	var nilperilakukerja = 0;
	var nilprestasikerja = 0;
	
	if (document.getElementById("form1").nilaiskp.value=='') {
		nilskp1 = 0 }
	else {
		nilskp1= parseFloat(document.getElementById("form1").nilaiskp.value);
	}
	
	document.getElementById("form1").nilaiskp60.value = "x 60% = " + ((60/100)*nilskp1).toFixed(2);
	
	if (document.getElementById("form1").orientasi.value=='') {
		nilorientasi1 = 0 }
	else {
		nilorientasi1= parseFloat(document.getElementById("form1").orientasi.value);
	}
	
	if (document.getElementById("form1").integritas.value=='') {
		nilintegritas = 0 }
	else {
		nilintegritas= parseFloat(document.getElementById("form1").integritas.value);
	}
	
	if (document.getElementById("form1").komitmen.value=='') {
		nilkomitmen = 0 }
	else {
		nilkomitmen= parseFloat(document.getElementById("form1").komitmen.value);
	}
	
	if (document.getElementById("form1").kerjasama.value=='') {
		nilkerjasama1 = 0 }
	else {
		nilkerjasama1= parseFloat(document.getElementById("form1").kerjasama.value);
	}
	
	if (document.getElementById("form1").disiplin.value=='') {
		nildisiplin = 0 }
	else {
		nildisiplin= parseFloat(document.getElementById("form1").disiplin.value);
	}
	
	if (document.getElementById("form1").kepemimpinan.value=='') {
		nilkepemimpinan = 0 }
	else {
		nilkepemimpinan= parseFloat(document.getElementById("form1").kepemimpinan.value);
	}
		

  
  // var nilintegritas1=document.getElementById("form1").integritas.value;
  // var nilkerjasama1=document.getElementById("form1").kerjasama.value;
  if (nilkepemimpinan > 0) {
	nilperilakukerja= (nilorientasi1 + nilintegritas + nilkomitmen + nilkerjasama1 + nildisiplin + nilkepemimpinan)/6 ;
  }else{
	nilperilakukerja= (nilorientasi1 + nilintegritas + nilkomitmen + nilkerjasama1 + nildisiplin)/5 ;
  }
  
  document.getElementById("nilperilakukerja").value = nilperilakukerja.toFixed(2);
  var nilperilakukerja40 = ((40/100)*nilperilakukerja) ;
  document.getElementById("form1").nilperilakukerja40.value = "x 40% = " + nilperilakukerja40.toFixed(2);
  
  nilprestasikerja = ((60/100)*nilskp1) + ((40/100)*nilperilakukerja);
  document.getElementById("nilprestasikerja").value = nilprestasikerja.toFixed(2);
  
  //=IF(G3<=50;((G3/50)*49);IF(G3<=60;(50+((19/9)*(G3-51)));IF(G3<=75;(70+((19/14)*(G3-61)));IF(G3<=90;(90+((19/14)*(G3-76)));IF(G3<=99;(110+((10/8)*(G3-91)));120)))))
  var nilaikonversi = 0
  if (nilprestasikerja<=50) {
	  nilaikonversi = (nilprestasikerja/50)*49;
  }else{
	  if (nilprestasikerja<=60) {
			nilaikonversi = 50+((19/9)*(nilprestasikerja-51));
	  }
	  else{
		  if (nilprestasikerja<=75) {
			nilaikonversi = 70+((19/14)*(nilprestasikerja-61));
		  }
		  else{
			  if (nilprestasikerja<=90) {
				nilaikonversi = 90+((19/14)*(nilprestasikerja-76));
			  }
			  else{
				  if (nilprestasikerja<=99) {
					nilaikonversi = 110+((10/8)*(nilprestasikerja-91));
				  }
				  else{
					  nilaikonversi = 120;
				  }
				  
			  }
		  }
		  
	  }
  }
  
  document.getElementById("nilkonversi").value = nilaikonversi.toFixed(2);
  
 //--------------------------------------------------------------------------------------------------
 //periode 2
	 
		var nilskp2=0;
		var nilorientasi2=0;
		var nilkomitmen2 = 0;
		var nilkerjasama2 = 0;
		var nilinisiatif = 0;
		var nilkepemimpinan2 = 0;
		var nilperilakukerja2 = 0;
		var nilprestasikerja2 = 0;
		
		if (document.getElementById("form1").nilaiskp2.value=='') {
			nilaiskp2 = 0 }
		else {
			nilaiskp2= parseFloat(document.getElementById("form1").nilaiskp2.value);
		}
		
		document.getElementById("form1").nilaiskp260.value = "x 60% = " + ((60/100)*nilaiskp2).toFixed(2);
		
		
		if (document.getElementById("form1").orientasi2.value=='') {
			nilorientasi2 = 0 }
		else {
			nilorientasi2= parseFloat(document.getElementById("form1").orientasi2.value);
		}
		
		
		if (document.getElementById("form1").komitmen2.value=='') {
			nilkomitmen2 = 0 }
		else {
			nilkomitmen2= parseFloat(document.getElementById("form1").komitmen2.value);
		}
		
		if (document.getElementById("form1").kerjasama2.value=='') {
			nilkerjasama2 = 0 }
		else {
			nilkerjasama2= parseFloat(document.getElementById("form1").kerjasama2.value);
		}
		
		if (document.getElementById("form1").inisiatif.value=='') {
			nilinisiatif = 0 }
		else {
			nilinisiatif= parseFloat(document.getElementById("form1").inisiatif.value);
		}
		
		if (document.getElementById("form1").kepemimpinan2.value=='') {
			nilkepemimpinan2 = 0 }
		else {
			nilkepemimpinan2= parseFloat(document.getElementById("form1").kepemimpinan2.value);
		}
	  
	  if (nilkepemimpinan2 > 0) {
		nilperilakukerja2= (nilorientasi2 + nilkomitmen2 + nilkerjasama2 + nilinisiatif + nilkepemimpinan2)/5 ;
	  }else{
		nilperilakukerja2= (nilorientasi2 + nilkomitmen2 + nilkerjasama2 + nilinisiatif)/4 ;
	  }
	  
	  document.getElementById("nilperilakukerja2").value = nilperilakukerja2.toFixed(2);
	  
	  var nilperilakukerja240 = ((40/100)*nilperilakukerja2) ;
	  document.getElementById("form1").nilperilakukerja240.value = "x 40% = " + nilperilakukerja240.toFixed(2);
	  
	  nilprestasikerja2 = ((60/100)*nilaiskp2) + ((40/100)*nilperilakukerja2);
	  document.getElementById("nilprestasikerja2").value = nilprestasikerja2.toFixed(2);
	  
	  var niltotalkinerja = (nilaikonversi + nilprestasikerja2)/2 ;
	  var predikat = "SANGAT KURANG";
	  if (niltotalkinerja<=50) {
		  predikat = "SANGAT KURANG";
	  }else{
			if (niltotalkinerja<=69) {
				  predikat = "KURANG";
			  }else{
					if (niltotalkinerja<=89) {
						  predikat = "CUKUP";
					  }else{
							if (niltotalkinerja<=120) {
								  predikat = "BAIK";
							  }else{
									predikat = "SANGAT BAIK";
							  }  	
					  }
			  }
	  }
	  
	  document.getElementById("predikat").value = predikat;
		  
		  
	  document.getElementById("niltotal").value = niltotalkinerja.toFixed(2);
	  
  
  
}

function cekdiklatpim(){
  var diklatpim=document.getElementById("form1").tampil.value;
  if (diklatpim=="sdhpim")
    {	        
		document.getElementById("jenisdiklatpim").disabled = false; 
		document.getElementById("tgldiklatpim").disabled = false; 
		document.getElementById("tmpdiklatpim").disabled = false;
		document.getElementById("berkas").disabled = false;
		document.getElementById("tglselesaipim").disabled = false;
		document.getElementById("nosertifikatpim").disabled = false;
		document.getElementById("tglsertifikatpim").disabled = false;
		document.getElementById("jmljampim").disabled = false;
		document.getElementById("tgldiklatpim").value = "";
		document.getElementById("tmpdiklatpim").value = "";
		document.getElementById("jenisdiklatpim").value = "pilih";
		document.getElementById("tglselesaipim").value = "";
		document.getElementById("nosertifikatpim").value = "";
		document.getElementById("tglsertifikatpim").value = "";
		document.getElementById("jmljampim").value = "";
		//document.getElementById("filediklatpim").value = "";
		
    }
  if (diklatpim=="blmpim")
    {	
		document.getElementById("tgldiklatpim").value = "01-01-1900";
		document.getElementById("tmpdiklatpim").value = "-";
		document.getElementById("jenisdiklatpim").value = "-";
		//document.getElementById("filediklatpim").value = "";
		document.getElementById("tglselesaipim").value = "01-01-1900";
		document.getElementById("nosertifikatpim").value = "-";
		document.getElementById("tglsertifikatpim").value = "01-01-1900";
		document.getElementById("jmljampim").value = "";
		document.getElementById("jenisdiklatpim").disabled = true; 
		document.getElementById("tgldiklatpim").disabled = true; 
		document.getElementById("tmpdiklatpim").disabled = true;
		document.getElementById("berkas").disabled = true;
		document.getElementById("tglselesaipim").disabled = true;
		document.getElementById("nosertifikatpim").disabled = true;
		document.getElementById("tglsertifikatpim").disabled = true;
		document.getElementById("jmljampim").disabled = true;
		
    }
}

function cekdiklatjafung(){
  var diklat=document.getElementById("form1").tampiljafung.value;
  if (diklat=="sdhdiklatjafung")
    {	        
		document.getElementById("jenisdiklatjafung").disabled = false; 
		document.getElementById("tgldiklatjafung").disabled = false; 
		document.getElementById("tmpdiklatjafung").disabled = false;
		document.getElementById("berkasjafung").disabled = false;
		document.getElementById("tglselesaijafung").disabled = false;
		document.getElementById("nosertifikat").disabled = false;
		document.getElementById("tglsertifikat").disabled = false;
		document.getElementById("jmljam").disabled = false;
		document.getElementById("tgldiklatjafung").value = "";
		document.getElementById("tmpdiklatjafung").value = "";
		document.getElementById("jenisdiklatjafung").value = "";
		document.getElementById("tglselesaijafung").value = "";
		document.getElementById("nosertifikat").value = "";
		document.getElementById("tglsertifikat").value = "";
		document.getElementById("jmljam").value = "";
		//document.getElementById("filejafung").value = "";
    }
  if (diklat=="blmdiklatjafung")
    {	
		document.getElementById("tgldiklatjafung").value = "01-01-1900";
		document.getElementById("tmpdiklatjafung").value = "-";
		document.getElementById("tmpdiklatjafung").value = "-";
		document.getElementById("jenisdiklatjafung").value = "-";
		document.getElementById("tglselesaijafung").value = "01-01-1900";
		document.getElementById("nosertifikat").value = "-";
		document.getElementById("tglsertifikat").value = "01-01-1900";
		document.getElementById("jmljam").value = "-";
	//	document.getElementById("filejafung").value = "";
		document.getElementById("jenisdiklatjafung").disabled = true; 
		document.getElementById("tgldiklatjafung").disabled = true; 
		document.getElementById("tmpdiklatjafung").disabled = true;
		document.getElementById("berkasjafung").disabled = true;
		document.getElementById("tglselesaijafung").disabled = true;
		document.getElementById("nosertifikat").disabled = true;
		document.getElementById("tglsertifikat").disabled = true;
		document.getElementById("jmljam").disabled = true;
    }
}

function cekdiklatjp(){
  var diklat=document.getElementById("form1").tampil20jp.value;
  if (diklat=="sdhdiklat20jp")
    {	        
		document.getElementById("jenisdiklatjp").disabled = false; 
		document.getElementById("tgldiklatjp").disabled = false; 
		document.getElementById("tmpdiklatjp").disabled = false;
		document.getElementById("berkasjp").disabled = false;
		document.getElementById("tglselesaijp").disabled = false;
		document.getElementById("nosertifikatjp").disabled = false;
		document.getElementById("tglsertifikatjp").disabled = false;
		document.getElementById("jmljamjp").disabled = false;
		document.getElementById("tgldiklatjp").value = "";
		document.getElementById("tmpdiklatjp").value = "";
		document.getElementById("jenisdiklatjp").value = "";
		document.getElementById("tglselesaijp").value = "";
		document.getElementById("nosertifikatjp").value = "";
		document.getElementById("tglsertifikatjp").value = "";
		document.getElementById("jmljamjp").value = "";
    }
  if (diklat=="blm20jp")
    {	
		document.getElementById("tgldiklatjp").value = "01-01-1900";
		document.getElementById("tmpdiklatjp").value = "-";
		document.getElementById("jenisdiklatjp").value = "-";
		document.getElementById("tglselesaijp").value = "01-01-1900";
		document.getElementById("nosertifikatjp").value = "";
		document.getElementById("tglsertifikatjp").value = "01-01-1900";
		document.getElementById("jmljamjp").value = "";
		document.getElementById("jenisdiklatjp").disabled = true; 
		document.getElementById("tgldiklatjp").disabled = true; 
		document.getElementById("tmpdiklatjp").disabled = true;
		document.getElementById("berkasjp").disabled = true;
		document.getElementById("tglselesaijp").disabled = true;
		document.getElementById("nosertifikatjp").disabled = true;
		document.getElementById("tglsertifikatjp").disabled = true;
		document.getElementById("jmljamjp").disabled = true;
    }
}
function cekseminar(){
  var diklat=document.getElementById("form1").tampilseminar.value;
  if (diklat=="sdhseminar")
    {	        
		document.getElementById("jnsseminar").disabled = false; 
		document.getElementById("tglseminar").disabled = false; 
		document.getElementById("tmpseminar").disabled = false;
		document.getElementById("berkasseminar").disabled = false;
		document.getElementById("tglselesaismnr").disabled = false; 
		document.getElementById("nosertifikatsmnr").disabled = false;
		document.getElementById("tglsertifikatsmnr").disabled = false;
		document.getElementById("jmljamsmnr").disabled = false;
		document.getElementById("tglseminar").value = "";
		document.getElementById("tmpseminar").value = "";
		document.getElementById("jnsseminar").value = "";
		document.getElementById("tglselesaismnr").value = ""; 
		document.getElementById("nosertifikatsmnr").value = "";
		document.getElementById("tglsertifikatsmnr").value = "";
		document.getElementById("jmljamsmnr").value = "";
    }
  if (diklat=="blmseminar")
    {	
		document.getElementById("tglseminar").value = "01-01-1900";
		document.getElementById("tmpseminar").value = "-";
		document.getElementById("jnsseminar").value = "-";
		document.getElementById("tglselesaismnr").value = "01-01-1900"; 
		document.getElementById("nosertifikatsmnr").value = "";
		document.getElementById("tglsertifikatsmnr").value = "01-01-1900";
		document.getElementById("jmljamsmnr").value = "";
		document.getElementById("jnsseminar").disabled = true; 
		document.getElementById("tglseminar").disabled = true; 
		document.getElementById("tmpseminar").disabled = true;
		document.getElementById("berkasseminar").disabled = true;
		document.getElementById("tglselesaismnr").disabled = true; 
		document.getElementById("nosertifikatsmnr").disabled = true;
		document.getElementById("tglsertifikatsmnr").disabled = true;
		document.getElementById("jmljamsmnr").disabled = true;
    }
}

function cekhukuman(){
  var diklat=document.getElementById("form1").hukuman.value;
  if (diklat!="Tidak Pernah")
    {	        
		document.getElementById("ttdsk").disabled = false; 
		document.getElementById("tglsurat").disabled = false; 
		document.getElementById("alasan").disabled = false;
		document.getElementById("tglsurat").value = "";
		document.getElementById("alasan").value = "";
		document.getElementById("ttdsk").value = "";
		document.getElementById("berkashukuman").disabled = false;
    }
  if (diklat=="Tidak Pernah")
    {	
		document.getElementById("tglsurat").value = "01-01-1900";
		document.getElementById("alasan").value = "-";
		document.getElementById("ttdsk").value = "-";
		document.getElementById("ttdsk").disabled = true; 
		document.getElementById("tglsurat").disabled = true; 
		document.getElementById("alasan").disabled = true;
		document.getElementById("berkashukuman").disabled = true;
    }
}



	function addRow(tableID) {

		var table = document.getElementById(tableID);

		var rowCount = table.rows.length;
		var row = table.insertRow(rowCount);

		var colCount = table.rows[1].cells.length;
		
	
		
		for(var i=0; i<colCount; i++) {

			var newcell	= row.insertCell(i);

			newcell.innerHTML = table.rows[1].cells[i].innerHTML;
			
			
			//alert(newcell.childNodes);
			  switch(newcell.childNodes[0].type) {
				 case "text":
						newcell.childNodes[0].value = "";
						 break;
				 case "checkbox":
						 newcell.childNodes[0].checked = false;
						 break;
				 case "select-one":
						newcell.childNodes[0].selectedindex = 0;
						break;
				case "date":
						 newcell.childNodes[0].value = "01-01-1900";
						 break;
				case "hidden":
						 newcell.childNodes[0].value = "";
					     break;
				// case "button":
						// newcell.childNodes[0].value = "";
                // case "file":
						// newcell.childNodes[0].text = "";
						// break;							
			 }
			 
		}
		
		
	}
	
	

	function deleteRow(tableID) {
		try {
			
		var table = document.getElementById(tableID);
		var idpim = document.getElementById("idpim").value;
		var rowCount = table.rows.length;
	    
		for(var i=2; i<rowCount; i++) {
			var row = table.rows[i];
			var chkbox = row.cells[0].childNodes[0];
			
	
			if(null != chkbox && true == chkbox.checked) {
				var idpim = row.cells[1].childNodes[0].value;
				
				if(rowCount <= 1) {
					alert("Cannot delete all the rows.");
					break;
				}
				table.deleteRow(i);
				deletepim(idpim);
				rowCount--;
				i--;
			}


		}
		}catch(e) {
			alert(e);
		}
	}
	
	function deletepim(id) {
        alert(id);
	  var r=confirm("Do you want to Delete");
      if (r==true)
      {
           $.post("<?php echo site_url('Dashboard/del_pim/');?>", {id:id},
           function(data) {
                alert(data+"a");
           }, 'json');
      }
      else
      {
           x="You pressed Cancel!";
           alert(x);
      }

    }
	
	/*** FUNCTION TO ADD ROW ***/
	function addSampleRow(id) {
				
		/*** We get the table object based on given id ***/
		var objTable = document.getElementById(id);

		/*** We insert the row by specifying the current rows length ***/
		var objRow = objTable.insertRow(objTable.rows.length);

		/*** We insert the first row cell ***/
		var objCell1 = objRow.insertCell(0);

		/*** We  insert a checkbox object ***/
		var objInputCheckBox = document.createElement("input");
		objInputCheckBox.type = "checkbox";
		objCell1.appendChild(objInputCheckBox);

		 /*** We  insert the second row cell ***/
		var objCell2 = objRow.insertCell(1);
		var currentDate = new Date()

		/*** We  add some text inside the celll ***/
		objCell2.innerHTML = "You add me on " + currentDate.getHours() + ":" + currentDate.getMinutes() + ":" + currentDate.getSeconds();
	}

	 /*** FUNCTION TO DELETE ROW ***/
	function removeSampleRow(id) {
		/***We get the table object based on given id ***/
		var objTable = document.getElementById(id);

		/*** Get the current row length ***/
		var iRow = objTable.rows.length;

		/*** Initial row counter ***/
		var counter = 0;

		/*** Performing a loop inside the table ***/
		if (objTable.rows.length > 1) {
			for (var i = 0; i < objTable.rows.length; i++) {

				 /*** Get checkbox object ***/
				var chk = objTable.rows[i].cells[0].childNodes[0];
				if (chk.checked) {
					/*** if checked we del ***/
					objTable.deleteRow(i);
					iRow--;
					i--;
					counter = counter + 1;
				}
			}

			/*** Alert user if there is now row is selected to be deleted ***/
			if (counter == 0) {
				alert("Please select the row that you want to delete.");
			}
		}else{
			/*** Alert user if there are no rows being added ***/
			alert("There are no rows being added");
		}
	}
</script>

<?php
$link = mysqli_connect("192.168.193.15", "sikerja_asn", "asnsikerja_2019", "sikerja_new_build");
$jab = '';
$jnspim = '' ;
$jnsjafung = '' ;
$jp = '';
$jnsseminar = '';
$skp='';
$hukuman='';
$idpeg = $this->session->userdata('sesUser') ;
// jalankan query
$result = mysqli_query($link, "SELECT * FROM tr_survey_ip WHERE id_pegawai=".$idpeg." and tahun=2021");
 
// tampilkan query
while ($row=mysqli_fetch_object($result))
{
  $jab = $row->jns_jabatan;
  $jnspim = $row->diklat_pim;
  $jnsjafung = $row->diklat_jafung;
  $jp = $row->diklat_20jp;
  $jnsseminar = $row->seminar;
  $pendidikan = $row->kualifikasi;
  $skp = $row->penilaian_kinerja;
  $hukuman = $row->hukuman_disiplin;
}

?>
 
 
<body>

<div id="modal-kuisioner"  class="modal fade" data-keyboard="false" data-backdrop="static">
 <div class="modal-dialog" >
  <div class="modal-content">
   <div class="modal-header">
     <!--<button type="button" class="close" data-dismiss="modal">&times;</button> --> 
    <h2 class="modal-title" style="color:blue">PENGUKURAN INDEKS PROFESIONALITAS PNS KEMENDAGRI TAHUN 2021</h2>
   </div>
   <div class="modal-body">
			<form method="post" id="form1" name="form1" enctype="multipart/form-data" action="<?php echo site_url('Dashboard/add_survey') ?>">
			  <!-- One "tab" for each step in the form: -->
			  <div class="tab">Jenis Jabatan Anda di tahun 2021:
			   
				 <p><select id="jabatan" name="jabatan" onchange="tampilkan()"  class="form-control">
					<option value="pilih">--Pilih--</option>  
					  
					 <?php 
									if ($jab == 'struktural'  ) {
										# code...
										echo "<option value='struktural' selected>Struktural</option>" ;
									}
									else{
										echo "<option value='struktural'>Struktural</option>" ;
									} 
									if ($jab == 'fungsional'  ) {
										# code...
										echo "<option value='fungsional' selected>Fungsional</option>" ;
									}
									else{
										echo "<option value='fungsional'>Fungsional</option>" ;
									} 
						
								                           
									if ($jab == 'pelaksana'  ) {
										# code...
										echo "<option value='pelaksana' selected>Pelaksana</option>" ;
									}
									else{
										echo "<option value='pelaksana'>Pelaksana</option>" ;
									} 
									
									if ($jab == 'CPNS'  ) {
										# code...
										echo "<option value='CPNS' selected>CPNS</option>" ;
									}
									else{
										echo "<option value='CPNS'>CPNS</option>" ;
									} 
						?>
				    
					  
				 </select></p>
			  </div>
				   <div class="tab"><p style="font-size:25px"><b>SKP Tahun 2021</b>: </p>
				   <i>(untuk tanda decimal silahkan menggunakan titik (.) misal 90.50)</i><br/>
				   <a href="<?=base_url();?>/assets_home/PETUNJUKPENGISIANSKPINDEKSPROFESIONALITAS.pdf" download><u>Klik di sini untuk petunjuk pengisian</u></a>
				   <br/><br/>
				   <p>
				   
					 <?
								 $result2 = mysqli_query($link, "SELECT skp1.*, 
											skp2.id AS id2, skp2.`nilaiskp` AS nilaiskp2, skp2.`orientasipelayanan` AS orientasipelayanan2, skp2.`inisiatifkerja` AS inisiatifkerja2, skp2.`komitmen` AS komitmen2, skp2.`kerjasama` AS kerjasama2, skp2.`kepemimpinan` AS kepemimpinan2, skp2.`file_skp2` , skp2.`nilaiprilakukerja` AS nilaiprilakukerja2, skp2.`nilaiprestasikerja` AS nilaiprestasikerja2, skp2.nilaitotal,
											skp2.nip_penilai, skp2.nama_penilai, skp2.gol_penilai, skp2.jab_penilai,
											skp2.nip_atasanpenilai, skp2.nama_atasanpenilai, skp2.gol_atasanpenilai, skp2.jab_atasanpenilai
										FROM `tr_survey_kinerja_1` skp1
										LEFT JOIN tr_survey_kinerja_2 skp2 ON skp1.id_pegawai = skp2.id_pegawai
										WHERE skp1.id_pegawai = ".$idpeg." AND skp1.tahun=2021");
										
								 $row_cnt = $result2->num_rows;
								
							    if ($row_cnt != 0) {
									while ($row=mysqli_fetch_object($result2))
									  {
										  $idskp1 = $row->id;
										  $nilaiskp = $row->nilaiskp;
										  $nilaiskp60 = "x 60% = ".((60/100)* $nilaiskp);
										  $orientasipelayanan = $row->orientasipelayanan;
										  $integritas= $row->integritas;
										  $komitmen= $row->komitmen;
										  $kerjasama= $row->kerjasama;
										  $disiplin= $row->disiplin;
										  $kepemimpinan= $row->kepemimpinan;
										  $file_skp1 = $row->file_skp1;
										  $nilaiprilakukerja = $row->nilaiprilakukerja;
										  $nilaiprilakukerja40 = "x 40% = ".((40/100)*$nilaiprilakukerja);
										  $nilaiprestasikerja = $row->nilaiprestasikerja;
										  $nilaikonversi = $row->nilaikonversi;
										  
										  $idskp2 = $row->id2;
										  $nilaiskp2 = $row->nilaiskp2;
										  $nilaiskp260 = "x 60% = ".((60/100)* $nilaiskp2);
										  $orientasipelayanan2 = $row->orientasipelayanan2;
										  $inisiatifkerja2 = $row->inisiatifkerja2;
										  $komitmen2= $row->komitmen2;
										  $kerjasama2= $row->kerjasama2;
										  $kepemimpinan2= $row->kepemimpinan2;
										  $file_skp2 = $row->file_skp2;
										  $nilaiprilakukerja2 = $row->nilaiprilakukerja2;
										  $nilaiprilakukerja240 = "x 40% = ".((40/100)*$nilaiprilakukerja2);
										  $nilaiprestasikerja2 = $row->nilaiprestasikerja2;
										  $nilaitotal = $row->nilaitotal;
										  $nip_penilai = $row->nip_penilai;
										  $nama_penilai = $row->nama_penilai;
										  $gol_penilai = $row->gol_penilai;
										  $jab_penilai = $row->jab_penilai;
										  $nip_atasanpenilai = $row->nip_atasanpenilai;
										  $nama_atasanpenilai = $row->nama_atasanpenilai;
										  $gol_atasanpenilai = $row->gol_atasanpenilai;
										  $jab_atasanpenilai = $row->jab_atasanpenilai;
										  
										  $predikat = "SANGAT KURANG";
										  if ($nilaitotal<=50) {
											  $predikat = "SANGAT KURANG";
										  }else{
												if ($nilaitotal<=69) {
													  $predikat = "KURANG";
												  }else{
														if ($nilaitotal<=89) {
															  $predikat = "CUKUP";
														  }else{
																if ($nilaitotal<=120) {
																	  $predikat = "BAIK";
																  }else{
																		$predikat = "SANGAT BAIK";
																  }  	
														  }
												  }
										  }
										
										echo "	<table border=1 width=1500> ";
										echo	 "<tr>";
										echo	"	<td colspan=2> <b>Periode I (Jan - Juni 2021)";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td colspan=3> <b>Periode II (Juli - Desember 2021)";
										echo	"	</td>";
										echo	 "</tr>";
										//--------------------------------------------------------------------------------------------------------------
										echo	 "<tr>";
										echo			"<td width=400>Nilai SKP</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
											echo	"		<input type='hidden' id='idskp1' name='idskp1' value=".$idskp1.">";
											echo	"		<input style='width:100px; text-align:right;' id='nilaiskp' type='text' name='nilaiskp' class='form-control' value=".$nilaiskp." onchange='hitungperilakukerja1()'>";
											echo	"		<input style='width:200px; font-weight: bold; text-align:left;' id='nilaiskp60' readonly=true type='text' name='nilaiskp60' class='form-control'  value='".$nilaiskp60."';>";
										echo	"		</div> ";	
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo			"<td width=400>Nilai SKP</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
											echo	"		<input type='hidden' id='idskp2' name='idskp2' value=".$idskp2.">";
											echo	"		<input style='width:100px; text-align:right;' id='nilaiskp2' type='text' name='nilaiskp2' class='form-control' value=".$nilaiskp2." onchange='hitungperilakukerja1()'>";
											echo	"		<input style='width:200px; font-weight: bold; text-align:left;' readonly=true id='nilaiskp260' type='text' name='nilaiskp260' class='form-control' value='".$nilaiskp260."';>";
										echo	"		</div>";								
										echo	"	</td>";
										echo	" </tr>";
										//--------------------------------------------------------------------------------------------------------------
										echo	" <tr>";
										echo	"	<td>Orientasi Pelayanan</td>";
										echo	"	<td>";
											echo	"			<div class='input-group'>";
											echo	"			<input type='text' style='width:100px; text-align:right;' onchange='hitungperilakukerja1()' id='orientasi' name='orientasi' class='form-control' value=".$orientasipelayanan."> ";
										echo	"			</div>";
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td>Orientasi Pelayanan</td>";
										echo	"	<td>";
											echo	"			<div class='input-group'>";
											echo	"			<input type='text' style='width:100px; text-align:right;' id='orientasi2' name='orientasi2' class='form-control' value=".$orientasipelayanan2." onchange='hitungperilakukerja1()'> ";
										echo	"			</div>";
										echo	"	</td>";
										echo	" </tr>";
										//--------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>Integritas</td>";
										echo	"	<td>";
											echo	"			<div class='input-group'>";
											echo	"			<input type='text' style='width:100px; text-align:right;' onchange='hitungperilakukerja1()' id='integritas' name='integritas' class='form-control' value=".$integritas."> ";
										echo	"			</div>";
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td>Komitmen</td>";
										echo	"	<td>";
											echo	"			<div class='input-group'>";
											echo	"			<input type='text' style='width:100px; text-align:right;' id='komitmen2' name='komitmen2' class='form-control' value=".$komitmen2." onchange='hitungperilakukerja1()'> ";
										echo	"			</div>";
										echo	"	</td>";
										echo	" </tr>";
										//--------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>Komitmen</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text'  style='width:100px; text-align:right;' onchange='hitungperilakukerja1()' id='komitmen' name='komitmen' class='form-control' value=".$komitmen.">";
										echo	"	</div>";
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td>Kerjasama</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"		<input type='text' style='width:100px; text-align:right;' id='kerjasama2' name='kerjasama2' class='form-control' value=".$kerjasama2." onchange='hitungperilakukerja1()'>";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//--------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>Disiplin</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"			<input type='text' style='width:100px; text-align:right;' onchange='hitungperilakukerja1()' id='disiplin' name='disiplin' class='form-control' value=".$disiplin.">";
										echo	"	</div>";
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td>Inisiatif Kerja</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"			<input type='text' style='width:100px; text-align:right;' id='inisiatif' name='inisiatif' class='form-control' value=".$inisiatifkerja2." onchange='hitungperilakukerja1()'>";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//--------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>Kerjasama</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"		<input type='text' style='width:100px; text-align:right;' onchange='hitungperilakukerja1()' id='kerjasama' name='kerjasama' class='form-control' value=".$kerjasama.">";
										echo	"	</div>";
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td>Kepemimpinan <br/> (utk Struktural, Subkoordinator, atau Koordinator)</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"		<input type='text' style='width:100px; text-align:right;' id='kepemimpinan2' name='kepemimpinan2' class='form-control' value=".$kepemimpinan2." onchange='hitungperilakukerja1()'>";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//--------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>Kepemimpinan <br/> (utk Struktural, Subkoordinator, atau Koordinator)</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:100px; text-align:right;' onchange='hitungperilakukerja1()' id='kepemimpinan' name='kepemimpinan' class='form-control' value=".$kepemimpinan.">";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										
										//--------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>Nilai Perilaku Kerja</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
											echo	"  <input type='text' style='width:100px; font-weight: bold; text-align:right; background-color:skyblue;' readonly=true id='nilperilakukerja' name='nilperilakukerja' class='form-control' value=".$nilaiprilakukerja.">";
											echo	"  <input type='text' style='width:200px; font-weight: bold;  text-align:left;' readonly=true id='nilperilakukerja40' name='nilperilakukerja40' class='form-control' value='".$nilaiprilakukerja40."'>";
											echo	"	</div>";
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td>Nilai Perilaku Kerja</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"  <input type='text' style='width:100px; font-weight: bold; text-align:right; background-color:skyblue;' readonly=true id='nilperilakukerja2' name='nilperilakukerja2' class='form-control' value=".$nilaiprilakukerja2.">";
										echo	"  <input type='text' style='width:200px; font-weight: bold;  text-align:left;' readonly=true id='nilperilakukerja240' name='nilperilakukerja240' class='form-control' value='".$nilaiprilakukerja240."'>";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//--------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>Nilai Prestasi Kerja</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:100px; font-weight: bold; text-align:right; background-color:skyblue;' readonly=true id='nilprestasikerja' name='nilprestasikerja' class='form-control' value=".$nilaiprestasikerja.">";
										echo	"	</div>";
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td>Nilai Prestasi Kerja</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:100px; font-weight: bold; text-align:right; background-color:skyblue;' readonly=true id='nilprestasikerja2' name='nilprestasikerja2' class='form-control' value=".$nilaiprestasikerja2.">";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//--------------------------------------------------------------------------------------------------------------
										
										
										echo	" <tr>";
										echo	"	<td>Nilai Konversi</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:100px;  font-weight: bold; text-align:right; background-color:skyblue;' id='nilkonversi' readonly=true name='nilkonversi' class='form-control' value=".$nilaikonversi.">";
										echo	"	</div>";
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td>Nilai Kinerja Th 2021</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:100px; font-weight: bold; text-align:right; background-color:skyblue;' readonly=true id='niltotal' name='niltotal' class='form-control' value=".$nilaitotal.">";
										echo	"<input type='text' style='width:200px; font-weight: bold; text-align:Left;' id='predikat' name='predikat' readonly=true class='form-control' value='".$predikat."'>";
										
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";

										
										//----------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>NIP Pejabat Penilai</td>";
										echo	"	<td colspan=5>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:300px;  font-weight: bold; text-align:left;' placeholder='isikan Nip Pejabat Penilai' id='nipatasan' name='nipatasan' value='".$nip_penilai."' class='form-control' >";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//--------------------------------------------------------------------------------------------------------------
										echo	" <tr>";
										echo	"	<td>Nama Pejabat Penilai</td>";
										echo	"	<td colspan=5>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:900px;  font-weight: bold; text-align:left;' placeholder='isikan Nama Pejabat Penilai' id='namaatasan' name='namaatasan' value='".$nama_penilai."' class='form-control' >";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//--------------------------------------------------------------------------------------------------------------
										echo	" <tr>";
										echo	"	<td>Pangkat Golongan Ruang Pejabat Penilai</td>";
										echo	"	<td colspan=5>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:900px;  font-weight: bold; text-align:left;' placeholder='isikan Pangkat Gol. Ruang Pejabat Penilai, misal: Pembina (IV/a)' id='golatasan' name='golatasan' value='".$gol_penilai."' class='form-control' >";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//---------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>Jabatan Pejabat Penilai</td>";
										echo	"	<td colspan=5>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:900px;  font-weight: bold; text-align:left;' placeholder='isikan Jabatan Pejabat Penilai' id='jabatasan' name='jabatasan' value='".$jab_penilai."' class='form-control' >";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										
										//--------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>NIP Atasan Pejabat Penilai</td>";
										echo	"	<td colspan=5>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:300px;  font-weight: bold; text-align:left;' id='nippejabat' name='nippejabat' value='".$nip_atasanpenilai."' placeholder='isikan Nip Atasan Pejabat Penilai'  class='form-control' >";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//--------------------------------------------------------------------------------------------------------------
										echo	" <tr>";
										echo	"	<td>Nama Atasan Pejabat Penilai</td>";
										echo	"	<td colspan=5>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:900px;  font-weight: bold; text-align:left;' id='namapejabat' name='namapejabat' value='".$nama_atasanpenilai."' placeholder='isikan Nama Atasan Pejabat Penilai' class='form-control' >";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//--------------------------------------------------------------------------------------------------------------
										echo	" <tr>";
										echo	"	<td>Pangkat Golongan Ruang Atasan Pejabat Penilai</td>";
										echo	"	<td colspan=5>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:900px;  font-weight: bold; text-align:left;' id='golpejabat' name='golpejabat' value='".$gol_atasanpenilai."' placeholder='isikan Pangkat Gol. Ruang Atasan Pejabat Penilai, misal: Pembina (IV/a)' class='form-control' >";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//---------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>Jabatan Atasan Pejabat Penilai</td>";
										echo	"	<td colspan=5>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:900px;  font-weight: bold; text-align:left;' id='jabpejabat' name='jabpejabat' value='".$jab_atasanpenilai."' placeholder='isikan Jabatan Atasan Pejabat Penilai' class='form-control' >";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										
										//--------------------------------------------------------------------------------------------------------------
										
										echo	"<tr>";
										echo	"	<td colspan=4>Upload SKP (File Maks. 1 MB)</td>";
										echo	"	<td colspan=4>";
										echo    	"<div class='input-group'>";
										echo		"<input type='file' style='width:300px; align=right' id='berkasskp' name='berkasskp' class='form-control' placeholder='File Pendukung'>";
										echo	"</div>";
										echo	"	</td>";	
										echo	"</tr>";			
										//--------------------------------------------------------------------------------------------------------------	
										echo	"<tr>";
										echo	"	<td colspan=4>File SKP</td>";
										echo	"<td colspan=4>";
										echo		"<div class='input-group'>";
										echo        "<input type='text' style='width:300px;' id='fileskp' name='fileskp' class='form-control' placeholder='No File' value='".$file_skp1."' readonly='true'>";
										echo		"</div>";
										echo	"</td>";
										echo	"</tr>";
										
										echo	"</table><p>";
									  }
							   }
							else {
										echo "	<table border=1 width=1500> ";
										echo	 "<tr>";
										echo	"	<td colspan=2> <b>Periode I (Jan - Juni 2021)";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td colspan=3> <b>Periode II (Juli - Desember 2021)";
										echo	"	</td>";
										echo	 "</tr>";
										//--------------------------------------------------------------------------------------------------------------
										echo	 "<tr>";
										echo			"<td width=400>Nilai SKP</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
											echo	"		<input type='hidden' id='idskp1' name='idskp1'>";
											echo	"		<input style='width:100px; text-align:right;' id='nilaiskp' type='text' name='nilaiskp' class='form-control' placeholder=0 onchange='hitungperilakukerja1()'>";
											echo	"		<input style='width:200px; font-weight: bold; text-align:left;' readonly=true id='nilaiskp60' type='text' name='nilaiskp60' class='form-control'  placeholder='x 60% = 0'>";
										echo	"		</div> ";	
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo			"<td width=400>Nilai SKP</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
											echo	"		<input type='hidden' id='idskp2' name='idskp2'>";
											echo	"		<input style='width:100px; text-align:right;' id='nilaiskp2' type='text' name='nilaiskp2' class='form-control' placeholder=0 onchange='hitungperilakukerja1()'>";
											echo	"		<input style='width:100px; font-weight: bold; text-align:left;' readonly=true id='nilaiskp260' type='text' name='nilaiskp260' class='form-control' placeholder='x 60% = 0'>";
										echo	"		</div>";								
										echo	"	</td>";
										echo	" </tr>";
										//--------------------------------------------------------------------------------------------------------------
										echo	" <tr>";
										echo	"	<td>Orientasi Pelayanan</td>";
										echo	"	<td>";
											echo	"			<div class='input-group'>";
											echo	"			<input type='text' style='width:100px; text-align:right;' onchange='hitungperilakukerja1()' id='orientasi' name='orientasi' class='form-control' placeholder=0> ";
										echo	"			</div>";
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td>Orientasi Pelayanan</td>";
										echo	"	<td>";
											echo	"			<div class='input-group'>";
											echo	"			<input type='text' style='width:100px; text-align:right;' id='orientasi2' name='orientasi2' class='form-control' placeholder=0 onchange='hitungperilakukerja1()'> ";
										echo	"			</div>";
										echo	"	</td>";
										echo	" </tr>";
										//--------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>Integritas</td>";
										echo	"	<td>";
											echo	"			<div class='input-group'>";
											echo	"			<input type='text' style='width:100px; text-align:right;' onchange='hitungperilakukerja1()' id='integritas' name='integritas' class='form-control' placeholder=0> ";
										echo	"			</div>";
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td>Komitmen</td>";
										echo	"	<td>";
											echo	"			<div class='input-group'>";
											echo	"			<input type='text' style='width:100px; text-align:right;' id='komitmen2' name='komitmen2' class='form-control' placeholder=0 onchange='hitungperilakukerja1()'> ";
										echo	"			</div>";
										echo	"	</td>";
										echo	" </tr>";
										//--------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>Komitmen</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text'  style='width:100px; text-align:right;' onchange='hitungperilakukerja1()' id='komitmen' name='komitmen' class='form-control' placeholder=0>";
										echo	"	</div>";
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td>Kerjasama</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"		<input type='text' style='width:100px; text-align:right;' id='kerjasama2' name='kerjasama2' class='form-control' placeholder=0 onchange='hitungperilakukerja1()'>";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//--------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>Disiplin</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"			<input type='text' style='width:100px; text-align:right;' onchange='hitungperilakukerja1()' id='disiplin' name='disiplin' class='form-control' placeholder=0>";
										echo	"	</div>";
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td>Inisiatif Kerja</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"			<input type='text' style='width:100px; text-align:right;' id='inisiatif' name='inisiatif' class='form-control' placeholder=0 onchange='hitungperilakukerja1()'>";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//--------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>Kerjasama</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"		<input type='text' style='width:100px; text-align:right;' onchange='hitungperilakukerja1()' id='kerjasama' name='kerjasama' class='form-control' placeholder=0>";
										echo	"	</div>";
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td>Kepemimpinan <br/> (utk Struktural, Subkoordinator, atau Koordinator)</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"		<input type='text' style='width:100px; text-align:right;' id='kepemimpinan2' name='kepemimpinan2' class='form-control' placeholder=0 onchange='hitungperilakukerja1()'>";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//--------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>Kepemimpinan <br/> (utk Struktural, Subkoordinator, atau Koordinator)</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:100px; text-align:right;' onchange='hitungperilakukerja1()' id='kepemimpinan' name='kepemimpinan' class='form-control' placeholder=0>";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										
										//--------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>Nilai Perilaku Kerja</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
											echo	"  <input type='text' style='width:100px; font-weight: bold; text-align:right; background-color:skyblue;' readonly=true id='nilperilakukerja' name='nilperilakukerja' class='form-control'>";
											echo	"  <input type='text' style='width:200px; font-weight: bold;  text-align:left;' readonly=true id='nilperilakukerja40' name='nilperilakukerja40' class='form-control' placeholder='x 40% = 0'>";
											echo	"	</div>";
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td>Nilai Perilaku Kerja</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"  <input type='text' style='width:100px; font-weight: bold; text-align:right; background-color:skyblue;' readonly=true id='nilperilakukerja2' name='nilperilakukerja2' class='form-control'>";
										echo	"  <input type='text' style='width:100px; font-weight: bold; text-align:left;' readonly=true id='nilperilakukerja240' name='nilperilakukerja240' class='form-control' placeholder='x 40% = 0'>";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//--------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>Nilai Prestasi Kerja</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:100px; font-weight: bold; text-align:right; background-color:skyblue;' readonly=true id='nilprestasikerja' name='nilprestasikerja' class='form-control' >";
										echo	"	</div>";
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td>Nilai Prestasi Kerja</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:100px; font-weight: bold; text-align:right; background-color:skyblue;' readonly=true id='nilprestasikerja2' name='nilprestasikerja2' class='form-control' >";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//--------------------------------------------------------------------------------------------------------------
										
										
										echo	" <tr>";
										echo	"	<td>Nilai Konversi</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:100px;  font-weight: bold; text-align:right; background-color:skyblue;' readonly=true id='nilkonversi' name='nilkonversi' class='form-control' >";
										echo	"	</div>";
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td>Nilai Kinerja Th 2021</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:100px; font-weight: bold; text-align:right; background-color:skyblue;' readonly=true id='niltotal' name='niltotal' class='form-control' >";
										echo	"<input type='text' style='width:200px; font-weight: bold; text-align:Left;' readonly=true id='predikat' name='predikat' class='form-control' >";
										
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//-------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>NIP Pejabat Penilai</td>";
										echo	"	<td colspan=5>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:300px;  font-weight: bold; text-align:left;' placeholder='isikan Nip Pejabat Penilai' id='nipatasan' name='nipatasan' class='form-control' >";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//--------------------------------------------------------------------------------------------------------------
										echo	" <tr>";
										echo	"	<td>Nama Pejabat Penilai</td>";
										echo	"	<td colspan=5>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:900px;  font-weight: bold; text-align:left;' placeholder='isikan Nama Pejabat Penilai' id='namaatasan' name='namaatasan' class='form-control' >";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//--------------------------------------------------------------------------------------------------------------
										echo	" <tr>";
										echo	"	<td>Pangkat Golongan Ruang Pejabat Penilai</td>";
										echo	"	<td colspan=5>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:900px;  font-weight: bold; text-align:left;' placeholder='isikan Pangkat Gol. Ruang Pejabat Penilai, misal : Pembina (IV/a)' id='golatasan' name='golatasan' class='form-control' >";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//---------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>Jabatan Pejabat Penilai</td>";
										echo	"	<td colspan=5>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:900px;  font-weight: bold; text-align:left;' placeholder='isikan Jabatan Pejabat Penilai' id='jabatasan' name='jabatasan' class='form-control' >";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										
										//--------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>NIP Atasan Pejabat Penilai</td>";
										echo	"	<td colspan=5>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:300px;  font-weight: bold; text-align:left;' placeholder='isikan Nip Atasan Pejabat Penilai' id='nippejabat' name='nippejabat' class='form-control' >";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//--------------------------------------------------------------------------------------------------------------
										echo	" <tr>";
										echo	"	<td>Nama Atasan Pejabat Penilai</td>";
										echo	"	<td colspan=5>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:900px;  font-weight: bold; text-align:left;' placeholder='isikan Nama Atasan Pejabat Penilai' id='namapejabat' name='namapejabat' class='form-control' >";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//--------------------------------------------------------------------------------------------------------------
										echo	" <tr>";
										echo	"	<td>Pangkat Golongan Ruang Atasan Pejabat Penilai</td>";
										echo	"	<td colspan=5>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:900px;  font-weight: bold; text-align:left;' placeholder='isikan Pangkat Gol. Ruang Atasan Pejabat Penilai, misal : Pembina (IV/a)' id='golpejabat' name='golpejabat' class='form-control' >";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//---------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>Jabatan Atasan Pejabat Penilai</td>";
										echo	"	<td colspan=5>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:900px;  font-weight: bold; text-align:left;' placeholder='isikan Jabatan Atasan Pejabat Penilai' id='jabpejabat' name='jabpejabat' class='form-control' >";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										
										//--------------------------------------------------------------------------------------------------------------
										echo	"<tr>";
										echo	"	<td>Upload SKP (File Maks. 1 MB)</td>";
										echo	"	<td colspan=5>";
										echo    	"<div class='input-group'>";
										echo		"<input type='file' style='width:300px; align=right' id='berkasskp' name='berkasskp' class='form-control' placeholder='File Pendukung'>";
										echo	"</div>";
										echo	"	</td>";	
										echo	"</tr>";			
										//--------------------------------------------------------------------------------------------------------------	
										echo	"<tr>";
										echo	"	<td>File SKP</td>";
										echo	"<td colspan=5>";
										echo		"<div class='input-group'>";
										echo        "<input type='text' style='width:300px;' id='fileskp' name='fileskp' class='form-control' placeholder='No File' readonly='true'>";
										echo		"</div>";
										echo	"</td>";
										echo	"</tr>";
														
										echo	"</table><p>";
							 } ?>	  
							   
							
				  </div>
			  
			  <div class="tab">Jika anda menduduki jabatan struktural di tahun 2021, apakah anda sudah mengikuti diklatpim dalam jabatan eselon tersebut?<p>
			  <i>(contoh: <b>jawab Sudah Diklatpim</b> jika di tahun 2021 menduduki jabatan eselon III dan sudah diklatpim III; <b>jawab Belum Diklatpim</b> jika di tahun 2021 menduduki jabatan eselon III dan belum diklatpim III)</i>
				<p><select id="tampil" name="tampil" onchange="cekdiklatpim()" class="form-control"> 
				<option value="pilih">--Diklat PIM--</option> 
				<?
				 if ($jnspim == 'sdhpim') {
						echo "<option value='sdhpim' selected>Sudah Diklat PIM</option>" ;
						echo "<option value='blmpim'>Belum Diklat PIM</option>" ;
					}
				if ($jnspim == 'blmpim') {	
						echo "<option value='sdhpim'>Sudah Diklat PIM</option>" ;
						echo "<option value='blmpim' selected>Belum Diklat PIM</option>" ;
					}
				if ($jnspim == '') {	
						echo "<option value='sdhpim'>Sudah Diklat PIM</option>" ;
						echo "<option value='blmpim'>Belum Diklat PIM</option>" ;
					}
					
				?>

					 
				</select></p>
					
					


					<TABLE id="dataTable1" width="1650" border="1">
						<th>
							<td width="200">Jenis Diklat</td>
							<td width="160">Tanggal Mulai</td>
							<td width="160">Tanggal Selesai</td>
							<td width="300">Penyelenggara</td>
							<td width="150">No Sertifikat</td>
							<td width="160">Tgl Sertifikat</td>
							<td width="70">Jml Jam</td>
							<td width="300">Upload Sertifikat (File Maks 1 MB)  </td>
							<td width="100">File Sertifikat</td>
						</th>
					 <?	
						 $result2 = mysqli_query($link, "SELECT * FROM tr_survey_diklatpim WHERE id_pegawai=".$idpeg." and tahun=2021");
						 $row_cnt = $result2->num_rows;
						 $i=0;
						 
						 if ($row_cnt != 0) {
								  while ($row=mysqli_fetch_object($result2))
								  {
										  $idpim = $row->id; 
										  $jnspim = $row->jnsdiklatpim;
										  $tglpim = $row->tgldiklatpim;
										  $tmppim = $row->tmpdiklatpim;
										  $tglselesaipim = $row->tglselesai;
										  $nosertifikatpim = $row->nosertifikat;
										  $tglsertifikatpim = $row->tglsertifikat;
										  $jmljampim = $row->jmljam;
										  $filesertifikat = $row->file_sertifikat;
										  
										  
										  
										  echo "<tr>";
											echo	"<td width='30'><input type='checkbox' name='chk'></td>";
											echo	"<td title='Nama Diklat' >";
											echo	"	<select id='jenisdiklatpim' style='width:200px;' name='jenisdiklatpim[]' class='form-control' placeholder='Jenis Diklat'>";
											echo 	"	<option value='pilih'>--Pilih--</option>  ";
												if ($jnspim == 'pim1') {	
													echo "<option value='pim1' selected>PIM 1</option>  ";
													
												}else{ echo "<option value='pim1' >PIM 1</option>  "; }
												if ($jnspim == 'pim2') {	
													echo "<option value='pim2' selected>PIM 2</option>  ";
												}else{ echo "<option value='pim2' >PIM 2</option>  "; }
												if ($jnspim == 'pim3') {	
													echo "<option value='pim3' selected>PIM 3</option>  ";
												}else{ echo "<option value='pim3' >PIM 3</option>  "; }
												if ($jnspim == 'pim4') {	
													echo "<option value='pim4' selected>PIM 4</option>  ";
												}else{ echo "<option value='pim4' >PIM 4</option>  "; }
												if ($jnspim == 'lemhanas') {	
													echo "<option value='lemhanas' selected>Lemhanas</option>  ";
												}else{ echo "<option value='lemhanas' >Lemhanas</option>  "; }
												if ($jnspim == 'lainnya') {	
													echo "<option value='lainnya' selected>lainnya</option>  ";
												}else{ echo "<option value='lainnya' >lainnya</option>  "; }
												
												echo "</select></td>";
												echo "<td title='Tanggal Mulai'><input style='width:160px;' type='date' id='tgldiklatpim' name='tgldiklatpim[]' class='form-control' placeholder='Tanggal Mulai' value=".$tglpim."></td>";
												echo "<td title='Tanggal Selesai'><input style='width:160px;' type='date' id='tglselesaipim' name='tglselesaipim[]' class='form-control' placeholder='Tanggal Selesai' value=".$tglselesaipim."></td>";
												
												echo "<td  title='Penyelenggara Diklat'><input type='text' style='width:300px;' id='tmpdiklatpim' name='tmpdiklatpim[]' class='form-control' placeholder='Penyelenggara Diklat' value='".$tmppim."'></td>";
												echo "<td  title='No Sertifikat'><input type='text' style='width:150px;' id='nosertifikatpim' name='nosertifikatpim[]' class='form-control' placeholder='No. Sertifikat' value='".$nosertifikatpim."'></td>";
												
												echo "<td title='Tanggal Sertifikat'><input style='width:160px;' type='date' id='tglsertifikatpim' name='tglsertifikatpim[]' class='form-control' placeholder='Tanggal Sertifikat' value=".$tglsertifikatpim."></td>";
												echo "<td  title='Jumlah Jam'><input type='text' style='width:70px;' id='jmljampim' name='jmljampim[]' class='form-control' placeholder='jml jam' value='".$jmljampim."'></td>";
												echo "<td  title='Upload Sertifikat'>";
												echo "<input type='file' style='width:300px;' id='berkas' name='berkas[]' class='form-control' placeholder='File Pendukung' value=".base_url('uploads/').$filesertifikat."></td>";
												
												echo "<td  title='File Sertifikat'><input type='text' style='width:100px;' id='filedokpim' name='filedokpim[]' class='form-control' placeholder='No File' value='".$filesertifikat."' readonly='true'></td>";
												
												echo "<td style='display:none;'><input type='text' id='idpim' name='idpim[]' class='form-control'  value='".$idpim."'></td>";
												
												
										echo "</tr>";
										$i++;
								  }
								  
								
						 }else{
									echo "<tr>";
									echo	"<td width='30'><input type='checkbox' name='chk'>";
									echo	"<td title='Nama Diklat'>";
									echo "<select id='jenisdiklatpim' style='width:200px;' name='jenisdiklatpim[]' class='form-control' placeholder='jenis diklat' disabled>";
									echo "	<option value='pilih'>--pilih--</option>  ";
									echo "	<option value='pim1'>pim 1</option>";
									echo "	<option value='pim2'>pim 2</option>";
									echo "	<option value='pim3'>pim 3</option>";
									echo "	<option value='pim4'>pim 4</option>";
									echo "	<option value='lemhanas'>lemhanas</opton>";
									echo "	<option value='lainnya'>lainnya</opton>";
									echo "</select></td>";
									echo "<td  title='tanggal diklat'><input type='date' style='width:160px;' id='tgldiklatpim' name='tgldiklatpim[]' class='form-control' placeholder='tanggal diklat'></td>";
									echo "<td title='Tanggal Selesai'><input style='width:160px;' type='date' id='tglselesaipim' name='tglselesaipim[]' class='form-control' placeholder='Tanggal Selesai'></td>";
									echo "<td  title='penyelenggara diklat'><input type='text' style='width:300px;' id='tmpdiklatpim' name='tmpdiklatpim[]' class='form-control' placeholder='penyelenggara diklat'></td>";
									echo "<td  title='No Sertifikat'><input type='text' style='width:150px;' id='nosertifikatpim' name='nosertifikatpim[]' class='form-control' placeholder='No. Sertifikat'></td>";
									echo "<td title='Tanggal Sertifikat'><input style='width:160px;' type='date' id='tglsertifikatpim' name='tglsertifikatpim[]' class='form-control' placeholder='Tanggal Sertifikat'></td>";
									echo "<td  title='Jumlah Jam'><input type='text' style='width:70px;' id='jmljampim' name='jmljampim[]' class='form-control' placeholder='jml jam'></td>";
									echo "<td  title='Upload sertifikat'><input type='file' style='width:300px;' id='berkas' name='berkas[]' class='form-control' placeholder='file pendukung'></td>";
									echo "<td  title='File Sertifikat'><input type='text' style='width:100px;' id='filedokpim' name='filedokpim[]' class='form-control' placeholder='No File' readonly='true'></td>";
									echo "<td style='display:none;' id='colid'><input type='text' style='font-size:1pt;height:1px;width:1px;' id='idpim' name='idpim[]' class='form-control'></td>";
									echo "</tr>";	
									echo "</tr>";							
						 }
						?>
					</TABLE> <p>
					
					 <label for="add"><a onclick="addRow('dataTable1')">Tambah Diklat</a></label> &nbsp &nbsp &nbsp
					 <label for="del"><a onclick="deleteRow('dataTable1')">Hapus Diklat</a></label>
			  </div>
			  <div class="tab">Anda Pernah Diklat Jabatan Fungsional ?
				<p><select id="tampiljafung" name="tampiljafung" onchange="cekdiklatjafung()" class="form-control"> 
				<option value="pilih">--Diklat Jafung--</option> 
				<?
				 if ($jnsjafung == 'sdhdiklatjafung') 
				 {
						echo "<option value='sdhdiklatjafung' selected>Sudah Diklat Jab. Fungsional</option>" ;
						echo "<option value='blmdiklatjafung'>Belum Diklat Jab. Fungsional</option>" ;
					}
				if ($jnsjafung == 'blmdiklatjafung') 
					{
						echo "<option value='sdhdiklatjafung'>Sudah Diklat Jab. Fungsional</option>" ;
						echo "<option value='blmdiklatjafung' selected>Belum Diklat Jab. Fungsional</option>" ;
					}
				if ($jnsjafung == '')
					{
						echo "<option value='sdhdiklatjafung'>Sudah Diklat Jab. Fungsional</option>" ;
						echo "<option value='blmdiklatjafung'>Belum Diklat Jab. Fungsional</option>" ;
					}
			
				?>
				</select></p>
									
					 
						<TABLE id="dataTable" width="1650" border="1">
							<th>
								<td width="200">Jenis Diklat</td>
								<td width="160">Tanggal Mulai</td>
								<td width="160">Tanggal Selesai</td>
								<td width="300">Penyelenggara</td>
								<td width="150">No Sertifikat</td>
								<td width="160">Tgl Sertifikat</td>
								<td width="70">Jml Jam</td>
								<td width="300">Upload Sertifikat (File Maks 1 MB) </td>
								<td width="100">File Sertifikat</td>
							</th>
							
							 <?	
							$result2 = mysqli_query($link, "SELECT * FROM tr_survey_diklatjafung WHERE id_pegawai=".$idpeg." and tahun=2021");
							$row_cnt = $result2->num_rows;
						    $i=0;
						   if ($row_cnt != 0) {
							   	  while ($row=mysqli_fetch_object($result2))
								  {
										  $idjafung= $row->id;
										  $jnsjafung = $row->jnsdiklatjafung;
										  $tgljafung = $row->tgldiklatjafung;
										  $tmpjafung = $row->tmpdiklatjafung;
										  $filesertifikat = $row->file_sertifikat;
										  $tglselesai = $row->tglselesai;
										  $nosertifikat = $row->no_sertifikat;
										  $tglsertifikat = $row->tgl_sertifikat;
										  $jmljam = $row->jml_jam;
										  echo "<tr>";
												echo	"<td width='30'><input type='checkbox' name='chk'>";
												echo	"<td title='Nama Diklat'>";
												echo    "<input id='jenisdiklatjafung' style='width:200px;'  type='text' name=jenisdiklatjafung[]' class='form-control' placeholder='Nama Diklat' value='".$jnsjafung."'></td>";
													
												echo "<td title='Tanggal Mulai'><input type='date' style='width:160px;' id='tgldiklatjafung' name='tgldiklatjafung[]' class='form-control' placeholder='Tanggal Mulai' value=".$tgljafung."></td>";
												
												echo "<td title='Tanggal Selesai'><input type='date' style='width:160px;' id='tglselesaijafung' name='tglselesaijafung[]' class='form-control' placeholder='Tanggal Selesai' value=".$tglselesai."></td>";
												
												echo "<td title='Penyelenggara Diklat'><input style='width:300px;' type='text'  id='tmpdiklatjafung' name='tmpdiklatjafung[]' class='form-control' placeholder='Penyelenggara Diklat' value='".$tmpjafung."'></td>";
												
												echo "<td title='Nomor Sertifikat'><input style='width:150px;' type='text'  id='nosertifikat' name='nosertifikat[]' class='form-control' placeholder='No Sertifikat' value='".$nosertifikat."'></td>";
												
												echo "<td title='Tanggal Sertifikat'><input type='date' style='width:160px;' id='tglsertifikat' name='tglsertifikat[]' class='form-control' placeholder='Tanggal Sertifikat' value=".$tglsertifikat."></td>";
												
												echo "<td title='Jumlah Jam'><input style='width:70px;' type='text'  id='jmljam' name='jmljam[]' class='form-control' placeholder='jml jam' value='".$jmljam."'></td>";
												
												echo "<td  title='Upload Sertifikat'><input type='file' style='width:300px;' id='berkasjafung' name='berkasjafung[]' class='form-control' placeholder='File Pendukung' value=".base_url('uploads/').$filesertifikat."></td>";
												
												echo "<td  title='File Sertifikat'><input type='text' style='width:100px;' id='filedokjafung' name='filedokjafung[]' class='form-control' placeholder='No File' value='".$filesertifikat."' readonly='true'></td>";
												
												echo "<td style='display:none;' id='colid'><input type='text' style='font-size:1pt;height:1px;width:1px;' id='idjafung' name='idjafung[]' class='form-control'  value='".$idjafung."'></td>";
												
												
										echo "</tr>";
								  }
							  
						   }
						   else{
							  echo "<tr>";
									echo "<td width='30'><input type='checkbox' name='chk'>";
									echo "<td title='Nama Diklat'><input id='jenisdiklatjafung' style='width:200px;' type='text' name=jenisdiklatjafung[]' class='form-control' placeholder='Nama Diklat'></TD>";
									echo "<td title='Tanggal Diklat'><input type='date' style='width:160px;' id='tgldiklatjafung' name='tgldiklatjafung[]' class='form-control' placeholder='Tanggal Diklat'></td>";
									echo "<td title='Tanggal Selesai'><input type='date' style='width:160px;' id='tglselesaijafung' name='tglselesaijafung[]' class='form-control' placeholder='Tanggal Selesai'></td>";
									echo "<td title='Penyelenggara Diklat'><input type='text' style='width:300px;' id='tmpdiklatjafung' name='tmpdiklatjafung[]' class='form-control' placeholder='Penyelenggara Diklat'></TD>";
									echo "<td title='Nomor Sertifikat'><input style='width:150px;' type='text'  id='nosertifikat' name='nosertifikat[]' class='form-control' placeholder='No Sertifikat'></td>";												
									echo "<td title='Tanggal Sertifikat'><input type='date' style='width:160px;' id='tglsertifikat' name='tglsertifikat[]' class='form-control' placeholder='Tanggal Sertifikat'></td>";
									echo "<td title='Jumlah Jam'><input style='width:70px;' type='text'  id='jmljam' name='jmljam[]' class='form-control' placeholder='jml jam'></td>";
									echo "<td  title='Upload Sertifikat'><input style='width:300px;' type='file' id='berkasjafung' name='berkasjafung[]' class='form-control' placeholder='File Pendukung'></td>";
									echo "<td  title='File Sertifikat'><input type='text' style='width:100px;' id='filedokjafung' name='filedokjafung[]' class='form-control' placeholder='No File' readonly='true'></td>";
									echo "<td style='display:none;' id='colid'><input type='text' style='font-size:1pt;height:1px;width:1px;' id='idjafung' name='idjafung[]' class='form-control' ></td>";
									echo "</tr>";	
						   }
						 ?> 
						</TABLE> <p>
						<label for="add"><a onclick="addRow('dataTable')">Tambah Diklat</a></label> &nbsp &nbsp &nbsp
					    <label for="del"><a onclick="deleteRow('dataTable')">Hapus Diklat</a></label>
			  </div>
			  <div class="tab">Dalam 1 tahun terakhir (2021), apakah anda pernah mengikuti Diklat 20 Jam Pelajaran (akumulasi JP minimal 20 JP) ?
					 <p><select id="tampil20jp" name="tampil20jp" onchange="cekdiklatjp()" class="form-control">
					 <option value="pilih">--Diklat 20 JP--</option>

					 <?
					 if ($jp == 'sdhdiklat20jp') {
							echo "<option value='sdhdiklat20jp' selected>Sudah Diklat 20 JP</option>" ;
							echo "<option value='blm20jp'>Belum Diklat 20 JP</option>" ;
					}
					 if ($jp == 'blm20jp') {
							echo "<option value='sdhdiklat20jp'>Sudah Diklat 20 JP</option>" ;
							echo "<option value='blm20jp' selected>Belum Diklat 20 JP</option>" ;
						}
					if ($jp == '')
						{
							echo "<option value='sdhdiklat20jp'>Sudah Diklat 20 JP</option>" ;
							echo "<option value='blm20jp'>Belum Diklat 20 JP</option>" ;
							
						}
					?>
					</select></p>
					 
						<TABLE id="dataTable3" width="1650" border="1">
							<th>
								<td width="200">Jenis Diklat</td>
								<td width="160">Tanggal Mulai</td>
								<td width="160">Tanggal Selesai</td>
								<td width="300">Penyelenggara</td>
								<td width="150">No Sertifikat</td>
								<td width="160">Tgl Sertifikat</td>
								<td width="70">Jml Jam</td>
								<td width="300">Upload Sertifikat (File Maks 1 MB) </td>
								<td width="100">File Sertifikat</td>
							</th>
							
							<?	
							$result2 = mysqli_query($link, "SELECT * FROM tr_survey_diklat20jp WHERE id_pegawai=".$idpeg." and tahun=2021");
							$row_cnt = $result2->num_rows;
						 
						   if ($row_cnt != 0) {
							   	  while ($row=mysqli_fetch_object($result2))
								  {
										  $idjp = $row->id;
										  $jnsjp = $row->jns_diklat;
										  $tgljp = $row->tgl_diklat;
										  $tglselesai = $row->tglselesai;
										  $tmpjp = $row->tmp_diklat;
										  $nosertifikat = $row->nosertifikat;
										  $tglsertifikat = $row->tglsertifikat;
										  $jmljam = $row->jmljam;
										  $filesertifikat = $row->file_sertifikat;
										  
										  echo "<tr>";
												echo	"<td width='30'><input type='checkbox' name='chk'>";
												echo	"<TD title='Nama Diklat'>";
												echo	"<input id='jenisdiklatjp' style='width:200px;' maxlength='200px' type='text' name=jenisdiklatjp[]' class='form-control' placeholder='Nama Diklat' value='".$jnsjp."'></td>";
																								
												echo "<td title='Tanggal Mulai'><input type='date' style='width:160px;' id='tgldiklatjp' name='tgldiklatjp[]' class='form-control' placeholder='Tanggal Mulai' value=".$tgljp."></td>";
												
												echo "<td title='Tanggal Selesai'><input type='date' style='width:160px;' id='tglselesaijp' name='tglselesaijp[]' class='form-control' placeholder='Tanggal Selesai' value=".$tglselesai."></td>";
												
												echo "<TD title='Penyelenggara Diklat'><input style='width:300px;' type='text'  id='tmpdiklatjp' name='tmpdiklatjp[]' class='form-control' placeholder='Penyelenggara Diklat' value='".$tmpjp."'></TD>";
												
												echo "<TD title='No Sertifikat'><input style='width:150px;' type='text'  id='nosertifikatjp' name='nosertifikatjp[]' class='form-control' placeholder='No Sertifikat' value='".$nosertifikat."'></TD>";
												
												echo "<td title='Tanggal Sertifikat'><input type='date' style='width:160px;' id='tglsertifikatjp' name='tglsertifikatjp[]' class='form-control' placeholder='Tanggal Sertifikat' value=".$tglsertifikat."></td>";
												
												echo "<TD title='Jumlah Jam'><input style='width:70px;' type='text'  id='jmljamjp' name='jmljamjp[]' class='form-control' placeholder='jml jam' value='".$jmljam."'></TD>";
												
												echo "<td  title='Upload Sertifikat'><input type='file' style='width:300px;' id='berkasjp' name='berkasjp[]' class='form-control' placeholder='File Pendukung' value=".base_url('uploads/').$filesertifikat."></td>";
												
												echo "<td  title='File Sertifikat'><input type='text' style='width:100px;' id='filedokjp' name='filedokjp[]' class='form-control' placeholder='No File' value='".$filesertifikat."' readonly='true'></td>";
												
												echo "<td style='display:none;'><input type='text' style='font-size:1pt;height:1px;width:1px;' id='idjp' name='idjp[]' class='form-control'  value='".$idjp."'></td>";
												
										echo "</tr>";
								  }
							  
						   }
						   else{
							  echo "<tr>";
									echo "<td width='30'><input type='checkbox' name='chk'>";
									echo "<td title='Nama Diklat'><input id='jenisdiklatjp' style='width:200px;'  type='text' name=
									jenisdiklatjp[]' class='form-control' placeholder='Nama Diklat'></TD>";
									echo "<td title='Tanggal Diklat'><input type='date' style='width:160px;' id='tgldiklatjp' name='tgldiklatjp[]' class='form-control' placeholder='Tanggal Diklat'></td>";
									echo "<td title='Tanggal Selesai'><input type='date' style='width:160px;' id='tglselesaijp' name='tglselesaijp[]' class='form-control' placeholder='Tanggal Selesai'></td>";
									echo "<td title='Penyelenggara Diklat'><input type='text' style='width:300px;' id='tmpdiklatjp' name='tmpdiklatjp[]' class='form-control' placeholder='Penyelenggara Diklat'></TD>";
									echo "<TD title='No Sertifikat'><input style='width:150px;' type='text'  id='nosertifikatjp' name='nosertifikatjp[]' class='form-control' placeholder='No Sertifikat'></TD>";
												
									echo "<td title='Tanggal Sertifikat'><input type='date' style='width:160px;' id='tglsertifikatjp' name='tglsertifikatjp[]' class='form-control' placeholder='Tanggal Sertifikat'></td>";
									
									echo "<TD title='Jumlah Jam'><input style='width:70px;' type='text'  id='jmljamjp' name='jmljamjp[]' class='form-control' placeholder='jml jam'></TD>";
									
									echo "<td  title='Upload Sertifikat'><input style='width:300px;' type='file' id='berkasjp' name='berkasjp[]' class='form-control' placeholder='File Pendukung'></td>";
									
									echo "<td  title='File Sertifikat'><input type='text' style='width:100px;' id='filedokjp' name='filedokjp[]' class='form-control' placeholder='No File' readonly='true'></td>";
									
									echo "<td style='display:none;' id='colid'><input type='text' style='font-size:1pt;height:1px;width:1px;' id='idjp' name='idjp[]' class='form-control'></td>";
									echo "</tr>";	
						   }
						 ?> 
						
						</TABLE> <p>
						<label for="add"><a onclick="addRow('dataTable3')">Tambah Diklat</a></label> &nbsp &nbsp &nbsp
					    <label for="del"><a onclick="deleteRow('dataTable3')">Hapus Diklat</a></label>
					 
			  </div>
			  <div class="tab">Dalam 2 tahun terakhir (2020 sd 2021), apakah anda pernah mengikuti Seminar/Workshop/Magang/Kursus/sejenisnya ?
				   <p><select id="tampilseminar" name="tampilseminar" onchange="cekseminar()" class="form-control">
					 <option value="pilih">--Seminar--</option>
					  <?
					 if ($jnsseminar == 'sdhseminar') {
							echo "<option value='sdhseminar' selected>Sudah Ikut Seminar</option>" ;
							echo "<option value='blmseminar'>Belum Ikut Seminar</option>" ;
						}
					 if ($jnsseminar == 'blmseminar'){
							echo "<option value='sdhseminar'>Sudah Ikut Seminar</option>" ;
							echo "<option value='blmseminar' selected>Belum Ikut Seminar</option>" ;
						}
					if ($jnsseminar == '')
					{
						echo "<option value='sdhseminar'>Sudah Ikut Seminar</option>" ;
						echo "<option value='blmseminar'>Belum Ikut Seminar</option>" ;
					}
					?>
					 </select></p>
					 
					<TABLE id="dataTable4" width="1650" border="1">
							<th>
								<td width="200">Jenis Seminar</td>
								<td width="160">Tanggal Mulai</td>
								<td width="160">Tanggal Selesai</td>
								<td width="300">Penyelenggara</td>
								<td width="150">No Sertifikat</td>
								<td width="160">Tgl Sertifikat</td>
								<td width="70">Jml Jam</td>
								<td width="300">Sertifikat (File Maks 1 MB) </td>
								<td width="100">File Sertifikat</td>
							</th>
							<?	
							$result2 = mysqli_query($link, "SELECT * FROM tr_survey_seminar WHERE id_pegawai=".$idpeg." and tahun=2021");
							$row_cnt = $result2->num_rows;
						 
						   if ($row_cnt != 0) {
							   	  while ($row=mysqli_fetch_object($result2))
								  {
										  $idseminar = $row->id;
										  $jnsseminar = $row->jnsseminar;
										  $tglseminar = $row->tglseminar;
										  $tglselesai = $row->tglselesai;
										  $tmpseminar = $row->tmpseminar;
										  $nosertifikat = $row->nosertifikat;
										  $tglsertifikat = $row->tglsertifikat;
										  $jmljam = $row->jmljam;
										  $filesertifikat = $row->file_sertifikat;
										  echo "<tr>";
												echo	"<td width='30'><input type='checkbox' name='chk'>";
												echo	"<TD title='Nama Diklat'>";
												echo	"<input id='jnsseminar' style='width:200px;' type='text' name=jnsseminar[]' class='form-control' placeholder='Nama Seminar' value='".$jnsseminar."'></TD>";
													
												echo "<td title='Tanggal Mulai'><input type='date' style='width:160px;' id='tglseminar' name='tglseminar[]' class='form-control' placeholder='Tanggal Mulai' value=".$tglseminar."></td>";
												
												echo "<td title='Tanggal Selesai'><input type='date' style='width:160px;' id='tglselesaismnr' name='tglselesaismnr[]' class='form-control' placeholder='Tanggal Selesai' value=".$tglselesai."></td>";
												
												echo "<TD title='Penyelenggara Diklat'><input style='width:300px;' id='tmpseminar' name='tmpseminar[]' class='form-control' placeholder='Penyelenggara' value='".$tmpseminar."'></TD>";
												
												echo "<TD title='No Sertifikat'><input style='width:150px;' id='nosertifikatsmnr' name='nosertifikatsmnr[]' class='form-control' placeholder='No Sertifikat' value='".$nosertifikat."'></TD>";
												
												echo "<td title='Tanggal Sertifikat'><input type='date' style='width:160px;' id='tglsertifikatsmnr' name='tglsertifikatsmnr[]' class='form-control' placeholder='Tanggal Sertifikat' value=".$tglsertifikat."></td>";
												
												echo "<TD title='Jumlah Jam'><input style='width:70px;' id='jmljamsmnr' name='jmljamsmnr[]' class='form-control' placeholder='jml jam' value='".$jmljam."'></TD>";
											
												
												echo "<td  title='Upload Sertifikat'><input type='file' style='width:300px;' id='berkasseminar' name='berkasseminar[]' class='form-control' placeholder='File Pendukung' value=".base_url('uploads/').$filesertifikat."></td>";
												
												echo "<td  title='File Sertifikat'><input type='text' style='width:100px;' id='filedokseminar' name='filedokseminar[]' class='form-control' placeholder='No File' value='".$filesertifikat."' readonly='true'></td>";
												
												echo "<td style='display:none;' ><input type='text' style='font-size:1pt;height:1px;width:1px;' id='idseminar' name='idseminar[]' class='form-control'  value='".$idseminar."'></td>";
												
												
										echo "</tr>";
								  }
							  
						   }
						   else{
							  echo "<tr>";
									echo "<td width='30'><input type='checkbox' name='chk'>";
									echo "<td title='Nama Diklat'><input id='jnsseminar' style='width:200px;' type='text' name=jnsseminar[]' class='form-control' placeholder='Nama Seminar'></TD>";
									echo "<td title='Tanggal Diklat'><input type='date' style='width:160px;' id='tglseminar' name='tglseminar[]' class='form-control' placeholder='Tanggal Seminar'></td>";
									echo "<td title='Tanggal Selesai'><input type='date' style='width:160px;' id='tglselesaismnr' name='tglselesaismnr[]' class='form-control' placeholder='Tanggal Selesai'></td>";
									echo "<td title='Penyelenggara Diklat'><input type='text' style='width:300px;' id='tmpseminar' name='tmpseminar[]' class='form-control' placeholder='Penyelenggara'></TD>";
									echo "<TD title='No Sertifikat'><input style='width:150px;' id='nosertifikatsmnr' name='nosertifikatsmnr[]' class='form-control' placeholder='No Sertifikat'></TD>";
												
									echo "<td title='Tanggal Sertifikat'><input type='date' style='width:160px;' id='tglsertifikatsmnr' name='tglsertifikatsmnr[]' class='form-control' placeholder='Tanggal Sertifikat'></td>";
									
									echo "<TD title='Jumlah Jam'><input style='width:70px;' id='jmljamsmnr' name='jmljamsmnr[]' class='form-control' placeholder='jml jam'></TD>";
									
									echo "<td  title='Upload Sertifikat'><input style='width:300px;' type='file' id='berkasseminar' name='berkasseminar[]' class='form-control' placeholder='File Pendukung'></td>";
									echo "<td  title='File Sertifikat'><input type='text' style='width:100px;' id='filedokseminar' name='filedokseminar[]' class='form-control' placeholder='No File' readonly='true'></td>";
									
									echo "<td style='display:none;'><input type='text' style='font-size:1pt;height:1px;width:1px;' id='idseminar' name='idseminar[]' class='form-control'></td>";
									echo "</tr>";	
						   }
						 ?> 
						
					</TABLE> <p>
					<label for="add"><a onclick="addRow('dataTable4')">Tambah Seminar</a></label> &nbsp &nbsp &nbsp
					<label for="del"><a onclick="deleteRow('dataTable4')">Hapus Seminar</a></label>
			  </div>
			  
			  <div class="tab"> Pendidikan Terakhir Anda:
				<select name="pendidikan" id="pendidikan" class="form-control">
					 <option value="pilih">--Pilih--</option>  
					 <?
						 if ($pendidikan == 'S3') { ?>
								  <option value="S3" selected>S3</option>
							   	  <option value="S2">S2</option>  
								  <option value="S1D4">S1/D4</option>  
								  <option value="D3">D3</option> 
								  <option value="D2D1SMASMK">D2/D1/SMA/SMK</option>  
								  <option value="SMPSD">SMP/SD</option>  
						
							<?
							}
						if ($pendidikan == 'S2') { ?>
								  <option value="S3">S3</option>
							   	  <option value="S2" Selected>S2</option>  
								  <option value="S1D4">S1/D4</option>  
								  <option value="D3">D3</option> 
								  <option value="D2D1SMASMK">D2/D1/SMA/SMK</option>  
								  <option value="SMPSD">SMP/SD</option>  
							<?
							}
						if ($pendidikan == 'S1D4') { ?>
								  <option value="S3">S3</option>
							   	  <option value="S2">S2</option>  
								  <option value="S1D4" selected>S1/D4</option>  
								  <option value="D3">D3</option> 
								  <option value="D2D1SMASMK">D2/D1/SMA/SMK</option>  
								  <option value="SMPSD">SMP/SD</option>  
							<?
							}
						if ($pendidikan == 'D3') { ?>
								  <option value="S3">S3</option>
							   	  <option value="S2">S2</option>  
								  <option value="S1D4">S1/D4</option>  
								  <option value="D3" selected>D3</option> 
								  <option value="D2D1SMASMK">D2/D1/SMA/SMK</option>  
								  <option value="SMPSD">SMP/SD</option>  
							<?
							}
						
						if ($pendidikan == 'D2D1SMASMK') { ?>
								  <option value="S3">S3</option>
							   	  <option value="S2">S2</option>  
								  <option value="S1D4">S1/D4</option>  
								  <option value="D3">D3</option> 
								  <option value="D2D1SMASMK" Selected>D2/D1/SMA/SMK</option>  
								  <option value="SMPSD">SMP/SD</option>  
							<?
							}
						
						if ($pendidikan == 'SMPSD') { ?>
								  <option value="S3">S3</option>
							   	  <option value="S2">S2</option>  
								  <option value="S1D4">S1/D4</option>  
								  <option value="D3">D3</option> 
								  <option value="D2D1SMASMK">D2/D1/SMA/SMK</option>  
								  <option value="SMPSD" selected>SMP/SD</option>  
							<?
							}
						
						if ($pendidikan == '') { ?>
								  <option value="S3">S3</option>
							   	  <option value="S2">S2</option>  
								  <option value="S1D4">S1/D4</option>  
								  <option value="D3">D3</option> 
								  <option value="D2D1SMASMK">D2/D1/SMA/SMK</option>  
								  <option value="SMPSD">SMP/SD</option>  
							<?
							}						
						?>
					  
					 </select><p>
			  </div>
			  
			  
			  
			  <div class="tab">Anda Pernah Dijatuhi Hukuman Disiplin :
				<select name="hukuman" id="hukuman" onchange="cekhukuman()" class="form-control">
				 <option value="pilih">--Pilih--</option>  
				 <?
							if ($hukuman == 'Berat') { ?>
							  <option value="Berat" selected>Berat</option>  
							  <option value="Sedang">Sedang</option>  
							  <option value="Ringan">Ringan</option>  
							  <option value="Tidak Pernah">Tidak Pernah</option>  
						
							<?
							}
							if ($hukuman == 'Sedang') { ?>
							  <option value="Berat">Berat</option>  
							  <option value="Sedang" selected>Sedang</option>  
							  <option value="Ringan">Ringan</option>  
							  <option value="Tidak Pernah">Tidak Pernah</option>  
						
							<?
							}
							if ($hukuman == 'Ringan') { ?>
							  <option value="Berat">Berat</option>  
							  <option value="Sedang">Sedang</option>  
							  <option value="Ringan" selected>Ringan</option>  
							  <option value="Tidak Pernah">Tidak Pernah</option>  
						
							<?
							}
							if ($hukuman == 'Tidak Pernah') { ?>
							  <option value="Berat">Berat</option>  
							  <option value="Sedang">Sedang</option>  
							  <option value="Ringan">Ringan</option>  
							  <option value="Tidak Pernah" selected>Tidak Pernah</option>  
						
							<?
							}
							if ($hukuman == '') { ?>
							  <option value="Berat">Berat</option>  
							  <option value="Sedang">Sedang</option>  
							  <option value="Ringan">Ringan</option>  
							  <option value="Tidak Pernah">Tidak Pernah</option>  
							<?
							}
					?>
				 </select><p>
				 <?
							$result2 = mysqli_query($link, "SELECT * FROM tr_survey_hukuman WHERE id_pegawai=".$idpeg." and tahun=2021");
							$row_cnt = $result2->num_rows;
						 
						   if ($row_cnt != 0) {
							    while ($row=mysqli_fetch_object($result2))
								  {
									  $idhukuman = $row->id;
									  $ttdsk = $row->penandatangansk;
									  $tglsk = $row->tglsk;
									  $alasan= $row->alasan;
									  $filesertifikat = $row->file_sertifikat;
									
									echo   "	<table border=0 id='dataTable5' width=800> ";
									echo	 "<tr>";
									echo			"<td width=100>Penandatangan SK</td>";
									echo	"	<td>";
									echo	"		<div class='input-group'>";
									echo	"	<input type='hidden' id='idhukuman' name='idhukuman' value=".$idhukuman.">";
									//echo	"	<input type='hidden' id='filedokhukuman' name='filedokhukuman' value=".$filesertifikat.">";
									echo	"		<input id='ttdsk' maxlength='200' size='200' type='text' name='ttdsk' class='form-control' value='".$ttdsk."'>";
									echo	"		</div>";								
									echo	"	</td>";
									echo	" </tr>";
									echo	" <tr>";
									echo	"	<td>Tanggal Surat</td>";
									echo	"	<td>";
									echo	"			<div class='input-group'>";
									echo	"					<input type='text' maxlength='100' size='100' id='tglsurat' name='tglsurat' class='form-control timerange' value=".$tglsk."> ";
									echo	"				</div>";
									echo	"	</td>";
									echo	" </tr>";
									echo	" <tr>";
									echo	"	<td>Alasan Sanksi</td>";
									echo	"	<td>";
									echo	"		<div class='input-group'>";
									echo	"<input type='text' maxlength='400' size='400' id='alasan' name='alasan' class='form-control' value='".$alasan."'>";
									echo	"	</div>";
									echo	"<td>";
									echo	"</tr>";
										
									echo	"<tr>";
									echo	"	<td>Upload SK (File Maks. 1 MB)</td>";
									echo	"	<td>";
									echo    	"<div class='input-group'>";
									echo		"<input type='file' style='width:300px;' id='berkashukuman' name='berkashukuman' class='form-control' placeholder='File Pendukung'></td>";
									echo	"</div>";
									echo	"</tr>";			
										
									echo	"<tr>";
									echo	"	<td>File SK</td>";
									echo	"<td>";
								    echo		"<div class='input-group'>";
								    //echo		"<a href=".base_url('uploads/').$filesertifikat." target='_blank'>".$filesertifikat."</a>";
									echo			"<input type='text' style='width:180px;' id='filedokhukuman' name='filedokhukuman' class='form-control' value='".$filesertifikat."' readonly='true'>";
								    echo		"</div>";
									echo	"</td>";
								    echo	"</tr>";
													
									echo	"</table><p>";
								  }
						   }
						else {
									echo "	<table border=0 width=800> ";
									echo	 "<tr>";
									echo			"<td width=100>Penandatangan SK</td>";
									echo	"	<td>";
									echo	"		<div class='input-group'>";
									echo	"	<input type='hidden' id='idhukuman' name='idhukuman'>";
									//echo	"	<input type='hidden' id='filedokhukuman' name='filedokhukuman'>";
									echo	"		<input id='ttdsk' maxlength='200' size='200' type='text' name='ttdsk' class='form-control'>";
									echo	"		</div>";								
									echo	"	</td>";
									echo	" </tr>";
									echo	" <tr>";
									echo	"	<td>Tanggal Surat</td>";
									echo	"	<td>";
									echo	"			<div class='input-group'>";
									echo	"					<input type='text' maxlength='100' size='100' id='tglsurat' name='tglsurat' class='form-control timerange'> ";
									echo	"				</div>";
									echo	"	</td>";
									echo	" </tr>";
									echo	" <tr>";
									echo	"	<td>Alasan Sanksi</td>";
									echo	"	<td>";
									echo	"		<div class='input-group'>";
									echo	"<input type='text' maxlength='400' size='400' id='alasan' name='alasan' class='form-control'>";
									echo	"	</div>";
									echo	"<td>";
									echo	"</tr>";
										
									echo	"<tr>";
									echo	"	<td>Upload SK (File Maks. 1 MB)</td>";
									echo	"	<td>";
									echo    	"<div class='input-group'>";
									echo		"<input type='file' style='width:300px;' id='berkashukuman' name='berkashukuman' class='form-control' placeholder='File Pendukung'></td>";
									echo	"</div>";
									echo	"</tr>";			
										
									echo	"<tr>";
									echo	"	<td>File SK</td>";
									echo	"<td>";
								    echo		"<div class='input-group'>";
								    // echo		"No File";
									echo        "<input type='text' style='width:180px;' id='filedokhukuman' name='filedokhukuman' class='form-control' placeholder='No File' readonly='true'>";
								    echo		"</div>";
									echo	"</td>";
								    echo	"</tr>";
													
									echo	"</table><p>";
						 } ?>	  
						   
						
			  </div>
			  
			  <div class="tab"> 
				<table border="0" width="800" >
					<tr>
						<td width="50"><input type="checkbox" id="disclaimer" name="disclaimer" value="1"></td>
						<td width="900"><label for="disclaimer">Saya bertanggungjawab atas kebenaran data yang telah saya isi di dalam survey ini.</label><br></td>
					</tr>
				</table> <p>
			  </div><p><p><p><p>
			  <div style="overflow:auto;">
			  <div style="float:left;">
<!--				  <button type="button" id="closeBtn" onclick="nextPrev(0)" >Tutup (Kembali ke Dashboard)</button> 
				  <button type="button" id="closeBtn" data-dismiss="modal" onclick="nextPrev(0)">Tutup</button> -->
				</div>
				<div style="text-align:center;">
				  <button type="button" id="prevBtn" onclick="nextPrev(-1)">Sebelumnya</button>
				  <button type="button" id="nextBtn" onclick="nextPrev(1)" >Berikutnya</button>
				</div>
			  </div>
			  <!-- Circles which indicates the steps of the form: -->
			  <div style="text-align:center;margin-top:40px;">
				<span class="step"></span>
				<span class="step"></span>
				<span class="step"></span>
				<span class="step"></span>
				<span class="step"></span>
				<span class="step"></span>
				<span class="step"></span>
				<span class="step"></span>
				<span class="step"></span>
			  </div>
			  
			</form>
	 </div>
   
  </div>
 </div>
</div>


<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab


function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Selesai";
  } else {
    document.getElementById("nextBtn").innerHTML = "Berikutnya";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
  
}

function nextPrev(n) {
	if (n==0) {
		document.getElementById("form1").jabatan.value = 'pilih';
		document.getElementById("form1").submit();
		return false;
	}
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) {
	  alert("Lengkapi Pengisian Data !");
	return false; }
  /* if (n == 1 && !validateForm2()) {
	  alert("Lengkapi Pengisian Data !");
	return false; } */
	//alert(currentTab);
    if (currentTab==0 && document.getElementById("form1").jabatan.value=='CPNS') {
		sessionStorage.setItem("showw", 0);
	  alert("Status anda masih CPNS, Anda dapat melewati survey Indeks Profesionalitas");
	  document.getElementById("form1").submit();
	  return false;
	}  
	  
	  if (currentTab == 2){
		var jnsdiklat=document.getElementById("form1").tampil.value;
		
		  if (jnsdiklat=='sdhpim') 
		  {
			 
				var table = document.getElementById("dataTable1");
				var rowCount = table.rows.length;
				
				for(var i=1; i<rowCount; i++) {
					var row = table.rows[i];
					var tgl = row.cells[2].childNodes[0].value;
					var tglselesaipim = row.cells[3].childNodes[0].value;
					var tmppim = row.cells[4].childNodes[0].value;
					var nosertifikatpim = row.cells[5].childNodes[0].value;
					var tglsertifikatpim = row.cells[6].childNodes[0].value;
					var jmljampim = row.cells[7].childNodes[0].value;
					var berkas = row.cells[8].childNodes[0].value;
					var id = row.cells[9].childNodes[0].value;
					
					if (tgl=="") {
							alert("Anda belum mengisi Tanggal Diklat!");
							return false;
					}
					if (tglselesaipim=="") {
							alert("Anda belum mengisi Tanggal Selesai Diklat!");
							return false;
					}
					if(tmppim=="")
						  {
							alert("Anda belum mengisi Tempat Diklat");
							return false ;
						  }
					if (nosertifikatpim=="") {
							alert("Anda belum mengisi No Sertifikat!");
							return false;
					}
					if (tglsertifikatpim=="") {
							alert("Anda belum mengisi Tgl Sertifikat!");
							return false;
					}
					if (jmljampim=="") {
							alert("Anda belum mengisi Jumlah Jam!");
							return false;
					}
					if (id=="") {
						if (berkas=="") {
								alert("Anda belum mengupload sertifikat!");
								return false;
						}
					}
					
					
				}
			  
		  }
		  
		 
	   }
	   
	   if (currentTab == 1){
			var niltotal=document.getElementById("form1").niltotal.value;
			if ((niltotal==0) || (niltotal=='')) {
					alert("Anda belum mengisi SKP");
					return false;
			}
			var nipatasan=document.getElementById("form1").nipatasan.value;
			if (nipatasan=='') {
					alert("Anda belum mengisi data pejabat penilai");
					return false;
			}
			var nippejabat=document.getElementById("form1").nippejabat.value;
			if (nippejabat=='') {
					alert("Anda belum mengisi data atasan pejabat penilai");
					return false;
			}
	   }
	  
	   if (currentTab == 3){
		var jnsdiklat=document.getElementById("form1").tampiljafung.value;
	
		  if (jnsdiklat=='sdhdiklatjafung') 
		  {
			 
				var table = document.getElementById("dataTable");
				var rowCount = table.rows.length;
				
				for(var i=1; i<rowCount; i++) {
					var row = table.rows[i];
					var nama = row.cells[1].childNodes[0].value;
					var tgl = row.cells[2].childNodes[0].value;
					var tglselesai = row.cells[3].childNodes[0].value;
					var tmppim = row.cells[4].childNodes[0].value;
					var nosertifikat = row.cells[5].childNodes[0].value;
					var tglsertifikat = row.cells[6].childNodes[0].value;
					var jmljam = row.cells[7].childNodes[0].value;
					var berkas = row.cells[8].childNodes[0].value;
					var id = row.cells[9].childNodes[0].value;
					
					if (nama=="") {
							alert("Anda belum mengisi nama diklat");
							return false;
					}
					if (tgl=="") {
							alert("Anda belum mengisi Tanggal Mulai Diklat!");
							return false;
					}
					if (tglselesai=="") {
							alert("Anda belum mengisi Tanggal Selesai Diklat!");
							return false;
					}
					if(tmppim=="")
						  {
							alert("Anda belum mengisi Tempat Diklat");
							return false ;
						  }
					if (nosertifikat=="") {
							alert("Anda belum mengisi No Sertifikat!");
							return false;
					}
					if (tglsertifikat=="") {
							alert("Anda belum mengisi Tgl Sertifikat!");
							return false;
					}
					if (jmljam=="") {
							alert("Anda belum mengisi Jumlah Jam!");
							return false;
					}
					if (id=="") {
						if (berkas=="") {
								alert("Anda belum mengupload sertifikat!");
								return false;
						}
					}
					
					
				}
			  
		  }
		  
		 
	   }
		 
		if (currentTab == 5){
		var jnsdiklat=document.getElementById("form1").tampilseminar.value;
		
		  if (jnsdiklat=='sdhseminar') 
		  {
			  	var table = document.getElementById("dataTable4");
				var rowCount = table.rows.length;
				
				for(var i=1; i<rowCount; i++) {
					var row = table.rows[i];
					var nama = row.cells[1].childNodes[0].value;
					var tgl = row.cells[2].childNodes[0].value;
					var tglselesai = row.cells[3].childNodes[0].value;
					var tmppim = row.cells[4].childNodes[0].value;
					var nosertifikat = row.cells[5].childNodes[0].value;
					var tglsertifikat = row.cells[6].childNodes[0].value;
					var jmljam = row.cells[7].childNodes[0].value;
					var berkas = row.cells[8].childNodes[0].value;
					var id = row.cells[9].childNodes[0].value;
					
					if (nama=="") {
							alert("Anda belum mengisi nama seminar");
							return false;
					}
					if (tgl=="") {
							alert("Anda belum mengisi tanggal mulai seminar");
							return false;
					}
					
					if (tglselesai=="") {
							alert("Anda belum mengisi tanggal selesai seminar");
							return false;
					}
					if(tmppim=="")
						  {
							alert("Anda belum mengisi tempat seminar");
							return false ;
						  }
					if(nosertifikat=="")
						  {
							alert("Anda belum mengisi no sertifikat");
							return false ;
						  }
					if(tglsertifikat=="")
						  {
							alert("Anda belum mengisi tanggal sertifikat");
							return false ;
						  }
					if(jmljam=="")
						  {
							alert("Anda belum mengisi Jumlah Jam");
							return false ;
						  }
					if (id=="") {
						if (berkas=="") {
								alert("Anda belum mengupload sertifikat!");
								return false;
						}
					}
					
					
				}
		  }
		}
  
	if (currentTab == 4){
		var jnsdiklat=document.getElementById("form1").tampil20jp.value;

		  if (jnsdiklat=='sdhdiklat20jp') 
		  {
			    var table = document.getElementById("dataTable3");
				var rowCount = table.rows.length;
				
				for(var i=1; i<rowCount; i++) {
					var row = table.rows[i];
					var nama = row.cells[1].childNodes[0].value;
					var tgl = row.cells[2].childNodes[0].value;
					var tglselesai = row.cells[3].childNodes[0].value;
					var tmppim = row.cells[4].childNodes[0].value;
					var nosertifikat = row.cells[5].childNodes[0].value;
					var tglsertifikat 	= row.cells[6].childNodes[0].value;
					var jmljam = row.cells[7].childNodes[0].value;
					var berkas = row.cells[8].childNodes[0].value;
					var id = row.cells[9].childNodes[0].value;
					
					if (nama=="") {
							alert("Anda belum mengisi nama diklat");
							return false;
					}
					if (tgl=="") {
							alert("Anda belum mengisi tanggal mulai diklat");
							return false;
					}
					if (tglselesai=="") {
							alert("Anda belum mengisi tanggal selesai diklat");
							return false;
					}
					
					if(tmppim=="")
						  {
							alert("Anda belum mengisi tempat diklat");
							return false ;
						  }
					if(nosertifikat=="")
						  {
							alert("Anda belum mengisi no sertifikat");
							return false ;
						  }
					if(tglsertifikat=="")
						  {
							alert("Anda belum mengisi tgl sertifikat");
							return false ;
						  }
					if(jmljam=="")
						  {
							alert("Anda belum mengisi Jumlah Jam");
							return false ;
						  }
					if (id=="") {
						if (berkas=="") {
								alert("Anda belum mengupload sertifikat!");
								return false;
						}
					}
					
					
					
					
				}
		  }
	}
  
  if (currentTab == 7){
		var jnsdiklat=document.getElementById("form1").hukuman.value;
	//alert(jnsdiklat);
		  if (jnsdiklat!="Tidak Pernah") 
		  {
			  
				var tglsurat = document.getElementById("tglsurat").value ;
				var alasan = document.getElementById("alasan").value ;
				var ttdsk = document.getElementById("ttdsk").value ;
				var berkas = document.getElementById("berkashukuman").value;
				var id = document.getElementById("idhukuman").value;
				if (ttdsk=="") {
							alert("Anda belum mengisi Penandatangan SK");
							return false;
					}
					
				if (tglsurat=="") {
							alert("Anda belum mengisi Tgl Surat");
							return false;
					}
				
				if (alasan=="") {
							alert("Anda belum mengisi Alasan Hukuman Disiplin");
							return false;
					}
				if (id=="") {
					if (berkas=="") {
								alert("Anda belum Mengupload SK");
								return false;
						}
				}
			    
		  }
	}
	
  if (currentTab == 8)  {
	 if (!document.getElementById("disclaimer").checked == true ) {
		alert("Anda belum mengisi pertanggungjawaban pengisian data !");
		return false ;
	} 
  }
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:	
	
	sessionStorage.setItem("showw", 0);
	alert("Terima Kasih Sudah Mengisi Survey Indeks Profesionalitas");
	
    document.getElementById("form1").submit();
	
	return false;
  }
  // Otherwise, display the correct tab:

  //alert(currentTab);
  
  
  
    if (currentTab == 2) { cekenablepim(); }
   
   if (currentTab == 3) { cekenablejafung(); }
   
   if (currentTab == 4) { cekenablejp(); }
   
  if (currentTab == 5) { cekenableseminar(); }
  
  if (currentTab == 7) { cekenablehukuman(); }
	
	showTab(currentTab);
}

function cekenablepim(){
  var diklatpim=document.getElementById("form1").tampil.value;
  if (diklatpim=="sdhpim")
    {	        
		document.getElementById("jenisdiklatpim").disabled = false; 
		document.getElementById("tgldiklatpim").disabled = false; 
		document.getElementById("tmpdiklatpim").disabled = false;
		document.getElementById("berkas").disabled = false;
		document.getElementById("tglselesaipim").disabled = false;
		document.getElementById("nosertifikatpim").disabled = false;
		document.getElementById("tglsertifikatpim").disabled = false;
		document.getElementById("jmljampim").disabled = false;
		//document.getElementById("filediklatpim").disable = false;
		
    }
  if (diklatpim=="blmpim")
    {	
		document.getElementById("tgldiklatpim").value = "01-01-1900";
		document.getElementById("tmpdiklatpim").value = "-";
		document.getElementById("jenisdiklatpim").value = "-";
		document.getElementById("tglselesaipim").value ="01-01-1900";
		document.getElementById("nosertifikatpim").value ="-";
		document.getElementById("tglsertifikatpim").value ="01-01-1900";
		document.getElementById("jmljampim").value ="-";
		document.getElementById("jenisdiklatpim").disabled = true; 
		document.getElementById("tgldiklatpim").disabled = true; 
		document.getElementById("tmpdiklatpim").disabled = true;
		document.getElementById("berkas").disabled = true;
		document.getElementById("tglselesaipim").disabled = true;
		document.getElementById("nosertifikatpim").disabled = true;
		document.getElementById("tglsertifikatpim").disabled = true;
		document.getElementById("jmljampim").disabled = true;
		
    }
}

function cekenablejafung(){
	
  var diklat=document.getElementById("form1").tampiljafung.value;
  
  if (diklat=="sdhdiklatjafung")
    {	        
		document.getElementById("jenisdiklatjafung").disabled = false; 
		document.getElementById("tgldiklatjafung").disabled = false; 
		document.getElementById("tmpdiklatjafung").disabled = false;
		document.getElementById("berkasjafung").disabled = false;
		document.getElementById("tglselesaijafung").disabled = false;
		document.getElementById("nosertifikat").disabled = false;
		document.getElementById("tglsertifikat").disabled = false;
		document.getElementById("jmljam").disabled = false;
		
    }
  if (diklat=="blmdiklatjafung")
    {	
		document.getElementById("tgldiklatjafung").value = "01-01-1900";
		document.getElementById("tmpdiklatjafung").value = "-";
		document.getElementById("tmpdiklatjafung").value = "-";
		document.getElementById("jenisdiklatjafung").value = "-";
		document.getElementById("tglselesaijafung").value ="01-01-1900";
		document.getElementById("nosertifikat").value ="-";
		document.getElementById("tglsertifikat").value ="01-01-1900";
		document.getElementById("jmljam").value ="-";
		document.getElementById("jenisdiklatjafung").disabled = true; 
		document.getElementById("tgldiklatjafung").disabled = true; 
		document.getElementById("tmpdiklatjafung").disabled = true;
		document.getElementById("berkasjafung").disabled = true;
		document.getElementById("tglselesaijafung").disabled = true;
		document.getElementById("nosertifikat").disabled = true;
		document.getElementById("tglsertifikat").disabled = true;
		document.getElementById("jmljam").disabled = true;
    }
}

function cekenablejp(){
  var diklat=document.getElementById("form1").tampil20jp.value;
  if (diklat=="sdhdiklat20jp")
    {	        
		document.getElementById("jenisdiklatjp").disabled = false; 
		document.getElementById("tgldiklatjp").disabled = false; 
		document.getElementById("tmpdiklatjp").disabled = false;
		document.getElementById("berkasjp").disabled = false;
		document.getElementById("tglselesaijp").disabled = false;
		document.getElementById("nosertifikatjp").disabled = false;
		document.getElementById("tglsertifikatjp").disabled = false;
		document.getElementById("jmljamjp").disabled = false;
    }
  if (diklat=="blm20jp")
    {	
		document.getElementById("tgldiklatjp").value = "01-01-1900";
		document.getElementById("tmpdiklatjp").value = "-";
		document.getElementById("jenisdiklatjp").value = "-";
		document.getElementById("tglselesaijp").value = "01-01-1900";
		document.getElementById("nosertifikatjp").value = "";
		document.getElementById("tglsertifikatjp").value = "01-01-1900";
		document.getElementById("jmljamjp").value = "";
		document.getElementById("jenisdiklatjp").disabled = true; 
		document.getElementById("tgldiklatjp").disabled = true; 
		document.getElementById("tmpdiklatjp").disabled = true;
		document.getElementById("berkasjp").disabled = true;
		document.getElementById("tglselesaijp").disabled = true;
		document.getElementById("nosertifikatjp").disabled = true;
		document.getElementById("tglsertifikatjp").disabled = true;
		document.getElementById("jmljamjp").disabled = true;
    }
}

function cekenableseminar(){
  var diklat=document.getElementById("form1").tampilseminar.value;
  if (diklat=="sdhseminar")
    {	        
		document.getElementById("jnsseminar").disabled = false; 
		document.getElementById("tglseminar").disabled = false; 
		document.getElementById("tmpseminar").disabled = false;
		document.getElementById("berkasseminar").disabled = false;
		document.getElementById("tglselesaismnr").disabled = false; 
		document.getElementById("nosertifikatsmnr").disabled = false;
		document.getElementById("tglsertifikatsmnr").disabled = false;
		document.getElementById("jmljamsmnr").disabled = false;
    }
  if (diklat=="blmseminar")
    {	
		document.getElementById("tglseminar").value = "01-01-1900";
		document.getElementById("tmpseminar").value = "-";
		document.getElementById("jnsseminar").value = "-";
		document.getElementById("tglselesaismnr").value = "01-01-1900";
		document.getElementById("nosertifikatsmnr").value = "";
		document.getElementById("tglsertifikatsmnr").value = "01-01-1900";
		document.getElementById("jmljamsmnr").value = "";
		document.getElementById("jnsseminar").disabled = true; 
		document.getElementById("tglseminar").disabled = true; 
		document.getElementById("tmpseminar").disabled = true;
		document.getElementById("berkasseminar").disabled = true;
		document.getElementById("tglselesaismnr").disabled = true; 
		document.getElementById("nosertifikatsmnr").disabled = true;
		document.getElementById("tglsertifikatsmnr").disabled = true;
		document.getElementById("jmljamsmnr").disabled = true;
    }
}


function cekenablehukuman(){
  var diklat=document.getElementById("form1").hukuman.value;

  if (diklat!="Tidak Pernah")
    {	        
		document.getElementById("ttdsk").disabled = false; 
		document.getElementById("tglsurat").disabled = false; 
		document.getElementById("alasan").disabled = false;
		document.getElementById("berkashukuman").disabled = false;
    }
  if (diklat=="Tidak Pernah")
    {	
		document.getElementById("tglsurat").value = "01-01-1900";
		document.getElementById("alasan").value = "-";
		document.getElementById("ttdsk").value = "-";
		document.getElementById("ttdsk").disabled = true; 
		document.getElementById("tglsurat").disabled = true; 
		document.getElementById("alasan").disabled = true;
		document.getElementById("berkashukuman").disabled = true;
    }
}


function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("select");
  
	 
  //z = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "pilih") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
		
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  
  return valid; // return the valid status
}

function validateForm2() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  //z = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "" ) {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}


</script>

