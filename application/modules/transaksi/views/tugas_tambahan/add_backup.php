<?php
?>
<div class="col-lg-12">
    <div class="box box-default">
        <div class="box-body">
            <div class="row">
                <div class="form-group col-md-12">
                    <label style="color: #000;font-weight: 400;font-size: 19px;">Jenis Tugas Tambahan</label>
                    <select class="form-control tour-step step1" name="jenis_tugas_tambahan" id="jenis_tugas_tambahan">
                            <option value="">Pilih Jenis tugas tambahan</option>
                            <?
                                if ($jenis->result_array()) {
                                    # code...
                                    $counter = $jenis->result_array();
                                    for ($i=0; $i < count($counter); $i++) { 
                                        # code...
                            ?>
                                        <option value="<?=$counter[$i]['id'];?>"><?=$counter[$i]['jenis_tugas_tambahan'];?></option>
                            <?php
                                    }
                                }
                            ?>
                    </select>
                </div>

            </div>
        </div>                            
    </div>

    <div class="box box-default">
        <div class="box-body">
            <table id="detail_table" class="table table-bordered table-striped table-view">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Surat Keterangan</th>
                        <th>File Surat Keterangan</th>
                        <th>
                            Keterangan
                            <a class="btn btn-primary btn-xs pull-right" id="btn_add_row" style="display: none;"> <i class="fa fa-plus-square"></i>&nbsp;Tambah Tugas Tambahan</a>                            
                        </th>
                    </tr>
                </thead>
                <tbody id="table_content">
                    <tr id="row_0">
                        <td colspan="4" class="text-center">
                            data tidak ditemukan
                            <input type="hidden" name="input_col">                            
                        </td>
                    </tr>
                </tbody>
            </table> 
        </div>                            
    </div>   

    <div class="box box-default" id="section_save_all" style="display: none;">
        <div class="box-body">
            <a class="btn btn-primary btn-md pull-right" id="btn_save_all"> <i class="fa fa-plus-square"></i>&nbsp;Simpan</a>
        </div>
    </div>     
</div>

<script type="text/javascript">
    $(document).ready(function()
    {

        $("#btn_save_all").click(function()
        {

            var inputs             = document.getElementsByName('input_col');
            var data_sender_detail = [];

            data_sender            =  {
                                          'jenis' : $('#jenis_tugas_tambahan').val(),
                                          'rows'  : inputs.length
                                      }

            Lobibox.confirm({
                 title: "Konfirmasi",
                 msg: "Anda akan menambah tugas tambahan untuk tahun ini ?",
                 callback: function ($this, type) {
                    if (type === 'yes'){
                        $.ajax({
                            url :"<?php echo site_url()?>/transaksi/add_data_tugas_tambahan/",
                            type:"post",
                            data:{data_sender : data_sender},                            
                            beforeSend:function(){
                                $("#loadprosess").modal('show');                
                            },                                      
                            success:function(msg){
                                var obj = jQuery.parseJSON (msg);             
                                if (obj.status == 1) 
                                {
                                    Lobibox.notify('success', {
                                        msg: obj.text
                                        });
                                    setTimeout(function(){ 
                                        $("#loadprosess").modal('hide');
                                        setTimeout(function(){
                                            window.location.href = "<?php echo site_url()?>transaksi/tugas_tambahan_dan_kreativitas";
                                            // location.reload();
                                        }, 1500);                                                                   
                                    }, 5000);                
                                }
                                else
                                {
                                    Lobibox.notify('success', {
                                        msg: obj.text
                                        });
                                    setTimeout(function(){ 
                                        $("#loadprosess").modal('hide');                                
                                    }, 5000);                                                                           
                                }           
                            },
                            error:function(){
                                Lobibox.notify('error', {
                                    msg: 'Gagal Melakukan Hapus data'
                                });
                            }
                        })
                    }
                }
            })  

        })


        $("#btn_add_row").click(function() 
        {
            // body...
            var inputs             = document.getElementsByName('input_col');            
            i = inputs.length + +1;
            var newrec =    "<tr id='row_"+i+"'>"+
                                "<td>"+i+"</td>"+
                                "<td><input class='form-control' type='text' disabled='disabled'></td>"+
                                "<td><input class='form-control' type='file' disabled='disabled'></td>"+
                                "<td><textarea class='form-control' disabled='disabled'></textarea></td>"+ 
                                "<input type='hidden' name='input_col'>"                                      
                            "</tr>";
            $('#detail_table tbody').append(newrec);            
        })

        $('#jenis_tugas_tambahan').change(function() 
        {
            // body...
            $("#btn_add_row").css("display", "none");                                
            $("#section_save_all").css("display", "");            
            $('#detail_table tbody').empty();           
            if ($(this).val() == 1) 
            {
                for (var i = 1; i <= 3; i++) 
                {
                    var newrec =    "<tr id='row_"+i+"'>"+
                                        "<td>"+i+"</td>"+
                                        "<td><input class='form-control' type='text' disabled='disabled'></td>"+
                                        "<td><input class='form-control' type='file' disabled='disabled'></td>"+
                                        "<td><textarea class='form-control' disabled='disabled'></textarea></td>"+ 
                                        "<input type='hidden' name='input_col'>"                                      
                                    "</tr>";
                    $('#detail_table tbody').append(newrec);
                }
            }
            else if($(this).val() == 2)
            {                                   
                for (var i = 1; i <= 6; i++) {
                    var newrec =    "<tr id='row_"+i+"'>"+
                                        "<td>"+i+"</td>"+
                                        "<td><input class='form-control' type='text' disabled='disabled'></td>"+
                                        "<td><input class='form-control' type='file' disabled='disabled'></td>"+
                                        "<td><textarea class='form-control' disabled='disabled'></textarea></td>"+ 
                                        "<input type='hidden' name='input_col'>"                                      
                                    "</tr>";
                    $('#detail_table tbody').append(newrec);                    
                }
            }
            else if($(this).val() == 3)
            {                                   
                $("#btn_add_row").css("display", "");
                for (var i = 1; i <= 7; i++) {
                    var newrec =    "<tr id='row_"+i+"'>"+
                                        "<td>"+i+"</td>"+
                                        "<td><input class='form-control' type='text' disabled='disabled'></td>"+
                                        "<td><input class='form-control' type='file' disabled='disabled'></td>"+
                                        "<td><textarea class='form-control' disabled='disabled'></textarea></td>"+ 
                                        "<input type='hidden' name='input_col'>"                                      
                                    "</tr>";
                    $('#detail_table tbody').append(newrec);                    
                }                
            }            
            else
            {
                var newrec =    "<tr id='row_0'>"+
                                    "<td colspan='4' class='text-center'>data tidak ditemukan</td>"+
                                    "<input type='hidden' name='input_col'>"                                      
                                "</tr>";
                $('#detail_table tbody').append(newrec);                
                $("#section_save_all").css("display", "none");                                
            }
        })
    });
</script>