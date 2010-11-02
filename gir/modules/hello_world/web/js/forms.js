adb.app.dynamicForm = function(){
	    function init(){

		    injectRow("#propertiesRowTemplate", "#properties");
		    injectRow("#propertiesRowTemplate", "#properties");
		    injectRow("#propertiesRowTemplate", "#properties");

	    	setupEventListeners();
		    }

	    /* ---[ PUBLIC METHODS ]--- */
	    
	    function numberRows(container, rowClass){
	    
	    	$(container + " " + rowClass + " > .rowCount").each(function(index){
	    		//alert(index + " | " + $(this .rowCount).html());
	    		$(this).html(index + 1);
	    	});
	    }
	    function injectRow( template, destination){
	    	/*Gets HTML from the template and appends template to the destination*/
	    	if(($(template) != null) && $(destination) != null){
	    		
		    	var rowContent = $(template).html();
	    		//alert(template + ":" + destination);
		    	$(destination).append(rowContent);

		    	rowClass = template.replace("Template", "" );
		    	rowClass = rowClass.replace("#", "." );
		    	
		    	numberRows(destination, rowClass );

		    	/*
		    	 * if($(destination).parent().hasClass("templated")){
		    		adb.template.setupEventListeners();
		    	};*/
	    	
	    	} else {
	    	alert("unknown template / destination");	
	    	}
	    }

	    /* ---[ PRIVATE METHODS ]--- */

	    /* ---[ EVENT LISTENERS ]--- */
	    function setupEventListeners(){
		    $(".addRow").click(function(){

		    	destination = $(this).attr("destination");
		    	template =  $(this).attr("template");
		    	injectRow(template, destination);
		    	
		    });
	    }

	    /* ---[ RUN ]--- */
	    init();
	};

	$(document).ready(function() {
		   // do stuff when DOM is ready
		//alert("dom is ready...");
	    adb.dynamicForm = new adb.app.dynamicForm();
	    $(function() {

			$("ul.rowList").sortable({ opacity: 0.6, cursor: 'move'
			});								  
		});

	    
		 });