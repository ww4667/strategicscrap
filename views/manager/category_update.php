
<?
$categoryChildren = $updatedCategory->ReadForeignJoins( $updatedCategory );

$classifiedJoinClass = new Classified();
$relatedClassifieds = $classifiedJoinClass->ReadForeignJoins( $updatedCategory );

?>

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
	<div class="label"><strong>Id Path:</strong></div>
	<div class="value"><?= $updatedCategory->id_path ?></div>
    <br style="clear:left" />
	<div class="label"><strong>Slug:</strong></div>
	<div class="value"><?= urldecode( $updatedCategory->slug ) ?></div>
    <br style="clear:left" />
    <br style="clear:left" />
	
	<div><strong>Category Information:</strong><hr /></div>
	<div class="label"><strong>Category Name:</strong></div>
	<div class="value"><input name="name" value="<?= $updatedCategory->name ?>" /><input type="hidden" name="old_name" value="<?= $updatedCategory->name ?>" /></div>
	<br style="clear:left" />
	<input type="hidden" name="old_join_category_parent" value="<?= $updatedCategory->join_category_parent[0]['id'] ?>" />
	<div class="label"><strong>Category Parent:</strong></div>
	<?
	
	$allCategories = new Category();
	$allCategoryObjects = $allCategories->getAllCategoriesByHierarchy();
	
	$categoryListOp = '<select name="join_category_parent">';
	$categoryListOp .= '<option value="null">--Top Level--</option>';
	
	foreach( $allCategoryObjects as $categoryObject ){
		
		$categoryListOp .= '<option value="' . $categoryObject['id'] . '" ' . ( $categoryObject['id'] == $updatedCategory->join_category_parent[0]['id'] ? 'selected="selected"' : "" ) . '>' . urldecode( $categoryObject['slug'] ) . '</option>';
	    
	}
	
	$categoryListOp .= '</select>';
	 
	?>
	<div class="value"><?=$categoryListOp;?><!--<input name="join_category_parent" value="<?= $post_data['join_category_parent']?>" />--></div>
    <br style="clear:left" />
    <br style="clear:left" />
	
	<p style="color:#F00">CAUTION: Removing this category will remove all connected records in the database.</p>
	<? if( count( $categoryChildren ) > 0 ) { ?><p style="color:#F00">CAUTION: You will not be able to remove this category until you remove categories below this level.</p><? } ?>
	<? if( count( $relatedClassifieds ) > 0 ) { ?><p style="color:#F00">CAUTION: You have <?=count( $relatedClassifieds )?> classifieds associated to this category. You must remove those before you can delete this category.</p><? } ?>
	
	<input type="submit" name="submitted" value="Update Category" />&nbsp;&nbsp;
	<input type="submit" name="remove" <?= count( $categoryChildren ) > 0 ? 'disabled="disabled"' : '' ?> <?= count( $relatedClassifieds ) > 0 ? 'disabled="disabled"' : '' ?> value="Remove Category" />
	</form>
</div>