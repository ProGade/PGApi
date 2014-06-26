/*
* ProGade API
* http://api.progade.de/
*
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: "http://api.progade.de/api_terms.php" or "./license.txt"
*
* Last changes of this file: Nov 09 2012
*/
/*
@start class

@description
[en]This class has methods to the create and display HTML alements as popups.[/en]
[de]Diese Klasse verfügt über Methoden zum erstellen und anzeigen von HTML-Elementen als Popup.[/de]

@param extends classPG_ClassBasics
*/
function classPG_Popup()
{
	// Declarations...
	
	// Construct...
	this.setID({'sID': 'PGPopup'});
	this.initClassBasics();
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Removes a popup element.[/en]
	[de]Entfernt ein Popup Element.[/de]
	
	@param sPopupID [needed][type]string[/type]
	[en]The ID of the popup element.[/en]
	[de]Die ID des Popup Elements.[/de]
	*/
	this.remove = function(_sPopupID)
	{
		_sPopupID = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'sPopupID', 'xParameter': _sPopupID});
		var _oPopup = this.oDocument.getElementById(_sPopupID);
		if (_sPopupID) {_sPopupID.outerHTML = '';}
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Builds and places an popup HTML element.[/en]
	[de]Erstellt und platziert ein Popup HTML-Element.[/de]
	
	@param xContainer [needed][type]mixed[/type]
	[en]The container in which the popup element should be placed.[/en]
	[de]Der Kontainer in den das Popup Element platziert werden soll.[/de]
	
	@param sPopupID [type]string[/type]
	[en]The ID of the popup.[/en]
	[de]Die ID des Popups.[/de]
	
	@param sContent [type]string[/type]
	[en]The content for the popup.[/en]
	[de]Der Inhalt für das Popup.[/de]
	
	@param iSizeX [type]int[/type]
	[en]The width of the popup.[/en]
	[de]Die Breite des Popups.[/de]
	
	@param iSizeY [type]int[/type]
	[en]The height of the popup.[/en]
	[de]Die Höhe des Popups.[/de]
	
	@param iZIndex [type]int[/type]
	[en]The level (Z-index) where the popup should be displayed.[/en]
	[de]Die Ebene (Z-Index) auf der das Popup dargestellt werden soll.[/de]
	
	@param iOverlayAlpha [type]int[/type]
	[en]The transparency of the background where the popup will be displayed. The background is darkened.[/en]
	[de]Die Transparenz für den Hintergrund worauf das Popup dargestellt werden soll. Der Hintergrund wird abgedunkelt.[/de]
	
	@param iOverlayAlphaSpeedTimeout [type]int[/type]
	[en]The speed of darkening the background. The higher the number (in milliseconds) the slower the effect.[/en]
	[de]Die Geschwindigkeit für das Abdunkeln des Hintergundes. Je größer die Zahl (in Millisekunden) um so langsamer der Effeckt.[/de]
	
	@param bHideOnBackgroundClick [type]bool[/type]
	[en]Specifies whether the popup should hide on clicking on the background.[/en]
	[de]Gibt an ob bei einem Klick auf den Hintergrund das Popup geschlossen werden soll.[/de]
	
	@param sCssStyle [type]string[/type]
	[en]CSS code for the popup element.[/en]
	[de]CSS Code für das Popup Element.[/de]
	
	@param sCssClass [type]string[/type]
	[en]CSS class for the popup element.[/en]
	[de]CSS Klasse für das Popup Element.[/de]
	*/
	this.buildInto = function(
		_xContainer,
		_sPopupID,
		_sContent,
		_iSizeX,
		_iSizeY,
		_iZIndex,
		_iOverlayAlpha,
		_iOverlayAlphaSpeedTimeout,
		_bHideOnBackgroundClick,
		_sCssStyle,
		_sCssClass
	)
	{
		if (typeof(_xContainer) == 'undefined') {var _xContainer = null;}
		if (typeof(_sPopupID) == 'undefined') {var _sPopupID = null;}
		if (typeof(_sContent) == 'undefined') {var _sContent = null;}
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = null;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}
		if (typeof(_iZIndex) == 'undefined') {var _iZIndex = null;}
		if (typeof(_iOverlayAlpha) == 'undefined') {var _iOverlayAlpha = null;}
		if (typeof(_iOverlayAlphaSpeedTimeout) == 'undefined') {var _iOverlayAlphaSpeedTimeout = null;}
		if (typeof(_bHideOnBackgroundClick) == 'undefined') {var _bHideOnBackgroundClick = null;}
		if (typeof(_sCssStyle) == 'undefined') {var _sCssStyle = null;}
		if (typeof(_sCssClass) == 'undefined') {var _sCssClass = null;}

		_sPopupID = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sPopupID', 'xParameter': _sPopupID});
		_sContent = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sContent', 'xParameter': _sContent});
		_iSizeX = this.getRealParameter({'oParameters': _xContainer, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		_iSizeY = this.getRealParameter({'oParameters': _xContainer, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_iZIndex = this.getRealParameter({'oParameters': _xContainer, 'sName': 'iZIndex', 'xParameter': _iZIndex});
		_iOverlayAlpha = this.getRealParameter({'oParameters': _xContainer, 'sName': 'iOverlayAlpha', 'xParameter': _iOverlayAlpha});
		_iOverlayAlphaSpeedTimeout = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'iOverlayAlphaSpeedTimeout', 'xParameter': _iOverlayAlphaSpeedTimeout});
		_bHideOnBackgroundClick = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'bHideOnBackgroundClick', 'xParameter': _bHideOnBackgroundClick});
		_sCssStyle = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sCssStyle', 'xParameter': _sCssStyle});
		_sCssClass = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		_xContainer = this.getRealParameter({'oParameters': _xContainer, 'sName': 'xContainer', 'xParameter': _xContainer, 'bNotNull': true});
		
		var _sHTML = this.build(
			{
				'sPopupID': _sPopupID, 'sContent': _sContent, 
				'iSizeX': _iSizeX, 'iSizeY': _iSizeY, 
				'iZIndex': _iZIndex, 'iOverlayAlpha': _iOverlayAlpha, 'iOverlayAlphaSpeedTimeout': _iOverlayAlphaSpeedTimeout,
				'bHideOnBackgroundClick': _bHideOnBackgroundClick,
				'sCssStyle': _sCssStyle, 'sCssClass': _sCssClass
			}
		);
		_sHTML += '<input type="hidden" id="'+_sPopupID+'ContainerID" value="'+_sContainerID+'" />';
		
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
	[en]Builds an popup HTML element.[/en]
	[de]Erstellt ein Popup HTML-Element.[/de]
	
	@return sPopupHtml [type]string[/type]
	[en]Returns the popup as an HTML string.[/en]
	[de]Gibt das Popup als HTML String zurück.[/de]
	
	@param sPopupID [type]string[/type]
	[en]The ID of the popup.[/en]
	[de]Die ID des Popups.[/de]
	
	@param sContent [type]string[/type]
	[en]The content for the popup.[/en]
	[de]Der Inhalt für das Popup.[/de]
	
	@param iSizeX [type]int[/type]
	[en]The width of the popup.[/en]
	[de]Die Breite des Popups.[/de]
	
	@param iSizeY [type]int[/type]
	[en]The height of the popup.[/en]
	[de]Die Höhe des Popups.[/de]
	
	@param iZIndex [type]int[/type]
	[en]The level (Z-index) where the popup should be displayed.[/en]
	[de]Die Ebene (Z-Index) auf der das Popup dargestellt werden soll.[/de]
	
	@param iOverlayAlpha [type]int[/type]
	[en]The transparency of the background where the popup will be displayed. The background is darkened.[/en]
	[de]Die Transparenz für den Hintergrund worauf das Popup dargestellt werden soll. Der Hintergrund wird abgedunkelt.[/de]
	
	@param iOverlayAlphaSpeedTimeout [type]int[/type]
	[en]The speed of darkening the background. The higher the number (in milliseconds) the slower the effect.[/en]
	[de]Die Geschwindigkeit für das Abdunkeln des Hintergundes. Je größer die Zahl (in Millisekunden) um so langsamer der Effeckt.[/de]
	
	@param bHideOnBackgroundClick [type]bool[/type]
	[en]Specifies whether the popup should hide on clicking on the background.[/en]
	[de]Gibt an ob bei einem Klick auf den Hintergrund das Popup geschlossen werden soll.[/de]
	
	@param sCssStyle [type]string[/type]
	[en]CSS code for the popup element.[/en]
	[de]CSS Code für das Popup Element.[/de]
	
	@param sCssClass [type]string[/type]
	[en]CSS class for the popup element.[/en]
	[de]CSS Klasse für das Popup Element.[/de]
	*/
	this.build = function(
		_sPopupID,
		_sContent,
		_iSizeX,
		_iSizeY,
		_iZIndex,
		_iOverlayAlpha,
		_iOverlayAlphaSpeedTimeout,
		_bHideOnBackgroundClick,
		_sCssStyle,
		_sCssClass
	)
	{
		if (typeof(_sPopupID) == 'undefined') {var _sPopupID = null;}
		if (typeof(_sContent) == 'undefined') {var _sContent = null;}
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = null;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}
		if (typeof(_iZIndex) == 'undefined') {var _iZIndex = null;}
		if (typeof(_iOverlayAlpha) == 'undefined') {var _iOverlayAlpha = null;}
		if (typeof(_iOverlayAlphaSpeedTimeout) == 'undefined') {var _iOverlayAlphaSpeedTimeout = null;}
		if (typeof(_bHideOnBackgroundClick) == 'undefined') {var _bHideOnBackgroundClick = null;}
		if (typeof(_sCssStyle) == 'undefined') {var _sCssStyle = null;}
		if (typeof(_sCssClass) == 'undefined') {var _sCssClass = null;}

		_sContent = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'sContent', 'xParameter': _sContent});
		_iSizeX = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		_iSizeY = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_iZIndex = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'iZIndex', 'xParameter': _iZIndex});
		_iOverlayAlpha = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'iOverlayAlpha', 'xParameter': _iOverlayAlpha});
		_iOverlayAlphaSpeedTimeout = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'iOverlayAlphaSpeedTimeout', 'xParameter': _iOverlayAlphaSpeedTimeout});
		_bHideOnBackgroundClick = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'bHideOnBackgroundClick', 'xParameter': _bHideOnBackgroundClick});
		_sCssStyle = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'sCssStyle', 'xParameter': _sCssStyle});
		_sCssClass = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		_sPopupID = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'sPopupID', 'xParameter': _sPopupID});
		
		if (_sPopupID == null) {_sPopupID = this.getNextID();}
		if (_sContent == null) {_sContent = '';}
		if (_iSizeX == null) {_iSizeX = 300;}
		if (_iSizeY == null) {_iSizeY = 200;}
		if (_iZIndex == null) {_iZIndex = 1000;}
		if (_iOverlayAlpha == null) {_iOverlayAlpha = 50;}
		if (_iOverlayAlphaSpeedTimeout == null) {_iOverlayAlphaSpeedTimeout = 0;}
		if (_bHideOnBackgroundClick == null) {_bHideOnBackgroundClick = false;}
		if (_sCssStyle == null) {_sCssStyle = '';}
		if (_sCssClass == null) {_sCssClass = '';}

		var _sHTML = '';

		_sHTML += '<div id="'+_sPopupID+'Overlay" ';
		if (_bHideOnBackgroundClick == true) {_sHTML += 'onmouseup="oPGPopup.hide({\'sPopupID\': \''+_sPopupID+'\'});" ';}
		_sHTML += 'style="position:fixed; display:none; top:0px; left:0px; width:0px; height:0px; background-color:#000000; z-index:'+_iZIndex+';"></div>';
		_sHTML += '<div id="'+_sPopupID+'" style="';
		_sHTML += 'position:fixed; display:none; width:'+_iSizeX+'px; height:'+_iSizeY+'px; z-index:'+(_iZIndex+1)+'; ';
		if (_sCssStyle != '') {_sHTML += _sCssStyle;}
		else if (_sCssClass == '') {_sHTML += 'overflow:auto; background-color:#ffffff; ';}
		_sHTML += '" ';
		if (_sCssClass != '') {_sHTML += 'class="'+_sCssClass+'" ';}
		_sHTML += '>';
		_sHTML += _sContent;
		_sHTML += '</div>';
		// _sHTML += '<input type="hidden" id="'+_sPopupID+'ContainerID" value="" />';
		_sHTML += '<input type="hidden" id="'+_sPopupID+'OverlayAlpha" value="'+_iOverlayAlpha+'" />';
		_sHTML += '<input type="hidden" id="'+_sPopupID+'OverlayAlphaSpeedTimeout" value="'+_iOverlayAlphaSpeedTimeout+'" />';

		return _sHTML;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the content for a popup element.[/en]
	[de]Setzt den Inhalt für ein Popup Element.[/de]
	
	@param sPopupID [needed][type]string[/type]
	[en]The ID of the popup.[/en]
	[de]Die ID des Popups.[/de]
	
	@param sContent [needed][type]string[/type]
	[en]The content for the popup element.[/en]
	[de]Der Inhalt für das Popup Element.[/de]
	*/
	this.setContent = function(_sPopupID, _sContent)
	{
		if (typeof(_sContent) == 'undefined') {var _sContent = null;}

		_sContent = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'sContent', 'xParameter': _sContent});
		_sPopupID = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'sPopupID', 'xParameter': _sPopupID});

		var _oPopup = this.oDocument.getElementById(_sPopupID);
		if (_oPopup) {_oPopup.innerHTML = _sContent;}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the sizes of a popup element.[/en]
	[de]Setzt die Größen eines Popup Elements.[/de]
	
	@param sPopupID [needed][type]string[/type]
	[en]The ID of the popup.[/en]
	[de]Die ID des Popups.[/de]
	
	@param iSizeX [type]int[/type]
	[en]The width for the popup.[/en]
	[de]Die Breite für das Popup.[/de]
	
	@param iSizeY [type]int[/type]
	[en]The height for the popup.[/en]
	[de]Die Höhe für das Popup.[/de]
	*/
	this.setSize = function(_sPopupID, _iSizeX, _iSizeY)
	{
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = null;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}

		_iSizeX = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		_iSizeY = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_sPopupID = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'sPopupID', 'xParameter': _sPopupID});

		var _oPopup = this.oDocument.getElementById(_sPopupID);
		if (_oPopup)
		{
			if (_iSizeX != null) {_oPopup.style.width = _iSizeX+'px';}
			if (_iSizeY != null) {_oPopup.style.height = _iSizeY+'px';}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns whether a popup element is visible.[/en]
	[de]Gibt zurück, ob ein Popup Element sichtbar ist.[/de]
	
	@return bIsVisible [type]bool[/type]
	[en]Returns a boolean whether a popup element is visible.[/en]
	[de]Gibt ein Boolean zurück, ob ein Popup Element sichtbar ist.[/de]
	
	@param sPopupID [needed][type]string[/type]
	[en]The ID of the popup.[/en]
	[de]Die ID des Popups.[/de]
	*/
	this.isVisible = function(_sPopupID)
	{
		_sPopupID = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'sPopupID', 'xParameter': _sPopupID});
		var _oPopup = this.oDocument.getElementById(_sPopupID);
		if (_oPopup) {if (_oPopup.style.display == 'block') {return true;}}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Hides a popup element.[/en]
	[de]Blendet ein Popup Element aus.[/de]
	
	@param sPopupID [needed][type]string[/type]
	[en]The ID of the popup.[/en]
	[de]Die ID des Popups.[/de]
	
	@param iOverlayAlphaSpeedTimeout [type]int[/type]
	[en]The speed of brighten up the background. The higher the number (in milliseconds) the slower the effect.[/en]
	[de]Die Geschwindigkeit für das Aufhellen des Hintergundes. Je größer die Zahl (in Millisekunden) um so langsamer der Effeckt.[/de]
	*/
	this.hide = function(_sPopupID, _iOverlayAlphaSpeedTimeout)
	{
		if (typeof(_iOverlayAlphaSpeedTimeout) == 'undefined') {var _iOverlayAlphaSpeedTimeout = null;}

		_iOverlayAlphaSpeedTimeout = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'iOverlayAlphaSpeedTimeout', 'xParameter': _iOverlayAlphaSpeedTimeout});
		_sPopupID = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'sPopupID', 'xParameter': _sPopupID});

		if (typeof(_iOverlayAlphaSpeedTimeout) == 'undefined') {var _iOverlayAlphaSpeedTimeout = null;}
		if (_iOverlayAlphaSpeedTimeout < 1) {_iOverlayAlphaSpeedTimeout = null;}

		var _oPopup = this.oDocument.getElementById(_sPopupID);
		if (_oPopup) {_oPopup.style.display = 'none';}

		var _oOverlay = this.oDocument.getElementById(_sPopupID+'Overlay');
		if (_oOverlay)
		{
			if (_iOverlayAlphaSpeedTimeout == null)
			{
				var _oOverlayAlphaSpeedTimeout = this.oDocument.getElementById(_sPopupID+'OverlayAlphaSpeedTimeout');
				if (_oOverlayAlphaSpeedTimeout)
				{
					_iOverlayAlphaSpeedTimeout = parseInt(_oOverlayAlphaSpeedTimeout.value);
					if (_iOverlayAlphaSpeedTimeout <= 0) {_iOverlayAlphaSpeedTimeout = null;}
				}
			}
			
			if (_iOverlayAlphaSpeedTimeout == null)
			{
				if (typeof(oPGGfx) != 'undefined') {oPGGfx.setElementOpacity({'xElement': _oOverlay, 'iPercent': 1});}
				_iCurrentAlpha = 1;
			}
			else
			{
				if (typeof(oPGGfx) != 'undefined')
				{
					var _iCurrentAlpha = oPGGfx.getElementOpacity({'xElement': _oOverlay});
					if (!isNaN(_iCurrentAlpha))
					{
						if (_iCurrentAlpha <= 5) {_iCurrentAlpha = 1;}
						else {_iCurrentAlpha = Math.round(_iCurrentAlpha/2);}
						oPGGfx.setElementOpacity({'xElement': _oOverlay, 'iPercent': _iCurrentAlpha});
					}
				}
			}
			if (_iCurrentAlpha == 1) {_oOverlay.style.display = 'none';}
			else if (_iOverlayAlphaSpeedTimeout != null) {this.oWindow.setTimeout("oPGPopup.hide({'sPopupID': '"+_sPopupID+"', 'iOverlayAlphaSpeedTimeout': "+_iOverlayAlphaSpeedTimeout+"})", _iOverlayAlphaSpeedTimeout);}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Shows a popup element.[/en]
	[de]Blendet ein Popup Element ein.[/de]
	
	@param sPopupID [needed][type]string[/type]
	[en]The ID of the popup.[/en]
	[de]Die ID des Popups.[/de]
	
	@param iOverlayAlpha [type]int[/type]
	[en]The transparency of the background where the popup will be displayed. The background is darkened.[/en]
	[de]Die Transparenz für den Hintergrund worauf das Popup dargestellt werden soll. Der Hintergrund wird abgedunkelt.[/de]
	
	@param iOverlayAlphaSpeedTimeout [type]int[/type]
	[en]The speed of darkening the background. The higher the number (in milliseconds) the slower the effect.[/en]
	[de]Die Geschwindigkeit für das Abdunkeln des Hintergundes. Je größer die Zahl (in Millisekunden) um so langsamer der Effeckt.[/de]
	*/
	this.show = function(_sPopupID, _iOverlayAlpha, _iOverlayAlphaSpeedTimeout)
	{
		if (typeof(_iOverlayAlpha) == 'undefined') {var _iOverlayAlpha = null;}
		if (typeof(_iOverlayAlphaSpeedTimeout) == 'undefined') {var _iOverlayAlphaSpeedTimeout = null;}

		_iOverlayAlpha = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'iOverlayAlpha', 'xParameter': _iOverlayAlpha});
		_iOverlayAlphaSpeedTimeout = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'iOverlayAlphaSpeedTimeout', 'xParameter': _iOverlayAlphaSpeedTimeout});
		_sPopupID = this.getRealParameter({'oParameters': _sPopupID, 'sName': 'sPopupID', 'xParameter': _sPopupID});

		if (typeof(_iOverlayAlpha) == 'undefined') {var _iOverlayAlpha = null;}
		if (typeof(_iOverlayAlphaSpeedTimeout) == 'undefined') {var _iOverlayAlphaSpeedTimeout = null;}
		if (_iOverlayAlphaSpeedTimeout < 1) {_iOverlayAlphaSpeedTimeout = null;}
			
		var _oContainer = null;
		var _oContainerID = this.oDocument.getElementById(_sPopupID+'ContainerID');
		// if (_oContainerID)
		// {
			if (_iOverlayAlpha == null)
			{
				_iOverlayAlpha = 1;
				var _oOverlayAlpha = this.oDocument.getElementById(_sPopupID+'OverlayAlpha');
				if (_oOverlayAlpha) {_iOverlayAlpha = parseInt(_oOverlayAlpha.value);}
			}
			
			if (_iOverlayAlphaSpeedTimeout == null)
			{
				var _oOverlayAlphaSpeedTimeout = this.oDocument.getElementById(_sPopupID+'OverlayAlphaSpeedTimeout');
				if (_oOverlayAlphaSpeedTimeout)
				{
					_iOverlayAlphaSpeedTimeout = parseInt(_oOverlayAlphaSpeedTimeout.value);
					if (_iOverlayAlphaSpeedTimeout <= 0) {_iOverlayAlphaSpeedTimeout = null;}
				}
			}
			
			var _oOverlay = this.oDocument.getElementById(_sPopupID+'Overlay');
			var _iCurrentOverlayAlpha = 0;
			if (_iOverlayAlphaSpeedTimeout != null)
			{
				if ((_iOverlayAlpha > 5) || (_iOverlayAlpha < -5)) {_iCurrentOverlayAlpha = Math.round(_iOverlayAlpha/2);}
				else {_iCurrentOverlayAlpha = _iOverlayAlpha;}
				_iOverlayAlpha -= _iCurrentOverlayAlpha;
				
				if ((_oOverlay) && (typeof(oPGGfx) != 'undefined'))
				{
					var _iAlphaToAdd = oPGGfx.getElementOpacity({'xElement': _oOverlay});
					if (!isNaN(_iAlphaToAdd)) {_iCurrentOverlayAlpha += _iAlphaToAdd;}
				}
			}
			else {_iCurrentOverlayAlpha = _iOverlayAlpha;}
			
			var _iPosX = 0;
			var _iPosY = 0;
			var _iContainerSizeX = 0;
			var _iContainerSizeY = 0;
			var _sContainerID = '';
			if (_oContainerID) {_sContainerID = _oContainerID.value;}
			if (_sContainerID != '')
			{
				_oContainer = this.oDocument.getElementById(_sContainerID);
				if (_oContainer)
				{
					_iContainerSizeX = parseInt(_oContainer.offsetWidth);
					_iContainerSizeY = parseInt(_oContainer.offsetHeight);
				}
			}
			else
			{
				// var _oScreenSize = oPGBrowser.getScreenSize();
				_oContainer = this.oDocument.body;
				if (_oContainer)
				{
					_iContainerSizeX = oPGBrowser.getScreenSizeX(); // _oScreenSize.x;
					_iContainerSizeY = oPGBrowser.getScreenSizeY(); // _oScreenSize.y;
				}
			}

			if (_oOverlay)
			{
				if (typeof(oPGGfx) != 'undefined') {oPGGfx.setElementOpacity({'xElement': _oOverlay, 'iPercent': _iCurrentOverlayAlpha});}
				_oOverlay.style.display = 'block';
				if (_oContainer)
				{
					if (_sContainerID != '')
					{
						_oOverlay.style.width = _iContainerSizeX+'px';
						_oOverlay.style.height = _iContainerSizeY+'px';
					}
					else
					{
						_oOverlay.style.width = '100%';
						_oOverlay.style.height = '100%';
					}
				}
			}
			
			if ((_iOverlayAlphaSpeedTimeout == null) || (_iOverlayAlpha == 0))
			{
				var _oPopup = this.oDocument.getElementById(_sPopupID);
				if (_oPopup)
				{
					_oPopup.style.display = 'block';
					if (_oContainer)
					{
						_iPosX = Math.round((_iContainerSizeX-parseInt(_oPopup.offsetWidth))/2);
						if (!isNaN(_iPosX)) {_oPopup.style.left = _iPosX+'px';}
	
						_iPosY = Math.round((_iContainerSizeY-parseInt(_oPopup.offsetHeight))/2);
						if (!isNaN(_iPosY)) {_oPopup.style.top = _iPosY+'px';}
					}
				}
			}
			
			if ((_iOverlayAlphaSpeedTimeout != null) && (_iOverlayAlpha != 0))
			{
				this.oWindow.setTimeout("oPGPopup.show({'sPopupID': '"+_sPopupID+"', 'iOverlayAlpha': "+_iOverlayAlpha+", 'iOverlayAlphaSpeedTimeout': "+_iOverlayAlphaSpeedTimeout+"})", _iOverlayAlphaSpeedTimeout);
			}
		// }
	}
	/* @end method */
}
/* @end class */
classPG_Popup.prototype = new classPG_ClassBasics();
var oPGPopup = new classPG_Popup();
