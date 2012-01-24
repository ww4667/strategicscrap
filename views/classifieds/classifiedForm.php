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
		

 <h1 style="margin:0;padding:0">Create Your Classified in 3 steps</h1>

<div class="sectionBody order_details">
	<form action="/controllers/remote?method=processClassifiedForm" method="post"  enctype="multipart/form-data">
		
<input name="end_date" type="hidden" value="<?=isset( $post_data['end_date'] ) == true && $post_data['end_date'] != '' ? $post_data['end_date'] : '' . date("Y-m-d", strtotime("+30 day")); ?>" style="width: 300px;" />
		

<div class="step1 step">
	<h2>Step 1</h2>
	<sub>Catagorize Your Classified</sub>
	<br style="clear:left" />
	<div><strong>Choose Your Classified Category:</strong><br />This will be where your your classified will be filed. The more descriptive, the better.</div>
	<?
	
	$allCategories = new Category();
	$allCategoryObjects = $allCategories->getAllCategoriesByHierarchy();
	
	$categoryListOp = '<select name="join_category_parent">';
	$categoryListOp .= '<option value="null">--Top Level--</option>';
	
	foreach( $allCategoryObjects as $categoryObject ){
		
		$categoryListOp .= '<option value="' . $categoryObject['id'] . '" ' . ( $post_data['join_category_parent'] == $categoryObject['id'] ? 'selected="selected"' : '' ) . '>' . $categoryObject['slug'] . '</option>';
	    
	}
	
	$categoryListOp .= '</select>';
	 
	?>
	<br style="clear:left" />
	<div ><?=$categoryListOp;?><!--<input name="join_classified_parent" value="<?= $post_data['join_classified_parent']?>" />--></div>    
	<br style="clear:left" />
	<input type="button" name="goback" goto="step2" value="Next Step" class="goforward" />
</div>

<div class="step2 step">
	<h2>Step 2</h2>
	<sub>Tell us about your classified.</sub>
	<br style="clear:both;" />
	
	<div class="label"><strong>Title:</strong></div>
	<div class="value"><input name="title" value="<?= $post_data['title']?>" style="width: 300px;" /></div>

    <br style="clear:left" />
	<div class="label"><strong>Description:</strong></div>
	<div class="value"><textarea rows="10" cols="25" name="description" style="width: 300px; height: 150px;"><?= $post_data['description']?></textarea></div>

    <br style="clear:left" />
	<div class="label"><strong>Upload a photo for the classified:</strong></div>
	<div class="value"><input type="file" name="image" style="width: 300px;" value="<?= $post_data['image']?>" /></div>
    
    <br style="clear:left" />
	<div class="label"><strong>Is this a want ad?:</strong><br/>(Check if it is a want ad.)</div>
	<div class="value"><input type="checkbox" name="sale_or_wanted" value="<?= $post_data['sale_or_wanted']?>" /></div>
	<br style="clear:left" />

	<input type="button" name="goback" goto="step1" value="Go back" class="goback" /> &nbsp;<input type="button" name="goback" goto="step3" value="Next Step" class="goforward" />
</div>

<div class="step3 step">
	<h2>Step 3</h2>
	<br style="clear:both;" />
	<sub>What kind of classified is this.</sub>
		<div class="label"><strong>Classified Type:</strong></div>
	<?
	
	$refClassifiedType = new ClassifiedType();
	$allClassifiedTypes = $refClassifiedType->GetAllItems();
	
	$classifiedTypeFields = array();
	
	$classifedTypeOp  = '<select name="join_classified_type" id="join_classified_type">';
	$classifedTypeOp .= '<option value="null">--Choose One--</option>';
	
	foreach( $allClassifiedTypes as $classifiedTypeItem ){
		
		if( $classifiedTypeItem['hidden'] != 1 ){
			$classifedTypeOp .= '<option value="' . $classifiedTypeItem['id'] . '" ' . ( $post_data['join_classified_type'] == $classifiedTypeItem['id'] ? 'selected="selected"' : '' ) . '>' . 
								$classifiedTypeItem['name'] . 
								'</option>';

			$classifiedTypeFields[$classifiedTypeItem['id']] = $classifiedTypeItem['fields']; 
		}
		
	}
	
	$classifedTypeOp .= '</select>';
	 
	?>
	<div class="value"><?=$classifedTypeOp;?><!--<input name="join_classified_parent" value="<?= $post_data['join_classified_parent']?>" />--></div>
    <br style="clear:left" />

<?
///print_r($classifiedTypeFields);
$formOutput = "";
foreach( $classifiedTypeFields as $k => $v ){
	
		
	$formOutput .= '<div id="form_'.$k.'" class="contactForms"'  . ( $post_data['join_classified_type'] != $classifiedTypeItem['id'] ? 'style="display:none;"' : '' ) . '>';	
	
	$fieldsInputArray = explode(",", $classifiedTypeFields[$k]);
	$fieldsOutput = array();
	foreach( $fieldsInputArray as $k2 => $v2 ){
		// !22|Contact
		$temp = explode("|",$v2);
		
		$formOutput .= '<br style="clear:left" />';
		$formOutput .= '<div class="label"><strong>' . $temp[1] . '</strong></div>';
		$formOutput .= '<div class="value"><input type="text" name="contact[form_'.$k.']['.$temp[2].']" value="" /></div>';		
		$formOutput .= '<input type="hidden" name="contact[form_'.$k.'][fields]" value="'.$classifiedTypeFields[$k].'" />';		
	}

	
	
	$formOutput .= '</div>';
}
print $formOutput;
?>

<br style="clear:both;" />

<input type="button" name="goback" goto="step2" value="goback" class="goback" /> &nbsp; 
<input type="submit" name="submitted" value="Add Classified" class="goforward" />

</div>
	
	
	</form>
</div>
<script type="text/javascript"> 
	jQuery.noConflict();
	(function($) { 
	  $(function() {
		$(document).ready(function () {
			$("#join_classified_type").change(function(){
				$(".contactForms").hide();
				$("#form_"+$(this).val()).show();
			});
			$('input[name="goback"]').click(function(){
				$(this).parent().hide();
				
				$('.'+$(this).attr('goto')).show();
			});
		});
	  });
	})(jQuery);
</script>
</body>
</html>