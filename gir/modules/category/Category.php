<?php 
/**
 * 
 * @author undead
 *
 */
class Category extends Crud {
	 
	protected $_OBJECT_NAME = "category";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(	array("type"=>"text","label"=>"Name","field"=>"name"),
											array("type"=>"text","label"=>"Slug","field"=>"slug"),
											array("type"=>"text","label"=>"Id Path","field"=>"id_path"),
											array("type"=>"join","label"=>"Join Category Parent","field"=>"join_category_parent")
										);
	
	function __construct(){
		parent::__construct();
		foreach($this->_OBJECT_PROPERTIES as $p) {
			$this->{$p['field']} = "";
		}
	}
	
	public function findSlugsBySlug( $slug = '' ){
		$category_query = $this->GetObjectQueryString();
		
		$join_table = $this->_TABLE_PREFIX . constant('Crud::_VALUES_TABLE_JOINS');
		$query = "SELECT ";
		$query .= " cat.* ";
		$query .= " FROM ";
		$query .= " ($category_query) AS cat ";
		$query .= " WHERE cat.slug = '$slug' ";
		
		return $this->Query( $query, true );
	}
	
	public function addParentCategory( $parentId = null, $process = true ){
		$currentCategory = $this->GetCurrentItem();
		$parentCategory = $this->GetItem($parentId);
		$this->SetCurrentItem($currentCategory); // need to reset Current item back to the request
		
		$join_category_parent = $this->ReadPropertyByName( 'join_category_parent' );
		$id_path = $this->ReadPropertyByName( 'id_path' );
		$slug = $this->ReadPropertyByName( 'slug' );
		
		$cleanName = cleanSlug( $currentCategory['name'] );
		 
		/**
		 * MAKE A FUNCTION that cleans up the name
		 */
		$slug_op = ( !empty( $parentCategory['slug'] ) ? $parentCategory['slug'] : '' ) . '/' . $cleanName;
		$id_path_op = ( !empty( $parentCategory['id_path'] ) ? $parentCategory['id_path'] . ',' : '' ) .  $currentCategory['id'];
		
		if( $process ){		
			if( count( $join_category_parent ) ){
				$this->UpdateValueJoin( $currentCategory['id'], $join_category_parent['id'], $parentId);
			} else {
				$this->AddValueJoin( $currentCategory['id'], $join_category_parent['id'], $parentId);
			}
					
			if( !empty( $currentCategory['slug'] ) ){
				print "<br/>update slug";
				print '<br>' . $slug_op;
				$this->UpdateValueText( $currentCategory['id'], $slug['id'], $slug_op );
			} else {
				print "add slug";
				$this->AddValueText( $currentCategory['id'], $slug['id'], $slug_op );
			}
					
			if( !empty( $currentCategory['id_path'] ) ){
				print "<br/>update path";
				print '<br>' . $id_path_op;
				$this->UpdateValueText( $currentCategory['id'], $id_path['id'], $id_path_op );
			} else {
				print "add path";
				$this->AddValueText( $currentCategory['id'], $id_path['id'], $id_path_op );		
				}
		} else {
			return $slug_op;
		}
	}
	
	
	public function getParentCategory( $itemId = null ) {
		// get materials by "itemId" and join type "material_join"
		$item = $this->GetCurrentItem();
		$itemId = isset($itemId) ? $itemId : $item['id'];
		$category = new Category();
		$joins = $this->ReadJoins( $category );
		$this->join_category_parent = $joins;
	}
	
	public function removeCategory( $categoryId = null ){
		/* TODO: revisit this */
	}
	
	public function getCategoryParent( $itemId = null ) {
		// get materials by "itemId" and join type "material_join"
		$item = $this->GetCurrentItem();
		$itemId = $item['id'];
		$category = new Category();
		$joins = $this->ReadJoins( $category );
		$this->material_join = $joins;
	}
	
	public function getCategoryChildren( $categoryId ) {
		// get facilities by materialId and join type "material_join"
		$m = new Category();
		$category = $m->GetItemObj( $categoryId );
		$items = $this->ReadForeignJoins( $category );
		return $items;
	}
	
	public function getAllCategoriesByHierarchy(  ) {
		$category_query = $this->GetObjectQueryString();
		
		$join_table = $this->_TABLE_PREFIX . constant('Crud::_VALUES_TABLE_JOINS');
		$query = "SELECT ";
		/**
		 * ,COALESCE(c.approved, 0) as approved
		 * ,COALESCE will check for a null and 0 and will return 0 - this is a super fast function!
		 */
		$query .= " cat.* ";
		$query .= " FROM ";
		$query .= " ($category_query) AS cat ";
		$query .= " ORDER BY cat.slug     ";
		
		return $this->Query( $query, true );
	}	
	
	
	/**
	 * this could get us the recursive update
	 */
	public function updateYourFamily( $de = "" ){
		/*$this->PTS( $this );*/
		$joins = $this->ReadForeignJoins( $this );
		$de = $de . "-";
		$op = "";
		
		foreach( $joins as $join ){
			$tempCat = new Category();
			$tempCat->getItemObj( $join['id'] );
			$op .= $de . $tempCat->name;
			$op .= $tempCat->getYourFamily( $de . "<br />" );
		}
		
		return $op;
	}
	
	public function getYourFamilyIds( $first = true ){
		/*$this->PTS( $this );*/
		$joins = $this->ReadForeignJoins( $this );
		$op = "";
		if( $first ) $op .= $this->id;
		foreach( $joins as $join ){
			$tempCat = new Category();
			$tempCat->getItemObj( $join['id'] );
			$op .= "," . $tempCat->id;
			$op .= $tempCat->getYourFamilyIds( false );
		}
		
		return $op;
	}
	
	
	/*
	
		public function getMaterials( $itemId = null ) {
			// get materials by "itemId" and join type "material_join"
			$item = $this->GetCurrentItem();
			$itemId = isset($itemId) ? $itemId : $item['id'];
			$material = new Material();
			$joins = $this->ReadJoins( $material );
			$this->join_material = $joins;
		}*/
	
	
	public function getItemsByCategoryIdAndType( $categoryId ){
		// get facilities by materialId and join type "material_join"
		/* TODO: update this to get children by type */
		$c = new Category();
		$category = $c->GetItemObj( $categoryId );
		$items = $this->ReadForeignJoins( $category );
		return $items;
	}
	
	public function getAllParentsByType( $categoryType ){
		// get facilities by materialId and join type "material_join"
		/* TODO: update this to get children by type */
		$ct = new CategoryType();
		$category = $c->GetItemObj( $categoryId );
		$items = $this->ReadForeignJoins( $categoryType );
		return $items;
	}
}
?>
