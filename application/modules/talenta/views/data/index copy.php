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
    $atasan1     = $atasan; 
    $atasan2     = $atasan_plt;
    $evaluator1  = $evaluator;
    $atasan_nama = "";

    $nama_pegawai  = "";
    $nama_jabatan  = "";
    $nama_eselon1  = "";
    $nama_eselon2  = "";
    $nama_eselon3  = "";
    $nama_eselon4  = "";
    $nip           = "";
    $kelas_jabatan = "";
    $pangkat       = "";
    $ruang         = "";
    $tmt_pangkat  = "";
    $kat_posisi    = "";
    $nama_posisi_cetak  = "";
    
    if ($infoPegawai != 0 || $infoPegawai != '') {

        # code...
    
        $nama_pegawai  = $infoPegawai[0]->nama_pegawai;
        $nama_jabatan  = $infoPegawai[0]->nama_jabatan;
        $nama_eselon1  = $infoPegawai[0]->nama_eselon1;
        $nama_eselon2  = $infoPegawai[0]->nama_eselon2;
        $nama_eselon3  = $infoPegawai[0]->nama_eselon3;
        $nama_eselon4  = $infoPegawai[0]->nama_eselon4;
        $nip           = $infoPegawai[0]->nip;
        $kelas_jabatan = $infoPegawai[0]->kelas_jabatan;
        $pangkat       = $infoPegawai[0]->nama_pangkat;
        $kat_posisi    = $infoPegawai[0]->kat_posisi;
    
        if ($kat_posisi == 1) {
            # code...
            // $nama_jabatan = 
        } 
        elseif($kat_posisi == 2) {
            # code...
        }
        elseif($kat_posisi == 4) {
            # code...
        }
        elseif($kat_posisi == 6) {
            # code...
        }
        
        // $pangkat     = ($infoPegawai[0]->nama_pangkat != '-') ? $infoPegawai[0]->nama_pangkat : '' ;
        // $ruang       = ($infoPegawai[0]->nama_golongan != '-') ? ', ('.$infoPegawai[0]->nama_golongan.') ' : '' ;
        // $tmt_pangkat = ($infoPegawai[0]->tmt_pangkat != '-') ? $infoPegawai[0]->tmt_pangkat : '' ;    
    }    
?>
<style>
  .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    background-color: #05ad9d!important;
    color: #fff!important;
  }  
</style>
<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">PENGUMUMAN</h2>
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button> -->
        </div>
        <div class="modal-body">
            <h2>BACALAH PETUNJUK PENGISIAN SURVEI INI DENGAN SEKSAMA</h2>
            <p>
Dalam rangka pemetaan persepsi dan validasi data kepegawaian, Biro Kepegawaian mengadakan Survei untuk seluruh PNS Kemendagri. 
Isilah kuesioner dalam keadaan tidak terburu-buru, bercanda atau hal-hal lain yang memungkinkan  hasil kuesioner anda tidak sesuai dengan keadaan sebenarnya. Luangkan waktu yang cukup (minimal 30 menit) yang diperlukan untuk mengisi kuesioner ini.
<br>
Siapkan file scan dibawah ini jika ada :
<br>
<br><b>1. Sertifikat Diklat Kepemimpinan</b>
<br><b>2. Sertifikat Jabfung/Hasil Ujikom</b>
<br><b>3. Sertifikat Diklat Teknis</b>
<br><b>4. SK/Surat Tugas sebagai Ketua Tim</b>
<br><b>5. SK/Surat Tugas Keterlibatan dalam Tim</b>
<br><b>5. Surat Tugas/SK sebagai Pelaksana Tugas.</b>
<br><b>7. Surat Tugas/SK sebagai Pelaksana Harian</b>
<br>
<br>
<b><i>Jika terdapat lebih dari satu file pada masing-masing poin, harap untuk disatukan dalam winrar atau zip.
Seluruh informasi data yang diberikan akan dirahasiakan dan hanya digunakan untuk kepentingan Biro Kepegawaian, dan tidak akan berdampak apapun terhadap kebijakan Kepegawaian Anda. Terima kasih.. </i></b></p>
        </div>        
    </div>
  </div>
</div>
<?php
$counter_jawaban = 0;
$counter_soal = 0;
?>
<div class="col-xs-12">
    <div class="box">
        <div class="box-body" >
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <!-- <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li> -->
                <?php
                    // echo $track;                                    
                foreach ($indikator as $key => $value) {
                    # code...
                    $class = "disabled";
                    $paramDisabled = 'true';
                    // $style = 

                    if ($track == 1) {
                        # code...
                        if ($value->sort == 1) {                    
                            $class = "active";
                            $paramDisabled = 'false';                        
                        }
                    }
                    else
                    {

                        if ($value->sort <= $track) {
                            if ($value->sort == $track) {
                                # code...
                                $class1 = "active";
                                $paramDisabled = 'false';                                                        
                            }
                            // $paramDisabled = "display:'';";
                        }
                        else{
                            $class1 = "disabled";        
                            $paramDisabled = 'true';                                    
                            // $paramDisabled = "display:none;";
                        }
                    }

                    if ($value->id_indikator != 1) {
                ?>
                    <li role="presentation" aria-disabled="<?=$paramDisabled;?>" class="<?=$class;?>"><a class="tab-header" href="#id_indikator_<?=$value->id_indikator;?>" aria-controls="<?=$value->nama_indikator;?>" role="tab" data-toggle="tab"><?=$value->nama_indikator;?></a></li>                    
                <?php                        
                    }
                }
                ?>
                <!-- <li role="presentation"><a href="#penilaian_kinerja" aria-controls="penilaian_kinerja" role="tab" data-toggle="tab">Penilaian Kinerja 360</a></li>
                <li role="presentation"><a href="#pegawai_terbaik" aria-controls="pegawai_terbaik" role="tab" data-toggle="tab">Pegawai Terbaik</a></li>                                 -->
            </ul>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

    <!-- Tab panes -->
    <div class="tab-content">
        <?php
        foreach ($indikator as $key => $value) {
            # code...
            $class1 = "";
            $paramDisabled = "display:none;";
            if ($track == 1) {
                # code...
                if ($value->sort == 1) {
                    $class1 = "active";
                    $paramDisabled = "display:'';";
                }
                else{
                    $class1 = "disabled";                
                    $paramDisabled = "display:none;";
                }                
            }
            else
            {
                if ($value->sort <= $track) {
                    if ($value->sort == $track) {
                        # code...
                        $class1 = "active";                        
                    }
                    $paramDisabled = "display:'';";
                }
                else{
                    $class1 = "disabled";                
                    $paramDisabled = "display:none;";
                }
            }


            ?>
            <div role="tabpanel" style="<?=$paramDisabled;?>" class="tab-pane <?=$class1;?>" id="id_indikator_<?=$value->id_indikator;?>">
            <?php

            if ($value->id_indikator == 4) {
                # code...
            }            
            else
            {
                ?>
                <h2><?=$value->nama_indikator;?></h2>
                <?php                
            }                


            foreach ($value->question as $key1 => $value1) {
                # code...
                if ($class1 == 'active') {
                    # code...
                    if ($value1->jawaban != null) {
                        # code...
                        $counter_jawaban++;
                    }                    
                    $counter_soal++;
                }

                if ($value->id_indikator == 4) {
                    # code...
                    if ($value1->id_pertanyaan == 192) {
                        # code...
                        ?>
                        <h2><?=$value1->nama_sub_indikator;?></h2>                        
                        <?php                                
                    }
                    elseif ($value1->id_pertanyaan == 228) {
                        # code...
                        ?>
                        <h2 style="padding-top:20px;"><?=$value1->nama_sub_indikator;?></h2>                        
                        <?php                                
                    }
                }                
            ?>  
            

                <div class="box">
                    <div class="box-body" >
                        <!-- <h4><?=$key1+1;?>. <?=$value1->pertanyaan;?></h4> -->
                        <?php
                        $key4 = 0;
                        if ($value->id_indikator == 4) {
                            # code...
                            if ($value1->id_pertanyaan == 192) {
                                # code...
                                ?>
                                <h4>1. <?=$value1->pertanyaan;?></h4>                        
                                <?php                                
                            }
                            elseif ($value1->id_pertanyaan == 227) {
                                # code...
                                ?>
                                <h4>2. <?=$value1->pertanyaan;?></h4>                        
                                <?php                                
                            }
                            elseif ($value1->id_pertanyaan == 228) {
                                # code...
                                ?>
                                <h4>1. <?=$value1->pertanyaan;?></h4>                        
                                <?php                                
                            }
                            elseif ($value1->id_pertanyaan == 229) {
                                # code...
                                ?>
                                <h4>2. <?=$value1->pertanyaan;?></h4>                        
                                <?php                                
                            }                                                                                    
                        }
                        else
                        {
                        ?>
                        <h4><?=$key1+1;?>. <?=$value1->pertanyaan;?></h4>                        
                        <?php
                        }
                        ?>
                        <div class="col-lg-12">
                            <?php
                                    if ($value1->id_parameter == 1) {
                                        # code...
                                        // echo $value1->jawaban;
                                        if($value1->jawaban == null)
                                        {
                            ?>
                                            <div id="btn-section_<?=$value1->id_pertanyaan;?>" >
                                                <button class="btn btn-success" onclick="yesOrNo('<?=$value1->id_pertanyaan;?>',1)">Ya</button>
                                                <button class="btn btn-danger" onclick="yesOrNo('<?=$value1->id_pertanyaan;?>',0)">Tidak</button>
                                            </div>
                                            <div id="file-section_<?=$value1->id_pertanyaan;?>" style="display:none">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    <input type="file" id="file_pendukung_<?=$value1->id_pertanyaan;?>" name="file_pendukung_<?=$value1->id_pertanyaan;?>" class="form-control">                                            
                                                </div>
                                                <button class="btn btn-danger" onclick="upload('<?=$value1->id_pertanyaan;?>',0)">Upload</button>
                                            </div>                            
                                            <div id="response-section_<?=$value1->id_pertanyaan;?>"></div>
                            <?php
                                        }
                                    }
                                    elseif ($value1->id_parameter == 2) 
                                    {
                                        # code...
                            ?>
                                            <div class="col-lg-2">
                                                <input class="form-check-input" type="radio" name="exampleRadios_<?=$value1->id_pertanyaan;?>" id="exampleRadios_<?=$value1->id_pertanyaan;?>" value="1" onclick="selectRadio('<?=$value1->id_pertanyaan;?>')" <?=($value1->jawaban == 1)? 'checked' : '';?>>
                                                <label class="form-check-label" for="exampleRadios_<?=$value1->id_pertanyaan;?>">
                                                Tidak setuju
                                                </label>
                                            </div>
                                            <div class="col-lg-2">
                                                <input class="form-check-input" type="radio" name="exampleRadios_<?=$value1->id_pertanyaan;?>" id="exampleRadios_<?=$value1->id_pertanyaan;?>" value="2" onclick="selectRadio('<?=$value1->id_pertanyaan;?>')" <?=($value1->jawaban == 2)? 'checked' : '';?>>
                                                <label class="form-check-label" for="exampleRadios_<?=$value1->id_pertanyaan;?>">
                                                Kurang setuju
                                                </label>
                                            </div>
                                            <div class="col-lg-2">
                                                <input class="form-check-input" type="radio" name="exampleRadios_<?=$value1->id_pertanyaan;?>" id="exampleRadios_<?=$value1->id_pertanyaan;?>" value="3" onclick="selectRadio('<?=$value1->id_pertanyaan;?>')" <?=($value1->jawaban == 3)? 'checked' : '';?>>
                                                <label class="form-check-label" for="exampleRadios_<?=$value1->id_pertanyaan;?>">
                                                Setuju
                                                </label>
                                            </div>
                                            <div class="col-lg-2">
                                                <input class="form-check-input" type="radio" name="exampleRadios_<?=$value1->id_pertanyaan;?>" id="exampleRadios_<?=$value1->id_pertanyaan;?>" value="4" onclick="selectRadio('<?=$value1->id_pertanyaan;?>')" <?=($value1->jawaban == 4)? 'checked' : '';?>>
                                                <label class="form-check-label" for="exampleRadios_<?=$value1->id_pertanyaan;?>">
                                                Sangat setuju
                                                </label>
                                            </div>                                                                                                                                    
                            <?php
                                    }
                                    elseif ($value1->id_parameter == 3) {
                                        # code...
                            ?>
                                        <label>Skala 1 - 10</label>
                                        <?php
                                        for ($i=1; $i <= 10; $i++) { 
                                            # code...
                            ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="<?=$i;?>" checked>
                                            <label class="form-check-label" for="exampleRadios1">
                                            Skala <?=$i;?>
                                            </label>
                                        </div>                                
                            <?php
                                        }
                                        ?>
                                        <div id="response-section_<?=$value1->id_pertanyaan;?>"></div>                                        
                            <?php                                        
                                    }
                                    elseif ($value1->id_parameter == 5) 
                                    {
                                        # code...
                                        if($value1->jawaban == null )
                                        {
                            ?>
                                            <div id="btn-section_<?=$value1->id_pertanyaan;?>">
                                                <button class="btn btn-success" onclick="yesOrNo1('<?=$value1->id_pertanyaan;?>',1)">Ya</button>
                                                <button class="btn btn-danger" onclick="yesOrNo1('<?=$value1->id_pertanyaan;?>',0)">Tidak</button>
                                            </div>                                            
                                            <div id="number-section_<?=$value1->id_pertanyaan;?>" style="display:none">
                                                <h4 class="text-left col-lg-12"> Jawaban anda adalah : Ya, Pernah</h4>
                                                <div class="col-lg-2">
                                                    <label>Berapa kali ?</label>                                            
                                                    <div class="input-group"style="padding-bottom:10px">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                        <input type="number" id="number_<?=$value1->id_pertanyaan;?>" class="form-control">                                            
                                                    </div>                                                    
                                                </div>
                                                <div class="col-lg-10">
                                                    <label>Lampiran</label>                          
                                                    <div class="input-group"style="padding-bottom:10px">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                        <input type="file" id="file_pendukung_<?=$value1->id_pertanyaan;?>" name="file_pendukung_<?=$value1->id_pertanyaan;?>" class="form-control">                                            
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label class="pull-right" style="color: #000;font-weight: 800;font-size: 14px;">*Maksimal 2MB (pdf|rar|zip)</label>
                                                    </div>                                                                                                                                                        
                                                </div>                                                
                                                <button class="btn btn-danger" onclick="upload('<?=$value1->id_pertanyaan;?>',1)">Upload</button>                                                
                                            </div>
                                            <div id="response-section_<?=$value1->id_pertanyaan;?>"></div>                                            
                            <?php
                                        }
                                        else 
                                        {
                                            echo "Anda telah menjawab pertanyaan ini.";                                            
                                            // echo $value1->jawaban;
                                            if ($value1->jumlah == null) {
                                                # code...
                            ?>
                                            <!-- <div id="btn-section_<?=$value1->id_pertanyaan;?>" class="text-center">
                                                <h4 class="text-left">Jawaban anda adalah : Tidak</h4>
                                                <br>                                         
                                                <button class="btn btn-success" onclick="yesOrNo1('<?=$value1->id_pertanyaan;?>',1)">Ya</button>
                                                <button class="btn btn-danger" onclick="yesOrNo1('<?=$value1->id_pertanyaan;?>',0)">Tidak</button>
                                            </div>                             -->
                            <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <!-- <div id="number-section_<?=$value1->id_pertanyaan;?>">
                                                    <h4 class="text-left col-lg-12"> Jawaban anda adalah : Ya, Pernah</h4>
                                                    <label>Berapa kali ?</label>                                            
                                                    <div class="input-group"style="padding-bottom:10px">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                        <input type="number" id="number_<?=$value1->id_pertanyaan;?>" class="form-control" value="<?=$value1->jumlah;?>">                                            
                                                    </div>
    
                                                    <label>Lampiran</label>                                                
                                                    <div class="input-group"style="padding-bottom:10px">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                        <input type="file" id="file_pendukung_<?=$value1->id_pertanyaan;?>" name="file_pendukung_<?=$value1->id_pertanyaan;?>" class="form-control">                                            
                                                    </div>                                                
                                                    <button class="btn btn-danger" onclick="upload('<?=$value1->id_pertanyaan;?>',1)">Upload</button>
                                                </div>                             -->
                                <?php
                                            }

                                        }
                                    }
                                    elseif ($value1->id_parameter == 6) 
                                    {
                                        if($value1->jawaban == null)
                                        {
                            ?>
                                            <div id="btn-section_<?=$value1->id_pertanyaan;?>" >
                                                <button class="btn btn-success" onclick="yesOrNo('<?=$value1->id_pertanyaan;?>',1)">Ya</button>
                                                <button class="btn btn-danger" onclick="yesOrNo('<?=$value1->id_pertanyaan;?>',0)">Tidak</button>
                                            </div>
                                            <div id="file-section_<?=$value1->id_pertanyaan;?>" style="display:none">
                                                <div class="col-lg-2">
                                                    <input class="form-check-input checkboxData_<?=$value1->id_pertanyaan;?>" type="checkbox" name="checkboxData_<?=$value1->id_pertanyaan;?>" id="Diklat PIM 1" value="Diklat PIM 1">
                                                    <label class="form-check-label" for="checkboxData_<?=$value1->id_pertanyaan;?>">
                                                    Diklat PIM 1
                                                    </label>
                                                </div>
                                                <div class="col-lg-2">
                                                    <input class="form-check-input checkboxData_<?=$value1->id_pertanyaan;?>" type="checkbox" name="checkboxData_<?=$value1->id_pertanyaan;?>" id="Diklat PIM 2" value="Diklat PIM 2">
                                                    <label class="form-check-label" for="checkboxData_<?=$value1->id_pertanyaan;?>">
                                                    Diklat PIM 2
                                                    </label>
                                                </div>
                                                <div class="col-lg-2">
                                                    <input class="form-check-input checkboxData_<?=$value1->id_pertanyaan;?>" type="checkbox" name="checkboxData_<?=$value1->id_pertanyaan;?>" id="Diklat PIM 3" value="Diklat PIM 3">
                                                    <label class="form-check-label" for="checkboxData_<?=$value1->id_pertanyaan;?>">
                                                    Diklat PIM 3
                                                    </label>
                                                </div>
                                                <div class="col-lg-2">
                                                    <input class="form-check-input checkboxData_<?=$value1->id_pertanyaan;?>" type="checkbox" name="checkboxData_<?=$value1->id_pertanyaan;?>" id="Diklat PIM 4" value="Diklat PIM 4">
                                                    <label class="form-check-label" for="checkboxData_<?=$value1->id_pertanyaan;?>">
                                                    Diklat PIM 4
                                                    </label>
                                                </div>
                                                <div class="col-lg-10" style="margin-bottom:10px">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                        <input type="file" id="file_pendukung_<?=$value1->id_pertanyaan;?>" name="file_pendukung_<?=$value1->id_pertanyaan;?>" class="form-control">                                            
                                                    </div>
                                                </div>        
                                                <div class="col-lg-10" style="margin-bottom:10px">
                                                    <button class="btn btn-danger" onclick="uploadWithCheckbox('<?=$value1->id_pertanyaan;?>',1)">Upload</button>                                                
                                                </div>
                                            </div>
                                            <div id="response-section_<?=$value1->id_pertanyaan;?>"></div>                                            
                            <?php
                                        }
                                        else
                                        {
                                            echo "Anda telah menjawab pertanyaan ini.";
                                        }
                                    }
                                    elseif ($value1->id_parameter == 7) 
                                    {
                                        if($value1->jawaban == null)
                                        {
                            ?>
                                            <div id="btn-section_<?=$value1->id_pertanyaan;?>" >
                                                <button class="btn btn-success" onclick="yesOrNo('<?=$value1->id_pertanyaan;?>',1)">Ya</button>
                                                <button class="btn btn-danger" onclick="yesOrNo('<?=$value1->id_pertanyaan;?>',0)">Tidak</button>
                                            </div>
                                            <div id="file-section_<?=$value1->id_pertanyaan;?>" style="display:none">
                                                <div class="col-lg-2">
                                                    <input class="form-check-input checkboxData_<?=$value1->id_pertanyaan;?>" type="checkbox" name="checkboxData_<?=$value1->id_pertanyaan;?>" id="Jenjang Ahli Pertama" value="Jenjang Ahli Pertama">
                                                    <label class="form-check-label" for="checkboxData_<?=$value1->id_pertanyaan;?>">
                                                    Jenjang Ahli Pertama
                                                    </label>
                                                </div>
                                                <div class="col-lg-2">
                                                    <input class="form-check-input checkboxData_<?=$value1->id_pertanyaan;?>" type="checkbox" name="checkboxData_<?=$value1->id_pertanyaan;?>" id="Jenjang Ahli Muda" value="Jenjang Ahli Muda">
                                                    <label class="form-check-label" for="checkboxData_<?=$value1->id_pertanyaan;?>">
                                                    Jenjang Ahli Muda
                                                    </label>
                                                </div>
                                                <div class="col-lg-2">
                                                    <input class="form-check-input checkboxData_<?=$value1->id_pertanyaan;?>" type="checkbox" name="checkboxData_<?=$value1->id_pertanyaan;?>" id="Jenjang Ahli Madya" value="Jenjang Ahli Madya">
                                                    <label class="form-check-label" for="checkboxData_<?=$value1->id_pertanyaan;?>">
                                                    Jenjang Ahli Madya
                                                    </label>
                                                </div>
                                                <div class="col-lg-2">
                                                    <input class="form-check-input checkboxData_<?=$value1->id_pertanyaan;?>" type="checkbox" name="checkboxData_<?=$value1->id_pertanyaan;?>" id="Jenjang Ahli Utama" value="Jenjang Ahli Utama">
                                                    <label class="form-check-label" for="checkboxData_<?=$value1->id_pertanyaan;?>">
                                                    Jenjang Ahli Utama
                                                    </label>
                                                </div>
                                                <div class="col-lg-2">
                                                    <input class="form-check-input checkboxData_<?=$value1->id_pertanyaan;?>" type="checkbox" name="checkboxData_<?=$value1->id_pertanyaan;?>" id="Jenjang Keterampilan" value="Jenjang Keterampilan" >
                                                    <label class="form-check-label" for="checkboxData_<?=$value1->id_pertanyaan;?>">
                                                    Jenjang Keterampilan
                                                    </label>
                                                </div>                                                
                                                <div class="col-lg-10" style="margin-bottom:10px">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                        <input type="file" id="file_pendukung_<?=$value1->id_pertanyaan;?>" name="file_pendukung_<?=$value1->id_pertanyaan;?>" class="form-control">                                            
                                                    </div>
                                                </div>        
                                                <div class="col-lg-10" style="margin-bottom:10px">
                                                    <button class="btn btn-danger" onclick="uploadWithCheckbox('<?=$value1->id_pertanyaan;?>',1)">Upload</button>                                                
                                                </div>
                                            </div>
                                            <div id="response-section_<?=$value1->id_pertanyaan;?>"></div>                                            
                            <?php
                                        }
                                        else
                                        {
                                            echo "Anda telah menjawab pertanyaan ini.";
                                        }                                        
                                    }                                                                        
                            ?>

                        </div>
                    </div>
                </div>                
            <?php                        
            }
            ?>
            <div class="col-lg-6">
                <?php
                if ($value->sort == $track) {
                    # code...
                ?>
                    <button class="btn btn-success pull-right" onclick="nextProgress('<?=$value->sort;?>')">Selanjutnya</button>                
                <?php
                }
                ?>                
            </div>                                        
        </div>            
            <?php
        }
        ?>

        <div role="tabpanel" class="tab-pane" id="penilaian_kinerja" style="display:none">
            <div id="view_index">
                <div class="col-md-4">
                    <div class="box box-solid" id="isi_kontak">

                        <div class="box-header with-border">
                            <h3 class="box-title">Kandidat Evaluator</h3>
                        </div>
                        <div class="box-body no-padding" style="display: block;">
                            <ul class="nav nav-pills nav-stacked contact-id">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Atasan</h3>
                                    </div>                                    
                                    <?php
                                        $i = 0;
                                        if($atasan != 0)
                                        {
                                            foreach($atasan as $atasan)
                                            {
                                                $i++;
                                                $atasan_nama = $atasan->nama_pegawai;
                                        ?>
                                                <li style="cursor: pointer;background-color: rgb(76, 175, 80);color: rgb(255, 255, 255);" id="li_kandidat_<?=$i;?>"><a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i><?=$atasan->nama_pegawai;?></a><input type="hidden" id="hdn_pegawai_<?=$i;?>" name="list_kandidat" value="<?=$atasan->id;?>"></input>
                                                    <input type="hidden" id="hdn_pegawai_posisi_<?=$i;?>" value="<?=$atasan->posisi;?>"></input>                                
                                                </li>                                    
                                        <?php
                                            }
                                        }                    

                                        if ($atasan_plt != 0) {
                                            # code...
                                            foreach($atasan_plt as $atasan_plt)
                                            {
                                                $i++;
                                    ?>
                                                <li style="cursor: pointer;background-color: rgb(76, 175, 80);color: rgb(255, 255, 255);" id="li_kandidat_<?=$i;?>">
                                                    <a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i>[PLT] <?=$atasan_plt->nama_pegawai;?></a>
                                                    <input type="hidden" id="hdn_pegawai_<?=$i;?>" name="list_kandidat" value="<?=$atasan_plt->id;?>"></input>
                                                    <input type="hidden" id="hdn_pegawai_posisi_<?=$i;?>" value="<?=$atasan_plt->posisi;?>"></input>                                    
                                                </li>                                    
                                    <?php
                                            }                            
                                        }
                                    ?>            
                            </ul>
                        </div>
                        <div class="box-body no-padding" style="display: block;">
                            <ul class="nav nav-pills nav-stacked contact-id">
                                <?php
                                    if($peer != 0){
                                        // $i = 0;
                                ?>
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><i>PEER</i></h3>
                                    </div>                    
                                <?php
                                        foreach($peer as $peer){
                                            $i++;
                                            if ($this->session->userdata('sesNama') != $peer->nama_pegawai) 
                                            {
                                                # code...
                                                if ($atasan_nama != $peer->nama_pegawai) {
                                                    # code...
                                ?>
                                                    <li style="cursor: pointer;" onclick="set_evaluator('<?=$peer->id;?>','<?=$peer->nama_pegawai;?>','<?=$peer->posisi;?>')" id="li_kandidat_<?=$i;?>">
                                                        <a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i><?=$peer->nama_pegawai;?></a>
                                                        <input type="hidden" id="hdn_pegawai_<?=$i;?>" name="list_kandidat" value="<?=$peer->id;?>"></input>
                                                        <input type="hidden" id="hdn_pegawai_posisi_<?=$i;?>" value="<?=$peer->posisi;?>"></input>                                        
                                                    </li>                                    
                                <?php                                    
                                                }
                                            }
                                        }
                                    }
                                ?>            
                            </ul>
                        </div>        
                        <div class="box-body no-padding" style="display: block;">
                            <ul class="nav nav-pills nav-stacked contact-id">
                                <?php
                                    if($bawahan != 0){
                                        // $i = "";
                                ?>
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><i>Bawahan</i></h3>
                                    </div>                    
                                <?php
                                        foreach($bawahan as $bawahan){
                                            $i++;
                                ?>
                                            <li style="cursor: pointer;" onclick="set_evaluator('<?=$bawahan->id;?>','<?=$bawahan->nama_pegawai;?>','<?=$bawahan->posisi;?>')" id="li_kandidat_<?=$i;?>">
                                                <a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i><?=$bawahan->nama_pegawai;?></a>
                                                <input type="hidden" id="hdn_pegawai_<?=$i;?>" name="list_kandidat" value="<?=$bawahan->id;?>"></input>
                                                <input type="hidden" id="hdn_pegawai_posisi_<?=$i;?>" value="<?=$bawahan->posisi;?>"></input>                                
                                            </li>                            
                                <?php
                                        }
                                    }
                                ?>

                                <?php
                                    if($bawahan_plt != 0){
                                        // $i = "";
                                        foreach($bawahan_plt as $bawahan){
                                            $i++;
                                ?>
                                            <li style="cursor: pointer;" onclick="set_evaluator('<?=$bawahan->id;?>','<?=$bawahan->nama_pegawai;?>','<?=$bawahan->posisi;?>')" id="li_kandidat_<?=$i;?>">
                                                <a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i><?=$bawahan->nama_pegawai;?></a>
                                                <input type="hidden" id="hdn_pegawai_<?=$i;?>" name="list_kandidat" value="<?=$bawahan->id;?>"></input>
                                                <input type="hidden" id="hdn_pegawai_posisi_<?=$i;?>" value="<?=$bawahan->posisi;?>"></input>                                
                                            </li>                            
                                <?php
                                        }
                                    }
                                ?>                            
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="box box-solid" id="isi_kontak">

                        <div class="box-header with-border">
                            <h3 class="box-title">Evaluator</h3>
                        </div>
                        <div id="evaluator" class="box-body no-padding" style="display: block;">
                            <ul class="nav nav-pills nav-stacked contact-evaluator">
                                    <?php

                                        $atasan_temp = "";
                                        $atasan_nama = "";
                                        if ($evaluator != 0) {
                                            # code...
                                            if ($atasan1 != 0) {
                                                # code...
                                                foreach($atasan1 as $atasan1){
                                                    $i++;
                                                    $atasan_temp = $atasan1->nama_pegawai;
                                        ?>
                                                    <li style="cursor: pointer;" id="1">
                                                        <a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i><?=$atasan1->nama_pegawai;?></a>
                                                        <input type="hidden" name="list_evaluator" id="list_evaluator_0" value="<?=$atasan1->id;?>"></input>
                                                        <input type="hidden" id="list_evaluator_posisi_0" value="<?=$atasan1->posisi;?>"></input>                                            
                                                        <input type="hidden" id="sources_1" value="local">
                                                    </li>
                                        <?php
                                                }                                
                                            }

                                            if ($atasan2 != 0) {
                                                # code...
                                                foreach($atasan2 as $atasan2){
                                                    $i++;
                                                    $atasan_temp = $atasan2->nama_pegawai;
                                        ?>
                                                    <li style="cursor: pointer;" id="1"><a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i>[PLT] <?=$atasan2->nama_pegawai;?></a><input type="hidden" name="list_evaluator" id="list_evaluator_0" value="<?=$atasan2->id;?>"></input><input type="hidden" id="sources_2" value="local">
                                                        <input type="hidden" id="list_evaluator_posisi_0" value="<?=$atasan2->posisi;?>"></input>                                    
                                                    </li>
                                        <?php
                                                }                                
                                            }                            
                                        }
                                        else
                                        {
                                            if ($atasan1 != 0) {
                                                # code...
                                                foreach($atasan1 as $atasan1){
                                                    $i++;
                                                    $atasan_temp = $atasan1->nama_pegawai;
                                        ?>
                                                    <li style="cursor: pointer;" id="1"><a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i><?=$atasan1->nama_pegawai;?></a><input type="hidden" name="list_evaluator" id="list_evaluator_0" value="<?=$atasan1->nama_pegawai;?>"></input><input type="hidden" id="sources_1" value="local">
                                                        <input type="hidden" id="list_evaluator_posisi_0" value="<?=$atasan1->posisi;?>"></input>                                    
                                                    </li>
                                        <?php
                                                }                                
                                            }

                                            if ($atasan2 != 0) {
                                                # code...
                                                foreach($atasan2 as $atasan2){
                                                    $i++;
                                                    $atasan_temp = $atasan2->nama_pegawai;
                                        ?>
                                                    <li style="cursor: pointer;" id="1"><a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i>[PLT] <?=$atasan2->nama_pegawai;?></a><input type="hidden" name="list_evaluator" id="list_evaluator_0" value="<?=$atasan2->id;?>"></input><input type="hidden" id="sources_2" value="local">
                                                        <input type="hidden" id="list_evaluator_posisi_0" value="<?=$atasan2->posisi;?>"></input>                                    
                                                    </li>
                                        <?php
                                                }                                
                                            }                            

                                        }

                                        if ($evaluator != 0) {
                                            # code...
                                            $x = 1;
                                            for ($i=0; $i < count($evaluator); $i++) { 
                                                # code...
                                                if ($atasan_temp != $evaluator[$i]->nama_pegawai) {
                                                    # code...
                                                    $remove_icon = "";
                                                    $remove_cmd  = "";
                                                    $lock_icon   = "";
                                                    if ($evaluator[$i]->status == 0) {
                                                        # code...
                                                        $remove_icon = '<span class="pull-right" style="padding-bottom: 0px;padding-top: 0px;"><i class="fa fa-close"></i></span>';
                                                        $remove_cmd = 'onclick="remove_list_evaluator_sync('.$x.','.$evaluator[$i]->id_pegawai_penilai.')"';
                                                        $lock_icon = 'fa-circle-o';
                                                    }
                                                    else
                                                    {
                                                        $lock_icon = 'fa-lock';                                        
                                                    }
                                    ?>
                                                    <li style="cursor: pointer;" id="li_evaluator_<?=$x;?>" <?=$remove_cmd;?>>
                                                        <a class="contact-name"><i class="fa <?=$lock_icon;?> text-red contact-name-list"></i><?=$evaluator[$i]->nama_pegawai.$remove_icon;?></a>
                                                        <input type="hidden" name="list_evaluator" id="list_evaluator_<?=$x;?>" value="<?=$evaluator[$i]->id_pegawai_penilai;?>"></input>
                                                        <input type="hidden" id="list_evaluator_posisi_<?=$x;?>" value="<?=$evaluator[$i]->id_posisi_pegawai_penilai;?>"></input>                                        
                                                        <input type="hidden" id="sources_<?=$x;?>" value="server"></li>
                                                    </li>                    
                                    <?php                                    
                                    $x++;
                                                }
                                            }
                                        }
                                    ?>
                            </ul>
                        </div>
                        <div class="box-body">
                            <!-- <div class="col-md-12">
                                <button class="btn btn-default pull-right" id="btn-save-eval">Ajukan Penilai</button>
                            </div> -->
                        </div>
                    </div>
                </div> 
                
                <div class="col-md-4">
                    <div class="box box-solid"> 
                        <div class="box-header with-border">
                            <h3 class="box-title">Permintaan untuk Penilaian Kinerja</h3>
                        </div>
                        <div class="box-body" style="display: block;">
                        <?php
                            if ($request_eval != 0) {
                                # code...
                                for ($i=0; $i < count($request_eval); $i++) { 
                                    # code...
                                    $data_link_a = "";
                                    $data_link_a = base_url() . 'public/images/pegawai/'.$request_eval[$i]->photo; 

                                    $data_done      = "";
                                    $data_done_span = "";
                                    if ($request_eval[$i]->status != NULL) {
                                        # code...
                                        if ($request_eval[$i]->status == 1) {
                                            # code...
                                            $data_done      = "background-color: #4caf50;";                            
                                            $data_done_span = "color:#fff;";                            
                                        }
                                    }
                                    else {
                                        # code...
                                        $data_done      = "";         
                                        $data_done_span = "";                                       
                                    }
                        ?>
                                    <a class="btn btn-app col-lg-11" onclick="get_penilaian_kinerja('<?=$request_eval[$i]->evaluator_id;?>','<?=$request_eval[$i]->id_pegawai;?>')" style="<?=$data_done;?>">
                                        <!-- <img src="<?=$data_link_a;?>" style="height: 100%"> -->
                                        <span style="<?=$data_done_span;?>"><?=$request_eval[$i]->nama_pegawai;?></span>                            
                                    </a>                    
                        <?php                    
                                }
                            }
                        ?>        
                        </div>        
                    </div>
                </div>    
            </div>

            <div id="view_q_pegawai" style="display:none">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body" >
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Pertanyaan</th>
                                    <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>            
                        </div>
                    </div>
                </div>
            </div>                                    
        </div>

        <div role="tabpanel" class="tab-pane" id="pegawai_terbaik" style="display:none">
            <div class="form-group">
                <label class="col-md-2 control-label">Pelaksana</label>
                <div class="col-md-9">
                    <select name="f_es4" id="f_es4" class="form-control form-control-detail" style="margin-bottom: 11px;">
                    <option>-----------</option>
                    <?php
                        foreach($pegawai_terbaik as $pegawai_terbaik){
                    ?>
                        <option><?=$pegawai_terbaik->nama_pegawai;?></option>
                    <?
                        }                            
                    ?>                            
                    </select>
                    <input class="form-control form-control-detail" id="f_es4_id" type="hidden">							
                </div>
                <!-- <a class="btn btn-default" ><i class="fa fa-search"></i></a>							 -->
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">Eselon 4/Sub Koor</label>
                <div class="col-md-9">
                    <select name="f_es4" id="f_es4" class="form-control form-control-detail" style="margin-bottom: 11px;">
                    <option>-----------</option>
                    <?php
                        foreach($pegawai_terbaik1 as $pegawai_terbaik){
                    ?>
                        <option><?=$pegawai_terbaik->nama_pegawai;?></option>
                    <?
                        }                            
                    ?>                            
                    </select>
                    <input class="form-control form-control-detail" id="f_es4_id" type="hidden">							
                </div>
                <!-- <a class="btn btn-default" ><i class="fa fa-search"></i></a>							 -->
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">Eselon 3/Koor</label>
                <div class="col-md-9">
                    <select name="f_es4" id="f_es4" class="form-control form-control-detail" style="margin-bottom: 11px;">
                    <option>-----------</option>
                    <?php
                        foreach($pegawai_terbaik2 as $pegawai_terbaik){
                    ?>
                        <option><?=$pegawai_terbaik->nama_pegawai;?></option>
                    <?
                        }                            
                    ?>
                    </select>
                    <input class="form-control form-control-detail" id="f_es4_id" type="hidden">							
                </div>
                <!-- <a class="btn btn-default" ><i class="fa fa-search"></i></a>							 -->
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">JFT Pertama</label>
                <div class="col-md-9">
                    <select name="f_es4" id="f_es4" class="form-control form-control-detail" style="margin-bottom: 11px;">
                    <option>-----------</option>
                    <?php
                        foreach($pegawai_terbaik3 as $pegawai_terbaik){
                    ?>
                        <option><?=$pegawai_terbaik->nama_pegawai;?></option>
                    <?
                        }                            
                    ?>                            
                    </select>
                    <input class="form-control form-control-detail" id="f_es4_id" type="hidden">							
                </div>
                <!-- <a class="btn btn-default" ><i class="fa fa-search"></i></a>							 -->
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">JFT Muda</label>
                <div class="col-md-9">
                    <select name="f_es4" id="f_es4" class="form-control form-control-detail" style="margin-bottom: 11px;">
                    <option>-----------</option>
                    <?php
                        foreach($pegawai_terbaik4 as $pegawai_terbaik){
                    ?>
                        <option><?=$pegawai_terbaik->nama_pegawai;?></option>
                    <?
                        }                            
                    ?>                            
                    </select>
                    <input class="form-control form-control-detail" id="f_es4_id" type="hidden">							
                </div>
                <!-- <a class="btn btn-default" ><i class="fa fa-search"></i></a>							 -->
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">JFT Madya</label>
                <div class="col-md-9">
                    <select name="f_es4" id="f_es4" class="form-control form-control-detail" style="margin-bottom: 11px;">
                    <option>-----------</option>
                    <?php
                        foreach($pegawai_terbaik5 as $pegawai_terbaik){
                    ?>
                        <option><?=$pegawai_terbaik->nama_pegawai;?></option>
                    <?
                        }                            
                    ?>                            
                    </select>
                    <input class="form-control form-control-detail" id="f_es4_id" type="hidden">							
                </div>
                <!-- <a class="btn btn-default" ><i class="fa fa-search"></i></a>							 -->
            </div>
            
            
            <div class="col-md-11">
                <button class="btn btn-success pull-right" id="btn-save-eval">Simpan</button>
            </div>                    
        </div>                
    </div>    
</div>
<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
    var counter_soal = '<?=$counter_soal;?>'
    var counter_jawaban = '<?=$counter_jawaban;?>'    
    $(document).ready(function(){    
        $('#myModal').modal('show')
    })

    function closeMenu(params) {
        if ('<?=$track;?>' != 5) {
            // $('body > div.wrapper > header > nav > div.navbar-custom-menu.pull-left > ul > li:nth-child(4)').hide()
        }
    }

    function nextProgress(progress) {
        $.ajax({
            url :"<?php echo site_url()?>talenta/checkProgress/<?=$id_pegawai;?>/"+progress,
            type:"post",
            success:function(msg){
                var obj = jQuery.parseJSON (msg);
                console.log(obj.question)
                if (obj.question == obj.questionPegawai) {
                    Lobibox.confirm({
                        title: "Konfirmasi",
                        msg: "Sebelum melanjutkan tahap berikutnya, mohon periksa kembali jawaban anda.",
                        callback: function ($this, type) {
                            if (type === 'yes'){
                                $.ajax({
                                    url :"<?php echo site_url()?>talenta/nextProgress/<?=$id_pegawai;?>/"+progress,
                                    type:"post",
                                    success:function(msg){
                                        $("#loadprosess").modal('hide');
                                        location.reload();                                    
                                    },
                                    error:function(jqXHR,exception)
                                    {
                                        ajax_catch(jqXHR,exception);					
                                    }
                                })   
                            }
                        }                        
                    })
                }            
                else
                {
                    Lobibox.notify('error', {
                        msg: 'Anda belum menyelesaikan pertanyaan'
                    });
                }    
                $("#loadprosess").modal('hide');
            },
            error:function(jqXHR,exception)
            {
                ajax_catch(jqXHR,exception);					
            }
        })     
    }

    function yesOrNo(id,params) {
        if (params == 1) {
            $("#btn-section_"+id).css({"display": "none"});
            $("#file-section_"+id).css({"display": ""});            
        }
        else
        {
            $.ajax({
                url :"<?php echo site_url()?>talenta/yesOrno/"+id+"/<?=$id_pegawai;?>/"+params,
                type:"post",
                success:function(msg){
                    $("#btn-section_"+id).css({"display": "none"})
                    $("#response-section_"+id).html('Anda telah menjawab pertanyaan ini.')                    
                    $("#loadprosess").modal('hide');
                },
                error:function(jqXHR,exception)
                {
                    ajax_catch(jqXHR,exception);					
                }
            })            
        }
   }

   function yesOrNo1(id,params) {
        if (params == 1) {
            $("#btn-section_"+id).css({"display": "none"});
            $("#number-section_"+id).css({"display": ""});            
        }
        else
        {
            $.ajax({
                url :"<?php echo site_url()?>talenta/yesOrno/"+id+"/<?=$id_pegawai;?>/"+params,
                type:"post",
                success:function(msg){
                    $("#btn-section_"+id).css({"display": "none"})
                    $("#response-section_"+id).html('Anda telah menjawab pertanyaan ini.')                    
                    $("#loadprosess").modal('hide');
                },
                error:function(jqXHR,exception)
                {
                    ajax_catch(jqXHR,exception);					
                }
            })            
        }
   }   

    function selectRadio(id) {
        var valueData = $(`input[name="exampleRadios_${id}"]:checked`).val();

        $.ajax({
            url :"<?php echo site_url()?>talenta/yesOrno/"+id+"/<?=$id_pegawai;?>/"+valueData,
            type:"post",
            success:function(msg){
                // $("#btn-section_"+id).css({"display": "none"})
                $("#loadprosess").modal('hide');
            },
            error:function(jqXHR,exception)
            {
                ajax_catch(jqXHR,exception);					
            }
        })
    }

   function getLikert(item,id) {
        $.ajax({
            url :"<?php echo site_url()?>talenta/yesOrno/"+id+"/<?=$id_pegawai;?>/"+item.value,
            type:"post",
            success:function(msg){
                // $("#btn-section_"+id).css({"display": "none"})
                $("#loadprosess").modal('hide');
            },
            error:function(jqXHR,exception)
            {
                ajax_catch(jqXHR,exception);					
            }
        })       
    //    console.log();
   }

   function saveNumber(id) {
    var valueData = $(`#number_${id}`).val();
   }

   function uploadWithCheckbox(id,params) {
        var valeuData = 0
        if (params == 1) {
            var valueData = ''; 
            var checkboxes = document.querySelectorAll(`input[name="checkboxData_${id}"]:checked`);
            for (var checkbox of checkboxes) {
                console.log(checkbox.value);
                valueData += `${checkbox.value} ,`
            }        
        }
        file_pendukung = $('#file_pendukung_'+id).prop('files')[0];
        var form_data  = new FormData();
        form_data.append('file', file_pendukung);
        form_data.append('text', valueData);


        $.ajax({
            url :"<?php echo site_url()?>talenta/upload_file/"+id+"/<?=$id_pegawai;?>/checkbox",
            // dataType: 'json',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend:function(){
                $("#loadprosess").modal('show');
                Lobibox.notify('info', {
                    msg: 'Menyiapkan data untuk upload file'
                });
            },
            success: function(msg1){
                $("#file-section_"+id).css({"display": "none"})
                $("#response-section_"+id).html('Anda telah menjawab pertanyaan ini.')                
                $("#loadprosess").modal('hide');
            },
            error:function(jqXHR,exception)
            {
                ajax_catch(jqXHR,exception);					
            }
        });       
   }   
   
   function upload(id,params) {
    var valeuData = 0
    if (params == 1) {
        valueData = $(`#number_${id}`).val();          
    }
    file_pendukung = $('#file_pendukung_'+id).prop('files')[0];
    var form_data  = new FormData();
    form_data.append('file', file_pendukung);

    $.ajax({
        url :"<?php echo site_url()?>talenta/upload_file/"+id+"/<?=$id_pegawai;?>/"+valueData,
        // dataType: 'json',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        beforeSend:function(){
            $("#loadprosess").modal('show');
            Lobibox.notify('info', {
                msg: 'Menyiapkan data untuk upload file'
            });
        },
        success: function(msg1){
            $("#file-section_"+id).css({"display": "none"})
            $("#number-section_"+id).css({"display": "none"})
            $("#response-section_"+id).html('Anda telah menjawab pertanyaan ini.')            
            // $("#number-section_"+id).html('Anda telah menjawab pertanyaan ini.')                        
            $("#loadprosess").modal('hide');
        },
        error:function(jqXHR,exception)
        {
            ajax_catch(jqXHR,exception);					
        }
    });       
   }

   function set_evaluator(id, name, posisi) {
    var inputs              = document.getElementsByName('list_evaluator');
    var allowData = 1;
    Lobibox.confirm({
        title: "Konfirmasi",
        msg: "Ajukan pegawai ini sebagai evaluator anda ?",
        callback: function ($this, type) {
            var data_sender = {
                id_pegawai : id,
                id_posisi : posisi,
                pegawai : '<?=$id_pegawai;?>',
                posisi : '<?=$id_posisi;?>'
            }

            for (var i = 0; i < inputs.length; i++) {
                if (id === $("#list_evaluator_"+i).val()) {
                    allowData = 0
                    break;
                }
                else
                {
                    allowData = 1
                    // break;
                }
                // console.log()
            }    

            if (allowData == 1) {
                $.ajax({
                    url :"<?php echo site_url();?>/talenta/set_evaluator_prilaku",
                    type:"post",
                    data:{data_sender : data_sender},
                    beforeSend:function(){
                        $("#form_penilaian").modal('hide');
                        $("#loadprosess").modal('show');                                                
                    },
                    success:function(msg){
                        var obj = jQuery.parseJSON (msg);
                        console.log(obj)
                        $("#loadprosess").modal('hide');
                        if (obj.flag == 1) {
                            Lobibox.notify('success', {msg: obj.text});                                                        
                            $("#evaluator ul").append('<li style="cursor: pointer;" id="li_evaluator_'+i+'"><a class="evaluator_a"><i class="fa fa-circle-o text-red contact-name-list"></i>'+name+'<span class="pull-right" style="padding-bottom: 0px;padding-top: 0px;"><i class="fa fa-close"></i></span></a><input type="hidden" name="list_evaluator" id="list_evaluator_'+i+'" value="'+id+'"><input type="hidden" id="list_evaluator_posisi_'+i+'" value="'+posisi+'"></input><input type="hidden" id="sources_'+i+'" value="local"></li>');                    
                            setTimeout(function(){
                                location.reload();
                            }, 5600);                                                                
                        }
                        else
                        {
                            Lobibox.notify('warning', {msg: obj.text});                        
                        }                    
                    },
                    error:function(jqXHR,exception)
                    {
                        ajax_catch(jqXHR,exception);
                    }
                })
            }
            else
            {
                Lobibox.notify('warning', {msg: 'Pegawai ini telah menjadi evaluator anda'});                    
            }            
        }
    })
    
    // console.log(inputs.length)
    // console.log(id, name)
}


function get_penilaian_kinerja(id,id_pegawai) {
    // body...
    $.ajax({
        url :"<?php echo site_url();?>talenta/get_penilaian_kinerja/"+id+"/"+id_pegawai,
        type:"post",
        beforeSend:function(){
            $("#view_index").hide();
            $("#view_q_pegawai").show()
            $("#loadprosess").modal('show');                                                
        },
        success:function(res){
            var obj = jQuery.parseJSON (res);

            // console.log(obj.question);
            var index = 0
            $("#example1 tbody tr").remove()
            for (let index = 0; index < obj.question.length; index++) {
                // const element = array[index];
                var componentParameter = ''
                if (obj.question[index].id_parameter == 2) {
                    componentParameter = `<select class="form-control" name="urtug" id="urtug" onchange="getLikertKinerja(this,${obj.question[index].id_pertanyaan},${id},${id_pegawai});">
                                                <option value=""> - - - - Pilih  - - - - </option>
                                                <option value="1"> Tidak setuju </option>
                                                <option value="2"> Kurang setuju </option>
                                                <option value="3"> Setuju </option>
                                                <option value="4"> Sangat Setuju </option>                                                                                                                                                                                
                                            </select>` 
                } else {
                    componentParameter = `<select class="form-control" name="urtug" id="urtug" onchange="getLikertKinerja(this,${obj.question[index].id_pertanyaan},${id},${id_pegawai});">
                                                <option value=""> - - - - Pilih  - - - - </option>
                                                <option value="1"> 1 </option>
                                                <option value="2"> 2 </option>
                                                <option value="3"> 3 </option>
                                                <option value="4"> 4 </option>
                                                <option value="5"> 5 </option>
                                                <option value="6"> 6 </option>
                                                <option value="7"> 7 </option>
                                                <option value="8"> 8 </option>
                                                <option value="9"> 9 </option>
                                                <option value="10"> 10 </option>                                                                                                                                                                                
                                            </select>`                    
                }

                let rowData = `<tr>
                <td>${index+1}</td>
                <td>${obj.question[index].pertanyaan}</td>
                <td>${componentParameter}</td>                                
                </tr>`

                $('#example1 tbody').append(rowData)                
                // console.log(obj.question[index].pertanyaan)                
            }
            // obj.question.forEach(element => {
            //     // console.log(element)
            //     // $('#example1 tbody').append(rowData);                
            // });

            // $("#form_penilaian").modal('show');
            // $("#nama_pegawai").val(obj[0].nama_pegawai);
            // $("#nip").val(obj[0].nip);
            // $("#oid_skp").val(obj[0].evaluator_id);                   
            // $("#orientasi_pelayanan").val(obj[0].orientasi_pelayanan);
            // $("#integritas").val(obj[0].integritas);
            // $("#komitmen").val(obj[0].komitmen);
            // $("#disiplin").val(obj[0].disiplin);
            // $("#kerjasama").val(obj[0].kerjasama);
            // $("#kepemimpinan").val(obj[0].kepemimpinan);                                                                                    
            // $("#rekomendasi").val(obj[0].rekomendasi);                                                                                                
            setTimeout(function(){ 
                $("#loadprosess").modal('hide');                                
            }, 500);           
        },
        error:function(jqXHR,exception)
        {
            $("#view_index").show();
            $("#view_q_pegawai").hide()            
            ajax_catch(jqXHR,exception);
        }
    })
}

function getLikertKinerja(item,id_pertanyaan,id,id_pegawai) {
    $.ajax({
        url :"<?php echo site_url()?>talenta/likertAntarPegawai/"+id+"/"+id_pegawai+"/"+id_pertanyaan+"/"+item.value,
        type:"post",
        success:function(res){
            var obj = jQuery.parseJSON (res);
            if (obj.reload == 1) {
                location.reload();
            }
            console.log(obj.reload);
            // $("#btn-section_"+id).css({"display": "none"})
            // $("#loadprosess").modal('hide');
        },
        error:function(jqXHR,exception)
        {
            ajax_catch(jqXHR,exception);					
        }
    })
}   
</script>
