/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Feb 10 2012
*/
var PG_DROPAREA_TYPE_SIMPLE = 0;
var PG_DROPAREA_TYPE_VERTICAL_LIST = 1;
var PG_DROPAREA_TYPE_HORIZONTAL_LIST = 2;
var PG_DROPAREA_TYPE_TABLE_LIST = 3;

var PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSEHOLD = 0;
var PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSELEFTHOLD = 1;
var PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSERIGHTHOLD = 2;
var PG_DRAGELEMENT_TYPE_DRAGABLE_ONCLICK = 3;
var PG_DRAGELEMENT_TYPE_NON_DRAGABLE = 4;

var PG_DRAGANDDROP_GROUP_DOCUMENT_ONLY = -2;
var PG_DRAGANDDROP_GROUP_DOCUMENT_ALL = -1;
var PG_DRAGANDDROP_GROUP_ALL = 0;

var PG_DRAGANDDROP_ELEMENTCOPYMODE_NOCOPY = 0;
var PG_DRAGANDDROP_ELEMENTCOPYMODE_COPYONDRAG = 1;

var PG_DRAGANDDROP_ELEMENTKILLMODE_NOKILL = 0;
var PG_DRAGANDDROP_ELEMENTKILLMODE_ONDROPINAREA = 1;
var PG_DRAGANDDROP_ELEMENTKILLMODE_ONRELEASE = 2;

var PG_DRAGANDDROP_DROPAREA_INDEX_ID = 0;
var PG_DRAGANDDROP_DROPAREA_INDEX_TYPE = 1;
var PG_DRAGANDDROP_DROPAREA_INDEX_GROUPID = 2;
var PG_DRAGANDDROP_DROPAREA_INDEX_GRIDX = 3;
var PG_DRAGANDDROP_DROPAREA_INDEX_GRIDY = 4;
var PG_DRAGANDDROP_DROPAREA_INDEX_GRABMOVEDISTX = 5;
var PG_DRAGANDDROP_DROPAREA_INDEX_GRABMOVEDISTY = 6;
var PG_DRAGANDDROP_DROPAREA_INDEX_DATA = 7;
var PG_DRAGANDDROP_DROPAREA_INDEX_ONDROP = 8;
var PG_DRAGANDDROP_DROPAREA_INDEX_MAXELEMENTS = 9;

var PG_DRAGANDDROP_DRAGELEMENT_INDEX_ID = 0;
var PG_DRAGANDDROP_DRAGELEMENT_INDEX_TYPE = 1;
var PG_DRAGANDDROP_DRAGELEMENT_INDEX_GROUPID = 2;
var PG_DRAGANDDROP_DRAGELEMENT_INDEX_DROPAREAID = 3;
var PG_DRAGANDDROP_DRAGELEMENT_INDEX_MOUSEOFFSETDIST = 4;
var PG_DRAGANDDROP_DRAGELEMENT_INDEX_KILLMODE = 5;
var PG_DRAGANDDROP_DRAGELEMENT_INDEX_COPYMODE = 6;
var PG_DRAGANDDROP_DRAGELEMENT_INDEX_GRABMOVEDISTX = 7;
var PG_DRAGANDDROP_DRAGELEMENT_INDEX_GRABMOVEDISTY = 8;
var PG_DRAGANDDROP_DRAGELEMENT_INDEX_DATA = 9;
var PG_DRAGANDDROP_DRAGELEMENT_INDEX_ONGRAB = 10;
var PG_DRAGANDDROP_DRAGELEMENT_INDEX_ONDROP = 11;
var PG_DRAGANDDROP_DRAGELEMENT_INDEX_MOVEBOUNDS = 12;

var PG_DRAGANDDROP_MOUSEOFFSETDIST_EXACT_POSITION = -1;
var PG_DRAGANDDROP_MOUSEOFFSETDIST_NONE = 0;

/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_DragAndDrop()
{
	// Declarations...
	this.iDocumentBodyGridX = 0;
	this.iDocumentBodyGridY = 0;
	this.iDocumentBodyAreaType = PG_DROPAREA_TYPE_SIMPLE;

	this.iDragElementLastPosX = 0;
	this.iDragElementLastPosY = 0;
	this.iDragElementOffsetX = 0;
	this.iDragElementOffsetY = 0;
	this.iDragElementMouseDistX = 0;
	this.iDragElementMouseDistY = 0;
	this.iDragElementZIndexOnCrab = 99999999;

	this.iDefaultGrabMoveDistX = 20;
	this.iDefaultGrabMoveDistY = 20;
	
	this.sDragElementLastAreaID = '';
	this.sDragElementMoveWithMouseID = '';
	this.sDragElementWaitForGrabID = '';
	this.sDragElementMoveCopyOfID = '';
	this.iDragElementGrabDistX = -1;
	this.iDragElementGrabDistY = -1;
	this.iDragElementStartPosX = 0;
	this.iDragElementStartPosY = 0;
	
	this.bDragElementGrabedClick = false;
	
	this.axDropAreas = new Array();
	this.axDragElements = new Array();
	
	// Construct...
	this.setID({'sID': 'PGDragAndDrop'});
	this.initClassBasics();
	
	// Methods...
	/*
	@start method
	
	@return sDragElementID [type]string[/type]
	[en]...[/en]
	
	@param oElement [needed][type]object[/type]
	[en]...[/en]
	*/
	this.getNextDragElementIDBySubElement = function(_oElement)
	{
		_oElement = this.getRealParameter({'oParameters': _oElement, 'sName': 'oElement', 'xParameter': _oElement, 'bNotNull': true});
		
		var i=0;
		while (_oElement)
		{
			if (typeof(_oElement.id) != 'undefined')
			{
				for (i=0; i<this.axDragElements.length; i++)
				{
					if (this.axDragElements[i] != null)
					{
						if (_oElement.id == this.axDragElements[i][PG_DRAGANDDROP_DRAGELEMENT_INDEX_ID]) {return this.axDragElements[i][PG_DRAGANDDROP_DRAGELEMENT_INDEX_ID];}
					}
				}
			}
			if (_oElement.parentNode) {_oElement = _oElement.parentNode;} else {_oElement = null;}
		}
		return null;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sElementID [type]string[/type]
	[en]...[/en]
	*/
	this.setDragElementMoveWithMouseID = function(_sElementID)
	{
		_sElementID = this.getRealParameter({'oParameters': _sElementID, 'sName': 'sElementID', 'xParameter': _sElementID});
		this.sDragElementMoveWithMouseID = _sElementID;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sDragElementID [type]string[/type]
	[en]...[/en]
	*/
	this.getDragElementMoveWithMouseID = function() {return this.sDragElementMoveWithMouseID;}
	/* @end method */
	
	/*
	@start method
	
	@param iType [needed][type]int[/type]
	*/
	this.setDocumentBodyAreaType = function(_iType)
	{
		_iType = this.getRealParameter({'oParameters': _iType, 'sName': 'iType', 'xParameter': _iType});
		this.iDocumentBodyAreaType = _iType;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iAreaType [type]int[/type]
	*/
	this.getDocumentBodyAreaType = function() {return this.iDocumentBodyAreaType;}
	/* @end method */
	
	/*
	@start method
	
	@param iGridX [needed][type]int[/type]
	[en]...[/en]
	*/
	this.setDocumentBodyGridX = function(_iGridX)
	{
		_iGridX = this.getRealParameter({'oParameters': _iGridX, 'sName': 'iGridX', 'xParameter': _iGridX});
		this.iDocumentBodyGridX = _iGridX;
	}
	/* @end method */
	
	/*
	@start method 
	
	@return iGridX [type]int[/type]
	*/
	this.getDocumentBodyGridX = function() {return this.iDocumentBodyGridX;}
	/* @end method */
	
	/*
	@start method
	
	@param iGridY [needed][type]int[/type]
	[en]...[/en]
	*/
	this.setDocumentBodyGridY = function(_iGridY)
	{
		_iGridY = this.getRealParameter({'oParameters': _iGridY, 'sName': 'iGridY', 'xParameter': _iGridY});
		this.iDocumentBodyGridY = _iGridY;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iGridY [type]int[/type]
	[en]...[/en]
	*/
	this.getDocumentBodyGridY = function() {return this.iDocumentBodyGridY;}
	/* @end method */
	
	/*
	@start method
	
	@param iGridX [type]int[/type]
	[en]...[/en]
	
	@param iGridY [type]int[/type]
	[en]...[/en]
	*/
	this.setDocumentBodyGrid = function(_iGridX, _iGridY)
	{
		if (typeof(_iGridY) == 'undefined') {var _iGridY = null;}
	
		_iGridY = this.getRealParameter({'oParameters': _iGridX, 'sName': 'iGridY', 'xParameter': _iGridY});
		_iGridX = this.getRealParameter({'oParameters': _iGridX, 'sName': 'iGridX', 'xParameter': _iGridX});

		this.iDocumentBodyGridX = _iGridX;
		this.iDocumentBodyGridY = _iGridY;
	}
	/* @end method */

	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param xDropArea [needed][type]mixed[/type]
	[en]...[/en]
	
	@param iDropAreaType [needed][type]int[/type]
	[en]...[/en]
	*/
	this.changeDropAreaType = function(_xDropArea, _iDropAreaType)
	{
		if (typeof(_iDropAreaType) == 'undefined') {var _iDropAreaType = null;}
	
		_iDropAreaType = this.getRealParameter({'oParameters': _xDropArea, 'sName': 'iDropAreaType', 'xParameter': _iDropAreaType});
		_xDropArea = this.getRealParameter({'oParameters': _xDropArea, 'sName': 'xDropArea', 'xParameter': _xDropArea});

		var _iIndex = this.getDropAreaIndex({'xDropArea': _xDropArea});
		if ((_iIndex > -1) && (_iIndex < this.axDropAreas.length))
		{
			this.axDropAreas[_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_TYPE] = _iDropAreaType;
			return true;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param xDropArea [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sGroupID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.changeDropAreaGroupID = function(_xDropArea, _sGroupID)
	{
		if (typeof(_sGroupID) == 'undefined') {var _sGroupID = null;}
	
		_sGroupID = this.getRealParameter({'oParameters': _xDropArea, 'sName': 'sGroupID', 'xParameter': _sGroupID});
		_xDropArea = this.getRealParameter({'oParameters': _xDropArea, 'sName': 'xDropArea', 'xParameter': _xDropArea});

		var _iIndex = this.getDropAreaIndex({'xDropArea': _xDropArea});
		if ((_iIndex > -1) && (_iIndex < this.axDropAreas.length))
		{
			this.axDropAreas[_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_GROUPID] = _sGroupID;
			return true;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param xDropArea [needed][type]mixed[/type]
	[en]...[/en]
	
	@param axData [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	this.setDropAreaData = function(_xDropArea, _axData)
	{
		if (typeof(_sGroupID) == 'undefined') {var _sGroupID = null;}
	
		_axData = this.getRealParameter({'oParameters': _xDropArea, 'sName': 'axData', 'xParameter': _axData});
		_xDropArea = this.getRealParameter({'oParameters': _xDropArea, 'sName': 'xDropArea', 'xParameter': _xDropArea});

		var _iIndex = this.getDropAreaIndex({'xDropArea': _xDropArea});
		if ((_iIndex > -1) && (_iIndex < this.axDropAreas.length))
		{
			this.axDropAreas[_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_DATA] = _axData;
			return true;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return xData [type]mixed[/type]
	[en]...[/en]
	
	@param xDropArea [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getDropAreaData = function(_xDropArea)
	{
		_xDropArea = this.getRealParameter({'oParameters': _xDropArea, 'sName': 'xDropArea', 'xParameter': _xDropArea});

		var _iIndex = this.getDropAreaIndex({'xDropArea': _xDropArea});
		if ((_iIndex > -1) && (_iIndex < this.axDropAreas.length))
		{
			return this.axDropAreas[_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_DATA];
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iIndex [type]int[/type]
	[en]...[/en]
	
	@param xDropArea [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getDropAreaIndex = function(_xDropArea)
	{
		_xDropArea = this.getRealParameter({'oParameters': _xDropArea, 'sName': 'xDropArea', 'xParameter': _xDropArea});

		var i=0;
		switch (typeof(_xDropArea))
		{
			case 'number':	// _xDropAreaID is _sDropAreaIndex
				return _xDropArea;
			break;

			case 'string':	// _xDropAreaID is _sDropAreaID
				for (i=0; i<this.axDropAreas.length; i++)
				{
					if (this.axDropAreas[i] != null)
					{
						if (this.axDropAreas[i][PG_DRAGANDDROP_DROPAREA_INDEX_ID] == _xDropArea) {return i;}
					}
				}
			break;
		}
		return -1;
	}
	/* @end method */

	/*
	@start method
	
	@param sDropAreaID [needed][type]string[/type]
	[en]...[/en]
	
	@param iGridX [type]int[/type]
	[en]...[/en]
	
	@param iGridY [type]int[/type]
	[en]...[/en]
	
	@param iDropAreaType [type]int[/type]
	[en]...[/en]
	
	@param sGroupID [type]string[/type]
	[en]...[/en]
	
	@param sOnDrop [type]string[/type]
	[en]...[/en]
	
	@param iGrabMoveDistX [type]int[/type]
	[en]...[/en]
	
	@param iGrabMoveDistY [type]int[/type]
	[en]...[/en]
	
	@param axData [type]mixed[][/type]
	[en]...[/en]
	
	@param iMaxDragElements [type]int[/type]
	[en]...[/en]
	*/
	this.registerDropArea = function(
		_sDropAreaID, 
		_iGridX, 
		_iGridY, 
		_iDropAreaType, 
		_sGroupID, 
		_sOnDrop, 
		_iGrabMoveDistX,
		_iGrabMoveDistY,
		_axData, 
		_iMaxDragElements
	)
	{
		if (typeof(_iGridX) == 'undefined') {var _iGridX = null;}
		if (typeof(_iGridY) == 'undefined') {var _iGridY = null;}
		if (typeof(_iDropAreaType) == 'undefined') {var _iDropAreaType = null;}
		if (typeof(_sGroupID) == 'undefined') {var _sGroupID = null;}
		if (typeof(_sOnDrop) == 'undefined') {var _sOnDrop = null;}
		if (typeof(_iGrabMoveDistX) == 'undefined') {var _iGrabMoveDistX = null;}
		if (typeof(_iGrabMoveDistY) == 'undefined') {var _iGrabMoveDistY = null;}
		if (typeof(_axData) == 'undefined') {var _axData = null;}
		if (typeof(_iMaxDragElements) == 'undefined') {var _iMaxDragElements = null;}
		
		_iGridX = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'iGridX', 'xParameter': _iGridX});
		_iGridY = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'iGridY', 'xParameter': _iGridY});
		_iDropAreaType = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'iDropAreaType', 'xParameter': _iDropAreaType});
		_sGroupID = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'sGroupID', 'xParameter': _sGroupID});
		_sOnDrop = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'sOnDrop', 'xParameter': _sOnDrop});
		_iGrabMoveDistX = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'iGrabMoveDistX', 'xParameter': _iGrabMoveDistX});
		_iGrabMoveDistY = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'iGrabMoveDistY', 'xParameter': _iGrabMoveDistY});
		_axData = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'axData', 'xParameter': _axData});
		_iMaxDragElements = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'iMaxDragElements', 'xParameter': _iMaxDragElements});
		_sDropAreaID = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'sDropAreaID', 'xParameter': _sDropAreaID});

		if (_iGridX == null) {_iGridX = oPGDropArea.iDefaultGridX;}
		if (_iGridY == null) {_iGridY = oPGDropArea.iDefaultGridY;}
		if (_sGroupID == null) {_sGroupID = oPGDropArea.sDefaultGroupID;}
		if (_iDropAreaType == null) {_iDropAreaType = oPGDropArea.iDefaultType;}
		if (_iMaxDragElements == null) {_iMaxDragElements = oPGDropArea.iDefaultMaxElements;}

		var _iIndex = this.axDropAreas.length;
		this.axDropAreas.push(new Array());
		this.axDropAreas[_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_ID] = _sDropAreaID;
		this.axDropAreas[_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_TYPE] = _iDropAreaType;
		this.axDropAreas[_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_GROUPID] = _sGroupID;
		this.axDropAreas[_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_GRIDX] = _iGridX;
		this.axDropAreas[_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_GRIDY] = _iGridY;
		this.axDropAreas[_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_GRABMOVEDISTX] = _iGrabMoveDistX;
		this.axDropAreas[_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_GRABMOVEDISTY] = _iGrabMoveDistY;
		this.axDropAreas[_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_DATA] = _axData;
		this.axDropAreas[_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_ONDROP] = _sOnDrop;
		this.axDropAreas[_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_MAXELEMENTS] = _iMaxDragElements;
	}
	/* @end method */
	
	/*
	@start method
	
	@param xDropArea [type]mixed[/type]
	[en]...[/en]
	*/
	this.unregisterDropArea = function(_xDropArea)
	{
		_xDropArea = this.getRealParameter({'oParameters': _xDropArea, 'sName': 'xDropArea', 'xParameter': _xDropArea});
		var _iIndex = this.getDropAreaIndex({'xDropArea': _xDropArea});
		if (_iIndex != null) {this.axDropAreas[_iIndex] = null;}
	}
	/* @end method */
	
	/*
	@start method
	
	@param xDropArea [type]mixed[/type]
	[en]...[/en]
	*/
	this.removeDropArea = function(_xDropArea)
	{
		_xDropArea = this.getRealParameter({'oParameters': _xDropArea, 'sName': 'xDropArea', 'xParameter': _xDropArea});

		var _iIndex = this.getDropAreaIndex({'xDropArea': _xDropArea});
		var _sDropAreaID = this.axDropAreas[_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_ID];
		
		this.unregisterDropArea({'xDropArea': _xDropArea});
		
		var _asDragElement = this.getElementIDsInArea(_xDropArea);
		for (var i=0; i<_asDragElement.length; i++)
		{
			if (_asDragElement[i] != null)
			{
				this.removeDragElement({'sDragElementID': _asDragElement[i]});
			}
		}

		var _oDropArea = this.oDocument.getElementById(_sDropAreaID);
		if (_oDropArea) {_oDropArea.outerHTML = '';}
	}
	/* @end method */
	
	/*
	@start method
	
	@return bIsOverArea [type]bool[/type]
	[en]...[/en]
	
	@param sDropAreaID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.isMouseOverDropArea = function(_sDropAreaID)
	{
		_sDropAreaID = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'sDropAreaID', 'xParameter': _sDropAreaID});

		var _oDropArea = this.oDocument.getElementById(_sDropAreaID);
		if (_oDropArea)
		{
			var _iMousePosX = 0;
			var _iMousePosY = 0;
			if (typeof(oPGInput) != 'undefined')
			{
				_iMousePosX = oPGInput.getDocPosX();
				_iMousePosY = oPGInput.getDocPosY();
			}
			else if (typeof(oPGMouse) != 'undefined')
			{
				_iMousePosX = oPGMouse.getDocPosX();
				_iMousePosY = oPGMouse.getDocPosY();
			}
			else if (typeof(oPGTouchHandler) != 'undfined')
			{
				_iMousePosX = oPGTouchHandler.getDocPosX();
				_iMousePosY = oPGTouchHandler.getDocPosY();
			}
			
			var _iDropAreaPosX = oPGBrowser.getDocumentOffsetX({'xElement': _oDropArea});
			var _iDropAreaSizeX = parseInt(_oDropArea.offsetWidth);
			var _iDropAreaPosY = oPGBrowser.getDocumentOffsetY({'xElement': _oDropArea});
			var _iDropAreaSizeY = parseInt(_oDropArea.offsetHeight);
			
			if ((_iMousePosX >= _iDropAreaPosX) && (_iMousePosX <= _iDropAreaPosX+_iDropAreaSizeX)
			&& (_iMousePosY >= _iDropAreaPosY) && (_iMousePosY <= _iDropAreaPosY+_iDropAreaSizeY))
			{
				return true;
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return asElementIDs [type]string[][/type]
	[en]...[/en]
	
	@param xDropArea [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getElementIDsInArea = function(_xDropArea)
	{
		_xDropArea = this.getRealParameter({'oParameters': _xDropArea, 'sName': 'xDropArea', 'xParameter': _xDropArea});
		return this.getElementIDsFromArea({'xDropArea': _xDropArea, 'bIsInArea': true});
	}
	/* @end method */
	
	/*
	@start method
	
	@return asElementIDs [type]string[][/type]
	[en]...[/en]
	
	@param xDropArea [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getElementIDsNotInArea = function(_xDropArea)
	{
		_xDropArea = this.getRealParameter({'oParameters': _xDropArea, 'sName': 'xDropArea', 'xParameter': _xDropArea});
		return this.getElementIDsFromArea({'xDropArea': _xDropArea, 'bIsInArea': false});
	}
	/* @end method */
	
	/*
	@start method
	
	@return asElementIDs [type]string[][/type]
	[en]...[/en]
	
	@param xDropArea [needed][type]mixed[/type]
	[en]...[/en]
	
	@param bIsArea [needed][type]bool[/type]
	[en]...[/en]
	*/
	this.getElementIDsFromArea = function(_xDropArea, _bIsInArea)
	{
		if (typeof(_bIsInArea) == 'undefined') {var _bIsInArea = null;}

		_bIsInArea = this.getRealParameter({'oParameters': _xDropArea, 'sName': 'bIsInArea', 'xParameter': _bIsInArea});
		_xDropArea = this.getRealParameter({'oParameters': _xDropArea, 'sName': 'xDropArea', 'xParameter': _xDropArea});

		var _asElements = new Array();
		var _sDragElementAreaID = '';
		var _iIndex = this.getDropAreaIndex({'xDropArea': _xDropArea});
		if (_iIndex >= 0)
		{
			var _sDropAreaID = this.axDropAreas[_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_ID];
			for (var i=0; i<this.axDragElements.length; i++)
			{
				if (this.axDragElements[i] != null)
				{
					_sDragElementAreaID = this.axDragElements[i][PG_DRAGANDDROP_DRAGELEMENT_INDEX_DROPAREAID];
					if ((_sDragElementAreaID == _sDropAreaID) && (_bIsInArea == true)) {_asElements.push(this.axDragElements[i][PG_DRAGANDDROP_DRAGELEMENT_INDEX_ID]);}
					else if ((_sDragElementAreaID != _sDropAreaID) && (_bIsInArea == false)) {_asElements.push(this.axDragElements[i][PG_DRAGANDDROP_DRAGELEMENT_INDEX_ID]);}
				}
			}
		}
		return _asElements;
	}
	/* @end method */
	
	/*
	@start method
	
	@return oDocumentBody [type]object[/type]
	[en]...[/en]
	
	@param xContainer [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.setDocumentBody = function(_xContainer)
	{
		_xContainer = this.getRealParameter({'oParameters': _xContainer, 'sName': 'xContainer', 'xParameter': _xContainer});

		if (typeof(_xContainer) == 'object') {this.oDocumentBody = _xContainer;}
		else if (typeof(_xContainer) == 'string')
		{
			var _oContainer = this.oDocument.getElementById(_xContainer);
			if (_oContainer) {this.oDocumentBody = _oContainer; return this.oDocumentBody;}
		}
		return false;
	}
	/* @end method */
	this.getDocumentBody = function() {return this.oDocumentBody;}

	/*
	@start method
	
	@param xDragElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param iPosX [type]int[/type]
	[en]...[/en]
	
	@param iPosY [type]int[/type]
	[en]...[/en]
	*/
	this.dropElementInDocument = function(_xDragElement, _iPosX, _iPosY)
	{
		if (typeof(_iPosX) == 'undefined') {var _iPosX = null;}
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}

		_iPosX = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'iPosX', 'xParameter': _iPosX});
		_iPosY = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'iPosY', 'xParameter': _iPosY});
		_xDragElement = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'xDragElement', 'xParameter': _xDragElement});

		if (this.isDebugMode({'iMode': PG_DEBUG_HIGH})) {alert('dropElementInDocument('+_xDragElement+', '+_iPosX+', '+_iPosY+')');}
		var _iDragElementIndex = this.getDragElementIndex({'xDragElement': _xDragElement});
		var _sDragElementID = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_ID];
		
		var _oDragElement = this.oDocument.getElementById(_sDragElementID);
		var _iDragElementGroupID = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_GROUPID];
		var _sDragElementAreaID = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_DROPAREAID];
		var _iDragElementType = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_TYPE];
		var _iDragElementMouseOffsetDist = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_MOUSEOFFSETDIST];
		var _iDragElementKillMode = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_KILLMODE];
		var _iDragElementCopyMode = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_COPYMODE];
		
		if ((_iDragElementGroupID == PG_DRAGANDDROP_GROUP_DOCUMENT_ONLY)
		|| (_iDragElementGroupID == PG_DRAGANDDROP_GROUP_DOCUMENT_ALL))
		{
			this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_DROPAREAID] = ''; // _sDropAreaID;

			var _iDragElementPosX = oPGBrowser.getDocumentOffsetX({'xElement': _oDragElement});
			var _iDragElementPosY = oPGBrowser.getDocumentOffsetY({'xElement': _oDragElement});

			if ((this.iDocumentBodyAreaType == PG_DROPAREA_TYPE_VERTICAL_LIST)
			|| (this.iDocumentBodyAreaType == PG_DROPAREA_TYPE_HORIZONTAL_LIST)
			|| (this.iDocumentBodyAreaType == PG_DROPAREA_TYPE_TABLE_LIST))
			{
				this.insertDragElement({'oDropContainer': this.oDocumentBody, 'iDropContainerType': this.iDocumentBodyAreaType, 'oDragElement': _oDragElement});
			}
			else
			{
				if (_iPosX == null)
				{
					if (_iDragElementMouseOffsetDist != 0)
					{
						var _iNewPosX = oPGInput.getDocPosX();
						_iNewPosX -= Math.ceil(parseInt(_oDragElement.offsetWidth)/2);
						if (this.iDocumentBodyGridX > 1) {_iNewPosX = Math.round(_iNewPosX/this.iDocumentBodyGridX)*this.iDocumentBodyGridX;}
						_oDragElement.style.left = _iNewPosX+'px';
					}
					else
					{
						var _iNewPosX = _iDragElementPosX;
						if (this.iDocumentBodyGridX > 1) {_iNewPosX = Math.round(_iNewPosX/this.iDocumentBodyGridX)*this.iDocumentBodyGridX;}
						_oDragElement.style.left = _iNewPosX+'px';
					}
				}
				else
				{
					var _iNewPosX = _iPosX;
					if (this.iDocumentBodyGridX > 1) {_iNewPosX = Math.round(_iNewPosX/this.iDocumentBodyGridX)*this.iDocumentBodyGridX;}
					_oDragElement.style.left = _iNewPosX+'px';
				}
				
				if (_iPosY == null)
				{
					if (_iDragElementMouseOffsetDist != 0)
					{
						var _iNewPosY = oPGInput.getDocPosY();
						_iNewPosY -= Math.ceil(parseInt(_oDragElement.offsetHeight)/2);
						if (this.iDocumentBodyGridY > 1) {_iNewPosY = Math.round(_iNewPosY/this.iDocumentBodyGridY)*this.iDocumentBodyGridY;}
						_oDragElement.style.top = _iNewPosY+'px';
					}
					else
					{
						var _iNewPosY = _iDragElementPosY;
						if (this.iDocumentBodyGridY > 1) {_iNewPosY = Math.round(_iNewPosY/this.iDocumentBodyGridY)*this.iDocumentBodyGridY;}
						_oDragElement.style.top = _iNewPosY+'px';
					}				
				}
				else
				{
					var _iNewPosY = _iPosY;
					if (this.iDocumentBodyGridY > 1) {_iNewPosY = Math.round(_iNewPosY/this.iDocumentBodyGridY)*this.iDocumentBodyGridY;}
					_oDragElement.style.top = _iNewPosY+'px';
				}
				
				this.oDocumentBody.appendChild(_oDragElement);
			}
		}
	}
	/* @end method */

	/*
	@start method
	
	@param xDropArea [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xDragElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param iPosX [type]int[/type]
	[en]...[/en]
	
	@param iPosY [type]int[/type]
	[en]...[/en]
	*/
	this.dropElemetInArea = function(_xDropArea, _xDragElement, _iPosX, _iPosY)
	{
		if (typeof(_xDragElement) == 'undefined') {var _xDragElement = null;}
		if (typeof(_iPosX) == 'undefined') {var _iPosX = null;}
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}

		_xDragElement = this.getRealParameter({'oParameters': _xDropArea, 'sName': 'xDragElement', 'xParameter': _xDragElement});
		_iPosX = this.getRealParameter({'oParameters': _xDropArea, 'sName': 'iPosX', 'xParameter': _iPosX});
		_iPosY = this.getRealParameter({'oParameters': _xDropArea, 'sName': 'iPosY', 'xParameter': _iPosY});
		_xDropArea = this.getRealParameter({'oParameters': _xDropArea, 'sName': 'xDropArea', 'xParameter': _xDropArea});

		if (this.isDebugMode({'iMode': PG_DEBUG_HIGH})) {alert('dropElemetInArea('+_xDropArea+', '+_xDragElement+', '+_iPosX+', '+_iPosY+')');}
		var _iDragElementIndex = this.getDragElementIndex({'xDragElement': _xDragElement});
		var _sDragElementID = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_ID];

		var _sDropAreaID = '';
		var _iDropAreaIndex = this.getDropAreaIndex({'xDropArea': _xDropArea});
		if ((_iDropAreaIndex > -1) && (_iDropAreaIndex < this.axDropAreas.length))
		{
			_sDropAreaID = this.axDropAreas[_iDropAreaIndex][PG_DRAGANDDROP_DROPAREA_INDEX_ID];
		}
		else {_sDropAreaID = _xDropArea;}

		var _sElementToDropID = _sDragElementID;
		var _sElementSettingsID = _sDragElementID;
		if (this.sDragElementMoveCopyOfID != '') {_sElementSettingsID = this.sDragElementMoveCopyOfID;}

		var _oDragElement = this.oDocument.getElementById(_sElementToDropID);
		var _iDragElementGroupID = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_GROUPID];
		var _sDragElementAreaID = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_DROPAREAID];
		var _iDragElementType = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_TYPE];
		var _iDragElementMouseOffsetDist = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_MOUSEOFFSETDIST];
		var _iDragElementKillMode = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_KILLMODE];
		var _iDragElementCopyMode = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_COPYMODE];
		
		var _oDropArea = this.oDocument.getElementById(_sDropAreaID);
		var _iDropAreaType = this.axDropAreas[_iDropAreaIndex][PG_DRAGANDDROP_DROPAREA_INDEX_TYPE];
		var _iDropAreaGroupID = this.axDropAreas[_iDropAreaIndex][PG_DRAGANDDROP_DROPAREA_INDEX_GROUPID];
		var _iDropAreaGridX = this.axDropAreas[_iDropAreaIndex][PG_DRAGANDDROP_DROPAREA_INDEX_GRIDX];
		var _iDropAreaGridY = this.axDropAreas[_iDropAreaIndex][PG_DRAGANDDROP_DROPAREA_INDEX_GRIDY];

		if ((_oDragElement) && (_oDropArea))
		{
			if ((_iDragElementGroupID == _iDropAreaGroupID) || (_iDropAreaGroupID == 0))
			{
				this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_DROPAREAID] = _sDropAreaID;
				
				var _iDragElementPosX = oPGBrowser.getDocumentOffsetX({'xElement': _oDragElement});
				var _iDragElementPosY = oPGBrowser.getDocumentOffsetY({'xElement': _oDragElement});
				var _iDropAreaPosX = oPGBrowser.getDocumentOffsetX({'xElement': _oDropArea});
				var _iDropAreaPosY = oPGBrowser.getDocumentOffsetY({'xElement': _oDropArea});
								
				if ((_iDropAreaType == PG_DROPAREA_TYPE_VERTICAL_LIST)
				|| (_iDropAreaType == PG_DROPAREA_TYPE_HORIZONTAL_LIST)
				|| (_iDropAreaType == PG_DROPAREA_TYPE_TABLE_LIST))
				{
					this.insertDragElement({'oDropContainer': _oDropArea, 'iDropContainerType': _iDropAreaType,  'oDragElement':_oDragElement});
				}
				else
				{
					if (_iPosX == null)
					{
						if (_iDragElementMouseOffsetDist != 0)
						{
							var _iNewPosX = oPGInput.getDocPosX();
							_iNewPosX -= _iDropAreaPosX;
							_iNewPosX -= Math.ceil(parseInt(_oDragElement.offsetWidth)/2);
							if (_iDropAreaGridX > 1) {_iNewPosX = Math.round(_iNewPosX/_iDropAreaGridX)*_iDropAreaGridX;}
							_oDragElement.style.left = _iNewPosX+'px';
						}
						else
						{
							var _iNewPosX = (_iDragElementPosX-_iDropAreaPosX);
							if (_iDropAreaGridX > 1) {_iNewPosX = Math.round(_iNewPosX/_iDropAreaGridX)*_iDropAreaGridX;}
							_oDragElement.style.left = _iNewPosX+'px';
						}
					}
					else
					{
						var _iNewPosX = _iPosX;
						if (_iDropAreaGridX > 1) {_iNewPosX = Math.round(_iNewPosX/_iDropAreaGridX)*_iDropAreaGridX;}
						_oDragElement.style.left = _iNewPosX+'px';
					}
					
					if (_iPosY == null)
					{
						if (_iDragElementMouseOffsetDist != 0)
						{
							var _iNewPosY = oPGInput.getDocPosY();
							_iNewPosY -= _iDropAreaPosY;
							_iNewPosY -= Math.ceil(parseInt(_oDragElement.offsetHeight)/2);
							if (_iDropAreaGridY > 1) {_iNewPosY = Math.round(_iNewPosY/_iDropAreaGridY)*_iDropAreaGridY;}
							_oDragElement.style.top = _iNewPosY+'px';
						}
						else
						{
							var _iNewPosY = (_iDragElementPosY-_iDropAreaPosY);
							if (_iDropAreaGridY > 1) {_iNewPosY = Math.round(_iNewPosY/_iDropAreaGridY)*_iDropAreaGridY;}
							_oDragElement.style.top = _iNewPosY+'px';
						}				
					}
					else
					{
						var _iNewPosY = _iPosY;
						if (_iDropAreaGridY > 1) {_iNewPosY = Math.round(_iNewPosY/_iDropAreaGridY)*_iDropAreaGridY;}
						_oDragElement.style.top = _iNewPosY+'px';
					}
					
					_oDropArea.appendChild(_oDragElement);
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param oDropContainer [needed][type]object[/type]
	[en]...[/en]
	
	@param iDropContainerType [needed][type]int[/type]
	[en]...[/en]
	
	@param oDragElement [needed][type]object[/type]
	[en]...[/en]
	*/
	this.insertDragElement = function(_oDropContainer, _iDropContainerType, _oDragElement)
	{
		if (typeof(_iDropContainerType) == 'undefined') {var _iDropContainerType = null;}
		if (typeof(_oDragElement) == 'undefined') {var _oDragElement = null;}

		_iDropContainerType = this.getRealParameter({'oParameters': _oDropContainer, 'sName': 'iDropContainerType', 'xParameter': _iDropContainerType});
		_oDragElement = this.getRealParameter({'oParameters': _oDropContainer, 'sName': 'oDragElement', 'xParameter': _oDragElement});
		_oDropContainer = this.getRealParameter({'oParameters': _oDropContainer, 'sName': 'oDropContainer', 'xParameter': _oDropContainer, 'bNotNull': true});

		if (this.isDebugMode({'iMode': PG_DEBUG_HIGH})) {alert("insertDragElement("+_oDropContainer+", "+_iDropContainerType+", "+_oDragElement+")");}
		_oDragElement.style.position = 'static';
		_oDragElement.style.left = '0px';
		_oDragElement.style.top = '0px';
		if (_iDropContainerType == PG_DROPAREA_TYPE_HORIZONTAL_LIST) {_oDragElement.style.float = 'left';}
		else {_oDragElement.style.float = 'none';}
		
		var _bInserted = false;
		var _oDragElementTemp = _oDropContainer.firstChild;
		var _oDragElementLast = null;
		while ((_oDragElementTemp != null) && (_bInserted == false))
		{
			if (_oDragElementTemp.nodeName.toUpperCase() == 'DIV')
			{
				if
				(
					((oPGInput.getDocPosX() <= oPGBrowser.getDocumentOffsetX(_oDragElementTemp)+Math.round(parseInt(_oDragElementTemp.offsetWidth)/2)) && (_iDropContainerType == PG_DROPAREA_TYPE_HORIZONTAL_LIST))
					|| ((oPGInput.getDocPosY() <= oPGBrowser.getDocumentOffsetY(_oDragElementTemp)+Math.round(parseInt(_oDragElementTemp.offsetHeight)/2)) && (_iDropContainerType == PG_DROPAREA_TYPE_VERTICAL_LIST))
					|| (
						(_iDropContainerType == PG_DROPAREA_TYPE_TABLE_LIST)
						&& (oPGInput.getDocPosX() <= oPGBrowser.getDocumentOffsetX(_oDragElementTemp)+Math.round(parseInt(_oDragElementTemp.offsetWidth)/2))
						&& (oPGInput.getDocPosY() <= oPGBrowser.getDocumentOffsetY(_oDragElementTemp)+Math.round(parseInt(_oDragElementTemp.offsetHeight)/2))
					)
				)
				{
					if (_oDragElementLast != null)
					{
						if (_oDragElementLast.nodeName.toUpperCase() == 'DIV')
						{
							if
							(
								((oPGInput.getDocPosX() > oPGBrowser.getDocumentOffsetX({'xElement': _oDragElementLast})+Math.round(parseInt(_oDragElementLast.offsetWidth)/2)) && (_iDropContainerType == PG_DROPAREA_TYPE_HORIZONTAL_LIST))
								|| ((oPGInput.getDocPosY() > oPGBrowser.getDocumentOffsetY({'xElement': _oDragElementLast})+Math.round(parseInt(_oDragElementLast.offsetHeight)/2)) && (_iDropContainerType == PG_DROPAREA_TYPE_VERTICAL_LIST))
								|| (
									(_iDropContainerType == PG_DROPAREA_TYPE_TABLE_LIST)
									&& (oPGInput.getDocPosX() > oPGBrowser.getDocumentOffsetX({'xElement': _oDragElementLast})+Math.round(parseInt(_oDragElementLast.offsetWidth)/2))
									&& (oPGInput.getDocPosY() > oPGBrowser.getDocumentOffsetY({'xElement': _oDragElementLast})+Math.round(parseInt(_oDragElementLast.offsetHeight)/2))
								)
							)
							{
								_oDropContainer.insertBefore(_oDragElement, _oDragElementTemp);
								_bInserted = true;
							}
						}
					}
					else
					{
						_oDropContainer.insertBefore(_oDragElement, _oDragElementTemp);
						_bInserted = true;
					}
				}
				_oDragElementLast = _oDragElementTemp;
			}
			_oDragElementTemp = _oDragElementTemp.nextSibling;
		}
		if (_bInserted == false) {_oDropContainer.appendChild(_oDragElement);}
	}
	/* @end method */
	
	/*
	@start method
	
	@return bIsInArea [type]bool[/type]
	[en]...[/en]
	
	@param xDragElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xDropArea [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.isDragElementInArea = function(_xDragElement, _xDropArea)
	{
		if (typeof(_xDropArea) == 'undefined') {var _xDropArea = null;}

		_xDropArea = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'xDropArea', 'xParameter': _xDropArea});
		_xDragElement = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'xDragElement', 'xParameter': _xDragElement, 'bNotNull': true});

		var _iDragElementIndex = this.getDragElementIndex(_xDragElement);
		if ((_iDragElementIndex > -1) && (_iDragElementIndex < this.axDragElements.length))
		{
			var _sDropAreaID = '';
			if (typeof(_xDropArea) == 'string') {_sDropAreaID = _xDropArea;}
			else if (typeof(_xDropArea) == 'number')
			{
				_sDropAreaID = this.axDropAreas[_xDropArea][PG_DRAGANDDROP_DROPAREA_INDEX_ID];
			}
			if (_sDropAreaID != '')
			{
				var _sDragElementsAreaID = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_DROPAREAID];
				if (_sDropAreaID == _sDragElementsAreaID) {return true;}
			}
		}
		return false;
	}
	/* @end method */

	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param xDragElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param iDragElementType [needed][type]int[/type]
	[en]...[/en]
	*/
	this.changeDragElementType = function(_xDragElement, _iDragElementType)
	{
		if (typeof(_iDragElementType) == 'undefined') {var _iDragElementType = null;}

		_iDragElementType = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'iDragElementType', 'xParameter': _iDragElementType});
		_xDragElement = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'xDragElement', 'xParameter': _xDragElement});

		var _iDragElementIndex = this.getDragElementIndex({'xDragElement': _xDragElement});
		if ((_iDragElementIndex > -1) && (_iDragElementIndex < this.axDragElements.length))
		{
			this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_TYPE] = _iDragElementType;
			return true;
		}
		return false;
	}
	/* @end method */

	/*
	@start method
	
	@param sDragElementID [needed][type]string[/type]
	[en]...[/en]
	
	@param iDragElementType [type]int[/type]
	[en]...[/en]
	
	@param sGroupID [type]string[/type]
	[en]...[/en]
	
	@param sDropAreaID [type]string[/type]
	[en]...[/en]
	
	@param iMouseOffsetDist [type]int[/type]
	[en]...[/en]
	
	@param iElementKillMode [type]int[/type]
	[en]...[/en]
	
	@param iElementCopyMode [type]int[/type]
	[en]...[/en]
	
	@param iGrabMoveDistX [type]int[/type]
	[en]...[/en]
	
	@param iGrabMoveDistY [type]int[/type]
	[en]...[/en]
	
	@param sOnGrab [type]string[/type]
	[en]...[/en]
	
	@param sOnDrop [type]string[/type]
	[en]...[/en]
	
	@param axData [type]mixed[][/type]
	[en]...[/en]
	*/
	this.registerDragElement = function(
		_sDragElementID, 
		_iDragElementType, 
		_sGroupID, 
		_sDropAreaID, 
		_iMouseOffsetDist, 
		_iElementKillMode, 
		_iElementCopyMode, 
		_iGrabMoveDistX,
		_iGrabMoveDistY,
		_aiMoveBounds,
		_sOnGrab,
		_sOnDrop,
		_axData
	)
	{
		if (typeof(_iDragElementType) == 'undefined') {var _iDragElementType = null;}
		if (typeof(_sGroupID) == 'undefined') {var _sGroupID = null;}
		if (typeof(_sDropAreaID) == 'undefined') {var _sDropAreaID = null;}
		if (typeof(_iMouseOffsetDist) == 'undefined') {var _iMouseOffsetDist = null;}
		if (typeof(_iElementKillMode) == 'undefined') {var _iElementKillMode = null;}
		if (typeof(_iElementCopyMode) == 'undefined') {var _iElementCopyMode = null;}
		if (typeof(_iGrabMoveDistX) == 'undefined') {var _iGrabMoveDistX = null;}
		if (typeof(_iGrabMoveDistY) == 'undefined') {var _iGrabMoveDistY = null;}
		if (typeof(_aiMoveBounds) == 'undefined') {var _aiMoveBounds = null;}
		if (typeof(_sOnGrab) == 'undefined') {var _sOnGrab = null;}
		if (typeof(_sOnDrop) == 'undefined') {var _sOnDrop = null;}
		if (typeof(_axData) == 'undefined') {var _axData = null;}
		
		_iDragElementType = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'iDragElementType', 'xParameter': _iDragElementType});
		_sDropAreaID = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'sDropAreaID', 'xParameter': _sDropAreaID});
		_sGroupID = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'sGroupID', 'xParameter': _sGroupID});
		_iMouseOffsetDist = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'iMouseOffsetDist', 'xParameter': _iMouseOffsetDist});
		_iElementKillMode = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'iElementKillMode', 'xParameter': _iElementKillMode});
		_iElementCopyMode = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'iElementCopyMode', 'xParameter': _iElementCopyMode});
		_iGrabMoveDistX = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'iGrabMoveDistX', 'xParameter': _iGrabMoveDistX});
		_iGrabMoveDistY = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'iGrabMoveDistY', 'xParameter': _iGrabMoveDistY});
		_aiMoveBounds = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'aiMoveBounds', 'xParameter': _aiMoveBounds});
		_sOnGrab = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'sOnGrab', 'xParameter': _sOnGrab});
		_sOnDrop = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'sOnDrop', 'xParameter': _sOnDrop});
		_axData = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'axData', 'xParameter': _axData});
		_sDragElementID = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'sDragElementID', 'xParameter': _sDragElementID});
		
		if (_sDropAreaID == null) {_sDropAreaID = '';}
		if (_sGroupID == null) {_sGroupID = oPGDragElement.sDefaultGroupID;}
		if (_iDragElementType == null) {_iDragElementType = oPGDragElement.iDefaultType;}
		if (_iMouseOffsetDist == null) {_iMouseOffsetDist = 0;}
		if (_iElementCopyMode == null) {_iElementCopyMode = oPGDragElement.iDefaultCopyMode;}
		if (_iElementKillMode == null) {_iElementKillMode = oPGDragElement.iDefaultKillMode;}

		var _iIndex = this.axDragElements.length;
		this.axDragElements.push(new Array());
		this.axDragElements[_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_ID] = _sDragElementID;
		this.axDragElements[_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_TYPE] = _iDragElementType;
		this.axDragElements[_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_GROUPID] = _sGroupID;
		this.axDragElements[_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_DROPAREAID] = _sDropAreaID;
		this.axDragElements[_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_MOUSEOFFSETDIST] = _iMouseOffsetDist;
		this.axDragElements[_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_KILLMODE] = _iElementKillMode;
		this.axDragElements[_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_COPYMODE] = _iElementCopyMode;
		this.axDragElements[_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_GRABMOVEDISTX] = _iGrabMoveDistX;
		this.axDragElements[_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_GRABMOVEDISTY] = _iGrabMoveDistY;
		this.axDragElements[_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_MOVEBOUNDS] = _aiMoveBounds;
		this.axDragElements[_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_ONGRAB] = _sOnGrab;
		this.axDragElements[_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_ONDROP] = _sOnDrop;
		this.axDragElements[_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_DATA] = _axData;
	}
	/* @end method */
	
	/*
	@start method
	
	@param xDragElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.unregisterDragElement = function(_xDragElement)
	{
		_xDragElement = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'xDragElement', 'xParameter': _xDragElement});
		var _iIndex = this.getDragElementIndex({'xDragElement': _xDragElement});
		if (_iIndex != -1) {this.axDragElements[_iIndex] = null;}
	}
	/* @end method */

	/*
	@start method
	
	@param sDragElementID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.removeDragElement = function(_sDragElementID)
	{
		_sDragElementID = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'sDragElementID', 'xParameter': _sDragElementID});
		if (this.isDebugMode(PG_DEBUG_HIGH)) {alert("removeDragElement("+_sDragElementID+")");}
		var i=0;
		for (i=0; i<this.axDragElements.length; i++)
		{
			if (this.axDragElements[i] != null)
			{
				if (this.axDragElements[i][PG_DRAGANDDROP_DRAGELEMENT_INDEX_ID] == _sDragElementID)
				{
					this.axDragElements[i] = null;
				}
			}
		}
		
		var _oDragElement = this.oDocument.getElementById(_sDragElementID);
		if (_oDragElement) {_oDragElement.outerHTML = '';}
	}
	/* @end method */
	
	/*
	@start method
	
	@return iIndex [type]int[/type]
	[en]...[/en]
	
	@param xDragElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getDragElementIndex = function(_xDragElement)
	{
		_xDragElement = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'xDragElement', 'xParameter': _xDragElement});

		var i=0;
		switch (typeof(_xDragElement))
		{
			case 'number':	// _xDragElement is _iDragElementIndex
				return _xDragElement;
			break;

			case 'string':	// _xDragElement is _sDragElementID
				for (i=0; i<this.axDragElements.length; i++)
				{
					if (this.axDragElements[i] != null)
					{
						if (this.axDragElements[i][PG_DRAGANDDROP_DRAGELEMENT_INDEX_ID] == _xDragElement) {return i;}
					}
				}
			break;
		}
		return -1;
	}
	/* @end method */
	
	/*
	@start method
	
	@return axDropElement [type]mixed[][/type]
	[en]...[/en]
	
	@param xDragElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getDragElementStructure = function(_xDragElement)
	{
		_xDragElement = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'xDragElement', 'xParameter': _xDragElement});
		var _iDragElementIndex = this.getDragElementIndex({'xDragElement': _xDragElement});
		if (_iDragElementIndex > -1) {return this.axDragElements[_iDragElementIndex];}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param xDragElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param axStructure [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.setDragElementStructure = function(_xDragElement, _axStructure)
	{
		_axStructure = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'axStructure', 'xParameter': _axStructure});
		_xDragElement = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'xDragElement', 'xParameter': _xDragElement});

		var _iDragElementIndex = this.getDragElementIndex({'xDragElement': _xDragElement});
		if (_iDragElementIndex > -1)
		{
			return this.axDragElements[_iDragElementIndex] = _axStructure;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param xDragElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param axData [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	this.setDragElementData = function(_xDragElement, _axData)
	{
		if (typeof(_axData) == 'undefined') {var _axData = null;}

		_axData = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'axData', 'xParameter': _axData});
		_xDragElement = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'xDragElement', 'xParameter': _xDragElement});

		var _iDragElementIndex = this.getDragElementIndex({'xDragElement': _xDragElement});
		if (_iDragElementIndex > -1) {this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_DATA] = _axData; return true;}
		return false;
	}
	/* @end method */
	
	/*
	@end method
	
	@return axData [type]mixed[][/type]
	[en]...[/en]
	
	@param xDragElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getDragElementData = function(_xDragElement)
	{
		_xDragElement = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'xDragElement', 'xParameter': _xDragElement});
		var _iDragElementIndex = this.getDragElementIndex({'xDragElement': _xDragElement});
		if (_iDragElementIndex > -1) {return this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_DATA];}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param xDragElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sGroupID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.changeDragElementGroupID = function(_xDragElement, _sGroupID)
	{
		if (typeof(_sGroupID) == 'undefined') {var _sGroupID = null;}

		_sGroupID = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'sGroupID', 'xParameter': _sGroupID});
		_xDragElement = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'xDragElement', 'xParameter': _xDragElement});

		var _iDragElementIndex = this.getDragElementIndex({'xDragElement': _xDragElement});
		if ((_iDragElementIndex > -1) && (_iDragElementIndex < this.axDragElements.length))
		{
			this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_GROUPID] = _sGroupID;
			return true;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sDragElementID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.onDragElementClick = function(_sDragElementID)
	{
		_sDragElementID = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'sDragElementID', 'xParameter': _sDragElementID});

		if ((this.sDragElementMoveWithMouseID == '') && (!oPGBrowser.isMobile()))
		{
			var _iDragElementIndex = this.getDragElementIndex({'xDragElement': _sDragElementID});
			if ((_iDragElementIndex > -1) && (_iDragElementIndex < this.axDragElements.length))
			{
				if (this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_TYPE] == PG_DRAGELEMENT_TYPE_DRAGABLE_ONCLICK)
				{
					var _sBrowserName = oPGBrowser.getBrowserName();
					if ((_sBrowserName != PG_BROWSER_INTERNET_EXPLORER) && (_sBrowserName != PG_BROWSER_CHROME)) {this.bDragElementGrabedClick = true;}
					this.crabDragElement({'sDragElementID': _sDragElementID});
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param eEvent [needed][type]object[/type]
	[en]...[/en]
	
	@param sDragElementID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.onDragElementPress = function(_eEvent, _sDragElementID)
	{
		_sDragElementID = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'sDragElementID', 'xParameter': _sDragElementID});

		if (!_eEvent) {_eEvent = window.event;}
		if (oPGBrowser.isMobile())
		{
			var _iDragElementIndex = this.getDragElementIndex({'xDragElement': _sDragElementID});
			if ((_iDragElementIndex > -1) && (_iDragElementIndex < this.axDragElements.length))
			{
				var _iDragElementType = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_TYPE];
				var _iMouseButton = oPGMouse.getMouseButtonFromEvent(_eEvent);
				if ((_iDragElementType == PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSEHOLD)
				|| (_iDragElementType == PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSELEFTHOLD)
				|| (_iDragElementType == PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSERIGHTHOLD))
				{
					this.crabDragElement(_sDragElementID);
					if ((_iDragElementType == PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSEHOLD)
					|| (_iDragElementType == PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSERIGHTHOLD))
					{
						this.bDragElementGrabedHoldRight = true;
						oPGInput.preventDefaultPress(_eEvent);
						return false;
					}
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param eEvent [needed][type]object[/type]
	[en]...[/en]
	
	@param sDragElementID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.onDragElementMouseDown = function(_eEvent, _sDragElementID)
	{
		_sDragElementID = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'sDragElementID', 'xParameter': _sDragElementID});

		if (!_eEvent) {_eEvent = window.event;}
		if ((this.sDragElementMoveWithMouseID == '') && (!oPGBrowser.isMobile()))
		{
			var _iDragElementIndex = this.getDragElementIndex({'xDragElement': _sDragElementID});
			if ((_iDragElementIndex > -1) && (_iDragElementIndex < this.axDragElements.length))
			{
				var _iDragElementType = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_TYPE];
				var _iMouseButton = oPGMouse.getMouseButtonFromEvent(_eEvent);
				if ((_iDragElementType == PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSEHOLD)
				|| ((_iDragElementType == PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSELEFTHOLD) && (_iMouseButton == PG_MOUSE_BUTTON_LEFT))
				|| ((_iDragElementType == PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSERIGHTHOLD) && (_iMouseButton == PG_MOUSE_BUTTON_RIGHT)))
				{
					this.crabDragElement({'sDragElementID': _sDragElementID});
					
					if ((_iDragElementType == PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSEHOLD)
					|| ((_iDragElementType == PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSERIGHTHOLD) && (_iMouseButton == PG_MOUSE_BUTTON_RIGHT)))
					{
						this.bDragElementGrabedHoldRight = true;
						oPGInput.preventDefaultPress(_eEvent);
						return false;
					}
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@return iMoveDistX [type]int[/type]
	[en]...[/en]
	
	@param sDropAreaID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.getDropAreaGrabMoveDistX = function(_sDropAreaID)
	{
		_sDropAreaID = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'sDropAreaID', 'xParameter': _sDropAreaID});

		var _iDropAreaGrabMoveDistX = -1;
		var _iDropAreaIndex = this.getDropAreaIndex({'xDropArea': _sDropAreaID});
		if ((_iDropAreaIndex > -1) && (_iDropAreaIndex < this.axDropAreas.length))
		{
			_iDropAreaGrabMoveDistX = this.axDropAreas[_iDropAreaIndex][PG_DRAGANDDROP_DROPAREA_INDEX_GRABMOVEDISTX];
			if ((_iDropAreaGrabMoveDistX == -1) || (_iDropAreaGrabMoveDistX == null)) {_iDropAreaGrabMoveDistX = this.iDefaultGrabMoveDistX;}
		}
		return _iDropAreaGrabMoveDistX;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iMoveDistY [type]int[/type]
	[en]...[/en]
	
	@param sDropAreaID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.getDropAreaGrabMoveDistY = function(_sDropAreaID)
	{
		_sDropAreaID = this.getRealParameter({'oParameters': _sDropAreaID, 'sName': 'sDropAreaID', 'xParameter': _sDropAreaID});

		var _iDropAreaGrabMoveDistY = -1;
		var _iDropAreaIndex = this.getDropAreaIndex({'xDropArea': _sDropAreaID});
		if ((_iDropAreaIndex > -1) && (_iDropAreaIndex < this.axDropAreas.length))
		{
			_iDropAreaGrabMoveDistY = this.axDropAreas[_iDropAreaIndex][PG_DRAGANDDROP_DROPAREA_INDEX_GRABMOVEDISTY];
			if ((_iDropAreaGrabMoveDistY == -1) || (_iDropAreaGrabMoveDistY == null)) {_iDropAreaGrabMoveDistY = this.iDefaultGrabMoveDistY;}
		}
		return _iDropAreaGrabMoveDistY;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iMoveDistX [type]int[/type]
	[en]...[/en]
	
	@param sDragElementID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.getDragElementGrabMoveDistX = function(_sDragElementID)
	{
		_sDragElementID = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'sDragElementID', 'xParameter': _sDragElementID});

		var _iDragElementGrabMoveDistX = -1;
		var _iDragElementIndex = this.getDragElementIndex({'xDragElement': _sDragElementID});
		if ((_iDragElementIndex > -1) && (_iDragElementIndex < this.axDragElements.length))
		{
			_iDragElementGrabMoveDistX = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_GRABMOVEDISTX];
			if ((_iDragElementGrabMoveDistX == -1) || (_iDragElementGrabMoveDistX == null))
			{
				var _sDropAreaID = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_DROPAREAID];
				if (_sDropAreaID != '') {_iDragElementGrabMoveDistX = this.getDropAreaGrabMoveDistX({'sDropAreaID': _sDropAreaID});}
				
				if ((_iDragElementGrabMoveDistX == -1) || (_iDragElementGrabMoveDistX == null)) {_iDragElementGrabMoveDistX = this.iDefaultGrabMoveDistX;}
			}
		}
		return _iDragElementGrabMoveDistX;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iMoveDistY [type]int[/type]
	[en]...[/en]
	
	@param sDragElementID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.getDragElementGrabMoveDistY = function(_sDragElementID)
	{
		_sDragElementID = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'sDragElementID', 'xParameter': _sDragElementID});

		var _iDragElementGrabMoveDistY = -1;
		var _iDragElementIndex = this.getDragElementIndex({'xDragElement': _sDragElementID});
		if ((_iDragElementIndex > -1) && (_iDragElementIndex < this.axDragElements.length))
		{
			_iDragElementGrabMoveDistY = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_GRABMOVEDISTY];
			if ((_iDragElementGrabMoveDistY == -1) || (_iDragElementGrabMoveDistY == null))
			{
				var _sDropAreaID = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_DROPAREAID];
				if (_sDropAreaID != '') {_iDragElementGrabMoveDistY = this.getDropAreaGrabMoveDistY({'sDropAreaID': _sDropAreaID});}
				
				if ((_iDragElementGrabMoveDistY == -1) || (_iDragElementGrabMoveDistY == null)) {_iDragElementGrabMoveDistY = this.iDefaultGrabMoveDistY;}
			}
		}
		return _iDragElementGrabMoveDistY;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sDragElementID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.crabDragElement = function(_sDragElementID)
	{
		_sDragElementID = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'sDragElementID', 'xParameter': _sDragElementID});

		if (this.sDragElementMoveWithMouseID == '')
		{
			var _oDragElement = this.oDocument.getElementById(_sDragElementID);
			
			var _iDragElementIndex = this.getDragElementIndex({'xDragElement': _sDragElementID});
			if ((_oDragElement) && (_iDragElementIndex > -1) && (_iDragElementIndex < this.axDragElements.length))
			{
				this.iDragElementGrabDistX = this.getDragElementGrabMoveDistX({'sDragElementID': _sDragElementID});
				this.iDragElementGrabDistY = this.getDragElementGrabMoveDistY({'sDragElementID': _sDragElementID});
				
				this.iDragElementStartPosX = oPGBrowser.getDocumentOffsetX({'xElement': _sDragElementID});
				this.iDragElementStartPosY = oPGBrowser.getDocumentOffsetY({'xElement': _sDragElementID});
				
				this.iDragElementLastPosX = this.iDragElementStartPosX;
				this.iDragElementLastPosY = this.iDragElementStartPosY;
				if (typeof(oPGInput) != 'undefined')
				{
					this.iDragElementMouseDistX = oPGInput.getDocPosX()-this.iDragElementLastPosX;
					this.iDragElementMouseDistY = oPGInput.getDocPosY()-this.iDragElementLastPosY;
				}
				else if (typeof(oPGMouse) != 'undefined')
				{
					this.iDragElementMouseDistX = oPGMouse.getDocPosX()-this.iDragElementLastPosX;
					this.iDragElementMouseDistY = oPGMouse.getDocPosY()-this.iDragElementLastPosY;
				}
				else if (typeof(oPGTouchHandler) != 'undefined')
				{
					this.iDragElementMouseDistX = oPGTouchHandler.getDocPosX()-this.iDragElementLastPosX;
					this.iDragElementMouseDistY = oPGTouchHandler.getDocPosY()-this.iDragElementLastPosY;
				}

				if ((this.iDragElementGrabDistX > 0) || (this.iDragElementGrabDistY > 0)) {this.sDragElementWaitForGrabID = _sDragElementID;}
				else {this.realCrabDragElement({'sDragElementID': _sDragElementID});}
				oPGBrowser.disableSelect();
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sDragElementID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.realCrabDragElement = function(_sDragElementID)
	{
		_sDragElementID = this.getRealParameter({'oParameters': _sDragElementID, 'sName': 'sDragElementID', 'xParameter': _sDragElementID});

		if (this.sDragElementMoveWithMouseID == '')
		{
			var _oDragElement = this.oDocument.getElementById(_sDragElementID);
			
			var _iDragElementIndex = this.getDragElementIndex({'xDragElement': _sDragElementID});
			if ((_oDragElement) && (_iDragElementIndex > -1) && (_iDragElementIndex < this.axDragElements.length))
			{
				var _sDragElementID = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_ID];
				var _sDragElementAreaID = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_DROPAREAID];
				var _iDragElementType = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_TYPE];
				var _iDragElementCopyMode = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_COPYMODE];
				var _sDragElementOnGrab = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_ONGRAB];

				if (_iDragElementCopyMode == PG_DRAGANDDROP_ELEMENTCOPYMODE_COPYONDRAG)
				{
					this.sDragElementLastAreaID = _sDragElementAreaID;
					this.sDragElementMoveWithMouseID = _sDragElementID+'_Copy';
					this.sDragElementMoveCopyOfID = _sDragElementID;
					
					var _iDropAreaIndex = this.getDropAreaIndex({'xDropArea': _sDragElementAreaID});
					
					var _oDragElementCopy = this.oDocument.getElementById(_sDragElementID).cloneNode(true);
					
					_oDragElementCopy.setAttribute('id', _sDragElementID+'_Copy');
					_oDragElementCopy.style.position = 'absolute';
					_oDragElementCopy.style.float = 'none';
					_oDragElementCopy.style.zIndex = this.iDragElementZIndexOnCrab;

					_oDragElement.style.position = 'absolute';
					_oDragElement.style.float = 'none';
					
					this.iDragElementOffsetX = -Math.ceil(parseInt(_oDragElement.offsetWidth)/2);
					this.iDragElementOffsetY = -Math.ceil(parseInt(_oDragElement.offsetHeight)/2);
					
					_oDragElement.style.position = 'static';
					if ((_iDropAreaIndex > -1) && (_iDropAreaIndex < this.axDropAreas.length))
					{
						var _iDropContainerType = this.axDropAreas[_iDropAreaIndex][PG_DRAGANDDROP_DROPAREA_INDEX_TYPE];
						if (_iDropContainerType == PG_DROPAREA_TYPE_HORIZONTAL_LIST) {_oDragElement.style.float = 'left';}
						else {_oDragElement.style.float = 'none';}
					}
					else {_oDragElement.style.float = 'none';}
					
					this.setDragElementToMouse({'xDragElement': _sDragElementID+'_Copy'});
					this.oDocument.body.appendChild(_oDragElementCopy);
					
					var _iDragElementMouseOffsetDist = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_MOUSEOFFSETDIST];
					var _iDragElementKillMode = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_KILLMODE];
					var _iDragElementGroupID = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_GROUPID];
					var _xDragElementData = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_DATA];
					
					this.registerDragElement(
						{
							'sDragElementID': _sDragElementID+'_Copy', 
							'iDragElementType': _iDragElementType, 
							'sGroupID': _iDragElementGroupID, 
							'iAreaID': _sDragElementAreaID, 
							'iMouseOffsetDist': _iDragElementMouseOffsetDist, 
							'iElementKillMode': _iDragElementKillMode, 
							'iElementCopyMode': _iDragElementCopyMode, 
							'axData': _xDragElementData
						}
					);
				}
				else
				{
					this.sDragElementLastAreaID = _sDragElementAreaID;
					this.sDragElementMoveWithMouseID = _sDragElementID;
					this.sDragElementMoveCopyOfID = '';
					
					_oDragElement.style.position = 'absolute';
					_oDragElement.style.float = 'none';
					_oDragElement.style.zIndex = this.iDragElementZIndexOnCrab;
					
					this.iDragElementOffsetX = -Math.ceil(parseInt(_oDragElement.offsetWidth)/2);
					this.iDragElementOffsetY = -Math.ceil(parseInt(_oDragElement.offsetHeight)/2);

					this.setDragElementToMouse({'xDragElement': _sDragElementID});
					this.oDocument.body.appendChild(_oDragElement);
				}
				
				if (_sDragElementOnGrab != null) {eval(_sDragElementOnGrab);}
			}
		}
	}
	/* @end method */

	/* @start method */
	this.placeDragElement = function()
	{
		if (this.sDragElementMoveWithMouseID != '')
		{
			if (this.isDebugMode({'iMode': PG_DEBUG_HIGH})) {alert("placeDragElement()");}
			var _sElementID = this.sDragElementMoveWithMouseID;
			var _sElementCopyID = this.sDragElementMoveWithMouseID;
			if (this.sDragElementMoveCopyOfID != '') {_sElementCopyID = this.sDragElementMoveCopyOfID;}
			var _iDragElementIndex = this.getDragElementIndex({'xDragElement': _sElementID});

			if ((_iDragElementIndex > -1) && (_iDragElementIndex < this.axDragElements.length))
			{
				var _sDropAreaID = '';
				var _sDropAreaOnDrop = '';
				var _iDropAreaGroupID = 0;
				var _oDropAreaGroup = null;
				var _sDragElementOnDrop = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_ONDROP];
				var _iDragElementGroupID = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_GROUPID];
				
				if (_iDragElementGroupID == PG_DRAGANDDROP_GROUP_DOCUMENT_ONLY)
				{
					this.dropElementInDocument({'xDragElement': this.sDragElementMoveWithMouseID, 'iPosX': null, 'iPosY': null});
					this.sDragElementMoveWithMouseID = '';
					this.sDragElementLastAreaID = '';
				}
				else
				{
					var _iDropAreaIndex = -1;
					for (var i=0; i<this.axDropAreas.length; i++)
					{
						if (this.axDropAreas[i] != null)
						{
							_iDropAreaGroupID = this.axDropAreas[i][PG_DRAGANDDROP_DROPAREA_INDEX_GROUPID];
							if ((this.isMouseOverDropArea({'sDropAreaID': this.axDropAreas[i][PG_DRAGANDDROP_DROPAREA_INDEX_ID]}))
							&& ((_iDropAreaGroupID == _iDragElementGroupID) || (_iDropAreaGroupID == PG_DRAGANDDROP_GROUP_ALL)
							|| (_iDragElementGroupID == PG_DRAGANDDROP_GROUP_ALL) || (_iDragElementGroupID == PG_DRAGANDDROP_GROUP_DOCUMENT_ALL)))
							{
								_sDropAreaID = this.axDropAreas[i][PG_DRAGANDDROP_DROPAREA_INDEX_ID];
								_sDropAreaOnDrop = this.axDropAreas[i][PG_DRAGANDDROP_DROPAREA_INDEX_ONDROP];
								_iDropAreaIndex = i;
							}
						}
					}
					
					var _iDropAreaMaxElements = 0;
					var _iDragElementKillMode = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_KILLMODE];
					if ((_iDropAreaIndex > -1) && (_iDropAreaIndex < this.axDropAreas.length))
					{
						_iDropAreaMaxElements = this.axDropAreas[_iDropAreaIndex][PG_DRAGANDDROP_DROPAREA_INDEX_MAXELEMENTS];
						if (_iDropAreaMaxElements > 0)
						{
							var _asDragElementIDs = this.getElementIDsInArea({'xDropArea': _iDropAreaIndex});
							if (_asDragElementIDs.length >= _iDropAreaMaxElements) {_sDropAreaID = '';}
						}
					}
					
					if ((_sDropAreaID != '') && (_sDropAreaID != null))
					{
						if ((_iDragElementKillMode == PG_DRAGANDDROP_ELEMENTKILLMODE_ONDROPINAREA)
						|| (_iDragElementKillMode == PG_DRAGANDDROP_ELEMENTKILLMODE_ONRELEASE))
						// if (_iDragElementKillMode == PG_DRAGANDDROP_ELEMENTKILLMODE_ONRELEASE)
						{
							this.removeDragElement({'sDragElementID': _sElementID});
						}
						else {this.dropElemetInArea({'xDropArea': _sDropAreaID, 'xDragElement': this.sDragElementMoveWithMouseID, 'iPosX': null, 'iPosY': null});}
						if (_sDropAreaOnDrop != null) {eval(_sDropAreaOnDrop);}
						if (_sDragElementOnDrop != null) {eval(_sDragElementOnDrop);}
						this.sDragElementMoveWithMouseID = '';
						this.sDragElementLastAreaID = '';
						this.sDragElementMoveCopyOfID = '';
					}
					else
					{
						if (_iDropAreaGroupID == PG_DRAGANDDROP_GROUP_DOCUMENT_ALL)
						{
							this.dropElementInDocument(this.sDragElementMoveWithMouseID, null, null);
							if (_sDragElementOnDrop != null) {eval(_sDragElementOnDrop);}
							this.sDragElementMoveWithMouseID = '';
							this.sDragElementLastAreaID = '';
							this.sDragElementMoveCopyOfID = '';
						}
						else
						{
							if (_iDragElementKillMode == PG_DRAGANDDROP_ELEMENTKILLMODE_ONRELEASE)
							{
								this.removeDragElement({'sDragElementID': _sElementID});
							}
							else if (this.sDragElementLastAreaID != '') {this.dropElemetInArea({'xDropArea': this.sDragElementLastAreaID, 'xDragElement': this.sDragElementMoveWithMouseID, 'iPosX': this.iDragElementLastPosX, 'iPosY': this.iDragElementLastPosY});}
							if (_sDragElementOnDrop != null) {eval(_sDragElementOnDrop);}
							this.sDragElementMoveWithMouseID = '';
							this.sDragElementLastAreaID = '';
							this.sDragElementMoveCopyOfID = '';
						}
					}
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param eEvent [type]object[/type]
	[en]...[/en]
	*/
	this.onMouseUp = function(_eEvent)
	{
		if (this.sDragElementMoveWithMouseID != '')
		{
			var _sElementCopyID = this.sDragElementMoveWithMouseID;
			if (this.sDragElementMoveCopyOfID != '') {_sElementCopyID = this.sDragElementMoveCopyOfID;}
			var _iDragElementIndex = this.getDragElementIndex({'xDragElement': _sElementCopyID});
			
			if ((_iDragElementIndex > -1) && (_iDragElementIndex < this.axDragElements.length))
			{
				var _iMouseButton = oPGMouse.getMouseButtonFromEvent(_eEvent);
				var _iDragElementType = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_TYPE];
				if ((_iDragElementType == PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSEHOLD)
				|| ((_iDragElementType == PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSELEFTHOLD) && (_iMouseButton == PG_MOUSE_BUTTON_LEFT))
				|| ((_iDragElementType == PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSERIGHTHOLD) && (_iMouseButton == PG_MOUSE_BUTTON_RIGHT)))
				{
					this.placeDragElement();
					oPGBrowser.enableSelect();
					if ((_iDragElementType == PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSEHOLD)
					|| ((_iDragElementType == PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSERIGHTHOLD) && (_iMouseButton == PG_MOUSE_BUTTON_RIGHT)))
					{
						oPGInput.preventDefaultPress(_eEvent);
						return false;
					}
				}
			}
		}
		this.sDragElementWaitForGrabID = '';
	}
	/* @end method */
	this.onInputRelease = this.onMouseUp;
	
	/*
	@start method
	
	@param eEvent [type]object[/type]
	[en]...[/en]
	*/
	this.onClick = function(_eEvent)
	{
		if (this.bDragElementGrabedClick == true) {this.bDragElementGrabedClick = false;}
		else
		{
			if (this.sDragElementMoveWithMouseID != '')
			{
				var _sElementCopyID = this.sDragElementMoveWithMouseID;
				if (this.sDragElementMoveCopyOfID != '') {_sElementCopyID = this.sDragElementMoveCopyOfID;}
				var _iDragElementIndex = this.getDragElementIndex({'xDragElement': _sElementCopyID});
			
				if ((_iDragElementIndex > -1) && (_iDragElementIndex < this.axDragElements.length))
				{
					var _iDragElementType =  this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_TYPE];
					if (_iDragElementType == PG_DRAGELEMENT_TYPE_DRAGABLE_ONCLICK)
					{
						this.placeDragElement();
						oPGBrowser.enableSelect();
					}
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param eEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onInputMove = function(_oEvent)
	{
		if (this.sDragElementMoveWithMouseID != '')
		{
			this.setDragElementToMouse({'xDragElement': this.sDragElementMoveWithMouseID});
		}
		else if (this.sDragElementWaitForGrabID != '')
		{
			var _iInputPosX = oPGInput.getDocPosX();
			var _iInputPosY = oPGInput.getDocPosY();
			if
			(
				(this.iDragElementGrabDistX <= Math.abs(_iInputPosX-this.iDragElementStartPosX-this.iDragElementMouseDistX))
				|| (this.iDragElementGrabDistY <= Math.abs(_iInputPosY-this.iDragElementStartPosY-this.iDragElementMouseDistY))
			)
			{
				var _sDragElementID = this.sDragElementWaitForGrabID;
				this.sDragElementWaitForGrabID = '';
				this.realCrabDragElement({'sDragElementID': _sDragElementID});
			}
		}
	}
	/* @end method */
	this.onMouseMove = this.onInputMove;
	
	/*
	@start method
	
	@param eEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onContextMenu = function(_eEvent)
	{
		if (this.bDragElementGrabedHoldRight == true)
		{
			this.bDragElementGrabedHoldRight = false;
			oPGInput.preventDefaultPress(_eEvent);
			return false;
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param xDragElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.setDragElementToMouse = function(_xDragElement)
	{
		_xDragElement = this.getRealParameter({'oParameters': _xDragElement, 'sName': 'xDragElement', 'xParameter': _xDragElement});

		if (typeof(oPGInput) != 'undefined')
		{
			var _iDragElementIndex = this.getDragElementIndex({'xDragElement': _xDragElement});
			if (_iDragElementIndex > -1)
			{
				var _sDragElementID = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_ID];
				var _sElementToMoveID = _sDragElementID;
				var _sElementSettingsID = _sDragElementID;
				if (this.sDragElementMoveCopyOfID != '') {_sElementSettingsID = this.sDragElementMoveCopyOfID;}
				
				var _oDragElement = this.oDocument.getElementById(_sDragElementID);
				if ((_oDragElement) && (_iDragElementIndex > -1) && (_iDragElementIndex < this.axDragElements.length))
				{
					var _iNewPosX = oPGInput.getDocPosX();
					var _iNewPosY = oPGInput.getDocPosY();
					var _iMouseOffsetDist = this.axDragElements[_iDragElementIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_MOUSEOFFSETDIST];
					
					if (_iMouseOffsetDist > 0)
					{
						_iNewPosX += _iMouseOffsetDist;
						_iNewPosY += _iMouseOffsetDist;
					}
					else if (_iMouseOffsetDist == PG_DRAGANDDROP_MOUSEOFFSETDIST_EXACT_POSITION)
					{
						_iNewPosX -= this.iDragElementMouseDistX;
						_iNewPosY -= this.iDragElementMouseDistY;
					}
					else
					{
						_iNewPosX += this.iDragElementOffsetX;
						_iNewPosY += this.iDragElementOffsetY;
					}
					
					_oDragElement.style.left = _iNewPosX+'px';
					_oDragElement.style.top = _iNewPosY+'px';
				}
			}
		}
	}
	/* @end method */
}
/* @end class */
classPG_DragAndDrop.prototype = new classPG_ClassBasics();
var oPGDragAndDrop = new classPG_DragAndDrop();
