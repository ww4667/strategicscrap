	<title>[*longtitle*] :: [(site_name)]</title>
	
	<base href="[(site_url)]" />
	
	<meta http-equiv="content-type" CONTENT="text/html; charset=iso-8859-1">
	<meta NAME="Author" CONTENT="Slash/Web Studios in Clive, Iowa" />
	<meta NAME="classification" CONTENT="Commercial">
	<meta NAME="description" CONTENT="Strategic Scrap provides the first and only comprehensive web-based solution for the scrap metal industry.">
	<meta NAME="distribution" CONTENT="GLOBAL">
	<meta NAME="keywords" CONTENT="scrap metal, exchange, buy scrap, sell scrap, mills, foundries">
	<meta NAME="language" CONTENT="en-us">
	<meta NAME="rating" CONTENT="GENERAL">
	<meta NAME="revisit-after" CONTENT="30 Days">
	<meta NAME="robots" CONTENT="ALL">
	
	<link href="/resources/css/core.css" rel="stylesheet" type="text/css" />
	<link href="/resources/css/mainNav.css" rel="stylesheet" type="text/css" />
	<link href="/resources/css/jScrollPane.css" rel="stylesheet" type="text/css" />
	<link href="/resources/css/colorbox.css" rel="stylesheet" type="text/css" />
	<link href="/resources/css/RMSforms-v0.5.css" rel="stylesheet" type="text/css" />
	
<? if($_SERVER["HTTPS"] != "on") { ?>
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js' ></script>
<? } else { ?>
	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js' ></script>
<? } ?>
	<script src="/resources/js/jquery.colorbox-min.js" type="text/javascript"></script>
	<script src="/resources/js/jquery.cookie.js" type="text/javascript"></script>
	<script src="/resources/js/jquery-ui-personalized-1.6rc4.min.js" type="text/javascript"></script>
	<script src="/resources/js/jquery.mousewheel.js" type="text/javascript"></script>
	<script src="/resources/js/jScrollPane.js" type="text/javascript"></script>
	
	[*js_doc_ready*]
	
<script type="text/javascript">
    $(document).ready(function(){
		$("#twitter_badge a")
		.addClass("external")
		.click(function(){
			window.open(this.href); // pop a new window
			return false; // return false to keep the actual link click from actuating
		});
	});
</script>
	
	<link href="/resources/css/tabs.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="/resources/images/favicon.ico" type="icon"/>