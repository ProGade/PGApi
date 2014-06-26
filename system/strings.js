/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 21 2012
*/
var PG_QUOTES_NONE = 0;
var PG_QUOTES_SINGLE = 1;
var PG_QUOTES_DOUBLE = 2;
var PG_QUOTES_BOTH = 3;

/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_Strings()
{
	// Declarations...
	this.sRegExpEmail = "(^|\ |\n|<br>|<br\ \/>)([a-zA-Z0-9\._-]+)@([a-zA-z0-9_-]+)(\.)(.{2,3,4})"; //(de|com|info|org|net|jp|nu|it|nl|ru|tv)!is"
	this.sRegExpEmailEncoded = "(^|\ |\n|<br>|<br\ \/>)([a-zA-Z0-9\._-]+)\[at\]([a-zA-z0-9_-]+)\[dot\](.{2,3,4})";
	this.sRegExpEmailOnly = "^([a-zA-Z0-9\._-]+)@([a-zA-z0-9_-]+)(\.)$(.{2,3,4})";

	// Construct...
	
	// Methods...
	/*
	@start method
	
	@return iPos [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param sSearch [needed][type]string[/type]
	[en]...[/en]
	
	@param iOffset [type]int[/type]
	[en]...[/en]
	*/
	this.strPos = function(_sString, _sSearch, _iOffset)
	{
		if (typeof(_sString) == 'undefined') {var _sString = null;}
		if (typeof(_sSearch) == 'undefined') {var _sSearch = null;}
		if (typeof(_iOffset) == 'undefined') {var _iOffset = null;}

		_sSearch = this.getRealParameter({'oParameters': _sString, 'sName': 'sSearch', 'xParameter': _sSearch});
		_iOffset = this.getRealParameter({'oParameters': _sString, 'sName': 'iOffset', 'xParameter': _iOffset});
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		
		var i = (_sString+'').indexOf(_sSearch, (_iOffset ? _iOffset : 0));
		return i === -1 ? false : i;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	this.addSlashes = function(_sString)
	{
		if (typeof(_sString) == 'undefined') {var _sString = null;}
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		return _sString.replace(/'/g, "\'").replace(/"/g, '\"');
	}
	/* @end method */
	
	/*
	@start method
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	this.stripSlashes = function(_sString)
	{
		if (typeof(_sString) == 'undefined') {var _sString = null;}
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		return _sString.replace(/\\'/g, "'").replace(/\\"/g, '"');
	}
	/* @end method */

	/*
	@start method
	
	@group Decode
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	this.utf8Decode = function(_sString)
	{
		if (typeof(_sString) == 'undefined') {var _sString = null;}
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		return decodeURIComponent(escape(_sString));
	}
	/* @end method */
	this.utf8ToString = this.utf8Decode;
	this.utf82String = this.utf8Decode;

	/*
	@start method
	
	@group Encode
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	this.utf8Encode = function(_sString)
	{
		if (typeof(_sString) == 'undefined') {var _sString = null;}
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		return unescape(encodeURIComponent(_sString));
	}
	/* @end method */
	this.stringToUtf8 = this.utf8Encode;
	this.string2Utf8 = this.utf8Encode;
	
	/*
	@start method
	
	@group Convert
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param iType [type]int[/type]
	[en]...[/en]
	*/
	this.htmlSpecialChars = function(_sString, _iType)
	{
		if (typeof(_sString) == 'undefined') {_sString = null;}
		if (typeof(_iType) == 'undefined') {_iType = null;}
		
		_iType = this.getRealParameter({'oParameters': _sString, 'sName': 'iType', 'xParameter': _iType});
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		
		if (_sString == null) {_sString = '';}
		if (typeof(_iType) != 'number') {_iType = PG_QUOTES_DOUBLE;}
		
		_iType = Math.max(PG_QUOTES_NONE, Math.min(PG_QUOTES_BOTH, parseInt(_iType)));
		
		var _asHtml = {
			'&': '&amp;',
			'<': '&lt;',
			'>': '&gt;'
		};
		if ((_iType == PG_QUOTES_SINGLE) || (_iType == PG_QUOTES_BOTH)) {_asHtml["'"] = '&#039;';}
		if ((_iType == PG_QUOTES_DOUBLE) || (_iType == PG_QUOTES_BOTH)) {_asHtml['"'] = '&quot;';}
		for (var i in _asHtml)
		{
			// _sString = _sString.replace('/'+i+'/gi', _asHtml[i]);
			eval('_sString = _sString.replace(/'+i+'/gi,"'+_asHtml[i]+'");');
		}
		
		return _sString;
	}
	/* @end method */

	/*
	@start method
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	this.trim = function(_sString)
	{
		if (typeof(_sString) == 'undefined') {var _sString = null;}
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		return (_sString.replace(/\s+$/,"").replace(/^\s+/,""));
	}
	/* @end method */

	/*
	@start method
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	this.lTrim = function(_sString)
	{
		if (typeof(_sString) == 'undefined') {var _sString = null;}
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		return (_sString.replace(/\s+$/,""));
	}
	/* @end method */
	this.trimL = this.lTrim;
	this.leftTrim = this.lTrim;
	this.trimLeft = this.lTrim;
	
	/*
	@start method
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	this.rTrim = function(_sString)
	{
		if (typeof(_sString) == 'undefined') {var _sString = null;}
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		return (_sString.replace(/^\s+/,""));
	}
	/* @end method */
	this.trimR = this.rTrim;
	this.rightTrim = this.rTrim;
	this.trimRight = this.rTrim;
	
	this.axScaleMemory = new Array();
	
	/*
	@start method
	
	@group Transform
	
	@return iMemoryIndex [type]int[/type]
	[en]...[/en]
	
	@param sParentElement [needed][type]string[/type]
	[en]...[/en]
	
	@param oTimeout [needed][type]object[/type]
	[en]...[/en]
	*/
	this.setScaleMemory = function(_sParentElement, _oTimeout)
	{
		if (typeof(_sParentElement) == 'undefined') {var _sParentElement = null;}
		if (typeof(_oTimeout) == 'undefined') {var _oTimeout = null;}
		
		_oTimeout = this.getRealParameter({'oParameters': _sParentElement, 'sName': 'oTimeout', 'xParameter': _oTimeout});
		_sParentElement = this.getRealParameter({'oParameters': _sParentElement, 'sName': 'sParentElement', 'xParameter': _sParentElement});
		
		for (var i=0; i<this.axScaleMemory.length; i++)
		{
			if (this.axScaleMemory[i][0] == _sParentElement)
			{
				this.axScaleMemory[i][1] = _oTimeout;
				return i;
			}
		}
		this.axScaleMemory.push(new Array(_sParentElement, _oTimeout));
		return this.axScaleMemory.length-1;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Transform
	
	@param sParentElement [needed][type]string[/type]
	[en]...[/en]
	*/
	this.unsetScaleMemory = function(_sParentElement)
	{
		if (typeof(_sParentElement) == 'undefined') {var _sParentElement = null;}
		_sParentElement = this.getRealParameter({'oParameters': _sParentElement, 'sName': 'sParentElement', 'xParameter': _sParentElement});
		
		var _oTimeout = this.getScaleMemoryTimeout(_sParentElement);
		if (_oTimeout)
		{
			this.oWindow.clearTimeout(_oTimeout);
			this.setScaleMemory({'sParentElement': _sParentElement, 'oTimeout': null});
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@group Transform
	
	@return oTimeout [type]object[/type]
	[en]...[/en]
	
	@param sParentElement [needed][type]string[/type]
	[en]...[/en]
	*/
	this.getScaleMemoryTimeout = function(_sParentElement)
	{
		if (typeof(_sParentElement) == 'undefined') {var _sParentElement = null;}
		_sParentElement = this.getRealParameter({'oParameters': _sParentElement, 'sName': 'sParentElement', 'xParameter': _sParentElement});
		
		for (var i=0; i<this.axScaleMemory.length; i++)
		{
			if (this.axScaleMemory[i][0] == _sParentElement) {return this.axScaleMemory[i][1];}
		}
		return null;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Transform
	
	@param sParentElement [needed][type]string[/type]
	[en]...[/en]
	
	@param dScale [needed][type]double[/type]
	[en]...[/en]
	
	@param iSpeedTimeout [type]int[/type]
	[en]...[/en]
	
	@param iMilliseconds [type]int[/type]
	[en]...[/en]
	*/
	this.setScale = function(_sParentElement, _dScale, _iSpeedTimeout, _iMilliseconds)
	{
		if (typeof(_sParentElement) == 'undefined') {var _sParentElement = null;}
		if (typeof(_dScale) == 'undefined') {var _dScale = null;}
		if (typeof(_iSpeedTimeout) == 'undefined') {var _iSpeedTimeout = null;}
		if (typeof(_iMilliseconds) == 'undefined') {var _iMilliseconds = null;}
		
		_dScale = this.getRealParameter({'oParameters': _sParentElement, 'sName': 'dScale', 'xParameter': _dScale});
		_iSpeedTimeout = this.getRealParameter({'oParameters': _sParentElement, 'sName': 'iSpeedTimeout', 'xParameter': _iSpeedTimeout});
		_iMilliseconds = this.getRealParameter({'oParameters': _sParentElement, 'sName': 'iMilliseconds', 'xParameter': _iMilliseconds});
		_sParentElement = this.getRealParameter({'oParameters': _sParentElement, 'sName': 'sParentElement', 'xParameter': _sParentElement});
		
		if (typeof(_iSpeedTimeout) == 'undefined') {var _iSpeedTimeout = null;}
		if (_iSpeedTimeout == null) {_iSpeedTimeout = 0;}
		
		if (typeof(_iMilliseconds) == 'undefined') {var _iMilliseconds = null;}
		if (_iMilliseconds == null) {_iMilliseconds = 0;}
		
		var _oParentElement = this.oDocument.getElementById(_sParentElement);
		if (_oParentElement)
		{
			var _iLastFontSize = parseInt(_oParentElement.style.fontSize);
			var _dLastScaleDiff = _dScale-_iLastFontSize;
			var _dCurrentScale = _iLastFontSize;
			this.setScale2({'sParentElement': _sParentElement, 'dScale': _dScale, 'iSpeedTimeout': _iSpeedTimeout, 'iMilliseconds': _iMilliseconds, 'dLastScaleDiff': _dLastScaleDiff, 'dCurrentScale': _dCurrentScale});
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@group Transform
	
	@param sParentElement [needed][type]string[/type]
	[en]...[/en]
	
	@param dScale [needed][type]double[/type]
	[en]...[/en]
	
	@param iSpeedTimeout [type]int[/type]
	[en]...[/en]
	
	@param iMilliseconds [type]int[/type]
	[en]...[/en]
	
	@param dLastScaleDiff [type]double[/type]
	[en]...[/en]
	
	@param dCurrentScale [type]double[/type]
	[en]...[/en]
	*/
	this.setScale2 = function(_sParentElement, _dScale, _iSpeedTimeout, _iMilliseconds, _dLastScaleDiff, _dCurrentScale)
	{
		if (typeof(_sParentElement) == 'undefined') {var _sParentElement = null;}
		if (typeof(_dScale) == 'undefined') {var _dScale = null;}
		if (typeof(_iSpeedTimeout) == 'undefined') {var _iSpeedTimeout = null;}
		if (typeof(_iMilliseconds) == 'undefined') {var _iMilliseconds = null;}
		if (typeof(_dLastScaleDiff) == 'undefined') {var _dLastScaleDiff = null;}
		if (typeof(_dCurrentScale) == 'undefined') {var _dCurrentScale = null;}
		
		_dScale = this.getRealParameter({'oParameters': _sParentElement, 'sName': 'dScale', 'xParameter': _dScale});
		_iSpeedTimeout = this.getRealParameter({'oParameters': _sParentElement, 'sName': 'iSpeedTimeout', 'xParameter': _iSpeedTimeout});
		_iMilliseconds = this.getRealParameter({'oParameters': _sParentElement, 'sName': 'iMilliseconds', 'xParameter': _iMilliseconds});
		_dLastScaleDiff = this.getRealParameter({'oParameters': _sParentElement, 'sName': 'dLastScaleDiff', 'xParameter': _dLastScaleDiff});
		_dCurrentScale = this.getRealParameter({'oParameters': _sParentElement, 'sName': 'dCurrentScale', 'xParameter': _dCurrentScale});
		_sParentElement = this.getRealParameter({'oParameters': _sParentElement, 'sName': 'sParentElement', 'xParameter': _sParentElement});
		
		var _oParentElement = this.oDocument.getElementById(_sParentElement);
		if (_oParentElement)
		{
			this.unsetScaleMemory(_sParentElement);
			var _iLastFontSize = _dCurrentScale;
			var _dScaleDiff = _dScale-_iLastFontSize;
			if (_iSpeedTimeout > 0)
			{
				if (_iMilliseconds > 0)
				{
					var _dScaleRealtion = _iMilliseconds/_iSpeedTimeout;
					var _dScaleRealtionDiff = Math.ceil(_dLastScaleDiff/_dScaleRealtion*10000);
					_dScaleRealtionDiff = _dScaleRealtionDiff/10000;
										
					if (((_dScaleDiff > 0) && (_dCurrentScale + _dScaleRealtionDiff < _dScale))
					|| ((_dScaleDiff < 0) && (_dCurrentScale + _dScaleRealtionDiff > _dScale)))
					{
						// _dScaleDiff = Math.round(_dScaleRealtionDiff*100);
						// _dScaleDiff = _dScaleDiff/100;
						_dScaleDiff = _dScaleRealtionDiff;
					}
				}
			}
			
			if (_dScaleDiff != 0)
			{
				_oParentElement.style.fontSize = Math.round(_iLastFontSize+_dScaleDiff)+'px';
				_dCurrentScale = _iLastFontSize+_dScaleDiff;
			}
			if ((_dScaleDiff != 0) && (_iSpeedTimeout > 0))
			{
				this.setScaleMemory(
					{
						'sParentElement': _sParentElement, 
						'oTimeout': this.oWindow.setTimeout("oPGStrings.setScale2({'sParentElement': '"+_sParentElement+"', 'dScale': "+_dScale+", 'iSpeedTimeout': "+_iSpeedTimeout+", 'iMilliseconds': "+_iMilliseconds+", 'dLastScaleDiff': "+_dLastScaleDiff+", 'dCurrentScale': "+_dCurrentScale+"})", _iSpeedTimeout)
					}
				);
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@group Translate
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param iPercent [type]int[/type]
	[en]...[/en]
	*/
	this.toLeet = function(_sString, _iPercent)
	{
		if (typeof(_sString) == 'undefined') {var _sString = null;}
		if (typeof(_iPercent) == 'undefined') {var _iPercent = null;}
		
		_iPercent = this.getRealParameter({'oParameters': _sString, 'sName': 'iPercent', 'xParameter': _iPercent});
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		
		if (_iPercent == null) {_iPercent = 50;}
		if ((_iPercent > 0) && (_iPercent <= 25))
		{
			_sString = _sString.replace(/a/gi, '4');
			_sString = _sString.replace(/b/gi, '8');
			_sString = _sString.replace(/e/gi, '3');
			_sString = _sString.replace(/g/gi, '9');
			_sString = _sString.replace(/i/gi, '1');
			_sString = _sString.replace(/l/gi, '1');
			_sString = _sString.replace(/o/gi, '0');
			_sString = _sString.replace(/q/gi, '0,');
			_sString = _sString.replace(/r/gi, '12');
			_sString = _sString.replace(/s/gi, '5');
			_sString = _sString.replace(/t/gi, '7');
			_sString = _sString.replace(/z/gi, '2');
		}
		else if ((_iPercent > 25) && (_iPercent <= 50))
		{
			_sString = _sString.replace(/a/gi, '4');
			_sString = _sString.replace(/b/gi, '|3');
			_sString = _sString.replace(/c/gi, '(');
			_sString = _sString.replace(/d/gi, '|)');
			_sString = _sString.replace(/e/gi, '3');
			_sString = _sString.replace(/g/gi, '9');
			_sString = _sString.replace(/i/gi, '|');
			_sString = _sString.replace(/k/gi, '|<');
			_sString = _sString.replace(/l/gi, '1');
			_sString = _sString.replace(/m/gi, '(V)');
			_sString = _sString.replace(/o/gi, '0');
			_sString = _sString.replace(/r/gi, '|2');
			_sString = _sString.replace(/s/gi, '5');
			_sString = _sString.replace(/t/gi, '7');
			_sString = _sString.replace(/v/gi, '\\/');
			_sString = _sString.replace(/w/gi, 'VV');
			_sString = _sString.replace(/x/gi, '><');
			_sString = _sString.replace(/z/gi, '2');
		}
		else if ((_iPercent > 50) && (_iPercent <= 75))
		{
			_sString = _sString.replace(/a/gi, '4');
			_sString = _sString.replace(/b/gi, '|3');
			_sString = _sString.replace(/c/gi, '<');
			_sString = _sString.replace(/d/gi, '|)');
			_sString = _sString.replace(/e/gi, '[-');
			_sString = _sString.replace(/f/gi, '|=');
			_sString = _sString.replace(/g/gi, '9');
			_sString = _sString.replace(/h/gi, '|-|');
			_sString = _sString.replace(/i/gi, '|');
			_sString = _sString.replace(/j/gi, '_|');
			_sString = _sString.replace(/k/gi, '|<');
			_sString = _sString.replace(/l/gi, '1');
			_sString = _sString.replace(/m/gi, '(V)');
			_sString = _sString.replace(/n/gi, '|\\|');
			_sString = _sString.replace(/o/gi, '0');
			_sString = _sString.replace(/p/gi, '|"');
			_sString = _sString.replace(/q/gi, '0,');
			_sString = _sString.replace(/r/gi, '|2');
			_sString = _sString.replace(/s/gi, '5');
			_sString = _sString.replace(/t/gi, '7');
			_sString = _sString.replace(/u/gi, '|_|');
			_sString = _sString.replace(/v/gi, '\\/');
			_sString = _sString.replace(/w/gi, 'VV');
			_sString = _sString.replace(/x/gi, '><');
			_sString = _sString.replace(/y/gi, "'/");
			_sString = _sString.replace(/z/gi, '2');
		}
		else if (_iPercent > 75)
		{
			_sString = _sString.replace(/a/gi, '/-\\');
			_sString = _sString.replace(/b/gi, '|3');
			_sString = _sString.replace(/c/gi, '<');
			_sString = _sString.replace(/d/gi, '|>');
			_sString = _sString.replace(/e/gi, '[-');
			_sString = _sString.replace(/f/gi, '|=');
			_sString = _sString.replace(/g/gi, '(_+');
			_sString = _sString.replace(/h/gi, '|-|');
			_sString = _sString.replace(/i/gi, '|');
			_sString = _sString.replace(/j/gi, '_|');
			_sString = _sString.replace(/k/gi, '|<');
			_sString = _sString.replace(/l/gi, '|_');
			_sString = _sString.replace(/m/gi, '/\\/\\');
			_sString = _sString.replace(/n/gi, '|\\|');
			_sString = _sString.replace(/o/gi, '()');
			_sString = _sString.replace(/p/gi, '|"');
			_sString = _sString.replace(/q/gi, '0,');
			_sString = _sString.replace(/r/gi, '|2');
			_sString = _sString.replace(/s/gi, '5');
			_sString = _sString.replace(/t/gi, '+');
			_sString = _sString.replace(/u/gi, '|_|');
			_sString = _sString.replace(/v/gi, '\\/');
			_sString = _sString.replace(/w/gi, '\\_|_/');
			_sString = _sString.replace(/x/gi, '><');
			_sString = _sString.replace(/y/gi, "'/");
			_sString = _sString.replace(/z/gi, '2');
		}
		return _sString;
	}
	/* @end method */
	this.toL33t = this.toLeet;
	this.to1337 = this.toLeet;
	
	/*
	@start method
	
	@group Convert
	
	@return oObject [type]object[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param sParameterSeperator [type]string[/type]
	[en]...[/en]
	
	@param sValueSeperator [type]string[/type]
	[en]...[/en]
	*/
	this.toObject = function(_sString, _sParameterSeperator, _sValueSeperator)
	{
		if (typeof(_sString) == 'undefined') {var _sString = null;}
		if (typeof(_sParameterSeperator) == 'undefined') {var _sParameterSeperator = null;}
		if (typeof(_sValueSeperator) == 'undefined') {var _sValueSeperator = null;}
		
		_sParameterSeperator = this.getRealParameter({'oParameters': _sString, 'sName': 'sParameterSeperator', 'xParameter': _sParameterSeperator});
		_sValueSeperator = this.getRealParameter({'oParameters': _sString, 'sName': 'sValueSeperator', 'xParameter': _sValueSeperator});
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		
		if (_sParameterSeperator == null) {_sParameterSeperator = '&';}
		if (_sValueSeperator == null) {_sValueSeperator = '=';}
		
		var _asArray = _sString.split(_sParameterSeperator);
		var _oObject = {};
		for (var i=0; i<_asArray.length; i++)
		{
			_asArray2 = _asArray[i].split(_sValueSeperator);
			_oObject[_asArray2[0]] = _asArray2[1];
		}
		return _oObject;
	}
	/* @end method */

	/*
	@start method
	
	@group Convert
	
	@return asArray [type]string[][/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param sSeperator [type]string[/type]
	[en]...[/en]
	*/
	this.toArray = function(_sString, _sSeperator)
	{
		if (typeof(_sString) == 'undefined') {var _sString = null;}
		if (typeof(_sSeperator) == 'undefined') {var _sSeperator = null;}
		
		_sSeperator = this.getRealParameter({'oParameters': _sString, 'sName': 'sSeperator', 'xParameter': _sSeperator});
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		
		if (_sSeperator == null) {_sSeperator = '';}
		
		var _asArray = null;
		if (_sSeperator != '')
		{
			_asArray = new Array();
			for (var i=0; i<_sString.length; i++) {_asArray.push(_sString.charAt(i));}
		}
		else {var _asArray = _sString.split(_sSeperator);}
		return _asArray;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Convert
	
	@return aoNodes [type]object[][/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	this.toNodes = function(_sString)
	{
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		
		var _oNode = this.oDocument.createElement('div');
		if (_oNode)
		{
			_oNode.innerHTML = _sString;
			return _oNode.childNodes;
		}
		return null;
		
		// this.oDocument.createTextNode(_sString);
		// this.oDocument.createElement(_sString);
	}
	/* @end method */
	
	/*
	@start method
	
	@group Translate
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	this.backwards = function(_sString)
	{
		if (typeof(_sString) == 'undefined') {var _sString = null;}
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		
		var _sNewString = '';
		for (var i=_sString.length-1; i>=0; i--) {_sNewString += _sString.charAt(i);}
		return _sNewString;
	}
	/* @end method */
	this.toBackwards = this.backwards;
	this.reverse = this.backwards;
	this.toReverse = this.backwards;
	
	/*
	@start method
	
	@group Translate
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param bFirstCharToUpper [type]bool[/type]
	[en]...[/en]
	*/
	this.toLaola = function(_sString, _bFirstCharToUpper)
	{
		if (typeof(_sString) == 'undefined') {var _sString = null;}
		if (typeof(_bFirstCharToUpper) == 'undefined') {var _bFirstCharToUpper = null;}
		
		_bFirstCharToUpper = this.getRealParameter({'oParameters': _sString, 'sName': 'bFirstCharToUpper', 'xParameter': _bFirstCharToUpper});
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		
		if (_bFirstCharToUpper == null) {_bFirstCharToUpper = true;}
		
		var _bToUpperCase = false;
		if (_bFirstCharToUpper == true) {_bToUpperCase = true;}
		var _sNewString = '';
		for (var i=0; i<_sString.length; i++)
		{
			if (_sString.charAt(i).search(/[\ \.\,\!\-\_\+\\\/\?\=\(\)\&\%\$\"\'\<\>]/ig) != -1) {_sNewString += _sString.charAt(i);}
			else if (_bToUpperCase == true) {_sNewString += _sString.charAt(i).toUpperCase(); _bToUpperCase = false;}
			else {_sNewString += _sString.charAt(i).toLowerCase(); _bToUpperCase = true;}
		}
		return _sNewString;
	}
	/* @end method */
	this.laola = this.toLaola;
	
	/*
	@start method
	
	@group Translate
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param iCurrentUpperChar [needed][type]int[/type]
	[en]...[/en]
	
	@param sDefaultChar [type]string[/type]
	[en]...[/en]
	
	@param iUpperCharsCount [type]int[/type]
	[en]...[/en]
	
	@param bChangeUpperAndLower [type]bool[/type]
	[en]...[/en]
	*/
	this.toWave = function(_sString, _iCurrentUpperChar, _sDefaultChar, _iUpperCharsCount, _bChangeUpperAndLower)
	{
		if (typeof(_sString) == 'undefined') {var _sString = null;}
		if (typeof(_iCurrentUpperChar) == 'undefined') {var _iCurrentUpperChar = null;}
		if (typeof(_sDefaultChar) == 'undefined') {var _sDefaultChar = null;}
		if (typeof(_iUpperCharsCount) == 'undefined') {var _iUpperCharsCount = null;}
		if (typeof(_bChangeUpperAndLower) == 'undefined') {var _bChangeUpperAndLower = null;}
		
		_iCurrentUpperChar = this.getRealParameter({'oParameters': _sString, 'sName': 'iCurrentUpperChar', 'xParameter': _iCurrentUpperChar});
		_sDefaultChar = this.getRealParameter({'oParameters': _sString, 'sName': 'sDefaultChar', 'xParameter': _sDefaultChar});
		_iUpperCharsCount = this.getRealParameter({'oParameters': _sString, 'sName': 'iUpperCharsCount', 'xParameter': _iUpperCharsCount});
		_bChangeUpperAndLower = this.getRealParameter({'oParameters': _sString, 'sName': 'bChangeUpperAndLower', 'xParameter': _bChangeUpperAndLower});
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		
		if (_sDefaultChar == null) {_sDefaultChar = '.';}
		if (_iUpperCharsCount == null) {_iUpperCharsCount = 1;}
		if (_bChangeUpperAndLower == null) {_bChangeUpperAndLower = false;}
		
		var _sNewString = '';
		for (var i=0; i<_sString.length; i++)
		{
			if (((i >= _iCurrentUpperChar-1) && (i <= _iCurrentUpperChar+_iUpperCharsCount) && (_bChangeUpperAndLower != true))
			|| (((i <= _iCurrentUpperChar-1) || (i >= _iCurrentUpperChar+_iUpperCharsCount)) && (_bChangeUpperAndLower == true)))
			{
				if (_sString.charAt(i).search(/[\ \.\,\!\-\_\+\\\/\?\=\(\)\&\%\$\"\'\<\>]/ig) != -1) {_sNewString += _sString.charAt(i);}
				else if (((i >= _iCurrentUpperChar) && (i < _iCurrentUpperChar+_iUpperCharsCount) && (_bChangeUpperAndLower != true))
				|| (((i < _iCurrentUpperChar-1) || (i > _iCurrentUpperChar+_iUpperCharsCount)) && (_bChangeUpperAndLower == true)))
				{
					_sNewString += _sString.charAt(i).toUpperCase();
				}
				else {_sNewString += _sString.charAt(i).toLowerCase();}
			}
			else
			{
				if (_sString.charAt(i).search(/\ /ig) != -1) {_sNewString += ' ';}
				else {_sNewString += _sDefaultChar;}
			}
		}
		return _sNewString;
	}
	/* @end method */
	this.wave = this.toWave;
	
	/*
	@start method
	
	@group Transform
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param iCharSteps [type]int[/type]
	[en]...[/en]
	*/
	this.moveChars = function(_sString, _iCharSteps)
	{
		if (typeof(_sString) == 'undefined') {var _sString = null;}
		if (typeof(_iCharSteps) == 'undefined') {var _iCharSteps = null;}

		_iCharSteps = this.getRealParameter({'oParameters': _sString, 'sName': 'iCharSteps', 'xParameter': _iCharSteps});
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		
		if (_sString == '') {return _sString;}
		if (_sString.length <= 2) {return _sString;}
		
		if (_iCharSteps == 0) {_iCharSteps = -1;}
		if (_iCharSteps > 0) {_iCharSteps = Math.min(_iCharSteps, _sString.length-2);}
		if (_iCharSteps < 0) {_iCharSteps = Math.max(_iCharSteps, -(_sString.length-2));}
		
		var i=0;
		var t=0;
		var _asNewString = new Array();
		for (i=0; i<_sString.length; i++)
		{
			if (i+_iCharSteps < 0) {t = i+_iCharSteps+_sString.length;}
			else if (i+_iCharSteps > _sString.length-1) {t = i+_iCharSteps-_sString.length;}
			else {t=i+_iCharSteps;}
			t = Math.min(Math.max(t, 0), _sString.length-1);
			_asNewString.push(_sString[t]);
		}
		return _asNewString.join('');
	}
	/* @end method */
	
	/*
	@start method
	
	@group Encode
	
	@return sMail [type]string[/type]
	[en]...[/en]
	
	@param sMail [needed][type]string[/type]
	[en]...[/en]
	
	@param sAt [type]string[/type]
	[en]...[/en]
	
	@param sDot [type]string[/type]
	[en]...[/en]
	*/
	this.mailEncode = function(_sMail, _sAt, _sDot)
	{
		if (typeof(_sMail) == 'undefined') {var _sMail = null;}
		if (typeof(_sAt) == 'undefined') {var _sAt = null;}
		if (typeof(_sDot) == 'undefined') {var _sDot = null;}

		_sAt = this.getRealParameter({'oParameters': _sMail, 'sName': 'sAt', 'xParameter': _sAt});
		_sDot = this.getRealParameter({'oParameters': _sMail, 'sName': 'sDot', 'xParameter': _sDot});
		_sMail = this.getRealParameter({'oParameters': _sMail, 'sName': 'sMail', 'xParameter': _sMail});

		if (_sAt == null) {_sAt = '[at]';}
		if (_sDot == null) {_sDot = '[dot]';}

		_sMail = _sMail.replace(/@/g, '[at]');
		_sMail = _sMail.replace(/./g, '[dot]');
		
		return _sMail;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Decode
	
	@return sMail [type]string[/type]
	[en]...[/en]
	
	@param sMail [needed][type]string[/type]
	[en]...[/en]
	
	@param sAt [type]string[/type]
	[en]...[/en]
	
	@param sDot [type]string[/type]
	[en]...[/en]
	*/
	this.mailDecode = function(_sMail, _sAt, _sDot)
	{
		if (typeof(_sMail) == 'undefined') {var _sMail = null;}
		if (typeof(_sAt) == 'undefined') {var _sAt = null;}
		if (typeof(_sDot) == 'undefined') {var _sDot = null;}

		_sAt = this.getRealParameter({'oParameters': _sMail, 'sName': 'sAt', 'xParameter': _sAt});
		_sDot = this.getRealParameter({'oParameters': _sMail, 'sName': 'sDot', 'xParameter': _sDot});
		_sMail = this.getRealParameter({'oParameters': _sMail, 'sName': 'sMail', 'xParameter': _sMail});

		if (_sAt == null) {_sAt = "\[at\]";}
		if (_sDot == null) {_sDot = "\[dot\]";}
		
		var _oRegExpAt = new RegExp(_sAt,"gi");
		var _oRegExpDot = new RegExp(_sDot,"gi");
		_sMail = _sMail.replace(_oRegExpAt, '@');
		_sMail = _sMail.replace(_oRegExpDot, '.');
		
		return _sMail;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Encode
	
	@return sText [type]string[/type]
	[en]...[/en]
	
	@param sText [needed][type]string[/type]
	[en]...[/en]
	
	@param sAt [type]string[/type]
	[en]...[/en]
	
	@param sDot [type]string[/type]
	[en]...[/en]
	*/
	this.findMailsAndEncode = function(_sText, _sAt, _sDot)
	{
		if (typeof(_sText) == 'undefined') {var _sMail = null;}
		if (typeof(_sAt) == 'undefined') {var _sAt = null;}
		if (typeof(_sDot) == 'undefined') {var _sDot = null;}

		_sAt = this.getRealParameter({'oParameters': _sText, 'sName': 'sAt', 'xParameter': _sAt});
		_sDot = this.getRealParameter({'oParameters': _sText, 'sName': 'sDot', 'xParameter': _sDot});
		_sText = this.getRealParameter({'oParameters': _sText, 'sName': 'sText', 'xParameter': _sText});
		
		if (_sAt == null) {_sAt = '[at]';}
		if (_sDot == null) {_sDot = '[dot]';}
		
		var _oRegExp = new RegExp(this.sRegExpEmail,"gi");
		return _sText.replace(_oRegExp, "$1$2"+_sAt+"$3"+_sDot+"$4");
	}
	/* @end method */

	/*
	@start method
	
	@group Decode
	
	@return sText [type]string[/type]
	[en]...[/en]
	
	@param sText [needed][type]string[/type]
	[en]...[/en]
	
	@param sAt [type]string[/type]
	[en]...[/en]
	
	@param sDot [type]string[/type]
	[en]...[/en]
	*/
	this.findMailsAndDecode = function(_sText, _sAt, _sDot)
	{
		if (typeof(_sText) == 'undefined') {var _sMail = null;}
		if (typeof(_sAt) == 'undefined') {var _sAt = null;}
		if (typeof(_sDot) == 'undefined') {var _sDot = null;}

		_sAt = this.getRealParameter({'oParameters': _sText, 'sName': 'sAt', 'xParameter': _sAt});
		_sDot = this.getRealParameter({'oParameters': _sText, 'sName': 'sDot', 'xParameter': _sDot});
		_sText = this.getRealParameter({'oParameters': _sText, 'sName': 'sText', 'xParameter': _sText});
		
		if (_sAt == null) {_sAt = '\[at\]';}
		if (_sDot == null) {_sDot = '\[dot\]';}
		
		var _oRegExp = new RegExp(this.sRegExpEmailEncoded.replace('\[at\]', _sAt).replace('\[dot\]', _sDot),"gi");
		return _sText.replace(_oRegExp, "$1$2@$3.$4");
	}
	/* @end method */
	
	/*
	@start method
	
	@return sUrl [type]string[/type]
	[en]...[/en]
	
	@param sUrl [needed][type]string[/type]
	[en]...[/en]
	
	@param sProtocol [type]string[/type]
	[en]...[/en]
	*/
	this.changeUrlProtocol = function(_sUrl, _sProtocol)
	{
		if (typeof(_sUrl) == 'undefined') {var _sUrl = null;}
		if (typeof(_sProtocol) == 'undefined') {var _sProtocol = null;}

		_sProtocol = this.getRealParameter({'oParameters': _sUrl, 'sName': 'sProtocol', 'xParameter': _sProtocol});
		_sUrl = this.getRealParameter({'oParameters': _sUrl, 'sName': 'sUrl', 'xParameter': _sUrl});
		
		if (_sProtocol == null) {_sProtocol = window.location.protocol;}
		return _sUrl.replace(/http(s){0,1}:\/\//gi, _sProtocol+'://');
	}
	/* @end method */

    /*
    @start method

    @group File

    @return sExtension [type]string[/type]
    [en]...[/en]

    @param sString [needed][type]string[/type]
    [en]...[/en]
    */
    this.getFileExtension = function(_sString)
    {
        _sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
        var _iLastIndex = _sString.lastIndexOf('.');
        return _sString.substr(_iLastIndex+1, _sString.length-_iLastIndex-1).toUpperCase();
    }
    /* @end method */

    /*
    @start method
    */
    this.numberFormat = function(_xNumber, _iDecimals, _sDecimalPoint, _sThousandsSeperator)
    {
        if (typeof(_iDecimals) == 'undefined') {var _iDecimals = null;}
        if (typeof(_sDecimalPoint) == 'undefined') {var _sDecimalPoint = null;}
        if (typeof(_sThousandsSeperator) == 'undefined') {var _sThousandsSeperator = null;}

        _iDecimals = this.getRealParameter({'oParameters': _xNumber, 'sName': 'iDecimals', 'xParameter': _iDecimals});
        _sDecimalPoint = this.getRealParameter({'oParameters': _xNumber, 'sName': 'sDecimalPoint', 'xParameter': _sDecimalPoint});
        _sThousandsSeperator = this.getRealParameter({'oParameters': _xNumber, 'sName': 'sThousandsSeperator', 'xParameter': _sThousandsSeperator});
        _xNumber = this.getRealParameter({'oParameters': _xNumber, 'sName': 'xNumber', 'xParameter': _xNumber});

        if (_iDecimals == null) {_iDecimals = 0;}
        if (_sDecimalPoint == null) {_sDecimalPoint = '.';}
        if (_sThousandsSeperator == null) {_sThousandsSeperator = '';}

        if (isNaN(_xNumber)) {_xNumber = parseFloat(_xNumber);}
        if (isNaN(_xNumber)) {return _xNumber;}

        _xNumber = _xNumber.toFixed(_iDecimals);

        var _sNumber = ""+_xNumber;
        var _asDecimalSeperated = _sNumber.split('.', _sNumber);
        var _oRegularExpression = /(\d+)(\d{3})/;

        while (_oRegularExpression.test(_asDecimalSeperated[0]))
        {
            _asDecimalSeperated[0] = _asDecimalSeperated[0].replace(_oRegularExpression, '$1'+_sThousandsSeperator+'$2');
        }

        _sNumber = _asDecimalSeperated.join(_sDecimalPoint);

        return _sNumber;
    }
    /* @end method */
}
/* @end class */
classPG_Strings.prototype = new classPG_ClassBasics();
var oPGStrings = new classPG_Strings();
