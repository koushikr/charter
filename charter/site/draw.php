<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
       <title> Data Visual </title>
        <!-- CSS -->
		<link href='http://fonts.googleapis.com/css?family=Terminal+Dosis' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
		
		<link rel="stylesheet" type="text/css" href="../lib/jQuery/tipsy/tipsy.css"/>
		<link rel="stylesheet" type="text/css" href="lib/chosen/chosen.css"/>
		<link rel="stylesheet" type="text/css" href="lib/minicolors/jquery.miniColors.css"/>
		<link rel="stylesheet" type="text/css" href="lib/slickgrid/slick.grid.css"/>
		<link rel="stylesheet" type="text/css" href="css/Aristo/Aristo.css"/>	
        <link rel="stylesheet" type="text/css" href="css/structure.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <link rel="stylesheet" type="text/css" href="../lib/jQuery/tooltip/jquery.ui.tooltip.css"/>
		<script type="text/javascript" src="lib/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="lib/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript" src="../lib/jQuery/tooltip/jquery.ui.tooltip.js"></script>

    </head>
        
    <body id="public">
        <div class="contentContainer">
			<div id="fixed-menu-top">

				<div id="goback">
					<a href="board.php"><img src="css/images/back.png" alt="Back" /></a>
				</div>	

		    	<div id="fixed-menu-top-content">
		        	<div class="logo">
		            	<span class="logotxt">Data Visual</span>
		            </div>
				</div>
		    </div>

	        <div class="leftContent1">
	            <div class="callForActionLeft">
	                parameters
	            </div>
	            
				<fieldset id="defaultAxisSelector" class="AxisSelector">

					<label>Category Axis</label>
				 	<select class="chzn-select" id="categoryAxisList"></select>

					<label>Measure Axis</label> 
				 	<select class="chzn-select" id="measureAxisList" multiple="multiple"></select>
				 	
				<!-- 	<button id="dataUpdater">Apply</button> -->
				</fieldset>
				
	            <fieldset id="MapAxisSelector"  class="AxisSelector">
				<label>Category Axis</label>
				<select class="select-deselect" id="categoryListForMap" ></select>

				<label>Latitude</label>
				<select class="chzn-select " id="latitudeForMap" class="measure-for-map"></select>
				
				<label>Longitude</label>
				<select class="chzn-select" id="longitudeForMap" class="measure-for-map"></select>
				
				<label>Size</label>
				<select class="select-deselect" id="sizeForMap" class="measure-for-map"></select>
				
			 	<button id="dataUpdater">Apply</button> 
				</fieldset>
				<div class="callForActionLeft">
	                options
	            </div>
	            
				<div id="accordion" class="tab-view">
                            
					<ul class="ribbon">
						<li>
							<a href="#charttab" title="Edit Chart Properties">Chart</a>
						</li>							
						<li>
							<a href="#canvastab" title="Edit Canvas Properties">Canvas</a>
						</li>	
						<li>
							<a href="#gridstab" title="Edit Grid Properties">Grids</a>
						</li>							
						<li>
							<a href="#axestab" title="Edit Axis Properties">Axes</a>
						</li>							
						<li>
							<a href="#palettetab" title="Change Palettes">Palette</a>
						</li>
					</ul>
					<div id="canvastab">
						<!-- Check where should this be added --> 
						<!-- 
						<fieldset>
							<legend>Canvas</legend>
					 		<label>Background Color </label>
                     		<input value="#FFFFFF" class="colorPicker" size="8" type="text" id="canvasFillColor" /> 
                   			<label>Border Color </label>
                     		<input value="#CCCCCC" class="colorPicker" size="8" type="text" id="canvasBorderColor" /> 
                     		<label>Border Thickness </label><br />
                     		<div class="slider" id="canvasBorderThicknessSlider"></div>
                     		<input size="1" type="text" id="canvasBorderThickness" disabled="disabled" value="3" />
                     	</fieldset> 
                     	-->
						<fieldset>
							<legend>Caption</legend>
							<label>Text</label> 
							<input type="text" id="caption" value="Profit (Yearly)" size="20" />

							<label>Color</label>
							<input value="#000000" class="colorPicker" size="8" type="text" id="captionColor" /> 

							<label>Size</label>
							<div class="slider" id="captionSizeSlider"></div>
							<input size="2" type="text" id="captionSize" disabled="disabled" value="20" />
						
						</fieldset>

						<fieldset>
							<legend>Labels</legend>
							<label>Show</label>
							<input type="checkbox" checked="checked" id="showLabels" />						  

							<label>Color</label>
							<input value="#000000" class="colorPicker" size="8" type="text" id="labelFontColor" />

							<label>Size</label>
							<div class="slider" id="labelFontSizeSlider"></div>
							<input size="8" type="text" id="labelFontSize" disabled="disabled" value="15" />

							<label>Angle</label>
							<div class="slider" id="labelRotateAngleSlider"></div>
							<input size="8" type="text" id="labelRotateAngle" disabled="disabled" value="0" />
						</fieldset>
	
						<fieldset>
							<legend>Other</legend>
							
							<label>Show Legend</label>
							<input type="checkbox" checked="checked" id="showLegends" />
							
							<label>Show Values</label>
							<input type="checkbox" checked="checked" id="showValues" />

							<label>Show Tooltip </label> 
							<input type="checkbox" checked="checked" id="toolTip" />

							<label>Background Color</label>
							<input value="#FFFFFF" class="colorPicker" size="8" type="text" id="chartFillColor" /> 
						</fieldset>
					</div>

					<div id="charttab">
						<fieldset>
							<legend>Chart type</legend>
							<select name="chartTypes" id="chartTypes">
							<option value="select">Select a Chart</option>
							<option value="table">Table</option>
							<option value="Bar" selected="selected">Bar Chart</option>
							<option value="Line">Line Chart</option>
							<option value="Pie">Pie Chart</option>
							<option value="Donut">Donut Chart</option>
							<option value="Bubble">Bubble Chart</option>
							<option value="Area">Area Chart</option>
							<option value="StackedArea">Stacked Area Chart</option>
							<option value="Map">Map</option>
							<option value="Bullet">Bullet Chart</option>
							</select>
						</fieldset>

						<fieldset id="dataDiv">
							<legend>Options</legend>
							<label>Type</label>
							<select id="type">
							  <option value="h">Horizontal</option >
							  <option selected="selected" value="v"> Vertical </option>
							</select>
						</fieldset>

					</div>
					<div id="gridstab">
						<fieldset>
							<legend>Horizontal</legend>
							<label>Show Grid Lines </label> 
							<input type="checkbox" checked="checked" id="horGridShow" />

							<label>Grid Line Color</label> 
							<input value="#CCCCCC" class="colorPicker" size="8" type="text" id="horGridColor" /> 

							<label>Grid Line Thickness</label>
							<div class="slider" id="horGridThicknessSlider"></div>
							<input size="8" type="text" id="horGridThickness" value="1" disabled="disabled" />

							<label>Show Label</label>
							<input type="checkbox" checked="checked" id="horGridLabelShow" /> 
						</fieldset>
						<fieldset>
							<legend>Vertical</legend>
							<label>Show Grid Lines</label> 
							<input type="checkbox" checked="checked" id="verGridShow" />

							<label>Grid Line Color</label>
							<input value="#CCCCCC" class="colorPicker" size="8" type="text" id="verGridColor" /> 

							<label>Grid Line Thickness</label>
							<div class="slider" id="verGridThicknessSlider"></div>
							<input size="8" type="text" id="verGridThickness" value="1" disabled="disabled" />

							<label>Show Label</label>
							<input type="checkbox" id="verGridLabelShow" />
						</fieldset>

					</div>
					<div id="axestab">
						<fieldset>
							<legend>Horizontal</legend>
							<label>Color </label>
							<input value="#CCCCCC" class="colorPicker" size="8" type="text" id="horAxisColor" /> 

							<label>Thickness</label>
							<div class="slider" id="horAxisThicknessSlider"></div>
							<input size="2" type="text" id="horAxisThickness" disabled="disabled" value="2" /> 

							<label>Label X Axis</label> 
							<input type="text" id="xAxisName" size="15" />

							<label>Label Font Size: </label>
							<div class="slider" id="horAxisLabelSizeSlider"></div>
							<input size="8" type="text" id="horAxisLabelSize" disabled="disabled" value="12" />

							<label>Label Color:</label>
							<input value="#000000" class="colorPicker" size="8" type="text" id="horAxisLabelColor" />
						</fieldset>
						<fieldset>
							<legend>Vertical</legend>

							<label>Color </label>
							<input value="#CCCCCC" class="colorPicker" size="8" type="text" id="verAxisColor" /> 

							<label>Thickness</label>
							<div class="slider" id="verAxisThicknessSlider"></div>
							<input size="1" type="text" id="verAxisThickness" disabled="disabled" value="2" /> 
				
							<label>Label Y Axis</label> 
							<input type="text" id="yAxisName" size="15" />

							<label>Label Font Size</label>
							<div class="slider" id="verAxisLabelSizeSlider"></div>
							<input size="8" type="text" id="verAxisLabelSize" disabled="disabled" value="12" /> 

							<label>Label Color</label>
							<input value="#000000" class="colorPicker" size="8" type="text" id="verAxisLabelColor" />
						</fieldset>

					</div>
					<div id="palettetab">
						<fieldset>
							<legend>Palette</legend>
							<label>Choose</label>
							<!-- TODO: Change the name from presetPalette to Palette -->
							<select id="presetPalette"></select><br/>
						</fieldset>
						<fieldset id="colors">
							<legend>Customize</legend>
							<label>Change</label>
						</fieldset>
					</div>   
				</div>
				</div>
	            <div class="middleContent1">
            	<div id="middleTabs">
					<ul>
						<li style="display:none">
							<a href="#chart">Chart</a>
						</li>							
						<li style="display:none">
							<a href="#dataGrid">Data</a>
						</li>	
					</ul>					
					<div id="chart">
					</div>
					<div id="dataGrid" style="display:none">
					</div>
				</div>	  				                
            </div>
			<div class="rightContent1">
				<div class="callForActionLeft">
	                filters
	            </div>
	            <div id="filter"  class="tab-view">
					<ul class="ribbon">
						<li>
							<a href="#catFilter" title="Edit Measure Filters">Category</a>
						</li>	
						<li>
							<a href="#measureFilter" title="Edit Measure Filters">Measure</a>
						</li>							
						
					</ul>
					
					<div id="catFilter">
						<label style="padding: 0 40px 0 0;">Select All</label>
						<input type="checkbox" checked="checked" id="allCategories" />	
						<select id="categoryValues" multiple="multiple"></select>
					</div>
					<div id="measureFilter">
					
					</div>
					
				</div>
			</div>  
            </div>
  
			<div id="dialog-illegal-data" title="Error" class="dialog">
			<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>The measure axis can only have numbers. String values not allowed</p>
			</div> 		
		<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAAYZ9eMYFYusxZt-1RKXLI7RRHhAsaxs5VjhFCDs4CxQ-G2qh_dhSstmN5IR0MH0kI1flLEIY43Z2-gw" type="text/javascript"></script>
		<script type="text/javascript" src="../lib/protovis/protovis-d3.3.js"></script>
		<script type="text/javascript" src="../lib/jQuery/tipsy/jquery.tipsy.js"></script>
		<script type="text/javascript" src="../lib/jQuery/tipsy/tipsy.js"></script>
		<script type="text/javascript" src="../src/aurora.js"></script>
		<script type="text/javascript" src="../src/bar.js"></script>
		<script type="text/javascript" src="../src/wedge.js"></script>
		<script type="text/javascript" src="../src/utility.js"></script>
		<script type="text/javascript" src="../src/bubble.js"></script>
		<script type="text/javascript" src="../src/area.js"></script>
		<script type="text/javascript" src="../src/line.js"></script>
		<script type="text/javascript" src="../src/tree.js"></script>
		<script type="text/javascript" src="../src/bullet.js"></script>
		<script type="text/javascript" src="../src/map.js"></script>

		<script src="lib/jquery.event.drag-2.0.min.js"></script>
		<script src="lib/slickgrid/slick.core.js" type="text/javascript"></script>
		<script src="lib/slickgrid/plugins/slick.checkboxselectcolumn.js"></script>
		<script src="lib/slickgrid/plugins/slick.cellrangedecorator.js"></script>
		<script src="lib/slickgrid/plugins/slick.cellrangeselector.js"></script>
		<script src="lib/slickgrid/plugins/slick.cellselectionmodel.js"></script>
		<script src="lib/slickgrid/plugins/slick.rowselectionmodel.js"></script>
		<script src="lib/slickgrid/slick.editors.js"></script>
		<script src="lib/slickgrid/slick.grid.js"></script>
		
		<script src="lib/chosen/chosen.jquery.js" type="text/javascript"></script>

		<script type="text/javascript" src="lib/minicolors/jquery.miniColors.min.js"></script>
		<script type="text/javascript" src="lib/jlinq/jlinq.js"></script>
		
		<script type="text/javascript" src="js/constants.js"></script>
		<script type="text/javascript" src="js/utility.js"></script>
		<script type="text/javascript" src="js/dataLoader.js"></script>
		<script type="text/javascript" src="js/chart-generator.js"></script>
      	<script type="text/javascript" src="js/filter.js"></script>
		
		
		<script type="text/javascript">
			$(function(){
	        	$('#accordion').tabs();
	        	$('#middleTabs').tabs();
	        	$("#filter").tabs();
	        	$("#categoryValues").chosen();
			});
			ARV.CG.initChartGenerator();
	/* 		$("#goback").tooltip({
				content:"Go back to Dashboard Page"
			});
			$("#dataUpdater").tooltip({
				content:"Update the data"
			}); */
		</script>        
	</body>
</html>
