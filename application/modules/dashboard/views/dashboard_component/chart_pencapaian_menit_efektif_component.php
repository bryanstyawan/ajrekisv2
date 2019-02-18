<?php
    if($member == array())
    {
?>
<div class="col-md-5" style="height:415px;max-height: 415px;margin-bottom:25px;">
    <!-- LINE CHART -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Pencapaian Menit Efektif <?=date('Y');?></h3>
        </div>
        <div class="box-body chart-responsive" style="height: 371px;">
            <canvas id="canvas"></canvas>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jqWidget/js/jqxdata.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jqWidget/js/jqxchart.core.js"></script>
<script>
    /** ----------------------------------------------------------------------- */
    $("#profile-dashboard").hide();  
    var VALUES = '<?=$data_value;?>';
    var MONTHS = '<?=$data_bulan;?>';
    var config = {
        type: 'line',
        data: {
            labels: jQuery.parseJSON (MONTHS),
            datasets: [{
                label: 'Menit Efektif',
                data: jQuery.parseJSON (VALUES),
                fill: false,
            }]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Bulan'
                }
                }],
                yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Menit Efektif'
                }
                }]
            }
        }
    };

    window.onload = function() {
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myLine = new Chart(ctx, config);
    };
</script>
<?php
    }
?>