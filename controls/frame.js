/*
* ProGade API
* http://api.progade.de/
*
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: "http://api.progade.de/api_terms.php" or "./license.txt"
*
* Last changes of this file: Nov 26 2012
*/
var PG_FRAME_DEFAULT_OVERLAY_ZINDEX = 100;

var PG_FRAME_MODE_NONE = 0;
var PG_FRAME_MODE_SCROLLBAR = 1;
var PG_FRAME_MODE_HOVER = 2;
var PG_FRAME_MODE_BORDERHOVER = 4;
var PG_FRAME_MODE_DRAG = 8;
var PG_FRAME_MODE_CHARACTERSBAR_LEFT = 16;
var PG_FRAME_MODE_CHARACTERSBAR_RIGHT = 32;
var PG_FRAME_MODE_CHARACTERSBAR_TOP = 64;
var PG_FRAME_MODE_CHARACTERSBAR_BOTTOM = 128;
var PG_FRAME_MODE_SCROLLBAR_LEFT = 256;
var PG_FRAME_MODE_SCROLLBAR_RIGHT = 512;
var PG_FRAME_MODE_SCROLLBAR_TOP = 1024;
var PG_FRAME_MODE_SCROLLBAR_BOTTOM = 2048;

/*
@start class

@description
[en]This class has methods to create and manage frames.[/en]
[de]Diese Klasse verfügt über Methoden zum Erstellen und Verwalten von Frames.[/de]

@param extends classPG_ClassBasics
*/
function classPG_Frame()
{
	// Declarations...
	this.iMoveSpeedX = 10;
	this.iMoveSpeedY = 10;
	this.iMoveInterval = 80;
	this.iMoveBorderSizeTop = 10;
	this.iMoveBorderSizeBottom = 10;
	this.iMoveBorderSizeLeft = 10;
	this.iMoveBorderSizeRight = 10;
	this.iMoveWithMouseStartPosX = 0;
	this.iMoveWithMouseStartPosY = 0;
	this.bDragModeEnabled = true;
	this.sMoveCursor = '';

	this.sActiveID = '';
	this.sMoveWithMouseID = '';
	// this.iActiveScrollbarType = 0;
	// this.iMoveWithScrollbarType = 0;
	this.sMouseOverID = '';
	this.asIgnoreMouseOverOnElement = new Array();
	
	this.axFrames = {};
	this.asFrameIDs = new Array();

	// Construct...
	this.setID({'sID': 'PGFrame'});
	this.initClassBasics();
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Registers frames for dynamic functions.(/en]
	[de]Registriert Frames für dynamische Funktionen.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param iScrollMode [needed][type]int[/type]
	[en]The scroll mode for the frame.[/en]
	[de]Der Scroll-Modus für den Frame.[/de]
	
	@param bUseOverlay [needed][type]bool[/type]
	[en]Specifies whether an overlay should be used for the frame.[/en]
	[de]Gibt an ob ein Overlay für das Frame verwendet werden soll.[/de]
	*/
	this.registerFrame = function(_sFrameID, _iScrollMode, _bUseOverlay)
	{
		_iScrollMode = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'iScrollMode', 'xParameter': _iScrollMode});
		_bUseOverlay = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'bUseOverlay', 'xParameter': _bUseOverlay});
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});
		
		this.recalculateElements(_sFrameID);
		
		this.axFrames[_sFrameID] =
		{
			'iScrollMode': _iScrollMode,
			'bUseOverlay': _bUseOverlay
		}

		this.asFrameIDs.push(_sFrameID);
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the mouse cursor to be used when moving frames.[/en]
	[de]Setzt den Mouse-Cursor, der beim Bewegen von Frames verwendet werden soll.[/de]
	
	@param sCursor [type]string[/type]
	[en]The cursor that should be used.[/en]
	[de]Der Cursor der verwendet werden soll.[/de]
	*/
	this.setMoveCursor = function(_sCursor)
	{
		_sCursor = this.getRealParameter({'oParameters': _sCursor, 'sName': 'sCursor', 'xParameter': _sCursor});
		this.sMoveCursor = _sCursor;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the mouse cursor to be used when moving frames.[/en]
	[de]Gibt den Mouse-Cursor zurück, der beim Bewegen von Frames verwendet werden soll.[/de]
	
	@return sMoveCursor [type]string[/type]
	[en]Returns the mouse cursor to be used when moving frames as a string.[/en]
	[de]Gibt den Mouse-Cursor als String zurück, der beim Bewegen von Frames verwendet werden soll.[/de]
	*/
	this.getMoveCursor = function() {return this.sMoveCursor;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Enables drag functions for frames.[/en]
	[de]Aktiviert Drag-Funktionen für Frames.[/de]
	*/
	this.enableDragMode = function() {this.useDragMode(true);}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Disables drag functions for frames.[/en]
	[de]Deaktiviert Drag-Funktionen für Frames.[/de]
	*/
	this.disableDragMode = function() {this.useDragMode(false);}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Specifies whether to enable drag functionality for frames.[/en]
	[de]Gibt an ob Drag-Funktionen für Frames aktiviert werden sollen.[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]Specifies whether to enable drag functionality for frames.[/en]
	[de]Gibt an ob Drag-Funktionen für Frames aktiviert werden sollen.[/de]
	*/
	this.useDragMode = function(_bUse)
	{
		_bUse = this.getRealParameter({'oParameters': _bUse, 'sName': 'bUse', 'xParameter': _bUse});
		this.bDragModeEnabled = _bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns whether drag functionality for frames are active.[/en]
	[de]Gibt zurück, ob Drag-Funktionen für Frames aktiv sind.[/de]
	
	@return bEnabled [type]bool[/type]
	[en]Returns an boolean whether drag functionality for frames are active.[/en]
	[de]Gibt einen Boolean zurück, ob Drag-Funktionen für Frames aktiv sind.[/de]
	*/
	this.isDragModeEnabled = function() {return this.bDragModeEnabled;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Changes the frame mode for a frame.[/en]
	[de]Ändert den Frame-Modus eines Frames.[/de]
	
	@param sFrameID [needed][type]string[/type
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param iFrameMode [needed][type]int[/type]
	[en]The mode for the frame.[/en]
	[de]Der Modus für den Frame.[/de]
	*/
	this.changeMode = function(_sFrameID, _iFrameMode)
	{
		if (typeof(_iFrameMode) == 'undefined') {var _iFrameMode = null;}

		_iFrameMode = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'iFrameMode', 'xParameter': _iFrameMode});
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		var _oControlsType = this.oDocument.getElementById(_sFrameID+'ControlsType');
		if (_oControlsType)
		{
			var _iControlsType = parseInt(_oControlsType.value);
			if (_iControlsType == PG_CONTROLS_TYPE_FRAME)
			{
				var _oFrame = this.oDocument.getElementById(_sFrameID);
				var _oFrameContainer = this.oDocument.getElementById(_sFrameID+'Container');
				if ((_oFrame) && (_oFrameContainer))
				{
					var _oFrameOverlay = this.oDocument.getElementById(_sFrameID+'Overlay');
					if ((_oFrameOverlay) && (typeof(this.axFrames[_sFrameID]) != 'undefined'))
					{
						this.axFrames[_sFrameID]['iScrollMode'] = _iFrameMode;
						var _iUseOverlay = this.axFrames[_sFrameID]['bUseOverlay'];
						if (this.isMode({'iMode': PG_FRAME_MODE_SCROLLBAR, 'iCurrentMode': _iFrameMode}))
						{
							_oFrameContainer.style.overflow = 'auto';
							_oFrameContainer.scrollTop = 0;
							_oFrameContainer.scrollLeft = 0;
							_oFrame.style.top = '0px';
							_oFrame.style.left = '0px';
							if ((_iUseOverlay == 1) || (this.isMode({'iMode': PG_FRAME_MODE_DRAG, 'iCurrentMode': _iFrameMode})))
							{
								_oFrameOverlay.style.display = 'block';
								if (this.isMode({'iMode': PG_FRAME_MODE_DRAG, 'iCurrentMode': _iFrameMode}))
								{
									_oFrameOverlay.style.width = parseInt(_oFrame.offsetWidth)+'px';
									_oFrameOverlay.style.height = parseInt(_oFrame.offsetHeight)+'px';
								}
								else
								{
									_oFrameOverlay.style.width = parseInt(_oFrame.offsetWidth)+'px';
									_oFrameOverlay.style.height = parseInt(_oFrame.offsetHeight)+'px';
								}
							}
							else {_oFrameOverlay.style.display = 'none';}
						}
						else if (this.isMode({'iMode': PG_FRAME_MODE_HOVER, 'iCurrentMode': _iFrameMode}))
						{
							_oFrameContainer.style.overflow = 'hidden';
							_oFrameContainer.scrollTop = 0;
							_oFrameContainer.scrollLeft = 0;
							if (_iUseOverlay == 1)
							{
								_oFrameOverlay.style.display = 'block';
								_oFrameOverlay.style.width = parseInt(_oFrameContainer.offsetWidth)+'px';
								_oFrameOverlay.style.height = parseInt(_oFrameContainer.offsetHeight)+'px';
							}
							else {_oFrameOverlay.style.display = 'none';}
						}
						else if (this.isMode({'iMode': PG_FRAME_MODE_BORDERHOVER, 'iCurrentMode': _iFrameMode}))
						{
							_oFrameContainer.style.overflow = 'hidden';
							_oFrameContainer.scrollTop = 0;
							_oFrameContainer.scrollLeft = 0;
							if (_iUseOverlay == 1)
							{
								_oFrameOverlay.style.display = 'block';
								_oFrameOverlay.style.width = parseInt(_oFrameContainer.offsetWidth)+'px';
								_oFrameOverlay.style.height = parseInt(_oFrameContainer.offsetHeight)+'px';
							}
							else {_oFrameOverlay.style.display = 'none';}
						}
						else if ((this.isMode({'iMode': PG_FRAME_MODE_DRAG, 'iCurrentMode': _iFrameMode}))
						|| (this.isMode({'iMode': PG_FRAME_MODE_DRAG_AND_BORDERHOVER, 'iCurrentMode': _iFrameMode})))
						{
							_oFrameContainer.style.overflow = 'hidden';
							_oFrameContainer.scrollTop = 0;
							_oFrameContainer.scrollLeft = 0;
							_oFrameOverlay.style.top = '0px';
							_oFrameOverlay.style.left = '0px';
							_oFrameOverlay.style.display = 'block';
							_oFrameOverlay.style.width = parseInt(_oFrameContainer.offsetWidth)+'px';
							_oFrameOverlay.style.height = parseInt(_oFrameContainer.offsetHeight)+'px';
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
	[en]Shows a frame.[/en]
	[de]Zeigt einen Frame an.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	*/
	this.show = function(_sFrameID)
	{
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});
		var _oFrame = this.oDocument.getElementById(_sFrameID+'Container');
		if (_oFrame) {_oFrame.style.display = 'block';}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Hides a frame.[/en]
	[de]Versteckt einen Frame.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	*/
	this.hide = function(_sFrameID)
	{
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});
		var _oFrame = this.oDocument.getElementById(_sFrameID+'Container');
		if (_oFrame) {_oFrame.style.display = 'none';}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Changes the level (z-index) of a frame.[/en]
	[de]Ändert die Ebene (Z-Index) eines Frames.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param iZIndex [type]int[/type]
	[en]The level (z-index) on which the frame should be set.[/en]
	[de]Die Ebene (Z-Index) auf der das Frame gesetzt werden soll.[/de]
	
	@param iOverlayZIndex [type]int[/type]
	[en]The level (z-index) on which the overlay of the frame should be set.[/en]
	[de]Die Ebene (Z-Index) auf der das Overlay des Frames gesetzt werden soll.[/de]
	*/
	this.changeZIndex = function(_sFrameID, _iZIndex, _iOverlayZIndex)
	{
		if (typeof(_iZIndex) == 'undefined') {var _iZIndex = null;}
		if (typeof(_iOverlayZIndex) == 'undefined') {var _iOverlayZIndex = null;}

		_iZIndex = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'iZIndex', 'xParameter': _iZIndex});
		_iOverlayZIndex = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'iOverlayZIndex', 'xParameter': _iOverlayZIndex});
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		var _oDivContainer = this.oDocument.getElementById(_sFrameID+'Container');
		var _oDivOverlay = this.oDocument.getElementById(_sFrameID+'Overlay');
		if ((_oDivContainer) && (_oDivOverlay))
		{
			if (_iZIndex != null) {_oDivContainer.style.zIndex = _iZIndex;}
			if (_iOverlayZIndex != null) {_oDivOverlay.style.zIndex = _iOverlayZIndex;}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Changes the content of a frame.[/en]
	[de]Ändert den Inhalt eines Frames.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param sContent [needed][type]string[/type]
	[en]The content that should be set.[/en]
	[de]Der Inhalt der gesetzt werden soll.[/de]
	*/
	this.changeContent = function(_sFrameID, _sContent)
	{
		if (typeof(_sContent) == 'undefined') {var _sContent = null;}

		_sContent = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sContent', 'xParameter': _sContent});
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		var _oFrame = this.oDocument.getElementById(_sFrameID);
		if (_oFrame) {_oFrame.innerHTM = _sContent;}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Enables the overlay of a frame.[/en]
	[de]Aktiviert das Overlay eines Frames.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	*/
	this.enableOverlay = function(_sFrameID)
	{
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		if (typeof(this.axFrames[_sFrameID]) != 'undefined')
		{
			this.axFrames[_sFrameID]['bUseOverlay'] = true;
			this.changeMode({'sFrameID': _sFrameID, 'iMode': this.axFrames[_sFrameID]['iScrollMode']});
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Disables the overlay of a frame.[/en]
	[de]Deaktiviert das Overlay eines Frames.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	*/
	this.disableOverlay = function(_sFrameID)
	{
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		if (typeof(this.axFrames[_sFrameID]) != 'undefined')
		{
			this.axFrames[_sFrameID]['bUseOverlay'] = false;
			this.changeMode({'sFrameID': _sFrameID, 'iMode': this.axFrames[_sFrameID]['iScrollMode']});
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Builds a frame an place it into an HTML element container.[/en]
	[de]Erstellt einen Frame und platziert ihn in ein HTML-Element Kontainer.[/de]
	
	@param xContainer [needed][type]mixed[/type]
	[en]The container in which the frame should be placed.[/en]
	[de]Der Kontainer in den das Frame platziert werden soll.[/de]
	
	@param sFrameID [type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param sSizeX [type]string[/type]
	[en]The width of the frame as a string.[/en]
	[de]Die Breite des Frames als String.[/de]
	
	@param sSizeY [type]string[/type]
	[en]The height of the frame as a string.[/en]
	[de]Die Höhe des Frames als String.[/de]
	
	@param sContent [type]string[/type]
	[en]The content of the frame.[/en]
	[de]Der Inhalt des Frames.[/de]
	
	@param iZIndex [type]int[/type]
	[en]The level (z-index) of the frame.[/en]
	[de]Die Ebene (Z-Index) des Frames.[/de]
	
	@param iOverlayZIndex [type]int[/type]
	[en]The level (z-index) from the overlay of the frame.[/en]
	[de]Die Ebene (Z-Index) vom Overlays des Frames.[/de]
	
	@param iScrollMode [type]int[/type]
	[en]The scroll mode of the frame.[/en]
	[de]Der Scroll-Modus des Frames.[/de]
	
	@param bUseOverlay [type]bool[/type]
	[en]Specifies whether an overlay should be used.[/en]
	[de]Gibt an ob ein Overlay verwendet werden soll.[/de]
	
	@param sCssStyle [type]string[/type]
	[en]CSS code for the frame.[/en]
	[de]CSS Code für den Frame.[/de]
	
	@param sCssClass [type]string[/type]
	[en]CSS class for the frame.[/en]
	[de]CSS Klasse für den Frame.[/de]
	*/
	this.buildInto = function(_xContainer, _sFrameID, _sSizeX, _sSizeY, _sContent, _iZIndex, _iOverlayZIndex, _iScrollMode, _bUseOverlay, _sCssStyle, _sCssClass)
	{
		if (typeof(_sFrameID) == 'undefined') {var _sFrameID = null;}
		if (typeof(_sSizeX) == 'undefined') {var _sSizeX = null;}
		if (typeof(_sSizeY) == 'undefined') {var _sSizeY = null;}
		if (typeof(_sContent) == 'undefined') {var _sContent = null;}
		if (typeof(_iZIndex) == 'undefined') {var _iZIndex = null;}
		if (typeof(_iOverlayZIndex) == 'undefined') {var _iOverlayZIndex = null;}
		if (typeof(_iScrollMode) == 'undefined') {var _iScrollMode = null;}
		if (typeof(_bUseOverlay) == 'undefined') {var _bUseOverlay = null;}
		if (typeof(_sCssStyle) == 'undefined') {var _sCssStyle = null;}
		if (typeof(_sCssClass) == 'undefined') {var _sCssClass = null;}

		_sFrameID = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sFrameID', 'xParameter': _sFrameID});
		_sSizeX = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sSizeX', 'xParameter': _sSizeX});
		_sSizeY = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sSizeY', 'xParameter': _sSizeY});
		_sContent = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sContent', 'xParameter': _sContent});
		_iZIndex = this.getRealParameter({'oParameters': _xContainer, 'sName': 'iZIndex', 'xParameter': _iZIndex});
		_iOverlayZIndex = this.getRealParameter({'oParameters': _xContainer, 'sName': 'iOverlayZIndex', 'xParameter': _iOverlayZIndex});
		_iScrollMode = this.getRealParameter({'oParameters': _xContainer, 'sName': 'iScrollMode', 'xParameter': _iScrollMode});
		_bUseOverlay = this.getRealParameter({'oParameters': _xContainer, 'sName': 'bUseOverlay', 'xParameter': _bUseOverlay});
		_sCssStyle = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sCssStyle', 'xParameter': _sCssStyle});
		_sCssClass = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		_xContainer = this.getRealParameter({'oParameters': _xContainer, 'sName': 'xContainer', 'xParameter': _xContainer, 'bNotNull': true});
		
		var _sHTML = this.build(
			{
				'sFrameID': _sFrameID, 'sSizeX': _sSizeX, 'sSizeY': _sSizeY, 
				'sContent': _sContent, 'iZIndex': _iZIndex, 'iOverlayZIndex': _iOverlayZIndex, 
				'iScrollMode': _iScrollMode, 'bUseOverlay': _bUseOverlay, 
				'sCssStyle': _sCssStyle, 'sCssClass': _sCssClass
			}
		);
		
		if (_xContainer != null)
		{
			var _oContainer = this.getContainerObject({'xContainer': _xContainer});
			if (_oContainer) {_oContainer.innerHTML += _sHTML;}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Builds a frame and returns it as an HTML string.[/en]
	[de]Erstellt einen Frame und gibt ihn als HTML-String zurück.[/de]
	
	@return sFrameHtml [type]string[/type]
	[en]Returns the frame as an HTML string.[/en]
	[de]Gibt den Frame als HTML-String zurück.[/de]
	
	@param sFrameID [type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param sSizeX [type]string[/type]
	[en]The width of the frame as a string.[/en]
	[de]Die Breite des Frames als String.[/de]
	
	@param sSizeY [type]string[/type]
	[en]The height of the frame as a string.[/en]
	[de]Die Höhe des Frames als String.[/de]
	
	@param sContent [type]string[/type]
	[en]The content of the frame.[/en]
	[de]Der Inhalt des Frames.[/de]
	
	@param iZIndex [type]int[/type]
	[en]The level (z-index) of the frame.[/en]
	[de]Die Ebene (Z-Index) des Frames.[/de]
	
	@param iOverlayZIndex [type]int[/type]
	[en]The level (z-index) from the overlay of the frame.[/en]
	[de]Die Ebene (Z-Index) vom Overlays des Frames.[/de]
	
	@param iScrollMode [type]int[/type]
	[en]The scroll mode of the frame.[/en]
	[de]Der Scroll-Modus des Frames.[/de]
	
	@param bUseOverlay [type]bool[/type]
	[en]Specifies whether an overlay should be used.[/en]
	[de]Gibt an ob ein Overlay verwendet werden soll.[/de]
	
	@param sCssStyle [type]string[/type]
	[en]CSS code for the frame.[/en]
	[de]CSS Code für den Frame.[/de]
	
	@param sCssClass [type]string[/type]
	[en]CSS class for the frame.[/en]
	[de]CSS Klasse für den Frame.[/de]
	*/
	this.build = function(_sFrameID, _sSizeX, _sSizeY, _sContent, _iZIndex, _iOverlayZIndex, _iScrollMode, _bUseOverlay, _sCssStyle, _sCssClass)
	{
		if (typeof(_sFrameID) == 'undefined') {var _sFrameID = null;}
		if (typeof(_sSizeX) == 'undefined') {var _sSizeX = null;}
		if (typeof(_sSizeY) == 'undefined') {var _sSizeY = null;}
		if (typeof(_sContent) == 'undefined') {var _sContent = null;}
		if (typeof(_iZIndex) == 'undefined') {var _iZIndex = null;}
		if (typeof(_iOverlayZIndex) == 'undefined') {var _iOverlayZIndex = null;}
		if (typeof(_iScrollMode) == 'undefined') {var _iScrollMode = null;}
		if (typeof(_bUseOverlay) == 'undefined') {var _bUseOverlay = null;}
		if (typeof(_sCssStyle) == 'undefined') {var _sCssStyle = null;}
		if (typeof(_sCssClass) == 'undefined') {var _sCssClass = null;}

		_sSizeX = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sSizeX', 'xParameter': _sSizeX});
		_sSizeY = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sSizeY', 'xParameter': _sSizeY});
		_sContent = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sContent', 'xParameter': _sContent});
		_iZIndex = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'iZIndex', 'xParameter': _iZIndex});
		_iOverlayZIndex = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'iOverlayZIndex', 'xParameter': _iOverlayZIndex});
		_iScrollMode = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'iScrollMode', 'xParameter': _iScrollMode});
		_bUseOverlay = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'bUseOverlay', 'xParameter': _bUseOverlay});
		_sCssStyle = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sCssStyle', 'xParameter': _sCssStyle});
		_sCssClass = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});
		
		if (_sFrameID == null) {_sDiv = this.getNextID();}
		if (_sSizeX == null) {_sSizeX = '200px';}
		if (_sSizeY == null) {_sSizeY = '150px';}
		if (_sContent == null) {_sContent = '';}
		if (_iZIndex == null) {_iZIndex = 1;}
		if (_iOverlayZIndex == null) {_iOverlayZIndex = _iZIndex+PG_FRAME_DEFAULT_OVERLAY_ZINDEX;}
		if (_iScrollMode == null) {_iScrollMode = PG_FRAME_MODE_NONE;}
		if (_bUseOverlay == null) {_bUseOverlay = false;}
		if (_sCssStyle == null) {_sCssStyle = '';}
		if (_sCssClass == null) {_sCssClass = '';}
		
		var _sHTML = '';

		if (this.isMode({'iMode': PG_FRAME_MODE_SCROLLBAR_LEFT, 'iCurrentMode': _iScrollMode})) {_sHTML += this.buildScrollbar({'sFrameID': _sFrameID, 'iScrollbarType': PG_FRAME_MODE_SCROLLBAR_LEFT, 'iZIndex': _iOverlayZIndex+1});}
		if (this.isMode({'iMode': PG_FRAME_MODE_SCROLLBAR_RIGHT, 'iCurrentMode': _iScrollMode})) {_sHTML += this.buildScrollbar({'sFrameID': _sFrameID, 'iScrollbarType': PG_FRAME_MODE_SCROLLBAR_RIGHT, 'iZIndex': _iOverlayZIndex+1});}
		if (this.isMode({'iMode': PG_FRAME_MODE_SCROLLBAR_TOP, 'iCurrentMode': _iScrollMode})) {_sHTML += this.buildScrollbar({'sFrameID': _sFrameID, 'iScrollbarType': PG_FRAME_MODE_SCROLLBAR_TOP, 'iZIndex': _iOverlayZIndex+1});}
		if (this.isMode({'iMode': PG_FRAME_MODE_SCROLLBAR_BOTTOM, 'iCurrentMode': _iScrollMode})) {_sHTML += this.buildScrollbar({'sFrameID': _sFrameID, 'iScrollbarType': PG_FRAME_MODE_SCROLLBAR_BOTTOM, 'iZIndex': _iOverlayZIndex+1});}
		if (this.isMode({'iMode': PG_FRAME_MODE_CHARACTERSBAR_LEFT, 'iCurrentMode': _iScrollMode}))
		{
			_sHTML += '<div style="position:relative;">'+this.buildCharactersbar({'sFrameID': _sFrameID, 'iScrollbarType': PG_FRAME_MODE_CHARACTERSBAR_LEFT, 'iZIndex': _iOverlayZIndex+1})+'</div>';
		}
		if (this.isMode({'iMode': PG_FRAME_MODE_CHARACTERSBAR_RIGHT, 'iCurrentMode': _iScrollMode}))
		{
			_sHTML += '<div style="position:relative;">'+this.buildCharactersbar({'sFrameID': _sFrameID, 'iScrollbarType': PG_FRAME_MODE_CHARACTERSBAR_RIGHT, 'iZIndex': _iOverlayZIndex+1})+'</div>';
		}
		if (this.isMode({'iMode': PG_FRAME_MODE_CHARACTERSBAR_TOP, 'iCurrentMode': _iScrollMode}))
		{
			_sHTML += '<div style="position:relative;">'+this.buildCharactersbar({'sFrameID': _sFrameID, 'iScrollbarType': PG_FRAME_MODE_CHARACTERSBAR_TOP, 'iZIndex': _iOverlayZIndex+1})+'</div>';
		}
		if (this.isMode({'iMode': PG_FRAME_MODE_CHARACTERSBAR_BOTTOM, 'iCurrentMode': _iScrollMode}))
		{
			_sHTML += '<div style="position:relative;">'+this.buildCharactersbar({'sFrameID': _sFrameID, 'iScrollbarType': PG_FRAME_MODE_CHARACTERSBAR_BOTTOM, 'iZIndex': _iOverlayZIndex+1})+'</div>';
		}

		_sHTML += '<div style="position:relative; width:'+_sSizeX+'; height:'+_sSizeY+'; z-index:'+_iZIndex+'; display:block; '; // border:solid 1px #000000;
		if (this.isMode({'iMode': PG_FRAME_MODE_SCROLLBAR,'iCurrentMode':  _iScrollMode})) {_sHTML += 'overflow:auto; ';}
		else {_sHTML += 'overflow:hidden; ';}
		// _sHTML += 'overflow:hidden; ';
		if (_sCssStyle != '') {_sHTML += _sCssStyle;}
		_sHTML += '" ';
		if (_sCssClass != '') {_sHTML += 'class="'+_sCssClass+'" ';}
		_sHTML += 'id="'+_sFrameID+'Container">';
		/*if (this.isMode(PG_FRAME_MODE_SCROLLBAR_LEFT, _iScrollMode)) {_sHTML += this.buildScrollbar(_sFrameID, PG_FRAME_MODE_SCROLLBAR_LEFT, _iOverlayZIndex+1);}
		if (this.isMode(PG_FRAME_MODE_SCROLLBAR_RIGHT, _iScrollMode)) {_sHTML += this.buildScrollbar(_sFrameID, PG_FRAME_MODE_SCROLLBAR_RIGHT, _iOverlayZIndex+1);}
		if (this.isMode(PG_FRAME_MODE_SCROLLBAR_TOP, _iScrollMode)) {_sHTML += this.buildScrollbar(_sFrameID, PG_FRAME_MODE_SCROLLBAR_TOP, _iOverlayZIndex+1);}
		if (this.isMode(PG_FRAME_MODE_SCROLLBAR_BOTTOM, _iScrollMode)) {_sHTML += this.buildScrollbar(_sFrameID, PG_FRAME_MODE_SCROLLBAR_BOTTOM, _iOverlayZIndex+1);}
		if (this.isMode(PG_FRAME_MODE_CHARACTERSBAR_LEFT | PG_FRAME_MODE_CHARACTERSBAR_RIGHT | PG_FRAME_MODE_CHARACTERSBAR_TOP | PG_FRAME_MODE_CHARACTERSBAR_BOTTOM, _iScrollMode))
		{
			_sHTML += this.buildCharactersbar(_sFrameID, _iScrollMode, _iOverlayZIndex+1);
		}*/
		_sHTML += '<div id="'+_sFrameID+'" style="position:absolute; left:0px; top:0px; display:block; padding:0px; ';
		// if (this.isMode(PG_FRAME_MODE_SCROLLBAR, _iScrollMode)) {_sHTML += 'overflow:auto; width:'+_sSizeX+'; height:'+_sSizeY+'; ';}
		if ((this.isMode({'iMode': PG_FRAME_MODE_CHARACTERSBAR_LEFT, 'iCurrentMode': _iScrollMode})) || (this.isMode({'iMode': PG_FRAME_MODE_SCROLLBAR_LEFT, 'iCurrentMode': _iScrollMode}))) {_sHTML += 'padding-left:15px; right:0px; ';}
		if ((this.isMode({'iMode': PG_FRAME_MODE_CHARACTERSBAR_RIGHT, 'iCurrentMode': _iScrollMode})) || (this.isMode({'iMode': PG_FRAME_MODE_SCROLLBAR_RIGHT, 'iCurrentMode': _iScrollMode}))) {_sHTML += 'padding-right:15px; right:0px; ';}
		if ((this.isMode({'iMode': PG_FRAME_MODE_CHARACTERSBAR_TOP, 'iCurrentMode': _iScrollMode})) || (this.isMode({'iMode': PG_FRAME_MODE_SCROLLBAR_TOP, 'iCurrentMode': _iScrollMode}))) {_sHTML += 'padding-top:15px; bottom:0px; ';}
		if ((this.isMode({'iMode': PG_FRAME_MODE_CHARACTERSBAR_BOTTOM, 'iCurrentMode': _iScrollMode})) || (this.isMode({'iMode': PG_FRAME_MODE_SCROLLBAR_BOTTOM, 'iCurrentMode': _iScrollMode}))) {_sHTML += 'padding-bottom:15px; bottom:0px; ';}
		if
		(
			(!this.isMode({'iMode': PG_FRAME_MODE_HOVER, 'iCurrentMode': _iScrollMode}))
			&& (!this.isMode({'iMode': PG_FRAME_MODE_BORDERHOVER, 'iCurrentMode': _iScrollMode}))
			&& (!this.isMode({'iMode': PG_FRAME_MODE_DRAG, 'iCurrentMode': _iScrollMode}))
			&& (!this.isMode({'iMode': PG_FRAME_MODE_CHARACTERSBAR_LEFT, 'iCurrentMode': _iScrollMode}))
			&& (!this.isMode({'iMode': PG_FRAME_MODE_CHARACTERSBAR_RIGHT, 'iCurrentMode': _iScrollMode}))
			&& (!this.isMode({'iMode': PG_FRAME_MODE_CHARACTERSBAR_TOP, 'iCurrentMode': _iScrollMode}))
			&& (!this.isMode({'iMode': PG_FRAME_MODE_CHARACTERSBAR_BOTTOM, 'iCurrentMode': _iScrollMode}))
			&& (!this.isMode({'iMode': PG_FRAME_MODE_SCROLLBAR_LEFT, 'iCurrentMode': _iScrollMode}))
			&& (!this.isMode({'iMode': PG_FRAME_MODE_SCROLLBAR_RIGHT, 'iCurrentMode': _iScrollMode}))
			&& (!this.isMode({'iMode': PG_FRAME_MODE_SCROLLBAR_TOP, 'iCurrentMode': _iScrollMode}))
			&& (!this.isMode({'iMode': PG_FRAME_MODE_SCROLLBAR_BOTTOM, 'iCurrentMode': _iScrollMode}))
		)
		{
			_sHTML += 'width:100%; ';
			_sHTML += 'height:100%; ';
		}
		_sHTML += '">';
		if (_sContent != '') {_sHTML += _sContent;}
		else if (this.isMode({'iMode': PG_FRAME_MODE_CHARACTERSBAR_LEFT | PG_FRAME_MODE_CHARACTERSBAR_RIGHT | PG_FRAME_MODE_CHARACTERSBAR_TOP | PG_FRAME_MODE_CHARACTERSBAR_BOTTOM, 'iCurrentMode': _iScrollMode}))
		{
			if (_sContent == '') {_sHTML += this.buildCharactersContainer({'sFrameID': _sFrameID, 'iScrollMode': _iScrollMode});}
		}
		_sHTML += '</div>';
		_sHTML += '<input type="hidden" id="'+_sFrameID+'ControlsType" value="'+PG_CONTROLS_TYPE_FRAME+'" />';
		_sHTML += '<input type="hidden" id="'+_sFrameID+'ScrollMode" value="'+_iScrollMode+'" />';
		_sHTML += '<input type="hidden" id="'+_sFrameID+'UseOverlay" value="';
		if (_bUseOverlay == true) {_sHTML += '1';} else {_sHTML += '0';}
		_sHTML += '" />';
		
		_sHTML += '<div id="'+_sFrameID+'Overlay" ';
		_sHTML += 'onmousedown="oPGFrame.onMouseDown(\''+_sFrameID+'\');" ';
		_sHTML += 'onmouseup="oPGFrame.onMouseUp(\''+_sFrameID+'\');" ';
		_sHTML += 'style="position:absolute; width:'+_sSizeX+'; height:'+_sSizeY+'; cursor:default; ';
		if (oPGBrowser.getName() == PG_BROWSER_INTERNET_EXPLORER) {_sHTML += 'filter:alpha(opacity=1); ';}
		else {_sHTML += 'opacity:0.01; ';}
		if (_bUseOverlay == true) {_sHTML += 'display:block; ';} else {_sHTML += 'display:none; ';}
		_sHTML += 'left:0px; top:0px; z-index:'+_iOverlayZIndex+'; background-color:#000000;"></div>';

		_sHTML += '</div>';
		
		return _sHTML;
	}
	/* @end method */
	
	this.buildScrollbar = function(_sFrameID, _iScrollbarType, _iZIndex) {/*todo*/}
	this.buildCharactersbar = function(_sFrameID, _iCharactersbarType, _iZIndex) {/*todo*/}
	this.buildCharactersContainer = function(_sFrameID, _iScrollMode, _axContents) {/*todo*/}

	/*
	@start method
	
	@description
	[en]Set the size that is used on the top edge of the frame to move the content.[/en]
	[de]Setzt die Größe die am oberen Rand des Frames verwendet wird um den Inhalt zu bewegen.[/de]
	
	@param iSizeY [needed][type]int[/type]
	[en]The height that should be used.[/en]
	[de]Die Höhe die verwendet werden soll.[/de]
	*/
	this.setMoveBorderSizeTop = function(_iSizeY)
	{
		_iSizeY = this.getRealParameter({'oParameters': _iSizeY, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		this.iMoveBorderSizeTop = _iSizeY;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Set the size that is used on the bottom edge of the frame to move the content.[/en]
	[de]Setzt die Größe die am unteren Rand des Frames verwendet wird um den Inhalt zu bewegen.[/de]
	
	@param iSizeY [needed][type]int[/type]
	[en]The height that should be used.[/en]
	[de]Die Höhe die verwendet werden soll.[/de]
	*/
	this.setMoveBorderSizeBottom = function(_iSizeY)
	{
		_iSizeY = this.getRealParameter({'oParameters': _iSizeY, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		this.iMoveBorderSizeBottom = _iSizeY;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Set the size that is used on the left edge of the frame to move the content.[/en]
	[de]Setzt die Größe die am linken Rand des Frames verwendet wird um den Inhalt zu bewegen.[/de]
	
	@param iSizeX [type]int[/type]
	[en]The width that should be used.[/en]
	[de]Die Breite die verwendet werden soll.[/de]
	*/
	this.setMoveBorderSizeLeft = function(_iSizeX)
	{
		_iSizeX = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		this.iMoveBorderSizeLeft = _iSizeX;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Set the size that is used on the right edge of the frame to move the content.[/en]
	[de]Setzt die Größe die am rechten Rand des Frames verwendet wird um den Inhalt zu bewegen.[/de]
	
	@param iSizeX [needed][type]int[/type]
	[en]The width that should be used.[/en]
	[de]Die Breite die verwendet werden soll.[/de]
	*/
	this.setMoveBorderSizeRight = function(_iSizeX)
	{
		_iSizeX = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		this.iMoveBorderSizeRight = _iSizeX;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Set the sizes that is used on the edges of the frame to move the content.[/en]
	[de]Setzt die Größen die am Rand des Frames verwendet wird um den Inhalt zu bewegen.[/de]
	
	@param iTopSizeY [type]int[/type]
	[en]The height that should be used at the top side.[/en]
	[de]Die Höhe die oben verwendet werden soll.[/de]
	
	@param iBottomSizeY [type]int[/type]
	[en]The height that should be used at the bottom side.[/en]
	[de]Die Höhe die unten verwendet werden soll.[/de]
	
	@param iLeftSizeX [type]int[/type]
	[en]The width that should be used at the left side.[/en]
	[de]Die Breite die links verwendet werden soll.[/de]
	
	@param iRightSizeX [type]int[/type]
	[en]The width that should be used at the right side.[/en]
	[de]Die Breite die rechts verwendet werden soll.[/de]
	*/
	this.setMoveBorderSize = function(_iTopSizeY, _iBottomSizeY, _iLeftSizeX, _iRightSizeX)
	{
		if (typeof(_iBottomSizeY) == 'undefined') {var _iBottomSizeY = null;}
		if (typeof(_iLeftSizeX) == 'undefined') {var _iLeftSizeX = null;}
		if (typeof(_iRightSizeX) == 'undefined') {var _iRightSizeX = null;}
		
		_iBottomSizeY = this.getRealParameter({'oParameters': _iTopSizeY, 'sName': 'iBottomSizeY', 'xParameter': _iBottomSizeY});
		_iLeftSizeX = this.getRealParameter({'oParameters': _iTopSizeY, 'sName': 'iLeftSizeX', 'xParameter': _iLeftSizeX});
		_iRightSizeX = this.getRealParameter({'oParameters': _iTopSizeY, 'sName': 'iRightSizeX', 'xParameter': _iRightSizeX});
		_iTopSizeY = this.getRealParameter({'oParameters': _iTopSizeY, 'sName': 'iTopSizeY', 'xParameter': _iTopSizeY});

		this.setMoveBorderSizeTop({'iSizeY': _iTopSizeY});
		this.setMoveBorderSizeBottom({'iSizeY': _iBottomSizeY});
		this.setMoveBorderSizeLeft({'iSizeX': _iLeftSizeX});
		this.setMoveBorderSizeRight({'iSizeX': _iRightSizeX});
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the speed of the updates on moving contents of frames.[/en]
	[de]Setzt die Geschwindigkeit der Aktualisierung beim bewegen von Frameinhalten.[/de]
	
	@param iMilliseconds [needed][type]int[/type]
	[en]The wait time between the updates in milliseconds.[/en]
	[de]Die Wartezeit zwischen den Aktualisierungen in Millisekunden.[/de]
	*/
	this.setMoveInterval = function(_iMilliseconds)
	{
		_iMilliseconds = this.getRealParameter({'oParameters': _iMilliseconds, 'sName': 'iMilliseconds', 'xParameter': _iMilliseconds});
		this.iMoveInterval = _iMilliseconds;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the speed for moving the contents of frames in horizontal direction.[/en]
	[de]Setzt die Geschwindigkeit der Bewegung von Frameinhalten in horizontaler Richtung.[/de]
	
	@param iSpeedX [needed][type]int[/type]
	[en]The horizontal speed.[/en]
	[de]Die horizontale Geschwindigkeit.[/de]
	*/
	this.setMoveSpeedX = function(_iSpeedX)
	{
		_iSpeedX = this.getRealParameter({'oParameters': _iSpeedX, 'sName': 'iSpeedX', 'xParameter': _iSpeedX});
		this.iMoveSpeedX = _iSpeedX;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the speed for moving the contents of frames in vertical direction.[/en]
	[de]Setzt die Geschwindigkeit der Bewegung von Frameinhalten in vertikaler Richtung.[/de]
	
	@param iSpeedY [needed][type]int[/type]
	[en]The vertical speed.[/en]
	[de]Die vertikale Geschwindigkeit.[/de]
	*/
	this.setMoveSpeedY = function(_iSpeedY)
	{
		_iSpeedY = this.getRealParameter({'oParameters': _iSpeedY, 'sName': 'iSpeedY', 'xParameter': _iSpeedY});
		this.iMoveSpeedY = _iSpeedY;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the speed for moving the contents of frames.[/en]
	[de]Setzt die Geschwindigkeit der Bewegung von Frameinhalten.[/de]
	
	@param iSpeedX [type]int[/type]
	[en]The horizontal speed.[/en]
	[de]Die horizontale Geschwindigkeit.[/de]
	
	@param iSpeedY [type]int[/type]
	[en]The vertical speed.[/en]
	[de]Die vertikale Geschwindigkeit.[/de]
	*/
	this.setMoveSpeed = function(_iSpeedX, _iSpeedY)
	{
		if (typeof(_iSpeedY) == 'undefined') {var _iSpeedY = null;}
		
		_iSpeedY = this.getRealParameter({'oParameters': _iSpeedX, 'sName': 'iSpeedY', 'xParameter': _iSpeedY});
		_iSpeedX = this.getRealParameter({'oParameters': _iSpeedX, 'sName': 'iSpeedX', 'xParameter': _iSpeedX});
		
		if (_iSpeedX != null) {this.setMoveSpeedX({'iSpeedX': _iSpeedX});}
		if (_iSpeedY != null) {this.setMoveSpeedY({'iSpeedY': _iSpeedY});}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a frame ID as the currently active frame ID interacts with.[/en]
	[de]Setzt eine Frame ID als aktuell aktive Frame ID, mit der Interagiert wird.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	*/
	this.setActiveID = function(_sFrameID)
	{
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		if (this.sActiveID == '')
		{
			this.sActiveID = _sFrameID;
			if (typeof(this.axFrames[_sFrameID]) != 'undefined')
			{
				var _iScrollMode = this.axFrames[_sFrameID]['iScrollMode'];
				if (this.isMode({'iMode': PG_FRAME_MODE_HOVER, 'iCurrentMode': _iScrollMode})) {this.moveRelativeToMouse();}
				else if (this.isMode({'iMode': PG_FRAME_MODE_BORDERHOVER, 'iCurrentMode': _iScrollMode}))
				{
					if (this.sMoveWithMouseID == '') {this.moveByMouseOnBorder();}
					else {this.moveRelativeToMouse();}
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Unsets the acutally active frame ID.[/en]
	[de]Setzt die aktuell aktive Frame ID auf keine ID.[/de]
	*/
	this.unsetActiveID = function() {this.sActiveID = '';}
	/* @end method */
	
	/*
	this.setActiveScrollBarType = function(_iScrollBarType)
	{
		if (this.iActiveScrollbarType == 0)
		{
			this.iActiveScrollbarType = _iScrollBarType;
		}
	}
	
	this.unsetActiveScrollBarType = function() {this.iActiveScrollbarType = 0;}
	*/
	
	/*
	@start method
	
	@description
	[en]Functionality on global pressing of the mouse button.[/en]
	[de]Funktionalität bei globalem Drücken der Maustaste.[/de]
	
	@param sFrameID [needed][type]int[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	*/
	this.onMouseDown = function(_sFrameID)
	{
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		if (this.sActiveID != '')
		{
			if (typeof(this.axFrames[_sFrameID]) != 'undefined')
			{
				var _iScrollMode = this.axFrames[_sFrameID]['iScollMode'];
				if
				(
					((this.isMode({'iMode': PG_FRAME_MODE_DRAG, 'iCurrentMode': _iScrollMode})) && (this.bDragModeEnabled == true))
					/*
					|| ((this.isMode(PG_FRAME_MODE_SCROLLBAR_LEFT, _iScrollMode)) && (this.iActiveScrollbarType == PG_FRAME_MODE_SCROLLBAR_LEFT))
					|| ((this.isMode(PG_FRAME_MODE_SCROLLBAR_RIGHT, _iScrollMode)) && (this.iActiveScrollbarType == PG_FRAME_MODE_SCROLLBAR_RIGHT))
					|| ((this.isMode(PG_FRAME_MODE_SCROLLBAR_TOP, _iScrollMode)) && (this.iActiveScrollbarType == PG_FRAME_MODE_SCROLLBAR_TOP))
					|| ((this.isMode(PG_FRAME_MODE_SCROLLBAR_BOTTOM, _iScrollMode)) && (this.iActiveScrollbarType == PG_FRAME_MODE_SCROLLBAR_BOTTOM))
					*/
				)
				{
					if (typeof(oPGBrowser) != 'undefined') {oPGBrowser.disableSelect();}
					this.sMoveWithMouseID = this.sActiveID;
					// if (this.iActiveScrollbarType != 0) {this.iMoveWithScrollbarType = this.iActiveScrollbarType;}
					
					// if ((this.isMode(PG_FRAME_MODE_DRAG, _iScrollMode)) && (this.bDragModeEnabled == true) && (this.iActiveScrollbarType == 0))
					// {
						var _oFrameOverlay = this.oDocument.getElementById(this.sMoveWithMouseID+'Overlay');
						if (_oFrameOverlay)
						{
							if (this.sMoveCursor != '')
							{
								var _sCursor = '';
								_sCursor += 'url(\''+this.sMoveCursor+'.png\'), ';
								_sCursor += 'url(\''+this.sMoveCursor+'.gif\'), ';
								_sCursor += 'url(\''+this.sMoveCursor+'.ico\'), ';
								_sCursor += 'url(\''+this.sMoveCursor+'.ani\'), ';
								_sCursor += 'url(\''+this.sMoveCursor+'.cur\'), ';
								_sCursor += 'move';
								_oFrameOverlay.style.cursor = _sCursor;
							}
							else {_oFrameOverlay.style.cursor = 'move';}
						}
					// }
					
					var _oFrame = this.oDocument.getElementById(this.sMoveWithMouseID);
					if (_oFrame)
					{
						this.iMoveWithMouseStartPosX = oPGControls.getRelativeMousePosX({'sElementID': this.sMoveWithMouseID})-parseInt(_oFrame.offsetLeft);
						this.iMoveWithMouseStartPosY = oPGControls.getRelativeMousePosY({'sElementID': this.sMoveWithMouseID})-parseInt(_oFrame.offsetTop);
					}

					return false;
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Functionality on global releasing of the mouse button.[/en]
	[de]Funktionalität bei globalem Loslassen der Maustaste.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	*/
	this.onMouseUp = function(_sFrameID)
	{
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		this.sMoveWithMouseID = '';
		var _oFrameOverlay = this.oDocument.getElementById(_sFrameID+'Overlay');
		if (_oFrameOverlay) {_oFrameOverlay.style.cursor = 'default';}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Functionality on global moving of the mouse button.[/en]
	[de]Funktionalität bei globalem Bewegen der Maustaste.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	*/
	this.onMouseMove = function(_sFrameID)
	{
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		if (this.isMouseOver({'sFrameID': _sFrameID}) == true)
		{
			this.setActiveID({'sFrameID': _sFrameID});
			/* if (this.iMoveWithScrollbarType != 0) {if ((this.sMoveWithMouseID == _sFrameID) && (this.iMoveWithScrollbarType == _iScrollbarType)) {this.moveWithScrollBarHelper(_sFrameID, _iScrollbarType);}}
			else */
			if (this.sMoveWithMouseID == _sFrameID) {this.moveWithMouse();}
		}
		else
		{
			this.unsetActiveID();
			var _oFrameOverlay = this.oDocument.getElementById(this.sMoveWithMouseID+'Overlay');
			if (_oFrameOverlay) {_oFrameOverlay.style.cursor = 'default';}
			this.sMoveWithMouseID = '';
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Adds the ID of a HTML element to the ignore list for mouse over.[/en]
	[de]Fügt die ID eines HTML-Elements der Ignorierliste für Mouse-Over hinzu.[/de]
	
	@param sElementID [needed][type]string[/type]
	[en]The ID of the elemet which should be ignored.[/en]
	[de]Die ID vom Element, das ignoriert werden soll.[/de]
	*/
	this.addIgnoreMouseOverOnElement = function(_sElementID)
	{
		_sElementID = this.getRealParameter({'oParameters': _sElementID, 'sName': 'sElementID', 'xParameter': _sElementID});
		this.asIgnoreMouseOverOnElement.push(_sElementID);
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns whether the mouse cursor is over a certain frame.[/en]
	[de]Gibt zurück, ob der Mauszeiger über einem bestimmten Frame ist.[/de]
	
	@return bIsMouseOver [type]bool[/type]
	[en]Returns a boolean whether the mouse cursor is over a certain frame.[/en]
	[de]Gibt einen Boolean zurück, ob der Mauszeiger über einem bestimmten Frame ist.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	*/
	this.isMouseOver = function(_sFrameID)
	{
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		if (typeof(oPGInput) != 'undefined')
		{
			var _sIgnoreElementID = '';
			var _oIgnoreElement = null;
			var _oDivContainer = this.oDocument.getElementById(_sFrameID+'Container');
			if (_oDivContainer)
			{
				var _iPosX = oPGControls.getRelativeMousePosX({'sElementID': _sFrameID});
				var _iPosY = oPGControls.getRelativeMousePosY({'sElementID': _sFrameID});
				
				if ((_iPosX >= 0) && (_iPosY >= 0)
				&& (_iPosX <= parseInt(_oDivContainer.offsetWidth))
				&& (_iPosY <= parseInt(_oDivContainer.offsetHeight)))
				{
					for (var i=0; i<this.asIgnoreMouseOverOnElement.length; i++)
					{
						_sIgnoreElementID = this.asIgnoreMouseOverOnElement[i];
						_oIgnoreElement = this.oDocument.getElementById(_sIgnoreElementID);
						if (_oDivContainer)
						{
							_iPosX = oPGControls.getRelativeMousePosX({'sElementID': _sIgnoreElementID});
							_iPosY = oPGControls.getRelativeMousePosY({'sElementID': _sIgnoreElementID});
							if ((_iPosX >= 0) && (_iPosY >= 0)
							&& (_iPosX <= parseInt(_oIgnoreElement.offsetWidth))
							&& (_iPosY <= parseInt(_oIgnoreElement.offsetHeight)))
							{
								this.sMouseOverID = _sIgnoreElementID;
								return false;
							}
						}
					}
					this.sMouseOverID = _sFrameID;
					return true;
				}
				this.sMouseOverID = '';
				return false;
			}
		}
		this.sMouseOverID = '';
		return null;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the ID of the frame where the mouse pointer is currently over.[/en]
	[de]Gibt die ID des Frames zurück, bei dem der Mauszeiger gerade drüber ist.[/de]
	*/
	this.getMouseOverID = function() {return this.sMouseOverID;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Moves the content of the currently active frame relative to the mouse cursor.[/en]
	[de]Bewegt den Inhalt des gerade aktivem Frame relativ zum Mauszeiger.[/de]
	*/
	this.moveRelativeToMouse = function()
	{
		if (oPGFrame.sActiveID != '')
		{
			var _iPercentX = oPGControls.getRelativeMousePercentX({'sElementID': oPGFrame.sActiveID});
			var _iPercentY = oPGControls.getRelativeMousePercentY({'sElementID': oPGFrame.sActiveID});
			oPGFrame.movePercent({'sFrameID': oPGFrame.sActiveID, 'iMoveX': oPGFrame.iMoveSpeedX, 'iMoveY': oPGFrame.iMoveSpeedY, 'iPercentX': _iPercentX, 'iPercentY': _iPercentY});
			oPGFrame.oWindow.setTimeout('oPGFrame.moveRelativeToMouse()', oPGFrame.iMoveInterval);
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Moves the contents of the currently active frame on touching the edge of the frame.[/en]
	[de]Bewegt den Inhalt des gerade aktivem Frame bei Berührung des Framerandes.[/de]
	*/
	this.moveByMouseOnBorder = function()
	{
		if (oPGFrame.sActiveID != '')
		{
			var _oDivContainer = oPGFrame.oDocument.getElementById(oPGFrame.sActiveID+'Container');
			if (_oDivContainer)
			{
				var _iPosX = oPGControls.getRelativeMousePosX({'sElementID': oPGFrame.sActiveID});
				var _iPosY = oPGControls.getRelativeMousePosY({'sElementID': oPGFrame.sActiveID});
				if ((_iPosX) && (_iPosY))
				{
					if (_iPosY <= oPGFrame.iMoveBorderSizeTop) {oPGFrame.move({'sFrameID': oPGFrame.sActiveID, 'iMoveX': null, 'iMoveY': -oPGFrame.iMoveSpeedY});}
					if (_iPosY >= parseInt(_oDivContainer.offsetHeight)-oPGFrame.iMoveBorderSizeBottom) {oPGFrame.move({'sFrameID': oPGFrame.sActiveID, 'iMoveX': null, 'iMoveY': oPGFrame.iMoveSpeedY});}
					if (_iPosX <= oPGFrame.iMoveBorderSizeLeft) {oPGFrame.move({'sFrameID': oPGFrame.sActiveID, 'iMoveX': -oPGFrame.iMoveSpeedX, 'iMoveY': null});}
					if (_iPosX >= parseInt(_oDivContainer.offsetWidth)-oPGFrame.iMoveBorderSizeRight) {oPGFrame.move({'sFrameID': oPGFrame.sActiveID, 'iMoveX': oPGFrame.iMoveSpeedX, 'iMoveY': null});}
				}
				oPGFrame.oWindow.setTimeout('oPGFrame.moveByMouseOnBorder()', oPGFrame.iMoveInterval);
			}
		}
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Moves the content of the currently actvive frame with the mouse cursor.[/en]
	[de]Bewegt den Inhalt des gerade aktivem Frame mit dem Mauszeiger.[/de]
	*/
	this.moveWithMouse = function()
	{
		if ((this.sMoveWithMouseID != '') && (typeof(oPGInput) != 'undefined'))
		{
			var _oDivContainer = this.oDocument.getElementById(this.sMoveWithMouseID+'Container');
			var _oDiv = this.oDocument.getElementById(this.sMoveWithMouseID);
			if ((_oDivContainer) && (_oDiv))
			{
				// var _iPosX = oPGInput.getDocPosX();
				var _iPosX = oPGControls.getRelativeMousePosX({'sElementID': this.sMoveWithMouseID});
				if (_iPosX != null)
				{
					var _iDivSizeX = parseInt(_oDiv.offsetWidth);
					var _iDivContainerSizeX = parseInt(_oDivContainer.offsetWidth);
					_oDiv.style.left = Math.max(Math.min(_iPosX-this.iMoveWithMouseStartPosX, 0), _iDivContainerSizeX-_iDivSizeX)+'px';
				}
				
				// var _iPosY = oPGInput.getDocPosY();
				var _iPosY = oPGControls.getRelativeMousePosY({'sElementID': this.sMoveWithMouseID});
				if (_iPosY != null)
				{
					var _iDivSizeY = parseInt(_oDiv.offsetHeight);
					var _iDivContainerSizeY = parseInt(_oDivContainer.offsetHeight);
					_oDiv.style.top = Math.max(Math.min(_iPosY-this.iMoveWithMouseStartPosY, 0), _iDivContainerSizeY-_iDivSizeY)+'px';
				}
			}
		}
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Moves the content prozentually to a move distance.[/en]
	[de]Bewegt den Inhalt prozentual zu einer Bewegungsdistanz.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param iMoveX [needed][type]int[/type]
	[en]The horizontal move distance.[/en]
	[de]Die horizontale Bewegungsdistanz.[/de]
	
	@param iMoveY [needed][type]int[/type]
	[en]The vertical move distance.[/en]
	[de]Die vertikale Bewegungsdistanz.[/de]
	
	@param iPercentX [needed][type]int[/type]
	[en]The percentage amount of content to be moved from the horizontal movement distance.[/en]
	[de]Die Prozent die der Inhalt von der horizontalen Bewegungsdistanz bewegt werden soll.[/de]
	
	@param iPercentY [needed][type]int[/type]
	[en]The percentage amount of content to be moved from the vertical movement distance.[/en]
	[de]Die Prozent die der Inhalt von der vertikalen Bewegungsdistanz bewegt werden soll.[/de]
	*/
	this.movePercent = function(_sFrameID, _iMoveX, _iMoveY, _iPercentX, _iPercentY)
	{
		if (typeof(_iMoveX) == 'undefined') {var _iMoveX = null;}
		if (typeof(_iMoveY) == 'undefined') {var _iMoveY = null;}
		if (typeof(_iPercentX) == 'undefined') {var _iPercentX = null;}
		if (typeof(_sUploadID) == 'undefined') {var _sUploadID = null;}

		_iMoveX = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'iMoveX', 'xParameter': _iMoveX});
		_iMoveY = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'iMoveY', 'xParameter': _iMoveY});
		_iPercentX = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'iPercentX', 'xParameter': _iPercentX});
		_iPercentY = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'iPercentY', 'xParameter': _iPercentY});
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		_iPercentX = (_iPercentX-50)*2;
		_iPercentY = (_iPercentY-50)*2;
		var _iNewMoveX = Math.ceil(_iMoveX*_iPercentX/100);
		var _iNewMoveY = Math.ceil(_iMoveY*_iPercentY/100);
		this.move({'sFrameID': _sFrameID, 'iMoveX': _iNewMoveX, 'iMoveY': _iNewMoveY});
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Move the contents of a frame to a certain distance.[/en]
	[de]Bewegt den Inhalt eines Frames um eine bestimmte Distanz.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param iMoveX [type]int[/type]
	[en]The distance to be moved, the content in the X-direction.[/en]
	[de]Die Distanz, die der Inhalt in der X-Richtung bewegt werden soll.[/de]
	
	@param iMoveY [type]int[/type]
	[en]The distance to be moved, the content in the Y-direction.[/en]
	[de]Die Distanz, die der Inhalt in der Y-Richtung bewegt werden soll.[/de]
	*/
	this.move = function(_sFrameID, _iMoveX, _iMoveY)
	{
		if (typeof(_iMoveX) == 'undefined') {var _iMoveX = null;}
		if (typeof(_iMoveY) == 'undefined') {var _iMoveY = null;}

		_iMoveX = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'iMoveX', 'xParameter': _iMoveX});
		_iMoveY = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'iMoveY', 'xParameter': _iMoveY});
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		var _oDivContainer = this.oDocument.getElementById(_sFrameID+'Container');
		var _oDiv = this.oDocument.getElementById(_sFrameID);
		if ((_oDivContainer) && (_oDiv))
		{
			if ((_iMoveX != null) && (_iMoveX != 0))
			{
				var _iDivPosX = parseInt(_oDiv.offsetLeft);
				var _iDivSizeX = parseInt(_oDiv.offsetWidth);
				var _iDivContainerSizeX = parseInt(_oDivContainer.offsetWidth);
				_oDiv.style.left = Math.max(Math.min(_iDivPosX-_iMoveX, 0), _iDivContainerSizeX-_iDivSizeX)+'px';
			}
			
			if ((_iMoveY != null) && (_iMoveY != 0))
			{
				var _iDivPosY = parseInt(_oDiv.offsetTop);
				var _iDivSizeY = parseInt(_oDiv.offsetHeight);
				var _iDivContainerSizeY = parseInt(_oDivContainer.offsetHeight);
				_oDiv.style.top = Math.max(Math.min(_iDivPosY-_iMoveY, 0), _iDivContainerSizeY-_iDivSizeY)+'px';
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Stops the move of the contents by the scroll bar.[/en]
	[de]Stoppt das Bewegen des Inhalts durch die Scrollbar.[/de]
	*/
	this.stopScrollBarMove = function()
	{
		if (this.oScrollBarMoveTimeout != null) {this.oWindow.clearInterval(this.oScrollBarMoveTimeout);}
		this.oScrollBarMoveTimeout = null;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Functionality that is executed when you release the scroll bar.[/en]
	[de]Funktionalität die beim Loslassen der Scrollbar ausgeführt wird.[/de]
	*/
	this.onScrollBarMoveRelease = function()
	{
		this.stopScrollBarMove();
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Functionality that is executed when you touch the scroll bar.[/en]
	[de]Funktionalität die beim Berühren der Scrollbar ausgeführt wird.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param iMoveX [type]int[/type]
	[en]The distance to be moved, the content in the X-direction.[/en]
	[de]Die Distanz, die der Inhalt in der X-Richtung bewegt werden soll.[/de]
	
	@param iMoveY [type]int[/type]
	[en]The distance to be moved, the content in the Y-direction.[/en]
	[de]Die Distanz, die der Inhalt in der Y-Richtung bewegt werden soll.[/de]
	*/
	this.onScrollBarMoveTouch = function(_sFrameID, _iMoveX, _iMoveY)
	{
		if (typeof(_iMoveX) == 'undefined') {var _iMoveX = null;}
		if (typeof(_iMoveY) == 'undefined') {var _iMoveY = null;}

		_iMoveX = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'iMoveX', 'xParameter': _iMoveX});
		_iMoveY = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'iMoveY', 'xParameter': _iMoveY});
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		if (_iMoveX == null) {_iMoveX = 0;}
		if (_iMoveY == null) {_iMoveY = 0;}
		oPGFrame.move({'sFrameID': _sFrameID, 'iMoveX': _iMoveX, 'iMoveY': _iMoveY});
		if (oPGFrame.oScrollBarMoveTimeout == null)
		{
			oPGFrame.oScrollBarMoveTimeout = oPGFrame.oWindow.setInterval("oPGFrame.onScrollBarMoveTouch({'sFrameID': '"+_sFrameID+"', 'iMoveX': "+_iMoveX+", 'iMoveY': "+_iMoveY+"})", 100);
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Displays a control help for scroll bars on mobile devices. (Not yet implemented!)[/en]
	[de]Zeigt eine Bedienhilfe für Scrollbalken bei Mobilgeräten an. (Noch nicht integriert!)[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param iScrollbarType [needed][type]int[/type]
	[en]The type of the scrollbar.[/en]
	[de]Der Typ der Scrollbar.[/de]
	*/
	this.showScrollBarTouchHelper = function(_sFrameID, _iScrollbarType)
	{
		if (typeof(_iScrollbarType) == 'undefined') {var _iScrollbarType = null;}

		_iScrollbarType = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'iScrollbarType', 'xParameter': _iScrollbarType});
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		var _oScrollBarHelper = this.oDocument.getElementById(_sFrameID+'Scrollbar'+_iScrollbarType+'Helper');
		if (_oScrollBarHelper) {_oScrollBarHelper.style.display = 'block';}
		this.setActiveScrollBarType(_iScrollbarType);
		
		// this.changeMode(_sFrameID, PG_FRAME_MODE_DRAG+_iScrollbarType);
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Hides the control help for scroll bars on mobile devices. (Not yet implemented!)[/en]
	[de]Versteckt die Bedienhilfe für Scrollbalken bei Mobilgeräten. (Noch nicht integriert!)[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param iScrollbarType [needed][type]int[/type]
	[en]The type of the scrollbar.[/en]
	[de]Der Typ der Scrollbar.[/de]
	*/
	this.hideScrollBarTouchHelper = function(_sFrameID, _iScrollbarType)
	{
		if (typeof(_iScrollbarType) == 'undefined') {var _iScrollbarType = null;}

		_iScrollbarType = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'iScrollbarType', 'xParameter': _iScrollbarType});
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		var _oScrollBarHelper = this.oDocument.getElementById(_sFrameID+'Scrollbar'+_iScrollbarType+'Helper');
		var _oScrollBarHelper = this.oDocument.getElementById(_sFrameID+'Scrollbar'+_iScrollbarType+'Helper');
		if (_oScrollBarHelper) {_oScrollBarHelper.style.display = 'none';}
		this.unsetActiveScrollBarType();
		
		// this.changeMode(_sFrameID, _iScrollbarType-PG_FRAME_MODE_DRAG);
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Move the contents of a frame by the scroll bar control help.[/en]
	[de]Bewegt den Inhalt eines Frames durch die Scrollbar Bedienhilfe.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param iScrollbarType [needed][type]int[/type]
	[en]The type of the scrollbar.[/en]
	[de]Der Typ der Scrollbar.[/de]
	*/
	this.moveWithScrollBarHelper = function(_sFrameID, _iScrollbarType)
	{
		if (typeof(_iScrollbarType) == 'undefined') {var _iScrollbarType = null;}

		_iScrollbarType = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'iScrollbarType', 'xParameter': _iScrollbarType});
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		var _oScrollBarHelper = this.oDocument.getElementById(_sFrameID+'Scrollbar'+_iScrollbarType+'Helper');
		// var _oScrollBarHelper = oPGFrame.oDocument.getElementById(_sFrameID+'Scrollbar'+_iScrollbarType+'Helper');
		var _oDivContainer = this.oDocument.getElementById(_sFrameID+'Container');
		var _oDiv = this.oDocument.getElementById(_sFrameID);
		if ((_oScrollBarHelper) && (_oDivContainer) && (_oDiv))
		{
			if ((_iScrollbarType == PG_FRAME_MODE_SCROLLBAR_LEFT) || (_iScrollbarType == PG_FRAME_MODE_SCROLLBAR_RIGHT))
			{
				var _iHelperPosY = 0;
				var _iFrameSizeY = parseInt(_oDivContainer.offsetHeight);
				var _iScrollBarHelperSizeY = parseInt(_oScrollBarHelper.offsetHeight);
				var _iScrollBarHelperHalfSizeY = Math.round(_iScrollBarHelperSizeY/2);
				
				_iHelperPosY = oPGControls.getRelativeMousePosY({'sElementID': _sFrameID});
				_oScrollBarHelper.style.top = Math.max(0, Math.min((_iHelperPosY-_iScrollBarHelperHalfSizeY), _iFrameSizeY-_iScrollBarHelperSizeY))+'px';
				
				var _iPercentY = Math.round(_iHelperPosY/(_iFrameSizeY-_iScrollBarHelperSizeY)*100);
				var _iContentSizeY = parseInt(_oDiv.offsetHeight);
				var _iPosY = Math.round(_iContentSizeY/100*_iPercentY);
				
				oPGFrame.setScrollPos({'sFrameID': _sFrameID, 'iPosX': null, 'iPosY': _iPosY});
			}
			else
			{
				var _iHelperPosX = 0;
				var _iFrameSizeX = parseInt(_oDivContainer.offsetWidth);
				var _iScrollBarHelperSizeX = parseInt(_oScrollBarHelper.offsetWidth);
				var _iScrollBarHelperHalfSizeX = Math.round(_iScrollBarHelperSizeX/2);
				
				_iHelperPosX = oPGControls.getRelativeMousePosX({'sElementID': _sFrameID});
				_oScrollBarHelper.style.left = Math.max(0, Math.min((_iHelperPosX-_iScrollBarHelperHalfSizeX), _iFrameSizeX-_iScrollBarHelperSizeX))+'px';
			
				var _iPercentX = Math.round(_iHelperPosX/(_iFrameSizeX-_iScrollBarHelperSizeX)*100);
				var _iContentSizeX = parseInt(_oDiv.offsetWidth);
				var _iPosX = Math.round(_iContentSizeX/100*_iPercentX);
				
				oPGFrame.setScrollPos({'sFrameID': _sFrameID, 'iPosX': _iPosX, 'iPosY': null});
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the position for the middle of the content and moved the contents to this position.[/en]
	[de]Setzt die Position für die Mitte des Inhalts und Bewegt den Inhalt zu dieser Position.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param iPosX [needed][type]int[/type]
	[en]The position in the X-direction.[/en]
	[de]Die Position in X-Richtung.[/de]
	
	@param iPosY [needed][type]int[/type]
	[en]The position in the Y-direction.[/en]
	[de]Die Position in Y-Richtung.[/de]
	*/
	this.setCenterPos = function(_sFrameID, _iPosX, _iPosY)
	{
		if (typeof(_iPosX) == 'undefined') {var _iPosX = null;}
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}

		_iPosX = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'iPosX', 'xParameter': _iPosX});
		_iPosY = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'iPosY', 'xParameter': _iPosY});
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		var _oFrameContainer = this.oDocument.getElementById(_sFrameID+'Container');
		if (_oFrameContainer)
		{
			_iPosX = Math.floor(_iPosX - (parseInt(_oFrameContainer.offsetWidth)/2));
			_iPosY = Math.floor(_iPosY - (parseInt(_oFrameContainer.offsetHeight)/2));
			this.setScrollPos({'sFrameID': _sFrameID, 'iPosX': _iPosX, 'iPosY': _iPosY});
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the scroll position of the frame for the content.[/en]
	[de]Setzt die Scroll-Position des Frames für den Inhalt.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param iPosX [type]int[/type]
	[en]The position in the X-direction.[/en]
	[de]Die Position in X-Richtung.[/de]
	
	@param iPosY [type]int[/type]
	[en]The position in the Y-direction.[/en]
	[de]Die Position in Y-Richtung.[/de]
	*/
	this.setScrollPos = function(_sFrameID, _iPosX, _iPosY)
	{
		if (typeof(_iPosX) == 'undefined') {var _iPosX = null;}
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}

		_iPosX = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'iPosX', 'xParameter': _iPosX});
		_iPosY = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'iPosY', 'xParameter': _iPosY});
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		var _oFrame = this.oDocument.getElementById(_sFrameID);
		var _oFrameContainer = this.oDocument.getElementById(_sFrameID+'Container');
		if ((_oFrame) && (_oFrameContainer) && (typeof(this.axFrames[_sFrameID]) != 'undefined'))
		{
			var _iScrollMode = this.axFrames[_sFrameID]['iScrollMode'];
			if (!isNaN(_iScrollMode))
			{
				if (this.isMode({'iMode': PG_FRAME_MODE_SCROLLBAR, 'iCurrentMode': _iScrollMode}))
				{
					if (_iPosX != null) {_oFrameContainer.scrollLeft = _iPosX;}
					if (_iPosY != null) {_oFrameContainer.scrollTop = _iPosY;}
				}
				else
				{
					if (_iPosX != null)
					{
						var _iMinX = -parseInt(_oFrame.offsetWidth)+parseInt(_oFrameContainer.offsetWidth);
						_oFrame.style.left = Math.min(Math.max(-_iPosX, _iMinX), 0)+'px';
					}
					
					if (_iPosY != null)
					{
						var _iMinY = -parseInt(_oFrame.offsetHeight)+parseInt(_oFrameContainer.offsetHeight);
						_oFrame.style.top = Math.min(Math.max(-_iPosY, _iMinY), 0)+'px';
					}
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Recalculates elements of a frame, such as Controls.[/en]
	[de]Berechnet Elemente, wie z.B. Bedienelemente, eines Frames neu.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	*/
	this.recalculateElements = function(_sFrameID)
	{
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		var _oFrame = this.oDocument.getElementById(_sFrameID+'Container');
		if ((typeof(this.axFrames[_sFrameID]) != 'undefined') && (_oFrame))
		{
			var _iFrameSizeX = parseInt(_oFrame.offsetWidth);
			var _iFrameSizeY = parseInt(_oFrame.offsetHeight);
			var _iScrollMode = this.axFrames[_sFrameID]['iScrollMode'];
			if ((!isNaN(_iScrollMode)) && (!isNaN(_iFrameSizeX)) && (!isNaN(_iFrameSizeY)))
			{
				var _oScrollbar = null;
				var _oScrollbarTrack = null;
				if (this.isMode({'iMode': PG_FRAME_MODE_SCROLLBAR_LEFT, 'iCurrentMode': _iScrollMode}))
				{
					_oScrollbar = this.oDocument.getElementById(_sFrameID+'Scrollbar'+PG_FRAME_MODE_SCROLLBAR_LEFT);
					if (_oScrollbar) {_oScrollbar.style.height = _iFrameSizeY+'px';}
					_oScrollbarTrack = this.oDocument.getElementById(_sFrameID+'Scrollbar'+PG_FRAME_MODE_SCROLLBAR_LEFT+'Track');
					if (_oScrollbarTrack) {_oScrollbarTrack.style.height = (_iFrameSizeY-30)+'px';}
				}
				
				if (this.isMode({'iMode': PG_FRAME_MODE_SCROLLBAR_RIGHT, 'iCurrentMode': _iScrollMode}))
				{
					_oScrollbar = this.oDocument.getElementById(_sFrameID+'Scrollbar'+PG_FRAME_MODE_SCROLLBAR_RIGHT);
					if (_oScrollbar) {_oScrollbar.style.height = _iFrameSizeY+'px';}
					_oScrollbarTrack = this.oDocument.getElementById(_sFrameID+'Scrollbar'+PG_FRAME_MODE_SCROLLBAR_RIGHT+'Track');
					if (_oScrollbarTrack) {_oScrollbarTrack.style.height = (_iFrameSizeY-30)+'px';}
				}
				
				if (this.isMode({'iMode': PG_FRAME_MODE_SCROLLBAR_TOP, 'iCurrentMode': _iScrollMode}))
				{
					_oScrollbar = this.oDocument.getElementById(_sFrameID+'Scrollbar'+PG_FRAME_MODE_SCROLLBAR_TOP);
					if (_oScrollbar) {_oScrollbar.style.width = _iFrameSizeX+'px';}
					_oScrollbarTrack = this.oDocument.getElementById(_sFrameID+'Scrollbar'+PG_FRAME_MODE_SCROLLBAR_TOP+'Track');
					if (_oScrollbarTrack) {_oScrollbarTrack.style.width = (_iFrameSizeX-30)+'px';}
				}
				
				if (this.isMode({'iMode': PG_FRAME_MODE_SCROLLBAR_BOTTOM, 'iCurrentMode': _iScrollMode}))
				{
					_oScrollbar = this.oDocument.getElementById(_sFrameID+'Scrollbar'+PG_FRAME_MODE_SCROLLBAR_BOTTOM);
					if (_oScrollbar) {_oScrollbar.style.width = _iFrameSizeX+'px';}
					_oScrollbarTrack = this.oDocument.getElementById(_sFrameID+'Scrollbar'+PG_FRAME_MODE_SCROLLBAR_BOTTOM+'Track');
					if (_oScrollbarTrack) {_oScrollbarTrack.style.width = (_iFrameSizeX-30)+'px';}
				}
				
				var _oCharactersbar = null;
				if (this.isMode({'iMode': PG_FRAME_MODE_CHARACTERSBAR_LEFT, 'iCurrentMode': _iScrollMode}))
				{
					_oCharactersbar = this.oDocument.getElementById(_sFrameID+'Charactersbar'+PG_FRAME_MODE_CHARACTERSBAR_LEFT);
					if (_oCharactersbar)
					{
						_oCharactersbar.style.top = '0px';
						_oCharactersbar.style.left = '0px';
						_oCharactersbar.style.height = _iFrameSizeY+'px';
					}
				}
				if (this.isMode({'iMode': PG_FRAME_MODE_CHARACTERSBAR_RIGHT, 'iCurrentMode': _iScrollMode}))
				{
					_oCharactersbar = this.oDocument.getElementById(_sFrameID+'Charactersbar'+PG_FRAME_MODE_CHARACTERSBAR_RIGHT);
					if (_oCharactersbar)
					{
						_oCharactersbar.style.top = '0px';
						_oCharactersbar.style.left = (_iFrameSizeX-15)+'px';
						_oCharactersbar.style.height = _iFrameSizeY+'px';
					}
				}
				if (this.isMode({'iMode': PG_FRAME_MODE_CHARACTERSBAR_TOP, 'iCurrentMode': _iScrollMode}))
				{
					_oCharactersbar = this.oDocument.getElementById(_sFrameID+'Charactersbar'+PG_FRAME_MODE_CHARACTERSBAR_TOP);
					if (_oCharactersbar)
					{
						_oCharactersbar.style.top = '0px';
						_oCharactersbar.style.left = '0px';
						_oCharactersbar.style.width = _iFrameSizeX+'px';
					}
				}
				if (this.isMode({'iMode': PG_FRAME_MODE_CHARACTERSBAR_BOTTOM, 'iCurrentMode': _iScrollMode}))
				{
					_oCharactersbar = this.oDocument.getElementById(_sFrameID+'Charactersbar'+PG_FRAME_MODE_CHARACTERSBAR_BOTTOM);
					if (_oCharactersbar)
					{
						_oCharactersbar.style.top = (_iFrameSizeY-15)+'px';
						_oCharactersbar.style.left = '0px';
						_oCharactersbar.style.width = _iFrameSizeX+'px';
					}
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the width of a frame.[/en]
	[de]Gibt die Breite eines Frames zurück.[/de]
	
	@return iSizeX [type]int[/type]
	[en]Returns the width of a frame as an integer.[/en]
	[de]Gibt die Breite eines Frames als Integer zurück.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	*/
	this.getSizeX = function(_sFrameID)
	{
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});
		var _oFrameContainer = this.oDocument.getElementById(_sFrameID+'Container');
		return parseInt(_oFrameContainer.offsetWidth);
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the width of a frame.[/en]
	[de]Gibt die Breite eines Frames zurück.[/de]
	
	@return iSizeY [type]int[/type]
	[en]Returns the height of a frame as an integer.[/en]
	[de]Gibt die Höhe eines Frames als Integer zurück.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	*/
	this.getSizeY = function(_sFrameID)
	{
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});
		var _oFrameContainer = this.oDocument.getElementById(_sFrameID+'Container');
		return parseInt(_oFrameContainer.offsetHeight);
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the width of a frame.[/en]
	[de]Setzt die Breite eines Frames.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param sSizeX [needed][type]string[/type]
	[en]The width to be set.[/en]
	[de]Die Breite die gesetzt werden soll.[/de]
	*/
	this.setSizeX = function(_sFrameID, _sSizeX)
	{
		if (typeof(_sSizeX) == 'undefined') {var _sSizeX = null;}

		_sSizeX = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sSizeX', 'xParameter': _sSizeX});
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		var _oFrameContainer = this.oDocument.getElementById(_sFrameID+'Container');
		if (_oFrameContainer) {_oFrameContainer.style.width = _sSizeX;}

		var _oFrameOverlay = this.oDocument.getElementById(_sFrameID+'Overlay');
		if (_oFrameOverlay) {_oFrameOverlay.style.width = _sSizeX;}
		
		this.recalculateElements({'sFrameID': _sFrameID});
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the height of a frame.[/en]
	[de]Setzt die Höhe eines Frames.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param sSizeY [needed][type]string[/type]
	[en]The height to be set.[/en]
	[de]Die Höhe die gesetzt werden soll.[/de]
	*/
	this.setSizeY = function(_sFrameID, _sSizeY)
	{
		if (typeof(_sSizeY) == 'undefined') {var _sSizeY = null;}

		_sSizeY = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sSizeY', 'xParameter': _sSizeY});
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		var _oFrameContainer = this.oDocument.getElementById(_sFrameID+'Container');
		if (_oFrameContainer) {_oFrameContainer.style.height = _sSizeY;}
		
		var _oFrameOverlay = this.oDocument.getElementById(_sFrameID+'Overlay');
		if (_oFrameOverlay) {_oFrameOverlay.style.height = _sSizeY;}
		
		this.recalculateElements({'sFrameID': _sFrameID});
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the sizes of a frame.[/en]
	[de]Setzt die Größe eines Frames.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param sSizeX [type]string[/type]
	[en]The width to be set.[/en]
	[de]Die Breite die gesetzt werden soll.[/de]
	
	@param sSizeY [type]string[/type]
	[en]The height to be set.[/en]
	[de]Die Höhe die gesetzt werden soll.[/de]
	*/
	this.setSize = function(_sFrameID, _sSizeX, _sSizeY)
	{
		if (typeof(_sSizeX) == 'undefined') {var _sSizeX = null;}
		if (typeof(_sSizeY) == 'undefined') {var _sSizeY = null;}

		_sSizeX = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sSizeX', 'xParameter': _sSizeX});
		_sSizeY = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sSizeY', 'xParameter': _sSizeY});
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		if (_sSizeX != null) {this.setSizeX({'sFrameID': _sFrameID, 'sSizeX': _sSizeX});}
		if (_sSizeY != null) {this.setSizeY({'sFrameID': _sFrameID, 'sSizeY': _sSizeY});}
		
		this.recalculateElements({'sFrameID': _sFrameID});
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Moves the content to a specific letter from a character-containers.[/en]
	[de]Bewegt den Inhalt zu einem bestimmten Buchstaben von einem Charakters-Kontainer.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param sCharacter [needed][type]string[/type]
	[en]The letter to which should be moved.[/en]
	[de]Der Buchstabe zu dem bewegt werden soll.[/de]
	*/
	this.jumpToCharacter = function(_sFrameID, _sCharacter)
	{
		if (typeof(_sCharacter) == 'undefined') {var _sCharacter = null;}

		_sCharacter = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sCharacter', 'xParameter': _sCharacter});
		_sFrameID = this.getRealParameter({'oParameters': _sFrameID, 'sName': 'sFrameID', 'xParameter': _sFrameID});

		var _oFrameCharacter = this.oDocument.getElementById(_sFrameID+'CharactersContainer'+_sCharacter);
		if (_oFrameCharacter)
		{
			var _iNewPosX = parseInt(_oFrameCharacter.offsetLeft);
			var _iNewPosY = parseInt(_oFrameCharacter.offsetTop);
			if ((!isNaN(_iNewPosX)) && (!isNaN(_iNewPosY)))
			{
				this.setScrollPos({'sFrameID': _sFrameID, 'iPosX': _iNewPosX, 'iPosY': _iNewPosY});
			}
		}
	}
	/* @end method */
}
/* @end class */
classPG_Frame.prototype = new classPG_ClassBasics();
var oPGFrame = new classPG_Frame();
