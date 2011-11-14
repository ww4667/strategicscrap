  <title>[*longtitle*] :: [(site_name)]</title>
  
  <?
  
  $use_ui = $_GET["use_ui"];
  
  ?>

  <base href="[(site_url)]" />

  <meta http-equiv="content-type" CONTENT="text/html; charset=iso-8859-1">
  <meta NAME="Author" CONTENT="Slash/Web Studios in Clive, Iowa" />
  <meta NAME="classification" CONTENT="Commercial">
  <meta NAME="description" CONTENT="[*description*]">
  <meta NAME="distribution" CONTENT="GLOBAL">
  <meta NAME="keywords" CONTENT="[*meta_keywords*]">
  <meta NAME="language" CONTENT="en-us">
  <meta NAME="rating" CONTENT="GENERAL">
  <meta NAME="revisit-after" CONTENT="30 Days">
  <meta NAME="robots" CONTENT="ALL">

  <link href="/resources/css/colorbox.css" rel="stylesheet" type="text/css" />
  <link href="/resources/css/core.css" rel="stylesheet" type="text/css" />
  <link href="/resources/css/mainNav.css" rel="stylesheet" type="text/css" />
  <!-- <link href="/resources/css/jScrollPane.css" rel="stylesheet" type="text/css" /> -->
  <link href="/resources/css/RMSforms-v0.5.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript">
 
  var sw = {"app":{}};
  
	</script>
<script type="text/javascript">var switchTo5x=true;</script><script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher:'144f5866-b3c9-4a80-8f35-4007df29cf59'});</script>
<!--   <link href="/resources/css/jquery-ui-1.8.6.custom.css" rel="stylesheet" type="text/css" />   -->
<!-- css for verticalSlider -->
    <style type="text/css">
		#upgrade_browser_bar {background-color: #fcfdde;	width: 100%; border-top: solid 1px #000; border-bottom: solid 1px #000; text-align: center; padding:5px 0px 5px 0px;}
      #scroll-pane { float:left;overflow: auto; width: 535px; height:300px;position:relative;border:1px solid gray;margin-left:0;margin-bottom:0;display:inline}
      #scroll-content {position:absolute;top:0;left:0}
      .scroll-content-item {background-color:#fcfcfc;color:#003366;width:100px;height:100px;float:left;margin:10px;font-size:3em;line-height:96px;text-align:center;border:1px solid gray;display:inline;}
      #slider-wrap{float:right;background-color:#ccc;width:16px;border:none;}
      #slider-vertical{position:relative;height:100%; width: 16px;}
      .ui-slider-handle{width:16px;height:10px;margin:0 auto;background-color:#0d0d0d;display:block;position:absolute}

      #tabs-equipClass, #tabs-scrapClass {margin: 0; padding: 0;}
	  .classifiedListing ul li {margin-left:0}
    </style>
    
<? if($_SERVER["HTTPS"] != "on") { ?>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" ></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js" type="text/javascript"></script>  
  <!-- <script src="/resources/js/jquery-ui-personalized-1.6rc4.min.js" type="text/javascript"></script> -->
<? } else { ?>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" ></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js" ></script>
  <!--
  <link href="/resources/css/jquery-ui-1.8.6.custom.css" rel="stylesheet" type="text/css" />
  <script src="/resources/js/jquery-ui-personalized-1.6rc4.min.js" type="text/javascript"></script> -->
  <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js"></script>-->
<? } ?>

  <script src="/resources/js/jquery.colorbox-min.js" type="text/javascript"></script>
  <script src="/resources/js/jquery.cookie.js" type="text/javascript"></script>
  <script src="/resources/js/jquery.mousewheel.js" type="text/javascript"></script>
  <script src="/resources/js/jScrollPane.js" type="text/javascript"></script>
  <script src="/resources/js/jquery.dataTables.min.js" type="text/javascript"></script>
  <script src="/resources/js/vertical-slider.js" type="text/javascript"></script>
  <?php if( strpos($_SERVER['REQUEST_URI'],"/regions/") === 0 ){ ?>
  <script src="/resources/js/jquery.tweet.js" type="text/javascript"></script>

  <link href="/resources/css/jquery.tweet.css" rel="stylesheet" type="text/css" />
  <?php } ?>
	<!-- DATE -->
  	<link href="/resources/css/datePicker.css" rel="stylesheet" type="text/css" />
  	<link href="/resources/css/datePicker.popup.css" rel="stylesheet" type="text/css" />
  	
	<script type="text/javascript" src="/resources/js/date.js"></script>
	<script type="text/javascript" src="/resources/js/jquery.datePicker.js"></script>

  [*js_doc_ready*]

<script type="text/javascript">
  	Date.format = 'yyyy/mm/dd';
    $(document).ready(function(){
    $("#social_badges a")
    .addClass("external")
    .click(function(){
      window.open(this.href); // pop a new window
      return false; // return false to keep the actual link click from actuating
    });


 	if($.browser.msie && $.browser.version <= 7 ) {
		$("<div id='upgrade_browser_bar'>You are using an unsupported browser. Please switch to a newer version: <a href='http://getfirefox.com'>FireFox</a>, <a href='http://www.google.com/chrome/'>Chrome</a>, <a href='http://www.apple.com/safari/'>Safari</a> or <a href='http://windows.microsoft.com/en-US/internet-explorer/downloads/ie'>Internet Explorer</a>. Thanks!&nbsp; </div> ").prependTo("body");
    }

 	  <?php if( strpos($_SERVER['REQUEST_URI'],"/region/posters/fixed/") === 0 ){ ?>
 	  <?php } ?>

  });
    

</script>

  <link href="/resources/css/tabs.css" rel="stylesheet" type="text/css" />
  <link rel="shortcut icon" href="/resources/images/favicon.ico" type="icon"/>
  
<!-- google analytics code -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-12450565-23']);
  _gaq.push(['_setDomainName', '.strategicscrap.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>