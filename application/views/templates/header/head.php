<style type="text/css">
	.navbar-custom-menu>.navbar-nav>li>a
	{
		margin-top: 11px;
		margin-bottom: 11px;
	}

	.navbar-nav>.notifications-menu>.dropdown-menu>li .menu>li>a:hover, .navbar-nav>.messages-menu>.dropdown-menu>li .menu>li>a:hover, .navbar-nav>.tasks-menu>.dropdown-menu>li .menu>li>a:hover,
	.navbar-custom-menu>.navbar-nav>li:hover,
	.dropdown-menu > .menu_header:hover
	{
		background-color: #0163D0!important;
	}

	.dropdown-menu > .menu_header > li > a > i,
	.dropdown-menu > .menu_header > li > a > span
	{
		color: #fff;
	}

	.dropdown-menu > .menu_header
	{
		background-color: #00BCD4!important;
		list-style: none;
	}

	.dropdown-menu > li
	{
		background-color: #00BCD4!important
	}

	.dropdown-menu > .header
	{
		background-color: #fff!important;
	}

	.noti-container
	{
		background-color: #fff;
		border-radius: 5px;
		box-shadow: 0 3px 8px #222;
		overflow: visible;
		position: absolute;
		margin-left: -345px;
		width: 550px;
		color: #444;
		z-index: 2;
		display: none;
		height:auto;
		&:before
		{
			content: "";
			display: block;
			position: absolute;
			width: 0;
			height: 0;
			color: transparent;
			border: 10px solid #000;
			border-color: transparent transparent #fff;
			margin-top: -20px;
			margin-left: 115px;
		}
	}

	.noti-title
	{
		/*display: none;*/
		width: 100%;
		padding: 5%;
		margin-left: auto;
		margin-right: auto;
		border-bottom: 2px solid #ddd;
		position: relative;
		z-index: 100;
	}

	.new-noti-title
	{
		font: 13px bold "Helvetica Neue", Helvetica, Arial, sans-serif;
		text-align: center;
		line-height: 30px;
	}

	.noti-count
	{
		&:extend(.noti-count-extend);
		width: 20px;
		height: 20px;
		border-radius: 10px;
		font-size: 10px;
		line-height: 20px;
		margin-left: 5px;
		margin-top: 5px;
	}

	.noti-body
	{
		list-style-type: none;
		margin: 0;
		padding: 0;
		max-height: 220px;
		overflow: auto;
	}

	.noti-text
	{
		padding-top: 9px!important;
		padding-bottom: 41px!important;
		display: block;
		cursor: pointer;
		width: 98%;
		padding: 5%;
		/*line-height: 53px;*/
		background-color: #e9eff2;
		border-bottom: 1px solid #ddd;
		&.has-read {
			background-color: #fff;
		}
	}

	.noti-text > a
	{
		position: initial;
		padding-top: 30px;
		padding-bottom: 5px;
	}

	.noti-footer {
		cursor: pointer;
		text-align: center;
		font: 13px bold "Helvetica Neue", Helvetica, Arial, sans-serif;
		padding: 8px;
		border-top: 2px solid #ddd;
	}

</style>
<script>
	window.onload = function() {
		var oid    = getCookie("row_inbox");
		if (oid != 0)
		{
			document.getElementById("messages-notify").innerHTML = oid;
		}
	}
	
	$(document).ready(function() {
		var self          = this;
		var notiTabOpened = false;
		var notiCount     = window.localStorage.getItem('notiCount');
		if(parseInt(notiCount, 10) > 0) {
			var nodeItems =  window.localStorage.getItem('nodeItems');
			$('.noti-count').html(notiCount);
			$('#nav-noti-count').css('display', 'inline-block');
		}

		$('#noti-tab').click(function() {
			notiTabOpened = true;
			if(notiCount) {
				$('#nav-noti-count').fadeOut('slow');
				$('.noti-title').css('display', 'inline-block');
			}
			$('.noti-container').toggle(300);
			return false;
		});

		$('#box-container').click(function() {
			$('.noti-container').hide();
			notiTabOpened = false;
		});

		$('.noti-container').click(function(evt) {
			evt.stopPropagation();
			return false;
		});

		$('.noti-body .noti-text').on('click', function(evt) {
			addClickListener(evt);
		});

		var addClickListener = function(evt) {
			evt.stopPropagation();
		}

		$('.noti-footer').click(function() {
			notiCount = 0;
			window.localStorage.setItem('notiCount', notiCount);
			$('.noti-title').hide();
			$('.noti-text').addClass('has-read');
		});
	});

	function goto_link(params) {
		window.location.href = "<?=base_url();?>"+params;
	}
</script>