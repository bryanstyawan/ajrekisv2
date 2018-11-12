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
$base_url = base_url();
?>
<html lang="en" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface no-generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths">
  <head>
    <meta charset="utf-8">
    <meta name="keywords" content="404 page">
    <meta name="description" content="404 - Page Template">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Libs CSS -->
    <link type="text/css" media="all" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template CSS -->
    <link type="text/css" media="all" href="<?php echo base_url(); ?>assets/css/error1/style.css" rel="stylesheet">
    <!-- Responsive CSS -->
    <link type="text/css" media="all" href="<?php echo base_url(); ?>assets/css/error/respons.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(); ?>assets/css/error/img/favicon144x144.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>assets/css/error/img/favicon114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>assets/css/error/img/favicon72x72.png">
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/css/error/img/favicon57x57.png">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/css/error/img/favicon.png">

    <script src="<?php echo base_url(); ?>assets/css/error1/createjs.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/css/error1/dinosaur.js"></script>
    <script>
        var canvas, stage, exportRoot;
        function init() {
            canvas = document.getElementById("canvas");
            handleComplete();
        }
        function handleComplete() {
            //This function is always called, irrespective of the content. You can use the variable "stage" after it is created in token create_stage.
            exportRoot = new lib.dinosaur();
            stage = new createjs.Stage(canvas);
            stage.addChild(exportRoot);
            //Registers the "tick" event listener.
            createjs.Ticker.setFPS(lib.properties.fps);
            createjs.Ticker.addEventListener("tick", stage);
            //Code to support hidpi screens and responsive scaling.
            (function(isResp, respDim, isScale, scaleType) {
                var lastW, lastH, lastS=1;
                window.addEventListener('resize', resizeCanvas);
                resizeCanvas();
                function resizeCanvas() {
                    var w = lib.properties.width, h = lib.properties.height;
                    var iw = window.innerWidth, ih=window.innerHeight;
                    var pRatio = window.devicePixelRatio, xRatio=iw/w, yRatio=ih/h, sRatio=1;
                    if(isResp) {
                        if((respDim=='width'&&lastW==iw) || (respDim=='height'&&lastH==ih)) {
                            sRatio = lastS;
                        }
                        else if(!isScale) {
                            if(iw<w || ih<h)
                                sRatio = Math.min(xRatio, yRatio);
                        }
                        else if(scaleType==1) {
                            sRatio = Math.min(xRatio, yRatio);
                        }
                        else if(scaleType==2) {
                            sRatio = Math.max(xRatio, yRatio);
                        }
                    }
                    canvas.width = w*pRatio*sRatio;
                    canvas.height = h*pRatio*sRatio;
                    canvas.style.width = w*sRatio-15+'px';
                    canvas.style.height = h*sRatio-15+'px';
                    stage.scaleX = pRatio*sRatio;
                    stage.scaleY = pRatio*sRatio;
                    lastW = iw; lastH = ih; lastS = sRatio;
                }
            })(true,'both',false,1);
        }
    </script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,800italic,800,700italic,700,600italic,600,400italic,300" rel="stylesheet" type="text/css">

</head>
<body onload="init();">

    <!-- Load page -->
    <div class="animationload" style="display: none;">
        <div class="loader" style="display: none;">
        </div>
    </div>
    <!-- End load page -->


    <!-- Content Wrapper -->
    <div id="wrapper">
        <div class="container">

            <!-- Dinosaur -->
            <div class="dinosaur">
                <canvas id="canvas" width="656" height="290" style="display: block; width: 685px; height: 295px;"></canvas>
            </div>
            <!-- end Dinosaur -->

            <!-- Info -->
            <div class="info">
                <h2>You have some problems</h2>
                <p>The page you are looking for was moved, removed, renamed or might<br>
                    never existed.</p>
                <a href="<?=base_url();?>" class="btn">Go Home</a>
    
                <p>-------------------------------------------------------------------------------</p>      		
                <p>An uncaught Exception was encountered</p>      	
                <p>Type: <?php echo get_class($exception); ?></p>
                <p>Message: <?php echo $message; ?></p>		      			
                <p>Filename: <?php echo $exception->getFile(); ?></p>		      			
                <p>Line Number: <?php echo $exception->getLine(); ?></p>
                <p>
                  <?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

                    <p>Backtrace:</p>
                    <?php foreach ($exception->getTrace() as $error): ?>

                      <?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

                        <p style="margin-left:10px">
                        File: <?php echo $error['file']; ?><br />
                        Line: <?php echo $error['line']; ?><br />
                        Function: <?php echo $error['function']; ?>
                        </p>
                      <?php endif ?>

                    <?php endforeach ?>

                  <?php endif ?>		
                </p>			

    
            </div>
            <!-- end Info -->

        </div>
        <!-- end container -->
    </div>
    <!-- end Content Wrapper -->

    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>assets/css/error1/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/css/error1/modernizr.custom.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/css/error1/scripts.js" type="text/javascript"></script>


</body></html>