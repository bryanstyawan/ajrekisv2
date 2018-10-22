<script>
    window.onload = function() {
        var oid    = getCookie("row_inbox");
        if (oid != 0) 
        {
          document.getElementById("messages-notify").innerHTML = oid;                         
        }
    }
</script>  
<nav class="navbar navbar-static-top hidden-xs" role="navigation">
          <!-- Sidebar toggle button-->
<!--     <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a> -->

    <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img class="icn_user" src="http://sikerja.kemendagri.go.id/images/demo/users/<?=$this->session->userdata('sesNip');?>.jpg">       
              <span class="hidden-xs"><?php echo $this->session->userdata('sesNama');?></span>
            </a>
            <ul class="dropdown-menu">
<!--                 
              <li class="user-header">
                <?php $att = array (
                    'src' => 'img/admin/'.$this->session->userdata('sesFoto'),
                    'class' => 'img-circle'
                );
                echo img($att);?>
                <p>
                  <?php echo $this->session->userdata('sesNama');?> - <?php echo $this->session->userdata('sesNRole');?>
                  <small>Bekerja Sejak <?php echo date('d-F-Y', strtotime($this->session->userdata('sesSince')));?></small>
                </p> 
              </li>
-->
              <li class="user-header" style="height: 49px;"></li>
              <li class="user-footer">
                <div class="pull-left">
                    <?php echo anchor('dashboard/profil/'.($this->session->userdata('sesUser')+1502)*1988,'Profil',array('class'=>'btn btn-default btn-flat'));?>
                  
                </div>
                <div class="pull-right">
                  <?php echo anchor('admin/loginadmin/signout','Keluar',array('class'=>'btn btn-default btn-flat'));?>
                </div>
              </li>
            </ul>
        </li>
    </ul>


    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown tasks-menu">
                <a class="click-notify" href="<?php echo site_url()?>/pesan/home">
                    <span>Pesan</span>
                    <i class="fa fa-envelope"></i>
                    <span class="label label-danger inbox-notif" id="messages-notify"></span>
                </a>            
            </li>
        </ul>
    </div>
</nav>