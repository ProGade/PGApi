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
function classPG_FacebookLogin()
{
	this.sAppID = '';
	
	/*
	@start method
	@param sAppID
	*/
	this.setFacebookAppID = function(_sAppID)
	{
		if (typeof(_sAppID) == 'undefined') {var _sAppID = null;}
		_sAppID = this.getRealParameter({'oParameters': _sAppID, 'sName': 'sAppID', 'xParameter': _sAppID});
		this.sAppID = _sAppID;
	}
	/* @end method */

	/* @start method */
	this.getFacebookAppID = function() {return this.sAppID;}
	/* @end method */

	this.setAppID = this.setFacebookAppID;
	this.getAppID = this.getFacebookAppID;
	
	/* @start method */
	this.init = function(_sAppID)
	{
		if (typeof(_sAppID) == 'undefined') {var _sAppID = null;}
		_sAppID = this.getRealParameter({'oParameters': _sAppID, 'sName': 'sAppID', 'xParameter': _sAppID});
		if (_sAppID != null) {this.setAppID({'sAppID': _sAppID});}

		if (this.sAppID == null) {alert('No Facebook App ID!');}
		
		window.fbAsyncInit = function()
		{
			FB.init({
				appId:oPGFacebookLogin.sAppID,
				cookie:true,
				xfbml:true,
				oauth:true
			});
			
			FB.Event.subscribe('auth.login', function(response) {window.location.reload();});
			FB.Event.subscribe('auth.logout', function(response) {window.location.reload();});
		};
		(
			function()
			{
				var _oScript = document.createElement('script');
				_oScript.async = true;
				_oScript.src = document.location.protocol+'//connect.facebook.net/en_US/all.js';
				document.getElementById('fb-root').appendChild(_oScript);
			}()
		);
	}
	/* @end method */
}
/* @end class */
classPG_FacebookLogin.prototype = new classPG_ClassBasics();
var oPGFacebookLogin = new classPG_FacebookLogin();
