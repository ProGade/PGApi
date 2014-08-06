/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Oct 10 2012
*/
var PG_DEBUG_LOW = 1;
var PG_DEBUG_MEDIUM = 2;
var PG_DEBUG_HIGH = 4;

/*
@start class

@description
[en]
	This class is a base class inherit from most other classes.
	It contains methods such as Networked communications and graphics capabilities, etc.
[/en]
[de]
	Diese Klasse ist eine Basisklasse von der die meisten anderen Klassen erben.
	Sie enthält Methoden wie z.B. Netwerk-Kommunikation und Grafikfunktionen usw.
[/de]

@param extends classPG_ClassBasics
*/
function classPG_ClassBasics()
{
	// Declarations...
	this.oWindow = window;
	this.oDocument = document;
	
	this.sID = 'PG';
	this.iIDNext = 0;
	this.iDebugMode = 0;
	this.sDebugString = '';
	this.sLineBreak = "\n";
	this.sUrl = 'index.php';
	this.sUrlTarget = '_self';

	this.oText = {};
	this.oUrlParameters = {};
	
	this.oGfx = null;
	this.sGfxSubPath = '';
	
	this.oNetwork = null;
	this.fNetworkOnResponse = null;
	this.sNetworkParameters = '';
	this.sNetworkResponseFile = 'server.php';
	
	// Construct...
	
	// Methods...
	/*
	@start method
	
	@group Other
	
	@description
	[en]Initializes the GFX package system and network functions.[/en]
	[de]Initialisiert das GFX-Pack-System und die Netzwerkfunktionen.[/de]
	*/
	this.initClassBasics = function()
	{
		if (typeof(oPGGfx) != 'undefined') {this.oGfx = oPGGfx;}
		if (typeof(oPGNetwork) != 'undefined') {this.oNetwork = oPGNetwork;}
	}
	/* @end method */
		
	/*
	@start method
	
	@group Other
	
	@description
	[en]Returns a container object.[/en]
	[de]Gibt ein Kontainer-Objekt zurück.[/de]
	
	@return oContainer [type]object[/type]
	[en]Returns a container object.[/en]
	[de]Gibt ein Kontainer-Objekt zurück.[/de]
	
	@param xContainer [needed][type]mixed[/type]
	[en]The container as string or object.[/en]
	[de]Der Container als String oder Objekt.[/de]
	
	@param bBodyAsAlternative [type]bool[/type]
	[en]Specifies whether the body tag can alternatively be used as the container.[/en]
	[de]Gibt an ob alternativ der Body Tag als container verwendet werden darf.[/de]
	*/
	this.getContainerObject = function(_xContainer, _bBodyAsAlternative)
	{
		if (typeof(_bBodyAsAlternative) == 'undefined') {var _bBodyAsAlternative = null;}

		_bBodyAsAlternative = this.getRealParameter({'oParameters': _xContainer, 'sName': 'bBodyAsAlternative', 'xParameter': _bBodyAsAlternative});
		_xContainer = this.getRealParameter({'oParameters': _xContainer, 'sName': 'xContainer', 'xParameter': _xContainer, 'bNotNull': true});

		if (_bBodyAsAlternative == null) {_bBodyAsAlternative = true;}

		if (typeof(_xContainer) == 'string') {return this.oDocument.getElementById(_xContainer);}
		if ((_bBodyAsAlternative == true) && (!_xContainer)) {_xContainer = this.oDocument.body;}

		return _xContainer;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Parameters
	
	@description
	[en]Find out how parameters are passed to a method and returns the appropriate value of the parameter.[/en]
	[de]Findet heraus auf welche Weise Parameter an eine Methode übergeben wurden und gibt den passenden Wert des Parameters zurück.[/de]
	
	@return xValue [type]mixed[/type]
	[en]Returns the appropriate value for the desired parameter.[/en]
	[de]Gibt den passenden Wert zum gesuchten Parameter zurück.[/de]
	
	@param sName [needed][type]string[/type]
	[en]The name of the desired parameter.[/en]
	[de]Der Name des gesuchten Parameters.[/de]
	
	@param xParameter [needed][type]mixed[/type]
	[en]The parameters should actually be passed.[/en]
	[de]Der Parameter der eigentlich übergeben werden sollte.[/de]
	
	@param oParameters [needed][type]object[/type]
	[en]The first parameter of a method. It is either an array, which contains all the parameters or it is only the first parameter.[/en]
	[de]Der erste Parameter einer Methode. Er entspricht entweder einem Array, welcher alle Parameter beinhaltet oder ist nur der erste Parameter.[/de]
	
	@param bNotNull [type]bool[/type]
	[en]If the first parameter was supposed to be an array and is not optional, then must bNotNull be set to true.[/en]
	[de]Falls der erste Parameter ursprünglich ein array sein sollte und nicht optional ist, dann muss bNotNull auf true gesetzt werden.[/de]
	*/
	this.getRealParameter = function(_sName, _xParameter, _oParameters, _bNotNull)
	{
		if (typeof(_sName) == 'undefined') {return null;}
		if (typeof(_xParameter) == 'undefined') {var _xParameter = null;}
		if (typeof(_oParameters) == 'undefined') {var _oParameters = null;}
		if (typeof(_bNotNull) == 'undefined') {var _bNotNull = null;}
		if ((typeof(_sName) == 'object') && (_sName != null))
		{
			if ((_xParameter == null) && (typeof(_sName['xParameter']) != 'undefined')) {_xParameter = _sName['xParameter'];}
			if ((_oParameters == null) && (typeof(_sName['oParameters']) != 'undefined')) {_oParameters = _sName['oParameters'];}
			if ((_bNotNull == null) && (typeof(_sName['bNotNull']) != 'undefined')) {_bNotNull = _sName['bNotNull'];}
			if (typeof(_sName['sName']) != 'undefined') {_sName = _sName['sName'];} else {_sName = null;}
		}
		
		if (_bNotNull == null) {_bNotNull = false;}
	
		if ((typeof(_oParameters) == 'object') && (_oParameters != null))
		{
			if (_oParameters == _xParameter)
			{
				if (typeof(_oParameters[_sName]) != 'undefined') {return _oParameters[_sName];} else if (_bNotNull != true) {return null;}
			}
			else if ((_xParameter == null) && (typeof(_oParameters[_sName]) != 'undefined')) {return _oParameters[_sName];}
		}
		return _xParameter;
	}
	/* @end method */
	
	// ID...
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Sets the ID for an object.[/en]
	[de]Setzt die ID für ein Objekt.[/de]
	
	@param sID [needed][type]string[/type]
	[en]The ID as a string.[/en]
	[de]Die ID als String.[/de]
	*/
	this.setID = function(_sID)
	{
		_sID = this.getRealParameter({'oParameters': _sID, 'sName': 'sID', 'xParameter': _sID});
		this.sID = _sID;
	}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@description
	[en]Returns the ID of an object/a class.[/en]
	[de]Gibt die ID von einem Objekt/einer Klasse zurück.[/de]
	
	@return sID [type]string[/type]
	[en]Returns the ID of an object/a class as a string.[/en]
	[de]Gibt die ID von einem Objekt/einer Klasse als String zurück.[/de]
	*/
	this.getID = function() {return this.sID;}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Returns the next, generated ID of an object/a class.[/en]
	[de]Gibt die nächste, generierte ID von einem Objekt/einer Klasse zurück.[/de]
	
	@return sID [type]string[/type]
	[en]Returns the next, generated ID of an object/a class as a string.[/en]
	[de]Gibt die nächste, generierte ID von einem Objekt/einer Klasse als String zurück.[/de]
	*/
	this.getNextID = function() {var _sID = this.sID+this.iIDNext; this.iIDNext++; return _sID;}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@description
	[en]Returns the most recently generated ID of an object/a class.[/en]
	[de]Gibt die zuletzt generierte ID von einem Objekt/einer Klasse zurück.[/de]
	
	@return sID [type]string[/type]
	[en]Returns the most recently generated ID of an object/a class as a string.[/en]
	[de]Gibt die zuletzt generierte ID von einem Objekt/einer Klasse als String zurück.[/de]
	*/
	this.getLastID = function() {return this.sID+this.iIDNext;}
	/* @end method */
	
	// Text...
	/*
	@start method
	
	@group Text
	
	@description
	[en]Sets text for a class. Can be used for multilingual websites.[/en]
	[de]Setzt Text(e) für eine Klasse. Kann für Mehrsprachige Webseiten verwendet werden.[/de]
	
	@param xType [needed][type]mixed[/type]
	[en]The type of the text as string is equivalent to an ID for a text. An string array of texts can be passed also.[/en]
	[de]Der Typ des Textes als String. Entspricht einer ID für einen Text. Hier kann aber auch ein String-Array von Texten übergeben werden.[/de]
	
	@param sText [needed][type]string[/type]
	[en]The text to the type. Is not needed, if the type is a string array.[/en]
	[de]Der Text zum Typ. Wird nicht benötigt, wenn der Typ ein String-Array ist.[/de]
	*/
	this.setText = function(_xType, _sText)
	{
		if (typeof(_sText) == 'undefined') {var _sText = null;}

		_sText = this.getRealParameter({'oParameters': _xType, 'sName': 'sText', 'xParameter': _sText});
		_xType = this.getRealParameter({'oParameters': _xType, 'sName': 'xType', 'xParameter': _xType, 'bNotNull': true});

		if (typeof(_xType) == 'object') {this.oText = _xType;}
		else if (typeof(_xType) == 'string') {this.oText[_sType] = _sText;}
	}
	/* @end method */
	
	/*
	@start method
	
	@group Text
	
	@description
	[en]Adds text to a class. Can be used for multilingual websites.[/en]
	[de]Fügt einen Text einer Klasse hinzu. Kann für Mehrsprachige Webseiten verwendet werden.[/de]
	
	@param sType [needed][type]mixed[/type]
	[en]The type of the text as string is equivalent to an ID for a text.[/en]
	[de]Der Typ des Textes als String. Entspricht einer ID für einen Text.[/de]
	
	@param sText [needed][type]string[/type]
	[en]The text to the type.[/en]
	[de]Der Text zum Typ.[/de]
	*/
	this.addText = function(_sType, _sText)
	{
		if (typeof(_sText) == 'undefined') {var _sText = null;}

		_sText = this.getRealParameter({'oParameters': _sType, 'sName': 'sText', 'xParameter': _sText});
		_sType = this.getRealParameter({'oParameters': _sType, 'sName': 'xType', 'xParameter': _sType});

		this.setText({'xType': _sType, 'sText': _sText});
	}
	/* @end method */
	
	/*
	@start method
	
	@group Text
	
	@description
	[en]Returns the text of a class to the appropriate type[/en]
	[de]Gibt den Text einer Klasse zum entsprechenden Typ zurück.[/de]
	
	@param sType [needed][type]string[/type]
	[en]Returns the text of a class to the appropriate type as a string[/en]
	[de]Gibt den Text einer Klasse zum entsprechenden Typ als String zurück.[/de]
	*/
	this.getText = function(_sType)
    {
        _sType = this.getRealParameter({'oParameters': _sType, 'sName': 'sType', 'xParameter': _sType});
        return this.oText[_sType];
    }
	/* @end method */
	
	// Gfx...
	/*
	@start method
	
	@group GFX
	
	@description
	[en]Sets the GFX package for the object.[/en]
	[de]Setzt das GFX-Pack für das Objekt.[/de]
	
	@param oGfx [needed][type]object[/type]
	[en]The GFX package object which is to be used. When this parameter is omitted, the default GFX package object is used.[/en]
	[de]Das GFX-Pack-Objekt, welches verwendet werden soll. Bei weglassen dieses Parameters wird das default GFX-Pack-Objekt verwendet.[/de]
	*/
	this.setGfx = function(_oGfx)
	{
		_oGfx = this.getRealParameter({'oParameters': _oGfx, 'sName': 'oGfx', 'xParameter': _oGfx, 'bNotNull': true});
		this.oGfx = _oGfx;
	}
	/* @end method */

	/*
	@start method
	
	@group GFX
	
	@description
	[en]Returns the GFX package object.[/en]
	[de]Gibt das GFX-Pack-Objekt zurück.[/de]
	
	@return oGfx [type]object[/type]
	[en]Returns the GFX package object.[/en]
	[de]Gibt das GFX-Pack-Objekt als object zurück.[/de]
	*/
	this.getGfx = function() {return this.oGfx;}
	/* @end method */
	
	/*
	@start method
	
	@group GFX
	
	@description
	[en]Sets a subpath, to be used after the GFX path for the current object.[/en]
	[de]Setzt einen Unter-Pfad, der nach dem GFX Pfad für das aktuelle Objekt verwendet werden soll.[/de]
	
	@param sPath [needed][type]string[/type]
	[en]The subpath as a string to be used.[/en]
	[de]Der Unter-Pfad als String, der verwendet werden soll.[/de]
	*/
	this.setGfxSubPath = function(_sSubPath)
	{
		_sSubPath = this.getRealParameter({'oParameters': _sSubPath, 'sName': 'sSubPath', 'xParameter': _sSubPath});
		this.sGfxSubPath = _sSubPath;
	}
	/* @end method */

	/*
	@start method
	
	@group GFX
	
	@description
	[en]Returns the subpath.[/en]
	[de]Gibt den Unter-Pfad zurück.[/de]
	
	@return sSubPath [type]string[/type]
	[en]Returns the subpath as a string.[/en]
	[de]Gibt den Unter-Pfad als String zurück.[/de]
	*/
	this.getGfxSubPath = function() {return this.sGfxSubPath;}
	/* @end method */

	/*
	@start method
	
	@group GFX
	
	@description
	[en]
		Returns the full path of CSS with all subpaths and, where appropriate, the file name.
		sFile passing can be also an absolute URL and is checked out automatically.
	[/en]
	[de]
		Gibt den kompletten CSS-Pfad mit allen Unter-Pfaden und ggf. dem Dateinamen zurück.
		Die übergabe von sFile darf auch eine absolute URL sein und wird automatisch darauf geprüft.
	[/de]
	
	@return sPath [type]string[/type]
	[en]Returns the full path of CSS with all subpaths and, where appropriate, the file name.[/en]
	[de]Gibt den kompletten CSS-Pfad mit allen Unter-Pfaden und ggf. dem Dateinamen zurück.[/de]
	
	@param sFile [type]string[/type]
	[en]The file name or an absolute URL to the file as a string.[/en]
	[de]Der Dateiname oder eine absolute URL zur Datei als String.[/de]
	*/
	this.getGfxPathCss = function(_sFile)
	{
		_sFile = this.getRealParameter({'oParameters': _sFile, 'sName': 'sFile', 'xParameter': _sFile});

		var _sPath = '';
		if (this.oGfx)
		{
			if ((_sFile == null) || (_sFile.search(/(http:\/\/|https:\/\/|ftp:\/\/)/i) == -1))
			{
				_sPath += this.oGfx.getGfxPath()+this.oGfx.getGfxSubPathCss();
			}
		}
		_sPath += this.sGfxSubPath;
		if (_sFile != null) {_sPath += _sFile;}
		return _sPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@group GFX
	
	@description
	[en]
		Returns the full path of images with all subpaths and, where appropriate, the file name.
		sImage passing can be also an absolute URL and is checked out automatically.
	[/en]
	[de]
		Gibt den kompletten Bilder-Pfad mit allen Unter-Pfaden und ggf. dem Dateinamen zurück.
		Die übergabe von sImage darf auch eine absolute URL sein und wird automatisch darauf geprüft.
	[/de]
	
	@return sPath [type]string[/type]
	[en]Returns the full path of images with all subpaths and, where appropriate, the file name.[/en]
	[de]Gibt den kompletten Bilder-Pfad mit allen Unter-Pfaden und ggf. dem Dateinamen zurück.[/de]
	
	@param sImage [type]string[/type]
	[en]The file name or an absolute URL to the file as a string.[/en]
	[de]Der Dateiname oder eine absolute URL zur Datei als String.[/de]
	*/
	this.getGfxPathImages = function(_sImage)
	{
		_sImage = this.getRealParameter({'oParameters': _sImage, 'sName': 'sImage', 'xParameter': _sImage});
		
		var _sPath = '';
		if (this.oGfx)
		{
			if ((_sImage == null) || (_sImage.search(/(http:\/\/|https:\/\/|ftp:\/\/)/i) == -1))
			{
				_sPath += this.oGfx.getGfxPath()+this.oGfx.getGfxSubPathImages();
			}
		}
		_sPath += this.sGfxSubPath;
		if (_sImage != null) {_sPath += _sImage;}
		return _sPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@group GFX
	
	@description
	[en]Builds an image and returns it as a string.[/en]
	[de]Erstellt ein Image und gibt es als String zurück.[/de]
	
	@return sImageHtml [type]string[/type]
	[en]Returns the image as a string.[/en]
	[de]Gibt das Image als String zurück.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The image that should be used.[/en]
	[de]Das Bild, dass verwendet werden soll.[/de]
	
	@param sSizeX [type]string[/type]
	[en]The width to be used.[/en]
	[de]Die Breite die verwendet werden soll.[/de]
	
	@param sSizeY [type]string[/type]
	[en]The height to be used.[/en]
	[de]Die Höhe die verwendet werden soll.[/de]
	
	@param sTitle [type]string[/type]
	[en]The title of the image tags. Is displayed when the mouse pointer is over the image.[/en]
	[de]Der Title des Image-Tags. Wird angezeigt, wenn der Mauszeiger über dem Bild ist.[/de]
	
	@param sAddTag [type]string[/type]
	[en]Additional information for the image tag. HTML properties can be passed here for the IMG tag.[/en]
	[de]Zusätzliche angaben im Image-Tag. Hier können HTML-Properties für das IMG-Tag übergeben werden.[/de]
	
	@param sCssStyle [type]string[/type]
	[en]CSS style for the tag.[/en]
	[de]CSS-Style für das Tag.[/de]
	
	@param sCssClass [type]string[/type]
	[en]CSS class for the tag.[/en]
	[de]CSS-Clas für das Tag.[/de]
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

		if (this.oGfx)
		{
			return this.oGfx.img({'sImage': this.sGfxSubPath+_sImage, 'sSizeX': _sSizeX, 'sSizeY': _sSizeY, 'sTitle': _sTitle, 'sAddTag': _sAddTag, 'sCssStyle': _sCssStyle, 'sCssClass': _sCssClass});
		}
		var _sImg = '';
		_sImg += '<img src="'+this.sGfxSubPath+_sImage+'" ';
		if (_sTitle != null) {_sImg += 'title="'+_sTitle+'" ';}
		if (_sAddTag != null) {_sImg += _sAddTag+' ';}
		if (_sCssClass != null) {_sImg += 'class="'+_sCssClass+'" ';}
		if ((_sSizeX != null) || (_sSizeY != null) || (_sCssStyle != null))
		{
			_sImg += 'style="';
			if (_sSizeX != null) {_sImg += 'width:'+_sSizeX+'; ';}
			if (_sSizeY != null) {_sImg += 'width:'+_sSizeY+'; ';}
			if (_sCssStyle != null) {_sImg += _sCssStyle;}
			_sImg += '" ';
		}
		_sImg += ' />';
		return _sImg;
	}
	/* @end method */

	// Mode...
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Sets a mode of class, object, or a variable of type integer.[/en]
	[de]Setzt einen Modus der Klasse, des Objekts oder auf eine Variable vom Typ Integer.[/de]
	
	@return iMode [type]int[/type]
	[en]Returns the newly set mode.[/en]
	[de]Gibt den neu gesetzten Modus zurück.[/de]
	
	@param iMode [needed][type]int[/type]
	[en]The mode to be set.[/en]
	[de]Der Modus der gesetzt werden soll.[/de]
	
	@param iCurrentMode [type]int[/type]
	[en]The mode that is currently used. For example, a variable of type integer.[/en]
	[de]Der Modus der momentan verwendet wird. Zum Beispiel eine Variable vom Typ Integer.[/de]
	*/
	this.setMode = function(_iMode, _iCurrentMode)
	{
		if (typeof(_iCurrentMode) == 'undefined') {var _iCurrentMode = null;}

		_iCurrentMode = this.getRealParameter({'oParameters': _iMode, 'sName': 'iCurrentMode', 'xParameter': _iCurrentMode});
		_iMode = this.getRealParameter({'oParameters': _iMode, 'sName': 'iMode', 'xParameter': _iMode});

		if (_iCurrentMode != null) {_iCurrentMode |= (_iMode); return _iCurrentMode;}
		this.iMode |= (_iMode);
		return this.iMode;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Returns the mode of an object.[/en]
	[de]Gibt den Modus eines Objekts zurück.[/de]
	
	@return iMode [type]int[/type]
	[en]Returns the mode of an object as a integer.[/en]
	[de]Gibt den Modus eines Objekts als Integer zurück.[/de]
	*/
	this.getMode = function() {return this.iMode;}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Repeals the mode of a class, an object, or a variable.[/en]
	[de]Hebt den Modus einer Klasse, eines Objekts oder einer Variablen auf.[/de]
	
	@return iMode [type]int[/type]
	[en]Returns the newly set mode.[/en]
	[de]Gibt den neu gesetzten Modus zurück.[/de]
	
	@param iMode [needed][type]int[/type]
	[en]The mode which is to be repealed.[/en]
	[de]Der Modus der aufgehoben werden soll.[/de]
	
	@param iCurrentMode [type]int[/type]
	[en]The mode that is currently used. For example, a variable of type integer.[/en]
	[de]Der Modus der momentan verwendet wird. Zum Beispiel eine Variable vom Typ Integer.[/de]
	*/
	this.unsetMode = function(_iMode, _iCurrentMode)
	{
		if (typeof(_iCurrentMode) == 'undefined') {var _iCurrentMode = null;}

		_iCurrentMode = this.getRealParameter({'oParameters': _iMode, 'sName': 'iCurrentMode', 'xParameter': _iCurrentMode});
		_iMode = this.getRealParameter({'oParameters': _iMode, 'sName': 'iMode', 'xParameter': _iMode});

		if (_iCurrentMode != null) {_iCurrentMode &= ~(_iMode); return _iCurrentMode;}
		this.iMode &= ~(_iMode);
		return this.iMode;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Switches a mode turns on and off.[/en]
	[de]Schaltet einem Modus abwechselnd an und aus.[/de]
	
	@return iMode [type]int[/type]
	[en]Returns the newly set mode.[/en]
	[de]Gibt den neu gesetzten Modus zurück.[/de]
	
	@param iMode [needed][type]int[/type]
	[en]The mode which is to be switched.[/en]
	[de]Der Modus der umgeschaltet werden soll.[/de]
	
	@param iCurrentMode [type]int[/type]
	[en]The mode that is currently used. For example, a variable of type integer.[/en]
	[de]Der Modus der momentan verwendet wird. Zum Beispiel eine Variable vom Typ Integer.[/de]
	*/
	this.toggleMode = function(_iMode, _iCurrentMode)
	{
		if (typeof(_iCurrentMode) == 'undefined') {var _iCurrentMode = null;}

		_iCurrentMode = this.getRealParameter({'oParameters': _iMode, 'sName': 'iCurrentMode', 'xParameter': _iCurrentMode});
		_iMode = this.getRealParameter({'oParameters': _iMode, 'sName': 'iMode', 'xParameter': _iMode});

		if (_iCurrentMode != null) {_iCurrentMode ^= (_iMode); return _iCurrentMode;}
		this.iMode ^= (_iMode);
		return this.iMode;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Returns whether a mode is switched on.[/en]
	[de]Gibt zurück, ob ein Modus an geschaltet wurde.[/de]
	
	@return bIsMode [type]bool[/type]
	[en]Returns a boolean whether a mode is switched on (true) or off (false).[/en]
	[de]Gibt einen Boolean zurück, ob ein Modus an (true) oder aus (false) geschaltet wurde.[/de]
	
	@param iMode [needed][type]int[/type]
	[en]The mode to be tested.[/en]
	[de]Der Modus der geprüft werden soll.[/de]
	
	@param iCurrentMode [type]int[/type]
	[en]The mode that is currently used. For example, a variable of type integer.[/en]
	[de]Der Modus der momentan verwendet wird. Zum Beispiel eine Variable vom Typ Integer.[/de]
	*/
	this.isMode = function(_iMode, _iCurrentMode)
	{
		if (typeof(_iCurrentMode) == 'undefined') {var _iCurrentMode = null;}

		_iCurrentMode = this.getRealParameter({'oParameters': _iMode, 'sName': 'iCurrentMode', 'xParameter': _iCurrentMode});
		_iMode = this.getRealParameter({'oParameters': _iMode, 'sName': 'iMode', 'xParameter': _iMode});

		if (_iCurrentMode == null) {_iCurrentMode = this.iMode;}
		return (_iCurrentMode & (_iMode));
	}
	/* @end method */
	
	// Debug...
	/*
	@start method
	
	@group Debug
	
	@description
	[en]Sets the debug mode of an object.[/en]
	[de]Setzt den Debug-Modus des Objekts.[/de]
	
	@param iMode [needed][type]int[/type]
	[en]The mode to be set.[/en]
	[de]Der Modus der gesetzt werden soll.[/de]
	*/
	this.setDebugMode = function(_iMode)
	{
		_iMode = this.getRealParameter({'oParameters': _iMode, 'sName': 'iMode', 'xParameter': _iMode});
		this.iDebugMode |= (_iMode);
	}
	/* @end method */
	
	/*
	@start method
	
	@group Debug
	
	@description
	[en]Returns the debug mode of an object.[/en]
	[de]Gibt den Debug-Modus eines Objekts zurück.[/de]
	
	@return iMode [type]int[/type]
	[en]Returns the debug mode of an object as a integer.[/en]
	[de]Gibt den Debug-Modus eines Objekts als Integer zurück.[/de]
	*/
	this.getDebugMode = function() {return this.iDebugMode;}
	/* @end method */
	
	/*
	@start method
	
	@group Debug
	
	@description
	[en]Repeals the debug mode of an object.[/en]
	[de]Hebt den Debug-Modus eines Objekts auf.[/de]
	
	@param iMode [needed][type]int[/type]
	[en]The mode which is to be repealed.[/en]
	[de]Der Modus der aufgehoben werden soll.[/de]
	*/
	this.unsetDebugMode = function(_iMode)
	{
		_iMode = this.getRealParameter({'oParameters': _iMode, 'sName': 'iMode', 'xParameter': _iMode});
		this.iDebugMode &= ~(_iMode);
	}
	/* @end method */

	/*
	@start method
	
	@group Debug
	
	@description
	[en]Switches the debug mode turns on and off.[/en]
	[de]Schaltet den Debug-Modus abwechselnd an und aus.[/de]
	
	@param iMode [needed][type]int[/type]
	[en]The mode which is to be switched.[/en]
	[de]Der Modus der umgeschaltet werden soll.[/de]
	*/
	this.toggleDebugMode = function(_iMode)
	{
		_iMode = this.getRealParameter({'oParameters': _iMode, 'sName': 'iMode', 'xParameter': _iMode});
		this.iDebugMode ^= (_iMode);
	}
	/* @end method */
	
	/*
	@start method
	
	@group Debug
	
	@description
	[en]Returns whether a debug mode is switched on.[/en]
	[de]Gibt zurück, ob ein Debug-Modus an geschaltet wurde.[/de]
	
	@return bIsMode [type]bool[/type]
	[en]Returns a boolean whether a debug mode is switched on (true) or off (false).[/en]
	[de]Gibt einen Boolean zurück, ob ein Debug-Modus an (true) oder aus (false) geschaltet wurde.[/de]
	
	@param iMode [needed][type]int[/type]
	[en]The mode to be tested.[/en]
	[de]Der Modus der geprüft werden soll.[/de]
	*/
	this.isDebugMode = function(_iMode)
	{
		_iMode = this.getRealParameter({'oParameters': _iMode, 'sName': 'iMode', 'xParameter': _iMode});
		return (this.iDebugMode & (_iMode));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Debug
	
	@description
	[en]Sets the debug string.[/en]
	[de]Setzt den Debug-String.[/de]
	
	@param sString [needed][type]string[/type]
	[en]The text that should be set.[/en]
	[de]Der Text, der gesetzt werden soll.[/de]
	*/
	this.setDebugString = function(_sString)
	{
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		this.sDebugString = _sString;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Debug
	
	@description
	[en]Adds text to the debug string.[/en]
	[de]Fügt dem Debug-String Text hinzu.[/de]
	
	@param sString [needed][type]string[/type]
	[en]The text that should be added.[/en]
	[de]Der Text, der hinzugefügt werden soll.[/de]
	*/
	this.addDebugString = function(_sString)
	{
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		this.sDebugString += _sString+'<br />';
	}
	/* @end method */
	
	/*
	@start method
	
	@group Debug
	
	@description
	[en]Returns the debug string.[/en]
	[de]Gibt den Debug String zurück.[/de]
	
	@return sDebugString [type]string[/type]
	[en]Returns the debug string.[/en]
	[de]Gibt den Debug String zurück.[/de]
	*/
	this.getDebugString = function()
	{
		if ((this.iDebugMode > 0) && (this.sDebugString != ''))
		{
			var _sDebugString = this.sDebugString;
			this.sDebugString = '';
			return _sDebugString;
		}
		return '';
	}
	/* @end method */
	
	// Network...
	/*
	@start method
	
	@group Network
	
	@description
	[en]Initializes network functions for the object / the class.[/en]
	[de]Initialisiert Netzwerk Funktionen für das Objekt / die Klasse.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns a boolean whether the initialization was successfully.[/en]
	[de]Gibt einen Boolean, ob das Initialisieren erfolgreich war, zurück.[/de]
	
	@param oNetwork [type]object[/type]
	[en]The network object that should be used.[/en]
	[de]Das Netzwerk-Objekt, welches verwendet werden soll.[/de]
	*/
	this.initNetwork = function(_oNetwork)
	{
		if (typeof(_oNetwork) == 'undefined') {var _oNetwork = null;}

		_oNetwork = this.getRealParameter({'oParameters': _oNetwork, 'sName': 'oNetwork', 'xParameter': _oNetwork});

		if (_oNetwork != null) {this.oNetwork = _oNetwork; return true;}
		if (typeof(oPGNetwork) != 'undefined') {this.oNetwork = oPGNetwork; return true;}
		return false;
	}
	/* @end method */

	/*
	@start method
	
	@group Network
	
	@description
	[en]Sets the network object, which is to be used.[/en]
	[de]Setzt das Netzwerk-Objekt, welches verwendet werden soll.[/de]
	
	@param oNetwork [needed][type]object[/type]
	[en]The network object that should be used.[/en]
	[de]Das Netzwerk-Objekt, welches verwendet werden soll.[/de]
	*/
	this.setNetwork = function(_oNetwork)
	{
		_oNetwork = this.getRealParameter({'oParameters': _oNetwork, 'sName': 'oNetwork', 'xParameter': _oNetwork, 'bNotNull': true});
		this.oNetwork = _oNetwork;
	}
	/* @end method */

	/*
	@start method
	
	@group Network
	
	@description
	[en]Returns the network object.[/en]
	[de]Gibt das Netzwerk-Objekt zurück.[/de]
	
	@return oNetwork [type]object[/type]
	[en]Returns the network object.[/en]
	[de]Gibt das Netzwerk-Objekt zurück.[/de]
	*/
	this.getNetwork = function() {return this.oNetwork;}
	/* @end method */
	
	/*
	@start method
	
	@group Network
	
	@description
	[en]Sets the network response function, which processes returning data. (This is a callback function.)[/en]
	[de]Setzt die Netzwerk-Antwort-Funktion, die zurückkommende Daten verarbeitet. (Dies ist eine Callback-Funktion.)[/de]
	
	@param fOnResponse [needed][type]function[/type]
	[en]The response function that you want to process returning data from the server.[/en]
	[de]Die Antwort-Funktion, die vom Server zurückkommende Daten verarbeiten soll.[/de]
	*/
	this.setNetworkResponseFunction = function(_fOnResponse)
	{
		_fOnResponse = this.getRealParameter({'oParameters': _fOnResponse, 'sName': 'fOnResponse', 'xParameter': _fOnResponse});
		this.fNetworkOnResponse = _fOnResponse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Network
	
	@description
	[en]Returns the network response function.[/en]
	[de]Gibt die Netzwerk-Antwort-Funktion zurück.[/de]
	
	@return fResponseFunction [type]function[/type]
	[en]Returns the network response function.[/en]
	[de]Gibt die Netzwerk-Antwort-Funktion zurück.[/de]
	*/
	this.getNetworkResponseFunction = function() {return this.fNetworkOnResponse;}
	/* @end method */
	
	/*
	@start method
	
	@group Network
	
	@description
	[en]Sets the network data as an parameter string with "&" characters separated.[/en]
	[de]Setzt die Netzwerkdaten als Parameter-String mit "&" Zeichen getrennt.[/de]
	
	@param sParameters [needed][type]string[/type]
	[en]The parameter string to be sent as network data.[/en]
	[de]Der Parameter-String, der als Netzwerkdaten mit gesendet werden soll.[/de]
	*/
	this.setNetworkParameters = function(_sParameters)
	{
		_sParameters = this.getRealParameter({'oParameters': _sParameters, 'sName': 'sParameters', 'xParameter': _sParameters});
		this.sNetworkParameters = _sParameters;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Network
	
	@description
	[en]Returns a parameter string of network data.[/en]
	[de]Gibt einen Parameter-String der Netzwerkdaten zurück.[/de]
	
	@return sParameters [type]string[/type]
	[en]Returns a parameter string of network data. The data are separated by an "&" characters.[/en]
	[de]Gibt einen Parameter-String der Netzwerkdaten zurück. Die Daten sind durch ein "&" Zeichen getrennt.[/de]
	*/
	this.getNetworkParameters = function() {return this.sNetworkParameters;}
	/* @end method */
	
	/*
	@start method
	
	@group Network
	
	@description
	[en]Sets the response script file as a file path. This can be either an XML or a PHP file.[/en]
	[de]Setzt die Antwort-Script-Datei als Dateipfad. Dies kann entweder eine XML- oder eine PHP-Datei sein.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The file path to the response script file.[/en]
	[de]Der Dateipfad zur Antwort-Script-Datei.[/de]
	*/
	this.setNetworkResponseFile = function(_sFile)
	{
		_sFile = this.getRealParameter({'oParameters': _sFile, 'sName': 'sFile', 'xParameter': _sFile});
		this.sNetworkResponseFile = _sFile;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Network
	
	@description
	[en]Returns the file path to the answer script file.[/en]
	[de]Gibt den Dateipfad zur Antwort-Script-Datei zurück.[/de]
	
	@return sResponseFile [type]string[/type]
	[en]Returns the file path to the answer script file as a string.[/en]
	[de]Gibt den Dateipfad zur Antwort-Script-Datei als String zurück.[/de]
	*/
	this.getNetworkResponseFile = function() {return this.sNetworkResponseFile;}
	/* @end method */
	
	/*
	@start method
	
	@group Network
	
	@description
	[en]Sends data over the network.[/en]
	[de]Sendet Daten über das Netzwerk.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns a Boolean whether the send was successful.[/en]
	[de]Gibt einen Boolean zurück, ob das Senden erfolgreich war.[/de]
	
	@param sParameters [type]string[/type]
	[en]Parameters to be transmitted over the network. The parameters can be separated by a & character, just like URL parameters.[/en]
	[de]Parameter, die über das Netzwerk übertragen werden sollen. Die Parameter können mit einem & Zeichen getrennt werden, genau wie bei einer URL die Parameter.[/de]
	
	@param fOnResponse [type]function[/type]
	[en]The response function that you want to process returning data from the server.[/en]
	[de]Die Antwort-Funktion, die vom Server zurückkommende Daten verarbeiten soll.[/de]
	
	@param sResponseFile [type]string[/type]
	[en]The file path to the response script file.[/en]
	[de]Der Dateipfad zur Antwort-Script-Datei.[/de]
	*/
	this.networkSend = function(_sParameters, _fOnResponse, _sResponseFile)
	{
		if (typeof(_sParameters) == 'undefined') {var _sParameters = null;}
		if (typeof(_fOnResponse) == 'undefined') {var _fOnResponse = null;}
		if (typeof(_sResponseFile) == 'undefined') {var _sResponseFile = null;}

		_fOnResponse = this.getRealParameter({'oParameters': _sParameters, 'sName': 'fOnResponse', 'xParameter': _fOnResponse});
		_sResponseFile = this.getRealParameter({'oParameters': _sParameters, 'sName': 'sResponseFile', 'xParameter': _sResponseFile});
		_sParameters = this.getRealParameter({'oParameters': _sParameters, 'sName': 'sParameters', 'xParameter': _sParameters});
		if (this.oNetwork)
		{
			if (typeof(_sParameters) == 'undefined') {var _sParameters = null;}
			if (typeof(_fOnResponse) == 'undefined') {var _fOnResponse = null;}
			if (typeof(_sResponseFile) == 'undefined') {var _sResponseFile = null;}
			
			if (_sParameters == null) {_sParameters = this.sNetworkParameters;}
			if (_fOnResponse == null) {_fOnResponse = this.fNetworkOnResponse;}
			if (_sResponseFile == null) {_sResponseFile = this.sNetworkResponseFile;}

			return this.oNetwork.send({'sParameters': _sParameters, 'fOnResponse': _fOnResponse, 'sResponseFile': _sResponseFile});
		}
		return false;
	}
	/* @end method */
	
	// Url...
	/*
	@start method
	
	@group URL
	
	@description
	[en]Sets a target (window or frame) for a URL of the object / the class.[/en]
	[de]Setzt ein Ziel (Fenster oder Frame) für eine URL des Objekts / der Klasse.[/de]
	
	@param sTarget [needed][type]string[/type]
	[en]The target in which something is to be loaded.[/en]
	[de]Das Ziel, in dem etwas geladen werden soll.[/de]
	*/
	this.setUrlTarget = function(_sTarget)
	{
		_sTarget = this.getRealParameter({'oParameters': _sTarget, 'sName': 'sTarget', 'xParameter': _sTarget});
		this.sUrlTarget = _sTarget;
	}
	/* @end method */
	
	/*
	@start method
	
	@group URL
	
	@description
	[en]Returns the target (window or frame) of a URL.[/en]
	[de]Gibt das Ziel (Fenster oder Frame) für eine URL zurück.[/de]
	
	@return sUrlTarget [type]string[/type]
	[en]Returns the target (window or frame) of a URL as a string.[/en]
	[de]Gibt das Ziel (Fenster oder Frame) für eine URL als String zurück.[/de]
	*/
	this.getUrlTarget = function() {return this.sUrlTarget;}
	/* @end method */
	
	/*
	@start method
	
	@group URL
	
	@description
	[en]Sets a URL for an object / the class.[/en]
	[de]Setzt eine URL für ein Objekt / die Klasse.[/de]
	
	@param sUrl [needed][type]string[/type]
	[en]The URL to be loaded.[/en]
	[de]Die URL die geladen werden soll.[/de]
	*/
	this.setUrl = function(_sUrl)
	{
		_sUrl = this.getRealParameter({'oParameters': _sUrl, 'sName': 'sUrl', 'xParameter': _sUrl});
		this.sUrl = _sUrl;
	}
	/* @end method */
	
	/*
	@start method
	
	@group URL
	
	@description
	[en]Returns the URL to be loaded.[/en]
	[de]Gibt die URL zurück, die geladen werden soll.[/de]
	
	@return sUrl [type]string[/type]
	[en]Returns the URL to be loaded as a string.[/en]
	[de]Gibt die URL als string zurück, die geladen werden soll.[/de]
	*/
	this.getUrl = function() {return this.sUrl;}
	/* @end method */
	
	/*
	@start method
	
	@group URL
	
	@description
	[en]Sets URL parameters to be sent on load.[/en]
	[de]Setzt URL Parameter, die beim laden mit geschickt werden.[/de]
	
	@param oUrlParameters [needed][type]object[/type]
	[en]The parameter names and values as an object.[/en]
	[de]Die Parameternamen und Werte als Objekt.[/de]
	*/
	this.setUrlParameters = function(_oUrlParameters)
	{
		_oUrlParameters = this.getRealParameter({'oParameters': _oUrlParameters, 'sName': 'oUrlParameters', 'xParameter': _oUrlParameters, 'bNotNull': true});
		this.oUrlParameters = _oUrlParameters;
	}
	/* @end method */
	
	/*
	@start method
	
	@group URL
	
	@description
	[en]Adds URL parameters to be sent on load.[/en]
	[de]Fügt URL Parameter hinzu, die beim laden mit geschickt werden.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns a boolean whether adding parameters was successful.[/en]
	[de]Gibt ein Boolean zurück, ob das Hinzufügen von Parametern erfolgreich war.[/de]
	
	@param oUrlParameters [needed][type]object[/type]
	[en]The parameter names and values as an object.[/en]
	[de]Die Parameternamen und Werte als Objekt.[/de]
	*/
	this.addUrlParameters = function(_oUrlParameters)
	{
		_oUrlParameters = this.getRealParameter({'oParameters': _oUrlParameters, 'sName': 'oUrlParameters', 'xParameter': _oUrlParameters, 'bNotNull': true});
		if (typeof(oPGObject) != 'undefined') {this.oUrlParameters = oPGObject.concate(this.oUrlParameters, _oUrlParameters); return true;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group URL
	
	@description
	[en]Adds an URL parameter to be sent on load.[/en]
	[de]Fügt einen URL Parameter hinzu, der beim laden mit geschickt werden soll.[/de]

	@param sName [needed][type]string[/type]
	[en]The name of the parameter.[/en]
	[de]Der Name des Parameters.[/de]
	
	@param xValue [needed][type]mixed[/type]
	[en]The value of the parameter.[/en]
	[de]Der Wert des Parameters.[/de]
	*/
	this.addUrlParameter = function(_sName, _xValue)
	{
		if (typeof(_xValue) == 'undefined') {var _xValue = null;}
	
		_xValue = this.getRealParameter({'oParameters': _sName, 'sName': 'xValue', 'xParameter': _xValue});
		_sName = this.getRealParameter({'oParameters': _sName, 'sName': 'sName', 'xParameter': _sName});
		
		this.oUrlParameters[_sName] = _xValue;
	}
	/* @end method */
	
	/*
	@start method
	
	@group URL
	
	@description
	[en]Returns the URL parameters.[/en]
	[de]Gibt die URL Parameter zurück.[/de]
	
	@return oParameters [type]object[/type]
	[en]Returns the URL parameter as an object.[/en]
	[de]Gibt die URL Parameter als Objekt zurück.[/de]
	*/
	this.getUrlParameters = function() {return this.oUrlParameters;}
	/* @end method */
	
	/*
	@start method
	
	@group URL
	
	@description
	[en]Returns the URL parameters as a string for the transfer on a form.[/en]
	[de]Gibt die URL Parameter für die übergabe in einem Formular als String zurück.[/de]
	
	@return sHtml [type]string[/type]
	[en]Returns the URL parameters as a string for the transfer on a form.[/en]
	[de]Gibt die URL Parameter für die übergabe in einem Formular als String zurück.[/de]
	
	@param bUseLineBreak [type]bool[/type]
	[en]Specifies whether line breaks are used.[/en]
	[de]Gibt an ob Zeilenumbrüche verwendet werden sollen.[/de]
	*/
	this.getUrlParametersForm = function(_bUseLineBreak)
	{
		if (typeof(_bUseLineBreak) == 'undefined') {var _bUseLineBreak = null;}
		_bUseLineBreak = this.getRealParameter({'oParameters': _bUseLineBreak, 'sName': 'bUseLineBreak', 'xParameter': _bUseLineBreak});
		
		var _sHTML = '';
		var _xValue = '';
		for (var _sIndex in this.oUrlParameters)
		{
			_xValue = this.oUrlParameters(_sIndex);
			if (typeof(oPGStrings) != 'undefined') {_xValue = oPGStrings.htmlSpecialChars(_xValue);}
			_sHTML += '<input type="hidden" name="'+_sIndex+'" value="'+_xValue+'" />';
			if (_bUseLineBreak == true) {_sHTML += this.sLineBreak;}
		}
		return _sHTML;
	}
	/* @end method */
	
	/*
	@start method
	
	@group URL
	
	@description
	[en]Returns the URL parameters as a string for the transfer on a link.[/en]
	[de]Gibt die URL Parameter für die übergabe in einem Link als String zurück.[/de]
	
	@return sString [type]string[/type]
	[en]Returns the URL parameters as a string for the transfer on a link.[/en]
	[de]Gibt die URL Parameter für die übergabe in einem Link als String zurück.[/de]
	*/
	this.getUrlParametersString = function()
	{
		var i=0;
		var _sString = '';
		for (var _sIndex in this.oUrlParameters)
		{
			if (i > 0) {_sString += '&';}
			_sString += _sIndex+'='+this.oUrlParameters[_sIndex];
			i++;
		}
		return _sString;
	}
	/* @end method */
}
/* @end class */
