<?
/* SPIT OUT THE PAGE BODY, OR AN ERROR PAGE */
include_once $mod_path.'views/manager/manager_header.php';
include_once $mod_path.'views/manager/manager_menu.php';
(isset($PAGE_BODY) && !empty($PAGE_BODY) && file_exists($PAGE_BODY)) ? include($PAGE_BODY) : include($mod_path."views/errors/bad_include.php");
include_once $mod_path.'views/manager/manager_footer.php'; 
?>