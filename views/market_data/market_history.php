<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="/resources/js/excanvas.js"></script><![endif]-->
    
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" ></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js" ></script>
<link rel="stylesheet" type="text/css" href="/resources/css/jquery.jqplot.css" />

  <link href="/resources/css/core.css" rel="stylesheet" type="text/css" />

<!-- BEGIN: load jqplot -->
<script type="text/javascript" src="/resources/js/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="/resources/js/plugins/jqplot.highlighter.min.js"></script>
<script type="text/javascript" src="/resources/js/plugins/jqplot.cursor.min.js"></script>
<script type="text/javascript" src="/resources/js/plugins/jqplot.dateAxisRenderer.min.js"></script>
<!-- END: load jqplot -->

<style>
#chart_wrapper {padding: 20px; float: left; background: #fff;}
#chart_info {margin-left: 30px; width: 425px; float: left;}
#chart_title {font-weight: bold; font-size: 14px; float: left;}
#chart_change{clear: left; float: left;}
#chart_change .positive {font-weight: bold; color: #00ff00;}
#chart_change .negative {font-weight: bold; color: #ff0000;}
#chart_toggles {float: right; margin-top:17px;}
#chart_toggles span {font-weight: bold; font-size: 12px; color: #999; cursor: pointer;}
#chart_toggles span.active {color: #000;}

.chart-content {clear: both;}
</style>
<script language="javascript" type="text/javascript">
var sws = {};
	sws.market_history = <?= $market_data["json"] ?>;

$(document).ready(function(){
		$('.plot').each(function(i,e){
			draw_chart(i + 1, sws.market_history.data[i]);
			if(i == 0){
				$(e).show();
				//$("#charts_container_loading").hide();
			} else {
				$(e).hide();
			}
		});
	
		$(".toggle_chart").click(function(){
			el = $(this);

			//$("#chart_title").html(el.attr("data-title"));
			//$("#chart_change").html(el.attr("data-change"));
			$(".active").removeClass("active");
			el.addClass("active");
			$(".plot").hide();
			$("#chart_" + el.attr("data-chart")).show();
			
		});
});

function draw_chart( count, data){

	
	$.jqplot('chart_' + count, [data.points], {
			title: {title: data.title,
					show: false},	
		seriesDefaults: {
				color: '#F86C13', showMarker: true, fill: true, fillAndStroke: true, fillColor:"rgba(250,110,24,0.5)", shadow:false,
				markerOptions: {
						size: 2,
						shadow: false
				}
		},
			axes:{
				xaxis:{
					renderer:$.jqplot.DateAxisRenderer,
					tickOptions:{
						formatString:'%b&nbsp;%#d'
					},
				pad: 1,
				ticks: data.xticks
				},
				yaxis:{
					tickOptions:{
						formatString:'$%.2f'
						},
					pad: 1,
					ticks: data.yticks,
					numberTicks: 4
				}
			},
			highlighter: {
				show: true,
				sizeAdjust: 15,
				lineWidthAdjust: 1,
				color: "rgba(250,110,24,0.5)"
			},
			cursor: {
				showVerticalLine:true,
				show: false
			},
			grid: {
				background: '#ffffff'
			}
	});
	
}
</script>
<?php 
//	$_GET["chart_title"] = "Market Data History";
//	$_GET["change_cost"] = "3.45";
//	$_GET["change_class"] = "positive";
//	$_GET["change_amount"] = ".54";
//	$_GET["change_percent"] = ".02";
	?>
	<!--
	<?php // echo $sql ?>
	-->
<div id = "chart_wrapper">
	<div id = "chart_info">
		<div id = "chart_toggles">
			<span class = "toggle_chart active" data-chart = "1" >1mo</span>
			<span class = "toggle_chart" data-chart = "2">3mo</span>
			<span class = "toggle_chart" data-chart = "3" >6mo</span>
			<span class = "toggle_chart" data-chart = "4" >1yr</span>
			<span class = "toggle_chart" data-chart = "5" >2yr</span>
		</div>
		<div id = "chart_title"><?= $_GET["chart_title"] ?></div>
		<div id = "chart_change"><?= $_GET["change_cost"] ?> / <span class ='<?= $_GET["change_class"] ?>'><?= $_GET["change_amount"] ?> (<?= $_GET["change_percent"] ?>)</span></div>
	</div>
	<div class="chart-content">
		<div id="chart_1" class="plot" style="width:470px;height:260px;"></div>
		<div id="chart_2" class="plot" style="width:470px;height:260px;"></div>
		<div id="chart_3" class="plot" style="width:470px;height:260px;"></div>
		<div id="chart_4" class="plot" style="width:470px;height:260px;"></div>
		<div id="chart_5" class="plot" style="width:470px;height:260px;"></div>
	</div>
</div>