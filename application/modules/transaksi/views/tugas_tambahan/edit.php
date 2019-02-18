<div class="col-lg-12">
    <div class="box box-default">
        <div class="box-body">
            <div class="row">
                <div class="form-group col-md-12">
                    <input type="hidden" value="<?=$oid;?>" id="oid_tugas_tambahan">
                    <label style="color: #000;font-weight: 400;font-size: 19px;">Nomor Surat Keputusan / Nomor Surat Keterangan Perintah / Nomor Surat Keterangan</label>
                    <input type="text" id="surat_keterangan" name="surat_keterangan" class="form-control tour-step step1" value="<?=$detail[0]->no_surat_keterangan;?>">
                </div>

                <div class="form-group col-md-6">
                    <label style="color: #000;font-weight: 400;font-size: 19px;">File Surat Keputusan / File Surat Keterangan Perintah / File Surat Keterangan</label><label class="pull-right">(pdf|csv|zip|docx|doc|xlsx|xl|xls|jpg|jpeg)</label>
                    <input type="file" id="file_surat_keterangan" name="file_surat_keterangan" class="form-control tour-step step1">
                </div>

                <div class="form-group col-md-6">
                    <label class="col-md-12" style="color: transparent;font-weight: 400;font-size: 19px;">File Surat Keputusan / File Surat Keterangan Perintah / File Surat Keterangan</label><label class="pull-right col-md-12" style="color:transparent;">(pdf|csv|zip|docx|doc|xlsx|xl|xls|jpg|jpeg)</label>
                    <?php
                      $flag_a     = "";
                      $remarks_a  = "";
                      if ($detail[0]->file_surat_keterangan == '') {
                        // code...
                        $remarks_a  = "N/A";
                        $flag_a     = "disabled='disabled'";
                      }
                      else {
                        // code...
                        $remarks_a  = $detail[0]->file_surat_keterangan;
                        $flag_a     = "";
                      }
                    ?>
                    <a href="<?php echo site_url()?>public/file_tugas_tambahan/<?=$detail[0]->file_surat_keterangan;?>" class="btn btn-success"><i class="fa fa-download"></i></a>
                    <span style="margin-left: 15px;font-size: 15px;"><?=$remarks_a;?></span>

                </div>
                <div class="form-group col-md-12">
                    <label style="color: #000;font-weight: 400;font-size: 19px;">Keterangan</label>
                    <textarea class="form-control tour-step step1" id="keterangan" name="keterangan"><?=$detail[0]->keterangan;?></textarea>
                </div>
            </div>
            <div class="box-footer">
                <a class="btn btn-primary btn-md pull-right" id="btn_save_all"> <i class="fa fa-plus-square"></i>&nbsp;Simpan</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function()
{
    $("#btn_save_all").click(function()
    {
        // body...
        nomor_surat      = $("#surat_keterangan").val();
        file_pendukung   = $('#file_surat_keterangan').prop('files')[0];
        keterangan_surat = $("#keterangan").val();
        oid              = $("#oid_tugas_tambahan").val();

        data_sender = {
                            'nomor_surat'       : nomor_surat,
                            'keterangan_surat'  : keterangan_surat,
                            'flag'              : ''
        }

        if (keterangan.length <= 0 || nomor_surat.length <= 0)
        {
            Lobibox.notify('warning', {
                msg: 'Harap lengkapi data-data pendukung.'
            });
        }
        else
        {
            if (keterangan_surat.length <= 0)
            {
                Lobibox.notify('warning', {
                    msg: 'Keterangan Wajib Diisi.'
                });
            }
            else
            {
              if (file_pendukung == undefined)
              {
                $.ajax({
                    url :"<?php echo site_url();?>/transaksi/add_data_tugas_tambahan_detail/"+oid,
                    type:"post",
                    data:{data_sender : data_sender},
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
                                    window.location.href = "<?php echo site_url()?>/transaksi/tugas_tambahan_dan_kreativitas/";
                                }, 1500);
                            }, 5000);
                        }
                        else
                        {
                            Lobibox.notify('warning', {
                                msg: obj.text
                                });
                            setTimeout(function(){
                                $("#loadprosess").modal('hide');
                            }, 5000);
                        }
                    },
                    error:function(){
                        Lobibox.notify('error', {
                            msg: 'Gagal Menambah Pekerjaan'
                        });
                    }
                })
              }
              else
              {
                  // alert("send data");
                  var form_data = new FormData();
                  form_data.append('file', file_pendukung);
                  $.ajax({
                      url: '<?php echo site_url();?>/transaksi/upload_tugas_tambahan/edit/'+oid, // point to server-side PHP script
                      // dataType: 'json',  // what to expect back from the PHP script, if anything
                      cache: false,
                      contentType: false,
                      processData: false,
                      data: form_data,
                      type: 'post',
                      beforeSend:function(){
                          $("#editData").modal('hide');
                          $("#loadprosess").modal('show');
                          Lobibox.notify('info', {
                              msg: 'Menyiapkan data untuk upload file'
                              });
                      },
                      success: function(msg1){
                          var obj1 = jQuery.parseJSON (msg1);
                          console.log(msg1);
                          if (obj1.status == 1)
                          {
                              $.ajax({
                                  url :"<?php echo site_url();?>/transaksi/add_data_tugas_tambahan_detail/"+oid,
                                  type:"post",
                                  data:{data_sender : data_sender},
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
                                                  window.location.href = "<?php echo site_url()?>/transaksi/tugas_tambahan_dan_kreativitas/";
                                              }, 1500);
                                          }, 5000);

                                      }
                                      else
                                      {
                                          Lobibox.notify('warning', {
                                              msg: obj.text
                                              });
                                          setTimeout(function(){
                                              $("#loadprosess").modal('hide');
                                          }, 5000);
                                      }
                                  },
                                  error:function(){
                                      Lobibox.notify('error', {
                                          msg: 'Gagal Menambah Pekerjaan'
                                      });
                                  }
                              })
                          }
                          else
                          {
                              Lobibox.notify('warning', {
                                  msg: obj.text
                                  });
                              setTimeout(function(){
                                  $("#loadprosess").modal('hide');
                              }, 5000);
                          }
                      },
                      error:function(){
                          Lobibox.notify('error', {
                              msg: 'Gagal Menambah Pekerjaan'
                          });
                      }
                  });
              }
            }
        }
    });
});
</script>
