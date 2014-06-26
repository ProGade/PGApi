/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 21 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_Css()
{
	// Declarations...
	
	// Construct...
	
	// Methods...
	/*
	@start method
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	this.formatProperty = function(_sString)
	{
		if (typeof(_sString) == 'undefined') {var _sString = null;}
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		
		for(var exp=/-([a-z])/; exp.test(_sString); _sString=_sString.replace(exp, RegExp.$1.toUpperCase()));
		return _sString;
	}
	/* @end method */
	
	/*
	@start method
	
	@return oElement [type]object[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getElementObject = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		if (typeof(_xElement) == 'object') {return _xElement;}
		else if (typeof(_xElement) == 'string') {return this.oDocument.getElementById(_xElement);}
		return null;
	}
	/* @end method */
	
	/*
	@start method
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xStyle [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.addStyle = function(_xElement, _xStyle)
	{
		if (typeof(_xStyle) == 'undefined') {var _xStyle = null;}
		_xStyle = this.getRealParameter({'oParameters': _xElement, 'sName': 'xStyle', 'xParameter': _xStyle});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});

		var _oElement = this.getElementObject({'xElement': _xElement});
		if (_oElement)
		{
			if (_xStyle.charAt(_xStyle.length-1)==';') {_xStyle = _xStyle.slice(0, -1);}
		
			var _sProperty, _sValue;
			var _asSplitted = _xStyle.split(';');
		
			for (var i=0; i<_asSplitted.length; i++)
			{
				_sProperty = this.formatProperty({'sString': _asSplitted[i].split(':')[0]});
				_sValue = _asSplitted[i].split(':')[1];
				eval("_oElement.style."+_sProperty+"='"+_sValue+"';");
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xStyle [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.setStyle = function(_xElement, _xStyle)
	{
		if (typeof(_xStyle) == 'undefined') {var _xStyle = null;}
		_xStyle = this.getRealParameter({'oParameters': _xElement, 'sName': 'xStyle', 'xParameter': _xStyle});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});

		var _oElement = this.getElementObject({'xElement': _xElement});
		if (_oElement)
		{
			if (typeof(_oElement.style.cssText) != 'undefined') {_oElement.style.cssText = _xStyle;}
			else
			{
				if (typeof(_xStyle) == 'string')
				{
					if (_xStyle.charAt(_xStyle.length-1)==';') {_xStyle = _xStyle.slice(0, -1);}
				
					var _sProperty, _sValue;
					var _asSplitted = _xStyle.split(';');
				
					for (var i=0; i<_asSplitted.length; i++)
					{
						_sProperty = this.formatProperty({'sString': _asSplitted[i].split(':')[0]});
						_sValue = _asSplitted[i].split(':')[1];
						eval("_oElement.style."+_sProperty+"='"+_sValue+"';");
					}
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sProperty [needed][type]string[/type]
	[en]...[/en]
	*/
	this.unsetStyle = function(_xElement, _sProperty)
	{
		if (typeof(_sProperty) == 'undefined') {var _sProperty = null;}
		
		_sProperty = this.getRealParameter({'oParameters': _xElement, 'sName': 'sProperty', 'xParameter': _sProperty});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		
		var _oElement = this.getElementObject({'xElement': _xElement});
		if (_oElement)
		{
			eval("_oElement.style."+_sProperty+"='';");
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.unsetStyleAll = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		var _oElement = this.getElementObject({'xElement': _xElement});
		if (_oElement)
		{
			if (typeof(_oElement.style.cssText) != 'undefined') {_oElement.style.cssText = '';}
			else
			{
				var _xStyle = this.getStyle({'xElement': _oElement});
				if (typeof(_xStyle) == 'string')
				{
					if (_xStyle.charAt(_xStyle.length-1)==';')
					{
						_xStyle = _xStyle.slice(0, -1);
					}
				
					var _sProperty, _sValue, _iLength;
					var _asSplitted = _xStyle.split(';');
				
					for (var i=0, _iLength=_asSplitted.length; i<_iLength; i++)
					{
						_sProperty = this.formatProperty({'sString': _asSplitted[i].split(':')[0]});
						_sValue = _asSplitted[i].split(':')[1];
						eval("_oElement.style."+_sProperty+"='';");
					}
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@return sStyle [type]string[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getStyle = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		var _sStyle = '';
		var _oElement = this.getElementObject({'xElement': _xElement});
		if (_oElement)
		{
			if (typeof(_oElement.style.cssText) != 'undefined') {_sStyle = _oElement.style.cssText;}
			else {_sStyle = _oElement.getAttribute('style');}
			if (!_sStyle) {_sStyle = '';}
		}
		return _sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sFloat [type]string[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getStyleFloat = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		var _sFloat = '';
		var _oElement = this.getElementObject({'xElement': _xElement});
		if (_oElement)
		{
			if (typeof(_oElement.style.cssFloat) != 'undefined') {_sFloat = _oElement.style.cssFloat;}
			else if (typeof(_oElement.style.styleFloat) != 'undefined') {_sFloat = _oElement.style.styleFloat;}
			else {_sFloat = _oElement.style.float;}
		}
		return _sFloat;
	}
	/* @end method */
	
	/*
	@start method
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sSize [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setRoundCorner = function(_xElement, _sSize)
	{
		if (typeof(_sSize) == 'undefined') {var _sSize = null;}
		_sSize = this.getRealParameter({'oParameters': _xElement, 'sName': 'sSize', 'xParameter': _sSize});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		this.setProperty(_xElement, 'BorderRadius', _sSize);
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param xValue [type]mixed[/type]
	[en]...[/en]
	*/
	this.setProperty = function(_xElement, _sName, _xValue)
	{
		if (typeof(_sName) == 'undefined') {var _sName = null;}
		if (typeof(_xValue) == 'undefined') {var _xValue = null;}
		
		_sName = this.getRealParameter({'oParameters': _xElement, 'sName': 'sName', 'xParameter': _sName});
		_xValue = this.getRealParameter({'oParameters': _xElement, 'sName': 'xValue', 'xParameter': _xValue});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		
		if (_xValue == null) {_xValue = '';}
		
		var _oElement = this.getElementObject({'xElement': _xElement});
		if (_oElement)
		{
			var _sPropertyTemp = this.getPropertyName({'xElement': _xElement, 'sName': _sName});
			if (_sPropertyTemp != false) {_oElement.style[_sPropertyTemp] = _xValue; return true;}
		}
		return false;
	}
	/* @end method */

	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param xValue [type]mixed[/type]
	[en]...[/en]
	*/
	this.setAttribute = function(_xElement, _sName, _xValue)
	{
		if (typeof(_sName) == 'undefined') {var _sName = null;}
		_sName = this.getRealParameter({'oParameters': _xElement, 'sName': 'sName', 'xParameter': _sName});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		return this.setProperty({'xElement': _xElement, 'sName': _sName, 'xValue': _xValue});
	}
	/* @end method */
	
	/*
	@start method
	
	@return xValue [type]mixed[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	*/
	this.getProperty = function(_xElement, _sName)
	{
		if (typeof(_sName) == 'undefined') {var _sName = null;}
		
		_sName = this.getRealParameter({'oParameters': _xElement, 'sName': 'sName', 'xParameter': _sName});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		
		var _oElement = this.getElementObject({'xElement': _xElement});
		if (_oElement)
		{
			var _oStyle = _oElement.style;
			if (_oStyle)
			{
				var _sPropertyTemp = '';
				var _asPrefixes = ['', 'Webkit', 'Moz', 'Ms', 'O'];
				for (var i=0; i < _asPrefixes.length; i++)
				{
					_sPropertyTemp = _asPrefixes[i]+_sName;
					
					_sPropertyTemp = _sPropertyTemp.charAt(0).toLowerCase() + _sPropertyTemp.slice(1);
					if (typeof(_oStyle[_sPropertyTemp]) !== 'undefined') {return _oStyle[_sPropertyTemp];}
					
					_sPropertyTemp = _sPropertyTemp.charAt(0).toUpperCase() + _sPropertyTemp.slice(1);
					if (typeof(_oStyle[_sPropertyTemp]) !== 'undefined') {return _oStyle[_sPropertyTemp];}
				}
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return xValue [type]mixed[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	*/
	this.getAttribute = function(_xElement, _sName)
	{
		if (typeof(_sName) == 'undefined') {var _sName = null;}
		_sName = this.getRealParameter({'oParameters': _xElement, 'sName': 'sName', 'xParameter': _sName});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		return this.getProperty({'xElement': _xElement, 'sName': _sName});
	}
	/* @end method */
	
	/*
	@start method
	
	@return xValue [type]mixed[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	*/
	this.getPropertyName = function(_xElement, _sName)
	{
		if (typeof(_sName) == 'undefined') {var _sName = null;}
		
		_sName = this.getRealParameter({'oParameters': _xElement, 'sName': 'sName', 'xParameter': _sName});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		
		var _oElement = this.getElementObject({'xElement': _xElement});
		if (_oElement)
		{
			var _oStyle = _oElement.style;
			if (_oStyle)
			{
				var _sPropertyTemp = '';
				var _asPrefixes = ['', 'Webkit', 'Moz', 'Ms', 'O'];
				for (var i=0; i < _asPrefixes.length; i++)
				{
					_sPropertyTemp = _asPrefixes[i]+_sName;
					
					_sPropertyTemp = _sPropertyTemp.charAt(0).toLowerCase() + _sPropertyTemp.slice(1);
					if (typeof(_oStyle[_sPropertyTemp]) !== 'undefined') {return _sPropertyTemp;}
					
					_sPropertyTemp = _sPropertyTemp.charAt(0).toUpperCase() + _sPropertyTemp.slice(1);
					if (typeof(_oStyle[_sPropertyTemp]) !== 'undefined') {return _sPropertyTemp;}
				}
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bExists [type]bool[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.propertyExists = function(_sName, _xElement)
	{
		if (typeof(_xElement) == 'undefined') {var _xElement = null;}
		
		_xElement = this.getRealParameter({'oParameters': _sName, 'sName': 'xElement', 'xParameter': _xElement});
		_sName = this.getRealParameter({'oParameters': _sName, 'sName': 'sName', 'xParameter': _sName});
		
		var _bReturn = false;
		var _oElement = null;
		if (_xElement == null) {_oElement = this.oDocument.createElement('div');}
		else {_oElement = this.getElementObject({'xElement': _xElement});}
		if (_oElement)
		{
			var _oStyle = _oElement.style;
			if (_oStyle) {if (typeof(_oStyle[_sName]) !== 'undefined') {_bReturn = true;}}
			if (_xElement == null) {_oElement = null;}
		}
		return _bReturn;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bExists [type]bool[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	*/
	this.attributeExists = function(_sName, _xElement)
	{
		if (typeof(_xElement) == 'undefined') {var _xElement = null;}
		_xElement = this.getRealParameter({'oParameters': _sName, 'sName': 'xElement', 'xParameter': _xElement});
		_sName = this.getRealParameter({'oParameters': _sName, 'sName': 'sName', 'xParameter': _sName});
		return this.propertyExists({'xElement': _xElement, 'sName': _sName});
	}
	/* @end method */
}
/* @end class */
classPG_Css.prototype = new classPG_ClassBasics();
var oPGCss = new classPG_Css();
