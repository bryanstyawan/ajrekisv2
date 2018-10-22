    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Pesan Masuk</h3>
        </div><!-- /.box-header -->
        <div class="box-body no-padding">
                  
            <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                    <tbody>
                    <?php
                        function time_elapsed_string($datetime, $full = false) {
                            $now = new DateTime;
                            $ago = new DateTime($datetime);
                            $diff = $now->diff($ago);

                            $diff->w = floor($diff->d / 7);
                            $diff->d -= $diff->w * 7;

                            $string = array(
                                'y' => 'tahun',
                                'm' => 'bulan',
                                'w' => 'minggu',
                                'd' => 'hari',
                                'h' => 'jam',
                                'i' => 'menit',
                                's' => 'detik',
                            );
                            foreach ($string as $k => &$v) {
                                if ($diff->$k) {
                                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
                                } else {
                                    unset($string[$k]);
                                }
                            }

                            if (!$full) $string = array_slice($string, 0, 1);
                            return $string ? implode(', ', $string) . ' yang lalu' : 'Sekarang';
                        }

                        if($list != 0){
                            $i = "";
                            foreach($list as $list){
                                $i++;
                    ?>
                        <tr>
                            <td style="width: 35px">
                                <input type="checkbox">
                            </td>
                            <td class="mailbox-star" style="width: 30px">
                                <a href="#"><i class="fa fa-star text-yellow"></i></a>
                            </td>
                            <td class="mailbox-name" style="width: 300px" onClick="open_chat(<?=$list->id_pesan;?>,'inbox');">
                                <a href="#"><?=$list->nama_pengirim;?></a>
                            </td>
                            <td class="mailbox-subject" style="width: 230px">
                                <a href=""><b><?=$list->judul_pesan;?></b></a>
                            </td>
                            <td class="mailbox-attachment" style="width: 30px"></td>
                            <td class="mailbox-date"><?php echo time_elapsed_string($list->tgl_system);?></td>
                        </tr>   
                  <?php
                            }
                        }
                        else
                        {
                  ?>
                            <tr>
                                <td colspan="6" class="text-center">
                                    Data tidak ditemukan
                                </td>
                            </tr>                  

                  <?php
                        }
                  ?>                    
                    </tbody>
                </table><!-- /.table -->
            </div><!-- /.mail-box-messages -->
        </div><!-- /.box-body -->
        <div class="box-footer no-padding">
            <div class="mailbox-controls">
<!--             
                <button class="btn btn-default btn-sm checkbox-toggle">
                    <i class="fa fa-square-o"></i>Pilih Semua
                </button>
                <div class="btn-group">
                    
                    <button class="btn btn-default btn-sm">
                        <i class="fa fa-trash-o"></i>
                        Hapus
                    </button>
                    <button class="btn btn-default btn-sm">
                        <i class="fa fa-reply"></i>
                        Balas
                    </button>
                    <button class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>

                </div>
                <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                </div>

            -->
            </div> 
        </div>
    </div><!-- /. box -->