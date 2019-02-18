<li class="dropdown notifications-menu" id="noti-tab">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o" style="font-size: 26px;"></i>
        <span>Pemberitahuan<span>
        <span class="label label-warning" style="font-size: 14px;"><?php echo $counter;?></span>
    </a>

    <div class="noti-container">
        <div class="noti-title">
            <span class="new-noti-title">Anda mempunyai <?php echo $counter;?> Pemberitahuan </span>
            <span class="noti-count" id="noti-container-count"></span>
        </div>
        <ul class="noti-body">
<?php
            foreach($notify_result as $row_notify)
            {
                $photo_sender = "";
                if ($row_notify->photo_sender == '-') {
                    # code...
                    $photo_sender = '<img class="icn_user" src="'.base_url().'assets/images/businessman1.jpg">';
                }
                else
                {
                    $photo_sender = '<img class="icn_user" src="http://sikerja.kemendagri.go.id/images/demo/users/'.$row_notify->photo_sender.'">';
                }

                if ($row_notify->status_log == 'notify') {
                    # code...
?>
                    <li class="noti-text">
                        <a href="<?php echo site_url();?>/Admin/redirect_notifikasi/<?php echo $row_notify->id?>">
                            <div class="col-lg-3" style="padding-left: 0px;padding-right: 0px;">
                                <?php echo $photo_sender;?>
                            </div>
                            <?php echo $row_notify->remarks;?>
                            <div class="col-lg-9 pull-right">
                                <label class="pull-right"><?php echo $row_notify->audit_time;?></label>
                            </div>
                        </a>
                    </li>

<?php
                }
                else
                {
?>
                    <li class="noti-text">
                        <a href="<?php echo site_url().'/'.$row_notify->url;?>">
                            <div class="col-lg-3" style="padding-left: 0px;padding-right: 0px;">
                                <?php echo $photo_sender;?>
                            </div>
                            <?php echo $row_notify->remarks;?>
                            <div class="col-lg-9 pull-right">
                                <label class="pull-right">[Approval] <?php echo $row_notify->audit_time;?></label>
                            </div>
                        </a>
                    </li>
<?php
                }
            }
?>
        </ul>
        <div class="noti-footer">
            <div class="col-lg-6">
                <button class="btn btn-default btn-flat pull-left">
                    <i class="fa fa-check-circle-o"></i>
                    Telah Melihat semua pemberitahuan										
                </button> 
            </div>									
            <div class="col-lg-6">
                <a class="btn btn-default btn-flat pull-right" onclick="goto_link('dashboard/view_notification')">
                    <i class="fa fa-eye"></i>
                    Lihat semua pemberitahuan
                </a>
            </div>
        </div>
    </div>
</li>