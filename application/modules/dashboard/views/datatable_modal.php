<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.css'; ?>");</style>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<table class="table table-bordered table-striped table-view">
    <thead>
        <tr>
            <th>Tanggal, Jam Mulai</th>
            <th>Tanggal, Jam Selesai</th>
            <th>Uraian Tugas</th>
            <th>Realisasi Target SKP</th>
            <th>Target SKP</th>
            <th>Keterangan Pekerjaan</th>
            <th>Output Kuantitas</th>
            <th>File Pendukung</th>
            <?=($oid == 1)?'<th>Menit Efektif</th>':'';?>
        </tr>
    </thead>
    <tbody>
    <?php
        if ($list != 0)
        {
            # code...
            $active_keberatan = "";
            $active_banding   = "";
            for ($i=0; $i < count($list); $i++) {
                # code...
    ?>
                <tr>
                    <td><?=$list[$i]->tanggal_mulai;?>&nbsp;<?=$list[$i]->jam_mulai;?></td>
                    <td><?=$list[$i]->tanggal_selesai;?>&nbsp;<?=$list[$i]->jam_selesai;?></td>
                    <td><a href=""><?=$list[$i]->kegiatan_skp;?></a></td>
                    <td><?=$list[$i]->realisasi_skp;?></td>
                    <td><?=$list[$i]->target_skp;?></td>
                    <td><?=$list[$i]->nama_pekerjaan;?></td>
                    <td><?=$list[$i]->frekuensi_realisasi.' '.$list[$i]->target_output_name;?></td>
                    <td>
                    <?php
                        $link = "";
                        if ($list[$i]->file_pendukung != '') {
                            # code...
                    ?>
                        <a class="btn btn-success btn-xs" href="<?php echo base_url() . 'public/file_pendukung/'.$list[$i]->file_pendukung; ?>"><i class="fa fa-download"></i>&nbsp;Unduh</a>
                    <?php
                        }
                    ?>
                    </td>         
                    <?=($oid == 1)?'<td>'.$list[$i]->menit_efektif.'</td>':'';?>
                </tr>
    <?php
            }
        }
    ?>
    </tbody>
</table>
<script>
    $(document).ready(function(){             
        $(".table-view").DataTable({
            "oLanguage": {
                "sSearch": "Pencarian :",
                "sSearchPlaceholder" : "Ketik untuk mencari",
                "sLengthMenu": "Menampilkan data&nbsp; _MENU_ &nbsp;Data",
                "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "sZeroRecords": "Data tidak ditemukan"
            },
            "dom": "<'row'<'col-sm-6'f><'col-sm-6'l>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "bSort": false

            // "dom": '<"top"f>rt'
            // "dom": '<"top"fl>rt<"bottom"ip><"clear">'
        });
    });
</script>