<div class="col-md-12 tour-step tour1" id="main-dashboard">
<?php
        $this->load->view('dashboard_component/common_component',array(
            'class'     => 'col-lg-3 col-xs-3',
            'id'        => 'btn_masih_diproses',
            'color_box' => 'background-color: #d2d6de !important;',
            'icon'      => '',
            'value_php' => $baru,
            'title'     => 'REQUEST MASUK',
            'html'      => ''));

        $this->load->view('dashboard_component/common_component',array(
            'class'     => 'col-lg-3 col-xs-3',
            'id'        => 'btn_masih_diproses',
            'color_box' => 'background-color: #d2d6de !important;',
            'icon'      => '',
            'value_php' => $proses,
            'title'     => 'REVISI',
            'html'      => ''));        

        $this->load->view('dashboard_component/common_component',array(
            'class'     => 'col-lg-3 col-xs-3',
            'id'        => 'btn_masih_diproses',
            'color_box' => 'background-color: #d2d6de !important;',
            'icon'      => '',
            'value_php' => $verifikasi,
            'title'     => 'BUTUH VERIFIKASI',
            'html'      => ''));
            
            $this->load->view('dashboard_component/common_component',array(
                'class'     => 'col-lg-3 col-xs-3',
                'id'        => 'btn_masih_diproses',
                'color_box' => 'background-color: #d2d6de !important;',
                'icon'      => '',
                'value_php' => $selesai,
                'title'     => 'TELAH SELESAI',
                'html'      => ''));            
?>
</div>