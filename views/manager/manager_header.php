<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title><?= $PAGE_TITLE?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="media/style/MODxCarbon/style.css" />
    <link rel="stylesheet" type="text/css" href="/assets/js/datepicker_vista/datepicker_vista.css" />
    <script type="text/javascript" src="/assets/js/mootools-1.2-core-nc.js"></script>
	<script type="text/javascript" src="/assets/js/sorting_table.js"></script>
	<script type="text/javascript" src="/assets/js/paginating_table.js"></script>
	<script type="text/javascript" src="/assets/js/datepicker.js"></script>
	<script type="text/javascript" src="/assets/plugins/tinymce3241/jscripts/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript" src="/assets/js/jquery.min.js"></script>
	<script>
		 var $j = jQuery.noConflict();
	</script>
	<script type="text/javascript">
		tinyMCE.init({
			mode : "specific_textareas",
			editor_selector : "mceEditor",
			theme : "advanced",
			theme_advanced_disable : "styleselect,image,visualaid,help,cleanup,anchor,indent,outdent,justifyleft,justifycenter,justifyright,justifyfull"
		});
	</script>
	<style type="text/css">
		th, tr td { font-size:10px; }
		table tr.alt { background:#E9F0F3; }
		.forward_sort { background:#DDD; }
		.reverse_sort { background:#BBB; }
		ul.pagination { margin:0; padding:0; list-style:none; }
		ul.pagination li { margin:0; padding:0 0 2px 0; float:left; list-style:none; }
		ul.pagination li a { padding:1px 3px 3px 3px; display:block; text-decoration:none; }
		ul.pagination li a.currentPage { color:#000; font-weight:700; }
		.message { padding:10px; background:#D9FFB2; border:solid 1px #667F4C; color:#3E4C2E; }
		.message.error { background:#E5C3C3; border:solid 1px #E98181; color:#781D1D; }
		.sectionBody.order_details .label { width:110px;padding-right:20px;display:block;float:left; }
		#url_key_wrap { width:500px;position:relative;float:left;padding:10px 0 0 0}
		#url_key_wrap p { position:relative;float:left;width:150px;text-align:right;font-size:13px}
		#url_key_wrap input { position:relative;float:left;width:150px;}
		
		.sectionBody.order_details .value { display:block;float:left; }
		/****** base classes for forms ***************/
		ol.form  { position:relative;float:left;width:100%;margin:10px 0 0 0;border:none } 
		ol.form li { position:relative;float:left;width:100%;margin:0 0 20px 0;list-style:none }
		ol.form li input { width:250px;position:relative;float:left }
		ol.form li textarea { width:450px;height:200px;position:relative;float:left }
		ol.form li label { position:relative;float:left;display:block;width:130px;font-weight:700;padding:5px 10px 0 0 }
		ol.form li label span { color:#999;font-weight:normal}
		ol.form li input.auto { width:auto;border:none; }
		ol.form input.error{border:3px solid #FF0000}
		ol.form label.error{position:relative;width:80%;text-align:right;clear:both;margin:0 0 15px 0;display:block;color:#FF0000;}
	</style>
</head>
<body ondragstart="return false">

	<h1><?= $PAGE_TITLE?></h1>

<div class="sectionHeader"><?= $SECTION_HEADER?></div>
<div class="sectionBody">