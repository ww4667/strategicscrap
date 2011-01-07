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
	    <div class="detail_img" style="float:left">
	        <img src="http://dummyimage.com/135x180/000/fff&text=image+not+available" alt="detial image" />
	    </div>
        <div style="float:left;padding-left:20px;width:320px;">
			<strong>SAMPLE DATA DETAILS/DESCRIPTION</strong>
			<dl>
				<dt style="clear:left;float:left;width:60px;">Unit:</dt><dd style="float:left">Tons</dd>
				<dt style="clear:left;float:left;width:60px;">Quantity:</dt><dd style="float:left">2,800</dd>
				<dt style="clear:left;float:left;width:60px;">Price:</dt><dd style="float:left">$367</dd>
			</dl>
			<div style="clear:left;padding-top:10px">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, nisl ut aliquip ex ea commodo consequat.</div>
			<div style="clear:left;padding-top:10px">John Doe<br />johndoe@email.com<br />phone: 1-800-555-XXXX</div>
			
        </div>
		<div style="clear:both"><!--not empty--></div>
	</div> 
</div> 