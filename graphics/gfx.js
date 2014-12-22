/*
* ProGade API
* Copyright (c) 2014 Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 12 2014
*/

/*
@start class

@object oPGGfx

@description
[en]This class has methods to the create of images, convert color values and manage GFX packages.[/en]
[de]Diese Klasse verfügt über Methoden zum erstellen von Bildern, umrechnen von Farbwerten und verwalten von GFX Paketen.[/de]

@param extends classPG_ClassBasics
*/
function classPG_Gfx()
{
	// Declarations...
	this.sGfxBasePath = 'gfx/default/';
	this.sGfxPath = 'gfx/default/';
	this.sGfxSubPathImages = 'img/';
	this.sGfxSubPathCss = 'css/';

	// Construct...

	// Methods...
	/*
	@start method
	
	@group set
	
	@description
	[en]Sets the path to the GFX package.[/en]
	[de]Setzt den Pfad zum GFX Pack.[/de]
	
	@param sPath [needed][type]string[/type]
	[en]The path to the GFX package.[/en]
	[de]Der Pfad zum GFX Pack.[/de]
	*/
	this.setGfxPath = function(_sPath)
	{
		_sPath = this.getRealParameter({'oParameters': _sPath, 'sName': 'sPath', 'xParameter': _sPath});
		this.sGfxPath = _sPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the path to the GFX package.[/en]
	[de]Gibt den Pfad zum GFX Pack zurück.[/de]
	
	@return sGfxPath [type]string[/type]
	[en]Returns the path to the GFX package as a string.[/en]
	[de]Gibt den Pfad zum GFX Pack als String zurück.[/de]
	*/
	this.getGfxPath = function() {return this.sGfxPath;}
	/* @end method */
	
	/*
	@start method
	
	@group set
	
	@description
	[en]Sets the sub path or folder for the GFX package in which are the images to find.[/en]
	[de]Setzt den Unterpfad bzw. Verzeichnis für das GFX Pack in dem die Bilder zu finden sind.[/de]
	
	@param sPath [type]string[/type]
	[en]The relative path to the images.[/en]
	[de]Der relative Pfad zu den Bildern.[/de]
	*/
	this.setGfxSubPathImages = function(_sPath)
	{
		_sPath = this.getRealParameter({'oParameters': _sPath, 'sName': 'sPath', 'xParameter': _sPath});
		this.sGfxSubPathImages = _sPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the sub path or directory for the GFX Pack where the images are located.[/en]
	[de]Gibt den Unterpfad bzw. Verzeichnis für das GFX Pack zurück in dem die Bilder zu finden sind.[/de]
	
	@return sImagesPath [type]string[/type
	[en]Returns the sub path or directory for the GFX Pack where the images are located as a string.[/en]
	[de]Gibt den Unterpfad bzw. Verzeichnis für das GFX Pack als String zurück in dem die Bilder zu finden sind.[/de]
	*/
	this.getGfxSubPathImages = function() {return this.sGfxSubPathImages;}
	/* @end method */

	/*
	@start method
	
	@group set
	
	@description
	[en]Sets the transparency of an HTML element.[/en]
	[de]Setzt die Transparenz eines HTML-Elements.[/de]
	
	@param xElement [needed][type]mixed[/type]
	[en]The HTML element.[/en]
	[de]Das HTML-Element.[/de]
	
	@param iPercent [needed][type]int[/type]
	[en]The transparency in percent.[/en]
	[de]Die Transparenz in Prozent.[/de]
	*/
	this.setElementOpacity = function(_xElement, _iPercent)
	{
		if (typeof(_iPercent) == 'undefined') {var _iPercent = null;}

		_iPercent = this.getRealParameter({'oParameters': _xElement, 'sName': 'iPercent', 'xParameter': _iPercent});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		
		var _oElement = oPGBrowser.getElementObject(_xElement);
		if (_oElement)
		{
			if (typeof(_oElement.style.opacity) !== 'undefined') {_oElement.style.opacity = _iPercent/100;}
			else if (typeof(_oElement.style.MozOpacity) !== 'undefined') {_oElement.style.MozOpacity = _iPercent/100;}
			else if (typeof(_oElement.style.filter) !== 'undefined') {_oElement.style.filter = "Alpha(opacity=" + _iPercent + ")";}
			else if (typeof(_oElement.style.msFilter) !== 'undefined') {_oElement.style.msFilter = 'progid:DXImageTransform.Microsoft.Alpha(Opacity='+_iPercent+')';}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@group set
	
	@description
	[en]Sets the transparency of an HTML element.[/en]
	[de]Setzt die Transparenz eines HTML-Elements.[/de]
	
	@param xElement [needed][type]mixed[/type]
	[en]The HTML element.[/en]
	[de]Das HTML-Element.[/de]
	
	@param iPercent [needed][type]int[/type]
	[en]The transparency in percent.[/en]
	[de]Die Transparenz in Prozent.[/de]
	*/
	this.setElementAlpha = function(_xElement, _iPercent)
	{
		if (typeof(_iPercent) == 'undefined') {var _iPercent = null;}

		_iPercent = this.getRealParameter({'oParameters': _xElement, 'sName': 'iPercent', 'xParameter': _iPercent});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		
		this.setElementOpacity({'xElement': _xElement, 'iPercent': _iPercent});
	}
	/* @end method */
	
	/*
	@start method
	
	@group set
	
	@description
	[en]Sets the transparency of an HTML element.[/en]
	[de]Setzt die Transparenz eines HTML-Elements.[/de]
	
	@param xElement [needed][type]mixed[/type]
	[en]The HTML element.[/en]
	[de]Das HTML-Element.[/de]
	
	@param iPercent [needed][type]int[/type]
	[en]The transparency in percent.[/en]
	[de]Die Transparenz in Prozent.[/de]
	*/
	this.setElementTransparency = function(_xElement, _iPercent)
	{
		if (typeof(_iPercent) == 'undefined') {var _iPercent = null;}

		_iPercent = this.getRealParameter({'oParameters': _xElement, 'sName': 'iPercent', 'xParameter': _iPercent});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		
		this.setElementOpacity({'xElement': _xElement, 'iPercent': _iPercent});
	}
	/* @end method */
	
	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the transparency of an HTML element in percent.[/en]
	[de]Gibt die Transparenz von einem HTML-Element in Prozent zurück.[/de]
	
	@return iPercent [type]int[/type]
	[en]Returns the transparency as an integer in percent.[/en]
	[de]Gibt die Transparenz als Integer in Prozent zurück.[/de]
	
	@param xElement [needed][type]mixed[/type]
	[en]The HTML element.[/en]
	[de]Das HTML-Element.[/de]
	*/
	this.getElementOpacity = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		
		var _oElement = oPGBrowser.getElementObject(_xElement);
		if (_oElement)
		{
			if (typeof(_oElement.style.opacity) != 'undefined') {return parseFloat(_oElement.style.opacity)*100;}
			else if (typeof(_oElement.style.MozOpacity) != 'undefined') {return parseFloat(_oElement.style.MozOpacity)*100;}
			else if (typeof(_oElement.filters) != 'undefined')
			{
				if (typeof(_oElement.filters.alpha) != 'undefined')
				{
					if (typeof(_oElement.filters.alpha.opacity) != 'undefined')
					{
						return parseInt(_oElement.filters.alpha.opacity);
					}
				}
				else if (typeof(_oElement.filters['DXImageTransform.Microsoft.Alpha']) != 'undefined')
				{
					if (typeof(_oElement.filters['DXImageTransform.Microsoft.Alpha'].opacity) != 'undefined')
					{
						return parseInt(_oElement.filters['DXImageTransform.Microsoft.Alpha'].opacity);
					}
				}
			}
		}
		return 0;
	}
	/* @end method */
	this.getElementAlpha = this.getElementOpacity;
	this.getElementTransparency = this.getElementOpacity;

	/*
	@start method
	
	@group ToHex
	
	@description
	[en]Calculates the hex value to a RGB color value and returns it.[/en]
	[de]Berechnet den Hex Wert zu einem RGB Farbwert und gibt ihn zurück.[/de]
	
	@return sHexColor [type]string[/type]
	[en]Returns the hex value as a string.[/en]
	[de]Gibt den Hex Wert als String zurück.[/de]
	
	@param iRed [type]int[/type]
	[en]The red value as an integer from 0 up to 255.[/en]
	[de]Der Rot-Wert als Integer von 0 bis 255.[/de]
	
	@param iGreen [type]int[/type]
	[en]The green value as an integer from 0 up to 255.[/en]
	[de]Der Grün-Wert als Integer von 0 bis 255.[/de]
	
	@param iBlue [type]int[/type]
	[en]The blue value as an integer from 0 up to 255.[/en]
	[de]Der Blau-Wert als Integer von 0 bis 255.[/de]
	*/
	this.rgbToHex = function(_iRed, _iGreen, _iBlue)
	{
		if (typeof(_iGreen) == 'undefined') {var _iGreen = null;}
		if (typeof(_iBlue) == 'undefined') {var _iBlue = null;}
		_iGreen = this.getRealParameter({'oParameters': _iRed, 'sName': 'iGreen', 'xParameter': _iGreen});
		_iBlue = this.getRealParameter({'oParameters': _iRed, 'sName': 'iBlue', 'xParameter': _iBlue});
		_iRed = this.getRealParameter({'oParameters': _iRed, 'sName': 'iRed', 'xParameter': _iRed});
		return '#'+this.toHex({'iNumber': _iRed}) + this.toHex({'iNumber': _iGreen}) + this.toHex({'iNumber': _iBlue});
	}
	/* @end method */
	
	/*
	@start method
	
	@group ToHex
	
	@description
	[en]Calculates a hex value to a Number and returns it.[/en]
	[de]Berechnet einen Hex Wert zu einer Zahl und gibt es zurück.[/de]
	
	@return sHex [type]string[/type]
	[en]Returns the hex value as a string.[/en]
	[de]Gibt den Hex Wert als String zurück.[/de]
	
	@param iNumber [needed][type]int[/type]
	[en]The number to be converted.[/en]
	[de]Die Zahl die umgerechnet werden soll.[/de]
	*/
	this.toHex = function(_iNumber)
	{
		_iNumber = this.getRealParameter({'oParameters': _iNumber, 'sName': 'iNumber', 'xParameter': _iNumber});
		return this.numToHex({'iNumber': _iNumber});
	}
	/* @end method */

	/*
	@start method
	
	@group ToHex
	
	@description
	[en]Calculates a hex value to a Number and returns it.[/en]
	[de]Berechnet einen Hex Wert zu einer Zahl und gibt es zurück.[/de]
	
	@return sHex [type]string[/type]
	[en]Returns the hex value as a string.[/en]
	[de]Gibt den Hex Wert als String zurück.[/de]
	
	@param iNumber [needed][type]int[/type]
	[en]The number to be converted.[/en]
	[de]Die Zahl die umgerechnet werden soll.[/de]
	*/
	this.numToHex = function(_iNumber)
	{
		_iNumber = this.getRealParameter({'oParameters': _iNumber, 'sName': 'iNumber', 'xParameter': _iNumber});

		if (_iNumber == null) {return "00";}
		_iNumber = parseInt(_iNumber);
		if ((_iNumber == 0) || (isNaN(_iNumber))) {return "00";}
		_iNumber = Math.max(0, _iNumber);
		_iNumber = Math.min(_iNumber, 255);
		_iNumber = Math.round(_iNumber);
		return "0123456789ABCDEF".charAt((_iNumber-_iNumber%16)/16) + "0123456789ABCDEF".charAt(_iNumber%16);
	}
	/* @end method */

	/*
	@start method
	
	@group ToHex
	
	@description
	[en]Calculates the red value of an hex color value and returns it.[/en]
	[de]Berechnet den Rot-Wert eines Hex-Farbwertes und gibt ihn zurück.[/de]
	
	@return iRed [type]int[/type]
	[en]Returns the red value as an integer from 0 to 255.[/en]
	[de]Gibt den Rot-Wert als Integer von 0 bis 255 zurück.[/de]
	
	@param sHexColor [needed][type]string[/type]
	[en]The hex volor value.[/en]
	[de]Der Hex-Farbwert.[/de]
	*/
	this.hexToRed = function(_sHexColor)
	{
		_sHexColor = this.getRealParameter({'oParameters': _sHexColor, 'sName': 'sHexColor', 'xParameter': _sHexColor});
		return parseInt((this.cutHexSharp(_sHexColor)).substring(0,2),16);
	}
	/* @end method */

	/*
	@start method
	
	@group HexTo
	
	@description
	[en]Calculates the green value of an hex color value and returns it.[/en]
	[de]Berechnet den Grün-Wert eines Hex-Farbwertes und gibt ihn zurück.[/de]
	
	@return iGreen [type]int[/type]
	[en]Returns the green value as an integer from 0 to 255.[/en]
	[de]Gibt den Grün-Wert als Integer von 0 bis 255 zurück.[/de]
	
	@param sHexColor [needed][type]string[/type]
	[en]The hex volor value.[/en]
	[de]Der Hex-Farbwert.[/de]
	*/
	this.hexToGreen = function(_sHexColor)
	{
		_sHexColor = this.getRealParameter({'oParameters': _sHexColor, 'sName': 'sHexColor', 'xParameter': _sHexColor});
		return parseInt((this.cutHexSharp(_sHexColor)).substring(2,4),16);
	}
	/* @end method */

	/*
	@start method
	
	@group HexTo
	
	@description
	[en]Calculates the blue value of an hex color value and returns it.[/en]
	[de]Berechnet den Blau-Wert eines Hex-Farbwertes und gibt ihn zurück.[/de]
	
	@return iBlue [type]int[/type]
	[en]Returns the blue value as an integer from 0 to 255.[/en]
	[de]Gibt den Blau-Wert als Integer von 0 bis 255 zurück.[/de]
	
	@param sHexColor [needed][type]string[/type]
	[en]The hex volor value.[/en]
	[de]Der Hex-Farbwert.[/de]
	*/
	this.hexToBlue = function(_sHexColor)
	{
		_sHexColor = this.getRealParameter({'oParameters': _sHexColor, 'sName': 'sHexColor', 'xParameter': _sHexColor});
		return parseInt((this.cutHexSharp(_sHexColor)).substring(4,6),16);
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Removes the sharp from a hex color value.[/en]
	[de]Entfernt die Raute von einem Hex-Farbwert.[/de]
	
	@return sColor [type]string[/type]
	[en]Returns the hex color value as a string.[/en]
	[de]Gibt den Hex-Farbwert als String zurück.[/de]
	
	@param sHexColor [needed][type]string[/type]
	[en]The color hex value, whose sharp should be removed.[/en]
	[de]Der Hex-Farbwert, dessen Raute entfernt werden soll.[/de]
	*/
	this.cutHexSharp = function(_sHexColor)
	{
		_sHexColor = this.getRealParameter({'oParameters': _sHexColor, 'sName': 'sHexColor', 'xParameter': _sHexColor});
		return (_sHexColor.charAt(0) == "#") ? _sHexColor.substring(1,7):_sHexColor;
	}
	/* @end method */
	
	// Css methods...
	/*
	@start method
	
	@group set
	
	@description
	[en]Sets the sub path or folder for the GFX package in which are the css files to find.[/en]
	[de]Setzt den Unterpfad bzw. Verzeichnis für das GFX Pack in dem die CSS-Dateien zu finden sind.[/de]
	
	@param sPath [needed][type]string[/type]
	[en]The relative path to the css files.[/en]
	[de]Der relative Pfad zu den CSS-Dateien.[/de]
	*/
	this.setCssGfxSubPath = function(_sPath)
	{
		_sPath = this.getRealParameter({'oParameters': _sPath, 'sName': 'sPath', 'xParameter': _sPath});
		this.setGfxSubPathCss({'sPath': _sPath});
	}
	/* @end method */
	
	/*
	@start method
	
	@group set
	
	@description
	[en]Sets the sub path or folder for the GFX package in which are the css files to find.[/en]
	[de]Setzt den Unterpfad bzw. Verzeichnis für das GFX Pack in dem die CSS-Dateien zu finden sind.[/de]
	
	@param sPath [needed][type]string[/type]
	[en]The relative path to the css files.[/en]
	[de]Der relative Pfad zu den CSS-Dateien.[/de]
	*/
	this.setGfxSubPathCss = function(_sPath)
	{
		_sPath = this.getRealParameter({'oParameters': _sPath, 'sName': 'sPath', 'xParameter': _sPath});
		this.sGfxSubPathCss = _sPath;
	}
	/* @end method */
	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the sub path or directory for the GFX Pack where the css files are located.[/en]
	[de]Gibt den Unterpfad bzw. Verzeichnis für das GFX Pack zurück in dem die CSS-Dateien zu finden sind.[/de]
	
	@return sImagesPath [type]string[/type
	[en]Returns the sub path or directory for the GFX Pack where the css files are located as a string.[/en]
	[de]Gibt den Unterpfad bzw. Verzeichnis für das GFX Pack als String zurück in dem die CSS-Dateien zu finden sind.[/de]
	*/
	this.getCssGfxSubPath = function() {return this.getGfxSubPathCss();}
	/* @end method */

	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the sub path or directory for the GFX Pack where the css files are located.[/en]
	[de]Gibt den Unterpfad bzw. Verzeichnis für das GFX Pack zurück in dem die CSS-Dateien zu finden sind.[/de]
	
	@return sImagesPath [type]string[/type
	[en]Returns the sub path or directory for the GFX Pack where the css files are located as a string.[/en]
	[de]Gibt den Unterpfad bzw. Verzeichnis für das GFX Pack als String zurück in dem die CSS-Dateien zu finden sind.[/de]
	*/
	this.getGfxSubPathCss = function() {return this.sGfxSubPathCss;}
	/* @end method */
	
	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the CSS link tag of a css file as HTML string.[/en]
	[de]Gibt den CSS-Link-Tag zu einer CSS Datei als HTML-String zurück.[/de]
	
	@return sCssTag [type]string[/type]
	[en]Returns the CSS link tag of a css file as HTML string.[/en]
	[de]Gibt den CSS-Link-Tag zu einer CSS Datei als HTML-String zurück.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The CSS file that should be linked.[/en]
	[de]Die CSS Datei, die verlinkt werden soll.[/de]
	*/
	this.getCss = function(_sFile)
	{
		_sFile = this.getRealParameter({'oParameters': _sFile, 'sName': 'sFile', 'xParameter': _sFile});
		return this.getCssLink({'sFile': _sFile});
	}
	/* @end method */
	
	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the CSS link tag of a css file as HTML string.[/en]
	[de]Gibt den CSS-Link-Tag zu einer CSS Datei als HTML-String zurück.[/de]
	
	@return sCssTag [type]string[/type]
	[en]Returns the CSS link tag of a css file as HTML string.[/en]
	[de]Gibt den CSS-Link-Tag zu einer CSS Datei als HTML-String zurück.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The CSS file that should be linked.[/en]
	[de]Die CSS Datei, die verlinkt werden soll.[/de]
	*/
	this.getCssLink = function(_sFile)
	{
		_sFile = this.getRealParameter({'oParameters': _sFile, 'sName': 'sFile', 'xParameter': _sFile});
		var _sCompletePath = this.sGfxPath+this.sGfxSubPathCss+_sFile;
		// if (!file_exists($_sCompletePath)) {$_sCompletePath = $this->sGfxBasePath.$this->sGfxSubPathCss.$_sFile;}
		return '<link rel="stylesheet" type="text/css" href="'+_sCompletePath+'" />';
	}
	/* @end method */
	
	// Image methods...	
	/*
	@start method
	
	@description
	[en]Creates an HTML string to display an image and returns it.[/en]
	[de]Erstellt einen HTML-String um ein Bild anzuzeigen und gibt ihn zurück.[/de]
	
	@return sImageHtml [type]string[/type]
	[en]Returns the image as an HTML string.[/en]
	[de]Gibt das Bild als HTML-String zurück.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The Image to display.[/en]
	[de]Das Bild, das angezeigt werden soll.[/de]
	
	@param sSizeX [type]string[/type]
	[en]The width of the image to display.[/en]
	[de]Die Breite in der das Bild angezeigt werden soll.[/de]
	
	@param sSizeY [type]string[/type]
	[en]The height of the image to display.[/en]
	[de]Die Höhe in der das Bild angezeigt werden soll.[/de]
	
	@param sTitle [type]string[/type]
	[en]The title of the image.[/en]
	[de]Der Titel des Bildes.[/de]
	
	@param sAddTag [type]string[/type]
	[en]A string that allows to add additional HTML properties.[/en]
	[de]Ein String, der es ermöglicht weitere HTML-Properties hinzuzufügen.[/de]
	
	@param sCssStyle [type]string[/type]
	[en]CSS code for the image.[/en]
	[de]CSS Code für das Bild.[/de]
	
	@param sCssClass [type]string[/type]
	[en]CSS class for the image.[/en]
	[de]CSS Klasse für das Bild.[/de]
	*/
	this.img = function(_sImage, _sSizeX, _sSizeY, _sTitle, _sAddTag, _sCssStyle, _sCssClass)
	{
		if (typeof(_sSizeX) == 'undefined') {var _sSizeX = null;}
		if (typeof(_sSizeY) == 'undefined') {var _sSizeY = null;}
		if (typeof(_sTitle) == 'undefined') {var _sTitle = null;}
		if (typeof(_sAddTag) == 'undefined') {var _sAddTag = null;}
		if (typeof(_sCssStyle) == 'undefined') {var _sCssStyle = null;}
		if (typeof(_sCssClass) == 'undefined') {var _sCssClass = null;}

		_sSizeX = this.getRealParameter({'oParameters': _sImage, 'sName': 'sSizeX', 'xParameter': _sSizeX});
		_sSizeY = this.getRealParameter({'oParameters': _sImage, 'sName': 'sSizeY', 'xParameter': _sSizeY});
		_sTitle = this.getRealParameter({'oParameters': _sImage, 'sName': 'sTitle', 'xParameter': _sTitle});
		_sAddTag = this.getRealParameter({'oParameters': _sImage, 'sName': 'sAddTag', 'xParameter': _sAddTag});
		_sCssStyle = this.getRealParameter({'oParameters': _sImage, 'sName': 'sCssStyle', 'xParameter': _sCssStyle});
		_sCssClass = this.getRealParameter({'oParameters': _sImage, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		_sImage = this.getRealParameter({'oParameters': _sImage, 'sName': 'sImage', 'xParameter': _sImage});
		
		var _sHTML = '';
		var _sImagePathComplete = this.sGfxPath+this.sGfxSubPathImages+_sImage;
		var _sProtocol = window.location.protocol;
		_sImagePathComplete = _sImagePathComplete.replace(/http(s){0,1}:\/\/(.*)/gi, _sProtocol+'//$2');

		/*
		if ($_sSizeX == '')
		{
			$_iSizeY = str_replace("px", "", $_sSizeY);
			if ((strpos($_iSizeY, "%") === false) && ($_iSizeY != '')) {$_sSizeX = round($_aiSize[0]/$_aiSize[1]*(int)$_iSizeY, 0).'px';}
			else {$_sSizeX = $_aiSize[0];}
		}
		if ($_sSizeY == '')
		{
			$_iSizeX = str_replace("px", "", $_sSizeX);
			if ((strpos($_iSizeX, "%") === false) && ($_iSizeX != '')) {$_sSizeY = round($_aiSize[1]/$_aiSize[0]*(int)$_iSizeX, 0).'px';}
			else {$_sSizeY = $_aiSize[1];}
		}
		*/
	
		// if ((strpos(_sSizeX, 'px') == false) && (strpos(_sSizeX, '%') == false)) {_sSizeX += 'px';}
		// if ((strpos(_sSizeY, 'px') == false) && (strpos(_sSizeY, '%') == false)) {_sSizeY += 'px';}
		
		if (((_sCssClass == '') || (_sCssClass == null)) && ((_sCssStyle == '') || (_sCssStyle == null))) {_sCssStyle = 'border-width:0px; ';}
		// if (($_asPathInfo['extension'] == 'png') && // TODO
		if ((oPGBrowser.getBrowserName() == PG_BROWSER_INTERNET_EXPLORER)
		&& (Math.floor(oPGBrowser.getBrowserVersion()) < 7))
		{
			_sHTML += '<div style="';
			_sHTML += 'filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\''+_sImagePathComplete+'\', sizingMethod=\'image\'); ';
			if ((_sSizeX != '') && (_sSizeX != null)) {_sHTML += 'width:'+_sSizeX+'; ';}
			if ((_sSizeY != '') && (_sSizeY != null)) {_sHTML += 'height:'+_sSizeY+'; ';}
			if ((_sCssStyle != '') && (_sCssStyle != null)) {_sHTML += _sCssStyle+'" ';}
			_sHTML += '" ';
			if ((_sCssClass != '') && (_sCssClass != null)) {_sHTML += 'class="'+_sCssClass+'" ';}
			if ((_sAddTag != '') && (_sAddTag != null)) {_sHTML += _sAddTag+' ';}
			if ((_sTitle != '') && (_sTitle != null)) {_sHTML += 'title="'+_sTitle+'" ';}
			_sHTML += 'unselectable="on"></div>';
		}
		else
		{
			_sHTML += '<img src="'+_sImagePathComplete+'" style="';
			if ((_sSizeX != '') && (_sSizeX != null)) {_sHTML += 'width:'+_sSizeX+'; ';}
			if ((_sSizeY != '') && (_sSizeY != null)) {_sHTML += 'height:'+_sSizeY+'; ';}
			if ((_sCssStyle != '') && (_sCssStyle != null)) {_sHTML += _sCssStyle+'" ';}
			_sHTML += '" ';
			if ((_sCssClass != '') && (_sCssClass != null)) {_sHTML += 'class="'+_sCssClass+' ';}
			if ((_sAddTag != '') && (_sAddTag != null)) {_sHTML += _sAddTag+' ';}
			if ((_sTitle != '') && (_sTitle != null)) {_sHTML += 'title="'+_sTitle+'" alt="'+_sTitle+'" ';}
			_sHTML += 'unselectable="on" />';
		}
		return _sHTML;
	}
	/* @end method */
	this.loadImage = this.img;
	this.image = this.img;
}
/* @end class */
classPG_Gfx.prototype = new classPG_ClassBasics();
var oPGGfx = new classPG_Gfx();
