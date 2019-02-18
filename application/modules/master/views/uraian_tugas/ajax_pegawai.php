    <?php 
    if($list != 0){
        $x = "";
        foreach($list as $list){
            $x++;
//                                print_r($list->nama_pegawai);die();
?>
    <tr>
                <td style="width: 7%"><?=$x;?></td>                           
                <td style="width: 20%"><?=$list->nip;?></td>
                <td style="width: 20%"><?=$list->nama_pegawai;?></td>
                <td style="width: 20%"><?=$list->nama_posisi;?></td>
                <td style="width: 20%">
                    <?=$list->nama_role;?>
                    <i class="fa fa-exchange" style="cursor:pointer;" onclick="reRole('<?=$list->id;?>')"></i>
                </td>
                <td>
                    <?php echo anchor('master/editPegawai/'.$list->id,'<button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button>');?>&nbsp;&nbsp;
                    <button class="btn btn-primary btn-xs" onclick="del('<?php echo $list->id;?>')"><i class="fa fa-trash"></i></button>                                        
                </td>
    </tr>   
<?php
        }
    }
?>                    
