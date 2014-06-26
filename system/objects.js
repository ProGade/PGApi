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
function classPG_Objects()
{
	// Declarations...

	// Construct...
	
	// Methods...
	/*
	@start method
	
	@return sStructure [type]string[/type]
	[en]...[/en]
	
	@param oObject [needed][type]object[/type]
	[en]...[/en]
	
	@param bUseHtml [type]bool[/type]
	[en]...[/en]
	*/
	this.getStructureString = function(_bUseHtml, _oObject, _bShowEmpty, _bShowFunctions, _iMaxCount, _iMaxDepth)
	{
		if (typeof(_oObject) == 'undefined') {var _oObject = null;}
		if (typeof(_bShowEmpty) == 'undefined') {var _bShowEmpty = null;}
		if (typeof(_bShowFunctions) == 'undefined') {var _bShowFunctions = null;}
		if (typeof(_iMaxCount) == 'undefined') {var _iMaxCount = null;}
		if (typeof(_iMaxDepth) == 'undefined') {var _iMaxDepth = null;}

		_oObject = this.getRealParameter({'oParameters': _bUseHtml, 'sName': 'oObject', 'xParameter': _oObject});
		_bShowEmpty = this.getRealParameter({'oParameters': _bUseHtml, 'sName': 'bShowEmpty', 'xParameter': _bShowEmpty});
		_bShowFunctions = this.getRealParameter({'oParameters': _bUseHtml, 'sName': 'bShowFunctions', 'xParameter': _bShowFunctions});
		_iMaxCount = this.getRealParameter({'oParameters': _bUseHtml, 'sName': 'iMaxCount', 'xParameter': _iMaxCount});
		_iMaxDepth = this.getRealParameter({'oParameters': _bUseHtml, 'sName': 'iMaxDepth', 'xParameter': _iMaxDepth});
		_bUseHtml = this.getRealParameter({'oParameters': _bUseHtml, 'sName': 'bUseHtml', 'xParameter': _bUseHtml});

		return oPGVars.getStructureString(
			{
				'xVar': _oObject,
				'bUseHtml': _bUseHtml,
				'bShowEmpty': _bShowEmpty, 
				'bShowFunctions': _bShowFunctions,
				'iMaxCount': _iMaxCount,
				'iMaxDepth': _iMaxDepth
			}
		);
	}
	/* @end method */
	this.print_r = this.getStructureString;
	
	/*
	@start method
	
	@return asInstanceNames [type]string[][/type]
	[en]...[/en]
	
	@param oObject [needed][type]object[/type]
	[en]...[/en]
	*/
	this.getInstanceNamesOf = function(_oObject)
	{
		_oObject = this.getRealParameter({'oParameters': _oObject, 'sName': 'oObject', 'xParameter': _oObject, 'bNotNull': true});
		var _asInstanceNames = new Array();
		for(var _sObjectName in window)
		{
			try {if(window[_sObjectName] instanceof _oObject) {_asInstanceNames.push(_sObjectName);}}
			catch(_eError) {}
		}
		return _asInstanceNames;
	}
	/* @end method */

	/*
	@start method
	
	@return aoInstances [type]object[][/type]
	[en]...[/en]
	
	@param oObject [needed][type]object[/type]
	[en]...[/en]
	*/
	this.getInstancesOf = function(_oObject)
	{
		_oObject = this.getRealParameter({'oParameters': _oObject, 'sName': 'oObject', 'xParameter': _oObject, 'bNotNull': true});
		var _aoInstances = new Array();
		for(var _sObjectName in this.oWindow)
		{
			try {if (this.oWindow[_sObjectName] instanceof _oObject) {_aoInstances.push(this.oWindow[_sObjectName]);}}
			catch(_eError) {}
		}
		return _aoInstances;
	}
	/* @end method */

	/*
	@start method
	
	@return sClassName [type]string[/type]
	[en]...[/en]
	
	@param oObject [needed][type]object[/type]
	[en]...[/en]
	*/
	this.getTypeOfInstance = function(_oObject)
	{
		_oObject = this.getRealParameter({'oParameters': _oObject, 'sName': 'oObject', 'xParameter': _oObject, 'bNotNull': true});
		for(var _sClassName in this.oWindow)
		{
			try
			{
				if ((_oObject instanceof this.oWindow[_sClassName])
				&& (_sClassName != 'classPG_ClassBasics')
				&& (_sClassName != 'classPG_GameClassBasics'))
				{
					return _sClassName;
				}
			}
			catch(_eError) {}
		}
		return false;
	}
	/* @end method */
	this.getClassName = this.getTypeOfInstance;
	
	/*
	@start method
	
	@return aoClasses [type]object[][/type]
	[en]...[/en]
	
	@param oObject [needed][type]object[/type]
	[en]...[/en]
	*/
	this.getTypesOfInstance = function(_oObject)
	{
		_oObject = this.getRealParameter({'oParameters': _oObject, 'sName': 'oObject', 'xParameter': _oObject, 'bNotNull': true});
		var _aoClasses = new Array();
		for(var _sClassName in this.oWindow)
		{
			try {if(_oObject instanceof this.oWindow[_sClassName]) {_aoClasses.push(_sClassName);}}
			catch(_eError) {}
		}
		return _aoClasses;
	}
	/* @end method */
	this.getClassNames = this.getTypesOfInstance;
	
	/*
	@start method
	
	@return oObject [type]object[/type]
	[en]...[/en]
	
	@param oObject1 [needed][type]object[/type]
	[en]...[/en]
	
	@param oObject2 [needed][type]object[/type]
	[en]...[/en]
	*/
	this.concate = function(_oObject1, _oObject2)
	{
		_oObject2 = this.getRealParameter({'oParameters': _oObject1, 'sName': 'oObject2', 'xParameter': _oObject2});
		_oObject1 = this.getRealParameter({'oParameters': _oObject1, 'sName': 'oObject1', 'xParameter': _oObject1, 'bNotNull': true});
		
		for (_sProperty in _oObject2) {_oObject1[_sProperty] = _oObject2[_sProperty];}
		return _oObject1;
	}
	/* @end method */
}
/* @end class */
classPG_Objects.prototype = new classPG_ClassBasics();
var oPGObjects = new classPG_Objects();
