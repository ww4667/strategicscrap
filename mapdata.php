<?

$_md = $_GET["mapdata"];
$_ar = explode( "_", $_md );
$_d = array();
for( $i = 0; $i < count( $_ar ); $i++ ){
	$tmp = explode("-",$_ar[$i] );
	if(isset($tmp[1])) {
		$_d[ $tmp[ 0 ] ] = $tmp[ 1 ];
	}
}

$data_top = <<<DATA_TOP
\n
<us_states>
	<state id="outline_color">
		<color>ffffff</color>
	</state>
	<state id="default_color">
		<color>cccccc</color>
	</state>
	<state id="background_color">
		<color>ffffff</color>
	</state>
	<state id="default_point">
		<color>ff6600</color>
		<size>3</size>
		<opacity>100</opacity>
	</state>
	<state id="scale_points">
			<data>25</data>
	</state>
	<state id="range">
		<data>8</data>
		<color>ffffff</color>
	</state>
DATA_TOP;

$mills = "\n";

if( $_d["fm"] == "1" ){

	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'12555 Ronaldson Rd',city:'Baton Rouge',state:'Lousianna',zip:'70807',name:'Stupp Pipe',phone:'800-933-7473',url:'http://www.stuppcorp.com',fax:''});</url><loc>30.48,-91.1</loc><name>Stupp Pipe</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'10735 Sessler St.',city:'Southgate',state:'California',zip:'90280',name:'A. Finkl & Sons- California',phone:'562-861-2266',url:'http://www.finkl.com',fax:'562-923-6922'});</url><loc>33.94,-118.19</loc><name>A. Finkl & Sons- California</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'363 Northeast Ave.',city:'Tallmadge',state:'Ohio',zip:'44278',name:'A. Finkl & Sons- Cleveland',phone:'330-630-9601',url:'http://www.finkl.com',fax:'330-630-9693'});</url><loc>41.11,-81.43</loc><name>A. Finkl & Sons- Cleveland</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2910 10 Mile Road',city:'Warren',state:'Michigan',zip:'48091',name:'A. Finkl & Sons- Detroit',phone:'1-800-343-25625',url:'http://www.finkl.com',fax:''});</url><loc>42.48,-83.07</loc><name>A. Finkl & Sons- Detroit</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2722 East 27th St.',city:'Minneapolis',state:'Minnesota',zip:'55406',name:'A. Finkl & Sons-Minneapolis',phone:'612-724-8967',url:'http://www.finkl.com',fax:'612-724-8968'});</url><loc>44.95,-93.23</loc><name>A. Finkl & Sons-Minneapolis</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'3000 West Old Highway 66',city:'Kingman',state:'Arizona',zip:'86413',name:'Nucor Steel Kingman LLC',phone:'9287187035',url:'www.nucorbar.com',fax:'9287187096'});</url><loc>35.19,-114.06</loc><name>Nucor Steel Kingman LLC</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'US Rte. 23',city:'Ashland',state:'Kentucky',zip:'41101',name:'AK Steel Ashland Works',phone:'800-331-5050',url:'http://www.aksteel.com/production_facilities/fac_pop_ash.html',fax:''});</url><loc>38.48,-82.65</loc><name>AK Steel Ashland Works</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'P.O. Box 1609',city:'Butler',state:'Pennsylvania',zip:'16003',name:'AK Steel Butler Works',phone:'800-331-5050',url:'http://www.aksteel.com/production_facilities/fac_pop_but.html',fax:''});</url><loc>40.86,-79.9</loc><name>AK Steel Butler Works</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'17400 State Route 16',city:'Coshocton',state:'Ohio',zip:'43812',name:'AK Steel Coshocton Works',phone:'800-331-5050',url:'http://www.aksteel.com/production_facilities/fac_pop_cos.html',fax:''});</url><loc>40.2,-81.89</loc><name>AK Steel Coshocton Works</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'913 Bowman St',city:'Mansfield',state:'Ohio',zip:'44903',name:'Ak Steel Mansfield Works',phone:'800-331-5050',url:'http://www.aksteel.com/production_facilities/fac_pop_man.html',fax:''});</url><loc>40.78,-82.52</loc><name>Ak Steel Mansfield Works</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1801 Crawford St',city:'Middletown',state:'Ohio',zip:'45043',name:'AK Steel Middletown Works',phone:'800-331-5050',url:'http://www.aksteel.com/production_facilities/fac_pop_mid.html',fax:''});</url><loc>39.5,-84.39</loc><name>AK Steel Middletown Works</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'6500 North US 231',city:'Rockport',state:'Iniana',zip:'47635',name:'AK Steel Rockport Works',phone:'800-331-5050',url:'http://www.aksteel.com/production_facilities/fac_pop_roc.html',fax:''});</url><loc>37.88,-87.05</loc><name>AK Steel Rockport Works</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'5 Cut Street',city:'Alton',state:'Illinois',zip:'62002',name:'Alton Steel',phone:'618-463-4490',url:'http://www.altonsteel.com',fax:'618-463-3789'});</url><loc>38.89,-90.15</loc><name>Alton Steel</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1501 31st Ave North',city:'Birmingham',state:'Alabama',zip:'35207',name:'American Steel Pipe',phone:'205-325-7742',url:'http://www.acipco.com/steel/',fax:'205-325-8194'});</url><loc>33.55,-86.84</loc><name>American Steel Pipe</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'250 W Us Highway 12',city:'Burns Harbor',state:'Indiana',zip:'46304',name:'ArcelorMittal - Burns Harbor',phone:'(219) 787-2120',url:'http://www.mittalsteel.com/Facilities/Americas/Mittal+Steel+USA/Operating+Facilities/',fax:''});</url><loc>41.62,-87.12</loc><name>ArcelorMittal - Burns Harbor</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'4020 Kinross Lakes Parkway',city:'Richfield',state:'Ohio',zip:'44286',name:'ArcelorMittal - Cleveland',phone:'216-429-6000',url:'http://www.mittalsteel.com/Facilities/Americas/Mittal+Steel+USA/Operating+Facilities/cleveland.asp',fax:''});</url><loc>41.22,-81.63</loc><name>ArcelorMittal - Cleveland</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'139 Modena Road',city:'Coatesville',state:'Pennsylvania',zip:'19320',name:'ArcelorMittal - Coatesville',phone:'610-383-2000',url:'http://www.mittalsteel.com/Facilities/Americas/Mittal+Steel+USA/Operating+Facilities/coatesville.asp',fax:''});</url><loc>39.97,-75.81</loc><name>ArcelorMittal - Coatesville</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1800 Watkins Road',city:'Columbus',state:'Ohio',zip:'43207',name:'ArcelorMittal - Columbus',phone:'614-492-6800',url:'http://www.mittalsteel.com/Facilities/Americas/Mittal+Steel+USA/Operating+Facilities/columbus.asp',fax:''});</url><loc>39.91,-82.95</loc><name>ArcelorMittal - Columbus</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'900 Conshohocken Road',city:'Conshohocken',state:'Pennsylvania',zip:'19428',name:'ArcelorMittal - Conshohocken',phone:'610-825-6020',url:'http://www.mittalsteel.com/Facilities/Americas/Mittal+Steel+USA/Operating+Facilities/conshohocken.asp',fax:''});</url><loc>40.09,-75.32</loc><name>ArcelorMittal - Conshohocken</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'420 Hazard St',city:'Georgetown',state:'South Carolina',zip:'29440',name:'ArcelorMittal - Georgetown',phone:'843-546-2525',url:'http://www.mittalsteel.com/Facilities/Americas/Mittal+Steel+USA/Operating+Facilities/georgetown.asp',fax:'843-527-3134'});</url><loc>33.38,-79.29</loc><name>ArcelorMittal - Georgetown</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'940 E State Route 116',city:'Hennepin',state:'Illinois',zip:'61327',name:'ArcelorMittal - Hennepin',phone:'815-925-2311',url:'http://www.mittalsteel.com/Facilities/Americas/Mittal+Steel+USA/Operating+Facilities/hennepin.asp',fax:''});</url><loc>41.3,-89.38</loc><name>ArcelorMittal - Hennepin</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'3210 Watling St',city:'East Chicago',state:'Indiana',zip:'46312',name:'ArcelorMittal - Indiana Harbor',phone:'219-787-2120',url:'http://www.mittalsteel.com/Facilities/Americas/Mittal+Steel+USA/Operating+Facilities/indiana+harbor.asp',fax:''});</url><loc>41.65,-87.45</loc><name>ArcelorMittal - Indiana Harbor</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'3175 Lake Shore Rd',city:'Buffalo',state:'New York',zip:'14219',name:'ArcelorMittal - Lackawanna',phone:'716-821-1021',url:'http://www.mittalsteel.com/Facilities/Americas/Mittal+Steel+USA/Operating+Facilities/lackawanna.asp',fax:''});</url><loc>42.8,-78.84</loc><name>ArcelorMittal - Lackawanna</name></state>\n" : "";
	$mills .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'PO Box 5000',city:'LaPlace',state:'Louisanna',zip:'70069',name:'ArcelorMittal - LaPlace',phone:'985-652-4900',url:'http://www.bayousteel.com',fax:''});</url><loc>30.06,-90.48</loc><name>ArcelorMittal - LaPlace</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2027 McLin Creek Rd',city:'Newton',state:'North Carolina',zip:'28658',name:'ArcelorMittal - Newton',phone:'828-464-9214',url:'http://www.mittalsteel.com/Facilities/Americas/Mittal+Steel+USA/Operating+Facilities/newton.asp',fax:''});</url><loc>35.69,-81.2</loc><name>ArcelorMittal - Newton</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'13500 South Perry Avenue',city:'Riverdale',state:'Illinois',zip:'60827',name:'ARcelorMittal - Riverdale',phone:'708-849-8803',url:'http://www.mittalsteel.com/Facilities/Americas/Mittal+Steel+USA/Operating+Facilities/riverdale.asp',fax:''});</url><loc>41.65,-87.63</loc><name>ARcelorMittal - Riverdale</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'215 S Front  St',city:'Steelton',state:'Pennsylvania',zip:'17113',name:'ArcelorMittal - Steelton',phone:'717-986-2000',url:'http://www.mittalsteel.com/Facilities/Americas/Mittal+Steel+USA/Operating+Facilities/steelton.asp',fax:''});</url><loc>40.23,-76.84</loc><name>ArcelorMittal - Steelton</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2234 Main Ave Southwest',city:'Warren',state:'Ohio',zip:'44481',name:'ArcelorMittal - Warren',phone:'330-841-2800',url:'http://www.mittalsteel.com/Facilities/Americas/Mittal+Steel+USA/Operating+Facilities/warren.asp',fax:''});</url><loc>41.18,-80.81</loc><name>ArcelorMittal - Warren</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'400 Three Springs Dr',city:'Weirton',state:'West Virginia',zip:'26062',name:'ArcelorMittal - Weirton',phone:'304-797-2000',url:'http://www.mittalsteel.com/Facilities/Americas/Mittal+Steel+USA/Operating+Facilities/weirton.asp',fax:'304-797-2792'});</url><loc>40.4,-80.55</loc><name>ArcelorMittal - Weirton</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'900 Paper Mill Road',city:'Mobile',state:'Alabama',zip:'36610',name:'Berg Spiral Pipe Corp',phone:'251-330-2900',url:'http://www.bergpipe.com',fax:''});</url><loc>30.74,-88.06</loc><name>Berg Spiral Pipe Corp</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'5315 West 19th St',city:'Panama City',state:'Florida',zip:'32401',name:'Berg Steel Pipe Corp',phone:'850-769-2273',url:'www.bergpipe.com',fax:''});</url><loc>30.18,-85.73</loc><name>Berg Steel Pipe Corp</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'3630 Fourth Street',city:'Flowood',state:'Mississippi',zip:'39232',name:'Nucor Steel Jackson INC',phone:'6019391623',url:'www.nucorbar.com',fax:'6019366252'});</url><loc>32.32,-90.13</loc><name>Nucor Steel Jackson INC</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'8001 Border Steel Rd',city:'Canutillo',state:'Texas',zip:'79835',name:'Border Steel',phone:'915-886-2481',url:'',fax:''});</url><loc>31.97,-106.59</loc><name>Border Steel</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2301 Shuttlesworth Drive',city:'Birmingham',state:'Alabama',zip:'35234',name:'Nucor Steel Birmingham INC',phone:'205-250-7400',url:'www.nucor.com',fax:'2052507465'});</url><loc>33.55,-86.81</loc><name>Nucor Steel Birmingham INC</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'3200 NE Highway 99W',city:'McMInnville',state:'Oregon',zip:'97128',name:'Cascade Steel',phone:'800-283-2776',url:'http://www.cascadesteel.com',fax:'503-434-5739'});</url><loc>45.23,-123.16</loc><name>Cascade Steel</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'7301 East CR 142',city:'Blytheville',state:'Arkansas',zip:'72315',name:'Nucor Steel Arkansas',phone:'8707622100',url:'www.nucor-sheetmills.com',fax:'8707622108'});</url><loc>35.93,-89.71</loc><name>Nucor Steel Arkansas</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'912 Cheney Avenue',city:'Marion',state:'Ohio',zip:'43302',name:'Nucor Steel Marion INC',phone:'7403834011',url:'www.nucorbar.com',fax:'7403836429'});</url><loc>40.57,-83.14</loc><name>Nucor Steel Marion INC</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2670 S 700 East',city:'Columbia City',state:'Indiana',zip:'46725',name:'Dynamic Composites LLC',phone:'260-625-8686',url:'http://www.dynamic-cci.com',fax:'260-625-8699'});</url><loc>41.12,-85.36</loc><name>Dynamic Composites LLC</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'P.O. Box 3869',city:'Beaumont',state:'Texas',zip:'77704',name:'Gerdau Ameristeel - Beaumont',phone:'409-768-1211',url:'http://www.gerdauameristeel.com/locations/sm/Beaumont_loc.cfm',fax:''});</url><loc>30.08,-94.1</loc><name>Gerdau Ameristeel - Beaumont</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1400 Zug Island Rd',city:'Detroit',state:'Michigan',zip:'48209',name:'EES Coke Battery LLC',phone:'313-554-9351',url:'http://dteenergyservices.com/',fax:''});</url><loc>42.29,-83.11</loc><name>EES Coke Battery LLC</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'14400 N. Rivergate Blvd',city:'Portland',state:'Oregon',zip:'97203',name:'Evraz Oregon Steel Mills',phone:'503-240-5240',url:'http://www.evrazincna.com/LocationsFacilities/OregonSteel/tabid/153/Default.asp',fax:''});</url><loc>45.63,-122.78</loc><name>Evraz Oregon Steel Mills</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1612 Abriendo',city:'Pueblo',state:'Colorado',zip:'81004',name:'Evraz Rocky Mountain Steel',phone:'7195616019',url:'http://www.evrazincna.com/LocationsFacilities/RockyMountainSteelMills/tabid/71/Default.asp',fax:'719-561-6037'});</url><loc>38.24,-104.61</loc><name>Evraz Rocky Mountain Steel</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1678 Red Rock Road',city:'St. Paul',state:'Minnesota',zip:'55119',name:'Gerdau Ameristeel - Minnesota',phone:'651-731-5600',url:'http://www.gerdauameristeel.com/locations/sm/StPaul_loc.cfm',fax:'651-731-5699'});</url><loc>44.89,-93.01</loc><name>Gerdau Ameristeel - Minnesota</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'One Nucor Way',city:'Bourbonnais',state:'Illinois',zip:'60914',name:'Nucor Steel Kankakee INC',phone:'8159373131',url:'www.NucorBar.com',fax:'8159395599'});</url><loc>41.17,-87.88</loc><name>Nucor Steel Kankakee INC</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1770 Bill Sharp Boulevard',city:'Muscatine',state:'Iowa',zip:'52761',name:'SSAB Iowa',phone:'800-340-5566',url:'http://www.ssab.com/sv/Om-SSAB/SSAB-koncernen/Verksamhet/Montpelier/',fax:'563-381-5322'});</url><loc>41.48,-90.82</loc><name>SSAB Iowa</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1724 Linden Ave',city:'Zanesville',state:'Ohio',zip:'43701',name:'AK Steel Zanesville Works',phone:'724-284-2643',url:'http://www.aksteel.com/production_facilities/fac_pop_zan.html',fax:''});</url><loc>39.96,-82</loc><name>AK Steel Zanesville Works</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'300 Mifflin Rd',city:'Pittsburgh',state:'Pennsylvania',zip:'15207',name:'GalvTech',phone:'412-464-5000',url:'http://www.thetechs.com',fax:'412-464-3048'});</url><loc>40.39,-79.93</loc><name>GalvTech</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'384 Old Grassdale Road NE',city:'Cartersville',state:'Georgia',zip:'30121',name:'Gerdau Ameristeel - Georgia',phone:'(770)-387-3300',url:'http://www.gerdauameristeel.com/locations/sm/cvl_loc.cfm',fax:'(770)-387-3327'});</url><loc>34.24,-84.8</loc><name>Gerdau Ameristeel - Georgia</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1500-2500 West 3rd St',city:'Wilton',state:'Iowa',zip:'52778',name:'Gerdau Ameristeel - Iowa',phone:'563-732-3231',url:'http://www.gerdauameristeel.com/locations/sm/Wilton_loc.cfm',fax:'563-732-4587'});</url><loc>41.59,-91.05</loc><name>Gerdau Ameristeel - Iowa</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'4831 U.S. Hwy 42 West',city:'Ghent',state:'Kentucky',zip:'41045',name:'Gerdau Ameristeel - Kentucky',phone:'859-567-3100',url:'http://www.gerdauameristeel.com/locations/sm/gallatin_loc.cfm',fax:'859-567-3165'});</url><loc>38.74,-85.05</loc><name>Gerdau Ameristeel - Kentucky</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'North Crossman Rd',city:'Sayreville',state:'New Jersey',zip:'8872',name:'Gerdau Ameristeel - New Jersey',phone:'732-721-6600',url:'http://www.gerdauameristeel.com/locations/sm/sayreville_loc.cfm',fax:'732-721-8784'});</url><loc>40.48,-74.32</loc><name>Gerdau Ameristeel - New Jersey</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'6601 Lakeview Road',city:'Charlotte',state:'North Carolina',zip:'28269',name:'Gerdau Ameristeel - North Carolina',phone:'704-596-0361',url:'http://www.gerdauameristeel.com/locations/sm/char_loc.cfm',fax:'704-597-5031'});</url><loc>35.34,-80.83</loc><name>Gerdau Ameristeel - North Carolina</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2300 S. Hwy. 97',city:'Sand Springs',state:'Oklahoma',zip:'74063',name:'Gerdau Ameristeel - Oklahoma',phone:'918-245-1335',url:'http://www.gerdauameristeel.com/locations/sm/SandSprings_loc.cfm',fax:''});</url><loc>36.08,-96.12</loc><name>Gerdau Ameristeel - Oklahoma</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'801 Gerdau Ameristeel Road',city:'Jackson',state:'Tennessee',zip:'38305',name:'Gerdau Ameristeel - Tennessee',phone:'731-424-5600',url:'http://www.gerdauameristeel.com/locations/sm/jackson_loc.cfm',fax:'731-422-4247'});</url><loc>35.73,-88.82</loc><name>Gerdau Ameristeel - Tennessee</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1919 Tennessee Avenue N. W.',city:'Knoxville',state:'Tennessee',zip:'37921',name:'Gerdau Ameristeel - Tennessee',phone:'865-546-5472',url:'http://www.gerdauameristeel.com/locations/sm/knox_loc.cfm',fax:'865-637-8293'});</url><loc>35.98,-83.96</loc><name>Gerdau Ameristeel - Tennessee</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'300 Ward Road',city:'Midlothian',state:'Texas',zip:'76065',name:'Gerdau Ameristeel - Texas',phone:'800-527-7979',url:'http://www.gerdauameristeel.com/locations/sm/midlothian_loc.cfm',fax:'972-299-5212'});</url><loc>32.46,-97.03</loc><name>Gerdau Ameristeel - Texas</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'25801 Hofheimer Way',city:'Petersburg',state:'Virgina',zip:'23803',name:'Gerdau Ameristeel - Virginia',phone:'804-520-0286',url:'http://www.gerdauameristeel.com/locations/sm/petersburg_loc.cfm',fax:'804-524-2897'});</url><loc>37.25,-77.49</loc><name>Gerdau Ameristeel - Virginia</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'4537 South Nucor Road',city:'Crawfordsville',state:'Indiana',zip:'47933',name:'Nucor Steel Indiana',phone:'7653641323',url:'www.nucor-sheetmills.com',fax:'7653641695'});</url><loc>40.02,-86.83</loc><name>Nucor Steel Indiana</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2911 East Nucor Road',city:'Norfolk',state:'Nebraska',zip:'68701',name:'Nucor Steel Nebraska',phone:'402-644-0200',url:'www.nucorbar.com',fax:'4026440329'});</url><loc>42.08,-97.37</loc><name>Nucor Steel Nebraska</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'12400 HWY 43 N',city:'Axis',state:'Alabama',zip:'36505',name:'IPSCO Steel',phone:'251-675-5104',url:'www.ipsco.com',fax:''});</url><loc>30.96,-88.03</loc><name>IPSCO Steel</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'300 Steel Mill Road',city:'Darlington',state:'South Carolina',zip:'29540',name:'Nucor Steel South Carolina',phone:'8433935841',url:'www.nucorbar.com',fax:'8433958741'});</url><loc>34.38,-79.9</loc><name>Nucor Steel South Carolina</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'25 Qurry Road',city:'Auburn',state:'New York',zip:'13021',name:'Nucor Steel Auburn INC',phone:'3152534561',url:'www.nucorbar.com',fax:'3152538441'});</url><loc>42.95,-76.57</loc><name>Nucor Steel Auburn INC</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'North Main Street Ext.',city:'Grapeland',state:'Texas',zip:'75844',name:'Vulcraft Texas',phone:'936-687-4665',url:'www.vulcraft.com',fax:'9366874290'});</url><loc>31.49,-95.48</loc><name>Vulcraft Texas</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1 Industry Ave',city:'Joliet',state:'Illinois',zip:'60435',name:'Gerdau Ameristeel - Illinois',phone:'815-740-4946',url:'http://www.gerdauameristeel.com/locations/sm/Joliet_loc.cfm',fax:''});</url><loc>41.55,-88.08</loc><name>Gerdau Ameristeel - Illinois</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'5225 Planters Rd',city:'Fort Smith',state:'Arkansas',zip:'72916',name:'Macsteel',phone:'479-646-0223',url:'',fax:''});</url><loc>35.31,-94.37</loc><name>Macsteel</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2800 North Governer's William Highway',city:'Darlington',state:'South Carolina',zip:'29540',name:'Nucor Cold Finish South Carolina',phone:'8433958689',url:'www.nucorcoldfinish.com',fax:'8433958758'});</url><loc>0,0</loc><name>Nucor Cold Finish South Carolina</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1851 Main St',city:'Follansbee',state:'West Virginia',zip:'26037',name:'Mountain State Carbon  LLC',phone:'740-283-5624',url:'http://www.severstalna.com/about-us/north-american-operations.html',fax:''});</url><loc>40.34,-80.6</loc><name>Mountain State Carbon  LLC</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1945 Airport Road',city:'Columbus',state:'Missouri',zip:'39701',name:'Severstal Columbus',phone:'662-245-4200',url:'http://www.severstalna.com/images/stories/NorthAmerican%20Operations/severstal_columbus_fact_sheet.pdf',fax:''});</url><loc>40.28,-83.11</loc><name>Severstal Columbus</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'100 Diuguids Lane',city:'Salem',state:'Virginia',zip:'24153',name:'New Millennium - Eastern',phone:'540-389-0211',url:'http://www.newmill.com',fax:'540-389-0378'});</url><loc>37.28,-80.11</loc><name>New Millennium - Eastern</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'6115 County Road 42',city:'Butler',state:'Indiana',zip:'46721',name:'New Millennium - Midwest',phone:'260-868-6000',url:'http://www.newmill.com',fax:'260-868-6001'});</url><loc>41.38,-84.9</loc><name>New Millennium - Midwest</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1992 NW Bascom Norris Dr',city:'Lake City',state:'Florida',zip:'32055',name:'New Millennium - Southern',phone:'386-466-1300',url:'http://www.newmill.com',fax:'386-466-1301'});</url><loc>30.2,-82.62</loc><name>New Millennium - Southern</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'300 Braddock Ave',city:'Turtle Creek',state:'Pennsylvania',zip:'15145',name:'NexTech',phone:'412-464-5000',url:'http://www.thetechs.com',fax:'412-825-4309'});</url><loc>40.4,-79.83</loc><name>NexTech</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1455 Hagan Avenue',city:'Huger',state:'South Carolina',zip:'29450',name:'Nucor Steel Berkely',phone:'8433366000',url:'www.nucorsteel.com',fax:'8433366108'});</url><loc>33.01,-79.89</loc><name>Nucor Steel Berkely</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'3601 Paul R. Lowry Road',city:'Memphis',state:'Tennessee',zip:'38109',name:'Nucor Steel Memphis INC',phone:'901-786-5900',url:'www.nucorbar.com',fax:'9017865901'});</url><loc>35.05,-90.15</loc><name>Nucor Steel Memphis INC</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1700 Holt Road N.E.',city:'Tuscaloosa',state:'Alabama',zip:'35404',name:'Nucor Steel Tuscaloosa INC',phone:'2055561310',url:'www.nucortuck.com',fax:'2055561482'});</url><loc>33.24,-87.51</loc><name>Nucor Steel Tuscaloosa INC</name></state>\n" : "";
	$mills .= ( $_d["t2"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'5929 East State Highway 18',city:'Armorel',state:'Arkansas',zip:'72310',name:'Nucor-Yamato Steel Company',phone:'8702895500',url:'www.nucoryamato.com',fax:'8707620695'});</url><loc>35.94,-89.78</loc><name>Nucor-Yamato Steel Company</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2100 Tin Plate Place',city:'Yorkville',state:'Ohio',zip:'43971',name:'Ohio Coatings Company',phone:'740-859-5500',url:'http://www.ohiocoatingscompany.com/',fax:'740-859-5519'});</url><loc>40.15,-80.71</loc><name>Ohio Coatings Company</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'35 Toelles Road',city:'Wallingford',state:'Connecticut',zip:'6492',name:'Nucor Steel Connecticut',phone:'2032650615',url:'www.nucorbar.com',fax:'2032848125'});</url><loc>41.43,-72.84</loc><name>Nucor Steel Connecticut</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2424 SW Andover',city:'Seattle',state:'Washington',zip:'98106',name:'Nucor Steel Seattle INC',phone:'2069332222',url:'www.nucorbar.com',fax:'2069332207'});</url><loc>47.57,-122.36</loc><name>Nucor Steel Seattle INC</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'West Cemetart Road',city:'Plymouth',state:'Utah',zip:'84330',name:'Nucor Steel Utah',phone:'4354582300',url:'www.nucorbar.com',fax:'4354582309'});</url><loc>41.88,-112.14</loc><name>Nucor Steel Utah</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'4301 Iverson Boulevard',city:'Trinity',state:'Alabama',zip:'35673',name:'Nucor Steel Decatur LLC',phone:'2563013500',url:'www.nucor-sheetsmills.com',fax:'2563013545'});</url><loc>34.64,-87.09</loc><name>Nucor Steel Decatur LLC</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'14661 Rotunda Drive',city:'Dearborn',state:'Michigan',zip:'48120',name:'Severstal Dearborn',phone:'1-800-532-8857',url:'http://www.severstalna.com/images/stories/NorthAmerican%20Operations/severstal_dearborn_fact_sheet.pdf',fax:''});</url><loc>42.31,-83.18</loc><name>Severstal Dearborn</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1430 Sparrows Point Blvd.',city:'Sparrows Point',state:'Marlyland',zip:'21219',name:'Severstal Sparrows Point',phone:'410-388-3000',url:'http://www.severstalna.com/images/stories/NorthAmerican%20Operations/severstal_sp_fact_sheet.pdf',fax:''});</url><loc>39.23,-76.46</loc><name>Severstal Sparrows Point</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'999 Pine St SE',city:'Warren',state:'Ohio',zip:'44483',name:'Severstal Warren',phone:'330-841-8000',url:'http://www.severstalna.com/images/stories/NorthAmerican%20Operations/severstal_warren_fact_sheet.pdf',fax:''});</url><loc>41.23,-80.81</loc><name>Severstal Warren</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1134 Market St',city:'Wheeling',state:'West Virginia',zip:'26003',name:'Severstal Wheeling',phone:'304-234-2400',url:'http://www.severstalna.com/images/stories/NorthAmerican%20Operations/severstal_wheeling_fact_sheet.pdf',fax:''});</url><loc>40.07,-80.72</loc><name>Severstal Wheeling</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'200 Neville Rd Ste 8',city:'Pittsburgh',state:'Pennsylvania',zip:'15225',name:'Shenango Incorporated',phone:'(412) 771-4400',url:'http://www.manta.com/',fax:''});</url><loc>40.5,-80.08</loc><name>Shenango Incorporated</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'217 Yellow Water Road',city:'Baldwin',state:'Florida',zip:'32234',name:'Gerdau Ameristeel - Florida',phone:'(904) 266-4261',url:'http://www.gerdauameristeel.com/locations/sm/jax_loc.cfm',fax:'(904) 266-4244'});</url><loc>30.3,-81.97</loc><name>Gerdau Ameristeel - Florida</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'8812 Highway 79 West',city:'Jewett',state:'Texas',zip:'75846',name:'Nucor Steel Texas',phone:'903-626-4461',url:'www.nucorbar.com',fax:'9036266290'});</url><loc>31.34,-96.18</loc><name>Nucor Steel Texas</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'STE 180, 9802 FM 1960 Bypass Rd',city:'Humble Texas',state:'Texas',zip:'77338',name:'SMI Steel Fabricators',phone:'281-540-7788',url:'',fax:''});</url><loc>30,-95.31</loc><name>SMI Steel Fabricators</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'12400 HW 43 North',city:'Axis',state:'Alabama',zip:'36505',name:'SSAB Alabama',phone:'888-592-7070',url:'http://www.ssab.com/sv/Om-SSAB/SSAB-koncernen/Verksamhet/Mobile/',fax:'251-662-4360'});</url><loc>30.96,-88.03</loc><name>SSAB Alabama</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2500 West County Rd B',city:'Roseville',state:'Minnesota',zip:'55113',name:'SSAB Minnesota',phone:'800-383-9031',url:'http://www.ssab.com/sv/Om-SSAB/SSAB-koncernen/Verksamhet/St-Paul/',fax:'651-631-9670'});</url><loc>45.01,-93.2</loc><name>SSAB Minnesota</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'13609 Industrial Rd, Ste 114',city:'Houston',state:'Texas',zip:'77015',name:'SSAB Texas',phone:'713-341-7700',url:'http://www.ssab.com/sv/Om-SSAB/SSAB-koncernen/Verksamhet/Houston/',fax:'713-450-2261'});</url><loc>29.76,-95.21</loc><name>SSAB Texas</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1035 Shar-Cal Road',city:'Calvert City',state:'Kentucky',zip:'42049',name:'Gerdau Ameristeel - Kentucky',phone:'270-395-3100',url:'http://www.gerdauameristeel.com/locations/sm/calvertcity_loc.cfm',fax:'270-395-7861'});</url><loc>37.05,-88.39</loc><name>Gerdau Ameristeel - Kentucky</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'4500 Country Rd 59',city:'Butler',state:'Indiana',zip:'46721',name:'Steel Dynamics Butler Site Flat Roll Steel Div.',phone:'260-868-8000',url:'https://www.stld.com',fax:'260-868-8055'});</url><loc>41.37,-84.91</loc><name>Steel Dynamics Butler Site Flat Roll Steel Div.</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2601 County Rd 700 East',city:'Columbia City',state:'Indiana',zip:'46725',name:'Steel Dynamics Columbia City Structural & Rail Div',phone:'260-625-8100',url:'http://www.stld-cci.com',fax:'260-625-8950'});</url><loc>41.12,-85.36</loc><name>Steel Dynamics Columbia City Structural & Rail Div</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'8000 North County Road 225 East',city:'Pittsboro',state:'Indiana',zip:'46167',name:'Steel Dynamics Pittsboro Engineered Products Div',phone:'877-683-2277',url:'http://www.sdi-pit.com',fax:'317-892-7010'});</url><loc>39.87,-86.48</loc><name>Steel Dynamics Pittsboro Engineered Products Div</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'102 Westside Boulevard NW',city:'Roanoke',state:'Virginia',zip:'24017',name:'Steel Dynamics Roanoke Bar Division',phone:'540-342-1831',url:'http://www.roanokesteel.com',fax:'540-342-9437'});</url><loc>37.28,-80</loc><name>Steel Dynamics Roanoke Bar Division</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'17th St & 2nd Ave',city:'Huntington',state:'West Virginia',zip:'25703',name:'Steel of West Virginia',phone:'304-969-8200',url:'http://www.swvainc.com/',fax:'304-529-1479'});</url><loc>38.43,-82.43</loc><name>Steel of West Virginia</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'222 West Kalama River Road',city:'Kalama',state:'Washington',zip:'98625',name:'Steelscape Inc - Kalama Facilicty',phone:'360-673-8200',url:'http://www.steelscape.com/',fax:'360-673-8250'});</url><loc>46.04,-122.87</loc><name>Steelscape Inc - Kalama Facilicty</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'101 Ave K',city:'Sterling',state:'Illinois',zip:'61081',name:'Sterling Steel Compnany',phone:'815-548-7000',url:'www.sscllc.com',fax:''});</url><loc>41.79,-89.7</loc><name>Sterling Steel Compnany</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1835 Dueber Ave SW',city:'Canton',state:'Ohio',zip:'44706',name:'Timken Company',phone:'330-438-3000',url:'http://www.timken.com',fax:'330-458-6006'});</url><loc>40.78,-81.4</loc><name>Timken Company</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'PO Box 10406',city:'Birmingham',state:'Alabama',zip:'35202',name:'US Pipe',phone:'866-347-7473',url:'http://www.uspipe.com',fax:''});</url><loc>33.52,-86.8</loc><name>US Pipe</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'141 Miller Rd',city:'Bellville',state:'Texas',zip:'77418',name:'US Steel - Bellville Operations Division',phone:'1-800-884-8823',url:'http://www.ussteel.com/corp/facilities/Bellville.asp',fax:''});</url><loc>29.9,-96.21</loc><name>US Steel - Bellville Operations Division</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'400 State St',city:'Clairton',state:'Pennsylvania',zip:'15025',name:'US Steel - Clairton Plant',phone:'412-233-1035',url:'http://www.uss.com/corp/facilities/facilities.asp',fax:''});</url><loc>40.29,-79.87</loc><name>US Steel - Clairton Plant</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'3000 Miller Road',city:'Dearborn',state:'Michigan',zip:'48120',name:'US Steel - Double Eagle Steel Coating Company',phone:'313-203-9800',url:'http://www.descc.com/',fax:'313-203-9821'});</url><loc>42.31,-83.16</loc><name>US Steel - Double Eagle Steel Coating Company</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1096 Mendell Davis Dr',city:'Bryam',state:'Mississippi',zip:'39272',name:'US Steel - Double G Coatings',phone:'601-372-4236',url:'http://www.uss.com/corp/facilities/facilities.asp',fax:''});</url><loc>32.17,-90.26</loc><name>US Steel - Double G Coatings</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'101 East 129th Street',city:'East Chicago',state:'Indiana',zip:'46312',name:'US Steel - East Chicago Tin',phone:'412-433-6792',url:'http://www.uss.com/corp/facilities/facilities.asp',fax:''});</url><loc>41.66,-87.48</loc><name>US Steel - East Chicago Tin</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'5700 Valley Road',city:'Fairfield',state:'Alabama',zip:'35064',name:'US Steel - Fairfield Tubular Operations',phone:'205-783-4122',url:'http://www.ussteel.com/corp/facilities/fairfield-works-tubular.asp',fax:''});</url><loc>33.48,-86.92</loc><name>US Steel - Fairfield Tubular Operations</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1 Pennsylvania Ave',city:'Fairless Hills',state:'Pennsylvania',zip:'19030',name:'US Steel - Fairless Works',phone:'215-736-4000',url:'http://www.uss.com/corp/facilities/facilities.asp',fax:''});</url><loc>40.19,-74.83</loc><name>US Steel - Fairless Works</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2199 East 28th St.',city:'Lorain',state:'Ohio',zip:'44055',name:'US Steel - Lorain Tubular Operations',phone:'440-240-2500',url:'http://www.ussteel.com/corp/facilities/lorain-tubular.asp',fax:''});</url><loc>41.45,-82.12</loc><name>US Steel - Lorain Tubular Operations</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'6300 US Hwy 12',city:'Portage',state:'Indiana',zip:'46368',name:'US Steel - Midwest Plant',phone:'219-762-3131',url:'http://www.uss.com/corp/facilities/facilities.asp',fax:''});</url><loc>41.62,-87.17</loc><name>US Steel - Midwest Plant</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'5000 Country Road #5',city:'Leipsic',state:'Ohio',zip:'45856',name:'US Steel - Protect Coating Company',phone:'419-943-1100',url:'http://www.proteccoating.com/home.htm',fax:'419-943-1101'});</url><loc>41.11,-83.96</loc><name>US Steel - Protect Coating Company</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'P.O. Box 1000',city:'Lone Star',state:'Texas',zip:'75668',name:'US Steel - Texas Operations Division',phone:'972-386-3981',url:'http://www.ussteel.com/corp/facilities/texas-ops-sts.asp',fax:''});</url><loc>32.93,-94.7</loc><name>US Steel - Texas Operations Division</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'9393 Sheldon Rd',city:'Houston',state:'Texas',zip:'77049',name:'US Steel - Tubular Processing Services Division',phone:'281-456-7000',url:'http://www.ussteel.com/corp/facilities/TPS.asp',fax:''});</url><loc>29.85,-95.13</loc><name>US Steel - Tubular Processing Services Division</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'9518 East Mount Houston Rd',city:'Houston',state:'Texas',zip:'77050',name:'US Steel - Tubular Threading & Inspection Services',phone:'281-458-9944',url:'http://www.ussteel.com/corp/facilities/TTISD.asp',fax:''});</url><loc>29.89,-95.25</loc><name>US Steel - Tubular Threading & Inspection Services</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'900 East 3rd St.',city:'Pittsburg',state:'California',zip:'94565',name:'US Steel - United Spiral Pipe LLC',phone:'925-526-3100',url:'http://www.unitedspiralpipe.com/',fax:'925-526-3190'});</url><loc>38.03,-121.87</loc><name>US Steel - United Spiral Pipe LLC</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'202 Hanes Boulevard',city:'Hughes Springs',state:'Texas',zip:'75656',name:'US Steel - Wheeling Machine Products',phone:'903-639-4646',url:'http://www.ussteel.com/corp/facilities/Wheeling.asp',fax:''});</url><loc>33,-94.63</loc><name>US Steel - Wheeling Machine Products</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'5411 Industrail Drive South',city:'Pine Bluff',state:'Arkansas',zip:'71602',name:'US Steel - Wheeling Machine Products',phone:'870-247-5945',url:'http://www.ussteel.com/corp/facilities/Wheeling.asp',fax:''});</url><loc>34.26,-92.06</loc><name>US Steel - Wheeling Machine Products</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'5260 Haggerty Rd.',city:'Canton',state:'Michigan',zip:'48188',name:'US Steel - Worthington Specialty Processing Canton',phone:'734-397-3700',url:'http://www.worthingtonindustries.com',fax:'734-397-0029'});</url><loc>42.27,-83.45</loc><name>US Steel - Worthington Specialty Processing Canton</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'4905 S. Meridian Rd.',city:'Jackson',state:'Michigan',zip:'49201',name:'US Steel - Worthington Specialty Processing Jacksn',phone:'517-789-0200',url:'http://www.worthingtonindustries.com',fax:'517-789-0209'});</url><loc>42.18,-84.37</loc><name>US Steel - Worthington Specialty Processing Jacksn</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'11700 Worthington Drive',city:'Taylor',state:'Michigan',zip:'48180',name:'US Steel - Worthington Specialty Processing Taylor',phone:'734-374-3260',url:'http://www.worthingtonindustries.com',fax:'734-374-3264'});</url><loc>42.22,-83.23</loc><name>US Steel - Worthington Specialty Processing Taylor</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'13TH St & Braddock Ave',city:'Braddock',state:'Pennsylvania',zip:'15104',name:'US Steel- Edgar Thomas Plant',phone:'412-273-0094',url:'http://www.uss.com/corp/facilities/facilities.asp',fax:''});</url><loc>40.4,-79.86</loc><name>US Steel- Edgar Thomas Plant</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'5700 Valley Rd',city:'Fairfield',state:'Alabama',zip:'35064',name:'US Steel- Fairfield Works',phone:'205-783-4150',url:'http://www.uss.com/corp/facilities/facilities.asp',fax:''});</url><loc>33.48,-86.92</loc><name>US Steel- Fairfield Works</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'555 W 41st St.',city:'Tulsa',state:'Oklahoma',zip:'74107',name:'US Steel -Fintube Technologies Inc',phone:'918-446-4561',url:'http://www.fintubetech.com/',fax:'918-445-4000'});</url><loc>36.1,-96</loc><name>US Steel -Fintube Technologies Inc</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1 Broadway',city:'Gary',state:'Indiana',zip:'46402',name:'US Steel- Gary Works',phone:'219-888-2000',url:'http://www.uss.com/corp/facilities/facilities.asp',fax:''});</url><loc>41.61,-87.34</loc><name>US Steel- Gary Works</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1951 State St',city:'Granite City',state:'Illinois',zip:'62040',name:'US Steel- Granite City Works',phone:'618-451-3456',url:'http://www.uss.com/corp/facilities/facilities.asp',fax:''});</url><loc>38.7,-90.15</loc><name>US Steel- Granite City Works</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'4425 West Jefferson Avenue',city:'Ecorse',state:'Michigan',zip:'48183',name:'US Steel- Great Lakes Works',phone:'313-294-3147',url:'http://www.uss.com/corp/facilities/facilities.asp',fax:''});</url><loc>42.24,-83.14</loc><name>US Steel- Great Lakes Works</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1 Camphollow Rd',city:'West Mifflin',state:'Pennsylvania',zip:'15122',name:'US Steel- Irvin Plant',phone:'412-675-7459',url:'http://www.uss.com/corp/facilities/facilities.asp',fax:''});</url><loc>40.35,-79.93</loc><name>US Steel- Irvin Plant</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'PO Box 471',city:'Pittsburg',state:'California',zip:'94565',name:'USS POSCO',phone:'800-877-7672',url:'http://www.uss-posco.com',fax:''});</url><loc>38.03,-121.88</loc><name>USS POSCO</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2669 Matin Luther King Jr. Blvd',city:'Youngstown',state:'Ohio',zip:'44510',name:'V&M Star',phone:'330-742-6300',url:'https://www.vmstar.com',fax:'330-742-6315'});</url><loc>41.13,-80.68</loc><name>V&M Star</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'6610 CR 60',city:'St. Joe',state:'Indiana',zip:'46785',name:'Vulcraft Indiana',phone:'2603371800',url:'www.vulcraft.com',fax:'2603371988'});</url><loc>41.31,-84.88</loc><name>Vulcraft Indiana</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1601 West Omaha Avenue',city:'Norfolk',state:'Nebraska',zip:'68702',name:'Vulcraft Nebraska',phone:'4026448500',url:'www.vulcraft.com',fax:'4026448512'});</url><loc>42.02,-97.43</loc><name>Vulcraft Nebraska</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'5362 Railroad St',city:'Chemung',state:'New York',zip:'14825',name:'Vulcraft New York INC',phone:'6075299000',url:'www.vulcraft.com',fax:'6075299001'});</url><loc>42.01,-76.62</loc><name>Vulcraft New York INC</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1501 West Darlington Street',city:'Florence',state:'South Carolina',zip:'29501',name:'Vulcraft South Carolina',phone:'8436620381',url:'www.vulcraft.com',fax:'8436793097'});</url><loc>34.2,-79.79</loc><name>Vulcraft South Carolina</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1875 West Highway 13 South',city:'Brigham City',state:'Utah',zip:'75844',name:'Vulcraft Utah',phone:'4357349433',url:'www.vulcraft.com',fax:'4357235423'});</url><loc>31.57,-95.27</loc><name>Vulcraft Utah</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1875 West Highway 13 South',city:'Brigham City',state:'Utah',zip:'84302',name:'Nucor Cold Finish Utah',phone:'435-734-9334',url:'www.nucorcoldfinish.com',fax:'4357344581'});</url><loc>41.51,-112.02</loc><name>Nucor Cold Finish Utah</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1134 Market St',city:'Wheeling',state:'West Virginia',zip:'26003',name:'Wheeling Corrugating Steel Company',phone:'877-333-0900',url:'http://www.wheelingcorrugating.com',fax:'888-786-8707'});</url><loc>40.07,-80.72</loc><name>Wheeling Corrugating Steel Company</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1505 River Road',city:'Winton',state:'North Carolina',zip:'27922',name:'Nucor Steel Hertford County',phone:'2523563700',url:'www.nucorhertford.com',fax:'2523563750'});</url><loc>36.38,-76.9</loc><name>Nucor Steel Hertford County</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'7205 Gault Avenue North',city:'Fort Payne',state:'Alabama',zip:'35967',name:'Vulcraft Alabama',phone:'2568452460',url:'www.vulcraft.com',fax:'2568451090'});</url><loc>34.45,-85.71</loc><name>Vulcraft Alabama</name></state>\n" : "";
	$mills .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'P.O. Box 14667',city:'Phoenix',state:'arizona',zip:'85063',name:'Verco Decking Inc',phone:'602-272-1347',url:'http://www.vercodeck.com/',fax:''});</url><loc>33.45,-112.07</loc><name>Verco Decking Inc</name></state>\n" : "";

}

$foundries = "\n\n";
if( $_d["ff"] == "1" ){

	$foundries .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1460 Livingston Ave',city:'North Brunswick',state:'New Jersey',zip:'8902',name:'ABP Induction LLC (Foundry Division)',phone:'732-932-6400',url:'http://www.abpinduction.com/',fax:'732-828-7274'});</url><loc>40.46,-74.48</loc><name>ABP Induction LLC (Foundry Division)</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'6009 South Santa Fe Ave',city:'Huntington Park',state:'California',zip:'90255',name:'Acme Castings',phone:'323-583-3129',url:'http://www.acme-castings.com/foundries/',fax:'323-583-8726'});</url><loc>33.99,-118.23</loc><name>Acme Castings</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'4343 Concourse Dr',city:'Ann Arbor',state:'Michigan',zip:'48108',name:'ACTech North America',phone:'734-913-0091',url:'http://www.rapidcastings.com/en/html/company.html',fax:''});</url><loc>42.22,-83.73</loc><name>ACTech North America</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'18700 Mill St',city:'Meadville',state:'Pennsylvania',zip:'16335',name:'Advanced Cast Products Inc',phone:'814-724-2600',url:'http://www.advancedcast.com/',fax:''});</url><loc>41.63,-80.16</loc><name>Advanced Cast Products Inc</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1435 Midway Rd',city:'Menasha',state:'Wisconsin',zip:'54952',name:'Advanced Tooling Specialists, Inc',phone:'920-954-5800',url:'http://www.ats-wis.com/',fax:'920-954-5802'});</url><loc>44.23,-88.42</loc><name>Advanced Tooling Specialists, Inc</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1745 Overland Ave',city:'Warren',state:'Ohio',zip:'44482',name:'Ajax Tocco Magnethermic',phone:'1-(800) 547-1527',url:'http://www.ajaxtocco.com/default.asp?ID=93',fax:''});</url><loc>41.26,-80.8</loc><name>Ajax Tocco Magnethermic</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1506 Industrial Blvd',city:'Boaz',state:'Alabama',zip:'35957',name:'Ajax Tocco Magnethermic- Boaz',phone:'(800) 547-1527',url:'http://www.ajaxtocco.com/default.asp?ID=94',fax:'(330) 372-8608'});</url><loc>34.23,-86.18</loc><name>Ajax Tocco Magnethermic- Boaz</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'8984 Meridian Circle NW',city:'North Canton',state:'Ohio',zip:'44720',name:'Ajax Tocco Magnethermic- Canton',phone:'(800) 547-1527',url:'http://www.ajaxtocco.com/default.asp?ID=283',fax:'(330) 372-8608'});</url><loc>40.91,-81.41</loc><name>Ajax Tocco Magnethermic- Canton</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2728 Wingate Ave.',city:'Akron',state:'Ohio',zip:'44314',name:'Akron Foundry Company',phone:'330-745-3101',url:'http://www.akronfoundry.com/home.html',fax:'330-745-7999'});</url><loc>41.03,-81.56</loc><name>Akron Foundry Company</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'630 East Green Street',city:'Bensenville',state:'Illinois',zip:'60106',name:'Alu-Bra Foundry Inc',phone:'630-766-3112',url:'http://www.alubra.com/',fax:'630-766-3307'});</url><loc>41.95,-87.93</loc><name>Alu-Bra Foundry Inc</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2590 W. Catalina Dr',city:'Phoenix',state:'Arizona',zip:'85017',name:'American Aerospace Technical Castings, Inc.',phone:'602-268-1467',url:'http://www.aatcinc.com/default.asp',fax:''});</url><loc>33.48,-112.12</loc><name>American Aerospace Technical Castings, Inc.</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1501 31st Ave North',city:'Birmingham',state:'Alabama',zip:'35202',name:'American Cast Iron Pipe Company',phone:'205-325-7701',url:'http://www.acipco.com/adip/index.cfm',fax:''});</url><loc>33.55,-86.84</loc><name>American Cast Iron Pipe Company</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'5265 Hunt St',city:'Pryor',state:'Oklahoma',zip:'74361',name:'American Castings, LLC',phone:'918-476-4250',url:'http://www.americancastings.com/',fax:''});</url><loc>36.23,-95.28</loc><name>American Castings, LLC</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1800 Greenbrier Rd',city:'Anniston',state:'Alabama',zip:'36207',name:'American R/D',phone:'256-831-2236',url:'http://www.american-rd.com/',fax:'256-831-2884'});</url><loc>33.63,-85.8</loc><name>American R/D</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1117 East Algonquin Rd',city:'Arlington Heights',state:'Illinois',zip:'60005',name:'Ampco Metal Inc',phone:'800-844-6008',url:'http://www.ampcometal.com',fax:'847-437-6008'});</url><loc>42.03,-87.96</loc><name>Ampco Metal Inc</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'201 Altec Drive',city:'Elizabethtown',state:'Kentucky',zip:'42701',name:'AP Southridge Inc',phone:'270-234-0404',url:'http://www.appliedprocess.com/apsouthridge.aspx',fax:'270-234-0505'});</url><loc>37.67,-85.93</loc><name>AP Southridge Inc</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'State Highway 91',city:'Oshkosh',state:'Wisconsin',zip:'59404',name:'AP Westshore, Inc',phone:'920-235-2001',url:'http://www.appliedprocess.com/apwestshore.aspx',fax:''});</url><loc>47.54,-111.41</loc><name>AP Westshore, Inc</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'12238 Newburgh Rd',city:'Livonia',state:'Michigan',zip:'48150',name:'Applied Process, Inc',phone:'734-464-2030',url:'http://www.appliedprocess.com/ap.aspx',fax:'734-464-6314'});</url><loc>42.37,-83.41</loc><name>Applied Process, Inc</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2875 Lincoln St',city:'Muskegon',state:'Michigan',zip:'49441',name:'Cannon Muskegon Corp.',phone:'231-755-1681',url:'http://www.c-mgroup.com',fax:'231-755-4975'});</url><loc>43.2,-86.3</loc><name>Cannon Muskegon Corp.</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'242 South Peartl St.',city:'Berlin',state:'Wisconsin',zip:'54923',name:'Grede Berlin',phone:'920-361-2220',url:'http://www.citation.net',fax:'920-361-4017'});</url><loc>43.96,-88.95</loc><name>Grede Berlin</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2217 Carolina Ave',city:'Bessemer',state:'AL',zip:'35020',name:'Grede Bessemer',phone:'205-424-4030',url:'http://www.citation.net',fax:'205-425-7318'});</url><loc>33.4,-86.95</loc><name>Grede Bessemer</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'530 East Main St.',city:'Biscoe',state:'North Carlonia',zip:'27209',name:'Grede Biscoe',phone:'910-428-2111',url:'http://www.citation.net',fax:'910-428-4986'});</url><loc>35.36,-79.77</loc><name>Grede Biscoe</name></state>\n" : "";
	$foundries .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'210 Ann Ave.',city:'Brewton',state:'Alabama',zip:'36426',name:'Grede Brewton',phone:'251-867-5481',url:'http://www.citation.net',fax:'251-867-0525'});</url><loc>31.1,-87.07</loc><name>Grede Brewton</name></state>\n" : "";
	$foundries .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'N2480 County Highway M',city:'Browntown',state:'Wisconsin',zip:'53522',name:'Grede Browntown',phone:'608-966-3261',url:'http://www.citation.net',fax:'608-966-3851'});</url><loc>42.58,-89.79</loc><name>Grede Browntown</name></state>\n" : "";
	$foundries .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'PO Box 230',city:'Columbiana',state:'Alabama',zip:'35051',name:'Grede Columbiana',phone:'205-669-5700',url:'http://www.citation.net',fax:''});</url><loc>33.19,-86.6</loc><name>Grede Columbiana</name></state>\n" : "";
	$foundries .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'801 South Carpenter Ave.',city:'Kingsford',state:'Michigan',zip:'49801',name:'Grede Kingsford',phone:'906-774-7250',url:'http://www.citation.net',fax:'906-779-0228'});</url><loc>45.8,-88.07</loc><name>Grede Kingsford</name></state>\n" : "";
	$foundries .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'PO Box 670',city:'Marion',state:'Alabama',zip:'36756',name:'Grede Marion',phone:'334-683-6101',url:'http://www.citation.net',fax:'334-683-8365'});</url><loc>32.64,-87.34</loc><name>Grede Marion</name></state>\n" : "";
	$foundries .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'PO Box 300',city:'Menomonee Falls',state:'Wisconsin',zip:'53052',name:'Grede Menomonee Falls',phone:'262-781-8210',url:'http://www.citation.net',fax:'262-781-9165'});</url><loc>43.18,-88.12</loc><name>Grede Menomonee Falls</name></state>\n" : "";
	$foundries .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2700 East Plum St.',city:'New Castle',state:'Indiana',zip:'47362',name:'Grede New Castle',phone:'765-521-8000',url:'http://www.citation.net',fax:'765-593-3202'});</url><loc>39.93,-85.35</loc><name>Grede New Castle</name></state>\n" : "";
	$foundries .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'700 Ash St.',city:'Reedsburg',state:'Wisconsin',zip:'53959',name:'Grede Reedsburg',phone:'608-524-6424',url:'http://www.citation.net',fax:'608-524-9501'});</url><loc>43.53,-90</loc><name>Grede Reedsburg</name></state>\n" : "";
	$foundries .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'5200 Foundry Circle',city:'St. Cloud',state:'Minnesota',zip:'56303',name:'Grede St. Cloud',phone:'320-255-5200',url:'http://www.citation.net',fax:'320-202-3665'});</url><loc>45.57,-94.22</loc><name>Grede St. Cloud</name></state>\n" : "";
	$foundries .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'6432 West State St.',city:'Wauwatosa',state:'Wisconsin',zip:'53213',name:'Grede Wauwatosa',phone:'414-771-6700',url:'http://www.citation.net',fax:'414-479-8200'});</url><loc>43.05,-87.99</loc><name>Grede Wauwatosa</name></state>\n" : "";
	$foundries .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'805 East Boston',city:'Wichita',state:'Kansas',zip:'67211',name:'Grede Wichita',phone:'316-262-7204',url:'http://www.citation.net',fax:'316-337-9370'});</url><loc>37.67,-97.33</loc><name>Grede Wichita</name></state>\n" : "";
	$foundries .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'99 Crestview Drive Extension',city:'Transfer',state:'Pennsylvania',zip:'16154',name:'Greenville Metals, INC.',phone:'724-646-0654',url:'http://www.greenvillemetals.com/',fax:'724-646-0661'});</url><loc>41.33,-80.44</loc><name>Greenville Metals, INC.</name></state>\n" : "";
	$foundries .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2738 Commerce Way',city:'Ogden',state:'Utah',zip:'84401',name:'GSC Foundries Inc',phone:'801-627-1660',url:'http://www.gscutah.com/webapp/index.html',fax:'801-399-2109'});</url><loc>41.22,-112.02</loc><name>GSC Foundries Inc</name></state>\n" : "";
	$foundries .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1600 NorthSide Industrial Blvd.',city:'Columbus',state:'Georgia',zip:'31904',name:'Intermet - Columbus Foundry',phone:'706-596-2334',url:'http://www.intermet.com/capabilities/loc-columbus.html',fax:'706-324-1138'});</url><loc>32.53,-84.97</loc><name>Intermet - Columbus Foundry</name></state>\n" : "";
	$foundries .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'555 West 25th St.',city:'Hibbing',state:'Minnesota',zip:'55746',name:'Intermet - Hibbing Foundry',phone:'218-263-8871',url:'http://www.intermet.com/capabilities/loc-hibbing.html',fax:'218-263-5039'});</url><loc>47.42,-92.95</loc><name>Intermet - Hibbing Foundry</name></state>\n" : "";
	$foundries .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1701 West Main St.',city:'Radford',state:'Virgnia',zip:'24141',name:'Intermet - New River Foundry',phone:'540-731-0500',url:'http://www.intermet.com/capabilities/loc-newriver.html',fax:'540-731-0506'});</url><loc>37.12,-80.59</loc><name>Intermet - New River Foundry</name></state>\n" : "";
	$foundries .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1132 Mount Athos Rd',city:'Lynchburg',state:'Virginia',zip:'24504',name:'Intermet- Archer Creek Foundry',phone:'434-528-8200',url:'http://www.intermet.com/capabilities/loc-archercreek.html',fax:'434-528-8486'});</url><loc>37.4,-79.06</loc><name>Intermet- Archer Creek Foundry</name></state>\n" : "";
	$foundries .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2817 McCracken St.',city:'Muskegon',state:'Michigan',zip:'49441',name:'M. Argueso & Co., INC. -Muskegon',phone:'231-759-7304',url:'http://www.argueso.com',fax:'231-759-7570'});</url><loc>43.23,-86.25</loc><name>M. Argueso & Co., INC. -Muskegon</name></state>\n" : "";
	$foundries .= ( $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2628 River Ave',city:'Rosemead',state:'California',zip:'91770',name:'M. Argueso & Co., INC. -Rosemead',phone:'626-573-3000',url:'http://www.argueso.com',fax:'626-573-3005'});</url><loc>34.06,-118.07</loc><name>M. Argueso & Co., INC. -Rosemead</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'700 China St',city:'Crooksville',state:'Ohio',zip:'43731',name:'PCC Airfoils Inc - Crooksville',phone:'740-982-6025',url:'http://www.pccair.com/',fax:''});</url><loc>39.78,-82.1</loc><name>PCC Airfoils Inc - Crooksville</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'3860 Union Ave SE',city:'Minerva',state:'Ohio',zip:'46657',name:'PCC Airfoils Inc - Minerva',phone:'330-868-6441',url:'http://www.pccair.com/',fax:''});</url><loc>40.75,-81.09</loc><name>PCC Airfoils Inc - Minerva</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1400 Pope Drive',city:'Douglas',state:'Georgia',zip:'31535',name:'PCC Airfoils LLC - Douglas',phone:'912-384-6633',url:'http://www.pccairfoils.com',fax:'912-384-0100'});</url><loc>31.49,-82.87</loc><name>PCC Airfoils LLC - Douglas</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'8607 Tyler Blvd',city:'Mentor',state:'Ohio',zip:'44060',name:'PCC Airfoils LLC - Mentor',phone:'440-205-2170',url:'http://www.pccairfoils.com',fax:'440-205-3733'});</url><loc>41.69,-81.33</loc><name>PCC Airfoils LLC - Mentor</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'29501 Clayton Ave',city:'Wickliffe',state:'Ohio',zip:'44092',name:'PCC Airfoils LLC - SMP Plant',phone:'440-585-3100',url:'http://www.pccsmp.com/',fax:'440-585-6961'});</url><loc>41.61,-81.47</loc><name>PCC Airfoils LLC - SMP Plant</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'1781 Octavia Rd',city:'Cleveland',state:'Ohio',zip:'44112',name:'PCC Airfoils LLC - SRI',phone:'440-944-1880',url:'http://www.pccairfoils.com',fax:'216-692-7981'});</url><loc>41.55,-81.57</loc><name>PCC Airfoils LLC - SRI</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'2727 Lockheed Way',city:'Carson City',state:'Nevada',zip:'89706',name:'PCC Structural - Carson City',phone:'775-883-3800',url:'http://www.pccstructurals.com/locations/carson_city.php',fax:''});</url><loc>39.2,-119.74</loc><name>PCC Structural - Carson City</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'35 Industrial Park Dr.',city:'Franklin',state:'New Hampshire',zip:'3235',name:'PCC Structural - Franklin',phone:'603-286-4301',url:'http://www.pccstructurals.com/locations/franklin.php',fax:''});</url><loc>43.42,-71.66</loc><name>PCC Structural - Franklin</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'839 Poquonnock Rd',city:'Groton',state:'CT',zip:'6340',name:'PCC Structural - Groton',phone:'860-445-7421',url:'http://www.pccstructurals.com/locations/groton.php',fax:''});</url><loc>41.34,-72.05</loc><name>PCC Structural - Groton</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'4600 SE Harney Dr',city:'Portland',state:'Oregon',zip:'97206',name:'PCC Structural - Milwaukie',phone:'503-353-1019',url:'http://www.pccstructurals.com/locations/milwaukie.php',fax:''});</url><loc>45.46,-122.61</loc><name>PCC Structural - Milwaukie</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'4600 SE Harney Dr',city:'Portland',state:'Oregon',zip:'97206',name:'PCC Structural - Portland (Steel)',phone:'503-777-3881',url:'http://www.pccstructurals.com/locations/portland_steel.php',fax:''});</url><loc>45.46,-122.61</loc><name>PCC Structural - Portland (Steel)</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'4600 SE Harney Dr',city:'Portland',state:'Oregon',zip:'97206',name:'PCC Structural - Portland (Titanium)',phone:'503-777-3881',url:'http://www.pccstructurals.com/locations/portland_titanium.php',fax:''});</url><loc>45.46,-122.61</loc><name>PCC Structural - Portland (Titanium)</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'414 Hester St.',city:'San Leandro',state:'California',zip:'94577',name:'PCC Structural - San Leandro',phone:'510-568-6400',url:'http://www.pccstructurals.com/locations/san_leandro.php',fax:''});</url><loc>37.72,-122.19</loc><name>PCC Structural - San Leandro</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'PO Box 188',city:'Tilton',state:'New Hampshire',zip:'3276',name:'PCC Structural - Tilton',phone:'603-286-4301',url:'http://www.pccstructurals.com/locations/tilton.php',fax:''});</url><loc>43.43,-71.58</loc><name>PCC Structural - Tilton</name></state>\n" : "";
	$foundries .= ( $_d["t1"] == "1" || $_d["t3"] == "1" ) ? "<state id=\"point\"><url>javascript:showData({address:'4600 SE Harney Dr.',city:'Portland',state:'Oregon',zip:'97260',name:'PCC Structural - Clackamas',phone:'503-777-3881',url:'http://www.pccstructurals.com/locations/clackamas.php',fax:''});</url><loc>45.46,-122.61</loc><name>PCC Structural - Clackamas</name></state>\n" : "";

}

$data_states = <<<DATA_STATES


	<state id="AL">
		<name>Alabama</name>
		<data>1</data>
	</state>
	<state id="AK">
		<name>Alaska</name>
		<data>8</data>
	</state>
	<state id="AZ">
		<name>Arizona</name>
		<data>1</data>
	</state>
	<state id="AR">
		<name>Arkansas</name>
		<data>1</data>
	</state>
	<state id="CA">
		<name>California</name>
		<data>1</data>
	</state>
	<state id="CO">
		<name>Colorado</name>
		<data>1</data>
	</state>
	<state id="CT">
		<name>Connecticut</name>
		<data>1</data>
	</state>
	<state id="DE">
		<name>Delaware</name>
		<data>1</data>
	</state>
	<state id="DC">
		<name>District of Columbia</name>
		<data>0</data>
	</state>
	<state id="FL">
		<name>Florida</name>
		<data>1</data>
	</state>
	<state id="GA">
		<name>Georgia</name>
		<data>1</data>
	</state>
	<state id="HI">
		<name>Hawaii</name>
		<data>8</data>
	</state>
	<state id="ID">
		<name>Idaho</name>
		<data>1</data>
	</state>
	<state id="IL">
		<name>Illinois</name>
		<data>1</data>
	</state>
	<state id="IN">
		<name>Indiana</name>
		<data>1</data>
	</state>
	<state id="IA">
		<name>Iowa</name>
		<data>0</data>
	</state>
	<state id="KS">
		<name>Kansas</name>
		<data>1</data>
	</state>
	<state id="KY">
		<name>Kentucky</name>
		<data>0</data>
	</state>
	<state id="LA">
		<name>Louisiana</name>
		<data>1</data>
	</state>
	<state id="ME">
		<name>Maine</name>
		<data>0</data>
	</state>
	<state id="MD">
		<name>Maryland</name>
		<data>1</data>
	</state>
	<state id="MA">
		<name>Massachusetts</name>
		<data>0</data>
	</state>
	<state id="MI">
		<name>Michigan</name>
		<data>0</data>
	</state>
	<state id="MN">
		<name>Minnesota</name>
		<data>0</data>
	</state>
	<state id="MS">
		<name>Mississippi</name>
		<data>1</data>
	</state>
	<state id="MO">
		<name>Missouri</name>
		<data>1</data>
	</state>
	<state id="MT">
		<name>Montana</name>
		<data>1</data>
	</state>
	<state id="NE">
		<name>Nebraska</name>
		<data>1</data>
	</state>
	<state id="NV">
		<name>Nevada</name>
		<data>1</data>
	</state>
	<state id="NH">
		<name>New Hampshire</name>
		<data>0</data>
	</state>
	<state id="NJ">
		<name>New Jersey</name>
		<data>1</data>
	</state>
	<state id="NM">
		<name>New Mexico</name>
		<data>1</data>
	</state>
	<state id="NY">
		<name>New York</name>
		<data>1</data>
	</state>
	<state id="NC">
		<name>North Carolina</name>
		<data>1</data>
	</state>
	<state id="ND">
		<name>North Dakota</name>
		<data>0</data>
	</state>
	<state id="OH">
		<name>Ohio</name>
		<data>1</data>
	</state>
	<state id="OK">
		<name>Oklahoma</name>
		<data>1</data>
	</state>
	<state id="OR">
		<name>Oregon</name>
		<data>1</data>
	</state>
	<state id="PA">
		<name>Pennsylvania</name>
		<data>1</data>
	</state>
	<state id="RI">
		<name>Rhode Island</name>
		<data>0</data>
	</state>
	<state id="SC">
		<name>South Carolina</name>
		<data>1</data>
	</state>
	<state id="SD">
		<name>South Dakota</name>
		<data>1</data>
	</state>
	<state id="TN">
		<name>Tennessee</name>
		<data>1</data>
	</state>
	<state id="TX">
		<name>Texas</name>
		<data>1</data>
	</state>
	<state id="UT">
		<name>Utah</name>
		<data>1</data>
	</state>
	<state id="VT">
		<name>Vermont</name>
		<data>0</data>
	</state>
	<state id="VA">
		<name>Virginia</name>
		<data>1</data>
	</state>
	<state id="WA">
		<name>Washington</name>
		<data>1</data>
	</state>
	<state id="WV">
		<name>West Virginia</name>
		<data>0</data>
	</state>
	<state id="WI">
		<name>Wisconsin</name>
		<data>0</data>
	</state>
	<state id="WY">
		<name>Wyoming</name>
		<data>1</data>
	</state>
</us_states>
DATA_STATES;

print '<?xml version="1.0" encoding="iso-8859-1"?>' . $data_top . $mills . $foundries . $data_states;

?>