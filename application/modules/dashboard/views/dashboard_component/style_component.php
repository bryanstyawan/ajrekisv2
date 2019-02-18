<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/tabs-checked/css/style_tabs.css'; ?>");</style>
<style>
.icon > i
{
    margin: 0px 0px 0px 25px;
    font-size: 52px;
    color: #fff;
    padding: 19px;
    border-radius: 50%;
}
</style>

<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.bundle.js"></script>
<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/dropzone-work/dropzone.min.css'; ?>");</style>
<style type="text/css">@import url("<?php echo base_url() . 'assets/plugins/dropzone-work/basic.min.css'; ?>");</style>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/dropzone-work/jquery.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/plugins/dropzone-work/dropzone.min.js"></script>
<style>
/* Makes images fully responsive */
#demoWidget{
    margin:auto;
}
.img-responsive,
.thumbnail > img,
.thumbnail a > img,
.carousel-inner > .item > img,
.carousel-inner > .item > a > img {
    display: block;
    width  : 100%;
    height : auto;
}


.label-info-pegawai
{
    margin: 10px 0px;
}
/* ------------------- Carousel Styling ------------------- */

.carousel-inner {
    border-radius: 0px;
    height:300px;
}

.carousel-caption {
    background-color: rgba(0,0,0,.5);
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 10;
    padding: 0 0 10px 25px;
    color: yellow;
    text-align: left;
}

.carousel-indicators {
    position: absolute;
    bottom: 0;
    right: 0;
    left: 0;
    width: 100%;
    z-index: 15;
    margin: 0;
    padding: 0 25px 25px 0;
    text-align: right;
}

.carousel-control.left,
.carousel-control.right {
    background-image: none;
}

.rotate:hover
{
    -webkit-transform: rotateZ(-30deg);
    -ms-transform: rotateZ(-30deg);
    transform: rotateZ(-30deg);
}

.shrink:hover
{
    -webkit-transform: scale(1.1);
    -ms-transform: scale(1.1);
    transform: scale(1.1);
}

/* ------------------- Section Styling - Not needed for carousel styling ------------------- */

.section-white {
    padding: 10px 0;
}

.section-white {
    background-color: #fff;
    color: #555;
}

@media screen and (min-width: 768px) {
    .section-white {
        padding: 1.5em 0;
    }
}

@media screen and (min-width: 992px) {
    .container {
        max-width: 930px;
    }
}
</style>