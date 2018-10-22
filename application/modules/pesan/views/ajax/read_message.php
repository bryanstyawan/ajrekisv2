<?php
if($list != 0){
    $i = "";
    foreach($list as $list){
        $i++;     
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?=$header;?></h3>
        <!--
        <div class="box-tools pull-right">
            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
        </div>
        -->
    </div><!-- /.box-header -->
    <div class="box-body no-padding">
        <div class="mailbox-read-info">
            <h2><u><?=$list->judul_pesan;?></u></h2>
            <h5><?=$text_actor;?> <?=$list->nama_pengirim;?> <span class="mailbox-read-time pull-right"><?=$list->tgl_system;?></span></h5>
        </div><!-- /.mailbox-read-info -->
    <!--
    <div class="mailbox-controls with-border text-center">
      <div class="btn-group">
        <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></button>
        <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Reply"><i class="fa fa-reply"></i></button>
        <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Forward"><i class="fa fa-share"></i></button>
      </div>
      <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Print"><i class="fa fa-print"></i></button>
    </div>
    -->
    <div class="mailbox-read-message">
      <p><?=$list->isi_pesan;?></p>
    </div><!-- /.mailbox-read-message -->
</div><!-- /.box-body -->

<!-- /.box-footer 
<div class="box-footer">

</div>
-->
  
<div class="box-footer">
    <button class="btn btn-default" onClick="delete_this_message(<?=$list->id_pesan;?>,'<?=$param;?>');"><i class="fa fa-trash-o"></i> Hapus</button>
<!--
    <div class="pull-right">
      <button class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
      <button class="btn btn-default"><i class="fa fa-share"></i> Forward</button>
    </div>
    <button class="btn btn-default"><i class="fa fa-print"></i> Print</button>
-->
</div><!-- /.box-footer -->
<?php
    }
}    
?>    