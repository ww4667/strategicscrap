<div class="header">
	<div id="twitter_badge">
		<a href="http://twitter.com/strategicscrap" title="follow us on twitter">follow us on twitter</a>
	</div>
	<div id="sign_in">
		<? if(isset($_SESSION['user']['loggedIn'])) { ?>
		<div>Logged in as <?=$_SESSION['user']['username']?></div>
		<form action="/scrap-logout" method="post" id="header_sign_in">
			<? if( isset($_SESSION['user']['group']) && $_SESSION['user']['group'] == "scrapper" ) { ?>
				<a id="unread-bids" href="/my-account" style="display:none"><span id="bid-number"></span> Unread Bids</a>
			<? } ?>
			<? if ($_SESSION['user']['group'] == 'broker') { ?>
			<a href="/broker-admin">Broker Dashboard</a>
			<? } ?>
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
		<a href="/scrap-registration" class="sign_up"><img src="/resources/images/buttons/sign_up_header.png" alt="Sign up today!" /></a>
		<form action="/scrap-login" method="post" id="header_sign_in">
			<input type="text" name="username" class="username" />
			<input type="password" name="password" class="password" />
			<input class="submit" type="image" src="/resources/images/buttons/sign_in_header.png" name="sign_in_submit" />
				<? if(isset($_SESSION['sign-in-error'])) { ?>
				<div class="error">wrong username or password, <span class="forgot_password_link" style="cursor: pointer; font-weight: bold;">forgot password?</span></div>
				<div style="display: none;">
					<div id="forgot_password" style="background: #fff; height: 190px; padding: 10px;">
						<h2>Forgot Password?</h2>
						<hr />
						<div id="forgot_password_form" style = "margin: 10px 0;">
						<p style="margin-bottom: 8xp;">Please enter your email address below and click send, and we will send you instructions to reset your password.</p>
							<form method='post' action=''>
								<label style = "width: 50px; float: left; font-weight: bold; line-height: 28px;">Email: </label>
								<input type='text' name ='email' id="forgot_password_email" style="width: 200px; padding: 2px; margin: 4px;"	/><br />
								<div style = "text-align: center;">
									<img src = "/resources/images/buttons/send.png" alt='Send Instructions' id="forgot_password_button" style="cursor: pointer;" />
								</div>
							</form>
						<hr />
						</div>
						<div id="forgot_password_content" style = "font-weight: bold;">
						</div>
						<div id = "forgot_password_loading" style = "display: none;text-align: center;">
							<img src = "/resources/images/buttons/working.png" />
						</div>
					</div>
				</div>
				<script>
				$('document').ready(function(){
					$('.forgot_password_link').colorbox({width:"400px", height: "240px", inline:true, href:"#forgot_password"});					
					$('#forgot_password_button').click(function(){
					
				    	$('#forgot_password_loading').css({"display" : "block"});
				    	$('#forgot_password_form').css({"display" : "none"});
						    	
						email = $('#forgot_password_email').val();
					
						$.ajax({
						  url: '/controllers/remote/?method=forgotPassword&email=' + email ,
						  dataType: 'json',
						  success: function(data) {						  
						  	json = data.result;
						    if ( (json.status * 1) > 0){
						    	$('#forgot_password_form').css({"display" : "none"});
							    $('#forgot_password_content').css({"display" : "block"});
						    	$('#forgot_password_loading').css({"display" : "none"});
							    $('#forgot_password_content').html(json.message);
							    $('#forgot_password_content').removeClass("bad");
							} else {
						    	$('#forgot_password_form').css({"display" : "block"});
						    	$('#forgot_password_loading').css({"display" : "none"});
							    $('#forgot_password_content').addClass("bad");
							    $('#forgot_password_content').html(json.message);
							}
						  }
						});
					});
				});
				</script>
			<? unset($_SESSION['sign-in-error']); 
			} ?>
		</form>
				<script type="text/javascript">
					$('#header_sign_in input.submit').hover(function(){ 
					       $(this).attr('src', '/resources/images/buttons/sign_in_header_hover.png'); 
					}, function(){ 
					       $(this).attr('src', '/resources/images/buttons/sign_in_header.png'); 
					});
					$('#sign_in .sign_up img').hover(function(){ 
					       $(this).attr('src', '/resources/images/buttons/sign_up_header_hover.png'); 
					}, function(){ 
					       $(this).attr('src', '/resources/images/buttons/sign_up_header.png'); 
					});
					$('#header_sign_in input').focus(function(){
						$(this).addClass('focus');
					}).blur(function(){
						if($(this).val() == "")
							$(this).removeClass('focus');
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