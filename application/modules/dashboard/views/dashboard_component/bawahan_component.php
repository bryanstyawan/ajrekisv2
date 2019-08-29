<input type="hidden" id="member_section_oid">
<div style="display:none;" id="member_section_area">
    <div class="box box-info" style="margin-bottom:0px">
        <div class="box-header with-border">
            <a class="btn btn-danger pull-right" onclick="view_option('main')"><i class="fa fa-close"></i></a>            
            <h2 class="text-center">Penilaian SKP / Kinerja Bulanan</h2>            
        </div>    
    </div>
    <div class="box box-body">
        <div class="col-lg-8">
            <div class="container-fluid">
                <div class="box">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama Pegawai</label>
                            <input class="form-control" id="f_name" disabled="disabled">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>NIP</label>
                            <input class="form-control" id="f_nip" disabled="disabled">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama Jabatan</label>
                            <textarea class="form-control" id="f_name_es1" disabled="disabled"></textarea>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>    
        
        <!-- <div class="col-lg-4">
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
        </div>      -->
        
        <div class="col-lg-12">
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
                </div>        
            </div>
        </div>    

    </div>   
</div>

<script>
$("#profile-dashboard").hide();
</script>