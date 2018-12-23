<?php
    if($list != array())
    {
        for($i=0;$i<count($list);$i++)
        {
?>
            <tr>
                <td><?=$i+1;?></td>
                <td><?=$list[$i]['nip'];?></td>
                <td><?=$list[$i]['nama_pegawai'];?></td>
                <td>
                    <?php
                        if($list[$i]['status'] == 1)
                        {
                            echo 'aktif';
                        }
                        elseif($list[$i]['status'] == 0)
                        {
                            echo "tidak aktif";
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if($list[$i]['status'] == 1)
                        {
                    ?>
                            <button class="btn btn-danger btn-xs" onclick="lepas_jabatan('<?php echo $list[$i]['id'];?>')"><i class="fa fa-close"></i> Lepas Jabatan</button>
                    <?php   
                        }
                        elseif($list[$i]['status'] == 0)
                        {
                    ?>
                            <button class="btn btn-danger btn-xs" onclick="del('<?php echo $list[$i]['id'];?>')"><i class="fa fa-trash"></i> Hapus</button>											                    
                    <?php
                        }
                    ?>
                </td>                                                
            </tr>
<?php
        }
    }
?>

<script>
$("#f_jabatan").val('<?=$header[0]['nama_posisi'];?>');
function del(id){
	 Lobibox.confirm({
		 title: "Konfirmasi",
		 msg: "Anda yakin akan menghapus data ini ?",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>/master/data_pegawai/delPegawai/"+id,
					type:"post",
                    success:function(msg){
                        var obj = jQuery.parseJSON (msg);
                        ajax_status(obj);
                    },
                    error:function(jqXHR,exception)
                    {
                        ajax_catch(jqXHR,exception);					
                    }
				})
			}
 	   }
    })
}

function lepas_jabatan(id)
{
    Lobibox.confirm({
		 title: "Konfirmasi",
		 msg: "Anda yakin ingin lepas jabatan ini ?",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>master/data_struktur/lepas_jabatan/"+id,
					type:"post",
                    success:function(msg){
                        var obj = jQuery.parseJSON (msg);
                        ajax_status(obj);
                    },
                    error:function(jqXHR,exception)
                    {
                        ajax_catch(jqXHR,exception);					
                    }
				})
			}
 	   }
    })    
}
</script>