<?php
$prosentase = 0;
if ($summary_tr != 0) {
    # code...
    $prosentase = $summary_tr[0]->prosentase_menit_efektif;
}
else
{
    $prosentase = 0;   
}
?>
<div class="col-md-3 text-center main-dashboard">
        <div class="col-md-12 col-sm-6 tour-step tour7 centering">
            <div class="panel panel-kemendagri" id="persen" style="cursor:pointer;border-color: #00a7d0;height:415px;">
                <div class="panel-body" style="padding:0px;">
                    <div class="col-lg-12 col-xs-8 tour-step tour4 btn-show-stat shrink" id="btn_perlu_direvisi" style="height:100%!important;padding:0px;">
                        <div class="small-box bg-aqua" style="background-color: #9C27B0 !important;margin-bottom:12px;">
                            <div class="inner" style="padding: 30px;">
                                <h3 style="font-size: 30px;"><?=$prosentase;?> %</h3>
                                <p style="font-size: 12px;">PERSENTASE REALISASI MENIT KERJA EFEKTIF</p>
                            </div>
                        </div>
                    </div>
                    <div id="demoWidget text-center" style="position: relative;padding:60px 0px;">
                        <div id="gaugeContainer" class="shrink" style="margin:auto;"></div>
                        <div class="centering" id="gaugeValue" style="font-family: Sans-Serif; text-align: center; font-size: 20px; width: 70px;">
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>