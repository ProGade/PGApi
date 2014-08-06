/*
* ProGade API
* Copyright 2014, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 05 2014
*/

var PG_TOUCH_MSPOINTER_TYPE_TOUCH = 0;
if (typeof(MSPOINTER_TYPE_TOUCH) != 'undefined') {PG_TOUCH_MSPOINTER_TYPE_TOUCH = MSPOINTER_TYPE_TOUCH;}

var PG_TOUCH_MSPOINTER_TYPE_PEN = 0;
if (typeof(MSPOINTER_TYPE_PEN) != 'undefined') {PG_TOUCH_MSPOINTER_TYPE_PEN = MSPOINTER_TYPE_PEN;}

var PG_TOUCH_MSPOINTER_TYPE_MOUSE = 0;
if (typeof(MSPOINTER_TYPE_MOUSE) != 'undefined') {PG_TOUCH_MSPOINTER_TYPE_MOUSE = MSPOINTER_TYPE_MOUSE;}

/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_TouchHandler()
{
	// Declarations...
	this.oTouches = null;
	this.sTouchType = '';
	this.oTouchElement = null;
	this.iTouchCount = 0;
	this.iTouchPosX = 0;
	this.iTouchPosY = 0;
	this.bTouchDownPreventDefault = false;
	this.bRegisterElementForDragAndDrop = true;
	// this.bRegisterElementForScrollDiv = true;
	
	this.iPointerType = 0;
	
	this.fOnMouseDownMemory = null;
	// this.fOnMouseMoveMemory = null;
	
	// Construct...
	
	// Methods...
	/*
	@start method
	
	@return iTouchPosX [type]int[/type]
	[en]...[/en]
	*/
	this.getViewPosX = function() {return this.iTouchPosX;}
	/* @end method */

	/*
	@start method
	
	@return iTouchPosY [type]int[/type]
	[en]...[/en]
	*/
	this.getViewPosY = function() {return this.iTouchPosY;}
	/* @end method */

	/*
	@start method
	
	@return iTouchPosX [type]int[/type]
	*/
	this.getDocPosX = function() {return this.iTouchPosX;}
	/* @end method */

	/*
	@start method
	
	@return iTouchPosY [type]int[/type]
	[en]...[/en]
	*/
	this.getDocPosY = function() {return this.iTouchPosY;}
	/* @end method */

	this.getPosX = this.getDocPosX;
	this.getPosY = this.getDocPosY;
	
	/*
	@start method
	
	@return bPrevented [type]bool[/type]
	[en]...[/en]
	
	@param oEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.preventDefaultTouchDown = function(_oEvent)
	{
		if (this.bTouchDownPreventDefault == true)
		{
			if (!_oEvent) {_oEvent = event;}
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
		return true;
	}
	/* @end method */
	
	/*
	@start method
	
	@param oEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onTouchMove = function(_oEvent)
	{
		if (!_oEvent) {_oEvent = event;}
		if (_oEvent.touches)
		{
			var _iTouchCount = _oEvent.touches.length;
			if (_iTouchCount == 1)
			{
				this.iTouchPosX = parseInt(_oEvent.pageX || _oEvent.changedTouches[0].pageX);
				this.iTouchPosY = parseInt(_oEvent.pageY || _oEvent.changedTouches[0].pageY);
				// if (this.fOnMouseMoveMemory != null) {this.fOnMouseMoveMemory();}
				oPGInput.preventDefaultPress(_oEvent);
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param oEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onTouchStart = function(_oEvent)
	{
		if (!_oEvent) {_oEvent = event;}
		var _bPreventDefault = false;
		if (_oEvent.touches)
		{
			var _iTouchCount = _oEvent.touches.length;
			if (_iTouchCount == 1)
			{
				this.iTouchPosX = parseInt(_oEvent.pageX || _oEvent.changedTouches[0].pageX);
				this.iTouchPosY = parseInt(_oEvent.pageY || _oEvent.changedTouches[0].pageY);
				this.oTouchElement = _oEvent.changedTouches[0].target;
				if (this.oTouchElement)
				{
					if (_oEvent.touches[0].target != '[object HTMLHtmlElement]')
					{
						if ((this.bRegisterElementForDragAndDrop == true) && (typeof(oPGDragAndDrop) != 'undefined'))
						{
							var _sDragAndDropElementID = oPGDragAndDrop.getNextDropElementIDBySubElement(this.oTouchElement);
							if (_sDragAndDropElementID)
							{
								// oPGDragAndDrop.crabDropElement(_sDragAndDropElementID);
								oPGDragAndDrop.onDropElementPress(_oEvent, _sDragAndDropElementID);
								// _bPreventDefault = true;
							}
						}
						
						if (this.oTouchElement.onmousedown)
						{
							this.fOnMouseDownMemory = this.oTouchElement.onmousedown;
							this.oTouchElement.removeAttribute('onmousedown');
							this.fOnMouseDownMemory();
						}
						
						/*
						if (this.oTouchElement.onmousemove)
						{
							this.fOnMouseMoveMemory = this.oTouchElement.onmousemove;
							this.oTouchElement.removeAttribute('onmousemove');
						}
						*/
						
						/*if ((this.bRegisterElementForScrollDiv == true) && (typeof(oPGScrollDiv) != 'undefined'))
						{
							oPGScrollDiv.
						}*/
					}
				}
			}
		}
		if (_bPreventDefault == true) {oPGInput.preventDefaultPress(_oEvent);}
	}
	/* @end method */
	
	/*
	@start method
	
	@param oEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onTouchEnd = function(_oEvent)
	{
		if (!_oEvent) {_oEvent = event;}
		// if (this.fOnMouseMoveMemory != null) {this.oTouchElement.onmousemove = this.fOnMouseMoveMemory; this.fOnMouseMoveMemory = null;}
		if (this.fOnMouseDownMemory != null) {this.oTouchElement.onmousedown = this.fOnMouseDownMemory; this.fOnMouseDownMemory = null;}
		// if (this.oTouchElement.onmouseup) {this.oTouchElement.onmouseup();}
		this.oTouchElement = null;
		// _oEvent.preventDefault();
	}
	/* @end method */
	
	/*
	@start method
	
	@param oEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onTouchToMouse = function(_oEvent)
	{
		if (!_oEvent == null) {_oEvent = event;}
		
		// this.onTouch(_oEvent);
		this.oTouches = _oEvent.changedTouches;
		this.oTouchElement = _oEvent.changedTouches[0].target;
		var _sEventType = '';
		
		if (_oEvent)
		{
			if (typeof(_oEvent.touches) != 'undefined')
			{
				if (_oEvent.touches.length == 2)
				{
					if ((_oEvent.type != 'touchstart') && (_oEvent.type != 'MSPointerDown')) {return;}
					_sEventType = 'dblclick';
				}
			}
			else
			{
				switch(_oEvent.type)
				{
					case 'touchstart':
					case 'MSPointerDown':
						_sEventType = 'mousedown';
					break;
					
					case 'touchmove':
					case 'MSPointerMove':
						_sEventType = 'mousemove';
					break;
					
					case 'touchend':
					case 'MSPointerUp':
						_sEventType = 'mouseup';
					break;
					
					default: return;
				}
			}
			
			_oEvent.preventDefault();
			var _oMouseEvent = this.oDocument.createElement('MouseEvent');
			if (_oMouseEvent) {_oMouseEvent.initMouseEvent(_sEventType, true, true, window, 1, 
														   this.oTouches[0].screenX, this.oTouches[0].screenY, 
														   this.oTouches[0].clientX, this.oTouches[0].clientY, 
														   false, false, false, false, 0, null);}
			
			if (_oEvent.changedTouches[0].target)
			{
				var _oNode = _oEvent.changedTouches[0].target;
				if (_oNode) {_oNode.dispatchEvent(_oMouseEvent);}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param oEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onTouch = function(_oEvent)
	{
		if (!_oEvent == null) {_oEvent = event;}
		this.oTouches = _oEvent.changedTouches;
		this.oTouchElement = null;
		if (_oEvent.changedTouches.length > 0)
		{
			if (_oEvent.changedTouches[0].target) {this.oTouchElement = _oEvent.changedTouches[0].target;}
		}
		this.sTouchType = _oEvent.type;
		this.iTouchCount = _oEvent.touches.length;
		if (window.navigator.msPointerEnabled)
		{
			this.iPointerType = _oEvent.pointerType;
		}
	}
	/* @end method */
}
/* @end class */
classPG_TouchHandler.prototype = new classPG_ClassBasics();
var oPGTouchHandler = new classPG_TouchHandler();
