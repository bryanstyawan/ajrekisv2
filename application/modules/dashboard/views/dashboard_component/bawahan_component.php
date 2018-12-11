<input type="hidden" id="member_section_oid">

<div style="display:none;" id="member_section_area">
    <div class="col-lg-12">
        <div class="container-fluid">
            <div class="box">
                <div class="box-header">
                    <a class="btn btn-danger pull-right" onclick="view_option('main')"><i class="fa fa-close"></i></a>
                </div>
                <div class="box-body">
                    <div class="row">					
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Pegawai</label>
                                <input class="form-control" id="f_name" disabled="disabled">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NIP</label>
                                <input class="form-control" id="f_nip" disabled="disabled">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Eselon I</label>
                                <input class="form-control" id="f_name_es1" disabled="disabled">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Eselon II</label>
                                <input class="form-control" id="f_name_es2" disabled="disabled">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Eselon III</label>
                                <input class="form-control" id="f_name_es3" disabled="disabled">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Eselon IV</label>
                                <input class="form-control" id="f_name_es4" disabled="disabled">
                            </div>
                        </div>                                                            
                    </div>                
                </div>
                <div class="box-footer">

                </div>                
            </div>
        </div>

    </div>

    <div class="col-md-6" style="height:415px;max-height: 415px;margin-bottom:25px;">
        <!-- LINE CHART -->
        <div class="container-fluid">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Pencapaian Menit Efektif <?=date('Y');?></h3>
                </div>
                <div class="box-body chart-responsive" style="height: 371px;">
                    <canvas id="canvas_member_menif_efektif"></canvas>
                </div>
                <!-- /.box-body -->
            </div>        
        </div>
        <!-- /.box -->
    </div>

    <div class="col-md-6" style="height:415px;max-height: 415px;margin-bottom:25px;">
        <!-- LINE CHART -->
        <div class="container-fluid">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Uraian Tugas per <?=date('Y');?></h3>
                </div>
                <div class="box-body chart-responsive" style="height: 371px;">
                    <canvas id="canvas_member_pekerjaan"></canvas>
                </div>
                <!-- /.box-body -->
            </div>        
        </div>
        <!-- /.box -->
    </div>    

    <div class="col-md-12">
        <div class="container-fluid">
            <div class="box">
                <div class="box-body">

                </div>
                <div class="box-footer">
                    <h4 class="text-center">Apakah pegawai ini telah memenuhi capaian target SKP bulan ini ?</h4>
                    <a class="btn btn-info pull-right" onclick="approve_good_kinerja('yes')">
                        <i class="fa fa-check"></i> Ya
                    </a>                                        
                    <a class="btn btn-danger pull-left" onclick="approve_good_kinerja('no')">
                        <i class="fa fa-close"></i> Tidak
                    </a>                                                            
                </div>                
            </div>
        </div>
    </div>
</div>

<script>

    $("#profile-dashboard").hide();  

/************************************************************************ */    
    var VALUES = [56,54,23,65,23,54,23,643,23,43,12,54];
    var MONTHS = [1,2,3,4,5,6,7,8,9,10,11,12];




//the process of adding charts anywhere and everywhere with ease depends on how you structure your
//javascript.
//This worked for me, data, defaults then charts

//this is data for the line charts

var lineChartData = {
  labels: ["Data 1", "Data 2", "Data 3", "Data 4", "Data 5", "Data 6", "Data 7", "Data 7", "Data 7", "Data 7", "Data 5", "Data 2", "Data 4", "Data 1", "Data 7"],
  datasets: [{
    fillColor: "#560620",
    strokeColor: "white",
    strokeLineWidth: 18,
    pointColor: "white",
    data: [20, 90, 140, 25, 53, 67, 47, 98, 30, 80, 20, 40, 10, 60]
  }]
};

// this is data for the donut chart
var data = [{
  value: 300,
  color: "#560620",
  highlight: "#560620",
  label: "Red"
}, {
  value: 50,
  color: "#fff",
  highlight: "#560620",
  label: "Green"
}, {
  value: 100,
  color: "#560620",
  highlight: "#560620",
  label: "Yellow"
}];

//this is data for the bar chart

var barData = {
  labels: ["January", "February", "March", "April", "May", "June", "July"],
  datasets: [{
    label: "My First dataset",
    fillColor: "#560620",
    strokeColor: "rgba(220,220,220,0.8)",
    highlightFill: "#560620",
    highlightStroke: "rgba(220,220,220,1)",
    data: [65, 59, 80, 81, 56, 55, 40]
  }, {
    label: "My Second dataset",
    fillColor: "#fff",
    strokeColor: "rgba(151,187,205,0.8)",
    highlightFill: "#fff",
    highlightStroke: "rgba(151,187,205,1)",
    data: [28, 48, 40, 19, 86, 27, 90]
  }]
};
// these are some defaults you can use for customizing your charts

Chart.defaults.global.responsive = true;
Chart.defaults.global.animationSteps = 50;
Chart.defaults.global.tooltipYPadding = 16;
Chart.defaults.global.tooltipCornerRadius = 0;
Chart.defaults.global.tooltipTitleFontStyle = "normal";
Chart.defaults.global.tooltipFillColor = "white";
Chart.defaults.global.animationEasing = "easeOutBounce";
Chart.defaults.global.scaleLineColor = "black";
Chart.defaults.global.scaleFontSize = 16;
Chart.defaults.global.showScale = false;
Chart.defaults.global.pointDotStrokeWidth = 2;

// then i just duplicated the chart specific options
var ctx = document.getElementById("canvas").getContext("2d");
var LineChartDemo = new Chart(ctx).Line(lineChartData, {
  pointDotRadius: 3,
  bezierCurve: true,
  datasetFill: true,
  datasetStroke: true,
  scaleShowVerticalLines: false,
  scaleShowHorizontalLines: false,
  pointDotStrokeWidth: 4,
  fillColor: "rgba(220,220,220,0.2)",
  scaleGridLineColor: "black"
});

var cty = document.getElementById("myChart").getContext("2d");
var myDoughnutChart = new Chart(cty).Doughnut(data, {
  pointDotRadius: 3,
  bezierCurve: true,
  datasetFill: true,
  datasetStroke: true,
  scaleShowVerticalLines: false,
  scaleShowHorizontalLines: false,
  pointDotStrokeWidth: 4,
  fillColor: "rgba(220,220,220,0.2)",
  scaleGridLineColor: "black"
});

var ctl = document.getElementById("canvas_member_menif_efektif").getContext("2d");
var myBarChart = new Chart(ctl).Bar(barData, {
  pointDotRadius: 3,
  bezierCurve: true,
  datasetFill: true,
  datasetStroke: true,
  scaleShowVerticalLines: false,
  scaleShowHorizontalLines: false,
  pointDotStrokeWidth: 4,
  fillColor: "rgba(220,220,220,0.2)",
  scaleGridLineColor: "black"
});








function approve_good_kinerja(arg) {
    var oid = $("#member_section_oid").val();
    
    tagline = '';
    if (arg == 'yes') {
        tagline = 'berkinerja baik dan mencapai skp bulan ini.';
    }
    else
    {
        tagline = 'berkinerja kurang baik dan belum mencapai skp bulan ini.'
    }

    tagline = "Apakah benar bahwa pegawai ini "+tagline;

    Lobibox.confirm({
        title: "Konfirmasi",
        msg  : tagline,
        callback: function ($this, type) {
            if (type === 'yes'){
                $.ajax({
                    url :"<?php echo site_url()?>dashboard/post_penilaian_skp_bulan/"+arg+'/'+oid,
                    type:"post",
                    beforeSend:function(){
                        $("#loadprosess").modal('show');
                    },
                    success:function(msg){
                        var obj = jQuery.parseJSON (msg);
                        if (obj.status == 1)
                        {
                            Lobibox.notify('success', {
                                msg: obj.text
                                });
                            setTimeout(function(){
                                $("#loadprosess").modal('hide');
                                setTimeout(function(){
                                    location.reload();
                                }, 1500);
                            }, 5000);
                        }
                        else
                        {
                            Lobibox.notify('success', {
                                msg: obj.text
                                });
                            setTimeout(function(){
                                $("#loadprosess").modal('hide');
                            }, 5000);
                        }
                    },
                    error:function(){
                        Lobibox.notify('error', {
                            msg: 'Gagal Melakukan Hapus data'
                        });
                    }
                })
            }
        }
    })    
}
</script>