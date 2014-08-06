/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 21 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_Vars()
{
	// Declarations...
	this.iMaxStructureDepth = 4;
	this.iMaxStructureCount = 250;
	this.iCurrentStructureCount = 0;
	
	// Construct...
	
	// Methods...
	/*
	@start method
	
	@return sStructure [type]string[/type]
	[en]...[/en]
	
	@param bUseHtml [type]bool[/type]
	[en]...[/en]
	
	@param xVar [needed][type]mixed[/type]
	[en]...[/en]
	
	@param iDepth [type]int[/type]
	[en]...[/en]
	
	@param bShowEmpty [type]bool[/type]
	[en]...[/en]
	
	@param bShowFunctions [type]bool[/type]
	[en]...[/en]
	
	@param iMaxCount [type]int[/type]
	[en]...[/en]
	
	@param iMaxDepth [type]int[/type]
	[en]...[/en]
	*/
	this.getStructureString = function(_bUseHtml, _xVar, _iDepth, _bShowEmpty, _bShowFunctions, _iMaxCount, _iMaxDepth)
	{
		if (typeof(_xVar) == 'undefined') {var _xVar = null;}
		if (typeof(_iDepth) == 'undefined') {var _iDepth = null;}
		if (typeof(_bShowEmpty) == 'undefined') {var _bShowEmpty = null;}
		if (typeof(_bShowFunctions) == 'undefined') {var _bShowFunctions = null;}
		if (typeof(_iMaxCount) == 'undefined') {var _iMaxCount = null;}
		if (typeof(_iMaxDepth) == 'undefined') {var _iMaxDepth = null;}

		_xVar = this.getRealParameter({'oParameters': _bUseHtml, 'sName': 'xVar', 'xParameter': _xVar});
		_iDepth = this.getRealParameter({'oParameters': _bUseHtml, 'sName': 'iDepth', 'xParameter': _iDepth});
		_bShowEmpty = this.getRealParameter({'oParameters': _bUseHtml, 'sName': 'bShowEmpty', 'xParameter': _bShowEmpty});
		_bShowFunctions = this.getRealParameter({'oParameters': _bUseHtml, 'sName': 'bShowFunctions', 'xParameter': _bShowFunctions});
		_iMaxCount = this.getRealParameter({'oParameters': _bUseHtml, 'sName': 'iMaxCount', 'xParameter': _iMaxCount});
		_iMaxDepth = this.getRealParameter({'oParameters': _bUseHtml, 'sName': 'iMaxDepth', 'xParameter': _iMaxDepth});
		_bUseHtml = this.getRealParameter({'oParameters': _bUseHtml, 'sName': 'bUseHtml', 'xParameter': _bUseHtml});

		if (_bUseHtml == null) {_bUseHtml = false;}
		if (_iDepth == null) {_iDepth = 0; this.iCurrentStructureCount = 0;}
		if (_bShowEmpty == null) {_bShowEmpty = false;}
		if (_bShowFunctions == null) {_bShowFunctions = false;}
		if (_iMaxCount == null) {_iMaxCount = this.iMaxStructureCount;}
		if (_iMaxDepth == null) {_iMaxDepth = this.iMaxStructureDepth;}
		
		var _iStructureLength = 0;
		var _sStructure = '';
		try
		{
			if (typeof(_xVar) != 'undefined')
			{
				if (_xVar === null)
				{
					if ((_bUseHtml == false) && (_sStructure != '')) {_sStructure += ", \n";}
					_sStructure += 'null';
				}
				else if ((this.isArray({'xVar': _xVar})) || (this.isObject({'xVar': _xVar})) || (typeof(_xVar) == 'object'))
				{
					if ((_xVar != this.oWindow) && (_xVar != this.oDocument))
					{
						if (_sStructure != '') {_sStructure += ", \n";}
						if (this.isArray({'xVar': _xVar}))
						{
							_sStructure += 'Array';
							if (_bUseHtml == true) {_sStructure += '<br />';}
							_sStructure += '(';
						}
						else if ((this.isObject({'xVar': _xVar})) || (typeof(_xVar) == 'object'))
						{
							_sStructure += 'Object';
							if (_bUseHtml == true) {_sStructure += '<br />';}
							_sStructure += '(';
						}
						if (_bUseHtml == true) {_sStructure += '<blockquote style="margin-top:0px; margin-bottom:0px;">';}
						var _bSeperator = false;
						for (var _iIndex in _xVar)
						{
							if (typeof(_xVar[_iIndex]) != 'undefined')
							{
								if ((typeof(_xVar[_iIndex]) != 'function') || (_bShowFunctions == true))
								{
									if ((!this.isEmpty({'xVar': _xVar[_iIndex]})) || (_bShowEmpty == true))
									{
										// if (_sStructure.length > 1000) {return _sStructure;}
										if ((_bUseHtml == false) && (_bSeperator == true)) {_sStructure += ", \n";}
										_sStructure += '['+_iIndex+'] = ';
										if ((_iDepth < _iMaxDepth) || ((typeof(_xVar[_iIndex]) != 'object') && (typeof(_xVar[_iIndex]) != 'array')))
										{
											_sStructure += this.getStructureString(
												{
													'xVar': _xVar[_iIndex], 
													'bUseHtml': _bUseHtml, 
													'iDepth': _iDepth+1, 
													'bShowEmpty': _bShowEmpty, 
													'bShowFunctions': _bShowFunctions,
													'iMaxCount': _iMaxCount,
													'iMaxDepth': _iMaxDepth
												}
											);
										}
										else
										{
											if (typeof(_xVar[_iIndex]) == 'object') {_sStructure += '[object...]';}
											else if (typeof(_xVar[_iIndex]) == 'array') {_sStructure += '[array...]';}
											else {_sStructure += '[more...]';}
										}
										if (_bUseHtml == true) {_sStructure += '<br />';}
										_bSeperator = true;
										if (this.iCurrentStructureCount > _iMaxCount)
										{
											_sStructure += '\n[...more structure]';
											if (_bUseHtml == true) {_sStructure += '</blockquote>';}
											_sStructure += ')';
											return _sStructure;
										}
										this.iCurrentStructureCount++;
									}
								}
							}
						}
						if (_bUseHtml == true) {_sStructure += '</blockquote>';}
						_sStructure += ')';
					}
				}
				else if (typeof(_xVar) == 'function')
				{
					if (_sStructure != '') {_sStructure += ", \n";}
					_sStructure += 'function:'+_xVar.getName();
				}
				else
				{
					if ((_bUseHtml == false) && (_sStructure != '')) {_sStructure += ", \n";}
					if (typeof(_xVar) == 'string')
					{
						if (_bUseHtml == true) {_xVar = oPGStrings.htmlSpecialChars(_xVar);}
						_sStructure += '"'+_xVar+'"';
					}
					else if (typeof(_xVar) == 'number') {_sStructure += _xVar;}
					else if (_xVar === false) {_sStructure += 'false';}
					else if (_xVar === true) {_sStructure += 'true';}
				}
			}
		}
		catch(e) {}
		return _sStructure;
	}
	/* @end method */
	this.print_r = this.getStructureString;
	this.print = this.getStructureString;
	
	/*
	@start method
	
	@return sType [type]string[/type]
	[en]...[/en]
	
	@param xVar [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getType = function(_xVar)
	{
		if (typeof(_xVar) == 'undefined') {return 'undefined';}
		else
		{
			_xVar = this.getRealParameter({'oParameters': _xVar, 'sName': 'xVar', 'xParameter': _xVar, 'bNotNull': true});
			if (typeof(_xVar.constructor) != 'undefined')
			{
				switch(_xVar.constructor)
				{
					case Object: return 'object'; break;
					case Array: return 'array'; break;
					case String: return 'string'; break;
					case Number: return 'number'; break;
				}
			}
		}
		return null;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bIsObject [type]bool[/type]
	[en]...[/en]
	
	@param xVar [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.isObject = function(_xVar)
	{
		if (typeof(_xVar) == 'undefined') {var _xVar = null;}
		_xVar = this.getRealParameter({'oParameters': _xVar, 'sName': 'xVar', 'xParameter': _xVar, 'bNotNull': true});
		if (_xVar != null) {return (_xVar.constructor === Object);}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bIsArray [type]bool[/type]
	[en]...[/en]
	
	@param xVar [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.isArray = function(_xVar)
	{
		if (typeof(_xVar) == 'undefined') {var _xVar = null;}
		_xVar = this.getRealParameter({'oParameters': _xVar, 'sName': 'xVar', 'xParameter': _xVar, 'bNotNull': true});
		if (_xVar != null) {return (_xVar.constructor === Array);}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bIsString [type]bool[/type]
	[en]...[/en]
	
	@param xVar [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.isString = function(_xVar)
	{
		if (typeof(_xVar) == 'undefined') {var _xVar = null;}
		_xVar = this.getRealParameter({'oParameters': _xVar, 'sName': 'xVar', 'xParameter': _xVar, 'bNotNull': true});
		if (_xVar != null) {return (_xVar.constructor === String);}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bIsNumber [type]bool[/type]
	[en]...[/en]
	
	@param xVar [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.isNumber = function(_xVar)
	{
		if (typeof(_xVar) == 'undefined') {var _xVar = null;}
		_xVar = this.getRealParameter({'oParameters': _xVar, 'sName': 'xVar', 'xParameter': _xVar, 'bNotNull': true});
		if (_xVar != null) {return (_xVar.constructor === Number);}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bIsEmpty [type]bool[/type]
	[en]...[/en]
	
	@param xVar [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.isEmpty = function(_xVar)
	{
		if (typeof(_xVar) == 'undefined') {var _xVar = null;}
		
		_xVar = this.getRealParameter({'oParameters': _xVar, 'sName': 'xVar', 'xParameter': _xVar});
		
		if ((typeof(_xVar) == 'undefined') || (_xVar == null)) {return true;}
		if (this.isNumber(_xVar))
		{
			if ((!_xVar) || (_xVar == 0)) {return true;}
		}
		if (this.isString(_xVar))
		{
			if ((!_xVar) || (_xVar == "")) {return true;}
		}
		if (this.isObject(_xVar)) {if (_xVar == null) {return true;}}
		if (this.isArray(_xVar)) {if (!_xVar.length) {return true;}}
		return false;
	}
	/* @end method */

	/*
	@start method
	
	@return nNumber [type]number[/type]
	[en]...[/en]
	
	@param xVar [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.cssNumber = function(_xVar)
	{
		if (typeof(_xVar) == 'undefined') {var _xVar = null;}
		_xVar = this.getRealParameter({'oParameters': _xVar, 'sName': 'xVar', 'xParameter': _xVar, 'bNotNull': true});
		if (_xVar != null)
		{
			if (this.isString(_xVar))
			{
				_xVar.replace(/,/g, '.');
				/*
				if (
					(_xVar.search(/px/i) == -1)
					&& (_xVar.search(/pt/i) == -1)
					&& (_xVar.search(/\%/i) == -1)
					&& (_xVar.search(/cm/i) == -1)
					&& (_xVar.search(/em/i) == -1)
					&& (_xVar.search(/ex/i) == -1)
					&& (_xVar.search(/in/i) == -1)
					&& (_xVar.search(/mm/i) == -1)
					&& (_xVar.search(/pc/i) == -1)
				)
				*/
				if (_xVar.search(/[0-9+.-]/i) == -1)
				{
					_xVar += 'px';
				}
			}
			else {_xVar += 'px';}
		}
		return _xVar;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sColor [type]string[/type]
	[en]...[/en]
	
	@param xVar [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.cssColor = function(_xVar)
	{
		if (typeof(_xVar) == 'undefined') {var _xVar = null;}
		_xVar = this.getRealParameter({'oParameters': _xVar, 'sName': 'xVar', 'xParameter': _xVar, 'bNotNull': true});
		if (_xVar != null)
		{
			if (this.isString(_xVar))
			{
				//if ((_xVar.search(/\#/i) == -1) && (_xVar.search(/[0-9A-Fa-f]{3,6}/i) != -1) && (_xVar.search(/red/i) == -1)) {_xVar = '#'+_xVar;}
				_xVar.replace(/\#([0-9A-Fa-f]{3,6})/gi, '#$1');
			}
		}
		return _xVar;
	}
	/* @end method */
}
/* @end class */
classPG_Vars.prototype = new classPG_ClassBasics();
var oPGVars = new classPG_Vars();
