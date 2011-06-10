<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title><?= $PAGE_TITLE?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="media/style/MODxCarbon/style.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="/resources/js/dataTables/jquery.dataTables.js"></script>
	<style type="text/css">
		th, tr td { font-size:10px; }
		table tr.alt { background:#E9F0F3; }
		.forward_sort { background:#DDD; }
		.reverse_sort { background:#BBB; }
		ul.pagination { margin:0; padding:0; list-style:none; }
		ul.pagination li { margin:0; padding:0 0 2px 0; float:left; list-style:none; }
		ul.pagination li a { padding:1px 3px 3px 3px; display:block; text-decoration:none; }
		ul.pagination li a.currentPage { color:#000; font-weight:700; }
		.message { padding:10px; background:#D9FFB2; border:solid 1px #667F4C; color:#3E4C2E; margin-bottom:10px }
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
		
		/* dataTablesCSS */
		.dataTables_length{width:40%;float:left}
		.dataTables_filter{width:50%;float:right;text-align:right}
		.dataTables_info{width:60%;float:left}
		.dataTables_paginate{width:44px;* width:50px;float:right;text-align:right}
		
		/* Pagination nested */
		.paginate_disabled_previous,.paginate_enabled_previous,.paginate_disabled_next,.paginate_enabled_next{height:19px;width:19px;margin-left:3px;float:left}
		.paginate_disabled_previous{background-image:url('/resources/images/manager/back_disabled.jpg')}
		.paginate_enabled_previous{background-image:url('/resources/images/manager/back_enabled.jpg')}
		.paginate_disabled_next{background-image:url('/resources/images/manager/forward_disabled.jpg')}
		.paginate_enabled_next{background-image:url('/resources/images/manager/forward_enabled.jpg')}
		
		/* DataTables sorting */
		/* .sorting_asc{background:url('/resources/images/manager/sort_asc.png') no-repeat center right} */
		/* .sorting_desc{background:url('/resources/images/manager/sort_desc.png') no-repeat center right} */
		.sorting_asc {background:#DDD}
		.sorting_desc {background:#BBB}
		/* .sorting{background:url('/resources/images/manager/sort_both.png') no-repeat center right} */
		.sorting_asc_disabled{background:url('/resources/images/manager/sort_asc_disabled.png') no-repeat center right}
		.sorting_desc_disabled{background:url('/resources/images/manager/sort_desc_disabled.png') no-repeat center right}
		.clear{clear:both}
		.dataTables_empty{text-align:center}
		.example_alt_pagination div.dataTables_info{width:40%}
		.sortabletable{clear:both}
	</style>
</head>
<body ondragstart="return false">

	<h1><?= $MODULE_TITLE?></h1>

<div class="sectionHeader">Select an action</div>
<div class="sectionBody">