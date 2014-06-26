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
function classPG_DragElement()
{
	// Declarations...
	this.iDefaultType = PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSELEFTHOLD;
	this.sDefaultGroupID = PG_DRAGANDDROP_GROUP_ALL;
	this.iDefaultCopyMode = PG_DRAGANDDROP_ELEMENTCOPYMODE_NOCOPY;
	this.iDefaultKillMode = PG_DRAGANDDROP_ELEMENTKILLMODE_NOKILL;
	
	// this.iDefaultGrabMoveDistX = -1;
	// this.iDefaultGrabMoveDistY = -1;

	// Construct...
	this.setID({'sID': 'PGDragElement'});
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
	
	@param iMode [needed][type]int[/type]
	[en]...[/en]
	*/
	this.setDefaultCopyMode = function(_iMode)
	{
		_iMode = this.getRealParameter({'oParameters': _iMode, 'sName': 'iMode', 'xParameter': _iMode});
		this.iDefaultCopyMode = _iMode;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iCopyMode [type]int[/type]
	[en]...[/en]
	*/
	this.getDefaultCopyMode = function() {return this.iDefaultCopyMode;}
	/* @end method */

	/*
	@start method
	
	@param iMode [needed][type]int[/type]
	[en]...[/en]
	*/
	this.setDefaultKillMode = function(_iMode)
	{
		_iMode = this.getRealParameter({'oParameters': _iMode, 'sName': 'iMode', 'xParameter': _iMode});
		this.iDefaultKillMode = _iMode;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iKillMode [type]int[/type]
	[en]...[/en]
	*/
	this.getDefaultKillMode = function() {return this.iDefaultKillMode;}
	/* @end method */

	/*
	@start method
	
	@return sDragElementHtml [type]string[/type]
	[en]...[/en]
	
	@param xDropArea [type]mixed[/type]
	[en]...[/en]
	
	@param sDragElementID [type]string[/type]
	[en]...[/en]
	
	@param iPosX [type]int[/type]
	[en]...[/en]
	
	@param iPosY [type]int[/type]
	[en]...[/en]
	
	@param iSizeX [type]int[/type]
	[en]...[/en]
	
	@param iSizeY [type]int[/type]
	[en]...[/en]
	
	@param sContent [type]string[/type]
	[en]...[/en]
	
	@param iDragElementType [type]int[/type]
	[en]...[/en]
	
	@param iGroupID [type]int[/type]
	[en]...[/en]
	
	@param iMouseOffsetDist [type]int[/type]
	[en]...[/en]
	
	@param iElementKillMode [type]int[/type]
	[en]...[/en]
	
	@param iElementCopyMode [type]int[/type]
	[en]...[/en]
	
	@param axData [type]mixed[][/type]
	[en]...[/en]
	
	*/
	this.buildDragElement = function(
		_xDropArea, 
		_sDragElementID, 
		_iPosX, 
		_iPosY, 
		_iSizeX, 
		_iSizeY, 
		_sContent, 
		_iDragElementType, 
		_iGroupID, 
		_iMouseOffsetDist, 
		_iElementKillMode, 
		_iElementCopyMode, 
		_axData
	)
	{
		if (typeof(_sDragElementID) == 'undefined') {var _sDragElementID = null;}
		if (typeof(_iPosX) == 'undefined') {var _iPosX = null;}
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = null;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}
		if (typeof(_sContent) == 'undefined') {var _sContent = null;}
		if (typeof(_iDragElementType) == 'undefined') {var _iDragElementType = null;}
		if (typeof(_iGroupID) == 'undefined') {var _iGroupID = null;}
		if (typeof(_iMouseOffsetDist) == 'undefined') {var _iMouseOffsetDist = null;}
		if (typeof(_iElementKillMode) == 'undefined') {var _iElementKillMode = null;}
		if (typeof(_iElementCopyMode) == 'undefined') {var _iElementCopyMode = null;}
		if (typeof(_axData) == 'undefined') {var _axData = null;}

		_sDragElementID = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'sDragElementID', 'xParameter': _sDragElementID});
		_iPosX = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'iPosX', 'xParameter': _iPosX});
		_iPosY = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'iPosY', 'xParameter': _iPosY});
		_iSizeX = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		_iSizeY = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_sContent = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'sContent', 'xParameter': _sContent});
		_iDragElementType = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'iDragElementType', 'xParameter': _iDragElementType});
		_iGroupID = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'iGroupID', 'xParameter': _iGroupID});
		_iMouseOffsetDist = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'iMouseOffsetDist', 'xParameter': _iMouseOffsetDist});
		_iElementKillMode = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'iElementKillMode', 'xParameter': _iElementKillMode});
		_iElementCopyMode = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'iElementCopyMode', 'xParameter': _iElementCopyMode});
		_axData = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'axData', 'xParameter': _axData});
		_xDropArea = this.getRealParameter({'oParameters': _xDropArea, 'sName': 'xDropArea', 'xParameter': _xDropArea});
		
		var _iDropAreaIndex = -1;
		var _sDropAreaID = '';
		if (_xDropArea != null)
		{
			_iDropAreaIndex = this.getDropAreaIndex({'xDropArea': _xDropArea});
			if ((_iDropAreaIndex > -1) && (_iDropAreaIndex < this.axDropAreas.length))
			{
				_sDropAreaID = this.axDropAreas[_iDropAreaIndex][PG_DRAGANDDROP_DROPAREA_INDEX_ID];
			}
			else {_sDropAreaID = _xDropArea;}
		}
		
		if (_iPosX == null) {_iPosX = 0;}
		if (_iPosY == null) {_iPosY = 0;}
		if (_sDropAreaID == null) {_sDropAreaID = '';}
		if (_iGroupID == null) {_iGroupID = this.sDefaultGroupID;}
		if (_iDragElementType == null) {_iDragElementType = this.iDefaultType;}
		if (_iMouseOffsetDist == null) {_iMouseOffsetDist = PG_DRAGANDDROP_MOUSEOFFSETDIST_EXACT_POSITION;}
		if (_iElementCopyMode == null) {_iElementCopyMode = this.iDefaultCopyMode;}
		if (_iElementKillMode == null) {_iElementKillMode = this.iDefaultKillMode;}
		
		var _sHtml = '';
		_sHtml += '<div id="'+_sDragElementID+'" ';
		_sHtml += 'onmousedown="oPGDragAndDrop.onDragElementMouseDown(event, {\'sDragElementID\': \''+_sDragElementID+'\'});" ';
		_sHtml += 'onclick="oPGDragAndDrop.onDragElementClick({\'sDragElementID\': \''+_sDragElementID+'\'});" ';
		_sHtml += 'style="';
		if (this.isDebugMode({'iMode': PG_DEBUG_HIGH})) {_sHtml += 'border:solid 1px #00ff00; ';}
		if (_sDropAreaID != '')
		{
			if ((_iDropAreaIndex > -1) && (_iDropAreaIndex < this.axDropAreas.length))
			{
				var _iDropAreaType = this.axDropAreas[_iDropAreaIndex][PG_DRAGANDDROP_DROPAREA_INDEX_TYPE];
				
				if (_iDropAreaType == PG_DRAGANDDROP_AREATYPE_SIMPLE) {_sHtml += 'position:absolute; ';}
				else {_sHtml += 'position:static; ';}
				
				if (_iDropAreaType == PG_DRAGANDDROP_AREATYPE_HORIZONTAL_LIST) {_sHtml += 'float:left; ';}
				else {_sHtml += 'float:none; ';}
			}
		}
		else {_sHtml += 'position:absolute; ';}
		if (_iSizeX != null) {_sHtml += 'width:'+_iSizeX+'px; ';}
		if (_iSizeY != null) {_sHtml += 'height:'+_iSizeY+'px; ';}
		_sHtml += 'left:'+_iPosX+'px; top:'+_iPosY+'px;">';
		if (_sContent != null) {_sHtml += _sContent;}
		_sHtml += '</div>';
		
		if ((_sDropAreaID != null) && (_sDropAreaID != ''))
		{
			var _oDropArea = this.oDocument.getElementById(_sDropAreaID);
			if (_oDropArea) {_oDropArea.innerHTML += _sHtml;}
		}

		oPGDragAndDrop.registerDragElement(
			{
				'sDragElementID': _sDragElementID,
				'iDragElementType': _iDragElementType, 
				'iGroupID': _iGroupID, 
				'sDropAreaID': _sDropAreaID, 
				'iMouseOffsetDist': _iMouseOffsetDist, 
				'iElementKillMode': _iElementKillMode, 
				'iElementCopyMode': _iElementCopyMode, 
				'axData': _axData
			}
		);
		
		return _sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sDragElementHtml [type]string[/type]
	[en]...[/en]
	
	@param xDropArea [type]mixed[/type]
	[en]...[/en]
	
	@param sDragElementID [type]string[/type]
	[en]...[/en]
	
	@param iPosX [type]int[/type]
	[en]...[/en]
	
	@param iPosY [type]int[/type]
	[en]...[/en]
	
	@param iSizeX [type]int[/type]
	[en]...[/en]
	
	@param iSizeY [type]int[/type]
	[en]...[/en]
	
	@param sContent [type]string[/type]
	[en]...[/en]
	
	@param iDragElementType [type]int[/type]
	[en]...[/en]
	
	@param iGroupID [type]int[/type]
	[en]...[/en]
	
	@param iMouseOffsetDist [type]int[/type]
	[en]...[/en]
	
	@param iElementKillMode [type]int[/type]
	[en]...[/en]
	
	@param iElementCopyMode [type]int[/type]
	[en]...[/en]
	
	@param axData [type]mixed[][/type]
	[en]...[/en]
	
	*/
	this.buildUserDefinedDragElement = function(
		_xDropArea, 
		_sDragElementID, 
		_iPosX, 
		_iPosY, 
		_iSizeX, 
		_iSizeY, 
		_sContent, 
		_iDragElementType, 
		_iGroupID, 
		_iMouseOffsetDist, 
		_iElementKillMode, 
		_iElementCopyMode, 
		_axData
	)
	{
		if (typeof(_sDragElementID) == 'undefined') {var _sDragElementID = null;}
		if (typeof(_iPosX) == 'undefined') {var _iPosX = null;}
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = null;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}
		if (typeof(_sContent) == 'undefined') {var _sContent = null;}
		if (typeof(_iDragElementType) == 'undefined') {var _iDragElementType = null;}
		if (typeof(_iGroupID) == 'undefined') {var _iGroupID = null;}
		if (typeof(_iMouseOffsetDist) == 'undefined') {var _iMouseOffsetDist = null;}
		if (typeof(_iElementKillMode) == 'undefined') {var _iElementKillMode = null;}
		if (typeof(_iElementCopyMode) == 'undefined') {var _iElementCopyMode = null;}
		if (typeof(_axData) == 'undefined') {var _axData = null;}

		_sDragElementID = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'sDragElementID', 'xParameter': _sDragElementID});
		_iPosX = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'iPosX', 'xParameter': _iPosX});
		_iPosY = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'iPosY', 'xParameter': _iPosY});
		_iSizeX = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		_iSizeY = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_sContent = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'sContent', 'xParameter': _sContent});
		_iDragElementType = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'iDragElementType', 'xParameter': _iDragElementType});
		_iGroupID = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'iGroupID', 'xParameter': _iGroupID});
		_iMouseOffsetDist = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'iMouseOffsetDist', 'xParameter': _iMouseOffsetDist});
		_iElementKillMode = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'iElementKillMode', 'xParameter': _iElementKillMode});
		_iElementCopyMode = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'iElementCopyMode', 'xParameter': _iElementCopyMode});
		_axData = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'axData', 'xParameter': _axData});
		_xDropArea = this.getRealParameter({'oParameters': _xDropArea, 'sName': 'xDropArea', 'xParameter': _xDropArea});
		
		var _iDropAreaIndex = -1;
		var _sDropAreaID = '';
		if (_xDropArea != null)
		{
			_iDropAreaIndex = this.getDropAreaIndex({'xDropArea': _xDropArea});
			if ((_iDropAreaIndex > -1) && (_iDropAreaIndex < this.axDropAreas.length))
			{
				_sDropAreaID = this.axDropAreas[_iDropAreaIndex][PG_DRAGANDDROP_DROPAREA_INDEX_ID];
			}
			else {_sDropAreaID = _xDropArea;}
		}
				
		if (_iPosX == null) {_iPosX = 0;}
		if (_iPosY == null) {_iPosY = 0;}
		if (_sDropAreaID == null) {_sDropAreaID = '';}
		if (_iGroupID == null) {_iGroupID = this.sDefaultGroupID;}
		if (_iDragElementType == null) {_iDragElementType = this.iDefaultType;}
		if (_iMouseOffsetDist == null) {_iMouseOffsetDist = 0;}
		if (_iElementCopyMode == null) {_iElementCopyMode = this.iDefaultCopyMode;}
		if (_iElementKillMode == null) {_iElementKillMode = this.iDefaultKillMode;}
		
		var _sHtml = '';
		_sHtml += '<div id="'+_sDragElementID+'" style="';
		if (this.isDebugMode({'iMode': PG_DEBUG_HIGH})) {_sHtml += 'border:solid 1px #00ff00; ';}
		if (_sDropAreaID != '')
		{
			if ((_iDropAreaIndex > -1) && (_iDropAreaIndex < this.axDropAreas.length))
			{
				var _iDropAreaType = this.axDropAreas[_iDropAreaIndex][PG_DRAGANDDROP_DROPAREA_INDEX_TYPE];
				
				if (_iDropAreaType == PG_DRAGANDDROP_AREATYPE_SIMPLE) {_sHtml += 'position:absolute; ';}
				else {_sHtml += 'position:static; ';}
				
				if (_iDropAreaType == PG_DRAGANDDROP_AREATYPE_HORIZONTAL_LIST) {_sHtml += 'float:left; ';}
				else {_sHtml += 'float:none; ';}
			}
		}
		else {_sHtml += 'position:absolute; ';}
		if (_iSizeX != null) {_sHtml += 'width:'+_iSizeX+'px; ';}
		if (_iSizeY != null) {_sHtml += 'height:'+_iSizeY+'px; ';}
		_sHtml += 'left:'+_iPosX+'px; top:'+_iPosY+'px;">';
		if (_sContent != null) {_sHtml += _sContent;}
		_sHtml += '</div>';
		
		if ((_sDropAreaID != null) && (_sDropAreaID != ''))
		{
			var _oDropArea = this.oDocument.getElementById(_sDropAreaID);
			if (_oDropArea) {_oDropArea.innerHTML += _sHtml;}
		}
		
		oPGDragAndDrop.registerDragElement(
			{
				'sDragElementID': _sDragElementID, 
				'iDragElementType': _iDragElementType, 
				'iGroupID': _iGroupID, 
				'sDropAreaID': _sDropAreaID, 
				'iMouseOffsetDist': _iMouseOffsetDist, 
				'iElementKillMode': _iElementKillMode, 
				'iElementCopyMode': _iElementCopyMode, 
				'axData': _axData
			}
		);
		
		return _sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sDragElementID [needed][type]string[/type]
	[en]...[/en]
	
	@param sContent [needed][type]string[/type]
	[en]...[/en]
	*/
	this.changeContent = function(_sDragElementID, _sContent)
	{
		if (typeof(_sContent) == 'undefined') {var _sContent = null;}

		_sContent = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'sContent', 'xParameter': _sContent});
		_sDragElementID = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'sDragElementID', 'xParameter': _sDragElementID});

		var _oDragElement = this.oDocument.getElementById(_sDragElementID);
		if (_oDragElement) {_oDragElement.innerHTML = _sContent; return true;}
		return false;
	}
	/* @end method */
}
/* @end class */
classPG_DragElement.prototype = new classPG_ClassBasics();
var oPGDragElement = new classPG_DragElement();
