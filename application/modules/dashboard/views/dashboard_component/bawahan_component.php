<input type="hidden" id="member_section_oid">
<div class="col-md-12" id="member_section_area" style="display:none;">

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

<script>
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