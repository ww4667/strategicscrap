<style>
	h1{display:none;}
	#tryit_wrapper, #video_wrapper {float:left;}
	#video_wrapper {width:500px}
	#tryit_wrapper {width:310px;margin-left:20px}
	#tryit_wrapper p {padding:0;margin-bottom:1.2em;font-size:1.5em;line-height:1.2em;font-family:Georgia,Serif;color:#555}
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
			<object width="500" height="310"><param name="movie" value="http://www.youtube.com/v/VYYzAmmQ4yI&amp;hl=en_US&amp;fs=1?rel=0&amp;hd=0&amp;autoplay=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><param name="wmode" value="transparent"><embed src="http://www.youtube.com/v/VYYzAmmQ4yI&amp;hl=en_US&amp;fs=1?rel=0&amp;hd=0&amp;autoplay=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="500" height="310" wmode="transparent"></embed></object>
		</div>
	</div>
	<div id="tryit_wrapper" class="content">
	    <p>Boost your profits by tapping into the most powerful and comprehensive tool the scrap  metal industry has ever seen. Pricing, market data, transportation hub and more! <strong style="color:#000">Sign up for your free trial today!</strong></p>
		<div class="form_wrapper">
			<form action="/scrap-registration" method="post">
				<input type="hidden" name="try_it" />
				<ul>
					<li>
						<label>Name</label>
						<input type="text" name="name" />
					</li>
					<li>
						<label>Email</label>
						<input type="text" name="email" />
					</li>
					<li>
						<input class="submit" type="image" src="/resources/images/buttons/try_it.png" alt="try it today!" name="try_submit" />
					</li>
				</ul>
			</form>
			<script type="text/javascript">
				$('#tryit_wrapper input.submit').hover(function(){ 
				       $(this).attr('src', '/resources/images/buttons/try_it_hover.png'); 
				}, function(){ 
				       $(this).attr('src', '/resources/images/buttons/try_it.png'); 
				}); 
			</script>
		</div>
	</div>
	<div style="position:relative;clear:both"><!--clear--></div>
</div>