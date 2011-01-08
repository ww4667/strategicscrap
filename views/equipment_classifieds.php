  <script type="text/javascript">
  $(document).ready(function() {
  
  $('#equipClassifieds').tabs();
			
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
			
	 sw.tabOneSlider = new sw.app.verticalSlider('#tabs-1', '#tab-1-pane','#tab-1-content',{overflow: "hidden", float: "left", height: "645px", width: "547px"}, {position: "relative"} );
   sw.tabTwoSlider = new sw.app.verticalSlider('#tabs-2', '#tab-2-pane','#tab-2-content',{overflow: "hidden", float: "left", height: "645px", width: "547px"}, {position: "relative"} );


   $('.classifiedLink').colorbox({ width: "550", inline:true, href:"#listingDescription1", 
       onComplete:function(){ var hidden_div = $( this ).attr( "ssclass" ); var html = $('#'+hidden_div).html(); $("#listingDescription1").html(html); $.colorbox.resize();  } 
     });
  });
  </script>
  
  <div id="equipClassifieds" class="classifiedListing">
	<div>
		<div style="float:left"><a href="#"><img src="/resources/images/buttons/watch_video.png" alt="watch a video" id="watch_video" /></a></div>
		<div style="float:left;margin-left:20px"><a href="#"><img src="/resources/images/buttons/post_a_classified.png" alt="post a classified"  id="post_a_classified" /></a></div>
		<div style="clear:both;padding:20px 0">If you would like us to post your classified, please call us at 866-796-7272 or email us at classifieds@strategicscrap.com</div>
	</div>
              
  <ul id="tabs-equipClass">
    <li><a href="#tabs-1"><span>Sell Equipment</span></a></li>
    <li><a href="#tabs-2"><span>Buy Equipment</span></a></li>
  </ul><!-- tabs-equipClass -->
     
    <div id="tabs-1">
    <div id="tab-1-pane">
      <div id="tab-1-content">

				[[Ditto? &parents=`41`&orderBy=`publishedon ASC` &display=`500` &total=`500` &tpl=`equip_row_white` &tplAlt=`equip_row_gray`]]

        </div><!-- tab1 conent -->
    </div><!-- tab1 pane -->
    </div><!-- tab1 -->
    
    <div id="tabs-2">
    <div id="tab-2-pane">
      <div id="tab-2-content">

				[[Ditto? &parents=`44`&orderBy=`publishedon ASC` &display=`500` &total=`500` &tpl=`equip_row_white` &tplAlt=`equip_row_gray`]]
        
        </div><!-- tab2 conent -->
    </div><!-- tab2 pane -->
    </div><!-- tab2 -->
    
</div><!-- equipClassifieds -->

<!-- This contains the hidden content for inline calls --> 
<div style="display:none"> 
 
	<div id="listingDescription1" style="padding:10px; background:#fff;">
	    
	</div>
	 
</div> 