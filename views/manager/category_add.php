 <h1 style="margin:0;padding:0">Category // Add</h1>
<ul>
	<li><a href="<?= $ss_url ?>&amp;method=category-manager">Back to Category Manager</a></li>
</ul>
<br />

<div class="sectionHeader">Adding Category:</div>
<div class="sectionBody order_details">
	<form action="<?=$ss_url?>&amp;method=category-add" method="post">
	
	<div><strong>Category Information:</strong><hr /></div>
	<div class="label"><strong>Category Name:</strong></div>
	<div class="value"><input name="name" value="<?= $post_data['name']?>" /></div>
    <br style="clear:left" />
	<div class="label"><strong>Category Parent:</strong></div>
	<?
	
	
	$allCategoryObjects = $newCategory->getAllCategoriesByHierarchy();
	
	$categoryListOp = '<select name="join_category_parent">';
	$categoryListOp .= '<option value="null">--Top Level--</option>';
	
	foreach( $allCategoryObjects as $categoryObject ){
		$categoryListOp .= '<option value="' . $categoryObject['id'] . '">' . $categoryObject['slug'] . '</option>';
	}
	
	$categoryListOp .= '</select>';
	 
	?>
	<div class="value"><?=$categoryListOp;?></div>
    <br style="clear:left" />
    <br style="clear:left" />
	
	<input type="submit" name="submitted" value="Add Category" />
	</form>
</div>