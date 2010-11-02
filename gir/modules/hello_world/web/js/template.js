adb.app.template = function(){
	    function init(){
	    	setupEventListeners();
	    }

	    /* ---[ PUBLIC METHODS ]--- */
	    function updateTemplate(template){
	    	templateHTML = $("." + template).html();
	    	$(".templateField").each(function(){
	    		fieldName = $(this).attr("templatedata");
	    		fieldValue = $(this).val();
	    		templateHTML = templateHTML.replace("___" + fieldName + "___", fieldValue );
		    });
    		//alert(templateHTML);
	    	
	    };
	    /* ---[ PRIVATE METHODS ]--- */

	    /* ---[ EVENT LISTENERS ]--- */
	    function setupEventListeners(){
		    $(".templated").each(function(){
		    	thisTemplate = $(this).attr("template");
			    $(function() {
				    $(".templateField").blur(function(){
				    	updateTemplate(thisTemplate);
				    });
			    });
		    });
	    }

	    /* ---[ RUN ]--- */
	    init();
	};

	$(document).ready(function() {
	   adb.template = new adb.app.template()
    });