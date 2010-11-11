<div class="header">
	<div id="twitter_badge">
		<a href="http://twitter.com/strategicscrap" title="follow us on twitter">follow us on twitter</a>
	</div>
	<div id="sign_in">
		<? print_r($_SESSION['user']); ?>
		<? if(isset($_SESSION['user']['loggedIn'])) { ?>
		<form action="/scrap-logout" method="post" id="header_sign_in">
			<input class="submit" type="image" src="/resources/images/buttons/sign_in_header.png" name="sign_in_submit" />
		</form>
				<script type="text/javascript">
					$('#header_sign_in input.submit').hover(function(){ 
					       $(this).attr('src', '/resources/images/buttons/sign_in_header_hover.png'); 
					}, function(){ 
					       $(this).attr('src', '/resources/images/buttons/sign_in_header.png'); 
					}); 
				</script>
		<? } else { ?>
		<form action="/scrap-login" method="post" id="header_sign_in">
			<input type="text" name="username" />
			<input type="password" name="password" />
			<input class="submit" type="image" src="/resources/images/buttons/sign_in_header.png" name="sign_in_submit" />
		</form>
				<script type="text/javascript">
					$('#header_sign_in input.submit').hover(function(){ 
					       $(this).attr('src', '/resources/images/buttons/sign_in_header_hover.png'); 
					}, function(){ 
					       $(this).attr('src', '/resources/images/buttons/sign_in_header.png'); 
					}); 
				</script>
		<? } ?>
	</div>
	<div id="register_now">
		<a href="[~1~]"><img src="/resources/images/buttons/register_now.png" alt="Register Now" /></a>
	</div>
	<div class="logo">
		<a href="[~1~]"><img src="/resources/images/strategic_scrap.png" alt="Strategic Scrap" /></a>
	</div>
</div>