<div class="<?=$class;?> btn-show-stat shrink" id="<?=$id;?>">
    <div class="small-box" style="<?=$color_box;?>">
        <?php
            if ($icon != '') {
                # code...
        ?>
            <div class="icon">
                <i class="<?=$icon['name'];?>" style="<?=$icon['style'];?>"><?=$icon['value'];?></i>
            </div>        
        <?php                
            }
        ?>
        <div class="inner col-lg-12">
            <p><?=$title;?></p>
            <h3><?=$value_php;?></h3>            
        </div>
        <div class="inner">
            <?=$html;?>            
        </div>        
    </div>
</div>    