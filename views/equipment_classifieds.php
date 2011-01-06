  <?
  
  $use_ui = $_GET["use_ui"];
  
  ?>
  
  <? if ($use_ui == "true"){ ?>
  <script type="text/javascript">
  $(document).ready(function() {
            $('#equipClassifieds').tabs();
  });
  </script>
  
  <div id="equipClassifieds" class="classifiedListing">
              
  <ul id="tabs-equipClass">
    <li><a href="#tabs-1"><span>Sell Equipment</span></a></li>
    <li><a href="#tabs-2"><span>Buy Equipment</span></a></li>
  </ul><!-- tabs-equipClass -->
     
    <div id="tabs-1">
        <div class="equipListing row1">
          <strong>GENSCO WT-2260 SHREDDER</strong>
          <dl class="clearfix">
            <dt>Single shaft shredder, 25 hp, processes approx. 450-900 pounds per hour.</dt>
            <dt><a class="scrapDesc1" href="#">Description and Contact Information</a></dt>
          </dl>
        </div><!-- equipListing row1 -->
        
        <div class="equipListing row2">
          <strong>SWEED 517AE SCRAP CHOPPER</strong>
          <dl class="clearfix">
            <dt>3 hp, 3 inch pieces at 60 feet per minute. Comes with spare blades and on casters</dt>
            <dt><a class="scrapDesc1" href="#">Description and Contact Information</a></dt>
          </dl>
        </div><!-- equipListing row2 -->

        <div class="equipListing row1">
          <strong>LGI SCRAP HANDLING MAGNET 58 inch</strong>
          <dl>
            <dt>Lifting capacity, 24,000 pounds. 230 volts DC. Chains included. 1 year warranty.</dt>
            <dt><a class="scrapDesc1" href="#">Description and Contact Information</a></dt>
          </dl>
        </div><!-- equipListing row1 -->
        
        <div class="equipListing row2">
          <strong>TGS 57 used Harris bailer</strong>
          <dl>
            <dt>140 bails per hour. Charging box size, 90”x34”x24”</dt>
            <dt><a class="scrapDesc1" href="#">Description and Contact Information</a></dt>
          </dl>
        </div><!-- equipListing row2 -->

        <div class="equipListing row1">
          <strong>1450E used SSI SHEAR SHREDDER</strong>
          <dl>
            <dt>42”x32” opening. 75 hp. Mounted on steel base. Control panel included.</dt>
            <dt><a class="scrapDesc1" href="#">Description and Contact Information</a></dt>
          </dl>
        </div><!-- equipListing row1 -->
        
    </div><!-- tab1 -->
    
    <div id="tabs-2">
        <!-- white background -->
        <div class="scrapListing row1">
          <strong>Classifieds data is currently not available.</strong>
        </div><!-- scrapListing row1 -->
        
    </div><!-- tab2 -->
    
</div><!-- equipClassifieds -->

  
  <?} else {?>

<div id="equipClassifieds" class="classifiedListing">
					  	
	<ul id="tabs-equipClass">
		<li><a href="#tab1"><span>Sell Equipment</span></a></li>
		<li><a href="#tab2"><span>Buy Equipment</span></a></li>
	</ul><!-- tabs-equipClass -->
	
	<div class="tabBox">
		
		<div id="tab1">
			<div id="scroll-pane1">
				
				<div class="equipListing row1">
					<strong>GENSCO WT-2260 SHREDDER</strong>
					<dl class="clearfix">
						<dt>Single shaft shredder, 25 hp, processes approx. 450-900 pounds per hour.</dt>
						<dt><a class="scrapDesc1" href="#">Description and Contact Information</a></dt>
					</dl>
				</div><!-- equipListing row1 -->
				
				<div class="equipListing row2">
					<strong>SWEED 517AE SCRAP CHOPPER</strong>
					<dl class="clearfix">
						<dt>3 hp, 3 inch pieces at 60 feet per minute. Comes with spare blades and on casters</dt>
						<dt><a class="scrapDesc1" href="#">Description and Contact Information</a></dt>
					</dl>
				</div><!-- equipListing row2 -->

				<div class="equipListing row1">
					<strong>LGI SCRAP HANDLING MAGNET 58 inch</strong>
					<dl>
						<dt>Lifting capacity, 24,000 pounds. 230 volts DC. Chains included. 1 year warranty.</dt>
						<dt><a class="scrapDesc1" href="#">Description and Contact Information</a></dt>
					</dl>
				</div><!-- equipListing row1 -->
				
				<div class="equipListing row2">
					<strong>TGS 57 used Harris bailer</strong>
					<dl>
						<dt>140 bails per hour. Charging box size, 90”x34”x24”</dt>
						<dt><a class="scrapDesc1" href="#">Description and Contact Information</a></dt>
					</dl>
				</div><!-- equipListing row2 -->

				<div class="equipListing row1">
					<strong>1450E used SSI SHEAR SHREDDER</strong>
					<dl>
						<dt>42”x32” opening. 75 hp. Mounted on steel base. Control panel included.</dt>
						<dt><a class="scrapDesc1" href="#">Description and Contact Information</a></dt>
					</dl>
				</div><!-- equipListing row1 -->
				
			</div><!-- scroll-pane1 -->
		</div><!-- tab1 -->
		
		<div id="tab2">
			<div id="scroll-pane2">
				
				<!-- white background -->
				<div class="scrapListing row1">
					<strong>Classifieds data is currently not available.</strong>
				</div><!-- scrapListing row1 -->
				
			</div><!-- scroll-pane2 -->
		</div><!-- tab2 -->
		
	</div><!-- tabBox -->
	
</div><!-- equipClassifieds -->

<? } // enduse_ui check ?>

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