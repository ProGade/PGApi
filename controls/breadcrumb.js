/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 23 2012
*/
/*
@start class

@description
[en]This class has methods to create a breadcrumb navigation.[/en]
[de]Diese Klasse verfügt über Methoden zum erstellen einer Brotkrümmel-Navigation.[/de]

@param extends classPG_ClassBasics
*/
function classPG_BreadCrumb()
{
	// Declarations...

	// Construct...
	this.setID({'sID': 'PGBreadCrumb'});
	this.initClassBasics();
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Builds a link structure array for the breadcrumb navigation.[/en]
	[de]Erstellt einen Link-Structure-Array für die Brotkrümmel Navigation.[/de]
	
	@return axLink [type]mixed[][/type]
	[en]Returns the link structure array.[/en]
	[de]Gibt den Link-Structure-Array zurück.[/de]
	
	@param sUrl [needed][type]string[/type]
	[en]The URL for the link.[/en]
	[de]Die URL für den Link.[/de]
	
	@param sName [type]string[/type]
	[en]The name of the link.[/en]
	[de]Der Name des Links.[/de]
	
	@param sTarget [type]string[/type]
	[en]The target frame for the link.[/en]
	[de]Das Zielframe für den Link.[/de]
	*/
	this.buildLinkStructure = function(_sUrl, _sName, _sTarget)
	{
		if (typeof(_sName) == 'undefined') {var _sName = null;}
		if (typeof(_sTarget) == 'undefined') {var _sTarget = null;}

		_sName = this.getRealParameter({'oParameters': _sUrl, 'sName': 'sName', 'xParameter': _sName});
		_sTarget = this.getRealParameter({'oParameters': _sUrl, 'sName': 'sTarget', 'xParameter': _sTarget});
		_sUrl = this.getRealParameter({'oParameters': _sUrl, 'sName': 'sUrl', 'xParameter': _sUrl});

		return {'sUrl':_sUrl, 'sName':_sName, 'sTarget':_sTarget};
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Builds the breadcrumb navigation.[/en]
	[de]Erstellt die Brotkrümmel-Navigation.[/de]
	
	@return sHtml [type]string[/type]
	[en]Returns the breadcrumb navigation as a string.[/en]
	[de]Gibt die Brotkrümmel-Navigation als String zurück.[/de]
	
	@param sBreadCrumbID [type]string[/type]
	[en]The ID for the breadcrumb navigation.[/en]
	[de]Die ID für die Brotkrümmel-Navigation.[/de]
	
	@param axLinkStructures [type]mixed[][/type]
	[en]The link structure array to build the navigation.[/en]
	[de]Das Link-Struktur-Array zum Aufbauen der Navigation.[/de]
	
	@param sSeperator [type]string[/type]
	[en]The separator characters to be placed between the links of the navigation.[/en]
	[de]Die Trennzeichen, die zwischen den Links der Navigation gesetzt werden sollen.[/de]
	
	@param sPrefixText [type]string[/type]
	[en]The introductory text before the navigation.[/en]
	[de]Der Einleitungstext vor der Navigation.[/de]
	
	@param sSuffixText [type]string[/type]
	[en]The final text behind the navigation.[/en]
	[de]Der Schlusstext nach der Navigation.[/de]
	*/
	this.build = function(_sBreadCrumbID, _axLinkStructures, _sSeperator, _sPrefixText, _sSuffixText)
	{
		if (typeof(_sBreadCrumbID) == 'undefined') {var _sBreadCrumbID = null;}
		if (typeof(_axLinkStructures) == 'undefined') {var _axLinkStructures = null;}
		if (typeof(_sSeperator) == 'undefined') {var _sSeperator = null;}
		if (typeof(_sPrefixText) == 'undefined') {var _sPrefixText = null;}
		if (typeof(_sSuffixText) == 'undefined') {var _sSuffixText = null;}

		_axLinkStructures = this.getRealParameter({'oParameters': _sBreadCrumbID, 'sName': 'axLinkStructures', 'xParameter': _axLinkStructures});
		_sSeperator = this.getRealParameter({'oParameters': _sBreadCrumbID, 'sName': 'sSeperator', 'xParameter': _sSeperator});
		_sPrefixText = this.getRealParameter({'oParameters': _sBreadCrumbID, 'sName': 'sPrefixText', 'xParameter': _sPrefixText});
		_sSuffixText = this.getRealParameter({'oParameters': _sBreadCrumbID, 'sName': 'sSuffixText', 'xParameter': _sSuffixText});
		_sBreadCrumbID = this.getRealParameter({'oParameters': _sBreadCrumbID, 'sName': 'sBreadCrumbID', 'xParameter': _sBreadCrumbID});
		
		if (_sBreadCrumbID == null) {_sBreadCrumbID = this.getNextID();}
		if (_axLinkStructures == null) {_axLinkStructures = new Array();}
		if (_sSeperator == null) {_sSeperator = '&gt;';}
		if (_sPrefixText == null) {_sPrefixText = '';}
		if (_sSuffixText == null) {_sSuffixText = '';}
		
		var _sHtml = '';
		
		_sHtml += '<div id="'+_sBreadCrumbID+'">';
		if (_sPrefixText != '') {_sHtml += _sPrefixText+' ';}
		for (var i=0; i<_axLinkStructures.length; i++)
		{
			if (i>0) {_sHtml += ' '+_sSeperator+' ';}
			if ((_axLinkStructures[i]['sTarget'] == '') || (_axLinkStructures[i]['sTarget'] == null)) {_axLinkStructures[i]['sTarget'] = '_self';}
			if ((_axLinkStructures[i]['sUrl'] == '') || (_axLinkStructures[i]['sUrl'] == null)) {_axLinkStructures[i]['sUrl'] = 'index.php';}
			if ((_axLinkStructures[i]['sName'] == '') || (_axLinkStructures[i]['sName'] == null)) {_axLinkStructures[i]['sName'] = _axLinkStructures[i]['sUrl'];}
			_sHtml += '<a href="'+_axLinkStructures[i]['sUrl']+'" target="'+_axLinkStructures[i]['sTarget']+'">'+_axLinkStructures[i]['sName']+'</a>';
		}
		if (_sSuffixText != '') {_sHtml += ' '+_sSuffixText;}
		_sHtml += '</div>';
		
		return _sHtml;
	}
	/* @end method */
}
/* @end class */
classPG_BreadCrumb.prototype = new classPG_ClassBasics();
var oPGBreadCrumb = new classPG_BreadCrumb();
