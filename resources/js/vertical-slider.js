/**
 * search form text removal
 *
 * @author mrKelly
 * @classDescription This clears the text "Search" from search boxes when users clicks in the box..
 **/

sw.app.verticalSlider = function(wrapper, pane, content, pane_css, content_css){

   /* apply css to the elements, if empty set main element to overflow-hidden as we can use the slider now*/
    $(pane).css(pane_css);
    $(wrapper + " " + content).css(content_css);


    /*calculate the height that the scrollbar handle should be*/
    var difference = $(content).height()-$(pane).height();//eg it's 200px longer
    
    if(difference>0) {
       var proportion = difference / $(content).height();//eg 200px/500px
       var handleHeight = Math.round((1-proportion)*$(pane).height());//set the proportional height - round it to make sure everything adds up correctly later on
       handleHeight -= handleHeight%2; //ensure the handle height is exactly divisible by two

       $(wrapper + " " + pane).after('<\div id="slider-wrap"><\div id="slider-vertical"><\/div><\/div>');//append the necessary divs so they're only there if needed
       $(wrapper + " #slider-wrap").height($(wrapper + " " + pane).height());//set the height of the slider bar to that of the scroll pane


       /*set up the slider*/
       $(wrapper + ' #slider-vertical').slider({
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

      /* set the handle height and bottom margin so the middle of the handle is in line with the slider*/
       $(wrapper + " .ui-slider-handle").css({height:handleHeight,'margin-bottom':-0.5*handleHeight});

       var origSliderHeight = $(wrapper + " #slider-vertical").height();//read the original slider height
       var sliderHeight = origSliderHeight - handleHeight ;//the height through which the handle can move needs to be the original height minus the handle height
       var sliderMargin =  (origSliderHeight - sliderHeight)*0.5;//so the slider needs to have both top and bottom margins equal to half the difference
       $(wrapper + " .ui-slider").css({height:sliderHeight,'margin-top':sliderMargin});//set the slider height and margins
    }

    /* ---[ CONSTRUCTOR ]--- */
    function init(){
        /* initialization code */
        setupEventListeners();
    }

    /* ---[ EVENT LISTENERS ]--- */
    function setupEventListeners(){

    }
    
    //additional code for mousewheel
    $(wrapper + " " + pane + "," + wrapper + " #slider-wrap").mousewheel(function(event, delta){
        var speed = 5;
        var sliderVal = $(wrapper + " #slider-vertical").slider("value");//read current value of the slider
      
        sliderVal += (delta*speed);//increment the current value
   
        $(wrapper + " #slider-vertical").slider("value", sliderVal);//and set the new value of the slider
      
      var topValue = -((100-sliderVal)*difference/100);//calculate the content top from the slider position
      
      if (topValue>0) topValue = 0;//stop the content scrolling down too much
      if (Math.abs(topValue)>difference) topValue = (-1)*difference;//stop the content scrolling up too much
      
      $(wrapper + " " + content).css({top:topValue});//move the content to the new position
        event.preventDefault();//stop any default behaviour
    });


    /* ---[ RUN ]--- */
    init();
};

