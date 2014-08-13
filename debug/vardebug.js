/*
* ProGade API
* Copyright 2014, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 12 2014
*/
/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_VarDebug()
{
	// Declarations...
	this.iMaxObjectProperties = 100;
	this.iCurrentObjectProperties = 0;
	
	// Construct...
	
	// Methods...
	/*
	@start method
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param oObject [needed][type]object[/type]
	[en]...[/en]
	
	@param oParent [type]object[/type]
	[en]...[/en]
	*/
	this.getObjectProperties = function(_oObject, _oParent)
	{
		if (typeof(_oParent) == 'undefined') {var _oParent = null;}

		_oParent = this.getRealParameter({'oParameters': _oObject, 'sName': 'oParent', 'xParameter': _oParent});
		_oObject = this.getRealParameter({'oParameters': _oObject, 'sName': 'oObject', 'xParameter': _oObject, 'bNotNull': true});
		
		var _sString = '';
		for (var _oProperty in _oObject)
		{
			if (_oParent) {_sString += _oParent + "." + _oProperty + " = " + _oObject[_oProperty];}
			else {_sString += _oProperty + " = " + _oObject[_oProperty];}
			
			if ((!confirm(_sString)) || (this.iCurrentObjectProperties >= this.iMaxObjectProperties)) {return '';}
			this.iCurrentObjectProperties++;
			
			if (typeof(_oObject[_oProperty]) == 'object')
			{
				if (_oParent) {_sString += this.getObjectProperties(_oObject[_oProperty], _oParent + "." + _oProperty);}
				else {_sString += this.getObjectProperties(_oObject[_oProperty], _oProperty);}
			}
		}
		return _sString;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param xVariable [needed][type]mixed[/type
	[en]...[/en]
	*/
	this.getStringAll = function(_xVariable)
	{
		_xVariable = this.getRealParameter({'oParameters': _xVariable, 'sName': 'xVariable', 'xParameter': _xVariable, 'bNotNull': true});
		this.iCurrentObjectProperties = 0;
		if (typeof(_xVariable) == 'object') {return this.getObjectProperties(_xVariable);}
		return null;
	}
	/* @end method */
}
/* @end class */
classPG_VarDebug.prototype = new classPG_ClassBasics();
var oPGVarDebug = new classPG_VarDebug();
