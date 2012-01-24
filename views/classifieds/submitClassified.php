<? $newClassified = new Classified(); ?>

<html>
	<head>

		<link href="/resources/css/core.css" rel="stylesheet" type="text/css" />
		
		<!-- css for verticalSlider -->
		<style type="text/css">
			#upgrade_browser_bar {background-color: #fcfdde;	width: 100%; border-top: solid 1px #000; border-bottom: solid 1px #000; text-align: center; padding:5px 0px 5px 0px;}
			#scroll-pane { float:left;overflow: auto; width: 535px; height:300px;position:relative;border:1px solid gray;margin-left:0;margin-bottom:0;display:inline}
			#scroll-content {position:absolute;top:0;left:0}
			.scroll-content-item {background-color:#fcfcfc;color:#003366;width:100px;height:100px;float:left;margin:10px;font-size:3em;line-height:96px;text-align:center;border:1px solid gray;display:inline;}
			#slider-wrap{float:right;background-color:#ccc;width:16px;border:none;}
			#slider-vertical{position:relative;height:100%; width: 16px;}
			.ui-slider-handle{width:16px;height:10px;margin:0 auto;background-color:#0d0d0d;display:block;position:absolute}
			
			#tabs-equipClass, #tabs-scrapClass {margin: 0; padding: 0;}
			.classifiedListing ul li {margin-left:0}
			body { background: #ccc; padding: 10px; }
			.label {
				width: 110px;
				padding-right: 20px;
				display: block;
				float: left;
			}
			.value {
				display: block;
				float: left;
			}
			
			.step {display:none;}
			.step1 { display: block; }
			.goforward { float:right; }
			.goback { float:left; }
		</style>
    
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" ></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js" ></script>

  	<!-- DATE -->



	</head>
	<body>
		


<?
						
				if(isset($_POST['submitted'])){
					
					$post_data = $_POST;
					
					$newClassified = new Classified();
					
					$potential_path = $newClassified->addCategory( $post_data[ 'join_category_parent' ], false  );
					$cleanSlug = cleanSlug( $post_data['title'] );
					$potential_path_op =  $potential_path . $cleanSlug;
					$processNewCategory = $newClassified->findSlugsBySlug( $potential_path_op );
					
					$post_data['slug'] = $potential_path_op; 			
					
					if( count( $processNewCategory ) > 0 ){
						$errorMessages = "<li>There is a classified with this name already under this category. Please choose a unique title.</li>";
						
						showPage( "<ul>" . $errorMessages . "</ul>" );
					} else {	
						// check for required fields
						$required_fields = array(
							array("title","Classified Title cannot be left empty."),
							array("description","Classified Description cannot be left empty."),
							/*array("image","Classified Title cannot be left empty"),*/
							array("join_category_parent","Classified Category must be selected."),
							array("join_classified_type","Classified Type must be selected.")
						);
						
						
						$selectedClassifiedType = $post_data['contact']['form_'.$post_data['join_classified_type']];
			
						/* check for contacts stuff */
						
						$fieldsInputArray = explode(",", $selectedClassifiedType['fields']);
						$fieldsOutput = array();
						foreach( $fieldsInputArray as $k => $v ){
							// !22|Contact|contact
							$temp = explode("|",$v);
							$id = "";
							
							if( strpos($temp[0], "!") === false ){
								/* uh... */
							} else {
								$required_fields[] = array($temp[2],"".$temp[1]." cannot be left empty");
							}
							
						}
						
						
						// fix data
						// trim first
						foreach ($post_data as $key => $val) {
							$post_data[$key] = is_string($post_data[$key]) ? trim($val) : $post_data[$key];
						}
						
						/**
						 * go through the contact fields - move them up to the top level
						 */
						if( $post_data['join_classified_type'] != 'null' && is_array( $post_data['contact']['form_'.$post_data['join_classified_type']] ) ){
							$contactFields = $post_data['contact']['form_'.$post_data['join_classified_type']];
							foreach ( $contactFields as $key => $val ) {
								$post_data[$key] = $val;
							}	
						}
						
						//showPage()
						$errorMessages = "";
						foreach ( $required_fields as $key => $val ) {
							if( empty( $post_data[ $val[ 0 ] ] ) || $post_data[ $val[ 0 ] ] == 'null' ) $errorMessages .= "<li>" . $required_fields[$key][1] . "</li>";
							
						}
						
						if( !empty( $errorMessages ) ) {
							showPage( "<ul>" . $errorMessages . "</ul>" );
						} else {
						$fileUploader = upload_function( $_SERVER["DOCUMENT_ROOT"] . '/resources/images/classifieds/', 'image' );
						
						if( $fileUploader !== FALSE ){
							$post_data['image'] = '/resources/images/classifieds/' .$fileUploader; 
						} else {
							$post_data['image'] = '';
						}
						
						// create the material

						$newClassified->CreateItem($post_data);
						if( !empty($newClassified->id) ){
							
							$newClassified->addCategory($post_data['join_category_parent']);
							
							$newContact = new Contact();
							$newContact->CreateItem( $selectedClassifiedType );
							
							$newClassified->addClassifiedType( $post_data['join_classified_type'] );
							$newClassified->addContact( $newContact->id );
							
								print "<h1>Your Classified was submitted.</h1><p>We will review and contact you as soon as possible.</p>";
						} else {
								print "<h1>ERROR!</h1><p>Try submitting the classified again.</p>";
							}							
						}
						

					}
				} else {
					print "<!-- how did you get here? -->";
				}

function showPage( $errorMessage = "" ){
	$post_data = $_POST;
	require_once($_SERVER['DOCUMENT_ROOT']."/views/classifieds/classifiedForm.php");
				
}
?>

</body>
</html>