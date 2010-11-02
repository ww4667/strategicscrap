<style>
	h1{display:none;}
	#coffee_wrapper, #video_wrapper {float:left;}
	#coffee_wrapper {position:relative;right:-105px;background:url(resources/images/coffee_cup.png) no-repeat top right;width:500px;height:555px;float:right;margin-bottom:-20px}
	#video_wrapper {position:absolute;width:420px}
	#video_wrapper p {padding:0 10px;margin-bottom:1.2em;margin-right:20px;font-size:1.5em;line-height:1.2em;font-family:Georgia,Serif;color:#555}
	#video_wrapper .video_container {margin-bottom:20px;}
	#video_wrapper a#sign_up_home {display:block;background:url(/resources/images/buttons/sign_up_home.png) no-repeat;width:138px;height:46px;text-indent:-5000px}
	#video_wrapper a#sign_up_home:hover {background-position:0 -46px}
	#coffee_wrapper .content {position:relative;top:180px;width:280px;margin:0 auto}
	#coffee_wrapper .content h3 {color:#FFF;font-size:35px;line-height:30px;margin-bottom:10px}
	#coffee_wrapper .content p {font-size:10px;padding:0}
	#coffee_wrapper form {padding:0;}
	#coffee_wrapper .form_wrapper li {margin-bottom:10px}
	#coffee_wrapper .form_wrapper label {display:block;font-weight:bold}
	#coffee_wrapper .form_wrapper input {width:270px}
	#coffee_wrapper .form_wrapper input.submit {width:138px;margin-top:40px}
</style>
<div style="width:800px;position:relative;">
	<div id="video_wrapper">
	    <p>For less than the cost of your morning cup of coffee you can boost your profits by tapping into the most powerful and comprehensive tool the scrap  metal industry has ever seen.</p>
		<p>Pricing, market data, transportation hub and more! Check out our demo video below for an in depth look.</p>
		<div class="video_container" style="text-align:center">
			<object width="420" height="261"><param name="movie" value="http://www.youtube.com/v/VYYzAmmQ4yI&amp;hl=en_US&amp;fs=1?rel=0&amp;hd=0&amp;autoplay=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/VYYzAmmQ4yI&amp;hl=en_US&amp;fs=1?rel=0&amp;hd=0&amp;autoplay=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="420" height="261"></embed></object>
		</div>
		<p><a href="#" id="sign_up_home" title="sign up today!">sign up</a></p>
	</div>
	<div id="coffee_wrapper">
		<div class="content">
			<h3>SIGN UP HERE<br />FOR YOUR<br />FREE SAMPLE.</h3>
			<p class="warning">WARNING: Consumption of this product, may lead to less headaches, competetive advantage and increased profits. This product also contains features that may be addictive.</p>
			<br />
			<div class="form_wrapper">
				<form action="" method="post">
					<ul>
						<li>
							<label>Name</label>
							<input type="text" name="try_name" />
						</li>
						<li>
							<label>Email</label>
							<input type="text" name="try_email" />
						</li>
						<li>
							<input class="submit" type="image" src="/resources/images/buttons/try_it.png" alt="try it today!" name="try_submit" />
						</li>
					</ul>
				</form>
				<script type="text/javascript">
					$('#coffee_wrapper input.submit').hover(function(){ 
					       $(this).attr('src', '/resources/images/buttons/try_it_hover.png'); 
					}, function(){ 
					       $(this).attr('src', '/resources/images/buttons/try_it.png'); 
					}); 
				</script>
			</div>
		</div>
	</div>
	<div style="position:relative;clear:both"><!--clear--></div>
</div>