<?
/* SPIT OUT THE PAGE BODY, OR AN ERROR PAGE */
include_once($_SERVER["DOCUMENT_ROOT"]."/views/shared/flash_panel.php");
(isset($PAGE_BODY) && !empty($PAGE_BODY) && file_exists($PAGE_BODY)) ? include($PAGE_BODY) : include($_SERVER["DOCUMENT_ROOT"]."/views/errors/bad_include.php");
?>
