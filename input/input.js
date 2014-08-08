/*
* ProGade API
* Copyright 2014, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 06 2014
*/
/*
@start class

@description
[en]This class has methods to retrieve mouse and touch actions and use them.[/en]
[de]Diese Klasse hat Methoden um Maus und Touch Aktionen abzufragen und zu verwenden.[/de]

@param extends classPG_ClassBasics
*/
function classPG_Input()
{
	// Declarations...
	
	// Construct...
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Listens to touch start and mouse down events.[/en]
	[de]Lauscht auf Touch start und Mouse down Events.[/de]
	
	@param oEvent [needed][type]object[/type]
	[en]The event object of the browser.[/en]
	[de]Das Event-Objekt des Browsers.[/de]
	*/
	this.onPress = function(_oEvent)
	{
		if (!_oEvent) {_oEvent = event;}
		if (oPGBrowser.isMobile()) {return oPGTouchHandler.onTouchStart(_oEvent);}
		return oPGMouse.onMouseDown(_oEvent);
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Listens to touch end and mouse up events.[/en]
	[de]Lauscht auf Touch end und Mouse up Events.[/de]
	
	@param oEvent [needed][type]object[/type]
	[en]The event object of the browser.[/en]
	[de]Das Event-Objekt des Browsers.[/de]
	*/
	this.onRelease = function(_oEvent)
	{
		if (!_oEvent) {_oEvent = event;}
		if (oPGBrowser.isMobile()) {return oPGTouchHandler.onTouchEnd(_oEvent);}
		return oPGMouse.onMouseUp(_oEvent);
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Listens to touch move and mouse move events.[/en]
	[de]Lauscht auf Touch move und Mouse move Events.[/de]
	
	@param oEvent [needed][type]object[/type]
	[en]The event object of the browser.[/en]
	[de]Das Event-Objekt des Browsers.[/de]
	*/
	this.onMove = function(_oEvent)
	{
		if (!_oEvent) {_oEvent = event;}
		if (oPGBrowser.isMobile()) {return oPGTouchHandler.onTouchMove(_oEvent);}
		return oPGMouse.onMouseMove(_oEvent);
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the current horizontal mouse or touch position.[/en]
	[de]Gibt die aktuelle, horizontale Mouse oder Touch Position zurück.[/de]
	
	@return iDocPosX [type]int[/type]
	[en]Returns the current horizontal mouse or touch position as an integer.[/en]
	[de]Gibt die aktuelle, horizontale Mouse oder Touch Position als Integer zurück.[/de]
	*/
	this.getDocPosX = function()
	{
		if (oPGBrowser.isMobile()) {return oPGTouchHandler.getDocPosX();}
		return oPGMouse.getDocPosX();
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the current vertical mouse or touch position.[/en]
	[de]Gibt die aktuelle, vertikale Mouse oder Touch Position zurück.[/de]
	
	@return iDocPosY [type]int[/type]
	[en]Returns the current vertical mouse or touch position as an integer.[/en]
	[de]Gibt die aktuelle, vertikale Mouse oder Touch Position als Integer zurück.[/de]
	*/
	this.getDocPosY = function()
	{
		if (oPGBrowser.isMobile()) {return oPGTouchHandler.getDocPosY();}
		return oPGMouse.getDocPosY();
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Suppresses the default mouse buttons or touch function.[/en]
	[de]Unterdrückt die Standard Maustasten oder Touch Funktion.[/de]
	
	@param oEvent [needed][type]object[/type]
	[en]The event object of the browser.[/en]
	[de]Das Event-Objekt des Browsers.[/de]
	*/
	this.preventDefaultPress = function(_oEvent)
	{
		if (oPGBrowser.isMobile()) {return oPGTouchHandler.preventDefaultTouchDown(_oEvent);}
		return oPGMouse.preventDefaultMouseDown(_oEvent);
	}
	/* @end method */
}
/* @end class */
classPG_Input.prototype = new classPG_ClassBasics();
var oPGInput = new classPG_Input();
