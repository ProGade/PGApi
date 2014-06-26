/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 23 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_Canvas()
{
	// Declarations...
	this.oCanvas = null;
	this.oCanvas2D = null;
	
	this.bFilled = null;
	this.bStroked = null;
	
	this.bCanvas2D = true;
	
	// Construct...
	this.setID('PGCanvas');

	// Methods...
	this.test = function()
	{
		this.init({'sCanvasID': 'PGCanvasZoom'});
		this.oCanvas2D.scale(0.3,0.3);
		this.drawTest();
		this.oCanvas2D.scale(1.7,1.7);
		
		this.init({'sCanvasID': 'PGCanvas'});
		this.drawTest();
		
		var _sBarID = 'PGTestBar';
		var _iType = 0;
		var _sWidth = 100;
		var _sHeight = 100;
		var _sBackgroundStrokeStyle = '#cccccc';
		var _sBackgroundFillStyle = '#000000';
		var _sBarStrokeStyle = '#bb0000';
		var _sBarFillStyle = '#cc0000';
		oPGProgressBar.draw(_sBarID, 
							_iType, 
							_sWidth, 
							_sHeight, 
							_sBackgroundStrokeStyle,
							_sBackgroundFillStyle, 
							_sBarStrokeStyle,
							_sBarFillStyle);
		
		var _oCanvasZoom = this.oDocument.getElementById('PGCanvasZoom');
		this.drawImage({'xImage':_oCanvasZoom, 'iPosX':300, 'iPosY':300});
	}
	
	/*
	@start method
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	this.useFilled = function(_bUse)
	{
		_bUse = this.getRealParameter({'oParameters': _bUse, 'sName': 'bUse', 'xParameter': _bUse});
		this.bFilled = _bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	this.useStroked = function(_bUse)
	{
		_bUse = this.getRealParameter({'oParameters': _bUse, 'sName': 'bUse', 'xParameter': _bUse});
		this.bStroked = _bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	this.useCanvas2D = function(_bUse)
	{
		_bUse = this.getRealParameter({'oParameters': _bUse, 'sName': 'bUse', 'xParameter': _bUse});
		this.bCanvas2D = _bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bIsCanvas2D [type]bool[/type]
	[en]...[/en]
	*/
	this.isCanvas2D = function() {return this.bCanvas2D;}
	/* @end method */
	
	/* @start method */
	this.saveState = function()
	{
		this.bCanvas2D.save();
	}
	/* @end method */
	
	/* @start method */
	this.restoreState = function()
	{
		this.bCanvas2D.restore();
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sCanvasID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.init = function(_sCanvasID)
	{
		if (typeof(_sCanvasID) == 'undefined') {var _sCanvasID = null;}
		_sCanvasID = this.getRealParameter({'oParameters': _sCanvasID, 'sName': 'sCanvasID', 'xParameter': _sCanvasID});

		if (_sCanvasID == null) {_sCanvasID = this.getNextID();}
		
		this.oCanvas = this.oDocument.getElementById(_sCanvasID);
		if ((this.oCanvas) && (this.bCanvas2D == true))
		{
			this.oCanvas2D = this.oCanvas.getContext('2d');
			if (this.oCanvas2D) {return true;}
		}
		this.bCanvas2D = false;
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sRGBA [type]string[/type]
	[en]...[/en]
	
	@param iRed [type]int[/type]
	[en]...[/en]
	
	@param iGreen [type]int[/type]
	[en]...[/en]
	
	@param iBlue [type]int[/type]
	[en]...[/en]
	
	@param dAlpha [type]double[/type]
	[en]...[/en]
	*/
	this.getColor = function(_iRed, _iGreen, _iBlue, _dAlpha)
	{
		if (typeof(_iRed) == 'undefined') {var _iRed = null;}
		if (typeof(_iGreen) == 'undefined') {var _iGreen = null;}
		if (typeof(_iBlue) == 'undefined') {var _iBlue = null;}
		if (typeof(_dAlpha) == 'undefined') {var _dAlpha = null;}

		_iGreen = this.getRealParameter({'oParameters': _iRed, 'sName': 'iGreen', 'xParameter': _iGreen});
		_iBlue = this.getRealParameter({'oParameters': _iRed, 'sName': 'iBlue', 'xParameter': _iBlue});
		_dAlpha = this.getRealParameter({'oParameters': _iRed, 'sName': 'dAlpha', 'xParameter': _dAlpha});
		_iRed = this.getRealParameter({'oParameters': _iRed, 'sName': 'iRed', 'xParameter': _iRed});
		
		if (_iRed == null) {_iRed = 0;}
		if (_iGreen == null) {_iGreen = 0;}
		if (_iBlue == null) {_iBlue = 0;}
		if (_dAlpha == null) {_dAlpha = 1;}
		
		return 'rgba('+_iRed+','+_iGreen+','+_iBlue+','+_dAlpha+')';
	}
	/* @end method */
	
	// _axColorStops = new Array({'percent': '30', 'style': '#fff'}, {'percent': '80', 'style': '#000'});
	/*
	@start method
	
	@return oLinearGradient [type]object[/type]
	[en]...[/en]
	
	@param iFromPosX [needed][type]int[/type]
	[en]...[/en]
	
	@param iFromPosY [needed][type]int[/type]
	[en]...[/en]
	
	@param iToPosX [needed][type]int[/type]
	[en]...[/en]
	
	@param iToPosY [needed][type]int[/type]
	[en]...[/en]
	
	@param axColorStops [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	this.getLinearGradient = function(_iFromPosX, _iFromPosY, _iToPosX, _iToPosY, _axColorStops)
	{
		if (typeof(_iFromPosY) == 'undefined') {var _iFromPosY = null;}
		if (typeof(_iToPosX) == 'undefined') {var _iToPosX = null;}
		if (typeof(_iToPosY) == 'undefined') {var _iToPosY = null;}
		if (typeof(_axColorStops) == 'undefined') {var _axColorStops = null;}

		_iFromPosY = this.getRealParameter({'oParameters': _iFromPosX, 'sName': 'iFromPosY', 'xParameter': _iFromPosY});
		_iToPosX = this.getRealParameter({'oParameters': _iFromPosX, 'sName': 'iToPosX', 'xParameter': _iToPosX});
		_iToPosY = this.getRealParameter({'oParameters': _iFromPosX, 'sName': 'iToPosY', 'xParameter': _iToPosY});
		_axColorStops = this.getRealParameter({'oParameters': _iFromPosX, 'sName': 'axColorStops', 'xParameter': _axColorStops});
		_iFromPosX = this.getRealParameter({'oParameters': _iFromPosX, 'sName': 'iFromPosX', 'xParameter': _iFromPosX});
			
		var _dPercent = 0.0;
		var _oLinearGradient = this.oCanvas2D.createLinearGradient(_iFromPosX, _iFromPosY, _iToPosX, _iToPosY);
		if (_oLinearGradient)
		{
			for (var i=0; i<_axColorStops.length; i++)
			{
				_dPercent = (_axColorStops[i].percent/100);
				_oLinearGradient.addColorStop(_dPercent, _axColorStops[i].style);
			}
		}
		return _oLinearGradient;
	}
	/* @end method */
	
	/*
	@start method
	
	@return oLinearGradient [type]object[/type]
	[en]...[/en]
	
	@param iCenterPosX [needed][type]int[/type]
	[en]...[/en]
	
	@param iCenterPosY [needed][type]int[/type]
	[en]...[/en]
	
	@param dRadius [needed][type]double[/type]
	[en]...[/en]
	
	@param axColorStops [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	this.getRadialGradient = function(_iCenterPosX, _iCenterPosY, _dRadius, _axColorStops)
	{
		if (typeof(_iCenterPosY) == 'undefined') {var _iCenterPosY = null;}
		if (typeof(_dRadius) == 'undefined') {var _dRadius = null;}
		if (typeof(_axColorStops) == 'undefined') {var _axColorStops = null;}
		
		_iCenterPosY = this.getRealParameter({'oParameters': _iCenterPosX, 'sName': 'iCenterPosY', 'xParameter': _iCenterPosY});
		_dRadius = this.getRealParameter({'oParameters': _iCenterPosX, 'sName': 'dRadius', 'xParameter': _dRadius});
		_axColorStops = this.getRealParameter({'oParameters': _iCenterPosX, 'sName': 'axColorStops', 'xParameter': _axColorStops});
		_iCenterPosX = this.getRealParameter({'oParameters': _iCenterPosX, 'sName': 'iCenterPosX', 'xParameter': _iCenterPosX});
			
		var _dPercent = 0.0;
		var _oLinearGradient = this.oCanvas2D.createRadialGradient(_iCenterPosX, _iCenterPosY, 0, _iCenterPosX, _iCenterPosY, _dRadius);
		if (_oLinearGradient)
		{
			for (var i=0; i<_axColorStops.length; i++)
			{
				_dPercent = (_axColorStops[i].percent/100);
				_oLinearGradient.addColorStop(_dPercent, _axColorStops[i].style);
			}
		}
		return _oLinearGradient;
	}
	/* @end method */
	
	/*
	@start method
	
	@param dAlpha [type]double[/type]
	[en]...[/en]
	
	@param sCompositeOperation [type]string[/type]
	[en]...[/en]
	*/
	this.setup = function(_dAlpha, _sCompositeOperation)
	{
		if (typeof(_dAlpha) == 'undefined') {var _dAlpha = null;}
		if (typeof(_sCompositeOperation) == 'undefined') {var _sCompositeOperation = null;}

		_sCompositeOperation = this.getRealParameter({'oParameters': _dAlpha, 'sName': 'sCompositeOperation', 'xParameter': _sCompositeOperation});
		_dAlpha = this.getRealParameter({'oParameters': _dAlpha, 'sName': 'dAlpha', 'xParameter': _dAlpha});
		
		if (_dAlpha != null) {this.oCanvas2D.globalAlpha = _dAlpha;}
		if (_sCompositeOperation != null) {this.oCanvas2D.globalCompositeOperation = _sCompositeOperation;} // (default source-over)
	}
	/* @end method */
	
	/*
	@start method
	
	@param sStrokeStyle [type]string[/type]
	[en]...[/en]
	
	@param dStrokeWidth [type]double[/type]
	[en]...[/en]
	
	@param sStrokeCap [type]string[/type]
	[en]...[/en]
	
	@param sStrokeJoin [type]string[/type]
	[en]...[/en]
	*/
	this.setupLine = function(_sStrokeStyle, _dStrokeWidth, _sStrokeCap, _sStrokeJoin)
	{
		if (typeof(_sStrokeStyle) == 'undefined') {var _sStrokeStyle = null;}
		if (typeof(_dStrokeWidth) == 'undefined') {var _dStrokeWidth = null;}
		if (typeof(_sStrokeCap) == 'undefined') {var _sStrokeCap = null;}
		if (typeof(_sStrokeJoin) == 'undefined') {var _sStrokeJoin = null;}

		_dStrokeWidth = this.getRealParameter({'oParameters': _sStrokeStyle, 'sName': 'dStrokeWidth', 'xParameter': _dStrokeWidth});
		_sStrokeCap = this.getRealParameter({'oParameters': _sStrokeStyle, 'sName': 'sStrokeCap', 'xParameter': _sStrokeCap});
		_sStrokeJoin = this.getRealParameter({'oParameters': _sStrokeStyle, 'sName': 'sStrokeJoin', 'xParameter': _sStrokeJoin});
		_sStrokeStyle = this.getRealParameter({'oParameters': _sStrokeStyle, 'sName': 'sStrokeStyle', 'xParameter': _sStrokeStyle});

		if (_dStrokeWidth != null) {this.oCanvas2D.lineWidth = _dStrokeWidth;}
		if (_sStrokeStyle != null) {this.oCanvas2D.strokeStyle = _sStrokeStyle;}
		// if (_iStrokeMiterLimit != null) {this.oCanvas2D.miterLimit = _iStrokeMiterLimit;}	// (default 10)
		if (_sStrokeCap != null) {this.oCanvas2D.lineCap = _sStrokeCap;}		// "butt", "round", "square" (default "butt")
		if (_sStrokeJoin != null) {this.oCanvas2D.lineJoin = _sStrokeJoin;}		// "round", "bevel", "miter" (default "miter")
	}
	/* @end method */
	
	/*
	@start method
	
	@param xFillStyle [type]mixed[/type]
	[en]...[/en]
	*/
	this.setupSurface = function(_xFillStyle)
	{
		if (typeof(_xFillStyle) == 'undefined') {var _xFillStyle = null;}
		_xFillStyle = this.getRealParameter({'oParameters': _xFillStyle, 'sName': 'xFillStyle', 'xParameter': _xFillStyle, 'bNotNull': true});
		if (_xFillStyle != null) {this.oCanvas2D.fillStyle = _xFillStyle;}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sFontSize [type]string[/type]
	[en]...[/en]
	
	@param sFontFamily [type]string[/type]
	[en]...[/en]
	
	@param sTextBaseline [type]string[/type]
	[en]...[/en]
	
	@param sTextAlign [type]string[/type]
	[en]...[/en]
	*/
	this.setupText = function(_sFontSize, _sFontFamily, _sTextBaseline, _sTextAlign)
	{
		if (typeof(_sFontFamily) == 'undefined') {var _sFontFamily = null;}
		if (typeof(_sBaseline) == 'undefined') {var _sBaseline = null;}
		if (typeof(_sAlign) == 'undefined') {var _sAlign = null;}

		_sFontFamily = this.getRealParameter({'oParameters': _sFontSize, 'sName': 'sFontFamily', 'xParameter': _sFontFamily});
		_sTextBaseline = this.getRealParameter({'oParameters': _sFontSize, 'sName': 'sTextBaseline', 'xParameter': _sTextBaseline});
		_sTextAlign = this.getRealParameter({'oParameters': _sFontSize, 'sName': 'sTextAlign', 'xParameter': _sTextAlign});
		_sFontSize = this.getRealParameter({'oParameters': _sFontSize, 'sName': 'sFontSize', 'xParameter': _sFontSize});
		
		if ((_sFontSize != null) && (_sFontFamily != null)) {this.oCanvas2D.font = _sFontSize+' '+_sFontFamily;}
		if (_sTextBaseline != null) {this.oCanvas2D.textBaseline = _sTextBaseline;}
		if (_sTextAlign != null) {this.oCanvas2D.textAlign = _sTextAlign;}
	}
	/* @end method */
	
	/*
	@start method
	
	@param dShadowOffsetX [type]double[/type]
	[en]...[/en]
	
	@param dShadowOffsetY [type]double[/type]
	[en]...[/en]
	
	@param dShadowBlur [type]double[/type]
	[en]...[/en]
	
	@param sShadowColor [type]string[/type]
	[en]...[/en]
	*/
	this.setupShadow = function(_dShadowOffsetX, _dShadowOffsetY, _dShadowBlur, _sShadowColor)
	{
		if (typeof(_dShadowOffsetX) == 'undefined') {var _dShadowOffsetX = null;}
		if (typeof(_dShadowOffsetY) == 'undefined') {var _dShadowOffsetY = null;}
		if (typeof(_dShadowBlur) == 'undefined') {var _dShadowBlur = null;}
		if (typeof(_sShadowColor) == 'undefined') {var _sShadowColor = null;}

		_dShadowOffsetY = this.getRealParameter({'oParameters': _dShadowOffsetX, 'sName': 'dShadowOffsetY', 'xParameter': _dShadowOffsetY});
		_dShadowBlur = this.getRealParameter({'oParameters': _dShadowOffsetX, 'sName': 'dShadowBlur', 'xParameter': _dShadowBlur});
		_sShadowColor = this.getRealParameter({'oParameters': _dShadowOffsetX, 'sName': 'sShadowColor', 'xParameter': _sShadowColor});
		_dShadowOffsetX = this.getRealParameter({'oParameters': _dShadowOffsetX, 'sName': 'dShadowOffsetX', 'xParameter': _dShadowOffsetX});
		
		if (_dShadowOffsetX == null) {_dShadowOffsetX = 0;}
		if (_dShadowOffsetY == null) {_dShadowOffsetY = 0;}
		if (_dShadowBlur == null) {_dShadowBlur = 0;}
		if (_sShadowColor == null) {_sShadowColor = 'rgba(0,0,0,0.5)';}
		
		this.oCanvas2D.shadowOffsetX = _dShadowOffsetX;
		this.oCanvas2D.shadowOffsetY = _dShadowOffsetY;
		this.oCanvas2D.shadowBlur = _dShadowBlur;
		this.oCanvas2D.shadowColor = _sShadowColor;
	}
	/* @end method */
	
	/* @start method */
	this.openPath = function()
	{
		this.oCanvas2D.beginPath();
	}
	/* @end method */
	
	/* @start method */
	this.closePath = function()
	{
		this.oCanvas2D.closePath();
	}
	/* @end method */
	
	/*
	@start method
	
	@param bFilled [type]bool[/type]
	[en]...[/en]
	
	@param bStroked [type]bool[/type]
	[en]...[/en]
	*/
	this.drawPath = function(_bFilled, _bStroked)
	{
		if (typeof(_bFilled) == 'undefined') {var _bFilled = null;}
		if (typeof(_bStroked) == 'undefined') {var _bStroked = null;}

		_bStroked = this.getRealParameter({'oParameters': _bFilled, 'sName': 'bStroked', 'xParameter': _bStroked});
		_bFilled = this.getRealParameter({'oParameters': _bFilled, 'sName': 'bFilled', 'xParameter': _bFilled});
		
		if (_bFilled == null) {_bFilled = this.bFilled;}
		if (_bStroked == null) {_bStroked = this.bStroked;}
		
		if (_bStroked == null) {if (_bFilled == null) {_bStroked = true;} else {_bStroked = false;}}
		if (_bFilled == null) {if (_bStroked == false) {_bFilled = true;} else {_bFilled = false;}}
		
		if (_bStroked == true) {this.oCanvas2D.stroke();}
		if (_bFilled == true) {this.oCanvas2D.fill();}
	}
	/* @end method */
	
	/*
	@start method
	
	@param iPosToX [needed][type]int[/type]
	[en]...[/en]
	
	@param iPosToY [needed][type]int[/type]
	[en]...[/en]
	
	@param iPosFromX [type]int[/type]
	[en]...[/en]
	
	@param iPosFromY [type]int[/type]
	[en]...[/en]
	*/
	this.addLine = function(_iPosToX, _iPosToY, _iPosFromX, _iPosFromY)
	{
		if (typeof(_iPosToY) == 'undefined') {var _iPosToY = null;}
		if (typeof(_iPosFromX) == 'undefined') {var _iPosFromX = null;}
		if (typeof(_iPosFromY) == 'undefined') {var _iPosFromY = null;}

		_iPosToY = this.getRealParameter({'oParameters': _iPosToX, 'sName': 'iPosToY', 'xParameter': _iPosToY});
		_iPosFromX = this.getRealParameter({'oParameters': _iPosToX, 'sName': 'iPosFromX', 'xParameter': _iPosFromX});
		_iPosFromY = this.getRealParameter({'oParameters': _iPosToX, 'sName': 'iPosFromY', 'xParameter': _iPosFromY});
		_iPosToX = this.getRealParameter({'oParameters': _iPosToX, 'sName': 'iPosToX', 'xParameter': _iPosToX});
		
		if ((_iPosFromX != null) && (_iPosFromY != null)) {this.oCanvas2D.moveTo(_iPosFromX, _iPosFromY);}
		this.oCanvas2D.lineTo(_iPosToX, _iPosToY);
	}
	/* @end method */
	
	/*
	@start method
	
	@param iPosToX [needed][type]int[/type]
	[en]...[/en]
	
	@param iPosToY [needed][type]int[/type]
	[en]...[/en]
	
	@param iPosFromX [type]int[/type]
	[en]...[/en]
	
	@param iPosFromY [type]int[/type]
	[en]...[/en]
	
	@param sStrokeStyle [type]string[/type]
	[en]...[/en]
	
	@param dStrokeWidth [type]double[/type]
	[en]...[/en]
	
	@param dAlpha [type]double[/type]
	[en]...[/en]
	*/
	this.drawLine = function(_iPosToX, _iPosToY, _iPosFromX, _iPosFromY, _sStrokeStyle, _dStrokeWidth, _dAlpha)
	{
		if (typeof(_iPosToY) == 'undefined') {var _iPosToY = null;}
		if (typeof(_iPosFromX) == 'undefined') {var _iPosFromX = null;}
		if (typeof(_iPosFromY) == 'undefined') {var _iPosFromY = null;}
		if (typeof(_dStrokeWidth) == 'undefined') {var _dStrokeWidth = null;}
		if (typeof(_sStrokeStyle) == 'undefined') {var _sStrokeStyle = null;}
		if (typeof(_dAlpha) == 'undefined') {var _dAlpha = null;}

		_iPosToY = this.getRealParameter({'oParameters': _iPosToX, 'sName': 'iPosToY', 'xParameter': _iPosToY});
		_iPosFromX = this.getRealParameter({'oParameters': _iPosToX, 'sName': 'iPosFromX', 'xParameter': _iPosFromX});
		_iPosFromY = this.getRealParameter({'oParameters': _iPosToX, 'sName': 'iPosFromY', 'xParameter': _iPosFromY});
		_sStrokeStyle = this.getRealParameter({'oParameters': _iPosToX, 'sName': 'sStrokeStyle', 'xParameter': _sStrokeStyle});
		_dStrokeWidth = this.getRealParameter({'oParameters': _iPosToX, 'sName': 'dStrokeWidth', 'xParameter': _dStrokeWidth});
		_dAlpha = this.getRealParameter({'oParameters': _iPosToX, 'sName': 'dAlpha', 'xParameter': _dAlpha});
		_iPosToX = this.getRealParameter({'oParameters': _iPosToX, 'sName': 'iPosToX', 'xParameter': _iPosToX});
		
		if (_dStrokeWidth == null) {_dStrokeWidth = 1;}
		if (_sStrokeStyle == null) {_sStrokeStyle = '#000000';}
		if (_dAlpha == null) {_dAlpha = 1.0;}
		
		this.openPath();
		this.setup({'dAlpha': _dAlpha});
		this.setupLine({'sStrokeStyle': _sStrokeStyle, 'dStrokeWidth': _dStrokeWidth});		
		this.addLine({'iPosToX': _iPosToX, 'iPosToY': _iPosToY, 'iPosFromX': _iPosFromX, 'iPosFromY': _iPosFromY});
		this.drawPath({'bFilled':false, 'bStroked':true});
		this.closePath();
	}
	/* @end method */
	
	/*
	@start method
	
	@param iPosX [needed][type]int[/type]
	[en]...[/en]
	
	@param iPosY [needed][type]int[/type]
	[en]...[/en]
	
	@param iSizeX [needed][type]int[/type]
	[en]...[/en]
	
	@param iSizeY [needed][type]int[/type]
	[en]...[/en]
	*/
	this.addTriangle = function(_iPosX, _iPosY, _iSizeX, _iSizeY)
	{
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = null;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}

		_iPosY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosY', 'xParameter': _iPosY});
		_iSizeX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		_iSizeY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_iPosX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosX', 'xParameter': _iPosX});
		
		this.addLine({'iPosToX': _iPosX+_iSizeX, 'iPosToY': _iPosY+_iSizeY, 'iPosFromX': _iPosX+Math.floor(_iSizeX/2), 'iPosFromY': _iPosY});
		this.addLine({'iPosToX': _iPosX, 'iPosToY': _iPosY+_iSizeY});
		this.addLine({'iPosToX': _iPosX+Math.floor(_iSizeX/2), 'iPosToY': _iPosY});
	}
	/* @end method */
	
	/*
	@start method
	
	@param iPosX [needed][type]int[/type]
	[en]...[/en]
	
	@param iPosY [needed][type]int[/type]
	[en]...[/en]
	
	@param iSizeX [needed][type]int[/type]
	[en]...[/en]
	
	@param iSizeY [needed][type]int[/type]
	[en]...[/en]
	
	@param bFilled [type]bool[/type]
	[en]...[/en]
	
	@param bStroked [type]bool[/type]
	[en]...[/en]
	
	@param xFillStyle [type]mixed[/type]
	[en]...[/en]
	
	@param sStrokeStyle [type]string[/type]
	[en]...[/en]
	
	@param dStrokeWidth [type]double[/type]
	[en]...[/en]
	
	@param dAlpha [type]double[/type]
	[en]...[/en]
	*/
	this.drawTriangle = function(_iPosX, _iPosY, _iSizeX, _iSizeY, _bFilled, _bStroked, _xFillStyle, _sStrokeStyle, _dStrokeWidth, _dAlpha)
	{
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = null;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}
		if (typeof(_bFilled) == 'undefined') {var _bFilled = null;}
		if (typeof(_bStroked) == 'undefined') {var _bStroked = null;}
		if (typeof(_xFillStyle) == 'undefined') {var _xFillStyle = null;}
		if (typeof(_sStrokeStyle) == 'undefined') {var _sStrokeStyle = null;}
		if (typeof(_dStrokeWidth) == 'undefined') {var _dStrokeWidth = null;}
		if (typeof(_dAlpha) == 'undefined') {var _dAlpha = null;}

		_iPosY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosY', 'xParameter': _iPosY});
		_iSizeX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		_iSizeY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_bFilled = this.getRealParameter({'oParameters': _iPosX, 'sName': 'bFilled', 'xParameter': _bFilled});
		_bStroked = this.getRealParameter({'oParameters': _iPosX, 'sName': 'bStroked', 'xParameter': _bStroked});
		_xFillStyle = this.getRealParameter({'oParameters': _iPosX, 'sName': 'xFillStyle', 'xParameter': _xFillStyle});
		_sStrokeStyle = this.getRealParameter({'oParameters': _iPosX, 'sName': 'sStrokeStyle', 'xParameter': _sStrokeStyle});
		_dStrokeWidth = this.getRealParameter({'oParameters': _iPosX, 'sName': 'dStrokeWidth', 'xParameter': _dStrokeWidth});
		_dAlpha = this.getRealParameter({'oParameters': _iPosX, 'sName': 'dAlpha', 'xParameter': _dAlpha});
		_iPosX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosX', 'xParameter': _iPosX});
		
		if (_bFilled == null) {_bFilled = false;}
		if (_bStroked == null) {_bStroked = false;}
		if (_dStrokeWidth == null) {_dStrokeWidth = 1.0;}
		if (_xFillStyle == null) {_xFillStyle = '#ffffff';}
		if (_sStrokeStyle == null) {_sStrokeStyle = '#000000';}
		if (_dAlpha == null) {_dAlpha = 1.0;}
		
		this.openPath();
		this.setup({'dAlpha': _dAlpha});
		this.setupSurface({'xFillStyle': _xFillStyle});
		this.setupLine({'sStrokeStyle': _sStrokeStyle, 'dStrokeWidth': _dStrokeWidth});
		this.addTriangle({'iPosX': _iPosX, 'iPosY': _iPosY, 'iSizeX': _iSizeX, 'iSizeY': _iSizeY});
		this.drawPath({'bFilled': _bFilled, 'bStroked': _bStroked});
		this.closePath();
	}
	/* @end method */
	
	/*
	@start method
	
	@param iPosX [needed][type]int[/type]
	[en]...[/en]
	
	@param iPosY [needed][type]int[/type]
	[en]...[/en]
	
	@param iSizeX [needed][type]int[/type]
	[en]...[/en]
	
	@param iSizeY [needed][type]int[/type]
	[en]...[/en]
	
	@param iCornerCount [needed][type]int[/type]
	[en]...[/en]
	*/
	this.addRegularPolygone = function(_iPosX, _iPosY, _iSizeX, _iSizeY, _iCornerCount)
	{
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = null;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}
		if (typeof(_iCornerCount) == 'undefined') {var _iCornerCount = null;}

		_iPosY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosY', 'xParameter': _iPosY});
		_iSizeX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		_iSizeY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_iCornerCount = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iCornerCount', 'xParameter': _iCornerCount});
		_iPosX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosX', 'xParameter': _iPosX});
		
		var _iNextPosX = 0;
		var _iNextPosY = 0;
		
		var _dRadius = _iSizeX/2;
		var _dScaleY = 100*_iSizeY/_iSizeX;
		_dScaleY = _dScaleY/100;
		
		var _iScaledPosY = Math.round(_iPosY/_dScaleY);
		
		this.oCanvas2D.scale(1, _dScaleY);
		for (var i=1; i<=_iCornerCount; i++)
		{
			_iNextPosX = Math.round(_iPosX + _dRadius * Math.sin(i*(360/_iCornerCount) * Math.PI / 180));
			_iNextPosY = Math.round(_iScaledPosY + _dRadius * Math.cos(i*(360/_iCornerCount) * Math.PI / 180));
			this.addLine({'iPosToX': _iNextPosX, 'iPosToY': _iNextPosY});
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param iPosX [needed][type]int[/type]
	[en]...[/en]
	
	@param iPosY [needed][type]int[/type]
	[en]...[/en]
	
	@param iSizeX [needed][type]int[/type]
	[en]...[/en]
	
	@param iSizeY [needed][type]int[/type]
	[en]...[/en]
	
	@param iPeakCount [needed][type]int[/type]
	[en]...[/en]
	
	@param iPeakSize [needed][type]int[/type]
	[en]...[/en]
	*/
	this.addStar = function(_iPosX, _iPosY, _iSizeX, _iSizeY, _iPeakCount, _iPeakSize)
	{
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = null;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}
		if (typeof(_iPeakCount) == 'undefined') {var _iPeakCount = null;}
		if (typeof(_iPeakSize) == 'undefined') {var _iPeakSize = null;}

		_iPosY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosY', 'xParameter': _iPosY});
		_iSizeX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		_iSizeY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_iPeakCount = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPeakCount', 'xParameter': _iPeakCount});
		_iPeakSize = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPeakSize', 'xParameter': _iPeakSize});
		_iPosX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosX', 'xParameter': _iPosX});
		
		if (_iPeakSize > Math.floor(_iSizeX/2)) {_iPeakSize = Math.floor(_iSizeX/2);}

		var _iNextPosX = 0;
		var _iNextPosY = 0;
		
		var _dRadius = _iSizeX/2;
		var _dRadiusPeak = _dRadius;
		var _dRadiusInner = _dRadius-_iPeakSize;
		var _dScaleY = 100*_iSizeY/_iSizeX;
		_dScaleY = _dScaleY/100;
		
		var _iScaledPosY = Math.round(_iPosY/_dScaleY);
		var _bIsPeak = false;
		_iPeakCount *= 2;
		
		this.oCanvas2D.scale(1, _dScaleY);
		for (var i=1; i<=_iPeakCount; i++)
		{
			if (_bIsPeak == true) {_dRadius = _dRadiusInner; _bIsPeak = false;} else {_dRadius = _dRadiusPeak; _bIsPeak = true;}
			_iNextPosX = Math.round(_iPosX + _dRadius * Math.sin(i*(360/_iPeakCount) * Math.PI / 180));
			_iNextPosY = Math.round(_iScaledPosY + _dRadius * Math.cos(i*(360/_iPeakCount) * Math.PI / 180));
			this.addLine({'iPosToX': _iNextPosX, 'iPosToY': _iNextPosY});
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param iPosX [needed][type]int[/type]
	[en]...[/en]
	
	@param iPosY [needed][type]int[/type]
	[en]...[/en]
	
	@param iSizeX [needed][type]int[/type]
	[en]...[/en]
	
	@param iSizeY [needed][type]int[/type]
	[en]...[/en]
	
	@param iToothCount [needed][type]int[/type]
	[en]...[/en]
	
	@param iToothSize [needed][type]int[/type]
	[en]...[/en]
	*/
	this.addGear = function(_iPosX, _iPosY, _iSizeX, _iSizeY, _iToothCount, _iToothSize)
	{
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = null;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}
		if (typeof(_iToothCount) == 'undefined') {var _iToothCount = null;}
		if (typeof(_iToothSize) == 'undefined') {var _iToothSize = null;}

		_iPosY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosY', 'xParameter': _iPosY});
		_iSizeX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		_iSizeY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_iToothCount = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iToothCount', 'xParameter': _iToothCount});
		_iToothSize = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iToothSize', 'xParameter': _iToothSize});
		_iPosX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosX', 'xParameter': _iPosX});
		
		if (_iToothSize > Math.floor(_iSizeX/2)) {_iToothSize = Math.floor(_iSizeX/2);}

		var _iNextPosX = new Array();
		var _iNextPosY = new Array();
		var _iLastPosX = 0;
		var _iLastPosY = 0;
		
		var _dRadius = _iSizeX/2;
		var _dRadiusTooth = _dRadius;
		var _dRadiusInner = _dRadius-_iToothSize;
		var _dScaleY = 100*_iSizeY/_iSizeX;
		_dScaleY = _dScaleY/100;
		
		var _bVerticalLine = false;
		var _iScaledPosY = Math.round(_iPosY/_dScaleY);
		var _iToothCornerCount = 0;
		_iToothCount *= 4;
		
		var _iRoundHelper = 0;
		var _dLastAngle = 0.0;
		var _dNextAngle = 0.0;
		
		this.oCanvas2D.scale(1, _dScaleY);
		for (var i=1; i<=_iToothCount; i++)
		{
			if (_iToothCornerCount == 4) {_iToothCornerCount = 0; _dRadius = _dRadiusTooth;}
			else if (_iToothCornerCount == 2) {_dRadius = _dRadiusInner;}
			
			if (_iToothCornerCount == 0) {_iRoundHelper = i-0.25;}
			if (_iToothCornerCount == 1) {_iRoundHelper = i;}
			if (_iToothCornerCount == 2) {_iRoundHelper = i-0.5;}
			if (_iToothCornerCount == 3) {_iRoundHelper = i+0.25;}
			
			// _dAngle = Math.atan2(_iNextPosX-_iLastPosX, _iNextPosY-_iLastPosY)*180/Math.PI;
			// _dNextAngle = Math.atan2(_iPosX-_iNextPosX, _iPosY-_iNextPosY)/(Math.PI)+(Math.PI*2);
			 
			_iNextPosX = Math.round(_iPosX + _dRadius * Math.sin(_iRoundHelper*(360/_iToothCount) * Math.PI / 180));
			_iNextPosY = Math.round(_iScaledPosY + _dRadius * Math.cos(_iRoundHelper*(360/_iToothCount) * Math.PI / 180));
			// if (_iToothCornerCount == 3) {this.oCanvas2D.quadraticCurveTo(_iLastPosX, _iLastPosY, _iNextPosX, _iNextPosY);}
			// if (_iToothCornerCount == 3) {this.oCanvas2D.arcTo(_iPosX, _iPosY, _iNextPosX, _iNextPosY, _dRadius);}
			// if (_iToothCornerCount == 3) {this.oCanvas2D.bezierCurveTo(_iNextPosX, _iNextPosY, _iLastPosX, _iLastPosY, _iNextPosX, _iNextPosY);}
			
			// if (_iToothCornerCount == 3) {this.oCanvas2D.arc(_iPosX, _iPosY, _dRadius, _dLastAngle, _dNextAngle, true);}
			// else {this.addLine({'iPosToX':_iNextPosX, 'iPosToY':_iNextPosY});}
			this.addLine({'iPosToX': _iNextPosX, 'iPosToY': _iNextPosY});
			
			// this.drawText({'iPosX':_iNextPosX, 'iPosY':_iNextPosY, 'sSize':'11px', 'sText':i+' = '+_dNextAngle});
			// this.drawText({'iPosX':_iNextPosX, 'iPosY':_iNextPosY, 'sSize':'11px', 'sText':(_dNextAngle/360*Math.PI*2)});
			// this.drawText({'iPosX':_iNextPosX, 'iPosY':_iNextPosY, 'sSize':'11px', 'sText':i});
			
			// if (_iToothCornerCount == 0) {this.drawText({'iPosX':_iNextPosX, 'iPosY':_iNextPosY, 'sSize':'11px', 'sText':0});}
			// if (_iToothCornerCount == 1) {this.drawText({'iPosX':_iNextPosX, 'iPosY':_iNextPosY, 'sSize':'11px', 'sText':1});}
			// if (_iToothCornerCount == 2) {this.drawText({'iPosX':_iNextPosX, 'iPosY':_iNextPosY, 'sSize':'11px', 'sText':2});}
			// if (_iToothCornerCount == 3) {this.drawText({'iPosX':_iNextPosX, 'iPosY':_iNextPosY, 'sSize':'11px', 'sText':3});}
			
			_iLastPosX = _iNextPosX;
			_iLastPosY = _iNextPosY;
			_dLastAngle = _dNextAngle;
			_iToothCornerCount++;
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param iPosX [needed][type]int[/type]
	[en]...[/en]
	
	@param iPosY [needed][type]int[/type]
	[en]...[/en]
	
	@param iSizeX [needed][type]int[/type]
	[en]...[/en]
	
	@param iSizeY [needed][type]int[/type]
	[en]...[/en]
	
	@param iCornerCurve [needed][type]int[/type]
	[en]...[/en]
	*/
	this.addRoundedRect = function(_iPosX, _iPosY, _iSizeX, _iSizeY, _iCornerCurve)
	{
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = null;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}
		if (typeof(_iCornerCurve) == 'undefined') {var _iCornerCurve = null;}

		_iPosY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosY', 'xParameter': _iPosY});
		_iSizeX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		_iSizeY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_iCornerCurve = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iCornerCurve', 'xParameter': _iCornerCurve});
		_iPosX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosX', 'xParameter': _iPosX});
		
		if (_iCornerCurve == null) {_iCornerCurve = 5;}
		if (_iCornerCurve > Math.floor(_iSizeX/2)) {_iCornerCurve = Math.floor(_iSizeX/2);}
		if (_iCornerCurve > Math.floor(_iSizeY/2)) {_iCornerCurve = Math.floor(_iSizeY/2);}
		
		this.addLine({'iPosFromX':_iPosX+_iCornerCurve, 'iPosFromY':_iPosY, 'iPosToX':_iPosX+_iSizeX-_iCornerCurve, 'iPosToY':_iPosY});
		this.oCanvas2D.quadraticCurveTo(_iPosX+_iSizeX, _iPosY, _iPosX+_iSizeX, _iPosY+_iCornerCurve);
		
		this.addLine({'iPosToX':_iPosX+_iSizeX, 'iPosToY':_iPosY+_iSizeY-_iCornerCurve});
		this.oCanvas2D.quadraticCurveTo(_iPosX+_iSizeX, _iPosY+_iSizeY, _iPosX+_iSizeX-_iCornerCurve, _iPosY+_iSizeY);
		
		this.addLine({'iPosToX':_iPosX+_iCornerCurve, 'iPosToY':_iPosY+_iSizeY});
		this.oCanvas2D.quadraticCurveTo(_iPosX, _iPosY+_iSizeY, _iPosX, _iPosY+_iSizeY-_iCornerCurve);
		
		this.addLine({'iPosToX':_iPosX, 'iPosToY':_iPosY+_iCornerCurve});
		this.oCanvas2D.quadraticCurveTo(_iPosX, _iPosY, _iPosX+_iCornerCurve, _iPosY);
	}
	/* @end method */
	
	/*
	@start method
	
	@param iPosX [needed][type]int[/type]
	[en]...[/en]
	
	@param iPosY [needed][type]int[/type]
	[en]...[/en]
	
	@param iSizeX [needed][type]int[/type]
	[en]...[/en]
	
	@param iSizeY [needed][type]int[/type]
	[en]...[/en]
	*/
	this.addRect = function(_iPosX, _iPosY, _iSizeX, _iSizeY)
	{
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = null;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}

		_iPosY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosY', 'xParameter': _iPosY});
		_iSizeX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		_iSizeY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_iPosX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosX', 'xParameter': _iPosX});
		
		this.oCanvas2D.rect(_iPosX, _iPosY, _iSizeX, _iSizeY);
	}
	/* @end method */
	
	/*
	@start method
	
	@param iPosX [needed][type]int[/type]
	[en]...[/en]
	
	@param iPosY [needed][type]int[/type]
	[en]...[/en]
	
	@param iSizeX [needed][type]int[/type]
	[en]...[/en]
	
	@param iSizeY [needed][type]int[/type]
	[en]...[/en]
	
	@param bFilled [type]bool[/type]
	[en]...[/en]
	
	@param bStroked [type]bool[/type]
	[en]...[/en]
	
	@param xFillStyle [type]mixed[/type]
	[en]...[/en]
	
	@param sStrokeStyle [type]string[/type]
	[en]...[/en]
	
	@param dStrokeWidth [type]double[/type]
	[en]...[/en]
	
	@param dAlpha [type]double[/type]
	[en]...[/en]
	*/
	this.drawRect = function(_iPosX, _iPosY, _iSizeX, _iSizeY, _bFilled, _bStroked, _xFillStyle, _sStrokeStyle, _dStrokeWidth, _dAlpha)
	{
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = null;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}
		if (typeof(_bFilled) == 'undefined') {var _bFilled = null;}
		if (typeof(_bStroked) == 'undefined') {var _bStroked = null;}
		if (typeof(_xFillStyle) == 'undefined') {var _xFillStyle = null;}
		if (typeof(_sStrokeStyle) == 'undefined') {var _sStrokeStyle = null;}
		if (typeof(_dStrokeWidth) == 'undefined') {var _dStrokeWidth = null;}
		if (typeof(_dAlpha) == 'undefined') {var _dAlpha = null;}

		_iPosY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosY', 'xParameter': _iPosY});
		_iSizeX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		_iSizeY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_bFilled = this.getRealParameter({'oParameters': _iPosX, 'sName': 'bFilled', 'xParameter': _bFilled});
		_bStroked = this.getRealParameter({'oParameters': _iPosX, 'sName': 'bStroked', 'xParameter': _bStroked});
		_xFillStyle = this.getRealParameter({'oParameters': _iPosX, 'sName': 'xFillStyle', 'xParameter': _xFillStyle});
		_sStrokeStyle = this.getRealParameter({'oParameters': _iPosX, 'sName': 'sStrokeStyle', 'xParameter': _sStrokeStyle});
		_dStrokeWidth = this.getRealParameter({'oParameters': _iPosX, 'sName': 'dStrokeWidth', 'xParameter': _dStrokeWidth});
		_dAlpha = this.getRealParameter({'oParameters': _iPosX, 'sName': 'dAlpha', 'xParameter': _dAlpha});
		_iPosX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosX', 'xParameter': _iPosX});

		if (_bFilled == null) {_bFilled = false;}
		if (_bStroked == null) {_bStroked = false;}
		if (_dStrokeWidth == null) {_dStrokeWidth = 1.0;}
		if (_xFillStyle == null) {_xFillStyle = '#ffffff';}
		if (_sStrokeStyle == null) {_sStrokeStyle = '#000000';}
		if (_dAlpha == null) {_dAlpha = 1.0;}
		
		this.openPath();
		this.setup({'dAlpha': _dAlpha});
		this.setupSurface({'xFillStyle': _xFillStyle});
		this.setupLine({'sStrokeStyle': _sStrokeStyle, 'dStrokeWidth': _dStrokeWidth});
		this.addRect({'iPosX': _iPosX, 'iPosY': _iPosY, 'iSizeX': _iSizeX, 'iSizeY': _iSizeY});
		this.drawPath({'bFilled': _bFilled, 'bStroked': _bStroked});
		this.closePath();
	}
	/* @end method */
	
	/*
	@start method
	
	@param iPosX [needed][type]int[/type]
	[en]...[/en]
	
	@param iPosY [needed][type]int[/type]
	[en]...[/en]
	
	@param dRadius [needed][type]double[/type]
	[en]...[/en]
	*/
	this.addCircle = function(_iPosX, _iPosY, _dRadius)
	{
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}
		if (typeof(_dRadius) == 'undefined') {var _dRadius = null;}

		_iPosY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosY', 'xParameter': _iPosY});
		_dRadius = this.getRealParameter({'oParameters': _iPosX, 'sName': 'dRadius', 'xParameter': _dRadius});
		_iPosX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosX', 'xParameter': _iPosX});
		
		var _dStartAngle = 0;
		var _dEndAngle = Math.PI*2;
		var _bAntiClockwise = false;
		this.oCanvas2D.arc(_iPosX, _iPosY, _dRadius, _dStartAngle, _dEndAngle, _bAntiClockwise);
	}
	/* @end method */
	
	/*
	@start method
	
	@param iPosX [needed][type]int[/type]
	[en]...[/en]
	
	@param iPosY [needed][type]int[/type]
	[en]...[/en]
	
	@param dRadius [needed][type]double[/type]
	[en]...[/en]
	
	@param bFilled [type]bool[/type]
	[en]...[/en]
	
	@param bStroked [type]bool[/type]
	[en]...[/en]
	
	@param xFillStyle [type]mixed[/type]
	[en]...[/en]
	
	@param sStrokeStyle [type]string[/type]
	[en]...[/en]
	
	@param dStrokeWidth [type]double[/type]
	[en]...[/en]
	
	@param dAlpha [type]double[/type]
	[en]...[/en]
	*/
	this.drawCircle = function(_iPosX, _iPosY, _dRadius, _bFilled, _bStroked, _xFillStyle, _sStrokeStyle, _dStrokeWidth, _dAlpha)
	{
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}
		if (typeof(_dRadius) == 'undefined') {var _dRadius = null;}
		if (typeof(_bFilled) == 'undefined') {var _bFilled = null;}
		if (typeof(_bStroked) == 'undefined') {var _bStroked = null;}
		if (typeof(_xFillStyle) == 'undefined') {var _xFillStyle = null;}
		if (typeof(_sStrokeStyle) == 'undefined') {var _sStrokeStyle = null;}
		if (typeof(_dStrokeWidth) == 'undefined') {var _dStrokeWidth = null;}
		if (typeof(_dAlpha) == 'undefined') {var _dAlpha = null;}

		_iPosY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosY', 'xParameter': _iPosY});
		_dRadius = this.getRealParameter({'oParameters': _iPosX, 'sName': 'dRadius', 'xParameter': _dRadius});
		_bFilled = this.getRealParameter({'oParameters': _iPosX, 'sName': 'bFilled', 'xParameter': _bFilled});
		_bStroked = this.getRealParameter({'oParameters': _iPosX, 'sName': 'bStroked', 'xParameter': _bStroked});
		_xFillStyle = this.getRealParameter({'oParameters': _iPosX, 'sName': 'xFillStyle', 'xParameter': _xFillStyle});
		_sStrokeStyle = this.getRealParameter({'oParameters': _iPosX, 'sName': 'sStrokeStyle', 'xParameter': _sStrokeStyle});
		_dStrokeWidth = this.getRealParameter({'oParameters': _iPosX, 'sName': 'dStrokeWidth', 'xParameter': _dStrokeWidth});
		_dAlpha = this.getRealParameter({'oParameters': _iPosX, 'sName': 'dAlpha', 'xParameter': _dAlpha});
		_iPosX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosX', 'xParameter': _iPosX});

		if (_bFilled == null) {_bFilled = false;}
		if (_bStroked == null) {_bStroked = false;}
		if (_dStrokeWidth == null) {_dStrokeWidth = 1.0;}
		if (_xFillStyle == null) {_xFillStyle = '#ffffff';}
		if (_sStrokeStyle == null) {_sStrokeStyle = '#000000';}
		if (_dAlpha == null) {_dAlpha = 1.0;}
		
		this.openPath();
		this.setup({'dAlpha': _dAlpha});
		this.setupSurface({'xFillStyle': _xFillStyle});
		this.setupLine({'sStrokeStyle': _sStrokeStyle, 'dStrokeWidth': _dStrokeWidth});
		this.addCircle({'iPosX': _iPosX, 'iPosY': _iPosY, 'dRadius': _dRadius});
		this.drawPath({'bFilled': _bFilled, 'bStroked': _bStroked});
		this.closePath();
	}
	/* @end method */
	
	/*
	@start method
	
	@param iPosX [needed][type]int[/type]
	[en]...[/en]
	
	@param iPosY [needed][type]int[/type]
	[en]...[/en]
	
	@param iSizeX [needed][type]int[/type]
	[en]...[/en]
	
	@param iSizeY [needed][type]int[/type]
	[en]...[/en]
	*/
	this.addOval = function(_iPosX, _iPosY, _iSizeX, _iSizeY)
	{
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = null;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}
		
		_iPosY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosY', 'xParameter': _iPosY});
		_iSizeX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		_iSizeY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_iPosX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosX', 'xParameter': _iPosX});

		var _dRadius = _iSizeX/2;
		var _dScaleY = 100*_iSizeY/_iSizeX;
		_dScaleY = _dScaleY/100;
		
		this.oCanvas2D.scale(1, _dScaleY); // scale to make oval
		this.addCircle({'iPosX': _iPosX, 'iPosY': Math.round(_iPosY/_dScaleY), 'dRadius': _dRadius});
	}
	/* @end method */
	
	/*
	@start method
	
	@param iPosX [needed][type]int[/type]
	[en]...[/en]
	
	@param iPosY [needed][type]int[/type]
	[en]...[/en]
	
	@param iSizeX [needed][type]int[/type]
	[en]...[/en]
	
	@param iSizeY [needed][type]int[/type]
	[en]...[/en]
	
	@param bFilled [type]bool[/type]
	[en]...[/en]
	
	@param bStroked [type]bool[/type]
	[en]...[/en]
	
	@param xFillStyle [type]mixed[/type]
	[en]...[/en]
	
	@param sStrokeStyle [type]string[/type]
	[en]...[/en]
	
	@param dStrokeWidth [type]double[/type]
	[en]...[/en]
	
	@param dAlpha [type]double[/type]
	[en]...[/en]
	*/
	this.drawOval = function(_iPosX, _iPosY, _iSizeX, _iSizeY, _bFilled, _bStroked, _xFillStyle, _sStrokeStyle, _dStrokeWidth, _dAlpha)
	{
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = null;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}
		if (typeof(_bFilled) == 'undefined') {var _bFilled = null;}
		if (typeof(_bStroked) == 'undefined') {var _bStroked = null;}
		if (typeof(_xFillStyle) == 'undefined') {var _xFillStyle = null;}
		if (typeof(_sStrokeStyle) == 'undefined') {var _sStrokeStyle = null;}
		if (typeof(_dStrokeWidth) == 'undefined') {var _dStrokeWidth = null;}
		if (typeof(_dAlpha) == 'undefined') {var _dAlpha = null;}

		_iPosY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosY', 'xParameter': _iPosY});
		_iSizeX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		_iSizeY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_bFilled = this.getRealParameter({'oParameters': _iPosX, 'sName': 'bFilled', 'xParameter': _bFilled});
		_bStroked = this.getRealParameter({'oParameters': _iPosX, 'sName': 'bStroked', 'xParameter': _bStroked});
		_xFillStyle = this.getRealParameter({'oParameters': _iPosX, 'sName': 'xFillStyle', 'xParameter': _xFillStyle});
		_sStrokeStyle = this.getRealParameter({'oParameters': _iPosX, 'sName': 'sStrokeStyle', 'xParameter': _sStrokeStyle});
		_dStrokeWidth = this.getRealParameter({'oParameters': _iPosX, 'sName': 'dStrokeWidth', 'xParameter': _dStrokeWidth});
		_dAlpha = this.getRealParameter({'oParameters': _iPosX, 'sName': 'dAlpha', 'xParameter': _dAlpha});
		_iPosX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosX', 'xParameter': _iPosX});

		if (_bFilled == null) {_bFilled = false;}
		if (_bStroked == null) {_bStroked = false;}
		if (_dStrokeWidth == null) {_dStrokeWidth = 1.0;}
		if (_xFillStyle == null) {_xFillStyle = '#ffffff';}
		if (_sStrokeStyle == null) {_sStrokeStyle = '#000000';}
		if (_dAlpha == null) {_dAlpha = 1.0;}
		
		this.openPath();
		this.addOval({'iPosX': _iPosX, 'iPosY': _iPosY, 'iSizeX': _iSizeX, 'iSizeY': _iSizeY});
		this.setup({'dAlpha': _dAlpha});
		this.setupSurface({'xFillStyle': _xFillStyle});
		this.setupLine({'sStrokeStyle': _sStrokeStyle, 'dStrokeWidth': _dStrokeWidth});
		this.drawPath({'bFilled': _bFilled, 'bStroked': _bStroked});
		this.closePath();
	}
	/* @end method */

	/*
	@start method
	@param iPosX [needed][type]int[/type]
	[en]...[/en]
	
	@param iPosY [needed][type]int[/type]
	[en]...[/en]
	
	@param sText [type]string[/type]
	[en]...[/en]
	
	@param sSize [type]string[/type]
	[en]...[/en]
	
	@param sFont [type]string[/type]
	[en]...[/en]
	
	@param sAlign [type]string[/type]
	[en]...[/en]
	
	@param bFilled [type]bool[/type]
	[en]...[/en]
	
	@param bStroked [type]bool[/type]
	[en]...[/en]
	
	@param xFillStyle [type]mixed[/type]
	[en]...[/en]
	
	@param sStrokeStyle [type]string[/type]
	[en]...[/en]
	
	@param dStrokeWidth [type]double[/type]
	[en]...[/en]
	
	@param dAlpha [type]double[/type]
	[en]...[/en]
	*/
	this.drawText = function(_iPosX, _iPosY, _sText, _sSize, _sFont, _sAlign, _bFilled, _bStroked, _xFillStyle, _sStrokeStyle, _dStrokeWidth, _dAlpha)
	{
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}
		if (typeof(_sText) == 'undefined') {var _sText = null;}
		if (typeof(_sSize) == 'undefined') {var _sSize = null;}
		if (typeof(_sFont) == 'undefined') {var _sFont = null;}
		if (typeof(_sAlign) == 'undefined') {var _sAlign = null;}
		if (typeof(_bFilled) == 'undefined') {var _bFilled = null;}
		if (typeof(_bStroked) == 'undefined') {var _bStroked = null;}
		if (typeof(_xFillStyle) == 'undefined') {var _xFillStyle = null;}
		if (typeof(_sStrokeStyle) == 'undefined') {var _sStrokeStyle = null;}
		if (typeof(_dStrokeWidth) == 'undefined') {var _dStrokeWidth = null;}
		if (typeof(_dAlpha) == 'undefined') {var _dAlpha = null;}

		_iPosY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosY', 'xParameter': _iPosY});
		_sText = this.getRealParameter({'oParameters': _iPosX, 'sName': 'sText', 'xParameter': _sText});
		_sSize = this.getRealParameter({'oParameters': _iPosX, 'sName': 'sSize', 'xParameter': _sSize});
		_sFont = this.getRealParameter({'oParameters': _iPosX, 'sName': 'sFont', 'xParameter': _sFont});
		_sAlign = this.getRealParameter({'oParameters': _iPosX, 'sName': 'sAlign', 'xParameter': _sAlign});
		_bFilled = this.getRealParameter({'oParameters': _iPosX, 'sName': 'bFilled', 'xParameter': _bFilled});
		_bStroked = this.getRealParameter({'oParameters': _iPosX, 'sName': 'bStroked', 'xParameter': _bStroked});
		_xFillStyle = this.getRealParameter({'oParameters': _iPosX, 'sName': 'xFillStyle', 'xParameter': _xFillStyle});
		_sStrokeStyle = this.getRealParameter({'oParameters': _iPosX, 'sName': 'sStrokeStyle', 'xParameter': _sStrokeStyle});
		_dStrokeWidth = this.getRealParameter({'oParameters': _iPosX, 'sName': 'dStrokeWidth', 'xParameter': _dStrokeWidth});
		_dAlpha = this.getRealParameter({'oParameters': _iPosX, 'sName': 'dAlpha', 'xParameter': _dAlpha});
		_iPosX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosX', 'xParameter': _iPosX});

		if (_sText == null) {_sText = '';}
		if (_sSize == null) {_sSize = '12px';}
		if (_sFont == null) {_sFont = 'Arial';}
		if (_sAlign == null) {_sAlign = 'left';}
		if (_bFilled == null) {_bFilled = true;}
		if (_bStroked == null) {_bStroked = false;}
		if (_dStrokeWidth == null) {_dStrokeWidth = 1.0;}
		if (_xFillStyle == null) {_xFillStyle = '#000000';}
		if (_sStrokeStyle == null) {_sStrokeStyle = '#000000';}
		if (_dAlpha == null) {_dAlpha = 1.0;}
		
		this.setup({'dAlpha': _dAlpha});
		this.setupSurface({'xFillStyle': _xFillStyle});
		this.setupLine({'sStrokeStyle': _sStrokeStyle, 'dStrokeWidth': _dStrokeWidth});
		this.setupText({'sFontSize': _sSize, 'sFontFamily': _sFont, 'sTextBaseline': 'alphabetic', 'sTextAlign': _sAlign});
		if (_bFilled == true) {this.oCanvas2D.fillText(_sText, _iPosX, _iPosY);}
		if (_bStroked == true) {this.oCanvas2D.strokeText(_sText, _iPosX, _iPosY);}
	}
	/* @end method */
	
	/*
	@start method
	@param iPosX [needed][type]int[/type]
	[en]...[/en]
	
	@param iPosY [needed][type]int[/type]
	[en]...[/en]
	
	@param xImage [needed][type]mixed[/type]
	[en]...[/en]
	
	@param iSizeX [type]int[/type]
	[en]...[/en]
	
	@param iSizeY [type]int[/type]
	[en]...[/en]
	
	@param iSourcePosX [type]int[/type]
	[en]...[/en]
	
	@param iSourcePosY [type]int[/type]
	[en]...[/en]
	
	@param iSourceSizeX [type]int[/type]
	[en]...[/en]
	
	@param iSourceSizeY [type]int[/type]
	[en]...[/en]
	
	@param dAlpha [type]double[/type]
	[en]...[/en]
	*/
	this.drawImage = function(_iPosX, _iPosY, _xImage, _iSizeX, _iSizeY, _iSourcePosX, _iSourcePosY, _iSourceSizeX, _iSourceSizeY, _dAlpha)
	{
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}
		if (typeof(_xImage) == 'undefined') {var _xImage = null;}
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = null;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}
		if (typeof(_iSourcePosX) == 'undefined') {var _iSourcePosX = null;}
		if (typeof(_iSourcePosY) == 'undefined') {var _iSourcePosY = null;}
		if (typeof(_iSourceSizeX) == 'undefined') {var _iSourceSizeX = null;}
		if (typeof(_iSourceSizeY) == 'undefined') {var _iSourceSizeY = null;}
		if (typeof(_dAlpha) == 'undefined') {var _dAlpha = null;}

		_iPosY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosY', 'xParameter': _iPosY});
		_xImage = this.getRealParameter({'oParameters': _iPosX, 'sName': 'xImage', 'xParameter': _xImage});
		_iSizeX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		_iSizeY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_iSourcePosX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSourcePosX', 'xParameter': _iSourcePosX});
		_iSourcePosY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSourcePosY', 'xParameter': _iSourcePosY});
		_iSourceSizeX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSourceSizeX', 'xParameter': _iSourceSizeX});
		_iSourceSizeY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSourceSizeY', 'xParameter': _iSourceSizeY});
		_dAlpha = this.getRealParameter({'oParameters': _iPosX, 'sName': 'dAlpha', 'xParameter': _dAlpha});
		_iPosX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosX', 'xParameter': _iPosX});
		
		var _oImage = _xImage;
		if (typeof(_xImage) == 'string')
		{
			_oImage = new Image();
			_oImage.src = _xImage;
			_oImage.onload = function() {oPGCanvas.drawImage({'iPosX': _iPosX, 'iPosY': _iPosY, 'xImage': _oImage, 'iSizeX': _iSizeX, 'iSizeY': _iSizeY, 'iSourcePosX': _iSourcePosX, 'iSourcePosY': _iSourcePosY, 'iSourceSizeX': _iSourceSizeX, 'iSourceSizeY': _iSourceSizeY, 'dAlpha': _dAlpha});}
		}
		else
		{
			if (_dAlpha != null)
			{
				var _dOldAlpha = this.oCanvas2D.globalAlpha;
				this.oCanvas2D.globalAlpha = _dAlpha;
			}
			if ((_iSourcePosX != null) || (_iSourcePosY != null) || (_iSourceSizeX != null) || (_iSourceSizeY != null))
			{
				if (_iSizeX == null) {_iSizeX = _oImage.width;}
				if (_iSizeY == null) {_iSizeY = _oImage.height;}
				if (_iSourcePosX == null) {_iSourcePosX = 0;}
				if (_iSourcePosY == null) {_iSourcePosY = 0;}
				if (_iSourceSizeX == null) {_iSourceSizeX = _oImage.width;}
				if (_iSourceSizeY == null) {_iSourceSizeY = _oImage.height;}
				
				_iSourcePosX = Math.max(Math.min(_iSourcePosX, _oImage.width), 0);
				_iSourcePosY = Math.max(Math.min(_iSourcePosY, _oImage.width), 0);
				_iSourceSizeX = Math.max(Math.min(_iSourceSizeX, _oImage.width-_iSourcePosX), 0);
				_iSourceSizeY = Math.max(Math.min(_iSourceSizeY, _oImage.height-_iSourcePosY), 0);
				
				this.oCanvas2D.drawImage(_oImage, _iSourcePosX, _iSourcePosY, _iSourceSizeX, _iSourceSizeY, _iPosX, _iPosY, _iSizeX, _iSizeY);
			}
			else if ((_iSizeX != null) || (_iSizeY != null))
			{
				if (_iSizeX == null) {_iSizeX = _oImage.width;}
				if (_iSizeY == null) {_iSizeY = _oImage.height;}
				
				this.oCanvas2D.drawImage(_oImage, _iPosX, _iPosY, _iSizeX, _iSizeY);
			}
			else {this.oCanvas2D.drawImage(_oImage, _iPosX, _iPosY);}
			if (_dAlpha != null) {this.oCanvas2D.globalAlpha = _dOldAlpha;}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param iSizeX [type]int[/type]
	[en]...[/en]
	
	@param iSizeY [type]int[/type]
	[en]...[/en]
	
	@param sContent [type]string[/type]
	[en]...[/en]
	*/
	this.build = function(_iSizeX, _iSizeY, _sContent)
	{
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = null;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}
		if (typeof(_sContent) == 'undefined') {var _sContent = null;}
		
		_iSizeY = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_sContent = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'sContent', 'xParameter': _sContent});
		_iSizeX = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		
		if (_iSizeX == null) {_iSizeX = 320;}
		if (_iSizeY == null) {_iSizeY = 240;}
		if (_sContent == null) {_sContent = '';}
		
		_sHtml = '';
		_sHtml += '<canvas id="'+this.getID()+'" width="'+_iSizeX+'" height="'+_iSizeY+'" style="background-color:#888888;">';
		_sHtml += _sContent;
		_sHtml += '</canvas>';
		return _sHtml;
	}
	/* @end method */
	
	// http://stackoverflow.com/questions/9032050/canvas-mask-an-image-and-preserve-its-alpha-channel
	this.setAlphaPixels = function() {} // TODO
	this.getAlphaPixels = function() {} // TODO
	this.setPixels = function() {} // TODO

	/*
	@start method
	
	@param iPosX [type]int[/type]
	[en]...[/en]
	
	@param iPosY [type]int[/type]
	[en]...[/en]
	
	@param iSizeX [type]int[/type]
	[en]...[/en]
	
	@param iSizeY [type]int[/type]
	[en]...[/en]
	
	@param bAsString [type]bool[/type]
	[en]...[/en]
	*/
	this.getPixels = function(_iPosX, _iPosY, _iSizeX, _iSizeY, _bAsString)
	{
		if (typeof(_iPosX) == 'undefined') {var _iPosX = null;}
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = null;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}
		if (typeof(_bAsString) == 'undefined') {var _bAsString = null;}

		_iPosY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosY', 'xParameter': _iPosY});
		_iSizeX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		_iSizeY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_bAsString = this.getRealParameter({'oParameters': _iPosX, 'sName': 'bAsString', 'xParameter': _bAsString});
		_iPosX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosX', 'xParameter': _iPosX});
		
		var _iCanvasSizeX = parseInt(this.oCanvas.width);
		var _iCanvasSizeY = parseInt(this.oCanvas.height);
		
		if (_iPosX == null) {_iPosX = 0;}
		if (_iPosY == null) {_iPosY = 0;}
		if (_iSizeX == null) {_iSizeX = _iCanvasSizeX;}
		if (_iSizeY == null) {_iSizeY = _iCanvasSizeY;}
		if (_bAsString == null) {_bAsString = false;}
		
		_iPosX = Math.max(Math.min(_iPosX, _iCanvasSizeX), 0);
		_iPosY = Math.max(Math.min(_iPosY, _iCanvasSizeY), 0);
		_iSizeX = Math.max(Math.min(_iSizeX, _iCanvasSizeX-_iPosX), 0);
		_iSizeY = Math.max(Math.min(_iSizeY, _iCanvasSizeY-_iPosY), 0);
	
		if (typeof(this.oCanvas2D.getImageData) != 'function') {return false;}
		
		var _sTest = '';
		var _iIndex = 0;
		var _aiImageData = this.oCanvas2D.getImageData(_iPosX, _iPosY, _iSizeX, _iSizeY);
		if (_bAsString == true) {var _sPixels = '';}
		else {var _axPixels = new Array();}
		for (var _iPixel=0; _iPixel*4<_aiImageData.data.length; _iPixel++)
		{
			_iIndex = _iPixel*4;
			if (_bAsString == true)
			{
				if (_iPixel > 0) {_sPixels += ';';}
				_sPixels += _aiImageData.data[_iIndex]+','+_aiImageData.data[_iIndex+1]+','+_aiImageData.data[_iIndex+2]+','+_aiImageData.data[_iIndex+3];
			}
			else {_axPixels.push({'r':_aiImageData.data[_iIndex], 'g':_aiImageData.data[_iIndex+1], 'b':_aiImageData.data[_iIndex+2], 'a':_aiImageData.data[_iIndex+3]});}
		}
		if (_bAsString == true) {return _sPixels;}
		return _axPixels;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sMimeType [needed][type]string[/type]
	[en]...[/en]
	
	@param bAsString [type]bool[/type]
	[en]...[/en]
	*/
	this.getImageData = function(_sMimeType, _bAsString)
	{
		if (typeof(_bAsString) == 'undefined') {var _bAsString = null;}
		
		_bAsString = this.getRealParameter({'oParameters': _sMimeType, 'sName': 'bAsString', 'xParameter': _bAsString});
		_sMimeType = this.getRealParameter({'oParameters': _sMimeType, 'sName': 'sMimeType', 'xParameter': _sMimeType});
		
		if (_bAsString == null) {_bAsString = false;}
		
		var _sData = this.oCanvas.toDataURL(_sMimeType);
		if (_bAsString == true) {return _sData;}
		
		var _asTemp = _sData.split(';');
		return {'sMimeType':_asTemp[0].split(':')[1], 'sCode':_asTemp[1].split(',')[0], 'sData':_asTemp[1].split(',')[1]};
	}
	/* @end method */
	
	/* @start method */
	this.networkSendImage = function()
	{
		if (this.oCanvas2D != null)
		{
			// TODO
			// document.getElementById('debug').innerHTML = this.getPixels(0,0,10,10,true).replace(/;/g, '<br />');
			var _oData = this.getImageData('image/jpeg', false);
			document.getElementById('debug').innerHTML = _oData['sMimeType']+'<br />'+_oData['sCode']+'<br />'+_oData['sData'];
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@return xMixed [type]mixed[/type]
	[en]...[/en]
	
	@param oDrawObject [needed][type]object[/type]
	[en]...[/en]
	*/
	this.add = function(_oDrawObject)
	{
		_oDrawObject = this.getRealParameter({'oParameters': _oDrawObject, 'sName': 'oDrawObject', 'xParameter': _oDrawObject, 'bNotNull': true});
		if (typeof(_oDrawObject['fFunction']) != 'undefined') {return _oDrawObject['fFunction'].call(this, _oDrawObject);}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@param axDrawObjects [needed][type]mixed[][/type]
	[en]...[/en]
	
	@param bFilled [type]bool[/type]
	[en]...[/en]
	
	@param bStroked [type]bool[/type]
	[en]...[/en]
	
	@param xFillStyle [type]mixed[/type]
	[en]...[/en]
	
	@param sStrokeStyle [type]string[/type]
	[en]...[/en]
	
	@param dStrokeWidth [type]double[/type]
	[en]...[/en]
	
	@param dAlpha [type]double[/type]
	[en]...[/en]
	
	@param sCompositeOperation [type]string[/type]
	[en]...[/en]
	
	@param dShadowOffsetX [type]double[/type]
	[en]...[/en]
	
	@param dShadowOffsetY [type]double[/type]
	[en]...[/en]
	
	@param dShadowBlur [type]double[/type]
	[en]...[/en]
	
	@param sShadowColor [type]string[/type]
	[en]...[/en]
	*/
	this.addBatch = function(_axDrawObjects, _bFilled, _bStroked, _xFillStyle, _sStrokeStyle, _dStrokeWidth, _dAlpha, _sCompositeOperation, _dShadowOffsetX, _dShadowOffsetY, _dShadowBlur, _sShadowColor)
	{
		if (typeof(_bFilled) == 'undefined') {var _bFilled = null;}
		if (typeof(_bStroked) == 'undefined') {var _bStroked = null;}
		if (typeof(_xFillStyle) == 'undefined') {var _xFillStyle = null;}
		if (typeof(_sStrokeStyle) == 'undefined') {var _sStrokeStyle = null;}
		if (typeof(_dStrokeWidth) == 'undefined') {var _dStrokeWidth = null;}
		if (typeof(_sStrokeCap) == 'undefined') {var _sStrokeCap = null;}
		if (typeof(_sStrokeJoin) == 'undefined') {var _sStrokeJoin = null;}
		if (typeof(_dAlpha) == 'undefined') {var _dAlpha = null;}
		if (typeof(_sCompositeOperation) == 'undefined') {var _sCompositeOperation = null;}
		if (typeof(_dShadowOffsetX) == 'undefined') {var _dShadowOffsetX = null;}
		if (typeof(_dShadowOffsetY) == 'undefined') {var _dShadowOffsetY = null;}
		if (typeof(_dShadowBlur) == 'undefined') {var _dShadowBlur = null;}
		if (typeof(_sShadowColor) == 'undefined') {var _sShadowColor = null;}

		_bFilled = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'bFilled', 'xParameter': _bFilled});
		_bStroked = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'bStroked', 'xParameter': _bStroked});
		_xFillStyle = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'xFillStyle', 'xParameter': _xFillStyle});
		_sStrokeStyle = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'sStrokeStyle', 'xParameter': _sStrokeStyle});
		_dStrokeWidth = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'dStrokeWidth', 'xParameter': _dStrokeWidth});
		_dAlpha = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'dAlpha', 'xParameter': _dAlpha});
		_sCompositeOperation = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'sCompositeOperation', 'xParameter': _sCompositeOperation});
		_dShadowOffsetX = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'dShadowOffsetX', 'xParameter': _dShadowOffsetX});
		_dShadowOffsetY = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'dShadowOffsetY', 'xParameter': _dShadowOffsetY});
		_dShadowBlur = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'dShadowBlur', 'xParameter': _dShadowBlur});
		_sShadowColor = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'sShadowColor', 'xParameter': _sShadowColor});
		_axDrawObjects = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'axDrawObjects', 'xParameter': _axDrawObjects});
		
		this.setup({'dAlpha': _dAlpha, 'sCompositeOperation': _sCompositeOperation});
		this.setupLine({'sStrokeStyle': _sStrokeStyle, 'dStrokeWidth': _dStrokeWidth, 'sStrokeCap': _sStrokeCap, 'sStrokeJoin': _sStrokeJoin});
		this.setupSurface({'xFillStyle': _xFillStyle});
		this.setupShadow({'dShadowOffsetX': _dShadowOffsetX, 'dShadowOffsetY': _dShadowOffsetY, 'dShadowBlur': _dShadowBlur, 'sShadowColor': _sShadowColor});
	
		var _bOldFilled = this.bFilled;
		var _bOldStroked = this.bStroked;
		if (_bFilled != null) {this.bFilled = _bFilled;}
		if (_bStroked != null) {this.bStroked = _bStroked;}
		for (var i=0; i<_axDrawObjects.length; i++) {this.add(_axDrawObjects[i]);}
		this.bFilled = _bOldFilled;
		this.bStroked = _bOldStroked;
	}
	/* @end method */
	
	/*
	@start method
	
	@param oDrawObject [needed][type]object[/type]
	[en]...[/en]
	
	@param bFilled [type]bool[/type]
	[en]...[/en]
	
	@param bStroked [type]bool[/type]
	[en]...[/en]
	
	@param xFillStyle [type]mixed[/type]
	[en]...[/en]
	
	@param sStrokeStyle [type]string[/type]
	[en]...[/en]
	
	@param dStrokeWidth [type]double[/type]
	[en]...[/en]
	
	@param dAlpha [type]double[/type]
	[en]...[/en]
	
	@param sCompositeOperation [type]string[/type]
	[en]...[/en]
	
	@param dShadowOffsetX [type]double[/type]
	[en]...[/en]
	
	@param dShadowOffsetY [type]double[/type]
	[en]...[/en]
	
	@param dShadowBlur [type]double[/type]
	[en]...[/en]
	
	@param sShadowColor [type]string[/type]
	[en]...[/en]
	*/
	this.draw = function(_oDrawObject, _bFilled, _bStroked, _xFillStyle, _sStrokeStyle, _dStrokeWidth, _dAlpha, _sCompositeOperation, _dShadowOffsetX, _dShadowOffsetY, _dShadowBlur, _sShadowColor)
	{
		if (typeof(_bFilled) == 'undefined') {var _bFilled = null;}
		if (typeof(_bStroked) == 'undefined') {var _bStroked = null;}
		if (typeof(_xFillStyle) == 'undefined') {var _xFillStyle = null;}
		if (typeof(_sStrokeStyle) == 'undefined') {var _sStrokeStyle = null;}
		if (typeof(_dStrokeWidth) == 'undefined') {var _dStrokeWidth = null;}
		if (typeof(_sStrokeCap) == 'undefined') {var _sStrokeCap = null;}
		if (typeof(_sStrokeJoin) == 'undefined') {var _sStrokeJoin = null;}
		if (typeof(_dAlpha) == 'undefined') {var _dAlpha = null;}
		if (typeof(_sCompositeOperation) == 'undefined') {var _sCompositeOperation = null;}
		if (typeof(_dShadowOffsetX) == 'undefined') {var _dShadowOffsetX = null;}
		if (typeof(_dShadowOffsetY) == 'undefined') {var _dShadowOffsetY = null;}
		if (typeof(_dShadowBlur) == 'undefined') {var _dShadowBlur = null;}
		if (typeof(_sShadowColor) == 'undefined') {var _sShadowColor = null;}

		_bFilled = this.getRealParameter({'oParameters': _oDrawObject, 'sName': 'bFilled', 'xParameter': _bFilled});
		_bStroked = this.getRealParameter({'oParameters': _oDrawObject, 'sName': 'bStroked', 'xParameter': _bStroked});
		_xFillStyle = this.getRealParameter({'oParameters': _oDrawObject, 'sName': 'xFillStyle', 'xParameter': _xFillStyle});
		_sStrokeStyle = this.getRealParameter({'oParameters': _oDrawObject, 'sName': 'sStrokeStyle', 'xParameter': _sStrokeStyle});
		_dStrokeWidth = this.getRealParameter({'oParameters': _oDrawObject, 'sName': 'dStrokeWidth', 'xParameter': _dStrokeWidth});
		_dAlpha = this.getRealParameter({'oParameters': _oDrawObject, 'sName': 'dAlpha', 'xParameter': _dAlpha});
		_sCompositeOperation = this.getRealParameter({'oParameters': _oDrawObject, 'sName': 'sCompositeOperation', 'xParameter': _sCompositeOperation});
		_dShadowOffsetX = this.getRealParameter({'oParameters': _oDrawObject, 'sName': 'dShadowOffsetX', 'xParameter': _dShadowOffsetX});
		_dShadowOffsetY = this.getRealParameter({'oParameters': _oDrawObject, 'sName': 'dShadowOffsetY', 'xParameter': _dShadowOffsetY});
		_dShadowBlur = this.getRealParameter({'oParameters': _oDrawObject, 'sName': 'dShadowBlur', 'xParameter': _dShadowBlur});
		_sShadowColor = this.getRealParameter({'oParameters': _oDrawObject, 'sName': 'sShadowColor', 'xParameter': _sShadowColor});
		_oDrawObject = this.getRealParameter({'oParameters': _oDrawObject, 'sName': 'oDrawObject', 'xParameter': _oDrawObject, 'bNotNull': true});
		
		if ((_bFilled == null) && (typeof(_oDrawObject['bFilled']) != 'undefined')) {_bFilled = _oDrawObject['bFilled'];}
		if ((_bStroked == null) && (typeof(_oDrawObject['bStroked']) != 'undefined')) {_bStroked = _oDrawObject['bStroked'];}
		if ((_xFillStyle == null) && (typeof(_oDrawObject['xFillStyle']) != 'undefined')) {_xFillStyle = _oDrawObject['xFillStyle'];}
		if ((_sStrokeStyle == null) && (typeof(_oDrawObject['sStrokeStyle']) != 'undefined')) {_sStrokeStyle = _oDrawObject['sStrokeStyle'];}
		if ((_dStrokeWidth == null) && (typeof(_oDrawObject['dStrokeWidth']) != 'undefined')) {_dStrokeWidth = _oDrawObject['dStrokeWidth'];}
		if ((_sStrokeCap == null) && (typeof(_oDrawObject['sStrokeCap']) != 'undefined')) {_sStrokeCap = _oDrawObject['sStrokeCap'];}
		if ((_sStrokeJoin == null) && (typeof(_oDrawObject['sStrokeJoin']) != 'undefined')) {_sStrokeJoin = _oDrawObject['sStrokeJoin'];}
		if ((_dAlpha == null) && (typeof(_oDrawObject['dAlpha']) != 'undefined')) {_dAlpha = _oDrawObject['dAlpha'];}
		if ((_sCompositeOperation == null) && (typeof(_oDrawObject['sCompositeOperation']) != 'undefined')) {_sCompositeOperation = _oDrawObject['sCompositeOperation'];}
		if ((_dShadowOffsetX == null) && (typeof(_oDrawObject['dShadowOffsetX']) != 'undefined')) {_dShadowOffsetX = _oDrawObject['dShadowOffsetX'];}
		if ((_dShadowOffsetY == null) && (typeof(_oDrawObject['dShadowOffsetY']) != 'undefined')) {_dShadowOffsetY = _oDrawObject['dShadowOffsetY'];}
		if ((_dShadowBlur == null) && (typeof(_oDrawObject['dShadowBlur']) != 'undefined')) {_dShadowBlur = _oDrawObject['dShadowBlur'];}
		if ((_sShadowColor == null) && (typeof(_oDrawObject['sShadowColor']) != 'undefined')) {_sShadowColor = _oDrawObject['sShadowColor'];}

		var _xReturn = false;
		if (typeof(_oDrawObject['fFunction']) != 'undefined')
		{
			this.setup({'dAlpha': _dAlpha, 'sCompositeOperation': _sCompositeOperation});
			this.setupLine({'sStrokeStyle': _sStrokeStyle, 'dStrokeWidth': _dStrokeWidth, 'sStrokeCap': _sStrokeCap, 'sStrokeJoin': _sStrokeJoin});
			this.setupSurface({'xFillStyle': _xFillStyle});
			this.setupShadow({'dShadowOffsetX': _dShadowOffsetX, 'dShadowOffsetY': _dShadowOffsetY, 'dShadowBlur': _dShadowBlur, 'sShadowColor': _sShadowColor});

			this.oCanvas2D.save();
			
			this.openPath();
			this.add(_oDrawObject);
			this.closePath();

			this.drawPath({'bFilled': _bFilled, 'bStroked': _bStroked});
			
			this.oCanvas2D.restore();
		}
		return _xReturn;
	}
	/* @end method */
	
	/*
	@start method
	
	@param axDrawObjects [needed][type]mixed[][/type]
	[en]...[/en]
	
	@param bFilled [type]bool[/type]
	[en]...[/en]
	
	@param bStroked [type]bool[/type]
	[en]...[/en]
	
	@param xFillStyle [type]mixed[/type]
	[en]...[/en]
	
	@param sStrokeStyle [type]string[/type]
	[en]...[/en]
	
	@param dStrokeWidth [type]double[/type]
	[en]...[/en]
	
	@param dAlpha [type]double[/type]
	[en]...[/en]
	
	@param sCompositeOperation [type]string[/type]
	[en]...[/en]
	
	@param dShadowOffsetX [type]double[/type]
	[en]...[/en]
	
	@param dShadowOffsetY [type]double[/type]
	[en]...[/en]
	
	@param dShadowBlur [type]double[/type]
	[en]...[/en]
	
	@param sShadowColor [type]string[/type]
	[en]...[/en]
	*/
	this.drawBatch = function(_axDrawObjects, _bFilled, _bStroked, _xFillStyle, _sStrokeStyle, _dStrokeWidth, _dAlpha, _sCompositeOperation, _dShadowOffsetX, _dShadowOffsetY, _dShadowBlur, _sShadowColor)
	{
		if (typeof(_bFilled) == 'undefined') {var _bFilled = null;}
		if (typeof(_bStroked) == 'undefined') {var _bStroked = null;}
		if (typeof(_xFillStyle) == 'undefined') {var _xFillStyle = null;}
		if (typeof(_sStrokeStyle) == 'undefined') {var _sStrokeStyle = null;}
		if (typeof(_dStrokeWidth) == 'undefined') {var _dStrokeWidth = null;}
		if (typeof(_sStrokeCap) == 'undefined') {var _sStrokeCap = null;}
		if (typeof(_sStrokeJoin) == 'undefined') {var _sStrokeJoin = null;}
		if (typeof(_dAlpha) == 'undefined') {var _dAlpha = null;}
		if (typeof(_sCompositeOperation) == 'undefined') {var _sCompositeOperation = null;}
		if (typeof(_dShadowOffsetX) == 'undefined') {var _dShadowOffsetX = null;}
		if (typeof(_dShadowOffsetY) == 'undefined') {var _dShadowOffsetY = null;}
		if (typeof(_dShadowBlur) == 'undefined') {var _dShadowBlur = null;}
		if (typeof(_sShadowColor) == 'undefined') {var _sShadowColor = null;}

		_bFilled = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'bFilled', 'xParameter': _bFilled});
		_bStroked = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'bStroked', 'xParameter': _bStroked});
		_xFillStyle = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'xFillStyle', 'xParameter': _xFillStyle});
		_sStrokeStyle = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'sStrokeStyle', 'xParameter': _sStrokeStyle});
		_dStrokeWidth = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'dStrokeWidth', 'xParameter': _dStrokeWidth});
		_dAlpha = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'dAlpha', 'xParameter': _dAlpha});
		_sCompositeOperation = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'sCompositeOperation', 'xParameter': _sCompositeOperation});
		_dShadowOffsetX = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'dShadowOffsetX', 'xParameter': _dShadowOffsetX});
		_dShadowOffsetY = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'dShadowOffsetY', 'xParameter': _dShadowOffsetY});
		_dShadowBlur = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'dShadowBlur', 'xParameter': _dShadowBlur});
		_sShadowColor = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'sShadowColor', 'xParameter': _sShadowColor});
		_axDrawObjects = this.getRealParameter({'oParameters': _axDrawObjects, 'sName': 'axDrawObjects', 'xParameter': _axDrawObjects});
		
		var _bFilled2 = null;
		var _bStroked2 = null;
		var _xFillStyle2 = null;
		var _sStrokeStyle2 = null;
		var _dStrokeWidth2 = null;
		var _sStrokeCap2 = null;
		var _sStrokeJoin2 = null;
		var _dAlpha2 = null;
		var _sCompositeOperation2 = null;
		var _dShadowOffsetX2 = null;
		var _dShadowOffsetY2 = null;
		var _dShadowBlur2 = null;
		var _sShadowColor2 = null;
		
		for (var i=0; i<_axDrawObjects.length; i++)
		{
			if ((_axDrawObjects[i]['fFunction']) != 'undefined')
			{
				if (typeof(_axDrawObjects[i]['bFilled']) != 'undefined') {_bFilled2 = _axDrawObjects[i]['bFilled'];} else if (_bFilled != null) {_bFilled2 = _bFilled;}
				if (typeof(_axDrawObjects[i]['bStroked']) != 'undefined') {_bStroked2 = _axDrawObjects[i]['bStroked'];} else if (_bStroked != null) {_bStroked2 = _bStroked;}
				if (typeof(_axDrawObjects[i]['xFillStyle']) != 'undefined') {_xFillStyle2 = _axDrawObjects[i]['xFillStyle'];} else if (_xFillStyle != null) {_xFillStyle2 = _xFillStyle;}
				if (typeof(_axDrawObjects[i]['sStrokeStyle']) != 'undefined') {_sStrokeStyle2 = _axDrawObjects[i]['sStrokeStyle'];} else if (_sStrokeStyle != null) {_sStrokeStyle2 = _sStrokeStyle;}
				if (typeof(_axDrawObjects[i]['dStrokeWidth']) != 'undefined') {_dStrokeWidth2 = _axDrawObjects[i]['dStrokeWidth'];} else if (_dStrokeWidth != null) {_dStrokeWidth2 = _dStrokeWidth;}
				if (typeof(_axDrawObjects[i]['sStrokeCap']) != 'undefined') {_sStrokeCap2 = _axDrawObjects[i]['sStrokeCap'];} else if (_sStrokeCap != null) {_sStrokeCap2 = _sStrokeCap;}
				if (typeof(_axDrawObjects[i]['sStrokeJoin']) != 'undefined') {_sStrokeJoin2 = _axDrawObjects[i]['sStrokeJoin'];} else if (_sStrokeJoin != null) {_sStrokeJoin2 = _sStrokeJoin;}
				if (typeof(_axDrawObjects[i]['dAlpha']) != 'undefined') {_dAlpha2 = _axDrawObjects[i]['dAlpha'];} else if (_dAlpha != null) {_dAlpha2 = _dAlpha;}
				if (typeof(_axDrawObjects[i]['sCompositeOperation']) != 'undefined') {_sCompositeOperation2 = _axDrawObjects[i]['sCompositeOperation'];} else if (_sCompositeOperation != null) {_sCompositeOperation2 = _sCompositeOperation;}
				if (typeof(_axDrawObjects[i]['dShadowOffsetX']) != 'undefined') {_dShadowOffsetX2 = _axDrawObjects[i]['dShadowOffsetX'];} else if (_dShadowOffsetX != null) {_dShadowOffsetX2 = _dShadowOffsetX;}
				if (typeof(_axDrawObjects[i]['dShadowOffsetY']) != 'undefined') {_dShadowOffsetY2 = _axDrawObjects[i]['_dShadowOffsetY'];} else if (_dShadowOffsetY != null) {_dShadowOffsetY2 = _dShadowOffsetY;}
				if (typeof(_axDrawObjects[i]['dShadowBlur']) != 'undefined') {_dShadowBlur2 = _axDrawObjects[i]['dShadowBlur'];} else if (_dShadowBlur != null) {_dShadowBlur2 = _dShadowBlur;}
				if (typeof(_axDrawObjects[i]['sShadowColor']) != 'undefined') {_sShadowColor2 = _axDrawObjects[i]['sShadowColor'];} else if (_sShadowColor != null) {_sShadowColor2 = _sShadowColor;}
				this.draw(
					{
						'oDrawObject': _axDrawObjects[i],
						'bFilled':_bFilled2, 'bStroked':_bStroked2, 
						'xFillStyle':_xFillStyle2, 
						'sStrokeStyle':_sStrokeStyle2, 'dStrokeWidth':_dStrokeWidth2, 'sStrokeCap':_sStrokeCap2, 'sStrokeJoin':_sStrokeJoin2, 
						'dAlpha':_dAlpha2, 'sCompositeOperation':_sCompositeOperation2, 
						'dShadowOffsetX':_dShadowOffsetX2, 'dShadowOffsetY':_dShadowOffsetY2, 'dShadowBlur':_dShadowBlur2, 'sShadowColor':_sShadowColor2
					}
				);
			}
		}
	}
	/* @end method */
	
	this.drawTest = function()
	{
		if ((this.oCanvas) && (this.oCanvas2D))
		{
			/*
			this.oCanvas2D.clearRect(0, 0, this.oCanvas.getSizeX(), this.oCanvas.getSizeY());
			this.openPath();
			this.oCanvas2D.lineWidth = 5;
			this.oCanvas2D.moveTo(100, 100);
			this.oCanvas2D.bezierCurveTo(120, 120,
										80, 200,
										200, 200);
			this.oCanvas2D.stroke();
			this.closePath();
			
			this.setupShadow(3, 3, 4, 'rgba(0,0,0,0.5)');
			
			this.drawLine({'iPosToX':100, 'iPosToY':100, 'iPosFromX':200, 'iPosFromY':200, 'sStrokeStyle':'#ff0000', 'dStrokeWidth':5, 'dAlpha':0.5});
			this.drawLine({'iPosToX':20, 'iPosToY':100, 'iPosFromX':200, 'iPosFromY':200, 'sStrokeStyle':'#00ff00', 'dStrokeWidth':1, 'dAlpha':1.0});
			this.drawRect({'iPosX':250, 'iPosY':10, 'iSizeX':30, 'iSizeY':30, 'bFilled':true, 'xFillStyle':'#ffffff', 'sStrokeStyle':'#000000', 'dStrokeWidth':1.0, 'dAlpha':1.0});
			this.drawCircle({'iPosX':250, 'iPosY':150, 'dRadius':20, 'bFilled':true, 'xFillStyle':'#ffffff', 'sStrokeStyle':'#000000', 'dStrokeWidth':1.0, 'dAlpha':1.0});
			
			this.drawText({'iPosX':100, 'iPosY':100, 'sText':'test', 'sSize':'50px', 'sFont':'Verdana', 'sAlign':'left', 'bFilled':true, 'bStroked':true, 'sFillStyle':'#000000', 'sStrokeStyle':'#ff0000', 'dStrokeWidth':2.0, 'dAlpha':1.0});
			this.drawText({'iPosX':200, 'iPosY':100, 'sText':'test', 'sSize':'50px', 'sFont':'Verdana', 'sAlign':'left', 'bFilled':true});
			this.drawImage({'iPosX':300, 'iPosY':20, 'xImage':'http://api.progade.de/test/isis_anzeigen/images/isis_anzeigenmarkt_logo.jpg', 'iSizeX':300, 'iSizeY':230, 'iSourcePosX':100, 'iSourcePosY':100, 'iSourceSizeX':100, 'iSourceSizeY:':40, 'dAlpha':0.5});
			
			this.drawTriangle({'iPosX':10, 'iPosY':10, 'iSizeX':50, 'iSizeY':50, 'bFilled':true, 'sFillStyle':'#ff0', 'sStrokeStyle':'#000', 'dStrokeWidth':3, 'dAlpha':1});
			
			var _iFromPosX = 500;
			var _iFromPosY = 200;
			var _iToPosX = 700;
			var _iToPosY = 200;
			var _axColorStops = new Array({'percent': 0, 'style': '#8f8'}, {'percent': 50, 'style': '#88f'}, {'percent': 100, 'style': '#C55'});
			var _oGradient = this.getLinearGradient({'iFromPosX':_iFromPosX, 'iFromPosY':_iFromPosY, 'iToPosX':_iToPosX, 'iToPosY':_iToPosY, 'axColorStops':_axColorStops});
			this.drawRect(500, 200, 200, 200, true, _oGradient);
			
			var _iCenterPosX = 300;
			var _iCenterPosY = 300;
			var _dRadius = 100;
			var _oGradient = this.getRadialGradient({'iCenterPosX':_iCenterPosX, 'iCenterPosY':_iCenterPosY, 'dRadius':_dRadius, 'axColorStops':_axColorStops});
			this.drawRect(200, 200, 200, 200, true, _oGradient);
			*/
			
			// this.oCanvas2D.scale(0.5,0.5);
			this.addBatch(
				{
					'axDrawObjects': [
						/*{'fFunction':this.setupSurface, 'xFillStyle':'#ffffff'},
						
						{'fFunction':this.openPath},
							{'fFunction':this.addLine, 'iPosFromX': 0, 'iPosFromY':10, 'iPosToX':300, 'iPosToY':300},
							{'fFunction':this.addLine, 'iPosFromX': 0, 'iPosFromY':40, 'iPosToX':300, 'iPosToY':300},
						{'fFunction':this.closePath},
						{'fFunction':this.drawPath},*/
						
						// {'fFunction':this.setupLine, 'sStrokeStyle':'#ff0000'},
						{'fFunction':this.openPath},
							{'fFunction':this.addLine, 'iPosFromX':100, 'iPosFromY':100, 'iPosToX':300, 'iPosToY':100},
							{'fFunction':this.addLine, 'iPosToX':300, 'iPosToY':300},
						{'fFunction':this.closePath},
						{'fFunction':this.drawPath, 'bFilled':true, 'bStroked':true},

						{'fFunction':this.openPath},
							{'fFunction':this.addLine, 'iPosFromX':300, 'iPosFromY':100, 'iPosToX':500, 'iPosToY':100},
							{'fFunction':this.addLine, 'iPosToX':500, 'iPosToY':300},
						{'fFunction':this.closePath},
						{'fFunction':this.drawPath}, // , 'bFilled':null, 'bStroked':null},

						{'fFunction':this.openPath},
							{'fFunction':this.addLine, 'iPosFromX':500, 'iPosFromY':100, 'iPosToX':700, 'iPosToY':100},
							{'fFunction':this.addLine, 'iPosToX':700, 'iPosToY':300},
						{'fFunction':this.closePath},
						{'fFunction':this.drawPath, 'bFilled':true, 'bStroked':false},
						
						// {'fFunction':this.drawOval, 'iPosX':350, 'iPosY':50, 'iSizeX':67, 'iSizeY': 36, 'bFilled':true, 'bStroked':true, 'xFillStyle':'#ffffff', 'sStrokeStyle':'#000000', 'dStrokeWidth':1.0, 'dAlpha':1.0}
						/*
						{'fFunction':this.drawLine, 'iPosFromX':10, 'iPosFromY':10, 'iPosToX':300, 'iPosToY':300},
						{'fFunction':this.drawLine, 'iPosFromX':20, 'iPosFromY':10, 'iPosToX':300, 'iPosToY':300},
						{'fFunction':this.drawLine, 'iPosFromX':30, 'iPosFromY':10, 'iPosToX':300, 'iPosToY':300}
						*/
					],
					'bFilled':false, 'bStroked':true, 'xFillStyle':'#080', 'sStrokeStyle':'#fff'
				}
			);
			
			// var _aTest = [{'fFunction':this.addLine, 'iPosFromX': 0, 'iPosFromY':10, 'iPosToX':300, 'iPosToY':300}];
			
			// this.oCanvas2D.scale(2,2);
			this.drawBatch(
				{
					'axDrawObjects': [
						{'fFunction':this.addOval, 'iPosX':350, 'iPosY':50, 'iSizeX':67, 'iSizeY': 36},
						{'fFunction':this.addRegularPolygone, 'iPosX':100, 'iPosY':100, 'iSizeX':50, 'iSizeY':100, 'iCornerCount':5},
						{'fFunction':this.addRegularPolygone, 'iPosX':250, 'iPosY':100, 'iSizeX':100, 'iSizeY':50, 'iCornerCount':10},
						{'fFunction':this.addStar, 'iPosX':450, 'iPosY':100, 'iSizeX':40, 'iSizeY':100, 'iPeakCount':10, 'iPeakSize':10},
						{'fFunction':this.addGear, 'iPosX':350, 'iPosY':200, 'iSizeX':50, 'iSizeY':50, 'iToothCount':8, 'iToothSize':4},
						{'fFunction':this.addRoundedRect, 'iPosX':250, 'iPosY':200, 'iSizeX':50, 'iSizeY':50, 'iCornerCurve':5},
					],
					'bFilled':true, 'bStroked':true, 'xFillStyle':'#ffffff', 'sStrokeStyle':'#00ff00'
				}
			);
			
			// TODO:
			// boolean functions (Auswahl und dann ausschneiden usw.)
		}
	}
}
/* @end class */
classPG_Canvas.prototype = new classPG_ClassBasics();
var oPGCanvas = new classPG_Canvas();
