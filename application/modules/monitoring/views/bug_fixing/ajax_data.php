<?php
    if ($list != 0) {
        # code...
        for ($i=0; $i < count($list); $i++) { 
            # code...
?>
            <tr>
                <td><?=$i+1;?></td>
                <td><?=$list[$i]->nama_pegawai;?></td>
                <td><?=$list[$i]->nip;?></td>																
                <td><?=$list[$i]->judul;?></td>
                <td><?=$list[$i]->isi;?></td>
                <td><?=$list[$i]->status_report;?></td>
                <td><?=$list[$i]->audit_time;?></td>									
                <td>
        <?php
                    if ($list[$i]->file != NULL) {
                        # code...
        ?>
                            <a class="btn btn-success col-lg-12" style="margin:10px;" target="_blank" href="<?php echo site_url();?>public/bug_report/<?=date('Y-m',strtotime($list[$i]->audit_time));?>/<?=$list[$i]->file;?>">
                                <i class="fa fa-download"></i>
                                Download File
                            </a>									
        <?php
                    }					
                    switch ($list[$i]->status) {
                        case '0':
                            # code...
                            if ($this->session->userdata('sesNip') != '999') {
                                # code...
                            }
                            else
                            {
?>
                                <a class="btn btn-primary col-lg-12" style="margin:10px;" onclick="change_status('<?=$list[$i]->id;?>','2','none')">
                                    <i class="fa fa-edit"></i>
                                    Selesai dikerjakan
                                </a>					
<?php
                            }												
                            break;
                        case '1':
                            # code...
                            if ($this->session->userdata('sesNip') != '999') {
                                # code...
                            }
                            else
                            {
?>
                                <a class="btn btn-primary col-lg-12" style="margin:10px;" onclick="change_status('<?=$list[$i]->id;?>','2','none')">
                                    <i class="fa fa-edit"></i>
                                    Selesai dikerjakan
                                </a>					
<?php
                            }																								
                            break;
                        case '2':
                            # code...
                            if ($this->session->userdata('sesNip') != '999') {
                                # code...
?>
                                <a class="btn btn-warning col-lg-12" style="margin:10px;" onclick="change_status('<?=$list[$i]->id;?>','1','note')">
                                    <i class="fa fa-edit"></i>
                                    Perlu revisi
                                </a>					

                                <a class="btn btn-success col-lg-12" style="margin:10px;" onclick="change_status('<?=$list[$i]->id;?>','3','none')">
                                    <i class="fa fa-edit"></i>
                                    Telah selesai
                                </a>												
<?php
                            }																								
                            break;
                        default:
                            # code...
                            break;
                    }
?>
                </td>								
            </tr>
<?php
        }
    }
?>