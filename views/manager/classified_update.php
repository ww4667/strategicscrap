<?
			
$usePostOrGet = $_POST['classified_id'];		
if( !isset( $_POST['classified_id'] ) ){
	$usePostOrGet = $_GET['classified_id'];
}			
			$updatedClassifiedArray = $updatedClassified->getAllWithUserDetails($usePostOrGet);
			

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
	<div class="label"><strong>Classified Image:</strong></div>
	<div class="value">
		<input name="image" type="file" value="<?= $updatedClassifiedArray[0]['image'] ?>" style="width: 300px;" />
		<br class="clear:both;" />
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
	<div class="label"><strong>Associated Scrapper:</strong></div>
	<?
	
	$allScrappers = new Scrapper();
	$allScrapperObjects = $allScrappers->GetAllItems();
	
	$scrapperListOp = '<select name="join_scrapper">';
	$scrapperListOp .= '<option value="null">--Top Level--</option>';
	
	foreach( $allScrapperObjects as $scrapperObject ){
		
		$scrapperListOp .= '<option value="' . $scrapperObject['id'] . '" ' . ( $updatedClassifiedArray[0]['scrapper_id'] == $scrapperObject['id'] ? 'selected="selected"' : '' ) . '>' . 
							$scrapperObject['company'] . ' - ' . $scrapperObject['first_name'] . ' ' . $scrapperObject['last_name'] . 
							'</option>';
	    
	}
	
	$scrapperListOp .= '</select>';
	 
	?>
	<div class="value"><?=$scrapperListOp;?></div>
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
	
	<p style="color:#F00">CAUTION: Removing this classified is permanent!</p>
	<input type="submit" name="submitted" value="Update Classified" />&nbsp;&nbsp;<input type="submit" name="remove" value="Remove Classified" />
	</form>
</div>