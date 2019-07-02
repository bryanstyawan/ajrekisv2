<input type="hidden" id="member_section_oid">
<div style="display:none;" id="member_section_area">
    <h2 class="text-center">Penilaian SKP / Kinerja Bulanan</h2>

    <div class="col-lg-12">
        <div class="container-fluid">
            <div class="box" style="background-color: transparent;border-top: transparent;box-shadow: none;">
                <div class="box-body">
                    <a class="btn btn-danger pull-right" onclick="view_option('main')"><i class="fa fa-close"></i></a>
                </div>                
            </div>
        </div>    
    </div>
    <div class="col-lg-8">
        <div class="container-fluid">
            <div class="box">
                <div class="box-header">
                </div>
                <div class="box-body">
                    <div class="row">					
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama Pegawai</label>
                                <input class="form-control" id="f_name" disabled="disabled">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>NIP</label>
                                <input class="form-control" id="f_nip" disabled="disabled">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama Jabatan</label>
                                <input class="form-control" id="f_name_es1" disabled="disabled">
                            </div>
                        </div>

                        <!-- <div class="col-md-6">
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
                        </div>                                                             -->
                    </div>                
                </div>
                <div class="box-footer">

                </div>                
            </div>
        </div>

    </div>

    <div class="col-md-4">
        <div class="container-fluid">
            <div class="box">
                <div class="box-body">
                    <h4 class="text-center">Apakah pegawai ini telah memenuhi capaian target SKP bulan ini ?</h4>                
                </div>
                <div class="box-footer">
                    <a class="btn btn-info pull-right" onclick="approve_good_kinerja('yes',0)">
                        <i class="fa fa-check"></i> Ya
                    </a>                                        
                    <a class="btn btn-danger pull-left" onclick="approve_good_kinerja('no',0)">
                        <i class="fa fa-close"></i> Tidak
                    </a>                                                            
                </div>                
            </div>
        </div>
    </div>    

    <div class="col-md-12">
        <!-- LINE CHART -->
        <div class="container-fluid">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Uraian Tugas per <?=date('Y');?></h3>
                </div>
                <div class="box-body chart-responsive">
                    <table class="table table-bordered table-striped table-view" id="table_progress_skp">
                        <thead>
                            <th>No</th>
                            <th style="max-width:30%;width: 750px!important;">Uraian Tugas/Kegiatan Tugas Jabatan</th>
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

    <div class="col-md-9" style="display:none;">
        <!-- LINE CHART -->
        <div class="container-fluid">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Pencapaian Menit Efektif <?=date('Y');?></h3>
                </div>
                <div class="box-body chart-responsive">
                    <canvas id="canvas_member_menif_efektif"></canvas>
                </div>
                <!-- /.box-body -->
            </div>        
        </div>
        <!-- /.box -->
    </div>   

</div>

<script>
$("#profile-dashboard").hide();
</script>