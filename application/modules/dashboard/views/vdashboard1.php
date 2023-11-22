<?php
$data_bulan[] = "";
$data_value[] = "";

if ($menit_efektif_year != 0) {
    // code...
    // for ($i=0; $i < count($menit_efektif_year); $i++) {
    //     // code...
    //     $data_bulan[$i] = $menit_efektif_year[$i]->nama_bulan;
    //     $data_value[$i] = $menit_efektif_year[$i]->menit_efektif;
    // }

    // $data_bulan = json_encode($data_bulan);
    // $data_value = json_encode($data_value);
}

$nama_pegawai  = "";
$nama_jabatan  = "";
$nama_eselon1  = "";
$nama_eselon2  = "";
$nama_eselon3  = "";
$nama_eselon4  = "";
$nama_agama    = '';
$nip           = "";
$kelas_jabatan = "";
if ($infoPegawai != 0 || $infoPegawai != '') {
    # code...
    $nama_pegawai  = $infoPegawai[0]->nama_pegawai;
    $nama_jabatan  = $infoPegawai[0]->nama_jabatan;
    $nama_eselon1  = $infoPegawai[0]->nama_eselon1;
    $nama_eselon2  = $infoPegawai[0]->nama_eselon2;
    $nama_eselon3  = $infoPegawai[0]->nama_eselon3;
    $nama_eselon4  = $infoPegawai[0]->nama_eselon4;
    $nip           = $infoPegawai[0]->nip;
    if ($infoPegawai[0]->kat_posisi == 1) {
        # code...
        $kelas_jabatan = $infoPegawai[0]->grade_raw;        
    }
    elseif ($infoPegawai[0]->kat_posisi == 2) {
        # code...
        $kelas_jabatan = $infoPegawai[0]->grade_jft;                
    }
    elseif ($infoPegawai[0]->kat_posisi == 4) {
        # code...
        $kelas_jabatan = $infoPegawai[0]->grade_jfu;        
    }
    $nama_agama    = $infoPegawai[0]->nama_agama;
}

$fingerprint = "";
?>

<?php
$this->load->view('dashboard_component/style_component');
$this->load->view('dashboard_component/php_logic_component');
// $this->load->view('dashboard_component/surveycuti');
// echo "<script>
			// $(document).ready(function()
			// {
				// $('#modal-infosurvey').modal('show'); 
		// }) </script>";
?>
<?php
if ($this->session->userdata('sesPosisi') != 0) 
{
    ?>
    <div class="col-md-12 tour-step tour1" id="main-dashboard">
        <div class="row">
            <?php
            $who_is   = $this->Globalrules->who_is($this->session->userdata('sesUser'));
            $this->load->view('dashboard_component/banner_user_component',array(
                'nama_pegawai' => $nama_pegawai,
                'nama_jabatan' => $nama_jabatan,
                'who_is'       => $who_is));
            $this->load->view('dashboard_component/persentase_speedometer_component');                
            $this->load->view('dashboard_component/member_component');                                
            ?>
            <div class="col-md-5" style="height:50px;max-height: 50px;margin-bottom:1px;">
            
                <div class="widget-user-header bg-white-active text-center">
                    <div class="box-header with-border">
                        <h1 class="box-title"> <font color="blue" size="3">TATA CARA REVIEW & PENYESUAIAN TARGET SKP<a href="<?php echo base_url(); ?>assets_home/slider/TATACARAREVIEW_PENYESUAIANTARGETSKP.pdf">&nbsp&nbsp&nbsp<u>download</a></font></h1>
                    </div>
                
                    
                </div>
                
            </div>    
            <?php
            // $this->load->view('dashboard_component/chart_pencapaian_menit_efektif_component',array('data_value'=>$data_value,'data_bulan'=>$data_bulan));                    
            ?>
        </div>
            
        <?php
        $this->load->view('dashboard_component/common_component',array(
            'class'     => 'col-lg-2 col-xs-8',
            'id'        => 'btn_masih_diproses',
            'color_box' => 'background-color: #d2d6de !important;',
            'icon'      => '',
            'value_php' => (($belum_diperiksa == '') ? 0 : $belum_diperiksa),
            'title'     => 'PEKERJAAN BELUM DIPERIKSA',
            'html'      => ''));
        $this->load->view('dashboard_component/common_component',array(
            'class'     => 'col-lg-2 col-xs-8',
            'id'        => 'btn_realisasi_menit_efektif',
            'color_box' => 'background-color: #d2d6de !important;',
            'icon'      => '',
            'value_php' => (($summary_tr == '') ? 0 : $summary_tr[0]->menit_efektif),
            'title'     => 'REALISASI MENIT KERJA EFEKTIF',
            'html'      => ''));                  
        // $this->load->view('dashboard_component/common_component',array(
            // 'class'     => 'col-lg-3 col-xs-8',
            // 'id'        => 'btn_ip',
            // 'color_box' => 'background-color: #ffffcc !important;',
            // 'icon'      => '',
            // 'value_php' => (($totalip == '') ? 0 : $totalip),
            // 'title'     => 'INDEKS PROFESIONALITAS TAHUN 2022 <br/> (Klik disini untuk mengupdate survey)',
            // 'html'      => ''));     				
        // $this->load->view('dashboard_component/common_component',array(
        //     'class'     => 'col-lg-2 col-xs-8',
        //     'id'        => '',
        //     'color_box' => 'background-color: #d2d6de !important;',
        //     'icon'      => '',
        //     'value_php' => $skp->persentase,
        //     'title'     => 'CAPAIAN SKP',
        //     'html'      => "<label>".$skp->total_realisasi_kuantitas.' / '.$skp->total_target_kuantitas."</label>"));                                        
        $this->load->view('dashboard_component/common_component',array(
            'class'     => 'col-lg-2 col-xs-8',
            'id'        => 'btn_tunjangan',
            'color_box' => 'background-color: #d2d6de !important;',
            'icon'      => '',
            'value_php' => (($summary_tr == '') ? 0 : 'Rp.'.number_format($summary_tr[0]->real_tunjangan,0)),
            'title'     => 'TUNJANGAN',
            'html'      => ''));    
        // $this->load->view('dashboard_component/common_finger',array(
        //     'class'     => 'col-lg-2 col-xs-8',
        //     'id'        => 'btn_fingerprint',
        //     'color_box' => 'background-color: #d2d6de !important;',
        //     'icon'      => '',
        //     'value_php' => $fingerprint,
        //     'title'     => 'FINGERPRINT', 
        //     'html'      => "<label id='total_tunjangan_' />"));
    ?>
    </div>
    <?php
    
    $this->load->view('dashboard_component/bawahan_component');
	$this->load->view('dashboard_component/information_emp_component',array(
        'nama_eselon1'  => $nama_eselon1,
        'nama_eselon2'  => $nama_eselon2,
        'nama_eselon3'  => $nama_eselon3,
        'nama_eselon4'  => $nama_eselon4,
        'nip'           => $nip,
        'kelas_jabatan' => $kelas_jabatan));
        $this->load->view('dashboard_component/common_modal_datatable_component',array(
            'id'           => 'modal-transaksi-proses',
            'header'       => 'Pekerjaan Belum Selesai',
            'id_datatable' => 'get-datatable'));
        
        $this->load->view('dashboard_component/common_modal_datatable_component',array(
            'id'           => 'modal-transaksi-realisasi',
            'header'       => 'Realisasi Menit Kerja Efektif',
            'id_datatable' => 'get-datatable1'));
        
        // $this->load->view('dashboard_component/common_modal_datatable_component',array(
        //     'id'           => 'modal-transaksi-tunjangan',
        //     'header'       => 'TUNJANGAN',
        //     'id_datatable' => 'get-datatable2'));
        
        // $this->load->view('dashboard_component/common_modal_datatable_component',array(
        //     'id'           => 'modal-transaksi-fingerprint',
        //     'header'       => 'FINGERPRINT',
        //     'id_datatable' => 'get-datatable3'));
        // ?>
        <?php                
}
?>

<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/knob/jquery.knob.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jqWidget/js/jqxcore.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jqWidget/js/jqxdraw.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/jqWidget/js/jqxgauge.js"></script>
<script>
    $(document).ready(function()
    {
        $('#gaugeContainer').jqxGauge({
                    ranges: [{ startValue: 0, endValue: 25, style: { fill: '#4bb648', stroke: '#4bb648' }, endWidth: 5, startWidth: 1 },
                            { startValue: 25, endValue: 50, style: { fill: '#fbd109', stroke: '#fbd109' }, endWidth: 10, startWidth: 5 },
                            { startValue: 50, endValue: 75, style: { fill: '#ff8000', stroke: '#ff8000' }, endWidth: 13, startWidth: 10 },
                            { startValue: 75, endValue: 100, style: { fill: '#e02629', stroke: '#e02629' }, endWidth: 16, startWidth: 13 }],
                    ticksMinor: { interval: 1, size: '5%' },
                    ticksMajor: { interval: 5, size: '10%' },
                    value: 0,
                    colorScheme: 'scheme05',
                    animationDuration: 1200,
                    width:200,
                    height:200,
                    max:100,
                });
        $('#gaugeContainer').jqxGauge('value', <?=(($summary_tr == '') ? 0 : $summary_tr[0]->prosentase_menit_efektif);?>);
    })
</script>    
