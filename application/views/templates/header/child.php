<ul class="user-footer <?=$layout;?> menu_header menu_1">
    <li>
        <?php echo anchor($url_pages,"<i class='".$icon."'></i><span style='padding-left: 10px;'>".$name."</span>",array('class' => 'col-lg-10'));?>
        <?php
            if ($counter_child > 0) {
                # code...
        ?>
            <span class="label label-danger" style="font-size: 14px;"><?php echo $counter_child;?></span>        
        <?php
            }
        ?>        
    </li>
</ul>