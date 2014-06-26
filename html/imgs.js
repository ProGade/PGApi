/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 22 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_Imgs()
{
	// Declarations...
	this.oDocument = document;
	
	// Construct...
	
	// Methods...
	/*
	@start method
	
	@return oImg [type]object[/type]
	[en]...[/en]
	
	@param sImgID [type]string[/type]
	[en]...[/en]
	
	@param sSource [type]string[/type]
	[en]...[/en]
	
	@param xSizeX [type]mixed[/type]
	[en]...[/en]
	
	@param xSizeY [type]mixed[/type]
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
	this.build = function(_sImgID, _sSource, _xSizeX, _xSizeY, _xPosX, _xPosY, _sPosition, _sCssClass, _sCssStyle)
	{
		if (typeof(_sImgID) == 'undefined') {var _sImgID = null;}
		if (typeof(_sSource) == 'undefined') {var _sSource = null;}
		if (typeof(_xSizeX) == 'undefined') {var _xSizeX = null;}
		if (typeof(_xSizeY) == 'undefined') {var _xSizeY = null;}
		if (typeof(_xPosX) == 'undefined') {var _xPosX = null;}
		if (typeof(_xPosY) == 'undefined') {var _xPosY = null;}
		if (typeof(_sPosition) == 'undefined') {var _sPosition = null;}
		if (typeof(_sCssClass) == 'undefined') {var _sCssClass = null;}
		if (typeof(_sCssStyle) == 'undefined') {var _sCssStyle = null;}
		
		_sSource = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sSource', 'xParameter': _sSource});
		_xSizeX = this.getRealParameter({'oParameters': _sImgID, 'sName': 'xSizeX', 'xParameter': _xSizeX});
		_xSizeY = this.getRealParameter({'oParameters': _sImgID, 'sName': 'xSizeY', 'xParameter': _xSizeY});
		_xPosX = this.getRealParameter({'oParameters': _sImgID, 'sName': 'xPosX', 'xParameter': _xPosX});
		_xPosY = this.getRealParameter({'oParameters': _sImgID, 'sName': 'xPosY', 'xParameter': _xPosY});
		_sPosition = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sPosition', 'xParameter': _sPosition});
		_sCssClass = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		_sCssStyle = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sCssStyle', 'xParameter': _sCssStyle});
		_sImgID = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sImgID', 'xParameter': _sImgID});

		if (typeof(oPGVars) != 'undefined')
		{
			_xPosX = oPGVars.cssNumber({'xVar': _xPosX});
			_xPosY = oPGVars.cssNumber({'xVar': _xPosY});
			_xSizeX = oPGVars.cssNumber({'xVar': _xSizeX});
			_xSizeY = oPGVars.cssNumber({'xVar': _xSizeY});
		}
		
		var _oImg = this.oDocument.createElement('img');
		if ((_sImgID != null) && (_sImgID != '')) {_oImg.id = _sImgID;}
		if ((_sSource != null) && (_sSource != '')) {_oImg.src = _sSource;}
		if ((_sCssStyle != null) && (_sCssStyle != '') && (typeof(oPGCss) != 'undefined')) {oPGCss.setStyle(_oImg, _sCssStyle);}
		if ((_xSizeX != null) && (_xSizeX != '')) {_oImg.style.width = _xSizeX;}
		if ((_xSizeY != null) && (_xSizeY != '')) {_oImg.style.height = _xSizeY;}
		if ((_xPosX != null) && (_xPosX != '')) {_oImg.style.left = _xPosX;}
		if ((_xPosY != null) && (_xPosY != '')) {_oImg.style.top = _xPosY;}
		if ((_sPosition != null) && (_sPosition != '')) {_oImg.style.position = _sPosition;}
		if ((_sCssClass != null) && (_sCssClass != '')) {_oImg.className = _sCssClass;}
		return _oImg;
	}
	/* @end method */
	this.buildNodeObject = this.build;
	this.buildImageObject = this.build;
	this.buildImgObject = this.build;

	/*
	@start method
	
	@return sImg [type]string[/type]
	[en]...[/en]
	
	@param sImgID [type]string[/type]
	[en]...[/en]
	
	@param sSource [type]string[/type]
	[en]...[/en]
	
	@param xSizeX [type]mixed[/type]
	[en]...[/en]
	
	@param xSizeY [type]mixed[/type]
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
	this.buildHTMLString = function(_sImgID, _sSource, _xSizeX, _xSizeY, _xPosX, _xPosY, _sPosition, _sCssClass, _sCssStyle)
	{
		if (typeof(_sImgID) == 'undefined') {var _sImgID = null;}
		if (typeof(_sSource) == 'undefined') {var _sSource = null;}
		if (typeof(_xSizeX) == 'undefined') {var _xSizeX = null;}
		if (typeof(_xSizeY) == 'undefined') {var _xSizeY = null;}
		if (typeof(_sOverflow) == 'undefined') {var _sOverflow = null;}
		if (typeof(_xPosX) == 'undefined') {var _xPosX = null;}
		if (typeof(_xPosY) == 'undefined') {var _xPosY = null;}
		if (typeof(_sPosition) == 'undefined') {var _sPosition = null;}
		if (typeof(_sCssClass) == 'undefined') {var _sCssClass = null;}
		if (typeof(_sCssStyle) == 'undefined') {var _sCssStyle = null;}
		
		_sSource = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sSource', 'xParameter': _sSource});
		_xSizeX = this.getRealParameter({'oParameters': _sImgID, 'sName': 'xSizeX', 'xParameter': _xSizeX});
		_xSizeY = this.getRealParameter({'oParameters': _sImgID, 'sName': 'xSizeY', 'xParameter': _xSizeY});
		_xPosX = this.getRealParameter({'oParameters': _sImgID, 'sName': 'xPosX', 'xParameter': _xPosX});
		_xPosY = this.getRealParameter({'oParameters': _sImgID, 'sName': 'xPosY', 'xParameter': _xPosY});
		_sPosition = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sPosition', 'xParameter': _sPosition});
		_sCssClass = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		_sCssStyle = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sCssStyle', 'xParameter': _sCssStyle});
		_sImgID = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sImgID', 'xParameter': _sImgID});
		
		if (typeof(oPGVars) != 'undefined')
		{
			_xPosX = oPGVars.cssNumber({'xVar': _xPosX});
			_xPosY = oPGVars.cssNumber({'xVar': _xPosY});
			_xSizeX = oPGVars.cssNumber({'xVar': _xSizeX});
			_xSizeY = oPGVars.cssNumber({'xVar': _xSizeY});
		}
		
		var _sHTML = '';
		_sHTML += '<img';
		if ((_sImgID != null) && (_sImgID != '')) {_sHTML += ' id="'+_sImgID+'"';}
		if ((_sSource != null) && (_sSource != '')) {_sHTML += ' src="'+_sSource+'"';}
		if
		(
			((_xSizeX != null) && (_xSizeX != ''))
			|| ((_xSizeY != null) && (_xSizeY != ''))
			|| ((_xPosX != null) && (_xPosX != ''))
			|| ((_xPosY != null) && (_xPosY != ''))
			|| ((_sPosition != null) && (_sPosition != ''))
			|| ((_sCssStyle != null) && (_sCssStyle != ''))
		)
		{
			_sHTML += ' style="';
			if ((_sSizeX != null) && (_sSizeX != '')) {_sHTML += 'width:'+_sSizeX+'; ';}
			if ((_sSizeY != null) && (_sSizeY != '')) {_sHTML += 'height:'+_sSizeY+'; ';}
			if ((_sPosX != null) && (_sPosX != '')) {_sHTML += 'left:'+_sPosX+'; ';}
			if ((_sPosY != null) && (_sPosY != '')) {_sHTML += 'top:'+_sPosY+'; ';}
			if ((_sPosition != null) && (_sPosition != '')) {_sHTML += 'position:'+_sPosition+'; ';}
			if ((_sCssStyle != null) && (_sCssStyle != '')) {_sHTML += _sCssStyle;}
			_sHTML += '"';
		}
		
		if ((_sCssClass != null) && (_sCssClass != '')) {_sHTML += ' class="'+_sCssClass+'"';}
		_sHTML += ' />';
		return _sHTML;
	}
	/* @end method */
	this.buildImageString = this.buildHTMLString;
	this.buildImgString = this.buildHTMLString;
		
	/*
	@start method
	
	@return oImg [type]object[/type]
	[en]...[/en]
	
	@param xIntoParent [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sImgID [type]string[/type]
	[en]...[/en]
	
	@param sSource [type]string[/type]
	[en]...[/en]
	
	@param xSizeX [type]mixed[/type]
	[en]...[/en]
	
	@param xSizeY [type]mixed[/type]
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
	this.buildInto = function(_xIntoParent, _sImgID, _sSource, _xSizeX, _xSizeY, _xPosX, _xPosY, _sPosition, _sCssClass, _sCssStyle)
	{
		if (typeof(_sImgID) == 'undefined') {var _sImgID = null;}
		if (typeof(_sSource) == 'undefined') {var _sSource = null;}
		if (typeof(_xSizeX) == 'undefined') {var _xSizeX = null;}
		if (typeof(_xSizeY) == 'undefined') {var _xSizeY = null;}
		if (typeof(_xPosX) == 'undefined') {var _xPosX = null;}
		if (typeof(_xPosY) == 'undefined') {var _xPosY = null;}
		if (typeof(_sPosition) == 'undefined') {var _sPosition = null;}
		if (typeof(_sCssClass) == 'undefined') {var _sCssClass = null;}
		if (typeof(_sCssStyle) == 'undefined') {var _sCssStyle = null;}
		
		_sSource = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sSource', 'xParameter': _sSource});
		_xSizeX = this.getRealParameter({'oParameters': _sImgID, 'sName': 'xSizeX', 'xParameter': _xSizeX});
		_xSizeY = this.getRealParameter({'oParameters': _sImgID, 'sName': 'xSizeY', 'xParameter': _xSizeY});
		_xPosX = this.getRealParameter({'oParameters': _sImgID, 'sName': 'xPosX', 'xParameter': _xPosX});
		_xPosY = this.getRealParameter({'oParameters': _sImgID, 'sName': 'xPosY', 'xParameter': _xPosY});
		_sPosition = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sPosition', 'xParameter': _sPosition});
		_sCssClass = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		_sCssStyle = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sCssStyle', 'xParameter': _sCssStyle});
		_sImgID = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sImgID', 'xParameter': _sImgID});

		var _oImg = this.build(
			{
				'sImgID': _sImgID, 
				'sSource': _sSource, 
				'xSizeX': _xSizeX, 
				'xSizeY': _xSizeY, 
				'xPosX': _xPosX, 
				'xPosY': _xPosY, 
				'sPosition': _sPosition, 
				'sCssClass': _sCssClass, 
				'sCssStyle': _sCssStyle
			}
		);
		if (_oImg) {return oPGNodes.insertInto({'xIntoParent': _xIntoParent, 'xInsertElement': _oImg});}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return oImg [type]object[/type]
	[en]...[/en]
	
	@param xIntoParent [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xBeforeChild [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sImgID [type]string[/type]
	[en]...[/en]
	
	@param sSource [type]string[/type]
	[en]...[/en]
	
	@param xSizeX [type]mixed[/type]
	[en]...[/en]
	
	@param xSizeY [type]mixed[/type]
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
	this.buildBefore = function(_xIntoParent, _xBeforeChild, _sImgID, _sSource, _xSizeX, _xSizeY, _xPosX, _xPosY, _sPosition, _sCssClass, _sCssStyle)
	{
		if (typeof(_sImgID) == 'undefined') {var _sImgID = null;}
		if (typeof(_sSource) == 'undefined') {var _sSource = null;}
		if (typeof(_xSizeX) == 'undefined') {var _xSizeX = null;}
		if (typeof(_xSizeY) == 'undefined') {var _xSizeY = null;}
		if (typeof(_xPosX) == 'undefined') {var _xPosX = null;}
		if (typeof(_xPosY) == 'undefined') {var _xPosY = null;}
		if (typeof(_sPosition) == 'undefined') {var _sPosition = null;}
		if (typeof(_sCssClass) == 'undefined') {var _sCssClass = null;}
		if (typeof(_sCssStyle) == 'undefined') {var _sCssStyle = null;}
		
		_sSource = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sSource', 'xParameter': _sSource});
		_xSizeX = this.getRealParameter({'oParameters': _sImgID, 'sName': 'xSizeX', 'xParameter': _xSizeX});
		_xSizeY = this.getRealParameter({'oParameters': _sImgID, 'sName': 'xSizeY', 'xParameter': _xSizeY});
		_xPosX = this.getRealParameter({'oParameters': _sImgID, 'sName': 'xPosX', 'xParameter': _xPosX});
		_xPosY = this.getRealParameter({'oParameters': _sImgID, 'sName': 'xPosY', 'xParameter': _xPosY});
		_sPosition = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sPosition', 'xParameter': _sPosition});
		_sCssClass = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		_sCssStyle = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sCssStyle', 'xParameter': _sCssStyle});
		_sImgID = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sImgID', 'xParameter': _sImgID});

		var _oImg = this.build(
			{
				'sImgID': _sImgID, 
				'sSource': _sSource, 
				'xSizeX': _xSizeX, 
				'xSizeY': _xSizeY, 
				'xPosX': _xPosX, 
				'xPosY': _xPosY, 
				'sPosition': _sPosition, 
				'sCssClass': _sCssClass, 
				'sCssStyle': _sCssStyle
			}
		);
		if (_oImg) {return oPGNodes.insertBefore({'xIntoParent': _xIntoParent, 'xBeforeChild': _xBeforeChild, 'xInsertElement': _oImg});}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return oImg [type]object[/type]
	[en]...[/en]
	
	@param xIntoParent [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xAfterChild [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sImgID [type]string[/type]
	[en]...[/en]
	
	@param sSource [type]string[/type]
	[en]...[/en]
	
	@param xSizeX [type]mixed[/type]
	[en]...[/en]
	
	@param xSizeY [type]mixed[/type]
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
	this.buildAfter = function(_xIntoParent, _xAfterChild, _sImgID, _sSource, _xSizeX, _xSizeY, _xPosX, _xPosY, _sPosition, _sCssClass, _sCssStyle)
	{
		if (typeof(_sImgID) == 'undefined') {var _sImgID = null;}
		if (typeof(_sSource) == 'undefined') {var _sSource = null;}
		if (typeof(_xSizeX) == 'undefined') {var _xSizeX = null;}
		if (typeof(_xSizeY) == 'undefined') {var _xSizeY = null;}
		if (typeof(_xPosX) == 'undefined') {var _xPosX = null;}
		if (typeof(_xPosY) == 'undefined') {var _xPosY = null;}
		if (typeof(_sPosition) == 'undefined') {var _sPosition = null;}
		if (typeof(_sCssClass) == 'undefined') {var _sCssClass = null;}
		if (typeof(_sCssStyle) == 'undefined') {var _sCssStyle = null;}
		
		_sSource = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sSource', 'xParameter': _sSource});
		_xSizeX = this.getRealParameter({'oParameters': _sImgID, 'sName': 'xSizeX', 'xParameter': _xSizeX});
		_xSizeY = this.getRealParameter({'oParameters': _sImgID, 'sName': 'xSizeY', 'xParameter': _xSizeY});
		_xPosX = this.getRealParameter({'oParameters': _sImgID, 'sName': 'xPosX', 'xParameter': _xPosX});
		_xPosY = this.getRealParameter({'oParameters': _sImgID, 'sName': 'xPosY', 'xParameter': _xPosY});
		_sPosition = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sPosition', 'xParameter': _sPosition});
		_sCssClass = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		_sCssStyle = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sCssStyle', 'xParameter': _sCssStyle});
		_sImgID = this.getRealParameter({'oParameters': _sImgID, 'sName': 'sImgID', 'xParameter': _sImgID});

		var _oImg = this.build(
			{
				'sImgID': _sImgID, 
				'sSource': _sSource, 
				'xSizeX': _xSizeX, 
				'xSizeY': _xSizeY, 
				'xPosX': _xPosX, 
				'xPosY': _xPosY, 
				'sPosition': _sPosition, 
				'sCssClass': _sCssClass, 
				'sCssStyle': _sCssStyle
			}
		);
		if (_oImg) {return oPGNodes.insertAfter({'xIntoParent': _xIntoParent, 'xAfterChild': _xAfterChild, 'xInsertElement': _oImg});}
		return false;
	}
	/* @end method */
}
/* @end class */
classPG_Imgs.prototype = new classPG_NodesHtmlSingleTagBasics;
var oPGImgs = new classPG_Imgs();
