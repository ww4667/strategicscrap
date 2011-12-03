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
									{"title":"LME Copper","change":"3.44 \/ \u003Cspan class = 'positive'\u003E0.075 (2.843%)\u003C\/span\u003E","points":[ ["31-Aug-11","4.19"],["1-Sep-11","4.14"],["2-Sep-11","4.11"],["6-Sep-11","4.04"],["7-Sep-11","4.12"],["8-Sep-11","4.13"],["9-Sep-11","3.99"],["12-Sep-11","3.95"],["13-Sep-11","3.96"],["14-Sep-11","3.89"],["15-Sep-11","3.95"],["16-Sep-11","3.92"],["19-Sep-11","3.77"],["20-Sep-11","3.72"],["21-Sep-11","3.75"],["22-Sep-11","3.48"],["23-Sep-11","3.27"],["26-Sep-11","3.28"],["27-Sep-11","3.43"],["28-Sep-11","3.24"],["29-Sep-11","3.24"],["30-Sep-11","3.15"],["3-Oct-11","3.14"],["4-Oct-11","3.09"],["5-Oct-11","3.10"],["6-Oct-11","3.24"] ],"xticks":["16-Oct-11","21-Oct-11","26-Oct-11","31-Oct-11","5-Nov-11","10-Nov-11","15-Nov-11"]},
									{"title":"LME Copper","change":"3.44 \/ \u003Cspan class = 'positive'\u003E0.075 (2.843%)\u003C\/span\u003E","points":[ ["1-Aug-11","4.40"],["2-Aug-11","4.39"],["3-Aug-11","4.32"],["4-Aug-11","4.23"],["5-Aug-11","4.11"],["8-Aug-11","3.96"],["9-Aug-11","3.97"],["10-Aug-11","3.89"],["11-Aug-11","4.00"],["12-Aug-11","4.01"],["15-Aug-11","4.03"],["16-Aug-11","3.99"],["17-Aug-11","4.03"],["18-Aug-11","3.96"],["19-Aug-11","3.98"],["22-Aug-11","3.96"],["23-Aug-11","3.99"],["24-Aug-11","4.00"],["25-Aug-11","4.08"],["26-Aug-11","4.10"],["29-Aug-11","4.09"],["30-Aug-11","4.12"],["31-Aug-11","4.19"],["1-Sep-11","4.14"],["2-Sep-11","4.11"],["6-Sep-11","4.04"],["7-Sep-11","4.12"],["8-Sep-11","4.13"],["9-Sep-11","3.99"],["12-Sep-11","3.95"],["13-Sep-11","3.96"],["14-Sep-11","3.89"],["15-Sep-11","3.95"],["16-Sep-11","3.92"],["19-Sep-11","3.77"],["20-Sep-11","3.72"],["21-Sep-11","3.75"],["22-Sep-11","3.48"],["23-Sep-11","3.27"],["26-Sep-11","3.28"],["27-Sep-11","3.43"],["28-Sep-11","3.24"],["29-Sep-11","3.24"],["30-Sep-11","3.15"],["3-Oct-11","3.14"],["4-Oct-11","3.09"],["5-Oct-11","3.10"],["6-Oct-11","3.24"] ],"xticks":["16-Sep-11","26-Sep-11","6-Oct-11","16-Oct-11","26-Oct-11","5-Nov-11","15-Nov-11"]},
									{"title":"LME Copper","change":"3.44 \/ \u003Cspan class = 'positive'\u003E0.075 (2.843%)\u003C\/span\u003E","points":[ ["5-Jul-11","4.34"],["6-Jul-11","4.33"],["7-Jul-11","4.43"],["8-Jul-11","4.40"],["11-Jul-11","4.36"],["12-Jul-11","4.38"],["13-Jul-11","4.39"],["14-Jul-11","4.37"],["15-Jul-11","4.41"],["18-Jul-11","4.40"],["19-Jul-11","4.46"],["20-Jul-11","4.43"],["21-Jul-11","4.38"],["22-Jul-11","4.40"],["25-Jul-11","4.40"],["26-Jul-11","4.47"],["27-Jul-11","4.44"],["28-Jul-11","4.46"],["29-Jul-11","4.47"],["1-Aug-11","4.40"],["2-Aug-11","4.39"],["3-Aug-11","4.32"],["4-Aug-11","4.23"],["5-Aug-11","4.11"],["8-Aug-11","3.96"],["9-Aug-11","3.97"],["10-Aug-11","3.89"],["11-Aug-11","4.00"],["12-Aug-11","4.01"],["15-Aug-11","4.03"],["16-Aug-11","3.99"],["17-Aug-11","4.03"],["18-Aug-11","3.96"],["19-Aug-11","3.98"],["22-Aug-11","3.96"],["23-Aug-11","3.99"],["24-Aug-11","4.00"],["25-Aug-11","4.08"],["26-Aug-11","4.10"],["29-Aug-11","4.09"],["30-Aug-11","4.12"],["31-Aug-11","4.19"],["1-Sep-11","4.14"],["2-Sep-11","4.11"],["6-Sep-11","4.04"],["7-Sep-11","4.12"],["8-Sep-11","4.13"],["9-Sep-11","3.99"],["12-Sep-11","3.95"],["13-Sep-11","3.96"],["14-Sep-11","3.89"],["15-Sep-11","3.95"],["16-Sep-11","3.92"],["19-Sep-11","3.77"],["20-Sep-11","3.72"],["21-Sep-11","3.75"],["22-Sep-11","3.48"],["23-Sep-11","3.27"],["26-Sep-11","3.28"],["27-Sep-11","3.43"],["28-Sep-11","3.24"],["29-Sep-11","3.24"],["30-Sep-11","3.15"],["3-Oct-11","3.14"],["4-Oct-11","3.09"],["5-Oct-11","3.10"],["6-Oct-11","3.24"] ],"xticks":["17-Aug-11","1-Sep-11","16-Sep-11","1-Oct-11","16-Oct-11","31-Oct-11","15-Nov-11"]},
									{"title":"LME Copper","change":"3.44 \/ \u003Cspan class = 'positive'\u003E0.075 (2.843%)\u003C\/span\u003E","points":[ ["1-Oct-10","3.68"],["5-Oct-10","3.72"],["7-Oct-10","3.67"],["11-Oct-10","3.78"],["13-Oct-10","3.81"],["15-Oct-10","3.83"],["19-Oct-10","3.76"],["21-Oct-10","3.78"],["25-Oct-10","3.86"],["27-Oct-10","3.77"],["29-Oct-10","3.73"],["2-Nov-10","3.83"],["4-Nov-10","3.91"],["8-Nov-10","3.95"],["10-Nov-10","3.97"],["12-Nov-10","3.89"],["16-Nov-10","3.72"],["18-Nov-10","3.83"],["22-Nov-10","3.75"],["24-Nov-10","3.76"],["29-Nov-10","3.76"],["1-Dec-10","3.95"],["3-Dec-10","4.00"],["7-Dec-10","4.04"],["9-Dec-10","4.08"],["13-Dec-10","4.20"],["15-Dec-10","4.13"],["17-Dec-10","4.15"],["21-Dec-10","4.27"],["23-Dec-10","4.25"],["28-Dec-10","4.32"],["30-Dec-10","4.36"],["3-Jan-11","4.45"],["5-Jan-11","4.40"],["7-Jan-11","4.27"],["11-Jan-11","4.34"],["13-Jan-11","4.37"],["18-Jan-11","4.42"],["20-Jan-11","4.26"],["24-Jan-11","4.34"],["26-Jan-11","4.26"],["28-Jan-11","4.37"],["1-Feb-11","4.54"],["3-Feb-11","4.54"],["7-Feb-11","4.57"],["9-Feb-11","4.52"],["11-Feb-11","4.53"],["15-Feb-11","4.53"],["17-Feb-11","4.48"],["22-Feb-11","4.35"],["24-Feb-11","4.33"],["28-Feb-11","4.48"],["2-Mar-11","4.48"],["4-Mar-11","4.47"],["8-Mar-11","4.33"],["10-Mar-11","4.18"],["14-Mar-11","4.17"],["16-Mar-11","4.19"],["18-Mar-11","4.33"],["22-Mar-11","4.30"],["24-Mar-11","4.41"],["28-Mar-11","4.34"],["30-Mar-11","4.27"],["1-Apr-11","4.25"],["5-Apr-11","4.26"],["7-Apr-11","4.41"],["11-Apr-11","4.45"],["13-Apr-11","4.29"],["15-Apr-11","4.25"],["19-Apr-11","4.23"],["21-Apr-11","4.40"],["26-Apr-11","4.32"],["28-Apr-11","4.25"],["2-May-11","4.18"],["4-May-11","4.12"],["6-May-11","3.96"],["10-May-11","4.03"],["12-May-11","3.96"],["16-May-11","3.98"],["18-May-11","4.10"],["20-May-11","4.12"],["24-May-11","4.01"],["26-May-11","4.11"],["31-May-11","4.17"],["2-Jun-11","4.08"],["6-Jun-11","4.14"],["8-Jun-11","4.11"],["10-Jun-11","4.05"],["14-Jun-11","4.15"],["16-Jun-11","4.12"],["20-Jun-11","4.08"],["22-Jun-11","4.09"],["24-Jun-11","4.10"],["28-Jun-11","4.09"],["30-Jun-11","4.27"],["5-Jul-11","4.34"],["7-Jul-11","4.43"],["11-Jul-11","4.36"],["13-Jul-11","4.39"],["15-Jul-11","4.41"],["19-Jul-11","4.46"],["21-Jul-11","4.38"],["25-Jul-11","4.40"],["27-Jul-11","4.44"],["29-Jul-11","4.47"],["2-Aug-11","4.39"],["4-Aug-11","4.23"],["8-Aug-11","3.96"],["10-Aug-11","3.89"],["12-Aug-11","4.01"],["16-Aug-11","3.99"],["18-Aug-11","3.96"],["22-Aug-11","3.96"],["24-Aug-11","4.00"],["26-Aug-11","4.10"],["30-Aug-11","4.12"],["1-Sep-11","4.14"],["6-Sep-11","4.04"],["8-Sep-11","4.13"],["12-Sep-11","3.95"],["14-Sep-11","3.89"],["16-Sep-11","3.92"],["20-Sep-11","3.72"],["22-Sep-11","3.48"],["26-Sep-11","3.28"],["28-Sep-11","3.24"],["30-Sep-11","3.15"],["4-Oct-11","3.09"],["6-Oct-11","3.24"] ],"xticks":["20-Nov-10","19-Jan-11","20-Mar-11","19-May-11","18-Jul-11","16-Sep-11","15-Nov-11"]},
									{"title":"LME Copper","change":"3.44 \/ \u003Cspan class = 'positive'\u003E0.075 (2.843%)\u003C\/span\u003E","points":[ ["7-Oct-09","2.77"],["12-Oct-09","2.85"],["15-Oct-09","2.85"],["20-Oct-09","2.92"],["23-Oct-09","3.02"],["28-Oct-09","2.92"],["2-Nov-09","2.94"],["5-Nov-09","2.95"],["10-Nov-09","2.96"],["13-Nov-09","2.97"],["18-Nov-09","3.11"],["23-Nov-09","3.13"],["27-Nov-09","3.09"],["2-Dec-09","3.23"],["7-Dec-09","3.19"],["10-Dec-09","3.08"],["15-Dec-09","3.12"],["18-Dec-09","3.12"],["23-Dec-09","3.18"],["29-Dec-09","3.30"],["1-Jan-10","3.33"],["6-Jan-10","3.48"],["11-Jan-10","3.43"],["14-Jan-10","3.38"],["20-Jan-10","3.35"],["25-Jan-10","3.38"],["28-Jan-10","3.09"],["2-Feb-10","3.09"],["5-Feb-10","2.85"],["10-Feb-10","2.99"],["16-Feb-10","3.22"],["19-Feb-10","3.36"],["24-Feb-10","3.24"],["1-Mar-10","3.33"],["4-Mar-10","3.36"],["9-Mar-10","3.40"],["12-Mar-10","3.37"],["17-Mar-10","3.41"],["22-Mar-10","3.37"],["25-Mar-10","3.37"],["30-Mar-10","3.56"],["2-Apr-10","3.58"],["7-Apr-10","3.59"],["12-Apr-10","3.56"],["15-Apr-10","3.60"],["20-Apr-10","3.51"],["23-Apr-10","3.51"],["28-Apr-10","3.37"],["3-May-10","3.28"],["6-May-10","3.10"],["11-May-10","3.19"],["14-May-10","3.12"],["19-May-10","2.95"],["24-May-10","3.14"],["27-May-10","3.15"],["2-Jun-10","3.03"],["7-Jun-10","2.76"],["10-Jun-10","2.86"],["15-Jun-10","3.00"],["18-Jun-10","2.88"],["23-Jun-10","2.93"],["28-Jun-10","3.07"],["1-Jul-10","2.87"],["7-Jul-10","3.01"],["12-Jul-10","3.00"],["15-Jul-10","3.01"],["20-Jul-10","3.00"],["23-Jul-10","3.19"],["28-Jul-10","3.24"],["2-Aug-10","3.39"],["5-Aug-10","3.35"],["10-Aug-10","3.31"],["13-Aug-10","3.25"],["18-Aug-10","3.35"],["23-Aug-10","3.29"],["26-Aug-10","3.31"],["31-Aug-10","3.36"],["3-Sep-10","3.49"],["9-Sep-10","3.43"],["14-Sep-10","3.46"],["17-Sep-10","3.51"],["22-Sep-10","3.56"],["27-Sep-10","3.59"],["30-Sep-10","3.65"],["5-Oct-10","3.72"],["8-Oct-10","3.77"],["13-Oct-10","3.81"],["18-Oct-10","3.85"],["21-Oct-10","3.78"],["26-Oct-10","3.86"],["29-Oct-10","3.73"],["3-Nov-10","3.78"],["8-Nov-10","3.95"],["11-Nov-10","4.02"],["16-Nov-10","3.72"],["19-Nov-10","3.83"],["24-Nov-10","3.76"],["30-Nov-10","3.82"],["3-Dec-10","4.00"],["8-Dec-10","4.09"],["13-Dec-10","4.20"],["16-Dec-10","4.11"],["21-Dec-10","4.27"],["27-Dec-10","4.28"],["30-Dec-10","4.36"],["4-Jan-11","4.36"],["7-Jan-11","4.27"],["12-Jan-11","4.40"],["18-Jan-11","4.42"],["21-Jan-11","4.30"],["26-Jan-11","4.26"],["31-Jan-11","4.45"],["3-Feb-11","4.54"],["8-Feb-11","4.57"],["11-Feb-11","4.53"],["16-Feb-11","4.47"],["22-Feb-11","4.35"],["25-Feb-11","4.44"],["2-Mar-11","4.48"],["7-Mar-11","4.31"],["10-Mar-11","4.18"],["15-Mar-11","4.13"],["18-Mar-11","4.33"],["23-Mar-11","4.42"],["28-Mar-11","4.34"],["31-Mar-11","4.30"],["5-Apr-11","4.26"],["8-Apr-11","4.50"],["13-Apr-11","4.29"],["18-Apr-11","4.19"],["21-Apr-11","4.40"],["27-Apr-11","4.23"],["2-May-11","4.18"],["5-May-11","3.99"],["10-May-11","4.03"],["13-May-11","3.98"],["18-May-11","4.10"],["23-May-11","3.99"],["26-May-11","4.11"],["1-Jun-11","4.10"],["6-Jun-11","4.14"],["9-Jun-11","4.10"],["14-Jun-11","4.15"],["17-Jun-11","4.10"],["22-Jun-11","4.09"],["27-Jun-11","4.05"],["30-Jun-11","4.27"],["6-Jul-11","4.33"],["11-Jul-11","4.36"],["14-Jul-11","4.37"],["19-Jul-11","4.46"],["22-Jul-11","4.40"],["27-Jul-11","4.44"],["1-Aug-11","4.40"],["4-Aug-11","4.23"],["9-Aug-11","3.97"],["12-Aug-11","4.01"],["17-Aug-11","4.03"],["22-Aug-11","3.96"],["25-Aug-11","4.08"],["30-Aug-11","4.12"],["2-Sep-11","4.11"],["8-Sep-11","4.13"],["13-Sep-11","3.96"],["16-Sep-11","3.92"],["21-Sep-11","3.75"],["26-Sep-11","3.28"],["29-Sep-11","3.24"],["4-Oct-11","3.09"] ],"xticks":["25-Nov-09","25-Mar-10","23-Jul-10","20-Nov-10","20-Mar-11","18-Jul-11","15-Nov-11"]}
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