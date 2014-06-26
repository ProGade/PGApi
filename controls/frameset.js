/*
* ProGade API
* http://api.progade.de/
*
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: "http://api.progade.de/api_terms.php" or "./license.txt"
*
* Last changes of this file: Nov 21 2012
*/
var PG_FRAMESET_FRAMES_TYPE_COLS = 0;
var PG_FRAMESET_FRAMES_TYPE_ROWS = 1;

var PG_FRAMESET_FRAMES_BEHAVIOR_DYNAMIC = 0;
var PG_FRAMESET_FRAMES_BEHAVIOR_STATIC = 1;
var PG_FRAMESET_FRAMES_BEHAVIOR_STRICT = 2;

var PG_FRAMESET_FRAMES_MODE_NONE = 0;
var PG_FRAMESET_FRAMES_MODE_TABBED = 1;

var PG_FRAMESET_FRAMES_INDEX_BEHAVIOR = 0;	// must be 0. Don't change this!
var PG_FRAMESET_FRAMES_INDEX_MODE = 1;		// must be 1. Don't change this!
var PG_FRAMESET_FRAMES_INDEX_SIZE = 2;
var PG_FRAMESET_FRAMES_INDEX_CONTENT = 3;
var PG_FRAMESET_FRAMES_INDEX_FRAMEMODE = 4;
var PG_FRAMESET_FRAMES_INDEX_OVERLAYZINDEX = 5;

/*
@start class

@description
[en]This class contains methods to create and manage (faked) framesets.[/en]
[de]Diese Klasse enthält Methoden zum erstellen und verwalten von (gefakten) Framesets.[/de]

@param extends classPG_ClassBasics
*/
function classPG_Frameset()
{
	// Declarations...
	this.sDragFramesetID = '';
	this.iDragFrameID = -1;
	this.iDragDoubleFrameSize = 0;
	this.iDragMouseStartX = 0;
	this.iDragMouseStartY = 0;
	
	this.axFramesets = {};
	this.asFramesetIDs = new Array();
	
	// Construct...
	this.setID({'sID': 'PGFrameset'});
	this.initClassBasics();
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Returns the ID of the frame, which is being moved.[/en]
	[de]Gibt die ID vom Frame zurück, welches gerade bewegt wird.[/de]
	
	@return iFrameID [type]int[/type]
	[en]Returns the ID of the frame as an integer, which is being moved.[/en]
	[de]Gibt die ID vom Frame als Integer zurück, welches gerade bewegt wird.[/de]
	*/
	this.getDragFrameID = function() {return this.iDragFrameID;}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Returns the ID of the frameset, which is being moved.[/en]
	[de]Gibt die ID vom Frameset zurück, welches gerade bewegt wird.[/de]
	
	@return iFramesetID [type]int[/type]
	[en]Returns the ID of the frameset as an integer, which is being moved.[/en]
	[de]Gibt die ID vom Frameset als Integer zurück, welches gerade bewegt wird.[/de]
	*/
	this.getDragFramesetID = function() {return this.sDragFramesetID;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Registers a frameset.[/en]
	[de]Registriert ein Frameset.[/de]
	
	@param sFramesetID [needed][type]string[/type]
	[en]The ID of the frameset.[/en]
	[de]Die ID des Framesets.[/de]
	
	@param iFramesetType [needed][type]int[/type]
	[en]
		The type of the frameset.
	[/en]
	[de]
		Der Typ des Framesets.
	[/de]
	
	@param iFrameDynamicCount [needed][type]int[/type]
	[en]The count of dynamic frames of the framset.[/en]
	[de]Die Anzahl an dynamischen Frames des Framesets.[/de]
	
	@param iFrameCount [needed][type]int[/type]
	[en]The whole count of frame of the frameset.[/en]
	[de]Die Gesamtanzahl an Frames des Framesets.[/de]
	
	@param bResizeWithContainer [needed][type]bool[/type]
	[en]Specifies whether the size of the frameset will automatically be changed with the size of the container element.[/en]
	[de]Gibt an ob die Größe des Framesets automatisch mit der Größe des Kontainer-Elements verändert werden soll.[/de]
	
	@param axFrames [needed][type]mixed[][/type]
	[en]The frames of the frameset.[/en]
	[de]Die Frames des Framesets.[/de]
	*/
	this.registerFrameset = function(_sFramesetID, _iFramesetType, _iFrameDynamicCount, _iFrameCount, _bResizeWithContainer, _axFrames)
	{
		if (typeof(_iFramesetType) == 'undefined') {var _iFramesetType = null;}
		if (typeof(_iFrameDynamicCount) == 'undefined') {var _iFrameDynamicCount = null;}
		if (typeof(_iFrameCount) == 'undefined') {var _iFrameCount = null;}
		if (typeof(_bResizeWithContainer) == 'undefined') {var _bResizeWithContainer = null;}

		_iFramesetType = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'iFramesetType', 'xParameter': _iFramesetType});
		_iFrameDynamicCount = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'iFrameDynamicCount', 'xParameter': _iFrameDynamicCount});
		_iFrameCount = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'iFrameCount', 'xParameter': _iFrameCount});
		_bResizeWithContainer = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'bResizeWithContainer', 'xParameter': _bResizeWithContainer});
		_axFrames = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'axFrames', 'xParameter': _axFrames});
		_sFramesetID = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sFramesetID', 'xParameter': _sFramesetID});
		
		this.axFramesets[_sFramesetID] = {
			'sFramesetID': _sFramesetID,
			'iFramesetType': _iFramesetType,
			'iFrameDynamicCount': _iFrameDynamicCount,
			'iFrameCount': _iFrameCount,
			'bResizeWithContainer': _bResizeWithContainer,
			'axFrames': _axFrames,
		};
		
		this.asFramesetIDs.push(_sFramesetID);
	}
	/* @end method */
	
	/*
	this.buildInto = function(_xContainer,
							  _sFramesetID,
							  _sSizeX,
							  _sSizeY,
							  _axFrames,
							  _iFramesetType,
							  _sCssClassFrame,
							  _sCssClassBorder)
	{
		if (typeof(_xContainer) == 'undefined') {var _xContainer = null;}
		if (typeof(_sFramesetID) == 'undefined') {var _sFramesetID = null;}
		if (typeof(_sSizeX) == 'undefined') {var _sSizeX = null;}
		if (typeof(_sSizeY) == 'undefined') {var _sSizeY = null;}
		if (typeof(_axFrames) == 'undefined') {var _axFrames = null;}
		if (typeof(_iFramesetType) == 'undefined') {var _iFramesetType = null;}
		if (typeof(_sCssClassFrame) == 'undefined') {var _sCssClassFrame = null;}
		if (typeof(_sCssClassBorder) == 'undefined') {var _sCssClassBorder = null;}

		_sFramesetID = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sFramesetID', 'xParameter': _sFramesetID});
		_sSizeX = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sSizeX', 'xParameter': _sSizeX});
		_sSizeY = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sSizeY', 'xParameter': _sSizeY});
		_axFrames = this.getRealParameter({'oParameters': _xContainer, 'sName': 'axFrames', 'xParameter': _axFrames});
		_iFramesetType = this.getRealParameter({'oParameters': _xContainer, 'sName': 'iFramesetType', 'xParameter': _iFramesetType});
		_sCssClassFrame = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sCssClassFrame', 'xParameter': _sCssClassFrame});
		_sCssClassBorder = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sCssClassBorder', 'xParameter': _sCssClassBorder});
		_xContainer = this.getRealParameter({'oParameters': _xContainer, 'sName': 'xContainer', 'xParameter': _xContainer, 'bNotNull': true});
		
		var _sHTML = this.build(
			{
				'sFramesetID': _sFramesetID, 
				'sSizeX': _sSizeX, 'sSizeY': _sSizeY, 
				'axFrames': _axFrames, 
				'iFramesetType': _iFramesetType, 
				'sCssClassFrame': _sCssClassFrame, 'sCssClassBorder': _sCssClassBorder
			}
		);
		
		if (_xContainer != null)
		{
			var _oContainer = this.getContainerObject({'xContainer': _xContainer});
			if (_oContainer) {_oContainer.innerHTML += _sHTML;}
		}
	}
	
	this.build = function(_sFramesetID,
						  _sSizeX,
						  _sSizeY,
						  _axFrames,
						  _iFramesetType,
						  _sCssClassFrame,
						  _sCssClassBorder)
	{
		if (typeof(_sFramesetID) == 'undefined') {var _sFramesetID = null;}
		if (typeof(_sSizeX) == 'undefined') {var _sSizeX = null;}
		if (typeof(_sSizeY) == 'undefined') {var _sSizeY = null;}
		if (typeof(_axFrames) == 'undefined') {var _axFrames = null;}
		if (typeof(_iFramesetType) == 'undefined') {var _iFramesetType = null;}
		if (typeof(_sCssClassFrame) == 'undefined') {var _sCssClassFrame = null;}
		if (typeof(_sCssClassBorder) == 'undefined') {var _sCssClassBorder = null;}

		_sSizeX = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sSizeX', 'xParameter': _sSizeX});
		_sSizeY = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sSizeY', 'xParameter': _sSizeY});
		_axFrames = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'axFrames', 'xParameter': _axFrames});
		_iFramesetType = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'iFramesetType', 'xParameter': _iFramesetType});
		_sCssClassFrame = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sCssClassFrame', 'xParameter': _sCssClassFrame});
		_sCssClassBorder = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sCssClassBorder', 'xParameter': _sCssClassBorder});
		_sFramesetID = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sFramesetID', 'xParameter': _sFramesetID});
		
		if (_sFramesetID == null) {_sFramesetID = this.getNextID();}
		if (_axFrames == null) {_axFrames = new Array();}
		if (_iFramesetType == null) {_iFramesetType = PG_FRAMESET_FRAMES_TYPE_COLS;}
		
		var _sFrameWidth = '';
		var _sFrameHeight = '';
		var _sContent = '';
		var _iZIndex = 1;
		var _iOverlayZIndex = 2;
		var _iScrollMode = 0;
		var _bUseOverlay = false;
		var _sFrameCssStyle = '';
		
		var _iDynamicFrames = 0;
		var _sHTML = '';
		_sHTML += '<div id="'+_sFramesetID+'" style="width:'+_sSizeX+'; height:'+_sSizeY+'; overflow:hidden;">';
			for (var i=0; i<_axFrames.length; i++)
			{
				// Border...
				if (i>0)
				{
					var _bStrict = false;
					if ((_axFrames[i][PG_FRAMESET_FRAMES_INDEX_BEHAVIOR] == PG_FRAMESET_FRAMES_BEHAVIOR_STRICT)
					|| (_axFrames[i-1][PG_FRAMESET_FRAMES_INDEX_BEHAVIOR] == PG_FRAMESET_FRAMES_BEHAVIOR_STRICT)) {_bStrict = true;}
					
					_sHTML += '<div ';
					if ((_sCssClassBorder != null) && (_sCssClassBorder != '')) {_sHTML += 'class="'+_sCssClassFrame+'" ';}
					_sHTML += 'style="';
					if ((_sCssClassBorder == null) || (_sCssClassBorder == '')) {_sHTML += 'background-color:#000000; ';}
					if (_iFramesetType == PG_FRAMESET_FRAMES_TYPE_COLS)
					{
						if (_bStrict == true) {_sHTML += 'cursor:default; ';} else {_sHTML += 'cursor:col-resize; ';}
						if ((_sCssClassBorder == null) || (_sCssClassBorder == '')) {_sHTML += 'width:5px; ';}
						_sHTML += 'height:100%; ';
						_sHTML += 'float:left; ';
						if (this.sImageBorderVertical != '')
						{
							_sHTML += 'background-image:url('+this.getGfxPathImages({'sImage': this.sImageBorderVertical})+'); ';
							_sHTML += 'background-repeat:repeat-y; ';
							_sHTML += 'background-position:top left; ';
							_sHTML += 'background-attachment:scroll; ';
						}
					}
					else
					{
						if (_bStrict == true) {_sHTML += 'cursor:default; ';} else {_sHTML += 'cursor:row-resize; ';}
						_sHTML += 'width:100%; ';
						if ((_sCssClassBorder == null) || (_sCssClassBorder == '')) {_sHTML += 'height:5px; ';}
						if (this.sImageBorderHorizontal != '')
						{
							_sHTML += 'background-image:url('+this.getGfxPathImages({'sImage': this.sImageBorderHorizontal})+'); ';
							_sHTML += 'background-repeat:repeat-x; ';
							_sHTML += 'background-position:top left; ';
							_sHTML += 'background-attachment:scroll; ';
						}
					}
					_sHTML += '" onmousedown="oPGFrameset.frameOnMouseDown({\'sFramesetID\': \''+_sFramesetID+'\', \'iFrameIndex\': '+(i-1)+'});"></div>';
				}
				
				// Frame...
				if (oPGFrame.isMode({'iMode': PG_FRAME_MODE_DRAG, 'iCurrentMode': _axFrames[i][PG_FRAMESET_FRAMES_INDEX_FRAMEMODE]})) {_bUseOverlay = true;}
				else {_bUseOverlay = false;}
				_iScrollMode = _axFrames[i][PG_FRAMESET_INDEX_FRAMEMODE];
				_iZIndex = 1;
				_iOverlayZIndex = 2;
				_sContent = _axFrames[i][PG_FRAMESET_FRAMES_INDEX_CONTENT];
				if (_iFramesetType == PG_FRAMESET_FRAMES_TYPE_COLS)
				{
					_sFrameWidth = _axFrames[i][PG_FRAMESET_FRAMES_INDEX_SIZE];
					_sFrameHeight = '100%';
					_sFrameCssStyle = 'float:left; ';
				}
				else
				{
					_sFrameWidth = '100%';
					_sFrameHeight = _axFrames[i][PG_FRAMESET_FRAMES_INDEX_SIZE];
					_sFrameCssStyle = 'float:none; ';
				}
				_sHTML += oPGFrame.build(
					{
						'sFrameID': _sFramesetID+'Frame'+i, 
						'iSizeX': _sFrameWidth, 'iSizeY': _sFrameHeight, 
						'sContent': _sContent, 
						'iZIndex': _iZIndex, 'iOverlayZIndex': _iOverlayZIndex, 
						'iScrollMode': _iScrollMode, 
						'bUseOverlay': _bUseOverlay, 
						'sFrameCssStyle': _sFrameCssStyle, 'sCssClassFrame': _sCssClassFrame
					}
				);
				_sHTML += '<input type="hidden" id="'+_sFramesetID+'Frame'+i+'Behavior" value="'+_axFrames[i][PG_FRAMESET_FRAMES_INDEX_BEHAVIOR]+'" />';
				if (_axFrames[i][PG_FRAMESET_FRAMES_INDEX_BEHAVIOR] == true) {_iDynamicFrames++;}
			}
			_sHTML += '<input type="hidden" id="'+_sFramesetID+'FrameDynamicCount" value="'+_iDynamicFrames+'" />';
			_sHTML += '<input type="hidden" id="'+_sFramesetID+'FrameCount" value="'+_axFrames.length+'" />';
		_sHTML += '</div>';

		return _sHTML;
	}
	
	this.buildFrameStructure = function(_sSize, _sContent, _iFrameMode, _iBehavior, _iOverlayZIndex)
	{
		if (typeof(_sContent) == 'undefined') {var _sContent = null;}
		if (typeof(_iFrameMode) == 'undefined') {var _iFrameMode = null;}
		if (typeof(_iBehavior) == 'undefined') {var _iBehavior = null;}
		if (typeof(_iOverlayZIndex) == 'undefined') {var _iOverlayZIndex = null;}

		_sContent = this.getRealParameter({'oParameters': _sSize, 'sName': 'sContent', 'xParameter': _sContent});
		_iFrameMode = this.getRealParameter({'oParameters': _sSize, 'sName': 'iFrameMode', 'xParameter': _iFrameMode});
		_iBehavior = this.getRealParameter({'oParameters': _sSize, 'sName': 'iBehavior', 'xParameter': _iBehavior});
		_iOverlayZIndex = this.getRealParameter({'oParameters': _sSize, 'sName': 'iOverlayZIndex', 'xParameter': _iOverlayZIndex});
		_sSize = this.getRealParameter({'oParameters': _sSize, 'sName': 'sSize', 'xParameter': _sSize});

		return new Array(_sSize, _sContent, _iFrameMode, _iBehavior, _iOverlayZIndex);
	}
	*/
	
	/*
	@start method
	
	@description
	[en]Returns the ID of a frame from the frameset.[/en]
	[de]Gibt die ID eines Frames des Framesets zurück.[/de]
	
	@return sFrameID [type]string[/type]
	[en]Returns the ID of a frame from the frameset as a string.[/en]
	[de]Gibt die ID eines Frames des Framesets als String zurück.[/de]
	
	@param sFramesetID [needed][type]string[/type]
	[en]The ID of the frameset.[/en]
	[de]Die ID des Framesets.[/de]
	
	@param iFrameIndex [needed][type]int[/type]
	[en]The index of the desired frame (starting at 0).[/en]
	[de]Der Index des gewünschten Frames (beginnend bei 0).[/de]
	*/
	this.getFrameID = function(_sFramesetID, _iFrameIndex)
	{
		if (typeof(_iFrameIndex) == 'undefined') {var _iFrameIndex = null;}

		_iFrameIndex = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'iFrameIndex', 'xParameter': _iFrameIndex});
		_sFramesetID = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sFramesetID', 'xParameter': _sFramesetID});
		
		if (typeof(this.axFramesets[_sFramesetID]) != 'undefined')
		{
			if (typeof(this.axFramesets[_sFramesetID]['axFrames'][_iFrameIndex]) != 'undefined')
			{
				var _axFrame = this.axFramesets[_sFramesetID]['axFrames'][_iFrameIndex];
				if (_axFrame[PG_FRAMESET_FRAMES_INDEX_MODE] == PG_FRAMESET_FRAMES_MODE_TABBED) {return _sFramesetID+'Tabs'+_iFrameIndex;}
				else {return _sFramesetID+'Frame'+_iFrameIndex;}
			}
		}
		return '';
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns a frame of the frameset.[/en]
	[de]Gibt einen Frame des Framesets zurück.[/de]
	
	@return oFrame [type]object[/type]
	[en]Returns a frame of the frameset as an object.[/en]
	[de]Gibt einen Frame des Framesets als Objekt zurück.[/de]
	
	@param sFramesetID [needed][type]string[/type]
	[en]The ID of the frameset.[/en]
	[de]Die ID des Framesets.[/de]
	
	@param iFrameIndex [needed][type]int[/type]
	[en]The index of the desired frame (starting at 0).[/en]
	[de]Der Index des gewünschten Frames (beginnend bei 0).[/de]
	*/
	this.getFrame = function(_sFramesetID, _iFrameIndex)
	{
		if (typeof(_iFrameIndex) == 'undefined') {var _iFrameIndex = null;}
		
		_iFrameIndex = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'iFrameIndex', 'xParameter': _iFrameIndex});
		_sFramesetID = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sFramesetID', 'xParameter': _sFramesetID});

		var _sFrameID = this.getFrameID({'sFramesetID': _sFramesetID, 'iFrameIndex': _iFrameIndex});
		if (typeof(this.axFramesets[_sFramesetID]) != 'undefined')
		{
			if (typeof(this.axFramesets[_sFramesetID]['axFrames'][_iFrameIndex]) != 'undefined')
			{
				var _axFrame = this.axFramesets[_sFramesetID]['axFrames'][_iFrameIndex];
				if (_axFrame[PG_FRAMESET_FRAMES_INDEX_MODE] != PG_FRAMESET_FRAMES_MODE_TABBED) {_sFrameID += 'Container';}
			}
		}
		
		if (_sFrameID == '') {return null;}
		return this.oDocument.getElementById(_sFrameID);
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the width of a frame of the frameset.[/en]
	[de]Setzt die Breite eines Frames vom Frameset.[/de]
	
	@param sFramesetID [needed][type]string[/type]
	[en]The ID of the frameset.[/en]
	[de]Die ID des Framesets.[/de]
	
	@param iFrameIndex [needed][type]int[/type]
	[en]The index of the desired frame (starting at 0).[/en]
	[de]Der Index des gewünschten Frames (beginnend bei 0).[/de]
	
	@param sSizeX [needed][type]string[/type]
	[en]The width as an string.[/en]
	[de]Die Breite als String.[/de]
	*/
	this.setFrameSizeX = function(_sFramesetID, _iFrameIndex, _sSizeX)
	{
		if (typeof(_iFrameIndex) == 'undefined') {var _iFrameIndex = null;}
		if (typeof(_sSizeX) == 'undefined') {var _sSizeX = null;}
		
		_iFrameIndex = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'iFrameIndex', 'xParameter': _iFrameIndex});
		_sSizeX = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sSizeX', 'xParameter': _sSizeX});
		_sFramesetID = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sFramesetID', 'xParameter': _sFramesetID});

		if (typeof(this.axFramesets[_sFramesetID]) != 'undefined')
		{
			if (typeof(this.axFramesets[_sFramesetID]['axFrames'][_iFrameIndex]) != 'undefined')
			{
				var _axFrame = this.axFramesets[_sFramesetID]['axFrames'][_iFrameIndex];
				if (_axFrame[PG_FRAMESET_FRAMES_INDEX_MODE] == PG_FRAMESET_FRAMES_MODE_TABBED) {oPGTabs.setSizeX({'sTabsID': _sFramesetID+'Tabs'+_iFrameIndex, 'sSizeX': _sSizeX});}
				else {oPGFrame.setSizeX({'sFrameID': _sFramesetID+'Frame'+_iFrameIndex, 'sSizeX': _sSizeX});}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the height of a frame of the frameset.[/en]
	[de]Setzt die Höhe eines Frames vom Frameset.[/de]
	
	@param sFramesetID [needed][type]string[/type]
	[en]The ID of the frameset.[/en]
	[de]Die ID des Framesets.[/de]
	
	@param iFrameIndex [needed][type]int[/type]
	[en]The index of the desired frame (starting at 0).[/en]
	[de]Der Index des gewünschten Frames (beginnend bei 0).[/de]
	
	@param sSizeY [needed][type]string[/type]
	[en]The height as an string.[/en]
	[de]Die Höhe als String.[/de]
	*/
	this.setFrameSizeY = function(_sFramesetID, _iFrameIndex, _sSizeY)
	{
		if (typeof(_iFrameIndex) == 'undefined') {var _iFrameIndex = null;}
		if (typeof(_sSizeY) == 'undefined') {var _sSizeY = null;}
		
		_iFrameIndex = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'iFrameIndex', 'xParameter': _iFrameIndex});
		_sSizeY = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sSizeY', 'xParameter': _sSizeY});
		_sFramesetID = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sFramesetID', 'xParameter': _sFramesetID});

		if (typeof(this.axFramesets[_sFramesetID]) != 'undefined')
		{
			if (typeof(this.axFramesets[_sFramesetID]['axFrames'][_iFrameIndex]) != 'undefined')
			{
				var _axFrame = this.axFramesets[_sFramesetID]['axFrames'][_iFrameIndex];
				if (_axFrame[PG_FRAMESET_FRAMES_INDEX_MODE] == PG_FRAMESET_FRAMES_MODE_TABBED) {oPGTabs.setSizeY({'sTabsID': _sFramesetID+'Tabs'+_iFrameIndex, 'sSizeY': _sSizeY});}
				else {oPGFrame.setSizeY({'sFrameID': _sFramesetID+'Frame'+_iFrameIndex, 'sSizeY': _sSizeY});}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Recalculated dynamic values of frames of the frameset.[/en]
	[de]Berechnet dynamische Werte eines Frames des Framesets neu.[/de]
	
	@param sFramesetID [needed][type]string[/type]
	[en]The ID of the frameset.[/en]
	[de]Die ID des Framesets.[/de]
	
	@param iFrameIndex [needed][type]int[/type]
	[en]The index of the desired frame (starting at 0).[/en]
	[de]Der Index des gewünschten Frames (beginnend bei 0).[/de]
	*/
	this.recalculateFrameElements = function(_sFramesetID, _iFrameIndex)
	{
		if (typeof(_iFrameIndex) == 'undefined') {var _iFrameIndex = null;}

		_iFrameIndex = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'iFrameIndex', 'xParameter': _iFrameIndex});
		_sFramesetID = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sFramesetID', 'xParameter': _sFramesetID});

		if (typeof(this.axFramesets[_sFramesetID]) != 'undefined')
		{
			if (typeof(this.axFramesets[_sFramesetID]['axFrames'][_iFrameIndex]) != 'undefined')
			{
				var _axFrame = this.axFramesets[_sFramesetID]['axFrames'][_iFrameIndex];
				if (_axFrame[PG_FRAMESET_FRAMES_INDEX_MODE] == PG_FRAMESET_FRAMES_MODE_TABBED) {oPGTabs.recalculateElements({'sTabsID': _sFramesetID+'Tabs'+_iFrameIndex});}
				else {oPGFrame.recalculateElements({'sFrameID': _sFramesetID+'Frame'+_iFrameIndex});}
			}
		}
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Provides functionality for frames at the touch of a mouse button.[/en]
	[de]Funktionalität für Frames bei Mousetastendruck.[/de]
	
	@param sFramesetID [needed][type]string[/type]
	[en]The ID of the frameset.[/en]
	[de]Die ID des Framesets.[/de]
	
	@param iFrameIndex [needed][type]int[/type]
	[en]The index of the desired frame (starting at 0).[/en]
	[de]Der Index des gewünschten Frames (beginnend bei 0).[/de]
	*/
	this.frameOnMouseDown = function(_sFramesetID, _iFrameIndex)
	{
		if (typeof(_iFrameIndex) == 'undefined') {var _iFrameIndex = null;}

		_iFrameIndex = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'iFrameIndex', 'xParameter': _iFrameIndex});
		_sFramesetID = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sFramesetID', 'xParameter': _sFramesetID});

		if (typeof(this.axFramesets[_sFramesetID]) != 'undefined')
		{
			if ((typeof(this.axFramesets[_sFramesetID]['axFrames'][_iFrameIndex]) != 'undefined') && (typeof(this.axFramesets[_sFramesetID]['axFrames'][_iFrameIndex+1]) != 'undefined'))
			{
				var _axFrame = this.axFramesets[_sFramesetID]['axFrames'][_iFrameIndex];
				var _axNextFrame = this.axFramesets[_sFramesetID]['axFrames'][_iFrameIndex+1];
			
				var _iFrameBehavior = _axFrame[PG_FRAMESET_FRAMES_INDEX_BEHAVIOR];
				var _iNextFrameBehavior = _axNextFrame[PG_FRAMESET_FRAMES_INDEX_BEHAVIOR];
				if ((_iFrameBehavior != PG_FRAMESET_FRAMES_BEHAVIOR_STRICT) && (_iNextFrameBehavior != PG_FRAMESET_FRAMES_BEHAVIOR_STRICT))
				{
					this.iDragFrameID = _iFrameIndex;
					this.sDragFramesetID = _sFramesetID;
					if (typeof(oPGMouse) != 'undefined')
					{
						this.iDragMouseStartX = parseInt(oPGMouse.getDocPosX());
						this.iDragMouseStartY = parseInt(oPGMouse.getDocPosY());
					}
					
					var _oFrame = this.getFrame(_sFramesetID, _iFrameIndex);
					var _oNextFrame = this.getFrame(_sFramesetID, _iFrameIndex+1);
					if ((_oFrame) && (_oNextFrame))
					{
						var _sFloat = '';
						if (typeof(_oFrame.style.cssFloat) != 'undefined') {_sFloat = _oFrame.style.cssFloat;}
						else if (typeof(_oFrame.style.styleFloat) != 'undefined') {_sFloat = _oFrame.style.styleFloat;}
						else {_sFloat = _oFrame.style.float;}
						if (_sFloat == 'left') {this.iDragDoubleFrameSize = parseInt(_oFrame.offsetWidth)+parseInt(_oNextFrame.offsetWidth);}
						else {this.iDragDoubleFrameSize = parseInt(_oFrame.offsetHeight)+parseInt(_oNextFrame.offsetHeight);}
					}
					if (typeof(oPGBrowser) != 'undefined') {return oPGBrowser.disableSelect();}
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Functionality for global release of the mouse button.[/en]
	[de]Funktionalität für globales Loslassen der Maustaste.[/de]
	
	@param eEvent [needed][type]object[/type]
	[en]The event object of the browser.[/en]
	[de]Das Eventobjekt des Browsers.[/de]
	*/
	this.onMouseUp = function(_eEvent)
	{
		this.iDragFrameID = -1;
		this.sDragFramesetID = '';
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Functionality for global movement of the mouse pointer.[/en]
	[de]Funktionalität für globales Bewegen des Mauszeigers.[/de]
	
	@param eEvent [needed][type]object[/type]
	[en]The event object of the browser.[/en]
	[de]Das Eventobjekt des Browsers.[/de]
	*/
	this.onMouseMove = function(_eEvent)
	{
		if ((this.iDragFrameID >= 0) && (this.sFramesetDragFrameID != '')
		&& (typeof(oPGMouse) != 'undefined') && (typeof(oPGBrowser) != 'undefined'))
		{
			if (typeof(this.axFramesets[this.sDragFramesetID]) != 'undefined')
			{
				if ((typeof(this.axFramesets[this.sDragFramesetID]['axFrames'][this.iDragFrameID]) != 'undefined') && (typeof(this.axFramesets[this.sDragFramesetID]['axFrames'][this.iDragFrameID+1]) != 'undefined'))
				{
					var _axFrame = this.axFramesets[this.sDragFramesetID]['axFrames'][this.iDragFrameID];
					var _axNextFrame = this.axFramesets[this.sDragFramesetID]['axFrames'][this.iDragFrameID+1];

					var _sFrame = this.getFrameID({'sFramesetID': this.sDragFramesetID, 'iFrameIndex': this.iDragFrameID});
					var _oFrame = this.getFrame({'sFramesetID': this.sDragFramesetID, 'iFrameIndex': this.iDragFrameID});

					var _sNextFrame = this.getFrameID({'sFramesetID': this.sDragFramesetID, 'iFrameIndex': this.iDragFrameID+1});
					var _oNextFrame = this.getFrame({'sFramesetID': this.sDragFramesetID, 'iFrameIndex': this.iDragFrameID+1});

					if (_oFrame)
					{
						var _sFloat = '';
						if (typeof(_oFrame.style.cssFloat) != 'undefined') {_sFloat = _oFrame.style.cssFloat;}
						else if (typeof(_oFrame.style.styleFloat) != 'undefined') {_sFloat = _oFrame.style.styleFloat;}
						else {_sFloat = _oFrame.style.float;}
						if (_sFloat == 'left')
						{
							var _iMousePosX = parseInt(oPGMouse.getDocPosX());
							var _iSizeX = _iMousePosX-parseInt(oPGBrowser.getDocumentOffsetX({'xElement': _oFrame}));
							if ((_oNextFrame) && (_iMousePosX >= 0))
							{
								var _iNextSizeX = this.iDragDoubleFrameSize-_iSizeX;
								_iNextSizeX = Math.min(Math.max(_iNextSizeX, 0), this.iDragDoubleFrameSize);
								_iSizeX = Math.min(Math.max(_iSizeX, 0), this.iDragDoubleFrameSize);
								this.setFrameSizeX({'sFramesetID': this.sDragFramesetID, 'iFrameIndex': this.iDragFrameID+1, 'sSizeX': _iNextSizeX+'px'});
								this.setFrameSizeX({'sFramesetID': this.sDragFramesetID, 'iFrameIndex': this.iDragFrameID, 'sSizeX': _iSizeX+'px'});
							}
						}
						else
						{
							var _iMousePosY = parseInt(oPGMouse.getDocPosY());
							var _iSizeY = _iMousePosY-parseInt(oPGBrowser.getDocumentOffsetY({'xElement': _oFrame}));
							if ((_oNextFrame) && (_iMousePosY >= 0))
							{
								var _iNextSizeY = this.iDragDoubleFrameSize-_iSizeY;
								_iNextSizeY = Math.min(Math.max(_iNextSizeY, 0), this.iDragDoubleFrameSize);
								_iSizeY = Math.min(Math.max(_iSizeY, 0), this.iDragDoubleFrameSize);
								this.setFrameSizeY({'sFramesetID': this.sDragFramesetID, 'iFrameIndex': this.iDragFrameID+1, 'sSizeY': _iNextSizeY+'px'});
								this.setFrameSizeY({'sFramesetID': this.sDragFramesetID, 'iFrameIndex': this.iDragFrameID, 'sSizeY': _iSizeY+'px'});
							}
						}
					}
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Moving the border of the frameset relative to the previous position.[/en]
	[de]Bewegt den Rahmen des Framesets relativ zur vorherigen Position.[/de]
	
	@param sFramesetID [needed][type]string[/type]
	[en]The ID of the frameset.[/en]
	[de]Die ID des Framesets.[/de]
	
	@param iBorderIndex [needed][type]int[/type]
	[en]The index of the desired border (starting at 0).[/en]
	[de]Der Index des gewünschten Border (beginnend bei 0).[/de]
	
	@param iMoveDist [needed][type]int[/type]
	[en]The distance in pixels that should be moved.[/en]
	[de]Die Distanz in Pixeln die bewegt werden soll.[/de]
	
	@param iSpeedTimeout [needed][type]int[/type]
	[en]The speed through a timeout in milliseconds.[/en]
	[de]Die Geschwindigkeit durch einen Timeout in Millisekunden.[/de]
	*/
	this.moveBorderRelative = function(_sFramesetID, _iBorderIndex, _iMoveDist, _iSpeedTimeout)
	{
		if (typeof(_iBorderIndex) == 'undefined') {var _iBorderIndex = null;}
		if (typeof(_iMoveDist) == 'undefined') {var _iMoveDist = null;}
		if (typeof(_sUploadID) == 'undefined') {var _sUploadID = null;}

		_iBorderIndex = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'iBorderID', 'xParameter': _iBorderIndex});
		_iMoveDist = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'iMoveDist', 'xParameter': _iMoveDist});
		_iSpeedTimeout = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'iSpeedTimeout', 'xParameter': _iSpeedTimeout});
		_sFramesetID = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sFramesetID', 'xParameter': _sFramesetID});

		if (typeof(_iSpeedTimeout) == 'undefined') {var _iSpeedTimeout = null;}
		if (_iSpeedTimeout < 1) {_iSpeedTimeout = null;}
		
		var _iCurrentDist = 0;
		if (_iSpeedTimeout != null)
		{
			if ((_iMoveDist > 5) || (_iMoveDist < -5)) {_iCurrentDist = Math.round(_iMoveDist/2);}
			else {_iCurrentDist = _iMoveDist;}
			_iMoveDist -= _iCurrentDist;
		}
		else {_iCurrentDist = _iMoveDist;}
		
		var _sFrame = this.getFrameID({'sFramesetID': this.sDragFramesetID, 'iFrameIndex': _iBorderIndex});
		var _oFrame = this.getFrame({'sFramesetID': this.sDragFramesetID, 'iFrameIndex': _iBorderIndex});

		var _sNextFrame = this.getFrameID({'sFramesetID': this.sDragFramesetID, 'iFrameIndex': _iBorderIndex+1});
		var _oNextFrame = this.getFrame({'sFramesetID': this.sDragFramesetID, 'iFrameIndex': _iBorderIndex+1});

		if ((_oFrame) && (_oNextFrame))
		{
			var _sFloat = '';
			if (typeof(_oFrame.style.cssFloat) != 'undefined') {_sFloat = _oFrame.style.cssFloat;}
			else if (typeof(_oFrame.style.styleFloat) != 'undefined') {_sFloat = _oFrame.style.styleFloat;}
			else {_sFloat = _oFrame.style.float;}
			if (_sFloat == 'left')
			{
				var _iFrameSizeX = this.getFrameSizeX({'sFramesetID': _sFramesetID, 'iFrameIndex': _iBorderIndex});
				var _iNextFrameSizeX = this.getFrameSizeX({'sFramesetID': _sFramesetID, 'iFrameIndex': _iBorderIndex+1});
				var _iDoubleFrameSize = _iFrameSizeX+_iNextFrameSizeX;
				var _iSizeX = _iFrameSizeX+_iCurrentDist; // _iMoveDist;
				var _iNextSizeX = _iNextFrameSizeX-_iCurrentDist; // _iMoveDist;
				_iNextSizeX = Math.min(Math.max(_iNextSizeX, 0), _iDoubleFrameSize);
				_iSizeX = Math.min(Math.max(_iSizeX, 0), _iDoubleFrameSize);
				this.setFrameSizeX({'sFramesetID': this.sDragFramesetID, 'iFrameIndex': _iBorderIndex+1, 'sSizeX': _iNextSizeX+'px'});
				this.setFrameSizeX({'sFramesetID': this.sDragFramesetID, 'iFrameIndex': _iBorderIndex, 'sSizeX': _iSizeX+'px'});
			}
			else
			{
				var _iFrameSizeY = this.getFrameSizeY({'sFramesetID': _sFramesetID, 'iFrameIndex': _iBorderIndex});
				var _iNextFrameSizeY = this.getFrameSizeY({'sFramesetID': _sFramesetID, 'iFrameIndex': _iBorderIndex+1});
				var _iDoubleFrameSize = _iFrameSizeY+_iNextFrameSizeY;
				var _iSizeY = _iFrameSizeY+_iCurrentDist; // _iMoveDist;
				var _iNextSizeY = _iNextFrameSizeY-_iCurrentDist; // _iMoveDist;
				_iNextSizeY = Math.min(Math.max(_iNextSizeY, 0), _iDoubleFrameSize);
				_iSizeY = Math.min(Math.max(_iSizeY, 0), _iDoubleFrameSize);
				this.setFrameSizeY({'sFramesetID': this.sDragFramesetID, 'iFrameIndex': _iBorderIndex+1, 'sSizeY': _iNextSizeY+'px'});
				this.setFrameSizeY({'sFramesetID': this.sDragFramesetID, 'iFrameIndex': _iBorderIndex, 'sSizeY': _iSizeY+'px'});
			}
			if ((_iSpeedTimeout != null) && (_iMoveDist != 0))
			{
				this.oWindow.setTimeout("oPGFrameset.moveBorderRelative({'sFramesetID': '"+_sFramesetID+"', 'iBorderIndex': "+_iBorderIndex+", 'iMoveDist': "+_iMoveDist+", 'iSpeedTimeout': "+_iSpeedTimeout+"})", _iSpeedTimeout);
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]JavaScript code that should be executed when changing the size of a frame.[/en]
	[de]JavaScript Code der beim verändern der Größe eines Frames ausgeführt werden soll.[/de]
	
	@param sFramesetID [needed][type]string[/type]
	[en]The ID of the frameset.[/en]
	[de]Die ID des Framesets.[/de]
	
	@param iFrameIndex [needed][type]int[/type]
	[en]The index of the desired frame (starting at 0).[/en]
	[de]Der Index des gewünschten Frames (beginnend bei 0).[/de]
	
	@param sJavaScriptToExecute [needed][type]string[/type]
	[en]The JavaScript code that should be executed.[/en]
	[de]Der JavaScript Code der ausgeführt werden soll.[/de]
	*/
	this.executeOnFrameResizing = function(_sFramesetID, _iFrameIndex, _sJavaScriptToExecute)
	{
		if (typeof(_iFrameIndex) == 'undefined') {var _iFrameIndex = null;}
		if (typeof(_sJavaScriptToExecute) == 'undefined') {var _sJavaScriptToExecute = null;}
		
		_iFrameIndex = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'iFrameIndex', 'xParameter': _iFrameIndex});
		_sJavaScriptToExecute = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sJavaScriptToExecute', 'xParameter': _sJavaScriptToExecute});
		_sFramesetID = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sFramesetID', 'xParameter': _sFramesetID});
		
		if
		(
			(oPGFrameset.sDragFramesetID == _sFramesetID)
			&& (oPGFrameset.iDragFrameID > -1)
			&&
			(
				(oPGFrameset.iDragFrameID == _iFrameIndex)
				|| (oPGFrameset.iDragFrameID == _iFrameIndex-1)
				|| (oPGFrameset.iDragFrameID == _iFrameIndex+1)
			)
		)
		{
			eval(_sJavaScriptToExecute);
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]JavaScript code that should be executed when changing the size of the frameset.[/en]
	[de]JavaScript Code der beim verändern der Größe des Framesets ausgeführt werden soll.[/de]
	
	@param sFramesetID [needed][type]string[/type]
	[en]The ID of the frameset.[/en]
	[de]Die ID des Framesets.[/de]
	
	@param sJavaScriptToExecute [needed][type]string[/type]
	[en]The JavaScript code that should be executed.[/en]
	[de]Der JavaScript Code der ausgeführt werden soll.[/de]
	*/
	this.executeOnResizing = function(_sFramesetID, _sJavaScriptToExecute)
	{
		if (typeof(_sJavaScriptToExecute) == 'undefined') {var _sJavaScriptToExecute = null;}
		
		_sJavaScriptToExecute = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sJavaScriptToExecute', 'xParameter': _sJavaScriptToExecute});
		_sFramesetID = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sFramesetID', 'xParameter': _sFramesetID});

		if ((oPGFrameset.sDragFramesetID == _sFramesetID) && (oPGFrameset.iDragFrameID == -1))
		{
			eval(_sJavaScriptToExecute);
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the width of a frame.[/en]
	[de]Gibt die Breite eines Frames zurück.[/de]
	
	@return iSizeX [type]int[/type]
	[en]Returns the width of a frame in pixels as an integer.[/en]
	[de]Gibt die Breite eines Frames in Pixeln als Integer zurück.[/de]
	
	@param sFramesetID [needed][type]string[/type]
	[en]The ID of the frameset.[/en]
	[de]Die ID des Framesets.[/de]
	
	@param iFrameIndex [needed][type]int[/type]
	[en]The index of the desired frame (starting at 0).[/en]
	[de]Der Index des gewünschten Frames (beginnend bei 0).[/de]
	*/
	this.getFrameSizeX = function(_sFramesetID, _iFrameIndex)
	{
		if (typeof(_iFrameIndex) == 'undefined') {var _iFrameIndex = null;}
		
		_iFrameIndex = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'iFrameIndex', 'xParameter': _iFrameIndex});
		_sFramesetID = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sFramesetID', 'xParameter': _sFramesetID});
		
		var _oFrame = oPGFrameset.getFrame({'sFramesetID': _sFramesetID, 'iFrameIndex': _iFrameIndex});
		if (_oFrame) {return parseInt(_oFrame.offsetWidth);}
		return 0;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the height of a frame.[/en]
	[de]Gibt die Höhe eines Frames zurück.[/de]
	
	@return iSizeY [type]int[/type]
	[en]Returns the height of a frame in pixels as an integer.[/en]
	[de]Gibt die Höhe eines Frames in Pixeln als Integer zurück.[/de]
	
	@param sFramesetID [needed][type]string[/type]
	[en]The ID of the frameset.[/en]
	[de]Die ID des Framesets.[/de]
	
	@param iFrameIndex [needed][type]int[/type]
	[en]The index of the desired frame (starting at 0).[/en]
	[de]Der Index des gewünschten Frames (beginnend bei 0).[/de]
	*/
	this.getFrameSizeY = function(_sFramesetID, _iFrameIndex)
	{
		if (typeof(_iFrameIndex) == 'undefined') {var _iFrameIndex = null;}
		
		_iFrameIndex = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'iFrameIndex', 'xParameter': _iFrameIndex});
		_sFramesetID = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sFramesetID', 'xParameter': _sFramesetID});
		
		var _oFrame = oPGFrameset.getFrame({'sFramesetID': _sFramesetID, 'iFrameIndex': _iFrameIndex});
		if (_oFrame) {return parseInt(_oFrame.offsetHeight);}
		return 0;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the width of the frameset.[/en]
	[de]Setzt die Breite des Framesets.[/de]
	
	@param sFramesetID [needed][type]string[/type]
	[en]The ID of the frameset.[/en]
	[de]Die ID des Framesets.[/de]
	
	@param iSizeX [needed][type]int[/type]
	[en]The width in pixels.[/en]
	[de]Die Breite in Pixeln.[/de]
	*/
	this.setSizeX = function(_sFramesetID, _iSizeX)
	{
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = null;}
		
		_iSizeX = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		_sFramesetID = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sFramesetID', 'xParameter': _sFramesetID});
		
		var _oFrameset = oPGFrameset.oDocument.getElementById(_sFramesetID);
		if (_oFrameset)
		{
			if (_iSizeX != null)
			{
				if (_iSizeX >= 0)
				{
					_oFrameset.style.width = _iSizeX+'px';
					oPGFrameset.resizeFramesSizes({'sFramesetID': _sFramesetID});
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the height of the frameset.[/en]
	[de]Setzt die Höhe des Framesets.[/de]
	
	@param sFramesetID [needed][type]string[/type]
	[en]The ID of the frameset.[/en]
	[de]Die ID des Framesets.[/de]
	
	@param iSizeY [needed][type]int[/type]
	[en]The height in pixels.[/en]
	[de]Die Höhe in Pixeln.[/de]
	*/
	this.setSizeY = function(_sFramesetID, _iSizeY)
	{
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}
		
		_iSizeY = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_sFramesetID = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sFramesetID', 'xParameter': _sFramesetID});
		
		var _oFrameset = oPGFrameset.oDocument.getElementById(_sFramesetID);
		if (_oFrameset)
		{
			if (_iSizeY != null)
			{
				if (_iSizeY >= 0)
				{
					_oFrameset.style.height = _iSizeY+'px';
					this.resizeFramesSizes({'sFramesetID': _sFramesetID});
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the size of the frameset.[/en]
	[de]Setzt die Größe des Framesets.[/de]
	
	@param sFramesetID [needed][type]string[/type]
	[en]The ID of the frameset.[/en]
	[de]Die ID des Framesets.[/de]
	
	@param iSizeX [type]int[/type]
	[en]The width in pixels.[/en]
	[de]Die Breite in Pixeln.[/de]
	
	@param iSizeY [type]int[/type]
	[en]The height in pixels.[/en]
	[de]Die Höhe in Pixeln.[/de]
	*/
	this.setSize = function(_sFramesetID, _iSizeX, _iSizeY)
	{
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = null;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}
	
		_iSizeX = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		_iSizeY = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_sFramesetID = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sFramesetID', 'xParameter': _sFramesetID});
		
		var _oFrameset = oPGFrameset.oDocument.getElementById(_sFramesetID);
		if (_oFrameset)
		{
			if (_iSizeX != null) {if (_iSizeX >= 0) {_oFrameset.style.width = _iSizeX+'px';}}
			if (_iSizeY != null) {if (_iSizeY >= 0) {_oFrameset.style.height = _iSizeY+'px';}}
			this.resizeFramesSizes({'sFramesetID': _sFramesetID});
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the size of the frame to the size of the container element.[/en]
	[de]Setzt die Größe des Framesets auf die Größe des Kontainer-Elements.[/de]
	
	@param sFramesetID [needed][type]string[/type]
	[en]The ID of the frameset.[/en]
	[de]Die ID des Framesets.[/de]
	*/
	this.setSizeToContainer = function(_sFramesetID)
	{
		_sFramesetID = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sFramesetID', 'xParameter': _sFramesetID});
		
		var _oFrameset = oPGFrameset.oDocument.getElementById(_sFramesetID);
		if (_oFrameset)
		{
			var _oParentNode = _oFrameset.parentNode;
			if (_oParentNode)
			{
				oPGFrameset.setSize({'sFramesetID': _sFramesetID, 'iSizeX': _oParentNode.offsetWidth, 'iSizeY': _oParentNode.offsetHeight});
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Functionality for the global resize event.[/en]
	[de]Funktionalität für den globalen Resize-Event.[/de]
	
	@param oEvent [needed][type]object[/type]
	[en]The event object of the browser.[/en]
	[de]Das Eventobjekt des Browsers.[/de]
	*/
	this.onResize = function(_oEvent)
	{
		for (var i=this.asFramesetIDs.length-1; i>=0; i--)
		{
			if (this.axFramesets[this.asFramesetIDs[i]]['bResizeWithContainer'] == true) {this.setSizeToContainer(this.asFramesetIDs[i]);}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Calculates the new sizes of all frames of a framsets.[/en]
	[de]Berechnet die neuen Größen aller Frames eines Framsets.[/de]
	
	@param sFramesetID [needed][type]string[/type]
	[en]The ID of the frameset.[/en]
	[de]Die ID des Framesets.[/de]
	*/
	this.resizeFramesSizes = function(_sFramesetID)
	{
		_sFramesetID = this.getRealParameter({'oParameters': _sFramesetID, 'sName': 'sFramesetID', 'xParameter': _sFramesetID});

		var _oFrame = null;
		var _oFrameBorder = null;
		var _iFrameBehavior = 0;
		
		var _oFrameset = this.oDocument.getElementById(_sFramesetID);
		
		if ((_oFrameset) && (typeof(this.axFramesets[_sFramesetID]) != 'undefined'))
		{
			var _iFramesetSizeX = parseInt(_oFrameset.offsetWidth);
			var _iFramesetSizeY = parseInt(_oFrameset.offsetHeight);
			var _iFramesetFrameCount = this.axFramesets[_sFramesetID]['iFrameCount'];
			var _iFramesetFrameDynamicCount = this.axFramesets[_sFramesetID]['iFrameDynamicCount'];
			var _iFramesetType = this.axFramesets[_sFramesetID]['iFramesetType'];

			if ((!isNaN(_iFramesetSizeX)) && (!isNaN(_iFramesetSizeY) && (!isNaN(_iFramesetType)))
			&& (!isNaN(_iFramesetFrameCount)) && (!isNaN(_iFramesetFrameDynamicCount)))
			{
				var _iBorderSize = 0;
				var _iAllBorderSize = 0;
				var _oFrameBorder = this.oDocument.getElementById(_sFramesetID+'Border1');
				if (_oFrameBorder)
				{
					if (_iFramesetType == PG_FRAMESET_FRAMES_TYPE_COLS) {_iBorderSize = parseInt(_oFrameBorder.offsetWidth);}
					else {_iBorderSize = parseInt(_oFrameBorder.offsetHeight);}
					_iAllBorderSize = ((_iFramesetFrameCount-1)*_iBorderSize);
				}
				
				var i = 0;
				var _iAllStaticSizeX = 0;
				var _iAllStaticSizeY = 0;
				var _iAllDynamicSizeX = 0;
				var _iAllDynamicSizeY = 0;
				var _iAllStrictSizeX = 0;
				var _iAllStrictSizeY = 0;
				for (i=0; i<_iFramesetFrameCount; i++)
				{
					_oFrame = this.getFrame({'sFramesetID': _sFramesetID, 'iFrameIndex': i});
					if ((_oFrame) && (typeof(this.axFramesets[_sFramesetID]['axFrames'][i]) != 'undefined'))
					{
						_iFrameBehavior = this.axFramesets[_sFramesetID]['axFrames'][i][PG_FRAMESET_FRAMES_INDEX_BEHAVIOR];
						if (_iFrameBehavior == PG_FRAMESET_FRAMES_BEHAVIOR_DYNAMIC)
						{
							if (oPGCss.getStyleFloat({'xElement': _oFrame}) == 'left') {_iAllDynamicSizeX += this.getFrameSizeX({'sFramesetID': _sFramesetID, 'iFrameIndex': i});}
							else {_iAllDynamicSizeY += this.getFrameSizeY({'sFramesetID': _sFramesetID, 'iFrameIndex': i});}
						}
						else if (_iFrameBehavior == PG_FRAMESET_FRAMES_BEHAVIOR_STATIC)
						{
							if (oPGCss.getStyleFloat({'xElement': _oFrame}) == 'left') {_iAllStaticSizeX += this.getFrameSizeX({'sFramesetID': _sFramesetID, 'iFrameIndex': i});}
							else {_iAllStaticSizeY += this.getFrameSizeY({'sFramesetID': _sFramesetID, 'iFrameIndex': i});}
						}
						else if (_iFrameBehavior == PG_FRAMESET_FRAMES_BEHAVIOR_STRICT)
						{
							if (oPGCss.getStyleFloat({'xElement': _oFrame}) == 'left') {_iAllStrictSizeX += this.getFrameSizeX({'sFramesetID': _sFramesetID, 'iFrameIndex': i});}
							else {_iAllStrictSizeY += this.getFrameSizeY({'sFramesetID': _sFramesetID, 'iFrameIndex': i});}
						}
					}
				}
				
				var _iPercent = 0;
				var _iNewSizeX = 0;
				var _iNewSizeY = 0;
				var _iCureentSizeX = 0;
				var _iCureentSizeY = 0;
				for (i=0; i<_iFramesetFrameCount; i++)
				{
					_oFrame = this.getFrame({'sFramesetID': _sFramesetID, 'iFrameIndex': i});
					if ((_oFrame) && (typeof(this.axFramesets[_sFramesetID]['axFrames'][i]) != 'undefined'))
					{
						_iPercent = 0;
						_iNewSizeX = -1;
						_iNewSizeY = -1;
						_iCureentSizeX = this.getFrameSizeX({'sFramesetID': _sFramesetID, 'iFrameIndex': i});
						_iCureentSizeY = this.getFrameSizeY({'sFramesetID': _sFramesetID, 'iFrameIndex': i});
						_iFrameBehavior = this.axFramesets[_sFramesetID]['axFrames'][i][PG_FRAMESET_FRAMES_INDEX_BEHAVIOR];

						if ((!isNaN(_iCureentSizeX)) && (!isNaN(_iCureentSizeY)))
						{
							if (oPGCss.getStyleFloat({'xElement': _oFrame}) == 'left')
							{
								if (_iFramesetSizeX-_iAllBorderSize-_iAllStaticSizeX-_iAllStrictSizeX >= 0)
								{
									if (_iFrameBehavior == PG_FRAMESET_FRAMES_BEHAVIOR_DYNAMIC)
									{
										_iPercent = Math.round(_iCureentSizeX/_iAllDynamicSizeX*100);
										_iNewSizeX = Math.round((_iFramesetSizeX-_iAllStaticSizeX-_iAllStrictSizeX-_iAllBorderSize)/100*_iPercent);
									}
								}
								else if (_iFrameBehavior != PG_FRAMESET_FRAMES_BEHAVIOR_STRICT)
								{
									_iPercent = Math.round(_iCureentSizeX/(_iAllDynamicSizeX+_iAllStaticSizeX+_iAllStrictSizeX)*100);
									_iNewSizeX = Math.round((_iFramesetSizeX-_iAllBorderSize-_iAllStrictSizeX)/100*_iPercent);
								}
							}
							else
							{
								if (_iFramesetSizeY-((_iFramesetFrameCount-1)*_iBorderSize)-_iAllStaticSizeY-_iAllStrictSizeY >= 0)
								{
									if (_iFrameBehavior == PG_FRAMESET_FRAMES_BEHAVIOR_DYNAMIC)
									{
										_iPercent = Math.round(_iCureentSizeY/_iAllDynamicSizeY*100);
										_iNewSizeY = Math.round((_iFramesetSizeY-_iAllStaticSizeY-_iAllStrictSizeY-_iAllBorderSize)/100*_iPercent);
									}
								}
								else if (_iFrameBehavior != PG_FRAMESET_FRAMES_BEHAVIOR_STRICT)
								{
									_iPercent = Math.round(_iCureentSizeY/(_iAllDynamicSizeY+_iAllStaticSizeY+_iAllStrictSizeY)*100);
									_iNewSizeY = Math.round((_iFramesetSizeY-_iAllBorderSize-_iAllStrictSizeY)/100*_iPercent);
								}
							}
							
							if (_iFrameBehavior == PG_FRAMESET_FRAMES_BEHAVIOR_DYNAMIC)
							{
								if (_iNewSizeX >= 0) {this.setFrameSizeX({'sFramesetID': _sFramesetID, 'iFrameIndex': i, 'sSizeX': _iNewSizeX+'px'});}
								if (_iNewSizeY >= 0) {this.setFrameSizeY({'sFramesetID': _sFramesetID, 'iFrameIndex': i, 'sSizeY': _iNewSizeY+'px'});}
							}
							else if (_iFrameBehavior != PG_FRAMESET_FRAMES_BEHAVIOR_STRICT)
							{
								if (_iNewSizeX >= 0) {this.setFrameSizeX({'sFramesetID': _sFramesetID, 'iFrameIndex': i, 'sSizeX': _iNewSizeX+'px'});}
								if (_iNewSizeY >= 0) {this.setFrameSizeY({'sFramesetID': _sFramesetID, 'iFrameIndex': i, 'sSizeY': _iNewSizeY+'px'});}
							}
							
							this.recalculateFrameElements({'sFramesetID': _sFramesetID, 'iFrameIndex': i});
						}
					}
				}
			}
		}
	}
	/* @end method */
}
/* @end class */
classPG_Frameset.prototype = new classPG_ClassBasics();
var oPGFrameset = new classPG_Frameset();
