<style>

.modal{
	/*display: block !important; */
	/* I added this to see the modal, you don't need this */
}

  /* Important part */
.modal-dialog{
	overflow-y: initial !important
}
.modal-body{
	height: 500px;
	overflow-y: auto;
}

#preloader {
    position:fixed;
    top:0;
    left:0;
    right:0;
    bottom:0;
    background-color:#ffffff; /* change if the mask should have another color then white */
    z-index:99; /* makes sure it stays on top */
}

#status {
    width:200px;
    height:200px;
    position:absolute;
    left:50%; /* centers the loading animation horizontally one the screen */
    top:50%; /* centers the loading animation vertically one the screen */
    background-image:url(https://loading.io/spinners/liquid/lg.liquid-fill-preloader.gif); /* path to your loading animation */
    background-repeat:no-repeat;
    background-position:center;
    margin:-100px 0 0 -100px; /* is width and height divided by two */
}

#text_loader {
	color: #FF727D;
    width:600px;
    height:200px;
    position:absolute;
    left:40%; /* centers the loading animation horizontally one the screen */
    top:85%; /* centers the loading animation vertically one the screen */
    background-repeat:no-repeat;
    background-position:center;
    margin:-100px 0 0 -100px; /* is width and height divided by two */
}
</style>

<div id ="preloader">
	<div id ="status"></div>
	<h1 id="text_loader">Mohon Tunggu, Sedang Memuat Data</h1>
</div>
<script type="text/javascript">
$(window).load(function() { // makes sure the whole site is loaded
	$("#status").fadeOut(); // will first fade out the loading animation
	$("#preloader").delay(350).fadeOut("fast"); // will fade out the white DIV that covers the website.
})

</script>