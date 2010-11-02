<?php
require_once("./include/common.php");

date_default_timezone_set('America/Chicago');

$script_tz = date_default_timezone_get();

if (strcmp($script_tz, ini_get('date.timezone'))){
    echo 'Script timezone differs from ini-set timezone.';
} else {
    echo 'Script timezone and ini-set timezone match.';
}

/**/
// $db1 = Mysql::getInstance('localhost', 'jlabresh_awesomedb', 'jlabresh_mrkelly', 'MAY!%2010');/**/
$db1 = Mysql::getInstance('localhost', 'awesomedb', 'root', 'root');/**/

$adb = new Awesome( );
$adb->Connect( $db1 );

print "<hr><h3>DefineObject</h3>";
$newObject = $adb->DefineObject("user",array('username', 'email', 'name'));
print '<blockquote>$newObject = $adb->DefineObject("user",array("username", "email", "name"));</blockquote>';
print "<pre>";
print_r( $newObject );
print "</pre>";

print "<hr><h3>AddValueDate</h3>";
$newObject = $adb->AddValueDate( 1, 5, "September 21 1980" );
print '<blockquote>$newObject = $adb->AddValueDate( 1, 5, "September 21 1980" );</blockquote>';
print "<pre>";
print_r( $newObject );
print "</pre>";

print "<hr><h3>GetAllProperties</h3>";
$properties = $adb->GetAllProperties();
print "<pre>";
print_r( $properties );
print "</pre>";

print "<hr><h3>GetAllObjects</h3>";
$objects = $adb->GetAllObjects();
print "<pre>";
print_r( $objects );
print "</pre>";

print "<hr><h3>GetAllRelationships</h3>";
$relationships = $adb->GetAllRelationships();
print "<pre>";
print_r( $relationships );
print "</pre>";

print "<hr><h3>GetPropertyById</h3>";
$propertyById = $adb->GetPropertyById( 3 );
print "<pre>";
print_r( $propertyById );
print "</pre>";

print "<hr><h3>GetPropertyByName</h3>";
$propertyByName = $adb->GetPropertyByName( 'email' );
print "<pre>";
print_r( $propertyByName );
print "</pre>";

print "<hr><h3>GetPropertyByName - does not exist</h3>";
print '<blockquote>GetPropertyByName( "snorfblat" )</blockquote>';
$propertyByName = $adb->GetPropertyByName( 'snorfblat' );
print "<pre>";
print_r( $propertyByName );
print "</pre>";

print "<hr><h3>GetObjectNameById</h3>";
$propertyById = $adb->GetObjectById( 1 );
print "<pre>";
print_r( $propertyById );
print "</pre>";

print "<hr><h3>GetObjectNameByName</h3>";
$propertyByName = $adb->GetObjectByName( 'user' );
print "<pre>";
print_r( $propertyByName );
print "</pre>";

print "<hr><h3>AddObject</h3>";
$newObject = $adb->AddObject( 1 );
print "<pre>";
print_r( $newObject );
print "</pre>";

/**/
/*
$db1->Open();
$result = $db1->Query("SELECT * FROM objects");
$arr1 = $db1->FetchArray($result);

echo '<pre>';
print_r($arr1);
echo '</pre>';
*/
?>

<?php
 /*
// full path to text file
define("TEXT_FILE", "/apache/logs/error.log");
// number of lines to read from the end of file
define("LINES_COUNT", 10);


function read_file($file, $lines) {
    //global $fsize;
    $handle = fopen($file, "r");
    $linecounter = $lines;
    $pos = -2;
    $beginning = false;
    $text = array();
    while ($linecounter > 0) {
        $t = " ";
        while ($t != "\n") {
            if(fseek($handle, $pos, SEEK_END) == -1) {
                $beginning = true;
                break;
            }
            $t = fgetc($handle);
            $pos --;
        }
        $linecounter --;
        if ($beginning) {
            rewind($handle);
        }
        $text[$lines-$linecounter-1] = fgets($handle);
        if ($beginning) break;
    }
    fclose ($handle);
    return array_reverse($text);
}

$fsize = round(filesize(TEXT_FILE)/1024/1024,2);

echo "<strong>".TEXT_FILE."</strong>\n\n";
echo "File size is {$fsize} megabytes\n\n";
echo "Last ".LINES_COUNT." lines of the file:\n\n";

$lines = read_file(TEXT_FILE, LINES_COUNT);
foreach ($lines as $line) {
    echo $line;
}
*/
?>