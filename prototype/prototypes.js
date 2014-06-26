/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Sep 05 2012
*/
/////////////
/* Variablennamen ausgeben...
function obSub(ob) {var r = [];var i = 0;for (var z in ob) {
if (ob.hasOwnProperty(z)) {r[i++] = z;}}return r;}

function getVarName(variable){
   return obSub(window).map(function(a){ 
           if( window[a] === variable ){return a} }).sort()[0]
}

function House(){  }
var tre = new House()
alert( getVarName(tre) )
*/
//////////////
/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_Prototypes()
{
	// Declarations...
	this.oWindow = window;
	this.oHTMLElement = null;
	
	// Construct...
	if (typeof(this.oWindow.HTMLElement) != 'undefined') {this.oHTMLElement = this.oWindow.HTMLElement;}
	else if (typeof(Element) != 'undefined') {this.oHTMLElement = Element;}

	// Methods...
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param xValue [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.setOnHtmlElement = function(_sName, _xValue)
	{
		if (typeof(_xInsertElement) == 'undefined') {var _xInsertElement = null;}
		
		_xValue = this.getRealParameter({'oParameters': _sName, 'sName': 'xValue', 'xParameter': _xValue});
		_sName = this.getRealParameter({'oParameters': _sName, 'sName': 'sName', 'xParameter': _sName});
		
		return this.setOnElement(this.oHTMLElement, _sName, _xValue);
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param xSetter [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xGetter [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.setOnHtmlElementSetterAndGetter = function(_sName, _xSetter, _xGetter)
	{
		if (typeof(_xSetter) == 'undefined') {var _xSetter = null;}
		if (typeof(_xGetter) == 'undefined') {var _xGetter = null;}
		
		_xSetter = this.getRealParameter({'oParameters': _sName, 'sName': 'xSetter', 'xParameter': _xSetter});
		_xGetter = this.getRealParameter({'oParameters': _sName, 'sName': 'xGetter', 'xParameter': _xGetter});
		_sName = this.getRealParameter({'oParameters': _sName, 'sName': 'sName', 'xParameter': _sName});
		
		return this.setOnElementSetterAndGetter(this.oHTMLElement, _sName, _xSetter, _xGetter);
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param oClass [needed][type]object[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param xValue [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.setOnElement = function(_oClass, _sName, _xValue)
	{
		if (typeof(_sName) == 'undefined') {var _sName = null;}
		if (typeof(_xValue) == 'undefined') {var _xValue = null;}
		
		_sName = this.getRealParameter({'oParameters': _oClass, 'sName': 'sName', 'xParameter': _sName});
		_xValue = this.getRealParameter({'oParameters': _oClass, 'sName': 'xValue', 'xParameter': _xValue});
		_oClass = this.getRealParameter({'oParameters': _oClass, 'sName': 'oClass', 'xParameter': _oClass, 'bNotNull': true});
		
		if ((_sName == null) || (_sName == '')) {return false;}
		if (!_oClass) {return false;}
		if (typeof(_oClass.prototype[_sName]) == 'undefined') {_oClass.prototype[_sName] = _xValue;}
		return true;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param oClass [needed][type]object[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param xSetter [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xGetter [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.setOnElementSetterAndGetter = function(_oClass, _sName, _xSetter, _xGetter)
	{
		if (typeof(_sName) == 'undefined') {var _sName = null;}
		if (typeof(_xSetter) == 'undefined') {var _xSetter = null;}
		if (typeof(_xGetter) == 'undefined') {var _xGetter = null;}
		
		_sName = this.getRealParameter({'oParameters': _oClass, 'sName': 'sName', 'xParameter': _sName});
		_xSetter = this.getRealParameter({'oParameters': _oClass, 'sName': 'xSetter', 'xParameter': _xSetter});
		_xGetter = this.getRealParameter({'oParameters': _oClass, 'sName': 'xGetter', 'xParameter': _xGetter});
		_oClass = this.getRealParameter({'oParameters': _oClass, 'sName': 'oClass', 'xParameter': _oClass, 'bNotNull': true});
		
		if ((_sName == null) || (_sName == '')) {return false;}
		if (!_oClass) {return false;}
		if (typeof(_oClass.prototype.__defineSetter__) != 'undefined')
		{
			// var _oPrototype = _oClass.prototype[_sName];	// not working in Firefox!
			// var _oPrototype = _oClass.prototype;			// not working in Firefox!
			// if (typeof(_oPrototype[_sName]) == 'undefined')
			// {
				_oClass.prototype.__defineSetter__(_sName, _xSetter);
				_oClass.prototype.__defineGetter__(_sName, _xGetter);
			// }
			return true;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sSetClass [needed][type]string[/type]
	[en]...[/en]
	
	@param oGetClass [needed][type]object[/type]
	[en]...[/en]
	
	@param sGetClass [needed][type]string[/type]
	[en]...[/en]
	*/
	this.classToPrototypes = function(_sSetClass, _oGetClass, _sGetClass)
	{
		if (typeof(_oGetClass) == 'undefined') {var _oGetClass = null;}
		if (typeof(_sGetClass) == 'undefined') {var _sGetClass = null;}
		
		_oGetClass = this.getRealParameter({'oParameters': _sSetClass, 'sName': 'oGetClass', 'xParameter': _oGetClass});
		_sGetClass = this.getRealParameter({'oParameters': _sSetClass, 'sName': 'sGetClass', 'xParameter': _sGetClass});
		_sSetClass = this.getRealParameter({'oParameters': _sSetClass, 'sName': 'sSetClass', 'xParameter': _sSetClass});
		
		for (var _sFunction in _oGetClass)
		{
			var _sFunctionEval = '';
			var _oClassFunction = _oGetClass[_sFunction];
			if (typeof(_oClassFunction) == 'function')
			{
				_sFunctionEval += 'oPGPrototypes.setOnElement('+_sSetClass+', _sFunction, ';
				_sFunctionEval += 'function() {var _sEval = "'+_sGetClass+'.'+_sFunction+'(this";';
					_sFunctionEval += 'if (typeof(arguments) != "undefined") {';
						_sFunctionEval += 'for (var i=0; i<arguments.length; i++) {_sEval += ","+arguments[i];}';
					_sFunctionEval += '} ';
					_sFunctionEval += '_sEval += ");"; ';
					_sFunctionEval += 'return eval(_sEval);';
				_sFunctionEval += '});';
				eval(_sFunctionEval);
			}
		}
	}
	/* @end method */
}
/* @end class */
classPG_Prototypes.prototype = new classPG_ClassBasics();
var oPGPrototypes = new classPG_Prototypes();

if (typeof(oPGGfx) != 'undefined')
{
	oPGPrototypes.setOnHtmlElement({'sName': 'setAlpha', 'xValue': function(_iAlphaPercent) {oPGGfx.setElementAlpha({'xElement': this, 'iAlphaPercent': _iAlphaPercent});}});
	oPGPrototypes.setOnHtmlElement({'sName': 'setOpacity', 'xValue': function(_iOpacityPercent) {oPGGfx.setElementOpacity({'xElement': this, 'iOpacityPercent': _iOpacityPercent});}});
	oPGPrototypes.setOnHtmlElement({'sName': 'setTransparency', 'xValue': function(_iTransparencyPercent) {oPGGfx.setElementTransparency({'xElement': this, 'iTransparencyPercent': _iTransparencyPercent});}});
	oPGPrototypes.setOnHtmlElement({'sName': 'getAlpha', 'xValue': function() {return oPGGfx.getElementAlpha({'xElement': this});}});
	oPGPrototypes.setOnHtmlElement({'sName': 'getOpacity', 'xValue': function() {return oPGGfx.getElementOpacity({'xElement': this});}});
	oPGPrototypes.setOnHtmlElement({'sName': 'getTransparency', 'xValue': function() {return oPGGfx.getElementTransparency({'xElement': this});}});
}

if (typeof(oPGBrowser) != 'undefined')
{
	oPGPrototypes.setOnHtmlElement({'sName': 'getPosX', 'xValue': function() {return oPGBrowser.getDocumentOffsetX({'xElement': this});}});
	oPGPrototypes.setOnHtmlElement({'sName': 'getPosY', 'xValue': function() {return oPGBrowser.getDocumentOffsetY({'xElement': this});}});
	oPGPrototypes.setOnHtmlElement({'sName': 'getSizeX', 'xValue': function() {return oPGBrowser.getSizeX({'xElement': this});}});
	oPGPrototypes.setOnHtmlElement({'sName': 'getSizeY', 'xValue': function() {return oPGBrowser.getSizeY({'xElement': this});}});
	oPGPrototypes.setOnHtmlElementSetterAndGetter({'sName': 'outerHTML', 'xSetter': function(_sHtml) {oPGBrowser.setOuterHtml({'xContext': this, 'sHtml': _sHtml});}, 'xGetter': function() {return oPGBrowser.getOuterHtml({'xContext': this});}});
}
