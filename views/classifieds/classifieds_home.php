<style type="text/css">
	.content ul.catList { margin: 0; padding: 0; float: left; margin-left: 0; margin-right:0; margin-bottom: 0; width: 100%; }
	
	.content ul.catList li { margin: 0; padding: 0 0 0 10px; list-style: none; margin-left: 0; margin-right:0; margin-bottom: 0; width: 30%; }
	
	.left{
		 clear: both;
		 float: left;
	}
	.middle{
		float: left;
		border-left: 1px solid #777;
	}
	.right{
		float: left;
		border-left: 1px solid #777;
	}
	.clearBoth{ clear: both; }
	
	.classifieds_group{
		float: left;
		width: 95%;
	}
	
	.classified_block{
		float: left;
		padding: 10px;
		width: 100%;
	}
	
	.classified_block.even { background: #efefef; }
	.classified_block.odd { background: #ccc; }
	
	.description_block{
		float: left;
	}
	
	.image{
		float: left;
		width: 150px;
		text-align: center;
	}
	
	.title{
		font-weight: bold;
		padding: 0 0 0 10px;
	}
	
	.description{
		padding: 0 0 0 10px;
	}
	
	a.active{
		color: #ff9900;
	}
</style>

<?

/**
 * check last item in list if its a classified or category
 */

 
 
$slug = $_GET['slug'];
$catSlug = $slug;

$onClassified = false;
$classifiedsObject = new Classified();
$classifiedsArray = $classifiedsObject->findSlugsBySlug( '/'.$slug );

$onCategory = false;
$categoryObject = new Category();

if( count( $classifiedsArray ) > 0 ) {
	$onClassified = true;
	$classifiedsObject->getItemObj( $classifiedsArray[0]['id'] );
	$classifiedsObject->getCategory();
	/*$classifiedsObject->PTS( $classifiedsObject, '$classifiedsObject' );*/
	
	$categoryObject->getItemObj( $classifiedsObject->join_category[0]['id'] );
	$categoryObject->getParentCategory();
	/*$categoryObject->PTS( $categoryObject, '$categoryObject' );	*/
} else {
	$onCategory = true;
	$categoryArray = $categoryObject->findSlugsBySlug( '/'.$slug );
	
	$categoryObject->getItemObj( $categoryArray[0]['id'] );
	$categoryObject->getParentCategory();
	/*$categoryObject->PTS( $categoryObject, '$categoryObject2' );*/	
}

$op = "";

$i = 0;
$slugArray = explode( ",", $categoryObject->id_path );
$count = count( $slugArray );
$tempSlug = null;

if( $count > 1 ){
	foreach( $slugArray as $link ){
		$tempSlug = $categoryObject->getItem( $link );
		if( $i > 0 ) $op .= "&nbsp;/&nbsp";
		$op .= '<a class="floatleft ' . ( $onClassified ? "" : $count - 1 == $i ? "active" : "" ) . '" href="/classifieds' . $tempSlug['slug'] . '">' . ( $i == 0 ? "Home" : $tempSlug['name'] ) . '</a>';
		$i++;
	}

	/*if( $onClassified ) $op .= '&nbsp;/&nbsp<a class="floatleft active" href="/classifieds' . $classifiedsObject->slug . '">' . $classifiedsObject->title . '</a>';*/

	$op .= '<hr style="clear: both;" />';
}

if( $onCategory ){
	
	$category_id = $categoryArray[0]['id'];
	
	$currentCategory = $categoryObject->GetItemObj( $category_id );
	$categoryObject->getParentCategory();
	$categories = $categoryObject->getCategoryChildren( $category_id );
	
	if( count( $categories ) > 0 ){
		$op .= '<ul class="catList">';
		$colCounter = 0;
		$class = array( 'left', 'middle', 'right' );
		foreach( $categories as $categoryLink ){
			$op .= '	<li class="' . $class[ $colCounter ] . ' "><a href="/classifieds' . $categoryLink['slug'] . '">' . $categoryLink['name'] . '</a></li>';
			$colCounter++;
			if( $colCounter > 2 ) $colCounter = 0;	
		}
		$op .= "</ul>";
		
		$op .= '<hr style="clear: both;" />';
	}

	/*$categoryObject->PTS( $categoryObject->getYourFamilyIds(), "FAMILY FOR " . $categoryObject->name );*/
	$familyTree = $categoryObject->getYourFamilyIds();
	
	$featuredItems = $classifiedsObject->getAllWithUserDetails( null, TRUE, TRUE, null,  $familyTree );
	
	if( count( $featuredItems ) > 0 ){
		$evenOrOdd = 0;
		$op .= '<div class="classifieds_group">';
		foreach( $featuredItems as $child ){
			/*$classifieds->PTS( $child );*/	
			$op .= '<div class="classified_block ' . ( $evenOrOdd == 0 ? 'even' : 'odd' ) . ' ">';
			if( !empty( $child[ 'image' ] ) ) $op .= '	<div class="image"><img src="http://src.sencha.io/100/100/' . $child['image'] . '" border="0" /></div>';
			if( empty( $child[ 'image' ] ) ) $op .= '	<div class="image"><img src="http://src.sencha.io/100/100/https://strategicscrap.com/resources/images/image_not_available.gif" border="0" /></div>';
			$op .= '	<div class="description_block">';
			$op .= '		<div class="title"><a href="/classifieds'  . $child['slug'] . '">' . $child['title'] . '</a></div>';
			$op .= '		<div class="clearBoth description">' . $child['description'] . '</div>';
			$op .= '	</div>';
			$op .= '</div>';
			$op .= '<br class="clearBoth" />';
			$evenOrOdd = ( $evenOrOdd == 0 ? 1 : 0 );
		}
		$op .= "</div>";
		$op .= '<hr style="clear: both;" />';
		
	} else {
	
		$op .= "<!--No Featured Classifieds found.-->";
		
	}
			
		
		
	
	$evenOrOdd = 0;
	$classifieds = new Classified();
	$classifiedsObject = $classifieds->getAllWithUserDetails( null, TRUE, FALSE, $category_id );
	
	if( count( $classifiedsObject ) > 0 ){
	
		$op .= '<div class="classifieds_group">';
		foreach( $classifiedsObject as $child ){
			/*$classifieds->PTS( $child );*/	
			$op .= '<div class="classified_block ' . ( $evenOrOdd == 0 ? 'even' : 'odd' ) . ' ">';
			if( !empty( $child[ 'image' ] ) ) $op .= '	<div class="image"><img src="http://src.sencha.io/100/100/' . $child['image'] . '" border="0" /></div>';
			if( empty( $child[ 'image' ] ) ) $op .= '	<div class="image"><img src="http://src.sencha.io/100/100/https://strategicscrap.com/resources/images/image_not_available.gif" border="0" /></div>';
			$op .= '	<div class="description_block">';
			$op .= '		<div class="title"><a href="/classifieds'  . $child['slug'] . '">' . $child['title'] . '</a></div>';
			$op .= '		<div class="clearBoth description">' . $child['description'] . '</div>';
			$op .= '	</div>';
			$op .= '</div>';
			$op .= '<br class="clearBoth" />';
			$evenOrOdd = ( $evenOrOdd == 0 ? 1 : 0 );
		}
		$op .= "</div>";
		
	} else {
	
		if( count( $featuredItems ) == 0 ) $op .= "<strong>No Classifieds are in this category.</strong>";
		
	}	
			
}

	
if( $onClassified ){
	/*$classifiedsObject->PTS( $classifiedsArray );*/
	$classified = $classifiedsArray[0];
	$op .= "<h1>" . $classified['title'] . "</h1>";
	$op .= "<br />";
	$op .= '<img src="http://src.sencha.io/100/100/' . $classified['title'] . '" border="0" />';
	$op .= "<br />";
	$op .= "<strong>Description:</strong>";
	$op .= "<br />";
	$op .= str_replace("\n", "<br />", $classified['description']);
}

	print $op;

?>
