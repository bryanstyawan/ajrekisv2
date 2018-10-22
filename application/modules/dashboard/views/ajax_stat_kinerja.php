    <?php 
    if($list != 0){
        $x = "";
//        print_r();
        for($i=0; $i<count($list); $i++)
        {
            $x = $i + 1;
?>
    <tr>
                <td><?=$x;?></td>                           
                <td><?=$list[$i]['tgl_mulai'];?></td>
                <td><?=$list[$i]['tgl_selesai'];?></td>
                <td><?=$list[$i]['id_urtug'];?></td>
                <td><?=$list[$i]['nama_pekerjaan'];?></td>                
                <td><?=$list[$i]['output_pekerjaan'];?></td>                                

    </tr>   


<?php
        }
    }
    else
    {        
?>
    <tr>
        <td>Data tidak ditemukan</td>
    </tr>        
<?php        
    }
?>                    
