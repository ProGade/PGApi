/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Jun 07 2013
*/
var PG_WINDOW_MODE_RESIZEABLE = 1;
var PG_WINDOW_MODE_TOPMOST = 2;
var PG_WINDOW_MODE_DRAGABLE = 4;
var PG_WINDOW_MODE_DRAGABLE_BODY = 8;
var PG_WINDOW_MODE_DEFAULT = PG_WINDOW_MODE_RESIZEABLE+PG_WINDOW_MODE_DRAGABLE;

var PG_WINDOW_ELEMENT_CLOSE = 1;
var PG_WINDOW_ELEMENT_MAXIMIZE = 2;
var PG_WINDOW_ELEMENT_MINIMIZE = 4;
var PG_WINDOW_ELEMENT_MINIMIZETOTRAY = 8;
var PG_WINDOW_ELEMENT_TITLEBAR = 16;
var PG_WINDOW_ELEMENT_MENUBAR = 32;
var PG_WINDOW_ELEMENT_TOOLBAR = 64;
var PG_WINDOW_ELEMENT_STATUSBAR = 128;
var PG_WINDOW_ELEMENT_ICON = 256;
var PG_WINDOW_ELEMENT_MOSTTOP = 512;
var PG_WINDOW_ELEMENT_MAX = 1024;
var PG_WINDOW_ELEMENT_DEFAULT = PG_WINDOW_ELEMENT_CLOSE+PG_WINDOW_ELEMENT_MAXIMIZE+PG_WINDOW_ELEMENT_MINIMIZE+PG_WINDOW_ELEMENT_TITLEBAR;

function classPG_Window()
{
	// Declarations...
	this.sTitle = 'new Window';
	this.sIcon = '';
	this.sCssStyle = '';
	this.sCssClass = '';
	
	this.iMinSizeX = 0;
	this.iMinSizeY = 0;
	this.iMaxSizeX = 0;
	this.iMaxSizeY = 0;

	this.iMode = PG_WINDOW_MODE_DEFAULT;
	this.iElements = PG_WINDOW_ELEMENT_DEFAULT;
	
	this.bHideContentOnMove = true;
	this.bHideContentOnResize = true;
	this.iOpacityOnMove = 50;
	this.iOpacityOnResize = 50;
	
	// Construct...
	
	// Methods...
	this.showElement = function(_iElement)
	{
		// TODO
	}
	
	this.hideElement = function(_iElement)
	{
		// TODO
	}
	
	this.toggleElement = function(_iElement)
	{
		// TODO
	}
	
	this.isElementVisible = function(_iElement)
	{
		// TODO
	}
	
	this.getLayer = function()
	{
		var _oWindow = this.oDocument.getElementById(this.getID());
		if (_oWindow) {return _oWindow.style.zIndex;}
	}
	
	this.setLayer = function(_iLayer)
	{
		_iLayer = this.getRealParameter({'oParameters': _iLayer, 'sName': 'iLayer', 'xParameter': _iLayer});

		var _oWindow = this.oDocument.getElementById(this.getID());
		if (_oWindow) {_oWindow.style.zIndex = _iLayer;}
	}
	
	this.setPosX = function(_sPosX)
	{
		_sPosX = this.getRealParameter({'oParameters': _sPosX, 'sName': 'sPosX', 'xParameter': _sPosX});
		
		var _oWindow = this.oDocument.getElementById(this.getID());
		if (_oWindow) {_oWindow.style.left = _sPosX;}
	}
	
	this.setPosY = function(_sPosY)
	{
		_sPosY = this.getRealParameter({'oParameters': _sPosY, 'sName': 'sPosY', 'xParameter': _sPosY});
		
		var _oWindow = this.oDocument.getElementById(this.getID());
		if (_oWindow) {_oWindow.style.top = _sPosY;}
	}
	
	this.setPos = function(_sPosX, _sPosY)
	{
		if (typeof(_sPosY) == 'undefined') {var _sPosY = null;}
		
		_sPosY = this.getRealParameter({'oParameters': _sPosX, 'sName': 'sPosY', 'xParameter': _sPosY});
		_sPosX = this.getRealParameter({'oParameters': _sPosX, 'sName': 'sPosX', 'xParameter': _sPosX});
		
		if (_sPosX != null) {this.setPosX({'sPosX': _sPosX});}
		if (_sPosY != null) {this.setPosY({'sPosY': _sPosY});}
	}
	
	this.setSizeX = function(_iSizeX)
	{
		_sSizeX = this.getRealParameter({'oParameters': _sSizeX, 'sName': 'sSizeX', 'xParameter': _sSizeX});
		
		var _oWindow = this.oDocument.getElementById(this.getID());
		if (_oWindow) {_oWindow.style.width = _sSizeX;}
	}
	
	this.setSizeY = function(_iSizeY)
	{
		_sSizeY = this.getRealParameter({'oParameters': _sSizeY, 'sName': 'sSizeY', 'xParameter': _sSizeY});
		
		var _oWindow = this.oDocument.getElementById(this.getID());
		if (_oWindow) {_oWindow.style.height = _sSizeY;}
	}
	
	this.setSize = function(_sSizeX, _sSizeY)
	{
		if (typeof(_sSizeY) == 'undefined') {var _sSizeY = null;}
		
		_sSizeY = this.getRealParameter({'oParameters': _sSizeX, 'sName': 'sSizeY', 'xParameter': _sSizeY});
		_sSizeX = this.getRealParameter({'oParameters': _sSizeX, 'sName': 'sSizeX', 'xParameter': _sSizeX});
		
		if (_sSizeX != null) {this.setSizeX({'sSizeX': _sSizeX});}
		if (_sSizeY != null) {this.setSizeY({'sSizeY': _sSizeY});}
	}
	
	this.buildInto = function(_xIntoParent, _sWindowID, _iMode, _iElements)
	{
		var _oWindow = this.oDocument.createElement('div');
		oPGNodes.setStyles(
			{
				'xElement': _oWindow, 
				'axStyles': [
					{'sProperty': 'position', 'xValue': 'absolute'},
					{'sProperty': 'width', 'xValue': '100px'},
					{'sProperty': 'height', 'xValue': '100px'}
				]
			}
		);
		oPGNodes.insertInto({'xIntoParent': _xIntoParent, 'xInsertElement': _oWindow});
	}
}
classPG_Window.prototype = new classPG_ClassBasics();
var oPGWindow = new classPG_Window();