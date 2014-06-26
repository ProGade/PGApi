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
function classPG_Tabs()
{
	// Declarations...
	this.sTabsCssStylePressed = 'background-color:#aaaaaa;';
	this.sTabsCssStyleNormal = 'background-color:#888888;';
	this.sTabsCssStyleBasics = 'display:inline-block; padding:5px; cursor:default; border-radius:10px 10px 0px 0px;';
	
	this.sMoveTabID = '';
	this.sCreateNewTabsNearTabsID = '';
	this.asTabsIDs = new Array();
	
	// Construct...
	this.setID({'sID': 'PGTabs'});
	this.initClassBasics();
	
	// Methods...
	/*
	@start method
	
	@param sTabsID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.registerTabs = function(_sTabsID)
	{
		_sTabsID = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sTabsID', 'xParameter': _sTabsID});
		this.asTabsIDs.push(_sTabsID);
	}
	/* @end method */
	
	/*
	@start method
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setTabsCssStylePressed = function(_sStyle)
	{
		_sStyle = this.getRealParameter({'oParameters': _sStyle, 'sName': 'sStyle', 'xParameter': _sStyle});
		this.sTabsCssStylePressed = _sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	this.getTabsCssStylePressed = function() {return this.sTabsCssStylePressed;}
	/* @end method */
	
	/*
	@start method
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setTabsCssStyleNormal = function(_sStyle)
	{
		_sStyle = this.getRealParameter({'oParameters': _sStyle, 'sName': 'sStyle', 'xParameter': _sStyle});
		this.sTabsCssStyleNormal = _sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	this.getTabsCssStyleNormal = function() {return this.sTabsCssStyleNormal;}
	/* @end method */

	/*
	@start method
	
	@param sTabID [needed][type]string[/type]
	[en]...[/en]
	
	@param sSizeX [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setSizeX = function(_sTabsID, _sSizeX)
	{
		if (typeof(_sSizeX) == 'undefined') {var _sSizeX = null;}

		_sSizeX = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sSizeX', 'xParameter': _sSizeX});
		_sTabsID = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sTabsID', 'xParameter': _sTabsID});
		
		var _oTabs = this.oDocument.getElementById(_sTabsID);
		if (_oTabs)
		{
			_oTabs.style.width = _sSizeX;
			this.recalculateElements({'sTabsID': _sTabsID});
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sTabID [needed][type]string[/type]
	[en]...[/en]
	
	@param sSizeY [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setSizeY = function(_sTabsID, _sSizeY)
	{
		if (typeof(_sSizeY) == 'undefined') {var _sSizeY = null;}

		_sSizeY = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sSizeY', 'xParameter': _sSizeY});
		_sTabsID = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sTabsID', 'xParameter': _sTabsID});
		
		var _oTabs = this.oDocument.getElementById(_sTabsID);
		if (_oTabs)
		{
			_oTabs.style.height = _sSizeY;
			this.recalculateElements({'sTabsID': _sTabsID});
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sTabID [needed][type]string[/type]
	[en]...[/en]
	
	@param sSizeX [type]string[/type]
	[en]...[/en]
	
	@param sSizeY [type]string[/type]
	[en]...[/en]
	*/
	this.setSize = function(_sTabsID, _sSizeX, _sSizeY)
	{
		if (typeof(_sSizeX) == 'undefined') {var _sSizeX = null;}
		if (typeof(_sSizeY) == 'undefined') {var _sSizeY = null;}

		_sSizeX = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sSizeX', 'xParameter': _sSizeX});
		_sSizeY = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sSizeY', 'xParameter': _sSizeY});
		_sTabsID = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sTabsID', 'xParameter': _sTabsID});
		
		var _oTabs = this.oDocument.getElementById(_sTabsID);
		if (_oTabs)
		{
			if (_sSizeX != null) {_oTabs.style.width = _sSizeX;}
			if (_sSizeY != null) {_oTabs.style.height = _sSizeY;}
			this.recalculateElements({'sTabsID': _sTabsID});
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@return iSizeX [type]int[/type]
	[en]...[/en]
	
	@param sTabID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.getSizeX = function(_sTabsID)
	{
		_sTabsID = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sTabsID', 'xParameter': _sTabsID});
		var _oTabs = this.oDocument.getElementById(_sTabsID);
		if (_oTabs) {return parseInt(_oTabs.offsetWidth);}
		return 0;
	}
	/* @end method */
	
	/*
	@start method

	@return iSizeY [type]int[/type]
	[en]...[/en]
	
	@param sTabID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.getSizeY = function(_sTabsID)
	{
		_sTabsID = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sTabsID', 'xParameter': _sTabsID});
		var _oTabs = this.oDocument.getElementById(_sTabsID);
		if (_oTabs) {return parseInt(_oTabs.offsetHeight);}
		return 0;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sTabID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.recalculateElements = function(_sTabsID)
	{
		_sTabsID = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sTabsID', 'xParameter': _sTabsID});
		
		// var _sFrameID = '';
		var _axTabData = '';
		var _iTabBarSizeY = 25;
		var _oTabBar = this.oDocument.getElementById(_sTabsID+'Tabbar');
		if (_oTabBar) {_iTabBarSizeY = oPGBrowser.getSizeY({'xElement': _oTabBar});}
		var _asDragElementIDs = oPGDragAndDrop.getElementIDsInArea({'xDropArea': _oTabBar});
		var _iTabsSizeX = this.getSizeX({'sTabsID': _sTabsID});
		var _iTabsSizeY = this.getSizeY({'sTabsID': _sTabsID});
		for (var i=0; i<_asDragElementIDs.length; i++)
		{
			_axTabData = oPGDragAndDrop.getDragElementData({'xDragElement': _asDragElementIDs[i]});
			oPGFrame.setSize({'sFrameID': _axTabData['sFrameID'], 'sSizeX': _iTabsSizeX+'px', 'sSizeY': (_iTabsSizeY-_iTabBarSizeY)+'px'});
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sTabID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.onTabMouseUp = function(_sTabID)
	{
		_sTabID = this.getRealParameter({'oParameters': _sTabID, 'sName': 'sTabID', 'xParameter': _sTabID});
		
		var _axTabData = null;
		var _axDropElementStructure = oPGDragAndDrop.getDragElementStructure({'xDragElement': _sTabID});
		var _sTabsID = _axDropElementStructure[PG_DRAGANDDROP_DRAGELEMENT_INDEX_DROPAREAID].replace("Tabbar", "");

		var _sFrameID = '';
		var _asDragElementIDs = oPGDragAndDrop.getElementIDsInArea({'xDropArea': _sTabsID+'Tabbar'});
		for (var i=0; i<_asDragElementIDs.length; i++)
		{
			_axTabData = oPGDragAndDrop.getDragElementData({'xDragElement': _asDragElementIDs[i]});
			oPGFrame.hide({'sFrameID': _axTabData['sFrameID']});
			oPGCss.setStyle({'xElement': _asDragElementIDs[i], 'xStyle': this.sTabsCssStyleNormal+' '+this.sTabsCssStyleBasics});
		}
		_axTabData = oPGDragAndDrop.getDragElementData({'xDragElement': _sTabID});
		oPGFrame.show({'sFrameID': _axTabData['sFrameID']});
		oPGCss.setStyle({'xElement': _sTabID, 'xStyle': this.sTabsCssStylePressed+' '+this.sTabsCssStyleBasics});
	}
	/* @end method */
	
	/*
	@start method
	
	@param sTabID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.onTabGrab = function(_sTabID)
	{
		_sTabID = this.getRealParameter({'oParameters': _sTabID, 'sName': 'sTabID', 'xParameter': _sTabID});
		
		this.sMoveTabID = _sTabID;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sTabID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.onTabDrop = function(_sTabID)
	{
		_sTabID = this.getRealParameter({'oParameters': _sTabID, 'sName': 'sTabID', 'xParameter': _sTabID});
		
		var _axDropElementStructure = oPGDragAndDrop.getDragElementStructure({'xDragElement': _sTabID});
		var _sTabsID = _axDropElementStructure[PG_DRAGANDDROP_DRAGELEMENT_INDEX_DROPAREAID].replace("Tabbar", "");
		if (this.sCreateNewTabsNearTabsID != '')
		{
			var _iInputPosX = oPGInput.getDocPosX();
			var _iInputPosY = oPGInput.getDocPosY();
			var _iTabsPosX = oPGBrowser.getDocumentOffsetX({'xElement': this.sCreateNewTabsNearTabsID});
			var _iTabsPosY = oPGBrowser.getDocumentOffsetY({'xElement': this.sCreateNewTabsNearTabsID});
			var _iTabsSizeX = oPGBrowser.getSizeX({'xElement': this.sCreateNewTabsNearTabsID});
			var _iTabsSizeY = oPGBrowser.getSizeY({'xElement': this.sCreateNewTabsNearTabsID});
			var _iTabBarSizeY = 25;

			_oTabBar = this.oDocument.getElementById(this.sCreateNewTabsNearTabsID+'Tabbar');
			if (_oTabBar) {_iTabBarSizeY = oPGBrowser.getSizeY({'xElement': _oTabBar});}

			if (oPGBrowser.rectContains({'iPosX': _iInputPosX, 'iPosY': _iInputPosY, 'iRectPosX': _iTabsPosX, 'iRectPosY': _iTabsPosY+_iTabBarSizeY, 'iRectSizeX': 50, 'iRectSizeY': _iTabsSizeY}))
			{
				var _sNewTabsID = this.getNextID();
				_axDropElementStructure[PG_DRAGANDDROP_DRAGELEMENT_INDEX_DROPAREAID] = _sNewTabsID+'Tabbar';
				oPGDragAndDrop.setDragElementStructure({'xDragElement': _sTabID, 'axStructure': _axDropElementStructure});

				this.setSizeX({'sTabsID': _sTabsID, 'sSizeX': Math.round(_iTabsSizeX/2)+'px'});
				// TODO: this.build({...});
				_sTabsID = _sNewTabsID;
			}
			else if (oPGBrowser.rectContains({'iPosX': _iInputPosX, 'iPosY': _iInputPosY, 'iRectPosX': _iTabsPosX+_iTabsSizeX-50, 'iRectPosY': _iTabsPosY+_iTabBarSizeY, 'iRectSizeX': 50, 'iRectSizeY': _iTabsSizeY}))
			{
				var _sNewTabsID = this.getNextID();
				_axDropElementStructure[PG_DRAGANDDROP_DRAGELEMENT_INDEX_DROPAREAID] = _sNewTabsID+'Tabbar';
				oPGDragAndDrop.setDragElementStructure({'xDragElement': _sTabID, 'axStructure': _axDropElementStructure});

				this.setSizeX({'sTabsID': _sTabsID, 'sSizeX': Math.round(_iTabsSizeX/2)+'px'});
				// TODO: this.build({...});
				_sTabsID = _sNewTabsID;
			}
			else if (oPGBrowser.rectContains({'iPosX': _iInputPosX, 'iPosY': _iInputPosY, 'iRectPosX': _iTabsPosX, 'iRectPosY': _iTabsPosY+_iTabsSizeY-50, 'iRectSizeX': _iTabsSizeX, 'iRectSizeY': 50}))
			{
				var _sNewTabsID = this.getNextID();
				_axDropElementStructure[PG_DRAGANDDROP_DRAGELEMENT_INDEX_DROPAREAID] = _sNewTabsID+'Tabbar';
				oPGDragAndDrop.setDragElementStructure({'xDragElement': _sTabID, 'axStructure': _axDropElementStructure});

				this.setSizeY({'sTabsID': _sTabsID, 'sSizeY': Math.round(_iTabsSizeY/2)+'px'});
				this.build(
					{
						'sTabsID': _sNewTabsID, 
						'sSizeX': _iTabsSizeX,
						'sSizeY': Math.round(_iTabsSizeY/2)+'px',
						'iTabsMode': null, 
						'sContent': null, 
						'axTabs': null,
						'sCssStyle': null,
						'sCssClass': null,
						'sCssStyleTabbar': null,
						'sCssClassTabbar': null,
						'sCssStyleTabs': null,
						'sCssClassTabs': null,
						'sCssStyleContents': null,
						'sCssClassContents': null
					}
				);
				_sTabsID = _sNewTabsID;
			}
			
			var _oNewTabsPreview = this.oDocument.getElementById(this.sCreateNewTabsNearTabsID+'NewTabsPreview');
			if (_oNewTabsPreview) {oPGNodes.remove({'xElement': _oNewTabsPreview});}
			this.sCreateNewTabsNearTabsID = '';
		}

		var _oTabs = this.oDocument.getElementById(_sTabsID);
		var _oFrame = this.oDocument.getElementById(_sTabID+'FrameContainer');
		if ((_oTabs) && (_oFrame))
		{
			_oTabs.appendChild(_oFrame);
			this.recalculateElements({'sTabsID': _sTabsID});
			this.onTabMouseUp({'sTabID': _sTabID});
		}
		
		this.sMoveTabID = '';
	}
	/* @end method */
	
	/*
	@start method
	
	@param sTabID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.buildNewTabsPreview = function(_sTabsID)
	{
		_sTabsID = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sTabsID', 'xParameter': _sTabsID});

		var _oNewTabsPreview = this.oDocument.getElementById(_sTabsID+'NewTabsPreview');
		if (!_oNewTabsPreview)
		{
			_oNewTabsPreview = this.oDocument.createElement('div');
			_oNewTabsPreview.id = _sTabsID+'NewTabsPreview';
			_oNewTabsPreview.style.opacity = '0.2';
			_oNewTabsPreview.style.backgroundColor = 'black';
			_oNewTabsPreview.style.position = 'absolute';
			oPGNodes.insertInto({'xIntoParent': document.body, 'xInsertElement': _oNewTabsPreview});
		}
		return _oNewTabsPreview;
	}
	/* @end method */
	
	/*
	@start method
	
	@param _oEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onMove = function(_oEvent)
	{
		_oEvent = this.getRealParameter({'oParameters': _oEvent, 'sName': 'oEvent', 'xParameter': _oEvent});
		
		if (this.sMoveTabID != '')
		{
			var _iTabsPosX = 0;
			var _iTabsPosY = 0;
			var _iTabsSizeX = 0;
			var _iTabsSizeY = 0;
			var _iInputPosX = oPGInput.getDocPosX();
			var _iInputPosY = oPGInput.getDocPosY();
			var _oNewTabsPreview = null;
			var _oTabs = null;
			var _iTabBarSizeY = 25;
			var _oTabBar = null;
			var _oNewTabsPreview = null;
			for (var i=0; i<this.asTabsIDs.length; i++)
			{
				_oTabs = this.oDocument.getElementById(this.asTabsIDs[i]);
				if (_oTabs)
				{
					_iTabBarSizeY = 25;
					_oTabBar = this.oDocument.getElementById(this.asTabsIDs[i]+'Tabbar');
					if (_oTabBar) {_iTabBarSizeY = oPGBrowser.getSizeY({'xElement': _oTabBar});}

					_iTabsPosX = oPGBrowser.getDocumentOffsetX({'xElement': _oTabs});
					_iTabsPosY = oPGBrowser.getDocumentOffsetY({'xElement': _oTabs});
					_iTabsSizeX = oPGBrowser.getSizeX({'xElement': _oTabs});
					_iTabsSizeY = oPGBrowser.getSizeY({'xElement': _oTabs});
					
					_oNewTabsPreview = this.oDocument.getElementById(this.asTabsIDs[i]+'NewTabsPreview');
					
					if (oPGBrowser.rectContains({'iPosX': _iInputPosX, 'iPosY': _iInputPosY, 'iRectPosX': _iTabsPosX, 'iRectPosY': _iTabsPosY+_iTabBarSizeY, 'iRectSizeX': 50, 'iRectSizeY': _iTabsSizeY}))
					{
						this.sCreateNewTabsNearTabsID = this.asTabsIDs[i];
						_oNewTabsPreview = this.buildNewTabsPreview({'sTabsID': this.asTabsIDs[i]});
						if (_oNewTabsPreview)
						{
							_oNewTabsPreview.style.left = _iTabsPosX+'px';
							_oNewTabsPreview.style.top = _iTabsPosY+'px';
							_oNewTabsPreview.style.height = _iTabsSizeY+'px';
							_oNewTabsPreview.style.width = Math.round(_iTabsSizeX/2)+'px';
						}
					}
					else if (oPGBrowser.rectContains({'iPosX': _iInputPosX, 'iPosY': _iInputPosY, 'iRectPosX': _iTabsPosX+_iTabsSizeX-50, 'iRectPosY': _iTabsPosY+_iTabBarSizeY, 'iRectSizeX': 50, 'iRectSizeY': _iTabsSizeY}))
					{
						this.sCreateNewTabsNearTabsID = this.asTabsIDs[i];
						_oNewTabsPreview = this.buildNewTabsPreview({'sTabsID': this.asTabsIDs[i]});
						if (_oNewTabsPreview)
						{
							_oNewTabsPreview.style.left = (_iTabsPosX+Math.round(_iTabsSizeX/2))+'px';
							_oNewTabsPreview.style.top = _iTabsPosY+'px';
							_oNewTabsPreview.style.height = _iTabsSizeY+'px';
							_oNewTabsPreview.style.width = Math.round(_iTabsSizeX/2)+'px';
						}
					}
					else if (oPGBrowser.rectContains({'iPosX': _iInputPosX, 'iPosY': _iInputPosY, 'iRectPosX': _iTabsPosX, 'iRectPosY': _iTabsPosY+_iTabsSizeY-50, 'iRectSizeX': _iTabsSizeX, 'iRectSizeY': 50}))
					{
						this.sCreateNewTabsNearTabsID = this.asTabsIDs[i];
						_oNewTabsPreview = this.buildNewTabsPreview({'sTabsID': this.asTabsIDs[i]});
						if (_oNewTabsPreview)
						{
							_oNewTabsPreview.style.left = _iTabsPosX+'px';
							_oNewTabsPreview.style.top = (_iTabsPosY+Math.round(_iTabsSizeY/2))+'px';
							_oNewTabsPreview.style.height = Math.round(_iTabsSizeY/2)+'px';
							_oNewTabsPreview.style.width = _iTabsSizeX+'px';
						}
					}
					else if (_oNewTabsPreview)
					{
						this.sCreateNewTabsNearTabsID = '';
						oPGNodes.remove({'xElement': _oNewTabsPreview});
					}
				}
			}
		}
	}
	/* @end method */
	
	// Methods...
	/*
	@start method
	
	@return sTabsHtml [type]string[/type]
	[en]...[/en]
	
	@param sTabsID [type]string[/type]
	[en]...[/en]
	
	@param sSizeX [type]string[/type]
	[en]...[/en]
	
	@param sSizeY [type]string[/type]
	[en]...[/en]
	
	@param iTabsMode [type]int[/type]
	[en]...[/en]
	
	@param sContent [type]string[/type]
	[en]...[/en]
	
	@param axTabs [type]mixed[][/type]
	[en]...[/en]
	
	@param sCssStyle [type]string[/type]
	[en]...[/en]
	
	@param sCssClass [type]string[/type]
	[en]...[/en]
	
	@param sCssStyleTabbar [type]string[/type]
	[en]...[/en]
	
	@param sCssClassTabbar [type]string[/type]
	[en]...[/en]
	
	@param sCssStyleTabs [type]string[/type]
	[en]...[/en]
	
	@param sCssClassTabs [type]string[/type]
	[en]...[/en]
	
	@param sCssStyleContents [type]string[/type]
	[en]...[/en]
	
	@param sCssClassContents [type]string[/type]
	[en]...[/en]
	*/
	this.build = function(
		_sTabsID, 
		_sSizeX,
		_sSizeY,
		_iTabsMode, 
		_sContent, 
		_axTabs,
		_sCssStyle,
		_sCssClass,
		_sCssStyleTabbar,
		_sCssClassTabbar,
		_sCssStyleTabs,
		_sCssClassTabs,
		_sCssStyleContents,
		_sCssClassContents
	)
	{
		_sSizeX = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sSizeX', 'xParameter': _sSizeX});
		_sSizeY = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sSizeY', 'xParameter': _sSizeY});
		_iTabsMode = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'iTabsMode', 'xParameter': _iTabsMode});
		_sContent = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sContent', 'xParameter': _sContent});
		_axTabs = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'axTabs', 'xParameter': _axTabs});
		_sCssStyle = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sCssStyle', 'xParameter': _sCssStyle});
		_sCssClass = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		_sCssStyleTabbar = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sCssStyleTabbar', 'xParameter': _sCssStyleTabbar});
		_sCssClassTabbar = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sCssClassTabbar', 'xParameter': _sCssClassTabbar});
		_sCssStyleTabs = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sCssStyleTabs', 'xParameter': _sCssStyleTabs});
		_sCssClassTabs = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sCssClassTabs', 'xParameter': _sCssClassTabs});
		_sCssStyleContents = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sCssStyleContents', 'xParameter': _sCssStyleContents});
		_sCssClassContents = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sCssClassContents', 'xParameter': _sCssClassContents});
		_sTabsID = this.getRealParameter({'oParameters': _sTabsID, 'sName': 'sTabsID', 'xParameter': _sTabsID});

		if (_sTabsID == null) {_sTabsID = this.getNextID();}
		if (_sCssStyleTabbar == null) {_sCssStyleTabbar = 'background-color:#666666; padding-top:5px;';}
		if (_sSizeX == null) {_sSizeX = '100%';}
		if (_sSizeY == null) {_sSizeY = '300px';}
		
		_sHtml = '';
		// _sHtml += this.getLineBreak();
		
		_sHtml += '<div id="'+_sTabsID+'" style="width:'+_sSizeX+'; height:'+_sSizeY+'; ';
		if (_sCssStyle !== null) {_sHtml += _sCssStyle+' ';}
		_sHtml += 'overflow:auto; background-color:#aaaaaa; display:inline-block;" ';
		_sHtml += '>';

			_axDragElementsStructure = new Array();
			
			if (_axTabs != null)
			{
				for (var i=0; i<_axTabs.length; i++)
				{
					_sTabsCurrentCssStyle = '';
					if (i == 0) {_sTabsCurrentCssStyle = this.sTabsCssStylePressed;}
					else {_sTabsCurrentCssStyle = this.sTabsCssStyleNormal;}
					_axTabs[i][PG_TABS_TAB_INDEX_FRAMESTRUCTURE]['sFrameID'] = _sTabsID+'Tab'+i+'Frame';
					_axTabs[i]['sDragElementID'] = _sTabsID+'Tab'+i;
					_axTabs[i]['sCssStyle'] = _sCssStyleTabs+' '+_sTabsCurrentCssStyle+' '+this.sTabsCssStyleBasics;
					_axTabs[i]['sCssClass'] = _sCssClassTabs;
					_axTabs[i]['axData'] = {'sFrameID': _axTabs[i][PG_TABS_TAB_INDEX_FRAMESTRUCTURE]['sFrameID']};
					_axTabs[i]['sOnMouseUp'] = 'oPGTabs.onTabMouseUp({\'sTabID\': \''+_axTabs[i]['sDragElementID']+'\'});';
					_axTabs[i]['sOnGrab'] = 'oPGTabs.onTabGrab({\'sTabID\': \''+_axTabs[i]['sDragElementID']+'\'});';
					_axTabs[i]['sOnDrop'] = 'oPGTabs.onTabDrop({\'sTabID\': \''+_axTabs[i]['sDragElementID']+'\'});';
					_axDragElementsStructure.push(oPGDragElement.buildStructure(_axTabs[i]));
				}
			}
			
			_sHtml += oPGDropArea.build(
				{
					'sDropAreaID': _sTabsID+'Tabbar', 
					'sSizeX': '100%', 
					'sSizeY': '25px', 
					'iGridX': 0, 
					'iGridY': 0, 
					'iDropAreaType': PG_DROPAREA_TYPE_HORIZONTAL_LIST, 
					'iGroupID': null, 
					'sContent': null, 
					'sOnDrop': null, 
					'axData': null, 
					'axDragElementsStructure': _axDragElementsStructure,
					'iMaxDropElements': null, 
					'sCssStyle': _sCssStyleTabbar, 
					'sCssClass': _sCssClassTabbar
				}
			);
			
			if (_axTabs != null)
			{
				for (var i=0; i<_axTabs.length; i++)
				{
					// _axTabs[i][PG_TABS_TAB_INDEX_FRAMESTRUCTURE]['sCssStyle'] = 'float:left; background-color:#ccffcc;';
					_sHtml += oPGFrame.build(_axTabs[i][PG_TABS_TAB_INDEX_FRAMESTRUCTURE]);
				}
			}
			
		_sHtml += '</div>';
		_sHtml += '<script type="text/javascript">';
			_sHtml += 'oPGTabs.registerTabs({"sTabsID": "'+_sTabsID+'"}); ';
		_sHtml += '</script>';
		
		// _sHtml += this.getLineBreak();
		return _sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@return axTabStructure [type]mixed[][/type]
	[en]...[/en]
	
	@param sTabID [needed][type]string[/type]
	[en]...[/en]
	
	@param sText [needed][type]string[/type]
	[en]...[/en]
	
	@param xData [needed][type]mixed[/type]
	[en]...[/en]
	
	@param axFrameStructure [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	this.buildTabStructure = function(_sTabID, _sText, _xData, _axFrameStructure)
	{
		_sText = this.getRealParameter({'oParameters': _sTabID, 'sName': 'sText', 'xParameter': _sText});
		_xData = this.getRealParameter({'oParameters': _sTabID, 'sName': 'xData', 'xParameter': _xData});
		_axFrameStructure = this.getRealParameter({'oParameters': _sTabID, 'sName': 'axFrameStructure', 'xParameter': _axFrameStructure});
		_sTabID = this.getRealParameter({'oParameters': _sTabID, 'sName': 'sTabID', 'xParameter': _sTabID});
	
		var _axTab = {
			'sContent': _sText,
			'iDragElementType': PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSEHOLD,
			'sGroupID': null,
			'iMouseOffsetDist': null,
			'iElementKillMode': PG_DRAGANDDROP_ELEMENTKILLMODE_NOKILL,
			'iElementCopyMode': PG_DRAGANDDROP_ELEMENTCOPYMODE_NOCOPY,
			'xData': _xData,
			PG_TABS_TAB_INDEX_FRAMESTRUCTURE: _axFrameStructure
		}
		
		return _axTab;
	}
	/* @end method */
}
/* @end class */
classPG_Tabs.prototype = new classPG_ClassBasics();
var oPGTabs = new classPG_Tabs();
