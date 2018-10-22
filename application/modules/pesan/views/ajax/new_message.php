<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Tulis Pesan</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="form-group">
            <input class="form-control" placeholder="Kepada:" id="txt_penerima" disabled="disabled" />
        </div>
        <div class="form-group">
            <input class="form-control" placeholder="Judul:" id="txt_judul"/>
        </div>
        <div class="form-group">
            <textarea id="compose-textarea" class="form-control" style="height: 300px"></textarea>
        </div>
        <!--
        <div class="form-group">
            <div class="btn btn-default btn-file">
                <i class="fa fa-paperclip"></i> Lampiran
                <input type="file" name="attachment"/>
            </div>
            <p class="help-block">Maksimal. 32MB</p>
        </div>
        -->
    </div><!-- /.box-body -->
    <div class="box-footer">
        <div class="pull-right">
        <!--
            <button class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
        -->
            <button class="btn btn-primary" id="btn_kirim"><i class="fa fa-envelope-o"></i> Kirim</button>
        </div>
        <button class="btn btn-default" id="btn_batal"><i class="fa fa-times"></i> Batal</button>
    </div><!-- /.box-footer -->
</div><!-- /. box -->

<!-- <table>
    <tbody>
        <tr>
            <td>1</td>
            <td>test</td>            
        </tr>
        <tr>
            <td>1</td>
            <td>test</td>            
        </tr>        
    </tbody>
</table> -->

<script type="text/javascript">
$(document).ready(function(){
    $('#btn_kirim').click(function() {
        // body...
        var txt_penerima     = $("#txt_penerima").val();        
        var txt_judul        = $("#txt_judul").val();                
        var compose_textarea = $("#compose-textarea").val();                        

        var data_sender = {
                                'receiver'  : txt_penerima,
                                'title'     : txt_judul,
                                'content'   : compose_textarea
                          };                                        
        $.ajax({
            url :"<?php echo site_url()?>/pesan/send_chat",
            type:"post",
            data:{data_sender : data_sender},
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
                    Lobibox.notify('warning', {
                        msg: obj.text
                        });
                    setTimeout(function(){ 
                        $("#loadprosess").modal('hide');                                
                    }, 5000);                                                                           
                }           
            },
            error:function(){
                Lobibox.notify('error', {
                    msg: 'Proses gagal'
                });
            }
        })        

    })    
});
</script>