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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Libs CSS -->
    <link type="text/css" media="all" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template CSS -->
    <link type="text/css" media="all" href="<?php echo base_url(); ?>assets/css/error/style.css" rel="stylesheet">
    <!-- Responsive CSS -->
    <link type="text/css" media="all" href="<?php echo base_url(); ?>assets/css/error/respons.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(); ?>assets/css/error/img/favicon144x144.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>assets/css/error/img/favicon114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>assets/css/error/img/favicon72x72.png">
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/css/error/img/favicon57x57.png">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/css/error/img/favicon.png">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,800italic,800,700italic,700,600italic,600,400italic,300" rel="stylesheet" type="text/css">
    <style>
      .container > .error_php > p
      {
          color     : #fff;
          text-align: center;
      }
    </style>
</head>
<body style="background-color: #232a4b;">

    <!-- Load page -->
    <div class="animationload" style="display: none;">
        <div class="loader" style="display: none;">
        </div>
    </div>
    <!-- End load page -->


    <!-- Content Wrapper -->
    <div id="wrapper" style="background-color: #F44336;">
        <div class="container">
          <div class="error_php" style="display:none">
            <p>-------------------------------------------------------------------------------</p>      		
            <p>A PHP Error was encountered</p>      	
            <p>Severity: <?php echo $severity; ?></p>
            <p>Message:  <?php echo $message; ?></p>		      			
            <p>Filename: <?php echo $filepath; ?></p>		      			
            <p>Line Number: <?php echo $line; ?></p>
            <p>
                <?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

                    <p>Backtrace:</p>
                    <?php foreach (debug_backtrace() as $error): ?>

                        <?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

                            <p style="margin-left:10px">
                            File: <?php echo $error['file'] ?><br />
                            Line: <?php echo $error['line'] ?><br />
                            Function: <?php echo $error['function'] ?>
                            </p>

                        <?php endif ?>

                    <?php endforeach ?>

                <?php endif ?>			
              </p>						      						
            </div>
            <!-- brick of wall -->
            <div class="brick"></div>                                         
            <!-- end brick of wall -->

            <!-- Number -->
            <div class="number">
                <div class="info col-lg-12 text-center" style="margin-left:0px">
                    <h2>Something is wrong</h2>
                </div>              
                <div class="wall-brick"></div>
            </div>
            <!-- end Number -->

            <!-- Info -->
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