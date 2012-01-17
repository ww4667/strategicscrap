 <h1 style="margin:0;padding:0">Classified // Add</h1>
<ul>
	<li><a href="<?= $ss_url ?>&amp;method=classified-manager">Back to Classified Manager</a></li>
</ul>
<br />
 
<div class="sectionHeader">Adding Classified:</div>
<div class="sectionBody order_details">
	<form action="<?=$ss_url?>&amp;method=classified-add" method="post"  enctype="multipart/form-data">
	<div><strong>Classified Information:</strong><hr /></div>
	<div class="label"><strong>Expires (yyyy-mm-dd):</strong></div>
	<div class="value"><input name="end_date" value="<?=isset( $post_data['end_date'] ) == true && $post_data['end_date'] != '' ? $post_data['end_date'] : '' . date("Y-m-d", strtotime("+30 day")); ?>" style="width: 300px;" /></div>
    <br style="clear:left" />
	<div class="label"><strong>Classified Title:</strong></div>
	<div class="value"><input name="title" value="<?= $post_data['title']?>" style="width: 300px;" /></div>
    <br style="clear:left" />
	<div class="label"><strong>Classified Description:</strong></div>
	<div class="value"><textarea rows="10" cols="25" name="description" style="width: 300px; height: 150px;"><?= $post_data['description']?></textarea></div>
    <br style="clear:left" />
	<div class="label"><strong>Classified Image:</strong></div>
	<div class="value"><input type="file" name="image" style="width: 300px;" value="<?= $post_data['image']?>" /></div>
    <br style="clear:left" />
	<div class="label"><strong>Featured Classified:</strong></div>
	<div class="value"><input type="checkbox" name="featured" value="<?= $post_data['featured']?>" /></div>
    
    <br style="clear:left" />
	<div class="label"><strong>For Sale or Wanted?:<br/>(Check if it is a want ad.)</strong></div>
	<div class="value"><input type="checkbox" name="sale_or_wanted" value="<?= $post_data['sale_or_wanted']?>" /></div>
    

    <br style="clear:left" />
	<div class="label"><strong>Associated Scrapper:</strong></div>
	<?
	
	$allScrappers = new Scrapper();
	$allScrapperObjects = $allScrappers->GetAllItems();
	
	$scrapperListOp = '<select name="join_scrapper">';
	$scrapperListOp .= '<option value="null">--Top Level--</option>';
	
	foreach( $allScrapperObjects as $scrapperObject ){
		
		$scrapperListOp .= '<option value="' . $scrapperObject['id'] . '" ' . ( $post_data['join_scrapper'] == $scrapperObject['id'] ? 'selected="selected"' : '' ) . '>' . 
							$scrapperObject['company'] . ' - ' . $scrapperObject['first_name'] . ' ' . $scrapperObject['last_name'] . 
							'</option>';
	    
	}
	
	$scrapperListOp .= '</select>';
	 
	?>
	<div class="value"><?=$scrapperListOp;?><!--<input name="join_classified_parent" value="<?= $post_data['join_classified_parent']?>" />--></div>
    <br style="clear:left" />

	<div class="label"><strong>Classified Parent:</strong></div>
	<?
	
	$allCategories = new Category();
	$allCategoryObjects = $allCategories->GetAllItems();
	
	$categoryListOp = '<select name="join_category_parent">';
	$categoryListOp .= '<option value="null">--Top Level--</option>';
	
	foreach( $allCategoryObjects as $categoryObject ){
		
		$categoryListOp .= '<option value="' . $categoryObject['id'] . '" ' . ( $post_data['join_category_parent'] == $categoryObject['id'] ? 'selected="selected"' : '' ) . '>' . $categoryObject['name'] . '</option>';
	    
	}
	
	$categoryListOp .= '</select>';
	 
	?>
	<div class="value"><?=$categoryListOp;?><!--<input name="join_classified_parent" value="<?= $post_data['join_classified_parent']?>" />--></div>
    <br style="clear:left" />
    <br style="clear:left" />
	
	<input type="submit" name="submitted" value="Add Classified" />
	</form>
</div>