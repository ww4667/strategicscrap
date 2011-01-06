
  function verticalSlider(pane, content, width, height){
    //change the main div to overflow-hidden as we can use the slider now
    $(pane).css({overflow: 'hidden',float: 'left', width: width + 'px', height: height + 'px'});
    $(content).css('position', 'relative');
    
    //calculate the height that the scrollbar handle should be
    var difference = $(content).height()-$(pane).height();//eg it's 200px longer 
    
    if(difference>0)//if the scrollbar is needed, set it up...
    {
       var proportion = difference / $(content).height();//eg 200px/500px
       var handleHeight = Math.round((1-proportion)*$(pane).height());//set the proportional height - round it to make sure everything adds up correctly later on
       handleHeight -= handleHeight%2; //ensure the handle height is exactly divisible by two
    
       $(pane).after('<\div id="slider-wrap"><\div id="slider-vertical"><\/div><\/div>');//append the necessary divs so they're only there if needed
       $("#slider-wrap").height($(pane).height());//set the height of the slider bar to that of the scroll pane
    
    
       //set up the slider 
       $('#slider-vertical').slider({
          orientation: 'vertical',
          range: 'max',
          min: 0,
          max: 100,
          value: 100,
          slide: function(event, ui) {
             var topValue = -((100-ui.value)*difference/100);
             $(content).css({top:topValue});//move the top up (negative value) by the percentage the slider has been moved times the difference in height
          }
       });
    
       //set the handle height and bottom margin so the middle of the handle is in line with the slider
       $(".ui-slider-handle").css({height:handleHeight,'margin-bottom':-0.5*handleHeight});
      
       var origSliderHeight = $("#slider-vertical").height();//read the original slider height
       var sliderHeight = origSliderHeight - handleHeight ;//the height through which the handle can move needs to be the original height minus the handle height
       var sliderMargin =  (origSliderHeight - sliderHeight)*0.5;//so the slider needs to have both top and bottom margins equal to half the difference
       $(".ui-slider").css({height:sliderHeight,'margin-top':sliderMargin});//set the slider height and margins
    }//end if
  
  }