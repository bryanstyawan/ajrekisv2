<?php
	$row = $select_eselon_4->result();
    if ($param1 == NULL) {
        # code...
        $param1 = 'master';
    }    
?>
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-star"></i></span>
        <select name="select_eselon_4" id="select_eselon_4" class="form-control filter_data_eselon">
        	<option value="">Pilih Eselon 4</option>
        	<?php
        		if ($select_eselon_4->result() != "") {
        			# code...

        			for ($i=0; $i < count($select_eselon_4->result()); $i++) { 
        				# code...
        	?>
						<option value="<?php echo $row[$i]->id_es4;?>"><?php echo $row[$i]->nama_eselon4;?></option>
         	<?php
         			}
        		}
        	?>
		</select>
	</div>
</div>

<script>
$(document).ready(function(){
$("#select_eselon_4 ").change(function(){
        var select_eselon_1      = $("#select_eselon_1").val();
        var select_eselon_2      = $("#select_eselon_2").val();
        var select_eselon_3      = $("#select_eselon_3").val();
        var select_eselon_4      = $("#select_eselon_4").val();
        var select_jenis_jabatan = $("#select_jenis_jabatan").val();
        var data_link = {
                        'data_1': select_eselon_1,
                        'data_2': select_eselon_2,
                        'data_3': select_eselon_3,
                        'data_4': select_eselon_4,
                        'data_5': select_jenis_jabatan
        }               
        $.ajax({
            url :"<?php echo site_url()?><?=$param1;?>/<?=$param;?>",
            type:"post",
            data: { data_sender : data_link},
            beforeSend:function(){
                $("#loadprosess").modal('show');                
                $("#halaman_header").html("");
                $("#halaman_footer").html("");
                $('#example1').dataTable().fnDestroy();         
                $("#example1 tbody tr").remove();           
                var newrec  = '<tr">' +
                                    '<td colspan="8" class="text-center">Memuat Data</td>'
                               '</tr>';     
                $('#example1 tbody').append(newrec);                                    
            },                                              
            success:function(msg){
                $("#example1 tbody tr").remove();                                                   
                $("#table_content").html(msg);
                $("#example1").DataTable({
                    "oLanguage": {
                        "sSearch": "Pencarian :",
                        "sSearchPlaceholder" : "Ketik untuk mencari",
                        "sLengthMenu": "Menampilkan data&nbsp; _MENU_ &nbsp;Data",
                        "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        "sZeroRecords": "Data tidak ditemukan"  
                    },
                    "dom": "<'row'<'col-sm-6'f><'col-sm-6'l>>" +
                            "<'row'<'col-sm-5'i><'col-sm-7'p>>" +           
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                    "bSort": false                       
                    // "dom": '<"top"f>rt'
                    // "dom": '<"top"fl>rt<"bottom"ip><"clear">'            
                });
                setTimeout(function(){ 
                    $("#loadprosess").modal('hide');                                
                }, 500);                                   
            },
			error:function(jqXHR,exception)
			{
				ajax_catch(jqXHR,exception);					
			}
        })
    })
    
})
    </script>