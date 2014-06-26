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
function classPG_Facebook()
{
	// Declarations...
	
	// Construct...
	
	// Methods...
	/* @start method */
	this.init = function()
	{
		var _oScript = document.createElement('script');
		var _oFacebookRoot = document.getElementById('fb-root');
		var _sProtocol = document.location.protocol;
		if (_sProtocol == '') {_sProtocol = 'http:';}
		if ((_oScript) && (_oFacebookRoot))
		{
			_oScript.type = 'text/javascript';
			_oScript.async = true;
			_oScript.src = _sProtocol+'//connect.facebook.net/en_US/all.js'; // #xfbml=1';
			_oFacebookRoot.appendChild(_oScript);
		}
	}
	/* @end method */
}
/* @end class */
var oPGFacebook = new classPG_Facebook();
