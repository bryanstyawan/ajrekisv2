


 
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
  //margin: 50px auto;
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
 $idpeg = $this->session->userdata('sesUser') ;
// $jab = '';
// $jnspim = '' ;
// $jnsjafung = '' ;
// $jp = '';
// $jnsseminar = '';
// $skp='';
// $hukuman='';
// 

// $result = mysqli_query($link, "SELECT * FROM tr_survey_ip WHERE id_pegawai=".$idpeg." and tahun=2022");
 

// while ($row=mysqli_fetch_object($result))
// {
  // $jab = $row->jns_jabatan;
  // $jnspim = $row->diklat_pim;
  // $jnsjafung = $row->diklat_jafung;
  // $jp = $row->diklat_20jp;
  // $jnsseminar = $row->seminar;
  // $pendidikan = $row->kualifikasi;
  // $skp = $row->penilaian_kinerja;
  // $hukuman = $row->hukuman_disiplin;
// }

// ?>
 
 
<body>

<div id="modal-kuisioner"  class="modal fade" data-keyboard="false" data-backdrop="static">
 <div class="modal-dialog" >
  <div class="modal-content">
   <div class="modal-header">
     <!--<button type="button" class="close" data-dismiss="modal">&times;</button> --> 
    <h2 class="modal-title" style="color:blue">PENGISIAN NILAI SKP TAHUN 2022</h2>
   </div>
   <div class="modal-body">
			<form method="post" id="form1" name="form1" enctype="multipart/form-data" action="<?php echo site_url('Dashboard/add_survey') ?>">
			  <!-- One "tab" for each step in the form: -->
			  <div class="tab"> 
				<table border="0" width="1500" >
					<tr>
						<td width="1400" colspan=2><label>Untuk mengisi data SKP Tahun 2022 ini, pastikan dokumen SKP Tahun 2022 (periode 1 dan periode 2) Anda sudah tersedia</label><br/>
						<label>dan di scan dalam bentuk pdf dengan ukuran file maksimal 1 Mb (1000 Kb)</label></td>
					</tr>
					<tr>
						<td width="50"><input type="checkbox" id="disclaimer" name="disclaimer" value="1"></td>
						<td width="900"><label for="disclaimer">Saya bertanggungjawab atas kebenaran data SKP 2022 yang akan saya isi.</label><br></td>
					</tr>
				</table> <p>
			  </div>
			  
				<div class="tab">Jenis Jabatan Anda di tahun 2022:
			   
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
									
									// if ($jab == 'CPNS'  ) {
										// # code...
										// echo "<option value='CPNS' selected>CPNS</option>" ;
									// }
									// else{
										// echo "<option value='CPNS'>CPNS</option>" ;
									// } 
						?>
				    
					  
				 </select></p>
				 </div>
				   <div class="tab"><b>Isilah nilai-nilai SKP sesuai dokumen SKP Tahun 2022 yang anda miliki</b>: 
				   <br/><a href="<?=base_url();?>/assets_home/PETUNJUKPENGISIANSKP2022.pdf" download><u>Klik di sini untuk petunjuk pengisian</u></a>
				   <br/><br/>
				   <p>
				   <i>- untuk tanda decimal silahkan menggunakan titik (.) misal 90.50</i><br/>
				   <i>- (*) wajib diisi</i><br/>
				   
					 <?
								 $result2 = mysqli_query($link, "SELECT skp1.*, 
											skp2.id AS id2, skp2.`nilaiskp` AS nilaiskp2, skp2.`orientasipelayanan` AS orientasipelayanan2, skp2.`inisiatifkerja` AS inisiatifkerja2, skp2.`komitmen` AS komitmen2, skp2.`kerjasama` AS kerjasama2, skp2.`kepemimpinan` AS kepemimpinan2, skp2.`file_skp2` , skp2.`nilaiprilakukerja` AS nilaiprilakukerja2, skp2.`nilaiprestasikerja` AS nilaiprestasikerja2, skp2.nilaitotal,
											skp2.nip_penilai, skp2.nama_penilai, skp2.gol_penilai, skp2.jab_penilai,
											skp2.nip_atasanpenilai, skp2.nama_atasanpenilai, skp2.gol_atasanpenilai, skp2.jab_atasanpenilai
										FROM `tr_survey_kinerja_2022_1` skp1
										LEFT JOIN tr_survey_kinerja_2022_2 skp2 ON skp1.id_pegawai = skp2.id_pegawai
										WHERE skp1.id_pegawai = ".$idpeg." AND skp1.tahun=2023");
										
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
										echo	"	<td colspan=2> <b>Periode I (Jan - Juni 2022)";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td colspan=3> <b>Periode II (Juli - Desember 2022)";
										echo	"	</td>";
										echo	 "</tr>";
										//--------------------------------------------------------------------------------------------------------------
										echo	 "<tr>";
										echo			"<td width=400>Nilai SKP *</td>";
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
										echo	"	<td>Nilai Kinerja Th 2022</td>";
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
										echo	"	<td colspan=2> <b>Periode I (Jan - Juni 2022)";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td colspan=3> <b>Periode II (Juli - Desember 2022)";
										echo	"	</td>";
										echo	 "</tr>";
										//--------------------------------------------------------------------------------------------------------------
										echo	 "<tr>";
										echo			"<td width=400>Nilai SKP <b>*</b></td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
											echo	"		<input type='hidden' id='idskp1' name='idskp1'>";
											echo	"		<input style='width:100px; text-align:right;' id='nilaiskp' type='text' name='nilaiskp' class='form-control' placeholder=0 onchange='hitungperilakukerja1()'>";
											echo	"		<input style='width:200px; font-weight: bold; text-align:left;' readonly=true id='nilaiskp60' type='text' name='nilaiskp60' class='form-control'  placeholder='x 60% = 0'>";
										echo	"		</div> ";	
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo			"<td width=400>Nilai SKP <b>*</b></td>";
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
										echo	"	<td>Orientasi Pelayanan <b>*</b></td>";
										echo	"	<td>";
											echo	"			<div class='input-group'>";
											echo	"			<input type='text' style='width:100px; text-align:right;' onchange='hitungperilakukerja1()' id='orientasi' name='orientasi' class='form-control' placeholder=0> ";
										echo	"			</div>";
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td>Orientasi Pelayanan <b>*</b></td>";
										echo	"	<td>";
											echo	"			<div class='input-group'>";
											echo	"			<input type='text' style='width:100px; text-align:right;' id='orientasi2' name='orientasi2' class='form-control' placeholder=0 onchange='hitungperilakukerja1()'> ";
										echo	"			</div>";
										echo	"	</td>";
										echo	" </tr>";
										//--------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>Integritas <b>*</b></td>";
										echo	"	<td>";
											echo	"			<div class='input-group'>";
											echo	"			<input type='text' style='width:100px; text-align:right;' onchange='hitungperilakukerja1()' id='integritas' name='integritas' class='form-control' placeholder=0> ";
										echo	"			</div>";
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td>Komitmen <b>*</b></td>";
										echo	"	<td>";
											echo	"			<div class='input-group'>";
											echo	"			<input type='text' style='width:100px; text-align:right;' id='komitmen2' name='komitmen2' class='form-control' placeholder=0 onchange='hitungperilakukerja1()'> ";
										echo	"			</div>";
										echo	"	</td>";
										echo	" </tr>";
										//--------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>Komitmen <b>*</b></td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text'  style='width:100px; text-align:right;' onchange='hitungperilakukerja1()' id='komitmen' name='komitmen' class='form-control' placeholder=0>";
										echo	"	</div>";
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td>Kerjasama <b>*</b></td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"		<input type='text' style='width:100px; text-align:right;' id='kerjasama2' name='kerjasama2' class='form-control' placeholder=0 onchange='hitungperilakukerja1()'>";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//--------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>Disiplin <b>*</b></td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"			<input type='text' style='width:100px; text-align:right;' onchange='hitungperilakukerja1()' id='disiplin' name='disiplin' class='form-control' placeholder=0>";
										echo	"	</div>";
										echo	"	</td>";
										echo	"	<td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>";
										echo	"	<td>Inisiatif Kerja <b>*</b></td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"			<input type='text' style='width:100px; text-align:right;' id='inisiatif' name='inisiatif' class='form-control' placeholder=0 onchange='hitungperilakukerja1()'>";
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//--------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>Kerjasama <b>*</b></td>";
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
										echo	"	<td>Nilai Kinerja Th 2022</td>";
										echo	"	<td>";
										echo	"		<div class='input-group'>";
										echo	"<input type='text' style='width:100px; font-weight: bold; text-align:right; background-color:skyblue;' readonly=true id='niltotal' name='niltotal' class='form-control' >";
										echo	"<input type='text' style='width:200px; font-weight: bold; text-align:Left;' readonly=true id='predikat' name='predikat' class='form-control' >";
										
										echo	"	</div>";
										echo	"	</td>";
										echo	"</tr>";
										//-------------------------------------------------------------------------------------------------------------
										
										echo	" <tr>";
										echo	"	<td>NIP Pejabat Penilai <b>*</b></td>";
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
										echo	"	<td>NIP Atasan Pejabat Penilai <b>*</b></td>";
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
			
			  <p><p><p><p>
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
	// if (!ValidateFile()) {
	 // alert("Lengkapi Pengisian Data !");
	// return false; }
	
    // if (currentTab==0 && document.getElementById("form1").jabatan.value=='CPNS') {
		// sessionStorage.setItem("showw", 0);
	  // alert("Status anda masih CPNS, Anda dapat melewati survey Indeks Profesionalitas");
	  // document.getElementById("form1").submit();
	  // return false;
	// }  
	  
	  
	   if (currentTab == 2){
		
			// if (!ValidSizeSKP()) {
				// return false;
			// }
			var nilskp1=document.getElementById("form1").nilaiskp.value;
			if ((nilskp1==0) || (nilskp1=='')) {
					alert("Anda belum mengisi nilai skp periode 1");
					return false;
			}
			
			var nilorientasi=document.getElementById("form1").orientasi.value;
			if ((nilorientasi==0) || (nilorientasi=='')) {
					alert("Anda belum mengisi nilai orientasi pelayanan periode 1");
					return false;
			}
			
			var nilintegritas=document.getElementById("form1").integritas.value;
			if ((nilintegritas==0) || (nilintegritas=='')) {
					alert("Anda belum mengisi nilai integritas periode 1");
					return false;
			}
			
			var nilkomitmen=document.getElementById("form1").komitmen.value;
			if ((nilkomitmen==0) || (nilkomitmen=='')) {
					alert("Anda belum mengisi nilai komitmen periode 1");
					return false;
			}
			
			var nildisiplin=document.getElementById("form1").disiplin.value;
			if ((nildisiplin==0) || (nildisiplin=='')) {
					alert("Anda belum mengisi nilai disiplin periode 1");
					return false;
			}
			
			var nilkerjasama=document.getElementById("form1").kerjasama.value;
			if ((nilkerjasama==0) || (nilkerjasama=='')) {
					alert("Anda belum mengisi nilai kerjasama periode 1");
					return false;
			}
			
			var nilskp2=document.getElementById("form1").nilaiskp2.value;
			if ((nilskp2==0) || (nilskp2=='')) {
					alert("Anda belum mengisi nilai skp periode 2");
					return false;
			}
			
			var nilorientasi2=document.getElementById("form1").orientasi2.value;
			if ((nilorientasi2==0) || (nilorientasi2=='')) {
					alert("Anda belum mengisi nilai orientasi pelayanan periode 2");
					return false;
			}
			
			var nilkomitmen2=document.getElementById("form1").komitmen2.value;
			if ((nilkomitmen2==0) || (nilkomitmen2=='')) {
					alert("Anda belum mengisi nilai komitmen periode 2");
					return false;
			}
			
			var nilkerjasama2=document.getElementById("form1").kerjasama2.value;
			if ((nilkerjasama2==0) || (nilkerjasama2=='')) {
					alert("Anda belum mengisi nilai kerjasama periode 2");
					return false;
			}
			
			var nilinisiatif=document.getElementById("form1").inisiatif.value;
			if ((nilinisiatif==0) || (nilinisiatif=='')) {
					alert("Anda belum mengisi nilai inisiatif kerja periode 2");
					return false;
			}
			
			
			var niltotal=document.getElementById("form1").niltotal.value;
			if ((niltotal==0) || (niltotal=='')) {
					alert("Anda belum mengisi SKP");
					return false;
			}
			
			
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
			
			var berkasskp=document.getElementById("form1").berkasskp.value;
			
			if (berkasskp=="") {
					alert("Anda belum mengupload skp!");
					return false;
			}
			
			if (!berkasskp=="") {
				
				if (!ValidateFile()) {
					return false;
				}
				
				const oFile =  document.getElementById("berkasskp").files[0];  

				if (oFile.size > 1000000) // 2 MiB for bytes.
				{
				  alert("File Upload Anda terlalu besar, File upload harus di bawah 1 Mb/1000 Kb!");
				  return false;
				}
			}
			
			// var _validFileExtensions = [".jpg", ".jpeg", ".pdf", ".png"];    
			
			// var arrInputs = document.getElementById("form1").berkasskp.value;;
			// for (var i = 0; i < arrInputs.length; i++) {
				// var oInput = arrInputs[i];
				// if (oInput.type == "file") {
					// var sFileName = oInput.value;
					// if (sFileName.length > 0) {
						// var blnValid = false;
						// for (var j = 0; j < _validFileExtensions.length; j++) {
							// var sCurExtension = _validFileExtensions[j];
							// if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
								// blnValid = true;
								// break;
							// }
						// }
						
						// if (!blnValid) {
							// alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
							// return false;
						// }
					// }
				// }
			// }
		 
			
	   }
	  
	  
	
  if (currentTab == 0)  {
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
	
	alert("Terima Kasih Sudah Mengisi SKP 2022");
	
    document.getElementById("form1").submit();
	
	return false;
  }
  // Otherwise, display the correct tab:

  //alert(currentTab);
	
	showTab(currentTab);
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

function ValidateFile() {
	var _validFileExtensions = [".jpg", ".jpeg", ".pdf"];  
    var arrInputs = form1.getElementsByTagName("input");
    for (var i = 0; i < arrInputs.length; i++) {
        var oInput = arrInputs[i];
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                
                if (!blnValid) {
                    alert("Maaf, File " + sFileName + " tidak dapat diupload, Jenis File upload harus : " + _validFileExtensions.join(", "));
                    return false;
                }
            }
        }
    }
  
    return true;
}

function ValidSizeSKP() {
		const oFile = document.getElementById("fileUpload").files[0]; // <input type="file" id="fileUpload" accept=".jpg,.png,.gif,.jpeg"/>

		if (oFile.size > 2097152) // 2 MiB for bytes.
		{
		  alert("File size must under 2MiB!");
		  return;
		}
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

