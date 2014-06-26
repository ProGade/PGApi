/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 21 2012
*/
var PG_COLORPICKER_TYPE_SIMPLE = 'SimpleColorBars';
var PG_COLORPICKER_TYPE_SINGLECOLOR = 'SingleColorRect';
var PG_COLORPICKER_TYPE_MULTICOLOR = 'MultiColorRect';

function classPG_ColorPicker()
{
	// Declarations...
	this.iRed = 0;
	this.iGreen = 0;
	this.iBlue = 0;
	
	// Construct...
	this.setID({'sID': 'PGColorPicker'});
	
	// Methods...
	this.hideRects = function(_sPickerID)
	{
		_sPickerID = this.getRealParameter({'oParameters': _sPickerID, 'sName': 'sPickerID', 'xParameter': _sPickerID});
		
		var _oColorPickerRect = this.oDocument.getElementById(_sPickerID+PG_COLORPICKER_TYPE_SIMPLE);
		if (_oColorPickerRect) {_oColorPickerRect.style.display = 'none';}
		
		var _oColorPickerRect = this.oDocument.getElementById(_sPickerID+PG_COLORPICKER_TYPE_SINGLECOLOR);
		if (_oColorPickerRect) {_oColorPickerRect.style.display = 'none';}
		
		var _oColorPickerRect = this.oDocument.getElementById(_sPickerID+PG_COLORPICKER_TYPE_MULTICOLOR);
		if (_oColorPickerRect) {_oColorPickerRect.style.display = 'none';}
	}
	
	this.show = function(_sPickerID, _sType)
	{
		if (typeof(_sType) == 'undfined') {var _sType = null;}
		
		_sType = this.getRealParameter({'oParameters': _sPickerID, 'sName': 'sType', 'xParameter': _sType});
		_sPickerID = this.getRealParameter({'oParameters': _sPickerID, 'sName': 'sPickerID', 'xParameter': _sPickerID});

		if (_sType == null) {_sType = PG_COLORPICKER_TYPE_SIMPLE;}
		
		var _oColorPicker = this.oDocument.getElementById(_sPickerID);
		if (_oColorPicker)
		{
			_oColorPicker.style.display = 'inline-block';
			
			this.hideRects({'sPickerID': _sPickerID});
			var _oColorPickerRect = this.oDocument.getElementById(_sPickerID+_sType);
			if (_oColorPickerRect) {_oColorPickerRect.style.display = 'inline-block';}
		}
	}
	
	this.hide = function(_sPickerID)
	{
		_sPickerID = this.getRealParameter({'oParameters': _sPickerID, 'sName': 'sPickerID', 'xParameter': _sPickerID});
		var _oColorPicker = this.oDocument.getElementById(_sPickerID);
		if (_oColorPicker) {_oColorPicker.style.display = 'none';}
	}
	
	this.onColorRelease = function(_sPickerID, _iRed, _iGreen, _iBlue)
	{
		if (typeof(_iRed) == 'undefined') {var _iRed = null;}
		if (typeof(_iGreen) == 'undefined') {var _iGreen = null;}
		if (typeof(_iBlue) == 'undefined') {var _iBlue = null;}

		_iGreen = this.getRealParameter({'oParameters': _sPickerID, 'sName': 'iGreen', 'xParameter': _iGreen});
		_iBlue = this.getRealParameter({'oParameters': _sPickerID, 'sName': 'iBlue', 'xParameter': _iBlue});
		_iRed = this.getRealParameter({'oParameters': _sPickerID, 'sName': 'iRed', 'xParameter': _iRed});
		_sPickerID = this.getRealParameter({'oParameters': _sPickerID, 'sName': 'sPickerID', 'xParameter': _sPickerID});

		this.iRed = _iRed;
		this.iGreen = _iGreen;
		this.iBlue = _iBlue;
		
		var _oCurrentColor = this.oDocument.getElementById(_sPickerID+'CurrentColor');
		if (_oCurrentColor)
		{
			_oCurrentColor.style.backgroundColor = oPGGfx.rgbToHex({'iRed': _iRed, 'iGreen': _iGreen, 'iBlue': _iBlue});
		}
	}
	
	this.getCurrentColorHex = function(_sPickerID)
	{
		_sPickerID = this.getRealParameter({'oParameters': _sPickerID, 'sName': 'sPickerID', 'xParameter': _sPickerID});
		return oPGGfx.rgbToHex({'iRed': this.iRed, 'iGreen': this.iGreen, 'iBlue': this.iBlue});
	}
	
	this.buildSingleColorRect = function() {}
	this.buildMulticolorCircle = function() {}
	this.buildMulticolorRect = function() {}
	this.buildSimple = function() {}
	
	this.build = function()
	{
		return this.buildSimple();
	}
}
classPG_ColorPicker.prototype = new classPG_ClassBasics();
var oPGColorPicker = new classPG_ColorPicker();