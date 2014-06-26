/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 23 2012
*/
var PG_CONTEXT_MENU_MENUPOINT_INDEX_NAME = 0;
var PG_CONTEXT_MENU_MENUPOINT_INDEX_FUNCTION = 1;

// if (window.document.captureEvents) {document.captureEvents(Event.MOUSEDOWN);}

/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_ContextMenu()
{
	// Declarations...
	this.sContainerID = '';
	this.sCategoryCssClass = '';
	this.sCategoryCssStyle = '';
	this.sMenuPointCssClass = '';
	this.sMenuPointCssStyle = '';
	this.sOperaContextString = '';
	this.asCategory = new Array();
	this.axMenuPoint = new Array();
	
	// Construct...
	this.setID({'sID': 'PGContextMenu'});
	this.initClassBasics();
	
	// Methods...
	/*
	@start method
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setOperaContextString = function(_sString)
	{
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		this.sOperaContextString = _sString;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sClass [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCategoryCssClass = function(_sClass)
	{
		_sClass = this.getRealParameter({'oParameters': _sClass, 'sName': 'sClass', 'xParameter': _sClass});
		this.sCategoryCssClass = _sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssClass [type]string[/type]
	[en]...[/en]
	*/
	this.getCategoryCssClass = function() {return this.sCategoryCssClass;}
	/* @end method */
	
	/*
	@start method
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCategoryCssStyle = function(_sStyle)
	{
		_sStyle = this.getRealParameter({'oParameters': _sStyle, 'sName': 'sStyle', 'xParameter': _sStyle});
		this.sCategoryCssStyle = _sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	this.getCategoryCssStyle = function() {return this.sCategoryCssStyle;}
	/* @end method */
	
	/*
	@start method
	
	@param sClass [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setMenuPoinCssClass = function(_sClass)
	{
		_sClass = this.getRealParameter({'oParameters': _sClass, 'sName': 'sClass', 'xParameter': _sClass});
		this.sMenuPointCssClass = '';
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssClass [type]string[/type]
	[en]...[/en]
	*/
	this.getMenuPoinCssClass = function() {return this.sMenuPointCssClass;}
	/* @end method */
	
	/*
	@start method
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setMenuPointCssStyle = function(_sStyle)
	{
		_sStyle = this.getRealParameter({'oParameters': _sStyle, 'sName': 'sStyle', 'xParameter': _sStyle});
		this.sMenuPointCssStyle = _sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	this.getMenuPointCssStyle = function() {return this.sMenuPointCssStyle;}
	/* @end method */
	
	/*
	@start method
	
	@param xContainer [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sContextMenuID [type]string[/type]
	[en]...[/en]
	
	@param iZIndex [type]int[/type]
	[en]...[/en]
	*/
	this.buildInto = function(_xContainer, _sContextMenuID, _iZIndex)
	{
		if (typeof(_sContextMenuID) == 'undefined') {var _sContextMenuID = null;}
		if (typeof(_iZIndex) == 'undefined') {var _iZIndex = null;}

		_sContextMenuID = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sContextMenuID', 'xParameter': _sContextMenuID});
		_iZIndex = this.getRealParameter({'oParameters': _xContainer, 'sName': 'iZIndex', 'xParameter': _iZIndex});
		_xContainer = this.getRealParameter({'oParameters': _xContainer, 'sName': 'xContainer', 'xParameter': _xContainer, 'bNotNull': true});
		
		var _sHTML = this.build({'sContextMenuID': _sContextMenuID, 'iZIndex': _iZIndex});
		
		if (_xContainer == null) {_xContainer = this.oDocument.body;}
		if (_xContainer != null)
		{
			var _oContainer = this.getContainerObject({'xContainer': _xContainer});
			if (_oContainer) {_oContainer.innerHTML += _sHTML;}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@return sContextHtml [type]string[/type]
	[en]...[/en]
	
	@param sContextMenuID [type]string[/type]
	[en]...[/en]
	
	@param iZIndex [type]int[/type]
	[en]...[/en]
	*/
	this.build = function(_sContextMenuID, _iZIndex)
	{
		if (typeof(_sContextMenuID) == 'undefined') {var _sContextMenuID = null;}
		if (typeof(_iZIndex) == 'undefined') {var _iZIndex = null;}

		_iZIndex = this.getRealParameter({'oParameters': _sContextMenuID, 'sName': 'iZIndex', 'xParameter': _iZIndex});
		_sContextMenuID = this.getRealParameter({'oParameters': _sContextMenuID, 'sName': 'sContextMenuID', 'xParameter': _sContextMenuID});
		
		if (_sContextMenuID == null) {_sContextMenuID = this.getID();}
		else {this.setID({'sID': _sContextMenuID});}
		if (_iZIndex == null) {_iZIndex = 100000;}
		
		var i=0;
		var t=0;
		var _sHTML = '';
		
		_sHTML += '<div id="'+_sContextMenuID+'" style="position:absolute; display:none; z-index:'+_iZIndex+';">';
		_sHTML += '<table style="border-width:0px;" ';
		_sHTML += 'onmousedown="return oPGContextMenu.preventDefault(event);" ';
		_sHTML += 'onmouseup="return oPGContextMenu.preventDefault(event);" ';
		_sHTML += 'onclick="return oPGContextMenu.preventDefault(event);" ';
		_sHTML += 'oncontextmenu="return oPGContextMenu.preventDefault(event);" ';
		_sHTML += 'cellpadding="0" cellspacing="0">';
		for(i=0; i<this.asCategory.length; i++)
		{
			if (this.asCategory[i] != null)
			{
				_sHTML += '<tr>';
					_sHTML += '<td ';
					_sHTML += 'onmousedown="return oPGContextMenu.preventDefault(event);" ';
					_sHTML += 'onmouseup="return oPGContextMenu.preventDefault(event);" ';
					_sHTML += 'onclick="return oPGContextMenu.preventDefault(event);" ';
					_sHTML += 'oncontextmenu="return oPGContextMenu.preventDefault(event);" ';
					if (this.sCategoryCssClass != '') {_sHTML += 'class="'+this.sCategoryCssClass+'" ';}
					else if (this.sCategoryCssStyle != '') {_sHTML += 'style="'+this.sCategoryCssStyle+'" ';}
					else {_sHTML += 'style="background-color:#CCCCCC; color:#000000;" ';}
					_sHTML += '>';
					_sHTML += '<b><nobr>'+this.asCategory[i]+'</nobr></b>';
					_sHTML += '</td>';
				_sHTML += '</tr>';
				if (this.axMenuPoint.length > i)
				{
					for (t=0; t<this.axMenuPoint[i].length; t++)
					{
						if (this.axMenuPoint[i][t] != null)
						{
							if (this.axMenuPoint[i][t][PG_CONTEXT_MENU_MENUPOINT_INDEX_NAME] != null)
							{
								_sHTML += '<tr>';
									_sHTML += '<td ';
									_sHTML += 'onmousedown="return oPGContextMenu.preventDefault(event);" ';
									_sHTML += 'onmouseup="return oPGContextMenu.preventDefault(event);" ';
									_sHTML += 'onclick="return oPGContextMenu.preventDefault(event);" ';
									_sHTML += 'oncontextmenu="return oPGContextMenu.preventDefault(event);" ';
									if (this.sMenuPointCssClass != '') {_sHTML += 'class="'+this.sMenuPointCssClass+'" ';}
									else if (this.sMenuPointCssStyle != '') {_sHTML += 'style="'+this.sMenuPointCssStyle+'" ';}
									else {_sHTML += 'style="background-color:#EEEEEE; padding-left:10px; padding-right:0px; padding-top:0px; padding-bottom:0px;" ';}
									_sHTML += '>';
									_sHTML += '<a href="javascript:;" onclick="';
									_sHTML += this.axMenuPoint[i][t][PG_CONTEXT_MENU_MENUPOINT_INDEX_FUNCTION];
									_sHTML += '" target="_self">';
									_sHTML += '<nobr>';
									_sHTML += this.axMenuPoint[i][t][PG_CONTEXT_MENU_MENUPOINT_INDEX_NAME];
									_sHTML += '</nobr>';
									_sHTML += '</a>';
									_sHTML += '</td>';
								_sHTML += '</tr>';
							}
						}
					}
				}
			}
		}
		_sHTML += '</table>';
		_sHTML += '</div>';
		
		return _sHTML;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bFalse [type]bool[/type]
	[en]...[/en]
	
	@param eEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.preventDefault = function(_oEvent)
	{
		_oEvent = this.getRealParameter({'oParameters': _oEvent, 'sName': 'oEvent', 'xParameter': _oEvent});

		if (!_oEvent) {_oEvent = window.event;}
		if (typeof(_oEvent) != 'undefined')
		{
			if (_oEvent.preventDefault)
			{
				_oEvent.preventDefault();
				_oEvent.stopPropagation();
			}
			else
			{
				_oEvent.returnValue = false;
				_oEvent.cancelBubble = true;
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@param eEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onRelease = function(_oEvent)
	{
		_oEvent = this.getRealParameter({'oParameters': _oEvent, 'sName': 'oEvent', 'xParameter': _oEvent});

		var _bHide = true;
		if (!_oEvent) {_oEvent = window.event;}
  		if (_oEvent.type) {if (_oEvent.type == "contextmenu") {_bHide = false;}}
		if (_oEvent.button) {if (_oEvent.button == 2) {_bHide = false;}}
		if (_oEvent.which) {if (_oEvent.which == 3) {_bHide = false;}}
		if (_bHide == true) {this.hide();}
	}
	this.onMouseUp = this.onRelease;
	/* @end method */
	
	/*
	@start method
	
	@return bFalse [type]bool[/type]
	[en]...[/en]
	
	@param eEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onContextMenu = function(_oEvent)
	{
		_oEvent = this.getRealParameter({'oParameters': _oEvent, 'sName': 'oEvent', 'xParameter': _oEvent});
		// this.show();
		// this.setPos(oPGMouse.getPosX(), oPGMouse.getPosY());
		this.preventDefault(_oEvent);
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@param eEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onPress = function(_oEvent)
	{
		_oEvent = this.getRealParameter({'oParameters': _oEvent, 'sName': 'oEvent', 'xParameter': _oEvent});

		var _bShowContextMenu = false;
		if (!_oEvent) {_oEvent = window.event;}
		if (_oEvent.button) {if (_oEvent.button == 2) {_bShowContextMenu = true}}
  		if (_oEvent.type) {if (_oEvent.type == "contextmenu") {_bShowContextMenu = true;}}
		else if (_oEvent.which) {if (_oEvent.which == 3) {_bShowContextMenu = true;}}
		if (_bShowContextMenu == true)
		{
			this.show();
			this.setPos(oPGMouse.getPosX(), oPGMouse.getPosY());
			// if (window.opera) {alert(this.sOperaContextString);}
			this.preventDefault(_oEvent);
			return false;
		}
	}
	this.onMouseDown = this.onPress;
	/* @end method */

	/*
	@start method
	
	@param iPosX [type]int[/type]
	[en]...[/en]
	
	@param iPosY [type]int[/type]
	[en]...[/en]
	*/
	this.setPos = function(_iPosX, _iPosY)
	{
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}
	
		_iPosY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosY', 'xParameter': _iPosY});
		_iPosX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosX', 'xParameter': _iPosX});

		var _oContextMenu = this.oDocument.getElementById(this.getID());
		if (_oContextMenu)
		{
			var _oScreenSize = oPGBrowser.getScreenSize();
			var _oScrollPos = oPGBrowser.getScrollPos();
			var _iContextMenuSizeX = parseInt(_oContextMenu.offsetWidth);
			var _iContextMenuSizeY = parseInt(_oContextMenu.offsetHeight);
			if (_iPosX+_iContextMenuSizeX-_oScrollPos.x > _oScreenSize.x) {_iPosX -= _iContextMenuSizeX;}
			if (_iPosY+_iContextMenuSizeY-_oScrollPos.y > _oScreenSize.y) {_iPosY -= _iContextMenuSizeY;}
			_oContextMenu.style.left = _iPosX+'px';
			_oContextMenu.style.top = _iPosY+'px';
		}
	}
	/* @end method */
	
	/* @start method */
	this.toggle = function()
	{
		var _oContextMenu = this.oDocument.getElementById('PG_Context_Menu_'+this.getID());
		if (_oContextMenu)
		{
			if (_oContextMenu.style.display == 'none') {this.show();}
			else {this.hide();}
		}
	}
	/* @end method */

	/* @start method */
	this.show = function()
	{
		var _oContextMenu = this.oDocument.getElementById(this.getID());
		if (_oContextMenu)
		{
			_oContextMenu.innerHTML += this.build();
			_oContextMenu.style.display = 'block';
		}
	}
	/* @end method */

	/* @start method */
	this.hide = function()
	{
		var _oContextMenu = this.oDocument.getElementById(this.getID());
		if (_oContextMenu) {_oContextMenu.style.display = 'none';}
	}
	/* @end method */
	
	/*
	@start method
	
	@return iCategoryIndex [type]int[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	*/
	this.addCategory = function(_sName)
	{
		_sName = this.getRealParameter({'oParameters': _sName, 'sName': 'sName', 'xParameter': _sName});

		this.asCategory.push(_sName);
		this.axMenuPoint.push(new Array());
		return this.asCategory.length-1;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param xCategory [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.removeCategory = function(_xCategory)
	{
		_xCategory = this.getRealParameter({'oParameters': _xCategory, 'sName': 'xCategory', 'xParameter': _xCategory});
		
		var _iCategoryID = this.getCategoryIndex({'xCategory': _xCategory});
		if (_iCategoryID > -1)
		{
			if (this.axMenuPoint.length > _iCategoryID)
			{
				for (t=0; t<this.axMenuPoint[_iCategoryID].length; t++)
				{
					this.axMenuPoint[_iCategoryID][t][PG_CONTEXT_MENU_MENUPOINT_INDEX_NAME] = null;
					this.axMenuPoint[_iCategoryID][t][PG_CONTEXT_MENU_MENUPOINT_INDEX_FUNCTION] = null;
					// delete this.axMenuPoint[_iCategoryID];
					this.axMenuPoint[_iCategoryID][t] = null;
				}
				// this.axMenuPoint[_iCategoryID] = null;
			}
			this.asCategory[_iCategoryID] = null;
			return true;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iIndex [type]int[/type]
	[en]...[/en]
	
	@param xCategory [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getCategoryIndex = function(_xCategory)
	{
		_xCategory = this.getRealParameter({'oParameters': _xCategory, 'sName': 'xCategory', 'xParameter': _xCategory});

		var i = 0;
		switch (typeof(_xCategory))
		{
			case 'number':	// _xCategory is _iCategoryIndex
				if ((_xCategory >= 0) && (_xCategory < this.asCategory.length)) {return _xCategory;}
			break;

			case 'string':	// _xCategory is _sCategoryName
				for (i=0; i<this.asCategory.length; i++)
				{
					if (this.asCategory[i] != null)
					{
						if (this.asCategory[i].sID == _xCategory) {return i;}
					}
				}
			break;
		}
		return -1;
	}
	/* @end method */

	/*
	@start method
	
	@return axMenuPount [type]mixed[][/type]
	[en]...[/en]
	
	@param xCategory [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param sFunction [needed][type]string[/type]
	[en]...[/en]
	*/
	this.addMenuPoint = function(_xCategory, _sName, _sFunction)
	{
		_sName = this.getRealParameter({'oParameters': _xCategory, 'sName': 'sName', 'xParameter': _sName});
		_sFunction = this.getRealParameter({'oParameters': _xCategory, 'sName': 'sFunction', 'xParameter': _sFunction});
		_xCategory = this.getRealParameter({'oParameters': _xCategory, 'sName': 'xCategory', 'xParameter': _xCategory});

		var _iCategoryID = this.getCategoryIndex({'xCategory': _xCategory});
		if (_iCategoryID > -1)
		{
			this.axMenuPoint[_iCategoryID].push(new Array(_sName, _sFunction));
			return this.axMenuPoint[_iCategoryID].length-1;
		}
		return false;
	}
	/* @end method */
}
/* @end class */
classPG_ContextMenu.prototype = new classPG_ClassBasics();
var oPGContextMenu = new classPG_ContextMenu();
