<? if( strtolower($_SERVER["HTTP_HOST"]) == "demo.strategicscrap.com" ) { ?>

<style>
	h1{display:none;}
	#tryit_wrapper, #video_wrapper {float:left;}
	#video_wrapper {width:500px}
	#tryit_wrapper {width:310px;margin-left:20px}
	#tryit_wrapper p {padding:0;margin-bottom:1.2em;font-size:1.5em;line-height:1.2em;font-family:Georgia,Serif;color:#555}
	#tryit_wrapper p strong {color:#333}
	#tryit_wrapper p.warning {font-size:1.1em;font-family:Arial,Sans-Serif;color:#555}
	#tryit_wrapper a#try_it_home {display:block;background:url(/resources/images/buttons/try_it.png) no-repeat;width:138px;height:46px;text-indent:-5000px}
	#tryit_wrapper a#try_it_home:hover {background:url(/resources/images/buttons/try_it_hover.png) no-repeat;}

	#video_wrapper .video_container {margin-bottom:20px;}

	#tryit_wrapper form {padding:0;}
	#tryit_wrapper .form_wrapper li {margin-bottom:10px}
	#tryit_wrapper .form_wrapper label {display:block;font-weight:bold}
	#tryit_wrapper .form_wrapper input {width:310px}
	#tryit_wrapper .form_wrapper input.submit {width:138px;margin-top:23px}
</style>
<div style="width:840px;position:relative;">
	<div id="video_wrapper">
		<div class="video_container" style="text-align:center">
			<object width="500" height="310"><param name="movie" value="http://www.youtube.com/v/pqcTGOzW-ak&amp;hl=en_US&amp;fs=1?rel=0&amp;hd=0&amp;autoplay=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><param name="wmode" value="transparent"><embed src="http://www.youtube.com/v/pqcTGOzW-ak&amp;hl=en_US&amp;fs=1?rel=0&amp;hd=0&amp;autoplay=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="500" height="310" wmode="transparent"></embed></object>
		</div>
	</div>
	<div id="tryit_wrapper" class="content">
							[*content*]
	</div>
	<div style="position:relative;clear:both"><!--clear--></div>
</div>

<? } else { ?>


<html> 
<head> 
</head> 
<body style="background:#000; color:#FFF;position:relative"> 
 
<table width="853" align="center"> 
<tr> 
	<td><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p> 
	</td> 
</tr> 
<tr> 
	<td> 
<object width="853" height="505"><param name="movie" value="http://www.youtube.com/v/d9GPP98ywwE&amp;hl=en_US&amp;fs=1&amp;color1=0x3a3a3a&amp;color2=0x999999&amp;autoplay=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/d9GPP98ywwE&hl=en_US&fs=1&color1=0x3a3a3a&color2=0x999999&autoplay=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="853" height="505"></embed></object> 
	</td> 
</tr> 
<tr> 
	<td align="center"> 
		<p style="">&nbsp;</p> 
		<p style="line-height:19px"><span style="font-size:15px">Stop by booth 1025 at ISRI 2011 to sign up for your free trial.</span><br /><a href="mailto:josh@strategicscrap.com">Contact Us</a></p> 
	</td> 
</tr> 
 
</table> 
 
<style> 
p { font-size:12px;font-family:Helvetica, Arial, sans-serif;color:#FFF;width:400px; }
a { color:#FFF }
</style> 
 
</body> 
</html>

<? die(); ?>

<? } ?>
