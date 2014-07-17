/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 22 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_Arrays()
{
	/*
	@start method
	
	@return sStructure [type]string[/type]
	[en]...[/en]
	
	@param axArray [needed][type]mixed[][/type]
	[en]...[/en]
	
	@param bUseHtml [type]bool[/type]
	[en]...[/en]
	*/
	this.getStructureString = function(_axArray, _bUseHtml)
	{
		if (typeof(_bUseHtml) == 'undefined') {var _bUseHtml = null;}
		_bUseHtml = this.getRealParameter({'oParameters': _axArray, 'sName': 'bUseHtml', 'xParameter': _bUseHtml});
		_axArray = this.getRealParameter({'oParameters': _axArray, 'sName': 'axArray', 'xParameter': _axArray});
		
		return oPGVars.getStructureString({'xVar': _axArray, 'bUseHtml': _bUseHtml});
	}
	/* @end method */
	this.print_r = this.getStructureString;
	
	/*
	@start method
	
	@return iEmptyIndex [type]int[/type]
	[en]...[/en]
	
	@param axArray [needed][type]mixed[][/type]
	[en]...[/en]
	
	@param iMaxIndex [type]int[/type]
	[en]...[/en]
	*/
	this.findEmptyIndex = function(_axArray, _iMaxIndex)
	{
		if (typeof(_iMaxIndex) == 'undefined') {var _iMaxIndex = null;}
		
		_iMaxIndex = this.getRealParameter({'oParameters': _axArray, 'sName': 'iMaxIndex', 'xParameter': _iMaxIndex});
		_axArray = this.getRealParameter({'oParameters': _axArray, 'sName': 'axArray', 'xParameter': _axArray});

		for (var i=0; i<_axArray.length; i++) {if (_axArray[i] == null) {return i;}}
		if ((_axArray.length < _iMaxIndex) || (_iMaxIndex == null)) {_axArray.push(null); return _axArray.length-1;}
		return -1;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iIndex [type]int[/type]
	[en]...[/en]
	
	@param axArray [needed][type]mixed[][/type]
	[en]...[/en]
	
	@param xItem [type]mixed[/type]
	[en]...[/en]
	
	@param iMaxIndex [type]int[/type]
	[en]...[/en]
	*/
	this.add = function(_axArray, _xItem, _iMaxIndex)
	{
		if (typeof(_xItem) == 'undefined') {var _xItem = null;}
		if (typeof(_iMaxIndex) == 'undefined') {var _iMaxIndex = null;}

		_xItem = this.getRealParameter({'oParameters': _axArray, 'sName': 'xItem', 'xParameter': _xItem});
		_iMaxIndex = this.getRealParameter({'oParameters': _axArray, 'sName': 'iMaxIndex', 'xParameter': _iMaxIndex});
		_axArray = this.getRealParameter({'oParameters': _axArray, 'sName': 'axArray', 'xParameter': _axArray});
		
		var _iIndex = this.findEmptyIndex(_axArray);
		if (_iIndex > -1)
		{
			_axArray[_iIndex] = _xItem;
			return _iIndex;
		}
		return -1;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iEmptyIndex [type]int[/type]
	[en]...[/en]
	
	@param axArray [needed][type]mixed[][/type]
	[en]...[/en]
	
	@param xItem [type]mixed[/type]
	[en]...[/en]
	*/
	this.remove = function(_axArray, _xItem)
	{
		if (typeof(_xItem) == 'undefined') {var _xItem = null;}
		
		_xItem = this.getRealParameter({'oParameters': _axArray, 'sName': 'xItem', 'xParameter': _xItem});
		_axArray = this.getRealParameter({'oParameters': _axArray, 'sName': 'axArray', 'xParameter': _axArray});
		
		if (_xItem == null) {return -1;}
		
		for (var i=0; i<_axArray.length; i++)
		{
			if (_axArray[i] == _xItem) {_axArray[i] = null; return i;}
		}
		return -1;
	}
	/* @end method */
}
/* @end class */
classPG_Arrays.prototype = new classPG_ClassBasics();
var oPGArrays = new classPG_Arrays();
