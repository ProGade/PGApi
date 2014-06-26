/*
* ProGade API
* http://api.progade.de/
*
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: "http://api.progade.de/api_terms.php" or "./license.txt"
*
* Last changes of this file: Aug 21 2012
*/
var PG_EVENTTYPE_ONABORT = 'abort';
var PG_EVENTTYPE_ONBLUR = 'blur';
var PG_EVENTTYPE_ONCHANGE = 'change';
var PG_EVENTTYPE_ONERROR = 'error';
var PG_EVENTTYPE_ONFOCUS = 'focus';
var PG_EVENTTYPE_ONKEYDOWN = 'keydown';
var PG_EVENTTYPE_ONKEYPRESS = 'keypress';
var PG_EVENTTYPE_ONKEYUP = 'keyup';
var PG_EVENTTYPE_ONLOAD = 'load';
var PG_EVENTTYPE_ONRESIZE = 'resize';
var PG_EVENTTYPE_ONRESET = 'reset';
var PG_EVENTTYPE_ONSELECT = 'select';
var PG_EVENTTYPE_ONSUBMIT = 'submit';
var PG_EVENTTYPE_ONUNLOAD = 'unload';
var PG_EVENTTYPE_ONCONTEXTMENU = 'contextmenu';

var PG_EVENTTYPE_ONCLICK = 'click';
var PG_EVENTTYPE_ONDOUBLECLICK = 'dblclick';
var PG_EVENTTYPE_ONMOUSEDOWN = 'mousedown';
var PG_EVENTTYPE_ONMOUSEMOVE = 'mousemove';
var PG_EVENTTYPE_ONMOUSEOUT = 'mouseout';
var PG_EVENTTYPE_ONMOUSEOVER = 'mouseover';
var PG_EVENTTYPE_ONMOUSEUP = 'mouseup';
var PG_EVENTTYPE_ONMOUSEWHEEL = 'mousewheel';
var PG_EVENTTYPE_ONDOMMOUSEWHEEL = 'DOMMouseScroll';

var PG_EVENTTYPE_ONMSPOINTERDOWN = 'MSPointerDown';
var PG_EVENTTYPE_ONMSPOINTERUP = 'MSPointerUp';
var PG_EVENTTYPE_ONMSPOINTERMOVE = 'MSPointerMove';

var PG_EVENTTYPE_ONPRESS = 'press';
var PG_EVENTTYPE_ONRELEASE = 'release';
var PG_EVENTTYPE_ONMOVE = 'move';

// Mobile...
var PG_EVENTTYPE_ONTOUCHSTART = 'touchstart';
var PG_EVENTTYPE_ONTOUCHMOVE = 'touchmove';
var PG_EVENTTYPE_ONTOUCHEND = 'touchend';
var PG_EVENTTYPE_ONTOUCHCANCEL = 'touchcancel';

var PG_EVENTTYPE_ONMENUKEYDOWN = 'menukeydown';
// var PG_EVENTTYPE_ONORIENTATIONCHANGE = 'orientationchange';
/*
@start class

@description
[en]This class has methods for managing events.[/en]
[de]Diese Klasse verfügt über Methoden zum Verwalten von Events.[/de]

@param extends classPG_ClassBasics

@var EventManagerEventTypes
PG_EVENTTYPE_ONABORT
PG_EVENTTYPE_ONBLUR
PG_EVENTTYPE_ONCHANGE
PG_EVENTTYPE_ONERROR
PG_EVENTTYPE_ONFOCUS
PG_EVENTTYPE_ONKEYDOWN
PG_EVENTTYPE_ONKEYPRESS
PG_EVENTTYPE_ONKEYUP
PG_EVENTTYPE_ONLOAD
PG_EVENTTYPE_ONRESIZE
PG_EVENTTYPE_ONRESET
PG_EVENTTYPE_ONSELECT
PG_EVENTTYPE_ONSUBMIT
PG_EVENTTYPE_ONUNLOAD
PG_EVENTTYPE_ONCONTEXTMENU

Desktop...
PG_EVENTTYPE_ONCLICK
PG_EVENTTYPE_ONDOUBLECLICK
PG_EVENTTYPE_ONMOUSEDOWN
PG_EVENTTYPE_ONMOUSEMOVE
PG_EVENTTYPE_ONMOUSEOUT
PG_EVENTTYPE_ONMOUSEOVER
PG_EVENTTYPE_ONMOUSEUP
PG_EVENTTYPE_ONMOUSEWHEEL
PG_EVENTTYPE_ONDOMMOUSEWHEEL

Platform independent...
PG_EVENTTYPE_ONPRESS
PG_EVENTTYPE_ONRELEASE
PG_EVENTTYPE_ONMOVE

Mobile...
PG_EVENTTYPE_ONTOUCHSTART
PG_EVENTTYPE_ONTOUCHMOVE
PG_EVENTTYPE_ONTOUCHEND
PG_EVENTTYPE_ONTOUCHCANCEL

PG_EVENTTYPE_ONMSPOINTERDOWN
PG_EVENTTYPE_ONMSPOINTERUP
PG_EVENTTYPE_ONMSPOINTERMOVE

PG_EVENTTYPE_ONMENUKEYDOWN
*/
function classPG_EventManager()
{
	// Declarations...
	
	// Construct...
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Tests EventTypes for compatibility with different browsers and returns the correct EventType.[/en]
	[de]Prüft EventTypes auf Kompatibilität zu verschiedenen Browsern und gibt den richtigen EventType zurück.[/de]
	
	@return sEventType [type]string[/type]
	[en]Returns the appropriate event type.[/en]
	[de]Gibt den passenden EventType zurück.[/de]
	
	@param sEventType [needed][type]string[/type]
	[en]The EventType which should be tested.[/en]
	[de]Der EventType der geprüft werden soll.[/de]
	*/
	this.checkFeatures = function(_sEventType)
	{
		if (typeof(_sEventType) == 'undefined') {var _sEventType = null;}
		_sEventType = this.getRealParameter({'oParameters': _sEventType, 'sName': 'sEventType', 'xParameter': _sEventType});

		if (_sEventType == PG_EVENTTYPE_ONBLUR) {if (typeof(window.onblurout) != 'undefined') {_sEventType = 'blurout';}}
		if (_sEventType == PG_EVENTTYPE_ONFOCUS) {if (typeof(window.onfocusin) != 'undefined') {_sEventType = 'focusin';}}
		if (_sEventType == PG_EVENTTYPE_ONMOUSEWHEEL) {if (typeof(window.onmousewheel) == 'undefined') {_sEventType = PG_EVENTTYPE_ONDOMMOUSEWHEEL;}}
		/*
		if (_sEventType == PG_EVENTTYPE_ONORIENTATIONCHANGE)
		{
			if (typeof(window.ondeviceorientation) != 'undefined') {_sEventType = 'deviceorientation';}
			else if (typeof(window.onMozOrientation) != 'undefined') {_sEventType = 'MozOrientation';}
		}
		*/
		if (oPGBrowser.isMobile())
		{
			if (window.navigator.msPointerEnabled)
			{
				if (_sEventType == PG_EVENTTYPE_ONPRESS) {_sEventType = PG_EVENTTYPE_ONMSPOINTERDOWN;}
				if (_sEventType == PG_EVENTTYPE_ONRELEASE) {_sEventType = PG_EVENTTYPE_ONMSPOINTERUP;}
				if (_sEventType == PG_EVENTTYPE_ONMOVE) {_sEventType = PG_EVENTTYPE_ONMSPOINTERMOVE;}
			}
			if (_sEventType == PG_EVENTTYPE_ONPRESS) {_sEventType = PG_EVENTTYPE_ONTOUCHSTART;}
			if (_sEventType == PG_EVENTTYPE_ONRELEASE) {_sEventType = PG_EVENTTYPE_ONTOUCHEND;}
			if (_sEventType == PG_EVENTTYPE_ONMOVE) {_sEventType = PG_EVENTTYPE_ONTOUCHMOVE;}
		}
		else
		{
			if (_sEventType == PG_EVENTTYPE_ONPRESS) {_sEventType = PG_EVENTTYPE_ONMOUSEDOWN;}
			if (_sEventType == PG_EVENTTYPE_ONRELEASE) {_sEventType = PG_EVENTTYPE_ONMOUSEUP;}
			if (_sEventType == PG_EVENTTYPE_ONMOVE) {_sEventType = PG_EVENTTYPE_ONMOUSEMOVE;}
		}
		return _sEventType;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Adds an Event to an object or element.[/en]
	[de]Fügt ein Event einem Objekt oder Element hinzu.[/de]
	
	@param oObject [needed][type]object[/type]
	[en]The object or element whose event should be set.[/en]
	[de]Das Objekt bzw. Element dessen Event gesetzt werden soll.[/de]
	
	@param sEventType [needed][type]string[/type]
	[en]
		The type of event:
		%EventManagerEventTypes%
	[/en]
	[de]
		Der Typ des Events:
		%EventManagerEventTypes%
	[/de]
	
	@param fFunction [needed][type]function[/type]
	[en]The function to be executed when the event happens.[/en]
	[de]Die Funktion, die ausgeführt werden soll, sobald das Event passiert.[/de]
	
	@param bUseCapture [type]bool[/type]
	[en]Specifies whether to use capture. In most cases it is not required.[/en]
	[de]Gibt an ob Capture verwendet werden soll. In den meisten Fällen wird es nicht benötigt.[/de]
	*/
	this.addEvent = function(_oObject, _sEventType, _fFunction, _bUseCapture)
	{
		if (typeof(_sEventType) == 'undefined') {var _sEventType = null;}
		if (typeof(_fFunction) == 'undefined') {var _fFunction = null;}
		if (typeof(_bUseCapture) == 'undefined') {var _bUseCapture = null;}
		
		_fFunction = this.getRealParameter({'oParameters': _oObject, 'sName': 'fFunction', 'xParameter': _fFunction});
		_bUseCapture = this.getRealParameter({'oParameters': _oObject, 'sName': 'bUseCapture', 'xParameter': _bUseCapture});
		_sEventType = this.getRealParameter({'oParameters': _oObject, 'sName': 'sEventType', 'xParameter': _sEventType});
		_oObject = this.getRealParameter({'oParameters': _oObject, 'sName': 'oObject', 'xParameter': _oObject, 'bNotNull': true});

		if (_bUseCapture == null) {_bUseCapture = false;}
		
		_sEventType = this.checkFeatures({'sEventType': _sEventType});
		if (_oObject.attachEvent)
		{
			_oObject['e'+_sEventType+_fFunction] = _fFunction;
			_oObject[_sEventType+_fFunction] = function() {_oObject['e'+_sEventType+_fFunction](window.event);} // don't rewrite window.event!
			_oObject.attachEvent('on'+_sEventType, _oObject[_sEventType+_fFunction]);
		}
		else {_oObject.addEventListener(_sEventType, _fFunction, _bUseCapture);}
		
		if (_sEventType == PG_EVENTTYPE_ONUNLOAD) {this.addEvent({'oObject': _oObject, 'sEventType': 'beforeunload', 'fFunction': _fFunction, 'bUseCapture': _bUseCapture});}
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Removes events from an object or element.[/en]
	[de]Entfernt Events von einem Objekt oder Element.[/de]
	
	@param oObject [needed][type]object[/type]
	[en]The object or element whose event should be removed.[/en]
	[de]Das Objekt bzw. Element dessen Event entfernt werden soll.[/de]
	
	@param sEventType [needed][type]string[/type]
	[en]
		The type of event:
		%EventManagerEventTypes%
	[/en]
	[de]
		Der Typ des Events:
		%EventManagerEventTypes%
	[/de]
	
	@param fFunction [needed][type]function[/type]
	[en]The function to be not anymore executed when the event happens.[/en]
	[de]Die Funktion, die nicht mehr ausgeführt werden soll, sobald das Event passiert.[/de]
	
	@param bUseCapture [type]bool[/type]
	[en]Specifies whether to use capture. In most cases it is not required.[/en]
	[de]Gibt an ob Capture verwendet werden soll. In den meisten Fällen wird es nicht benötigt.[/de]
	*/
	this.removeEvent = function(_oObject, _sEventType, _fFunction, _bUseCapture)
	{
		if (typeof(_sEventType) == 'undefined') {var _sEventType = null;}
		if (typeof(_fFunction) == 'undefined') {var _fFunction = null;}
		if (typeof(_bUseCapture) == 'undefined') {var _bUseCapture = null;}
		
		_fFunction = this.getRealParameter({'oParameters': _oObject, 'sName': 'fFunction', 'xParameter': _fFunction});
		_bUseCapture = this.getRealParameter({'oParameters': _oObject, 'sName': 'bUseCapture', 'xParameter': _bUseCapture});
		_sEventType = this.getRealParameter({'oParameters': _oObject, 'sName': 'sEventType', 'xParameter': _sEventType});
		_oObject = this.getRealParameter({'oParameters': _oObject, 'sName': 'oObject', 'xParameter': _oObject, 'bNotNull': true});

		if (_bUseCapture == null) {_bUseCapture = false;}
		
		_sEventType = this.checkFeatures({'sEventType': _sEventType});
		if (_oObject.detachEvent)
		{
			_oObject.detachEvent('on'+_sEventType, _oObject[_sEventType+_fFunction]);
			_oObject[_sEventType+_fFunction] = null;
		}
		else {_oObject.removeEventListener(_sEventType, _fFunction, _bUseCapture);}
		
		if (_sEventType == PG_EVENTTYPE_ONUNLOAD) {this.removeEvent({'oObject': _oObject, 'sEventType': 'beforeunload', 'fFunction': _fFunction, 'bUseCapture': _bUseCapture});}
	}
	/* @end method */
}
/* @end class */
classPG_EventManager.prototype = new classPG_ClassBasics();
var oPGEventManager = new classPG_EventManager();
