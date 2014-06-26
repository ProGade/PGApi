/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Nov 07 2012
*/
/*
@start class

@description
[en]The class has methods for loading JavaScript files.[/en]
[de]Die Klasse verfügt über Methoden zum laden von JavaScript Dateien.[/de]

@param extends classPG_ClassBasics
*/
function classPG_JsLoader()
{
	// Declarations...
	this.bAsync = false;
	
	// Construct...
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Includes a JavaScript file at run time.[/en]
	[de]Bindet zur Laufzeit eine JavaScript Datei ein.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The JavaScript file that is to be include.[/en]
	[de]Die JavaScript Datei die einzubinden ist.[/de]
	
	@param bAsync [type]bool[/type]
	[en]Specifies whether the file should be included asynchronously. The script waits at "false" until the file is completely loaded, on "true" the script continues to run while it loads the file.[/en]
	[de]Gibt an ob die Datei asynchron eingebunden werden soll. Bei "false" wartet das Script bis die Datei komplett geladen wurde, bei "true" läuft das Script weiter während es die Datei lädt.[/de]
	
	@param sIncludeID [type]string[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	this.include = function(_sFile, _bAsync, _sIncludeID)
	{
		if (typeof(_sFile) == 'undefined') {var _sFile = null;}
		if (typeof(_bAsync) == 'undefined') {var _bAsync = null;}
		if (typeof(_sIncludeID) == 'undefined') {var _sIncludeID = null;}

		_bAsync = this.getRealParameter({'oParameters': _sFile, 'sName': 'bAsync', 'xParameter': _bAsync});
		_sIncludeID = this.getRealParameter({'oParameters': _sFile, 'sName': 'sIncludeID', 'xParameter': _sIncludeID});
		_sFile = this.getRealParameter({'oParameters': _sFile, 'sName': 'sFile', 'xParameter': _sFile});
		
		if (_bAsync == null) {_bAsync = this.bAsync;}
		
		var _oHead = this.oDocument.getElementsByTagName('head')[0];
		var _oScript = this.oDocument.createElement('script');
		if ((_oHead) && (_oScript))
		{
			if (_bAsync == true) {_oScript.async = true;}
			if (_sIncludeID != null) {_oScript.id = _sIncludeID;}
			_oScript.type = 'text/javascript';
			_oScript.src = _sFile;
			_oHead.appendChild(_oScript);
		}
	}
	/* @end method */
}
/* @end class */
classPG_JsLoader.prototype = new classPG_ClassBasics();
var oPGJsLoader = new classPG_JsLoader();
