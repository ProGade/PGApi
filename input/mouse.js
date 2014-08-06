/*
* ProGade API
* Copyright 2014, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 05 2014
*/
// if (window.document.captureEvents) {window.document.captureEvents(Event.MOUSEMOVE);} // Old! now use _bUseCapture from oPGEventManager.addEvent()

var PG_MOUSE_BUTTON_NONE = 0;
var PG_MOUSE_BUTTON_LEFT = 1;
var PG_MOUSE_BUTTON_MIDDLE = 2;
var PG_MOUSE_BUTTON_RIGHT = 3;

/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_Mouse()
{
	// Declarations...
	this.iMouseViewPosX = 0;
	this.iMouseViewPosY = 0;
	this.iMouseDocPosX = 0;
	this.iMouseDocPosY = 0;
	this.iMouseScrollZ = 0;
	this.iMouseScrollLastZ = 0;
	this.iMouseScrollMaxValue = null;
	this.iMouseScrollMinValue = null;
	this.bMouseScrollLoop = false;
	this.bMouseLeftDown = false;
	this.bMouseRightDown = false;
	this.bMouseDownPreventDefault = false;
	this.bMouseScrollEnabled = true;
	this.bMouseScrollPreventDefault = false;
	this.oMouseOverElement = null;

	// Construct...
	
	// Methods...
	/*
	@start method
	
	@param eEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onContextMenu = function(_eEvent)
	{
		if (this.bMouseDownPreventDefault == true)
		{
			this.preventDefaultMouseDown(_eEvent);
			return false;
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param eEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onMouseMove = function(_eEvent)
	{
		if (!_eEvent) {_eEvent = this.oWindow.event;}
		this.refreshMousePos(_eEvent);
		this.oMouseOverElement = arguments[0].target || _eEvent.srcElement;
	}
	/* @end method */
	
	/*
	@start method
	
	@return oMouseOverElement [type]object[/type]
	[en]...[/en]
	*/
	this.getMouseOverElement = function() {return this.oMouseOverElement;}
	/* @end method */
	
	/*
	@start method
	
	@param eEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onMouseDown = function(_eEvent)
	{
		/*this.bMouseRightDown = false;
		if (!_eEvent) {_eEvent = window.event;}
		if (_eEvent.button) {if (_eEvent.button == 2) {this.bMouseRightDown = true;}}
  		if (_eEvent.type) {if (_eEvent.type == "contextmenu") {this.bMouseRightDown = true;}}
		else if (_eEvent.which) {if (_eEvent.which == 3) {this.bMouseRightDown = true;}}
		if (this.bMouseRightDown == false)*/
		if (this.getMouseButtonFromEvent(_eEvent) == PG_MOUSE_BUTTON_LEFT) {this.bMouseLeftDown = true;}
		else {this.bMouseRightDown = true;}
		
		if (this.bMouseDownPreventDefault == true) {return this.preventDefaultMouseDown(_eEvent);}
	}
	/* @end method */
	
	/*
	@start method
	
	@param eEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onMouseUp = function(_eEvent)
	{
		this.bMouseLeftDown = false;
		this.bMouseRightDown = false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bPreventedDefault [type]bool[/type]
	[en]...[/en]
	
	@param eEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onMouseScrollWheel = function(_eEvent) {return this.refreshMouseScrolling(_eEvent);}
	/* @end method */
	
	/*
	@start method
	
	@return iMouseButton [type]int[/type]
	[en]...[/en]
	
	@param eEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.getMouseButtonFromEvent = function(_eEvent)
	{
		if (!_eEvent) {_eEvent = this.oWindow.event;}
		if (_eEvent.button)
		{
			if (_eEvent.button == 4) {return PG_MOUSE_BUTTON_MIDDLE;}
			if (_eEvent.button == 3) {return PG_MOUSE_BUTTON_RIGHT;}
			if (_eEvent.button == 2) {return PG_MOUSE_BUTTON_RIGHT;}
		}
  		if (_eEvent.type)
		{
			if (_eEvent.type == "contextmenu") {return PG_MOUSE_BUTTON_RIGHT;}
		}
		if (_eEvent.which)
		{
			if (_eEvent.wicht == 2) {return PG_MOUSE_BUTTON_MIDDLE;}
			if (_eEvent.which == 3) {return PG_MOUSE_BUTTON_RIGHT;}
		}
		return PG_MOUSE_BUTTON_LEFT;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bMouseLeftDown [type]bool[/type]
	[en]...[/en]
	*/
	this.isMouseLeftDown = function() {return this.bMouseLeftDown;}
	/* @end method */

	/*
	@start method
	
	@return bMouseRightDown [type]bool[/type]
	[en]...[/en]
	*/
	this.isMouseRightDown = function() {return this.bMouseRightDown;}
	/* @end method */
	
	/*
	@start method
	
	@return bIsDefault [type]bool[/type]
	[en]...[/en]
	*/
	this.isDefaultMouseDown = function() {return (!this.bMouseDownPreventDefault);}
	/* @end method */

	/* @start method */
	this.enableDefaultMouseDown = function() {this.bMouseDownPreventDefault = false;}
	/* @end method */

	/* @start method */
	this.disableDefaultMouseDown = function() {this.bMouseDownPreventDefault = true;}
	/* @end method */

	/* @start method */
	this.toggleDefaultMouseDown = function() {this.bMouseDownPreventDefault = (!this.bMouseDownPreventDefault);}
	/* @end method */
	
	/*
	@start method
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	this.useDefaultMouseDown = function(_bUse)
	{
		_bUse = this.getRealParameter({'oParameters': _bUse, 'sName': 'bUse', 'xParameter': _bUse});
		this.bMouseDownPreventDefault = _bUse;
	}
	/* @end method */

	/*
	@start method
	
	@return bPrevented [type]bool[/type]
	[en]...[/en]
	
	@param eEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.preventDefaultMouseDown = function(_eEvent)
	{
		if (this.bMouseDownPreventDefault == true)
		{
			if (!_eEvent) {_eEvent = this.oWindow.event;}
			if (typeof(_eEvent) != 'undefined')
			{
				if (_eEvent.preventDefault)
				{
					_eEvent.preventDefault();
					_eEvent.stopPropagation();
				}
				else
				{
					_eEvent.returnValue = false;
					_eEvent.cancelBubble = true;
				}
			}
			return false;
		}
		return true;
	}
	/* @end method */

	/*
	@start method
	
	@return iMouseDocPosX [type]int[/type]
	[en]...[/en]
	*/
	this.getPosX = function() {return this.getDocPosX();}
	/* @end method */

	/*
	@start method
	
	@return iMouseDocPosX [type]int[/type]
	[en]...[/en]
	*/
	this.getDocPosX = function() {return this.iMouseDocPosX;}
	/* @end method */

	/*
	@start method
	
	@return iMouseDocPosY [type]int[/type]
	[en]...[/en]
	*/
	this.getPosY = function() {return this.getDocPosY();}
	/* @end method */

	/*
	@start method
	
	@return iMouseDocPosY [type]int[/type]
	[en]...[/en]
	*/
	this.getDocPosY = function() {return this.iMouseDocPosY;}
	/* @end method */

	/*
	@start method
	
	@return iMouseViewPosX [type]int[/type]
	[en]...[/en]
	*/
	this.getViewPosX = function() {return this.iMouseViewPosX;}
	/* @end method */

	/*
	@start method
	
	@return iMouseViewPosY [type]int[/type]
	[en]...[/en]
	*/
	this.getViewPosY = function() {return this.iMouseViewPosY;}
	/* @end method */
	
	/*
	@start method
	
	@param eEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.refreshMousePos = function(_eEvent)
	{
		var _iNewPosX = 0;
		var _iNewPosY = 0;
		var _aDocPos = oPGBrowser.getScrollPos();
		
		if (_eEvent)
		{
			if (_eEvent.clientX)
			{
				_iNewPosX = _eEvent.clientX;
				_iNewPosY = _eEvent.clientY;
			}
			else if (_eEvent.pageX)
			{
				_iNewPosX = _eEvent.pageX;
				_iNewPosY = _eEvent.pageY;
			}
			else if (this.oWindow.event)
			{
				_iNewPosX = this.oWindow.event.clientX;
				_iNewPosY = this.oWindow.event.clientY;
			}
		}
		else
		{
			_iNewPosX = this.oWindow.event.clientX;
			_iNewPosY = this.oWindow.event.clientY;
		}
	
		this.iMouseViewPosX = _iNewPosX;
		this.iMouseViewPosY = _iNewPosY;
		
		this.iMouseDocPosX = _iNewPosX + _aDocPos.x;
		this.iMouseDocPosY = _iNewPosY + _aDocPos.y;
	}
	/* @end method */

	/*
	@start method
	
	@param iValue [needed][type]int[/type]
	[en]...[/en]
	*/
	this.setScrollingMaxValue = function(_iValue)
	{
		_iValue = this.getRealParameter({'oParameters': _iValue, 'sName': 'iValue', 'xParameter': _iValue});
		this.iMouseScrollMaxValue = _iValue;
	}
	/* @end method */
	
	/*
	@start method
	
	@param iValue [needed][type]int[/type]
	[en]...[/en]
	*/
	this.setScrollingMinValue = function(_iValue)
	{
		_iValue = this.getRealParameter({'oParameters': _iValue, 'sName': 'iValue', 'xParameter': _iValue});
		this.iMouseScrollMinValue = _iValue;
	}
	/* @end method */
	
	/* @start method */
	this.unsetScrollingMaxValue = function() {this.iMouseScrollMaxValue = null;}
	/* @end method */

	/* @start method */
	this.unsetScrollingMinValue = function() {this.iMouseScrollMinValue = null;}
	/* @end method */
	
	/*
	@start method
	
	@param bLoop [needed][type]bool[/type]
	[en]...[/en]
	*/
	this.setScrollingValueLoop = function(_bLoop)
	{
		_bLoop = this.getRealParameter({'oParameters': _bLoop, 'sName': 'bLoop', 'xParameter': _bLoop});
		this.bMouseScrollLoop = _bLoop;
	}
	/* @end method */
	
	/* @start method */
	this.enableScrolling = function() {this.bMouseScrollEnabled = true;}
	/* @end method */

	/* @start method */
	this.disableScrolling = function() {this.bMouseScrollEnabled = false;}
	/* @end method */

	/* @start method */
	this.toggleScrolling = function() {this.bMouseScrollEnabled = (!this.bMouseScrollEnabled);}
	/* @end method */
	
	/*
	@start method
	
	@return bIsDefault [type]bool[/type]
	[en]...[/en]
	*/
	this.isDefaultPageScrolling = function() {return (!this.bMouseScrollPreventDefault);}
	/* @end method */

	/* @start method */
	this.enablePageScrolling = function() {this.bMouseScrollPreventDefault = false;}
	/* @end method */

	/* @start method */
	this.disablePageScrolling = function() {this.bMouseScrollPreventDefault = true;}
	/* @end method */

	/* @start method */
	this.togglePageScrolling = function() {this.bMouseScrollPreventDefault = (!this.bMouseScrollPreventDefault);}
	/* @end method */
	
	/*
	@start method
	
	@return iMouseScrollZ [type]int[/type]
	[en]...[/en]
	*/
	this.getPosZ = function() {return this.getScrollZ();}
	/* @end method */

	/*
	@start method
	
	@return iMouseScrollZ [type]int[/type]
	[en]...[/en]
	*/
	this.getScrollZ = function() {return this.iMouseScrollZ;}
	/* @end method */

	/*
	@start method
	
	@return iMouseScrollLastZ [type]int[/type]
	[en]...[/en]
	*/
	this.getLastScrollZ = function() {return this.iMouseScrollLastZ;}
	/* @end method */

	/*
	@start method
	
	@return bPreventedDefault [type]bool[/type]
	[en]...[/en]
	
	@param eEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.refreshMouseScrolling = function(_eEvent)
	{
		if (!_eEvent) {_eEvent = this.oWindow.event;} // For IE.

		if (this.bMouseScrollEnabled == true)
		{
			if (_eEvent.wheelDelta) // IE/Opera.
			{
				this.iMouseScrollLastZ = _eEvent.wheelDelta/120;
				if ((this.iMouseScrollMaxValue != null) && (this.bMouseScrollLoop == false))
				{
					this.iMouseScrollZ = Math.min(this.iMouseScrollZ+this.iMouseScrollLastZ, this.iMouseScrollMaxValue);
				}
				else
				{
					this.iMouseScrollZ += this.iMouseScrollLastZ;
					if ((this.iMouseScrollMaxValue !== null) && (this.iMouseScrollMinValue !== null))
					{
						if (this.bMouseScrollLoop == true)
						{
							if (this.iMouseScrollZ > this.iMouseScrollMaxValue) {this.iMouseScrollZ = this.iMouseScrollMinValue;}
							else if (this.iMouseScrollZ < this.iMouseScrollMinValue) {this.iMouseScrollZ = this.iMouseScrollMaxValue;}
						}
					}
				}
			}
			else if (_eEvent.detail) // Mozilla case.
			{
				this.iMouseScrollLastZ = -_eEvent.detail/3;
				if ((this.iMouseScrollMinValue != null) && (this.bMouseScrollLoop == false))
				{
					this.iMouseScrollZ = Math.max(this.iMouseScrollZ+this.iMouseScrollLastZ, this.iMouseScrollMinValue);
				}
				else
				{
					this.iMouseScrollZ += this.iMouseScrollLastZ;
					if ((this.iMouseScrollMaxValue !== null) && (this.iMouseScrollMinValue !== null))
					{
						if (this.bMouseScrollLoop == true)
						{
							if (this.iMouseScrollZ > this.iMouseScrollMaxValue) {this.iMouseScrollZ = this.iMouseScrollMinValue;}
							else if (this.iMouseScrollZ < this.iMouseScrollMinValue) {this.iMouseScrollZ = this.iMouseScrollMaxValue;}
						}
					}
				}
			}
		}

		if (this.bMouseScrollPreventDefault == true)
		{
			if (_eEvent.preventDefault) {_eEvent.preventDefault();}
			_eEvent.returnValue = false;
			return false;
		}
		return true;
	}
	/* @end method */
}
/* @end class */
classPG_Mouse.prototype = new classPG_ClassBasics();
var oPGMouse = new classPG_Mouse();
