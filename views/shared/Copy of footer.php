			<div class="footerLinks">
				
				[[Wayfinder? &startId=`0` &firstClass=`first` &level=`1` &includeDocs=`1,2,3,4,5,6` &hereClass=`current`]]
				
				<!--
				<ul>
					<li><a href="1-myhome.html">Home</a></li>
					<li><a href="2-region.html">Regions</a></li>
					<li><a href="3-scrapex.html">Scrap Exchange</a></li>
					<li><a href="4-tranmat.html">Transport Material</a></li>
					<li><a href="5-scrapclass.html">Scrap Classifieds</a></li>
					<li><a href="6-equipclass.html">Equipment Classifieds</a></li>
				</ul>
				-->
				
				[[Wayfinder? &startId=`0` &firstClass=`first` &level=`1` &includeDocs=`12,13,14,15,16` &hereClass=`current`]]
				
				<!--
				<ul>
					<li><a href="#">Contact Us</a></li>
					<li><a href="#">Advertising Opportunities</a></li>
					<li><a href="#">ISRI Specifications</a></li>
					<li><a href="#">Terms and Conditions</a></li>
					<li><a href="#">Privacy Policy</a></li>
				</ul>
				-->
				
			</div>
			<div class="footerLogos">
				<a href="http://www.cmegroup.com" target="_blank"><img src="resources/images/logo_CME.png" alt="CME Group" /></a>
				<a href="http://www.lme.com" target="_blank"><img src="resources/images/logo_LME.png" alt="London Metal Exchange" /></a>
				<a href="http://www.isri.org" target="_blank"><img src="resources/images/logo_ISRI.png" alt="ISRI Member" /></a>
			</div>
			
	<script type="text/javascript"> 
		$(document).ready(function(){
			if ($.cookie("splash_video") != "displayed" && "[*id*]" != "1") {
				setTimeout(function(){
					$.fn.colorbox({
						href:"http://www.youtube.com/v/VYYzAmmQ4yI&hl=en_US&fs=1&rel=0&border=1&autoplay=1",innerWidth:425, innerHeight:344, iframe:true,
						onOpen:function(){ 
							$.cookie("splash_video", "displayed", { path: '/', expires: 3000 });
						}
					});
				}, 2000); // delay popup for 5 seconds (in milliseconds)
			} else if("[*id*]" == "1") {
				$.cookie("splash_video", "displayed", { path: '/', expires: -3000 });
			}
		});
	</script>