<div class="col-md-5">

<?php
    if ($notify_penilaian_skp != 0) {
        # code...
        if ($notify_penilaian_skp[0]->flag_belum_diperiksa == 0) {
            # code...
?>
            <div class="callout callout-warning">
                <h4>Kinerja (skp) anda bulan ini belum dinilai (Pengurangann 5%)</h4>
                <p>Silahkan menghubungi atasan untuk dilakukan penilaian.</p>
            </div>
<?php            
        }
        else {
            # code...
            if ($notify_penilaian_skp[0]->persentase == 5) {
                # code...
?>
                <div class="callout callout-danger">
                    <h4>Kinerja (skp) anda bulan ini belum tercapai</h4>
                    <p>Pengurangan 5%.</p>    
                </div>
<?php                
            } else {
                # code...
?>
                <div class="callout callout-success">
                    <h4>Kinerja (skp) anda bulan ini telah tercapai</h4>
                    <!-- <p></p> -->
                </div>
<?php                
            }
            
        }
    }
?>


</div>