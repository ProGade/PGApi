/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 21 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_Random()
{
	// Declarations...
	
	// Construct...
	
	// Methods...
	/*
	@start method
	
	@return iRandom [type]int[/type]
	[en]...[/en]
	
	@param iMax [type]int[/type]
	[en]...[/en]
	
	@param iMin [type]int[/type]
	[en]...[/en]
	*/
	this.build = function(_iMax, _iMin)
	{
		if (typeof(_iMin) == 'undefined') {var _iMin = null;}
		if (typeof(_iMax) == 'undefined') {var _iMax = null;}

		_iMin = this.getRealParameter({'oParameters': _iMax, 'sName': 'iMin', 'xParameter': _iMin});
		_iMax = this.getRealParameter({'oParameters': _iMax, 'sName': 'iMax', 'xParameter': _iMax});

		if ((_iMin != null) && (_iMax != null)) {return Math.round(Math.random()*(_iMax-_iMin))+_iMin;}
		else if (_iMax != null) {return Math.round(Math.random()*_iMax);}
		return Math.round(Math.random()*100);
	}
	/* @end method */
	this.rand = this.build;
	this.random = this.build;
}
/* @end class */
classPG_Random.prototype = new classPG_ClassBasics();
var oPGRandom = new classPG_Random();
