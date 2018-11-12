<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('base_url')) {
  function base_url($atRoot=FALSE, $atCore=FALSE, $parse=FALSE){
      if (isset($_SERVER['HTTP_HOST'])) {
          $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
          $hostname = $_SERVER['HTTP_HOST'];
          $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
          $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
          $core = $core[0];
          $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
          $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
          $base_url = sprintf( $tmplt, $http, $hostname, $end );
      }
      else $base_url = 'http://localhost/';
      if ($parse) {
          $base_url = parse_url($base_url);
          if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
      }
      return $base_url;
  }
}
$base_url      = base_url();
$random_number = rand(10,100);
?>
<html lang="en" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface no-generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths"><head>
    <meta charset="utf-8">
    <title>404</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Libs CSS -->
    <link type="text/css" media="all" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template CSS -->
    <link type="text/css" media="all" href="<?php echo base_url(); ?>assets/css/error/style.css" rel="stylesheet">
    <!-- Responsive CSS -->
    <link type="text/css" media="all" href="<?php echo base_url(); ?>assets/css/error/respons.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(); ?>assets/img/favicons/favicon144x144.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>assets/img/favicons/favicon114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>assets/img/favicons/favicon72x72.png">
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/img/favicons/favicon57x57.png">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicons/favicon.png">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,800italic,800,700italic,700,600italic,600,400italic,300" rel="stylesheet" type="text/css">

</head>
<body>

    <!-- Load page -->
    <div class="animationload" style="display: none;">
        <div class="loader" style="display: none;">
        </div>
    </div>
    <!-- End load page -->


    <!-- Content Wrapper -->
    <div id="wrapper">
        <div class="container">

            <!-- brick of wall -->
            <div class="brick"></div>
            <!-- end brick of wall -->

            <!-- Number -->
            <div class="number">
                <div class="four"></div>
                <div class="zero">
                    <div class="nail"></div>
                </div>
                <div class="four"></div>
            </div>
            <!-- end Number -->

            <!-- Info -->
            <div class="info">
                <h2>Something is wrong</h2>
                <p>The page you are looking for was moved, removed, renamed or might never existed.</p>
                <a href="#" class="btn">Go Home</a>
            </div>
            <!-- end Info -->

        </div>
        <!-- end container -->
    </div>
    <!-- end Content Wrapper -->

    <!-- Footer -->
    <footer id="footer">
        <div class="container">
            <!-- Worker -->
            <div class="worker"></div>
            <!-- Tools -->
            <div class="tools"></div>
        </div>
        <!-- end container -->
    </footer>
    <!-- end Footer -->

    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>assets/css/error1/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/css/error1/modernizr.custom.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/css/error1/scripts.js" type="text/javascript"></script>


</body></html>