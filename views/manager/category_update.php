<h1 style="margin:0;padding:0">Category Manager // Update</h1>
<ul>
	<li><a href="<?= $ss_url ?>&amp;method=category-manager">Back to Category Manager</a></li>
</ul>
<br />

<div class="sectionHeader">Updating Category ID: <?= $updatedCategory->id ?></div>
<div class="sectionBody order_details">
	<form action="<?=$ss_url?>&amp;method=category-update" method="post">
	<input type="hidden" name="category_id" value="<?= $updatedCategory->id ?>" />
	<div class="label"><strong>Created On:</strong></div>
	<div class="value"><?= $updatedCategory->created_ts ?></div>
    <br style="clear:left" />
	<div class="label"><strong>Updated On:</strong></div>
	<div class="value"><?= $updatedCategory->updated_ts ?></div>
    <br style="clear:left" />
    <br style="clear:left" />
	
	<div><strong>Category Information:</strong><hr /></div>
	<div class="label"><strong>Category Name:</strong></div>
	<div class="value"><input name="name" value="<?= $updatedCategory->name ?>" /></div>
	<br style="clear:left" />
	<div class="label"><strong>Category Parent:</strong></div>
	<?
	
	$allCategories = new Category();
	$allCategoryObjects = $allCategories->GetAllItems();
	
	$categoryListOp = '<select name="join_category_parent">';
	$categoryListOp .= '<option value="null">--Top Level--</option>';
	
	foreach( $allCategoryObjects as $categoryObject ){
		
		$categoryListOp .= '<option value="' . $categoryObject['id'] . '" ' . ( $categoryObject['id'] == $updatedCategory->join_category_parent[0]['id'] ? 'selected="selected"' : "" ) . '>' . $categoryObject['name'] . '</option>';
	    
	}
	
	$categoryListOp .= '</select>';
	 
	?>
	<div class="value"><?=$categoryListOp;?><!--<input name="join_category_parent" value="<?= $post_data['join_category_parent']?>" />--></div>
    <br style="clear:left" />
    <br style="clear:left" />
	
	<p style="color:#F00">CAUTION: Removing this category will remove all connected records in the database.</p>
	<input type="submit" name="submitted" value="Update Category" />&nbsp;&nbsp;<input type="submit" name="remove" value="Remove Category" />
	</form>
</div>