<div class="header">
	<div id="twitter_badge">
		<a href="http://twitter.com/strategicscrap" title="follow us on twitter">follow us on twitter</a>
	</div>
	<div id="sign_in">
		<? if(isset($_SESSION['user']['loggedIn'])) { ?>
		<form action="/scrap-logout" method="post" id="header_sign_in">
			<a href="/my-account">My Account</a>
			<input class="submit" type="image" src="/resources/images/buttons/sign_out_header.png" name="sign_in_submit" />
		</form>
				<script type="text/javascript">
					$('#header_sign_in input.submit').hover(function(){ 
					       $(this).attr('src', '/resources/images/buttons/sign_out_header_hover.png'); 
					}, function(){ 
					       $(this).attr('src', '/resources/images/buttons/sign_out_header.png'); 
					}); 
				</script>
		<? } else { ?>
		<form action="/scrap-login" method="post" id="header_sign_in">
			<input type="text" name="username" class="username" />
			<input type="password" name="password" class="password" />
			<input class="submit" type="image" src="/resources/images/buttons/sign_in_header.png" name="sign_in_submit" />
			<? if(isset($_SESSION['sign-in-error'])) { ?>
				<div class="error">wrong username or password</div>
			<? unset($_SESSION['sign-in-error']); 
			} ?>
		</form>
				<script type="text/javascript">
					$('#header_sign_in input.submit').hover(function(){ 
					       $(this).attr('src', '/resources/images/buttons/sign_in_header_hover.png'); 
					}, function(){ 
					       $(this).attr('src', '/resources/images/buttons/sign_in_header.png'); 
					});
					$('#header_sign_in input').focus(function(){
						$(this).css('background','none');
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