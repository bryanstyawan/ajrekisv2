<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="margin-top: 0px;
                                                                    margin-bottom: 0px;
                                                                    padding-bottom: 1px;
                                                                    padding-top: 1px;
                                                                    padding-right: 5px;
                                                                    padding-left: 5px;">
    <?php
        if($infoPegawai != '')
        {
    ?>
    <?php
            if ($infoPegawai[0]->photo == '-') {
                # code...
    ?>
                <img class="icn_user" src="http://mandarinpalace.fi/wp-content/uploads/2015/11/businessman.jpg">
    <?php
            }
            else
            {
                if ($infoPegawai[0]->local == 1) {
                    # code...
    ?>
                    <img class="icn_user" src="<?php echo base_url() . 'public/images/pegawai/'.$infoPegawai[0]->photo;?>">
    <?php
                }
                else
                {
    ?>
                    <img class="icn_user" src="http://sikerja.kemendagri.go.id/images/demo/users/<?=$infoPegawai[0]->photo;?>">
    <?php
                }
            }
        }
        else
        {
    ?>
                <img class="icn_user" src="http://mandarinpalace.fi/wp-content/uploads/2015/11/businessman.jpg">
    <?php
        }
    ?>
    </a>
    <ul class="dropdown-menu" style="left: auto;">
        <li class="user-footer">
            <div class="pull-left">
            <?php echo anchor('admin/change_password','Ubah Password',array('class'=>'btn btn-default btn-flat'));?>
            </div>
            <div class="pull-right">
            <?php echo anchor('admin/loginadmin/signout','Keluar',array('class'=>'btn btn-default btn-flat'));?>
            </div>
        </li>
    </ul>
</li>