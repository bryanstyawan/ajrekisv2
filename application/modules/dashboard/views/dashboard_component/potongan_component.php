<div class="col-md-5">

<?php
if ($data_transaksi_rpt != 0) {
    # code...
    if ($data_transaksi_rpt[0]->status_potongan == 1) {
        # code...
?>
    <div class="callout callout-danger">
        <h4>Kinerja (skp) anda bulan ini belum tercapai</h4>
        <p>Pengurangan 5%.</p>    
    </div>
<?php
    }
    elseif ($data_transaksi_rpt[0]->status_potongan == 0) {
        # code...
?>
            <div class="callout callout-success">
                <h4>Kinerja (skp) anda bulan ini telah tercapai</h4>
                <!-- <p></p> -->
            </div>
<?php
    }
    elseif ($data_transaksi_rpt[0]->status_potongan ==  2) {
        # code...
?>
        <div class="callout callout-warning">
            <h4>Kinerja (skp) anda bulan ini belum dinilai (Pengurangann 5%)</h4>
            <p>Silahkan menghubungi atasan untuk dilakukan penilaian.</p>
        </div>
<?php
    }
}

?>

</div>