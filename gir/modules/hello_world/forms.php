
<?php 

$adb = new Crud( );
$adb->CreateDbConnection( $_SESSION['_DATABASE_CONNECTION'] );

?>

<script language="javascript" type="text/javascript">
	var adb = {"app":{}};		
</script>

<script src="modules/<?php echo $defaultModule ?>/web/js/jquery-1.4.2.js" type="text/javascript"></script>
<script src="modules/<?php echo $defaultModule ?>/web/js/jquery-ui-1.7.1.custom.min.js" type="text/javascript"></script>
<script src="modules/<?php echo $defaultModule ?>/web/js/template.js" type="text/javascript"></script>
<script src="modules/<?php echo $defaultModule ?>/web/js/forms.js" type="text/javascript"></script>

<link type="text/css" href="modules/<?php echo $defaultModule ?>/web/css/forms.css" rel="stylesheet">


<form action="" method="post">
<h2>Define Object</h2>
	<label>Object Name:</label>
	<input type="text" name="label" />
	<br class="clearAll" />
	<label>Properties:</label>
	<span class = "addRow" title="Add Properties Row" destination="#properties" template="#propertiesRowTemplate">+</span>
	<ul id = "properties" class="rowList">
	</ul>

<input type="hidden" name="method" value="defineObject" />
<input name="submit" type="submit" value="Submit" />
</form>

	
<div id="propertiesRowTemplate" class="rowTemplate">
	<li class="propertiesRow">
		<span class="rowCount"></span>
		<input type="hidden" name="newProperty[]" value="date" />
		<input type="text" name="newProperty[]" />(Date)
		<input type="hidden" name="newProperty[]" value="number" />
		<input type="text" name="newProperty[]" />(number)
		<input type="hidden" name="newProperty[]" value="text" />
		<input type="text" name="newProperty[]" />(text)
	</li>
</div>

<?php 

$arrObjects = $adb->ReadAllObjects();

foreach ($arrObjects as $object) {
		$thisID = $object["id"];
		$thisLabel = $object["label"];
	?>
	
<form action="" method="post" template = "adPreview" class="templated">
<h2>Add <?php echo $thisLabel ?> Object</h2>
<?php 

$arrProperties = $adb->ReadAllRelationshipsByObjectID($thisID);
foreach ($arrProperties as $properties) {
		$propertyID = $properties["property_name_id"];
		
		$propertyName = $adb->ReadPropertyById($propertyID);
		//print_r($propertyName);
		?>

<label><?php echo $propertyName[0]['label'] ?></label>
<input type="hidden" name="propertyType[]" value="<?php echo $propertyID ?>" />
<input type="text" name="propertyValue[]" />

<?php
}

?>
<input type="hidden" name="objectId" value="<?php echo $thisID ?>" />
<input type="hidden" name="method" value="newObject" />
<input  name="submit" type="submit" value="Submit" />
</form>
	
	
	<?php 
	 
	 
	}

?>

	

