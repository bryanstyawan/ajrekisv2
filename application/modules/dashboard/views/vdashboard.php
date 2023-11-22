<?php
$data_bulan[] = "";
$data_value[] = "";

$this->load->view('dashboard_component/surveycuti');
echo "<script>
			$(document).ready(function()
			{
				$('#modal-infosurvey').modal('show'); 
		}) </script>";
		
if ($menit_efektif_year != 0) {
    // code...
    // for ($i=0; $i < count($menit_efektif_year); $i++) {
    //     // code...
    //     $data_bulan[$i] = $menit_efektif_year[$i]->nama_bulan;
    //     $data_value[$i] = $menit_efektif_year[$i]->menit_efektif;
    // }

    // $data_bulan = json_encode($data_bulan);
    // $data_value = json_encode($data_value);
}

$nama_pegawai  = "";
$nama_jabatan  = "";
$nama_eselon1  = "";
$nama_eselon2  = "";
$nama_eselon3  = "";
$nama_eselon4  = "";
$nama_agama    = '';
$nip           = "";
$kelas_jabatan = "";
if ($infoPegawai != 0 || $infoPegawai != '') {
    # code...
    $nama_pegawai  = $infoPegawai[0]->nama_pegawai;
    $nama_jabatan  = $infoPegawai[0]->nama_jabatan;
    $nama_eselon1  = $infoPegawai[0]->nama_eselon1;
    $nama_eselon2  = $infoPegawai[0]->nama_eselon2;
    $nama_eselon3  = $infoPegawai[0]->nama_eselon3;
    $nama_eselon4  = $infoPegawai[0]->nama_eselon4;
    $nip           = $infoPegawai[0]->nip;
    if ($infoPegawai[0]->kat_posisi == 1) {
        # code...
        $kelas_jabatan = $infoPegawai[0]->grade_raw;        
    }
    elseif ($infoPegawai[0]->kat_posisi == 2) {
        # code...
        $kelas_jabatan = $infoPegawai[0]->grade_jft;                
    }
    elseif ($infoPegawai[0]->kat_posisi == 4) {
        # code...
        $kelas_jabatan = $infoPegawai[0]->grade_jfu;        
    }
    $nama_agama    = $infoPegawai[0]->nama_agama;
}

$fingerprint = "";
?>