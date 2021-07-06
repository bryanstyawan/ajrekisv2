

 
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
	document.getElementById("jenisdiklatjafung").disabled = true; 
	document.getElementById("tgldiklatjafung").disabled = true; 
	document.getElementById("tmpdiklatjafung").disabled = true;
	document.getElementById("jenisdiklatjp").disabled = true; 
	document.getElementById("tgldiklatjp").disabled = true; 
	document.getElementById("tmpdiklatjp").disabled = true;
	document.getElementById("jnsseminar").disabled = true; 
	document.getElementById("tglseminar").disabled = true; 
	document.getElementById("tmpseminar").disabled = true;
	
  if (nama_jab=="struktural")
    {	
        document.getElementById("tampil").innerHTML="<option value='pilih'>--Pilih--</option><option value='sdhpim'>Sudah Diklat PIM</option><option value='blmpim'>Belum Diklat PIM</option>";
		document.getElementById("tampiljafung").innerHTML="<option value='pilih'>--Pilih--</option><option value='sdhdiklatjafung'>Sudah Diklat Jab. Fungsional</option><option value='blmdiklatjafung'>Belum Diklat Jab. Fungsional</option>";
		document.getElementById("tampil20jp").innerHTML="<option value='pilih'>--Pilih--</option><option value='sdhdiklat20jp'>Sudah Diklat 20 JP</option><option value='blm20jp'>Belum Diklat 20 JP</option>";
		document.getElementById("tampilseminar").innerHTML="<option value='pilih'>--Pilih--</option><option value='sdhseminar'>Sudah Ikut Seminar</option><option value='blmseminar'>Belum Ikut Seminar</option>";
		document.getElementById("nextBtn").innerHTML = "Berikutnya";
    }
  if (nama_jab=="fungsional" || nama_jab=="pelaksana")
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
	
	if (nama_jab=="CPNS")
    {
		document.getElementById("nextBtn").innerHTML = "Selesai";
	} 
}

function cekdiklatpim(){
  var diklatpim=document.getElementById("form1").tampil.value;
  if (diklatpim=="sdhpim")
    {	        
		document.getElementById("jenisdiklatpim").disabled = false; 
		document.getElementById("tgldiklatpim").disabled = false; 
		document.getElementById("tmpdiklatpim").disabled = false;
		document.getElementById("tgldiklatpim").value = "";
		document.getElementById("tmpdiklatpim").value = "";
		document.getElementById("jenisdiklatpim").value = "pilih";
    }
  if (diklatpim=="blmpim")
    {	
		document.getElementById("tgldiklatpim").value = "01-01-1900";
		document.getElementById("tmpdiklatpim").value = "-";
		document.getElementById("jenisdiklatpim").value = "-";
		document.getElementById("jenisdiklatpim").disabled = true; 
		document.getElementById("tgldiklatpim").disabled = true; 
		document.getElementById("tmpdiklatpim").disabled = true;
		
    }
}

function cekdiklatjafung(){
  var diklat=document.getElementById("form1").tampiljafung.value;
  if (diklat=="sdhdiklatjafung")
    {	        
		document.getElementById("jenisdiklatjafung").disabled = false; 
		document.getElementById("tgldiklatjafung").disabled = false; 
		document.getElementById("tmpdiklatjafung").disabled = false;
		document.getElementById("tgldiklatjafung").value = "";
		document.getElementById("tmpdiklatjafung").value = "";
		document.getElementById("jenisdiklatjafung").value = "";
    }
  if (diklat=="blmdiklatjafung")
    {	
		document.getElementById("tgldiklatjafung").value = "01-01-1900";
		document.getElementById("tmpdiklatjafung").value = "-";
		document.getElementById("tmpdiklatjafung").value = "-";
		document.getElementById("jenisdiklatjafung").value = "-";
		document.getElementById("jenisdiklatjafung").disabled = true; 
		document.getElementById("tgldiklatjafung").disabled = true; 
		document.getElementById("tmpdiklatjafung").disabled = true;
    }
}

function cekdiklatjp(){
  var diklat=document.getElementById("form1").tampil20jp.value;
  if (diklat=="sdhdiklat20jp")
    {	        
		document.getElementById("jenisdiklatjp").disabled = false; 
		document.getElementById("tgldiklatjp").disabled = false; 
		document.getElementById("tmpdiklatjp").disabled = false;
		document.getElementById("tgldiklatjp").value = "";
		document.getElementById("tmpdiklatjp").value = "";
		document.getElementById("jenisdiklatjp").value = "";
    }
  if (diklat=="blm20jp")
    {	
		document.getElementById("tgldiklatjp").value = "1900-01-01"
		document.getElementById("tmpdiklatjp").value = "-"
		document.getElementById("jenisdiklatjp").value = "-"
		document.getElementById("jenisdiklatjp").disabled = true; 
		document.getElementById("tgldiklatjp").disabled = true; 
		document.getElementById("tmpdiklatjp").disabled = true;
    }
}
function cekseminar(){
  var diklat=document.getElementById("form1").tampilseminar.value;
  if (diklat=="sdhseminar")
    {	        
		document.getElementById("jnsseminar").disabled = false; 
		document.getElementById("tglseminar").disabled = false; 
		document.getElementById("tmpseminar").disabled = false;
		document.getElementById("tglseminar").value = "";
		document.getElementById("tmpseminar").value = "";
		document.getElementById("jnsseminar").value = "";
    }
  if (diklat=="blmseminar")
    {	
		document.getElementById("tglseminar").value = "01-01-1900"
		document.getElementById("tmpseminar").value = "-"
		document.getElementById("jnsseminar").value = "-"
		document.getElementById("jnsseminar").disabled = true; 
		document.getElementById("tglseminar").disabled = true; 
		document.getElementById("tmpseminar").disabled = true;
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
    }
  if (diklat=="Tidak Pernah")
    {	
		document.getElementById("tglsurat").value = "01-01-1900"
		document.getElementById("alasan").value = "-"
		document.getElementById("ttdsk").value = "-"
		document.getElementById("ttdsk").disabled = true; 
		document.getElementById("tglsurat").disabled = true; 
		document.getElementById("alasan").disabled = true;
    }
}

	function addRow(tableID) {

		var table = document.getElementById(tableID);

		var rowCount = table.rows.length;
		var row = table.insertRow(rowCount);

		var colCount = table.rows[0].cells.length;

		for(var i=0; i<colCount; i++) {

			var newcell	= row.insertCell(i);

			newcell.innerHTML = table.rows[0].cells[i].innerHTML;
			//alert(newcell.childNodes);
			switch(newcell.childNodes[0].type) {
				case "text":
						newcell.childNodes[0].value = "";
						break;
				case "checkbox":
						newcell.childNodes[0].checked = false;
						break;
				case "select-one":
						newcell.childNodes[0].selectedIndex = 0;
						break;
				case "date":
						newcell.childNodes[0].value = "01-01-1900";
						break;
			}
		}
	}

	function deleteRow(tableID) {
		try {
			
		var table = document.getElementById(tableID);
		var rowCount = table.rows.length;
	    
		for(var i=0; i<rowCount; i++) {
			var row = table.rows[i];
			var chkbox = row.cells[0].childNodes[0];
	
			if(null != chkbox && true == chkbox.checked) {
				
				if(rowCount <= 1) {
					alert("Cannot delete all the rows.");
					break;
				}
				table.deleteRow(i);
				rowCount--;
				i--;
			}


		}
		}catch(e) {
			alert(e);
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

<body>

<div id="modal-kuisioner" class="modal fade" data-keyboard="false" data-backdrop="static">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <!--<button type="button" class="close" data-dismiss="modal">&times;</button> -->
    <h2 class="modal-title">SURVEY INDEKS PROFESIONALITAS PNS KEMENDAGRI TAHUN 2020</h2>
   </div>
   <div class="modal-body">
			<form method="post" id="form1" name="form1" action="<?php echo site_url('Dashboard/add_survey') ?>">
			  <!-- One "tab" for each step in the form: -->
			  <div class="tab">Jenis Jabatan Anda pada tahun 2020 (sebelum penyetaraan jabatan):
				 <p><select id="jabatan" name="jabatan" onchange="tampilkan()" class="form-control">
					  <option value="pilih">--Pilih--</option>  
					  <option value="struktural">Struktural</option>  
					  <option value="fungsional">Fungsional</option>
					  <option value="pelaksana">Pelaksana</option>
					  <option value="CPNS">CPNS</option>
				 </select></p>
			  </div>
			  <div class="tab">Jika anda menduduki jabatan struktural di tahun 2020, apakah anda sudah mengikuti diklatpim dalam jabatan eselon tersebut?<p>
			  <i>(contoh: <b>jawab Sudah Diklatpim</b> jika di tahun 2020 menduduki jabatan eselon III dan sudah diklatpim III; <b>jawab Belum Diklatpim</b> jika di tahun 2020 menduduki jabatan eselon III dan belum diklatpim III)</i>
				<p><select id="tampil" name="tampil" onchange="cekdiklatpim()" class="form-control"> 
					 <option value="pilih">--Diklat PIM--</option> 
				</select></p>
					
					 <label for="add"><a onclick="addRow('dataTable1')">Tambah Diklat</a></label> &nbsp &nbsp &nbsp
					 <label for="del"><a onclick="deleteRow('dataTable1')">Hapus Diklat</a></label>
					 

					<TABLE id="dataTable1" width="800" border="1">
						<tr>
							<td width="25"><input type="checkbox" name="chk"/></td>
							<td title="Nama Diklat" width="300"><select id="jenisdiklatpim" name="jenisdiklatpim[]" class="form-control" placeholder="Jenis Diklat" disabled>
							  <option value="pilih">--Pilih--</option>  
							  <option value="pim1">PIM 1</option>  
							  <option value="pim2">PIM 2</option>
							  <option value="pim3">PIM 3</option>
							  <option value="pim4">PIM 4</option>
							  <option value="lemhanas">Lemhanas</opton>
							</select></td>
							<td  title="Tanggal Diklat" width="100"><input type="date" id="tgldiklatpim" name="tgldiklatpim[]" class="form-control" placeholder="Tanggal Diklat"></td>
							<td  title="Penyelenggara Diklat" width="400"><input type="text" id="tmpdiklatpim" name="tmpdiklatpim[]" class="form-control" placeholder="Penyelenggara Diklat"></td>
						</tr>
					</TABLE> <p>
			  </div>
			  <div class="tab">Anda Pernah Diklat Jabatan Fungsional ?
				<p><select id="tampiljafung" name="tampiljafung" onchange="cekdiklatjafung()" class="form-control"> 
				 <option value="pilih">--Diklat Jafung--</option> 
				 </select></p>
									
					 <label for="add"><a onclick="addRow('dataTable')">Tambah Diklat</a></label> &nbsp &nbsp &nbsp
					 <label for="del"><a onclick="deleteRow('dataTable')">Hapus Diklat</a></label>
						<TABLE id="dataTable" width="800" border="1">
							<TR>
								<TD width="25"><INPUT type="checkbox" name="chk"/></TD>
								<TD width="300" title="Nama Diklat"><input id="jenisdiklatjafung" maxlength="300" size="300" type="text" name="jenisdiklatjafung[]" class="form-control" placeholder="Nama Diklat"</TD>
								<td  width="100" title="Tanggal Diklat"><input type="date" maxlength="100" size="100" id="tgldiklatjafung" name="tgldiklatjafung[]" class="form-control" placeholder="Tanggal Diklat"</td>
								<TD  width="400" title="Penyelenggara Diklat"><input type="text" maxlength="400" size="400" id="tmpdiklatjafung" name="tmpdiklatjafung[]" class="form-control" placeholder="Penyelenggara Diklat"</TD>
							</TR>
						</TABLE> <p>
			  </div>
			  <div class="tab">Dalam 1 tahun terakhir (2020), apakah anda pernah mengikuti Diklat 20 Jam Pelajaran (akumulasi JP minimal 20 JP) ?
					 <p><select id="tampil20jp" name="tampil20jp" onchange="cekdiklatjp()" class="form-control">
					 <option value="pilih">--Diklat 20 JP--</option>
					 </select></p>

					 <label for="add"><a onclick="addRow('dataTable3')">Tambah Diklat</a></label> &nbsp &nbsp &nbsp
					 <label for="del"><a onclick="deleteRow('dataTable3')">Hapus Diklat</a></label>
						<TABLE id="dataTable3" width="800" border="1">
							<TR>
								<TD width="25"><INPUT type="checkbox" name="chk"/></TD>
								<TD width="300" title="Nama Diklat"><input id="jenisdiklatjp" maxlength="300" size="300" type="text" name="jenisdiklatjp[]" class="form-control" placeholder="Nama Diklat"</TD>
								<td  width="100" title="Tanggal Diklat"><input type="date" maxlength="100" size="100" id="tgldiklatjp" name="tgldiklatjp[]" class="form-control" placeholder="Tanggal Diklat"</td>
								<TD  width="400" title="Penyelenggara Diklat"><input type="text" maxlength="400" size="400" id="tmpdiklatjp" name="tmpdiklatjp[]" class="form-control" placeholder="Penyelenggara Diklat"</TD>
							</TR>
						</TABLE> <p>
					 
					 
			  </div>
			  <div class="tab">Dalam 2 tahun terakhir (2019 sd 2020), apakah anda pernah mengikuti Seminar/Workshop/Magang/Kursus/sejenisnya ?
				   <p><select id="tampilseminar" name="tampilseminar" onchange="cekseminar()" class="form-control">
					 <option value="pilih">--Seminar--</option>
					 </select></p>
					<label for="add"><a onclick="addRow('dataTable4')">Tambah Seminar</a></label> &nbsp &nbsp &nbsp
					 <label for="del"><a onclick="deleteRow('dataTable4')">Hapus Seminar</a></label>
					<TABLE id="dataTable4" width="800" border="1">
						<TR>
							<TD width="25"><INPUT type="checkbox" name="chk"/></TD>
							<TD width="300" title="Nama Seminar"><input id="jnsseminar" maxlength="300" size="300" type="text" name="jnsseminar[]" class="form-control" placeholder="Nama Seminar"</TD>
							<td  width="100" title="Taggal Seminar"><input type="date" maxlength="100" size="100" id="tglseminar" name="tglseminar[]" class="form-control" placeholder="Tanggal Seminar"</td>
							<TD  width="400" title="Tanggal Seminar"><input type="text" maxlength="400" size="400" id="tmpseminar" name="tmpseminar[]" class="form-control" placeholder="Penyelenggara Seminar"</TD>
						</TR>
					</TABLE> <p>
					
			  </div>
			  <div class="tab"> Pendidikan Terakhir Anda:
				<select name="pendidikan" id="pendidikan" class="form-control">
					 <option value="pilih">--Pilih--</option>  
					  <option value="S3">S3</option>  
					  <option value="S2">S2</option>  
					  <option value="S1D4">S1/D4</option>  
					  <option value="D3">D3</option> 
					  <option value="D2D1SMASMK">D2/D1/SMA/SMK</option>  
					  <option value="SMPSD">SMP/SD</option>  
					 </select><p>
			  </div>
			  
			  <div class="tab"> Hasil Penilaian Kinerja Anda di Tahun 2020:
				<select name="kinerja" id="kinerja" class="form-control">
				 <option value="pilih">--Pilih--</option>  
				  <option value="Sangat Baik">Sangat Baik (91-100)</option>  
				  <option value="Baik">Baik (76-90)</option>  
				  <option value="Cukup">Cukup (61-75)</option>  
				  <option value="Kurang">Kurang (51-60)</option>  
				  <option value="Buruk">Buruk (<50)</option>  
				 </select><p>
			  </div>
			  <div class="tab">Anda Pernah Dijatuhi Hukuman Disiplin :
				<select name="hukuman" id="hukuman" onchange="cekhukuman()" class="form-control">
				 <option value="pilih">--Pilih--</option>  
				  <option value="Berat">Berat</option>  
				  <option value="Sedang">Sedang</option>  
				  <option value="Ringan">Ringan</option>  
				  <option value="Tidak Pernah">Tidak Pernah</option>  
				 </select><p>
				 <table border="0" width="800">
						 <tr>
							<td width="100">Penandatangan SK</td>
							<td width="700">
								<div class="input-group">
									<input id="ttdsk" maxlength="200" size="200" type="text" name="ttdsk" class="form-control" disabled>
								</div>								
							</td>
							
						 </tr>
						 <tr>
							<td>Tanggal Surat</td>
							<td>
									<div class="input-group">
											<input type="text" maxlength="100" size="100" id="tglsurat" name="tglsurat" class="form-control timerange" disabled>
										</div>
							</td>
						 </tr>
						 <tr>
							<td>Alasan Sanksi</td>
							<td>
								<div class="input-group">
									<input type="text" maxlength="400" size="400" id="alasan" name="alasan" class="form-control" disabled>
								</div>
							<td>
						 </tr>
				</table><p>
			  </div>
			  <div class="tab"> 
				<table border="0" width="400" >
					<tr>
						<td width="50"><input type="checkbox" id="disclaimer" name="disclaimer" value="1"></td>
						<td width="350"><label for="disclaimer">Saya bertanggungjawab atas kebenaran data yang telah saya isi di dalam survey ini.</label><br></td>
					</tr>
				</table> <p>
			  </div><p><p><p><p>
			  <div style="overflow:auto;">
				<div style="float:right;">
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
  
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) {
	  alert("Lengkapi Pengisian Data !");
	return false; }
  /* if (n == 1 && !validateForm2()) {
	  alert("Lengkapi Pengisian Data !");
	return false; } */

    if (currentTab==0 && document.getElementById("form1").jabatan.value=='CPNS') {
	  alert("Status anda masih CPNS, Anda dapat melewati survey Indeks Profesionalitas");
	  document.getElementById("form1").submit();
	  return false;
	}  
  
  if (currentTab == 8) {
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
	
	alert("Terima Kasih Sudah Mengisi Survey Indeks Profesionalitas");
    document.getElementById("form1").submit();
	
	return false;
  }
  // Otherwise, display the correct tab:
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

