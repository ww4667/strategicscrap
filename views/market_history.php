<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="../excanvas.js"></script><![endif]-->

<link rel="stylesheet" type="text/css" href="/resources/css/jquery.jqplot.css" />

<!-- BEGIN: load jqplot -->
<script type="text/javascript" src="/resources/js/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="/resources/js/plugins/jqplot.highlighter.min.js"></script>
<script type="text/javascript" src="/resources/js/plugins/jqplot.cursor.min.js"></script>
<script type="text/javascript" src="/resources/js/plugins/jqplot.dateAxisRenderer.min.js"></script>
<!-- END: load jqplot -->

<style>
#chart_wrapper {padding: 20px; float: left;}
#chart_info {margin-left: 30px; width: 395px; float: left;}
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
	sws.market_history = {"data":[
									{ 	
										"title": "LME Copper", 
										"change": "3.44 / <span class ='positive'>0.075 (2.843%)</span>", 
										"points": [ ["30-Apr-08", 3.55],["5-May-08", 4.55],["7-May-08", 5.55],["9-May-08", 8.55],
										            ["11-May-08", 7.55],["15-May-08", 4.55],["17-May-08", 7.55],["19-May-08", 8.55],
										            ["21-May-08", 6.55],["25-May-08", 4.55],["27-May-08", 6.55],["29-May-08", 8.55],["2-Jun-08", 6.55] ],
										 "xticks": [ "1-May-08", "11-May-08","21-May-08","31-May-08"] 
									}, 
									{ 	
										"title": "LME Copper", 
										"change": "3.94 / <span class ='positive'>0.125 (3.843%)</span>", 
										"points" : [ ["30-Apr-10", 3.55], ["10-May-10", 5.55], ["25-May-10", 4.88], ["05-Jun-10", 5.84],
										["18-Jun-10", 4.13], ["24-Jun-10", 3.75], ["30-Jun-10", 3.5], ["6-Jul-10", 5.56],
										["14-Jul-11", 4.14], ["20-Jul-11", 6.51], ["28-Jul-11", 5.99], ["2-Aug-10", 6.15] ] ,
										 "xticks": [ "1-May-10", "15-May-10","1-Jun-10","15-Jun-10","30-Jun-10","15-Jul-10","31-Jul-10"]
									},
									{ 	
										"title": "LME Copper", 
										"change": "3.44 / <span class ='positive'>0.075 (2.843%)</span>", 
										"points": [ ["30-Apr-08", 3.55],["5-May-08", 4.55],["7-May-08", 5.55],["9-May-08", 8.55],
										            ["11-May-08", 7.55],["15-May-08", 4.55],["17-May-08", 7.55],["19-May-08", 8.55],
										            ["21-May-08", 6.55],["25-May-08", 4.55],["27-May-08", 6.55],["29-May-08", 8.55],["2-Jun-08", 6.55] ],
										 "xticks": [ "1-May-08", "11-May-08","21-May-08","31-May-08"]
									}, 
									{ 	
										"title": "LME Copper", 
										"change": "3.94 / <span class ='positive'>0.125 (3.843%)</span>", 
										"points" : [ ["30-Apr-10", 3.55], ["10-May-10", 5.55], ["25-May-10", 4.88], ["05-Jun-10", 5.84],
										["18-Jun-10", 4.13], ["24-Jun-10", 3.75], ["30-Jun-10", 3.5], ["6-Jul-10", 5.56],
										["14-Jul-11", 4.14], ["20-Jul-11", 6.51], ["28-Jul-11", 5.99], ["2-Aug-10", 6.15] ] ,
										 "xticks": [ "1-May-10", "15-May-10","1-Jun-10","15-Jun-10","30-Jun-10","15-Jul-10","31-Jul-10"]
									},
									{ 	
										"title": "LME Copper", 
										"change": "3.44 / <span class ='positive'>0.075 (2.843%)</span>", 
										"points": [ ["30-Apr-08", 3.55],["5-May-08", 4.55],["7-May-08", 5.55],["9-May-08", 8.55],
										            ["11-May-08", 7.55],["15-May-08", 4.55],["17-May-08", 7.55],["19-May-08", 8.55],
										            ["21-May-08", 6.55],["25-May-08", 4.55],["27-May-08", 6.55],["29-May-08", 8.55],["2-Jun-08", 6.55] ],
										 "xticks": [ "1-May-08", "11-May-08","21-May-08","31-May-08"]
									}
								]
}

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

			$("#chart_title").html(el.attr("data-title"));
			$("#chart_change").html(el.attr("data-change"));
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
					pad: 1
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
<div id = "chart_wrapper">
	<div id = "chart_info">
		<div id = "chart_toggles">
			<span class = "toggle_chart active" data-chart = "1" data-change="3.44 / <span class ='negative'>-0.025 (-1.843%)</span>" data-title = "LME Copper">1mo</span>
			<span class = "toggle_chart" data-chart = "2" data-change="3.94 / <span class ='positive'>0.075 (2.843%)</span>" data-title = "LME Copper">3mo</span>
			<span class = "toggle_chart" data-chart = "3" data-change="4.94 / <span class ='positive'>0.075 (2.843%)</span>" data-title = "LME Copper">6mo</span>
			<span class = "toggle_chart" data-chart = "4" data-change="5.94 / <span class ='positive'>0.075 (2.843%)</span>" data-title = "LME Copper">1yr</span>
			<span class = "toggle_chart" data-chart = "5" data-change="6.94 / <span class ='positive'>0.075 (2.843%)</span>" data-title = "LME Copper">2yr</span>
		</div>
		<div id = "chart_title">LME Copper</div>
		<div id = "chart_change">3.94 / <span class ='negative'>-0.025 (1.843%)</span></div>
	</div>
	<div class="chart-content">
		<div id="chart_1" class="plot" style="width:440px;height:260px;"></div>
		<div id="chart_2" class="plot" style="width:440px;height:260px;"></div>
		<div id="chart_3" class="plot" style="width:440px;height:260px;"></div>
		<div id="chart_4" class="plot" style="width:440px;height:260px;"></div>
		<div id="chart_5" class="plot" style="width:440px;height:260px;"></div>
	</div>
</div>