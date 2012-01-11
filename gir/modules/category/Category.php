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
											array("type"=>"join","label"=>"Join Category Type","field"=>"join_category_type"),
											array("type"=>"join","label"=>"Join Category Parent","field"=>"join_category_parent")
										);
	
	function __construct(){
		parent::__construct();
		foreach($this->_OBJECT_PROPERTIES as $p) {
			$this->{$p['field']} = "";
		}
	}
	
	public function addParent( $parentId = null ){
		$item = $this->GetCurrentItem();
		$category = $this->GetItem($parentId);
		$this->SetCurrentItem($item); // need to reset Current item back to the request
		if(count($category)>0){
			$category_join_property = null;
			$arr = $this->_OBJECT_PROPERTIES;
			$c = count($this->_OBJECT_PROPERTIES);
			$i = 0;
			while($i<$c){
				if( $arr[$i]['field'] == "join_category_parent" ){
					$category_join_property = $arr[$i]['property_name_id'];
					break;
				}
				$i++;
			}
			$this->AddValueJoin($item['id'], $category_join_property, $parentId);
		}
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
