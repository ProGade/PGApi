/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 22 2012
*/
/*
@start class
*/
function classPG_MySpaceShare()
{
	/*
	@start method
	@param sUrlToShare
	@param sTitleToShare
	@param sTextToShare
	*/
	this.share = function(_sUrlToShare, _sTitleToShare, _sTextToShare)
	{
		if (typeof(_sUrlToShare) == 'undefined') {var _sUrlToShare = null;}
		if (typeof(_sTitleToShare) == 'undefined') {var _sTitleToShare = null;}
		if (typeof(_sTextToShare) == 'undefined') {var _sTextToShare = null;}
		
		if (_sUrlToShare == null) {_sUrlToShare = '';}
		if (_sTitleToShare == null) {_sTitleToShare = '';}
		if (_sTextToShare == null) {_sTextToShare = '';}
		
		if (_sUrlToShare == '') {_sUrlToShare = document.location.toString();}
		
		var _sTargetUrl = 'http://www.myspace.com/index.cfm?fuseaction=postto';
		if (_sTitleToShare != '') {_sTargetUrl += '&t='+encodeURIComponent(_sTitleToShare);}
		if (_sTextToShare != '') {_sTargetUrl += '&c='+encodeURIComponent(_sTextToShare);}
		if (_sUrlToShare != '') {_sTargetUrl += '&u='+encodeURIComponent(_sUrlToShare);}
		window.open(_sTargetUrl, 'PGMySpaceShareWindow', 'height=450,width=440').focus();
	}
	/* @end method */
}
/* @end class */
var oPGMySpaceShare = new classPG_MySpaceShare();
