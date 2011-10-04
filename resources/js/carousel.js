/**
 *  simple jquery carousel
 *
 *	Requires jQuery UI
 *
 * @author mrKelly
 * @classDescription A simple carousel
 **/


(function($) { 
$.fn.carousel = function(options, container){
	
	//console.dir(options);
	var defaults = {
			slides: 'slide', //carousel container
			next: "#next", //hnext button
			previous: "#prev", //previous button
			duration: 5000, //duration of slides
			fade: 1000, //duration of transition
			style: "drop"
		}
	var o = $.extend(defaults,options);
	
	return $(this).each(function(){
		//configuration
		
		//console.dir(o);

		var this_id = $(this).attr("id");
	    o.slide_count = $(this).find("." + o.slides).length - 1;
	 //   console.log(this_id + " slide count: " + o.slide_count);
	    o.current_slide = 0; 
	  	var options = {};
		
		o.rotate = function() {
			//console.log("in rotate" + o.next);
		    $(o.next).click();
		}
		
	    var run = setInterval(o.rotate, o.duration);  
		o.show_next = function() {
	        // $("." + o.slides).hide();
			
	    	o.current_slide = o.current_slide + 1;
			//console.log("in show next: #" + this_id + " ." + o.slides +":eq(" +  o.current_slide);
	    	
	    	if(o.current_slide  > o.slide_count ){
	    		o.current_slide  = 0;
	    	}
	        //slide the item
	    	$("#" + this_id + " ." + o.slides +":eq(" +  o.current_slide  + ")").show(o.style);
		};
	    
	    $(o.previous).click(function() {
	    	$("#" + this_id + " ." + o.slides +":eq(" +  o.current_slide + ")").hide(o.style);
	    	o.current_slide =o.current_slide - 1;
	    	
	    	if(o.current_slide < 0){
	    		o.current_slide = o.slide_count;
	    	}
	         
	        //slide the item
	    	$("#" + this_id + " ." + o.slides +":eq(" +  o.current_slide + ")").show(o.style);
	    	
	         clearInterval(run);
	         run = setInterval(o.rotate, o.duration);  
	        //cancel the link behavior           
	        return false;
	             
	    });
	 
	  	
	    //if user clicked on next button
	    $(o.next).click(function() {
        	//console.log("#" + this_id + " ." + o.slides +":eq(" +  o.current_slide);
	    	//console.log(o.style + ", " + options + ", " + o.fade  + ", " +o.show_next);
	    	//$("#" +this_id + " ." + o.slides +":eq(" + o.current_slide + ")").hide(o.style, options, o.fade ,o.show_next());
	    	$("#" +this_id + " ." + o.slides +":eq(" + o.current_slide + ")").hide(o.style);
	    	
	    	o.current_slide = o.current_slide + 1;
	    	if(o.current_slide  > o.slide_count ){
	    		o.current_slide  = 0;
	    	}
	        //slide the item
	    	$("#" + this_id + " ." + o.slides +":eq(" +  o.current_slide  + ")").show(o.style);
	    	
            clearInterval(run);
            run = setInterval(o.rotate, o.duration);  
	        //cancel the link behavior
	        return false;
	         
	    });       
	     
	    //if mouse hover, pause the auto rotation, otherwise rotate it
	    $(this).hover(
	        function() {
	        	//console.log("pause");
	            clearInterval(run);
	        },
	        function() {
	        	//console.log("unpause");
	            run = setInterval(o.rotate, o.duration);  
	        }
	    );
	    
		
		}).next(); //returns carousel(es)
};
})(jQuery);

