/*
* ProGade API
* Copyright 2014, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 06 2014
*/
/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_Divs()
{
	// Declarations...
	this.oDocument = document;
		
	// Construct...
	
	// Methods...
	/*
	@start method
	
	@return oDiv [type]object[/type]
	[en]...[/en]
	
	@param sDivID [type]string[/type]
	[en]...[/en]
	
	@param sContent [type]string[/type]
	[en]...[/en]
	
	@param xSizeX [type]mixed[/type]
	[en]...[/en]
	
	@param xSizeY [type]mixed[/type]
	[en]...[/en]
	
	@param sOverflow [type]string[/type]
	[en]...[/en]
	
	@param xPosX [type]mixed[/type]
	[en]...[/en]
	
	@param xPosY [type]mixed[/type]
	[en]...[/en]
	
	@param sPosition [type]string[/type]
	[en]...[/en]
	
	@param sCssClass [type]string[/type]
	[en]...[/en]
	
	@param sCssStyle [type]string[/type]
	[en]...[/en]
	
	@param bReturnHtml [type]bool[/type]
	[en]...[/en]
	*/
	this.build = function(_sDivID, _sContent, _xSizeX, _xSizeY, _sOverflow, _xPosX, _xPosY, _sPosition, _sCssClass, _sCssStyle, _bReturnHtml)
	{
		if (typeof(_sDivID) == 'undefined') {var _sDivID = null;}
		if (typeof(_sContent) == 'undefined') {var _sContent = null;}
		if (typeof(_xSizeX) == 'undefined') {var _xSizeX = null;}
		if (typeof(_xSizeY) == 'undefined') {var _xSizeY = null;}
		if (typeof(_sOverflow) == 'undefined') {var _sOverflow = null;}
		if (typeof(_xPosX) == 'undefined') {var _xPosX = null;}
		if (typeof(_xPosY) == 'undefined') {var _xPosY = null;}
		if (typeof(_sPosition) == 'undefined') {var _sPosition = null;}
		if (typeof(_sCssClass) == 'undefined') {var _sCssClass = null;}
		if (typeof(_sCssStyle) == 'undefined') {var _sCssStyle = null;}
		if (typeof(_bReturnHtml) == 'undefined') {var _bReturnHtml = null;}

		_sContent = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sContent', 'xParameter': _sContent});
		_xSizeX = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xSizeX', 'xParameter': _xSizeX});
		_xSizeY = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xSizeY', 'xParameter': _xSizeY});
		_sOverflow = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sOverflow', 'xParameter': _sOverflow});
		_xPosX = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xPosX', 'xParameter': _xPosX});
		_xPosY = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xPosY', 'xParameter': _xPosY});
		_sPosition = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sPosition', 'xParameter': _sPosition});
		_sCssClass = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		_sCssStyle = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sCssStyle', 'xParameter': _sCssStyle});
		_bReturnHtml = this.getRealParameter({'oParameters': _sDivID, 'sName': 'bReturnHtml', 'xParameter': _bReturnHtml});
		_sDivID = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xVar', 'xParameter': _sDivID});
		
		if (typeof(oPGVars) != 'undefined')
		{
			_xPosX = oPGVars.cssNumber({'xVar': _xPosX});
			_xPosY = oPGVars.cssNumber({'xVar': _xPosY});
			_xSizeX = oPGVars.cssNumber({'xVar': _xSizeX});
			_xSizeY = oPGVars.cssNumber({'xVar': _xSizeY});
		}
		
		if (_bReturnHtml == true)
		{
			return this.buildHtmlString(
				{
					'sDivID': _sDivID, 
					'sContent': _sContent, 
					'xSizeX': _xSizeX, 
					'xSizeY': _xSizeY, 
					'sOverflow': _sOverflow, 
					'xPosX': _xPosX, 
					'xPosY': _xPosY, 
					'sPosition': _sPosition, 
					'sCssClass': _sCssClass, 
					'sCssStyle': _sCssStyle
				}
			);
		}
		
		var _oDiv = this.oDocument.createElement('div');
		if ((_sDivID != null) && (_sDivID != '')) {_oDiv.id = _sDivID;}
		if ((_sCssStyle != null) && (_sCssStyle != '') && (typeof(oPGCss) != 'undefined')) {oPGCss.setStyle({'xElement':_oDiv, 'xStyle':_sCssStyle});}
		if ((_xSizeX != null) && (_xSizeX != '')) {_oDiv.style.width = _xSizeX;}
		if ((_xSizeY != null) && (_xSizeY != '')) {_oDiv.style.height = _xSizeY;}
		if ((_sOverflow != null) && (_sOverflow != '')) {_oDiv.style.overflow = _sOverflow;}
		if ((_xPosX != null) && (_xPosX != '')) {_oDiv.style.left = _xPosX;}
		if ((_xPosY != null) && (_xPosY != '')) {_oDiv.style.top = _xPosY;}
		if ((_sPosition != null) && (_sPosition != '')) {_oDiv.style.position = _sPosition;}
		if ((_sCssClass != null) && (_sCssClass != '')) {_oDiv.className = _sCssClass;}
		if ((_sContent != null) && (_sContent != '')) {_oDiv.innerHTML = _sContent;}
		return _oDiv;
	}
	/* @end method */
	this.buildNodeObject = this.build;
	this.buildDivObject = this.build;
	
	/*
	@start method
	
	@return sDiv [type]string[/type]
	[en]...[/en]
	
	@param sDivID [type]string[/type]
	[en]...[/en]
	
	@param sContent [type]string[/type]
	[en]...[/en]
	
	@param xSizeX [type]mixed[/type]
	[en]...[/en]
	
	@param xSizeY [type]mixed[/type]
	[en]...[/en]
	
	@param sOverflow [type]string[/type]
	[en]...[/en]
	
	@param xPosX [type]mixed[/type]
	[en]...[/en]
	
	@param xPosY [type]mixed[/type]
	[en]...[/en]
	
	@param sPosition [type]string[/type]
	[en]...[/en]
	
	@param sCssClass [type]string[/type]
	[en]...[/en]
	
	@param sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	this.buildHtmlString = function(_sDivID, _sContent, _xSizeX, _xSizeY, _sOverflow, _xPosX, _xPosY, _sPosition, _sCssClass, _sCssStyle)
	{
		if (typeof(_sDivID) == 'undefined') {var _sDivID = null;}
		if (typeof(_sContent) == 'undefined') {var _sContent = null;}
		if (typeof(_xSizeX) == 'undefined') {var _xSizeX = null;}
		if (typeof(_xSizeY) == 'undefined') {var _xSizeY = null;}
		if (typeof(_sOverflow) == 'undefined') {var _sOverflow = null;}
		if (typeof(_xPosX) == 'undefined') {var _xPosX = null;}
		if (typeof(_xPosY) == 'undefined') {var _xPosY = null;}
		if (typeof(_sPosition) == 'undefined') {var _sPosition = null;}
		if (typeof(_sCssClass) == 'undefined') {var _sCssClass = null;}
		if (typeof(_sCssStyle) == 'undefined') {var _sCssStyle = null;}
		
		_sContent = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sContent', 'xParameter': _sContent});
		_xSizeX = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xSizeX', 'xParameter': _xSizeX});
		_xSizeY = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xSizeY', 'xParameter': _xSizeY});
		_sOverflow = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sOverflow', 'xParameter': _sOverflow});
		_xPosX = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xPosX', 'xParameter': _xPosX});
		_xPosY = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xPosY', 'xParameter': _xPosY});
		_sPosition = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sPosition', 'xParameter': _sPosition});
		_sCssClass = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		_sCssStyle = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sCssStyle', 'xParameter': _sCssStyle});
		_sDivID = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xVar', 'xParameter': _sDivID});

		if (typeof(oPGVars) != 'undefined')
		{
			_xPosX = oPGVars.cssNumber({'xVar': _xPosX});
			_xPosY = oPGVars.cssNumber({'xVar': _xPosY});
			_xSizeX = oPGVars.cssNumber({'xVar': _xSizeX});
			_xSizeY = oPGVars.cssNumber({'xVar': _xSizeY});
		}
		
		var _sHtml = '';
		_sHtml += '<div';
		if ((_sDivID != null) && (_sDivID != '')) {_sHtml += ' id="'+_sDivID+'"';}
		if
		(
			((_sSizeX != null) && (_sSizeX != ''))
			|| ((_sSizeY != null) && (_sSizeY != ''))
			|| ((_sOverflow != null) && (_sOverflow != ''))
			|| ((_sPosX != null) && (_sPosX != ''))
			|| ((_sPosY != null) && (_sPosY != ''))
			|| ((_sPosition != null) && (_sPosition != ''))
			|| ((_sCssStyle != null) && (_sCssStyle != ''))
		)
		{
			_sHtml += ' style="';
			if ((_sSizeX != null) && (_sSizeX != '')) {_sHtml += 'width:'+_sSizeX+'; ';}
			if ((_sSizeY != null) && (_sSizeY != '')) {_sHtml += 'height:'+_sSizeY+'; ';}
			if ((_sOverflow != null) && (_sOverflow != '')) {_sHtml += 'overflow:'+_sOverflow+'; ';}
			if ((_sPosX != null) && (_sPosX != '')) {_sHtml += 'left:'+_sPosX+'; ';}
			if ((_sPosY != null) && (_sPosY != '')) {_sHtml += 'top:'+_sPosY+'; ';}
			if ((_sPosition != null) && (_sPosition != '')) {_sHtml += 'position:'+_sPosition+'; ';}
			if ((_sCssStyle != null) && (_sCssStyle != '')) {_sHtml += _sCssStyle;}
			_sHtml += '"';
		}
		
		if ((_sCssClass != null) && (_sCssClass != '')) {_sHtml += ' class="'+_sCssClass+'"';}
		_sHtml += '>';
		if ((_sContent != null) && (_sContent != '')) {_sHtml += _sContent;}
		_sHtml += '</div>';
		return _sHtml;
	}
	/* @end method */
	this.buildDivString = this.buildHtmlString;
	
	/*
	@start method
	
	@return oDiv [type]object[/type]
	[en]...[/en]
	
	@param xIntoParent [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sDivID [type]string[/type]
	[en]...[/en]
	
	@param sContent [type]string[/type]
	[en]...[/en]
	
	@param xSizeX [type]mixed[/type]
	[en]...[/en]
	
	@param xSizeY [type]mixed[/type]
	[en]...[/en]
	
	@param sOverflow [type]string[/type]
	[en]...[/en]
	
	@param xPosX [type]mixed[/type]
	[en]...[/en]
	
	@param xPosY [type]mixed[/type]
	[en]...[/en]
	
	@param sPosition [type]string[/type]
	[en]...[/en]
	
	@param sCssClass [type]string[/type]
	[en]...[/en]
	
	@param sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	this.buildInto = function(_xIntoParent, _sDivID, _sContent, _xSizeX, _xSizeY, _sOverflow, _xPosX, _xPosY, _sPosition, _sCssClass, _sCssStyle)
	{
		if (typeof(_sDivID) == 'undefined') {var _sDivID = null;}
		if (typeof(_sContent) == 'undefined') {var _sContent = null;}
		if (typeof(_xSizeX) == 'undefined') {var _xSizeX = null;}
		if (typeof(_xSizeY) == 'undefined') {var _xSizeY = null;}
		if (typeof(_sOverflow) == 'undefined') {var _sOverflow = null;}
		if (typeof(_xPosX) == 'undefined') {var _xPosX = null;}
		if (typeof(_xPosY) == 'undefined') {var _xPosY = null;}
		if (typeof(_sPosition) == 'undefined') {var _sPosition = null;}
		if (typeof(_sCssClass) == 'undefined') {var _sCssClass = null;}
		if (typeof(_sCssStyle) == 'undefined') {var _sCssStyle = null;}
		
		_sContent = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sContent', 'xParameter': _sContent});
		_xSizeX = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xSizeX', 'xParameter': _xSizeX});
		_xSizeY = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xSizeY', 'xParameter': _xSizeY});
		_sOverflow = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sOverflow', 'xParameter': _sOverflow});
		_xPosX = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xPosX', 'xParameter': _xPosX});
		_xPosY = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xPosY', 'xParameter': _xPosY});
		_sPosition = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sPosition', 'xParameter': _sPosition});
		_sCssClass = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		_sCssStyle = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sCssStyle', 'xParameter': _sCssStyle});
		_sDivID = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xVar', 'xParameter': _sDivID});
		
		var _oDiv = this.build(
			{
				'sDivID': _sDivID, 
				'sContent': _sContent, 
				'xSizeX': _xSizeX, 
				'xSizeY': _xSizeY, 
				'sOverflow': _sOverflow, 
				'xPosX': _xPosX, 
				'xPosY': _xPosY, 
				'sPosition': _sPosition, 
				'sCssClass': _sCssClass, 
				'sCssStyle': _sCssStyle
			}
		);
		if (_oDiv) {return oPGNodes.insertInto({'xIntoParent': _xIntoParent, 'xInsertElement': _oDiv});}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return oDiv [type]object[/type]
	[en]...[/en]
	
	@param xIntoParent [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xBeforeChild [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sDivID [type]string[/type]
	[en]...[/en]
	
	@param sContent [type]string[/type]
	[en]...[/en]
	
	@param xSizeX [type]mixed[/type]
	[en]...[/en]
	
	@param xSizeY [type]mixed[/type]
	[en]...[/en]
	
	@param sOverflow [type]string[/type]
	[en]...[/en]
	
	@param xPosX [type]mixed[/type]
	[en]...[/en]
	
	@param xPosY [type]mixed[/type]
	[en]...[/en]
	
	@param sPosition [type]string[/type]
	[en]...[/en]
	
	@param sCssClass [type]string[/type]
	[en]...[/en]
	
	@param sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	this.buildBefore = function(_xIntoParent, _xBeforeChild, _sDivID, _sContent, _xSizeX, _xSizeY, _sOverflow, _xPosX, _xPosY, _sPosition, _sCssClass, _sCssStyle)
	{
		if (typeof(_sDivID) == 'undefined') {var _sDivID = null;}
		if (typeof(_sContent) == 'undefined') {var _sContent = null;}
		if (typeof(_xSizeX) == 'undefined') {var _xSizeX = null;}
		if (typeof(_xSizeY) == 'undefined') {var _xSizeY = null;}
		if (typeof(_sOverflow) == 'undefined') {var _sOverflow = null;}
		if (typeof(_xPosX) == 'undefined') {var _xPosX = null;}
		if (typeof(_xPosY) == 'undefined') {var _xPosY = null;}
		if (typeof(_sPosition) == 'undefined') {var _sPosition = null;}
		if (typeof(_sCssClass) == 'undefined') {var _sCssClass = null;}
		if (typeof(_sCssStyle) == 'undefined') {var _sCssStyle = null;}
		
		_sContent = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sContent', 'xParameter': _sContent});
		_xSizeX = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xSizeX', 'xParameter': _xSizeX});
		_xSizeY = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xSizeY', 'xParameter': _xSizeY});
		_sOverflow = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sOverflow', 'xParameter': _sOverflow});
		_xPosX = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xPosX', 'xParameter': _xPosX});
		_xPosY = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xPosY', 'xParameter': _xPosY});
		_sPosition = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sPosition', 'xParameter': _sPosition});
		_sCssClass = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		_sCssStyle = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sCssStyle', 'xParameter': _sCssStyle});
		_sDivID = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xVar', 'xParameter': _sDivID});
		
		var _oDiv = this.build(
			{
				'sDivID': _sDivID, 
				'sContent': _sContent, 
				'xSizeX': _xSizeX, 
				'xSizeY': _xSizeY, 
				'sOverflow': _sOverflow, 
				'xPosX': _xPosX, 
				'xPosY': _xPosY, 
				'sPosition': _sPosition, 
				'sCssClass': _sCssClass, 
				'sCssStyle': _sCssStyle
			}
		);
		if (_oDiv) {return oPGNodes.insertBefore({'xIntoParent': _xIntoParent, 'xBeforeChild': _xBeforeChild, '_xInsertElement': _oDiv});}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return oDiv [type]object[/type]
	[en]...[/en]
	
	@param xIntoParent [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xAfterChild [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sDivID [type]string[/type]
	[en]...[/en]
	
	@param sContent [type]string[/type]
	[en]...[/en]
	
	@param xSizeX [type]mixed[/type]
	[en]...[/en]
	
	@param xSizeY [type]mixed[/type]
	[en]...[/en]
	
	@param sOverflow [type]string[/type]
	[en]...[/en]
	
	@param xPosX [type]mixed[/type]
	[en]...[/en]
	
	@param xPosY [type]mixed[/type]
	[en]...[/en]
	
	@param sPosition [type]string[/type]
	[en]...[/en]
	
	@param sCssClass [type]string[/type]
	[en]...[/en]
	
	@param sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	this.buildAfter = function(_xIntoParent, _xAfterChild, _sDivID, _sContent, _xSizeX, _xSizeY, _sOverflow, _xPosX, _xPosY, _sPosition, _sCssClass, _sCssStyle)
	{
		if (typeof(_sDivID) == 'undefined') {var _sDivID = null;}
		if (typeof(_sContent) == 'undefined') {var _sContent = null;}
		if (typeof(_xSizeX) == 'undefined') {var _xSizeX = null;}
		if (typeof(_xSizeY) == 'undefined') {var _xSizeY = null;}
		if (typeof(_sOverflow) == 'undefined') {var _sOverflow = null;}
		if (typeof(_xPosX) == 'undefined') {var _xPosX = null;}
		if (typeof(_xPosY) == 'undefined') {var _xPosY = null;}
		if (typeof(_sPosition) == 'undefined') {var _sPosition = null;}
		if (typeof(_sCssClass) == 'undefined') {var _sCssClass = null;}
		if (typeof(_sCssStyle) == 'undefined') {var _sCssStyle = null;}
		
		_sContent = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sContent', 'xParameter': _sContent});
		_xSizeX = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xSizeX', 'xParameter': _xSizeX});
		_xSizeY = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xSizeY', 'xParameter': _xSizeY});
		_sOverflow = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sOverflow', 'xParameter': _sOverflow});
		_xPosX = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xPosX', 'xParameter': _xPosX});
		_xPosY = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xPosY', 'xParameter': _xPosY});
		_sPosition = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sPosition', 'xParameter': _sPosition});
		_sCssClass = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		_sCssStyle = this.getRealParameter({'oParameters': _sDivID, 'sName': 'sCssStyle', 'xParameter': _sCssStyle});
		_sDivID = this.getRealParameter({'oParameters': _sDivID, 'sName': 'xVar', 'xParameter': _sDivID});
		
		var _oDiv = this.build(
			{
				'sDivID': _sDivID, 
				'sContent': _sContent, 
				'xSizeX': _xSizeX, 
				'xSizeY': _xSizeY, 
				'sOverflow': _sOverflow, 
				'xPosX': _xPosX, 
				'xPosY': _xPosY, 
				'sPosition': _sPosition, 
				'sCssClass': _sCssClass, 
				'sCssStyle': _sCssStyle
			}
		);
		if (_oDiv) {return oPGNodes.insertAfter({'xIntoParent': _xIntoParent, 'xAfterChild': _xAfterChild, 'xInsertElement': _oDiv});}
		return false;
	}
	/* @end method */
}
/* @end class */
classPG_Divs.prototype = new classPG_NodesHtmlDoubleTagBasics();
var oPGDivs = new classPG_Divs();
