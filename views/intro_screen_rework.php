 <!-- include this plugin --> 
<script type="text/javascript" src="/resources/js/jgfeed/jquery.jgfeed-min.js"></script> 
<script type="text/javascript" src="/resources/js/carousel.js"></script> 
<style type="text/css">
.gfc-resultsHeader				{display:none}
.gf-result						{padding:5px;margin-bottom:10px;color:#999;}
.gf-result .gf-title			{height:auto;}
.gf-title a,.gf-title a:visited	{font-weight:bold;color:#000;display:block;}
.gf-title a:hover				{font-weight:bold;color:#F96C14;display:block;}

#twitterFeed .gf-snippet 		{display:none}


</style>

<script type="text/javascript">
var sws = {};
	$(document).ready(function() {

		jQuery.jGFeed('http://feeds.feedburner.com/StrategicScrapRssBusinessNews',
		function(feeds){
		  // Check for errors
		  if(!feeds){
		    // there was an error
		    return false;
		  }
		  // do whatever you want with feeds here
		  for(var i=0; i<feeds.entries.length; i++){
		    var entry = feeds.entries[i];
		    // Entry title
		    jQuery("#latestNews #content2").append("<div class='gf-result'><div class='gf-title'><a href='" + entry.link+ " '>" + entry.title + "</a></div><div class='gf-author'>by " + entry.author + "</div><div class='gf-relativePublishedDate'>" + new Date(entry.publishedDate) + "</div><div class='gf-snippet'>" + entry.contentSnippet + "</div></div>");
		  }
		
		        sw.businessNewsSlider = new sw.app.verticalSlider('#tab2', '#pane2','#content2',{overflow: "hidden", float: "left", height: "656px", width: "245px"}, {position: "relative"} );
		
		jQuery("#latestNews #content2 a").addClass("external").click(function(){
		window.open(this.href); // pop a new window
		return false; // return false to keep the actual link click from actuating
		});
		}, 10);
		
		jQuery.jGFeed('http://feeds.feedburner.com/StrategicScrapRssMetalNews',
		function(feeds){
		  // Check for errors
		  if(!feeds){
		    // there was an error
		    return false;
		  }
		  // do whatever you want with feeds here
		  for(var i=0; i<feeds.entries.length; i++){
		    var entry = feeds.entries[i];
		    // Entry title
		    jQuery("#latestNews #content1").append("<div class='gf-result'><div class='gf-title'><a href='" + entry.link+ " '>" + entry.title + "</a></div><div class='gf-author'>by " + entry.author + "</div><div class='gf-relativePublishedDate'>" + new Date(entry.publishedDate) + "</div><div class='gf-snippet'>" + entry.contentSnippet + "</div></div>");
		  }
		
		        sw.scrapNewsSlider    = new sw.app.verticalSlider('#tab1', '#pane1','#content1',{overflow: "hidden", float: "left", height: "656px", width: "245px"}, {position: "relative"} );
		
		jQuery("#latestNews #content1 a").addClass("external").click(function(){
		window.open(this.href); // pop a new window
		return false; // return false to keep the actual link click from actuating
		});
		}, 10);
		
		jQuery.jGFeed('https://strategicscrap.com/feed-links/twit?' + Number(new Date()),
		function(feeds){
		  // Check for errors
		  if(!feeds){
		    // there was an error
		    return false;
		  }
		  // do whatever you want with feeds here
		  for(var i=0; i<feeds.entries.length; i++){
		    var entry = feeds.entries[i];
		    // Entry title
		    jQuery("#twitterFeed").append("<div class='gf-result'><div class='gf-title'><a href='" + entry.link+ " '>" + entry.title + "</a></div><div class='gf-relativePublishedDate'>" + new Date(entry.publishedDate) + "</div></div>");
		  }
		
		sw.twitterFeedSlider  = new sw.app.verticalSlider('#twitter-wrapper', '#twitter-pane','#twitterFeed',{overflow: "hidden", float: "left", height: "268px"}, {position: "relative", width: "255px"} );
		
		jQuery("#twitterFeed a").addClass("external").click(function(){
		window.open(this.href); // pop a new window
		return false; // return false to keep the actual link click from actuating
		});
		}, 5);
		
		sw.regionalMarketDataSlider = new sw.app.verticalSlider('#marketData-wrapper', '#marketData-pane', '#marketData-content', {overflow: "hidden", float: "left", height: "403px"}, {position: "relative", width: "255px"} );
	
		$("#slides").carousel();
		$("#slides_news").carousel({slides: 'slide_news', next: '#next_news', previous: '#prev_news', style: 'slide'});
		
	});
	 
</script>


<div class="leftCol">
	<div id="carousel">
   
	    <div class="clear"></div>
	 
	    <div>
	        <ul id="slides">
	        	[[Ditto? &parents=`224`&orderBy=`menuindex ASC` &display=`5` &total=`5` &tpl=`hp_image_carousel_item`]]
	        </ul>
	        <div class="clear"></div>
	    </div>
	    <div id="buttons" style = "display: none;">
	        <a href="#" id="prev">prev</a>
	        <a href="#" id="next">next</a>
	        <div class="clear"></div>
	    </div> 
	 
	</div>
	<div class="lowerArea">
		<div id="marketData" class="twoColMod" style="position:relative; margin-top:20px;"><div class="moduleTop"><!-- IE hates empty elements --></div>
			<div class="moduleContent">
				<h3>Market Data</h3>
				<div class="updated-timestamp">Updated: <?=$market_data_timestamp?></div>
				<div class="more">
					<a href = "<?= isset($_SESSION["user"]["homepage"]) ? $_SESSION["user"]["homepage"] : "/regions/central"?>">Click here for live data</a>
				</div>
				<hr style="margin-bottom:0" />
				<table>
				<tr class="row2">
				    <th>USD/LB</th>
				    <th>CASH</th>
				    <th>3 MONTH</th>
				    <th>15 MONTH</th>
				    <!-- <th></th> -->
				</tr>
				<?
				$i=0;
				if(!empty($market_data)){
					foreach ($market_data as $lbl => $val) {
					?>
					<tr<?=$i%2?' class="row2"':""?>>
					    <td><?=$lbl?></td>
					    <td><?=$val['cash']?></td>
					    <td><?=$val['3 month']?></td>
					    <td><?=$val['15 month']?></td>
					    <!-- <td>History</td> -->
					</tr>
					<?
					$i++;
					}
				} else {
				?>
					<tr><td colspan = "4" style ="padding-top: 80px; text-align: center;">There was an error loading the data</td></tr>
				<?
				}
				?>
				</table>
			</div>
			<div class="moduleBottom"><!-- IE hates empty elements --></div>	
		</div>
		
		<div id="live_news_ticker_container" class="twoColMod" style="position:relative; margin-top:20px;"><div class="moduleTop"><!-- IE hates empty elements --></div>
			<div class="moduleContent">
				<h3>LIVE NEWS</h3>
				<hr style="margin-bottom:0" />
				
	        <ul id="slides_news">
	        	[[Ditto? &parents=`225`&orderBy=`menuindex ASC` &display=`1000` &total=`1000` &tpl=`hp_news_carousel_item`]]
	        </ul>
	    <div id="buttons_news" style = "">
	        <a href="#" id="prev_news">prev</a>
	        <a href="#" id="next_news">next</a>
	        <div class="clear"></div>
	    </div> 
	        <div class="clear"></div>
			</div>
			<div class="moduleBottom"><!-- IE hates empty elements --></div>	
		</div>
		
		
		<div id="blog_listing_container" class="twoColMod" style="position:relative;">
			<!-- <div class = "blog_row">
				<div class = "blog_category">LAST WEEK IN REVIEW</div>
				<div class = "blog_title">Diesel Costs Affecting Bottom Line</div>
				<div class = "blog_by_line">by tberezowsky an September 22nd, 2011</div>
				<div class = "blog_content">Broker pricing for Central and West Regions added today!  Broker pricing for Central and West Regions added today!  
					Broker pricing for Central and West Regions added today!  Broker pricing for Central and West Regions added today!  Broker pricing for Central and West Regions added today!...
					<a href = "">MORE ></a>
				</div>
			</div> -->
			<div class = "blog_row">
				[[Ditto? &parents=`227`&orderBy=`pub_date DESC` &display=`1` &tpl=`blog_feed_row`]]
			</div>
			<div class = "blog_row">
				[[Ditto? &parents=`279`&orderBy=`pub_date DESC` &display=`1` &tpl=`blog_feed_row`]]
			</div>
			<div class = "blog_row">
				[[Ditto? &parents=`281`&orderBy=`pub_date DESC` &display=`1` &tpl=`blog_feed_row`]]
			</div>
<?php /*
			<div class = "blog_row">
				[[Ditto? &parents=`281`&orderBy=`menuindex ASC` &start=`1` &display=`1` &total=`1` &tpl=`blog_feed_row`]]
			</div>
*/?>
			<div class = "blog_row">
				[[Ditto? &parents=`284`&orderBy=`pub_date DESC` &display=`1` &tpl=`blog_feed_row`]]
			</div>
			
		</div>
		
	</div>
	
</div>
<div class="rightCol">
	<span id ="activate_walkthrough" class = "first_time_here"><!--  --></span>
	<a href = "/scrap-registration" class = "free_30_day_trial"><!--  --></a>
	<br class = "clear"/>
	<div id="latestNews" class="oneColMod"><div class="moduleTop"><!-- IE hates empty elements --></div>
		<div class="moduleContent clearfix">
		<h3>Latest News</h3>
		<hr />
	  	<ul id="tabs-news">
			<li><a href="#tab1"><span>Scrap</span></a></li>
			<li><a href="#tab2"><span>Business</span></a></li>
		</ul>
		<div class="tabBox">
			<div id="tab1">
			 <div id="pane1" style = "position: relative;">
				 <div id="content1">
				  <!-- IE hates empty elements -->
			   </div>
			 </div>
			</div>
			<div id="tab2">
				<div id="pane2" style = "position: relative;">
					<div id="content2">
						<!-- IE hates empty elements -->
					</div>
				</div>
			</div>
		</div>
	</div><div class="moduleBottom"><!-- IE hates empty elements --></div>
	</div>
	{{intro_66_33_AdBlock}}
</div>
<div class = "hide">
	<div id ="scrap_walkthrough">
		<div id ="walkthrough_choices">
		<h3>Tell us who you are to see how StrategicScrap.com can work for you.</h3>
		<br /><br />
		<p style="font-size: 300%">I'm a...</p>
		<br /><br />
<!--		Build group buttons         -->
		[[Ditto? &parents=`229`&orderBy=`menuindex ASC` &display=`12` &total=`12` &tpl=`hp_walkthrough_group_buttons`]]
			<br style="clear: both;" />
		</div>
<!--		Build page groups         -->
		[[Ditto? &parents=`229`&orderBy=`menuindex ASC` &display=`12` &total=`12` &tpl=`hp_walkthrough_group`]]
		<div id="walkthrough_controls" class = "hide">
			<span id = "walkthrough_prev">Previous</span>
			<span id = "walkthrough_next">Next</span>
		</div>
		<br class = "clear"/>
	</div>
</div>
<script type="text/javascript">
	sw.walkthrough = {};
	sw.walkthrough.current_page = 0;
	
	$('document').ready(function(){
        $('#latestNews').tabs();
        
        $("#activate_walkthrough").click(function(){
//        	$.colorbox({width:"705px", height:"536px", inline:true, href:"#scrap_walkthrough"});
			reset_walkthrough();
        	$.colorbox({width:"725px", inline:true, href:"#scrap_walkthrough"});
        })
        
        
        $(".walkthrough_choice").click(function(){
        	el = $(this);
        	el.parent().hide();
    		$("#walkthrough_prev").hide();
        	sw.walkthrough.selected = el.attr("data-type");
        	//console.log(sw.walkthrough.selected);
        	$("#" + sw.walkthrough.selected +  "_walkthrough").show();
        	$("#walkthrough_controls").show();
        	sw.walkthrough.page_count = $("." + sw.walkthrough.selected +  "_page").length - 1;
        	$("." + sw.walkthrough.selected +  "_page").hide();
        	$("." + sw.walkthrough.selected +  "_page").first().show();
        	$.colorbox.resize();
        		
        })
         
	    $("#walkthrough_prev").click(function() {
	    	$("." + sw.walkthrough.selected +  "_page:eq(" +  sw.walkthrough.current_page + ")").hide();
	    	sw.walkthrough.current_page = sw.walkthrough.current_page - 1;
	    	
	    	if(sw.walkthrough.current_page < 1){
	    		$("#walkthrough_next").show();
	    		$("#walkthrough_prev").hide();
	    		sw.walkthrough.current_page = 0;
	    	} else {
	    		$("#walkthrough_prev").show();
	    		$("#walkthrough_next").show();
	    	}
	         
	        //slide the item
	    	$("." + sw.walkthrough.selected +  "_page:eq(" +  sw.walkthrough.current_page  + ")").show();
	    	$.colorbox.resize();
	    });
	 
	    //if user clicked on next button
	    $("#walkthrough_next").click(function() {
	    	$("." + sw.walkthrough.selected +  "_page:eq(" +  sw.walkthrough.current_page+ ")").hide();
	    	sw.walkthrough.current_page = sw.walkthrough.current_page +1;
	    	
	    	if(sw.walkthrough.current_page > sw.walkthrough.page_count - 1){
	    		$("#walkthrough_prev").show();
	    		$("#walkthrough_next").hide();
	    		sw.walkthrough.current_page = sw.walkthrough.page_count;
	    	} else {
	    		$("#walkthrough_next").show();	    
	    		$("#walkthrough_prev").show();		
	    	}
	         
	    	$("." + sw.walkthrough.selected +  "_page:eq(" +  sw.walkthrough.current_page + ")").show();
	    	$.colorbox.resize();
	    });       
	     
      });
      
	var default_colorbox_close = $.colorbox.close;
	$.colorbox.close = function(){
	  default_colorbox_close();
      //reset_walkthrough();
	};
	
	function reset_walkthrough(){
		
		sw.walkthrough.current_page = 0;
		$("#walkthrough_controls").hide();
		$("#walkthrough_choices").show();
		//$("#scrapper_walkthrough").hide();
		$(".walkthrough_group").hide();
		$("#walkthrough_prev").hide();
		$("#walkthrough_next").show();
		
	}
</script>






