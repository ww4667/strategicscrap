<?
	
$usePostOrGet = $_POST['classified_id'];		
if( !isset( $_POST['classified_id'] ) ){
	$usePostOrGet = $_GET['classified_id'];
}			

$updatedClassifiedArray = $updatedClassified->getAllWithUserDetails(array('classifiedId'=>$usePostOrGet,'showContacts'=>true,'classifiedType'=>true));

?>

<h1 style="margin:0;padding:0">Classified Manager // Update</h1>
<ul>
	<li><a href="<?= $ss_url ?>&amp;method=classified-manager">Back to Classified Manager</a></li>
</ul>
<br />


<div class="sectionBody order_details">
	<form action="<?=$ss_url?>&amp;method=classified-update" method="post">

	<input type="hidden" name="classified_id" value="<?= $updatedClassifiedArray[0]['id'] ?>" />
	<div class="label"><strong>Created On:</strong></div>
	<div class="value"><?= $updatedClassifiedArray[0]['created_ts'] ?></div>
    <br style="clear:left" />
	<div class="label"><strong>Updated On:</strong></div>
	<div class="value"><?= $updatedClassifiedArray[0]['updated_ts'] ?></div>
    <br style="clear:left" />
	<div class="label"><strong>Slug:</strong></div>
	<div class="value"><?= $updatedClassifiedArray[0]['slug'] ?></div>
    <br style="clear:left" />
    <br style="clear:left" />
	
	<div><strong>Classified Information:</strong><hr /></div>
	<div class="label"><strong>Expires:</strong></div>
	<div class="value"><input name="end_date" value="<?= $updatedClassifiedArray[0]['end_date'] ?>" style="width: 300px;"  /></div>
    
    <br style="clear:left" />
	<div class="label"><strong>Classified Title:</strong></div>
	<div class="value"><input name="title" value="<?= $updatedClassifiedArray[0]['title'] ?>" style="width: 300px;"  /></div>
    
    <br style="clear:left" />
	<div class="label"><strong>Classified Description:</strong></div>
	<div class="value"><textarea name="description" style="width: 300px; height:150px;"><?= $updatedClassifiedArray[0]['description'] ?></textarea></div>
    
    <br style="clear:left" />
    <!-- http://hacks.mozilla.org/2011/01/how-to-develop-a-html5-image-uploader/ -->
	<div class="label"><strong>Classified Image:</strong><br/>(upload new image)</div>
	<div class="value">
		<input name="image" type="hidden" value="<?= $updatedClassifiedArray[0]['image'] ?>" style="width: 300px;" />
		<input name="imagenew" type="file" value="<?= $updatedClassifiedArray[0]['image'] ?>" style="width: 300px;" />
	</div>
	
    
    <br style="clear:left" />
    <!-- http://hacks.mozilla.org/2011/01/how-to-develop-a-html5-image-uploader/ -->
	<div class="label"><strong>Current Classified Image:</strong></div>
	<div class="value">
		[<a id="preview_link" href="<?=$updatedClassifiedArray[0]['image']?>" target="_blank">Show Preview</a>]
		<br class="clear:both;" />
	</div>
	
    <br style="clear:left" />
	<div class="label"><strong>For Sale or Wanted?:<br/>(Check if it is a want ad.)</strong></div>
	<div class="value"><input type="checkbox" name="sale_or_wanted" value="1" <?= $updatedClassifiedArray[0]['sale_or_wanted'] == 1 ? 'checked="checked"' : "" ?> /></div>
    
    <br style="clear:left" />
	<div class="label"><strong>Paid:</strong></div>
	<div class="value"><input type="checkbox" name="approved" value="1" <?= $updatedClassifiedArray[0]['paid'] == 1 ? 'checked="checked"' : "" ?> /></div>
	
    <br style="clear:left" />
	<div class="label"><strong>Approved:</strong></div>
	<div class="value"><input type="checkbox" name="approved" value="1" <?= $updatedClassifiedArray[0]['approved'] == 1 ? 'checked="checked"' : "" ?> /></div>

    <br style="clear:left" />
	<div class="label"><strong>Featured Classified:</strong></div>
	<div class="value"><input type="checkbox" name="featured" value="1" <?= $updatedClassifiedArray[0]['featured'] == 1 ? 'checked="checked"' : "" ?> /></div>

    <br style="clear:left" />
	<div class="label"><strong>Classified Parent:</strong></div>
	<?
	
	$allCategories = new Category();
	$allCategoryObjects = $allCategories->GetAllItems();
	$allCategoryObjects = $allCategories->getAllCategoriesByHierarchy();
	
	$categoryListOp = '<select name="join_category_parent">';
	$categoryListOp .= '<option value="null">--Top Level--</option>';
	
	foreach( $allCategoryObjects as $categoryObject ){
		
		$categoryListOp .= '<option value="' . $categoryObject['id'] . '" ' . ( $updatedClassifiedArray[0]['category_id'] == $categoryObject['id'] ? 'selected="selected"' : '' ) . '>' . $categoryObject['slug'] . '</option>';
	    
	}
	
	$categoryListOp .= '</select>';
	 
	?>
	<div class="value"><?=$categoryListOp;?></div>
    <br style="clear:left" />


    <br style="clear:left" />
	<div class="label"><strong>Classified Type:</strong></div>
	<?
	
	$refClassifiedType = new ClassifiedType();
	$allClassifiedTypes = $refClassifiedType->GetAllItems();
	
	$classifiedTypeFields = array();
	
	$classifedTypeOp  = '<select name="join_classified_type" id="join_classified_type">';
	$classifedTypeOp .= '<option value="null">--Choose One--</option>';
	
	foreach( $allClassifiedTypes as $classifiedTypeItem ){
		
		if( $classifiedTypeItem['hidden'] != 1 ){
			$classifedTypeOp .= '<option value="' . $classifiedTypeItem['id'] . '" ' . ( $updatedClassifiedArray[0]['classifiedType_id'] == $classifiedTypeItem['id'] ? 'selected="selected"' : '' ) . '>' . 
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
		
	$formOutput .= '<div id="form_'.$k.'" class="contactForms" '. ( $updatedClassifiedArray[0]['classifiedType_id'] != $k ? 'style="display:none;"' : '' ) .' >';	
	
	$fieldsInputArray = explode(",", $classifiedTypeFields[$k]);
	$fieldsOutput = array();
	foreach( $fieldsInputArray as $k2 => $v2 ){
		// !22|Contact
		$temp = explode("|",$v2);
		
		$formOutput .= '<br style="clear:left" />';
		$formOutput .= '<div class="label"><strong>' . $temp[1] . '</strong></div>';
		$formOutput .= '<div class="value"><input type="text" name="contact[form_'.$k.']['.$temp[2].']" value="'.$updatedClassifiedArray[0]['contact_'.$temp[2]].'" /></div>';		
		$formOutput .= '<input type="hidden" name="contact[form_'.$k.'][fields]" value="'.$classifiedTypeFields[$k].'" />';		

	}

	
	
	$formOutput .= '</div>';
}
$formOutput .= '<input type="hidden" name="contact_id" value="'.$updatedClassifiedArray[0]['contact_id'].'" />';		
print $formOutput;
?>


    <br style="clear:left" />
    <br style="clear:left" />
	
	<p style="color:#F00">CAUTION: Removing this classified is permanent!</p>
	<input type="submit" name="submitted" value="Update Classified" />&nbsp;&nbsp;<input type="submit" name="remove" value="Remove Classified" />
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
		});
	  });
	})(jQuery);
</script>
