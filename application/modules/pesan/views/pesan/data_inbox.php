<script>
    window.onload = function() {
        var oid_inbox    = getCookie("row_inbox");
        var oid_send    = getCookie("row_send");

        if (oid_inbox != 0)document.getElementById("counter_inbox").innerHTML = oid_inbox;
        if (oid_send != 0)document.getElementById("counter_send").innerHTML = oid_send;
    }
</script>
<div class="col-md-3">
    <div id="pesan_new" class="btn btn-primary btn-block margin-bottom">Tulis Pesan</div>
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Folders</h3>
                <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
        </div>
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
                <li id="pesan_in" class="active click-notify">
                    <a href="#">
                        <i class="fa fa-inbox"></i>
                        Pesan Masuk
                        <span class="label label-primary pull-right inbox-notif" id="counter_inbox"></span>
                    </a>
                </li>
                <li id="pesan_out" class="click-notify">
                    <a href="#">
                        <i class="fa fa-envelope-o"></i>
                         Pesan Terkirim
                        <span class="label label-primary pull-right" id="counter_send"></span>
                     </a>
                 </li>
                <!-- <li id="pesan_trash" class="click-notify">
                    <a href="#">
                        <i class="fa fa-trash-o" id="counter_trash"></i>
                        Pesan Terhapus
                    </a>
                </li> -->
            </ul>
        </div><!-- /.box-body -->
    </div><!-- /. box -->
    <div class="box box-solid" id="isi_kontak" style="display: none">

        <div class="box-header with-border">
            <h3 class="box-title">Kontak</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked contact-id">
                    <?php
                        if($list_atasan != 0){
                            $i = "";
                    ?>
                        <div class="box-header with-border">
                            <h3 class="box-title">Atasan</h3>
                        </div>
                    <?php
                            foreach($list_atasan as $list_atasan){
                                $i++;
                    ?>
                                <li style="cursor: pointer;" id="<?=$i;?>"><a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i><?=$list_atasan->nama_pegawai;?></a><input type="hidden" id="hdn_id_<?=$i;?>" value="<?=$list_atasan->id_pegawai;?>"></input></li>
                  <?php
                            }
                        }
                  ?>
            </ul>
        </div><!-- /.box-body -->
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked contact-id">
                    <?php
                        if($list != 0){
                            $i = "";
                    ?>
                        <div class="box-header with-border">
                            <h3 class="box-title">Bawahan</h3>
                        </div>
                    <?php
                            foreach($list as $list){
                                $i++;
                    ?>
                                <li style="cursor: pointer;" id="<?=$i;?>"><a class="contact-name"><i class="fa fa-circle-o text-red contact-name-list"></i><?=$list->nama_pegawai;?></a><input type="hidden" id="hdn_id_<?=$i;?>" value="<?=$list->id_pegawai;?>"></input></li>
                  <?php
                            }
                        }
                  ?>
                  <!--
                <li><a href="#"><i class="fa fa-circle-o text-red"></i> Atasan</a></li>
                <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Team</a></li>
                <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Team</a></li>
                  -->
            </ul>
        </div><!-- /.box-body -->


    </div><!-- /.box -->
</div><!-- /.col -->

<div class="col-md-9" id="isi_page">

</div><!-- /.col -->
<script>

function delete_this_message(id,param)
{
//    alert(id);
     Lobibox.confirm({
         title: "Konfirmasi",
         msg: "Anda yakin akan menghapus pesan ini ?",
         callback: function ($this, type) {
            if (type === 'yes'){
                $.ajax({
                    url :"<?php echo site_url()?>/pesan/delete_message/"+id+"/"+param,
                    type:"post",
                    success:function(){
                        Lobibox.notify('success', {
                            msg: 'Pesan Berhasil Dihapus'
                        });
                        setTimeout(function(){
                            if (param == 'inbox')
                            {
                                $.ajax({
                                    url :"<?php echo site_url();?>/pesan/inbox",
                                    type:"post",
                                    success:function(pesan){
                                        $("#isi_page").html(pesan);
                                        $("#isi_kontak").css("display",'none');
                                    }
                                })
                            }
                            else if (param == 'sent')
                            {
                                $.ajax({
                                    url :"<?php echo site_url();?>/pesan/sent",
                                    type:"post",
                                    success:function(pesan){
                                        $("#isi_page").html(pesan);
                                        $("#isi_kontak").css("display",'none');
                                    }
                                })
//                                var oid_send_after_del                            = getCookie("row_send");
  //                              $("#counter_send").html(oid_send_after_del);
                            }
                        }, 5600);

//                          $("#isi").load('admin/ajaxUser');
                    },
                    error:function(){
                        Lobibox.notify('error', {
                            msg: 'Gagal Melakukan Hapus Pesan'
                        });
                    }
                })
            }
        }
    })
}

function open_chat(id,param)
{
    data_sender       = {
                            'id'  : id,
                            'type': param
                        };
    var request = $.ajax({
        url :"<?php echo site_url()?>/pesan/view_message",
        method: "POST",
        data: { data_sender:data_sender},
        dataType: "json"
    });

    request.done(function( msg ) {
        $("#isi_sent").html(msg);
    });

    request.fail(function( jqXHR ) {
        $("#isi_page").html(jqXHR.responseText);
        console.log(jqXHR.responseText);
    });
}

$(document).ready(function(){
    $('.click-notify').click(function()
    {
//        alert("hello")
        var oid_inbox    = getCookie("row_inbox");
        var oid_send    = getCookie("row_send");
        if (oid_inbox != 0)
        {
            document.getElementById("counter_inbox").innerHTML = oid_inbox;
//            document.getElementsByClassName('counter_inbox').innerHTML = oid_inbox;
        }
        else
        {
            document.getElementById("counter_inbox").innerHTML = "";
//            document.getElementsByClassName('counter_inbox').innerHTML = "";
        }

    });

	$("#pesan_in").click(function(){
		$(".active").removeClass("active");
		$("#pesan_in").addClass("active");
		$.ajax({
			url :"<?php echo site_url();?>/pesan/inbox",
			type:"post",
			success:function(pesan){
				$("#isi_page").html(pesan);
                $("#isi_kontak").css("display",'none');
			}
		})
	})

	$("#pesan_out").click(function(){
		$(".active").removeClass("active");
		$("#pesan_out").addClass("active");
		$.ajax({
			url :"<?php echo site_url();?>/pesan/sent",
			type:"post",
			success:function(pesan){
				$("#isi_page").html(pesan);
                $("#isi_kontak").css("display",'none');
			}
		})
	})

	$("#pesan_trash").click(function(){
		$(".active").removeClass("active");
		$("#pesan_trash").addClass("active");
        $.ajax({
            url :"<?php echo site_url();?>/pesan/trash",
            type:"post",
            success:function(pesan){
                $("#isi_page").html(pesan);
                $("#isi_kontak").css("display",'none');
            }
        })
	})

    $('#pesan_new').click(function(){
        $(".active").removeClass("active");
        $.ajax({
            url :"<?php echo site_url();?>/pesan/new_message",
            type:"post",
            success:function(pesan){
                $("#isi_page").html(pesan);
                $("#isi_kontak").css("display",'');
            }
        })
    })

    $('.contact-id li').click(function(){
        var index = $(this).index();
        var text = $(this).text();
        $("#txt_penerima").css({ 'border-color': '#d2d6de' });
        $('#txt_penerima').val(text);
    })
})
</script>
