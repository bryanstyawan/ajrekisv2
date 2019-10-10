<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/tabs-checked/css/style_tabs.css'; ?>");</style>
<style type="text/css">
#table_skp>thead>tr>th
{
    vertical-align: middle;    
    text-align: center;
    border: 1px solid rgba(158, 158, 158, 0.2);    
    padding-left: 25px;    
}

#table_skp>tbody>tr>td
{
    text-align: center;
    border: 1px solid rgba(158, 158, 158, 0.2);        
}
</style>


<section id="approval_skp_member">
<?php
if ($member != 0) {
    # code...
?>
<div class="col-md-3">
    <div class="box box-solid" id="isi_kontak" style="">

        <div class="box-header with-border">
            <h3 class="box-title">Anggota</h3>
        </div>
        <div class="box-body no-padding" style="display: block;">
        <ul class="nav nav-pills nav-stacked contact-id">
                <?php
                  $i = "";
                  for ($i=0; $i < count($member); $i++) {
                    // code...
                      $flag_counter = "";
                      if ($member[$i]->counter_belum_diperiksa == 0) {
                        // code...
                        $flag_counter = "display:none;";
                      }
                    ?>
                        <li style="cursor: pointer;" class="teamwork" id="li_kandidat_<?=$i;?>" onclick="detail_skp('<?=$member[$i]->id;?>','<?=$i;?>','<?=$member[$i]->posisi;?>')">
                          <a class="contact-name">
                            <i class="fa fa-circle-o text-red contact-name-list"></i><?=$member[$i]->nama_pegawai;?>
                            <sup style="<?=$flag_counter;?>">
                                <span class="notif-count pull-right">
                                <span><?=$member[$i]->counter_belum_diperiksa;?></span>
                                </span>
                            </sup>
                          </a>
                          <input type="hidden" id="hdn_pegawai_<?=$i;?>" name="list_kandidat" value="<?=$member[$i]->nama_pegawai;?>"></input>
                        </li>
                    <?php
                  }
              ?>
            </ul>
        </div>
    </div>
</div>
<?php
}
?>
</section> 


<!-- DataTables -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-1.12.4.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
function detail_skp(id,ii,posisi) {
    // body...
    $.ajax({
        url :"<?php echo site_url()?>skp/get_target_skp_json/"+id+"/"+posisi,
        type:"post",
        beforeSend:function(){
            $("#loadprosess").modal('show');            
            $("#approval_skp_member").html("");
        },			
        success:function(msg){
            $("#approval_skp_member").html(msg);
            setTimeout(function(){
                $("#loadprosess").modal('hide');
            }, 500);
        },
        error:function(jqXHR,exception)
        {
            ajax_catch(jqXHR,exception);					
        }
    })
}
</script>