  <script type="text/javascript">
  $('document').ready(function() {
        $('#scrapClassifieds').tabs();
			
		$('#watch_video').hover(function(){ 
	       $(this).attr('src', '/resources/images/buttons/watch_video_hover.png'); 
		}, function(){ 
	       $(this).attr('src', '/resources/images/buttons/watch_video.png'); 
		});
		$('#post_a_classified').hover(function(){ 
	       $(this).attr('src', '/resources/images/buttons/post_a_classified_hover.png'); 
		}, function(){ 
	       $(this).attr('src', '/resources/images/buttons/post_a_classified.png'); 
		});
   
  	sw.tabOneSlider = new sw.app.verticalSlider('#tab11', '#tab-1-pane','#tab-1-content',{overflow: "hidden", float: "left", height: "645px", width: "547px",position: "relative"}, {position: "relative"} );
   sw.tabThreeSlider = new sw.app.verticalSlider('#tab3', '#tab-3-pane','#tab-3-content',{overflow: "hidden", float: "left", height: "645px", width: "547px",position: "relative"}, {position: "relative"} );
   sw.tabFourSlider = new sw.app.verticalSlider('#tab4', '#tab-4-pane','#tab-4-content',{overflow: "hidden", float: "left", height: "645px", width: "547px",position: "relative"}, {position: "relative"} );
   sw.tabTwoSlider = new sw.app.verticalSlider('#tab22', '#tab-2-pane','#tab-2-content',{overflow: "hidden", float: "left", height: "645px", width: "547px",position: "relative"}, {position: "relative"} );    

   $('.classifiedLink').colorbox({ width: "550", inline:true, href:"#listingDescription1", 
       onComplete:function(){ 
       	var hidden_div = $( this ).attr( "ssclass" ); 
       	var html = $('#'+hidden_div).html(); 
       	$("#listingDescription1").html(html); $.colorbox.resize();  
       } 
     });

   $('.watch_video').colorbox({ width: "500", height: "350", iframe:true});
   
  });
  </script>

<div id="scrapClassifieds" class="classifiedListing">
	<div>
		<div>
			Members post for free! $35/listing for non-members.
		</div>
		<div style="padding:20px 0"><a href="mailto:classifieds@strategicscrap.com?subject=I would like to post a equipment classified&body=Fill%20out%20details%20of%20the%20classified%20you%20would%20like%20to%20post%20below.%0A%0A*Please%20specify%20if%20you%20want%20to%20buy%20or%20sell.%0A%0ACompany%3A%20%0AContact%3A%20%0AEmail%3A%20%0APhone%3A%20%0ADescription%3A%0A%0A%0AQuantity%3A%20%0APrice%3A%20"><img src="/resources/images/buttons/post_a_classified.png" alt="post a classified"  id="post_a_classified" /></a></div>
	</div>
					  	
	<ul id="tabs-scrapClass">
		<li><a href="#tab22"><span>Wanted</span></a></li>
		<li><a href="#tab11"><span>For Sale</span></a></li>
		<li><a href="#tab3"><span>Auctions</span></a></li>
		<li><a href="#tab4"><span>Jobs</span></a></li>
	</ul>
	
	<div class="tabBox">
		
		<div id="tab22">
    <div id="tab-2-pane" style="position:relative">
      <div id="tab-2-content">
		[[Ditto? &parents=`37`&orderBy=`pub_date DESC` &display=`500` &total=`500` &tpl=`scrap_row_white` &tplAlt=`scrap_row_gray`]]
        </div><!-- tab2 conent -->
    </div><!-- tab2 pane -->
		</div><!-- tab2 -->
		
		<div id="tab11">
    <div id="tab-1-pane" style="position:relative">
      <div id="tab-1-content">
        [[Ditto? &parents=`36`&orderBy=`pub_date DESC` &display=`500` &total=`500` &tpl=`scrap_row_white` &tplAlt=`scrap_row_gray`]]
        </div><!-- tab1 conent -->
    </div><!-- tab1 pane -->
		</div><!-- tab1 -->
		
		<div id="tab3">
    <div id="tab-3-pane" style="position:relative">
      <div id="tab-3-content">
		[[Ditto? &parents=`51`&orderBy=`pub_date DESC` &display=`500` &total=`500` &tpl=`auction_row_white` &tplAlt=`auction_row_gray`]]
        </div><!-- tab3 conent -->
    </div><!-- tab3 pane -->
		</div><!-- tab3 -->
		
		<div id="tab4">
    <div id="tab-4-pane" style="position:relative">
      <div id="tab-4-content">
		[[Ditto? &parents=`53`&orderBy=`pub_date DESC` &display=`500` &total=`500` &tpl=`job_row_white` &tplAlt=`job_row_gray`]]
        </div><!-- tab4 conent -->
    </div><!-- tab4 pane -->
		</div><!-- tab4 -->
			
	</div><!-- tabBox -->
</div>

<!-- This contains the hidden content for inline calls --> 
<div style="display:none"> 
	<div id="listingDescription1" style="padding:10px; background:#fff;">
	</div> 
</div> 