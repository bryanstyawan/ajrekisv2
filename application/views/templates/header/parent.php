<?php
$style = $controll['type'].$controll['status'];
isset($controll);
if ($controll['type'] != 'all') {
    # code...
    if ($controll['status'] == 0) {
        # code...
        $style = "display:none;";
    }
}
?>

<li class="dropdown user user-menu" style="<?=$style;?>">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="<?php echo $icon;?>"></i>
        <span style='padding-left: 10px;'><?php echo $name;?></span>
        <b class="caret"></b>
        <?php
            if ($counter > 0) {
                # code...
        ?>
            <span class="label label-danger" style="font-size: 14px;"><?php echo $counter;?></span>        
        <?php
            }
        ?>        
    </a>
    <ul class="dropdown-menu" style="width: 560%;height: 300%;background-color: transparent;border-color: transparent;">