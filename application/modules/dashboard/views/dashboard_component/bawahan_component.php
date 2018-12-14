<input type="hidden" id="member_section_oid">
<h2 class="text-center">Penilaian SKP / Kinerja Bulanan</h2>
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
                    <table class="table table-bordered table-striped table-view" id="table_progress_skp">
                        <thead>
                            <th>No</th>
                            <th>Uraian Tugas/Kegiatan Tugas Jabatan</th>
                            <th>Progress</th>
                        </thead>
                        <tbody></tbody>
                    </table>
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
                        ajax_status(obj);
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
</script>