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
function classPG_DropArea()
{
	// Declarations...
	this.iDefaultGridX = 0;
	this.iDefaultGridY = 0;
	this.iDefaultType = PG_DROPAREA_TYPE_SIMPLE;
	this.sDefaultGroupID = PG_DRAGANDDROP_GROUP_ALL;
	this.iDefaultMaxElements = 0;
	this.sDefaultCssStyle = '';
	this.sDefaultCssClass = '';
	
	// this.iDefaultGrabMoveDistX = -1;
	// this.iDefaultGrabMoveDistY = -1;

	// Construct...
	this.setID({'sID': 'PGDropArea'});
	this.initClassBasics();
	
	// Methods...
	/*
	@start method
	
	@param iType [needed][type]int[/type]
	[en]...[/en]
	*/
	this.setDefaultType = function(_iType)
	{
		_iType = this.getRealParameter({'oParameters': _iType, 'sName': 'iType', 'xParameter': _iType});
		this.iDefaultType = _iType;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iType [type]int[/type]
	[en]...[/en]
	*/
	this.getDefaultType = function() {return this.iDefaultType;}
	/* @end method */
	
	/*
	@start method
	
	@param iGroupID [needed][type]int[/type]
	[en]...[/en]
	*/
	this.setDefaultGroupID = function(_iGroupID)
	{
		_iGroupID = this.getRealParameter({'oParameters': _iGroupID, 'sName': 'iGroupID', 'xParameter': _iGroupID});
		this.sDefaultGroupID = _iGroupID;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sGroupID [type]string[/type]
	[en]...[/en]
	*/
	this.getDefaultGroupID = function() {return this.sDefaultGroupID;}
	/* @end method */

	/*
	@start method
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setDefaultCssStyle = function(_sStyle)
	{
		_sStyle = this.getRealParameter({'oParameters': _sStyle, 'sName': 'sStyle', 'xParameter': _sStyle});
		this.sDefaultCssStyle = _sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	this.getDefaultCssStyle = function() {return this.sDefaultCssStyle;}
	/* @end method */

	/*
	@start method
	
	@param sClass [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setDefaultCssClass = function(_sClass)
	{
		_sClass = this.getRealParameter({'oParameters': _sClass, 'sName': 'sClass', 'xParameter': _sClass});
		this.sDefaultCssClass = _sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssClass [type]string[/type]
	[en]...[/en]
	*/
	this.getDefaultCssClass = function() {return this.sDefaultCssClass;}
	/* @end method */

	/*
	@start method
	
	@param iGridX [needed][type]int[/type]
	[en]...[/en]
	*/
	this.setDefaultGridX = function(_iGridX)
	{
		_iGridX = this.getRealParameter({'oParameters': _iGridX, 'sName': 'iGridX', 'xParameter': _iGridX});
		this.iDefaultGridX = _iGridX;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iGridX [type]int[/type]
	[en]...[/en]
	*/
	this.getDefaultGridX = function() {return this.iDefaultGridX;}
	/* @end method */
	
	/*
	@start method
	
	@param iGridY [needed][type]int[/type]
	[en]...[/en]
	*/
	this.setDefaultGridY = function(_iGridY)
	{
		_iGridY = this.getRealParameter({'oParameters': _iGridY, 'sName': 'iGridY', 'xParameter': _iGridY});
		this.iDefaultGridY = _iGridY;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iGridY [type]int[/type]
	[en]...[/en]
	*/
	this.getDefaultGridY = function() {return this.iDefaultGridY;}
	/* @end method */
	
	/*
	@start method
	
	@param iGridX [type]int[/type]
	[en]...[/en]
	
	@param iGridY [type]int[/type]
	[en]...[/en]
	*/
	this.setDefaultGrid = function(_iGridX, _iGridY)
	{
		if (typeof(_iGridY) == 'undefined') {var _iGridY = null;}
	
		_iGridY = this.getRealParameter({'oParameters': _iGridX, 'sName': 'iGridY', 'xParameter': _iGridY});
		_iGridX = this.getRealParameter({'oParameters': _iGridX, 'sName': 'iGridX', 'xParameter': _iGridX});

		this.iDefaultGridX = _iGridX;
		this.iDefaultGridY = _iGridY;
	}
	/* @end method */

	/*
	@start method
	
	@param sContainerID [needed][type]string[/type]
	[en]...[/en]
	
	@param sDropAreaID [type]string[/type]
	[en]...[/en]
	
	@param sSizeX [type]string[/type]
	[en]...[/en]
	
	@param sSizeY [type]string[/type]
	[en]...[/en]
	
	@param iGridX [type]int[/type]
	[en]...[/en]
	
	@param iGridY [type]int[/type]
	[en]...[/en]
	
	@param iDropAreaType [type]int[/type]
	[en]...[/en]
	
	@param iGroupID [type]int[/type]
	[en]...[/en]
	
	@param sContent [type]string[/type]
	[en]...[/en]
	
	@param sOnDrop [type]string[/type]
	[en]...[/en]
	
	@param axData [type]mixed[][/type]
	[en]...[/en]
	
	@param iMaxDragElements [type]int[/type]
	[en]...[/en]
	
	@param sCssStyle [type]string[/type]
	[en]...[/en]
	
	@param sCssClass [type]string[/type]
	[en]...[/en]
	*/
	this.buildInto = function(
		_sContainerID, 
		_sDropAreaID, 
		_sSizeX, 
		_sSizeY, 
		_iGridX, 
		_iGridY, 
		_iDropAreaType, 
		_iGroupID, 
		_sContent, 
		_sOnDrop, 
		_axData, 
		_iMaxDragElements, 
		_sCssStyle, 
		_sCssClass
	)
	{
		if (typeof(_sDropAreaID) == 'undefined') {var _sDropAreaID = null;}
		if (typeof(_sSizeX) == 'undefined') {var _sSizeX = null;}
		if (typeof(_sSizeY) == 'undefined') {var _sSizeY = null;}
		if (typeof(_iGridX) == 'undefined') {var _iGridX = null;}
		if (typeof(_iGridY) == 'undefined') {var _iGridY = null;}
		if (typeof(_iDropAreaType) == 'undefined') {var _iDropAreaType = null;}
		if (typeof(_iGroupID) == 'undefined') {var _iGroupID = null;}
		if (typeof(_sContent) == 'undefined') {var _sContent = null;}
		if (typeof(_sOnDrop) == 'undefined') {var _sOnDrop = null;}
		if (typeof(_axData) == 'undefined') {var _axData = null;}
		if (typeof(_iMaxDragElements) == 'undefined') {var _iMaxDragElements = null;}
		if (typeof(_sCssStyle) == 'undefined') {var _sCssStyle = null;}
		if (typeof(_sCssClass) == 'undefined') {var _sCssClass = null;}

		_sDropAreaID = this.getRealParameter({'oParameters': _sContainerID, 'sName': 'sDropAreaID', 'xParameter': _sDropAreaID});
		_sSizeX = this.getRealParameter({'oParameters': _sContainerID, 'sName': 'sSizeX', 'xParameter': _sSizeX});
		_sSizeY = this.getRealParameter({'oParameters': _sContainerID, 'sName': 'sSizeY', 'xParameter': _sSizeY});
		_iGridX = this.getRealParameter({'oParameters': _sContainerID, 'sName': 'iGridX', 'xParameter': _iGridX});
		_iGridY = this.getRealParameter({'oParameters': _sContainerID, 'sName': 'iGridY', 'xParameter': _iGridY});
		_iDropAreaType = this.getRealParameter({'oParameters': _sContainerID, 'sName': 'iDropAreaType', 'xParameter': _iDropAreaType});
		_iGroupID = this.getRealParameter({'oParameters': _sContainerID, 'sName': 'iGroupID', 'xParameter': _iGroupID});
		_sContent = this.getRealParameter({'oParameters': _sContainerID, 'sName': 'sContent', 'xParameter': _sContent});
		_sOnDrop = this.getRealParameter({'oParameters': _sContainerID, 'sName': 'sOnDrop', 'xParameter': _sOnDrop});
		_axData = this.getRealParameter({'oParameters': _sContainerID, 'sName': 'axData', 'xParameter': _axData});
		_iMaxDragElements = this.getRealParameter({'oParameters': _sContainerID, 'sName': 'iMaxDragElements', 'xParameter': _iMaxDragElements});
		_sCssStyle = this.getRealParameter({'oParameters': _sContainerID, 'sName': 'sCssStyle', 'xParameter': _sCssStyle});
		_sCssClass = this.getRealParameter({'oParameters': _sContainerID, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		_sContainerID = this.getRealParameter({'oParameters': _sContainerID, 'sName': 'sContainerID', 'xParameter': _sContainerID});
		
		var _sHtml = this.build(
			{
				'sDropAreaID': _sDropAreaID, 
				'sSizeX': _sSizeX, 'sSizeY': _sSizeY, 
				'iGridX': _iGridX, 'iGridY': _iGridY, 
				'iDropAreaType': _iDropAreaType, 
				'iGroupID': _iGroupID, 
				'sContent': _sContent, 
				'sOnDrop': _sOnDrop, 
				'axData': _axData, 
				'iMaxDragElements': _iMaxDragElements, 
				'sCssStyle': _sCssStyle, 'sCssClass': _sCssClass
			}
		);
		if (_sContainerID != null)
		{
			var _oContainer = this.oDocument.getElementById(_sContainerID);
			if (_oContainer) {_oContainer.innerHTML += _sHtml;}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@return sDropAreaHtml [type]string[/type]
	[en]...[/en]
	
	@param sDropAreaID [type]string[/type]
	[en]...[/en]
	
	@param sSizeX [type]string[/type]
	[en]...[/en]
	
	@param sSizeY [type]string[/type]
	[en]...[/en]
	
	@param iGridX [type]int[/type]
	[en]...[/en]
	
	@param iGridY [type]int[/type]
	[en]...[/en]
	
	@param iDropAreaType [type]int[/type]
	[en]...[/en]
	
	@param iGroupID [type]int[/type]
	[en]...[/en]
	
	@param sContent [type]string[/type]
	[en]...[/en]
	
	@param sOnDrop [type]string[/type]
	[en]...[/en]
	
	@param axData [type]mixed[][/type]
	[en]...[/en]
	
	@param iMaxDragElements [type]int[/type]
	[en]...[/en]
	
	@param sCssStyle [type]string[/type]
	[en]...[/en]
	
	@param sCssClass [type]string[/type]
	[en]...[/en]
	*/
	this.build = function(
		_sDropAreaID, 
		_sSizeX, 
		_sSizeY, 
		_iGridX, 
		_iGridY, 
		_iDropAreaType, 
		_iGroupID, 
		_sContent, 
		_sOnDrop, 
		_axData, 
		_iMaxDragElements, 
		_sCssStyle, 
		_sCssClass
	)
	{
		if (typeof(_sSizeX) == 'undefined') {var _sSizeX = null;}
		if (typeof(_sSizeY) == 'undefined') {var _sSizeY = null;}
		if (typeof(_iGridX) == 'undefined') {var _iGridX = null;}
		if (typeof(_iGridY) == 'undefined') {var _iGridY = null;}
		if (typeof(_iDropAreaType) == 'undefined') {var _iDropAreaType = null;}
		if (typeof(_iGroupID) == 'undefined') {var _iGroupID = null;}
		if (typeof(_sContent) == 'undefined') {var _sContent = null;}
		if (typeof(_sOnDrop) == 'undefined') {var _sOnDrop = null;}
		if (typeof(_axData) == 'undefined') {var _axData = null;}
		if (typeof(_iMaxDragElements) == 'undefined') {var _iMaxDragElements = null;}
		if (typeof(_sCssStyle) == 'undefined') {var _sCssStyle = null;}
		if (typeof(_sCssClass) == 'undefined') {var _sCssClass = null;}

		_sSizeX = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'sSizeX', 'xParameter': _sSizeX});
		_sSizeY = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'sSizeY', 'xParameter': _sSizeY});
		_iGridX = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'iGridX', 'xParameter': _iGridX});
		_iGridY = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'iGridY', 'xParameter': _iGridY});
		_iDropAreaType = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'iDropAreaType', 'xParameter': _iDropAreaType});
		_iGroupID = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'iGroupID', 'xParameter': _iGroupID});
		_sContent = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'sContent', 'xParameter': _sContent});
		_sOnDrop = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'sOnDrop', 'xParameter': _sOnDrop});
		_axData = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'axData', 'xParameter': _axData});
		_iMaxDragElements = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'iMaxDragElements', 'xParameter': _iMaxDragElements});
		_sCssStyle = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'sCssStyle', 'xParameter': _sCssStyle});
		_sCssClass = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		_sDropAreaID = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'sDropAreaID', 'xParameter': _sDropAreaID});
		
		if (_iGridX == null) {_iGridX = this.iDefaultGridX;}
		if (_iGridY == null) {_iGridY = this.iDefaultGridY;}
		if (_iGroupID == null) {_iGroupID = this.sDefaultGroupID;}
		if (_iDropAreaType == null) {_iDropAreaType = this.iDefaultType;}
		if (_iMaxDragElements == null) {_iMaxDragElements = this.iDefaultMaxElements;}
		if (_sCssStyle == null) {_sCssStyle = this.sDefaultCssStyle;}
		if (_sCssClass == null) {_sCssClass = this.sDefaultCssClass;}
		
		var _sHtml = '';
		/*
		_sHtml += '<div id="'+_sDropAreaID+'" style="position:relative; width:'+_sSizeX+'; height:'+_sSizeY+'; overflow:hidden; top:0px; left:0px; ';
		if (this.isDebugMode(PG_DEBUG_HIGH)) {_sHtml += 'border:solid 1px #ff0000; ';}
		if ((_sCssStyle != null) && (_sCssStyle != '')) {_sHtml += _sCssStyle+' ';}
		_sHtml += '" ';
		if ((_sCssClass != null) && (_sCssClass != '')) {_sHtml += 'class="'+_sCssClass+'" ';}
		_sHtml += '>';
		if (_sContent != null) {_sHtml += _sContent;}
		_sHtml += '</div>';
		*/
		
		if (this.isDebugMode(PG_DEBUG_HIGH)) {_sCssStyle += ' border:solid 1px red;';}
		
		_sHtml += oPGDivs.build(
			{
				'sDivID': _sDropAreaID, 
				'sContent': _sContent, 
				'xSizeX': _sSizeX, 
				'xSizeY': _sSizeY, 
				'sOverflow': 'hidden', 
				'xPosX': '0px', 
				'xPosY': '0px', 
				'sPosition': 'relative',
				'sCssClass': _sCssClass, 
				'sCssStyle': _sCssStyle, 
				'bReturnHtml': true
			}
		);
		
		oPGDragAndDrop.registerDropArea(
			{
				'sDropAreaID': _sDropAreaID, 
				'iGridX': _iGridX, 'iGridY': _iGridY, 
				'iDropAreaType': _iDropAreaType, 
				'iGroupID': _iGroupID, 
				'sOnDrop': _sOnDrop, 
				'axData': _axData, 
				'iMaxDragElements': _iMaxDragElements
			}
		);
		
		return _sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sDropAreaID [needed][type]string[/type]
	[en]...[/en]
	
	@param sContent [needed][type]string[/type]
	[en]...[/en]
	*/
	this.addContent = function(_sDropAreaID, _sContent)
	{
		if (typeof(_sContent) == 'undefined') {var _sContent = null;}
		_sContent = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'sContent', 'xParameter': _sContent});
		_sDropAreaID = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'sDropAreaID', 'xParameter': _sDropAreaID});
		var _oDropArea = this.oDocument.getElementById(_sDropAreaID);
		if (_oDropArea) {_oDropArea.innerHTML += _sContent;}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sDropAreaID [needed][type]string[/type]
	[en]...[/en]
	
	@param sContent [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setContent = function(_sDropAreaID, _sContent)
	{
		if (typeof(_sContent) == 'undefined') {var _sContent = null;}
		_sContent = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'sContent', 'xParameter': _sContent});
		_sDropAreaID = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'sDropAreaID', 'xParameter': _sDropAreaID});
		var _oDropArea = this.oDocument.getElementById(_sDropAreaID);
		if (_oDropArea) {_oDropArea.innerHTML = _sContent;}
	}
	/* @end method */
}
/* @end class */
classPG_DropArea.prototype = new classPG_ClassBasics();
var oPGDropArea = new classPG_DropArea();
