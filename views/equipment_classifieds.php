  <div id="equipClassifieds" class="classifiedListing">
	<div>
		<div style="float:left"><a class="watch_video" href="https://www.youtube.com/embed/1kIim6cMN_w"><img src="/resources/images/buttons/watch_video.png" alt="watch a video" id="watch_video" /></a></div>
		<div style="float:left;margin-left:20px"><a href="mailto:classifieds@strategicscrap.com?subject=I would like to post a equipment classified&body=Hello, Below are the details of my classified ad..."><img src="/resources/images/buttons/post_a_classified.png" alt="post a classified"  id="post_a_classified" /></a></div>
		<div style="clear:both;padding:20px 0">
			If you would like us to post your classified, please call us at 866-796-7272 or email us at classifieds@strategicscrap.com<br /><strong>Members post for FREE!</strong>
		</div>
	</div>
              
  <ul id="tabs-equipClass">
    <li><a href="#tabs-1"><span>For Sale</span></a></li>
    <li><a href="#tabs-2"><span>Wanted</span></a></li>
  </ul><!-- tabs-equipClass -->
     
    <div id="tabs-1">
    <div id="tab-1-pane" style="position:relative">
      <div id="tab-1-content">

				[[Ditto? &parents=`41`&orderBy=`publishedon ASC` &display=`500` &total=`500` &tpl=`equip_row_white` &tplAlt=`equip_row_gray`]]

        </div><!-- tab1 conent -->
    </div><!-- tab1 pane -->
    </div><!-- tab1 -->
    
    <div id="tabs-2">
    <div id="tab-2-pane" style="position:relative">
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

<script type="text/javascript">
  $(document).ready(function() {
  	
  $('.watch_video').colorbox({ width: "500", height: "350", iframe:true});
  
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

   $('.classifiedLink').colorbox({ width: "560", scrolling: false, inline:true, href:"#listingDescription1", 
       onComplete:function(){ var hidden_div = $( this ).attr( "ssclass" ); var html = $('#'+hidden_div).html(); $("#listingDescription1").html(html); $.colorbox.resize();
			var stupid = 0;
		   	$('#colorbox img.sm, #colorbox span.clickme').click(function(){
				if (stupid == 1) {
					stupid = -1;
					$('#colorbox img.sm').animate({width:"135px"},400, function(){
						$('#colorbox .clickme').html('click to zoom in');
						$.colorbox.resize();
						stupid = 0;
					});
				} else if (stupid == 0) {
					stupid = -1;
					$('#colorbox img.sm').animate({width:"500px"},400, function(){
						$('#colorbox .clickme').html('click to zoom out');
						$.colorbox.resize();
						stupid = 1;
					});
				}
			});
	}});
  })
  </script>