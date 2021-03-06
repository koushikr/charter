/**
 * @Description The top-level aurora namespace. All public methods and
 *  fields should be registered on this namespace object.
 * @namespace The top-level aurora namespace, <tt>AR</tt>.
 */
var AR = {};

/**
 
 * Returns a prototype object suitable for extending the
 *         given class <tt>f</tt>. For more details, see Douglas Crockford's
 *         essay on prototypal inheritance.
 * @param  {function}
 *            f a constructor.
 * @returns a suitable prototype object.
 * @see Douglas Crockford's essay on <a
 *      href="http://javascript.crockford.com/prototypal.html">prototypal
 *      inheritance</a>.
 */
AR.extend = function (f) {
	function g() {}
	g.prototype = f.prototype || f;
	return new g();
};

/**
 * @class
 * The base class for the graph initilization.
 * Initializes the panel and sets parentDimensions and property values
 */
AR.Graph = function () {
	var self = this;
	self._dimension = {
		height: 400,
		width: 400,
		left: 60,
		right: 20,
		bottom: 60,
		top: 60
	};
	self._graphDef = undefined;
	self._pos = undefined;
	self._caption = undefined;
	self._horAxisLabel = undefined;
	self._verAxisLabel = undefined;
	self._horGrid = undefined;
	self._verGrid = undefined;
	self._outerPanel = undefined;
	self._panel = undefined;
	self._horAxis = undefined;
	self._verAxis = undefined;
};

/**
 * The function initializes the panel and sets the properties which are common to all graphs
 * @param {Object} graphDef The graph definition containing styling, data and chart speficig properties  
 */
AR.Graph.prototype.initialize = function (graphDef) {
	var self = this;
	self._outerPanel = new pv.Panel().left(0).right(0).bottom(0).top(0);
	self._panel = self._outerPanel.add(pv.Panel);
	self._panel.left(self._dimension.left).right(self._dimension.right).bottom(self._dimension.bottom).top(self._dimension.top);
	self._horAxis = self._panel.add(pv.Rule).bottom(0);
	self._verAxis = self._panel.add(pv.Rule).left(0);
	self._graphDef = graphDef;
	var properties = ["width", "height", "caption", "xAxisName", "yAxisName"];
	var upcasedProp;
	properties.forEach(function (property) {
		upcasedProp = property.substring(0, 1).toUpperCase() + property.substring(1);
		if (graphDef[property]) {
			self["set" + upcasedProp](graphDef[property]);
		}
	});
	var styles = graphDef.style;
	var prop;
	for (prop in styles) {
		upcasedProp = prop.substring(0, 1).toUpperCase() + prop.substring(1);
		if (styles.hasOwnProperty(prop)) {
			self["set" + upcasedProp](styles[prop]);
		}
	}
};

/**
 * Sets a graph's caption.
 * Caption is one of the properties of any graph
 * @param {string}
 *             Sets the caption for the given graph as the supplied parameter value
 */
AR.Graph.prototype.setCaption = function (newVal) {
	var self = this;
	if (self._caption) {
		self._caption.text(newVal);
	}
	else {
		self._caption = self._outerPanel.add(pv.Label).text(newVal).left(self._dimension.width / 2 + 40).top(0).textAlign("center").textBaseline("top");
	}
};

/**
 * Sets a graph's width.
 * Width is one of the properties of a graph
 * @param width Width for the given graph as the supplied parameter value
 *            
 */
AR.Graph.prototype.setWidth = function (width) {
	var self = this;
	self._dimension.width = width - self._dimension.left - self._dimension.right;
	self._outerPanel.width(width);
	if (self._caption) {
		self._caption.left(self._dimension.width / 2);
	}
};

/**
 * Sets a graph's Height.
 * @param height Height of the graph
 */
AR.Graph.prototype.setHeight = function (height) {
	var self = this;
	self._dimension.height = height - self._dimension.top - self._dimension.bottom;
	self._outerPanel.height(height);
};

/**
 * Sets a graph's xAxisName.
 * @param name {string}
 *             The string for the x Axis Label
 */
AR.Graph.prototype.setXAxisName = function (name) {
	var self = this;
	if (self._horAxisLabel) {
		self._horAxisLabel.text(name);
	}
	else {
		self._horAxisLabel = self._outerPanel.add(pv.Label).bottom(0).text(name).textAlign("center");
	}
};
/**
 * Sets a graph's yAxisName.
 * @param name {string}
 *             The string for the y Axis label
 */
AR.Graph.prototype.setYAxisName = function (name) {
	var self = this;
	if (self._verAxisLabel) {
		self._verAxisLabel.text(name);
	}
	else {
		self._verAxisLabel = self._panel.add(pv.Label).left(-30).text(name).textAlign("center").textAngle(-Math.PI / 2);
	}
};


/**
 * Sets horizontal rules in a graph.
 * Rules are nothing but lines that divide the graph to form a grid like structure
 * @param maxValue {integer}
 *                This is the maximimum value that the graph would have in horizontal direction. It is required to calculate the scale.
 * @param scaleType {object}
 *             It takes the scaleType (Linear/Ordinal etc)
 */

AR.Graph.prototype.setHorGridShow = function (maxValue, scaleType) {
	var self = this;
	self._y = pv.Scale[scaleType](0, maxValue).range(0, self._dimension.height - 40);
	if (!self._horGrid) {
		self._horGrid = self._panel.add(pv.Rule);
		self._horGrid.data(self._y.ticks().splice(1, self._y.ticks().length)).bottom(self._y);
	}
	else {
		self._horGrid.bottom(self._y);
	}
};

/**
 * It shows the Horizontal grid axis if the <b>status</b> is set to true
 * @param status {boolean}
 *          If set to true it show the labels for the Horizontal grid
 */
AR.Graph.prototype.setHorGridLabelShow = function (status) {
	var self = this;
	if (self._horGrid && status === true) {
		self._horGrid.anchor("left").add(pv.Label).text(self._y.tickFormat).font(AR.Utility.getSize(self._graphDef, "gridLabels", 15) + "px Arial");
	}
};

/**
 * Sets vertical rules in a graph.
 * Rules are nothing but lines that divide the graph to form a grid like structure
 * @param maxValue{integer}
 *              This is the maximimum value that the graph would have in vertical direction. It is required to calculate the scale.
 * @param scaleType {object}
 *           It takes the scaleType (Linear/Ordinal etc)
 *             
 */

AR.Graph.prototype.setVerGridShow = function (maxValue, scaleType) {
	var self = this;
	self._x = pv.Scale[scaleType](0, maxValue).range(0, self._dimension.width - 40);
	if (!self._verGrid) {
		self._verGrid = self._panel.add(pv.Rule);
		self._verGrid.data(self._x.ticks().splice(1, self._x.ticks().length)).left(self._x); /* }).anchor("bottom").add(pv.Label).text(x.tickFormat);*/
	}
	else {
		self._verGrid.left(self._x);
	}
};

/**
 * It shows the Vertical grid axis if the <b>status</b> is set to true
 * @param status {boolean}
 *         If set to true it show the labels for the vertical grid
 */
AR.Graph.prototype.setVerGridLabelShow = function (status) {
	var self = this;
	if (self._verGrid && status === true) {
		self._verGrid.anchor("bottom").add(pv.Label).text(self._x.tickFormat).font(AR.Utility.getSize(self._graphDef, "gridLabels", 15) + "px Arial");
	}
};

/**
 * Renders the Component
 * @param div {html node}
 *             The node in which the graph has to be rendered. If undefined grpah is rendered whereever the function is called.
 */
AR.Graph.prototype.render = function render(div) {
	var self = this;
	if (div || self.__pos) {
		self._outerPanel.canvas(div || self.__pos);
		self._outerPanel.render();
		self.__pos = div || self.__pos;
	}
	else {
		self._outerPanel.render();
	}
};

/**
 * The line element and the corresponding object of the chart
 */
AR.Graph.lineElements = [
	{
	name: "horAxis",
	obj: "_horAxis"
},
	{
	name: "verAxis",
	obj: "_verAxis"
},
	{
	name: "horGrid",
	obj: "_horGrid"
},
	{
	name: "verGrid",
	obj: "_verGrid"
},
	{
	name: "canvasBorder",
	obj: "_outerPanel"
}
];

/**
 * The label elements and their corresponding object
 */
AR.Graph.labelElements = [
	{
	name: "caption",
	obj: "_caption"
},
	{
	name: "horAxisLabel",
	obj: "_horAxisLabel"
},
	{
	name: "verAxisLabel",
	obj: "_verAxisLabel"
}
];

/**
 * The area elements and their corresponding objects
 */
AR.Graph.areaElements = [
	{
	name: "canvas",
	obj: "_outerPanel"
},
	{
	name: "chart",
	obj: "_panel"
}
];

/**
 * Returns the setter function for setting the <tt>protovisProp</tt> for the <tt>obj</tt>
 * @param protovisProp {string} The protovis property to be set
 * @param obj {Object} The object whose <tt>protovisProp</tt> is to be set
 *@param additionalData {String} Some additional data to set the property. 
 */
AR.Graph.getFunctions = function (protovisProp, obj, additionalData) {
	return function (value) {
		var o = this[obj];
		if (o) {
			o[protovisProp](value + (additionalData || ""));
		}
	};
};

/**
 * The function creates functions which set the <tt>property</tt> of the elements in the <tt>elementsArr</tt>
 * @param elementsArr {Array} The array of elements whose <tt>property</tt> is to be set
 * @param property {String} The property which is to be set 
 * @param protovisProp {String} The corresponding protovis property
 * @param additionalData {String} Some additional data to set the property. 
 */
AR.Graph.createFunctions = function (elementsArr, property, protovisProp, additionalData) {
	var i = 0;
	for (i = 0; i < elementsArr.length; i++) {
		var objName = elementsArr[i].name;
		var upcasedObjName = objName.substring(0, 1).toUpperCase() + objName.substring(1);
		var obj = elementsArr[i].obj;
		AR.Graph.prototype["set" + upcasedObjName + property] = AR.Graph.getFunctions(protovisProp, obj, additionalData);
	}
};

//here we create the functions
(function () {
	AR.Graph.createFunctions(AR.Graph.areaElements, "FillColor", "fillStyle");
	AR.Graph.createFunctions(AR.Graph.lineElements, "Thickness", "lineWidth");
	AR.Graph.createFunctions(AR.Graph.labelElements, "Color", "textStyle");
	AR.Graph.createFunctions(AR.Graph.labelElements, "Size", "font", "pt Arial");
	AR.Graph.createFunctions(AR.Graph.lineElements, "Color", "strokeStyle");
}());
