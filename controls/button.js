/*
* ProGade API
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* Last changes of this file: Nov 09 2012
*/
var PG_BUTTON_MODE_NONE = 0;
var PG_BUTTON_MODE_AUTOSUBMIT = 1;
var PG_BUTTON_MODE_HYPERLINK = 2;

var PG_BUTTON_EVENT_ONSUBMIT = 1;

/*
@start class

@description
[en]This class has methods to create an manage buttons.[/en]
[de]Diese Klasse verfügt über Methoden zum erstellen und verwalten von Buttons.[/de]

@param extends classPG_ClassBasics
*/
function classPG_Button()
{
	// Declarations...
	this.sImageLeft = 'button_left.gif';
	this.sImageFiller = 'button_filler.gif';
	this.sImageRight = 'button_right.gif';
	this.sImageLeftHover = 'button_left_hover.gif';
	this.sImageFillerHover = 'button_filler_hover.gif';
	this.sImageRightHover = 'button_right_hover.gif';
	this.sImageLeftDown = 'button_left_down.gif';
	this.sImageFillerDown = 'button_filler_down.gif';
	this.sImageRightDown = 'button_right_down.gif';
	
	// Construct...
	this.setID({'sID': 'PGButton'});
	this.initClassBasics();
	this.setGfxSubPath({'sPath': 'controls/'});
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Sets the left side image for graphical text buttons.[/en]
	[de]Setzt das linke Seitenbild für grafische Textbuttons.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The image for the button.[/en]
	[de]Das Bild für den Button.[/de]
	*/
	this.setImageLeft = function(_sImage)
	{
		_sImage = this.getRealParameter({'oParameters': _sImage, 'sName': 'sImage', 'xParameter': _sImage});
		this.sImageLeft = _sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the filler image for graphical text buttons.[/en]
	[de]Setzt das Füllbild für grafische Textbuttons.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The image for the button.[/en]
	[de]Das Bild für den Button.[/de]
	*/
	this.setImageFiller = function(_sImage)
	{
		_sImage = this.getRealParameter({'oParameters': _sImage, 'sName': 'sImage', 'xParameter': _sImage});
		this.sImageFiller = _sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the right side image for graphical text buttons.[/en]
	[de]Setzt das rechte Seitenbild für grafische Textbuttons.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The image for the button.[/en]
	[de]Das Bild für den Button.[/de]
	*/
	this.setImageRight = function(_sImage)
	{
		_sImage = this.getRealParameter({'oParameters': _sImage, 'sName': 'sImage', 'xParameter': _sImage});
		this.sImageRight = _sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the left side image for the hover effect of graphical text buttons.[/en]
	[de]Setzt das linke Seitenbild für den Hover-Effeckt von grafischen Textbuttons.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The image for the button.[/en]
	[de]Das Bild für den Button.[/de]
	*/
	this.setImageLeftHover = function(_sImage)
	{
		_sImage = this.getRealParameter({'oParameters': _sImage, 'sName': 'sImage', 'xParameter': _sImage});
		this.sImageLeftHover = _sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the filler image for the hover effect of graphical text buttons.[/en]
	[de]Setzt das Füllbild für den Hover-Effeckt von grafischen Textbuttons.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The image for the button.[/en]
	[de]Das Bild für den Button.[/de]
	*/
	this.setImageFillerHover = function(_sImage)
	{
		_sImage = this.getRealParameter({'oParameters': _sImage, 'sName': 'sImage', 'xParameter': _sImage});
		this.sImageFillerHover = _sImage;
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Sets the right side image for the hover effect of graphical text buttons.[/en]
	[de]Setzt das rechte Seitenbild für den Hover-Effeckt von grafischen Textbuttons.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The image for the button.[/en]
	[de]Das Bild für den Button.[/de]
	*/
	this.setImageRightHover = function(_sImage)
	{
		_sImage = this.getRealParameter({'oParameters': _sImage, 'sName': 'sImage', 'xParameter': _sImage});
		this.sImageRightHover = _sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the left side image for the pressed effect of graphical text buttons.[/en]
	[de]Setzt das linke Seitenbild für den Gedrückt-Effeckt von grafischen Textbuttons.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The image for the button.[/en]
	[de]Das Bild für den Button.[/de]
	*/
	this.setImageLeftDown = function(_sImage)
	{
		_sImage = this.getRealParameter({'oParameters': _sImage, 'sName': 'sImage', 'xParameter': _sImage});
		this.sImageLeftDown = _sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the filler image for the pressed effect of graphical text buttons.[/en]
	[de]Setzt das Füllbild für den Gedrückt-Effeckt von grafischen Textbuttons.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The image for the button.[/en]
	[de]Das Bild für den Button.[/de]
	*/
	this.setImageFillerDown = function(_sImage)
	{
		_sImage = this.getRealParameter({'oParameters': _sImage, 'sName': 'sImage', 'xParameter': _sImage});
		this.sImageFillerDown = _sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the right side image for the pressed effect of graphical text buttons.[/en]
	[de]Setzt das rechte Seitenbild für den Gedrückt-Effeckt von grafischen Textbuttons.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The image for the button.[/en]
	[de]Das Bild für den Button.[/de]
	*/
	this.setImageRightDown = function(_sImage)
	{
		_sImage = this.getRealParameter({'oParameters': _sImage, 'sName': 'sImage', 'xParameter': _sImage});
		this.sImageRightDown = _sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Builds a button.[/en]
	[de]Erstellt einen Button.[/de]
	
	@return sButtonHtml [type]string[/type]
	[en]Returns the button as an HTML string.[/en]
	[de]Gibt den Button als HTML String zurück.[/de]
	
	@param sButtonID [type]string[/type]
	[en]The ID of the button.[/en]
	[de]Die ID des Buttons.[/de]
	
	@param sText [type]string[/type]
	[en]The text on the button.[/en]
	[de]Der Text auf dem Button.[/de]
	
	@param sTextHover [type]string[/type]
	[en]The Text on the button on hover effect.[/en]
	[de]Der Text auf dem Button beim Hover-Effeckt.[/de]
	
	@param sTextDown [type]string[/type]
	[en]The Text on the button on pressed effect.[/en]
	[de]Der Text auf dem Button beim Gedrückt-Effeckt.[/de]
	
	@param sTextDownHover [type]string[/type]
	[en]The Text on the button on pressed hover effect.[/en]
	[de]Der Text auf dem Button beim Gedrückt-Hover-Effeckt.[/de]
	
	@param iButtonMode [type]int[/type]
	[en]
		The mode for the button.
		Specifies how the button should behave.
		Following de fines are possible:
		%ButtonModeDefines%
	[/en]
	[de]
		Der Modus für den Button.
		Gibt an wie der Button sich verhalten soll.
		Folgende Defines sind möglich:
		%ButtonModeDefines%
	[/de]
	
	@param sOnClick [type]string[/type]
	[en]The JavaScript code that should be executed on klick.[/en]
	[de]Der JavaScript Code der beim Anklicken des Buttons ausgeführt werden soll.[/de]
	
	@param sSizeX [type]string[/type]
	[en]The width of the button.[/en]
	[de]Die Breite des Buttons.[/de]
	
	@param sSizeY [type]string[/type]
	[en]The height of the button.[/en]
	[de]Die H�he des Buttons.[/de]
	
	@param bDisplay [type]bool[/type]
	[en]Specifies whether the button should be displayed.[/en]
	[de]Gibt an ob der Button angezeigt werden soll.[/de]
	
	@param sSendParameters [type]string[/type]
	[en]Parameters which should be sent when submit.[/en]
	[de]Parameter die beim Abschicken geschickt werden sollen.[/de]
	
	@param sOnMouseDown [type]string[/type]
	[en]The JavaScript code that should be executed on mouse down.[/en]
	[de]Der JavaScript Code der beim drücken der Maustaste auf dem Button ausgeführt werden soll.[/de]
	
	@param sOnMouseUp [type]string[/type]
	[en]The JavaScript code that should be executed on mouse up.[/en]
	[de]Der JavaScript Code der beim loslassen der Maustaste auf dem Button ausgeführt werden soll.[/de]
	
	@param sOnMouseOver [type]string[/type]
	[en]The JavaScript code that should be executed on mouse over.[/en]
	[de]Der JavaScript Code der ausgeführt werden soll, wenn der Mauszeiger über den Button bewegt wird.[/de]
	
	@param sOnMouseOut [type]string[/type]
	[en]The JavaScript code that should be executed on mouse out.[/en]
	[de]Der JavaScript Code der ausgeführt werden soll, wenn der Mauszeiger den Button verlässt.[/de]
	
	@param sImageButtonNormal [type]string[/type]
	[en]The image for a pure graphic button in the normal state.[/en]
	[de]Ein Bild für einen reinen Grafikbutton im normalen Zustand.[/de]
	
	@param sImageButtonHover [type]string[/type]
	[en]The image for a pure graphic button in the hover state.[/en]
	[de]Ein Bild für einen reinen Grafikbutton beim Hover-Effeckt.[/de]
	
	@param sImageButtonDown [type]string[/type]
	[en]The image for a pure graphic button in the pressed state.[/en]
	[de]Ein Bild für einen reinen Grafikbutton beim Gedrückt-Effeckt.[/de]
	
	@param sImageButtonDownHover [type]string[/type]
	[en]The image for a pure graphic button in the pressed hover state.[/en]
	[de]Ein Bild für einen reinen Grafikbutton beim Gedrückt-Hover-Effeckt.[/de]
	
	@param sCssStyle [type]string[/type]
	[en]CSS code for the button.[/en]
	[de]CSS Code für den Button.[/de]
	
	@param sCssClass [type]string[/type]
	[en]A CSS class for the button.[/en]
	[de]Eine CSS Klasse für den Button.[/de]
	
	@param sCssClassNormal [type]string[/type]
	[en]A CSS class for the button in the normal state.[/en]
	[de]Eine CSS Klasse für den Button im normalen Zustand[/de]
	
	@param sCssClassDown [type]string[/type]
	[en]A CSS class for the button in the pressed state.[/en]
	[de]Eine CSS Klasse für den Button im gedrückten Zustand[/de]
	*/
	this.build = function(
		_sButtonID,
		_sText,
		_sTextHover,
		_sTextDown,
		_sTextDownHover,
		_iButtonMode,
		_sOnClick,
		_sSizeX,
		_sSizeY,
		_bDisplay,
		_sSendParameters,
		_sOnMouseDown,
		_sOnMouseUp,
		_sOnMouseOver,
		_sOnMouseOut,
		_sImageButtonNormal,
		_sImageButtonHover,
		_sImageButtonDown,
		_sImageButtonDownHover,
		_sCssStyle,
		_sCssClass,
		_sCssClassNormal,
		_sCssClassDown
	)
	{
		if (typeof(_sButtonID) == 'undefined') {var _sButtonID = null;}
		if (typeof(_sText) == 'undefined') {var _sText = null;}
		if (typeof(_sTextHover) == 'undefined') {var _sTextHover = null;}
		if (typeof(_sTextDown) == 'undefined') {var _sTextDown = null;}
		if (typeof(_sTextDownHover) == 'undefined') {var _sTextDownHover = null;}
		if (typeof(_iButtonMode) == 'undefined') {var _iButtonMode = null;}
		if (typeof(_sOnClick) == 'undefined') {var _sOnClick = null;}
		if (typeof(_sSizeX) == 'undefined') {var _sSizeX = null;}
		if (typeof(_sSizeY) == 'undefined') {var _sSizeY = null;}
		if (typeof(_bDisplay) == 'undefined') {var _bDisplay = null;}
		if (typeof(_sSendParameters) == 'undefined') {var _sSendParameters = null;}
		if (typeof(_sOnMouseDown) == 'undefined') {var _sOnMouseDown = null;}
		if (typeof(_sOnMouseUp) == 'undefined') {var _sOnMouseUp = null;}
		if (typeof(_sOnMouseOver) == 'undefined') {var _sOnMouseOver = null;}
		if (typeof(_sImageButtonNormal) == 'undefined') {var _sImageButtonNormal = null;}
		if (typeof(_sImageButtonHover) == 'undefined') {var _sImageButtonHover = null;}
		if (typeof(_sImageButtonDown) == 'undefined') {var _sImageButtonDown = null;}
		if (typeof(_sImageButtonDownHover) == 'undefined') {var _sImageButtonDownHover = null;}
		if (typeof(_sCssStyle) == 'undefined') {var _sCssStyle = null;}
		if (typeof(_sCssClass) == 'undefined') {var _sCssClass = null;}
		if (typeof(_sCssClassNormal) == 'undefined') {var _sCssClassNormal = null;}
		if (typeof(_sCssClassDown) == 'undefined') {var _sCssClassDown = null;}
		if (typeof(_sOnMouseOut) == 'undefined') {var _sOnMouseOut = null;}
		
		_sText = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sText', 'xParameter': _sText});
		_sTextHover = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sTextHover', 'xParameter': _sTextHover});
		_sTextDown = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sTextDown', 'xParameter': _sTextDown});
		_sTextDownHover = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sTextDownHover', 'xParameter': _sTextDownHover});
		_iButtonMode = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'iButtonMode', 'xParameter': _iButtonMode});
		_sOnClick = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sOnClick', 'xParameter': _sOnClick});
		_sSizeX = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sSizeX', 'xParameter': _sSizeX});
		_sSizeY = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sSizeY', 'xParameter': _sSizeY});
		_bDisplay = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'bDisplay', 'xParameter': _bDisplay});
		_sSendParameters = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sSendParameters', 'xParameter': _sSendParameters});
		_sOnMouseDown = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sOnMouseDown', 'xParameter': _sOnMouseDown});
		_sOnMouseUp = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sOnMouseUp', 'xParameter': _sOnMouseUp});
		_sOnMouseOver = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sOnMouseOver', 'xParameter': _sOnMouseOver});
		_sOnMouseOut = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sOnMouseOut', 'xParameter': _sOnMouseOut});
		_sImageButtonNormal = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sImageButtonNormal', 'xParameter': _sImageButtonNormal});
		_sImageButtonHover = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sImageButtonHover', 'xParameter': _sImageButtonHover});
		_sImageButtonDown = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sImageButtonDown', 'xParameter': _sImageButtonDown});
		_sImageButtonDownHover = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sImageButtonDownHover', 'xParameter': _sImageButtonDownHover});
		_sCssStyle = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sCssStyle', 'xParameter': _sCssStyle});
		_sCssClass = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		_sCssClassNormal = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sCssClassNormal', 'xParameter': _sCssClassNormal});
		_sCssClassDown = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sCssClassDown', 'xParameter': _sCssClassDown});
		_sButtonID = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sButtonID', 'xParameter': _sButtonID});
		
		if (_sButtonID == null) {_sButtonID = this.getNextID();}
		if (_sText == null) {_sText = 'ok';}
		if (_sTextHover == null) {_sTextHover = _sText;}
		if (_sTextDown == null) {_sTextDown = _sTextHover;}
		if (_sTextDownHover == null) {_sTextDownHover = _sTextDown;}
		if (_iButtonMode == null) {_iButtonMode = PG_BUTTON_MODE_NONE;}
		if (_sCssClass == null) {_sCssClass = this.sCssClass;}
		if (_sCssClassNormal == null) {_sCssClassNormal = this.sCssClassNormal;}
		if (_sCssClassDown == null) {_sCssClassDown = this.sCssClassDown;}
		if (_sCssStyle == null) {if (!this.isMode({'iMode': PG_BUTTON_MODE_HYPERLINK, 'iCurrentMode': _iButtonMode})) {_sCssStyle = 'float:left;';} else {_sCssStyle = '';}}
		
		var _sHTML = '';
		if (this.isMode({'iMode': PG_BUTTON_MODE_HYPERLINK, 'iCurrentMode': _iButtonMode}))
		{
			if (_sOnClick == '') {_sOnClick = 'javascript:;';}
			_sHTML += '<a href="'+_sOnClick+'" ';
		}
		else {_sHTML += '<div ';}
		_sHTML += 'id="'+_sButtonID+'" ';

		// OnMouseDown...
		_sHTML += 'onmousedown="';
		if ((_sOnMouseDown != '') && (_sOnMouseDown != null)) {_sHTML += _sOnMouseDown.replace(/"/g, '\"')+' ';}
		_sHTML += 'oPGButton.onButtonMouseDown({\'sButtonID\': \''+_sButtonID+'\'}); ';
		_sHTML += '" ';
		
		// OnMouseUp...
		_sHTML += 'onmouseup="';
		if (!this.isMode({'iMode': PG_BUTTON_MODE_HYPERLINK, 'iCurrentMode': _iButtonMode}))
		{
			if ((_sOnClick != '') && (_sOnClick != null)) {_sHTML += _sOnClick.replace(/"/g, '\"')+' ';}
		}
		if ((_sOnMouseUp != '') && (_sOnMouseUp != null)) {_sHTML += _sOnMouseUp.replace(/"/g, '\"')+' ';}
		_sHTML += 'oPGButton.onButtonMouseUp({\'sButtonID\': \''+_sButtonID+'\'}); ';
		_sHTML += '" ';
		
		// OnMouseOver...
		_sHTML += 'onmouseover="';
		if ((_sOnMouseOver != '') && (_sOnMouseOver != null)) {_sHTML += _sOnMouseOver.replace(/"/g, '\"')+' ';}
		_sHTML += 'oPGButton.onButtonMouseOver({\'sButtonID\': \''+_sButtonID+'\'}); ';
		_sHTML += '" ';
		
		// OnMouseOut...
		_sHTML += 'onmouseout="';
		if ((_sOnMouseOut != '') && (_sOnMouseOut != null)) {_sHTML += _sOnMouseOut.replace(/"/g, '\"')+' ';}
		_sHTML += 'oPGButton.onButtonMouseOut({\'sButtonID\': \''+_sButtonID+'\'}); ';
		_sHTML += '" ';
		
		if (_sCssClass != null) {_sHTML += 'class="'+_sCssClass+'" ';}
		
		_sHTML += 'style="';
		if ((_sSizeX != null) && (_sSizeX != '')) {_sHTML += 'width:'+_sSizeX+'; ';}
		if ((_sSizeY != null) && (_sSizeY != '')) {_sHTML += 'height:'+_sSizeY+'; ';}
		if ((_bDisplay == null) || (_bDisplay == true)) {_sHTML += 'display:inline-block; ';} else {_sHTML += 'display:none; ';}
		if (!this.isMode({'iMode': PG_BUTTON_MODE_HYPERLINK, 'iCurrentMode': _iButtonMode})) {_sHTML += 'cursor:pointer; ';}
		_sHTML += _sCssStyle+'">';
		
		// Normal...
		if (_sImageButtonNormal != null) {_sHTML += '<img id="'+_sButtonID+'ButtonNormal" src="'+this.getGfxPathImages({'sImage': _sImageButtonNormal})+'" style="border:0; display:inline-block;" />';}
		else if (this.sImageFiller != null)
		{
			_sHTML += '<table id="'+_sButtonID+'ButtonNormal" style="';
			if ((_sSizeX != null) && (_sSizeX != '')) {_sHTML += 'width:'+_sSizeX+'; ';}
			if ((_sSizeY != null) && (_sSizeY != '')) {_sHTML += 'height:'+_sSizeY+'; ';}
			_sHTML += 'display:block; border-width:0px;" cellpadding="0" cellspacing="0">';
			_sHTML += '<tr>';
				if (this.sImageLeft != '') {_sHTML += '<td>'+this.img({'sImage': this.sImageLeft})+'</td>';}
				_sHTML += '<td background="'+this.getGfxPathImages({'sImage': this.sImageFiller})+'" ';
				_sHTML += 'style="background-repeat:repeat-x; background-position:center center; background-color:transparent; ';
				if ((_sSizeX != null) && (_sSizeX != '')) {_sHTML += 'width:100%; ';}
				if ((_sSizeY != null) && (_sSizeY != '')) {_sHTML += 'height:100%; ';}
				_sHTML += 'text-align:center; vertical-align:middle; ">';
				_sHTML += '<nobr>'+_sText+'</nobr>';
				_sHTML += '</td>';
				if (this.sImageRight != '') {_sHTML += '<td>'+this.img({'sImage': this.sImageRight})+'</td>';}
			_sHTML += '</tr>';
			_sHTML += '</table>';
		}
		else
		{
			_sHTML += '<div id="'+_sButtonID+'ButtonNormal" ';
			if (_sCssClassNormal != null) {_sHTML += 'class="'+_sCssClassNormal+'" ';}
			_sHTML += 'style="';
			if ((_sSizeX != null) && (_sSizeX != '')) {_sHTML += 'width:'+_sSizeX+'; ';}
			if ((_sSizeY != null) && (_sSizeY != '')) {_sHTML += 'height:'+_sSizeY+'; ';}
			if ((_sSizeX != null) && (_sSizeY != null)) {_sHTML += 'overflow:hidden; ';}
			_sHTML += 'display:block;">'+_sText+'</div>';
		}
		
		// NormalHover...
		if (_sImageButtonHover != null) {_sHTML += '<img id="'+_sButtonID+'ButtonHover" src="'+this.getGfxPathImages({'sImage': sImageButtonHover})+'" style="border:0; display:none;" />';}
		else if (this.sImageFillerHover != null)
		{
			_sHTML += '<table id="'+_sButtonID+'ButtonHover" style="';
			if ((_sSizeX != null) && (_sSizeX != '')) {_sHTML += 'width:'+_sSizeX+'; ';}
			if ((_sSizeY != null) && (_sSizeY != '')) {_sHTML += 'height:'+_sSizeY+'; ';}
			_sHTML += 'display:none; border-width:0px;" cellpadding="0" cellspacing="0">';
			_sHTML += '<tr>';
				if (this.sImageLeftHover != '') {_sHTML += '<td>'+this.img({'sImage': this.sImageLeftHover})+'</td>';}
				_sHTML += '<td background="'+this.getGfxPathImages(this.sImageFillerHover)+'" ';
				_sHTML += 'style="background-repeat:repeat-x; background-position:center center; background-color:transparent; ';
				if ((_sSizeX != null) && (_sSizeX != '')) {_sHTML += 'width:100%; ';}
				if ((_sSizeY != null) && (_sSizeY != '')) {_sHTML += 'height:100%; ';}
				_sHTML += 'text-align:center; vertical-align:middle;">';
				_sHTML += '<nobr>'+_sText+'</nobr>';
				_sHTML += '</td>';
				if (this.sImageRightHover != '') {_sHTML += '<td>'+this.img({'sImage': this.sImageRightHover})+'</td>';}
			_sHTML += '</tr>';
			_sHTML += '</table>';
		}
		else
		{
			_sHTML += '<div id="'+_sButtonID+'ButtonHover" ';
			if (_sCssClassNormal != null) {_sHTML += 'class="'+_sCssClassNormal+'" ';}
			_sHTML += 'style="';
			if ((_sSizeX != null) && (_sSizeX != '')) {_sHTML += 'width:'+_sSizeX+'; ';}
			if ((_sSizeY != null) && (_sSizeY != '')) {_sHTML += 'height:'+_sSizeY+'; ';}
			if ((_sSizeX != null) && (_sSizeY != null)) {_sHTML += 'overflow:hidden; ';}
			_sHTML += 'display:none;">'+_sTextHover+'</div>';
		}
		
		// Down...		
		if (_sImageButtonDown != null) {_sHTML += '<img id="'+_sButtonID+'ButtonDown" src="'+this.getGfxPathImages({'sImage': _sImageButtonDown})+'" style="border:0; display:none;" />';}
		else if (this.sImageFillerDown != null)
		{
			_sHTML += '<table id="'+_sButtonID+'ButtonDown" style="';
			if ((_sSizeX != null) && (_sSizeX != '')) {_sHTML += 'width:'+_sSizeX+'; ';}
			if ((_sSizeY != null) && (_sSizeY != '')) {_sHTML += 'height:'+_sSizeY+'; ';}
			_sHTML += 'display:none; border-width:0px;" cellpadding="0" cellspacing="0">';
			_sHTML += '<tr>';
				if (this.sImageLeftDown != '') {_sHTML += '<td>'+this.img({'sImage': this.sImageLeftDown})+'</td>';}
				_sHTML += '<td background="'+this.getGfxPathImages({'sImage': this.sImageFillerDown})+'" ';
				_sHTML += 'style="background-repeat:repeat-x; background-position:center center; background-color:transparent; ';
				if ((_sSizeX != null) && (_sSizeX != '')) {_sHTML += 'width:100%; ';}
				if ((_sSizeY != null) && (_sSizeY != '')) {_sHTML += 'height:100%; ';}
				_sHTML += 'text-align:center; vertical-align:middle;">';
				_sHTML += '<nobr>'+_sText+'</nobr>';
				_sHTML += '</td>';
				if (this.sImageRightDown != '') {_sHTML += '<td>'+this.img({'sImage': this.sImageRightDown})+'</td>';}
			_sHTML += '</tr>';
			_sHTML += '</table>';
		}
		else
		{
			_sHTML += '<div id="'+_sButtonID+'ButtonDown" ';
			if (_sCssClassDown != null) {_sHTML += 'class="'+_sCssClassDown+'" ';}
			_sHTML += 'style="';
			if ((_sSizeX != null) && (_sSizeX != '')) {_sHTML += 'width:'+_sSizeX+'; ';}
			if ((_sSizeY != null) && (_sSizeY != '')) {_sHTML += 'height:'+_sSizeY+'; ';}
			if ((_sSizeX != null) && (_sSizeY != null)) {_sHTML += 'overflow:hidden; ';}
			_sHTML += 'display:none;">'+_sTextDown+'</div>';
		}
		
		// DownHover...
		if (_sImageButtonDownHover != null) {_sHTML += '<img id="'+_sButtonID+'ButtonDownHover" src="'+this.getGfxPathImages({'sImage': _sImageButtonDownHover})+'" style="border:0; display:none;" />';}
		else if (this.sImageFillerDownHover != null)
		{
			_sHTML += '<table id="'+_sButtonID+'ButtonDownHover" style="';
			if ((_sSizeX != null) && (_sSizeX != '')) {_sHTML += 'width:'+_sSizeX+'; ';}
			if ((_sSizeY != null) && (_sSizeY != '')) {_sHTML += 'height:'+_sSizeY+'; ';}
			_sHTML += 'display:none; border:0;" cellpadding="0" cellspacing="0">';
			_sHTML += '<tr>';
				if (this.sImageLeftDownHover != '') {_sHTML += '<td>'+this.getGfxPathImages({'sImage': this.sImageLeftDownHover})+'</td>';}
				_sHTML += '<td background="'+this.getGfxPathImages({'sImage': this.sImageFillerDownHover})+'" ';
				_sHTML += 'style="background-repeat:repeat-x; background-position:center center; background-color:transparent; ';
				if ((_sSizeX != null) && (_sSizeX != '')) {_sHTML += 'width:100%; ';}
				if ((_sSizeY != null) && (_sSizeY != '')) {_sHTML += 'height:100%; ';}
				_sHTML += 'text-align:center; vertical-align:middle;">';
				_sHTML += '<nobr>'+_sText+'</nobr>';
				_sHTML += '</td>';
				if (this.sImageRightDownHover != '') {_sHTML += '<td>'+this.getGfxPathImages({'sImage': this.sImageRightDownHover})+'</td>';}
			_sHTML += '</tr>';
			_sHTML += '</table>';
		}
		else
		{
			_sHTML += '<div id="'+_sButtonID+'ButtonDownHover" ';
			if (_sCssClassDown != null) {_sHTML += 'class="'+_sCssClassDown+'" ';}
			_sHTML += 'style="';
			if ((_sSizeX != null) && (_sSizeX != '')) {_sHTML += 'width:'+_sSizeX+'; ';}
			if ((_sSizeY != null) && (_sSizeY != '')) {_sHTML += 'height:'+_sSizeY+'; ';}
			if ((_sSizeX != null) && (_sSizeY != null)) {_sHTML += 'overflow:hidden; ';}
			_sHTML += 'display:none;">'+_sTextDownHover+'</div>';
		}
		
		_sHTML += '<input type="hidden" id="'+_sButtonID+'Mode" value="'+_iButtonMode+'" />';
		_sHTML += '<input type="hidden" id="'+_sButtonID+'SendParameters" value="'+_sSendParameters+'" />';
		if (typeof(oPGControls) != 'undefined') {_sHTML += '<input type="hidden" id="'+_sButtonID+'ControlsType" value="'+PG_CONTROLS_TYPE_BUTTON+'" />';}
		if (this.isMode({'iMode': PG_BUTTON_MODE_HYPERLINK, 'iCurrentMode': _iButtonMode})) {_sHTML += '</a>';} else {_sHTML += '</div>';}
		
		return _sHTML;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the content of a button.[/en]
	[de]Setzt den Inhalt eines Buttons.[/de]
	
	@param sButtonID [needed][type]string[/type]
	[en]The ID of the button.[/en]
	[de]Die ID des Buttons.[/de]
	
	@param sContent [needed][type]string[/type]
	[en]The content that should be set.[/en]
	[de]Der Inhalt der gesetzt werden soll.[/de]
	
	@param sButtonStatus [type]string[/type]
	[en]
		The state in which the content is to be seen.
		If omitted, or "null", the contents can be seen at all.
		Follow values are possible:
		normal
		hover
		down
		downhover
	[/en]
	[de]
		Der Status bei dem der Inhalt zu sehen sein soll.
		Bei keiner Angabe oder "null" ist der Inhalt bei allen zu sehen.
		Folgende Werte sind möglich:
		normal
		hover
		down
		downhover
	[/de]
	*/
	this.setContent = function(_sButtonID, _sContent, _sButtonStatus)
	{
		if (typeof(_sContent) == 'undefined') {var _sContent = null;}
		if (typeof(_sButtonStatus) == 'undefined') {var _sButtonStatus = null;}

		_sContent = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sContent', 'xParameter': _sContent});
		_sButtonStatus = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sButtonStatus', 'xParameter': _sButtonStatus});
		_sButtonID = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sButtonID', 'xParameter': _sButtonID});

		var _oButton = null;
		
		if ((_sButtonStatus == null) || (_sButtonStatus.toLowerCase() == 'normal'))
		{
			_oButton = this.oDocument.getElementById(_sButtonID+'ButtonNormal');
			if (_oButton) {_oButton.innerHTML = _sContent;}
		}
		
		if ((_sButtonStatus == null) || (_sButtonStatus.toLowerCase() == 'hover'))
		{
			_oButton = this.oDocument.getElementById(_sButtonID+'ButtonHover');
			if (_oButton) {_oButton.innerHTML = _sContent;}
		}
		
		if ((_sButtonStatus == null) || (_sButtonStatus.toLowerCase() == 'down'))
		{
			_oButton = this.oDocument.getElementById(_sButtonID+'ButtonDown');
			if (_oButton) {_oButton.innerHTML = _sContent;}
		}
		
		if ((_sButtonStatus == null) || (_sButtonStatus.toLowerCase() == 'downhover'))
		{
			_oButton = this.oDocument.getElementById(_sButtonID+'ButtonDownHover');
			if (_oButton) {_oButton.innerHTML = _sContent;}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Hides all states.[/en]
	[de]Versteckt jeden Status.[/de]
	
	@param sButtonID [needed][type]string[/type]
	[en]The ID of the button.[/en]
	[de]Die ID des Buttons.[/de]
	*/
	this.hideAllStates = function(_sButtonID)
	{
		_sButtonID = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sButtonID', 'xParameter': _sButtonID});
	
		var _oButtonNormal = this.oDocument.getElementById(_sButtonID+'ButtonNormal');
		if (_oButtonNormal) {_oButtonNormal.style.display = 'none';}
		
		var _oButtonHover = this.oDocument.getElementById(_sButtonID+'ButtonHover');
		if (_oButtonHover) {_oButtonHover.style.display = 'none';}

		var _oButtonDown = this.oDocument.getElementById(_sButtonID+'ButtonDown');
		if (_oButtonDown) {_oButtonDown.style.display = 'none';}

		var _oButtonDownHover = this.oDocument.getElementById(_sButtonID+'ButtonDownHover');
		if (_oButtonDownHover) {_oButtonDownHover.style.display = 'none';}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Functionality on mouse cursor over the button.[/en]
	[de]Funktionalität bei Mauszeiger über dem Button.[/de]
	
	@param sButtonID [needed][type]string[/type]
	[en]The ID of the button.[/en]
	[de]Die ID des Buttons.[/de]
	*/
	this.onButtonMouseOver = function(_sButtonID)
	{
		_sButtonID = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sButtonID', 'xParameter': _sButtonID});

		oPGControls.sMouseOverControlID = _sButtonID;
		this.hideAllStates({'sButtonID': _sButtonID});
		if (oPGControls.sMouseDownControlID == _sButtonID)
		{
			var _oButtonDownHover = this.oDocument.getElementById(_sButtonID+'ButtonDownHover');
			if (_oButtonDownHover) {_oButtonDownHover.style.display = 'inline-block';}
		}
		else
		{
			var _oButtonHover = this.oDocument.getElementById(_sButtonID+'ButtonHover');
			if (_oButtonHover) {_oButtonHover.style.display = 'inline-block';}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Functionality on mouse cursor release the button.[/en]
	[de]Funktionalität bei Mauszeiger verlässt den Button.[/de]
	
	@param sButtonID [needed][type]string[/type]
	[en]The ID of the button.[/en]
	[de]Die ID des Buttons.[/de]
	*/
	this.onButtonMouseOut = function(_sButtonID)
	{
		_sButtonID = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sButtonID', 'xParameter': _sButtonID});

		if (oPGControls.sMouseOverControlID == _sButtonID) {oPGControls.sMouseOverControlID = '';}
		this.hideAllStates({'sButtonID': _sButtonID});
		if (oPGControls.sMouseDownControlID == _sButtonID)
		{
			var _oButtonDown = this.oDocument.getElementById(_sButtonID+'ButtonDown');
			if (_oButtonDown) {_oButtonDown.style.display = 'inline-block';}
		}
		else
		{
			var _oButtonNormal = this.oDocument.getElementById(_sButtonID+'ButtonNormal');
			if (_oButtonNormal) {_oButtonNormal.style.display = 'inline-block';}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Functionality on pressing the button.[/en]
	[de]Funktionalität bei drücken des Buttons.[/de]
	
	@param sButtonID [needed][type]string[/type]
	[en]The ID of the button.[/en]
	[de]Die ID des Buttons.[/de]
	*/
	this.onButtonMouseDown = function(_sButtonID)
	{
		_sButtonID = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sButtonID', 'xParameter': _sButtonID});

		oPGControls.sMouseDownControlID = _sButtonID;
		if (typeof(oPGBrowser) != 'undefined') {oPGBrowser.disableSelect();}
		var _oButtonMode = this.oDocument.getElementById(_sButtonID+'Mode');
		if (_oButtonMode)
		{
			if (!this.isMode({'iMode': PG_BUTTON_MODE_HYPERLINK, 'iCurrentMode': parseInt(_oButtonMode.value)}))
			{
				this.hideAllStates({'sButtonID': _sButtonID});
				var _oButtonDownHover = this.oDocument.getElementById(_sButtonID+'ButtonDownHover');
				if (_oButtonDownHover) {_oButtonDownHover.style.display = 'inline-block';}
				return false;
			}
		}
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Functionality on let go the button.[/en]
	[de]Funktionalitüt bei loslassen des Buttons.[/de]
	
	@param sButtonID [needed][type]string[/type]
	[en]The ID of the button.[/en]
	[de]Die ID des Buttons.[/de]
	*/
	this.onButtonMouseUp = function(_sButtonID)
	{
		_sButtonID = this.getRealParameter({'oParameters': _sButtonID, 'sName': 'sButtonID', 'xParameter': _sButtonID});

		if (oPGControls.sMouseDownControlID == _sButtonID) {oPGControls.sMouseDownControlID = '';}
		if (typeof(oPGBrowser) != 'undefined') {oPGBrowser.enableSelect();}
		this.hideAllStates({'sButtonID': _sButtonID});
		var _oButtonHover = this.oDocument.getElementById(_sButtonID+'ButtonHover');
		if (_oButtonHover) {_oButtonHover.style.display = 'inline-block';}
		
		var _oButtonMode = this.oDocument.getElementById(_sButtonID+'Mode');
		var _oButtonSendParameters = this.oDocument.getElementById(_sButtonID+'SendParameters');
		if ((_oButtonMode) && (_oButtonSendParameters))
		{
			var _iButtonMode = parseInt(_oButtonMode.value);
			if (this.isMode({'iMode': PG_BUTTON_MODE_AUTOSUBMIT, 'iCurrentMode': _iButtonMode}))
			{
				var _sParameters = 'sEvent='+PG_BUTTON_EVENT_ONSUBMIT;
				if (_oButtonSendParameters.value != '') {_sParameters += '&'+_oButtonSendParameters.value;}
				var _fOnResponse = null;
				var _sResponseFile = null;
				this.networkSend({'sParameters': _sParameters, 'fOnResponse':_fOnResponse, 'sResponseFile': _sResponseFile});
			}
		}
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Checks the touch of the mouse pointer. This method should be used when global onmouseup events.[/en]
	[de]Prüft Berührungen des Mauszeigers. Diese Methode sollte bei globalen onmouseup Events verwendet werden.[/de]
	*/
	this.onMouseUp = function()
	{
		if (oPGControls.sMouseDownControlID != '')
		{
			var _oControlType = this.oDocument.getElementById(oPGControls.sMouseDownControlID+'ControlsType');
			if (_oControlType)
			{
				if (parseInt(_oControlType.value) == PG_CONTROLS_TYPE_BUTTON)
				{
					this.hideAllStates({'sButtonID': oPGControls.sMouseDownControlID});
					if (oPGControls.sMouseOverControlID == oPGControls.sMouseDownControlID)
					{
						var _oButtonHover = this.oDocument.getElementById(oPGControls.sMouseDownControlID+'ButtonHover');
						if (_oButtonHover) {_oButtonHover.style.display = 'inline-block';}
					}
					else
					{
						var _oButtonNormal = this.oDocument.getElementById(oPGControls.sMouseDownControlID+'ButtonNormal');
						if (_oButtonNormal) {_oButtonNormal.style.display = 'inline-block';}
					}
					oPGControls.sMouseDownControlID = '';
				}
			}
		}
	}
	/* @end method */
}
/* @end class */
classPG_Button.prototype = new classPG_ClassBasics();
var oPGButton = new classPG_Button();
