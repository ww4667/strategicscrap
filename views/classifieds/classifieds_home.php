<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

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
		float: right;
		width: 430px;
	}
	
	.image{
		float: left;
		width: 100px;
		height: 100px;
	}

	.image a {
		display: block;
		width: 100px;
		height: 100px;
		text-indent: -1000px;
	}
	
	.title{
		font-weight: bold;
		padding: 0 0 0 10px;
	}
	
	.description{
		padding: 0 0 0 10px;
	}
	
	a.active{
		color: #F96C14;
	}
	.post-wrapper {
		position: relative;
		top: -31px;
		float: right;
		right: 10px;
		font-size: 11px;
		text-align: center;
	}
	
	.filterLink.selected {
		color: #f90;
		font-weight: bold;
	}
	.classifieds-filter {
		display: block;
		position: relative;
		float: left;
		background: #BBB;
		padding: 4px 8px;
		border-radius: 4px;
		font-weight: 900;
		line-height: normal;
		top: 20px;
		left: 0px;
	}
	.classifieds-breadcrumbs {
		position: relative;
		float: left;
		margin: -10px 0 10px 10px;
		font-weight: 900;
		line-height: normal;
		clear: both;
	}
	.classifieds-category-wrapper ul.catList {
		font-size: 12px;
		font-weight: 900;
		color: black;
		margin-bottom: 10px;
	}
</style>

  <script type="text/javascript">
  $('document').ready(function() {
		$('#post_a_classified').hover(function(){ 
	       $(this).attr('src', '/resources/images/buttons/post_a_classified_hover.png'); 
		}, function(){ 
	       $(this).attr('src', '/resources/images/buttons/post_a_classified.png'); 
		});
  });
  </script>
	<div class="classifieds-filter">
	<a class="active" href="#">ALL</a> | <a href="#">FOR SALE</a> | <a href="#">WANTED</a>
	</div>

	<div class="post-wrapper">
		<div class="posting-button" style="padding: 0 0 4px 0">
		<a id="submitNewClassified" href="/controllers/remote?method=showClassifiedForm"><img src="/resources/images/buttons/post_a_classified.png" alt="post a classified"  id="post_a_classified" /></a>
		</div>
		<div class="posting-text">
			members: FREE; non-members: $35/listing
		</div>
	</div>
<div class="classifieds-breadcrumbs">
	<a class="active" href="#">ALL</a>&nbsp;/&nbsp;<a href="#">FOR SALE</a>&nbsp;/&nbsp;<a href="#">WANTED</a>
</div>
<div class="classifieds-category-wrapper">
	<ul class="catList">
	<li class="left">CATEGORY ONE</li>
	<li class="middle">CATEGORY TWO</li>
	<li class="right">CATEGORY THREE</li>
	<li class="left">CATEGORY FOUR</li>
	<li class="middle">CATEGORY FIVE</li>
	<li class="right">CATEGORY SIX</li>
	<li class="left">CATEGORY SEVEN</li>
	<li class="middle">CATEGORY EIGHT</li>
	<li class="right">CATEGORY NINE</li>
	<li class="left">CATEGORY TEN</li>
	<li class="middle">&nbsp;</li>
	<li class="right">&nbsp;</li>
	</ul>
</div>

<?

/**
 * check last item in list if its a classified or category
 */
 
$slug = $_GET['slug'];
$catSlug = $slug;
$filter = $_GET['filter'];
$url = $_SERVER['REQUEST_URI'];
$cleanURL = preg_replace('/\?.*/', '', $url);


$onClassified = false;
$classifiedsObject = new Classified();
$classifiedsArray = $classifiedsObject->findSlugsBySlug( '/'.$slug );

$onCategory = false;
$categoryObject = new Category();

if( count( $classifiedsArray ) > 0 ) {
	$onClassified = true;
	$classifiedsObject->getItemObj( $classifiedsArray[0]['id'] );
	$classifiedsObject->getCategory();
	$classifiedsObject->GetClassifiedType();
	$classifiedsObject->GetContact();
	$classifiedsArray[0]['join_classified_type'] = $classifiedsObject->join_classified_type;
	$classifiedsArray[0]['join_contact'] = $classifiedsObject->join_contact;
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

//
/*
$op .= '<a id="submitNewClassified" href="/controllers/remote?method=showClassifiedForm"><span>Create New Classified</span></a>';

	$refClassifiedType = new ClassifiedType();
	$allClassifiedTypes = $refClassifiedType->GetAllItems();
	
	$classifiedTypeFields = array();
	
	$op .= '<div class="filters">';
	
	foreach( $allClassifiedTypes as $classifiedTypeItem ){
		if( $classifiedTypeItem['hidden'] != 1 ){
			$op .= '<a href="'.$cleanURL.'?filter='.$classifiedTypeItem['id'].'" class="filterLink '.(isset($_GET['filter']) && $_GET['filter'] == $classifiedTypeItem['id'] ? 'selected' : '' ).'">'.$classifiedTypeItem['name'].'</a>&nbsp;|&nbsp;';
		}
		
	}
	
	$op .= '</div><br />';
*/


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
	
	function ranger($url){
	    $headers = array(
	    "Range: bytes=0-32768"
	    );
	
	    $curl = curl_init($url);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    return curl_exec($curl);
	    curl_close($curl);
	}
	
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
	
	$featuredItems = $classifiedsObject->getAllWithUserDetails( array( "approved"=>TRUE, "featured"=>TRUE, "categoryIds"=>$familyTree ) );
	
	if( count( $featuredItems ) > 0 ){
		$evenOrOdd = 0;
		$op .= '<div class="classifieds_group">';
			
		foreach( $featuredItems as $child ){
			/*$classifieds->PTS( $child );*/
			$op .= '<div class="classified_block ' . ( $evenOrOdd == 0 ? 'even' : 'odd' ) . ' ">';
			if( !empty( $child[ 'image' ] ) ) {
				
				// start image stuff		
				$url = "https://strategicscrap.com" . $child['image'];
				
				$raw = ranger($url);
				
				$im = imagecreatefromstring($raw);
				
				$width = imagesx($im);
				$height = imagesy($im);
				
				//width or height check
				$sencha_params = ($width > $height) ? "1000/100" : "100/1000";
				//end image stuff
				$op .= '	<div class="image" style="background:url(\'/inc/proxy.php?url=http://src.sencha.io/' . $sencha_params . '/https://strategicscrap.com' . $child['image'] . '\') no-repeat center center"><a href="/classifieds'  . $child['slug'] . '">' . $child['title'] . '</a></div>';
			}
			if( empty( $child[ 'image' ] ) ) $op .= '	<div class="image"><img src="/inc/proxy.php?url=http://src.sencha.io/100/100/https://strategicscrap.com/resources/images/image_not_available.gif" border="0" /></div>';
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
	$classifiedsObject = $classifieds->getAllWithUserDetails( array( "approved"=>TRUE, "featured"=>FALSE, "categoryIds"=>$familyTree ) );
	
	if( count( $classifiedsObject ) > 0 ){
	
		$op .= '<div class="classifieds_group">';
		foreach( $classifiedsObject as $child ){
			/*$classifieds->PTS( $child );*/	
			$op .= '<div class="classified_block ' . ( $evenOrOdd == 0 ? 'even' : 'odd' ) . ' ">';
			
//			$gir->crud->PTS($child, "child:");
//			die();
			
			if( !empty( $child[ 'image' ] ) ) {
				
				// start image stuff		
				
				$url = "https://strategicscrap.com" . $child['image'];
				
				$raw = ranger($url);
				
				$im = imagecreatefromstring($raw);
				
				$width = imagesx($im);
				$height = imagesy($im);
				
				//width or height check
				$sencha_params = ($width > $height) ? "1000/100" : "100/1000";
				//end image stuff
				$op .= '	<div class="image" style="background:url(\'/inc/proxy.php?url=http://src.sencha.io/' . $sencha_params . '/https://strategicscrap.com' . $child['image'] . '\') no-repeat center center"><a href="/classifieds'  . $child['slug'] . '">' . $child['title'] . '</a></div>';
			}
			if( empty( $child[ 'image' ] ) ) $op .= '	<div class="image"><img src="/inc/proxy.php?url=http://src.sencha.io/100/100/https://strategicscrap.com/resources/images/image_not_available.gif" border="0" /></div>';
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
	$classifiedsObject->PTS( $classifiedsArray );
	$classified = $classifiedsArray[0];
	$op .= "<h1>" . $classified['title'] . "</h1>";
	$op .= "<br />";
	$op .= '<div class="social">';
	$op .= '<div class="fb-like" data-href="https://strategicscrap.com' . $_SERVER['REQUEST_URI'] . '" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>';
	$op .= '<div class="g-plusone" data-size="small" data-annotation="none"></div>';
	$op .= '</div>';
	$op .= '<script type="text/javascript">';
	$op .= '  (function() {';
	$op .= "var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;";
    $op .= "po.src = 'https://apis.google.com/js/plusone.js';";
    $op .= "var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);";
	$op .= "})();";
	$op .= "</script>";
	
	$op .= '';
	$op .= '<img src="/inc/proxy.php?url=http://src.sencha.io/400/400/https://strategicscrap.com' . $classified['image'] . '" border="0" />';
	$op .= "<br />";
	$op .= "<strong>Description:</strong>";
	$op .= "<br />";
	$op .= str_replace("\n", "<br />", $classified['description']);
}


	/*
	 * might need to have your classified do this:
	 * $classifiedVariable->GetClassifiedType();
	 * */

	$fieldsInputArray = explode(",", $classified['join_classified_type'][0]['fields']);
	foreach( $fieldsInputArray as $k2 => $v2 ){
		// !22|Contact
		$temp = explode("|",$v2);
		
		$op .= '<strong>' . $temp[1] . '</strong>:&nbsp;' . $classified[ 'join_contact' ][0][ $temp[ 2 ] ] . '<br />';
				
	}
	print $op;
	
?>

<script type="text/javascript">
    $(function ()
    {
        $("#submitNewClassified").colorbox({iframe:true, innerWidth:500, innerHeight:450});    
    })
</script>