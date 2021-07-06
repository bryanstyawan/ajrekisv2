<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Tutorial Belajar JavaScript</title>
<script>
function tampilkan(){
  var nama_kota=document.getElementById("form1").katezgori.value;
  if (nama_kota=="makanan")
    {
        document.getElementById("tampil").innerHTML="<option value='Nasi Goreng'>Nasi Goreng</option><option value='Bakso'>Bakso</option>";
    }
  else if (nama_kota=="minuman")
    {
        document.getElementById("tampil").innerHTML="<option value='Teh'>Teh</option><option value='Copy'>Copy</option>";
    }
}
</script>
</head>
<body>
<h2>Suckittrees.com</h2>
<form id="form1" name="form1" onsubmit="return false">
  <label>Pilih Kategori: </label>
  
  <select id="kategori" name="kategori" onchange="tampilkan()">
    <option value="makanan">makanan</option>
    <option value="minuman">minuman</option>
  </select>
  
  <select id="jabatan" name="jabatan" onchange="tampilkan()">
		  <option value="pilih">--Pilih--</option>  
		  <option value="struktural">Struktural</option>  
		  <option value="fungsional">Fungsional</option>
		  <option value="pelaksana">Pelaksana</option>
     </select>
	 
  <br/><br/>
   <label>Pilih Sub Kategori: </label> <select id="tampil" name="tampil">
  </select>
</form>

</body>
</html>