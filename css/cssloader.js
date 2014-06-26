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
[en]The class has methods to the load CSS files.[/en]
[de]Die Klasse verfügt über Methoden zum laden von CSS Dateien.[/de]

@param extends classPG_ClassBasics
*/
function classPG_CssLoader()
{
	// Declarations...
	this.sFilesPath = '';
	this.asFiles = new Array();
	this.asFeatureEngines = ['webkit', 'moz', 'o', 'ms'];
	
	// Construct...
	this.setID({'sID': 'PGCssLoader'});
	
	// Methods...
	this.setFilesPath = function(_sPath)
	{
		_sPath = this.getRealParameter({'oParameters': _sPath, 'sName': 'sPath', 'xParameter': _sPath});
		this.sFilesPath = _sPath;
	}

	this.getFilesPath = function() {return this.sFilesPath;}

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
		var _oLink = this.oDocument.createElement('link');
		if ((_oHead) && (_oLink))
		{
			if (_bAsync == true) {_oLink.async = true;}
			if (_sIncludeID != null) {_oLink.id = _sIncludeID;}
			_oLink.rel = 'stylesheet';
			_oLink.href = this.sFilesPath+_sFile;
			_oLink.type = 'text/css';
			_oHead.appendChild(_oLink);
		}
	}
	
	this.removeIncluded = function(_sIncludeID)
	{
		_sIncludeID = this.getRealParameter({'oParameters': _sIncludeID, 'sName': 'sIncludeID', 'xParameter': _sIncludeID});
		return oPGNodes.remove({'xElement': _sIncludeID});
	}

	/*
	@start method
	
	@param asFeatures [type]string[][/type]
	[en]...[/en]
	*/
	this.checkFeatures = function(_asFeatures)
	{
		if (typeof(_asFeatures) == 'undefined') {var _asFeatures = null;}
		_asFeatures = this.getRealParameter({'oParameters': _asFeatures, 'sName': 'asFeatures', 'xParameter': _asFeatures});
		
		var _sFeatures = '';
		for (var _iFeatureIndex=0; _iFeatureIndex<_asFeatures.length; _iFeatureIndex++)
		{
			for (var _iFeatureEnginesIndex=0; _iFeatureEnginesIndex<this.asFeatureEngines.length; _iFeatureEnginesIndex++)
			{
				var _oDiv = this.oDocument.createElement('div');
				if (typeof(_oDiv.style[asFeatureEngines[_iFeatureEnginesIndex]]) != 'undefined')
				{
					if (_sFeatures != '') {_sFeatures += ',';}
					_sFeatures += asFeatureEngines[_iFeatureEnginesIndex];
				}
			}
		}
		return '?sFeatures='+_sFeatures;
	}
	/* @end method */
	
	/* @start method */
	this.build = function()
	{
		
	}
	/* @end method */
}
/* @end class */
classPG_CssLoader.prototype = new classPG_ClassBasics();
var oPGCssLoader = new classPG_CssLoader();